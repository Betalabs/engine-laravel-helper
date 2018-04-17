<?php

namespace Betalabs\LaravelHelper\Http\Controllers;

use Betalabs\LaravelHelper\Http\Requests\UpdateCompany;
use Betalabs\LaravelHelper\Http\Resources\Company;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

class CompanyController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Display the company.
     *
     * @return \Betalabs\LaravelHelper\Http\Resources\Company
     */
    public function show(): Company
    {
        return new Company(Auth::user());
    }

    /**
     * Update the company.
     *
     * @param \Betalabs\LaravelHelper\Http\Requests\UpdateCompany $request
     *
     * @return \Betalabs\LaravelHelper\Http\Resources\Company
     */
    public function update(UpdateCompany $request): Company
    {
        $company = Auth::user();
        $company->update($request->input());

        return new Company($company);
    }
}