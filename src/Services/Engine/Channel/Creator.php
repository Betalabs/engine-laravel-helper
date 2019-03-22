<?php

namespace Betalabs\LaravelHelper\Services\Engine\Channel;


use Betalabs\LaravelHelper\Events\ChannelCreated;
use Betalabs\LaravelHelper\Services\Engine\AbstractCreator;
use Illuminate\Support\Facades\Auth;

class Creator extends AbstractCreator
{
    public function create()
    {
        $response = parent::create();
        event(new ChannelCreated($response, Auth::user()));
        return $response;
    }

}