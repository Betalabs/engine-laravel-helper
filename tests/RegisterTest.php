<?php

namespace Betalabs\LaravelHelper\Tests;

use Betalabs\LaravelHelper\Models\EngineRegistry;
use Betalabs\LaravelHelper\Models\Tenant;
use Betalabs\LaravelHelper\Models\EngineCredential;
use Betalabs\LaravelHelper\Services\App\Register;
use Betalabs\LaravelHelper\Services\Tenant\Creator;

class RegisterTest extends TestCase
{
    public function testRegister()
    {
        $creator = $this->mockCreator();

        $service = new Register($creator);
        $service->setAppData([
            'company' => factory(Tenant::class)->raw(),
            'app_configuration' => factory(EngineRegistry::class)->raw(),
            'engine_credential' => factory(EngineCredential::class)->raw(),
        ]);
        $company = $service->registration();

        $this->assertNotEmpty($company->toArray());
        $this->assertNotEmpty($company->appConfiguration->toArray());
        $this->assertNotEmpty($company->engineCredential->toArray());

        $this->assertEquals($company->appConfiguration->company_id, $company->id);
        $this->assertEquals($company->engineCredential->company_id, $company->id);

    }

    private function mockCreator()
    {
        $creator = $this->getMockBuilder(Creator::class)
            ->disableOriginalConstructor()
            ->setMethods(['setCompanyData', 'create'])
            ->getMock();
        $creator->expects($this->once())
            ->method('setCompanyData')
            ->with($this->isType('array'))
            ->willReturn(null);
        $creator->expects($this->once())
            ->method('create')
            ->willReturn(factory(Tenant::class)->create());
        return $creator;
    }
}
