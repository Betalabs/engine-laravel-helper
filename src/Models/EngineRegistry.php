<?php

namespace Betalabs\LaravelHelper\Models;

use Betalabs\LaravelHelper\Models\Traits\BelongsToTenant;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int registry_id
 * @method static bySlug(string $string)
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
        'slug'
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

    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param $slug
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model
     */
    public function scopeBySlug(Builder $query, $slug)
    {
        return $query->where(compact('slug'))->firstOr(function () {
            return null;
        });
    }
}
