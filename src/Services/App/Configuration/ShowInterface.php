<?php


namespace Betalabs\LaravelHelper\Services\App\Configuration;


interface ShowInterface
{
    /**
     * The returned array/collection must follow the form:
     * [
     *      [
     *          'key' => 'key'
     *          'value' => 'value'
     *      ]
     * ]
     *
     * @return mixed
     */
    public function show();
}