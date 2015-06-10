-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 11, 2015 at 12:23 AM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

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
-- Table structure for table `alumni_classes`
--

CREATE TABLE IF NOT EXISTS `alumni_classes` (
`gen_id` int(11) NOT NULL,
  `code` varchar(10) NOT NULL,
  `title` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `buy`
--

CREATE TABLE IF NOT EXISTS `buy` (
`id` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `category` varchar(256) NOT NULL,
  `expected_cost` int(11) NOT NULL,
  `contact` varchar(15) NOT NULL,
  `uid` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `buy`
--

INSERT INTO `buy` (`id`, `name`, `category`, `expected_cost`, `contact`, `uid`, `status`) VALUES
(1, 'Fridge', 'Electrical', 10000, '9900990099', 4, 1),
(2, 'HTC', 'Electrical', 44500, '8098678877', 4, 1),
(3, 'Book-Let Us C', 'Category 3', 100, '9900991890', 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `courses_now`
--

CREATE TABLE IF NOT EXISTS `courses_now` (
`gen_id` int(11) NOT NULL,
  `class_num` int(11) NOT NULL,
  `slot` varchar(6) NOT NULL,
  `title` varchar(30) NOT NULL,
  `code` varchar(6) NOT NULL,
  `venue` varchar(10) NOT NULL,
  `faculty` varchar(50) NOT NULL,
  `alumni_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `events_info`
--

CREATE TABLE IF NOT EXISTS `events_info` (
`auto_increment` int(10) NOT NULL,
  `id` int(10) NOT NULL,
  `date_event` date NOT NULL,
  `venue` varchar(70) NOT NULL,
  `from_time` time NOT NULL,
  `to_time` time NOT NULL,
  `room_no` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `events_info`
--

INSERT INTO `events_info` (`auto_increment`, `id`, `date_event`, `venue`, `from_time`, `to_time`, `room_no`) VALUES
(1, 3, '2015-03-30', 'SJT', '20:30:00', '22:30:00', 23),
(2, 3, '2015-03-31', 'SJT', '21:30:00', '23:30:00', 24),
(3, 6, '2015-03-30', 'SJT', '20:30:00', '22:30:00', 0),
(4, 6, '2015-03-31', 'SJT', '22:30:00', '23:30:00', 0),
(5, 7, '2015-03-31', 'SJT', '20:30:00', '22:30:00', 202),
(6, 7, '2015-04-01', 'SJT', '19:30:00', '22:30:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `events_page`
--

CREATE TABLE IF NOT EXISTS `events_page` (
`unique_id` int(10) NOT NULL,
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
  `stat_ods` int(2) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `events_page`
--

INSERT INTO `events_page` (`unique_id`, `regno`, `indiv_status`, `club_name`, `event_name`, `pic_address`, `description`, `from_date`, `price`, `total_days`, `stat_part_certificates`, `completed_status`, `stat_ods`) VALUES
(3, 'sd', 0, 'dskmlkm', 'lksdmsd', 'Event_pics/10426565_10152989294186840_1728699685022817030_n.jpg', 'sdckm', '2015-03-30', 550, 2, 0, 0, 0),
(6, 'lsjdcnasjc', 0, 'sdknaslkdna', 'sndkajs', 'Event_pics/10615323_345564478937593_7696205393269083077_n.jpg', 'skcmasdjasjcn', '2015-03-30', 250, 2, 0, 0, 0),
(7, '13nce0236', 0, 'asidnasc', 'new', 'Event_pics/hulk_smash-wallpaper-1920x1080.jpg', 'lsdklaskdlkasmdlksamdlkclaskdmlsk', '2015-03-31', 67545, 2, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `forgot_password`
--

CREATE TABLE IF NOT EXISTS `forgot_password` (
`id` int(11) NOT NULL,
  `gen_id` int(11) NOT NULL,
  `hash` varchar(25) NOT NULL,
  `date_apply` date NOT NULL,
  `email` varchar(100) NOT NULL,
  `activated` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `found`
--

CREATE TABLE IF NOT EXISTS `found` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `location` varchar(100) NOT NULL,
  `item_desc` varchar(256) NOT NULL,
  `category` varchar(100) NOT NULL,
  `handed_over` varchar(256) NOT NULL,
  `date_on` date NOT NULL,
  `colour` varchar(50) NOT NULL,
  `contact` varchar(15) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `found`
--

INSERT INTO `found` (`id`, `user_id`, `name`, `location`, `item_desc`, `category`, `handed_over`, `date_on`, `colour`, `contact`, `status`) VALUES
(1, 4, 'Watch', 'SJT', 'found a watch Rado Limited edition near ', '', '', '2015-06-10', 'Golden', '9978755656', 1),
(3, 4, 'football', 'TT', 'Nike football', '', 'SJT gaurd Mr. Thomas', '2015-06-04', 'Black', '9985877878', 0),
(4, 4, 'Pen drive', 'TT', '8 gb pendrive in room number 123', 'Electronics', 'Dean Office 345', '2015-06-10', 'Red and Black', '788989787', 0),
(5, 4, 'Pen drive', 'TT', '8 gb pendrive in room number 123', 'Electronics', 'Dean Office 345', '2015-06-10', 'Red and Black', '788989787', 0);

-- --------------------------------------------------------

--
-- Table structure for table `hosteller`
--

CREATE TABLE IF NOT EXISTS `hosteller` (
  `regno` varchar(9) NOT NULL,
  `block` varchar(15) NOT NULL,
  `room_no` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `info_user`
--

CREATE TABLE IF NOT EXISTS `info_user` (
`gen_id` int(11) NOT NULL COMMENT 'Unique ID for user',
  `regno` varchar(9) NOT NULL,
  `name` varchar(40) NOT NULL,
  `email` text NOT NULL,
  `dob` date NOT NULL,
  `doj` date NOT NULL COMMENT 'Date of joining',
  `status` text NOT NULL COMMENT 'Profile status',
  `native_place_id` int(11) NOT NULL COMMENT 'maps to location table',
  `hosteller` int(11) NOT NULL DEFAULT '0' COMMENT '0 - hosteller and 1 - Day scholar',
  `mobile` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE IF NOT EXISTS `location` (
`id` int(11) NOT NULL,
  `name` int(11) NOT NULL COMMENT 'state name'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE IF NOT EXISTS `login` (
  `gen_id` int(11) NOT NULL,
  `uid` varchar(10) NOT NULL,
  `password` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`gen_id`, `uid`, `password`) VALUES
(1, '12mse0363', '123');

-- --------------------------------------------------------

--
-- Table structure for table `lost`
--

CREATE TABLE IF NOT EXISTS `lost` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `location` varchar(100) NOT NULL,
  `item_desc` varchar(256) NOT NULL,
  `date_on` date NOT NULL,
  `category` varchar(100) NOT NULL,
  `colour` varchar(50) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `contact` varchar(15) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `lost`
--

INSERT INTO `lost` (`id`, `user_id`, `name`, `location`, `item_desc`, `date_on`, `category`, `colour`, `status`, `contact`) VALUES
(1, 4, 'Watch', 'SJT', '', '2015-06-08', '', 'Golden', 0, ''),
(2, 4, 'Register', 'TT', '', '2015-06-02', '', 'Brown', 1, ''),
(3, 4, 'Spects', 'MB', 'Big Spects', '2015-06-04', '', 'Black', 1, ''),
(4, 4, 'football', 'SJT', 'Nike football', '2015-06-10', '', 'Red', 0, ''),
(5, 4, 'Book', 'SJT', 'Library Book', '2015-06-04', '', 'Multiple', 1, ''),
(6, 4, 'Pen drive', 'TT', 'Lost my 8 gb pendrive in room number 123', '2015-06-03', 'Electronics', 'Red and Black', 0, '9985877878');

-- --------------------------------------------------------

--
-- Table structure for table `reg_verification`
--

CREATE TABLE IF NOT EXISTS `reg_verification` (
`id` int(11) NOT NULL COMMENT 'AI unique id',
  `regno` varchar(9) NOT NULL COMMENT 'VIT Registration no',
  `dob` date NOT NULL COMMENT 'DOB for parent login',
  `email` text NOT NULL COMMENT 'VIT Gmail ID',
  `gen_password` varchar(20) NOT NULL COMMENT 'Generated hash sent for verification',
  `activated` int(1) NOT NULL DEFAULT '0' COMMENT 'Account activated or not( 0 - not activated)'
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Temporary table for new user' AUTO_INCREMENT=6 ;

--
-- Dumping data for table `reg_verification`
--

INSERT INTO `reg_verification` (`id`, `regno`, `dob`, `email`, `gen_password`, `activated`) VALUES
(5, '12mse0363', '1994-10-01', 's.rajalakshmi2012@vit.ac.in', 'mc41mdu5ndewmcaxndi3', 0);

-- --------------------------------------------------------

--
-- Table structure for table `sell`
--

CREATE TABLE IF NOT EXISTS `sell` (
`id` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `category` varchar(256) NOT NULL,
  `cost` int(11) NOT NULL,
  `description` text NOT NULL,
  `contact` varchar(20) NOT NULL,
  `uid` varchar(15) NOT NULL,
  `sold` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `sell`
--

INSERT INTO `sell` (`id`, `name`, `category`, `cost`, `description`, `contact`, `uid`, `sold`) VALUES
(1, 'iPhone 5s', 'Electronics', 30000, 'Good Condition. 1 Year old. Works fine', '9999999999', '', 1),
(2, 'HTC', 'Electrical', 0, '22999', '9999900000', '', 0),
(3, 'iPod', 'Electrical', 0, '2000', '9999900000', '', 1),
(4, 'Fridge', 'Electrical', 29999, 'Very cool', '90902130', '', 0),
(5, '', 'Electrical', 0, '', '', '', 0),
(6, '', 'Electrical', 0, '', '', '', 0),
(7, '', 'Electrical', 0, '', '', '', 0),
(8, '', 'Electrical', 0, '', '', '', 0),
(9, '', 'Electrical', 0, '', '', '', 0),
(10, '', 'Electrical', 0, '', '', '', 0),
(11, '', 'Electrical', 0, '', '', '', 0),
(12, '', 'Electrical', 0, '', '', '', 0),
(13, '', 'Electrical', 0, '', '', '', 0),
(14, '', 'Electrical', 0, '', '', '', 0),
(15, 'sdfkj', 'Electrical', 0, 'jkjlkj', 'lkj', '', 0),
(16, 'lsflksdfj', 'Electrical', 0, 'jklj', 'kjlk', '4', 1),
(17, 'sdfadf', 'Electrical', 5500, 'lklk', 's;dfa', '4', 1),
(18, 'ksjdfkljds', 'Electrical', 0, 'lkjlkj', 'kjkj', '4', 1),
(19, 'sdmvm,cxvm', 'Electrical', 21313, ',m,m', 'lk', '4', 1),
(20, 'sflafldskf', 'Electrical', 123, '', '2213213', '<br />\r\n<b>Noti', 0),
(21, 'lskdfadklfm', 'Electrical', 13213, '', 'lkmlkm', '<br />\r\n<b>Noti', 0),
(22, 'lskdfadklfm', 'Electrical', 13213, '', 'lkmlkm', '<br />\r\n<b>Noti', 0),
(23, 'Jeans', 'Category 4', 400, 'Levis', '9977856564', '4', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alumni_classes`
--
ALTER TABLE `alumni_classes`
 ADD PRIMARY KEY (`code`), ADD UNIQUE KEY `gen_id` (`gen_id`);

--
-- Indexes for table `buy`
--
ALTER TABLE `buy`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses_now`
--
ALTER TABLE `courses_now`
 ADD PRIMARY KEY (`class_num`), ADD UNIQUE KEY `gen_id` (`gen_id`);

--
-- Indexes for table `events_info`
--
ALTER TABLE `events_info`
 ADD PRIMARY KEY (`auto_increment`), ADD UNIQUE KEY `auto_increment` (`auto_increment`);

--
-- Indexes for table `events_page`
--
ALTER TABLE `events_page`
 ADD PRIMARY KEY (`unique_id`), ADD UNIQUE KEY `event_name` (`event_name`), ADD UNIQUE KEY `event_name_2` (`event_name`);

--
-- Indexes for table `forgot_password`
--
ALTER TABLE `forgot_password`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `found`
--
ALTER TABLE `found`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hosteller`
--
ALTER TABLE `hosteller`
 ADD PRIMARY KEY (`regno`), ADD UNIQUE KEY `regno` (`regno`);

--
-- Indexes for table `info_user`
--
ALTER TABLE `info_user`
 ADD PRIMARY KEY (`gen_id`), ADD UNIQUE KEY `regno` (`regno`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
 ADD PRIMARY KEY (`gen_id`), ADD UNIQUE KEY `uid` (`uid`);

--
-- Indexes for table `lost`
--
ALTER TABLE `lost`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reg_verification`
--
ALTER TABLE `reg_verification`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `regno` (`regno`);

--
-- Indexes for table `sell`
--
ALTER TABLE `sell`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alumni_classes`
--
ALTER TABLE `alumni_classes`
MODIFY `gen_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `buy`
--
ALTER TABLE `buy`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `courses_now`
--
ALTER TABLE `courses_now`
MODIFY `gen_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `events_info`
--
ALTER TABLE `events_info`
MODIFY `auto_increment` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `events_page`
--
ALTER TABLE `events_page`
MODIFY `unique_id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `forgot_password`
--
ALTER TABLE `forgot_password`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `found`
--
ALTER TABLE `found`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `info_user`
--
ALTER TABLE `info_user`
MODIFY `gen_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Unique ID for user';
--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `lost`
--
ALTER TABLE `lost`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `reg_verification`
--
ALTER TABLE `reg_verification`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'AI unique id',AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `sell`
--
ALTER TABLE `sell`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=24;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `hosteller`
--
ALTER TABLE `hosteller`
ADD CONSTRAINT `hosteller_ibfk_1` FOREIGN KEY (`regno`) REFERENCES `info_user` (`regno`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
