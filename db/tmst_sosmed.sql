-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 09, 2020 at 04:34 AM
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
(1, 'Facebook', '1591609621892.png', '2020-06-08', '07:57:01'),
(2, 'Whatsapp', '1591608358791.png', '2020-06-08', '04:25:58'),
(3, 'Instagram', '1591608369602.png', '2020-06-08', '04:26:09'),
(4, 'Twitter', '1591608383500.png', '2020-06-08', '04:26:23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tmst_sosmed`
--
ALTER TABLE `tmst_sosmed`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tmst_sosmed`
--
ALTER TABLE `tmst_sosmed`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
