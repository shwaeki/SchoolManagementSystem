<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDailyProgramRequest extends FormRequest
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
            'subject_name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,gif|max:2048',
            'start_time' => 'required|date_format:H:i|after_or_equal:07:00|before:15:00',
            'end_time' => 'required|date_format:H:i|after:start_time|before:15:00',
            'day' => 'required|in:Sunday,Monday,Tuesday,Wednesday,Thursday,Friday,Saturday',
        ];
    }
}
