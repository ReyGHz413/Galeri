-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 31 Mar 2026 pada 01.38
-- Versi server: 8.4.3
-- Versi PHP: 8.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `galeri`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `albums`
--

CREATE TABLE `albums` (
  `albumID` bigint UNSIGNED NOT NULL,
  `namaAlbum` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggalDibuat` date NOT NULL,
  `userID` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `albums`
--

INSERT INTO `albums` (`albumID`, `namaAlbum`, `deskripsi`, `tanggalDibuat`, `userID`, `created_at`, `updated_at`) VALUES
(1, 'Music', 'Music yang kusuka', '2026-03-01', 2, NULL, NULL),
(2, 'Great taste', '.', '2026-03-31', 2, NULL, NULL),
(3, 'game', 'just game', '2026-03-31', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `fotos`
--

CREATE TABLE `fotos` (
  `fotoID` bigint UNSIGNED NOT NULL,
  `judulFoto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsiFoto` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggalUnggah` date NOT NULL,
  `lokasiFile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `albumID` bigint UNSIGNED DEFAULT NULL,
  `userID` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `fotos`
--

INSERT INTO `fotos` (`fotoID`, `judulFoto`, `deskripsiFoto`, `tanggalUnggah`, `lokasiFile`, `albumID`, `userID`, `created_at`, `updated_at`) VALUES
(1, 'Roc', 'Rex Orange County - Best Friend', '2026-03-13', '1773374331_roc.png', 1, 2, '2026-03-12 20:54:06', '2026-03-12 20:58:51'),
(3, 'proposal', '....', '2026-03-31', '1774919263_Screenshot_2025-01-16_123506.png', 2, 2, '2026-03-30 18:07:43', '2026-03-30 18:07:43'),
(4, 'ddadd', 'ddd', '2026-03-31', '1774919304_Screenshot_2025-01-16_123527.png', 2, 2, '2026-03-30 18:08:24', '2026-03-30 18:08:24'),
(5, 'rolnuk', 'n', '2026-03-31', '1774920399_1495160200_4917917133_1752454778204.png', 3, 1, '2026-03-30 18:26:39', '2026-03-30 18:28:40');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `komentarfotos`
--

CREATE TABLE `komentarfotos` (
  `komentarID` bigint UNSIGNED NOT NULL,
  `fotoID` bigint UNSIGNED NOT NULL,
  `userID` bigint UNSIGNED NOT NULL,
  `isiKomentar` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggalKomentar` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `komentarfotos`
--

INSERT INTO `komentarfotos` (`komentarID`, `fotoID`, `userID`, `isiKomentar`, `tanggalKomentar`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 'hi', '2026-03-31', '2026-03-30 17:38:16', '2026-03-30 17:38:16'),
(2, 1, 1, 'ok', '2026-03-31', '2026-03-30 18:32:37', '2026-03-30 18:32:37');

-- --------------------------------------------------------

--
-- Struktur dari tabel `likefotos`
--

CREATE TABLE `likefotos` (
  `likeID` bigint UNSIGNED NOT NULL,
  `fotoID` bigint UNSIGNED NOT NULL,
  `userID` bigint UNSIGNED NOT NULL,
  `tanggalLike` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `likefotos`
--

INSERT INTO `likefotos` (`likeID`, `fotoID`, `userID`, `tanggalLike`, `created_at`, `updated_at`) VALUES
(1, 1, 2, '2026-03-31', '2026-03-30 17:39:06', '2026-03-30 17:39:06'),
(2, 1, 1, '2026-03-31', '2026-03-30 18:25:34', '2026-03-30 18:25:34');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_03_13_004822_create_albums_table', 1),
(5, '2026_03_13_005046_create_fotos_table', 1),
(6, '2026_03_13_005108_create_komentar_fotos_table', 1),
(7, '2026_03_13_005139_create_like_fotos_table', 1),
(8, '2026_03_31_005306_make_album_id_nullable_in_fotos_table', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('xUokAjMj04vry3aYdFG32CLVAO2MbCcCG4RP8Xge', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoia2JZRWJxZHlZMFVUMzVRR3RqME1rUTJBcDVibjVoTlU4WmNpSTlmSyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fX0=', 1774920935);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `userID` bigint UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','user') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `nama_lengkap` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`userID`, `username`, `password`, `email`, `role`, `nama_lengkap`, `alamat`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', '$2y$12$BsW8RuYqpNN2WAORBhnrVe8hIu53Twy6qmh4.wg9lV9bnGEZF.swu', 'admin@galeri.com', 'admin', 'Administrator Sistem', 'Pusat Data Galeri', NULL, '2026-03-12 18:25:10', '2026-03-12 18:25:10'),
(2, 'rey', '$2y$12$1ijPwGSBt9ug3mpaEclsIuMKuG5kcH8TPBSJoRUm1xFtbuQZDPTvC', 'rey@gmail.com', 'user', 'Raehan Paleva', 'Arjosari', NULL, '2026-03-12 18:53:22', '2026-03-12 18:53:22');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `albums`
--
ALTER TABLE `albums`
  ADD PRIMARY KEY (`albumID`),
  ADD KEY `albums_userid_foreign` (`userID`);

--
-- Indeks untuk tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indeks untuk tabel `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `fotos`
--
ALTER TABLE `fotos`
  ADD PRIMARY KEY (`fotoID`),
  ADD KEY `fotos_albumid_foreign` (`albumID`),
  ADD KEY `fotos_userid_foreign` (`userID`);

--
-- Indeks untuk tabel `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_reserved_at_available_at_index` (`queue`,`reserved_at`,`available_at`);

--
-- Indeks untuk tabel `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `komentarfotos`
--
ALTER TABLE `komentarfotos`
  ADD PRIMARY KEY (`komentarID`),
  ADD KEY `komentarfotos_fotoid_foreign` (`fotoID`),
  ADD KEY `komentarfotos_userid_foreign` (`userID`);

--
-- Indeks untuk tabel `likefotos`
--
ALTER TABLE `likefotos`
  ADD PRIMARY KEY (`likeID`),
  ADD KEY `likefotos_fotoid_foreign` (`fotoID`),
  ADD KEY `likefotos_userid_foreign` (`userID`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `albums`
--
ALTER TABLE `albums`
  MODIFY `albumID` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `fotos`
--
ALTER TABLE `fotos`
  MODIFY `fotoID` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `komentarfotos`
--
ALTER TABLE `komentarfotos`
  MODIFY `komentarID` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `likefotos`
--
ALTER TABLE `likefotos`
  MODIFY `likeID` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `userID` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `albums`
--
ALTER TABLE `albums`
  ADD CONSTRAINT `albums_userid_foreign` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `fotos`
--
ALTER TABLE `fotos`
  ADD CONSTRAINT `fotos_albumid_foreign` FOREIGN KEY (`albumID`) REFERENCES `albums` (`albumID`) ON DELETE CASCADE,
  ADD CONSTRAINT `fotos_userid_foreign` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `komentarfotos`
--
ALTER TABLE `komentarfotos`
  ADD CONSTRAINT `komentarfotos_fotoid_foreign` FOREIGN KEY (`fotoID`) REFERENCES `fotos` (`fotoID`) ON DELETE CASCADE,
  ADD CONSTRAINT `komentarfotos_userid_foreign` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `likefotos`
--
ALTER TABLE `likefotos`
  ADD CONSTRAINT `likefotos_fotoid_foreign` FOREIGN KEY (`fotoID`) REFERENCES `fotos` (`fotoID`) ON DELETE CASCADE,
  ADD CONSTRAINT `likefotos_userid_foreign` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
