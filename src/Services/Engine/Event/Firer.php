<?php

namespace Betalabs\LaravelHelper\Services\Engine\Event;


use Betalabs\LaravelHelper\Services\Engine\GenericCreator;
use Symfony\Component\Routing\Exception\MethodNotAllowedException;

class Firer extends GenericCreator
{
    /**
     * @var string
     */
    private $name;
    /**
     * @var array
     */
    private $params = [];

    /**
     * Sets the name property.
     *
     * @param string $name
     * @return \Betalabs\LaravelHelper\Services\Engine\Event\Firer
     */
    public function setName(string $name): Firer
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Sets the params property.
     *
     * @param array $params
     * @return \Betalabs\LaravelHelper\Services\Engine\Event\Firer
     */
    public function setParams(array $params): Firer
    {
        $this->params = $params;
        return $this;
    }

    /**
     * @return mixed
     */
    public function fire()
    {
        $this->data = [
            'name' => $this->name,
            'params' => $this->params
        ];
        $this->endpoint = 'events/fire';

        return parent::create();
    }

    /**
     * @return mixed|void
     * @throws \Exception
     */
    public function create()
    {
        throw new MethodNotAllowedException(['fire']);
    }
}