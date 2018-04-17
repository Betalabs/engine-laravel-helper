<?php

use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->group(function () {
    Route::get('/companies', 'CompanyController@show');
    Route::put('/companies', 'CompanyController@update');
});

Route::post('/apps/genesis', 'AppController@register');
