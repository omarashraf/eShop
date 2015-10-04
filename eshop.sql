-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 04, 2015 at 11:38 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `eshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `cId` int(11) NOT NULL AUTO_INCREMENT,
  `catName` varchar(50) NOT NULL,
  PRIMARY KEY (`cId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cId`, `catName`) VALUES
(1, 'Books'),
(2, 'Games');

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE IF NOT EXISTS `history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `userId` (`userId`,`productId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`id`, `userId`, `productId`) VALUES
(1, 18, 1),
(2, 18, 2);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `pId` int(11) NOT NULL AUTO_INCREMENT,
  `cId` int(11) NOT NULL,
  `pName` varchar(50) NOT NULL,
  `description` varchar(100) NOT NULL,
  `price` double NOT NULL,
  `photo` varchar(200) NOT NULL,
  `rating` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  PRIMARY KEY (`pId`),
  KEY `cId` (`cId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`pId`, `cId`, `pName`, `description`, `price`, `photo`, `rating`, `stock`) VALUES
(1, 1, 'The Book Thief', 'fapnfinfiwnefi', 120, 'sidonvsdinvsoi', 4, 30),
(2, 1, 'Mr. Mercedes', 'isdbosdbf', 100, 'sdfnwiofuwe', 5, 60),
(3, 2, 'GTA', 'seninviowv', 500, 'sdonisdnvsv', 3, 66),
(4, 2, 'Uncharted', 'sdfionwdfbiuwef', 450, 'dviobidosvbdsv', 1, 88),
(5, 1, 'We Were Liars', 'apodfnisdnvubrv', 80, 'sfdsodbvds', 4, 88),
(6, 1, 'The Kite Runner', 'odsvpnsdivnsd', 60, 'oudfslfnsf', 6, 10),
(7, 2, 'FIFA', 'dfopnisdnvbsdv', 600, 'iusbvkjvuev', 5, 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL,
  `avatar` varchar(25) NOT NULL,
  `previous_buys` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_unique` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

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
(18, 'Omar', 'Ashraf', 'omar@gmail.com', 'omaromar8', '', 0),
(19, 'Mike', 'Anonymous', 'mike@gmail.com', 'mikemike8', '', 0),
(20, 'Harvey', 'Anonymous', 'harvey@gmail.com', 'harveydent6', '', 0),
(24, 'Anonymous', 'Zane', 'rachel@gmail.com', 'zanerachel8', '', 0),
(27, 'Dana', 'Scott', 'dana@gmail.com', 'scottie88', '', 0),
(28, 'Anonymous', 'Anonymous', 'jessica@gmail.com', 'jessica99', '', 0),
(29, 'Louis', '*Anonymous*', 'louis@gmail.com', 'littup10', '', 0),
(30, 'Jack', 'Anonymous', 'jack@gmail.com', 'jackjack7', '', 0);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `history`
--
ALTER TABLE `history`
  ADD CONSTRAINT `userId_cons_fk` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `category_id_fk` FOREIGN KEY (`cId`) REFERENCES `categories` (`cId`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
