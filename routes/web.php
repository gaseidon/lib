<?php

use Carbon\Carbon;
use App\Models\Rental;
use App\Jobs\SendReturnReminderJob;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;
Route::get('/', function () {
    return view('welcome');
});


Route::get('/test-reminder-job', function () {
    // Log::info("хахахахаха");
    // $now = Carbon::now();
    //     $dueSoon = $now->copy()->addDay();

    //     $rentals = Rental::whereBetween('due_date', [$now, $dueSoon])
    //                       ->whereNull('returned_at')
    //                       ->get();
    // print_r(Carbon::now());
    // exit;
    // Если надо, можно добавить аренду, у которой срок сдачи меньше 24 часов для проверки, просто раскоментировать
    $rental = Rental::create([
        'user_id' => 1,       // Замените на существующий user_id
        'book_id' => 1,       // Замените на существующий book_id
        'rented_at' => "2024-11-09 00:00:00",
        'due_date' => "2024-11-09 00:10:00",  // Срок истекает через 5 часов
        'returned_at' => null,
    ]);

    dispatch(new SendReturnReminderJob());

    return "Задание выполнено, проверьте лог для уведомления.";
});
