<?php


namespace Betalabs\LaravelHelper\Helpers\Engine;


use Illuminate\Support\Facades\Auth;

class Wormhole
{
    /**
     * Make a valid wormhole endpoint
     *
     * @param string $uri
     * @param string $prefix
     *
     * @return string
     */
    public static function makeEndpoint(
        string $uri,
        string $prefix = ''
    ): string {
        $config = Auth::user()->appConfiguration;

        $endpoint = '';
        $endpoint .= $prefix ? trim($prefix, '/') . '/' : '';
        $endpoint .= 'apps/';
        $endpoint .= $config->engine_app_registry_id;
        $endpoint .= '/wormhole/';
        $endpoint .= trim($uri, '/');

        return $endpoint;
    }
}