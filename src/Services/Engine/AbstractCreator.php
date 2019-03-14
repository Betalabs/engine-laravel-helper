<?php

namespace Betalabs\LaravelHelper\Services\Engine;


abstract class AbstractCreator
{
    /**
     * @var string
     */
    protected $endpoint;
    /**
     * @var array
     */
    protected $data;
    /**
     * @var string
     */
    protected $exceptionTranslationPath = 'engine-laravel-helper::exception';
    /**
     * @var \Betalabs\LaravelHelper\Services\Engine\EngineResourceCreator
     */
    protected $engineResourceCreator;

    /**
     * Creator constructor.
     * @param \Betalabs\LaravelHelper\Services\Engine\EngineResourceCreator $engineResourceCreator
     */
    public function __construct(EngineResourceCreator $engineResourceCreator)
    {
        $this->engineResourceCreator = $engineResourceCreator;
    }

    /**
     * @param string $endpoint
     * @return AbstractCreator
     */
    public function setEndpoint(string $endpoint): AbstractCreator
    {
        $this->endpoint = $endpoint;
        return $this;
    }


    /**
     * @param string $exceptionTranslationPath
     * @return AbstractCreator
     */
    public function setExceptionTranslationPath(string $exceptionTranslationPath): AbstractCreator
    {
        $this->exceptionTranslationPath = $exceptionTranslationPath;
        return $this;
    }

    /**
     * @param array $data
     * @return \Betalabs\LaravelHelper\Services\Engine\AbstractCreator
     */
    public function setData(array $data): self
    {
        $this->data = $data;
        return $this;
    }

    /**
     * Create resource on engine
     *
     * @return mixed
     */
    public function create()
    {
        return $this->engineResourceCreator->setData($this->data)
            ->setExceptionMessage(
                trans(
                    $this->exceptionTranslationPath . '.' . $this->endpoint . '.create'
                )
            )
            ->create();
    }
}