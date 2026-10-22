<?php


namespace App\Structures\Menu;

use Betalabs\StructureHelper\Structures\Menu\Structure;

class Configurations extends Structure
{

    /**
     * @return string
     */
    public function label(): string
    {
        return trans('app/Structures/Menu/Menu.label');
    }

    /**
     * @return string
     */
    public function endpoint(): string
    {
        return '';
    }

    /**
     * @return Configuration[]
     */
    public function submenu(): array
    {
        return [
            new Configuration(),
        ];
    }
}
