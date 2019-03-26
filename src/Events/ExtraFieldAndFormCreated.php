<?php

namespace Betalabs\LaravelHelper\Events;


use Illuminate\Queue\SerializesModels;
use Betalabs\LaravelHelper\Models\Tenant;

class ExtraFieldAndFormCreated
{
    use SerializesModels;

    /**
     * @var mixed
     */
    private $extraField;
    /**
     * @var mixed
     */
    private $form;
    /**
     * @var \Betalabs\LaravelHelper\Models\Tenant
     */
    private $tenant;

    /**
     * @return mixed
     */
    public function getExtraField()
    {
        return $this->extraField;
    }

    /**
     * @return mixed
     */
    public function getForm()
    {
        return $this->form;
    }

    /**
     * @return \Betalabs\LaravelHelper\Models\Tenant
     */
    public function getTenant(): Tenant
    {
        return $this->tenant;
    }

    /**
     * ExtraFieldAndFormCreated constructor.
     * @param mixed $extraField
     * @param mixed $form
     * @param \Betalabs\LaravelHelper\Models\Tenant $tenant
     */
    public function __construct(
        $extraField,
        $form,
        Tenant $tenant
    ) {
        $this->extraField = $extraField;
        $this->form = $form;
        $this->tenant = $tenant;
    }


}