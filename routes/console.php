<?php

use App\Jobs\SendReturnReminderJob;
use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();



// Route::console(function () {
//     // Выполнение задачи с задержкой
//     SendReturnReminderJob::dispatch();
//     Log::info('Запланирована задача для отправки напоминания о возврате книги.');
// });
