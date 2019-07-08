<?php


namespace Betalabs\LaravelHelper\Tests\Feature\Configuration;


use Betalabs\LaravelHelper\Services\App\Configuration\AbstractShow;

class MockShowService extends AbstractShow
{

    /**
     * Implements the logic to get the value using the rule
     *
     * @param string $rule
     * @return string
     */
    function getValue(string $rule): string
    {
        if($rule == 'config') {
            return 'value';
        }
        return '';
    }
}