<?php

use Illuminate\Support\Facades\Route;
use Betalabs\LaravelHelper\Http\Controllers\ConfigurationController;
use Betalabs\LaravelHelper\Http\Controllers\TenantController;
use Betalabs\LaravelHelper\Http\Controllers\FeatureMenuController;

Route::middleware('auth:api')->group(function () {

    // Tenants
    Route::get('/tenants', [TenantController::class, 'show']);
    Route::put('/tenants', [TenantController::class, 'update']);

    //Configurations
    Route::get('/configurations',  [ConfigurationController::class, 'index']);
    Route::get('/configurations/{featureId}', [ConfigurationController::class, 'show']);
    Route::put('/configurations/{featureId}', [ConfigurationController::class, 'update']);

    // Configuration screen
    Route::get('/configuration-list', [FeatureMenuController::class,'configurationStructure']);
    Route::get('/configs/structure',  [ConfigurationController::class, 'structureConfigs']);
    Route::get('/configs/{data?}', [ConfigurationController::class, 'showConfigs']);
    Route::put('/configs/{data?}', [ConfigurationController::class, 'updateConfigs']);

    // Menu
    Route::get('/feature-menu', [FeatureMenuController::class,'structure']);





});

