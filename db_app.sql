-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 06, 2013 at 08:04 AM
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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

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
(13, 'ws', 1);

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
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`id`, `username`, `password`, `first_nm`, `last_nm`, `status`, `email`, `join_date`, `address`) VALUES
(2, 'arema', '498e0e03b0854d44d2bd59062dc39c1f', 'rudi', 'widodo', '0', 'roed@gmail.com', '2013-09-03 22:52:08', 'jalan jalan j'),
(3, 'kakakaka', '9f5883075f79866dc54af13347f2fdaa', 'kkk', 'yyy', '0', 'kaka@amail.com', '2013-09-04 21:23:46', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
