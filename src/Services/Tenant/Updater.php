<?php

namespace Betalabs\LaravelHelper\Services\Tenant;

use Betalabs\LaravelHelper\Models\EngineRegistry;
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

        $this->saveEngineToken($authenticatable, $input);

        return $authenticatable;
    }

    private function saveEngineToken(Authenticatable $authenticatable, $input)
    {
        if(!empty($input['engine_api_access_token'])) {
            // bySlug() already returns the model; when the slug does not
            // exist Eloquent returns the query builder instead
            $engineRegistry = EngineRegistry::bySlug('engine');

            if (!$engineRegistry instanceof EngineRegistry) {
                throw new \RuntimeException('Engine registry (slug "engine") not found for the tenant');
            }

            $engineRegistry->api_access_token = $input['engine_api_access_token'];
            $engineRegistry->save();
        }

    }
}