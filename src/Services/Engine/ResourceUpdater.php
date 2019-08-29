<?php

namespace Betalabs\LaravelHelper\Services\Engine;


use Betalabs\Engine\Request;
use GuzzleHttp\Exception\BadResponseException;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\HttpFoundation\Response;

class ResourceUpdater implements EngineResourceUpdater
{
    use ReplacesEndpointParameters;
    /**
     * @var array
     */
    protected $data;
    /**
     * @var string
     */
    protected $endpoint;
    /**
     * @var string
     */
    protected $exceptionMessage = 'Resource data could not be updated.';
    /**
     * @var int
     */
    protected $recordId;
    /**
     * @var array
     */
    protected $endpointParameters = [];

    /**
     * @param array $data
     * @return \Betalabs\LaravelHelper\Services\Engine\EngineResourceUpdater
     */
    public function setData(array $data): EngineResourceUpdater
    {
        $this->data = $data;
        return $this;
    }

    /**
     * @param string $endpoint
     * @return \Betalabs\LaravelHelper\Services\Engine\EngineResourceUpdater
     */
    public function setEndpoint(string $endpoint): EngineResourceUpdater
    {
        $this->endpoint = $endpoint;
        return $this;
    }

    /**
     * @param array $endpointParameters
     * @return \Betalabs\LaravelHelper\Services\Engine\EngineResourceUpdater
     */
    public function setEndpointParameters(array $endpointParameters): EngineResourceUpdater
    {
        $this->endpointParameters = $endpointParameters ?? [];
        return $this;
    }

    /**
     * @param int $recordId
     * @return \Betalabs\LaravelHelper\Services\Engine\EngineResourceUpdater
     */
    public function setRecordId(int $recordId): EngineResourceUpdater
    {
        $this->recordId = $recordId;
        return $this;
    }

    /**
     * @param string $exceptionMessage
     * @return \Betalabs\LaravelHelper\Services\Engine\EngineResourceUpdater
     */
    public function setExceptionMessage(string $exceptionMessage): EngineResourceUpdater
    {
        $this->exceptionMessage = $exceptionMessage;
        return $this;
    }

    /**
     * Update a resource
     *
     * @return mixed
     */
    public function update()
    {
        try {
            $put = Request::put();
            $this->replaceEndpointParameters();
            $recordId = $this->recordId ?? "";
            sleep(1);
            $response = $put->send("{$this->endpoint}/{$recordId}", $this->data);
        } catch (BadResponseException $e) {
            $put = $e;
        }

        $this->errors($put->getResponse());

        return $response->data;
    }

    /**
     * Handle request response
     *
     * @param \Psr\Http\Message\ResponseInterface $response
     */
    protected function errors(ResponseInterface $response): void
    {
        $status = $response->getStatusCode();
        if ($status != Response::HTTP_CREATED
            || $status != Response::HTTP_NO_CONTENT
            || $status != Response::HTTP_OK
        ) {
            throw new \RuntimeException($this->exceptionMessage);
        }
    }
}