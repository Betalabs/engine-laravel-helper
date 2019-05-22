<?php

namespace Betalabs\LaravelHelper\Services\Engine\Client;


use Betalabs\LaravelHelper\Services\Engine\AbstractIndexer;

class Indexer extends AbstractIndexer
{
    public function byEmail(string $email)
    {
        $this->query = compact('email');
        return parent::index();
    }
}