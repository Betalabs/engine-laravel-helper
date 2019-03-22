<?php

namespace Betalabs\LaravelHelper\Listeners;

use Betalabs\LaravelHelper\Events\ChannelCreated;
use Betalabs\LaravelHelper\Services\App\Channel\Store;
use Betalabs\LaravelHelper\Models\EngineChannel;

class StoreChannel
{
    /**
     * @var \Betalabs\LaravelHelper\Services\App\Channel\Store
     */
    private $store;

    /**
     * StoreChannel constructor.
     * @param \Betalabs\LaravelHelper\Services\App\Channel\Store $store
     */
    public function __construct(Store $store)
    {
        $this->store = $store;
    }

    /**
     * Handle the event
     * @param \Betalabs\LaravelHelper\Events\ChannelCreated $event
     * @return \Betalabs\LaravelHelper\Models\EngineChannel
     */
    public function handle(ChannelCreated $event): EngineChannel
    {
        $data = $event->getData();
        return $this->store
            ->setCode($data->id)
            ->setSlug($data->channel)
            ->setTenantId($event->getTenant()->id)
            ->store();
    }
}