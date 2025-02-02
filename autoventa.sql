-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 20, 2025 at 03:59 AM
-- Server version: 8.3.0
-- PHP Version: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `autoventa`
--

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

DROP TABLE IF EXISTS `cars`;
CREATE TABLE IF NOT EXISTS `cars` (
  `id` int NOT NULL AUTO_INCREMENT,
  `make` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `year` int NOT NULL,
  `type` enum('SUV','SEDAN','Coupe') NOT NULL,
  `transmission` enum('Automatic','Manual') NOT NULL,
  `fuel_type` enum('Diesel','Petrol','Hybrid','Electric') NOT NULL,
  `mileage` int NOT NULL,
  `fuel_efficiency` float NOT NULL,
  `engine_size` float NOT NULL,
  `horsepower` int NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `vin` varchar(17) NOT NULL,
  `availability_status` enum('Sold','Available','Coming','Reserved') NOT NULL,
  `seat_capacity` int NOT NULL,
  `drive_type` enum('FWD','RWD','AWD','4WD') NOT NULL,
  `car_condition` enum('New','Used','Certified') NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `vin` (`vin`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`id`, `make`, `model`, `year`, `type`, `transmission`, `fuel_type`, `mileage`, `fuel_efficiency`, `engine_size`, `horsepower`, `price`, `vin`, `availability_status`, `seat_capacity`, `drive_type`, `car_condition`, `created_at`, `updated_at`) VALUES
(1, 'Toyota', 'Corolla', 2022, 'SEDAN', 'Automatic', 'Petrol', 15000, 6.5, 1.8, 139, 20000.00, '1NXBR12E2YZ123456', 'Available', 5, 'FWD', 'New', '2025-01-20 02:35:26', '2025-01-20 02:35:26'),
(2, 'Honda', 'Pilot', 2016, 'SUV', 'Automatic', 'Petrol', 150000, 9, 3, 180, 30000.00, '1vhsjau12721hsah', 'Available', 6, '4WD', 'Certified', '2025-01-20 07:58:42', '2025-01-20 07:58:42'),
(3, 'Mercedes', 'C-class', 2015, 'SEDAN', 'Automatic', 'Diesel', 130000, 9.6, 2.8, 200, 20000.00, '1vhsjau12721asda', 'Available', 5, 'RWD', 'New', '2025-01-20 08:51:07', '2025-01-20 08:51:07'),
(4, 'Mercedes', 'C-class', 2015, 'SEDAN', 'Automatic', 'Diesel', 130000, 9.6, 2.8, 200, 20000.00, '1vhsjau127aaaa', 'Available', 5, 'RWD', 'New', '2025-01-20 08:53:32', '2025-01-20 08:53:32');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

DROP TABLE IF EXISTS `images`;
CREATE TABLE IF NOT EXISTS `images` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `car_id` bigint UNSIGNED NOT NULL,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_main` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `images_car_id_foreign` (`car_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `car_id`, `image_path`, `is_main`, `created_at`, `updated_at`) VALUES
(1, 4, 'cars/main_images/VsVM2DKufXFDLDxUqv39lvvydmLbRNeYu91sli0w.jpg', 1, '2025-01-20 08:53:32', '2025-01-20 08:53:32'),
(2, 4, 'cars/additional_images/WDt8DFZKfGsO73Xh6Ed75jwGvVxw5e9LdwkNYBti.jpg', 0, '2025-01-20 08:53:32', '2025-01-20 08:53:32');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2025_01_20_033611_create_images_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `email` varchar(191) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `surname`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Mihail', 'sidorenco', 'mihail.sidorenco@gmail.com', '$2y$10$eHlDXN3Ox58TuDsyxV62Z.n/Dy5jU5FYzCdLzUEXboGx9/muo3X.S', '2025-01-11 00:35:53', '2025-01-11 00:35:53'),
(2, 'Mihail', 'sidorenco', 'mihail@gmail.com', '$2y$12$MRWDKGcRYU90QNB28yOR1OipwBAWqsJpNJz098LWHfXiLDJT7qhB2', '2025-01-11 05:36:51', '2025-01-11 05:36:51'),
(3, 'Cebanu', 'Dionis', 'dioniska@gmail.com', '$2y$12$FgDZ2ApyJ8txWufdyWw9ruAP1vosEVGxp0TzEAtzNmi4ZTvjUA4pS', '2025-01-11 07:34:54', '2025-01-11 07:34:54');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
