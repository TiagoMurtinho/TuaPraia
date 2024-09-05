<?php

namespace App\Providers;

use App\Notifications\CustomVerifyEmail;
use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Notifications\VerifyEmail as VerifyEmailNotification;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {

        VerifyEmailNotification::toMailUsing(function ($notifiable, $url) {
            return (new CustomVerifyEmail)->toMail($notifiable);
        });
    }
}
