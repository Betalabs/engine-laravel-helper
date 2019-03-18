<?php

namespace Betalabs\LaravelHelper\Tests;


use Betalabs\LaravelHelper\Services\App\ExtraField\Creator;
use Facades\Betalabs\LaravelHelper\Services\Engine\ExtraFieldType\Indexer as ExtraFieldTypeIndexer;
use Facades\Betalabs\LaravelHelper\Services\Engine\Channel\Indexer as ChannelIndexer;
use Facades\Betalabs\LaravelHelper\Services\Engine\Entity\Indexer as EntityIndexer;
use Facades\Betalabs\LaravelHelper\Services\Engine\Form\Indexer as FormIndexer;
use Facades\Betalabs\LaravelHelper\Services\Engine\Form\Creator as FormCreator;
use Facades\Betalabs\LaravelHelper\Services\Engine\ExtraField\Indexer as ExtraFieldIndexer;
use Facades\Betalabs\LaravelHelper\Services\Engine\ExtraField\Creator as ExtraFieldCreator;
use Facades\Betalabs\LaravelHelper\Services\Engine\FormExtraField\Creator as FormExtraFieldCreator;

class ExtraFieldCreatorTest extends TestCase
{
    public function testCreate()
    {
        $channel = $this->mockChannelIndexer();
        list($entityIdentification, $entity) = $this->mockEntityIndexer();
        $formName = $this->mockFormIndexer($entityIdentification);
        $form = $this->mockFormCreator($formName, $entity, $channel);
        list($extraFieldType, $extraFieldLabel) = $this->mockExtraFieldTypeIndexer();
        $extraField = $this->mockExtraFieldCreator($entity, $extraFieldType, $extraFieldLabel);
        $this->mockFormExtraFieldCreator($form, $extraField);

        /** @var \Betalabs\LaravelHelper\Services\App\ExtraField\Creator $extraFieldCreator**/
        $extraFieldCreator = resolve(Creator::class);
        $extraFieldCreator->setEntityIdentification($entityIdentification)
            ->setExtraFieldLabel($extraFieldLabel)
            ->setExtraFieldType('text')
            ->setFormName($formName)
            ->create();
    }

    /**
     * @return \stdClass
     */
    private function mockChannelIndexer(): \stdClass
    {
        $channel = new \stdClass();
        $channel->id = 1;
        ChannelIndexer::shouldReceive('setQuery')
            ->with(['channel' => 'ERP'])
            ->andReturnSelf();
        ChannelIndexer::shouldReceive('index')
            ->andReturn(collect([$channel]));
        return $channel;
    }

    /**
     * @return array
     */
    private function mockEntityIndexer(): array
    {
        $entityIdentification = 'Produtos';
        $entity = new \stdClass();
        $entity->id = 1;
        EntityIndexer::shouldReceive('setQuery')
            ->with(['identification' => $entityIdentification])
            ->andReturnSelf();
        EntityIndexer::shouldReceive('index')
            ->andReturn(collect([$entity]));
        return array($entityIdentification, $entity);
    }

    /**
     * @param $entityIdentification
     * @return string
     */
    private function mockFormIndexer($entityIdentification): string
    {
        $formName = 'Informações de Produto';
        FormIndexer::shouldReceive('setQuery')
            ->with([
                'name' => $formName,
                'entity' => $entityIdentification,
                'channels' => 'ERP',
                '_filter-approach' => 'and'
            ])
            ->andReturnSelf();
        FormIndexer::shouldReceive('index')
            ->andReturn(collect([]));
        return $formName;
    }

    /**
     * @param $formName
     * @param $entity
     * @param $channel
     * @return \stdClass
     */
    private function mockFormCreator($formName, $entity, $channel): \stdClass
    {
        $form = new \stdClass();
        $form->id = 10;
        FormCreator::shouldReceive('setName')
            ->with($formName)
            ->andReturnSelf();
        FormCreator::shouldReceive('setEntityId')
            ->with($entity->id)
            ->andReturnSelf();
        FormCreator::shouldReceive('setChannels')
            ->with([$channel->id])
            ->andReturnSelf();
        FormCreator::shouldReceive('create')
            ->andReturn($form);
        return $form;
    }

    /**
     * @return array
     */
    private function mockExtraFieldTypeIndexer(): array
    {
        $extraFieldType = new \stdClass();
        $extraFieldType->id = 20;
        ExtraFieldTypeIndexer::shouldReceive('setQuery')
            ->with(['type' => 'text'])
            ->andReturnSelf();
        ExtraFieldTypeIndexer::shouldReceive('index')
            ->andReturn(collect([$extraFieldType]));

        $extraFieldLabel = 'Descrição';
        ExtraFieldIndexer::shouldReceive('setQuery')
            ->with(["label" => $extraFieldLabel])
            ->andReturnSelf();
        ExtraFieldIndexer::shouldReceive('index')
            ->andReturn(collect([]));
        return array($extraFieldType, $extraFieldLabel);
    }

    /**
     * @param $entity
     * @param $extraFieldType
     * @param $extraFieldLabel
     * @return \stdClass
     */
    private function mockExtraFieldCreator($entity, $extraFieldType, $extraFieldLabel): \stdClass
    {
        $extraField = new \stdClass();
        $extraField->id = 12;
        ExtraFieldCreator::shouldReceive('setEntityId')
            ->with($entity->id)
            ->andReturnSelf();
        ExtraFieldCreator::shouldReceive('setExtraFieldTypeId')
            ->with($extraFieldType->id)
            ->andReturnSelf();
        ExtraFieldCreator::shouldReceive('setLabel')
            ->with($extraFieldLabel)
            ->andReturnSelf();
        ExtraFieldCreator::shouldReceive('create')
            ->andReturn($extraField);
        return $extraField;
    }

    /**
     * @param $form
     * @param $extraField
     */
    private function mockFormExtraFieldCreator($form, $extraField): void
    {
        FormExtraFieldCreator::shouldReceive('setFormId')
            ->with($form->id)
            ->andReturnSelf();
        FormExtraFieldCreator::shouldReceive('setExtraFieldId')
            ->with($extraField->id)
            ->andReturnSelf();
        FormExtraFieldCreator::shouldReceive('create')
            ->andReturn(null);
    }
}