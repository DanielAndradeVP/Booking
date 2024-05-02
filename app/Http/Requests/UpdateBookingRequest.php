<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBookingRequest extends FormRequest
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
                'string',
                'min:3',
                'max:100',
            ],

            'guest_email' => [
                'unique:bookings,email',
                'email',
            ],

            'start_date' => [
                'int',
                'digits:10',
            ],

            'end_date' => [
                'int',
                'digits:10',
            ],
        ];
    }

    public function messages()
    {
        return [
            'guest_name.string' => 'The guest name must be string',
            'guest_name.min' => 'The guest name has minimum 3 characters',
            'guest_name.max' => ' The guest name has maximum 100 characters',

            'guest_email.unique' => 'The guest email must be unique',
            'guest_email.email' => 'The guest email must match an email format username@example.com',

            'start_date.int' => 'The start date must be value integer',
            'start_date.digits' => 'The start date must have 10 characters match dd/mm/aaaa',

            'end_date.int' => 'The end date must be value integer',
            'end_date.digits' => 'The start date must have 10 characters match dd/mm/aaaa',
        ];
    }
}
