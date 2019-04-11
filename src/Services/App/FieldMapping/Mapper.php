<?php

namespace Betalabs\LaravelHelper\Services\App\FieldMapping;

use Betalabs\LaravelHelper\Services\Engine\Mappable;
use Illuminate\Support\Collection;

class Mapper
{
    /**
     * @var \Betalabs\LaravelHelper\Services\Engine\Mappable
     */
    private $mappableStructure;
    /**
     * @var int
     */
    private $appRegistryId;

    /**
     * @param \Betalabs\LaravelHelper\Services\Engine\Mappable $mappableStructure
     * @return \Betalabs\LaravelHelper\Services\App\FieldMapping\Mapper
     */
    public function setMappableStructure(Mappable $mappableStructure): Mapper
    {
        $this->mappableStructure = $mappableStructure;
        return $this;
    }

    /**
     * @param int $appRegistryId
     * @return \Betalabs\LaravelHelper\Services\App\FieldMapping\Mapper
     */
    public function setAppRegistryId(int $appRegistryId): Mapper
    {
        $this->appRegistryId = $appRegistryId;
        return $this;
    }

    /**
     * Return Mapping Fields from this app and mappable structure
     *
     * @return \Illuminate\Support\Collection
     */
    public function get(): Collection
    {
        /**@var \Illuminate\Support\Collection $index**/
        $index = $this->mappableStructure
            ->setQuery(['data' => 'mapping'])
            ->index();

        $parsedFields = collect([]);
        if($mapping = $this->getMapping($index)) {
            collect($mapping->field)->each(function($field) use($parsedFields) {
                if($field->app_registry_id == $this->appRegistryId){
                    $parsedFields->put($field->identification, $field->fields);
                }
            });
        }
        return $parsedFields;
    }

    /**
     * @param \Illuminate\Support\Collection $index
     * @return mixed
     */
    private function getMapping(Collection $index)
    {
        return (!empty($mapping = $index->get('mapping')))
            ? $mapping
            : null;
    }
}