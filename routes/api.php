<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\RentalController;
use App\Http\Controllers\UserController;

Route::prefix('v1')->group(function () {
    // **Ресурсы для пользователей**
    Route::resource('users', UserController::class);

    // **Ресурсы для книг**
    Route::resource('books', BookController::class);

    // **Ресурсы для авторов**
    Route::resource('authors', AuthorController::class);

    // **Ресурсы для аренды**
    Route::resource('rentals', RentalController::class)->only(['index']);

    Route::post('rentals', [RentalController::class, 'rentBook']); // Арендовать книгу

    Route::post('rentals/{id}/return', [RentalController::class, 'returnBook']); // Вернуть книгу


});

Route::get('/', function (){
    return response()->json([
        'message' => 'Welcome to laravel api'
    ]);
});
