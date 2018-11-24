-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 25, 2017 at 09:15 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `efsdp`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE IF NOT EXISTS `account` (
`id` int(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `usertype` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `email`, `password`, `usertype`) VALUES
(1, 'amlacorte@firstasia.edu.ph', '1234567', 'dean'),
(2, 'mlmalabanan@firstasia.edu.ph', '1234567', 'chair'),
(3, 'jhgamayon@firstasia.edu.ph', '1234567', 'faculty'),
(4, 'jpcruz@firstasia.edu.ph', '1234567', 'faculty'),
(5, 'lvmanalo@firstasia.edu.ph', '1234567', 'vpar'),
(6, 'rlmanongsong@firstasia.edu.ph', '1234567', 'faculty');

-- --------------------------------------------------------

--
-- Table structure for table `masbreakdown`
--

CREATE TABLE IF NOT EXISTS `masbreakdown` (
`id` int(10) NOT NULL,
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
  `regfee` varchar(50) NOT NULL,
  `foodfee` varchar(50) NOT NULL,
  `transfee` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `masbreakdown`
--

INSERT INTO `masbreakdown` (`id`, `masid`, `numofdean`, `numofchair`, `numoffaculty`, `deanHotel`, `chairHotel`, `facultyHotel`, `deanDiem`, `chairDiem`, `facultyDiem`, `regfee`, `foodfee`, `transfee`) VALUES
(9, 'mas14853224331482', '1', '1', '1', '1000', '800', '500', '800', '500', '300', '200', '200', '200'),
(10, 'mas148532243332757', '1', '1', '1', '1000', '800', '500', '800', '500', '300', '100', '100', '100'),
(11, 'mas14853236068548', '0', '2', '3', '0', '3200', '3000', '0', '2000', '1800', '1000', '1000', '1000'),
(12, 'mas14853249927579', '0', '2', '3', '0', '3200', '3000', '0', '2000', '1800', '1000', '1000', '1000');

-- --------------------------------------------------------

--
-- Table structure for table `mustattend`
--

CREATE TABLE IF NOT EXISTS `mustattend` (
`id` int(10) NOT NULL,
  `masid` varchar(50) NOT NULL,
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
  `dean_status` varchar(50) NOT NULL,
  `dean_note` varchar(300) NOT NULL,
  `vp_status` varchar(50) NOT NULL,
  `vp_note` varchar(300) NOT NULL,
  `hr_status` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mustattend`
--

INSERT INTO `mustattend` (`id`, `masid`, `academicyear`, `datecreated`, `school`, `department`, `title`, `category`, `sponsor`, `dates`, `numdays`, `venue`, `numperson`, `budget`, `dean_status`, `dean_note`, `vp_status`, `vp_note`, `hr_status`) VALUES
(34, 'mas14853224331482', '2016-2017', 'Jan 25, 2017 06:32am', 'School of Technology', 'CCIT', 'PSITE2', 'Research', 'PSITE2', '2017-01-27', '1', 'PSITE2', '1 Dean; 1 Chair; 1 Faculty', '4500', 'New', 'New', 'New', 'New', 'New'),
(35, 'mas148532243332757', '2016-2017', 'Jan 25, 2017 06:32am', 'School of Technology', 'CCIT', 'PSITE1', 'Research', 'PSITE1', '2017-01-27', '1', 'PSITE1', '1 Dean; 1 Chair; 1 Faculty', '4200', 'New', 'New', 'New', 'New', 'New'),
(36, 'mas14853236068548', '2016-2017', 'Jan 25, 2017 13:51pm', 'School of Technology', 'CCIT', 'PSITE3', 'Research', 'PSITE3', '2017-01-31', '2', 'PSITE3', '0 Dean; 2 Chair; 3 Faculty', '21200', 'New', 'New', 'New', 'New', 'New'),
(37, 'mas14853249927579', '2016-2017', 'Jan 25, 2017 14:15pm', 'School of Technology', 'CCIT', 'PSITE4', 'Research', 'PSITE4', '2017-01-27', '2', 'PSITE4', '0 Dean; 2 Chair; 3 Faculty', '21200', 'New', 'New', 'New', 'New', 'New');

-- --------------------------------------------------------

--
-- Table structure for table `mustattendremarks`
--

CREATE TABLE IF NOT EXISTS `mustattendremarks` (
`id` int(10) NOT NULL,
  `dates` varchar(50) NOT NULL,
  `annualyear` varchar(50) NOT NULL,
  `department` varchar(50) NOT NULL,
  `dean_status` varchar(50) NOT NULL,
  `dean_note` varchar(500) NOT NULL,
  `vp_status` varchar(50) NOT NULL,
  `vp_note` varchar(500) NOT NULL,
  `hr_status` varchar(50) NOT NULL,
  `hr_note` varchar(500) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mustattendremarks`
--

INSERT INTO `mustattendremarks` (`id`, `dates`, `annualyear`, `department`, `dean_status`, `dean_note`, `vp_status`, `vp_note`, `hr_status`, `hr_note`) VALUES
(3, 'Jan 25, 2017 06:32am', '2016-2017', 'CCIT', 'Approved', 'New', 'Approved', 'New', 'Approved', 'New');

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE IF NOT EXISTS `profile` (
`id` int(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `middlename` varchar(50) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `designation` varchar(50) NOT NULL,
  `college` varchar(50) NOT NULL,
  `school` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`id`, `email`, `lastname`, `middlename`, `firstname`, `designation`, `college`, `school`) VALUES
(1, 'amlacorte@firstasia.edu.ph', 'Lacorte', 'Maldonado', 'Alice', 'Dean', 'CCIT', 'Technology'),
(2, 'mlmalabanan@firstasia.edu.ph', 'Malabanan', 'Landicho', 'Maricel', 'chair', 'CCIT', 'Technology'),
(3, 'jhgamayon@firstasia.edu.ph', 'Gamayon', 'Hernandez', 'Jesus', 'faculty', 'CCIT', 'Technology'),
(4, 'jpcruz@firstasia.edu.ph', 'Cruz', 'Pinangang', 'Jerwin', 'faculty', 'CCIT', 'Technology'),
(5, 'lvmanalo@firstasia.edu.ph', 'Manalo', 'V', 'Lalaine', 'Vice President for Academics', 'CBA', 'Management');

-- --------------------------------------------------------

--
-- Table structure for table `tna`
--

CREATE TABLE IF NOT EXISTS `tna` (
`id` int(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `datecreated` varchar(50) NOT NULL,
  `department` varchar(50) NOT NULL,
  `annualyear` varchar(50) NOT NULL,
  `job_role` varchar(50) NOT NULL,
  `position_importance` varchar(50) NOT NULL,
  `ability` varchar(50) NOT NULL,
  `competency` varchar(50) NOT NULL,
  `developmentplan` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=127 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tna`
--

INSERT INTO `tna` (`id`, `email`, `datecreated`, `department`, `annualyear`, `job_role`, `position_importance`, `ability`, `competency`, `developmentplan`) VALUES
(2, 'jpcruz@firstasia.edu.ph', 'Jan 21,2017 10:25am', 'CCIT', '2016-2017', 'Classroom Management', '5', '5', '0', 'Supplemental trainings'),
(3, 'jpcruz@firstasia.edu.ph', 'Jan 21,2017 10:25am', 'CCIT', '2016-2017', 'Teaching Strategies', '5', '5', '0', 'Coaching/Feedback mechanism'),
(4, 'jpcruz@firstasia.edu.ph', 'Jan 21,2017 10:25am', 'CCIT', '2016-2017', 'Basic PC Troubleshooting', '5', '4', '-1', 'Supplemental trainings'),
(5, 'jpcruz@firstasia.edu.ph', 'Jan 21,2017 10:25am', 'CCIT', '2016-2017', 'Programming Skills', '5', '3', '-2', 'Programming Training'),
(6, 'jpcruz@firstasia.edu.ph', 'Jan 21,2017 10:25am', 'CCIT', '2016-2017', 'Communication Skills', '5', '4', '-1', 'Supplemental trainings'),
(7, 'jpcruz@firstasia.edu.ph', 'Jan 21,2017 10:25am', 'CCIT', '2016-2017', 'Outcomes-Based Education', '5', '3', '-2', 'Supplemental trainings'),
(8, 'jpcruz@firstasia.edu.ph', 'Jan 21,2017 02:39pm', 'CCIT', '2016-2017', 'Logical Skills', '5', '3', '-2', 'Assigned readings/group sharings'),
(122, 'jhgamayon@firstasia.edu.ph', 'Jan 21,2017 06:39pm', 'CCIT', '2016-2017', 'Basic PC Troubleshooting', '5', '3', '-2', 'Maybe considered as in-house training along with other personnel'),
(123, 'jhgamayon@firstasia.edu.ph', 'Jan 21,2017 06:39pm', 'CCIT', '2016-2017', 'Outcomes-Based Education', '5', '3', '-2', 'Maybe considered as in-house training along with other personnel'),
(124, 'jhgamayon@firstasia.edu.ph', 'Jan 21,2017 06:39pm', 'CCIT', '2016-2017', 'Classroom Management', '5', '4', '-1', 'Maybe considered as in-house training along with other personnel'),
(125, 'jhgamayon@firstasia.edu.ph', 'Jan 21,2017 06:39pm', 'CCIT', '2016-2017', 'Teaching Strategies', '5', '2', '-3', 'Coaching/Feedback mechanism'),
(126, 'jhgamayon@firstasia.edu.ph', 'Jan 21,2017 06:39pm', 'CCIT', '2016-2017', 'Communication Skills', '5', '4', '-1', 'Maybe considered as in-house training along with other personnel');

-- --------------------------------------------------------

--
-- Table structure for table `tnafolder`
--

CREATE TABLE IF NOT EXISTS `tnafolder` (
`id` int(10) NOT NULL,
  `academicyear` varchar(50) NOT NULL,
  `date_created` varchar(50) NOT NULL,
  `department` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tnafolder`
--

INSERT INTO `tnafolder` (`id`, `academicyear`, `date_created`, `department`) VALUES
(1, '2016-2017', 'Jan 21,2017 10:09am', 'CCIT');

-- --------------------------------------------------------

--
-- Table structure for table `tnalist`
--

CREATE TABLE IF NOT EXISTS `tnalist` (
`id` int(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `date_created` varchar(50) NOT NULL,
  `department` varchar(50) NOT NULL,
  `academicyear` varchar(50) NOT NULL,
  `faculty_remarks` varchar(200) NOT NULL,
  `faculty_note` varchar(50) NOT NULL,
  `dean_note` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tnalist`
--

INSERT INTO `tnalist` (`id`, `email`, `date_created`, `department`, `academicyear`, `faculty_remarks`, `faculty_note`, `dean_note`) VALUES
(1, 'jpcruz@firstasia.edu.ph', 'Jan 21,2017 10:09am', 'CCIT', '2016-2017', 'New', 'Approved', 'Approved'),
(59, 'jhgamayon@firstasia.edu.ph', 'Jan 21,2017 06:39pm', 'CCIT', '2016-2017', 'New', 'Approved', 'Approved');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `masbreakdown`
--
ALTER TABLE `masbreakdown`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mustattend`
--
ALTER TABLE `mustattend`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mustattendremarks`
--
ALTER TABLE `mustattendremarks`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tna`
--
ALTER TABLE `tna`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tnafolder`
--
ALTER TABLE `tnafolder`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tnalist`
--
ALTER TABLE `tnalist`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `masbreakdown`
--
ALTER TABLE `masbreakdown`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `mustattend`
--
ALTER TABLE `mustattend`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT for table `mustattendremarks`
--
ALTER TABLE `mustattendremarks`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `profile`
--
ALTER TABLE `profile`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tna`
--
ALTER TABLE `tna`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=127;
--
-- AUTO_INCREMENT for table `tnafolder`
--
ALTER TABLE `tnafolder`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tnalist`
--
ALTER TABLE `tnalist`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=60;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
