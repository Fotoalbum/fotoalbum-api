-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: 10.1.187.11
-- Generation Time: Sep 05, 2013 at 11:47 AM
-- Server version: 5.1.63-log
-- PHP Version: 5.4.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `xhibit_1_0`
--

-- --------------------------------------------------------

--
-- Table structure for table `xhibit_printers`
--

CREATE TABLE IF NOT EXISTS `xhibit_printers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `payee_name` varchar(255) DEFAULT NULL,
  `website` varchar(255) NOT NULL,
  `kvk_nr` varchar(100) NOT NULL,
  `bank_nr` varchar(100) NOT NULL,
  `bank` varchar(100) NOT NULL,
  `bic` varchar(50) NOT NULL,
  `iban` varchar(50) NOT NULL,
  `vat_nr` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `task` text NOT NULL COMMENT 'Omschrijving werkzaamheden',
  `membership_id` int(11) NOT NULL,
  `membership_status` tinyint(1) NOT NULL COMMENT 'Geverifieerde gebruiker',
  `share_public` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `lnk_picture` varchar(255) DEFAULT NULL,
  `lnk_picture_normal` varchar(255) DEFAULT NULL,
  `lnk_picture_thumb` varchar(255) DEFAULT NULL,
  `lnk_picture_large` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=66 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
