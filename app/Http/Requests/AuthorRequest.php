<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthorRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'nullable|string|max:255',
            'bio' => 'nullable|string|min:3|max:255',
        ];
    }

    public function messages()
    {
        return [
            'name.string' => 'Имя должно быть строкой.',
            'bio.string' => 'Биография должна быть строкой.',
            'bio.min' => 'Биография должна содержать минимум 3 символа.',
        ];
    }

    public function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        throw new \Illuminate\Http\Exceptions\HttpResponseException(
            response()->json([
                'message' => 'Ошибка валидации.',
                'errors' => $validator->errors(),
            ], 422)
        );
    }
}

