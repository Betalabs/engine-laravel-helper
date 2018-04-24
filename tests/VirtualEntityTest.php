<?php

namespace Tests;

use Betalabs\LaravelHelper\Helpers\Engine\VirtualEntity;
use Betalabs\LaravelHelper\Models\Company;
use Betalabs\LaravelHelper\Models\EngineVirtualEntity;
use Betalabs\LaravelHelper\Models\EngineVirtualEntityType;
use Betalabs\LaravelHelper\Models\Enums\EngineVirtualEntity as EntityType;

class VirtualEntityTest extends TestCase
{
    private $company;

    protected function setUp()
    {
        parent::setUp();

        $this->company = factory(Company::class)->create();
    }

    public function testProductResource()
    {
        $entityType = factory(EngineVirtualEntityType::class)->create([
            'name' => 'Product'
        ]);
        $virtualEntity = factory(EngineVirtualEntity::class)->create([
            'company_id' => $this->company->id,
            'type_id' => $entityType->id
        ]);

        $type = new EntityType(EntityType::PRODUCT);

        $resource = VirtualEntity::resource($this->company, $type);
        $expectedResource = "virtual-entities/{$virtualEntity->code}/records";

        $this->assertEquals($expectedResource, $resource);
    }

    public function testShippingCompanyResource()
    {
        factory(EngineVirtualEntityType::class)->create();
        $entityType = factory(EngineVirtualEntityType::class)->create([
            'name' => 'Shipping company'
        ]);
        $virtualEntity = factory(EngineVirtualEntity::class)->create([
            'company_id' => $this->company->id,
            'type_id' => $entityType->id
        ]);

        $type = new EntityType(EntityType::SHIPPING_COMPANY);

        $resource = VirtualEntity::resource($this->company, $type);
        $expectedResource = "virtual-entities/{$virtualEntity->code}/records";

        $this->assertEquals($expectedResource, $resource);
    }
}
