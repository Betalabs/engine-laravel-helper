<?php

use Illuminate\Support\Facades\Route;
use Betalabs\LaravelHelper\Http\Controllers\HealthCheckController;

Route::get('/health-check', [HealthCheckController::class, 'check']);
