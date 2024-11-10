<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Определяем, авторизован ли пользователь для выполнения этого запроса.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Получить правила валидации, применяемые к запросу.
     *
     * @return array
     */
    public function rules()
    {
        // Проверяем, является ли запросом на создание (POST)
        $isCreating = $this->isMethod('post');

        return [
            'name' => [
                $isCreating ? 'required' : 'nullable',
                'string',
                'max:255',
            ],
            'email' => [
                $isCreating ? 'required' : 'nullable',
                'email',
                'unique:users,email',
            ],
            'password' => [
                $isCreating ? 'required' : 'nullable',
                'string',
                'min:6',
            ],
        ];
    }

    /**
     * Получить пользовательские сообщения об ошибках для отказов валидации.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Имя обязательно для заполнения',
            'name.string' => 'Имя должно быть строкой',
            'email.required' => 'Email обязателен для заполнения',
            'email.email' => 'Некорректный формат email',
            'email.unique' => 'Этот email уже используется',
            'password.required' => 'Пароль обязателен для заполнения',
            'password.min' => 'Пароль должен быть не менее 6 символов',
        ];
    }

    /**
     * Обработка неудачной валидации.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     */
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
