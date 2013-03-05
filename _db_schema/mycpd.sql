-- phpMyAdmin SQL Dump
-- version 3.5.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 05, 2013 at 10:10 AM
-- Server version: 5.1.66-community-log
-- PHP Version: 5.3.10

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
-- Table structure for table `activity`
--

CREATE TABLE IF NOT EXISTS `activity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `provider` varchar(250) NOT NULL,
  `learning_outcomes` varchar(250) NOT NULL,
  `planned_date` date NOT NULL,
  `cpd_type_id` int(11) DEFAULT NULL,
  `target_id` int(11) NOT NULL,
  `priority_type_id` int(11) DEFAULT NULL,
  `completed_date` date DEFAULT NULL,
  `evaluation_url` varchar(50) DEFAULT NULL,
  `hours_of_cpd` decimal(7,2) NOT NULL,
  `rating` int(1) DEFAULT NULL COMMENT 'rating out of 5',
  PRIMARY KEY (`id`),
  KEY `learning_plan_target_id` (`target_id`),
  KEY `priority_type_id` (`priority_type_id`),
  KEY `employee_id` (`employee_id`),
  KEY `cpd_type_id` (`cpd_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `cpd_type`
--

CREATE TABLE IF NOT EXISTS `cpd_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(50) NOT NULL,
  `sort_order` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `description` varchar(1024) DEFAULT NULL
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- Table structure for table `target_status`
--

CREATE TABLE IF NOT EXISTS `target_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) DEFAULT NULL,
  `sort_order` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_activity`
--
CREATE TABLE IF NOT EXISTS `v_activity` (
`id` int(11)
,`employee_id` int(11)
,`title` varchar(250)
,`provider` varchar(250)
,`learning_outcomes` varchar(250)
,`planned_date` date
,`cpd_type_id` int(11)
,`cpd_type` varchar(50)
,`target_id` int(11)
,`target` varchar(150)
,`priority_type_id` int(11)
,`priority_type` varchar(50)
,`completed_date` date
,`evaluation_url` varchar(50)
,`hours_of_cpd` decimal(7,2)
,`rating` int(1)
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
-- Structure for view `v_activity`
--
DROP TABLE IF EXISTS `v_activity`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_activity` AS (select `activity`.`id` AS `id`,`activity`.`employee_id` AS `employee_id`,`activity`.`title` AS `title`,`activity`.`provider` AS `provider`,`activity`.`learning_outcomes` AS `learning_outcomes`,`activity`.`planned_date` AS `planned_date`,`activity`.`cpd_type_id` AS `cpd_type_id`,`cpd_type`.`description` AS `cpd_type`,`activity`.`target_id` AS `target_id`,`target`.`title` AS `target`,`activity`.`priority_type_id` AS `priority_type_id`,`priority_type`.`description` AS `priority_type`,`activity`.`completed_date` AS `completed_date`,`activity`.`evaluation_url` AS `evaluation_url`,`activity`.`hours_of_cpd` AS `hours_of_cpd`,`activity`.`rating` AS `rating` from (((`activity` left join `cpd_type` on((`activity`.`cpd_type_id` = `cpd_type`.`id`))) left join `priority_type` on((`activity`.`priority_type_id` = `priority_type`.`id`))) left join `target` on((`activity`.`target_id` = `target`.`id`))));

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
-- Constraints for table `activity`
--
ALTER TABLE `activity`
  ADD CONSTRAINT `activity_ibfk_1` FOREIGN KEY (`cpd_type_id`) REFERENCES `cpd_type` (`id`),
  ADD CONSTRAINT `activity_ibfk_2` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`id`),
  ADD CONSTRAINT `Learning_plan_detail_ibfk_2` FOREIGN KEY (`target_id`) REFERENCES `target` (`id`),
  ADD CONSTRAINT `Learning_plan_detail_ibfk_3` FOREIGN KEY (`priority_type_id`) REFERENCES `priority_type` (`id`);

--
-- Constraints for table `target`
--
ALTER TABLE `target`
  ADD CONSTRAINT `target_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`id`),
  ADD CONSTRAINT `target_ibfk_2` FOREIGN KEY (`status_id`) REFERENCES `target_status` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
