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
(2, 'yMAV8ci57GrquPLhHJtvIZhr0GqVypBi.png', 'http://google.com', 'CONTENT', 'Personal', '2016-03-19 19:19:14'),
(3, 'LSu1y3C3b8k3u5bIOojg0ZhqoocpRwEW.png', 'http://google.com', 'CONTENT2^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^', 'Personal', '2016-03-19 19:19:59'),
(4, 'HSJeNp20sBFuzqcorkKVViTOnNIhCNQ3.png', 'http://google.com', 'content3', 'Personal', '2016-03-20 06:15:14'),
(5, '1LlkpEPQ7XnN1DAWr9ysetR5I5C2LWq2.png', 'http://google.com', 'content', 'Personal', '2016-03-21 09:15:25'),
(6, 'IwlioMZx9btZRIlmOQJRTxddrfTFhXmT.png', 'http://google.com', 'url2', 'Mortgage', '2016-03-21 09:15:59'),
(7, 'Oh3qKRuCQh7K45G9TqnGgQVEFsyW4RYR.png', 'http://google.com', 'url4', 'Mortgage', '2016-03-21 09:17:04'),
(8, 'W9phfUzxseGsxJtpXt9eH4rfcCxktGcN.png', 'http://google.com/ 	', '', 'Mortgage', '2016-04-14 13:50:17'),
(13, 'WoCwBkwOVz7xSJ92UUO9ZGPeC8q6KTj7.png', 'http://google.com/', 'qwadasda', 'Mortgage', '2016-04-15 06:52:18'),
(18, 'eAqSeAwDKIIWmHoi9LmDKCYreu4Ga60P.jpg', 'http://google.com/', '', 'Credit', '2016-04-15 06:58:33');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
