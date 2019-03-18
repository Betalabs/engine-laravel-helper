<?php

namespace Betalabs\LaravelHelper\Services\Engine\FormExtraField;


use Betalabs\LaravelHelper\Services\Engine\AbstractCreator;

class Creator extends AbstractCreator
{
    /**
     * @var int
     */
    private $formId;
    /**
     * @var int
     */
    private $extraFieldId;

    /**
     * @param int $formId
     * @return Creator
     */
    public function setFormId(int $formId): Creator
    {
        $this->formId = $formId;
        return $this;
    }

    /**
     * @param int $extraFieldId
     * @return Creator
     */
    public function setExtraFieldId(int $extraFieldId): Creator
    {
        $this->extraFieldId = $extraFieldId;
        return $this;
    }

    /**
     * Create resource on engine
     *
     * @return mixed
     */
    public function create()
    {
        $this->engineResourceCreator->setEndpointParameters([
            'formId' => $this->formId
        ]);
        $this->data = ['extra_field_id' => $this->extraFieldId];
        return parent::create();
    }

}