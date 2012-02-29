-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 10, 2010 at 10:34 AM
-- Server version: 5.1.36
-- PHP Version: 5.2.11

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `latest`
--

-- --------------------------------------------------------

--
-- Table structure for table `top_flights`
--

CREATE TABLE IF NOT EXISTS `top_flights` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pilot_id` int(4) NOT NULL,
  `flights` int(4) NOT NULL,
  `hours` int(4) NOT NULL,
  `miles` int(6) NOT NULL DEFAULT '0',
  `month` int(2) NOT NULL,
  `year` int(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;
