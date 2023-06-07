-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 07, 2023 at 04:13 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dianterindb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `nama` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`nama`, `username`, `password`) VALUES
('ahan', 'ahan', '$2y$10$W/5TRY0G.bXWHnwNoPUcruDRgDzZnMyz/UBpFtV5/sbLoaPcs6CC.'),
('Ari Kurniawan', 'ari', '$2y$10$Qnt53TXHKrxV5.OvAM2Ry.v/iSfiebPRTKQYA5YPJrrIjEvO41s9W'),
('cindy', 'cindy', '$2y$10$h4i.BS7U.vddEM58FoxfdO8pJ/f.KUwkbwQc83imm5fmaW6gWIxcq'),
('dita', 'dita', '$2y$10$ZqXqIGdN.n1XvErHRYushuegol56P1IKT3gMP1f4b/e.dsyunRpT.'),
('putri', 'putri', '$2y$10$miUYnryvOHLYi2Y87ko3Z.BQwRujFiOSWzTCRM2RbyOOVNaC1XYli');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` char(5) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `deskripsi` text NOT NULL,
  `harga` decimal(10,2) NOT NULL,
  `status_publikasi` tinyint(1) NOT NULL,
  `berat` int(5) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `jangkauan_pengirirman` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `Product_ibfk_1` FOREIGN KEY (`Created_By`) REFERENCES `admin` (`Username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
