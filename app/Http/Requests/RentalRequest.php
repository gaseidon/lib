<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RentalRequest extends FormRequest
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
            'book_id' => 'exists:books,id',  // Книга должна существовать в базе данных
            'user_id' => 'exists:users,id',  // Пользователь должен существовать в базе данных
            'rented_at' => 'date',  // Дата аренды должна быть корректной
            'due_date' => 'date|after_or_equal:rented_at',  // Дата возврата должна быть позже или равна дате аренды
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
            'book_id.exists' => 'Указанная книга не существует.',
            'user_id.exists' => 'Указанный пользователь не существует.',
            'rented_at.date' => 'Дата аренды должна быть в правильном формате.',
            'due_date.date' => 'Дата возврата должна быть в правильном формате.',
            'due_date.after_or_equal' => 'Дата возврата не может быть раньше даты аренды.',
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

