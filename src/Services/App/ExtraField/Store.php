<?php

namespace Betalabs\LaravelHelper\Services\App\ExtraField;


use Betalabs\LaravelHelper\Models\EngineExtraField;

class Store
{
    /**
     * @var int
     */
    private $extraFieldCode;
    /**
     * @var string
     */
    private $extraFieldLabel;
    /**
     * @var string
     */
    private $extraFieldSlug;
    /**
     * @var int
     */
    private $formCode;
    /**
     * @var int
     */
    private $tenantId;

    /**
     * @param int $extraFieldCode
     * @return Store
     */
    public function setExtraFieldCode(int $extraFieldCode): Store
    {
        $this->extraFieldCode = $extraFieldCode;
        return $this;
    }

    /**
     * @param string $extraFieldLabel
     * @return Store
     */
    public function setExtraFieldLabel(string $extraFieldLabel): Store
    {
        $this->extraFieldLabel = $extraFieldLabel;
        return $this;
    }

    /**
     * @param string $extraFieldSlug
     * @return Store
     */
    public function setExtraFieldSlug(string $extraFieldSlug): Store
    {
        $this->extraFieldSlug = $extraFieldSlug;
        return $this;
    }

    /**
     * @param int $formCode
     * @return Store
     */
    public function setFormCode(int $formCode): Store
    {
        $this->formCode = $formCode;
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
     * Store extra-field
     */
    public function store()
    {
        EngineExtraField::updateOrCreate([
            'tenant_id' => $this->tenantId,
            'slug' => $this->extraFieldSlug,
        ],[
            'code' => $this->extraFieldCode,
            'label' => $this->extraFieldLabel,
            'form_code' => $this->formCode
        ]);
    }
}