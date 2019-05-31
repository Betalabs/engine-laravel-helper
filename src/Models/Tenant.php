<?php

namespace Betalabs\LaravelHelper\Models;

use Betalabs\LaravelHelper\Services\Token\PerennialAccessTokenFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Container\Container;

/**
 * @property \Betalabs\LaravelHelper\Models\EngineRegistry engineRegistry
 */
class Tenant extends Authenticatable
{
    use HasApiTokens, Notifiable, SoftDeletes;

    /**
     * @var array
     */
    protected $fillable = ['name', 'email'];

    /**
     * Return the related EngineRegistry.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function engineRegistry(): HasOne
    {
        return $this->hasOne(EngineRegistry::class);
    }

    /**
     * Create a new perennial access token for the user.
     *
     * @param  string  $name
     * @param  array  $scopes
     * @return \Laravel\Passport\PersonalAccessTokenResult
     */
    public function createToken($name, array $scopes = [])
    {
        return Container::getInstance()->make(PerennialAccessTokenFactory::class)->make(
            $this->getKey(), $name, $scopes
        );
    }
}