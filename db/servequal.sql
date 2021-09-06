-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 06, 2021 at 07:42 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `servequal`
--

-- --------------------------------------------------------

--
-- Table structure for table `labs`
--

CREATE TABLE `labs` (
  `_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `status` enum('active','nonactive') NOT NULL DEFAULT 'active',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `labs`
--

INSERT INTO `labs` (`_id`, `title`, `status`, `created_at`) VALUES
(1, 'Laboratorium AI', 'active', '2021-09-06 23:26:20'),
(2, 'Laboratorium Jaringan', 'active', '2021-09-06 23:26:20');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `_id` int(11) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` text NOT NULL,
  `lab_id` int(11) DEFAULT NULL,
  `role` enum('user','admin') NOT NULL,
  `status` enum('active','nonactive') NOT NULL DEFAULT 'active',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`_id`, `username`, `password`, `lab_id`, `role`, `status`, `created_at`) VALUES
(1, 'user_ai', '$2y$10$tic9WfdKouUJsxvr45HJSuELT6CRmSgmNFNO7VielnpNWCaswq4PO', 1, 'admin', 'active', '2021-09-07 00:12:40');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `labs`
--
ALTER TABLE `labs`
  ADD PRIMARY KEY (`_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `labs`
--
ALTER TABLE `labs`
  MODIFY `_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
