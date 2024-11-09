<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;

class BookSeeder extends Seeder
{
    public function run()
    {
        \App\Models\Book::create([
            'title' => '1984',
            'author_id' => 1, // Джордж Оруэлл
            'published_at' => '1949-06-08',

        ]);

        \App\Models\Book::create([
            'title' => 'Война и мир',
            'author_id' => 2, // Лев Толстой
            'published_at' => '1869-01-01',

        ]);

        \App\Models\Book::create([
            'title' => 'Преступление и наказание',
            'author_id' => 3, // Фёдор Достоевский
            'published_at' => '1866-01-01',

        ]);

        \App\Models\Book::create([
            'title' => 'Гордость и предубеждение',
            'author_id' => 4, // Джейн Остин
            'published_at' => '1813-01-28',
        ]);

        \App\Models\Book::create([
            'title' => 'Гарри Поттер и философский камень',
            'author_id' => 5, // Дж. К. Роулинг
            'published_at' => '1997-06-26',
        ]);
    }
}
