<?php

namespace App\Http\Middleware;

use App\Role;
use Closure;
use Illuminate\Support\Facades\Gate;
use Auth;
use Session;
use Carbon\Carbon;
use DB;

class AuthGates
{
    public function handle($request, Closure $next)
    {
        $data = DB::table('close_member')->select('is_close_member')->first();
        if (Auth::guard('user')->check()) {
            if (Auth::user()->expired_at <= Carbon::now() || Auth::user()->expired_at==null) {
                Session::flush();
                Auth::guard('user')->logout();
                return redirect('/login');
                // return 'Masuk Middleware';
            }
            elseif ($data->is_close_member == 1) {
                Session::flush();
                Auth::guard('user')->logout();
                return redirect('/login');
            }
        }
        return $next($request);
    }
}
