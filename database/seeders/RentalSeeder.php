<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Book;
use App\Models\User;
use App\Models\Rental;
use Illuminate\Database\Seeder;

class RentalSeeder extends Seeder
{
    public function run()
    {
        \App\Models\Rental::create([
            'user_id' => User::where('name', 'Александр Иванов')->first()->id, // Предположим, что пользователь с ID 1
            'book_id' => Book::where('title', '1984')->first()->id, // Книга с ID 1 - "1984"
            'rented_at' => Carbon::now(),
            'due_date' => Carbon::now()->addDays(1),
        ]);

        \App\Models\Rental::create([
            'user_id' => User::where('name', 'Мария Смирнова')->first()->id, // Пользователь 2
            'book_id' => Book::where('title', 'Война и мир')->first()->id, // Книга 2 - "Война и мир"
            'rented_at' => Carbon::now(),
            'due_date' => Carbon::now()->addDays(30),
        ]);

        \App\Models\Rental::create([
            'user_id' => User::where('name', 'Дмитрий Орлов')->first()->id,
            'book_id' => Book::where('title', 'Преступление и наказание')->first()->id,
            'rented_at' => Carbon::now(),
            'due_date' => Carbon::now()->addDays(1),
        ]);

        \App\Models\Rental::create([
            'user_id' => User::where('name', 'Елена Кузнецова')->first()->id,
            'book_id' => Book::where('title', 'Гордость и предубеждение')->first()->id,
            'rented_at' => Carbon::now(),
            'due_date' => Carbon::now()->addDays(21),
        ]);

        \App\Models\Rental::create([
            'user_id' => User::where('name', 'Иван Петров')->first()->id,
            'book_id' => Book::where('title', 'Гарри Поттер и философский камень')->first()->id,
            'rented_at' => Carbon::now(),
            'due_date' => Carbon::now()->addDays(1),
        ]);
    }
}
