<?php

use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->group(function () {
    Route::get('/tenants', 'TenantController@show');
    Route::put('/tenants', 'TenantController@update');
});

Route::post('/apps/genesis', 'AppController@register');
