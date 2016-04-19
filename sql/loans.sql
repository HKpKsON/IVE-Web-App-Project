-- phpMyAdmin SQL Dump
-- version 4.0.4.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 19, 2016 at 08:46 AM
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
CREATE DATABASE IF NOT EXISTS `project` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `project`;

-- --------------------------------------------------------

--
-- Table structure for table `loans`
--

CREATE TABLE IF NOT EXISTS `loans` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `logo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `createdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=19 ;

--
-- Dumping data for table `loans`
--

INSERT INTO `loans` (`id`, `logo`, `url`, `content`, `type`, `createdate`) VALUES
(2, 'LOGO', 'URL', 'CONTENT', 'Personal', '2016-03-19 19:19:14'),
(3, 'LOGO2', 'URL2', 'CONTENT2^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^', 'Mortgage', '2016-03-19 19:19:59'),
(4, 'logo3', 'url3', 'content3', 'Mortgage', '2016-03-20 06:15:14'),
(5, 'logo', 'url', 'content', 'Mortgage', '2016-03-21 09:15:25'),
(6, 'url2', 'url2', 'url2', 'Mortgage', '2016-03-21 09:15:59'),
(7, 'url4', 'url4', 'url4', 'Mortgage', '2016-03-21 09:17:04'),
(8, 'test', 'http://xx', '', 'Mortgage', '2016-04-14 13:50:17'),
(13, NULL, 'http://google.com/', 'qwadasda', 'Mortgage', '2016-04-15 06:52:18'),
(14, NULL, 'http://google.com/', '', 'Mortgage', '2016-04-15 06:52:26'),
(15, NULL, 'http://google.com/', '', 'Credit', '2016-04-15 06:53:18'),
(18, 'eAqSeAwDKIIWmHoi9LmDKCYreu4Ga60P.jpg', 'http://google.com/', '', 'Credit', '2016-04-15 06:58:33');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
