-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 30, 2022 at 02:52 AM
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
-- Database: `servqual`
--

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `questionnaire_id` int(11) NOT NULL,
  `lab_id` int(11) NOT NULL,
  `name` varchar(35) NOT NULL,
  `nim` varchar(12) NOT NULL,
  `expectation_answer` tinyint(1) NOT NULL,
  `reality_answer` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dimensions`
--

CREATE TABLE `dimensions` (
  `_id` int(11) NOT NULL,
  `title` varchar(35) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dimensions`
--

INSERT INTO `dimensions` (`_id`, `title`, `description`) VALUES
(1, 'Reliabilitas (reliability)', 'Berkaitan dengan kemampuan Laboratorium untuk memberikan layanan yang akurat sejak pertama kali tanpa membuat kesalahan \r\napapun dan menyampaikan jasanya sesuai dengan waktu yang disepakati.'),
(2, 'Daya Tanggap (responsiveness)', 'Berkenaan dengan kesediaan dan kemampuan \r\npara karyawan untuk membantu para mahasiswa dan merespon permintaan \r\nmereka, serta menginformasikan kapan jasa akan diberikan dan kemudian \r\nmemberikan jasa secara tepat.'),
(3, 'Jaminan (assurance)', 'yakni perilaku para karyawan mampu menumbuhkan kepercayaan pelangan terhadap Laboratorium dan Laboratorium bisa menciptakan rasa aman bagi para mahasiswanya. Jaminan juga berarti bahwa para karyawan selalu bersikap sopan dan menguasai pengetahuan dan ketrampilan yang dibutuhkan untuk menangani setiap pertanyaan atau masalah mahasiswa.'),
(4, 'Bukti Fisik (tangible)', 'Berkenaan dengan daya tarik fasilitas fisik, perlengkapan dan material yang digunakan Laboratorium serta penampilan karyawan.'),
(5, 'Empati (empathy)', 'berarti Laboratorium memahami masalah para mahasiswanya dan bertindak demi kepentingan mahasiswa serta memberikan perhatian personal kepada para mahasiswa dan memiliki jam operasi yang nyaman.');

-- --------------------------------------------------------

--
-- Table structure for table `labs`
--

CREATE TABLE `labs` (
  `_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `status` enum('active','nonactive') NOT NULL DEFAULT 'active',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `labs`
--

INSERT INTO `labs` (`_id`, `title`, `status`, `created_at`, `deleted_at`) VALUES
(1, 'Laboratorium Software Engineering', 'active', '2021-09-06 23:26:20', NULL),
(2, 'Laboratorium Jaringan', 'active', '2021-09-06 23:26:20', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `questionnaires`
--

CREATE TABLE `questionnaires` (
  `_id` int(11) NOT NULL,
  `start_periode` date NOT NULL,
  `end_periode` date NOT NULL,
  `status` enum('active','nonactive') NOT NULL,
  `is_publish` enum('yes','no') NOT NULL DEFAULT 'no',
  `is_delete` enum('yes','no') NOT NULL DEFAULT 'yes',
  `lab_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `_id` int(11) NOT NULL,
  `question` varchar(450) NOT NULL,
  `dimension_id` int(11) NOT NULL,
  `lab_id` int(11) NOT NULL,
  `questionnaire_id` int(11) NOT NULL,
  `sum_expectation_answer` int(11) NOT NULL DEFAULT '0',
  `sum_reality_answer` int(11) NOT NULL DEFAULT '0',
  `sum_total_answerer` int(11) NOT NULL DEFAULT '0',
  `sum_expectation_average` float DEFAULT '0',
  `sum_reality_average` float NOT NULL DEFAULT '0',
  `sum_gap5` float NOT NULL DEFAULT '0',
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `summary_servqual`
--

CREATE TABLE `summary_servqual` (
  `_id` int(11) NOT NULL,
  `gap` tinyint(1) NOT NULL,
  `type` enum('expectation','reality') NOT NULL,
  `sum_total_answerer` int(11) NOT NULL DEFAULT '0',
  `sum_total_point` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `questionnaire_id` int(11) NOT NULL,
  `lab_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `_id` int(11) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` text NOT NULL,
  `lab_id` int(11) DEFAULT NULL,
  `role` enum('user','admin','super') NOT NULL,
  `status` enum('active','nonactive') NOT NULL DEFAULT 'active',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`_id`, `username`, `password`, `lab_id`, `role`, `status`, `created_at`, `deleted_at`) VALUES
(1, 'user_se', '$2y$10$tic9WfdKouUJsxvr45HJSuELT6CRmSgmNFNO7VielnpNWCaswq4PO', 1, 'admin', 'active', '2021-09-07 00:12:40', NULL),
(2, 'super', '$2y$10$tic9WfdKouUJsxvr45HJSuELT6CRmSgmNFNO7VielnpNWCaswq4PO', 0, 'super', 'active', '2022-02-22 14:43:09', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`_id`);

--
-- Indexes for table `dimensions`
--
ALTER TABLE `dimensions`
  ADD PRIMARY KEY (`_id`);

--
-- Indexes for table `labs`
--
ALTER TABLE `labs`
  ADD PRIMARY KEY (`_id`);

--
-- Indexes for table `questionnaires`
--
ALTER TABLE `questionnaires`
  ADD PRIMARY KEY (`_id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`_id`);

--
-- Indexes for table `summary_servqual`
--
ALTER TABLE `summary_servqual`
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
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `dimensions`
--
ALTER TABLE `dimensions`
  MODIFY `_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `labs`
--
ALTER TABLE `labs`
  MODIFY `_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `questionnaires`
--
ALTER TABLE `questionnaires`
  MODIFY `_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `summary_servqual`
--
ALTER TABLE `summary_servqual`
  MODIFY `_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
