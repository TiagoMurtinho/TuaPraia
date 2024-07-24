<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Validator;

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
    public function updateName(Request $request, $id): \Illuminate\Http\JsonResponse
    {
        $user = User::findOrFail($id);

        // Validação
        $validator = Validator::make($request->all(), [
            'profile_name' => 'required|string|max:255',
        ]);

        // Verifica se a validação falhou
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        // Atualiza o nome do usuário
        $user->name = $request->input('profile_name');
        $user->save();

        return response()->json([
            'success' => true,
            'redirect' => route('profile.index', ['id' => $user->id])
        ]);
    }

    public function updateEmail(Request $request, $id): \Illuminate\Http\JsonResponse
    {
        // Validação
        $validator = Validator::make($request->all(), [
            'profile_email' => 'required|email|unique:users,email,' . $id,
        ]);

        // Verifica se a validação falhou
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        // Atualiza o email do usuário
        $user = User::findOrFail($id);
        $user->email = $request->input('profile_email');
        $user->save();

        return response()->json([
            'success' => true,
            'redirect' => route('profile.index', ['id' => $id])
        ]);
    }

    public function updatePassword(Request $request, $id): \Illuminate\Http\JsonResponse
    {
        // Validação
        $validator = Validator::make($request->all(), [
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        // Verifica se a validação falhou
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        // Verifica a senha atual
        $user = User::findOrFail($id);
        if (!Hash::check($request->input('current_password'), $user->password)) {
            return response()->json([
                'errors' => [
                    'current_password' => ['A senha atual está incorreta.']
                ]
            ], 422);
        }

        // Atualiza a senha do usuário
        $user->password = Hash::make($request->input('new_password'));
        $user->save();

        return response()->json([
            'success' => true,
            'redirect' => route('profile.index', ['id' => $id])
        ]);
    }

    public function updatePhoto(Request $request, $id): \Illuminate\Http\JsonResponse
    {
        $user = User::findOrFail($id);

        // Validação
        $validator = Validator::make($request->all(), [
            'profile_photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Verifica se a validação falhou
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        // Remove a foto antiga
        if ($user->getFirstMedia('users')) {
            $user->clearMediaCollection('users');
        }

        // Adiciona a nova foto
        $user->addMedia($request->file('profile_photo'))->toMediaCollection('users');

        return response()->json([
            'success' => true,
            'redirect' => route('profile.index', ['id' => $user->id])
        ]);
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
