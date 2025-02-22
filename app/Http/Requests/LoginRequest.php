<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

const PASSWORD_MIN_LENGTH = 8;

class LoginRequest extends FormRequest
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
            'email' => 'required|email',
            'password' => 'required|min:' . PASSWORD_MIN_LENGTH,
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Email é obrigatório',
            'email.email' => 'Email inválido',
            'password.required' => 'Senha é obrigatória',
            'password.min' => 'Senha deve ter no mínimo ' . PASSWORD_MIN_LENGTH . ' caracteres',
        ];
    }
}
