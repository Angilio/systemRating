<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class SendStudentPassword extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $motDePasse;

    /**
     * Create a new message instance.
     */
    public function __construct(User $user, $motDePasse)
    {
        $this->user = $user;
        $this->motDePasse = $motDePasse;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Votre compte étudiant')
                    ->markdown('emails.student.password');
    }
}
