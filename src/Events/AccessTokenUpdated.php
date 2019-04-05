<?php

namespace Betalabs\LaravelHelper\Events;

use Betalabs\LaravelHelper\Models\Tenant;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;

class AccessTokenUpdated
{
    use Dispatchable, SerializesModels;

    /**
     * @var \Laravel\Passport\Token
     */
    public $token;
    /**
     * @var \Betalabs\LaravelHelper\Models\Tenant
     */
    public $tenant;

    /**
     * Create a new event instance.
     *
     * @param string $token
     * @param \Betalabs\LaravelHelper\Models\Tenant $tenant
     */
    public function __construct(string $token, Tenant $tenant)
    {
        $this->token = $token;
        $this->tenant = $tenant;
    }
}