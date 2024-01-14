<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudentRequestRequest extends FormRequest
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
            'identification' => 'required|string|digits:9|regex:/^[0-9]+$/',
            'name' => 'required|string|max:225',
            'birth_date' => 'required|date_format:d/m/Y|max:225',
            'birth_place' => 'required|string|max:225',
            'address' => 'required|string|max:225',
            'address_street' => 'required|string|max:225',
            'address_house_no' => 'nullable|string|max:225',
            'mother_name' => 'required|string|max:225',
            'mother_phone' => 'required|string|digits:10|regex:/^[0-9]+$/',
            'father_name' => 'required|string|max:255',
            'father_phone' => 'required|string|digits:10|regex:/^[0-9]+$/',
            'gender' => 'required|string',
            'family_status' => 'required|string',
            'custody' => 'required|string',
            'old_school' => 'required|string',
            'school_class_id' => 'required',

            'personal_photo' => 'nullable|max:2048',
            'birth_certificate' => 'required|max:2048',

            'mother_id' => 'required|string|digits:9|regex:/^[0-9]+$/',
            'father_id' => 'required|string|digits:9|regex:/^[0-9]+$/',

            'postal_code' => 'required|integer',
            'family_members' => 'required|integer',
            'zipcode' => 'nullable|integer',
        ];
    }
}
