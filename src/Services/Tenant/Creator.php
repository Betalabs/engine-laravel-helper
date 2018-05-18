<?php

namespace Betalabs\LaravelHelper\Services\Tenant;

use Betalabs\LaravelHelper\Models\Tenant;
use Illuminate\Support\Facades\DB;

class Creator
{
    /**
     * @var array
     */
    private $data = [];

    /**
     * Set the data property.
     *
     * @param array $data
     */
    public function setData(array $data): void
    {
        $this->data = $data;
    }

    /**
     * Create a new tenant.
     *
     * @return \Betalabs\LaravelHelper\Models\Tenant
     * @throws \Exception
     */
    public function create(): Tenant
    {
        try {
            DB::beginTransaction();

            /** @var Tenant $tenant */
            $tenant = Tenant::query()->create($this->data);
            $tenant->accessToken = $tenant->createToken(
                "{$tenant->name} token"
            )->accessToken;

            DB::commit();

            return $tenant;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }
}