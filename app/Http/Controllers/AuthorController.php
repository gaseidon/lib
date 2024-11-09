<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use App\Http\Requests\AuthorRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AuthorController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/v1/authors",
     *     summary="Получить список всех авторов с книгами",
     *     tags={"Authors"},
     *     @OA\Response(
     *         response=200,
     *         description="Список авторов с книгами",
     *         @OA\MediaType(
     *             mediaType="application/json"
     *         ),
     *     ),
     *     @OA\Response(response=500, description="Ошибка сервера")
     * )
     */
    public function index()
    {
        return Author::getAllAuthorsWithBooks();
    }

    /**
     * @OA\Post(
     *     path="/api/v1/authors",
     *     summary="Добавить нового автора",
     *     tags={"Authors"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name"},
     *             @OA\Property(property="name", type="string", description="Имя автора", example="Иван Тургенев"),
     *             @OA\Property(property="bio", type="string", description="Биография автора", example="Русский писатель и драматург."),
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Автор успешно добавлен",
     *         @OA\MediaType(
     *             mediaType="application/json"
     *         ),
     *     ),
     *     @OA\Response(response=400, description="Неверные данные запроса"),
     *      @OA\Response(response=422, description="Ошибка валидации")
     * )
     */
    public function store(AuthorRequest $request)
    {
        $author = Author::createAuthor($request->validated());
        return response()->json($author, 201);
    }

    /**
     * @OA\Get(
     *     path="/api/v1/authors/{id}",
     *     summary="Получить информацию об авторе",
     *     tags={"Authors"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID автора",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Информация об авторе",
     *         @OA\MediaType(
     *             mediaType="application/json"
     *         ),
     *     ),
     *     @OA\Response(response=404, description="Автор не найден")
     * )
     */
    public function show($id)
    {
        try {
            return Author::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Author not found'], 404);
        }
    }

    /**
     * @OA\Put(
     *     path="/api/v1/authors/{id}",
     *     summary="Обновить информацию о авторе",
     *     tags={"Authors"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID автора",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name"},
     *             @OA\Property(property="name", type="string", description="Имя автора", example="Иван Тургенев"),
     *             @OA\Property(property="bio", type="string", description="Биография автора", example="Русский писатель и драматург."),
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Автор успешно обновлен",
     *         @OA\MediaType(
     *             mediaType="application/json"
     *         ),
     *     ),
     *     @OA\Response(response=400, description="Неверные данные запроса"),
     *     @OA\Response(response=422, description="Ошибка валидации")
     * )
     */
    public function update(AuthorRequest $request, $id)
    {
        $author = Author::findOrFail($id);
        $updatedAuthor = $author->updateAuthor($request->validated());
        return response()->json($updatedAuthor, 200);
    }

    /**
     * @OA\Delete(
     *     path="/api/v1/authors/{id}",
     *     summary="Удалить автора",
     *     tags={"Authors"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID автора",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Автор удален"
     *     ),
     *     @OA\Response(response=404, description="Автор не найден")
     *
     * )
     */
    public function destroy($id)
    {
        try {
            $author = Author::findOrFail($id);
            $author->deleteAuthor();
            return response()->json(null, 204);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Author not found'], 404);
        }
    }
}
