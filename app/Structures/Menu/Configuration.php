<?php


namespace App\Structures\Menu;

use Betalabs\LaravelHelper\Helpers\Engine\Wormhole;
use Betalabs\StructureHelper\Structures\Menu\Structure;

class Configuration extends Structure
{

    /**
     * @return string
     */
    public function label(): string
    {
        return trans('app/Structures/Configuration/Configuration.configLabel');
    }

    /**
     * @return string
     */
    public function endpoint(): string
    {
        return Wormhole::makeEndpoint('configs/update/data');
    }

    /**
     * @return string
     */
    public function tooltip(): string
    {
        return trans('app/Structures/Configuration/Configuration.AppConfiguration-tooltip');
    }

    /*
     * @return string
     */
    public function loadIcon(): string
    {
        return 'align-justify';
    }

}
