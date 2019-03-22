<?php

namespace Betalabs\LaravelHelper\Services\Engine;


abstract class AbstractShower
{
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
    protected $recordId;
    /**
     * @var string
     */
    protected $exceptionTranslationPath = 'engine-laravel-helper::exception';

    /**
     * @var \Betalabs\LaravelHelper\Services\Engine\EngineResourceShower
     */
    protected $engineResourceShower;

    /**
     * @param string $endpoint
     * @return AbstractShower
     */
    public function setEndpoint(string $endpoint): AbstractShower
    {
        $this->endpoint = $endpoint;
        return $this;
    }

    /**
     * @param array $endpointParameters
     * @return AbstractShower
     */
    public function setEndpointParameters(array $endpointParameters): AbstractShower
    {
        $this->endpointParameters = $endpointParameters;
        return $this;
    }

    /**
     * @param array $query
     * @return AbstractShower
     */
    public function setQuery(array $query): AbstractShower
    {
        $this->query = $query;
        return $this;
    }
    /**
     * @param string $exceptionTranslationPath
     * @return AbstractShower
     */
    public function setExceptionTranslationPath(string $exceptionTranslationPath): AbstractShower
    {
        $this->exceptionTranslationPath = $exceptionTranslationPath;
        return $this;
    }

    /**
     * @param int $recordId
     * @return AbstractShower
     */
    public function setRecordId(int $recordId): AbstractShower
    {
        $this->recordId = $recordId;
        return $this;
    }

    /**
     * AbstractShower constructor.
     * @param \Betalabs\LaravelHelper\Services\Engine\EngineResourceShower $engineResourceShower
     */
    public function __construct(EngineResourceShower $engineResourceShower)
    {
        $this->engineResourceShower = $engineResourceShower;
    }

    /**
     * Retrieve a resource on engine
     *
     * @return mixed
     */
    public function retrieve()
    {
        return $this->engineResourceShower->setQuery($this->query)
            ->setRecordId($this->recordId)
            ->setExceptionMessage(
                trans(
                    $this->exceptionTranslationPath . '.' . $this->endpoint . '.retrieve'
                )
            )
            ->retrieve();
    }
}