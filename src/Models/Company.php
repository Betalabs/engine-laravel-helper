<?php

namespace Betalabs\LaravelHelper\Models;

use Illuminate\Database\Eloquent\Relations\HasOne;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Company extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'trading_name',
        'email',
        'cnpj',
    ];

    /**
     * Return the related app configuration
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function appConfiguration(): HasOne
    {
        return $this->hasOne(AppConfiguration::class);
    }

    /**
     * Return the related engine credentials
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function engineCredential(): HasOne
    {
        return $this->hasOne(EngineCredential::class);
    }
}