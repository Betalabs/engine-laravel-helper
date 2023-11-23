<?php

namespace Betalabs\LaravelHelper;

use Betalabs\LaravelHelper\Console\Commands\App\Deploy;
use Betalabs\LaravelHelper\Console\Commands\App\UpdateAccessTokens;
use Betalabs\LaravelHelper\Services\App\EngineAuthenticator;
use Betalabs\LaravelHelper\Services\App\EngineSdkAuth;
use Betalabs\LaravelHelper\Services\Engine\EngineResourceCreator;
use Betalabs\LaravelHelper\Services\Engine\EngineResourceIndexer;
use Betalabs\LaravelHelper\Services\Engine\EngineResourceShower;
use Betalabs\LaravelHelper\Services\Engine\EngineResourceUpdater;
use Betalabs\LaravelHelper\Services\Engine\Event\Firer;
use Betalabs\LaravelHelper\Services\Engine\GenericCreator;
use Betalabs\LaravelHelper\Services\Engine\GenericIndexer;
use Betalabs\LaravelHelper\Services\Engine\GenericShower;
use Betalabs\LaravelHelper\Services\Engine\GenericUpdater;
use Betalabs\LaravelHelper\Services\Engine\ResourceCreator;
use Betalabs\LaravelHelper\Services\Engine\ResourceIndexer;
use Betalabs\LaravelHelper\Services\Engine\ResourceShower;
use Betalabs\LaravelHelper\Services\Engine\ResourceUpdater;
use Betalabs\LaravelHelper\Services\Engine\ZipCodeRange\Calculator;
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

        $this->app->when(Firer::class)
            ->needs(EngineResourceCreator::class)
            ->give(ResourceCreator::class);

        $this->app->when(GenericIndexer::class)
            ->needs(EngineResourceIndexer::class)
            ->give(ResourceIndexer::class);

        $this->app->when(Calculator::class)
            ->needs(EngineResourceIndexer::class)
            ->give(ResourceIndexer::class);

        $this->app->when(GenericShower::class)
            ->needs(EngineResourceShower::class)
            ->give(ResourceShower::class);

        $this->app->when(GenericUpdater::class)
            ->needs(EngineResourceUpdater::class)
            ->give(ResourceUpdater::class);

        // Resolving each engine resource class with their endpoints
        collect(config('engine-endpoints.endpoints'))->each(function($endpoint, $class) {
            collect(config('engine-endpoints.resources'))->each(function($resource) use($endpoint, $class) {
                $exceptionTranslationPath = "engine-laravel-helper::exception.{$endpoint}.";
                switch($resource) {
                    case 'Creator':
                        $this->app->when($class . "\\" . $resource)
                            ->needs(EngineResourceCreator::class)
                            ->give(function() use($endpoint, $exceptionTranslationPath) {
                                $resourceCreator = resolve(ResourceCreator::class);
                                return $resourceCreator->setEndpoint($endpoint)
                                    ->setExceptionMessage(trans("{$exceptionTranslationPath}create"));
                            });
                        break;
                    case 'Indexer':
                        $this->app->when($class . "\\" . $resource)
                            ->needs(EngineResourceIndexer::class)
                            ->give(function() use($endpoint, $exceptionTranslationPath) {
                                $resourceIndexer = resolve(ResourceIndexer::class);
                                return $resourceIndexer->setEndpoint($endpoint)
                                    ->setExceptionMessage(trans("{$exceptionTranslationPath}retrieve"));
                            });
                        break;
                    case 'Shower':
                        $this->app->when($class . "\\" . $resource)
                            ->needs(EngineResourceShower::class)
                            ->give(function() use($endpoint, $exceptionTranslationPath) {
                                $resourceShower= resolve(ResourceShower::class);
                                return $resourceShower->setEndpoint($endpoint)
                                    ->setExceptionMessage(trans("{$exceptionTranslationPath}retrieve"));
                            });
                        break;
                    case 'Updater':
                        $this->app->when($class . "\\" . $resource)
                            ->needs(EngineResourceUpdater::class)
                            ->give(function() use($endpoint, $exceptionTranslationPath) {
                                $resourceUpdater = resolve(ResourceUpdater::class);
                                return $resourceUpdater->setEndpoint($endpoint)
                                    ->setExceptionMessage(trans("{$exceptionTranslationPath}update"));
                            });
                        break;
                    case 'Structure':
                        $this->app->when($class . "\\" . $resource)
                            ->needs(EngineResourceIndexer::class)
                            ->give(function() use($endpoint, $exceptionTranslationPath) {
                                $resourceIndexer = resolve(ResourceIndexer::class);
                                return $resourceIndexer->setEndpoint("{$endpoint}/structure")
                                    ->setExceptionMessage(trans("{$exceptionTranslationPath}structure"));
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
            realpath(__DIR__ . '/../app') => base_path('app'),
            realpath(__DIR__ . '/../routes') => base_path('routes'),
            realpath(__DIR__ . '/../translations') => base_path('lang/vendor/engine-laravel-helper'),
            realpath(__DIR__ . '/../defaultTests') => base_path('tests'),
            realpath(__DIR__ . '/../defaultTranslations') => base_path('resources'),
            realpath(__DIR__.'/../config/engine-endpoints.php') => config_path('engine-endpoints.php'),
        ]);

        if ($this->app->runningInConsole()) {
            $this->commands(Deploy::class);
            $this->commands(UpdateAccessTokens::class);
        }
    }
}
