-- phpMyAdmin SQL Dump
-- version 3.5.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 23, 2013 at 12:59 AM
-- Server version: 5.1.68-cll
-- PHP Version: 5.3.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `givhandl_q`
--

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
  `cmt_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) COLLATE utf8_persian_ci NOT NULL,
  `text` text COLLATE utf8_persian_ci NOT NULL,
  `sender` int(11) NOT NULL,
  `recipient` int(11) NOT NULL,
  `date` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  PRIMARY KEY (`cmt_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE IF NOT EXISTS `course` (
  `c_id` int(11) NOT NULL AUTO_INCREMENT,
  `c_code` int(11) NOT NULL,
  `name` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `capacity` int(11) NOT NULL,
  `fixed_cost` varchar(100) COLLATE utf8_persian_ci NOT NULL,
  `time` varchar(50) COLLATE utf8_persian_ci NOT NULL,
  `period` varchar(50) COLLATE utf8_persian_ci NOT NULL,
  `doc` text COLLATE utf8_persian_ci NOT NULL,
  `content` text COLLATE utf8_persian_ci NOT NULL,
  PRIMARY KEY (`c_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE IF NOT EXISTS `department` (
  `d_id` int(11) NOT NULL AUTO_INCREMENT,
  `d_code` int(11) NOT NULL,
  `content` text COLLATE utf8_persian_ci NOT NULL,
  PRIMARY KEY (`d_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `exam`
--

CREATE TABLE IF NOT EXISTS `exam` (
  `e_id` int(11) NOT NULL AUTO_INCREMENT,
  `o_id` int(11) NOT NULL,
  `s_code` int(11) NOT NULL,
  `true_ans` int(11) NOT NULL,
  `false_ans` int(11) NOT NULL,
  PRIMARY KEY (`e_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `financial`
--

CREATE TABLE IF NOT EXISTS `financial` (
  `f_id` int(11) NOT NULL AUTO_INCREMENT,
  `s_code` int(11) NOT NULL,
  `add_credit` varchar(50) CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL,
  PRIMARY KEY (`f_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `online_exam`
--

CREATE TABLE IF NOT EXISTS `online_exam` (
  `o_id` int(11) NOT NULL AUTO_INCREMENT,
  `c_code` int(11) NOT NULL,
  `question` text COLLATE utf8_persian_ci NOT NULL,
  `option` text COLLATE utf8_persian_ci NOT NULL,
  `answer` text COLLATE utf8_persian_ci NOT NULL,
  `total_q` int(11) NOT NULL,
  `time` varchar(20) COLLATE utf8_persian_ci NOT NULL,
  `date` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `duration` varchar(20) COLLATE utf8_persian_ci NOT NULL,
  `active` int(2) NOT NULL,
  PRIMARY KEY (`o_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `permission`
--

CREATE TABLE IF NOT EXISTS `permission` (
  `p_id` int(11) NOT NULL AUTO_INCREMENT,
  `p_name` varchar(50) COLLATE utf8_persian_ci NOT NULL,
  `add_user` int(2) NOT NULL,
  `edit_user` int(2) NOT NULL,
  `add_financial` int(2) NOT NULL,
  `log_findancial` int(2) NOT NULL,
  `add_departement` int(2) NOT NULL,
  `add_fix_cost` int(2) NOT NULL,
  `add_capacity` int(2) NOT NULL,
  `add_time` int(2) NOT NULL,
  `add_period` int(2) NOT NULL,
  `add_teacher` int(2) NOT NULL,
  `add_doc` int(2) NOT NULL,
  `student_status` int(2) NOT NULL,
  `confrim_student` int(2) NOT NULL,
  `student_financial_status` int(2) NOT NULL,
  `suspend_student_course` int(2) NOT NULL,
  `suspend_student_site` int(2) NOT NULL,
  `add_student` int(2) NOT NULL,
  `exam_status` int(2) NOT NULL,
  `online_exam` int(2) NOT NULL,
  `post_information` int(2) NOT NULL,
  `comment` int(2) NOT NULL,
  `edit_financial` int(2) NOT NULL,
  PRIMARY KEY (`p_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE IF NOT EXISTS `post` (
  `p_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) COLLATE utf8_persian_ci NOT NULL,
  `text` text COLLATE utf8_persian_ci NOT NULL,
  `fulltext` text COLLATE utf8_persian_ci NOT NULL,
  `date` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  PRIMARY KEY (`p_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE IF NOT EXISTS `students` (
  `s_id` int(11) NOT NULL AUTO_INCREMENT,
  `s_code` int(11) NOT NULL,
  `name` varchar(200) CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL,
  `tel` int(11) NOT NULL,
  `national_code` int(10) NOT NULL,
  `c_code` int(11) NOT NULL,
  `active` int(11) NOT NULL,
  `total_cost` varchar(100) CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL,
  PRIMARY KEY (`s_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `u_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(200) COLLATE utf8_persian_ci NOT NULL,
  `password` varchar(32) COLLATE utf8_persian_ci NOT NULL,
  `per_id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_persian_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_persian_ci NOT NULL,
  `tel` int(11) NOT NULL,
  `pic` text COLLATE utf8_persian_ci NOT NULL,
  `content` text COLLATE utf8_persian_ci NOT NULL,
  PRIMARY KEY (`u_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
