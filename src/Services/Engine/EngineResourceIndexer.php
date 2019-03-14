<?php

namespace Betalabs\LaravelHelper\Services\Engine;


interface EngineResourceIndexer
{
    public function setEndpoint(string $endpoint): self;

    public function setQuery(array $query): self;

    public function setLimit(int $limit): self;

    public function setOffset(int $offset): self;

    public function setExceptionMessage(string $exceptionMessage): self;

    public function retrieve();

}