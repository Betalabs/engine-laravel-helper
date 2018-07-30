<?php

namespace Betalabs\LaravelHelper\Tests;

use Betalabs\LaravelHelper\Http\Controllers\AppController;
use Betalabs\LaravelHelper\Http\Requests\Register as RegisterRequest;
use Betalabs\LaravelHelper\Models\EngineRegistry;
use Betalabs\LaravelHelper\Models\Tenant;
use Betalabs\LaravelHelper\Services\App\Register;

class AppControllerTest extends TestCase
{
    public function testRegister()
    {
        $request = $this->mockRequest();
        $service = $this->mockRegisterService();

        $app = new AppController();
        $resource = (array)$app->register($request, $service);
        $tenant = $resource['resource']->toArray();

        $this->assertArrayHasKey('name', $tenant);
        $this->assertArrayHasKey('email', $tenant);
    }

    private function mockRequest()
    {
        $request = $this->getMockBuilder(RegisterRequest::class)
            ->disableOriginalConstructor()
            ->setMethods(['input'])
            ->getMock();
        $request->expects($this->once())
            ->method('input')
            ->willReturn([
                'tenant' => factory(Tenant::class)->raw(),
                'engine_registry' => factory(EngineRegistry::class)->raw(),
            ]);
        return $request;
    }

    private function mockRegisterService()
    {
        $service = $this->getMockBuilder(Register::class)
            ->disableOriginalConstructor()
            ->setMethods(['setAppData', 'registration'])
            ->getMock();
        $service->expects($this->once())
            ->method('setAppData')
            ->with($this->isType('array'))
            ->willReturn(null);
        $service->expects($this->once())
            ->method('registration')
            ->willReturn(factory(Tenant::class)->make());
        return $service;
    }
}
