<?php

namespace Betalabs\LaravelHelper\Services\Engine\VirtualEntityRecord;


use Betalabs\LaravelHelper\Services\Engine\AbstractIndexer;

class Indexer extends AbstractIndexer
{
    /**
     * @var int
     */
    private $virtualEntity;

    /**
     * @param int $virtualEntity
     * @return \Betalabs\LaravelHelper\Services\Engine\VirtualEntityRecord\Indexer
     */
    public function setVirtualEntity(int $virtualEntity): Indexer
    {
        $this->virtualEntity = $virtualEntity;
        return $this;
    }

    /**
     * Retrieve a resource on engine
     *
     * @return mixed
     */
    public function index()
    {
        $this->engineResourceIndexer->setEndpointParameters([
            'virtualEntity' => $this->virtualEntity
        ]);
        return parent::index();
    }


}