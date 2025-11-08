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

        // Default CSP for production (allow resources from sweetvows.site)
        $csp = "default-src 'self'; script-src 'self' https://sweetvows.site; style-src 'self' https://sweetvows.site; img-src 'self' https://sweetvows.site; font-src 'self' https://sweetvows.site; form-action 'self'; frame-ancestors 'none'; connect-src 'self' https://sweetvows.site; child-src 'none'; object-src 'none'; base-uri 'self'; manifest-src 'self'; worker-src 'self';";

        // In development, allow Vite resources from localhost:5173
        if (env('APP_ENV') === 'local') {
            $csp = "default-src 'self'; script-src 'self' 'unsafe-eval' http://localhost:5173 http://localhost:8000; style-src 'self' http://localhost:5173 http://localhost:8000; img-src 'self'; font-src 'self'; form-action 'self'; frame-ancestors 'none'; connect-src 'self' http://localhost:5173 http://localhost:8000; child-src 'none'; object-src 'none'; base-uri 'self'; manifest-src 'self'; worker-src 'self';";
        }

        // Set the CSP header
        $response->headers->set('Content-Security-Policy', $csp);

        // Set other security headers
        $response->headers->set('X-Frame-Options', 'DENY');  // Prevent clickjacking
        $response->headers->set('X-Content-Type-Options', 'nosniff');  // Prevent MIME sniffing

        return $response;
    }
}
