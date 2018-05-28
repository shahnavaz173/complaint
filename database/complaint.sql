-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 28, 2018 at 04:14 AM
-- Server version: 5.7.19
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
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

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `a_id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(14) NOT NULL,
  PRIMARY KEY (`a_id`),
  UNIQUE KEY `email` (`email`)
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

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `cate_id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(20) NOT NULL,
  PRIMARY KEY (`cate_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cate_id`, `category`) VALUES
(1, 'Electrical'),
(2, 'Civil'),
(3, 'Plumbaring'),
(4, 'Carpenter'),
(5, 'Drainage');

-- --------------------------------------------------------

--
-- Table structure for table `complaint`
--

DROP TABLE IF EXISTS `complaint`;
CREATE TABLE IF NOT EXISTS `complaint` (
  `co_id` int(11) NOT NULL AUTO_INCREMENT,
  `cate_id` int(11) DEFAULT NULL,
  `c_level` int(1) DEFAULT NULL,
  `description` longtext,
  PRIMARY KEY (`co_id`),
  KEY `cate_id` (`cate_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `complaint`
--

INSERT INTO `complaint` (`co_id`, `cate_id`, `c_level`, `description`) VALUES
(1, 1, 1, 'Fan Not Working'),
(2, 1, 1, 'Tube Light Not Working'),
(3, 3, 2, 'Pipe Leakage');

-- --------------------------------------------------------

--
-- Table structure for table `complaint_location`
--

DROP TABLE IF EXISTS `complaint_location`;
CREATE TABLE IF NOT EXISTS `complaint_location` (
  `loc_id` int(11) NOT NULL AUTO_INCREMENT,
  `c_id` varchar(20) NOT NULL,
  `location` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`loc_id`,`c_id`),
  KEY `c_id` (`c_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `complaint_location`
--

INSERT INTO `complaint_location` (`loc_id`, `c_id`, `location`) VALUES
(1, '20180527-101-0001', 'abcd'),
(2, '20180527-101-0002', 'abcd');

-- --------------------------------------------------------

--
-- Table structure for table `complaint_register`
--

DROP TABLE IF EXISTS `complaint_register`;
CREATE TABLE IF NOT EXISTS `complaint_register` (
  `c_id` varchar(20) NOT NULL,
  `cate_id` int(11) DEFAULT NULL,
  `u_id` varchar(10) DEFAULT NULL,
  `c_description` longtext,
  `c_date` date DEFAULT '1996-05-02',
  `s_date` date DEFAULT NULL,
  `c_status` varchar(10) DEFAULT NULL,
  `response` varchar(40) DEFAULT NULL,
  `w_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`c_id`),
  KEY `ct_id` (`cate_id`),
  KEY `u_id` (`u_id`),
  KEY `w_id` (`w_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `complaint_register`
--

INSERT INTO `complaint_register` (`c_id`, `cate_id`, `u_id`, `c_description`, `c_date`, `s_date`, `c_status`, `response`, `w_id`) VALUES
('20180527-101-0001', 1, '101', 'Fan Not Working', '2018-05-27', NULL, NULL, NULL, NULL),
('20180527-101-0002', 1, '101', 'Tube Light Not Working', '2018-05-27', NULL, 'Pending', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `deptmst`
--

DROP TABLE IF EXISTS `deptmst`;
CREATE TABLE IF NOT EXISTS `deptmst` (
  `deptid` int(11) NOT NULL AUTO_INCREMENT,
  `Dept_Name` varchar(100) NOT NULL,
  `HOD` varchar(50) NOT NULL,
  `Pho_No` varchar(20) NOT NULL,
  `Email` varchar(40) NOT NULL,
  PRIMARY KEY (`deptid`),
  UNIQUE KEY `Dept_Name` (`Dept_Name`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `deptmst`
--

INSERT INTO `deptmst` (`deptid`, `Dept_Name`, `HOD`, `Pho_No`, `Email`) VALUES
(1, 'Computer Science', 'Ajaybhai Parikh', '9874563210', 'csdept.gvp@gujaratvidyapith.org'),
(2, 'Post Graduation Boys Hostel', 'Pradip Bhai Patel', '9652341523', 'pgboyshostel.gvp@gujaratvidyapith.org');

-- --------------------------------------------------------

--
-- Table structure for table `studmst`
--

DROP TABLE IF EXISTS `studmst`;
CREATE TABLE IF NOT EXISTS `studmst` (
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
  `studImage` blob,
  PRIMARY KEY (`Stud_ID`)
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

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `u_id` varchar(10) NOT NULL,
  `full_name` varchar(60) NOT NULL,
  `emp_no` varchar(15) NOT NULL,
  `email` varchar(40) NOT NULL,
  `ph_no` varchar(13) NOT NULL,
  `address` longtext NOT NULL,
  `u_type` varchar(10) NOT NULL,
  `gender` char(1) NOT NULL,
  `password` varchar(14) NOT NULL,
  PRIMARY KEY (`u_id`),
  UNIQUE KEY `email` (`email`,`ph_no`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`u_id`, `full_name`, `emp_no`, `email`, `ph_no`, `address`, `u_type`, `gender`, `password`) VALUES
('101', 'Shahnavaz Saiyadmiyan Saiyed', '101', 'ssaiyed173@gmail.com', '9726321433', 'abcd', 'employee', 'M', 'Vf2fh2nt9');

-- --------------------------------------------------------

--
-- Table structure for table `user_dept`
--

DROP TABLE IF EXISTS `user_dept`;
CREATE TABLE IF NOT EXISTS `user_dept` (
  `u_id` int(11) NOT NULL,
  `deptid` int(11) NOT NULL,
  `office_location` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`u_id`,`deptid`),
  KEY `deptid` (`deptid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `worker`
--

DROP TABLE IF EXISTS `worker`;
CREATE TABLE IF NOT EXISTS `worker` (
  `w_id` int(11) NOT NULL AUTO_INCREMENT,
  `w_name` varchar(60) NOT NULL,
  `ph_no` varchar(13) NOT NULL,
  `email` varchar(40) NOT NULL,
  `address` varchar(100) NOT NULL,
  `skill` int(11) NOT NULL,
  `w_status` varchar(15) NOT NULL,
  PRIMARY KEY (`w_id`),
  UNIQUE KEY `ph_no` (`ph_no`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `worker`
--

INSERT INTO `worker` (`w_id`, `w_name`, `ph_no`, `email`, `address`, `skill`, `w_status`) VALUES
(1, 'Ramesh', '9657452365', 'ramesh@gmail.com', '110,Usmanpura Ahmedabad,\nAhmedabad- 380014', 1, 'Active'),
(2, 'Suresh', '9657452366', 'suresh@gmail.com', '92,Incometax Ahmedabad,\nAhmedabad- 380014', 3, 'Not Active');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
