<?php

namespace Betalabs\LaravelHelper\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Tenant extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'created_at' => $this->created_at->toDateTimeString(),
            'updated_at' => $this->updated_at->toDateTimeString(),
            'access_token' => $this->when(
                !empty($this->accessToken),
                $this->accessToken
            )
        ];
    }
}
