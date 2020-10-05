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

        $this->assertDatabaseHas('tenants', [
            'name' => $tenant->name,
            'email' => $tenant->email,
        ]);
        $this->assertDatabaseHas(
            'engine_registries',
            [
                'tenant_id' => $engineRegistry->tenant_id,
                'registry_id' => $engineRegistry->registry_id,
                'api_base_uri' => $engineRegistry->api_base_uri,
                'api_access_token' => $engineRegistry->api_access_token,
            ]
        );
        $this->assertDatabaseHas(
            'engine_virtual_entities',
            [
                'tenant_id' => $virtualEntity->tenant_id,
                'code' => $virtualEntity->code,
                'type_id' => $virtualEntity->type_id,
            ]
        );
        $this->assertDatabaseHas(
            'engine_virtual_entity_types',
            [
                'name' => $virtualEntity->engineVirtualEntityType->name
            ]
        );
    }
}
