<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'username' => 'admin',
            'email' => 'admin@galeri.com',
            'password' => Hash::make('admin123'), // Ganti dengan password aman
            'nama_lengkap' => 'Administrator Sistem',
            'alamat' => 'Pusat Data Galeri',
            'role' => 'admin', // Hanya admin yang dibuat di sini
        ]);
    }
}
