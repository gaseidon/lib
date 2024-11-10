<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
{
    /**
     * Определите, авторизован ли пользователь для выполнения этого запроса.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;  // Вы можете добавить логику для проверки прав доступа
    }

    /**
     * Получите правила валидации для запроса.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'string|max:255',
            'author_id' => 'exists:authors,id',
            'published_at' => 'nullable|date'
        ];
    }

    /**
     * Получите сообщения об ошибках для валидации.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'title.string' => 'Название должно быть строкой.',
            'author_id.exists' => 'Указанный автор не существует.',
            'published_at.date' => 'Дата публикации должна быть в правильном формате.'
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
