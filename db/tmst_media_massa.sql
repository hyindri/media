-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 09, 2020 at 04:26 AM
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
-- Table structure for table `tmst_media_massa`
--

CREATE TABLE `tmst_media_massa` (
  `id` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `perusahaan` varchar(255) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `npwp` char(15) NOT NULL,
  `file_npwp` varchar(255) NOT NULL,
  `rekening` varchar(100) DEFAULT NULL,
  `file_rekening` varchar(255) NOT NULL,
  `pimpinan` varchar(255) NOT NULL,
  `kabiro` varchar(255) DEFAULT NULL,
  `surat_kabiro` text DEFAULT NULL,
  `no_telp` varchar(13) DEFAULT NULL,
  `wartawan` varchar(255) DEFAULT NULL,
  `sertifikat_uji` text DEFAULT NULL,
  `file_sertifikat_uji` varchar(255) NOT NULL,
  `verifikasi_pers` text DEFAULT NULL,
  `file_verifikasi_pers` varchar(255) NOT NULL,
  `penawaran_kerja_sama` text DEFAULT NULL,
  `file_penawaran_kerja_sama` varchar(255) NOT NULL,
  `tipe_publikasi` enum('harian','mingguan','bulanan') NOT NULL,
  `tipe_media_massa` varchar(100) NOT NULL,
  `mulai_mou` date NOT NULL,
  `akhir_mou` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tmst_media_massa`
--

INSERT INTO `tmst_media_massa` (`id`, `user_id`, `nama`, `perusahaan`, `alamat`, `npwp`, `file_npwp`, `rekening`, `file_rekening`, `pimpinan`, `kabiro`, `surat_kabiro`, `no_telp`, `wartawan`, `sertifikat_uji`, `file_sertifikat_uji`, `verifikasi_pers`, `file_verifikasi_pers`, `penawaran_kerja_sama`, `file_penawaran_kerja_sama`, `tipe_publikasi`, `tipe_media_massa`, `mulai_mou`, `akhir_mou`) VALUES
('', 6, 'asdasd', 'asdasd', NULL, 'asdasd', '', NULL, '', 'asdasd', NULL, NULL, 'asdads', NULL, NULL, '', NULL, '', NULL, '', 'harian', 'online', '2020-06-07', '2020-06-07'),
('5ed86c6ba5cf3', 2, 'Media_satu', 'Perusahaan Test', 'Alamat Test', '123456789123456', '1591602466207.png', '0222-201002', '1591602516107.png', 'Pemimpin Test', 'Kabiro Test', 'Surat Kabiro Test', '0812314151', 'Wartawan Test', 'Sertifikat Test', '1591602556960.pdf', 'Verifikasi Test', '1591602596039.pdf', 'Penawaran Test', '1591602596044.pdf', 'harian', 'tv', '2020-06-01', '2020-06-30'),
('5eddbe70d39c7', 9, 'qweqwe', 'qweqwe', NULL, 'qweqwe', '', NULL, '', 'qweqwe', NULL, NULL, 'qweqew', NULL, NULL, '', NULL, '', NULL, '', 'harian', 'online', '2020-06-08', '2020-06-08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tmst_media_massa`
--
ALTER TABLE `tmst_media_massa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pk_media_user` (`user_id`);

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
