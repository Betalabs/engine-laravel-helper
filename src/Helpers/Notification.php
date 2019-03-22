<?php

namespace Betalabs\LaravelHelper\Helpers;


use Betalabs\LaravelHelper\Models\Enums\NotificationLevel;
use Betalabs\LaravelHelper\Services\App\EngineSdkAuth;
use Betalabs\LaravelHelper\Services\Engine\Notifications\Creator;
use Illuminate\Support\Facades\Auth;

class Notification
{
    /**
     * @var \Betalabs\LaravelHelper\Services\App\EngineSdkAuth
     */
    private $engineSdkAuth;
    /**
     * @var \Betalabs\LaravelHelper\Services\Engine\Notifications\Creator
     */
    private $creator;

    /**
     * Notification constructor.
     * @param \Betalabs\LaravelHelper\Services\App\EngineSdkAuth $engineSdkAuth
     * @param \Betalabs\LaravelHelper\Services\Engine\Notifications\Creator $creator
     */
    public function __construct(
        EngineSdkAuth $engineSdkAuth,
        Creator $creator
    ) {
        $this->engineSdkAuth = $engineSdkAuth;
        $this->creator = $creator;
    }

    /**
     * Send an info notification to Engine.
     *
     * @param string $message
     */
    public function info(string $message)
    {
        $this->send(__FUNCTION__, $message);
    }

    /**
     * Send an alert notification to Engine.
     *
     * @param string $message
     */
    public function alert(string $message)
    {
        $this->send(__FUNCTION__, $message);
    }

    /**
     * Send an error notification to Engine.
     *
     * @param string $message
     */
    public function error(string $message)
    {
        $this->send(__FUNCTION__, $message);
    }

    /**
     * Send a notification
     *
     * @param $level
     * @param $message
     */
    private function send(string $level, string $message)
    {
        $tenant = Auth::user();
        $this->engineSdkAuth->authenticate($tenant);
        $level = new NotificationLevel(strtoupper($level));

        $this->creator->setAppRegistryId($tenant->engineRegistry->registry_id)
            ->setLevel($level)
            ->setMessage($message)
            ->create();
    }
}