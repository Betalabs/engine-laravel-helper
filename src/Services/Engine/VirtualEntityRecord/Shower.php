<?php

namespace Betalabs\LaravelHelper\Services\Engine\VirtualEntityRecord;


use Betalabs\LaravelHelper\Services\Engine\AbstractShower;

class Shower extends AbstractShower
{
    /**
     * @var int
     */
    private $virtualEntity;

    /**
     * @param int $virtualEntity
     * @return \Betalabs\LaravelHelper\Services\Engine\VirtualEntityRecord\Shower
     */
    public function setVirtualEntity(int $virtualEntity): Shower
    {
        $this->virtualEntity = $virtualEntity;
        return $this;
    }

    /**
     * Retrieve a resource on engine
     *
     * @return mixed
     */
    public function retrieve()
    {
        $this->engineResourceShower->setEndpointParameters([
            'virtualEntity' => $this->virtualEntity
        ]);
        return parent::retrieve();
    }


}