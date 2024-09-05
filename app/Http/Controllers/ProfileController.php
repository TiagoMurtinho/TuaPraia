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
        // Encontra o usuário ou retorna erro se não encontrar
        $user = User::findOrFail($id);

        // Validação dos dados recebidos
        $validator = Validator::make($request->all(), [
            'profile_name' => 'required|string|max:55', // Nome obrigatório e com limite de caracteres
        ], [
            // Mensagens personalizadas para a validação do nome
            'profile_name.required' => __('validation.custom.name.required'),
            'profile_name.string' => __('validation.custom.name.string'),
            'profile_name.max' => __('validation.custom.name.max'),
        ]);

        // Se a validação falhar, retorna os erros em formato JSON
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        // Atualiza o nome do usuário
        try {
            $user->name = $request->input('profile_name');
            $user->save();
        } catch (\Exception $e) {
            // Retorna um erro se a atualização falhar
            return response()->json([
                'message' => __('validation.custom.name.update_failed') // Mensagem de erro traduzida
            ], 500);
        }

        // Retorna uma resposta JSON com sucesso
        return response()->json([
            'success' => true,
            'message' => __('validation.custom.name.updated_successfully'), // Mensagem de sucesso traduzida
            'redirect' => route('profile.index', ['id' => $user->id])
        ]);
    }

    public function updateEmail(Request $request, $id): \Illuminate\Http\JsonResponse
    {
        // Validação dos dados recebidos
        $validator = Validator::make($request->all(), [
            'profile_email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email,' . $id,
            ],
        ], [
            // Mensagens personalizadas para a validação do e-mail
            'profile_email.required' => __('validation.custom.email.required'),
            'profile_email.email' => __('validation.custom.email.email'),
            'profile_email.max' => __('validation.custom.email.max'),
            'profile_email.unique' => __('validation.custom.email.unique'),
        ]);

        // Se a validação falhar, retorna os erros em formato JSON
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        // Atualiza o e-mail do usuário
        $user = User::findOrFail($id);
        $user->email = $request->input('profile_email');
        $user->save();

        return response()->json([
            'success' => true,
            'message' => __('validation.custom.email.success_updated'), // Mensagem de sucesso traduzida
            'redirect' => route('profile.index', ['id' => $id])
        ]);
    }

    public function updatePassword(Request $request, $id): \Illuminate\Http\JsonResponse
    {
        // Validação dos dados recebidos
        $validator = Validator::make($request->all(), [
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ], [
            // Mensagens personalizadas para a validação da senha
            'current_password.required' => __('validation.custom.current_password.required'),
            'new_password.required' => __('validation.custom.new_password.required'),
            'new_password.string' => __('validation.custom.new_password.string'),
            'new_password.min' => __('validation.custom.new_password.min'),
            'new_password.confirmed' => __('validation.custom.new_password.confirmed'),
        ]);

        // Se a validação falhar, retorna os erros em formato JSON
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
                    'current_password' => [__('validation.custom.current_password.incorrect')]
                ]
            ], 422);
        }

        // Atualiza a senha do usuário
        $user->password = Hash::make($request->input('new_password'));
        $user->save();

        // Retorna uma resposta JSON com sucesso
        return response()->json([
            'success' => true,
            'message' => __('validation.custom.password.updated_successfully'), // Mensagem de sucesso traduzida
            'redirect' => route('profile.index', ['id' => $id])
        ]);
    }

    public function updatePhoto(Request $request, $id): \Illuminate\Http\JsonResponse
    {
        // Encontra o usuário ou retorna erro se não encontrar
        $user = User::findOrFail($id);

        // Validação dos dados recebidos
        $validator = Validator::make($request->all(), [
            'media' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'media.image' => __('validation.custom.media.image'),
            'media.mimes' => __('validation.custom.media.mimes'),
            'media.max' => __('validation.custom.media.max'),
        ]);

        // Se a validação falhar, retorna os erros em formato JSON
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        // Remove a foto antiga, se existir
        if ($user->getFirstMedia('users')) {
            $user->clearMediaCollection('users');
        }

        // Adiciona a nova foto
        $user->addMedia($request->file('media'))->toMediaCollection('users');

        // Retorna uma resposta JSON com sucesso
        return response()->json([
            'success' => true,
            'message' => __('profile.photo_updated_successfully'), // Mensagem de sucesso traduzida
            'redirect' => route('profile.index', ['id' => $user->id])
        ]);
    }

    /**
     * Delete the user's account.
     */
    /*public function destroy(Request $request, $id): RedirectResponse
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
    }*/

    public function destroy(Request $request, $id)
    {
        $user = User::findOrFail($id); // Encontre o usuário pelo ID

        // Validação
        $request->validate([
            'password' => 'required',
        ]);

        // Verificação da senha
        if (!Hash::check($request->password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Senha incorreta. A conta não foi apagada.'
            ], 400); // 400 Bad Request
        }

        // Logout e exclusão do usuário
        Auth::logout();
        $user->delete();

        // Retornar resposta JSON
        return response()->json([
            'success' => true,
            'redirect' => route('home') . '?message_key=account_deleted'
        ]);
    }

}
