<?php

namespace Betalabs\LaravelHelper\Structures\Menu;

use Betalabs\StructureHelper\Structures\Menu\Structure;

class App extends Structure
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

    public function submenu(): array
    {
        return [
            new Configuration()
        ];
    }
}

