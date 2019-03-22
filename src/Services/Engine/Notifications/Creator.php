<?php

namespace Betalabs\LaravelHelper\Services\Engine\Notifications;


use Betalabs\LaravelHelper\Services\Engine\AbstractCreator;
use Betalabs\LaravelHelper\Models\Enums\NotificationLevel;

class Creator extends AbstractCreator
{
    /**
     * @var int
     */
    protected $appRegistryId;
    /**
     * @var \Betalabs\LaravelHelper\Models\Enums\NotificationLevel
     */
    protected $level;
    /**
     * @var string
     */
    protected $message;

    /**
     * @param int $appRegistryId
     * @return Creator
     */
    public function setAppRegistryId(int $appRegistryId): Creator
    {
        $this->appRegistryId = $appRegistryId;
        return $this;
    }

    /**
     * @param \Betalabs\LaravelHelper\Models\Enums\NotificationLevel $level
     * @return Creator
     */
    public function setLevel(NotificationLevel $level): Creator
    {
        $this->level = $level;
        return $this;
    }

    /**
     * @param string $message
     * @return Creator
     */
    public function setMessage(string $message): Creator
    {
        $this->message = $message;
        return $this;
    }

    /**
     * Create resource on engine
     *
     * @return mixed
     */
    public function create()
    {
        $this->data = [
            'app_registry_id' => $this->appRegistryId,
            'level' => $this->level->getValue(),
            'message' => $this->message,
        ];
        return parent::create();
    }

}