<?php

namespace Betalabs\LaravelHelper\Http\Controllers;

use Betalabs\LaravelHelper\Http\Requests\UpdateTenant;
use Betalabs\LaravelHelper\Http\Resources\Tenant;
use Betalabs\LaravelHelper\Services\Tenant\Updater;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

class TenantController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Display the tenant.
     *
     * @return \Betalabs\LaravelHelper\Http\Resources\Tenant
     */
    public function show(): Tenant
    {
        return new Tenant(Auth::user());
    }

    /**
     * Update the tenant.
     *
     * @param \Betalabs\LaravelHelper\Http\Requests\UpdateTenant $request
     *
     * @param \Betalabs\LaravelHelper\Services\Tenant\Updater $updater
     * @return \Betalabs\LaravelHelper\Http\Resources\Tenant
     */
    public function update(UpdateTenant $request, Updater $updater): Tenant
    {
        return new Tenant($updater->update(Auth::user(), $request->input()));
    }
}