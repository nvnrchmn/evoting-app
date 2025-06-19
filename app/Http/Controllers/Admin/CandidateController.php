<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Candidate;
use App\Models\Election;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CandidateController extends Controller
{
    public function index()
    {
        // $candidates = Candidate::with(['election', 'persons'])->get();
        // dd($candidates);
        // dd($candidates->first()->relations);
        // return view('admin.candidates.index', compact('candidates'));

        $candidates = Candidate::with(['election', 'persons'])->get();

        // foreach ($candidates as $c) {
        //     dump($c->id, $c->persons); // lihat isinya langsung
        // }

        return view('admin.candidates.index', compact('candidates'));

    }

    public function create()
    {
        $elections = Election::all();
        return view('admin.candidates.create', compact('elections'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'election_id'  => 'required|exists:elections,id',
            'vision'       => 'required',
            'mission'      => 'required',
            'photo'        => 'nullable|image',

            'leader_name'  => 'required|string|max:100',
            'leader_photo' => 'nullable|image',

            'deputy_name'  => 'required|string|max:100',
            'deputy_photo' => 'nullable|image',
        ]);

        // Upload foto kandidat
        $photoPath = $this->uploadFile($request, 'photo', 'candidates');

        // Simpan kandidat
        $candidate = Candidate::create([
            'election_id' => $validated['election_id'],
            'name'        => $validated['leader_name'] . ' & ' . $validated['deputy_name'],
            'vision'      => $validated['vision'],
            'mission'     => $validated['mission'],
            'photo'       => $photoPath,
        ]);

        // Simpan ketua dan wakil
        $candidate->persons()->create([
            'name'     => $validated['leader_name'],
            'position' => 'ketua',
            'photo'    => $this->uploadFile($request, 'leader_photo', 'persons'),
        ]);

        $candidate->persons()->create([
            'name'     => $validated['deputy_name'],
            'position' => 'wakil',
            'photo'    => $this->uploadFile($request, 'deputy_photo', 'persons'),
        ]);

        return redirect()->route('admin.candidates.index')->with('success', 'Kandidat berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $candidate = Candidate::with('persons')->findOrFail($id);
        $elections = Election::all();
        $leader    = $candidate->persons->firstWhere('position', 'ketua');
        $deputy    = $candidate->persons->firstWhere('position', 'wakil');

        return view('admin.candidates.edit', compact('candidate', 'elections', 'leader', 'deputy'));
    }

    public function update(Request $request, $id)
    {
        $candidate = Candidate::with('persons')->findOrFail($id);

        $validated = $request->validate([
            'election_id'  => 'required|exists:elections,id',
            'vision'       => 'required',
            'mission'      => 'required',
            'photo'        => 'nullable|image',

            'leader_name'  => 'required|string|max:100',
            'leader_photo' => 'nullable|image',

            'deputy_name'  => 'required|string|max:100',
            'deputy_photo' => 'nullable|image',
        ]);

        // Update foto jika ada
        if ($request->hasFile('photo')) {
            $this->deleteFile($candidate->photo);
            $candidate->photo = $this->uploadFile($request, 'photo', 'candidates');
        }

        // Update kandidat
        $candidate->update([
            'election_id' => $validated['election_id'],
            'name'        => $validated['leader_name'] . ' & ' . $validated['deputy_name'],
            'vision'      => $validated['vision'],
            'mission'     => $validated['mission'],
            'photo'       => $candidate->photo, // updated if changed
        ]);

        // Update ketua & wakil
        foreach ($candidate->persons as $person) {
            if ($person->position === 'ketua') {
                $person->name = $validated['leader_name'];
                if ($request->hasFile('leader_photo')) {
                    $this->deleteFile($person->photo);
                    $person->photo = $this->uploadFile($request, 'leader_photo', 'persons');
                }
                $person->save();
            }

            if ($person->position === 'wakil') {
                $person->name = $validated['deputy_name'];
                if ($request->hasFile('deputy_photo')) {
                    $this->deleteFile($person->photo);
                    $person->photo = $this->uploadFile($request, 'deputy_photo', 'persons');
                }
                $person->save();
            }
        }

        return redirect()->route('admin.candidates.index')->with('success', 'Kandidat berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $candidate = Candidate::with('persons')->findOrFail($id);

        // Hapus foto kandidat
        $this->deleteFile($candidate->photo);

        // Hapus foto ketua & wakil
        foreach ($candidate->persons as $person) {
            $this->deleteFile($person->photo);
        }

        // Hapus data
        $candidate->persons()->delete();
        $candidate->delete();

        return redirect()->route('admin.candidates.index')->with('success', 'Kandidat berhasil dihapus.');
    }

    // Helpers
    private function uploadFile(Request $request, string $field, string $path)
    {
        return $request->hasFile($field)
        ? $request->file($field)->store($path, 'public')
        : null;
    }

    private function deleteFile(?string $filePath)
    {
        if ($filePath && Storage::disk('public')->exists($filePath)) {
            Storage::disk('public')->delete($filePath);
        }
    }
}
