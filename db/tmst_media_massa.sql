-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 09, 2020 at 05:54 AM
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
-- Table structure for table `tmst_media_massa`
--

CREATE TABLE `tmst_media_massa` (
  `id` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `perusahaan` varchar(255) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `npwp` char(15) NOT NULL,
  `file_npwp` text NOT NULL,
  `rekening` varchar(100) DEFAULT NULL,
  `file_rekening` text NOT NULL,
  `pimpinan` varchar(255) NOT NULL,
  `kabiro` varchar(255) DEFAULT NULL,
  `surat_kabiro` text DEFAULT NULL,
  `no_telp` varchar(13) DEFAULT NULL,
  `wartawan` varchar(255) DEFAULT NULL,
  `sertifikat_uji` text DEFAULT NULL,
  `verifikasi_pers` text DEFAULT NULL,
  `penawaran_kerja_sama` text DEFAULT NULL,
  `tipe_publikasi` enum('harian','mingguan','bulanan') NOT NULL,
  `tipe_media_massa` varchar(255) NOT NULL,
  `mulai_mou` date NOT NULL,
  `akhir_mou` date NOT NULL,
  `file_logo_media` text NOT NULL,
  `file_sertifikat_uji` text NOT NULL,
  `file_verifikasi_pers` text NOT NULL,
  `file_penawaran_kerja_sama` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tmst_media_massa`
--

INSERT INTO `tmst_media_massa` (`id`, `user_id`, `nama`, `perusahaan`, `alamat`, `npwp`, `file_npwp`, `rekening`, `file_rekening`, `pimpinan`, `kabiro`, `surat_kabiro`, `no_telp`, `wartawan`, `sertifikat_uji`, `verifikasi_pers`, `penawaran_kerja_sama`, `tipe_publikasi`, `tipe_media_massa`, `mulai_mou`, `akhir_mou`, `file_logo_media`, `file_sertifikat_uji`, `file_verifikasi_pers`, `file_penawaran_kerja_sama`) VALUES
('5ed86c6ba5cf3', 2, 'Media Satu Sejahtera Maju Bersama', 'PT Media Satu Sejahtera', 'Alamat Test', '123456789123456', '', '0222-201002', '', 'Pemimpin Test asd', 'Kabiro Test', 'Surat Kabiro Test', '0812314151', 'Wartawan Test', 'Sertifikat Test', 'Verifikasi Test', 'Penawaran Test', 'harian', '', '2020-06-01', '2020-06-30', 'logo-5ed86c6ba5cf3.jpg', '', '', ''),
('5ede50cb9f7c9', 4, 'Media TV Sebelah', 'PT. TV Nirkabel', NULL, '001931010192', '', NULL, '', 'Bapak Kabel', NULL, NULL, '082283994855', NULL, NULL, NULL, NULL, 'mingguan', 'radio', '0000-00-00', '0000-00-00', '', '', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tmst_media_massa`
--
ALTER TABLE `tmst_media_massa`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `pk_media_user` (`user_id`) USING BTREE;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tmst_media_massa`
--
ALTER TABLE `tmst_media_massa`
  ADD CONSTRAINT `pk_media_user` FOREIGN KEY (`user_id`) REFERENCES `tmst_user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
