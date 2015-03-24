-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 24, 2015 at 06:36 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db`
--

-- --------------------------------------------------------

--
-- Table structure for table `hosteller`
--

CREATE TABLE IF NOT EXISTS `hosteller` (
  `regno` varchar(9) NOT NULL,
  `block` varchar(15) NOT NULL,
  `room_no` int(3) NOT NULL,
  PRIMARY KEY (`regno`),
  UNIQUE KEY `regno` (`regno`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `info_user`
--

CREATE TABLE IF NOT EXISTS `info_user` (
  `gen_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Unique ID for user',
  `regno` varchar(9) NOT NULL,
  `name` varchar(40) NOT NULL,
  `email` text NOT NULL,
  `dob` date NOT NULL,
  `doj` date NOT NULL COMMENT 'Date of joining',
  `status` text NOT NULL COMMENT 'Profile status',
  `native_place_id` int(11) NOT NULL COMMENT 'maps to location table',
  `hosteller` int(11) NOT NULL DEFAULT '0' COMMENT '0 - hosteller and 1 - Day scholar',
  `mobile` int(10) NOT NULL,
  PRIMARY KEY (`gen_id`),
  UNIQUE KEY `regno` (`regno`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE IF NOT EXISTS `location` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` int(11) NOT NULL COMMENT 'state name',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE IF NOT EXISTS `login` (
  `regno` varchar(9) NOT NULL,
  `password` varchar(10) NOT NULL,
  PRIMARY KEY (`regno`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `reg_verification`
--

CREATE TABLE IF NOT EXISTS `reg_verification` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'AI unique id',
  `regno` varchar(9) NOT NULL COMMENT 'VIT Registration no',
  `dob` date NOT NULL COMMENT 'DOB for parent login',
  `email` text NOT NULL COMMENT 'VIT Gmail ID',
  `gen_password` varchar(15) NOT NULL COMMENT 'Generated hash sent for verification',
  `activated` int(1) NOT NULL DEFAULT '0' COMMENT 'Account activated or not( 0 - not activated)',
  PRIMARY KEY (`id`),
  UNIQUE KEY `regno` (`regno`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Temporary table for new user' AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `hosteller`
--
ALTER TABLE `hosteller`
  ADD CONSTRAINT `hosteller_ibfk_1` FOREIGN KEY (`regno`) REFERENCES `info_user` (`regno`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `login`
--
ALTER TABLE `login`
  ADD CONSTRAINT `login_ibfk_1` FOREIGN KEY (`regno`) REFERENCES `info_user` (`regno`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
