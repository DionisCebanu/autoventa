-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 07, 2025 at 08:32 PM
-- Server version: 10.11.10-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u798886467_autoventa`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `car_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `date` date NOT NULL,
  `start_time` time NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `car_id`, `name`, `email`, `phone`, `date`, `start_time`, `created_at`, `updated_at`) VALUES
(1, 5, 'Alexei', 'alexei@gmail.com', '1221221122121', '2025-04-08', '16:00:00', '2025-04-04 18:51:04', '2025-04-04 18:51:04'),
(2, 5, 'Dionis', 'dionis@gmail.com', '251 216 2161', '2025-04-08', '16:30:00', '2025-04-04 19:24:44', '2025-04-04 19:24:44'),
(3, 5, 'Dionis', 'dionis@gmail.com', '4385272091', '2025-04-17', '17:00:00', '2025-04-04 20:12:50', '2025-04-04 20:12:50'),
(4, 1, 'Dioniska', 'dionis.cebanu003@gmail.com', '16281821811', '2025-04-21', '13:30:00', '2025-04-06 21:45:24', '2025-04-06 21:45:24'),
(5, 5, 'Dioniskulicika', 'luxurycarbookingg@gmail.com', '4315112111', '2025-04-16', '14:30:00', '2025-04-06 22:16:58', '2025-04-06 22:16:58'),
(6, 5, 'Daniska', 'luxurycarbookingg@gmail.com', '12612712812', '2025-04-15', '13:30:00', '2025-04-06 22:20:52', '2025-04-06 22:20:52'),
(7, 5, 'Daniska', 'luxurycarbookingg@gmail.com', '1211221122112', '2025-04-15', '16:00:00', '2025-04-06 22:25:02', '2025-04-06 22:25:02'),
(8, 1, 'Dionis', 'dionis.cebanu003@gmail.com', '4385272111', '2025-04-15', '14:00:00', '2025-04-06 22:51:59', '2025-04-06 22:51:59'),
(9, 1, 'Hui Bumajnii', 'hui.bumajnii.tocika.com@gmail.com', '2864648464', '2025-04-09', '20:00:00', '2025-04-06 22:54:48', '2025-04-06 22:54:48'),
(10, 1, 'Hui Bumajnii', 'hui.bumajnii.tocika.com@gmail.com', '2864648464', '2025-04-09', '20:00:00', '2025-04-06 22:54:48', '2025-04-06 22:54:48'),
(11, 1, 'Hui Bumajnii', 'hui.bumajnii.tocika.com@gmail.com', '2864648464', '2025-04-09', '20:00:00', '2025-04-06 22:54:48', '2025-04-06 22:54:48'),
(12, 1, 'Hui Bumajnii', 'hui.bumajnii.tocika.com@gmail.com', '2864648464', '2025-04-09', '20:00:00', '2025-04-06 22:54:49', '2025-04-06 22:54:49'),
(13, 1, 'Hui Bumajnii', 'hui.bumajnii.tocika.com@gmail.com', '2864648464', '2025-04-09', '20:00:00', '2025-04-06 22:54:49', '2025-04-06 22:54:49'),
(14, 1, 'Hui Bumajnii', 'hui.bumajnii.tocika.com@gmail.com', '2864648464', '2025-04-09', '20:00:00', '2025-04-06 22:54:49', '2025-04-06 22:54:49'),
(15, 1, 'Hui Bumajnii', 'hui.bumajnii.tocika.com@gmail.com', '2864648464', '2025-04-09', '20:00:00', '2025-04-06 22:54:49', '2025-04-06 22:54:49'),
(16, 1, 'Grecu Vasile', 'jwsjack3@gmail.com', '4895632147', '2025-04-15', '10:30:00', '2025-04-07 01:11:36', '2025-04-07 01:11:36');

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `id` int(10) UNSIGNED NOT NULL,
  `make` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `year` int(11) NOT NULL,
  `type` enum('SUV','SEDAN','Coupe') NOT NULL,
  `transmission` enum('Automatic','Manual') NOT NULL,
  `fuel_type` enum('Diesel','Petrol','Hybrid','Electric') NOT NULL,
  `mileage` int(11) NOT NULL,
  `fuel_efficiency` float NOT NULL,
  `engine_size` float NOT NULL,
  `horsepower` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `vin` varchar(17) NOT NULL,
  `availability_status` enum('Sold','Available','Coming','Reserved') NOT NULL,
  `seat_capacity` int(11) NOT NULL,
  `drive_type` enum('FWD','RWD','AWD','4WD') NOT NULL,
  `car_condition` enum('New','Used','Certified') NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`id`, `make`, `model`, `year`, `type`, `transmission`, `fuel_type`, `mileage`, `fuel_efficiency`, `engine_size`, `horsepower`, `price`, `vin`, `availability_status`, `seat_capacity`, `drive_type`, `car_condition`, `created_at`, `updated_at`) VALUES
(1, 'BMW', 'M5', 2021, 'SEDAN', 'Automatic', 'Diesel', 100000, 10.2, 3.2, 270, 35000.00, '1vhsjau127okkk', 'Available', 5, 'RWD', 'Certified', '2025-02-08 22:58:35', '2025-04-01 18:00:50'),
(2, 'Mercedes', 'AMG', 2023, 'Coupe', 'Automatic', 'Diesel', 120000, 10.2, 3.2, 270, 180000.00, '1vhsjau127okko', 'Sold', 5, 'RWD', 'Certified', '2025-02-08 22:58:35', '2025-04-02 00:04:14'),
(4, 'Audi', 'A4', 2022, 'SEDAN', 'Automatic', 'Diesel', 200000, 10.2, 3.2, 270, 26000.00, '1vhsjau127okkl', 'Sold', 5, 'RWD', 'Certified', '2025-02-08 22:58:35', '2025-04-02 00:00:49'),
(5, 'Mercedes', 'A3', 2020, 'SEDAN', 'Automatic', 'Diesel', 45000, 9.6, 2.6, 160, 32000.00, '1vhsjau12721hsam', 'Available', 5, 'FWD', 'Certified', '2025-04-01 04:37:30', '2025-04-01 18:01:02'),
(6, 'Audi', 'RS6', 2018, 'SEDAN', 'Automatic', 'Petrol', 100000, 9.5, 3.4, 400, 30000.00, '1vhsjau12721asg7', 'Available', 5, 'RWD', 'Certified', '2025-04-07 19:49:02', '2025-04-07 19:49:02'),
(7, 'Audi', 'A4', 2019, 'SEDAN', 'Automatic', 'Diesel', 80000, 9.5, 3, 200, 24999.00, '1vhsjau12721asgi', 'Available', 5, 'AWD', 'Certified', '2025-04-07 19:59:17', '2025-04-07 20:01:29'),
(8, 'BMW', 'M3', 2016, 'SEDAN', 'Automatic', 'Diesel', 120000, 9.6, 3.2, 280, 14000.00, '1vhsjau12721asgf', 'Available', 5, 'RWD', 'Used', '2025-04-07 20:15:26', '2025-04-07 20:16:45'),
(9, 'Mercedes', 'C-Class', 2018, 'SEDAN', 'Automatic', 'Petrol', 90000, 9, 2.8, 250, 19999.00, '1vhsjau12721asgm', 'Available', 5, 'RWD', 'Certified', '2025-04-07 20:21:12', '2025-04-07 20:21:12');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(10) UNSIGNED NOT NULL,
  `car_id` bigint(20) UNSIGNED NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `is_main` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `car_id`, `image_path`, `is_main`, `created_at`, `updated_at`) VALUES
(1, 1, 'https://drive.google.com/thumbnail?id=1i-epDMSxiu6ir1ZxQJa8N7iNtumJ0sQq&sz=w1000', 1, '2025-02-08 22:58:35', '2025-02-08 22:58:35'),
(6, 1, 'https://drive.google.com/thumbnail?id=16cf4DtKsJ_Me7r2XBlZttqw0hCIXvCpP&sz=w1000', 0, '2025-02-08 22:58:58', '2025-02-08 22:58:58'),
(7, 1, 'https://drive.google.com/thumbnail?id=1sZ51IfqfHTd1KbGAlJx_i-gAZLreKwwK&sz=w1000', 0, '2025-02-08 22:58:58', '2025-02-08 22:58:58'),
(8, 1, 'https://drive.google.com/thumbnail?id=1lFCOVUjkNs5A5NmsTI3uWX0sG1zO-bAR&sz=w1000', 0, '2025-02-08 22:58:58', '2025-02-08 22:58:58'),
(9, 1, 'https://drive.google.com/thumbnail?id=1KahqTIHelKq8aSBRRfzq98Z83FUyaNF_&sz=w1000', 0, '2025-02-08 22:58:58', '2025-02-08 22:58:58'),
(10, 5, 'https://drive.google.com/thumbnail?id=1qYQ9QQAdGp7R_vBOzwnzXJJRsgM6DsVB&sz=w1000', 1, '2025-04-01 04:37:30', '2025-04-01 04:37:30'),
(15, 5, 'https://drive.google.com/thumbnail?id=10ApX-bWeUc-9MCsU7hVjSJS2_q0O9Qkm&sz=w1000', 0, '2025-04-01 04:39:12', '2025-04-01 04:39:12'),
(16, 5, 'https://drive.google.com/thumbnail?id=1h85WxnSSiFOi_SN-j4EtotxJiLhsWFJc&sz=w1000', 0, '2025-04-01 04:39:12', '2025-04-01 04:39:12'),
(17, 5, 'https://drive.google.com/thumbnail?id=1lhpN4Mwp-qpf_w8SPNR38sWBfT31h4x6&sz=w1000', 0, '2025-04-01 04:39:12', '2025-04-01 04:39:12'),
(18, 5, 'https://drive.google.com/thumbnail?id=1T3jaPRyOYkQSM21haKsnAJFfO_JQyaCM&sz=w1000', 0, '2025-04-01 04:39:12', '2025-04-01 04:39:12'),
(19, 4, 'https://drive.google.com/thumbnail?id=1KhVGY0KhrB-WJJZtFmMqw4sDFKYwI0cH&sz=w1000', 1, '2025-04-02 00:00:49', '2025-04-02 00:00:49'),
(20, 4, 'https://drive.google.com/thumbnail?id=1KhVGY0KhrB-WJJZtFmMqw4sDFKYwI0cH&sz=w1000', 0, '2025-04-02 00:00:49', '2025-04-02 00:00:49'),
(21, 4, 'https://drive.google.com/thumbnail?id=1KhVGY0KhrB-WJJZtFmMqw4sDFKYwI0cH&sz=w1000', 0, '2025-04-02 00:00:49', '2025-04-02 00:00:49'),
(22, 4, 'https://drive.google.com/thumbnail?id=1KhVGY0KhrB-WJJZtFmMqw4sDFKYwI0cH&sz=w1000', 0, '2025-04-02 00:00:49', '2025-04-02 00:00:49'),
(23, 4, 'https://drive.google.com/thumbnail?id=1KhVGY0KhrB-WJJZtFmMqw4sDFKYwI0cH&sz=w1000', 0, '2025-04-02 00:00:49', '2025-04-02 00:00:49'),
(24, 2, 'https://drive.google.com/thumbnail?id=1Zw7lavCCAzrwl2feCy2GtEAO830Ae65J&sz=w1000', 1, '2025-04-02 00:04:14', '2025-04-01 20:09:59'),
(33, 2, 'https://drive.google.com/thumbnail?id=1Zw7lavCCAzrwl2feCy2GtEAO830Ae65J&sz=w1000', 0, '2025-04-01 20:09:59', '2025-04-01 20:09:59'),
(34, 2, 'https://drive.google.com/thumbnail?id=1Zw7lavCCAzrwl2feCy2GtEAO830Ae65J&sz=w1000', 0, '2025-04-01 20:09:59', '2025-04-01 20:09:59'),
(35, 2, 'https://drive.google.com/thumbnail?id=1Zw7lavCCAzrwl2feCy2GtEAO830Ae65J&sz=w1000', 0, '2025-04-01 20:09:59', '2025-04-01 20:09:59'),
(36, 2, 'https://drive.google.com/thumbnail?id=1Zw7lavCCAzrwl2feCy2GtEAO830Ae65J&sz=w1000', 0, '2025-04-01 20:09:59', '2025-04-01 20:09:59'),
(37, 6, 'https://drive.google.com/thumbnail?id=1KhVGY0KhrB-WJJZtFmMqw4sDFKYwI0cH&sz=w1000', 1, '2025-04-07 19:49:02', '2025-04-07 19:49:02'),
(38, 6, 'https://drive.google.com/thumbnail?id=1M-W0HvgVtgebKsGZAAjBAFUIDnPtgcdv&sz=w1000', 0, '2025-04-07 19:49:02', '2025-04-07 19:49:02'),
(39, 6, 'https://drive.google.com/thumbnail?id=17g8wGviVD1urKOEPFo6NWQCjHQixCbCW&sz=w1000', 0, '2025-04-07 19:49:02', '2025-04-07 19:49:02'),
(40, 6, 'https://drive.google.com/thumbnail?id=1633g1OIjI2HVsneMAaj1EpPTFD2EMspU&sz=w1000', 0, '2025-04-07 19:49:02', '2025-04-07 19:49:02'),
(41, 6, 'https://drive.google.com/thumbnail?id=1ZW91JuVpGOyNHaW0roosH2q3zLCPHhBW&sz=w1000', 0, '2025-04-07 19:49:02', '2025-04-07 19:49:02'),
(42, 7, 'https://drive.google.com/thumbnail?id=1aYuqQKV7o3Oi3ZZtwhxIKogEL8uJEgCf&sz=w1000', 1, '2025-04-07 19:59:17', '2025-04-07 20:00:23'),
(47, 7, 'https://drive.google.com/thumbnail?id=1uCXyY2BLTDAohi8O0CGB7LCV75VH0u8h&sz=w1000', 0, '2025-04-07 20:00:23', '2025-04-07 20:00:23'),
(48, 7, 'https://drive.google.com/thumbnail?id=1bA0Ae9kUIA6ve9-fCIei8UPdOkQLZRve&sz=w1000', 0, '2025-04-07 20:00:23', '2025-04-07 20:00:23'),
(49, 7, 'https://drive.google.com/thumbnail?id=1kIkcI3__YnBtwadsuah899kRSbGMKdZU&sz=w1000', 0, '2025-04-07 20:00:23', '2025-04-07 20:00:23'),
(50, 7, 'https://drive.google.com/thumbnail?id=1CJYGBcBcEvdB8kO_bFW8WizaZFlUmILZ&sz=w1000', 0, '2025-04-07 20:00:23', '2025-04-07 20:00:23'),
(51, 8, 'https://drive.google.com/thumbnail?id=1fd9d5F5idVxXXUAl8_8Hsl2DIdYXkYgA&sz=w1000', 1, '2025-04-07 20:15:26', '2025-04-07 20:16:45'),
(56, 8, 'https://drive.google.com/thumbnail?id=1cQYjdR6pDfT3f_heoV3ZUW_gk-LCSHhK&sz=w1000', 0, '2025-04-07 20:16:45', '2025-04-07 20:16:45'),
(57, 8, 'https://drive.google.com/thumbnail?id=1lxCVJSjK2FppWkS3BfnTSTvdfi2PHfkS&sz=w1000', 0, '2025-04-07 20:16:45', '2025-04-07 20:16:45'),
(58, 8, 'https://drive.google.com/thumbnail?id=16cf4DtKsJ_Me7r2XBlZttqw0hCIXvCpP&sz=w1000', 0, '2025-04-07 20:16:45', '2025-04-07 20:16:45'),
(59, 8, 'https://drive.google.com/thumbnail?id=1YkhsWvzChuLqx1l6RLxuaPIy-NO6bKe5&sz=w1000', 0, '2025-04-07 20:16:45', '2025-04-07 20:16:45'),
(60, 9, 'https://drive.google.com/thumbnail?id=1MLiWF5H-_mLiQPq37rYCbCvYTHOq7mC2&sz=w1000', 1, '2025-04-07 20:21:12', '2025-04-07 20:21:12'),
(61, 9, 'https://drive.google.com/thumbnail?id=1h85WxnSSiFOi_SN-j4EtotxJiLhsWFJc&sz=w1000', 0, '2025-04-07 20:21:12', '2025-04-07 20:21:12'),
(62, 9, 'https://drive.google.com/thumbnail?id=1T3jaPRyOYkQSM21haKsnAJFfO_JQyaCM&sz=w1000', 0, '2025-04-07 20:21:12', '2025-04-07 20:21:12'),
(63, 9, 'https://drive.google.com/thumbnail?id=1h2iKC6a0aAC3Cub1gV80R36GQPBAcTFi&sz=w1000', 0, '2025-04-07 20:21:12', '2025-04-07 20:21:12'),
(64, 9, 'https://drive.google.com/thumbnail?id=1lhpN4Mwp-qpf_w8SPNR38sWBfT31h4x6&sz=w1000', 0, '2025-04-07 20:21:12', '2025-04-07 20:21:12');

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE `schedules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `admin_id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `schedules`
--

INSERT INTO `schedules` (`id`, `admin_id`, `date`, `start_time`, `end_time`, `created_at`, `updated_at`) VALUES
(1, 2, '2025-04-07', '10:56:00', '16:56:00', '2025-04-04 03:56:21', '2025-04-04 03:56:21'),
(2, 2, '2025-04-08', '11:00:00', '20:00:00', '2025-04-04 04:01:18', '2025-04-04 04:01:18'),
(3, 2, '2025-04-09', '13:00:00', '20:00:00', '2025-04-04 04:01:20', '2025-04-04 00:02:18'),
(4, 2, '2025-04-10', '09:00:00', '17:01:00', '2025-04-04 04:01:20', '2025-04-04 00:02:49'),
(5, 2, '2025-04-11', '09:00:00', '17:00:00', '2025-04-04 15:29:28', '2025-04-04 15:29:28'),
(6, 2, '2025-04-12', '09:00:00', '17:00:00', '2025-04-04 15:29:28', '2025-04-04 15:29:28'),
(7, 2, '2025-04-13', '09:00:00', '17:00:00', '2025-04-04 15:29:28', '2025-04-04 15:29:28'),
(8, 2, '2025-04-14', '09:00:00', '17:00:00', '2025-04-04 15:29:28', '2025-04-04 15:29:28'),
(9, 2, '2025-04-15', '09:00:00', '17:00:00', '2025-04-04 15:29:28', '2025-04-04 15:29:28'),
(10, 2, '2025-04-16', '09:00:00', '17:00:00', '2025-04-04 15:29:28', '2025-04-04 15:29:28'),
(11, 2, '2025-04-17', '09:00:00', '17:00:00', '2025-04-04 15:29:28', '2025-04-04 15:29:28'),
(12, 2, '2025-04-18', '09:00:00', '17:00:00', '2025-04-04 15:29:28', '2025-04-04 15:29:28'),
(13, 2, '2025-04-19', '09:00:00', '17:00:00', '2025-04-04 15:29:28', '2025-04-04 15:29:28'),
(14, 2, '2025-04-20', '09:00:00', '17:00:00', '2025-04-04 15:29:28', '2025-04-04 15:29:28'),
(15, 2, '2025-04-21', '09:00:00', '17:00:00', '2025-04-04 15:29:28', '2025-04-04 15:29:28'),
(16, 2, '2025-04-22', '09:00:00', '17:00:00', '2025-04-04 15:29:28', '2025-04-04 15:29:28'),
(17, 2, '2025-04-23', '09:00:00', '17:00:00', '2025-04-04 15:29:28', '2025-04-04 15:29:28'),
(18, 2, '2025-04-24', '09:00:00', '17:00:00', '2025-04-04 15:29:28', '2025-04-04 15:29:28'),
(19, 2, '2025-04-25', '09:00:00', '17:00:00', '2025-04-04 15:29:28', '2025-04-04 15:29:28'),
(20, 2, '2025-04-26', '09:00:00', '17:00:00', '2025-04-04 15:29:28', '2025-04-04 15:29:28'),
(21, 2, '2025-04-27', '09:00:00', '17:00:00', '2025-04-04 15:29:28', '2025-04-04 15:29:28'),
(22, 2, '2025-04-28', '09:00:00', '17:00:00', '2025-04-04 15:29:28', '2025-04-04 15:29:28'),
(23, 2, '2025-04-29', '09:00:00', '17:00:00', '2025-04-04 15:29:28', '2025-04-04 15:29:28'),
(24, 2, '2025-04-30', '09:00:00', '17:00:00', '2025-04-04 15:29:28', '2025-04-04 15:29:28');

-- --------------------------------------------------------

--
-- Table structure for table `sold_cars`
--

CREATE TABLE `sold_cars` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `car_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `sold_price` decimal(10,2) NOT NULL,
  `sold_date` datetime DEFAULT current_timestamp(),
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sold_cars`
--

INSERT INTO `sold_cars` (`id`, `car_id`, `name`, `surname`, `email`, `phone`, `sold_price`, `sold_date`, `created_at`, `updated_at`) VALUES
(1, 4, 'Alexei', 'Mateevici', 'alexei@gmail.com', '1182272551', 26000.00, '2025-04-01 02:36:19', '2025-04-01 06:36:19', '2025-04-01 06:36:19'),
(2, 2, 'Alexei', 'Banaga', 'alexei.banaga@gmail.com', '361 181 1827', 180000.00, '2025-04-01 18:31:13', '2025-04-01 22:31:13', '2025-04-01 22:31:13');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `email` varchar(191) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `surname`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Mihail', 'sidorenco', 'mihail.sidorenco@gmail.com', '$2y$10$eHlDXN3Ox58TuDsyxV62Z.n/Dy5jU5FYzCdLzUEXboGx9/muo3X.S', '2025-01-10 19:35:53', '2025-01-10 19:35:53'),
(2, 'Mihail', 'sidorenco', 'mihail@gmail.com', '$2y$12$MRWDKGcRYU90QNB28yOR1OipwBAWqsJpNJz098LWHfXiLDJT7qhB2', '2025-01-11 00:36:51', '2025-01-11 00:36:51'),
(3, 'Cebanu', 'Dionis', 'dioniska@gmail.com', '$2y$12$FgDZ2ApyJ8txWufdyWw9ruAP1vosEVGxp0TzEAtzNmi4ZTvjUA4pS', '2025-01-11 02:34:54', '2025-01-11 02:34:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `car_id` (`car_id`);

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `sold_cars`
--
ALTER TABLE `sold_cars`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_soldcar_car` (`car_id`);

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
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `sold_cars`
--
ALTER TABLE `sold_cars`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
