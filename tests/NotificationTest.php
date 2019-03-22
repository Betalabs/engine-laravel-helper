<?php

namespace Betalabs\LaravelHelper\Tests;

use Betalabs\LaravelHelper\Helpers\Notification;
use Betalabs\LaravelHelper\Models\EngineRegistry;
use Betalabs\LaravelHelper\Models\Tenant;
use Facades\Betalabs\LaravelHelper\Services\App\EngineSdkAuth;
use Laravel\Passport\Passport;
use Facades\Betalabs\LaravelHelper\Services\Engine\Notifications\Creator;

class NotificationTest extends TestCase
{
    private $tenant;

    protected function setUp()
    {
        parent::setUp();
        $this->tenant = factory(Tenant::class)->create();
        Passport::actingAs($this->tenant);
        factory(EngineRegistry::class)->create(['tenant_id' =>  $this->tenant]);
    }

    public function testNotifiableException()
    {
        EngineSdkAuth::shouldReceive('authenticate')
            ->once()
            ->with($this->tenant)
            ->andReturn(null);
        Creator::shouldReceive('setAppRegistryId')
            ->once()
            ->with($this->tenant->engineRegistry->registry_id)
            ->andReturnSelf();
        Creator::shouldReceive('setLevel')
            ->once()
            ->andReturnSelf();
        Creator::shouldReceive('setMessage')
            ->once()
            ->with('test')
            ->andReturnSelf();
        Creator::shouldReceive('create')
            ->once()
            ->andReturn(null);

        $notification = resolve(Notification::class);
        /**@var Notification $notification **/
        $notification->error('test');
    }
}
