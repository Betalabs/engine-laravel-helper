<?php

namespace Betalabs\LaravelHelper\Services\Engine\FieldMap;


use Betalabs\LaravelHelper\Services\Engine\AbstractCreator;

class Creator extends AbstractCreator
{
    /**
     * @var int
     */
    private $entityId;
    /**
     * @var int
     */
    private $appRegistryId;
    /**
     * @var string
     */
    private $identification;
    /**
     * @var int
     */
    private $formExtraFieldId;

    /**
     * @param mixed $entityId
     * @return \Betalabs\LaravelHelper\Services\Engine\FieldMap\Creator
     */
    public function setEntityId($entityId): Creator
    {
        $this->entityId = $entityId;
        return $this;
    }

    /**
     * @param int $appRegistryId
     * @return \Betalabs\LaravelHelper\Services\Engine\FieldMap\Creator
     */
    public function setAppRegistryId(int $appRegistryId): Creator
    {
        $this->appRegistryId = $appRegistryId;
        return $this;
    }

    /**
     * @param string $identification
     * @return \Betalabs\LaravelHelper\Services\Engine\FieldMap\Creator
     */
    public function setIdentification(string $identification): Creator
    {
        $this->identification = $identification;
        return $this;
    }

    /**
     * @param int $formExtraFieldId
     * @return \Betalabs\LaravelHelper\Services\Engine\FieldMap\Creator
     */
    public function setFormExtraFieldId(int $formExtraFieldId): Creator
    {
        $this->formExtraFieldId = $formExtraFieldId;
        return $this;
    }

    /**
     * @return mixed
     */
    public function create()
    {
        $this->data = [
            'entity_id' => $this->entityId,
            'app_registry_id' => $this->appRegistryId,
            'identification' => $this->identification,
            'form_extra_field_id' => $this->formExtraFieldId
        ];
        return parent::create();
    }


}