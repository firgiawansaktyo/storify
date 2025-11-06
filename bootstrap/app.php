<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\RequireApiKey;
use App\Http\Middleware\SecurityHeaders;
use App\Http\Middleware\Cors;
use Vinkla\Hashids\Facades\Hashids;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware
        // ->append(SecurityHeaders::class)
        // ->append(Cors::class)
        ->alias([
            'apikey' => RequireApiKey::class,
        ]);
        $middleware->trustProxies(at: '*');
    })
    ->withProviders([
        App\Providers\AppServiceProvider::class,
        App\Providers\RouteServiceProvider::class,
    ])
    ->withExceptions(function (Exceptions $exceptions): void {
        // Handle exceptions
    })->create();
