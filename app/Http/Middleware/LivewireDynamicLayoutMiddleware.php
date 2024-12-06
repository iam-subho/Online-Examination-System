<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class LivewireDynamicLayoutMiddleware
{
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            config(['livewire.layout' => 'layouts.app']);
        } else {
            config(['livewire.layout' => 'layouts.guest']);
        }

        return $next($request);
    }
}




