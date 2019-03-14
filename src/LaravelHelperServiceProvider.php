<?php

namespace Betalabs\LaravelHelper;

use Betalabs\LaravelHelper\Console\Commands\App\Deploy;
use Betalabs\LaravelHelper\Services\App\EngineAuthenticator;
use Betalabs\LaravelHelper\Services\App\EngineSdkAuth;
use Betalabs\LaravelHelper\Services\Engine\EngineResourceCreator;
use Betalabs\LaravelHelper\Services\Engine\EngineResourceIndexer;
use Betalabs\LaravelHelper\Services\Engine\GenericCreator;
use Betalabs\LaravelHelper\Services\Engine\GenericIndexer;
use Betalabs\LaravelHelper\Services\Engine\ResourceCreator;
use Betalabs\LaravelHelper\Services\Engine\ResourceIndexer;
use Illuminate\Support\ServiceProvider;

class LaravelHelperServiceProvider extends ServiceProvider
{
    /**
     * All of the container singletons that should be registered.
     *
     * @var array
     */
    public $singletons = [
        EngineAuthenticator::class => EngineSdkAuth::class,
    ];

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            realpath(__DIR__.'/../config/engine-endpoints.php'), 'engine-endpoints'
        );

        $this->app->when(GenericCreator::class)
            ->needs(EngineResourceCreator::class)
            ->give(ResourceCreator::class);

        $this->app->when(GenericIndexer::class)
            ->needs(EngineResourceIndexer::class)
            ->give(ResourceIndexer::class);

        // Resolving each engine resource class with their endpoints
        collect(config('engine-endpoints.endpoints'))->each(function($endpoint, $class) {
            collect(config('engine-endpoints.resources'))->each(function($resource) use($endpoint, $class) {
                switch($resource) {
                    case 'Creator':
                        $this->app->when($class . "\\" . $resource)
                            ->needs(EngineResourceCreator::class)
                            ->give(function() use($endpoint) {
                                $resourceCreator = new ResourceCreator();
                                $resourceCreator->setEndpoint($endpoint);
                                return $resourceCreator;
                            });
                        break;
                    case 'Indexer':
                        $this->app->when($class . "\\" . $resource)
                            ->needs(EngineResourceIndexer::class)
                            ->give(function() use($endpoint) {
                                $resourceIndexer = new ResourceIndexer();
                                $resourceIndexer->setEndpoint($endpoint);
                                return $resourceIndexer;
                            });
                        break;
                }
            });
        });
    }

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadTranslationsFrom(realpath(__DIR__ . '/../translations'), 'engine-laravel-helper');

        $this->publishes([
            realpath(__DIR__ . '/../database') => base_path('database'),
            realpath(__DIR__ . '/../routes') => base_path('routes'),
            realpath(__DIR__ . '/../translations') => base_path('lang/vendor/engine-laravel-helper'),
            realpath(__DIR__.'/../config/engine-endpoints.php') => config_path('engine-endpoints.php'),
        ]);

        if ($this->app->runningInConsole()) {
            $this->commands(Deploy::class);
        }
    }
}
