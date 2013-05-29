-- phpMyAdmin SQL Dump
-- version 3.5.8.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 28, 2013 at 06:10 PM
-- Server version: 5.5.31-0ubuntu0.13.04.1
-- PHP Version: 5.4.9-4ubuntu2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `online_education`
--

-- --------------------------------------------------------

--
-- Table structure for table `managers`
--

CREATE TABLE IF NOT EXISTS `managers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` enum('admin','financial','teacher') COLLATE utf8_persian_ci NOT NULL DEFAULT 'admin',
  `name` varchar(200) COLLATE utf8_persian_ci NOT NULL,
  `family` varchar(200) COLLATE utf8_persian_ci NOT NULL,
  `username` varchar(50) COLLATE utf8_persian_ci NOT NULL,
  `password` varchar(32) COLLATE utf8_persian_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8_persian_ci NOT NULL,
  `family` varchar(200) COLLATE utf8_persian_ci NOT NULL,
  `mobile` int(11) NOT NULL,
  `age` int(3) NOT NULL,
  `gender` enum('male','female') COLLATE utf8_persian_ci NOT NULL,
  `melli_code` int(10) NOT NULL,
  `email` varchar(50) COLLATE utf8_persian_ci NOT NULL,
  `field_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `melli_code` (`melli_code`,`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
