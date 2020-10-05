<?php

namespace Betalabs\LaravelHelper\Services\App\Channel;


use Betalabs\LaravelHelper\Models\EngineChannel;

class Store
{
    /**
     * @var string
     */
    private $code;
    /**
     * @var int
     */
    private $tenantId;
    /**
     * @var string
     */
    private $slug;

    /**
     * @param string $code
     * @return Store
     */
    public function setCode(string $code): Store
    {
        $this->code = $code;
        return $this;
    }

    /**
     * @param int $tenantId
     * @return Store
     */
    public function setTenantId(int $tenantId): Store
    {
        $this->tenantId = $tenantId;
        return $this;
    }

    /**
     * @param string $slug
     * @return Store
     */
    public function setSlug(string $slug): Store
    {
        $this->slug = \Str::slug($slug);
        return $this;
    }

    /**
     * @return \Betalabs\LaravelHelper\Models\EngineChannel
     */
    public function store(): EngineChannel
    {
        return EngineChannel::create([
            'code' => $this->code,
            'slug' => $this->slug,
            'tenant_id' => $this->tenantId
        ]);
    }
}
