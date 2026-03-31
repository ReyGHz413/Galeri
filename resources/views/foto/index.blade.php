<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Explore Galeri - Galeri Pro</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-slate-50">
    <nav class="bg-white/80 backdrop-blur-md shadow-sm border-b sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 h-16 flex justify-between items-center">
            <a href="{{ Auth::user()->role === 'admin' ? route('admin.dashboard') : route('user.dashboard') }}" 
               class="flex items-center gap-2 text-slate-600 hover:text-blue-600 font-bold transition">
                <i class="fas fa-arrow-left"></i> 
                <span class="hidden sm:inline text-sm uppercase tracking-wider">Dashboard</span>
            </a>
            
            <div class="flex items-center gap-2">
                <i class="fas fa-compass text-blue-600 animate-pulse"></i>
                <h1 class="text-xl font-black text-slate-800 uppercase tracking-tighter italic">Explore<span class="text-blue-600">Feed</span></h1>
            </div>

            <div class="flex items-center gap-3">
                <div class="text-right hidden sm:block">
                    <p class="text-[9px] font-black text-blue-500 uppercase leading-none tracking-widest">{{ Auth::user()->role }}</p>
                    <p class="text-sm font-bold text-slate-700">{{ Auth::user()->username }}</p>
                </div>
                <div class="w-10 h-10 bg-blue-600 rounded-2xl rotate-3 flex items-center justify-center text-white font-bold shadow-lg shadow-blue-200 uppercase transition hover:rotate-0 cursor-pointer">
                    {{ substr(Auth::user()->username, 0, 1) }}
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 py-10">
        @if(session('success'))
            <div class="mb-8 p-4 bg-blue-600 text-white rounded-2xl shadow-xl shadow-blue-100 flex items-center animate-bounce">
                <i class="fas fa-check-circle mr-3"></i> 
                <span class="font-bold text-sm">{{ session('success') }}</span>
            </div>
        @endif

        <div class="flex flex-col md:flex-row justify-between items-end mb-12 gap-6">
            <div class="space-y-1">
                <h2 class="text-4xl font-black text-slate-900 tracking-tight italic uppercase">Karya Terkini</h2>
                <p class="text-slate-400 font-medium">Temukan inspirasi visual dari komunitas Galeri Pro.</p>
            </div>
            <div class="relative w-full md:w-96 group">
                <input type="text" placeholder="Cari judul atau creator..." 
                       class="w-full pl-12 pr-4 py-4 bg-white border-2 border-slate-100 rounded-3xl focus:border-blue-500 outline-none shadow-sm transition-all group-hover:shadow-md">
                <i class="fas fa-search absolute left-5 top-1/2 -translate-y-1/2 text-slate-300 group-focus-within:text-blue-500 transition"></i>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            @foreach($fotos as $foto)
            <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden group hover:shadow-2xl hover:shadow-slate-200/60 transition-all duration-500">
                
                <div class="relative h-72 overflow-hidden bg-slate-200">
                    <img src="{{ asset('storage/foto/' . $foto->lokasiFile) }}" 
                         class="w-full h-full object-cover transition duration-1000 group-hover:scale-110 group-hover:rotate-1">
                    
                     <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-center items-center gap-3">
                        <a href="{{ route('foto.show', $foto->fotoID) }}" 
                           class="bg-white px-6 py-3 rounded-2xl flex items-center gap-2 text-slate-900 font-black text-[10px] uppercase tracking-widest hover:bg-blue-600 hover:text-white transition-all duration-300 scale-75 group-hover:scale-100 shadow-xl">
                            <i class="fas fa-eye"></i> Detail Visual
                        </a>

                        @if(Auth::user()->role === 'admin')
                        <div class="flex gap-2 scale-75 group-hover:scale-100 transition-all duration-300 delay-75">
                            <a href="{{ route('foto.edit', $foto->fotoID) }}" class="w-10 h-10 bg-amber-500 rounded-xl flex items-center justify-center text-white hover:bg-amber-600 transition shadow-lg" title="Admin Edit">
                                <i class="fas fa-pen text-sm"></i>
                            </a>
                            <form action="{{ route('foto.destroy', $foto->fotoID) }}" method="POST" onsubmit="return confirm('Admin: Hapus foto ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="w-10 h-10 bg-red-500 rounded-xl flex items-center justify-center text-white hover:bg-red-600 transition shadow-lg" title="Admin Delete">
                                    <i class="fas fa-trash text-sm"></i>
                                </button>
                            </form>
                        </div>
                        @endif
                     </div>
                </div>

                <div class="p-6">
                    <div class="flex justify-between items-start mb-4">
                        <h3 class="font-black text-slate-800 text-lg truncate flex-1 leading-tight uppercase tracking-tighter">{{ $foto->judulFoto }}</h3>
                        <span class="text-[9px] bg-slate-100 text-slate-500 px-2 py-1 rounded-lg font-black uppercase tracking-tighter ml-2">
                             {{ \Carbon\Carbon::parse($foto->tanggalUnggah)->format('M d') }}
                        </span>
                    </div>
                    
                    <div class="flex items-center justify-between border-t border-slate-50 pt-5">
                        <div class="flex items-center gap-2">
                            <div class="w-8 h-8 bg-slate-900 rounded-full flex items-center justify-center text-[10px] font-bold text-white uppercase ring-4 ring-slate-50">
                                {{ substr($foto->user->username, 0, 1) }}
                            </div>
                            <span class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">
                                By <span class="text-slate-900">{{ $foto->user->username }}</span>
                            </span>
                        </div>
                        
                        <div class="flex gap-4 text-slate-400 font-black">
                            <form action="{{ route('like.toggle', $foto->fotoID) }}" method="POST">
                                @csrf
                                <button type="submit" class="flex items-center gap-1.5 transition-all group/like">
                                    <i class="{{ $foto->isLikedByAuth() ? 'fas text-pink-500 scale-110' : 'far hover:text-pink-500' }} fa-heart text-base"></i> 
                                    <span class="text-xs {{ $foto->isLikedByAuth() ? 'text-slate-900' : '' }}">
                                        {{ $foto->likefoto_count ?? $foto->likefoto()->count() }}
                                    </span>
                                </button>
                            </form>
                            
                            <a href="{{ route('foto.show', $foto->fotoID) }}" class="flex items-center gap-1.5 hover:text-blue-500 transition-all">
                                <i class="far fa-comment-alt text-base"></i> 
                                <span class="text-xs">
                                    {{ $foto->komentarfoto_count ?? $foto->komentarfoto()->count() }}
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        @if($fotos->isEmpty())
            <div class="text-center py-32 bg-white rounded-[4rem] border-4 border-dashed border-slate-100">
                <div class="bg-slate-50 w-24 h-24 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-mountain-sun text-4xl text-slate-200"></i>
                </div>
                <h3 class="text-2xl font-black text-slate-800 mb-2 italic">Belum ada karya nih...</h3>
                <p class="text-slate-400 font-medium">Jadilah yang pertama mengunggah momen indahmu!</p>
                <a href="{{ route('foto.create') }}" class="inline-block mt-8 bg-blue-600 text-white px-10 py-4 rounded-2xl font-bold hover:bg-blue-700 transition-all shadow-xl shadow-blue-100 uppercase tracking-widest text-xs">Unggah Sekarang</a>
            </div>
        @endif
    </main>

    <footer class="py-12 text-center">
        <p class="text-[10px] font-black text-slate-300 uppercase tracking-[0.5em]">Explore Feed &bull; Community Driven &bull; 2026</p>
    </footer>
</body>
</html>