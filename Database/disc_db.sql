-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 19, 2015 at 03:10 AM
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
-- Table structure for table `2234_class_mat207`
--

CREATE TABLE IF NOT EXISTS `2234_class_mat207` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `regno` varchar(9) DEFAULT NULL,
  `active` int(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `regno` (`regno`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=232 ;

--
-- Dumping data for table `2234_class_mat207`
--

INSERT INTO `2234_class_mat207` (`id`, `regno`, `active`) VALUES
(231, '13BCE0267', 0);

-- --------------------------------------------------------

--
-- Table structure for table `4557_class_cse202`
--

CREATE TABLE IF NOT EXISTS `4557_class_cse202` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `regno` varchar(9) DEFAULT NULL,
  `active` int(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `regno` (`regno`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=232 ;

--
-- Dumping data for table `4557_class_cse202`
--

INSERT INTO `4557_class_cse202` (`id`, `regno`, `active`) VALUES
(231, '13BCE0267', 0);

-- --------------------------------------------------------

--
-- Table structure for table `4588_class_cse329`
--

CREATE TABLE IF NOT EXISTS `4588_class_cse329` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `regno` varchar(9) DEFAULT NULL,
  `active` int(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `regno` (`regno`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=232 ;

--
-- Dumping data for table `4588_class_cse329`
--

INSERT INTO `4588_class_cse329` (`id`, `regno`, `active`) VALUES
(231, '13BCE0267', 0);

-- --------------------------------------------------------

--
-- Table structure for table `4592_class_cse205`
--

CREATE TABLE IF NOT EXISTS `4592_class_cse205` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `regno` varchar(9) DEFAULT NULL,
  `active` int(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `regno` (`regno`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=232 ;

--
-- Dumping data for table `4592_class_cse205`
--

INSERT INTO `4592_class_cse205` (`id`, `regno`, `active`) VALUES
(231, '13BCE0267', 0);

-- --------------------------------------------------------

--
-- Table structure for table `4621_class_cse319`
--

CREATE TABLE IF NOT EXISTS `4621_class_cse319` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `regno` varchar(9) DEFAULT NULL,
  `active` int(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `regno` (`regno`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=232 ;

--
-- Dumping data for table `4621_class_cse319`
--

INSERT INTO `4621_class_cse319` (`id`, `regno`, `active`) VALUES
(231, '13BCE0267', 0);

-- --------------------------------------------------------

--
-- Table structure for table `alumni_classes`
--

CREATE TABLE IF NOT EXISTS `alumni_classes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(20) NOT NULL,
  `title` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `alumni_cse109`
--

CREATE TABLE IF NOT EXISTS `alumni_cse109` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `regno` varchar(9) DEFAULT NULL,
  `active` int(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `regno` (`regno`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=232 ;

--
-- Dumping data for table `alumni_cse109`
--

INSERT INTO `alumni_cse109` (`id`, `regno`, `active`) VALUES
(231, '13BCE0267', 0);

-- --------------------------------------------------------

--
-- Table structure for table `alumni_cse219`
--

CREATE TABLE IF NOT EXISTS `alumni_cse219` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `regno` varchar(9) DEFAULT NULL,
  `active` int(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `regno` (`regno`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=232 ;

--
-- Dumping data for table `alumni_cse219`
--

INSERT INTO `alumni_cse219` (`id`, `regno`, `active`) VALUES
(231, '13BCE0267', 0);

-- --------------------------------------------------------

--
-- Table structure for table `ans_req_likes_11`
--

CREATE TABLE IF NOT EXISTS `ans_req_likes_11` (
  `req_ans_reg_no` varchar(10) NOT NULL,
  `qstn_id` int(10) NOT NULL,
  PRIMARY KEY (`req_ans_reg_no`,`qstn_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ans_req_likes_11`
--

INSERT INTO `ans_req_likes_11` (`req_ans_reg_no`, `qstn_id`) VALUES
('13BCE0267', 10),
('13BCE0267', 11);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `gen_id` int(11) NOT NULL AUTO_INCREMENT,
  `class_num` int(11) NOT NULL,
  `slot` varchar(15) NOT NULL,
  `title` varchar(100) NOT NULL,
  `code` varchar(6) NOT NULL,
  `venue` varchar(10) NOT NULL,
  `faculty` varchar(75) NOT NULL,
  `alumni_id` int(11) NOT NULL,
  PRIMARY KEY (`class_num`),
  UNIQUE KEY `gen_id` (`gen_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `courses_now`
--

INSERT INTO `courses_now` (`gen_id`, `class_num`, `slot`, `title`, `code`, `venue`, `faculty`, `alumni_id`) VALUES
(1, 2234, 'E2+TE2', 'Applied Probability, Statistics and Reliability', 'MAT207', 'CBL', 'SJT401', 59),
(2, 4557, 'F2+TF2', 'Algorithm Design and Analysis', 'CSE202', 'CBL', 'SJT401', 0),
(3, 4588, 'D2', 'Management Information Systems', 'CSE329', 'CBL', 'SJT422', 0),
(4, 4592, 'C2+TC2', 'Computer Architecture and Organization', 'CSE205', 'CBL', 'SJT324', 0),
(5, 4621, 'F1', 'Soft Computing', 'CSE319', 'CBL', 'SJT405', 0);

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
  `room_no` int(11) NOT NULL,
  PRIMARY KEY (`auto_increment`),
  UNIQUE KEY `auto_increment` (`auto_increment`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `events_info`
--

INSERT INTO `events_info` (`auto_increment`, `id`, `date_event`, `venue`, `from_time`, `to_time`, `room_no`) VALUES
(1, 3, '2015-03-30', 'SJT', '20:30:00', '22:30:00', 23),
(2, 3, '2015-03-31', 'SJT', '21:30:00', '23:30:00', 24),
(3, 6, '2015-03-30', 'SJT', '20:30:00', '22:30:00', 0),
(4, 6, '2015-03-31', 'SJT', '22:30:00', '23:30:00', 0),
(5, 7, '2015-03-31', 'SJT', '20:30:00', '22:30:00', 202),
(6, 7, '2015-04-01', 'SJT', '19:30:00', '22:30:00', 0),
(7, 8, '2015-06-19', 'SJT', '20:30:00', '22:30:00', 102);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `events_page`
--

INSERT INTO `events_page` (`unique_id`, `regno`, `indiv_status`, `club_name`, `event_name`, `pic_address`, `description`, `from_date`, `price`, `total_days`, `stat_part_certificates`, `completed_status`, `stat_ods`) VALUES
(3, 'sd', 0, 'dskmlkm', 'lksdmsd', 'Event_pics/10426565_10152989294186840_1728699685022817030_n.jpg', 'sdckm', '2015-03-30', 550, 2, 0, 1, 0),
(6, 'lsjdcnasjc', 0, 'sdknaslkdna', 'sndkajs', 'Event_pics/10615323_345564478937593_7696205393269083077_n.jpg', 'skcmasdjasjcn', '2015-03-30', 250, 2, 0, 1, 0),
(7, '13nce0236', 0, 'asidnasc', 'new', 'Event_pics/hulk_smash-wallpaper-1920x1080.jpg', 'lsdklaskdlkasmdlksamdlkclaskdmlsk', '2015-03-31', 67545, 2, 0, 1, 0),
(8, '13bce0267', 0, 'GDG', 'aksjdcksjc', 'Event_pics/029bfbb2fda84f9841a4ff48990e6708.jpg', 'skjdcnkasjdaksjc', '2015-06-19', 200, 1, 0, 0, 0);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `found`
--

INSERT INTO `found` (`id`, `user_id`, `name`, `location`, `item_desc`, `category`, `handed_over`, `date_on`, `colour`, `contact`, `status`) VALUES
(1, 4, 'Watch', 'SJT', 'found a watch Rado Limited edition near ', '', '', '2015-06-10', 'Golden', '9978755656', 1),
(3, 4, 'football', 'TT', 'Nike football', '', 'SJT gaurd Mr. Thomas', '2015-06-04', 'Black', '9985877878', 0),
(4, 4, 'Pen drive', 'TT', '8 gb pendrive in room number 123', 'Electronics', 'Dean Office 345', '2015-06-10', 'Red and Black', '788989787', 0),
(5, 4, 'Pen drive', 'TT', '8 gb pendrive in room number 123', 'Electronics', 'Dean Office 345', '2015-06-10', 'Red and Black', '788989787', 0),
(1, 4, 'Watch', 'SJT', 'found a watch Rado Limited edition near ', '', '', '2015-06-10', 'Golden', '9978755656', 1),
(3, 4, 'football', 'TT', 'Nike football', '', 'SJT gaurd Mr. Thomas', '2015-06-04', 'Black', '9985877878', 0),
(4, 4, 'Pen drive', 'TT', '8 gb pendrive in room number 123', 'Electronics', 'Dean Office 345', '2015-06-10', 'Red and Black', '788989787', 0),
(5, 4, 'Pen drive', 'TT', '8 gb pendrive in room number 123', 'Electronics', 'Dean Office 345', '2015-06-10', 'Red and Black', '788989787', 0),
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
-- Table structure for table `likes_upvotes_11`
--

CREATE TABLE IF NOT EXISTS `likes_upvotes_11` (
  `unique_id_post` int(11) NOT NULL,
  `regno_liked` varchar(11) NOT NULL,
  `table_unique_id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`table_unique_id`),
  UNIQUE KEY `table_unique_id` (`table_unique_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `likes_upvotes_11`
--

INSERT INTO `likes_upvotes_11` (`unique_id_post`, `regno_liked`, `table_unique_id`) VALUES
(2, 'a1', 3),
(3, 'a1', 7),
(5, 'a1', 11),
(7, 'a1', 13),
(22, '13BCE0267', 17),
(21, '13BCE0267', 18),
(19, '13BCE0267', 19),
(28, '13BCE0267', 20),
(30, '13BCE0267', 21),
(29, '13BCE0267', 23),
(31, '13BCE0267', 24),
(32, '13BCE0267', 25);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lost`
--

INSERT INTO `lost` (`id`, `user_id`, `name`, `location`, `item_desc`, `date_on`, `category`, `colour`, `status`, `contact`) VALUES
(1, 4, 'Watch', 'SJT', '', '2015-06-08', '', 'Golden', 0, ''),
(2, 4, 'Register', 'TT', '', '2015-06-02', '', 'Brown', 1, ''),
(3, 4, 'Spects', 'MB', 'Big Spects', '2015-06-04', '', 'Black', 1, ''),
(4, 4, 'football', 'SJT', 'Nike football', '2015-06-10', '', 'Red', 0, ''),
(5, 4, 'Book', 'SJT', 'Library Book', '2015-06-04', '', 'Multiple', 1, ''),
(6, 4, 'Pen drive', 'TT', 'Lost my 8 gb pendrive in room number 123', '2015-06-03', 'Electronics', 'Red and Black', 0, '9985877878'),
(1, 4, 'Watch', 'SJT', '', '2015-06-08', '', 'Golden', 0, ''),
(2, 4, 'Register', 'TT', '', '2015-06-02', '', 'Brown', 1, ''),
(3, 4, 'Spects', 'MB', 'Big Spects', '2015-06-04', '', 'Black', 1, ''),
(4, 4, 'football', 'SJT', 'Nike football', '2015-06-10', '', 'Red', 0, ''),
(5, 4, 'Book', 'SJT', 'Library Book', '2015-06-04', '', 'Multiple', 1, ''),
(6, 4, 'Pen drive', 'TT', 'Lost my 8 gb pendrive in room number 123', '2015-06-03', 'Electronics', 'Red and Black', 0, '9985877878'),
(0, 4, 'fridge', 'Mens Hostel', 'laksdncsndc', '1995-10-10', 'I-CARD', 'red', 0, '9092658797');

-- --------------------------------------------------------

--
-- Table structure for table `post_table_11`
--

CREATE TABLE IF NOT EXISTS `post_table_11` (
  `unique_id` int(11) NOT NULL AUTO_INCREMENT,
  `regno` varchar(10) NOT NULL,
  `post_text` text NOT NULL,
  `no_of_likes_ans` int(10) NOT NULL,
  `status_qstn` int(10) NOT NULL,
  `date_time` datetime NOT NULL,
  `pic_address` text NOT NULL,
  `anoymous_status` int(11) NOT NULL,
  `total_no_replies` int(11) NOT NULL,
  PRIMARY KEY (`unique_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `post_table_11`
--

INSERT INTO `post_table_11` (`unique_id`, `regno`, `post_text`, `no_of_likes_ans`, `status_qstn`, `date_time`, `pic_address`, `anoymous_status`, `total_no_replies`) VALUES
(1, 'a1', 'here is the post', 1, 0, '2015-04-18 23:11:00', '', 0, 0),
(2, 'a1', 'new try', 1, 0, '2015-04-18 23:11:50', '', 0, 0),
(3, 'a1', 'lkklmlkmlkm', 1, 1, '2015-04-18 23:46:09', '', 0, 0),
(4, '13BCE0267', 'hello', 0, 1, '2015-06-19 01:55:27', '', 0, 0),
(5, '13BCE0267', 'hetthere', 0, 0, '2015-06-19 01:55:56', '', 0, 0),
(6, '13BCE0267', 'kjbkjnk', 0, 1, '2015-06-19 01:56:03', '', 0, 0),
(7, '13BCE0267', 'hoes this', 0, 1, '2015-06-19 02:03:20', '', 0, 0),
(8, '13BCE0267', 'new', 0, 1, '2015-06-19 02:26:12', '', 1, 0),
(9, '13BCE0267', 'hey there', 0, 0, '2015-06-19 05:08:34', '', 1, 0),
(10, '13BCE0267', 'heyo', 1, 1, '2015-06-19 05:34:46', '', 0, 0),
(11, '13BCE0267', 'hiyo', 1, 0, '2015-06-19 05:34:54', '', 0, 0),
(12, '13BCE0267', 'asdcasdc', 0, 1, '2015-06-19 06:15:42', '', 0, 0),
(13, '13BCE0267', '1254', 0, 0, '2015-06-19 06:15:48', '', 0, 0),
(14, '13BCE0267', '569874', 0, 0, '2015-06-19 06:15:53', '', 0, 0),
(15, '13BCE0267', '123658', 0, 0, '2015-06-19 06:15:58', '', 0, 0),
(16, '13BCE0267', '1023658', 0, 1, '2015-06-19 06:16:03', '', 0, 0),
(17, '13BCE0267', '89745', 0, 1, '2015-06-19 06:16:19', '', 0, 0),
(18, '13BCE0267', '120365', 0, 0, '2015-06-19 06:16:24', '', 0, 0),
(19, '13BCE0267', '789541', 0, 0, '2015-06-19 06:16:29', '', 0, 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Temporary table for new user' AUTO_INCREMENT=6 ;

--
-- Dumping data for table `reg_verification`
--

INSERT INTO `reg_verification` (`id`, `regno`, `dob`, `email`, `gen_password`, `activated`) VALUES
(1, '13BCE0267', '1995-10-10', 'tetalisaikrishna.chaitanya2013@vit.ac.in', '9c39bb2bf7b4e69', 0),
(5, '12mse0363', '1994-10-01', 's.rajalakshmi2012@vit.ac.in', 'mc41mdu5ndewmca', 0);

-- --------------------------------------------------------

--
-- Table structure for table `reply_posts_11`
--

CREATE TABLE IF NOT EXISTS `reply_posts_11` (
  `unique_id` int(11) NOT NULL AUTO_INCREMENT,
  `regno` varchar(11) NOT NULL,
  `comment_id` int(11) NOT NULL,
  `reply_id` int(11) NOT NULL,
  `date_reply` datetime NOT NULL,
  `anoymous_status` int(1) NOT NULL,
  `likes_upvotes` int(11) NOT NULL,
  `reply_text` mediumtext,
  PRIMARY KEY (`unique_id`),
  UNIQUE KEY `unique_id` (`unique_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=34 ;

--
-- Dumping data for table `reply_posts_11`
--

INSERT INTO `reply_posts_11` (`unique_id`, `regno`, `comment_id`, `reply_id`, `date_reply`, `anoymous_status`, `likes_upvotes`, `reply_text`) VALUES
(1, 'a1', 1, 0, '2015-04-18 23:11:11', 1, 0, 'an_1'),
(2, 'a1', 1, 1, '2015-04-18 23:11:32', 0, 1, 'asdcasdcasc'),
(3, 'a1', 2, 0, '2015-04-18 23:11:55', 0, 1, 'asdcasdc'),
(4, 'a1', 2, 1, '2015-04-18 23:12:19', 1, 0, 'lkasmdcasdc'),
(5, 'a1', 2, 2, '2015-04-18 23:12:30', 1, 1, 'asdcac'),
(6, 'a1', 3, 0, '2015-04-18 23:46:20', 1, 0, 'kn,,mm,njnkjnk'),
(7, 'a1', 3, 1, '2015-04-18 23:46:26', 0, 1, 'kjnkjnkjnk'),
(8, '13BCE0267', 7, 0, '2015-06-19 02:03:30', 0, 0, 'asdcac'),
(9, '13BCE0267', 8, 0, '2015-06-19 02:31:58', 1, 0, 'asdcasc'),
(10, '13BCE0267', 8, 1, '2015-06-19 04:12:22', 0, 0, 'sdcasdc'),
(11, '13BCE0267', 8, 2, '2015-06-19 04:12:27', 1, 0, 'asdcasc'),
(12, '13BCE0267', 8, 3, '2015-06-19 04:12:35', 1, 0, 'asdcasdcascd'),
(13, '13BCE0267', 8, 4, '2015-06-19 04:12:52', 1, 0, 'asdcasdca'),
(14, '13BCE0267', 8, 5, '2015-06-19 04:12:58', 1, 0, 'asdcasdc'),
(15, '13BCE0267', 8, 6, '2015-06-19 04:13:03', 1, 0, 'asdcasdc'),
(16, '13BCE0267', 6, 0, '2015-06-19 04:32:54', 0, 0, '1'),
(17, '13BCE0267', 6, 1, '2015-06-19 04:32:59', 0, 0, '2'),
(18, '13BCE0267', 6, 2, '2015-06-19 04:33:04', 0, 0, '3'),
(19, '13BCE0267', 6, 3, '2015-06-19 04:33:12', 0, 1, '4'),
(20, '13BCE0267', 6, 4, '2015-06-19 04:33:22', 0, 0, '5'),
(21, '13BCE0267', 6, 5, '2015-06-19 04:33:32', 1, 1, '6'),
(22, '13BCE0267', 6, 6, '2015-06-19 04:33:38', 1, 1, '7'),
(23, '13BCE0267', 6, 7, '2015-06-19 04:33:53', 1, 0, '8'),
(24, '13BCE0267', 4, 0, '2015-06-19 04:49:57', 0, 0, '1'),
(25, '13BCE0267', 1, 2, '2015-06-19 04:50:28', 0, 0, '3'),
(26, '13BCE0267', 1, 3, '2015-06-19 04:50:35', 0, 0, '4'),
(27, '13BCE0267', 1, 4, '2015-06-19 04:50:39', 0, 0, '5'),
(28, '13BCE0267', 1, 5, '2015-06-19 04:50:44', 0, 1, '6'),
(29, '13BCE0267', 1, 6, '2015-06-19 04:50:50', 0, 1, '7'),
(30, '13BCE0267', 1, 7, '2015-06-19 04:52:06', 0, 1, '8'),
(31, '13BCE0267', 9, 0, '2015-06-19 05:08:42', 0, 1, 'asdcascd'),
(32, '13BCE0267', 9, 1, '2015-06-19 05:34:32', 0, 1, 'asdc'),
(33, '13BCE0267', 10, 0, '2015-06-19 05:35:27', 0, 0, 'sdcasdc');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sell`
--

INSERT INTO `sell` (`id`, `name`, `category`, `cost`, `description`, `contact`, `uid`, `sold`) VALUES
(0, 'Calculator', 'Electrical', 200, 'a new scientific calculator', '7207246861', '4', 1),
(0, 'Calculator', 'Electrical', 200, 'a new scientific calculator', '7207246861', '4', 0),
(0, 'Calculator', 'Electrical', 200, 'asdnasjndckajsd', '9092658797', '4', 0);

-- --------------------------------------------------------

--
-- Table structure for table `try_login`
--

CREATE TABLE IF NOT EXISTS `try_login` (
  `user` varchar(10) NOT NULL,
  `pass` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `try_login`
--

INSERT INTO `try_login` (`user`, `pass`) VALUES
('a1', 'a1'),
('a2', 'a2'),
('a3', 'a3'),
('a4', 'a4'),
('a5', 'a5'),
('a6', 'a6');

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
