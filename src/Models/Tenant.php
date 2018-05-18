<?php

namespace Betalabs\LaravelHelper\Models;

use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Tenant extends Authenticatable
{
    use HasApiTokens, Notifiable, SoftDeletes;

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
    ];

    /**
     * Return the related EngineRegistry.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function engineRegistry(): HasOne
    {
        return $this->hasOne(EngineRegistry::class);
    }
}