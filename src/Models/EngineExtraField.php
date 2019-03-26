<?php

namespace Betalabs\LaravelHelper\Models;


use Betalabs\LaravelHelper\Models\Traits\BelongsToTenant;
use Illuminate\Database\Eloquent\Model;

class EngineExtraField extends Model
{
    use BelongsToTenant;

    protected $fillable = [
        'tenant_id',
        'slug',
        'code',
        'label',
        'form_code',
    ];

    /**
     * Get Engine API extra field key
     *
     * @return string
     */
    public function getSlugKeyAttribute()
    {
        return $this->slug . '_' . $this->form_code . '_' . $this->code;
    }
}