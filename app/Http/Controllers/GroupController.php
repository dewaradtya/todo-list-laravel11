<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GroupController extends Controller
{
    public function index(Request $request)
    {
        $groups = Group::with('groupMembers')->get();

        return view('group.index', compact('groups'));
    }

    public function create()
    {
        return view('group.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:groups',
            'description' => 'required|string|max:1000',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $foto = null;

        if ($request->hasFile('foto')) {
            $fileName = time() . '.' . $request->foto->extension();
            $request->foto->move(public_path('images'), $fileName);
            $foto = $fileName;
        }

        $group = Group::create([
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
            'created_by' => Auth::id(),
            'foto' => $foto,
        ]);

        $group->groupMembers()->create([
            'user_id' => Auth::id(),
            'role' => 'admin',
            'group_id' => $group->id,
        ]);

        return redirect()->route('group.index')->with('success', 'Group created successfully.');
    }

    public function show(Request $request, int $id)
    {
        $group = Group::findOrFail($id);
        $groupMember = $group->groupMembers()->with('user')->get();

        return view('group.show', compact(['group', 'groupMember']));
    }

    public function joinGroup($groupId)
    {
        $group = Group::findOrFail($groupId);

        $isMember = $group->groupMembers()->where('user_id', auth()->id())->exists();

        if ($isMember) {
            return redirect()->route('group.index')->with('error', 'You are already a member of this group.');
        }

        $group->groupMembers()->create([
            'user_id' => auth()->id(),
            'role' => 'member',
            'group_id' => $groupId,
            'is_confirmed' => false, 
        ]);

        return redirect()->route('group.index')->with('success', 'Successfully joined the group.');
    }
}
