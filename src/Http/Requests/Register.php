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
            'company.name' => 'string|max:60|required',
            'company.trading_name' => 'string|max:60|required',
            'company.email' => 'email|max:80|required',
            'company.cnpj' => 'string|size:14|required',

            'engine_credential.client_id' => 'numeric|required',
            'engine_credential.client_secret' => 'string|max:255|required',
            'engine_credential.username' => 'string|max:255|required',
            'engine_credential.password' => 'string|max:255|required',

            'app_configuration.engine_app_registry_id' => 'numeric|nullable',
            'app_configuration.engine_api_base_uri' => 'url|nullable',
        ];
    }
}
