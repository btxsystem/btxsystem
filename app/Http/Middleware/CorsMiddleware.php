<?php
namespace App\Http\Middleware;

use Closure;

class CorsMiddleware
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
        $allowedOrigins = explode(",", env("ALLOW_IFRAME") ?? "http://staging.bitrexgo.id");

        $response = $next($request);
        
        foreach($allowedOrigins as $url) {
          $response->header('Content-Security-Policy', 'frame-ancestors '.$url);
        }

        return $response;
    }
}