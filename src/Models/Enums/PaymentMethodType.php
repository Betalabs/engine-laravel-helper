<?php

namespace Betalabs\LaravelHelper\Models\Enums;


use MyCLabs\Enum\Enum;

class PaymentMethodType extends Enum
{
    const CREDIT_CARD = 'credit card';
    const BANK_SLIP = 'bank slip';
    const DEBIT_CARD = 'debit card';
    const ON_SHIPPING = 'payment on shipping';
    const NON_TRANSPARENT = 'non-transparent checkout';
}