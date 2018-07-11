-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 09, 2018 at 03:07 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 5.6.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_simpbb`
--

-- --------------------------------------------------------

--
-- Table structure for table `t_jenis_objek_pajak_simpatda`
--

CREATE TABLE `t_jenis_objek_pajak_simpatda` (
  `id` bigint(20) NOT NULL,
  `kodejenispajak` int(10) DEFAULT NULL,
  `jenispajak` varchar(255) DEFAULT NULL,
  `type_pajak` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_jenis_objek_pajak_simpatda`
--

INSERT INTO `t_jenis_objek_pajak_simpatda` (`id`, `kodejenispajak`, `jenispajak`, `type_pajak`) VALUES
(10, 1, 'Pajak Hotel', 'pajak'),
(11, 2, 'Pajak Restoran', 'pajak'),
(12, 3, 'Pajak Hiburan', 'pajak'),
(13, 5, 'Pajak Air Tanah', 'pajak'),
(14, 6, 'Pajak Reklame', 'pajak'),
(15, 7, 'Pajak Mineral Bukan Logam dan Batuan Golongan 2', 'pajak'),
(16, 12, 'Retribusi Pemeriksaan Alat Pemadam Kebakaran', 'retribusi'),
(17, 13, 'Retribusi Minuman Beralkohol, Minuman Keras', 'retribusi'),
(18, 14, 'Retribusi Izin Gangguan (HO)', 'retribusi');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `t_jenis_objek_pajak_simpatda`
--
ALTER TABLE `t_jenis_objek_pajak_simpatda`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `t_jenis_objek_pajak_simpatda`
--
ALTER TABLE `t_jenis_objek_pajak_simpatda`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
