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
        $engine = Auth::user()->engineRegistry;

        $endpoint = '';
        $endpoint .= $prefix ? trim($prefix, '/') . '/' : '';
        $endpoint .= "apps/{$engine->registry_id}/wormhole/";
        $endpoint .= trim($uri, '/');

        return $endpoint;
    }
}