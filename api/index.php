<?php

// This is the Laravel entry point for Vercel

require __DIR__ . '/../vendor/autoload.php'; // Autoload the dependencies

$app = require_once __DIR__.'/../bootstrap/app.php'; // Initialize the Laravel app

// Create the HTTP kernel to handle the request
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

// Capture the incoming request
$request = Illuminate\Http\Request::capture();

// Handle the request
$response = $kernel->handle($request);

// Send the response back to the client
$response->send();

// Terminate the kernel (clean up, close sessions, etc.)
$kernel->terminate($request, $response);
