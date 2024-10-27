<?php

use App\Http\Controllers\CounterController;
use App\Http\Middleware\AuthenticateWithToken;
use Illuminate\Support\Facades\Route;

Route::middleware(AuthenticateWithToken::class)->group(function () {
    Route::get('/counters/{userId}', [CounterController::class, 'getCounter']);
    Route::post('/counters/{userId}/increment', [CounterController::class, 'increment']);
    Route::post('/counters/{userId}/decrement', [CounterController::class, 'decrement']);
    Route::post('/counters/{userId}/sync', [CounterController::class, 'sync']);
});
