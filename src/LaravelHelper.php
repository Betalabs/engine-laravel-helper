<?php

namespace Betalabs\LaravelHelper;

use Illuminate\Support\Facades\Route;

class LaravelHelper
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    public static $namespace = 'Betalabs\LaravelHelper\Http\Controllers';

    /**
     * Binds the Multi-Tenancy routes into the controller.
     *
     * @return void
     */
    public static function routes(): void
    {
        Route::prefix('api')
            ->middleware('api')
            ->namespace(self::$namespace)
            ->group(base_path('routes/base.php'));
    }
}