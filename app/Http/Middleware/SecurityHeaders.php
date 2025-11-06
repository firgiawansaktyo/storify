<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SecurityHeaders
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        // Content Security Policy (CSP)
        $csp = [
            "default-src 'self'",
            "base-uri 'self'",
            "img-src 'self' data: https:",
            "font-src 'self' https://fonts.bunny.net",
            "style-src 'self' 'unsafe-inline' https://fonts.bunny.net",
            "script-src 'self' 'unsafe-inline' 'unsafe-eval'",
            "connect-src 'self'",
            "frame-ancestors 'none'", // Anti-clickjacking
            "form-action 'self'",
            "object-src 'none'",
            "upgrade-insecure-requests",
        ];
        $response->headers->set('Content-Security-Policy', implode('; ', $csp));

        // Other security headers
        $response->headers->set('X-Frame-Options', 'DENY');  // Anti-clickjacking
        $response->headers->set('X-Content-Type-Options', 'nosniff');  // Prevent MIME sniffing
        $response->headers->set('Referrer-Policy', 'no-referrer-when-downgrade');
        $response->headers->set('Permissions-Policy', 'accelerometer=(), camera=(), geolocation=(), gyroscope=(), microphone=(), payment=(), usb=()');
        
        // HSTS (Only after you are sure HTTPS is enforced everywhere)
        $response->headers->set('Strict-Transport-Security', 'max-age=31536000; includeSubDomains; preload');
        
        // Cache Control for dynamic HTML
        if (str_starts_with($response->headers->get('Content-Type') ?? '', 'text/html')) {
            $response->headers->set('Cache-Control', 'no-cache, no-store, must-revalidate, private');
            $response->headers->set('Pragma', 'no-cache');
            $response->headers->set('Expires', '0');
        }

        // Hide X-Powered-By
        if (function_exists('header_remove')) {
            @header_remove('X-Powered-By');
        }
        $response->headers->remove('X-Powered-By');

        return $response;
    }
}
