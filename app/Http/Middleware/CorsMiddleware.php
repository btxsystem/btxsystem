<?php
namespace App\Http\Middleware;

use Closure;
use Dotenv\Dotenv;

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
        $dotenv = Dotenv::create(public_path('../'), '.env');
        $dotenv->load();

        $allowedOrigins = explode(",", env("ALLOW_IFRAME") ?? "http://bitrexgo.co.id");

        $response = $next($request);

        // foreach($allowedOrigins as $url) {
        //   $response->header('Content-Security-Policy', 'frame-ancestors '.$url);
        // }

        return $response;
    }
}
