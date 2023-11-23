<?php

namespace Betalabs\LaravelHelper\Helpers\Engine;

use Betalabs\Engine\Requests\EndpointResolver;
use Betalabs\Engine\Auth\Token;
use Illuminate\Contracts\Auth\Authenticatable;

class Auth
{
    /**
     * Authenticate tenant in Engine
     *
     * @param \Illuminate\Contracts\Auth\Authenticatable $tenant
     */
    public static function auth(Authenticatable $tenant): void
    {
        /** @var \Betalabs\LaravelHelper\Models\Tenant $tenant */
        $registry = $tenant->engineRegistry;
        $endpoint = rtrim($registry->api_base_uri, '/api');

        EndpointResolver::setEndpoint($endpoint);
        resolve(Token::class)->informToken($registry->api_access_token);
    }
}
