<?php


namespace Betalabs\LaravelHelper\Tests\Feature\Configuration;


use Betalabs\LaravelHelper\Http\Requests\ConfigurationRequestInterface;
use Illuminate\Foundation\Http\FormRequest;

class MockConfigurationRequest extends FormRequest implements ConfigurationRequestInterface
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
            'config' => 'string'
        ];
    }
}