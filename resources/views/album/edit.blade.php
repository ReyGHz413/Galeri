<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Album - Galeri Pro</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-slate-50">
    <div class="max-w-2xl mx-auto py-16 px-4">
        <a href="{{ route('album.index') }}" class="inline-flex items-center gap-2 text-slate-400 hover:text-blue-600 font-bold mb-8 transition group">
            <i class="fas fa-arrow-left group-hover:-translate-x-1 transition"></i> Kembali ke Daftar Album
        </a>

        <div class="bg-white rounded-[2.5rem] p-10 shadow-xl shadow-slate-200/50 border border-slate-100">
            <div class="flex items-center gap-4 mb-8">
                <div class="w-14 h-14 bg-amber-100 rounded-2xl flex items-center justify-center text-amber-600 shadow-inner">
                    <i class="fas fa-edit text-2xl"></i>
                </div>
                <div>
                    <h2 class="text-3xl font-black text-slate-900 tracking-tight italic">Edit <span class="text-amber-500">Album</span></h2>
                    <p class="text-slate-400 font-medium">Perbarui informasi koleksi album Anda.</p>
                </div>
            </div>

            <form action="{{ route('album.update', $album->albumID) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 mb-2 ml-1">Nama Album</label>
                    <input type="text" name="namaAlbum" 
                           value="{{ old('namaAlbum', $album->namaAlbum) }}"
                           class="w-full px-6 py-4 bg-slate-50 border-2 border-transparent focus:border-amber-500 focus:bg-white rounded-2xl outline-none font-bold text-slate-700 transition-all" 
                           placeholder="Misal: Kenangan Sekolah">
                    @error('namaAlbum') <p class="text-red-500 text-xs mt-1 font-bold">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 mb-2 ml-1">Deskripsi Album</label>
                    <textarea name="deskripsi" rows="4" 
                              class="w-full px-6 py-4 bg-slate-50 border-2 border-transparent focus:border-amber-500 focus:bg-white rounded-2xl outline-none font-medium text-slate-600 transition-all" 
                              placeholder="Ceritakan tentang album ini...">{{ old('deskripsi', $album->deskripsi) }}</textarea>
                    @error('deskripsi') <p class="text-red-500 text-xs mt-1 font-bold">{{ $message }}</p> @enderror
                </div>

                <div class="flex flex-col sm:flex-row gap-4 pt-4">
                    <button type="submit" class="flex-1 bg-slate-900 text-white py-4 rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-amber-600 transition-all shadow-lg shadow-slate-200">
                        Simpan Perubahan
                    </button>
                    <a href="{{ route('album.index') }}" class="flex-1 bg-slate-100 text-slate-500 py-4 rounded-2xl font-black text-xs uppercase tracking-widest text-center hover:bg-slate-200 transition-all">
                        Batalkan
                    </a>
                </div>
            </form>
        </div>

        <div class="mt-8 p-6 bg-red-50 rounded-[2rem] border border-red-100 flex items-center justify-between">
            <div>
                <p class="text-red-800 font-bold text-sm">Zona Bahaya</p>
                <p class="text-red-400 text-xs">Menghapus album akan menghapus semua foto di dalamnya.</p>
            </div>
            <form action="{{ route('album.destroy', $album->albumID) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus album ini selamanya?')">
                @csrf @method('DELETE')
                <button type="submit" class="bg-white text-red-600 px-4 py-2 rounded-xl text-[10px] font-black uppercase tracking-widest shadow-sm hover:bg-red-600 hover:text-white transition-all">
                    Hapus Album
                </button>
            </form>
        </div>
    </div>
</body>
</html>