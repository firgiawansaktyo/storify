<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SecurityHeaders
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        $csp = "default-src 'self'; script-src 'self' https://sweetvows.site; style-src 'self' https://sweetvows.site; img-src 'self' https://sweetvows.site; font-src 'self' https://sweetvows.site; form-action 'self'; frame-ancestors 'none'; connect-src 'self' https://sweetvows.site; child-src 'none'; object-src 'none'; base-uri 'self'; manifest-src 'self'; worker-src 'self';";

        if (env('APP_ENV') === 'local') {
            $csp = "default-src 'self'; script-src 'self' 'unsafe-eval' http://localhost:5173 http://localhost:8000; style-src 'self' http://localhost:5173 http://localhost:8000; img-src 'self'; font-src 'self'; form-action 'self'; frame-ancestors 'none'; connect-src 'self' http://localhost:5173 http://localhost:8000; child-src 'none'; object-src 'none'; base-uri 'self'; manifest-src 'self'; worker-src 'self';";
        }

        $response->headers->set('Content-Security-Policy', $csp);

        $response->headers->set('X-Frame-Options', 'DENY');
        $response->headers->set('X-Content-Type-Options', 'nosniff'); 

        return $response;
    }
}
