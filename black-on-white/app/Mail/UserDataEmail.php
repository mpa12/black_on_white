<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserDataEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(public User $user, public string $password)
    {
        //
    }

    public function build(): UserDataEmail
    {
        return $this->view('emails.user_data')->with([
            'user' => $this->user,
            'password' => $this->password,
        ])->subject('Добро пожаловать');
    }
}
