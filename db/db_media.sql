-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 06, 2020 at 02:09 PM
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
(1, 'Agenda Rapat Bupati', '2020-06-05', 'aktif', '1591341983549.jpg', 'Admin', '2020-06-05');

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
  `screenshoot` varchar(255) DEFAULT NULL,
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

INSERT INTO `tb_berita` (`id`, `media_massa_id`, `judul_berita`, `narasi_berita`, `link_berita`, `screenshoot`, `share`, `jumlah_view`, `status_berita`, `keterangan`, `dibuat_oleh`, `dibuat_tanggal`, `dibuat_pukul`, `diperiksa_oleh`, `diperiksa_pada`) VALUES
('5ece4797eaf5e', '5ed86c6ba5cf3', 'Tolak New Normal, Bupati Bintan Gaungkan Istilah Ini\r\n', 'Penggunaan istilah New Normal untuk menggambarkan tatanan baru dalam hidup bersama Covid-19 yang digaungkan Presiden Joko Widodo (Jokowi) mendapat penolakan dari Pemerintah Kabupaten Bintan, Provinisi Kepulauan Riau.\r\n\r\nPemkab Bintan menolak penggunaan tersebut lantaran khawatir bakal menimbulkan permasalahan di tengah masyarakat.\r\n\r\n\r\nBupati Bintan Apri Sujadi mengatakan, masyarakat beranggapan New Normal sebagai kondisi normal setelah pandemi Covid-19. Anggapan ini dapat menimbulkan permasalahan jika diimplementasikan dalam aktivitas sehari-hari.\r\n\r\n\"Anggapan New Normal sebagai keadaan normal, tentu tidak benar. Ini berbahaya bila diimplementasikan dalam kehidupan sehari-hari,\" katanya seperti dilansir Antara pada Jumat (29/5/2020).\r\n\r\nApri, yang juga Ketua Gugus Tugas Percepatan Penanganan Covid-19 Bintan, menegaskan mengganti istilah New Normal dengan kalimat beradaptasi dengan kehidupan baru. Dia menilai, kalimat itu relatif lebih mudah dipahami masyarakat, terutama yang tinggal di pulau-pulau.\r\n\r\nBeradaptasi dengan kehidupan baru berarti masyarakat mulai menyesuaikan diri dengan kondisi yang dihadapi sekarang. Untuk mencegah tidak tertular Covid-19, masyarakat tetap harus melaksanakan protokol kesehatan dalam beraktivitas.\r\n\r\n\"Penggunaan istilah yang mudah dipahami masyarakat dibutuhkan karena itu berhubungan dengan aktivitas sehari-hari, apalagi tingkat pemahaman masyarakat tidak selalu sama,\" ucapnya.', 'https://www.suara.com/news/2020/05/30/043500/tolak-new-normal-bupati-bintan-gaungkan-istilah-ini', '1591341605410.jpg', 'Instagram, Facebook, Whatsapp', 200000, 'oke', NULL, 'Media_satu', '2020-06-05', '02:20:05', 'Admin', '2020-06-06 06:41:19'),
('5ed9f20f96caa', '5ed86c6ba5cf3', 'Pesan Tegas Dandim Kepada Seluruh Prajurit', 'Komandan Distrik Militer (Dandim) 0315/Bintan Kolonel Inf I Gusti Ketut Artasuyasa meminta kepada prajurit, PNS TNI dan keluarga besar Kodim 0315/Bintan untuk bijak dalam menggunakan media sosial (medsos).\r\n\r\nDandim mengimbau anggotanya dan keluarga agar tidak pernah ikut-ikutan berpendapat terhadap sesuatu hal yang tidak ada manfaatnya, apalagi membagikan berita-berita yang tidak jelas kebenarannya.\r\n\r\n\"Gunakanlah medsos dengan baik dan bijak agar kita terhindar dari masalah yang akan merugikan kita semua,\" ujar Dandim 0315/Bintan, Kamis (21/5). Apa ni bodoh', 'Esyemeneh', '1591425557233.jpg', 'Facebook', 2000, 'belum', '', 'Media_satu', '2020-06-06', '01:39:17', 'Admin', '2020-06-06 07:06:30');

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
-- Table structure for table `tmst_sosmed`
--

CREATE TABLE `tmst_sosmed` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) DEFAULT NULL
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
  `status` enum('aktif','registrasi','suspend') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tmst_user`
--

INSERT INTO `tmst_user` (`id`, `username`, `password`, `level`, `dibuat_pada`, `status`) VALUES
(1, 'Admin', '$2y$10$Q8ub.ipbt9w0HSov64BrX.3pA8FzWFu7glSehtEhBTs7t7tHuOcCy', 'admin', '2020-06-03 14:09:45', 'aktif'),
(2, 'Media_satu', '$2y$10$Q8ub.ipbt9w0HSov64BrX.3pA8FzWFu7glSehtEhBTs7t7tHuOcCy', 'user', '2020-06-05 01:36:01', 'aktif'),
(3, 'Bupati', '$2y$10$Q8ub.ipbt9w0HSov64BrX.3pA8FzWFu7glSehtEhBTs7t7tHuOcCy', 'superadmin', '2020-06-05 14:40:08', 'aktif');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_log`
--
ALTER TABLE `tb_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_notifikasi`
--
ALTER TABLE `tb_notifikasi`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tmst_setting`
--
ALTER TABLE `tmst_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tmst_sosmed`
--
ALTER TABLE `tmst_sosmed`
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
