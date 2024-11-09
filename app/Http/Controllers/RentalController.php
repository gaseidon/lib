<?php

namespace App\Http\Controllers;

use App\Models\Rental;
use App\Http\Requests\RentalRequest;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class RentalController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/v1/rentals",
     *     summary="Получить список всех аренд с деталями",
     *     tags={"Rentals"},
     *     @OA\Response(
     *         response=200,
     *         description="Список всех аренд с деталями",
     *         @OA\MediaType(
     *             mediaType="application/json"
     *         ),
     *     ),
     *     @OA\Response(response=500, description="Ошибка сервера")
     * )
     */
    public function index()
    {
        return Rental::getAllRentalsWithDetails();
    }

    /**
     * @OA\Post(
     *     path="/api/v1/rentals",
     *     summary="Арендовать книгу",
     *     tags={"Rentals"},
     *     @OA\RequestBody(
     *         required=true,
     *         description="Данные для аренды книги",
     *         @OA\JsonContent(
     *             required={"book_id", "user_id", "rented_at", "due_date"},
     *             @OA\Property(property="book_id", type="integer", description="ID книги", example=1),
     *             @OA\Property(property="user_id", type="integer", description="ID пользователя",example=1),
     *             @OA\Property(property="rented_at", type="string", format="date", description="Дата аренды книги",example="2024-11-09 14:30:00"),
     * @OA\Property(property="due_date", type="string", format="date", description="Дата сдачи",example="2024-12-09 12:30:00"),
     *         ),
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Книга успешно арендована",
     *         @OA\MediaType(
     *             mediaType="application/json"
     *         ),
     *     ),
     *     @OA\Response(response=400, description="Неверные данные запроса"),
     *     @OA\Response(response=500, description="Ошибка при аренде книги"),
     * @OA\Response(response=422, description="Ошибка валидации")
     * )
     */
    public function rentBook(RentalRequest $request)
    {
        $validated = $request->validated();

        try {
            $rental = Rental::rentBook($validated);
            return response()->json($rental, 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Ошибка при аренде книги. Пожалуйста, попробуйте позже.'], 500);
        }
    }

    /**
     * @OA\Post(
     *     path="/api/v1/rentals/{id}/return",
     *     summary="Возвратить книгу",
     *     tags={"Rentals"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID аренды",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Книга успешно возвращена",
     *         @OA\MediaType(
     *             mediaType="application/json"
     *         ),
     *     ),
     *     @OA\Response(response=404, description="Аренда не найдена"),
     *     @OA\Response(response=500, description="Ошибка при возврате книги")
     * )
     */
    public function returnBook($id)
    {
        try {
            $rental = Rental::findOrFail($id);
            $returnedRental = $rental->returnBook();
            return response()->json($returnedRental, 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Аренда с таким ID не найдена.'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Ошибка при возврате книги. Пожалуйста, попробуйте позже.'], 500);
        }
    }
}
