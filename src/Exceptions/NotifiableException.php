<?php

namespace Betalabs\LaravelHelper\Exceptions;


use Betalabs\LaravelHelper\Facades\Notification;

class NotifiableException extends \Exception implements Notifiable
{

    /**
     * Report the exception.
     *
     * @return void
     */
    public function report(): void
    {
        Notification::error($this->getMessage());
    }
}