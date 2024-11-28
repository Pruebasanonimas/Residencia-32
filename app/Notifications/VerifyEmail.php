<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail as BaseVerifyEmail;

class VerifyEmail extends BaseVerifyEmail
{
    public function toMail($notifiable)
    {
        $url = url('alumno/verify/' . $notifiable->getKey() . '/' . sha1($notifiable->getEmailForVerification()));

        return (new \Illuminate\Notifications\Messages\MailMessage)
                    ->subject('Verifica tu correo')
                    ->line('Haz clic en el botón a continuación para verificar tu dirección de correo electrónico.')
                    ->action('Verificar Correo', $url)
                    ->line('Si no creaste una cuenta, no es necesario hacer nada.');
    }
}
