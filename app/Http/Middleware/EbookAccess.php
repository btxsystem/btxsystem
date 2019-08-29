<?php

namespace App\Http\Middleware;

use Closure;

class EbookAccess
{
    public function handle($request, Closure $next)
    {
        if (\Auth::guard('user')->user() || \Auth::guard('nonmember')->user()) {
          return $next($request);
        }

        return redirect()->route('member.explore');
        
    }
    
}
