<?php


namespace Betalabs\LaravelHelper\Services\App\Configuration;


abstract class AbstractUpdate implements UpdateInterface
{
    /**
     * @var \Betalabs\LaravelHelper\Services\App\Configuration\ShowInterface
     */
    private $show;

    /**
     * AbstractUpdate constructor.
     * @param \Betalabs\LaravelHelper\Services\App\Configuration\ShowInterface $show
     */
    public function __construct(ShowInterface $show)
    {
        $this->show = $show;
    }

    /**
     * Implements the logic to update the configuration and return the updated configurations.
     *
     * @param array $data
     * @return mixed
     */
    public function update(array $data)
    {
        $this->updateConfigurations($data);
        return $this->show->show();
    }

    /**
     * Implements the logic to update the configurations
     *
     * @param array $data
     */
    abstract function updateConfigurations(array $data);
}