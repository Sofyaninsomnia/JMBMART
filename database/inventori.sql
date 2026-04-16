-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 16 Apr 2026 pada 04.27
-- Versi server: 5.7.34
-- Versi PHP: 8.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Basis data: `inventori`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang_keluar`
--

CREATE TABLE `barang_keluar` (
  `id_barang_keluar` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `tanggal_keluar` date NOT NULL,
  `jumlah_keluar` int(11) NOT NULL,
  `keterangan` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_penjualan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `barang_keluar`
--

INSERT INTO `barang_keluar` (`id_barang_keluar`, `id_barang`, `tanggal_keluar`, `jumlah_keluar`, `keterangan`, `created_at`, `updated_at`, `id_penjualan`) VALUES
(39, 30, '2025-08-05', 11, 'Penjualan', '2025-08-05 21:21:18', '2025-08-05 21:21:18', 14),
(41, 30, '2025-08-12', 10, 'Penjualan', '2025-08-12 00:54:00', '2025-08-12 00:54:00', 16);

--
-- Trigger `barang_keluar`
--
DELIMITER $$
CREATE TRIGGER `after_barang_keluar_insert` AFTER INSERT ON `barang_keluar` FOR EACH ROW BEGIN

  UPDATE data_barang 

  SET stok = stok - NEW.jumlah_keluar

  WHERE id_barang = NEW.id_barang;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang_masuk`
--

CREATE TABLE `barang_masuk` (
  `id_barang_masuk` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `jumlah_masuk` int(11) NOT NULL,
  `keterangan` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `barang_masuk`
--

INSERT INTO `barang_masuk` (`id_barang_masuk`, `id_barang`, `tanggal_masuk`, `jumlah_masuk`, `keterangan`, `created_at`, `updated_at`) VALUES
(25, 30, '2025-08-05', 122, NULL, '2025-08-05 21:08:28', '2025-08-05 21:08:28'),
(26, 14, '2025-08-11', 20, 'nota', '2025-08-10 19:53:19', '2025-08-10 19:53:19');

--
-- Trigger `barang_masuk`
--
DELIMITER $$
CREATE TRIGGER `after_barang_masuk_insert` AFTER INSERT ON `barang_masuk` FOR EACH ROW BEGIN

  UPDATE data_barang 

  SET stok = stok + NEW.jumlah_masuk

  WHERE id_barang = NEW.id_barang;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `data`
--

CREATE TABLE `data` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_barang`
--

CREATE TABLE `data_barang` (
  `id_barang` int(11) NOT NULL,
  `kode_barang` varchar(255) NOT NULL,
  `nama_barang` varchar(40) NOT NULL,
  `package` varchar(255) NOT NULL,
  `harga_beli` bigint(20) NOT NULL,
  `harga_jual` bigint(20) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `stok` int(11) DEFAULT '0',
  `id_supplier` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `data_barang`
--

INSERT INTO `data_barang` (`id_barang`, `kode_barang`, `nama_barang`, `package`, `harga_beli`, `harga_jual`, `id_kategori`, `stok`, `id_supplier`, `created_at`, `updated_at`) VALUES
(14, 'OZYCNQ8X', 'Ice Kepal', 'Cup', 8000, 15000, 6, 30, 1, '2025-07-10 00:30:08', '2025-07-10 00:30:08'),
(15, 'GGNTDDOY', 'Yoghurt Botol', 'Btl', 7500, 15000, 6, 43, 1, '2025-07-10 00:31:31', '2025-07-17 20:43:34'),
(16, 'ZFZABVBB', 'Yoghurt stik', 'Bks', 13000, 20000, 6, 0, 2, '2025-07-10 00:32:47', '2025-07-17 20:43:55'),
(17, 'TUZ51CID', 'Pancake Mika', 'Bks', 12000, 17000, 5, 0, 1, '2025-07-10 00:34:03', '2025-07-10 00:34:03'),
(22, 'BO2NF6BV', 'Pancake box', 'Bks', 45000, 70000, 5, 15, 1, '2025-07-10 00:35:34', '2025-07-10 00:35:34'),
(24, 'C379QU3W', 'Durpas', 'Bks', 65000, 80000, 5, 1, 1, '2025-07-10 00:37:32', '2025-07-10 00:37:32'),
(25, 'EHVSJQWU', 'Durian cup', 'cup', 5000, 10000, 6, 12, 2, '2025-07-10 00:38:34', '2025-07-10 00:46:02'),
(26, '9WTF192W', 'Milk shake', 'Btl', 8000, 15000, 6, 21, 1, '2025-07-10 00:39:35', '2025-07-10 00:46:17'),
(30, 'S3IZQQHJ', 'Beras', 'Kilogram', 14500, 15500, 12, 114, 5, '2025-07-15 21:21:53', '2025-07-15 21:21:53'),
(31, 'NNIWSUR1', 'Gula', 'Plastik', 2000, 5000, 12, 28, 2, '2025-07-22 18:31:17', '2025-07-22 18:31:17');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_supplier`
--

CREATE TABLE `data_supplier` (
  `id_supplier` int(11) NOT NULL,
  `nama_supplier` varchar(50) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `no_telp_supplier` varchar(15) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `data_supplier`
--

INSERT INTO `data_supplier` (`id_supplier`, `nama_supplier`, `alamat`, `no_telp_supplier`, `created_at`, `updated_at`) VALUES
(1, 'angger', 'japura', '0897552676', '2025-07-09 02:56:59', '2025-07-09 02:56:59'),
(2, 'Sofyan swift', 'Atlantis barat daya', '089602867121', '2025-07-09 02:56:59', '2025-07-22 18:15:45'),
(5, 'Lumet Store', 'Bukepin', '087729355308', '2025-07-15 20:54:19', '2025-07-15 20:54:19'),
(7, 'Asep Jamaludinnnn', 'h;jukyhi', '089602867121', '2025-08-10 20:05:34', '2025-08-11 19:22:47');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`, `created_at`, `updated_at`) VALUES
(5, 'Makanan', '2025-07-09 23:20:41', '2025-07-09 23:20:41'),
(6, 'Minuman', '2025-07-09 23:20:53', '2025-07-09 23:20:53'),
(9, 'Perlengkapan Bayi', '2025-07-15 21:02:14', '2025-07-15 21:02:14'),
(10, 'Kebersihan & Kesehatan', '2025-07-15 21:03:16', '2025-07-15 21:03:16'),
(11, 'Kosmetik', '2025-07-15 21:03:29', '2025-07-15 21:03:29'),
(12, 'Sembako', '2025-07-15 21:03:52', '2025-07-15 21:03:52'),
(13, 'Material', '2025-07-15 21:04:15', '2025-07-15 21:04:15'),
(14, 'Billing', '2025-07-15 21:05:00', '2025-07-15 21:05:00'),
(15, 'Top Up', '2025-07-15 21:05:20', '2025-07-15 21:05:20'),
(16, 'Materai', '2025-07-15 21:05:32', '2025-07-15 21:05:32'),
(17, 'ATK', '2025-07-15 21:05:44', '2025-07-15 21:05:44'),
(18, 'Lainnya', '2025-07-15 21:05:58', '2025-07-15 21:05:58');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_07_07_015352_create_data_barangs_table', 2),
(5, '2025_07_07_040735_create_data_suppliers_table', 2),
(6, '2025_07_07_043320_create_data_table', 2),
(7, '2025_07_07_043958_create_barang_masuks_table', 2),
(8, '2025_07_07_044350_create_barang_keluars_table', 2),
(9, '2025_07_07_044728_create_rekap_datas_table', 2),
(10, '2025_07_11_064512_add_fields_to_rekap_data_table', 3),
(11, '2025_07_11_073538_rekap_data', 4),
(12, '2025_07_17_140955_add_id_penjualan_to_barang_keluar', 5),
(13, '2025_07_29_072443_create_noreks_table', 6);

-- --------------------------------------------------------

--
-- Struktur dari tabel `norek`
--

CREATE TABLE `norek` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nomor` bigint(20) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `norek`
--

INSERT INTO `norek` (`id`, `nomor`, `nama`, `created_at`, `updated_at`) VALUES
(1, 1340099001843, 'Koperasi JMB Palikanci', '2025-07-29 18:28:31', '2025-08-10 20:03:32');

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `penjualan`
--

CREATE TABLE `penjualan` (
  `id` int(11) NOT NULL,
  `kode_penjualan` varchar(100) NOT NULL,
  `nama_pelanggan` varchar(255) NOT NULL,
  `tanggal` date NOT NULL,
  `total` bigint(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `penjualan`
--

INSERT INTO `penjualan` (`id`, `kode_penjualan`, `nama_pelanggan`, `tanggal`, `total`, `created_at`, `updated_at`) VALUES
(14, 'LEHQPAKQ', 'Syarif', '2025-08-05', 170500, '2025-08-05 21:21:02', '2025-08-05 21:21:18'),
(16, 'QTDFDYAO', 'Ratna', '2025-08-12', 155000, '2025-08-12 00:53:38', '2025-08-12 00:54:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rekap_data`
--

CREATE TABLE `rekap_data` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tanggal` date DEFAULT NULL,
  `data_barang_id` int(11) DEFAULT NULL,
  `stok_awal` int(11) DEFAULT NULL,
  `pembelian` int(11) DEFAULT NULL,
  `penjualan` int(11) DEFAULT NULL,
  `stok_akhir` int(11) DEFAULT NULL,
  `harga_beli` bigint(20) DEFAULT NULL,
  `harga_jual` bigint(20) DEFAULT NULL,
  `keuntungan` bigint(20) DEFAULT NULL,
  `modal_per_akhir` bigint(20) DEFAULT NULL,
  `sub_total` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `rekap_data`
--

INSERT INTO `rekap_data` (`id`, `tanggal`, `data_barang_id`, `stok_awal`, `pembelian`, `penjualan`, `stok_akhir`, `harga_beli`, `harga_jual`, `keuntungan`, `modal_per_akhir`, `sub_total`, `created_at`, `updated_at`) VALUES
(277, '2025-08-05', 14, 30, 0, 0, 30, 8000, 15000, 0, 240000, 0, '2026-04-15 09:43:50', '2026-04-15 09:43:50'),
(278, '2025-08-05', 15, 43, 0, 0, 43, 7500, 15000, 0, 322500, 0, '2026-04-15 09:43:50', '2026-04-15 09:43:50'),
(279, '2025-08-05', 16, 0, 0, 0, 0, 13000, 20000, 0, 0, 0, '2026-04-15 09:43:50', '2026-04-15 09:43:50'),
(280, '2025-08-05', 17, 0, 0, 0, 0, 12000, 17000, 0, 0, 0, '2026-04-15 09:43:50', '2026-04-15 09:43:50'),
(281, '2025-08-05', 22, 15, 0, 0, 15, 45000, 70000, 0, 675000, 0, '2026-04-15 09:43:50', '2026-04-15 09:43:50'),
(282, '2025-08-05', 24, 1, 0, 0, 1, 65000, 80000, 0, 65000, 0, '2026-04-15 09:43:50', '2026-04-15 09:43:50'),
(283, '2025-08-05', 25, 12, 0, 0, 12, 5000, 10000, 0, 60000, 0, '2026-04-15 09:43:50', '2026-04-15 09:43:50'),
(284, '2025-08-05', 26, 21, 0, 0, 21, 8000, 15000, 0, 168000, 0, '2026-04-15 09:43:50', '2026-04-15 09:43:50'),
(285, '2025-08-05', 30, 3, 122, 11, 114, 14500, 15500, -11000, 1653000, 170500, '2026-04-15 09:43:50', '2026-04-15 09:43:50'),
(286, '2025-08-05', 31, 28, 0, 0, 28, 2000, 5000, 0, 56000, 0, '2026-04-15 09:43:50', '2026-04-15 09:43:50');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('18ClwdOM6vcgG44aLPxrNvkpajhIi7AgSeKXzG6b', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMXJ1VFZMNlJOcjV3dWpuSXdSY1VCSFoyUHBOazhCRURGc3d2ZmdBdiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1776267697),
('6fiqLOJFrktZV0BjdxvrqVOl1s1xnhgVTuigx6GB', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiaHJmZWlTcDVWODR3YlN6TjAwQlltM2tkb2E0SnkwMFB5T3Z4c3FQbyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fX0=', 1776271662),
('zXQiGLns4erXb377QcI30e2ip41UWgshEnzeOg1P', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTo3OntzOjY6Il90b2tlbiI7czo0MDoiS1ZKVU1SbTVDQVdxUXg0RGxnNDVKeVhYcXZXbmlPTVl6VU9VZHlIaSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9rYXRlZ29yaSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NToiZW1haWwiO3M6MjE6InN3aWZ0c29meWFuQGdtYWlsLmNvbSI7czo0OiJuYW1lIjtzOjEyOiJTb2Z5YW4gc3dpZnQiO3M6NDoiZm90byI7czoyMzoiZm90b19wcm9maWwvZGVmYXVsdC5wbmciO3M6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1776304318);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `foto` varchar(255) NOT NULL DEFAULT 'default.png',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `foto`, `created_at`, `updated_at`) VALUES
(1, 'Sofyan swift', 'swiftsofyan@gmail.com', NULL, '$2y$10$AhIwu7hJNIqLsNUUSfVy/uUD84iKKf3J64cby65p6GMwz4ORPDd4e', '59CZQaqOk9gPu7BSloketMOjgvb32tknD2a2tG1NObdAOxLihAzjaztCntoK', 'foto_profil/default.png', '2025-07-10 20:48:23', '2026-04-15 05:07:08');

--
-- Indeks untuk tabel yang dibuang
--

--
-- Indeks untuk tabel `barang_keluar`
--
ALTER TABLE `barang_keluar`
  ADD PRIMARY KEY (`id_barang_keluar`),
  ADD KEY `id_barang` (`id_barang`),
  ADD KEY `fk_barang_keluar_penjualan` (`id_penjualan`);

--
-- Indeks untuk tabel `barang_masuk`
--
ALTER TABLE `barang_masuk`
  ADD PRIMARY KEY (`id_barang_masuk`),
  ADD KEY `id_barang` (`id_barang`);

--
-- Indeks untuk tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `data`
--
ALTER TABLE `data`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `data_barang`
--
ALTER TABLE `data_barang`
  ADD PRIMARY KEY (`id_barang`),
  ADD KEY `id_kategori` (`id_kategori`),
  ADD KEY `id_supplier` (`id_supplier`);

--
-- Indeks untuk tabel `data_supplier`
--
ALTER TABLE `data_supplier`
  ADD PRIMARY KEY (`id_supplier`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indeks untuk tabel `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `norek`
--
ALTER TABLE `norek`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `rekap_data`
--
ALTER TABLE `rekap_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rekap_datas_data_barang_id_foreign` (`data_barang_id`);

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
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `barang_keluar`
--
ALTER TABLE `barang_keluar`
  MODIFY `id_barang_keluar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT untuk tabel `barang_masuk`
--
ALTER TABLE `barang_masuk`
  MODIFY `id_barang_masuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT untuk tabel `data`
--
ALTER TABLE `data`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `data_barang`
--
ALTER TABLE `data_barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT untuk tabel `data_supplier`
--
ALTER TABLE `data_supplier`
  MODIFY `id_supplier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `norek`
--
ALTER TABLE `norek`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `rekap_data`
--
ALTER TABLE `rekap_data`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=287;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `barang_keluar`
--
ALTER TABLE `barang_keluar`
  ADD CONSTRAINT `barang_keluar_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `data_barang` (`id_barang`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_barang_keluar_penjualan` FOREIGN KEY (`id_penjualan`) REFERENCES `penjualan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `barang_masuk`
--
ALTER TABLE `barang_masuk`
  ADD CONSTRAINT `barang_masuk_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `data_barang` (`id_barang`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `data_barang`
--
ALTER TABLE `data_barang`
  ADD CONSTRAINT `data_barang_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`) ON DELETE CASCADE,
  ADD CONSTRAINT `data_barang_ibfk_2` FOREIGN KEY (`id_supplier`) REFERENCES `data_supplier` (`id_supplier`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `rekap_data`
--
ALTER TABLE `rekap_data`
  ADD CONSTRAINT `rekap_datas_data_barang_id_foreign` FOREIGN KEY (`data_barang_id`) REFERENCES `data_barang` (`id_barang`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
