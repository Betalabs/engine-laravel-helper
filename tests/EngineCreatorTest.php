<?php

namespace Betalabs\LaravelHelper\Tests;

use Betalabs\LaravelHelper\Services\Engine\GenericCreator;
use Facades\Betalabs\LaravelHelper\Services\Engine\ResourceCreator;
use Illuminate\Support\Facades\App;

class EngineCreatorTest extends TestCase
{
    public function testEngineCreator()
    {
        App::setLocale('pt');

        $data = ['channel' => 'testChannel'];
        ResourceCreator::shouldReceive('setData')
            ->with($data)
            ->andReturnSelf();
        ResourceCreator::shouldReceive('setEndpoint')
            ->with('channels')
            ->andReturnSelf();
        ResourceCreator::shouldReceive('setExceptionMessage')
            ->with('Não foi possível criar o canal.')
            ->andReturnSelf();
        ResourceCreator::shouldReceive('create')
            ->andReturn(null);

        $creator = resolve(GenericCreator::class);
        $creator->setEndpoint('channels');
        $creator->setData($data);
        $creator->create();

    }
}