-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 11, 2018 at 08:21 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `OLSHCOHRMS`
--

-- --------------------------------------------------------
--
-- Table structure for table `applicants`
--

CREATE TABLE IF NOT EXISTS `application` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
  `applicant_id` varchar(10) NULL,
	`firstname` varchar(200) NULL,
	`middlename` varchar(200) NOT NULL,
	`lastname` varchar(200) NOT NULL,
  `gender` varchar(20) NOT NULL,
	`street_address` varchar(200) NOT NULL,
	`city` varchar(200) NOT NULL,
	`state_province` varchar(200) NOT NULL,
	`postal_zip_code` varchar(200) NOT NULL,
	`birthdate` DATE NOT NULL,
	`email` varchar(200) NOT NULL,
	`contact_info` varchar(30) NOT NULL,
	`position_id` int(30) NOT NULL,
	`resume` varchar(200) NOT NULL,
  `process_id` int(3) NOT NULL,
	PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

INSERT INTO `application` (`id`, `applicant_id`, `firstname`, `middlename`, `lastname`, `gender`, `street_address`, `city`, `state_province`, `postal_zip_code`, `birthdate`, `email`, `contact_info`, `position_id`, `resume`) VALUES
(1, '46-0790', 'Carl John', 'Quibuyen', 'Yasay', 'Male', 'Zone 7, Macatcatuit', 'Guimba' , 'Nueva Ecija', '3115', '2003-01-21', 'carl09450059036@gmail.com', '09979236679', 1, 'sample.pdf'),
(2, '79-0090', 'Miguel', 'Moreno', 'Macapagal', 'Male', 'Zone 7, Bantug', 'Guimba' , 'Nueva Ecija', '3115', '2001-01-11', 'carl09450059036@gmail.com', '09979236679', 1, 'sample.pdf');
--

CREATE TABLE IF NOT EXISTS `application_archive` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
  `applicant_id` varchar(10) NULL,
	`firstname` varchar(200) NULL,
	`middlename` varchar(200) NOT NULL,
	`lastname` varchar(200) NOT NULL,
  `gender` varchar(20) NOT NULL,
	`street_address` varchar(200) NOT NULL,
	`city` varchar(200) NOT NULL,
	`state_province` varchar(200) NOT NULL,
	`postal_zip_code` varchar(200) NOT NULL,
	`birthdate` DATE NOT NULL,
	`email` varchar(200) NOT NULL,
	`contact_info` varchar(30) NOT NULL,
	`position_id` int(30) NOT NULL,
	`resume` varchar(200) NOT NULL,
  `process_id` int(3) NOT NULL,
	PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
`id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` varchar(60) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `photo` varchar(200) NOT NULL,
  `created_on` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `firstname`, `lastname`, `photo`, `created_on`) VALUES
(1, 'admin', '$2y$10$fCOiMky4n5hCJx3cpsG20Od4wHtlkCLKmO6VLobJNRIg9ooHTkgjK', 'Harry', 'Den', 'male6.jpg', '2018-04-30');

-- --------------------------------------------------------


CREATE TABLE IF NOT EXISTS `interview_details` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `application_id` int(30) NOT NULL,
  `applicant_id` varchar(20) NOT NULL,
  `email` varchar(200) NOT NULL,
  `position` varchar(200) NOT NULL,
  `date` DATE NOT NULL,
  `time` time NOT NULL,
  `location` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `vacancy` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `photo` varchar(200) NOT NULL,
  `position` varchar(200) NOT NULL,
  `availability` int(30) NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(1) NOT NULL,
  `rate` double NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;


INSERT INTO `vacancy` (`id`, `position`, `availability`, `description`, `status`, `rate`, `date_created`) VALUES
(1, 'Teacher', 10, '<h2><b>URGENT HIRING!!</b></h2><p><b></p><h3><b>&nbsp;Our school is looking for 10 new Teacher.</b></h3><p><b></p><h2><b>Qualifications:</b></h2><p><b></p><p><h3><h3><h3><h3><h3><h3><h4><h4><h4><h4><h4><h4><h4><ul><li><b>Bachelors Degree in Education</b></li></ul><ul><li><b>Valid Teaching Certification</b></li></ul><ul><li><b>Proven Teaching Experience in any grade level</b></li></ul><ul><li><b>Strong Communication and Interpersonal Skills</b></li></ul><ul><li><b>Passion for Lifelong Learning and Professional Development</b></li></ul></h4></h4></h4></h4></h4></h4></h4></h3></h3></h3></h3></h3></h3></p>', 1, 50, '2020-09-28 11:24:52');
--
-- Table structure for table `attendance`
--

CREATE TABLE IF NOT EXISTS `attendance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` varchar(10) NULL,
  `date` date NOT NULL,
  `time_in` time NOT NULL,
  `status` int(1) NOT NULL,
  `time_out` time NOT NULL,
  `overtime_status` int(1) NOT NULL,
  `num_hr` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO `attendance` (`id`, `employee_id`, `date`, `time_in`, `status`, `time_out`, `overtime_status`, `num_hr`) VALUES (1, '51-04964', '2023-12-10', '07:00:00', '1', '16:00:00', '0', '9');


CREATE TABLE `leave_requests` (
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `employee_id` VARCHAR(20),
    `leave_type` VARCHAR(255),
    `start_date` DATE,
    `end_date` DATE,
    `duration` INT,  -- You may calculate this based on start and end dates
    `reason` TEXT,
    `status` VARCHAR(20),  -- e.g., pending, approved, rejected
    `date_requested` TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

CREATE TABLE `employee_deductions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` VARCHAR(30) NOT NULL,
  `deduction_id` int(30) NOT NULL,
  `type` tinyint(1) NOT NULL COMMENT '1 = Monthly, 2 = Semi-Montly, 3 = Once',
  `effective_date` date NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attendance`
--


-- --------------------------------------------------------

--
-- Table structure for table `cashadvance`
--

CREATE TABLE IF NOT EXISTS `employee_bonus` (
`id` int(11) NOT NULL AUTO_INCREMENT,
  `date_bonus` date NOT NULL,
  `employee_id` varchar(15) NOT NULL,
  `bonus_id` int(11) NOT NULL,
  
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;


CREATE TABLE IF NOT EXISTS `bonus` (
`id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(200) NOT NULL,
  `amount` double NOT NULL,
  
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cashadvance`
--

-- --------------------------------------------------------

--
-- Table structure for table `deductions`
--

CREATE TABLE IF NOT EXISTS `deductions` (
`id` int(11) NOT NULL AUTO_INCREMENT,
  `deduction` varchar(100) NOT NULL,
  `amount` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `deductions`
--

INSERT INTO `deductions` (`id`, `deduction`, `amount`) VALUES
(1, 'SSS', 100),
(2, 'Pagibig', 150),
(3, 'PhilHealth', 150),
(4, 'Project Issues', 1500);

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE IF NOT EXISTS `employees` (
`id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` varchar(15) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `middlename` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `birthdate` date NOT NULL,
  `contact_info` varchar(100) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `email` varchar(100) NOT NULL,
  `position_id` int(11) NOT NULL,
  `schedule_id` int(11) NOT NULL,
  `photo` varchar(200) NOT NULL,
  `hire_date` date NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=200 DEFAULT CHARSET=latin1;

--
CREATE TABLE IF NOT EXISTS `employees_archive` (
`id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` varchar(15) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `middlename` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `birthdate` date NOT NULL,
  `contact_info` varchar(100) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `email` varchar(100) NOT NULL,
  `position_id` int(11) NOT NULL,
  `schedule_id` int(11) NOT NULL,
  `photo` varchar(200) NOT NULL,
  `hire_date` date NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=200 DEFAULT CHARSET=latin1;

-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `employee_id`, `firstname`, `middlename`, `lastname`, `address`, `birthdate`, `contact_info`, `gender`, `email`, `position_id`, `schedule_id`, `photo`, `hire_date`, `username`, `password`) VALUES
(1, '51-04964', 'Manuel', 'Smith', 'Cotto', 'Zone 7, San andress, Guimba, Nueva Ecija, 3115', '2001-04-02', '09000035719', 'Male', 'carl09450059036', 1, 2, 'dp.jpg', '2018-04-28', '21P93E7B', '$2y$10$E/7Atd/9GgORta5nIRAKLOd7wBYPcXZ15MOlMe0rS4.i83g//anma');


-- --------------------------------------------------------

--
-- Table structure for table `overtime`
--

CREATE TABLE IF NOT EXISTS `overtime` (
`id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` varchar(15) NOT NULL,
  `hours` double NOT NULL,
  `rate` double NOT NULL,
  `total_overtime_pay` double NOT NULL,
  `date_overtime` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `overtime`
--


-- --------------------------------------------------------

--
-- Table structure for table `position`
--


-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE IF NOT EXISTS `schedules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `time_in` time NOT NULL,
  `time_out` time NOT NULL,
  `total_hours` DECIMAL(5,2) NOT NULL, -- Adjust precision and scale based on your needs
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `schedules`
--

INSERT INTO `schedules` (`id`, `time_in`, `time_out`, `total_hours`) VALUES
(1, '07:00:00', '16:00:00', TIME_TO_SEC(TIMEDIFF('16:00:00', '07:00:00')) / 3600),
(2, '08:00:00', '17:00:00', TIME_TO_SEC(TIMEDIFF('17:00:00', '08:00:00')) / 3600);


--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
