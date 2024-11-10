<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UserRequest;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/v1/users",
     *     summary="Получить список всех пользователей",
     *     tags={"Users"},
     *     @OA\Response(
     *         response=200,
     *         description="Список пользователей",
     *         @OA\MediaType(
     *             mediaType="application/json"
     *         ),
     *     ),
     *     @OA\Response(response=500, description="Ошибка сервера")
     * )
     */
    public function index()
    {
        $users = User::getAllUsers();
        return response()->json($users);
    }

    /**
     * @OA\Get(
     *     path="/api/v1/users/{id}",
     *     summary="Просмотр конкретного пользователя",
     *     tags={"Users"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID пользователя",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Информация о пользователе",
     *         @OA\MediaType(
     *             mediaType="application/json"
     *         ),
     *     ),
     *     @OA\Response(response=404, description="Пользователь не найден")
     * )
     */
    public function show($id)
    {
    try{
        $user = User::findOrFail($id);

        return response()->json($user);
               } catch (ModelNotFoundException $e) {
        return response()->json(['error' => 'Пользователь не найден.'], 404);
    }
    }

    /**
     * @OA\Post(
     *     path="/api/v1/users",
     *     summary="Добавить нового пользователя",
     *     tags={"Users"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name", "email"},
     *             @OA\Property(property="name", type="string", description="Имя пользователя", example="Иван Иванов"),
     *             @OA\Property(property="email", type="string", description="Электронная почта пользователя", example="ivan@example.com"),
     *             @OA\Property(property="password", type="string", description="Пароль пользователя", example="strong_password_123"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Пользователь успешно добавлен",
     *         @OA\MediaType(
     *             mediaType="application/json"
     *         ),
     *     ),
     *     @OA\Response(response=400, description="Неверные данные запроса"),
     *     @OA\Response(response=422, description="Ошибка валидации")
     * )
     */
    public function store(UserRequest $request)
    {
        $user = User::createUser($request->validated());
        return response()->json($user, 201);
    }

    /**
     * @OA\Put(
     *     path="/api/v1/users/{id}",
     *     summary="Обновить информацию о пользователе",
     *     tags={"Users"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID пользователя",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name", "email"},
     *             @OA\Property(property="name", type="string", description="Имя пользователя", example="Иван Иванов"),
     *             @OA\Property(property="email", type="string", description="Электронная почта пользователя", example="ivan@example.com"),
     *             @OA\Property(property="password", type="string", description="Пароль пользователя", example="new_password_456"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Пользователь успешно обновлен",
     *         @OA\MediaType(
     *             mediaType="application/json"
     *         ),
     *     ),
     *     @OA\Response(response=400, description="Неверные данные запроса"),
     *      @OA\Response(response=422, description="Ошибка валидации"),
     *      @OA\Response(response=404, description="Пользователь не найден")
     * )
     */
    public function update(UserRequest $request, $id)
    {
        try{
        $user = User::findOrFail($id);


        $user->updateUser($request->validated());
        return response()->json($user);
    } catch (ModelNotFoundException $e) {
        return response()->json(['error' => 'Пользователь не найден.'], 404);
    }
    }

    /**
     * @OA\Delete(
     *     path="/api/v1/users/{id}",
     *     summary="Удалить пользователя",
     *     tags={"Users"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID пользователя",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Пользователь удален"
     *     ),
     *     @OA\Response(response=404, description="Пользователь не найден")
     * )
     */
    public function destroy($id)
    {
     try{
        $user = User::findOrFail($id);


        $user->deleteUser();
        return response()->json(['message' => 'User deleted successfully'], 204);

        } catch (ModelNotFoundException $e) {
        return response()->json(['error' => 'Пользователь не найден.'], 404);
    }
    }
}
