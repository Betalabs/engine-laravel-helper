<?php

namespace Betalabs\LaravelHelper\Tests;

use Betalabs\LaravelHelper\Helpers\Engine\VirtualEntity;
use Betalabs\LaravelHelper\Models\Tenant;
use Betalabs\LaravelHelper\Models\EngineVirtualEntity;
use Betalabs\LaravelHelper\Models\EngineVirtualEntityType;
use Betalabs\LaravelHelper\Models\Enums\EngineVirtualEntity as EntityType;
use Laravel\Passport\Passport;

class VirtualEntityTest extends TestCase
{
    private $tenant;

    protected function setUp()
    {
        parent::setUp();

        $this->tenant = factory(Tenant::class)->create();
        Passport::actingAs($this->tenant);
    }

    public function testProductResource()
    {
        $entityType = factory(EngineVirtualEntityType::class)->create([
            'name' => 'Product'
        ]);
        $virtualEntity = factory(EngineVirtualEntity::class)->create([
            'tenant_id' => $this->tenant->id,
            'type_id' => $entityType->id
        ]);

        $type = new EntityType(EntityType::PRODUCT);

        $resource = VirtualEntity::resource($this->tenant, $type);
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
            'tenant_id' => $this->tenant->id,
            'type_id' => $entityType->id
        ]);

        $type = new EntityType(EntityType::SHIPPING_COMPANY);

        $resource = VirtualEntity::resource($this->tenant, $type);
        $expectedResource = "virtual-entities/{$virtualEntity->code}/records";

        $this->assertEquals($expectedResource, $resource);
    }
}
