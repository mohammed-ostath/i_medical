<?php

namespace App\Listeners;

use App\Events\RegisterEvent;
use App\Mail\RegisterMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class RegisterListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(RegisterEvent $event): void
    {
        $data = [
            'name' => $event->user->name,
            'email' => $event->user->email,
        ];
        Mail::to($event->user->email)->send(new RegisterMail($data));
    }
}
