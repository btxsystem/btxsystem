<?php

namespace App\Http\Middleware;

use Closure;

class EbookMiddleware
{
    public function handle($request, Closure $next)
    {
        if (\Auth::guard('nonmember')->user() == false) {
          return redirect()->route('member.explore');
        }

        return $next($request);
        
    }
    
}
