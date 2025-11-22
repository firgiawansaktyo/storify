<?php

use App\Http\Controllers\Api\ImageModalController;
use Illuminate\Support\Facades\Route;

Route::middleware(['throttle:api', 'apikey'])
    ->get('pictures/{id}', [ImageModalController::class, 'show'])
    ->name('api.pictures.show');
