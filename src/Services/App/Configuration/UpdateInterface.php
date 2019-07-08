<?php


namespace Betalabs\LaravelHelper\Services\App\Configuration;


interface UpdateInterface
{
    /**
     * Implements the logic to update the configuration.
     *
     * @param array $data
     * @return mixed
     */
    public function update(array $data);
}