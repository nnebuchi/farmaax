-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 29, 2022 at 12:42 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `farm`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `country` varchar(30) DEFAULT NULL,
  `state` int(11) DEFAULT NULL,
  `lga` int(11) DEFAULT NULL,
  `town` int(11) DEFAULT NULL,
  `landmark` varchar(100) DEFAULT NULL,
  `address` varchar(1000) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`id`, `user_id`, `country`, `state`, `lga`, `town`, `landmark`, `address`, `created_at`, `updated_at`) VALUES
(1, 2, NULL, 30, 9, NULL, 'Town Hall', 'Odugoa town haaa', '2020-12-09 10:45:07', '2020-12-09 11:53:07'),
(2, 2, NULL, 30, 15, NULL, 'Nepa Office', '1 king Esanwa, Mgbuoba, Port Harcourt', '2020-12-09 11:07:30', '2020-12-09 11:07:30'),
(3, 1, NULL, 1, 757, NULL, 'National Park', 'gyfthgdfgdfgdgnfdngfdngfdfngndfgdfgdfngdfngdfndfngd', '2021-04-05 00:21:53', '2021-04-05 00:21:53');

-- --------------------------------------------------------

--
-- Table structure for table `banks`
--

CREATE TABLE `banks` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `abbr` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `banks`
--

INSERT INTO `banks` (`id`, `name`, `abbr`) VALUES
(1, 'United Bank for Africa', 'UBA'),
(2, 'Guaranty Trust Bank', 'GTB'),
(3, 'Access Bank', NULL),
(4, 'Access Diamond', NULL),
(5, 'Citibank', NULL),
(6, 'Ecobank', NULL),
(7, 'Fidelity Bank', NULL),
(8, 'First Bank', NULL),
(9, 'First city Monument Bank', 'FCMB'),
(10, 'Globus Bank', NULL),
(11, 'Heritage Bank', NULL),
(12, 'Jazz Bank', NULL),
(13, 'Keystone Bank', NULL),
(14, 'Polaris Bank', NULL),
(15, 'Providus Bank', NULL),
(16, 'Stanbic IBTC', NULL),
(17, 'Standard Chartered Bank', NULL),
(18, 'Sterling Bank', NULL),
(19, 'Suntrust Bank', NULL),
(20, 'Titan Trust Bank', NULL),
(21, 'Union Bank', NULL),
(22, 'Unity Bank', NULL),
(23, 'Wema bank', NULL),
(24, 'Zenith Bank', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `buyer_id` int(11) DEFAULT NULL,
  `guest_id` text DEFAULT NULL,
  `guest_expires` int(11) NOT NULL DEFAULT 0,
  `seller_id` int(11) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `quantity` int(11) DEFAULT 1,
  `total` decimal(10,2) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `product_id`, `buyer_id`, `guest_id`, `guest_expires`, `seller_id`, `price`, `quantity`, `total`, `created_at`, `updated_at`) VALUES
(15, 6, NULL, '07af9dbb3824105cb864feba654d50935916af22', 1613127086, NULL, '3000.00', 4, '12000.00', '2021-01-13 10:51:26', '2021-01-13 11:00:03');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent` bigint(20) DEFAULT NULL,
  `image` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `managers` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `parent`, `image`, `description`, `managers`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'Crop Farm', 0, 'corn-297019_640_1601723061.png', NULL, NULL, 'admin', '2020-10-03 07:30:40', '2020-10-03 10:04:21'),
(2, 'Animal Farm', 0, 'farm-2063206_640_1601723178.png', NULL, NULL, 'admin', '2020-10-03 10:06:18', '2020-10-03 10:06:18'),
(3, 'Fish Farm', 0, 'fish-2020910_640_1601723265.png', NULL, NULL, 'admin', '2020-10-03 10:07:45', '2020-10-03 10:07:45'),
(7, 'Goat Farm', 2, 'download-Goat-png-transparent-images-transparent-backgrounds-PNGRIVER-COM-Goat_1601731308.png', 'Goat Farm is for meat', '2,7,8,16', 'admin', '2020-10-03 12:21:48', '2020-12-11 07:58:40'),
(8, 'Plantain Farm', 1, 'apple_1601733276.png', NULL, '2,7,16', 'admin', '2020-10-03 12:46:54', '2020-12-11 07:58:40'),
(9, 'Poultry Farm', 2, 'chicken_1601732884.png', NULL, '2,8,16', 'admin', '2020-10-03 12:48:04', '2020-12-11 07:58:40'),
(10, 'Catfish Farm', 3, 'catfish_1601749616.png', NULL, '2', 'admin', '2020-10-03 17:26:56', '2020-11-13 04:25:19'),
(11, 'Cocoa Farm', 1, 'cocoa_1605299755.png', 'Cocoa is a cash crop', NULL, 'admin', '2020-11-13 19:35:56', '2020-11-13 19:40:07');

-- --------------------------------------------------------

--
-- Table structure for table `consultant_settings`
--

CREATE TABLE `consultant_settings` (
  `id` int(11) NOT NULL,
  `fee` decimal(10,2) NOT NULL,
  `sub_options` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `consultant_settings`
--

INSERT INTO `consultant_settings` (`id`, `fee`, `sub_options`) VALUES
(1, '5000.00', 'realtor,lawyer,marketer');

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`id`, `name`) VALUES
(1, 'Nigeria');

-- --------------------------------------------------------

--
-- Table structure for table `earnings`
--

CREATE TABLE `earnings` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `description` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `earnings`
--

INSERT INTO `earnings` (`id`, `user_id`, `amount`, `description`, `created_at`, `updated_at`) VALUES
(1, 17, '10000.00', 'land_purchase_parent_commission', '2020-12-11 10:22:11', '2020-12-11 10:22:11'),
(2, 17, '4000.00', 'land_purchase_parent_commission', '2020-12-11 10:22:11', '2020-12-11 10:22:11'),
(3, 16, '4000.00', 'land_purchase_grand_parent_commission', '2020-12-11 10:22:11', '2020-12-11 10:22:11'),
(4, 15, '2000.00', 'land_purchase_great_grand_parent_commission', '2020-12-11 10:22:11', '2020-12-11 10:22:11'),
(5, 17, '10000.00', 'land_purchase_parent_commission', '2020-12-11 10:34:34', '2020-12-11 10:34:34'),
(6, 17, '4000.00', 'static_land_purchase_parent_commission', '2020-12-11 10:34:34', '2020-12-11 10:34:34'),
(7, 16, '4000.00', 'land_purchase_grand_parent_commission', '2020-12-11 10:34:34', '2020-12-11 10:34:34'),
(8, 15, '2000.00', 'land_purchase_great_grand_parent_commission', '2020-12-11 10:34:34', '2020-12-11 10:34:34'),
(9, 17, '9750.00', 'farm_setup_parent_commission', '2020-12-20 14:35:55', '2020-12-20 14:35:55'),
(10, 17, '3900.00', 'static_farm_setup_parent_commission', '2020-12-20 14:35:55', '2020-12-20 14:35:55'),
(11, 16, '3900.00', 'farm_setup_grand_parent_commission', '2020-12-20 14:35:55', '2020-12-20 14:35:55'),
(12, 15, '1950.00', 'farm_setup_great_grand_parent_commission', '2020-12-20 14:35:56', '2020-12-20 14:35:56'),
(13, 17, '14750.00', 'farm_setup_parent_commission', '2020-12-20 14:40:52', '2020-12-20 14:40:52'),
(14, 17, '5900.00', 'static_farm_setup_parent_commission', '2020-12-20 14:40:52', '2020-12-20 14:40:52'),
(15, 16, '5900.00', 'farm_setup_grand_parent_commission', '2020-12-20 14:40:52', '2020-12-20 14:40:52'),
(16, 15, '2950.00', 'farm_setup_great_grand_parent_commission', '2020-12-20 14:40:52', '2020-12-20 14:40:52'),
(17, 16, '14750.00', 'farm_setup_parent_commission', '2020-12-20 15:07:12', '2020-12-20 15:07:12'),
(18, 16, '5900.00', 'static_farm_setup_parent_commission', '2020-12-20 15:07:12', '2020-12-20 15:07:12'),
(19, 15, '5900.00', 'farm_setup_grand_parent_commission', '2020-12-20 15:07:12', '2020-12-20 15:07:12'),
(20, 16, '14750.00', 'farm_setup_parent_commission', '2020-12-20 15:16:45', '2020-12-20 15:16:45'),
(21, 16, '5900.00', 'static_farm_setup_parent_commission', '2020-12-20 15:16:45', '2020-12-20 15:16:45'),
(22, 15, '5900.00', 'farm_setup_grand_parent_commission', '2020-12-20 15:16:45', '2020-12-20 15:16:45'),
(23, 16, '14750.00', 'farm_setup_parent_commission', '2020-12-20 15:17:01', '2020-12-20 15:17:01'),
(24, 16, '5900.00', 'static_farm_setup_parent_commission', '2020-12-20 15:17:01', '2020-12-20 15:17:01'),
(25, 15, '5900.00', 'farm_setup_grand_parent_commission', '2020-12-20 15:17:01', '2020-12-20 15:17:01'),
(26, 16, '14750.00', 'farm_setup_parent_commission', '2020-12-20 15:18:23', '2020-12-20 15:18:23'),
(27, 16, '5900.00', 'static_farm_setup_parent_commission', '2020-12-20 15:18:24', '2020-12-20 15:18:24'),
(28, 15, '5900.00', 'farm_setup_grand_parent_commission', '2020-12-20 15:18:24', '2020-12-20 15:18:24'),
(29, 0, '1000.00', 'investment_farming_parent_commission', '2021-01-07 09:10:50', '2021-01-07 09:10:50'),
(30, 0, '400.00', 'static_investment_farming_parent_commission', '2021-01-07 09:10:50', '2021-01-07 09:10:50'),
(31, 0, '1000.00', 'investment_farming_parent_commission', '2021-01-07 09:13:34', '2021-01-07 09:13:34'),
(32, 0, '400.00', 'static_investment_farming_parent_commission', '2021-01-07 09:13:34', '2021-01-07 09:13:34');

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `farmers_cost`
--

CREATE TABLE `farmers_cost` (
  `id` int(11) NOT NULL,
  `farm_type` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `farmers_cost`
--

INSERT INTO `farmers_cost` (`id`, `farm_type`, `amount`, `created_at`, `updated_at`) VALUES
(1, 7, '50000.00', '2021-01-04 05:16:17', '2021-01-04 05:17:18'),
(2, 8, '40000.00', '2021-01-04 05:20:21', '2021-01-04 05:20:21'),
(3, 10, '70000.00', '2021-01-04 06:50:29', '2021-01-04 06:50:29'),
(4, 11, '40000.00', '2021-01-04 06:57:50', '2021-01-04 06:57:50');

-- --------------------------------------------------------

--
-- Table structure for table `farms`
--

CREATE TABLE `farms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `owner_id` int(11) DEFAULT NULL,
  `manager_id` int(11) DEFAULT NULL,
  `farm_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `farm_category` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cover_image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `approved` tinyint(1) NOT NULL DEFAULT 0,
  `turn_over_date` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hand_over_date` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_units` int(11) DEFAULT NULL,
  `units_taken` int(11) DEFAULT NULL,
  `duration` int(11) DEFAULT NULL,
  `country` int(11) DEFAULT NULL,
  `state` int(11) DEFAULT NULL,
  `lga` int(11) DEFAULT NULL,
  `town` int(11) DEFAULT NULL,
  `profit` int(3) DEFAULT NULL,
  `unit_cost` int(11) DEFAULT NULL,
  `overall_cost` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `farms`
--

INSERT INTO `farms` (`id`, `owner_id`, `manager_id`, `farm_type`, `farm_category`, `cover_image`, `approved`, `turn_over_date`, `hand_over_date`, `created_at`, `updated_at`, `description`, `total_units`, `units_taken`, `duration`, `country`, `state`, `lga`, `town`, `profit`, `unit_cost`, `overall_cost`) VALUES
(2, 1, NULL, '8', '1', NULL, 1, NULL, NULL, '2020-10-04 18:18:26', '2020-11-29 18:58:42', 'PLANTAIN IS A LONG TERM ASSET WITH OVER 50YEARS LIFE-SPAN. The average plant population of plantain is 600 plants/acre with a spacing of 2m x 3m and a bunch of plantains is sold on the average at N1000, you can generate a revenue of  N600,000/acre yearly. Maintenance fee: After setting up your farm, you can maintain your farm personally or choose to  subscribe for  Farmignite\'s Farm Maintenance Service which is the costs associated with keeping your farm in good condition.\r\nThese services  include:\r\n-Weed control-Pruning-Fertilizer purchase and application-Pest and disease control\r\nPayment options:\r\nYou can also choose to pay instalmental quarterly(up to4 times per year) or bi-annually(up to 2 times a year) or yearly.\r\nMaintenance fee:  445,200 Naira per acre per year From cultivtion to first fruiting total of 18 months and above before harvest. Then, subsequent harvest take above 6 months and above. Flowers are produced from the pseudostem and develop into a cluster of hanging fruit. For commercial growing plantain plantations, once the fruit is harvested, the plant is cut down soon to be replaced by pups that sprout up from the mother plant.  The edible fruit of plantain has more starch than the common dessert banana and is not eaten raw because plantains have the most starch before they ripen, they are usually cooked green, either boiled or fried, in savory dishes. The ripe fruits are mildly sweet and are often cooked with coconut juice or sugar as a flavoring. Plantains may also be dried for later use in cooking or ground for use as a meal, which can be further refined to a flour.', 1, 1, 10, 1, 30, 15, 15, 30, 30000, 300000),
(3, 1, NULL, '9', '2', NULL, 1, NULL, NULL, '2020-10-06 05:08:00', '2020-11-29 18:51:30', 'swhueh dhdhdhd hdhdhd\'djdkd   dfkd\' djfjf fjnfnkf fjfjdkfj\r\n\r\n\r\n dhfjhdsdhshd dufue\r\n\r\n\r\n\r\n fhjdhhdfdvdadd', 1, 1, 3, 1, 30, 15, 13, 10, 20000, 200000),
(4, NULL, NULL, '7', '2', NULL, 1, '2021-05-06', '2023-10-06', '2020-11-06 19:04:41', '2021-01-07 08:38:34', 'Goat Farm is a lurative farming', 80, 32, 6, 1, 30, 15, 15, 25, 10000, 1000000);

-- --------------------------------------------------------

--
-- Table structure for table `farm_cost_analyses`
--

CREATE TABLE `farm_cost_analyses` (
  `id` int(10) UNSIGNED NOT NULL,
  `parameter` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `farm_type` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `farm_cost_analyses`
--

INSERT INTO `farm_cost_analyses` (`id`, `parameter`, `amount`, `farm_type`, `created_at`, `updated_at`) VALUES
(6, 'Bush Clearing', '6000.00', 7, '2021-01-04 03:00:13', '2021-01-04 03:14:10'),
(7, 'Land Preparation', '40000.00', 7, '2021-01-04 03:00:13', '2021-01-04 03:00:13'),
(8, 'Pen Construction', '100000.00', 7, '2021-01-04 03:00:13', '2021-01-04 03:14:10'),
(9, 'Livestock Purchase', '200000.00', 7, '2021-01-04 03:31:23', '2021-01-04 03:31:23'),
(10, 'Feeding', '400000.00', 7, '2021-01-04 03:32:09', '2021-01-04 03:32:09'),
(11, 'Medication', '40000.00', 7, '2021-01-04 03:32:09', '2021-01-04 03:32:09'),
(12, 'Bush Clearing', '20000.00', 8, '2021-01-04 04:20:21', '2021-01-04 04:20:21'),
(13, 'Bush Clearing', '5000.00', 10, '2021-01-04 05:50:29', '2021-01-04 05:50:29'),
(14, 'Bush Clearing', '50000.00', 11, '2021-01-04 05:57:50', '2021-01-04 05:57:50'),
(15, 'Planting', '3000.00', 11, '2021-01-04 05:57:50', '2021-01-04 05:57:50'),
(16, 'Reaality', '500000.00', 11, '2021-01-04 05:57:50', '2021-01-04 05:57:50'),
(17, 'Land Tilling', '40000.00', 11, '2021-01-04 05:58:37', '2021-01-04 05:58:37'),
(18, 'Buying', '30000.00', 11, '2021-01-04 05:58:37', '2021-01-04 05:58:37');

-- --------------------------------------------------------

--
-- Table structure for table `farm_managers`
--

CREATE TABLE `farm_managers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `farm_type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `farm_managers`
--

INSERT INTO `farm_managers` (`id`, `user_id`, `farm_type`, `description`, `created_at`, `updated_at`) VALUES
(2, 2, '[\"7\",\"8\"]', NULL, '2020-11-12 20:32:02', '2020-11-13 11:50:14'),
(4, 6, '[\"7\",\"8\",\"9\"]', NULL, '2020-11-13 11:52:09', '2020-11-13 12:03:32'),
(3, 2, '[\"7\",\"8\",\"9\",\"10\"]', NULL, '2020-11-12 20:34:04', '2020-11-12 20:34:04'),
(5, 7, '[\"7\",\"8\"]', NULL, '2020-11-13 12:15:55', '2020-11-13 12:30:16'),
(6, 8, '[\"7\",\"9\"]', NULL, '2020-11-13 12:34:34', '2020-11-13 12:34:34'),
(7, 16, '[\"7\",\"8\",\"9\"]', NULL, '2020-12-11 07:58:40', '2020-12-11 07:58:40');

-- --------------------------------------------------------

--
-- Table structure for table `farm_photos`
--

CREATE TABLE `farm_photos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `farm_id` int(11) NOT NULL,
  `images` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `farm_photos`
--

INSERT INTO `farm_photos` (`id`, `farm_id`, `images`, `created_at`, `updated_at`) VALUES
(1, 1, 'php7BC6_1601477854.jpg', '2020-09-30 13:57:34', '2020-09-30 13:57:34'),
(2, 1, 'php7C06_1601477854.jpg', '2020-09-30 13:57:34', '2020-09-30 13:57:34'),
(3, 1, 'php7C45_1601477854.jpg', '2020-09-30 13:57:34', '2020-09-30 13:57:34'),
(4, 2, 'php4505_1601751379.jpg', '2020-10-03 17:56:19', '2020-10-03 17:56:19'),
(5, 2, 'php4516_1601751379.jpg', '2020-10-03 17:56:19', '2020-10-03 17:56:19'),
(6, 2, 'php4526_1601751379.jpg', '2020-10-03 17:56:19', '2020-10-03 17:56:19');

-- --------------------------------------------------------

--
-- Table structure for table `farm_set_ups`
--

CREATE TABLE `farm_set_ups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `investments`
--

CREATE TABLE `investments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `farm_id` int(11) DEFAULT NULL,
  `units` int(11) DEFAULT NULL,
  `amount_paid` decimal(10,2) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `investments`
--

INSERT INTO `investments` (`id`, `user_id`, `farm_id`, `units`, `amount_paid`, `created_at`, `updated_at`) VALUES
(1, 2, 2, 2, '60000.00', '2020-10-05 01:21:04', '2020-10-05 01:21:04'),
(2, 2, 2, 1, '30000.00', '2020-10-05 01:30:28', '2020-10-05 01:30:28'),
(3, 2, 2, 1, '30000.00', '2020-10-05 01:34:15', '2020-10-05 01:34:15'),
(4, 2, 2, 1, '30000.00', '2020-10-05 01:39:47', '2020-10-05 01:39:47'),
(5, 2, 2, 3, '90000.00', '2020-10-05 05:06:45', '2020-10-05 05:06:45'),
(6, 3, 3, 2, '40000.00', '2020-10-06 21:57:39', '2020-10-06 21:57:39'),
(7, 3, 3, 1, '20000.00', '2020-10-07 05:48:21', '2020-10-07 05:48:21'),
(8, 3, 3, 1, '20000.00', '2020-10-14 07:09:24', '2020-10-14 07:09:24'),
(9, 3, 2, 2, '60000.00', '2020-10-15 20:53:29', '2020-10-15 20:53:29'),
(10, 3, 2, 2, '60000.00', '2020-10-15 20:58:08', '2020-10-15 20:58:08'),
(11, 2, 2, 2, '60000.00', '2020-10-23 09:28:00', '2020-10-23 09:28:00'),
(12, 2, 3, 3, '60000.00', '2020-10-25 16:15:09', '2020-10-25 16:15:09'),
(13, 2, 3, 3, '60000.00', '2020-10-25 16:23:07', '2020-10-25 16:23:07'),
(14, 2, 3, 2, '40000.00', '2020-10-25 16:31:48', '2020-10-25 16:31:48'),
(15, 2, 3, 2, '40000.00', '2020-11-05 20:27:08', '2020-11-05 20:27:08'),
(16, 2, 4, 20, '200000.00', '2020-11-23 15:29:05', '2020-11-23 15:29:05'),
(17, 2, 4, 2, '20000.00', '2020-11-23 15:37:21', '2020-11-23 15:37:21'),
(18, 2, 4, 10, '100000.00', '2020-11-23 15:39:26', '2020-11-23 15:39:26'),
(19, 2, 3, 1, '20000.00', '2020-11-29 19:51:30', '2020-11-29 19:51:30'),
(20, 2, 2, 1, '30000.00', '2020-11-29 19:58:42', '2020-11-29 19:58:42'),
(21, 2, 4, 1, '10000.00', '2020-11-30 13:59:53', '2020-11-30 13:59:53'),
(22, 2, 4, 2, '20000.00', '2020-12-01 03:03:17', '2020-12-01 03:03:17'),
(23, 17, 4, 2, '20000.00', '2020-12-20 15:04:11', '2020-12-20 15:04:11'),
(24, 2, 4, 2, '20000.00', '2021-01-06 10:08:06', '2021-01-06 10:08:06'),
(25, 2, 4, 2, '20000.00', '2021-01-07 09:09:05', '2021-01-07 09:09:05'),
(26, 2, 4, 2, '20000.00', '2021-01-07 09:10:50', '2021-01-07 09:10:50'),
(27, 2, 4, 2, '20000.00', '2021-01-07 09:13:34', '2021-01-07 09:13:34'),
(28, 2, 4, 2, '20000.00', '2021-01-07 09:23:29', '2021-01-07 09:23:29'),
(29, 2, 4, 2, '20000.00', '2021-01-07 09:24:07', '2021-01-07 09:24:07'),
(30, 2, 4, 3, '30000.00', '2021-01-07 09:38:34', '2021-01-07 09:38:34');

-- --------------------------------------------------------

--
-- Table structure for table `investment_cart`
--

CREATE TABLE `investment_cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `farm_id` int(11) DEFAULT NULL,
  `units` int(11) NOT NULL,
  `amount_paid` decimal(10,2) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `investment_cart`
--

INSERT INTO `investment_cart` (`id`, `user_id`, `farm_id`, `units`, `amount_paid`, `created_at`, `updated_at`) VALUES
(25, 3, 2, 6, '180000.00', '2020-10-07 05:53:25', '2020-10-07 05:53:25'),
(26, 3, 2, 7, '210000.00', '2020-10-12 18:17:19', '2020-10-12 18:17:19'),
(27, 3, 2, 6, '180000.00', '2020-10-12 18:20:22', '2020-10-12 18:20:22'),
(28, 3, 2, 6, '180000.00', '2020-10-12 18:20:34', '2020-10-12 18:20:34'),
(29, 3, 2, 6, '180000.00', '2020-10-12 18:22:39', '2020-10-12 18:22:39'),
(30, 3, 2, 6, '180000.00', '2020-10-12 18:23:02', '2020-10-12 18:23:02'),
(31, 3, 3, 6, '120000.00', '2020-10-14 08:59:30', '2020-10-14 08:59:30'),
(32, 3, 3, 4, '80000.00', '2020-10-15 08:56:20', '2020-10-15 08:56:20'),
(33, 3, 2, 2, '60000.00', '2020-10-15 20:52:48', '2020-10-15 20:52:48'),
(34, 3, 3, 3, '60000.00', '2020-10-18 05:02:16', '2020-10-18 05:02:16'),
(35, 3, 3, 2, '40000.00', '2020-10-20 05:58:34', '2020-10-20 05:58:34'),
(38, 7, 4, 6, '60000.00', '2020-11-16 15:12:05', '2020-11-16 15:12:05'),
(39, 7, 4, 5, '50000.00', '2020-11-16 15:19:44', '2020-11-16 15:19:44'),
(43, 18, 4, 1, '10000.00', '2020-12-20 14:48:41', '2020-12-20 14:48:41');

-- --------------------------------------------------------

--
-- Table structure for table `land_carts`
--

CREATE TABLE `land_carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `land_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `acres` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `land_for_sales`
--

CREATE TABLE `land_for_sales` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `landTitle` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `seller_id` int(11) NOT NULL,
  `status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'available',
  `buyer_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `coverImage` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lga` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `town` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `purchase_date` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `acres` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `purchased` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `land_for_sales`
--

INSERT INTO `land_for_sales` (`id`, `landTitle`, `address`, `seller_id`, `status`, `buyer_id`, `coverImage`, `price`, `state`, `lga`, `town`, `created_at`, `updated_at`, `purchase_date`, `description`, `acres`, `purchased`) VALUES
(9, '12 Acres of Land', '29 Olanrewaju Street Billings Way, Nueeh', 1, 'available', NULL, 'bg_2_1609738666.jpg', '600000000', '30', '13', 'Nnuueh', '2021-01-04 04:37:46', '2021-01-04 04:38:58', NULL, 'hysesggkggfdfhjghwssgn', '12', 0),
(10, '10 Hectares of Land', 'hhchghvhgghhjghjghjghghgh', 2, 'available', NULL, 'cocoa_1609769783.jpg', '900000000', '30', '15', 'Afikpo', '2021-01-04 13:16:23', '2021-01-04 13:16:23', NULL, 'bvghcgfcgfvgh', '30', 0);

-- --------------------------------------------------------

--
-- Table structure for table `land_for_sale_photos`
--

CREATE TABLE `land_for_sale_photos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `land_for_sale_id` int(11) NOT NULL,
  `images` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `land_for_sale_photos`
--

INSERT INTO `land_for_sale_photos` (`id`, `land_for_sale_id`, `images`, `created_at`, `updated_at`) VALUES
(22, 9, 'php1C1C_1609738666.png', '2021-01-04 04:37:46', '2021-01-04 04:37:46'),
(23, 10, 'phpEBAB_1609769783.jpg', '2021-01-04 13:16:23', '2021-01-04 13:16:23'),
(9, 5, 'php2193_1607667459.jpg', '2020-12-11 05:17:39', '2020-12-11 05:17:39'),
(8, 5, 'php2163_1607667459.jpg', '2020-12-11 05:17:39', '2020-12-11 05:17:39'),
(7, 5, 'php2153_1607667459.jpg', '2020-12-11 05:17:39', '2020-12-11 05:17:39'),
(21, 9, 'php1C1B_1609738666.jpg', '2021-01-04 04:37:46', '2021-01-04 04:37:46'),
(24, 10, 'phpEBAC_1609769783.jpg', '2021-01-04 13:16:23', '2021-01-04 13:16:23'),
(25, 10, 'phpEBBD_1609769783.jpeg', '2021-01-04 13:16:23', '2021-01-04 13:16:23'),
(26, 10, 'phpEBCE_1609769783.jpeg', '2021-01-04 13:16:23', '2021-01-04 13:16:23'),
(27, 10, 'phpEBEE_1609769783.jpeg', '2021-01-04 13:16:23', '2021-01-04 13:16:23');

-- --------------------------------------------------------

--
-- Table structure for table `lgas`
--

CREATE TABLE `lgas` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `state` varchar(20) DEFAULT NULL,
  `state_id` int(11) DEFAULT 30
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lgas`
--

INSERT INTO `lgas` (`id`, `name`, `state`, `state_id`) VALUES
(1, 'Abua/Odual', 'rivers', 30),
(2, 'Ahoada East', 'rivers', 30),
(3, 'Ahoada West', 'rivers', 30),
(4, 'Andoni', 'rivers', 30),
(5, 'Akuku-Toru', 'rivers', 30),
(6, 'Asari-Toru', 'rivers', 30),
(7, 'Bonny', 'rivers', 30),
(8, 'Degema', 'rivers', 30),
(9, 'Emuoha', 'rivers', 30),
(10, 'Eleme', 'rivers', 30),
(11, 'Ikwerre', 'rivers', 30),
(12, 'Etche', 'rivers', 30),
(13, 'Gokana', 'rivers', 30),
(14, 'Khana', 'rivers', 30),
(15, 'Obio/Akpor', 'rivers', 30),
(16, 'Ogba/Egbema/Ndoni', 'rivers', 30),
(17, 'Ogu/Bolo', 'rivers', 30),
(18, 'Okrika', 'rivers', 30),
(19, 'Omuma', 'rivers', 30),
(20, 'Opobo/Nkoro', 'rivers', 30),
(21, 'Oyigbo', 'rivers', 30),
(22, 'Port Harcourt', 'rivers', 30),
(23, 'Tai', 'rivers', 30),
(24, 'Demsa', NULL, 2),
(25, 'Fufure', NULL, 2),
(26, 'Ganye', NULL, 2),
(27, 'Gayuk', NULL, 2),
(28, 'Gombi', NULL, 2),
(29, 'Grie', NULL, 2),
(30, 'Hong', NULL, 2),
(31, 'Jada', NULL, 2),
(32, 'Larmurde', NULL, 2),
(33, 'Madagali', NULL, 2),
(34, 'Maiha', NULL, 2),
(35, 'Mayo Belwa', NULL, 2),
(36, 'Michika', NULL, 2),
(37, 'Mubi North', NULL, 2),
(38, 'Mubi South', NULL, 2),
(39, 'Numan', NULL, 2),
(40, 'Shelleng', NULL, 2),
(41, 'Song', NULL, 2),
(42, 'Toungo', NULL, 2),
(43, 'Yola North', NULL, 2),
(44, 'Yola South', NULL, 2),
(45, 'Abak', NULL, 3),
(46, 'Eastern Obolo', NULL, 3),
(47, 'Eket', NULL, 3),
(48, 'Esit Eket', NULL, 3),
(49, 'Essien Udim', NULL, 3),
(50, 'Etim Ekpo', NULL, 3),
(51, 'Etinan', NULL, 3),
(52, 'Ibeno', NULL, 3),
(53, 'Ibesikpo Asutan', NULL, 3),
(54, 'Ibiono-Ibom', NULL, 3),
(55, 'Ikot Abasi', NULL, 3),
(56, 'Ika', NULL, 3),
(57, 'Ikono', NULL, 3),
(58, 'Ikot Ekpene', NULL, 3),
(59, 'Ini', NULL, 3),
(60, 'Mkpat-Enin', NULL, 3),
(61, 'Itu', NULL, 3),
(62, 'Mbo', NULL, 3),
(63, 'Nsit-Atai', NULL, 3),
(64, 'Nsit-Ibom', NULL, 3),
(65, 'Nsit-Ubium', NULL, 3),
(66, 'Obot Akara', NULL, 3),
(67, 'Okobo', NULL, 3),
(68, 'Onna', NULL, 3),
(69, 'Oron', NULL, 3),
(70, 'Udung-Uko', NULL, 3),
(71, 'Ukanafun', NULL, 3),
(72, 'Oruk Anam', NULL, 3),
(73, 'Uruan', NULL, 3),
(74, 'Urue-Offong/Oruko', NULL, 3),
(75, 'Uyo', NULL, 3),
(76, 'Aguata', NULL, 4),
(77, 'Anambra East', NULL, 4),
(78, 'Anaocha', NULL, 4),
(79, 'Awka North', NULL, 4),
(80, 'Anambra West', NULL, 4),
(81, 'Awka South', NULL, 4),
(82, 'Ayamelum', NULL, 4),
(83, 'Dunukofia', NULL, 4),
(84, 'Ekwusigo', NULL, 4),
(85, 'Idemili North', NULL, 4),
(86, 'Idemili South', NULL, 4),
(87, 'Ihiala', NULL, 4),
(88, 'Njikoka', NULL, 4),
(89, 'Nnewi North', NULL, 4),
(90, 'Nnewi South', NULL, 4),
(91, 'Ogbaru', NULL, 4),
(92, 'Onitsha North', NULL, 4),
(93, 'Onitsha South', NULL, 4),
(94, 'Orumba North', NULL, 4),
(95, 'Orumba South', NULL, 4),
(96, 'Oyi', NULL, 4),
(97, 'Abeokuta North', NULL, 28),
(98, 'Abeokuta South', NULL, 28),
(99, 'Ado-Odo/Ota', NULL, 28),
(100, 'Egbado North', NULL, 28),
(101, 'Ewekoro', NULL, 28),
(102, 'Egbado South', NULL, 28),
(103, 'Ijebu North', NULL, 28),
(104, 'Ijebu East', NULL, 28),
(105, 'Ifo', NULL, 28),
(106, 'Ijebu Ode', NULL, 28),
(107, 'Ijebu North East', NULL, 28),
(108, 'Imeko Afon', NULL, 28),
(109, 'Ikenne', NULL, 28),
(110, 'Ipokia', NULL, 28),
(111, 'Odeda', NULL, 28),
(112, 'Obafemi Owode', NULL, 28),
(113, 'Odogbolu', NULL, 28),
(114, 'Remo North', NULL, 28),
(115, 'Ogun Waterside', NULL, 28),
(116, 'Shagamu', NULL, 28),
(117, 'Akoko North-East', NULL, 29),
(118, 'Akoko North-West', NULL, 29),
(119, 'Akoko South-West', NULL, 29),
(120, 'Akoko South-East', NULL, 29),
(121, 'Akure North', NULL, 29),
(122, 'Akure South', NULL, 29),
(123, 'Ese Odo', NULL, 29),
(124, 'Idanre', NULL, 29),
(125, 'Ifedore', NULL, 29),
(126, 'Ilaje', NULL, 29),
(127, 'Irele', NULL, 29),
(128, 'Ile Oluji/Okeigbo', NULL, 29),
(129, 'Odigbo', NULL, 29),
(130, 'Okitipupa', NULL, 29),
(131, 'Ondo West', NULL, 29),
(132, 'Ose', NULL, 29),
(133, 'Ondo East', NULL, 29),
(134, 'Owo', NULL, 29),
(135, 'Alkaleri', NULL, 5),
(136, 'Bauchi', NULL, 5),
(137, 'Bogoro', NULL, 5),
(138, 'Damban', NULL, 5),
(139, 'Darazo', NULL, 5),
(140, 'Dass', NULL, 5),
(141, 'Gamawa', NULL, 5),
(142, 'Ganjuwa', NULL, 5),
(143, 'Giade', NULL, 5),
(144, 'Itas/Gadau', NULL, 5),
(145, 'Jama\'are', NULL, 5),
(146, 'Katagum', NULL, 5),
(147, 'Kirfi', NULL, 5),
(148, 'Misau', NULL, 5),
(149, 'Ningi', NULL, 5),
(150, 'Shira', NULL, 5),
(151, 'Tafawa Balewa', NULL, 5),
(152, 'Toro', NULL, 5),
(153, 'Warji', NULL, 5),
(154, 'Zaki', NULL, 5),
(155, 'Agatu', NULL, 6),
(156, 'Apa', NULL, 6),
(157, 'Ado', NULL, 6),
(158, 'Buruku', NULL, 6),
(159, 'Gboko', NULL, 6),
(160, 'Guma', NULL, 6),
(161, 'Gwer East', NULL, 6),
(162, 'Gwer West', NULL, 6),
(163, 'Katsina-Ala', NULL, 6),
(164, 'Konshisha', NULL, 6),
(165, 'Kwande', NULL, 6),
(166, 'Logo', NULL, 6),
(167, 'Makurdi', NULL, 6),
(168, 'Obi', NULL, 6),
(169, 'Ogbadibo', NULL, 6),
(170, 'Ohimini', NULL, 6),
(171, 'Oju', NULL, 6),
(172, 'Okpokwu', NULL, 6),
(173, 'Oturkpo', NULL, 6),
(174, 'Tarka', NULL, 6),
(175, 'Ukum', NULL, 6),
(176, 'Ushongo', NULL, 6),
(177, 'Vandeikya', NULL, 6),
(178, 'Abadam', NULL, 7),
(179, 'Askira/Uba', NULL, 7),
(180, 'Bama', NULL, 7),
(181, 'Bayo', NULL, 7),
(182, 'Biu', NULL, 7),
(183, 'Chibok', NULL, 7),
(184, 'Damboa', NULL, 7),
(185, 'Dikwa', NULL, 7),
(186, 'Guzamala', NULL, 7),
(187, 'Gubio', NULL, 7),
(188, 'Hawul', NULL, 7),
(189, 'Gwoza', NULL, 7),
(190, 'Jere', NULL, 7),
(191, 'Kaga', NULL, 7),
(192, 'Kala/Balge', NULL, 7),
(193, 'Konduga', NULL, 7),
(194, 'Kukawa', NULL, 7),
(195, 'Kwaya Kusar', NULL, 7),
(196, 'Mafa', NULL, 7),
(197, 'Magumeri', NULL, 7),
(198, 'Maiduguri', NULL, 7),
(199, 'Mobbar', NULL, 7),
(200, 'Marte', NULL, 7),
(201, 'Monguno', NULL, 7),
(202, 'Ngala', NULL, 7),
(203, 'Nganzai', NULL, 7),
(204, 'Shani', NULL, 7),
(205, 'Brass', NULL, 8),
(206, 'Ekeremor', NULL, 8),
(207, 'Kolokuma/Opokuma', NULL, 8),
(208, 'Nembe', NULL, 8),
(209, 'Ogbia', NULL, 8),
(210, 'Sagbama', NULL, 8),
(211, 'Southern Ijaw', NULL, 8),
(212, 'Yenagoa', NULL, 8),
(213, 'Abi', NULL, 9),
(214, 'Akamkpa', NULL, 9),
(215, 'Akpabuyo', NULL, 9),
(216, 'Bakassi', NULL, 9),
(217, 'Bekwarra', NULL, 9),
(218, 'Biase', NULL, 9),
(219, 'Boki', NULL, 9),
(220, 'Calabar Municipal', NULL, 9),
(221, 'Calabar South', NULL, 9),
(222, 'Etung', NULL, 9),
(223, 'Ikom', NULL, 9),
(224, 'Obanliku', NULL, 9),
(225, 'Obubra', NULL, 9),
(226, 'Obudu', NULL, 9),
(227, 'Odukpani', NULL, 9),
(228, 'Ogoja', NULL, 9),
(229, 'Yakuur', NULL, 9),
(230, 'Yala', NULL, 9),
(231, 'Aniocha North', NULL, 10),
(232, 'Aniocha South', NULL, 10),
(233, 'Bomadi', NULL, 10),
(234, 'Burutu', NULL, 10),
(235, 'Ethiope West', NULL, 10),
(236, 'Ethiope East', NULL, 10),
(237, 'Ika North East', NULL, 10),
(238, 'Ika South', NULL, 10),
(239, 'Isoko North', NULL, 10),
(240, 'Isoko South', NULL, 10),
(241, 'Ndokwa East', NULL, 10),
(242, 'Ndokwa West', NULL, 10),
(243, 'Okpe', NULL, 10),
(244, 'Oshimili North', NULL, 10),
(245, 'Oshimili South', NULL, 10),
(246, 'Patani', NULL, 10),
(247, 'Sapele', NULL, 10),
(248, 'Udu', NULL, 10),
(249, 'Ughelli North', NULL, 10),
(250, 'Ukwuani', NULL, 10),
(251, 'Ughelli South', NULL, 10),
(252, 'Uvwie', NULL, 10),
(253, 'Warri North', NULL, 10),
(254, 'Warri South', NULL, 10),
(255, 'Warri South West', NULL, 10),
(256, 'Abakaliki', NULL, 11),
(257, 'Afikpo North', NULL, 11),
(258, 'Ebonyi', NULL, 11),
(259, 'Afikpo South', NULL, 11),
(260, 'Ezza North', NULL, 11),
(261, 'Ikwo', NULL, 11),
(262, 'Ezza South', NULL, 11),
(263, 'Ivo', NULL, 11),
(264, 'Ishielu', NULL, 11),
(265, 'Izzi', NULL, 11),
(266, 'Ohaozara', NULL, 11),
(267, 'Ohaukwu', NULL, 11),
(268, 'Onicha', NULL, 11),
(269, 'Akoko-Edo', NULL, 12),
(270, 'Egor', NULL, 12),
(271, 'Esan Central', NULL, 12),
(272, 'Esan North-East', NULL, 12),
(273, 'Esan South-East', NULL, 12),
(274, 'Esan West', NULL, 12),
(275, 'Etsako Central', NULL, 12),
(276, 'Etsako East', NULL, 12),
(277, 'Etsako West', NULL, 12),
(278, 'Igueben', NULL, 12),
(279, 'Ikpoba Okha', NULL, 12),
(280, 'Orhionmwon', NULL, 12),
(281, 'Oredo', NULL, 12),
(282, 'Ovia North-East', NULL, 12),
(283, 'Ovia South-West', NULL, 12),
(284, 'Owan East', NULL, 12),
(285, 'Owan West', NULL, 12),
(286, 'Uhunmwonde', NULL, 12),
(287, 'Ado Ekiti', NULL, 13),
(288, 'Efon', NULL, 13),
(289, 'Ekiti East', NULL, 13),
(290, 'Ekiti South-West', NULL, 13),
(291, 'Ekiti West', NULL, 13),
(292, 'Emure', NULL, 13),
(293, 'Gbonyin', NULL, 13),
(294, 'Ido Osi', NULL, 13),
(295, 'Ijero', NULL, 13),
(296, 'Ikere', NULL, 13),
(297, 'Ilejemeje', NULL, 13),
(298, 'Irepodun/Ifelodun', NULL, 13),
(299, 'Ikole', NULL, 13),
(300, 'Ise/Orun', NULL, 13),
(301, 'Moba', NULL, 13),
(302, 'Oye', NULL, 13),
(303, 'Awgu', NULL, 14),
(304, 'Aninri', NULL, 14),
(305, 'Enugu East', NULL, 14),
(306, 'Enugu North', NULL, 14),
(307, 'Ezeagu', NULL, 14),
(308, 'Enugu South', NULL, 14),
(309, 'Igbo Etiti', NULL, 14),
(310, 'Igbo Eze North', NULL, 14),
(311, 'Igbo Eze South', NULL, 14),
(312, 'Isi Uzo', NULL, 14),
(313, 'Nkanu East', NULL, 14),
(314, 'Nkanu West', NULL, 14),
(315, 'Nsukka', NULL, 14),
(316, 'Udenu', NULL, 14),
(317, 'Oji River', NULL, 14),
(318, 'Uzo Uwani', NULL, 14),
(319, 'Udi', NULL, 14),
(320, 'Abaji', NULL, 15),
(321, 'Bwari', NULL, 15),
(322, 'Gwagwalada', NULL, 15),
(323, 'Kuje', NULL, 15),
(324, 'Kwali', NULL, 15),
(325, 'Municipal Area Council', NULL, 15),
(326, 'Akko', NULL, 16),
(327, 'Balanga', NULL, 16),
(328, 'Billiri', NULL, 16),
(329, 'Dukku', NULL, 16),
(330, 'Funakaye', NULL, 16),
(331, 'Gombe', NULL, 16),
(332, 'Kaltungo', NULL, 16),
(333, 'Kwami', NULL, 16),
(334, 'Nafada', NULL, 16),
(335, 'Shongom', NULL, 16),
(336, 'Yamaltu/Deba', NULL, 16),
(337, 'Auyo', NULL, 17),
(338, 'Babura', NULL, 17),
(339, 'Buji', NULL, 17),
(340, 'Biriniwa', NULL, 17),
(341, 'Birnin Kudu', NULL, 17),
(342, 'Dutse', NULL, 17),
(343, 'Gagarawa', NULL, 17),
(344, 'Garki', NULL, 17),
(345, 'Gumel', NULL, 17),
(346, 'Guri', NULL, 17),
(347, 'Gwaram', NULL, 17),
(348, 'Gwiwa', NULL, 17),
(349, 'Hadejia', NULL, 17),
(350, 'Jahun', NULL, 17),
(351, 'Kafin Hausa', NULL, 17),
(352, 'Kazaure', NULL, 17),
(353, 'Kiri Kasama', NULL, 17),
(354, 'Kiyawa', NULL, 17),
(355, 'Kaugama', NULL, 17),
(356, 'Maigatari', NULL, 17),
(357, 'Malam Madori', NULL, 17),
(358, 'Miga', NULL, 17),
(359, 'Sule Tankarkar', NULL, 17),
(360, 'Roni', NULL, 17),
(361, 'Ringim', NULL, 17),
(362, 'Yankwashi', NULL, 17),
(363, 'Taura', NULL, 17),
(364, 'Afijio', NULL, 31),
(365, 'Akinyele', NULL, 31),
(366, 'Atiba', NULL, 31),
(367, 'Atisbo', NULL, 31),
(368, 'Egbeda', NULL, 31),
(369, 'Ibadan North', NULL, 31),
(370, 'Ibadan North-East', NULL, 31),
(371, 'Ibadan North-West', NULL, 31),
(372, 'Ibadan South-East', NULL, 31),
(373, 'Ibarapa Central', NULL, 31),
(374, 'Ibadan South-West', NULL, 31),
(375, 'Ibarapa East', NULL, 31),
(376, 'Ido', NULL, 31),
(377, 'Ibarapa North', NULL, 31),
(378, 'Irepo', NULL, 31),
(379, 'Iseyin', NULL, 31),
(380, 'Itesiwaju', NULL, 31),
(381, 'Iwajowa', NULL, 31),
(382, 'Kajola', NULL, 31),
(383, 'Lagelu', NULL, 31),
(384, 'Ogbomosho North', NULL, 31),
(385, 'Ogbomosho South', NULL, 31),
(386, 'Ogo Oluwa', NULL, 31),
(387, 'Olorunsogo', NULL, 31),
(388, 'Oluyole', NULL, 31),
(389, 'Ona Ara', NULL, 31),
(390, 'Orelope', NULL, 31),
(391, 'Ori Ire', NULL, 31),
(392, 'Oyo', NULL, 31),
(393, 'Oyo East', NULL, 31),
(394, 'Saki East', NULL, 31),
(395, 'Saki West', NULL, 31),
(396, 'Surulere Oyo State', NULL, 31),
(397, 'Aboh Mbaise', NULL, 18),
(398, 'Ahiazu Mbaise', NULL, 18),
(399, 'Ehime Mbano', NULL, 18),
(400, 'Ezinihitte', NULL, 18),
(401, 'Ideato North', NULL, 18),
(402, 'Ideato South', NULL, 18),
(403, 'Ihitte/Uboma', NULL, 18),
(404, 'Ikeduru', NULL, 18),
(405, 'Isiala Mbano', NULL, 18),
(406, 'Mbaitoli', NULL, 18),
(407, 'Isu', NULL, 18),
(408, 'Ngor Okpala', NULL, 18),
(409, 'Njaba', NULL, 18),
(410, 'Nkwerre', NULL, 18),
(411, 'Nwangele', NULL, 18),
(412, 'Obowo', NULL, 18),
(413, 'Oguta', NULL, 18),
(414, 'Ohaji/Egbema', NULL, 18),
(415, 'Okigwe', NULL, 18),
(416, 'Orlu', NULL, 18),
(417, 'Orsu', NULL, 18),
(418, 'Oru East', NULL, 18),
(419, 'Oru West', NULL, 18),
(420, 'Owerri Municipal', NULL, 18),
(421, 'Owerri North', NULL, 18),
(422, 'Unuimo', NULL, 18),
(423, 'Owerri West', NULL, 18),
(424, 'Birnin Gwari', NULL, 19),
(425, 'Chikun', NULL, 19),
(426, 'Giwa', NULL, 19),
(427, 'Ikara', NULL, 19),
(428, 'Igabi', NULL, 19),
(429, 'Jaba', NULL, 19),
(430, 'Jema\'a', NULL, 19),
(431, 'Kachia', NULL, 19),
(432, 'Kaduna North', NULL, 19),
(433, 'Kaduna South', NULL, 19),
(434, 'Kagarko', NULL, 19),
(435, 'Kajuru', NULL, 19),
(436, 'Kaura', NULL, 19),
(437, 'Kauru', NULL, 19),
(438, 'Kubau', NULL, 19),
(439, 'Kudan', NULL, 19),
(440, 'Lere', NULL, 19),
(441, 'Makarfi', NULL, 19),
(442, 'Sabon Gari', NULL, 19),
(443, 'Sanga', NULL, 19),
(444, 'Soba', NULL, 19),
(445, 'Zangon Kataf', NULL, 19),
(446, 'Zaria', NULL, 19),
(447, 'Aleiro', NULL, 20),
(448, 'Argungu', NULL, 20),
(449, 'Arewa Dandi', NULL, 20),
(450, 'Augie', NULL, 20),
(451, 'Bagudo', NULL, 20),
(452, 'Birnin Kebbi', NULL, 20),
(453, 'Bunza', NULL, 20),
(454, 'Dandi', NULL, 20),
(455, 'Fakai', NULL, 20),
(456, 'Gwandu', NULL, 20),
(457, 'Jega', NULL, 20),
(458, 'Kalgo', NULL, 20),
(459, 'Koko/Besse', NULL, 20),
(460, 'Maiyama', NULL, 20),
(461, 'Ngaski', NULL, 20),
(462, 'Shanga', NULL, 20),
(463, 'Suru', NULL, 20),
(464, 'Sakaba', NULL, 20),
(465, 'Wasagu/Danko', NULL, 20),
(466, 'Yauri', NULL, 20),
(467, 'Zuru', NULL, 20),
(468, 'Ajingi', NULL, 21),
(469, 'Albasu', NULL, 21),
(470, 'Bagwai', NULL, 21),
(471, 'Bebeji', NULL, 21),
(472, 'Bichi', NULL, 21),
(473, 'Bunkure', NULL, 21),
(474, 'Dala', NULL, 21),
(475, 'Dambatta', NULL, 21),
(476, 'Dawakin Kudu', NULL, 21),
(477, 'Dawakin Tofa', NULL, 21),
(478, 'Doguwa', NULL, 21),
(479, 'Fagge', NULL, 21),
(480, 'Gabasawa', NULL, 21),
(481, 'Garko', NULL, 21),
(482, 'Garun Mallam', NULL, 21),
(483, 'Gezawa', NULL, 21),
(484, 'Gaya', NULL, 21),
(485, 'Gwale', NULL, 21),
(486, 'Gwarzo', NULL, 21),
(487, 'Kabo', NULL, 21),
(488, 'Kano Municipal', NULL, 21),
(489, 'Karaye', NULL, 21),
(490, 'Kibiya', NULL, 21),
(491, 'Kiru', NULL, 21),
(492, 'Kumbotso', NULL, 21),
(493, 'Kunchi', NULL, 21),
(494, 'Kura', NULL, 21),
(495, 'Madobi', NULL, 21),
(496, 'Makoda', NULL, 21),
(497, 'Minjibir', NULL, 21),
(498, 'Nasarawa', NULL, 21),
(499, 'Rano', NULL, 21),
(500, 'Rimin Gado', NULL, 21),
(501, 'Rogo', NULL, 21),
(502, 'Shanono', NULL, 21),
(503, 'Takai', NULL, 21),
(504, 'Sumaila', NULL, 21),
(505, 'Tarauni', NULL, 21),
(506, 'Tofa', NULL, 21),
(507, 'Tsanyawa', NULL, 21),
(508, 'Tudun Wada', NULL, 21),
(509, 'Ungogo', NULL, 21),
(510, 'Warawa', NULL, 21),
(511, 'Wudil', NULL, 21),
(512, 'Ajaokuta', NULL, 22),
(513, 'Adavi', NULL, 22),
(514, 'Ankpa', NULL, 22),
(515, 'Bassa', NULL, 22),
(516, 'Dekina', NULL, 22),
(517, 'Ibaji', NULL, 22),
(518, 'Idah', NULL, 22),
(519, 'Igalamela Odolu', NULL, 22),
(520, 'Ijumu', NULL, 22),
(521, 'Kogi', NULL, 22),
(522, 'Kabba/Bunu', NULL, 22),
(523, 'Lokoja', NULL, 22),
(524, 'Ofu', NULL, 22),
(525, 'Mopa Muro', NULL, 22),
(526, 'Ogori/Magongo', NULL, 22),
(527, 'Okehi', NULL, 22),
(528, 'Okene', NULL, 22),
(529, 'Olamaboro', NULL, 22),
(530, 'Omala', NULL, 22),
(531, 'Yagba East', NULL, 22),
(532, 'Yagba West', NULL, 22),
(533, 'Aiyedire', NULL, 32),
(534, 'Atakunmosa West', NULL, 32),
(535, 'Atakunmosa East', NULL, 32),
(536, 'Aiyedaade', NULL, 32),
(537, 'Boluwaduro', NULL, 32),
(538, 'Boripe', NULL, 32),
(539, 'Ife East', NULL, 32),
(540, 'Ede South', NULL, 32),
(541, 'Ife North', NULL, 32),
(542, 'Ede North', NULL, 32),
(543, 'Ife South', NULL, 32),
(544, 'Ejigbo', NULL, 32),
(545, 'Ife Central', NULL, 32),
(546, 'Ifedayo', NULL, 32),
(547, 'Egbedore', NULL, 32),
(548, 'Ila', NULL, 32),
(549, 'Ifelodun', NULL, 32),
(550, 'Ilesa East', NULL, 32),
(551, 'Ilesa West', NULL, 32),
(552, 'Irepodun', NULL, 32),
(553, 'Irewole', NULL, 32),
(554, 'Isokan', NULL, 32),
(555, 'Iwo', NULL, 32),
(556, 'Obokun', NULL, 32),
(557, 'Odo Otin', NULL, 32),
(558, 'Ola Oluwa', NULL, 32),
(559, 'Olorunda', NULL, 32),
(560, 'Oriade', NULL, 32),
(561, 'Orolu', NULL, 32),
(562, 'Osogbo', NULL, 32),
(563, 'Gudu', NULL, 33),
(564, 'Gwadabawa', NULL, 33),
(565, 'Illela', NULL, 33),
(566, 'Isa', NULL, 33),
(567, 'Kebbe', NULL, 33),
(568, 'Kware', NULL, 33),
(569, 'Rabah', NULL, 33),
(570, 'Sabon Birni', NULL, 33),
(571, 'Shagari', NULL, 33),
(572, 'Silame', NULL, 33),
(573, 'Sokoto North', NULL, 33),
(574, 'Sokoto South', NULL, 33),
(575, 'Tambuwal', NULL, 33),
(576, 'Tangaza', NULL, 33),
(577, 'Tureta', NULL, 33),
(578, 'Wamako', NULL, 33),
(579, 'Wurno', NULL, 33),
(580, 'Yabo', NULL, 33),
(581, 'Binji', NULL, 33),
(582, 'Bodinga', NULL, 33),
(583, 'Dange Shuni', NULL, 33),
(584, 'Goronyo', NULL, 33),
(585, 'Gada', NULL, 33),
(586, 'Bokkos', NULL, 34),
(587, 'Barkin Ladi', NULL, 34),
(588, 'Bassa', NULL, 34),
(589, 'Jos East', NULL, 34),
(590, 'Jos North', NULL, 34),
(591, 'Jos South', NULL, 34),
(592, 'Kanam', NULL, 34),
(593, 'Kanke', NULL, 34),
(594, 'Langtang South', NULL, 34),
(595, 'Langtang North', NULL, 34),
(596, 'Mangu', NULL, 34),
(597, 'Mikang', NULL, 34),
(598, 'Pankshin', NULL, 34),
(599, 'Qua\'an Pan', NULL, 34),
(600, 'Riyom', NULL, 34),
(601, 'Shendam', NULL, 34),
(602, 'Wase', NULL, 34),
(603, 'Ardo Kola', NULL, 35),
(604, 'Bali', NULL, 35),
(605, 'Donga', NULL, 35),
(606, 'Gashaka', NULL, 35),
(607, 'Gassol', NULL, 35),
(608, 'Ibi', NULL, 35),
(609, 'Jalingo', NULL, 35),
(610, 'Karim Lamido', NULL, 35),
(611, 'Kumi', NULL, 35),
(612, 'Lau', NULL, 35),
(613, 'Sardauna', NULL, 35),
(614, 'Takum', NULL, 35),
(615, 'Ussa', NULL, 35),
(616, 'Wukari', NULL, 35),
(617, 'Yorro', NULL, 35),
(618, 'Zing', NULL, 35),
(619, 'Bade', NULL, 36),
(620, 'Bursari', NULL, 36),
(621, 'Damaturu', NULL, 36),
(622, 'Fika', NULL, 36),
(623, 'Fune', NULL, 36),
(624, 'Geidam', NULL, 36),
(625, 'Gujba', NULL, 36),
(626, 'Gulani', NULL, 36),
(627, 'Jakusko', NULL, 36),
(628, 'Karasuwa', NULL, 36),
(629, 'Machina', NULL, 36),
(630, 'Nangere', NULL, 36),
(631, 'Nguru', NULL, 36),
(632, 'Potiskum', NULL, 36),
(633, 'Tarmuwa', NULL, 36),
(634, 'Yunusari', NULL, 36),
(635, 'Anka', NULL, 37),
(636, 'Birnin Magaji/Kiyaw', NULL, 37),
(637, 'Bakura', NULL, 37),
(638, 'Bukkuyum', NULL, 37),
(639, 'Bungudu', NULL, 37),
(640, 'Gummi', NULL, 37),
(641, 'Gusau', NULL, 37),
(642, 'Kaura Namoda', NULL, 37),
(643, 'Maradun', NULL, 37),
(644, 'Shinkafi', NULL, 37),
(645, 'Maru', NULL, 37),
(646, 'Talata Mafara', NULL, 37),
(647, 'Tsafe', NULL, 37),
(648, 'Zurmi', NULL, 37),
(649, 'Agege', NULL, 23),
(650, 'Ajeromi-Ifelodun', NULL, 23),
(651, 'Alimosho', NULL, 23),
(652, 'Amuwo-Odofin', NULL, 23),
(653, 'Badagry', NULL, 23),
(654, 'Apapa', NULL, 23),
(655, 'Epe', NULL, 23),
(656, 'Eti Osa', NULL, 23),
(657, 'Ibeju-Lekki', NULL, 23),
(658, 'Ifako-Ijaiye', NULL, 23),
(659, 'Ikeja', NULL, 23),
(660, 'Ikorodu', NULL, 23),
(661, 'Kosofe', NULL, 23),
(662, 'Lagos Island', NULL, 23),
(663, 'Mushin', NULL, 23),
(664, 'Lagos Mainland', NULL, 23),
(665, 'Ojo', NULL, 23),
(666, 'Oshodi-Isolo', NULL, 23),
(667, 'Shomolu', NULL, 23),
(668, 'Surulere Lagos State', NULL, 23),
(669, 'Bakori', NULL, 24),
(670, 'Batagarawa', NULL, 24),
(671, 'Batsari', NULL, 24),
(672, 'Baure', NULL, 24),
(673, 'Bindawa', NULL, 24),
(674, 'Charanchi', NULL, 24),
(675, 'Danja', NULL, 24),
(676, 'Dandume', NULL, 24),
(677, 'Dan Musa', NULL, 24),
(678, 'Daura', NULL, 24),
(679, 'Dutsi', NULL, 24),
(680, 'Dutsin Ma', NULL, 24),
(681, 'Faskari', NULL, 24),
(682, 'Funtua', NULL, 24),
(683, 'Ingawa', NULL, 24),
(684, 'Jibia', NULL, 24),
(685, 'Kafur', NULL, 24),
(686, 'Kaita', NULL, 24),
(687, 'Kankara', NULL, 24),
(688, 'Kankia', NULL, 24),
(689, 'Katsina', NULL, 24),
(690, 'Kurfi', NULL, 24),
(691, 'Kusada', NULL, 24),
(692, 'Mai\'Adua', NULL, 24),
(693, 'Malumfashi', NULL, 24),
(694, 'Mani', NULL, 24),
(695, 'Mashi', NULL, 24),
(696, 'Matazu', NULL, 24),
(697, 'Musawa', NULL, 24),
(698, 'Rimi', NULL, 24),
(699, 'Sabuwa', NULL, 24),
(700, 'Safana', NULL, 24),
(701, 'Sandamu', NULL, 24),
(702, 'Zango', NULL, 24),
(703, 'Asa', NULL, 25),
(704, 'Baruten', NULL, 25),
(705, 'Edu', NULL, 25),
(706, 'Ilorin East', NULL, 25),
(707, 'Ifelodun', NULL, 25),
(708, 'Ilorin South', NULL, 25),
(709, 'Ekiti Kwara State', NULL, 25),
(710, 'Ilorin West', NULL, 25),
(711, 'Irepodun', NULL, 25),
(712, 'Isin', NULL, 25),
(713, 'Kaiama', NULL, 25),
(714, 'Moro', NULL, 25),
(715, 'Offa', NULL, 25),
(716, 'Oke Ero', NULL, 25),
(717, 'Oyun', NULL, 25),
(718, 'Pategi', NULL, 25),
(719, 'Akwanga', NULL, 26),
(720, 'Awe', NULL, 26),
(721, 'Doma', NULL, 26),
(722, 'Karu', NULL, 26),
(723, 'Keana', NULL, 26),
(724, 'Keffi', NULL, 26),
(725, 'Lafia', NULL, 26),
(726, 'Kokona', NULL, 26),
(727, 'Nasarawa Egon', NULL, 26),
(728, 'Nasarawa', NULL, 26),
(729, 'Obi', NULL, 26),
(730, 'Toto', NULL, 26),
(731, 'Wamba', NULL, 26),
(732, 'Agaie', NULL, 27),
(733, 'Agwara', NULL, 27),
(734, 'Bida', NULL, 27),
(735, 'Borgu', NULL, 27),
(736, 'Bosso', NULL, 27),
(737, 'Chanchaga', NULL, 27),
(738, 'Edati', NULL, 27),
(739, 'Gbako', NULL, 27),
(740, 'Gurara', NULL, 27),
(741, 'Katcha', NULL, 27),
(742, 'Kontagora', NULL, 27),
(743, 'Lapai', NULL, 27),
(744, 'Lavun', NULL, 27),
(745, 'Mariga', NULL, 27),
(746, 'Magama', NULL, 27),
(747, 'Mokwa', NULL, 27),
(748, 'Mashegu', NULL, 27),
(749, 'Moya', NULL, 27),
(750, 'Paikoro', NULL, 27),
(751, 'Rafi', NULL, 27),
(752, 'Rijau', NULL, 27),
(753, 'Shiroro', NULL, 27),
(754, 'Suleja', NULL, 27),
(755, 'Tafa', NULL, 27),
(756, 'Wushishi', NULL, 27),
(757, 'Aba North', NULL, 1),
(758, 'Arochukwu', NULL, 1),
(759, 'Aba South', NULL, 1),
(760, 'Bende', NULL, 1),
(761, 'Isiala Ngwa North', NULL, 1),
(762, 'Ikwuano', NULL, 1),
(763, 'Isiala Ngwa South', NULL, 1),
(764, 'Isuikwuato', NULL, 1),
(765, 'Obi Ngwa', NULL, 1),
(766, 'Ohafia', NULL, 1),
(767, 'Osisioma', NULL, 1),
(768, 'Ugwunagbo', NULL, 1),
(769, 'Ukwa East', NULL, 1),
(770, 'Ukwa West', NULL, 1),
(771, 'Umuahia North', NULL, 1),
(772, 'Umuahia South', NULL, 1),
(773, 'Umu Nneochi', NULL, 1),
(774, 'Demsa', 'Adamawa', 2),
(775, 'Fufure', 'Adamawa', 2),
(776, 'Ganye', 'Adamawa', 2),
(777, 'Gayuk', 'Adamawa', 2),
(778, 'Gombi', 'Adamawa', 2),
(779, 'Grie', 'Adamawa', 2),
(780, 'Hong', 'Adamawa', 2),
(781, 'Jada', 'Adamawa', 2),
(782, 'Larmurde', 'Adamawa', 2),
(783, 'Madagali', 'Adamawa', 2),
(784, 'Maiha', 'Adamawa', 2),
(785, 'Mayo Belwa', 'Adamawa', 2),
(786, 'Michika', 'Adamawa', 2),
(787, 'Mubi North', 'Adamawa', 2),
(788, 'Mubi South', 'Adamawa', 2),
(789, 'Numan', 'Adamawa', 2),
(790, 'Shelleng', 'Adamawa', 2),
(791, 'Song', 'Adamawa', 2),
(792, 'Toungo', 'Adamawa', 2),
(793, 'Yola North', 'Adamawa', 2),
(794, 'Yola South', 'Adamawa', 2),
(795, 'Abak', 'Akwa Ibom', 3),
(796, 'Eastern Obolo', 'Akwa Ibom', 3),
(797, 'Eket', 'Akwa Ibom', 3),
(798, 'Esit Eket', 'Akwa Ibom', 3),
(799, 'Essien Udim', 'Akwa Ibom', 3),
(800, 'Etim Ekpo', 'Akwa Ibom', 3),
(801, 'Etinan', 'Akwa Ibom', 3),
(802, 'Ibeno', 'Akwa Ibom', 3),
(803, 'Ibesikpo Asutan', 'Akwa Ibom', 3),
(804, 'Ibiono-Ibom', 'Akwa Ibom', 3),
(805, 'Ikot Abasi', 'Akwa Ibom', 3),
(806, 'Ika', 'Akwa Ibom', 3),
(807, 'Ikono', 'Akwa Ibom', 3),
(808, 'Ikot Ekpene', 'Akwa Ibom', 3),
(809, 'Ini', 'Akwa Ibom', 3),
(810, 'Mkpat-Enin', 'Akwa Ibom', 3),
(811, 'Itu', 'Akwa Ibom', 3),
(812, 'Mbo', 'Akwa Ibom', 3),
(813, 'Nsit-Atai', 'Akwa Ibom', 3),
(814, 'Nsit-Ibom', 'Akwa Ibom', 3),
(815, 'Nsit-Ubium', 'Akwa Ibom', 3),
(816, 'Obot Akara', 'Akwa Ibom', 3),
(817, 'Okobo', 'Akwa Ibom', 3),
(818, 'Onna', 'Akwa Ibom', 3),
(819, 'Oron', 'Akwa Ibom', 3),
(820, 'Udung-Uko', 'Akwa Ibom', 3),
(821, 'Ukanafun', 'Akwa Ibom', 3),
(822, 'Oruk Anam', 'Akwa Ibom', 3),
(823, 'Uruan', 'Akwa Ibom', 3),
(824, 'Urue-Offong/Oruko', 'Akwa Ibom', 3),
(825, 'Uyo', 'Akwa Ibom', 3),
(826, 'Aguata', 'Anambra', 4),
(827, 'Anambra East', 'Anambra', 4),
(828, 'Anaocha', 'Anambra', 4),
(829, 'Awka North', 'Anambra', 4),
(830, 'Anambra West', 'Anambra', 4),
(831, 'Awka South', 'Anambra', 4),
(832, 'Ayamelum', 'Anambra', 4),
(833, 'Dunukofia', 'Anambra', 4),
(834, 'Ekwusigo', 'Anambra', 4),
(835, 'Idemili North', 'Anambra', 4),
(836, 'Idemili South', 'Anambra', 4),
(837, 'Ihiala', 'Anambra', 4),
(838, 'Njikoka', 'Anambra', 4),
(839, 'Nnewi North', 'Anambra', 4),
(840, 'Nnewi South', 'Anambra', 4),
(841, 'Ogbaru', 'Anambra', 4),
(842, 'Onitsha North', 'Anambra', 4),
(843, 'Onitsha South', 'Anambra', 4),
(844, 'Orumba North', 'Anambra', 4),
(845, 'Orumba South', 'Anambra', 4),
(846, 'Oyi', 'Anambra', 4),
(847, 'Abeokuta North', 'Ogun', 28),
(848, 'Abeokuta South', 'Ogun', 28),
(849, 'Ado-Odo/Ota', 'Ogun', 28),
(850, 'Egbado North', 'Ogun', 28),
(851, 'Ewekoro', 'Ogun', 28),
(852, 'Egbado South', 'Ogun', 28),
(853, 'Ijebu North', 'Ogun', 28),
(854, 'Ijebu East', 'Ogun', 28),
(855, 'Ifo', 'Ogun', 28),
(856, 'Ijebu Ode', 'Ogun', 28),
(857, 'Ijebu North East', 'Ogun', 28),
(858, 'Imeko Afon', 'Ogun', 28),
(859, 'Ikenne', 'Ogun', 28),
(860, 'Ipokia', 'Ogun', 28),
(861, 'Odeda', 'Ogun', 28),
(862, 'Obafemi Owode', 'Ogun', 28),
(863, 'Odogbolu', 'Ogun', 28),
(864, 'Remo North', 'Ogun', 28),
(865, 'Ogun Waterside', 'Ogun', 28),
(866, 'Shagamu', 'Ogun', 28),
(867, 'Akoko North-East', 'Ondo', 29),
(868, 'Akoko North-West', 'Ondo', 29),
(869, 'Akoko South-West', 'Ondo', 29),
(870, 'Akoko South-East', 'Ondo', 29),
(871, 'Akure North', 'Ondo', 29),
(872, 'Akure South', 'Ondo', 29),
(873, 'Ese Odo', 'Ondo', 29),
(874, 'Idanre', 'Ondo', 29),
(875, 'Ifedore', 'Ondo', 29),
(876, 'Ilaje', 'Ondo', 29),
(877, 'Irele', 'Ondo', 29),
(878, 'Ile Oluji/Okeigbo', 'Ondo', 29),
(879, 'Odigbo', 'Ondo', 29),
(880, 'Okitipupa', 'Ondo', 29),
(881, 'Ondo West', 'Ondo', 29),
(882, 'Ose', 'Ondo', 29),
(883, 'Ondo East', 'Ondo', 29),
(884, 'Owo', 'Ondo', 29),
(885, 'Alkaleri', 'Bauchi', 5),
(886, 'Bauchi', 'Bauchi', 5),
(887, 'Bogoro', 'Bauchi', 5),
(888, 'Damban', 'Bauchi', 5),
(889, 'Darazo', 'Bauchi', 5),
(890, 'Dass', 'Bauchi', 5),
(891, 'Gamawa', 'Bauchi', 5),
(892, 'Ganjuwa', 'Bauchi', 5),
(893, 'Giade', 'Bauchi', 5),
(894, 'Itas/Gadau', 'Bauchi', 5),
(895, 'Jama\'are', 'Bauchi', 5),
(896, 'Katagum', 'Bauchi', 5),
(897, 'Kirfi', 'Bauchi', 5),
(898, 'Misau', 'Bauchi', 5),
(899, 'Ningi', 'Bauchi', 5),
(900, 'Shira', 'Bauchi', 5),
(901, 'Tafawa Balewa', 'Bauchi', 5),
(902, 'Toro', 'Bauchi', 5),
(903, 'Warji', 'Bauchi', 5),
(904, 'Zaki', 'Bauchi', 5),
(905, 'Agatu', 'Benue', 6),
(906, 'Apa', 'Benue', 6),
(907, 'Ado', 'Benue', 6),
(908, 'Buruku', 'Benue', 6),
(909, 'Gboko', 'Benue', 6),
(910, 'Guma', 'Benue', 6),
(911, 'Gwer East', 'Benue', 6),
(912, 'Gwer West', 'Benue', 6),
(913, 'Katsina-Ala', 'Benue', 6),
(914, 'Konshisha', 'Benue', 6),
(915, 'Kwande', 'Benue', 6),
(916, 'Logo', 'Benue', 6),
(917, 'Makurdi', 'Benue', 6),
(918, 'Obi', 'Benue', 6),
(919, 'Ogbadibo', 'Benue', 6),
(920, 'Ohimini', 'Benue', 6),
(921, 'Oju', 'Benue', 6),
(922, 'Okpokwu', 'Benue', 6),
(923, 'Oturkpo', 'Benue', 6),
(924, 'Tarka', 'Benue', 6),
(925, 'Ukum', 'Benue', 6),
(926, 'Ushongo', 'Benue', 6),
(927, 'Vandeikya', 'Benue', 6),
(928, 'Abadam', 'Borno', 7),
(929, 'Askira/Uba', 'Borno', 7),
(930, 'Bama', 'Borno', 7),
(931, 'Bayo', 'Borno', 7),
(932, 'Biu', 'Borno', 7),
(933, 'Chibok', 'Borno', 7),
(934, 'Damboa', 'Borno', 7),
(935, 'Dikwa', 'Borno', 7),
(936, 'Guzamala', 'Borno', 7),
(937, 'Gubio', 'Borno', 7),
(938, 'Hawul', 'Borno', 7),
(939, 'Gwoza', 'Borno', 7),
(940, 'Jere', 'Borno', 7),
(941, 'Kaga', 'Borno', 7),
(942, 'Kala/Balge', 'Borno', 7),
(943, 'Konduga', 'Borno', 7),
(944, 'Kukawa', 'Borno', 7),
(945, 'Kwaya Kusar', 'Borno', 7),
(946, 'Mafa', 'Borno', 7),
(947, 'Magumeri', 'Borno', 7),
(948, 'Maiduguri', 'Borno', 7),
(949, 'Mobbar', 'Borno', 7),
(950, 'Marte', 'Borno', 7),
(951, 'Monguno', 'Borno', 7),
(952, 'Ngala', 'Borno', 7),
(953, 'Nganzai', 'Borno', 7),
(954, 'Shani', 'Borno', 7),
(955, 'Brass', 'Bayelsa', 8),
(956, 'Ekeremor', 'Bayelsa', 8),
(957, 'Kolokuma/Opokuma', 'Bayelsa', 8),
(958, 'Nembe', 'Bayelsa', 8),
(959, 'Ogbia', 'Bayelsa', 8),
(960, 'Sagbama', 'Bayelsa', 8),
(961, 'Southern Ijaw', 'Bayelsa', 8),
(962, 'Yenagoa', 'Bayelsa', 8),
(963, 'Abi', 'Cross River', 9),
(964, 'Akamkpa', 'Cross River', 9),
(965, 'Akpabuyo', 'Cross River', 9),
(966, 'Bakassi', 'Cross River', 9),
(967, 'Bekwarra', 'Cross River', 9),
(968, 'Biase', 'Cross River', 9),
(969, 'Boki', 'Cross River', 9),
(970, 'Calabar Municipal', 'Cross River', 9),
(971, 'Calabar South', 'Cross River', 9),
(972, 'Etung', 'Cross River', 9),
(973, 'Ikom', 'Cross River', 9),
(974, 'Obanliku', 'Cross River', 9),
(975, 'Obubra', 'Cross River', 9),
(976, 'Obudu', 'Cross River', 9),
(977, 'Odukpani', 'Cross River', 9),
(978, 'Ogoja', 'Cross River', 9),
(979, 'Yakuur', 'Cross River', 9),
(980, 'Yala', 'Cross River', 9),
(981, 'Aniocha North', 'Delta', 10),
(982, 'Aniocha South', 'Delta', 10),
(983, 'Bomadi', 'Delta', 10),
(984, 'Burutu', 'Delta', 10),
(985, 'Ethiope West', 'Delta', 10),
(986, 'Ethiope East', 'Delta', 10),
(987, 'Ika North East', 'Delta', 10),
(988, 'Ika South', 'Delta', 10),
(989, 'Isoko North', 'Delta', 10),
(990, 'Isoko South', 'Delta', 10),
(991, 'Ndokwa East', 'Delta', 10),
(992, 'Ndokwa West', 'Delta', 10),
(993, 'Okpe', 'Delta', 10),
(994, 'Oshimili North', 'Delta', 10),
(995, 'Oshimili South', 'Delta', 10),
(996, 'Patani', 'Delta', 10),
(997, 'Sapele', 'Delta', 10),
(998, 'Udu', 'Delta', 10),
(999, 'Ughelli North', 'Delta', 10),
(1000, 'Ukwuani', 'Delta', 10),
(1001, 'Ughelli South', 'Delta', 10),
(1002, 'Uvwie', 'Delta', 10),
(1003, 'Warri North', 'Delta', 10),
(1004, 'Warri South', 'Delta', 10),
(1005, 'Warri South West', 'Delta', 10),
(1006, 'Abakaliki', 'Ebonyi', 11),
(1007, 'Afikpo North', 'Ebonyi', 11),
(1008, 'Ebonyi', 'Ebonyi', 11),
(1009, 'Afikpo South', 'Ebonyi', 11),
(1010, 'Ezza North', 'Ebonyi', 11),
(1011, 'Ikwo', 'Ebonyi', 11),
(1012, 'Ezza South', 'Ebonyi', 11),
(1013, 'Ivo', 'Ebonyi', 11),
(1014, 'Ishielu', 'Ebonyi', 11),
(1015, 'Izzi', 'Ebonyi', 11),
(1016, 'Ohaozara', 'Ebonyi', 11),
(1017, 'Ohaukwu', 'Ebonyi', 11),
(1018, 'Onicha', 'Ebonyi', 11),
(1019, 'Akoko-Edo', 'Edo', 12),
(1020, 'Egor', 'Edo', 12),
(1021, 'Esan Central', 'Edo', 12),
(1022, 'Esan North-East', 'Edo', 12),
(1023, 'Esan South-East', 'Edo', 12),
(1024, 'Esan West', 'Edo', 12),
(1025, 'Etsako Central', 'Edo', 12),
(1026, 'Etsako East', 'Edo', 12),
(1027, 'Etsako West', 'Edo', 12),
(1028, 'Igueben', 'Edo', 12),
(1029, 'Ikpoba Okha', 'Edo', 12),
(1030, 'Orhionmwon', 'Edo', 12),
(1031, 'Oredo', 'Edo', 12),
(1032, 'Ovia North-East', 'Edo', 12),
(1033, 'Ovia South-West', 'Edo', 12),
(1034, 'Owan East', 'Edo', 12),
(1035, 'Owan West', 'Edo', 12),
(1036, 'Uhunmwonde', 'Edo', 12),
(1037, 'Ado Ekiti', 'Ekiti', 13),
(1038, 'Efon', 'Ekiti', 13),
(1039, 'Ekiti East', 'Ekiti', 13),
(1040, 'Ekiti South-West', 'Ekiti', 13),
(1041, 'Ekiti West', 'Ekiti', 13),
(1042, 'Emure', 'Ekiti', 13),
(1043, 'Gbonyin', 'Ekiti', 13),
(1044, 'Ido Osi', 'Ekiti', 13),
(1045, 'Ijero', 'Ekiti', 13),
(1046, 'Ikere', 'Ekiti', 13),
(1047, 'Ilejemeje', 'Ekiti', 13),
(1048, 'Irepodun/Ifelodun', 'Ekiti', 13),
(1049, 'Ikole', 'Ekiti', 13),
(1050, 'Ise/Orun', 'Ekiti', 13),
(1051, 'Moba', 'Ekiti', 13),
(1052, 'Oye', 'Ekiti', 13),
(1053, 'Awgu', 'Enugu', 14),
(1054, 'Aninri', 'Enugu', 14),
(1055, 'Enugu East', 'Enugu', 14),
(1056, 'Enugu North', 'Enugu', 14),
(1057, 'Ezeagu', 'Enugu', 14),
(1058, 'Enugu South', 'Enugu', 14),
(1059, 'Igbo Etiti', 'Enugu', 14),
(1060, 'Igbo Eze North', 'Enugu', 14),
(1061, 'Igbo Eze South', 'Enugu', 14),
(1062, 'Isi Uzo', 'Enugu', 14),
(1063, 'Nkanu East', 'Enugu', 14),
(1064, 'Nkanu West', 'Enugu', 14),
(1065, 'Nsukka', 'Enugu', 14),
(1066, 'Udenu', 'Enugu', 14),
(1067, 'Oji River', 'Enugu', 14),
(1068, 'Uzo Uwani', 'Enugu', 14),
(1069, 'Udi', 'Enugu', 14),
(1070, 'Abaji', 'Federal Capital Terr', 15),
(1071, 'Bwari', 'Federal Capital Terr', 15),
(1072, 'Gwagwalada', 'Federal Capital Terr', 15),
(1073, 'Kuje', 'Federal Capital Terr', 15),
(1074, 'Kwali', 'Federal Capital Terr', 15),
(1075, 'Municipal Area Council', 'Federal Capital Terr', 15),
(1076, 'Akko', 'Gombe', 16),
(1077, 'Balanga', 'Gombe', 16),
(1078, 'Billiri', 'Gombe', 16),
(1079, 'Dukku', 'Gombe', 16),
(1080, 'Funakaye', 'Gombe', 16),
(1081, 'Gombe', 'Gombe', 16),
(1082, 'Kaltungo', 'Gombe', 16),
(1083, 'Kwami', 'Gombe', 16),
(1084, 'Nafada', 'Gombe', 16),
(1085, 'Shongom', 'Gombe', 16),
(1086, 'Yamaltu/Deba', 'Gombe', 16),
(1087, 'Auyo', 'Jigawa', 17),
(1088, 'Babura', 'Jigawa', 17),
(1089, 'Buji', 'Jigawa', 17),
(1090, 'Biriniwa', 'Jigawa', 17),
(1091, 'Birnin Kudu', 'Jigawa', 17),
(1092, 'Dutse', 'Jigawa', 17),
(1093, 'Gagarawa', 'Jigawa', 17),
(1094, 'Garki', 'Jigawa', 17),
(1095, 'Gumel', 'Jigawa', 17),
(1096, 'Guri', 'Jigawa', 17),
(1097, 'Gwaram', 'Jigawa', 17),
(1098, 'Gwiwa', 'Jigawa', 17),
(1099, 'Hadejia', 'Jigawa', 17),
(1100, 'Jahun', 'Jigawa', 17),
(1101, 'Kafin Hausa', 'Jigawa', 17),
(1102, 'Kazaure', 'Jigawa', 17),
(1103, 'Kiri Kasama', 'Jigawa', 17),
(1104, 'Kiyawa', 'Jigawa', 17),
(1105, 'Kaugama', 'Jigawa', 17),
(1106, 'Maigatari', 'Jigawa', 17),
(1107, 'Malam Madori', 'Jigawa', 17),
(1108, 'Miga', 'Jigawa', 17),
(1109, 'Sule Tankarkar', 'Jigawa', 17),
(1110, 'Roni', 'Jigawa', 17),
(1111, 'Ringim', 'Jigawa', 17),
(1112, 'Yankwashi', 'Jigawa', 17),
(1113, 'Taura', 'Jigawa', 17),
(1114, 'Afijio', 'Oyo', 31),
(1115, 'Akinyele', 'Oyo', 31),
(1116, 'Atiba', 'Oyo', 31),
(1117, 'Atisbo', 'Oyo', 31),
(1118, 'Egbeda', 'Oyo', 31),
(1119, 'Ibadan North', 'Oyo', 31),
(1120, 'Ibadan North-East', 'Oyo', 31),
(1121, 'Ibadan North-West', 'Oyo', 31),
(1122, 'Ibadan South-East', 'Oyo', 31),
(1123, 'Ibarapa Central', 'Oyo', 31),
(1124, 'Ibadan South-West', 'Oyo', 31),
(1125, 'Ibarapa East', 'Oyo', 31),
(1126, 'Ido', 'Oyo', 31),
(1127, 'Ibarapa North', 'Oyo', 31),
(1128, 'Irepo', 'Oyo', 31),
(1129, 'Iseyin', 'Oyo', 31),
(1130, 'Itesiwaju', 'Oyo', 31),
(1131, 'Iwajowa', 'Oyo', 31),
(1132, 'Kajola', 'Oyo', 31),
(1133, 'Lagelu', 'Oyo', 31),
(1134, 'Ogbomosho North', 'Oyo', 31),
(1135, 'Ogbomosho South', 'Oyo', 31),
(1136, 'Ogo Oluwa', 'Oyo', 31),
(1137, 'Olorunsogo', 'Oyo', 31),
(1138, 'Oluyole', 'Oyo', 31),
(1139, 'Ona Ara', 'Oyo', 31),
(1140, 'Orelope', 'Oyo', 31),
(1141, 'Ori Ire', 'Oyo', 31),
(1142, 'Oyo', 'Oyo', 31),
(1143, 'Oyo East', 'Oyo', 31),
(1144, 'Saki East', 'Oyo', 31),
(1145, 'Saki West', 'Oyo', 31),
(1146, 'Surulere Oyo State', 'Oyo', 31),
(1147, 'Aboh Mbaise', 'Imo', 18),
(1148, 'Ahiazu Mbaise', 'Imo', 18),
(1149, 'Ehime Mbano', 'Imo', 18),
(1150, 'Ezinihitte', 'Imo', 18),
(1151, 'Ideato North', 'Imo', 18),
(1152, 'Ideato South', 'Imo', 18),
(1153, 'Ihitte/Uboma', 'Imo', 18),
(1154, 'Ikeduru', 'Imo', 18),
(1155, 'Isiala Mbano', 'Imo', 18),
(1156, 'Mbaitoli', 'Imo', 18),
(1157, 'Isu', 'Imo', 18),
(1158, 'Ngor Okpala', 'Imo', 18),
(1159, 'Njaba', 'Imo', 18),
(1160, 'Nkwerre', 'Imo', 18),
(1161, 'Nwangele', 'Imo', 18),
(1162, 'Obowo', 'Imo', 18),
(1163, 'Oguta', 'Imo', 18),
(1164, 'Ohaji/Egbema', 'Imo', 18),
(1165, 'Okigwe', 'Imo', 18),
(1166, 'Orlu', 'Imo', 18),
(1167, 'Orsu', 'Imo', 18),
(1168, 'Oru East', 'Imo', 18),
(1169, 'Oru West', 'Imo', 18),
(1170, 'Owerri Municipal', 'Imo', 18),
(1171, 'Owerri North', 'Imo', 18),
(1172, 'Unuimo', 'Imo', 18),
(1173, 'Owerri West', 'Imo', 18),
(1174, 'Birnin Gwari', 'Kaduna', 19),
(1175, 'Chikun', 'Kaduna', 19),
(1176, 'Giwa', 'Kaduna', 19),
(1177, 'Ikara', 'Kaduna', 19),
(1178, 'Igabi', 'Kaduna', 19),
(1179, 'Jaba', 'Kaduna', 19),
(1180, 'Jema\'a', 'Kaduna', 19),
(1181, 'Kachia', 'Kaduna', 19),
(1182, 'Kaduna North', 'Kaduna', 19),
(1183, 'Kaduna South', 'Kaduna', 19),
(1184, 'Kagarko', 'Kaduna', 19),
(1185, 'Kajuru', 'Kaduna', 19),
(1186, 'Kaura', 'Kaduna', 19),
(1187, 'Kauru', 'Kaduna', 19),
(1188, 'Kubau', 'Kaduna', 19),
(1189, 'Kudan', 'Kaduna', 19),
(1190, 'Lere', 'Kaduna', 19),
(1191, 'Makarfi', 'Kaduna', 19),
(1192, 'Sabon Gari', 'Kaduna', 19),
(1193, 'Sanga', 'Kaduna', 19),
(1194, 'Soba', 'Kaduna', 19),
(1195, 'Zangon Kataf', 'Kaduna', 19),
(1196, 'Zaria', 'Kaduna', 19),
(1197, 'Aleiro', 'Kebbi', 20),
(1198, 'Argungu', 'Kebbi', 20),
(1199, 'Arewa Dandi', 'Kebbi', 20),
(1200, 'Augie', 'Kebbi', 20),
(1201, 'Bagudo', 'Kebbi', 20),
(1202, 'Birnin Kebbi', 'Kebbi', 20),
(1203, 'Bunza', 'Kebbi', 20),
(1204, 'Dandi', 'Kebbi', 20),
(1205, 'Fakai', 'Kebbi', 20),
(1206, 'Gwandu', 'Kebbi', 20),
(1207, 'Jega', 'Kebbi', 20),
(1208, 'Kalgo', 'Kebbi', 20),
(1209, 'Koko/Besse', 'Kebbi', 20),
(1210, 'Maiyama', 'Kebbi', 20),
(1211, 'Ngaski', 'Kebbi', 20),
(1212, 'Shanga', 'Kebbi', 20),
(1213, 'Suru', 'Kebbi', 20),
(1214, 'Sakaba', 'Kebbi', 20),
(1215, 'Wasagu/Danko', 'Kebbi', 20),
(1216, 'Yauri', 'Kebbi', 20),
(1217, 'Zuru', 'Kebbi', 20),
(1218, 'Ajingi', 'Kano', 21),
(1219, 'Albasu', 'Kano', 21),
(1220, 'Bagwai', 'Kano', 21),
(1221, 'Bebeji', 'Kano', 21),
(1222, 'Bichi', 'Kano', 21),
(1223, 'Bunkure', 'Kano', 21),
(1224, 'Dala', 'Kano', 21),
(1225, 'Dambatta', 'Kano', 21),
(1226, 'Dawakin Kudu', 'Kano', 21),
(1227, 'Dawakin Tofa', 'Kano', 21),
(1228, 'Doguwa', 'Kano', 21),
(1229, 'Fagge', 'Kano', 21),
(1230, 'Gabasawa', 'Kano', 21),
(1231, 'Garko', 'Kano', 21),
(1232, 'Garun Mallam', 'Kano', 21),
(1233, 'Gezawa', 'Kano', 21),
(1234, 'Gaya', 'Kano', 21),
(1235, 'Gwale', 'Kano', 21),
(1236, 'Gwarzo', 'Kano', 21),
(1237, 'Kabo', 'Kano', 21),
(1238, 'Kano Municipal', 'Kano', 21),
(1239, 'Karaye', 'Kano', 21),
(1240, 'Kibiya', 'Kano', 21),
(1241, 'Kiru', 'Kano', 21),
(1242, 'Kumbotso', 'Kano', 21),
(1243, 'Kunchi', 'Kano', 21),
(1244, 'Kura', 'Kano', 21),
(1245, 'Madobi', 'Kano', 21),
(1246, 'Makoda', 'Kano', 21),
(1247, 'Minjibir', 'Kano', 21),
(1248, 'Nasarawa', 'Kano', 21),
(1249, 'Rano', 'Kano', 21),
(1250, 'Rimin Gado', 'Kano', 21),
(1251, 'Rogo', 'Kano', 21),
(1252, 'Shanono', 'Kano', 21),
(1253, 'Takai', 'Kano', 21),
(1254, 'Sumaila', 'Kano', 21),
(1255, 'Tarauni', 'Kano', 21),
(1256, 'Tofa', 'Kano', 21),
(1257, 'Tsanyawa', 'Kano', 21),
(1258, 'Tudun Wada', 'Kano', 21),
(1259, 'Ungogo', 'Kano', 21),
(1260, 'Warawa', 'Kano', 21),
(1261, 'Wudil', 'Kano', 21),
(1262, 'Ajaokuta', 'Kogi', 22),
(1263, 'Adavi', 'Kogi', 22),
(1264, 'Ankpa', 'Kogi', 22),
(1265, 'Bassa', 'Kogi', 22),
(1266, 'Dekina', 'Kogi', 22),
(1267, 'Ibaji', 'Kogi', 22),
(1268, 'Idah', 'Kogi', 22),
(1269, 'Igalamela Odolu', 'Kogi', 22),
(1270, 'Ijumu', 'Kogi', 22),
(1271, 'Kogi', 'Kogi', 22),
(1272, 'Kabba/Bunu', 'Kogi', 22),
(1273, 'Lokoja', 'Kogi', 22),
(1274, 'Ofu', 'Kogi', 22),
(1275, 'Mopa Muro', 'Kogi', 22),
(1276, 'Ogori/Magongo', 'Kogi', 22),
(1277, 'Okehi', 'Kogi', 22),
(1278, 'Okene', 'Kogi', 22),
(1279, 'Olamaboro', 'Kogi', 22),
(1280, 'Omala', 'Kogi', 22),
(1281, 'Yagba East', 'Kogi', 22),
(1282, 'Yagba West', 'Kogi', 22),
(1283, 'Aiyedire', 'Osun', 32),
(1284, 'Atakunmosa West', 'Osun', 32),
(1285, 'Atakunmosa East', 'Osun', 32),
(1286, 'Aiyedaade', 'Osun', 32),
(1287, 'Boluwaduro', 'Osun', 32),
(1288, 'Boripe', 'Osun', 32),
(1289, 'Ife East', 'Osun', 32),
(1290, 'Ede South', 'Osun', 32),
(1291, 'Ife North', 'Osun', 32),
(1292, 'Ede North', 'Osun', 32),
(1293, 'Ife South', 'Osun', 32),
(1294, 'Ejigbo', 'Osun', 32),
(1295, 'Ife Central', 'Osun', 32),
(1296, 'Ifedayo', 'Osun', 32),
(1297, 'Egbedore', 'Osun', 32),
(1298, 'Ila', 'Osun', 32),
(1299, 'Ifelodun', 'Osun', 32),
(1300, 'Ilesa East', 'Osun', 32),
(1301, 'Ilesa West', 'Osun', 32),
(1302, 'Irepodun', 'Osun', 32),
(1303, 'Irewole', 'Osun', 32),
(1304, 'Isokan', 'Osun', 32),
(1305, 'Iwo', 'Osun', 32),
(1306, 'Obokun', 'Osun', 32),
(1307, 'Odo Otin', 'Osun', 32),
(1308, 'Ola Oluwa', 'Osun', 32),
(1309, 'Olorunda', 'Osun', 32),
(1310, 'Oriade', 'Osun', 32),
(1311, 'Orolu', 'Osun', 32),
(1312, 'Osogbo', 'Osun', 32),
(1313, 'Gudu', 'Sokoto', 33),
(1314, 'Gwadabawa', 'Sokoto', 33),
(1315, 'Illela', 'Sokoto', 33),
(1316, 'Isa', 'Sokoto', 33),
(1317, 'Kebbe', 'Sokoto', 33),
(1318, 'Kware', 'Sokoto', 33),
(1319, 'Rabah', 'Sokoto', 33),
(1320, 'Sabon Birni', 'Sokoto', 33),
(1321, 'Shagari', 'Sokoto', 33),
(1322, 'Silame', 'Sokoto', 33),
(1323, 'Sokoto North', 'Sokoto', 33),
(1324, 'Sokoto South', 'Sokoto', 33),
(1325, 'Tambuwal', 'Sokoto', 33),
(1326, 'Tangaza', 'Sokoto', 33),
(1327, 'Tureta', 'Sokoto', 33),
(1328, 'Wamako', 'Sokoto', 33),
(1329, 'Wurno', 'Sokoto', 33),
(1330, 'Yabo', 'Sokoto', 33),
(1331, 'Binji', 'Sokoto', 33),
(1332, 'Bodinga', 'Sokoto', 33),
(1333, 'Dange Shuni', 'Sokoto', 33),
(1334, 'Goronyo', 'Sokoto', 33),
(1335, 'Gada', 'Sokoto', 33),
(1336, 'Bokkos', 'Plateau', 34),
(1337, 'Barkin Ladi', 'Plateau', 34),
(1338, 'Bassa', 'Plateau', 34),
(1339, 'Jos East', 'Plateau', 34),
(1340, 'Jos North', 'Plateau', 34),
(1341, 'Jos South', 'Plateau', 34),
(1342, 'Kanam', 'Plateau', 34),
(1343, 'Kanke', 'Plateau', 34),
(1344, 'Langtang South', 'Plateau', 34),
(1345, 'Langtang North', 'Plateau', 34),
(1346, 'Mangu', 'Plateau', 34),
(1347, 'Mikang', 'Plateau', 34),
(1348, 'Pankshin', 'Plateau', 34),
(1349, 'Qua\'an Pan', 'Plateau', 34),
(1350, 'Riyom', 'Plateau', 34),
(1351, 'Shendam', 'Plateau', 34),
(1352, 'Wase', 'Plateau', 34),
(1353, 'Ardo Kola', 'Taraba', 35),
(1354, 'Bali', 'Taraba', 35),
(1355, 'Donga', 'Taraba', 35),
(1356, 'Gashaka', 'Taraba', 35),
(1357, 'Gassol', 'Taraba', 35),
(1358, 'Ibi', 'Taraba', 35),
(1359, 'Jalingo', 'Taraba', 35),
(1360, 'Karim Lamido', 'Taraba', 35),
(1361, 'Kumi', 'Taraba', 35),
(1362, 'Lau', 'Taraba', 35),
(1363, 'Sardauna', 'Taraba', 35),
(1364, 'Takum', 'Taraba', 35),
(1365, 'Ussa', 'Taraba', 35),
(1366, 'Wukari', 'Taraba', 35),
(1367, 'Yorro', 'Taraba', 35),
(1368, 'Zing', 'Taraba', 35),
(1369, 'Bade', 'Yobe', 36),
(1370, 'Bursari', 'Yobe', 36),
(1371, 'Damaturu', 'Yobe', 36),
(1372, 'Fika', 'Yobe', 36),
(1373, 'Fune', 'Yobe', 36),
(1374, 'Geidam', 'Yobe', 36),
(1375, 'Gujba', 'Yobe', 36),
(1376, 'Gulani', 'Yobe', 36),
(1377, 'Jakusko', 'Yobe', 36),
(1378, 'Karasuwa', 'Yobe', 36),
(1379, 'Machina', 'Yobe', 36),
(1380, 'Nangere', 'Yobe', 36),
(1381, 'Nguru', 'Yobe', 36),
(1382, 'Potiskum', 'Yobe', 36),
(1383, 'Tarmuwa', 'Yobe', 36),
(1384, 'Yunusari', 'Yobe', 36),
(1385, 'Anka', 'Zamfara', 37),
(1386, 'Birnin Magaji/Kiyaw', 'Zamfara', 37),
(1387, 'Bakura', 'Zamfara', 37),
(1388, 'Bukkuyum', 'Zamfara', 37),
(1389, 'Bungudu', 'Zamfara', 37),
(1390, 'Gummi', 'Zamfara', 37),
(1391, 'Gusau', 'Zamfara', 37),
(1392, 'Kaura Namoda', 'Zamfara', 37),
(1393, 'Maradun', 'Zamfara', 37),
(1394, 'Shinkafi', 'Zamfara', 37),
(1395, 'Maru', 'Zamfara', 37),
(1396, 'Talata Mafara', 'Zamfara', 37),
(1397, 'Tsafe', 'Zamfara', 37),
(1398, 'Zurmi', 'Zamfara', 37),
(1399, 'Agege', 'Lagos', 23),
(1400, 'Ajeromi-Ifelodun', 'Lagos', 23),
(1401, 'Alimosho', 'Lagos', 23),
(1402, 'Amuwo-Odofin', 'Lagos', 23),
(1403, 'Badagry', 'Lagos', 23),
(1404, 'Apapa', 'Lagos', 23),
(1405, 'Epe', 'Lagos', 23),
(1406, 'Eti Osa', 'Lagos', 23),
(1407, 'Ibeju-Lekki', 'Lagos', 23),
(1408, 'Ifako-Ijaiye', 'Lagos', 23),
(1409, 'Ikeja', 'Lagos', 23),
(1410, 'Ikorodu', 'Lagos', 23),
(1411, 'Kosofe', 'Lagos', 23),
(1412, 'Lagos Island', 'Lagos', 23),
(1413, 'Mushin', 'Lagos', 23),
(1414, 'Lagos Mainland', 'Lagos', 23),
(1415, 'Ojo', 'Lagos', 23),
(1416, 'Oshodi-Isolo', 'Lagos', 23),
(1417, 'Shomolu', 'Lagos', 23),
(1418, 'Surulere Lagos State', 'Lagos', 23),
(1419, 'Bakori', 'Katsina', 24),
(1420, 'Batagarawa', 'Katsina', 24),
(1421, 'Batsari', 'Katsina', 24),
(1422, 'Baure', 'Katsina', 24),
(1423, 'Bindawa', 'Katsina', 24),
(1424, 'Charanchi', 'Katsina', 24),
(1425, 'Danja', 'Katsina', 24),
(1426, 'Dandume', 'Katsina', 24),
(1427, 'Dan Musa', 'Katsina', 24),
(1428, 'Daura', 'Katsina', 24),
(1429, 'Dutsi', 'Katsina', 24),
(1430, 'Dutsin Ma', 'Katsina', 24),
(1431, 'Faskari', 'Katsina', 24),
(1432, 'Funtua', 'Katsina', 24),
(1433, 'Ingawa', 'Katsina', 24),
(1434, 'Jibia', 'Katsina', 24),
(1435, 'Kafur', 'Katsina', 24),
(1436, 'Kaita', 'Katsina', 24),
(1437, 'Kankara', 'Katsina', 24),
(1438, 'Kankia', 'Katsina', 24),
(1439, 'Katsina', 'Katsina', 24),
(1440, 'Kurfi', 'Katsina', 24),
(1441, 'Kusada', 'Katsina', 24),
(1442, 'Mai\'Adua', 'Katsina', 24),
(1443, 'Malumfashi', 'Katsina', 24),
(1444, 'Mani', 'Katsina', 24),
(1445, 'Mashi', 'Katsina', 24),
(1446, 'Matazu', 'Katsina', 24),
(1447, 'Musawa', 'Katsina', 24),
(1448, 'Rimi', 'Katsina', 24),
(1449, 'Sabuwa', 'Katsina', 24),
(1450, 'Safana', 'Katsina', 24),
(1451, 'Sandamu', 'Katsina', 24),
(1452, 'Zango', 'Katsina', 24),
(1453, 'Asa', 'Kwara', 25),
(1454, 'Baruten', 'Kwara', 25),
(1455, 'Edu', 'Kwara', 25),
(1456, 'Ilorin East', 'Kwara', 25),
(1457, 'Ifelodun', 'Kwara', 25),
(1458, 'Ilorin South', 'Kwara', 25),
(1459, 'Ekiti Kwara State', 'Kwara', 25),
(1460, 'Ilorin West', 'Kwara', 25),
(1461, 'Irepodun', 'Kwara', 25),
(1462, 'Isin', 'Kwara', 25),
(1463, 'Kaiama', 'Kwara', 25),
(1464, 'Moro', 'Kwara', 25),
(1465, 'Offa', 'Kwara', 25),
(1466, 'Oke Ero', 'Kwara', 25),
(1467, 'Oyun', 'Kwara', 25),
(1468, 'Pategi', 'Kwara', 25),
(1469, 'Akwanga', 'Nasarawa', 26),
(1470, 'Awe', 'Nasarawa', 26),
(1471, 'Doma', 'Nasarawa', 26),
(1472, 'Karu', 'Nasarawa', 26),
(1473, 'Keana', 'Nasarawa', 26),
(1474, 'Keffi', 'Nasarawa', 26),
(1475, 'Lafia', 'Nasarawa', 26),
(1476, 'Kokona', 'Nasarawa', 26),
(1477, 'Nasarawa Egon', 'Nasarawa', 26),
(1478, 'Nasarawa', 'Nasarawa', 26),
(1479, 'Obi', 'Nasarawa', 26),
(1480, 'Toto', 'Nasarawa', 26),
(1481, 'Wamba', 'Nasarawa', 26),
(1482, 'Agaie', 'Niger', 27),
(1483, 'Agwara', 'Niger', 27),
(1484, 'Bida', 'Niger', 27),
(1485, 'Borgu', 'Niger', 27),
(1486, 'Bosso', 'Niger', 27),
(1487, 'Chanchaga', 'Niger', 27),
(1488, 'Edati', 'Niger', 27),
(1489, 'Gbako', 'Niger', 27),
(1490, 'Gurara', 'Niger', 27),
(1491, 'Katcha', 'Niger', 27),
(1492, 'Kontagora', 'Niger', 27),
(1493, 'Lapai', 'Niger', 27),
(1494, 'Lavun', 'Niger', 27),
(1495, 'Mariga', 'Niger', 27),
(1496, 'Magama', 'Niger', 27),
(1497, 'Mokwa', 'Niger', 27),
(1498, 'Mashegu', 'Niger', 27),
(1499, 'Moya', 'Niger', 27),
(1500, 'Paikoro', 'Niger', 27),
(1501, 'Rafi', 'Niger', 27),
(1502, 'Rijau', 'Niger', 27),
(1503, 'Shiroro', 'Niger', 27),
(1504, 'Suleja', 'Niger', 27),
(1505, 'Tafa', 'Niger', 27),
(1506, 'Wushishi', 'Niger', 27),
(1507, 'Aba North', 'Abia', 1),
(1508, 'Arochukwu', 'Abia', 1),
(1509, 'Aba South', 'Abia', 1),
(1510, 'Bende', 'Abia', 1),
(1511, 'Isiala Ngwa North', 'Abia', 1),
(1512, 'Ikwuano', 'Abia', 1),
(1513, 'Isiala Ngwa South', 'Abia', 1),
(1514, 'Isuikwuato', 'Abia', 1),
(1515, 'Obi Ngwa', 'Abia', 1),
(1516, 'Ohafia', 'Abia', 1),
(1517, 'Osisioma', 'Abia', 1),
(1518, 'Ugwunagbo', 'Abia', 1),
(1519, 'Ukwa East', 'Abia', 1),
(1520, 'Ukwa West', 'Abia', 1),
(1521, 'Umuahia North', 'Abia', 1),
(1522, 'Umuahia South', 'Abia', 1),
(1523, 'Umu Nneochi', 'Abia', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mailing_lists`
--

CREATE TABLE `mailing_lists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_cookie` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `mailing_lists`
--

INSERT INTO `mailing_lists` (`id`, `email`, `user_cookie`, `created_at`, `updated_at`) VALUES
(1, 'nnebuchiosigbo340@gmail.com', '4f2d2d80d438e1a7d56088ff99150be3b687ed45', '2021-01-21 16:44:20', '2021-01-21 16:44:20');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2020_09_07_173736_create_farms_table', 1),
(5, '2020_09_07_174144_create_products_table', 1),
(6, '2020_09_07_174249_create_product_photos_table', 1),
(7, '2020_09_07_174527_create_land_for_sales_table', 1),
(8, '2020_09_07_174548_create_land_for_sale_photos_table', 1),
(9, '2020_09_08_060010_create_farm_photos_table', 1),
(10, '2020_09_16_075701_add_purchase_date_to_land_for_sales_table', 1),
(11, '2020_09_27_055244_create_payments_table', 1),
(12, '2020_09_27_064241_add_manages_a_farm_to_users_table', 1),
(13, '2020_09_27_182029_add_description_to_farms_table', 1),
(14, '2020_09_27_183402_add_description_to_land_for_sale_table', 1),
(15, '2020_09_29_082821_add_wallet_id_to_users_table', 2),
(16, '2020_09_29_083745_add_wallet_balance_to_users_table', 2),
(17, '2020_10_08_045039_create_land_carts_table', 3),
(18, '2020_10_08_060241_add_acres_to_land_carts_table', 4),
(19, '2020_10_08_070204_create_my_lands_table', 5),
(20, '2020_10_08_075054_add_cover_to_my_lands_table', 6),
(21, '2020_10_08_075732_add_acres_to_land_for_sales_table', 7),
(24, '2020_10_12_120721_create_farm_cost_analyses_table', 8),
(28, '2020_10_14_091020_create_farm_managers_table', 9),
(29, '2020_10_14_112623_create_my_farm_setups_table', 9),
(30, '2020_10_14_114745_create_my_farm_investments_table', 9),
(31, '2020_10_14_130148_create_farm_set_ups_table', 9),
(32, '2020_10_15_134709_add_username_to_farm_managers_table', 10),
(33, '2020_10_18_122614_add_farmer_cost_to_farm_cost_analysis', 11),
(34, '2020_10_20_084508_add_farm_setup_details_to_my_farm_setups', 12);

-- --------------------------------------------------------

--
-- Table structure for table `milestones`
--

CREATE TABLE `milestones` (
  `id` int(11) NOT NULL,
  `farmtype` int(11) NOT NULL,
  `title` varchar(40) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `milestones`
--

INSERT INTO `milestones` (`id`, `farmtype`, `title`, `created_at`, `updated_at`) VALUES
(1, 7, 'Bush Clearing', '2020-12-31 08:18:13', '2020-12-31 08:28:30'),
(2, 7, 'Tiling', '2020-12-31 08:18:13', '2020-12-31 08:18:13'),
(4, 7, 'Weeding', '2020-12-31 08:18:14', '2020-12-31 08:18:14');

-- --------------------------------------------------------

--
-- Table structure for table `my_farm_investments`
--

CREATE TABLE `my_farm_investments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `farm_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `units` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `my_farm_investments`
--

INSERT INTO `my_farm_investments` (`id`, `user_id`, `farm_id`, `units`, `created_at`, `updated_at`) VALUES
(18, '2', '4', 2, '2021-01-07 08:24:07', '2021-01-07 08:24:07'),
(17, '2', '4', 2, '2021-01-07 08:23:29', '2021-01-07 08:23:29'),
(16, '2', '4', 2, '2021-01-07 08:13:34', '2021-01-07 08:13:34'),
(15, '2', '4', 2, '2021-01-07 08:10:50', '2021-01-07 08:10:50'),
(14, '2', '4', 2, '2021-01-06 09:08:07', '2021-01-06 09:08:07'),
(13, '17', '4', 2, '2020-12-20 14:04:11', '2020-12-20 14:04:11'),
(19, '2', '4', 3, '2021-01-07 08:38:34', '2021-01-07 08:38:34');

-- --------------------------------------------------------

--
-- Table structure for table `my_farm_setups`
--

CREATE TABLE `my_farm_setups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `land_id` int(20) NOT NULL DEFAULT 0,
  `owner_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `size` int(11) NOT NULL,
  `farm_type` int(11) NOT NULL,
  `total_farm_cost` decimal(10,2) NOT NULL,
  `status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_land_cost` decimal(20,2) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `my_farm_setups`
--

INSERT INTO `my_farm_setups` (`id`, `created_at`, `updated_at`, `land_id`, `owner_id`, `size`, `farm_type`, `total_farm_cost`, `status`, `total_land_cost`) VALUES
(19, '2020-12-20 13:35:26', '2020-12-20 13:35:55', 0, '18', 1, 7, '195000.00', 'paid', NULL),
(20, '2020-12-20 13:40:34', '2020-12-20 13:40:52', 6, '18', 1, 7, '195000.00', 'paid', '100000.00'),
(21, '2020-12-20 14:06:50', '2020-12-20 14:07:12', 6, '17', 1, 7, '195000.00', 'paid', '100000.00');

-- --------------------------------------------------------

--
-- Table structure for table `my_lands`
--

CREATE TABLE `my_lands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `land_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `size` decimal(10,2) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `landTitle` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `coverImage` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lga` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `town` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `my_lands`
--

INSERT INTO `my_lands` (`id`, `user_id`, `land_id`, `size`, `created_at`, `updated_at`, `landTitle`, `address`, `coverImage`, `price`, `state`, `lga`, `town`) VALUES
(18, '18', '6', '2.00', '2020-12-11 10:34:34', '2020-12-11 10:34:34', '10 ares of Land', '10 Farm Road, Ozuoba', 'gallery-7_1607680174.jpg', '1000000', '30', '15', 'Ozuoba'),
(17, '18', '6', '2.00', '2020-12-11 10:22:11', '2020-12-11 10:22:11', '10 ares of Land', '10 Farm Road, Ozuoba', 'gallery-7_1607680174.jpg', '1000000', '30', '15', 'Ozuoba');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `reference` varchar(40) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'pending',
  `amount` decimal(10,2) NOT NULL,
  `products` text NOT NULL,
  `shipping_address` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `reference`, `status`, `amount`, `products`, `shipping_address`, `created_at`, `updated_at`) VALUES
(12, 2, 'Ofy1607595986', 'paid', '18000.00', '[{\"product_id\":\"7\",\"price\":\"4000.00\",\"quantity\":\"3\",\"title\":\"Rubber of Ikwerre Garri\"},{\"product_id\":\"6\",\"price\":\"3000.00\",\"quantity\":\"2\",\"title\":\"Cabbage\"}]', 2, '2020-12-10 10:26:43', '2020-12-10 10:26:43'),
(13, 1, '2h31617582151', 'paid', '18000.00', '[{\"product_id\":\"8\",\"price\":\"6000.00\",\"quantity\":\"3\",\"title\":\"Black Turtle Neck\"}]', 3, '2021-04-05 00:22:46', '2021-04-05 00:22:46');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `title` varchar(30) NOT NULL,
  `description` text NOT NULL,
  `link` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `name`, `title`, `description`, `link`) VALUES
(1, 'farmsetup', 'Farm Setup', 'Start a farm from your mobile device and become a farm owner. Start your personal farm projects from your mobile device', 'start-farm'),
(2, 'partnership-farming', 'Partnership/Investment Farming', 'Invest in farm projects, make returns and empower smallholder farmers.\r\nInvest a small amount of money in farm projects and share the returns\r\n', 'farms'),
(3, 'farmland', 'Farm Land', 'Purchase or lease affordable farmlands in your preferred location across Nigeria. You can acquire fertile farmlands in few clicks and without stress. All farmlands are verified by our legal team before they are acquired to ensure you get the farmlands with the right documentations. ', 'lands');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('nnebuchiosigbo340@gmail.com', '$2y$10$KnYVyCg65COqhYr4E1IkAu0bLSCbB0H3ixXQS0iHXeEixqDzHhPKq', '2020-12-08 04:59:52');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reference` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` int(11) NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `user_id`, `reference`, `status`, `amount`, `description`, `created_at`, `updated_at`) VALUES
(1, '2', '', '', 6000, 'Funded my wallet', '2020-09-30 13:38:07', '2020-09-30 13:38:07'),
(2, '2', '', '', 6000, 'Funded my wallet', '2020-09-30 13:38:57', '2020-09-30 13:38:57'),
(3, '2', '', '', 5000, 'Upgraded his account', '2020-09-30 13:43:39', '2020-09-30 13:43:39'),
(4, '2', '', '', 899, 'Funded my wallet', '2020-10-01 19:59:13', '2020-10-01 19:59:13'),
(5, '2', '', '', 100000, 'Funded my wallet', '2020-10-04 23:04:55', '2020-10-04 23:04:55'),
(6, '2', '', '', 50000, 'Funded my wallet', '2020-10-05 00:31:55', '2020-10-05 00:31:55'),
(7, '2', '', '', 100000, 'Funded my wallet', '2020-10-05 03:53:06', '2020-10-05 03:53:06'),
(8, '3', '', '', 50000, 'Funded my wallet', '2020-10-06 20:57:07', '2020-10-06 20:57:07'),
(9, '3', '', '', 50000, 'Funded my wallet', '2020-10-07 04:45:15', '2020-10-07 04:45:15'),
(10, '3', '', '', 200000, 'Bought a land', '2020-10-07 07:50:48', '2020-10-07 07:50:48'),
(11, '3', '', '', 200000, 'Bought a land', '2020-10-08 06:15:11', '2020-10-08 06:15:11'),
(12, '3', '', '', 200000, 'Bought a land', '2020-10-08 06:51:46', '2020-10-08 06:51:46'),
(13, '3', '', '', 100000, 'Funded my wallet', '2020-10-15 19:53:13', '2020-10-15 19:53:13'),
(14, '3', '', '', 100000, 'Bought a land', '2020-10-20 07:00:48', '2020-10-20 07:00:48'),
(15, '3', '', '', 100000, 'Bought a land', '2020-10-20 07:01:27', '2020-10-20 07:01:27'),
(16, '3', '', '', 100000, 'Bought a land', '2020-10-20 07:04:29', '2020-10-20 07:04:29'),
(17, '3', '', '', 100000, 'Bought a land', '2020-10-20 07:11:24', '2020-10-20 07:11:24'),
(18, '3', '', '', 25200000, 'You set up a Poultry Farm', '2020-10-20 08:34:06', '2020-10-20 08:34:06'),
(19, '3', '', '', 25200000, 'You set up a Poultry Farm', '2020-10-20 08:34:34', '2020-10-20 08:34:34'),
(20, '3', '', '', 25200000, 'You set up a Poultry Farm', '2020-10-20 08:44:02', '2020-10-20 08:44:02'),
(21, '3', '', '', 25200000, 'You set up a Poultry Farm', '2020-10-20 08:45:22', '2020-10-20 08:45:22'),
(22, '2', '', '', 500000, 'Funded my wallet', '2020-10-23 08:27:36', '2020-10-23 08:27:36'),
(23, '2', '', '', 500000, 'Account Upgrade', '2020-11-11 14:39:47', '2020-11-11 14:39:47'),
(24, '2', '', '', 5000, 'Account Upgrade', '2020-11-11 14:41:44', '2020-11-11 14:41:44'),
(25, '2', '1605109901CRU', 'success', 5000, 'Account Upgrade', '2020-11-11 14:51:41', '2020-11-11 14:52:34'),
(26, '2', '1605244251k1Q', 'pending', 5000, 'Account Upgrade', '2020-11-13 04:10:51', '2020-11-13 04:10:51'),
(27, '2', '16052444267Qu', 'success', 5000, 'Account Upgrade', '2020-11-13 04:13:46', '2020-11-13 04:14:01'),
(28, '7', '1605462769LRU', 'pending', 5390000, 'Farm Setup', '2020-11-15 16:52:49', '2020-11-15 16:52:49'),
(29, '7', '1605462954Gje', 'pending', 5390000, 'Farm Setup', '2020-11-15 16:55:54', '2020-11-15 16:55:54'),
(30, '7', '1605463163N8q', 'success', 406667, 'Farm Setup', '2020-11-15 16:59:23', '2020-11-15 16:59:35'),
(31, '7', '1605470446cB1', 'pending', 406667, 'Farm Setup', '2020-11-15 19:00:46', '2020-11-15 19:00:46'),
(32, '7', '1605472000da9', 'success', 406667, 'Farm Setup', '2020-11-15 19:26:40', '2020-11-15 19:28:19'),
(33, '7', '1605536621Lvf', 'pending', -100000, 'Land Purchase', '2020-11-16 13:23:41', '2020-11-16 13:23:41'),
(34, '7', '9ngydw66lp', 'success', 400000, 'Wallet Funding', '2020-11-16 17:06:26', '2020-11-16 17:07:17'),
(35, '2', '1605854178MTT', 'success', 195000, 'Farm Setup', '2020-11-20 05:36:18', '2020-11-20 05:36:18'),
(36, '2', '16058550092IJ', 'success', 406667, 'Farm Setup', '2020-11-20 05:50:09', '2020-11-20 05:50:42'),
(37, '2', '1605903166YVT', 'pending', 200000, 'Land Purchase', '2020-11-20 19:12:46', '2020-11-20 19:12:46'),
(38, '2', '1605903581R9E', 'success', 200000, 'Land Purchase', '2020-11-20 19:19:41', '2020-11-20 19:20:44'),
(39, '2', '1606681853Xrv', 'pending', 195000, 'Farm Setup', '2020-11-29 19:30:53', '2020-11-29 19:30:53'),
(40, '2', '1606681886fQn', 'success', 195000, 'Farm Setup', '2020-11-29 19:31:26', '2020-11-29 19:31:57'),
(41, '2', '1606746358Ncc', 'pending', 1016667, 'Farm Setup', '2020-11-30 13:25:58', '2020-11-30 13:25:58'),
(42, '2', '16067481066VJ', 'pending', 203333, 'Farm Setup', '2020-11-30 13:55:06', '2020-11-30 13:55:06'),
(43, '2', 't7612qbwzy', 'success', 20000, 'Wallet Funding', '2020-12-01 02:01:52', '2020-12-01 02:02:09'),
(44, '2', 'v7cdm0xbok', 'success', 20000, 'Wallet Funding', '2020-12-01 02:04:21', '2020-12-01 02:04:31'),
(45, '6', '1606793118fls', 'pending', 12000000, 'Land Purchase', '2020-12-01 02:25:18', '2020-12-01 02:25:18'),
(46, '6', '1606795588H5n', 'pending', 4000000, 'Land Purchase', '2020-12-01 03:06:28', '2020-12-01 03:06:28'),
(47, '6', '1606807274RVR', 'pending', 800000, 'Land Purchase', '2020-12-01 06:21:14', '2020-12-01 06:21:14'),
(48, '2', '1606807470SMJ', 'pending', 800000, 'Land Purchase', '2020-12-01 06:24:30', '2020-12-01 06:24:30'),
(49, '2', '1606986806m5a', 'pending', 5000, 'Account Upgrade', '2020-12-03 08:13:26', '2020-12-03 08:13:26'),
(50, '2', '1606986868QM2', 'pending', 5000, 'Account Upgrade', '2020-12-03 08:14:28', '2020-12-03 08:14:28'),
(51, '2', '1606986890zg7', 'success', 5000, 'Account Upgrade', '2020-12-03 08:14:50', '2020-12-03 08:15:06'),
(52, '2', '4GV1607534733', 'pending', 6000, 'Store Purchase', '2020-12-09 16:35:46', '2020-12-09 16:35:46'),
(53, '2', '4GV1607534733', 'pending', 6000, 'Store Purchase', '2020-12-09 16:36:34', '2020-12-09 16:36:34'),
(54, '2', '4GV1607534733', 'pending', 6000, 'Store Purchase', '2020-12-09 16:36:43', '2020-12-09 16:36:43'),
(55, '2', '39H1607535445', 'success', 6000, 'Store Purchase', '2020-12-09 16:37:26', '2020-12-09 17:24:14'),
(56, '2', '39H1607535445', 'pending', 6000, 'Store Purchase', '2020-12-09 16:38:45', '2020-12-09 16:38:45'),
(57, '2', 'lop1607587909', 'pending', 17000, 'Store Purchase', '2020-12-10 07:11:49', '2020-12-10 07:11:49'),
(58, '2', 'YC81607588195', 'pending', 17000, 'Store Purchase', '2020-12-10 07:16:36', '2020-12-10 07:16:36'),
(59, '2', 'njH1607588723', 'pending', 17000, 'Store Purchase', '2020-12-10 07:25:24', '2020-12-10 07:25:24'),
(60, '2', 't031607588885', 'success', 17000, 'Store Purchase', '2020-12-10 07:28:06', '2020-12-10 07:35:58'),
(61, '2', 't031607588885', 'pending', 17000, 'Store Purchase', '2020-12-10 07:34:29', '2020-12-10 07:34:29'),
(62, '2', 't031607588885', 'pending', 17000, 'Store Purchase', '2020-12-10 07:35:11', '2020-12-10 07:35:11'),
(63, '2', 'qKC1607591895', 'success', 14000, 'Store Purchase', '2020-12-10 08:18:16', '2020-12-10 08:18:28'),
(64, '2', '8op1607594225', 'pending', 10000, 'Store Purchase', '2020-12-10 08:57:06', '2020-12-10 08:57:06'),
(65, '2', 'mPa1607594457', 'success', 10000, 'Store Purchase', '2020-12-10 09:01:06', '2020-12-10 09:01:18'),
(66, '2', 'mQZ1607595085', 'pending', 14000, 'Store Purchase', '2020-12-10 09:11:26', '2020-12-10 09:11:26'),
(67, '2', 'Ofy1607595986', 'success', 18000, 'Store Purchase', '2020-12-10 09:26:27', '2020-12-10 09:26:43'),
(68, '15', '1607669819Q4w', 'pending', 5000, 'Account Upgrade', '2020-12-11 05:56:59', '2020-12-11 05:56:59'),
(69, '15', '1607670517Xxn', 'success', 5000, 'Account Upgrade', '2020-12-11 06:08:37', '2020-12-11 06:09:07'),
(70, '16', '16076771417pF', 'pending', 5000, 'Account Upgrade', '2020-12-11 07:59:01', '2020-12-11 07:59:01'),
(71, '16', '1607677167ODF', 'success', 5000, 'Account Upgrade', '2020-12-11 07:59:27', '2020-12-11 07:59:39'),
(72, '17', '1607678018lOE', 'success', 5000, 'Account Upgrade', '2020-12-11 08:13:38', '2020-12-11 08:13:49'),
(73, '18', '1607678566QI8', 'pending', 10000000, 'Land Purchase', '2020-12-11 08:22:46', '2020-12-11 08:22:46'),
(74, '18', '1607678618xnq', 'pending', 200000, 'Land Purchase', '2020-12-11 08:23:38', '2020-12-11 08:23:38'),
(75, '18', '16076789146bv', 'pending', 2000000, 'Land Purchase', '2020-12-11 08:28:34', '2020-12-11 08:28:34'),
(76, '18', '1607679157xbE', 'pending', 2000000, 'Land Purchase', '2020-12-11 08:32:37', '2020-12-11 08:32:37'),
(77, '18', '16076793181Up', 'success', 200000, 'Land Purchase', '2020-12-11 08:35:18', '2020-12-11 08:37:44'),
(78, '18', '1607680570n7J', 'pending', 200000, 'Land Purchase', '2020-12-11 08:56:10', '2020-12-11 08:56:10'),
(79, '18', '1607680570RDZ', 'success', 200000, 'Land Purchase', '2020-12-11 08:56:10', '2020-12-11 09:08:10'),
(80, '18', '1608474788n5J', 'pending', 590000, 'Farm Setup', '2020-12-20 13:33:08', '2020-12-20 13:33:08'),
(81, '18', '160847494497j', 'success', 195000, 'Farm Setup', '2020-12-20 13:35:44', '2020-12-20 13:35:55'),
(82, '18', '1608475241K4U', 'success', 295000, 'Farm Setup', '2020-12-20 13:40:41', '2020-12-20 13:40:52'),
(83, '17', 'j1mlo6azwg', 'success', 6000, 'Wallet Funding', '2020-12-20 14:03:46', '2020-12-20 14:04:02'),
(84, '17', '1608476822w2H', 'success', 295000, 'Farm Setup', '2020-12-20 14:07:02', '2020-12-20 14:07:12'),
(85, '2', '1609925460CQs', 'pending', 800000, 'Wallet Funding', '2021-01-06 08:31:00', '2021-01-06 08:31:00'),
(86, '2', 'pl5cjamfk9', 'success', 300000, 'Wallet Funding', '2021-01-06 08:31:28', '2021-01-06 08:31:39'),
(87, '2', '1610012199lix', 'pending', 40000, 'Wallet Funding', '2021-01-07 08:36:39', '2021-01-07 08:36:39'),
(88, '2', 'z4gin8q2qd', 'success', 40000, 'Wallet Funding', '2021-01-07 08:37:09', '2021-01-07 08:38:17'),
(89, '2', '1611070725NGh', 'pending', 5000, 'Account Upgrade', '2021-01-19 14:38:45', '2021-01-19 14:38:45'),
(90, '2', '1611071850tC8', 'pending', 5000, 'Account Upgrade', '2021-01-19 14:57:30', '2021-01-19 14:57:30'),
(91, '2', '1611072549SiR', 'pending', 5000, 'Account Upgrade', '2021-01-19 15:09:09', '2021-01-19 15:09:09'),
(92, '2', '1611072588x9I', 'pending', 5000, 'Account Upgrade', '2021-01-19 15:09:48', '2021-01-19 15:09:48'),
(93, '2', '1611072689tbs', 'pending', 5000, 'Account Upgrade', '2021-01-19 15:11:29', '2021-01-19 15:11:29'),
(94, '1', 'D0G1617582149', 'pending', 18000, 'Store Purchase', '2021-04-04 23:22:30', '2021-04-04 23:22:30'),
(95, '1', '2h31617582151', 'success', 18000, 'Store Purchase', '2021-04-04 23:22:32', '2021-04-04 23:22:46');

-- --------------------------------------------------------

--
-- Table structure for table `popups`
--

CREATE TABLE `popups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `popups`
--

INSERT INTO `popups` (`id`, `title`, `message`, `status`, `created_at`, `updated_at`) VALUES
(1, 'I want you to cook 4 litres', 'ikdjjdjdjdjd dd jdjdjdjd djdjdjd djdjdjdldl djdjd djd\r\n dkdkkddkdkkkkkkkkkkkkkkkkkk dfkfkf \r\n fkfkfk ll;f fkk dkfkfkfkf fkf fkkkkkkkkk', 1, '2021-01-21 19:47:37', '2021-01-21 19:48:53');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `title` varchar(50) DEFAULT NULL,
  `size` varchar(20) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `color` varchar(30) DEFAULT NULL,
  `variety` varchar(50) DEFAULT NULL,
  `brand` varchar(20) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `discount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `category` varchar(60) DEFAULT NULL,
  `type` enum('0','1') DEFAULT NULL,
  `weight` decimal(10,4) DEFAULT NULL,
  `photo` varchar(250) DEFAULT NULL,
  `for_distributors` varchar(3) DEFAULT 'no',
  `description` text DEFAULT NULL,
  `slug` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `title`, `size`, `quantity`, `color`, `variety`, `brand`, `price`, `discount`, `category`, `type`, `weight`, `photo`, `for_distributors`, `description`, `slug`, `created_at`, `updated_at`) VALUES
(8, 'Black Turtle Neck', NULL, 1, NULL, NULL, NULL, '6000.00', '0.00', '3', NULL, '2.0000', 'php3269_1617581507.png', 'no', 'ice cube print , long length , lovely fit , with  lovely cut design at the back , not too exposing\r\n\r\nit can be pair up with heel for a dressed up outing , or dressed down for the office with a pair of blazer', 'Black Turtle Neck-0.99313200 1617581506', '2021-04-05 00:11:47', '2021-04-05 00:22:46'),
(9, 'Black Turtle Neck', NULL, 1, NULL, NULL, NULL, '6000.00', '0.00', '3', NULL, '2.0000', 'php3269_1617581507.png', 'no', 'ice cube print , long length , lovely fit , with  lovely cut design at the back , not too exposing\r\n\r\nit can be pair up with heel for a dressed up outing , or dressed down for the office with a pair of blazer', 'Black Turtle Neck-0.99313200 1617581506', '2021-04-05 00:11:47', '2021-04-05 00:22:46'),
(10, 'Black Turtle Neck', NULL, 1, NULL, NULL, NULL, '6000.00', '0.00', '3', NULL, '2.0000', 'php3269_1617581507.png', 'no', 'ice cube print , long length , lovely fit , with  lovely cut design at the back , not too exposing\r\n\r\nit can be pair up with heel for a dressed up outing , or dressed down for the office with a pair of blazer', 'Black Turtle Neck-0.99313200 1617581506', '2021-04-05 00:11:47', '2021-04-05 00:22:46'),
(11, 'Black Turtle Neck', NULL, 1, NULL, NULL, NULL, '6000.00', '0.00', '3', NULL, '2.0000', 'php3269_1617581507.png', 'no', 'ice cube print , long length , lovely fit , with  lovely cut design at the back , not too exposing\r\n\r\nit can be pair up with heel for a dressed up outing , or dressed down for the office with a pair of blazer', 'Black Turtle Neck-0.99313200 1617581506', '2021-04-05 00:11:47', '2021-04-05 00:22:46');

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

CREATE TABLE `product_categories` (
  `id` int(11) NOT NULL,
  `title` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_categories`
--

INSERT INTO `product_categories` (`id`, `title`) VALUES
(1, 'Tomato'),
(2, 'Meat'),
(3, 'Fish'),
(4, 'Leaves'),
(6, 'Oil'),
(7, 'Garri'),
(8, 'Wheats'),
(10, 'spices'),
(11, 'seafoods'),
(13, 'Tuber'),
(14, 'Vegetable'),
(15, 'Fruit'),
(16, 'Nuts'),
(18, 'Poultry'),
(19, 'Pepper'),
(20, 'Grains'),
(22, 'Bulbs'),
(23, 'Cereal'),
(24, 'Melon'),
(26, 'Legume'),
(27, 'Noodles'),
(28, 'Beverages'),
(29, 'Rice'),
(30, 'Salt'),
(31, 'Maggi'),
(32, 'Ofada Rice');

-- --------------------------------------------------------

--
-- Table structure for table `product_photos`
--

CREATE TABLE `product_photos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_photos`
--

INSERT INTO `product_photos` (`id`, `product_id`, `product_image`, `created_at`, `updated_at`) VALUES
(1, 1, 'phpD171_1607110397.png', '2020-12-04 14:02:52', '2020-12-04 18:33:17'),
(2, 1, 'phpF68B_1607094173.jpg', '2020-12-04 14:02:53', '2020-12-04 14:02:53'),
(3, 1, 'phpD1A1_1607110397.jpg', '2020-12-04 14:02:53', '2020-12-04 18:33:17'),
(4, 2, 'php2108_1607095494.jpg', '2020-12-04 14:24:54', '2020-12-04 14:24:54'),
(5, 2, 'php2167_1607095494.jpg', '2020-12-04 14:24:54', '2020-12-04 14:24:54'),
(6, 2, 'php21B6_1607095494.png', '2020-12-04 14:24:54', '2020-12-04 14:24:54'),
(7, 3, 'php79FB_1607111816.jpg', '2020-12-04 18:43:41', '2020-12-04 18:56:56'),
(8, 3, 'php585D_1607111021.png', '2020-12-04 18:43:41', '2020-12-04 18:43:41'),
(9, 3, 'php586D_1607111021.png', '2020-12-04 18:43:41', '2020-12-04 18:43:41'),
(10, 4, 'phpD38E_1607112167.png', '2020-12-04 19:02:47', '2020-12-04 19:02:47'),
(11, 4, 'phpD3BE_1607112167.png', '2020-12-04 19:02:47', '2020-12-04 19:02:47'),
(12, 4, 'phpD3CF_1607112167.png', '2020-12-04 19:02:47', '2020-12-04 19:02:47'),
(13, 5, 'phpBC02_1607114586.png', '2020-12-04 19:43:06', '2020-12-04 19:43:06'),
(14, 5, 'phpBC13_1607114586.png', '2020-12-04 19:43:06', '2020-12-04 19:43:06'),
(15, 6, 'php1AA0_1607341463.png', '2020-12-07 10:44:23', '2020-12-07 10:44:23'),
(16, 6, 'php1B3D_1607341463.png', '2020-12-07 10:44:23', '2020-12-07 10:44:23'),
(17, 6, 'php1B5E_1607341463.png', '2020-12-07 10:44:23', '2020-12-07 10:44:23'),
(18, 7, 'phpB1D9_1607587717.jpeg', '2020-12-10 07:08:37', '2020-12-10 07:08:37'),
(19, 7, 'phpB1DA_1607587717.jpg', '2020-12-10 07:08:37', '2020-12-10 07:08:37'),
(20, 8, 'php327A_1617581508.png', '2021-04-04 23:11:48', '2021-04-04 23:11:48'),
(21, 8, 'php32A9_1617581509.png', '2021-04-04 23:11:49', '2021-04-04 23:11:49');

-- --------------------------------------------------------

--
-- Table structure for table `referral_earnings`
--

CREATE TABLE `referral_earnings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `shippings`
--

CREATE TABLE `shippings` (
  `id` int(11) NOT NULL,
  `order_ref` varchar(50) NOT NULL,
  `payment_status` varchar(30) NOT NULL,
  `address` int(11) NOT NULL,
  `cost` decimal(10,2) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shippings`
--

INSERT INTO `shippings` (`id`, `order_ref`, `payment_status`, `address`, `cost`, `created_at`, `updated_at`) VALUES
(2, 'Ofy1607595986', 'paid', 2, '0.00', '2020-12-10 10:26:43', '2020-12-10 10:26:43'),
(3, '2h31617582151', 'paid', 3, '0.00', '2021-04-05 00:22:46', '2021-04-05 00:22:46');

-- --------------------------------------------------------

--
-- Table structure for table `site_settings`
--

CREATE TABLE `site_settings` (
  `id` int(11) NOT NULL,
  `paystack_key` text NOT NULL,
  `consultant_referral_bonus` decimal(10,2) NOT NULL,
  `consultant_signup_fee` decimal(10,2) NOT NULL,
  `referral_points` varchar(255) NOT NULL,
  `earning_count` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `site_settings`
--

INSERT INTO `site_settings` (`id`, `paystack_key`, `consultant_referral_bonus`, `consultant_signup_fee`, `referral_points`, `earning_count`, `created_at`, `updated_at`) VALUES
(1, 'sk_test_2a7ecb20756b0bdc06aab3cf50038b99d3b3e4d7', '2000.00', '5000.00', '20', '10', '2020-12-20 14:35:14', '2021-01-26 09:55:52');

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `capital` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_id` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `name`, `capital`, `country_id`, `created_at`, `updated_at`) VALUES
(1, 'Abia', 'Umuahia', 1, NULL, '2020-09-17 00:17:24'),
(2, 'Adamawa', 'Yola', 1, NULL, '2020-09-17 00:17:24'),
(3, 'Akwa Ibom', 'Uyo', 1, NULL, '2020-09-17 00:17:24'),
(4, 'Anambra', 'Awka', 1, NULL, '2020-09-17 00:17:24'),
(5, 'Bauchi', 'Bauchi', 1, NULL, '2020-09-17 00:17:24'),
(6, 'Benue', 'Makurdi', 1, NULL, '2020-09-17 00:17:24'),
(7, 'Borno', 'Maiduguri', 1, NULL, '2020-09-17 00:17:24'),
(8, 'Bayelsa', 'Yenagoa', 1, NULL, '2020-09-17 00:17:24'),
(9, 'Cross River', 'Calabar', 1, NULL, '2020-09-17 00:17:24'),
(10, 'Delta', 'Asaba', 1, NULL, '2020-09-17 00:17:24'),
(11, 'Ebonyi', 'Abakaliki', 1, NULL, '2020-09-17 00:17:24'),
(12, 'Edo', 'Benin', 1, NULL, '2020-09-17 00:17:24'),
(13, 'Ekiti', 'Ado-Ekiti', 1, NULL, '2020-09-17 00:17:24'),
(14, 'Enugu', 'Enugu', 1, NULL, '2020-09-17 00:17:24'),
(15, 'Federal Capital Terr', 'Abuja', 1, NULL, '2020-09-17 00:17:24'),
(16, 'Gombe', 'Gombe', 1, NULL, '2020-09-17 00:17:24'),
(17, 'Jigawa', 'Dutse', 1, NULL, '2020-09-17 00:17:24'),
(18, 'Imo', 'Owerri', 1, NULL, '2020-09-17 00:17:24'),
(19, 'Kaduna', 'Kaduna', 1, NULL, '2020-09-17 00:17:24'),
(20, 'Kebbi', 'Birnin Kebbi', 1, NULL, '2020-09-17 00:17:24'),
(21, 'Kano', 'Kano', 1, NULL, '2020-09-17 00:17:24'),
(22, 'Kogi', 'Lokoja', 1, NULL, '2020-09-17 00:17:24'),
(23, 'Lagos', 'Ikeja', 1, NULL, '2020-09-17 00:17:25'),
(24, 'Katsina', 'Katsina', 1, NULL, '2020-09-17 00:17:25'),
(25, 'Kwara', 'Ilorin', 1, NULL, '2020-09-17 00:17:25'),
(26, 'Nasarawa', 'Lafia', 1, NULL, '2020-09-17 00:17:25'),
(27, 'Niger', 'Minna', 1, NULL, '2020-09-17 00:17:25'),
(28, 'Ogun', 'Abeokuta', 1, NULL, '2020-09-17 00:17:25'),
(29, 'Ondo', 'Akure', 1, NULL, '2020-09-17 00:17:25'),
(30, 'Rivers', 'Port Harcourt', 1, NULL, '2020-09-17 00:17:25'),
(31, 'Oyo', 'Ibadan', 1, NULL, '2020-09-17 00:17:25'),
(32, 'Osun', 'Osogbo', 1, NULL, '2020-09-17 00:17:25'),
(33, 'Sokoto', 'Sokoto', 1, NULL, '2020-09-17 00:17:25'),
(34, 'Plateau', 'Jos', 1, NULL, '2020-09-17 00:17:25'),
(35, 'Taraba', 'Jalingo', 1, NULL, '2020-09-17 00:17:25'),
(36, 'Yobe', 'Damaturu', 1, NULL, '2020-09-17 00:17:25'),
(37, 'Zamfara', 'Gusau', 1, NULL, '2020-09-17 00:17:25');

-- --------------------------------------------------------

--
-- Table structure for table `testimonial`
--

CREATE TABLE `testimonial` (
  `id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `location` varchar(60) DEFAULT NULL,
  `content` text NOT NULL,
  `image` varchar(100) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `towns`
--

CREATE TABLE `towns` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `lga_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `towns`
--

INSERT INTO `towns` (`id`, `name`, `lga_id`) VALUES
(1, 'Alakahia', 15),
(2, 'Atali', 15),
(3, 'Awalama', 15),
(4, 'Choba', 15),
(5, 'Egbelu', 15),
(6, 'Elelenwo', 15),
(7, 'Eligbam', 15),
(8, 'Elimgbu', 15),
(9, 'Elioparanwo', 15),
(10, 'Eliozu', 15),
(11, 'Eneka', 15),
(12, 'Eligbolo', 15),
(13, 'Iriebe', 15),
(14, 'Mgbuesilaru', 15),
(15, 'Mgbuoba', 15),
(16, 'Mgbuosimini', 15),
(17, 'Mpakurche', 15),
(18, 'Nkpa', 15),
(19, 'Nkpelu', 15),
(20, 'Ogbogoro', 15),
(21, 'Oginigba', 15),
(22, 'Oro-igwe', 15),
(23, 'Oroazi', 15),
(24, 'Ozuoba', 15),
(25, 'Rukpokwu', 15),
(26, 'Rumuadaolu', 15),
(27, 'Rumuaghaolu', 15),
(28, 'Rumualogu', 15),
(29, 'Rumuchiorlu', 15),
(30, 'Rumudara', 15),
(31, 'Rumudogo', 15),
(32, 'Rumuekini', 15),
(33, 'Rumuekwe', 15),
(34, 'Rumuepirikom', 15),
(35, 'Rumuesara', 15),
(36, 'Rumuewhara', 15),
(37, 'Rumuibekwe', 15),
(38, 'Rumuigbo', 15),
(39, 'Rumukalagbor', 15),
(40, 'Rumunduru', 15),
(41, 'Rumuobiokani', 15),
(42, 'Rumuogba', 15),
(43, 'Rumuokparali', 15),
(44, 'Rumorukakolisi', 15),
(45, 'Rumuolumeni', 15),
(46, 'Rumuobochi', 15),
(47, 'Rumuodomaya', 15),
(48, 'Rumuoji', 15),
(49, 'Rumuokoro', 15),
(50, 'Rumuokwu', 15),
(51, 'Rumuokwachi', 15),
(52, 'Rumuokwuota', 15),
(53, 'Rumuola', 15),
(54, 'Rumuolukwu', 15),
(55, 'Rumuomasi', 15),
(56, 'Rumuomoi', 15),
(57, 'Rumuosi', 15),
(58, 'Rumuoto', 15),
(59, 'Rumurolu', 15),
(60, 'Rumuwaji', 15),
(61, 'Rumuwegwu', 15),
(62, 'Trans Amadi', 15),
(63, 'Woji', 15),
(64, 'Azuabie Town', 22),
(65, 'Abuloma', 22),
(66, 'Amadi ama', 22),
(67, 'Borokiri', 22),
(68, 'Dline', 22),
(69, 'Dioubu', 22),
(70, 'Eagle Island', 22),
(71, 'Elekahia', 22),
(72, 'New GRA', 22),
(73, 'Nkpogu', 22),
(74, 'Nkpolu Oroworukwo', 22),
(75, 'Ogbunabali', 22),
(76, 'Old GRA', 22),
(77, 'Old Port Harcourt Township', 22),
(78, 'Oroabali', 22),
(79, 'Oroada', 22),
(80, 'Orochiri', 22),
(81, 'Orogbum', 22),
(82, 'Orolozu', 22),
(83, 'Oromeruezimgbu', 22),
(84, 'Oroworukwo', 22),
(85, 'Oromineke', 22),
(86, 'Rebisi', 22),
(87, 'Rumuobiekwe', 22),
(88, 'Tere-Ama', 22),
(89, 'Okuru-Ama', 22);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `firstName` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastName` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lawyer` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'no',
  `realtor` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'no',
  `farm_manager` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'no',
  `marketer` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'no',
  `ref_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `isAdmin` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `parent` int(11) NOT NULL DEFAULT 0,
  `referral_code` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` int(11) DEFAULT NULL,
  `state` int(11) DEFAULT NULL,
  `lga` int(11) DEFAULT NULL,
  `town` int(11) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `managesFarm` tinyint(1) NOT NULL DEFAULT 0,
  `wallet_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `wallet_balance` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `static_wallet_balance` decimal(10,2) NOT NULL DEFAULT 0.00
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstName`, `lastName`, `username`, `phone`, `email`, `lawyer`, `realtor`, `farm_manager`, `marketer`, `ref_id`, `bank_name`, `isAdmin`, `parent`, `referral_code`, `account_name`, `account_number`, `country`, `state`, `lga`, `town`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `managesFarm`, `wallet_id`, `wallet_balance`, `static_wallet_balance`) VALUES
(1, 'Admin', 'Master', 'admin', '08121225275', 'admin@mail.com', 'yes', 'no', 'no', 'no', NULL, NULL, '1', 0, '1606068241jPHF', NULL, NULL, NULL, NULL, NULL, NULL, '2020-09-27 17:36:11', '$2y$10$8ot/qclLDRouvY1S9spECe0Q8mjNvahvpzHqBF0.LidM5zldsiRBy', 'Nv11JgngP9pdOYSXNzBw7JwC80vlRYzlV8jyECHrvkNOJq25UK8M98w7iTEZ', '2020-09-27 17:36:11', '2020-11-22 17:04:01', 0, 'farmaxx-HYR7HW9', '0', '0.00'),
(2, 'Nnesco', 'Buchi', 'nnesco', '08083549952', 'nnebuchiosigbo340@gmail.com', 'lawyer', 'realtor', 'no', 'no', NULL, '15', '0', 0, '1606068241lJwG', 'Buchi Nnesco', '44444322212', 1, 30, 15, NULL, '2020-09-28 17:35:55', '$2y$10$q5eqUncnG1lIjiVgutQ/E.FqFIAo696ne9Jk9qX/CnH.9kPVsr7tW', 'vaRNJJq6a4w5wJ07odczO8axvhA99gwe4SJuzi4IJVvh9wGSowlJ7xG4OXGK', '2020-09-28 17:32:27', '2021-01-07 08:38:34', 0, 'farmaax-RH9JJW', '10000', '0.00'),
(17, 'User', 'Three', 'user3', '070644438383', 'user3@gmail.com', 'lawyer', 'no', 'no', 'marketer', NULL, '4', '0', 16, '1607677513famO', 'User Three', '8788878787', 1, 30, 16, NULL, '2020-12-10 09:06:13', '$2y$10$PKAtpjCuFPxBjAGQwgAH2OTWdIsqv0XE/T0.c3jWQMaxCj7TdRPH6', 'tyxmwTxWXNAOlq20pfbs7AiCGAbTyYs5Etgvrb4SiKTpMJC4ObamIklvx8Dx', '2020-12-11 08:05:13', '2020-12-20 14:04:11', 0, 'farmaax-QefISTnB', '750', '5900.00'),
(18, 'User', 'Four', 'user4', '080899984848', 'user4@gmail.com', 'no', 'no', 'no', 'no', NULL, '15', '0', 17, '1607678109Ndx7', 'User four', '9998887765', 1, 30, 14, NULL, '2020-12-11 09:16:02', '$2y$10$j.ltnwhTHYfOHn334jxjqeI9YNEiAJoydyCTca863nghJT8dcmLKq', 'M2U3bJ3DZVDvh4rSoU7TUIcYtFql1MZcQFtbrPKAdI8Wj2ca9PYYuAAiPiLy', '2020-12-11 08:15:09', '2020-12-20 13:56:59', 0, 'farmaax-Bcg7JfjS', '0', '0.00'),
(16, 'User', 'Two', 'user2', '090983377377', 'user2@gmail.com', 'no', 'realtor', 'no', 'marketer', NULL, '18', '0', 15, '1607670629oWsj', 'User Two', '7404040400', 1, 2, 36, NULL, '2020-12-02 07:11:41', '$2y$10$FPagWaG9zxJ3qCg/zODZJu52vhs4uJ0wGiZlxtfVhvqIhQCjKU0QC', 'cLosZGaaE1ZdQgIVfAWVJTf0FMz3ZTyXhzkf7yPpewoChDtEpEdNaPfMEyfJ', '2020-12-11 06:10:29', '2020-12-20 14:18:24', 0, 'farmaax-2JhDbiPG', '64900', '23600.00'),
(15, 'User', 'One', 'user1', '09098837373', 'user1@gmail.com', 'lawyer', 'realtor', 'no', 'no', NULL, '17', '0', 0, '1607669604dfWW', 'User One', '8847748884', 1, 30, 12, NULL, '2020-12-01 06:53:54', '$2y$10$9zKvvy2HFgQ9gPtqlkRqrOvdLzOuwkdZwF2S7t2S09wnDgA2nQW0u', 'yvuKDAeCQriHtU7nEwIAoCSyudvHI8f76PH3k6jvFacBL6s596ZMo6LYZaYI', '2020-12-11 05:53:24', '2020-12-20 14:18:24', 0, 'farmaax-5Q8D4wKo', '26550', '0.00'),
(19, 'soso', 'jsjsj', 'sioo', '090988777899', 'nnebuchioosigbo100@gmail.com', 'no', 'no', 'no', 'no', NULL, NULL, '0', 0, '1611068534yEG8', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$bpqluuRECVBB2Utp60InRuwkNAiOokpSUmK1NfYEWScOheMP6xfXq', NULL, '2021-01-19 14:02:14', '2021-01-19 14:02:14', 0, 'farmaax-vxMlJICp', '0', '0.00'),
(20, 'Tammy', 'Abraham', 'tammy', '09098887766', 'tammy@gmail.com', 'no', 'no', 'no', 'no', NULL, NULL, '0', 2, '1611338263VB9o', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$tCwLPuE7aaVAtEJV0Qf3j.rUwqMsK5iU28q80NrqOiwTobtlhrr0W', NULL, '2021-01-22 16:57:43', '2021-01-22 16:57:43', 0, 'farmaax-3ClJ3wYK', '0', '0.00');

-- --------------------------------------------------------

--
-- Table structure for table `visit_counts`
--

CREATE TABLE `visit_counts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `visit_counts` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `visit_counts`
--

INSERT INTO `visit_counts` (`id`, `user_id`, `visit_counts`, `created_at`, `updated_at`) VALUES
(2, '2', 1, '2021-01-22 16:57:42', '2021-01-22 16:57:42');

-- --------------------------------------------------------

--
-- Table structure for table `wallet_change`
--

CREATE TABLE `wallet_change` (
  `id` int(11) NOT NULL,
  `type` enum('credit','debit') NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `statement` varchar(50) NOT NULL,
  `wallet_owner` int(20) NOT NULL,
  `status` enum('pending','success') NOT NULL DEFAULT 'pending',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banks`
--
ALTER TABLE `banks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `consultant_settings`
--
ALTER TABLE `consultant_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `earnings`
--
ALTER TABLE `earnings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `farmers_cost`
--
ALTER TABLE `farmers_cost`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `farms`
--
ALTER TABLE `farms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `farm_cost_analyses`
--
ALTER TABLE `farm_cost_analyses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `farm_managers`
--
ALTER TABLE `farm_managers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `farm_photos`
--
ALTER TABLE `farm_photos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `farm_set_ups`
--
ALTER TABLE `farm_set_ups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `investments`
--
ALTER TABLE `investments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `investment_cart`
--
ALTER TABLE `investment_cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `land_carts`
--
ALTER TABLE `land_carts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `land_for_sales`
--
ALTER TABLE `land_for_sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `land_for_sale_photos`
--
ALTER TABLE `land_for_sale_photos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lgas`
--
ALTER TABLE `lgas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mailing_lists`
--
ALTER TABLE `mailing_lists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `milestones`
--
ALTER TABLE `milestones`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `my_farm_investments`
--
ALTER TABLE `my_farm_investments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `my_farm_setups`
--
ALTER TABLE `my_farm_setups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `my_lands`
--
ALTER TABLE `my_lands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `popups`
--
ALTER TABLE `popups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_categories`
--
ALTER TABLE `product_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_photos`
--
ALTER TABLE `product_photos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `referral_earnings`
--
ALTER TABLE `referral_earnings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shippings`
--
ALTER TABLE `shippings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `site_settings`
--
ALTER TABLE `site_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimonial`
--
ALTER TABLE `testimonial`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `towns`
--
ALTER TABLE `towns`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `visit_counts`
--
ALTER TABLE `visit_counts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wallet_change`
--
ALTER TABLE `wallet_change`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `banks`
--
ALTER TABLE `banks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `consultant_settings`
--
ALTER TABLE `consultant_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `earnings`
--
ALTER TABLE `earnings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `farmers_cost`
--
ALTER TABLE `farmers_cost`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `farms`
--
ALTER TABLE `farms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `farm_cost_analyses`
--
ALTER TABLE `farm_cost_analyses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `farm_managers`
--
ALTER TABLE `farm_managers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `farm_photos`
--
ALTER TABLE `farm_photos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `farm_set_ups`
--
ALTER TABLE `farm_set_ups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `investments`
--
ALTER TABLE `investments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `investment_cart`
--
ALTER TABLE `investment_cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `land_carts`
--
ALTER TABLE `land_carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `land_for_sales`
--
ALTER TABLE `land_for_sales`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `land_for_sale_photos`
--
ALTER TABLE `land_for_sale_photos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `lgas`
--
ALTER TABLE `lgas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1524;

--
-- AUTO_INCREMENT for table `mailing_lists`
--
ALTER TABLE `mailing_lists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `milestones`
--
ALTER TABLE `milestones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `my_farm_investments`
--
ALTER TABLE `my_farm_investments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `my_farm_setups`
--
ALTER TABLE `my_farm_setups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `my_lands`
--
ALTER TABLE `my_lands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT for table `popups`
--
ALTER TABLE `popups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `product_categories`
--
ALTER TABLE `product_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `product_photos`
--
ALTER TABLE `product_photos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `referral_earnings`
--
ALTER TABLE `referral_earnings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shippings`
--
ALTER TABLE `shippings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `site_settings`
--
ALTER TABLE `site_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `testimonial`
--
ALTER TABLE `testimonial`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `towns`
--
ALTER TABLE `towns`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `visit_counts`
--
ALTER TABLE `visit_counts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `wallet_change`
--
ALTER TABLE `wallet_change`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
