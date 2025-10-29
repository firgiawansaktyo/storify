<?php
require __DIR__ . '/../vendor/autoload.php';

use Illuminate\Http\Request;
use Illuminate\Routing\Router;

$app = require __DIR__ . '/../bootstrap/app.php';
$router = $app['router'];

$router->get('/', function () {
    return response()->json(['message' => 'Hello, World!']);
});

$response = $router->dispatch(Request::capture());
echo $response->getContent();
