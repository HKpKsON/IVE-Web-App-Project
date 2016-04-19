-- phpMyAdmin SQL Dump
-- version 4.0.4.2
-- http://www.phpmyadmin.net
--
-- 主機: localhost
-- 產生日期: 2016 年 04 月 19 日 09:03
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

-- --------------------------------------------------------

--
-- 表的結構 `polls`
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
-- 轉存資料表中的資料 `polls`
--

INSERT INTO `polls` (`id`, `title`, `publishdate`, `lastupdate`, `yes`, `no`) VALUES
(4, 'Would you swap', '2016-03-18 07:04:45', '2016-03-18 07:04:45', 0, 1),
(6, 'Can China win the Fifa World Cup by 2050?', '2016-04-12 07:10:15', '2016-04-12 07:10:15', 1, 1),
(7, 'Do you find Uber provides a better experience than local Hong Kong taxis?', '2016-04-15 05:08:14', '2016-04-15 05:08:14', 3, 1),
(9, 'Were you aware that swearing on the Hong Kong MTR could get you fined?', '2016-04-15 05:14:31', '2016-04-15 05:14:31', 0, 0),
(10, 'TEST', '2016-04-15 06:15:09', '2016-04-15 06:15:09', 0, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
