<?php

namespace Betalabs\LaravelHelper\Console\Commands\App;

use Betalabs\LaravelHelper\Events\AccessTokenUpdated;
use Betalabs\LaravelHelper\Models\Tenant;
use Illuminate\Console\Command;
use Laravel\Passport\Passport;
use Laravel\Passport\Token;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class UpdateAccessTokens extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-access-tokens';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update access tokens that will expire in 10 or less days';

    /**
     * Execute the console command.
     *
     */
    public function handle()
    {
        /**@var \Illuminate\Support\Collection $expiringTokens**/
        $expiringTokens = Token::where('expires_at', '<=', Carbon::now()->addDays(10))->get();
        $expiringTokens->each(function(Token $token){
            $tenant = Tenant::find($token->user_id);
            Passport::actingAs($tenant);
            $newToken = $tenant->createToken("{$tenant->name} token")->accessToken;
            Log::info("Tenant ID #{$token->user_id} updated.");
            $this->info("Tenant ID #{$token->user_id} updated. New token: {$newToken}");
            event(new AccessTokenUpdated($newToken, $tenant));
            $token->delete();
        });
    }
}