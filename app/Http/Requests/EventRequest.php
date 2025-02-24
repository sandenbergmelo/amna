<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:5120'],
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'O campo título é obrigatório',
            'title.string' => 'O campo título deve ser uma string',
            'title.max' => 'O campo título deve ter no máximo 255 caracteres',
            'description.required' => 'O campo descrição é obrigatório',
            'description.string' => 'O campo descrição deve ser uma string',
            'start_date.required' => 'O campo data de início é obrigatório',
            'start_date.date' => 'O campo data de início deve ser uma data',
            'end_date.required' => 'O campo data de término é obrigatório',
            'end_date.date' => 'O campo data de término deve ser uma data',
            'image.image' => 'O arquivo deve ser uma imagem',
            'image.mimes' => 'O arquivo deve ser do tipo jpeg, png ou jpg',
            'image.max' => 'O arquivo deve ter no máximo 5MB',
        ];
    }
}
