-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 03, 2013 at 07:43 PM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mycpd`
--

-- --------------------------------------------------------

--
-- Table structure for table `Employee`
--

DROP TABLE IF EXISTS `Employee`;
CREATE TABLE IF NOT EXISTS `Employee` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `display_name` varchar(50) NOT NULL,
  `moodle_user_id` int(11) NOT NULL,
  `mycpd_access_group` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Table structure for table `Learning_plan`
--

DROP TABLE IF EXISTS `Learning_plan`;
CREATE TABLE IF NOT EXISTS `Learning_plan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `academic_year` int(4) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `learning_plan_unq` (`employee_id`,`academic_year`),
  KEY `employee_id` (`employee_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `Learning_plan_detail`
--

DROP TABLE IF EXISTS `Learning_plan_detail`;
CREATE TABLE IF NOT EXISTS `Learning_plan_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `learning_plan_id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `learning_outcomes` varchar(250) NOT NULL,
  `learning_plan_target_id` int(11) NOT NULL,
  `priority_type_id` int(11) NOT NULL,
  `target_date` date NOT NULL,
  `is_completed` tinyint(1) NOT NULL DEFAULT '0',
  `evaluation_url` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `learning_plan_id` (`learning_plan_id`),
  KEY `learning_plan_target_id` (`learning_plan_target_id`),
  KEY `priority_type_id` (`priority_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

-- --------------------------------------------------------

--
-- Table structure for table `Learning_plan_target`
--

DROP TABLE IF EXISTS `Learning_plan_target`;
CREATE TABLE IF NOT EXISTS `Learning_plan_target` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `learning_plan_id` int(11) NOT NULL,
  `description` varchar(250) NOT NULL,
  `sort_order` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `Priority_type`
--

DROP TABLE IF EXISTS `Priority_type`;
CREATE TABLE IF NOT EXISTS `Priority_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(50) NOT NULL,
  `sort_order` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_learning_plan_detail`
--
DROP VIEW IF EXISTS `v_learning_plan_detail`;
CREATE TABLE IF NOT EXISTS `v_learning_plan_detail` (
`learning_plan_id` int(11)
,`learning_plan_detail_id` int(11)
,`title` varchar(250)
,`learning_outcomes` varchar(250)
,`target_description` varchar(250)
,`priority_type` varchar(50)
,`target_date` date
,`is_completed` varchar(1)
,`evaluation_url` varchar(50)
,`target_sort_order` int(11)
,`priority_sort_order` int(2)
);
-- --------------------------------------------------------

--
-- Structure for view `v_learning_plan_detail`
--
DROP TABLE IF EXISTS `v_learning_plan_detail`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_learning_plan_detail` AS (select `lpd`.`learning_plan_id` AS `learning_plan_id`,`lpd`.`id` AS `learning_plan_detail_id`,`lpd`.`title` AS `title`,`lpd`.`learning_outcomes` AS `learning_outcomes`,`lpt`.`description` AS `target_description`,`pt`.`description` AS `priority_type`,`lpd`.`target_date` AS `target_date`,(case when (`lpd`.`is_completed` = 1) then 'Y' else 'N' end) AS `is_completed`,`lpd`.`evaluation_url` AS `evaluation_url`,`lpt`.`sort_order` AS `target_sort_order`,`pt`.`sort_order` AS `priority_sort_order` from ((`Learning_plan_detail` `lpd` left join `Learning_plan_target` `lpt` on((`lpd`.`learning_plan_target_id` = `lpt`.`id`))) left join `Priority_type` `pt` on((`lpd`.`priority_type_id` = `pt`.`id`))));

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Learning_plan`
--
ALTER TABLE `Learning_plan`
  ADD CONSTRAINT `Learning_plan_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `Employee` (`id`);

--
-- Constraints for table `Learning_plan_detail`
--
ALTER TABLE `Learning_plan_detail`
  ADD CONSTRAINT `Learning_plan_detail_ibfk_1` FOREIGN KEY (`learning_plan_id`) REFERENCES `Learning_plan` (`id`),
  ADD CONSTRAINT `Learning_plan_detail_ibfk_2` FOREIGN KEY (`learning_plan_target_id`) REFERENCES `Learning_plan_target` (`id`),
  ADD CONSTRAINT `Learning_plan_detail_ibfk_3` FOREIGN KEY (`priority_type_id`) REFERENCES `Priority_type` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
