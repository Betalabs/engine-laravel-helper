<?php

namespace Betalabs\LaravelHelper\Services\Engine\Form;


use Betalabs\LaravelHelper\Services\Engine\AbstractCreator;

class Creator extends AbstractCreator
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var array
     */
    private $channels;
    /**
     * @var int
     */
    private $entityId;

    /**
     * @param string $name
     * @return Creator
     */
    public function setName(string $name): Creator
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param array $channels
     * @return Creator
     */
    public function setChannels(array $channels): Creator
    {
        $this->channels = $channels;
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
            'name' => $this->name,
            'entity_id' => $this->entityId,
            'channels' => $this->channels,
        ];

        return parent::create();
    }
}