<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }


     public function rentedBooks()
     {
         return $this->belongsToMany(Book::class, 'rentals')
                     ->withPivot('rented_at', 'due_date', 'returned_at')
                     ->withTimestamps();
     }

     public static function getUserWithRentedBooks($userId)
     {
         return self::with('rentedBooks')->findOrFail($userId);
     }

     public static function getAllUsers()
     {
         return self::all();
     }


     public static function createUser(array $data)
     {

         if (isset($data['password'])) {
             $data['password'] = Hash::make($data['password']);
         }

         return self::create($data);
     }


     public function updateUser(array $data)
     {


         if (isset($data['password'])) {
             $data['password'] = Hash::make($data['password']);
         }

         $this->update($data);
         return $this;
     }


     public function deleteUser()
     {
         $this->delete();
         return $this;
     }
}
