-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 27, 2015 at 07:04 PM
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
-- Table structure for table `events_info`
--

CREATE TABLE IF NOT EXISTS `events_info` (
  `auto_increment` int(10) NOT NULL AUTO_INCREMENT,
  `id` int(10) NOT NULL,
  `date_event` date NOT NULL,
  `venue` varchar(70) NOT NULL,
  `from_time` time NOT NULL,
  `to_time` time NOT NULL,
  PRIMARY KEY (`auto_increment`),
  UNIQUE KEY `auto_increment` (`auto_increment`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `events_info`
--

INSERT INTO `events_info` (`auto_increment`, `id`, `date_event`, `venue`, `from_time`, `to_time`) VALUES
(1, 1, '2015-03-25', 'SJT', '15:30:00', '18:30:00'),
(2, 1, '2015-03-26', 'SJT', '16:30:00', '20:30:00'),
(3, 2, '2015-03-26', 'SJT', '20:20:00', '21:21:00'),
(4, 2, '2015-03-27', 'SJT', '03:00:00', '05:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `events_page`
--

CREATE TABLE IF NOT EXISTS `events_page` (
  `unique_id` int(10) NOT NULL AUTO_INCREMENT,
  `regno` varchar(10) NOT NULL,
  `indiv_status` int(2) NOT NULL,
  `club_name` varchar(50) NOT NULL,
  `event_name` varchar(50) NOT NULL,
  `pic_address` text NOT NULL,
  `description` text NOT NULL,
  `from_date` date NOT NULL,
  `price` int(9) NOT NULL,
  `total_days` int(5) NOT NULL,
  `stat_part_certificates` int(2) NOT NULL,
  `completed_status` int(2) NOT NULL,
  `stat_ods` int(2) NOT NULL,
  PRIMARY KEY (`unique_id`),
  UNIQUE KEY `event_name` (`event_name`),
  UNIQUE KEY `event_name_2` (`event_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `events_page`
--

INSERT INTO `events_page` (`unique_id`, `regno`, `indiv_status`, `club_name`, `event_name`, `pic_address`, `description`, `from_date`, `price`, `total_days`, `stat_part_certificates`, `completed_status`, `stat_ods`) VALUES
(1, '13bce0267', 0, 'JHYJHYJ', 'yhyhyhyhyyhyhyh', 'Event_pics/10440674_309261455928737_8294077190340733924_n.jpg', 'sldnsakdnaksn', '2015-03-25', 200, 2, 0, 0, 0),
(2, '13ncea0267', 0, 'alskdclsakc', 'jasdkjnskjnsc', 'Event_pics/12MSE0363_RajalakshmiS.jpg', 'lsaclaskmc', '2015-03-26', 500, 2, 0, 0, 0);

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
