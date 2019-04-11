<?php

namespace Betalabs\LaravelHelper\Tests;


use Illuminate\Support\Facades\App;
use Facades\Betalabs\LaravelHelper\Services\Engine\ResourceShower;
use Betalabs\LaravelHelper\Services\Engine\GenericShower;

class EngineShowerTest extends TestCase
{
    public function testShower()
    {
        App::setLocale('pt');

        $recordId = 1;
        ResourceShower::shouldReceive('setQuery')
            ->with([])
            ->andReturnSelf();
        ResourceShower::shouldReceive('setEndpointParameters')
            ->with([])
            ->andReturnSelf();
        ResourceShower::shouldReceive('setEndpoint')
            ->with('virtual-entities/{virtualEntity}/records')
            ->andReturnSelf();
        ResourceShower::shouldReceive('setEndpointParameters')
            ->with(['virtualEntity' => 1])
            ->andReturnSelf();
        ResourceShower::shouldReceive('setRecordId')
            ->with($recordId)
            ->andReturnSelf();
        ResourceShower::shouldReceive('setExceptionMessage')
            ->with('Não foi possível buscar o(s) registro(s) de entidade(s) virtuais.')
            ->andReturnSelf();
        ResourceShower::shouldReceive('retrieve')
            ->andReturn(collect([]));

        /**@var \Betalabs\LaravelHelper\Services\Engine\GenericShower $shower **/
        $shower = resolve(GenericShower::class);

        $shower->setEndpoint('virtual-entities/{virtualEntity}/records')
            ->setEndpointParameters(['virtualEntity' => 1])
            ->setRecordId($recordId)
            ->retrieve();
    }
}