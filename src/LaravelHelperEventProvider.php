<?php

namespace Betalabs\LaravelHelper;

use Betalabs\LaravelHelper\Events\ChannelCreated;
use Betalabs\LaravelHelper\Listeners\StoreChannel;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class LaravelHelperEventProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        ChannelCreated::class => [
            StoreChannel::class
        ]
    ];
}