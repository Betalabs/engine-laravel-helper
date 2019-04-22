<?php

namespace Betalabs\LaravelHelper\Tests;


use Betalabs\LaravelHelper\Services\Engine\GenericUpdater;
use Facades\Betalabs\LaravelHelper\Services\Engine\ResourceUpdater;
use Illuminate\Support\Facades\App;

class EngineUpdaterTest extends TestCase
{
    public function testUpdate()
    {
        App::setLocale('pt');

        $recordId = 1;
        $data = ['attribute' => 1];
        $endpoint = 'virtual-entities/{virtualEntity}/records';

        ResourceUpdater::shouldReceive('setData')
            ->with($data)
            ->once()
            ->andReturnSelf();
        ResourceUpdater::shouldReceive('setEndpoint')
            ->with($endpoint)
            ->once()
            ->andReturnSelf();
        ResourceUpdater::shouldReceive('setEndpointParameters')
            ->with([])
            ->once()
            ->andReturnSelf();
        ResourceUpdater::shouldReceive('setRecordId')
            ->with($recordId)
            ->once()
            ->andReturnSelf();
        ResourceUpdater::shouldReceive('setExceptionMessage')
            ->with('Não foi possível atualizar o registro da entidade virtual.')
            ->once()
            ->andReturnSelf();
        ResourceUpdater::shouldReceive('update')
            ->once()
            ->andReturn(null);

        /**@var GenericUpdater $genericUpdater**/
        $genericUpdater = resolve(GenericUpdater::class);
        $genericUpdater->setEndpoint($endpoint)
            ->setRecordId($recordId)
            ->setData($data)
            ->update();
    }
}