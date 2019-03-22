<?php

namespace Betalabs\LaravelHelper\Exceptions;


interface Notifiable
{
    /**
     * Report the exception.
     *
     * @return void
     */
    public function report(): void;
}