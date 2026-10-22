<?php


namespace App\Structures;

use Betalabs\LaravelHelper\Structures\ConfigurationStructureInterface;
use Betalabs\StructureHelper\Structures\Component\Box;
use Betalabs\StructureHelper\Structures\Component\Label;
use Betalabs\StructureHelper\Structures\Component\Route;
use Betalabs\StructureHelper\Structures\Component\Rule;
use Betalabs\StructureHelper\Structures\Component\Tooltip;
use Betalabs\StructureHelper\Structures\Structure;

class ConfigurationStructure extends Structure implements ConfigurationStructureInterface
{
    const TRANS_PATH = 'app/Structures/ConfigurationStructure.';

    /**
     * @return array
     */
    public function toArray(): array
    {
        return array_merge(
            ['type' => 'form'],
            parent::toArray()
        );
    }

    /**
     * @return Rule[]
     */
    public function rules(): array
    {
        return [];
    }


    /**
     * @return Box[]
     */
    public function boxes(): array
    {
        return [];
    }

    /**
     * @return Route[]
     */
    public function routes(): array
    {
        return [];
    }

    /**
     * @return Label[]
     */
    public function labels(): array
    {
        return [];
    }

    /**
     * @return Tooltip[]
     */
    public function tooltips()
    {
        return [];
    }

}
