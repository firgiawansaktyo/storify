<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SecurityHeaders
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);
        $response->headers->set('X-Frame-Options', 'DENY');
        $response->headers->set('X-Content-Type-Options', 'nosniff');

        if (env('APP_ENV') === 'local') {
            $csp = "default-src 'self'; "
                . "script-src 'self' 'unsafe-eval' 'unsafe-inline' http://localhost:5173 http://localhost:8000; "
                . "style-src 'self' 'unsafe-inline' http://localhost:5173 http://localhost:8000; "
                . "img-src 'self' data: blob: https://*.backblazeb2.com http://localhost:8000; "
                . "media-src 'self' https://*.backblazeb2.com; "
                . "font-src 'self'; "
                . "connect-src 'self' ws://localhost:5173 http://localhost:5173 http://localhost:8000 https://*.backblazeb2.com; "
                . "frame-src 'self' https://www.google.com https://*.google.com; "
                . "child-src 'self' https://www.google.com https://*.google.com; "
                . "frame-ancestors 'none'; "
                . "form-action 'self'; "
                . "object-src 'none'; "
                . "base-uri 'self'; "
                . "manifest-src 'self'; "
                . "worker-src 'self';";

        } else {
            $csp = "default-src 'self'; "
                . "script-src 'self' 'unsafe-eval' 'unsafe-inline' "
                . "https://sweetvows.site "
                . "https://cdn.sweetvows.site "
                . "https://static.cloudflareinsights.com; "
                . "style-src 'self' 'unsafe-inline' https://sweetvows.site https://cdn.sweetvows.site; "
                . "img-src 'self' data: blob: https://sweetvows.site https://cdn.sweetvows.site https://*.backblazeb2.com; "
                . "media-src 'self' https://cdn.sweetvows.site https://*.backblazeb2.com; "
                . "font-src 'self' https://sweetvows.site https://cdn.sweetvows.site; "
                . "connect-src 'self' https://sweetvows.site https://cdn.sweetvows.site https://*.backblazeb2.com https://static.cloudflareinsights.com; "
                . "frame-src 'self' https://www.google.com https://*.google.com; "
                . "child-src 'self' https://www.google.com https://*.google.com; "
                . "frame-ancestors 'none'; "
                . "form-action 'self'; "
                . "object-src 'none'; "
                . "base-uri 'self'; "
                . "manifest-src 'self'; "
                . "worker-src 'self';";
        }

        $response->headers->set('Content-Security-Policy', $csp);

        return $response;
    }
}
