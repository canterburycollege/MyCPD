-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 08, 2013 at 04:10 PM
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

-- --------------------------------------------------------

--
-- Table structure for table `activity`
--

DROP TABLE IF EXISTS `activity`;
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `activity`
--

INSERT INTO `activity` (`id`, `employee_id`, `title`, `provider`, `learning_outcomes`, `planned_date`, `cpd_type_id`, `target_id`, `priority_type_id`, `completed_date`, `evaluation_url`, `hours_of_cpd`, `rating`) VALUES
(1, 1, '                                                                                                                                Assessing learning                                                                                                        ', '', '                                                                                                                                Gather a range of assesment techniques to implement in class                                                              ', '2013-02-26', 1, 1, 7, '2013-02-26', ' ', '0.00', 0),
(2, 1, 'Mentoring new colleagues                      ', '', 'Some more learning outcomes, this field is currently set to have a maximum of 600 characters available in  the database.', '2013-02-26', 1, 2, 7, '2013-02-19', ' ', '0.00', 0),
(3, 1, 'Parents evening', '', 'some really important learning outcomes            ', '2013-03-01', 1, 4, 8, '0000-00-00', '', '0.00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `cpd_type`
--

DROP TABLE IF EXISTS `cpd_type`;
CREATE TABLE IF NOT EXISTS `cpd_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(50) NOT NULL,
  `sort_order` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `cpd_type`
--

INSERT INTO `cpd_type` (`id`, `description`, `sort_order`) VALUES
(1, 'Supported Experiment', 1),
(2, 'Coaching', 2),
(3, 'Peer Observation', 3),
(4, 'Other CPD type', 99);

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

DROP TABLE IF EXISTS `employee`;
CREATE TABLE IF NOT EXISTS `employee` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `display_name` varchar(50) NOT NULL,
  `moodle_user_id` int(11) NOT NULL,
  `mycpd_access_group` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `display_name`, `moodle_user_id`, `mycpd_access_group`) VALUES
(1, 'Treesa Green', 99, 'test');

-- --------------------------------------------------------

--
-- Table structure for table `employee_section`
--

DROP TABLE IF EXISTS `employee_section`;
CREATE TABLE IF NOT EXISTS `employee_section` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `employee_id` (`employee_id`,`section_id`),
  KEY `section_id` (`section_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

DROP TABLE IF EXISTS `faculty`;
CREATE TABLE IF NOT EXISTS `faculty` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `manager` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`id`, `title`, `manager`) VALUES
(0, 'Arts, Media & Publishing', 'Mark Howland');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

DROP TABLE IF EXISTS `news`;
CREATE TABLE IF NOT EXISTS `news` (
  `description` varchar(500) CHARACTER SET latin1 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `priority_type`
--

DROP TABLE IF EXISTS `priority_type`;
CREATE TABLE IF NOT EXISTS `priority_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(50) NOT NULL,
  `sort_order` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `priority_type`
--

INSERT INTO `priority_type` (`id`, `description`, `sort_order`) VALUES
(7, 'High', 1),
(8, 'Medium', 2),
(9, 'Low', 3);

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

DROP TABLE IF EXISTS `section`;
CREATE TABLE IF NOT EXISTS `section` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `manager` varchar(50) NOT NULL,
  `faculty_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `faculty_id` (`faculty_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `target`
--

DROP TABLE IF EXISTS `target`;
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

--
-- Dumping data for table `target`
--

INSERT INTO `target` (`id`, `title`, `description`, `status_id`, `employee_id`, `target_date`) VALUES
(1, 'Timely assessment of students', 'This is the description for target 1', 7, 1, '28/02/2013'),
(2, 'Update teaching & learning skills', 'A more detailed description of this target', 7, 1, NULL),
(3, 'Update subject specialism', 'Some text to describe this target...', 7, 1, NULL),
(4, 'Fulfil wider professional responsibilities', 'Make a positive contribution to the wider life and ethos of the College. communicate effectively with parents with regard to pupils’ achievements and well- being', 7, 1, NULL),
(5, 'New Target', 'New target...', 7, 1, '22/03/2013'),
(6, 'Fulfil wider professional responsibilities', 'Make a positive contribution to the wider life and ethos of the College. communicate effectively with parents with regard to pupilsâ€™ achievements and well- being', 7, 1, '04/03/2013'),
(7, 'Fulfil wider professional responsibilities', 'Make a positive contribution to the wider life and ethos of the College. communicate effectively with parents with regard to pupilsÃ¢â‚¬â„¢ achievements and well- being', 7, 1, '04/03/2013');

-- --------------------------------------------------------

--
-- Table structure for table `target_status`
--

DROP TABLE IF EXISTS `target_status`;
CREATE TABLE IF NOT EXISTS `target_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) DEFAULT NULL,
  `sort_order` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `target_status`
--

INSERT INTO `target_status` (`id`, `title`, `sort_order`) VALUES
(7, 'Current', 1),
(8, 'Archived', 2);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_activity`
--
DROP VIEW IF EXISTS `v_activity`;
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
DROP VIEW IF EXISTS `v_targets_with_status`;
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
-- Constraints for table `employee_section`
--
ALTER TABLE `employee_section`
  ADD CONSTRAINT `employee_section_ibfk_2` FOREIGN KEY (`section_id`) REFERENCES `section` (`id`),
  ADD CONSTRAINT `employee_section_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`id`);

--
-- Constraints for table `section`
--
ALTER TABLE `section`
  ADD CONSTRAINT `section_ibfk_1` FOREIGN KEY (`faculty_id`) REFERENCES `faculty` (`id`);

--
-- Constraints for table `target`
--
ALTER TABLE `target`
  ADD CONSTRAINT `target_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`id`),
  ADD CONSTRAINT `target_ibfk_2` FOREIGN KEY (`status_id`) REFERENCES `target_status` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
