<?php

namespace Betalabs\LaravelHelper\Tests;

use Betalabs\LaravelHelper\Models\EngineRegistry;
use Betalabs\LaravelHelper\Models\Tenant;
use Betalabs\LaravelHelper\Models\EngineVirtualEntity;

class FactoryTest extends TestCase
{
    public function testCanRunFactories()
    {
        $tenant = factory(Tenant::class)->create();
        $engineRegistry = factory(EngineRegistry::class)->create([
            'tenant_id' => $tenant->id
        ]);
        $virtualEntity = factory(EngineVirtualEntity::class)->create([
            'tenant_id' => $tenant->id
        ]);

        $this->assertDatabaseHas('tenants', $tenant->toArray());
        $this->assertDatabaseHas(
            'engine_registries',
            $engineRegistry->toArray()
        );
        $this->assertDatabaseHas(
            'engine_virtual_entities',
            $virtualEntity->toArray()
        );
        $this->assertDatabaseHas(
            'engine_virtual_entity_types',
            $virtualEntity->engineVirtualEntityType->toArray()
        );
    }
}
