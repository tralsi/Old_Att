-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 08, 2020 at 06:30 AM
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
-- Table structure for table `att_master`
--

CREATE TABLE IF NOT EXISTS `att_master` (
  `att_date` date NOT NULL,
  `att_crs_id` int(11) NOT NULL,
  `att_sem_id` int(11) NOT NULL,
  `att_div_id` int(11) NOT NULL,
  `att_lec_no` int(11) NOT NULL,
  `att_sub_id` int(11) NOT NULL,
  `att_fac_id` int(11) NOT NULL,
  `att_stud_id` varchar(11) NOT NULL,
  `att_stud_presence` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `att_master`
--

INSERT INTO `att_master` (`att_date`, `att_crs_id`, `att_sem_id`, `att_div_id`, `att_lec_no`, `att_sub_id`, `att_fac_id`, `att_stud_id`, `att_stud_presence`) VALUES
('2019-04-01', 1, 3, 1, 1, 13, 7, '*', 'P'),
('2019-04-01', 1, 3, 1, 1, 13, 7, '*', 'P'),
('2019-04-02', 1, 3, 1, 1, 13, 5, '*', 'P'),
('2019-04-03', 1, 3, 1, 1, 13, 7, '*', 'P'),
('2019-04-05', 1, 3, 1, 1, 13, 5, '15B014', 'A'),
('2019-04-06', 1, 3, 1, 3, 13, 7, '15B012', 'A'),
('2019-04-06', 1, 3, 1, 3, 13, 7, '*', 'P'),
('2019-04-06', 1, 3, 1, 3, 13, 7, '15B012', 'A'),
('2019-04-04', 1, 3, 1, 3, 13, 7, '15B011', 'A'),
('2019-04-08', 1, 3, 1, 3, 13, 7, '15B013', 'A'),
('2019-04-08', 1, 3, 1, 3, 13, 7, '15B015', 'A'),
('2019-04-08', 1, 3, 1, 3, 13, 7, '*', 'P'),
('2019-05-17', 1, 3, 1, 1, 13, 7, '18B005', 'A'),
('2019-05-17', 1, 1, 1, 1, 2, 2, '17B081', 'A'),
('2019-05-16', 1, 1, 1, 1, 2, 2, '17B080', 'A'),
('2019-05-14', 1, 1, 1, 2, 3, 5, '17B082', 'A'),
('2019-05-01', 1, 2, 1, 1, 7, 5, '17B098', 'A'),
('2019-05-01', 1, 2, 1, 1, 7, 5, '17B099', 'A'),
('2019-05-01', 1, 2, 1, 1, 7, 5, '17B100', 'A'),
('2019-05-01', 1, 2, 1, 1, 7, 5, '17B100', 'A'),
('2019-05-02', 1, 2, 1, 1, 7, 5, '*', 'P'),
('2019-05-06', 1, 2, 1, 2, 11, 2, '17B097', 'A'),
('2019-05-06', 1, 2, 1, 2, 11, 2, '17B098', 'A'),
('2019-05-06', 1, 2, 1, 2, 11, 2, '17B098', 'A'),
('2019-05-06', 1, 2, 1, 2, 11, 2, '17B098', 'A'),
('2019-05-09', 1, 4, 1, 1, 22, 5, '18B019', 'A'),
('2019-05-09', 1, 4, 1, 1, 22, 5, '18B026', 'A'),
('2019-05-09', 1, 4, 1, 1, 22, 5, '18B026', 'A'),
('2019-05-09', 1, 4, 1, 1, 22, 5, '18B026', 'A'),
('2019-05-10', 1, 4, 1, 1, 22, 5, '18B022', 'A'),
('2019-05-10', 1, 4, 1, 1, 22, 5, '18B022', 'A'),
('2019-05-10', 1, 4, 1, 1, 22, 5, '18B022', 'A'),
('2019-05-06', 1, 4, 1, 1, 22, 5, '18B020', 'A'),
('2019-05-06', 1, 4, 1, 1, 22, 5, '18B020', 'A'),
('2019-05-02', 1, 2, 1, 3, 8, 7, '17B094', 'A'),
('2019-05-02', 1, 2, 1, 3, 8, 7, '17B094', 'A'),
('2019-05-03', 1, 2, 1, 3, 8, 7, '17B096', 'A'),
('2019-05-03', 1, 2, 1, 3, 8, 7, '17B096', 'A'),
('2019-05-04', 1, 2, 1, 3, 8, 7, '17B098', 'A'),
('2019-05-04', 1, 2, 1, 3, 8, 7, '17B098', 'A'),
('2019-05-04', 1, 2, 1, 2, 8, 7, '17B098', 'A'),
('2019-05-04', 1, 2, 1, 2, 8, 7, '17B098', 'A'),
('2019-05-04', 1, 2, 1, 2, 8, 7, '17B098', 'A'),
('2019-05-04', 1, 2, 1, 2, 8, 7, '17B099', 'A'),
('2019-05-04', 1, 2, 1, 2, 8, 7, '17B099', 'A'),
('2019-05-06', 1, 2, 1, 2, 8, 7, '*', 'P'),
('2019-05-08', 1, 1, 1, 2, 3, 5, '17B080', 'A'),
('2019-05-08', 1, 1, 1, 2, 3, 5, '17B080', 'A'),
('2020-03-04', 1, 1, 1, 1, 2, 5, '17B072', 'A'),
('2020-03-04', 1, 1, 1, 1, 2, 5, '17B079', 'A'),
('2020-03-04', 1, 1, 1, 1, 2, 5, '17B079', 'A'),
('2020-03-09', 1, 3, 1, 3, 1, 2, '*', 'P'),
('2020-03-16', 1, 1, 1, 3, 1, 3, '*', 'P'),
('2020-03-17', 1, 1, 1, 3, 1, 3, '*', 'P'),
('2020-03-18', 1, 1, 1, 3, 1, 3, '*', 'P');

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
  `faculty_id` int(3) NOT NULL AUTO_INCREMENT,
  `faculty_shortname` varchar(15) NOT NULL,
  `faculty_fname` varchar(20) NOT NULL,
  `faculty_lname` varchar(20) NOT NULL,
  `faculty_salutation` varchar(30) NOT NULL,
  `fac_last_entry` date NOT NULL,
  PRIMARY KEY (`faculty_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `faculty_master`
--

INSERT INTO `faculty_master` (`faculty_id`, `faculty_shortname`, `faculty_fname`, `faculty_lname`, `faculty_salutation`, `fac_last_entry`) VALUES
(1, 'VJS', 'Vijesh', 'Shukla', 'Principal', '0000-00-00'),
(2, 'JMP', 'Jagin', 'Patel', 'Prof.', '2020-03-20'),
(3, 'MV', 'Meghna', 'Vithlani', 'Asst. Prof.', '2020-03-19'),
(4, 'RD', 'Rajesh', 'Dave', 'Asst. Prof.', '0000-00-00'),
(5, 'HP', 'Heena', 'Patel', 'Asst. Prof.', '2020-03-20'),
(6, 'NV', 'Nidhi', 'Vaish', 'Asst. Prof.', '0000-00-00'),
(7, 'NB', 'Neha', 'Bhaidasna', 'Asst. Prof.', '2019-05-06'),
(8, 'PP', 'Paresh', 'Prajapati', 'Asst. Prof.', '0000-00-00');

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
('16B027', 'MEHTA HARSH BHARATBHAI', '2018-19', 'A', 1, 3, 1),
('17B072', 'SHUKLA SHIVAM SANJAY', '2019-20', 'A', 1, 1, 1),
('17B073', 'SIDDIQUE SHAMA PRAVEEN RAFI AHMED', '2019-20', 'A', 1, 1, 1),
('17B074', 'SINGH TANYA DINESHPALSINGH', '2019-20', 'A', 1, 1, 1),
('17B075', 'SITPONIYA SUFIYAN SAEED', '2019-20', 'A', 1, 1, 1),
('17B076', 'SOLANKI KHUSNFUDFATIMA DILISINH', '2019-20', 'A', 1, 1, 1),
('17B077', 'SONI DISHANKUMAR ANILBHAI', '2019-20', 'A', 1, 1, 1),
('17B078', 'SUMAINA DEVI ANOKHELAL YADAV', '2019-20', 'A', 1, 1, 1),
('17B079', 'TADVI DIVYABEN DINUBHAI', '2019-20', 'A', 1, 1, 1),
('17B080', 'TANK DIPALIBEN PRAVINBHAI', '2019-20', 'A', 1, 1, 1),
('17B081', 'THAKOR BHAVIKKUMAR BHARATBHAI', '2019-20', 'A', 1, 1, 1),
('17B082', 'UNCHA SAHISTABANU IDRISBHAI', '2019-20', 'A', 1, 1, 1),
('17B083', 'VAGHELA DIVYAKUMARI JAYANTIBHAI', '2019-20', 'A', 1, 1, 2),
('17B084', 'VALVI MITTALBEN RAJESHBHAI', '2019-20', 'A', 1, 1, 2),
('17B085', 'VANKAR VANDANA KESHAVBHAI', '2019-20', 'A', 1, 1, 2),
('17B086', 'VANZA DHRUV PUSHPAVADAN', '2019-20', 'A', 1, 1, 2),
('17B087', 'VASAVA ALPESHBHAI ISHWARBHAI', '2019-20', 'A', 1, 1, 2),
('17B088', 'VASAVA DIVYABEN AMRUTBHAI', '2019-20', 'A', 1, 1, 2),
('17B089', 'VASAVA SHAHILKUMAR RAJNIKANT', '2019-20', 'A', 1, 1, 2),
('17B090', 'VYAS NANDINI SHAILESHKUMAR', '2019-20', 'A', 1, 1, 2),
('17B091', 'YADAV POOJA PANNALAL YADAV', '2019-20', 'A', 1, 1, 2),
('17B092', 'SONI NANDINEE BHARATBHAI', '2019-20', 'A', 1, 1, 2),
('17B093', 'MALEK ALISHABANU IMTIYAZBHAI', '2019-20', 'A', 1, 1, 2),
('17B094', 'PATHAN AABEDABEN ANVARKHAN', '2019-20', 'A', 1, 2, 1),
('17B096', 'PATEL NIKITA SURESHBHAI', '2019-20', 'A', 1, 2, 1),
('17B097', 'PATEL MEGHABEN RAMESHCHANDRA', '2019-20', 'A', 1, 2, 1),
('17B098', 'TATTU MEHJABIN MOHMED', '2019-20', 'A', 1, 2, 1),
('17B099', 'MALI PRIYASEEKUMARI NILESHKUMAR', '2019-20', 'A', 1, 2, 1),
('17B100', 'AWATE AARTI SANJAY', '2019-20', 'A', 1, 2, 1),
('17B101', 'YADAV AMISHA SOHANLAL', '2019-20', 'A', 1, 2, 1),
('17B102', 'PANDEY SONALI GYAN CHANDRA', '2019-20', 'A', 1, 2, 1),
('17B103', 'GANDHI DEEP PANKAJKUMAR', '2019-20', 'A', 1, 2, 1),
('17B105', 'PANCHAL MAYUR BIPINCHANDRA', '2019-20', 'A', 1, 2, 1),
('18B003', 'AHIR HEMAXIBEN NATVARBHAI', '2018-19', 'A', 1, 3, 1),
('18B004', 'AHIR JEMINI CHHITUBHAI', '2018-19', 'A', 1, 3, 1),
('18B005', 'AHIR YASHVIKUMARI GUMANBHAI', '2018-19', 'A', 1, 3, 1),
('18B008', 'BHARDAWAJ PRINCE NIRBHAY', '2018-19', 'A', 1, 3, 1),
('18B009', 'CHAUHAN KRUTARTH JAYENDRA', '2018-19', 'A', 1, 3, 1),
('18B010', 'CHAUHAN VIPIN RAKESH', '2018-19', 'A', 1, 3, 1),
('18B011', 'CHAUHAN YUKTI KISHORBHAI', '2018-19', 'A', 1, 3, 1),
('18B012', 'CHAVADA VANRAJSINH MUKENDRASINH', '2018-19', 'A', 1, 3, 1),
('18B014', 'GANDHI DHRUVISHA VIPULKUMAR', '2018-19', 'A', 1, 3, 1),
('18B015', 'GANDHI NIRALIBEN ATULKUMAR', '2018-19', 'A', 1, 3, 1),
('18B016', 'GANDHI RIYA SAGAR', '2018-19', 'A', 1, 3, 1),
('18B017', 'GATTANI TANUJ SUBHASH', '2018-19', 'A', 1, 3, 1),
('18B018', 'GOHIL CHETANKUMAR DIPAKBHAI', '2018-19', 'A', 1, 3, 1),
('18B019', 'GOHIL JIGARKUMAR RANJITBHAI', '2018-19', 'A', 1, 4, 1),
('18B020', 'GUPTA AARTI KUMARI RAMNATH', '2018-19', 'A', 1, 4, 1),
('18B021', 'JADAUN RITESH JITENDRA', '2018-19', 'A', 1, 4, 1),
('18B022', 'JADAV ANJU POONAMBHAI', '2018-19', 'A', 1, 4, 1),
('18B023', 'JADAV FALGUNIBEN POONAMBHAI', '2018-19', 'A', 1, 4, 1),
('18B024', 'JAGLAWALA HETAL CHETANBHAI', '2018-19', 'A', 1, 4, 1),
('18B025', 'JAIN HARSHITKUMAR GOPALBHAI', '2018-19', 'A', 1, 4, 1),
('18B026', 'JOSHI NANDINI VIPUCHANDRA', '2018-19', 'A', 1, 4, 1),
('18B029', 'KARAWNA HIZBUL HASHANBHAI', '2018-19', 'A', 1, 4, 1),
('18B030', 'KATARIA RIDDHI CHAMPAKBHAI', '2018-19', 'A', 1, 3, 2),
('18B031', 'KHAJANCHI MOIZ TAHERI', '2018-19', 'A', 1, 3, 2),
('18B032', 'KURESHI UZAIR MOHMEDNADIM', '2018-19', 'A', 1, 3, 2),
('18B033', 'LIMBACHIYA RINKALBEN VIJAYBHAI', '2018-19', 'A', 1, 3, 2),
('18B034', 'MACHHI PRATIKSHA UTTAMBHAI', '2018-19', 'A', 1, 3, 2),
('18B035', 'MAJE MOHAMMAD HASIM ABDULRAHEMAN', '2018-19', 'A', 1, 3, 2),
('18B038', 'MEHTA ADITIBEN BIPINCHANDRA', '2018-19', 'A', 1, 3, 2),
('18B039', 'MEHTA VRUSHALI NILESHBHAI', '2018-19', 'A', 1, 3, 2),
('18B040', 'MODI PALAK YOGESHBHAI', '2018-19', 'A', 1, 3, 2),
('18B041', 'MUNSHI SANA SABBIR', '2018-19', 'A', 1, 3, 2),
('18B042', 'NAIR AKSHIL SOMAN', '2018-19', 'A', 1, 3, 2),
('18B043', 'PANCHAL BHUMIKA JAYESHBHAI', '2018-19', 'A', 1, 3, 2),
('18B044', 'PARMAR JANVI NARENDRASINH', '2018-19', 'A', 1, 3, 2),
('18B045', 'PATEL ANCHALBEN HITESHBHAI', '2018-19', 'A', 1, 3, 2),
('18B046', 'PATEL ANJANI ASHOKBHAI', '2018-19', 'A', 1, 3, 2),
('18B047', 'PATEL ASIMA YUNUS', '2018-19', 'A', 1, 3, 2),
('18B048', 'PATEL FARHEEN ABDUL KADIR YAKUB MASTER', '2018-19', 'A', 1, 3, 2),
('18B049', 'PATEL HIMALAYA PRAKASHKUMAR', '2018-19', 'A', 1, 3, 2),
('18B050', 'PATEL ISHA MUKESHBHAI', '2018-19', 'A', 1, 3, 2),
('roll_no', 'stud_name', 'ay', 'st', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `student_attendance`
--

CREATE TABLE IF NOT EXISTS `student_attendance` (
  `att_date` date NOT NULL,
  `lec_no` int(2) NOT NULL,
  `course` int(2) NOT NULL,
  `sem` int(2) NOT NULL,
  `div` int(2) NOT NULL,
  `fac` int(3) NOT NULL,
  `sub` int(3) NOT NULL,
  `abs` varchar(500) NOT NULL,
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`row_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=85 ;

--
-- Dumping data for table `student_attendance`
--

INSERT INTO `student_attendance` (`att_date`, `lec_no`, `course`, `sem`, `div`, `fac`, `sub`, `abs`, `row_id`) VALUES
('2020-03-10', 1, 1, 1, 1, 5, 3, '17B079,17B080,17B081', 70),
('2020-03-11', 2, 1, 1, 1, 5, 2, '17B073,17B074', 71),
('2020-03-12', 1, 1, 1, 1, 5, 3, '17B081,17B082', 72),
('2020-03-13', 1, 1, 1, 1, 5, 3, '17B072,17B073', 73),
('2020-03-16', 1, 1, 1, 1, 5, 2, '17B075,17B080,17B081', 74),
('2020-03-17', 1, 1, 1, 1, 5, 3, '17B079,17B080,17B081,17B082', 75),
('2020-03-18', 3, 1, 1, 1, 5, 2, '17B074,17B081', 76),
('2020-03-19', 3, 1, 1, 1, 5, 2, '17B073,17B079', 77),
('2020-03-20', 3, 1, 1, 1, 5, 3, '17B080,17B081', 78),
('2020-03-10', 2, 1, 1, 1, 2, 2, '17B072,17B079,17B080', 79),
('2020-03-11', 1, 1, 1, 1, 2, 1, '17B075,17B081', 80),
('2020-03-14', 1, 1, 1, 1, 2, 1, '17B080,17B081,17B082', 81),
('2020-03-18', 2, 1, 1, 1, 2, 2, '17B079,17B080', 82),
('2020-03-19', 2, 1, 1, 1, 2, 2, '17B073,17B079,17B080', 83),
('2020-03-20', 2, 1, 1, 1, 2, 2, '17B077,17B081', 84);

-- --------------------------------------------------------

--
-- Table structure for table `subject_allocation`
--

CREATE TABLE IF NOT EXISTS `subject_allocation` (
  `suballoc_row_id` int(11) NOT NULL AUTO_INCREMENT,
  `suballoc_fac_id` int(2) NOT NULL,
  `suballoc_course_id` int(2) NOT NULL,
  `suballoc_sem` int(2) NOT NULL,
  `suballoc_div` int(2) NOT NULL,
  `suballoc_sub_id` int(3) NOT NULL,
  PRIMARY KEY (`suballoc_row_id`),
  KEY `suballoc_sub_id` (`suballoc_sub_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=35 ;

--
-- Dumping data for table `subject_allocation`
--

INSERT INTO `subject_allocation` (`suballoc_row_id`, `suballoc_fac_id`, `suballoc_course_id`, `suballoc_sem`, `suballoc_div`, `suballoc_sub_id`) VALUES
(1, 2, 1, 1, 1, 2),
(2, 2, 1, 1, 1, 1),
(3, 5, 1, 1, 1, 3),
(6, 5, 1, 2, 1, 7),
(7, 3, 1, 2, 1, 7),
(8, 5, 2, 2, 3, 43),
(9, 5, 1, 2, 2, 8),
(10, 5, 1, 2, 2, 10),
(11, 5, 1, 3, 1, 13),
(12, 2, 1, 2, 2, 7),
(13, 5, 1, 2, 1, 9),
(15, 2, 1, 2, 1, 11),
(16, 3, 1, 2, 1, 7),
(17, 3, 2, 2, 3, 44),
(18, 3, 2, 2, 3, 45),
(19, 7, 1, 3, 1, 13),
(20, 7, 1, 2, 1, 8),
(21, 2, 2, 2, 3, 46),
(22, 5, 1, 4, 1, 22),
(28, 7, 1, 1, 1, 2),
(30, 3, 1, 1, 2, 1),
(32, 7, 1, 1, 2, 2),
(33, 7, 1, 3, 2, 13),
(34, 5, 1, 1, 1, 2);

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
('cap', 'mkics', 'F', 'D'),
('hp', 'mkics', 'F', 'A'),
('JMP', 'mkics', 'F', 'A'),
('MV', 'mkics', 'F', 'A'),
('NB', 'mkics', 'F', 'A'),
('NV', 'mkics', 'F', 'A'),
('PP', 'mkics', 'F', 'A'),
('VJS', 'mkics', 'F', 'A');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `subject_allocation`
--
ALTER TABLE `subject_allocation`
  ADD CONSTRAINT `subject_allocation_ibfk_1` FOREIGN KEY (`suballoc_sub_id`) REFERENCES `subject_master` (`sub_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
