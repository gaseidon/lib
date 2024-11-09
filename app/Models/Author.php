<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Author extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'bio'];

    // Связь "один-ко-многим" с книгами
    public function books()
    {
        return $this->hasMany(Book::class);
    }


    public static function getAllAuthorsWithBooks()
    {
        return self::with('books')->get();
    }


    public static function createAuthor($data)
    {
        return self::create($data);
    }


    public function updateAuthor($data)
    {
        $this->update($data);
        return $this;
    }


    public function deleteAuthor()
    {
        return $this->delete();
    }
}
