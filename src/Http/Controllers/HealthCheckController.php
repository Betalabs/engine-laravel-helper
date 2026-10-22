<?php

namespace Betalabs\LaravelHelper\Http\Controllers;

class HealthCheckController extends Controller
{
    public function check()
    {
        return 'Application is up and running';
    }
}
