<?php

use App\Http\Controllers\Api\ImageModalController;
use Illuminate\Support\Facades\Route;

Route::middleware(['throttle:api', 'apikey'])
    ->get('images/{id}', [ImageModalController::class, 'show'])
    ->name('api.images.show');
