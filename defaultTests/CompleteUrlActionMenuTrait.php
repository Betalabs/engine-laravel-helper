<?php

namespace Tests;

use Betalabs\LaravelHelper\Helpers\Engine\Wormhole;

trait CompleteUrlActionMenuTrait
{
    private function completeUrl($baseUrl)
    {
        return $this->engineRegistry->api_base_uri . '/' . trim(Wormhole::makeEndpoint($baseUrl, 'api'), '/');
    }
}
