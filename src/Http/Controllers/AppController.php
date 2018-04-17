<?php

namespace Betalabs\LaravelHelper\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Betalabs\LaravelHelper\Http\Requests\Register as RegisterRequest;
use Betalabs\LaravelHelper\Http\Resources\Company;
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
     * @return \Betalabs\LaravelHelper\Http\Resources\Company
     * @throws \Exception
     */
    public function register(
        RegisterRequest $request,
        Register $service
    ): Company {
        $service->setAppData($request->input());
        return new Company($service->registration());
    }
}
