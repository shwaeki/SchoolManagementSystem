<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudentRequest extends FormRequest
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
            'identification' => 'required|integer|digits:9|unique:students',
            'name' => 'required|string|max:225',
            'birth_date' => 'required|date|max:225',
            'address' => 'required|string|max:225',
            'mother_name' => 'required|string|max:225',
            'mother_phone' => 'required|integer|digits:10',
            'father_name' => 'required|string|max:255',
            'father_phone' => 'required|integer|digits:10',
            'sex' => 'required|string',
            'family_status' => 'required|string',
            'custody' => 'required|string',
            'notes' => 'nullable|string',
        ];
    }
}
