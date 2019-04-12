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
            ->with($data)
            ->andReturnSelf();
        ResourceCreator::shouldReceive('setEndpoint')
            ->with('events/fire')
            ->andReturnSelf();
        ResourceCreator::shouldReceive('setEndpointParameters')
            ->with([])
            ->andReturnSelf();
        ResourceCreator::shouldReceive('setExceptionMessage')
            ->with('Não foi possível acionar o evento.')
            ->andReturnSelf();
        ResourceCreator::shouldReceive('create')
            ->andReturn(null);

        /**@var \Betalabs\LaravelHelper\Services\Engine\Event\Firer $firer**/
        $firer = resolve(Firer::class);
        $firer->setName($data['name'])
            ->setParams($data['params'])
            ->fire();
    }
}