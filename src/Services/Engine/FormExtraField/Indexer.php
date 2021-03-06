<?php

namespace Betalabs\LaravelHelper\Services\Engine\FormExtraField;


use Betalabs\LaravelHelper\Services\Engine\AbstractIndexer;

class Indexer extends AbstractIndexer
{
    /**
     * @var int
     */
    private $formId;

    /**
     * @param int $formId
     * @return Indexer
     */
    public function setFormId(int $formId): Indexer
    {
        $this->formId = $formId;
        return $this;
    }

    /**
     * @return mixed
     */
    public function index()
    {
        $this->engineResourceIndexer->setEndpointParameters([
            'formId' => $this->formId
        ]);
        return parent::index();
    }


}