<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Http\Requests\BookRequest;  // Импортируем кастомный запрос
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class BookController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/v1/books",
     *     summary="Получить список всех книг с авторами",
     *     tags={"Books"},
     *     @OA\Response(
     *         response=200,
     *         description="Список книг с авторами",
     *         @OA\MediaType(
     *             mediaType="application/json"
     *         ),
     *     ),
     *     @OA\Response(response=500, description="Ошибка сервера")
     * )
     */
    public function index() {
        return Book::getAllBooksWithAuthors();
    }

    /**
     * @OA\Post(
     *     path="/api/v1/books",
     *     summary="Добавить новую книгу",
     *     tags={"Books"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"title", "author_id", "published_at"},
     *             @OA\Property(property="title", type="string", description="Название книги", example="Мастер и Маргарита"),
     *             @OA\Property(property="author_id", type="integer", description="ID автора", example=1),
     *
     *             @OA\Property(property="published_at", type="string", format="date", description="Дата публикации", example="2024-01-01")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Книга успешно добавлена",
     *         @OA\MediaType(
     *             mediaType="application/json"
     *         ),
     *     ),
     *     @OA\Response(response=400, description="Неверные данные запроса"),
     *  @OA\Response(response=422, description="Ошибка валидации")
     * )
     */
    public function store(BookRequest $request) {
        $validated = $request->validated();
        $book = Book::createBook($validated);
        return response()->json($book, 201);
    }

    /**
     * @OA\Get(
     *     path="/api/v1/books/{id}",
     *     summary="Получить информацию о книге",
     *     tags={"Books"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID книги",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Информация о книге",
     *         @OA\MediaType(
     *             mediaType="application/json"
     *         ),
     *     ),
     *     @OA\Response(response=404, description="Книга не найдена")
     * )
     */
    public function show($id) {
        try {
            $book = Book::findOrFail($id);
            return response()->json($book, 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Книга не найдена.'], 404);
        }
    }

    /**
     * @OA\Put(
     *     path="/api/v1/books/{id}",
     *     summary="Обновить информацию о книге",
     *     tags={"Books"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID книги",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"title", "author_id", "published_at"},
     *             @OA\Property(property="title", type="string", description="Название книги", example="Мастер и Маргарита"),
     *             @OA\Property(property="author_id", type="integer", description="ID автора", example=1),
     *
     *             @OA\Property(property="published_at", type="string", format="date", description="Дата публикации", example="2024-01-01")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Книга успешно обновлена",
     *         @OA\MediaType(
     *             mediaType="application/json"
     *         ),
     *     ),
     *     @OA\Response(response=400, description="Неверные данные запроса"),
     * @OA\Response(response=422, description="Ошибка валидации")
     * )
     */
    public function update(BookRequest $request, $id) {
        $validated = $request->validated();

        try {
            $book = Book::findOrFail($id);
            $updatedBook = $book->updateBook($validated);
            return response()->json($updatedBook, 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Книга не найдена.'], 404);
        }
    }

    /**
     * @OA\Delete(
     *     path="/api/v1/books/{id}",
     *     summary="Удалить книгу",
     *     tags={"Books"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID книги",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Книга удалена"
     *     ),
     *     @OA\Response(response=404, description="Книга не найдена")
     * )
     */
    public function destroy($id) {
        try {
            $book = Book::findOrFail($id);
            $book->deleteBook();
            return response()->json(null, 204);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Книга не найдена.'], 404);
        }
    }
}
