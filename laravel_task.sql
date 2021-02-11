-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 11, 2021 at 03:53 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel_task`
--

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'IT', 'it', '2021-02-10 03:57:47', '2021-02-10 03:57:47'),
(2, 'HR', 'hr', '2021-02-10 03:57:58', '2021-02-10 03:57:58'),
(3, 'Training', 'training', '2021-02-10 03:58:10', '2021-02-10 03:58:10'),
(4, 'Finance', 'finance', '2021-02-10 03:58:20', '2021-02-10 03:58:20'),
(5, 'Operation', 'operation', '2021-02-10 03:58:39', '2021-02-10 03:58:39');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2021_02_08_012342_create_roles_table', 1),
(5, '2021_02_08_012400_create_permissions_table', 1),
(6, '2021_02_08_012422_create_departments_table', 1),
(7, '2021_02_08_012440_create_works_table', 1),
(9, '2021_02_08_012456_create_user_works_table', 2),
(10, '2014_10_12_000000_create_users_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` int(11) NOT NULL,
  `permission` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `role_id`, `permission`, `created_at`, `updated_at`) VALUES
(13, 1, '{\"roles\":[\"list\",\"add\",\"edit\",\"view\",\"delete\"],\"permissions\":[\"list\",\"add\",\"edit\",\"view\",\"delete\"],\"departments\":[\"list\",\"add\",\"edit\",\"view\",\"delete\"],\"works\":[\"list\",\"add\",\"edit\",\"view\",\"delete\"],\"users\":[\"list\",\"add\",\"edit\",\"view\",\"delete\"],\"assign_works\":[\"list\",\"add\",\"edit\",\"view\",\"delete\"]}', '2021-02-11 01:19:04', '2021-02-11 01:19:04'),
(14, 2, '{\"roles\":[],\"permissions\":[],\"departments\":[],\"works\":[],\"users\":[],\"assign_works\":[\"list\",\"add\",\"edit\"]}', '2021-02-11 01:22:06', '2021-02-11 01:22:06'),
(16, 7, '{\"roles\":[],\"permissions\":[],\"departments\":[],\"works\":[],\"users\":[],\"assign_works\":[\"list\"]}', '2021-02-11 02:54:46', '2021-02-11 02:54:46');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Main Admin', 'main-admin', '2021-02-09 03:32:49', '2021-02-09 03:32:49'),
(2, 'Department Admin', 'department-admin', '2021-02-09 03:33:20', '2021-02-09 03:33:20'),
(7, 'Worker', 'worker', '2021-02-11 02:54:23', '2021-02-11 02:54:23');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` int(11) NOT NULL,
  `department_id` int(11) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `address`, `email_verified_at`, `password`, `role_id`, `department_id`, `status`, `slug`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Mehedi', 'admin@gmail.com', '0176565547', 'Dhaka', NULL, '$2y$10$vaEpYyfjRmjIxYYRIl2y9O0gJ/fmHBIcEi9ywnMY6XfOcmjxw8kJO', 1, NULL, 1, 'mehedi', NULL, '2021-02-10 18:06:01', '2021-02-10 18:06:01'),
(2, 'Hasan', 'hasan@gmail.com', '01766656567', 'Dhaka', NULL, '$2y$10$5CgvjfDf32akc25Fw9pymuw0krhjL.NpxiufQiK3EaE1pGqzGv8em', 2, 1, 1, 'hasan', NULL, '2021-02-11 03:10:45', '2021-02-11 03:10:45'),
(3, 'Sabuj', 'sabuj@gmail.com', '01665776567', 'Dhaka', NULL, '$2y$10$N51lYxvxZpeznhRn45C0nuaavMf/suKAbIuDyTUny2FXoCGfOmP1q', 7, 1, 1, 'it-worker', NULL, '2021-02-11 03:11:48', '2021-02-11 03:11:48'),
(4, 'Sujon', 'sujon@gmail.com', '12345678', 'Dhaka', NULL, '$2y$10$10bJPKOejJtXZ/G0qtoo3OUvPZIbQQbIwCFu/ejL3so9rp6e1F8oK', 7, 1, 1, 'it-worker-2', NULL, '2021-02-11 03:12:56', '2021-02-11 03:12:56'),
(5, 'Emon', 'emon@gmail.com', '01654454567', 'Dhaka', NULL, '$2y$10$l12C7.pl.NG0PPtJtIeyz.VjYobQ5U22/5VUdcCla927xDCnTfPzu', 2, 2, 1, 'emon', NULL, '2021-02-11 03:13:58', '2021-02-11 03:13:58'),
(6, 'Hr worker', 'hr@gmail.com', '01783354905', 'Dhaka', NULL, '$2y$10$EwpWqUzevEi47QUgsAJ9H.c9P8MNmah2.kzuR3UDEX8N8LSSkgn5K', 7, 2, 1, 'hr-worker', NULL, '2021-02-11 03:14:57', '2021-02-11 03:14:57'),
(7, 'Mahibul', 'mahibul@gmail.com', '0176554567', 'Dhaka', NULL, '$2y$10$i1IWatoMT4sJDq2mS0WOQ.0VuD0aX/hv/HzeBs.YwTmH3qHYGUshq', 2, 3, 1, 'mahibul', NULL, '2021-02-11 03:17:34', '2021-02-11 03:17:34'),
(8, 'Tra worker', 'tr@gmail.com', '01783354905', 'Dhaka', NULL, '$2y$10$xIp06Yx0Q086jVHyifTsaOFMBbUj33OsFBTtlOvao9jKkeseoJyqG', 7, 3, 1, 'tra-worker', NULL, '2021-02-11 03:18:41', '2021-02-11 03:18:41'),
(9, 'Islam', 'islam@gmail.com', '01783354905', 'Dhaka', NULL, '$2y$10$OxmyPzh3TqPxNp.QQQKCf.0Yd2sYBQ2qPypyA.HHv4EUsqfN.Jyny', 2, 4, 1, 'islam', NULL, '2021-02-11 03:19:38', '2021-02-11 03:19:38'),
(11, 'Fin Worker', 'fi@gmail.com', '017655545545', 'Dhaka', NULL, '$2y$10$G6G02HUpF5C9HacOGXah/uoCMXtdyURVsqTjolTsuE42wERK65ZW6', 7, 4, 1, 'fin-worker', NULL, '2021-02-11 03:20:58', '2021-02-11 03:20:58'),
(12, 'Mahib', 'mahib@gmail.com', '01783354905', 'Dhaka', NULL, '$2y$10$YVvOMr/Pm9u4wg7pvYFTc.sJ.3V7AfxpanNELFEeMQ9iZCP8fRpfa', 2, 5, 1, 'mahib-BhZauF8q16iLKUT0Aie2', NULL, '2021-02-11 03:21:55', '2021-02-11 03:21:55'),
(13, 'Op worker', 'op@gmail.com', '0176655343', 'Dhaka', NULL, '$2y$10$SEgTaByKxIRg5253bBgfiOyroasGuypLE4PP89vdk7mbuhNvPUgOG', 7, 5, 1, 'op-worker', NULL, '2021-02-11 03:23:33', '2021-02-11 03:23:33');

-- --------------------------------------------------------

--
-- Table structure for table `user_works`
--

CREATE TABLE `user_works` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `work_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_works`
--

INSERT INTO `user_works` (`id`, `user_id`, `work_id`, `department_id`, `created_at`, `updated_at`) VALUES
(11, 3, 2, 1, '2021-02-11 03:48:59', '2021-02-11 03:48:59'),
(12, 3, 1, 1, '2021-02-11 03:49:43', '2021-02-11 03:49:43'),
(13, 6, 3, 2, '2021-02-11 03:50:48', '2021-02-11 03:50:48'),
(14, 5, 4, 2, '2021-02-11 03:51:41', '2021-02-11 03:51:41'),
(15, 9, 5, 4, '2021-02-11 03:52:21', '2021-02-11 03:52:21'),
(16, 11, 6, 4, '2021-02-11 03:52:46', '2021-02-11 03:52:46'),
(18, 8, 7, 3, '2021-02-11 03:53:26', '2021-02-11 03:53:26'),
(19, 13, 8, 5, '2021-02-11 03:53:54', '2021-02-11 03:53:54'),
(20, 13, 9, 5, '2021-02-11 03:54:22', '2021-02-11 03:54:22'),
(21, 12, 10, 5, '2021-02-11 03:54:45', '2021-02-11 03:54:45'),
(23, 4, 2, 1, '2021-02-11 04:05:26', '2021-02-11 04:05:26');

-- --------------------------------------------------------

--
-- Table structure for table `works`
--

CREATE TABLE `works` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `works`
--

INSERT INTO `works` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Network Setup and Maintainance', 'network-setup-and-maintainance', '2021-02-10 04:20:23', '2021-02-10 04:20:23'),
(2, 'Software Development', 'software-development', '2021-02-10 04:20:44', '2021-02-10 04:20:44'),
(3, 'Requirement', 'requirement', '2021-02-10 04:20:58', '2021-02-10 04:20:58'),
(4, 'Salary Distribution', 'salary-distribution', '2021-02-10 04:21:14', '2021-02-10 04:21:14'),
(5, 'Budget Calculation', 'budget-calculation', '2021-02-10 04:21:32', '2021-02-10 04:21:32'),
(6, 'Financial Audit', 'financial-audit', '2021-02-10 04:21:47', '2021-02-10 04:21:47'),
(7, 'Product Training', 'product-training', '2021-02-10 04:22:00', '2021-02-10 04:22:00'),
(8, 'QA', 'qa', '2021-02-10 04:22:59', '2021-02-10 04:22:59'),
(9, 'Custom Support', 'custom-support', '2021-02-10 04:24:50', '2021-02-10 04:24:50'),
(10, 'Manage Vendor', 'manage-vendor', '2021-02-10 04:24:58', '2021-02-10 04:24:58'),
(15, 'Testing New one', 'testing-new-one', '2021-02-11 10:38:14', '2021-02-11 10:38:14');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_works`
--
ALTER TABLE `user_works`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `works`
--
ALTER TABLE `works`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `user_works`
--
ALTER TABLE `user_works`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `works`
--
ALTER TABLE `works`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
