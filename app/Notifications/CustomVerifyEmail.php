<?php
namespace App\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\URL;

class CustomVerifyEmail extends VerifyEmail
{
    public function toMail($notifiable)
    {
        $verificationUrl = $this->verificationUrl($notifiable);

        return (new MailMessage)
            ->subject('Vérifiez votre adresse e-mail')
            ->greeting('Bonjour ' . $notifiable->name)
            ->line('Un compte a été créé pour vous dans la plateforme.')
            ->line('Voici vos informations de connexion :')
            ->line('📧 Email : ' . $notifiable->email)
            ->line('🔐 Mot de passe : ' . $notifiable->plain_password)
            ->line('Veuillez vérifier votre adresse email pour activer votre compte.')
            ->action('Vérifier mon adresse email', $verificationUrl)
            ->line('Après vérification, vous pourrez vous connecter avec ces identifiants.');
    }

    protected function verificationUrl($notifiable)
    {
        return URL::temporarySignedRoute(
            'verification.verify',
            Carbon::now()->addMinutes(60),
            ['id' => $notifiable->getKey(), 'hash' => sha1($notifiable->getEmailForVerification())]
        );
    }
}

