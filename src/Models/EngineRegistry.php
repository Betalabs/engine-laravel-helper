<?php

namespace Betalabs\LaravelHelper\Models;

use Betalabs\LaravelHelper\Models\Traits\BelongsToTenant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int registry_id
 */
class EngineRegistry extends Model
{
    use BelongsToTenant;

    /**
     * @var array
     */
    protected $fillable = [
        'tenant_id',
        'registry_id',
        'api_base_uri',
        'api_access_token',
    ];

    /**
     * Return the related Tenant.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }
}
