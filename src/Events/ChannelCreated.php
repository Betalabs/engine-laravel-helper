<?php

namespace Betalabs\LaravelHelper\Events;


use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Queue\SerializesModels;

class ChannelCreated
{
    use SerializesModels;
    /**
     * @var array
     */
    private $data;
    /**
     * @var \Betalabs\LaravelHelper\Models\Tenant
     */
    private $tenant;

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }


    /**
     * @return \Betalabs\LaravelHelper\Models\Tenant
     */
    public function getTenant(): \Betalabs\LaravelHelper\Models\Tenant
    {
        return $this->tenant;
    }

    /**
     * ChannelCreated constructor.
     * @param mixed $data
     * @param \Illuminate\Contracts\Auth\Authenticatable $tenant
     */
    public function __construct($data, Authenticatable $tenant)
    {
        $this->data = $data;
        $this->tenant = $tenant;
    }
}