<?php

namespace Betalabs\LaravelHelper\Services\Engine;


trait ReplacesEndpointParameters
{
    /**
     * Replace url parameters between curly braces for object attributes
     */
    private function replaceEndpointParameters()
    {
        if(empty($this->endpointParameters)) {
            return;
        }

        $matches = [];
        preg_match_all('/{(.*?)}/', $this->endpoint, $matches);
        foreach($matches[1] as $match) {
            $this->endpoint = str_replace("{{$match}}", $this->endpointParameters[$match], $this->endpoint);
        }
    }
}