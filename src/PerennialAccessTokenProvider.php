<?php

namespace Betalabs\LaravelHelper;


use Betalabs\LaravelHelper\Services\Token\PerennialAccessGrant;
use Illuminate\Support\ServiceProvider;
use League\OAuth2\Server\AuthorizationServer;
use DateInterval;

class PerennialAccessTokenProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        app()->afterResolving(AuthorizationServer::class, function(AuthorizationServer $server) {
            $grant = new PerennialAccessGrant();
            $server->enableGrantType($grant, new DateInterval('P1000Y'));
        });
    }
}