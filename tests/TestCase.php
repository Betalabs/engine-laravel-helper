<?php

namespace Betalabs\LaravelHelper\Tests;

use Betalabs\LaravelHelper\CollectionMacrosProvider;
use Betalabs\LaravelHelper\LaravelHelperEventProvider;
use Betalabs\LaravelHelper\LaravelHelperServiceProvider;
use Betalabs\LaravelHelper\Models\Tenant;
use Betalabs\LaravelHelper\PerennialAccessTokenProvider;
use Composer\InstalledVersions;
use Laravel\Passport\Passport;
use Laravel\Passport\PassportServiceProvider;

abstract class TestCase extends \Orchestra\Testbench\TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $databasePath = realpath(__DIR__ . '/../database/');
        $this->withFactories($databasePath . '/factories');
        $this->loadMigrationsFrom($databasePath . '/migrations');

        // Passport 12+ only publishes its migrations. Loading them always is
        // safe: the migrator keys migrations by file name, so they never run
        // twice when Passport 11 loads them too
        $this->loadMigrationsFrom(
            InstalledVersions::getInstallPath('laravel/passport') . '/database/migrations'
        );

        $this->artisan('migrate', ['--database' => 'testing']);

        // Every test gets Passport keys, so none depends on another test
        // having generated them before
        if (!file_exists(Passport::keyPath('oauth-private.key'))) {
            $this->artisan('passport:keys');
        }
    }

    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'sqlite');

        // Same auth configuration the README asks the application to use
        $app['config']->set('auth.guards.api', ['driver' => 'passport', 'provider' => 'users']);
        $app['config']->set('auth.providers.users.model', Tenant::class);
    }

    /**
     * Personal access client for Passport token creation, without
     * passport:install (Passport 12 publishes migrations and asks questions)
     */
    protected function createPassportPersonalClient()
    {
        $this->artisan('passport:client', [
            '--personal' => true,
            '--name' => 'Test Personal Access Client',
            '--no-interaction' => true,
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
