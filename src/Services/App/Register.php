<?php

namespace Betalabs\LaravelHelper\Services\App;

use Betalabs\LaravelHelper\Models\Company;
use Betalabs\LaravelHelper\Services\Company\Creator;

class Register
{
    /**
     * @var array
     */
    private $appData = [];
    /**
     * @var \Betalabs\LaravelHelper\Services\Company\Creator
     */
    private $creator;

    /**
     * Register constructor.
     *
     * @param \Betalabs\LaravelHelper\Services\Company\Creator $creator
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
     * @return \Betalabs\LaravelHelper\Models\Company
     * @throws \Exception
     */
    public function registration(): Company
    {
        $this->creator->setCompanyData($this->appData['company']);
        $company = $this->creator->create();

        $company->appConfiguration()
            ->create($this->appData['app_configuration']);

        $company->engineCredential()
            ->create($this->appData['engine_credential']);

        return $company;
    }
}