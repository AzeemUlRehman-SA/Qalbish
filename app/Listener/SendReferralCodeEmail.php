<?php

namespace App\Listener;

use App\Events\SendReferralCodeWithEmail;
use App\Mail\SendReferralCode;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendReferralCodeEmail implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  SendReferralCodeWithEmail  $event
     * @return void
     */
    public function handle(SendReferralCodeWithEmail $event)
    {
        Mail::to($event->send_to_email)->send(new SendReferralCode($event->user_name, $event->referral_code));
    }
}
