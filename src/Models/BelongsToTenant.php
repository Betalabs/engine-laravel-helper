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
                // Qualificado pela tabela, como em Scopes\Tenant: com JOIN o
                // `tenant_id` sozinho e ambiguo no MySQL.
                $builder->where($builder->qualifyColumn('tenant_id'), \Auth::id());
            }
        });
    }
}
