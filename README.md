# 📸 Galeri Pro (Web Gallery System)

Sistem Manajemen Galeri Foto berbasis web yang modern dan responsif, dibangun menggunakan framework **Laravel 12** dan **PHP 8.3**. Aplikasi ini dirancang untuk memberikan pengalaman berbagi foto yang *clean*, cepat, dan aman dengan dukungan UI berbasis **Tailwind CSS**.

-----

## 🛠️ Tech Stack

  * **Framework:** Laravel 12
  * **Database:** MySQL 8.4
  * **Language:** PHP 8.3
  * **Frontend:** Tailwind CSS & Blade Templating
  * **Icons:** Font Awesome 6.0
  * **Design Style:** Neumorphism & Modern Bento Grid

-----

## ✨ Fitur Utama

  * **Multi-Role Dashboard**:
      * **Administrator**: Panel kontrol penuh untuk statistik pengguna, total foto, dan moderasi album.
      * **User/Member**: Dashboard pribadi untuk mengelola koleksi foto dan album sendiri.
  * **Smart Album Management**: Pengelompokan foto ke dalam album dengan fitur CRUD yang dinamis.
  * **Interactive Interaction**:
      * Sistem **Like** foto (termasuk fitur Like untuk Admin).
      * Fitur komentar untuk diskusi antar pengguna pada setiap foto.
  * **Dynamic Navigation**: Tombol navigasi cerdas yang mendeteksi peran pengguna (*Role-based redirect*).
  * **Responsive Layout**: Tampilan yang dioptimalkan untuk perangkat *mobile*, *tablet*, hingga *desktop*.
  * **Security Guard**: Implementasi middleware untuk proteksi data dan pemisahan hak akses antar role.

-----

## 📂 Struktur Database & Relasi

Aplikasi ini mengandalkan skema relasi yang efisien:

  * **`users`**: Menyimpan identitas pengguna (Admin & Member).
  * **`fotos`**: Data media foto, judul, deskripsi, dan lokasinya.
  * **`albums`**: Folder pengelompokan foto untuk setiap pengguna.
  * **`likefotos`**: Mencatat interaksi 'suka' antar pengguna dan foto.
  * **`komentarfotos`**: Menyimpan data diskusi pada setiap postingan.

-----

## 🚀 Instalasi & Konfigurasi

### 1\. Clone & Dependencies

```bash
git clone https://github.com/ReyGHz413/GaleriPro.git
cd GaleriPro
composer install
npm install && npm run dev
```

### 2\. Setup Environment

  * Buat database baru (contoh: `db_galeri`).
  * Copy `.env.example` menjadi `.env`.
  * Konfigurasi `DB_DATABASE`, `DB_USERNAME`, dan `DB_PASSWORD`.

### 3\. Migrasi & Sinkronisasi

```bash
php artisan key:generate
php artisan migrate:fresh --seed
php artisan storage:link
```

*Catatan: Jangan lupa jalankan `storage:link` agar file foto yang diunggah dapat diakses secara publik.*

### 4\. Jalankan Aplikasi

```bash
php artisan serve
```

-----

## 🔑 Akun Uji Coba (Demo)

| Role | Username | Password |
| :--- | :--- | :--- |
| **Administrator** | `admin_galeri` | `password` |
| **User/Member** | `rey_user` | `password` |

-----

## 📝 Catatan Pengembangan

  * **Role-Based Redirect**: Tombol "Kembali ke Dashboard" di halaman Album secara otomatis mendeteksi apakah Anda masuk sebagai Admin atau User.
  * **Fix Asset Error**: Jika ikon tidak muncul, pastikan koneksi internet aktif (karena menggunakan CDN Font Awesome) atau bersihkan cache dengan `php artisan view:clear`.

-----

**Developed by [ReyGHz413](https://www.google.com/search?q=https://github.com/ReyGHz413)**
