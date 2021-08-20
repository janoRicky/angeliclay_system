-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 20, 2021 at 09:58 AM
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
(1, 'smtp_user', 'angeliclay.ordering@gmail.com', NULL),
(2, 'smtp_pass', 'qmozloihhnugmaqd', NULL),
(3, 'mail_sender', 'angeliclay.ordering@gmail.com', NULL),
(4, 'alerts_email_send_to', 'pogbobo@gmail.com', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `log_id` int(11) NOT NULL,
  `actor_id` int(11) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `link` varchar(127) DEFAULT NULL,
  `type` int(31) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `message_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `date_time` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`message_id`, `user_id`, `admin_id`, `message`, `date_time`, `status`) VALUES
(1, 2, NULL, 'test', '2021-08-10 22:47:33', 1),
(2, 2, 1, 'hoy user', '2021-08-11 22:47:45', 1),
(3, 2, 1, 'wazzap', '2021-08-12 22:47:50', 1),
(4, 2, NULL, 'wazzzaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaapppppppppppp', '2021-08-13 22:47:55', 1),
(5, 2, NULL, 'wazzzaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaapppppppppppp kaaaaaaaaa diiiiiiin', '2021-08-14 22:48:02', 1),
(6, 2, 2, 'waaaaaaaaaaaaaazzzzzzzzzzzzzzzzzuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuupppppppppppppppppppppp', '2021-08-15 22:48:16', 1),
(7, 2, NULL, 'wazzap wazzap wazzap wazzap wazzap wazzap wazzap wazzap wazzap wazzap wazzap wazzap wazzap wazzap wazzap wazzap wazzap wazzap', '2021-08-16 22:48:20', 1),
(8, 1, NULL, 'wazzap wazzap wazzap wazzap wazzap wazzap wazzap wazzap wazzap wazzap wazzap wazzap wazzap wazzap wazzap wazzap wazzap wazzap wazzap wazzap wazzap wazzap wazzap wazzap wazzap wazzap wazzap wazzap wazzap wazzap wazzap wazzap wazzap wazzap wazzap wazzap wazzap wazzap wazzap wazzap wazzap wazzap wazzap wazzap wazzap wazzap wazzap wazzap wazzap wazzap wazzap wazzap wazzap wazzap wazzap wazzap wazzap wazzap wazzap wazzap wazzap wazzap wazzap wazzap wazzap wazzap wazzap wazzap wazzap wazzap wazzap wazzap wazzap wazzap wazzap wazzap wazzap wazzap wazzap wazzap wazzap wazzap wazzap wazzap wazzap wazzap wazzap wazzap wazzap wazzap wazzap wazzap wazzap wazzap wazzap wazzap wazzap wazzap wazzap wazzap wazzap wazzap wazzap wazzap wazzap wazzap wazzap wazzap wazzap wazzap wazzap wazzap wazzap', '2021-08-17 22:48:28', 1),
(9, 2, 2, 'sdasdwq awsdsadqw asdvxcb', '2021-08-17 22:54:52', 1),
(10, 2, 1, 'dqwrse oisdhfiodsb', '2021-08-17 22:54:59', 1),
(11, 2, NULL, 'sdajskgdg cfwefg dsvsdg sdf sdg rgrth dfhgfdfh bdfbgfn', '2021-08-17 22:55:11', 1),
(12, 2, NULL, 'dfgkj jgihgf dghghn gt bfdbfgf', '2021-08-17 22:55:21', 1),
(13, 2, NULL, 'rttytyu ntr tetdhj ryl.,btrv reyrey dfbgbfgdfhfyynfnyygfn  yn tyn ny ', '2021-08-17 22:55:35', 1),
(14, 2, 2, 'gjtr r oi h iug uyf uyfytytd u ih h iu hi hj hf ytd ytcydt cu cyt ufiyf i u fuy fd hgs d edsghfuj', '2021-08-17 22:55:45', 1),
(15, 1, 2, 'lshdfigciu ifgeiuf dgbiugb iugvjh bj klhdkjgrsghkjd ahfsidufiusage aIUSGUDIFGIAGSFIBAESGE', '2021-08-17 22:55:55', 1),
(16, 2, 1, 'Sweet talk', '2021-08-17 22:56:06', 1),
(17, 2, NULL, 'everything you say', '2021-08-17 22:56:12', 1),
(18, 2, 1, 'it sounds like', '2021-08-17 22:56:18', 1),
(19, 2, NULL, 'sweet talk to my ears', '2021-08-17 22:56:25', 1),
(20, 2, 1, 'you could yell', '2021-08-17 22:56:32', 1),
(21, 2, NULL, 'piss off', '2021-08-17 22:56:38', 1),
(22, 2, 1, 'won\'t you stay away', '2021-08-17 22:56:48', 1),
(23, 2, NULL, 'it\'ll still be', '2021-08-17 22:56:56', 1),
(24, 2, 1, 'sweet talk to my ears', '2021-08-17 22:57:03', 1),
(25, 2, NULL, 'put it in my pocket', '2021-08-17 22:57:39', 1),
(26, 2, 1, 'in my backpocket', '2021-08-17 22:57:49', 1),
(27, 2, NULL, 'you\'re not self-aware', '2021-08-17 22:58:10', 1),
(28, 2, 1, 'you\'re a big df', '2021-08-17 22:58:20', 1),
(29, 2, NULL, 'with your df face', '2021-08-17 22:58:29', 1),
(30, 2, 1, 'trey', '2021-08-19 23:17:31', 1),
(31, 2, 1, 'terere', '2021-08-19 23:18:30', 1),
(32, 1, NULL, 'test', '2021-08-20 15:36:43', 1),
(33, 1, NULL, 'sadasdwe', '2021-08-20 15:37:00', 1),
(34, 1, NULL, 'Oh, my love', '2021-08-20 15:37:15', 1),
(35, 1, NULL, 'I know I am a cold cold man', '2021-08-20 15:37:25', 1),
(36, 1, NULL, 'So slow to give you compliments', '2021-08-20 15:37:37', 1),
(37, 1, NULL, 'And public displayed affections', '2021-08-20 15:37:47', 1),
(38, 1, NULL, 'But baby, don\'t you go over-analyze', '2021-08-20 15:38:02', 1),
(39, 1, NULL, 'No need to theorize', '2021-08-20 15:38:10', 1),
(40, 1, NULL, 'I can put your doubts to rest', '2021-08-20 15:38:21', 1),
(41, 1, NULL, 'You\'re the only one worth seeing', '2021-08-20 15:38:31', 1),
(42, 1, NULL, 'The only place worth being', '2021-08-20 15:38:38', 1),
(43, 1, NULL, 'The only bed worth sleeping in', '2021-08-20 15:38:50', 1),
(44, 1, NULL, 'Is the one right next to you', '2021-08-20 15:38:58', 1),
(45, 1, NULL, 'When it is cold', '2021-08-20 15:39:18', 1),
(46, 1, NULL, 'I get warm, just thinking of you', '2021-08-20 15:39:32', 1),
(47, 1, NULL, 'When I\'m alone', '2021-08-20 15:39:40', 1),
(48, 1, NULL, 'I stare at stars and hope dreams come true', '2021-08-20 15:39:57', 1),
(49, 1, NULL, 'You\'re probably not aware that I\'m even here', '2021-08-20 15:41:21', 1),
(50, 1, NULL, 'Yeah you might not know I exist but I don\'t even care', '2021-08-20 15:42:17', 1),
(51, 1, NULL, 'Sweet talk, everything you say', '2021-08-20 15:42:28', 1),
(52, 1, NULL, 'It sounds like sweet talk to my ears', '2021-08-20 15:43:09', 1),
(53, 1, NULL, 'You could yell \"piss off, won\'t you stay away\"', '2021-08-20 15:43:33', 1),
(54, 1, NULL, 'It\'ll still be, sweet talk to my ears', '2021-08-20 15:43:45', 1),
(55, 1, 1, 'unko', '2021-08-20 15:52:09', 1),
(56, 1, 2, 'taberu', '2021-08-20 15:53:16', 1),
(57, 2, 2, 'unko tabenai konoyarou', '2021-08-20 15:53:31', 1),
(58, 1, NULL, 'Unko tabenai unko-san', '2021-08-20 15:54:03', 1);

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
(4, '1', NULL, '2021-07-28 14:17:23', '1870', 'Philippines', 'Rizal', 'Antipolo', 'Rd', '828', '1', '1'),
(5, '1', 'test', '2021-07-30 00:36:00', '1870', 'Philippines', 'Rizal', 'Antipolo', 'Rd', '828', '0', '1'),
(6, '2', 'tst', '2021-07-30 00:37:00', '1234', 'Yes', 'No', 'Maybe', 'Idunno', '', '0', '1'),
(7, '3', 'test', '2021-07-30 01:10:00', '1234', 'Ctr', 'Prv', 'Ct', 'StRd', '', '0', '1'),
(8, '3', 'try', '2021-07-30 01:21:00', '1234', 'Ctr', 'Prv', 'Ct', 'StRd', '', '0', '1'),
(9, '1', 'test', '2021-07-30 01:41:00', '1870', 'Philippines', 'Rizal', 'Antipolo', 'Rd', '828', '0', '1'),
(10, '3', 'test', '2021-07-30 01:42:00', '1234', 'Ctr', 'Prv', 'Ct', 'StRd', '', '0', '1'),
(11, '4', 'Test', '2021-07-30 01:42:00', '1234', 'Ctr', 'Pro', 'Cty', 'Strd', '', '0', '1');

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
(5, '4', '2', '1', '200', 'NORMAL', NULL),
(6, '5', '1', '2', '200', 'NORMAL', NULL),
(7, '6', '4', '2', '250', 'NORMAL', NULL),
(8, '6', '2', '2', '200', 'NORMAL', NULL),
(9, '7', '2', '3', '200', 'NORMAL', NULL),
(10, '8', '4', '3', '250', 'NORMAL', NULL),
(11, '9', '3', NULL, NULL, 'CUSTOM', NULL),
(12, '10', '4', NULL, NULL, 'CUSTOM', NULL),
(13, '11', '5', NULL, NULL, 'CUSTOM', NULL);

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
  `featured` int(2) DEFAULT NULL,
  `status` varchar(16) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `img`, `name`, `type_id`, `description`, `price`, `qty`, `type`, `date_added`, `visibility`, `featured`, `status`) VALUES
(1, '3808feda972c31891c1c9ab60fe0e6f8.jpg', 'Angel Figure (Female)', '1', 'A female angel in casual clothing.', '200', '10', 'NORMAL', '2021-07-22 00:42:08', '1', 2, '1'),
(2, '4ca225f151b79e909e574157fd58c318.jpg', 'Angel Figure (Male)', '1', 'A male angel in casual clothing. ', '200', '10', 'NORMAL', '2021-07-22 01:16:47', '1', NULL, '1'),
(3, 'c599b6db33a13adcdd1e5c0e0c48031d.jpg', 'Test', '1', 'Test', '250', '0', 'NORMAL', '2021-07-27 22:15:23', '0', 1, '1'),
(4, '27df0ec9579647df58cb58ae463d6c28.jpg', 'Test', '1', 'Test', '250', '15', 'NORMAL', '2021-07-27 22:34:43', '1', 3, '1');

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
(2, 'Tries', '1', '12cm', '5d03eedaca767f7bf76c079aabb02369.jpg/', '3', '1'),
(3, 'try', '1', '12', 'ce1f2ecea2f24c1d2ab5336b9db4643a.png/', NULL, '1'),
(4, 'try', '1', '12', 'a9c4cceac8b0c46d5aaecc6b31ce55d4.png/', NULL, '1'),
(5, 'tres', '1', '12', 'd3760832d75033f8583969791d78ed4d.png/', NULL, '1');

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
(2, 'Keychain', 'b2a41d69ed2733202a42fc2201374924.png', 'Desc Keychain', '80.00 - 150.00', '1', '1'),
(3, 'test', '3f097acaf2264b8479724b3c2aecc84d.jpg', 'try', '1235464', '1', '1');

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
(1, 'jano@email.com', '$2y$10$asSRBESRalqhSJFBVFJxdevg6wxruzGGfpcQvVx9En8khpcs9HBTe', 'Jano', 'Ricky John', '', '', '1870', 'Philippines', 'Rizal', 'Antipolo', 'Rd', '828', 'female', '09123456789', '1'),
(2, 'tester@email.com', '$2y$10$b/uh6qZi.Td1QGR52aNCVuaLdTqPZN6OeqfNvcKfDj8AC.AGB2UPO', 'Test', 'Ter', '', '', '1234', 'Yes', 'No', 'Maybe', 'Idunno', '', 'male', '123456789', '1'),
(3, NULL, NULL, 'Jano', 'Ricky', '', '', '1234', 'Ctr', 'Prv', 'Ct', 'StRd', '', 'male', '123456789', '1'),
(4, NULL, NULL, 'Test', 'Try', '', '', '1234', 'Ctr', 'Pro', 'Cty', 'Strd', '', 'female', '123456789', '1');

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
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`message_id`);

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
  MODIFY `config_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `orders_items`
--
ALTER TABLE `orders_items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

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
  MODIFY `custom_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `types`
--
ALTER TABLE `types`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_accounts`
--
ALTER TABLE `user_accounts`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
