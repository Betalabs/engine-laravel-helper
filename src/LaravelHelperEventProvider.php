<?php

namespace Betalabs\LaravelHelper;

use Betalabs\LaravelHelper\Events\AccessTokenUpdated;
use Betalabs\LaravelHelper\Events\ChannelCreated;
use Betalabs\LaravelHelper\Events\ExtraFieldAndFormCreated;
use Betalabs\LaravelHelper\Listeners\StoreChannel;
use Betalabs\LaravelHelper\Listeners\StoreExtraField;
use Betalabs\LaravelHelper\Listeners\UpdateAccessToken;
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
        ],
        ExtraFieldAndFormCreated::class => [
            StoreExtraField::class
        ],
        AccessTokenUpdated::class => [
            UpdateAccessToken::class
        ]
    ];
}