<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Candidate;
use App\Models\Election;
use Illuminate\Http\Request;

class CandidateController extends Controller
{
    public function index()
    {
        $candidates = Candidate::with(['election', 'persons'])->get();
        return view('admin.candidates.index', compact('candidates'));
    }

    public function create()
    {
        $elections = Election::all();
        return view('admin.candidates.create', compact('elections'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'election_id'  => 'required|exists:elections,id',
            'vision'       => 'required',
            'mission'      => 'required',
            'photo'        => 'nullable|image',

            'leader_name'  => 'required|string|max:100',
            'leader_photo' => 'nullable|image',

            'deputy_name'  => 'required|string|max:100',
            'deputy_photo' => 'nullable|image',
        ]);

        // Simpan pasangan kandidat
        $photoPath = $request->file('photo')?->store('candidates', 'public');
        $candidate = Candidate::create([
            'election_id' => $request->election_id,
            'vision'      => $request->vision,
            'mission'     => $request->mission,
            'photo'       => $photoPath,
        ]);

        // Simpan ketua
        $leaderPhoto = $request->file('leader_photo')?->store('persons', 'public');
        $candidate->persons()->create([
            'name'     => $request->leader_name,
            'position' => 'ketua',
            'photo'    => $leaderPhoto,
        ]);

        // Simpan wakil
        $deputyPhoto = $request->file('deputy_photo')?->store('persons', 'public');
        $candidate->persons()->create([
            'name'     => $request->deputy_name,
            'position' => 'wakil',
            'photo'    => $deputyPhoto,
        ]);

        return redirect()->route('admin.candidates.index')->with('success', 'Kandidat berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $candidate = Candidate::with('persons')->findOrFail($id);
        $elections = Election::all();

        $leader = $candidate->persons->firstWhere('position', 'ketua');
        $deputy = $candidate->persons->firstWhere('position', 'wakil');

        return view('admin.candidates.edit', compact('candidate', 'elections', 'leader', 'deputy'));
    }

    public function update(Request $request, $id)
    {
        $candidate = Candidate::findOrFail($id);

        $request->validate([
            'election_id'  => 'required|exists:elections,id',
            'vision'       => 'required',
            'mission'      => 'required',
            'photo'        => 'nullable|image',

            'leader_name'  => 'required|string|max:100',
            'leader_photo' => 'nullable|image',

            'deputy_name'  => 'required|string|max:100',
            'deputy_photo' => 'nullable|image',
        ]);

        // Update kandidat
        if ($request->hasFile('photo')) {
            $candidate->photo = $request->file('photo')->store('candidates', 'public');
        }

        $candidate->update([
            'election_id' => $request->election_id,
            'vision'      => $request->vision,
            'mission'     => $request->mission,
        ]);

        // Update ketua dan wakil
        foreach ($candidate->persons as $person) {
            if ($person->position === 'ketua') {
                $person->name = $request->leader_name;
                if ($request->hasFile('leader_photo')) {
                    $person->photo = $request->file('leader_photo')->store('persons', 'public');
                }
                $person->save();
            }

            if ($person->position === 'wakil') {
                $person->name = $request->deputy_name;
                if ($request->hasFile('deputy_photo')) {
                    $person->photo = $request->file('deputy_photo')->store('persons', 'public');
                }
                $person->save();
            }
        }

        return redirect()->route('admin.candidates.index')->with('success', 'Kandidat berhasil diperbarui.');
    }
    public function destroy($id)
    {
        $candidate = Candidate::findOrFail($id);

        // Hapus foto utama kandidat (jika ada)
        if ($candidate->photo) {
            \Storage::disk('public')->delete($candidate->photo);
        }

        // Hapus foto orang (ketua & wakil)
        foreach ($candidate->persons as $person) {
            if ($person->photo) {
                \Storage::disk('public')->delete($person->photo);
            }
        }

        // Hapus relasi dan kandidat
        $candidate->persons()->delete();
        $candidate->delete();

        return redirect()->route('admin.candidates.index')->with('success', 'Kandidat berhasil dihapus.');
    }

}
