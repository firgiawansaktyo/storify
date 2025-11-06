<?php

use App\Http\Controllers\AlbumController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CoupleController;
use App\Http\Controllers\FileUploadController;
use App\Http\Controllers\InvitedGuestController;
use App\Http\Controllers\ThrowbackController;
use App\Http\Controllers\TimelineController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WeddingController;
use App\Http\Controllers\WishController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/{username}/invite/{id}', [HomeController::class, 'index'])
    ->where([
        'username' => '[A-Za-z0-9_]+',
        'inviteCode' => '[A-Za-z0-9\-]+',
    ])
    ->name('home');

Route::post('wishes/{user_id}', [WishController::class, 'store'])
    ->name('wishes.store');

Route::get('/wishes-json/{user_id}', [WishController::class, 'json'])->name('wishes.json');

Route::get('/cpanel/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/cpanel/login', [AuthController::class, 'login']);
Route::post('/cpanel/logout', [AuthController::class, 'logout'])->name('logout');

Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::resource('albums', AlbumController::class);
    Route::post('upload/{path}', [FileUploadController::class, 'store'])
        ->where('path', '.*')
        ->name('upload.store');
    Route::resource('users', UserController::class);
    Route::resource('weddings', WeddingController::class);
    Route::resource('timelines', TimelineController::class);
    Route::resource('couples', CoupleController::class);
    Route::resource('invited-guests', InvitedGuestController::class);
    Route::post('/import', [InvitedGuestController::class, 'import'])->name('import.handle');
    Route::resource('throwbacks', ThrowbackController::class);

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


