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
            'identification' => 'required|string|regex:/^[0-9]+$/|unique:student_requests|unique:students',

            'name' => 'required|string|max:225',
            'birth_date' => 'required|date_format:d/m/Y|max:225',
            'birth_place' => 'nullable|string|max:225',
            'address' => 'required|string|max:225',
            'address_street' => 'nullable|string|max:225',
            'address_house_no' => 'nullable|string|max:225',
            'mother_name' => 'required|string|max:225',
            'mother_phone' => 'required|string|digits:10|regex:/^[0-9]+$/',
            'father_name' => 'required|string|max:255',
            'father_phone' => 'required|string|digits:10|regex:/^[0-9]+$/',
            'gender' => 'required|string',
            'family_status' => 'required|string',
            'custody' => 'required|string',
            'notes' => 'nullable|string',

            'personal_photo' => 'nullable|max:2048',
            'birth_certificate' => 'nullable|max:2048',

            'mother_id' => 'nullable|string|digits:9|regex:/^[0-9]+$/',
            'father_id' => 'nullable|string|digits:9|regex:/^[0-9]+$/',

            'postal_code' => 'nullable|integer',
            'family_members' => 'nullable|integer',
            'zipcode' => 'nullable|integer',
        ];
    }
}
