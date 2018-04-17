<?php

namespace Betalabs\LaravelHelper\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EngineCredential extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'client_id',
        'client_secret',
        'username',
        'password'
    ];

    /**
     * Return the related company.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}
