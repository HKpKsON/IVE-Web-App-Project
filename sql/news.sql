-- phpMyAdmin SQL Dump
-- version 4.0.4.2
-- http://www.phpmyadmin.net
--
-- 主機: localhost
-- 產生日期: 2016 年 04 月 19 日 03:28
-- 伺服器版本: 5.6.13
-- PHP 版本: 5.4.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 資料庫: `project`
--
CREATE DATABASE IF NOT EXISTS `project` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `project`;

-- --------------------------------------------------------

--
-- 表的結構 `new_data`
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
-- 轉存資料表中的資料 `new_data`
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
-- 表的結構 `review`
--

CREATE TABLE IF NOT EXISTS `review` (
  `com_id` int(11) NOT NULL AUTO_INCREMENT,
  `new_id` int(11) NOT NULL,
  `com_author` varchar(20) COLLATE utf8_bin NOT NULL,
  `com_text` text COLLATE utf8_bin NOT NULL,
  `com_date` datetime NOT NULL,
  PRIMARY KEY (`com_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
