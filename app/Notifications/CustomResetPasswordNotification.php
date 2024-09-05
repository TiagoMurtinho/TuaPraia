<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CustomResetPasswordNotification extends Notification
{
    use Queueable;

    private $token;

    /**
     * Create a new notification instance.
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $expiration = config('auth.passwords.users.expire', 5);
        $appName = config('app.name');

        return (new MailMessage)
                    ->subject(__('reset-password.subject'))
                    ->greeting(__('reset-password.greeting'))
                    ->line( __ ('reset-password.introduction'))
                    ->action( __('reset-password.button'), url('password/reset', $this->token))
                    ->line( __('reset-password.expire', ['count' => $expiration]))
                    ->line( __('reset-password.no_request'))
                    ->line(__('reset-password.salutation'))
                    ->salutation($appName);

    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
