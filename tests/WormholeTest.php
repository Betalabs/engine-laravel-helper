<?php

namespace Betalabs\LaravelHelper\Tests;

use Betalabs\LaravelHelper\Helpers\Engine\Wormhole;
use Betalabs\LaravelHelper\Models\EngineRegistry;
use Betalabs\LaravelHelper\Models\Tenant;
use Laravel\Passport\Passport;

class WormholeTest extends TestCase
{
    private $appConfig;

    protected function setUp()
    {
        parent::setUp();

        $company = factory(Tenant::class)->create();
        Passport::actingAs($company);
        $this->appConfig = factory(EngineRegistry::class)->create([
            'company_id' => $company->id
        ]);
    }

    public function testMakeEndpoint()
    {
        $endpoint = Wormhole::makeEndpoint('configuration');

        $this->assertEquals(
            "apps/{$this->appConfig->engine_app_registry_id}/wormhole/configuration",
            $endpoint
        );
    }

    public function testMakeEndpointWithPrefix()
    {
        $endpoint = Wormhole::makeEndpoint('configuration', 'api');

        $this->assertEquals(
            "api/apps/{$this->appConfig->engine_app_registry_id}/wormhole/configuration",
            $endpoint
        );
    }
}
