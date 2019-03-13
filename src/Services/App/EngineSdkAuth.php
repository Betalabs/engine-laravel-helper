<?php

namespace Betalabs\LaravelHelper\Services\App;


use Betalabs\Engine\Auth\Token;
use Betalabs\LaravelHelper\Models\Tenant;
use Betalabs\Engine\Requests\EndpointResolver;

class EngineSdkAuth implements EngineAuthenticator
{
    /**
     * @var \Betalabs\Engine\Auth\Token
     */
    private $token;

    /**
     * EngineSdkAuth constructor.
     * @param \Betalabs\Engine\Auth\Token $token
     */
    public function __construct(Token $token)
    {
        $this->token = $token;
    }

    /**
     * Authenticate Tenant on Engine SDK
     *
     * @param \Betalabs\LaravelHelper\Models\Tenant $tenant
     */
    public function authenticate(Tenant $tenant): void
    {
        $registry = $tenant->engineRegistry;
        $endpoint = rtrim($registry->api_base_uri, '/api');

        EndpointResolver::setEndpoint($endpoint);
        $this->token->informToken($registry->api_access_token);
    }

}