<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name' => 'string|required',
            'email' => 'string|required|email|unique:users,email',
            'password' => 'required|string|confirmed|regex:'.User::getUserRegex(),
            'password_confirmation' => 'required|string',

        ];
    }

    public function messages(): array
    {
        return [
            'password.regex' => 'Password must be a minimum of 8 chars and contains at least 1 uppercase and lowercase and special symobl',
        ];
    }
}
