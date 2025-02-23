<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'current_password' => ['required', 'string', 'min:8'],
            'password' => ['string', 'min:8', 'confirmed'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'O campo nome é obrigatório',
            'name.string' => 'O campo nome deve ser uma string',
            'name.max' => 'O campo nome deve ter no máximo 255 caracteres',
            'email.required' => 'O campo email é obrigatório',
            'email.string' => 'O campo email deve ser uma string',
            'email.email' => 'O campo email deve ser um email válido',
            'email.max' => 'O campo email deve ter no máximo 255 caracteres',
            'current_password.required' => 'O campo senha atual é obrigatório',
            'current_password.string' => 'O campo senha atual deve ser uma string',
            'current_password.min' => 'O campo senha atual deve ter no mínimo 8 caracteres',
            'password.required' => 'O campo senha é obrigatório',
            'password.string' => 'O campo senha deve ser uma string',
            'password.min' => 'O campo senha deve ter no mínimo 8 caracteres',
            'password.confirmed' => 'O campo senha não confere com a confirmação',
        ];
    }
}
