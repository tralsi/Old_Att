-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 27, 2019 at 06:38 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `attendance`
--

-- --------------------------------------------------------

--
-- Table structure for table `class_master`
--

CREATE TABLE IF NOT EXISTS `class_master` (
  `class_id` int(11) NOT NULL,
  `class_name` varchar(30) NOT NULL,
  PRIMARY KEY (`class_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `class_master`
--

INSERT INTO `class_master` (`class_id`, `class_name`) VALUES
(1, 'BCA - SEM - I'),
(2, 'BCA - SEM - II'),
(3, 'BCA - SEM - III'),
(4, 'BCA - SEM - IV'),
(5, 'BCA - SEM - V'),
(6, 'BCA - SEM - VI'),
(7, 'M.sc. (CA) - SEM - I'),
(8, 'M.sc. (CA) - SEM - II'),
(9, 'M.sc. (CA) - SEM - III'),
(10, 'M.sc. (CA) - SEM - IV');

-- --------------------------------------------------------

--
-- Table structure for table `course_master`
--

CREATE TABLE IF NOT EXISTS `course_master` (
  `course_id` int(2) NOT NULL,
  `course_name` varchar(20) NOT NULL,
  PRIMARY KEY (`course_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course_master`
--

INSERT INTO `course_master` (`course_id`, `course_name`) VALUES
(1, 'BCA'),
(2, 'M.Sc. (CA)');

-- --------------------------------------------------------

--
-- Table structure for table `div_master`
--

CREATE TABLE IF NOT EXISTS `div_master` (
  `div_id` int(2) NOT NULL,
  `c_id` int(2) NOT NULL,
  `div_name` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `div_master`
--

INSERT INTO `div_master` (`div_id`, `c_id`, `div_name`) VALUES
(1, 1, 'A'),
(2, 1, 'B'),
(3, 2, 'A');

-- --------------------------------------------------------

--
-- Table structure for table `faculty_master`
--

CREATE TABLE IF NOT EXISTS `faculty_master` (
  `faculty_id` int(3) NOT NULL,
  `faculty_shortname` varchar(15) NOT NULL,
  `faculty_fname` varchar(20) NOT NULL,
  `faculty_lname` varchar(20) NOT NULL,
  PRIMARY KEY (`faculty_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `faculty_master`
--

INSERT INTO `faculty_master` (`faculty_id`, `faculty_shortname`, `faculty_fname`, `faculty_lname`) VALUES
(1, 'VJS', 'Vijesh', 'Shukla'),
(2, 'JMP', 'Jagin', 'Patel'),
(3, 'MV', 'Meghna', 'Vithlani'),
(4, 'RD', 'Rajesh', 'Dave'),
(5, 'HP', 'Heena', 'Patel'),
(6, 'NV', 'Nidhi', 'Vaish'),
(7, 'NB', 'Neha', 'Bhaidasna'),
(8, 'PP', 'Paresh', 'Prajapati');

-- --------------------------------------------------------

--
-- Table structure for table `lectures`
--

CREATE TABLE IF NOT EXISTS `lectures` (
  `lecture_no` int(2) NOT NULL,
  `lecture_time` varchar(50) NOT NULL,
  UNIQUE KEY `lecture_no` (`lecture_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lectures`
--

INSERT INTO `lectures` (`lecture_no`, `lecture_time`) VALUES
(1, '07:30 to 08:30'),
(2, '08:30 to 09:30'),
(3, '09:30 to 10:30'),
(4, '10:30 to 11:30'),
(5, '12:00 to 13:00'),
(6, '13:00 to 14:00'),
(7, '14:00 to 15:00'),
(8, '15:00 to 16:00');

-- --------------------------------------------------------

--
-- Table structure for table `sem_master`
--

CREATE TABLE IF NOT EXISTS `sem_master` (
  `sem_id` int(2) NOT NULL,
  `c_id` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sem_master`
--

INSERT INTO `sem_master` (`sem_id`, `c_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(1, 2),
(2, 2),
(3, 2),
(4, 2);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE IF NOT EXISTS `students` (
  `roll_no` varchar(10) NOT NULL,
  `stud_name` varchar(50) NOT NULL,
  `ay` varchar(10) NOT NULL,
  `status` varchar(2) NOT NULL,
  `course_id` int(11) NOT NULL,
  `sem_id` int(11) NOT NULL,
  `div_id` int(11) NOT NULL,
  PRIMARY KEY (`roll_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`roll_no`, `stud_name`, `ay`, `status`, `course_id`, `sem_id`, `div_id`) VALUES
('14b101', 'SAPA AVADHI', '2018-19', 'A', 1, 5, 1),
('15B007', 'BHAGAT MOHIT RAMJIBHAI', '2018-19', 'A', 1, 5, 1),
('15b010', 'PATEL DHYEY', '2018-19', 'A', 1, 3, 1),
('15B011', 'PATEL PARTHIV', '2018-19', 'A', 1, 3, 1),
('15B012', 'BHARAT J SNI', '2018-19', 'A', 1, 3, 1),
('15B013', 'BHATT PARESH C', '2018-19', 'A', 1, 3, 1),
('15B014', 'JAYDEEPSINH GOHIL', '2018-19', 'A', 1, 3, 1),
('15B015', 'RAHUL S. SHAH', '2018-19', 'A', 1, 3, 1),
('16B011', 'JAGATAP KARAN NILESHBHAI', '2018-19', 'A', 1, 3, 1),
('16B027', 'MEHTA HARSH BHARATBHAI', '2018-19', 'A', 1, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `subject_allocation`
--

CREATE TABLE IF NOT EXISTS `subject_allocation` (
  `suballoc_fac_id` int(2) NOT NULL,
  `suballoc_course_id` int(2) NOT NULL,
  `suballoc_sem` int(2) NOT NULL,
  `suballoc_div` int(2) NOT NULL,
  `suballoc_sub_id` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subject_allocation`
--

INSERT INTO `subject_allocation` (`suballoc_fac_id`, `suballoc_course_id`, `suballoc_sem`, `suballoc_div`, `suballoc_sub_id`) VALUES
(2, 1, 1, 1, 2),
(2, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `subject_master`
--

CREATE TABLE IF NOT EXISTS `subject_master` (
  `sub_id` int(3) NOT NULL,
  `sub_code` int(3) NOT NULL,
  `sub_name` varchar(40) NOT NULL,
  `course` int(2) NOT NULL,
  `sem` int(2) NOT NULL,
  UNIQUE KEY `sub_id` (`sub_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subject_master`
--

INSERT INTO `subject_master` (`sub_id`, `sub_code`, `sub_name`, `course`, `sem`) VALUES
(1, 101, 'Communication Skills', 1, 1),
(2, 102, 'Mathematics', 1, 1),
(3, 103, 'IC', 1, 1),
(4, 104, 'CPPM', 1, 1),
(5, 105, 'OA', 1, 1),
(6, 106, 'Practical', 1, 1),
(7, 201, 'OB', 1, 2),
(8, 202, 'Accounts', 1, 2),
(9, 203, 'OS-1', 1, 2),
(10, 204, 'Adv. ''C''', 1, 2),
(11, 205, 'DBMS', 1, 2),
(12, 206, 'Practical', 1, 2),
(13, 301, 'Statistical Methods', 1, 3),
(14, 302, 'SE-I', 1, 3),
(15, 303, 'RDBMS', 1, 3),
(16, 304, 'DS', 1, 3),
(17, 305, 'OOP', 1, 3),
(18, 306, 'Practical', 1, 3),
(19, 401, 'IS', 1, 4),
(20, 402, 'SE-II', 1, 4),
(21, 403, 'Java', 1, 4),
(22, 404, '.Net Programing', 1, 4),
(23, 405, 'Web Designing', 1, 4),
(24, 406, 'Practical', 1, 4),
(25, 501, 'PHP & MySQL', 1, 5),
(26, 502, 'UNIX', 1, 5),
(27, 503, 'Network Technologies', 1, 5),
(28, 504, 'OS-II', 1, 5),
(29, 505, 'ASP .Net', 1, 5),
(30, 506, 'Practical', 1, 5),
(31, 601, 'Computer Graphics', 1, 6),
(32, 602, 'e-Com', 1, 6),
(33, 101, 'Adv. SE', 2, 1),
(34, 102, 'Adv. DBMS', 2, 1),
(35, 103, 'Web Client Technologies', 2, 1),
(36, 104, 'ERP', 2, 1),
(37, 105, 'Web Programming using Java', 2, 1),
(38, 106, 'Practical in Java', 2, 1),
(39, 107, 'Practical in Web Client', 2, 1),
(40, 108, 'Practical in Adv. DBMS', 2, 1),
(41, 201, 'SOA', 2, 2),
(42, 202, 'Web Programming Using C# ', 2, 2),
(43, 203, 'Adv. Scripting Language', 2, 2),
(44, 204, 'DWDM', 2, 2),
(45, 205, 'IS', 2, 2),
(46, 206, 'Practicals in Web Programming using C# ', 2, 2),
(47, 207, 'Practicals in Adv. Scripting Languages', 2, 2),
(48, 208, 'Practicals on Cryptography', 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `username` varchar(30) NOT NULL,
  `pwd` varchar(30) NOT NULL,
  `usertype` varchar(2) NOT NULL,
  `status` varchar(2) NOT NULL DEFAULT 'A',
  PRIMARY KEY (`username`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `pwd`, `usertype`, `status`) VALUES
('cap', 'mkics', 'F', 'A'),
('hp', 'mkics', 'F', 'D'),
('JMP', 'mkics', 'F', 'A'),
('MV', 'mkics', 'F', 'A'),
('NK', 'mkics', 'F', 'A'),
('NV', 'mkics', 'F', 'A'),
('PP', 'mkics', 'F', 'A'),
('VJS', 'mkics', 'F', 'A');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
