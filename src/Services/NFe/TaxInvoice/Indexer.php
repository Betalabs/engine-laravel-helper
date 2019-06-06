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
        $this->engineResourceIndexer->setEndpointParameters([
            'registryId' => EngineRegistry::bySlug('nfe') ?? $this->registryId
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