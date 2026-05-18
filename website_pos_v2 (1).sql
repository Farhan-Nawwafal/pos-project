-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 15 Apr 2026 pada 11.09
-- Versi server: 8.0.30
-- Versi PHP: 8.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Basis data: `website_pos_v2`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `activity_log`
--

CREATE TABLE `activity_log` (
  `id` bigint UNSIGNED NOT NULL,
  `log_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `event` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject_id` bigint UNSIGNED DEFAULT NULL,
  `causer_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `causer_id` bigint UNSIGNED DEFAULT NULL,
  `properties` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `batch_uuid` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ;

--
-- Dumping data untuk tabel `activity_log`
--

INSERT INTO `activity_log` (`id`, `log_name`, `description`, `subject_type`, `event`, `subject_id`, `causer_type`, `causer_id`, `properties`, `batch_uuid`, `created_at`, `updated_at`) VALUES
(1, 'transaksi_item', 'Item pesanan telah created', 'App\\Models\\TransactionItem', 'created', 1, 'App\\Models\\User', 4, '{\"attributes\":{\"quantity\":1,\"price\":2000,\"subtotal\":2000,\"product_id\":241}}', NULL, '2026-04-13 21:56:27', '2026-04-13 21:56:27'),
(2, 'transaksi_item', 'Item pesanan telah created', 'App\\Models\\TransactionItem', 'created', 2, 'App\\Models\\User', 4, '{\"attributes\":{\"quantity\":1,\"price\":29000,\"subtotal\":29000,\"product_id\":243}}', NULL, '2026-04-13 21:56:27', '2026-04-13 21:56:27'),
(3, 'deleted_item', 'Menghapus item', 'App\\Models\\Transaction', NULL, 1, 'App\\Models\\User', 4, '{\"cabang_id\":5,\"product\":\"Air Putih\",\"old_qty\":1,\"new_qty\":0,\"price\":2000,\"type\":\"removed\"}', NULL, '2026-04-13 21:57:00', '2026-04-13 21:57:00'),
(4, 'transaksi_item', 'Item pesanan telah created', 'App\\Models\\TransactionItem', 'created', 3, 'App\\Models\\User', 4, '{\"attributes\":{\"quantity\":3,\"price\":29000,\"subtotal\":87000,\"product_id\":243}}', NULL, '2026-04-13 21:57:00', '2026-04-13 21:57:00'),
(5, 'deleted_item', 'Mengurangi jumlah item', 'App\\Models\\Transaction', NULL, 1, 'App\\Models\\User', 4, '{\"cabang_id\":5,\"product\":\"Ayam BKR KPG\",\"old_qty\":3,\"new_qty\":1,\"price\":29000,\"type\":\"reduced\"}', NULL, '2026-04-13 21:57:06', '2026-04-13 21:57:06'),
(6, 'transaksi_item', 'Item pesanan telah created', 'App\\Models\\TransactionItem', 'created', 4, 'App\\Models\\User', 4, '{\"attributes\":{\"quantity\":1,\"price\":29000,\"subtotal\":29000,\"product_id\":243}}', NULL, '2026-04-13 21:57:06', '2026-04-13 21:57:06'),
(7, 'transaksi_item', 'Item pesanan telah created', 'App\\Models\\TransactionItem', 'created', 5, 'App\\Models\\User', 4, '{\"attributes\":{\"quantity\":1,\"price\":29000,\"subtotal\":29000,\"product_id\":243}}', NULL, '2026-04-13 21:57:59', '2026-04-13 21:57:59'),
(8, 'transaksi_item', 'Item pesanan telah created', 'App\\Models\\TransactionItem', 'created', 6, 'App\\Models\\User', 4, '{\"attributes\":{\"quantity\":1,\"price\":2000,\"subtotal\":2000,\"product_id\":241}}', NULL, '2026-04-13 22:00:19', '2026-04-13 22:00:19'),
(9, 'transaksi_item', 'Item pesanan telah created', 'App\\Models\\TransactionItem', 'created', 7, 'App\\Models\\User', 4, '{\"attributes\":{\"quantity\":1,\"price\":3000,\"subtotal\":3000,\"product_id\":242}}', NULL, '2026-04-13 22:00:19', '2026-04-13 22:00:19'),
(10, 'transaksi_item', 'Item pesanan telah created', 'App\\Models\\TransactionItem', 'created', 8, 'App\\Models\\User', 4, '{\"attributes\":{\"quantity\":1,\"price\":2000,\"subtotal\":2000,\"product_id\":241}}', NULL, '2026-04-13 22:00:30', '2026-04-13 22:00:30'),
(11, 'transaksi_item', 'Item pesanan telah created', 'App\\Models\\TransactionItem', 'created', 9, 'App\\Models\\User', 4, '{\"attributes\":{\"quantity\":5,\"price\":3000,\"subtotal\":15000,\"product_id\":242}}', NULL, '2026-04-13 22:00:30', '2026-04-13 22:00:30'),
(12, 'deleted_item', 'Mengurangi jumlah item', 'App\\Models\\Transaction', NULL, 2, 'App\\Models\\User', 4, '{\"cabang_id\":5,\"product\":\"Air Putih Es\",\"old_qty\":5,\"new_qty\":2,\"price\":3000,\"type\":\"reduced\"}', NULL, '2026-04-13 22:00:39', '2026-04-13 22:00:39'),
(13, 'transaksi_item', 'Item pesanan telah created', 'App\\Models\\TransactionItem', 'created', 10, 'App\\Models\\User', 4, '{\"attributes\":{\"quantity\":1,\"price\":2000,\"subtotal\":2000,\"product_id\":241}}', NULL, '2026-04-13 22:00:39', '2026-04-13 22:00:39'),
(14, 'transaksi_item', 'Item pesanan telah created', 'App\\Models\\TransactionItem', 'created', 11, 'App\\Models\\User', 4, '{\"attributes\":{\"quantity\":2,\"price\":3000,\"subtotal\":6000,\"product_id\":242}}', NULL, '2026-04-13 22:00:39', '2026-04-13 22:00:39'),
(15, 'transaksi_item', 'Item pesanan telah created', 'App\\Models\\TransactionItem', 'created', 12, 'App\\Models\\User', 3, '{\"attributes\":{\"quantity\":1,\"price\":2000,\"subtotal\":2000,\"product_id\":121}}', NULL, '2026-04-13 22:22:57', '2026-04-13 22:22:57'),
(16, 'transaksi_item', 'Item pesanan telah created', 'App\\Models\\TransactionItem', 'created', 13, 'App\\Models\\User', 4, '{\"attributes\":{\"quantity\":1,\"price\":2000,\"subtotal\":2000,\"product_id\":241}}', NULL, '2026-04-15 10:19:25', '2026-04-15 10:19:25');

-- --------------------------------------------------------

--
-- Struktur dari tabel `cabangs`
--

CREATE TABLE `cabangs` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` enum('active','inactive') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `cabangs`
--

INSERT INTO `cabangs` (`id`, `name`, `address`, `is_active`, `created_at`, `updated_at`) VALUES
(2, 'Kantor Pusat', 'Alamat Pusat', 'active', '2026-04-12 16:23:41', '2026-04-12 16:23:41'),
(4, 'Ciawi - Alas Bu Yanti', 'Jl. Raya Ciawi Prapatan No.6, Harjasari, Kec. Bogor Sel., Kota Bogor, Jawa Barat 16720', 'active', '2026-04-13 20:47:47', '2026-04-13 20:47:47'),
(5, 'Sholis - Alas Bu Yanti', 'Jl. Sholeh Iskandar, RT.03/RW.01, Kedungbadak, Tanah Sareal, Kota Bogor, Jawa Barat 16164', 'active', '2026-04-13 20:48:14', '2026-04-13 20:48:14');

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('alas-bu-yanti-cache-spatie.permission.cache', 'a:3:{s:5:\"alias\";a:4:{s:1:\"a\";s:2:\"id\";s:1:\"b\";s:4:\"name\";s:1:\"c\";s:10:\"guard_name\";s:1:\"r\";s:5:\"roles\";}s:11:\"permissions\";a:81:{i:0;a:4:{s:1:\"a\";i:1;s:1:\"b\";s:16:\"dashboard.access\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:7:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:4;i:4;i:5;i:5;i:6;i:6;i:7;}}i:1;a:4:{s:1:\"a\";i:2;s:1:\"b\";s:10:\"pos.access\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:4;i:3;i:7;}}i:2;a:4:{s:1:\"a\";i:3;s:1:\"b\";s:11:\"guides.view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:7:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:4;i:4;i:5;i:5;i:6;i:6;i:7;}}i:3;a:4:{s:1:\"a\";i:4;s:1:\"b\";s:13:\"products.view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:6:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:4;i:4;i:5;i:5;i:7;}}i:4;a:4:{s:1:\"a\";i:5;s:1:\"b\";s:15:\"products.create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:5;a:4:{s:1:\"a\";i:6;s:1:\"b\";s:13:\"products.edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:6;a:4:{s:1:\"a\";i:7;s:1:\"b\";s:15:\"products.delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:7;a:4:{s:1:\"a\";i:8;s:1:\"b\";s:15:\"categories.view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:6:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:4;i:4;i:5;i:5;i:7;}}i:8;a:4:{s:1:\"a\";i:9;s:1:\"b\";s:17:\"categories.create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:9;a:4:{s:1:\"a\";i:10;s:1:\"b\";s:15:\"categories.edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:10;a:4:{s:1:\"a\";i:11;s:1:\"b\";s:17:\"categories.delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:11;a:4:{s:1:\"a\";i:12;s:1:\"b\";s:17:\"transactions.view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:5:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:4;i:4;i:6;}}i:12;a:4:{s:1:\"a\";i:13;s:1:\"b\";s:20:\"transactions.details\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:5:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:4;i:4;i:6;}}i:13;a:4:{s:1:\"a\";i:14;s:1:\"b\";s:21:\"transactions.pii.view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:5:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:4;i:4;i:6;}}i:14;a:4:{s:1:\"a\";i:15;s:1:\"b\";s:18:\"transactions.print\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:5:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:4;i:4;i:6;}}i:15;a:4:{s:1:\"a\";i:16;s:1:\"b\";s:17:\"transactions.void\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:16;a:4:{s:1:\"a\";i:17;s:1:\"b\";s:19:\"transactions.refund\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:17;a:4:{s:1:\"a\";i:18;s:1:\"b\";s:25:\"transactions.void.approve\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:18;a:4:{s:1:\"a\";i:19;s:1:\"b\";s:27:\"transactions.refund.approve\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:19;a:4:{s:1:\"a\";i:20;s:1:\"b\";s:12:\"members.view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:4;}}i:20;a:4:{s:1:\"a\";i:21;s:1:\"b\";s:14:\"members.create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:4;}}i:21;a:4:{s:1:\"a\";i:22;s:1:\"b\";s:12:\"members.edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:22;a:4:{s:1:\"a\";i:23;s:1:\"b\";s:14:\"members.delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:23;a:4:{s:1:\"a\";i:24;s:1:\"b\";s:16:\"members.pii.view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:4;}}i:24;a:4:{s:1:\"a\";i:25;s:1:\"b\";s:20:\"members.regions.view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:25;a:4:{s:1:\"a\";i:26;s:1:\"b\";s:22:\"members.regions.manage\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:26;a:4:{s:1:\"a\";i:27;s:1:\"b\";s:12:\"reports.view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:6;}}i:27;a:4:{s:1:\"a\";i:28;s:1:\"b\";s:13:\"reports.sales\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:6;}}i:28;a:4:{s:1:\"a\";i:29;s:1:\"b\";s:19:\"reports.performance\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:6;}}i:29;a:4:{s:1:\"a\";i:30;s:1:\"b\";s:23:\"reports.expenses.manage\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:6;}}i:30;a:4:{s:1:\"a\";i:31;s:1:\"b\";s:13:\"vouchers.view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:6;}}i:31;a:4:{s:1:\"a\";i:32;s:1:\"b\";s:15:\"vouchers.manage\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:32;a:4:{s:1:\"a\";i:33;s:1:\"b\";s:22:\"discounts.manual.apply\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:4;}}i:33;a:4:{s:1:\"a\";i:34;s:1:\"b\";s:14:\"inventory.view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:5;}}i:34;a:4:{s:1:\"a\";i:35;s:1:\"b\";s:16:\"inventory.manage\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:5;}}i:35;a:4:{s:1:\"a\";i:36;s:1:\"b\";s:26:\"inventory.ingredients.view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:5;}}i:36;a:4:{s:1:\"a\";i:37;s:1:\"b\";s:28:\"inventory.ingredients.manage\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:5;}}i:37;a:4:{s:1:\"a\";i:38;s:1:\"b\";s:24:\"inventory.suppliers.view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:5;}}i:38;a:4:{s:1:\"a\";i:39;s:1:\"b\";s:26:\"inventory.suppliers.manage\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:5;}}i:39;a:4:{s:1:\"a\";i:40;s:1:\"b\";s:24:\"inventory.movements.view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:5;}}i:40;a:4:{s:1:\"a\";i:41;s:1:\"b\";s:26:\"inventory.movements.manage\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:5;}}i:41;a:4:{s:1:\"a\";i:42;s:1:\"b\";s:26:\"inventory.movements.create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:5;}}i:42;a:4:{s:1:\"a\";i:43;s:1:\"b\";s:26:\"inventory.movements.delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:5;}}i:43;a:4:{s:1:\"a\";i:44;s:1:\"b\";s:24:\"inventory.purchases.view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:5;}}i:44;a:4:{s:1:\"a\";i:45;s:1:\"b\";s:26:\"inventory.purchases.manage\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:5;}}i:45;a:4:{s:1:\"a\";i:46;s:1:\"b\";s:26:\"inventory.purchases.create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:5;}}i:46;a:4:{s:1:\"a\";i:47;s:1:\"b\";s:24:\"inventory.purchases.edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:5;}}i:47;a:4:{s:1:\"a\";i:48;s:1:\"b\";s:27:\"inventory.purchases.receive\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:5;}}i:48;a:4:{s:1:\"a\";i:49;s:1:\"b\";s:26:\"inventory.purchases.cancel\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:5;}}i:49;a:4:{s:1:\"a\";i:50;s:1:\"b\";s:22:\"inventory.opnames.view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:5;}}i:50;a:4:{s:1:\"a\";i:51;s:1:\"b\";s:24:\"inventory.opnames.manage\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:5;}}i:51;a:4:{s:1:\"a\";i:52;s:1:\"b\";s:24:\"inventory.opnames.create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:5;}}i:52;a:4:{s:1:\"a\";i:53;s:1:\"b\";s:22:\"inventory.opnames.edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:5;}}i:53;a:4:{s:1:\"a\";i:54;s:1:\"b\";s:39:\"inventory.opnames.refresh_system_stocks\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:5;}}i:54;a:4:{s:1:\"a\";i:55;s:1:\"b\";s:22:\"inventory.opnames.post\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:5;}}i:55;a:4:{s:1:\"a\";i:56;s:1:\"b\";s:24:\"inventory.opnames.cancel\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:5;}}i:56;a:4:{s:1:\"a\";i:57;s:1:\"b\";s:22:\"inventory.reports.view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:5:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:5;i:4;i:6;}}i:57;a:4:{s:1:\"a\";i:58;s:1:\"b\";s:10:\"users.view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:58;a:4:{s:1:\"a\";i:59;s:1:\"b\";s:12:\"users.create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:59;a:4:{s:1:\"a\";i:60;s:1:\"b\";s:10:\"users.edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:60;a:4:{s:1:\"a\";i:61;s:1:\"b\";s:12:\"users.delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:61;a:4:{s:1:\"a\";i:62;s:1:\"b\";s:11:\"cabang.view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:62;a:4:{s:1:\"a\";i:63;s:1:\"b\";s:13:\"cabang.create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:63;a:4:{s:1:\"a\";i:64;s:1:\"b\";s:11:\"cabang.edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:64;a:4:{s:1:\"a\";i:65;s:1:\"b\";s:13:\"cabang.delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:65;a:4:{s:1:\"a\";i:66;s:1:\"b\";s:10:\"roles.view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:66;a:4:{s:1:\"a\";i:67;s:1:\"b\";s:12:\"roles.manage\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:67;a:4:{s:1:\"a\";i:68;s:1:\"b\";s:18:\"dining_tables.view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:4;}}i:68;a:4:{s:1:\"a\";i:69;s:1:\"b\";s:18:\"dining_tables.edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:4;}}i:69;a:4:{s:1:\"a\";i:70;s:1:\"b\";s:13:\"settings.view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:70;a:4:{s:1:\"a\";i:71;s:1:\"b\";s:13:\"settings.edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:71;a:4:{s:1:\"a\";i:72;s:1:\"b\";s:19:\"settings.store.view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:72;a:4:{s:1:\"a\";i:73;s:1:\"b\";s:19:\"settings.store.edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:73;a:4:{s:1:\"a\";i:74;s:1:\"b\";s:22:\"settings.printers.view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:74;a:4:{s:1:\"a\";i:75;s:1:\"b\";s:22:\"settings.printers.edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:75;a:4:{s:1:\"a\";i:76;s:1:\"b\";s:20:\"settings.system.view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:76;a:4:{s:1:\"a\";i:77;s:1:\"b\";s:20:\"settings.system.edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:77;a:4:{s:1:\"a\";i:78;s:1:\"b\";s:20:\"settings.points.view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:78;a:4:{s:1:\"a\";i:79;s:1:\"b\";s:20:\"settings.points.edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:79;a:4:{s:1:\"a\";i:80;s:1:\"b\";s:21:\"settings.targets.view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:80;a:4:{s:1:\"a\";i:81;s:1:\"b\";s:21:\"settings.targets.edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}}s:5:\"roles\";a:7:{i:0;a:3:{s:1:\"a\";i:1;s:1:\"b\";s:5:\"owner\";s:1:\"c\";s:3:\"web\";}i:1;a:3:{s:1:\"a\";i:2;s:1:\"b\";s:5:\"admin\";s:1:\"c\";s:3:\"web\";}i:2;a:3:{s:1:\"a\";i:3;s:1:\"b\";s:7:\"manager\";s:1:\"c\";s:3:\"web\";}i:3;a:3:{s:1:\"a\";i:4;s:1:\"b\";s:7:\"cashier\";s:1:\"c\";s:3:\"web\";}i:4;a:3:{s:1:\"a\";i:5;s:1:\"b\";s:9:\"inventory\";s:1:\"c\";s:3:\"web\";}i:5;a:3:{s:1:\"a\";i:6;s:1:\"b\";s:10:\"accountant\";s:1:\"c\";s:3:\"web\";}i:6;a:3:{s:1:\"a\";i:7;s:1:\"b\";s:6:\"waiter\";s:1:\"c\";s:3:\"web\";}}}', 1776265281),
('laravel-cache-spatie.permission.cache', 'a:3:{s:5:\"alias\";a:4:{s:1:\"a\";s:2:\"id\";s:1:\"b\";s:4:\"name\";s:1:\"c\";s:10:\"guard_name\";s:1:\"r\";s:5:\"roles\";}s:11:\"permissions\";a:81:{i:0;a:4:{s:1:\"a\";i:1;s:1:\"b\";s:16:\"dashboard.access\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:7:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:4;i:4;i:5;i:5;i:6;i:6;i:7;}}i:1;a:4:{s:1:\"a\";i:2;s:1:\"b\";s:10:\"pos.access\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:4;i:3;i:7;}}i:2;a:4:{s:1:\"a\";i:3;s:1:\"b\";s:11:\"guides.view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:7:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:4;i:4;i:5;i:5;i:6;i:6;i:7;}}i:3;a:4:{s:1:\"a\";i:4;s:1:\"b\";s:13:\"products.view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:6:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:4;i:4;i:5;i:5;i:7;}}i:4;a:4:{s:1:\"a\";i:5;s:1:\"b\";s:15:\"products.create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:5;a:4:{s:1:\"a\";i:6;s:1:\"b\";s:13:\"products.edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:6;a:4:{s:1:\"a\";i:7;s:1:\"b\";s:15:\"products.delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:7;a:4:{s:1:\"a\";i:8;s:1:\"b\";s:15:\"categories.view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:6:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:4;i:4;i:5;i:5;i:7;}}i:8;a:4:{s:1:\"a\";i:9;s:1:\"b\";s:17:\"categories.create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:9;a:4:{s:1:\"a\";i:10;s:1:\"b\";s:15:\"categories.edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:10;a:4:{s:1:\"a\";i:11;s:1:\"b\";s:17:\"categories.delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:11;a:4:{s:1:\"a\";i:12;s:1:\"b\";s:17:\"transactions.view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:5:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:4;i:4;i:6;}}i:12;a:4:{s:1:\"a\";i:13;s:1:\"b\";s:20:\"transactions.details\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:5:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:4;i:4;i:6;}}i:13;a:4:{s:1:\"a\";i:14;s:1:\"b\";s:21:\"transactions.pii.view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:5:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:4;i:4;i:6;}}i:14;a:4:{s:1:\"a\";i:15;s:1:\"b\";s:18:\"transactions.print\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:5:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:4;i:4;i:6;}}i:15;a:4:{s:1:\"a\";i:16;s:1:\"b\";s:17:\"transactions.void\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:16;a:4:{s:1:\"a\";i:17;s:1:\"b\";s:19:\"transactions.refund\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:17;a:4:{s:1:\"a\";i:18;s:1:\"b\";s:25:\"transactions.void.approve\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:18;a:4:{s:1:\"a\";i:19;s:1:\"b\";s:27:\"transactions.refund.approve\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:19;a:4:{s:1:\"a\";i:20;s:1:\"b\";s:12:\"members.view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:4;}}i:20;a:4:{s:1:\"a\";i:21;s:1:\"b\";s:14:\"members.create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:4;}}i:21;a:4:{s:1:\"a\";i:22;s:1:\"b\";s:12:\"members.edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:22;a:4:{s:1:\"a\";i:23;s:1:\"b\";s:14:\"members.delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:23;a:4:{s:1:\"a\";i:24;s:1:\"b\";s:16:\"members.pii.view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:4;}}i:24;a:4:{s:1:\"a\";i:25;s:1:\"b\";s:20:\"members.regions.view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:25;a:4:{s:1:\"a\";i:26;s:1:\"b\";s:22:\"members.regions.manage\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:26;a:4:{s:1:\"a\";i:27;s:1:\"b\";s:12:\"reports.view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:6;}}i:27;a:4:{s:1:\"a\";i:28;s:1:\"b\";s:13:\"reports.sales\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:6;}}i:28;a:4:{s:1:\"a\";i:29;s:1:\"b\";s:19:\"reports.performance\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:6;}}i:29;a:4:{s:1:\"a\";i:30;s:1:\"b\";s:23:\"reports.expenses.manage\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:6;}}i:30;a:4:{s:1:\"a\";i:31;s:1:\"b\";s:13:\"vouchers.view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:6;}}i:31;a:4:{s:1:\"a\";i:32;s:1:\"b\";s:15:\"vouchers.manage\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:32;a:4:{s:1:\"a\";i:33;s:1:\"b\";s:22:\"discounts.manual.apply\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:4;}}i:33;a:4:{s:1:\"a\";i:34;s:1:\"b\";s:14:\"inventory.view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:5;}}i:34;a:4:{s:1:\"a\";i:35;s:1:\"b\";s:16:\"inventory.manage\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:5;}}i:35;a:4:{s:1:\"a\";i:36;s:1:\"b\";s:26:\"inventory.ingredients.view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:5;}}i:36;a:4:{s:1:\"a\";i:37;s:1:\"b\";s:28:\"inventory.ingredients.manage\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:5;}}i:37;a:4:{s:1:\"a\";i:38;s:1:\"b\";s:24:\"inventory.suppliers.view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:5;}}i:38;a:4:{s:1:\"a\";i:39;s:1:\"b\";s:26:\"inventory.suppliers.manage\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:5;}}i:39;a:4:{s:1:\"a\";i:40;s:1:\"b\";s:24:\"inventory.movements.view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:5;}}i:40;a:4:{s:1:\"a\";i:41;s:1:\"b\";s:26:\"inventory.movements.manage\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:5;}}i:41;a:4:{s:1:\"a\";i:42;s:1:\"b\";s:26:\"inventory.movements.create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:5;}}i:42;a:4:{s:1:\"a\";i:43;s:1:\"b\";s:26:\"inventory.movements.delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:5;}}i:43;a:4:{s:1:\"a\";i:44;s:1:\"b\";s:24:\"inventory.purchases.view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:5;}}i:44;a:4:{s:1:\"a\";i:45;s:1:\"b\";s:26:\"inventory.purchases.manage\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:5;}}i:45;a:4:{s:1:\"a\";i:46;s:1:\"b\";s:26:\"inventory.purchases.create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:5;}}i:46;a:4:{s:1:\"a\";i:47;s:1:\"b\";s:24:\"inventory.purchases.edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:5;}}i:47;a:4:{s:1:\"a\";i:48;s:1:\"b\";s:27:\"inventory.purchases.receive\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:5;}}i:48;a:4:{s:1:\"a\";i:49;s:1:\"b\";s:26:\"inventory.purchases.cancel\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:5;}}i:49;a:4:{s:1:\"a\";i:50;s:1:\"b\";s:22:\"inventory.opnames.view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:5;}}i:50;a:4:{s:1:\"a\";i:51;s:1:\"b\";s:24:\"inventory.opnames.manage\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:5;}}i:51;a:4:{s:1:\"a\";i:52;s:1:\"b\";s:24:\"inventory.opnames.create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:5;}}i:52;a:4:{s:1:\"a\";i:53;s:1:\"b\";s:22:\"inventory.opnames.edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:5;}}i:53;a:4:{s:1:\"a\";i:54;s:1:\"b\";s:39:\"inventory.opnames.refresh_system_stocks\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:5;}}i:54;a:4:{s:1:\"a\";i:55;s:1:\"b\";s:22:\"inventory.opnames.post\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:5;}}i:55;a:4:{s:1:\"a\";i:56;s:1:\"b\";s:24:\"inventory.opnames.cancel\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:5;}}i:56;a:4:{s:1:\"a\";i:57;s:1:\"b\";s:22:\"inventory.reports.view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:5:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:5;i:4;i:6;}}i:57;a:4:{s:1:\"a\";i:58;s:1:\"b\";s:10:\"users.view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:58;a:4:{s:1:\"a\";i:59;s:1:\"b\";s:12:\"users.create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:59;a:4:{s:1:\"a\";i:60;s:1:\"b\";s:10:\"users.edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:60;a:4:{s:1:\"a\";i:61;s:1:\"b\";s:12:\"users.delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:61;a:4:{s:1:\"a\";i:62;s:1:\"b\";s:11:\"cabang.view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:62;a:4:{s:1:\"a\";i:63;s:1:\"b\";s:13:\"cabang.create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:63;a:4:{s:1:\"a\";i:64;s:1:\"b\";s:11:\"cabang.edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:64;a:4:{s:1:\"a\";i:65;s:1:\"b\";s:13:\"cabang.delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:65;a:4:{s:1:\"a\";i:66;s:1:\"b\";s:10:\"roles.view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:66;a:4:{s:1:\"a\";i:67;s:1:\"b\";s:12:\"roles.manage\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:67;a:4:{s:1:\"a\";i:68;s:1:\"b\";s:18:\"dining_tables.view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:4;}}i:68;a:4:{s:1:\"a\";i:69;s:1:\"b\";s:18:\"dining_tables.edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:4;}}i:69;a:4:{s:1:\"a\";i:70;s:1:\"b\";s:13:\"settings.view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:70;a:4:{s:1:\"a\";i:71;s:1:\"b\";s:13:\"settings.edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:71;a:4:{s:1:\"a\";i:72;s:1:\"b\";s:19:\"settings.store.view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:72;a:4:{s:1:\"a\";i:73;s:1:\"b\";s:19:\"settings.store.edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:73;a:4:{s:1:\"a\";i:74;s:1:\"b\";s:22:\"settings.printers.view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:74;a:4:{s:1:\"a\";i:75;s:1:\"b\";s:22:\"settings.printers.edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:75;a:4:{s:1:\"a\";i:76;s:1:\"b\";s:20:\"settings.system.view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:76;a:4:{s:1:\"a\";i:77;s:1:\"b\";s:20:\"settings.system.edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:77;a:4:{s:1:\"a\";i:78;s:1:\"b\";s:20:\"settings.points.view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:78;a:4:{s:1:\"a\";i:79;s:1:\"b\";s:20:\"settings.points.edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:79;a:4:{s:1:\"a\";i:80;s:1:\"b\";s:21:\"settings.targets.view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:80;a:4:{s:1:\"a\";i:81;s:1:\"b\";s:21:\"settings.targets.edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}}s:5:\"roles\";a:7:{i:0;a:3:{s:1:\"a\";i:1;s:1:\"b\";s:5:\"owner\";s:1:\"c\";s:3:\"web\";}i:1;a:3:{s:1:\"a\";i:2;s:1:\"b\";s:5:\"admin\";s:1:\"c\";s:3:\"web\";}i:2;a:3:{s:1:\"a\";i:3;s:1:\"b\";s:7:\"manager\";s:1:\"c\";s:3:\"web\";}i:3;a:3:{s:1:\"a\";i:4;s:1:\"b\";s:7:\"cashier\";s:1:\"c\";s:3:\"web\";}i:4;a:3:{s:1:\"a\";i:5;s:1:\"b\";s:9:\"inventory\";s:1:\"c\";s:3:\"web\";}i:5;a:3:{s:1:\"a\";i:6;s:1:\"b\";s:10:\"accountant\";s:1:\"c\";s:3:\"web\";}i:6;a:3:{s:1:\"a\";i:7;s:1:\"b\";s:6:\"waiter\";s:1:\"c\";s:3:\"web\";}}}', 1776333051);

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
-- Struktur dari tabel `categories`
--

CREATE TABLE `categories` (
  `id` bigint UNSIGNED NOT NULL,
  `cabang_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `categories`
--

INSERT INTO `categories` (`id`, `cabang_id`, `name`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 2, 'Minuman', NULL, '2026-04-13 20:57:43', '2026-04-13 20:57:43'),
(2, 2, 'Gorengan', NULL, '2026-04-13 20:57:49', '2026-04-13 20:57:49'),
(3, 2, 'Tumisan', NULL, '2026-04-13 20:57:54', '2026-04-13 20:57:54'),
(4, 2, 'Pepesan', NULL, '2026-04-13 21:36:27', '2026-04-13 21:36:27'),
(5, 2, 'Bakaran', NULL, '2026-04-13 21:36:32', '2026-04-13 21:36:32'),
(6, 2, 'Kuahan', NULL, '2026-04-13 21:40:29', '2026-04-13 21:40:29'),
(7, 4, 'Minuman', NULL, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(8, 4, 'Gorengan', NULL, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(9, 4, 'Tumisan', NULL, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(10, 4, 'Kuahan', NULL, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(11, 5, 'Minuman', NULL, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(12, 5, 'Gorengan', NULL, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(13, 5, 'Tumisan', NULL, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(14, 5, 'Kuahan', NULL, '2026-04-13 21:56:00', '2026-04-13 21:56:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `dining_tables`
--

CREATE TABLE `dining_tables` (
  `id` bigint UNSIGNED NOT NULL,
  `cabang_id` bigint UNSIGNED NOT NULL,
  `table_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'available',
  `occupied_at` timestamp NULL DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qr_value` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `dining_tables`
--

INSERT INTO `dining_tables` (`id`, `cabang_id`, `table_number`, `status`, `occupied_at`, `image`, `qr_value`, `created_at`, `updated_at`) VALUES
(1, 2, '1', 'available', NULL, 'qr_codes/1.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-XK-nFrG-76e7b1', '2026-04-13 16:48:23', '2026-04-13 16:48:23'),
(2, 2, '2', 'available', NULL, 'qr_codes/2.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-1g9-vDp4-807c1d', '2026-04-13 16:48:23', '2026-04-13 16:48:23'),
(3, 2, '3', 'available', NULL, 'qr_codes/3.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-2rY-ZeOs-cfda07', '2026-04-13 16:48:23', '2026-04-13 16:48:23'),
(4, 2, '4', 'available', NULL, 'qr_codes/4.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-2mL-X4vs-ee38c5', '2026-04-13 16:48:23', '2026-04-13 16:48:23'),
(5, 2, '5', 'available', NULL, 'qr_codes/5.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-zl-dP2X-bb3039', '2026-04-13 16:48:23', '2026-04-13 16:48:23'),
(6, 2, '6', 'available', NULL, 'qr_codes/6.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-2sJ-100zg-8f88c4', '2026-04-13 16:48:23', '2026-04-13 16:48:23'),
(7, 2, '7', 'available', NULL, 'qr_codes/7.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-ng-9Tbi-ca0346', '2026-04-13 16:48:23', '2026-04-13 16:48:23'),
(8, 2, '8', 'available', NULL, 'qr_codes/8.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-2fk-UpmR-88ea1a', '2026-04-13 16:48:23', '2026-04-13 16:48:23'),
(9, 2, '9', 'available', NULL, 'qr_codes/9.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-1tv-BkKd-0a65cd', '2026-04-13 16:48:23', '2026-04-13 16:48:23'),
(10, 2, '10', 'available', NULL, 'qr_codes/10.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-16I-rGQt-a74e96', '2026-04-13 16:48:24', '2026-04-13 16:48:24'),
(11, 2, '11', 'available', NULL, 'qr_codes/11.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-P1-kwih-6f8f43', '2026-04-13 16:48:24', '2026-04-13 16:48:24'),
(12, 2, '12', 'available', NULL, 'qr_codes/12.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-1lH-xJm8-754464', '2026-04-13 16:48:24', '2026-04-13 16:48:24'),
(13, 2, '13', 'available', NULL, 'qr_codes/13.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-vT-cPfv-d9ad4c', '2026-04-13 16:48:24', '2026-04-13 16:48:24'),
(14, 2, '14', 'available', NULL, 'qr_codes/14.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-1aq-tt3p-20f9cd', '2026-04-13 16:48:24', '2026-04-13 16:48:24'),
(15, 2, '15', 'available', NULL, 'qr_codes/15.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-1Zk-NL0w-1a5337', '2026-04-13 16:48:24', '2026-04-13 16:48:24'),
(16, 2, '16', 'available', NULL, 'qr_codes/16.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-N5-kiZs-7eb2b8', '2026-04-13 16:48:24', '2026-04-13 16:48:24'),
(17, 2, '17', 'available', NULL, 'qr_codes/17.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-11Q-qjka-4cdf27', '2026-04-13 16:48:24', '2026-04-13 16:48:24'),
(18, 2, '18', 'available', NULL, 'qr_codes/18.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-Nw-jYNh-26171e', '2026-04-13 16:48:24', '2026-04-13 16:48:24'),
(19, 2, '19', 'available', NULL, 'qr_codes/19.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-QX-lT2t-b6cefb', '2026-04-13 16:48:24', '2026-04-13 16:48:24'),
(20, 2, '20', 'available', NULL, 'qr_codes/20.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-1PD-JNAI-0c82ca', '2026-04-13 16:48:24', '2026-04-13 16:48:24'),
(21, 2, '21', 'available', NULL, 'qr_codes/21.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-1lm-xWIQ-fa1601', '2026-04-13 16:48:24', '2026-04-13 16:48:24'),
(22, 2, '22', 'available', NULL, 'qr_codes/22.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-DK-gkON-5a1fe9', '2026-04-13 16:48:24', '2026-04-13 16:48:24'),
(23, 2, '23', 'available', NULL, 'qr_codes/23.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-1Ns-Jymo-01bc59', '2026-04-13 16:48:24', '2026-04-13 16:48:24'),
(24, 2, '24', 'available', NULL, 'qr_codes/24.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-1a4-tGnN-d5a44b', '2026-04-13 16:48:24', '2026-04-13 16:48:24'),
(25, 2, '25', 'available', NULL, 'qr_codes/25.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-1Mh-J3Bb-496f3c', '2026-04-13 16:48:24', '2026-04-13 16:48:24'),
(26, 2, '26', 'available', NULL, 'qr_codes/26.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-Wf-o6T2-4266c9', '2026-04-13 16:48:24', '2026-04-13 16:48:24'),
(27, 2, '27', 'available', NULL, 'qr_codes/27.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-1p2-zIVg-3cc087', '2026-04-13 16:48:24', '2026-04-13 16:48:24'),
(28, 2, '28', 'available', NULL, 'qr_codes/28.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-Mq-jfYh-f74c48', '2026-04-13 16:48:24', '2026-04-13 16:48:24'),
(29, 2, '29', 'available', NULL, 'qr_codes/29.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-O9-kTBT-b38444', '2026-04-13 16:48:24', '2026-04-13 16:48:24'),
(30, 2, '30', 'available', NULL, 'qr_codes/30.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-11q-pqAV-d6df0c', '2026-04-13 16:48:24', '2026-04-13 16:48:24'),
(31, 2, '31', 'available', NULL, 'qr_codes/31.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-pM-aM9C-552043', '2026-04-13 16:48:24', '2026-04-13 16:48:24'),
(32, 2, '32', 'available', NULL, 'qr_codes/32.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-vf-cXKU-e28d03', '2026-04-13 16:48:24', '2026-04-13 16:48:24'),
(33, 2, '33', 'available', NULL, 'qr_codes/33.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-1Ck-Edww-2be6a2', '2026-04-13 16:48:24', '2026-04-13 16:48:24'),
(34, 2, '34', 'available', NULL, 'qr_codes/34.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-Po-ljTB-a9613f', '2026-04-13 16:48:24', '2026-04-13 16:48:24'),
(35, 2, '35', 'available', NULL, 'qr_codes/35.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-1Jl-HYE1-e8f18c', '2026-04-13 16:48:24', '2026-04-13 16:48:24'),
(36, 2, '36', 'available', NULL, 'qr_codes/36.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-2pw-YUox-939edc', '2026-04-13 16:48:24', '2026-04-13 16:48:24'),
(37, 2, '37', 'available', NULL, 'qr_codes/37.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-Ro-lB7c-e8c7ef', '2026-04-13 16:48:24', '2026-04-13 16:48:24'),
(38, 2, '38', 'available', NULL, 'qr_codes/38.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-Aw-fkXP-ee14fe', '2026-04-13 16:48:24', '2026-04-13 16:48:24'),
(39, 2, '39', 'available', NULL, 'qr_codes/39.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-27B-ROUZ-7adafd', '2026-04-13 16:48:24', '2026-04-13 16:48:24'),
(40, 2, '40', 'available', NULL, 'qr_codes/40.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-Tu-n4oT-d01746', '2026-04-13 16:48:24', '2026-04-13 16:48:24'),
(41, 2, '41', 'available', NULL, 'qr_codes/41.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-1P0-K3nM-faacaf', '2026-04-13 16:48:24', '2026-04-13 16:48:24'),
(42, 2, '42', 'available', NULL, 'qr_codes/42.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-1y9-DvrY-ec73f9', '2026-04-13 16:48:24', '2026-04-13 16:48:24'),
(43, 2, '43', 'available', NULL, 'qr_codes/43.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-By-fQx4-173eb8', '2026-04-13 16:48:24', '2026-04-13 16:48:24'),
(44, 2, '44', 'available', NULL, 'qr_codes/44.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-2aR-SOzW-383fd3', '2026-04-13 16:48:24', '2026-04-13 16:48:24'),
(45, 2, '45', 'available', NULL, 'qr_codes/45.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-MW-kbdI-5bd0e7', '2026-04-13 16:48:24', '2026-04-13 16:48:24'),
(46, 2, '46', 'available', NULL, 'qr_codes/46.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-2jX-WPxo-ea7668', '2026-04-13 16:48:24', '2026-04-13 16:48:24'),
(47, 2, '47', 'available', NULL, 'qr_codes/47.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-gd-6Y5t-fddfe6', '2026-04-13 16:48:24', '2026-04-13 16:48:24'),
(48, 2, '48', 'available', NULL, 'qr_codes/48.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-2dI-THnr-bc2836', '2026-04-13 16:48:24', '2026-04-13 16:48:24'),
(49, 2, '49', 'available', NULL, 'qr_codes/49.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-OK-knMC-31f96e', '2026-04-13 16:48:24', '2026-04-13 16:48:24'),
(50, 2, '50', 'available', NULL, 'qr_codes/50.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-2r8-ZpnR-9b0456', '2026-04-13 16:48:24', '2026-04-13 16:48:24'),
(51, 2, '51', 'available', NULL, 'qr_codes/51.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-1bT-tJBt-f20a2b', '2026-04-13 16:48:24', '2026-04-13 16:48:24'),
(52, 2, '52', 'available', NULL, 'qr_codes/52.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-1Pc-JU69-6a91ce', '2026-04-13 16:48:24', '2026-04-13 16:48:24'),
(53, 2, '53', 'available', NULL, 'qr_codes/53.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-16e-rJTk-71e4e2', '2026-04-13 16:48:24', '2026-04-13 16:48:24'),
(54, 2, '54', 'available', NULL, 'qr_codes/54.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-1wh-BZhE-24554c', '2026-04-13 16:48:24', '2026-04-13 16:48:24'),
(55, 2, '55', 'available', NULL, 'qr_codes/55.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-BK-fH6W-3ac215', '2026-04-13 16:48:24', '2026-04-13 16:48:24'),
(56, 2, '56', 'available', NULL, 'qr_codes/56.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-OO-ksaN-1da097', '2026-04-13 16:48:24', '2026-04-13 16:48:24'),
(57, 2, '57', 'available', NULL, 'qr_codes/57.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-25C-QiR6-d74aa5', '2026-04-13 16:48:24', '2026-04-13 16:48:24'),
(58, 2, '58', 'available', NULL, 'qr_codes/58.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-BN-fNby-36c894', '2026-04-13 16:48:24', '2026-04-13 16:48:24'),
(59, 2, '59', 'available', NULL, 'qr_codes/59.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-2hL-VqOb-33d140', '2026-04-13 16:48:24', '2026-04-13 16:48:24'),
(60, 2, '60', 'available', NULL, 'qr_codes/60.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-1yn-Drku-95e747', '2026-04-13 16:48:24', '2026-04-13 16:48:24'),
(61, 2, '61', 'available', NULL, 'qr_codes/61.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-i9-89Vn-1bb095', '2026-04-13 16:48:24', '2026-04-13 16:48:24'),
(62, 2, '62', 'available', NULL, 'qr_codes/62.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-2d7-TQF4-e2a10d', '2026-04-13 16:48:24', '2026-04-13 16:48:24'),
(63, 2, '63', 'available', NULL, 'qr_codes/63.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-2A3-13q5j-2aaa5b', '2026-04-13 16:48:24', '2026-04-13 16:48:24'),
(64, 2, '64', 'available', NULL, 'qr_codes/64.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-N0-k1Fz-fe6332', '2026-04-13 16:48:24', '2026-04-13 16:48:24'),
(65, 2, '65', 'available', NULL, 'qr_codes/65.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-2p0-YVQi-7c8d6a', '2026-04-13 16:48:24', '2026-04-13 16:48:24'),
(66, 2, '66', 'available', NULL, 'qr_codes/66.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-sr-bOlm-0690de', '2026-04-13 16:48:24', '2026-04-13 16:48:24'),
(67, 2, '67', 'available', NULL, 'qr_codes/67.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-2uq-118ha-f52b74', '2026-04-13 16:48:24', '2026-04-13 16:48:24'),
(68, 2, '68', 'available', NULL, 'qr_codes/68.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-sD-bAcG-a75891', '2026-04-13 16:48:24', '2026-04-13 16:48:24'),
(69, 2, '69', 'available', NULL, 'qr_codes/69.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-2j9-VLrF-5a21ce', '2026-04-13 16:48:24', '2026-04-13 16:48:24'),
(70, 2, '70', 'available', NULL, 'qr_codes/70.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-1bh-tR0g-80b1b4', '2026-04-13 16:48:24', '2026-04-13 16:48:24'),
(71, 2, '71', 'available', NULL, 'qr_codes/71.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-1dA-v7g8-bb0f47', '2026-04-13 16:48:24', '2026-04-13 16:48:24'),
(72, 2, '72', 'available', NULL, 'qr_codes/72.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-1j4-xiIp-9068c7', '2026-04-13 16:48:24', '2026-04-13 16:48:24'),
(73, 2, '73', 'available', NULL, 'qr_codes/73.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-DX-h1dX-5edca4', '2026-04-13 16:48:24', '2026-04-13 16:48:24'),
(74, 2, '74', 'available', NULL, 'qr_codes/74.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-21d-OO5m-92ea56', '2026-04-13 16:48:24', '2026-04-13 16:48:24'),
(75, 2, '75', 'available', NULL, 'qr_codes/75.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-SG-n1CM-721d4e', '2026-04-13 16:48:24', '2026-04-13 16:48:24'),
(76, 2, '76', 'available', NULL, 'qr_codes/76.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-1Os-K2If-b11e7b', '2026-04-13 16:48:24', '2026-04-13 16:48:24'),
(77, 2, '77', 'available', NULL, 'qr_codes/77.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-1zI-DKq2-278543', '2026-04-13 16:48:24', '2026-04-13 16:48:24'),
(78, 2, '78', 'available', NULL, 'qr_codes/78.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-2gX-VuLm-18c4b5', '2026-04-13 16:48:24', '2026-04-13 16:48:24'),
(79, 2, '79', 'available', NULL, 'qr_codes/79.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-oJ-aThp-8781a7', '2026-04-13 16:48:24', '2026-04-13 16:48:24'),
(80, 2, '80', 'available', NULL, 'qr_codes/80.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-2g1-UTIs-448e1b', '2026-04-13 16:48:24', '2026-04-13 16:48:24'),
(81, 2, '81', 'available', NULL, 'qr_codes/81.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-le-8ZrK-78fe0a', '2026-04-13 16:48:24', '2026-04-13 16:48:24'),
(82, 2, '82', 'available', NULL, 'qr_codes/82.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-2g5-URgi-b9c772', '2026-04-13 16:48:24', '2026-04-13 16:48:24'),
(83, 2, '83', 'available', NULL, 'qr_codes/83.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-1N8-Jiu0-ac8765', '2026-04-13 16:48:24', '2026-04-13 16:48:24'),
(84, 2, '84', 'available', NULL, 'qr_codes/84.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-1SG-LrPL-ff3981', '2026-04-13 16:48:24', '2026-04-13 16:48:24'),
(85, 2, '85', 'available', NULL, 'qr_codes/85.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-172-sj08-0c6716', '2026-04-13 16:48:24', '2026-04-13 16:48:24'),
(86, 2, '86', 'available', NULL, 'qr_codes/86.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-Sr-m5By-ce8976', '2026-04-13 16:48:24', '2026-04-13 16:48:24'),
(87, 2, '87', 'available', NULL, 'qr_codes/87.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-253-Qtr1-44994c', '2026-04-13 16:48:24', '2026-04-13 16:48:24'),
(88, 2, '88', 'available', NULL, 'qr_codes/88.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-10k-pmn5-e0870b', '2026-04-13 16:48:24', '2026-04-13 16:48:24'),
(89, 2, '89', 'available', NULL, 'qr_codes/89.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-27V-RmFB-cc5eab', '2026-04-13 16:48:24', '2026-04-13 16:48:24'),
(90, 2, '90', 'available', NULL, 'qr_codes/90.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-1AQ-Ej7z-2aac7c', '2026-04-13 16:48:24', '2026-04-13 16:48:24'),
(91, 2, '91', 'available', NULL, 'qr_codes/91.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-1IM-HQ8C-55843e', '2026-04-13 16:48:24', '2026-04-13 16:48:24'),
(92, 2, '92', 'available', NULL, 'qr_codes/92.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-1ZD-O5E0-6d4d62', '2026-04-13 16:48:24', '2026-04-13 16:48:24'),
(93, 2, '93', 'available', NULL, 'qr_codes/93.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-1ii-xtBQ-5fd383', '2026-04-13 16:48:24', '2026-04-13 16:48:24'),
(94, 2, '94', 'available', NULL, 'qr_codes/94.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-1sV-ASrU-9c58bf', '2026-04-13 16:48:24', '2026-04-13 16:48:24'),
(95, 2, '95', 'available', NULL, 'qr_codes/95.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-2cz-TQNz-d182a9', '2026-04-13 16:48:24', '2026-04-13 16:48:24'),
(96, 2, '96', 'available', NULL, 'qr_codes/96.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-24t-QEAI-7098b2', '2026-04-13 16:48:24', '2026-04-13 16:48:24'),
(97, 2, '97', 'available', NULL, 'qr_codes/97.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-PT-lWXf-0577f3', '2026-04-13 16:48:24', '2026-04-13 16:48:24'),
(98, 2, '98', 'available', NULL, 'qr_codes/98.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-186-sKNt-09c0c3', '2026-04-13 16:48:24', '2026-04-13 16:48:24'),
(99, 2, '99', 'available', NULL, 'qr_codes/99.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-1RL-LJ2H-b5a20a', '2026-04-13 16:48:24', '2026-04-13 16:48:24'),
(100, 2, '100', 'available', NULL, 'qr_codes/100.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-1OE-JFTl-7c2224', '2026-04-13 16:48:24', '2026-04-13 16:48:24'),
(101, 4, '1', 'occupied', '2026-04-13 22:22:57', 'qr_codes/101.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-1mZ-yPyp-16517b', '2026-04-13 21:54:30', '2026-04-13 22:22:57'),
(102, 4, '2', 'available', NULL, 'qr_codes/102.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-2n0-YotN-9fdd98', '2026-04-13 21:54:30', '2026-04-13 21:54:30'),
(103, 4, '3', 'available', NULL, 'qr_codes/103.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-2kg-Xihw-36cd75', '2026-04-13 21:54:30', '2026-04-13 21:54:30'),
(104, 4, '4', 'available', NULL, 'qr_codes/104.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-rc-c46N-45dd1b', '2026-04-13 21:54:30', '2026-04-13 21:54:30'),
(105, 4, '5', 'available', NULL, 'qr_codes/105.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-1Es-GbNC-352033', '2026-04-13 21:54:30', '2026-04-13 21:54:30'),
(106, 4, '6', 'available', NULL, 'qr_codes/106.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-gm-7ujZ-395d0d', '2026-04-13 21:54:30', '2026-04-13 21:54:30'),
(107, 4, '7', 'available', NULL, 'qr_codes/107.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-2sz-10Ezb-18317d', '2026-04-13 21:54:30', '2026-04-13 21:54:30'),
(108, 4, '8', 'available', NULL, 'qr_codes/108.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-qA-b3nd-b6f569', '2026-04-13 21:54:30', '2026-04-13 21:54:30'),
(109, 4, '9', 'available', NULL, 'qr_codes/109.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-1Ns-K5SW-f1fb18', '2026-04-13 21:54:30', '2026-04-13 21:54:30'),
(110, 4, '10', 'available', NULL, 'qr_codes/110.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-I4-iqdP-a07afa', '2026-04-13 21:54:30', '2026-04-13 21:54:30'),
(111, 4, '11', 'available', NULL, 'qr_codes/111.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-FC-h4eK-3a3a0e', '2026-04-13 21:54:30', '2026-04-13 21:54:30'),
(112, 4, '12', 'available', NULL, 'qr_codes/112.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-19P-uan2-322b38', '2026-04-13 21:54:30', '2026-04-13 21:54:30'),
(113, 4, '13', 'available', NULL, 'qr_codes/113.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-1ay-tRMe-c9722d', '2026-04-13 21:54:30', '2026-04-13 21:54:30'),
(114, 4, '14', 'available', NULL, 'qr_codes/114.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-1PQ-KcjN-957072', '2026-04-13 21:54:30', '2026-04-13 21:54:30'),
(115, 4, '15', 'available', NULL, 'qr_codes/115.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-Rr-maoz-869578', '2026-04-13 21:54:30', '2026-04-13 21:54:30'),
(116, 4, '16', 'available', NULL, 'qr_codes/116.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-Ud-neZ2-4a2274', '2026-04-13 21:54:30', '2026-04-13 21:54:30'),
(117, 4, '17', 'available', NULL, 'qr_codes/117.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-1Yb-Ow8z-69978e', '2026-04-13 21:54:30', '2026-04-13 21:54:30'),
(118, 4, '18', 'available', NULL, 'qr_codes/118.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-1kH-yxyQ-31582a', '2026-04-13 21:54:30', '2026-04-13 21:54:30'),
(119, 4, '19', 'available', NULL, 'qr_codes/119.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-1IT-Htwl-7b45fe', '2026-04-13 21:54:30', '2026-04-13 21:54:30'),
(120, 4, '20', 'available', NULL, 'qr_codes/120.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-t7-c9A0-e3c1de', '2026-04-13 21:54:30', '2026-04-13 21:54:30'),
(121, 4, '21', 'available', NULL, 'qr_codes/121.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-1eA-vuz2-248ac2', '2026-04-13 21:54:30', '2026-04-13 21:54:30'),
(122, 4, '22', 'available', NULL, 'qr_codes/122.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-1r9-Ajl6-a847b8', '2026-04-13 21:54:30', '2026-04-13 21:54:30'),
(123, 4, '23', 'available', NULL, 'qr_codes/123.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-kx-8ZAf-2ac673', '2026-04-13 21:54:30', '2026-04-13 21:54:30'),
(124, 4, '24', 'available', NULL, 'qr_codes/124.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-2jz-Wlgk-bafde6', '2026-04-13 21:54:30', '2026-04-13 21:54:30'),
(125, 4, '25', 'available', NULL, 'qr_codes/125.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-qt-b7RP-d17b06', '2026-04-13 21:54:30', '2026-04-13 21:54:30'),
(126, 4, '26', 'available', NULL, 'qr_codes/126.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-1CS-FAFJ-0c3dc1', '2026-04-13 21:54:30', '2026-04-13 21:54:30'),
(127, 4, '27', 'available', NULL, 'qr_codes/127.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-28q-S9OU-6411f7', '2026-04-13 21:54:30', '2026-04-13 21:54:30'),
(128, 4, '28', 'available', NULL, 'qr_codes/128.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-GW-iCIt-76424e', '2026-04-13 21:54:30', '2026-04-13 21:54:30'),
(129, 4, '29', 'available', NULL, 'qr_codes/129.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-2gb-VtjR-d97bd8', '2026-04-13 21:54:30', '2026-04-13 21:54:30'),
(130, 4, '30', 'available', NULL, 'qr_codes/130.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-NU-lqQ7-8f6aa2', '2026-04-13 21:54:30', '2026-04-13 21:54:30'),
(131, 4, '31', 'available', NULL, 'qr_codes/131.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-1yK-DMO4-d4a720', '2026-04-13 21:54:30', '2026-04-13 21:54:30'),
(132, 4, '32', 'available', NULL, 'qr_codes/132.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-1dq-uVcP-24ace4', '2026-04-13 21:54:30', '2026-04-13 21:54:30'),
(133, 4, '33', 'available', NULL, 'qr_codes/133.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-Yl-oLGx-9292c6', '2026-04-13 21:54:30', '2026-04-13 21:54:30'),
(134, 4, '34', 'available', NULL, 'qr_codes/134.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-2of-YMJe-524f49', '2026-04-13 21:54:30', '2026-04-13 21:54:30'),
(135, 4, '35', 'available', NULL, 'qr_codes/135.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-2l5-XRhD-eef184', '2026-04-13 21:54:30', '2026-04-13 21:54:30'),
(136, 4, '36', 'available', NULL, 'qr_codes/136.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-RM-mZUh-551905', '2026-04-13 21:54:30', '2026-04-13 21:54:30'),
(137, 4, '37', 'available', NULL, 'qr_codes/137.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-1BZ-EMuP-9c2a0d', '2026-04-13 21:54:30', '2026-04-13 21:54:30'),
(138, 4, '38', 'available', NULL, 'qr_codes/138.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-U9-n7Xc-b80b1e', '2026-04-13 21:54:30', '2026-04-13 21:54:30'),
(139, 4, '39', 'available', NULL, 'qr_codes/139.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-2gl-Vlfx-4fbd8a', '2026-04-13 21:54:30', '2026-04-13 21:54:30'),
(140, 4, '40', 'available', NULL, 'qr_codes/140.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-Y1-oZ9G-2a34a6', '2026-04-13 21:54:30', '2026-04-13 21:54:30'),
(141, 4, '41', 'available', NULL, 'qr_codes/141.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-2aH-TlmP-554d46', '2026-04-13 21:54:30', '2026-04-13 21:54:30'),
(142, 4, '42', 'available', NULL, 'qr_codes/142.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-1A5-EpRs-1fff7c', '2026-04-13 21:54:30', '2026-04-13 21:54:30'),
(143, 4, '43', 'available', NULL, 'qr_codes/143.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-1yj-DT7P-8dcdbd', '2026-04-13 21:54:30', '2026-04-13 21:54:30'),
(144, 4, '44', 'available', NULL, 'qr_codes/144.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-We-oAqB-3982ef', '2026-04-13 21:54:30', '2026-04-13 21:54:30'),
(145, 4, '45', 'available', NULL, 'qr_codes/145.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-2r8-ZKGS-aeeea4', '2026-04-13 21:54:30', '2026-04-13 21:54:30'),
(146, 4, '46', 'available', NULL, 'qr_codes/146.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-1SO-Mej1-4f87c5', '2026-04-13 21:54:30', '2026-04-13 21:54:30'),
(147, 4, '47', 'available', NULL, 'qr_codes/147.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-2rb-ZQXR-37f68e', '2026-04-13 21:54:30', '2026-04-13 21:54:30'),
(148, 4, '48', 'available', NULL, 'qr_codes/148.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-gU-8eDV-379d44', '2026-04-13 21:54:30', '2026-04-13 21:54:30'),
(149, 4, '49', 'available', NULL, 'qr_codes/149.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-2dp-Ugwj-41d92f', '2026-04-13 21:54:30', '2026-04-13 21:54:30'),
(150, 4, '50', 'available', NULL, 'qr_codes/150.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-1Br-EUFA-466cc9', '2026-04-13 21:54:30', '2026-04-13 21:54:30'),
(151, 4, '51', 'available', NULL, 'qr_codes/151.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-194-tfTe-cc8454', '2026-04-13 21:54:30', '2026-04-13 21:54:30'),
(152, 4, '52', 'available', NULL, 'qr_codes/152.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-2kI-WW0j-52474a', '2026-04-13 21:54:30', '2026-04-13 21:54:30'),
(153, 4, '53', 'available', NULL, 'qr_codes/153.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-Gs-hGLm-6f3163', '2026-04-13 21:54:30', '2026-04-13 21:54:30'),
(154, 4, '54', 'available', NULL, 'qr_codes/154.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-1ut-CcGq-9572b5', '2026-04-13 21:54:30', '2026-04-13 21:54:30'),
(155, 4, '55', 'available', NULL, 'qr_codes/155.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-2pa-Zns6-37e00f', '2026-04-13 21:54:30', '2026-04-13 21:54:30'),
(156, 4, '56', 'available', NULL, 'qr_codes/156.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-2hN-VKvo-832e3d', '2026-04-13 21:54:31', '2026-04-13 21:54:31'),
(157, 4, '57', 'available', NULL, 'qr_codes/157.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-2q3-Z9ft-de82fe', '2026-04-13 21:54:31', '2026-04-13 21:54:31'),
(158, 4, '58', 'available', NULL, 'qr_codes/158.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-I3-jdug-bd2500', '2026-04-13 21:54:31', '2026-04-13 21:54:31'),
(159, 4, '59', 'available', NULL, 'qr_codes/159.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-1DQ-FWOQ-0cee4f', '2026-04-13 21:54:31', '2026-04-13 21:54:31'),
(160, 4, '60', 'available', NULL, 'qr_codes/160.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-2eW-UFUV-f623a3', '2026-04-13 21:54:31', '2026-04-13 21:54:31'),
(161, 4, '61', 'available', NULL, 'qr_codes/161.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-px-bgHR-a25ce5', '2026-04-13 21:54:31', '2026-04-13 21:54:31'),
(162, 4, '62', 'available', NULL, 'qr_codes/162.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-ZJ-qmao-9bac0a', '2026-04-13 21:54:31', '2026-04-13 21:54:31'),
(163, 4, '63', 'available', NULL, 'qr_codes/163.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-1NH-JEjl-a237f3', '2026-04-13 21:54:31', '2026-04-13 21:54:31'),
(164, 4, '64', 'available', NULL, 'qr_codes/164.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-Wp-ofoA-c1a0cc', '2026-04-13 21:54:31', '2026-04-13 21:54:31'),
(165, 4, '65', 'available', NULL, 'qr_codes/165.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-R3-m0ap-59fab1', '2026-04-13 21:54:31', '2026-04-13 21:54:31'),
(166, 4, '66', 'available', NULL, 'qr_codes/166.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-DC-hvO5-fbee93', '2026-04-13 21:54:31', '2026-04-13 21:54:31'),
(167, 4, '67', 'available', NULL, 'qr_codes/167.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-1Qo-KSem-9ae1cb', '2026-04-13 21:54:31', '2026-04-13 21:54:31'),
(168, 4, '68', 'available', NULL, 'qr_codes/168.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-12a-roIF-eab066', '2026-04-13 21:54:31', '2026-04-13 21:54:31'),
(169, 4, '69', 'available', NULL, 'qr_codes/169.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-2Ai-13Bce-1492d9', '2026-04-13 21:54:31', '2026-04-13 21:54:31'),
(170, 4, '70', 'available', NULL, 'qr_codes/170.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-2uw-11wuN-79cce1', '2026-04-13 21:54:31', '2026-04-13 21:54:31'),
(171, 4, '71', 'available', NULL, 'qr_codes/171.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-Li-k1x4-4fa151', '2026-04-13 21:54:31', '2026-04-13 21:54:31'),
(172, 4, '72', 'available', NULL, 'qr_codes/172.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-ga-7h5X-fd3391', '2026-04-13 21:54:31', '2026-04-13 21:54:31'),
(173, 4, '73', 'available', NULL, 'qr_codes/173.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-2dB-Uaub-4d8911', '2026-04-13 21:54:31', '2026-04-13 21:54:31'),
(174, 4, '74', 'available', NULL, 'qr_codes/174.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-2lW-YuCx-0c7e65', '2026-04-13 21:54:31', '2026-04-13 21:54:31'),
(175, 4, '75', 'available', NULL, 'qr_codes/175.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-1wp-Dlmj-eedad2', '2026-04-13 21:54:31', '2026-04-13 21:54:31'),
(176, 4, '76', 'available', NULL, 'qr_codes/176.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-lu-9mAz-0a88f8', '2026-04-13 21:54:31', '2026-04-13 21:54:31'),
(177, 4, '77', 'available', NULL, 'qr_codes/177.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-2pk-ZjkC-eb62d5', '2026-04-13 21:54:31', '2026-04-13 21:54:31'),
(178, 4, '78', 'available', NULL, 'qr_codes/178.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-jQ-93uL-a3ad36', '2026-04-13 21:54:31', '2026-04-13 21:54:31'),
(179, 4, '79', 'available', NULL, 'qr_codes/179.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-1cA-uOZY-6e3047', '2026-04-13 21:54:31', '2026-04-13 21:54:31'),
(180, 4, '80', 'available', NULL, 'qr_codes/180.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-Hh-ihw2-c07feb', '2026-04-13 21:54:31', '2026-04-13 21:54:31'),
(181, 4, '81', 'available', NULL, 'qr_codes/181.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-1l1-z6ez-69f6a8', '2026-04-13 21:54:31', '2026-04-13 21:54:31'),
(182, 4, '82', 'available', NULL, 'qr_codes/182.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-SU-ntNf-b082e7', '2026-04-13 21:54:31', '2026-04-13 21:54:31'),
(183, 4, '83', 'available', NULL, 'qr_codes/183.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-2hD-WJzJ-a71645', '2026-04-13 21:54:31', '2026-04-13 21:54:31'),
(184, 4, '84', 'available', NULL, 'qr_codes/184.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-Bp-g5r0-b3a0bd', '2026-04-13 21:54:31', '2026-04-13 21:54:31'),
(185, 4, '85', 'available', NULL, 'qr_codes/185.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-1gP-xsWj-9eafdd', '2026-04-13 21:54:31', '2026-04-13 21:54:31'),
(186, 4, '86', 'available', NULL, 'qr_codes/186.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-KB-kcNI-47438e', '2026-04-13 21:54:31', '2026-04-13 21:54:31'),
(187, 4, '87', 'available', NULL, 'qr_codes/187.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-wF-eOMP-956ae1', '2026-04-13 21:54:31', '2026-04-13 21:54:31'),
(188, 4, '88', 'available', NULL, 'qr_codes/188.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-1o4-A1Or-2016cf', '2026-04-13 21:54:31', '2026-04-13 21:54:31'),
(189, 4, '89', 'available', NULL, 'qr_codes/189.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-1Lw-Jg6e-cf1785', '2026-04-13 21:54:31', '2026-04-13 21:54:31'),
(190, 4, '90', 'available', NULL, 'qr_codes/190.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-Er-ha4o-fa4f73', '2026-04-13 21:54:31', '2026-04-13 21:54:31'),
(191, 4, '91', 'available', NULL, 'qr_codes/191.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-1yY-ExHk-b9fee7', '2026-04-13 21:54:31', '2026-04-13 21:54:31'),
(192, 4, '92', 'available', NULL, 'qr_codes/192.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-IG-jHpn-8b385e', '2026-04-13 21:54:31', '2026-04-13 21:54:31'),
(193, 4, '93', 'available', NULL, 'qr_codes/193.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-12y-rdto-0facc2', '2026-04-13 21:54:31', '2026-04-13 21:54:31'),
(194, 4, '94', 'available', NULL, 'qr_codes/194.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-11M-rnSz-c2323a', '2026-04-13 21:54:31', '2026-04-13 21:54:31'),
(195, 4, '95', 'available', NULL, 'qr_codes/195.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-1W7-NSFP-cbcea1', '2026-04-13 21:54:31', '2026-04-13 21:54:31'),
(196, 4, '96', 'available', NULL, 'qr_codes/196.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-gL-7Qq6-c42cd4', '2026-04-13 21:54:31', '2026-04-13 21:54:31'),
(197, 4, '97', 'available', NULL, 'qr_codes/197.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-1dh-vwhh-d31c3f', '2026-04-13 21:54:31', '2026-04-13 21:54:31'),
(198, 4, '98', 'available', NULL, 'qr_codes/198.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-1sh-ByMW-d5c951', '2026-04-13 21:54:31', '2026-04-13 21:54:31'),
(199, 4, '99', 'available', NULL, 'qr_codes/199.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-Fo-hOPq-729b34', '2026-04-13 21:54:31', '2026-04-13 21:54:31'),
(200, 4, '100', 'available', NULL, 'qr_codes/200.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-BB-g2XE-8a6289', '2026-04-13 21:54:31', '2026-04-13 21:54:31'),
(201, 5, '1', 'occupied', '2026-04-15 10:19:25', 'qr_codes/201.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-1TR-MpPt-44a812', '2026-04-13 21:55:48', '2026-04-15 10:19:25'),
(202, 5, '2', 'available', NULL, 'qr_codes/202.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-28h-SPnY-e80535', '2026-04-13 21:55:48', '2026-04-13 21:55:48'),
(203, 5, '3', 'available', NULL, 'qr_codes/203.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-1gG-xpzG-a4c6e9', '2026-04-13 21:55:48', '2026-04-13 21:55:48'),
(204, 5, '4', 'available', NULL, 'qr_codes/204.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-2nz-YKbK-7193ed', '2026-04-13 21:55:48', '2026-04-13 21:55:48'),
(205, 5, '5', 'available', NULL, 'qr_codes/205.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-KZ-jVrL-e523c2', '2026-04-13 21:55:48', '2026-04-13 21:55:48'),
(206, 5, '6', 'available', NULL, 'qr_codes/206.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-2tk-10NQX-580044', '2026-04-13 21:55:48', '2026-04-13 21:55:48'),
(207, 5, '7', 'available', NULL, 'qr_codes/207.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-F7-hJYn-493753', '2026-04-13 21:55:48', '2026-04-13 21:55:48'),
(208, 5, '8', 'available', NULL, 'qr_codes/208.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-223-PNqS-496dd2', '2026-04-13 21:55:48', '2026-04-13 21:55:48'),
(209, 5, '9', 'available', NULL, 'qr_codes/209.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-1dw-vtUm-78051e', '2026-04-13 21:55:48', '2026-04-13 21:55:48'),
(210, 5, '10', 'available', NULL, 'qr_codes/210.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-1i5-y26y-766ae9', '2026-04-13 21:55:48', '2026-04-13 21:55:48'),
(211, 5, '11', 'available', NULL, 'qr_codes/211.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-1Vx-O0Il-16910b', '2026-04-13 21:55:48', '2026-04-13 21:55:48'),
(212, 5, '12', 'available', NULL, 'qr_codes/212.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-E0-h3zd-478da1', '2026-04-13 21:55:48', '2026-04-13 21:55:48'),
(213, 5, '13', 'available', NULL, 'qr_codes/213.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-2jz-WRvH-fcbc75', '2026-04-13 21:55:48', '2026-04-13 21:55:48'),
(214, 5, '14', 'available', NULL, 'qr_codes/214.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-2n9-YQnu-f78758', '2026-04-13 21:55:48', '2026-04-13 21:55:48'),
(215, 5, '15', 'available', NULL, 'qr_codes/215.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-18P-tTP7-a61721', '2026-04-13 21:55:48', '2026-04-13 21:55:48'),
(216, 5, '16', 'available', NULL, 'qr_codes/216.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-1MC-JSul-64d08e', '2026-04-13 21:55:48', '2026-04-13 21:55:48'),
(217, 5, '17', 'available', NULL, 'qr_codes/217.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-1hd-xeUf-da1dc0', '2026-04-13 21:55:48', '2026-04-13 21:55:48'),
(218, 5, '18', 'available', NULL, 'qr_codes/218.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-1g1-wtRY-bcd7cb', '2026-04-13 21:55:48', '2026-04-13 21:55:48'),
(219, 5, '19', 'available', NULL, 'qr_codes/219.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-1gZ-xbub-353041', '2026-04-13 21:55:48', '2026-04-13 21:55:48'),
(220, 5, '20', 'available', NULL, 'qr_codes/220.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-2aa-U0vL-4a8741', '2026-04-13 21:55:48', '2026-04-13 21:55:48'),
(221, 5, '21', 'available', NULL, 'qr_codes/221.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-2wP-12B6n-376842', '2026-04-13 21:55:48', '2026-04-13 21:55:48'),
(222, 5, '22', 'available', NULL, 'qr_codes/222.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-1VQ-NFQT-e18b3f', '2026-04-13 21:55:48', '2026-04-13 21:55:48'),
(223, 5, '23', 'available', NULL, 'qr_codes/223.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-qE-cChk-2f2e89', '2026-04-13 21:55:48', '2026-04-13 21:55:48'),
(224, 5, '24', 'available', NULL, 'qr_codes/224.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-1px-Aiv0-78d540', '2026-04-13 21:55:48', '2026-04-13 21:55:48'),
(225, 5, '25', 'available', NULL, 'qr_codes/225.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-LI-kB9k-b24fd2', '2026-04-13 21:55:48', '2026-04-13 21:55:48'),
(226, 5, '26', 'available', NULL, 'qr_codes/226.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-27z-SX9s-573a8d', '2026-04-13 21:55:48', '2026-04-13 21:55:48'),
(227, 5, '27', 'available', NULL, 'qr_codes/227.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-MD-lb33-f20022', '2026-04-13 21:55:48', '2026-04-13 21:55:48'),
(228, 5, '28', 'available', NULL, 'qr_codes/228.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-jT-9FMM-8dcd29', '2026-04-13 21:55:48', '2026-04-13 21:55:48'),
(229, 5, '29', 'available', NULL, 'qr_codes/229.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-172-tr00-c50261', '2026-04-13 21:55:48', '2026-04-13 21:55:48'),
(230, 5, '30', 'available', NULL, 'qr_codes/230.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-xN-f388-fc3a45', '2026-04-13 21:55:48', '2026-04-13 21:55:48'),
(231, 5, '31', 'available', NULL, 'qr_codes/231.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-yd-eRZZ-3e1ee2', '2026-04-13 21:55:48', '2026-04-13 21:55:48'),
(232, 5, '32', 'available', NULL, 'qr_codes/232.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-2yn-1309Q-b398ad', '2026-04-13 21:55:48', '2026-04-13 21:55:48'),
(233, 5, '33', 'available', NULL, 'qr_codes/233.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-AU-fYas-f11bcf', '2026-04-13 21:55:48', '2026-04-13 21:55:48'),
(234, 5, '34', 'available', NULL, 'qr_codes/234.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-2pW-ZEFH-f2a8ed', '2026-04-13 21:55:48', '2026-04-13 21:55:48'),
(235, 5, '35', 'available', NULL, 'qr_codes/235.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-H6-j5Xs-81ef65', '2026-04-13 21:55:48', '2026-04-13 21:55:48'),
(236, 5, '36', 'available', NULL, 'qr_codes/236.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-1i3-xK9U-63f903', '2026-04-13 21:55:48', '2026-04-13 21:55:48'),
(237, 5, '37', 'available', NULL, 'qr_codes/237.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-2nE-ZAOO-2d7378', '2026-04-13 21:55:48', '2026-04-13 21:55:48'),
(238, 5, '38', 'available', NULL, 'qr_codes/238.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-Bm-gZzz-4babca', '2026-04-13 21:55:48', '2026-04-13 21:55:48'),
(239, 5, '39', 'available', NULL, 'qr_codes/239.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-2d4-V38A-5eae7d', '2026-04-13 21:55:48', '2026-04-13 21:55:48'),
(240, 5, '40', 'available', NULL, 'qr_codes/240.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-1Yx-OO5m-dcfb7d', '2026-04-13 21:55:48', '2026-04-13 21:55:48'),
(241, 5, '41', 'available', NULL, 'qr_codes/241.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-Py-mfyc-423bd4', '2026-04-13 21:55:48', '2026-04-13 21:55:48'),
(242, 5, '42', 'available', NULL, 'qr_codes/242.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-m4-aU5r-fe8417', '2026-04-13 21:55:48', '2026-04-13 21:55:48'),
(243, 5, '43', 'available', NULL, 'qr_codes/243.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-m2-aUdW-975b6c', '2026-04-13 21:55:48', '2026-04-13 21:55:48'),
(244, 5, '44', 'available', NULL, 'qr_codes/244.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-sC-cMK5-d0087d', '2026-04-13 21:55:48', '2026-04-13 21:55:48'),
(245, 5, '45', 'available', NULL, 'qr_codes/245.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-1mB-zhAR-fe2697', '2026-04-13 21:55:48', '2026-04-13 21:55:48'),
(246, 5, '46', 'available', NULL, 'qr_codes/246.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-KP-kGBS-842d50', '2026-04-13 21:55:48', '2026-04-13 21:55:48'),
(247, 5, '47', 'available', NULL, 'qr_codes/247.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-2m6-YV20-0dd8d4', '2026-04-13 21:55:48', '2026-04-13 21:55:48'),
(248, 5, '48', 'available', NULL, 'qr_codes/248.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-k6-9AZL-88baea', '2026-04-13 21:55:48', '2026-04-13 21:55:48'),
(249, 5, '49', 'available', NULL, 'qr_codes/249.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-Vr-pbtv-c37b5f', '2026-04-13 21:55:48', '2026-04-13 21:55:48'),
(250, 5, '50', 'available', NULL, 'qr_codes/250.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-2nx-ZymU-d06a3f', '2026-04-13 21:55:48', '2026-04-13 21:55:48'),
(251, 5, '51', 'available', NULL, 'qr_codes/251.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-29m-T1X8-7ddb16', '2026-04-13 21:55:48', '2026-04-13 21:55:48'),
(252, 5, '52', 'available', NULL, 'qr_codes/252.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-KH-kPYu-d3ee72', '2026-04-13 21:55:48', '2026-04-13 21:55:48'),
(253, 5, '53', 'available', NULL, 'qr_codes/253.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-2c8-U6ra-109922', '2026-04-13 21:55:48', '2026-04-13 21:55:48'),
(254, 5, '54', 'available', NULL, 'qr_codes/254.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-1u7-CEQI-aa0581', '2026-04-13 21:55:48', '2026-04-13 21:55:48'),
(255, 5, '55', 'available', NULL, 'qr_codes/255.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-2Az-141PX-a5a6d3', '2026-04-13 21:55:48', '2026-04-13 21:55:48'),
(256, 5, '56', 'available', NULL, 'qr_codes/256.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-1oS-Amop-bf5305', '2026-04-13 21:55:48', '2026-04-13 21:55:48'),
(257, 5, '57', 'available', NULL, 'qr_codes/257.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-Ih-jrz3-bf10c5', '2026-04-13 21:55:48', '2026-04-13 21:55:48'),
(258, 5, '58', 'available', NULL, 'qr_codes/258.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-ED-hBsI-ac32ce', '2026-04-13 21:55:48', '2026-04-13 21:55:48'),
(259, 5, '59', 'available', NULL, 'qr_codes/259.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-264-Sfay-125053', '2026-04-13 21:55:48', '2026-04-13 21:55:48'),
(260, 5, '60', 'available', NULL, 'qr_codes/260.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-1A0-EMuP-481dac', '2026-04-13 21:55:48', '2026-04-13 21:55:48'),
(261, 5, '61', 'available', NULL, 'qr_codes/261.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-1Uk-N4Bm-19b73e', '2026-04-13 21:55:48', '2026-04-13 21:55:48'),
(262, 5, '62', 'available', NULL, 'qr_codes/262.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-2bD-Ufhc-24f4aa', '2026-04-13 21:55:48', '2026-04-13 21:55:48'),
(263, 5, '63', 'available', NULL, 'qr_codes/263.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-1ro-BDxy-152e12', '2026-04-13 21:55:48', '2026-04-13 21:55:48'),
(264, 5, '64', 'available', NULL, 'qr_codes/264.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-1VO-Ow8z-51c0b1', '2026-04-13 21:55:48', '2026-04-13 21:55:48'),
(265, 5, '65', 'available', NULL, 'qr_codes/265.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-1Gq-HEBI-e41720', '2026-04-13 21:55:48', '2026-04-13 21:55:48'),
(266, 5, '66', 'available', NULL, 'qr_codes/266.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-1BP-GczQ-7793d4', '2026-04-13 21:55:48', '2026-04-13 21:55:48'),
(267, 5, '67', 'available', NULL, 'qr_codes/267.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-1VN-OvmB-f7698d', '2026-04-13 21:55:48', '2026-04-13 21:55:48'),
(268, 5, '68', 'available', NULL, 'qr_codes/268.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-Kw-kF8j-514841', '2026-04-13 21:55:48', '2026-04-13 21:55:48'),
(269, 5, '69', 'available', NULL, 'qr_codes/269.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-1Vl-NHV9-ece120', '2026-04-13 21:55:48', '2026-04-13 21:55:48'),
(270, 5, '70', 'available', NULL, 'qr_codes/270.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-2ne-Zyep-dc6d84', '2026-04-13 21:55:48', '2026-04-13 21:55:48'),
(271, 5, '71', 'available', NULL, 'qr_codes/271.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-1d2-weY2-1ed6ef', '2026-04-13 21:55:48', '2026-04-13 21:55:48'),
(272, 5, '72', 'available', NULL, 'qr_codes/272.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-1eX-wH0u-a7cb2f', '2026-04-13 21:55:48', '2026-04-13 21:55:48'),
(273, 5, '73', 'available', NULL, 'qr_codes/273.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-1Yo-PClm-dbdcfd', '2026-04-13 21:55:48', '2026-04-13 21:55:48'),
(274, 5, '74', 'available', NULL, 'qr_codes/274.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-M2-lfM7-9c1966', '2026-04-13 21:55:48', '2026-04-13 21:55:48'),
(275, 5, '75', 'available', NULL, 'qr_codes/275.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-2kG-Ylzm-c0716a', '2026-04-13 21:55:48', '2026-04-13 21:55:48'),
(276, 5, '76', 'available', NULL, 'qr_codes/276.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-1ZW-Qd9t-005d3d', '2026-04-13 21:55:48', '2026-04-13 21:55:48'),
(277, 5, '77', 'available', NULL, 'qr_codes/277.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-AG-h15s-cd220c', '2026-04-13 21:55:48', '2026-04-13 21:55:48'),
(278, 5, '78', 'available', NULL, 'qr_codes/278.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-1g6-x9zx-d0dbb7', '2026-04-13 21:55:48', '2026-04-13 21:55:48'),
(279, 5, '79', 'available', NULL, 'qr_codes/279.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-1vi-DfNk-65db79', '2026-04-13 21:55:48', '2026-04-13 21:55:48'),
(280, 5, '80', 'available', NULL, 'qr_codes/280.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-2rG-10QVJ-45e755', '2026-04-13 21:55:48', '2026-04-13 21:55:48'),
(281, 5, '81', 'available', NULL, 'qr_codes/281.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-Tl-nKSz-6ac7fa', '2026-04-13 21:55:48', '2026-04-13 21:55:48'),
(282, 5, '82', 'available', NULL, 'qr_codes/282.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-2dx-VGvK-f99c8f', '2026-04-13 21:55:48', '2026-04-13 21:55:48'),
(283, 5, '83', 'available', NULL, 'qr_codes/283.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-Sx-nVZl-2bc7db', '2026-04-13 21:55:48', '2026-04-13 21:55:48'),
(284, 5, '84', 'available', NULL, 'qr_codes/284.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-1WD-O3ge-6cda9a', '2026-04-13 21:55:48', '2026-04-13 21:55:48'),
(285, 5, '85', 'available', NULL, 'qr_codes/285.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-2mg-YKbK-aa7997', '2026-04-13 21:55:48', '2026-04-13 21:55:48'),
(286, 5, '86', 'available', NULL, 'qr_codes/286.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-Ai-gYjB-18167b', '2026-04-13 21:55:48', '2026-04-13 21:55:48'),
(287, 5, '87', 'available', NULL, 'qr_codes/287.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-1MS-Kphe-58d469', '2026-04-13 21:55:48', '2026-04-13 21:55:48'),
(288, 5, '88', 'available', NULL, 'qr_codes/288.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-2hQ-XcGd-5f9738', '2026-04-13 21:55:48', '2026-04-13 21:55:48');
INSERT INTO `dining_tables` (`id`, `cabang_id`, `table_number`, `status`, `occupied_at`, `image`, `qr_value`, `created_at`, `updated_at`) VALUES
(289, 5, '89', 'available', NULL, 'qr_codes/289.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-Q9-mNsd-1dd972', '2026-04-13 21:55:48', '2026-04-13 21:55:48'),
(290, 5, '90', 'available', NULL, 'qr_codes/290.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-1Ie-IPsv-099a6e', '2026-04-13 21:55:48', '2026-04-13 21:55:48'),
(291, 5, '91', 'available', NULL, 'qr_codes/291.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-wK-fd2g-50afc6', '2026-04-13 21:55:48', '2026-04-13 21:55:48'),
(292, 5, '92', 'available', NULL, 'qr_codes/292.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-1cM-wcGr-215a54', '2026-04-13 21:55:48', '2026-04-13 21:55:48'),
(293, 5, '93', 'available', NULL, 'qr_codes/293.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-1iB-yfp7-7f6e52', '2026-04-13 21:55:48', '2026-04-13 21:55:48'),
(294, 5, '94', 'available', NULL, 'qr_codes/294.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-2lk-YVaL-37d132', '2026-04-13 21:55:48', '2026-04-13 21:55:48'),
(295, 5, '95', 'available', NULL, 'qr_codes/295.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-1uE-DpKu-81daac', '2026-04-13 21:55:48', '2026-04-13 21:55:48'),
(296, 5, '96', 'available', NULL, 'qr_codes/296.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-1oN-BmZu-c441f5', '2026-04-13 21:55:48', '2026-04-13 21:55:48'),
(297, 5, '97', 'available', NULL, 'qr_codes/297.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-1TW-NXsQ-b5bb17', '2026-04-13 21:55:48', '2026-04-13 21:55:48'),
(298, 5, '98', 'available', NULL, 'qr_codes/298.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-2oB-ZMlg-d1c717', '2026-04-13 21:55:48', '2026-04-13 21:55:48'),
(299, 5, '99', 'available', NULL, 'qr_codes/299.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-2x7-12VNZ-f20ed2', '2026-04-13 21:55:48', '2026-04-13 21:55:48'),
(300, 5, '100', 'available', NULL, 'qr_codes/300.svg', 'https://papayawhip-jaguar-980240.hostingersite.com/t/v1-1NO-KUBh-8e67ea', '2026-04-13 21:55:48', '2026-04-13 21:55:48');

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
-- Struktur dari tabel `ingredients`
--

CREATE TABLE `ingredients` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sku` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pcs',
  `cost_price` decimal(12,2) NOT NULL DEFAULT '0.00',
  `reorder_level` decimal(12,3) NOT NULL DEFAULT '0.000',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `ingredient_unit_conversions`
--

CREATE TABLE `ingredient_unit_conversions` (
  `id` bigint UNSIGNED NOT NULL,
  `ingredient_id` bigint UNSIGNED NOT NULL,
  `unit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `factor_to_base` decimal(12,6) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `inventory_movements`
--

CREATE TABLE `inventory_movements` (
  `id` bigint UNSIGNED NOT NULL,
  `ingredient_id` bigint UNSIGNED NOT NULL,
  `supplier_id` bigint UNSIGNED DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` decimal(12,3) NOT NULL,
  `input_quantity` decimal(12,3) DEFAULT NULL,
  `input_unit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unit_cost` decimal(12,2) DEFAULT NULL,
  `input_unit_cost` decimal(12,2) DEFAULT NULL,
  `reference_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reference_id` bigint UNSIGNED DEFAULT NULL,
  `note` text COLLATE utf8mb4_unicode_ci,
  `happened_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Struktur dari tabel `members`
--

CREATE TABLE `members` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `verification_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `member_region_id` bigint UNSIGNED DEFAULT NULL,
  `member_type` enum('umum','regular','premium') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'umum',
  `points` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `member_regions`
--

CREATE TABLE `member_regions` (
  `id` bigint UNSIGNED NOT NULL,
  `province` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `regency` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `district` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `geojson` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, '2026_04_02_174333_create_cabangs_table', 1),
(2, '0001_01_01_000000_create_users_table', 2),
(3, '0001_01_01_000001_create_cache_table', 2),
(4, '0001_01_01_000002_create_jobs_table', 2),
(5, '2025_11_30_090717_create_categories_table', 2),
(6, '2025_11_30_091010_create_printer_sources_table', 2),
(7, '2025_11_30_091015_create_products_table', 2),
(8, '2025_11_30_091020_create_product_variants_table', 2),
(9, '2025_11_30_095051_create_dining_tables_table', 2),
(10, '2025_12_02_033100_create_member_regions_table', 2),
(11, '2025_12_02_033105_create_members_table', 2),
(12, '2025_12_02_033116_create_transactions_table', 2),
(13, '2025_12_02_033414_create_transaction_items_table', 2),
(14, '2025_12_02_033632_create_settings_table', 2),
(15, '2026_02_10_235304_create_personal_access_tokens_table', 2),
(16, '2026_02_16_180948_create_monthly_revenue_targets_table', 2),
(17, '2026_02_17_000010_create_suppliers_table', 2),
(18, '2026_02_17_000020_create_ingredients_table', 2),
(19, '2026_02_17_000030_create_inventory_movements_table', 2),
(20, '2026_02_17_000040_create_stock_opnames_table', 2),
(21, '2026_02_17_000050_create_stock_opname_items_table', 2),
(22, '2026_02_17_000060_create_product_recipes_table', 2),
(23, '2026_02_17_000080_create_ingredient_unit_conversions_table', 2),
(24, '2026_02_17_000100_create_purchases_table', 2),
(25, '2026_02_17_000110_create_purchase_items_table', 2),
(26, '2026_02_17_000120_create_product_variant_recipes_table', 2),
(27, '2026_02_19_000003_create_transaction_events_table', 2),
(28, '2026_02_21_200130_create_permission_tables', 2),
(29, '2026_02_22_000001_add_verification_fields_to_members_table', 2),
(30, '2026_02_22_154044_add_constraints_and_intent_hash_to_transactions_table', 2),
(31, '2026_02_22_155328_add_payment_fee_amount_to_transactions_table', 2),
(32, '2026_02_23_000001_create_voucher_campaigns_table', 2),
(33, '2026_02_23_000002_create_voucher_codes_table', 2),
(34, '2026_02_23_000003_create_voucher_redemptions_table', 2),
(35, '2026_02_23_000004_create_voucher_campaign_category_table', 2),
(36, '2026_02_23_000005_create_manual_discount_reasons_table', 2),
(37, '2026_02_23_000006_add_discounts_to_transactions_table', 2),
(38, '2026_02_23_000007_add_discounts_to_transaction_items_table', 2),
(39, '2026_02_23_000008_add_voucher_and_manual_discount_settings_to_settings_table', 2),
(40, '2026_02_23_000009_add_member_type_to_members_table', 2),
(41, '2026_02_23_224300_create_manual_discount_role_limits_table', 2),
(42, '2026_02_25_023625_drop_manual_discount_tables_and_columns', 2),
(43, '2026_02_25_153815_add_point_system_columns_to_settings_table', 2),
(44, '2026_02_25_154219_add_point_columns_to_transactions_table', 2),
(45, '2026_02_25_155128_update_voucher_campaigns_replace_member_type_with_is_member_only', 2),
(46, '2026_02_26_013701_add_is_package_to_products_table', 2),
(47, '2026_02_26_013715_create_product_package_items_table', 2),
(48, '2026_02_26_013725_add_parent_transaction_item_id_to_transaction_items_table', 2),
(49, '2026_03_01_000001_create_operating_expenses_table', 2),
(50, '2026_03_02_025051_add_package_type_to_products_table', 2),
(51, '2026_03_02_025102_create_product_complex_package_items_table', 2),
(52, '2026_03_02_044326_add_is_splitable_to_product_complex_package_items_table', 2),
(53, '2026_03_05_000001_add_receipt_emailed_at_to_transactions_table', 2),
(54, '2026_03_07_000001_add_cashier_receipt_logo_toggle_to_settings_table', 2),
(55, '2026_04_04_210542_add_branch_id_to_users_table', 2),
(56, '2026_04_05_100448_add_status_and_occupied_at_to_dining_tables', 2),
(57, '2026_04_05_140705_change_order_type_in_transactions_table', 2),
(58, '2026_04_06_095350_add_address_and_is_active_to_cabangs_table', 2),
(59, '2026_04_06_181937_make_image_nullable_in_products_table', 2),
(60, '2026_04_08_201105_add_service_percentage_and_service_amount_to_transactions_table', 2),
(61, '2026_04_08_201229_add_service_rate_to_settings_table', 2),
(62, '2026_04_10_171522_create_activity_log_table', 2),
(63, '2026_04_10_171523_add_event_column_to_activity_log_table', 2),
(64, '2026_04_10_171524_add_batch_uuid_column_to_activity_log_table', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 2),
(4, 'App\\Models\\User', 3),
(4, 'App\\Models\\User', 4),
(3, 'App\\Models\\User', 5),
(3, 'App\\Models\\User', 6);

-- --------------------------------------------------------

--
-- Struktur dari tabel `monthly_revenue_targets`
--

CREATE TABLE `monthly_revenue_targets` (
  `id` bigint UNSIGNED NOT NULL,
  `cabang_id` bigint UNSIGNED NOT NULL,
  `year` smallint UNSIGNED NOT NULL,
  `month` tinyint UNSIGNED NOT NULL,
  `amount` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `operating_expenses`
--

CREATE TABLE `operating_expenses` (
  `id` bigint UNSIGNED NOT NULL,
  `cabang_id` bigint UNSIGNED NOT NULL,
  `expense_date` date NOT NULL,
  `category` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` int NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci,
  `created_by_user_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Struktur dari tabel `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'dashboard.access', 'web', '2026-04-12 16:23:21', '2026-04-12 16:23:21'),
(2, 'pos.access', 'web', '2026-04-12 16:23:21', '2026-04-12 16:23:21'),
(3, 'guides.view', 'web', '2026-04-12 16:23:21', '2026-04-12 16:23:21'),
(4, 'products.view', 'web', '2026-04-12 16:23:21', '2026-04-12 16:23:21'),
(5, 'products.create', 'web', '2026-04-12 16:23:21', '2026-04-12 16:23:21'),
(6, 'products.edit', 'web', '2026-04-12 16:23:21', '2026-04-12 16:23:21'),
(7, 'products.delete', 'web', '2026-04-12 16:23:21', '2026-04-12 16:23:21'),
(8, 'categories.view', 'web', '2026-04-12 16:23:21', '2026-04-12 16:23:21'),
(9, 'categories.create', 'web', '2026-04-12 16:23:21', '2026-04-12 16:23:21'),
(10, 'categories.edit', 'web', '2026-04-12 16:23:22', '2026-04-12 16:23:22'),
(11, 'categories.delete', 'web', '2026-04-12 16:23:22', '2026-04-12 16:23:22'),
(12, 'transactions.view', 'web', '2026-04-12 16:23:22', '2026-04-12 16:23:22'),
(13, 'transactions.details', 'web', '2026-04-12 16:23:22', '2026-04-12 16:23:22'),
(14, 'transactions.pii.view', 'web', '2026-04-12 16:23:22', '2026-04-12 16:23:22'),
(15, 'transactions.print', 'web', '2026-04-12 16:23:22', '2026-04-12 16:23:22'),
(16, 'transactions.void', 'web', '2026-04-12 16:23:22', '2026-04-12 16:23:22'),
(17, 'transactions.refund', 'web', '2026-04-12 16:23:22', '2026-04-12 16:23:22'),
(18, 'transactions.void.approve', 'web', '2026-04-12 16:23:22', '2026-04-12 16:23:22'),
(19, 'transactions.refund.approve', 'web', '2026-04-12 16:23:22', '2026-04-12 16:23:22'),
(20, 'members.view', 'web', '2026-04-12 16:23:22', '2026-04-12 16:23:22'),
(21, 'members.create', 'web', '2026-04-12 16:23:22', '2026-04-12 16:23:22'),
(22, 'members.edit', 'web', '2026-04-12 16:23:22', '2026-04-12 16:23:22'),
(23, 'members.delete', 'web', '2026-04-12 16:23:22', '2026-04-12 16:23:22'),
(24, 'members.pii.view', 'web', '2026-04-12 16:23:22', '2026-04-12 16:23:22'),
(25, 'members.regions.view', 'web', '2026-04-12 16:23:22', '2026-04-12 16:23:22'),
(26, 'members.regions.manage', 'web', '2026-04-12 16:23:22', '2026-04-12 16:23:22'),
(27, 'reports.view', 'web', '2026-04-12 16:23:22', '2026-04-12 16:23:22'),
(28, 'reports.sales', 'web', '2026-04-12 16:23:22', '2026-04-12 16:23:22'),
(29, 'reports.performance', 'web', '2026-04-12 16:23:22', '2026-04-12 16:23:22'),
(30, 'reports.expenses.manage', 'web', '2026-04-12 16:23:22', '2026-04-12 16:23:22'),
(31, 'vouchers.view', 'web', '2026-04-12 16:23:22', '2026-04-12 16:23:22'),
(32, 'vouchers.manage', 'web', '2026-04-12 16:23:22', '2026-04-12 16:23:22'),
(33, 'discounts.manual.apply', 'web', '2026-04-12 16:23:22', '2026-04-12 16:23:22'),
(34, 'inventory.view', 'web', '2026-04-12 16:23:22', '2026-04-12 16:23:22'),
(35, 'inventory.manage', 'web', '2026-04-12 16:23:22', '2026-04-12 16:23:22'),
(36, 'inventory.ingredients.view', 'web', '2026-04-12 16:23:22', '2026-04-12 16:23:22'),
(37, 'inventory.ingredients.manage', 'web', '2026-04-12 16:23:22', '2026-04-12 16:23:22'),
(38, 'inventory.suppliers.view', 'web', '2026-04-12 16:23:22', '2026-04-12 16:23:22'),
(39, 'inventory.suppliers.manage', 'web', '2026-04-12 16:23:22', '2026-04-12 16:23:22'),
(40, 'inventory.movements.view', 'web', '2026-04-12 16:23:22', '2026-04-12 16:23:22'),
(41, 'inventory.movements.manage', 'web', '2026-04-12 16:23:22', '2026-04-12 16:23:22'),
(42, 'inventory.movements.create', 'web', '2026-04-12 16:23:22', '2026-04-12 16:23:22'),
(43, 'inventory.movements.delete', 'web', '2026-04-12 16:23:22', '2026-04-12 16:23:22'),
(44, 'inventory.purchases.view', 'web', '2026-04-12 16:23:22', '2026-04-12 16:23:22'),
(45, 'inventory.purchases.manage', 'web', '2026-04-12 16:23:22', '2026-04-12 16:23:22'),
(46, 'inventory.purchases.create', 'web', '2026-04-12 16:23:22', '2026-04-12 16:23:22'),
(47, 'inventory.purchases.edit', 'web', '2026-04-12 16:23:22', '2026-04-12 16:23:22'),
(48, 'inventory.purchases.receive', 'web', '2026-04-12 16:23:22', '2026-04-12 16:23:22'),
(49, 'inventory.purchases.cancel', 'web', '2026-04-12 16:23:22', '2026-04-12 16:23:22'),
(50, 'inventory.opnames.view', 'web', '2026-04-12 16:23:22', '2026-04-12 16:23:22'),
(51, 'inventory.opnames.manage', 'web', '2026-04-12 16:23:22', '2026-04-12 16:23:22'),
(52, 'inventory.opnames.create', 'web', '2026-04-12 16:23:22', '2026-04-12 16:23:22'),
(53, 'inventory.opnames.edit', 'web', '2026-04-12 16:23:22', '2026-04-12 16:23:22'),
(54, 'inventory.opnames.refresh_system_stocks', 'web', '2026-04-12 16:23:22', '2026-04-12 16:23:22'),
(55, 'inventory.opnames.post', 'web', '2026-04-12 16:23:22', '2026-04-12 16:23:22'),
(56, 'inventory.opnames.cancel', 'web', '2026-04-12 16:23:22', '2026-04-12 16:23:22'),
(57, 'inventory.reports.view', 'web', '2026-04-12 16:23:22', '2026-04-12 16:23:22'),
(58, 'users.view', 'web', '2026-04-12 16:23:22', '2026-04-12 16:23:22'),
(59, 'users.create', 'web', '2026-04-12 16:23:22', '2026-04-12 16:23:22'),
(60, 'users.edit', 'web', '2026-04-12 16:23:22', '2026-04-12 16:23:22'),
(61, 'users.delete', 'web', '2026-04-12 16:23:22', '2026-04-12 16:23:22'),
(62, 'cabang.view', 'web', '2026-04-12 16:23:22', '2026-04-12 16:23:22'),
(63, 'cabang.create', 'web', '2026-04-12 16:23:22', '2026-04-12 16:23:22'),
(64, 'cabang.edit', 'web', '2026-04-12 16:23:22', '2026-04-12 16:23:22'),
(65, 'cabang.delete', 'web', '2026-04-12 16:23:22', '2026-04-12 16:23:22'),
(66, 'roles.view', 'web', '2026-04-12 16:23:22', '2026-04-12 16:23:22'),
(67, 'roles.manage', 'web', '2026-04-12 16:23:22', '2026-04-12 16:23:22'),
(68, 'dining_tables.view', 'web', '2026-04-12 16:23:23', '2026-04-12 16:23:23'),
(69, 'dining_tables.edit', 'web', '2026-04-12 16:23:23', '2026-04-12 16:23:23'),
(70, 'settings.view', 'web', '2026-04-12 16:23:23', '2026-04-12 16:23:23'),
(71, 'settings.edit', 'web', '2026-04-12 16:23:23', '2026-04-12 16:23:23'),
(72, 'settings.store.view', 'web', '2026-04-12 16:23:23', '2026-04-12 16:23:23'),
(73, 'settings.store.edit', 'web', '2026-04-12 16:23:23', '2026-04-12 16:23:23'),
(74, 'settings.printers.view', 'web', '2026-04-12 16:23:23', '2026-04-12 16:23:23'),
(75, 'settings.printers.edit', 'web', '2026-04-12 16:23:23', '2026-04-12 16:23:23'),
(76, 'settings.system.view', 'web', '2026-04-12 16:23:23', '2026-04-12 16:23:23'),
(77, 'settings.system.edit', 'web', '2026-04-12 16:23:23', '2026-04-12 16:23:23'),
(78, 'settings.points.view', 'web', '2026-04-12 16:23:23', '2026-04-12 16:23:23'),
(79, 'settings.points.edit', 'web', '2026-04-12 16:23:23', '2026-04-12 16:23:23'),
(80, 'settings.targets.view', 'web', '2026-04-12 16:23:23', '2026-04-12 16:23:23'),
(81, 'settings.targets.edit', 'web', '2026-04-12 16:23:23', '2026-04-12 16:23:23');

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `printer_sources`
--

CREATE TABLE `printer_sources` (
  `id` bigint UNSIGNED NOT NULL,
  `cabang_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `printer_sources`
--

INSERT INTO `printer_sources` (`id`, `cabang_id`, `name`, `type`, `created_at`, `updated_at`) VALUES
(1, 2, 'ass', 'kasir', '2026-04-14 23:17:45', '2026-04-14 23:17:45');

-- --------------------------------------------------------

--
-- Struktur dari tabel `products`
--

CREATE TABLE `products` (
  `id` bigint UNSIGNED NOT NULL,
  `cabang_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_available` tinyint(1) NOT NULL DEFAULT '1',
  `is_promo` tinyint(1) NOT NULL DEFAULT '0',
  `is_favorite` tinyint(1) NOT NULL DEFAULT '0',
  `is_package` tinyint(1) NOT NULL DEFAULT '0',
  `package_type` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` bigint UNSIGNED NOT NULL,
  `printer_source_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `products`
--

INSERT INTO `products` (`id`, `cabang_id`, `name`, `description`, `image`, `is_available`, `is_promo`, `is_favorite`, `is_package`, `package_type`, `category_id`, `printer_source_id`, `created_at`, `updated_at`) VALUES
(1, 2, 'Air Putih', 'air putih biasa', '', 1, 0, 0, 0, NULL, 1, NULL, '2026-04-13 20:58:31', '2026-04-13 20:58:31'),
(2, 2, 'Air Putih Es', 'air putih biasa pake es', '', 1, 0, 0, 0, NULL, 1, NULL, '2026-04-13 20:59:26', '2026-04-13 20:59:26'),
(3, 2, 'Ayam BKR KPG', 'Ayam bakar kampung madu', '', 1, 0, 0, 0, NULL, 2, NULL, '2026-04-13 21:00:23', '2026-04-13 21:00:23'),
(4, 2, 'Ayam GR KPG', 'ayam goreng kampung', '', 1, 0, 0, 0, NULL, 2, NULL, '2026-04-13 21:01:31', '2026-04-13 21:01:31'),
(5, 2, 'Ayam Kremes', 'Ayam Kremes', '', 1, 0, 0, 0, NULL, 2, NULL, '2026-04-13 21:02:11', '2026-04-13 21:02:11'),
(6, 2, 'Bakwan Jagung', 'bakwan jagung', '', 1, 0, 0, 0, NULL, 2, NULL, '2026-04-13 21:02:55', '2026-04-13 21:02:55'),
(7, 2, 'Bebek Kremes', 'bebek goreng kremes', '', 1, 0, 0, 0, NULL, 2, NULL, '2026-04-13 21:03:20', '2026-04-13 21:03:20'),
(8, 2, 'Bebek Bakar', 'bebek bakar madu', '', 1, 0, 0, 0, NULL, 2, NULL, '2026-04-13 21:03:42', '2026-04-13 21:03:42'),
(9, 2, 'Bunga Paya', 'bunga paya tumis', '', 1, 0, 0, 0, NULL, 3, NULL, '2026-04-13 21:04:20', '2026-04-13 21:04:20'),
(10, 2, 'Empal Serundeng', 'empal bumbu serungdeng', '', 1, 0, 0, 0, NULL, 2, NULL, '2026-04-13 21:04:50', '2026-04-13 21:04:50'),
(11, 2, 'Es Alpukat Kocok', 'alpukat kocok', '', 1, 0, 0, 0, NULL, 1, NULL, '2026-04-13 21:05:30', '2026-04-13 21:05:30'),
(12, 2, 'Es Batu', 'es batu', '', 1, 0, 0, 0, NULL, 1, NULL, '2026-04-13 21:05:54', '2026-04-13 21:05:54'),
(13, 2, 'Es Campur', 'es campur', '', 1, 0, 0, 0, NULL, 1, NULL, '2026-04-13 21:06:14', '2026-04-13 21:06:14'),
(14, 2, 'Es Cincau', 'es cincau', '', 1, 0, 0, 0, NULL, 1, NULL, '2026-04-13 21:06:40', '2026-04-13 21:06:40'),
(15, 2, 'Es Cokelat', 'es cokelat', '', 1, 0, 0, 0, NULL, 1, NULL, '2026-04-13 21:07:01', '2026-04-13 21:07:01'),
(16, 2, 'Es Jeruk', 'es jeruk', '', 1, 0, 0, 0, NULL, 1, NULL, '2026-04-13 21:07:33', '2026-04-13 21:07:33'),
(17, 2, 'Es Jeruk Alpukat', 'es jeruk alpukat', '', 1, 0, 0, 0, NULL, 1, NULL, '2026-04-13 21:07:57', '2026-04-13 21:07:57'),
(18, 2, 'Es Jeruk Nipis', 'es jeurk nipis', '', 1, 0, 0, 0, NULL, 1, NULL, '2026-04-13 21:08:27', '2026-04-13 21:08:27'),
(19, 2, 'Es Kelapa', 'es kelapa', '', 1, 0, 0, 0, NULL, 1, NULL, '2026-04-13 21:08:53', '2026-04-13 21:08:53'),
(20, 2, 'Es Kelapa Alpukat', 'es kelapa alpukatg', '', 1, 0, 0, 0, NULL, 1, NULL, '2026-04-13 21:09:17', '2026-04-13 21:09:17'),
(21, 2, 'Es Kelapa Aren', 'es kelapa aren', '', 1, 0, 0, 0, NULL, 1, NULL, '2026-04-13 21:09:44', '2026-04-13 21:09:44'),
(22, 2, 'Es Kelapa Jeruk', 'es kelapa jeruk', '', 1, 0, 0, 0, NULL, 1, NULL, '2026-04-13 21:10:36', '2026-04-13 21:10:36'),
(23, 2, 'Es Kopi Aby', 'es kopi aby', '', 1, 0, 0, 0, NULL, 1, NULL, '2026-04-13 21:11:10', '2026-04-13 21:11:10'),
(24, 2, 'Es Kopi Dalgona', 'es kopi dalgona', '', 1, 0, 0, 0, NULL, 1, NULL, '2026-04-13 21:11:40', '2026-04-13 21:11:40'),
(25, 2, 'Es Leci Tea', 'es leci tea', '', 1, 0, 0, 0, NULL, 1, NULL, '2026-04-13 21:12:33', '2026-04-13 21:12:33'),
(26, 2, 'Es Leci Yakult', 'es leci yakult', '', 1, 0, 0, 0, NULL, 1, NULL, '2026-04-13 21:13:03', '2026-04-13 21:13:03'),
(27, 2, 'Es Lemon Tea', 'es lemon tea', '', 1, 0, 0, 0, NULL, 1, NULL, '2026-04-13 21:13:25', '2026-04-13 21:13:25'),
(28, 2, 'Es Teh Manis', 'es teh manis', '', 1, 0, 0, 0, NULL, 1, NULL, '2026-04-13 21:13:50', '2026-04-13 21:13:50'),
(29, 2, 'Es Teh Tawar', 'es teh tawar', '', 1, 0, 0, 0, NULL, 1, NULL, '2026-04-13 21:14:14', '2026-04-13 21:14:14'),
(30, 2, 'Es Teler', 'es teler', '', 1, 0, 0, 0, NULL, 1, NULL, '2026-04-13 21:14:31', '2026-04-13 21:14:31'),
(31, 2, 'Goreng Rumput', 'jukut goreng', '', 1, 0, 0, 0, NULL, 2, NULL, '2026-04-13 21:14:54', '2026-04-13 21:14:54'),
(32, 2, 'Gurame Goreng', 'gurame goreng', '', 1, 0, 0, 0, NULL, 1, NULL, '2026-04-13 21:15:19', '2026-04-13 21:15:19'),
(33, 2, 'Gurame Bakar', 'gurame bakar', '', 1, 0, 0, 0, NULL, 2, NULL, '2026-04-13 21:15:50', '2026-04-13 21:15:50'),
(34, 2, 'Gurame Pecak', 'gurame pecal', '', 1, 0, 0, 0, NULL, 2, NULL, '2026-04-13 21:16:20', '2026-04-13 21:16:20'),
(35, 2, 'Gurita Bakar', 'gurita', '', 1, 0, 0, 0, NULL, 2, NULL, '2026-04-13 21:17:18', '2026-04-13 21:17:18'),
(36, 2, 'Ikan Asin Gabus', 'ikan asin', '', 1, 0, 0, 0, NULL, 2, NULL, '2026-04-13 21:17:37', '2026-04-13 21:17:37'),
(37, 2, 'Ikan Baby', 'ikan baby', '', 1, 0, 0, 0, NULL, 2, NULL, '2026-04-13 21:18:04', '2026-04-13 21:18:04'),
(38, 2, 'Ikan Jambal', 'ikan jambal', '', 1, 0, 0, 0, NULL, 2, NULL, '2026-04-13 21:18:39', '2026-04-13 21:18:39'),
(39, 2, 'Ikan Lele', 'lele', '', 1, 0, 0, 0, NULL, 2, NULL, '2026-04-13 21:18:54', '2026-04-13 21:18:54'),
(40, 2, 'Ikan Mas Gr', 'ikan mas gr', '', 1, 0, 0, 0, NULL, 2, NULL, '2026-04-13 21:19:14', '2026-04-13 21:19:14'),
(41, 2, 'Ikan Peda', 'peda', '', 1, 0, 0, 0, NULL, 2, NULL, '2026-04-13 21:19:28', '2026-04-13 21:19:28'),
(42, 2, 'Jengkol', 'jengkol', '', 1, 0, 0, 0, NULL, 2, NULL, '2026-04-13 21:19:45', '2026-04-13 21:19:45'),
(43, 2, 'Jengkol Balado', 'jengkol', '', 1, 0, 0, 0, NULL, 3, NULL, '2026-04-13 21:20:02', '2026-04-13 21:20:02'),
(44, 2, 'Jeruk Hangat', 'jeruk', '', 1, 0, 0, 0, NULL, 1, NULL, '2026-04-13 21:20:20', '2026-04-13 21:20:20'),
(45, 2, 'Jeruk Nipis Hangat', 'jeruk', '', 1, 0, 0, 0, NULL, 1, NULL, '2026-04-13 21:20:41', '2026-04-13 21:20:41'),
(46, 2, 'Jus Alpukat', 'jus alpkuat', '', 1, 0, 0, 0, NULL, 1, NULL, '2026-04-13 21:21:00', '2026-04-13 21:21:00'),
(47, 2, 'Jus Jambu', 'jus jambu', '', 1, 0, 0, 0, NULL, 1, NULL, '2026-04-13 21:21:17', '2026-04-13 21:21:17'),
(48, 2, 'Jus Jeruk', 'jus jeruk', '', 1, 0, 0, 0, NULL, 1, NULL, '2026-04-13 21:21:36', '2026-04-13 21:21:36'),
(49, 2, 'Jus Mangga', 'jus mangga', '', 1, 0, 0, 0, NULL, 1, NULL, '2026-04-13 21:21:56', '2026-04-13 21:21:56'),
(50, 2, 'Jus Naga', 'jus naga', '', 1, 0, 0, 0, NULL, 1, NULL, '2026-04-13 21:22:37', '2026-04-13 21:22:37'),
(51, 2, 'Jus Sirsak', 'jus sirsak', '', 1, 0, 0, 0, NULL, 1, NULL, '2026-04-13 21:23:01', '2026-04-13 21:23:01'),
(52, 2, 'Jus Strawbery', 'jus', '', 1, 0, 0, 0, NULL, 1, NULL, '2026-04-13 21:23:23', '2026-04-13 21:23:23'),
(53, 2, 'Jus Tomat', 'jus tomat', '', 1, 0, 0, 0, NULL, 1, NULL, '2026-04-13 21:23:43', '2026-04-13 21:23:43'),
(54, 2, 'Karedok', 'karedok', '', 1, 0, 0, 0, NULL, 3, NULL, '2026-04-13 21:24:05', '2026-04-13 21:36:52'),
(55, 2, 'Kelapa Batok', 'kelapa', '', 1, 0, 0, 0, NULL, 1, NULL, '2026-04-13 21:24:20', '2026-04-13 21:24:20'),
(56, 2, 'Kelapa Batok Jeruk', 'kelapa', '', 1, 0, 0, 0, NULL, 1, NULL, '2026-04-13 21:24:37', '2026-04-13 21:24:37'),
(57, 2, 'Kembung', 'kembung', '', 1, 0, 0, 0, NULL, 2, NULL, '2026-04-13 21:24:57', '2026-04-13 21:24:57'),
(58, 2, 'Kentang Balado', 'kentang', '', 1, 0, 0, 0, NULL, 3, NULL, '2026-04-13 21:25:14', '2026-04-13 21:25:14'),
(59, 2, 'Kerang Balado', 'kerang', '', 1, 0, 0, 0, NULL, 3, NULL, '2026-04-13 21:25:34', '2026-04-13 21:25:34'),
(60, 2, 'Kopi', 'kopi', '', 1, 0, 0, 0, NULL, 1, NULL, '2026-04-13 21:25:51', '2026-04-13 21:25:51'),
(61, 2, 'Lalaban', 'lalaban', '', 1, 0, 0, 0, NULL, 2, NULL, '2026-04-13 21:26:14', '2026-04-13 21:26:14'),
(62, 2, 'Le Mineral', 'air', '', 1, 0, 0, 0, NULL, 1, NULL, '2026-04-13 21:26:32', '2026-04-13 21:26:32'),
(63, 2, 'Leci Tea Hangat', 'leci', '', 1, 0, 0, 0, NULL, 1, NULL, '2026-04-13 21:27:10', '2026-04-13 21:27:10'),
(64, 2, 'Lemon Hangat', 'lemon', '', 1, 0, 0, 0, NULL, 3, NULL, '2026-04-13 21:27:36', '2026-04-13 21:27:36'),
(65, 2, 'Mendoan', 'mendoan', '', 1, 0, 0, 0, NULL, 2, NULL, '2026-04-13 21:28:01', '2026-04-13 21:28:01'),
(66, 2, 'Nasi Liwet', 'nasi', '', 1, 0, 0, 0, NULL, 2, NULL, '2026-04-13 21:28:27', '2026-04-13 21:28:27'),
(67, 2, 'Nasi Liwet 1/2', 'nasi liwet', '', 1, 0, 0, 0, NULL, 2, NULL, '2026-04-13 21:28:49', '2026-04-13 21:28:49'),
(68, 2, 'Nasi Putih', 'nasi', '', 1, 0, 0, 0, NULL, 2, NULL, '2026-04-13 21:29:08', '2026-04-13 21:29:08'),
(69, 2, 'Nasi Putih 1/2', 'nasi', '', 1, 0, 0, 0, NULL, 2, NULL, '2026-04-13 21:29:24', '2026-04-13 21:29:24'),
(70, 2, 'Nila Bakar', 'nila', '', 1, 0, 0, 0, NULL, 2, NULL, '2026-04-13 21:29:46', '2026-04-13 21:29:46'),
(71, 2, 'Nila Goreng', 'nila', '', 1, 0, 0, 0, NULL, 2, NULL, '2026-04-13 21:30:05', '2026-04-13 21:30:05'),
(72, 2, 'Nila Pecak', 'nila', '', 1, 0, 0, 0, NULL, 2, NULL, '2026-04-13 21:30:30', '2026-04-13 21:30:30'),
(73, 2, 'Oncom', 'oncom', '', 1, 0, 0, 0, NULL, 3, NULL, '2026-04-13 21:31:03', '2026-04-13 21:31:03'),
(74, 2, 'Orek Tempe', 'tempe', '', 1, 0, 0, 0, NULL, 3, NULL, '2026-04-13 21:31:21', '2026-04-13 21:31:21'),
(75, 2, 'Pepaya Mix', 'pepaya', '', 1, 0, 0, 0, NULL, 3, NULL, '2026-04-13 21:31:42', '2026-04-13 21:31:42'),
(76, 2, 'Pepes Ayam', 'pepes ayam', '', 1, 0, 0, 0, NULL, 2, NULL, '2026-04-13 21:31:57', '2026-04-13 21:31:57'),
(77, 2, 'Pepes Ikan Mas', 'pepes ', '', 1, 0, 0, 0, NULL, 2, NULL, '2026-04-13 21:32:18', '2026-04-13 21:32:18'),
(78, 2, 'Pepes Peda', 'pepes', '', 1, 0, 0, 0, NULL, 2, NULL, '2026-04-13 21:32:36', '2026-04-13 21:32:36'),
(79, 2, 'Pepes Tahu', 'pepes', '', 1, 0, 0, 0, NULL, 3, NULL, '2026-04-13 21:33:03', '2026-04-13 21:33:03'),
(80, 2, 'Pepes Teri', 'pepes', '', 1, 0, 0, 0, NULL, 3, NULL, '2026-04-13 21:33:25', '2026-04-13 21:33:25'),
(81, 2, 'Perkedel', 'perkedel', '', 1, 0, 0, 0, NULL, 2, NULL, '2026-04-13 21:33:43', '2026-04-13 21:33:43'),
(82, 2, 'Pesmol Ikan Mas', 'pesmiol', '', 1, 0, 0, 0, NULL, 2, NULL, '2026-04-13 21:34:08', '2026-04-13 21:34:08'),
(83, 2, 'Pete', 'pete', '', 1, 0, 0, 0, NULL, 2, NULL, '2026-04-13 21:34:27', '2026-04-13 21:34:27'),
(84, 2, 'Peye Udang', 'peye udang', '', 1, 0, 0, 0, NULL, 2, NULL, '2026-04-13 21:37:11', '2026-04-13 21:37:11'),
(85, 2, 'Sate Ati Ampela', 'ati ampela', '', 1, 0, 0, 0, NULL, 2, NULL, '2026-04-13 21:37:34', '2026-04-13 21:37:34'),
(86, 2, 'Sate Cumi', 'sate cumi', '', 1, 0, 0, 0, NULL, 2, NULL, '2026-04-13 21:38:06', '2026-04-13 21:38:06'),
(87, 2, 'Sate Kulit', 'sate kulit', '', 1, 0, 0, 0, NULL, 2, NULL, '2026-04-13 21:38:27', '2026-04-13 21:38:27'),
(88, 2, 'Sate Paru', 'sate paru', '', 1, 0, 0, 0, NULL, 2, NULL, '2026-04-13 21:38:45', '2026-04-13 21:38:45'),
(89, 2, 'Sate Udang', 'udang', '', 1, 0, 0, 0, NULL, 2, NULL, '2026-04-13 21:39:05', '2026-04-13 21:39:05'),
(90, 2, 'Sate Usus', 'usus', '', 1, 0, 0, 0, NULL, 2, NULL, '2026-04-13 21:39:24', '2026-04-13 21:39:24'),
(91, 2, 'Sayur Asem', 'sayur asem', '', 1, 0, 0, 0, NULL, 6, NULL, '2026-04-13 21:39:50', '2026-04-13 21:40:37'),
(92, 2, 'Semur Jengkol', 'semur jengkol', '', 1, 0, 0, 0, NULL, 3, NULL, '2026-04-13 21:40:10', '2026-04-13 21:40:10'),
(93, 2, 'Sop Iga ', 'sop iga', '', 1, 0, 0, 0, NULL, 6, NULL, '2026-04-13 21:40:53', '2026-04-13 21:40:53'),
(94, 2, 'Sop Kaki', 'sop kaki', '', 1, 0, 0, 0, NULL, 6, NULL, '2026-04-13 21:41:10', '2026-04-13 21:41:10'),
(95, 2, 'Tahu Bacem', 'tahu', '', 1, 0, 0, 0, NULL, 2, NULL, '2026-04-13 21:41:32', '2026-04-13 21:41:32'),
(96, 2, 'Tahu Goreng', 'tahu goreng', '', 1, 0, 0, 0, NULL, 2, NULL, '2026-04-13 21:42:05', '2026-04-13 21:42:05'),
(97, 2, 'Teh Manis Panas', 'manis', '', 1, 0, 0, 0, NULL, 1, NULL, '2026-04-13 21:42:37', '2026-04-13 21:42:37'),
(98, 2, 'Teh Tawar', 'ytawar', '', 1, 0, 0, 0, NULL, 1, NULL, '2026-04-13 21:42:53', '2026-04-13 21:42:53'),
(99, 2, 'Tempe Bacem', 'bacem', '', 1, 0, 0, 0, NULL, 2, NULL, '2026-04-13 21:43:19', '2026-04-13 21:43:19'),
(100, 2, 'Tempe Goreng', 'tempe', '', 1, 0, 0, 0, NULL, 2, NULL, '2026-04-13 21:43:33', '2026-04-13 21:43:33'),
(101, 2, 'Teri Jengkol', 'teri jengkol', '', 1, 0, 0, 0, NULL, 3, NULL, '2026-04-13 21:43:53', '2026-04-13 21:43:53'),
(102, 2, 'Teri Kacang', 'teri kacang', '', 1, 0, 0, 0, NULL, 3, NULL, '2026-04-13 21:44:14', '2026-04-13 21:44:14'),
(103, 2, 'Terong Balado', 'terong', '', 1, 0, 0, 0, NULL, 3, NULL, '2026-04-13 21:44:34', '2026-04-13 21:44:34'),
(104, 2, 'Tumis Ati Ampela', 'ati', '', 1, 0, 0, 0, NULL, 3, NULL, '2026-04-13 21:44:55', '2026-04-13 21:44:55'),
(105, 2, 'Tumis Babat', 'babat', '', 1, 0, 0, 0, NULL, 3, NULL, '2026-04-13 21:45:13', '2026-04-13 21:45:13'),
(106, 2, 'Tumis Bawang Merah', 'bawang merah', '', 1, 0, 0, 0, NULL, 3, NULL, '2026-04-13 21:45:37', '2026-04-13 21:45:37'),
(107, 2, 'Tumis Ceriwis', 'ceriwis', '', 1, 0, 0, 0, NULL, 3, NULL, '2026-04-13 21:45:56', '2026-04-13 21:45:56'),
(108, 2, 'Tumis Cumi', 'cumi', '', 1, 0, 0, 0, NULL, 3, NULL, '2026-04-13 21:46:13', '2026-04-13 21:46:13'),
(109, 2, 'Tumis Daun Paya', 'daunpaya', '', 1, 0, 0, 0, NULL, 3, NULL, '2026-04-13 21:46:41', '2026-04-13 21:46:41'),
(110, 2, 'Tumis Genjer', 'genjer', '', 1, 0, 0, 0, NULL, 3, NULL, '2026-04-13 21:47:05', '2026-04-13 21:47:05'),
(111, 2, 'Tumis Jambrong', 'jambroing', '', 1, 0, 0, 0, NULL, 3, NULL, '2026-04-13 21:47:23', '2026-04-13 21:47:23'),
(112, 2, 'Tumis Jamur', 'jamur', '', 1, 0, 0, 0, NULL, 3, NULL, '2026-04-13 21:47:47', '2026-04-13 21:47:47'),
(113, 2, 'Tumis Kikil', 'kikil', '', 1, 0, 0, 0, NULL, 3, NULL, '2026-04-13 21:48:07', '2026-04-13 21:48:07'),
(114, 2, 'Tumis Paria', 'paria', '', 1, 0, 0, 0, NULL, 3, NULL, '2026-04-13 21:48:27', '2026-04-13 21:48:27'),
(115, 2, 'Tumis Pari', 'paru', '', 1, 0, 0, 0, NULL, 3, NULL, '2026-04-13 21:48:41', '2026-04-13 21:48:41'),
(116, 2, 'Tumis Peda', 'peda', '', 1, 0, 0, 0, NULL, 3, NULL, '2026-04-13 21:49:00', '2026-04-13 21:49:00'),
(117, 2, 'Tumis Picung', 'picung', '', 1, 0, 0, 0, NULL, 3, NULL, '2026-04-13 21:49:18', '2026-04-13 21:49:18'),
(118, 2, 'Tumis Toge', 'toge', '', 1, 0, 0, 0, NULL, 3, NULL, '2026-04-13 21:49:41', '2026-04-13 21:49:41'),
(119, 2, 'Tumis Usus', 'usus', '', 1, 0, 0, 0, NULL, 3, NULL, '2026-04-13 21:50:01', '2026-04-13 21:50:01'),
(120, 2, 'Udang Balado', 'udang', '', 1, 0, 0, 0, NULL, 3, NULL, '2026-04-13 21:50:16', '2026-04-13 21:50:16'),
(121, 4, 'Air Putih', 'air putih biasa', '', 1, 0, 0, 0, NULL, 7, NULL, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(122, 4, 'Air Putih Es', 'air putih biasa pake es', '', 1, 0, 0, 0, NULL, 7, NULL, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(123, 4, 'Ayam BKR KPG', 'Ayam bakar kampung madu', '', 1, 0, 0, 0, NULL, 8, NULL, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(124, 4, 'Ayam GR KPG', 'ayam goreng kampung', '', 1, 0, 0, 0, NULL, 8, NULL, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(125, 4, 'Ayam Kremes', 'Ayam Kremes', '', 1, 0, 0, 0, NULL, 8, NULL, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(126, 4, 'Bakwan Jagung', 'bakwan jagung', '', 1, 0, 0, 0, NULL, 8, NULL, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(127, 4, 'Bebek Kremes', 'bebek goreng kremes', '', 1, 0, 0, 0, NULL, 8, NULL, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(128, 4, 'Bebek Bakar', 'bebek bakar madu', '', 1, 0, 0, 0, NULL, 8, NULL, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(129, 4, 'Bunga Paya', 'bunga paya tumis', '', 1, 0, 0, 0, NULL, 9, NULL, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(130, 4, 'Empal Serundeng', 'empal bumbu serungdeng', '', 1, 0, 0, 0, NULL, 8, NULL, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(131, 4, 'Es Alpukat Kocok', 'alpukat kocok', '', 1, 0, 0, 0, NULL, 7, NULL, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(132, 4, 'Es Batu', 'es batu', '', 1, 0, 0, 0, NULL, 7, NULL, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(133, 4, 'Es Campur', 'es campur', '', 1, 0, 0, 0, NULL, 7, NULL, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(134, 4, 'Es Cincau', 'es cincau', '', 1, 0, 0, 0, NULL, 7, NULL, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(135, 4, 'Es Cokelat', 'es cokelat', '', 1, 0, 0, 0, NULL, 7, NULL, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(136, 4, 'Es Jeruk', 'es jeruk', '', 1, 0, 0, 0, NULL, 7, NULL, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(137, 4, 'Es Jeruk Alpukat', 'es jeruk alpukat', '', 1, 0, 0, 0, NULL, 7, NULL, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(138, 4, 'Es Jeruk Nipis', 'es jeurk nipis', '', 1, 0, 0, 0, NULL, 7, NULL, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(139, 4, 'Es Kelapa', 'es kelapa', '', 1, 0, 0, 0, NULL, 7, NULL, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(140, 4, 'Es Kelapa Alpukat', 'es kelapa alpukatg', '', 1, 0, 0, 0, NULL, 7, NULL, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(141, 4, 'Es Kelapa Aren', 'es kelapa aren', '', 1, 0, 0, 0, NULL, 7, NULL, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(142, 4, 'Es Kelapa Jeruk', 'es kelapa jeruk', '', 1, 0, 0, 0, NULL, 7, NULL, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(143, 4, 'Es Kopi Aby', 'es kopi aby', '', 1, 0, 0, 0, NULL, 7, NULL, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(144, 4, 'Es Kopi Dalgona', 'es kopi dalgona', '', 1, 0, 0, 0, NULL, 7, NULL, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(145, 4, 'Es Leci Tea', 'es leci tea', '', 1, 0, 0, 0, NULL, 7, NULL, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(146, 4, 'Es Leci Yakult', 'es leci yakult', '', 1, 0, 0, 0, NULL, 7, NULL, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(147, 4, 'Es Lemon Tea', 'es lemon tea', '', 1, 0, 0, 0, NULL, 7, NULL, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(148, 4, 'Es Teh Manis', 'es teh manis', '', 1, 0, 0, 0, NULL, 7, NULL, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(149, 4, 'Es Teh Tawar', 'es teh tawar', '', 1, 0, 0, 0, NULL, 7, NULL, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(150, 4, 'Es Teler', 'es teler', '', 1, 0, 0, 0, NULL, 7, NULL, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(151, 4, 'Goreng Rumput', 'jukut goreng', '', 1, 0, 0, 0, NULL, 8, NULL, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(152, 4, 'Gurame Goreng', 'gurame goreng', '', 1, 0, 0, 0, NULL, 7, NULL, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(153, 4, 'Gurame Bakar', 'gurame bakar', '', 1, 0, 0, 0, NULL, 8, NULL, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(154, 4, 'Gurame Pecak', 'gurame pecal', '', 1, 0, 0, 0, NULL, 8, NULL, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(155, 4, 'Gurita Bakar', 'gurita', '', 1, 0, 0, 0, NULL, 8, NULL, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(156, 4, 'Ikan Asin Gabus', 'ikan asin', '', 1, 0, 0, 0, NULL, 8, NULL, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(157, 4, 'Ikan Baby', 'ikan baby', '', 1, 0, 0, 0, NULL, 8, NULL, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(158, 4, 'Ikan Jambal', 'ikan jambal', '', 1, 0, 0, 0, NULL, 8, NULL, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(159, 4, 'Ikan Lele', 'lele', '', 1, 0, 0, 0, NULL, 8, NULL, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(160, 4, 'Ikan Mas Gr', 'ikan mas gr', '', 1, 0, 0, 0, NULL, 8, NULL, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(161, 4, 'Ikan Peda', 'peda', '', 1, 0, 0, 0, NULL, 8, NULL, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(162, 4, 'Jengkol', 'jengkol', '', 1, 0, 0, 0, NULL, 8, NULL, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(163, 4, 'Jengkol Balado', 'jengkol', '', 1, 0, 0, 0, NULL, 9, NULL, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(164, 4, 'Jeruk Hangat', 'jeruk', '', 1, 0, 0, 0, NULL, 7, NULL, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(165, 4, 'Jeruk Nipis Hangat', 'jeruk', '', 1, 0, 0, 0, NULL, 7, NULL, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(166, 4, 'Jus Alpukat', 'jus alpkuat', '', 1, 0, 0, 0, NULL, 7, NULL, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(167, 4, 'Jus Jambu', 'jus jambu', '', 1, 0, 0, 0, NULL, 7, NULL, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(168, 4, 'Jus Jeruk', 'jus jeruk', '', 1, 0, 0, 0, NULL, 7, NULL, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(169, 4, 'Jus Mangga', 'jus mangga', '', 1, 0, 0, 0, NULL, 7, NULL, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(170, 4, 'Jus Naga', 'jus naga', '', 1, 0, 0, 0, NULL, 7, NULL, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(171, 4, 'Jus Sirsak', 'jus sirsak', '', 1, 0, 0, 0, NULL, 7, NULL, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(172, 4, 'Jus Strawbery', 'jus', '', 1, 0, 0, 0, NULL, 7, NULL, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(173, 4, 'Jus Tomat', 'jus tomat', '', 1, 0, 0, 0, NULL, 7, NULL, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(174, 4, 'Karedok', 'karedok', '', 1, 0, 0, 0, NULL, 9, NULL, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(175, 4, 'Kelapa Batok', 'kelapa', '', 1, 0, 0, 0, NULL, 7, NULL, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(176, 4, 'Kelapa Batok Jeruk', 'kelapa', '', 1, 0, 0, 0, NULL, 7, NULL, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(177, 4, 'Kembung', 'kembung', '', 1, 0, 0, 0, NULL, 8, NULL, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(178, 4, 'Kentang Balado', 'kentang', '', 1, 0, 0, 0, NULL, 9, NULL, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(179, 4, 'Kerang Balado', 'kerang', '', 1, 0, 0, 0, NULL, 9, NULL, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(180, 4, 'Kopi', 'kopi', '', 1, 0, 0, 0, NULL, 7, NULL, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(181, 4, 'Lalaban', 'lalaban', '', 1, 0, 0, 0, NULL, 8, NULL, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(182, 4, 'Le Mineral', 'air', '', 1, 0, 0, 0, NULL, 7, NULL, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(183, 4, 'Leci Tea Hangat', 'leci', '', 1, 0, 0, 0, NULL, 7, NULL, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(184, 4, 'Lemon Hangat', 'lemon', '', 1, 0, 0, 0, NULL, 9, NULL, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(185, 4, 'Mendoan', 'mendoan', '', 1, 0, 0, 0, NULL, 8, NULL, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(186, 4, 'Nasi Liwet', 'nasi', '', 1, 0, 0, 0, NULL, 8, NULL, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(187, 4, 'Nasi Liwet 1/2', 'nasi liwet', '', 1, 0, 0, 0, NULL, 8, NULL, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(188, 4, 'Nasi Putih', 'nasi', '', 1, 0, 0, 0, NULL, 8, NULL, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(189, 4, 'Nasi Putih 1/2', 'nasi', '', 1, 0, 0, 0, NULL, 8, NULL, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(190, 4, 'Nila Bakar', 'nila', '', 1, 0, 0, 0, NULL, 8, NULL, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(191, 4, 'Nila Goreng', 'nila', '', 1, 0, 0, 0, NULL, 8, NULL, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(192, 4, 'Nila Pecak', 'nila', '', 1, 0, 0, 0, NULL, 8, NULL, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(193, 4, 'Oncom', 'oncom', '', 1, 0, 0, 0, NULL, 9, NULL, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(194, 4, 'Orek Tempe', 'tempe', '', 1, 0, 0, 0, NULL, 9, NULL, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(195, 4, 'Pepaya Mix', 'pepaya', '', 1, 0, 0, 0, NULL, 9, NULL, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(196, 4, 'Pepes Ayam', 'pepes ayam', '', 1, 0, 0, 0, NULL, 8, NULL, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(197, 4, 'Pepes Ikan Mas', 'pepes ', '', 1, 0, 0, 0, NULL, 8, NULL, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(198, 4, 'Pepes Peda', 'pepes', '', 1, 0, 0, 0, NULL, 8, NULL, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(199, 4, 'Pepes Tahu', 'pepes', '', 1, 0, 0, 0, NULL, 9, NULL, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(200, 4, 'Pepes Teri', 'pepes', '', 1, 0, 0, 0, NULL, 9, NULL, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(201, 4, 'Perkedel', 'perkedel', '', 1, 0, 0, 0, NULL, 8, NULL, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(202, 4, 'Pesmol Ikan Mas', 'pesmiol', '', 1, 0, 0, 0, NULL, 8, NULL, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(203, 4, 'Pete', 'pete', '', 1, 0, 0, 0, NULL, 8, NULL, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(204, 4, 'Peye Udang', 'peye udang', '', 1, 0, 0, 0, NULL, 8, NULL, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(205, 4, 'Sate Ati Ampela', 'ati ampela', '', 1, 0, 0, 0, NULL, 8, NULL, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(206, 4, 'Sate Cumi', 'sate cumi', '', 1, 0, 0, 0, NULL, 8, NULL, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(207, 4, 'Sate Kulit', 'sate kulit', '', 1, 0, 0, 0, NULL, 8, NULL, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(208, 4, 'Sate Paru', 'sate paru', '', 1, 0, 0, 0, NULL, 8, NULL, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(209, 4, 'Sate Udang', 'udang', '', 1, 0, 0, 0, NULL, 8, NULL, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(210, 4, 'Sate Usus', 'usus', '', 1, 0, 0, 0, NULL, 8, NULL, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(211, 4, 'Sayur Asem', 'sayur asem', '', 1, 0, 0, 0, NULL, 10, NULL, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(212, 4, 'Semur Jengkol', 'semur jengkol', '', 1, 0, 0, 0, NULL, 9, NULL, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(213, 4, 'Sop Iga ', 'sop iga', '', 1, 0, 0, 0, NULL, 10, NULL, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(214, 4, 'Sop Kaki', 'sop kaki', '', 1, 0, 0, 0, NULL, 10, NULL, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(215, 4, 'Tahu Bacem', 'tahu', '', 1, 0, 0, 0, NULL, 8, NULL, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(216, 4, 'Tahu Goreng', 'tahu goreng', '', 1, 0, 0, 0, NULL, 8, NULL, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(217, 4, 'Teh Manis Panas', 'manis', '', 1, 0, 0, 0, NULL, 7, NULL, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(218, 4, 'Teh Tawar', 'ytawar', '', 1, 0, 0, 0, NULL, 7, NULL, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(219, 4, 'Tempe Bacem', 'bacem', '', 1, 0, 0, 0, NULL, 8, NULL, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(220, 4, 'Tempe Goreng', 'tempe', '', 1, 0, 0, 0, NULL, 8, NULL, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(221, 4, 'Teri Jengkol', 'teri jengkol', '', 1, 0, 0, 0, NULL, 9, NULL, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(222, 4, 'Teri Kacang', 'teri kacang', '', 1, 0, 0, 0, NULL, 9, NULL, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(223, 4, 'Terong Balado', 'terong', '', 1, 0, 0, 0, NULL, 9, NULL, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(224, 4, 'Tumis Ati Ampela', 'ati', '', 1, 0, 0, 0, NULL, 9, NULL, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(225, 4, 'Tumis Babat', 'babat', '', 1, 0, 0, 0, NULL, 9, NULL, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(226, 4, 'Tumis Bawang Merah', 'bawang merah', '', 1, 0, 0, 0, NULL, 9, NULL, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(227, 4, 'Tumis Ceriwis', 'ceriwis', '', 1, 0, 0, 0, NULL, 9, NULL, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(228, 4, 'Tumis Cumi', 'cumi', '', 1, 0, 0, 0, NULL, 9, NULL, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(229, 4, 'Tumis Daun Paya', 'daunpaya', '', 1, 0, 0, 0, NULL, 9, NULL, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(230, 4, 'Tumis Genjer', 'genjer', '', 1, 0, 0, 0, NULL, 9, NULL, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(231, 4, 'Tumis Jambrong', 'jambroing', '', 1, 0, 0, 0, NULL, 9, NULL, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(232, 4, 'Tumis Jamur', 'jamur', '', 1, 0, 0, 0, NULL, 9, NULL, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(233, 4, 'Tumis Kikil', 'kikil', '', 1, 0, 0, 0, NULL, 9, NULL, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(234, 4, 'Tumis Paria', 'paria', '', 1, 0, 0, 0, NULL, 9, NULL, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(235, 4, 'Tumis Pari', 'paru', '', 1, 0, 0, 0, NULL, 9, NULL, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(236, 4, 'Tumis Peda', 'peda', '', 1, 0, 0, 0, NULL, 9, NULL, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(237, 4, 'Tumis Picung', 'picung', '', 1, 0, 0, 0, NULL, 9, NULL, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(238, 4, 'Tumis Toge', 'toge', '', 1, 0, 0, 0, NULL, 9, NULL, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(239, 4, 'Tumis Usus', 'usus', '', 1, 0, 0, 0, NULL, 9, NULL, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(240, 4, 'Udang Balado', 'udang', '', 1, 0, 0, 0, NULL, 9, NULL, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(241, 5, 'Air Putih', 'air putih biasa', '', 1, 0, 0, 0, NULL, 11, NULL, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(242, 5, 'Air Putih Es', 'air putih biasa pake es', '', 1, 0, 0, 0, NULL, 11, NULL, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(243, 5, 'Ayam BKR KPG', 'Ayam bakar kampung madu', '', 1, 0, 0, 0, NULL, 12, NULL, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(244, 5, 'Ayam GR KPG', 'ayam goreng kampung', '', 1, 0, 0, 0, NULL, 12, NULL, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(245, 5, 'Ayam Kremes', 'Ayam Kremes', '', 1, 0, 0, 0, NULL, 12, NULL, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(246, 5, 'Bakwan Jagung', 'bakwan jagung', '', 1, 0, 0, 0, NULL, 12, NULL, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(247, 5, 'Bebek Kremes', 'bebek goreng kremes', '', 1, 0, 0, 0, NULL, 12, NULL, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(248, 5, 'Bebek Bakar', 'bebek bakar madu', '', 1, 0, 0, 0, NULL, 12, NULL, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(249, 5, 'Bunga Paya', 'bunga paya tumis', '', 1, 0, 0, 0, NULL, 13, NULL, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(250, 5, 'Empal Serundeng', 'empal bumbu serungdeng', '', 1, 0, 0, 0, NULL, 12, NULL, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(251, 5, 'Es Alpukat Kocok', 'alpukat kocok', '', 1, 0, 0, 0, NULL, 11, NULL, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(252, 5, 'Es Batu', 'es batu', '', 1, 0, 0, 0, NULL, 11, NULL, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(253, 5, 'Es Campur', 'es campur', '', 1, 0, 0, 0, NULL, 11, NULL, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(254, 5, 'Es Cincau', 'es cincau', '', 1, 0, 0, 0, NULL, 11, NULL, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(255, 5, 'Es Cokelat', 'es cokelat', '', 1, 0, 0, 0, NULL, 11, NULL, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(256, 5, 'Es Jeruk', 'es jeruk', '', 1, 0, 0, 0, NULL, 11, NULL, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(257, 5, 'Es Jeruk Alpukat', 'es jeruk alpukat', '', 1, 0, 0, 0, NULL, 11, NULL, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(258, 5, 'Es Jeruk Nipis', 'es jeurk nipis', '', 1, 0, 0, 0, NULL, 11, NULL, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(259, 5, 'Es Kelapa', 'es kelapa', '', 1, 0, 0, 0, NULL, 11, NULL, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(260, 5, 'Es Kelapa Alpukat', 'es kelapa alpukatg', '', 1, 0, 0, 0, NULL, 11, NULL, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(261, 5, 'Es Kelapa Aren', 'es kelapa aren', '', 1, 0, 0, 0, NULL, 11, NULL, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(262, 5, 'Es Kelapa Jeruk', 'es kelapa jeruk', '', 1, 0, 0, 0, NULL, 11, NULL, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(263, 5, 'Es Kopi Aby', 'es kopi aby', '', 1, 0, 0, 0, NULL, 11, NULL, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(264, 5, 'Es Kopi Dalgona', 'es kopi dalgona', '', 1, 0, 0, 0, NULL, 11, NULL, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(265, 5, 'Es Leci Tea', 'es leci tea', '', 1, 0, 0, 0, NULL, 11, NULL, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(266, 5, 'Es Leci Yakult', 'es leci yakult', '', 1, 0, 0, 0, NULL, 11, NULL, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(267, 5, 'Es Lemon Tea', 'es lemon tea', '', 1, 0, 0, 0, NULL, 11, NULL, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(268, 5, 'Es Teh Manis', 'es teh manis', '', 1, 0, 0, 0, NULL, 11, NULL, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(269, 5, 'Es Teh Tawar', 'es teh tawar', '', 1, 0, 0, 0, NULL, 11, NULL, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(270, 5, 'Es Teler', 'es teler', '', 1, 0, 0, 0, NULL, 11, NULL, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(271, 5, 'Goreng Rumput', 'jukut goreng', '', 1, 0, 0, 0, NULL, 12, NULL, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(272, 5, 'Gurame Goreng', 'gurame goreng', '', 1, 0, 0, 0, NULL, 11, NULL, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(273, 5, 'Gurame Bakar', 'gurame bakar', '', 1, 0, 0, 0, NULL, 12, NULL, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(274, 5, 'Gurame Pecak', 'gurame pecal', '', 1, 0, 0, 0, NULL, 12, NULL, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(275, 5, 'Gurita Bakar', 'gurita', '', 1, 0, 0, 0, NULL, 12, NULL, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(276, 5, 'Ikan Asin Gabus', 'ikan asin', '', 1, 0, 0, 0, NULL, 12, NULL, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(277, 5, 'Ikan Baby', 'ikan baby', '', 1, 0, 0, 0, NULL, 12, NULL, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(278, 5, 'Ikan Jambal', 'ikan jambal', '', 1, 0, 0, 0, NULL, 12, NULL, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(279, 5, 'Ikan Lele', 'lele', '', 1, 0, 0, 0, NULL, 12, NULL, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(280, 5, 'Ikan Mas Gr', 'ikan mas gr', '', 1, 0, 0, 0, NULL, 12, NULL, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(281, 5, 'Ikan Peda', 'peda', '', 1, 0, 0, 0, NULL, 12, NULL, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(282, 5, 'Jengkol', 'jengkol', '', 1, 0, 0, 0, NULL, 12, NULL, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(283, 5, 'Jengkol Balado', 'jengkol', '', 1, 0, 0, 0, NULL, 13, NULL, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(284, 5, 'Jeruk Hangat', 'jeruk', '', 1, 0, 0, 0, NULL, 11, NULL, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(285, 5, 'Jeruk Nipis Hangat', 'jeruk', '', 1, 0, 0, 0, NULL, 11, NULL, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(286, 5, 'Jus Alpukat', 'jus alpkuat', '', 1, 0, 0, 0, NULL, 11, NULL, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(287, 5, 'Jus Jambu', 'jus jambu', '', 1, 0, 0, 0, NULL, 11, NULL, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(288, 5, 'Jus Jeruk', 'jus jeruk', '', 1, 0, 0, 0, NULL, 11, NULL, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(289, 5, 'Jus Mangga', 'jus mangga', '', 1, 0, 0, 0, NULL, 11, NULL, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(290, 5, 'Jus Naga', 'jus naga', '', 1, 0, 0, 0, NULL, 11, NULL, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(291, 5, 'Jus Sirsak', 'jus sirsak', '', 1, 0, 0, 0, NULL, 11, NULL, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(292, 5, 'Jus Strawbery', 'jus', '', 1, 0, 0, 0, NULL, 11, NULL, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(293, 5, 'Jus Tomat', 'jus tomat', '', 1, 0, 0, 0, NULL, 11, NULL, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(294, 5, 'Karedok', 'karedok', '', 1, 0, 0, 0, NULL, 13, NULL, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(295, 5, 'Kelapa Batok', 'kelapa', '', 1, 0, 0, 0, NULL, 11, NULL, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(296, 5, 'Kelapa Batok Jeruk', 'kelapa', '', 1, 0, 0, 0, NULL, 11, NULL, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(297, 5, 'Kembung', 'kembung', '', 1, 0, 0, 0, NULL, 12, NULL, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(298, 5, 'Kentang Balado', 'kentang', '', 1, 0, 0, 0, NULL, 13, NULL, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(299, 5, 'Kerang Balado', 'kerang', '', 1, 0, 0, 0, NULL, 13, NULL, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(300, 5, 'Kopi', 'kopi', '', 1, 0, 0, 0, NULL, 11, NULL, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(301, 5, 'Lalaban', 'lalaban', '', 1, 0, 0, 0, NULL, 12, NULL, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(302, 5, 'Le Mineral', 'air', '', 1, 0, 0, 0, NULL, 11, NULL, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(303, 5, 'Leci Tea Hangat', 'leci', '', 1, 0, 0, 0, NULL, 11, NULL, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(304, 5, 'Lemon Hangat', 'lemon', '', 1, 0, 0, 0, NULL, 13, NULL, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(305, 5, 'Mendoan', 'mendoan', '', 1, 0, 0, 0, NULL, 12, NULL, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(306, 5, 'Nasi Liwet', 'nasi', '', 1, 0, 0, 0, NULL, 12, NULL, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(307, 5, 'Nasi Liwet 1/2', 'nasi liwet', '', 1, 0, 0, 0, NULL, 12, NULL, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(308, 5, 'Nasi Putih', 'nasi', '', 1, 0, 0, 0, NULL, 12, NULL, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(309, 5, 'Nasi Putih 1/2', 'nasi', '', 1, 0, 0, 0, NULL, 12, NULL, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(310, 5, 'Nila Bakar', 'nila', '', 1, 0, 0, 0, NULL, 12, NULL, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(311, 5, 'Nila Goreng', 'nila', '', 1, 0, 0, 0, NULL, 12, NULL, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(312, 5, 'Nila Pecak', 'nila', '', 1, 0, 0, 0, NULL, 12, NULL, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(313, 5, 'Oncom', 'oncom', '', 1, 0, 0, 0, NULL, 13, NULL, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(314, 5, 'Orek Tempe', 'tempe', '', 1, 0, 0, 0, NULL, 13, NULL, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(315, 5, 'Pepaya Mix', 'pepaya', '', 1, 0, 0, 0, NULL, 13, NULL, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(316, 5, 'Pepes Ayam', 'pepes ayam', '', 1, 0, 0, 0, NULL, 12, NULL, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(317, 5, 'Pepes Ikan Mas', 'pepes ', '', 1, 0, 0, 0, NULL, 12, NULL, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(318, 5, 'Pepes Peda', 'pepes', '', 1, 0, 0, 0, NULL, 12, NULL, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(319, 5, 'Pepes Tahu', 'pepes', '', 1, 0, 0, 0, NULL, 13, NULL, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(320, 5, 'Pepes Teri', 'pepes', '', 1, 0, 0, 0, NULL, 13, NULL, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(321, 5, 'Perkedel', 'perkedel', '', 1, 0, 0, 0, NULL, 12, NULL, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(322, 5, 'Pesmol Ikan Mas', 'pesmiol', '', 1, 0, 0, 0, NULL, 12, NULL, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(323, 5, 'Pete', 'pete', '', 1, 0, 0, 0, NULL, 12, NULL, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(324, 5, 'Peye Udang', 'peye udang', '', 1, 0, 0, 0, NULL, 12, NULL, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(325, 5, 'Sate Ati Ampela', 'ati ampela', '', 1, 0, 0, 0, NULL, 12, NULL, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(326, 5, 'Sate Cumi', 'sate cumi', '', 1, 0, 0, 0, NULL, 12, NULL, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(327, 5, 'Sate Kulit', 'sate kulit', '', 1, 0, 0, 0, NULL, 12, NULL, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(328, 5, 'Sate Paru', 'sate paru', '', 1, 0, 0, 0, NULL, 12, NULL, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(329, 5, 'Sate Udang', 'udang', '', 1, 0, 0, 0, NULL, 12, NULL, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(330, 5, 'Sate Usus', 'usus', '', 1, 0, 0, 0, NULL, 12, NULL, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(331, 5, 'Sayur Asem', 'sayur asem', '', 1, 0, 0, 0, NULL, 14, NULL, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(332, 5, 'Semur Jengkol', 'semur jengkol', '', 1, 0, 0, 0, NULL, 13, NULL, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(333, 5, 'Sop Iga ', 'sop iga', '', 1, 0, 0, 0, NULL, 14, NULL, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(334, 5, 'Sop Kaki', 'sop kaki', '', 1, 0, 0, 0, NULL, 14, NULL, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(335, 5, 'Tahu Bacem', 'tahu', '', 1, 0, 0, 0, NULL, 12, NULL, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(336, 5, 'Tahu Goreng', 'tahu goreng', '', 1, 0, 0, 0, NULL, 12, NULL, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(337, 5, 'Teh Manis Panas', 'manis', '', 1, 0, 0, 0, NULL, 11, NULL, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(338, 5, 'Teh Tawar', 'ytawar', '', 1, 0, 0, 0, NULL, 11, NULL, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(339, 5, 'Tempe Bacem', 'bacem', '', 1, 0, 0, 0, NULL, 12, NULL, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(340, 5, 'Tempe Goreng', 'tempe', '', 1, 0, 0, 0, NULL, 12, NULL, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(341, 5, 'Teri Jengkol', 'teri jengkol', '', 1, 0, 0, 0, NULL, 13, NULL, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(342, 5, 'Teri Kacang', 'teri kacang', '', 1, 0, 0, 0, NULL, 13, NULL, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(343, 5, 'Terong Balado', 'terong', '', 1, 0, 0, 0, NULL, 13, NULL, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(344, 5, 'Tumis Ati Ampela', 'ati', '', 1, 0, 0, 0, NULL, 13, NULL, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(345, 5, 'Tumis Babat', 'babat', '', 1, 0, 0, 0, NULL, 13, NULL, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(346, 5, 'Tumis Bawang Merah', 'bawang merah', '', 1, 0, 0, 0, NULL, 13, NULL, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(347, 5, 'Tumis Ceriwis', 'ceriwis', '', 1, 0, 0, 0, NULL, 13, NULL, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(348, 5, 'Tumis Cumi', 'cumi', '', 1, 0, 0, 0, NULL, 13, NULL, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(349, 5, 'Tumis Daun Paya', 'daunpaya', '', 1, 0, 0, 0, NULL, 13, NULL, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(350, 5, 'Tumis Genjer', 'genjer', '', 1, 0, 0, 0, NULL, 13, NULL, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(351, 5, 'Tumis Jambrong', 'jambroing', '', 1, 0, 0, 0, NULL, 13, NULL, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(352, 5, 'Tumis Jamur', 'jamur', '', 1, 0, 0, 0, NULL, 13, NULL, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(353, 5, 'Tumis Kikil', 'kikil', '', 1, 0, 0, 0, NULL, 13, NULL, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(354, 5, 'Tumis Paria', 'paria', '', 1, 0, 0, 0, NULL, 13, NULL, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(355, 5, 'Tumis Pari', 'paru', '', 1, 0, 0, 0, NULL, 13, NULL, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(356, 5, 'Tumis Peda', 'peda', '', 1, 0, 0, 0, NULL, 13, NULL, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(357, 5, 'Tumis Picung', 'picung', '', 1, 0, 0, 0, NULL, 13, NULL, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(358, 5, 'Tumis Toge', 'toge', '', 1, 0, 0, 0, NULL, 13, NULL, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(359, 5, 'Tumis Usus', 'usus', '', 1, 0, 0, 0, NULL, 13, NULL, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(360, 5, 'Udang Balado', 'udang', '', 1, 0, 0, 0, NULL, 13, NULL, '2026-04-13 21:56:00', '2026-04-13 21:56:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `product_complex_package_items`
--

CREATE TABLE `product_complex_package_items` (
  `id` bigint UNSIGNED NOT NULL,
  `package_product_id` bigint UNSIGNED NOT NULL,
  `component_product_id` bigint UNSIGNED NOT NULL,
  `quantity` int UNSIGNED NOT NULL,
  `is_splitable` tinyint(1) NOT NULL DEFAULT '0',
  `sort_order` smallint UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `product_package_items`
--

CREATE TABLE `product_package_items` (
  `id` bigint UNSIGNED NOT NULL,
  `package_product_id` bigint UNSIGNED NOT NULL,
  `component_product_variant_id` bigint UNSIGNED NOT NULL,
  `quantity` int UNSIGNED NOT NULL DEFAULT '1',
  `sort_order` smallint UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `product_recipes`
--

CREATE TABLE `product_recipes` (
  `id` bigint UNSIGNED NOT NULL,
  `cabang_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `ingredient_id` bigint UNSIGNED NOT NULL,
  `quantity` decimal(12,3) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `product_variants`
--

CREATE TABLE `product_variants` (
  `id` bigint UNSIGNED NOT NULL,
  `cabang_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(12,2) NOT NULL,
  `price_afterdiscount` decimal(12,2) DEFAULT NULL,
  `percent` int DEFAULT NULL,
  `hpp` decimal(12,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `product_variants`
--

INSERT INTO `product_variants` (`id`, `cabang_id`, `product_id`, `name`, `price`, `price_afterdiscount`, `percent`, `hpp`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 'regular', 2000.00, NULL, NULL, 0.00, '2026-04-13 20:58:31', '2026-04-13 20:58:31'),
(2, 2, 2, 'reguler', 3000.00, NULL, NULL, 0.00, '2026-04-13 20:59:26', '2026-04-13 20:59:26'),
(3, 2, 3, 'reguler', 29000.00, NULL, NULL, 0.00, '2026-04-13 21:00:23', '2026-04-13 21:00:23'),
(4, 2, 4, 'reguler', 29000.00, NULL, NULL, 0.00, '2026-04-13 21:01:31', '2026-04-13 21:01:31'),
(5, 2, 5, 'reguler', 25000.00, NULL, NULL, 0.00, '2026-04-13 21:02:11', '2026-04-13 21:02:11'),
(6, 2, 6, 'reguler', 5000.00, NULL, NULL, 0.00, '2026-04-13 21:02:55', '2026-04-13 21:02:55'),
(7, 2, 7, 'reguler', 40000.00, NULL, NULL, 0.00, '2026-04-13 21:03:20', '2026-04-13 21:03:20'),
(8, 2, 8, 'reguler', 42000.00, NULL, NULL, 0.00, '2026-04-13 21:03:42', '2026-04-13 21:03:42'),
(9, 2, 9, 'reguler', 16000.00, NULL, NULL, 0.00, '2026-04-13 21:04:20', '2026-04-13 21:04:20'),
(10, 2, 10, 'reguler', 28000.00, NULL, NULL, 0.00, '2026-04-13 21:04:50', '2026-04-13 21:04:50'),
(11, 2, 11, 'reguler', 20000.00, NULL, NULL, 0.00, '2026-04-13 21:05:30', '2026-04-13 21:05:30'),
(12, 2, 12, 'reguler', 3000.00, NULL, NULL, 0.00, '2026-04-13 21:05:54', '2026-04-13 21:05:54'),
(13, 2, 13, 'reguler', 23000.00, NULL, NULL, 0.00, '2026-04-13 21:06:14', '2026-04-13 21:06:14'),
(14, 2, 14, 'reguler', 17000.00, NULL, NULL, 0.00, '2026-04-13 21:06:40', '2026-04-13 21:06:40'),
(15, 2, 15, 'reguler', 15000.00, NULL, NULL, 0.00, '2026-04-13 21:07:01', '2026-04-13 21:07:01'),
(16, 2, 16, 'reguler', 18000.00, NULL, NULL, 0.00, '2026-04-13 21:07:33', '2026-04-13 21:07:33'),
(17, 2, 17, 'reguler', 26000.00, NULL, NULL, 0.00, '2026-04-13 21:07:57', '2026-04-13 21:07:57'),
(18, 2, 18, 'reguler', 12000.00, NULL, NULL, 0.00, '2026-04-13 21:08:27', '2026-04-13 21:08:27'),
(19, 2, 19, 'reguler', 19000.00, NULL, NULL, 0.00, '2026-04-13 21:08:53', '2026-04-13 21:08:53'),
(20, 2, 20, 'reguler', 27000.00, NULL, NULL, 0.00, '2026-04-13 21:09:17', '2026-04-13 21:09:17'),
(21, 2, 21, 'reguler', 21000.00, NULL, NULL, 0.00, '2026-04-13 21:09:44', '2026-04-13 21:09:44'),
(22, 2, 22, 'reguler', 22000.00, NULL, NULL, 0.00, '2026-04-13 21:10:36', '2026-04-13 21:10:36'),
(23, 2, 23, 'reguler', 25000.00, NULL, NULL, 0.00, '2026-04-13 21:11:10', '2026-04-13 21:11:10'),
(24, 2, 24, 'reguler', 25000.00, NULL, NULL, 0.00, '2026-04-13 21:11:40', '2026-04-13 21:11:40'),
(25, 2, 25, 'reguler', 22000.00, NULL, NULL, 0.00, '2026-04-13 21:12:33', '2026-04-13 21:12:33'),
(26, 2, 26, 'reguler', 25000.00, NULL, NULL, 0.00, '2026-04-13 21:13:03', '2026-04-13 21:13:03'),
(27, 2, 27, 'reguler', 18000.00, NULL, NULL, 0.00, '2026-04-13 21:13:25', '2026-04-13 21:13:25'),
(28, 2, 28, 'reguler', 8000.00, NULL, NULL, 0.00, '2026-04-13 21:13:50', '2026-04-13 21:13:50'),
(29, 2, 29, 'reguler', 5000.00, NULL, NULL, 0.00, '2026-04-13 21:14:14', '2026-04-13 21:14:14'),
(30, 2, 30, 'reguler', 27000.00, NULL, NULL, 0.00, '2026-04-13 21:14:31', '2026-04-13 21:14:31'),
(31, 2, 31, 'reguler', 15000.00, NULL, NULL, 0.00, '2026-04-13 21:14:54', '2026-04-13 21:14:54'),
(32, 2, 32, 'reguler', 95000.00, NULL, NULL, 0.00, '2026-04-13 21:15:19', '2026-04-13 21:15:19'),
(33, 2, 33, 'reguler', 105000.00, NULL, NULL, 0.00, '2026-04-13 21:15:50', '2026-04-13 21:15:50'),
(34, 2, 34, 'reguler', 98000.00, NULL, NULL, 0.00, '2026-04-13 21:16:20', '2026-04-13 21:16:20'),
(35, 2, 35, 'reguler', 67000.00, NULL, NULL, 0.00, '2026-04-13 21:17:18', '2026-04-13 21:17:18'),
(36, 2, 36, 'reguler', 14000.00, NULL, NULL, 0.00, '2026-04-13 21:17:37', '2026-04-13 21:17:37'),
(37, 2, 37, 'reguler', 27000.00, NULL, NULL, 0.00, '2026-04-13 21:18:04', '2026-04-13 21:18:04'),
(38, 2, 38, 'reguler', 16000.00, NULL, NULL, 0.00, '2026-04-13 21:18:39', '2026-04-13 21:18:39'),
(39, 2, 39, 'reguler', 16000.00, NULL, NULL, 0.00, '2026-04-13 21:18:54', '2026-04-13 21:18:54'),
(40, 2, 40, 'reguler', 300000.00, NULL, NULL, 0.00, '2026-04-13 21:19:14', '2026-04-13 21:19:14'),
(41, 2, 41, 'reguler', 16000.00, NULL, NULL, 0.00, '2026-04-13 21:19:28', '2026-04-13 21:19:28'),
(42, 2, 42, 'reguler', 11000.00, NULL, NULL, 0.00, '2026-04-13 21:19:45', '2026-04-13 21:19:45'),
(43, 2, 43, 'reguler', 21000.00, NULL, NULL, 0.00, '2026-04-13 21:20:02', '2026-04-13 21:20:02'),
(44, 2, 44, 'reguler', 16000.00, NULL, NULL, 0.00, '2026-04-13 21:20:20', '2026-04-13 21:20:20'),
(45, 2, 45, 'reguler', 11000.00, NULL, NULL, 0.00, '2026-04-13 21:20:41', '2026-04-13 21:20:41'),
(46, 2, 46, 'reguler', 21000.00, NULL, NULL, 0.00, '2026-04-13 21:21:00', '2026-04-13 21:21:00'),
(47, 2, 47, 'regluer', 21000.00, NULL, NULL, 0.00, '2026-04-13 21:21:17', '2026-04-13 21:21:17'),
(48, 2, 48, 'reguler', 20000.00, NULL, NULL, 0.00, '2026-04-13 21:21:36', '2026-04-13 21:22:10'),
(49, 2, 49, 'reguler', 23000.00, NULL, NULL, 0.00, '2026-04-13 21:21:56', '2026-04-13 21:21:56'),
(50, 2, 50, 'reguler', 21000.00, NULL, NULL, 0.00, '2026-04-13 21:22:37', '2026-04-13 21:22:37'),
(51, 2, 51, 'reguler', 21000.00, NULL, NULL, 0.00, '2026-04-13 21:23:01', '2026-04-13 21:23:01'),
(52, 2, 52, 'reguler', 21000.00, NULL, NULL, 0.00, '2026-04-13 21:23:23', '2026-04-13 21:23:23'),
(53, 2, 53, 'rguler', 18000.00, NULL, NULL, 0.00, '2026-04-13 21:23:43', '2026-04-13 21:23:43'),
(54, 2, 54, 'reguler', 16000.00, NULL, NULL, 0.00, '2026-04-13 21:24:05', '2026-04-13 21:36:52'),
(55, 2, 55, 'reguler', 25000.00, NULL, NULL, 0.00, '2026-04-13 21:24:20', '2026-04-13 21:24:20'),
(56, 2, 56, 'reguler', 32000.00, NULL, NULL, 0.00, '2026-04-13 21:24:37', '2026-04-13 21:24:37'),
(57, 2, 57, 'reguler', 20000.00, NULL, NULL, 0.00, '2026-04-13 21:24:57', '2026-04-13 21:24:57'),
(58, 2, 58, 'reguler', 17000.00, NULL, NULL, 0.00, '2026-04-13 21:25:14', '2026-04-13 21:25:14'),
(59, 2, 59, 'Reguler', 25000.00, NULL, NULL, 0.00, '2026-04-13 21:25:34', '2026-04-13 21:25:34'),
(60, 2, 60, 'reguler', 8000.00, NULL, NULL, 0.00, '2026-04-13 21:25:51', '2026-04-13 21:25:51'),
(61, 2, 61, 'reguler', 10000.00, NULL, NULL, 0.00, '2026-04-13 21:26:14', '2026-04-13 21:26:14'),
(62, 2, 62, 'reguler', 8000.00, NULL, NULL, 0.00, '2026-04-13 21:26:32', '2026-04-13 21:26:32'),
(63, 2, 63, 'reguler', 18000.00, NULL, NULL, 0.00, '2026-04-13 21:27:10', '2026-04-13 21:27:10'),
(64, 2, 64, 'reguler', 16000.00, NULL, NULL, 0.00, '2026-04-13 21:27:36', '2026-04-13 21:27:36'),
(65, 2, 65, 'reguler', 6000.00, NULL, NULL, 0.00, '2026-04-13 21:28:01', '2026-04-13 21:28:01'),
(66, 2, 66, 'reguler', 10000.00, NULL, NULL, 0.00, '2026-04-13 21:28:27', '2026-04-13 21:28:27'),
(67, 2, 67, 'reguler', 8000.00, NULL, NULL, 0.00, '2026-04-13 21:28:49', '2026-04-13 21:28:49'),
(68, 2, 68, 'reguler', 8000.00, NULL, NULL, 0.00, '2026-04-13 21:29:08', '2026-04-13 21:29:08'),
(69, 2, 69, 'reguler', 6000.00, NULL, NULL, 0.00, '2026-04-13 21:29:24', '2026-04-13 21:29:24'),
(70, 2, 70, 'reguler', 60000.00, NULL, NULL, 0.00, '2026-04-13 21:29:46', '2026-04-13 21:29:46'),
(71, 2, 71, 'reguler', 45000.00, NULL, NULL, 0.00, '2026-04-13 21:30:05', '2026-04-13 21:30:05'),
(72, 2, 72, 'reguler', 75000.00, NULL, NULL, 0.00, '2026-04-13 21:30:30', '2026-04-13 21:30:30'),
(73, 2, 73, 'reguler', 16000.00, NULL, NULL, 0.00, '2026-04-13 21:31:03', '2026-04-13 21:31:03'),
(74, 2, 74, 'reguler', 16000.00, NULL, NULL, 0.00, '2026-04-13 21:31:21', '2026-04-13 21:31:21'),
(75, 2, 75, 'reguler', 16000.00, NULL, NULL, 0.00, '2026-04-13 21:31:42', '2026-04-13 21:31:42'),
(76, 2, 76, 'reguler', 19000.00, NULL, NULL, 0.00, '2026-04-13 21:31:57', '2026-04-13 21:31:57'),
(77, 2, 77, 'reguler', 40000.00, NULL, NULL, 0.00, '2026-04-13 21:32:18', '2026-04-13 21:32:18'),
(78, 2, 78, 'reguler', 18000.00, NULL, NULL, 0.00, '2026-04-13 21:32:36', '2026-04-13 21:32:36'),
(79, 2, 79, 'regular', 7000.00, NULL, NULL, 0.00, '2026-04-13 21:33:03', '2026-04-13 21:33:03'),
(80, 2, 80, 'reguler', 16000.00, NULL, NULL, 0.00, '2026-04-13 21:33:25', '2026-04-13 21:33:25'),
(81, 2, 81, 'reguler', 6000.00, NULL, NULL, 0.00, '2026-04-13 21:33:43', '2026-04-13 21:33:43'),
(82, 2, 82, 'reguler', 30000.00, NULL, NULL, 0.00, '2026-04-13 21:34:08', '2026-04-13 21:34:08'),
(83, 2, 83, 'reguler ', 16000.00, NULL, NULL, 0.00, '2026-04-13 21:34:27', '2026-04-13 21:34:27'),
(84, 2, 84, 'reguler', 25000.00, NULL, NULL, 0.00, '2026-04-13 21:37:11', '2026-04-13 21:37:11'),
(85, 2, 85, 'reguler', 8000.00, NULL, NULL, 0.00, '2026-04-13 21:37:34', '2026-04-13 21:37:34'),
(86, 2, 86, 'sreguler', 19000.00, NULL, NULL, 0.00, '2026-04-13 21:38:06', '2026-04-13 21:38:06'),
(87, 2, 87, 'reguler', 11000.00, NULL, NULL, 0.00, '2026-04-13 21:38:27', '2026-04-13 21:38:27'),
(88, 2, 88, 'reguler', 18000.00, NULL, NULL, 0.00, '2026-04-13 21:38:45', '2026-04-13 21:38:45'),
(89, 2, 89, 'reguler', 25000.00, NULL, NULL, 0.00, '2026-04-13 21:39:05', '2026-04-13 21:39:05'),
(90, 2, 90, 'reguler', 11000.00, NULL, NULL, 0.00, '2026-04-13 21:39:24', '2026-04-13 21:39:24'),
(91, 2, 91, 'reguler', 10000.00, NULL, NULL, 0.00, '2026-04-13 21:39:50', '2026-04-13 21:40:37'),
(92, 2, 92, 'reguler', 21000.00, NULL, NULL, 0.00, '2026-04-13 21:40:10', '2026-04-13 21:40:10'),
(93, 2, 93, 'reguler', 65000.00, NULL, NULL, 0.00, '2026-04-13 21:40:53', '2026-04-13 21:40:53'),
(94, 2, 94, 'reguler', 50000.00, NULL, NULL, 0.00, '2026-04-13 21:41:10', '2026-04-13 21:41:10'),
(95, 2, 95, 'reguler', 5000.00, NULL, NULL, 0.00, '2026-04-13 21:41:32', '2026-04-13 21:41:32'),
(96, 2, 96, 'reguler', 5000.00, NULL, NULL, 0.00, '2026-04-13 21:42:05', '2026-04-13 21:42:05'),
(97, 2, 97, 'reguler', 5000.00, NULL, NULL, 0.00, '2026-04-13 21:42:37', '2026-04-13 21:42:37'),
(98, 2, 98, 'reguler', 3000.00, NULL, NULL, 0.00, '2026-04-13 21:42:53', '2026-04-13 21:42:53'),
(99, 2, 99, 'reguler', 5000.00, NULL, NULL, 0.00, '2026-04-13 21:43:19', '2026-04-13 21:43:19'),
(100, 2, 100, 'reguler', 4000.00, NULL, NULL, 0.00, '2026-04-13 21:43:33', '2026-04-13 21:43:33'),
(101, 2, 101, 'reguler', 27000.00, NULL, NULL, 0.00, '2026-04-13 21:43:53', '2026-04-13 21:43:53'),
(102, 2, 102, 'reguler', 27000.00, NULL, NULL, 0.00, '2026-04-13 21:44:14', '2026-04-13 21:44:14'),
(103, 2, 103, 'reguler', 16000.00, NULL, NULL, 0.00, '2026-04-13 21:44:34', '2026-04-13 21:44:34'),
(104, 2, 104, 'reguler', 19000.00, NULL, NULL, 0.00, '2026-04-13 21:44:55', '2026-04-13 21:44:55'),
(105, 2, 105, 'reguler', 25000.00, NULL, NULL, 0.00, '2026-04-13 21:45:13', '2026-04-13 21:45:13'),
(106, 2, 106, 'reguler', 21000.00, NULL, NULL, 0.00, '2026-04-13 21:45:37', '2026-04-13 21:45:37'),
(107, 2, 107, 'reguler', 16000.00, NULL, NULL, 0.00, '2026-04-13 21:45:56', '2026-04-13 21:45:56'),
(108, 2, 108, 'reguler', 28000.00, NULL, NULL, 0.00, '2026-04-13 21:46:13', '2026-04-13 21:46:13'),
(109, 2, 109, 'reguler', 16000.00, NULL, NULL, 0.00, '2026-04-13 21:46:41', '2026-04-13 21:46:41'),
(110, 2, 110, 'reguler', 16000.00, NULL, NULL, 0.00, '2026-04-13 21:47:05', '2026-04-13 21:47:05'),
(111, 2, 111, 'reguler', 25000.00, NULL, NULL, 0.00, '2026-04-13 21:47:23', '2026-04-13 21:47:23'),
(112, 2, 112, 'reguler', 16000.00, NULL, NULL, 0.00, '2026-04-13 21:47:47', '2026-04-13 21:47:47'),
(113, 2, 113, 'reguler', 16000.00, NULL, NULL, 0.00, '2026-04-13 21:48:07', '2026-04-13 21:48:07'),
(114, 2, 114, 'reguler', 16000.00, NULL, NULL, 0.00, '2026-04-13 21:48:27', '2026-04-13 21:48:27'),
(115, 2, 115, 'reguler', 21000.00, NULL, NULL, 0.00, '2026-04-13 21:48:41', '2026-04-13 21:48:41'),
(116, 2, 116, 'regular', 17000.00, NULL, NULL, 0.00, '2026-04-13 21:49:00', '2026-04-13 21:49:00'),
(117, 2, 117, 'reguler', 16000.00, NULL, NULL, 0.00, '2026-04-13 21:49:18', '2026-04-13 21:49:18'),
(118, 2, 118, 'reguler', 16000.00, NULL, NULL, 0.00, '2026-04-13 21:49:41', '2026-04-13 21:49:41'),
(119, 2, 119, 'reguler', 16000.00, NULL, NULL, 0.00, '2026-04-13 21:50:01', '2026-04-13 21:50:01'),
(120, 2, 120, 'reguler', 40000.00, NULL, NULL, 0.00, '2026-04-13 21:50:16', '2026-04-13 21:50:16'),
(121, 4, 121, 'regular', 2000.00, NULL, NULL, 0.00, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(122, 4, 122, 'reguler', 3000.00, NULL, NULL, 0.00, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(123, 4, 123, 'reguler', 29000.00, NULL, NULL, 0.00, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(124, 4, 124, 'reguler', 29000.00, NULL, NULL, 0.00, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(125, 4, 125, 'reguler', 25000.00, NULL, NULL, 0.00, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(126, 4, 126, 'reguler', 5000.00, NULL, NULL, 0.00, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(127, 4, 127, 'reguler', 40000.00, NULL, NULL, 0.00, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(128, 4, 128, 'reguler', 42000.00, NULL, NULL, 0.00, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(129, 4, 129, 'reguler', 16000.00, NULL, NULL, 0.00, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(130, 4, 130, 'reguler', 28000.00, NULL, NULL, 0.00, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(131, 4, 131, 'reguler', 20000.00, NULL, NULL, 0.00, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(132, 4, 132, 'reguler', 3000.00, NULL, NULL, 0.00, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(133, 4, 133, 'reguler', 23000.00, NULL, NULL, 0.00, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(134, 4, 134, 'reguler', 17000.00, NULL, NULL, 0.00, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(135, 4, 135, 'reguler', 15000.00, NULL, NULL, 0.00, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(136, 4, 136, 'reguler', 18000.00, NULL, NULL, 0.00, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(137, 4, 137, 'reguler', 26000.00, NULL, NULL, 0.00, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(138, 4, 138, 'reguler', 12000.00, NULL, NULL, 0.00, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(139, 4, 139, 'reguler', 19000.00, NULL, NULL, 0.00, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(140, 4, 140, 'reguler', 27000.00, NULL, NULL, 0.00, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(141, 4, 141, 'reguler', 21000.00, NULL, NULL, 0.00, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(142, 4, 142, 'reguler', 22000.00, NULL, NULL, 0.00, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(143, 4, 143, 'reguler', 25000.00, NULL, NULL, 0.00, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(144, 4, 144, 'reguler', 25000.00, NULL, NULL, 0.00, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(145, 4, 145, 'reguler', 22000.00, NULL, NULL, 0.00, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(146, 4, 146, 'reguler', 25000.00, NULL, NULL, 0.00, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(147, 4, 147, 'reguler', 18000.00, NULL, NULL, 0.00, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(148, 4, 148, 'reguler', 8000.00, NULL, NULL, 0.00, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(149, 4, 149, 'reguler', 5000.00, NULL, NULL, 0.00, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(150, 4, 150, 'reguler', 27000.00, NULL, NULL, 0.00, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(151, 4, 151, 'reguler', 15000.00, NULL, NULL, 0.00, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(152, 4, 152, 'reguler', 95000.00, NULL, NULL, 0.00, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(153, 4, 153, 'reguler', 105000.00, NULL, NULL, 0.00, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(154, 4, 154, 'reguler', 98000.00, NULL, NULL, 0.00, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(155, 4, 155, 'reguler', 67000.00, NULL, NULL, 0.00, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(156, 4, 156, 'reguler', 14000.00, NULL, NULL, 0.00, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(157, 4, 157, 'reguler', 27000.00, NULL, NULL, 0.00, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(158, 4, 158, 'reguler', 16000.00, NULL, NULL, 0.00, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(159, 4, 159, 'reguler', 16000.00, NULL, NULL, 0.00, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(160, 4, 160, 'reguler', 300000.00, NULL, NULL, 0.00, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(161, 4, 161, 'reguler', 16000.00, NULL, NULL, 0.00, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(162, 4, 162, 'reguler', 11000.00, NULL, NULL, 0.00, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(163, 4, 163, 'reguler', 21000.00, NULL, NULL, 0.00, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(164, 4, 164, 'reguler', 16000.00, NULL, NULL, 0.00, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(165, 4, 165, 'reguler', 11000.00, NULL, NULL, 0.00, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(166, 4, 166, 'reguler', 21000.00, NULL, NULL, 0.00, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(167, 4, 167, 'regluer', 21000.00, NULL, NULL, 0.00, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(168, 4, 168, 'reguler', 20000.00, NULL, NULL, 0.00, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(169, 4, 169, 'reguler', 23000.00, NULL, NULL, 0.00, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(170, 4, 170, 'reguler', 21000.00, NULL, NULL, 0.00, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(171, 4, 171, 'reguler', 21000.00, NULL, NULL, 0.00, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(172, 4, 172, 'reguler', 21000.00, NULL, NULL, 0.00, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(173, 4, 173, 'rguler', 18000.00, NULL, NULL, 0.00, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(174, 4, 174, 'reguler', 16000.00, NULL, NULL, 0.00, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(175, 4, 175, 'reguler', 25000.00, NULL, NULL, 0.00, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(176, 4, 176, 'reguler', 32000.00, NULL, NULL, 0.00, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(177, 4, 177, 'reguler', 20000.00, NULL, NULL, 0.00, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(178, 4, 178, 'reguler', 17000.00, NULL, NULL, 0.00, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(179, 4, 179, 'Reguler', 25000.00, NULL, NULL, 0.00, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(180, 4, 180, 'reguler', 8000.00, NULL, NULL, 0.00, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(181, 4, 181, 'reguler', 10000.00, NULL, NULL, 0.00, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(182, 4, 182, 'reguler', 8000.00, NULL, NULL, 0.00, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(183, 4, 183, 'reguler', 18000.00, NULL, NULL, 0.00, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(184, 4, 184, 'reguler', 16000.00, NULL, NULL, 0.00, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(185, 4, 185, 'reguler', 6000.00, NULL, NULL, 0.00, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(186, 4, 186, 'reguler', 10000.00, NULL, NULL, 0.00, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(187, 4, 187, 'reguler', 8000.00, NULL, NULL, 0.00, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(188, 4, 188, 'reguler', 8000.00, NULL, NULL, 0.00, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(189, 4, 189, 'reguler', 6000.00, NULL, NULL, 0.00, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(190, 4, 190, 'reguler', 60000.00, NULL, NULL, 0.00, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(191, 4, 191, 'reguler', 45000.00, NULL, NULL, 0.00, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(192, 4, 192, 'reguler', 75000.00, NULL, NULL, 0.00, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(193, 4, 193, 'reguler', 16000.00, NULL, NULL, 0.00, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(194, 4, 194, 'reguler', 16000.00, NULL, NULL, 0.00, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(195, 4, 195, 'reguler', 16000.00, NULL, NULL, 0.00, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(196, 4, 196, 'reguler', 19000.00, NULL, NULL, 0.00, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(197, 4, 197, 'reguler', 40000.00, NULL, NULL, 0.00, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(198, 4, 198, 'reguler', 18000.00, NULL, NULL, 0.00, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(199, 4, 199, 'regular', 7000.00, NULL, NULL, 0.00, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(200, 4, 200, 'reguler', 16000.00, NULL, NULL, 0.00, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(201, 4, 201, 'reguler', 6000.00, NULL, NULL, 0.00, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(202, 4, 202, 'reguler', 30000.00, NULL, NULL, 0.00, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(203, 4, 203, 'reguler ', 16000.00, NULL, NULL, 0.00, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(204, 4, 204, 'reguler', 25000.00, NULL, NULL, 0.00, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(205, 4, 205, 'reguler', 8000.00, NULL, NULL, 0.00, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(206, 4, 206, 'sreguler', 19000.00, NULL, NULL, 0.00, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(207, 4, 207, 'reguler', 11000.00, NULL, NULL, 0.00, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(208, 4, 208, 'reguler', 18000.00, NULL, NULL, 0.00, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(209, 4, 209, 'reguler', 25000.00, NULL, NULL, 0.00, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(210, 4, 210, 'reguler', 11000.00, NULL, NULL, 0.00, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(211, 4, 211, 'reguler', 10000.00, NULL, NULL, 0.00, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(212, 4, 212, 'reguler', 21000.00, NULL, NULL, 0.00, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(213, 4, 213, 'reguler', 65000.00, NULL, NULL, 0.00, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(214, 4, 214, 'reguler', 50000.00, NULL, NULL, 0.00, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(215, 4, 215, 'reguler', 5000.00, NULL, NULL, 0.00, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(216, 4, 216, 'reguler', 5000.00, NULL, NULL, 0.00, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(217, 4, 217, 'reguler', 5000.00, NULL, NULL, 0.00, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(218, 4, 218, 'reguler', 3000.00, NULL, NULL, 0.00, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(219, 4, 219, 'reguler', 5000.00, NULL, NULL, 0.00, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(220, 4, 220, 'reguler', 4000.00, NULL, NULL, 0.00, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(221, 4, 221, 'reguler', 27000.00, NULL, NULL, 0.00, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(222, 4, 222, 'reguler', 27000.00, NULL, NULL, 0.00, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(223, 4, 223, 'reguler', 16000.00, NULL, NULL, 0.00, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(224, 4, 224, 'reguler', 19000.00, NULL, NULL, 0.00, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(225, 4, 225, 'reguler', 25000.00, NULL, NULL, 0.00, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(226, 4, 226, 'reguler', 21000.00, NULL, NULL, 0.00, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(227, 4, 227, 'reguler', 16000.00, NULL, NULL, 0.00, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(228, 4, 228, 'reguler', 28000.00, NULL, NULL, 0.00, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(229, 4, 229, 'reguler', 16000.00, NULL, NULL, 0.00, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(230, 4, 230, 'reguler', 16000.00, NULL, NULL, 0.00, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(231, 4, 231, 'reguler', 25000.00, NULL, NULL, 0.00, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(232, 4, 232, 'reguler', 16000.00, NULL, NULL, 0.00, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(233, 4, 233, 'reguler', 16000.00, NULL, NULL, 0.00, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(234, 4, 234, 'reguler', 16000.00, NULL, NULL, 0.00, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(235, 4, 235, 'reguler', 21000.00, NULL, NULL, 0.00, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(236, 4, 236, 'regular', 17000.00, NULL, NULL, 0.00, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(237, 4, 237, 'reguler', 16000.00, NULL, NULL, 0.00, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(238, 4, 238, 'reguler', 16000.00, NULL, NULL, 0.00, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(239, 4, 239, 'reguler', 16000.00, NULL, NULL, 0.00, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(240, 4, 240, 'reguler', 40000.00, NULL, NULL, 0.00, '2026-04-13 21:53:26', '2026-04-13 21:53:26'),
(241, 5, 241, 'regular', 2000.00, NULL, NULL, 0.00, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(242, 5, 242, 'reguler', 3000.00, NULL, NULL, 0.00, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(243, 5, 243, 'reguler', 29000.00, NULL, NULL, 0.00, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(244, 5, 244, 'reguler', 29000.00, NULL, NULL, 0.00, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(245, 5, 245, 'reguler', 25000.00, NULL, NULL, 0.00, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(246, 5, 246, 'reguler', 5000.00, NULL, NULL, 0.00, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(247, 5, 247, 'reguler', 40000.00, NULL, NULL, 0.00, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(248, 5, 248, 'reguler', 42000.00, NULL, NULL, 0.00, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(249, 5, 249, 'reguler', 16000.00, NULL, NULL, 0.00, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(250, 5, 250, 'reguler', 28000.00, NULL, NULL, 0.00, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(251, 5, 251, 'reguler', 20000.00, NULL, NULL, 0.00, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(252, 5, 252, 'reguler', 3000.00, NULL, NULL, 0.00, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(253, 5, 253, 'reguler', 23000.00, NULL, NULL, 0.00, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(254, 5, 254, 'reguler', 17000.00, NULL, NULL, 0.00, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(255, 5, 255, 'reguler', 15000.00, NULL, NULL, 0.00, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(256, 5, 256, 'reguler', 18000.00, NULL, NULL, 0.00, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(257, 5, 257, 'reguler', 26000.00, NULL, NULL, 0.00, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(258, 5, 258, 'reguler', 12000.00, NULL, NULL, 0.00, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(259, 5, 259, 'reguler', 19000.00, NULL, NULL, 0.00, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(260, 5, 260, 'reguler', 27000.00, NULL, NULL, 0.00, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(261, 5, 261, 'reguler', 21000.00, NULL, NULL, 0.00, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(262, 5, 262, 'reguler', 22000.00, NULL, NULL, 0.00, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(263, 5, 263, 'reguler', 25000.00, NULL, NULL, 0.00, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(264, 5, 264, 'reguler', 25000.00, NULL, NULL, 0.00, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(265, 5, 265, 'reguler', 22000.00, NULL, NULL, 0.00, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(266, 5, 266, 'reguler', 25000.00, NULL, NULL, 0.00, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(267, 5, 267, 'reguler', 18000.00, NULL, NULL, 0.00, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(268, 5, 268, 'reguler', 8000.00, NULL, NULL, 0.00, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(269, 5, 269, 'reguler', 5000.00, NULL, NULL, 0.00, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(270, 5, 270, 'reguler', 27000.00, NULL, NULL, 0.00, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(271, 5, 271, 'reguler', 15000.00, NULL, NULL, 0.00, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(272, 5, 272, 'reguler', 95000.00, NULL, NULL, 0.00, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(273, 5, 273, 'reguler', 105000.00, NULL, NULL, 0.00, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(274, 5, 274, 'reguler', 98000.00, NULL, NULL, 0.00, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(275, 5, 275, 'reguler', 67000.00, NULL, NULL, 0.00, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(276, 5, 276, 'reguler', 14000.00, NULL, NULL, 0.00, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(277, 5, 277, 'reguler', 27000.00, NULL, NULL, 0.00, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(278, 5, 278, 'reguler', 16000.00, NULL, NULL, 0.00, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(279, 5, 279, 'reguler', 16000.00, NULL, NULL, 0.00, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(280, 5, 280, 'reguler', 300000.00, NULL, NULL, 0.00, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(281, 5, 281, 'reguler', 16000.00, NULL, NULL, 0.00, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(282, 5, 282, 'reguler', 11000.00, NULL, NULL, 0.00, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(283, 5, 283, 'reguler', 21000.00, NULL, NULL, 0.00, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(284, 5, 284, 'reguler', 16000.00, NULL, NULL, 0.00, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(285, 5, 285, 'reguler', 11000.00, NULL, NULL, 0.00, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(286, 5, 286, 'reguler', 21000.00, NULL, NULL, 0.00, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(287, 5, 287, 'regluer', 21000.00, NULL, NULL, 0.00, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(288, 5, 288, 'reguler', 20000.00, NULL, NULL, 0.00, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(289, 5, 289, 'reguler', 23000.00, NULL, NULL, 0.00, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(290, 5, 290, 'reguler', 21000.00, NULL, NULL, 0.00, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(291, 5, 291, 'reguler', 21000.00, NULL, NULL, 0.00, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(292, 5, 292, 'reguler', 21000.00, NULL, NULL, 0.00, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(293, 5, 293, 'rguler', 18000.00, NULL, NULL, 0.00, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(294, 5, 294, 'reguler', 16000.00, NULL, NULL, 0.00, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(295, 5, 295, 'reguler', 25000.00, NULL, NULL, 0.00, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(296, 5, 296, 'reguler', 32000.00, NULL, NULL, 0.00, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(297, 5, 297, 'reguler', 20000.00, NULL, NULL, 0.00, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(298, 5, 298, 'reguler', 17000.00, NULL, NULL, 0.00, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(299, 5, 299, 'Reguler', 25000.00, NULL, NULL, 0.00, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(300, 5, 300, 'reguler', 8000.00, NULL, NULL, 0.00, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(301, 5, 301, 'reguler', 10000.00, NULL, NULL, 0.00, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(302, 5, 302, 'reguler', 8000.00, NULL, NULL, 0.00, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(303, 5, 303, 'reguler', 18000.00, NULL, NULL, 0.00, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(304, 5, 304, 'reguler', 16000.00, NULL, NULL, 0.00, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(305, 5, 305, 'reguler', 6000.00, NULL, NULL, 0.00, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(306, 5, 306, 'reguler', 10000.00, NULL, NULL, 0.00, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(307, 5, 307, 'reguler', 8000.00, NULL, NULL, 0.00, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(308, 5, 308, 'reguler', 8000.00, NULL, NULL, 0.00, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(309, 5, 309, 'reguler', 6000.00, NULL, NULL, 0.00, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(310, 5, 310, 'reguler', 60000.00, NULL, NULL, 0.00, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(311, 5, 311, 'reguler', 45000.00, NULL, NULL, 0.00, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(312, 5, 312, 'reguler', 75000.00, NULL, NULL, 0.00, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(313, 5, 313, 'reguler', 16000.00, NULL, NULL, 0.00, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(314, 5, 314, 'reguler', 16000.00, NULL, NULL, 0.00, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(315, 5, 315, 'reguler', 16000.00, NULL, NULL, 0.00, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(316, 5, 316, 'reguler', 19000.00, NULL, NULL, 0.00, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(317, 5, 317, 'reguler', 40000.00, NULL, NULL, 0.00, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(318, 5, 318, 'reguler', 18000.00, NULL, NULL, 0.00, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(319, 5, 319, 'regular', 7000.00, NULL, NULL, 0.00, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(320, 5, 320, 'reguler', 16000.00, NULL, NULL, 0.00, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(321, 5, 321, 'reguler', 6000.00, NULL, NULL, 0.00, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(322, 5, 322, 'reguler', 30000.00, NULL, NULL, 0.00, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(323, 5, 323, 'reguler ', 16000.00, NULL, NULL, 0.00, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(324, 5, 324, 'reguler', 25000.00, NULL, NULL, 0.00, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(325, 5, 325, 'reguler', 8000.00, NULL, NULL, 0.00, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(326, 5, 326, 'sreguler', 19000.00, NULL, NULL, 0.00, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(327, 5, 327, 'reguler', 11000.00, NULL, NULL, 0.00, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(328, 5, 328, 'reguler', 18000.00, NULL, NULL, 0.00, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(329, 5, 329, 'reguler', 25000.00, NULL, NULL, 0.00, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(330, 5, 330, 'reguler', 11000.00, NULL, NULL, 0.00, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(331, 5, 331, 'reguler', 10000.00, NULL, NULL, 0.00, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(332, 5, 332, 'reguler', 21000.00, NULL, NULL, 0.00, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(333, 5, 333, 'reguler', 65000.00, NULL, NULL, 0.00, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(334, 5, 334, 'reguler', 50000.00, NULL, NULL, 0.00, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(335, 5, 335, 'reguler', 5000.00, NULL, NULL, 0.00, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(336, 5, 336, 'reguler', 5000.00, NULL, NULL, 0.00, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(337, 5, 337, 'reguler', 5000.00, NULL, NULL, 0.00, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(338, 5, 338, 'reguler', 3000.00, NULL, NULL, 0.00, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(339, 5, 339, 'reguler', 5000.00, NULL, NULL, 0.00, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(340, 5, 340, 'reguler', 4000.00, NULL, NULL, 0.00, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(341, 5, 341, 'reguler', 27000.00, NULL, NULL, 0.00, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(342, 5, 342, 'reguler', 27000.00, NULL, NULL, 0.00, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(343, 5, 343, 'reguler', 16000.00, NULL, NULL, 0.00, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(344, 5, 344, 'reguler', 19000.00, NULL, NULL, 0.00, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(345, 5, 345, 'reguler', 25000.00, NULL, NULL, 0.00, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(346, 5, 346, 'reguler', 21000.00, NULL, NULL, 0.00, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(347, 5, 347, 'reguler', 16000.00, NULL, NULL, 0.00, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(348, 5, 348, 'reguler', 28000.00, NULL, NULL, 0.00, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(349, 5, 349, 'reguler', 16000.00, NULL, NULL, 0.00, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(350, 5, 350, 'reguler', 16000.00, NULL, NULL, 0.00, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(351, 5, 351, 'reguler', 25000.00, NULL, NULL, 0.00, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(352, 5, 352, 'reguler', 16000.00, NULL, NULL, 0.00, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(353, 5, 353, 'reguler', 16000.00, NULL, NULL, 0.00, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(354, 5, 354, 'reguler', 16000.00, NULL, NULL, 0.00, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(355, 5, 355, 'reguler', 21000.00, NULL, NULL, 0.00, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(356, 5, 356, 'regular', 17000.00, NULL, NULL, 0.00, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(357, 5, 357, 'reguler', 16000.00, NULL, NULL, 0.00, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(358, 5, 358, 'reguler', 16000.00, NULL, NULL, 0.00, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(359, 5, 359, 'reguler', 16000.00, NULL, NULL, 0.00, '2026-04-13 21:56:00', '2026-04-13 21:56:00'),
(360, 5, 360, 'reguler', 40000.00, NULL, NULL, 0.00, '2026-04-13 21:56:00', '2026-04-13 21:56:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `product_variant_recipes`
--

CREATE TABLE `product_variant_recipes` (
  `id` bigint UNSIGNED NOT NULL,
  `cabang_id` bigint UNSIGNED NOT NULL,
  `product_variant_id` bigint UNSIGNED NOT NULL,
  `ingredient_id` bigint UNSIGNED NOT NULL,
  `quantity` decimal(12,3) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `purchases`
--

CREATE TABLE `purchases` (
  `id` bigint UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `supplier_id` bigint UNSIGNED DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'draft',
  `purchased_at` date NOT NULL,
  `received_at` timestamp NULL DEFAULT NULL,
  `total_cost` decimal(14,2) NOT NULL DEFAULT '0.00',
  `note` text COLLATE utf8mb4_unicode_ci,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `purchase_items`
--

CREATE TABLE `purchase_items` (
  `id` bigint UNSIGNED NOT NULL,
  `purchase_id` bigint UNSIGNED NOT NULL,
  `ingredient_id` bigint UNSIGNED NOT NULL,
  `input_quantity` decimal(12,3) NOT NULL,
  `input_unit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity_base` decimal(12,3) NOT NULL,
  `input_unit_cost` decimal(12,2) DEFAULT NULL,
  `unit_cost_base` decimal(12,2) NOT NULL DEFAULT '0.00',
  `subtotal_cost` decimal(14,2) NOT NULL DEFAULT '0.00',
  `note` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'owner', 'web', '2026-04-12 16:23:23', '2026-04-12 16:23:23'),
(2, 'admin', 'web', '2026-04-12 16:23:23', '2026-04-12 16:23:23'),
(3, 'manager', 'web', '2026-04-12 16:23:23', '2026-04-12 16:23:23'),
(4, 'cashier', 'web', '2026-04-12 16:23:23', '2026-04-12 16:23:23'),
(5, 'inventory', 'web', '2026-04-12 16:23:23', '2026-04-12 16:23:23'),
(6, 'accountant', 'web', '2026-04-12 16:23:23', '2026-04-12 16:23:23'),
(7, 'waiter', 'web', '2026-04-12 16:23:23', '2026-04-12 16:23:23');

-- --------------------------------------------------------

--
-- Struktur dari tabel `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(30, 1),
(31, 1),
(32, 1),
(33, 1),
(34, 1),
(35, 1),
(36, 1),
(37, 1),
(38, 1),
(39, 1),
(40, 1),
(41, 1),
(42, 1),
(43, 1),
(44, 1),
(45, 1),
(46, 1),
(47, 1),
(48, 1),
(49, 1),
(50, 1),
(51, 1),
(52, 1),
(53, 1),
(54, 1),
(55, 1),
(56, 1),
(57, 1),
(58, 1),
(59, 1),
(60, 1),
(61, 1),
(62, 1),
(63, 1),
(64, 1),
(65, 1),
(66, 1),
(67, 1),
(68, 1),
(69, 1),
(70, 1),
(71, 1),
(72, 1),
(73, 1),
(74, 1),
(75, 1),
(76, 1),
(77, 1),
(78, 1),
(79, 1),
(80, 1),
(81, 1),
(1, 2),
(2, 2),
(3, 2),
(4, 2),
(5, 2),
(6, 2),
(7, 2),
(8, 2),
(9, 2),
(10, 2),
(11, 2),
(12, 2),
(13, 2),
(14, 2),
(15, 2),
(16, 2),
(17, 2),
(18, 2),
(19, 2),
(20, 2),
(21, 2),
(22, 2),
(23, 2),
(24, 2),
(25, 2),
(26, 2),
(27, 2),
(28, 2),
(29, 2),
(30, 2),
(31, 2),
(32, 2),
(33, 2),
(34, 2),
(35, 2),
(36, 2),
(37, 2),
(38, 2),
(39, 2),
(40, 2),
(41, 2),
(42, 2),
(43, 2),
(44, 2),
(45, 2),
(46, 2),
(47, 2),
(48, 2),
(49, 2),
(50, 2),
(51, 2),
(52, 2),
(53, 2),
(54, 2),
(55, 2),
(56, 2),
(57, 2),
(58, 2),
(59, 2),
(60, 2),
(61, 2),
(62, 2),
(63, 2),
(64, 2),
(65, 2),
(66, 2),
(67, 2),
(68, 2),
(69, 2),
(70, 2),
(71, 2),
(72, 2),
(73, 2),
(74, 2),
(75, 2),
(76, 2),
(77, 2),
(78, 2),
(79, 2),
(80, 2),
(81, 2),
(1, 3),
(3, 3),
(4, 3),
(5, 3),
(6, 3),
(8, 3),
(9, 3),
(10, 3),
(12, 3),
(13, 3),
(14, 3),
(15, 3),
(16, 3),
(17, 3),
(18, 3),
(19, 3),
(20, 3),
(21, 3),
(22, 3),
(23, 3),
(24, 3),
(25, 3),
(26, 3),
(27, 3),
(28, 3),
(29, 3),
(30, 3),
(31, 3),
(32, 3),
(33, 3),
(34, 3),
(35, 3),
(36, 3),
(37, 3),
(38, 3),
(39, 3),
(40, 3),
(41, 3),
(42, 3),
(43, 3),
(44, 3),
(45, 3),
(46, 3),
(47, 3),
(48, 3),
(49, 3),
(50, 3),
(51, 3),
(52, 3),
(53, 3),
(54, 3),
(55, 3),
(56, 3),
(57, 3),
(58, 3),
(68, 3),
(69, 3),
(1, 4),
(2, 4),
(3, 4),
(4, 4),
(8, 4),
(12, 4),
(13, 4),
(14, 4),
(15, 4),
(20, 4),
(21, 4),
(24, 4),
(33, 4),
(68, 4),
(69, 4),
(1, 5),
(3, 5),
(4, 5),
(8, 5),
(34, 5),
(35, 5),
(36, 5),
(37, 5),
(38, 5),
(39, 5),
(40, 5),
(41, 5),
(42, 5),
(43, 5),
(44, 5),
(45, 5),
(46, 5),
(47, 5),
(48, 5),
(49, 5),
(50, 5),
(51, 5),
(52, 5),
(53, 5),
(54, 5),
(55, 5),
(56, 5),
(57, 5),
(1, 6),
(3, 6),
(12, 6),
(13, 6),
(14, 6),
(15, 6),
(27, 6),
(28, 6),
(29, 6),
(30, 6),
(31, 6),
(57, 6),
(1, 7),
(2, 7),
(3, 7),
(4, 7),
(8, 7);

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
('09zVKMFMCnJKqWfcVvxWBRF4q4ithN861PQtS1My', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiaWt4dzRTSnFQSEtObExXckk0Z1pNR21CNWxxczZtV0J1dVU2TWhuUiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9tYW5pZmVzdC53ZWJtYW5pZmVzdCI7czo1OiJyb3V0ZSI7czoxNDoiYWRtaW4ubWFuaWZlc3QiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1776249529),
('1zcWzwg1rzMj5Ewi9jxg3aMbzXN5By99LnJ8cZd0', NULL, '127.0.0.1', 'Mozilla/5.0 (iPad; CPU OS 18_5 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.5 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMDZnajd2SDliaGhQaEZzOEFkMFhrRVJ1dTA0WWdpbTJlNXI3dzFySCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9tYW5pZmVzdC53ZWJtYW5pZmVzdCI7czo1OiJyb3V0ZSI7czoxNDoiYWRtaW4ubWFuaWZlc3QiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1776251049),
('2dLhDroEohM5lagkY5AjMq1KKt46sLz2Ihp4ZM9v', NULL, '127.0.0.1', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_5 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.5 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTkg3T3VkbFhDdTRETmFyMFhGNFhaUTdoN2VFcTNpeFM2QTZHVTZTeiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9tYW5pZmVzdC53ZWJtYW5pZmVzdCI7czo1OiJyb3V0ZSI7czoxNDoiYWRtaW4ubWFuaWZlc3QiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1776250612),
('3lKfz948WJ17o2SG53z0OMoUaeWYVENmlTpT8zaH', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiakhZQ2RkVHM3Ykk1Y1k1czRkbnlpalZmemRYTzNtbk9qdFo3bFhETyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9tYW5pZmVzdC53ZWJtYW5pZmVzdCI7czo1OiJyb3V0ZSI7czoxNDoiYWRtaW4ubWFuaWZlc3QiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1776249504),
('3UCG43iLfNAu9fymEQO2pAM9gB9XBwBkprA9HZjJ', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRzVWVXpMZEtEc0hCMU1RSFFaRXBCVjl0NkdlZk4yU1JwaWFtY0k3eSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9tYW5pZmVzdC53ZWJtYW5pZmVzdCI7czo1OiJyb3V0ZSI7czoxNDoiYWRtaW4ubWFuaWZlc3QiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1776249835),
('4fzzcxoP4nm9oF3rtZdcAZbN6ByHVeWjPMqjvThk', NULL, '127.0.0.1', 'Mozilla/5.0 (iPad; CPU OS 18_5 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.5 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZ3hvbEVpYWoyTTE3S1FuaGZ3QTJIWnZHVG5lbHpSYkZrakx1WnI4RCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9tYW5pZmVzdC53ZWJtYW5pZmVzdCI7czo1OiJyb3V0ZSI7czoxNDoiYWRtaW4ubWFuaWZlc3QiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1776250994),
('5dG8C7lul8RLCr26XEGy2nAX3bt7IHULeUMdbDUX', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibzM2TnhraWw0N3JDOHFkVll1QklJRVp3RnRaQ01yNkF1T2J3ZjdvciI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9tYW5pZmVzdC53ZWJtYW5pZmVzdCI7czo1OiJyb3V0ZSI7czoxNDoiYWRtaW4ubWFuaWZlc3QiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1776249550),
('7ejbcDeW2O1EWXQw6wX8aPC3t9LHIbaRyFZXqvZd', NULL, '127.0.0.1', 'Mozilla/5.0 (iPad; CPU OS 18_5 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.5 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYURqR2NmMEw1VVlpcXgwVVhDUk5nQ3MzZUp2bHE2ZDRnR2pGd3ViMSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9tYW5pZmVzdC53ZWJtYW5pZmVzdCI7czo1OiJyb3V0ZSI7czoxNDoiYWRtaW4ubWFuaWZlc3QiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1776250664),
('7sLoiuCKQZaJD3Rc2PKMz6PjjiZMu1fajbhSicP9', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiT1o2c2Q4cThQVXdkd0E3eEJ6emFSMjJVdzdtZ0tZY0g1cUNZWHpyeiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9tYW5pZmVzdC53ZWJtYW5pZmVzdCI7czo1OiJyb3V0ZSI7czoxNDoiYWRtaW4ubWFuaWZlc3QiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1776249495),
('8mYithdLRtHiyrdBlBCTlsCiZAraoaWv82oS2Bc8', NULL, '127.0.0.1', 'Mozilla/5.0 (iPad; CPU OS 18_5 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.5 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMzRWVjBWS2g2SlVnSnY3OHl5QW93YkhQNWNOTjlxbFFtNVRJRXJLOSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9tYW5pZmVzdC53ZWJtYW5pZmVzdCI7czo1OiJyb3V0ZSI7czoxNDoiYWRtaW4ubWFuaWZlc3QiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1776251021),
('A3HD0SViniGm56UwRky0huGcVlYBhjijPhKjT4Cx', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTnM0QXk1SHhMemlYRHZySVkya0hDSjRWQ283bDdFakFqUWFPTEJPMyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9tYW5pZmVzdC53ZWJtYW5pZmVzdCI7czo1OiJyb3V0ZSI7czoxNDoiYWRtaW4ubWFuaWZlc3QiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1776249516),
('aNlIz1bgi2Ji73J4WKwIiuPpcNf3mX4LcahIxvC1', NULL, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.5 Safari/605.1.15', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiOG1udDNpRFNtUHBZa0h2clZNaUxXbzcwWnhKWVZJVDR5Q3Y4MlJNSyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9tYW5pZmVzdC53ZWJtYW5pZmVzdCI7czo1OiJyb3V0ZSI7czoxNDoiYWRtaW4ubWFuaWZlc3QiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1776251223),
('BwXCdAO7IeLg9eNlp2df98rj85z6PndgYxzbIQcT', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUTYyRjBzUUN1bTNweXJFOEg2RWY1bVhERG1WYktZNkJmckdPaWxISyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9tYW5pZmVzdC53ZWJtYW5pZmVzdCI7czo1OiJyb3V0ZSI7czoxNDoiYWRtaW4ubWFuaWZlc3QiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1776249600),
('CJW6iL6FUWpiDT17kaRdKp1nMv99TmkbQ88ydLWL', NULL, '127.0.0.1', 'Mozilla/5.0 (iPad; CPU OS 18_5 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.5 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidExtNkdHMU9UcGFqWEpuTXNHSTFaT2NrWmVZbFBzcUp6VHU0Y1VpYyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9tYW5pZmVzdC53ZWJtYW5pZmVzdCI7czo1OiJyb3V0ZSI7czoxNDoiYWRtaW4ubWFuaWZlc3QiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1776250948),
('Ck8deFyWTba8ggbxzihUqFESBseN6txvm9EQn47z', NULL, '127.0.0.1', 'Mozilla/5.0 (iPad; CPU OS 18_5 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.5 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMENIMmVqWDRjTmxmaGY0YXJ3U2xsckdLUldHZHh2OXFKR0JSVHVCQyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9tYW5pZmVzdC53ZWJtYW5pZmVzdCI7czo1OiJyb3V0ZSI7czoxNDoiYWRtaW4ubWFuaWZlc3QiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1776250640),
('Cl8OmDiHBIBXecR5v6wLpHYvVlxMyGBHEZoM3AY2', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRnVyako4anFBVU9ZN0hmM29TUExMbVdzeDFZOWpJSUpmdXdvM25mQyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9tYW5pZmVzdC53ZWJtYW5pZmVzdCI7czo1OiJyb3V0ZSI7czoxNDoiYWRtaW4ubWFuaWZlc3QiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1776250680),
('d4IrwlMnFZxQfT6Kpryr4gfvLEOUgaO14NoRZBc7', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQkJOY0JteVBiTEc3MXhZWUF3Z3pmV1ppMG9Va1ZWUDVlaHZBR3NyMCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9tYW5pZmVzdC53ZWJtYW5pZmVzdCI7czo1OiJyb3V0ZSI7czoxNDoiYWRtaW4ubWFuaWZlc3QiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1776249642),
('D8lGQT07rKR7hzDzTQhwbaUv4nke8hejHaZugDN7', NULL, '127.0.0.1', 'Mozilla/5.0 (iPad; CPU OS 18_5 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.5 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoic1hLWVppMFNDRDhibURpbEZGYkN1MFZUQldlRDZGSm9MblVtOGVGQSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9tYW5pZmVzdC53ZWJtYW5pZmVzdCI7czo1OiJyb3V0ZSI7czoxNDoiYWRtaW4ubWFuaWZlc3QiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1776250939),
('dOGQfDHFNGELxw8B8HwthImH672r7OqCV5a7ZRBm', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVUpGRFVUUExWWXB5VjQzNmpicUZVbk5PWGV2TUs2TXVBTzdnYjdPUiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9tYW5pZmVzdC53ZWJtYW5pZmVzdCI7czo1OiJyb3V0ZSI7czoxNDoiYWRtaW4ubWFuaWZlc3QiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1776249527),
('e25xpbvMWMHfWoCvaQslD7yJuEuj9j7S4WNwNi0t', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSEdadGtxYmZuc3FoZ1IyVGhiQmJJdnRVQTZtb1RyZjFEWGRSc293WCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9tYW5pZmVzdC53ZWJtYW5pZmVzdCI7czo1OiJyb3V0ZSI7czoxNDoiYWRtaW4ubWFuaWZlc3QiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1776249522),
('EsuDeLAdAKKoSsfg8b5zLtyqfHJytBz7dZbV46GI', NULL, '127.0.0.1', 'Mozilla/5.0 (iPad; CPU OS 18_5 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.5 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiOWphN3NIRFZKNGVOWERsZ0tyRXZvdURGQm5Ja2xXS1ZNakgxWU1aYiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9tYW5pZmVzdC53ZWJtYW5pZmVzdCI7czo1OiJyb3V0ZSI7czoxNDoiYWRtaW4ubWFuaWZlc3QiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1776251040),
('FvrOPuU1t7A3Y0dbNyo76vewUgQJKl6LVQXomTH7', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiaHBQdDRZMmNEbTE5WmpHb0s5WktWODJiRG1qTERPbHpnRHJNMVZiaCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9tYW5pZmVzdC53ZWJtYW5pZmVzdCI7czo1OiJyb3V0ZSI7czoxNDoiYWRtaW4ubWFuaWZlc3QiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1776250672),
('G4nBcDRXP9BqjEvXazea7Ve2U9MDRxIou21t3rtt', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQU1QVDlmenROT2d0a0VxVkM1Q2FvM0Y4VGoxT0M4VWtTNDNERDB4dCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9tYW5pZmVzdC53ZWJtYW5pZmVzdCI7czo1OiJyb3V0ZSI7czoxNDoiYWRtaW4ubWFuaWZlc3QiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1776249596),
('h6qu8g6hlio2BbWsbiravn3Fv4qtG5wIDLaBbluz', NULL, '127.0.0.1', 'Mozilla/5.0 (iPad; CPU OS 18_5 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.5 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZ3BYU0E0NDVtRGY3RWZTNHhMMlBERTI1SWJLNGZhRWxoQVY0Q3pDZyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9tYW5pZmVzdC53ZWJtYW5pZmVzdCI7czo1OiJyb3V0ZSI7czoxNDoiYWRtaW4ubWFuaWZlc3QiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1776250973),
('HN6E4m442uE0ARYIpQyWyhX702dsCngMNqVybUen', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoia0F1S3ZMOEZLd0Y0U0Q0aXZpalNVejlIeW4zeTB4dnB0WHg0Z2dBeiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9tYW5pZmVzdC53ZWJtYW5pZmVzdCI7czo1OiJyb3V0ZSI7czoxNDoiYWRtaW4ubWFuaWZlc3QiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1776249519),
('hyOzsdZStTfB7ZfssRjnMv5xGZWVrZNttU487R9K', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibVRCYmZiYTFyeGlYVDczY0x0amZBN2FSeWJvdHl5SE9vNmdTWGFYVCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9tYW5pZmVzdC53ZWJtYW5pZmVzdCI7czo1OiJyb3V0ZSI7czoxNDoiYWRtaW4ubWFuaWZlc3QiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1776249594),
('i173Lyxe4zmOdjZnMrK81uVd0QXxU1qRRYeKr2p6', NULL, '127.0.0.1', 'Mozilla/5.0 (iPad; CPU OS 18_5 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.5 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMXB5OVphemxyWmlNSHk5b1FjVUhQdGc4dWExRE1KNFhNVjNSMTU5TSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9tYW5pZmVzdC53ZWJtYW5pZmVzdCI7czo1OiJyb3V0ZSI7czoxNDoiYWRtaW4ubWFuaWZlc3QiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1776251006),
('KByEv9BXnigYlgZO68utuxggAI6ldcYwIfgE3FPD', NULL, '127.0.0.1', 'Mozilla/5.0 (iPad; CPU OS 18_5 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.5 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNkhEMmRWdk9wUVgzSU1TRmhOaE50cXF6Q1FYSDhqZGphanVFclQ4ZiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9tYW5pZmVzdC53ZWJtYW5pZmVzdCI7czo1OiJyb3V0ZSI7czoxNDoiYWRtaW4ubWFuaWZlc3QiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1776250657),
('KVX1JQs6atqya2y6Mx8apXLCti6fKZSZNdZpEKgO', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidWpjT1dHa2dXN3BNUXFHcWl1ZEtWNk5LMjM5dzVVSlBzMzRkT09JTCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9tYW5pZmVzdC53ZWJtYW5pZmVzdCI7czo1OiJyb3V0ZSI7czoxNDoiYWRtaW4ubWFuaWZlc3QiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1776246660),
('L2rq23Qerc3nRuhWzaaKnLIIxL0ohXSD3L7YOZEa', NULL, '127.0.0.1', 'Mozilla/5.0 (iPad; CPU OS 18_5 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.5 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWklpdEthTjZtWXNvc1lpVm5CdFM4SWUxTzRWYTI5YWt3cmp5S1daRCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9tYW5pZmVzdC53ZWJtYW5pZmVzdCI7czo1OiJyb3V0ZSI7czoxNDoiYWRtaW4ubWFuaWZlc3QiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1776251035),
('LtImjbCmvQD9KCj7La6LijmShCpYoyeKszTCKQXZ', NULL, '127.0.0.1', 'Mozilla/5.0 (iPad; CPU OS 18_5 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.5 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZUtoazVzMmxlT05ia1JTWmxxVm5nVXRpN2ZGUVJFWGRYU3k2ZkV2MSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9tYW5pZmVzdC53ZWJtYW5pZmVzdCI7czo1OiJyb3V0ZSI7czoxNDoiYWRtaW4ubWFuaWZlc3QiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1776251126),
('mCGBrSBeth4vraAIeWFjSQSXTdfrttae1sfshPZZ', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMFJhcHZsTUVOV0V3TUpqR0k0UWFLUUdVSWlvUm5wT2RXRE9qdzY1dCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9tYW5pZmVzdC53ZWJtYW5pZmVzdCI7czo1OiJyb3V0ZSI7czoxNDoiYWRtaW4ubWFuaWZlc3QiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1776249719),
('mzfZ1G5VSMpOCLHzzjVwIsZkDGdyZCVPRsKjsOC9', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiaHdDQ3ZzWVFGakJSd0FNUG4zTFFpWUZKTWRLRTFkUThtRGJxMDc1MCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9tYW5pZmVzdC53ZWJtYW5pZmVzdCI7czo1OiJyb3V0ZSI7czoxNDoiYWRtaW4ubWFuaWZlc3QiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1776248900),
('NbN9kVnmpRsu51Fsc46Uz8PT2A4L5lf2ymLi5Ydg', NULL, '127.0.0.1', 'Mozilla/5.0 (iPad; CPU OS 18_5 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.5 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTDdza05sT3FiQjJwRzRnMDRNZFlRS0trYW5pUmxZbmhCbHlibHdBSCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9tYW5pZmVzdC53ZWJtYW5pZmVzdCI7czo1OiJyb3V0ZSI7czoxNDoiYWRtaW4ubWFuaWZlc3QiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1776251143),
('nyQ7gUlKnVo8Cq578kwCbu06oHWyUCG92OH2zwiB', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZ3hhb1Y1TlRJRVRZMEl5RTlkT05CcElsT0w4T0pvekFqWVo3c0NMOSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9tYW5pZmVzdC53ZWJtYW5pZmVzdCI7czo1OiJyb3V0ZSI7czoxNDoiYWRtaW4ubWFuaWZlc3QiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1776246635),
('os4MXEdjsoE58D7qt5ye4UAFX2LY0Ok4QrZS1aGe', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidXFES2tWVExGUjdXV3BnWWJ5OFVEVkRjc2lBWThGVUEybDJnaFZidCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9tYW5pZmVzdC53ZWJtYW5pZmVzdCI7czo1OiJyb3V0ZSI7czoxNDoiYWRtaW4ubWFuaWZlc3QiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1776249511),
('P3zsLLv7fj4Z2LrQ75QD0oajL4qK4h8tFTKYnujT', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibFJncDd0VmdNSGFrTG05UHhpblZaWEtCWnpDY1ZjZlNoSzk5Z09GeSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9tYW5pZmVzdC53ZWJtYW5pZmVzdCI7czo1OiJyb3V0ZSI7czoxNDoiYWRtaW4ubWFuaWZlc3QiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1776249639),
('PboRoV2nPTbl6fTf166AyJqcGRsDzt2kIz1pIZjj', NULL, '127.0.0.1', 'Mozilla/5.0 (iPad; CPU OS 18_5 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.5 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibDRiMk9vejhhUWlla0FVNGwzZGxvZmI2aGVWNG93c0p1NGc1QldzQiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9tYW5pZmVzdC53ZWJtYW5pZmVzdCI7czo1OiJyb3V0ZSI7czoxNDoiYWRtaW4ubWFuaWZlc3QiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1776251011),
('PjQSLKZ6XLeZ6qynz1Rxz5NmREmu3WIztWVQ88RA', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVllhazNuWFNtRzYwNzZBNUhrWGlkY1BnODZxT3V5ODA2S2ZmY1J4diI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9tYW5pZmVzdC53ZWJtYW5pZmVzdCI7czo1OiJyb3V0ZSI7czoxNDoiYWRtaW4ubWFuaWZlc3QiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1776249491),
('qCdKzriQ66LPbQeSIXuKCYZ1YEDM9h40LUgXRMzO', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibVJrMVRXTk1wWDFFVGxHMTJRVDNJSXQ0czRxWGxwVjBOOFk4N09XUSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9tYW5pZmVzdC53ZWJtYW5pZmVzdCI7czo1OiJyb3V0ZSI7czoxNDoiYWRtaW4ubWFuaWZlc3QiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1776246656),
('QPv2j1o7Tt1VCfFKjwKHGr8K3TZdk5BXSSADdLZY', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYjV4ZExwNVNUdENnRjZOcFYxY0pFZTlKZTFXT3ZJQVVhd2xabzFmaiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9tYW5pZmVzdC53ZWJtYW5pZmVzdCI7czo1OiJyb3V0ZSI7czoxNDoiYWRtaW4ubWFuaWZlc3QiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1776246663),
('QTI4ZW9Ep2MUdQLAk52TAg6TApA1AjKE6jWcUTGk', 2, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.5 Safari/605.1.15', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiaHBwMXpKOXpqN2QxUlI0WGh1bzhTaER5OGdaWFFueUdRZ3V2Sk9lRiI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjMxOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYWRtaW4vcG9zIjtzOjU6InJvdXRlIjtzOjk6InBvcy5pbmRleCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjI7fQ==', 1776251225),
('RfgqOO8Aphb6cnbxptPQvdBwJgbm22BNwcnhfBIE', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiamk1Q3l6TFRITGFGMnk5SHVYRTh0ZVRLZTNMUkJyckVDaU1JQ2ZPVyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9tYW5pZmVzdC53ZWJtYW5pZmVzdCI7czo1OiJyb3V0ZSI7czoxNDoiYWRtaW4ubWFuaWZlc3QiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1776249524),
('rl5kwWJGCtbHh7Jy6wDYnHnIdxxSfhBvbEkOgzdM', NULL, '127.0.0.1', 'Mozilla/5.0 (iPad; CPU OS 18_5 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.5 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidTBBdjVib1VPVDl3YjNFc0dTQjlDYklLY1Z5QkwxaWlPV0FpcGdHQSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9tYW5pZmVzdC53ZWJtYW5pZmVzdCI7czo1OiJyb3V0ZSI7czoxNDoiYWRtaW4ubWFuaWZlc3QiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1776250881),
('sZYpFAXreLFI1mwsNztxLNTBIpI96YoMDVnZCQSw', NULL, '127.0.0.1', 'Mozilla/5.0 (iPad; CPU OS 18_5 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.5 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUmZMUlcyaXlFUUI4OWxNUWdhcGVGNzZDMlhzTWJUNHJFNldJTGhSNSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9tYW5pZmVzdC53ZWJtYW5pZmVzdCI7czo1OiJyb3V0ZSI7czoxNDoiYWRtaW4ubWFuaWZlc3QiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1776251121),
('TkMeAUcnLjKy8eq9FKCYd8uGVZpoxKYVyJHtTO88', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZkJBR1g0RWF4TXVzdzN6ZzY2ZDZQY1pLTVVQUGJKSmF3aXpQTmdZZSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9tYW5pZmVzdC53ZWJtYW5pZmVzdCI7czo1OiJyb3V0ZSI7czoxNDoiYWRtaW4ubWFuaWZlc3QiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1776249716),
('tQLzTeNen6v1OCDBfx4AaUz4bAF0QOcIAeMFxAHl', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMmNGMkpxdmJERGlzcE9iWE5zOEQ2V1M4NXd6Wm5Ya1FvZ0Z6M1hNNSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9tYW5pZmVzdC53ZWJtYW5pZmVzdCI7czo1OiJyb3V0ZSI7czoxNDoiYWRtaW4ubWFuaWZlc3QiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1776249544),
('TTeqsvGuVbspfLStREBCEFxfuHXuTuM4xvL83DLN', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiY3R0bmtBS0JnZkJYVEZtRjNkRVpRdG4xc3dCckN3dmtiZEE1aXJ5NCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9tYW5pZmVzdC53ZWJtYW5pZmVzdCI7czo1OiJyb3V0ZSI7czoxNDoiYWRtaW4ubWFuaWZlc3QiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1776246838),
('tzPP1YOSsEQLavuGaMkfyPKn23tHWc62hdgsmFM2', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNnF4R2Jkdjl5SXZ4Z0NWRlNPTnlOcGlVc0k4MEltVzN3Wm1YNFlhNSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9tYW5pZmVzdC53ZWJtYW5pZmVzdCI7czo1OiJyb3V0ZSI7czoxNDoiYWRtaW4ubWFuaWZlc3QiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1776249534),
('WSsgm8jHZwPfeBFZY1hSyoXO5O4myb34DhwsbSQ5', NULL, '127.0.0.1', 'Mozilla/5.0 (iPad; CPU OS 18_5 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.5 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTlF5WDNhQzVDT1JXUW4xbllSSm5rZGNPeEN2QTlHN0RiTm1jT1RCbyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9tYW5pZmVzdC53ZWJtYW5pZmVzdCI7czo1OiJyb3V0ZSI7czoxNDoiYWRtaW4ubWFuaWZlc3QiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1776250934),
('xr4qzj6ytV2XEHCFZxYb5oXDm0Oi5iGqoBQIz2ah', NULL, '127.0.0.1', 'Mozilla/5.0 (iPad; CPU OS 18_5 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.5 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibWkzSmcwcHpKOTZDODI4bzJWOWdrUndra0xWUzNRZ04wUVU0NGlsNSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9tYW5pZmVzdC53ZWJtYW5pZmVzdCI7czo1OiJyb3V0ZSI7czoxNDoiYWRtaW4ubWFuaWZlc3QiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1776250630),
('xWvdEDV9qsPQdFsUXoGxK9wdMN3G3trdDvzWamWg', NULL, '127.0.0.1', 'Mozilla/5.0 (iPad; CPU OS 18_5 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.5 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoib1o3MmhHNFRZY1JSYnNwdEhTQlNFemYydHJyUmZuOW1ScGhNYUwyMCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9tYW5pZmVzdC53ZWJtYW5pZmVzdCI7czo1OiJyb3V0ZSI7czoxNDoiYWRtaW4ubWFuaWZlc3QiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1776251089),
('YKHUGWWXuzQGd8yCyjg1tySghVLN0wcbNI1Tjtdd', NULL, '127.0.0.1', 'Mozilla/5.0 (iPad; CPU OS 18_5 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.5 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRWs2am1zeXMwYTlsTDhsNTJtTTNBVlVoZmRIZTBSWE9vYUs3b0VVbCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9tYW5pZmVzdC53ZWJtYW5pZmVzdCI7czo1OiJyb3V0ZSI7czoxNDoiYWRtaW4ubWFuaWZlc3QiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1776251085),
('yp3YUniGVSodWt9hsohQIFtSEobzdwaDngB7uSAc', NULL, '127.0.0.1', 'Mozilla/5.0 (iPad; CPU OS 18_5 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.5 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicWRDcWhXQ0htTFdYWXUwUmxEcUtEQlNCcHBCQk5QMkduYURXZlh6ZCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9tYW5pZmVzdC53ZWJtYW5pZmVzdCI7czo1OiJyb3V0ZSI7czoxNDoiYWRtaW4ubWFuaWZlc3QiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1776250988),
('YTClBjOZ8PNs9K8dVWKJmpED5rVJDRCwa6M4YGy1', NULL, '127.0.0.1', 'Mozilla/5.0 (iPad; CPU OS 18_5 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.5 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiOGt0a3lOVlBFTzZuTXp6bWxndEUxMVR0YjFkeEpvaUJCNjZkY1BhTiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9tYW5pZmVzdC53ZWJtYW5pZmVzdCI7czo1OiJyb3V0ZSI7czoxNDoiYWRtaW4ubWFuaWZlc3QiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1776250963),
('ZEhBTmsuykgB0PzSVq9ucYnT0XbLkxdUM50qZv5C', NULL, '127.0.0.1', 'Mozilla/5.0 (iPad; CPU OS 18_5 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.5 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidEtHUW9aU1pSOWtOQWlldUk3aTRIS3JFMW9xcXFYQXpMR2g1OUJzTCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9tYW5pZmVzdC53ZWJtYW5pZmVzdCI7czo1OiJyb3V0ZSI7czoxNDoiYWRtaW4ubWFuaWZlc3QiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1776250887),
('zhAdy4LsOmgHVCymnMj299dxcVdLJL2tT2aDO67R', NULL, '127.0.0.1', 'Mozilla/5.0 (iPad; CPU OS 18_5 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.5 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoib2ZqS3hrbElDblpqcjBsckwwVzFwS09PWGpLenRIaXp4WExMcXhVUCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9tYW5pZmVzdC53ZWJtYW5pZmVzdCI7czo1OiJyb3V0ZSI7czoxNDoiYWRtaW4ubWFuaWZlc3QiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1776251131);

-- --------------------------------------------------------

--
-- Struktur dari tabel `settings`
--

CREATE TABLE `settings` (
  `id` bigint UNSIGNED NOT NULL,
  `store_logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cashier_receipt_print_logo` tinyint(1) NOT NULL DEFAULT '1',
  `store_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `payment_gateway_enabled` tinyint(1) NOT NULL DEFAULT '1',
  `tax_rate` decimal(5,2) NOT NULL DEFAULT '0.00',
  `service_rate` decimal(5,2) NOT NULL DEFAULT '0.00',
  `rounding_base` int NOT NULL DEFAULT '100',
  `point_earning_rate` decimal(12,4) NOT NULL DEFAULT '0.0000',
  `point_redemption_value` decimal(12,2) NOT NULL DEFAULT '0.00',
  `min_redemption_points` int NOT NULL DEFAULT '0',
  `discount_applies_before_tax` tinyint(1) NOT NULL DEFAULT '1',
  `pos_default_customer_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Walk-in',
  `pos_default_payment_method` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'cash',
  `voucher_alert_days_before_expiry` int UNSIGNED NOT NULL DEFAULT '7',
  `voucher_alert_quota_threshold` int UNSIGNED NOT NULL DEFAULT '10',
  `corrections_void_pending_requires_approval` tinyint(1) NOT NULL DEFAULT '0',
  `corrections_refund_requires_approval_for_cash` tinyint(1) NOT NULL DEFAULT '1',
  `corrections_refund_quick_max_amount` int UNSIGNED NOT NULL DEFAULT '20000',
  `corrections_refund_quick_max_count_per_day` int UNSIGNED NOT NULL DEFAULT '2',
  `corrections_void_quick_max_count_per_day` int UNSIGNED NOT NULL DEFAULT '3',
  `corrections_void_quick_window_minutes` int UNSIGNED NOT NULL DEFAULT '5',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `settings`
--

INSERT INTO `settings` (`id`, `store_logo`, `cashier_receipt_print_logo`, `store_name`, `phone`, `address`, `payment_gateway_enabled`, `tax_rate`, `service_rate`, `rounding_base`, `point_earning_rate`, `point_redemption_value`, `min_redemption_points`, `discount_applies_before_tax`, `pos_default_customer_name`, `pos_default_payment_method`, `voucher_alert_days_before_expiry`, `voucher_alert_quota_threshold`, `corrections_void_pending_requires_approval`, `corrections_refund_requires_approval_for_cash`, `corrections_refund_quick_max_amount`, `corrections_refund_quick_max_count_per_day`, `corrections_void_quick_max_count_per_day`, `corrections_void_quick_window_minutes`, `created_at`, `updated_at`) VALUES
(1, NULL, 1, 'Alas Bu Yanti', NULL, NULL, 1, 0.00, 0.00, 100, 0.0000, 0.00, 0, 1, 'Walk-in', 'cash', 7, 10, 0, 1, 20000, 2, 3, 5, '2026-04-12 16:30:00', '2026-04-12 16:30:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `stock_opnames`
--

CREATE TABLE `stock_opnames` (
  `id` bigint UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'draft',
  `counted_at` date NOT NULL,
  `posted_at` timestamp NULL DEFAULT NULL,
  `note` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `stock_opname_items`
--

CREATE TABLE `stock_opname_items` (
  `id` bigint UNSIGNED NOT NULL,
  `stock_opname_id` bigint UNSIGNED NOT NULL,
  `ingredient_id` bigint UNSIGNED NOT NULL,
  `system_qty` decimal(12,3) NOT NULL DEFAULT '0.000',
  `counted_qty` decimal(12,3) NOT NULL DEFAULT '0.000',
  `variance_qty` decimal(12,3) NOT NULL DEFAULT '0.000',
  `note` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `suppliers`
--

CREATE TABLE `suppliers` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `note` text COLLATE utf8mb4_unicode_ci,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint UNSIGNED NOT NULL,
  `cabang_id` bigint UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `member_id` bigint UNSIGNED DEFAULT NULL,
  `channel` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pos',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dining_table_id` bigint UNSIGNED DEFAULT NULL,
  `voucher_campaign_id` bigint UNSIGNED DEFAULT NULL,
  `voucher_code_id` bigint UNSIGNED DEFAULT NULL,
  `voucher_code` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subtotal` int NOT NULL,
  `service_percentage` decimal(5,2) NOT NULL DEFAULT '0.00',
  `service_amount` int NOT NULL DEFAULT '0',
  `voucher_discount_amount` int UNSIGNED NOT NULL DEFAULT '0',
  `manual_discount_type` enum('percent','fixed_amount') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `manual_discount_value` int UNSIGNED DEFAULT NULL,
  `manual_discount_amount` int UNSIGNED NOT NULL DEFAULT '0',
  `manual_discount_note` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `manual_discount_by_user_id` bigint UNSIGNED DEFAULT NULL,
  `discount_total_amount` int UNSIGNED NOT NULL DEFAULT '0',
  `point_discount_amount` int UNSIGNED NOT NULL DEFAULT '0',
  `points_redeemed` int UNSIGNED NOT NULL DEFAULT '0',
  `points_earned` int UNSIGNED NOT NULL DEFAULT '0',
  `tax_percentage` decimal(5,2) DEFAULT NULL,
  `tax_amount` int DEFAULT NULL,
  `payment_fee_amount` int NOT NULL DEFAULT '0',
  `rounding_amount` int NOT NULL DEFAULT '0',
  `cash_received` int DEFAULT NULL,
  `cash_change` int DEFAULT NULL,
  `refunded_amount` int UNSIGNED NOT NULL DEFAULT '0',
  `total` int NOT NULL,
  `checkout_link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_status` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'new',
  `paid_at` timestamp NULL DEFAULT NULL,
  `is_midtrans_processed` tinyint(1) NOT NULL DEFAULT '0',
  `external_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `voided_at` timestamp NULL DEFAULT NULL,
  `voided_by_user_id` bigint UNSIGNED DEFAULT NULL,
  `void_reason` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `refunded_at` timestamp NULL DEFAULT NULL,
  `refunded_by_user_id` bigint UNSIGNED DEFAULT NULL,
  `refund_reason` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `inventory_applied_at` timestamp NULL DEFAULT NULL,
  `kitchen_processed_at` timestamp NULL DEFAULT NULL,
  `kitchen_processed_by_user_id` bigint UNSIGNED DEFAULT NULL,
  `self_order_token` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_session_hash` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cart_hash` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_intent_hash` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `midtrans_snap_token` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `midtrans_redirect_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `midtrans_status` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `midtrans_payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `receipt_emailed_at` timestamp NULL DEFAULT NULL
) ;

--
-- Dumping data untuk tabel `transactions`
--

INSERT INTO `transactions` (`id`, `cabang_id`, `code`, `member_id`, `channel`, `name`, `phone`, `email`, `order_type`, `dining_table_id`, `voucher_campaign_id`, `voucher_code_id`, `voucher_code`, `subtotal`, `service_percentage`, `service_amount`, `voucher_discount_amount`, `manual_discount_type`, `manual_discount_value`, `manual_discount_amount`, `manual_discount_note`, `manual_discount_by_user_id`, `discount_total_amount`, `point_discount_amount`, `points_redeemed`, `points_earned`, `tax_percentage`, `tax_amount`, `payment_fee_amount`, `rounding_amount`, `cash_received`, `cash_change`, `refunded_amount`, `total`, `checkout_link`, `payment_method`, `payment_status`, `order_status`, `paid_at`, `is_midtrans_processed`, `external_id`, `voided_at`, `voided_by_user_id`, `void_reason`, `refunded_at`, `refunded_by_user_id`, `refund_reason`, `inventory_applied_at`, `kitchen_processed_at`, `kitchen_processed_by_user_id`, `self_order_token`, `payment_session_hash`, `cart_hash`, `payment_intent_hash`, `midtrans_snap_token`, `midtrans_redirect_url`, `midtrans_status`, `midtrans_payload`, `created_at`, `updated_at`, `receipt_emailed_at`) VALUES
(3, 4, 'DJW3QQ3A', NULL, 'pos', '1', NULL, NULL, 'dine_in', 101, NULL, NULL, NULL, 2000, 0.00, 0, 0, NULL, NULL, 0, NULL, NULL, 0, 0, 0, 0, 0.00, 0, 0, 0, NULL, NULL, 0, 2000, '', 'pending', 'pending', 'new', NULL, 0, 'JF1W2WBFTQ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-13 22:22:57', '2026-04-13 22:22:57', NULL),
(4, 5, 'N40MDBOI', NULL, 'pos', '1', NULL, NULL, 'dine_in', 201, NULL, NULL, NULL, 2000, 0.00, 0, 0, NULL, NULL, 0, NULL, NULL, 0, 0, 0, 0, 0.00, 0, 0, 0, NULL, NULL, 0, 2000, '', 'pending', 'pending', 'new', NULL, 0, 'IM3APEOH87', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-15 10:19:25', '2026-04-15 10:19:25', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaction_events`
--

CREATE TABLE `transaction_events` (
  `id` bigint UNSIGNED NOT NULL,
  `cabang_id` bigint UNSIGNED NOT NULL,
  `transaction_id` bigint UNSIGNED NOT NULL,
  `actor_user_id` bigint UNSIGNED DEFAULT NULL,
  `action` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaction_items`
--

CREATE TABLE `transaction_items` (
  `id` bigint UNSIGNED NOT NULL,
  `cabang_id` bigint UNSIGNED NOT NULL,
  `transaction_id` bigint UNSIGNED NOT NULL,
  `parent_transaction_item_id` bigint UNSIGNED DEFAULT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `product_variant_id` bigint UNSIGNED DEFAULT NULL,
  `quantity` int NOT NULL,
  `price` decimal(12,2) NOT NULL,
  `hpp_unit` decimal(12,2) DEFAULT NULL,
  `hpp_total` decimal(14,2) NOT NULL DEFAULT '0.00',
  `subtotal` decimal(12,2) NOT NULL,
  `voucher_discount_amount` int UNSIGNED NOT NULL DEFAULT '0',
  `manual_discount_amount` int UNSIGNED NOT NULL DEFAULT '0',
  `note` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `transaction_items`
--

INSERT INTO `transaction_items` (`id`, `cabang_id`, `transaction_id`, `parent_transaction_item_id`, `product_id`, `product_variant_id`, `quantity`, `price`, `hpp_unit`, `hpp_total`, `subtotal`, `voucher_discount_amount`, `manual_discount_amount`, `note`, `created_at`, `updated_at`) VALUES
(12, 4, 3, NULL, 121, 121, 1, 2000.00, NULL, 0.00, 2000.00, 0, 0, NULL, '2026-04-13 22:22:57', '2026-04-13 22:22:57'),
(13, 5, 4, NULL, 241, 241, 1, 2000.00, NULL, 0.00, 2000.00, 0, 0, NULL, '2026-04-15 10:19:25', '2026-04-15 10:19:25');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `cabang_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `manager_pin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `manager_pin_set_at` timestamp NULL DEFAULT NULL,
  `role` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'cashier',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `last_login_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `branch_id` bigint UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `cabang_id`, `name`, `email`, `email_verified_at`, `password`, `manager_pin`, `manager_pin_set_at`, `role`, `is_active`, `last_login_at`, `remember_token`, `created_at`, `updated_at`, `branch_id`) VALUES
(2, 2, 'Admin Pusat', 'admin@gmail.com', NULL, '$2y$12$lJb9TR7.Pmdt0hmYzht3PuCYrx.gC1w4R8CK9bYnQBVS3xihJjsq2', NULL, NULL, 'owner', 1, '2026-04-15 09:50:49', NULL, '2026-04-12 16:23:41', '2026-04-15 09:50:49', NULL),
(3, 4, 'Kasir', 'abyciawi@gmail.com', NULL, '$2y$12$elrAIzYsUN4On3cbjBST4.nUDiaPS8I0QyvsuTaZM2TzLKb522ExG', NULL, NULL, 'cashier', 1, '2026-04-13 22:13:28', NULL, '2026-04-13 20:49:15', '2026-04-13 22:13:28', NULL),
(4, 5, 'Kasir', 'abysholis@gmail.com', NULL, '$2y$12$Ol3kwuToZGvKCqvXGbUEwe0isEq/9tvm5bB6q.Fcml9jZt6tswBSi', NULL, NULL, 'cashier', 1, '2026-04-15 10:18:38', NULL, '2026-04-13 20:49:59', '2026-04-15 10:18:38', NULL),
(5, 4, 'Dashboard', 'ciawidash@gmail.com', NULL, '$2y$12$wHxJTEPP6P9OlKh0PIkyYOqBQGyBIyBBt1KGIGAuld3HpeMLFgVRu', '$2y$12$PPJqzN.iq.UqB0Wc5heKJuX7/Uj1YBUQE82j9rqJvvay0taP22SMu', '2026-04-13 20:51:49', 'manager', 1, NULL, NULL, '2026-04-13 20:51:49', '2026-04-13 20:51:49', NULL),
(6, 5, 'Dashboard', 'sholisdash@gmail.com', NULL, '$2y$12$YII.cVJuhrpdu0qPzSSdLu7OXsnxD5w.bDTzgvW8rCEsB4Ama5Hg6', '$2y$12$mOg2q4/xDUD9s3hC9noGIeV6Ftt.g/g7/GmIjTonrc8uBsnU9ijJe', '2026-04-13 20:52:20', 'manager', 1, NULL, NULL, '2026-04-13 20:52:20', '2026-04-13 20:52:20', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `voucher_campaigns`
--

CREATE TABLE `voucher_campaigns` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount_type` enum('percent','fixed_amount') COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount_value` int UNSIGNED NOT NULL,
  `max_discount_amount` int UNSIGNED DEFAULT NULL,
  `min_eligible_subtotal` int UNSIGNED DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `starts_at` timestamp NULL DEFAULT NULL,
  `ends_at` timestamp NULL DEFAULT NULL,
  `usage_limit_total` int UNSIGNED DEFAULT NULL,
  `usage_limit_per_user` int UNSIGNED DEFAULT NULL,
  `is_member_only` tinyint(1) NOT NULL DEFAULT '0',
  `meta` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `terms` text COLLATE utf8mb4_unicode_ci,
  `created_by_user_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `voucher_campaign_category`
--

CREATE TABLE `voucher_campaign_category` (
  `id` bigint UNSIGNED NOT NULL,
  `voucher_campaign_id` bigint UNSIGNED NOT NULL,
  `category_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `voucher_codes`
--

CREATE TABLE `voucher_codes` (
  `id` bigint UNSIGNED NOT NULL,
  `voucher_campaign_id` bigint UNSIGNED NOT NULL,
  `code` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `usage_limit_total` int UNSIGNED DEFAULT NULL,
  `usage_limit_per_user` int UNSIGNED DEFAULT NULL,
  `times_redeemed` int UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `voucher_redemptions`
--

CREATE TABLE `voucher_redemptions` (
  `id` bigint UNSIGNED NOT NULL,
  `voucher_campaign_id` bigint UNSIGNED NOT NULL,
  `voucher_code_id` bigint UNSIGNED NOT NULL,
  `transaction_id` bigint UNSIGNED NOT NULL,
  `member_id` bigint UNSIGNED DEFAULT NULL,
  `guest_identifier` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount_amount` int UNSIGNED NOT NULL,
  `snapshot` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `redeemed_at` timestamp NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ;

--
-- Indeks untuk tabel yang dibuang
--

--
-- Indeks untuk tabel `activity_log`
--
ALTER TABLE `activity_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subject` (`subject_type`,`subject_id`),
  ADD KEY `causer` (`causer_type`,`causer_id`),
  ADD KEY `activity_log_log_name_index` (`log_name`);

--
-- Indeks untuk tabel `cabangs`
--
ALTER TABLE `cabangs`
  ADD PRIMARY KEY (`id`);

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
-- Indeks untuk tabel `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categories_cabang_id_foreign` (`cabang_id`);

--
-- Indeks untuk tabel `dining_tables`
--
ALTER TABLE `dining_tables`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dining_tables_cabang_id_foreign` (`cabang_id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `ingredients`
--
ALTER TABLE `ingredients`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `ingredient_unit_conversions`
--
ALTER TABLE `ingredient_unit_conversions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ingredient_unit_conversions_ingredient_id_unit_unique` (`ingredient_id`,`unit`);

--
-- Indeks untuk tabel `inventory_movements`
--
ALTER TABLE `inventory_movements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `inventory_movements_supplier_id_foreign` (`supplier_id`),
  ADD KEY `inventory_movements_ingredient_id_happened_at_index` (`ingredient_id`,`happened_at`),
  ADD KEY `inventory_movements_reference_type_reference_id_index` (`reference_type`,`reference_id`);

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
-- Indeks untuk tabel `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `members_email_unique` (`email`),
  ADD UNIQUE KEY `members_phone_unique` (`phone`),
  ADD UNIQUE KEY `members_verification_token_unique` (`verification_token`),
  ADD KEY `members_member_region_id_foreign` (`member_region_id`),
  ADD KEY `members_member_type_index` (`member_type`);

--
-- Indeks untuk tabel `member_regions`
--
ALTER TABLE `member_regions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `member_regions_province_regency_district_unique` (`province`,`regency`,`district`),
  ADD KEY `member_regions_province_regency_district_index` (`province`,`regency`,`district`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indeks untuk tabel `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indeks untuk tabel `monthly_revenue_targets`
--
ALTER TABLE `monthly_revenue_targets`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `monthly_revenue_targets_cabang_id_year_month_unique` (`cabang_id`,`year`,`month`);

--
-- Indeks untuk tabel `operating_expenses`
--
ALTER TABLE `operating_expenses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `operating_expenses_cabang_id_foreign` (`cabang_id`),
  ADD KEY `operating_expenses_created_by_user_id_foreign` (`created_by_user_id`),
  ADD KEY `operating_expenses_expense_date_index` (`expense_date`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`),
  ADD KEY `personal_access_tokens_expires_at_index` (`expires_at`);

--
-- Indeks untuk tabel `printer_sources`
--
ALTER TABLE `printer_sources`
  ADD PRIMARY KEY (`id`),
  ADD KEY `printer_sources_cabang_id_foreign` (`cabang_id`);

--
-- Indeks untuk tabel `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_cabang_id_foreign` (`cabang_id`),
  ADD KEY `products_category_id_foreign` (`category_id`),
  ADD KEY `products_printer_source_id_foreign` (`printer_source_id`);
ALTER TABLE `products` ADD FULLTEXT KEY `fulltext_index` (`name`,`description`);

--
-- Indeks untuk tabel `product_complex_package_items`
--
ALTER TABLE `product_complex_package_items`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pcpi_pkg_component_unique` (`package_product_id`,`component_product_id`),
  ADD KEY `product_complex_package_items_component_product_id_foreign` (`component_product_id`),
  ADD KEY `pcpi_pkg_sort_idx` (`package_product_id`,`sort_order`);

--
-- Indeks untuk tabel `product_package_items`
--
ALTER TABLE `product_package_items`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `package_component_unique` (`package_product_id`,`component_product_variant_id`),
  ADD KEY `product_package_items_component_product_variant_id_foreign` (`component_product_variant_id`);

--
-- Indeks untuk tabel `product_recipes`
--
ALTER TABLE `product_recipes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `p_recipe_unique` (`cabang_id`,`product_id`,`ingredient_id`),
  ADD KEY `product_recipes_product_id_foreign` (`product_id`),
  ADD KEY `product_recipes_ingredient_id_foreign` (`ingredient_id`);

--
-- Indeks untuk tabel `product_variants`
--
ALTER TABLE `product_variants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_variants_cabang_id_foreign` (`cabang_id`),
  ADD KEY `product_variants_product_id_foreign` (`product_id`);

--
-- Indeks untuk tabel `product_variant_recipes`
--
ALTER TABLE `product_variant_recipes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pv_recipe_unique` (`cabang_id`,`product_variant_id`,`ingredient_id`),
  ADD KEY `product_variant_recipes_product_variant_id_foreign` (`product_variant_id`),
  ADD KEY `product_variant_recipes_ingredient_id_foreign` (`ingredient_id`);

--
-- Indeks untuk tabel `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `purchases_code_unique` (`code`),
  ADD KEY `purchases_supplier_id_foreign` (`supplier_id`);

--
-- Indeks untuk tabel `purchase_items`
--
ALTER TABLE `purchase_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `purchase_items_ingredient_id_foreign` (`ingredient_id`),
  ADD KEY `purchase_items_purchase_id_ingredient_id_index` (`purchase_id`,`ingredient_id`);

--
-- Indeks untuk tabel `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indeks untuk tabel `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `stock_opnames`
--
ALTER TABLE `stock_opnames`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `stock_opnames_code_unique` (`code`);

--
-- Indeks untuk tabel `stock_opname_items`
--
ALTER TABLE `stock_opname_items`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `stock_opname_items_stock_opname_id_ingredient_id_unique` (`stock_opname_id`,`ingredient_id`),
  ADD KEY `stock_opname_items_ingredient_id_foreign` (`ingredient_id`);

--
-- Indeks untuk tabel `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `transactions_code_unique` (`code`),
  ADD UNIQUE KEY `transactions_external_id_unique` (`external_id`),
  ADD UNIQUE KEY `transactions_payment_intent_hash_unique` (`payment_intent_hash`),
  ADD UNIQUE KEY `transactions_midtrans_snap_token_unique` (`midtrans_snap_token`),
  ADD KEY `transactions_cabang_id_foreign` (`cabang_id`),
  ADD KEY `transactions_member_id_foreign` (`member_id`),
  ADD KEY `transactions_dining_table_id_foreign` (`dining_table_id`),
  ADD KEY `transactions_channel_payment_status_index` (`channel`,`payment_status`),
  ADD KEY `transactions_channel_order_status_index` (`channel`,`order_status`),
  ADD KEY `transactions_self_order_token_index` (`self_order_token`),
  ADD KEY `transactions_payment_session_hash_index` (`payment_session_hash`),
  ADD KEY `transactions_cart_hash_index` (`cart_hash`),
  ADD KEY `transactions_voided_by_user_id_foreign` (`voided_by_user_id`),
  ADD KEY `transactions_refunded_by_user_id_foreign` (`refunded_by_user_id`),
  ADD KEY `transactions_kitchen_processed_by_user_id_foreign` (`kitchen_processed_by_user_id`),
  ADD KEY `transactions_voucher_campaign_id_foreign` (`voucher_campaign_id`),
  ADD KEY `transactions_voucher_code_id_voucher_campaign_id_index` (`voucher_code_id`,`voucher_campaign_id`);

--
-- Indeks untuk tabel `transaction_events`
--
ALTER TABLE `transaction_events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaction_events_cabang_id_foreign` (`cabang_id`),
  ADD KEY `transaction_events_transaction_id_foreign` (`transaction_id`),
  ADD KEY `transaction_events_actor_user_id_foreign` (`actor_user_id`);

--
-- Indeks untuk tabel `transaction_items`
--
ALTER TABLE `transaction_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaction_items_cabang_id_foreign` (`cabang_id`),
  ADD KEY `transaction_items_transaction_id_foreign` (`transaction_id`),
  ADD KEY `transaction_items_product_id_foreign` (`product_id`),
  ADD KEY `transaction_items_product_variant_id_foreign` (`product_variant_id`),
  ADD KEY `transaction_items_parent_transaction_item_id_foreign` (`parent_transaction_item_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_cabang_id_foreign` (`cabang_id`),
  ADD KEY `users_branch_id_foreign` (`branch_id`);

--
-- Indeks untuk tabel `voucher_campaigns`
--
ALTER TABLE `voucher_campaigns`
  ADD PRIMARY KEY (`id`),
  ADD KEY `voucher_campaigns_created_by_user_id_foreign` (`created_by_user_id`),
  ADD KEY `voucher_campaigns_is_active_starts_at_ends_at_index` (`is_active`,`starts_at`,`ends_at`);

--
-- Indeks untuk tabel `voucher_campaign_category`
--
ALTER TABLE `voucher_campaign_category`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `voucher_campaign_category_voucher_campaign_id_category_id_unique` (`voucher_campaign_id`,`category_id`),
  ADD KEY `voucher_campaign_category_category_id_foreign` (`category_id`);

--
-- Indeks untuk tabel `voucher_codes`
--
ALTER TABLE `voucher_codes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `voucher_codes_code_unique` (`code`),
  ADD KEY `voucher_codes_voucher_campaign_id_is_active_index` (`voucher_campaign_id`,`is_active`);

--
-- Indeks untuk tabel `voucher_redemptions`
--
ALTER TABLE `voucher_redemptions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `voucher_redemptions_transaction_id_unique` (`transaction_id`),
  ADD KEY `voucher_redemptions_voucher_campaign_id_foreign` (`voucher_campaign_id`),
  ADD KEY `voucher_redemptions_voucher_code_id_redeemed_at_index` (`voucher_code_id`,`redeemed_at`),
  ADD KEY `voucher_redemptions_member_id_redeemed_at_index` (`member_id`,`redeemed_at`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `activity_log`
--
ALTER TABLE `activity_log`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `cabangs`
--
ALTER TABLE `cabangs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `dining_tables`
--
ALTER TABLE `dining_tables`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=301;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `ingredients`
--
ALTER TABLE `ingredients`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `ingredient_unit_conversions`
--
ALTER TABLE `ingredient_unit_conversions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `inventory_movements`
--
ALTER TABLE `inventory_movements`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `members`
--
ALTER TABLE `members`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `member_regions`
--
ALTER TABLE `member_regions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT untuk tabel `monthly_revenue_targets`
--
ALTER TABLE `monthly_revenue_targets`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `operating_expenses`
--
ALTER TABLE `operating_expenses`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `printer_sources`
--
ALTER TABLE `printer_sources`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=361;

--
-- AUTO_INCREMENT untuk tabel `product_complex_package_items`
--
ALTER TABLE `product_complex_package_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `product_package_items`
--
ALTER TABLE `product_package_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `product_recipes`
--
ALTER TABLE `product_recipes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `product_variants`
--
ALTER TABLE `product_variants`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=361;

--
-- AUTO_INCREMENT untuk tabel `product_variant_recipes`
--
ALTER TABLE `product_variant_recipes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `purchases`
--
ALTER TABLE `purchases`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `purchase_items`
--
ALTER TABLE `purchase_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `stock_opnames`
--
ALTER TABLE `stock_opnames`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `stock_opname_items`
--
ALTER TABLE `stock_opname_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `transaction_events`
--
ALTER TABLE `transaction_events`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `transaction_items`
--
ALTER TABLE `transaction_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `voucher_campaigns`
--
ALTER TABLE `voucher_campaigns`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `voucher_campaign_category`
--
ALTER TABLE `voucher_campaign_category`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `voucher_codes`
--
ALTER TABLE `voucher_codes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `voucher_redemptions`
--
ALTER TABLE `voucher_redemptions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_cabang_id_foreign` FOREIGN KEY (`cabang_id`) REFERENCES `cabangs` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `dining_tables`
--
ALTER TABLE `dining_tables`
  ADD CONSTRAINT `dining_tables_cabang_id_foreign` FOREIGN KEY (`cabang_id`) REFERENCES `cabangs` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `ingredient_unit_conversions`
--
ALTER TABLE `ingredient_unit_conversions`
  ADD CONSTRAINT `ingredient_unit_conversions_ingredient_id_foreign` FOREIGN KEY (`ingredient_id`) REFERENCES `ingredients` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `inventory_movements`
--
ALTER TABLE `inventory_movements`
  ADD CONSTRAINT `inventory_movements_ingredient_id_foreign` FOREIGN KEY (`ingredient_id`) REFERENCES `ingredients` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `inventory_movements_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE SET NULL;

--
-- Ketidakleluasaan untuk tabel `members`
--
ALTER TABLE `members`
  ADD CONSTRAINT `members_member_region_id_foreign` FOREIGN KEY (`member_region_id`) REFERENCES `member_regions` (`id`) ON DELETE SET NULL;

--
-- Ketidakleluasaan untuk tabel `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `monthly_revenue_targets`
--
ALTER TABLE `monthly_revenue_targets`
  ADD CONSTRAINT `monthly_revenue_targets_cabang_id_foreign` FOREIGN KEY (`cabang_id`) REFERENCES `cabangs` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `operating_expenses`
--
ALTER TABLE `operating_expenses`
  ADD CONSTRAINT `operating_expenses_cabang_id_foreign` FOREIGN KEY (`cabang_id`) REFERENCES `cabangs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `operating_expenses_created_by_user_id_foreign` FOREIGN KEY (`created_by_user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Ketidakleluasaan untuk tabel `printer_sources`
--
ALTER TABLE `printer_sources`
  ADD CONSTRAINT `printer_sources_cabang_id_foreign` FOREIGN KEY (`cabang_id`) REFERENCES `cabangs` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_cabang_id_foreign` FOREIGN KEY (`cabang_id`) REFERENCES `cabangs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_printer_source_id_foreign` FOREIGN KEY (`printer_source_id`) REFERENCES `printer_sources` (`id`) ON DELETE SET NULL;

--
-- Ketidakleluasaan untuk tabel `product_complex_package_items`
--
ALTER TABLE `product_complex_package_items`
  ADD CONSTRAINT `product_complex_package_items_component_product_id_foreign` FOREIGN KEY (`component_product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `product_complex_package_items_package_product_id_foreign` FOREIGN KEY (`package_product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `product_package_items`
--
ALTER TABLE `product_package_items`
  ADD CONSTRAINT `product_package_items_component_product_variant_id_foreign` FOREIGN KEY (`component_product_variant_id`) REFERENCES `product_variants` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_package_items_package_product_id_foreign` FOREIGN KEY (`package_product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `product_recipes`
--
ALTER TABLE `product_recipes`
  ADD CONSTRAINT `product_recipes_cabang_id_foreign` FOREIGN KEY (`cabang_id`) REFERENCES `cabangs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_recipes_ingredient_id_foreign` FOREIGN KEY (`ingredient_id`) REFERENCES `ingredients` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_recipes_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `product_variants`
--
ALTER TABLE `product_variants`
  ADD CONSTRAINT `product_variants_cabang_id_foreign` FOREIGN KEY (`cabang_id`) REFERENCES `cabangs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_variants_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `product_variant_recipes`
--
ALTER TABLE `product_variant_recipes`
  ADD CONSTRAINT `product_variant_recipes_cabang_id_foreign` FOREIGN KEY (`cabang_id`) REFERENCES `cabangs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_variant_recipes_ingredient_id_foreign` FOREIGN KEY (`ingredient_id`) REFERENCES `ingredients` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_variant_recipes_product_variant_id_foreign` FOREIGN KEY (`product_variant_id`) REFERENCES `product_variants` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `purchases`
--
ALTER TABLE `purchases`
  ADD CONSTRAINT `purchases_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE SET NULL;

--
-- Ketidakleluasaan untuk tabel `purchase_items`
--
ALTER TABLE `purchase_items`
  ADD CONSTRAINT `purchase_items_ingredient_id_foreign` FOREIGN KEY (`ingredient_id`) REFERENCES `ingredients` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `purchase_items_purchase_id_foreign` FOREIGN KEY (`purchase_id`) REFERENCES `purchases` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `stock_opname_items`
--
ALTER TABLE `stock_opname_items`
  ADD CONSTRAINT `stock_opname_items_ingredient_id_foreign` FOREIGN KEY (`ingredient_id`) REFERENCES `ingredients` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `stock_opname_items_stock_opname_id_foreign` FOREIGN KEY (`stock_opname_id`) REFERENCES `stock_opnames` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_cabang_id_foreign` FOREIGN KEY (`cabang_id`) REFERENCES `cabangs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transactions_dining_table_id_foreign` FOREIGN KEY (`dining_table_id`) REFERENCES `dining_tables` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transactions_kitchen_processed_by_user_id_foreign` FOREIGN KEY (`kitchen_processed_by_user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `transactions_member_id_foreign` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `transactions_refunded_by_user_id_foreign` FOREIGN KEY (`refunded_by_user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `transactions_voided_by_user_id_foreign` FOREIGN KEY (`voided_by_user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `transactions_voucher_campaign_id_foreign` FOREIGN KEY (`voucher_campaign_id`) REFERENCES `voucher_campaigns` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `transactions_voucher_code_id_foreign` FOREIGN KEY (`voucher_code_id`) REFERENCES `voucher_codes` (`id`) ON DELETE SET NULL;

--
-- Ketidakleluasaan untuk tabel `transaction_events`
--
ALTER TABLE `transaction_events`
  ADD CONSTRAINT `transaction_events_actor_user_id_foreign` FOREIGN KEY (`actor_user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `transaction_events_cabang_id_foreign` FOREIGN KEY (`cabang_id`) REFERENCES `cabangs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transaction_events_transaction_id_foreign` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `transaction_items`
--
ALTER TABLE `transaction_items`
  ADD CONSTRAINT `transaction_items_cabang_id_foreign` FOREIGN KEY (`cabang_id`) REFERENCES `cabangs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transaction_items_parent_transaction_item_id_foreign` FOREIGN KEY (`parent_transaction_item_id`) REFERENCES `transaction_items` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transaction_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transaction_items_product_variant_id_foreign` FOREIGN KEY (`product_variant_id`) REFERENCES `product_variants` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transaction_items_transaction_id_foreign` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `cabangs` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `users_cabang_id_foreign` FOREIGN KEY (`cabang_id`) REFERENCES `cabangs` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `voucher_campaigns`
--
ALTER TABLE `voucher_campaigns`
  ADD CONSTRAINT `voucher_campaigns_created_by_user_id_foreign` FOREIGN KEY (`created_by_user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Ketidakleluasaan untuk tabel `voucher_campaign_category`
--
ALTER TABLE `voucher_campaign_category`
  ADD CONSTRAINT `voucher_campaign_category_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `voucher_campaign_category_voucher_campaign_id_foreign` FOREIGN KEY (`voucher_campaign_id`) REFERENCES `voucher_campaigns` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `voucher_codes`
--
ALTER TABLE `voucher_codes`
  ADD CONSTRAINT `voucher_codes_voucher_campaign_id_foreign` FOREIGN KEY (`voucher_campaign_id`) REFERENCES `voucher_campaigns` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `voucher_redemptions`
--
ALTER TABLE `voucher_redemptions`
  ADD CONSTRAINT `voucher_redemptions_member_id_foreign` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `voucher_redemptions_transaction_id_foreign` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `voucher_redemptions_voucher_campaign_id_foreign` FOREIGN KEY (`voucher_campaign_id`) REFERENCES `voucher_campaigns` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `voucher_redemptions_voucher_code_id_foreign` FOREIGN KEY (`voucher_code_id`) REFERENCES `voucher_codes` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
