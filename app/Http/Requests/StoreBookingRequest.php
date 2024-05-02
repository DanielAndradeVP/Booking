<?php

namespace App\Http\Requests;

use App\Rules\StatusRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreBookingRequest extends FormRequest
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
            'guest_name' => [
                'required',
                'string',
                'min:3',
                'max:80',
            ],

            'guest_email' => [
                'required',
                'unique:bookings,guest_email',
                'email',
            ],

            'start_date' => [
                'required',
                'min:6',
            ],

            'end_date' => [
                'required',
                'min:6',
            ],

            'service_id' => [
                'required',
                'exists:services,id',
                'int',
                new StatusRule,
            ],
        ];
    }

    public function messages()
    {
        return [
            'guest_name.required' => 'The guest name is required',
            'guest_name.string' => 'The guest name must be string',
            'guest_name.min' => 'The guest name has minimum 3 characters',
            'guest_name.max' => ' The guest name has maximum 100 characters',

            'guest_email.required' => 'The guest email is required',
            'guest_email.unique' => 'The guest email must be unique',
            'guest_email.email' => 'The guest email must match an email format username@example.com',

            'start_date.required' => 'The start date is required',
            'start_date.int' => 'The start date must be value integer',
            'start_date.minimum' => 'The start date must have minimum 6 characters',

            'end_date.required' => 'The end date is required',
            'end_date.int' => 'The end date must be value integer',
            'end_date.minimum' => 'The start date must have minimum 6 characters',

            'service_id.required' => 'The service_id is required',
            'service_id.exists' => 'The service_id must exist',
            'service_id.int' => 'The service_id must be integer',
        ];
    }
}
