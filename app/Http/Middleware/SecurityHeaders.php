<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SecurityHeaders
{
    public function handle(Request $request, Closure $next)
{
    $response = $next($request);
    $isViteDev = file_exists(public_path('hot'));
    $site = "https://sweetvows.site";

    if ($isViteDev) {
        $csp = implode(' ', [
            "default-src 'self';",
            "script-src 'self' 'unsafe-eval' 'unsafe-inline' http://localhost:5173 http://localhost:8000 $site;",
            "style-src 'self' 'unsafe-inline' http://localhost:5173 http://localhost:8000 $site https://fonts.bunny.net;",
            "img-src 'self' data: blob: http://localhost:5173 http://localhost:8000 $site;",
            "font-src 'self' data: http://localhost:5173 https://fonts.bunny.net;",
            "connect-src 'self' http://localhost:5173 ws://localhost:5173 http://localhost:8000 $site;",
            "frame-src 'none';",
            "frame-ancestors 'none';",         
            "form-action 'self';",              
            "object-src 'none';",
            "base-uri 'self';",
            "manifest-src 'self';",
            "worker-src 'self' blob:;",
        ]);
    } else {
        $csp = implode(' ', [
            "default-src 'self';",
            "script-src 'self' $site;",
            "style-src 'self' $site https://fonts.bunny.net;",
            "img-src 'self' data: blob: $site;",
            "font-src 'self' data: https://fonts.bunny.net;",
            "connect-src 'self' $site;",
            "frame-src 'none';",
            "frame-ancestors 'none';",          
            "form-action 'self';",              
            "object-src 'none';",
            "base-uri 'self';",
            "manifest-src 'self';",
            "worker-src 'self';",
        ]);
    }

    $response->headers->set('Content-Security-Policy', $csp);
    $response->headers->set('X-Frame-Options', 'DENY');
    $response->headers->set('X-Content-Type-Options', 'nosniff');

    if (config('app.env') === 'production') {
        $response->headers->set('Strict-Transport-Security', 'max-age=31536000; includeSubDomains; preload');
    }

    return $response;
}
}
