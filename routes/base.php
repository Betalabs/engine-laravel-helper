<?php

use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->group(function () {
    Route::get('/tenants', 'TenantController@show');
    Route::put('/tenants', 'TenantController@update');

    //Configurations
    Route::get('/configurations', 'ConfigurationController@index');
    Route::get('/configurations/{featureId}', 'ConfigurationController@show');
    Route::put('/configurations/{featureId}', 'ConfigurationController@update');
});

Route::post('/apps/genesis', 'AppController@register');
