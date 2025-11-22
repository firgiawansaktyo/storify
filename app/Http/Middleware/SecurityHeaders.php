<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SecurityHeaders
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        // Common security headers
        $response->headers->set('X-Frame-Options', 'DENY');
        $response->headers->set('X-Content-Type-Options', 'nosniff');

        if (env('APP_ENV') === 'local') {
            // LOCAL DEV (Vite + Laravel)
            $csp = "default-src 'self'; "
                . "script-src 'self' http://localhost:5173 http://localhost:8000; "
                . "style-src 'self' http://localhost:5173 http://localhost:8000; "
                . "img-src 'self' data: blob: https://*.backblazeb2.com; "
                . "font-src 'self'; "
                . "form-action 'self'; "
                . "frame-ancestors 'none'; "
                . "connect-src 'self' ws://localhost:5173 http://localhost:5173 http://localhost:8000 https://*.backblazeb2.com; "
                . "child-src 'none'; "
                . "object-src 'none'; "
                . "base-uri 'self'; "
                . "manifest-src 'self'; "
                . "worker-src 'self';";
        } else {
            // PRODUCTION
            $csp = "default-src 'self'; "
                . "script-src 'self' https://sweetvows.site; "
                . "style-src 'self' https://sweetvows.site; "
                . "img-src 'self' data: blob: https://sweetvows.site https://*.backblazeb2.com; "
                . "font-src 'self' https://sweetvows.site; "
                . "form-action 'self'; "
                . "frame-ancestors 'none'; "
                . "connect-src 'self' https://sweetvows.site https://*.backblazeb2.com; "
                . "child-src 'none'; "
                . "object-src 'none'; "
                . "base-uri 'self'; "
                . "manifest-src 'self'; "
                . "worker-src 'self';";
        }

        $response->headers->set('Content-Security-Policy', $csp);

        return $response;
    }
}
