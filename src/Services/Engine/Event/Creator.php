<?php

namespace Betalabs\LaravelHelper\Services\Engine\Event;


use Betalabs\LaravelHelper\Services\Engine\AbstractCreator;

class Creator extends AbstractCreator
{
    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $display;
    /**
     * @var string
     */
    private $description;
    /**
     * @var array
     */
    private $params;

    /**
     * @param string $name
     * @return Creator
     */
    public function setName(string $name): Creator
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param string $display
     * @return Creator
     */
    public function setDisplay(string $display): Creator
    {
        $this->display = $display;
        return $this;
    }

    /**
     * @param string $description
     * @return Creator
     */
    public function setDescription(string $description): Creator
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @param array $params
     * @return Creator
     */
    public function setParams(array $params): Creator
    {
        $this->params = $params;
        return $this;
    }

    /**
     * @return mixed
     */
    public function create()
    {
        $this->data = [
            'name' => $this->name,
            'display' => $this->display,
            'description' => $this->description,
            'params' => $this->params,
        ];
        return parent::create();
    }

}