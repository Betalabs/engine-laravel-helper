<?php

namespace Betalabs\LaravelHelper\Services\Engine;


class GenericShower extends AbstractShower
{
    /**
     * Retrieve a resource on engine
     *
     * @return mixed
     */
    public function retrieve()
    {
        return $this->engineResourceShower->setQuery($this->query)
            ->setEndpoint($this->endpoint)
            ->setEndpointParameters($this->endpointParameters)
            ->setRecordId($this->recordId)
            ->setExceptionMessage(
                trans(
                    $this->exceptionTranslationPath . '.' . $this->endpoint . '.retrieve'
                )
            )
            ->retrieve();
    }

}