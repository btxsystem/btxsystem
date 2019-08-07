<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard('user')->check()) {
            return redirect()->route('member.dashboard');
        } 
        
        return $next($request);
    }
}
