<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAssistantRequest extends FormRequest
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
            'identification' => 'required|string|digits:9|regex:/^[0-9]+$/|unique:teachers',
            'name' => 'required|string|max:225',
            'birth_date' => 'required|date_format:d/m/Y|max:225',
            'star_work_date' => 'nullable|date_format:d/m/Y|max:225',
            'email' => 'nullable|email|max:225',
            'address' => 'required|string|max:225',
            'phone' => 'required|string|digits:10|regex:/^[0-9]+$/',
            'phone_2' => 'nullable|string|digits:10|regex:/^[0-9]+$/',
            'gender' => 'required|string',
            'status' => 'required|string',
            'password' => 'required|string',
            'notes' => 'nullable|string',

            'id_photo' => 'nullable|max:2048',
            'job_type' => 'required|string',
            'bank_name' => 'nullable|string',
            'bank_branch' => 'nullable|string',
            'bank_account' => 'nullable|string',
        ];
    }
}
