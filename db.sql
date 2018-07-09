-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 24, 2018 at 02:41 AM
-- Server version: 10.1.33-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `makinter_intern`
--

-- --------------------------------------------------------

--
-- Table structure for table `accademic_supervisor`
--

CREATE TABLE `accademic_supervisor` (
  `id` int(11) NOT NULL,
  `firstName` varchar(35) NOT NULL,
  `lastName` varchar(35) NOT NULL,
  `username` varchar(35) DEFAULT NULL,
  `idNumber` varchar(100) NOT NULL,
  `password` varchar(100) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `college_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `excel_status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `college_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `email`, `college_id`, `course_id`) VALUES
(1, 'aleks', 'aleks', 'aleksnyombi@gmail.com', 1, 1),
(4, 'Musooka', 'Mus', 'gordonmusooka@gmail.com', 1, 3),
(5, 'Ssemusinge', 'Sse', 'Ssemusinge@gmail.com', 1, 2),
(6, 'Nabukeera', 'Nab', 'filisnabukeera@gmail.com', 1, 4),
(7, 'Senyondo', 'Sen', 'senyondo@gmail.com', 1, 1),
(8, 'Gordon', 'Gor', 'musookagordon@gmail.com', 2, 10),
(9, 'Samuel', 'Sam', 'samsem@gmail.com', 2, 9);

-- --------------------------------------------------------

--
-- Table structure for table `colleges`
--

CREATE TABLE `colleges` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `colleges`
--

INSERT INTO `colleges` (`id`, `name`) VALUES
(1, 'scit'),
(2, 'education'),
(3, 'easlis');

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `student_phone` varchar(100) NOT NULL,
  `student_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `college_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`id`, `name`, `college_id`) VALUES
(1, 'bachelor of software enginering', 1),
(2, 'bachelor of computer science', 1),
(3, 'bachelor of information systems', 1),
(4, 'bachelor of information technology', 1),
(5, 'bachelor of Records & Archives Management', 3),
(6, 'bachelor of Library & Information Sciences', 3),
(9, 'kawempe', 2),
(10, 'gayaza', 2);

-- --------------------------------------------------------

--
-- Table structure for table `field_evaluation`
--

CREATE TABLE `field_evaluation` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `supervisor_id` int(11) NOT NULL,
  `smartness` varchar(30) NOT NULL,
  `time_management` varchar(30) NOT NULL,
  `attendence` varchar(30) NOT NULL,
  `ability_to_meet_deadlines` varchar(30) NOT NULL,
  `team_work` varchar(30) NOT NULL,
  `student_field_of_interest` varchar(100) NOT NULL,
  `general_comment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `field_supervisor`
--

CREATE TABLE `field_supervisor` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `idNumber` varchar(100) NOT NULL,
  `organizationName` varchar(100) NOT NULL,
  `password` varchar(100) DEFAULT NULL,
  `position` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `status` varchar(30) NOT NULL,
  `orgWebsite` varchar(100) NOT NULL,
  `college_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rejected_field_supervisor`
--

CREATE TABLE `rejected_field_supervisor` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `organization` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `id_number` varchar(100) NOT NULL,
  `org_website` varchar(100) NOT NULL,
  `reason` varchar(500) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `self_evaluation`
--

CREATE TABLE `self_evaluation` (
  `id` int(11) NOT NULL,
  `area_of_interest` varchar(100) NOT NULL,
  `skills_attained` text NOT NULL,
  `challenges_exprienced` text NOT NULL,
  `recommend_students` varchar(10) NOT NULL,
  `student_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `student_number` varchar(45) NOT NULL,
  `reg_number` varchar(45) NOT NULL,
  `academic_supervisor_id` int(11) NOT NULL,
  `field_supervisor_id` int(11) DEFAULT NULL,
  `college_id` int(11) NOT NULL,
  `field_sipervisor_field_marks` int(11) DEFAULT NULL,
  `accademic_supervisor_field_marks` int(11) DEFAULT NULL,
  `report_marks` int(11) DEFAULT NULL,
  `logbook_marks` int(11) DEFAULT NULL,
  `marks` int(11) DEFAULT NULL,
  `company_details` text,
  `exel_status` varchar(20) NOT NULL,
  `course_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tokens`
--

CREATE TABLE `tokens` (
  `id` int(11) NOT NULL,
  `supervisor_id` int(11) NOT NULL,
  `token` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accademic_supervisor`
--
ALTER TABLE `accademic_supervisor`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idNumber` (`idNumber`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `colleges`
--
ALTER TABLE `colleges`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `field_evaluation`
--
ALTER TABLE `field_evaluation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `field_supervisor`
--
ALTER TABLE `field_supervisor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rejected_field_supervisor`
--
ALTER TABLE `rejected_field_supervisor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `self_evaluation`
--
ALTER TABLE `self_evaluation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `student_number` (`student_number`),
  ADD UNIQUE KEY `reg_number` (`reg_number`);

--
-- Indexes for table `tokens`
--
ALTER TABLE `tokens`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accademic_supervisor`
--
ALTER TABLE `accademic_supervisor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `colleges`
--
ALTER TABLE `colleges`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `field_evaluation`
--
ALTER TABLE `field_evaluation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `field_supervisor`
--
ALTER TABLE `field_supervisor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `rejected_field_supervisor`
--
ALTER TABLE `rejected_field_supervisor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `self_evaluation`
--
ALTER TABLE `self_evaluation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tokens`
--
ALTER TABLE `tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
