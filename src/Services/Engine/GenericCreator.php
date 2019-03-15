<?php

namespace Betalabs\LaravelHelper\Services\Engine;


class GenericCreator extends AbstractCreator
{
    /**
     * Create resource on engine
     *
     * @return mixed
     */
    public function create()
    {
        return $this->engineResourceCreator->setData($this->data)
            ->setEndpoint($this->endpoint)
            ->setExceptionMessage(
                trans(
                    $this->exceptionTranslationPath . '.' . $this->endpoint . '.create'
                )
            )
            ->create();
    }
}