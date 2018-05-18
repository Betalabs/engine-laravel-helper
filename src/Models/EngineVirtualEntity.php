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
}
