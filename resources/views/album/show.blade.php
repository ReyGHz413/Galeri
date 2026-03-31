<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $album->namaAlbum }} - Galeri Pro</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-slate-50 min-h-screen">

    <nav class="bg-white/80 backdrop-blur-md sticky top-0 z-50 border-b border-slate-100">
        <div class="max-w-7xl mx-auto px-6 h-20 flex justify-between items-center">
            <a href="{{ route('album.index') }}" class="flex items-center gap-3 text-slate-600 hover:text-blue-600 font-black text-sm uppercase tracking-widest transition group">
                <i class="fas fa-chevron-left text-xs group-hover:-translate-x-1 transition"></i> Kembali
            </a>
            <div class="flex items-center gap-4">
                <span class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] hidden sm:block">Koleksi Album</span>
                <div class="w-10 h-10 bg-blue-600 rounded-xl flex items-center justify-center text-white shadow-lg shadow-blue-100">
                    <i class="fas fa-images"></i>
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-6 py-12">
        <div class="relative mb-16">
            <div class="absolute -left-4 top-0 w-1 h-24 bg-blue-600 rounded-full"></div>
            <span class="text-[10px] font-black text-blue-500 uppercase tracking-[0.4em] mb-3 block">Digital Archive</span>
            <h2 class="text-6xl font-black text-slate-900 tracking-tighter leading-none italic uppercase">
                {{ $album->namaAlbum }}
            </h2>
            <div class="flex flex-col md:flex-row md:items-center gap-6 mt-6">
                <p class="text-slate-500 max-w-2xl font-medium leading-relaxed border-l border-slate-200 pl-6">
                    {{ $album->deskripsi }}
                </p>
                <div class="flex-shrink-0 bg-white px-6 py-4 rounded-3xl border border-slate-100 shadow-sm">
                    <span class="block text-[10px] font-black text-slate-400 uppercase tracking-widest">Total Konten</span>
                    <span class="text-2xl font-black text-slate-900 italic">{{ $album->foto->count() }} <small class="text-sm font-bold uppercase text-blue-600">Foto</small></span>
                </div>
            </div>
        </div>

        @if($album->foto->isEmpty())
            <div class="bg-white rounded-[4rem] py-32 text-center border-4 border-dashed border-slate-100 flex flex-col items-center">
                <div class="w-24 h-24 bg-slate-50 rounded-full flex items-center justify-center mb-6">
                    <i class="far fa-image text-4xl text-slate-200"></i>
                </div>
                <p class="text-slate-400 font-black uppercase tracking-widest text-xs">Album ini masih kosong melompong bos.</p>
                <a href="{{ route('foto.create') }}" class="mt-8 bg-slate-900 text-white px-10 py-4 rounded-2xl font-black text-xs uppercase tracking-[0.2em] hover:bg-blue-600 transition-all shadow-xl shadow-slate-200 active:scale-95">
                    Isi Foto Sekarang
                </a>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach($album->foto as $f)
                    <div class="group relative aspect-[4/5] overflow-hidden rounded-[2.5rem] bg-white p-3 shadow-sm hover:shadow-2xl hover:shadow-blue-100 transition-all duration-500 border border-slate-100">
                        <div class="w-full h-full overflow-hidden rounded-[2rem] relative">
                            <img src="{{ asset('storage/foto/' . $f->lokasiFile) }}" 
                                 class="w-full h-full object-cover transition duration-1000 group-hover:scale-110 group-hover:rotate-1">
                            
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-slate-900/20 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-500 p-8 flex flex-col justify-end">
                                <span class="text-blue-400 text-[10px] font-black uppercase tracking-widest mb-2 transform translate-y-4 group-hover:translate-y-0 transition duration-500 delay-75">
                                    {{ \Carbon\Carbon::parse($f->tanggalUnggah)->translatedFormat('d M Y') }}
                                </span>
                                <h3 class="text-white font-black text-xl uppercase tracking-tighter transform translate-y-4 group-hover:translate-y-0 transition duration-500 delay-100">
                                    {{ $f->judulFoto }}
                                </h3>
                                <a href="{{ route('foto.show', $f->fotoID) }}" class="mt-4 bg-white/20 backdrop-blur-md text-white text-center py-3 rounded-xl font-black text-[10px] uppercase tracking-widest hover:bg-white hover:text-slate-900 transition-all transform translate-y-4 group-hover:translate-y-0 transition duration-500 delay-150">
                                    Detail Visual <i class="fas fa-arrow-right ml-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </main>

    <footer class="py-12 text-center">
        <p class="text-[10px] font-black text-slate-300 uppercase tracking-[0.5em]">Galeri Pro &bull; Archive System &bull; 2026</p>
    </footer>

</body>
</html>