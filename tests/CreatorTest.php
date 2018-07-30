<?php

namespace Betalabs\LaravelHelper\Tests;

use Betalabs\LaravelHelper\Models\Tenant;
use Betalabs\LaravelHelper\Services\Tenant\Creator;

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
        $company = $service
            ->setData(factory(Tenant::class)->raw())
            ->create();

        $this->assertInstanceOf(Tenant::class, $company);
        $this->assertNotEmpty($company->name);
        $this->assertNotEmpty($company->email);
        $this->assertNotEmpty($company->accessToken);
    }
}
