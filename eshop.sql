-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 04, 2015 at 10:05 PM
-- Server version: 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL,
  `catName` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `catName`) VALUES
(1, 'books'),
(2, 'games');

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE IF NOT EXISTS `history` (
  `userId` int(11) NOT NULL,
  `productId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`userId`, `productId`) VALUES
(18, 1),
(18, 2),
(18, 6);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL,
  `catId` int(11) NOT NULL,
  `pName` varchar(50) NOT NULL,
  `description` varchar(200) NOT NULL,
  `price` double NOT NULL,
  `photo` varchar(200) DEFAULT NULL,
  `rating` int(11) NOT NULL DEFAULT '0',
  `stock` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `catId`, `pName`, `description`, `price`, `photo`, `rating`, `stock`) VALUES
(1, 1, 'the book thief', 'book', 90, 'ajkfnakjsfba', 2, 20),
(2, 2, 'gta', 'game', 100, 'jsbfjabf', 5, 0),
(3, 1, 'the da vinci code', 'book', 88, 'fasfdsfdsf', 2, 33),
(4, 2, 'the witcher 3', 'game', 120, 'afsfdfsdaf', 4, 5),
(5, 1, 'paper towns', 'book', 15, 'dasdajsfb', 3, 0),
(6, 2, 'until dawn', 'dakjsbfsjdbfa', 75, 'fdjskfnjsdbafj', 4, 9);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL,
  `avatar` varchar(25) NOT NULL,
  `previous_buys` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `avatar`, `previous_buys`) VALUES
(6, 'Emad', 'Anonymous', 'emad@gmail.com', 'emademad8', '', 0),
(7, 'Youssef', 'Anonymous', 'youssef@gmail.com', 'youssef66', '', 0),
(9, 'Brady', 'Hartsfield', 'merckill@gmail.com', 'mercedes9', '', 0),
(10, 'Bill', 'Anonymous', 'bill@gmail.com', 'billhodges6', '', 0),
(11, 'Gardner', 'Anonymous', 'gard@gmail.com', 'gard8888', '', 0),
(12, 'Mohsen', 'Anonymous', 'moh@gmail.com', '12345678', '', 0),
(13, 'Sameh', 'Anonymous', 'same@gmail.com', 'sameh777', '', 0),
(18, 'Omar', 'Emad', 'omar@gmail.com', 'omaromar7', '', 0),
(19, 'Mike', 'Anonymous', 'mike@gmail.com', 'mikemike8', '', 0),
(20, 'Harvey', 'Anonymous', 'harvey@gmail.com', 'harveydent6', '', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD KEY `users_cart` (`userId`),
  ADD KEY `products_cart` (`productId`) USING BTREE;

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `catId` (`catId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `history`
--
ALTER TABLE `history`
  ADD CONSTRAINT `history_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `history_ibfk_2` FOREIGN KEY (`productId`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
