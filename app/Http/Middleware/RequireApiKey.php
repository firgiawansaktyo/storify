<?php

namespace App\Http\Middleware;

use Closure;

class RequireApiKey
{
    public function handle($request, Closure $next)
    {
        if ($request->header('X-API-KEY') !== env('PUBLIC_API_KEY')) {
            return response()->json(['message' => 'Invalid API key'], 403);
        }
        return $next($request);
    }
}
