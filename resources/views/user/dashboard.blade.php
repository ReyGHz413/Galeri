<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard - Galeri Pro</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-slate-50">
    <nav class="bg-white/80 backdrop-blur-md shadow-sm border-b sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center text-white">
                        <i class="fas fa-th-large text-sm"></i>
                    </div>
                    <span class="text-xl font-black text-slate-800 tracking-tighter uppercase">My<span class="text-blue-600">Space</span></span>
                </div>
                
                <div class="flex items-center gap-6">
                    <a href="{{ route('foto.index') }}" class="text-slate-500 hover:text-blue-600 font-bold text-xs uppercase tracking-widest transition">
                        <i class="fas fa-compass mr-1"></i> Explore
                    </a>
                    <a href="{{ route('album.index') }}" class="text-slate-500 hover:text-orange-500 font-bold text-xs uppercase tracking-widest transition">
                        <i class="fas fa-images mr-1"></i> Album
                    </a>
                    <a href="{{ route('like.index') }}" class="text-slate-500 hover:text-pink-500 font-bold text-xs uppercase tracking-widest transition">
                        <i class="fas fa-heart mr-1"></i> Liked
                    </a>
                    
                    <div class="h-8 w-[1px] bg-slate-200 hidden sm:block"></div>

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-red-50 text-red-500 hover:bg-red-500 hover:text-white px-4 py-2 rounded-xl font-bold text-xs uppercase tracking-tighter transition-all">
                            Log Out
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 py-10">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-8 mb-12">
            <div class="relative group">
                <div class="absolute -inset-1 bg-gradient-to-r from-blue-600 to-indigo-600 rounded-[2.5rem] blur opacity-10 group-hover:opacity-20 transition duration-1000"></div>
                <div class="relative bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm">
                    <p class="text-[10px] font-black text-blue-500 uppercase tracking-[0.3em] mb-2">Authenticated User</p>
                    <h2 class="text-4xl font-black text-slate-900 tracking-tight italic">Halo, {{ Auth::user()->username }}!</h2>
                    <p class="text-slate-400 mt-2 font-medium">Kamu punya <span class="text-slate-900 font-bold">{{ $fotos->count() }} karya</span> yang tersimpan.</p>
                </div>
            </div>
            
            <div class="flex flex-wrap gap-4">
                <a href="{{ route('album.index') }}" class="flex-1 sm:flex-none inline-flex items-center justify-center px-8 py-4 bg-white border border-slate-200 text-slate-700 rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-slate-50 hover:border-slate-300 transition-all shadow-sm">
                    <i class="fas fa-folder-open mr-2 text-orange-400"></i> Folder Album
                </a>
                <a href="{{ route('foto.create') }}" class="flex-1 sm:flex-none inline-flex items-center justify-center px-8 py-4 bg-blue-600 text-white rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-blue-700 transition-all shadow-xl shadow-blue-100 transform active:scale-95">
                    <i class="fas fa-plus mr-2"></i> Upload Foto
                </a>
            </div>
        </div>

        @if($fotos->isEmpty())
            <div class="bg-white rounded-[3rem] py-32 text-center border-4 border-dashed border-slate-100">
                <div class="w-24 h-24 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-8">
                    <i class="fas fa-cloud-upload-alt text-4xl text-slate-200"></i>
                </div>
                <h3 class="text-2xl font-black text-slate-800 mb-2 tracking-tight">Galeri Masih Kosong</h3>
                <p class="text-slate-400 mb-10 max-w-sm mx-auto font-medium leading-relaxed">Jangan biarkan memorimu hilang begitu saja. Mulai unggah foto pertamamu!</p>
                <a href="{{ route('foto.create') }}" class="bg-slate-900 text-white px-10 py-4 rounded-2xl font-black text-xs uppercase tracking-widest hover:shadow-2xl transition-all">Upload Sekarang</a>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                @foreach($fotos as $foto)
                    <div class="bg-white rounded-[2rem] overflow-hidden shadow-sm border border-slate-100 hover:shadow-2xl hover:shadow-blue-900/5 transition-all duration-500 group">
                        <div class="relative h-64 overflow-hidden bg-slate-200">
                            <img src="{{ asset('storage/foto/' . $foto->lokasiFile) }}" 
                                 class="w-full h-full object-cover group-hover:scale-110 transition duration-1000">
                            
                            <div class="absolute inset-0 bg-slate-900/60 opacity-0 group-hover:opacity-100 transition-all duration-300 backdrop-blur-[2px] flex items-center justify-center">
                                <a href="{{ route('foto.show', $foto->fotoID) }}" class="flex items-center gap-3 bg-white px-6 py-3 rounded-2xl text-slate-900 font-black text-[10px] uppercase tracking-widest hover:bg-blue-600 hover:text-white transition shadow-lg translate-y-4 group-hover:translate-y-0 duration-300">
                                    <i class="fas fa-expand-alt"></i> Lihat Detail
                                </a>
                            </div>
                        </div>
                        
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-4">
                                <h4 class="font-black text-slate-800 truncate flex-1 uppercase tracking-tighter">{{ $foto->judulFoto }}</h4>
                                <span class="ml-2 bg-slate-50 text-slate-400 text-[9px] font-black px-2 py-1 rounded uppercase tracking-tighter">
                                    {{ \Carbon\Carbon::parse($foto->tanggalUnggah)->format('M d') }}
                                </span>
                            </div>
                            
                            <div class="flex items-center justify-between pt-4 border-t border-slate-50">
                                <span class="text-[10px] font-black text-blue-500 uppercase tracking-widest">
                                    <i class="fas fa-folder-open mr-1"></i> {{ $foto->album->namaAlbum ?? 'Public' }}
                                </span>
                                <div class="flex gap-3 text-slate-300">
                                    <div class="flex items-center gap-1 text-[10px] font-bold">
                                        <i class="fas fa-heart"></i> {{ $foto->likefoto->count() }}
                                    </div>
                                    <div class="flex items-center gap-1 text-[10px] font-bold">
                                        <i class="fas fa-comment"></i> {{ $foto->komentarfoto->count() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </main>
</body>
</html>