<?php

namespace Betalabs\LaravelHelper\Http\Controllers;

use Betalabs\LaravelHelper\Http\Resources\Registry;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Betalabs\LaravelHelper\Http\Requests\Register as RegisterRequest;
use Betalabs\LaravelHelper\Http\Resources\Tenant;
use Betalabs\LaravelHelper\Services\App\Register;

class AppController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Register a new app user
     *
     * @param \Betalabs\LaravelHelper\Http\Requests\Register $request
     * @param \Betalabs\LaravelHelper\Services\App\Register $service
     *
     * @return Registry
     * @throws \Exception
     */
    public function register(
        RegisterRequest $request,
        Register $service
    ): Registry {
        $service->setAppData($request->input());

        return new Registry($service->registration());
    }
}
