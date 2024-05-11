<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RateLimitController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [RateLimitController::class, 'rateLimit']);
Route::get('close-previous-session', [RateLimitController::class, 'closePreviousSession'])->name('close-previous-session');

