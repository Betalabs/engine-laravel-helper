<?php

namespace Betalabs\LaravelHelper\Tests;


use Betalabs\LaravelHelper\Models\Tenant;
use Betalabs\LaravelHelper\Services\App\VirtualEntity\Creator;
use Laravel\Passport\Passport;
use Facades\Betalabs\LaravelHelper\Services\Engine\VirtualEntity\Indexer;

class VirtualEntityCreatorTest extends TestCase
{
    private $tenant;

    protected function setUp()
    {
        parent::setUp();
        $this->tenant = factory(Tenant::class)->create();
        Passport::actingAs($this->tenant);
    }


    public function testCreate()
    {
        $virtualEntity = new \stdClass();
        $virtualEntity->id = 34;
        Indexer::shouldReceive('setQuery')
            ->with(['slug' => 'items'])
            ->once()
            ->andReturnSelf();
        Indexer::shouldReceive('index')
            ->once()
            ->andReturn(collect([$virtualEntity]));

        /**@var \Betalabs\LaravelHelper\Services\App\VirtualEntity\Creator $creator**/
        $creator = resolve(Creator::class);
        $creator->create();
        $this->assertDatabaseHas('engine_virtual_entities', [
            'tenant_id' => $this->tenant->id,
            'code' => $virtualEntity->id,
            'type_id' => 1,
        ]);
    }
}