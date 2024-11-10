<?php

use Carbon\Carbon;
use App\Models\Rental;
use App\Jobs\SendReturnReminderJob;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
Route::get('/', function () {
    return view('welcome');
});

Route::get('/test-reminder-job', JobController::class);
