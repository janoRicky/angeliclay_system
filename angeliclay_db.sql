-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 28, 2021 at 10:38 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 7.4.21

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
(1, 'Joseph Joestar', 'test@email.com', '$2y$10$o3RJwNPSIGw7bvew7albS.WJW2z.86cpuJtFWGuijX2Gmtk8d/MKq', '1'),
(2, 'Jano', 'jano@email.com', '$2y$10$g9d2JywrH4SssKWWg4oVE.4c8viSWafcyZinOQQwgWT.M8.xSni7m', '1');

-- --------------------------------------------------------

--
-- Table structure for table `config`
--

CREATE TABLE `config` (
  `config_id` int(11) NOT NULL,
  `c_key` varchar(63) DEFAULT NULL,
  `c_val` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `config`
--

INSERT INTO `config` (`config_id`, `c_key`, `c_val`, `status`) VALUES
(1, 'smtp_user', 'angeliclay.ordering@gmail.com_', NULL),
(2, 'smtp_pass', 'qmozloihhnugmaqd_', NULL),
(3, 'mail_sender', 'angeliclay.ordering@gmail.com_', NULL);

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
(1, '1', 'Test', '2021-07-22 02:01:00', '1870', 'Philippines', 'Rizal', 'Antipolo', 'Rd', '828', '0', '1'),
(2, '1', 'Test', '2021-07-27 21:28:35', '1870', 'Philippines', 'Rizal', 'Antipolo', 'Rd', '828', '5', '1'),
(3, '2', 'Try', '2021-07-27 21:32:00', '1234', 'Yes', 'No', 'Maybe', 'Idunno', 'Try', '3', '1'),
(4, '1', NULL, '2021-07-28 14:17:23', '1870', 'Philippines', 'Rizal', 'Antipolo', 'Rd', '828', '0', '1');

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
(1, '1', '2', '1', '200', 'NORMAL', NULL),
(2, '1', '1', '1', '200', 'NORMAL', NULL),
(3, '2', '1', '1', '250', 'CUSTOM', NULL),
(4, '3', '2', '1', '250', 'CUSTOM', NULL),
(5, '4', '2', '1', '200', 'NORMAL', NULL);

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
(1, '1', 'Test', '78c64f5500ce4e239bd7f5893566d27d.jpg', '2021-07-22 02:18:00', '200', '1'),
(2, '4', 'tester', '27f9d815a3b034a82dee91fedad43a53.jpg', '2021-07-28 14:17:00', '1020.00', '1'),
(3, '1', 'Test', '75300b04b84309b9c0f7a8d8106ae0d5.png', '2021-07-28 14:49:00', '199.999995', '1'),
(4, '3', 'TEST', '6d6be821961b7233eaeac6a791dc119d.png', '2021-07-28 15:36:00', '1000.00', '1'),
(5, '2', '', NULL, '2021-07-28 15:37:00', '121.999999', '1');

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
(1, '3808feda972c31891c1c9ab60fe0e6f8.jpg', 'Angel Figure (Female)', '1', 'A female angel in casual clothing.', '200', '2', 'NORMAL', '2021-07-22 00:42:08', '1', '1'),
(2, '4ca225f151b79e909e574157fd58c318.jpg', 'Angel Figure (Male)', '1', 'A male angel in casual clothing. ', '200', '1', 'NORMAL', '2021-07-22 01:16:47', '1', '1'),
(3, 'c599b6db33a13adcdd1e5c0e0c48031d.jpg', 'Test', '1', 'Test', '250', '0', 'NORMAL', '2021-07-27 22:15:23', '0', '1'),
(4, '27df0ec9579647df58cb58ae463d6c28.jpg', 'Test', '1', 'Test', '250', '1', 'NORMAL', '2021-07-27 22:34:43', '0', '1');

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
(1, 'Try', '1', '12cm', '41b6181ccbcc62466fc84377244795fe.jpg', '4', '1'),
(2, 'Tries', '1', '12cm', '5d03eedaca767f7bf76c079aabb02369.jpg/', '3', '1');

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
(1, 'Figurine', 'c8b045fb04a5397356615cb5fe2488cf.jpg', 'Desc Figurine', '175.00 - 300.00', '1', '1'),
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
(1, 'jano@email.com', '$2y$10$asSRBESRalqhSJFBVFJxdevg6wxruzGGfpcQvVx9En8khpcs9HBTe', 'Jano', 'Ricky John', '', '', '1870', 'Philippines', 'Rizal', 'Antipolo', 'Rd', '828', 'male', '09123456789', '1'),
(2, 'tester@email.com', '$2y$10$b/uh6qZi.Td1QGR52aNCVuaLdTqPZN6OeqfNvcKfDj8AC.AGB2UPO', 'Test', 'Ter', '', '', '1234', 'Yes', 'No', 'Maybe', 'Idunno', '', 'male', '123456789', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_accounts`
--
ALTER TABLE `admin_accounts`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`config_id`);

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
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `config`
--
ALTER TABLE `config`
  MODIFY `config_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `orders_items`
--
ALTER TABLE `orders_items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `orders_payments`
--
ALTER TABLE `orders_payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
