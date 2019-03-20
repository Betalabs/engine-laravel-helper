<?php

namespace Betalabs\LaravelHelper\Helpers\Engine;

use Illuminate\Support\Facades\Auth;

class UrlMaker
{
    /**
     * Make a valid Engine API URL
     *
     * @param null|string $endpoint
     *
     * @return string
     */
    public static function makeUrl(string $endpoint): string
    {
        /** @var \Betalabs\LaravelHelper\Models\EngineRegistry $registry */
        $registry = Auth::user()->engineRegistry;

        return $registry->api_base_uri . '/' . trim($endpoint, '/');
    }
}