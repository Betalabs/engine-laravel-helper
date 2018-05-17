<?php

namespace Betalabs\LaravelHelper\Tests;

use Betalabs\LaravelHelper\Models\Tenant;
use Carbon\Carbon;

class MigrateDatabaseTest extends TestCase
{
    public function testMigrations()
    {
        $now = Carbon::now();

        Tenant::create([
            'name' => 'Test Corp',
            'trading_name' => 'Test',
            'email' => 'test@test.com',
            'cnpj' => '1234567890',
            'created_at' => $now,
            'updated_at' => $now
        ]);

        $company = Tenant::where('id', 1)->first();
        $companyArr = $company->toArray();

        $this->assertEquals('Test Corp', $company->name);
        $this->assertEquals('test@test.com', $company->email);

        $this->assertArrayHasKey('name', $companyArr);
        $this->assertArrayHasKey('trading_name', $companyArr);
        $this->assertArrayHasKey('email', $companyArr);
        $this->assertArrayHasKey('cnpj', $companyArr);
        $this->assertArrayHasKey('created_at', $companyArr);
        $this->assertArrayHasKey('updated_at', $companyArr);
    }
}
