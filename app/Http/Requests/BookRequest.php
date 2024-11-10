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
        return true;
    }

    /**
     * Получите правила валидации для запроса.
     *
     * @return array
     */
    public function rules()
    {
        // Проверка, является ли запрос на создание
        $isCreating = $this->isMethod('post');

        return [
            'title' => [
                $isCreating ? 'required' : 'nullable',
                'string',
                'max:255',
            ],
            'author_id' => [
                $isCreating ? 'required' : 'nullable',
                'exists:authors,id',
            ],
            'published_at' => 'nullable|date',
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
            'title.required' => 'Название книги обязательно для заполнения.',
            'title.string' => 'Название должно быть строкой.',
            'title.max' => 'Название не должно превышать 255 символов.',
            'author_id.required' => 'Идентификатор автора обязателен для заполнения.',
            'author_id.exists' => 'Указанный автор не существует.',
            'published_at.date' => 'Дата публикации должна быть в правильном формате.',
        ];
    }

    /**
     * Обработка неудачной валидации.
     *
     * @param \Illuminate\Contracts\Validation\Validator $validator
     */
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
