<?php

namespace Betalabs\LaravelHelper\Services\App\Telephone;


class Telephone
{
    /**
     * @var int
     */
    private $ddd;
    /**
     * @var int
     */
    private $number;

    /**
     * Telephone constructor.
     * @param int $ddd
     * @param $number
     */
    public function __construct(int $ddd, int $number)
    {
        $this->ddd = $ddd;
        $this->number = $number;
    }

    /**
     * @return int
     */
    public function getNumber(): int
    {
        return $this->number;
    }

    /**
     * @return int
     */
    public function getDdd(): int
    {
        return $this->ddd;
    }


}