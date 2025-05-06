<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\UserGroup;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('userGroup')->get();
        return view('users.index', compact('users'));
    }

    public function edit(User $user)
    {
        $groups = UserGroup::all(); // <- nome compatível com a view
        return view('users.edit', compact('user', 'groups'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'user_group_id' => 'nullable|exists:user_groups,id',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'user_group_id' => $request->user_group_id,
        ]);

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}