<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Galeri Pro</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-slate-50">
    <div class="min-h-screen flex">
        <div class="bg-slate-900 text-slate-300 w-64 py-6 px-4 hidden md:block shadow-xl">
            <div class="flex items-center justify-center gap-3 mb-10 px-4">
                <i class="fas fa-camera-retro text-2xl text-blue-500"></i>
                <h1 class="text-xl font-bold text-white tracking-wider">GALERI<span class="text-blue-500">PRO</span></h1>
            </div>
            
            <nav class="space-y-2">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 py-3 px-4 rounded-lg bg-blue-600 text-white shadow-lg shadow-blue-900/20 transition-all">
                    <i class="fas fa-chart-line"></i> Dashboard
                </a>
                <a href="{{ route('foto.index') }}" class="flex items-center gap-3 py-3 px-4 rounded-lg hover:bg-slate-800 transition border border-transparent hover:border-slate-700">
                    <i class="fas fa-images text-blue-400"></i> Jelajah Galeri
                </a>
                
                <a href="{{ route('like.index') }}" class="flex items-center gap-3 py-3 px-4 rounded-lg hover:bg-slate-800 transition border border-transparent hover:border-slate-700">
                    <i class="fas fa-heart text-pink-500"></i> Like Saya
                </a>

                <a href="{{ route('album.index') }}" class="flex items-center gap-3 py-3 px-4 rounded-lg hover:bg-slate-800 transition border border-transparent hover:border-slate-700">
                    <i class="fas fa-folder-open text-amber-400"></i> Kelola Album
                </a>

                <a href="{{ route('foto.create') }}" class="flex items-center gap-3 py-3 px-4 rounded-lg hover:bg-slate-800 transition border border-transparent hover:border-slate-700">
                    <i class="fas fa-plus-circle text-green-400"></i> Unggah Foto
                </a>
                
                <div class="pt-10 border-t border-slate-800 mt-10">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="flex items-center gap-3 w-full py-3 px-4 rounded-lg bg-red-500/10 text-red-500 hover:bg-red-500 hover:text-white transition group">
                            <i class="fas fa-sign-out-alt group-hover:translate-x-1 transition"></i> 
                            <span class="font-semibold text-sm">Keluar</span>
                        </button>
                    </form>
                </div>
            </nav>
        </div>

        <div class="flex-1 flex flex-col">
            <header class="bg-white border-b border-slate-200 py-4 px-10 flex justify-between items-center shadow-sm">
                <div>
                    <h2 class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">System Control</h2>
                    <p class="text-lg font-black text-slate-800 tracking-tight">Administrator Panel</p>
                </div>
                <div class="flex items-center gap-4">
                    <div class="text-right hidden sm:block">
                        <p class="text-sm font-bold text-slate-800">{{ Auth::user()->username }}</p>
                        <p class="text-[10px] text-green-500 font-black uppercase flex items-center justify-end gap-1">
                            <span class="w-1.5 h-1.5 bg-green-500 rounded-full animate-pulse"></span> Online
                        </p>
                    </div>
                    <div class="w-10 h-10 bg-slate-900 rounded-xl flex items-center justify-center text-white font-black text-lg">
                        {{ substr(Auth::user()->username, 0, 1) }}
                    </div>
                </div>
            </header>

            <main class="p-10 space-y-8">
                <div>
                    <h2 class="text-2xl font-black text-slate-900 italic uppercase tracking-tighter text-blue-600">Admin Dashboard</h2>
                    <p class="text-slate-400 text-xs font-bold uppercase tracking-widest mt-1">Manajemen & Kontrol Galeri</p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-slate-100 flex items-center gap-5 group hover:shadow-xl hover:shadow-blue-100/50 transition-all duration-500">
                        <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center text-xl group-hover:bg-blue-600 group-hover:text-white transition shadow-inner">
                            <i class="fas fa-users"></i>
                        </div>
                        <div>
                            <p class="text-[9px] font-black text-slate-400 uppercase tracking-[0.2em]">Total Users</p>
                            <p class="text-2xl font-black text-slate-800 tracking-tighter">{{ $stats['total_user'] }}</p>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-slate-100 flex items-center gap-5 group hover:shadow-xl hover:shadow-green-100/50 transition-all duration-500">
                        <div class="w-12 h-12 bg-green-50 text-green-600 rounded-2xl flex items-center justify-center text-xl group-hover:bg-green-600 group-hover:text-white transition shadow-inner">
                            <i class="fas fa-images"></i>
                        </div>
                        <div>
                            <p class="text-[9px] font-black text-slate-400 uppercase tracking-[0.2em]">Total Photos</p>
                            <p class="text-2xl font-black text-slate-800 tracking-tighter">{{ $stats['total_foto'] }}</p>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-slate-100 flex items-center gap-5 group hover:shadow-xl hover:shadow-amber-100/50 transition-all duration-500">
                        <div class="w-12 h-12 bg-amber-50 text-amber-600 rounded-2xl flex items-center justify-center text-xl group-hover:bg-amber-600 group-hover:text-white transition shadow-inner">
                            <i class="fas fa-layer-group"></i>
                        </div>
                        <div>
                            <p class="text-[9px] font-black text-slate-400 uppercase tracking-[0.2em]">Total Albums</p>
                            <p class="text-2xl font-black text-slate-800 tracking-tighter">{{ $stats['total_album'] }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden">
                    <div class="p-8 border-b border-slate-50 bg-slate-50/30">
                        <h3 class="text-xs font-black text-slate-800 tracking-[0.2em] uppercase flex items-center gap-3">
                            <i class="fas fa-bolt text-blue-600"></i>
                            Admin Privileges
                        </h3>
                    </div>
                    <div class="p-10 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        <a href="{{ route('foto.index') }}" class="group flex flex-col p-6 bg-white border border-slate-100 rounded-[2rem] hover:bg-slate-900 transition-all duration-500 shadow-sm hover:shadow-2xl">
                            <i class="fas fa-eye text-2xl text-blue-600 mb-4 group-hover:scale-110 transition duration-500"></i>
                            <h4 class="font-black text-slate-800 group-hover:text-white transition uppercase text-[10px] tracking-widest">Moderasi</h4>
                        </a>

                        <a href="{{ route('like.index') }}" class="group flex flex-col p-6 bg-white border border-slate-100 rounded-[2rem] hover:bg-slate-900 transition-all duration-500 shadow-sm hover:shadow-2xl">
                            <i class="fas fa-heart text-2xl text-pink-500 mb-4 group-hover:scale-110 transition duration-500"></i>
                            <h4 class="font-black text-slate-800 group-hover:text-white transition uppercase text-[10px] tracking-widest">Like Saya</h4>
                        </a>

                        <a href="{{ route('album.index') }}" class="group flex flex-col p-6 bg-white border border-slate-100 rounded-[2rem] hover:bg-slate-900 transition-all duration-500 shadow-sm hover:shadow-2xl">
                            <i class="fas fa-folder-plus text-2xl text-amber-500 mb-4 group-hover:scale-110 transition duration-500"></i>
                            <h4 class="font-black text-slate-800 group-hover:text-white transition uppercase text-[10px] tracking-widest">Album</h4>
                        </a>

                        <a href="{{ route('foto.create') }}" class="group flex flex-col p-6 bg-white border border-slate-100 rounded-[2rem] hover:bg-slate-900 transition-all duration-500 shadow-sm hover:shadow-2xl">
                            <i class="fas fa-cloud-upload-alt text-2xl text-green-500 mb-4 group-hover:scale-110 transition duration-500"></i>
                            <h4 class="font-black text-slate-800 group-hover:text-white transition uppercase text-[10px] tracking-widest">Upload</h4>
                        </a>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>
</html>