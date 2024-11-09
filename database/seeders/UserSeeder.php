<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public function run()
    {
        \App\Models\User::create([
            'name' => 'Александр Иванов',
            'email' => 'alexander@example.com',

            'password' => bcrypt('password123'),

        ]);

        \App\Models\User::create([
            'name' => 'Мария Смирнова',
            'email' => 'maria@example.com',

            'password' => bcrypt('password123'),

        ]);

        \App\Models\User::create([
            'name' => 'Дмитрий Орлов',
            'email' => 'dmitry@example.com',

            'password' => bcrypt('password123'),

        ]);

        \App\Models\User::create([
            'name' => 'Елена Кузнецова',
            'email' => 'elena@example.com',

            'password' => bcrypt('password123'),

        ]);

        \App\Models\User::create([
            'name' => 'Иван Петров',
            'email' => 'ivan@example.com',
            'password' => bcrypt('password123'),
        ]);
    }
}
