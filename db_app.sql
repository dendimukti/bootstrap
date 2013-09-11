-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 12, 2013 at 07:17 AM
-- Server version: 5.1.41
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(250) NOT NULL,
  `first_nm` varchar(50) NOT NULL,
  `last_nm` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `status` varchar(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `first_nm`, `last_nm`, `email`, `status`) VALUES
(1, '4dm1n', '9f5883075f79866dc54af13347f2fdaa', 'yohohoho', 'hohoho', 'yohohoho@gmail.com', '1');

-- --------------------------------------------------------

--
-- Table structure for table `domain`
--

CREATE TABLE IF NOT EXISTS `domain` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `domain` varchar(30) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `domain`
--

INSERT INTO `domain` (`id`, `domain`, `status`) VALUES
(1, 'com', 1),
(2, 'gov', 1),
(3, 'org', 1),
(4, 'net', 1),
(5, 'eu', 1),
(6, 'id', 1),
(7, 'xxx', 1),
(8, 'ac', 0),
(9, 'sch', 1),
(10, 'my', 1),
(11, 'id', 1),
(12, 'us', 1),
(13, 'ws', 1),
(15, 'xyz', 1),
(16, 'cik', 3),
(17, 'cuk', 1),
(18, 'cak', 4),
(19, 'cur', 1);

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE IF NOT EXISTS `member` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `first_nm` varchar(50) NOT NULL,
  `last_nm` varchar(50) NOT NULL,
  `status` varchar(1) NOT NULL,
  `email` varchar(50) NOT NULL,
  `join_date` datetime NOT NULL,
  `address` text NOT NULL,
  `reg_code` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`id`, `username`, `password`, `first_nm`, `last_nm`, `status`, `email`, `join_date`, `address`, `reg_code`) VALUES
(6, 'dendimukti', 'e35b4040c2a29139c0dbef25e907338e', 'dendi', 'mukti', '1', 'dendimuktip@gmail.com', '2013-09-11 22:07:04', '', 'PFBNWV37FQY84ZHFD2R0');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
