-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 10, 2020 at 06:49 AM
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
-- Table structure for table `tmst_tenaga`
--

CREATE TABLE `tmst_tenaga` (
  `id_tenaga` int(11) NOT NULL,
  `id_media` int(11) NOT NULL,
  `nama_tenaga` varchar(255) NOT NULL,
  `id_jabatan` int(2) NOT NULL,
  `nik` char(16) NOT NULL,
  `file` varchar(100) NOT NULL,
  `no_hp` varchar(14) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tmst_tenaga`
--
ALTER TABLE `tmst_tenaga`
  ADD PRIMARY KEY (`id_tenaga`),
  ADD KEY `id_media` (`id_media`,`id_jabatan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tmst_tenaga`
--
ALTER TABLE `tmst_tenaga`
  MODIFY `id_tenaga` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
