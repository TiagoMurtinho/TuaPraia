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
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
                'photo' => ['nullable','image', 'mimes:jpeg,png,jpg,gif|max:2048'],
            ]);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            if ($request->hasFile('photo')) {
                $user->addMediaFromRequest('photo')->toMediaCollection('users');
            }

            event(new Registered($user));

            Auth::login($user);

            return response()->json(['success' => true, 'redirect' => route('home', absolute: false)]);
        } catch (ValidationException $e) {
            // Captura exceções de validação e retorna os erros no formato JSON
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            // Captura qualquer outra exceção e retorna uma mensagem genérica de erro
            return response()->json(['message' => 'An error occurred.'], 500);
        }
    }
}
