<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventRegistrationRequest extends FormRequest
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
            'registration_date' => ['required', 'date'],
            'status_presence' => ['required', 'in:Confirmed,Pending'],
        ];
    }

    public function messages()
    {
        return [
            'registration_date.required' => 'The registration date field is required.',
            'registration_date.date' => 'The registration date field must be a date.',
            'status_presence.required' => 'The status presence field is required.',
            'status_presence.in' => 'The status presence field must be Confirmed or Pending.',
        ];
    }
}
