<?php

namespace Betalabs\LaravelHelper\Services\Token;


use Laravel\Passport\PersonalAccessTokenFactory;
use Laminas\Diactoros\ServerRequest;

class PerennialAccessTokenFactory extends PersonalAccessTokenFactory
{
    /**
     * @param \Laravel\Passport\Client $client
     * @param mixed $userId
     * @param array $scopes
     * @return \Laminas\Diactoros\ServerRequest
     */
    protected function createRequest($client, $userId, array $scopes)
    {
        return (new ServerRequest)->withParsedBody([
            'grant_type' => 'perennial_access',
            'client_id' => $client->id,
            'client_secret' => $client->secret,
            'user_id' => $userId,
            'scope' => implode(' ', $scopes),
        ]);
    }
}