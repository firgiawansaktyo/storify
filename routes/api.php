<?php

use App\Http\Controllers\Api\ImageModalController;
use Illuminate\Support\Facades\Route;

Route::get('/images/{id}', [ImageModalController::class, 'show'])
     // ->middleware(['throttle:api','apikey'])
     ->name('images.show');
