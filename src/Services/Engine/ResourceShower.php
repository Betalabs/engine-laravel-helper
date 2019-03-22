<?php

namespace Betalabs\LaravelHelper\Services\Engine;

use Betalabs\Engine\Request;
use Illuminate\Http\Response;
use Psr\Http\Message\ResponseInterface;

class ResourceShower implements EngineResourceShower
{
    use ReplacesEndpointParameters;

    /**
     * @var string
     */
    protected $endpoint;
    /**
     * @var array
     */
    protected $endpointParameters = [];
    /**
     * @var int
     */
    protected $recordId;
    /**
     * @var array
     */
    protected $query = [];
    /**
     * @var string string
     */
    protected $exceptionMessage = 'Resource could not be retrieved.';

    /**
     * @param string $endpoint
     * @return \Betalabs\LaravelHelper\Services\Engine\EngineResourceShower
     */
    public function setEndpoint(string $endpoint): EngineResourceShower
    {
        $this->endpoint = $endpoint;
        return $this;
    }

    /**
     * @param array $endpointParameters
     * @return \Betalabs\LaravelHelper\Services\Engine\EngineResourceShower
     */
    public function setEndpointParameters(?array $endpointParameters): EngineResourceShower
    {
        $this->endpointParameters = $endpointParameters ?? [];
        return $this;
    }

    /**
     * @param int|null $recordId
     * @return \Betalabs\LaravelHelper\Services\Engine\EngineResourceShower
     */
    public function setRecordId(int $recordId): EngineResourceShower
    {
        $this->recordId = $recordId;
        return $this;
    }

    /**
     * @param array|null $query
     * @return \Betalabs\LaravelHelper\Services\Engine\EngineResourceShower
     */
    public function setQuery(?array $query): EngineResourceShower
    {
        $this->query = $query ?? [];
        return $this;
    }

    /**
     * @param string $exceptionMessage
     * @return \Betalabs\LaravelHelper\Services\Engine\EngineResourceShower
     */
    public function setExceptionMessage(string $exceptionMessage): EngineResourceShower
    {
        $this->exceptionMessage = $exceptionMessage;
        return $this;
    }

    /**
     * Retrieve a single resource
     *
     * @return mixed
     */
    public function retrieve()
    {
        $query = http_build_query($this->query);

        $request = Request::get();
        $this->replaceEndpointParameters();
        $record = $request->send("{$this->endpoint}/{$this->recordId}/?{$query}");

        $this->errors($request->getResponse());

        return $record->data;
    }

    /**
     * Handle request response
     *
     * @param \Psr\Http\Message\ResponseInterface $response
     */
    protected function errors(ResponseInterface $response): void
    {
        if ($response->getStatusCode() != Response::HTTP_OK) {
            throw new \RuntimeException($this->exceptionMessage);
        }
    }
}