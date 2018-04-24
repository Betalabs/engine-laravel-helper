<?php

namespace Betalabs\LaravelHelper\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EngineVirtualEntity extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'code',
        'type',
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
