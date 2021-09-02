<?php

use Illuminate\Support\Facades\Route;


Route::any('{path}', [\App\Http\Controllers\LegacyController::class, 'index'])->where('path', '.*');