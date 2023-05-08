<?php

namespace App\Http\Controllers;

use App\Structures\Menu\Configurations;
use Illuminate\Http\Request;
use App\Structures\Menu\App;

class FeatureMenuController extends Controller
{
    /**
     * Display the feature menu structure
     *
     * @param \App\Structures\Menu\App $app
     * @return \App\Structures\Menu\App
     */
    public function structure(App $app): App
    {
        return $app;
    }

    /**
     * Display the feature menu structure
     *
     * @return \App\Structures\Menu\Configurations
     */
    public function configurationStructure(): Configurations
    {
        return new Configurations();
    }

}
