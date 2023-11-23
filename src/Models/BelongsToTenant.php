<?php

namespace Betalabs\LaravelHelper\Models;

use Illuminate\Database\Eloquent\Builder;

trait BelongsToTenant
{
    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('tenant', function(Builder $builder) {
            if(\Auth::check()) {
                $builder->where('tenant_id', \Auth::id());
            }
        });
    }
}
