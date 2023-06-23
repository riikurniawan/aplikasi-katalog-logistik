-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 23, 2023 at 03:45 PM
-- Server version: 10.3.38-MariaDB-0ubuntu0.20.04.1
-- PHP Version: 7.4.3-4ubuntu2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`nama`, `username`, `password`) VALUES
('admin', 'admin', '$2y$10$xmuG3chR5ljXdo7Qtr/h0O28Gr8m48sbvro9FyaMlK1NB1hmh7EYm');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` char(10) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `deskripsi` text NOT NULL,
  `harga` decimal(10,2) NOT NULL,
  `status_publikasi` tinyint(1) NOT NULL,
  `bobot_pengiriman` varchar(25) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `jangkauan_pengiriman` varchar(255) NOT NULL,
  `lama_pengiriman` varchar(25) NOT NULL,
  `pembuat` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `nama`, `deskripsi`, `harga`, `status_publikasi`, `bobot_pengiriman`, `gambar`, `jangkauan_pengiriman`, `lama_pengiriman`, `pembuat`) VALUES
('PROD001', 'APEX', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusamus dolore quia molestias nobis a iusto. Illo tempore nostrum delectus quod culpa reiciendis, aliquam excepturi cumque. Doloremque, aut deserunt distinctio id quibusdam ullam iste aspernatur culpa explicabo delectus, ipsam saepe facere quo numquam. Repudiandae quae odio voluptate unde amet, repellendus assumenda?', '30000.00', 1, 'Min. 10KG hingga 30KG', 'APEX.png', 'Batam Only', '1 Hari', 'admin'),
('PROD002', 'CARE', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusamus dolore quia molestias nobis a iusto. Illo tempore nostrum delectus quod culpa reiciendis, aliquam excepturi cumque. Doloremque, aut deserunt distinctio id quibusdam ullam iste aspernatur culpa explicabo delectus, ipsam saepe facere quo numquam. Repudiandae quae odio voluptate unde amet, repellendus assumenda?', '25000.00', 0, 'Min 1Kg', 'CARE.png', 'Batam Center dan sekitarnya', '1 Hari', 'admin'),
('PROD003', 'CUBE', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus a ut commodi nulla omnis dignissimos voluptates aut quidem magni iste ratione, aliquid molestias nihil dolor adipisci aperiam quas! Iure cupiditate officiis exercitationem nisi aspernatur, cum doloribus qui magni modi, dolorum consectetur illum laboriosam optio. Ab autem ipsam porro voluptatem natus!', '25000.00', 0, 'Min 1 KG', 'cube_6494f1c19ea28.png', 'Tanjungpinang Kota dan sekitarnya', '1 hari', 'admin'),
('PROD004', 'CARE', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus odio eligendi dolor veniam, voluptatibus at perferendis optio porro ducimus doloribus obcaecati dicta assumenda inventore, est quis officiis architecto vero corrupti culpa. Facilis perferendis exercitationem, nihil magnam doloribus quas mollitia soluta veniam officiis quis maxime corrupti, fuga quasi quod. Non error eos delectus, voluptatibus optio harum voluptatem obcaecati sunt, inventore, nulla mollitia velit tenetur expedita ut deserunt cumque? Aperiam nemo iure delectus quos ea doloribus quod dolore sapiente autem molestiae totam voluptatum beatae voluptatem necessitatibus minus iste labore, dolor officiis esse. Nisi velit nam culpa et porro laboriosam consectetur sunt sapiente.', '40000.00', 0, 'Maks 15KG', 'care_6494f354ceada.png', 'Maks Batu 10', '1 Hari', 'admin'),
('PROD005', 'kau pembohong', 'ini just meme', '25000.00', 1, 'Maks 10 Kg', 'kau pembohong_64954a6f76ac8.jpeg', 'Seluruh kota kepulauan riau', '7 Hari', 'admin'),
('PROD006', 'im a surgeon', 'im im im a surgeon \r\nim im im a surgeon', '65000.00', 0, 'Up to 30Kg', 'im a surgeon_64954ff000c92.jpeg', 'batam dan sekitarnya', 'Ontime', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`),
  ADD KEY `produk_ibfk_1` (`pembuat`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `produk_ibfk_1` FOREIGN KEY (`pembuat`) REFERENCES `admin` (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
