<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Galeri Pro</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-slate-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-10 rounded-2xl shadow-xl w-full max-w-sm border border-slate-200">
        <div class="text-center mb-8">
            <div class="bg-blue-600 w-16 h-16 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg shadow-blue-200">
                <i class="fas fa-camera-retro text-white text-3xl"></i>
            </div>
            <h2 class="text-2xl font-black text-slate-800 uppercase tracking-tight">Login <span class="text-blue-600">Galeri</span></h2>
            <p class="text-slate-500 text-sm mt-1">Masuk untuk mengelola foto Anda</p>
        </div>

        @if(session('success'))
            <div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-3 rounded mb-6 text-sm flex items-center gap-2">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-3 rounded mb-6 text-sm flex items-center gap-2">
                <i class="fas fa-exclamation-circle"></i> {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST" class="space-y-5">
            @csrf
            <div>
                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Username</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-slate-400">
                        <i class="fas fa-user"></i>
                    </span>
                    <input type="text" name="username" value="{{ old('username') }}" 
                           class="w-full pl-10 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:bg-white transition duration-200 outline-none" placeholder="Masukkan username" required>
                </div>
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Password</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-slate-400">
                        <i class="fas fa-lock"></i>
                    </span>
                    <input type="password" name="password" 
                           class="w-full pl-10 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:bg-white transition duration-200 outline-none" placeholder="••••••••" required>
                </div>
            </div>
            
            <button type="submit" class="w-full bg-blue-600 text-white font-bold py-3 rounded-xl hover:bg-blue-700 hover:shadow-lg hover:shadow-blue-200 transition duration-300 transform active:scale-[0.98]">
                Masuk Sekarang
            </button>
        </form>

        <p class="mt-8 text-center text-sm text-slate-600">
            Belum punya akun? <a href="{{ route('register') }}" class="text-blue-600 font-bold hover:underline italic">Daftar Akun</a>
        </p>
    </div>
</body>
</html>