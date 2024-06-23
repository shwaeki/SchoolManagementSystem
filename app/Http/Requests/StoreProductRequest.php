<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'price' => 'required|numeric|min:0|digits_between:1,12',
            'description' => 'nullable|string',
            'category' => 'nullable|string|max:225',
            'quantity' => 'nullable|numeric|min:0',
            'image' => 'nullable|image|max:2048',
        ];
    }
}

