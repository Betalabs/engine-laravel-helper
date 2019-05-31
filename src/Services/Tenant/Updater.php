<?php

namespace Betalabs\LaravelHelper\Services\Tenant;

use Illuminate\Contracts\Auth\Authenticatable;

class Updater
{
    /**
     * @param \Illuminate\Contracts\Auth\Authenticatable $authenticatable
     * @param $input
     * @return \Illuminate\Contracts\Auth\Authenticatable
     */
    public function update(Authenticatable $authenticatable, $input): Authenticatable
    {
        $authenticatable->update($input);
        $authenticatable->refresh();
        $authenticatable->accessToken = $authenticatable->createToken(
            "{$authenticatable->name} token"
        )->accessToken;

        return $authenticatable;
    }
}