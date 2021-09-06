-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 06, 2021 at 07:04 PM
-- Server version: 10.3.29-MariaDB-0+deb10u1
-- PHP Version: 7.3.27-1~deb10u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pemira`
--

-- --------------------------------------------------------

--
-- Table structure for table `dpmf`
--

CREATE TABLE `dpmf` (
  `id` int(11) NOT NULL,
  `no_urut` varchar(128) NOT NULL,
  `foto` varchar(128) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `fakultas` varchar(128) NOT NULL,
  `jurusan` varchar(128) NOT NULL,
  `visi` text NOT NULL,
  `misi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `dpmu`
--

CREATE TABLE `dpmu` (
  `id` int(11) NOT NULL,
  `no_urut` varchar(128) NOT NULL,
  `foto` varchar(128) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `fakultas` varchar(128) NOT NULL,
  `jurusan` varchar(128) NOT NULL,
  `visi` text NOT NULL,
  `misi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `gubernur`
--

CREATE TABLE `gubernur` (
  `id` int(11) NOT NULL,
  `no_urut` varchar(128) NOT NULL,
  `foto` varchar(128) NOT NULL,
  `nama_ketua` varchar(128) NOT NULL,
  `nama_wakil` varchar(128) NOT NULL,
  `dapil` varchar(128) NOT NULL,
  `jur_ketua` varchar(128) NOT NULL,
  `jur_wakil` varchar(128) NOT NULL,
  `visi` text NOT NULL,
  `misi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `presiden`
--

CREATE TABLE `presiden` (
  `id` int(11) NOT NULL,
  `no_urut` varchar(128) NOT NULL,
  `foto` varchar(128) NOT NULL,
  `nama_ketua` varchar(128) NOT NULL,
  `nama_wakil` varchar(128) NOT NULL,
  `fak_ketua` varchar(128) NOT NULL,
  `fak_wakil` varchar(128) NOT NULL,
  `jur_ketua` varchar(128) NOT NULL,
  `jur_wakil` varchar(128) NOT NULL,
  `visi` text NOT NULL,
  `misi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `suara`
--

CREATE TABLE `suara` (
  `id` int(11) NOT NULL,
  `npm` varchar(128) NOT NULL,
  `presiden` varchar(128) NOT NULL,
  `dpmu` varchar(128) NOT NULL,
  `gubernur` varchar(128) NOT NULL,
  `dpmf` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `npm` int(11) NOT NULL,
  `password` varchar(128) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `fakultas` varchar(128) NOT NULL,
  `jurusan` varchar(128) NOT NULL,
  `foto` varchar(128) NOT NULL,
  `role_id` int(1) NOT NULL,
  `is_active` int(1) NOT NULL DEFAULT 0,
  `presiden` int(1) NOT NULL DEFAULT 0,
  `dpmu` int(1) NOT NULL DEFAULT 0,
  `gubernur` int(1) NOT NULL DEFAULT 0,
  `dpmf` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `npm`, `password`, `nama`, `email`, `fakultas`, `jurusan`, `foto`, `role_id`, `is_active`, `presiden`, `dpmu`, `gubernur`, `dpmf`) VALUES
(1, 1817051074, '$2y$10$sIk4dnuO3duGCGU3hlmXE.ehP9zY01heTvu3NRf65Ex17wMIDRQaW', 'Aulia Ahmad Nabil', 'aulia.ahmad1074@students.unila.ac.id', 'fmipa', 'ilmu komputer', 'default.png', 1, 1, 0, 0, 0, 0),
(2, 123321, '$2y$10$JRKeQjGNfSo8sTwX6TKV9.DkLZxPVPZPS9UGUQz/u3tUoJYwKbgba', 'Admin', '-', '-', '-', 'default.png', 1, 1, 0, 0, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dpmf`
--
ALTER TABLE `dpmf`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dpmu`
--
ALTER TABLE `dpmu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gubernur`
--
ALTER TABLE `gubernur`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `presiden`
--
ALTER TABLE `presiden`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suara`
--
ALTER TABLE `suara`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dpmf`
--
ALTER TABLE `dpmf`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `dpmu`
--
ALTER TABLE `dpmu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `gubernur`
--
ALTER TABLE `gubernur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `presiden`
--
ALTER TABLE `presiden`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `suara`
--
ALTER TABLE `suara`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
