<?php


namespace Betalabs\LaravelHelper\Helpers\Engine;


use Betalabs\LaravelHelper\Models\EngineVirtualEntity;
use Betalabs\LaravelHelper\Models\Enums\EngineVirtualEntity as VirtualEntityType;
use Illuminate\Contracts\Auth\Authenticatable;

class VirtualEntity
{
    /**
     * Return a virtual-entity resource
     *
     * @param \Illuminate\Contracts\Auth\Authenticatable $company
     * @param \Betalabs\LaravelHelper\Models\Enums\EngineVirtualEntity $type
     *
     * @return string
     */
    public static function resource(
        Authenticatable $company,
        VirtualEntityType $type
    ): string {
        $virtualEntity = EngineVirtualEntity::where('company_id', $company->id)
            ->where('type', $type->getValue())->first();
        return "virtual-entities/{$virtualEntity->code}/records";
    }
}