<?php

namespace Betalabs\LaravelHelper\Services\Engine;


abstract class AbstractUpdater
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
    protected $data;
    /**
     * @var int
     */
    protected $recordId;
    /**
     * @var string
     */
    protected $exceptionTranslationPath = 'engine-laravel-helper::exception';
    /**
     * @var \Betalabs\LaravelHelper\Services\Engine\EngineResourceUpdater
     */
    protected $engineResourceUpdater;

    /**
     * AbstractUpdater constructor.
     * @param \Betalabs\LaravelHelper\Services\Engine\EngineResourceUpdater $engineResourceUpdater
     */
    public function __construct(EngineResourceUpdater $engineResourceUpdater)
    {
        $this->engineResourceUpdater = $engineResourceUpdater;
    }

    /**
     * @param string $endpoint
     * @return AbstractUpdater
     */
    public function setEndpoint(string $endpoint): AbstractUpdater
    {
        $this->endpoint = $endpoint;
        return $this;
    }

    /**
     * @param array $endpointParameters
     * @return AbstractUpdater
     */
    public function setEndpointParameters(array $endpointParameters): AbstractUpdater
    {
        $this->endpointParameters = $endpointParameters;
        return $this;
    }

    /**
     * @param array $data
     * @return AbstractUpdater
     */
    public function setData(array $data): AbstractUpdater
    {
        $this->data = $data;
        return $this;
    }

    /**
     * @param int $recordId
     * @return AbstractUpdater
     */
    public function setRecordId(int $recordId): AbstractUpdater
    {
        $this->recordId = $recordId;
        return $this;
    }

    /**
     * @param string $exceptionTranslationPath
     * @return AbstractUpdater
     */
    public function setExceptionTranslationPath(string $exceptionTranslationPath): AbstractUpdater
    {
        $this->exceptionTranslationPath = $exceptionTranslationPath;
        return $this;
    }

    /**
     * @return mixed
     */
    public function update()
    {
        return $this->engineResourceUpdater
            ->setData($this->data)
            ->setRecordId($this->recordId)
            ->update();
    }
}