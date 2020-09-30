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

        $databasePath = realpath(__DIR__ . '/../database/');
        $this->withFactories($databasePath . '/factories');
        $this->loadMigrationsFrom($databasePath . '/migrations');
        $this->artisan('migrate', ['--database' => 'testing']);
    }

    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'testing');
        $app['config']->set('database.connections.testing', [
            'driver'   => 'mysql',
            'host' => 'mysql',
            'database' => 'testing',
            'username'   => 'root',
            'password'   => 'root',
        ]);
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
