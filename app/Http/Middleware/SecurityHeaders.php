<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SecurityHeaders
{
    public function handle(Request $request, Closure $next) {
        $response = $next($request);

        $csp = [
            "default-src 'self'",
            "base-uri 'self'",
            "img-src 'self' data: https:",
            "font-src 'self' https://fonts.bunny.net",
            "style-src 'self' 'unsafe-inline' https://fonts.bunny.net",
            "script-src 'self' 'unsafe-inline' 'unsafe-eval'",
            "connect-src 'self'",
            "frame-ancestors 'none'",
            "form-action 'self'",
            "object-src 'none'",
            "upgrade-insecure-requests",
        ];

        $response->headers->set('Content-Security-Policy', implode('; ', $csp));
        $response->headers->set('X-Frame-Options', 'DENY');

        return $response;
    }
}
