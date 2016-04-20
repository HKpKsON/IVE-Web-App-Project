-- phpMyAdmin SQL Dump
-- version 4.0.4.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 20, 2016 at 08:55 AM
-- Server version: 5.6.13
-- PHP Version: 5.4.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE IF NOT EXISTS `videos` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `type` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `video` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `content` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `createdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `videos`
--

INSERT INTO `videos` (`id`, `type`, `video`, `content`, `title`, `createdate`) VALUES
(1, 'China', 'uCwkz6-nOFM', 'Welcome to SCMP.TV<br />\r\nHope you enjoy!', 'SCMP.TV Advertisment', '2016-04-10 13:32:28'),
(5, 'Asia', 'SnzPI71iWz8', 'Horrible Disaster', 'Earthquake in Kumamoto', '2016-04-15 16:10:56'),
(6, 'China', 'b5udaU38I-o', 'Something about this News.', 'Freedom in China', '2016-04-19 03:14:08'),
(7, 'China', 'C2tEb7e9beA', 'Something about this News.', 'Farmer in China', '2016-04-20 08:13:46'),
(8, 'China', 'ZCsWhqHpses', 'Something about this News.', 'Food in China', '2016-04-20 08:18:50'),
(9, 'China', '-V-dsK4behw', 'Something about this News.', 'People in China', '2016-04-20 08:19:04'),
(10, 'China', 'b5udaU38I-o', 'Something about this News.', 'News Title Here', '2016-04-20 08:19:16'),
(11, 'HongKong', '8cF9OgJuOpw', 'Something about this News.', 'Hong Kong Balls', '2016-04-20 08:25:50'),
(13, 'China', 'C2tEb7e9beA', 'Something about this News.', 'News Title Here', '2016-04-20 08:37:59');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
