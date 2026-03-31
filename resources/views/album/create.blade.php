<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Album Baru - Galeri Pro</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-slate-50 min-h-screen flex flex-col">

    <nav class="max-w-7xl mx-auto w-full px-6 py-8 flex justify-between items-center">
        <a href="{{ route('album.index') }}" class="text-slate-400 hover:text-slate-900 transition flex items-center gap-2 group font-black text-[10px] uppercase tracking-[0.3em]">
            <i class="fas fa-arrow-left group-hover:-translate-x-1 transition"></i> Kembali ke Koleksi
        </a>
        <div class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center shadow-sm border border-slate-100">
            <i class="fas fa-folder-plus text-blue-600"></i>
        </div>
    </nav>

    <main class="flex-1 flex items-center justify-center p-6">
        <div class="max-w-xl w-full">
            <div class="bg-white rounded-[3.5rem] p-10 md:p-14 shadow-2xl shadow-slate-200/50 border border-slate-100 relative overflow-hidden">
                
                <div class="absolute top-0 right-0 w-32 h-32 bg-blue-50 rounded-bl-[5rem] -mr-16 -mt-16 transition-transform hover:scale-110"></div>

                <header class="relative mb-12">
                    <span class="text-[10px] font-black text-blue-600 uppercase tracking-[0.4em] mb-3 block">New Folder</span>
                    <h2 class="text-5xl font-black text-slate-900 tracking-tighter leading-none italic">
                        BUAT <span class="text-blue-600">ALBUM</span>
                    </h2>
                    <p class="text-slate-400 mt-4 font-medium leading-relaxed">
                        Arsip digital untuk menyimpan kenangan visual Anda secara terorganisir.
                    </p>
                </header>

                <form action="{{ route('album.store') }}" method="POST" class="space-y-8 relative">
                    @csrf
                    
                    <div class="group">
                        <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 mb-3 ml-1 group-focus-within:text-blue-600 transition">
                            Judul Koleksi
                        </label>
                        <input type="text" name="namaAlbum" 
                               class="w-full px-8 py-5 bg-slate-50 border-2 border-transparent focus:border-blue-500 focus:bg-white rounded-[2rem] outline-none font-bold text-slate-700 transition-all placeholder:text-slate-300 shadow-inner" 
                               placeholder="Contoh: Perjalanan Musim Panas" required>
                    </div>

                    <div class="group">
                        <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 mb-3 ml-1 group-focus-within:text-blue-600 transition">
                            Narasi Singkat
                        </label>
                        <textarea name="deskripsi" rows="4" 
                                  class="w-full px-8 py-5 bg-slate-50 border-2 border-transparent focus:border-blue-500 focus:bg-white rounded-[2rem] outline-none font-medium text-slate-600 transition-all placeholder:text-slate-300 shadow-inner resize-none" 
                                  placeholder="Ceritakan sedikit tentang apa yang ada di dalam album ini..." required></textarea>
                    </div>

                    <div class="flex flex-col sm:flex-row gap-4 pt-6">
                        <button type="submit" 
                                class="flex-[2] bg-slate-900 text-white py-5 rounded-[1.5rem] font-black text-xs uppercase tracking-[0.2em] hover:bg-blue-600 transition-all shadow-xl shadow-slate-200 active:scale-95 flex items-center justify-center gap-3">
                            Simpan Koleksi <i class="fas fa-check text-[10px]"></i>
                        </button>
                        <a href="{{ route('album.index') }}" 
                           class="flex-1 bg-slate-100 text-slate-500 py-5 rounded-[1.5rem] font-black text-xs uppercase tracking-[0.2em] text-center hover:bg-red-50 hover:text-red-500 transition-all">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
            
            <p class="mt-10 text-center text-[10px] font-black text-slate-300 uppercase tracking-[0.4em]">
                System Ready &bull; Storage Secured
            </p>
        </div>
    </main>

</body>
</html>