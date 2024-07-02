-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Waktu pembuatan: 02 Jul 2024 pada 02.38
-- Versi server: 5.7.39
-- Versi PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_paket1`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `banks`
--

CREATE TABLE `banks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bank` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nomor_rekening` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `banks`
--

INSERT INTO `banks` (`id`, `bank`, `nomor_rekening`, `created_at`, `updated_at`) VALUES
(1, 'BRI', '1008201923901', '2024-05-28 04:26:50', '2024-05-28 04:26:50'),
(2, 'BNI', '8001920193', '2024-05-28 04:26:50', '2024-05-28 04:26:50');

-- --------------------------------------------------------

--
-- Struktur dari tabel `barangs`
--

CREATE TABLE `barangs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_barang` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga_beli` int(11) NOT NULL,
  `harga_jual` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `barangs`
--

INSERT INTO `barangs` (`id`, `nama_barang`, `harga_beli`, `harga_jual`, `stok`, `created_at`, `updated_at`) VALUES
(1, 'Kayu Packing', 10000, 15000, 100, '2024-06-26 07:03:12', '2024-06-26 07:03:12'),
(2, 'Busa Pelindung', 5000, 7500, 125, '2024-06-26 07:04:07', '2024-06-27 01:38:30');

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang_masuks`
--

CREATE TABLE `barang_masuks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_barang` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `keterangan` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode_customer` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_wa` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `limit_credit` int(11) NOT NULL DEFAULT '0',
  `point` int(11) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `customers`
--

INSERT INTO `customers` (`id`, `kode_customer`, `nama`, `no_wa`, `email`, `alamat`, `username`, `limit_credit`, `point`, `created_at`, `updated_at`) VALUES
(1, 'LP-001', 'Gilang Ramadhan', '082291820912', 'gilang.r@gmail.com', 'Jl. Margonda no.44 Depok', 'gilang', 2620000, 340, '2024-05-27 20:02:54', '2024-06-25 05:51:53'),
(2, 'LP-002', 'Sri Rezeki', '082280001288', 'sri.r@mail.com', 'Jl Kayu Manis no.34 Tangerang Kota', NULL, 1000000, 455, '2024-05-27 20:06:15', '2024-06-25 05:18:54'),
(3, 'LP-003', 'Rizky', '081290192012', 'rizky.r@mail.com', 'tulang bawang', 'rizky', 0, 0, '2024-06-25 04:18:22', '2024-06-25 04:18:22');

-- --------------------------------------------------------

--
-- Struktur dari tabel `daftar_pengeluarans`
--

CREATE TABLE `daftar_pengeluarans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tgl_pengeluaran` date NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah_pembayaran` int(11) NOT NULL,
  `yang_membayar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `yang_menerima` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `metode_pembayaran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bukti_pembayaran` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_pengeluaran` int(11) NOT NULL COMMENT '1 = Disetujui, 2 = Pending',
  `jenis_pengeluaran` int(11) NOT NULL COMMENT 'operasional, pengeluaran lain',
  `keterangan_tambahan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `daftar_pengeluarans`
--

INSERT INTO `daftar_pengeluarans` (`id`, `tgl_pengeluaran`, `keterangan`, `jumlah_pembayaran`, `yang_membayar`, `yang_menerima`, `metode_pembayaran`, `bukti_pembayaran`, `status_pengeluaran`, `jenis_pengeluaran`, `keterangan_tambahan`, `created_at`, `updated_at`) VALUES
(3, '2024-05-13', 'Pengeluaran 1', 45000, 'Anwar Ahmad', 'Samsudin', 'transfer', 'https://drive.google.com/file/d/16ei5CzYE9rLUQ_FR9xmDcDuSAfeSqUN7/view?usp=sharing', 1, 1, NULL, '2024-05-13 02:08:18', '2024-05-13 02:10:49'),
(4, '2024-05-13', 'Pengeluaran 2', 50000, 'Anwar Ahmad', 'Ricky', 'transfer', 'https://drive.google.com/file/d/16ei5CzYE9rLUQ_FR9xmDcDuSAfeSqUN7/view?usp=sharing', 1, 2, NULL, '2024-05-13 02:09:13', '2024-05-13 02:10:53'),
(5, '2024-05-13', 'Pengeluaran Operasional 2', 200000, 'Anwar Ahmad', 'Hery', 'transfer', 'https://drive.google.com/file/d/16ei5CzYE9rLUQ_FR9xmDcDuSAfeSqUN7/view?usp=sharing', 1, 1, NULL, '2024-05-13 02:21:15', '2024-05-13 02:21:51'),
(6, '2024-05-23', 'Pengeluaran 2', 50000, 'Anwar Ahmad', 'Tisna', 'transfer', 'https://drive.google.com/file/d/1rlz8NoT_I5z39jfG_7XmV_AODeJWbgsL/view?usp=sharing', 1, 1, NULL, '2024-05-23 06:55:19', '2024-05-23 06:55:50'),
(7, '2024-05-27', 'Pengeluaran 3', 45000, 'Anwar Ahmad', 'Junaidi Surya', 'transfer', '6653fd28c824f.png', 1, 1, 'Contoh keterangan tambahan', '2024-05-26 20:25:32', '2024-05-26 20:30:09');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_pengirimen`
--

CREATE TABLE `data_pengirimen` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `no_resi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_transaksi` date NOT NULL,
  `kode_customer` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_pengirim` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_penerima` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kota_tujuan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp_pengirim` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp_penerima` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `berat_barang` decimal(8,2) NOT NULL,
  `ongkir` int(11) NOT NULL,
  `komisi` int(11) NOT NULL,
  `status_pembayaran` int(11) NOT NULL COMMENT '1=Lunas, 2=Pending, 3=Tertagih',
  `metode_pembayaran` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bukti_pembayaran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_pengiriman` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bawa_sendiri` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_pengiriman` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `data_pengirimen`
--

INSERT INTO `data_pengirimen` (`id`, `no_resi`, `tgl_transaksi`, `kode_customer`, `nama_pengirim`, `nama_penerima`, `kota_tujuan`, `no_hp_pengirim`, `no_hp_penerima`, `berat_barang`, `ongkir`, `komisi`, `status_pembayaran`, `metode_pembayaran`, `bank`, `bukti_pembayaran`, `jenis_pengiriman`, `bawa_sendiri`, `status_pengiriman`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 'JHD1827183614', '2024-06-24', 'LP-001', 'Angga', 'Sadil', 'Bandung', '081627364536', '081726354728', '2.30', 26000, 6000, 1, 'Transfer', 'BRI', 'https://drive.google.com/file/d/1rlz8NoT_I5z39jfG_7XmV_AODeJWbgsL/view?usp=sharing', 'REGPACK', 'DI JEMPUT', 'BKD', '-', '2024-06-25 05:18:54', '2024-06-25 20:23:48'),
(2, 'JHD9183917419', '2024-06-24', 'General', 'Tono', 'Ramdan', 'Palembang', '087564637261', '081274657487', '1.00', 17000, 6000, 2, 'Transfer', 'BRI', 'https://drive.google.com/file/d/1cTYrHijN5tEx-Ls5GWJJ63faUtoWuGAK/view?usp=sharing', 'REGPACK', 'DI JEMPUT', 'BKD', '-', '2024-06-25 05:18:54', '2024-06-25 05:18:54'),
(3, 'JHD9138927422', '2024-06-24', 'LP-002', 'Anwar', 'Siska', 'Papua', '081254647587', '087364758676', '1.00', 40000, 4000, 2, 'Transfer', 'BRI', 'https://drive.google.com/file/d/1rlz8NoT_I5z39jfG_7XmV_AODeJWbgsL/view?usp=sharing', 'REGPACK', 'YA', 'BKD', '-', '2024-06-25 05:18:54', '2024-06-25 05:18:54'),
(4, 'JHD7927492748', '2024-06-24', 'General', 'Jo', 'Keli', 'Jambi', '08717267643', '082736457485', '1.50', 20000, 7000, 2, 'Transfer', 'BRI', 'https://drive.google.com/file/d/1cTYrHijN5tEx-Ls5GWJJ63faUtoWuGAK/view?usp=sharing', 'BOSSPACK', 'YA', 'BKD', '-', '2024-06-25 05:18:54', '2024-06-25 05:18:54'),
(5, 'JHD1827818614', '2024-06-24', 'General', 'Heru', 'Tello', 'Solo', '081672537485', '08172645362', '3.00', 35000, 5000, 2, 'Transfer', 'BRI', 'https://drive.google.com/file/d/1rlz8NoT_I5z39jfG_7XmV_AODeJWbgsL/view?usp=sharing', 'BOSSPACK', 'DI JEMPUT', 'BKD', '-', '2024-06-25 05:18:54', '2024-06-25 05:18:54');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `history_limits`
--

CREATE TABLE `history_limits` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `limit_kredit` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `history_limits`
--

INSERT INTO `history_limits` (`id`, `customer_id`, `limit_kredit`, `created_at`, `updated_at`) VALUES
(1, 2, 1000000, '2024-06-04 20:37:29', '2024-06-04 20:37:29'),
(2, 2, 500000, '2024-06-04 20:37:37', '2024-06-04 20:37:37'),
(3, 1, 3000000, '2024-06-04 20:38:13', '2024-06-04 20:38:13');

-- --------------------------------------------------------

--
-- Struktur dari tabel `invoices`
--

CREATE TABLE `invoices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoice_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_id` int(11) NOT NULL,
  `diskon` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `invoices`
--

INSERT INTO `invoices` (`id`, `invoice_no`, `customer_id`, `diskon`, `created_at`, `updated_at`) VALUES
(1, '1/INV/LP/2024', 1, 2000, '2024-06-24 02:32:07', '2024-06-24 02:32:38'),
(2, '2/INV/LP/2024', 2, 20000, '2024-06-25 04:55:13', '2024-06-25 05:01:12');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jasas`
--

CREATE TABLE `jasas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_jasa` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `jasas`
--

INSERT INTO `jasas` (`id`, `nama_jasa`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 'Jasa 1', 'Keterangan Jasa 1', '2024-06-26 07:36:10', '2024-06-26 07:36:10'),
(2, 'Jasa 2', 'Keterangan Jasa 2', '2024-06-26 07:36:10', '2024-06-26 07:36:10');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_pengeluarans`
--

CREATE TABLE `jenis_pengeluarans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `jenis_pengeluaran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `jenis_pengeluarans`
--

INSERT INTO `jenis_pengeluarans` (`id`, `jenis_pengeluaran`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 'Operasional', 'Pengeluaran Operasional', '2024-05-12 02:52:15', '2024-05-12 02:52:15'),
(2, 'Pengeluaran Lainnya', 'Pengeluaran Lainnya', '2024-05-12 02:52:35', '2024-05-12 02:52:35');

-- --------------------------------------------------------

--
-- Struktur dari tabel `konversi_points`
--

CREATE TABLE `konversi_points` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `point` int(11) NOT NULL,
  `nominal` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `konversi_points`
--

INSERT INTO `konversi_points` (`id`, `point`, `nominal`, `created_at`, `updated_at`) VALUES
(1, 1, 1000, '2024-05-20 23:20:15', '2024-05-20 23:26:39');

-- --------------------------------------------------------

--
-- Struktur dari tabel `levels`
--

CREATE TABLE `levels` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `level` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `deskripsi` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `levels`
--

INSERT INTO `levels` (`id`, `level`, `created_at`, `updated_at`, `deskripsi`) VALUES
(1, 'Administrator', '2024-01-23 03:07:41', '2024-01-23 03:07:41', NULL),
(2, 'Owner', '2024-01-23 03:07:41', '2024-01-23 03:07:41', NULL),
(3, 'Customer', '2024-01-23 03:07:41', '2024-01-23 03:07:41', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `log_activities`
--

CREATE TABLE `log_activities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `log_time` datetime NOT NULL,
  `activity` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `ip_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `browser` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `log_activities`
--

INSERT INTO `log_activities` (`id`, `username`, `log_time`, `activity`, `created_at`, `updated_at`, `ip_address`, `browser`) VALUES
(1, 'admin01', '2024-04-22 11:36:41', 'Logout aplikasi', '2024-04-22 04:36:41', '2024-04-22 04:36:41', '192.168.5.83', 'Google Chrome on mac'),
(2, 'admin01', '2024-04-22 11:36:44', 'Login aplikasi', '2024-04-22 04:36:44', '2024-04-22 04:36:44', '192.168.5.83', 'Google Chrome on mac'),
(3, 'admin01', '2024-04-22 13:38:36', 'Login aplikasi', '2024-04-22 06:38:36', '2024-04-22 06:38:36', '192.168.4.76', 'Google Chrome on mac'),
(4, 'admin01', '2024-04-22 15:22:56', 'Logout aplikasi', '2024-04-22 08:22:56', '2024-04-22 08:22:56', '192.168.5.83', 'Google Chrome on mac'),
(5, 'admin01', '2024-04-22 16:05:06', 'Login aplikasi', '2024-04-22 09:05:06', '2024-04-22 09:05:06', '192.168.5.83', 'Google Chrome on mac'),
(6, 'admin01', '2024-04-22 16:36:49', 'Login aplikasi', '2024-04-22 09:36:49', '2024-04-22 09:36:49', '192.168.4.76', 'Google Chrome on mac'),
(7, 'admin01', '2024-04-22 21:11:17', 'Login aplikasi', '2024-04-22 14:11:17', '2024-04-22 14:11:17', '116.206.29.66', 'Google Chrome on mac'),
(8, 'admin01', '2024-04-23 09:57:26', 'Login aplikasi', '2024-04-23 02:57:26', '2024-04-23 02:57:26', '192.168.5.83', 'Google Chrome on mac'),
(9, 'admin01', '2024-04-23 11:49:42', 'Login aplikasi', '2024-04-23 04:49:42', '2024-04-23 04:49:42', '192.168.5.105', 'Google Chrome on mac'),
(10, 'admin01', '2024-04-23 12:00:01', 'Armada berhasil dihubungkan dengan obd Yamaha', '2024-04-23 05:00:01', '2024-04-23 05:00:01', '192.168.5.83', 'Google Chrome on mac'),
(11, 'admin01', '2024-04-23 14:21:01', 'Login aplikasi', '2024-04-23 07:21:01', '2024-04-23 07:21:01', '192.168.5.83', 'Google Chrome on mac'),
(12, 'admin01', '2024-04-23 15:16:17', 'Login aplikasi', '2024-04-23 08:16:17', '2024-04-23 08:16:17', '192.168.5.105', 'Google Chrome on mac'),
(13, 'admin01', '2024-04-24 08:55:51', 'Login aplikasi', '2024-04-24 01:55:51', '2024-04-24 01:55:51', '192.168.1.26', 'Mozilla Firefox on windows'),
(14, 'admin01', '2024-04-24 09:02:04', 'Login aplikasi', '2024-04-24 02:02:04', '2024-04-24 02:02:04', '192.168.5.105', 'Google Chrome on mac'),
(15, 'admin01', '2024-04-24 09:22:52', 'Armada berhasil dihubungkan dengan obd Yamaha', '2024-04-24 02:22:52', '2024-04-24 02:22:52', '192.168.5.105', 'Google Chrome on mac'),
(16, 'admin01', '2024-04-24 09:25:34', 'Armada berhasil dihubungkan dengan obd Yamaha', '2024-04-24 02:25:34', '2024-04-24 02:25:34', '192.168.5.105', 'Google Chrome on mac'),
(17, 'admin01', '2024-04-24 09:31:17', 'Armada berhasil dihubungkan dengan obd Yamaha', '2024-04-24 02:31:17', '2024-04-24 02:31:17', '192.168.4.76', 'Google Chrome on mac'),
(18, 'admin01', '2024-04-24 09:31:25', 'Obd berhasil dilepaskan dari armada', '2024-04-24 02:31:25', '2024-04-24 02:31:25', '192.168.4.76', 'Google Chrome on mac'),
(19, 'admin01', '2024-04-24 09:32:16', 'Armada berhasil dihubungkan dengan obd Yamaha', '2024-04-24 02:32:16', '2024-04-24 02:32:16', '192.168.4.76', 'Google Chrome on mac'),
(20, 'admin01', '2024-04-24 09:32:39', 'Armada berhasil dihubungkan dengan obd GPSKU', '2024-04-24 02:32:39', '2024-04-24 02:32:39', '192.168.4.76', 'Google Chrome on mac'),
(21, 'admin01', '2024-04-24 09:32:48', 'Obd berhasil dilepaskan dari armada', '2024-04-24 02:32:48', '2024-04-24 02:32:48', '192.168.4.76', 'Google Chrome on mac'),
(22, 'admin01', '2024-04-24 13:07:56', 'Mesin Innova RebornB 7890 SHU berhasil dihidupkan', '2024-04-24 06:07:56', '2024-04-24 06:07:56', '192.168.4.76', 'Google Chrome on mac'),
(23, 'admin01', '2024-04-24 13:14:47', 'Mesin Innova RebornB 7890 SHU berhasil dimatikan', '2024-04-24 06:14:47', '2024-04-24 06:14:47', '192.168.4.76', 'Google Chrome on mac'),
(24, 'admin01', '2024-04-24 13:14:52', 'Obd berhasil dilepaskan dari armada', '2024-04-24 06:14:52', '2024-04-24 06:14:52', '192.168.4.76', 'Google Chrome on mac'),
(25, 'admin01', '2024-04-24 13:49:05', 'Armada berhasil dihubungkan dengan obd GPSKU', '2024-04-24 06:49:05', '2024-04-24 06:49:05', '192.168.4.76', 'Google Chrome on mac'),
(26, 'admin01', '2024-04-24 14:02:12', 'Mesin Innova RebornB 7890 SHU berhasil dihidupkan', '2024-04-24 07:02:12', '2024-04-24 07:02:12', '192.168.4.76', 'Google Chrome on mac'),
(27, 'admin01', '2024-04-24 14:03:01', 'Mesin Innova RebornB 7890 SHU berhasil dimatikan', '2024-04-24 07:03:01', '2024-04-24 07:03:01', '192.168.4.76', 'Google Chrome on mac'),
(28, 'admin01', '2024-04-24 14:03:15', 'Login aplikasi', '2024-04-24 07:03:15', '2024-04-24 07:03:15', '192.168.4.76', 'Google Chrome on mac'),
(29, 'admin01', '2024-04-24 14:03:28', 'Mesin Innova RebornB 7890 SHU berhasil dihidupkan', '2024-04-24 07:03:28', '2024-04-24 07:03:28', '192.168.4.76', 'Google Chrome on mac'),
(30, 'admin01', '2024-04-24 14:04:10', 'Mesin Innova RebornB 7890 SHU berhasil dimatikan', '2024-04-24 07:04:10', '2024-04-24 07:04:10', '192.168.4.76', 'Google Chrome on mac'),
(31, 'admin01', '2024-04-24 14:05:25', 'Obd berhasil dilepaskan dari armada', '2024-04-24 07:05:25', '2024-04-24 07:05:25', '192.168.4.76', 'Google Chrome on mac'),
(32, 'admin01', '2024-04-24 14:05:38', 'Armada berhasil dihubungkan dengan obd GPSKU', '2024-04-24 07:05:38', '2024-04-24 07:05:38', '192.168.4.76', 'Google Chrome on mac'),
(33, 'admin01', '2024-04-24 14:06:23', 'Armada berhasil dihubungkan dengan obd GPSKU', '2024-04-24 07:06:23', '2024-04-24 07:06:23', '192.168.4.76', 'Google Chrome on mac'),
(34, 'admin01', '2024-04-24 14:06:43', 'Mesin Innova RebornB 7890 SHU berhasil dihidupkan', '2024-04-24 07:06:43', '2024-04-24 07:06:43', '192.168.4.76', 'Google Chrome on mac'),
(35, 'admin01', '2024-04-24 14:07:20', 'Login aplikasi', '2024-04-24 07:07:20', '2024-04-24 07:07:20', '192.168.4.76', 'Mozilla Firefox on mac'),
(36, 'admin01', '2024-04-24 14:07:27', 'Mesin Innova RebornB 7890 SHU berhasil dimatikan', '2024-04-24 07:07:27', '2024-04-24 07:07:27', '192.168.4.76', 'Mozilla Firefox on mac'),
(37, 'admin01', '2024-04-24 15:13:56', 'Login aplikasi', '2024-04-24 08:13:56', '2024-04-24 08:13:56', '192.168.4.76', 'Google Chrome on mac'),
(38, 'admin01', '2024-04-24 15:14:05', 'Mesin Innova RebornB 7890 SHU berhasil dihidupkan', '2024-04-24 08:14:05', '2024-04-24 08:14:05', '192.168.4.76', 'Google Chrome on mac'),
(39, 'admin01', '2024-04-24 16:17:30', 'Mesin Innova Reborn (B 7890 SHU) berhasil dimatikan', '2024-04-24 09:17:30', '2024-04-24 09:17:30', '192.168.5.105', 'Google Chrome on mac'),
(40, 'admin01', '2024-04-25 11:21:17', 'Login aplikasi', '2024-04-25 04:21:17', '2024-04-25 04:21:17', '192.168.4.76', 'Google Chrome on mac'),
(41, 'admin01', '2024-04-25 11:40:58', 'Logout aplikasi', '2024-04-25 04:40:58', '2024-04-25 04:40:58', '192.168.4.76', 'Google Chrome on mac'),
(42, 'admin01', '2024-04-25 11:41:02', 'Login aplikasi', '2024-04-25 04:41:02', '2024-04-25 04:41:02', '192.168.4.76', 'Google Chrome on mac'),
(43, 'admin01', '2024-04-25 11:41:29', 'Login aplikasi', '2024-04-25 04:41:29', '2024-04-25 04:41:29', '192.168.4.76', 'Google Chrome on mac'),
(44, 'admin01', '2024-04-25 13:58:48', 'Login aplikasi', '2024-04-25 06:58:48', '2024-04-25 06:58:48', '192.168.5.89', 'Google Chrome on mac'),
(45, 'admin01', '2024-04-25 16:34:32', 'Login aplikasi', '2024-04-25 09:34:32', '2024-04-25 09:34:32', '192.168.4.76', 'Google Chrome on mac'),
(46, 'admin01', '2024-04-26 06:42:06', 'Login aplikasi', '2024-04-25 23:42:06', '2024-04-25 23:42:06', '103.157.24.30', 'Google Chrome on mac'),
(47, 'admin01', '2024-04-26 06:42:28', 'Mesin Innova Reborn (B 7890 SHU) berhasil dihidupkan', '2024-04-25 23:42:28', '2024-04-25 23:42:28', '103.157.24.30', 'Google Chrome on mac'),
(48, 'admin01', '2024-04-26 06:42:33', 'Mesin Innova Reborn (B 7890 SHU) berhasil dimatikan', '2024-04-25 23:42:33', '2024-04-25 23:42:33', '103.157.24.30', 'Google Chrome on mac'),
(49, 'admin01', '2024-04-26 06:46:20', 'Obd berhasil dilepaskan dari armada', '2024-04-25 23:46:20', '2024-04-25 23:46:20', '103.157.24.30', 'Google Chrome on mac'),
(50, 'admin01', '2024-04-26 07:01:14', 'Logout aplikasi', '2024-04-26 00:01:14', '2024-04-26 00:01:14', '103.157.24.30', 'Google Chrome on mac'),
(51, 'admin01', '2024-04-27 23:06:22', 'Login aplikasi', '2024-04-27 16:06:22', '2024-04-27 16:06:22', '182.3.38.54', 'Google Chrome on mac'),
(52, 'admin01', '2024-04-29 08:43:55', 'Login aplikasi', '2024-04-29 01:43:55', '2024-04-29 01:43:55', '192.168.5.83', 'Google Chrome on mac'),
(53, 'admin01', '2024-04-29 09:28:06', 'Login aplikasi', '2024-04-29 02:28:06', '2024-04-29 02:28:06', '192.168.4.76', 'Google Chrome on mac'),
(54, 'admin01', '2024-04-29 10:02:32', 'Armada berhasil dihubungkan dengan obd Yamaha', '2024-04-29 03:02:32', '2024-04-29 03:02:32', '192.168.5.83', 'Google Chrome on mac'),
(55, 'admin01', '2024-04-29 10:02:32', 'Armada berhasil dihubungkan dengan obd Yamaha', '2024-04-29 03:02:32', '2024-04-29 03:02:32', '192.168.5.83', 'Google Chrome on mac'),
(56, 'admin01', '2024-04-29 11:06:34', 'Logout aplikasi', '2024-04-29 04:06:34', '2024-04-29 04:06:34', '192.168.5.83', 'Google Chrome on mac'),
(57, 'admin01', '2024-04-29 11:12:54', 'Login aplikasi', '2024-04-29 04:12:54', '2024-04-29 04:12:54', '192.168.5.83', 'Google Chrome on mac'),
(58, 'admin01', '2024-04-29 15:22:47', 'Login aplikasi', '2024-04-29 08:22:47', '2024-04-29 08:22:47', '192.168.5.66', 'Google Chrome on mac'),
(59, 'admin01', '2024-04-29 15:28:51', 'Login aplikasi', '2024-04-29 08:28:51', '2024-04-29 08:28:51', '192.168.5.83', 'Google Chrome on mac'),
(60, 'admin01', '2024-04-30 09:16:15', 'Login aplikasi', '2024-04-30 02:16:15', '2024-04-30 02:16:15', '192.168.5.83', 'Google Chrome on mac'),
(61, 'admin01', '2024-04-30 10:14:02', 'Login aplikasi', '2024-04-30 03:14:02', '2024-04-30 03:14:02', '192.168.4.76', 'Google Chrome on mac'),
(62, 'admin01', '2024-04-30 14:20:01', 'Login aplikasi', '2024-04-30 07:20:01', '2024-04-30 07:20:01', '192.168.4.76', 'Google Chrome on mac'),
(63, 'admin01', '2024-04-30 15:15:49', 'Login aplikasi', '2024-04-30 08:15:49', '2024-04-30 08:15:49', '127.0.0.1', 'Google Chrome on mac'),
(64, 'admin01', '2024-04-30 15:47:56', 'Logout aplikasi', '2024-04-30 08:47:56', '2024-04-30 08:47:56', '127.0.0.1', 'Google Chrome on mac'),
(65, 'admin01', '2024-04-30 15:48:12', 'Login aplikasi', '2024-04-30 08:48:12', '2024-04-30 08:48:12', '127.0.0.1', 'Google Chrome on mac'),
(66, 'admin01', '2024-04-30 16:03:29', 'Logout aplikasi', '2024-04-30 09:03:29', '2024-04-30 09:03:29', '127.0.0.1', 'Google Chrome on mac'),
(67, 'admin01', '2024-04-30 16:10:08', 'Login aplikasi', '2024-04-30 09:10:08', '2024-04-30 09:10:08', '127.0.0.1', 'Google Chrome on mac'),
(68, 'admin01', '2024-04-30 16:10:13', 'Logout aplikasi', '2024-04-30 09:10:13', '2024-04-30 09:10:13', '127.0.0.1', 'Google Chrome on mac'),
(69, 'admin01', '2024-04-30 16:24:11', 'Login aplikasi', '2024-04-30 09:24:11', '2024-04-30 09:24:11', '127.0.0.1', 'Google Chrome on mac'),
(70, 'admin01', '2024-04-30 16:28:19', 'Logout aplikasi', '2024-04-30 09:28:19', '2024-04-30 09:28:19', '127.0.0.1', 'Google Chrome on mac'),
(71, 'anwar11', '2024-04-30 16:28:27', 'Login aplikasi', '2024-04-30 09:28:27', '2024-04-30 09:28:27', '127.0.0.1', 'Google Chrome on mac'),
(72, 'anwar11', '2024-04-30 16:28:40', 'Logout aplikasi', '2024-04-30 09:28:40', '2024-04-30 09:28:40', '127.0.0.1', 'Google Chrome on mac'),
(73, 'admin01', '2024-04-30 16:29:06', 'Login aplikasi', '2024-04-30 09:29:06', '2024-04-30 09:29:06', '127.0.0.1', 'Google Chrome on mac'),
(74, 'admin01', '2024-04-30 17:40:51', 'Logout aplikasi', '2024-04-30 10:40:51', '2024-04-30 10:40:51', '127.0.0.1', 'Google Chrome on mac'),
(75, 'admin01', '2024-04-30 17:41:08', 'Login aplikasi', '2024-04-30 10:41:08', '2024-04-30 10:41:08', '127.0.0.1', 'Google Chrome on mac'),
(76, 'admin01', '2024-04-30 17:56:57', 'Logout aplikasi', '2024-04-30 10:56:57', '2024-04-30 10:56:57', '127.0.0.1', 'Google Chrome on mac'),
(77, 'admin01', '2024-04-30 17:57:05', 'Login aplikasi', '2024-04-30 10:57:05', '2024-04-30 10:57:05', '127.0.0.1', 'Google Chrome on mac'),
(78, 'admin01', '2024-05-01 05:05:11', 'Login aplikasi', '2024-04-30 22:05:11', '2024-04-30 22:05:11', '127.0.0.1', 'Google Chrome on mac'),
(79, 'admin01', '2024-05-01 05:11:38', 'Simpan data pengiriman dengan no resi : 09309230902', '2024-04-30 22:11:38', '2024-04-30 22:11:38', '127.0.0.1', 'Google Chrome on mac'),
(80, 'admin01', '2024-05-01 05:12:26', 'Data status pembayaran berhasi diperbarui', '2024-04-30 22:12:26', '2024-04-30 22:12:26', '127.0.0.1', 'Google Chrome on mac'),
(81, 'admin01', '2024-05-01 05:12:32', 'Data status pembayaran berhasi diperbarui', '2024-04-30 22:12:32', '2024-04-30 22:12:32', '127.0.0.1', 'Google Chrome on mac'),
(82, 'admin01', '2024-05-01 05:13:34', 'Logout aplikasi', '2024-04-30 22:13:34', '2024-04-30 22:13:34', '127.0.0.1', 'Google Chrome on mac'),
(83, 'admin01', '2024-05-01 05:14:00', 'Login aplikasi', '2024-04-30 22:14:00', '2024-04-30 22:14:00', '127.0.0.1', 'Google Chrome on mac'),
(84, 'admin01', '2024-05-01 05:14:43', 'Update data foto profil: admin01', '2024-04-30 22:14:43', '2024-04-30 22:14:43', '127.0.0.1', 'Google Chrome on mac'),
(85, 'admin01', '2024-05-01 05:17:22', 'Logout aplikasi', '2024-04-30 22:17:22', '2024-04-30 22:17:22', '127.0.0.1', 'Google Chrome on mac'),
(86, 'admin01', '2024-05-01 05:18:13', 'Login aplikasi', '2024-04-30 22:18:13', '2024-04-30 22:18:13', '127.0.0.1', 'Google Chrome on mac'),
(87, 'admin01', '2024-05-01 05:19:28', 'Update data pengguna dengan username : admin01', '2024-04-30 22:19:28', '2024-04-30 22:19:28', '127.0.0.1', 'Google Chrome on mac'),
(88, 'admin01', '2024-05-01 05:19:52', 'Logout aplikasi', '2024-04-30 22:19:52', '2024-04-30 22:19:52', '127.0.0.1', 'Google Chrome on mac'),
(89, 'admin01', '2024-05-01 05:19:54', 'Login aplikasi', '2024-04-30 22:19:54', '2024-04-30 22:19:54', '127.0.0.1', 'Google Chrome on mac'),
(90, 'admin01', '2024-05-01 05:20:48', 'Update data pengguna dengan username : admin01', '2024-04-30 22:20:48', '2024-04-30 22:20:48', '127.0.0.1', 'Google Chrome on mac'),
(91, 'admin01', '2024-05-01 05:21:02', 'Logout aplikasi', '2024-04-30 22:21:02', '2024-04-30 22:21:02', '127.0.0.1', 'Google Chrome on mac'),
(92, 'admin01', '2024-05-01 05:21:04', 'Login aplikasi', '2024-04-30 22:21:04', '2024-04-30 22:21:04', '127.0.0.1', 'Google Chrome on mac'),
(93, 'admin01', '2024-05-01 05:53:28', 'Hapus data pengguna dengan username : anwar11', '2024-04-30 22:53:28', '2024-04-30 22:53:28', '127.0.0.1', 'Google Chrome on mac'),
(94, 'admin01', '2024-05-01 05:53:34', 'Hapus data pengguna dengan username : shinta', '2024-04-30 22:53:34', '2024-04-30 22:53:34', '127.0.0.1', 'Google Chrome on mac'),
(95, 'admin01', '2024-05-01 05:53:37', 'Hapus data pengguna dengan username : muneeb', '2024-04-30 22:53:37', '2024-04-30 22:53:37', '127.0.0.1', 'Google Chrome on mac'),
(96, 'admin01', '2024-05-01 05:53:59', 'Logout aplikasi', '2024-04-30 22:53:59', '2024-04-30 22:53:59', '127.0.0.1', 'Google Chrome on mac'),
(97, 'admin01', '2024-05-01 05:54:09', 'Login aplikasi', '2024-04-30 22:54:09', '2024-04-30 22:54:09', '127.0.0.1', 'Google Chrome on mac'),
(98, 'admin01', '2024-05-01 05:57:35', 'Logout aplikasi', '2024-04-30 22:57:35', '2024-04-30 22:57:35', '127.0.0.1', 'Google Chrome on mac'),
(99, 'admin01', '2024-05-01 05:57:39', 'Login aplikasi', '2024-04-30 22:57:39', '2024-04-30 22:57:39', '127.0.0.1', 'Google Chrome on mac'),
(100, 'admin01', '2024-05-01 05:58:05', 'Logout aplikasi', '2024-04-30 22:58:05', '2024-04-30 22:58:05', '127.0.0.1', 'Google Chrome on mac'),
(101, 'admin01', '2024-05-01 05:58:22', 'Login aplikasi', '2024-04-30 22:58:22', '2024-04-30 22:58:22', '127.0.0.1', 'Google Chrome on mac'),
(102, 'admin01', '2024-05-01 06:14:42', 'Logout aplikasi', '2024-04-30 23:14:42', '2024-04-30 23:14:42', '127.0.0.1', 'Google Chrome on mac'),
(103, 'admin01', '2024-05-01 06:23:01', 'Login aplikasi', '2024-04-30 23:23:01', '2024-04-30 23:23:01', '127.0.0.1', 'Google Chrome on mac'),
(104, 'admin01', '2024-05-01 18:50:51', 'Login aplikasi', '2024-05-01 11:50:51', '2024-05-01 11:50:51', '127.0.0.1', 'Google Chrome on mac'),
(105, 'admin01', '2024-05-01 18:53:47', 'Logout aplikasi', '2024-05-01 11:53:47', '2024-05-01 11:53:47', '127.0.0.1', 'Google Chrome on mac'),
(106, 'admin01', '2024-05-01 18:54:08', 'Login aplikasi', '2024-05-01 11:54:08', '2024-05-01 11:54:08', '127.0.0.1', 'Google Chrome on mac'),
(107, 'admin01', '2024-05-02 09:12:16', 'Login aplikasi', '2024-05-02 02:12:16', '2024-05-02 02:12:16', '127.0.0.1', 'Google Chrome on mac'),
(108, 'admin01', '2024-05-02 09:12:20', 'Logout aplikasi', '2024-05-02 02:12:20', '2024-05-02 02:12:20', '127.0.0.1', 'Google Chrome on mac'),
(109, 'admin01', '2024-05-02 09:20:17', 'Login aplikasi', '2024-05-02 02:20:17', '2024-05-02 02:20:17', '127.0.0.1', 'Google Chrome on mac'),
(110, 'admin01', '2024-05-02 09:23:42', 'Update data pengiriman dengan no resi : JHD1827183614', '2024-05-02 02:23:42', '2024-05-02 02:23:42', '127.0.0.1', 'Google Chrome on mac'),
(111, 'admin01', '2024-05-02 09:24:12', 'Update data pengiriman dengan no resi : JHD1827183614', '2024-05-02 02:24:12', '2024-05-02 02:24:12', '127.0.0.1', 'Google Chrome on mac'),
(112, 'admin01', '2024-05-02 09:24:22', 'Update data pengiriman dengan no resi : JHD1827183614', '2024-05-02 02:24:22', '2024-05-02 02:24:22', '127.0.0.1', 'Google Chrome on mac'),
(113, 'admin01', '2024-05-02 10:40:11', 'Update data pengguna dengan username : admin01', '2024-05-02 03:40:11', '2024-05-02 03:40:11', '127.0.0.1', 'Google Chrome on mac'),
(114, 'admin01', '2024-05-02 10:42:50', 'Update data pengguna dengan username : admin01', '2024-05-02 03:42:50', '2024-05-02 03:42:50', '127.0.0.1', 'Google Chrome on mac'),
(115, 'admin01', '2024-05-02 10:50:27', 'Simpan data pengguna dengan username : shinta', '2024-05-02 03:50:27', '2024-05-02 03:50:27', '127.0.0.1', 'Google Chrome on mac'),
(116, 'admin01', '2024-05-02 10:54:27', 'Simpan data pengguna dengan username : heru27', '2024-05-02 03:54:27', '2024-05-02 03:54:27', '127.0.0.1', 'Google Chrome on mac'),
(117, 'admin01', '2024-05-02 10:55:53', 'Simpan data pengguna dengan username : angga86', '2024-05-02 03:55:53', '2024-05-02 03:55:53', '127.0.0.1', 'Google Chrome on mac'),
(118, 'admin01', '2024-05-02 11:50:24', 'Update data pengiriman dengan no resi : JHD1827818614', '2024-05-02 04:50:24', '2024-05-02 04:50:24', '127.0.0.1', 'Google Chrome on mac'),
(119, 'admin01', '2024-05-02 11:51:14', 'Update data pengiriman dengan no resi : JHD1827818614', '2024-05-02 04:51:14', '2024-05-02 04:51:14', '127.0.0.1', 'Google Chrome on mac'),
(120, 'admin01', '2024-05-02 11:54:07', 'Update data pengiriman dengan no resi : JHD1827818614', '2024-05-02 04:54:07', '2024-05-02 04:54:07', '127.0.0.1', 'Google Chrome on mac'),
(121, 'admin01', '2024-05-02 11:58:08', 'Update data pengiriman dengan no resi : JHD1827818614', '2024-05-02 04:58:08', '2024-05-02 04:58:08', '127.0.0.1', 'Google Chrome on mac'),
(122, 'admin01', '2024-05-02 11:59:46', 'Update data pengiriman dengan no resi : JHD1827818614', '2024-05-02 04:59:46', '2024-05-02 04:59:46', '127.0.0.1', 'Google Chrome on mac'),
(123, 'admin01', '2024-05-02 12:00:35', 'Data status pembayaran berhasi diperbarui', '2024-05-02 05:00:35', '2024-05-02 05:00:35', '127.0.0.1', 'Google Chrome on mac'),
(124, 'admin01', '2024-05-02 12:00:39', 'Data status pembayaran berhasi diperbarui', '2024-05-02 05:00:39', '2024-05-02 05:00:39', '127.0.0.1', 'Google Chrome on mac'),
(125, 'admin01', '2024-05-02 12:01:20', 'Logout aplikasi', '2024-05-02 05:01:20', '2024-05-02 05:01:20', '127.0.0.1', 'Google Chrome on mac'),
(126, 'admin01', '2024-05-02 12:01:24', 'Login aplikasi', '2024-05-02 05:01:24', '2024-05-02 05:01:24', '127.0.0.1', 'Google Chrome on mac'),
(127, 'admin01', '2024-05-02 16:22:17', 'Update data pengiriman dengan no resi : JHD1827818614', '2024-05-02 09:22:17', '2024-05-02 09:22:17', '127.0.0.1', 'Google Chrome on mac'),
(128, 'admin01', '2024-05-02 16:57:29', 'Logout aplikasi', '2024-05-02 09:57:29', '2024-05-02 09:57:29', '127.0.0.1', 'Google Chrome on mac'),
(129, 'shinta', '2024-05-02 16:57:39', 'Login aplikasi', '2024-05-02 09:57:39', '2024-05-02 09:57:39', '127.0.0.1', 'Google Chrome on mac'),
(130, 'shinta', '2024-05-02 16:57:47', 'Logout aplikasi', '2024-05-02 09:57:47', '2024-05-02 09:57:47', '127.0.0.1', 'Google Chrome on mac'),
(131, 'admin01', '2024-05-02 16:57:57', 'Login aplikasi', '2024-05-02 09:57:57', '2024-05-02 09:57:57', '127.0.0.1', 'Google Chrome on mac'),
(132, 'admin01', '2024-05-02 17:19:05', 'Simpan daftar pengeluaran', '2024-05-02 10:19:05', '2024-05-02 10:19:05', '127.0.0.1', 'Google Chrome on mac'),
(133, 'admin01', '2024-05-02 17:25:12', 'Logout aplikasi', '2024-05-02 10:25:12', '2024-05-02 10:25:12', '127.0.0.1', 'Google Chrome on mac'),
(134, 'admin01', '2024-05-02 17:25:54', 'Login aplikasi', '2024-05-02 10:25:54', '2024-05-02 10:25:54', '127.0.0.1', 'Google Chrome on mac'),
(135, 'admin01', '2024-05-02 17:26:29', 'Logout aplikasi', '2024-05-02 10:26:29', '2024-05-02 10:26:29', '127.0.0.1', 'Google Chrome on mac'),
(136, 'admin01', '2024-05-02 20:15:33', 'Login aplikasi', '2024-05-02 13:15:33', '2024-05-02 13:15:33', '127.0.0.1', 'Google Chrome on mac'),
(137, 'admin01', '2024-05-02 20:17:15', 'Logout aplikasi', '2024-05-02 13:17:15', '2024-05-02 13:17:15', '127.0.0.1', 'Google Chrome on mac'),
(138, 'admin01', '2024-05-03 15:07:35', 'Login aplikasi', '2024-05-03 08:07:35', '2024-05-03 08:07:35', '127.0.0.1', 'Google Chrome on mac'),
(139, 'admin01', '2024-05-04 09:40:35', 'Login aplikasi', '2024-05-04 02:40:35', '2024-05-04 02:40:35', '127.0.0.1', 'Google Chrome on mac'),
(140, 'admin01', '2024-05-04 12:56:41', 'Login aplikasi', '2024-05-04 05:56:41', '2024-05-04 05:56:41', '127.0.0.1', 'Google Chrome on mac'),
(141, 'admin01', '2024-05-04 14:07:58', 'Logout aplikasi', '2024-05-04 07:07:58', '2024-05-04 07:07:58', '127.0.0.1', 'Google Chrome on mac'),
(142, 'admin01', '2024-05-04 14:08:03', 'Login aplikasi', '2024-05-04 07:08:03', '2024-05-04 07:08:03', '127.0.0.1', 'Google Chrome on mac'),
(143, 'admin01', '2024-05-04 15:15:21', 'Simpan data pemasukan', '2024-05-04 08:15:21', '2024-05-04 08:15:21', '127.0.0.1', 'Google Chrome on mac'),
(144, 'admin01', '2024-05-04 16:29:26', 'Simpan data pemasukan', '2024-05-04 09:29:26', '2024-05-04 09:29:26', '127.0.0.1', 'Google Chrome on mac'),
(145, 'admin01', '2024-05-04 16:53:54', 'Update data pemasukan dengan id: 1', '2024-05-04 09:53:54', '2024-05-04 09:53:54', '127.0.0.1', 'Google Chrome on mac'),
(146, 'admin01', '2024-05-04 17:06:07', 'Hapus data pemasukan dengan id : 1', '2024-05-04 10:06:07', '2024-05-04 10:06:07', '127.0.0.1', 'Google Chrome on mac'),
(147, 'admin01', '2024-05-04 17:10:23', 'Ubah profile pengguna dengan username : admin01', '2024-05-04 10:10:23', '2024-05-04 10:10:23', '127.0.0.1', 'Google Chrome on mac'),
(148, 'admin01', '2024-05-04 17:10:32', 'Logout aplikasi', '2024-05-04 10:10:32', '2024-05-04 10:10:32', '127.0.0.1', 'Google Chrome on mac'),
(149, 'admin01', '2024-05-04 17:10:33', 'Login aplikasi', '2024-05-04 10:10:33', '2024-05-04 10:10:33', '127.0.0.1', 'Google Chrome on mac'),
(150, 'admin01', '2024-05-04 17:36:54', 'Simpan Data Supplier', '2024-05-04 10:36:54', '2024-05-04 10:36:54', '127.0.0.1', 'Google Chrome on mac'),
(151, 'admin01', '2024-05-04 17:37:07', 'Update data supplier Supplier 1', '2024-05-04 10:37:07', '2024-05-04 10:37:07', '127.0.0.1', 'Google Chrome on mac'),
(152, 'admin01', '2024-05-04 17:37:15', 'Update data supplier Supplier 1', '2024-05-04 10:37:15', '2024-05-04 10:37:15', '127.0.0.1', 'Google Chrome on mac'),
(153, 'admin01', '2024-05-04 17:42:07', 'Logout aplikasi', '2024-05-04 10:42:07', '2024-05-04 10:42:07', '127.0.0.1', 'Google Chrome on mac'),
(154, 'angga86', '2024-05-04 17:42:16', 'Login aplikasi', '2024-05-04 10:42:16', '2024-05-04 10:42:16', '127.0.0.1', 'Google Chrome on mac'),
(155, 'angga86', '2024-05-04 17:42:21', 'Logout aplikasi', '2024-05-04 10:42:21', '2024-05-04 10:42:21', '127.0.0.1', 'Google Chrome on mac'),
(156, 'heru27', '2024-05-04 17:42:34', 'Login aplikasi', '2024-05-04 10:42:34', '2024-05-04 10:42:34', '127.0.0.1', 'Google Chrome on mac'),
(157, 'heru27', '2024-05-04 17:42:38', 'Logout aplikasi', '2024-05-04 10:42:38', '2024-05-04 10:42:38', '127.0.0.1', 'Google Chrome on mac'),
(158, 'admin01', '2024-05-04 17:42:39', 'Login aplikasi', '2024-05-04 10:42:39', '2024-05-04 10:42:39', '127.0.0.1', 'Google Chrome on mac'),
(159, 'admin01', '2024-05-04 17:48:13', 'Logout aplikasi', '2024-05-04 10:48:13', '2024-05-04 10:48:13', '127.0.0.1', 'Google Chrome on mac'),
(160, 'admin01', '2024-05-04 17:48:34', 'Login aplikasi', '2024-05-04 10:48:34', '2024-05-04 10:48:34', '127.0.0.1', 'Google Chrome on mac'),
(161, 'admin01', '2024-05-04 17:48:49', 'Logout aplikasi', '2024-05-04 10:48:49', '2024-05-04 10:48:49', '127.0.0.1', 'Google Chrome on mac'),
(162, 'admin01', '2024-05-04 17:48:57', 'Login aplikasi', '2024-05-04 10:48:57', '2024-05-04 10:48:57', '127.0.0.1', 'Google Chrome on mac'),
(163, 'admin01', '2024-05-04 17:49:15', 'Logout aplikasi', '2024-05-04 10:49:15', '2024-05-04 10:49:15', '127.0.0.1', 'Google Chrome on mac'),
(164, 'admin01', '2024-05-06 16:47:31', 'Login aplikasi', '2024-05-06 09:47:31', '2024-05-06 09:47:31', '127.0.0.1', 'Google Chrome on mac'),
(165, 'admin01', '2024-05-06 16:47:48', 'Logout aplikasi', '2024-05-06 09:47:48', '2024-05-06 09:47:48', '127.0.0.1', 'Google Chrome on mac'),
(166, 'admin01', '2024-05-07 17:41:27', 'Login aplikasi', '2024-05-07 10:41:27', '2024-05-07 10:41:27', '127.0.0.1', 'Google Chrome on mac'),
(167, 'admin01', '2024-05-07 17:48:26', 'Logout aplikasi', '2024-05-07 10:48:26', '2024-05-07 10:48:26', '127.0.0.1', 'Google Chrome on mac'),
(168, 'admin01', '2024-05-07 17:48:37', 'Login aplikasi', '2024-05-07 10:48:37', '2024-05-07 10:48:37', '127.0.0.1', 'Google Chrome on mac'),
(169, 'admin01', '2024-05-07 17:50:57', 'Logout aplikasi', '2024-05-07 10:50:57', '2024-05-07 10:50:57', '127.0.0.1', 'Google Chrome on mac'),
(170, 'admin01', '2024-05-07 18:14:15', 'Login aplikasi', '2024-05-07 11:14:15', '2024-05-07 11:14:15', '127.0.0.1', 'Google Chrome on mac'),
(171, 'admin01', '2024-05-07 18:18:18', 'Logout aplikasi', '2024-05-07 11:18:18', '2024-05-07 11:18:18', '127.0.0.1', 'Google Chrome on mac'),
(172, 'admin01', '2024-05-07 18:19:00', 'Login aplikasi', '2024-05-07 11:19:00', '2024-05-07 11:19:00', '127.0.0.1', 'Google Chrome on mac'),
(173, 'admin01', '2024-05-07 18:30:35', 'Update data pengiriman dengan no resi : JHD1827818614', '2024-05-07 11:30:35', '2024-05-07 11:30:35', '127.0.0.1', 'Google Chrome on mac'),
(174, 'admin01', '2024-05-07 19:10:53', 'Logout aplikasi', '2024-05-07 12:10:53', '2024-05-07 12:10:53', '127.0.0.1', 'Google Chrome on mac'),
(175, 'admin01', '2024-05-07 19:11:10', 'Login aplikasi', '2024-05-07 12:11:10', '2024-05-07 12:11:10', '127.0.0.1', 'Google Chrome on mac'),
(176, 'admin01', '2024-05-07 19:17:09', 'Logout aplikasi', '2024-05-07 12:17:09', '2024-05-07 12:17:09', '127.0.0.1', 'Google Chrome on mac'),
(177, 'admin01', '2024-05-07 19:21:19', 'Login aplikasi', '2024-05-07 12:21:19', '2024-05-07 12:21:19', '127.0.0.1', 'Google Chrome on mac'),
(178, 'admin01', '2024-05-07 21:35:18', 'Logout aplikasi', '2024-05-07 14:35:18', '2024-05-07 14:35:18', '127.0.0.1', 'Google Chrome on mac'),
(179, 'admin01', '2024-05-07 21:48:51', 'Login aplikasi', '2024-05-07 14:48:51', '2024-05-07 14:48:51', '127.0.0.1', 'Google Chrome on mac'),
(180, 'admin01', '2024-05-08 09:43:27', 'Login aplikasi', '2024-05-08 02:43:27', '2024-05-08 02:43:27', '127.0.0.1', 'Google Chrome on mac'),
(181, 'admin01', '2024-05-08 17:28:43', 'Logout aplikasi', '2024-05-08 10:28:43', '2024-05-08 10:28:43', '127.0.0.1', 'Google Chrome on mac'),
(182, 'admin01', '2024-05-08 17:28:45', 'Login aplikasi', '2024-05-08 10:28:45', '2024-05-08 10:28:45', '127.0.0.1', 'Google Chrome on mac'),
(183, 'admin01', '2024-05-08 17:29:45', 'Logout aplikasi', '2024-05-08 10:29:45', '2024-05-08 10:29:45', '127.0.0.1', 'Google Chrome on mac'),
(184, 'admin01', '2024-05-08 17:40:40', 'Login aplikasi', '2024-05-08 10:40:40', '2024-05-08 10:40:40', '127.0.0.1', 'Google Chrome on mac'),
(185, 'admin01', '2024-05-08 18:16:26', 'Logout aplikasi', '2024-05-08 11:16:26', '2024-05-08 11:16:26', '127.0.0.1', 'Google Chrome on mac'),
(186, 'admin01', '2024-05-08 18:19:08', 'Login aplikasi', '2024-05-08 11:19:08', '2024-05-08 11:19:08', '127.0.0.1', 'Google Chrome on mac'),
(187, 'admin01', '2024-05-08 18:19:18', 'Logout aplikasi', '2024-05-08 11:19:18', '2024-05-08 11:19:18', '127.0.0.1', 'Google Chrome on mac'),
(188, 'admin01', '2024-05-08 18:25:05', 'Login aplikasi', '2024-05-08 11:25:05', '2024-05-08 11:25:05', '127.0.0.1', 'Google Chrome on mac'),
(189, 'admin01', '2024-05-08 19:19:24', 'Logout aplikasi', '2024-05-08 12:19:24', '2024-05-08 12:19:24', '127.0.0.1', 'Google Chrome on mac'),
(190, 'admin01', '2024-05-08 19:19:57', 'Login aplikasi', '2024-05-08 12:19:57', '2024-05-08 12:19:57', '127.0.0.1', 'Google Chrome on mac'),
(191, 'admin01', '2024-05-08 19:20:00', 'Logout aplikasi', '2024-05-08 12:20:00', '2024-05-08 12:20:00', '127.0.0.1', 'Google Chrome on mac'),
(192, 'admin01', '2024-05-08 19:47:27', 'Login aplikasi', '2024-05-08 12:47:27', '2024-05-08 12:47:27', '127.0.0.1', 'Google Chrome on mac'),
(193, 'admin01', '2024-05-09 08:11:42', 'Login aplikasi', '2024-05-09 01:11:42', '2024-05-09 01:11:42', '127.0.0.1', 'Google Chrome on mac'),
(194, 'admin01', '2024-05-09 08:19:47', 'Logout aplikasi', '2024-05-09 01:19:47', '2024-05-09 01:19:47', '127.0.0.1', 'Google Chrome on mac'),
(195, 'shinta', '2024-05-09 08:19:54', 'Login aplikasi', '2024-05-09 01:19:54', '2024-05-09 01:19:54', '127.0.0.1', 'Google Chrome on mac'),
(196, 'shinta', '2024-05-09 08:20:11', 'Logout aplikasi', '2024-05-09 01:20:11', '2024-05-09 01:20:11', '127.0.0.1', 'Google Chrome on mac'),
(197, 'admin01', '2024-05-09 08:20:13', 'Login aplikasi', '2024-05-09 01:20:13', '2024-05-09 01:20:13', '127.0.0.1', 'Google Chrome on mac'),
(198, 'admin01', '2024-05-09 20:20:49', 'Login aplikasi', '2024-05-09 13:20:49', '2024-05-09 13:20:49', '127.0.0.1', 'Mozilla Firefox on mac'),
(199, 'admin01', '2024-05-09 20:20:58', 'Logout aplikasi', '2024-05-09 13:20:58', '2024-05-09 13:20:58', '127.0.0.1', 'Mozilla Firefox on mac'),
(200, 'admin01', '2024-05-09 20:29:49', 'Login aplikasi', '2024-05-09 13:29:49', '2024-05-09 13:29:49', '127.0.0.1', 'Google Chrome on mac'),
(201, 'admin01', '2024-05-09 22:11:03', 'Logout aplikasi', '2024-05-09 15:11:03', '2024-05-09 15:11:03', '127.0.0.1', 'Google Chrome on mac'),
(202, 'admin01', '2024-05-09 22:12:25', 'Login aplikasi', '2024-05-09 15:12:25', '2024-05-09 15:12:25', '127.0.0.1', 'Google Chrome on mac'),
(203, 'admin01', '2024-05-09 22:18:08', 'Logout aplikasi', '2024-05-09 15:18:08', '2024-05-09 15:18:08', '127.0.0.1', 'Google Chrome on mac'),
(204, 'heru27', '2024-05-09 22:18:21', 'Login aplikasi', '2024-05-09 15:18:21', '2024-05-09 15:18:21', '127.0.0.1', 'Google Chrome on mac'),
(205, 'heru27', '2024-05-09 22:19:08', 'Logout aplikasi', '2024-05-09 15:19:08', '2024-05-09 15:19:08', '127.0.0.1', 'Google Chrome on mac'),
(206, 'admin01', '2024-05-09 22:19:09', 'Login aplikasi', '2024-05-09 15:19:09', '2024-05-09 15:19:09', '127.0.0.1', 'Google Chrome on mac'),
(207, 'admin01', '2024-05-10 10:20:14', 'Login aplikasi', '2024-05-10 03:20:14', '2024-05-10 03:20:14', '127.0.0.1', 'Google Chrome on mac'),
(208, 'admin01', '2024-05-10 15:18:04', 'Login aplikasi', '2024-05-10 08:18:04', '2024-05-10 08:18:04', '127.0.0.1', 'Google Chrome on mac'),
(209, 'admin01', '2024-05-10 22:14:43', 'Login aplikasi', '2024-05-10 15:14:43', '2024-05-10 15:14:43', '127.0.0.1', 'Google Chrome on mac'),
(210, 'admin01', '2024-05-10 22:17:13', 'Logout aplikasi', '2024-05-10 15:17:13', '2024-05-10 15:17:13', '127.0.0.1', 'Google Chrome on mac'),
(211, 'admin01', '2024-05-10 22:26:06', 'Login aplikasi', '2024-05-10 15:26:06', '2024-05-10 15:26:06', '127.0.0.1', 'Google Chrome on mac'),
(212, 'admin01', '2024-05-10 22:30:28', 'Logout aplikasi', '2024-05-10 15:30:28', '2024-05-10 15:30:28', '127.0.0.1', 'Google Chrome on mac'),
(213, 'Anwar Ahmad', '2024-05-10 22:53:46', 'Logout aplikasi', '2024-05-10 15:53:46', '2024-05-10 15:53:46', '127.0.0.1', 'Google Chrome on mac'),
(214, 'admin01', '2024-05-10 22:53:47', 'Login aplikasi', '2024-05-10 15:53:47', '2024-05-10 15:53:47', '127.0.0.1', 'Google Chrome on mac'),
(215, 'admin01', '2024-05-10 22:54:28', 'Hapus data pengguna dengan username : Anwar Ahmad', '2024-05-10 15:54:28', '2024-05-10 15:54:28', '127.0.0.1', 'Google Chrome on mac'),
(216, 'admin01', '2024-05-10 22:54:33', 'Logout aplikasi', '2024-05-10 15:54:33', '2024-05-10 15:54:33', '127.0.0.1', 'Google Chrome on mac'),
(217, 'Barco Basurero', '2024-05-10 22:55:07', 'Logout aplikasi', '2024-05-10 15:55:07', '2024-05-10 15:55:07', '127.0.0.1', 'Google Chrome on mac'),
(218, 'Anwar Ahmad', '2024-05-10 22:55:20', 'Logout aplikasi', '2024-05-10 15:55:20', '2024-05-10 15:55:20', '127.0.0.1', 'Google Chrome on mac'),
(219, 'admin01', '2024-05-10 22:55:22', 'Login aplikasi', '2024-05-10 15:55:22', '2024-05-10 15:55:22', '127.0.0.1', 'Google Chrome on mac'),
(220, 'admin01', '2024-05-10 22:55:50', 'Hapus data pengguna dengan username : Anwar Ahmad', '2024-05-10 15:55:50', '2024-05-10 15:55:50', '127.0.0.1', 'Google Chrome on mac'),
(221, 'admin01', '2024-05-10 22:55:54', 'Hapus data pengguna dengan username : Barco Basurero', '2024-05-10 15:55:54', '2024-05-10 15:55:54', '127.0.0.1', 'Google Chrome on mac'),
(222, 'admin01', '2024-05-10 22:57:10', 'Logout aplikasi', '2024-05-10 15:57:10', '2024-05-10 15:57:10', '127.0.0.1', 'Google Chrome on mac'),
(223, 'Barco Basurero', '2024-05-10 22:57:47', 'Logout aplikasi', '2024-05-10 15:57:47', '2024-05-10 15:57:47', '127.0.0.1', 'Google Chrome on mac'),
(224, 'admin01', '2024-05-10 22:57:55', 'Login aplikasi', '2024-05-10 15:57:55', '2024-05-10 15:57:55', '127.0.0.1', 'Google Chrome on mac'),
(225, 'admin01', '2024-05-10 23:00:16', 'Logout aplikasi', '2024-05-10 16:00:16', '2024-05-10 16:00:16', '127.0.0.1', 'Google Chrome on mac'),
(226, 'admin01', '2024-05-10 23:04:22', 'Login aplikasi', '2024-05-10 16:04:22', '2024-05-10 16:04:22', '127.0.0.1', 'Google Chrome on mac'),
(227, 'admin01', '2024-05-11 06:06:45', 'Login aplikasi', '2024-05-10 23:06:45', '2024-05-10 23:06:45', '127.0.0.1', 'Google Chrome on mac'),
(228, 'admin01', '2024-05-11 14:06:03', 'Login aplikasi', '2024-05-11 07:06:03', '2024-05-11 07:06:03', '127.0.0.1', 'Google Chrome on mac'),
(229, 'admin01', '2024-05-11 14:39:30', 'Logout aplikasi', '2024-05-11 07:39:30', '2024-05-11 07:39:30', '127.0.0.1', 'Google Chrome on mac'),
(230, 'shinta', '2024-05-11 14:39:35', 'Login aplikasi', '2024-05-11 07:39:35', '2024-05-11 07:39:35', '127.0.0.1', 'Google Chrome on mac'),
(231, 'shinta', '2024-05-11 15:08:59', 'Logout aplikasi', '2024-05-11 08:08:59', '2024-05-11 08:08:59', '127.0.0.1', 'Google Chrome on mac'),
(232, 'admin01', '2024-05-11 15:09:00', 'Login aplikasi', '2024-05-11 08:09:00', '2024-05-11 08:09:00', '127.0.0.1', 'Google Chrome on mac'),
(233, 'admin01', '2024-05-11 15:12:04', 'Logout aplikasi', '2024-05-11 08:12:04', '2024-05-11 08:12:04', '127.0.0.1', 'Google Chrome on mac'),
(234, 'shinta', '2024-05-11 15:12:11', 'Login aplikasi', '2024-05-11 08:12:11', '2024-05-11 08:12:11', '127.0.0.1', 'Google Chrome on mac'),
(235, 'shinta', '2024-05-11 15:15:16', 'Logout aplikasi', '2024-05-11 08:15:16', '2024-05-11 08:15:16', '127.0.0.1', 'Google Chrome on mac'),
(236, 'admin01', '2024-05-11 15:15:18', 'Login aplikasi', '2024-05-11 08:15:18', '2024-05-11 08:15:18', '127.0.0.1', 'Google Chrome on mac'),
(237, 'admin01', '2024-05-11 20:55:12', 'Login aplikasi', '2024-05-11 13:55:12', '2024-05-11 13:55:12', '127.0.0.1', 'Google Chrome on mac'),
(238, 'admin01', '2024-05-11 22:33:09', 'Logout aplikasi', '2024-05-11 15:33:09', '2024-05-11 15:33:09', '127.0.0.1', 'Google Chrome on mac'),
(239, 'shinta', '2024-05-11 22:33:15', 'Login aplikasi', '2024-05-11 15:33:15', '2024-05-11 15:33:15', '127.0.0.1', 'Google Chrome on mac'),
(240, 'shinta', '2024-05-11 22:35:47', 'Logout aplikasi', '2024-05-11 15:35:47', '2024-05-11 15:35:47', '127.0.0.1', 'Google Chrome on mac'),
(241, 'admin01', '2024-05-11 22:35:49', 'Login aplikasi', '2024-05-11 15:35:49', '2024-05-11 15:35:49', '127.0.0.1', 'Google Chrome on mac'),
(242, 'admin01', '2024-05-11 22:40:50', 'Logout aplikasi', '2024-05-11 15:40:50', '2024-05-11 15:40:50', '127.0.0.1', 'Google Chrome on mac'),
(243, 'shinta', '2024-05-11 22:40:56', 'Login aplikasi', '2024-05-11 15:40:56', '2024-05-11 15:40:56', '127.0.0.1', 'Google Chrome on mac'),
(244, 'shinta', '2024-05-11 22:41:23', 'Logout aplikasi', '2024-05-11 15:41:23', '2024-05-11 15:41:23', '127.0.0.1', 'Google Chrome on mac'),
(245, 'admin01', '2024-05-11 22:41:25', 'Login aplikasi', '2024-05-11 15:41:25', '2024-05-11 15:41:25', '127.0.0.1', 'Google Chrome on mac'),
(246, 'admin01', '2024-05-11 22:52:27', 'Logout aplikasi', '2024-05-11 15:52:27', '2024-05-11 15:52:27', '127.0.0.1', 'Google Chrome on mac'),
(247, 'shinta', '2024-05-11 22:52:36', 'Login aplikasi', '2024-05-11 15:52:36', '2024-05-11 15:52:36', '127.0.0.1', 'Google Chrome on mac'),
(248, 'shinta', '2024-05-11 22:55:29', 'Logout aplikasi', '2024-05-11 15:55:29', '2024-05-11 15:55:29', '127.0.0.1', 'Google Chrome on mac'),
(249, 'admin01', '2024-05-11 22:55:33', 'Login aplikasi', '2024-05-11 15:55:33', '2024-05-11 15:55:33', '127.0.0.1', 'Google Chrome on mac'),
(250, 'admin01', '2024-05-11 22:55:40', 'Logout aplikasi', '2024-05-11 15:55:40', '2024-05-11 15:55:40', '127.0.0.1', 'Google Chrome on mac'),
(251, 'heru27', '2024-05-11 22:55:46', 'Login aplikasi', '2024-05-11 15:55:46', '2024-05-11 15:55:46', '127.0.0.1', 'Google Chrome on mac'),
(252, 'heru27', '2024-05-11 22:55:57', 'Logout aplikasi', '2024-05-11 15:55:57', '2024-05-11 15:55:57', '127.0.0.1', 'Google Chrome on mac'),
(253, 'admin01', '2024-05-11 22:58:04', 'Login aplikasi', '2024-05-11 15:58:04', '2024-05-11 15:58:04', '127.0.0.1', 'Google Chrome on mac'),
(254, 'admin01', '2024-05-11 22:59:57', 'Logout aplikasi', '2024-05-11 15:59:57', '2024-05-11 15:59:57', '127.0.0.1', 'Google Chrome on mac'),
(255, 'admin01', '2024-05-12 07:43:08', 'Login aplikasi', '2024-05-12 00:43:08', '2024-05-12 00:43:08', '127.0.0.1', 'Google Chrome on mac'),
(256, 'admin01', '2024-05-12 08:40:55', 'Hapus data pemasukan dengan id : 2', '2024-05-12 01:40:55', '2024-05-12 01:40:55', '127.0.0.1', 'Google Chrome on mac'),
(257, 'admin01', '2024-05-12 12:43:24', 'Login aplikasi', '2024-05-12 05:43:24', '2024-05-12 05:43:24', '127.0.0.1', 'Google Chrome on mac'),
(258, 'admin01', '2024-05-12 13:57:30', 'Logout aplikasi', '2024-05-12 06:57:30', '2024-05-12 06:57:30', '127.0.0.1', 'Google Chrome on mac'),
(259, 'admin01', '2024-05-12 16:34:58', 'Login aplikasi', '2024-05-12 09:34:58', '2024-05-12 09:34:58', '127.0.0.1', 'Google Chrome on mac'),
(260, 'admin01', '2024-05-12 16:50:03', 'Logout aplikasi', '2024-05-12 09:50:03', '2024-05-12 09:50:03', '127.0.0.1', 'Google Chrome on mac'),
(261, 'Munawar Ahmad', '2024-05-12 16:50:22', 'Logout aplikasi', '2024-05-12 09:50:22', '2024-05-12 09:50:22', '127.0.0.1', 'Google Chrome on mac'),
(262, 'admin01', '2024-05-12 16:50:24', 'Login aplikasi', '2024-05-12 09:50:24', '2024-05-12 09:50:24', '127.0.0.1', 'Google Chrome on mac'),
(263, 'admin01', '2024-05-12 16:51:44', 'Hapus data pengguna dengan username : Munawar Ahmad', '2024-05-12 09:51:44', '2024-05-12 09:51:44', '127.0.0.1', 'Google Chrome on mac'),
(264, 'admin01', '2024-05-12 16:51:49', 'Hapus data pengguna dengan username : Barco Basurero', '2024-05-12 09:51:49', '2024-05-12 09:51:49', '127.0.0.1', 'Google Chrome on mac'),
(265, 'admin01', '2024-05-12 16:52:15', 'Simpan Data Jenis Pengeluaran : Operasional', '2024-05-12 09:52:15', '2024-05-12 09:52:15', '127.0.0.1', 'Google Chrome on mac'),
(266, 'admin01', '2024-05-12 16:52:35', 'Simpan Data Jenis Pengeluaran : Pengeluaran Lainnya', '2024-05-12 09:52:35', '2024-05-12 09:52:35', '127.0.0.1', 'Google Chrome on mac'),
(267, 'admin01', '2024-05-12 16:52:58', 'success', '2024-05-12 09:52:58', '2024-05-12 09:52:58', '127.0.0.1', 'Google Chrome on mac'),
(268, 'admin01', '2024-05-12 16:55:08', 'Simpan daftar pengeluaran', '2024-05-12 09:55:08', '2024-05-12 09:55:08', '127.0.0.1', 'Google Chrome on mac'),
(269, 'admin01', '2024-05-12 16:58:13', 'Simpan data pemasukan', '2024-05-12 09:58:13', '2024-05-12 09:58:13', '127.0.0.1', 'Google Chrome on mac'),
(270, 'admin01', '2024-05-12 17:00:52', 'success', '2024-05-12 10:00:52', '2024-05-12 10:00:52', '127.0.0.1', 'Google Chrome on mac'),
(271, 'admin01', '2024-05-12 17:01:12', 'success', '2024-05-12 10:01:12', '2024-05-12 10:01:12', '127.0.0.1', 'Google Chrome on mac'),
(272, 'admin01', '2024-05-12 17:01:26', 'success', '2024-05-12 10:01:26', '2024-05-12 10:01:26', '127.0.0.1', 'Google Chrome on mac'),
(273, 'admin01', '2024-05-12 17:02:35', 'Pembelian Perlengkapan', '2024-05-12 10:02:35', '2024-05-12 10:02:35', '127.0.0.1', 'Google Chrome on mac'),
(274, 'admin01', '2024-05-12 17:19:33', 'Update daftar pengeluaran dengan id: 1', '2024-05-12 10:19:33', '2024-05-12 10:19:33', '127.0.0.1', 'Google Chrome on mac'),
(275, 'admin01', '2024-05-12 17:20:04', 'Hapus daftar pengeluaran dengan id : 1', '2024-05-12 10:20:04', '2024-05-12 10:20:04', '127.0.0.1', 'Google Chrome on mac'),
(276, 'admin01', '2024-05-12 17:20:56', 'Simpan daftar pengeluaran', '2024-05-12 10:20:56', '2024-05-12 10:20:56', '127.0.0.1', 'Google Chrome on mac'),
(277, 'admin01', '2024-05-12 20:53:39', 'Login aplikasi', '2024-05-12 13:53:39', '2024-05-12 13:53:39', '127.0.0.1', 'Google Chrome on mac'),
(278, 'admin01', '2024-05-12 21:46:54', 'Logout aplikasi', '2024-05-12 14:46:54', '2024-05-12 14:46:54', '127.0.0.1', 'Google Chrome on mac'),
(279, 'admin01', '2024-05-12 21:48:18', 'Login aplikasi', '2024-05-12 14:48:18', '2024-05-12 14:48:18', '127.0.0.1', 'Google Chrome on mac'),
(280, 'admin01', '2024-05-12 21:57:38', 'Update data pengiriman dengan no resi : JHD7927492748', '2024-05-12 14:57:38', '2024-05-12 14:57:38', '127.0.0.1', 'Google Chrome on mac'),
(281, 'admin01', '2024-05-12 22:07:14', 'Update data pengiriman dengan no resi : JHD9183917419', '2024-05-12 15:07:14', '2024-05-12 15:07:14', '127.0.0.1', 'Google Chrome on mac'),
(282, 'admin01', '2024-05-12 22:08:52', 'Update data pengiriman dengan no resi : JHD9183917419', '2024-05-12 15:08:52', '2024-05-12 15:08:52', '127.0.0.1', 'Google Chrome on mac'),
(283, 'admin01', '2024-05-12 22:11:08', 'Logout aplikasi', '2024-05-12 15:11:08', '2024-05-12 15:11:08', '127.0.0.1', 'Google Chrome on mac'),
(284, 'admin01', '2024-05-13 11:09:29', 'Login aplikasi', '2024-05-13 04:09:29', '2024-05-13 04:09:29', '127.0.0.1', 'Google Chrome on mac'),
(285, 'admin01', '2024-05-13 11:10:50', 'Logout aplikasi', '2024-05-13 04:10:50', '2024-05-13 04:10:50', '127.0.0.1', 'Google Chrome on mac'),
(286, 'shinta', '2024-05-13 11:10:55', 'Login aplikasi', '2024-05-13 04:10:55', '2024-05-13 04:10:55', '127.0.0.1', 'Google Chrome on mac'),
(287, 'shinta', '2024-05-13 11:14:07', 'Logout aplikasi', '2024-05-13 04:14:07', '2024-05-13 04:14:07', '127.0.0.1', 'Google Chrome on mac'),
(288, 'Anwar Ahmad', '2024-05-13 11:14:22', 'Logout aplikasi', '2024-05-13 04:14:22', '2024-05-13 04:14:22', '127.0.0.1', 'Google Chrome on mac'),
(289, 'admin01', '2024-05-13 11:26:36', 'Login aplikasi', '2024-05-13 04:26:36', '2024-05-13 04:26:36', '127.0.0.1', 'Google Chrome on mac'),
(290, 'admin01', '2024-05-13 13:34:19', 'Login aplikasi', '2024-05-13 06:34:19', '2024-05-13 06:34:19', '127.0.0.1', 'Google Chrome on mac'),
(291, 'admin01', '2024-05-13 14:09:22', 'Update daftar pengeluaran dengan id: 2', '2024-05-13 07:09:22', '2024-05-13 07:09:22', '127.0.0.1', 'Google Chrome on mac'),
(292, 'admin01', '2024-05-13 14:09:34', 'Update daftar pengeluaran dengan id: 2', '2024-05-13 07:09:34', '2024-05-13 07:09:34', '127.0.0.1', 'Google Chrome on mac'),
(293, 'admin01', '2024-05-13 14:16:52', 'Logout aplikasi', '2024-05-13 07:16:52', '2024-05-13 07:16:52', '127.0.0.1', 'Google Chrome on mac'),
(294, 'admin01', '2024-05-13 14:16:53', 'Login aplikasi', '2024-05-13 07:16:53', '2024-05-13 07:16:53', '127.0.0.1', 'Google Chrome on mac'),
(295, 'admin01', '2024-05-13 14:17:04', 'Logout aplikasi', '2024-05-13 07:17:04', '2024-05-13 07:17:04', '127.0.0.1', 'Google Chrome on mac'),
(296, 'shinta', '2024-05-13 14:17:09', 'Login aplikasi', '2024-05-13 07:17:09', '2024-05-13 07:17:09', '127.0.0.1', 'Google Chrome on mac'),
(297, 'shinta', '2024-05-13 14:23:58', 'Logout aplikasi', '2024-05-13 07:23:58', '2024-05-13 07:23:58', '127.0.0.1', 'Google Chrome on mac'),
(298, 'admin01', '2024-05-13 14:23:59', 'Login aplikasi', '2024-05-13 07:23:59', '2024-05-13 07:23:59', '127.0.0.1', 'Google Chrome on mac'),
(299, 'admin01', '2024-05-13 14:24:09', 'Logout aplikasi', '2024-05-13 07:24:09', '2024-05-13 07:24:09', '127.0.0.1', 'Google Chrome on mac'),
(300, 'shinta', '2024-05-13 14:24:13', 'Login aplikasi', '2024-05-13 07:24:13', '2024-05-13 07:24:13', '127.0.0.1', 'Google Chrome on mac'),
(301, 'shinta', '2024-05-13 14:26:26', 'Logout aplikasi', '2024-05-13 07:26:26', '2024-05-13 07:26:26', '127.0.0.1', 'Google Chrome on mac'),
(302, 'admin01', '2024-05-13 14:26:28', 'Login aplikasi', '2024-05-13 07:26:28', '2024-05-13 07:26:28', '127.0.0.1', 'Google Chrome on mac'),
(303, 'admin01', '2024-05-13 14:26:48', 'Update daftar pengeluaran dengan id: 2', '2024-05-13 07:26:48', '2024-05-13 07:26:48', '127.0.0.1', 'Google Chrome on mac'),
(304, 'admin01', '2024-05-13 14:26:55', 'Hapus daftar pengeluaran dengan id : 2', '2024-05-13 07:26:55', '2024-05-13 07:26:55', '127.0.0.1', 'Google Chrome on mac'),
(305, 'admin01', '2024-05-13 14:32:09', 'Pembelian Perlengkapan', '2024-05-13 07:32:09', '2024-05-13 07:32:09', '127.0.0.1', 'Google Chrome on mac'),
(306, 'admin01', '2024-05-13 14:33:29', 'Pembelian Perlengkapan', '2024-05-13 07:33:29', '2024-05-13 07:33:29', '127.0.0.1', 'Google Chrome on mac'),
(307, 'admin01', '2024-05-13 14:43:10', 'Hapus data pengiriman dengan no resi : JHD1827183614', '2024-05-13 07:43:10', '2024-05-13 07:43:10', '127.0.0.1', 'Google Chrome on mac'),
(308, 'admin01', '2024-05-13 14:43:15', 'Hapus data pengiriman dengan no resi : JHD9183917419', '2024-05-13 07:43:15', '2024-05-13 07:43:15', '127.0.0.1', 'Google Chrome on mac'),
(309, 'admin01', '2024-05-13 14:43:19', 'Hapus data pengiriman dengan no resi : JHD9138927422', '2024-05-13 07:43:19', '2024-05-13 07:43:19', '127.0.0.1', 'Google Chrome on mac'),
(310, 'admin01', '2024-05-13 14:43:21', 'Hapus data pengiriman dengan no resi : JHD7927492748', '2024-05-13 07:43:21', '2024-05-13 07:43:21', '127.0.0.1', 'Google Chrome on mac'),
(311, 'admin01', '2024-05-13 14:47:36', 'Pembelian Perlengkapan', '2024-05-13 07:47:36', '2024-05-13 07:47:36', '127.0.0.1', 'Google Chrome on mac'),
(312, 'admin01', '2024-05-13 15:01:14', 'Pembelian Perlengkapan', '2024-05-13 08:01:14', '2024-05-13 08:01:14', '127.0.0.1', 'Google Chrome on mac'),
(313, 'admin01', '2024-05-13 15:01:25', 'Pembelian Perlengkapan', '2024-05-13 08:01:25', '2024-05-13 08:01:25', '127.0.0.1', 'Google Chrome on mac'),
(314, 'admin01', '2024-05-13 16:08:18', 'Simpan daftar pengeluaran', '2024-05-13 09:08:18', '2024-05-13 09:08:18', '127.0.0.1', 'Google Chrome on mac'),
(315, 'admin01', '2024-05-13 16:09:13', 'Simpan daftar pengeluaran', '2024-05-13 09:09:13', '2024-05-13 09:09:13', '127.0.0.1', 'Google Chrome on mac'),
(316, 'admin01', '2024-05-13 16:10:33', 'Logout aplikasi', '2024-05-13 09:10:33', '2024-05-13 09:10:33', '127.0.0.1', 'Google Chrome on mac'),
(317, 'shinta', '2024-05-13 16:10:39', 'Login aplikasi', '2024-05-13 09:10:39', '2024-05-13 09:10:39', '127.0.0.1', 'Google Chrome on mac'),
(318, 'shinta', '2024-05-13 16:11:03', 'Logout aplikasi', '2024-05-13 09:11:03', '2024-05-13 09:11:03', '127.0.0.1', 'Google Chrome on mac'),
(319, 'admin01', '2024-05-13 16:11:04', 'Login aplikasi', '2024-05-13 09:11:04', '2024-05-13 09:11:04', '127.0.0.1', 'Google Chrome on mac'),
(320, 'admin01', '2024-05-13 16:21:15', 'Simpan daftar pengeluaran', '2024-05-13 09:21:15', '2024-05-13 09:21:15', '127.0.0.1', 'Google Chrome on mac'),
(321, 'admin01', '2024-05-13 16:21:38', 'Logout aplikasi', '2024-05-13 09:21:38', '2024-05-13 09:21:38', '127.0.0.1', 'Google Chrome on mac'),
(322, 'shinta', '2024-05-13 16:21:44', 'Login aplikasi', '2024-05-13 09:21:44', '2024-05-13 09:21:44', '127.0.0.1', 'Google Chrome on mac'),
(323, 'shinta', '2024-05-13 16:21:53', 'Logout aplikasi', '2024-05-13 09:21:53', '2024-05-13 09:21:53', '127.0.0.1', 'Google Chrome on mac'),
(324, 'admin01', '2024-05-13 16:21:54', 'Login aplikasi', '2024-05-13 09:21:54', '2024-05-13 09:21:54', '127.0.0.1', 'Google Chrome on mac'),
(325, 'admin01', '2024-05-14 05:17:46', 'Login aplikasi', '2024-05-13 22:17:46', '2024-05-13 22:17:46', '127.0.0.1', 'Google Chrome on mac'),
(326, 'admin01', '2024-05-14 05:17:58', 'Hapus data pengguna dengan username : Anwar Ahmad', '2024-05-13 22:17:58', '2024-05-13 22:17:58', '127.0.0.1', 'Google Chrome on mac'),
(327, 'admin01', '2024-05-14 05:40:33', 'Data Customer Gilang berhasil ditambahkan', '2024-05-13 22:40:33', '2024-05-13 22:40:33', '127.0.0.1', 'Google Chrome on mac'),
(328, 'admin01', '2024-05-14 05:52:39', 'Update data pengguna dengan username : gerry', '2024-05-13 22:52:39', '2024-05-13 22:52:39', '127.0.0.1', 'Google Chrome on mac'),
(329, 'admin01', '2024-05-14 05:52:45', 'Logout aplikasi', '2024-05-13 22:52:45', '2024-05-13 22:52:45', '127.0.0.1', 'Google Chrome on mac'),
(330, 'gerry', '2024-05-14 05:52:57', 'Login aplikasi', '2024-05-13 22:52:57', '2024-05-13 22:52:57', '127.0.0.1', 'Google Chrome on mac'),
(331, 'gerry', '2024-05-14 05:53:00', 'Logout aplikasi', '2024-05-13 22:53:00', '2024-05-13 22:53:00', '127.0.0.1', 'Google Chrome on mac'),
(332, 'admin01', '2024-05-14 05:53:03', 'Login aplikasi', '2024-05-13 22:53:03', '2024-05-13 22:53:03', '127.0.0.1', 'Google Chrome on mac'),
(333, 'admin01', '2024-05-14 05:53:40', 'Logout aplikasi', '2024-05-13 22:53:40', '2024-05-13 22:53:40', '127.0.0.1', 'Google Chrome on mac'),
(334, 'gerry', '2024-05-14 05:53:45', 'Login aplikasi', '2024-05-13 22:53:45', '2024-05-13 22:53:45', '127.0.0.1', 'Google Chrome on mac'),
(335, 'gerry', '2024-05-14 05:54:06', 'Logout aplikasi', '2024-05-13 22:54:06', '2024-05-13 22:54:06', '127.0.0.1', 'Google Chrome on mac');
INSERT INTO `log_activities` (`id`, `username`, `log_time`, `activity`, `created_at`, `updated_at`, `ip_address`, `browser`) VALUES
(336, 'gerry', '2024-05-14 05:54:11', 'Login aplikasi', '2024-05-13 22:54:11', '2024-05-13 22:54:11', '127.0.0.1', 'Google Chrome on mac'),
(337, 'gerry', '2024-05-14 05:54:25', 'Logout aplikasi', '2024-05-13 22:54:25', '2024-05-13 22:54:25', '127.0.0.1', 'Google Chrome on mac'),
(338, 'admin01', '2024-05-14 05:54:27', 'Login aplikasi', '2024-05-13 22:54:27', '2024-05-13 22:54:27', '127.0.0.1', 'Google Chrome on mac'),
(339, 'admin01', '2024-05-14 05:55:15', 'Data Customer Dewangga berhasil ditambahkan', '2024-05-13 22:55:15', '2024-05-13 22:55:15', '127.0.0.1', 'Google Chrome on mac'),
(340, 'admin01', '2024-05-14 05:55:26', 'Logout aplikasi', '2024-05-13 22:55:26', '2024-05-13 22:55:26', '127.0.0.1', 'Google Chrome on mac'),
(341, 'dewangga', '2024-05-14 05:55:34', 'Login aplikasi', '2024-05-13 22:55:34', '2024-05-13 22:55:34', '127.0.0.1', 'Google Chrome on mac'),
(342, 'dewangga', '2024-05-14 05:55:54', 'Logout aplikasi', '2024-05-13 22:55:54', '2024-05-13 22:55:54', '127.0.0.1', 'Google Chrome on mac'),
(343, 'admin01', '2024-05-14 05:55:56', 'Login aplikasi', '2024-05-13 22:55:56', '2024-05-13 22:55:56', '127.0.0.1', 'Google Chrome on mac'),
(344, 'admin01', '2024-05-14 06:21:08', 'Logout aplikasi', '2024-05-13 23:21:08', '2024-05-13 23:21:08', '127.0.0.1', 'Google Chrome on mac'),
(345, 'admin01', '2024-05-14 09:32:42', 'Login aplikasi', '2024-05-14 02:32:42', '2024-05-14 02:32:42', '127.0.0.1', 'Google Chrome on mac'),
(346, 'admin01', '2024-05-14 13:14:19', 'Logout aplikasi', '2024-05-14 06:14:19', '2024-05-14 06:14:19', '127.0.0.1', 'Google Chrome on mac'),
(347, 'gerry', '2024-05-14 13:14:25', 'Login aplikasi', '2024-05-14 06:14:25', '2024-05-14 06:14:25', '127.0.0.1', 'Google Chrome on mac'),
(348, 'gerry', '2024-05-14 13:14:33', 'Logout aplikasi', '2024-05-14 06:14:33', '2024-05-14 06:14:33', '127.0.0.1', 'Google Chrome on mac'),
(349, 'gerry', '2024-05-14 13:14:38', 'Login aplikasi', '2024-05-14 06:14:38', '2024-05-14 06:14:38', '127.0.0.1', 'Google Chrome on mac'),
(350, 'gerry', '2024-05-14 13:14:44', 'Logout aplikasi', '2024-05-14 06:14:44', '2024-05-14 06:14:44', '127.0.0.1', 'Google Chrome on mac'),
(351, 'admin01', '2024-05-14 13:14:45', 'Login aplikasi', '2024-05-14 06:14:45', '2024-05-14 06:14:45', '127.0.0.1', 'Google Chrome on mac'),
(352, 'admin01', '2024-05-14 13:26:09', 'Logout aplikasi', '2024-05-14 06:26:09', '2024-05-14 06:26:09', '127.0.0.1', 'Google Chrome on mac'),
(353, 'gerry', '2024-05-14 13:26:21', 'Login aplikasi', '2024-05-14 06:26:21', '2024-05-14 06:26:21', '127.0.0.1', 'Google Chrome on mac'),
(354, 'gerry', '2024-05-14 14:12:21', 'Logout aplikasi', '2024-05-14 07:12:21', '2024-05-14 07:12:21', '127.0.0.1', 'Google Chrome on mac'),
(355, 'admin01', '2024-05-14 14:12:23', 'Login aplikasi', '2024-05-14 07:12:23', '2024-05-14 07:12:23', '127.0.0.1', 'Google Chrome on mac'),
(356, 'admin01', '2024-05-14 17:30:18', 'Logout aplikasi', '2024-05-14 10:30:18', '2024-05-14 10:30:18', '127.0.0.1', 'Google Chrome on mac'),
(357, 'admin01', '2024-05-14 17:30:54', 'Login aplikasi', '2024-05-14 10:30:54', '2024-05-14 10:30:54', '127.0.0.1', 'Google Chrome on mac'),
(358, 'admin01', '2024-05-14 17:30:57', 'Logout aplikasi', '2024-05-14 10:30:57', '2024-05-14 10:30:57', '127.0.0.1', 'Google Chrome on mac'),
(359, 'admin01', '2024-05-15 16:24:37', 'Login aplikasi', '2024-05-15 09:24:37', '2024-05-15 09:24:37', '127.0.0.1', 'Google Chrome on mac'),
(360, 'admin01', '2024-05-16 08:30:50', 'Login aplikasi', '2024-05-16 01:30:50', '2024-05-16 01:30:50', '127.0.0.1', 'Google Chrome on mac'),
(361, 'admin01', '2024-05-16 08:45:44', 'Logout aplikasi', '2024-05-16 01:45:44', '2024-05-16 01:45:44', '127.0.0.1', 'Google Chrome on mac'),
(362, 'admin01', '2024-05-20 15:18:36', 'Login aplikasi', '2024-05-20 08:18:36', '2024-05-20 08:18:36', NULL, NULL),
(363, 'admin01', '2024-05-20 15:18:55', 'Logout aplikasi', '2024-05-20 08:18:55', '2024-05-20 08:18:55', NULL, NULL),
(364, 'admin01', '2024-05-20 15:43:37', 'Login aplikasi', '2024-05-20 08:43:37', '2024-05-20 08:43:37', '127.0.0.1', 'Google Chrome on mac'),
(365, 'admin01', '2024-05-21 09:54:48', 'Login aplikasi', '2024-05-21 02:54:48', '2024-05-21 02:54:48', '127.0.0.1', 'Google Chrome on mac'),
(366, 'admin01', '2024-05-21 09:57:15', 'Logout aplikasi', '2024-05-21 02:57:15', '2024-05-21 02:57:15', '127.0.0.1', 'Google Chrome on mac'),
(367, 'Munawar Ahmad', '2024-05-21 12:55:22', 'Logout aplikasi', '2024-05-21 05:55:22', '2024-05-21 05:55:22', '127.0.0.1', 'Google Chrome on mac'),
(368, 'admin01', '2024-05-21 12:55:24', 'Login aplikasi', '2024-05-21 05:55:24', '2024-05-21 05:55:24', '127.0.0.1', 'Google Chrome on mac'),
(369, 'admin01', '2024-05-21 12:55:33', 'Hapus data pengguna dengan username : Munawar Ahmad', '2024-05-21 05:55:33', '2024-05-21 05:55:33', '127.0.0.1', 'Google Chrome on mac'),
(370, 'admin01', '2024-05-21 12:55:42', 'Hapus data pengguna dengan username : dewangga', '2024-05-21 05:55:42', '2024-05-21 05:55:42', '127.0.0.1', 'Google Chrome on mac'),
(371, 'admin01', '2024-05-21 17:46:22', 'Login aplikasi', '2024-05-21 10:46:22', '2024-05-21 10:46:22', '127.0.0.1', 'Google Chrome on mac'),
(372, 'admin01', '2024-05-21 17:46:30', 'Logout aplikasi', '2024-05-21 10:46:30', '2024-05-21 10:46:30', '127.0.0.1', 'Google Chrome on mac'),
(373, 'gerry', '2024-05-21 17:46:37', 'Login aplikasi', '2024-05-21 10:46:37', '2024-05-21 10:46:37', '127.0.0.1', 'Google Chrome on mac'),
(374, 'gerry', '2024-05-21 17:53:14', 'Logout aplikasi', '2024-05-21 10:53:14', '2024-05-21 10:53:14', '127.0.0.1', 'Google Chrome on mac'),
(375, 'admin01', '2024-05-21 17:53:17', 'Login aplikasi', '2024-05-21 10:53:17', '2024-05-21 10:53:17', '127.0.0.1', 'Google Chrome on mac'),
(376, 'admin01', '2024-05-21 17:53:21', 'Login aplikasi', '2024-05-21 10:53:21', '2024-05-21 10:53:21', '127.0.0.1', 'Google Chrome on mac'),
(377, 'admin01', '2024-05-21 18:00:03', 'Logout aplikasi', '2024-05-21 11:00:03', '2024-05-21 11:00:03', '127.0.0.1', 'Google Chrome on mac'),
(378, 'admin01', '2024-05-21 18:37:09', 'Login aplikasi', '2024-05-21 11:37:09', '2024-05-21 11:37:09', '127.0.0.1', 'Google Chrome on mac'),
(379, 'admin01', '2024-05-21 19:35:49', 'Logout aplikasi', '2024-05-21 12:35:49', '2024-05-21 12:35:49', '127.0.0.1', 'Google Chrome on mac'),
(380, 'admin01', '2024-05-23 20:08:00', 'Login aplikasi', '2024-05-23 13:08:00', '2024-05-23 13:08:00', '127.0.0.1', 'Google Chrome on mac'),
(381, 'admin01', '2024-05-23 20:08:03', 'Logout aplikasi', '2024-05-23 13:08:03', '2024-05-23 13:08:03', '127.0.0.1', 'Google Chrome on mac'),
(382, 'Munawar Ahmad', '2024-05-23 20:11:09', 'Logout aplikasi', '2024-05-23 13:11:09', '2024-05-23 13:11:09', '127.0.0.1', 'Google Chrome on mac'),
(383, 'admin01', '2024-05-23 20:11:10', 'Login aplikasi', '2024-05-23 13:11:10', '2024-05-23 13:11:10', '127.0.0.1', 'Google Chrome on mac'),
(384, 'admin01', '2024-05-23 20:32:43', 'Logout aplikasi', '2024-05-23 13:32:43', '2024-05-23 13:32:43', '127.0.0.1', 'Google Chrome on mac'),
(385, 'gerry', '2024-05-23 20:32:51', 'Login aplikasi', '2024-05-23 13:32:51', '2024-05-23 13:32:51', '127.0.0.1', 'Google Chrome on mac'),
(386, 'gerry', '2024-05-23 20:51:40', 'Logout aplikasi', '2024-05-23 13:51:40', '2024-05-23 13:51:40', '127.0.0.1', 'Google Chrome on mac'),
(387, 'admin01', '2024-05-23 20:51:42', 'Login aplikasi', '2024-05-23 13:51:42', '2024-05-23 13:51:42', '127.0.0.1', 'Google Chrome on mac'),
(388, 'admin01', '2024-05-23 20:55:19', 'Simpan daftar pengeluaran', '2024-05-23 13:55:19', '2024-05-23 13:55:19', '127.0.0.1', 'Google Chrome on mac'),
(389, 'admin01', '2024-05-23 20:55:27', 'Logout aplikasi', '2024-05-23 13:55:27', '2024-05-23 13:55:27', '127.0.0.1', 'Google Chrome on mac'),
(390, 'gerry', '2024-05-23 20:55:34', 'Login aplikasi', '2024-05-23 13:55:34', '2024-05-23 13:55:34', '127.0.0.1', 'Google Chrome on mac'),
(391, 'gerry', '2024-05-23 20:56:08', 'Logout aplikasi', '2024-05-23 13:56:08', '2024-05-23 13:56:08', '127.0.0.1', 'Google Chrome on mac'),
(392, 'admin01', '2024-05-23 20:56:10', 'Login aplikasi', '2024-05-23 13:56:10', '2024-05-23 13:56:10', '127.0.0.1', 'Google Chrome on mac'),
(393, 'admin01', '2024-05-23 21:18:27', 'Data Customer Rendi berhasil ditambahkan', '2024-05-23 14:18:27', '2024-05-23 14:18:27', '127.0.0.1', 'Google Chrome on mac'),
(394, 'admin01', '2024-05-23 21:18:59', 'Logout aplikasi', '2024-05-23 14:18:59', '2024-05-23 14:18:59', '127.0.0.1', 'Google Chrome on mac'),
(395, 'gerry', '2024-05-23 21:19:04', 'Login aplikasi', '2024-05-23 14:19:04', '2024-05-23 14:19:04', '127.0.0.1', 'Google Chrome on mac'),
(396, 'gerry', '2024-05-23 21:30:13', 'Logout aplikasi', '2024-05-23 14:30:13', '2024-05-23 14:30:13', '127.0.0.1', 'Google Chrome on mac'),
(397, 'admin01', '2024-05-23 21:30:15', 'Login aplikasi', '2024-05-23 14:30:15', '2024-05-23 14:30:15', '127.0.0.1', 'Google Chrome on mac'),
(398, 'admin01', '2024-05-23 22:35:18', 'Logout aplikasi', '2024-05-23 15:35:18', '2024-05-23 15:35:18', '127.0.0.1', 'Google Chrome on mac'),
(399, 'admin01', '2024-05-25 09:39:14', 'Login aplikasi', '2024-05-25 02:39:14', '2024-05-25 02:39:14', '127.0.0.1', 'Google Chrome on mac'),
(400, 'admin01', '2024-05-25 10:10:26', 'Logout aplikasi', '2024-05-25 03:10:26', '2024-05-25 03:10:26', '127.0.0.1', 'Google Chrome on mac'),
(401, 'gerry', '2024-05-25 10:10:36', 'Login aplikasi', '2024-05-25 03:10:36', '2024-05-25 03:10:36', '127.0.0.1', 'Google Chrome on mac'),
(402, 'gerry', '2024-05-25 10:11:43', 'Logout aplikasi', '2024-05-25 03:11:43', '2024-05-25 03:11:43', '127.0.0.1', 'Google Chrome on mac'),
(403, 'admin01', '2024-05-25 10:11:44', 'Login aplikasi', '2024-05-25 03:11:44', '2024-05-25 03:11:44', '127.0.0.1', 'Google Chrome on mac'),
(404, 'admin01', '2024-05-25 10:19:57', 'Logout aplikasi', '2024-05-25 03:19:57', '2024-05-25 03:19:57', '127.0.0.1', 'Google Chrome on mac'),
(405, 'admin01', '2024-05-26 16:30:18', 'Login aplikasi', '2024-05-26 09:30:18', '2024-05-26 09:30:18', '127.0.0.1', 'Google Chrome on mac'),
(406, 'admin01', '2024-05-27 10:19:53', 'Login aplikasi', '2024-05-27 03:19:53', '2024-05-27 03:19:53', '127.0.0.1', 'Google Chrome on mac'),
(407, 'admin01', '2024-05-27 10:20:49', 'Update data pengguna dengan username : admin01', '2024-05-27 03:20:49', '2024-05-27 03:20:49', '127.0.0.1', 'Google Chrome on mac'),
(408, 'admin01', '2024-05-27 10:25:32', 'Simpan daftar pengeluaran', '2024-05-27 03:25:32', '2024-05-27 03:25:32', '127.0.0.1', 'Google Chrome on mac'),
(409, 'admin01', '2024-05-27 10:29:41', 'Logout aplikasi', '2024-05-27 03:29:41', '2024-05-27 03:29:41', '127.0.0.1', 'Google Chrome on mac'),
(410, 'admin01', '2024-05-27 10:29:43', 'Login aplikasi', '2024-05-27 03:29:43', '2024-05-27 03:29:43', '127.0.0.1', 'Google Chrome on mac'),
(411, 'admin01', '2024-05-27 10:29:46', 'Logout aplikasi', '2024-05-27 03:29:46', '2024-05-27 03:29:46', '127.0.0.1', 'Google Chrome on mac'),
(412, 'gerry', '2024-05-27 10:29:53', 'Login aplikasi', '2024-05-27 03:29:53', '2024-05-27 03:29:53', '127.0.0.1', 'Google Chrome on mac'),
(413, 'gerry', '2024-05-27 10:30:25', 'Logout aplikasi', '2024-05-27 03:30:25', '2024-05-27 03:30:25', '127.0.0.1', 'Google Chrome on mac'),
(414, 'admin01', '2024-05-27 10:30:27', 'Login aplikasi', '2024-05-27 03:30:27', '2024-05-27 03:30:27', '127.0.0.1', 'Google Chrome on mac'),
(415, 'admin01', '2024-05-28 09:39:11', 'Login aplikasi', '2024-05-28 02:39:11', '2024-05-28 02:39:11', '127.0.0.1', 'Google Chrome on mac'),
(416, 'admin01', '2024-05-28 09:44:57', 'Simpan data pemasukan', '2024-05-28 02:44:57', '2024-05-28 02:44:57', '127.0.0.1', 'Google Chrome on mac'),
(417, 'admin01', '2024-05-28 09:45:20', 'Logout aplikasi', '2024-05-28 02:45:20', '2024-05-28 02:45:20', '127.0.0.1', 'Google Chrome on mac'),
(418, 'gerry', '2024-05-28 09:45:25', 'Login aplikasi', '2024-05-28 02:45:25', '2024-05-28 02:45:25', '127.0.0.1', 'Google Chrome on mac'),
(419, 'gerry', '2024-05-28 09:51:07', 'Logout aplikasi', '2024-05-28 02:51:07', '2024-05-28 02:51:07', '127.0.0.1', 'Google Chrome on mac'),
(420, 'admin01', '2024-05-28 09:54:17', 'Login aplikasi', '2024-05-28 02:54:17', '2024-05-28 02:54:17', '127.0.0.1', 'Google Chrome on mac'),
(421, 'admin01', '2024-05-28 10:02:54', 'Data Customer Gilang Ramadhan berhasil ditambahkan', '2024-05-28 03:02:54', '2024-05-28 03:02:54', '127.0.0.1', 'Google Chrome on mac'),
(422, 'admin01', '2024-05-28 10:06:15', 'Data Customer Sri Rezeki berhasil ditambahkan', '2024-05-28 03:06:15', '2024-05-28 03:06:15', '127.0.0.1', 'Google Chrome on mac'),
(423, 'admin01', '2024-05-28 10:08:03', 'Data Customer Gilang Ramadhan berhasil diupdate', '2024-05-28 03:08:03', '2024-05-28 03:08:03', '127.0.0.1', 'Google Chrome on mac'),
(424, 'admin01', '2024-05-28 10:09:19', 'Data Customer Sri Rezeki berhasil diupdate', '2024-05-28 03:09:19', '2024-05-28 03:09:19', '127.0.0.1', 'Google Chrome on mac'),
(425, 'admin01', '2024-05-28 13:32:31', 'Login aplikasi', '2024-05-28 06:32:31', '2024-05-28 06:32:31', '127.0.0.1', 'Google Chrome on mac'),
(426, 'admin01', '2024-05-28 15:34:06', 'Login aplikasi', '2024-05-28 08:34:06', '2024-05-28 08:34:06', '127.0.0.1', 'Google Chrome on mac'),
(427, 'admin01', '2024-05-28 19:12:50', 'Logout aplikasi', '2024-05-28 12:12:50', '2024-05-28 12:12:50', '127.0.0.1', 'Google Chrome on mac'),
(428, 'gerry', '2024-05-28 19:12:58', 'Login aplikasi', '2024-05-28 12:12:58', '2024-05-28 12:12:58', '127.0.0.1', 'Google Chrome on mac'),
(429, 'gerry', '2024-05-28 19:14:10', 'Logout aplikasi', '2024-05-28 12:14:10', '2024-05-28 12:14:10', '127.0.0.1', 'Google Chrome on mac'),
(430, 'admin01', '2024-05-28 19:14:11', 'Login aplikasi', '2024-05-28 12:14:11', '2024-05-28 12:14:11', '127.0.0.1', 'Google Chrome on mac'),
(431, 'admin01', '2024-05-28 19:18:36', 'Logout aplikasi', '2024-05-28 12:18:36', '2024-05-28 12:18:36', '127.0.0.1', 'Google Chrome on mac'),
(432, 'gerry', '2024-05-28 19:18:42', 'Login aplikasi', '2024-05-28 12:18:42', '2024-05-28 12:18:42', '127.0.0.1', 'Google Chrome on mac'),
(433, 'gerry', '2024-05-28 19:24:51', 'Logout aplikasi', '2024-05-28 12:24:51', '2024-05-28 12:24:51', '127.0.0.1', 'Google Chrome on mac'),
(434, 'admin01', '2024-05-28 19:24:52', 'Login aplikasi', '2024-05-28 12:24:52', '2024-05-28 12:24:52', '127.0.0.1', 'Google Chrome on mac'),
(435, 'admin01', '2024-05-28 19:28:41', 'Logout aplikasi', '2024-05-28 12:28:41', '2024-05-28 12:28:41', '127.0.0.1', 'Google Chrome on mac'),
(436, 'admin01', '2024-05-30 14:11:04', 'Login aplikasi', '2024-05-30 07:11:04', '2024-05-30 07:11:04', '127.0.0.1', 'Google Chrome on mac'),
(437, 'admin01', '2024-06-01 13:03:10', 'Login aplikasi', '2024-06-01 06:03:10', '2024-06-01 06:03:10', '127.0.0.1', 'Google Chrome on mac'),
(438, 'admin01', '2024-06-01 13:08:19', 'Logout aplikasi', '2024-06-01 06:08:19', '2024-06-01 06:08:19', '127.0.0.1', 'Google Chrome on mac'),
(439, 'gerry', '2024-06-01 13:08:27', 'Login aplikasi', '2024-06-01 06:08:27', '2024-06-01 06:08:27', '127.0.0.1', 'Google Chrome on mac'),
(440, 'gerry', '2024-06-01 13:11:34', 'Logout aplikasi', '2024-06-01 06:11:34', '2024-06-01 06:11:34', '127.0.0.1', 'Google Chrome on mac'),
(441, 'admin01', '2024-06-01 13:11:36', 'Login aplikasi', '2024-06-01 06:11:36', '2024-06-01 06:11:36', '127.0.0.1', 'Google Chrome on mac'),
(442, 'admin01', '2024-06-03 14:16:35', 'Login aplikasi', '2024-06-03 07:16:35', '2024-06-03 07:16:35', '127.0.0.1', 'Google Chrome on mac'),
(443, 'admin01', '2024-06-03 14:16:57', 'Logout aplikasi', '2024-06-03 07:16:57', '2024-06-03 07:16:57', '127.0.0.1', 'Google Chrome on mac'),
(444, 'admin01', '2024-06-03 14:17:46', 'Login aplikasi', '2024-06-03 07:17:46', '2024-06-03 07:17:46', '127.0.0.1', 'Google Chrome on mac'),
(445, 'admin01', '2024-06-03 14:18:32', 'Logout aplikasi', '2024-06-03 07:18:32', '2024-06-03 07:18:32', '127.0.0.1', 'Google Chrome on mac'),
(446, 'gerry', '2024-06-03 14:18:37', 'Login aplikasi', '2024-06-03 07:18:37', '2024-06-03 07:18:37', '127.0.0.1', 'Google Chrome on mac'),
(447, 'gerry', '2024-06-03 14:19:59', 'Logout aplikasi', '2024-06-03 07:19:59', '2024-06-03 07:19:59', '127.0.0.1', 'Google Chrome on mac'),
(448, 'admin01', '2024-06-03 14:20:00', 'Login aplikasi', '2024-06-03 07:20:00', '2024-06-03 07:20:00', '127.0.0.1', 'Google Chrome on mac'),
(449, 'admin01', '2024-06-04 09:45:15', 'Login aplikasi', '2024-06-04 02:45:15', '2024-06-04 02:45:15', '127.0.0.1', 'Google Chrome on mac'),
(450, 'admin01', '2024-06-04 09:48:59', 'Logout aplikasi', '2024-06-04 02:48:59', '2024-06-04 02:48:59', '127.0.0.1', 'Google Chrome on mac'),
(451, 'gerry', '2024-06-04 09:49:04', 'Login aplikasi', '2024-06-04 02:49:04', '2024-06-04 02:49:04', '127.0.0.1', 'Google Chrome on mac'),
(452, 'gerry', '2024-06-04 09:56:33', 'Logout aplikasi', '2024-06-04 02:56:33', '2024-06-04 02:56:33', '127.0.0.1', 'Google Chrome on mac'),
(453, 'admin01', '2024-06-04 09:56:35', 'Login aplikasi', '2024-06-04 02:56:35', '2024-06-04 02:56:35', '127.0.0.1', 'Google Chrome on mac'),
(454, 'admin01', '2024-06-04 18:40:11', 'Login aplikasi', '2024-06-04 11:40:11', '2024-06-04 11:40:11', '127.0.0.1', 'Google Chrome on mac'),
(455, 'admin01', '2024-06-04 18:53:11', 'Logout aplikasi', '2024-06-04 11:53:11', '2024-06-04 11:53:11', '127.0.0.1', 'Google Chrome on mac'),
(456, 'gerry', '2024-06-04 18:53:18', 'Login aplikasi', '2024-06-04 11:53:18', '2024-06-04 11:53:18', '127.0.0.1', 'Google Chrome on mac'),
(457, 'admin01', '2024-06-05 08:10:30', 'Login aplikasi', '2024-06-05 01:10:30', '2024-06-05 01:10:30', '127.0.0.1', 'Google Chrome on mac'),
(458, 'admin01', '2024-06-05 10:01:57', 'Login aplikasi', '2024-06-05 03:01:57', '2024-06-05 03:01:57', '127.0.0.1', 'Google Chrome on mac'),
(459, 'admin01', '2024-06-05 10:06:52', 'Login aplikasi', '2024-06-05 03:06:52', '2024-06-05 03:06:52', '127.0.0.1', 'Google Chrome on mac'),
(460, 'admin01', '2024-06-05 10:17:55', 'Login aplikasi', '2024-06-05 03:17:55', '2024-06-05 03:17:55', '127.0.0.1', 'Google Chrome on mac'),
(461, 'admin01', '2024-06-05 10:23:11', 'Logout aplikasi', '2024-06-05 03:23:11', '2024-06-05 03:23:11', '127.0.0.1', 'Google Chrome on mac'),
(462, 'gerry', '2024-06-05 10:23:17', 'Login aplikasi', '2024-06-05 03:23:17', '2024-06-05 03:23:17', '127.0.0.1', 'Google Chrome on mac'),
(463, 'gerry', '2024-06-05 10:31:09', 'Simpan data pemasukan', '2024-06-05 03:31:09', '2024-06-05 03:31:09', '127.0.0.1', 'Google Chrome on mac'),
(464, 'gerry', '2024-06-05 10:32:11', 'Simpan data pemasukan', '2024-06-05 03:32:11', '2024-06-05 03:32:11', '127.0.0.1', 'Google Chrome on mac'),
(465, 'gerry', '2024-06-05 10:41:53', 'Logout aplikasi', '2024-06-05 03:41:53', '2024-06-05 03:41:53', '127.0.0.1', 'Google Chrome on mac'),
(466, 'admin01', '2024-06-05 10:42:13', 'Login aplikasi', '2024-06-05 03:42:13', '2024-06-05 03:42:13', '127.0.0.1', 'Google Chrome on mac'),
(467, 'admin01', '2024-06-05 10:42:33', 'Logout aplikasi', '2024-06-05 03:42:33', '2024-06-05 03:42:33', '127.0.0.1', 'Google Chrome on mac'),
(468, 'gilang', '2024-06-05 10:42:41', 'Login aplikasi', '2024-06-05 03:42:41', '2024-06-05 03:42:41', '127.0.0.1', 'Google Chrome on mac'),
(469, 'admin01', '2024-06-05 10:44:27', 'Login aplikasi', '2024-06-05 03:44:27', '2024-06-05 03:44:27', '127.0.0.1', 'Mozilla Firefox on mac'),
(470, 'gilang', '2024-06-05 10:48:24', 'Logout aplikasi', '2024-06-05 03:48:24', '2024-06-05 03:48:24', '127.0.0.1', 'Google Chrome on mac'),
(471, 'admin01', '2024-06-05 10:58:51', 'Login aplikasi', '2024-06-05 03:58:51', '2024-06-05 03:58:51', '127.0.0.1', 'Google Chrome on mac'),
(472, 'admin01', '2024-06-05 21:15:32', 'Login aplikasi', '2024-06-05 14:15:32', '2024-06-05 14:15:32', '127.0.0.1', 'Google Chrome on mac'),
(473, 'admin01', '2024-06-05 22:28:43', 'Login aplikasi', '2024-06-05 15:28:43', '2024-06-05 15:28:43', '127.0.0.1', 'Google Chrome on mac'),
(474, 'admin01', '2024-06-06 04:49:50', 'Login aplikasi', '2024-06-05 21:49:50', '2024-06-05 21:49:50', '127.0.0.1', 'Google Chrome on mac'),
(475, 'admin01', '2024-06-06 07:58:16', 'Login aplikasi', '2024-06-06 00:58:16', '2024-06-06 00:58:16', '127.0.0.1', 'Google Chrome on mac'),
(476, 'admin01', '2024-06-06 09:03:17', 'Login aplikasi', '2024-06-06 02:03:17', '2024-06-06 02:03:17', '127.0.0.1', 'Google Chrome on mac'),
(477, 'admin01', '2024-06-06 09:03:32', 'Logout aplikasi', '2024-06-06 02:03:32', '2024-06-06 02:03:32', '127.0.0.1', 'Google Chrome on mac'),
(478, 'gerry', '2024-06-06 09:03:41', 'Login aplikasi', '2024-06-06 02:03:41', '2024-06-06 02:03:41', '127.0.0.1', 'Google Chrome on mac'),
(479, 'gerry', '2024-06-06 09:23:30', 'Logout aplikasi', '2024-06-06 02:23:30', '2024-06-06 02:23:30', '127.0.0.1', 'Google Chrome on mac'),
(480, 'admin01', '2024-06-06 09:23:31', 'Login aplikasi', '2024-06-06 02:23:31', '2024-06-06 02:23:31', '127.0.0.1', 'Google Chrome on mac'),
(481, 'admin01', '2024-06-06 09:23:51', 'Logout aplikasi', '2024-06-06 02:23:51', '2024-06-06 02:23:51', '127.0.0.1', 'Google Chrome on mac'),
(482, 'heru27', '2024-06-06 09:23:59', 'Login aplikasi', '2024-06-06 02:23:59', '2024-06-06 02:23:59', '127.0.0.1', 'Google Chrome on mac'),
(483, 'heru27', '2024-06-06 09:24:13', 'Logout aplikasi', '2024-06-06 02:24:13', '2024-06-06 02:24:13', '127.0.0.1', 'Google Chrome on mac'),
(484, 'admin01', '2024-06-06 09:24:15', 'Login aplikasi', '2024-06-06 02:24:15', '2024-06-06 02:24:15', '127.0.0.1', 'Google Chrome on mac'),
(485, 'admin01', '2024-06-06 09:26:56', 'Logout aplikasi', '2024-06-06 02:26:56', '2024-06-06 02:26:56', '127.0.0.1', 'Google Chrome on mac'),
(486, 'admin01', '2024-06-06 09:26:57', 'Login aplikasi', '2024-06-06 02:26:57', '2024-06-06 02:26:57', '127.0.0.1', 'Google Chrome on mac'),
(487, 'admin01', '2024-06-06 09:27:25', 'Logout aplikasi', '2024-06-06 02:27:25', '2024-06-06 02:27:25', '127.0.0.1', 'Google Chrome on mac'),
(488, 'heru27', '2024-06-06 09:27:33', 'Login aplikasi', '2024-06-06 02:27:33', '2024-06-06 02:27:33', '127.0.0.1', 'Google Chrome on mac'),
(489, 'heru27', '2024-06-06 09:29:26', 'Logout aplikasi', '2024-06-06 02:29:26', '2024-06-06 02:29:26', '127.0.0.1', 'Google Chrome on mac'),
(490, 'admin01', '2024-06-06 09:30:29', 'Login aplikasi', '2024-06-06 02:30:29', '2024-06-06 02:30:29', '127.0.0.1', 'Google Chrome on mac'),
(491, 'admin01', '2024-06-06 09:31:10', 'Logout aplikasi', '2024-06-06 02:31:10', '2024-06-06 02:31:10', '127.0.0.1', 'Google Chrome on mac'),
(492, 'gilang', '2024-06-06 09:31:17', 'Login aplikasi', '2024-06-06 02:31:17', '2024-06-06 02:31:17', '127.0.0.1', 'Google Chrome on mac'),
(493, 'gilang', '2024-06-06 09:49:01', 'Logout aplikasi', '2024-06-06 02:49:01', '2024-06-06 02:49:01', '127.0.0.1', 'Google Chrome on mac'),
(494, 'heru27', '2024-06-06 09:49:08', 'Login aplikasi', '2024-06-06 02:49:08', '2024-06-06 02:49:08', '127.0.0.1', 'Google Chrome on mac'),
(495, 'heru27', '2024-06-06 09:49:17', 'Logout aplikasi', '2024-06-06 02:49:17', '2024-06-06 02:49:17', '127.0.0.1', 'Google Chrome on mac'),
(496, 'admin01', '2024-06-06 09:49:18', 'Login aplikasi', '2024-06-06 02:49:18', '2024-06-06 02:49:18', '127.0.0.1', 'Google Chrome on mac'),
(497, 'admin01', '2024-06-06 09:49:38', 'Logout aplikasi', '2024-06-06 02:49:38', '2024-06-06 02:49:38', '127.0.0.1', 'Google Chrome on mac'),
(498, 'heru27', '2024-06-06 09:49:44', 'Login aplikasi', '2024-06-06 02:49:44', '2024-06-06 02:49:44', '127.0.0.1', 'Google Chrome on mac'),
(499, 'heru27', '2024-06-06 09:50:40', 'Logout aplikasi', '2024-06-06 02:50:40', '2024-06-06 02:50:40', '127.0.0.1', 'Google Chrome on mac'),
(500, 'admin01', '2024-06-06 09:52:10', 'Login aplikasi', '2024-06-06 02:52:10', '2024-06-06 02:52:10', '127.0.0.1', 'Google Chrome on mac'),
(501, 'admin01', '2024-06-08 08:28:48', 'Login aplikasi', '2024-06-08 01:28:48', '2024-06-08 01:28:48', '127.0.0.1', 'Google Chrome on mac'),
(502, 'admin01', '2024-06-08 08:29:00', 'Logout aplikasi', '2024-06-08 01:29:00', '2024-06-08 01:29:00', '127.0.0.1', 'Google Chrome on mac'),
(503, 'admin01', '2024-06-14 09:58:24', 'Login aplikasi', '2024-06-14 02:58:24', '2024-06-14 02:58:24', '127.0.0.1', 'Google Chrome on mac'),
(504, 'admin01', '2024-06-14 10:09:33', 'Logout aplikasi', '2024-06-14 03:09:33', '2024-06-14 03:09:33', '127.0.0.1', 'Google Chrome on mac'),
(505, 'gerry', '2024-06-14 10:09:38', 'Login aplikasi', '2024-06-14 03:09:38', '2024-06-14 03:09:38', '127.0.0.1', 'Google Chrome on mac'),
(506, 'gerry', '2024-06-14 10:09:54', 'Logout aplikasi', '2024-06-14 03:09:54', '2024-06-14 03:09:54', '127.0.0.1', 'Google Chrome on mac'),
(507, 'admin01', '2024-06-14 10:09:56', 'Login aplikasi', '2024-06-14 03:09:56', '2024-06-14 03:09:56', '127.0.0.1', 'Google Chrome on mac'),
(508, 'admin01', '2024-06-15 15:01:42', 'Login aplikasi', '2024-06-15 08:01:42', '2024-06-15 08:01:42', '127.0.0.1', 'Google Chrome on mac'),
(509, 'admin01', '2024-06-15 16:33:11', 'Logout aplikasi', '2024-06-15 09:33:11', '2024-06-15 09:33:11', '127.0.0.1', 'Google Chrome on mac'),
(510, 'admin01', '2024-06-15 19:10:43', 'Login aplikasi', '2024-06-15 12:10:43', '2024-06-15 12:10:43', '127.0.0.1', 'Google Chrome on mac'),
(511, 'admin01', '2024-06-15 19:18:41', 'Logout aplikasi', '2024-06-15 12:18:41', '2024-06-15 12:18:41', '127.0.0.1', 'Google Chrome on mac'),
(512, 'admin01', '2024-06-15 19:25:05', 'Login aplikasi', '2024-06-15 12:25:05', '2024-06-15 12:25:05', '127.0.0.1', 'Google Chrome on mac'),
(513, 'admin01', '2024-06-20 09:42:20', 'Login aplikasi', '2024-06-20 02:42:20', '2024-06-20 02:42:20', '127.0.0.1', 'Google Chrome on mac'),
(514, 'admin01', '2024-06-20 10:20:40', 'Data Merchandise Merchant 1 berhasil ditambahkan', '2024-06-20 03:20:40', '2024-06-20 03:20:40', '127.0.0.1', 'Google Chrome on mac'),
(515, 'admin01', '2024-06-20 10:41:54', 'Logout aplikasi', '2024-06-20 03:41:54', '2024-06-20 03:41:54', '127.0.0.1', 'Google Chrome on mac'),
(516, 'heru27', '2024-06-20 10:42:02', 'Login aplikasi', '2024-06-20 03:42:02', '2024-06-20 03:42:02', '127.0.0.1', 'Google Chrome on mac'),
(517, 'heru27', '2024-06-20 10:43:47', 'Logout aplikasi', '2024-06-20 03:43:47', '2024-06-20 03:43:47', '127.0.0.1', 'Google Chrome on mac'),
(518, 'admin01', '2024-06-20 10:43:49', 'Login aplikasi', '2024-06-20 03:43:49', '2024-06-20 03:43:49', '127.0.0.1', 'Google Chrome on mac'),
(519, 'admin01', '2024-06-20 10:44:57', 'Logout aplikasi', '2024-06-20 03:44:57', '2024-06-20 03:44:57', '127.0.0.1', 'Google Chrome on mac'),
(520, 'gilang', '2024-06-20 10:45:02', 'Login aplikasi', '2024-06-20 03:45:02', '2024-06-20 03:45:02', '127.0.0.1', 'Google Chrome on mac'),
(521, 'gilang', '2024-06-20 10:46:01', 'Logout aplikasi', '2024-06-20 03:46:01', '2024-06-20 03:46:01', '127.0.0.1', 'Google Chrome on mac'),
(522, 'admin01', '2024-06-20 10:49:10', 'Login aplikasi', '2024-06-20 03:49:10', '2024-06-20 03:49:10', '127.0.0.1', 'Google Chrome on mac'),
(523, 'admin01', '2024-06-20 10:49:13', 'Logout aplikasi', '2024-06-20 03:49:13', '2024-06-20 03:49:13', '127.0.0.1', 'Google Chrome on mac'),
(524, 'admin01', '2024-06-24 15:44:18', 'Login aplikasi', '2024-06-24 08:44:18', '2024-06-24 08:44:18', '127.0.0.1', 'Google Chrome on mac'),
(525, 'admin01', '2024-06-24 15:57:20', 'Logout aplikasi', '2024-06-24 08:57:20', '2024-06-24 08:57:20', '127.0.0.1', 'Google Chrome on mac'),
(526, 'gilang', '2024-06-24 15:57:25', 'Login aplikasi', '2024-06-24 08:57:25', '2024-06-24 08:57:25', '127.0.0.1', 'Google Chrome on mac'),
(527, 'gilang', '2024-06-24 15:57:40', 'Logout aplikasi', '2024-06-24 08:57:40', '2024-06-24 08:57:40', '127.0.0.1', 'Google Chrome on mac'),
(528, 'admin01', '2024-06-24 15:57:42', 'Login aplikasi', '2024-06-24 08:57:42', '2024-06-24 08:57:42', '127.0.0.1', 'Google Chrome on mac'),
(529, 'admin01', '2024-06-24 16:10:35', 'Logout aplikasi', '2024-06-24 09:10:35', '2024-06-24 09:10:35', '127.0.0.1', 'Google Chrome on mac'),
(530, 'admin01', '2024-06-24 16:10:37', 'Login aplikasi', '2024-06-24 09:10:37', '2024-06-24 09:10:37', '127.0.0.1', 'Google Chrome on mac'),
(531, 'admin01', '2024-06-24 16:37:13', 'Logout aplikasi', '2024-06-24 09:37:13', '2024-06-24 09:37:13', '127.0.0.1', 'Google Chrome on mac'),
(532, 'gilang', '2024-06-24 16:37:19', 'Login aplikasi', '2024-06-24 09:37:19', '2024-06-24 09:37:19', '127.0.0.1', 'Google Chrome on mac'),
(533, 'gilang', '2024-06-24 16:37:56', 'Logout aplikasi', '2024-06-24 09:37:56', '2024-06-24 09:37:56', '127.0.0.1', 'Google Chrome on mac'),
(534, 'admin01', '2024-06-24 16:37:58', 'Login aplikasi', '2024-06-24 09:37:58', '2024-06-24 09:37:58', '127.0.0.1', 'Google Chrome on mac'),
(535, 'admin01', '2024-06-24 16:39:58', 'Logout aplikasi', '2024-06-24 09:39:58', '2024-06-24 09:39:58', '127.0.0.1', 'Google Chrome on mac'),
(536, 'gilang', '2024-06-24 16:40:05', 'Login aplikasi', '2024-06-24 09:40:05', '2024-06-24 09:40:05', '127.0.0.1', 'Google Chrome on mac'),
(537, 'gilang', '2024-06-24 16:41:42', 'Logout aplikasi', '2024-06-24 09:41:42', '2024-06-24 09:41:42', '127.0.0.1', 'Google Chrome on mac'),
(538, 'admin01', '2024-06-24 16:41:45', 'Login aplikasi', '2024-06-24 09:41:45', '2024-06-24 09:41:45', '127.0.0.1', 'Google Chrome on mac'),
(539, 'admin01', '2024-06-24 16:43:24', 'Update data foto profil: admin01', '2024-06-24 09:43:24', '2024-06-24 09:43:24', '127.0.0.1', 'Google Chrome on mac'),
(540, 'admin01', '2024-06-25 08:36:04', 'Login aplikasi', '2024-06-25 01:36:04', '2024-06-25 01:36:04', '127.0.0.1', 'Google Chrome on mac'),
(541, 'admin01', '2024-06-25 09:40:42', 'Logout aplikasi', '2024-06-25 02:40:42', '2024-06-25 02:40:42', '127.0.0.1', 'Google Chrome on mac'),
(542, 'gilang', '2024-06-25 09:40:48', 'Login aplikasi', '2024-06-25 02:40:48', '2024-06-25 02:40:48', '127.0.0.1', 'Google Chrome on mac'),
(543, 'gilang', '2024-06-25 09:42:41', 'Logout aplikasi', '2024-06-25 02:42:41', '2024-06-25 02:42:41', '127.0.0.1', 'Google Chrome on mac'),
(544, 'admin01', '2024-06-25 09:42:42', 'Login aplikasi', '2024-06-25 02:42:42', '2024-06-25 02:42:42', '127.0.0.1', 'Google Chrome on mac'),
(545, 'admin01', '2024-06-25 09:47:59', 'Logout aplikasi', '2024-06-25 02:47:59', '2024-06-25 02:47:59', '127.0.0.1', 'Google Chrome on mac'),
(546, 'gilang', '2024-06-25 09:48:06', 'Login aplikasi', '2024-06-25 02:48:06', '2024-06-25 02:48:06', '127.0.0.1', 'Google Chrome on mac'),
(547, 'gilang', '2024-06-25 09:50:07', 'Update data foto profil: gilang', '2024-06-25 02:50:07', '2024-06-25 02:50:07', '127.0.0.1', 'Google Chrome on mac'),
(548, 'gilang', '2024-06-25 09:51:25', 'Logout aplikasi', '2024-06-25 02:51:25', '2024-06-25 02:51:25', '127.0.0.1', 'Google Chrome on mac'),
(549, 'admin01', '2024-06-25 09:51:35', 'Login aplikasi', '2024-06-25 02:51:35', '2024-06-25 02:51:35', '127.0.0.1', 'Google Chrome on mac'),
(550, 'admin01', '2024-06-25 09:55:09', 'Logout aplikasi', '2024-06-25 02:55:09', '2024-06-25 02:55:09', '127.0.0.1', 'Google Chrome on mac'),
(551, 'gilang', '2024-06-25 09:55:16', 'Login aplikasi', '2024-06-25 02:55:16', '2024-06-25 02:55:16', '127.0.0.1', 'Google Chrome on mac'),
(552, 'gilang', '2024-06-25 09:57:55', 'Logout aplikasi', '2024-06-25 02:57:55', '2024-06-25 02:57:55', '127.0.0.1', 'Google Chrome on mac'),
(553, 'admin01', '2024-06-25 09:57:56', 'Login aplikasi', '2024-06-25 02:57:56', '2024-06-25 02:57:56', '127.0.0.1', 'Google Chrome on mac'),
(554, 'admin01', '2024-06-25 09:58:12', 'Logout aplikasi', '2024-06-25 02:58:12', '2024-06-25 02:58:12', '127.0.0.1', 'Google Chrome on mac'),
(555, 'gilang', '2024-06-25 09:58:24', 'Login aplikasi', '2024-06-25 02:58:24', '2024-06-25 02:58:24', '127.0.0.1', 'Google Chrome on mac'),
(556, 'gilang', '2024-06-25 10:17:31', 'Logout aplikasi', '2024-06-25 03:17:31', '2024-06-25 03:17:31', '127.0.0.1', 'Google Chrome on mac'),
(557, 'admin01', '2024-06-25 10:17:32', 'Login aplikasi', '2024-06-25 03:17:32', '2024-06-25 03:17:32', '127.0.0.1', 'Google Chrome on mac'),
(558, 'admin01', '2024-06-25 10:19:11', 'Data Merchandise Merchandise 1 berhasil ditambahkan', '2024-06-25 03:19:11', '2024-06-25 03:19:11', '127.0.0.1', 'Google Chrome on mac'),
(559, 'admin01', '2024-06-25 10:19:34', 'Data Merchandise Merchandise 2 berhasil ditambahkan', '2024-06-25 03:19:34', '2024-06-25 03:19:34', '127.0.0.1', 'Google Chrome on mac'),
(560, 'admin01', '2024-06-25 10:21:11', 'Data Merchandise Merchandise 3 berhasil ditambahkan', '2024-06-25 03:21:11', '2024-06-25 03:21:11', '127.0.0.1', 'Google Chrome on mac'),
(561, 'admin01', '2024-06-25 10:38:16', 'Logout aplikasi', '2024-06-25 03:38:16', '2024-06-25 03:38:16', '127.0.0.1', 'Google Chrome on mac'),
(562, 'gilang', '2024-06-25 10:38:22', 'Login aplikasi', '2024-06-25 03:38:22', '2024-06-25 03:38:22', '127.0.0.1', 'Google Chrome on mac'),
(563, 'gilang', '2024-06-25 10:41:56', 'Logout aplikasi', '2024-06-25 03:41:56', '2024-06-25 03:41:56', '127.0.0.1', 'Google Chrome on mac'),
(564, 'admin01', '2024-06-25 10:41:58', 'Login aplikasi', '2024-06-25 03:41:58', '2024-06-25 03:41:58', '127.0.0.1', 'Google Chrome on mac'),
(565, 'admin01', '2024-06-25 14:06:15', 'Login aplikasi', '2024-06-25 07:06:15', '2024-06-25 07:06:15', '127.0.0.1', 'Google Chrome on mac'),
(566, 'admin01', '2024-06-25 15:39:13', 'Login aplikasi', '2024-06-25 08:39:13', '2024-06-25 08:39:13', '127.0.0.1', 'Google Chrome on mac'),
(567, 'admin01', '2024-06-25 15:47:46', 'Simpan data pemasukan', '2024-06-25 08:47:46', '2024-06-25 08:47:46', '127.0.0.1', 'Google Chrome on mac'),
(568, 'admin01', '2024-06-25 15:52:46', 'Logout aplikasi', '2024-06-25 08:52:46', '2024-06-25 08:52:46', '127.0.0.1', 'Google Chrome on mac'),
(569, 'gilang', '2024-06-25 15:52:52', 'Login aplikasi', '2024-06-25 08:52:52', '2024-06-25 08:52:52', '127.0.0.1', 'Google Chrome on mac'),
(570, 'gilang', '2024-06-25 15:53:58', 'Logout aplikasi', '2024-06-25 08:53:58', '2024-06-25 08:53:58', '127.0.0.1', 'Google Chrome on mac'),
(571, 'admin01', '2024-06-25 15:54:05', 'Login aplikasi', '2024-06-25 08:54:05', '2024-06-25 08:54:05', '127.0.0.1', 'Google Chrome on mac'),
(572, 'admin01', '2024-06-25 18:03:32', 'Logout aplikasi', '2024-06-25 11:03:32', '2024-06-25 11:03:32', '127.0.0.1', 'Google Chrome on mac'),
(573, 'admin01', '2024-06-25 18:07:11', 'Login aplikasi', '2024-06-25 11:07:11', '2024-06-25 11:07:11', '127.0.0.1', 'Google Chrome on mac'),
(574, 'admin01', '2024-06-25 18:15:54', 'Logout aplikasi', '2024-06-25 11:15:54', '2024-06-25 11:15:54', '127.0.0.1', 'Google Chrome on mac'),
(575, 'gerry', '2024-06-25 18:16:00', 'Login aplikasi', '2024-06-25 11:16:00', '2024-06-25 11:16:00', '127.0.0.1', 'Google Chrome on mac'),
(576, 'gerry', '2024-06-25 18:18:22', 'Data Customer Rizky berhasil ditambahkan', '2024-06-25 11:18:22', '2024-06-25 11:18:22', '127.0.0.1', 'Google Chrome on mac'),
(577, 'gerry', '2024-06-25 18:43:25', 'Logout aplikasi', '2024-06-25 11:43:25', '2024-06-25 11:43:25', '127.0.0.1', 'Google Chrome on mac'),
(578, 'admin01', '2024-06-25 18:43:31', 'Login aplikasi', '2024-06-25 11:43:31', '2024-06-25 11:43:31', '127.0.0.1', 'Google Chrome on mac'),
(579, 'admin01', '2024-06-25 18:49:43', 'Logout aplikasi', '2024-06-25 11:49:43', '2024-06-25 11:49:43', '127.0.0.1', 'Google Chrome on mac'),
(580, 'gerry', '2024-06-25 18:49:51', 'Login aplikasi', '2024-06-25 11:49:51', '2024-06-25 11:49:51', '127.0.0.1', 'Google Chrome on mac'),
(581, 'gerry', '2024-06-25 18:54:52', 'Logout aplikasi', '2024-06-25 11:54:52', '2024-06-25 11:54:52', '127.0.0.1', 'Google Chrome on mac'),
(582, 'admin01', '2024-06-25 18:54:54', 'Login aplikasi', '2024-06-25 11:54:54', '2024-06-25 11:54:54', '127.0.0.1', 'Google Chrome on mac'),
(583, 'admin01', '2024-06-25 19:17:34', 'Logout aplikasi', '2024-06-25 12:17:34', '2024-06-25 12:17:34', '127.0.0.1', 'Google Chrome on mac'),
(584, 'gilang', '2024-06-25 19:17:40', 'Login aplikasi', '2024-06-25 12:17:40', '2024-06-25 12:17:40', '127.0.0.1', 'Google Chrome on mac'),
(585, 'gilang', '2024-06-25 19:18:09', 'Logout aplikasi', '2024-06-25 12:18:09', '2024-06-25 12:18:09', '127.0.0.1', 'Google Chrome on mac'),
(586, 'admin01', '2024-06-25 19:18:16', 'Login aplikasi', '2024-06-25 12:18:16', '2024-06-25 12:18:16', '127.0.0.1', 'Google Chrome on mac'),
(587, 'admin01', '2024-06-25 19:18:55', 'Logout aplikasi', '2024-06-25 12:18:55', '2024-06-25 12:18:55', '127.0.0.1', 'Google Chrome on mac'),
(588, 'gilang', '2024-06-25 19:19:01', 'Login aplikasi', '2024-06-25 12:19:01', '2024-06-25 12:19:01', '127.0.0.1', 'Google Chrome on mac'),
(589, 'gilang', '2024-06-25 19:48:08', 'Logout aplikasi', '2024-06-25 12:48:08', '2024-06-25 12:48:08', '127.0.0.1', 'Google Chrome on mac'),
(590, 'admin01', '2024-06-25 19:48:09', 'Login aplikasi', '2024-06-25 12:48:09', '2024-06-25 12:48:09', '127.0.0.1', 'Google Chrome on mac'),
(591, 'admin01', '2024-06-26 10:22:21', 'Login aplikasi', '2024-06-26 03:22:21', '2024-06-26 03:22:21', '127.0.0.1', 'Google Chrome on mac'),
(592, 'admin01', '2024-06-26 10:22:50', 'Logout aplikasi', '2024-06-26 03:22:50', '2024-06-26 03:22:50', '127.0.0.1', 'Google Chrome on mac'),
(593, 'admin01', '2024-06-26 10:23:14', 'Login aplikasi', '2024-06-26 03:23:14', '2024-06-26 03:23:14', '127.0.0.1', 'Google Chrome on mac'),
(594, 'admin01', '2024-06-26 10:23:31', 'Logout aplikasi', '2024-06-26 03:23:31', '2024-06-26 03:23:31', '127.0.0.1', 'Google Chrome on mac'),
(595, 'gerry', '2024-06-26 10:23:37', 'Login aplikasi', '2024-06-26 03:23:37', '2024-06-26 03:23:37', '127.0.0.1', 'Google Chrome on mac'),
(596, 'gerry', '2024-06-26 10:24:34', 'Logout aplikasi', '2024-06-26 03:24:34', '2024-06-26 03:24:34', '127.0.0.1', 'Google Chrome on mac'),
(597, 'admin01', '2024-06-26 10:29:02', 'Login aplikasi', '2024-06-26 03:29:02', '2024-06-26 03:29:02', '127.0.0.1', 'Google Chrome on mac'),
(598, 'admin01', '2024-06-26 10:58:42', 'Logout aplikasi', '2024-06-26 03:58:42', '2024-06-26 03:58:42', '127.0.0.1', 'Google Chrome on mac'),
(599, 'gerry', '2024-06-26 10:58:50', 'Login aplikasi', '2024-06-26 03:58:50', '2024-06-26 03:58:50', '127.0.0.1', 'Google Chrome on mac'),
(600, 'gerry', '2024-06-26 15:39:28', 'Logout aplikasi', '2024-06-26 08:39:28', '2024-06-26 08:39:28', '127.0.0.1', 'Google Chrome on mac'),
(601, 'admin01', '2024-06-26 15:39:31', 'Login aplikasi', '2024-06-26 08:39:31', '2024-06-26 08:39:31', '127.0.0.1', 'Google Chrome on mac'),
(602, 'admin01', '2024-06-26 15:49:26', 'Simpan data barang', '2024-06-26 08:49:26', '2024-06-26 08:49:26', '127.0.0.1', 'Google Chrome on mac'),
(603, 'admin01', '2024-06-26 16:11:14', 'Update data barang dengan id: 3', '2024-06-26 09:11:14', '2024-06-26 09:11:14', '127.0.0.1', 'Google Chrome on mac'),
(604, 'admin01', '2024-06-26 16:13:09', 'Hapus data barang dengan id : 3', '2024-06-26 09:13:09', '2024-06-26 09:13:09', '127.0.0.1', 'Google Chrome on mac'),
(605, 'admin01', '2024-06-26 16:38:12', 'Simpan data jasa', '2024-06-26 09:38:12', '2024-06-26 09:38:12', '127.0.0.1', 'Google Chrome on mac'),
(606, 'admin01', '2024-06-26 16:44:47', 'Update data jasa dengan id: 3', '2024-06-26 09:44:47', '2024-06-26 09:44:47', '127.0.0.1', 'Google Chrome on mac'),
(607, 'admin01', '2024-06-26 16:47:20', 'Hapus data jasa dengan id : 3', '2024-06-26 09:47:20', '2024-06-26 09:47:20', '127.0.0.1', 'Google Chrome on mac'),
(608, 'admin01', '2024-06-27 09:38:10', 'Login aplikasi', '2024-06-27 02:38:10', '2024-06-27 02:38:10', '127.0.0.1', 'Google Chrome on mac'),
(609, 'admin01', '2024-06-27 09:52:54', 'Logout aplikasi', '2024-06-27 02:52:54', '2024-06-27 02:52:54', '127.0.0.1', 'Google Chrome on mac'),
(610, 'gerry', '2024-06-27 09:52:58', 'Login aplikasi', '2024-06-27 02:52:58', '2024-06-27 02:52:58', '127.0.0.1', 'Google Chrome on mac'),
(611, 'gerry', '2024-06-27 10:01:38', 'Logout aplikasi', '2024-06-27 03:01:38', '2024-06-27 03:01:38', '127.0.0.1', 'Google Chrome on mac'),
(612, 'admin01', '2024-06-27 10:01:40', 'Login aplikasi', '2024-06-27 03:01:40', '2024-06-27 03:01:40', '127.0.0.1', 'Google Chrome on mac'),
(613, 'admin01', '2024-06-27 10:08:29', 'Logout aplikasi', '2024-06-27 03:08:29', '2024-06-27 03:08:29', '127.0.0.1', 'Google Chrome on mac'),
(614, 'gerry', '2024-06-27 10:08:34', 'Login aplikasi', '2024-06-27 03:08:34', '2024-06-27 03:08:34', '127.0.0.1', 'Google Chrome on mac'),
(615, 'gerry', '2024-06-27 10:11:24', 'Logout aplikasi', '2024-06-27 03:11:24', '2024-06-27 03:11:24', '127.0.0.1', 'Google Chrome on mac'),
(616, 'admin01', '2024-06-27 10:11:26', 'Login aplikasi', '2024-06-27 03:11:26', '2024-06-27 03:11:26', '127.0.0.1', 'Google Chrome on mac'),
(617, 'admin01', '2024-06-27 14:56:04', 'Login aplikasi', '2024-06-27 07:56:04', '2024-06-27 07:56:04', '127.0.0.1', 'Google Chrome on mac'),
(618, 'admin01', '2024-06-27 15:11:46', 'Simpan Transaksi Barang Masuk', '2024-06-27 08:11:46', '2024-06-27 08:11:46', '127.0.0.1', 'Google Chrome on mac'),
(619, 'admin01', '2024-06-27 15:38:30', 'Simpan Transaksi Barang Masuk', '2024-06-27 08:38:30', '2024-06-27 08:38:30', '127.0.0.1', 'Google Chrome on mac');

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_menus`
--

CREATE TABLE `master_menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `menu` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `is_dropdown` tinyint(1) NOT NULL DEFAULT '0',
  `position` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `master_menus`
--

INSERT INTO `master_menus` (`id`, `parent_id`, `menu`, `url`, `icon`, `status`, `is_dropdown`, `position`, `created_at`, `updated_at`) VALUES
(1, 0, 'Dashboard', '/dashboard', 'home', 1, 0, 1, '2024-05-07 22:49:33', '2024-05-07 22:49:33'),
(2, 0, 'User Management', '/users', 'user', 1, 0, 3, '2024-05-07 22:49:33', '2024-05-07 22:49:33'),
(3, 0, 'Data Pengiriman', '/data-pengiriman', 'list', 1, 0, 4, '2024-05-07 22:49:33', '2024-05-07 22:49:33'),
(4, 0, 'Data Pemasukan', '/data-pemasukan', 'trending-up', 1, 0, 5, '2024-05-07 22:49:33', '2024-05-07 22:49:33'),
(5, 0, 'Daftar Pengeluaran', '/daftar-pengeluaran', 'trending-down', 1, 0, 6, '2024-05-07 22:49:33', '2024-05-07 22:49:33'),
(6, 0, 'Supplier', '/supplier', 'shopping-bag', 1, 0, 9, '2024-05-07 22:49:33', '2024-05-07 22:49:33'),
(7, 0, 'Log Aktifitas', '/log-activity', 'clock', 1, 0, 11, '2024-05-07 22:49:33', '2024-05-07 22:49:33'),
(8, 0, 'Log Akses', '/last-login', 'activity', 1, 0, 12, '2024-05-07 22:49:33', '2024-05-07 22:49:33'),
(9, 0, 'Pengaturan', '/pengaturan', 'settings', 1, 1, 13, '2024-05-07 22:49:33', '2024-05-07 22:49:33'),
(10, 9, 'Profile', '/pengaturan/profile', '', 1, 0, 1, '2024-05-07 22:49:33', '2024-05-07 22:49:33'),
(11, 9, 'Ganti Password', '/pengaturan/ganti-password', '', 1, 0, 2, '2024-05-07 22:49:33', '2024-05-07 22:49:33'),
(12, 9, 'Hak Akses Pengguna', '/pengaturan/hak-akses', '', 1, 0, 3, '2024-05-07 22:49:33', '2024-05-07 22:49:33'),
(13, 9, 'Role Management', '/pengaturan/role-management', '', 1, 0, 4, '2024-05-07 22:49:33', '2024-05-07 22:49:33'),
(14, 0, 'Master Data', '/master-data', 'file-text', 1, 1, 2, '2024-05-07 22:49:33', '2024-05-07 22:49:33'),
(15, 14, 'Jenis Pengeluaran', '/master-data/jenis-pengeluaran', '', 1, 0, 1, '2024-05-07 22:49:33', '2024-05-07 22:49:33'),
(16, 14, 'Perlengkapan', '/master-data/perlengkapan', '', 1, 0, 2, '2024-05-07 22:49:33', '2024-05-07 22:49:33'),
(17, 0, 'Pembelian Perlengkapan', '/pembelian-perlengkapan', 'shopping-cart', 1, 0, 7, '2024-05-07 22:49:33', '2024-05-07 22:49:33'),
(18, 0, 'Laporan', '/laporan', 'file-text', 1, 1, 8, '2024-05-07 22:49:33', '2024-05-07 22:49:33'),
(19, 18, 'Laba Rugi', '/laporan/laba-rugi', '', 1, 0, 1, '2024-05-07 22:49:33', '2024-05-07 22:49:33'),
(20, 18, 'Transaksi Harian', '/laporan/transaksi-harian', '', 1, 0, 2, '2024-05-07 22:49:33', '2024-05-07 22:49:33'),
(21, 0, 'Customer', '/customer', 'users', 1, 0, 10, '2024-05-07 22:49:33', '2024-05-07 22:49:33'),
(22, 9, 'Konversi Point', '/pengaturan/konversi-point', '', 1, 0, 5, '2024-05-07 22:49:33', '2024-05-07 22:49:33'),
(23, 0, 'Invoice Format', '/invoice', 'activity', 1, 0, 14, '2024-05-07 22:49:33', '2024-05-07 22:49:33'),
(24, 0, 'Invoice', '/invoices', 'activity', 1, 1, 15, '2024-05-07 22:49:33', '2024-05-07 22:49:33'),
(25, 24, 'Create Invoice', '/invoices/create', '', 1, 0, 1, '2024-05-07 22:49:33', '2024-05-07 22:49:33'),
(26, 24, 'All Invoice', '/invoices/all', '', 1, 0, 2, '2024-05-07 22:49:33', '2024-05-07 22:49:33'),
(27, 0, 'Dashboard Customer', '/dashboard/customer', 'home', 1, 0, 16, '2024-05-07 22:49:33', '2024-05-07 22:49:33'),
(28, 0, 'Penukaran Point', '/penukaran-point', 'disc', 1, 0, 18, '2024-05-07 22:49:33', '2024-05-07 22:49:33'),
(29, 14, 'Merchandise', '/master-data/merchandise', '', 1, 0, 3, '2024-05-07 22:49:33', '2024-05-07 22:49:33'),
(30, 0, 'Penukaran Point', '/penukaran-point', 'disc', 1, 1, 19, '2024-05-07 22:49:33', '2024-05-07 22:49:33'),
(31, 30, 'Tukar Point', '/penukaran-point/', '', 1, 0, 1, '2024-05-07 22:49:33', '2024-05-07 22:49:33'),
(32, 30, 'List Penukaran Point', '/penukaran-point/list', '', 1, 0, 2, '2024-05-07 22:49:33', '2024-05-07 22:49:33');

-- --------------------------------------------------------

--
-- Struktur dari tabel `menu_permissions`
--

CREATE TABLE `menu_permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `level_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `menu_permissions`
--

INSERT INTO `menu_permissions` (`id`, `level_id`, `menu_id`, `created_at`, `updated_at`) VALUES
(118, 2, 1, '2024-05-13 23:15:14', '2024-05-13 23:15:14'),
(119, 2, 3, '2024-05-13 23:15:14', '2024-05-13 23:15:14'),
(120, 2, 4, '2024-05-13 23:15:14', '2024-05-13 23:15:14'),
(121, 2, 5, '2024-05-13 23:15:14', '2024-05-13 23:15:14'),
(122, 2, 9, '2024-05-13 23:15:14', '2024-05-13 23:15:14'),
(123, 2, 10, '2024-05-13 23:15:14', '2024-05-13 23:15:14'),
(124, 2, 11, '2024-05-13 23:15:14', '2024-05-13 23:15:14'),
(125, 2, 21, '2024-05-13 23:15:14', '2024-05-13 23:15:14'),
(224, 3, 27, '2024-06-05 19:49:35', '2024-06-05 19:49:35'),
(305, 1, 1, '2024-06-25 01:44:44', '2024-06-25 01:44:44'),
(306, 1, 2, '2024-06-25 01:44:44', '2024-06-25 01:44:44'),
(307, 1, 3, '2024-06-25 01:44:44', '2024-06-25 01:44:44'),
(308, 1, 4, '2024-06-25 01:44:44', '2024-06-25 01:44:44'),
(309, 1, 5, '2024-06-25 01:44:44', '2024-06-25 01:44:44'),
(310, 1, 6, '2024-06-25 01:44:44', '2024-06-25 01:44:44'),
(311, 1, 7, '2024-06-25 01:44:44', '2024-06-25 01:44:44'),
(312, 1, 8, '2024-06-25 01:44:44', '2024-06-25 01:44:44'),
(313, 1, 9, '2024-06-25 01:44:44', '2024-06-25 01:44:44'),
(314, 1, 10, '2024-06-25 01:44:44', '2024-06-25 01:44:44'),
(315, 1, 11, '2024-06-25 01:44:44', '2024-06-25 01:44:44'),
(316, 1, 12, '2024-06-25 01:44:44', '2024-06-25 01:44:44'),
(317, 1, 13, '2024-06-25 01:44:44', '2024-06-25 01:44:44'),
(318, 1, 14, '2024-06-25 01:44:44', '2024-06-25 01:44:44'),
(319, 1, 15, '2024-06-25 01:44:44', '2024-06-25 01:44:44'),
(320, 1, 16, '2024-06-25 01:44:44', '2024-06-25 01:44:44'),
(321, 1, 17, '2024-06-25 01:44:44', '2024-06-25 01:44:44'),
(322, 1, 18, '2024-06-25 01:44:44', '2024-06-25 01:44:44'),
(323, 1, 19, '2024-06-25 01:44:44', '2024-06-25 01:44:44'),
(324, 1, 20, '2024-06-25 01:44:44', '2024-06-25 01:44:44'),
(325, 1, 21, '2024-06-25 01:44:44', '2024-06-25 01:44:44'),
(326, 1, 22, '2024-06-25 01:44:44', '2024-06-25 01:44:44'),
(327, 1, 24, '2024-06-25 01:44:44', '2024-06-25 01:44:44'),
(328, 1, 25, '2024-06-25 01:44:44', '2024-06-25 01:44:44'),
(329, 1, 26, '2024-06-25 01:44:44', '2024-06-25 01:44:44'),
(330, 1, 29, '2024-06-25 01:44:44', '2024-06-25 01:44:44'),
(331, 1, 30, '2024-06-25 01:44:44', '2024-06-25 01:44:44'),
(332, 1, 31, '2024-06-25 01:44:44', '2024-06-25 01:44:44'),
(333, 1, 32, '2024-06-25 01:44:44', '2024-06-25 01:44:44');

-- --------------------------------------------------------

--
-- Struktur dari tabel `merchandises`
--

CREATE TABLE `merchandises` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nilai` int(11) NOT NULL DEFAULT '0',
  `gambar` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `merchandises`
--

INSERT INTO `merchandises` (`id`, `nama`, `nilai`, `gambar`, `created_at`, `updated_at`) VALUES
(1, 'Merchandise 1', 50, 'HUL54mOYs8SLlHC3hHCfkwYflWZqkkHBnUarCrED.jpg', '2024-06-24 20:19:11', '2024-06-24 20:19:11'),
(2, 'Merchandise 2', 65, 'ePo1v8WMhXx29G8TwStGpTIL046gKJsxt86j4eBf.jpg', '2024-06-24 20:19:34', '2024-06-24 20:19:34'),
(3, 'Merchandise 3', 45, '4hhToML4KkbPEKXb4aqj4sZ416Im8lmctmujQFfi.jpg', '2024-06-24 20:21:11', '2024-06-24 20:21:11');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_01_16_030909_create_levels_table', 1),
(6, '2024_01_22_020844_create_surveilance_cars_table', 1),
(7, '2024_01_23_084841_create_log_activities_table', 1),
(8, '2024_01_25_062021_create_jenis_perangkats_table', 2),
(9, '2024_01_29_022838_create_perangkats_table', 3),
(10, '2024_03_18_132255_create_obds_table', 4),
(11, '2024_04_02_102651_create_maps_table', 5),
(12, '2024_04_19_162610_create_front_cameras_table', 6),
(13, '2024_04_20_232617_create_rear_cameras_table', 6),
(14, '2024_04_22_032606_add_column_to_log_activities_table', 7),
(15, '2024_04_30_093737_drop_front_cameras_table', 8),
(16, '2024_04_30_094127_drop_jenis_perangkats_table', 9),
(17, '2024_04_30_094408_drop_maps_table', 10),
(18, '2024_04_30_094553_drop_obds_table', 11),
(19, '2024_04_30_094815_drop_perangkats_table', 12),
(20, '2024_04_30_095208_drop_rear_cameras_table', 13),
(21, '2024_04_30_095539_drop_riwayat_armadas_table', 14),
(22, '2024_04_30_100516_drop_surveilance_cars_table', 15),
(23, '2024_04_30_131120_create_data_pengirimen_table', 16),
(24, '2024_04_30_165124_add_nama_penerima_to_data_pengirimen_table', 16),
(25, '2024_05_02_032339_drop_any_column_on_users_table', 17),
(26, '2024_05_02_033854_create_daftar_pengeluarans_table', 18),
(29, '2024_05_02_085835_create_pemasukan_lainnyas_table', 19),
(30, '2024_05_03_090941_create_suppliers_table', 20),
(32, '2024_05_08_022602_create_master_menus_table', 21),
(34, '2024_05_08_062032_create_and_drop_column_on_levels_table', 22),
(35, '2024_05_08_092838_create_menu_permissions_table', 23),
(36, '2024_05_08_064826_add_google_id_to_users_table', 24),
(39, '2024_05_09_094700_add_jenis_pengiriman_to_data_pengirimen_table', 25),
(40, '2024_05_09_100229_add_bank_to_data_pengirimen_table', 25),
(41, '2024_05_08_142805_create_jenis_pengeluarans_table', 26),
(42, '2024_05_08_150216_add_column_to_daftar_pengeluarans_table', 26),
(43, '2024_05_08_150349_rename_column_to_daftar_pengeluarans_table', 27),
(44, '2024_05_08_151427_retype_column_to_daftar_pengeluarans_table', 27),
(45, '2024_05_09_022930_create_perlengkapans_table', 27),
(46, '2024_05_09_032334_create_pembelian_perlengkapans_table', 27),
(47, '2024_05_13_062027_create_customers_table', 28),
(48, '2024_05_14_020350_create_status_pengirimen_table', 29),
(49, '2024_05_16_015320_create_konversi_points_table', 30),
(50, '2024_05_25_061310_remove_tanggal_kadaluarsa_from_users_table', 31),
(51, '2024_05_25_092914_add_keterangan_tambahan_from_daftar_pengeluarans_table', 31),
(52, '2024_05_27_073832_add_column_kode_customer_to_customers', 32),
(53, '2024_05_27_035713_drop_pemasukkan_lainnya_table', 33),
(54, '2024_05_27_035823_create_pemasukkan_lainnyas_table', 33),
(56, '2024_05_28_034955_add_column_kode_customer_to_data_pengirimen', 34),
(57, '2024_05_28_042312_create_banks_table', 35),
(58, '2024_06_04_041449_create_history_limits_table', 36),
(62, '2024_06_12_062231_create_invoices_table', 37),
(63, '2024_06_12_071253_create_transaksi_invoices_table', 37),
(64, '2024_06_14_034328_create_merchandises_table', 37),
(65, '2024_06_25_034947_create_penukaran_points_table', 38),
(66, '2024_06_26_034546_create_barangs_table', 39),
(67, '2024_06_26_072205_create_jasas_table', 40),
(68, '2024_06_26_095417_create_barang_masuks_table', 41),
(69, '2024_06_26_080304_add_column_to_pemasukkan_lainnyas_table', 42);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemasukkan_lainnyas`
--

CREATE TABLE `pemasukkan_lainnyas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tgl_pemasukkan` date NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah_pemasukkan` int(11) NOT NULL,
  `sumber_pemasukkan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `diterima_oleh` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `metode_pembayaran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bukti_pembayaran` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan_tambahan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `barang_jasa` int(11) NOT NULL,
  `modal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pemasukkan_lainnyas`
--

INSERT INTO `pemasukkan_lainnyas` (`id`, `tgl_pemasukkan`, `keterangan`, `jumlah_pemasukkan`, `sumber_pemasukkan`, `diterima_oleh`, `metode_pembayaran`, `bukti_pembayaran`, `keterangan_tambahan`, `kategori`, `created_at`, `updated_at`, `barang_jasa`, `modal`) VALUES
(1, '2024-05-28', 'Pemasukan 1', 30000, 'Irwan', 'Anwar Ahmad', 'transfer', '665545255ac90.png', 'Contoh keterangan tambahan', '', '2024-05-27 19:44:57', '2024-05-27 19:44:57', 0, 0),
(2, '2024-06-05', 'Pemasukan 2', 100000, 'Gilang Ramadhan', 'Gerry', 'transfer', '665fdbf92aff0.png', 'Keterangan tambahan contoh', '', '2024-06-04 20:31:09', '2024-06-04 20:31:09', 0, 0),
(3, '2024-06-05', 'Pemasukan 3', 120000, 'Anwar', 'Gerry', 'transfer', 'LgG8tfUO81pdrFkLyjLRWNUh325OzbPQPPDLsM4m.jpg', 'Contoh keterangan', '', '2024-06-04 20:32:11', '2024-06-04 20:32:11', 0, 0),
(4, '2024-06-25', 'Pemasukan 4', 90000, 'Gilang Ramadhan', 'Anwar Ahmad', 'transfer', '667a842e5af17.png', 'Testing', '', '2024-06-25 01:47:46', '2024-06-25 01:47:46', 0, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembelian_perlengkapans`
--

CREATE TABLE `pembelian_perlengkapans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tanggal_pembelian` date NOT NULL,
  `id_perlengkapan` int(11) NOT NULL,
  `id_supplier` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nota` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pembelian_perlengkapans`
--

INSERT INTO `pembelian_perlengkapans` (`id`, `tanggal_pembelian`, `id_perlengkapan`, `id_supplier`, `harga`, `jumlah`, `keterangan`, `nota`, `created_at`, `updated_at`) VALUES
(2, '2024-05-13', 1, 1, 400000, 4, 'Pembelian kertas HVS Update', 'https://drive.google.com/file/d/16ei5CzYE9rLUQ_FR9xmDcDuSAfeSqUN7/view?usp=sharing', '2024-05-13 00:32:09', '2024-05-13 01:01:14');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penukaran_points`
--

CREATE TABLE `penukaran_points` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` int(11) NOT NULL,
  `marchendise_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `penukaran_points`
--

INSERT INTO `penukaran_points` (`id`, `customer_id`, `marchendise_id`, `created_at`, `updated_at`) VALUES
(1, 1, 2, '2024-06-25 05:51:53', '2024-06-25 05:51:53');

-- --------------------------------------------------------

--
-- Struktur dari tabel `perlengkapans`
--

CREATE TABLE `perlengkapans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_perlengkapan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `perlengkapans`
--

INSERT INTO `perlengkapans` (`id`, `nama_perlengkapan`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 'Kertas HVS', 'alat tulis kantor', '2024-05-12 02:52:58', '2024-05-12 03:00:52'),
(2, 'Tinta Printer', 'Alat tulis kantor', '2024-05-12 03:01:12', '2024-05-12 03:01:26');

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `created_at`, `updated_at`) VALUES
(5, 'App\\Models\\User', 1, 'auth_token', 'f698671651d6e8a907687838faf08c0c11366ae470c676ef431eb4ab88f8936e', '[\"*\"]', NULL, '2024-04-29 20:02:08', '2024-04-29 20:02:08'),
(6, 'App\\Models\\User', 1, 'auth_token', 'eac3b87e124d2fc0b65727d3c09127bdad1cef10976973f64a30974119eebf7f', '[\"*\"]', '2024-04-30 00:47:57', '2024-04-29 23:25:47', '2024-04-30 00:47:57');

-- --------------------------------------------------------

--
-- Struktur dari tabel `status_pengirimen`
--

CREATE TABLE `status_pengirimen` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status_pengiriman` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan_pengiriman` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `status_pengirimen`
--

INSERT INTO `status_pengirimen` (`id`, `status_pengiriman`, `keterangan_pengiriman`, `created_at`, `updated_at`) VALUES
(1, 'BKD', 'Paket anda telah diterima di Lionparcel D Angel Express', '2024-05-13 19:22:27', '2024-05-13 19:22:27'),
(2, 'CARGO PLANE', 'Paket anda sedang dalam penerbangan ke area tujuan', '2024-05-13 19:22:27', '2024-05-13 19:22:27'),
(3, 'DEL', 'Paket anda sedang dalam pengantaran ke alamat tujuan', '2024-05-13 19:22:27', '2024-05-13 19:22:27'),
(4, 'STI-DEST', 'Paket Anda Sudah sampai Gudang Lionparcel Area Tujuan', '2024-05-13 19:22:27', '2024-05-13 19:22:27'),
(5, 'POD', 'Paket anda telah diterima di alamat tujuan', '2024-05-13 19:22:27', '2024-05-13 19:22:27'),
(6, 'STI DEST-SC', 'Paket anda sedang transit', '2024-05-13 19:22:27', '2024-05-13 19:22:27'),
(7, 'PICKUP_TRUCKING', 'Paket anda sedang dalam pengantaran ka area tujuan via darat', '2024-05-13 19:22:27', '2024-05-13 19:22:27'),
(8, 'SHORTLAND', 'Paket anda sedang transit', '2024-05-13 19:22:27', '2024-05-13 19:22:27'),
(9, 'PUP', 'Paket anda sedang dalam pengantaran ke Gudang Lionparcel Makassar', '2024-05-13 19:22:27', '2024-05-13 19:22:27'),
(10, 'STI', 'Paket anda telah di terima di Gudang Lionparcel Makassar', '2024-05-13 19:22:27', '2024-05-13 19:22:27'),
(11, 'TRANSIT', 'Paket anda sedang transit', '2024-05-13 19:22:27', '2024-05-13 19:22:27'),
(12, 'DEX', 'Paket anda gagal terantar', '2024-05-13 19:22:27', '2024-05-13 19:22:27'),
(13, 'BAGGING', 'Paket anda sedang di sortir di gudang Lion parcel', '2024-05-13 19:22:27', '2024-05-13 19:22:27'),
(14, 'HAL', 'Paket sedang tertahan di gudang lionparcel', '2024-05-13 19:22:27', '2024-05-13 19:22:27'),
(15, 'CARGO TRACKING', 'Paket anda sedang dalam pengantaran ka area tujuan via darat', '2024-05-13 19:22:27', '2024-05-13 19:22:27'),
(16, 'DROPOFF_TRACKING', '', '2024-05-13 19:22:27', '2024-05-13 19:22:27'),
(17, 'HND', '', '2024-05-13 19:22:27', '2024-05-13 19:22:27'),
(18, 'STI-SC', 'Paket anda telah sampai di subconsolidator', '2024-05-13 19:22:27', '2024-05-13 19:22:27');

-- --------------------------------------------------------

--
-- Struktur dari tabel `suppliers`
--

CREATE TABLE `suppliers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_supplier` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan_barang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga` int(11) NOT NULL,
  `jumlah_barang` int(11) NOT NULL,
  `nomor_hp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `suppliers`
--

INSERT INTO `suppliers` (`id`, `nama_supplier`, `keterangan_barang`, `harga`, `jumlah_barang`, `nomor_hp`, `created_at`, `updated_at`) VALUES
(1, 'Supplier 1', 'Barang A', 100000, 200, '081289199123', '2024-05-04 03:36:54', '2024-05-04 03:37:15');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_invoices`
--

CREATE TABLE `transaksi_invoices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `data_pengiriman_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `transaksi_invoices`
--

INSERT INTO `transaksi_invoices` (`id`, `invoice_id`, `data_pengiriman_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2024-06-24 02:32:38', '2024-06-24 02:32:38'),
(2, 2, 8, '2024-06-25 05:01:12', '2024-06-25 05:01:12'),
(3, 2, 3, '2024-06-26 20:18:05', '2024-06-26 20:18:05');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `google_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nomor_telepon` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_level` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '1 = aktif, 2 = tidak aktif',
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tema` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'dark',
  `last_login` datetime DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `nama`, `username`, `email`, `google_id`, `nomor_telepon`, `user_level`, `password`, `status`, `foto`, `tema`, `last_login`, `email_verified_at`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Anwar Ahmad', 'admin01', 'admin01@lionparcel.com', NULL, '081210203040', '1', '$2y$10$kDF2oUYCq6n1RLAfNVV.a.JjuTWovN9m/.oja88VhC4q1Hpa1Sb86', '1', 'sqT09MiIWFbSmKP7nt4fPZwlk0JlTfpzztPU7gyq.png', 'dark', '2024-06-27 14:56:03', NULL, NULL, '2024-01-23 03:07:41', '2024-06-27 07:56:04'),
(8, 'Gerry', 'gerry', 'gerry.p@lionparcel.com', NULL, '082299012249', '2', '$2y$10$wLTgskKbPJYXLDC6S3h9QOXQsVWcJVazKAlLyZGzCQrC..5KT3x1a', '1', 'Y4QJWQctQbOX76wPNqgE3X8XltrEiWXaUCRVheZX.png', 'dark', '2024-06-27 10:08:33', NULL, NULL, '2024-05-01 20:50:27', '2024-06-27 03:08:34'),
(9, 'Heru Anggara', 'heru27', 'heru.a@lionparcel.com', NULL, '082234900391', '3', '$2y$10$vq83coWHMpRkTXBv6uVvkODUeLOhH9Aj4sv88SHXpI62mq1T3pqJC', '1', 'iTrHfeWQBAihnKKtogxjj8NF42kx3p8OpY5f8qv6.jpg', 'dark', '2024-06-20 10:42:02', NULL, NULL, '2024-05-01 20:54:27', '2024-06-20 03:42:02'),
(10, 'Angga Yudha', 'angga86', 'angga.y@lionparcel.com', NULL, '082189002231', '3', '$2y$10$iGYRT.7LFvFUMfvaEYeDPuXSB2foP7Ny4PZFnGtJ3AHfBcQUZo.Ia', '1', 'A5r7Snc4gi90sZFSL38goAsX2L10OQyanayBBLDz.png', 'dark', '2024-05-04 17:42:16', NULL, NULL, '2024-05-01 20:55:53', '2024-05-04 10:42:16'),
(11, 'Munawar Ahmad', 'Munawar Ahmad', 'munawarahmad758@gmail.com', '104744250601668712526', NULL, '3', '$2y$10$EXagxO6iHX1BH3VYDlAXlOdMPKM2S3VuypMKi6iCep5HUa2oyoWby', '1', NULL, 'dark', '2024-05-23 13:10:58', NULL, NULL, '2024-05-23 06:10:59', '2024-05-23 06:10:59'),
(12, 'Rendi', 'rendi123', 'rendi@mail.com', NULL, '081289102912', '3', '$2y$10$FCn5Y6l56GbiySTAgwrZkOgA.k8MW6e//QvVHaF/j5P32Mm1cpq2S', '1', NULL, 'dark', NULL, NULL, NULL, '2024-05-23 07:18:27', '2024-05-23 07:18:27'),
(13, 'Gilang Ramadhan', 'gilang', 'gilang.r@gmail.com', NULL, '082291820912', '3', '$2y$10$C8xh4uLOaOG3gCAXpWdm6ubIh8t1QeVB0rq5z.KMOC.YpR9GyvDqe', '1', 'i8c8JbAEDO92pxfRL2kPAhDDAHO9eR0s3YAQE3mq.png', 'dark', '2024-06-25 19:19:00', NULL, NULL, '2024-05-27 20:02:54', '2024-06-25 12:19:01'),
(14, 'Rizky', 'rizky', 'rizky.r@mail.com', NULL, '081290192012', '3', '$2y$10$ujs9MgK6.JL9cDbiNkrmX.gYaDvnbxbIsBOS0VdcffVWW5ayiEiHa', '1', NULL, 'dark', NULL, NULL, NULL, '2024-06-25 04:18:22', '2024-06-25 04:18:22');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `banks`
--
ALTER TABLE `banks`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `barangs`
--
ALTER TABLE `barangs`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `barang_masuks`
--
ALTER TABLE `barang_masuks`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `daftar_pengeluarans`
--
ALTER TABLE `daftar_pengeluarans`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `data_pengirimen`
--
ALTER TABLE `data_pengirimen`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `history_limits`
--
ALTER TABLE `history_limits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `history_limits_customer_id_foreign` (`customer_id`);

--
-- Indeks untuk tabel `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `invoices_invoice_no_unique` (`invoice_no`);

--
-- Indeks untuk tabel `jasas`
--
ALTER TABLE `jasas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `jenis_pengeluarans`
--
ALTER TABLE `jenis_pengeluarans`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `konversi_points`
--
ALTER TABLE `konversi_points`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `levels`
--
ALTER TABLE `levels`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `log_activities`
--
ALTER TABLE `log_activities`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `master_menus`
--
ALTER TABLE `master_menus`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `menu_permissions`
--
ALTER TABLE `menu_permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `merchandises`
--
ALTER TABLE `merchandises`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indeks untuk tabel `pemasukkan_lainnyas`
--
ALTER TABLE `pemasukkan_lainnyas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pembelian_perlengkapans`
--
ALTER TABLE `pembelian_perlengkapans`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `penukaran_points`
--
ALTER TABLE `penukaran_points`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `perlengkapans`
--
ALTER TABLE `perlengkapans`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `status_pengirimen`
--
ALTER TABLE `status_pengirimen`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `transaksi_invoices`
--
ALTER TABLE `transaksi_invoices`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `banks`
--
ALTER TABLE `banks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `barangs`
--
ALTER TABLE `barangs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `barang_masuks`
--
ALTER TABLE `barang_masuks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `daftar_pengeluarans`
--
ALTER TABLE `daftar_pengeluarans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `data_pengirimen`
--
ALTER TABLE `data_pengirimen`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `history_limits`
--
ALTER TABLE `history_limits`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `jasas`
--
ALTER TABLE `jasas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `jenis_pengeluarans`
--
ALTER TABLE `jenis_pengeluarans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `konversi_points`
--
ALTER TABLE `konversi_points`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `levels`
--
ALTER TABLE `levels`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `log_activities`
--
ALTER TABLE `log_activities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=620;

--
-- AUTO_INCREMENT untuk tabel `master_menus`
--
ALTER TABLE `master_menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT untuk tabel `menu_permissions`
--
ALTER TABLE `menu_permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=334;

--
-- AUTO_INCREMENT untuk tabel `merchandises`
--
ALTER TABLE `merchandises`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT untuk tabel `pemasukkan_lainnyas`
--
ALTER TABLE `pemasukkan_lainnyas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `pembelian_perlengkapans`
--
ALTER TABLE `pembelian_perlengkapans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `penukaran_points`
--
ALTER TABLE `penukaran_points`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `perlengkapans`
--
ALTER TABLE `perlengkapans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `status_pengirimen`
--
ALTER TABLE `status_pengirimen`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `transaksi_invoices`
--
ALTER TABLE `transaksi_invoices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `history_limits`
--
ALTER TABLE `history_limits`
  ADD CONSTRAINT `history_limits_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
