<?php

namespace App\Http\Controllers;

use App\Models\Komentarfoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class KomentarController extends Controller
{
    /**
     * Menyimpan komentar baru
     */
    public function store(Request $request)
    {
        $request->validate([
            // Memastikan foto yang dikomentari memang ada di database
            'fotoID' => 'required|exists:fotos,fotoID',
            'isiKomentar' => 'required|string|max:500'
        ]);

        Komentarfoto::create([
            'fotoID' => $request->fotoID,
            'userID' => Auth::id(), 
            'isiKomentar' => $request->isiKomentar,
            'tanggalKomentar' => Carbon::now()->toDateString(),
        ]);

        return redirect()->back()->with('success', 'Komentar berhasil dikirim!');
    }

    /**
     * Menghapus komentar (Fitur Moderasi Admin & User)
     */
    public function destroy($id)
    {
        // Cari komentar berdasarkan primary key komentarID
        $komentar = Komentarfoto::findOrFail($id);

        // LOGIKA MODERASI:
        // 1. Admin bisa menghapus komentar milik siapa pun (Moderasi Konten)
        // 2. User biasa hanya bisa menghapus komentarnya sendiri
        if (Auth::user()->role === 'admin' || Auth::id() === $komentar->userID) {
            $komentar->delete();
            
            $pesan = (Auth::user()->role === 'admin' && Auth::id() !== $komentar->userID) 
                     ? 'Komentar user telah dihapus oleh Admin.' 
                     : 'Komentar Anda telah dihapus.';

            return redirect()->back()->with('success', $pesan);
        }

        return redirect()->back()->with('error', 'Anda tidak memiliki otoritas untuk menghapus komentar ini.');
    }
}