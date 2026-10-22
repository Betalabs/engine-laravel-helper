<?php

namespace Betalabs\LaravelHelper\Tests;

use Betalabs\LaravelHelper\Http\Controllers\TenantController;
use Betalabs\LaravelHelper\Http\Requests\UpdateTenant;
use Betalabs\LaravelHelper\Models\EngineRegistry;
use Betalabs\LaravelHelper\Models\Tenant;
use Betalabs\LaravelHelper\Services\Tenant\Updater;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Engines\Engine;
use Laravel\Passport\Passport;

class TenantControllerTest extends TestCase
{
    protected function setUp(): void
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
        $this->createPassportPersonalClient();

        factory(EngineRegistry::class)->create(['tenant_id' => Auth::id()]);

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
        $this->assertEquals('engineToken', EngineRegistry::bySlug('engine')->api_access_token);
    }

    /**
     * Real request with the payload: PHPUnit 12 can no longer double
     * FormRequest classes (they have a method named "method")
     */
    private function mockRequest()
    {
        return UpdateTenant::create('/tenants', 'PUT', array_merge(
            factory(Tenant::class)->raw(),
            [
                'engine_api_access_token' => 'engineToken'
            ]
        ));
    }
}
