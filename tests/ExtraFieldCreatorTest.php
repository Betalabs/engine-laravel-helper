<?php

namespace Betalabs\LaravelHelper\Tests;


use Betalabs\LaravelHelper\Models\Tenant;
use Betalabs\LaravelHelper\Services\App\ExtraField\Creator;
use Facades\Betalabs\LaravelHelper\Services\Engine\ExtraFieldType\Indexer as ExtraFieldTypeIndexer;
use Facades\Betalabs\LaravelHelper\Services\Engine\Channel\Indexer as ChannelIndexer;
use Facades\Betalabs\LaravelHelper\Services\Engine\Entity\Indexer as EntityIndexer;
use Facades\Betalabs\LaravelHelper\Services\Engine\Form\Indexer as FormIndexer;
use Facades\Betalabs\LaravelHelper\Services\Engine\Form\Creator as FormCreator;
use Facades\Betalabs\LaravelHelper\Services\Engine\ExtraField\Indexer as ExtraFieldIndexer;
use Facades\Betalabs\LaravelHelper\Services\Engine\ExtraField\Creator as ExtraFieldCreator;
use Facades\Betalabs\LaravelHelper\Services\Engine\FormExtraField\Creator as FormExtraFieldCreator;
use Laravel\Passport\Passport;
use Facades\Betalabs\LaravelHelper\Services\Engine\FormExtraField\Indexer as FormExtraFieldIndexer;
use Facades\Betalabs\LaravelHelper\Services\Engine\FieldMap\Creator as FieldMapCreator;

class ExtraFieldCreatorTest extends TestCase
{
    private $tenant;

    protected function setUp()
    {
        parent::setUp();
        $this->tenant = factory(Tenant::class)->create();
        Passport::actingAs($this->tenant);
    }

    public function testCreate()
    {
        $channel = $this->mockChannelIndexer();
        list($entityIdentification, $entity) = $this->mockEntityIndexer();
        $formName = $this->mockFormIndexer($entityIdentification);
        $form = $this->mockFormCreator($formName, $entity, $channel);
        list($extraFieldType, $extraFieldLabel) = $this->mockExtraFieldTypeIndexer();
        $extraField = $this->mockExtraFieldCreator($entity, $extraFieldType, $extraFieldLabel);
        $this->mockFormExtraFieldIndexer($form, $extraField);
        $formExtraField = $this->mockFormExtraFieldCreator($form, $extraField);
        $this->mockFieldMapCreator($formExtraField, $entity, $appRegistryId = 3, $fieldMapKey = 'key');

        /** @var \Betalabs\LaravelHelper\Services\App\ExtraField\Creator $extraFieldCreator**/
        $extraFieldCreator = resolve(Creator::class);
        $extraFieldCreator->setEntityIdentification($entityIdentification)
            ->setExtraFieldLabel($extraFieldLabel)
            ->setExtraFieldType('text')
            ->setFormName($formName)
            ->setAppRegistryId($appRegistryId)
            ->setFieldMapKey($fieldMapKey)
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
        $extraField->label = $extraFieldLabel;
        $extraField->slug = str_slug($extraFieldLabel);
        ExtraFieldCreator::shouldReceive('setEntityId')
            ->with($entity->id)
            ->andReturnSelf();
        ExtraFieldCreator::shouldReceive('setExtraFieldTypeId')
            ->with($extraFieldType->id)
            ->andReturnSelf();
        ExtraFieldCreator::shouldReceive('setLabel')
            ->with($extraFieldLabel)
            ->andReturnSelf();
        ExtraFieldCreator::shouldReceive('setOptions')
            ->with([])
            ->andReturnSelf();
        ExtraFieldCreator::shouldReceive('create')
            ->andReturn($extraField);
        return $extraField;
    }

    /**
     * @param $form
     * @param $extraField
     * @return \stdClass
     */
    private function mockFormExtraFieldCreator($form, $extraField): \stdClass
    {
        $formExtraField = new \stdClass();
        $formExtraField->id = 123;
        FormExtraFieldCreator::shouldReceive('setFormId')
            ->with($form->id)
            ->andReturnSelf();
        FormExtraFieldCreator::shouldReceive('setExtraFieldId')
            ->with($extraField->id)
            ->andReturnSelf();
        FormExtraFieldCreator::shouldReceive('create')
            ->andReturn($formExtraField);
        return $formExtraField;
    }

    private function mockFormExtraFieldIndexer(\stdClass $form, \stdClass $extraField)
    {
        FormExtraFieldIndexer::shouldReceive('setFormId')
            ->with($form->id)
            ->once()
            ->andReturnSelf();
        FormExtraFieldIndexer::shouldReceive('setQuery')
            ->with(['extra_field_id' => $extraField->id])
            ->once()
            ->andReturnSelf();
        FormExtraFieldIndexer::shouldReceive('index')
            ->once()
            ->andReturn(collect([]));
    }

    private function mockFieldMapCreator($formExtraField, $entity, $appRegistryId, $fieldMapKey)
    {
        FieldMapCreator::shouldReceive('setIdentification')
            ->with($fieldMapKey)
            ->once()
            ->andReturnSelf();
        FieldMapCreator::shouldReceive('setAppRegistryId')
            ->with($appRegistryId)
            ->once()
            ->andReturnSelf();
        FieldMapCreator::shouldReceive('setEntityId')
            ->with($entity->id)
            ->once()
            ->andReturnSelf();
        FieldMapCreator::shouldReceive('setFormExtraFieldId')
            ->with($formExtraField->id)
            ->once()
            ->andReturnSelf();
        FieldMapCreator::shouldReceive('create')
            ->once()
            ->andReturn(null);
    }
}