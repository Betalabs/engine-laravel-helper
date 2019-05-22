<?php

namespace Betalabs\LaravelHelper\Services\Engine\ZipCodeRange;


use Betalabs\LaravelHelper\Services\Engine\GenericIndexer;
use Symfony\Component\Routing\Exception\MethodNotAllowedException;

class Calculator extends GenericIndexer
{
    /**
     * @var string
     */
    private $zipCode;
    /**
     * @var array
     */
    private $items;
    /**
     * @var array
     */
    private $quantities;
    /**
     * @var int
     */
    protected $offset = 0;
    /**
     * @var int
     */
    protected $limit = 10;

    /**
     * Calculate zip code ranges
     *
     * @return mixed
     */
    public function calculate()
    {
        $this->endpoint = 'zip-code-ranges/calculate';
        $this->query = [
            "zip_code" => $this->zipCode,
            "items" => $this->items,
            "quantities" => $this->quantities
        ];
        return parent::index();
    }

    /**
     * @return mixed|void
     * @throws \Exception
     */
    public function index()
    {
        throw new MethodNotAllowedException(['calculate']);
    }

    /**
     * @param array $quantities
     * @return Calculator
     */
    public function setQuantities(array $quantities): Calculator
    {
        $this->quantities = $quantities;
        return $this;
    }

    /**
     * @param string $zipCode
     * @return Calculator
     */
    public function setZipCode(string $zipCode): Calculator
    {
        $this->zipCode = $zipCode;
        return $this;
    }

    /**
     * @param array $items
     * @return Calculator
     */
    public function setItems(array $items): Calculator
    {
        $this->items = $items;
        return $this;
    }
}