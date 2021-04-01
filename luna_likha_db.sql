-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 01, 2021 at 05:02 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `luna_likha_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `adm_accounts`
--

CREATE TABLE `adm_accounts` (
  `id` int(11) NOT NULL,
  `name` varchar(64) DEFAULT NULL,
  `email` varchar(64) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `adm_accounts`
--

INSERT INTO `adm_accounts` (`id`, `name`, `email`, `password`) VALUES
(3, 'Joseph Joestar', 'test@email.com', '$2y$10$O4QMAp.3rt4x2JB2dMqB5OZNrutwT7JKavNpM7TzWvZCTATiBuQKu'),
(5, 'test', 'new@email.com', '$2y$10$jGjuhK5gEYN80VI.UHSJi.YHVd4pdYQ9upM6cqNeQ3P29PnoCtB96'),
(8, 'new', 'new@new', '$2y$10$sttRI05XNsE4n5NgwhxxD.kq.lZrjo3Ib2nRDqWmCnaprHpPymAyu'),
(9, 'try', 'try@try', '$2y$10$XHF411xr.bBU6BNNClixUOSL51pmMUvkDgWrZtmk2Alh.rUH1upSW');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adm_accounts`
--
ALTER TABLE `adm_accounts`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adm_accounts`
--
ALTER TABLE `adm_accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
