<?php

namespace Betalabs\LaravelHelper\Http\Controllers;

use Betalabs\LaravelHelper\Http\Requests\UpdateTenant;
use Betalabs\LaravelHelper\Http\Resources\Tenant;
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
     * @return \Betalabs\LaravelHelper\Http\Resources\Tenant
     */
    public function update(UpdateTenant $request): Tenant
    {
        /** @var \Betalabs\LaravelHelper\Models\Tenant $tenant */
        $tenant = Auth::user();
        $tenant->update($request->input());

        return new Tenant($tenant);
    }
}