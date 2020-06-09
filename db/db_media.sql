-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 09, 2020 at 07:32 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
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
(1, 'Agenda Rapat Bupati', '2020-06-05', 'aktif', '1591341983549.jpg', 'Admin', '2020-06-05'),
(2, 'Agenda Berkunjung ke Kecamatan Teluk Sebong', '2020-06-01', 'aktif', '1591492062330.pdf', 'Admin', '2020-06-07'),
(3, 'Risalah 9 Juli 2019', '2020-06-09', 'nonaktif', '1591589011910.pdf', 'Admin', '2020-06-08');

-- --------------------------------------------------------

--
-- Table structure for table `tb_berita`
--

CREATE TABLE `tb_berita` (
  `id` varchar(100) NOT NULL,
  `media_massa_id` varchar(100) NOT NULL,
  `judul_berita` varchar(255) NOT NULL,
  `narasi_berita` text NOT NULL,
  `link_berita` varchar(255) DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `share` text DEFAULT NULL,
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

INSERT INTO `tb_berita` (`id`, `media_massa_id`, `judul_berita`, `narasi_berita`, `link_berita`, `file`, `share`, `jumlah_view`, `status_berita`, `keterangan`, `dibuat_oleh`, `dibuat_tanggal`, `dibuat_pukul`, `diperiksa_oleh`, `diperiksa_pada`) VALUES
('5ece4797eaf5e', '5ed86c6ba5cf3', 'Tolak New Normal, Bupati Bintan Gaungkan Istilah Ini\r\n', 'Penggunaan istilah New Normal untuk menggambarkan tatanan baru dalam hidup bersama Covid-19 yang digaungkan Presiden Joko Widodo (Jokowi) mendapat penolakan dari Pemerintah Kabupaten Bintan, Provinisi Kepulauan Riau.\r\n\r\nPemkab Bintan menolak penggunaan tersebut lantaran khawatir bakal menimbulkan permasalahan di tengah masyarakat.\r\n\r\n\r\nBupati Bintan Apri Sujadi mengatakan, masyarakat beranggapan New Normal sebagai kondisi normal setelah pandemi Covid-19. Anggapan ini dapat menimbulkan permasalahan jika diimplementasikan dalam aktivitas sehari-hari.\r\n\r\n\"Anggapan New Normal sebagai keadaan normal, tentu tidak benar. Ini berbahaya bila diimplementasikan dalam kehidupan sehari-hari,\" katanya seperti dilansir Antara pada Jumat (29/5/2020).\r\n\r\nApri, yang juga Ketua Gugus Tugas Percepatan Penanganan Covid-19 Bintan, menegaskan mengganti istilah New Normal dengan kalimat beradaptasi dengan kehidupan baru. Dia menilai, kalimat itu relatif lebih mudah dipahami masyarakat, terutama yang tinggal di pulau-pulau.\r\n\r\nBeradaptasi dengan kehidupan baru berarti masyarakat mulai menyesuaikan diri dengan kondisi yang dihadapi sekarang. Untuk mencegah tidak tertular Covid-19, masyarakat tetap harus melaksanakan protokol kesehatan dalam beraktivitas.\r\n\r\n\"Penggunaan istilah yang mudah dipahami masyarakat dibutuhkan karena itu berhubungan dengan aktivitas sehari-hari, apalagi tingkat pemahaman masyarakat tidak selalu sama,\" ucapnya.', 'https://www.suara.com/news/2020/05/30/043500/tolak-new-normal-bupati-bintan-gaungkan-istilah-ini', '1591624452690.jpg', '3, 4', 200000, 'valid', NULL, 'Batam_pos', '2020-06-06', '06:41:58', 'Admin', '2020-06-08 06:41:33'),
('5ed9f20f96caa', '5ed86c6ba5cf3', 'Pesan Tegas Dandim Kepada Seluruh Prajurit', 'Komandan Distrik Militer (Dandim) 0315/Bintan Kolonel Inf I Gusti Ketut Artasuyasa meminta kepada prajurit, PNS TNI dan keluarga besar Kodim 0315/Bintan untuk bijak dalam menggunakan media sosial (medsos).\r\n\r\nDandim mengimbau anggotanya dan keluarga agar tidak pernah ikut-ikutan berpendapat terhadap sesuatu hal yang tidak ada manfaatnya, apalagi membagikan berita-berita yang tidak jelas kebenarannya.\r\n\r\n\"Gunakanlah medsos dengan baik dan bijak agar kita terhindar dari masalah yang akan merugikan kita semua,\" ujar Dandim 0315/Bintan, Kamis (21/5). Apa ni bodoh', 'https://www.jpnn.com/news/pesan-tegas-dandim-kepada-seluruh-prajurit', '1591624468685.jpg', '1, 2, 3', 20001, 'valid', NULL, 'Batam_pos', '2020-06-07', '12:02:08', 'Admin', '2020-06-09 12:20:38'),
('5edd7d2a551cf', '5ed86c6ba5cf3', 'Penyebab Listrik Padam di Batam dan Bintan', 'BATAM, KOMPAS.com - Jaringan listrik di Batam dan Kabupaten Bintan, Kepulauan Riau (Kepri) tiba-tiba mengalami gangguan pada Kamis (4/6/2020), sekitar pukul 19.27 WIB. Akibatnya, nyaris seluruh wilayah Batam dan Bintan mengalami padam listrik. Bright PLN Batam sedang berusaha keras untuk kembali menormalkan aliran listrik yang ada. Baca juga: Kapolsek Nyaris Jadi Korban Penipuan Saat Ambil Uang di ATM Diduga listrik yang padam tersebut akibat mesin pembangkit yang ada di Batam tersambar petir. General Manager PT PLN (Persero) Unit Induk Wilayah Riau dan Kepri Daru Tri Tjahjono mengatakan, terputusnya suplai listrik di Batam dan Kabupaten Bintan disebabkan oleh cuaca ekstrem. Transmisi 150 kilovolt yang menghubungkan kelistrikan antara Pulau Batam dengan Bintan tersambar petir. “Petir yang menyambar pada malam ini menyebabkan peralatan pengaman kerja kami rusak dan pasokan listrik ke Pulau Bintan terhenti sementara,” kata Daru Tri Tjahjono saat dikonfirmasi, Kamis malam. Baca juga: Bayi Disiksa secara Sadis hingga Tewas, Ayah Tiri Ditembak Polisi Daru mengungkapkan bahwa PLN bergerak cepat untuk melakukan pemulihan pada sistem kelistrikan yang terganggu. Tim Bright PLN Batam telah berada di lokasi yang tersambar petir untuk memperbaiki peralatan yang rusak. \"Jadi tidak saja Batam yang mengalami pemadaman, Pulau Bintan juga mengalami pemadaman yang cukup parah,\" kata Daru.', 'https://regional.kompas.com/read/2020/06/04/22135841/penyebab-listrik-padam-di-batam-dan-bintan', '1591629274230.jpg', '1, 2, 3, 4', 20322, 'valid', NULL, 'Batam_pos', '2020-06-08', '06:50:02', 'Admin', '2020-06-08 10:13:42'),
('5ede34e4af585', '5edc3b47386e6', 'Berita tentang burung', '\"hm, tu buyung apa?\"\r\n\r\n\"Buyung puyoh ga tu atas tu?\"\r\n\r\n\"Tu buyung apa tu? ha?\"\r\n\"buyung apa? buyung puyoh\"\r\n\r\n\"buyung puyoh?\"\r\n\r\n\"buyung puyoh kat mane?\"\r\n\r\n\"tu buyung apa tu? buyung puyoh?\r\n\r\n\"Buyung apa tuh? buyung puyoh~\"\r\n\r\n\"Man buyung ape tuh Man? buyung puyuh~\"\r\n\"udah\"\r\n\r\nSfx* hehaha\r\n\"hmm\"\r\n\r\n\"ee.. itu je?\"\r\n\"hem\"\r\n\r\n\"satu pencubaan yang... yang mantap... ya\"\r\n\"mantap, mantap\"\r\n\r\n\"cume saya kasih dulu banyak belajar tentang burong ya\"', 'https://www.youtube.com/watch?v=UVPSPajTB9E', '1591627231531.mp3', '2, 4', 2002, 'valid', NULL, 'Tanjungpinang_pos', '2020-06-08', '09:36:23', 'Admin', '2020-06-09 12:31:28');

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
(1, 'Telah Logout dari sistem', 'Batam_pos', '2020-06-08 19:53:40'),
(2, 'Telah Login pada sistem', 'Tanjungpinang_pos', '2020-06-08 19:53:43'),
(3, 'Telah menambahkan draft terbaru', 'Tanjungpinang_pos', '2020-06-08 19:53:56'),
(4, 'Telah Login pada sistem', 'Admin', '2020-06-08 19:54:14'),
(5, 'Telah verifikasi data berita', 'Admin', '2020-06-08 19:54:25'),
(6, 'Telah mengubah data berita', 'Tanjungpinang_pos', '2020-06-08 20:43:00'),
(7, 'Telah mengubah data draft', 'Tanjungpinang_pos', '2020-06-08 20:43:00'),
(8, 'Telah mengubah data berita', 'Tanjungpinang_pos', '2020-06-08 20:43:41'),
(9, 'Telah mengubah data draft', 'Tanjungpinang_pos', '2020-06-08 20:43:41'),
(10, 'Telah mengubah data berita', 'Tanjungpinang_pos', '2020-06-08 20:44:13'),
(11, 'Telah mengubah data draft', 'Tanjungpinang_pos', '2020-06-08 20:44:13'),
(12, 'Telah Logout dari sistem', 'Tanjungpinang_pos', '2020-06-08 20:53:25'),
(13, 'Telah Login pada sistem', 'Batam_pos', '2020-06-08 20:53:29'),
(14, 'Telah mengubah data berita', 'Batam_pos', '2020-06-08 20:54:12'),
(15, 'Telah mengubah data draft', 'Batam_pos', '2020-06-08 20:54:12'),
(16, 'Telah mengubah data berita', 'Batam_pos', '2020-06-08 20:54:28'),
(17, 'Telah mengubah data draft', 'Batam_pos', '2020-06-08 20:54:28'),
(18, 'Telah Logout dari sistem', 'Batam_pos', '2020-06-08 20:56:23'),
(19, 'Telah Login pada sistem', 'Tanjungpinang_pos', '2020-06-08 20:59:04'),
(20, 'Telah verifikasi data berita', 'Admin', '2020-06-08 21:06:25'),
(21, 'Telah mengubah data draft', 'Tanjungpinang_pos', '2020-06-08 21:07:01'),
(22, 'Telah verifikasi data berita', 'Admin', '2020-06-08 21:07:18'),
(23, 'Telah mengubah data berita', 'Tanjungpinang_pos', '2020-06-08 21:12:33'),
(24, 'Telah mengubah data draft', 'Tanjungpinang_pos', '2020-06-08 21:12:33'),
(25, 'Telah mengubah data berita', 'Tanjungpinang_pos', '2020-06-08 21:17:35'),
(26, 'Telah mengubah data draft', 'Tanjungpinang_pos', '2020-06-08 21:17:35'),
(27, 'Telah mengubah data berita', 'Tanjungpinang_pos', '2020-06-08 21:20:30'),
(28, 'Telah mengubah data draft', 'Tanjungpinang_pos', '2020-06-08 21:20:30'),
(29, 'Telah mengubah data berita', 'Tanjungpinang_pos', '2020-06-08 21:34:26'),
(30, 'Telah mengubah data draft', 'Tanjungpinang_pos', '2020-06-08 21:34:26'),
(31, 'Telah mengubah data berita', 'Tanjungpinang_pos', '2020-06-08 21:34:58'),
(32, 'Telah mengubah data draft', 'Tanjungpinang_pos', '2020-06-08 21:34:58'),
(33, 'Telah mengubah data berita', 'Tanjungpinang_pos', '2020-06-08 21:35:41'),
(34, 'Telah mengubah data draft', 'Tanjungpinang_pos', '2020-06-08 21:35:41'),
(35, 'Telah verifikasi data berita', 'Admin', '2020-06-08 21:35:51'),
(36, 'Telah mengubah data draft', 'Tanjungpinang_pos', '2020-06-08 21:36:23'),
(37, 'Telah verifikasi data berita', 'Admin', '2020-06-08 21:36:33'),
(38, 'Telah mengubah data berita', 'Tanjungpinang_pos', '2020-06-08 21:37:07'),
(39, 'Telah mengubah data draft', 'Tanjungpinang_pos', '2020-06-08 21:37:07'),
(40, 'Telah mengubah data berita', 'Tanjungpinang_pos', '2020-06-08 21:38:01'),
(41, 'Telah mengubah data draft', 'Tanjungpinang_pos', '2020-06-08 21:38:01'),
(42, 'Telah mengubah data berita', 'Tanjungpinang_pos', '2020-06-08 21:38:51'),
(43, 'Telah mengubah data draft', 'Tanjungpinang_pos', '2020-06-08 21:38:51'),
(44, 'Telah mengubah data berita', 'Tanjungpinang_pos', '2020-06-08 21:40:31'),
(45, 'Telah mengubah data draft', 'Tanjungpinang_pos', '2020-06-08 21:40:31'),
(46, 'Telah mengubah data berita', 'Tanjungpinang_pos', '2020-06-08 21:44:03'),
(47, 'Telah mengubah data draft', 'Tanjungpinang_pos', '2020-06-08 21:44:03'),
(48, 'Telah Logout dari sistem', 'Tanjungpinang_pos', '2020-06-08 21:52:21'),
(49, 'Telah Login pada sistem', 'Batam_pos', '2020-06-08 21:52:24'),
(50, 'Telah Logout dari sistem', 'Batam_pos', '2020-06-08 21:52:42'),
(51, 'Telah Login pada sistem', 'Tanjungpinang_pos', '2020-06-08 21:52:48'),
(52, 'Telah mengubah data berita', 'Tanjungpinang_pos', '2020-06-08 21:52:58'),
(53, 'Telah mengubah data draft', 'Tanjungpinang_pos', '2020-06-08 21:52:58'),
(54, 'Telah Logout dari sistem', 'Tanjungpinang_pos', '2020-06-08 22:04:50'),
(55, 'Telah Login pada sistem', 'Batam_pos', '2020-06-08 22:04:55'),
(56, 'Telah verifikasi data berita', 'Admin', '2020-06-08 22:13:42'),
(57, 'Telah mengubah data berita', 'Batam_pos', '2020-06-08 22:14:34'),
(58, 'Telah mengubah data draft', 'Batam_pos', '2020-06-08 22:14:34'),
(59, 'Telah mengubah data berita', 'Batam_pos', '2020-06-08 23:05:15'),
(60, 'Telah mengubah data draft', 'Batam_pos', '2020-06-08 23:05:15'),
(61, 'Telah mengubah data berita', 'Batam_pos', '2020-06-08 23:07:17'),
(62, 'Telah mengubah data draft', 'Batam_pos', '2020-06-08 23:07:17'),
(63, 'Telah mengubah data berita', 'Batam_pos', '2020-06-08 23:07:25'),
(64, 'Telah mengubah data draft', 'Batam_pos', '2020-06-08 23:07:25'),
(65, 'Telah mengubah data berita', 'Batam_pos', '2020-06-08 23:09:50'),
(66, 'Telah mengubah data draft', 'Batam_pos', '2020-06-08 23:09:50'),
(67, 'Telah mengubah data berita', 'Batam_pos', '2020-06-08 23:09:54'),
(68, 'Telah mengubah data draft', 'Batam_pos', '2020-06-08 23:09:54'),
(69, 'Telah Logout dari sistem', 'Batam_pos', '2020-06-08 23:09:57'),
(70, 'Telah Login pada sistem', 'Tanjungpinang_pos', '2020-06-08 23:10:00'),
(71, 'Telah mengubah data berita', 'Tanjungpinang_pos', '2020-06-08 23:10:14'),
(72, 'Telah mengubah data draft', 'Tanjungpinang_pos', '2020-06-08 23:10:14'),
(73, 'Telah Logout dari sistem', 'Tanjungpinang_pos', '2020-06-08 23:10:26'),
(74, 'Telah Login pada sistem', 'Batam_pos', '2020-06-08 23:10:32'),
(75, 'Telah mengubah data berita', 'Batam_pos', '2020-06-08 23:29:12'),
(76, 'Telah mengubah data draft', 'Batam_pos', '2020-06-08 23:29:12'),
(77, 'Telah mengubah data berita', 'Batam_pos', '2020-06-08 23:29:23'),
(78, 'Telah mengubah data draft', 'Batam_pos', '2020-06-08 23:29:23'),
(79, 'Telah Login pada sistem', 'Admin', '2020-06-09 09:29:40'),
(80, 'Telah Logout dari sistem', 'Admin', '2020-06-09 09:29:50'),
(81, 'Telah Login pada sistem', 'Batam_pos', '2020-06-09 09:29:55'),
(82, 'Telah Logout dari sistem', 'Batam_pos', '2020-06-09 11:24:44'),
(83, 'Telah Login pada sistem', 'Batam_pos', '2020-06-09 11:26:34'),
(84, 'Telah mengubah data profil', 'Batam_pos', '2020-06-09 11:33:35'),
(85, 'Telah Login pada sistem', 'Batam_pos', '2020-06-09 11:33:40'),
(86, 'Telah mengubah data profil', 'Batam_pos', '2020-06-09 11:33:54'),
(87, 'Telah Login pada sistem', 'Batam_pos', '2020-06-09 11:34:50'),
(88, 'Telah mengubah data profil', 'Batam_pos', '2020-06-09 11:34:58'),
(89, 'Telah Login pada sistem', 'Batam_pos', '2020-06-09 11:35:03'),
(90, 'Telah mengubah data profil', 'Batam_pos', '2020-06-09 11:35:26'),
(91, 'Telah Login pada sistem', 'Batam_pos', '2020-06-09 11:35:30'),
(92, 'Telah Logout dari sistem', 'Batam_pos', '2020-06-09 11:37:16'),
(93, 'Telah Login pada sistem', 'Admin', '2020-06-09 11:37:19'),
(94, 'Telah Logout dari sistem', 'Admin', '2020-06-09 11:37:32'),
(95, 'Telah Login pada sistem', 'Tanjungpinang_pos', '2020-06-09 11:37:34'),
(96, 'Telah Logout dari sistem', 'Tanjungpinang_pos', '2020-06-09 11:37:53'),
(97, 'Telah Login pada sistem', 'Admin', '2020-06-09 11:37:59'),
(98, 'Telah Logout dari sistem', 'Admin', '2020-06-09 11:38:19'),
(99, 'Telah Login pada sistem', 'Batam_pos', '2020-06-09 11:38:26'),
(100, 'Telah Logout dari sistem', 'Batam_pos', '2020-06-09 11:40:48'),
(101, 'Telah Logout dari sistem', NULL, '2020-06-09 11:40:49'),
(102, 'Telah Login pada sistem', 'Admin', '2020-06-09 11:40:51'),
(103, 'Telah verifikasi data berita', 'Admin', '2020-06-09 11:42:12'),
(104, 'Telah verifikasi data berita', 'Admin', '2020-06-09 11:43:07'),
(105, 'Telah Logout dari sistem', 'Admin', '2020-06-09 11:58:17'),
(106, 'Telah Login pada sistem', 'Batam_pos', '2020-06-09 11:58:20'),
(107, 'Telah Logout dari sistem', 'Batam_pos', '2020-06-09 11:58:36'),
(108, 'Telah Login pada sistem', 'Admin', '2020-06-09 11:58:43'),
(109, 'Telah Logout dari sistem', 'Admin', '2020-06-09 12:02:10'),
(110, 'Telah Login pada sistem', 'Batam_pos', '2020-06-09 12:02:12'),
(111, 'Telah Logout dari sistem', 'Batam_pos', '2020-06-09 12:02:31'),
(112, 'Telah Login pada sistem', 'Bupati', '2020-06-09 12:02:34'),
(113, 'Telah Logout dari sistem', 'Bupati', '2020-06-09 12:08:05'),
(114, 'Telah Login pada sistem', 'Admin', '2020-06-09 12:08:08'),
(115, 'Telah verifikasi data berita', 'Admin', '2020-06-09 12:08:48'),
(116, 'Telah Logout dari sistem', 'Admin', '2020-06-09 12:08:51'),
(117, 'Telah Login pada sistem', 'Admin', '2020-06-09 12:08:53'),
(118, 'Telah verifikasi data berita', 'Admin', '2020-06-09 12:09:03'),
(119, 'Telah Logout dari sistem', 'Admin', '2020-06-09 12:09:05'),
(120, 'Telah Login pada sistem', 'Bupati', '2020-06-09 12:09:08'),
(121, 'Telah Logout dari sistem', 'Bupati', '2020-06-09 12:17:40'),
(122, 'Telah Login pada sistem', 'Admin', '2020-06-09 12:17:43'),
(123, 'Telah verifikasi data berita', 'Admin', '2020-06-09 12:20:38'),
(124, 'Telah Logout dari sistem', 'Admin', '2020-06-09 12:20:50'),
(125, 'Telah Login pada sistem', 'Batam_pos', '2020-06-09 12:20:54'),
(126, 'Telah mengubah data berita', 'Batam_pos', '2020-06-09 12:21:02'),
(127, 'Telah mengubah data draft', 'Batam_pos', '2020-06-09 12:21:02'),
(128, 'Telah Logout dari sistem', 'Batam_pos', '2020-06-09 12:21:04'),
(129, 'Telah Login pada sistem', 'Admin', '2020-06-09 12:21:09'),
(130, 'Telah verifikasi data berita', 'Admin', '2020-06-09 12:24:23'),
(131, 'Telah verifikasi data berita', 'Admin', '2020-06-09 12:24:33'),
(132, 'Telah verifikasi data berita', 'Admin', '2020-06-09 12:27:10'),
(133, 'Telah Logout dari sistem', 'Admin', '2020-06-09 12:27:12'),
(134, 'Telah Login pada sistem', 'Batam_pos', '2020-06-09 12:27:16'),
(135, 'Telah Logout dari sistem', 'Batam_pos', '2020-06-09 12:27:24'),
(136, 'Telah Login pada sistem', 'Tanjungpinang_pos', '2020-06-09 12:27:26'),
(137, 'Telah Logout dari sistem', 'Tanjungpinang_pos', '2020-06-09 12:30:18'),
(138, 'Telah Login pada sistem', 'Admin', '2020-06-09 12:30:20'),
(139, 'Telah verifikasi data berita', 'Admin', '2020-06-09 12:30:26'),
(140, 'Telah Logout dari sistem', 'Admin', '2020-06-09 12:30:31'),
(141, 'Telah Login pada sistem', 'Batam_pos', '2020-06-09 12:30:34'),
(142, 'Telah Logout dari sistem', 'Batam_pos', '2020-06-09 12:30:38'),
(143, 'Telah Login pada sistem', 'Tanjungpinang_pos', '2020-06-09 12:30:40'),
(144, 'Telah Login pada sistem', 'Admin', '2020-06-09 12:30:56'),
(145, 'Telah verifikasi data berita', 'Admin', '2020-06-09 12:31:11'),
(146, 'Telah verifikasi data berita', 'Admin', '2020-06-09 12:31:28'),
(147, 'Telah mengubah data berita', 'Tanjungpinang_pos', '2020-06-09 12:31:41'),
(148, 'Telah mengubah data draft', 'Tanjungpinang_pos', '2020-06-09 12:31:41');

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
(1, 4, 1, 'Tanjungpinang Pos Mengupdate Berita', 'Tanjungpinang Pos mengupdate berita berjudul Berita tentang burung', 'berita', 2, '2020-06-08', '09:52:58'),
(2, 1, 2, 'Admin Memverifikasi Draft', 'Batam Pos draft anda yang berjudul Penyebab Listrik Padam di Batam dan Bintan telah diverifikasi', 'berita', 2, '2020-06-08', '10:13:42'),
(3, 2, 1, 'Batam Pos Mengupload Berita', 'Batam Pos mengupload file 1591586251313.jpg pada berita yang berjudul Penyebab Listrik Padam di Batam dan Bintan', 'berita', 2, '2020-06-08', '10:14:34'),
(4, 2, 1, 'Batam Pos Mengupdate Berita', 'Batam Pos mengupdate berita berjudul Penyebab Listrik Padam di Batam dan Bintan', 'berita', 2, '2020-06-08', '11:05:15'),
(5, 2, 1, 'Batam Pos Mengupdate Berita', 'Batam Pos mengupdate berita berjudul Penyebab Listrik Padam di Batam dan Bintan', 'berita', 2, '2020-06-08', '11:07:17'),
(6, 2, 1, 'Batam Pos Mengupdate Berita', 'Batam Pos mengupdate berita berjudul Penyebab Listrik Padam di Batam dan Bintan', 'berita', 2, '2020-06-08', '11:07:25'),
(7, 2, 1, 'Batam Pos Mengupdate Berita', 'Batam Pos mengupdate berita berjudul Pesan Tegas Dandim Kepada Seluruh Prajurit', 'berita', 2, '2020-06-08', '11:09:50'),
(8, 2, 1, 'Batam Pos Mengupdate Berita', 'Batam Pos mengupdate berita berjudul Tolak New Normal, Bupati Bintan Gaungkan Istilah Ini\r\n', 'berita', 2, '2020-06-08', '11:09:54'),
(9, 4, 1, 'Tanjungpinang Pos Mengupdate Berita', 'Tanjungpinang Pos mengupdate berita berjudul Berita tentang burung', 'berita', 2, '2020-06-08', '11:10:14'),
(10, 2, 1, 'Batam Pos Mengupdate Berita', 'Batam Pos mengupdate berita berjudul Tolak New Normal, Bupati Bintan Gaungkan Istilah Ini\r\n', 'berita', 2, '2020-06-08', '11:29:12'),
(11, 2, 1, 'Batam Pos Mengupdate Berita', 'Batam Pos mengupdate berita berjudul Pesan Tegas Dandim Kepada Seluruh Prajurit', 'berita', 2, '2020-06-08', '11:29:23'),
(12, 1, 4, 'Admin Membatalkan Draft', 'Tanjungpinang Pos Ada draft berita yang harus diperbaiki, yang berjudul Berita tentang burung', 'berita', 1, '2020-06-09', '11:42:12'),
(13, 1, 4, 'Admin Memverifikasi Draft', 'Tanjungpinang Pos draft anda yang berjudul Berita tentang burung telah diverifikasi', 'berita', 1, '2020-06-09', '11:43:06'),
(14, 1, 4, 'Admin Membatalkan Draft', 'Tanjungpinang Pos Ada draft berita yang harus diperbaiki, yang berjudul Berita tentang burung', 'berita', 1, '2020-06-09', '12:08:48'),
(15, 1, 4, 'Admin Memverifikasi Draft', 'Tanjungpinang Pos draft anda yang berjudul Berita tentang burung telah diverifikasi', 'berita', 1, '2020-06-09', '12:09:03'),
(16, 1, 2, 'Admin Memverifikasi Draft', 'Batam Pos draft anda yang berjudul Pesan Tegas Dandim Kepada Seluruh Prajurit telah diverifikasi', 'berita', 1, '2020-06-09', '12:20:38'),
(17, 2, 1, 'Batam Pos Mengupdate Berita', 'Batam Pos mengupdate berita berjudul Pesan Tegas Dandim Kepada Seluruh Prajurit', 'berita', 1, '2020-06-09', '12:21:02'),
(18, 1, 4, 'Admin Membatalkan Draft', 'Tanjungpinang Pos Ada draft berita yang harus diperbaiki, yang berjudul Berita tentang burung', 'berita', 1, '2020-06-09', '12:24:23'),
(19, 1, 4, 'Admin Memverifikasi Draft', 'Tanjungpinang Pos draft anda yang berjudul Berita tentang burung telah diverifikasi', 'berita', 1, '2020-06-09', '12:24:33'),
(20, 1, 4, 'Admin Membatalkan Draft', 'Tanjungpinang Pos Ada draft berita yang harus diperbaiki, yang berjudul Berita tentang burung', 'berita', 1, '2020-06-09', '12:27:10'),
(21, 1, 4, 'Admin Membatalkan Draft', 'Tanjungpinang Pos Ada draft berita yang harus diperbaiki, yang berjudul Berita tentang burung', 'berita', 1, '2020-06-09', '12:30:26'),
(22, 1, 4, 'Admin Membatalkan Draft', 'Tanjungpinang Pos Ada draft berita yang harus diperbaiki, yang berjudul Berita tentang burung', 'berita', 1, '2020-06-09', '12:31:11'),
(23, 1, 4, 'Admin Memverifikasi Draft', 'Tanjungpinang Pos draft anda yang berjudul Berita tentang burung telah diverifikasi', 'berita', 1, '2020-06-09', '12:31:28'),
(24, 4, 1, 'Tanjungpinang Pos Mengupdate Berita', 'Tanjungpinang Pos mengupdate berita berjudul Berita tentang burung', 'berita', 1, '2020-06-09', '12:31:41');

-- --------------------------------------------------------

--
-- Table structure for table `tmst_media_massa`
--

CREATE TABLE `tmst_media_massa` (
  `id` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `perusahaan` varchar(255) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `npwp` char(15) NOT NULL,
  `rekening` varchar(100) DEFAULT NULL,
  `pimpinan` varchar(255) NOT NULL,
  `kabiro` varchar(255) DEFAULT NULL,
  `surat_kabiro` text DEFAULT NULL,
  `no_telp` varchar(13) DEFAULT NULL,
  `wartawan` varchar(255) DEFAULT NULL,
  `sertifikat_uji` text DEFAULT NULL,
  `verifikasi_pers` text DEFAULT NULL,
  `penawaran_kerja_sama` text DEFAULT NULL,
  `tipe_publikasi` enum('harian','mingguan','bulanan') NOT NULL,
  `tipe_media_massa` varchar(100) NOT NULL,
  `mulai_mou` date NOT NULL,
  `akhir_mou` date NOT NULL,
  `file_npwp` text DEFAULT NULL,
  `file_rekening` text DEFAULT NULL,
  `file_mou` text DEFAULT NULL,
  `file_logo_media` text DEFAULT NULL,
  `file_sertifikat_uji` text DEFAULT NULL,
  `file_penawaran_kerja_sama` text DEFAULT NULL,
  `file_verifikasi_pers` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tmst_media_massa`
--

INSERT INTO `tmst_media_massa` (`id`, `user_id`, `nama`, `perusahaan`, `alamat`, `npwp`, `rekening`, `pimpinan`, `kabiro`, `surat_kabiro`, `no_telp`, `wartawan`, `sertifikat_uji`, `verifikasi_pers`, `penawaran_kerja_sama`, `tipe_publikasi`, `tipe_media_massa`, `mulai_mou`, `akhir_mou`, `file_npwp`, `file_rekening`, `file_mou`, `file_logo_media`, `file_sertifikat_uji`, `file_penawaran_kerja_sama`, `file_verifikasi_pers`) VALUES
('5ed86c6ba5cf3', 2, 'Batam Pos', 'PT Batam Multimedia Korporindo', 'Gedung Graha Pena Batam Lantai 2, Batam Center.', '123456789123456', '0222-201002', 'Putut Ariyotejo', 'Candra Ibrahim', 'File', '(0778) 460 00', 'Bambang Suparno', 'File', 'File', 'File', 'harian', 'online', '2020-06-01', '2020-06-30', NULL, NULL, NULL, 'logo-5ed86c6ba5cf3.png', NULL, NULL, NULL),
('5edc3b47386e6', 4, 'Tanjungpinang Pos', 'PT. Batam Intermedia Pers', 'Komplek Pinlang Mas No. 15 Lt. 2-3, Jl. DI. Panjaitan\r\nBatu IX Tanjung Pinang, Kepri', '123456789123456', '0222-201002', 'M. Nur Hakim', 'Usep Rahmat Syaefullah', 'File', '(0771) 744723', 'Sigik Rachmat', 'File', 'File', 'File', 'harian', 'radio', '2020-06-01', '2020-06-30', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

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
-- Table structure for table `tmst_user`
--

CREATE TABLE `tmst_user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` enum('superadmin','admin','user') DEFAULT NULL,
  `dibuat_pada` datetime DEFAULT NULL,
  `status` enum('aktif','registrasi','suspend') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tmst_user`
--

INSERT INTO `tmst_user` (`id`, `username`, `password`, `level`, `dibuat_pada`, `status`) VALUES
(1, 'Admin', '$2y$10$Q8ub.ipbt9w0HSov64BrX.3pA8FzWFu7glSehtEhBTs7t7tHuOcCy', 'admin', '2020-06-03 14:09:45', 'aktif'),
(2, 'Batam_pos', '$2y$10$Q8ub.ipbt9w0HSov64BrX.3pA8FzWFu7glSehtEhBTs7t7tHuOcCy', 'user', '2020-06-05 01:36:01', 'aktif'),
(3, 'Bupati', '$2y$10$Q8ub.ipbt9w0HSov64BrX.3pA8FzWFu7glSehtEhBTs7t7tHuOcCy', 'superadmin', '2020-06-05 14:40:08', 'aktif'),
(4, 'Tanjungpinang_pos', '$2y$10$Q8ub.ipbt9w0HSov64BrX.3pA8FzWFu7glSehtEhBTs7t7tHuOcCy', 'user', '2020-06-07 07:55:59', 'aktif');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_log`
--
ALTER TABLE `tb_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=149;

--
-- AUTO_INCREMENT for table `tb_notifikasi`
--
ALTER TABLE `tb_notifikasi`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

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
