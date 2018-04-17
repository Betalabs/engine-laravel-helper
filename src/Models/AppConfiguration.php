<?php

namespace Betalabs\LaravelHelper\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AppConfiguration extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'engine_app_registry_id',
        'engine_api_base_uri',
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
