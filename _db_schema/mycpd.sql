-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 15, 2013 at 03:59 PM
-- Server version: 5.5.24-log
-- PHP Version: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mycpd`
--
DROP DATABASE `mycpd`;
CREATE DATABASE `mycpd` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `mycpd`;

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE IF NOT EXISTS `employee` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `display_name` varchar(50) NOT NULL,
  `moodle_user_id` int(11) NOT NULL,
  `mycpd_access_group` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Table structure for table `learning_plan`
--

CREATE TABLE IF NOT EXISTS `learning_plan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `academic_year` int(4) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `learning_plan_unq` (`employee_id`,`academic_year`),
  KEY `employee_id` (`employee_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- Table structure for table `learning_plan_detail`
--

CREATE TABLE IF NOT EXISTS `learning_plan_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `learning_plan_id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `learning_outcomes` varchar(250) NOT NULL,
  `target_id` int(11) NOT NULL,
  `priority_type_id` int(11) NOT NULL,
  `is_completed` tinyint(1) NOT NULL DEFAULT '0',
  `evaluation_url` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `learning_plan_id` (`learning_plan_id`),
  KEY `learning_plan_target_id` (`target_id`),
  KEY `priority_type_id` (`priority_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `description` varchar(500) CHARACTER SET latin1 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `priority_type`
--

CREATE TABLE IF NOT EXISTS `priority_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(50) NOT NULL,
  `sort_order` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Table structure for table `target`
--

CREATE TABLE IF NOT EXISTS `target` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(150) DEFAULT NULL,
  `description` varchar(600) DEFAULT NULL,
  `status_id` int(11) DEFAULT NULL,
  `employee_id` int(20) DEFAULT NULL,
  `target_date` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `targets_ibfk_2` (`status_id`),
  KEY `targets_ibfk_1` (`employee_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=29 ;

-- --------------------------------------------------------

--
-- Table structure for table `target_status`
--

CREATE TABLE IF NOT EXISTS `target_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) DEFAULT NULL,
  `sort_order` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_learning_plan_detail`
--
CREATE TABLE IF NOT EXISTS `v_learning_plan_detail` (
`learning_plan_id` int(11)
,`learning_plan_detail_id` int(11)
,`title` varchar(250)
,`learning_outcomes` varchar(250)
,`target_description` varchar(600)
,`priority_type` varchar(50)
,`target_date` varchar(20)
,`target_status` varchar(50)
,`target_status_sort_order` int(11)
,`is_completed` varchar(1)
,`evaluation_url` varchar(50)
,`priority_sort_order` int(2)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `v_targets_with_status`
--
CREATE TABLE IF NOT EXISTS `v_targets_with_status` (
`id` int(11)
,`title` varchar(150)
,`description` varchar(600)
,`status` varchar(50)
,`employee_id` int(20)
,`target_date` varchar(20)
);
-- --------------------------------------------------------

--
-- Structure for view `v_learning_plan_detail`
--
DROP TABLE IF EXISTS `v_learning_plan_detail`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_learning_plan_detail` AS select `lpd`.`learning_plan_id` AS `learning_plan_id`,`lpd`.`id` AS `learning_plan_detail_id`,`lpd`.`title` AS `title`,`lpd`.`learning_outcomes` AS `learning_outcomes`,`t`.`title` AS `target_title`,`t`.`description` AS `target_description`,`pt`.`description` AS `priority_type`,`t`.`target_date` AS `target_date`,`ts`.`title` AS `target_status`,`ts`.`sort_order` AS `target_status_sort_order`,(case when (`lpd`.`is_completed` = 1) then 'Y' else 'N' end) AS `is_completed`,`lpd`.`evaluation_url` AS `evaluation_url`,`pt`.`sort_order` AS `priority_sort_order` from (((`learning_plan_detail` `lpd` left join `target` `t` on((`lpd`.`target_id` = `t`.`id`))) left join `target_status` `ts` on((`t`.`status_id` = `ts`.`id`))) left join `priority_type` `pt` on((`lpd`.`priority_type_id` = `pt`.`id`)));

-- --------------------------------------------------------

--
-- Structure for view `v_targets_with_status`
--
DROP TABLE IF EXISTS `v_targets_with_status`;

CREATE ALGORITHM=UNDEFINED DEFINER=`mycpd_admin`@`localhost` SQL SECURITY DEFINER VIEW `v_targets_with_status` AS select `target`.`id` AS `id`,`target`.`title` AS `title`,`target`.`description` AS `description`,`target_status`.`title` AS `status`,`target`.`employee_id` AS `employee_id`,`target`.`target_date` AS `target_date` from (`target` join `target_status` on((`target`.`status_id` = `target_status`.`id`)));

--
-- Constraints for dumped tables
--

--
-- Constraints for table `learning_plan`
--
ALTER TABLE `learning_plan`
  ADD CONSTRAINT `Learning_plan_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`id`);

--
-- Constraints for table `learning_plan_detail`
--
ALTER TABLE `learning_plan_detail`
  ADD CONSTRAINT `Learning_plan_detail_ibfk_1` FOREIGN KEY (`learning_plan_id`) REFERENCES `learning_plan` (`id`),
  ADD CONSTRAINT `Learning_plan_detail_ibfk_3` FOREIGN KEY (`priority_type_id`) REFERENCES `priority_type` (`id`),
  ADD CONSTRAINT `Learning_plan_detail_ibfk_2` FOREIGN KEY (`target_id`) REFERENCES `target` (`id`);

--
-- Constraints for table `target`
--
ALTER TABLE `target`
  ADD CONSTRAINT `target_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`id`),
  ADD CONSTRAINT `target_ibfk_2` FOREIGN KEY (`status_id`) REFERENCES `target_status` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
