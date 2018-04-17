<?php

namespace Betalabs\LaravelHelper\Services\Company;

use Betalabs\LaravelHelper\Models\Company;
use Illuminate\Support\Facades\DB;

class Creator
{
    /**
     * @var array
     */
    private $companyData = [];

    /**
     * Set the companyData property.
     *
     * @param array $companyData
     */
    public function setCompanyData(array $companyData): void
    {
        $this->companyData = $companyData;
    }

    /**
     * Create a new company.
     *
     * @return \Betalabs\LaravelHelper\Models\Company
     * @throws \Exception
     */
    public function create(): Company
    {
        try {
            DB::beginTransaction();

            $company = Company::create($this->companyData);
            $company->accessToken = $company
                ->createToken("{$company->name} token")
                ->accessToken;

            DB::commit();

            return $company;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }
}