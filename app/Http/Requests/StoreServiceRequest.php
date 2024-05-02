<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreServiceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'unique:services,name',
                'min:3',
                'max:50',
            ],

            'description' => [
                'required',
                'min:5',
                'string',

            ],

            'price' => [
                'required',
                'int',
                'min_digits:1',
            ],

            'capacity' => [
                'required',
                'int',
                'min_digits:1',
            ],

            'location' => [
                'unique:services,location',
                'required',
                'string',
                'min:5',
                'max:100',
            ],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The name is required',
            'name.string' => 'The name must be string',
            'name.unique' => 'The name must be unique',
            'name.min' => 'The name has minimum 3 characters',
            'name.max' => 'The name has maximum 50 characters',

            'description.required' => 'The description is required',
            'description.string' => 'The description must be string',
            'description.min' => 'The description has minimun 5 characters',

            'price.required' => 'The price is required',
            'price.int' => 'The price must be value integer',
            'price.min_digits' => 'The price has minimun 1 digits ',

            'capacity.required' => 'The capacity is required',
            'capacity.int' => 'The capacity must be value integer',
            'capacity.min_digits' => 'The capacity in at guest has minimum 1 digits',

            'location.required' => 'The location is required',
            'location.string' => 'The location must be string',
            'location.min' => 'The location has minimun 5 characters',
            'location.max' => 'The location has maximum 100 characters',
            'location.unique' => 'The location must be unique',
        ];
    }
}
