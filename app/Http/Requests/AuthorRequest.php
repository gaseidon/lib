<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthorRequest extends FormRequest
{
    public function rules()
    {
        // Определяем, является ли метод POST для добавления
        $isCreating = $this->isMethod('post');

        return [
            'name' => [
                $isCreating ? 'required' : 'nullable',
                'string',
                'max:255',
            ],
            'bio' => [
                $isCreating ? 'required' : 'nullable',
                'string',
                'min:3',
                'max:255',
            ],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Имя обязательно для заполнения.',
            'name.string' => 'Имя должно быть строкой.',
            'bio.required' => 'Биография обязательна для заполнения.',
            'bio.string' => 'Биография должна быть строкой.',
            'bio.min' => 'Биография должна содержать минимум 3 символа.',
            'bio.max' => 'Биография не должна превышать 255 символов.',
        ];
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        throw new \Illuminate\Http\Exceptions\HttpResponseException(
            response()->json([
                'message' => 'Ошибка валидации.',
                'errors' => $validator->errors(),
            ], 422)
        );
    }
}
