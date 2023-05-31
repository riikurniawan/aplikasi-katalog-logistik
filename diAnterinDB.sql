-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 31, 2023 at 01:04 PM
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
  `Name` varchar(100) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`Name`, `Username`, `Password`) VALUES
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
  `Product_ID` char(5) NOT NULL,
  `Nama` varchar(50) NOT NULL,
  `Deskripsi` text NOT NULL,
  `Harga` decimal(10,2) NOT NULL,
  `Status_Publikasi` tinyint(1) NOT NULL,
  `Berat` int(5) NOT NULL,
  `Gambar` varchar(255) NOT NULL,
  `Jangkauan_Pengirirman` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`Username`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`Product_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
