<?php

namespace App\Http\Controllers;

use App\Models\Album;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AlbumController extends Controller
{
    public function index()
    {
        // Jika Admin: Lihat semua album. Jika User: Lihat milik sendiri saja.
        $query = Album::withCount('foto')->with('user');

        if (Auth::user()->role !== 'admin') {
            $query->where('userID', Auth::id());
        }

        $albums = $query->latest()->get();

        return view('album.index', compact('albums'));
    }

    public function create()
    {
        return view('album.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'namaAlbum' => 'required|string|max:255',
            'deskripsi' => 'required|string',
        ]);

        Album::create([
            'namaAlbum'     => $request->namaAlbum,
            'deskripsi'     => $request->deskripsi,
            'tanggalDibuat' => now(), // Memastikan tanggal terisi otomatis
            'userID'        => Auth::id(),
        ]);

        return redirect()->route('album.index')->with('success', 'Album baru berhasil dibuat!');
    }

    public function show($id)
    {
        // Menampilkan isi foto di dalam album tersebut beserta pengunggahnya
        $album = Album::with(['foto.user', 'user'])->findOrFail($id);
        
        // Proteksi Akses: Hanya pemilik atau Admin yang bisa buka album ini
        if (Auth::user()->role !== 'admin' && $album->userID !== Auth::id()) {
            abort(403, 'Anda tidak memiliki akses ke album ini.');
        }

        return view('album.show', compact('album'));
    }

    public function edit($id)
    {
        $album = Album::findOrFail($id);

        // Pastikan yang edit adalah pemiliknya atau Admin
        if (Auth::user()->role !== 'admin' && $album->userID !== Auth::id()) {
            abort(403);
        }

        return view('album.edit', compact('album'));
    }

    public function update(Request $request, $id)
    {
        $album = Album::findOrFail($id);

        if (Auth::user()->role !== 'admin' && $album->userID !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'namaAlbum' => 'required|string|max:255',
            'deskripsi' => 'required|string',
        ]);

        $album->update([
            'namaAlbum' => $request->namaAlbum,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('album.index')->with('success', 'Perubahan album berhasil disimpan!');
    }

    public function destroy($id)
    {
        $album = Album::findOrFail($id);

        if (Auth::user()->role !== 'admin' && $album->userID !== Auth::id()) {
            abort(403);
        }

        $album->delete(); 
        // Catatan: Pastikan di Database (Migration/Foreign Key) sudah diset 'onDelete(cascade)'
        // agar data di tabel 'fotos' yang nyangkut di album ini ikut terhapus.

        return redirect()->route('album.index')->with('success', 'Album telah dihapus.');
    }
}