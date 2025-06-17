<?php
namespace App\Http\Controllers\Voter;

use App\Helpers\RSAHelper;
use App\Http\Controllers\Controller;
use App\Models\Candidate;
use App\Models\Election;
use App\Models\Vote;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VotingController extends Controller
{
    /**
     * Menampilkan daftar election yg dapat diikuti oleh user berdasarkan group
     */
    public function index(Election $election)
    {
        $user = auth()->user();

        // Pastikan user memang boleh akses election ini
        if (! $election->groups()->whereIn('groups.id', $user->groups->pluck('id'))->exists()) {
            return redirect()->back()->with('error', 'Anda tidak berhak mengikuti pemilu ini.');
        }

        $candidates = $election->candidates()->with('persons')->get();
        $vote       = $user->votes()->where('election_id', $election->id)->first();

        return view('voting.index', compact('election', 'candidates', 'vote'));
    }

    /**
     * User melakukan voting untuk kandidat tertentu
     */
    public function vote(Request $request)
    {
        $request->validate([
            'candidate_id' => 'required|exists:candidates,id',
        ]);

        $user      = Auth::user();
        $candidate = Candidate::with('election.groups.users')->findOrFail($request->candidate_id);
        $election  = $candidate->election;

        // Cek apakah user sudah voting untuk election ini
        $existingVote = Vote::where('user_id', $user->id)
            ->where('election_id', $election->id)
            ->first();

        if ($existingVote) {
            return back()->with('error', 'Anda sudah melakukan voting.');
        }

        // Pastikan user adalah bagian dari group election ini
        $allowed = $election->groups->flatMap->users->contains('id', $user->id);
        if (! $allowed) {
            abort(403, 'Anda tidak memiliki akses ke voting ini.');
        }

        // Enkripsi dan simpan vote
        $encryptedVote = RSAHelper::encryptWithPublicKey($candidate->id);

        Vote::create([
            'user_id'        => $user->id,
            'election_id'    => $election->id,
            'candidate_id'   => $candidate->id,
            'encrypted_vote' => $encryptedVote,
        ]);

        return redirect()->route('voter.voting.index')->with('success', 'Terima kasih telah melakukan voting!');
    }

    /**
     * Download bukti voting (PDF)
     */
    public function downloadReceipt(Vote $vote)
    {
        $user = auth()->user();

        if ($vote->user_id !== $user->id) {
            abort(403, 'Akses ditolak');
        }

        $url = route('voter.voting.verifikasi', ['vote' => $vote->id]);

        $renderer = new ImageRenderer(new RendererStyle(150), new SvgImageBackEnd());
        $writer   = new Writer($renderer);
        $svg      = $writer->writeString($url);
        $qrCode   = base64_encode($svg);

        $pdf = Pdf::loadView('voter.voting.receipt', [
            'vote'      => $vote,
            'user'      => $user,
            'timestamp' => $vote->created_at
            ? $vote->created_at->timezone('Asia/Jakarta')->format('d-m-Y H:i:s')
            : '-',
            'qrCode'    => $qrCode,
        ]);

        return $pdf->download("Bukti_Voting_{$vote->id}.pdf");
    }

    /**
     * Verifikasi bukti voting melalui QR code
     */
    public function verify(Vote $vote)
    {
        $user      = auth()->user();
        $voter     = $vote->user;
        $election  = $vote->election;
        $candidate = $vote->candidate;

        if ($user?->id !== $voter->id && $user?->role !== 'admin') {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }

        return view('voter.voting.verifikasi', [
            'vote'      => $vote,
            'user'      => $voter,
            'election'  => $election,
            'candidate' => $candidate,
        ]);
    }
}
