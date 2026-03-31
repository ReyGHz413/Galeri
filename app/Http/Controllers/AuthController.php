<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Menampilkan halaman Login
    public function showLogin() {
        // Mencegah redirect loop: Jika sudah login, jangan tampilkan form login
        if (Auth::check()) {
            return Auth::user()->role === 'admin' 
                ? redirect()->route('admin.dashboard') 
                : redirect()->route('user.dashboard');
        }
        return view('auth.login');
    }

    // Proses Login
    public function login(Request $request) {
        // Validasi input login sesuai kaidah form yang komunikatif [cite: 49]
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            // Redirect berdasarkan privilege [cite: 44]
            if (Auth::user()->role === 'admin') {
                return redirect()->intended(route('admin.dashboard'));
            }
            return redirect()->intended(route('user.dashboard'));
        }

        // Pesan error jika gagal [cite: 49]
        return back()->withErrors([
            'username' => 'Username atau password yang Anda masukkan salah.',
        ])->withInput($request->only('username'));
    }

    // Menampilkan halaman Register
    public function showRegister() {
        if (Auth::check()) {
            return redirect()->back();
        }
        return view('auth.register');
    }

    // Proses Register [cite: 42, 45]
    public function register(Request $request) {
        // Validasi data sesuai spesifikasi tabel user 
        $request->validate([
            'username'     => 'required|string|max:255|unique:users,username',
            'email'        => 'required|string|email|max:255|unique:users,email',
            'password'     => 'required|string|min:6|confirmed',
            'nama_lengkap' => 'required|string|max:255',
            'alamat'       => 'required|string',
        ]);

        // Simpan ke database [cite: 58, 85]
        User::create([
            'username'     => $request->username,
            'email'        => $request->email,
            'password'     => Hash::make($request->password),
            'nama_lengkap' => $request->nama_lengkap,
            'alamat'       => $request->alamat,
            'role'         => 'user', // Privilege dikunci sebagai user biasa [cite: 45]
        ]);

        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
    }

    // Logout dan Prevent Back History
    public function logout(Request $request) {
        Auth::logout();

        // Invalidate session untuk memastikan user benar-benar keluar
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect ke login dengan pesan sukses [cite: 45]
        return redirect()->route('login')->with('success', 'Anda telah berhasil logout.');
    }
}