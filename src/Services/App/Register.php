<?php

namespace Betalabs\LaravelHelper\Services\App;

use Betalabs\LaravelHelper\Events\GenesisCompleted;
use Betalabs\LaravelHelper\Models\Tenant;
use Betalabs\LaravelHelper\Services\Tenant\Creator;
use Illuminate\Contracts\Events\Dispatcher;

class Register
{
    /**
     * @var array
     */
    private $appData = [];
    /**
     * @var \Betalabs\LaravelHelper\Services\Tenant\Creator
     */
    private $creator;
    /**
     * @var \Illuminate\Contracts\Events\Dispatcher
     */
    private $events;

    /**
     * Register constructor.
     *
     * @param \Betalabs\LaravelHelper\Services\Tenant\Creator $creator
     * @param \Illuminate\Contracts\Events\Dispatcher $events
     */
    public function __construct(Creator $creator, Dispatcher $events)
    {
        $this->creator = $creator;
        $this->events = $events;
    }

    /**
     * Set the appData property.
     *
     * @param array $appData
     */
    public function setAppData(array $appData): void
    {
        $this->appData = $appData;
    }

    /**
     * Register a new app user
     *
     * @return \Betalabs\LaravelHelper\Models\Tenant
     * @throws \Exception
     */
    public function registration(): Tenant
    {
        $tenant = $this->creator
            ->setData($this->appData['tenant'])
            ->create();

        $tenant->engineRegistry()->create($this->appData['engine_registry']);

        $this->events->dispatch(new GenesisCompleted($tenant));

        return $tenant;
    }
}