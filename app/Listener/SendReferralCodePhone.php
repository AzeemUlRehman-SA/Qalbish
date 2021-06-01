<?php

namespace App\Listener;

use App\Helpers\SendSms;
use App\Events\SendReferralCodeWithPhone;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendReferralCodePhone extends SendSms
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
     * @param SendReferralCodeWithPhone $event
     * @return void
     */
    public function handle(SendReferralCodeWithPhone $event)
    {

        $this->sendSMS($event->phone_number, $event->message);
    }
}
