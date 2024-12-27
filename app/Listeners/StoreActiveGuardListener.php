<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Authenticated;
use Session;

class StoreActiveGuardListener
{
    public function __construct()
    {
    }

    public function handle(Authenticated $event): void
    {
        Session::put('current_active_guard', $event->guard);
    }
}
