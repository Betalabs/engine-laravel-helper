<?php

namespace Tests;

use Betalabs\LaravelHelper\Models\AppConfiguration;
use Betalabs\LaravelHelper\Models\Company;
use Betalabs\LaravelHelper\Models\EngineCredential;
use Betalabs\LaravelHelper\Models\EngineVirtualEntity;

class FactoryTest extends TestCase
{
    public function testCanRunFactories()
    {
        $company = factory(Company::class)->create();
        $appConfig = factory(AppConfiguration::class)->create([
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
