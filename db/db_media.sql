-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 04, 2020 at 11:29 AM
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
-- Table structure for table `tb_agenda`
--

CREATE TABLE `tb_agenda` (
  `id` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `status` enum('aktif','nonaktif') DEFAULT NULL,
  `file` varchar(255) NOT NULL,
  `dibuat_oleh` varchar(255) DEFAULT NULL,
  `dibuat_pada` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_berita`
--

CREATE TABLE `tb_berita` (
  `id` varchar(100) NOT NULL,
  `media_massa_id` varchar(100) NOT NULL,
  `link_berita` varchar(255) NOT NULL,
  `screenshoot` varchar(255) NOT NULL,
  `share` text NOT NULL,
  `jumlah_view` int(11) NOT NULL,
  `status_berita` enum('oke','belum') NOT NULL,
  `keterangan` text NOT NULL,
  `dibuat_oleh` varchar(255) NOT NULL,
  `dibuat_tanggal` date NOT NULL,
  `dibuat_pukul` time NOT NULL,
  `diperiksa_oleh` varchar(255) DEFAULT NULL,
  `diperiksa_pada` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_berita`
--

INSERT INTO `tb_berita` (`id`, `media_massa_id`, `link_berita`, `screenshoot`, `share`, `jumlah_view`, `status_berita`, `keterangan`, `dibuat_oleh`, `dibuat_tanggal`, `dibuat_pukul`, `diperiksa_oleh`, `diperiksa_pada`) VALUES
('5ece4797eaf5e', '5ed86c6ba5cf3', 'https://www.suara.com/tag/bintan', 'ss.jpg', 'Share Test', 20, 'oke', '', 'Media Satu', '2020-06-04', '01:41:17', 'Admin', '2020-06-04 03:44:34');

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
  `akhir_mou` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tmst_media_massa`
--

INSERT INTO `tmst_media_massa` (`id`, `user_id`, `nama`, `perusahaan`, `alamat`, `npwp`, `rekening`, `pimpinan`, `kabiro`, `surat_kabiro`, `no_telp`, `wartawan`, `sertifikat_uji`, `verifikasi_pers`, `penawaran_kerja_sama`, `tipe_publikasi`, `tipe_media_massa`, `mulai_mou`, `akhir_mou`) VALUES
('5ed86c6ba5cf3', 2, 'Media satu', 'Perusahaan Test', 'Alamat Test', '123456789123456', '0222-201002', 'Pemimpin Test', 'Kabiro Test', 'Surat Kabiro Test', '0812314151', 'Wartawan Test', 'Sertifikat Test', 'Verifikasi Test', 'Penawaran Test', 'harian', 'cetak', '2020-06-01', '2020-06-30');

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
(1, '12:23:00');

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
(2, 'Media_satu', '$2y$10$Q8ub.ipbt9w0HSov64BrX.3pA8FzWFu7glSehtEhBTs7t7tHuOcCy', 'user', '2020-06-05 01:36:01', 'aktif');

--
-- Indexes for dumped tables
--

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
-- Indexes for table `tmst_user`
--
ALTER TABLE `tmst_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_agenda`
--
ALTER TABLE `tb_agenda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_log`
--
ALTER TABLE `tb_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tmst_setting`
--
ALTER TABLE `tmst_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tmst_user`
--
ALTER TABLE `tmst_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
