-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 25, 2022 at 03:47 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `arahman_portal`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_active` int(1) NOT NULL DEFAULT 1,
  `type` varchar(10) NOT NULL DEFAULT 'admin' COMMENT 'Possible values are: admin, owner, accountant, principal, head teacher, admission, teacher',
  `admin_firstname` varchar(20) NOT NULL,
  `admin_lastname` varchar(20) NOT NULL,
  `admin_email` varchar(30) NOT NULL,
  `admin_password` varchar(255) NOT NULL,
  `admin_cookie_session` varchar(255) NOT NULL,
  `admin_timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_active`, `type`, `admin_firstname`, `admin_lastname`, `admin_email`, `admin_password`, `admin_cookie_session`, `admin_timestamp`) VALUES
(1, 1, 'owner', 'Ahmed', 'Olusesi', 'owner', '5f4dcc3b5aa765d61d8327deb882cf99', '', '2022-01-03 09:49:31'),
(2, 1, 'headmaster', 'Headmaster', '1', 'headmaster1', '5f4dcc3b5aa765d61d8327deb882cf99', '', '2022-01-08 14:00:53'),
(3, 1, 'admission', 'seye', 'alade', 'admission', '5f4dcc3b5aa765d61d8327deb882cf99', '060686b23028e718f85a5fbd81f12245', '2022-04-06 14:28:14'),
(4, 1, 'accountant', 'teni', 'alade', 'accountant', '5f4dcc3b5aa765d61d8327deb882cf99', '', '2022-04-06 14:28:14'),
(5, 1, 'principal', 'anita', 'anita', 'principal', '5f4dcc3b5aa765d61d8327deb882cf99', '', '2022-04-06 14:28:14');

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `module_id` int(11) NOT NULL,
  `module_type` varchar(50) NOT NULL,
  `module_start_date` varchar(11) NOT NULL,
  `module_end_date` varchar(11) NOT NULL,
  `module_session` varchar(10) NOT NULL,
  `module_term` varchar(15) NOT NULL,
  `module_timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`module_id`, `module_type`, `module_start_date`, `module_end_date`, `module_session`, `module_term`, `module_timestamp`) VALUES
(30, 'swimming lesson', '2022-04-23', '2022-04-27', '2001/2002', 'Second term', '2022-04-21 13:01:39'),
(32, 'Field trip', '2022-04-23', '2022-04-24', '2001/2002', 'Second term', '2022-04-22 00:46:34');

-- --------------------------------------------------------

--
-- Table structure for table `module_join_students`
--

CREATE TABLE `module_join_students` (
  `module_join_students_id` int(11) NOT NULL,
  `module_students` int(11) NOT NULL,
  `module_type_id` int(11) NOT NULL,
  `module_join_students_timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `module_join_students`
--

INSERT INTO `module_join_students` (`module_join_students_id`, `module_students`, `module_type_id`, `module_join_students_timestamp`) VALUES
(1, 2, 30, '2022-04-19 20:50:47'),
(3, 2, 32, '2022-04-19 20:50:47');

-- --------------------------------------------------------

--
-- Table structure for table `module_price`
--

CREATE TABLE `module_price` (
  `module_price_id` int(11) NOT NULL,
  `module_class_id` int(11) NOT NULL,
  `modules_id` int(11) NOT NULL,
  `module_price` varchar(9) NOT NULL,
  `module_price_timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `module_price`
--

INSERT INTO `module_price` (`module_price_id`, `module_class_id`, `modules_id`, `module_price`, `module_price_timestamp`) VALUES
(24, 4, 30, '6000', '2022-04-21 13:07:46'),
(25, 5, 30, '5000', '2022-04-22 01:08:21'),
(26, 4, 32, '1000', '2022-04-22 01:15:21'),
(27, 5, 32, '1000', '2022-04-22 01:15:21');

-- --------------------------------------------------------

--
-- Table structure for table `primary_class_subjects`
--

CREATE TABLE `primary_class_subjects` (
  `primary_class_subjects_id` int(11) NOT NULL,
  `primary_class_id_class` int(11) NOT NULL,
  `primary_subject_id_subject` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `primary_class_subjects`
--

INSERT INTO `primary_class_subjects` (`primary_class_subjects_id`, `primary_class_id_class`, `primary_subject_id_subject`) VALUES
(1, 2, 4),
(2, 3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `primary_payment`
--

CREATE TABLE `primary_payment` (
  `primary_payment_id` bigint(20) NOT NULL,
  `primary_payment_students_id` bigint(20) NOT NULL,
  `primary_payment_students_reference` varchar(20) NOT NULL,
  `primary_payment_term` varchar(20) NOT NULL,
  `primary_payment_session` varchar(10) NOT NULL,
  `primary_payment_fees` varchar(10) NOT NULL,
  `primary_payment_paid_percent` varchar(3) NOT NULL,
  `primary_payment_completion_status` int(1) NOT NULL DEFAULT 0,
  `primary_payment_timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `primary_payment`
--

INSERT INTO `primary_payment` (`primary_payment_id`, `primary_payment_students_id`, `primary_payment_students_reference`, `primary_payment_term`, `primary_payment_session`, `primary_payment_fees`, `primary_payment_paid_percent`, `primary_payment_completion_status`, `primary_payment_timestamp`) VALUES
(1, 2, '4er5t6ywer', 'Third term', '2001/2002', '40000', '70', 0, '2022-04-22 11:58:40'),
(2, 3, 'sew345rfg5', 'Third term', '2001/2002', '40000', '50', 0, '2022-04-22 11:58:45');

-- --------------------------------------------------------

--
-- Table structure for table `primary_result`
--

CREATE TABLE `primary_result` (
  `primary_result_id` int(11) NOT NULL,
  `primary_result_class_id` int(11) NOT NULL,
  `primary_result_upload_filename` varchar(255) NOT NULL,
  `primary_result_upload_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `primary_result`
--

INSERT INTO `primary_result` (`primary_result_id`, `primary_result_class_id`, `primary_result_upload_filename`, `primary_result_upload_name`) VALUES
(1, 3, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `primary_school_classes`
--

CREATE TABLE `primary_school_classes` (
  `primary_class_id` int(1) NOT NULL,
  `primary_class` varchar(20) NOT NULL,
  `primary_class_fees` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `primary_school_classes`
--

INSERT INTO `primary_school_classes` (`primary_class_id`, `primary_class`, `primary_class_fees`) VALUES
(1, 'Basic one', '20000'),
(2, 'Basic two', '30000'),
(3, 'Basic three', '40000'),
(4, 'Basic four', '50000'),
(5, 'Basic five', '60000'),
(6, 'Basic six', '70000');

-- --------------------------------------------------------

--
-- Table structure for table `primary_school_exam`
--

CREATE TABLE `primary_school_exam` (
  `primary_school_exam_id` bigint(20) NOT NULL,
  `primary_school_exam_year` varchar(4) NOT NULL,
  `primary_school_session` varchar(11) NOT NULL,
  `primary_school_exam_class_id` int(11) NOT NULL,
  `primary_school_exam_timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `primary_school_students`
--

CREATE TABLE `primary_school_students` (
  `primary_id` int(11) NOT NULL,
  `pri_active_email` int(1) NOT NULL DEFAULT 0,
  `pri_active` varchar(1) NOT NULL DEFAULT '0',
  `pri_paid` int(1) NOT NULL DEFAULT 0,
  `pri_admit` int(1) NOT NULL DEFAULT 0,
  `pri_class_id` varchar(20) NOT NULL,
  `pri_school_term` varchar(20) NOT NULL DEFAULT 'choose term',
  `pri_year` varchar(15) NOT NULL,
  `pri_firstname` varchar(20) NOT NULL,
  `pri_surname` varchar(20) NOT NULL,
  `pri_age` varchar(2) NOT NULL,
  `pri_sex` varchar(6) NOT NULL,
  `pri_email` varchar(255) NOT NULL,
  `pri_photo` varchar(255) NOT NULL DEFAULT 'default.jpg',
  `pri_phone` varchar(11) NOT NULL,
  `pri_address` text NOT NULL,
  `pri_password` varchar(255) NOT NULL,
  `pri_email_hash` varchar(255) NOT NULL,
  `pri_cookie_session` varchar(255) NOT NULL,
  `pri_timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `primary_school_students`
--

INSERT INTO `primary_school_students` (`primary_id`, `pri_active_email`, `pri_active`, `pri_paid`, `pri_admit`, `pri_class_id`, `pri_school_term`, `pri_year`, `pri_firstname`, `pri_surname`, `pri_age`, `pri_sex`, `pri_email`, `pri_photo`, `pri_phone`, `pri_address`, `pri_password`, `pri_email_hash`, `pri_cookie_session`, `pri_timestamp`) VALUES
(1, 1, '1', 0, 0, '3', 'choose term', '2022', 'ahmed', 'olusesi', '5', 'Male', 'ola.sesi@yahoo.com', 'ab029b597c08b5f0757b4443fea3e4837d276b9a.png', '08074574512', 'Ikeja', 'password', '', '', '0000-00-00 00:00:00'),
(2, 1, '1', 1, 1, '4', 'choose term', '2022', 'Rasheed', 'Raseed', '4', 'Male', 'oosodof@yahoo.com', '4862698757bed4eada1e9a9ebe2bf84e256773db.JPG', '08074574512', 'Ogba', '', '', '', '2022-01-05 14:36:13'),
(3, 1, '1', 1, 1, '3', 'choose term', '2022', 'duro', 'media', '4', 'Male', 'dfasfds@yahoo.com', '5e8688a0fcf6dd98a52b1acafd7856d8b5fa59f6.JPG', '08074574512', 'Oshodi', '', '', '', '2022-01-05 15:01:22'),
(4, 1, '0', 1, 0, '6', 'choose term', '', 'minus', 'olusesi', '', '', 'Eligendi@enim.com', 'default.jpg', '08074574512', 'Aut ex consequatur ', '', '', '', '2022-01-06 14:47:31'),
(5, 1, '0', 1, 0, '4', 'choose term', '', 'Consequatur', 'Delectus', '', '', 'Corporis@aut.com', 'default.jpg', '08073454632', 'Corrupti dolore seq', '', '', '', '2022-01-06 14:47:31'),
(6, 1, '1', 1, 1, '6', 'choose term', '2022', 'rasheed', 'rasheed', '', '', 'rasheed@test.com', '', '08074574512', 'Ikeja', 'password', '36660e59856b4de58a219bcf4e27eba3', '', '2022-01-14 09:48:57'),
(7, 1, '1', 1, 1, '3', 'choose term', '2022', 'duro', 'duro', '3', 'Female', 'web@duromedia.com.ng', 'b3285c6aeaec1faa574de62167fdef54e268b060.JPG', '08074574512', 'Ikka', '$2y$10$ozqIlrHj3uTkKwud0nwe6u5ioKpkJ.XEvVKsM.NS1.sBAm6Y2EipW', 'd96409bf894217686ba124d7356686c9', '', '2022-02-10 09:33:26'),
(8, 1, '0', 0, 0, '3', 'choose term', '2022', 'Anita', 'Olusesi', '12', 'Female', 'olusesianita@gmail.com', 'cb157db8d214863ab316c844ceffebaa9439878c.JPG', '08074574512', 'ikeja', '$2y$10$mlgOyxryVZ2Oq2LwHz1Y3On6maurSApYe3V7raaKhbhN4PDSG2uvW', 'a8ecbabae151abacba7dbde04f761c37', '', '2022-02-13 23:47:44');

-- --------------------------------------------------------

--
-- Table structure for table `primary_subjects`
--

CREATE TABLE `primary_subjects` (
  `primary_subjects_id` int(11) NOT NULL,
  `primary_subjects_name` varchar(30) NOT NULL,
  `primary_subjects_timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `primary_subjects`
--

INSERT INTO `primary_subjects` (`primary_subjects_id`, `primary_subjects_name`, `primary_subjects_timestamp`) VALUES
(3, 'Mathematics', '2022-03-25 09:39:35'),
(4, 'French', '2022-03-25 09:39:40'),
(6, 'yoruba', '2022-04-06 12:13:20');

-- --------------------------------------------------------

--
-- Table structure for table `primary_teachers`
--

CREATE TABLE `primary_teachers` (
  `primary_teacher_id` int(11) NOT NULL,
  `primary_teacher_active` int(1) NOT NULL DEFAULT 1,
  `primary_teacher_class_id` varchar(15) NOT NULL,
  `primary_teacher_firstname` varchar(30) NOT NULL,
  `primary_teacher_surname` varchar(30) NOT NULL,
  `primary_teacher_email` varchar(255) NOT NULL,
  `primary_teacher_password` varchar(255) NOT NULL,
  `primary_teacher_sex` varchar(6) NOT NULL,
  `primary_teacher_age` int(2) NOT NULL,
  `primary_teacher_phone` varchar(11) NOT NULL,
  `primary_teacher_qualification` varchar(30) NOT NULL,
  `primary_teacher_address` varchar(255) NOT NULL,
  `primary_teacher_image` varchar(255) NOT NULL,
  `primary_teacher_cookie` varchar(255) NOT NULL,
  `primary_teacher_timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `primary_teachers`
--

INSERT INTO `primary_teachers` (`primary_teacher_id`, `primary_teacher_active`, `primary_teacher_class_id`, `primary_teacher_firstname`, `primary_teacher_surname`, `primary_teacher_email`, `primary_teacher_password`, `primary_teacher_sex`, `primary_teacher_age`, `primary_teacher_phone`, `primary_teacher_qualification`, `primary_teacher_address`, `primary_teacher_image`, `primary_teacher_cookie`, `primary_teacher_timestamp`) VALUES
(1, 1, 'Basic one', 'rahmah', 'teacher', 'ola.sesi@yahoo.com', 'password', 'Female', 27, '08074573234', 'M.sc', 'ikotun', '450f6307c6327ed088ccbf7c931026f7e439e135.jpg', '', '2022-01-08 14:11:09'),
(2, 1, 'Basic four', 'Idrees', 'Laspotech', 'pri@teacher.com', 'password', 'Male', 35, '08074574512', 'B.sc', 'Ogba', '579d8d8e6983afb313f49fd9cf987c2ffeed8a9c.jpg', '', '2022-01-10 08:32:38'),
(3, 1, 'Basic six', 'duro', 'media', 'info@doromedia.com.ng', 'password', 'Male', 55, '08074574512', 'P.hd', 'ogba', '5625a360e085f5137a58023d2a04754da349dc8d.png', '', '2022-01-23 09:51:47');

-- --------------------------------------------------------

--
-- Table structure for table `primary_test_assignment_submit`
--

CREATE TABLE `primary_test_assignment_submit` (
  `primary_test_submit_id` int(11) NOT NULL,
  `primary_test_upload_submit_name` varchar(30) NOT NULL,
  `primary_test_upload_classid` int(11) NOT NULL,
  `primary_test_upload_submit_file` varchar(255) NOT NULL,
  `primary_test_submit_timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `primary_test_assignment_submit`
--

INSERT INTO `primary_test_assignment_submit` (`primary_test_submit_id`, `primary_test_upload_submit_name`, `primary_test_upload_classid`, `primary_test_upload_submit_file`, `primary_test_submit_timestamp`) VALUES
(1, 'physics assigment', 3, '9e36664759a54b90df0c0a5837caef5fda401fa0.pdf', '2022-02-11 23:48:51'),
(2, 'english assignment', 3, 'a256a79a82eb9b8474f6444ebb252bfb4087ce94.pdf', '2022-02-11 11:47:10');

-- --------------------------------------------------------

--
-- Table structure for table `primary_test_assignment_upload`
--

CREATE TABLE `primary_test_assignment_upload` (
  `primary_test_upload_id` int(11) NOT NULL,
  `primary_test_upload_class_status` varchar(6) NOT NULL DEFAULT 'Open',
  `primary_test_upload_class_id` varchar(20) NOT NULL,
  `primary_test_upload_filename` varchar(255) NOT NULL,
  `primary_test_upload_testname` varchar(255) NOT NULL,
  `primary_test_upload_timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `primary_test_assignment_upload`
--

INSERT INTO `primary_test_assignment_upload` (`primary_test_upload_id`, `primary_test_upload_class_status`, `primary_test_upload_class_id`, `primary_test_upload_filename`, `primary_test_upload_testname`, `primary_test_upload_timestamp`) VALUES
(1, 'Open', '4', 'b01fb76031540ff97c259f3fbc0c4a4bf570d203.pdf', '453bf74dbd41', '2022-02-11 10:43:03'),
(2, 'Close', '3', 'b01fb76031540ff97c259f3fbc0c4a4bf570d203.pdf', '07c3c38c34d4b4', '2022-03-02 17:05:10'),
(3, 'Close', '3', 'b01fb76031540ff97c259f3fbc0c4a4bf570d203.pdf', 'ffgdfgdfg.pdf', '2022-02-11 10:43:19'),
(4, 'Close', '3', 'b01fb76031540ff97c259f3fbc0c4a4bf570d203.pdf', 'physics', '2022-02-11 10:43:27'),
(5, 'Open', '3', 'b01fb76031540ff97c259f3fbc0c4a4bf570d203.pdf', 'maths', '2022-02-08 09:44:03');

-- --------------------------------------------------------

--
-- Table structure for table `prospective_students`
--

CREATE TABLE `prospective_students` (
  `prospective_id` int(11) NOT NULL,
  `email_active` int(1) NOT NULL DEFAULT 0,
  `firstname` varchar(20) NOT NULL,
  `surname` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email_hash` text NOT NULL,
  `email_confirm` int(1) NOT NULL DEFAULT 0,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `prospective_students`
--

INSERT INTO `prospective_students` (`prospective_id`, `email_active`, `firstname`, `surname`, `email`, `phone`, `password`, `email_hash`, `email_confirm`, `timestamp`) VALUES
(5, 0, 'Chadwick', 'Griffin', 'funigo@mailinator.com', '08074574512', '$2y$10$mwbCH2NlXrthJkFZBnsqdu1Kzw1/2AUMPSlj83EM5v30WR950xsw6', '1aa48fc4880bb0c9b8a3bf979d3b917e', 0, '2021-12-21 10:51:01'),
(6, 0, 'Sybil', 'Key', 'wolodaboc@mailinator.com', '08074574512', '$2y$10$xz1Yfvoc8rfD5utqH7Cmge.nxRRtmkEkxzs1AJ7zM6Yr7oZ3jFjLW', 'eccbc87e4b5ce2fe28308fd9f2a7baf3', 0, '2021-12-21 10:59:10');

-- --------------------------------------------------------

--
-- Table structure for table `secondary_activities_confirm`
--

CREATE TABLE `secondary_activities_confirm` (
  `secondary_activities_confirm_id` int(11) NOT NULL,
  `primary_activities_confirmation` int(1) NOT NULL,
  `primary_activities_students` int(11) NOT NULL,
  `primary_activities_timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `secondary_activities_payment`
--

CREATE TABLE `secondary_activities_payment` (
  `secondary_activities_payment_id` int(11) NOT NULL,
  `primary_activities_payment_name` varchar(50) CHARACTER SET utf8mb4 NOT NULL,
  `primary_activities_payment_price` varchar(11) CHARACTER SET utf8mb4 NOT NULL,
  `primary_activities_payment_deadline` varchar(30) CHARACTER SET utf8mb4 NOT NULL,
  `primary_activities_payment_timestamp` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `secondary_class_subjects`
--

CREATE TABLE `secondary_class_subjects` (
  `secondary_class_subjects_id` int(11) NOT NULL,
  `secondary_class_id_class` int(11) NOT NULL,
  `secondary_subject_id_subject` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `secondary_common_e`
--

CREATE TABLE `secondary_common_e` (
  `secondary_common_e_id` int(11) NOT NULL,
  `secondary_common_e_students_id` int(11) NOT NULL,
  `secondary_common_e_exam` int(1) NOT NULL DEFAULT 0,
  `secondary_common_e_timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `secondary_common_e`
--

INSERT INTO `secondary_common_e` (`secondary_common_e_id`, `secondary_common_e_students_id`, `secondary_common_e_exam`, `secondary_common_e_timestamp`) VALUES
(1, 1, 0, '2022-04-24 18:14:26'),
(2, 2, 0, '2022-04-24 18:14:26');

-- --------------------------------------------------------

--
-- Table structure for table `secondary_modules`
--

CREATE TABLE `secondary_modules` (
  `secondary_module_id` int(11) NOT NULL,
  `secondary_module_type` varchar(50) NOT NULL,
  `secondary_module_start_date` varchar(11) NOT NULL,
  `secondary_module_end_date` varchar(11) NOT NULL,
  `secondary_module_session` varchar(10) NOT NULL,
  `secondary_module_term` varchar(15) NOT NULL,
  `secondary_module_timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `secondary_modules`
--

INSERT INTO `secondary_modules` (`secondary_module_id`, `secondary_module_type`, `secondary_module_start_date`, `secondary_module_end_date`, `secondary_module_session`, `secondary_module_term`, `secondary_module_timestamp`) VALUES
(30, 'swimming lesson', '2022-04-23', '2022-04-27', '2001/2002', 'Second term', '2022-04-21 13:01:39'),
(32, 'Field trip', '2022-04-23', '2022-04-24', '2001/2002', 'Second term', '2022-04-22 00:46:34');

-- --------------------------------------------------------

--
-- Table structure for table `secondary_module_join_students`
--

CREATE TABLE `secondary_module_join_students` (
  `secondary_module_join_students_id` int(11) NOT NULL,
  `secondary_module_students` int(11) NOT NULL,
  `secondary_module_type_id` int(11) NOT NULL,
  `secondary_module_join_students_timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `secondary_module_join_students`
--

INSERT INTO `secondary_module_join_students` (`secondary_module_join_students_id`, `secondary_module_students`, `secondary_module_type_id`, `secondary_module_join_students_timestamp`) VALUES
(1, 2, 30, '2022-04-19 20:50:47'),
(3, 2, 32, '2022-04-19 20:50:47');

-- --------------------------------------------------------

--
-- Table structure for table `secondary_payment`
--

CREATE TABLE `secondary_payment` (
  `secondary_payment_id` bigint(20) NOT NULL,
  `secondary_payment_students_id` bigint(20) NOT NULL,
  `secondary_payment_students_reference` varchar(20) CHARACTER SET utf8mb4 NOT NULL,
  `secondary_payment_term` varchar(20) CHARACTER SET utf8mb4 NOT NULL,
  `secondary_payment_session` varchar(10) CHARACTER SET utf8mb4 NOT NULL,
  `secondary_payment_fees` varchar(10) CHARACTER SET utf8mb4 NOT NULL,
  `secondary_payment_paid_percent` int(3) NOT NULL,
  `secondary_payment_completion_status` int(1) NOT NULL DEFAULT 0,
  `secondary_payment_timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `secondary_payment`
--

INSERT INTO `secondary_payment` (`secondary_payment_id`, `secondary_payment_students_id`, `secondary_payment_students_reference`, `secondary_payment_term`, `secondary_payment_session`, `secondary_payment_fees`, `secondary_payment_paid_percent`, `secondary_payment_completion_status`, `secondary_payment_timestamp`) VALUES
(1, 1, 'sawd345fds', 'Second term', '2001/2002', '6000', 50, 0, '2022-04-23 05:35:20'),
(2, 2, 'sawd3d5fds', 'Second term', '2001/2002', '6000', 50, 0, '2022-04-23 05:40:57');

-- --------------------------------------------------------

--
-- Table structure for table `secondary_result`
--

CREATE TABLE `secondary_result` (
  `secondary_result_id` int(11) NOT NULL,
  `secondary_result_class_id` int(11) NOT NULL,
  `secondary_result_upload_filename` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `secondary_result_upload_name` varchar(30) CHARACTER SET utf8mb4 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `secondary_school_classes`
--

CREATE TABLE `secondary_school_classes` (
  `secondary_class_id` int(1) NOT NULL,
  `secondary_class` varchar(10) NOT NULL,
  `secondary_class_fees` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `secondary_school_classes`
--

INSERT INTO `secondary_school_classes` (`secondary_class_id`, `secondary_class`, `secondary_class_fees`) VALUES
(1, 'JSS 1', '40000'),
(2, 'JSS 2', '40000'),
(3, 'JSS 3', '45000'),
(4, 'SSS 1', '47000'),
(5, 'SSS 2', '47000'),
(6, 'SSS 3', '75000');

-- --------------------------------------------------------

--
-- Table structure for table `secondary_school_exam`
--

CREATE TABLE `secondary_school_exam` (
  `secondary_school_exam_id` bigint(20) NOT NULL,
  `secondary_school_exam_year` varchar(4) NOT NULL,
  `secondary_school_session` varchar(11) NOT NULL,
  `secondary_school_exam_class_id` int(11) NOT NULL,
  `secondary_school_exam_timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `secondary_school_students`
--

CREATE TABLE `secondary_school_students` (
  `secondary_id` int(11) NOT NULL,
  `sec_active_email` int(1) NOT NULL DEFAULT 0,
  `sec_active` varchar(6) NOT NULL DEFAULT '0',
  `sec_paid` int(1) NOT NULL DEFAULT 0,
  `sec_admit` int(1) NOT NULL DEFAULT 0,
  `sec_class_id` int(1) NOT NULL,
  `sec_school_term` varchar(20) NOT NULL DEFAULT 'choose term',
  `sec_year` varchar(15) NOT NULL,
  `sec_firstname` varchar(20) NOT NULL,
  `sec_surname` varchar(20) NOT NULL,
  `sec_age` varchar(2) NOT NULL,
  `sec_sex` varchar(6) NOT NULL,
  `sec_email` varchar(255) NOT NULL,
  `sec_photo` varchar(255) NOT NULL DEFAULT 'default.jpg',
  `sec_phone` varchar(11) NOT NULL,
  `sec_address` text NOT NULL,
  `sec_password` varchar(255) NOT NULL,
  `sec_email_hash` varchar(255) NOT NULL,
  `sec_cookie_session` varchar(255) NOT NULL,
  `sec_timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `secondary_school_students`
--

INSERT INTO `secondary_school_students` (`secondary_id`, `sec_active_email`, `sec_active`, `sec_paid`, `sec_admit`, `sec_class_id`, `sec_school_term`, `sec_year`, `sec_firstname`, `sec_surname`, `sec_age`, `sec_sex`, `sec_email`, `sec_photo`, `sec_phone`, `sec_address`, `sec_password`, `sec_email_hash`, `sec_cookie_session`, `sec_timestamp`) VALUES
(1, 1, '0', 0, 0, 1, 'Second term', '2001/2002', 'aaliyah', 'olusesi', '', '', 'aaliyaholusesi@gmail.com', '', '08074574512', '', '$2y$10$ECHenBkEy/S0v.laQCnsq.XdDxG9MyiEMGtCMkLLZPqqgwpJjYXU2', '41f1f19176d383480afa65d325c06ed0', '', '2022-04-22 15:44:48'),
(2, 1, '0', 0, 0, 3, 'Second term', '2001/2002', 'ahmed', 'olusesi', '', 'Male', 'olusesia@gmail.com', 'default.jpg', '08074574512', '', '', '', '', '2022-04-22 14:19:24'),
(3, 1, '0', 0, 0, 0, 'Third term', '2022/2023', 'anita', 'olusesi', '23', 'Male', 'olusesia@gmail.com', 'ae84f7205042cfa66705bd5ab3e17ec5879bdcfd.jpg', '08074574512', 'Ikeja', '', '', '', '2022-04-22 14:19:24');

-- --------------------------------------------------------

--
-- Table structure for table `secondary_subject`
--

CREATE TABLE `secondary_subject` (
  `secondary_subjects_id` int(11) NOT NULL,
  `secondary_subjects_name` varchar(30) CHARACTER SET utf8mb4 NOT NULL,
  `secondary_subjects_timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `secondary_teachers`
--

CREATE TABLE `secondary_teachers` (
  `secondary_teacher_id` int(11) NOT NULL,
  `secondary_teacher_active` int(1) NOT NULL DEFAULT 1,
  `secondary_teacher_class_id` int(15) NOT NULL,
  `secondary_teacher_firstname` varchar(30) NOT NULL,
  `secondary_teacher_surname` varchar(30) NOT NULL,
  `secondary_teacher_email` varchar(255) NOT NULL,
  `secondary_teacher_password` varchar(255) NOT NULL,
  `secondary_teacher_sex` varchar(6) NOT NULL,
  `primary_teacher_age` int(2) NOT NULL,
  `primary_teacher_phone` varchar(11) NOT NULL,
  `secondary_teacher_qualification` varchar(30) NOT NULL,
  `secondary_teacher_address` varchar(255) NOT NULL,
  `secondary_teacher_image` varchar(255) NOT NULL,
  `secondary_teacher_cookie` varchar(255) NOT NULL,
  `secondary_teacher_timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `secondary_test_assignment_submit`
--

CREATE TABLE `secondary_test_assignment_submit` (
  `secondary_test_submit_id` int(11) NOT NULL,
  `secondary_test_upload_submit_name` varchar(30) CHARACTER SET utf8mb4 NOT NULL,
  `secondary_test_upload_classid` int(11) NOT NULL,
  `secondary_test_upload_submit_file` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `secondary_test_submit_timestamp` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `secondary_test_assignment_upload`
--

CREATE TABLE `secondary_test_assignment_upload` (
  `secondary_test_upload_id` int(11) NOT NULL,
  `secondary_test_upload_class_status` varchar(6) CHARACTER SET utf8mb4 NOT NULL DEFAULT 'Open',
  `secondary_test_upload_class_id` varchar(20) CHARACTER SET utf8mb4 NOT NULL,
  `secondary_test_upload_filename` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `secondary_test_upload_testname` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `secondary_test_upload_timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sec_total_number`
--

CREATE TABLE `sec_total_number` (
  `sec_total_number_id` int(11) NOT NULL,
  `sec_school_popu` int(11) NOT NULL,
  `sec_total_number_term` varchar(15) CHARACTER SET utf8mb4 NOT NULL,
  `sec_total_number_year` varchar(15) CHARACTER SET utf8mb4 NOT NULL,
  `sec_total_number_timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `super_admin`
--

CREATE TABLE `super_admin` (
  `super_id` tinyint(1) NOT NULL,
  `super_active` tinyint(1) NOT NULL DEFAULT 0,
  `super_firstname` varchar(20) NOT NULL,
  `super_lastname` varchar(20) NOT NULL,
  `super_email` varchar(225) NOT NULL,
  `super_password` varchar(255) NOT NULL,
  `super_cookie_session` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `term_start_end`
--

CREATE TABLE `term_start_end` (
  `term_start_end_id` int(11) NOT NULL,
  `choose_term` varchar(20) NOT NULL,
  `term_start` varchar(255) NOT NULL,
  `term_end` varchar(255) NOT NULL,
  `term_timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `school_session` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `term_start_end`
--

INSERT INTO `term_start_end` (`term_start_end_id`, `choose_term`, `term_start`, `term_end`, `term_timestamp`, `school_session`) VALUES
(36, 'First term', '2022-02-12 14:00:49', '2022-02-12 14:01:31', '2022-02-12 14:00:49', '2001/2002'),
(37, 'Second term', '2022-03-22 15:50:36', '2022-03-22 15:51:33', '2022-03-22 15:50:36', '2001/2002'),
(38, 'Third term', '2022-03-22 16:33:18', '2022-03-22 16:34:24', '2022-03-22 16:33:18', '2001/2002'),
(39, 'Second term', '2022-03-24 11:56:29', '2022-03-24 11:58:22', '2022-03-24 11:56:29', '2001/2002'),
(44, 'Third term', '2022-04-24 06:58:35', '2022-04-24 08:10:29', '2022-04-24 06:58:35', '2022/2023'),
(45, 'First term', '2022-04-25 13:00:37', '', '2022-04-25 13:00:37', '2000/2001');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`module_id`);

--
-- Indexes for table `module_join_students`
--
ALTER TABLE `module_join_students`
  ADD PRIMARY KEY (`module_join_students_id`);

--
-- Indexes for table `module_price`
--
ALTER TABLE `module_price`
  ADD PRIMARY KEY (`module_price_id`);

--
-- Indexes for table `primary_class_subjects`
--
ALTER TABLE `primary_class_subjects`
  ADD PRIMARY KEY (`primary_class_subjects_id`);

--
-- Indexes for table `primary_payment`
--
ALTER TABLE `primary_payment`
  ADD PRIMARY KEY (`primary_payment_id`);

--
-- Indexes for table `primary_school_classes`
--
ALTER TABLE `primary_school_classes`
  ADD PRIMARY KEY (`primary_class_id`);

--
-- Indexes for table `primary_school_students`
--
ALTER TABLE `primary_school_students`
  ADD PRIMARY KEY (`primary_id`);

--
-- Indexes for table `primary_subjects`
--
ALTER TABLE `primary_subjects`
  ADD PRIMARY KEY (`primary_subjects_id`);

--
-- Indexes for table `primary_teachers`
--
ALTER TABLE `primary_teachers`
  ADD PRIMARY KEY (`primary_teacher_id`);

--
-- Indexes for table `secondary_common_e`
--
ALTER TABLE `secondary_common_e`
  ADD PRIMARY KEY (`secondary_common_e_id`);

--
-- Indexes for table `secondary_modules`
--
ALTER TABLE `secondary_modules`
  ADD PRIMARY KEY (`secondary_module_id`);

--
-- Indexes for table `secondary_module_join_students`
--
ALTER TABLE `secondary_module_join_students`
  ADD PRIMARY KEY (`secondary_module_join_students_id`);

--
-- Indexes for table `secondary_payment`
--
ALTER TABLE `secondary_payment`
  ADD PRIMARY KEY (`secondary_payment_id`);

--
-- Indexes for table `secondary_school_classes`
--
ALTER TABLE `secondary_school_classes`
  ADD PRIMARY KEY (`secondary_class_id`);

--
-- Indexes for table `secondary_school_students`
--
ALTER TABLE `secondary_school_students`
  ADD PRIMARY KEY (`secondary_id`);

--
-- Indexes for table `term_start_end`
--
ALTER TABLE `term_start_end`
  ADD PRIMARY KEY (`term_start_end_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `module_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `module_join_students`
--
ALTER TABLE `module_join_students`
  MODIFY `module_join_students_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `module_price`
--
ALTER TABLE `module_price`
  MODIFY `module_price_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `primary_class_subjects`
--
ALTER TABLE `primary_class_subjects`
  MODIFY `primary_class_subjects_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `primary_school_students`
--
ALTER TABLE `primary_school_students`
  MODIFY `primary_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `secondary_common_e`
--
ALTER TABLE `secondary_common_e`
  MODIFY `secondary_common_e_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `secondary_modules`
--
ALTER TABLE `secondary_modules`
  MODIFY `secondary_module_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `secondary_module_join_students`
--
ALTER TABLE `secondary_module_join_students`
  MODIFY `secondary_module_join_students_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `term_start_end`
--
ALTER TABLE `term_start_end`
  MODIFY `term_start_end_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
