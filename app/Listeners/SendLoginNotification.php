<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Mail;

class SendLoginNotification
{
    public function handle(Login $event): void
    {
        $user = $event->user;

        if ($user->email === '194749@upf.nr') {
            Mail::raw("Olá {$user->name}, você acabou de fazer login no sistema.", function ($message) use ($user) {
                $message->to($user->email)
                        ->subject('Login Detectado');
            });
        }
    }

}
