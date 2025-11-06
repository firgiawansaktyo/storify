<?php
require __DIR__ . '/../public/index.php';
require __DIR__.'/../vendor/autoload.php';

// Set up the Laravel application
$app = require_once __DIR__.'/../bootstrap/app.php';

// Run the Laravel application
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

// Send the response to Vercel
$response->send();
$kernel->terminate($request, $response);