<?php

namespace Betalabs\LaravelHelper\Services\Engine;

use GuzzleHttp\Exception\BadResponseException;
use Psr\Http\Message\ResponseInterface;
use Illuminate\Http\Response;
use Betalabs\Engine\Request;

class ResourceCreator implements EngineResourceCreator
{
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
    protected $exceptionMessage = 'Resource data could not be created.';
    /**
     * @var array
     */
    protected $endpointParameters = [];

    /**
     * @param array $data
     * @return \Betalabs\LaravelHelper\Services\Engine\EngineResourceCreator
     */
    public function setData(array $data): EngineResourceCreator
    {
        $this->data = $data;
        return $this;
    }

    /**
     * @param string $endpoint
     * @return \Betalabs\LaravelHelper\Services\Engine\EngineResourceCreator
     */
    public function setEndpoint(string $endpoint): EngineResourceCreator
    {
        $this->endpoint = $endpoint;
        return $this;
    }

    /**
     * @param string $exceptionMessage
     * @return \Betalabs\LaravelHelper\Services\Engine\EngineResourceCreator
     */
    public function setExceptionMessage(string $exceptionMessage): EngineResourceCreator
    {
        $this->exceptionMessage = $exceptionMessage;
        return $this;
    }

    /**
     * @param array $endpointParameters
     * @return \Betalabs\LaravelHelper\Services\Engine\EngineResourceCreator
     */
    public function setEndpointParameters(array $endpointParameters): EngineResourceCreator
    {
        $this->endpointParameters = $endpointParameters;
        return $this;
    }

    /**
     * Create a new resource
     *
     * @return mixed
     */
    public function create()
    {
        try {
            $post = Request::post();
            $this->replaceEndpointParameters();
            $response = $post->send($this->endpoint, $this->data);
        } catch (BadResponseException $e) {
            $post = $e;
        }

        $this->errors($post->getResponse());

        return $response->data;
    }

    /**
     * Handle request response
     *
     * @param \Psr\Http\Message\ResponseInterface $response
     */
    protected function errors(ResponseInterface $response): void
    {
        if ($response->getStatusCode() != Response::HTTP_CREATED) {
            throw new \RuntimeException($this->exceptionMessage);
        }
    }

    /**
     * Replace url parameters between curly braces for object attributes
     */
    private function replaceEndpointParameters()
    {
        if(empty($this->endpointParameters)) {
            return;
        }

        $matches = [];
        preg_match_all('/{(.*?)}/', $this->endpoint, $matches);
        foreach($matches[1] as $match) {
            $this->endpoint = str_replace("{{$match}}", $this->endpointParameters[$match], $this->endpoint);
        }
    }
}