-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 23 Okt 2023 pada 01.17
-- Versi server: 10.4.25-MariaDB
-- Versi PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vehicle_management`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `approvations`
--

CREATE TABLE `approvations` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `approver_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transaction_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_approved` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `approvations`
--

INSERT INTO `approvations` (`id`, `approver_id`, `transaction_id`, `is_approved`, `created_at`, `updated_at`) VALUES
('9a6e8339-6df5-4013-9ddb-d26384666a43', '9a6d95d6-15b2-4927-9421-75e59a6776be', '9a6e8339-67b0-4e9c-b768-a1421e9e92e1', 1, '2023-10-22 10:06:26', '2023-10-22 14:06:32'),
('9a6ef45b-f93c-4e4a-8b17-5a4e7053e500', '9a6d95d6-15b2-4927-9421-75e59a6776be', '9a6ef45b-f7ba-49b2-853d-fef82ce8871c', 1, '2023-10-22 15:22:47', '2023-10-22 15:25:41'),
('9a6ef45b-fa24-4489-96a2-da02cf3d4c15', '9a6e4a6d-3f19-4b6d-adb9-af1c96ebc69e', '9a6ef45b-f7ba-49b2-853d-fef82ce8871c', 0, '2023-10-22 15:22:47', '2023-10-22 15:22:47');

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
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_10_20_121526_create_vehicles_table', 1),
(6, '2023_10_20_121532_create_transactions_table', 1),
(7, '2023_10_20_121550_create_approvations_table', 1),
(8, '2023_10_20_123218_create_service_histories_table', 1);

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
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `service_histories`
--

CREATE TABLE `service_histories` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vehicle_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `service_desc` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `service_date` date NOT NULL,
  `serviced_at_km` int(11) NOT NULL,
  `price` int(10) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `service_histories`
--

INSERT INTO `service_histories` (`id`, `vehicle_id`, `service_desc`, `service_date`, `serviced_at_km`, `price`, `created_at`, `updated_at`) VALUES
('9a6df72a-010d-4b6e-a3e7-1881f81f8695', '9a6db82b-c463-4306-943b-b32c16046ad6', '<ul>\r\n<li>Servis Mesin</li>\r\n<li>Ganti oli</li>\r\n</ul>', '2023-10-22', 0, 250000, '2023-10-22 03:34:48', '2023-10-22 03:34:48');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transactions`
--

CREATE TABLE `transactions` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `driver_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vehicle_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `booking_duration` int(11) NOT NULL,
  `booking_start` date NOT NULL,
  `pickup_date` datetime DEFAULT NULL,
  `return_date` datetime DEFAULT NULL,
  `distance_traveled` int(11) DEFAULT NULL,
  `fuel_consumed` int(11) DEFAULT NULL,
  `is_approved` tinyint(1) NOT NULL DEFAULT 0,
  `is_returned` tinyint(1) NOT NULL DEFAULT 0,
  `return_status` enum('late','on time') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `transactions`
--

INSERT INTO `transactions` (`id`, `driver_id`, `vehicle_id`, `booking_duration`, `booking_start`, `pickup_date`, `return_date`, `distance_traveled`, `fuel_consumed`, `is_approved`, `is_returned`, `return_status`, `created_at`, `updated_at`) VALUES
('9a6e8339-67b0-4e9c-b768-a1421e9e92e1', '9a6e4a6d-3f19-4b6d-adb9-af1c96ebc69e', '9a6db82b-c463-4306-943b-b32c16046ad6', 10, '2023-10-24', '2023-10-22 21:33:12', '2023-10-22 21:34:09', 12, 5, 1, 1, 'late', '2023-10-22 10:06:26', '2023-10-22 14:34:09'),
('9a6ef45b-f7ba-49b2-853d-fef82ce8871c', '9a6e4a57-e410-4eb2-b2f8-4005b3200c8b', '9a6ef3ed-ed17-4c66-8c3e-f1edc01ab5cf', 10, '2023-10-24', NULL, NULL, NULL, NULL, 0, 0, NULL, '2023-10-22 15:22:47', '2023-10-22 15:22:47');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fullname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` enum('1','2') COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `picture_url` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `fullname`, `email`, `password`, `level`, `position`, `is_active`, `picture_url`, `email_verified_at`, `remember_token`, `created_at`, `updated_at`) VALUES
('51181b91-708b-11ee-a08e-e4a8dfe5f690', 'Krisna Putra Mariyanto', 'krisna@gmail.com', '$2a$10$77/RRPeVVWG8v4tDAzQFS.tnsqbeKX9qf.WQioIIXzy5mK/DfX/Gu', '1', 'Admin', 1, NULL, NULL, NULL, '2023-10-22 03:28:26', '2023-10-22 03:28:26'),
('9a6d95d6-15b2-4927-9421-75e59a6776be', 'Aliya Mutia Nashwa', 'aliyanashwa@gmail.com', '$2y$10$sZfG9UCRDOoO1aqIAX84A.C0nPkx8GXjyjZ5LqNhWy0UnOk0af106', '2', 'Manager', 1, NULL, NULL, NULL, '2023-10-21 23:02:39', '2023-10-21 23:11:08'),
('9a6e4a57-e410-4eb2-b2f8-4005b3200c8b', 'Almira', 'almira@gmail.com', '$2y$10$oKv6VcdHvhSBIxJxjJSjb.ne6uqaE13HggDrf1hw2naiVijnMWPwy', '2', 'Manager', 1, NULL, NULL, NULL, '2023-10-22 07:27:23', '2023-10-22 07:27:23'),
('9a6e4a6d-3f19-4b6d-adb9-af1c96ebc69e', 'Adhra SPV', 'adhra@gmail.com', '$2y$10$QKyGLbP/YICMUOS848DTwOa3Xf0R3cxBfaSyt/yEoOBZNEiBvSvaG', '2', 'Manager', 1, NULL, NULL, NULL, '2023-10-22 07:27:37', '2023-10-22 07:27:37');

-- --------------------------------------------------------

--
-- Struktur dari tabel `vehicles`
--

CREATE TABLE `vehicles` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('suv','sedan','pickup','bus','motor') COLLATE utf8mb4_unicode_ci NOT NULL,
  `serie` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `year` year(4) NOT NULL,
  `license_number` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fuel_capacity` int(11) NOT NULL,
  `service_cycle` int(11) NOT NULL,
  `need_service` tinyint(1) NOT NULL DEFAULT 0,
  `is_booked` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `vehicles`
--

INSERT INTO `vehicles` (`id`, `type`, `serie`, `year`, `license_number`, `fuel_capacity`, `service_cycle`, `need_service`, `is_booked`, `created_at`, `updated_at`) VALUES
('9a6db82b-c463-4306-943b-b32c16046ad6', 'sedan', 'HRV', 2020, 'N 5623 AGV', 120, 10000, 0, 0, '2023-10-22 00:38:39', '2023-10-22 10:06:26'),
('9a6ef3ed-ed17-4c66-8c3e-f1edc01ab5cf', 'sedan', 'Civic Turbo', 2020, 'N 3241 ZA', 120, 10000, 0, 1, '2023-10-22 15:21:35', '2023-10-22 15:22:47');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `approvations`
--
ALTER TABLE `approvations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `approvations_approver_id_foreign` (`approver_id`),
  ADD KEY `transaction_id` (`transaction_id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

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
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `service_histories`
--
ALTER TABLE `service_histories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `service_histories_vehicle_id_foreign` (`vehicle_id`);

--
-- Indeks untuk tabel `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transactions_driver_id_foreign` (`driver_id`),
  ADD KEY `transactions_vehicle_id_foreign` (`vehicle_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indeks untuk tabel `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `license_number` (`license_number`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `approvations`
--
ALTER TABLE `approvations`
  ADD CONSTRAINT `approvations_approver_id_foreign` FOREIGN KEY (`approver_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `approvations_ibfk_1` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `service_histories`
--
ALTER TABLE `service_histories`
  ADD CONSTRAINT `service_histories_vehicle_id_foreign` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`id`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_driver_id_foreign` FOREIGN KEY (`driver_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `transactions_vehicle_id_foreign` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
