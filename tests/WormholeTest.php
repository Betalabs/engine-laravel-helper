<?php

namespace Betalabs\LaravelHelper\Tests;

use Betalabs\LaravelHelper\Helpers\Engine\Wormhole;
use Betalabs\LaravelHelper\Models\EngineRegistry;
use Betalabs\LaravelHelper\Models\Tenant;
use Laravel\Passport\Passport;

class WormholeTest extends TestCase
{
    private $engineRegistry;

    protected function setUp()
    {
        parent::setUp();

        $tenant = factory(Tenant::class)->create();
        Passport::actingAs($tenant);
        $this->engineRegistry = factory(EngineRegistry::class)->create([
            'tenant_id' => $tenant->id
        ]);
    }

    public function testMakeEndpoint()
    {
        $endpoint = Wormhole::makeEndpoint('configuration');

        $this->assertEquals(
            "apps/{$this->engineRegistry->registry_id}/wormhole/configuration",
            $endpoint
        );
    }

    public function testMakeEndpointWithPrefix()
    {
        $endpoint = Wormhole::makeEndpoint('configuration', 'api');

        $this->assertEquals(
            "api/apps/{$this->engineRegistry->registry_id}/wormhole/configuration",
            $endpoint
        );
    }
}
