<?php

namespace Betalabs\LaravelHelper\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Register extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'tenant.name' => 'string|max:255|required',
            'tenant.email' => 'email|max:255|required',

            'engine_registry.registry_id' => 'numeric|required',
            'engine_registry.api_base_uri' => 'url|required',
            'engine_registry.api_access_token' => 'string|required',
        ];
    }
}
