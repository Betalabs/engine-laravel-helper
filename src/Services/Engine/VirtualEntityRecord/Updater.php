<?php

namespace Betalabs\LaravelHelper\Services\Engine\VirtualEntityRecord;


use Betalabs\LaravelHelper\Services\Engine\AbstractUpdater;

class Updater extends AbstractUpdater
{
    /**
     * @var int
     */
    private $virtualEntity;

    /**
     * @param int $virtualEntity
     * @return \Betalabs\LaravelHelper\Services\Engine\VirtualEntityRecord\Updater
     */
    public function setVirtualEntity(int $virtualEntity): Updater
    {
        $this->virtualEntity = $virtualEntity;
        return $this;
    }

    /**
     * @return mixed
     */
    public function update()
    {
        $this->engineResourceUpdater->setEndpointParameters([
            'virtualEntity' => $this->virtualEntity
        ]);
        return parent::update();
    }
}