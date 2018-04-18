# Engine-LaravelHelper

This package provides essential functionalities to work with Engine apps on Laravel.

## Features

- Passport configured by default
- Tenant management
- Application genesis process
- App deploy command for deploy application

## Requirements

- PHP 7.1.3+
- Laravel 5.6
- Passport 6.0+

## Installation

1) Install the package via composer

```bash
$ composer require betalabs/engine-laravel-helper
```

2) Import package files to your Laravel project
```bash
$ php artisan vendor:publish --provider="Betalabs\LaravelHelper\LaravelHelperServiceProvider"
```

3) Register package routes to your RouteServiceProvider:

```php
/**
 * Define the routes for the application.
 *
 * @return void
 */
public function map()
{
    $this->mapApiRoutes();

    $this->mapWebRoutes();

    \Betalabs\LaravelHelper\LaravelHelper::routes();
}
```

4) Register Passport routes to your AuthServiceProvider:

```php
/**
 * Register any authentication / authorization services.
 *
 * @return void
 */
public function boot()
{
    $this->registerPolicies();

    \Laravel\Passport\Passport::routes();
}
```

5) In your `config/auth.php` configuration file, you should set the driver option of the api authentication guard to passport and the users provider model to our Company model.
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
        'model' => \Betalabs\LaravelHelper\Models\Company::class,
    ],
],
```

6) And finally

```bash
$ php artisan app:deploy
```