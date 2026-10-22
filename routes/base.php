<?php

use Illuminate\Support\Facades\Route;
use Betalabs\LaravelHelper\Http\Controllers\HealthCheckController;
use Betalabs\LaravelHelper\Http\Controllers\AppController;

Route::post('/apps/genesis',  [AppController::class, 'register']);
Route::get('/health-check', [HealthCheckController::class, 'check']);
