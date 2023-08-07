<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name'=> 'required|string|max:225',
            'email' => 'required|max:225|unique:users,email|email',
            'password' => 'required|confirmed|min:6',
            'birth_date' => 'nullable|date|max:225',
            'phone' => 'nullable|string|digits:10|regex:/^[0-9]+$/',
        ];
    }
}
