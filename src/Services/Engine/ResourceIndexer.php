<?php

namespace Betalabs\LaravelHelper\Services\Engine;

use Betalabs\Engine\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;
use Psr\Http\Message\ResponseInterface;

class ResourceIndexer implements EngineResourceIndexer
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
     * @var array
     */
    protected $query = [];
    /**
     * @var int
     */
    protected $limit = 100;
    /**
     * @var int
     */
    protected $offset = 0;
    /**
     * @var string string
     */
    protected $exceptionMessage = 'Resource could not be retrieved.';

    /**
     * @param string $endpoint
     * @return \Betalabs\LaravelHelper\Services\Engine\EngineResourceIndexer
     */
    public function setEndpoint(string $endpoint): EngineResourceIndexer
    {
        $this->endpoint = $endpoint;
        return $this;
    }

    /**
     * @param array|null $endpointParameters
     * @return \Betalabs\LaravelHelper\Services\Engine\EngineResourceIndexer
     */
    public function setEndpointParameters(?array $endpointParameters): EngineResourceIndexer
    {
        $this->endpointParameters = $endpointParameters;
        return $this;
    }

    /**
     * @param array|null $query
     * @return \Betalabs\LaravelHelper\Services\Engine\EngineResourceIndexer
     */
    public function setQuery(?array $query): EngineResourceIndexer
    {
        $this->query = $query ?? [];
        return $this;
    }

    /**
     * @param int|null $limit
     * @return \Betalabs\LaravelHelper\Services\Engine\EngineResourceIndexer
     */
    public function setLimit(?int $limit): EngineResourceIndexer
    {
        $this->limit = $limit ?? 100;
        return $this;
    }

    /**
     * @param int $offset
     * @return \Betalabs\LaravelHelper\Services\Engine\EngineResourceIndexer
     */
    public function setOffset(int $offset): EngineResourceIndexer
    {
        $this->offset = $offset;
        return $this;
    }

    /**
     * @param string $exceptionMessage
     * @return \Betalabs\LaravelHelper\Services\Engine\EngineResourceIndexer
     */
    public function setExceptionMessage(string $exceptionMessage): EngineResourceIndexer
    {
        $this->exceptionMessage = $exceptionMessage;
        return $this;
    }

    /**
     * Retrieve a resource
     *
     * @return \Illuminate\Support\Collection
     */
    public function retrieve(): Collection
    {
        $query = http_build_query(array_merge($this->query, [
            '_limit' => $this->limit,
            '_offset' => $this->offset
        ]));

        $request = Request::get();
        $this->replaceEndpointParameters();
        $index = $request->send("{$this->endpoint}?{$query}");

        $this->errors($request->getResponse());

        return collect($index->data ?? []);
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