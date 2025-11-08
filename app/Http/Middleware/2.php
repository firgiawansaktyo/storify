<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SecurityHeaders
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        // Default CSP for production (restricts resources to sweetvows.site and 'self')
        $csp = "default-src 'self'; "
             . "script-src 'self' https://sweetvows.site; "
             . "style-src 'self' https://sweetvows.site; "
             . "img-src 'self' https://sweetvows.site; "
             . "font-src 'self' https://sweetvows.site; "
             . "form-action 'self'; "
             . "frame-ancestors 'none'; "
             . "connect-src 'self' https://sweetvows.site; "
             . "child-src 'none'; "
             . "object-src 'none'; "
             . "base-uri 'self'; "
             . "manifest-src 'self'; "
             . "worker-src 'self';"
             . "script-src-elem 'self' https://sweetvows.site http://localhost:5173; "  // Explicitly allow script elements from Vite
             . "style-src-elem 'self' https://sweetvows.site http://localhost:5173;"; // Explicitly allow style elements from Vite

        // In development, allow Vite resources from localhost:5173
        if (env('APP_ENV') === 'local') {
            $csp = "default-src 'self'; "
                 . "script-src 'self' 'unsafe-eval' 'unsafe-inline' http://localhost:5173 http://localhost:8000; "
                 . "style-src 'self' 'unsafe-inline' http://localhost:5173 http://localhost:8000; "
                 . "img-src 'self'; "
                 . "font-src 'self' http://localhost:5173; "
                 . "form-action 'self'; "
                 . "frame-ancestors 'none'; "
                 . "connect-src 'self' http://localhost:5173 http://localhost:8000 ws://localhost:5173; "  // Allow WebSocket connections for Vite hot reloading
                 . "child-src 'none'; "
                 . "object-src 'none'; "
                 . "base-uri 'self'; "
                 . "manifest-src 'self'; "
                 . "worker-src 'self'; "
                 . "script-src-elem 'self' http://localhost:5173; "  // Allow Vite script elements
                 . "style-src-elem 'self' http://localhost:5173;";  // Allow Vite style elements
        }

        // Set the CSP header (ensure it's a single continuous string with no line breaks)
        $response->headers->set('Content-Security-Policy', $csp);

        // Set Anti-clickjacking Header
        $response->headers->set('X-Frame-Options', 'DENY');  // Prevent clickjacking

        // Set X-Content-Type-Options Header
        $response->headers->set('X-Content-Type-Options', 'nosniff');  // Prevent MIME sniffing

        // Enable Strict Transport Security (HSTS) for HTTPS (if applicable)
        if (env('APP_ENV') === 'production') {
            $response->headers->set('Strict-Transport-Security', 'max-age=31536000; includeSubDomains; preload');
        }

        // Set HttpOnly flag for cookies
        $response->headers->setCookie(cookie('XSRF-TOKEN', csrf_token(), 0, null, null, false, true)); // HttpOnly

        return $response;
    }
}
