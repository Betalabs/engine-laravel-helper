<?php

namespace Betalabs\LaravelHelper\Models\Traits;

use Betalabs\LaravelHelper\Scopes\Tenant;

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

        static::addGlobalScope(new Tenant());
    }
}