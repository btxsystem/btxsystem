<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use DB;

class Authenticate extends Middleware
{
    protected function redirectTo($request)
    {
        $data = DB::table('close_member')->select('is_close_member')->first();
        if (Auth::guard('user')->check()) {
            if (Auth::user()->expired_at <= Carbon::now() || Auth::user()->expired_at==null) {
                Auth::guard('user')->logout();
                return view('frontend.expired-member');
            }
            elseif ($data->is_close_member == 1) {
                Auth::guard('user')->logout();
                return view('frontend.auth.maintenance');
            }
            return redirect('/member');
        } else if(Auth::guard('nonmember')->check()) {
            if ($data->is_close_member == 1) {
                Auth::guard('nonmember')->logout();
                return view('frontend.auth.maintenance');
            }
            return redirect()->route('member.explore');
        }
    }
    
}
