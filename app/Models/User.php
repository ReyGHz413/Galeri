<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Nama Primary Key sesuai dengan file SQL: userID
     */
    protected $primaryKey = 'userID';

    /**
     * Atribut yang dapat diisi (Mass Assignable) sesuai kolom di tabel users
     */
    protected $fillable = [
        'username', 
        'password', 
        'email', 
        'nama_lengkap', 
        'alamat', 
        'role'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    // --- RELATIONSHIPS ---

    /**
     * Relasi: Satu user bisa memiliki banyak album
     */
    public function albums()
    {
        return $this->hasMany(Album::class, 'userID', 'userID');
    }

    /**
     * Relasi: Satu user bisa mengunggah banyak foto
     */
    public function fotos()
    {
        return $this->hasMany(Foto::class, 'userID', 'userID');
    }

    /**
     * Relasi: Satu user bisa memberikan banyak komentar
     */
    public function komentarfoto()
    {
        return $this->hasMany(Komentarfoto::class, 'userID', 'userID');
    }

    /**
     * Relasi: Satu user bisa memberikan banyak like
     */
    public function likefoto()
    {
        return $this->hasMany(Likefoto::class, 'userID', 'userID');
    }

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
}
