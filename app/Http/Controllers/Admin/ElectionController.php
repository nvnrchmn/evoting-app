<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreElectionRequest;
use App\Http\Requests\UpdateElectionRequest;
use App\Models\Election;
use App\Models\Group;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ElectionController extends Controller
{
    public function index(): View
    {
        $elections = Election::with('groups')->get();
        return view('admin.elections.index', compact('elections'));
    }

    public function create(): View
    {
        $groups         = Group::all();
        $selectedGroups = []; // default kosong saat create
        return view('admin.elections.create', compact('groups', 'selectedGroups'));
    }

    public function store(StoreElectionRequest $request): RedirectResponse
    {
        $election = Election::create($request->only('title', 'description', 'status'));
        $this->syncGroups($election, $request->groups);

        return redirect()->route('admin.elections.index')->with('success', 'Election berhasil ditambahkan.');
    }

    public function edit(Election $election): View
    {
        $groups         = Group::all();
        $selectedGroups = $election->groups->pluck('id')->toArray();

        return view('admin.elections.edit', compact('election', 'groups', 'selectedGroups'));
    }

    public function update(UpdateElectionRequest $request, Election $election): RedirectResponse
    {
        $election->update($request->only('title', 'description', 'status'));
        $this->syncGroups($election, $request->groups);

        return redirect()->route('admin.elections.index')->with('success', 'Election berhasil diperbarui.');
    }

    public function destroy(Election $election): RedirectResponse
    {
        $election->groups()->detach();
        $election->delete();

        return redirect()->route('admin.elections.index')->with('success', 'Election berhasil dihapus.');
    }

    private function syncGroups(Election $election, ?array $groupIds): void
    {
        $election->groups()->sync($groupIds ?? []);
    }
}
