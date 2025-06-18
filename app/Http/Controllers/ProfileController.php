<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile details (view-only).
     */
    public function index(Request $request): View
    {
        return view('profile.index', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Display the user's profile form for editing.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $user = $request->user();

        // Atualiza os campos básicos
        $user->fill([
            'name' => $data['name'] ?? $user->name,
            'email' => $data['email'] ?? $user->email,
            'phone' => $data['phone'] ?? $user->phone,
            'department' => $data['department'] ?? $user->department,
            'role' => $data['role'] ?? $user->role,
            'active' => $request->has('active') ? (bool) $request->active : $user->active,
        ]);

        // Atualiza senha se informada
        if ($request->filled('password')) {
            $user->password = bcrypt($request->input('password'));
        }

        // Atualiza foto de perfil se enviada
        if ($request->hasFile('profile_picture_url')) {
            // Exclui imagem antiga se existir
            if ($user->profile_picture_url && Storage::disk('public')->exists($user->profile_picture_url)) {
                Storage::disk('public')->delete($user->profile_picture_url);
            }

            $path = $request->file('profile_picture_url')->store('profile_pictures', 'public');
            $user->profile_picture_url = $path;
        }

        // Resetar verificação de email se o email foi alterado
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        // Exclui imagem de perfil se existir
        if ($user->profile_picture_url && Storage::disk('public')->exists($user->profile_picture_url)) {
            Storage::disk('public')->delete($user->profile_picture_url);
        }

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}