<?php

namespace Betalabs\LaravelHelper\Services\Engine;


interface EngineResourceShower
{
    public function setEndpoint(string $endpoint): self;

    public function setEndpointParameters(array $endpointParameters): self;

    public function setRecordId(int $recordId): self;

    public function setQuery(array $query): self;

    public function setExceptionMessage(string $exceptionMessage): self;

    public function retrieve();
}