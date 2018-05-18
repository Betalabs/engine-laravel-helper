<?php

namespace Betalabs\LaravelHelper\Services\App;

use Betalabs\LaravelHelper\Models\Tenant;
use Betalabs\LaravelHelper\Services\Tenant\Creator;

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
     * Register constructor.
     *
     * @param \Betalabs\LaravelHelper\Services\Tenant\Creator $creator
     */
    public function __construct(Creator $creator)
    {
        $this->creator = $creator;
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
        $this->creator->setData($this->appData['tenant']);
        $company = $this->creator->create();

        $company->engineRegistry()->create($this->appData['engine_registry']);

        return $company;
    }
}