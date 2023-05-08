<?php

namespace Betalabs\LaravelHelper\Http\Controllers;

use Illuminate\Routing\Controller;

class HealthCheckController extends Controller
{
    public function check()
    {
        return 'Application is up and running';
    }
}
