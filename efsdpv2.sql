-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 08, 2017 at 01:15 AM
-- Server version: 10.1.8-MariaDB
-- PHP Version: 5.5.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `efsdpv2`
--

-- --------------------------------------------------------

--
-- Table structure for table `faith_academic_year`
--

CREATE TABLE `faith_academic_year` (
  `id` int(11) NOT NULL,
  `year` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `faith_academic_year`
--

INSERT INTO `faith_academic_year` (`id`, `year`) VALUES
(1, '2016-2017'),
(2, '2017-2018'),
(3, '2018-2019'),
(4, '2019-2020'),
(5, '2021-2022');

-- --------------------------------------------------------

--
-- Table structure for table `faith_department`
--

CREATE TABLE `faith_department` (
  `id` int(11) NOT NULL,
  `department` varchar(255) NOT NULL,
  `abbr` varchar(10) NOT NULL,
  `school_id` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `faith_department`
--

INSERT INTO `faith_department` (`id`, `department`, `abbr`, `school_id`) VALUES
(1, 'College of Computing Information and Technology', 'CCIT', '1'),
(2, 'College of Engineering', 'COE', '1'),
(3, 'College of Public Service', 'COPS', '1'),
(4, '', 'CIHM', '3'),
(5, 'College of Arts and Science', '', '2');

-- --------------------------------------------------------

--
-- Table structure for table `faith_school`
--

CREATE TABLE `faith_school` (
  `id` int(11) NOT NULL,
  `school` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `faith_school`
--

INSERT INTO `faith_school` (`id`, `school`) VALUES
(1, 'School of Techonology'),
(2, 'School of Humanities'),
(3, 'School of Management');

-- --------------------------------------------------------

--
-- Table structure for table `fee_other`
--

CREATE TABLE `fee_other` (
  `id` int(11) NOT NULL,
  `mas_list_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `value` decimal(20,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fee_other`
--

INSERT INTO `fee_other` (`id`, `mas_list_id`, `title`, `value`) VALUES
(1, 1, 'asd', '100.00'),
(2, 1, 'ww', '900.00');

-- --------------------------------------------------------

--
-- Table structure for table `inhouse`
--

CREATE TABLE `inhouse` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `datetime` datetime NOT NULL,
  `venue` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `inhouse_attendees`
--

CREATE TABLE `inhouse_attendees` (
  `id` int(11) NOT NULL,
  `inhouse_id` varchar(255) NOT NULL,
  `emp_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `jobroles_dept`
--

CREATE TABLE `jobroles_dept` (
  `id` int(11) NOT NULL,
  `jobrole_id` int(11) NOT NULL,
  `dept_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jobroles_dept`
--

INSERT INTO `jobroles_dept` (`id`, `jobrole_id`, `dept_id`) VALUES
(1, 3, 1),
(2, 4, 1),
(3, 7, 1);

-- --------------------------------------------------------

--
-- Table structure for table `mas`
--

CREATE TABLE `mas` (
  `id` int(11) NOT NULL,
  `dept_id` int(11) NOT NULL,
  `date_created` datetime NOT NULL,
  `academic_year` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mas`
--

INSERT INTO `mas` (`id`, `dept_id`, `date_created`, `academic_year`) VALUES
(1, 1, '2017-01-31 18:32:41', '2016-2017');

-- --------------------------------------------------------

--
-- Table structure for table `mas_breakdown`
--

CREATE TABLE `mas_breakdown` (
  `id` int(11) NOT NULL,
  `mas_list_id` varchar(50) NOT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mas_breakdown`
--

INSERT INTO `mas_breakdown` (`id`, `mas_list_id`, `numofdean`, `numofchair`, `numoffaculty`, `deanHotel`, `chairHotel`, `facultyHotel`, `deanDiem`, `chairDiem`, `facultyDiem`, `regfee`, `foodfee`, `transfee`) VALUES
(1, '1', '1', '1', '1', '1000', '800', '500', '800', '500', '300', '200', '200', '200'),
(2, '2', '1', '1', '1', '1000', '800', '500', '800', '500', '300', '100', '100', '100'),
(3, '3', '0', '2', '3', '0', '3200', '3000', '0', '2000', '1800', '1000', '1000', '1000'),
(4, '4', '0', '2', '3', '0', '3200', '3000', '0', '2000', '1800', '1000', '1000', '1000');

-- --------------------------------------------------------

--
-- Table structure for table `mas_category`
--

CREATE TABLE `mas_category` (
  `id` int(11) NOT NULL,
  `category` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mas_category`
--

INSERT INTO `mas_category` (`id`, `category`) VALUES
(1, 'Research'),
(2, 'Instructions'),
(3, 'FACE'),
(4, 'Others');

-- --------------------------------------------------------

--
-- Table structure for table `mas_list`
--

CREATE TABLE `mas_list` (
  `id` int(11) NOT NULL,
  `mas_id` varchar(50) NOT NULL,
  `title` varchar(300) NOT NULL,
  `category` int(11) NOT NULL,
  `sponsor` varchar(200) NOT NULL,
  `dates` varchar(50) NOT NULL,
  `numdays` varchar(50) NOT NULL,
  `venue` varchar(200) NOT NULL,
  `budget` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mas_list`
--

INSERT INTO `mas_list` (`id`, `mas_id`, `title`, `category`, `sponsor`, `dates`, `numdays`, `venue`, `budget`) VALUES
(1, '1', 'PSITE2', 1, 'PSITE2', '2017-01-27', '1', 'PSITE2', '4500'),
(2, '1', 'PSITE1', 3, 'PSITE1', '2017-01-27', '1', 'PSITE1', '4200'),
(3, '1', 'PSITE3', 2, 'PSITE3', '2017-01-31', '2', 'PSITE3', '21200'),
(4, '', 'PSITE4', 2, 'PSITE4', '2017-01-31', '2', 'PSITE3', '21200');

-- --------------------------------------------------------

--
-- Table structure for table `mas_remarks`
--

CREATE TABLE `mas_remarks` (
  `id` int(10) NOT NULL,
  `mas_id` int(11) NOT NULL,
  `dates` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `dean_status` varchar(50) NOT NULL,
  `dean_note` varchar(500) NOT NULL,
  `vp_status` varchar(50) NOT NULL,
  `vp_note` varchar(500) NOT NULL,
  `hr_status` varchar(50) NOT NULL,
  `hr_note` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mas_remarks`
--

INSERT INTO `mas_remarks` (`id`, `mas_id`, `dates`, `dean_status`, `dean_note`, `vp_status`, `vp_note`, `hr_status`, `hr_note`) VALUES
(3, 1, '2017-01-29 14:20:29', 'Approved', 'New', 'Approved', 'New', 'Approved', 'New');

-- --------------------------------------------------------

--
-- Table structure for table `othermas_remarks`
--

CREATE TABLE `othermas_remarks` (
  `id` int(10) NOT NULL,
  `mas_list_id` int(11) NOT NULL,
  `dates` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `dean_status` varchar(50) NOT NULL,
  `dean_note` varchar(500) NOT NULL,
  `vp_status` varchar(50) NOT NULL,
  `vp_note` varchar(500) NOT NULL,
  `hr_status` varchar(50) NOT NULL,
  `hr_note` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `othermas_remarks`
--

INSERT INTO `othermas_remarks` (`id`, `mas_list_id`, `dates`, `dean_status`, `dean_note`, `vp_status`, `vp_note`, `hr_status`, `hr_note`) VALUES
(3, 1, '2017-01-29 14:20:29', 'Approved', 'New', 'Approved', 'New', 'Approved', 'New');

-- --------------------------------------------------------

--
-- Table structure for table `seminar_user`
--

CREATE TABLE `seminar_user` (
  `id` int(11) NOT NULL,
  `seminar_id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `echo_sched` text NOT NULL,
  `docs` text NOT NULL,
  `reasons` text NOT NULL,
  `attended` varchar(3) NOT NULL,
  `vpar_approve` int(11) NOT NULL,
  `hr_approve` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `seminar_user`
--

INSERT INTO `seminar_user` (`id`, `seminar_id`, `account_id`, `echo_sched`, `docs`, `reasons`, `attended`, `vpar_approve`, `hr_approve`) VALUES
(1, 3, 4, '', '', '', '', 0, 0),
(2, 4, 2, '', '', '', '', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tna`
--

CREATE TABLE `tna` (
  `id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `date_created` datetime NOT NULL,
  `academic_year` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tna`
--

INSERT INTO `tna` (`id`, `account_id`, `date_created`, `academic_year`) VALUES
(1, 4, '2017-01-18 15:30:38', '2016-2017');

-- --------------------------------------------------------

--
-- Table structure for table `tna_devplan`
--

CREATE TABLE `tna_devplan` (
  `id` int(11) NOT NULL,
  `description` varchar(512) NOT NULL,
  `exist` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tna_devplan`
--

INSERT INTO `tna_devplan` (`id`, `description`, `exist`) VALUES
(1, 'Supplemental trainings', 1),
(2, 'Coaching/Feedback mechanism', 1),
(3, 'Programming Training', 1),
(4, 'Assigned readings/group sharings', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tna_job_roles`
--

CREATE TABLE `tna_job_roles` (
  `id` int(11) NOT NULL,
  `description` varchar(512) NOT NULL,
  `is_default` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tna_job_roles`
--

INSERT INTO `tna_job_roles` (`id`, `description`, `is_default`) VALUES
(1, 'Classroom Management', 1),
(2, 'Teaching Strategies', 1),
(3, 'Basic PC Troubleshooting', 1),
(4, 'Programming Skills', 1),
(5, 'Communication Skills', 1),
(6, 'Outcomes-Based Education', 1),
(7, 'Logical Skills', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tna_list`
--

CREATE TABLE `tna_list` (
  `id` int(10) NOT NULL,
  `tna_id` int(11) NOT NULL,
  `jobrole_id` varchar(50) NOT NULL,
  `position_importance` varchar(50) NOT NULL,
  `ability` varchar(50) NOT NULL,
  `competency` varchar(50) NOT NULL,
  `developmentplan` varchar(100) NOT NULL,
  `evidence` varchar(999) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tna_list`
--

INSERT INTO `tna_list` (`id`, `tna_id`, `jobrole_id`, `position_importance`, `ability`, `competency`, `developmentplan`, `evidence`) VALUES
(2, 1, '1', '5', '5', '0', '1', ''),
(3, 1, '2', '5', '5', '0', '2', ''),
(4, 1, '3', '5', '4', '-1', '1', ''),
(5, 1, '4', '5', '3', '-2', '3', ''),
(6, 1, '5', '5', '4', '-1', '1', ''),
(7, 1, '6', '5', '3', '-2', '1', ''),
(8, 1, '7', '5', '3', '-2', '4', '');

-- --------------------------------------------------------

--
-- Table structure for table `tna_remarks`
--

CREATE TABLE `tna_remarks` (
  `id` int(10) NOT NULL,
  `tna_id` int(11) NOT NULL,
  `dates` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `faculty_remarks` varchar(200) NOT NULL,
  `faculty_note` varchar(50) NOT NULL,
  `dean_note` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tna_remarks`
--

INSERT INTO `tna_remarks` (`id`, `tna_id`, `dates`, `faculty_remarks`, `faculty_note`, `dean_note`) VALUES
(1, 1, '2017-01-29 14:43:08', 'New', 'Approved', 'Approved'),
(59, 1, '2017-01-29 14:43:10', 'New', 'Approved', 'Approved');

-- --------------------------------------------------------

--
-- Table structure for table `travel_guide`
--

CREATE TABLE `travel_guide` (
  `id` int(11) NOT NULL,
  `user_type` int(11) NOT NULL,
  `fee_type` varchar(100) NOT NULL,
  `amount` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `travel_guide`
--

INSERT INTO `travel_guide` (`id`, `user_type`, `fee_type`, `amount`) VALUES
(1, 1, 'hotel', 500),
(2, 2, 'hotel', 500),
(3, 3, 'hotel', 800),
(4, 4, 'hotel', 1000),
(5, 1, 'diem', 300),
(6, 2, 'diem', 300),
(7, 3, 'diem', 500),
(8, 4, 'diem', 800);

-- --------------------------------------------------------

--
-- Table structure for table `user_account`
--

CREATE TABLE `user_account` (
  `id` int(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `usertype_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_account`
--

INSERT INTO `user_account` (`id`, `email`, `password`, `usertype_id`) VALUES
(1, 'amlacorte@firstasia.edu.ph', '1234567', 4),
(2, 'mlmalabanan@firstasia.edu.ph', '1234567', 3),
(3, 'jhgamayon@firstasia.edu.ph', '1234567', 1),
(4, 'jpcruz@firstasia.edu.ph', '1234567', 1),
(5, 'lvmanalo@firstasia.edu.ph', '1234567', 5);

-- --------------------------------------------------------

--
-- Table structure for table `user_notification`
--

CREATE TABLE `user_notification` (
  `id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `user_from` varchar(100) NOT NULL,
  `user_to` varchar(100) NOT NULL,
  `content` varchar(512) NOT NULL,
  `college` varchar(10) NOT NULL,
  `has_read` int(11) NOT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_notification`
--

INSERT INTO `user_notification` (`id`, `type`, `user_from`, `user_to`, `content`, `college`, `has_read`, `date_created`) VALUES
(23, 'seminar', 'mlmalabanan@firstasia.edu.ph', 'dean', 'New Seminar <span class=''text-warning''>pending</span> for your approval.', 'CCIT', 1, '2017-03-18 16:05:00'),
(24, 'seminar', 'jhgamayon@firstasia.edu.ph', 'chair', 'New Seminar <span class=''text-warning''>pending</span> for your approval.', 'CCIT', 1, '2017-03-18 20:08:05'),
(25, 'seminar', 'jhgamayon@firstasia.edu.ph', 'dean', 'New Seminar <span class=''text-warning''>pending</span> for your approval.', 'CCIT', 1, '2017-03-24 20:41:51'),
(26, 'seminar', 'jhgamayon@firstasia.edu.ph', 'vpar', 'New Seminar <span class=''text-warning''>pending</span> for your approval.', 'CCIT', 0, '2017-03-24 20:56:39'),
(27, 'seminar', 'mlmalabanan@firstasia.edu.ph', 'dean', 'New Seminar <span class=''text-warning''>pending</span> for your approval.', 'CCIT', 1, '2017-03-25 17:11:57'),
(28, 'seminar', 'mlmalabanan@firstasia.edu.ph', 'vpar', 'New Seminar <span class=''text-warning''>pending</span> for your approval.', 'CCIT', 1, '2017-03-25 17:13:54'),
(29, 'seminar', 'mlmalabanan@firstasia.edu.ph', 'hr', 'New Seminar <span class=''text-warning''>pending</span> for your approval.', 'CCIT', 1, '2017-03-25 17:14:53'),
(30, 'seminar', 'mlmalabanan@firstasia.edu.ph', 'md', 'New Seminar <span class=''text-warning''>pending</span> for your approval.', 'CCIT', 1, '2017-03-25 17:15:10'),
(31, 'seminar approved', 'mlmalabanan@firstasia.edu.ph', 'approved', 'Your requested seminar has been <span class=''text-success''>approved</span>.', 'CCIT', 0, '2017-03-25 17:15:31');

-- --------------------------------------------------------

--
-- Table structure for table `user_profile`
--

CREATE TABLE `user_profile` (
  `id` int(10) NOT NULL,
  `account_id` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `middlename` varchar(50) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `designation` varchar(50) NOT NULL,
  `dept_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_profile`
--

INSERT INTO `user_profile` (`id`, `account_id`, `lastname`, `middlename`, `firstname`, `designation`, `dept_id`) VALUES
(1, '1', 'Lacorte', 'Maldonado', 'Alice', 'Dean', 1),
(2, '2', 'Malabanan', 'Landicho', 'Maricel', 'chair', 1),
(3, '3', 'Gamayon', 'Hernandez', 'Jesus', 'faculty', 1),
(4, '4', 'Cruz', 'Pinangang', 'Jerwin', 'faculty', 1),
(5, '5', 'Manalo', 'V', 'Lalaine', 'Vice President for Academics', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_types`
--

CREATE TABLE `user_types` (
  `user` varchar(255) NOT NULL,
  `id` int(11) NOT NULL,
  `rank` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_types`
--

INSERT INTO `user_types` (`user`, `id`, `rank`) VALUES
('faculty', 1, 1),
('staff', 2, 2),
('chair', 3, 3),
('dean', 4, 4),
('vpar', 5, 5),
('hr', 6, 6),
('ewan', 7, 7),
('admin', 100, 100),
('dev', 101, 101);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `faith_academic_year`
--
ALTER TABLE `faith_academic_year`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faith_department`
--
ALTER TABLE `faith_department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faith_school`
--
ALTER TABLE `faith_school`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fee_other`
--
ALTER TABLE `fee_other`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mas_list_id` (`mas_list_id`);

--
-- Indexes for table `inhouse`
--
ALTER TABLE `inhouse`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inhouse_attendees`
--
ALTER TABLE `inhouse_attendees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobroles_dept`
--
ALTER TABLE `jobroles_dept`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mas`
--
ALTER TABLE `mas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mas_breakdown`
--
ALTER TABLE `mas_breakdown`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mas_category`
--
ALTER TABLE `mas_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mas_list`
--
ALTER TABLE `mas_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mas_remarks`
--
ALTER TABLE `mas_remarks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `othermas_remarks`
--
ALTER TABLE `othermas_remarks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seminar_user`
--
ALTER TABLE `seminar_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `seminar_id` (`seminar_id`);

--
-- Indexes for table `tna`
--
ALTER TABLE `tna`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tna_devplan`
--
ALTER TABLE `tna_devplan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tna_job_roles`
--
ALTER TABLE `tna_job_roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tna_list`
--
ALTER TABLE `tna_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tna_remarks`
--
ALTER TABLE `tna_remarks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `travel_guide`
--
ALTER TABLE `travel_guide`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_account`
--
ALTER TABLE `user_account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_notification`
--
ALTER TABLE `user_notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_profile`
--
ALTER TABLE `user_profile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_types`
--
ALTER TABLE `user_types`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `faith_academic_year`
--
ALTER TABLE `faith_academic_year`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `faith_department`
--
ALTER TABLE `faith_department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `faith_school`
--
ALTER TABLE `faith_school`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `inhouse`
--
ALTER TABLE `inhouse`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `inhouse_attendees`
--
ALTER TABLE `inhouse_attendees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `jobroles_dept`
--
ALTER TABLE `jobroles_dept`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `mas`
--
ALTER TABLE `mas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `mas_breakdown`
--
ALTER TABLE `mas_breakdown`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `mas_category`
--
ALTER TABLE `mas_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `mas_remarks`
--
ALTER TABLE `mas_remarks`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `othermas_remarks`
--
ALTER TABLE `othermas_remarks`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `seminar_user`
--
ALTER TABLE `seminar_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tna`
--
ALTER TABLE `tna`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tna_devplan`
--
ALTER TABLE `tna_devplan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tna_job_roles`
--
ALTER TABLE `tna_job_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tna_list`
--
ALTER TABLE `tna_list`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `tna_remarks`
--
ALTER TABLE `tna_remarks`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;
--
-- AUTO_INCREMENT for table `travel_guide`
--
ALTER TABLE `travel_guide`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `user_account`
--
ALTER TABLE `user_account`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `user_notification`
--
ALTER TABLE `user_notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `user_profile`
--
ALTER TABLE `user_profile`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
