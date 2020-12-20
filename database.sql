-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 07, 2020 at 10:18 AM
-- Server version: 5.7.24
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `assignmenthut_xampp`
--

-- --------------------------------------------------------

--
-- Table structure for table `academic_levels`
--

CREATE TABLE `academic_levels` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `academic_levels`
--

INSERT INTO `academic_levels` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Doctoral', '2020-09-19 12:56:05', '2020-09-19 12:56:05'),
(2, 'Masters', '2020-09-19 12:56:05', '2020-09-19 12:56:05'),
(3, 'Bachelors', '2020-09-19 12:56:05', '2020-09-19 12:56:05'),
(4, 'Diploma', '2020-09-19 12:56:05', '2020-09-19 12:56:05'),
(5, 'High School', '2020-09-19 12:56:06', '2020-09-19 12:56:06');

-- --------------------------------------------------------

--
-- Table structure for table `assignment_orders`
--

CREATE TABLE `assignment_orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `price` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_files` mediumtext COLLATE utf8mb4_unicode_ci,
  `solution` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `completed` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `user_id` int(10) UNSIGNED NOT NULL,
  `currency_id` int(10) UNSIGNED NOT NULL,
  `service_id` int(10) UNSIGNED NOT NULL,
  `no_of_pages` int(10) UNSIGNED NOT NULL,
  `academic_level_id` int(10) UNSIGNED NOT NULL,
  `paper_id` bigint(20) NOT NULL,
  `deadline` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Processing',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `price_id` bigint(20) NOT NULL,
  `paypal_link` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `conversations`
--

CREATE TABLE `conversations` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_one` int(10) UNSIGNED NOT NULL,
  `user_two` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

CREATE TABLE `currencies` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`id`, `name`, `value`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'AUD', '1', '2020-09-19 12:56:05', '2020-09-19 12:56:05', NULL),
(2, 'GBP', '0.79', '2020-09-19 12:56:05', '2020-09-19 12:56:05', NULL),
(3, 'EUR', '0.89', '2020-09-19 12:56:05', '2020-09-19 12:56:05', NULL),
(4, 'CAD', '1.34', '2020-09-19 12:56:05', '2020-09-19 12:56:05', NULL),
(5, 'USD', '1.43', '2020-09-19 12:56:05', '2020-09-19 12:56:05', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id` int(10) UNSIGNED NOT NULL,
  `file` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `assignment_order_id` int(10) UNSIGNED NOT NULL,
  `revision_file` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_delivered` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(10) UNSIGNED NOT NULL,
  `conversation_id` int(10) UNSIGNED NOT NULL,
  `sender_id` int(10) UNSIGNED NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_seen` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_from_sender` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_from_receiver` tinyint(1) NOT NULL DEFAULT '0',
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
(3, '2017_10_24_140229_create_conversaions_table', 1),
(4, '2017_10_24_140250_create_messages_table', 1),
(5, '2019_02_19_062049_create_paypals_table', 1),
(6, '2019_03_13_112054_create_currencies_table', 1),
(7, '2019_03_13_112229_create_orders_table', 1),
(8, '2019_03_14_153855_create_permission_tables', 1),
(9, '2019_03_31_074144_create_notes_table', 1),
(10, '2019_03_31_074201_create_files_table', 1),
(11, '2020_03_20_110829_create_revisions_table', 1),
(12, '2020_03_20_190505_add_img_to_users', 1),
(13, '2020_03_23_195459_add_file_id_to_revisions', 1),
(14, '2020_03_27_113833_create_paypal_keys_table', 1),
(15, '2020_03_28_155226_add_role_to_users', 1),
(16, '2020_04_04_214854_create_services_table', 1),
(17, '2020_04_04_214945_create_problem_types_table', 1),
(18, '2020_04_04_215019_create_academic_levels_table', 1),
(19, '2020_04_05_104624_create_assignment_orders_table', 1),
(20, '2020_04_05_141206_create_prices_table', 1),
(21, '2020_04_08_122040_payment_data', 1),
(22, '2020_04_08_160525_create_papers_table', 1),
(23, '2020_05_04_134036_add_disable_to_services', 1),
(24, '2020_05_21_102957_add_price_id_to_assignment_orders', 1),
(25, '2020_05_21_103445_add_paypal_link_to_assignment_orders', 1),
(26, '2020_06_07_143912_add_change_email_request_to_users', 1),
(27, '2020_06_10_122455_create_order_metas_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` int(10) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\User', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `id` int(10) UNSIGNED NOT NULL,
  `text` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `assignment_order_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `info` text COLLATE utf8mb4_unicode_ci,
  `details` text COLLATE utf8mb4_unicode_ci,
  `file` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `solution` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `completed` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `user_id` int(10) UNSIGNED NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'processing',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_metas`
--

CREATE TABLE `order_metas` (
  `id` int(10) UNSIGNED NOT NULL,
  `assignment_order_id` bigint(20) NOT NULL,
  `no_of_sources` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `paper_format` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_comments` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `papers`
--

CREATE TABLE `papers` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `papers`
--

INSERT INTO `papers` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Essay', '2020-09-19 12:56:08', '2020-09-19 12:56:08'),
(2, 'MCQs', '2020-09-19 12:56:08', '2020-09-19 12:56:08'),
(3, 'Paragraph Writing', '2020-09-19 12:56:08', '2020-09-19 12:56:08'),
(4, 'Thesis', '2020-09-19 12:56:08', '2020-09-19 12:56:08'),
(5, 'Research Paper', '2020-09-19 12:56:08', '2020-09-19 12:56:08');

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
-- Table structure for table `paymentdata`
--

CREATE TABLE `paymentdata` (
  `id` int(10) UNSIGNED NOT NULL,
  `result` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `assignment_order_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `paypals`
--

CREATE TABLE `paypals` (
  `id` int(10) UNSIGNED NOT NULL,
  `info` text COLLATE utf8mb4_unicode_ci,
  `price` int(10) UNSIGNED NOT NULL,
  `verified` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `paypal_keys`
--

CREATE TABLE `paypal_keys` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mode` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `prices`
--

CREATE TABLE `prices` (
  `id` int(10) UNSIGNED NOT NULL,
  `service_id` bigint(20) NOT NULL,
  `paper_id` bigint(20) NOT NULL DEFAULT '0',
  `academic_level_id` bigint(20) NOT NULL,
  `price` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `urgency_value` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `urgency_hour_or_day` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'days',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `prices`
--

INSERT INTO `prices` (`id`, `service_id`, `paper_id`, `academic_level_id`, `price`, `urgency_value`, `urgency_hour_or_day`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, '10.99', '28', 'days', '2020-09-19 12:56:06', '2020-09-19 12:56:06'),
(2, 1, 1, 1, '11.99', '14', 'days', '2020-09-19 12:56:06', '2020-09-19 12:56:06'),
(3, 1, 1, 1, '12.99', '10', 'days', '2020-09-19 12:56:06', '2020-09-19 12:56:06'),
(4, 1, 1, 1, '13.55', '7', 'days', '2020-09-19 12:56:06', '2020-09-19 12:56:06'),
(5, 1, 1, 1, '13.99', '6', 'days', '2020-09-19 12:56:06', '2020-09-19 12:56:06'),
(6, 1, 1, 1, '14.55', '5', 'days', '2020-09-19 12:56:06', '2020-09-19 12:56:06'),
(7, 1, 1, 1, '16.99', '48', 'hours', '2020-09-19 12:56:06', '2020-09-19 12:56:06'),
(8, 1, 1, 1, '19.99', '24', 'hours', '2020-09-19 12:56:06', '2020-09-19 12:56:06'),
(9, 1, 1, 1, '22.99', '12', 'hours', '2020-09-19 12:56:06', '2020-09-19 12:56:06'),
(10, 1, 1, 1, '25.99', '8', 'hours', '2020-09-19 12:56:06', '2020-09-19 12:56:06'),
(11, 2, 1, 1, '10.99', '28', 'days', '2020-09-19 12:56:06', '2020-09-19 12:56:06'),
(12, 2, 1, 1, '11.99', '14', 'days', '2020-09-19 12:56:06', '2020-09-19 12:56:06'),
(13, 2, 1, 1, '12.99', '10', 'days', '2020-09-19 12:56:07', '2020-09-19 12:56:07'),
(14, 2, 1, 1, '13.55', '7', 'days', '2020-09-19 12:56:07', '2020-09-19 12:56:07'),
(15, 2, 1, 1, '13.99', '6', 'days', '2020-09-19 12:56:07', '2020-09-19 12:56:07'),
(16, 2, 1, 1, '14.55', '5', 'days', '2020-09-19 12:56:07', '2020-09-19 12:56:07'),
(17, 2, 1, 1, '16.99', '48', 'hours', '2020-09-19 12:56:07', '2020-09-19 12:56:07'),
(18, 2, 1, 1, '19.99', '24', 'hours', '2020-09-19 12:56:07', '2020-09-19 12:56:07'),
(19, 2, 1, 1, '22.99', '12', 'hours', '2020-09-19 12:56:07', '2020-09-19 12:56:07'),
(20, 2, 1, 1, '25.99', '8', 'hours', '2020-09-19 12:56:07', '2020-09-19 12:56:07'),
(21, 1, 1, 2, '10.99', '28', 'days', '2020-09-19 12:56:07', '2020-09-19 12:56:07'),
(22, 1, 1, 2, '11.99', '14', 'days', '2020-09-19 12:56:07', '2020-09-19 12:56:07'),
(23, 1, 1, 2, '12.99', '10', 'days', '2020-09-19 12:56:07', '2020-09-19 12:56:07'),
(24, 1, 1, 2, '13.55', '7', 'days', '2020-09-19 12:56:07', '2020-09-19 12:56:07'),
(25, 1, 1, 2, '13.99', '6', 'days', '2020-09-19 12:56:07', '2020-09-19 12:56:07'),
(26, 1, 1, 2, '14.55', '5', 'days', '2020-09-19 12:56:07', '2020-09-19 12:56:07'),
(27, 1, 1, 2, '16.99', '48', 'hours', '2020-09-19 12:56:07', '2020-09-19 12:56:07'),
(28, 1, 1, 2, '19.99', '24', 'hours', '2020-09-19 12:56:07', '2020-09-19 12:56:07'),
(29, 1, 1, 2, '22.99', '12', 'hours', '2020-09-19 12:56:07', '2020-09-19 12:56:07'),
(30, 1, 1, 2, '25.99', '8', 'hours', '2020-09-19 12:56:07', '2020-09-19 12:56:07'),
(31, 2, 1, 2, '10.99', '28', 'days', '2020-09-19 12:56:07', '2020-09-19 12:56:07'),
(32, 2, 1, 2, '11.99', '14', 'days', '2020-09-19 12:56:07', '2020-09-19 12:56:07'),
(33, 2, 1, 2, '12.99', '10', 'days', '2020-09-19 12:56:07', '2020-09-19 12:56:07'),
(34, 2, 1, 2, '13.55', '7', 'days', '2020-09-19 12:56:07', '2020-09-19 12:56:07'),
(35, 2, 1, 2, '13.99', '6', 'days', '2020-09-19 12:56:07', '2020-09-19 12:56:07'),
(36, 2, 1, 2, '14.55', '5', 'days', '2020-09-19 12:56:08', '2020-09-19 12:56:08'),
(37, 2, 1, 2, '16.99', '48', 'hours', '2020-09-19 12:56:08', '2020-09-19 12:56:08'),
(38, 2, 1, 2, '19.99', '24', 'hours', '2020-09-19 12:56:08', '2020-09-19 12:56:08'),
(39, 2, 1, 2, '22.99', '12', 'hours', '2020-09-19 12:56:08', '2020-09-19 12:56:08'),
(40, 2, 1, 2, '25.99', '8', 'hours', '2020-09-19 12:56:08', '2020-09-19 12:56:08'),
(41, 3, 2, 5, '90', '9', 'days', '2020-10-21 09:10:55', '2020-10-21 09:10:55');

-- --------------------------------------------------------

--
-- Table structure for table `problem_types`
--

CREATE TABLE `problem_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `revisions`
--

CREATE TABLE `revisions` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `service_id` bigint(20) NOT NULL,
  `assignment_order_id` bigint(20) NOT NULL,
  `iteration` bigint(20) NOT NULL DEFAULT '0',
  `note` mediumtext COLLATE utf8mb4_unicode_ci,
  `file` mediumtext COLLATE utf8mb4_unicode_ci,
  `solved` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `file_id` bigint(20) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'web', '2020-09-19 12:56:04', '2020-09-19 12:56:04');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `disable` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `name`, `created_at`, `updated_at`, `disable`) VALUES
(1, 'Academic Essay/Assignment', '2020-09-19 12:56:06', '2020-09-19 12:56:06', '0'),
(2, 'Business Report', '2020-09-19 12:56:06', '2020-09-19 12:56:06', '0'),
(3, 'Case Study', '2020-09-19 12:56:06', '2020-09-19 12:56:06', '0'),
(4, 'Dissertation/Thesis', '2020-09-19 12:56:06', '2020-09-19 12:56:06', '0'),
(5, 'Statistics/Economics Problem', '2020-09-19 12:56:06', '2020-09-19 12:56:06', '0'),
(6, 'PowerPoint Presentation', '2020-09-19 12:56:06', '2020-09-19 12:56:06', '0'),
(7, 'Reflection', '2020-09-19 12:56:06', '2020-09-19 12:56:06', '0'),
(8, 'Article Critique', '2020-09-19 12:56:06', '2020-09-19 12:56:06', '0'),
(9, 'Lab Report', '2020-09-19 12:56:06', '2020-09-19 12:56:06', '0'),
(10, 'Rewriting', '2020-09-19 12:56:06', '2020-09-19 12:56:06', '0'),
(11, 'Proofreading', '2020-09-19 12:56:06', '2020-09-19 12:56:06', '0');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `profile_image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'sample_img.jpg',
  `isAdmin` bigint(20) NOT NULL DEFAULT '0',
  `change_email_request` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `lastname`, `phone`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `deleted_at`, `profile_image`, `isAdmin`, `change_email_request`) VALUES
(1, 'admin', NULL, NULL, 'admin@assignmenthut.com', '2020-09-19 12:56:05', '$2y$10$QqVN8s9jsPDr3qytJO6YZe3WnspMAohAcj1E7Q1et6y/whd.HPhC.', NULL, '2020-09-19 12:56:05', '2020-09-19 12:56:05', NULL, 'sample_img.jpg', 1, '0'),
(2, 'customer', NULL, '001234567890', 'customer@assignmenthut.com', '2020-09-19 12:56:05', '$2y$10$gnOX1JbNPCQVq4qVN5qkf.cSUVViZVFKnQ0ko/w1Z7dOue52QWT3W', 'nFmigcP9xbjGRxHfjifSZ3evpkoq5ZuQeaFweZZJAhI7ZHGC5gFB76PRUNTc', '2020-09-19 12:56:05', '2020-09-29 03:13:43', NULL, 'sample_img.jpg', 0, '0'),
(3, 'customer4', NULL, NULL, 'customer4@example.com', NULL, '$2y$10$GHbdGoaCiDPMop9aWvRMqe8rK0nWg51j0h71kFzvvLqEFLbHZ8V1u', NULL, '2020-10-04 07:46:41', '2020-10-04 07:46:41', NULL, 'sample_img.jpg', 0, '0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `academic_levels`
--
ALTER TABLE `academic_levels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assignment_orders`
--
ALTER TABLE `assignment_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `conversations`
--
ALTER TABLE `conversations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `currencies_name_unique` (`name`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `files_user_id_foreign` (`user_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `messages_conversation_id_foreign` (`conversation_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notes_user_id_foreign` (`user_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Indexes for table `order_metas`
--
ALTER TABLE `order_metas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `papers`
--
ALTER TABLE `papers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `paymentdata`
--
ALTER TABLE `paymentdata`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paypals`
--
ALTER TABLE `paypals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paypal_keys`
--
ALTER TABLE `paypal_keys`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prices`
--
ALTER TABLE `prices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `problem_types`
--
ALTER TABLE `problem_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `revisions`
--
ALTER TABLE `revisions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
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
-- AUTO_INCREMENT for table `academic_levels`
--
ALTER TABLE `academic_levels`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `assignment_orders`
--
ALTER TABLE `assignment_orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `conversations`
--
ALTER TABLE `conversations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_metas`
--
ALTER TABLE `order_metas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `papers`
--
ALTER TABLE `papers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `paymentdata`
--
ALTER TABLE `paymentdata`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `paypals`
--
ALTER TABLE `paypals`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `paypal_keys`
--
ALTER TABLE `paypal_keys`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `prices`
--
ALTER TABLE `prices`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `problem_types`
--
ALTER TABLE `problem_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `revisions`
--
ALTER TABLE `revisions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `files`
--
ALTER TABLE `files`
  ADD CONSTRAINT `files_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_conversation_id_foreign` FOREIGN KEY (`conversation_id`) REFERENCES `conversations` (`id`);

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `notes`
--
ALTER TABLE `notes`
  ADD CONSTRAINT `notes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
