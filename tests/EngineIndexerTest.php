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
            ->once()
            ->with($query)
            ->andReturnSelf();
        ResourceIndexer::shouldReceive('setLimit')
            ->once()
            ->with($limit)
            ->andReturnSelf();
        ResourceIndexer::shouldReceive('setOffset')
            ->once()
            ->with($offset)
            ->andReturnSelf();
        ResourceIndexer::shouldReceive('setEndpointParameters')
            ->once()
            ->with([])
            ->andReturnSelf();
        ResourceIndexer::shouldReceive('setEndpoint')
            ->once()
            ->with('channels')
            ->andReturnSelf();
        ResourceIndexer::shouldReceive('setExceptionMessage')
            ->once()
            ->with('Não foi possível buscar os canais.')
            ->andReturnSelf();
        ResourceIndexer::shouldReceive('retrieve')
            ->once()
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