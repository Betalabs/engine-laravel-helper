<?php

use Illuminate\Support\Facades\Route;
use Betalabs\LaravelHelper\Http\Controllers\FeatureMenuController;

Route::middleware('auth:api')->group(function () {
    Route::get('/tenants', 'TenantController@show');
    Route::put('/tenants', 'TenantController@update');

    //Configurations
    Route::get('/configurations', 'ConfigurationController@index');
    Route::get('/configurations/{featureId}', 'ConfigurationController@show');
    Route::put('/configurations/{featureId}', 'ConfigurationController@update');

    // Menu
    Route::get('/feature-menu', [FeatureMenuController::class,'structure']);
});

Route::post('/apps/genesis', 'AppController@register');
