<?php

namespace App\Listeners;

use App\Events\RegisterConfirmationEvent;
use App\Mail\RegisterConfirmationMail;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

class RegisterConfirmationListener
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
     * @param  \App\Events\RegisterConfirmationEvent  $event
     * @return void
     */
    public function handle(RegisterConfirmationEvent $event)
    {
        $user = User::query()->findOrFail($event->id);
        $url = URL::temporarySignedRoute('register.confirmation', now()->addMonths(3), ['id' => $user->id, 'token' => $user->confirmation_token]);
        Mail::to($user->email)->send(new RegisterConfirmationMail($url));
    }
}
