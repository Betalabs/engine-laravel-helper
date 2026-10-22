<?php

namespace Betalabs\LaravelHelper\Tests;


use Betalabs\LaravelHelper\Services\Engine\Event\Firer;
use Facades\Betalabs\LaravelHelper\Services\Engine\ResourceCreator;
use Illuminate\Support\Facades\App;

class EventFirerTest extends TestCase
{
    public function testEventFire()
    {
        App::setLocale('pt');

        $data = [
            'name' => 'testName',
            'params' => ['1','2']
        ];

        ResourceCreator::shouldReceive('setData')
            ->once()
            ->with($data)
            ->andReturnSelf();
        ResourceCreator::shouldReceive('setEndpoint')
            ->once()
            ->with('events/fire')
            ->andReturnSelf();
        ResourceCreator::shouldReceive('setEndpointParameters')
            ->once()
            ->with([])
            ->andReturnSelf();
        ResourceCreator::shouldReceive('setExceptionMessage')
            ->once()
            ->with('Não foi possível acionar o evento.')
            ->andReturnSelf();
        ResourceCreator::shouldReceive('create')
            ->once()
            ->andReturn(null);

        /**@var \Betalabs\LaravelHelper\Services\Engine\Event\Firer $firer**/
        $firer = resolve(Firer::class);
        $firer->setName($data['name'])
            ->setParams($data['params'])
            ->fire();
    }
}