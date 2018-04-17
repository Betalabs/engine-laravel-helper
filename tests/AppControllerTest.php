<?php

namespace Tests;


use Betalabs\LaravelHelper\Http\Controllers\AppController;
use Betalabs\LaravelHelper\Http\Requests\Register as RegisterRequest;
use Betalabs\LaravelHelper\Models\AppConfiguration;
use Betalabs\LaravelHelper\Models\Company;
use Betalabs\LaravelHelper\Models\EngineCredential;
use Betalabs\LaravelHelper\Services\App\Register;

class AppControllerTest extends TestCase
{

    public function testRegister()
    {
        $request = $this->mockRequest();
        $service = $this->mockRegisterService();

        $app = new AppController();
        $resource = (array)$app->register($request, $service);
        $company = $resource['resource']->toArray();

        $this->assertArrayHasKey('name', $company);
        $this->assertArrayHasKey('trading_name', $company);
        $this->assertArrayHasKey('cnpj', $company);
        $this->assertArrayHasKey('email', $company);
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
                'company' => factory(Company::class)->raw(),
                'app_configuration' => factory(AppConfiguration::class)->raw(),
                'engine_credential' => factory(EngineCredential::class)->raw(),
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
            ->willReturn(factory(Company::class)->make());
        return $service;
    }
}
