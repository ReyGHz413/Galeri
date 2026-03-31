<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Komentarfoto extends Model
{
    use HasFactory;

    protected $table = 'komentarfotos'; // Nama tabel sesuai SQL
    protected $primaryKey = 'komentarID'; // Primary key sesuai SQL

    protected $fillable = [
        'fotoID',
        'userID',
        'isiKomentar',
        'tanggalKomentar'
    ];

    // Relasi: Komentar ini milik siapa (User)
    public function user()
    {
        return $this->belongsTo(User::class, 'userID', 'userID');
    }

    // Relasi: Komentar ini ada di foto mana
    public function foto()
    {
        return $this->belongsTo(Foto::class, 'fotoID', 'fotoID');
    }
}