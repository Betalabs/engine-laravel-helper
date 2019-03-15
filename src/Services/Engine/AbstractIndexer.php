<?php

namespace Betalabs\LaravelHelper\Services\Engine;

abstract class AbstractIndexer
{
    /**
     * @var string
     */
    protected $endpoint;
    /**
     * @var \Betalabs\LaravelHelper\Services\Engine\EngineResourceIndexer
     */
    protected $engineResourceIndexer;
    /**
     * @var string
     */
    protected $exceptionTranslationPath = 'engine-laravel-helper::exception';
    /**
     * @var array
     */
    protected $query;
    /**
     * @var int
     */
    protected $limit;
    /**
     * @var int
     */
    protected $offset;

    /**
     * AbstractIndexer constructor.
     * @param \Betalabs\LaravelHelper\Services\Engine\EngineResourceIndexer $engineResourceIndexer
     */
    public function __construct(EngineResourceIndexer $engineResourceIndexer)
    {
        $this->engineResourceIndexer = $engineResourceIndexer;
    }

    /**
     * @param string $endpoint
     * @return \Betalabs\LaravelHelper\Services\Engine\AbstractIndexer
     */
    public function setEndpoint(string $endpoint): AbstractIndexer
    {
        $this->endpoint = $endpoint;
        return $this;
    }

    /**
     * @param array $query
     * @return AbstractIndexer
     */
    public function setQuery(array $query): AbstractIndexer
    {
        $this->query = $query;
        return $this;
    }

    /**
     * @param int $limit
     * @return AbstractIndexer
     */
    public function setLimit(int $limit): AbstractIndexer
    {
        $this->limit = $limit;
        return $this;
    }

    /**
     * @param int $offset
     * @return AbstractIndexer
     */
    public function setOffset(int $offset): AbstractIndexer
    {
        $this->offset = $offset;
        return $this;
    }

    /**
     * Retrieve a resource on engine
     *
     * @return mixed
     */
    public function index()
    {
        return $this->engineResourceIndexer->setQuery($this->query)
            ->setLimit($this->limit)
            ->setExceptionMessage(
                trans(
                    $this->exceptionTranslationPath . '.' . $this->endpoint . '.retrieve'
                )
            )
            ->retrieve();
    }
}