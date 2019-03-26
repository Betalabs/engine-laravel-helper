<?php

namespace Betalabs\LaravelHelper\Services\App\VirtualEntity;


use Betalabs\LaravelHelper\Models\Enums\EngineVirtualEntity;
use Betalabs\LaravelHelper\Services\Engine\VirtualEntity\Indexer;
use Betalabs\LaravelHelper\Models\EngineVirtualEntity as EngineVirtualEntityModel;

class Creator
{
    /**
     * @var \Betalabs\LaravelHelper\Services\Engine\VirtualEntity\Indexer
     */
    private $indexer;

    /**
     * Creator constructor.
     * @param \Betalabs\LaravelHelper\Services\Engine\VirtualEntity\Indexer $indexer
     */
    public function __construct(Indexer $indexer)
    {
        $this->indexer = $indexer;
    }

    /**
     * Populate database with engine virtual entity info
     */
    public function create()
    {
        $productVirtualEntityId = $this->retrieveVirtualEntityId();
        EngineVirtualEntityModel::updateOrCreate(
            [
                "tenant_id" => Auth()->user()->id
            ],
            [
                "code" => $productVirtualEntityId,
                "type_id" => EngineVirtualEntity::PRODUCT
            ]
        );
    }

    /**
     * Retrieve Product Virtual Entity ID from Engine
     *
     * @return mixed
     */
    protected function retrieveVirtualEntityId()
    {
        try {
            $productVirtualEntity = $this->indexer
                ->setQuery(['slug' => EngineVirtualEntity::ITEMS_SLUG])
                ->index();
            return $productVirtualEntity->first()->id;
        } catch (\Exception $e) {
            throw new \RuntimeException(
                'Product Virtual entity not found.'
            );
        }
    }
}