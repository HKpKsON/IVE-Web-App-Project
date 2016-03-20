-- phpMyAdmin SQL Dump
-- version 4.0.4.2
-- http://www.phpmyadmin.net
--
-- 主機: localhost
-- 產生日期: 2016 年 03 月 20 日 15:00
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
CREATE DATABASE IF NOT EXISTS `project` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `project`;

-- --------------------------------------------------------

--
-- 表的結構 `ads`
--

CREATE TABLE IF NOT EXISTS `ads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `publishdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `media` varchar(1024) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `url` varchar(1024) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `company` varchar(256) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `expireDate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的結構 `catagories`
--

CREATE TABLE IF NOT EXISTS `catagories` (
  `tag` varchar(32) COLLATE utf8_general_ci NOT NULL,
  `displayname` varchar(64) COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`tag`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- 表的結構 `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author` int(11) NOT NULL DEFAULT '-1',
  `title` varchar(128) COLLATE utf8_general_ci NOT NULL,
  `publishdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lastupdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `content` mediumtext COLLATE utf8_general_ci NOT NULL,
  `type` int(8) NOT NULL DEFAULT '1',
  `newsId` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `author` (`author`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的結構 `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(512) COLLATE utf8_general_ci NOT NULL,
  `subtitle` varchar(512) COLLATE utf8_general_ci DEFAULT NULL,
  `publishdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lastupdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `author` int(11) NOT NULL DEFAULT '-1',
  `content` mediumtext COLLATE utf8_general_ci,
  `tags` varchar(64) COLLATE utf8_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `author` (`author`),
  KEY `tags` (`tags`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的結構 `newsletter`
--

CREATE TABLE IF NOT EXISTS `newsletter` (
  `uid` int(11) NOT NULL,
  `breaking` tinyint(1) NOT NULL DEFAULT '0',
  `internation` tinyint(1) NOT NULL DEFAULT '0',
  `tech` tinyint(1) NOT NULL DEFAULT '0',
  `china` tinyint(1) NOT NULL DEFAULT '0',
  `lifestyle` tinyint(1) NOT NULL DEFAULT '0',
  `luxe` tinyint(1) NOT NULL DEFAULT '0',
  `chns` tinyint(1) NOT NULL DEFAULT '0',
  `chnt` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- 表的結構 `polls`
--

CREATE TABLE IF NOT EXISTS `polls` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(512) COLLATE utf8_general_ci NOT NULL,
  `publishdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lastupdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `yes` int(11) NOT NULL DEFAULT '0',
  `no` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的結構 `promotecode`
--

CREATE TABLE IF NOT EXISTS `promotecode` (
  `code` varchar(64) COLLATE utf8_general_ci NOT NULL,
  `comment` varchar(256) COLLATE utf8_general_ci DEFAULT NULL,
  `creationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `expireDate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `vaild` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- 表的結構 `subscription`
--

CREATE TABLE IF NOT EXISTS `subscription` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `plan` int(2) NOT NULL DEFAULT '0',
  `refer` int(11) NOT NULL,
  `paymentDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `expireDate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `promoCode` varchar(128) COLLATE utf8_general_ci DEFAULT NULL,
  `price` int(11) NOT NULL DEFAULT '0',
  `paymentMethod` int(11) NOT NULL DEFAULT '0',
  `invoiceID` varchar(256) COLLATE utf8_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`),
  KEY `refer` (`refer`),
  KEY `promoCode` (`promoCode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的結構 `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(64) COLLATE utf8_general_ci NOT NULL,
  `password` varchar(128) COLLATE utf8_general_ci DEFAULT NULL,
  `salutation` varchar(16) COLLATE utf8_general_ci DEFAULT NULL,
  `displayname` varchar(64) COLLATE utf8_general_ci NOT NULL DEFAULT 'User',
  `email` varchar(64) COLLATE utf8_general_ci DEFAULT NULL,
  `address` varchar(1024) COLLATE utf8_general_ci DEFAULT NULL,
  `fullname` varchar(64) COLLATE utf8_general_ci DEFAULT NULL,
  `phone` varchar(32) COLLATE utf8_general_ci DEFAULT NULL,
  `country` varchar(32) COLLATE utf8_general_ci DEFAULT NULL,
  `creationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `openid` varchar(256) COLLATE utf8_general_ci DEFAULT NULL,
  `isAdmin` int(8) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=1 ;

--
-- 轉存資料表中的資料 `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `salutation`, `displayname`, `email`, `address`, `fullname`, `phone`, `country`, `creationDate`, `openid`, `isAdmin`) VALUES
(-1, 'siteadmin', 'b46eae72a089cbd18afc5a720ffb61a36fb0c6cc06b3b719f3a30b36a23e7d6d*bE2aYaq9buVFxNQOxbuSMGogMR75fCx8', 'Mr.', 'SiteAdmin', 'admin@this.site', NULL, 'Site Admin', NULL, NULL, '2016-03-06 18:18:01', NULL, 255);

--
-- 匯出資料表的 Constraints
--

--
-- 資料表的 Constraints `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`author`) REFERENCES `users` (`id`);

--
-- 資料表的 Constraints `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `news_ibfk_2` FOREIGN KEY (`tags`) REFERENCES `catagories` (`tag`),
  ADD CONSTRAINT `news_ibfk_1` FOREIGN KEY (`author`) REFERENCES `users` (`id`);

--
-- 資料表的 Constraints `newsletter`
--
ALTER TABLE `newsletter`
  ADD CONSTRAINT `newsletter_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `users` (`id`);

--
-- 資料表的 Constraints `subscription`
--
ALTER TABLE `subscription`
  ADD CONSTRAINT `subscription_ibfk_3` FOREIGN KEY (`promoCode`) REFERENCES `promotecode` (`code`),
  ADD CONSTRAINT `subscription_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `subscription_ibfk_2` FOREIGN KEY (`refer`) REFERENCES `users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
