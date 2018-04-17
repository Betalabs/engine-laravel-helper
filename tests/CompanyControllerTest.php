<?php

namespace Tests;

use Betalabs\LaravelHelper\Http\Controllers\CompanyController;
use Betalabs\LaravelHelper\Http\Requests\UpdateCompany;
use Betalabs\LaravelHelper\Models\Company;
use Laravel\Passport\Passport;

class CompanyControllerTest extends TestCase
{
    protected function setUp()
    {
        parent::setUp();

        Passport::actingAs(factory(Company::class)->create());
    }

    public function testShow()
    {
        $controller = new CompanyController();
        $resource = (array)$controller->show();
        $company = $resource['resource']->toArray();

        $this->assertArrayHasKey('name', $company);
        $this->assertArrayHasKey('trading_name', $company);
        $this->assertArrayHasKey('cnpj', $company);
        $this->assertArrayHasKey('email', $company);
    }

    public function testUpdate()
    {
        $request = $this->mockRequest();

        $controller = new CompanyController();
        $oldResource = (array)$controller->show();
        $oldCompany = $oldResource['resource']->toArray();

        $newResource = (array)$controller->update($request);
        $newCompany = $newResource['resource']->toArray();

        $this->assertNotEquals($oldCompany['email'], $newCompany['email']);
        $this->assertArrayHasKey('name', $newCompany);
        $this->assertArrayHasKey('trading_name', $newCompany);
        $this->assertArrayHasKey('cnpj', $newCompany);
        $this->assertArrayHasKey('email', $newCompany);
    }

    private function mockRequest()
    {
        $request = $this->getMockBuilder(UpdateCompany::class)
            ->disableOriginalConstructor()
            ->setMethods(['input'])
            ->getMock();
        $request->expects($this->once())
            ->method('input')
            ->willReturn(factory(Company::class)->raw());
        return $request;
    }
}
