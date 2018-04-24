<?php

namespace Tests;

use Betalabs\LaravelHelper\Helpers\Engine\VirtualEntity;
use Betalabs\LaravelHelper\Models\Company;
use Betalabs\LaravelHelper\Models\EngineVirtualEntity;
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
        $virtualEntity = factory(EngineVirtualEntity::class)->create([
            'company_id' => $this->company->id,
            'type_id' => EntityType::PRODUCT
        ]);

        $type = new EntityType(EntityType::PRODUCT);

        $resource = VirtualEntity::resource($this->company, $type);
        $expectedResource = "virtual-entities/{$virtualEntity->code}/records";

        $this->assertEquals($expectedResource, $resource);
    }

    public function testShippingCompanyResource()
    {
        $virtualEntity = factory(EngineVirtualEntity::class)->create([
            'company_id' => $this->company->id,
            'type_id' => EntityType::SHIPPING_COMPANY
        ]);

        $type = new EntityType(EntityType::SHIPPING_COMPANY);

        $resource = VirtualEntity::resource($this->company, $type);
        $expectedResource = "virtual-entities/{$virtualEntity->code}/records";

        $this->assertEquals($expectedResource, $resource);
    }
}
