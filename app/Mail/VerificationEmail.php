<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\URL;

class VerificationEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $verificationUrl;

    public function __construct(User $user)
    {
        $this->user = $user;
        $this->verificationUrl = URL::to('/verify-email/' . $this->user->VerificationToken);
        // $this->verificationUrl = URL::temporarySignedRoute(
        //     'verify.email',
        //     now()->addMinutes(60),
        //     ['token' => $this->user->verification_token]
        // );
    }

    public function build()
    {
        return $this->subject('Email Verification')
                    ->view('email.verify')
                    ->with([
                        'user' => $this->user,
                        'verificationUrl' => $this->verificationUrl
                    ]);
    }
}
