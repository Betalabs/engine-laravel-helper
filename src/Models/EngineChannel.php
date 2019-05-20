<?php

namespace Betalabs\LaravelHelper\Models;


use Betalabs\LaravelHelper\Models\Traits\BelongsToTenant;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EngineChannel extends Model
{
    use BelongsToTenant;

    /**
     * @var array
     */
    protected $fillable = [
        'code',
        'slug',
        'tenant_id'
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
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|null|object
     */
    public function scopeBySlug(Builder $query, $slug)
    {
        return $query->where(compact("slug"))->first();
    }
}