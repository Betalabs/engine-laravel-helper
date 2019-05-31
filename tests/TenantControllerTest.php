<?php

namespace Betalabs\LaravelHelper\Tests;

use Betalabs\LaravelHelper\Http\Controllers\TenantController;
use Betalabs\LaravelHelper\Http\Requests\UpdateTenant;
use Betalabs\LaravelHelper\Models\Tenant;
use Betalabs\LaravelHelper\Services\Tenant\Updater;
use Laravel\Passport\Passport;

class TenantControllerTest extends TestCase
{
    protected function setUp()
    {
        parent::setUp();

        Passport::actingAs(factory(Tenant::class)->create());
    }

    public function testShow()
    {
        $controller = new TenantController();
        $resource = (array)$controller->show();
        $tenant = $resource['resource']->toArray();

        $this->assertArrayHasKey('name', $tenant);
        $this->assertArrayHasKey('email', $tenant);
    }

    public function testUpdate()
    {
        $this->artisan('passport:install');

        $request = $this->mockRequest();

        $controller = new TenantController();
        $oldResource = (array)$controller->show();
        $oldTenant = $oldResource['resource']->toArray();

        $newResource = (array)$controller->update($request, new Updater());
        $newTenant = $newResource['resource']->toArray();

        $this->assertNotEquals($oldTenant['email'], $newTenant['email']);
        $this->assertArrayHasKey('name', $newTenant);
        $this->assertArrayHasKey('email', $newTenant);
        $this->assertArrayHasKey('accessToken', $newTenant);
    }

    private function mockRequest()
    {
        $request = $this->getMockBuilder(UpdateTenant::class)
            ->disableOriginalConstructor()
            ->setMethods(['input'])
            ->getMock();
        $request->expects($this->once())
            ->method('input')
            ->willReturn(factory(Tenant::class)->raw());
        return $request;
    }
}
