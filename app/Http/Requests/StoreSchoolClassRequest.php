<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSchoolClassRequest extends FormRequest
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
            'name' => 'required|string|max:225',
            'code' => 'required|string|max:225',
            'phone' => 'nullable|string|digits_between:9,10|regex:/^[0-9]+$/',
            'address' => 'nullable|string|max:225',
            'alphabetical_name' => 'nullable|max:2',
            'student_start_age' => 'nullable|numeric',
            'student_end_age' => 'nullable|numeric',
            'supervisor ' => 'nullable|numeric|exists:teachers,id',
        ];
    }
}
