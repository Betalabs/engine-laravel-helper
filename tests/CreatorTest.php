<?php

namespace Betalabs\LaravelHelper\Tests;

use Betalabs\LaravelHelper\Models\Tenant;
use Betalabs\LaravelHelper\Services\Tenant\Creator;
use Carbon\Carbon;
use Laravel\Passport\Token;

class CreatorTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp(): void;

        $this->artisan('passport:install');
        $this->artisan('passport:keys');
    }

    public function testCreate()
    {
        $service = new Creator();
        $tenant = $service
            ->setData(factory(Tenant::class)->raw())
            ->create();

        $this->assertInstanceOf(Tenant::class, $tenant);
        $this->assertNotEmpty($tenant->name);
        $this->assertNotEmpty($tenant->email);
        $this->assertNotEmpty($tenant->accessToken);

        $this->assertTrue(
            Token::where('user_id', $tenant->id)->first()
                ->expires_at
                ->greaterThan(Carbon::now()->addYears(999))
        );
    }
}
