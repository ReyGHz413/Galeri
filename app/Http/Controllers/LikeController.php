<?php

namespace App\Http\Controllers;

use App\Models\Likefoto;
use App\Models\Foto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class LikeController extends Controller
{
    // Fungsi untuk Like/Unlike (Toggle)
    public function toggleLike($fotoID)
    {
        $userID = Auth::id();
        
        // Cek apakah user sudah pernah like foto ini
        $existingLike = Likefoto::where('fotoID', $fotoID)
                                ->where('userID', $userID)
                                ->first();

        if ($existingLike) {
            // Jika sudah ada, maka Unlike (hapus)
            $existingLike->delete();
            return redirect()->back()->with('success', 'Batal menyukai foto.');
        } else {
            // Jika belum ada, maka Like (tambah)
            Likefoto::create([
                'fotoID' => $fotoID,
                'userID' => $userID,
                'tanggalLike' => Carbon::now()->toDateString(),
            ]);
            return redirect()->back()->with('success', 'Foto disukai!');
        }
    }

    // Menampilkan daftar foto yang di-like oleh user yang sedang login
    public function index()
    {
        $likes = Likefoto::with('foto.user')
                ->where('userID', Auth::id())
                ->latest()
                ->get();
                
        return view('like.index', compact('likes'));
    }
}