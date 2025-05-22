<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\UserGroup;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('userGroup')->paginate(10);
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
            'phone' => 'nullable|string|max:20',
            'role' => 'nullable|string|max:100',
            'department' => 'nullable|string|max:100',
            'profile_picture_url' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'active' => 'boolean',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'user_group_id' => $request->user_group_id,
            'phone' => $request->phone,
            'role' => $request->role,
            'department' => $request->department,
            'active' => $request->has('active') ? (bool) $request->active : true,
        ];

        if ($request->hasFile('profile_picture_url')) {
            $path = $request->file('profile_picture_url')->store('profile_pictures', 'public');
            $data['profile_picture_url'] = $path;
        }

        User::create($data);

        return redirect()->route('users.index')->with('success', 'Usuário criado com sucesso.');
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
            'phone' => 'nullable|string|max:20',
            'role' => 'nullable|string|max:100',
            'department' => 'nullable|string|max:100',
            'profile_picture_url' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'active' => 'boolean',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'user_group_id' => $request->user_group_id,
            'phone' => $request->phone,
            'role' => $request->role,
            'department' => $request->department,
            'active' => $request->has('active') ? (bool) $request->active : true,
        ];

        if ($request->hasFile('profile_picture_url')) {
            if ($user->profile_picture_url && Storage::disk('public')->exists($user->profile_picture_url)) {
                Storage::disk('public')->delete($user->profile_picture_url);
            }

            $path = $request->file('profile_picture_url')->store('profile_pictures', 'public');
            $data['profile_picture_url'] = $path;
        }

        $user->update($data);

        return redirect()->route('users.index')->with('success', 'Usuário atualizado com sucesso.');
    }

    public function destroy(User $user)
    {
        if ($user->profile_picture_url && Storage::disk('public')->exists($user->profile_picture_url)) {
            Storage::disk('public')->delete($user->profile_picture_url);
        }

        $user->delete();

        return redirect()->route('users.index')->with('success', 'Usuário deletado com sucesso.');
    }
}
