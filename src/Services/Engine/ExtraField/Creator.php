<?php

namespace Betalabs\LaravelHelper\Services\Engine\ExtraField;


use Betalabs\LaravelHelper\Services\Engine\AbstractCreator;

class Creator extends AbstractCreator
{
    /**
     * @var array
     */
    private $options = [];
    /**
     * @var string
     */
    private $label;
    /**
     * @var int
     */
    private $extraFieldTypeId;
    /**
     * @var int
     */
    private $entityId;

    /**
     * @param array $options
     * @return Creator
     */
    public function setOptions(array $options): Creator
    {
        $this->options = $options;
        return $this;
    }

    /**
     * @param string $label
     * @return Creator
     */
    public function setLabel(string $label): Creator
    {
        $this->label = $label;
        return $this;
    }

    /**
     * @param int $extraFieldTypeId
     * @return Creator
     */
    public function setExtraFieldTypeId(int $extraFieldTypeId): Creator
    {
        $this->extraFieldTypeId = $extraFieldTypeId;
        return $this;
    }

    /**
     * @param int $entityId
     * @return Creator
     */
    public function setEntityId(int $entityId): Creator
    {
        $this->entityId = $entityId;
        return $this;
    }

    /**
     * @return mixed
     */
    public function create()
    {
        $this->data = [
            'label' => $this->label,
            'extra_field_type_id' => $this->extraFieldTypeId,
            'entity_id' => $this->entityId,
        ] + (!empty($this->options) ? ['options' => $this->options] : []);

        return parent::create();
    }

}