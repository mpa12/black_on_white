<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPasswordEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function build()
    {
        return $this->view('emails.reset_password')->with([
            'user' => $this->user,
            'href' => url('/reset-password', $this->user->remember_token)
        ])->subject('Восстановление пароля');
    }
}
