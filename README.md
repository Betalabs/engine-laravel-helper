# Engine-LaravelHelper

This package provides essential functionalities to work with Engine apps on Laravel.

## Features

- Passport configured by default
- Tenant management
- Application genesis process
- App deploy command for deploy application

## Requirements

| | Version |
|---|---|
| PHP | 8.2 to 8.5 |
| Laravel | 10, 11 or 12 |
| laravel/passport | 11 or 12 |
| betalabs/engine-phpsdk | 3.x |

Projects on PHP below 8.2 (or engine-phpsdk 2.x) must stay on version `5.x`.

## Installation

1) Install the package via composer

```bash
$ composer require betalabs/engine-laravel-helper
```

2) Import package files to your Laravel project
```bash
$ php artisan vendor:publish --provider="Betalabs\LaravelHelper\LaravelHelperServiceProvider"
```

3) Register package routes.

Laravel 11 and 12, in `bootstrap/app.php`:

```php
->withRouting(
    // ...
    then: function () {
        \Betalabs\LaravelHelper\LaravelHelper::routes();
    },
)
```

Laravel 10, in `RouteServiceProvider` (inside `boot()`, after the application routes):

```php
\Betalabs\LaravelHelper\LaravelHelper::routes();
```

4) Passport routes are registered automatically by Passport 11+ (`Passport::routes()` no longer exists; remove it if your project still calls it).

With Passport 12, publish and run its migrations if your database does not have the `oauth_*` tables yet:

```bash
$ php artisan vendor:publish --tag=passport-migrations
$ php artisan migrate
```

5) In your `config/auth.php` configuration file, you should set the driver option of the api authentication guard to passport and the users provider model to our Tenant model.
This will instruct your application to use Passport's TokenGuard when authenticating incoming API requests:

```php
'guards' => [
    'api' => [
        'driver' => 'passport',
        'provider' => 'users',
    ],
],
'providers' => [
    'users' => [
        'driver' => 'eloquent',
        'model' => \Betalabs\LaravelHelper\Models\Tenant::class,
    ],
],
```

6) And finally

```bash
$ php artisan app:deploy
```

## Upgrading to 6.x

- Requires PHP 8.2+ and `betalabs/engine-phpsdk` 3.x (PHP 8.2 to 8.5 compatible).
- Laravel 11/12: register the package routes in `bootstrap/app.php` (see Installation, step 3) and remove `Passport::routes()` calls.
- Passport 12 no longer loads its migrations automatically: publish them (`vendor:publish --tag=passport-migrations`) when the `oauth_*` tables do not exist.
- Fixed: updating the tenant with `engine_api_access_token` now always saves the token in the `engine` registry, even when the tenant has other registries (previously the first registry of the tenant was updated). If the tenant has no `engine` registry a `RuntimeException` is thrown.
- Fixed: `NFe\TaxInvoice\Indexer` now uses the `nfe` registry when the tenant has it (previously the first registry of the tenant was used); without it, the registry informed by `setRegistryId()` is used, as before.
- Fixed: `Models\Enums\WorkflowConditionOperator` had a syntax error and could not be loaded.

## Testing

```bash
$ composer update
$ vendor/bin/phpunit
```

Tests use SQLite in memory (`pdo_sqlite` PHP extension).
