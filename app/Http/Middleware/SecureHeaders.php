<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecureHeaders
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        $isLocal = app()->environment('local');
        $viteHttp = 'http://localhost:5173';
        $viteWs   = 'ws://localhost:5173';

        // --- CSP Configuration ---
        $csp = "default-src 'self'; ";

        // script-src
        $csp .= "script-src 'self'";
        if ($isLocal) {
            $csp .= " 'unsafe-inline' 'unsafe-eval' $viteHttp";
        }
        $csp .= "; ";

        // style-src
        $csp .= "style-src 'self'";
        if ($isLocal) {
            $csp .= " 'unsafe-inline' $viteHttp";
        }
        $csp .= " https://fonts.googleapis.com; ";

        // font-src
        $csp .= "font-src 'self' $viteHttp https://fonts.gstatic.com; ";

        // img-src
        $csp .= "img-src 'self' data:; ";

        // connect-src
        $csp .= "connect-src 'self'";
        if ($isLocal) {
            $csp .= " $viteWs $viteHttp";
        }
        $csp .= "; ";

        $csp .= "frame-src 'self' https://www.google.com https://www.youtube.com; ";

        $csp .= "frame-ancestors 'none'; ";

        $csp .= "form-action 'self'; ";

        $response->headers->set('Content-Security-Policy', $csp);

        $response->headers->set('X-Frame-Options', 'DENY');
        $response->headers->set('X-Content-Type-Options', 'nosniff');
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');
        $response->headers->set('Permissions-Policy', 'geolocation=(), camera=(), microphone=()');
        $response->headers->set('Strict-Transport-Security', 'max-age=31536000; includeSubDomains; preload');
        $response->headers->remove('X-Powered-By');

        return $response;
    }
}
