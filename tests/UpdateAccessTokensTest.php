<?php

namespace Betalabs\LaravelHelper\Tests;

use Betalabs\LaravelHelper\Models\EngineRegistry;
use Betalabs\LaravelHelper\Models\Tenant;
use Laravel\Passport\Token;
use Carbon\Carbon;
use Facades\Betalabs\LaravelHelper\Services\App\EngineSdkAuth;
use Facades\Betalabs\LaravelHelper\Services\Engine\Event\Firer;

class UpdateAccessTokensTest extends TestCase
{
    private $tenant;
    private $token;

    protected function setUp(): void
    {
        parent::setUp(): void;
        $this->artisan('passport:install');
        $this->tenant = factory(Tenant::class)->create();
        factory(EngineRegistry::class)->create(['tenant_id' => $this->tenant->id]);
        $this->token = $this->tenant->createToken("{$this->tenant->name} token");
        $this->token->token->expires_at = Carbon::now()->addDays(3);
        $this->token->token->save();
        $this->token->token->refresh();
    }

    public function testUpdateAccessTokens()
    {
        EngineSdkAuth::shouldReceive('authenticate')
            ->once()
            ->andReturn(null);

        Firer::shouldReceive('setName')
            ->with('AccessToken.Updated')
            ->once()
            ->andReturnSelf();
        Firer::shouldReceive('setParams')
            ->once()
            ->andReturnSelf();
        Firer::shouldReceive('fire')
            ->once()
            ->andReturn(null);

        $this->artisan('app:update-access-tokens');
        $token = Token::where('user_id', $this->tenant->id)->latest()->first();
        $this->assertTrue($token->expires_at->gt(Carbon::now()->addDays(360)));
    }
}
