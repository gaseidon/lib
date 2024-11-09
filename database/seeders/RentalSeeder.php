<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Rental;
use Carbon\Carbon;

class RentalSeeder extends Seeder
{
    public function run()
    {
        \App\Models\Rental::create([
            'user_id' => 1, // Предположим, что пользователь с ID 1
            'book_id' => 1, // Книга с ID 1 - "1984"
            'rented_at' => Carbon::now(),
            'due_date' => Carbon::now()->addDays(1),
        ]);

        \App\Models\Rental::create([
            'user_id' => 2, // Пользователь 2
            'book_id' => 2, // Книга 2 - "Война и мир"
            'rented_at' => Carbon::now(),
            'due_date' => Carbon::now()->addDays(30),
        ]);

        \App\Models\Rental::create([
            'user_id' => 3,
            'book_id' => 3,
            'rented_at' => Carbon::now(),
            'due_date' => Carbon::now()->addDays(1),
        ]);

        \App\Models\Rental::create([
            'user_id' => 4,
            'book_id' => 4,
            'rented_at' => Carbon::now(),
            'due_date' => Carbon::now()->addDays(21),
        ]);

        \App\Models\Rental::create([
            'user_id' => 5,
            'book_id' => 5,
            'rented_at' => Carbon::now(),
            'due_date' => Carbon::now()->addDays(1),
        ]);
    }
}
