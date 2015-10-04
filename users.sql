-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 02, 2015 at 04:33 PM
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
