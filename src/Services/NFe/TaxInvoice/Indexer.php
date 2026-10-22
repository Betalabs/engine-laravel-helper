<?php

namespace Betalabs\LaravelHelper\Services\NFe\TaxInvoice;


use Betalabs\LaravelHelper\Models\EngineRegistry;
use Betalabs\LaravelHelper\Services\Engine\AbstractIndexer;

class Indexer extends AbstractIndexer
{
    /**
     * @var int
     */
    private $registryId;

    /**
     * @return mixed
     */

    public function index()
    {
        // bySlug() already returns the model; when the slug does not exist
        // Eloquent returns the query builder instead
        $nfeRegistry = EngineRegistry::bySlug('nfe');

        $this->engineResourceIndexer->setEndpointParameters([
            'registryId' => $nfeRegistry instanceof EngineRegistry
                ? $nfeRegistry->registry_id
                : $this->registryId
        ]);
        return parent::index();
    }

    /**
     * @param $id
     * @return \Betalabs\LaravelHelper\Services\NFe\TaxInvoice\Indexer
     */
    public function byOrderId($id): Indexer
    {
        $this->query['code'] = $id;
        return $this;
    }

    /**
     * @return \Betalabs\LaravelHelper\Services\NFe\TaxInvoice\Indexer
     */
    public function authorized(): Indexer
    {
        $this->query['cStat_id'] = 100;
        return $this;
    }

    /**
     * @param int $registryId
     * @return Indexer
     */
    public function setRegistryId(int $registryId): Indexer
    {
        $this->registryId = $registryId;
        return $this;
    }

}
