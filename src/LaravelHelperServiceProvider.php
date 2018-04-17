<?php

namespace Betalabs\LaravelHelper;

use Betalabs\LaravelHelper\Console\Commands\App\Deploy;
use Illuminate\Support\ServiceProvider;

class LaravelHelperServiceProvider extends ServiceProvider
{
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

    public function register()
    {
        $this->mergeConfigFrom(
            realpath(__DIR__ . '/../config/auth.php'),
            'auth'
        );
    }
}
