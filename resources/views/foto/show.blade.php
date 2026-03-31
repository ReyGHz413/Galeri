<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $foto->judulFoto }} - Galeri Pro</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-slate-50 min-h-screen">

    <nav class="bg-white/80 backdrop-blur-md sticky top-0 z-50 border-b border-slate-100">
        <div class="max-w-7xl mx-auto px-4 h-16 flex justify-between items-center">
            <a href="{{ route('foto.index') }}" class="text-slate-600 hover:text-blue-600 font-black text-xs uppercase tracking-widest transition flex items-center gap-2">
                <i class="fas fa-chevron-left text-[10px]"></i> Kembali ke Galeri
            </a>
            <div class="flex items-center gap-3">
                <span class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] italic">Visual<span class="text-blue-600">Insights</span></span>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 py-8">
        <div class="flex flex-col lg:flex-row gap-8">
            
            <div class="lg:w-2/3">
                <div class="bg-white p-3 rounded-[3rem] shadow-2xl shadow-slate-200/60 border border-slate-100 transition-all duration-500 hover:shadow-blue-100/50">
                    <div class="relative rounded-[2.5rem] overflow-hidden bg-slate-900 flex items-center justify-center min-h-[500px] group">
                        <img src="{{ asset('storage/foto/' . $foto->lokasiFile) }}" 
                             class="max-w-full max-h-[85vh] object-contain shadow-2xl transition duration-500 group-hover:scale-[1.01]">
                        
                        <div class="absolute top-6 left-6">
                            <span class="bg-slate-900/40 backdrop-blur-md text-white text-[10px] font-black px-5 py-2.5 rounded-full uppercase tracking-[0.2em] border border-white/20">
                                <i class="fas fa-layer-group mr-2 text-blue-400"></i> {{ $foto->album->namaAlbum ?? 'Public Feed' }}
                            </span>
                        </div>
                    </div>
                </div>
                
                <div class="mt-8 flex items-center justify-between px-6">
                    <div class="flex items-center gap-6">
                        <form action="{{ route('like.toggle', $foto->fotoID) }}" method="POST">
                            @csrf
                            <button type="submit" class="flex items-center gap-3 px-8 py-3.5 {{ $foto->isLikedByAuth() ? 'bg-pink-500 text-white shadow-pink-200' : 'bg-white text-slate-600 border border-slate-100 hover:border-pink-200 hover:text-pink-500 shadow-sm' }} rounded-full shadow-lg transition-all active:scale-95 group">
                                <i class="{{ $foto->isLikedByAuth() ? 'fas' : 'far text-pink-500' }} fa-heart font-bold group-hover:scale-125 transition"></i>
                                <span class="text-sm font-black">{{ $foto->likefoto->count() }} <span class="hidden sm:inline">Apresiasi</span></span>
                            </button>
                        </form>
                        
                        <div class="flex flex-col">
                            <span class="text-[9px] text-slate-400 font-black uppercase tracking-[0.2em]">Release Date</span>
                            <span class="text-sm font-bold text-slate-700 italic">{{ \Carbon\Carbon::parse($foto->tanggalUnggah)->translatedFormat('d F Y') }}</span>
                        </div>
                    </div>
                    
                    @if(Auth::user()->role === 'admin')
                    <div class="flex gap-3">
                        <a href="{{ route('foto.edit', $foto->fotoID) }}" class="w-12 h-12 bg-amber-50 text-amber-600 rounded-2xl flex items-center justify-center hover:bg-amber-500 hover:text-white transition shadow-sm border border-amber-100" title="Admin Edit Mode">
                            <i class="fas fa-magic"></i>
                        </a>
                    </div>
                    @endif
                </div>
            </div>

            <div class="lg:w-1/3 flex flex-col gap-6">
                
                <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-14 h-14 bg-slate-900 rounded-2xl rotate-3 flex items-center justify-center text-white font-black text-xl shadow-lg uppercase transition hover:rotate-0">
                            {{ substr($foto->user->username, 0, 1) }}
                        </div>
                        <div>
                            <h2 class="font-black text-slate-800 text-lg leading-none mb-1">{{ $foto->user->username }}</h2>
                            <span class="px-2 py-0.5 bg-blue-50 text-blue-600 text-[10px] font-black rounded uppercase tracking-tighter">{{ $foto->user->role }}</span>
                        </div>
                    </div>

                    <h1 class="text-2xl font-black text-slate-900 mb-3 tracking-tight uppercase">{{ $foto->judulFoto }}</h1>
                    <p class="text-slate-500 text-sm leading-relaxed mb-6 italic">"{{ $foto->deskripsiFoto }}"</p>
                    
                    <div class="pt-6 border-t border-slate-50 flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <i class="fas fa-folder-open text-blue-400 text-xs"></i>
                            <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Collection</span>
                        </div>
                        <span class="text-[10px] font-black text-slate-800 bg-slate-100 px-3 py-1.5 rounded-lg uppercase tracking-tighter">{{ $foto->album->namaAlbum ?? 'Uncategorized' }}</span>
                    </div>
                </div>

                <div class="bg-white flex flex-col rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden flex-1 min-h-[450px]">
                    <div class="p-6 border-b border-slate-50 flex justify-between items-center bg-slate-50/30">
                        <h3 class="font-black text-slate-800 text-xs uppercase tracking-[0.2em] flex items-center gap-3">
                            <i class="fas fa-comment-dots text-blue-500"></i> 
                            Diskusi Komunitas
                        </h3>
                        <span class="bg-blue-600 text-white px-3 py-1 rounded-full text-[9px] font-black shadow-lg shadow-blue-100 italic">{{ $foto->komentarfoto->count() }} Pesan</span>
                    </div>

                    <div class="p-6 space-y-6 overflow-y-auto max-h-[400px] flex-1 scrollbar-hide">
                        @forelse($foto->komentarfoto as $komen)
                        <div class="group relative">
                            <div class="flex gap-4">
                                <div class="w-10 h-10 bg-slate-50 rounded-xl flex-shrink-0 flex items-center justify-center text-[11px] font-black text-slate-400 border border-slate-100 uppercase">
                                    {{ substr($komen->user->username, 0, 1) }}
                                </div>
                                <div class="flex-1">
                                    <div class="bg-slate-50 p-4 rounded-2xl rounded-tl-none border border-slate-50 group-hover:bg-white group-hover:border-blue-100 transition duration-300">
                                        <div class="flex justify-between items-center mb-2">
                                            <span class="text-[10px] font-black text-slate-800 uppercase tracking-tighter">{{ $komen->user->username }}</span>
                                            <span class="text-[9px] text-slate-300 font-bold uppercase">{{ \Carbon\Carbon::parse($komen->tanggalKomentar)->diffForHumans() }}</span>
                                        </div>
                                        <p class="text-xs text-slate-600 leading-relaxed font-medium">{{ $komen->isiKomentar }}</p>
                                    </div>
                                    
                                    @if(Auth::user()->role === 'admin' || Auth::id() === $komen->userID)
                                    <form action="{{ route('komentar.destroy', $komen->komentarID) }}" method="POST" class="mt-2 ml-1">
                                        @csrf @method('DELETE')
                                        <button type="submit" onclick="return confirm('Hapus komentar ini?')" class="text-[9px] font-black text-red-300 hover:text-red-600 transition uppercase tracking-[0.2em] flex items-center gap-1">
                                            <i class="fas fa-trash-alt"></i> Hapus
                                        </button>
                                    </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="text-center py-16 opacity-50">
                            <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4 border border-dashed border-slate-200">
                                <i class="far fa-comments text-2xl text-slate-300"></i>
                            </div>
                            <p class="text-[10px] text-slate-400 font-black uppercase tracking-widest leading-relaxed">Belum ada diskusi<br>Jadilah yang pertama!</p>
                        </div>
                        @endforelse
                    </div>

                    <div class="p-6 bg-white border-t border-slate-50">
                        <form action="{{ route('komentar.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="fotoID" value="{{ $foto->fotoID }}">
                            <div class="relative group">
                                <textarea name="isiKomentar" rows="1" placeholder="Bagikan pendapatmu..." 
                                          class="w-full pl-5 pr-14 py-4 bg-slate-50 border border-slate-100 rounded-2xl focus:ring-2 focus:ring-blue-500 focus:bg-white outline-none transition text-sm font-medium resize-none shadow-inner" required></textarea>
                                <button type="submit" class="absolute right-2.5 top-2.5 w-10 h-10 bg-slate-900 text-white rounded-xl hover:bg-blue-600 transition flex items-center justify-center shadow-lg active:scale-90">
                                    <i class="fas fa-paper-plane text-[10px]"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </main>

</body>
</html>