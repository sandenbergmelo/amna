<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewsRequest extends FormRequest
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
            'content' => ['required', 'string'],
            'external_link' => ['nullable', 'url'],
            'image' => ['nullable', 'image', 'max:5120', 'mimes:jpeg,png,jpg'],
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'O campo título é obrigatório',
            'title.string' => 'O campo título deve ser uma string',
            'title.max' => 'O campo título deve ter no máximo 255 caracteres',
            'content.required' => 'O campo conteúdo é obrigatório',
            'content.string' => 'O campo conteúdo deve ser uma string',
            'external_link.url' => 'O campo link externo deve ser uma URL válida',
            'image.image' => 'O arquivo deve ser uma imagem',
            'image.max' => 'O arquivo deve ter no máximo 5MB',
            'image.mimes' => 'O arquivo deve ser do tipo jpeg, png ou jpg',
        ];
    }
}
