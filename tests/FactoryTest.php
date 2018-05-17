<?php

namespace Betalabs\LaravelHelper\Tests;

use Betalabs\LaravelHelper\Models\EngineRegistry;
use Betalabs\LaravelHelper\Models\Tenant;
use Betalabs\LaravelHelper\Models\EngineCredential;
use Betalabs\LaravelHelper\Models\EngineVirtualEntity;

class FactoryTest extends TestCase
{
    public function testCanRunFactories()
    {
        $company = factory(Tenant::class)->create();
        $appConfig = factory(EngineRegistry::class)->create([
            'company_id' => $company->id
        ]);
        $credential = factory(EngineCredential::class)->create([
            'company_id' => $company->id
        ]);
        $virtualEntity = factory(EngineVirtualEntity::class)->create([
            'company_id' => $company->id
        ]);

        $this->assertDatabaseHas('companies', $company->toArray());
        $this->assertDatabaseHas(
            'app_configurations',
            $appConfig->toArray()
        );
        $this->assertDatabaseHas(
            'engine_credentials',
            $credential->toArray()
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
