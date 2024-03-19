-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 18, 2024 at 02:09 PM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `qr_attendance`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendances`
--

DROP TABLE IF EXISTS `attendances`;
CREATE TABLE IF NOT EXISTS `attendances` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `time_scanned` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `event_id` (`event_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attendances`
--

INSERT INTO `attendances` (`id`, `user_id`, `event_id`, `time_scanned`, `updated_at`, `created_at`) VALUES
(7, 15, 4, '2024-03-18 10:54:02', '2024-03-18 03:54:02', '2024-03-18 03:54:02'),
(8, 11, 4, '2024-03-18 10:54:02', '2024-03-18 03:54:02', '2024-03-18 03:54:02'),
(9, 10, 4, '2024-03-18 10:54:02', '2024-03-18 03:54:02', '2024-03-18 03:54:02'),
(10, 4, 4, '2024-03-18 10:54:02', '2024-03-18 03:54:02', '2024-03-18 03:54:02');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
CREATE TABLE IF NOT EXISTS `events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_time` datetime NOT NULL,
  `end_time` datetime NOT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `name`, `start_time`, `end_time`, `location`) VALUES
(1, 'Event 1', '2024-03-20 09:00:00', '2024-03-20 12:00:00', 'Location 1'),
(2, 'Event 2', '2024-03-21 14:00:00', '2024-03-21 18:00:00', 'Location 2'),
(4, 'Hội thi dz', '2024-03-18 08:01:00', '2024-03-19 08:01:00', 'stua'),
(5, 'dsdfdsfdsfasf', '2024-03-12 11:15:00', '2024-03-19 11:15:00', 'ádfsfdsfdsf');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','user') COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`) VALUES
(1, 'John Doe', 'john@example.com', 'hashed_password', 'user'),
(2, 'Jane Doe', 'jane@example.com', 'hashed_password', 'admin'),
(3, 'thi', 't@gmail.com', '$2y$10$U4dXCcIkGQikMbbXccwZdesElfIVmvobMaYk/6U3QcNOruGQX8gNO', 'admin'),
(4, 'thi dep trai', 't@a.com', '$2y$10$5E45mE/c49jlirG9.6oVM.pDtO/bxYDQGlbsm/8/zPgvFqwM5Ct8W', 'user'),
(5, 'anh thi', 'b@z.com', '$2y$10$PcaEQQmiWyK6lyqSIE8nuOI0pPlWjLGZsbD86aYSJqOFQalxUM8eu', 'admin'),
(6, 'thia', 'tz@t.com', '$2y$10$hwaZBqhV.OsKjnRhiukixOTq2jza4asuMER95mHBg2IQMTS6QoahG', 'admin'),
(8, 'Hội thi dz', 't@gmssail.com', '$2y$10$/KJ74TqPCuzDViNtWyWLSefvnZniKB09QgWoRNlcV.yOwDDWzFG6y', 'user'),
(9, 'ssss', 't@gmasil.com', '$2y$10$Etfuc8fw5A7aL3CDHbUrwOX3pFfXtsRTudi6cZUmt8euZEZfar1w2', 'user'),
(10, 'qq', 'q@q.com', '$2y$10$XkGNU5c8VyxeUvzh06rl2OTAFoBDa914ZPrMflk4lAx4xTkPkHVVW', 'user'),
(11, 'x', 'x@x.com', '$2y$10$F1aKj4rxA.N.u9L0dr3O6e9bNxJeA9KO/1pkyIUdQ/nusPQqRz4Fq', 'user'),
(12, 'w', 'w@w.com', '$2y$10$IFny16hVgSfrx2vWtMxqCu/C.pvH1nWozuti32cFy/t2c0kBN/4cW', 'user'),
(13, 't', 't@t', '$2y$10$IjA8hBq/znfFDMZhCuF9seP5umASBMv.ks0KKlt9O41.G/QFU7Pte', 'user'),
(14, 'v', 'v@v.com', '$2y$10$Rl0altG8dICsE.KsjiMwLOOlASMNg3rUhMfpb0MT8bclOGwe26/s2', 'user'),
(15, 'i', 'i@i.com', '$2y$10$Y5fKBwqLjbqpeAsdoAGTueNjEUeF/Ip1EMN6cmI5MnAGA98tHsUr6', 'user');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendances`
--
ALTER TABLE `attendances`
  ADD CONSTRAINT `attendances_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `attendances_ibfk_2` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
