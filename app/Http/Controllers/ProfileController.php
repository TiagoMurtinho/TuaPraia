<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{

    public function index($id)
    {
        $user = User::findOrFail($id);
        $authUser = Auth::user();
        return view('pages.profile.profile', compact('user', 'authUser'));
    }
    /**
     * Display the user's profile form.
     */
    public function edit($id): View
    {
        $user = User::findorfail($id);
        return view('profile.edit', compact('user'));
    }

    /**
     * Update the user's profile information.
     */
    public function updateName(Request $request, $id): RedirectResponse
    {
        $user = User::findOrFail($id);

        $validatedData = $request->validate([
            'profile_name' => 'required|string|max:255',
        ]);

        $user->name = $validatedData['profile_name'];
        $user->save();

        return redirect()->route('profile.index', ['id' => $user->id]);
    }

    public function updateEmail(Request $request, $id): RedirectResponse
    {
        $user = User::findOrFail($id);

        $validatedData = $request->validate([
            'profile_email' => 'required|email|unique:users,email,'.$user->id,
        ]);

        $user->email = $validatedData['profile_email'];
        $user->save();

        return redirect()->route('profile.index', ['id' => $user->id]);
    }

    public function updatePassword(Request $request, $id): RedirectResponse
    {
        $user = User::findOrFail($id);

        $validatedData = $request->validate([
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        $user->password = Hash::make($validatedData['new_password']);
        $user->save();

        return redirect()->route('profile.index', ['id' => $user->id]);
    }

    public function updatePhoto(Request $request, $id): RedirectResponse
    {
        $user = User::findOrFail($id);

        // Validação da requisição para garantir que foi enviado um arquivo de imagem
        $request->validate([
            'profile_photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // ajuste o tamanho máximo conforme necessário
        ]);

        // Remove a foto atual, se existir
        $user->clearMediaCollection('users');

        // Armazena a nova foto usando Spatie Media Library
        $user->addMediaFromRequest('profile_photo')
            ->toMediaCollection('users');

        return redirect()->route('profile.index', ['id' => $user->id])->with('success', __('profile.photo_updated'));
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request, $id): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = User::findOrFail($id);

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

}
