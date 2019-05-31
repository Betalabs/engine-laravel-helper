<?php

namespace Betalabs\LaravelHelper\Services\Token;


use Laravel\Passport\Bridge\PersonalAccessGrant;

class PerennialAccessGrant extends PersonalAccessGrant
{
    /**
     * {@inheritdoc}
     */
    public function getIdentifier()
    {
        return 'perennial_access';
    }
}