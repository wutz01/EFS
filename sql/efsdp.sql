-- phpMyAdmin SQL Dump
-- version 4.0.10.18
-- https://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Mar 24, 2017 at 07:46 PM
-- Server version: 5.5.54-cll
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `icodefor_efsdp`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE IF NOT EXISTS `account` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `usertype` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=69 ;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `email`, `password`, `usertype`) VALUES
(1, 'amlacorte@firstasia.edu.ph', '1234567', 'dean'),
(2, 'mlmalabanan@firstasia.edu.ph', '1234567', 'chair'),
(3, 'jhgamayon@firstasia.edu.ph', '1234567', 'faculty'),
(4, 'jpcruz@firstasia.edu.ph', '1234567', 'faculty'),
(5, 'lvmanalo@firstasia.edu.ph', '1234567', 'vpar'),
(6, 'hr@firstasia.edu.ph', '1234567', 'hr'),
(55, 'smgevana@firstasia.edu.ph', '1234567', 'dean'),
(56, 'tmcabrillas@firstasia.edu.ph', '1234567', 'dean'),
(57, 'dmvelecina@firstasia.edu.ph', '1234567', 'dean'),
(58, 'mmdurana@firstasia.edu.ph', '1234567', 'dean'),
(59, 'research@firstasia.edu.ph', '1234567', 'research'),
(60, 'md@firstasia.edu.ph', '1234567', 'md'),
(61, 'face@firstasia.edu.ph', '1234567', 'face'),
(62, 'rlmanongsong@firstasia.edu.ph', '1234567', 'faculty'),
(63, 'rrnatividad@firstasia.edu.ph', '1234567', 'faculty'),
(64, 'avepa@firstasia.edu.ph', '1234567', 'faculty'),
(65, 'aldelizo@firstasia.edu.ph', '1234567', 'faculty');

-- --------------------------------------------------------

--
-- Table structure for table `faith_department`
--

CREATE TABLE IF NOT EXISTS `faith_department` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `department` varchar(255) NOT NULL,
  `abbr` varchar(10) NOT NULL,
  `school_id` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `faith_department`
--

INSERT INTO `faith_department` (`id`, `department`, `abbr`, `school_id`) VALUES
(1, 'College of Computing Information and Technology', 'CCIT', '1'),
(2, 'College of Engineering', 'COE', '1'),
(3, 'College of Public Safety', 'COPS', '1'),
(4, 'College of International Hospitality Management', 'CIHM', '3'),
(5, 'College of Arts and Science', 'CAS', '2'),
(6, 'College of Nursing', 'CON', '2'),
(7, 'College of Education', 'COED', '2'),
(8, 'College of Business and Accountancy', 'CBA', '3');

-- --------------------------------------------------------

--
-- Table structure for table `faith_school`
--

CREATE TABLE IF NOT EXISTS `faith_school` (
  `id` int(11) NOT NULL,
  `school` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `faith_school`
--

INSERT INTO `faith_school` (`id`, `school`) VALUES
(1, 'School of Technology'),
(2, 'School of Humanities'),
(3, 'School of Management');

-- --------------------------------------------------------

--
-- Table structure for table `hr_inhouse`
--

CREATE TABLE IF NOT EXISTS `hr_inhouse` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `venue` varchar(255) NOT NULL,
  `datetime` datetime NOT NULL,
  `academicyear` varchar(9) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hr_inhouse`
--

INSERT INTO `hr_inhouse` (`id`, `title`, `venue`, `datetime`, `academicyear`) VALUES
(286437988, 'semanasd', 'vnueeeee', '2017-02-16 00:00:00', '2016-2017'),
(615142822, 'New inhouse', 'new venue', '2017-01-01 02:55:00', '2016-2017');

-- --------------------------------------------------------

--
-- Table structure for table `hr_inhouse_emp`
--

CREATE TABLE IF NOT EXISTS `hr_inhouse_emp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `inhouse_id` varchar(200) NOT NULL,
  `emp_email` varchar(200) NOT NULL,
  `attended` varchar(3) NOT NULL DEFAULT 'no',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `hr_inhouse_emp`
--

INSERT INTO `hr_inhouse_emp` (`id`, `inhouse_id`, `emp_email`, `attended`) VALUES
(1, '286437988', 'jpcruz@firstasia.edu.ph', 'yes'),
(2, '286437988', 'dmvelecina@firstasia.edu.ph', 'no'),
(3, '286437988', 'mmdurana@firstasia.edu.ph', 'no'),
(4, '286437988', 'jhgamayon@firstasia.edu.ph', 'no'),
(5, '615142822', 'amlacorte@firstasia.edu.ph', 'no'),
(6, '615142822', 'mlmalabanan@firstasia.edu.ph', 'no'),
(7, '615142822', 'jpcruz@firstasia.edu.ph', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `masbreakdown`
--

CREATE TABLE IF NOT EXISTS `masbreakdown` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `masid` varchar(50) NOT NULL,
  `numofdean` varchar(50) NOT NULL,
  `numofchair` varchar(50) NOT NULL,
  `numoffaculty` varchar(50) NOT NULL,
  `deanHotel` varchar(50) NOT NULL,
  `chairHotel` varchar(50) NOT NULL,
  `facultyHotel` varchar(50) NOT NULL,
  `deanDiem` varchar(50) NOT NULL,
  `chairDiem` varchar(50) NOT NULL,
  `facultyDiem` varchar(50) NOT NULL,
  `regDean` varchar(50) NOT NULL,
  `regChair` varchar(50) NOT NULL,
  `regFaculty` varchar(50) NOT NULL,
  `transpoDean` varchar(50) NOT NULL,
  `transpoChair` varchar(50) NOT NULL,
  `transpoFaculty` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `masbreakdown`
--

INSERT INTO `masbreakdown` (`id`, `masid`, `numofdean`, `numofchair`, `numoffaculty`, `deanHotel`, `chairHotel`, `facultyHotel`, `deanDiem`, `chairDiem`, `facultyDiem`, `regDean`, `regChair`, `regFaculty`, `transpoDean`, `transpoChair`, `transpoFaculty`) VALUES
(23, 'mas1489768703865516332', '1', '1', '2', '2000', '1600', '2000', '300', '300', '600', '4500', '4500', '4500', '8000', '8000', '8000'),
(24, 'mas1489768703398231382', '1', '1', '1', '3000', '2400', '1500', '450', '450', '450', '5500', '5500', '5500', '3500', '3500', '3500'),
(25, 'mas14898201991131691949', '1', '1', '1', '0', '0', '0', '150', '150', '150', '2500', '2500', '2500', '1500', '1500', '1500'),
(26, 'mas14898394191223943428', '1', '2', '5', '2000', '3200', '5000', '300', '600', '1500', '5000', '5000', '5000', '1000', '1000', '1000');

-- --------------------------------------------------------

--
-- Table structure for table `mas_category`
--

CREATE TABLE IF NOT EXISTS `mas_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `mas_category`
--

INSERT INTO `mas_category` (`id`, `category`) VALUES
(2, 'Research'),
(3, 'FACE'),
(4, 'Instructions'),
(5, 'Others');

-- --------------------------------------------------------

--
-- Table structure for table `mas_proposed`
--

CREATE TABLE IF NOT EXISTS `mas_proposed` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mas_id` varchar(255) NOT NULL,
  `docs` text NOT NULL,
  `actual` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `mas_proposed`
--

INSERT INTO `mas_proposed` (`id`, `mas_id`, `docs`, `actual`) VALUES
(5, 'mas1489768703865516332', '', 0),
(6, 'mas1489768703398231382', 'Image_00116 (1).pdf', 5000),
(8, 'mas14898201991131691949', '', 0),
(9, 'mas14898394191223943428', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `mustattend`
--

CREATE TABLE IF NOT EXISTS `mustattend` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `masid` varchar(50) NOT NULL,
  `academicyear` varchar(50) NOT NULL,
  `datecreated` varchar(50) NOT NULL,
  `school` varchar(50) NOT NULL,
  `department` varchar(50) NOT NULL,
  `title` varchar(300) NOT NULL,
  `category` varchar(50) NOT NULL,
  `sponsor` varchar(200) NOT NULL,
  `dates` date NOT NULL,
  `numdays` varchar(50) NOT NULL,
  `venue` varchar(200) NOT NULL,
  `numperson` varchar(50) NOT NULL,
  `budget` varchar(50) NOT NULL,
  `dean_status` varchar(50) NOT NULL,
  `dean_note` varchar(300) NOT NULL,
  `vp_status` varchar(50) NOT NULL,
  `vp_note` varchar(300) NOT NULL,
  `hr_status` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `masid` (`masid`),
  KEY `category` (`category`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=52 ;

--
-- Dumping data for table `mustattend`
--

INSERT INTO `mustattend` (`id`, `masid`, `academicyear`, `datecreated`, `school`, `department`, `title`, `category`, `sponsor`, `dates`, `numdays`, `venue`, `numperson`, `budget`, `dean_status`, `dean_note`, `vp_status`, `vp_note`, `hr_status`) VALUES
(48, 'mas1489768703865516332', '2016-2017', 'Mar 17, 2017 16:28pm', 'School of Technology', 'CCIT', 'CSP Convention', 'Research', 'CSP', '2017-04-13', '2', 'Cebu', '1 Dean; 1 Chair; 2 Faculty', '88,800.00', 'New', 'New', 'New', 'New', 'New'),
(49, 'mas1489768703398231382', '2016-2017', 'Mar 17, 2017 16:28pm', 'School of Technology', 'CCIT', 'PSITE Regional Conference', 'Instructions', 'PSITE', '2017-03-28', '3', 'ROMBLON', '1 Dean; 1 Chair; 1 Faculty', '45,750.00', 'New', 'New', 'New', 'New', 'New'),
(50, 'mas14898201991131691949', '2016-2017', 'Mar 18, 2017 14:55pm', 'School of Technology', 'CCIT', 'PICCA Fest', 'FACE', 'PICCA', '2017-04-07', '1', 'Manila', '1 Dean; 1 Chair; 1 Faculty', '16,950.00', 'New', 'New', 'New', 'New', 'New'),
(51, 'mas14898394191223943428', '2016-2017', 'Mar 18, 2017 20:15pm', 'School of Technology', 'CCIT', 'ISITE', 'Research', 'isite', '2017-03-31', '2', 'mla', '1 Dean; 2 Chair; 5 Faculty', '68,600.00', 'New', 'New', 'New', 'New', 'New');

-- --------------------------------------------------------

--
-- Table structure for table `mustattendremarks`
--

CREATE TABLE IF NOT EXISTS `mustattendremarks` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `dates` varchar(50) NOT NULL,
  `annualyear` varchar(50) NOT NULL,
  `department` varchar(50) NOT NULL,
  `dean_status` varchar(50) NOT NULL,
  `dean_note` varchar(500) NOT NULL,
  `vp_status` varchar(50) NOT NULL,
  `vp_note` varchar(500) NOT NULL,
  `hr_status` varchar(50) NOT NULL,
  `hr_note` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `mustattendremarks`
--

INSERT INTO `mustattendremarks` (`id`, `dates`, `annualyear`, `department`, `dean_status`, `dean_note`, `vp_status`, `vp_note`, `hr_status`, `hr_note`) VALUES
(6, '2017-18-03', '2016-2017', 'CCIT', 'Revision', '', 'New', 'New', 'New', 'New');

-- --------------------------------------------------------

--
-- Table structure for table `notif`
--

CREATE TABLE IF NOT EXISTS `notif` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) NOT NULL,
  `user_from` varchar(100) NOT NULL,
  `user_to` varchar(100) NOT NULL,
  `content` varchar(512) NOT NULL,
  `college` varchar(10) NOT NULL,
  `has_read` int(11) NOT NULL,
  `date_created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `notif`
--

INSERT INTO `notif` (`id`, `type`, `user_from`, `user_to`, `content`, `college`, `has_read`, `date_created`) VALUES
(23, 'seminar', 'mlmalabanan@firstasia.edu.ph', 'dean', 'New Seminar <span class=''text-warning''>pending</span> for your approval.', 'CCIT', 0, '2017-03-18 16:05:00'),
(24, 'seminar', 'jhgamayon@firstasia.edu.ph', 'chair', 'New Seminar <span class=''text-warning''>pending</span> for your approval.', 'CCIT', 1, '2017-03-18 20:08:05');

-- --------------------------------------------------------

--
-- Table structure for table `otherfee`
--

CREATE TABLE IF NOT EXISTS `otherfee` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sem_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `value` decimal(20,2) NOT NULL,
  `type` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `otherfee`
--

INSERT INTO `otherfee` (`id`, `sem_id`, `title`, `value`, `type`) VALUES
(1, 5426940, 'asd', '100.00', 'others'),
(2, 5426940, 'ww', '900.00', 'others'),
(3, 2859436, 'Shoe Fee', '200.00', 'others');

-- --------------------------------------------------------

--
-- Table structure for table `othersem`
--

CREATE TABLE IF NOT EXISTS `othersem` (
  `otherSem_id` int(50) NOT NULL AUTO_INCREMENT,
  `academicyear` varchar(50) NOT NULL,
  `datecreated` varchar(50) NOT NULL,
  `school` varchar(50) NOT NULL,
  `department` varchar(50) NOT NULL,
  `title` varchar(300) NOT NULL,
  `category` varchar(50) NOT NULL,
  `sponsor` varchar(200) NOT NULL,
  `dates` varchar(50) NOT NULL,
  `numdays` varchar(50) NOT NULL,
  `venue` varchar(200) NOT NULL,
  `numperson` varchar(50) NOT NULL,
  `budget` varchar(50) NOT NULL,
  `dean_status` varchar(50) NOT NULL DEFAULT 'New',
  `dean_note` varchar(300) NOT NULL DEFAULT 'New',
  `vp_status` varchar(50) NOT NULL DEFAULT 'New',
  `vp_note` varchar(300) NOT NULL DEFAULT 'New',
  `hr_status` varchar(50) NOT NULL DEFAULT 'New',
  PRIMARY KEY (`otherSem_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5426941 ;

-- --------------------------------------------------------

--
-- Table structure for table `othersembreakdown`
--

CREATE TABLE IF NOT EXISTS `othersembreakdown` (
  `otherSem_id` int(50) NOT NULL AUTO_INCREMENT,
  `numofdean` varchar(50) NOT NULL,
  `numofchair` varchar(50) NOT NULL,
  `numoffaculty` varchar(50) NOT NULL,
  `deanHotel` varchar(50) NOT NULL,
  `chairHotel` varchar(50) NOT NULL,
  `facultyHotel` varchar(50) NOT NULL,
  `deanDiem` varchar(50) NOT NULL,
  `chairDiem` varchar(50) NOT NULL,
  `facultyDiem` varchar(50) NOT NULL,
  `regDean` varchar(50) NOT NULL,
  `regChair` varchar(50) NOT NULL,
  `regFaculty` varchar(50) NOT NULL,
  `transpoDean` varchar(50) NOT NULL,
  `transpoChair` varchar(50) NOT NULL,
  `transpoFaculty` varchar(50) NOT NULL,
  PRIMARY KEY (`otherSem_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5426941 ;

-- --------------------------------------------------------

--
-- Table structure for table `othersem_proposed`
--

CREATE TABLE IF NOT EXISTS `othersem_proposed` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `othersem_id` varchar(255) NOT NULL,
  `docs` text NOT NULL,
  `actual` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE IF NOT EXISTS `profile` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `middlename` varchar(50) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `designation` varchar(50) NOT NULL,
  `college` varchar(50) NOT NULL,
  `school` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=59 ;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`id`, `email`, `lastname`, `middlename`, `firstname`, `designation`, `college`, `school`) VALUES
(1, 'amlacorte@firstasia.edu.ph', 'Lacorte', 'Maldonado', 'Alice', 'dean', 'CCIT', 'Technology'),
(2, 'mlmalabanan@firstasia.edu.ph', 'Malabanan', 'Landicho', 'Maricel', 'chair', 'CCIT', 'Technology'),
(3, 'jhgamayon@firstasia.edu.ph', 'Gamayon', 'Hernandez', 'Jesus', 'faculty', 'CCIT', 'Technology'),
(4, 'jpcruz@firstasia.edu.ph', 'Cruz', 'Pinangang', 'Jerwin', 'faculty', 'CCIT', 'Technology'),
(5, 'lvmanalo@firstasia.edu.ph', 'Manalo', 'V', 'Lalaine', 'Vice President for Academics', 'CBA', 'Management'),
(44, 'smgevana@firstasia.edu.ph', 'GevaÃ±a', 'M', 'Sherryl', 'dean', 'COE', 'Technology'),
(45, 'tmcabrillas@firstasia.edu.ph', 'Cabrillas', 'L', 'Tomas', 'dean', 'COPS', 'Technology'),
(46, 'dmvelecina@firstasia.edu.ph', 'Velecina', 'M', 'Diane Cherie', 'dean', 'COED', 'Humanities'),
(47, 'mmdurana@firstasia.edu.ph', 'Durana', 'M', 'Merlita', 'dean', 'CBA', 'Management'),
(48, 'hr@firstasia.edu.ph', 'hr', 'hr', 'hr', 'hr', 'hr', 'hr'),
(49, 'research@firstasia.edu.ph', 'research', 'research', 'research', 'research', 'research', 'research'),
(50, 'md@firstasia.edu.ph', 'md', 'md', 'md', 'md', 'md', 'md'),
(51, 'face@firstasia.edu.ph', 'face', 'face', 'face', 'face', 'face', 'face'),
(52, 'rlmanongsong@firstasia.edu.ph', 'Manongsong', 'B', 'Rommuelle', 'staff', 'CCIT', 'Management'),
(53, 'rrnatividad@firstasia.edu.ph', 'Natividad', 'R', 'Reymark', 'faculty', 'CCIT', 'Management'),
(54, 'avepa@firstasia.edu.ph', 'Epa', 'Villa', 'Alpha Liezel', 'faculty', 'CCIT', 'Management'),
(55, 'aldelizo@firstasia.edu.ph', 'Delizo', 'L', 'April', 'faculty', 'CCIT', 'Technology');

-- --------------------------------------------------------

--
-- Table structure for table `sem_emp`
--

CREATE TABLE IF NOT EXISTS `sem_emp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sem_id` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `echoSched` varchar(255) NOT NULL,
  `documents` varchar(512) NOT NULL,
  `reasons` text NOT NULL,
  `type` varchar(3) NOT NULL,
  `attended` varchar(3) NOT NULL DEFAULT 'no',
  `chair_status` int(11) NOT NULL,
  `dean_status` int(11) NOT NULL,
  `vpar_status` int(11) NOT NULL,
  `hr_status` int(11) NOT NULL,
  `md_status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=41 ;

--
-- Dumping data for table `sem_emp`
--

INSERT INTO `sem_emp` (`id`, `sem_id`, `email`, `echoSched`, `documents`, `reasons`, `type`, `attended`, `chair_status`, `dean_status`, `vpar_status`, `hr_status`, `md_status`) VALUES
(39, 'mas1489768703398231382', 'mlmalabanan@firstasia.edu.ph', '2017-04-01', 'Cover Page.docx', 'to gain knowledge', 'MAS', 'yes', 1, 0, 0, 0, 0),
(40, 'mas1489768703398231382', 'jhgamayon@firstasia.edu.ph', '2017-04-07', 'Image_00117.pdf', '', 'MAS', 'yes', 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tna`
--

CREATE TABLE IF NOT EXISTS `tna` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `datecreated` varchar(50) NOT NULL,
  `department` varchar(50) NOT NULL,
  `annualyear` varchar(50) NOT NULL,
  `job_role` varchar(50) NOT NULL,
  `position_importance` varchar(50) NOT NULL,
  `ability` varchar(50) NOT NULL,
  `competency` varchar(50) NOT NULL,
  `developmentplan` varchar(100) NOT NULL,
  `evidence` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=147 ;

--
-- Dumping data for table `tna`
--

INSERT INTO `tna` (`id`, `email`, `datecreated`, `department`, `annualyear`, `job_role`, `position_importance`, `ability`, `competency`, `developmentplan`, `evidence`) VALUES
(137, 'avepa@firstasia.edu.ph', 'Mar 18,2017 01:05am', 'CCIT', '2016-2017', 'Classroom Management', '5', '4', '-1', 'Maybe considered as in-house training along with other personnel', ''),
(138, 'avepa@firstasia.edu.ph', 'Mar 18,2017 01:05am', 'CCIT', '2016-2017', 'Teaching Strategies', '5', '4', '-1', 'Maybe considered as in-house training along with other personnel', ' '),
(139, 'avepa@firstasia.edu.ph', 'Mar 18,2017 01:05am', 'CCIT', '2016-2017', 'Outcomes-Based Education', '5', '4', '-1', 'Coaching/Feedback mechanism', ' '),
(140, 'avepa@firstasia.edu.ph', 'Mar 18,2017 01:05am', 'CCIT', '2016-2017', 'Basic PC Troubleshooting', '5', '3', '-2', 'Maybe considered as in-house training along with other personnel', ' '),
(141, 'avepa@firstasia.edu.ph', 'Mar 18,2017 01:05am', 'CCIT', '2016-2017', 'Communication Skills', '5', '5', '0', 'Keep up the good work', ' '),
(142, 'jhgamayon@firstasia.edu.ph', 'Mar 18,2017 07:57pm', 'CCIT', '2016-2017', 'Classroom Management', '5', '4', '-1', 'Coaching/Feedback mechanism', ' '),
(143, 'jhgamayon@firstasia.edu.ph', 'Mar 18,2017 07:57pm', 'CCIT', '2016-2017', 'Teaching Strategies', '5', '3', '-2', 'Supplemental trainings', ' '),
(144, 'jhgamayon@firstasia.edu.ph', 'Mar 18,2017 07:57pm', 'CCIT', '2016-2017', 'Basic PC Troubleshooting', '5', '5', '0', 'Supplemental trainings', ' '),
(145, 'jhgamayon@firstasia.edu.ph', 'Mar 18,2017 07:57pm', 'CCIT', '2016-2017', 'Communication Skills', '5', '5', '0', 'Supplemental trainings', ' '),
(146, 'jhgamayon@firstasia.edu.ph', 'Mar 18,2017 07:57pm', 'CCIT', '2016-2017', 'Outcomes-Based Education', '5', '5', '0', 'Supplemental trainings', ' ');

-- --------------------------------------------------------

--
-- Table structure for table `tnafolder`
--

CREATE TABLE IF NOT EXISTS `tnafolder` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `academicyear` varchar(50) NOT NULL,
  `date_created` varchar(50) NOT NULL,
  `department` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tnafolder`
--

INSERT INTO `tnafolder` (`id`, `academicyear`, `date_created`, `department`) VALUES
(2, '2016-2017', 'Mar 18,2017 01:05am', 'CCIT');

-- --------------------------------------------------------

--
-- Table structure for table `tnalist`
--

CREATE TABLE IF NOT EXISTS `tnalist` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `date_created` varchar(50) NOT NULL,
  `department` varchar(50) NOT NULL,
  `academicyear` varchar(50) NOT NULL,
  `faculty_remarks` varchar(200) NOT NULL,
  `faculty_note` varchar(50) NOT NULL,
  `dean_note` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=65 ;

--
-- Dumping data for table `tnalist`
--

INSERT INTO `tnalist` (`id`, `email`, `date_created`, `department`, `academicyear`, `faculty_remarks`, `faculty_note`, `dean_note`) VALUES
(63, 'avepa@firstasia.edu.ph', 'Mar 18,2017 01:05am', 'CCIT', '2016-2017', 'New', 'Approved', 'Approved'),
(64, 'jhgamayon@firstasia.edu.ph', 'Mar 18,2017 07:57pm', 'CCIT', '2016-2017', 'New', 'Approved', 'Approved');

-- --------------------------------------------------------

--
-- Table structure for table `tna_budget`
--

CREATE TABLE IF NOT EXISTS `tna_budget` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dept_id` int(11) NOT NULL,
  `amount` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `tna_budget`
--

INSERT INTO `tna_budget` (`id`, `dept_id`, `amount`) VALUES
(1, 1, '40050'),
(2, 2, '35000'),
(3, 3, '18000'),
(4, 4, '20080'),
(5, 5, '10500'),
(6, 6, '30200'),
(7, 7, '14050'),
(8, 8, '12000');

-- --------------------------------------------------------

--
-- Table structure for table `tna_devplan`
--

CREATE TABLE IF NOT EXISTS `tna_devplan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `devplan` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `tna_devplan`
--

INSERT INTO `tna_devplan` (`id`, `devplan`) VALUES
(2, 'Assigned readings/group sharings'),
(3, 'Coaching/Feedback mechanism'),
(4, 'Maybe considered as in-house training along with other personnel'),
(5, 'Supplemental trainings'),
(6, 'Programming Training');

-- --------------------------------------------------------

--
-- Table structure for table `tna_docu`
--

CREATE TABLE IF NOT EXISTS `tna_docu` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `jobid` varchar(50) NOT NULL,
  `docu` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tna_docu`
--

INSERT INTO `tna_docu` (`id`, `email`, `jobid`, `docu`) VALUES
(1, 'jpcruz@firstasia.edu.ph', '2', '14879853416355.png'),
(2, 'jpcruz@firstasia.edu.ph', '2', '1487988028104819297.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tna_jobroles`
--

CREATE TABLE IF NOT EXISTS `tna_jobroles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jobrole` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `travel_guide`
--

CREATE TABLE IF NOT EXISTS `travel_guide` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pos` varchar(25) NOT NULL,
  `fee_type` varchar(25) NOT NULL,
  `amount` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `travel_guide`
--

INSERT INTO `travel_guide` (`id`, `pos`, `fee_type`, `amount`) VALUES
(1, 'dean', 'hotel', 1000),
(2, 'chair', 'hotel', 800),
(3, 'faculty', 'hotel', 500),
(4, 'dean', 'diem', 900),
(5, 'chair', 'diem', 700),
(6, 'faculty', 'diem', 500);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
