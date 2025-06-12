<?php
namespace App\Http\Controllers\Voter;

use App\Helpers\RSAHelper;
use App\Http\Controllers\Controller;
use App\Models\Election;
use App\Models\Vote;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VotingController extends Controller
{
    public function index()
    {
        $election   = Election::where('status', 'open')->latest()->first();
        $candidates = $election ? $election->candidates()->with('persons')->get() : [];
        $vote       = Vote::where('user_id', auth()->id())->latest()->first();

        return view('voter.voting.index', compact('election', 'candidates', 'vote'));

    }

    public function vote(Request $request)
    {
        $request->validate([
            'candidate_id' => 'required|exists:candidates,id',
        ]);

        $user = Auth::user();
        if ($user->has_voted) {
            return back()->with('error', 'Anda sudah melakukan voting.');
        }

        $election = Election::where('status', 'open')->latest()->first();
        if (! $election) {
            return back()->with('error', 'Tidak ada pemilu yang sedang berlangsung.');
        }

        $encryptedVote = RSAHelper::encryptWithPublicKey($request->candidate_id);

        Vote::create([
            'user_id'        => $user->id,
            'election_id'    => $election->id,
            'candidate_id'   => $request->candidate_id,
            'encrypted_vote' => $encryptedVote,
        ]);

        $user->update(['has_voted' => true]);

        return redirect()->route('voter.voting.index')->with('success', 'Terima kasih telah melakukan voting!');
    }

    public function downloadReceipt(Vote $vote)
    {
        $user = auth()->user();

        if ($vote->user_id !== $user->id) {
            abort(403, 'Akses ditolak');
        }

        $pdf = Pdf::loadView('voter.voting.receipt', [
            'vote'      => $vote,
            'user'      => $user,
            'timestamp' => $vote->created_at
            ? $vote->created_at->timezone('Asia/Jakarta')->format('d-m-Y H:i:s')
            : '-',
        ]);

        return $pdf->download("Bukti_Voting_{$vote->id}.pdf");
    }

}
