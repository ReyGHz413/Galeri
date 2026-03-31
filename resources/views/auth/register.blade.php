<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi - Galeri Pro</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-slate-100 flex items-center justify-center min-h-screen py-10">
    <div class="bg-white p-10 rounded-2xl shadow-xl w-full max-w-md border border-slate-200">
        <div class="text-center mb-8">
            <h2 class="text-2xl font-black text-slate-800 uppercase tracking-tight">Daftar <span class="text-blue-600">Akun</span></h2>
            <p class="text-slate-500 text-sm mt-1">Bergabunglah dengan komunitas galeri kami</p>
        </div>
        
        <form action="{{ route('register') }}" method="POST" class="space-y-4">
            @csrf
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase mb-2 ml-1">Username</label>
                    <input type="text" name="username" value="{{ old('username') }}" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none" required>
                    @error('username') <span class="text-red-500 text-[10px] font-bold">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase mb-2 ml-1">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none" required>
                    @error('email') <span class="text-red-500 text-[10px] font-bold">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase mb-2 ml-1 text-nowrap">Password</label>
                    <input type="password" name="password" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none" required>
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase mb-2 ml-1 text-nowrap">Konfirmasi</label>
                    <input type="password" name="password_confirmation" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none" required>
                </div>
                @error('password') <div class="col-span-2 text-red-500 text-[10px] font-bold">{{ $message }}</div> @enderror
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-500 uppercase mb-2 ml-1">Nama Lengkap</label>
                <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap') }}" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none" required>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-500 uppercase mb-2 ml-1">Alamat</label>
                <textarea name="alamat" rows="2" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none resize-none" placeholder="Alamat lengkap..." required>{{ old('alamat') }}</textarea>
            </div>

            <button type="submit" class="w-full bg-slate-800 text-white font-bold py-3 rounded-xl hover:bg-slate-900 transition duration-300 mt-4 shadow-lg shadow-slate-200">
                Daftar Sekarang <i class="fas fa-arrow-right ml-2 text-xs"></i>
            </button>
        </form>
        
        <p class="mt-6 text-center text-sm text-slate-600">
            Sudah punya akun? <a href="{{ route('login') }}" class="text-blue-600 font-bold hover:underline italic">Login di sini</a>
        </p>
    </div>
</body>
</html>