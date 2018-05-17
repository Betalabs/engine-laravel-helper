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
            'email' => 'test@test.com',
            'created_at' => $now,
            'updated_at' => $now
        ]);

        $tenant = Tenant::where('id', 1)->first();
        $tenantArr = $tenant->toArray();

        $this->assertEquals('Test Corp', $tenant->name);
        $this->assertEquals('test@test.com', $tenant->email);

        $this->assertArrayHasKey('name', $tenantArr);
        $this->assertArrayHasKey('email', $tenantArr);
        $this->assertArrayHasKey('created_at', $tenantArr);
        $this->assertArrayHasKey('updated_at', $tenantArr);
    }
}
