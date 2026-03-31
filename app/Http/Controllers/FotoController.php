<?php

namespace App\Http\Controllers;

use App\Models\Foto;
use App\Models\Album;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class FotoController extends Controller
{
    public function index()
    {
        $fotos = Foto::with(['user', 'album', 'likefoto', 'komentarfoto'])->latest()->get();
        return view('foto.index', compact('fotos'));
    }

    public function show($id)
    {
        $foto = Foto::with(['user', 'album', 'komentarfoto.user', 'likefoto'])->findOrFail($id);
        return view('foto.show', compact('foto'));
    }

    public function create()
    {
        // Admin bisa lihat semua album, User cuma album miliknya sendiri
        $albums = (Auth::user()->role === 'admin') 
                    ? Album::orderBy('namaAlbum', 'asc')->get() 
                    : Album::where('userID', Auth::id())->orderBy('namaAlbum', 'asc')->get();
        
        return view('foto.create', compact('albums'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judulFoto'     => 'required|string|max:255',
            'deskripsiFoto' => 'required|string',
            'lokasiFile'    => 'required|image|mimes:jpeg,png,jpg,gif|max:5120', 
            'albumID'       => 'required|exists:albums,albumID', // SEKARANG REQUIRED BOS!
        ], [
            'albumID.required' => 'Wajib pilih album dulu bos, jangan dikosongin!',
        ]);

        if ($request->hasFile('lokasiFile')) {
            $file = $request->file('lokasiFile');
            $namaFile = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
            
            $file->storeAs('foto', $namaFile, 'public');

            Foto::create([
                'judulFoto'     => $request->judulFoto,
                'deskripsiFoto' => $request->deskripsiFoto,
                'tanggalUnggah' => now(),
                'lokasiFile'    => $namaFile,
                'userID'        => Auth::id(),
                'albumID'       => $request->albumID,
            ]);

            return redirect()->route('user.dashboard')->with('success', 'Foto kerenmu berhasil diunggah!');
        }

        return back()->with('error', 'Gagal mengunggah file.');
    }

    public function edit($id)
    {
        $foto = Foto::findOrFail($id);
        
        // Proteksi: HANYA ADMIN yang boleh edit (User biasa diblokir)
        if (Auth::user()->role !== 'admin') {
            abort(403, 'User biasa dilarang edit, hanya boleh upload!');
        }

        $albums = Album::all(); 
        return view('foto.edit', compact('foto', 'albums'));
    }

    public function update(Request $request, $id)
    {
        $foto = Foto::findOrFail($id);
        
        // Proteksi: HANYA ADMIN yang boleh update
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        $request->validate([
            'judulFoto'     => 'required|string|max:255',
            'deskripsiFoto' => 'required|string',
            'albumID'       => 'required|exists:albums,albumID',
            'lokasiFile'    => 'nullable|image|mimes:jpeg,png,jpg|max:5120'
        ]);

        $data = [
            'judulFoto'     => $request->judulFoto,
            'deskripsiFoto' => $request->deskripsiFoto,
            'albumID'       => $request->albumID,
        ];

        if ($request->hasFile('lokasiFile')) {
            if ($foto->lokasiFile && Storage::disk('public')->exists('foto/' . $foto->lokasiFile)) {
                Storage::disk('public')->delete('foto/' . $foto->lokasiFile);
            }
            
            $file = $request->file('lokasiFile');
            $namaFile = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
            $file->storeAs('foto', $namaFile, 'public');
            $data['lokasiFile'] = $namaFile;
        }

        $foto->update($data);

        return redirect()->route('admin.dashboard')->with('success', 'Data foto berhasil diperbarui oleh Admin!');
    }

    public function destroy($id)
    {
        $foto = Foto::findOrFail($id);
        
        // Proteksi: HANYA ADMIN yang boleh hapus
        if (Auth::user()->role !== 'admin') {
            return back()->with('error', 'Waduh, user dilarang hapus foto! Hubungi admin ya.');
        }

        if ($foto->lokasiFile && Storage::disk('public')->exists('foto/' . $foto->lokasiFile)) {
            Storage::disk('public')->delete('foto/' . $foto->lokasiFile);
        }
        
        $foto->delete();
        return back()->with('success', 'Foto berhasil dihapus oleh Admin!');
    }
}