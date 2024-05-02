<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class UpdateUserRequest extends FormRequest
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
                'string',
                'min:3',
            ],

            'email' => [
                'unique:users,email',
                'min:3',
                'email',
            ],

            'password' => [
                'confirmed',
                Password::min(8)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols(),
            ],
        ];
    }

    public function messages()
    {
        return [
            'name.string' => 'The name must be string',
            'name.min' => 'The name must have at minimum 3 characters',
            'email.unique' => 'The email must be unique',
            'email.min' => 'The email must have at minimum 3 characters',
            'email.email' => 'The email must be email example: example@example.com',
            'password.confirmed' => 'The password needs to be confirmed',
        ];
    }
}
