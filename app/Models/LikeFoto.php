<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Likefoto extends Model
{
    use HasFactory;

    protected $table = 'likefotos'; // Nama tabel sesuai SQL
    protected $primaryKey = 'likeID'; // Primary key sesuai SQL

    protected $fillable = [
        'fotoID',
        'userID',
        'tanggalLike'
    ];

    // Relasi: Like ini dilakukan oleh siapa
    public function user()
    {
        return $this->belongsTo(User::class, 'userID', 'userID');
    }

    // Relasi: Like ini diberikan untuk foto mana
    public function foto()
    {
        return $this->belongsTo(Foto::class, 'fotoID', 'fotoID');
    }
}