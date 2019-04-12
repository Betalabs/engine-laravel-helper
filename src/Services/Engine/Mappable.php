<?php

namespace Betalabs\LaravelHelper\Services\Engine;


interface Mappable
{
    /**
     * @return mixed
     */
    public function index();

    /**
     * @param array $query
     * @return mixed
     */
    public function setQuery(array $query);
}