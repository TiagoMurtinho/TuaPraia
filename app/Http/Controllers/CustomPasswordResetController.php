<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CustomPasswordResetController extends Controller
{
    public function reset(Request $request): JsonResponse
    {
        // Validação dos dados do formulário
        $validator = \Validator::make($request->all(), [
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed',
        ]);

        // Se a validação falhar, retorne erros de validação
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422); // Status HTTP 422 Unprocessable Entity
        }

        // Tentativa de resetar a senha
        $response = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->password = Hash::make($password);
                $user->setRememberToken(Str::random(60));
                $user->save();
            }
        );

        // Verifica se a senha foi resetada com sucesso
        if ($response == Password::PASSWORD_RESET) {
            return response()->json([
                'success' => true,
                'redirect' => route('home') . '?message_key=password_reset_success'
            ]);
        } else {
            return response()->json([
                'errors' => [
                    'email' => __($response) // Mensagem de erro específica
                ]
            ], 422); // Status HTTP 422 Unprocessable Entity
        }
    }
}
