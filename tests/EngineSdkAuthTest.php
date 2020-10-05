<?php

namespace Betalabs\LaravelHelper\Tests;


use Betalabs\LaravelHelper\Models\EngineRegistry;
use Betalabs\LaravelHelper\Models\Tenant;
use Betalabs\LaravelHelper\Services\App\EngineSdkAuth;
use Facades\Betalabs\Engine\Auth\Token;
use Laravel\Passport\Passport;

class EngineSdkAuthTest extends TestCase
{
    private $tenant;

    protected function setUp(): void
    {
        parent::setUp();
        $this->tenant = factory(Tenant::class)->create();
        Passport::actingAs($this->tenant);
        factory(EngineRegistry::class)->create(['tenant_id' => $this->tenant->id]);
    }

    public function testEngineSdkAuth()
    {
        Token::shouldReceive('informToken')
            ->with($this->tenant->engineRegistry->api_access_token);

        $engineSdkAuth = resolve(EngineSdkAuth::class);
        $engineSdkAuth->authenticate($this->tenant);
    }
}
