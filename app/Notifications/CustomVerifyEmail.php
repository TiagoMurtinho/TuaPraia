<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Auth\Notifications\VerifyEmail as VerifyEmailNotification;
use Illuminate\Support\Facades\Log;

class CustomVerifyEmail extends VerifyEmailNotification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via($notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable): MailMessage
    {
        Log::info('CustomVerifyEmail toMail method called.');

        $appName = config('app.name');

        return (new MailMessage)
            ->subject( __('verify-email.subject'))
            ->greeting( __('verify-email.greeting'))
            ->line( __('verify-email.introduction'))
            ->action( __('verify-email.button'), $this->verificationUrl($notifiable))
            ->line( __('verify-email.no_create'))
            ->line( __('verify-email.salutation'))
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
