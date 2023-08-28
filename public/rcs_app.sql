-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 28, 2022 at 07:01 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

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
(1, 'Pac', '192.168.22.222', 'Land Tax Collection', 'Form 51', 1, '2022-03-28 16:25:28', '2022-03-28 16:25:28', NULL),
(2, 'Mak', '192.168.12.324', 'Land Tax Collection', 'Form 51', 1, '2022-03-28 16:25:28', '2022-03-28 16:25:28', NULL),
(3, 'Padzz', '192.168.6.75', 'Land Tax Collection', 'Form 51', 1, '2022-03-28 16:25:28', '2022-03-28 16:25:28', NULL),
(4, 'Mikee', '127.0.0.1', 'Land Tax Collection', 'Form 51', 6, '2022-03-28 16:25:28', '2022-03-28 16:25:28', NULL);

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
(1, 'IMELDA I. MACANES', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(2, 'JULIE V. ESTEBAN', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(3, 'IRENE C. BAGKING', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(4, 'MARY JANE P. LAMPACAN', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(5, 'LORENZA C. LAMSIS', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(6, 'JOANA G. COLSIM', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(7, 'MELCHOR I. DICLAS, MD', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(8, 'PURITA LESING', '2022-03-28 16:25:28', '2022-03-28 16:25:28');

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
(1, 'Tax Revenue', 1, '2022-03-28 16:25:28', '2022-03-28 16:25:28', NULL),
(2, 'Service Income', 1, '2022-03-28 16:25:28', '2022-03-28 16:25:28', NULL),
(3, 'Business Income', 1, '2022-03-28 16:25:28', '2022-03-28 16:25:28', NULL),
(4, 'Share, Grants & Donations/Gains/Misc. Income', 1, '2022-03-28 16:25:28', '2022-03-28 16:25:28', NULL),
(5, 'Accounts Payable', 1, '2022-03-28 16:25:28', '2022-03-28 16:25:28', NULL),
(6, 'Business Income', 2, '2022-03-28 16:25:28', '2022-03-28 16:25:28', NULL),
(7, 'Service Income', 2, '2022-03-28 16:25:28', '2022-03-28 16:25:28', NULL),
(8, 'Transfers, Assistance & Subsidy/Gain/Misc. Income', 2, '2022-03-28 16:25:28', '2022-03-28 16:25:28', NULL),
(9, 'Expenses', 2, '2022-03-28 16:25:28', '2022-03-28 16:25:28', NULL),
(10, 'Accounts Payable', 2, '2022-03-28 16:25:28', '2022-03-28 16:25:28', NULL),
(11, 'Accounts Receivable', 2, '2022-03-28 16:25:28', '2022-03-28 16:25:28', NULL),
(12, 'Tax Revenue', 3, '2022-03-28 16:25:28', '2022-03-28 16:25:28', NULL),
(13, 'Particulars', 4, '2022-03-28 16:25:28', '2022-03-28 16:25:28', NULL);

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
(1, 27, 'General (Buildings/Lots/Light & Water)', '2022-03-28 16:25:28', '2022-03-28 16:25:28', NULL),
(2, 27, 'Benguet Cold Chain Operation', '2022-03-28 16:25:28', '2022-03-28 16:25:28', NULL),
(3, 27, 'Lodging (OPAG)', '2022-03-28 16:25:28', '2022-03-28 16:25:28', NULL),
(4, 27, 'Provincial Health Office (PHO)', '2022-03-28 16:25:28', '2022-03-28 16:25:28', NULL),
(5, 28, 'Sales on Agricultural Products (BPENRO)', '2022-03-28 16:25:28', '2022-03-28 16:25:28', NULL),
(6, 28, 'Sales on Agricultural Products (OPAG)', '2022-03-28 16:25:28', '2022-03-28 16:25:28', NULL),
(7, 28, 'Sale on Delivery Receipts / Books / Appl. Fees', '2022-03-28 16:25:28', '2022-03-28 16:25:28', NULL),
(8, 28, 'Sales on Veterinary Products', '2022-03-28 16:25:28', '2022-03-28 16:25:28', NULL),
(9, 28, 'Gain on Sale of Accountable Forms/Printed forms', '2022-03-28 16:25:28', '2022-03-28 16:25:28', NULL),
(10, 28, 'Gain on Sale of Drugs and Medicines-5 District Hospitals', '2022-03-28 16:25:28', '2022-03-28 16:25:28', NULL),
(11, 29, 'Medical, Dental, X-Ray & Laboratory', '2022-03-28 16:25:28', '2022-03-28 16:25:28', NULL),
(12, 51, 'Other Payables (BTS)', '2022-03-28 16:25:28', '2022-03-28 16:25:28', NULL);

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
(1, '4-01-01-000', 'BAC Drugs & Meds', 1, '2022-03-28 16:25:28', '2022-03-28 16:25:28', NULL),
(2, '4-01-01-001', 'BAC Goods & Services', 1, '2022-03-28 16:25:28', '2022-03-28 16:25:28', NULL),
(3, '4-01-01-003', 'BAC INFRA', 1, '2022-03-28 16:25:28', '2022-03-28 16:25:28', NULL),
(4, '4-01-01-020', 'Professional Tax', 1, '2022-03-28 16:25:28', '2022-03-28 16:25:28', NULL),
(5, '4-01-02-040', 'Professional Tax-Basic (Net of Discount)', 1, '2022-03-28 16:25:28', '2022-03-28 16:25:28', NULL),
(6, '4-01-02-080', 'Real Property Transfer Tax', 1, '2022-03-28 16:25:28', '2022-03-28 16:25:28', NULL),
(7, '4-01-03-040', 'Tax on Sand, Gravel & Other Quarry Prod.', 1, '2022-03-28 16:25:28', '2022-03-28 16:25:28', NULL),
(8, '4-03-01-050', 'Tax on Delivery Trucks & Vans (General Fund-Proper)', 1, '2022-03-28 16:25:28', '2022-03-28 16:25:28', NULL),
(9, '4-03-01-060', 'Amusement Tax', 1, '2022-03-28 16:25:28', '2022-03-28 16:25:28', NULL),
(10, '4-03-01-070', 'Franchise Tax', 1, '2022-03-28 16:25:28', '2022-03-28 16:25:28', NULL),
(11, '4-03-01-080', 'Printing and Publication Tax', 1, '2022-03-28 16:25:28', '2022-03-28 16:25:28', NULL),
(12, '4-01-04-990', 'Other Taxes (Mining Claims)', 1, '2022-03-28 16:25:28', '2022-03-28 16:25:28', NULL),
(13, '4-01-05-010', 'Tax Revenue - Fines & Penalties - on Individual (PTR)', 1, '2022-03-28 16:25:28', '2022-03-28 16:25:28', NULL),
(14, '4-01-05-020', 'Tax Revenue - Fines & Penalties - Property Taxes', 1, '2022-03-28 16:25:28', '2022-03-28 16:25:28', NULL),
(15, '4-01-05-030', 'Tax Revenue - Fines & Penalties - Real Property Taxes', 1, '2022-03-28 16:25:28', '2022-03-28 16:25:28', NULL),
(16, '4-01-05-040', 'Tax Revenue - Fines & Penalties - Goods & Services', 1, '2022-03-28 16:25:28', '2022-03-28 16:25:28', NULL),
(17, '4-01-06-010', 'Share from Internal Revenue Collections (IRA)', 1, '2022-03-28 16:25:28', '2022-03-28 16:25:28', NULL),
(18, '4-01-06-030', 'Share from National Wealth-Hydro', 1, '2022-03-28 16:25:28', '2022-03-28 16:25:28', NULL),
(19, '4-02-01-010', 'Permit Fees', 2, '2022-03-28 16:25:28', '2022-03-28 16:25:28', NULL),
(20, '4-02-01-040', 'Clearancee & Certification Fees (General Fund-Proper)', 2, '2022-03-28 16:25:28', '2022-03-28 16:25:28', NULL),
(21, '4-02-01-050', 'Supervision and Regulation, Enforcement Fees (Quarantine Fees)', 2, '2022-03-28 16:25:28', '2022-03-28 16:25:28', NULL),
(22, '4-02-01-110', 'Verfication & Authentication Fees', 2, '2022-03-28 16:25:28', '2022-03-28 16:25:28', NULL),
(23, '4-02-01-070', 'Sup & Reg. Enf Fees (Animal Quarantine Fees)', 2, '2022-03-28 16:25:28', '2022-03-28 16:25:28', NULL),
(24, '4-02-01-980', 'Fines & Penalties - Service Income (General Fund-Proper)', 2, '2022-03-28 16:25:28', '2022-03-28 16:25:28', NULL),
(25, '4-02-01-990', 'Other Services Income', 2, '2022-03-28 16:25:28', '2022-03-28 16:25:28', NULL),
(26, '4-02-02-020', 'Affiliation Fees', 3, '2022-03-28 16:25:28', '2022-03-28 16:25:28', NULL),
(27, '4-02-02-050', 'Rent Income', 3, '2022-03-28 16:25:28', '2022-03-28 16:25:28', NULL),
(28, '4-02-02-180', 'Sales Revenue', 3, '2022-03-28 16:25:28', '2022-03-28 16:25:28', NULL),
(29, '4-02-02-200', 'Hospital Fees', 3, '2022-03-28 16:25:28', '2022-03-28 16:25:28', NULL),
(30, '4-02-02-220', 'Interest Income', 3, '2022-03-28 16:25:28', '2022-03-28 16:25:28', NULL),
(31, '4-02-02-980', 'Fines & Penalties - Business Income (General Fund-Proper)', 3, '2022-03-28 16:25:28', '2022-03-28 16:25:28', NULL),
(32, '4-04-02-010', 'Grants & Donations (Financial Assistance)', 4, '2022-03-28 16:25:28', '2022-03-28 16:25:28', NULL),
(33, '4-04-01-020', 'Share from PCSO (Lotto)', 4, '2022-03-28 16:25:28', '2022-03-28 16:25:28', NULL),
(34, '4-04-02-010', 'Gain on Sale of Property, Plant & Rquipment', 4, '2022-03-28 16:25:28', '2022-03-28 16:25:28', NULL),
(35, '4-04-02-010', 'Miscellaneous Income', 4, '2022-03-28 16:25:28', '2022-03-28 16:25:28', NULL),
(36, '4-04-02-100', 'Accounts Payable', 5, '2022-03-28 16:25:28', '2022-03-28 16:25:28', NULL),
(37, '4-02-02-200', 'School Fees', 6, '2022-03-28 16:25:28', '2022-03-28 16:25:28', NULL),
(38, '4-02-02-200', 'Rent Income', 6, '2022-03-28 16:25:28', '2022-03-28 16:25:28', NULL),
(39, '4-02-02-200', 'Interest Income', 6, '2022-03-28 16:25:28', '2022-03-28 16:25:28', NULL),
(40, '4-02-02-200', 'Registration Fees', 7, '2022-03-28 16:25:28', '2022-03-28 16:25:28', NULL),
(41, '4-02-02-200', 'Clearance and Certification Fees (BTS)', 7, '2022-03-28 16:25:28', '2022-03-28 16:25:28', NULL),
(42, '4-02-02-200', 'Insurance Premium', 8, '2022-03-28 16:25:28', '2022-03-28 16:25:28', NULL),
(43, '4-02-02-200', 'Supplies and Materials', 8, '2022-03-28 16:25:28', '2022-03-28 16:25:28', NULL),
(44, '4-02-02-200', 'Trainors Fee', 8, '2022-03-28 16:25:28', '2022-03-28 16:25:28', NULL),
(45, '4-02-02-200', 'Transfer of Fund', 8, '2022-03-28 16:25:28', '2022-03-28 16:25:28', NULL),
(46, '4-02-02-200', 'Subsidy from General Fund Proper', 8, '2022-03-28 16:25:28', '2022-03-28 16:25:28', NULL),
(47, '4-02-02-200', 'Gain on Sale of Property, Plant & Equipment', 8, '2022-03-28 16:25:28', '2022-03-28 16:25:28', NULL),
(48, '4-02-02-200', 'Assessment Fee', 8, '2022-03-28 16:25:28', '2022-03-28 16:25:28', NULL),
(49, '4-02-02-200', 'Other Payables', 8, '2022-03-28 16:25:28', '2022-03-28 16:25:28', NULL),
(50, '4-02-02-200', 'Taxes, Duties & Licenses', 9, '2022-03-28 16:25:28', '2022-03-28 16:25:28', NULL),
(51, '4-02-02-200', 'Miscellaneous Income', 10, '2022-03-28 16:25:28', '2022-03-28 16:25:28', NULL),
(52, '4-02-02-200', 'Accounts Receivable', 11, '2022-03-28 16:25:28', '2022-03-28 16:25:28', NULL),
(53, '4-01-02-050', 'Special Education Fund', 12, '2022-03-28 16:25:28', '2022-03-28 16:25:28', NULL),
(54, '4-01-05-020', 'Tax Revenue - Fines & Penalties-Real Property Taxes', 12, '2022-03-28 16:25:28', '2022-03-28 16:25:28', NULL),
(55, '4-02-02-220', 'Interest Income', 12, '2022-03-28 16:25:28', '2022-03-28 16:25:28', NULL),
(56, '4-06-01-010', 'Miscellaneous Income', 12, '2022-03-28 16:25:28', '2022-03-28 16:25:28', NULL),
(57, '4-06-01-010', 'Publication Cost', 13, '2022-03-28 16:25:28', '2022-03-28 16:25:28', NULL),
(58, '4-06-01-010', 'Other Payables', 13, '2022-03-28 16:25:28', '2022-03-28 16:25:28', NULL);

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
(1, 1, 'Poblacion', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(2, 1, 'Abiang', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(3, 1, 'Caliking', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(4, 1, 'Cattubo', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(5, 1, 'Naguey', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(6, 1, 'Paoay', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(7, 1, 'Pasdong', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(8, 1, 'Topdac', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(9, 2, 'Poblacion', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(10, 2, 'Ampusongan', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(11, 2, 'Bagu', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(12, 2, 'Dalipey', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(13, 2, 'Gambang', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(14, 2, 'Kayapa', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(15, 2, 'Sinacbat', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(16, 3, 'Poblacion', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(17, 3, 'Ambuclao', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(18, 3, 'Bila', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(19, 3, 'Bobok-Bisal', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(20, 3, 'Daclan', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(21, 3, 'Ekip', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(22, 3, 'Karao', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(23, 3, 'Nawal', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(24, 3, 'Pito', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(25, 3, 'Tikey', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(26, 4, 'Poblacion', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(27, 4, 'Abatan', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(28, 4, 'Amgaleyguey', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(29, 4, 'Amlimay', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(30, 4, 'Baculongan Norte', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(31, 4, 'Baculongan Sur', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(32, 4, 'Bangao', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(33, 4, 'Buyacaoan', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(34, 4, 'Calamagan', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(35, 4, 'Catlubong', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(36, 4, 'Lengaoan', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(37, 4, 'Loo', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(38, 4, 'Natubleng', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(39, 4, 'Sebang', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(40, 5, 'Poblacion', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(41, 5, 'Ampucao', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(42, 5, 'Dalupirip', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(43, 5, 'Gumatdang', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(44, 5, 'Loakan', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(45, 5, 'Tinongdan', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(46, 5, 'Tuding', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(47, 5, 'Ucab', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(48, 5, 'Virac', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(49, 6, 'Poblacion', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(50, 6, 'Adaoay', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(51, 6, 'Anchokey', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(52, 6, 'Bashoy', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(53, 6, 'Ballay', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(54, 6, 'Batan', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(55, 6, 'Duacan', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(56, 6, 'Eddet', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(57, 6, 'Gusaran', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(58, 6, 'Kabayan Barrio', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(59, 6, 'Lusod', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(60, 6, 'Pacso', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(61, 6, 'Tawangan', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(62, 7, 'Central', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(63, 7, 'Balakbak', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(64, 7, 'Beleng-Belis', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(65, 7, 'Boklaoan', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(66, 7, 'Cayapes', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(67, 7, 'Cuba', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(68, 7, 'Datakan', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(69, 7, 'Gadang', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(70, 7, 'Gaswiling', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(71, 7, 'Labueg', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(72, 7, 'Paykek', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(73, 7, 'Pudong', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(74, 7, 'Pongayan', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(75, 7, 'Sagubo', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(76, 7, 'Taba-ao', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(77, 8, 'Poblacion', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(78, 8, 'Badeo', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(79, 8, 'Lubo', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(80, 8, 'Madaymen', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(81, 8, 'Palina', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(82, 8, 'Sagpat', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(83, 8, 'Tacadang', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(84, 9, 'Poblacion', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(85, 9, 'Alapang', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(86, 9, 'Alno', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(87, 9, 'Ambiong', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(88, 9, 'Bahong', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(89, 9, 'Balili', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(90, 9, 'Beckel', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(91, 9, 'Bineng', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(92, 9, 'Betag', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(93, 9, 'Cruz', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(94, 9, 'Lubas', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(95, 9, 'Pico', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(96, 9, 'Puguis', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(97, 9, 'Shilan', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(98, 9, 'Tawang', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(99, 9, 'Wangal', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(100, 10, 'Poblacion', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(101, 10, 'Balili', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(102, 10, 'Bedbed', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(103, 10, 'Bulalacao', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(104, 10, 'Cabiten', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(105, 10, 'Colalo', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(106, 10, 'Guinaoang', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(107, 10, 'Paco', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(108, 10, 'Suyoc', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(109, 10, 'Sapid', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(110, 10, 'Tabio', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(111, 10, 'Taneg', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(112, 11, 'Poblacion', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(113, 11, 'Bagong', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(114, 11, 'Balluay', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(115, 11, 'Banangan', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(116, 11, 'Banengbeng', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(117, 11, 'Bayabas', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(118, 11, 'Kamog', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(119, 11, 'Pappa', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(120, 12, 'Poblacion', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(121, 12, 'Ansagan', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(122, 12, 'Camp 1', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(123, 12, 'Camp 3', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(124, 12, 'Camp 4', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(125, 12, 'Nangalisan', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(126, 12, 'San Pascual', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(127, 12, 'Tabaan Norte', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(128, 12, 'Tabaan Sur', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(129, 12, 'Tadiangan', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(130, 12, 'Taloy Norte', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(131, 12, 'Taloy Sur', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(132, 12, 'Twin Peaks', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(133, 13, 'Caponga (Pob.)', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(134, 13, 'Ambassador', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(135, 13, 'Ambongdolan', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(136, 13, 'Ba-ayan', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(137, 13, 'Basil', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(138, 13, 'Tublay Central', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(139, 13, 'Daclan', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(140, 13, 'Tuel', '2022-03-28 16:25:28', '2022-03-28 16:25:28');

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
(1, 1, 'Transfer Tax', 'March 29, 2022', 3, 1, NULL, 'null', 'RMIANDO, ALFONSO G.', 'Address sample 123', NULL, NULL, '<div><strong>TCT Something</strong></div>', '<p><strong>ATTY. SEMANIO LOUIS</strong></p>', 12345, 12, 34, 'XII', 2022, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-28 16:30:02', '2022-03-28 16:30:02', NULL);

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
(1, 1, 1, 1, '2022-03-28 16:25:28', '2022-03-28 16:25:28', NULL),
(2, 2, 2, 1, '2022-03-28 16:25:28', '2022-03-28 16:25:28', NULL),
(3, 3, 3, 1, '2022-03-28 16:25:28', '2022-03-28 16:25:28', NULL),
(4, 4, 4, 1, '2022-03-28 16:25:28', '2022-03-28 16:25:28', NULL),
(5, 5, 5, 1, '2022-03-28 16:25:28', '2022-03-28 16:25:28', NULL),
(6, 6, 6, 2, '2022-03-28 16:25:28', '2022-03-28 16:25:28', NULL);

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
(1, 4, NULL, 1, 0, NULL, NULL, NULL, 'Schedule', NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(2, 6, NULL, 1, 0, NULL, NULL, NULL, 'Percent', NULL, '50.00', 'Given Value', 0, NULL, NULL, '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(3, 7, NULL, 1, 1, '30.00', '30.00', '40.00', 'Schedule', NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(4, 8, NULL, 1, 0, NULL, NULL, NULL, 'Schedule', NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(5, 9, NULL, 1, 1, '50.00', '50.00', '0.00', 'Percent', NULL, '50.00', 'Given Value', 0, NULL, NULL, '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(6, 10, NULL, 1, 0, NULL, NULL, NULL, 'Percent', NULL, '50.00', 'Given Value', 0, NULL, NULL, '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(7, 11, NULL, 1, 0, NULL, NULL, NULL, 'Percent', NULL, '50.00', 'Given Value', 1, '2.00', '01/21', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(8, 12, NULL, 1, 0, NULL, NULL, NULL, 'Manual', NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(9, 13, NULL, 1, 0, NULL, NULL, NULL, 'Percent', NULL, '25.00', 'Total', 1, '2.00', '01/01', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(10, 14, NULL, 1, 0, NULL, NULL, NULL, 'Percent', NULL, '25.00', 'Total', 1, '2.00', NULL, '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(11, 15, NULL, 1, 0, NULL, NULL, NULL, 'Percent', NULL, '25.00', 'Total', 1, '2.00', NULL, '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(12, 16, NULL, 1, 0, NULL, NULL, NULL, 'Percent', NULL, '25.00', 'Total', 1, '2.00', '01/20', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(13, 19, NULL, 1, 0, NULL, NULL, NULL, 'Schedule', NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(14, 20, NULL, 1, 0, NULL, NULL, NULL, 'Schedule', NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(15, 21, NULL, 1, 0, NULL, NULL, NULL, 'Schedule', NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(16, 22, NULL, 1, 0, NULL, NULL, NULL, 'Schedule', NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(17, 24, NULL, 1, 0, NULL, NULL, NULL, 'Percent', NULL, '25.00', 'Total', 1, '2.00', '01/20', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(18, NULL, 1, 1, 0, NULL, NULL, NULL, 'Schedule', NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(19, NULL, 2, 1, 0, NULL, NULL, NULL, 'Schedule', NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(20, NULL, 5, 1, 0, NULL, NULL, NULL, 'Schedule', NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(21, NULL, 7, 1, 0, NULL, NULL, NULL, 'Schedule', NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(22, NULL, 8, 1, 0, NULL, NULL, NULL, 'Schedule', NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(23, 31, NULL, 1, 0, NULL, NULL, NULL, 'Percent', NULL, '10.00', 'Total', 1, '2.00', NULL, '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(24, 35, NULL, 1, 0, NULL, NULL, NULL, 'Schedule', NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(25, 37, NULL, 1, 0, NULL, NULL, NULL, 'Schedule', NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(26, 40, NULL, 1, 0, NULL, NULL, NULL, 'Fixed', '350.00', NULL, NULL, NULL, NULL, NULL, '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(27, 41, NULL, 1, 0, NULL, NULL, NULL, 'Fixed', '100.00', NULL, NULL, NULL, NULL, NULL, '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(28, 42, NULL, 1, 0, NULL, NULL, NULL, 'Fixed', '50.00', NULL, NULL, NULL, NULL, NULL, '2022-03-28 16:25:28', '2022-03-28 16:25:28');

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
(1, 'Monitoring', '2022-03-28 16:25:28', '2022-03-28 16:25:28', NULL),
(2, 'Contractors (Prov.)', '2022-03-28 16:25:28', '2022-03-28 16:25:28', NULL),
(3, 'National Funded Projects', '2022-03-28 16:25:28', '2022-03-28 16:25:28', NULL),
(4, 'Brgy. Remittance', '2022-03-28 16:25:28', '2022-03-28 16:25:28', NULL),
(5, 'Municipal Remittance', '2022-03-28 16:25:28', '2022-03-28 16:25:28', NULL),
(6, 'Industrial', '2022-03-28 16:25:28', '2022-03-28 16:25:28', NULL),
(7, 'Commercial', '2022-03-28 16:25:28', '2022-03-28 16:25:28', NULL),
(8, 'Individual/Company', '2022-03-28 16:25:28', '2022-03-28 16:25:28', NULL),
(9, 'Provincial', '2022-03-28 16:25:28', '2022-03-28 16:25:28', NULL),
(10, 'Lot Rental', '2022-03-28 16:25:28', '2022-03-28 16:25:28', NULL),
(11, 'Delivery/Supplier of Drugs & Meds', '2022-03-28 16:25:28', '2022-03-28 16:25:28', NULL);

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
(1, '12:00', '2022-03-28 16:27:40', NULL, NULL);

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
(1, 'PTO', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(2, 'PGO', '2022-03-28 16:25:28', '2022-03-28 16:25:28');

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
(1, '2', '3', '1', '5', '2.3', '2022-03-28 16:25:28', '2022-03-28 16:25:28');

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
(1, 1, 'Percent', 1, 6, NULL, NULL, 'Real Property Transfer Tax', 'Real Property Transfer Tax (Sale w/ SP of 550,000.00)', '2750.00', '2022-03-28 16:28:02', '2022-03-28 16:28:02');

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
  `client_type_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_type_radio` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `middle_initial` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `business_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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

INSERT INTO `land_tax_infos` (`id`, `report_date`, `af_type`, `receipt_type`, `user_ip`, `series_id`, `serial_number`, `municipality_id`, `barangay_id`, `client_type_id`, `client_type_radio`, `last_name`, `first_name`, `middle_initial`, `business_name`, `owner`, `spouses`, `company`, `sex`, `transact_type`, `bank_name`, `number`, `transact_date`, `bank_remarks`, `receipt_remarks`, `certificate`, `total_amount`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '2022-03-29', 'Form 51', 'Land Tax Collection', 4, 6, 1, NULL, NULL, 8, 'Individual', 'RMIANDO', 'ALFONSO', 'G.', NULL, NULL, NULL, NULL, 'M', 'Cash', NULL, NULL, NULL, NULL, '<div><strong>TCT Something</strong></div>', 'Transfer Tax', '2,750.00', 'Cancelled', '2022-03-28 16:28:02', '2022-03-28 16:46:03', NULL);

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
(1, 'Atok', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(2, 'Bakun', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(3, 'Bokod', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(4, 'Buguias', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(5, 'Itogon', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(6, 'Kabayan', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(7, 'Kapangan', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(8, 'Kibungan', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(9, 'La Trinidad', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(10, 'Mankayan', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(11, 'Sablan', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(12, 'Tuba', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(13, 'Tublay', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(14, 'Other', '2022-03-28 16:25:28', '2022-03-28 16:25:28');

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
(1, 'IMELDA I. MACANES', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(2, 'JOANA G. COLSIM', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(3, 'MARY JANE P. LAMPACAN', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(4, 'ODELIA P. SINAS', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(5, 'JULIE V. ESTEBAN', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(6, 'MELCHOR D. DICLAS, MD', '2022-03-28 16:25:28', '2022-03-28 16:25:28');

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
(1, 'Provincial Treasurer', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(2, 'Local Revenue Officer III', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(3, 'Local Revenue Officer IV', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(4, 'Local Revenue Officer I', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(5, 'Assistant Treasurer', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(6, 'Provincial Governor', '2022-03-28 16:25:28', '2022-03-28 16:25:28');

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
(1, 'General Fund-Proper', '2022-03-28 16:25:28', '2022-03-28 16:25:28', NULL),
(2, 'Benguet Technical School (BTS)', '2022-03-28 16:25:28', '2022-03-28 16:25:28', NULL),
(3, 'Special Education Fund (SEF)', '2022-03-28 16:25:28', '2022-03-28 16:25:28', NULL),
(4, 'Trust Fund', '2022-03-28 16:25:28', '2022-03-28 16:25:28', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `provincial_permit_arrays`
--

CREATE TABLE `provincial_permit_arrays` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `prov_cert_id` bigint(20) UNSIGNED DEFAULT NULL,
  `prov_feecharge` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
(1, 1, NULL, NULL, NULL, NULL, NULL, '2022-03-28 16:30:02', '2022-03-28 16:30:02', NULL);

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
(1, '12/22/2021', '2022-03-28 16:25:28', '2022-03-28 16:25:28');

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
(1, 1, 'Professional Tax Receipt CY 2021', '300.00', 0, NULL, '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(2, 3, 'Aggregate Base Course/SBBC', '15.00', 1, 'cu.m', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(3, 3, 'River Sand and Gravel', '22.50', 1, 'cu.m', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(4, 3, 'Boulders/stones', '22.50', 1, 'cu.m', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(5, 3, 'Crushed Gravel and Sand', '27.50', 1, 'cu.m', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(6, 3, 'Sand and Gravel Penalty', '100.00', 1, 'cu.m', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(7, 3, 'Sand and Gravel Penalty', '150.00', 1, 'cu.m', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(8, 3, 'Sand and Gravel Penalty', '200.00', 1, 'cu.m', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(9, 3, 'Sand and Gravel Penalty', '300.00', 1, 'cu.m', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(10, 4, 'Annual Fixed Tax (1 unit)', '600.00', 1, '1', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(11, 13, 'Permit Fee CY 2021-as Printing and Publications', '2000.00', 0, NULL, '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(12, 13, 'Permit Fee CY 2021-Franchise Tax on Cable Antenna Networks & Radio Stns; Tel/Mob Services', '3000.00', 0, NULL, '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(13, 13, 'Permit Fee CY 2021-Proprietors, Lessors or Operators of Amusement Places', '2000.00', 0, NULL, '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(14, 13, 'Permit Fee CY 2021-Extraction and Processing of Sand, Gravel and Other Quarry Resources', '1000.00', 0, NULL, '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(15, 13, 'Permit Fee CY 2021-Operators of Delivery Trucks or Vans', '500.00', 0, NULL, '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(16, 13, 'Annual Fee CY 2021- Crusher Plant, Cement Batching Plant, and Asphalt Batching Plant', '50000.00', 0, NULL, '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(17, 13, 'Annual Fee CY 2021- Screening Plant Provided, however, that if the Screening Plant', '20000.00', 0, NULL, '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(18, 13, 'Annual Fee CY 2021-Power Producer/Operator of Hydro-Electric Plant', '1000.00', 0, NULL, '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(19, 13, 'Annual Fee CY 2021-Commercial Banks, Insurance Companies or Financial Institutions', '1000.00', 0, NULL, '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(20, 13, 'Annual Fee CY 2021-Malls/Department Stores/Supermarkets-', '1000.00', 0, NULL, '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(21, 13, 'Annual Fee CY 2021-as Construction Services', '1500.00', 0, NULL, '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(22, 13, 'Annual Fee CY 2021-Polyclinics,Medical/Dental/Optical Clinics', '200.00', 0, NULL, '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(23, 13, 'Annual Fee CY 2021-Educational Institution', '1000.00', 0, NULL, '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(24, 13, 'Annual Fee CY 2021-Recruitment Agencies/Travel & Tours', '1000.00', 0, NULL, '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(25, 13, 'Annual Fee CY 2021-Physical Fitness Gym', '500.00', 0, NULL, '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(26, 13, 'Annual Fee CY 2021-Real Estate Developers', '1000.00', 0, NULL, '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(27, 13, 'Annual Fee CY 2021-Computer Shop', '500.00', 0, NULL, '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(28, 13, 'Annual Fee CY 2021-Dealers/Suppliers of Drugs and Medicines', '1000.00', 0, NULL, '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(29, 13, 'Annual Fee CY 2021-Dealers/Suppliers of Medical and  Laboratory Supplies', '1000.00', 0, NULL, '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(30, 13, 'Annual Fee CY 2021-Dealers/Suppliers of Medical and Laboratory Equipment', '1000.00', 0, NULL, '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(31, 13, 'Annual Fee CY 2021- Hauling Fee ', '500.00', 0, NULL, '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(32, 13, 'Annual Fee CY 2021 - Others', '50.00', 0, NULL, '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(33, 13, 'Provincial Permit Fee', '200.00', 0, NULL, '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(34, 13, 'Provincial Permit Fee (special)', '250.00', 0, NULL, '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(35, 13, 'Annual Fee CY 2021- as Chicken Dung Operator', '50.00', 0, NULL, '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(36, 13, 'Permit Fee CY 2021- on Delivery Truck', '500.00', 0, NULL, '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(37, 13, 'Registration Fee - Small Scale Miners', '500.00', 0, NULL, '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(38, 13, 'Annual Extraction Clearance Fee', '5000.00', 0, NULL, '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(39, 14, 'Certified Photocopy of Tax Declaration', '50.00', 1, '1', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(40, 14, 'Certified Photocopy of Tax Declaration', '50.00', 1, '1', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(41, 14, 'Certified Copy of Section Map', '50.00', 1, '1', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(42, 14, 'Certified Copy of Section Map', '50.00', 1, '1', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(43, 14, 'Cancellation Fee on Mortgage', '50.00', 1, '1', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(44, 14, 'Cancellation Fee on Mortgage', '50.00', 1, '1', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(45, 14, 'Section Map', '50.00', 1, '1', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(46, 14, 'History', '540.00', 1, '1', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(47, 14, 'Certification of Loan Payments', '50.00', 1, '1', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(48, 14, 'Certification of Loan Payments', '50.00', 1, '1', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(49, 14, 'Certification of Amortization', '50.00', 1, '1', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(50, 14, 'Certification of Amortization', '50.00', 1, '1', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(51, 14, 'Service Fee for the Annotation/Cancellation of Mortgage', '25.00', 1, '1', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(52, 14, 'Service Fee for the Annotation/Cancellation of Mortgage', '25.00', 1, '1', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(53, 14, 'For blue printing per copy', '50.00', 1, '1', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(54, 14, 'For blue printing per copy', '50.00', 1, '1', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(55, 14, 'Service Fee for the Sheriff\'s Certificate of Sales, Final Sales Extra-judicial Foreclosure', '25.00', 1, '1', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(56, 14, 'For blue printing per copy with certification', '70.00', 1, '1', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(57, 14, 'Agricultural Data and Certification', '25.00', 1, '1', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(58, 14, 'Cancellation/Discharge of Mortgaged', '50.00', 1, '1', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(59, 14, 'Cancellation of Adverse Claim', '50.00', 1, '1', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(60, 14, 'Certification Fee of Paid Taxes', '50.00', 1, '1', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(61, 14, 'Certificate of No Record', '30.00', 1, '1', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(62, 14, 'Annotation Fee', '50.00', 1, '1', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(63, 14, 'Tax Mapping Control Roll (TMCR)', '30.00', 1, '1', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(64, 14, 'Cancellation of Adverse Claim', '50.00', 1, '1', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(65, 14, 'Certified True Copy/Photo Copy', '50.00', 1, '1', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(66, 14, 'Certificate of No Record', '30.00', 1, '1', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(67, 14, 'Certified Photocopy (DV)', '35.00', 1, '1', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(68, 14, 'Certified Photocopy: Tax Declaration, Supporting Documents etc.', '50.00', 1, '1', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(69, 14, 'Certified Photocopy of Sketch Plan', '50.00', 1, '1', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(70, 14, 'Certificate of Non-Improvement', '30.00', 1, '1', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(71, 14, 'Certified Photocopy of Tax Declaration', '50.00', 1, '1', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(72, 14, 'Certificate of Property Holdings', '30.00', 1, '1', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(73, 14, 'General Clearance (Local)', '15.00', 1, '1', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(74, 14, 'General Clearance (Abroad)', '30.00', 1, '1', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(75, 14, 'Certification Fee (Service Record)', '50.00', 1, '1', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(76, 14, 'Certificate of Non-Encumbrance', '30.00', 1, '1', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(77, 14, 'Certificate of Employment', '50.00', 1, '1', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(78, 14, 'Certification of Loan Payments/Amortization, etc.', '50.00', 1, '1', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(79, 14, 'Certification showing the existence and non-existence of any document', '30.00', 1, '1', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(80, 14, 'Certification of Sand and Gravel Tax Payment', '50.00', 1, '1', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(81, 14, 'Certificate of Non-Property', '50.00', 1, '1', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(82, 14, 'Certificate of Tax Exemption', '50.00', 1, '1', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(83, 14, 'Certificate of Assessment', '50.00', 1, '1', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(84, 14, 'Annotation of Court Order/Decision', '50.00', 1, '1', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(85, 14, 'Deed of Redemption', '50.00', 1, '1', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(86, 14, 'Cancellation Fee on Mortgage', '50.00', 1, '1', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(87, 14, 'Certification Fee', '50.00', 1, '1', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(88, 14, 'Plain Photocopy', '10.00', 1, '1', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(89, 14, 'Certification of Loan Payments', '50.00', 1, '1', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(90, 14, 'Certification of Amortization', '50.00', 1, '1', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(91, 14, 'Service Fee for the Annotation/Cancellation of Mortgage', '25.00', 1, '1', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(92, 14, 'Certificate of Non-Improvement', '30.00', 1, '1', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(93, 14, 'For blue printing per copy', '50.00', 1, '1', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(94, 14, 'For blue printing per copy with certification', '70.00', 1, '1', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(95, 14, 'Certificate of Landholdings', '30.00', 1, '1', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(96, 14, 'Annotation/Discharged of Mortgaged', '50.00', 1, '1', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(97, 14, 'Certified True Copy/Photocopy', '50.00', 1, '1', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(98, 14, 'Annotation/Cancellation of Mortgaged', '25.00', 1, '1', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(99, 14, 'General Clearance (Local)', '15.00', 1, '1', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(100, 14, 'General Clearance (Abroad)', '30.00', 1, '1', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(101, 14, 'Cancellation of Adverse Claim', '50.00', 1, '1', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(102, 14, 'Certificate of Employment', '50.00', 1, '1', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(103, 14, 'Certification of Loan Payments/Amortization, etc.', '50.00', 1, '1', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(104, 14, 'Annotation of Adverse Claim', '5.00', 1, '1', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(105, 14, 'Certification of Tax Payment', '50.00', 1, '1', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(106, 14, 'Certificate of No Record', '30.00', 1, '1', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(107, 14, 'Certificate of Tax Exemption', '50.00', 1, '1', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(108, 14, 'Certificate of Last Salary', '50.00', 1, '1', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(109, 14, 'Annotation of Court Order/Decision', '50.00', 1, '1', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(110, 14, 'Certified Photocopy Plain', '10.00', 1, '1', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(111, 14, 'Certified Copy of Section Map', '50.00', 1, '1', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(112, 14, 'Cancellation Fee on Mortgage', '50.00', 1, '1', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(113, 14, 'Certification of Loan Payments', '50.00', 1, '1', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(114, 14, 'Certification of Amortization', '50.00', 1, '1', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(115, 14, 'Service Fee for the Annotation/Cancellation of Mortgage', '25.00', 1, '1', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(116, 14, 'Field Appraisal Application Sheet', '50.00', 1, '1', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(117, 14, 'Certified Copy of Lot Plan/s', '50.00', 1, '1', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(118, 14, 'Certificate of Full Payment', '50.00', 1, '1', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(119, 14, 'Annotation of Lis Pendens', '25.00', 1, '1', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(120, 14, 'Cancellation of Levy', '25.00', 1, '1', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(121, 14, 'Certificate (BTS)', '50.00', 1, '1', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(122, 14, 'Transcript (BTS)', '50.00', 1, '1', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(123, 15, 'Animal Quarantine Regulatory Fee - Shipped In Bee/s (Queen)', '7.00', 1, 'Queen', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(124, 15, 'Animal Quarantine Regulatory Fee - Shipped In Bee Products Honey', '5.00', 1, 'liter', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(125, 15, 'Animal Quarantine Regulatory Fee - Shipped Out Cattle, Carabao, Horse', '15.00', 1, 'head', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(126, 15, 'Animal Quarantine Regulatory Fee - Shipped Out Swine: Category A (61 kgs-80 kgs)', '15.00', 1, 'head', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(127, 15, 'Animal Quarantine Regulatory Fee - Shipped Out Swine: Category B (81 kgs-199 kgs)', '20.00', 1, 'head', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(128, 15, 'Animal Quarantine Regulatory Fee - Shipped Out Swine (Grower: 30-60 kgs5)', '10.00', 1, 'head', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(129, 15, 'Animal Quarantine Regulatory Fee - Shipped Out Swine (Weanlings: 16-29 kgs)', '5.00', 1, 'head', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(130, 15, 'Animal Quarantine Regulatory Fee - Shipped Out Piglets ( 10-15 kgs ) ', '3.00', 1, 'head', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(131, 15, 'Animal Quarantine Regulatory Fee - Shipped Out Goat, Sheep, Cat, Dog', '5.00', 1, 'head', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(132, 15, 'Animal  Quarantine Regulatory Fee - Shipped Out Poultry Eggs case/30doz/360pcs', '3.00', 1, 'case', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(133, 15, 'Animal  Quarantine Regulatory Fee - Shipped Out Poultry Eggs crate/35doz/420pcs', '3.50', 1, 'crate', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(134, 15, 'Animal Quarantine Regulatory Fee - Shipped Out Pullets (Ready to lay)', '0.15', 1, 'head', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(135, 15, 'Animal Quarantine Regulatory Fee - Shipped Out Culled Layers', '0.10', 1, 'head', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(136, 15, 'Animal Quarantine Regulatory Fee - Shipped Out Breeder Cull', '0.10', 1, 'head', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(137, 15, 'Animal Quarantine Regulatory Fee - Shipped Out Assorted Meat Products and Meat by- products ', '0.15', 1, 'head', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(138, 15, 'Animal Quarantine Regulatory Fee - Shipped Out Duck, Native Chicken, Quail, Turkey', '0.15', 1, 'head', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(139, 15, 'Animal Quarantine Regulatory Fee - Shipped Out Assorted Meat Products and Meat by - products', '0.15', 1, 'head', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(140, 15, 'Animal Quarantine Regulatory Fee - Shipped Out Bee/s (Colony)', '10.00', 1, 'colony', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(141, 15, 'Animal Quarantine Regulatory Fee - Shipped Out Bee/s (Queen)', '5.00', 1, 'queen', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(142, 15, 'Animal Quarantine Regulatory Fee - Shipped Out Bee Products Honey', '2.50', 1, 'liter', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(143, 15, 'Animal Quarantine Regulatory Fees', '0.00', 0, NULL, '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(144, 15, 'Animal  Quarantine Regulatory Fee - Shipped In Poultry Eggs crate/35doz/420pcs', '0.00', 1, 'Crate', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(145, 15, 'Animal Quarantine Regulatory Fee - Shipped In Raw Chicken Dung/Manure', '0.00', 1, 'Sack/sack', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(146, 15, 'Animal Quarantine Regulatory Fee -Shipped In Assorted Chicken Products', '0.00', 1, 'kgs.', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(147, 15, 'Animal Quarantine Regulatory Fee - Swine: Category A(61 kgs-80 kgs)', '0.00', 1, 'Head', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(148, 15, 'Animal Quarantine Regulatory Fee - Shipped In Goat', '10.00', 1, 'Head', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(149, 15, 'Animal Quarantine Regulatory Fee - Shipped In Sheep', '10.00', 1, 'Head', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(150, 15, 'Animal Quarantine Regulatory Fee - Shipped In Cattle', '25.00', 1, 'Head', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(151, 15, 'Animal Quarantine Regulatory Fee - Shipped In Carabao', '25.00', 1, 'Head', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(152, 15, 'Animal Quarantine Regulatory Fee - Shipped In Horse', '25.00', 1, 'Head', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(153, 15, 'Animal Quarantine Regulatory Fee - Shipped In Bangus', '0.15', 1, 'kgs.', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(154, 15, 'Animal Quarantine Regulatory Fee -  Shipped In Tilapia', '0.15', 1, 'kgs.', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(155, 15, 'Animal Quarantine Regulatory Fee -  Shipped In Shrimp', '0.15', 1, 'kgs.', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(156, 15, 'Animal Quarantine Regulatory Fee - Shipped In Other Marine Fishes/Species', '0.15', 1, 'kgs.', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(157, 15, 'Animal Quarantine Regulatory Fee - Fighting Cock', '200.00', 1, 'Head', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(158, 15, 'Animal Quarantine Regulatory Fee - Shipped In Assorted Meat Products and Meat by- products ', '0.10', 1, 'kgs.', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(159, 15, 'Animal Quarantine Regulatory Fee - Shipped In Goat, Sheep, cat, Dog', '6.00', 1, 'Head', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(160, 15, 'Animal Quarantine Regulatory Fee - Processed Chicken Manure (PCM)', '30.00', 1, 'sack', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(161, 15, 'Animal  Quarantine Regulatory Fee - Shipped In Poultry Eggs case/30doz/360pcs', '6.00', 1, 'case', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(162, 15, 'Animal Quarantine Regulatory Fee - Shipped In Swine: Category B (81 kgs-199 kgs)', '30.00', 1, 'head', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(163, 15, 'Animal Quarantine Regulatory Fee - Shipped In Swine: Grower (30 kgs-60 kgs)', '20.00', 1, 'head', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(164, 15, 'Animal Quarantine Regulatory Fee - Shipped In Swine: Weanlings (16 kgs-29 kgs)', '10.00', 1, 'head', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(165, 15, 'Animal Quarantine Regulatory Fee - Shipped In Piglets (10 kgs-15 kgs)', '7.00', 1, 'head', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(166, 15, 'Animal Quarantine Regulatory Fee - Shipped In Hog (200 kgs and above)', '120.00', 1, 'head', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(167, 15, 'Animal Quarantine Regulatory Fee - Shipped In Day - old Chick  ', '0.35', 1, 'head', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(168, 15, 'Animal Quarantine Regulatory Fee - Shipped In Pullets (Ready to lay)', '0.35', 1, 'head', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(169, 15, 'Animal Quarantine Regulatory Fee - Shipped In Culled Layers', '0.15', 1, 'head', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(170, 15, 'Animal Quarantine Regulatory Fee - Shipped In Breeder Cull', '0.15', 1, 'head', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(171, 15, 'Animal Quarantine Regulatory Fee - Shipped In Broiler', '0.35', 1, 'head', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(172, 15, 'Animal Quarantine Regulatory Fee - Shipped In Duck, Native Chicken, Quail, Turkey', '0.35', 1, 'head', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(173, 15, 'Animal Quarantine Regulatory Fee - Shipped In Bee/s (Colony)', '15.00', 1, 'colony', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(174, 15, 'Animal Quarantine Regulatory Fee - Shipped In Bee/s (Queen)', '7.00', 1, 'Queen', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(175, 15, 'Animal Quarantine Regulatory Fee - Shipped In Bee Products Honey', '5.00', 1, 'liter', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(176, 15, 'Animal Quarantine Regulatory Fee - Shipped Out Cattle, Carabao, Horse', '15.00', 1, 'head', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(177, 15, 'Animal Quarantine Regulatory Fee - Shipped Out Swine: Category A (61 kgs-80 kgs)', '15.00', 1, 'head', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(178, 15, 'Animal Quarantine Regulatory Fee - Shipped Out Swine: Category B (81 kgs-199 kgs)', '20.00', 1, 'head', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(179, 15, 'Animal Quarantine Regulatory Fee - Shipped Out Swine (Grower: 30-60 kgs)', '10.00', 1, 'head', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(180, 15, 'Animal Quarantine Regulatory Fee - Shipped Out Swine (Weanlings: 16-29 kgs)', '5.00', 1, 'head', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(181, 15, 'Animal Quarantine Regulatory Fee - Shipped Out Piglets ( 10-15 kgs )', '3.00', 1, 'head', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(182, 15, 'Animal Quarantine Regulatory Fee - Shipped Out Goat, Sheep, Cat, Dog', '5.00', 1, 'head', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(183, 15, 'Animal  Quarantine Regulatory Fee - Shipped Out Poultry Eggs case/30doz/360pcs', '3.00', 1, 'case', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(184, 15, 'Animal  Quarantine Regulatory Fee - Shipped Out Poultry Eggs crate/35doz/420pcs', '3.50', 1, 'crate', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(185, 15, 'Animal Quarantine Regulatory Fee - Shipped Out Pullets (Ready to lay)', '0.15', 1, 'head', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(186, 15, 'Animal Quarantine Regulatory Fee - Shipped Out Culled Layers', '0.15', 1, 'head', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(187, 15, 'Animal Quarantine Regulatory Fee - Shipped Out Breeder Cull', '0.10', 1, 'head', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(188, 15, 'Animal Quarantine Regulatory Fee - Shipped Out Broiler', '0.15', 1, 'head', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(189, 15, 'Animal Quarantine Regulatory Fee - Shipped Out Duck, Native Chicken, Quail, Turkey', '0.15', 1, 'head', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(190, 15, 'Animal Quarantine Regulatory Fee - Shipped Out Assorted Meat Products and Meat by- products', '0.15', 1, 'head', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(191, 15, 'Animal Quarantine Regulatory Fee - Shipped Out Bee/s (Colony)', '0.15', 1, 'colony', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(192, 15, 'Animal Quarantine Regulatory Fee - Shipped Out Bee/s (Queen)', '0.15', 1, 'queen', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(193, 15, 'Animal Quarantine Regulatory Fee - Shipped Out Bee Products Honey', '0.15', 1, 'liter', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(194, 15, 'Animal Quarantine Regulatory Fees', '0.15', 0, NULL, '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(195, 16, 'Verification Fee', '20.00', 1, '1', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(196, 16, 'Verification Fee', '500.00', 1, '1', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(197, 18, 'Rental: Ben Palispis Hall', '1600.00', 0, NULL, '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(198, 18, 'Rental: Open Gymnasium', '1000.00', 1, 'first 8 hrs', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(199, 18, 'Lot Rental', '3660.00', 1, 'month', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(200, 18, 'Rental: Closed Gym', '1000.00', 1, 'hour', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(201, 18, 'Rental: Solibao/Gongs', '1000.00', 0, NULL, '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(202, 18, 'Rental: Ethnic dancing blankets(3 pcs.)', '250.00', 0, NULL, '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(203, 18, 'Rental: Devit', '100.00', 0, NULL, '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(204, 18, 'Rental: G-string', '50.00', 0, NULL, '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(205, 18, 'Rental: Vest/Chaleco', '100.00', 0, NULL, '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(206, 18, 'Rental: Head dress', '50.00', 0, NULL, '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(207, 18, 'Rental: Kayabang', '20.00', 0, NULL, '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(208, 18, 'Rental: Steel chairs', '2.00', 0, NULL, '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(209, 18, 'Rental: Parachute', '500.00', 0, NULL, '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(210, 18, 'Rental: Grandstand with Oval (day time)', '500.00', 0, NULL, '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(211, 18, 'Rental: Grandstand with Oval (night time)', '700.00', 0, NULL, '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(212, 18, 'Rental: Sound System', '400.00', 0, NULL, '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(213, 18, 'Lot Rental', '1966.25', 0, NULL, '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(214, 18, 'Lot Rental', '2147.75', 0, NULL, '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(215, 18, 'Lot Rental', '3327.50', 0, NULL, '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(216, 18, 'Rental Fee (120 sqm portion PHO)', '60000.00', 0, NULL, '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(217, 18, 'Rental: Covered Court', '100.00', 0, NULL, '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(218, 19, 'Truck Rentals', '5000.00', 0, NULL, '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(219, 19, 'Cold Storage Rentals', '350.00', 0, NULL, '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(220, 19, 'Crates Rental', '100.00', 0, NULL, '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(221, 20, 'Commercial purposes', '2.00', 1, 'sq.m', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(222, 20, 'Residential purposes', '1.50', 1, 'sq.m', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(223, 21, 'Delivery Receipt (Industrial)', '130.00', 1, 'pad', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(224, 21, 'Delivery Receipt (Commercial)', '130.50', 1, 'pad', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(225, 21, 'Forms', '30.00', 0, NULL, '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(226, 21, 'Filing Fee', '750.00', 0, NULL, '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(227, 21, 'Processing Fee', '50.00', 0, NULL, '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(228, 21, 'Application Fee', '750.00', 0, NULL, '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(229, 21, 'Application Fee', '300.00', 0, NULL, '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(230, 21, 'Filing Fee', '50.00', 0, NULL, '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(231, 21, 'Registration of Small Scale Miners', '500.00', 0, NULL, '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(232, 21, 'Book (Treasury of Beliefs and Home Rituals)', '100.00', 1, 'Book', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(233, 22, 'Biological Asset', '0.00', 0, NULL, '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(234, 22, 'Veterinary Drugs/Medicines/Vaccine', '0.00', 0, NULL, '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(235, 22, 'Agricultural Produce (Egg, meat, honey, boar semen)', '0.00', 0, NULL, '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(236, 22, 'Medical Fee (wound repair, VSP, AI, Castration, Spay, etc.)', '0.00', 0, NULL, '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(237, 22, 'Other Supplies (Syringes, catgut, squeeze bottle, catheter, vac\'n cards, etc.)', '0.00', 0, NULL, '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(238, 22, 'Inspcetion Fee', '0.00', 0, NULL, '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(239, 24, 'ID Fee (BTS)', '100.00', 1, '1', '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(240, 25, 'Tuition Fee Automotive Servicing NC I', '50.00', 0, NULL, '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(241, 25, 'Tuition Fee Bread and Pastry Production NC II', '50.00', 0, NULL, '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(242, 25, 'Tuition Fee Hairdressing NC II', '50.00', 0, NULL, '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(243, 25, 'Tuition Fee Tailoring NC II', '50.00', 0, NULL, '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(244, 25, 'Tuition Fee Beauty Care NC II', '50.00', 0, NULL, '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(245, 25, 'Training Fees', '100.00', 0, NULL, '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(246, 27, 'ID Fee', '100.00', 1, '1', '2022-03-28 16:25:28', '2022-03-28 16:25:28');

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
(1, 7878912, 7878990, 'Form 51', 'Pac', 1, NULL, NULL, '2022-03-28 16:25:28', '2022-03-28 16:25:28', NULL),
(2, 4848733, 8585745, 'Form 51', 'Sals', 1, NULL, NULL, '2022-03-28 16:25:28', '2022-03-28 16:25:28', NULL),
(3, 2625323, 5151264, 'Form 51', 'Pac', 1, NULL, NULL, '2022-03-28 16:25:28', '2022-03-28 16:25:28', NULL),
(4, 7897899, 7899877, 'Form 56', 'Lee', NULL, 1, NULL, '2022-03-28 16:25:28', '2022-03-28 16:25:28', NULL),
(5, 7000000, 7001000, 'Form 51', 'Continuous', 2, NULL, 4, '2022-03-28 16:25:28', '2022-03-28 16:25:28', NULL),
(6, 1, 200, 'Form 51', 'Continuous', 1, NULL, 4, '2022-03-28 16:25:28', '2022-03-28 16:25:28', NULL);

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
(1, 'Admin Admin', 'admin@black.com', '2022-03-28 16:25:28', '$2y$10$g07sglfdZ37mviWk0TveUOdIOMHlxQI1GPtPqTZU8UCzVMFgxKPM2', NULL, '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(2, 'Admin 1', 'admin1@revenue.com', '2022-03-28 16:25:28', '$2y$10$7tV11KlWcMd1eBr4xaqA/.Q3pouga090hIFKkd7V98cohbjWB854u', NULL, '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(3, 'Admin 2', 'admin2', '2022-03-28 16:25:28', '$2y$10$RcP.EJkB89q/0DTKyzz01OfOkQ1CXQj8YgSGwZt/JrZTv3qXGAqse', NULL, '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(4, '$2y$10$2xXMoBf5scw88yXHfR0gtOFhX.Vx0lsym5J94abQAhbgm..kTZlOG', '2022-03-29 00:25:28', '0000-00-00 00:00:00', '2022-03-29 00:25:28', NULL, '2022-03-28 16:25:28', '0000-00-00 00:00:00'),
(5, 'PC UNIT 2', 'pcunit2', '2022-03-28 16:25:28', '$2y$10$ABLFikfN9o.psK52WMaC9Om6lUS7dLOeIDq4GfuP.MIb2n/yzldTi', NULL, '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(6, 'PC UNIT 3', 'pcunit3', '2022-03-28 16:25:28', '$2y$10$nDGuD70nquh17OHwZZj/WuczR2s8GHXw3kU.7cNoFdNYmZgo3yK7.', NULL, '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(7, 'PC UNIT 4', 'pcunit4', '2022-03-28 16:25:28', '$2y$10$TdVKDtke7.yzFmewQkmDn.TPEr12L.e03N3.dcM6/84vcS1r9brO2', NULL, '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(8, 'PC UNIT 5', 'pcunit5', '2022-03-28 16:25:28', '$2y$10$idqGJc06qpNCfDpgaho83uTHBx8Nz44GCRSg3nD41kIThyVKouc9G', NULL, '2022-03-28 16:25:28', '2022-03-28 16:25:28'),
(9, 'PC UNIT 6', 'pcunit6', '2022-03-28 16:25:28', '$2y$10$Dk/4NrbQIeZYxEDAXN8gj.bSdkVyL1qk9PuHISXowGIfxFvhAuSI2', NULL, '2022-03-28 16:25:28', '2022-03-28 16:25:28');

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `land_tax_infos`
--
ALTER TABLE `land_tax_infos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `rate_changes`
--
ALTER TABLE `rate_changes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `rate_schedules`
--
ALTER TABLE `rate_schedules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=247;

--
-- AUTO_INCREMENT for table `report_officers`
--
ALTER TABLE `report_officers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `serials`
--
ALTER TABLE `serials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

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
