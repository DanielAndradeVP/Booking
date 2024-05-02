<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class StoreUserRequest extends FormRequest
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
                'min:3',
            ],

            'email' => [
                'required',
                'unique:users,email',
                'min:3',
                'email',
            ],

            'password' => [
                'required',
                // 'confirmed',
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
            'name.required' => 'The name mis required',
            'name.string' => 'The name must be string',
            'name.min' => 'The name must have at minimum 3 characters',
            'email.required' => 'The email is required',
            'email.unique' => 'The email must be unique',
            'email.min' => 'The email must have at minimum 3 characters',
            'email.email' => 'The email must be email example: example@example.com',
            'password.required' => 'The password is required',
            'password.confirmed' => 'The password needs to be confirmed',
        ];
    }
}
