<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    protected function redirectTo($request)
    {
        if (Auth::guard('user')->check()) {
            return redirect('/member');
        } else if(Auth::guard('nonmember')->check()) {
            return redirect()->route('member.explore');
        }
    }
    
}
