<?php

namespace Betalabs\LaravelHelper\Listeners;


use Betalabs\LaravelHelper\Events\ExtraFieldAndFormCreated;
use Betalabs\LaravelHelper\Services\App\ExtraField\Store;

class StoreExtraField
{
    /**
     * @var \Betalabs\LaravelHelper\Services\App\ExtraField\Store
     */
    private $store;

    /**
     * StoreExtraField constructor.
     * @param \Betalabs\LaravelHelper\Services\App\ExtraField\Store $store
     */
    public function __construct(Store $store)
    {
        $this->store = $store;
    }

    /**
     * Handle the event
     * @param \Betalabs\LaravelHelper\Events\ExtraFieldAndFormCreated $event
     */
    public function handle(ExtraFieldAndFormCreated $event)
    {
        $extraField = $event->getExtraField();
        $this->store->setExtraFieldCode($extraField->id)
            ->setExtraFieldLabel($extraField->label)
            ->setExtraFieldSlug($extraField->slug)
            ->setFormCode($event->getForm()->id)
            ->setTenantId($event->getTenant()->id)
            ->store();
    }
}