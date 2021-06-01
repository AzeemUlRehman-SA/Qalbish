<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendReferralCode extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $user_name;
    public $referral_code;

    public function __construct($user_name, $referral_code)
    {
        $this->user_name = $user_name;
        $this->referral_code = $referral_code;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.referral-code')
            ->with([
                'referral_code' => $this->referral_code,
                'user_name' => $this->user_name
            ]);
    }
}
