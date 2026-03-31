<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Album extends Model
{
    use HasFactory;

    protected $table = 'albums'; 
    protected $primaryKey = 'albumID'; 
    public $timestamps = false; // Tambahkan ini jika tabel bos tidak punya kolom created_at/updated_at

    protected $fillable = [
        'namaAlbum',
        'deskripsi',
        'tanggalDibuat',
        'userID'
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class, 'userID', 'userID');
    }

    // Relasi ke Foto
    // Saya sarankan pakai nama 'foto' (tanpa s) agar sinkron dengan withCount('foto') di controller bos
    public function foto()
    {
        return $this->hasMany(Foto::class, 'albumID', 'albumID');
    }
}