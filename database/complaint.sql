-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 05, 2018 at 06:22 AM
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
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `complaint_location`
--

INSERT INTO `complaint_location` (`loc_id`, `c_id`, `location`) VALUES
(1, '20180528-101-0001', 'Computer Science Office No 3'),
(2, '20180528-102-0002', 'Computer Science Class Room 3'),
(3, '20180528-101-0003', 'Apartment D,\r\nBuilding No 5,\r\nRoom No 1'),
(4, '20180528-101-0004', 'Apartment D,\r\nBuilding No 5,\r\nRoom No 1'),
(5, '2018-06-04-001', 'Computer Science Office No 3'),
(6, '2018-06-04-002', 'Apartment D,\r\nBuilding No 5,\r\nRoom No 1'),
(7, '2018-06-04-003', 'Computer Science Office No 3'),
(8, '2018-06-04-004', 'Apartment D,\r\nBuilding No 5,\r\nRoom No 1'),
(9, '2018-06-04-005', 'Computer Science Office No 3'),
(10, '2018-06-04-006', 'Apartment D,\r\nBuilding No 5,\r\nRoom No 1'),
(11, '2018-06-04-007', 'Apartment D,\r\nBuilding No 5,\r\nRoom No 1'),
(12, '2018-06-04-008', 'Computer Science Office No 3'),
(13, '2018-06-04-009', 'Computer Science Office No 3'),
(14, '2018-06-04-010', 'Apartment D,\r\nBuilding No 5,\r\nRoom No 1'),
(15, '2018-06-04-011', 'Computer Science Office No 3'),
(16, '2018-06-04-012', 'Computer Science Office No 3'),
(17, '2018-06-04-013', 'Computer Science Office No 3'),
(18, '2018-06-04-014', 'Apartment D,\r\nBuilding No 5,\r\nRoom No 1');

-- --------------------------------------------------------

--
-- Table structure for table `complaint_register`
--

DROP TABLE IF EXISTS `complaint_register`;
CREATE TABLE IF NOT EXISTS `complaint_register` (
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
  `f_available` tinyint(1) NOT NULL,
  PRIMARY KEY (`c_id`),
  KEY `ct_id` (`cate_id`),
  KEY `u_id` (`u_id`),
  KEY `w_id` (`w_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `complaint_register`
--

INSERT INTO `complaint_register` (`c_id`, `cate_id`, `u_id`, `c_description`, `c_date`, `s_date`, `c_status`, `solution_duration`, `w_id`, `f_date`, `satisfaction_level`, `f_status`, `f_available`) VALUES
('20180528-101-0001', 1, '101', 'Fan Not Working', '2018-04-28', '2018-06-02', 5, NULL, 1, NULL, NULL, 0, 1),
('20180528-102-0002', 1, '102', 'Tube Light Not Working', '2018-05-03', '2018-06-04', 4, NULL, 1, NULL, NULL, 0, 1),
('20180528-101-0003', 3, '101', 'Pipe Leakage', '2018-05-28', '2018-06-01', 5, NULL, 2, '2018-06-01', 3, 1, 0),
('20180528-101-0004', 4, '101', 'Door is Broken', '2018-05-24', '2018-06-02', 4, NULL, 9, '2018-06-02', 2, 1, 0),
('2018-06-04-001', 1, '101', 'Tube Light Not Working', '2018-06-04', NULL, 2, NULL, 1, NULL, NULL, 0, 0),
('2018-06-04-002', 1, '101', 'Tube Light Not Working', '2018-06-04', NULL, 2, NULL, 1, NULL, NULL, 0, 0),
('2018-06-04-003', 1, '101', 'Tube Light Not Working', '2018-06-04', NULL, 2, NULL, 1, NULL, NULL, 0, 0),
('2018-06-04-004', 1, '101', 'Tube Light Not Working', '2018-06-04', NULL, 2, NULL, 1, NULL, NULL, 0, 0),
('2018-06-04-005', 3, '101', 'Pipe Leakage', '2018-06-04', NULL, 2, NULL, 2, NULL, NULL, 0, 0),
('2018-06-04-006', 1, '101', 'Tube Light Not Working', '2018-06-04', NULL, 2, NULL, 1, NULL, NULL, 0, 0),
('2018-06-04-007', 1, '101', 'Tube Light Not Working', '2018-06-04', NULL, 2, NULL, 1, NULL, NULL, 0, 0),
('2018-06-04-008', 1, '101', 'Tube Light Not Working', '2018-06-04', NULL, 2, NULL, 1, NULL, NULL, 0, 0),
('2018-06-04-009', 1, '101', 'Tube Light Not Working', '2018-06-04', NULL, 2, NULL, 1, NULL, NULL, 0, 0),
('2018-06-04-010', 1, '101', 'Tube Light Not Working', '2018-06-04', NULL, 2, NULL, 1, NULL, NULL, 0, 0),
('2018-06-04-011', 1, '101', 'Tube Light Not Working', '2018-06-04', NULL, 2, NULL, 1, NULL, NULL, 0, 0),
('2018-06-04-012', 1, '101', 'Tube Light Not Working', '2018-06-04', NULL, 2, NULL, 1, NULL, NULL, 0, 0),
('2018-06-04-013', 1, '101', 'Tube Light Not Working', '2018-06-04', NULL, 2, NULL, 1, NULL, NULL, 0, 0),
('2018-06-04-014', 3, '101', 'Pipe Leakage', '2018-06-04', NULL, 2, NULL, 2, NULL, NULL, 0, 0);

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
-- Stand-in structure for view `monthly_report`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `monthly_report`;
CREATE TABLE IF NOT EXISTS `monthly_report` (
`cate_id` int(11)
,`c_description` longtext
,`c_status` int(1)
,`w_id` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `quarterly_report`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `quarterly_report`;
CREATE TABLE IF NOT EXISTS `quarterly_report` (
`cate_id` int(11)
,`c_description` longtext
,`c_status` int(1)
,`w_id` int(11)
);

-- --------------------------------------------------------

--
-- Table structure for table `remark`
--

DROP TABLE IF EXISTS `remark`;
CREATE TABLE IF NOT EXISTS `remark` (
  `c_id` varchar(20) NOT NULL,
  `w_id` int(11) NOT NULL,
  `comment` varchar(50) NOT NULL,
  PRIMARY KEY (`c_id`,`w_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `remark`
--

INSERT INTO `remark` (`c_id`, `w_id`, `comment`) VALUES
('2018-06-04-001', 1, 'Hello'),
('2018-06-04-002', 1, 'fdfdsd'),
('2018-06-04-003', 1, 'Remark'),
('2018-06-04-004', 1, 'djknkksanks'),
('2018-06-04-005', 2, 'Remark'),
('2018-06-04-006', 1, 'dsdasds'),
('2018-06-04-007', 1, 'ddss'),
('2018-06-04-008', 1, 'remark'),
('2018-06-04-009', 1, 'Remark'),
('2018-06-04-010', 1, 'Bring Some Tube Lights'),
('2018-06-04-011', 1, 'Bring Some tube Lights'),
('2018-06-04-012', 1, 'Bring Some TubeLights'),
('2018-06-04-013', 1, 'Bring Some Tube Lights'),
('2018-06-04-014', 2, 'Pipe'),
('20180528-101-0001', 1, 'gfgfgf'),
('20180528-101-0004', 9, 'fdfjkkjdjfkd'),
('20180528-102-0002', 1, 'Remark');

-- --------------------------------------------------------

--
-- Stand-in structure for view `six_monthly_report`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `six_monthly_report`;
CREATE TABLE IF NOT EXISTS `six_monthly_report` (
`cate_id` int(11)
,`c_description` longtext
,`c_status` int(1)
,`w_id` int(11)
);

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
  `pho_no` varchar(13) NOT NULL,
  `address` longtext NOT NULL,
  `u_type` varchar(10) NOT NULL,
  `gender` char(1) NOT NULL,
  `user_photo` varchar(45) NOT NULL,
  `password` varchar(14) NOT NULL,
  PRIMARY KEY (`u_id`),
  UNIQUE KEY `email` (`email`,`pho_no`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`u_id`, `full_name`, `emp_no`, `email`, `pho_no`, `address`, `u_type`, `gender`, `user_photo`, `password`) VALUES
('101', 'Shahnavaz Saiyad', '101', 'ssaiyed173@gmail.com', '9726321433', 'Apartment D,\r\nBuilding No 5,\r\nRoom No 1', 'employee', 'M', 'profile111.jpg', 'Vf2fh2nt7'),
('102', 'Mehul Zala', '102', 'mehul@gmail.com', '9632587410', 'Appartment A,\r\nBuilding No 2,\r\nRoom No 1.', 'employee', 'M', 'profile111.jpg', 'mehulzala'),
('111', 'Urvesh Gayakwad', '111', 'urvesh@gmail.com', '9563251230', 'Rasidence 3,\r\nBuilding No 2,\r\nRoom no 10', 'employee', 'M', 'profile111.jpg', 'urvesh');

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

--
-- Dumping data for table `user_dept`
--

INSERT INTO `user_dept` (`u_id`, `deptid`, `office_location`) VALUES
(101, 1, 'Computer Science Office No 3'),
(102, 1, 'Computer Science Office No 1'),
(111, 1, 'Computer Science Office No 2');

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
  `password` varchar(14) NOT NULL,
  PRIMARY KEY (`w_id`),
  UNIQUE KEY `ph_no` (`ph_no`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `worker`
--

INSERT INTO `worker` (`w_id`, `w_name`, `ph_no`, `email`, `address`, `skill`, `w_status`, `password`) VALUES
(1, 'Ramesh', '9657452365', 'ramesh@gmail.com', '110,Usmanpura Ahmedabad,\nAhmedabad- 380014', 1, 'Active', ''),
(2, 'Suresh', '9657452366', 'suresh@gmail.com', '92,Incometax Ahmedabad,\nAhmedabad- 380014', 3, 'Active', 'suresh'),
(9, 'Shahnavaz Saiyadmiyan Saiyed', '9726321433', 'ssaiyed173@gmail.com', 'Vansda', 4, 'Active', '');

-- --------------------------------------------------------

--
-- Stand-in structure for view `yearly_report`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `yearly_report`;
CREATE TABLE IF NOT EXISTS `yearly_report` (
`cate_id` int(11)
,`c_description` longtext
,`c_status` int(1)
,`w_id` int(11)
);

-- --------------------------------------------------------

--
-- Structure for view `monthly_report`
--
DROP TABLE IF EXISTS `monthly_report`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `monthly_report`  AS  select `complaint_register`.`cate_id` AS `cate_id`,`complaint_register`.`c_description` AS `c_description`,`complaint_register`.`c_status` AS `c_status`,`complaint_register`.`w_id` AS `w_id` from `complaint_register` where ((month(`complaint_register`.`c_date`) = month(curdate())) and (year(`complaint_register`.`c_date`) = year(curdate()))) ;

-- --------------------------------------------------------

--
-- Structure for view `quarterly_report`
--
DROP TABLE IF EXISTS `quarterly_report`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `quarterly_report`  AS  select `complaint_register`.`cate_id` AS `cate_id`,`complaint_register`.`c_description` AS `c_description`,`complaint_register`.`c_status` AS `c_status`,`complaint_register`.`w_id` AS `w_id` from `complaint_register` where (`complaint_register`.`c_date` >= (now() - interval 2 month)) ;

-- --------------------------------------------------------

--
-- Structure for view `six_monthly_report`
--
DROP TABLE IF EXISTS `six_monthly_report`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `six_monthly_report`  AS  select `complaint_register`.`cate_id` AS `cate_id`,`complaint_register`.`c_description` AS `c_description`,`complaint_register`.`c_status` AS `c_status`,`complaint_register`.`w_id` AS `w_id` from `complaint_register` where (`complaint_register`.`c_date` >= (now() - interval 5 month)) ;

-- --------------------------------------------------------

--
-- Structure for view `yearly_report`
--
DROP TABLE IF EXISTS `yearly_report`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `yearly_report`  AS  select `complaint_register`.`cate_id` AS `cate_id`,`complaint_register`.`c_description` AS `c_description`,`complaint_register`.`c_status` AS `c_status`,`complaint_register`.`w_id` AS `w_id` from `complaint_register` where (year(`complaint_register`.`c_date`) = year(curdate())) ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
