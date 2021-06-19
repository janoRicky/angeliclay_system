-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 19, 2021 at 06:59 PM
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
-- Database: `angeliclay_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_accounts`
--

CREATE TABLE `admin_accounts` (
  `admin_id` int(11) NOT NULL,
  `name` varchar(64) DEFAULT NULL,
  `email` varchar(64) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `status` varchar(16) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_accounts`
--

INSERT INTO `admin_accounts` (`admin_id`, `name`, `email`, `password`, `status`) VALUES
(3, 'Joseph Joestar', 'test@email.com', '$2y$10$o3RJwNPSIGw7bvew7albS.WJW2z.86cpuJtFWGuijX2Gmtk8d/MKq', '1'),
(5, 'test', 'new@email.com', '$2y$10$jGjuhK5gEYN80VI.UHSJi.YHVd4pdYQ9upM6cqNeQ3P29PnoCtB96', '1'),
(8, 'new', 'new@new', '$2y$10$sttRI05XNsE4n5NgwhxxD.kq.lZrjo3Ib2nRDqWmCnaprHpPymAyu', '1'),
(9, 'try', 'try@try', '$2y$10$XHF411xr.bBU6BNNClixUOSL51pmMUvkDgWrZtmk2Alh.rUH1upSW', '1');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` varchar(16) DEFAULT NULL,
  `description` varchar(128) DEFAULT NULL,
  `date` varchar(16) DEFAULT NULL,
  `time` varchar(16) DEFAULT NULL,
  `state` varchar(16) DEFAULT NULL,
  `status` varchar(16) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `description`, `date`, `time`, `state`, `status`) VALUES
(1, '2', '12', '2021-05-21', '21:15', '0', '1'),
(3, '1', '1234', '2021-05-21', '21:21', '1', '1'),
(4, '1', 'test', '2021-05-22', '01:04', '0', '1'),
(5, '1', 'test', '2021-05-22', '01:11', '1', '1'),
(6, '1', 'test', '2021-05-22', '01:13', '1', '1'),
(7, '1', 'test', '2021-05-22', '01:13', '0', '1'),
(8, '1', '1234', '2021-05-23', '12:53', '1', '1'),
(9, '1', 'test', '2021-05-23', '14:02', '2', '1'),
(10, '1', 'test', '2021-05-23', '14:21', '3', '1'),
(11, '1', 'test', '2021-05-23', '15:18', '4', '1'),
(12, '1', 'test', '2021-05-23', '15:20', '1', '1'),
(13, '1', 'test', '2021-05-23', '15:21', '5', '1'),
(16, '4', 'test', '2021-06-09', '13:21', '0', '1'),
(17, '4', 'test', '2021-06-09', '16:16', '2', '1'),
(18, '1', 'testeeeeee', '2021-05-17', '22:00', '0', '1'),
(19, '1', 'test', '2021-06-17', '23:13', '1', '1'),
(20, '1', 'test', '2021-06-19', '02:49', '3', '1'),
(21, '4', 'user test', '2021-06-19', '18:50', '0', '1'),
(22, '4', NULL, '2021-06-20', '00:54', '0', '1'),
(23, '1', 'test', '2021-06-20', '00:55', '0', '1'),
(24, '4', NULL, '2021-06-20', '00:57', '0', '1');

-- --------------------------------------------------------

--
-- Table structure for table `orders_items`
--

CREATE TABLE `orders_items` (
  `item_id` int(11) NOT NULL,
  `order_id` varchar(16) DEFAULT NULL,
  `product_id` varchar(16) DEFAULT NULL,
  `qty` varchar(16) DEFAULT NULL,
  `price` varchar(32) DEFAULT NULL,
  `type` varchar(32) DEFAULT NULL,
  `status` varchar(16) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders_items`
--

INSERT INTO `orders_items` (`item_id`, `order_id`, `product_id`, `qty`, `price`, `type`, `status`) VALUES
(1, '7', '4', '7', '1234', 'NORMAL', NULL),
(2, '7', '3', '5', '11', 'NORMAL', NULL),
(3, '7', '1', '3', '5.45', 'NORMAL', NULL),
(4, '8', '1', '1', '5.45', 'NORMAL', NULL),
(17, '10', '1', '1', '5.45', 'NORMAL', NULL),
(18, '10', '8', '2', '565', 'NORMAL', NULL),
(19, '10', '9', '2', '3223.75', 'NORMAL', NULL),
(22, '13', '3', '1', '11', 'NORMAL', NULL),
(23, '13', '4', '1', '1234', 'NORMAL', NULL),
(48, '11', '1', '5', '5.45', 'NORMAL', NULL),
(49, '11', '11', '4', '235', 'NORMAL', NULL),
(50, '11', '10', '2', '32', 'NORMAL', NULL),
(51, '11', '9', '2', '3223.75', 'NORMAL', NULL),
(52, '9', '1', '1', '5.45', 'NORMAL', NULL),
(54, '15', '3', '14', '11', 'NORMAL', NULL),
(55, '16', '1', '1', '23', 'NORMAL', NULL),
(56, '17', '1', '7', '23', 'NORMAL', NULL),
(57, '18', '1', '3', '3', 'CUSTOM', NULL),
(58, '19', '2', NULL, NULL, 'CUSTOM', NULL),
(59, '20', '3', NULL, NULL, 'CUSTOM', NULL),
(60, '21', '4', NULL, NULL, 'CUSTOM', NULL),
(61, '22', '5', NULL, NULL, 'CUSTOM', NULL),
(62, '23', '6', NULL, NULL, 'CUSTOM', NULL),
(63, '24', '7', NULL, NULL, 'CUSTOM', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `orders_payments`
--

CREATE TABLE `orders_payments` (
  `payment_id` int(11) NOT NULL,
  `description` varchar(128) DEFAULT NULL,
  `date_time` varchar(32) DEFAULT NULL,
  `amount` varchar(32) DEFAULT NULL,
  `status` varchar(16) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `img` varchar(510) DEFAULT NULL,
  `name` varchar(64) DEFAULT NULL,
  `type_id` varchar(16) DEFAULT NULL,
  `description` varchar(128) DEFAULT NULL,
  `price` varchar(32) DEFAULT NULL,
  `qty` varchar(16) DEFAULT NULL,
  `type` varchar(16) DEFAULT NULL,
  `status` varchar(16) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `img`, `name`, `type_id`, `description`, `price`, `qty`, `type`, `status`) VALUES
(1, 'c14f3edc1f5aeaf147a35c09d045880f.jpg', 'Figure 1', '4', 'Desc 1', '23', '24', 'NORMAL', '1'),
(2, 'ebe49a8517d631d74c230d830bc7f4c8.jpg', 'Figure 3', '4', 'Desc 3', '555', '3', 'NORMAL', '1'),
(3, 'fdc0cf6ca69fa22e2959f70bcd6e931b.jpg', 'Test', '4', 'Desc', '622', '0', 'NORMAL', '1'),
(4, 'd69258a24ea68b4b31491657677b62f7.jpg', 'Testing', '4', 'test', '32', '29', 'NORMAL', '1'),
(5, '01a7cd4499f0aa19e06f440d9a028877.png', 'test', '4', 'test', '32', '44', 'NORMAL', '1'),
(6, '25b1478e92aebb5f5481b53b3eb610bd.jpg', 'test', '4', 'test', '234', '42342', 'NORMAL', '1');

-- --------------------------------------------------------

--
-- Table structure for table `products_custom`
--

CREATE TABLE `products_custom` (
  `custom_id` int(11) NOT NULL,
  `description` varchar(2040) DEFAULT NULL,
  `type_id` varchar(11) DEFAULT NULL,
  `size` varchar(32) DEFAULT NULL,
  `img` varchar(510) DEFAULT NULL,
  `status` varchar(16) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products_custom`
--

INSERT INTO `products_custom` (`custom_id`, `description`, `type_id`, `size`, `img`, `status`) VALUES
(1, 'testeree', '5', 'wawaweewa', 'dd95c20244d9204d78f8b4624b92827d.jpg/8d11540527093b6876d3d2ebb9540c7b.jpg/6e716807f973dcfc311c9bcbc4daa4ad.jpg/', '1'),
(2, 'test', '5', 'test', '428b2538a71bdbf5b419685ad39b216f.jpg/9e516cc2e94ab7a9e47e3ef3950dfa55.jpg/82a7519bd11ae76ef64a20bc238c6f87.jpg/dcbad62ec6cc0ad39e76d3411b6bd74e.jpg/57b54f2af72802a69627c53b65aef437.jpg/93984f87000a59056bd8addb993848ed.jpg/640d2e3c47f37fee1094cd198f8c3ea0.jpg/16f6bb9237c9c44da8c7236883b8024f.jpg/566b14ebc0fe696b93c1c3ccbbc7de81.jpg/2b311270b7c9dcde56264b5ef9f77ba6.jpg', '1'),
(3, 'testserrr', '4', 'eaa3', '71b51963a8fe29220b9509e15f516951.jpg/cccbd1333d3a101845099cf2ab903462.jpg/', '1'),
(4, NULL, '5', '12cm', NULL, '1'),
(5, 'utest2', '4', '21', NULL, '1'),
(6, 'test', '4', 'test', '4e0c96a72b706902420d7f4bb9e5d217.jpg/', '1'),
(7, 'utest3', '5', '212', 'dc092ec9fedf675a4eb48a82ee846cb0.jpg/', '1');

-- --------------------------------------------------------

--
-- Table structure for table `types`
--

CREATE TABLE `types` (
  `type_id` int(11) NOT NULL,
  `type` varchar(64) DEFAULT NULL,
  `status` varchar(16) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `types`
--

INSERT INTO `types` (`type_id`, `type`, `status`) VALUES
(4, 'Figurine', '1'),
(5, 'Keychain', '1');

-- --------------------------------------------------------

--
-- Table structure for table `user_accounts`
--

CREATE TABLE `user_accounts` (
  `user_id` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `name` varchar(128) DEFAULT NULL,
  `address` varchar(128) DEFAULT NULL,
  `gender` varchar(32) DEFAULT NULL,
  `contact_num` varchar(32) DEFAULT NULL,
  `status` varchar(16) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_accounts`
--

INSERT INTO `user_accounts` (`user_id`, `email`, `password`, `name`, `address`, `gender`, `contact_num`, `status`) VALUES
(1, 'user@email.com', '$2y$10$Q1EcDJMNSVc7UUIGBhIVceXqsoJAutUkXJPE872MBNYowzdo4XsEG', 'test', '1234', 'other', '1234', '1'),
(2, 'etst3@dwae', '$2y$10$WCXQJWElM7ReQws1VgviZOUju.ZGdDmjk/.t1ysUyo.9YxbpqEfFq', 'test2', 'ear4', 'female', 'sdgdfh', '1'),
(4, 'test@email.com', '$2y$10$eEA2XKEQdwflmPZi10a9.upLep2jA0Ksl3dhwaK9A4n/e.etDunDK', 'test', '23edg', 'male', '24', '1'),
(5, 'errr@email.com', '$2y$10$PicdJy/FhZaCEhgXYTLePO2eZq.jlvypBCUMeAEwBKyAAANI9DCI.', 'test', 'test', 'male', 'test', '1'),
(6, 'jojo@email.com', '$2y$10$OOElp2UoiHe1G7iAMFQor.fKU3MvAaW59T5QJpgC5jqkdxUC.oFPe', 'Joseph Joestar', '21 Jump St.', 'male', '123456', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_accounts`
--
ALTER TABLE `admin_accounts`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `orders_items`
--
ALTER TABLE `orders_items`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `orders_payments`
--
ALTER TABLE `orders_payments`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `products_custom`
--
ALTER TABLE `products_custom`
  ADD PRIMARY KEY (`custom_id`);

--
-- Indexes for table `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`type_id`);

--
-- Indexes for table `user_accounts`
--
ALTER TABLE `user_accounts`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_accounts`
--
ALTER TABLE `admin_accounts`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `orders_items`
--
ALTER TABLE `orders_items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `orders_payments`
--
ALTER TABLE `orders_payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `products_custom`
--
ALTER TABLE `products_custom`
  MODIFY `custom_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `types`
--
ALTER TABLE `types`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user_accounts`
--
ALTER TABLE `user_accounts`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
