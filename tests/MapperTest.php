<?php

namespace Betalabs\LaravelHelper\Tests;


use Betalabs\LaravelHelper\Services\App\FieldMapping\Mapper;
use Betalabs\LaravelHelper\Services\Engine\VirtualEntityRecord\Structure;

class MapperTest extends TestCase
{
    public function testMapper()
    {
        $appRegistryId = 20;
        $mapping = new \stdClass();

        $field = new \stdClass();
        $field->entity_id = 20;
        $field->app_registry_id = $appRegistryId;
        $field->identification = 'brand';
        $field->fields = ['marca_10_25'];

        $field2 = new \stdClass();
        $field2->entity_id = 20;
        $field2->app_registry_id = $appRegistryId;
        $field2->identification = 'description';
        $field2->fields = ['descricao_10_14'];

        $mapping->field = [$field, $field2];

        $fieldMaps = [
            'mapping' => $mapping
        ];
        $structure = \Mockery::mock(Structure::class);
        $structure->shouldReceive('setQuery')
            ->with(['data' => 'mapping'])
            ->once()
            ->andReturnSelf();
        $structure->shouldReceive('index')
            ->once()
            ->andReturn(collect($fieldMaps));

        /**@var Mapper $mapper**/
        $mapper = resolve(Mapper::class);
        $fields = $mapper->setAppRegistryId($appRegistryId)
            ->setMappableStructure($structure)
            ->get();
        $this->assertEquals($field->fields, $fields->get($field->identification));
        $this->assertEquals($field2->fields, $fields->get($field2->identification));
    }
}