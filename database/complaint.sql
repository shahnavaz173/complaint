-- phpMyAdmin SQL Dump
-- version 4.5.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 24, 2018 at 03:50 PM
-- Server version: 5.7.11
-- PHP Version: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `complaint`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `a_id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(14) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`a_id`, `name`, `email`, `password`) VALUES
(1, 'Admin', 'admin@admin.com', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `cate_id` int(11) NOT NULL,
  `category` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cate_id`, `category`) VALUES
(1, 'Electrical'),
(2, 'Civil'),
(3, 'Plumbaring'),
(4, 'Carpenter'),
(5, 'Drainage'),
(6, 'biogas');

-- --------------------------------------------------------

--
-- Table structure for table `complaint`
--

CREATE TABLE `complaint` (
  `co_id` int(11) NOT NULL,
  `cate_id` int(11) DEFAULT NULL,
  `c_level` int(1) DEFAULT NULL,
  `description` longtext
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `complaint`
--

INSERT INTO `complaint` (`co_id`, `cate_id`, `c_level`, `description`) VALUES
(2, 1, 1, 'Tube Light Not Working'),
(3, 3, 2, 'Pipe Leakage'),
(4, 1, 1, 'Fan Not Working'),
(5, 1, 1, 'Power Cut'),
(6, 2, 1, 'Fan Not Working'),
(7, 1, 1, 'Switch Board Not Working'),
(8, 2, 1, 'Wall Damage'),
(9, 2, 1, 'Toles Broken'),
(10, 3, 1, 'Tap Leakage'),
(11, 4, 1, 'Door damaged'),
(12, 4, 1, 'Window broken'),
(13, 5, 1, 'Cleaning'),
(14, 1, 1, 'wire damaged'),
(15, 1, 1, 'fan regulator broken'),
(16, 2, 1, 'silling damaged'),
(17, 2, 1, 'Tiles damaged'),
(18, 3, 1, 'Water Tank broken'),
(19, 3, 1, 'washbasin pipe jammed'),
(20, 2, 1, 'washbasin broken'),
(22, 5, 1, 'Drain full ');

-- --------------------------------------------------------

--
-- Table structure for table `complaint_location`
--

CREATE TABLE `complaint_location` (
  `loc_id` int(11) NOT NULL,
  `c_id` varchar(20) NOT NULL,
  `location` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `complaint_location`
--

INSERT INTO `complaint_location` (`loc_id`, `c_id`, `location`) VALUES
(1, '2018-06-04-001', 'Computer Science Office No 3'),
(2, '2018-06-04-002', 'Residance 3,\r\nBuilding No. 1,\r\nRoom No 5'),
(3, '2018-06-04-003', 'Computer Science Office No 3'),
(4, '2018-06-04-004', 'Residance 3,\r\nBuilding No. 1,\r\nRoom No 5'),
(5, '2018-06-04-005', 'Computer Science Office No 3'),
(6, '2018-06-04-006', 'Residance 3,\r\nBuilding No. 1,\r\nRoom No 5'),
(7, '2018-06-04-007', 'Social Work Office No 1'),
(8, '2018-06-04-008', 'Social Work Office No 1'),
(9, '2018-06-04-009', 'Residance 5,\r\nBuilding No 3,\r\nRoom No 10'),
(10, '2018-06-04-010', 'Social Work Office No 1'),
(11, '2018-06-04-011', 'Residance 5,\r\nBuilding No 3,\r\nRoom No 10'),
(12, '2018-06-04-012', 'Social Work Office No 1'),
(13, '2018-06-04-013', 'Gujrati Vibhag Office No 2'),
(14, '2018-06-04-014', 'Gujrati Vibhag Office No 2'),
(15, '2018-06-04-015', 'Gujrati Vibhag Office No 2'),
(16, '2018-06-04-016', 'Residence 1,\r\nBuilding No 6,\r\nRoom No 1'),
(17, '2018-06-06-001', 'Social Work Office No 1'),
(18, '2018-06-06-002', 'Social Work Office No 1'),
(19, '2018-06-06-003', 'Residance 5,\r\nBuilding No 3,\r\nRoom No 10'),
(20, '2018-06-06-004', 'Social Work Office No 1'),
(21, '2018-06-06-005', 'Residance 5,\r\nBuilding No 3,\r\nRoom No 10'),
(22, '2018-06-06-006', 'Social Work Office No 1'),
(23, '2018-06-06-007', '116,Girls hostel'),
(24, '2018-06-06-008', '116,Girls hostel'),
(25, '2018-06-06-009', '116, girls hostel'),
(26, '2018-06-06-010', 'Computer Science MCA computer science department.'),
(27, '2018-06-06-011', '12,Post graduation Boys hostel'),
(28, '2018-06-06-012', '12,Post graduation Boys hostel'),
(29, '2018-06-06-013', 'USIC department Usic department'),
(30, '2018-06-06-014', 'USIC department Usic department'),
(31, '2018-06-06-015', 'Post Graduation Hostel'),
(32, '2018-06-06-016', 'Post Graduation Hostel'),
(33, '2018-06-06-017', 'Post Graduation Hostel'),
(34, '2018-06-06-018', 'USIC department Usic department'),
(35, '2018-06-06-019', 'Post Graduation Hostel'),
(36, '2018-06-06-020', 'Post Graduation Hostel'),
(37, '2018-06-06-021', 'USIC department Usic department'),
(38, '2018-06-06-022', 'USIC department Usic department'),
(39, '2018-06-06-023', '116,Girls hostel'),
(40, '2018-06-06-024', '116,Girls hostel'),
(41, '2018-06-06-025', '116,Girls hostel'),
(42, '2018-06-06-026', 'Computer Science MCA computer vibhag,gujarat vidya'),
(43, '2018-06-06-027', '116,Girls hostel'),
(44, '2018-06-06-028', '116,Girls hostel'),
(45, '2014-01-01-001', 'Residance 3,\r\nBuilding No. 1,\r\nRoom No 5'),
(46, '2018-06-20-001', 'Residance 3,\r\nBuilding No. 1,\r\nRoom No 5'),
(47, '2018-06-20-002', 'Computer Science Office No 3'),
(48, '2018-06-21-001', 'Residance 3,\r\nBuilding No. 1,\r\nRoom No 5'),
(49, '2014-01-01-002', 'Residance 3,\r\nBuilding No. 1,\r\nRoom No 5'),
(50, '2018-06-22-001', 'Residance 3,\r\nBuilding No. 1,\r\nRoom No 5'),
(51, '2018-06-22-002', 'Residance 3,\r\nBuilding No. 1,\r\nRoom No 5');

-- --------------------------------------------------------

--
-- Table structure for table `complaint_register`
--

CREATE TABLE `complaint_register` (
  `c_id` varchar(20) NOT NULL,
  `cate_id` int(11) NOT NULL,
  `u_id` varchar(10) NOT NULL,
  `c_description` longtext NOT NULL,
  `c_date` date NOT NULL DEFAULT '1996-05-02',
  `s_date` date DEFAULT NULL,
  `c_status` int(1) DEFAULT NULL,
  `solution_duration` int(11) DEFAULT NULL,
  `w_id` int(11) DEFAULT NULL,
  `f_date` date DEFAULT NULL,
  `satisfaction_level` int(1) DEFAULT NULL,
  `f_status` tinyint(1) NOT NULL,
  `f_available` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `complaint_register`
--

INSERT INTO `complaint_register` (`c_id`, `cate_id`, `u_id`, `c_description`, `c_date`, `s_date`, `c_status`, `solution_duration`, `w_id`, `f_date`, `satisfaction_level`, `f_status`, `f_available`) VALUES
('2018-06-04-001', 1, '101', 'Fan Stop Working', '2017-05-04', '2018-06-04', 5, NULL, 1, '2018-06-05', 2, 1, 0),
('2018-06-04-002', 1, '101', 'Power Cut', '2017-02-04', '2014-01-01', 5, NULL, 1, NULL, NULL, 0, 1),
('2018-06-04-003', 2, '101', 'Wall Damaged', '2018-03-04', '2018-06-04', 5, NULL, 10, '2018-06-05', 1, 1, 0),
('2018-06-04-004', 3, '101', 'Tap Leakage', '2018-06-04', '2018-06-05', 5, NULL, 2, '2014-01-01', 3, 1, 0),
('2018-06-04-005', 4, '101', 'Window broken', '2018-06-04', '2018-06-06', 5, NULL, 9, '2014-01-01', 2, 1, 0),
('2018-06-04-006', 5, '101', 'Cleaning', '2018-06-04', '2018-06-22', 4, NULL, 3, NULL, NULL, 0, 1),
('2018-06-04-007', 2, '102', 'Wall Damaged', '2018-06-04', NULL, 2, NULL, 1, NULL, NULL, 0, 0),
('2018-06-04-008', 1, '102', 'Switch Board Problem', '2017-11-04', '2018-06-05', 5, NULL, 1, '2018-06-06', 1, 1, 0),
('2018-06-04-009', 1, '102', 'Fan Stop Working', '2017-03-04', '2014-01-01', 4, NULL, 1, NULL, NULL, 0, 1),
('2018-06-04-010', 1, '102', 'Fan Stop Working', '2017-06-04', '2017-06-26', 4, NULL, 1, NULL, NULL, 0, 1),
('2018-06-04-011', 3, '102', 'Tap Leakage', '2017-06-04', '2017-06-15', 2, NULL, 2, NULL, NULL, 0, 0),
('2018-06-04-012', 4, '102', 'Window broken', '2017-07-04', NULL, 2, NULL, 9, NULL, NULL, 0, 0),
('2018-06-04-013', 1, '103', 'Tube Light Not Working', '2017-02-04', '2014-01-01', 4, NULL, 1, NULL, NULL, 0, 1),
('2018-06-04-014', 2, '103', 'Wall Damaged', '2017-08-04', '2018-06-06', 4, NULL, 10, NULL, NULL, 0, 1),
('2018-06-04-015', 4, '103', 'Window broken', '2017-01-04', '2018-06-06', 4, NULL, 9, NULL, NULL, 0, 1),
('2018-06-04-016', 1, '103', 'Power Cut', '2017-06-04', NULL, 2, NULL, 1, NULL, NULL, 0, 0),
('2018-06-06-001', 3, '102', 'Tap Leakage', '2017-03-06', NULL, 3, NULL, 2, NULL, NULL, 0, 0),
('2018-06-06-002', 2, '102', 'Wall Damaged', '2017-02-15', '2017-02-18', 5, NULL, 10, NULL, NULL, 0, 1),
('2018-06-06-003', 2, '102', 'Toles Broken', '2017-03-06', '2014-01-01', 4, NULL, 10, NULL, NULL, 0, 1),
('2018-06-06-004', 4, '102', 'Door damaged', '2017-06-24', NULL, 4, NULL, 9, NULL, NULL, 0, 1),
('2018-06-06-005', 4, '102', 'Window broken', '2018-06-06', NULL, 2, NULL, 9, NULL, NULL, 0, 0),
('2018-06-06-006', 5, '102', 'Cleaning', '2018-06-06', NULL, 2, NULL, 3, NULL, NULL, 0, 0),
('2018-06-06-007', 1, '106', 'Tube Light Not Working', '2017-07-06', NULL, 2, NULL, 1, NULL, NULL, 0, 0),
('2018-06-06-008', 3, '106', 'Pipe Leakage', '2017-09-06', '2014-01-01', 5, NULL, 2, NULL, NULL, 0, 1),
('2018-06-06-009', 4, '225', 'bed damaged', '2018-08-06', '2014-01-01', 5, NULL, 9, NULL, NULL, 0, 1),
('2018-06-06-010', 2, '225', 'Wall Damaged', '2018-06-06', NULL, 3, NULL, 10, NULL, NULL, 0, 0),
('2018-06-06-011', 3, '104', 'Tap Leakage', '2018-06-06', '2018-06-06', 4, NULL, 2, NULL, NULL, 0, 1),
('2018-06-06-012', 5, '104', 'Cleaning', '2018-06-06', '2018-06-06', 5, NULL, 3, NULL, NULL, 0, 1),
('2018-06-06-013', 3, '201', 'Pipe Leakage', '2018-06-06', '2018-06-06', 5, NULL, 2, NULL, NULL, 0, 1),
('2018-06-06-014', 2, '201', 'Wall Damaged', '2018-06-06', NULL, 2, NULL, 10, NULL, NULL, 0, 0),
('2018-06-06-015', 1, '201', 'Tube Light Not Working', '2018-06-06', NULL, 2, NULL, 1, NULL, NULL, 0, 0),
('2018-06-06-016', 4, '201', 'Door damaged', '2018-06-06', NULL, 3, NULL, 9, NULL, NULL, 0, 0),
('2018-06-06-017', 1, '201', 'Power Cut', '2018-06-06', '2018-06-06', 5, NULL, 1, NULL, NULL, 0, 1),
('2018-06-06-018', 1, '201', 'Tube Light Not Working', '2018-06-06', NULL, 2, NULL, 1, NULL, NULL, 0, 0),
('2018-06-06-019', 1, '201', 'Wiring Problem', '2018-06-06', NULL, 2, NULL, 1, NULL, NULL, 0, 0),
('2018-06-06-020', 1, '201', 'Switch Board Problem', '2018-06-06', NULL, 3, NULL, 1, NULL, NULL, 0, 0),
('2018-06-06-021', 1, '201', 'fan regulator broken', '2018-06-06', '2018-06-06', 4, NULL, 1, NULL, NULL, 0, 1),
('2018-06-06-022', 1, '201', 'fan regulator broken', '2018-06-06', '2018-06-06', 5, NULL, 1, NULL, NULL, 0, 1),
('2018-06-06-023', 1, '106', 'Power Cut', '2018-06-06', NULL, 2, NULL, 1, NULL, NULL, 0, 0),
('2018-06-06-024', 3, '106', 'washbasin pipe jammed', '2018-06-06', NULL, 2, NULL, 2, NULL, NULL, 0, 0),
('2018-06-06-025', 3, '106', 'Water Tank broken', '2018-06-06', NULL, 3, NULL, 2, NULL, NULL, 0, 0),
('2018-06-06-026', 2, '106', 'silling damaged', '2018-06-06', NULL, 2, NULL, 10, NULL, NULL, 0, 0),
('2018-06-06-027', 4, '106', 'Window broken', '2018-06-06', NULL, 3, NULL, 9, NULL, NULL, 0, 0),
('2018-06-06-028', 5, '106', 'Drain full ', '2018-06-06', '2018-06-06', 4, NULL, 3, NULL, NULL, 0, 1),
('2014-01-01-001', 5, '101', 'Cleaning', '2014-01-01', '2018-06-22', 5, NULL, 3, NULL, NULL, 0, 1),
('2018-06-20-001', 3, '101', 'washbasin pipe jammed', '2018-06-20', '2014-01-01', 5, NULL, 2, NULL, NULL, 0, 1),
('2018-06-20-002', 1, '101', 'Power Cut', '2018-06-20', '2014-01-01', 4, NULL, 1, NULL, NULL, 0, 1),
('2018-06-21-001', 1, '101', 'fan regulator broken', '2018-06-21', '2014-01-01', 5, NULL, 1, NULL, NULL, 0, 1),
('2014-01-01-002', 1, '101', 'Tube Light Not Working', '2014-01-01', '2018-06-22', 5, NULL, 1, NULL, NULL, 0, 1),
('2018-06-22-001', 4, '101', 'Door damaged', '2018-06-22', '2018-06-22', 4, NULL, 9, NULL, NULL, 0, 1),
('2018-06-22-002', 1, '101', 'wire damaged', '2018-06-22', NULL, 0, NULL, NULL, NULL, NULL, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `deptmst`
--

CREATE TABLE `deptmst` (
  `deptid` int(11) NOT NULL,
  `Dept_Name` varchar(100) NOT NULL,
  `HOD` varchar(50) NOT NULL,
  `Pho_No` varchar(20) NOT NULL,
  `Email` varchar(40) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `deptmst`
--

INSERT INTO `deptmst` (`deptid`, `Dept_Name`, `HOD`, `Pho_No`, `Email`) VALUES
(1, 'Computer Science', 'Ajaybhai Parikh', '9874563210', 'csdept.gvp@gujaratvidyapith.org'),
(3, 'Social Work', 'Anandiben', '9876541230', 'msw.gvp@gujratvidyapith.org'),
(4, 'Gujrati Vibhag', 'gujrati hod', '9635255852', 'gujrati,gvp@Gmail.com'),
(5, 'Yoga ', 'pal sir', '6369632520', 'yoga@gmail.com'),
(6, 'B.Ed', 'bed hod', '9685321450', 'bed@gmail.com'),
(7, 'Library Science', 'library hod', '96985236210', 'library@gmail.com'),
(8, 'USIC department', 'DharmendraBhai Kadiya', '5656565656', 'usic@gmail.com');

-- --------------------------------------------------------

--
-- Stand-in structure for view `monthly_report`
--
CREATE TABLE `monthly_report` (
`cate_id` int(11)
,`c_date` date
,`c_description` longtext
,`c_status` int(1)
,`w_id` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `quarterly_report`
--
CREATE TABLE `quarterly_report` (
`c_status` int(1)
,`c_date` date
,`c_description` longtext
,`cate_id` int(11)
,`w_id` int(11)
);

-- --------------------------------------------------------

--
-- Table structure for table `remark`
--

CREATE TABLE `remark` (
  `c_id` varchar(20) NOT NULL,
  `w_id` int(11) NOT NULL,
  `comment` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `remark`
--

INSERT INTO `remark` (`c_id`, `w_id`, `comment`) VALUES
('2014-01-01-001', 3, 'Some Message to Worker'),
('2014-01-01-002', 1, 'Tube Light'),
('2018-06-04-001', 1, 'Capecitors'),
('2018-06-04-002', 1, 'solve immediately'),
('2018-06-04-003', 10, 'Cement'),
('2018-06-04-004', 2, 'Bring New Tap'),
('2018-06-04-005', 9, 'Urgently Repair'),
('2018-06-04-006', 3, 'complete immediately'),
('2018-06-04-007', 1, 'solve'),
('2018-06-04-008', 1, 'Bring Some Switches'),
('2018-06-04-009', 1, 'solve immediate'),
('2018-06-04-010', 1, 'Bring Some Capecitors'),
('2018-06-04-011', 2, 'solve fast'),
('2018-06-04-012', 9, 'solve fast'),
('2018-06-04-013', 1, 'fhgbfvc'),
('2018-06-04-014', 10, 'Hello Mahesh'),
('2018-06-04-015', 9, 'solve fast'),
('2018-06-04-016', 1, 'solve fast'),
('2018-06-06-001', 2, 'solve fast'),
('2018-06-06-002', 10, 'solve fast'),
('2018-06-06-003', 10, 'solve fast'),
('2018-06-06-004', 9, 'solve fast'),
('2018-06-06-005', 9, 'solve fast'),
('2018-06-06-006', 3, 'solve fast'),
('2018-06-06-007', 1, 'solve fast'),
('2018-06-06-008', 2, 'solve within two days'),
('2018-06-06-009', 9, 'solve fast'),
('2018-06-06-010', 10, 'solve fast'),
('2018-06-06-011', 2, 'solve fast'),
('2018-06-06-012', 3, 'solve fast'),
('2018-06-06-013', 2, 'solve fast and take needy materials from me'),
('2018-06-06-014', 10, 'solve fast'),
('2018-06-06-015', 1, 'solve fast'),
('2018-06-06-016', 9, 'solve fast'),
('2018-06-06-017', 1, 'solve fast'),
('2018-06-06-018', 1, 'solve fast'),
('2018-06-06-019', 1, 'solve fast'),
('2018-06-06-020', 1, 'solve fast'),
('2018-06-06-021', 1, 'solve fast'),
('2018-06-06-022', 1, 'solve fast'),
('2018-06-06-023', 1, 'solve fast'),
('2018-06-06-024', 2, 'solve fast'),
('2018-06-06-025', 2, 'solve fast'),
('2018-06-06-026', 10, 'solve fast'),
('2018-06-06-027', 9, 'dsfsdfds'),
('2018-06-06-028', 3, 'solve fast'),
('2018-06-20-001', 2, 'sfddsfd'),
('2018-06-20-002', 1, 'Power kit'),
('2018-06-21-001', 1, 'Regulator'),
('2018-06-22-001', 9, 'door');

-- --------------------------------------------------------

--
-- Stand-in structure for view `six_monthly_report`
--
CREATE TABLE `six_monthly_report` (
`c_status` int(1)
,`c_date` date
,`c_description` longtext
,`cate_id` int(11)
,`w_id` int(11)
);

-- --------------------------------------------------------

--
-- Table structure for table `studmst`
--

CREATE TABLE `studmst` (
  `Stud_ID` varchar(10) NOT NULL,
  `Pwd` varchar(20) NOT NULL,
  `Stud_Name` varchar(200) NOT NULL,
  `stud_name_eng` varchar(200) NOT NULL,
  `Email` varchar(40) NOT NULL,
  `Add_Yr` varchar(40) NOT NULL,
  `Mo` varchar(15) NOT NULL,
  `bdate` date NOT NULL,
  `Dept_Name` varchar(200) NOT NULL,
  `Pro_Name` varchar(20) NOT NULL,
  `Loc_Add` varchar(200) NOT NULL,
  `Per_Add` varchar(200) NOT NULL,
  `Caste` varchar(20) NOT NULL,
  `Gender` varchar(20) NOT NULL,
  `Grad_Yr` varchar(30) NOT NULL,
  `Univ_Name` varchar(150) NOT NULL,
  `Campus` varchar(20) NOT NULL,
  `user_type` enum('student','department','','') NOT NULL,
  `curr_sem` int(2) NOT NULL,
  `Repeat_sem` varchar(15) NOT NULL,
  `activated` tinyint(1) NOT NULL,
  `studImage` blob
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `studmst`
--

INSERT INTO `studmst` (`Stud_ID`, `Pwd`, `Stud_Name`, `stud_name_eng`, `Email`, `Add_Yr`, `Mo`, `bdate`, `Dept_Name`, `Pro_Name`, `Loc_Add`, `Per_Add`, `Caste`, `Gender`, `Grad_Yr`, `Univ_Name`, `Campus`, `user_type`, `curr_sem`, `Repeat_sem`, `activated`, `studImage`) VALUES
('11708118', 'abcd', 'Mehul n zala', 'Mehul n zala', 'mehul@gmail.com', '', '975258745', '0000-00-00', '', '', '', '', '', '', '', '', '', 'student', 0, '', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `u_id` varchar(10) NOT NULL,
  `full_name` varchar(60) NOT NULL,
  `emp_no` varchar(15) NOT NULL,
  `email` varchar(40) NOT NULL,
  `pho_no` varchar(13) NOT NULL,
  `address` longtext NOT NULL,
  `u_type` varchar(10) NOT NULL,
  `gender` char(1) NOT NULL,
  `user_photo` varchar(45) NOT NULL,
  `password` varchar(14) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`u_id`, `full_name`, `emp_no`, `email`, `pho_no`, `address`, `u_type`, `gender`, `user_photo`, `password`) VALUES
('101', 'Shahnawaz Saiyed', '101', 'ssaiyed173@gmail.com', '9726321433', 'Residance 3,\r\nBuilding No. 1,\r\nRoom No 5', 'employee', 'M', 'profile101.jpg', 'Vf2fh2nt7'),
('102', 'Mehul Zala', '102', 'mehulzala245@gmail.com', '9863251432', 'Residance 5,\r\nBuilding No 3,\r\nRoom No 10', 'employee', 'M', 'profile102.jpg', 'mehulzala'),
('103', 'Tarun Patel', '103', 'tarunpatel@gmail.com', '9736975620', 'Residence 1,\r\nBuilding No 6,\r\nRoom No 1', 'employee', 'M', 'profile103.jpg', 'lalupatel'),
('104', 'vipul arvindbhai vohra', '104', 'vipul@gmail.com', '7878787878', '12,Post graduation Boys hostel', 'student', 'M', 'profile104.jpg', 'vipul1234'),
('106', 'megha gopalbhai prajapati', '106', 'megha@gmail.com', '6363636363', '116,Girls hostel', 'student', 'F', 'profile106.jpg', 'megha1234'),
('209', 'pankaj Mathavadiya rameshbhai', '209', 'pankaj@gmail.com', '9696969696', '112,Post graduation hostel', 'student', 'M', 'profile209.png', 'pankaj1234'),
('225', 'Hima Raja Mannar', '225', '11708225.gvp@gujaratvidyapith.org', '9898560296', '116, girls hostel', 'student', 'F', 'profile225.jpg', 'mahi123'),
('203', 'aarti ratanlal prajapati', '203', '11708203.gvp@gujaratvidyapith.org', '9033941949', '116,girls hostel', 'student', 'F', 'profile203.png', 'aarti123'),
('108', 'kajal maheshgiri goswami', '108', 'kajal@gmail.com', '9898675645', '65, girls hostel', 'student', 'F', 'profile.png', 'kajal123'),
('201', 'goswami vishwas kailash', '201', 'vishwas@gmail.com', '9898989898', 'Post Graduation Hostel', 'student', 'M', 'profile201.png', 'vishwas1234');

-- --------------------------------------------------------

--
-- Table structure for table `user_dept`
--

CREATE TABLE `user_dept` (
  `u_id` int(11) NOT NULL,
  `deptid` int(11) NOT NULL,
  `office_location` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_dept`
--

INSERT INTO `user_dept` (`u_id`, `deptid`, `office_location`) VALUES
(101, 1, 'Computer Science Office No 3'),
(102, 3, 'Social Work Office No 1'),
(103, 4, 'Gujrati Vibhag Office No 2'),
(104, 1, 'Computer Science HRM department'),
(106, 1, 'Computer Science MCA computer vibhag,gujarat vidya'),
(209, 1, 'Computer Science MCA department,Computer vibhag gu'),
(225, 1, 'Computer Science MCA computer science department.'),
(203, 1, 'Computer Science MCA computer science department'),
(108, 1, 'Computer Science MCA computer science department'),
(201, 8, 'USIC department Usic department');

-- --------------------------------------------------------

--
-- Table structure for table `worker`
--

CREATE TABLE `worker` (
  `w_id` int(11) NOT NULL,
  `w_name` varchar(60) NOT NULL,
  `ph_no` varchar(13) NOT NULL,
  `email` varchar(40) NOT NULL,
  `address` varchar(100) NOT NULL,
  `skill` int(11) NOT NULL,
  `w_status` varchar(15) NOT NULL,
  `password` varchar(14) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `worker`
--

INSERT INTO `worker` (`w_id`, `w_name`, `ph_no`, `email`, `address`, `skill`, `w_status`, `password`) VALUES
(1, 'Ramesh', '9657452365', 'ramesh@gmail.com', '110,Usmanpura Ahmedabad,\nAhmedabad- 380014', 1, 'Active', ''),
(2, 'Suresh', '9657452366', 'suresh@gmail.com', '92,Incometax Ahmedabad,\nAhmedabad- 380014', 3, 'Active', 'suresh'),
(9, 'Shahnavaz Saiyadmiyan Saiyed', '9726321433', 'ssaiyed173@gmail.com', 'Vansda', 4, 'Active', ''),
(3, 'khushboo', '9786543252', 'khushboo@gmail.com', 'navrangpura', 5, 'Active', '1234567'),
(10, 'Mahesh ', '9874623510', 'mahesh@gmail.com', '92,NavrangpuraAhmedabad, Ahmedabad- 380014	', 2, 'Active', 'mahesh');

-- --------------------------------------------------------

--
-- Stand-in structure for view `yearly_report`
--
CREATE TABLE `yearly_report` (
`cate_id` int(11)
,`c_date` date
,`c_description` longtext
,`c_status` int(1)
,`w_id` int(11)
);

-- --------------------------------------------------------

--
-- Structure for view `monthly_report`
--
DROP TABLE IF EXISTS `monthly_report`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `monthly_report`  AS  select `complaint_register`.`cate_id` AS `cate_id`,`complaint_register`.`c_date` AS `c_date`,`complaint_register`.`c_description` AS `c_description`,`complaint_register`.`c_status` AS `c_status`,`complaint_register`.`w_id` AS `w_id` from `complaint_register` where ((month(`complaint_register`.`c_date`) = month(curdate())) and (year(`complaint_register`.`c_date`) = year(curdate()))) ;

-- --------------------------------------------------------

--
-- Structure for view `quarterly_report`
--
DROP TABLE IF EXISTS `quarterly_report`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `quarterly_report`  AS  select `complaint_register`.`c_status` AS `c_status`,`complaint_register`.`c_date` AS `c_date`,`complaint_register`.`c_description` AS `c_description`,`complaint_register`.`cate_id` AS `cate_id`,`complaint_register`.`w_id` AS `w_id` from `complaint_register` where ((`complaint_register`.`c_date` >= (now() - interval 2 month)) and (year(`complaint_register`.`c_date`) = year(curdate()))) ;

-- --------------------------------------------------------

--
-- Structure for view `six_monthly_report`
--
DROP TABLE IF EXISTS `six_monthly_report`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `six_monthly_report`  AS  select `complaint_register`.`c_status` AS `c_status`,`complaint_register`.`c_date` AS `c_date`,`complaint_register`.`c_description` AS `c_description`,`complaint_register`.`cate_id` AS `cate_id`,`complaint_register`.`w_id` AS `w_id` from `complaint_register` where ((`complaint_register`.`c_date` >= (now() - interval 5 month)) and (year(`complaint_register`.`c_date`) = year(curdate()))) ;

-- --------------------------------------------------------

--
-- Structure for view `yearly_report`
--
DROP TABLE IF EXISTS `yearly_report`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `yearly_report`  AS  select `complaint_register`.`cate_id` AS `cate_id`,`complaint_register`.`c_date` AS `c_date`,`complaint_register`.`c_description` AS `c_description`,`complaint_register`.`c_status` AS `c_status`,`complaint_register`.`w_id` AS `w_id` from `complaint_register` where (year(`complaint_register`.`c_date`) = year(curdate())) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`a_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cate_id`);

--
-- Indexes for table `complaint`
--
ALTER TABLE `complaint`
  ADD PRIMARY KEY (`co_id`),
  ADD KEY `cate_id` (`cate_id`);

--
-- Indexes for table `complaint_location`
--
ALTER TABLE `complaint_location`
  ADD PRIMARY KEY (`loc_id`,`c_id`),
  ADD KEY `c_id` (`c_id`);

--
-- Indexes for table `complaint_register`
--
ALTER TABLE `complaint_register`
  ADD PRIMARY KEY (`c_id`),
  ADD KEY `ct_id` (`cate_id`),
  ADD KEY `u_id` (`u_id`),
  ADD KEY `w_id` (`w_id`);

--
-- Indexes for table `deptmst`
--
ALTER TABLE `deptmst`
  ADD PRIMARY KEY (`deptid`),
  ADD UNIQUE KEY `Dept_Name` (`Dept_Name`);

--
-- Indexes for table `remark`
--
ALTER TABLE `remark`
  ADD PRIMARY KEY (`c_id`,`w_id`) USING BTREE;

--
-- Indexes for table `studmst`
--
ALTER TABLE `studmst`
  ADD PRIMARY KEY (`Stud_ID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`u_id`),
  ADD UNIQUE KEY `email` (`email`,`pho_no`);

--
-- Indexes for table `user_dept`
--
ALTER TABLE `user_dept`
  ADD PRIMARY KEY (`u_id`,`deptid`),
  ADD KEY `deptid` (`deptid`);

--
-- Indexes for table `worker`
--
ALTER TABLE `worker`
  ADD PRIMARY KEY (`w_id`),
  ADD UNIQUE KEY `ph_no` (`ph_no`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cate_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `complaint`
--
ALTER TABLE `complaint`
  MODIFY `co_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `complaint_location`
--
ALTER TABLE `complaint_location`
  MODIFY `loc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;
--
-- AUTO_INCREMENT for table `deptmst`
--
ALTER TABLE `deptmst`
  MODIFY `deptid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `worker`
--
ALTER TABLE `worker`
  MODIFY `w_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
