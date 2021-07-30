-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 08, 2021 at 09:16 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `qrcodeproducts`
--

-- --------------------------------------------------------

--
-- Table structure for table `colors`
--

CREATE TABLE `colors` (
  `id` int(11) NOT NULL,
  `color` varchar(100) NOT NULL,
  `status` enum('Active','Deactive') NOT NULL,
  `added_by` int(11) NOT NULL,
  `added_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `colors`
--

INSERT INTO `colors` (`id`, `color`, `status`, `added_by`, `added_on`) VALUES
(1, 'eb4090', 'Active', 1, '2021-06-26 23:29:45'),
(2, '34ebc0', 'Active', 1, '2021-06-27 13:29:09'),
(4, '13124e', 'Active', 1, '2021-06-26 23:32:19'),
(5, '13124e', 'Active', 1, '2021-06-27 17:02:29');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
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
-- Table structure for table `logins`
--

CREATE TABLE `logins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lname` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dummypass` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` enum('1','2') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '1=>Admin, 2=>users',
  `total_qr` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_hits` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profiles` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `State` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pinocde` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `added_by` int(11) NOT NULL DEFAULT 0,
  `status` enum('Pending','Active','Deactive') COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_type` enum('Free','Paid') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `logins`
--

INSERT INTO `logins` (`id`, `name`, `lname`, `email`, `password`, `dummypass`, `role`, `total_qr`, `total_hits`, `mobile`, `profiles`, `address`, `State`, `city`, `pinocde`, `added_by`, `status`, `customer_type`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'khan', 'admin@gmail.com', '$2y$10$kvwsW5Vdwf4pcvH1J7adK.C09teJC2xeLNRq1Un8ZXWJh0uenhcFe', '123456', '1', '0', '0', '9554540271', '1625245076.jpg', 'Lucknow', 'UP', 'Lucknow', '229000', 0, 'Active', 'Free', NULL, '2021-07-02 11:27:56'),
(2, 'Renu', 'Jain', 'khan@gmail.com', '$2y$10$8S.9UllyTVjlQtXYMf4t7OoogCBZ/yB6LBfpDNtO6/Um92StaCHGG', '123456', '2', '10', '5', '9078564321', '1624740173.png', 'Alkapuri Colony', 'up', 'Lucknow', '226026', 1, 'Active', 'Free', '2021-06-25 13:45:19', '2021-07-02 11:41:38'),
(3, 'khan', 'Rayees', 'khanrayees@gmail.com', '$2y$10$bNmm5JwgAQOG5kd5yoYyUuPYnMKCxZFsS0CmvX4Kxca1/zGIkBUiG', '123456', '2', '3', '18', '9078563490', '1624740320.jpg', 'Alkapuri Colony', 'Up', 'Lucknow', '226026', 1, 'Active', 'Free', '2021-06-26 15:15:20', '2021-06-26 15:15:20'),
(4, 'khan Rayees', NULL, 'khan23@gmail.com', '$2y$10$nDY4VFmoXtgvq2OfVOttnuUngZx6guzhNAKjJ8n.I1iXMk8GjsI/O', '123456', '2', '10', '15', '8967457856', '1625331506.jpg', 'Lucknow', 'up', 'lucknow', '226026', 0, 'Active', 'Free', '2021-07-03 11:28:27', '2021-07-03 11:28:27');

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2021_06_22_181314_create_qrcodes_table', 1),
(5, '2021_06_22_181804_create_logins_table', 1);

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
-- Table structure for table `qrcodes`
--

CREATE TABLE `qrcodes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `size` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `added_by` int(11) NOT NULL,
  `status` enum('Active','Deactive') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `qrcodes`
--

INSERT INTO `qrcodes` (`id`, `name`, `link`, `color`, `size`, `added_by`, `status`, `created_at`, `updated_at`) VALUES
(1, 'First Qr', 'https://google.com', '2', '1', 3, 'Active', '2021-06-27 01:54:16', '2021-06-27 05:08:05'),
(2, 'Rayees khan', 'https://shop.44kart.com/product/details/69', '4', '1', 1, 'Active', '2021-06-27 08:14:19', '2021-06-27 08:18:19'),
(3, 'Rayees khan', 'https://shop.44kart.com/product/details/69', '4', '1', 3, 'Active', '2021-06-27 08:14:19', '2021-06-27 08:18:19');

-- --------------------------------------------------------

--
-- Table structure for table `qr_traffic`
--

CREATE TABLE `qr_traffic` (
  `id` int(11) NOT NULL,
  `qr_code_id` bigint(20) DEFAULT NULL,
  `device` varchar(255) DEFAULT NULL,
  `OS` varchar(100) DEFAULT NULL,
  `browser` varchar(255) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `added_on` datetime DEFAULT NULL,
  `added_on_str` date DEFAULT NULL,
  `ip_address` varchar(100) DEFAULT NULL,
  `added_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `qr_traffic`
--

INSERT INTO `qr_traffic` (`id`, `qr_code_id`, `device`, `OS`, `browser`, `city`, `state`, `country`, `added_on`, `added_on_str`, `ip_address`, `added_by`) VALUES
(1, 2, 'Mobile', 'Window', 'Google-Chrome', 'Lucknow', 'Uttar Pradesh', 'India', '2021-06-28 05:54:42', '2021-06-28', '47.9.183.221', 3),
(2, 2, 'Mobile', 'Android', 'Google-Chrome', 'Lucknow', 'Uttar Pradesh', 'India', '2021-06-28 07:03:52', '2021-06-28', '47.9.187.224', 3),
(3, 2, 'Tablet', 'IOS', 'Google-Chrome', 'Lucknow', 'Uttar Pradesh', 'India', '2021-06-28 07:05:31', '2021-06-28', '47.9.187.224', 3),
(4, 2, 'PC', 'Window', 'Google-Chrome', 'Lucknow', 'Uttar Pradesh', 'India', '2021-06-28 07:05:38', '2021-06-29', '47.9.187.224', 3),
(5, 2, 'PC', 'Window', 'Google-Chrome', 'Lucknow', 'Uttar Pradesh', 'India', '2021-06-30 05:15:23', '2021-06-30', '47.9.67.49', 3),
(6, 2, 'PC', 'Window', 'Google-Chrome', 'Lucknow', 'Uttar Pradesh', 'India', '2021-06-30 06:05:12', '2021-06-30', '47.9.67.49', 3),
(7, 2, 'PC', 'Window', 'Google-Chrome', 'Lucknow', 'Uttar Pradesh', 'India', '2021-06-30 06:32:55', '2021-06-30', '47.9.67.49', 3),
(8, 2, 'PC', 'Window', 'Google-Chrome', 'Lucknow', 'Uttar Pradesh', 'India', '2021-06-30 06:33:56', '2021-06-30', '47.9.67.49', 3),
(9, 2, 'PC', 'Window', 'Google-Chrome', 'Lucknow', 'Uttar Pradesh', 'India', '2021-06-30 06:34:05', '2021-06-30', '47.9.67.49', 3),
(10, 2, 'PC', 'Window', 'Google-Chrome', 'Lucknow', 'Uttar Pradesh', 'India', '2021-06-30 06:34:16', '2021-06-30', '47.9.67.49', 3),
(11, 2, 'PC', 'Window', 'Google-Chrome', 'Lucknow', 'Uttar Pradesh', 'India', '2021-06-30 06:34:39', '2021-06-30', '47.9.67.49', 3),
(12, 2, 'PC', 'Window', 'Google-Chrome', 'Lucknow', 'Uttar Pradesh', 'India', '2021-06-30 06:35:26', '2021-06-30', '47.9.67.49', 3),
(13, 2, 'PC', 'Window', 'Google-Chrome', 'Lucknow', 'Uttar Pradesh', 'India', '2021-06-30 06:35:27', '2021-06-30', '47.9.67.49', 3),
(14, 2, 'PC', 'Window', 'Google-Chrome', 'Lucknow', 'Uttar Pradesh', 'India', '2021-06-30 06:35:28', '2021-06-30', '47.9.67.49', 3),
(15, 2, 'PC', 'Window', 'Google-Chrome', 'Lucknow', 'Uttar Pradesh', 'India', '2021-06-30 06:39:45', '2021-06-30', '47.9.67.49', 3),
(16, 2, 'PC', 'Window', 'Google-Chrome', 'Lucknow', 'Uttar Pradesh', 'India', '2021-06-30 06:40:55', '2021-06-30', '47.9.67.49', 3),
(17, 2, 'PC', 'Window', 'Google-Chrome', 'Lucknow', 'Uttar Pradesh', 'India', '2021-06-30 06:42:32', '2021-06-30', '47.9.67.49', 3),
(18, 2, 'PC', 'Window', 'Google-Chrome', 'Lucknow', 'Uttar Pradesh', 'India', '2021-06-30 06:44:16', '2021-06-30', '47.9.67.49', 3),
(19, 2, 'PC', 'Window', 'Google-Chrome', 'Lucknow', 'Uttar Pradesh', 'India', '2021-06-30 06:51:59', '2021-06-30', '47.9.67.49', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sizes`
--

CREATE TABLE `sizes` (
  `id` int(11) NOT NULL,
  `size` varchar(100) NOT NULL,
  `status` enum('Active','Deactive') NOT NULL,
  `added_by` int(11) NOT NULL,
  `added_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sizes`
--

INSERT INTO `sizes` (`id`, `size`, `status`, `added_by`, `added_on`) VALUES
(1, '350x350', 'Active', 1, '2021-06-26 23:47:16'),
(3, '300x300', 'Active', 1, '2021-06-27 05:31:04'),
(5, '400x400', 'Active', 1, '2021-06-26 23:47:51');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `colors`
--
ALTER TABLE `colors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `logins`
--
ALTER TABLE `logins`
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
-- Indexes for table `qrcodes`
--
ALTER TABLE `qrcodes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `qr_traffic`
--
ALTER TABLE `qr_traffic`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `colors`
--
ALTER TABLE `colors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `logins`
--
ALTER TABLE `logins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `qrcodes`
--
ALTER TABLE `qrcodes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `qr_traffic`
--
ALTER TABLE `qr_traffic`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `sizes`
--
ALTER TABLE `sizes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
