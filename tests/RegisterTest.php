<?php

namespace Betalabs\LaravelHelper\Tests;

use Betalabs\LaravelHelper\Models\EngineRegistry;
use Betalabs\LaravelHelper\Models\Tenant;
use Betalabs\LaravelHelper\Services\App\Register;
use Betalabs\LaravelHelper\Services\Tenant\Creator;

class RegisterTest extends TestCase
{
    public function testRegister()
    {
        $creator = $this->mockCreator();

        $service = new Register($creator);
        $service->setAppData([
            'tenant' => factory(Tenant::class)->raw(),
            'engine_registry' => factory(EngineRegistry::class)->raw(),
        ]);
        $tenant = $service->registration();

        $this->assertNotEmpty($tenant->toArray());
        $this->assertNotEmpty($tenant->engineRegistry->toArray());
        $this->assertEquals($tenant->engineRegistry->tenant_id, $tenant->id);

    }

    private function mockCreator()
    {
        $creator = $this->getMockBuilder(Creator::class)
            ->disableOriginalConstructor()
            ->setMethods(['setData', 'create'])
            ->getMock();
        $creator->expects($this->once())
            ->method('setData')
            ->with($this->isType('array'))
            ->willReturn(null);
        $creator->expects($this->once())
            ->method('create')
            ->willReturn(factory(Tenant::class)->create());
        return $creator;
    }
}
