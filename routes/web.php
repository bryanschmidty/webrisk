<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AdminController,
    ArchiveController,
    AuthController,
    ChatController,
    GameController,
    HistoryController,
    MessageController,
    PreferencesController,
    ProfileController,
    RegisterController,
    StatsController,
};

Route::get('/', [GameController::class, 'index'])->name('home');

Route::get('/archive', [ArchiveController::class, 'index'])->name('archive.index');

Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'showLoginForm')->name('login');
    Route::post('/login', 'login')->name('login.perform');
    Route::get('/logout', 'logout')->name('logout');
});

Route::controller(RegisterController::class)->group(function () {
    Route::get('/register', 'showRegistrationForm')->name('register');
    Route::post('/register', 'register')->name('register.perform');
});

Route::prefix('games')->group(function () {
    Route::get('/', [GameController::class, 'index'])->name('games.index');
    Route::get('create', [GameController::class, 'create'])->name('games.create');
    Route::post('/', [GameController::class, 'store'])->name('games.store');
    Route::match(['get', 'post'], '{game}/join', [GameController::class, 'join'])->name('games.join');
    Route::get('{game}', [GameController::class, 'show'])->name('games.show');
    Route::post('{game}/nudge', [GameController::class, 'nudge'])->name('games.nudge');
    Route::get('{game}/history', [HistoryController::class, 'index'])->name('history.index');
});

Route::prefix('chat')->controller(ChatController::class)->group(function () {
    Route::get('/{game?}', 'index')->name('chat.index');
    Route::get('/{game?}/messages', 'fetch')->name('chat.fetch');
    Route::post('/{game?}', 'store')->name('chat.store');
});

Route::prefix('messages')->controller(MessageController::class)->group(function () {
    Route::get('/', 'index')->name('messages.index');
    Route::get('/create', 'create')->name('messages.create');
    Route::post('/', 'store')->name('messages.store');
    Route::get('/{messageGlue}', 'show')->name('messages.show');
    Route::delete('/{messageGlue}', 'destroy')->name('messages.destroy');
});

Route::controller(ProfileController::class)->group(function () {
    Route::get('/profile', 'edit')->name('profile.edit');
    Route::post('/profile', 'update')->name('profile.update');
});

Route::controller(PreferencesController::class)->group(function () {
    Route::get('/prefs', 'edit')->name('prefs.edit');
    Route::post('/prefs', 'update')->name('prefs.update');
});

Route::middleware('admin')->prefix('admin')->controller(AdminController::class)->group(function () {
    Route::get('/', 'dashboard')->name('admin.dashboard');
    Route::post('/players/{player}/approve', 'approvePlayer')->name('admin.players.approve');
    Route::post('/games/{game}/pause', 'pauseGame')->name('admin.games.pause');
    Route::post('/games/{game}/unpause', 'unpauseGame')->name('admin.games.unpause');
    Route::get('/settings', 'settingsForm')->name('admin.settings.form');
    Route::post('/settings', 'updateSettings')->name('admin.settings.update');
});

Route::get('/review/{file}', [HistoryController::class, 'review'])->name('review.show');
Route::get('/stats', [StatsController::class, 'index'])->name('stats.index');
