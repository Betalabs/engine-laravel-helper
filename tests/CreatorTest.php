<?php

namespace Tests;

use Betalabs\LaravelHelper\Models\Company;
use Betalabs\LaravelHelper\Services\Company\Creator;

class CreatorTest extends TestCase
{
    protected function setUp()
    {
        parent::setUp();

        $this->artisan('passport:install');
        $this->artisan('passport:keys');
    }

    public function testCreate()
    {
        $service = new Creator();
        $service->setCompanyData(factory(Company::class)->raw());
        $company = $service->create();

        $this->assertInstanceOf(Company::class, $company);
        $this->assertNotEmpty($company->name);
        $this->assertNotEmpty($company->email);
        $this->assertNotEmpty($company->accessToken);
    }
}
