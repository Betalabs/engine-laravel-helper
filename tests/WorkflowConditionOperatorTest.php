<?php

namespace Betalabs\LaravelHelper\Tests;

use Betalabs\LaravelHelper\Models\Enums\WorkflowConditionOperator;

class WorkflowConditionOperatorTest extends \PHPUnit\Framework\TestCase
{
    public function testAllOperatorsHaveTheirSymbol()
    {
        // Loading the class used to fail with a parse error ('<=; without closing quote)
        $this->assertEquals([
            'EQUAL' => '=',
            'DIFFERENT' => '!=',
            'GREATER_THAN' => '>',
            'GREATER_THAN_OR_EQUAL_TO' => '>=',
            'LESS_THAN' => '<',
            'LESS_THAN_OR_EQUAL_TO' => '<=',
        ], WorkflowConditionOperator::toArray());
    }
}
