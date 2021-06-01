<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RegisterUserEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $email;
    public $password;
    public function __construct($event)
    {
        $this->email = $event->email;
        $this->password = $event->password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.register-email')
            ->with([
                'email' => $this->email,
                'password' => $this->password
            ]);
    }
}
