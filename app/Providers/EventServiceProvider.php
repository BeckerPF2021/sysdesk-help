<?php

namespace App\Providers;

use Illuminate\Auth\Events\Login;
use App\Listeners\SendLoginNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        Login::class => [
            SendLoginNotification::class,
        ],
    ];

    public function boot(): void
    {
        //
    }
}
