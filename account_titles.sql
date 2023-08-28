-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 18, 2022 at 04:04 AM
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
-- Table structure for table `account_titles`
--

CREATE TABLE `account_titles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title_category_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `account_titles`
--

INSERT INTO `account_titles` (`id`, `title_code`, `title_name`, `title_category_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '4-01-01-000', 'BAC Drugs & Meds', 1, '2022-10-18 01:57:13', '2022-10-18 01:57:13', NULL),
(2, '4-01-01-001', 'BAC Goods & Services', 1, '2022-10-18 01:57:13', '2022-10-18 01:57:13', NULL),
(3, '4-01-01-003', 'BAC INFRA', 1, '2022-10-18 01:57:13', '2022-10-18 01:57:13', NULL),
(4, '4-01-01-020', 'Professional Tax', 1, '2022-10-18 01:57:13', '2022-10-18 01:57:13', NULL),
(5, '4-01-02-040', 'Professional Tax-Basic (Net of Discount)', 1, '2022-10-18 01:57:13', '2022-10-18 01:57:13', NULL),
(6, '4-01-02-080', 'Real Property Transfer Tax', 1, '2022-10-18 01:57:13', '2022-10-18 01:57:13', NULL),
(7, '4-01-03-040', 'Tax on Sand, Gravel & Other Quarry Prod.', 1, '2022-10-18 01:57:13', '2022-10-18 01:57:13', NULL),
(8, '4-03-01-050', 'Tax on Delivery Trucks & Vans (General Fund-Proper)', 1, '2022-10-18 01:57:13', '2022-10-18 01:57:13', NULL),
(9, '4-03-01-060', 'Amusement Tax', 1, '2022-10-18 01:57:13', '2022-10-18 01:57:13', NULL),
(10, '4-03-01-070', 'Franchise Tax', 1, '2022-10-18 01:57:13', '2022-10-18 01:57:13', NULL),
(11, '4-03-01-080', 'Printing and Publication Tax', 1, '2022-10-18 01:57:13', '2022-10-18 01:57:13', NULL),
(12, '4-01-04-990', 'Other Taxes (Mining Claims)', 1, '2022-10-18 01:57:13', '2022-10-18 01:57:13', NULL),
(13, '4-01-05-010', 'Tax Revenue - Fines & Penalties - on Individual (PTR)', 1, '2022-10-18 01:57:13', '2022-10-18 01:57:13', NULL),
(14, '4-01-05-020', 'Tax Revenue - Fines & Penalties - Property Taxes', 1, '2022-10-18 01:57:13', '2022-10-18 01:57:13', NULL),
(15, '4-01-05-030', 'Tax Revenue - Fines & Penalties - Real Property Taxes', 1, '2022-10-18 01:57:13', '2022-10-18 01:57:13', NULL),
(16, '4-01-05-040', 'Tax Revenue - Fines & Penalties - Goods & Services', 1, '2022-10-18 01:57:13', '2022-10-18 01:57:13', NULL),
(17, '4-01-06-030', 'Share from National Wealth-Hydro', 1, '2022-10-18 01:57:13', '2022-10-18 01:57:13', NULL),
(18, '4-01-06-010', 'National Tax Collection', 1, '2022-10-18 01:57:13', '2022-10-18 01:57:13', NULL),
(19, '4-01-06-030', 'Share from National Wealth-Mining', 1, '2022-10-18 01:57:13', '2022-10-18 01:57:13', NULL),
(20, '4-01-06-010', 'Share from Internal Revenue Collections (IRA)', 1, '2022-10-18 01:57:13', '2022-10-18 01:57:13', NULL),
(21, '4-02-01-010', 'Permit Fees', 2, '2022-10-18 01:57:13', '2022-10-18 01:57:13', NULL),
(22, '4-02-01-040', 'Clearance & Certification Fees (General Fund-Proper)', 2, '2022-10-18 01:57:13', '2022-10-18 01:57:13', NULL),
(23, '4-02-01-110', 'Verification & Authentication Fees', 2, '2022-10-18 01:57:13', '2022-10-18 01:57:13', NULL),
(24, '4-02-01-070', 'Sup & Reg. Enf Fees (Animal Quarantine Fees)', 2, '2022-10-18 01:57:13', '2022-10-18 01:57:13', NULL),
(25, '4-02-01-980', 'Fines & Penalties - Service Income (General Fund-Proper)', 2, '2022-10-18 01:57:13', '2022-10-18 01:57:13', NULL),
(26, '4-02-01-990', 'Other Services Income (General Fund-Proper)', 2, '2022-10-18 01:57:13', '2022-10-18 01:57:13', NULL),
(27, '4-02-02-020', 'Registration Fees (BTS)', 2, '2022-10-18 01:57:13', '2022-10-18 01:57:13', NULL),
(28, '4-02-01-050', 'Supervision and Regulation, Enforcement Fees (Quarantine Fees)', 2, '2022-10-18 01:57:13', '2022-10-18 01:57:13', NULL),
(29, '4-02-02-020', 'Affiliation Fees', 3, '2022-10-18 01:57:13', '2022-10-18 01:57:13', NULL),
(30, '4-02-02-050', 'Rent Income', 3, '2022-10-18 01:57:13', '2022-10-18 01:57:13', NULL),
(31, '4-02-02-010', 'School Fees (BTS)', 3, '2022-10-18 01:57:13', '2022-10-18 01:57:13', NULL),
(32, '4-02-02-180', 'Sales Revenue', 3, '2022-10-18 01:57:13', '2022-10-18 01:57:13', NULL),
(33, '4-02-02-200', 'Hospital Fees', 3, '2022-10-18 01:57:13', '2022-10-18 01:57:13', NULL),
(34, '4-02-02-220', 'Interest Income', 3, '2022-10-18 01:57:13', '2022-10-18 01:57:13', NULL),
(35, '4-02-02-280', 'Fines & Penalties - Business Income (General Fund-Proper)', 3, '2022-10-18 01:57:13', '2022-10-18 01:57:13', NULL),
(36, '4-02-02-990', 'Other Business Income', 3, '2022-10-18 01:57:13', '2022-10-18 01:57:13', NULL),
(37, '4-04-02-010', 'Grants & Donations (Financial Assistance)', 4, '2022-10-18 01:57:13', '2022-10-18 01:57:13', NULL),
(38, '4-04-01-020', 'Share from PCSO (Lotto)', 4, '2022-10-18 01:57:13', '2022-10-18 01:57:13', NULL),
(39, '4-05-01-050', 'Gain on Sale of Property, Plant & Rquipment', 4, '2022-10-18 01:57:13', '2022-10-18 01:57:13', NULL),
(40, '4-06-01-010', 'Miscellaneous Income', 4, '2022-10-18 01:57:13', '2022-10-18 01:57:13', NULL),
(41, '4-04-02-100', 'Accounts Payable', 5, '2022-10-18 01:57:13', '2022-10-18 01:57:13', NULL),
(42, '4-01-02-050', 'Special Education Fund', 6, '2022-10-18 01:57:13', '2022-10-18 01:57:13', NULL),
(43, '4-01-05-020', 'Tax Revenue - Fines & Penalties-Real Property Taxes', 6, '2022-10-18 01:57:13', '2022-10-18 01:57:13', NULL),
(44, '4-02-02-220', 'Interest Income', 6, '2022-10-18 01:57:13', '2022-10-18 01:57:13', NULL),
(45, '4-06-01-010', 'Miscellaneous Income', 6, '2022-10-18 01:57:13', '2022-10-18 01:57:13', NULL),
(46, '4-06-01-010', 'Publication Cost', 7, '2022-10-18 01:57:13', '2022-10-18 01:57:13', NULL),
(47, '4-06-01-010', 'Other Payables', 7, '2022-10-18 01:57:13', '2022-10-18 01:57:13', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account_titles`
--
ALTER TABLE `account_titles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `account_titles_title_category_id_foreign` (`title_category_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account_titles`
--
ALTER TABLE `account_titles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `account_titles`
--
ALTER TABLE `account_titles`
  ADD CONSTRAINT `account_titles_title_category_id_foreign` FOREIGN KEY (`title_category_id`) REFERENCES `account_groups` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
