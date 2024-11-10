<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\SendReturnReminderJob;
use Exception;
use Carbon\Carbon;
use App\Models\Rental;

class JobController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {

        // Если надо, можно добавить аренду вручную, у которой срок сдачи меньше 24 часов для проверки, просто раскоментировать
        // $rental = Rental::create([
        //     'user_id' => 1,       // Замените на существующий user_id
        //     'book_id' => 1,       // Замените на существующий book_id
        //     'rented_at' => "2024-11-09 00:00:00",
        //     'due_date' => "2024-11-09 00:10:00",  // Срок истекает через 5 часов
        //     'returned_at' => null,
        // ]);

        $now = Carbon::now();
        $dueSoon = $now->copy()->addDay();

        $rentals = Rental::whereBetween('due_date', [$now, $dueSoon])
            ->whereNull('returned_at')
            ->get();

        if ($rentals->isNotEmpty()) {
            try {
                dispatch(new SendReturnReminderJob($rentals));
                return "Задание выполнено, проверьте лог для уведомления.";
            } catch (Exception $e) {
                return response()->json([
                    'error' => 'Произошла ошибка при выполнении задания: ' . $e->getMessage()
                ], 500);
            }
        } else {
            return "Нет аренды, требующей уведомления.";
        }
    }
}
