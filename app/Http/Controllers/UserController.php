<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\UserGroup;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        // Alterando para usar paginate() em vez de get()
        $users = User::with('userGroup')->paginate(10); // Aqui, 10 é o número de usuários por página
        return view('users.index', compact('users'));
    }

    public function create()
    {
        $userGroups = UserGroup::all();
        return view('users.create', compact('userGroups'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'user_group_id' => 'nullable|exists:user_groups,id',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'user_group_id' => $request->user_group_id,
        ]);

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    public function edit(User $user)
    {
        $groups = UserGroup::all();
        return view('users.edit', compact('user', 'groups'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
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
