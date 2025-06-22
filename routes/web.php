<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PreferencesController;

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
Route::get('/games/create', [GameController::class, 'create']);
Route::post('/games', [GameController::class, 'store']);
Route::match(['get','post'], '/games/{game}/join', [GameController::class, 'join']);
Route::get('/games/{game}', [GameController::class, 'show']);

Route::controller(ChatController::class)->prefix('chat')->group(function () {
    Route::get('/{game?}', 'index');
    Route::get('/{game?}/messages', 'fetch');
    Route::post('/{game?}', 'store');
});

Route::controller(MessageController::class)->prefix('messages')->group(function () {
    Route::get('/', 'index');
    Route::get('/create', 'create');
    Route::post('/', 'store');
    Route::get('/{messageGlue}', 'show');
    Route::delete('/{messageGlue}', 'destroy');
});

Route::controller(ProfileController::class)->group(function () {
    Route::get('/profile', 'edit');
    Route::post('/profile', 'update');
});

Route::controller(PreferencesController::class)->group(function () {
    Route::get('/prefs', 'edit');
    Route::post('/prefs', 'update');
});
