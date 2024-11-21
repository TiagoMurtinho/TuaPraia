<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Validation\ValidationException;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            // Validação dos dados
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
                'media' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            ]);

            // Criação do usuário
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            // Adiciona mídia, se fornecida
            if ($request->hasFile('media')) {
                $user->addMediaFromRequest('media')->toMediaCollection('users');
            }

            // Dispara o evento de registro
            event(new Registered($user));

            // Loga o usuário
            Auth::login($user);

            return response()->json([
                'success' => true,
                'redirect' => route('home', absolute: false) . '?message_key=register_success'
            ]);
        } catch (ValidationException $e) {
            // Captura exceções de validação e retorna erros personalizados no formato JSON
            $errors = $e->errors();
            $formattedErrors = [];

            // Formata erros específicos de cada campo
            foreach ($errors as $field => $messages) {
                $formattedErrors[$field] = $messages;
            }

            return response()->json([
                'errors' => $formattedErrors
            ], 422);
        } catch (\Exception $e) {
            // Captura qualquer outra exceção e retorna uma mensagem genérica de erro
            return response()->json([
                'message' => 'Ocorreu um erro inesperado. Tente novamente mais tarde.'
            ], 500);
        }
    }
}
