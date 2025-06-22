<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\MessageController;

Route::get('/', [GameController::class, 'index']);

Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'showLoginForm')->name('login');
    Route::post('/login', 'login');
    Route::get('/logout', 'logout');
});

Route::controller(RegisterController::class)->group(function () {
    Route::get('/register', 'showRegistrationForm');
    Route::post('/register', 'register');
});

Route::get('/games', [GameController::class, 'index']);
Route::get('/games/{game}', [GameController::class, 'show']);

Route::controller(MessageController::class)->prefix('messages')->group(function () {
    Route::get('/', 'index');
    Route::get('/create', 'create');
    Route::post('/', 'store');
    Route::get('/{messageGlue}', 'show');
    Route::delete('/{messageGlue}', 'destroy');
});
