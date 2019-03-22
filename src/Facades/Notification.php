<?php

namespace Betalabs\LaravelHelper\Facades;


use Illuminate\Support\Facades\Facade;

/**
 * @method static void info(string $message)
 * @method static void alert(string $message)
 * @method static void error(string $message)
 *
 * @see \Betalabs\LaravelHelper\Helpers\Notification
 */
class Notification extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return \Betalabs\LaravelHelper\Helpers\Notification::class;
    }

}