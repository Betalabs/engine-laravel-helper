<?php

namespace Betalabs\LaravelHelper\Services\Engine;


interface EngineResourceCreator
{
    public function setEndpoint(string $endpoint): self;

    public function setEndpointParameters(array $endpointParameters): self;

    public function setData(array $data): self;

    public function setExceptionMessage(string $exceptionMessage): self;

    public function create();
}