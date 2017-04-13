-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 12, 2017 at 11:42 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nasaco`
--

-- --------------------------------------------------------

--
-- Table structure for table `bills`
--

CREATE TABLE `bills` (
  `id` int(10) UNSIGNED NOT NULL,
  `ngay` int(11) DEFAULT NULL,
  `thang` int(11) DEFAULT NULL,
  `nam` int(11) DEFAULT NULL,
  `ngay_thang_nam` date DEFAULT NULL,
  `mat_hang` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nhom_hang` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dien_giai` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ma_buu_chinh` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dvt` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sl_dat_hang` double DEFAULT NULL,
  `sl_thuc_xuat` double DEFAULT NULL,
  `sl_thanh_toan` double DEFAULT NULL,
  `con_lai` double DEFAULT NULL,
  `don_gia` double DEFAULT NULL,
  `thanh_tien_thanh_toan` double DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2017_03_17_042455_create_bill_table', 1),
(4, '2017_03_17_082012_create_provinces_table', 1),
(5, '2017_03_18_042915_create_nhom_hang_table', 1),
(6, '2017_04_02_152225_create_roles_table', 1),
(7, '2017_04_02_152735_create_role_users_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

CREATE TABLE `product_categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_categories`
--

INSERT INTO `product_categories` (`id`, `name`, `code`) VALUES
(1, 'F1', 'F1'),
(2, 'F2', 'F2'),
(3, 'FA', 'FA'),
(4, 'E', 'E'),
(6, 'G', 'G');

-- --------------------------------------------------------

--
-- Table structure for table `provinces`
--

CREATE TABLE `provinces` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `postal_code` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `provinces`
--

INSERT INTO `provinces` (`id`, `code`, `name`, `postal_code`, `created_at`, `updated_at`) VALUES
(1, 'VN-44', 'An Giang', 880000, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'VN-43', 'Vũng Tàu', 790000, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'VN-54', 'Bắc Giang', 220000, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'VN-53', 'Bắc Kạn', 960000, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'VN-55', 'Bạc Liêu', 260000, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 'VN-56', 'Bắc Ninh', 790000, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 'VN-50', 'Bến Tre', 930000, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 'VN-31', 'Bình Định', 820000, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 'VN-57', 'Bình Dương', 590000, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 'VN-58', 'Bình Phước', 830000, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, 'VN-40', 'Bình Thuận', 800000, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(12, 'VN-59', 'Cà Mau', 970000, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(13, 'VN-04', 'Cao Bằng', 900000, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(14, 'VN-33', 'Đắk Lắk', 630000, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(15, 'VN-72', 'Đắk Nông', 64000, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(16, 'VN-71', 'Điện Biên', 990000, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(17, 'VN-39', 'Đồng Nai', 810000, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(18, 'VN-45', 'Đồng Tháp', 870000, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(19, 'VN-30', 'Gia Lai', 600000, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(20, 'VN-03', 'Hà Giang', 310000, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(21, 'VN-63', 'Hà Nam', 400000, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(22, 'VN-23', 'Hà Tĩnh', 480000, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(23, 'VN-61', 'Hải Dương', 170000, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(24, 'VN-73', 'Hậu Giang', 910000, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(25, 'VN-14', 'Hòa Bình', 350000, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(26, 'VN-66', 'Hưng Yên', 160000, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(27, 'VN-34', 'Khánh Hòa', 650000, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(28, 'VN-47', 'Kiên Giang', 920000, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(29, 'VN-28', 'Kon Tum', 580000, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(30, 'VN-01', 'Lai Châu', 390000, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(31, 'VN-35', 'Lâm Đồng', 670000, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(32, 'VN-09', 'Lạng Sơn', 240000, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(33, 'VN-02', 'Lào Cai', 330000, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(34, 'VN-41', 'Long An', 850000, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(35, 'VN-67', 'Nam Định', 420000, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(36, 'VN-22', 'Nghệ An', 460000, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(37, 'VN-18', 'Ninh Bình', 430000, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(38, 'VN-36', 'Ninh Thuận', 660000, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(39, 'VN-68', 'Phú Thọ', 290000, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(40, 'VN-32', 'Phú Yên', 620000, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(41, 'VN-24', 'Quảng Bình', 510000, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(42, 'VN-27', 'Quảng Nam', 560000, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(43, 'VN-29', 'Quảng Ngãi', 570000, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(44, 'VN-13', 'Quảng Ninh', 200000, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(45, 'VN-25', 'Quảng Trị', 520000, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(46, 'VN-52', 'Sóc Trăng', 950000, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(47, 'VN-05', 'Sơn La', 360000, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(48, 'VN-37', 'Tây Ninh', 840000, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(49, 'VN-20', 'Thái Bình', 410000, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(50, 'VN-69', 'Thái Nguyên', 250000, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(51, 'VN-21', 'Thanh Hóa', 440000, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(52, 'VN-26', 'Thừa Thiên Huế', 530000, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(53, 'VN-46', 'Tiền Giang', 860000, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(54, 'VN-51', 'Trà Vinh', 940000, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(55, 'VN-07', 'Tuyên Quang', 300000, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(56, 'VN-49', 'Vĩnh Long', 890000, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(57, 'VN-70', 'Vĩnh Phúc', 280000, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(58, 'VN-06', 'Yên Bái', 320000, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(59, 'VN-CT', 'Cần Thơ', 270000, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(60, 'VN-DN', 'Đà Nẵng', 550000, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(61, 'VN-HN', 'Hà Nội', 100000, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(62, 'VN-HP', 'Hải Phòng', 180000, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(63, 'VN-SG', 'Hồ Chí Minh', 700000, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `code`, `name`, `display_name`, `order`) VALUES
(1, '$2y$10$wKmxbOREw6kvnaM5vse1Qua2QiVS0cfCznK5Wey3dsP77kMROHpei', 'mod', 'Moderator', 1),
(2, '$2y$10$CEelZ5NJlB1qcsZWWE3aMuYXvmpSpBegGdMlvvIJ97gGhxLzktW/.', 'admin', 'Admin', 2);

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `api_token` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bills`
--
ALTER TABLE `bills`
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
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `product_categories`
--
ALTER TABLE `product_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `provinces`
--
ALTER TABLE `provinces`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_code_unique` (`code`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `role_user_user_id_role_id_unique` (`user_id`,`role_id`),
  ADD KEY `role_user_role_id_foreign` (`role_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_api_token_unique` (`api_token`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bills`
--
ALTER TABLE `bills`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `product_categories`
--
ALTER TABLE `product_categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `provinces`
--
ALTER TABLE `provinces`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `role_user`
--
ALTER TABLE `role_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`),
  ADD CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
