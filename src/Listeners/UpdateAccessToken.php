<?php

namespace Betalabs\LaravelHelper\Listeners;


use Betalabs\LaravelHelper\Events\AccessTokenUpdated;
use Betalabs\LaravelHelper\Services\Engine\Event\Firer;
use Facades\Betalabs\LaravelHelper\Services\App\EngineAuthenticator;

class UpdateAccessToken
{
    /**
     * @var \Betalabs\LaravelHelper\Services\Engine\Event\Firer
     */
    private $firer;

    /**
     * Create the event listener.
     *
     * @param \Betalabs\LaravelHelper\Services\Engine\Event\Firer $firer
     */
    public function __construct(Firer $firer)
    {
        $this->firer = $firer;
    }

    /**
     * Handle the event.
     *
     * @param \Betalabs\LaravelHelper\Events\AccessTokenUpdated $event
     * @return void
     */
    public function handle(AccessTokenUpdated $event)
    {
        EngineAuthenticator::authenticate($event->tenant);

        $this->firer
            ->setName('AccessToken.Updated')
            ->setParams([
                $event->token,
                $event->tenant->engineRegistry->registry_id
            ])->fire();
    }
}