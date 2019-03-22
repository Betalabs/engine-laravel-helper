<?php

namespace Betalabs\LaravelHelper\Tests;


use Betalabs\LaravelHelper\Events\ChannelCreated;
use Betalabs\LaravelHelper\Models\Tenant;
use Laravel\Passport\Passport;

class ChannelCreatedTest extends TestCase
{
    private $tenant;

    protected function setUp()
    {
        parent::setUp();

        $this->tenant = factory(Tenant::class)->create();
        Passport::actingAs($this->tenant);
    }

    public function testChannelCreated()
    {
        $response = new \stdClass();
        $response->id = 1;
        $response->channel = 'TestChannel';
        event(new ChannelCreated($response, $this->tenant));
        $this->assertDatabaseHas('engine_channels', [
            'code' => $response->id,
            'slug' => str_slug($response->channel),
            'tenant_id' => $this->tenant->id
        ]);
    }
}