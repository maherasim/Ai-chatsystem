<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserWelcomeMail extends Mailable
{
    use Queueable, SerializesModels;

    public User $user;
    public string $rawPassword;

    public function __construct(User $user, string $rawPassword)
    {
        $this->user = $user;
        $this->rawPassword = $rawPassword;
    }

    public function build()
    {
        $type = $this->user->type;
        $isSubadmin = $type === 'subadmin';
        $subject = $isSubadmin ? 'Your Subadmin Account Details' : 'Welcome! Your Account Details';
        $loginLink = $isSubadmin ? 'https://logiadmin.it-supportline.de/' : 'https://logiteam.it-supportline.de/login/';

        return $this->subject($subject)
            ->view('emails.user_welcome')
            ->with([
                'user' => $this->user,
                'rawPassword' => $this->rawPassword,
                'loginLink' => $loginLink,
                'isSubadmin' => $isSubadmin,
            ]);
    }
}

