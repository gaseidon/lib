<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Author;

class AuthorSeeder extends Seeder
{
    public function run()
    {
        \App\Models\Author::create([
            'name' => 'Джордж Оруэлл',
            'bio' => 'Известный британский писатель, автор романов «1984» и «Скотный двор».',
        ]);

        \App\Models\Author::create([
            'name' => 'Лев Толстой',
            'bio' => 'Великий русский писатель, автор «Войны и мира» и «Анны Карениной».',
        ]);

        \App\Models\Author::create([
            'name' => 'Фёдор Достоевский',
            'bio' => 'Русский писатель, автор «Преступления и наказания» и «Братьев Карамазовых».',
        ]);

        \App\Models\Author::create([
            'name' => 'Джейн Остин',
            'bio' => 'Британская писательница, известная своими романами о любви и социальной сатире, включая «Гордость и предубеждение».',
        ]);

        \App\Models\Author::create([
            'name' => 'Гарри Поттер',
            'bio' => 'Вымышленный персонаж, герой серии романов Дж. К. Роулинг.',
        ]);
    }
}