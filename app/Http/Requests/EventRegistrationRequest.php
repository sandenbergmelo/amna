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
            'registration_date.required' => 'O campo data de registro é obrigatório.',
            'registration_date.date' => 'O campo data de registro deve ser uma data.',
            'status_presence.required' => 'O campo status de presença é obrigatório.',
            'status_presence.in' => 'O campo status de presença deve ser Confirmado ou Pendente.',
        ];
    }
}
