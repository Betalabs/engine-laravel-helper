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
            ->once()
            ->with($data)
            ->andReturnSelf();
        ResourceCreator::shouldReceive('setEndpoint')
            ->once()
            ->with('channels')
            ->andReturnSelf();
        ResourceCreator::shouldReceive('setEndpointParameters')
            ->once()
            ->with([])
            ->andReturnSelf();
        ResourceCreator::shouldReceive('setExceptionMessage')
            ->once()
            ->with('Não foi possível criar o canal.')
            ->andReturnSelf();
        ResourceCreator::shouldReceive('create')
            ->once()
            ->andReturn(null);

        /** @var \Betalabs\LaravelHelper\Services\Engine\GenericCreator $creator **/
        $creator = resolve(GenericCreator::class);
        $creator->setEndpoint('channels')
            ->setData($data)
            ->create();

    }

    public function testEngineCreatorWithEndpointParameters()
    {
        App::setLocale('pt');

        $extraFieldId = 1;
        $formId = 1;
        $data = ['extra_field_id' => $extraFieldId];

        ResourceCreator::shouldReceive('setData')
            ->once()
            ->with($data)
            ->andReturnSelf();
        ResourceCreator::shouldReceive('setEndpoint')
            ->once()
            ->with('forms/{formId}/extra-fields')
            ->andReturnSelf();
        ResourceCreator::shouldReceive('setEndpointParameters')
            ->once()
            ->with(['formId' => $formId])
            ->andReturnSelf();
        ResourceCreator::shouldReceive('setExceptionMessage')
            ->once()
            ->with('Não foi possível criar a associação de formulário com o campo extra.')
            ->andReturnSelf();
        ResourceCreator::shouldReceive('create')
            ->once()
            ->andReturn(null);

        /** @var \Betalabs\LaravelHelper\Services\Engine\GenericCreator $creator **/
        $creator = resolve(GenericCreator::class);
        $creator->setEndpoint('forms/{formId}/extra-fields')
            ->setEndpointParameters(['formId' => $formId])
            ->setData($data)
            ->create();
    }
}