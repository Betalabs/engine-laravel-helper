<?php

namespace Betalabs\LaravelHelper\Tests;

use Betalabs\LaravelHelper\Events\GenesisCompleted;
use Betalabs\LaravelHelper\Models\EngineRegistry;
use Betalabs\LaravelHelper\Models\Tenant;
use Betalabs\LaravelHelper\Services\App\Register;
use Betalabs\LaravelHelper\Services\Tenant\Creator;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Support\Facades\Event;
use Laravel\Passport\Passport;

class RegisterTest extends TestCase
{
    public function testRegister()
    {
        Event::fake();

        $creator = $this->mockCreator();

        $event = resolve(Dispatcher::class);
        $service = new Register($creator, $event);
        $service->setAppData([
            'tenant' => factory(Tenant::class)->raw(),
            'engine_registry' => factory(EngineRegistry::class)->raw(),
        ]);
        $tenant = $service->registration();

        Passport::actingAs($tenant);

        $this->assertNotEmpty($tenant->toArray());
        $this->assertNotEmpty($tenant->engineRegistry->toArray());
        $this->assertEquals($tenant->engineRegistry->tenant_id, $tenant->id);

        Event::assertDispatched(
            GenesisCompleted::class,
            function ($event) use ($tenant) {
                return $event->tenant->id = $tenant->id;
            }
        );
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
            ->willReturn($creator);
        $creator->expects($this->once())
            ->method('create')
            ->willReturn(factory(Tenant::class)->create());
        return $creator;
    }
}
