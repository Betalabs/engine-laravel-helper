<?php

namespace Betalabs\LaravelHelper\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Auth;

class Tenant implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder $builder
     * @param  \Illuminate\Database\Eloquent\Model $model
     *
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {
        // Qualificado pela tabela: em consultas com JOIN (ex.: listagens com
        // _fields=orders->code) o `tenant_id` sozinho e ambiguo no MySQL.
        $builder->where($model->getTable() . '.tenant_id', Auth::id());
    }
}