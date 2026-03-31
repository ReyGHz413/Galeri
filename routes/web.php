<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FotoController;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\KomentarController;
use App\Http\Controllers\LikeController;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Foto;
use App\Models\Album;

// 1. Halaman Utama: Auto Redirect Berdasarkan Role
Route::get('/', function () {
    if (Auth::check()) {
        return Auth::user()->role === 'admin' 
            ? redirect()->route('admin.dashboard') 
            : redirect()->route('user.dashboard');
    }
    return redirect()->route('login');
});

// 2. Guest (Belum Login)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register'); 
    Route::post('/register', [AuthController::class, 'register']);
});

// 3. Terproteksi (Sudah Login)
Route::middleware(['auth', 'prevent-back'])->group(function () {
    
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // --- FITUR FOTO & ALBUM ---
    Route::resource('foto', FotoController::class);
    Route::resource('album', AlbumController::class); 

    // --- FITUR KOMENTAR ---
    Route::post('/komentar', [KomentarController::class, 'store'])->name('komentar.store');
    Route::delete('/komentar/{id}', [KomentarController::class, 'destroy'])->name('komentar.destroy');

    // --- FITUR LIKE ---
    Route::post('/like/{fotoID}', [LikeController::class, 'toggleLike'])->name('like.toggle');
    Route::get('/my-likes', [LikeController::class, 'index'])->name('like.index');

    // --- JALUR KHUSUS ADMIN (DIPERBAIKI) ---
    // Hapus 'can:admin-only' jika belum setting Gate di ServiceProvider
    Route::prefix('admin')->group(function () {
        Route::get('/dashboard', function () {
            // Cek manual role admin di sini
            if (Auth::user()->role !== 'admin') {
                abort(403, 'Hanya Admin yang boleh masuk sini!');
            }
            
            $stats = [
                'total_user'  => User::where('role', 'user')->count(),
                'total_foto'  => Foto::count(),
                'total_album' => Album::count(),
            ];
            return view('admin.dashboard', compact('stats'));
        })->name('admin.dashboard');
    });

    // --- JALUR KHUSUS USER ---
    Route::prefix('user')->group(function () {
        Route::get('/dashboard', function () {
            $fotos = Foto::where('userID', Auth::id())->latest()->get();
            return view('user.dashboard', compact('fotos'));
        })->name('user.dashboard');
    });
});