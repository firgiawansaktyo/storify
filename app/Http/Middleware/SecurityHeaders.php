<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SecurityHeaders
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        if (env('APP_ENV') === 'local') {
            $csp = "default-src 'self'; "
                . "script-src 'self' 'unsafe-eval' http://localhost:5173 http://localhost:8000; "
                . "style-src 'self' http://localhost:5173 http://localhost:8000; "
                . "img-src 'self' data: blob: https://sweetvows.s3.us-east-005.backblazeb2.com https://s3.us-east-005.backblazeb2.com https://*.s3.us-east-005.backblazeb2.com; "
                . "font-src 'self'; "
                . "form-action 'self'; "
                . "frame-ancestors 'none'; "
                . "connect-src 'self' http://localhost:5173 http://localhost:8000 https://sweetvows.s3.us-east-005.backblazeb2.com https://s3.us-east-005.backblazeb2.com https://*.s3.us-east-005.backblazeb2.com; "
                . "child-src 'none'; "
                . "object-src 'none'; "
                . "base-uri 'self'; "
                . "manifest-src 'self'; "
                . "worker-src 'self';";
        } else {
            $csp = "default-src 'self'; "
                . "script-src 'self' https://sweetvows.site https://sweetvows.s3.us-east-005.backblazeb2.com; "
                . "style-src 'self' https://sweetvows.site https://sweetvows.s3.us-east-005.backblazeb2.com; "
                . "img-src 'self' data: blob: https://sweetvows.site https://sweetvows.s3.us-east-005.backblazeb2.com https://s3.us-east-005.backblazeb2.com https://*.s3.us-east-005.backblazeb2.com; "
                . "font-src 'self' https://sweetvows.site https://sweetvows.s3.us-east-005.backblazeb2.com; "
                . "form-action 'self'; "
                . "frame-ancestors 'none'; "
                . "connect-src 'self' https://sweetvows.site https://sweetvows.s3.us-east-005.backblazeb2.com https://s3.us-east-005.backblazeb2.com https://*.s3.us-east-005.backblazeb2.com; "
                . "child-src 'none'; "
                . "object-src 'none'; "
                . "base-uri 'self'; "
                . "manifest-src 'self'; "
                . "worker-src 'self';";
        }

        $response->headers->set('Content-Security-Policy', $csp);
        $response->headers->set('X-Frame-Options', 'DENY');
        $response->headers->set('X-Content-Type-Options', 'nosniff');

        return $response;
    }
}
