-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 17, 2023 at 02:26 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `user_registration`
--

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `rating` int(1) NOT NULL,
  `username` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `rating`, `username`, `created_at`) VALUES
(5, 4, 'alifcsnajmi', '2023-10-23 05:04:31'),
(6, 3, 'Ubaidah', '2023-10-23 05:37:40'),
(14, 3, 'Meow Zul', '2023-11-14 02:41:58'),
(15, 5, 'Ubaidah', '2023-11-15 05:16:05'),
(16, 4, 'Ubaidah', '2023-11-17 12:03:04');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_admin` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `address`, `password`, `is_admin`) VALUES
(1, 'John', 'Doe', '123 Main Street', 'password123', 0),
(4, 'Abu', 'Ubaidah', '7-11, Jalan Ayer Kerja Lama, Ukay Heights', '$2y$10$/ISwuKmp8aC3/qSRjS8Jj.NQq2rPSmnKC6rwTIw3/LqvNeYpTRUSi', 1),
(7, 'Zulhilmi', 'Zafrin', 'A3-3-25 Jalan Mewah 4  Taman Pandan Mewah', '$2y$10$YwlLbsoZEBRuwv7sriFXpOO99Me.C004LdeJOl1y5bQ91MM2RllHq', 1),
(11, 'Haikal', 'Zul', '11\nKlebang Impian 4', '$2y$10$WwEhHLfM..AjOhH2z/1ATefzLFA8gSiSSAjZ5y5F/W46Ha8iTyNPO', 0),
(13, 'ABu', 'huhu', 'Jalan Melati', '$2y$10$Z6OM1UwVI/X.ciZ5PjL.0.2UzCaG9wjERNGhI1uOYmENz6qNyeRIa', 1),
(14, 'alif', 'Ubaidahs', 'A3-3-25 Jalan Mewah 3/1  Taman Pandan Mewah', '$2y$10$ZFa2fN5DdYdotHO/V5IfRecNt2grtSPUjRzga6QkWlv1dkkCRIyn6', 0),
(15, 'Zulhilmi', 'Haikal', 'Jalan Melawati Rendah 2', '$2y$10$uXfwLrwoCyJtjg1hGVuVmeg2x9IrdjJ27bZUT7Qo5CSZU5Ughrkju', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
