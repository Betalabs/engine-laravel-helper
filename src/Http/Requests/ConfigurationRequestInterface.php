<?php


namespace Betalabs\LaravelHelper\Http\Requests;


interface ConfigurationRequestInterface
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize();
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules();
    /**
     * Get all of the input and files for the request.
     *
     * @param  array|mixed  $keys
     * @return array
     */
    public function all($keys = null);
}