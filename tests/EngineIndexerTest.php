<?php

namespace Betalabs\LaravelHelper\Tests;


use Betalabs\LaravelHelper\Services\Engine\GenericIndexer;
use Facades\Betalabs\LaravelHelper\Services\Engine\ResourceIndexer;
use Illuminate\Support\Facades\App;

class EngineIndexerTest extends TestCase
{
    public function testEngineIndexer()
    {
        App::setLocale('pt');

        $query = ['field' => 'query'];
        $limit = 10;
        $offset = 0;

        ResourceIndexer::shouldReceive('setQuery')
            ->with($query)
            ->andReturnSelf();
        ResourceIndexer::shouldReceive('setLimit')
            ->with($limit)
            ->andReturnSelf();
        ResourceIndexer::shouldReceive('setOffset')
            ->with($offset)
            ->andReturnSelf();
        ResourceIndexer::shouldReceive('setEndpointParameters')
            ->with([])
            ->andReturnSelf();
        ResourceIndexer::shouldReceive('setEndpoint')
            ->with('channels')
            ->andReturnSelf();
        ResourceIndexer::shouldReceive('setExceptionMessage')
            ->with('Não foi possível buscar os canais.')
            ->andReturnSelf();
        ResourceIndexer::shouldReceive('retrieve')
            ->andReturn(collect([]));

        /**@var \Betalabs\LaravelHelper\Services\Engine\GenericIndexer $indexer **/
        $indexer = resolve(GenericIndexer::class);

        $indexer->setOffset($offset)
            ->setLimit($limit)
            ->setQuery($query)
            ->setEndpoint('channels')
            ->index();
    }
}