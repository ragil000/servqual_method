-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 04, 2020 at 06:48 PM
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
  `level` tinyint(4) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `email`, `password`, `status`, `level`, `created_at`, `updated_at`) VALUES
(1, 'Admin Yayasan', 'yayasan@gmail.com', '25d55ad283aa400af464c76d713c07ad', 'active', 1, '2020-08-04 09:30:42', NULL),
(2, 'Ragil Manggalaning Y', 'ragilmanggalaning42@gmail.com', '25d55ad283aa400af464c76d713c07ad', 'active', 1, '2020-08-04 09:31:17', NULL),
(3, 'Admin MTs', 'mts@gmail.com', '25d55ad283aa400af464c76d713c07ad', 'active', 4, '2020-11-22 06:59:20', NULL),
(4, 'Admin MI', 'mi@gmail.com', '25d55ad283aa400af464c76d713c07ad', 'active', 3, '2020-11-22 06:59:45', NULL),
(5, 'Admin MA', 'ma@gmail.com', '25d55ad283aa400af464c76d713c07ad', 'active', 5, '2020-11-22 07:00:03', NULL),
(6, 'Admin PAUD', 'paud@gmail.com', '25d55ad283aa400af464c76d713c07ad', 'active', 2, '2020-12-04 22:22:12', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id` int(11) NOT NULL,
  `title` varchar(250) DEFAULT NULL,
  `content` text NOT NULL,
  `file` varchar(55) DEFAULT NULL,
  `type` enum('profile','images','news') DEFAULT NULL,
  `slug` varchar(250) DEFAULT NULL,
  `views` int(11) NOT NULL DEFAULT '0',
  `level` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `title`, `content`, `file`, `type`, `slug`, `views`, `level`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 'PROFIL UMMUSSHABRI ', '<p style=\"margin-left: 0px;\"><b>Yayasan Ummusshabri&nbsp;</b>&nbsp;secara legal formal berdiri tahun 2009. Sebelum dibentuk Yayasan Ummusshabri kendari aktifitas kelembagaan berjalan sebagaimana mestinya dengan menggunakan nama&nbsp;&nbsp;<b>Pondok Pesantren Ummusshabri. Ummusshari&nbsp;</b>Beralamatkan di Jl. A hmad Yani No.3 Ken dari 93117, Sulawesi Tenggara, Telp. (0401) 321335, 325441, 326602, 328311. Pendiri Mayjend Purn. H. Edy Sabara, CS Tahun berdiri 9 Januari 1974 Pimpinan Pontren Drs. H. Baso Suamir.&nbsp; Pondok ini awalnya diprakarsai oleh Gabungan Usaha Perbaikan Pendidikan Islam (GUPPI) tersebut, sejak Muktamar VIII di Jakarta berubah menjadi Gerakan Usaha Pembaharuan Pendidikan Islam. Dipilihnya Ummusshabri sebagai nama pondok pesantren tentu tidak lepas<br>dari keinginan para pendirinya dalam mengidealkan sosok santri di wilayah Kendari. Secara bahasa Ummusshabri berarti puncak kesabaran atau kesabaran yang tinggi. Dengan nama tersebut diharapkan agar pemuda dan pemudi Islam yang dididik di Pondok Pesantren ini memiliki kesabaran yang tinggi dalam berjuang membangun negeri tercinta ini, khususnya wilayah Sulawesi Tenggara.<br>Perjuangan itu sekaligus untuk mencapai keridhoan Allah SWT</p><p style=\"margin-left: 0px;\"><b>Para Tokoh Pendiri Ummusshabri:&nbsp;</b></p><p>1)&nbsp; Mayjend Purn. 2)&nbsp;<span style=\"font-size: 1rem;\">H. Edy Sabara, 3)&nbsp;</span><span style=\"font-size: 1rem;\">H. Madjied, 4)&nbsp;</span><span style=\"font-size: 1rem;\">Joenoes (Alm), 5) Drs. H. Abdullah Silondae&nbsp;</span><span style=\"font-size: 1rem;\">(Alm), 6) HA. Karim Aburaera SH. 7) Drs. H.&nbsp;</span><span style=\"font-size: 1rem;\">Djalante P., 8) Drs. HA. Zaenal Arifin. P.&nbsp;</span><span style=\"font-size: 1rem;\">Rafiuddin (Alm), 9) Nurdin DG Magasing (Alm), 10)&nbsp;</span><span style=\"font-size: 1rem;\">H. Abd. Rahiem Munir (Alm), 11) H. Muhammad&nbsp;</span><span style=\"font-size: 1rem;\">Amin (Alm), dan 12) Ir. Muh. Saleh.</span></p><p style=\"margin-left: 0px;\"><b>Penyelenggaraan Pendidikan:</b></p><p>Yayasan Ummusshabri menyelenggarakan pendidikan formal berupa madrasah dan sekolah pada beberapa jenjang pendidikan. Madrasah ini dibawah bimbingan Departemen Agama antara lain, Madrasah Aliyah, Madrasah Tsanawiyah dan Madrasah Ibtidaiyah. Sedangkan sekolah di bawah naungan Kemendikbud yaitu Pendidikan Anak Usia Dini. Saat ini tenaga pendidik dan kependidikan (Pegawai Tetap)&nbsp;lingkup Yayasan Ummusshabri degan rincian yaitu&nbsp; PAUD berjumlah 9 orang, MI berjumlah 144 orang, MTs berjumlah 44 orang, dan MA berjumlah 23 orang dengan rincian pedidikan yaitu Diploma berjumlah 1 orang, S1 berjumlah 112 orang dan S2 berjumlah 32 orang. Selain menyelenggarakan pendidikan formal juga menyelenggaran pendidikan non formal di Pondok Pesantren.&nbsp;</p><p style=\"margin-left: 0px;\"><b>Bidang Usaha&nbsp;</b></p><p style=\"margin-left: 0px;\">Selain menangani pendidikan Yayasa Ummusshabri juga memiliki unit Usaha diantaranya adalah Koperasi Simpan Pinjam yang saat ini beranggotakan kurang lebih 150 orang yang terdiri dari unsur guru dan masyarakat.&nbsp;&nbsp;<br><br></p>', '1606776708.jpg', 'profile', 'profil-ummusshabri-1606872749', 0, 'foundation', '2020-07-26 02:58:34', 1, '2020-12-01 17:00:00', 1),
(2, 'MADRASAH IBTIDAIYAH (MI) PESRI KENDARI', '<p><span style=\"color: rgb(68, 68, 68);\">Madrasah Ibtidaiyah (MI) Pesri Kendari adalah Sekolah Swasta yang berwawasan Islam berdiri tahun 1994 dibawah naungan Kementerian Agama Kota Kendari dan merupakan salah satu bagian dari Yayasan Ummusshabri Kendari. Kurikulum yang&nbsp;digunakan di MI Pesri Kendari&nbsp;adalah&nbsp;Kurikulum&nbsp;2013&nbsp;dan&nbsp;dikombinasikan&nbsp;dengan Kurikulum&nbsp;Internasional (Math, Sains dan Super Minds) dengan metode team teaching. Bahasa yang digunakan dalam proses&nbsp;pembelajaran&nbsp;adalah bilingual (bahasa Indonesia sebagai&nbsp;bahasa&nbsp;utama dan bahasa bahasa inggris seagai bahasa penunjang). MI Pesri Kendari menyediakan pendidikan berkualitas yang membentuk karakter&nbsp;siswa menjadi&nbsp;percaya&nbsp;diri&nbsp;dan&nbsp;peduli serta&nbsp;bertanggung jawab terhadap lingkungan sekitar.</span><br></p>', '1606789945.jpg', 'profile', 'madrasah-ibtidaiyah-mi-pesri-kendari-1606789946', 0, 'mi', '2020-07-26 02:58:34', 1, '2020-11-30 17:00:00', 1),
(10, 'ANALISIS STANDAR SATUAN BELANJA (ASSB) KABUPATEN BOMBANA', '<p><font color=\"#000000\">Analisis Standar Satuan Belanja (ASSB) sebagai dasar pengukuran kinerja keuangan dalam penyusunan APBD dengan pendekatan kinerja dan untuk menganalisis kewajaran beban kerja atau biaya setiap program atau kegiatan yang akan dilaksanakan oleh Organisasi Perangkat Daerah Kabupaten Bombana dalam penyusunan Rencana Kerja dan Anggaran Organisasi Perangkat Daerah&nbsp; di Kabupaten Bombana.</font></p><p><font color=\"#000000\">Manfaat kegiatan Analisis Standar Satuan Belanja (ASSB)&nbsp; untuk memudahkan bagi Organisasi Perangkat Daerah dalam Penyusunan Anggaran Program/Kegiatan dan meningkatnya kinerja dan pelayanan Organisasi Perangkat Daerah dalam hal pengelolaan anggaran program/kegiatan.</font></p><p><font color=\"#000000\">Output :</font></p><p><font color=\"#000000\">1. Tersusunnya Dokumen Analisis Standar Satuan Belanja Kabupaten Bombana.</font></p><p><font color=\"#000000\">2. Terbitnya Peraturan Bupati Bombana tentang Analisis Standar Satuan Belanja di Lingkungan Pemerintah Kabupaten Bombana</font></p>', '1601467802.jpg', 'profile', 'analisis-standar-satuan-belanja-assb-kabupaten-bombana-1601467802', 0, 'ma', '2020-08-04 03:45:03', 1, '2020-09-29 17:00:00', 1),
(76, 'EMPAT GURU TAMU DARI AMERIKA MENGAJAR DI UMMUSSHABRI', '<p>Sekretaris Mabigus, Mohamad Anwar, saat menyematkan tanda kepesertaan PTA</p><p>&nbsp;</p><p>Sebagai lembaga pendidikan, Madrasah Aliyah Pesri Kendari tidak hanya disibukkan dengan aktifitas pembelajaran dalam kelas, akan tetapi juga aktif mendorong berbagai kegiatan dalam bidang organisasi kesiswaan.<br>Salah satu kegiatan yang dilaksanakan adalah Penerimaan Tamu Ambalan (PTA) Gerakan Pramuka Gugus Depan Ummusshabri Kendari yang berlangsung dari tanggal 30 Agustus - 1 September 2019 bertempat di Bumi Perkemahan Pesantren Ummusshabri Kendari.<br>Sekretaris Mabigus Mohamad Anwar, S.Ag., M.Si dalam amanahnya ketika membuka kegitan mengatakan : Gerakan Pramuka yang berpangkalan di satuan pendidikan seperti di MA Pesri Kendari menjadi wadah yang penting bagi peserta didik, untuk<br>menambah pengetahuan dan wawasan, melaui berbagai kegiatan yang didesain sesuai dengan karakter dan tujuan pendidikan kepramukaan, yang diarahkan pada fungsi pengembangan, sosial, rekreatif dan persiapan karir bagi peserta didik. Terlebih dalam kurikulum Pendidikan Nasional menempatkan kegiatan pramuka sebagai kegiatan ekstrakurikuler wajib, ini artinya kegiatan kepramukaan tidak ditempatkan sebagai pengisi waktu luang akan tetapi sebagai sarana peningkatan mutu pendidikan Madrasah.<br>Anwar juga mengingatkan \"sesuai dengan Undang-undang RI No. 12 tahun 2010 bahwa tujuan pramuka adalah untuk membentuk setiap pramuka agar memiliki kepribadian yang beriman, bertakwa, berakhlak mulia, berjiwa patriotik, taat hukum, disiplin, menjunjung tinggi nilai-nilai luhur bangsa, dan memiliki kecakapan hidup sebagai kader bangsa dalam menjaga dan membangun Negara Kesatuan Republik Indonesia, mengamalkan Pancasila, serta melestarikan lingkungan hidup\".</p>', '1606000633.jpg', 'profile', 'empat-guru-tamu-dari-amerika-mengajar-di-ummusshabri-1607101354', 9, 'mts', '2020-11-21 23:17:13', 1, '2020-12-03 17:00:00', 1),
(80, 'GAMBAR SEKOLAH UMMUSSHABRI', '', '1606777871.jpg', 'images', 'gambar-sekolah-ummusshabri-1606873416', 0, 'foundation', '2020-11-30 23:11:14', 1, '2020-12-01 17:00:00', 1),
(81, 'GAMBAR SEKOLAH UMMUSSHABRI', '', '1606778468.jpg', 'images', 'gambar-sekolah-ummusshabri-1606873348', 0, 'mi', '2020-11-30 23:21:11', 4, '2020-12-01 17:00:00', 1),
(83, 'KUNJUNGAN PENGURUS YAYASAN UMMUSSHABRI KE KOLEJ UINVERSITI PERGURUAN UGAMA SERI BEGAWAN BERUNEI DARUSSALAM', '', '1606782237.jpg', 'images', 'kunjungan-pengurus-yayasan-ummusshabri-ke-kolej-uinversiti-perguruan-ugama-seri-begawan-berunei-darussalam-1606782237', 0, 'foundation', '2020-12-01 00:23:57', 1, NULL, NULL),
(84, 'Foto Kegiatan Pembelajaran Kelas CIBI bersama guru dari Amerika', '', '1606872124.jpg', 'images', 'foto-kegiatan-pembelajaran-kelas-cibi-bersama-guru-dari-amerika-1606872125', 0, 'foundation', '2020-12-02 01:22:05', 1, NULL, NULL),
(85, 'KEGIATAN INTERNATIONAL CULTURE EXCHAGE CAMP TAHUN 2018 DI BANGKOK THAILAND', '', '1606872364.jpg', 'images', 'kegiatan-international-culture-exchage-camp-tahun-2018-di-bangkok-thailand-1606872364', 0, 'foundation', '2020-12-02 01:26:04', 1, NULL, NULL),
(86, 'FOTO KEGIATAN KUNJUNGAN KE SEKOLAH UNGGULAN DI KOREA SELATAN', '', '1606872439.jpg', 'images', 'foto-kegiatan-kunjungan-ke-sekolah-unggulan-di-korea-selatan-1606872439', 0, 'foundation', '2020-12-02 01:27:19', 1, NULL, NULL),
(87, 'KUNJUNGAN PENGURUS YAYASAN KE SEKOLAH UNGGULAN MALAYSIA', '', '1606872515.jpg', 'images', 'kunjungan-pengurus-yayasan-ke-sekolah-unggulan-malaysia-1606872516', 0, 'foundation', '2020-12-02 01:28:36', 1, NULL, NULL),
(88, 'UMMUSSHABRI MENYELENGGARAN PAT BERBASIS ANDROID DAN CAT', '<p style=\"margin-left: 0px; text-align: justify;\">Kendari, (Ummusshabri) --- Jelang pelaksanaan Penilaian Akhir Semester (PAS) ganjil &nbsp;tahun pelajaran 2020-2021 yang dimulai senin tanggal 21 November 2020 mendatang, sebelum melakukan PAT pada setiap madrasah melakukan simulasi terlebih dahulu. &nbsp;</p><p style=\"margin-left: 0px; text-align: justify;\">Kegiatan PAT pada masing-masing madrasah lingkup yayasan Ummusshabri Kendari dilakukan selama satu minggu. Panitia pelaksana PAT MI yaitu Evi Hasmira, S.Pd, MTs yaitu Irwan Evarial, S.Pd.I., M.Pd. dan MA yaitu Mujahidin Amrullah, M.Pd</p><p style=\"margin-left: 0px; text-align: justify;\">Pada pelaksanaa ini setiap peserta PAT yang telah menyelesaikan pengisian soal langsung diketahui hasilnya oleh panitia. Penilaian Akhir Semester berbasis Web dan Android ini sangat mengefesienkan waktu baik dalam pemeriksanaan atau dalam pengawasan.&nbsp;&nbsp;</p>', '1606872658.jpg', 'news', 'ummusshabri-menyelenggaran-pat-berbasis-android-dan-cat-1606872658', 3, 'foundation', '2020-12-02 01:30:58', 1, NULL, NULL),
(89, 'MASTER PLAN UMMUSSHABRI', '<p>Master Plan Ummusshabri&nbsp;<a href=\"https://youtu.be/FZYwsA1fPpQText\" target=\"_self\">MASTER PLAN</a></p>', '1607047107.jpg', 'news', 'master-plan-ummusshabri-1607048345', 8, 'foundation', '2020-12-04 01:58:27', 1, '2020-12-03 17:00:00', 1),
(90, 'Profil PAUD', '<p>ini adalah profil PAUD</p><figure class=\"media\"><oembed url=\"https://youtu.be/zv0_odzriiI\"></oembed></figure>', '1607096455.jpg', 'profile', 'profil-paud-1607100924', 0, 'ece', '2020-12-04 15:40:56', 6, '2020-12-03 17:00:00', 1),
(91, '1', '<p>1</p>', '1607102035.jpg', 'news', '1-1607102035', 0, 'foundation', '2020-12-04 17:13:55', 1, NULL, NULL),
(92, '2', '<p>2</p>', '1607102043.jpg', 'news', '2-1607102043', 0, 'foundation', '2020-12-04 17:14:03', 1, NULL, NULL),
(93, '3', '<p>3</p>', '1607102050.jpg', 'news', '3-1607102051', 0, 'foundation', '2020-12-04 17:14:11', 1, NULL, NULL),
(94, '4', '<p>4</p>', '1607102057.jpg', 'news', '4-1607102057', 0, 'foundation', '2020-12-04 17:14:17', 1, NULL, NULL),
(95, '5', '<p>5</p>', '1607102067.jpg', 'news', '5-1607102067', 0, 'foundation', '2020-12-04 17:14:27', 1, NULL, NULL),
(96, '6', '<p>6</p>', '1607102080.jpg', 'news', '6-1607102081', 0, 'foundation', '2020-12-04 17:14:41', 1, NULL, NULL),
(97, '7', '<p>7</p>', '1607102088.jpg', 'news', '7-1607102088', 0, 'foundation', '2020-12-04 17:14:48', 1, NULL, NULL),
(98, '8', '<p>8</p>', '1607102094.jpg', 'news', '8-1607102094', 0, 'foundation', '2020-12-04 17:14:54', 1, NULL, NULL),
(99, '9', '<p>9</p>', '1607102100.jpg', 'news', '9-1607102100', 0, 'foundation', '2020-12-04 17:15:00', 1, NULL, NULL),
(100, '9', '<p>9</p>', '1607102220.jpg', 'news', '9-1607102220', 0, 'foundation', '2020-12-04 17:17:00', 1, NULL, NULL),
(101, '10', '<p>10</p>', '1607102230.jpg', 'news', '10-1607102231', 0, 'foundation', '2020-12-04 17:17:11', 1, NULL, NULL),
(103, 'ds', '', '1607102527.jpg', 'images', 'ds-1607102527', 0, 'foundation', '2020-12-04 17:22:07', 1, NULL, NULL),
(104, 'asfsafsa', '', '1607102535.jpg', 'images', 'asfsafsa-1607102535', 0, 'foundation', '2020-12-04 17:22:15', 1, NULL, NULL),
(105, 'dsad', '', '1607102546.jpg', 'images', 'dsad-1607102546', 0, 'foundation', '2020-12-04 17:22:26', 1, NULL, NULL),
(106, 'dsadsa', '', '1607102566.jpg', 'images', 'dsadsa-1607102567', 0, 'foundation', '2020-12-04 17:22:47', 1, NULL, NULL);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
