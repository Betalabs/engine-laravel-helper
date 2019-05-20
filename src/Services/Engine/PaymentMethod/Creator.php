<?php

namespace Betalabs\LaravelHelper\Services\Engine\PaymentMethod;


use Betalabs\LaravelHelper\Models\Enums\PaymentMethodType;
use Betalabs\LaravelHelper\Services\Engine\AbstractCreator;

class Creator extends AbstractCreator
{
    /**
     * @var string
     */
    private $name;
    /**
     * @var \Betalabs\LaravelHelper\Models\Enums\PaymentMethodType
     */
    private $type;
    /**
     * @var int
     */
    private $channels;

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
     * @param \Betalabs\LaravelHelper\Models\Enums\PaymentMethodType $type
     * @return Creator
     */
    public function setType(PaymentMethodType $type): Creator
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @param int[] $channels
     * @return Creator
     */
    public function setChannels(array $channels): Creator
    {
        $this->channels = $channels;
        return $this;
    }

    /**
     * @return mixed
     */
    public function create()
    {
        $this->data = [
            'name' => $this->name,
            'type' => $this->type,
            'channels' => $this->channels,
        ];
        return parent::create();
    }


}