-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 31, 2022 at 11:11 AM
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
-- Table structure for table `access_p_c_s`
--

CREATE TABLE `access_p_c_s` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pc_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `assigned_ip` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `process_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `process_form` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `serial_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `access_p_c_s`
--

INSERT INTO `access_p_c_s` (`id`, `pc_name`, `assigned_ip`, `process_type`, `process_form`, `serial_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Pac', '192.168.22.222', 'Land Tax Collection', 'Form 51', 1, '2022-03-22 09:20:33', '2022-03-29 02:07:36', '2022-03-29 02:07:36'),
(2, 'Mak', '192.168.12.324', 'Land Tax Collection', 'Form 51', 1, '2022-03-22 09:20:33', '2022-03-22 09:20:33', NULL),
(3, 'Padzz', '192.168.6.75', 'Land Tax Collection', 'Form 51', 1, '2022-03-22 09:20:33', '2022-03-22 09:20:33', NULL),
(4, 'Mikee', '127.0.0.1', 'Land Tax Collection', 'Form 51', 6, '2022-03-22 09:20:33', '2022-03-22 09:20:33', NULL),
(5, 'PC UNIT 1', '192.168.2.20', 'Land Tax Collection', 'Form 51', 7, '2022-03-24 06:19:18', '2022-03-24 06:19:18', NULL),
(6, 'PC UNIT 5', '192.168.4.233', 'Land Tax Collection', 'Form 51', 10, '2022-03-28 02:27:17', '2022-03-28 02:27:17', NULL),
(7, 'PC UNIT 1', '192.168.4.232', 'Land Tax Collection', 'Form 51', 15, '2022-03-28 03:00:44', '2022-03-28 03:00:44', NULL),
(8, 'PC UNIT 3', '192.168.4.238', 'Land Tax Collection', 'Form 51', 9, '2022-03-28 03:20:58', '2022-03-29 02:20:26', '2022-03-29 02:20:26'),
(9, 'PC UNIT 2', '192.168.4.234', 'Land Tax Collection', 'Form 51', 9, '2022-03-29 02:20:46', '2022-03-29 02:20:46', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `accountable_officers`
--

CREATE TABLE `accountable_officers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `officers` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `accountable_officers`
--

INSERT INTO `accountable_officers` (`id`, `officers`, `created_at`, `updated_at`) VALUES
(1, 'IMELDA I. MACANES', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(2, 'JULIE V. ESTEBAN', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(3, 'IRENE C. BAGKING', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(4, 'MARY JANE P. LAMPACAN', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(5, 'LORENZA C. LAMSIS', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(6, 'JOANA G. COLSIM', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(7, 'MELCHOR I. DICLAS, MD', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(8, 'PURITA LESING', '2022-03-22 09:20:33', '2022-03-22 09:20:33');

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `account_id` int(10) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `account_groups`
--

CREATE TABLE `account_groups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `account_groups`
--

INSERT INTO `account_groups` (`id`, `type`, `category_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Tax Revenue', 1, '2022-03-22 09:20:33', '2022-03-22 09:20:33', NULL),
(2, 'Service Income', 1, '2022-03-22 09:20:33', '2022-03-22 09:20:33', NULL),
(3, 'Business Income', 1, '2022-03-22 09:20:33', '2022-03-22 09:20:33', NULL),
(4, 'Share, Grants & Donations/Gains/Misc. Income', 1, '2022-03-22 09:20:33', '2022-03-22 09:20:33', NULL),
(5, 'Accounts Payable', 1, '2022-03-22 09:20:33', '2022-03-22 09:20:33', NULL),
(6, 'Business Income', 2, '2022-03-22 09:20:33', '2022-03-22 09:20:33', NULL),
(7, 'Service Income', 2, '2022-03-22 09:20:33', '2022-03-22 09:20:33', NULL),
(8, 'Transfers, Assistance & Subsidy/Gain/Misc. Income', 2, '2022-03-22 09:20:33', '2022-03-22 09:20:33', NULL),
(9, 'Expenses', 2, '2022-03-22 09:20:33', '2022-03-22 09:20:33', NULL),
(10, 'Accounts Payable', 2, '2022-03-22 09:20:33', '2022-03-22 09:20:33', NULL),
(11, 'Accounts Receivable', 2, '2022-03-22 09:20:33', '2022-03-22 09:20:33', NULL),
(12, 'Tax Revenue', 3, '2022-03-22 09:20:33', '2022-03-22 09:20:33', NULL),
(13, 'Particulars', 4, '2022-03-22 09:20:33', '2022-03-22 09:20:33', NULL);

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
(1, 27, 'General (Buildings/Lots/Light & Water)', '2022-03-22 09:20:33', '2022-03-22 09:20:33', NULL),
(2, 27, 'Benguet Cold Chain Operation', '2022-03-22 09:20:33', '2022-03-22 09:20:33', NULL),
(3, 27, 'Lodging (OPAG)', '2022-03-22 09:20:33', '2022-03-22 09:20:33', NULL),
(4, 27, 'Provincial Health Office (PHO)', '2022-03-22 09:20:33', '2022-03-22 09:20:33', NULL),
(5, 28, 'Sales on Agricultural Products (BPENRO)', '2022-03-22 09:20:33', '2022-03-22 09:20:33', NULL),
(6, 28, 'Sales on Agricultural Products (OPAG)', '2022-03-22 09:20:33', '2022-03-22 09:20:33', NULL),
(7, 28, 'Sale on Delivery Receipts / Books / Appl. Fees', '2022-03-22 09:20:33', '2022-03-22 09:20:33', NULL),
(8, 28, 'Sales on Veterinary Products', '2022-03-22 09:20:33', '2022-03-22 09:20:33', NULL),
(9, 28, 'Gain on Sale of Accountable Forms/Printed forms', '2022-03-22 09:20:33', '2022-03-22 09:20:33', NULL),
(10, 28, 'Gain on Sale of Drugs and Medicines-5 District Hospitals', '2022-03-22 09:20:33', '2022-03-22 09:20:33', NULL),
(11, 29, 'Medical, Dental, X-Ray & Laboratory', '2022-03-22 09:20:33', '2022-03-22 09:20:33', NULL),
(12, 51, 'Other Payables (BTS)', '2022-03-22 09:20:33', '2022-03-22 09:20:33', NULL);

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
(1, '4-01-01-000', 'BAC Drugs & Meds', 1, '2022-03-22 09:20:33', '2022-03-22 09:20:33', NULL),
(2, '4-01-01-001', 'BAC Goods & Services', 1, '2022-03-22 09:20:33', '2022-03-22 09:20:33', NULL),
(3, '4-01-01-003', 'BAC INFRA', 1, '2022-03-22 09:20:33', '2022-03-22 09:20:33', NULL),
(4, '4-01-01-020', 'Professional Tax', 1, '2022-03-22 09:20:33', '2022-03-22 09:20:33', NULL),
(5, '4-01-02-040', 'Professional Tax-Basic (Net of Discount)', 1, '2022-03-22 09:20:33', '2022-03-22 09:20:33', NULL),
(6, '4-01-02-080', 'Real Property Transfer Tax', 1, '2022-03-22 09:20:33', '2022-03-22 09:20:33', NULL),
(7, '4-01-03-040', 'Tax on Sand, Gravel & Other Quarry Prod.', 1, '2022-03-22 09:20:33', '2022-03-22 09:20:33', NULL),
(8, '4-03-01-050', 'Tax on Delivery Trucks & Vans (General Fund-Proper)', 1, '2022-03-22 09:20:33', '2022-03-22 09:20:33', NULL),
(9, '4-03-01-060', 'Amusement Tax', 1, '2022-03-22 09:20:33', '2022-03-22 09:20:33', NULL),
(10, '4-03-01-070', 'Franchise Tax', 1, '2022-03-22 09:20:33', '2022-03-22 09:20:33', NULL),
(11, '4-03-01-080', 'Printing and Publication Tax', 1, '2022-03-22 09:20:33', '2022-03-22 09:20:33', NULL),
(12, '4-01-04-990', 'Other Taxes (Mining Claims)', 1, '2022-03-22 09:20:33', '2022-03-22 09:20:33', NULL),
(13, '4-01-05-010', 'Tax Revenue - Fines & Penalties - on Individual (PTR)', 1, '2022-03-22 09:20:33', '2022-03-22 09:20:33', NULL),
(14, '4-01-05-020', 'Tax Revenue - Fines & Penalties - Property Taxes', 1, '2022-03-22 09:20:33', '2022-03-22 09:20:33', NULL),
(15, '4-01-05-030', 'Tax Revenue - Fines & Penalties - Real Property Taxes', 1, '2022-03-22 09:20:33', '2022-03-22 09:20:33', NULL),
(16, '4-01-05-040', 'Tax Revenue - Fines & Penalties - Goods & Services', 1, '2022-03-22 09:20:33', '2022-03-22 09:20:33', NULL),
(17, '4-01-06-010', 'Share from Internal Revenue Collections (IRA)', 1, '2022-03-22 09:20:33', '2022-03-22 09:20:33', NULL),
(18, '4-01-06-030', 'Share from National Wealth-Hydro', 1, '2022-03-22 09:20:33', '2022-03-22 09:20:33', NULL),
(19, '4-02-01-010', 'Permit Fees', 2, '2022-03-22 09:20:33', '2022-03-22 09:20:33', NULL),
(20, '4-02-01-040', 'Clearancee & Certification Fees (General Fund-Proper)', 2, '2022-03-22 09:20:33', '2022-03-22 09:20:33', NULL),
(21, '4-02-01-050', 'Supervision and Regulation, Enforcement Fees (Quarantine Fees)', 2, '2022-03-22 09:20:33', '2022-03-22 09:20:33', NULL),
(22, '4-02-01-110', 'Verfication & Authentication Fees', 2, '2022-03-22 09:20:33', '2022-03-22 09:20:33', NULL),
(23, '4-02-01-070', 'Sup & Reg. Enf Fees (Animal Quarantine Fees)', 2, '2022-03-22 09:20:33', '2022-03-22 09:20:33', NULL),
(24, '4-02-01-980', 'Fines & Penalties - Service Income (General Fund-Proper)', 2, '2022-03-22 09:20:33', '2022-03-22 09:20:33', NULL),
(25, '4-02-01-990', 'Other Services Income', 2, '2022-03-22 09:20:33', '2022-03-22 09:20:33', NULL),
(26, '4-02-02-020', 'Affiliation Fees', 3, '2022-03-22 09:20:33', '2022-03-22 09:20:33', NULL),
(27, '4-02-02-050', 'Rent Income', 3, '2022-03-22 09:20:33', '2022-03-22 09:20:33', NULL),
(28, '4-02-02-180', 'Sales Revenue', 3, '2022-03-22 09:20:33', '2022-03-22 09:20:33', NULL),
(29, '4-02-02-200', 'Hospital Fees', 3, '2022-03-22 09:20:33', '2022-03-22 09:20:33', NULL),
(30, '4-02-02-220', 'Interest Income', 3, '2022-03-22 09:20:33', '2022-03-22 09:20:33', NULL),
(31, '4-02-02-980', 'Fines & Penalties - Business Income (General Fund-Proper)', 3, '2022-03-22 09:20:33', '2022-03-22 09:20:33', NULL),
(32, '4-04-02-010', 'Grants & Donations (Financial Assistance)', 4, '2022-03-22 09:20:33', '2022-03-22 09:20:33', NULL),
(33, '4-04-01-020', 'Share from PCSO (Lotto)', 4, '2022-03-22 09:20:33', '2022-03-22 09:20:33', NULL),
(34, '4-04-02-010', 'Gain on Sale of Property, Plant & Rquipment', 4, '2022-03-22 09:20:33', '2022-03-22 09:20:33', NULL),
(35, '4-04-02-010', 'Miscellaneous Income', 4, '2022-03-22 09:20:33', '2022-03-22 09:20:33', NULL),
(36, '4-04-02-100', 'Accounts Payable', 5, '2022-03-22 09:20:33', '2022-03-22 09:20:33', NULL),
(37, '4-02-02-200', 'School Fees', 6, '2022-03-22 09:20:33', '2022-03-22 09:20:33', NULL),
(38, '4-02-02-200', 'Rent Income', 6, '2022-03-22 09:20:33', '2022-03-22 09:20:33', NULL),
(39, '4-02-02-200', 'Interest Income', 6, '2022-03-22 09:20:33', '2022-03-22 09:20:33', NULL),
(40, '4-02-02-200', 'Registration Fees', 7, '2022-03-22 09:20:33', '2022-03-22 09:20:33', NULL),
(41, '4-02-02-200', 'Clearance and Certification Fees (BTS)', 7, '2022-03-22 09:20:33', '2022-03-22 09:20:33', NULL),
(42, '4-02-02-200', 'Insurance Premium', 8, '2022-03-22 09:20:33', '2022-03-22 09:20:33', NULL),
(43, '4-02-02-200', 'Supplies and Materials', 8, '2022-03-22 09:20:33', '2022-03-22 09:20:33', NULL),
(44, '4-02-02-200', 'Trainors Fee', 8, '2022-03-22 09:20:33', '2022-03-22 09:20:33', NULL),
(45, '4-02-02-200', 'Transfer of Fund', 8, '2022-03-22 09:20:33', '2022-03-22 09:20:33', NULL),
(46, '4-02-02-200', 'Subsidy from General Fund Proper', 8, '2022-03-22 09:20:33', '2022-03-22 09:20:33', NULL),
(47, '4-02-02-200', 'Gain on Sale of Property, Plant & Equipment', 8, '2022-03-22 09:20:33', '2022-03-22 09:20:33', NULL),
(48, '4-02-02-200', 'Assessment Fee', 8, '2022-03-22 09:20:33', '2022-03-22 09:20:33', NULL),
(49, '4-02-02-200', 'Other Payables', 8, '2022-03-22 09:20:33', '2022-03-22 09:20:33', NULL),
(50, '4-02-02-200', 'Taxes, Duties & Licenses', 9, '2022-03-22 09:20:33', '2022-03-22 09:20:33', NULL),
(51, '4-02-02-200', 'Miscellaneous Income', 10, '2022-03-22 09:20:33', '2022-03-22 09:20:33', NULL),
(52, '4-02-02-200', 'Accounts Receivable', 11, '2022-03-22 09:20:33', '2022-03-22 09:20:33', NULL),
(53, '4-01-02-050', 'Special Education Fund', 12, '2022-03-22 09:20:33', '2022-03-22 09:20:33', NULL),
(54, '4-01-05-020', 'Tax Revenue - Fines & Penalties-Real Property Taxes', 12, '2022-03-22 09:20:33', '2022-03-22 09:20:33', NULL),
(55, '4-02-02-220', 'Interest Income', 12, '2022-03-22 09:20:33', '2022-03-22 09:20:33', NULL),
(56, '4-06-01-010', 'Miscellaneous Income', 12, '2022-03-22 09:20:33', '2022-03-22 09:20:33', NULL),
(57, '4-06-01-010', 'Publication Cost', 13, '2022-03-22 09:20:33', '2022-03-22 09:20:33', NULL),
(58, '4-06-01-010', 'Other Payables', 13, '2022-03-22 09:20:33', '2022-03-22 09:20:33', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `barangays`
--

CREATE TABLE `barangays` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `mun_id` bigint(20) UNSIGNED NOT NULL,
  `barangay_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `barangays`
--

INSERT INTO `barangays` (`id`, `mun_id`, `barangay_name`, `created_at`, `updated_at`) VALUES
(1, 1, 'Poblacion', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(2, 1, 'Abiang', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(3, 1, 'Caliking', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(4, 1, 'Cattubo', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(5, 1, 'Naguey', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(6, 1, 'Paoay', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(7, 1, 'Pasdong', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(8, 1, 'Topdac', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(9, 2, 'Poblacion', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(10, 2, 'Ampusongan', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(11, 2, 'Bagu', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(12, 2, 'Dalipey', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(13, 2, 'Gambang', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(14, 2, 'Kayapa', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(15, 2, 'Sinacbat', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(16, 3, 'Poblacion', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(17, 3, 'Ambuclao', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(18, 3, 'Bila', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(19, 3, 'Bobok-Bisal', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(20, 3, 'Daclan', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(21, 3, 'Ekip', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(22, 3, 'Karao', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(23, 3, 'Nawal', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(24, 3, 'Pito', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(25, 3, 'Tikey', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(26, 4, 'Poblacion', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(27, 4, 'Abatan', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(28, 4, 'Amgaleyguey', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(29, 4, 'Amlimay', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(30, 4, 'Baculongan Norte', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(31, 4, 'Baculongan Sur', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(32, 4, 'Bangao', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(33, 4, 'Buyacaoan', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(34, 4, 'Calamagan', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(35, 4, 'Catlubong', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(36, 4, 'Lengaoan', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(37, 4, 'Loo', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(38, 4, 'Natubleng', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(39, 4, 'Sebang', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(40, 5, 'Poblacion', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(41, 5, 'Ampucao', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(42, 5, 'Dalupirip', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(43, 5, 'Gumatdang', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(44, 5, 'Loakan', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(45, 5, 'Tinongdan', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(46, 5, 'Tuding', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(47, 5, 'Ucab', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(48, 5, 'Virac', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(49, 6, 'Poblacion', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(50, 6, 'Adaoay', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(51, 6, 'Anchokey', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(52, 6, 'Bashoy', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(53, 6, 'Ballay', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(54, 6, 'Batan', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(55, 6, 'Duacan', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(56, 6, 'Eddet', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(57, 6, 'Gusaran', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(58, 6, 'Kabayan Barrio', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(59, 6, 'Lusod', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(60, 6, 'Pacso', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(61, 6, 'Tawangan', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(62, 7, 'Central', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(63, 7, 'Balakbak', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(64, 7, 'Beleng-Belis', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(65, 7, 'Boklaoan', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(66, 7, 'Cayapes', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(67, 7, 'Cuba', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(68, 7, 'Datakan', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(69, 7, 'Gadang', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(70, 7, 'Gaswiling', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(71, 7, 'Labueg', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(72, 7, 'Paykek', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(73, 7, 'Pudong', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(74, 7, 'Pongayan', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(75, 7, 'Sagubo', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(76, 7, 'Taba-ao', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(77, 8, 'Poblacion', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(78, 8, 'Badeo', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(79, 8, 'Lubo', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(80, 8, 'Madaymen', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(81, 8, 'Palina', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(82, 8, 'Sagpat', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(83, 8, 'Tacadang', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(84, 9, 'Poblacion', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(85, 9, 'Alapang', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(86, 9, 'Alno', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(87, 9, 'Ambiong', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(88, 9, 'Bahong', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(89, 9, 'Balili', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(90, 9, 'Beckel', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(91, 9, 'Bineng', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(92, 9, 'Betag', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(93, 9, 'Cruz', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(94, 9, 'Lubas', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(95, 9, 'Pico', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(96, 9, 'Puguis', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(97, 9, 'Shilan', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(98, 9, 'Tawang', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(99, 9, 'Wangal', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(100, 10, 'Poblacion', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(101, 10, 'Balili', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(102, 10, 'Bedbed', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(103, 10, 'Bulalacao', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(104, 10, 'Cabiten', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(105, 10, 'Colalo', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(106, 10, 'Guinaoang', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(107, 10, 'Paco', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(108, 10, 'Suyoc', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(109, 10, 'Sapid', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(110, 10, 'Tabio', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(111, 10, 'Taneg', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(112, 11, 'Poblacion', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(113, 11, 'Bagong', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(114, 11, 'Balluay', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(115, 11, 'Banangan', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(116, 11, 'Banengbeng', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(117, 11, 'Bayabas', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(118, 11, 'Kamog', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(119, 11, 'Pappa', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(120, 12, 'Poblacion', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(121, 12, 'Ansagan', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(122, 12, 'Camp 1', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(123, 12, 'Camp 3', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(124, 12, 'Camp 4', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(125, 12, 'Nangalisan', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(126, 12, 'San Pascual', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(127, 12, 'Tabaan Norte', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(128, 12, 'Tabaan Sur', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(129, 12, 'Tadiangan', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(130, 12, 'Taloy Norte', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(131, 12, 'Taloy Sur', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(132, 12, 'Twin Peaks', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(133, 13, 'Caponga (Pob.)', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(134, 13, 'Ambassador', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(135, 13, 'Ambongdolan', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(136, 13, 'Ba-ayan', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(137, 13, 'Basil', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(138, 13, 'Tublay Central', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(139, 13, 'Daclan', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(140, 13, 'Tuel', '2022-03-22 09:20:33', '2022-03-22 09:20:33');

-- --------------------------------------------------------

--
-- Table structure for table `budget_estimates`
--

CREATE TABLE `budget_estimates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `group_id` bigint(20) UNSIGNED NOT NULL,
  `title_id` bigint(20) UNSIGNED NOT NULL,
  `year` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `certifications`
--

CREATE TABLE `certifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `land_tax_info_id` bigint(20) UNSIGNED NOT NULL,
  `cert_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cert_date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cert_prepared_by` bigint(20) UNSIGNED DEFAULT NULL,
  `cert_signee` bigint(20) UNSIGNED DEFAULT NULL,
  `second_signee` bigint(20) UNSIGNED DEFAULT NULL,
  `prov_governor` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cert_recipient` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cert_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cert_entries_from` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cert_entries_to` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cert_details` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notary_public` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ptr_number` int(11) DEFAULT NULL,
  `doc_number` int(11) DEFAULT NULL,
  `page_number` int(11) DEFAULT NULL,
  `book_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cert_series` int(11) DEFAULT NULL,
  `ref_num` int(11) DEFAULT NULL,
  `sg_processed` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `agg_basecourse` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `less_sandandgravel` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `less_boulders` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prov_certclearance` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prov_certtype` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prov_certbidding` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `certifications`
--

INSERT INTO `certifications` (`id`, `land_tax_info_id`, `cert_type`, `cert_date`, `cert_prepared_by`, `cert_signee`, `second_signee`, `prov_governor`, `cert_recipient`, `cert_address`, `cert_entries_from`, `cert_entries_to`, `cert_details`, `notary_public`, `ptr_number`, `doc_number`, `page_number`, `book_number`, `cert_series`, `ref_num`, `sg_processed`, `agg_basecourse`, `less_sandandgravel`, `less_boulders`, `prov_certclearance`, `prov_certtype`, `prov_certbidding`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 2, 'Transfer Tax', 'March 23, 2022', 3, 1, NULL, 'MELCHOR D. DICLAS, MD', 'ASLAG, KRISTINE K.', 'CASTRO address', NULL, NULL, '<div>Transfer Tax Receipt Remarks of ASLAG</div>', '<p>Atty. Delarosa</p>', 8673973, 182, 38, 'XII', 2022, NULL, NULL, NULL, NULL, NULL, '2022-155', 'Renewal', 1, '2022-03-23 03:36:15', '2022-03-23 03:36:15', NULL),
(3, 3, 'Provincial Permit', 'March 23, 2022', NULL, 1, NULL, 'MELCHOR D. DICLAS, MD', 'CASTRO, JEMINEZ REL S.', 'Sample Address', NULL, NULL, '<div>Provincial Permit Receipt Remarks of CASTRO</div>', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-108', 'Renewal', 1, '2022-03-23 03:45:51', '2022-03-23 05:53:52', NULL),
(9, 9, 'Provincial Permit', 'March 24, 2022', NULL, 1, NULL, 'MELCHOR D. DICLAS, MD', 'HALIB, MICHELLE Q.', 'Address numba 1', NULL, NULL, '<div>Receipt Remarks Provincial permit</div>', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-150', 'New', 0, '2022-03-23 07:00:15', '2022-03-24 02:26:50', NULL),
(12, 12, 'Provincial Permit', 'March 24, 2022', NULL, 1, NULL, 'MELCHOR D. DICLAS, MD', 'PADISIT, EDA L.', 'Sample Adress of Eda', NULL, NULL, '<div>ASDADASasda</div>', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-180', 'New', 1, '2022-03-24 00:50:49', '2022-03-24 00:50:49', NULL),
(33, 33, 'Transfer Tax', 'March 28, 2022', 3, 1, NULL, 'null', 'PACHEO, CHRISTIAN LOUIE P.', NULL, NULL, NULL, '<div><strong>TCT.No.T-24529/ ARP.No.2010-06-01-00334</strong></div>\r\n<div><strong>Acop, Caponga, Tublay, Benguet</strong></div>', '<p>asdad</p>', 6867701, 469, 87, 'LII', 2021, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-28 03:38:57', '2022-03-28 03:59:54', NULL),
(35, 35, 'Transfer Tax', 'March 28, 2022', 3, 1, 5, 'null', 'BALANGAY, ROMEO S.', NULL, NULL, NULL, '<div>ARP Nos. 2010-13-01-00623; 2010-13-01-00739; 2010-13-01-02358; 2010-13-01-00682; 2010-13-01-00744; 2010-13-01-01644</div>\r\n<div>Poblacion, Bokod, Benguet</div>', '<p><span style=\"text-decoration: underline;\"><strong>ATTY. ERIK DONN IGNACIO</strong></span></p>', 6364112, 418, 84, '21', 2021, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-28 04:03:14', '2022-03-28 08:45:22', NULL),
(36, 36, 'Sand & Gravel', 'March 28, 2022', NULL, 1, NULL, 'null', 'A. G Chungalan Construction By: Amalia G. Chungalan', '97 Happy Homes, Magsaysay Avenue, Baguio City', NULL, NULL, '<div>dasdsadas</div>', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-28 08:53:10', '2022-03-28 08:53:10', NULL),
(45, 45, 'Provincial Permit', 'March 29, 2022', 1, 1, NULL, 'MELCHOR D. DICLAS, MD', 'TINTO, JENNIFER G.', 'Other address', NULL, NULL, '<div>Sample Provincial Receipt</div>', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-122', 'New', 1, '2022-03-29 06:22:10', '2022-03-29 06:28:15', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cert_officers`
--

CREATE TABLE `cert_officers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `officer_id` bigint(20) UNSIGNED NOT NULL,
  `position_id` bigint(20) UNSIGNED NOT NULL,
  `department_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cert_officers`
--

INSERT INTO `cert_officers` (`id`, `officer_id`, `position_id`, `department_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 1, '2022-03-22 09:20:33', '2022-03-22 09:20:33', NULL),
(2, 2, 2, 1, '2022-03-22 09:20:33', '2022-03-22 09:20:33', NULL),
(3, 3, 3, 1, '2022-03-22 09:20:33', '2022-03-22 09:20:33', NULL),
(4, 4, 4, 1, '2022-03-22 09:20:33', '2022-03-22 09:20:33', NULL),
(5, 5, 5, 1, '2022-03-22 09:20:33', '2022-03-22 09:20:33', NULL),
(6, 6, 6, 2, '2022-03-22 09:20:33', '2022-03-22 09:20:33', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `collections_deposits`
--

CREATE TABLE `collections_deposits` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `collection_rates`
--

CREATE TABLE `collection_rates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `acc_titles_id` bigint(20) UNSIGNED DEFAULT NULL,
  `acc_subtitles_id` bigint(20) UNSIGNED DEFAULT NULL,
  `rate_change_id` bigint(20) UNSIGNED DEFAULT NULL,
  `shared_status` int(11) DEFAULT NULL,
  `provincial_share` decimal(8,2) DEFAULT NULL,
  `municipal_share` decimal(8,2) DEFAULT NULL,
  `barangay_share` decimal(8,2) DEFAULT NULL,
  `rate_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fixed_rate` decimal(8,2) DEFAULT NULL,
  `percent_value` decimal(8,2) DEFAULT NULL,
  `percent_of` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deadline_status` int(11) DEFAULT NULL,
  `rate_after_deadline` decimal(8,2) DEFAULT NULL,
  `deadline_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `collection_rates`
--

INSERT INTO `collection_rates` (`id`, `acc_titles_id`, `acc_subtitles_id`, `rate_change_id`, `shared_status`, `provincial_share`, `municipal_share`, `barangay_share`, `rate_type`, `fixed_rate`, `percent_value`, `percent_of`, `deadline_status`, `rate_after_deadline`, `deadline_date`, `created_at`, `updated_at`) VALUES
(1, 4, NULL, 1, 0, NULL, NULL, NULL, 'Schedule', NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(2, 6, NULL, 1, 0, NULL, NULL, NULL, 'Percent', NULL, '50.00', 'Given Value', 0, NULL, NULL, '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(3, 7, NULL, 1, 1, '30.00', '30.00', '40.00', 'Schedule', NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(4, 8, NULL, 1, 0, NULL, NULL, NULL, 'Schedule', NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(5, 9, NULL, 1, 1, '50.00', '50.00', '0.00', 'Percent', NULL, '50.00', 'Given Value', 0, NULL, NULL, '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(6, 10, NULL, 1, 0, NULL, NULL, NULL, 'Percent', NULL, '50.00', 'Given Value', 0, NULL, NULL, '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(7, 11, NULL, 1, 0, NULL, NULL, NULL, 'Percent', NULL, '50.00', 'Given Value', 1, '2.00', '01/21', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(8, 12, NULL, 1, 0, NULL, NULL, NULL, 'Manual', NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(9, 13, NULL, 1, 0, NULL, NULL, NULL, 'Percent', NULL, '25.00', 'Total', 1, '2.00', '01/01', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(10, 14, NULL, 1, 0, NULL, NULL, NULL, 'Percent', NULL, '25.00', 'Total', 1, '2.00', NULL, '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(11, 15, NULL, 1, 0, NULL, NULL, NULL, 'Percent', NULL, '25.00', 'Total', 1, '2.00', NULL, '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(12, 16, NULL, 1, 0, NULL, NULL, NULL, 'Percent', NULL, '25.00', 'Total', 1, '2.00', '01/20', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(13, 19, NULL, 1, 0, NULL, NULL, NULL, 'Schedule', NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(14, 20, NULL, 1, 0, NULL, NULL, NULL, 'Schedule', NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(15, 21, NULL, 1, 0, NULL, NULL, NULL, 'Schedule', NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(16, 22, NULL, 1, 0, NULL, NULL, NULL, 'Schedule', NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(17, 24, NULL, 1, 0, NULL, NULL, NULL, 'Percent', NULL, '25.00', 'Total', 1, '2.00', '01/20', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(18, NULL, 1, 1, 0, NULL, NULL, NULL, 'Schedule', NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(19, NULL, 2, 1, 0, NULL, NULL, NULL, 'Schedule', NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(20, NULL, 5, 1, 0, NULL, NULL, NULL, 'Schedule', NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(21, NULL, 7, 1, 0, NULL, NULL, NULL, 'Schedule', NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(22, NULL, 8, 1, 0, NULL, NULL, NULL, 'Schedule', NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(23, 31, NULL, 1, 0, NULL, NULL, NULL, 'Percent', NULL, '10.00', 'Total', 1, '2.00', NULL, '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(24, 35, NULL, 1, 0, NULL, NULL, NULL, 'Schedule', NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(25, 37, NULL, 1, 0, NULL, NULL, NULL, 'Schedule', NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(26, 40, NULL, 1, 0, NULL, NULL, NULL, 'Fixed', '350.00', NULL, NULL, NULL, NULL, NULL, '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(27, 41, NULL, 1, 0, NULL, NULL, NULL, 'Fixed', '100.00', NULL, NULL, NULL, NULL, NULL, '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(28, 42, NULL, 1, 0, NULL, NULL, NULL, 'Fixed', '50.00', NULL, NULL, NULL, NULL, NULL, '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(29, 18, NULL, 2, 0, NULL, NULL, NULL, 'Fixed', '0.00', NULL, NULL, NULL, NULL, NULL, '2022-03-29 03:12:49', '2022-03-29 03:12:49');

-- --------------------------------------------------------

--
-- Table structure for table `contractors`
--

CREATE TABLE `contractors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `contractor_id` int(10) UNSIGNED NOT NULL,
  `business_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Manager',
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contractors`
--

INSERT INTO `contractors` (`id`, `contractor_id`, `business_name`, `owner`, `position`, `address`, `contact_number`, `status`, `created_at`, `updated_at`) VALUES
(0, 4, '3K Rock Engineering', 'Francis B. Cuyop', 'Manager', '#110  Andres Bonifacio, Diffun Quirino/Badiwan Poblacion Tuba, Benguet', '424 4382/9554130644', 'active', '2020-12-15 00:34:14', '2020-12-15 00:34:14'),
(0, 5, 'Akip Construction and Enterprise', 'Bobby T. Wayan', 'Manager', 'Ad 108-H Poblacion, La Trinidad, Benguet', '9222555333/620-2916', 'active', '2020-12-15 00:34:14', '2020-12-15 00:34:14'),
(0, 6, 'ADL General Construction', 'Delfin A. Alawas', 'Manager', 'Kb 65 Samoyao Cruz', '9082853575', 'active', '2020-12-15 00:34:14', '2020-12-15 00:34:14'),
(0, 7, 'Alcel Construction', 'Alexander M. Ang', 'Manager', 'Alaminos, Pangasinan', '', 'active', '2020-12-15 00:34:14', '2020-12-15 00:34:14'),
(0, 8, 'Aip Construction', 'Arnel I. Peil', 'Manager', 'Unit 111-B Egi Albergo Hotel #1 Villamor Drive Brgy, Lualhati, Baguio City', '424-6179/483-03-73', 'active', '2020-12-15 00:34:14', '2020-12-15 00:34:14'),
(0, 9, 'Ampsleo Construction', 'Valentin B. Leo', 'Manager', 'LB 06 Rocky Side 1, Lubas, La Trinidad, Benguet', '9304063349/09190014535', 'active', '2020-12-15 00:34:14', '2020-12-15 00:34:14'),
(0, 10, 'A.P.B Construction', 'Armando Baldonado', 'Manager', '#36 North Sto. Tomas Rd., Baguio City', '9274875523', 'active', '2020-12-15 00:34:14', '2020-12-15 00:34:14'),
(0, 11, 'Anas Construction', 'Dionisio L.  Anas', 'Manager', 'Monglo, Bayabas, Sablan, Benguet', '9502311172', 'active', '2020-12-15 00:34:14', '2020-12-15 00:34:14'),
(0, 12, 'Aroboan Construction And Supply', 'Roboan B. Alvarez', 'Manager', 'Fc 423 Central St., Balili, La Trinidad, Benguet/ Kabayan, Benguet', '9089448512', 'active', '2020-12-15 00:34:14', '2020-12-15 00:34:14'),
(0, 13, 'Akiki Builders', 'Ruben L. Aguinse', 'Manager', 'Duacan, Kabayan, Benguet', '9289641291', 'active', '2020-12-15 00:34:14', '2020-12-15 00:34:14'),
(0, 14, 'Aljune Builders', 'Alma G. Domagto', 'Manager', '43 Sabkil, Loacan, Itogon, Benguet', '9995766070/09277957587', 'active', '2020-12-15 00:34:14', '2020-12-15 00:34:14'),
(0, 15, 'Anitos Construction', 'Marty G. Manayos', 'Manager', 'Alapang , La Trinidad', '9082993533', 'active', '2020-12-15 00:34:14', '2020-12-15 00:34:14'),
(0, 16, 'A. G Chungalan Construction', 'Amalia G. Chungalan', 'Manager', 'Ngibil Poblacion, Bokod', '9081683861', 'active', '2020-12-15 00:34:14', '2020-12-15 00:34:14'),
(0, 17, 'Aguinsod General Construction', 'Christopher A. Aglolo', 'Manager', 'Ma Puguis, La Trinidad, Benguet', '9987740981', 'active', '2020-12-15 00:34:14', '2020-12-15 00:34:14'),
(0, 18, 'Apaklo Kin Construction And Engineering Services', 'Domingo M. Suni-En', 'Manager', 'Ampusongan, Bakun, Benguet', '0949458479/09273830466', 'active', '2020-12-15 00:34:14', '2020-12-15 00:34:14'),
(0, 19, 'Bldy Engineering And Construction', 'Victor L. Datic Jr', 'Manager', '726 Camp Allen, Baguio City', '9078691483', 'active', '2020-12-15 00:34:14', '2020-12-15 00:34:14'),
(0, 20, 'Balangcod Construction', 'Fermin D. Balangcod', 'Manager', 'Gambang, Cuba, Kapangan, Benguet/ JF 01-4 Toyong, Pico, La Trinidad Benguet', '9282665747', 'active', '2020-12-15 00:34:14', '2020-12-15 00:34:14'),
(0, 21, 'Balbalin Engineering And Construction', 'Dorotheo B. Aligo', 'Manager', 'Ae 227-C West Buyagan Poblacion, La Trinidad, Benguet', '9477261879', 'active', '2020-12-15 00:34:14', '2020-12-15 00:34:14'),
(0, 22, 'Bosongan Construction', 'Jun Jun E. Wag-E', 'Manager', 'Oa-95 Km. 9 Tawang, La Trinidad, Benguet', '9296915400', 'active', '2020-12-15 00:34:14', '2020-12-15 00:34:14'),
(0, 23, 'BTCJR Construction And Engineering Services', 'Bandolin T. Cariño Jr.', 'Manager', 'km 73, Junction, Amgaleyguey, Buguias, Benguet/Lubos Compound, km 5 Pico, La Trinidad, Benguet', '9192068011/09396433057', 'active', '2020-12-15 00:34:14', '2020-12-15 00:34:14'),
(0, 24, 'Buganheirs Engineering & Construction', 'Allan Fuchigami', 'Manager', 'Pico, La Trinidad,Benguet', '9989898114', 'active', '2020-12-15 00:34:14', '2020-12-15 00:34:14'),
(0, 25, 'Bolos Engineering And Construction ', 'Edgar B. Baclawad', 'Manager', 'A72-2 Poblacion, La Trinidad, Benguet', '9083133130', 'active', '2020-12-15 00:34:14', '2020-12-15 00:34:14'),
(0, 26, 'Bemada Construction', 'Beny M. Daliling', 'Manager', '#322 Mangga Tuding, Itogon, Benguet', '9194125313', 'active', '2020-12-15 00:34:14', '2020-12-15 00:34:14'),
(0, 27, 'Baldas Construction', 'Samson B. Benny', 'Manager', 'Camanpaguey, Cabiten, Mankayan, Benguet', '09122715120', 'active', '2020-12-15 00:34:14', '2020-12-15 00:34:14'),
(0, 28, 'Compass Rose Builders', 'Daniel T. Sibelius', 'Manager', 'Acop, Tublay, Benguet', '9209284618', 'active', '2020-12-15 00:34:14', '2020-12-15 00:34:14'),
(0, 29, 'Cliff Construction And Aggregates', 'Junifer Bosleng', 'Manager', 'Ae-131 Buyagan, La Trinidad, Benguet', '9285003157', 'active', '2020-12-15 00:34:14', '2020-12-15 00:34:14'),
(0, 30, 'Cps Engineering Construction', 'Crisanto P. Sagayo Jr.', 'Manager', 'Boga, Mohamon Sur, Bauko, Mountain Province', '9302590300', 'active', '2020-12-15 00:34:14', '2020-12-15 00:34:14'),
(0, 31, 'Donato-Sakiwat Construction', 'Jerome Stephen D. Sakiwat', 'Manager', 'Tabio, Mankayan, Benguet', '9189858759', 'active', '2020-12-15 00:34:14', '2020-12-15 00:34:14'),
(0, 32, 'Drichloui Construction', 'Roy M. Balay-Odao', 'Manager', 'Gambang, Bakun, Benguet', '9284045948', 'active', '2020-12-15 00:34:14', '2020-12-15 00:34:14'),
(0, 33, 'Djy Construction', 'Delia A. Yubos', 'Manager', '#193 Tin Street, Upper Quezon Hill, Baguio City', '9399162752', 'active', '2020-12-15 00:34:14', '2020-12-15 00:34:14'),
(0, 34, 'Dmcd Engineering And Construction', 'Dennis Molintas C. De Ausen', 'Manager', '21b Purok 2, Km3, Asin Road, Baguio City', '9308961673', 'active', '2020-12-15 00:34:14', '2020-12-15 00:34:14'),
(0, 35, 'Dipas Builders', 'Marcial  P.  Mascay', 'Manager', 'Pinagayan, Sapid, Mankayan', '9396293935', 'active', '2020-12-15 00:34:14', '2020-12-15 00:34:14'),
(0, 36, 'Eugao Construction', 'Eugenio O. Aglasi', 'Manager', 'Palasaan, Mankayan, Benguet', '9072481130', 'active', '2020-12-15 00:34:14', '2020-12-15 00:34:14'),
(0, 37, 'Efler Construction And Enterprise', 'Efler M. Sab-It', 'Manager', 'Acop Caponga Tublay Benguet', '9985308951', 'active', '2020-12-15 00:34:14', '2020-12-15 00:34:14'),
(0, 38, 'EBTitiwa Gen. Engineering And Construction Services', 'Eduardo B. Titiwa', 'Manager', 'Ac 74 Eastern Buyagan, Poblacion, La Trinidad', '09216868510', 'active', '2020-12-15 00:34:14', '2020-12-15 00:34:14'),
(0, 39, 'FMC Warrior\'s Construction', 'Federico M. Calinsuay', 'Manager', 'JA 328 Peril Pico, La Trinidad, Benguet/Sinacbat, Bakun, Benguet', '09093300555', 'active', '2020-12-15 00:34:14', '2020-12-15 00:34:14'),
(0, 40, 'Family Circle Construction', 'Marcos P. Luma-Ang', 'Manager', 'Km. 12 Senly Loy Building, Shilan, La Trinidad, Benguet', '9124626700', 'active', '2020-12-15 00:34:14', '2020-12-15 00:34:14'),
(0, 41, 'Four Brothers Construction', 'Carlito B. Alos', 'Manager', 'Batan, Kabayan, Benguet', '9199891488', 'active', '2020-12-15 00:34:14', '2020-12-15 00:34:14'),
(0, 42, 'Guardian Construction', 'Ruben B. Pacheco Jr.', 'Manager', 'Ad-021 Central Buyagan, Poblacion, La Trinidad', '9089197446', 'active', '2020-12-15 00:34:14', '2020-12-15 00:34:14'),
(0, 43, 'Gacoscos Construction', 'Ronald Allan Gacoscos', 'Manager', '#16 Laubach Rd., Upper General Luna Baguio City', '09174354122/09184817714', 'active', '2020-12-15 00:34:14', '2020-12-15 00:34:14'),
(0, 44, 'Hgw=3 Engineering And Construction', 'Hilbert B. Willie', 'Manager', 'Poblacion, Sablan, Benguet', '9083041693', 'active', '2020-12-15 00:34:14', '2020-12-15 00:34:14'),
(0, 45, 'Hdg Construction And Enterprises', 'Hanivall D. Guilando', 'Manager', 'Fd 232 Pines Park, Km. 4, Balili, La Trinidad, Benguet', '0999-925-8238', 'active', '2020-12-15 00:34:14', '2020-12-15 00:34:14'),
(0, 46, 'Haight\'s Construction', 'Noel G. Haight', 'Manager', '218-A Dapiting, Alapang, La Trinidad, Benguet/ km 6 Dangwa Square, La Trinidad, Benguet', '9468179021', 'active', '2020-12-15 00:34:14', '2020-12-15 00:34:14'),
(0, 47, 'Hillbrand Engineering', 'Hildobrando S. Beray', 'Manager', 'MD 192 Balite, Longlong, Puguis, La Trinidad', '9475342075/074-620-5953', 'active', '2020-12-15 00:34:14', '2020-12-15 00:34:14'),
(0, 48, 'Ico Construction Services', 'Jerico A. Palangdan', 'Manager', 'Tuding, Itogon, Benguet', '9088206429', 'active', '2020-12-15 00:34:14', '2020-12-15 00:34:14'),
(0, 49, 'Juricmarc ', 'Corazon G. Pago', 'Manager', 'Bekes, Taneg Mankayan', '9102938868', 'active', '2020-12-15 00:34:14', '2020-12-15 00:34:14'),
(0, 50, 'Jamil Sean Construction', 'Barmino T. Bugnay', 'Manager', 'Pa 295 A, Wangal, La Trinidad, Benguet', '9202118300', 'active', '2020-12-15 00:34:14', '2020-12-15 00:34:14'),
(0, 51, 'Jca General Construction And Eng\'g Services', 'Joel C. Adian', 'Manager', 'Buhaw, Puguis, La Trinidad, Benguet', '9297258644', 'active', '2020-12-15 00:34:14', '2020-12-15 00:34:14'),
(0, 52, 'Jomarcann Gen. Construction', 'Joselito O. Tan', 'Manager', 'No. 1 Lower Q.M Subdivision, Baguio City', '9095478526', 'active', '2020-12-15 00:34:14', '2020-12-15 00:34:14'),
(0, 53, 'JYP General Construction', 'Yonie S. Palonan', 'Manager', 'AD 132-B Cental Buyagan, La Trinidad, Benguet', '9185806990\\09635111393', 'active', '2020-12-15 00:34:14', '2020-12-15 00:34:14'),
(0, 54, 'Kuatako Construction & General Contractor', 'Harry L. Ciriaco Sr.', 'Manager', 'Ap-066 Ambiong, La Trinidad, Benguet', '9089043440', 'active', '2020-12-15 00:34:14', '2020-12-15 00:34:14'),
(0, 55, 'Kalahan Construction And Supplies', 'CASIO G. Paris Jr.', 'Manager', 'MA-17, PUGUIS, La Trinidad, Benguet/ IB-82, BETAG LTB', '9476007980/09277783715/074-424-7389', 'active', '2020-12-15 00:34:14', '2020-12-15 00:34:14'),
(0, 56, 'KVC Construction', 'Victorino M. Balaodan', 'Manager', 'Pa 399-D Upper Wangal, La Trinidad, Benguet', '9509499005', 'active', '2020-12-15 00:34:14', '2020-12-15 00:34:14'),
(0, 57, 'Lincee General Construction And General Merchandise', 'Jeremy B. Darcio', 'Manager', 'Acop, Caponga, Tublay, Benguet', '9082018754', 'active', '2020-12-15 00:34:14', '2020-12-15 00:34:14'),
(0, 58, 'Mk Construction', 'Francis V. Kaniteng', 'Manager', '876 Midas, Ucab, Itogon, Benguet', '9397304695/09618146052/09460157277', 'active', '2020-12-15 00:34:14', '2020-12-15 00:34:14'),
(0, 59, 'Macgat Construction', 'Macreson L. Gatab', 'Manager', 'Bad-Ayan, Baculongan Sur, Buguias, Benguet', '09291874465 / 09097744019', 'active', '2020-12-15 00:34:14', '2020-12-15 00:34:14'),
(0, 60, 'Malco Construction', 'Malote S. Copite', 'Manager', 'Taneg, Mankayan/ IA 96, Betag, La Trinidad, Benguet', '9999835008', 'active', '2020-12-15 00:34:14', '2020-12-15 00:34:14'),
(0, 61, 'Mandiit Construction Services', 'Felicito G. Bang-Ngit', 'Manager', 'PA-004b Upper Wangal, La Trinidad, Benguet', '9121300491/09502032269', 'active', '2020-12-15 00:34:14', '2020-12-15 00:34:14'),
(0, 62, 'Nair Construction And Engineering', 'Andrew L. Bagano', 'Manager', 'Central Poblacio, Bakun, Benguet', '90720587047', 'active', '2020-12-15 00:34:14', '2020-12-15 00:34:14'),
(0, 63, 'N-J Constructionz', 'Nestor G. Sanchez', 'Manager', 'Poblacion, Ambaguio, Nueva Vizcaya', '09296715522 / 09164948997 / 09503200960', 'active', '2020-12-15 00:34:14', '2020-12-15 00:34:14'),
(0, 64, 'On Top Construction', 'Thomas Palileng', 'Manager', 'Km. 90 Halsema Hingway, Buguias, Benguet', '9185332348', 'active', '2020-12-15 00:34:14', '2020-12-15 00:34:14'),
(0, 65, 'Organic Construction And Aggregates', 'Jeb C. Constancio', 'Manager', 'La-54 Lubas Km. 4 La Trinidad, Benguet', '0999-3976-058', 'active', '2020-12-15 00:34:14', '2020-12-15 00:34:14'),
(0, 66, 'Potpotan General Construction', 'Loradel P. Lim', 'Manager', 'Buyacaoan, Buguias, Benguet', '9218503099', 'active', '2020-12-15 00:34:14', '2020-12-15 00:34:14'),
(0, 67, 'Pulicay Grandson\'s Construction', 'Reynaldo P. Monte', 'Manager', 'Ampusongan, Bakun, Benguet', '9106119888', 'active', '2020-12-15 00:34:14', '2020-12-15 00:34:14'),
(0, 68, 'P.G Velasco Construction', 'Pio G. Velasco', 'Manager', 'No. 79 Upper Diego Silang St., Baguio City', '9064125137', 'active', '2020-12-15 00:34:14', '2020-12-15 00:34:14'),
(0, 69, 'Precious Gold Builders', 'Richard O Liis', 'Manager', 'Madaymen, Kibungan, Benguet/ Rm. #E, 3f Bsu Mpc Bldg., Balili, Ltb/', '9399162750', 'active', '2020-12-15 00:34:14', '2020-12-15 00:34:14'),
(0, 70, 'Quegues Builders And Enterprises', 'Remy J. Kigis', 'Manager', '# 064 SAMOYAO, AMPUCAO, ITOGON, BENGUET', '9106895477/09184294905', 'active', '2020-12-15 00:34:14', '2020-12-15 00:34:14'),
(0, 71, 'Reasons Construction And Supplies', 'Epie G. Abalos', 'Manager', 'JC-259 Pico, La Trinidad, Benguet', '9294991892', 'active', '2020-12-15 00:34:14', '2020-12-15 00:34:14'),
(0, 72, 'Reko General Konstruct', 'Aurelio S. Galangco', 'Manager', '#18 Dominican Hill Extension, 2600 Baguio City', '09089834799/422-2271', 'active', '2020-12-15 00:34:14', '2020-12-15 00:34:14'),
(0, 73, 'RNNA BUILDERS', 'Roy K. Kepes', 'Manager', '103-E North Sanitary Camp, Baguio City', '422-9549/09209175939', 'active', '2020-12-15 00:34:14', '2020-12-15 00:34:14'),
(0, 74, 'Remnant Builders', 'Julio O. Liis', 'Manager', 'Km 12, Shilan La Trinidad, Benguet', '0928-555-5155', 'active', '2020-12-15 00:34:14', '2020-12-15 00:34:14'),
(0, 75, 'Sapdoy Enterprises', 'William W. Sapdoy', 'Manager', '#178 Poblacion, Tuba, Benguet/Sitio Bridal, Kennon road, Camp 1 Tuba, Benguet', '9475200584/09081381751/09060791455', 'active', '2020-12-15 00:34:14', '2020-12-15 00:34:14'),
(0, 76, 'Sangin General Construction', 'Sandy L. Rafael', 'Manager', 'LE 8, Pipingew, Lubas, La Trinidad, Benguet/Pinehill Building, km 5, La Trinidad, Benguet', '9192998616', 'active', '2020-12-15 00:34:14', '2020-12-15 00:34:14'),
(0, 77, 'Summerlin Construction And Development Corporation', 'Anton M. Abyado', 'Manager', 'Samoyao, Alapang, La Trinidad, Benguet', '09302694414 / 09274024179', 'active', '2020-12-15 00:34:14', '2020-12-15 00:34:14'),
(0, 79, 'Sandstream Construction', 'Cristeta S. Locano', 'Manager', '3rd Floor Solis Building, Pico Road Km 5, La Trinidad, Benguet', '9497161568', 'active', '2020-12-15 00:34:14', '2020-12-15 00:34:14'),
(0, 80, 'Sharamalle Construction And General Engineering', 'Anthony A. Ban-Eg', 'Manager', 'Bulalacao,Mankayan, Benguet', '9982553392', 'active', '2020-12-15 00:34:14', '2020-12-15 00:34:14'),
(0, 81, 'Srba General Construction', 'Ray A. Angluben', 'Manager', 'Fd 67 Balili, La Trinidad, Benguet', '', 'active', '2020-12-15 00:34:14', '2020-12-15 00:34:14'),
(0, 82, 'Sff Enterprise', 'Charlie M.Felix', 'Manager', 'Tinongdan, Itogon, Benguet', '9464060139', 'active', '2020-12-15 00:34:14', '2020-12-15 00:34:14'),
(0, 83, 'Random Builders', 'Dominguez F. Alones', 'Manager', 'Da 109 Trinivilee Subdivision, Tomay, La Trinidad, Benguet', '9399162745', 'active', '2020-12-15 00:34:14', '2020-12-15 00:34:14'),
(0, 84, 'Roben Runas Construction', 'Roben B. Runas', 'Manager', '008 Upper Poblacion, Tuba, Benguet', '9988575534', 'active', '2020-12-15 00:34:14', '2020-12-15 00:34:14'),
(0, 85, 'Solonio Construction', 'Ritchie T. Solonio', 'Manager', 'Gusaran, Kabayan, Benguet', '9293643059', 'active', '2020-12-15 00:34:14', '2020-12-15 00:34:14'),
(0, 86, 'Sej Construction And Agrregates', 'Eric A. De Leon', 'Manager', 'Ac-50 Eastern Buyagan, Poblacion, La Trinidad, Benguet', '9478213774', 'active', '2020-12-15 00:34:14', '2020-12-15 00:34:14'),
(0, 87, 'Toclo Construction', 'Elmer S. Toclo', 'Manager', 'Atayan, Bauli, Mankayan', '9507557381', 'active', '2020-12-15 00:34:14', '2020-12-15 00:34:14'),
(0, 88, 'Universal De Leon', 'Oliver De Leon', 'Manager', 'Ac 147 Eastern Buyagan, Poblacion, La Trinidad, Benguet/Rm 2d 2nd Floor Bsu Coop Alumni Bldg, Betag Km 6, Ltb', '09984554077/424-4988', 'active', '2020-12-15 00:34:14', '2020-12-15 00:34:14'),
(0, 89, 'Vanket Engineering And Construction', 'Frankie T. Diano', 'Manager', 'Bokloan, Kapangan, Benguet', '9186948021', 'active', '2020-12-15 00:34:14', '2020-12-15 00:34:14'),
(0, 90, 'WDG Construction And Supply', 'Winson D. Galangco', 'Manager', '18 Interior Road, Extension, Dominican Hill, Mirador, Baguio City', '09303490222/422-2271', 'active', '2020-12-15 00:34:14', '2020-12-15 00:34:14'),
(0, 91, 'Ykj-Lhat General Construction', 'Leonarda T. Decaran', 'Manager', '#279 Purok 1, Loacan, Itogon, Benguet', '9996747113/09072949638', 'active', '2020-12-15 00:34:14', '2020-12-15 00:34:14'),
(0, 92, 'Zmc General Construction', 'Camilo C. Munoz', 'Manager', 'Ib 29, Betag, La Trinidad, Benguet', '9283787103', 'active', '2020-12-15 00:34:14', '2020-12-15 00:34:14'),
(0, 94, 'APP Construction and Supplies', 'Unknown Owner', 'Manager', 'Unknown address', '09503279274', 'active', NULL, NULL),
(0, 95, 'Layad General Engineering Construction & Aggregates', 'Mike A. Ibag', 'Manager', 'MB 222 C Long-long Road, Puguis, La Trinidad, Benguet', '09503279274 / 09480459730', 'active', NULL, NULL),
(0, 96, 'MXC Construction', 'Marwin Xann C. Cabading', 'Manager', 'PA 006 Upper Wangal, La Trinidad, Benguet', '09503279274', 'active', NULL, NULL),
(0, 97, 'EAJR De Leon Construction', 'Edwardo A. De Leon Jr.', 'Manager', 'Unknown Address', '09503279274', 'active', NULL, NULL),
(0, 98, 'CAD-ERA Design and Builder', 'Raymundo  D. Panopio', 'Manager', 'Unknown address', '09503279274', 'active', NULL, NULL),
(0, 99, 'Kidfer Construction', 'Kidap G. Fernandez', 'Manager', 'JC012 Km 4, Pico, La Trinidad, Benguet', '09497163110/09502279274', 'active', NULL, NULL),
(0, 100, 'Xandrix Builders', 'Aster P. Cadwagan', 'Manager', 'Unknown address', '09503279274', 'active', NULL, NULL),
(0, 101, 'Cascon Construction', 'Leonora M. Torio', 'Manager', 'Unknown Address', '09503279274', 'active', NULL, NULL),
(0, 102, 'Boyet Builders', 'James Palangdan', 'Manger', 'Unknown Address', '09503279274', 'active', NULL, NULL),
(0, 103, 'Deyan Construction', 'Anthony Deyan', 'Manger', 'Unknown Address', '09503279274', 'active', NULL, NULL),
(0, 104, 'AG Construction', 'Alexander A. Galpo', 'Manager', '121 SIAPNO ROAD PACDAL BAGUIO CITY', '09503279274', 'active', NULL, NULL),
(0, 105, 'G. Galpo Construction', 'Gideon Galpo', 'Manager', 'Unknown address', '09503279274', 'active', NULL, NULL),
(0, 106, 'NOR-KAZ Construction', 'Nora S. Bay-an', 'Manager', '579 Lasong, Tadiangan, Tuba, Benguet', '09503279274/09212138318', 'active', NULL, NULL),
(0, 107, 'One-Ro Construction and Supply', 'Leonoro C. Joseph', 'Manager', 'Uknown address', '09503279274', 'active', NULL, NULL),
(0, 108, 'High Plain Construction', 'Fidel Guis-o Yubos', 'Manager', 'Dada, Bakun, Benguet', '09202241701/09503279274', 'active', NULL, NULL),
(0, 109, 'Fuchigami Construction and Boring Property', 'Walter T. Fuchigami', 'Manager', 'Pico la Trinidad Benguet', '09503279274', 'active', NULL, NULL),
(0, 110, 'Renton Engineering Services', 'Enrique N. Waldo', 'Manager', 'Dalicno, Ampocao, Itogon, Benguet', '09474568793/09503279274/09993080675', 'active', NULL, NULL),
(0, 111, 'QPJ General Engineering Construction and Supply', 'Joel D. Alimondo', 'Manager', 'Swamp Puguis, La Trinidad, Benguet', '09503279274/09184159138', 'active', NULL, NULL),
(0, 112, 'Wacaden Construction', 'Drassen S. Igualdo', 'Manager', 'Poblacion, Buguias, Benguet', '09503279274', 'active', NULL, NULL),
(0, 113, 'Graceron Construction', 'Ronnie A. Malicdan', 'Manager', 'Unknown address', '09503279274', 'active', NULL, NULL),
(0, 114, 'Samantha Enterprises', 'Unknown Owner', 'Manager', 'Unknown address', '09503279274', 'active', NULL, NULL),
(0, 115, 'Skalyndra Construction and Supply', 'Jenny A. Bangdo', 'Manager', 'Naiba Tuding Itogon Benguet', '09503279274', 'active', NULL, NULL),
(0, 116, 'Babecor Builders', 'Marcos P. Bakoy', 'Manager', 'Ampucao Itogon Benguet', '09184194602', 'active', NULL, NULL),
(0, 117, 'JYKABAY General Construction', 'Jeffrey  P. Bayog', 'Manager', 'Abatan, Buguias, Benguet', '09503279274', 'active', NULL, NULL),
(0, 118, 'F.B. Bantales Engineering and Construction / Aroboan Construction and Supply', 'Roboan B. Alvarez', 'Manager', 'Uknown address', 'Unknown', 'active', NULL, NULL),
(0, 119, 'ESTAKA Builders', 'Reynald T. SIbelius', 'Proprietor', '462 Slide Tuding Itogon', '09998831735', 'active', NULL, NULL),
(0, 120, 'Tangayab Construction Services', 'Danford Doculan Amos', 'Manager', 'Proper Loo, Buguias, Benguet', '09613754708', 'active', NULL, NULL),
(0, 121, 'Felher General Construction', 'Feliciano M. Kipas', 'Unknown', 'IB-106 Betag, La Trinidad, Benguet', 'Unknown', 'active', NULL, NULL),
(0, 122, 'BGZ Construction Services', 'Anthony T. Licangan', 'Manager', 'AD24-A Buyagan, Poblacion, La Trinidad, Benguet', '09399152528', 'active', NULL, NULL),
(0, 123, 'Pecdasen Builders', 'Rudy D. Pecdasen', 'Manager', 'Lutheran Compound Abatan, Buguias, Benguet', '09185232926', 'active', NULL, NULL),
(0, 124, 'A.L. Sagandoy Construction', 'Agapito L. Sagandoy', 'Manager', '#1018 Batuang, Virac, Itogon, Benguet', 'Unknown', 'active', NULL, NULL),
(0, 125, 'CAMROCK Construction', 'Wilfred V. Montino', 'Manager', 'Nagawa,Ampucao, Itogon, Benguet', '09197749062', 'active', NULL, NULL),
(0, 126, 'Alber and Seven Construction', 'Almira S. Pacyado', 'Manager', '1354 Lower Skyview, Itogon', '09776022575', 'active', NULL, NULL),
(0, 127, 'Safelink Builders', 'Ponciano A. Andiso', 'Manager', 'Dangwa Square, Km.6, La Trinidad, Benguet/ Poblacion, Bakun, Benguet', 'Unknown', 'active', NULL, NULL),
(0, 128, 'CHRISHUA Construction Services', 'Domingo T. Bugnay', 'Manager', 'Ballay, Kabayan, Benguet/PA 295B Upper Wangal, La Trinidad, Benguet', '09105314217/09505164803', 'active', NULL, NULL),
(0, 129, 'Rocky 5g Builders', 'Oscar M. Dodon', 'Manager', 'KD-17 Gumamela Alley, Cruz, La Trinidad, Benguet', '09108176747/09097416217', 'active', NULL, NULL),
(0, 130, 'Right Anchor Construction', 'Mino P. Calgo', 'Manager', 'G/F Uklin Building, Acop,  Caponga, Tublay, Beguet', '09185441333/420-9136', 'active', NULL, NULL),
(0, 131, 'Cabuguiasan Builders', 'Thomas Mankin', 'Manager', '057 Dapiting, Alapang, La Trinidad, Benguet', 'Unknown', 'active', NULL, NULL),
(0, 132, 'LBJ Construction', 'Luis A. Yubos', 'Manager', '105 Central Fairview Village, Baguio City', '09076696299', 'active', NULL, NULL),
(0, 133, 'APWALTZ Construcion Services and Supplies', 'Annly A. Pulacan', 'Manager', 'Guinaoang, Mankayan, Benguet/ Happy Homes, Magsaysay Ave. Baguio City', '09395565977', 'active', NULL, NULL),
(0, 134, 'ARCGO GENERAL ENGINEERING', 'Unknown', 'Manager', 'Unknown', 'Uknown', 'active', NULL, NULL),
(0, 135, 'Balintugan Construction', 'Unknown', 'Manager', 'Unknown', 'Unknown', 'active', NULL, NULL),
(0, 136, 'ANSAGAN CONSTRUCTION SERVICES', 'unknown', 'Manager', 'unknown', 'unknown', 'active', NULL, NULL),
(0, 137, 'BOTJACK Construction', 'JICK A. MARIANO', 'Unknown', '058 Sitio Dapiting, Alapang, La Trinidad, Benguet', '09076124640', 'active', NULL, NULL),
(0, 138, 'VANVIN CONSTRUCTION', 'JOSEPH S. GABOL', 'Proprietor', '019-C Proper Alapang La Trinidad Benguet', '09077335118', 'active', NULL, NULL),
(0, 139, 'JUSTLYN Ralf Construction', 'Unknown', 'Unknown', 'Unknown', 'Unknown', 'active', NULL, NULL),
(0, 140, 'Solinio Construction', 'Unknown', 'Unknown', 'Unknown', 'Unknown', 'active', NULL, NULL),
(0, 141, 'Leo Heirs Construction', 'EMMANUEL S. LEO', 'Proprietor', 'Acop Caponga Tublay Benguet', '09197621705', 'active', NULL, NULL),
(0, 142, 'P-Raymund Construction', 'unknown', 'unknown', 'unknown', 'unknown', 'active', NULL, NULL),
(0, 143, 'TWO M Construction & Engineering Services', 'MICHAEL S. BAGINGAO', 'Manager', 'Loo, Buguias Benguet / 5th FLOOR PINESHILL BUILDING 2, KM 5 , Balili La Trinidad Benguet', '09120010099', 'active', NULL, NULL),
(0, 144, 'JMLP Builders', 'Lolita M. Pantaleon', 'Proprietor/General Manager', 'Saddle, Sagpat, Kibungan/# 26 Main Road, Camdas, Bagui City', '09065857422', 'active', NULL, NULL),
(0, 145, 'BENAD Construction', 'unknown', 'unknown', 'unknown', 'unknown', 'active', NULL, NULL),
(0, 146, 'EMNAR Construction And Engineering Services', 'EGNACIO P. ROSARIO', 'General Manager', 'FA 206- Tokiko Bldg, Km. 5, Balili, La Trinidad, Benguet', '09380908305', 'active', NULL, NULL),
(0, 147, 'Kankaloi Construction', 'Delizo Frank C.  Carpio Sr.', 'Manager', '#203 Balangabang, Bineng La Trinidad, Benguet', '09302532958/09399584880', 'active', NULL, NULL),
(0, 149, 'MAF SABADO Construction Services', 'unknown', 'unknown', 'unknown', 'unknown', 'active', NULL, NULL),
(0, 150, 'ZENITHAL-JNA Construction and Supply', 'Jake T. Altiyen', 'Proprietor', 'Dap-ayan 5, Pico, La Trinidad, Benguet', 'unknown', 'active', NULL, NULL),
(0, 151, 'Jomarcann General Construction and MJLAC Construction  and Aggregates (JV)', 'unknown', 'unknown', 'unknown', 'unknown', 'active', NULL, NULL),
(0, 152, 'Spiderone Construction Company LTD./Random Builders JV', 'Dominguez Alones', 'Authorized Managing Officer', 'Chinese Village Subdivision, Puguis, La Trinidad, Benguet', 'unknown', 'active', NULL, NULL),
(0, 153, 'QRJ Construction', 'unknown', 'unknown', 'unknown', 'unknown', 'active', NULL, NULL),
(0, 154, 'NORJOHN Construction', 'JOHNWIL B. CALPASE', 'Proprietor', 'Bot-oan, Catlubong, Buguias, Benguet', '09217835313', 'active', NULL, NULL),
(0, 155, 'O.ADCA Construction and Equipment Supplies', 'unknown', 'unknown', 'unknown', 'unknown', 'active', NULL, NULL),
(0, 156, 'CLEB Construction', 'CLEBERT L. SALBINO', 'Proprietor/Manager', 'AD-163 BUYAGAN, LA TRINIDAD, BENGUET', '09128969868', 'active', NULL, NULL),
(0, 157, 'Symon Engineering and Construction', 'Dan Ray  C. Simon', 'Proprietor', '08 Purok 4 Extension Gumangan Road, Aurora Hill, Bayan Park, Baguio City/108 Bokawkan Road, Baguio City', '09994466613', 'active', NULL, NULL),
(0, 158, 'Perfecto D. Igid Construction', 'Perfecto D. Igid', 'Proprietor', '328 San Vicente, Baguio City', 'uknown', 'active', NULL, NULL),
(0, 159, 'Rigne General Construction', 'Ryan Colilin M. Tolding', 'Proprietor', 'IB 96, Laoyan St., Km 6, Betag, La Trinidad, Benguet', 'uknown', 'active', NULL, NULL),
(0, 160, 'FSDI-Fluid Systems and Design Inc.', 'uknown', 'unknown', 'uknown', 'uknown', 'active', NULL, NULL),
(0, 161, 'FAMILY CIRCLE CONST./DJY CONST. JOINT VENTURE', 'MARCOS P. LUMA-ANG', 'Authorized Managing Officer', 'Kapangan, Benguet', '12232', 'active', NULL, NULL),
(0, 162, 'POLO ENGINEERING & CONSTRUCTION', 'MARK M. POLO', 'Proprietor', 'Pineshill Building KM 5, Balili, La Trinidad, Benguet', '09471444890', 'active', NULL, NULL),
(0, 163, 'NORBANO BUILDERS', 'NORRIS B. ANOYAN', 'Proprietor', 'CATLUBONG, BUGUIAS, BENGUET', '09397704003', 'active', NULL, NULL),
(0, 164, 'RHINESTONE CONSTRUCTION', 'JULIUS D. ELIO', 'Proprietor', 'Tublay, Benguet', '09486038201', 'active', NULL, NULL),
(0, 165, 'DUCANS CONSTRUCTION & SUPPLY', 'FELECIANO C. NATEGONG', 'Proprietor', 'Camp 3, Tuba', '09499765043', 'active', NULL, NULL),
(0, 166, 'MSMV CONSTRUCTION', 'MARCIAL D. BELINGON', 'Proprietor', 'Tomay, Bahong, La Trinidad, Benguet', '09096627929', 'active', NULL, NULL),
(0, 167, 'SEPJR CONSTRUCTION and SUPPLIES TRADING', 'THOMAS PALILENG JR', 'Proprietor', 'MA 151 Puguis La Trinidad Benguet/ Cot-cot, Bangao, Buguias, Benguet', '09212232826', 'active', NULL, NULL),
(0, 168, 'TRIBAL MOVERS CONSTRUCTION', 'Orlando M. Wankey', 'Proprietor', 'Km 13, Shilan, La Trinidad, Benguet/Acop, Tublay, Benguet', '09500754684', 'active', NULL, NULL),
(0, 169, 'FELVIC ENTERPRISES', 'PRUDENCIO L. LAURIAN', 'Proprietor', '0111 BAYACSAN, TALOY SUR, TUBA, BENGUET', '09395851341', 'active', NULL, NULL),
(0, 170, 'TIMBERLANDS CONSTRUCTION', 'MARCIAL S. MANMAN', 'Proprietor', 'DB 036 MAE BAHONG LA TRINIDAD, BENGUET/Sinipsip, Amgaleyguey, Buguias, Benguet', '09462304822', 'active', NULL, NULL),
(0, 171, 'SCOPPIONEM 97 DEVELOPMENT CORPORATION', 'LORRAINE DAYNE GAT-ONEN', 'Manager', 'uknown', '09109410080', 'active', NULL, NULL),
(0, 172, 'JNMR GENERAL CONSTRUCTION', 'JOVEN S. ROSALES', 'Manager', '# 396 Badiwan, POBLACION TUBA, Benguet', '09291308341', 'active', NULL, NULL),
(0, 173, 'MAK-JAY CONSTRUCTION', 'BEN C. BANISA', 'Manager', 'KM 5 ASIN ROAD BAGUIO CITY', '09294056959', 'active', NULL, NULL),
(0, 174, 'ALMOND ENGINEERING AND CONSTRUCTION', 'ROGELIO D. ALIMONDO', 'Proprietor', '058 SAMOYAO ALAPANG LA TRINIDAD BENGUET', '0910543040/09988665326', 'active', NULL, NULL),
(0, 175, 'ANAPEN CONSTRUCTION', 'JOSEPH S. GALAO-EY', 'Proprietor', 'TUBA BENGUET', '09486038001', 'active', NULL, NULL),
(0, 176, 'RNAA BUILDERS', 'ROY K. KEPES', 'Proprietor', '103-E NORTH SANITARY CAMP, BAGUIO CITY', '09996776982', 'active', NULL, NULL),
(0, 177, 'DICAY CONSTRUCTION SUPPLY AND SERVICES', 'JEREMIAH P. GUANSO', 'Proprietor', '245 ALAPANG LA TRINIDAD BENGUET/Guanso Hill, Guinaoang, Mankayan, Benguet', '09185047000/09076062590', 'active', NULL, NULL),
(0, 178, 'BENGSE-WAN CONSTRUCTION', 'CHRISTOPHER A. DANIO', 'Manager', 'uknown', '09194386996', 'active', NULL, NULL),
(0, 179, 'IFUBENG CONSTRUCTION', 'MOISES H. TAYABAN', 'Manager', 'ALNO LA TRINIDAD BENGUET', '09950913824', 'active', NULL, NULL),
(0, 180, 'TRYST BUILDERS ENTERPRISES', 'NESTOR M. PABLO', 'Manager', 'uknown', 'uknown', 'active', NULL, NULL),
(0, 181, 'Rimatyre Construction Services', 'RICHARD P. TAN', 'Manager', '50 Nevada Road Campo Sioco Baguio City', '442-6988 / 09178503099/09081515949/074-620-4775', 'active', NULL, NULL),
(0, 182, 'FB BANTALES ENGINEERING CONSTRUCTION', 'FLORANTE B. BANTALES JR.', 'Proprietor/MANAGER', 'Poblacion, Kabayan, Benguet', '09398443549', 'active', NULL, NULL),
(0, 183, 'GUAVA CONSTRUCTION', 'Evelyn E. Balag-ey', 'Manager', 'JD 240 Bayabas, Pico, La Trinidad, Benguet', '09291928252', 'active', NULL, NULL),
(0, 184, 'Random Builders And Fuchigami Construction and Boring Proprietaries JV', 'Dominguez F. Alones ; Walter T. Fuchigami', 'Managers', 'Da 109 Trinivilee Subdivision, Tomay, La Trinidad, Benguet; Pico,La Trinidad,Benguet', '09399162745;09503279274', 'active', NULL, NULL),
(0, 185, 'Kapadsing Construction and Engineering Services', 'Ronie G. Badio', 'unknown', 'Sinacbat, Bakun, Bengeut', '09993362680', 'active', NULL, NULL),
(0, 186, 'Alp Construction', 'uknown', 'unknown', 'uknown', 'uknown', 'active', NULL, NULL),
(0, 187, 'Gloram Construction Services', 'Ramon Rosendo Dengyas, Sr.', 'Manager/Proprietor', '0919 Purok 7, Dontogan, Baguio City', '09286894726', 'active', NULL, NULL),
(0, 188, 'SHERFELIAS CONSTRUCTION', 'SHERWIN F. ELIAS', 'Proprietor', '108 4/F  Norlu 0 Cedec Building 2 Bokawkan Road, Cresencia Village, Baguio City', '09391404316', 'active', NULL, NULL),
(0, 189, 'MACH CONSTRUCTION', 'ALBERT L. SAGANDOY', 'unknown', 'ITOGON BENGUET', '09494128287', 'active', NULL, NULL),
(0, 190, 'JB LAMI-ING BUILDERS', 'JERICO B. LAMI-ING', 'Manager/Proprietor', 'MONAMON NORTE, BAUKO, MT. PROVINCE', '09257805811', 'active', NULL, NULL),
(0, 191, 'DELTA FORCE CONSTRUCTION', 'EDENSON T. SAWAC', 'Manager/Proprietor', 'LAM-AYAN, BANGAO, BUGUIAS, BENGUET', '09461203218', 'active', NULL, NULL),
(0, 192, 'GELLE CONSTRUCTION SERVICES', 'GELLENE O. LESINO', 'Manager', '255-B CENTRAL GUISAD BAGUIO CITY / ABATAN BUGUIAS BENGUET', '09091664003', 'active', NULL, NULL),
(0, 193, 'J.D. JR GALUTAN BUILDERS', 'JOHNNY D. GALUTAN JR', 'Proprietor', 'Domilos St. Tuding, Itogon, Benguet', '09484152103', 'active', NULL, NULL),
(0, 194, 'Boy-cos Construction', 'Asthor D. Cosme', 'Proprietor', 'Ambangeg, Daclan, Bokod', '09079005503', 'active', NULL, NULL),
(0, 195, 'Harlance Builders', 'Mila L. Singson', 'Proprietor', '#72 Purok 27 San Carlos Heights, Irisan, Baguio City', '09476970909', 'active', NULL, NULL),
(0, 196, 'Bryje Builders', 'Edson D. Galletes', 'Proprietor/MANAGER', 'Mogao Balili Mankayan', '09285354880', 'active', NULL, NULL),
(0, 197, 'Monsur Construction', 'Tomas B. Pacio', 'Manager', 'Monamon Sur Bauko Mt. Province', '0910525319', 'active', NULL, NULL),
(0, 198, 'Rekeam Construction and Supply', 'Pacita T. Bag-ayan', 'Manager', 'Ampusongan Bakun Benguet', '09089250751 / 09158307692', 'active', NULL, NULL),
(0, 199, 'Abukay Construction', 'Lyndon S. Balageo', 'Manager', 'Dalicno Ampucao Itogon Benguet', '09295112433', 'active', NULL, NULL),
(0, 200, 'M.P. Taberao Construction Services and Supplies', 'Moises P. Taberao', 'Manager', 'Hilltop Ambuklao Bokod Benguet', '09399627224', 'active', NULL, NULL),
(0, 201, 'Pegado Engineering and Construction', 'Mary Joy G. Pegado', 'Manager', 'Bayabas, Sablan, Benguet', '09486297111\\09092809240', 'active', NULL, NULL),
(0, 202, 'ASYANA CONSTRUCTION CONSULTANCY', 'Fernando L. Ballasio', 'Manager', '201 Anaheim, The Levels, Alabang Filinvest, Muntinlupa City', '09567682678', 'active', NULL, NULL),
(0, 203, 'JALC CONSTRUCTION & GEOTESTING SERVICES', 'Jurgenson Alex L. Canuto', 'Manager', 'Peday Kamog Sablan / AC 54 Buyagan Poblacion La Trinidad Benguet', '09213266895 / 09175052010', 'active', NULL, NULL),
(0, 204, 'I. M. BONGAR & CO. INC.', 'ISAIAS M. BONGAR', 'Manager/Proprietor', '310 PILAR ROAD, ALMANZA 1, LAS PINAS CITY', '09178825051/09258630225', 'active', NULL, NULL),
(0, 205, 'Bakun Construction', 'George D. Yubos', 'Manager', 'MB-032 Puguis La Trinidad Benguet', '09999780084', 'active', NULL, NULL),
(0, 206, 'W.E.G. CONSTRUCTION', 'WILFREDO E. GOPENG', 'Proprietor/General Manager', '69 BADIHOY ST. GUISAD BAGUIO CITY', '09159234904/09985580977', 'active', NULL, NULL),
(0, 207, 'MERRY HEART CONSTRUCTION', 'JIM BEAM M. TOLDING', 'Manager', 'IC 47 Km. 6, BETAG, LA TRINIDAD, BENGUET', '09395684686', 'active', NULL, NULL),
(0, 208, 'D.L. SUIDTA CONSTRUCTION', 'DENVER L. SUIDTA', 'Manager', 'OC-128 CENTRAL TAWANG LA TRINIDAD BENGUET', '09395656777 / 09563066115', 'active', NULL, NULL),
(0, 209, 'LD Castle Construction Services', 'Lee-his E. Domawal', 'Proprietor', 'Bakong Loakan Itogon Benguet', '09106792561', 'active', NULL, NULL),
(0, 210, 'Rybate Builders', 'Ryan Melchor B. Tello', 'Manager', 'Bangao Ambuclao Bokod Benguet', '09186521630', 'active', NULL, NULL),
(0, 211, 'Summa Water Resources Inc.', 'Marichu T. Decendario', 'Manager', '369 Dr. Sixto Antonio Avenue Maybunga Pasig', '8288-1529 / 09352350348', 'active', NULL, NULL),
(0, 212, 'TILA-OK CONSTRUCTION', 'JAN MARC R.  ACAY', 'Manager', 'Batuang Virac Itogon Benguet / 31 SOUTH SANITARY CAMP, BAGUIO CITY', '09193304012', 'active', NULL, NULL),
(0, 213, 'DELTA-FORCE CONSTRUCTION', 'EDENSON T. SAWAC', 'Manager', 'BANGAO, BUGUIAS, BENGUET', '09461203218', 'active', NULL, NULL),
(0, 214, 'JAN-REAL CONSTRUCTION SERVICES', 'Joliza D. Anselmo', 'Manager', 'Abatan Buguias Benguet / Km 5 Balili La Trinidad Benguet', '09302693417', 'active', NULL, NULL),
(0, 215, 'JESSIE CONSTRUCTION SERVICES', 'JESSIE A. PALANGDAN', 'Manager', 'Tuding Itogon Benguet', '09071271924', 'active', NULL, NULL),
(0, 216, 'SON 21 CIVIL ENGINEERING CONSTRUCTION', 'EDISON POLON MAKIN', 'Manager', '057 DAPITING ALAPANG LA TRINIDAD BENGUET', '09760170084', 'active', NULL, NULL),
(0, 217, 'REMFERNANDEZ CONSTRUCTION', 'REMBERT G.  FERNANDEZ', 'Manager', 'POBLACION BAKUN BENGUET/ JC 012 KM PICO LA TRINIDAD BENGUET', '09185008100', 'active', NULL, NULL),
(0, 218, 'PBAJ CONSTRUCTION &amp;amp; SUPPLY', 'ARIEL B. PALINGET', 'Manager', 'JA-210 Upper Cogcoga, Km. 3, Pico, La Trinidad, Benguet / Rm. 408, FA 146, Pines Hill Bussiness Center, Km. 5 Balili, La Trinidad, Benguet', '09104515152', 'active', NULL, NULL),
(0, 219, 'ASILIANS CONSTRUCTION AND ENGINEERING SERVICES', 'VALENTINO C. AS-IL', 'Manager', 'OD 410 BANIG TAWANG LA TRINIDAD BENGUET', '09075956583', 'active', NULL, NULL),
(0, 220, 'KAIT BUILDERS AND CONSTRUCTION', 'HEINTJE S. PIS-OY', 'Manager', '#31 Ampucao, Itogon, Benguet / Easter Road, Guisad, Baguio City', '09104709787', 'active', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customer_types`
--

CREATE TABLE `customer_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `description_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer_types`
--

INSERT INTO `customer_types` (`id`, `description_type`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Monitoring', '2022-03-22 09:20:33', '2022-03-22 09:20:33', NULL),
(2, 'Contractors (Prov.)', '2022-03-22 09:20:33', '2022-03-22 09:20:33', NULL),
(3, 'National Funded Projects', '2022-03-22 09:20:33', '2022-03-22 09:20:33', NULL),
(4, 'Brgy. Remittance', '2022-03-22 09:20:33', '2022-03-22 09:20:33', NULL),
(5, 'Municipal Remittance', '2022-03-22 09:20:33', '2022-03-22 09:20:33', NULL),
(6, 'Industrial', '2022-03-22 09:20:33', '2022-03-22 09:20:33', NULL),
(7, 'Commercial', '2022-03-22 09:20:33', '2022-03-22 09:20:33', NULL),
(8, 'Individual/Company', '2022-03-22 09:20:33', '2022-03-22 09:20:33', NULL),
(9, 'Provincial', '2022-03-22 09:20:33', '2022-03-22 09:20:33', NULL),
(10, 'Lot Rental', '2022-03-22 09:20:33', '2022-03-22 09:20:33', NULL),
(11, 'Delivery/Supplier of Drugs & Meds', '2022-03-22 09:20:33', '2022-03-22 09:20:33', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cut_offs`
--

CREATE TABLE `cut_offs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `collection_cutoff` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cut_offs`
--

INSERT INTO `cut_offs` (`id`, `collection_cutoff`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '12:00', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `department` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `department`, `created_at`, `updated_at`) VALUES
(1, 'PTO', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(2, 'PGO', '2022-03-22 09:20:33', '2022-03-22 09:20:33');

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
-- Table structure for table `form56s`
--

CREATE TABLE `form56s` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `effectivity_year` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tax_precentage` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `aid_in_full` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `paid_in_full` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `penalty_per_month` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `form56s`
--

INSERT INTO `form56s` (`id`, `effectivity_year`, `tax_precentage`, `aid_in_full`, `paid_in_full`, `penalty_per_month`, `created_at`, `updated_at`) VALUES
(1, '2', '3', '1', '5', '2.3', '2022-03-22 09:20:33', '2022-03-22 09:20:33');

-- --------------------------------------------------------

--
-- Table structure for table `holidays`
--

CREATE TABLE `holidays` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date_of_holiday` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `holiday_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hospitals`
--

CREATE TABLE `hospitals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `hospital_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `land_tax_accounts`
--

CREATE TABLE `land_tax_accounts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `info_id` bigint(20) UNSIGNED NOT NULL,
  `rate_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `acc_category_id` bigint(20) UNSIGNED NOT NULL,
  `acc_title_id` bigint(20) UNSIGNED NOT NULL,
  `sub_title_id` bigint(20) UNSIGNED DEFAULT NULL,
  `quantity` decimal(8,2) DEFAULT NULL,
  `account` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nature` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `land_tax_accounts`
--

INSERT INTO `land_tax_accounts` (`id`, `info_id`, `rate_type`, `acc_category_id`, `acc_title_id`, `sub_title_id`, `quantity`, `account`, `nature`, `amount`, `created_at`, `updated_at`) VALUES
(1, 1, 'Schedule', 1, 7, NULL, '150.00', 'Tax on Sand, Gravel & Other Quarry Prod.', 'Boulders/stones (150.00cu.m @ 22.50)', '3375.00', '2022-03-23 00:30:37', '2022-03-23 00:30:37'),
(2, 1, 'Schedule', 1, 7, NULL, '150.00', 'Tax on Sand, Gravel & Other Quarry Prod.', 'Crushed Gravel and Sand (150.00cu.m @ 27.50)', '4125.00', '2022-03-23 00:30:37', '2022-03-23 00:30:37'),
(3, 1, 'Schedule', 1, 20, NULL, '1.00', 'Clearancee & Certification Fees (General Fund-Proper)', 'Certification Fee', '50.00', '2022-03-23 00:30:37', '2022-03-23 00:30:37'),
(4, 2, 'Percent', 1, 6, NULL, NULL, 'Real Property Transfer Tax', 'Real Property Transfer Tax (Sale w/ SP of 420,000.00)', '2100.00', '2022-03-23 00:39:49', '2022-03-23 00:39:49'),
(5, 3, 'Schedule', 1, 19, NULL, '0.00', 'Permit Fees', 'Annual Fee CY 2021-Computer Shop', '500.00', '2022-03-23 00:49:33', '2022-03-23 00:49:33'),
(6, 4, 'Percent', 1, 9, NULL, NULL, 'Amusement Tax', 'Amusement Tax (w/ amount 500,000.00)', '2500.00', '2022-03-23 01:03:06', '2022-03-23 01:03:06'),
(7, 5, 'Percent', 1, 10, NULL, NULL, 'Franchise Tax', 'Franchise Tax (w/ amount 350,000.00)', '1750.00', '2022-03-23 01:33:47', '2022-03-23 01:33:47'),
(8, 6, 'Schedule', 1, 7, NULL, '150.00', 'Tax on Sand, Gravel & Other Quarry Prod.', 'Aggregate Base Course/SBBC (150.00cu.m @ 15.00)', '2250.00', '2022-03-23 01:55:59', '2022-03-23 01:55:59'),
(9, 6, 'Schedule', 1, 7, NULL, '150.00', 'Tax on Sand, Gravel & Other Quarry Prod.', 'River Sand and Gravel (150.00cu.m @ 22.50)', '3375.00', '2022-03-23 01:55:59', '2022-03-23 01:55:59'),
(10, 6, 'Schedule', 1, 7, NULL, '190.00', 'Tax on Sand, Gravel & Other Quarry Prod.', 'Boulders/stones (190.00cu.m @ 22.50)', '4275.00', '2022-03-23 01:55:59', '2022-03-23 01:55:59'),
(11, 7, 'Percent', 1, 11, NULL, NULL, 'Printing and Publication Tax', 'Printing and Publication Tax (w/ amount 3,500.00)', '17.50', '2022-03-23 03:23:03', '2022-03-23 03:23:03'),
(12, 8, 'Percent', 1, 11, NULL, NULL, 'Printing and Publication Tax', 'Printing and Publication Tax (w/ amount 500,000.00)', '2500.00', '2022-03-23 06:39:58', '2022-03-23 06:39:58'),
(13, 9, 'Schedule', 1, 19, NULL, '0.00', 'Permit Fees', 'Annual Fee CY 2022 - Hauling Fee', '500.00', '2022-03-23 06:59:16', '2022-03-23 06:59:16'),
(15, 10, 'Percent', 1, 9, NULL, '0.00', 'Amusement Tax', 'Amusement Tax (w/ amount 500,000.00)', '2500.00', '2022-03-23 08:54:50', '2022-03-23 08:54:50'),
(24, 13, 'Schedule', 1, 7, NULL, '300.00', 'Tax on Sand, Gravel & Other Quarry Prod.', 'Aggregate Base Course/SBBC (300.00cu.m @ 15.00)', '4500.00', '2022-03-24 02:00:47', '2022-03-24 02:00:47'),
(25, 14, 'Schedule', 1, 7, NULL, '100.00', 'Tax on Sand, Gravel & Other Quarry Prod.', 'Boulders/stones (100.00cu.m @ 22.50)', '2250.00', '2022-03-24 02:02:14', '2022-03-24 02:02:14'),
(26, 14, 'Schedule', 1, 7, NULL, '200.00', 'Tax on Sand, Gravel & Other Quarry Prod.', 'Crushed Gravel and Sand (200.00cu.m @ 27.50)', '5500.00', '2022-03-24 02:02:14', '2022-03-24 02:02:14'),
(27, 15, 'Schedule', 1, 7, NULL, '250.00', 'Tax on Sand, Gravel & Other Quarry Prod.', 'Boulders/stones (250.00cu.m @ 22.50)', '5625.00', '2022-03-24 02:02:56', '2022-03-24 02:02:56'),
(28, 12, 'Schedule', 1, 19, NULL, '0.00', 'Permit Fees', 'Annual Fee CY 2021-Dealers/Suppliers of Drugs and Medicines', '1000.00', '2022-03-24 02:05:06', '2022-03-24 02:05:06'),
(29, 11, 'Schedule', 1, 27, 2, '0.00', 'Benguet Cold Chain Operation', 'Cold Storage Rentals', '350.00', '2022-03-24 02:05:20', '2022-03-24 02:05:20'),
(30, 11, 'Schedule', 1, 27, 1, '1.00', 'General (Buildings/Lots/Light & Water)', 'Lot Rental (1month @ 3660.00) for the month of', '3660.00', '2022-03-24 02:05:20', '2022-03-24 02:05:20'),
(31, 11, 'Schedule', 1, 28, 5, '1.00', 'Sales on Agricultural Products (BPENRO)', 'Commercial purposes (1sq.m @ 2.00)', '2.00', '2022-03-24 02:05:20', '2022-03-24 02:05:20'),
(32, 16, 'Schedule', 1, 7, NULL, '350.00', 'Tax on Sand, Gravel & Other Quarry Prod.', 'River Sand and Gravel (350.00cu.m @ 22.50)', '7875.00', '2022-03-24 02:15:16', '2022-03-24 02:15:16'),
(33, 17, 'Schedule', 1, 7, NULL, '150.00', 'Tax on Sand, Gravel & Other Quarry Prod.', 'Boulders/stones (150.00cu.m @ 22.50)', '3375.00', '2022-03-24 02:15:51', '2022-03-24 02:15:51'),
(34, 17, 'Schedule', 1, 7, NULL, '190.00', 'Tax on Sand, Gravel & Other Quarry Prod.', 'River Sand and Gravel (190.00cu.m @ 22.50)', '4275.00', '2022-03-24 02:15:51', '2022-03-24 02:15:51'),
(35, 18, 'Schedule', 1, 7, NULL, '1.00', 'Tax on Sand, Gravel & Other Quarry Prod.', 'Crushed Gravel and Sand (1,500.00cu.m @ 27.50)', '41250.00', '2022-03-24 02:44:37', '2022-03-24 02:44:37'),
(36, 19, 'Percent', 1, 10, NULL, NULL, 'Franchise Tax', 'Franchise Tax (w/ amount 350,000.00)', '1750.00', '2022-03-24 05:42:08', '2022-03-24 05:42:08'),
(37, 20, 'Percent', 1, 10, NULL, NULL, 'Franchise Tax', 'Franchise Tax (w/ amount 100,000.00)', '500.00', '2022-03-24 07:18:02', '2022-03-24 07:18:02'),
(39, 21, 'Percent', 1, 6, NULL, NULL, 'Real Property Transfer Tax', 'Real Property Transfer Tax (Sale w/ SP of 250,000.00)', '1250.00', '2022-03-24 07:30:15', '2022-03-24 07:30:15'),
(40, 25, 'Schedule', 1, 20, NULL, '1.00', 'Clearancee & Certification Fees (General Fund-Proper)', 'Certified Copy of Lot Plan/s', '50.00', '2022-03-28 02:47:55', '2022-03-28 02:47:55'),
(41, 26, 'Schedule', 1, 20, NULL, '1.00', 'Clearancee & Certification Fees (General Fund-Proper)', 'Certified Photocopy of Tax Declaration', '50.00', '2022-03-28 02:56:16', '2022-03-28 02:56:16'),
(42, 27, 'Schedule', 1, 20, NULL, '1.00', 'Clearancee & Certification Fees (General Fund-Proper)', 'Certified Photocopy of Tax Declaration', '50.00', '2022-03-28 03:02:25', '2022-03-28 03:02:25'),
(45, 29, 'Schedule', 1, 20, NULL, '1.00', 'Clearancee & Certification Fees (General Fund-Proper)', 'Certification Fee', '50.00', '2022-03-28 03:03:52', '2022-03-28 03:03:52'),
(48, 32, 'Schedule', 1, 20, NULL, '1.00', 'Clearancee & Certification Fees (General Fund-Proper)', 'Certified Photocopy of Tax Declaration', '50.00', '2022-03-28 03:17:47', '2022-03-28 03:17:47'),
(52, 34, 'Schedule', 1, 20, NULL, '1.00', 'Clearancee & Certification Fees (General Fund-Proper)', 'Certification Fee (Service Record)', '50.00', '2022-03-28 03:31:41', '2022-03-28 03:31:41'),
(53, 35, 'Percent', 1, 6, NULL, NULL, 'Real Property Transfer Tax', 'Real Property Transfer Tax (EJS w/ FMV of 119,880.00)', '599.40', '2022-03-28 03:51:41', '2022-03-28 03:51:41'),
(54, 35, 'Percent', 1, 6, NULL, NULL, 'Real Property Transfer Tax', 'Real Property Transfer Tax (Waiver w/ FMV of 79,919.98)', '399.60', '2022-03-28 03:51:41', '2022-03-28 03:51:41'),
(55, 35, 'Percent', 1, 14, NULL, NULL, 'Tax Revenue - Fines & Penalties - Property Taxes', 'Surcharge and Interest', '449.55', '2022-03-28 03:51:41', '2022-03-28 03:51:41'),
(56, 35, 'Schedule', 1, 20, NULL, '1.00', 'Clearancee & Certification Fees (General Fund-Proper)', 'Certification Fee', '50.00', '2022-03-28 03:51:41', '2022-03-28 03:51:41'),
(57, 36, 'Schedule', 1, 7, NULL, '150.00', 'Tax on Sand, Gravel & Other Quarry Prod.', 'Aggregate Base Course/SBBC (150.00cu.m @ 15.00)', '2250.00', '2022-03-28 07:18:51', '2022-03-28 07:18:51'),
(59, 38, 'Percent', 1, 6, NULL, NULL, 'Real Property Transfer Tax', 'Real Property Transfer Tax (Sale w/ SP of 500,000.00)', '2500.00', '2022-03-29 01:36:32', '2022-03-29 01:36:32'),
(60, 39, 'Schedule', 1, 4, NULL, '0.00', 'Professional Tax', 'Professional Tax Receipt CY 2022', '300.00', '2022-03-29 01:39:16', '2022-03-29 01:39:16'),
(61, 40, 'Schedule', 1, 8, NULL, '1.00', 'Tax on Delivery Trucks & Vans (General Fund-Proper)', 'Annual Fixed Tax (1 unit)', '600.00', '2022-03-29 02:40:31', '2022-03-29 02:40:31'),
(62, 40, 'Schedule', 1, 19, NULL, '0.00', 'Permit Fees', 'Permit Fee CY 2022- on Delivery Truck', '500.00', '2022-03-29 02:40:31', '2022-03-29 02:40:31'),
(63, 41, 'Schedule', 1, 19, NULL, '0.00', 'Permit Fees', 'Annual Fee CY 2022-Dealers/Suppliers of Medical Supplies', '1000.00', '2022-03-29 02:46:26', '2022-03-29 02:46:26'),
(64, 42, 'Schedule', 1, 4, NULL, '0.00', 'Professional Tax', 'Professional Tax Receipt CY 2022', '300.00', '2022-03-29 02:53:15', '2022-03-29 02:53:15'),
(65, 42, 'Percent', 1, 13, NULL, NULL, 'Tax Revenue - Fines & Penalties - on Individual (PTR)', 'Surcharge and Interest', '97.50', '2022-03-29 02:53:15', '2022-03-29 02:53:15'),
(66, 43, 'Fixed', 1, 18, NULL, NULL, 'Share from National Wealth-Hydro', 'Share from National Wealth-Hydro', '18937.88', '2022-03-29 03:17:07', '2022-03-29 03:17:07'),
(67, 44, 'Schedule', 1, 4, NULL, '0.00', 'Professional Tax', 'Professional Tax Receipt CY 2021', '300.00', '2022-03-29 03:55:51', '2022-03-29 03:55:51'),
(68, 45, 'Schedule', 1, 19, NULL, '0.00', 'Permit Fees', 'Annual Fee CY 2021-Commercial Banks, Insurance Companies or Financial Institutions', '1000.00', '2022-03-29 06:21:09', '2022-03-29 06:21:09'),
(69, 46, 'Percent', 1, 6, NULL, NULL, 'Real Property Transfer Tax', 'Real Property Transfer Tax (Sale w/ SP of 250,000.00)', '1250.00', '2022-03-30 02:24:13', '2022-03-30 02:24:13'),
(70, 37, 'Schedule', 1, 19, NULL, '0.00', 'Permit Fees', 'Annual Fee CY 2021-Computer Shop', '500.00', '2022-03-30 06:21:43', '2022-03-30 06:21:43'),
(71, 33, 'Percent', 1, 6, NULL, NULL, 'Real Property Transfer Tax', 'Real Property Transfer Tax (Sale w/ SP of 378,000.00)', '1890.00', '2022-03-30 06:22:52', '2022-03-30 06:22:52'),
(72, 33, 'Percent', 1, 14, NULL, NULL, 'Tax Revenue - Fines & Penalties - Property Taxes', 'Surcharge & Interest', '567.00', '2022-03-30 06:22:52', '2022-03-30 06:22:52'),
(73, 33, 'Schedule', 1, 20, NULL, '1.00', 'Clearancee & Certification Fees (General Fund-Proper)', 'Certification Fee', '50.00', '2022-03-30 06:22:52', '2022-03-30 06:22:52'),
(74, 31, 'Schedule', 1, 20, NULL, '1.00', 'Clearancee & Certification Fees (General Fund-Proper)', 'Cancellation/Discharge of Mortgaged', '130.00', '2022-03-30 06:27:00', '2022-03-30 06:27:00'),
(75, 28, 'Schedule', 1, 20, NULL, '3.00', 'Clearancee & Certification Fees (General Fund-Proper)', 'Agricultural Data and Certification (11 @ 25.00)', '75.00', '2022-03-30 08:37:18', '2022-03-30 08:37:18'),
(76, 28, 'Schedule', 1, 20, NULL, '1.00', 'Clearancee & Certification Fees (General Fund-Proper)', 'Certified Photocopy of Tax Declaration', '130.00', '2022-03-30 08:37:18', '2022-03-30 08:37:18'),
(77, 30, 'Schedule', 1, 20, NULL, '1.00', 'Clearancee & Certification Fees (General Fund-Proper)', 'Certified Photocopy of Tax Declaration', '50.00', '2022-03-31 01:46:22', '2022-03-31 01:46:22');

-- --------------------------------------------------------

--
-- Table structure for table `land_tax_infos`
--

CREATE TABLE `land_tax_infos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `report_date` date DEFAULT NULL,
  `af_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `receipt_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_ip` bigint(20) UNSIGNED NOT NULL,
  `series_id` bigint(20) UNSIGNED NOT NULL,
  `serial_number` int(11) NOT NULL,
  `municipality_id` bigint(20) UNSIGNED DEFAULT NULL,
  `barangay_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_type_radio` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `middle_initial` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `business_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `client_type_id` bigint(20) UNSIGNED DEFAULT NULL,
  `spouses` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sex` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transact_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `number` int(11) DEFAULT NULL,
  `transact_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_remarks` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `receipt_remarks` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `certificate` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_amount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `land_tax_infos`
--

INSERT INTO `land_tax_infos` (`id`, `report_date`, `af_type`, `receipt_type`, `user_ip`, `series_id`, `serial_number`, `municipality_id`, `barangay_id`, `client_type_radio`, `last_name`, `first_name`, `middle_initial`, `business_name`, `owner`, `client_type_id`, `spouses`, `company`, `sex`, `transact_type`, `bank_name`, `number`, `transact_date`, `bank_remarks`, `receipt_remarks`, `certificate`, `total_amount`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '2022-03-23', 'Form 51', 'Land Tax Collection', 4, 1, 7878912, 3, 23, 'Individual', NULL, NULL, NULL, '3K Rock Engineering', 'Francis B. Cuyop', 2, NULL, NULL, NULL, 'Cash', NULL, NULL, NULL, NULL, '<div>Sand &amp; Gravel Certification Receipt Remarks</div>', 'Sand & Gravel', '7,550.00', 'Printed', '2022-03-23 00:30:37', '2022-03-30 08:55:23', NULL),
(2, '2022-03-23', 'Form 51', 'Land Tax Collection', 4, 1, 7878913, NULL, NULL, 'Individual', 'ASLAG', 'KRISTINE', 'K.', NULL, NULL, 8, NULL, NULL, 'F', 'Cash', NULL, NULL, NULL, NULL, '<div>Transfer Tax Receipt Remarks of ASLAG</div>', 'Transfer Tax', '2,100.00', 'Printed', '2022-03-23 00:39:49', '2022-03-30 08:57:30', NULL),
(3, '2022-03-23', 'Form 51', 'Land Tax Collection', 4, 1, 7878914, NULL, NULL, 'Individual', 'CASTRO', 'JEMINEZ REL', 'S.', NULL, NULL, 8, NULL, NULL, 'F', 'Cash', NULL, NULL, NULL, NULL, '<div>Provincial Permit Receipt Remarks of CASTRO</div>', 'Provincial Permit', '500.00', 'Printed', '2022-03-23 00:49:33', '2022-03-23 00:49:40', NULL),
(4, '2022-03-23', 'Form 51', 'Land Tax Collection', 4, 1, 7878915, NULL, NULL, 'Individual', 'GASTRO', 'ROMEO ARNELL', 'F.', NULL, NULL, 8, NULL, NULL, 'M', 'Check', 'BDO', 123456, 'Mar 23, 2022', '<div>Bank remarks BDO</div>', '<div>Receipt remarks Amusement Tax</div>', 'None', '2,500.00', 'Printed', '2022-03-23 01:03:06', '2022-03-23 01:33:56', NULL),
(5, '2022-03-23', 'Form 51', 'Land Tax Collection', 4, 1, 7878916, NULL, NULL, 'Individual', 'GRESTO', 'SHIMADA', 'G.', NULL, NULL, 8, NULL, NULL, 'M', 'Money Order', 'LBP La Trinidad Benguet', 123444, 'Mar 23, 2022', NULL, '<div>Franchise Tax Receipt Remarks</div>', 'None', '1,750.00', 'Printed', '2022-03-23 01:33:47', '2022-03-23 01:44:07', NULL),
(6, '2022-03-23', 'Form 51', 'Land Tax Collection', 4, 1, 7878917, 9, 84, 'Individual', NULL, NULL, NULL, 'Alcel Construction', 'Alexander M. Ang', 2, NULL, NULL, NULL, 'Check', 'BDO', 123444, 'Mar 23, 2022', NULL, '<div>Sand &amp; Gravel Receipt Remarks</div>', 'Sand & Gravel', '9,900.00', 'Printed', '2022-03-23 01:55:59', '2022-03-23 01:57:55', NULL),
(7, '2022-03-23', 'Form 51', 'Land Tax Collection', 4, 1, 7878918, NULL, NULL, 'Individual', 'ASCUNCION', 'ANTONIO', 'T.', NULL, NULL, 8, NULL, NULL, 'M', 'Cash', NULL, NULL, NULL, NULL, NULL, 'None', '17.50', 'Printed', '2022-03-23 03:23:03', '2022-03-23 03:23:09', NULL),
(8, '2022-03-23', 'Form 51', 'Land Tax Collection', 4, 1, 7878919, NULL, NULL, 'Individual', 'KILDIG', 'FRANCHESKA', 'F.', NULL, NULL, 8, NULL, NULL, 'F', 'Cash', NULL, NULL, NULL, NULL, NULL, 'None', '2,500.00', 'Printed', '2022-03-23 06:39:58', '2022-03-23 06:45:33', NULL),
(9, '2022-03-23', 'Form 51', 'Land Tax Collection', 4, 1, 7878920, NULL, NULL, 'Individual', 'HALIB', 'MICHELLE', 'Q.', NULL, NULL, 8, NULL, NULL, 'F', 'Cash', NULL, NULL, NULL, NULL, '<div>Receipt Remarks Provincial permit</div>', 'Provincial Permit', '500.00', 'Printed', '2022-03-23 06:59:16', '2022-03-23 06:59:25', NULL),
(10, '2022-03-23', 'Form 51', 'Land Tax Collection', 4, 1, 7878921, 10, 105, 'Individual', NULL, NULL, NULL, 'Anas Construction', 'Dionisio L.  Anas', 2, NULL, NULL, NULL, 'Cash', NULL, NULL, NULL, NULL, '<div>dsadsada</div>', 'None', '2,500.00', 'Printed', '2022-03-23 08:54:02', '2022-03-23 08:54:50', NULL),
(11, '2022-03-23', 'Form 51', 'Land Tax Collection', 4, 1, 7878922, 5, 44, 'Individual', NULL, NULL, NULL, 'Akiki Builders', 'Ruben L. Aguinse', 2, NULL, NULL, NULL, 'Cash', NULL, NULL, NULL, NULL, '<div>dasdadsa</div>', 'None', '4012', 'Printed', '2022-03-23 09:06:00', '2022-03-24 02:05:20', NULL),
(12, '2022-03-23', 'Form 51', 'Land Tax Collection', 4, 1, 7878923, NULL, NULL, 'Individual', 'PADISIT', 'EDA', 'L.', NULL, NULL, 8, NULL, NULL, 'F', 'Cash', NULL, NULL, NULL, NULL, '<div>ASDADASasda</div>', 'Provincial Permit', '1000', 'Printed', '2022-03-24 00:50:04', '2022-03-24 02:05:06', NULL),
(13, '2022-03-24', 'Form 51', 'Land Tax Collection', 4, 1, 7878924, 13, 139, 'Individual', NULL, NULL, NULL, 'Bemada Construction', 'Beny M. Daliling', 2, NULL, NULL, NULL, 'Cash', NULL, NULL, NULL, NULL, '<div>S&amp;G Receipt Remarks</div>', 'Sand & Gravel', '4,500.00', 'Printed', '2022-03-24 02:00:47', '2022-03-24 02:00:53', NULL),
(14, '2022-03-24', 'Form 51', 'Land Tax Collection', 4, 1, 7878925, 9, 84, 'Individual', NULL, NULL, NULL, 'Baldas Construction', 'Samson B. Benny', 2, NULL, NULL, NULL, 'Cash', NULL, NULL, NULL, NULL, '<div>S&amp;G Receipt Remarks</div>', 'Sand & Gravel', '7,750.00', 'Printed', '2022-03-24 02:02:14', '2022-03-24 02:02:18', NULL),
(15, '2022-03-24', 'Form 51', 'Land Tax Collection', 4, 1, 7878926, 12, 121, 'Individual', NULL, NULL, NULL, 'Pecdasen Builders', 'Rudy D. Pecdasen', 2, NULL, NULL, NULL, 'Cash', NULL, NULL, NULL, NULL, '<div>S&amp;G Receipt Remarks</div>', 'Sand & Gravel', '5,625.00', 'Printed', '2022-03-24 02:02:56', '2022-03-24 02:03:02', NULL),
(16, '2022-03-24', 'Form 51', 'Land Tax Collection', 4, 1, 7878927, 8, 80, 'Individual', NULL, NULL, NULL, 'Donato-Sakiwat Construction', 'Jerome Stephen D. Sakiwat', 2, NULL, NULL, NULL, 'Cash', NULL, NULL, NULL, NULL, '<div>S&amp;G Receipt Remarks</div>', 'Sand & Gravel', '7,875.00', 'Printed', '2022-03-24 02:15:16', '2022-03-24 02:15:55', NULL),
(17, '2022-03-24', 'Form 51', 'Land Tax Collection', 4, 1, 7878928, 7, 63, 'Individual', NULL, NULL, NULL, 'Anas Construction', 'Dionisio L.  Anas', 2, NULL, NULL, NULL, 'Cash', NULL, NULL, NULL, NULL, '<div>S&amp;G Receipt Remarks</div>', 'Sand & Gravel', '7,650.00', 'Printed', '2022-03-24 02:15:51', '2022-03-24 02:16:00', NULL),
(18, '2022-03-24', 'Form 51', 'Land Tax Collection', 4, 1, 7878929, 5, 44, 'Individual', NULL, NULL, NULL, 'Aroboan Construction And Supply', 'Roboan B. Alvarez', 2, NULL, NULL, NULL, 'Cash', NULL, NULL, NULL, NULL, '<div>dsadasdsa</div>', 'Sand & Gravel', '41,250.00', 'Printed', '2022-03-24 02:44:37', '2022-03-24 02:47:13', NULL),
(19, '2022-03-24', 'Form 51', 'Land Tax Collection', 4, 1, 7878930, NULL, NULL, 'Individual', 'CASTRO', 'DANIELLE', 'I.', NULL, NULL, 8, NULL, NULL, 'M', 'Cash', NULL, NULL, NULL, NULL, '<div>dasdsada</div>', 'None', '1,750.00', 'Printed', '2022-03-24 05:42:08', '2022-03-24 05:42:12', NULL),
(20, '2022-03-24', 'Form 51', 'Land Tax Collection', 5, 7, 201, 13, 136, 'Individual', NULL, NULL, NULL, 'Efler Construction And Enterprise', 'Efler M. Sab-It', 3, NULL, NULL, NULL, 'Cash', NULL, NULL, NULL, NULL, '<div>asdasdada</div>', 'None', '500.00', 'Printed', '2022-03-24 07:18:02', '2022-03-24 07:18:12', NULL),
(21, '2022-03-28', 'Form 51', 'Land Tax Collection', 5, 7, 202, NULL, NULL, 'Individual', 'ASLAG, KRISTINE K.', 'KRISTINE', 'K.', NULL, NULL, 8, NULL, NULL, 'F', 'Cash', NULL, NULL, NULL, NULL, '<div>asdadadada</div>', 'Transfer Tax', '1250.00', 'Cancelled', '2022-03-24 07:29:01', '2022-03-28 01:05:02', NULL),
(25, '2022-03-28', 'Form 51', 'Land Tax Collection', 6, 10, 7037969, NULL, NULL, 'Individual', 'MACATULAD', 'JOEMARI', 'A.', NULL, NULL, 8, NULL, NULL, 'F', 'Cash', NULL, NULL, NULL, NULL, NULL, 'None', '50.00', 'Printed', '2022-03-28 02:47:55', '2022-03-28 02:48:38', NULL),
(26, '2022-03-28', 'Form 51', 'Land Tax Collection', 6, 10, 7037970, NULL, NULL, 'Individual', 'LAGDAO', 'BETZI', 'A.', NULL, NULL, 8, NULL, NULL, 'F', 'Cash', NULL, NULL, NULL, NULL, NULL, 'None', '50.00', 'Printed', '2022-03-28 02:56:16', '2022-03-28 06:35:47', NULL),
(27, '2022-03-28', 'Form 51', 'Land Tax Collection', 7, 15, 7586286, NULL, NULL, 'Individual', 'SEQUEL', 'MARIBEL', 'H.', NULL, NULL, 8, NULL, NULL, 'F', 'Cash', NULL, NULL, NULL, NULL, NULL, 'None', '50.00', 'Printed', '2022-03-28 03:02:25', '2022-03-28 03:02:30', NULL),
(28, '2022-03-28', 'Form 51', 'Land Tax Collection', 6, 10, 7037971, NULL, NULL, 'Individual', 'GUANSI', 'DONBI', 'A.', NULL, NULL, 8, NULL, NULL, 'M', 'Check', 'China Bank', 789456, 'Mar 28, 2022', '<div>dfadsa</div>', NULL, 'None', '205.00', 'Printed', '2022-03-28 03:03:34', '2022-03-30 08:37:18', NULL),
(29, '2022-03-28', 'Form 51', 'Land Tax Collection', 7, 15, 7586287, NULL, NULL, 'Individual', 'DITAN', 'FRANCIS', 'N.', NULL, NULL, 8, NULL, NULL, 'M', 'Cash', NULL, NULL, NULL, NULL, NULL, 'None', '50.00', 'Printed', '2022-03-28 03:03:52', '2022-03-28 03:04:01', NULL),
(30, '2022-03-28', 'Form 51', 'Land Tax Collection', 7, 10, 7037972, NULL, NULL, 'Individual', 'BACKIAN', 'GRACE', 'S.', NULL, NULL, 8, NULL, NULL, 'F', 'Check', 'East West', 4568952, 'Mar 28, 2022', NULL, NULL, 'None', '50.00', 'Printed', '2022-03-28 03:06:43', '2022-03-31 01:46:22', NULL),
(31, '2022-03-28', 'Form 51', 'Land Tax Collection', 7, 10, 7037973, NULL, NULL, 'Individual', 'DUYOT', 'KEJZHYL', 'M', NULL, NULL, 8, NULL, NULL, 'M', 'Check', 'LBP La Trinidad Benguet', 1324567, 'Mar 28, 2022', '<div>rereretty</div>', NULL, 'None', '130.00', 'Printed', '2022-03-28 03:10:05', '2022-03-30 06:27:00', NULL),
(32, '2022-03-28', 'Form 51', 'Land Tax Collection', 7, 10, 7037974, NULL, NULL, 'Company', NULL, NULL, NULL, NULL, NULL, 8, NULL, 'LAND BANK OF THE PHILLIPINES', NULL, 'Cash', NULL, NULL, NULL, NULL, NULL, 'None', '50.00', 'Printed', '2022-03-28 03:17:47', '2022-03-28 06:34:19', NULL),
(33, '2022-03-28', 'Form 51', 'Land Tax Collection', 8, 9, 7016183, NULL, NULL, 'Individual', 'PACHEO', 'CHRISTIAN LOUIE', 'P.', NULL, NULL, 8, NULL, NULL, 'M', 'Bank Deposit/Transfer', 'BDO', 123444, 'Mar 28, 2022', '<div>sdadasdsa</div>', '<div><strong>TCT.No.T-24529/ ARP.No.2010-06-01-00334</strong></div>\r\n<div><strong>Acop, Caponga, Tublay, Benguet</strong></div>', 'Transfer Tax', '2507.00', 'Printed', '2022-03-28 03:31:32', '2022-03-30 06:22:52', NULL),
(34, '2022-03-28', 'Form 51', 'Land Tax Collection', 7, 10, 7037975, NULL, NULL, 'Individual', 'WACLIN', 'KENNETH MARIE', 'B', NULL, NULL, 8, NULL, NULL, 'M', 'Cash', NULL, NULL, NULL, NULL, NULL, 'None', '50.00', 'Printed', '2022-03-28 03:31:41', '2022-03-29 06:04:33', NULL),
(35, '2022-03-28', 'Form 51', 'Land Tax Collection', 8, 10, 7037976, NULL, NULL, 'Individual', 'BALANGAY', 'ROMEO', 'S.', NULL, NULL, 8, NULL, NULL, 'M', 'Cash', NULL, NULL, NULL, NULL, '<div>ARP Nos. 2010-13-01-00623; 2010-13-01-00739; 2010-13-01-02358; 2010-13-01-00682; 2010-13-01-00744; 2010-13-01-01644</div>\r\n<div>Poblacion, Bokod, Benguet</div>', 'Transfer Tax', '1,498.55', 'Printed', '2022-03-28 03:51:41', '2022-03-28 03:52:04', NULL),
(36, '2022-03-29', 'Form 51', 'Land Tax Collection', 8, 1, 7878931, 3, 21, 'Individual', NULL, NULL, NULL, 'A. G Chungalan Construction', 'Amalia G. Chungalan', 2, NULL, NULL, NULL, 'Cash', NULL, NULL, NULL, NULL, '<div>dasdsadas</div>', 'Sand & Gravel', '2,250.00', 'Printed', '2022-03-28 07:18:51', '2022-03-28 08:48:47', NULL),
(37, '2022-03-29', 'Form 51', 'Land Tax Collection', 9, 1, 7878932, 7, 65, 'Individual', NULL, NULL, NULL, 'Cliff Construction And Aggregates', 'Junifer Bosleng', 2, NULL, NULL, NULL, 'Check', 'LBP La Trinidad Benguet', 123456, 'Mar 28, 2022', NULL, '<div>sdadasda</div>', 'Provincial Permit', '500.00', 'Printed', '2022-03-28 09:04:52', '2022-03-30 06:21:43', NULL),
(38, '2022-03-29', 'Form 51', 'Land Tax Collection', 8, 1, 7878933, NULL, NULL, 'Individual', 'ASLAG, KRISTINE K.', 'KRISTINE', 'K.', NULL, NULL, 8, NULL, NULL, 'F', 'Cash', NULL, NULL, NULL, NULL, '<div>gfgf</div>', 'Transfer Tax', '2,500.00', 'Printed', '2022-03-29 01:36:32', '2022-03-29 01:43:30', '2022-03-29 01:43:30'),
(39, '2022-03-29', 'Form 51', 'Land Tax Collection', 8, 1, 7878934, NULL, NULL, 'Individual', 'BACKIAN', 'GRACE', 'S.', NULL, NULL, 8, NULL, NULL, 'F', 'Cash', NULL, NULL, NULL, NULL, NULL, 'None', '300.00', 'Printed', '2022-03-29 01:39:16', '2022-03-29 01:40:23', NULL),
(40, '2022-03-29', 'Form 51', 'Field Land Tax Collection', 9, 16, 7952288, NULL, NULL, 'Individual', 'SUMAYAO', 'NOELA', 'E', NULL, NULL, 8, NULL, NULL, 'F', 'Cash', NULL, NULL, NULL, NULL, '<div>Vegetable Dealer</div>\r\n<div>Sticker No. 1063</div>', 'None', '1,100.00', 'Printed', '2022-03-29 02:40:31', '2022-03-30 08:55:09', NULL),
(41, '2022-03-29', 'Form 51', 'Field Land Tax Collection', 9, 16, 7952289, NULL, NULL, 'Individual', 'PICPICAN', 'BALBINA', 'I', NULL, NULL, 8, NULL, NULL, 'F', 'Cash', NULL, NULL, NULL, NULL, NULL, 'None', '1,000.00', 'Printed', '2022-03-29 02:46:26', '2022-03-30 08:55:03', NULL),
(42, '2022-03-29', 'Form 51', 'Field Land Tax Collection', 9, 16, 7952290, NULL, NULL, 'Individual', 'ANGLOG', 'JAYNE FLOR', 'B', NULL, NULL, 8, NULL, NULL, 'F', 'Cash', NULL, NULL, NULL, NULL, '<div>OPTOMETRIST</div>\r\n<div>RN: 0009012</div>\r\n<div>Reg. Date: Aug. 11, 1999</div>\r\n<div>VU: July 12m 2023</div>', 'None', '397.50', 'Printed', '2022-03-29 02:53:15', '2022-03-29 02:53:41', NULL),
(43, '2022-03-29', 'Form 51', 'Field Land Tax Collection', 9, 16, 7952291, NULL, NULL, 'Company', NULL, NULL, NULL, NULL, NULL, 8, NULL, 'BAGUIO WATER DISTRICT', NULL, 'Check', 'LBP Baguio', 1856415, 'Jan 21, 2022', NULL, '<div>for the period October to December 2021</div>', 'None', '18,937.88', 'Printed', '2022-03-29 03:17:07', '2022-03-29 03:17:17', NULL),
(44, '2022-03-29', 'Form 51', 'Land Tax Collection', 9, 1, 7878935, 3, 17, 'Individual', NULL, NULL, NULL, '3K Rock Engineering', 'Francis B. Cuyop', 6, NULL, NULL, NULL, 'Cash', NULL, NULL, NULL, NULL, NULL, 'None', '300.00', 'Printed', '2022-03-29 03:55:51', '2022-03-29 05:50:54', NULL),
(45, '2022-03-30', 'Form 51', 'Land Tax Collection', 9, 1, 7878936, NULL, NULL, 'Individual', 'TINTO', 'JENNIFER', 'G.', NULL, NULL, 8, NULL, NULL, 'F', 'Cash', NULL, NULL, NULL, NULL, '<div>Sample Provincial Receipt</div>', 'Provincial Permit', '1,000.00', 'Printed', '2022-03-29 06:21:09', '2022-03-29 06:21:16', NULL),
(46, '2022-03-30', 'Form 51', 'Land Tax Collection', 9, 1, 7878937, NULL, NULL, 'Individual', 'FUERZO', 'FERDINAND', 'L.', NULL, NULL, 8, NULL, NULL, 'M', 'Cash', NULL, NULL, NULL, NULL, NULL, 'None', '1,250.00', 'Printed', '2022-03-30 02:24:13', '2022-03-30 02:24:19', NULL);

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
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2021_09_17_031730_create_accounts_table', 1),
(6, '2021_09_20_013510_create_posts_table', 1),
(7, '2021_09_22_014318_create_account_groups_table', 1),
(8, '2021_09_24_072329_create_form56s_table', 1),
(9, '2021_09_27_060010_create_hospitals_table', 1),
(10, '2021_09_29_005734_create_account_titles_table', 1),
(11, '2021_09_29_083907_create_account_subtitles_table', 1),
(12, '2021_10_07_003146_create_budget_estimates_table', 1),
(13, '2021_10_08_073150_create_report_officers_table', 1),
(14, '2021_10_11_013059_create_customer_types_table', 1),
(15, '2021_10_11_062301_create_holidays_table', 1),
(16, '2021_10_22_040010_create_accountable_officers_table', 1),
(17, '2021_10_22_040011_create_municipalities_table', 1),
(18, '2021_10_22_040012_create_serials_table', 1),
(19, '2021_10_25_020724_create_rate_changes_table', 1),
(20, '2021_10_26_015851_create_collection_rates_table', 1),
(21, '2021_10_26_080946_create_rate_schedules_table', 1),
(22, '2021_11_04_014714_create_serial_s_g_s_table', 1),
(23, '2021_11_04_074847_create_access_p_c_s_table', 1),
(24, '2021_11_09_035615_create_barangays_table', 1),
(25, '2021_11_17_005846_create_land_tax_infos_table', 1),
(26, '2021_11_17_005934_create_land_tax_accounts_table', 1),
(27, '2021_11_25_022302_create_officers_table', 1),
(28, '2021_11_25_022418_create_positions_table', 1),
(29, '2021_11_25_022920_create_departments_table', 1),
(30, '2021_11_25_024140_create_cert_officers_table', 1),
(31, '2021_11_25_025156_create_certifications_table', 1),
(32, '2021_11_25_025158_create_provinvial_permit_arrays_table', 1),
(33, '2022_02_16_084914_create_collections_deposits_table', 1),
(34, '2022_03_15_090851_create_cut_offs_table', 1),
(35, '2022_03_17_140557_create_special_cases_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `municipalities`
--

CREATE TABLE `municipalities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `municipality` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `municipalities`
--

INSERT INTO `municipalities` (`id`, `municipality`, `created_at`, `updated_at`) VALUES
(1, 'Atok', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(2, 'Bakun', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(3, 'Bokod', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(4, 'Buguias', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(5, 'Itogon', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(6, 'Kabayan', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(7, 'Kapangan', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(8, 'Kibungan', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(9, 'La Trinidad', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(10, 'Mankayan', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(11, 'Sablan', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(12, 'Tuba', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(13, 'Tublay', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(14, 'Other', '2022-03-22 09:20:33', '2022-03-22 09:20:33');

-- --------------------------------------------------------

--
-- Table structure for table `officers`
--

CREATE TABLE `officers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `officers`
--

INSERT INTO `officers` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'IMELDA I. MACANES', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(2, 'JOANA G. COLSIM', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(3, 'MARY JANE P. LAMPACAN', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(4, 'ODELIA P. SINAS', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(5, 'JULIE V. ESTEBAN', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(6, 'MELCHOR D. DICLAS, MD', '2022-03-22 09:20:33', '2022-03-22 09:20:33');

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
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `positions`
--

CREATE TABLE `positions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `position` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `positions`
--

INSERT INTO `positions` (`id`, `position`, `created_at`, `updated_at`) VALUES
(1, 'Provincial Treasurer', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(2, 'Local Revenue Officer III', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(3, 'Local Revenue Officer IV', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(4, 'Local Revenue Officer I', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(5, 'Assistant Treasurer', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(6, 'Provincial Governor', '2022-03-22 09:20:33', '2022-03-22 09:20:33');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `acc_category_settings` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `acc_category_settings`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'General Fund-Proper', '2022-03-22 09:20:33', '2022-03-22 09:20:33', NULL),
(2, 'Benguet Technical School (BTS)', '2022-03-22 09:20:33', '2022-03-22 09:20:33', NULL),
(3, 'Special Education Fund (SEF)', '2022-03-22 09:20:33', '2022-03-22 09:20:33', NULL),
(4, 'Trust Fund', '2022-03-22 09:20:33', '2022-03-22 09:20:33', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `provincial_permit_arrays`
--

CREATE TABLE `provincial_permit_arrays` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `prov_cert_id` bigint(20) UNSIGNED DEFAULT NULL,
  `prov_feecharge` int(11) DEFAULT NULL,
  `prov_amount` int(11) DEFAULT NULL,
  `prov_ornumber` int(11) DEFAULT NULL,
  `prov_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prov_initials` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `provincial_permit_arrays`
--

INSERT INTO `provincial_permit_arrays` (`id`, `prov_cert_id`, `prov_feecharge`, `prov_amount`, `prov_ornumber`, `prov_date`, `prov_initials`, `created_at`, `updated_at`, `deleted_at`) VALUES
(15, 45, NULL, NULL, NULL, NULL, NULL, '2022-03-29 06:28:15', '2022-03-29 06:28:15', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `rate_changes`
--

CREATE TABLE `rate_changes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date_of_change` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rate_changes`
--

INSERT INTO `rate_changes` (`id`, `date_of_change`, `created_at`, `updated_at`) VALUES
(1, '12/22/2021', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(2, '2022', '2022-03-29 03:12:49', '2022-03-29 03:12:49');

-- --------------------------------------------------------

--
-- Table structure for table `rate_schedules`
--

CREATE TABLE `rate_schedules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `col_rate_id` bigint(20) UNSIGNED NOT NULL,
  `shared_label` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shared_value` decimal(8,2) DEFAULT NULL,
  `shared_per_unit` int(11) DEFAULT NULL,
  `shared_unit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rate_schedules`
--

INSERT INTO `rate_schedules` (`id`, `col_rate_id`, `shared_label`, `shared_value`, `shared_per_unit`, `shared_unit`, `created_at`, `updated_at`) VALUES
(1, 1, 'Professional Tax Receipt CY 2021', '300.00', 0, NULL, '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(2, 3, 'Aggregate Base Course/SBBC', '15.00', 1, 'cu.m', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(3, 3, 'River Sand and Gravel', '22.50', 1, 'cu.m', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(4, 3, 'Boulders/stones', '22.50', 1, 'cu.m', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(5, 3, 'Crushed Gravel and Sand', '27.50', 1, 'cu.m', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(6, 3, 'Sand and Gravel Penalty', '100.00', 1, 'cu.m', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(7, 3, 'Sand and Gravel Penalty', '150.00', 1, 'cu.m', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(8, 3, 'Sand and Gravel Penalty', '200.00', 1, 'cu.m', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(9, 3, 'Sand and Gravel Penalty', '300.00', 1, 'cu.m', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(10, 4, 'Annual Fixed Tax (1 unit)', '600.00', 1, '1', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(11, 13, 'Permit Fee CY 2021-as Printing and Publications', '2000.00', 0, NULL, '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(12, 13, 'Permit Fee CY 2021-Franchise Tax on Cable Antenna Networks & Radio Stns; Tel/Mob Services', '3000.00', 0, NULL, '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(13, 13, 'Permit Fee CY 2021-Proprietors, Lessors or Operators of Amusement Places', '2000.00', 0, NULL, '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(14, 13, 'Permit Fee CY 2021-Extraction and Processing of Sand, Gravel and Other Quarry Resources', '1000.00', 0, NULL, '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(15, 13, 'Permit Fee CY 2021-Operators of Delivery Trucks or Vans', '500.00', 0, NULL, '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(16, 13, 'Annual Fee CY 2021- Crusher Plant, Cement Batching Plant, and Asphalt Batching Plant', '50000.00', 0, NULL, '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(17, 13, 'Annual Fee CY 2021- Screening Plant Provided, however, that if the Screening Plant', '20000.00', 0, NULL, '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(18, 13, 'Annual Fee CY 2021-Power Producer/Operator of Hydro-Electric Plant', '1000.00', 0, NULL, '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(19, 13, 'Annual Fee CY 2021-Commercial Banks, Insurance Companies or Financial Institutions', '1000.00', 0, NULL, '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(20, 13, 'Annual Fee CY 2021-Malls/Department Stores/Supermarkets-', '1000.00', 0, NULL, '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(21, 13, 'Annual Fee CY 2021-as Construction Services', '1500.00', 0, NULL, '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(22, 13, 'Annual Fee CY 2021-Polyclinics,Medical/Dental/Optical Clinics', '200.00', 0, NULL, '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(23, 13, 'Annual Fee CY 2021-Educational Institution', '1000.00', 0, NULL, '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(24, 13, 'Annual Fee CY 2021-Recruitment Agencies/Travel & Tours', '1000.00', 0, NULL, '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(25, 13, 'Annual Fee CY 2021-Physical Fitness Gym', '500.00', 0, NULL, '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(26, 13, 'Annual Fee CY 2021-Real Estate Developers', '1000.00', 0, NULL, '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(27, 13, 'Annual Fee CY 2021-Computer Shop', '500.00', 0, NULL, '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(28, 13, 'Annual Fee CY 2021-Dealers/Suppliers of Drugs and Medicines', '1000.00', 0, NULL, '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(29, 13, 'Annual Fee CY 2021-Dealers/Suppliers of Medical and  Laboratory Supplies', '1000.00', 0, NULL, '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(30, 13, 'Annual Fee CY 2021-Dealers/Suppliers of Medical and Laboratory Equipment', '1000.00', 0, NULL, '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(31, 13, 'Annual Fee CY 2021- Hauling Fee ', '500.00', 0, NULL, '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(32, 13, 'Annual Fee CY 2021 - Others', '50.00', 0, NULL, '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(33, 13, 'Provincial Permit Fee', '200.00', 0, NULL, '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(34, 13, 'Provincial Permit Fee (special)', '250.00', 0, NULL, '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(35, 13, 'Annual Fee CY 2021- as Chicken Dung Operator', '50.00', 0, NULL, '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(36, 13, 'Permit Fee CY 2021- on Delivery Truck', '500.00', 0, NULL, '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(37, 13, 'Registration Fee - Small Scale Miners', '500.00', 0, NULL, '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(38, 13, 'Annual Extraction Clearance Fee', '5000.00', 0, NULL, '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(39, 14, 'Certified Photocopy of Tax Declaration', '50.00', 1, '1', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(40, 14, 'Certified Photocopy of Tax Declaration', '50.00', 1, '1', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(41, 14, 'Certified Copy of Section Map', '50.00', 1, '1', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(42, 14, 'Certified Copy of Section Map', '50.00', 1, '1', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(43, 14, 'Cancellation Fee on Mortgage', '50.00', 1, '1', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(44, 14, 'Cancellation Fee on Mortgage', '50.00', 1, '1', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(45, 14, 'Section Map', '50.00', 1, '1', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(46, 14, 'History', '540.00', 1, '1', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(47, 14, 'Certification of Loan Payments', '50.00', 1, '1', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(48, 14, 'Certification of Loan Payments', '50.00', 1, '1', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(49, 14, 'Certification of Amortization', '50.00', 1, '1', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(50, 14, 'Certification of Amortization', '50.00', 1, '1', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(51, 14, 'Service Fee for the Annotation/Cancellation of Mortgage', '25.00', 1, '1', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(52, 14, 'Service Fee for the Annotation/Cancellation of Mortgage', '25.00', 1, '1', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(53, 14, 'For blue printing per copy', '50.00', 1, '1', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(54, 14, 'For blue printing per copy', '50.00', 1, '1', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(55, 14, 'Service Fee for the Sheriff\'s Certificate of Sales, Final Sales Extra-judicial Foreclosure', '25.00', 1, '1', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(56, 14, 'For blue printing per copy with certification', '70.00', 1, '1', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(57, 14, 'Agricultural Data and Certification', '25.00', 1, '1', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(58, 14, 'Cancellation/Discharge of Mortgaged', '50.00', 1, '1', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(59, 14, 'Cancellation of Adverse Claim', '50.00', 1, '1', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(60, 14, 'Certification Fee of Paid Taxes', '50.00', 1, '1', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(61, 14, 'Certificate of No Record', '30.00', 1, '1', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(62, 14, 'Annotation Fee', '50.00', 1, '1', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(63, 14, 'Tax Mapping Control Roll (TMCR)', '30.00', 1, '1', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(64, 14, 'Cancellation of Adverse Claim', '50.00', 1, '1', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(65, 14, 'Certified True Copy/Photo Copy', '50.00', 1, '1', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(66, 14, 'Certificate of No Record', '30.00', 1, '1', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(67, 14, 'Certified Photocopy (DV)', '35.00', 1, '1', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(68, 14, 'Certified Photocopy: Tax Declaration, Supporting Documents etc.', '50.00', 1, '1', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(69, 14, 'Certified Photocopy of Sketch Plan', '50.00', 1, '1', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(70, 14, 'Certificate of Non-Improvement', '30.00', 1, '1', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(71, 14, 'Certified Photocopy of Tax Declaration', '50.00', 1, '1', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(72, 14, 'Certificate of Property Holdings', '30.00', 1, '1', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(73, 14, 'General Clearance (Local)', '15.00', 1, '1', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(74, 14, 'General Clearance (Abroad)', '30.00', 1, '1', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(75, 14, 'Certification Fee (Service Record)', '50.00', 1, '1', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(76, 14, 'Certificate of Non-Encumbrance', '30.00', 1, '1', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(77, 14, 'Certificate of Employment', '50.00', 1, '1', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(78, 14, 'Certification of Loan Payments/Amortization, etc.', '50.00', 1, '1', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(79, 14, 'Certification showing the existence and non-existence of any document', '30.00', 1, '1', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(80, 14, 'Certification of Sand and Gravel Tax Payment', '50.00', 1, '1', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(81, 14, 'Certificate of Non-Property', '50.00', 1, '1', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(82, 14, 'Certificate of Tax Exemption', '50.00', 1, '1', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(83, 14, 'Certificate of Assessment', '50.00', 1, '1', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(84, 14, 'Annotation of Court Order/Decision', '50.00', 1, '1', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(85, 14, 'Deed of Redemption', '50.00', 1, '1', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(86, 14, 'Cancellation Fee on Mortgage', '50.00', 1, '1', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(87, 14, 'Certification Fee', '50.00', 1, '1', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(88, 14, 'Plain Photocopy', '10.00', 1, '1', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(89, 14, 'Certification of Loan Payments', '50.00', 1, '1', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(90, 14, 'Certification of Amortization', '50.00', 1, '1', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(91, 14, 'Service Fee for the Annotation/Cancellation of Mortgage', '25.00', 1, '1', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(92, 14, 'Certificate of Non-Improvement', '30.00', 1, '1', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(93, 14, 'For blue printing per copy', '50.00', 1, '1', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(94, 14, 'For blue printing per copy with certification', '70.00', 1, '1', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(95, 14, 'Certificate of Landholdings', '30.00', 1, '1', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(96, 14, 'Annotation/Discharged of Mortgaged', '50.00', 1, '1', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(97, 14, 'Certified True Copy/Photocopy', '50.00', 1, '1', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(98, 14, 'Annotation/Cancellation of Mortgaged', '25.00', 1, '1', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(99, 14, 'General Clearance (Local)', '15.00', 1, '1', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(100, 14, 'General Clearance (Abroad)', '30.00', 1, '1', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(101, 14, 'Cancellation of Adverse Claim', '50.00', 1, '1', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(102, 14, 'Certificate of Employment', '50.00', 1, '1', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(103, 14, 'Certification of Loan Payments/Amortization, etc.', '50.00', 1, '1', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(104, 14, 'Annotation of Adverse Claim', '5.00', 1, '1', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(105, 14, 'Certification of Tax Payment', '50.00', 1, '1', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(106, 14, 'Certificate of No Record', '30.00', 1, '1', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(107, 14, 'Certificate of Tax Exemption', '50.00', 1, '1', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(108, 14, 'Certificate of Last Salary', '50.00', 1, '1', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(109, 14, 'Annotation of Court Order/Decision', '50.00', 1, '1', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(110, 14, 'Certified Photocopy Plain', '10.00', 1, '1', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(111, 14, 'Certified Copy of Section Map', '50.00', 1, '1', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(112, 14, 'Cancellation Fee on Mortgage', '50.00', 1, '1', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(113, 14, 'Certification of Loan Payments', '50.00', 1, '1', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(114, 14, 'Certification of Amortization', '50.00', 1, '1', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(115, 14, 'Service Fee for the Annotation/Cancellation of Mortgage', '25.00', 1, '1', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(116, 14, 'Field Appraisal Application Sheet', '50.00', 1, '1', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(117, 14, 'Certified Copy of Lot Plan/s', '50.00', 1, '1', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(118, 14, 'Certificate of Full Payment', '50.00', 1, '1', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(119, 14, 'Annotation of Lis Pendens', '25.00', 1, '1', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(120, 14, 'Cancellation of Levy', '25.00', 1, '1', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(121, 14, 'Certificate (BTS)', '50.00', 1, '1', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(122, 14, 'Transcript (BTS)', '50.00', 1, '1', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(123, 15, 'Animal Quarantine Regulatory Fee - Shipped In Bee/s (Queen)', '7.00', 1, 'Queen', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(124, 15, 'Animal Quarantine Regulatory Fee - Shipped In Bee Products Honey', '5.00', 1, 'liter', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(125, 15, 'Animal Quarantine Regulatory Fee - Shipped Out Cattle, Carabao, Horse', '15.00', 1, 'head', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(126, 15, 'Animal Quarantine Regulatory Fee - Shipped Out Swine: Category A (61 kgs-80 kgs)', '15.00', 1, 'head', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(127, 15, 'Animal Quarantine Regulatory Fee - Shipped Out Swine: Category B (81 kgs-199 kgs)', '20.00', 1, 'head', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(128, 15, 'Animal Quarantine Regulatory Fee - Shipped Out Swine (Grower: 30-60 kgs5)', '10.00', 1, 'head', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(129, 15, 'Animal Quarantine Regulatory Fee - Shipped Out Swine (Weanlings: 16-29 kgs)', '5.00', 1, 'head', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(130, 15, 'Animal Quarantine Regulatory Fee - Shipped Out Piglets ( 10-15 kgs ) ', '3.00', 1, 'head', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(131, 15, 'Animal Quarantine Regulatory Fee - Shipped Out Goat, Sheep, Cat, Dog', '5.00', 1, 'head', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(132, 15, 'Animal  Quarantine Regulatory Fee - Shipped Out Poultry Eggs case/30doz/360pcs', '3.00', 1, 'case', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(133, 15, 'Animal  Quarantine Regulatory Fee - Shipped Out Poultry Eggs crate/35doz/420pcs', '3.50', 1, 'crate', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(134, 15, 'Animal Quarantine Regulatory Fee - Shipped Out Pullets (Ready to lay)', '0.15', 1, 'head', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(135, 15, 'Animal Quarantine Regulatory Fee - Shipped Out Culled Layers', '0.10', 1, 'head', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(136, 15, 'Animal Quarantine Regulatory Fee - Shipped Out Breeder Cull', '0.10', 1, 'head', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(137, 15, 'Animal Quarantine Regulatory Fee - Shipped Out Assorted Meat Products and Meat by- products ', '0.15', 1, 'head', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(138, 15, 'Animal Quarantine Regulatory Fee - Shipped Out Duck, Native Chicken, Quail, Turkey', '0.15', 1, 'head', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(139, 15, 'Animal Quarantine Regulatory Fee - Shipped Out Assorted Meat Products and Meat by - products', '0.15', 1, 'head', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(140, 15, 'Animal Quarantine Regulatory Fee - Shipped Out Bee/s (Colony)', '10.00', 1, 'colony', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(141, 15, 'Animal Quarantine Regulatory Fee - Shipped Out Bee/s (Queen)', '5.00', 1, 'queen', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(142, 15, 'Animal Quarantine Regulatory Fee - Shipped Out Bee Products Honey', '2.50', 1, 'liter', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(143, 15, 'Animal Quarantine Regulatory Fees', '0.00', 0, NULL, '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(144, 15, 'Animal  Quarantine Regulatory Fee - Shipped In Poultry Eggs crate/35doz/420pcs', '0.00', 1, 'Crate', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(145, 15, 'Animal Quarantine Regulatory Fee - Shipped In Raw Chicken Dung/Manure', '0.00', 1, 'Sack/sack', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(146, 15, 'Animal Quarantine Regulatory Fee -Shipped In Assorted Chicken Products', '0.00', 1, 'kgs.', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(147, 15, 'Animal Quarantine Regulatory Fee - Swine: Category A(61 kgs-80 kgs)', '0.00', 1, 'Head', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(148, 15, 'Animal Quarantine Regulatory Fee - Shipped In Goat', '10.00', 1, 'Head', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(149, 15, 'Animal Quarantine Regulatory Fee - Shipped In Sheep', '10.00', 1, 'Head', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(150, 15, 'Animal Quarantine Regulatory Fee - Shipped In Cattle', '25.00', 1, 'Head', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(151, 15, 'Animal Quarantine Regulatory Fee - Shipped In Carabao', '25.00', 1, 'Head', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(152, 15, 'Animal Quarantine Regulatory Fee - Shipped In Horse', '25.00', 1, 'Head', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(153, 15, 'Animal Quarantine Regulatory Fee - Shipped In Bangus', '0.15', 1, 'kgs.', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(154, 15, 'Animal Quarantine Regulatory Fee -  Shipped In Tilapia', '0.15', 1, 'kgs.', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(155, 15, 'Animal Quarantine Regulatory Fee -  Shipped In Shrimp', '0.15', 1, 'kgs.', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(156, 15, 'Animal Quarantine Regulatory Fee - Shipped In Other Marine Fishes/Species', '0.15', 1, 'kgs.', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(157, 15, 'Animal Quarantine Regulatory Fee - Fighting Cock', '200.00', 1, 'Head', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(158, 15, 'Animal Quarantine Regulatory Fee - Shipped In Assorted Meat Products and Meat by- products ', '0.10', 1, 'kgs.', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(159, 15, 'Animal Quarantine Regulatory Fee - Shipped In Goat, Sheep, cat, Dog', '6.00', 1, 'Head', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(160, 15, 'Animal Quarantine Regulatory Fee - Processed Chicken Manure (PCM)', '30.00', 1, 'sack', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(161, 15, 'Animal  Quarantine Regulatory Fee - Shipped In Poultry Eggs case/30doz/360pcs', '6.00', 1, 'case', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(162, 15, 'Animal Quarantine Regulatory Fee - Shipped In Swine: Category B (81 kgs-199 kgs)', '30.00', 1, 'head', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(163, 15, 'Animal Quarantine Regulatory Fee - Shipped In Swine: Grower (30 kgs-60 kgs)', '20.00', 1, 'head', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(164, 15, 'Animal Quarantine Regulatory Fee - Shipped In Swine: Weanlings (16 kgs-29 kgs)', '10.00', 1, 'head', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(165, 15, 'Animal Quarantine Regulatory Fee - Shipped In Piglets (10 kgs-15 kgs)', '7.00', 1, 'head', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(166, 15, 'Animal Quarantine Regulatory Fee - Shipped In Hog (200 kgs and above)', '120.00', 1, 'head', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(167, 15, 'Animal Quarantine Regulatory Fee - Shipped In Day - old Chick  ', '0.35', 1, 'head', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(168, 15, 'Animal Quarantine Regulatory Fee - Shipped In Pullets (Ready to lay)', '0.35', 1, 'head', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(169, 15, 'Animal Quarantine Regulatory Fee - Shipped In Culled Layers', '0.15', 1, 'head', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(170, 15, 'Animal Quarantine Regulatory Fee - Shipped In Breeder Cull', '0.15', 1, 'head', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(171, 15, 'Animal Quarantine Regulatory Fee - Shipped In Broiler', '0.35', 1, 'head', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(172, 15, 'Animal Quarantine Regulatory Fee - Shipped In Duck, Native Chicken, Quail, Turkey', '0.35', 1, 'head', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(173, 15, 'Animal Quarantine Regulatory Fee - Shipped In Bee/s (Colony)', '15.00', 1, 'colony', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(174, 15, 'Animal Quarantine Regulatory Fee - Shipped In Bee/s (Queen)', '7.00', 1, 'Queen', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(175, 15, 'Animal Quarantine Regulatory Fee - Shipped In Bee Products Honey', '5.00', 1, 'liter', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(176, 15, 'Animal Quarantine Regulatory Fee - Shipped Out Cattle, Carabao, Horse', '15.00', 1, 'head', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(177, 15, 'Animal Quarantine Regulatory Fee - Shipped Out Swine: Category A (61 kgs-80 kgs)', '15.00', 1, 'head', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(178, 15, 'Animal Quarantine Regulatory Fee - Shipped Out Swine: Category B (81 kgs-199 kgs)', '20.00', 1, 'head', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(179, 15, 'Animal Quarantine Regulatory Fee - Shipped Out Swine (Grower: 30-60 kgs)', '10.00', 1, 'head', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(180, 15, 'Animal Quarantine Regulatory Fee - Shipped Out Swine (Weanlings: 16-29 kgs)', '5.00', 1, 'head', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(181, 15, 'Animal Quarantine Regulatory Fee - Shipped Out Piglets ( 10-15 kgs )', '3.00', 1, 'head', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(182, 15, 'Animal Quarantine Regulatory Fee - Shipped Out Goat, Sheep, Cat, Dog', '5.00', 1, 'head', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(183, 15, 'Animal  Quarantine Regulatory Fee - Shipped Out Poultry Eggs case/30doz/360pcs', '3.00', 1, 'case', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(184, 15, 'Animal  Quarantine Regulatory Fee - Shipped Out Poultry Eggs crate/35doz/420pcs', '3.50', 1, 'crate', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(185, 15, 'Animal Quarantine Regulatory Fee - Shipped Out Pullets (Ready to lay)', '0.15', 1, 'head', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(186, 15, 'Animal Quarantine Regulatory Fee - Shipped Out Culled Layers', '0.15', 1, 'head', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(187, 15, 'Animal Quarantine Regulatory Fee - Shipped Out Breeder Cull', '0.10', 1, 'head', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(188, 15, 'Animal Quarantine Regulatory Fee - Shipped Out Broiler', '0.15', 1, 'head', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(189, 15, 'Animal Quarantine Regulatory Fee - Shipped Out Duck, Native Chicken, Quail, Turkey', '0.15', 1, 'head', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(190, 15, 'Animal Quarantine Regulatory Fee - Shipped Out Assorted Meat Products and Meat by- products', '0.15', 1, 'head', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(191, 15, 'Animal Quarantine Regulatory Fee - Shipped Out Bee/s (Colony)', '0.15', 1, 'colony', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(192, 15, 'Animal Quarantine Regulatory Fee - Shipped Out Bee/s (Queen)', '0.15', 1, 'queen', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(193, 15, 'Animal Quarantine Regulatory Fee - Shipped Out Bee Products Honey', '0.15', 1, 'liter', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(194, 15, 'Animal Quarantine Regulatory Fees', '0.15', 0, NULL, '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(195, 16, 'Verification Fee', '20.00', 1, '1', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(196, 16, 'Verification Fee', '500.00', 1, '1', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(197, 18, 'Rental: Ben Palispis Hall', '1600.00', 0, NULL, '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(198, 18, 'Rental: Open Gymnasium', '1000.00', 1, 'first 8 hrs', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(199, 18, 'Lot Rental', '3660.00', 1, 'month', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(200, 18, 'Rental: Closed Gym', '1000.00', 1, 'hour', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(201, 18, 'Rental: Solibao/Gongs', '1000.00', 0, NULL, '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(202, 18, 'Rental: Ethnic dancing blankets(3 pcs.)', '250.00', 0, NULL, '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(203, 18, 'Rental: Devit', '100.00', 0, NULL, '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(204, 18, 'Rental: G-string', '50.00', 0, NULL, '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(205, 18, 'Rental: Vest/Chaleco', '100.00', 0, NULL, '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(206, 18, 'Rental: Head dress', '50.00', 0, NULL, '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(207, 18, 'Rental: Kayabang', '20.00', 0, NULL, '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(208, 18, 'Rental: Steel chairs', '2.00', 0, NULL, '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(209, 18, 'Rental: Parachute', '500.00', 0, NULL, '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(210, 18, 'Rental: Grandstand with Oval (day time)', '500.00', 0, NULL, '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(211, 18, 'Rental: Grandstand with Oval (night time)', '700.00', 0, NULL, '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(212, 18, 'Rental: Sound System', '400.00', 0, NULL, '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(213, 18, 'Lot Rental', '1966.25', 0, NULL, '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(214, 18, 'Lot Rental', '2147.75', 0, NULL, '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(215, 18, 'Lot Rental', '3327.50', 0, NULL, '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(216, 18, 'Rental Fee (120 sqm portion PHO)', '60000.00', 0, NULL, '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(217, 18, 'Rental: Covered Court', '100.00', 0, NULL, '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(218, 19, 'Truck Rentals', '5000.00', 0, NULL, '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(219, 19, 'Cold Storage Rentals', '350.00', 0, NULL, '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(220, 19, 'Crates Rental', '100.00', 0, NULL, '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(221, 20, 'Commercial purposes', '2.00', 1, 'sq.m', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(222, 20, 'Residential purposes', '1.50', 1, 'sq.m', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(223, 21, 'Delivery Receipt (Industrial)', '130.00', 1, 'pad', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(224, 21, 'Delivery Receipt (Commercial)', '130.50', 1, 'pad', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(225, 21, 'Forms', '30.00', 0, NULL, '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(226, 21, 'Filing Fee', '750.00', 0, NULL, '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(227, 21, 'Processing Fee', '50.00', 0, NULL, '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(228, 21, 'Application Fee', '750.00', 0, NULL, '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(229, 21, 'Application Fee', '300.00', 0, NULL, '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(230, 21, 'Filing Fee', '50.00', 0, NULL, '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(231, 21, 'Registration of Small Scale Miners', '500.00', 0, NULL, '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(232, 21, 'Book (Treasury of Beliefs and Home Rituals)', '100.00', 1, 'Book', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(233, 22, 'Biological Asset', '0.00', 0, NULL, '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(234, 22, 'Veterinary Drugs/Medicines/Vaccine', '0.00', 0, NULL, '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(235, 22, 'Agricultural Produce (Egg, meat, honey, boar semen)', '0.00', 0, NULL, '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(236, 22, 'Medical Fee (wound repair, VSP, AI, Castration, Spay, etc.)', '0.00', 0, NULL, '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(237, 22, 'Other Supplies (Syringes, catgut, squeeze bottle, catheter, vac\'n cards, etc.)', '0.00', 0, NULL, '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(238, 22, 'Inspcetion Fee', '0.00', 0, NULL, '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(239, 24, 'ID Fee (BTS)', '100.00', 1, '1', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(240, 25, 'Tuition Fee Automotive Servicing NC I', '50.00', 0, NULL, '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(241, 25, 'Tuition Fee Bread and Pastry Production NC II', '50.00', 0, NULL, '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(242, 25, 'Tuition Fee Hairdressing NC II', '50.00', 0, NULL, '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(243, 25, 'Tuition Fee Tailoring NC II', '50.00', 0, NULL, '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(244, 25, 'Tuition Fee Beauty Care NC II', '50.00', 0, NULL, '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(245, 25, 'Training Fees', '100.00', 0, NULL, '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(246, 27, 'ID Fee', '100.00', 1, '1', '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(247, 29, NULL, NULL, NULL, NULL, '2022-03-29 03:12:49', '2022-03-29 03:12:49');

-- --------------------------------------------------------

--
-- Table structure for table `report_officers`
--

CREATE TABLE `report_officers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `officer_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `officer_position` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `officer_department` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `serials`
--

CREATE TABLE `serials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `start_serial` int(11) NOT NULL,
  `end_serial` int(11) NOT NULL,
  `form` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fund_id` bigint(20) UNSIGNED DEFAULT NULL,
  `mun_id` bigint(20) UNSIGNED DEFAULT NULL,
  `acc_officer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `serials`
--

INSERT INTO `serials` (`id`, `start_serial`, `end_serial`, `form`, `unit`, `fund_id`, `mun_id`, `acc_officer_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 7878912, 7878990, 'Form 51', 'Pac', 1, NULL, NULL, '2022-03-22 09:20:33', '2022-03-22 09:20:33', NULL),
(2, 4848733, 8585745, 'Form 51', 'Sals', 1, NULL, NULL, '2022-03-22 09:20:33', '2022-03-22 09:20:33', NULL),
(3, 5151264, 2625323, 'Form 51', 'Pac', 1, NULL, NULL, '2022-03-22 09:20:33', '2022-03-29 02:05:42', '2022-03-29 02:05:42'),
(4, 7897899, 7899877, 'Form 56', 'Lee', NULL, 1, NULL, '2022-03-22 09:20:33', '2022-03-22 09:20:33', NULL),
(5, 7000000, 7001000, 'Form 51', 'Continuous', 2, NULL, 4, '2022-03-22 09:20:33', '2022-03-22 09:20:33', NULL),
(6, 1, 200, 'Form 51', 'Continuous', 1, NULL, 4, '2022-03-22 09:20:33', '2022-03-22 09:20:33', NULL),
(7, 201, 300, 'Form 51', 'Continuous', 1, NULL, NULL, '2022-03-22 09:20:36', '2022-03-22 09:20:36', NULL),
(8, 5693618, 5693650, 'Form 51', 'PAD', 1, NULL, NULL, '2022-03-28 02:05:39', '2022-03-28 02:05:39', NULL),
(9, 7016183, 7016500, 'Form 51', 'Continuous', 1, NULL, NULL, '2022-03-28 02:07:33', '2022-03-28 02:07:33', NULL),
(10, 7037969, 7038000, 'Form 51', 'Continuous', 1, NULL, NULL, '2022-03-28 02:08:03', '2022-03-28 02:08:03', NULL),
(11, 7038409, 7038500, 'Form 51', 'Continuous', 1, NULL, NULL, '2022-03-28 02:08:35', '2022-03-28 02:08:35', NULL),
(12, 7585588, 7586000, 'Form 51', 'Continuous', 1, NULL, NULL, '2022-03-28 02:09:03', '2022-03-28 02:09:03', NULL),
(13, 7586046, 7586250, 'Form 51', 'Continuous', 1, NULL, NULL, '2022-03-28 02:09:33', '2022-03-28 02:09:33', NULL),
(14, 7586286, 7586500, 'Form 51', NULL, NULL, NULL, NULL, '2022-03-28 02:09:50', '2022-03-28 02:09:50', NULL),
(15, 7586286, 7586500, 'Form 51', 'Continuous', 1, NULL, NULL, '2022-03-28 02:10:09', '2022-03-28 02:10:09', NULL),
(16, 7952288, 7952300, 'Form 51', 'Pad', 1, NULL, NULL, '2022-03-28 02:11:18', '2022-03-28 02:11:18', NULL),
(17, 7952302, 7952350, 'Form 51', 'Pad', 1, NULL, NULL, '2022-03-28 02:11:39', '2022-03-28 02:11:39', NULL),
(18, 7952355, 7952400, 'Form 51', 'Pad', 1, NULL, NULL, '2022-03-28 02:12:07', '2022-03-28 02:12:07', NULL),
(19, 7952451, 7952500, 'Form 51', 'Pad', 1, NULL, NULL, '2022-03-28 02:12:31', '2022-03-28 02:12:31', NULL),
(20, 7952501, 7952550, 'Form 51', 'Pad', 1, NULL, NULL, '2022-03-28 02:12:54', '2022-03-28 02:12:54', NULL),
(21, 7952551, 7952600, 'Form 51', 'Pad', 1, NULL, NULL, '2022-03-28 02:13:19', '2022-03-28 02:13:19', NULL),
(22, 7952601, 7952650, 'Form 51', 'Pad', 1, NULL, NULL, '2022-03-28 02:13:53', '2022-03-28 02:13:53', NULL),
(23, 7952651, 7952700, 'Form 51', 'Pad', 1, NULL, NULL, '2022-03-28 02:14:25', '2022-03-28 02:14:25', NULL),
(24, 7952701, 7952750, 'Form 51', 'Pad', 1, NULL, NULL, '2022-03-28 02:14:45', '2022-03-28 02:14:45', NULL),
(25, 7952751, 7952800, 'Form 51', 'Pad', 1, NULL, NULL, '2022-03-28 02:15:03', '2022-03-28 02:15:03', NULL),
(26, 7952801, 7952850, 'Form 51', 'Pad', 1, NULL, NULL, '2022-03-28 02:15:34', '2022-03-28 02:15:34', NULL),
(27, 7952851, 7952900, 'Form 51', 'Pad', 1, NULL, NULL, '2022-03-28 02:15:56', '2022-03-28 02:15:56', NULL),
(28, 7952901, 7952950, 'Form 51', 'Pad', 1, NULL, NULL, '2022-03-28 02:16:41', '2022-03-28 02:16:41', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `serial_s_g_s`
--

CREATE TABLE `serial_s_g_s` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `start_serial_sg` int(11) NOT NULL,
  `end_serial_sg` int(11) NOT NULL,
  `serial_sg_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `special_cases`
--

CREATE TABLE `special_cases` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin Admin', 'admin@black.com', '2022-03-22 09:20:33', '$2y$10$ds77b7shb7yMnnkz.j/quOKWk4Ubp45HwspTcpplRrHgvWXQnzGiC', NULL, '2022-03-22 09:20:33', '2022-03-22 09:20:33'),
(2, 'Admin1', 'admin1@black.com', '2022-03-22 09:20:33', '$2y$10$p74kTn64mnzhsPOe.D4C8.iP2zgwC0RVIlnAhY7mzk2Oseqz3QzAC', NULL, '2022-03-22 09:20:33', '2022-03-22 09:20:33');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `access_p_c_s`
--
ALTER TABLE `access_p_c_s`
  ADD PRIMARY KEY (`id`),
  ADD KEY `access_p_c_s_serial_id_foreign` (`serial_id`);

--
-- Indexes for table `accountable_officers`
--
ALTER TABLE `accountable_officers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`account_id`),
  ADD KEY `accounts_user_id_foreign` (`user_id`);

--
-- Indexes for table `account_groups`
--
ALTER TABLE `account_groups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `account_groups_category_id_foreign` (`category_id`);

--
-- Indexes for table `account_subtitles`
--
ALTER TABLE `account_subtitles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `account_subtitles_title_id_foreign` (`title_id`);

--
-- Indexes for table `account_titles`
--
ALTER TABLE `account_titles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `account_titles_title_category_id_foreign` (`title_category_id`);

--
-- Indexes for table `barangays`
--
ALTER TABLE `barangays`
  ADD PRIMARY KEY (`id`),
  ADD KEY `barangays_mun_id_foreign` (`mun_id`);

--
-- Indexes for table `budget_estimates`
--
ALTER TABLE `budget_estimates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `budget_estimates_category_id_foreign` (`category_id`),
  ADD KEY `budget_estimates_group_id_foreign` (`group_id`),
  ADD KEY `budget_estimates_title_id_foreign` (`title_id`);

--
-- Indexes for table `certifications`
--
ALTER TABLE `certifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `certifications_land_tax_info_id_foreign` (`land_tax_info_id`),
  ADD KEY `certifications_cert_prepared_by_foreign` (`cert_prepared_by`),
  ADD KEY `certifications_cert_signee_foreign` (`cert_signee`),
  ADD KEY `certifications_second_signee_foreign` (`second_signee`);

--
-- Indexes for table `cert_officers`
--
ALTER TABLE `cert_officers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cert_officers_officer_id_foreign` (`officer_id`),
  ADD KEY `cert_officers_position_id_foreign` (`position_id`),
  ADD KEY `cert_officers_department_id_foreign` (`department_id`);

--
-- Indexes for table `collections_deposits`
--
ALTER TABLE `collections_deposits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `collection_rates`
--
ALTER TABLE `collection_rates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `collection_rates_acc_titles_id_foreign` (`acc_titles_id`),
  ADD KEY `collection_rates_acc_subtitles_id_foreign` (`acc_subtitles_id`),
  ADD KEY `collection_rates_rate_change_id_foreign` (`rate_change_id`);

--
-- Indexes for table `customer_types`
--
ALTER TABLE `customer_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cut_offs`
--
ALTER TABLE `cut_offs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `form56s`
--
ALTER TABLE `form56s`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `holidays`
--
ALTER TABLE `holidays`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hospitals`
--
ALTER TABLE `hospitals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `land_tax_accounts`
--
ALTER TABLE `land_tax_accounts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `land_tax_accounts_info_id_foreign` (`info_id`),
  ADD KEY `land_tax_accounts_acc_category_id_foreign` (`acc_category_id`),
  ADD KEY `land_tax_accounts_acc_title_id_foreign` (`acc_title_id`),
  ADD KEY `land_tax_accounts_sub_title_id_foreign` (`sub_title_id`);

--
-- Indexes for table `land_tax_infos`
--
ALTER TABLE `land_tax_infos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `land_tax_infos_user_ip_foreign` (`user_ip`),
  ADD KEY `land_tax_infos_series_id_foreign` (`series_id`),
  ADD KEY `land_tax_infos_municipality_id_foreign` (`municipality_id`),
  ADD KEY `land_tax_infos_barangay_id_foreign` (`barangay_id`),
  ADD KEY `land_tax_infos_client_type_id_foreign` (`client_type_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `municipalities`
--
ALTER TABLE `municipalities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `officers`
--
ALTER TABLE `officers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `positions`
--
ALTER TABLE `positions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `provincial_permit_arrays`
--
ALTER TABLE `provincial_permit_arrays`
  ADD PRIMARY KEY (`id`),
  ADD KEY `provincial_permit_arrays_prov_cert_id_foreign` (`prov_cert_id`);

--
-- Indexes for table `rate_changes`
--
ALTER TABLE `rate_changes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rate_schedules`
--
ALTER TABLE `rate_schedules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rate_schedules_col_rate_id_foreign` (`col_rate_id`);

--
-- Indexes for table `report_officers`
--
ALTER TABLE `report_officers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `serials`
--
ALTER TABLE `serials`
  ADD PRIMARY KEY (`id`),
  ADD KEY `serials_fund_id_foreign` (`fund_id`),
  ADD KEY `serials_mun_id_foreign` (`mun_id`),
  ADD KEY `serials_acc_officer_id_foreign` (`acc_officer_id`);

--
-- Indexes for table `serial_s_g_s`
--
ALTER TABLE `serial_s_g_s`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `special_cases`
--
ALTER TABLE `special_cases`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `access_p_c_s`
--
ALTER TABLE `access_p_c_s`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `accountable_officers`
--
ALTER TABLE `accountable_officers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `account_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `account_groups`
--
ALTER TABLE `account_groups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `account_subtitles`
--
ALTER TABLE `account_subtitles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `account_titles`
--
ALTER TABLE `account_titles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `barangays`
--
ALTER TABLE `barangays`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=141;

--
-- AUTO_INCREMENT for table `budget_estimates`
--
ALTER TABLE `budget_estimates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `certifications`
--
ALTER TABLE `certifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `cert_officers`
--
ALTER TABLE `cert_officers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `collections_deposits`
--
ALTER TABLE `collections_deposits`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `collection_rates`
--
ALTER TABLE `collection_rates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `customer_types`
--
ALTER TABLE `customer_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `cut_offs`
--
ALTER TABLE `cut_offs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `form56s`
--
ALTER TABLE `form56s`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `holidays`
--
ALTER TABLE `holidays`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hospitals`
--
ALTER TABLE `hospitals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `land_tax_accounts`
--
ALTER TABLE `land_tax_accounts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `land_tax_infos`
--
ALTER TABLE `land_tax_infos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `municipalities`
--
ALTER TABLE `municipalities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `officers`
--
ALTER TABLE `officers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `positions`
--
ALTER TABLE `positions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `provincial_permit_arrays`
--
ALTER TABLE `provincial_permit_arrays`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `rate_changes`
--
ALTER TABLE `rate_changes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `rate_schedules`
--
ALTER TABLE `rate_schedules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=248;

--
-- AUTO_INCREMENT for table `report_officers`
--
ALTER TABLE `report_officers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `serials`
--
ALTER TABLE `serials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `serial_s_g_s`
--
ALTER TABLE `serial_s_g_s`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `special_cases`
--
ALTER TABLE `special_cases`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `access_p_c_s`
--
ALTER TABLE `access_p_c_s`
  ADD CONSTRAINT `access_p_c_s_serial_id_foreign` FOREIGN KEY (`serial_id`) REFERENCES `serials` (`id`);

--
-- Constraints for table `accounts`
--
ALTER TABLE `accounts`
  ADD CONSTRAINT `accounts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `account_groups`
--
ALTER TABLE `account_groups`
  ADD CONSTRAINT `account_groups_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `posts` (`id`);

--
-- Constraints for table `account_subtitles`
--
ALTER TABLE `account_subtitles`
  ADD CONSTRAINT `account_subtitles_title_id_foreign` FOREIGN KEY (`title_id`) REFERENCES `account_titles` (`id`);

--
-- Constraints for table `account_titles`
--
ALTER TABLE `account_titles`
  ADD CONSTRAINT `account_titles_title_category_id_foreign` FOREIGN KEY (`title_category_id`) REFERENCES `account_groups` (`id`);

--
-- Constraints for table `barangays`
--
ALTER TABLE `barangays`
  ADD CONSTRAINT `barangays_mun_id_foreign` FOREIGN KEY (`mun_id`) REFERENCES `municipalities` (`id`);

--
-- Constraints for table `budget_estimates`
--
ALTER TABLE `budget_estimates`
  ADD CONSTRAINT `budget_estimates_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `posts` (`id`),
  ADD CONSTRAINT `budget_estimates_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `account_groups` (`id`),
  ADD CONSTRAINT `budget_estimates_title_id_foreign` FOREIGN KEY (`title_id`) REFERENCES `account_titles` (`id`);

--
-- Constraints for table `certifications`
--
ALTER TABLE `certifications`
  ADD CONSTRAINT `certifications_cert_prepared_by_foreign` FOREIGN KEY (`cert_prepared_by`) REFERENCES `cert_officers` (`id`),
  ADD CONSTRAINT `certifications_cert_signee_foreign` FOREIGN KEY (`cert_signee`) REFERENCES `cert_officers` (`id`),
  ADD CONSTRAINT `certifications_land_tax_info_id_foreign` FOREIGN KEY (`land_tax_info_id`) REFERENCES `land_tax_infos` (`id`),
  ADD CONSTRAINT `certifications_second_signee_foreign` FOREIGN KEY (`second_signee`) REFERENCES `cert_officers` (`id`);

--
-- Constraints for table `cert_officers`
--
ALTER TABLE `cert_officers`
  ADD CONSTRAINT `cert_officers_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`),
  ADD CONSTRAINT `cert_officers_officer_id_foreign` FOREIGN KEY (`officer_id`) REFERENCES `officers` (`id`),
  ADD CONSTRAINT `cert_officers_position_id_foreign` FOREIGN KEY (`position_id`) REFERENCES `positions` (`id`);

--
-- Constraints for table `collection_rates`
--
ALTER TABLE `collection_rates`
  ADD CONSTRAINT `collection_rates_acc_subtitles_id_foreign` FOREIGN KEY (`acc_subtitles_id`) REFERENCES `account_subtitles` (`id`),
  ADD CONSTRAINT `collection_rates_acc_titles_id_foreign` FOREIGN KEY (`acc_titles_id`) REFERENCES `account_titles` (`id`),
  ADD CONSTRAINT `collection_rates_rate_change_id_foreign` FOREIGN KEY (`rate_change_id`) REFERENCES `rate_changes` (`id`);

--
-- Constraints for table `land_tax_accounts`
--
ALTER TABLE `land_tax_accounts`
  ADD CONSTRAINT `land_tax_accounts_acc_category_id_foreign` FOREIGN KEY (`acc_category_id`) REFERENCES `posts` (`id`),
  ADD CONSTRAINT `land_tax_accounts_acc_title_id_foreign` FOREIGN KEY (`acc_title_id`) REFERENCES `account_titles` (`id`),
  ADD CONSTRAINT `land_tax_accounts_info_id_foreign` FOREIGN KEY (`info_id`) REFERENCES `land_tax_infos` (`id`),
  ADD CONSTRAINT `land_tax_accounts_sub_title_id_foreign` FOREIGN KEY (`sub_title_id`) REFERENCES `account_subtitles` (`id`);

--
-- Constraints for table `land_tax_infos`
--
ALTER TABLE `land_tax_infos`
  ADD CONSTRAINT `land_tax_infos_barangay_id_foreign` FOREIGN KEY (`barangay_id`) REFERENCES `barangays` (`id`),
  ADD CONSTRAINT `land_tax_infos_client_type_id_foreign` FOREIGN KEY (`client_type_id`) REFERENCES `customer_types` (`id`),
  ADD CONSTRAINT `land_tax_infos_municipality_id_foreign` FOREIGN KEY (`municipality_id`) REFERENCES `municipalities` (`id`),
  ADD CONSTRAINT `land_tax_infos_series_id_foreign` FOREIGN KEY (`series_id`) REFERENCES `serials` (`id`),
  ADD CONSTRAINT `land_tax_infos_user_ip_foreign` FOREIGN KEY (`user_ip`) REFERENCES `access_p_c_s` (`id`);

--
-- Constraints for table `provincial_permit_arrays`
--
ALTER TABLE `provincial_permit_arrays`
  ADD CONSTRAINT `provincial_permit_arrays_prov_cert_id_foreign` FOREIGN KEY (`prov_cert_id`) REFERENCES `certifications` (`id`);

--
-- Constraints for table `rate_schedules`
--
ALTER TABLE `rate_schedules`
  ADD CONSTRAINT `rate_schedules_col_rate_id_foreign` FOREIGN KEY (`col_rate_id`) REFERENCES `collection_rates` (`id`);

--
-- Constraints for table `serials`
--
ALTER TABLE `serials`
  ADD CONSTRAINT `serials_acc_officer_id_foreign` FOREIGN KEY (`acc_officer_id`) REFERENCES `accountable_officers` (`id`),
  ADD CONSTRAINT `serials_fund_id_foreign` FOREIGN KEY (`fund_id`) REFERENCES `posts` (`id`),
  ADD CONSTRAINT `serials_mun_id_foreign` FOREIGN KEY (`mun_id`) REFERENCES `municipalities` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
