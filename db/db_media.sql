-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 10, 2020 at 08:19 AM
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
(1, 'Telah Login pada sistem', 'Admin', '2020-06-10 13:03:59'),
(2, 'Telah Logout dari sistem', 'Admin', '2020-06-10 13:04:11'),
(3, 'Telah Login pada sistem', 'Admin', '2020-06-10 13:18:21');

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

-- --------------------------------------------------------

--
-- Table structure for table `tmst_jabatan`
--

CREATE TABLE `tmst_jabatan` (
  `id` int(2) NOT NULL,
  `nama_jabatan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `file_laporan_pajak` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `no_hp` varchar(14) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(2, 'Bupati', '$2y$10$Q8ub.ipbt9w0HSov64BrX.3pA8FzWFu7glSehtEhBTs7t7tHuOcCy', 'superadmin', '2020-06-10 11:08:28', 'aktif', NULL);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_log`
--
ALTER TABLE `tb_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_notifikasi`
--
ALTER TABLE `tb_notifikasi`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tmst_jabatan`
--
ALTER TABLE `tmst_jabatan`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tmst_user`
--
ALTER TABLE `tmst_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
