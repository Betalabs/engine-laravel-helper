<?php

namespace Betalabs\LaravelHelper\Services\App\ExtraField;

use Betalabs\LaravelHelper\Events\ExtraFieldAndFormCreated;
use Betalabs\LaravelHelper\Services\Engine\ExtraFieldType\Indexer as ExtraFieldTypeIndexer;
use Betalabs\LaravelHelper\Services\Engine\Channel\Indexer as ChannelIndexer;
use Betalabs\LaravelHelper\Services\Engine\Entity\Indexer as EntityIndexer;
use Betalabs\LaravelHelper\Services\Engine\Form\Indexer as FormIndexer;
use Betalabs\LaravelHelper\Services\Engine\Form\Creator as FormCreator;
use Betalabs\LaravelHelper\Services\Engine\ExtraField\Indexer as ExtraFieldIndexer;
use Betalabs\LaravelHelper\Services\Engine\ExtraField\Creator as ExtraFieldCreator;
use Betalabs\LaravelHelper\Services\Engine\FormExtraField\Creator as FormExtraFieldCreator;
use Illuminate\Support\Facades\Auth;


class Creator
{
    /**
     * @var string
     */
    private $extraFieldType;
    /**
     * @var string
     */
    private $extraFieldLabel;
    /**
     * @var string
     */
    private $formName;
    /**
     * @var string
     */
    private $entityIdentification;
    /**
     * @var string
     */
    private $channel = 'ERP';
    /**
     * @var \Betalabs\LaravelHelper\Services\Engine\ExtraFieldType\Indexer
     */
    private $extraFieldTypeIndexer;
    /**
     * @var \Betalabs\LaravelHelper\Services\Engine\Channel\Indexer
     */
    private $channelIndexer;
    /**
     * @var \Betalabs\LaravelHelper\Services\Engine\Form\Indexer
     */
    private $formIndexer;
    /**
     * @var \Betalabs\LaravelHelper\Services\Engine\Form\Creator
     */
    private $formCreator;
    /**
     * @var \Betalabs\LaravelHelper\Services\Engine\Entity\Indexer
     */
    private $entityIndexer;
    /**
     * @var \Betalabs\LaravelHelper\Services\Engine\ExtraField\Indexer
     */
    private $extraFieldIndexer;
    /**
     * @var \Betalabs\LaravelHelper\Services\Engine\ExtraField\Creator
     */
    private $extraFieldCreator;
    /**
     * @var \Betalabs\LaravelHelper\Services\Engine\FormExtraField\Creator
     */
    private $formExtraFieldCreator;

    /**
     * Creator constructor.
     * @param \Betalabs\LaravelHelper\Services\Engine\ExtraFieldType\Indexer $extraFieldTypeIndexer
     * @param \Betalabs\LaravelHelper\Services\Engine\Channel\Indexer $channelIndexer
     * @param \Betalabs\LaravelHelper\Services\Engine\Entity\Indexer $entityIndexer
     * @param \Betalabs\LaravelHelper\Services\Engine\Form\Indexer $formIndexer
     * @param \Betalabs\LaravelHelper\Services\Engine\Form\Creator $formCreator
     * @param \Betalabs\LaravelHelper\Services\Engine\ExtraField\Indexer $extraFieldIndexer
     * @param \Betalabs\LaravelHelper\Services\Engine\ExtraField\Creator $extraFieldCreator
     * @param \Betalabs\LaravelHelper\Services\Engine\FormExtraField\Creator $formExtraFieldCreator
     */
    public function __construct(
        ExtraFieldTypeIndexer $extraFieldTypeIndexer,
        ChannelIndexer $channelIndexer,
        EntityIndexer $entityIndexer,
        FormIndexer $formIndexer,
        FormCreator $formCreator,
        ExtraFieldIndexer $extraFieldIndexer,
        ExtraFieldCreator $extraFieldCreator,
        FormExtraFieldCreator $formExtraFieldCreator
    ) {
        $this->extraFieldTypeIndexer = $extraFieldTypeIndexer;
        $this->channelIndexer = $channelIndexer;
        $this->entityIndexer = $entityIndexer;
        $this->formIndexer = $formIndexer;
        $this->formCreator = $formCreator;
        $this->extraFieldIndexer = $extraFieldIndexer;
        $this->extraFieldCreator = $extraFieldCreator;
        $this->formExtraFieldCreator = $formExtraFieldCreator;
    }


    /**
     * @param string $extraFieldType
     * @return Creator
     */
    public function setExtraFieldType(string $extraFieldType): Creator
    {
        $this->extraFieldType = $extraFieldType;
        return $this;
    }

    /**
     * @param string $extraFieldLabel
     * @return Creator
     */
    public function setExtraFieldLabel(string $extraFieldLabel): Creator
    {
        $this->extraFieldLabel = $extraFieldLabel;
        return $this;
    }

    /**
     * @param string $formName
     * @return Creator
     */
    public function setFormName(string $formName): Creator
    {
        $this->formName = $formName;
        return $this;
    }

    /**
     * @param string $entityIdentification
     * @return Creator
     */
    public function setEntityIdentification(string $entityIdentification): Creator
    {
        $this->entityIdentification = $entityIdentification;
        return $this;
    }

    /**
     * @param string $channel
     * @return Creator
     */
    public function setChannel(string $channel): Creator
    {
        $this->channel = $channel;
        return $this;
    }

    /**
     * Create an extra field on Engine and associate it with a form
     */
    public function create()
    {
        $channelId = $this->getChannelId();
        $entityId = $this->getEntityId();

        $form = $this->createOrGetForm(
            $entityId,
            [$channelId]
        );
        $extraFieldTypeId = $this->getExtraFieldTypeId($this->extraFieldType);

        $extraField = $this->createOrGetExtraField($entityId, $extraFieldTypeId);

        $this->formExtraFieldCreator->setFormId($form->id)
            ->setExtraFieldId($extraField->id)
            ->create();
        event(new ExtraFieldAndFormCreated($extraField, $form, Auth::user()));
    }

    /**
     * @param $type
     * @return mixed
     */
    private function getExtraFieldTypeId($type)
    {
        return $this->extraFieldTypeIndexer
            ->setQuery(compact('type'))
            ->index()
            ->first()
            ->id;
    }

    /**
     * @return mixed
     */
    private function getChannelId()
    {
        return $this->channelIndexer
            ->setQuery(['channel' => $this->channel])
            ->index()
            ->first()
            ->id;
    }

    /**
     * @return mixed
     */
    private function getEntityId()
    {
        return $this->entityIndexer
            ->setQuery(['identification' => $this->entityIdentification])
            ->index()
            ->first()
            ->id;
    }

    /**
     * Create or get form
     *
     * @param int $entityId
     * @param array $channels
     * @return mixed
     */
    private function createOrGetForm(
        int $entityId,
        array $channels
    ) {
        $form = $this->formIndexer
            ->setQuery([
                'name' => $this->formName,
                'entity' => $this->entityIdentification,
                'channels' => $this->channel,
                '_filter-approach' => 'and'
            ])
            ->index()
            ->first();
        if(empty($form)) {
            $form = $this->formCreator->setName($this->formName)
                ->setEntityId($entityId)
                ->setChannels($channels)
                ->create();
        }
        return $form;
    }

    /**
     * Create or get Extra Field
     *
     * @param int $entityId
     * @param int $extraFieldTypeId
     * @return mixed
     */
    private function createOrGetExtraField(int $entityId, int $extraFieldTypeId)
    {
        $extraField = $this->extraFieldIndexer
            ->setQuery(["label" => $this->extraFieldLabel])
            ->index()
            ->first();

        if(empty($extraField)) {
            $extraField = $this->extraFieldCreator->setEntityId($entityId)
                ->setExtraFieldTypeId($extraFieldTypeId)
                ->setLabel($this->extraFieldLabel)
                ->create();
        }

        return $extraField;
    }

}