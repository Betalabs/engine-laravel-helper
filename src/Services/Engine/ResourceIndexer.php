<?php

namespace Betalabs\LaravelHelper\Services\Engine;

use Betalabs\Engine\Request;
use Illuminate\Http\Response;
use Psr\Http\Message\ResponseInterface;

class ResourceIndexer implements EngineResourceIndexer
{
    /**
     * @var string
     */
    protected $endpoint;
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
     * @param array $query
     * @return \Betalabs\LaravelHelper\Services\Engine\EngineResourceIndexer
     */
    public function setQuery(array $query): EngineResourceIndexer
    {
        $this->query = $query;
        return $this;
    }

    /**
     * @param int $limit
     * @return \Betalabs\LaravelHelper\Services\Engine\EngineResourceIndexer
     */
    public function setLimit(int $limit): EngineResourceIndexer
    {
        $this->limit = $limit;
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
     * @return mixed
     */
    public function retrieve()
    {
        $query = http_build_query(array_merge($this->query, [
            '_limit' => $this->limit,
            '_offset' => $this->offset
        ]));

        $request = Request::get();
        $index = $request->send("{$this->endpoint}?{$query}");

        $this->errors($request->getResponse());

        return collect($index->data);
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