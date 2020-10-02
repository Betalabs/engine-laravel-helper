<?php

namespace Betalabs\LaravelHelper\Tests;

use Betalabs\LaravelHelper\CollectionMacrosProvider;
use Betalabs\LaravelHelper\LaravelHelperEventProvider;
use Betalabs\LaravelHelper\LaravelHelperServiceProvider;
use Betalabs\LaravelHelper\PerennialAccessTokenProvider;
use Laravel\Passport\PassportServiceProvider;

abstract class TestCase extends \Orchestra\Testbench\TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        dump(1);
        $databasePath = realpath(__DIR__ . '/../database/');
        dump(2);
        $this->withFactories($databasePath . '/factories');
        dump(3);
        $this->loadMigrationsFrom($databasePath . '/migrations');
        dump(4);
        $this->artisan('migrate', ['--database' => 'testing']);
        dump(5);
    }

    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'testing');
    }

    protected function getPackageProviders($app)
    {
        return [
            LaravelHelperServiceProvider::class,
            PassportServiceProvider::class,
            LaravelHelperEventProvider::class,
            PerennialAccessTokenProvider::class,
            CollectionMacrosProvider::class
        ];
    }
}
