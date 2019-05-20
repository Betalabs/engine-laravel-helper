<?php

namespace Betalabs\LaravelHelper\Tests;


use Betalabs\LaravelHelper\Services\Engine\ZipCodeRange\Calculator;
use Illuminate\Support\Facades\App;
use Facades\Betalabs\LaravelHelper\Services\Engine\ResourceIndexer;

class ZipCodeRangeCalculatorTest extends TestCase
{
    public function testCalculate()
    {
        App::setLocale('pt');

        $items = [1,2,3];
        $quantities = [3,2,1];
        $zipCode = '05359002';

        ResourceIndexer::shouldReceive('setQuery')
            ->with([
                "zip_code" => $zipCode,
                "items" => $items,
                "quantities" => $quantities
            ])
            ->once()
            ->andReturnSelf();
        ResourceIndexer::shouldReceive('setEndpoint')
            ->with('zip-code-ranges/calculate')
            ->once()
            ->andReturnSelf();
        ResourceIndexer::shouldReceive('setEndpointParameters')
            ->with([])
            ->once()
            ->andReturnSelf();
        ResourceIndexer::shouldReceive('setLimit')
            ->with(10)
            ->once()
            ->andReturnSelf();
        ResourceIndexer::shouldReceive('setOffset')
            ->with(0)
            ->once()
            ->andReturnSelf();
        ResourceIndexer::shouldReceive('setExceptionMessage')
            ->with('Não foi possível calcular as faixas de CEP.')
            ->once()
            ->andReturnSelf();
        ResourceIndexer::shouldReceive('retrieve')
            ->once()
            ->andReturn(collect([]));

        /**
         * @var Calculator $zipCodeRange
         */
        $zipCodeRange = resolve(Calculator::class);
        $zipCodeRange->setItems($items)
            ->setQuantities($quantities)
            ->setZipCode($zipCode)
            ->calculate();
    }
}