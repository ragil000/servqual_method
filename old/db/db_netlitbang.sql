-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 01, 2020 at 03:19 PM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 5.6.37

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_netlitbang`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `email` varchar(35) NOT NULL,
  `password` varchar(32) NOT NULL,
  `status` enum('active','nonactive') NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `email`, `password`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Admin Netlitbang', 'netlitbang@gmail.com', '61b85852d31fa073f0cd316295500ff2', 'active', '2020-08-04 09:30:42', NULL),
(2, 'Ragil Manggalaning Y', 'ragilmanggalaning42@gmail.com', '17c4520f6cfd1ab53d8745e84681eb49', 'active', '2020-08-04 09:31:17', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id` int(11) NOT NULL,
  `title` varchar(250) DEFAULT NULL,
  `content` text NOT NULL,
  `file` varchar(55) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `type` enum('sop-kelitbangan','rik-bombana','agenda-kegiatan','rekomendasi','artikel-berita','sosial-pemerintahan','ekonomi-pembangunan','inovasi-pelayanan-publik') NOT NULL,
  `slug` varchar(250) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `title`, `content`, `file`, `start_date`, `end_date`, `type`, `slug`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 'What is Lorem Ipsum?', '<p style=\"margin-left: 0px; text-align: justify;\">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source.</p><p style=\"margin-left: 0px; text-align: justify;\">Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.</p><p style=\"margin-left: 0px; text-align: justify;\">The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</p><p style=\"margin-left: 0px; text-align: justify;\">Harus diedit.</p>', NULL, NULL, NULL, 'sop-kelitbangan', NULL, '2020-07-26 02:58:34', 1, '2020-08-01 17:00:00', 1),
(2, 'Where can I get some?', '<p><span style=\"color: rgb(0, 0, 0);\">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable.</span></p><p><span style=\"color: rgb(0, 0, 0);\">If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet.</span></p><p><span style=\"color: rgb(0, 0, 0);\">It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.</span><br></p>', NULL, NULL, NULL, 'rik-bombana', NULL, '2020-07-26 02:58:34', 1, '2020-08-01 17:00:00', 1),
(5, 'Judul', '<p>Jocc</p>', '1596410738.jpg', '2020-08-03', '2020-08-04', 'agenda-kegiatan', NULL, '2020-08-02 23:25:38', 1, NULL, NULL),
(7, 'sads', '<p>dasdas</p>', '1596412704.pdf', NULL, NULL, 'rekomendasi', 'sads-1596520832', '2020-08-02 23:58:24', 1, '2020-08-03 17:00:00', 1),
(8, 'Coba', '<p>Kaktus</p>', '1596509466.jpg', NULL, NULL, 'artikel-berita', 'coba-1596521655', '2020-08-04 02:51:06', 1, '2020-08-03 17:00:00', 1),
(9, 'Coba lagi', '<p>Kaktus</p>', '1596512688.jpg', '2020-08-04', '2020-08-05', 'agenda-kegiatan', NULL, '2020-08-04 03:44:48', 1, NULL, NULL),
(10, 'Lagi lagi', '<p><span style=\"color: rgb(0, 0, 0);\">t is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English.</span></p><p><span style=\"color: rgb(0, 0, 0);\">Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</span><br></p>', '1596512702.jpg', '2020-08-04', '2020-08-05', 'agenda-kegiatan', 'lagi-lagi-1596514648', '2020-08-04 03:45:03', 1, '2020-08-03 17:00:00', 1),
(11, 'Apa ya', '<p>Coba saja</p>', '1596526443.pdf', NULL, NULL, 'sosial-pemerintahan', 'apa-ya-1596526443', '2020-08-04 07:34:03', 1, NULL, NULL),
(12, 'Yoyo mamen', '<p>sasa</p>', '1596526646.pdf', NULL, NULL, 'ekonomi-pembangunan', 'yoyo-mamen-1596526646', '2020-08-04 07:37:26', 1, NULL, NULL),
(13, 'Jojo Bizard', '<p>asdsa</p>', '1596526666.pdf', NULL, NULL, 'inovasi-pelayanan-publik', 'jojo-bizard-1596526666', '2020-08-04 07:37:46', 1, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
