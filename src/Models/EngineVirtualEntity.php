<?php

namespace Betalabs\LaravelHelper\Models;

use Betalabs\LaravelHelper\Models\Traits\BelongsToTenant;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EngineVirtualEntity extends Model
{
    use BelongsToTenant;

    /**
     * @var array
     */
    protected $fillable = [
        'tenant_id',
        'code',
        'type_id',
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
     * Return the related Engine virtual entity type.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function engineVirtualEntityType(): BelongsTo
    {
        return $this->belongsTo(EngineVirtualEntityType::class, 'type_id');
    }

    /**
     * Return Virtual Entity By Type ID
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param int $typeId
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|null|object
     */
    public function scopeByTypeId(Builder $query, int $typeId)
    {
        return $query->where('type_id', $typeId)->first();
    }
}
