<?php

namespace Betalabs\LaravelHelper\Events;

use Betalabs\LaravelHelper\Models\Tenant;
use Illuminate\Queue\SerializesModels;

class GenesisCompleted
{
    use SerializesModels;

    /**
     * @var \Betalabs\LaravelHelper\Models\Tenant
     */
    public $tenant;

    /**
     * GenesisCompleted constructor.
     *
     * @param \Betalabs\LaravelHelper\Models\Tenant $tenant
     */
    public function __construct(Tenant $tenant)
    {
        $this->tenant = $tenant;
    }
}