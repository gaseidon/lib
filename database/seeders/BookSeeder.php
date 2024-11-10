<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Author;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    public function run()
    {
        Book::create([
            'title' => '1984',
            'author_id' => Author::where('name', 'Джордж Оруэлл')->first()->id, // Джордж Оруэлл
            'published_at' => '1949-06-08',

        ]);

        Book::create([
            'title' => 'Война и мир',
            'author_id' => Author::where('name', 'Лев Толстой')->first()->id, // Лев Толстой
            'published_at' => '1869-01-01',

        ]);

        Book::create([
            'title' => 'Преступление и наказание',
            'author_id' => Author::where('name', 'Фёдор Достоевский')->first()->id, // Фёдор Достоевский
            'published_at' => '1866-01-01',

        ]);

        Book::create([
            'title' => 'Гордость и предубеждение',
            'author_id' => Author::where('name', 'Джейн Остин')->first()->id, // Джейн Остин
            'published_at' => '1813-01-28',
        ]);

        Book::create([
            'title' => 'Гарри Поттер и философский камень',
            'author_id' => Author::where('name', 'Гарри Поттер')->first()->id,
            'published_at' => '1997-06-26',
        ]);
    }
}
