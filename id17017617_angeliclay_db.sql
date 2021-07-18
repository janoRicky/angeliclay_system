-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 18, 2021 at 03:08 AM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id17017617_angeliclay_db`
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
(1, 'Joseph Joestar', 'test@email.com', '$2y$10$o3RJwNPSIGw7bvew7albS.WJW2z.86cpuJtFWGuijX2Gmtk8d/MKq', '1');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` varchar(16) DEFAULT NULL,
  `description` varchar(128) DEFAULT NULL,
  `date_time` datetime DEFAULT NULL,
  `zip_code` varchar(11) DEFAULT NULL,
  `country` varchar(64) DEFAULT NULL,
  `province` varchar(64) DEFAULT NULL,
  `city` varchar(64) DEFAULT NULL,
  `street` varchar(64) DEFAULT NULL,
  `address` varchar(64) DEFAULT NULL,
  `state` varchar(16) DEFAULT NULL,
  `status` varchar(16) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `description`, `date_time`, `zip_code`, `country`, `province`, `city`, `street`, `address`, `state`, `status`) VALUES
(1, '1', 'User requested a figure based on an anime.', '2021-07-17 16:55:00', '1870', 'Philippines', 'Rizal', 'Antipolo', 'Aster Rd.', 'Blk 8 Lt 28', '0', '1'),
(2, '1', 'User Joseph placed an order.', '2021-07-17 17:04:00', '1870', 'Philippines', 'Rizal', 'Antipolo', 'Aster Rd.', 'Blk 8 Lt 28', '2', '1'),
(3, '2', NULL, '2021-07-17 18:50:59', '1990', 'USA', 'California', 'Los Angeles', 'Road 66', '', '2', '1'),
(4, '1', NULL, '2021-07-17 18:56:47', '1870', 'Philippines', 'Rizal', 'Antipolo', 'Aster Rd.', 'Blk 8 Lt 28', '0', '1'),
(5, '1', 'Figurine order.', '2021-07-17 18:57:00', '1870', 'Philippines', 'Rizal', 'Antipolo', 'Aster Rd.', 'Blk 8 Lt 28', '1', '1');

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
(1, '1', '1', NULL, NULL, 'CUSTOM', NULL),
(3, '3', '2', '1', '32', 'NORMAL', NULL),
(4, '2', '2', '4', '32', 'NORMAL', NULL),
(5, '4', '2', '3', '32', 'NORMAL', NULL),
(6, '5', '2', '1', '500', 'CUSTOM', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `orders_payments`
--

CREATE TABLE `orders_payments` (
  `payment_id` int(11) NOT NULL,
  `order_id` varchar(11) DEFAULT NULL,
  `description` varchar(128) DEFAULT NULL,
  `img` varchar(64) DEFAULT NULL,
  `date_time` datetime DEFAULT NULL,
  `amount` varchar(32) DEFAULT NULL,
  `status` varchar(16) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders_payments`
--

INSERT INTO `orders_payments` (`payment_id`, `order_id`, `description`, `img`, `date_time`, `amount`, `status`) VALUES
(1, '3', NULL, NULL, '2021-07-17 18:50:59', NULL, '1'),
(2, '4', NULL, '52042c11c35760f78cd1a0619f3d3404.png', '2021-07-17 18:56:47', NULL, '1');

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
  `date_added` datetime DEFAULT NULL,
  `visibility` varchar(11) DEFAULT NULL,
  `status` varchar(16) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `img`, `name`, `type_id`, `description`, `price`, `qty`, `type`, `date_added`, `visibility`, `status`) VALUES
(1, '2a002f9ff6720bdc8d29366945d2b1c9.jpg', 'Angel Character (Female) Figurine', '1', 'Figurine of an angel in casual clothing.', '350', '2', 'NORMAL', '2021-06-01 14:56:34', '1', '1'),
(2, 'feb22717f55b680609288ab4c959c4fe.jpg', 'Angel Character (Male) Figurine ', '1', 'Figurine of an angel in casual clothing. ', '32', '13', 'NORMAL', '2021-06-06 14:57:01', '1', '1'),
(3, '1253477dc94bbd6c9fd575e17011c758.jpg', 'Princess Figurine', '1', 'Figurine of a princess in a purple dress.', '400', '5', 'NORMAL', '2021-06-05 14:56:57', '1', '1');

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
  `product_id` varchar(11) DEFAULT NULL,
  `status` varchar(16) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products_custom`
--

INSERT INTO `products_custom` (`custom_id`, `description`, `type_id`, `size`, `img`, `product_id`, `status`) VALUES
(1, 'Guts from BERSERK.', '1', '15cm', '7c1e770afc239b64270b47c58efef875.png/', NULL, '1'),
(2, 'Single figurine based on goku from the dragon ball series.', '1', '12cm', 'efe9eeca4c2ee21fbe5967a89ec2b2ea.png', NULL, '1');

-- --------------------------------------------------------

--
-- Table structure for table `types`
--

CREATE TABLE `types` (
  `type_id` int(11) NOT NULL,
  `name` varchar(32) DEFAULT NULL,
  `img` varchar(64) DEFAULT NULL,
  `description` varchar(128) DEFAULT NULL,
  `price_range` varchar(32) DEFAULT NULL,
  `featured` varchar(11) DEFAULT NULL,
  `status` varchar(16) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `types`
--

INSERT INTO `types` (`type_id`, `name`, `img`, `description`, `price_range`, `featured`, `status`) VALUES
(1, 'Figurine', '45284448c8c8e86b87e7c8e1cb848dca.jpg', 'Desc Figurine', '175.00 - 300.00', '1', '1'),
(2, 'Keychain', 'b2a41d69ed2733202a42fc2201374924.png', 'Desc Keychain', '80.00 - 150.00', '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `user_accounts`
--

CREATE TABLE `user_accounts` (
  `user_id` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `name_last` varchar(32) DEFAULT NULL,
  `name_first` varchar(64) DEFAULT NULL,
  `name_middle` varchar(32) DEFAULT NULL,
  `name_extension` varchar(32) DEFAULT NULL,
  `zip_code` varchar(11) DEFAULT NULL,
  `country` varchar(64) DEFAULT NULL,
  `province` varchar(64) DEFAULT NULL,
  `city` varchar(64) DEFAULT NULL,
  `street` varchar(64) DEFAULT NULL,
  `address` varchar(64) DEFAULT NULL,
  `gender` varchar(32) DEFAULT NULL,
  `contact_num` varchar(32) DEFAULT NULL,
  `status` varchar(16) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_accounts`
--

INSERT INTO `user_accounts` (`user_id`, `email`, `password`, `name_last`, `name_first`, `name_middle`, `name_extension`, `zip_code`, `country`, `province`, `city`, `street`, `address`, `gender`, `contact_num`, `status`) VALUES
(1, 'user@email.com', '$2y$10$CDo6gIag2XkBXzA3VJNZL.KXf36en0p2Hy29sSI1jX6skT16bn0ba', 'Joestar', 'Joseph', 'J', '', '1870', 'Philippines', 'Rizal', 'Antipolo', 'Aster Rd.', 'Blk 8 Lt 28', 'male', '09123456789', '1'),
(2, 'test@email.com', '$2y$10$637hoct0N0dWAKn82WQkEOL8fgfRlzN4MGfFuuH6ADihUxn5BMVDO', 'Joestar', 'Jonathan', 'J', '', '1990', 'USA', 'California', 'Los Angeles', 'Road 66', '', 'male', '3064565', '1'),
(3, 'arenalangelrose2000@gmail.com', '$2y$10$le7cyZpupxd06kxlbDMW6.COdk7mr1uJb4f3c0MrVefFMAnsXDsyC', 'Arenal', 'Angel', 'Estocado', '', '1870', 'Philippines', 'Rizal', 'Antipolo', 'Sitio San Lorenzo', 'Bgry. San Roque Antipolo City', 'female', '09095556211', '1'),
(4, 'cealizel4@gmail.com', '$2y$10$kaPiX7I78oOKwX7hoEhtROX1qIaNFBQl6.xDHObqwPzCcE2xuBWh6', 'Cea', 'Lizel', 'B', '', '1870', 'Philippines', 'Rizal', 'Antipolo', 'Road 3', 'Inday Subdivision', 'female', '09518575700', '1');

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
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `orders_items`
--
ALTER TABLE `orders_items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `orders_payments`
--
ALTER TABLE `orders_payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `products_custom`
--
ALTER TABLE `products_custom`
  MODIFY `custom_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `types`
--
ALTER TABLE `types`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_accounts`
--
ALTER TABLE `user_accounts`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
