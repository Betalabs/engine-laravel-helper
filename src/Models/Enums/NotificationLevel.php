<?php

namespace Betalabs\LaravelHelper\Models\Enums;


use MyCLabs\Enum\Enum;

class NotificationLevel extends Enum
{
    const INFO = 'INFO';
    const ALERT = 'ALERT';
    const ERROR = 'ERROR';
}