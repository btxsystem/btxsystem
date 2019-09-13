<?php

namespace App\Http\Middleware;

use App\Role;
use Closure;
use Illuminate\Support\Facades\Gate;
use Auth;
use Session;
use Carbon\Carbon;

class AuthGates
{
    public function handle($request, Closure $next)
    {
        // if (Auth::guard('user')->check()) {
        //     if (Auth::user()->expired_at <= Carbon::now() || Auth::user()->expired_at==null) {
        //         Session::flush();
        //         Auth::guard('user')->logout();
        //         return redirect('/login');
        //         // return 'Masuk Middleware';
        //     }
        // }
        
        return $next($request);
    }
}
