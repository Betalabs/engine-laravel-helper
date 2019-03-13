<?php

namespace Betalabs\LaravelHelper\Services\App;

use Betalabs\LaravelHelper\Models\Tenant;

interface EngineAuthenticator
{
    public function authenticate(Tenant $tenant): void;
}