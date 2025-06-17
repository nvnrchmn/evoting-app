<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Election;
use App\Models\Group;
use Illuminate\Http\Request;

class ElectionController extends Controller
{
    public function index()
    {
        $elections = Election::with('groups')->get();
        return view('admin.elections.index', compact('elections'));
    }

    public function create()
    {
        $groups         = Group::all();
        $selectedGroups = []; // default kosong saat create
        return view('admin.elections.create', compact('groups', 'selectedGroups'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'status'      => 'required|in:open,closed',
            'groups'      => 'nullable|array',
            'groups.*'    => 'exists:groups,id',
        ]);

        $election = Election::create($request->only('title', 'description', 'status'));

        if ($request->filled('groups')) {
            $election->groups()->sync($request->groups);
        }

        return redirect()->route('admin.elections.index')->with('success', 'Election berhasil ditambahkan.');
    }

    public function edit(Election $election)
    {
        $groups         = Group::all();
        $selectedGroups = $election->groups->pluck('id')->toArray();

        return view('admin.elections.edit', compact('election', 'groups', 'selectedGroups'));
    }

    public function update(Request $request, Election $election)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'status'      => 'required|in:open,closed',
            'groups'      => 'nullable|array',
            'groups.*'    => 'exists:groups,id',
        ]);

        $election->update($request->only('title', 'description', 'status'));

        $election->groups()->sync($request->groups ?? []);

        return redirect()->route('admin.elections.index')->with('success', 'Election berhasil diperbarui.');
    }

    public function destroy(Election $election)
    {
        $election->groups()->detach();
        $election->delete();

        return redirect()->route('admin.elections.index')->with('success', 'Election berhasil dihapus.');
    }
}
