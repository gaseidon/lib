<?php

namespace App\Jobs;

use App\Models\Rental;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class SendReturnReminderJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle()
    {
        $now = Carbon::now();
        $dueSoon = $now->copy()->addDay();

        $rentals = Rental::whereBetween('due_date', [$now, $dueSoon])
                          ->whereNull('returned_at')
                          ->get();

        foreach ($rentals as $rental) {
            Log::info("Напоминание: книга с ID {$rental->book_id} должна быть возвращена пользователем с ID {$rental->user_id} в течение следующих 24 часов.");
            // Отправка email или уведомление можно добавить здесь
        }
    }
}
