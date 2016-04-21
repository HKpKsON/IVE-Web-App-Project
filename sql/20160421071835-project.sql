-- phpMyAdmin SQL Dump
-- version 4.0.4.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 21, 2016 at 07:18 AM
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
(2, 'yMAV8ci57GrquPLhHJtvIZhr0GqVypBi.png', 'http://google.com', 'CONTENT', 'Personal', '2016-03-19 19:19:14'),
(3, 'LSu1y3C3b8k3u5bIOojg0ZhqoocpRwEW.png', 'http://google.com', 'CONTENT2^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^', 'Personal', '2016-03-19 19:19:59'),
(4, 'HSJeNp20sBFuzqcorkKVViTOnNIhCNQ3.png', 'http://google.com', 'content3', 'Personal', '2016-03-20 06:15:14'),
(5, '1LlkpEPQ7XnN1DAWr9ysetR5I5C2LWq2.png', 'http://google.com', 'content', 'Personal', '2016-03-21 09:15:25'),
(6, 'IwlioMZx9btZRIlmOQJRTxddrfTFhXmT.png', 'http://google.com', 'url2', 'Mortgage', '2016-03-21 09:15:59'),
(7, 'Oh3qKRuCQh7K45G9TqnGgQVEFsyW4RYR.png', 'http://google.com', 'url4', 'Mortgage', '2016-03-21 09:17:04'),
(8, 'W9phfUzxseGsxJtpXt9eH4rfcCxktGcN.png', 'http://google.com/ 	', '', 'Mortgage', '2016-04-14 13:50:17'),
(13, 'WoCwBkwOVz7xSJ92UUO9ZGPeC8q6KTj7.png', 'http://google.com/', 'qwadasda', 'Mortgage', '2016-04-15 06:52:18'),
(18, 'eAqSeAwDKIIWmHoi9LmDKCYreu4Ga60P.jpg', 'http://google.com/', '', 'Credit', '2016-04-15 06:58:33');

-- --------------------------------------------------------

--
-- Table structure for table `new_data`
--

CREATE TABLE IF NOT EXISTS `new_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author` varchar(50) COLLATE utf8_bin NOT NULL,
  `title` text COLLATE utf8_bin NOT NULL,
  `text` text COLLATE utf8_bin NOT NULL,
  `category` varchar(20) COLLATE utf8_bin NOT NULL,
  `new_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=41 ;

--
-- Dumping data for table `new_data`
--

INSERT INTO `new_data` (`id`, `author`, `title`, `text`, `category`, `new_date`) VALUES
(1, 'Author 0', 'Hong Kong . New 0', ' Hong Kong Text 0', 'hongkong', '2016-00-00 00:00:00'),
(2, 'Author 1', 'Hong Kong . New 1', ' Hong Kong Text 1', 'hongkong', '2016-01-00 01:00:01'),
(3, 'Author 2', 'Hong Kong . New 2', ' Hong Kong Text 2', 'hongkong', '2016-02-00 02:00:02'),
(4, 'Author 3', 'Hong Kong . New 3', ' Hong Kong Text 3', 'hongkong', '2016-03-00 03:00:03'),
(5, 'Author 4', 'Hong Kong . New 4', ' Hong Kong Text 4', 'hongkong', '2016-04-00 04:00:04'),
(6, 'Author 5', 'Hong Kong . New 5', ' Hong Kong Text 5', 'hongkong', '2016-05-00 05:00:05'),
(7, 'Author 6', 'Hong Kong . New 6', ' Hong Kong Text 6', 'hongkong', '2016-06-00 06:00:06'),
(8, 'Author 7', 'Hong Kong . New 7', ' Hong Kong Text 7', 'hongkong', '2016-07-00 07:00:07'),
(9, 'Author 8', 'Hong Kong . New 8', ' Hong Kong Text 8', 'hongkong', '2016-08-00 08:00:08'),
(10, 'Author 9', 'Hong Kong . New 9', ' Hong Kong Text 9', 'hongkong', '2016-09-00 09:00:09'),
(11, 'Author 0', 'Lifestyle . New 0', ' Lifestyle Text 0', 'lifestyle', '2016-00-01 00:01:00'),
(12, 'Author 1', 'Lifestyle . New 1', ' Lifestyle Text 1', 'lifestyle', '2016-01-01 01:01:01'),
(13, 'Author 2', 'Lifestyle . New 2', ' Lifestyle Text 2', 'lifestyle', '2016-02-01 02:01:02'),
(14, 'Author 3', 'Lifestyle . New 3', ' Lifestyle Text 3', 'lifestyle', '2016-03-01 03:01:03'),
(15, 'Author 4', 'Lifestyle . New 4', ' Lifestyle Text 4', 'lifestyle', '2016-04-01 04:01:04'),
(16, 'Author 5', 'Lifestyle . New 5', ' Lifestyle Text 5', 'lifestyle', '2016-05-01 05:01:05'),
(17, 'Author 6', 'Lifestyle . New 6', ' Lifestyle Text 6', 'lifestyle', '2016-06-01 06:01:06'),
(18, 'Author 7', 'Lifestyle . New 7', ' Lifestyle Text 7', 'lifestyle', '2016-07-01 07:01:07'),
(19, 'Author 8', 'Lifestyle . New 8', ' Lifestyle Text 8', 'lifestyle', '2016-08-01 08:01:08'),
(20, 'Author 9', 'Lifestyle . New 9', ' Lifestyle Text 9', 'lifestyle', '2016-09-01 09:01:09'),
(21, 'Author 0', 'Business . New 0', ' Business Text 0', 'business', '2016-00-02 00:02:00'),
(22, 'Author 1', 'Business . New 1', ' Business Text 1', 'business', '2016-01-02 01:02:01'),
(23, 'Author 2', 'Business . New 2', ' Business Text 2', 'business', '2016-02-02 02:02:02'),
(24, 'Author 3', 'Business . New 3', ' Business Text 3', 'business', '2016-03-02 03:02:03'),
(25, 'Author 4', 'Business . New 4', ' Business Text 4', 'business', '2016-04-02 04:02:04'),
(26, 'Author 5', 'Business . New 5', ' Business Text 5', 'business', '2016-05-02 05:02:05'),
(27, 'Author 6', 'Business . New 6', ' Business Text 6', 'business', '2016-06-02 06:02:06'),
(28, 'Author 7', 'Business . New 7', ' Business Text 7', 'business', '2016-07-02 07:02:07'),
(29, 'Author 8', 'Business . New 8', ' Business Text 8', 'business', '2016-08-02 08:02:08'),
(30, 'Author 9', 'Business . New 9', ' Business Text 9', 'business', '2016-09-02 09:02:09'),
(31, 'Author 0', 'Tech . New 0', ' Tech Text 0', 'tech', '2016-00-03 00:03:00'),
(32, 'Author 1', 'Tech . New 1', ' Tech Text 1', 'tech', '2016-01-03 01:03:01'),
(33, 'Author 2', 'Tech . New 2', ' Tech Text 2', 'tech', '2016-02-03 02:03:02'),
(34, 'Author 3', 'Tech . New 3', ' Tech Text 3', 'tech', '2016-03-03 03:03:03'),
(35, 'Author 4', 'Tech . New 4', ' Tech Text 4', 'tech', '2016-04-03 04:03:04'),
(36, 'Author 5', 'Tech . New 5', ' Tech Text 5', 'tech', '2016-05-03 05:03:05'),
(37, 'Author 6', 'Tech . New 6', ' Tech Text 6', 'tech', '2016-06-03 06:03:06'),
(38, 'Author 7', 'Tech . New 7', ' Tech Text 7', 'tech', '2016-07-03 07:03:07'),
(39, 'Author 8', 'Tech . New 8', ' Tech Text 8', 'tech', '2016-08-03 08:03:08'),
(40, 'Author 9', 'Tech . New 9', ' Tech Text 9', 'tech', '2016-09-03 09:03:09');

-- --------------------------------------------------------

--
-- Table structure for table `polls`
--

CREATE TABLE IF NOT EXISTS `polls` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(512) NOT NULL,
  `publishdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lastupdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `yes` int(11) NOT NULL DEFAULT '0',
  `no` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `polls`
--

INSERT INTO `polls` (`id`, `title`, `publishdate`, `lastupdate`, `yes`, `no`) VALUES
(4, 'Would you swap', '2016-03-18 07:04:45', '2016-03-18 07:04:45', 0, 1),
(6, 'Can China win the Fifa World Cup by 2050?', '2016-04-12 07:10:15', '2016-04-12 07:10:15', 1, 1),
(7, 'Do you find Uber provides a better experience than local Hong Kong taxis?', '2016-04-15 05:08:14', '2016-04-15 05:08:14', 3, 1),
(9, 'Were you aware that swearing on the Hong Kong MTR could get you fined?', '2016-04-15 05:14:31', '2016-04-15 05:14:31', 0, 0),
(10, 'TEST', '2016-04-15 06:15:09', '2016-04-15 06:15:09', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE IF NOT EXISTS `review` (
  `com_id` int(11) NOT NULL AUTO_INCREMENT,
  `new_id` int(11) NOT NULL,
  `com_author` varchar(20) COLLATE utf8_bin NOT NULL,
  `com_text` text COLLATE utf8_bin NOT NULL,
  `com_date` datetime NOT NULL,
  PRIMARY KEY (`com_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`com_id`, `new_id`, `com_author`, `com_text`, `com_date`) VALUES
(1, 40, 'ADMIN', 'TEST', '2016-04-21 12:35:39');

-- --------------------------------------------------------

--
-- Table structure for table `subscription`
--

CREATE TABLE IF NOT EXISTS `subscription` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `plan` int(2) NOT NULL DEFAULT '0',
  `paymentDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `expireDate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `price` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(64) NOT NULL,
  `password` varchar(128) DEFAULT NULL,
  `salutation` varchar(16) DEFAULT NULL,
  `displayname` varchar(64) NOT NULL DEFAULT 'User',
  `email` varchar(64) DEFAULT NULL,
  `address` varchar(1024) DEFAULT NULL,
  `fullname` varchar(64) DEFAULT NULL,
  `phone` varchar(32) DEFAULT NULL,
  `country` varchar(32) DEFAULT NULL,
  `creationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `openid` varchar(256) DEFAULT NULL,
  `isAdmin` int(8) NOT NULL DEFAULT '0',
  `valid` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `salutation`, `displayname`, `email`, `address`, `fullname`, `phone`, `country`, `creationDate`, `openid`, `isAdmin`, `valid`) VALUES
(-1, 'siteadmin', '5c77740c04b3bfd78552d776bff79b46e3651a70932aa9ecffd328c94ef31a4d*Qp6KuBlkIB5cdKOsfTsGvmvZe0VW6bcF', 'Mr.', 'Site Admin', 'kenhasbeenused@gmail.com', '', 'Site Admin', '', 'AF', '2016-03-06 18:18:01', NULL, 255, 1);

-- --------------------------------------------------------

--
-- Table structure for table `verifications`
--

CREATE TABLE IF NOT EXISTS `verifications` (
  `code` varchar(255) NOT NULL,
  `uid` int(11) NOT NULL,
  `type` int(8) NOT NULL,
  `creationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `expireDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `valid` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`code`),
  KEY `uid` (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

--
-- Constraints for dumped tables
--

--
-- Constraints for table `subscription`
--
ALTER TABLE `subscription`
  ADD CONSTRAINT `subscription_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `users` (`id`);

--
-- Constraints for table `verifications`
--
ALTER TABLE `verifications`
  ADD CONSTRAINT `verifications_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
