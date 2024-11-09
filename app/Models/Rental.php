<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rental extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'book_id', 'rented_at', 'due_date', 'returned_at'];

    // Связь "многие-к-одному" с пользователем
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Связь "многие-к-одному" с книгой
    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    // Метод для аренды книги
    public static function rentBook($data)
    {
        // Создаем запись аренды
        $rental = self::create([
            'user_id' => $data['user_id'],
            'book_id' => $data['book_id'],
            'rented_at' => $data['rented_at'],
            'due_date' => $data['due_date'],
        ]);



        return $rental;
    }

    // Метод для возврата книги
    public function returnBook()
    {
        if ($this->returned_at) {
            return ['warning' => 'Книга уже была возвращена ранее'];
        }
        $this->update(['returned_at' => now()]);

        return $this;
    }

    // Получение всех записей аренды с информацией о пользователе и книге
    public static function getAllRentalsWithDetails()
    {
        return self::with(['user', 'book'])->get();
    }
}
