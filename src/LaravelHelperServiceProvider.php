<?php

namespace Betalabs\LaravelHelper;

use Betalabs\LaravelHelper\Console\Commands\App\Deploy;
use Betalabs\LaravelHelper\Services\App\EngineAuthenticator;
use Betalabs\LaravelHelper\Services\App\EngineSdkAuth;
use Illuminate\Support\ServiceProvider;

class LaravelHelperServiceProvider extends ServiceProvider
{
    /**
     * All of the container singletons that should be registered.
     *
     * @var array
     */
    public $singletons = [
        EngineAuthenticator::class => EngineSdkAuth::class
    ];

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            realpath(__DIR__ . '/../database') => base_path('database'),
            realpath(__DIR__ . '/../routes') => base_path('routes'),
        ]);

        if ($this->app->runningInConsole()) {
            $this->commands(Deploy::class);
        }
    }
}
