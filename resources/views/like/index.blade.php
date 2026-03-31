<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Koleksi Suka - Galeri Pro</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-slate-50">

    <header class="bg-white border-b border-slate-200 py-6 mb-10 shadow-sm">
        <div class="container mx-auto px-6 flex justify-between items-center">
            <div class="flex items-center gap-3">
                <a href="{{ url()->previous() }}" class="w-10 h-10 flex items-center justify-center rounded-full hover:bg-slate-100 transition">
                    <i class="fas fa-arrow-left text-slate-600"></i>
                </a>
                <h1 class="text-xl font-bold text-slate-800">Foto yang <span class="text-pink-600">Disukai</span></h1>
            </div>
            <a href="{{ route('foto.index') }}" class="text-sm font-semibold text-blue-600 hover:text-blue-800">
                <i class="fas fa-images mr-1"></i> Jelajah Galeri
            </a>
        </div>
    </header>

    <div class="container mx-auto px-6 pb-20">
        @if(session('success'))
            <div class="mb-6 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 rounded shadow-sm">
                {{ session('success') }}
            </div>
        @endif

        @if($likes->isEmpty())
            <div class="bg-white rounded-3xl p-20 text-center border border-slate-200 shadow-sm">
                <div class="w-20 h-20 bg-pink-50 text-pink-500 rounded-full flex items-center justify-center text-3xl mx-auto mb-6">
                    <i class="fas fa-heart-broken"></i>
                </div>
                <h2 class="text-2xl font-bold text-slate-800 mb-2">Belum ada foto favorit</h2>
                <p class="text-slate-500 mb-8">Sepertinya Anda belum memberikan "Like" pada foto manapun.</p>
                <a href="{{ route('foto.index') }}" class="bg-blue-600 text-white px-8 py-3 rounded-xl font-bold hover:bg-blue-700 transition shadow-lg shadow-blue-200">
                    Cari Foto Menarik
                </a>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                @foreach($likes as $item)
                    <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 group">
                        <div class="relative aspect-square overflow-hidden">
                            <img src="{{ asset('storage/foto/'.$item->foto->lokasiFile) }}" 
                                 alt="{{ $item->foto->judulFoto }}"
                                 class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                            
                            <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                <a href="{{ route('foto.show', $item->foto->fotoID) }}" class="bg-white text-slate-900 px-4 py-2 rounded-lg font-bold text-sm">
                                    Lihat Detail
                                </a>
                            </div>
                        </div>

                        <div class="p-5">
                            <h3 class="font-bold text-slate-800 truncate mb-1">{{ $item->foto->judulFoto }}</h3>
                            <p class="text-xs text-slate-500 mb-4 flex items-center gap-1">
                                <i class="fas fa-user text-[10px]"></i> {{ $item->foto->user->namaLengkap }}
                            </p>

                            <form action="{{ route('like.toggle', $item->foto->fotoID) }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full py-2.5 bg-pink-50 text-pink-600 rounded-xl text-xs font-bold hover:bg-pink-600 hover:text-white transition-colors flex items-center justify-center gap-2">
                                    <i class="fas fa-heart-broken"></i> 
                                    Batal Suka
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <footer class="text-center text-slate-400 text-sm py-10">
        &copy; {{ date('Y') }} Galeri Pro - Halaman Favorit {{ Auth::user()->role }}
    </footer>

</body>
</html>