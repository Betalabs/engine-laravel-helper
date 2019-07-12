<?php


namespace Betalabs\LaravelHelper\Services\App\Configuration;


use Betalabs\LaravelHelper\Structures\ConfigurationStructureInterface;
use Illuminate\Support\Collection;

abstract class AbstractShow implements ShowInterface
{
    /**
     * @var \Betalabs\LaravelHelper\Structures\ConfigurationStructureInterface
     */
    private $structure;

    /**
     * AbstractShow constructor.
     * @param \Betalabs\LaravelHelper\Structures\ConfigurationStructureInterface $structure
     */
    public function __construct(ConfigurationStructureInterface $structure)
    {
        $this->structure = $structure;
    }

    /**
     * @return mixed
     */
    public function show()
    {
        return collect($this->structure->toArray()['rules'])->keys()->reduce(function (Collection $carrier, $rule) {
            return $carrier->push([
                'key' => $rule,
                'value' => $this->getValue($rule),
            ]);
        }, collect());
    }

    /**
     * Implements the logic to get the value using the rule
     *
     * @param string $rule
     * @return string
     */
    abstract function getValue(string $rule): string;
}