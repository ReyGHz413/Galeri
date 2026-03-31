<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;

class Foto extends Model
{
    use HasFactory;

    protected $table = 'fotos';
    protected $primaryKey = 'fotoID';

    protected $fillable = [
        'judulFoto',
        'deskripsiFoto',
        'tanggalUnggah',
        'lokasiFile',
        'albumID',
        'userID'
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class, 'userID', 'userID');
    }

    // Relasi ke Album
    public function album()
    {
        return $this->belongsTo(Album::class, 'albumID', 'albumID');
    }

    // Relasi ke Komentar
    public function komentarfoto()
    {
        return $this->hasMany(Komentarfoto::class, 'fotoID', 'fotoID');
    }

    // Relasi ke Like
    public function likefoto()
    {
        return $this->hasMany(Likefoto::class, 'fotoID', 'fotoID');
    }

    // Helper untuk cek apakah user yang login sudah like foto ini
    public function isLikedByAuth()
    {
        return $this->likefoto()->where('userID', Auth::id())->exists();
    }
}