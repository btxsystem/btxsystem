<?php

namespace App\Http\Middleware;

// use Illuminate\Auth\Middleware\Employeer as Middleware;

use Closure;

class Employeer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (! $request->expectsJson()) {
            return view('frontend.account.profile');
        }
    }
}
