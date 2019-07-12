<?php


namespace Betalabs\LaravelHelper\Tests\Feature\Configuration;


use Betalabs\LaravelHelper\Structures\ConfigurationStructureInterface;

class ConfigurationStructureMock implements ConfigurationStructureInterface
{
    public function labels(): array
    {
        return [
            'config' => 'label'
        ];
    }

    public function translations(): array
    {
        return [];
    }

    public function rules(): array
    {
        return [
            'config' => 'string'
        ];
    }

    public function validations(): array
    {
        return [];
    }

    public function routes(): array
    {
        return [];
    }

    public function formats(): array
    {
        return [];
    }

    public function selectable(): array
    {
        return [];
    }

    public function extraForms(): array
    {
        return [];
    }

    public function importable(): array
    {
        return [];
    }

    public function boxes(): array
    {
        return [];
    }

    public function columns(): array
    {
        return [];
    }

    public function dynamic(): array
    {
        return [];
    }

    public function reports()
    {
        return [];
    }

    public function with()
    {
        return [];
    }

    public function toArray()
    {
        return [
            'type' => 'form',
            'rules' => $this->rules(),
            'labels' => $this->labels()
        ];
    }

    public function toJson($options = 0)
    {
        return \json_encode(['data' => $this->toArray()]);
    }
}