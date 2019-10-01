<?php

namespace App\Http\Middleware;

use Closure;

class BcaMiddleware
{
  public function handle($request, Closure $next)
  {
    if (\Auth::guard('api')->user() == false) {
      return response()->json([
        'ErrorCode' => 'ESB-14-011',
        'ErrorMessage' => [
          'Indonesian' => 'Service tidak ada',
          'English' => "Service doesn't exist"
        ]
      ], 400);
    }

    return $next($request);
      
  }
    
}
