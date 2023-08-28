-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 18, 2022 at 04:14 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rcs_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `account_subtitles`
--

CREATE TABLE `account_subtitles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title_id` bigint(20) UNSIGNED NOT NULL,
  `subtitle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `account_subtitles`
--

INSERT INTO `account_subtitles` (`id`, `title_id`, `subtitle`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 30, 'General (Buildings/Lots/Light & Water)', '2022-10-18 01:57:13', '2022-10-18 01:57:13', NULL),
(2, 30, 'Benguet Cold Chain Operation', '2022-10-18 01:57:13', '2022-10-18 01:57:13', NULL),
(3, 30, 'Lodging (OPAG)', '2022-10-18 01:57:13', '2022-10-18 01:57:13', NULL),
(4, 30, 'Provincial Health Office (PHO)', '2022-10-18 01:57:13', '2022-10-18 01:57:13', NULL),
(5, 32, 'Gain on Sale of Drugs and Medicines-5 District Hospitals', '2022-10-18 01:57:13', '2022-10-18 01:57:13', NULL),
(6, 32, 'Gain on Sale of Accountable Forms/Printed forms', '2022-10-18 01:57:13', '2022-10-18 01:57:13', NULL),
(7, 32, 'Sale on Delivery Receipts / Books / Appl. Fees', '2022-10-18 01:57:13', '2022-10-18 01:57:13', NULL),
(8, 32, 'Sales on Agricultural Products', '2022-10-18 01:57:13', '2022-10-18 01:57:13', NULL),
(9, 32, 'Sales on Veterinary Products', '2022-10-18 01:57:13', '2022-10-18 01:57:13', NULL),
(10, 33, 'Medical, Dental, X-Ray & Laboratory', '2022-10-18 01:57:13', '2022-10-18 01:57:13', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account_subtitles`
--
ALTER TABLE `account_subtitles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `account_subtitles_title_id_foreign` (`title_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account_subtitles`
--
ALTER TABLE `account_subtitles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `account_subtitles`
--
ALTER TABLE `account_subtitles`
  ADD CONSTRAINT `account_subtitles_title_id_foreign` FOREIGN KEY (`title_id`) REFERENCES `account_titles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
