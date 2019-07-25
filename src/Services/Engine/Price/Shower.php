<?php

namespace Betalabs\LaravelHelper\Services\Engine\Price;


use Betalabs\LaravelHelper\Services\Engine\AbstractShower;

class Shower extends AbstractShower
{
    /**
     * @var string
     */
    private $type = 'items';
    /**
     * @var boolean
     */
    private $useAliasId = true;
    /**
     * @var int[]
     */
    private $ids;
    /**
     * @var int[]
     */
    private $channels;

    /**
     * @param string $type
     * @return Shower
     */
    public function setType(string $type): Shower
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @param bool $useAliasId
     * @return Shower
     */
    public function setUseAliasId(bool $useAliasId): Shower
    {
        $this->useAliasId = $useAliasId;
        return $this;
    }

    /**
     * @param int[] $ids
     * @return Shower
     */
    public function setIds(array $ids): Shower
    {
        $this->ids = $ids;
        return $this;
    }

    /**
     * @param int[] $channels
     * @return Shower
     */
    public function setChannels(array $channels): Shower
    {
        $this->channels = $channels;
        return $this;
    }

    /**
     * Retrieve a resource on engine
     *
     * @return mixed
     */
    public function retrieve()
    {
        $this->engineResourceShower->setEndpointParameters([
            'type' => $this->type
        ]);
        $this->query = [
            'useAliasId' => $this->useAliasId,
            'ids' => $this->ids,
            'channels' => $this->channels
        ];
        return parent::retrieve();
    }

}