<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'author_id', 'published_at'];

    // Связь "многие-к-одному" с автором
    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    // Связь "один-ко-многим" с арендой
    public function rentals()
    {
        return $this->hasMany(Rental::class);
    }

    // Получение всех книг с авторами
    public static function getAllBooksWithAuthors()
    {
        return self::with('author')->get();
    }


    public static function createBook($data)
    {
        return self::create($data);
    }


    public function updateBook($data)
    {
        $this->update($data);
        return $this;
    }


    public function deleteBook()
    {
        return $this->delete();
    }
}
