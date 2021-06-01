<?php

namespace App\Listener;

use App\Events\RegisterEmail;
use App\Mail\RegisterUserEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendRegisterEmail implements ShouldQueue
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
     * @param  RegisterEmail  $event
     * @return void
     */
    public function handle(RegisterEmail $event)
    {
        Mail::to($event->email)->send(new RegisterUserEmail($event));
    }
}
