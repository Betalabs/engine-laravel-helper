<?php

namespace Betalabs\LaravelHelper\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Registry extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function toArray($request)
    {
        return [
            'headers' => [
                'Authorization' => "Bearer {$this->accessToken}",
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ]
        ];
    }
}
