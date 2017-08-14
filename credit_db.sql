-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 14, 2017 at 04:23 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `credit_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_concreter`
--

CREATE TABLE IF NOT EXISTS `tbl_concreter` (
  `con_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `con_code` varchar(30) DEFAULT NULL,
  `con_name` varchar(60) NOT NULL,
  `con_gender` char(1) NOT NULL,
  `con_phone` varchar(30) DEFAULT NULL,
  `con_address` text,
  `con_status` char(1) NOT NULL,
  `con_age` tinyint(4) DEFAULT NULL,
  `con_desc` text NOT NULL,
  `user_crea` varchar(60) NOT NULL,
  `date_crea` date NOT NULL,
  `user_updt` varchar(60) DEFAULT NULL,
  `date_updt` date DEFAULT NULL,
  PRIMARY KEY (`con_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `tbl_concreter`
--

INSERT INTO `tbl_concreter` (`con_id`, `con_code`, `con_name`, `con_gender`, `con_phone`, `con_address`, `con_status`, `con_age`, `con_desc`, `user_crea`, `date_crea`, `user_updt`, `date_updt`) VALUES
(3, '001', 'ឃាង', 'm', '086830867', 'Lot 19–16, 113B Road, Phum Teuk Thla  Sangkat Teuk Thla, Khan Sen Sok  Phnom Penh  Cambodia ', '1', 24, '<strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'admin', '2017-08-11', 'admin', '2017-08-11'),
(4, '002', 'វណ្ណី', 'm', '086830867', 'Lot 19–16, 113B Road, Phum Teuk Thla  Sangkat Teuk Thla, Khan Sen Sok  Phnom Penh  Cambodia ', '1', 24, '<strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'admin', '2017-08-11', NULL, NULL),
(5, '003', 'វិបុល', 'm', '0868308670', 'Lot 19–16, 113B Road, Phum Teuk Thla  Sangkat Teuk Thla, Khan Sen Sok  Phnom Penh  Cambodia ', '1', 24, '<strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'admin', '2017-08-11', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payment`
--

CREATE TABLE IF NOT EXISTS `tbl_payment` (
  `pay_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sal_id` int(10) unsigned NOT NULL,
  `cost` decimal(18,2) NOT NULL,
  `amount_sale1` decimal(18,2) NOT NULL,
  `pump_cost` decimal(18,2) NOT NULL,
  `total_bal_sale1` decimal(18,2) NOT NULL,
  `payment` decimal(18,2) NOT NULL,
  `remaining` decimal(18,2) NOT NULL,
  `date_payment` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_crea` varchar(60) NOT NULL,
  `date_crea` date NOT NULL,
  PRIMARY KEY (`pay_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `tbl_payment`
--

INSERT INTO `tbl_payment` (`pay_id`, `sal_id`, `cost`, `amount_sale1`, `pump_cost`, `total_bal_sale1`, `payment`, `remaining`, `date_payment`, `user_crea`, `date_crea`) VALUES
(5, 5, '62.00', '23.00', '30.00', '1426.00', '100.00', '1326.00', '2017-08-13 16:44:43', 'admin', '2017-08-13'),
(6, 5, '62.00', '23.00', '30.00', '1456.00', '1000.00', '326.00', '2017-08-13 16:49:19', 'admin', '2017-08-13'),
(8, 5, '62.00', '23.00', '30.00', '1456.00', '326.00', '0.00', '2017-08-13 16:49:51', 'admin', '2017-08-13');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sale`
--

CREATE TABLE IF NOT EXISTS `tbl_sale` (
  `sal_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `con_id` int(10) unsigned NOT NULL,
  `customer_name` varchar(60) DEFAULT NULL,
  `customer_phone` varchar(30) DEFAULT NULL,
  `customer_address` text,
  `power` varchar(50) DEFAULT NULL,
  `cost` decimal(18,2) NOT NULL,
  `slump` varchar(50) DEFAULT NULL,
  `payment_duration` int(10) unsigned NOT NULL,
  `pump_cost` decimal(18,2) NOT NULL,
  `distance` int(10) unsigned NOT NULL,
  `set` decimal(18,2) DEFAULT NULL,
  `amount_sale` decimal(18,2) NOT NULL,
  `amount_sale1` decimal(18,2) DEFAULT NULL,
  `total_bal_sale` decimal(18,2) NOT NULL,
  `total_bal_sale1` decimal(18,2) DEFAULT NULL,
  `p` varchar(50) DEFAULT NULL,
  `payment_status` varchar(10) NOT NULL DEFAULT 'Pending',
  `sale_date` date NOT NULL,
  `sale_desc` text,
  `user_crea` varchar(60) NOT NULL,
  `date_crea` date NOT NULL,
  `user_updt` varchar(60) DEFAULT NULL,
  `date_updt` date DEFAULT NULL,
  PRIMARY KEY (`sal_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `tbl_sale`
--

INSERT INTO `tbl_sale` (`sal_id`, `con_id`, `customer_name`, `customer_phone`, `customer_address`, `power`, `cost`, `slump`, `payment_duration`, `pump_cost`, `distance`, `set`, `amount_sale`, `amount_sale1`, `total_bal_sale`, `total_bal_sale1`, `p`, `payment_status`, `sale_date`, `sale_desc`, `user_crea`, `date_crea`, `user_updt`, `date_updt`) VALUES
(3, 3, 'សុខ', '086830867', 'ស្រះចក', 'C280', '55.00', '12(+/-)2.5', 30, '30.00', 20, '2.00', '69.00', '67.00', '3825.00', '3715.00', 'P6', 'Pending', '2017-08-13', '<strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'admin', '2017-08-13', 'admin', '2017-08-13'),
(4, 4, 'សៀងម៉េង', '0860830867', 'សាលាលេខប្រាំ', 'C280', '64.00', '12(+/-)2.5', 7, '0.00', 100, '8.00', '56.00', '48.00', '3584.00', '3072.00', 'P3', 'Pending', '2017-07-12', '<strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'admin', '2017-08-13', 'admin', '2017-08-13'),
(5, 5, 'រីមី', '086830867', 'បែកចាន', 'C350', '62.00', '12(+/-)2.5', 30, '30.00', 45, '1.50', '24.50', '23.00', '1549.00', '1456.00', 'Pជ', 'Paid', '2017-06-12', '<strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'admin', '2017-08-13', 'admin', '2017-08-13');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE IF NOT EXISTS `tbl_user` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_code` varchar(50) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `user_pass` varchar(100) NOT NULL,
  `user_type` varchar(50) NOT NULL,
  `user_status` tinyint(1) unsigned NOT NULL,
  `user_desc` text,
  `user_crea` varchar(50) NOT NULL,
  `date_crea` date NOT NULL,
  `user_updt` varchar(50) DEFAULT NULL,
  `date_updt` date DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_code` (`user_code`),
  UNIQUE KEY `user_code_2` (`user_code`),
  UNIQUE KEY `user_code_3` (`user_code`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `user_code`, `user_name`, `user_pass`, `user_type`, `user_status`, `user_desc`, `user_crea`, `date_crea`, `user_updt`, `date_updt`) VALUES
(7, 'usr:003', 'choumeng', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Administrator', 1, 'Hello world', 'admin', '2017-06-22', 'samnang', '2017-08-01'),
(9, 'usr:004', 'samnang', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Inputer', 1, 'Hello wold', 'dara', '2017-06-22', 'samnang', '2017-08-01'),
(12, 'seller:001', 'seller', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Seller', 1, 'welcome to seller', 'dara', '2017-08-01', NULL, NULL),
(15, '001', 'admin', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Administrator', 1, 'This is for user admin to login', 'admin', '2017-08-11', NULL, NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
