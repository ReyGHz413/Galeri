<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Album Saya - Galeri Pro</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-slate-50">
    <div class="max-w-6xl mx-auto px-4 py-10">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10 gap-4">
            <div>
                <a href="{{ Auth::user()->role == 'admin' ? route('admin.dashboard') : route('user.dashboard') }}" 
                   class="text-blue-600 font-black text-[10px] uppercase tracking-[0.2em] mb-4 inline-flex items-center group hover:text-blue-800 transition-all">
                    <i class="fas fa-arrow-left mr-2 group-hover:-translate-x-1 transition-transform"></i> 
                    Kembali ke {{ Auth::user()->role == 'admin' ? 'Admin Dashboard' : 'Dashboard Utama' }}
                </a>
                
                <h1 class="text-4xl font-black text-slate-800 tracking-tight">Koleksi <span class="text-blue-600 italic underline decoration-blue-100 decoration-8 underline-offset-8">Album</span></h1>
                <p class="text-slate-400 text-xs font-bold uppercase tracking-widest mt-4 ml-1">Kelola folder foto pribadi Anda di sini.</p>
            </div>
            
            <button onclick="document.getElementById('modalAlbum').classList.remove('hidden')" 
                class="bg-blue-600 text-white px-8 py-4 rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-blue-700 transition shadow-xl shadow-blue-200 group flex items-center">
                <i class="fas fa-plus mr-3 group-hover:rotate-90 transition-transform"></i> Buat Album Baru
            </button>
        </div>

        @if(session('success'))
            <div class="mb-8 p-5 bg-emerald-500 text-white rounded-2xl font-black text-xs uppercase tracking-widest flex items-center shadow-lg shadow-emerald-100">
                <i class="fas fa-check-circle text-lg mr-3"></i> {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($albums as $album)
            <div class="bg-white p-8 rounded-[3rem] border border-slate-100 shadow-sm hover:shadow-2xl hover:shadow-blue-100 transition-all duration-500 group relative overflow-hidden">
                <div class="w-16 h-16 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center text-2xl mb-6 group-hover:bg-blue-600 group-hover:text-white transition-all duration-500 rotate-3 group-hover:rotate-0 shadow-inner">
                    <i class="fas fa-folder-open"></i>
                </div>

                <div class="absolute top-8 right-8 flex gap-2">
                    <a href="{{ route('album.edit', $album->albumID) }}" class="w-10 h-10 bg-slate-50 text-slate-400 hover:bg-amber-100 hover:text-amber-600 rounded-xl flex items-center justify-center transition-all">
                        <i class="fas fa-pen text-[10px]"></i>
                    </a>
                    <form action="{{ route('album.destroy', $album->albumID) }}" method="POST" onsubmit="return confirm('Hapus album dan semua foto di dalamnya?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="w-10 h-10 bg-slate-50 text-slate-400 hover:bg-red-100 hover:text-red-600 rounded-xl flex items-center justify-center transition-all">
                            <i class="fas fa-trash text-[10px]"></i>
                        </button>
                    </form>
                </div>

                <h3 class="text-2xl font-black text-slate-800 mb-2 truncate pr-16 tracking-tighter">{{ $album->namaAlbum }}</h3>
                <p class="text-slate-400 text-xs mb-8 line-clamp-2 font-bold uppercase tracking-wide leading-relaxed">{{ $album->deskripsi }}</p>
                
                <div class="flex justify-between items-center pt-6 border-t border-slate-50">
                    <div class="flex flex-col">
                        <span class="text-[9px] font-black text-slate-300 uppercase tracking-[0.2em]">Isi Album</span>
                        <span class="text-sm font-black text-slate-800">{{ $album->foto_count ?? $album->foto()->count() }} Media</span>
                    </div>
                    <a href="{{ route('album.show', $album->albumID) }}" class="bg-slate-900 text-white px-6 py-3 rounded-xl font-black text-[10px] uppercase tracking-widest hover:bg-blue-600 transition-all shadow-lg shadow-slate-200">
                        Buka Folder
                    </a>
                </div>
            </div>
            @empty
            <div class="col-span-full py-20 text-center">
                <div class="bg-slate-100 w-24 h-24 rounded-[2rem] flex items-center justify-center mx-auto mb-6 rotate-12 shadow-inner">
                    <i class="fas fa-folder-plus text-slate-300 text-4xl"></i>
                </div>
                <h3 class="text-slate-800 font-black text-2xl tracking-tighter uppercase">Belum ada album</h3>
                <p class="text-slate-400 text-xs font-bold uppercase tracking-widest mt-2">Mulai buat folder pertama Anda sekarang.</p>
            </div>
            @endforelse
        </div>
    </div>

    <div id="modalAlbum" class="hidden fixed inset-0 bg-slate-900/80 backdrop-blur-md z-50 flex items-center justify-center p-4">
        <div class="bg-white w-full max-w-md rounded-[3rem] p-10 shadow-2xl animate-in fade-in zoom-in duration-300">
            <div class="text-center mb-8">
                <div class="w-16 h-16 bg-blue-600 text-white rounded-2xl flex items-center justify-center text-2xl mx-auto mb-4 shadow-xl shadow-blue-100">
                    <i class="fas fa-folder-plus"></i>
                </div>
                <h2 class="text-3xl font-black text-slate-800 tracking-tight uppercase italic">New <span class="text-blue-600">Album</span></h2>
                <p class="text-slate-400 text-[10px] font-black uppercase tracking-[0.2em] mt-2">Isi detail untuk album baru Anda.</p>
            </div>

            <form action="{{ route('album.store') }}" method="POST">
                @csrf
                <div class="space-y-6">
                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2 ml-1">Judul Album</label>
                        <input type="text" name="namaAlbum" class="w-full px-6 py-4 bg-slate-50 border-2 border-transparent focus:border-blue-600 focus:bg-white rounded-2xl outline-none font-black text-slate-700 transition-all placeholder:text-slate-300" placeholder="Contoh: Portofolio 2026" required>
                    </div>
                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2 ml-1">Keterangan Singkat</label>
                        <textarea name="deskripsi" class="w-full px-6 py-4 bg-slate-50 border-2 border-transparent focus:border-blue-600 focus:bg-white rounded-2xl outline-none font-bold text-slate-600 transition-all placeholder:text-slate-300" rows="3" placeholder="Ceritakan isi album ini..." required></textarea>
                    </div>
                </div>
                
                <div class="flex flex-col gap-4 mt-10">
                    <button type="submit" class="w-full py-5 bg-blue-600 text-white font-black text-xs uppercase tracking-[0.3em] rounded-2xl hover:bg-blue-700 shadow-xl shadow-blue-100 transition-all">
                        Simpan Album
                    </button>
                    <button type="button" onclick="document.getElementById('modalAlbum').classList.add('hidden')" class="w-full py-2 font-black text-[10px] uppercase tracking-widest text-slate-400 hover:text-red-500 transition-colors">
                        Batalkan Proses
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>