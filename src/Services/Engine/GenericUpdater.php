<?php

namespace Betalabs\LaravelHelper\Services\Engine;


class GenericUpdater extends AbstractUpdater
{
    /**
     * @return mixed
     */
    public function update()
    {
        return $this->engineResourceUpdater
            ->setData($this->data)
            ->setEndpoint($this->endpoint)
            ->setEndpointParameters($this->endpointParameters)
            ->setRecordId($this->recordId)
            ->setExceptionMessage(
                trans(
                $this->exceptionTranslationPath . '.' . $this->endpoint . '.update'
            ))
            ->update();
    }

}