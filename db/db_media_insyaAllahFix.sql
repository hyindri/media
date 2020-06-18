-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 17, 2020 at 03:33 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_media`
--

-- --------------------------------------------------------

--
-- Table structure for table `keys`
--

CREATE TABLE `keys` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `key` varchar(40) NOT NULL,
  `level` int(2) NOT NULL,
  `ignore_limits` tinyint(1) NOT NULL DEFAULT 0,
  `is_private_key` tinyint(1) NOT NULL DEFAULT 0,
  `ip_addresses` text DEFAULT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `keys`
--

INSERT INTO `keys` (`id`, `user_id`, `key`, `level`, `ignore_limits`, `is_private_key`, `ip_addresses`, `date_created`) VALUES
(1, 1, 'f99aecef3d12e02dcbb6260bbdd35189c89e6e73', 1, 0, 0, '%', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_agenda`
--

CREATE TABLE `tb_agenda` (
  `id` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `status` enum('aktif','nonaktif') DEFAULT NULL,
  `file` varchar(255) NOT NULL,
  `dibuat_oleh` varchar(255) DEFAULT NULL,
  `dibuat_pada` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_agenda`
--

INSERT INTO `tb_agenda` (`id`, `judul`, `tanggal`, `status`, `file`, `dibuat_oleh`, `dibuat_pada`) VALUES
(4, 'asd', '2020-06-15', 'aktif', '1592190646428.pdf', 'Admin', '2020-06-15'),
(5, 'er', '2020-06-15', 'aktif', '1592190931704.pdf', 'Admin', '2020-06-15');

-- --------------------------------------------------------

--
-- Table structure for table `tb_berita`
--

CREATE TABLE `tb_berita` (
  `id` varchar(100) NOT NULL,
  `media_massa_id` varchar(100) NOT NULL,
  `sosmed_id` text DEFAULT NULL,
  `judul_berita` varchar(255) NOT NULL,
  `narasi_berita` text NOT NULL,
  `link_berita` varchar(255) DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `jumlah_view` int(11) DEFAULT NULL,
  `status_berita` enum('belum','oke','valid') NOT NULL,
  `keterangan` text DEFAULT NULL,
  `dibuat_oleh` varchar(255) DEFAULT NULL,
  `dibuat_tanggal` date DEFAULT NULL,
  `dibuat_pukul` time DEFAULT NULL,
  `diperiksa_oleh` varchar(255) DEFAULT NULL,
  `diperiksa_pada` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_berita`
--

INSERT INTO `tb_berita` (`id`, `media_massa_id`, `sosmed_id`, `judul_berita`, `narasi_berita`, `link_berita`, `file`, `jumlah_view`, `status_berita`, `keterangan`, `dibuat_oleh`, `dibuat_tanggal`, `dibuat_pukul`, `diperiksa_oleh`, `diperiksa_pada`) VALUES
('5ee09fa645056', '5ee0843b9a01e', '1, 2, 3, 4', 'Berita tentang burung', 'Burung puyuh', 'https://www.youtube.com/watch?v=ZEcqHA7dbwM', '1591803964075.mp3', 2000, 'valid', NULL, 'Media_radio', '2020-06-10', '04:32:46', 'Admin', '2020-06-10 09:31:12'),
('5ee0d52744011', '5ee082c345548', '1, 2, 3', 'BLT Bintan Tahap II Diserahkan Sebelum 15 Juni', 'PRESMEDIA.ID,Bintan- Pemerintah Kabupaten Bintan mengatakan, Bantuan Langsung Tunai (BLT) tahap II akan diserahkan sebelum 15 Juni mendatang, saat ini, data penerima BLT tersebut masih terus diproses dan diverifikasi.', 'https://presmedia.id/berita-11709/blt-bintan-tahap-ii-diserahkan-sebelum-15-juni.html', '1591804500654.jpg', 2000, 'valid', NULL, 'Media_online', '2020-06-10', '09:05:05', 'Admin', '2020-06-10 09:31:06'),
('5ee1108ee9ad7', '5ee082c345548', NULL, 'Tak ada obat', '<p style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque accumsan sit amet urna nec placerat. Donec quis neque eros. Praesent pulvinar porta sodales. Duis tristique odio in dui sollicitudin, laoreet consectetur lectus pretium. Maecenas commodo massa justo, bibendum finibus justo feugiat in. Cras molestie dolor a lectus rutrum facilisis. In lobortis rutrum dolor semper scelerisque. Maecenas rhoncus, ipsum et consectetur efficitur, dolor erat vehicula nulla, id facilisis urna mauris semper tortor. Vestibulum eu iaculis augue. Sed rhoncus ut velit in maximus.</p>\r\n<p style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px;\">Donec quis aliquam nisi, eget feugiat turpis. Aenean luctus ex a eleifend pulvinar. Ut in odio risus. In eu massa vulputate, pellentesque ligula eu, accumsan libero. Sed interdum semper velit, rhoncus ornare nisi porttitor congue. Cras vitae quam varius sem cursus maximus sed quis elit. Cras non nibh hendrerit, sodales leo sit amet, congue nunc. Vivamus pulvinar efficitur consectetur. Phasellus sit amet ultrices ipsum, ac condimentum ante. Cras eu lorem quis odio hendrerit ornare. Mauris et odio sit amet augue dignissim sollicitudin at in erat.</p>\r\n<p style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px;\">Pellentesque tincidunt purus nec ultricies cursus. In fringilla venenatis lobortis. Donec sed nisi augue. Etiam ut lectus bibendum, ultricies justo in, malesuada risus. Vestibulum rhoncus commodo nisi, consequat fermentum eros mollis in. Nulla mattis, mi non finibus pulvinar, velit neque lacinia leo, in blandit mauris lectus at massa. Donec hendrerit bibendum laoreet.</p>\r\n<p style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px;\">Etiam venenatis mauris justo, et consequat nisl lobortis non. Ut faucibus nisi feugiat convallis bibendum. Nunc ex lacus, ultricies ut lacus at, venenatis porta sem. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc in nibh id quam rhoncus eleifend et a ante. Pellentesque bibendum risus orci. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Phasellus euismod, lacus quis interdum hendrerit, arcu mi tincidunt augue, varius tincidunt augue dolor in ligula. Mauris faucibus efficitur neque ut tempus.</p>\r\n<p style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px;\">Vivamus porttitor sapien eget enim imperdiet, non pretium lacus finibus. Phasellus vestibulum varius felis, quis tristique sem. Quisque sit amet nunc tellus. In ac sapien nisi. Aenean non nunc ac orci fermentum vehicula sit amet id risus. Fusce massa tortor, feugiat ut est vulputate, vestibulum efficitur lacus. Morbi lacinia, neque sed rutrum fermentum, metus lacus accumsan enim, quis interdum lectus ex ac massa. Etiam eget consectetur libero. Etiam blandit metus quis interdum finibus. Morbi ullamcorper arcu id mauris viverra imperdiet. Fusce varius neque eu porta hendrerit. Fusce luctus risus interdum, pulvinar quam tempor, fermentum elit. Pellentesque vestibulum, ante eu efficitur ornare, felis erat consectetur justo, a condimentum urna sapien a urna. Etiam semper iaculis quam, quis iaculis nunc.</p>', NULL, '1591810623098.jpg', NULL, 'belum', NULL, 'Media_online', '2020-06-11', '12:37:03', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_log`
--

CREATE TABLE `tb_log` (
  `id` int(11) NOT NULL,
  `aktivitas` text NOT NULL,
  `oleh` varchar(255) DEFAULT NULL,
  `pada` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_log`
--

INSERT INTO `tb_log` (`id`, `aktivitas`, `oleh`, `pada`) VALUES
(1, 'Telah verifikasi data berita', 'Admin', '2020-06-10 21:12:28'),
(2, 'Telah verifikasi data berita', 'Admin', '2020-06-10 21:12:34'),
(3, 'Telah verifikasi data berita', 'Admin', '2020-06-10 21:13:32'),
(4, 'Telah verifikasi data berita', 'Admin', '2020-06-10 21:13:37'),
(5, 'Telah verifikasi data berita', 'Admin', '2020-06-10 21:14:42'),
(6, 'Telah verifikasi data berita', 'Admin', '2020-06-10 21:14:51'),
(7, 'Telah verifikasi data berita', 'Admin', '2020-06-10 21:16:06'),
(8, 'Telah verifikasi data berita', 'Admin', '2020-06-10 21:16:23'),
(9, 'Telah verifikasi data berita', 'Admin', '2020-06-10 21:16:27'),
(10, 'Telah verifikasi data berita', 'Admin', '2020-06-10 21:17:17'),
(11, 'Telah verifikasi data berita', 'Admin', '2020-06-10 21:17:31'),
(12, 'Telah verifikasi data berita', 'Admin', '2020-06-10 21:17:41'),
(13, 'Telah verifikasi data berita', 'Admin', '2020-06-10 21:18:30'),
(14, 'Telah verifikasi data berita', 'Admin', '2020-06-10 21:18:35'),
(15, 'Telah verifikasi data berita', 'Admin', '2020-06-10 21:19:38'),
(16, 'Telah verifikasi data berita', 'Admin', '2020-06-10 21:19:44'),
(17, 'Telah verifikasi data berita', 'Admin', '2020-06-10 21:23:10'),
(18, 'Telah verifikasi data berita', 'Admin', '2020-06-10 21:31:06'),
(19, 'Telah verifikasi data berita', 'Admin', '2020-06-10 21:31:12'),
(20, 'Telah mengubah data berita', 'Media_online', '2020-06-10 21:33:14'),
(21, 'Telah mengubah data berita', 'Media_online', '2020-06-10 21:34:02'),
(22, 'Telah mengubah data draft', 'Media_online', '2020-06-10 21:34:02'),
(23, 'Telah mengubah data berita', 'Media_online', '2020-06-10 21:35:07'),
(24, 'Telah mengubah data draft', 'Media_online', '2020-06-10 21:35:07'),
(25, 'Telah Logout dari sistem', 'Media_online', '2020-06-10 21:36:31'),
(26, 'Telah Login pada sistem', 'Admin', '2020-06-10 21:37:03'),
(27, 'Telah Login pada sistem', 'Media_radio', '2020-06-10 21:37:17'),
(28, 'Telah mengubah data berita', 'Media_radio', '2020-06-10 22:12:58'),
(29, 'Telah mengubah data draft', 'Media_radio', '2020-06-10 22:12:58'),
(30, 'Telah mengubah data berita', 'Media_radio', '2020-06-10 22:34:05'),
(31, 'Telah mengubah data draft', 'Media_radio', '2020-06-10 22:34:05'),
(32, 'Telah mengubah data berita', 'Media_radio', '2020-06-10 22:36:49'),
(33, 'Telah mengubah data draft', 'Media_radio', '2020-06-10 22:36:49'),
(34, 'Telah mengubah data berita', 'Media_radio', '2020-06-10 22:43:52'),
(35, 'Telah mengubah data draft', 'Media_radio', '2020-06-10 22:43:52'),
(36, 'Telah mengubah data berita', 'Media_radio', '2020-06-10 22:43:58'),
(37, 'Telah mengubah data draft', 'Media_radio', '2020-06-10 22:43:58'),
(38, 'Telah mengubah data berita', 'Media_radio', '2020-06-10 22:44:02'),
(39, 'Telah mengubah data draft', 'Media_radio', '2020-06-10 22:44:02'),
(40, 'Telah mengubah data berita', 'Media_radio', '2020-06-10 22:44:14'),
(41, 'Telah mengubah data draft', 'Media_radio', '2020-06-10 22:44:14'),
(42, 'Telah mengubah data berita', 'Media_radio', '2020-06-10 22:46:04'),
(43, 'Telah mengubah data draft', 'Media_radio', '2020-06-10 22:46:04'),
(44, 'Telah Logout dari sistem', 'Media_radio', '2020-06-10 22:46:28'),
(45, 'Telah Login pada sistem', 'Media_online', '2020-06-10 22:46:40'),
(46, 'Telah mengubah data berita', 'Media_online', '2020-06-10 22:46:59'),
(47, 'Telah mengubah data draft', 'Media_online', '2020-06-10 22:46:59'),
(48, 'Telah mengubah data berita', 'Media_online', '2020-06-10 22:47:13'),
(49, 'Telah mengubah data draft', 'Media_online', '2020-06-10 22:47:13'),
(50, 'Telah mengubah data berita', 'Media_online', '2020-06-10 22:48:49'),
(51, 'Telah mengubah data draft', 'Media_online', '2020-06-10 22:48:49'),
(52, 'Telah mengubah data berita', 'Media_online', '2020-06-10 22:52:21'),
(53, 'Telah mengubah data draft', 'Media_online', '2020-06-10 22:52:21'),
(54, 'Telah mengubah data berita', 'Media_online', '2020-06-10 22:55:00'),
(55, 'Telah mengubah data draft', 'Media_online', '2020-06-10 22:55:00'),
(56, 'Telah menambahkan draft terbaru', 'Media_online', '2020-06-10 22:59:33'),
(57, 'Telah menghapus data berita', 'Media_online', '2020-06-10 22:59:53'),
(58, 'Telah menambahkan draft terbaru', 'Media_online', '2020-06-10 23:00:28'),
(59, 'Telah menghapus data berita', 'Media_online', '2020-06-10 23:00:32'),
(60, 'Telah menambahkan draft terbaru', 'Media_online', '2020-06-10 23:00:55'),
(61, 'Telah mengubah data draft', 'Media_online', '2020-06-10 23:03:15'),
(62, 'Telah mengubah data draft', 'Media_online', '2020-06-10 23:05:35'),
(63, 'Telah mengubah data draft', 'Media_online', '2020-06-10 23:06:17'),
(64, 'Telah mengubah data berita', 'Media_online', '2020-06-10 23:22:21'),
(65, 'Telah mengubah data draft', 'Media_online', '2020-06-10 23:22:21'),
(66, 'Telah mengubah data berita', 'Media_online', '2020-06-10 23:22:25'),
(67, 'Telah mengubah data draft', 'Media_online', '2020-06-10 23:22:25'),
(68, 'Telah mengubah data draft', 'Media_online', '2020-06-10 23:22:36'),
(69, 'Telah menghapus data berita', 'Media_online', '2020-06-10 23:23:07'),
(70, 'Telah menambahkan draft terbaru', 'Media_online', '2020-06-10 23:23:59'),
(71, 'Telah mengubah data draft', 'Media_online', '2020-06-10 23:39:19'),
(72, 'Telah mengubah data draft', 'Media_online', '2020-06-10 23:40:21'),
(73, 'Telah mengubah data draft', 'Media_online', '2020-06-10 23:44:12'),
(74, 'Telah mengubah data draft', 'Media_online', '2020-06-10 23:44:47'),
(75, 'Telah menghapus data berita', 'Media_online', '2020-06-10 23:45:17'),
(76, 'Telah menambahkan draft terbaru', 'Media_online', '2020-06-10 23:46:13'),
(77, 'Telah menghapus data berita', 'Media_online', '2020-06-10 23:53:13'),
(78, 'Telah menambahkan draft terbaru', 'Media_online', '2020-06-10 23:55:43'),
(79, 'Telah mengubah data draft', 'Media_online', '2020-06-11 00:09:18'),
(80, 'Telah mengubah data draft', 'Media_online', '2020-06-11 00:17:21'),
(81, 'Telah mengubah data draft', 'Media_online', '2020-06-11 00:18:28'),
(82, 'Telah mengubah data draft', 'Media_online', '2020-06-11 00:19:10'),
(83, 'Telah mengubah data draft', 'Media_online', '2020-06-11 00:19:32'),
(84, 'Telah mengubah data draft', 'Media_online', '2020-06-11 00:20:11'),
(85, 'Telah mengubah data draft', 'Media_online', '2020-06-11 00:21:21'),
(86, 'Telah mengubah data draft', 'Media_online', '2020-06-11 00:23:48'),
(87, 'Telah mengubah data draft', 'Media_online', '2020-06-11 00:25:19'),
(88, 'Telah mengubah data draft', 'Media_online', '2020-06-11 00:28:09'),
(89, 'Telah mengubah data draft', 'Media_online', '2020-06-11 00:28:38'),
(90, 'Telah mengubah data draft', 'Media_online', '2020-06-11 00:30:21'),
(91, 'Telah mengubah data draft', 'Media_online', '2020-06-11 00:30:28'),
(92, 'Telah mengubah data draft', 'Media_online', '2020-06-11 00:30:49'),
(93, 'Telah mengubah data draft', 'Media_online', '2020-06-11 00:30:59'),
(94, 'Telah mengubah data draft', 'Media_online', '2020-06-11 00:31:59'),
(95, 'Telah mengubah data draft', 'Media_online', '2020-06-11 00:32:45'),
(96, 'Telah mengubah data draft', 'Media_online', '2020-06-11 00:36:33'),
(97, 'Telah mengubah data draft', 'Media_online', '2020-06-11 00:36:51'),
(98, 'Telah mengubah data draft', 'Media_online', '2020-06-11 00:37:03'),
(99, 'Telah Login pada sistem', 'Admin', '2020-06-11 09:16:11'),
(100, 'Telah Logout dari sistem', 'Admin', '2020-06-11 09:18:09'),
(101, 'Telah Login pada sistem', 'Admin', '2020-06-11 09:18:13'),
(102, 'Telah Login pada sistem', 'Media_online', '2020-06-11 09:18:26'),
(103, 'Telah Login pada sistem', 'Admin', '2020-06-11 10:07:26'),
(104, 'Telah Logout dari sistem', 'Admin', '2020-06-11 10:07:45'),
(105, 'Telah Login pada sistem', 'Media_online', '2020-06-11 10:07:49'),
(106, 'Telah Login pada sistem', 'Admin', '2020-06-15 10:10:27'),
(107, 'Telah menambahkan agenda terbaru', 'Admin', '2020-06-15 10:10:46'),
(108, 'Telah menambahkan agenda terbaru', 'Admin', '2020-06-15 10:15:31'),
(109, 'Telah Logout dari sistem', 'Admin', '2020-06-15 10:19:04'),
(110, 'Telah Login pada sistem', 'Admin', '2020-06-15 11:03:08'),
(111, 'Telah mengubah data akun', 'Admin', '2020-06-15 11:11:15'),
(112, 'Telah mengubah data akun', 'Admin', '2020-06-15 11:13:20'),
(113, 'Telah mengubah data akun', 'Admin', '2020-06-15 11:13:30'),
(114, 'Telah mengubah data akun', 'Admin', '2020-06-15 11:13:39'),
(115, 'Telah Logout dari sistem', 'Admin', '2020-06-15 11:31:01'),
(116, 'Telah Login pada sistem', 'Bupati', '2020-06-15 11:31:06'),
(117, 'Telah Login pada sistem', 'Admin', '2020-06-16 11:04:48');

-- --------------------------------------------------------

--
-- Table structure for table `tb_notifikasi`
--

CREATE TABLE `tb_notifikasi` (
  `id` int(12) NOT NULL,
  `user_pengirim` int(12) DEFAULT NULL,
  `user_penerima` int(12) DEFAULT NULL,
  `judul` text DEFAULT NULL,
  `pesan` text DEFAULT NULL,
  `link` text DEFAULT NULL,
  `dibaca` tinyint(1) DEFAULT NULL,
  `dibuat_tanggal` date DEFAULT NULL,
  `dibuat_pukul` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_notifikasi`
--

INSERT INTO `tb_notifikasi` (`id`, `user_pengirim`, `user_penerima`, `judul`, `pesan`, `link`, `dibaca`, `dibuat_tanggal`, `dibuat_pukul`) VALUES
(1, 1, 3, 'Admin Membatalkan Draft', 'Media Online Ada draft berita yang harus diperbaiki, yang berjudul Pejabat naik pangkat dengan keterangan ', 'berita', 2, '2020-06-10', '09:12:28'),
(2, 1, 3, 'Admin Memverifikasi Draft', 'Media Online draft yang berjudul Pejabat naik pangkat telah diverifikasi', 'berita', 2, '2020-06-10', '09:12:34'),
(3, 1, 3, 'Admin Membatalkan Draft', 'Media Online Ada draft berita yang harus diperbaiki, yang berjudul Pejabat naik pangkat dengan keterangan ', 'berita', 2, '2020-06-10', '09:13:32'),
(4, 1, 3, 'Admin Memverifikasi Draft', 'Media Online draft yang berjudul Pejabat naik pangkat telah diverifikasi', 'berita', 2, '2020-06-10', '09:13:37'),
(5, 1, 3, 'Admin Membatalkan Draft', 'Media Online Ada draft berita yang harus diperbaiki, yang berjudul Pejabat naik pangkat dengan keterangan ', 'berita', 2, '2020-06-10', '09:14:42'),
(6, 1, 3, 'Admin Memverifikasi Draft', 'Media Online draft yang berjudul Pejabat naik pangkat telah diverifikasi', 'berita', 2, '2020-06-10', '09:14:51'),
(7, 1, 3, 'Admin Membatalkan Draft', 'Media Online Ada draft berita yang harus diperbaiki, yang berjudul Pejabat naik pangkat dengan keterangan ', 'berita', 2, '2020-06-10', '09:16:06'),
(8, 1, 3, 'Admin Memverifikasi Draft', 'Media Online draft yang berjudul Pejabat naik pangkat telah diverifikasi', 'berita', 2, '2020-06-10', '09:16:23'),
(9, 1, 3, 'Admin Membatalkan Draft', 'Media Online Ada draft berita yang harus diperbaiki, yang berjudul Pejabat naik pangkat dengan keterangan ', 'berita', 2, '2020-06-10', '09:16:27'),
(10, 1, 3, 'Admin Memverifikasi Draft', 'Media Online draft yang berjudul Pejabat naik pangkat telah diverifikasi', 'berita', 2, '2020-06-10', '09:17:17'),
(11, 1, 3, 'Admin Membatalkan Draft', 'Media Online Ada draft berita yang harus diperbaiki, yang berjudul Pejabat naik pangkat dengan keterangan ', 'berita', 2, '2020-06-10', '09:17:31'),
(12, 1, 3, 'Admin Memverifikasi Draft', 'Media Online draft yang berjudul Pejabat naik pangkat telah diverifikasi', 'berita', 2, '2020-06-10', '09:17:41'),
(13, 1, 3, 'Admin Membatalkan Draft', 'Media Online Ada draft berita yang harus diperbaiki, yang berjudul Pejabat naik pangkat dengan keterangan ', 'berita', 2, '2020-06-10', '09:18:30'),
(14, 1, 3, 'Admin Memverifikasi Draft', 'Media Online draft yang berjudul Pejabat naik pangkat telah diverifikasi', 'berita', 2, '2020-06-10', '09:18:35'),
(15, 1, 3, 'Admin Membatalkan Draft', 'Media Online Ada draft berita yang harus diperbaiki, yang berjudul Pejabat naik pangkat dengan keterangan ', 'berita', 2, '2020-06-10', '09:19:38'),
(16, 1, 3, 'Admin Memverifikasi Draft', 'Media Online draft yang berjudul Pejabat naik pangkat telah diverifikasi', 'berita', 2, '2020-06-10', '09:19:44'),
(17, 1, 3, 'Admin Membatalkan Draft', 'Media Online Ada draft berita yang harus diperbaiki, yang berjudul Pejabat naik pangkat dengan keterangan ', 'berita', 2, '2020-06-10', '09:23:10'),
(18, 1, 3, 'Admin Memverifikasi Draft', 'Media Online draft yang berjudul Pejabat naik pangkat telah diverifikasi', 'berita', 2, '2020-06-10', '09:31:06'),
(19, 1, 4, 'Admin Memverifikasi Draft', 'Media Radio draft yang berjudul Berita tentang burung telah diverifikasi', 'berita', 1, '2020-06-10', '09:31:12'),
(20, 3, 1, 'Media Online Mengupload Berita', 'Media Online mengupload file 1591793386228.jpg pada berita yang berjudul Pejabat naik pangkat', 'berita', 2, '2020-06-10', '09:33:14'),
(21, 3, 1, 'Media Online Mengupload Berita', 'Media Online mengupload file 1591793386228.jpg pada berita yang berjudul Pejabat naik pangkat', 'berita', 2, '2020-06-10', '09:34:02'),
(22, 3, 1, 'Media Online Mengupload Berita', 'Media Online mengupload file 1591799642286.jpg pada berita yang berjudul Pejabat naik pangkat', 'berita', 2, '2020-06-10', '09:35:07'),
(23, 4, 1, 'Media Radio Mengupload Berita', 'Media Radio mengupload file  pada berita yang berjudul Berita tentang burung', 'berita', 2, '2020-06-10', '10:12:58'),
(24, 4, 1, 'Media Radio Mengupload Berita', 'Media Radio mengupload file 1591801978792.mp3 pada berita yang berjudul Berita tentang burung', 'berita', 2, '2020-06-10', '10:34:05'),
(25, 4, 1, 'Media Radio Mengupload Berita', 'Media Radio mengupload file 1591803245956.mp3 pada berita yang berjudul Berita tentang burung', 'berita', 2, '2020-06-10', '10:36:49'),
(26, 4, 1, 'Media Radio Mengupdate Berita', 'Media Radio mengupdate berita berjudul Berita tentang burung', 'berita', 2, '2020-06-10', '10:43:52'),
(27, 4, 1, 'Media Radio Mengupdate Berita', 'Media Radio mengupdate berita berjudul Berita tentang burung', 'berita', 2, '2020-06-10', '10:43:58'),
(28, 4, 1, 'Media Radio Mengupdate Berita', 'Media Radio mengupdate berita berjudul Berita tentang burung', 'berita', 2, '2020-06-10', '10:44:02'),
(29, 4, 1, 'Media Radio Mengupload Berita', 'Media Radio mengupload file 1591803409344.mp3 pada berita yang berjudul Berita tentang burung', 'berita', 2, '2020-06-10', '10:44:14'),
(30, 4, 1, 'Media Radio Mengupload Berita', 'Media Radio mengupload file 1591803854154.mp3 pada berita yang berjudul Berita tentang burung', 'berita', 2, '2020-06-10', '10:46:04'),
(31, 3, 1, 'Media Online Mengupload Berita', 'Media Online mengupload file 1591799707709.jpg pada berita yang berjudul Pejabat naik pangkat', 'berita', 2, '2020-06-10', '10:46:59'),
(32, 3, 1, 'Media Online Mengupload Berita', 'Media Online mengupload file 1591804019440.jpg pada berita yang berjudul Pejabat naik pangkat', 'berita', 2, '2020-06-10', '10:47:13'),
(33, 3, 1, 'Media Online Mengupload Berita', 'Media Online mengupload file 1591804033515.jpg pada berita yang berjudul BLT Bintan Tahap II Diserahkan Sebelum 15 Juni', 'berita', 2, '2020-06-10', '10:48:49'),
(34, 3, 1, 'Media Online Mengupdate Berita', 'Media Online mengupdate berita berjudul BLT Bintan Tahap II Diserahkan Sebelum 15 Juni', 'berita', 2, '2020-06-10', '10:52:21'),
(35, 3, 1, 'Media Online Mengupload Berita', 'Media Online mengupload file  pada berita yang berjudul BLT Bintan Tahap II Diserahkan Sebelum 15 Juni', 'berita', 2, '2020-06-10', '10:55:00'),
(36, 3, 1, 'Ada draft berita baru', 'Media Online menambahkan draft berjudul Tes', 'berita', 2, '2020-06-10', '10:59:33'),
(37, 3, 1, 'Media Online Menghapus Draft', 'Media Online menghapus draft berjudul Tes', 'berita', 2, '2020-06-10', '10:59:53'),
(38, 3, 1, 'Ada draft berita baru', 'Media Online menambahkan draft berjudul Tes', 'berita', 2, '2020-06-10', '11:00:28'),
(39, 3, 1, 'Media Online Menghapus Draft', 'Media Online menghapus draft berjudul Tes', 'berita', 2, '2020-06-10', '11:00:32'),
(40, 3, 1, 'Ada draft berita baru', 'Media Online menambahkan draft berjudul Tes', 'berita', 2, '2020-06-10', '11:00:55'),
(41, 3, 1, 'Media Online Mengubah Draft', 'Media Online mengubah draft berjudul Tes', 'berita', 2, '2020-06-10', '11:03:15'),
(42, 3, 1, 'Media Online Mengubah Draft', 'Media Online mengubah draft berjudul Tes', 'berita', 2, '2020-06-10', '11:05:35'),
(43, 3, 1, 'Media Online Mengubah Draft', 'Media Online mengubah draft berjudul Pelantikan pejabat', 'berita', 2, '2020-06-10', '11:06:17'),
(44, 3, 1, 'Media Online Mengupdate Berita', 'Media Online mengupdate berita berjudul BLT Bintan Tahap II Diserahkan Sebelum 15 Juni', 'berita', 2, '2020-06-10', '11:22:21'),
(45, 3, 1, 'Media Online Mengupdate Berita', 'Media Online mengupdate berita berjudul BLT Bintan Tahap II Diserahkan Sebelum 15 Juni', 'berita', 2, '2020-06-10', '11:22:25'),
(46, 3, 1, 'Media Online Mengubah Draft', 'Media Online mengubah draft berjudul Pelantikan pejabat', 'berita', 2, '2020-06-10', '11:22:36'),
(47, 3, 1, 'Media Online Menghapus Draft', 'Media Online menghapus draft berjudul Pelantikan pejabat', 'berita', 2, '2020-06-10', '11:23:07'),
(48, 3, 1, 'Ada draft berita baru', 'Media Online menambahkan draft berjudul Lorem Ipsum\r\n', 'berita', 2, '2020-06-10', '11:23:59'),
(49, 3, 1, 'Media Online Mengubah Draft', 'Media Online mengubah draft berjudul Lorem Ipsum\r\n', 'berita', 2, '2020-06-10', '11:39:19'),
(50, 3, 1, 'Media Online Mengubah Draft', 'Media Online mengubah draft berjudul Lorem Ipsum\r\n', 'berita', 2, '2020-06-10', '11:40:21'),
(51, 3, 1, 'Media Online Mengubah Draft', 'Media Online mengubah draft berjudul Lorem Ipsum\r\n', 'berita', 2, '2020-06-10', '11:44:12'),
(52, 3, 1, 'Media Online Mengubah Draft', 'Media Online mengubah draft berjudul Babi', 'berita', 2, '2020-06-10', '11:44:47'),
(53, 3, 1, 'Media Online Menghapus Draft', 'Media Online menghapus draft berjudul Babi', 'berita', 2, '2020-06-10', '11:45:17'),
(54, 3, 1, 'Ada draft berita baru', 'Media Online menambahkan draft berjudul Lorem Ipsum\r\n', 'berita', 2, '2020-06-10', '11:46:13'),
(55, 3, 1, 'Media Online Menghapus Draft', 'Media Online menghapus draft berjudul Lorem Ipsum\r\n', 'berita', 2, '2020-06-10', '11:53:13'),
(56, 3, 1, 'Ada draft berita baru', 'Media Online menambahkan draft berjudul Tes', 'berita', 2, '2020-06-10', '11:55:43'),
(57, 3, 1, 'Media Online Mengubah Draft', 'Media Online mengubah draft berjudul Tes', 'berita', 2, '2020-06-11', '12:09:18'),
(58, 3, 1, 'Media Online Mengubah Draft', 'Media Online mengubah draft berjudul Teros', 'berita', 2, '2020-06-11', '12:17:21'),
(59, 3, 1, 'Media Online Mengubah Draft', 'Media Online mengubah draft berjudul Tes', 'berita', 2, '2020-06-11', '12:18:28'),
(60, 3, 1, 'Media Online Mengubah Draft', 'Media Online mengubah draft berjudul Tes', 'berita', 2, '2020-06-11', '12:19:10'),
(61, 3, 1, 'Media Online Mengubah Draft', 'Media Online mengubah draft berjudul Good', 'berita', 2, '2020-06-11', '12:19:32'),
(62, 3, 1, 'Media Online Mengubah Draft', 'Media Online mengubah draft berjudul Good', 'berita', 2, '2020-06-11', '12:20:11'),
(63, 3, 1, 'Media Online Mengubah Draft', 'Media Online mengubah draft berjudul Good', 'berita', 2, '2020-06-11', '12:21:21'),
(64, 3, 1, 'Media Online Mengubah Draft', 'Media Online mengubah draft berjudul Good', 'berita', 2, '2020-06-11', '12:23:48'),
(65, 3, 1, 'Media Online Mengubah Draft', 'Media Online mengubah draft berjudul Good', 'berita', 2, '2020-06-11', '12:25:19'),
(66, 3, 1, 'Media Online Mengubah Draft', 'Media Online mengubah draft berjudul Good', 'berita', 2, '2020-06-11', '12:28:09'),
(67, 3, 1, 'Media Online Mengubah Draft', 'Media Online mengubah draft berjudul Good', 'berita', 2, '2020-06-11', '12:28:38'),
(68, 3, 1, 'Media Online Mengubah Draft', 'Media Online mengubah draft berjudul Good', 'berita', 2, '2020-06-11', '12:30:21'),
(69, 3, 1, 'Media Online Mengubah Draft', 'Media Online mengubah draft berjudul Good', 'berita', 2, '2020-06-11', '12:30:28'),
(70, 3, 1, 'Media Online Mengubah Draft', 'Media Online mengubah draft berjudul Babi mantap betul', 'berita', 2, '2020-06-11', '12:30:49'),
(71, 3, 1, 'Media Online Mengubah Draft', 'Media Online mengubah draft berjudul Babi mantap betul', 'berita', 2, '2020-06-11', '12:30:59'),
(72, 3, 1, 'Media Online Mengubah Draft', 'Media Online mengubah draft berjudul Babi mantap betul', 'berita', 2, '2020-06-11', '12:31:59'),
(73, 3, 1, 'Media Online Mengubah Draft', 'Media Online mengubah draft berjudul Babi mantap betul', 'berita', 2, '2020-06-11', '12:32:45'),
(74, 3, 1, 'Media Online Mengubah Draft', 'Media Online mengubah draft berjudul Babi mantap betul', 'berita', 2, '2020-06-11', '12:36:33'),
(75, 3, 1, 'Media Online Mengubah Draft', 'Media Online mengubah draft berjudul Babi mantap betul', 'berita', 2, '2020-06-11', '12:36:51'),
(76, 3, 1, 'Media Online Mengubah Draft', 'Media Online mengubah draft berjudul Tak ada obat', 'berita', 2, '2020-06-11', '12:37:03'),
(77, 1, 3, 'Admin Menambahkan Agenda', 'Admin menambahkan agenda berjudul asd', 'agenda', 1, '2020-06-15', '10:10:46'),
(78, 1, 4, 'Admin Menambahkan Agenda', 'Admin menambahkan agenda berjudul asd', 'agenda', 1, '2020-06-15', '10:10:46'),
(79, 1, 3, 'Admin Menambahkan Agenda', 'Admin menambahkan agenda berjudul er', 'agenda', 1, '2020-06-15', '10:15:31'),
(80, 1, 4, 'Admin Menambahkan Agenda', 'Admin menambahkan agenda berjudul er', 'agenda', 1, '2020-06-15', '10:15:31'),
(81, 7, 1, 'Ada user baru', ' Terdapat user baru dengan username Media_cetak dari media massa bernama ', 'auth', 1, '2020-06-15', '10:28:10');

-- --------------------------------------------------------

--
-- Table structure for table `tmst_jabatan`
--

CREATE TABLE `tmst_jabatan` (
  `id` int(2) NOT NULL,
  `nama_jabatan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tmst_jabatan`
--

INSERT INTO `tmst_jabatan` (`id`, `nama_jabatan`) VALUES
(1, 'Direktur'),
(2, 'Komanditer/Komisaris'),
(3, 'Pimpinan Redaksi'),
(4, 'Kabiro'),
(5, 'Wartawan/Reporter');

-- --------------------------------------------------------

--
-- Table structure for table `tmst_media_massa`
--

CREATE TABLE `tmst_media_massa` (
  `id` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  `nama_media` varchar(255) NOT NULL,
  `nama_perusahaan` varchar(255) DEFAULT NULL,
  `alamat_perusahaan` text DEFAULT NULL,
  `npwp` char(15) NOT NULL,
  `rekening` varchar(100) DEFAULT NULL,
  `no_telp` varchar(13) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `username_fb` varchar(100) DEFAULT NULL,
  `username_ig` varchar(100) DEFAULT NULL,
  `username_twitter` varchar(100) DEFAULT NULL,
  `channel_youtube` varchar(255) DEFAULT NULL,
  `pengikut_fb` int(11) DEFAULT NULL,
  `pengikut_ig` int(11) DEFAULT NULL,
  `pengikut_twitter` int(11) DEFAULT NULL,
  `subscriber_youtube` int(11) DEFAULT NULL,
  `tipe_publikasi` enum('harian','mingguan','bulanan') NOT NULL,
  `tipe_media_massa` enum('cetak','online','radio','tv') NOT NULL,
  `jumlah_saham` int(11) DEFAULT NULL,
  `mulai_mou` date NOT NULL,
  `akhir_mou` date NOT NULL,
  `batas_tanggal_post` date NOT NULL,
  `file_akta_pendirian` text DEFAULT NULL,
  `file_situ` text DEFAULT NULL,
  `file_siup` text DEFAULT NULL,
  `file_tdp` text DEFAULT NULL,
  `file_npwp` text DEFAULT NULL,
  `file_rekening` text DEFAULT NULL,
  `file_mou` text DEFAULT NULL,
  `file_logo_media` text DEFAULT NULL,
  `file_sertifikat_uji` text DEFAULT NULL,
  `file_verifikasi_pers` text DEFAULT NULL,
  `file_laporan_pajak` text DEFAULT NULL,
  `file_sertifikat` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tmst_media_massa`
--

INSERT INTO `tmst_media_massa` (`id`, `user_id`, `nama_media`, `nama_perusahaan`, `alamat_perusahaan`, `npwp`, `rekening`, `no_telp`, `email`, `username_fb`, `username_ig`, `username_twitter`, `channel_youtube`, `pengikut_fb`, `pengikut_ig`, `pengikut_twitter`, `subscriber_youtube`, `tipe_publikasi`, `tipe_media_massa`, `jumlah_saham`, `mulai_mou`, `akhir_mou`, `batas_tanggal_post`, `file_akta_pendirian`, `file_situ`, `file_siup`, `file_tdp`, `file_npwp`, `file_rekening`, `file_mou`, `file_logo_media`, `file_sertifikat_uji`, `file_verifikasi_pers`, `file_laporan_pajak`, `file_sertifikat`) VALUES
('5ee082c345548', 3, 'Media Online', 'Online Corp', 'Jl. Online', '09254294340700', '22222333222222', '081234567890', 'online@gmail.com', '@online_fb', '@online_ig', '@online_twitter', 'https://www.youtube.com/channel/UCLimOj2dG5Jw9Urwi-fzBXQ?view_as=subscriber', NULL, NULL, NULL, NULL, 'harian', 'online', 2, '2020-06-15', '2021-06-15', '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
('5ee0843b9a01e', 4, 'Media Radio', 'PT. Radio', 'Jl. Radio', '08929192828192', '20102020202919', '083221222929', 'radio@gmail.com', '@radio_fb', '@radio_ig', '@radio_twitter', 'https://www.youtube.com/watch?v=TQ8WlA2GXbk', NULL, NULL, NULL, NULL, 'harian', 'radio', 3, '2020-06-15', '2021-06-15', '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
('5ee6eacae0d45', 7, 'Media_cetak', 'Media_cetak', 'dfgdfg', 'asdasdfgdfgd', 'dfgdfg', 'dfgdfgdf', 'dfgdfg@dfgdfg.com', 'sdfsdf', 'sdfsdf', 'sdfsdf', 'dsfsfd', 5, 6, 7, 8, 'harian', 'cetak', 34, '2020-06-15', '2022-06-15', '2020-06-29', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `tmst_setting`
--

CREATE TABLE `tmst_setting` (
  `id` int(11) NOT NULL,
  `waktu` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tmst_setting`
--

INSERT INTO `tmst_setting` (`id`, `waktu`) VALUES
(1, '10:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tmst_sosmed`
--

CREATE TABLE `tmst_sosmed` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `logo` text DEFAULT NULL,
  `dibuat_tanggal` date DEFAULT NULL,
  `dibuat_pukul` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tmst_sosmed`
--

INSERT INTO `tmst_sosmed` (`id`, `nama`, `logo`, `dibuat_tanggal`, `dibuat_pukul`) VALUES
(1, 'Facebook', '1591675999720.png', '2020-06-09', '11:13:19'),
(2, 'Whatsapp', '1591608358791.png', '2020-06-08', '04:25:58'),
(3, 'Instagram', '1591608369602.png', '2020-06-08', '04:26:09'),
(4, 'Twitter', '1591608383500.png', '2020-06-08', '04:26:23');

-- --------------------------------------------------------

--
-- Table structure for table `tmst_tenaga`
--

CREATE TABLE `tmst_tenaga` (
  `id` int(11) NOT NULL,
  `media_massa_id` varchar(100) NOT NULL,
  `jabatan_id` int(2) NOT NULL,
  `nama_tenaga` varchar(255) NOT NULL,
  `nik` char(16) NOT NULL,
  `file` varchar(100) NOT NULL,
  `no_hp` varchar(14) NOT NULL,
  `file_sertifikat` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tmst_tenaga`
--

INSERT INTO `tmst_tenaga` (`id`, `media_massa_id`, `jabatan_id`, `nama_tenaga`, `nik`, `file`, `no_hp`, `file_sertifikat`) VALUES
(6, '5ee6eacae0d45', 1, 'dfgdfg', '99', '1592191690924.png', '2', '1592191690928.pdf'),
(7, '5ee6eacae0d45', 2, 'dfgdfg', '98', '1592191690932.png', '2', '1592191690935.pdf'),
(8, '5ee6eacae0d45', 3, 'dfgdfg', '87', '1592191690939.png', '2', '1592191690943.pdf'),
(9, '5ee6eacae0d45', 4, 'dfgdgf', '76', '1592191690947.png', '2', '1592191690950.pdf'),
(10, '5ee6eacae0d45', 5, 'dfgdfg', '56', '1592191690954.png', '2', '1592191690956.pdf'),
(11, '5ee6eacae0d45', 5, 'dfgdfg', '45', '1592191690960.png', '2', '1592191690963.pdf'),
(12, '5ee6eacae0d45', 5, 'fdf', '43', '1592191690967.png', '2', '1592191690970.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `tmst_user`
--

CREATE TABLE `tmst_user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` enum('superadmin','admin','user') DEFAULT NULL,
  `dibuat_pada` datetime DEFAULT NULL,
  `status` enum('aktif','registrasi','suspend') DEFAULT NULL,
  `token` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tmst_user`
--

INSERT INTO `tmst_user` (`id`, `username`, `password`, `level`, `dibuat_pada`, `status`, `token`) VALUES
(1, 'Admin', '$2y$10$Q8ub.ipbt9w0HSov64BrX.3pA8FzWFu7glSehtEhBTs7t7tHuOcCy', 'admin', '2020-06-10 11:07:59', 'aktif', NULL),
(2, 'Bupati', '$2y$10$Q8ub.ipbt9w0HSov64BrX.3pA8FzWFu7glSehtEhBTs7t7tHuOcCy', 'superadmin', '2020-06-10 11:08:28', 'aktif', NULL),
(3, 'Media_online', '$2y$10$Q8ub.ipbt9w0HSov64BrX.3pA8FzWFu7glSehtEhBTs7t7tHuOcCy', 'user', '2020-06-10 13:47:47', 'aktif', NULL),
(4, 'Media_radio', '$2y$10$Q8ub.ipbt9w0HSov64BrX.3pA8FzWFu7glSehtEhBTs7t7tHuOcCy', 'user', '2020-06-10 13:48:05', 'suspend', NULL),
(7, 'Media_cetak', '$2y$10$0XFUz93JS1Qs2VKalbwS5Ol.hJiQ9Xox7tA6q4du.qLqJyOm7f1Qy', 'user', '2020-06-15 00:00:00', 'aktif', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `keys`
--
ALTER TABLE `keys`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_agenda`
--
ALTER TABLE `tb_agenda`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_berita`
--
ALTER TABLE `tb_berita`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pk_berita_media_massa` (`media_massa_id`);

--
-- Indexes for table `tb_log`
--
ALTER TABLE `tb_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_notifikasi`
--
ALTER TABLE `tb_notifikasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tmst_jabatan`
--
ALTER TABLE `tmst_jabatan`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `tmst_media_massa`
--
ALTER TABLE `tmst_media_massa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pk_media_user` (`user_id`);

--
-- Indexes for table `tmst_setting`
--
ALTER TABLE `tmst_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tmst_sosmed`
--
ALTER TABLE `tmst_sosmed`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tmst_tenaga`
--
ALTER TABLE `tmst_tenaga`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `id_media` (`media_massa_id`,`jabatan_id`);

--
-- Indexes for table `tmst_user`
--
ALTER TABLE `tmst_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `keys`
--
ALTER TABLE `keys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_agenda`
--
ALTER TABLE `tb_agenda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_log`
--
ALTER TABLE `tb_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- AUTO_INCREMENT for table `tb_notifikasi`
--
ALTER TABLE `tb_notifikasi`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `tmst_jabatan`
--
ALTER TABLE `tmst_jabatan`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tmst_setting`
--
ALTER TABLE `tmst_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tmst_sosmed`
--
ALTER TABLE `tmst_sosmed`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tmst_tenaga`
--
ALTER TABLE `tmst_tenaga`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tmst_user`
--
ALTER TABLE `tmst_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_berita`
--
ALTER TABLE `tb_berita`
  ADD CONSTRAINT `pk_berita_media_massa` FOREIGN KEY (`media_massa_id`) REFERENCES `tmst_media_massa` (`id`);

--
-- Constraints for table `tmst_media_massa`
--
ALTER TABLE `tmst_media_massa`
  ADD CONSTRAINT `pk_media_user` FOREIGN KEY (`user_id`) REFERENCES `tmst_user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
