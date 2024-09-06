<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'email' => 'required', 'email',
        ]);

        // Tentamos enviar o link de redefinição de senha
        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status == Password::RESET_LINK_SENT) {
            return response()->json([
                'success' => true,
                'redirect' => route('home', absolute: false) . '?message_key=mail_sent'
            ]);
        } else {
            return response()->json([
                'error' => __('We cannot find a user with that e-mail address.'),
            ], 422); // Status HTTP 422 Unprocessable Entity
        }
    }
}
