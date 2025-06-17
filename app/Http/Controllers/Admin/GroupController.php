<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\User;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function index()
    {
        $groups = Group::withCount('users')->get();
        return view('admin.groups.index', compact('groups'));
    }

    public function create()
    {
        $groups = Group::withCount('users')->get();
        return view('admin.groups.create', compact('groups'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:groups,name',
        ]);

        Group::create(['name' => $request->name]);
        return redirect()->route('admin.groups.index')->with('success', 'Group berhasil ditambahkan.');
    }

    public function edit(Group $group)
    {
        $users   = User::all();
        $members = $group->users->pluck('id')->toArray();

        return view('admin.groups.edit', compact('group', 'users', 'members'));
    }

    public function update(Request $request, Group $group)
    {
        $request->validate([
            'name'    => 'required|string|max:255|unique:groups,name,' . $group->id,
            'members' => 'nullable|array',
        ]);

        $group->update(['name' => $request->name]);

        // sinkronisasi many-to-many
        $group->users()->sync($request->members ?? []);

        return redirect()->route('admin.groups.index')->with('success', 'Group berhasil diperbarui.');
    }

    public function destroy(Group $group)
    {
        $group->users()->detach();
        $group->delete();

        return redirect()->route('admin.groups.index')->with('success', 'Group berhasil dihapus.');
    }
    public function updateMembers(Request $request, Group $group)
    {
        $request->validate([
            'user_ids' => 'nullable|array',
        ]);

        // Kosongkan semua user yang sebelumnya ada di grup ini
        User::where('group_id', $group->id)->update(['group_id' => null]);

        // Tambahkan user yang dipilih ke dalam grup
        if ($request->filled('user_ids')) {
            User::whereIn('id', $request->user_ids)->update(['group_id' => $group->id]);
        }

        return redirect()
            ->route('admin.groups.edit', $group->id)
            ->with('success', 'Anggota grup berhasil diperbarui.');
    }
    public function show(Group $group)
    {
        return view('admin.groups.show', compact('group'));
    }

}
