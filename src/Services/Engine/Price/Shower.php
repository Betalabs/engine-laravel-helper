<?php

namespace Betalabs\LaravelHelper\Services\Engine\Price;


use Betalabs\LaravelHelper\Services\Engine\AbstractShower;

class Shower extends AbstractShower
{
    /**
     * @var int
     */
    private $virtualEntity;
    /**
     * @var int
     */
    private $virtualEntityRecord;
    /**
     * @var int
     */
    private $channel;

    /**
     * @param int $virtualEntity
     * @return Shower
     */
    public function setVirtualEntity(int $virtualEntity): Shower
    {
        $this->virtualEntity = $virtualEntity;
        return $this;
    }

    /**
     * @param int $virtualEntityRecord
     * @return Shower
     */
    public function setVirtualEntityRecord(int $virtualEntityRecord): Shower
    {
        $this->virtualEntityRecord = $virtualEntityRecord;
        return $this;
    }

    /**
     * @param int $channel
     * @return Shower
     */
    public function setChannel(int $channel): Shower
    {
        $this->channel = $channel;
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
            'virtualEntity' => $this->virtualEntity,
            'virtualEntityRecord' => $this->virtualEntityRecord,
            'channel' => $this->channel
        ]);
        return parent::retrieve();
    }

    /**
     * @param int|null $recordId
     * @return \Betalabs\LaravelHelper\Services\Engine\AbstractShower
     * @throws \Exception
     */
    public function setRecordId(?int $recordId): AbstractShower
    {
        throw new \Exception('Invalid method.');
    }


}