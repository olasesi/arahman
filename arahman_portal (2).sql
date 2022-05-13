-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 13, 2022 at 07:04 PM
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
(3, 1, 'admission', 'seye', 'alade', 'admission', '5f4dcc3b5aa765d61d8327deb882cf99', '404da2ec431e12a65ec464e08d141f22', '2022-04-06 14:28:14'),
(4, 1, 'accountant', 'teni', 'alade', 'accountant', '5f4dcc3b5aa765d61d8327deb882cf99', '8e3d4713559bb15bc9db170ade55dc34', '2022-04-06 14:28:14'),
(5, 1, 'principal', 'anita', 'anita', 'principal', '5f4dcc3b5aa765d61d8327deb882cf99', '7c58329d9930c51ec1dbd671f0060523', '2022-04-06 14:28:14');

-- --------------------------------------------------------

--
-- Table structure for table `admin_owner`
--

CREATE TABLE `admin_owner` (
  `admin_owner_id` int(11) NOT NULL,
  `admin_pay_reg_toggle` varchar(5) NOT NULL DEFAULT 'close',
  `admin_toggle_timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_owner`
--

INSERT INTO `admin_owner` (`admin_owner_id`, `admin_pay_reg_toggle`, `admin_toggle_timestamp`) VALUES
(1, 'close', '2022-04-26 14:16:58');

-- --------------------------------------------------------

--
-- Table structure for table `admin_registration`
--

CREATE TABLE `admin_registration` (
  `admin_reg_id` int(11) NOT NULL,
  `admin_reg_status` varchar(5) NOT NULL DEFAULT 'close',
  `admin_reg_timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_registration`
--

INSERT INTO `admin_registration` (`admin_reg_id`, `admin_reg_status`, `admin_reg_timestamp`) VALUES
(1, 'open', '2022-04-29 16:11:06');

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
(6, 'swimming lesson 2', '2022-05-03', '2022-05-20', '2002/2003', 'First term', '2022-05-05 04:29:06'),
(7, 'Vacation', '2022-05-10', '2022-05-21', '2003/2004', 'Third term', '2022-05-06 08:41:10'),
(8, 'Field trip', '2022-05-03', '2022-05-27', '2003/2004', 'Third term', '2022-05-06 08:41:59');

-- --------------------------------------------------------

--
-- Table structure for table `module_join_students`
--

CREATE TABLE `module_join_students` (
  `module_join_students_id` int(11) NOT NULL,
  `module_students` int(11) NOT NULL,
  `module_type_id` int(11) NOT NULL,
  `module_reference` varchar(20) NOT NULL,
  `module_status` int(1) NOT NULL DEFAULT 0,
  `module_join_students_timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(4, 1, 6, '5000', '2022-05-05 04:29:37'),
(5, 4, 6, '5000', '2022-05-05 04:29:37'),
(6, 6, 6, '5000', '2022-05-05 04:29:37'),
(7, 6, 7, '6000', '2022-05-06 08:41:40'),
(8, 6, 8, '25000', '2022-05-06 08:42:18');

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
(1, 6, 3),
(2, 6, 4),
(3, 1, 3),
(4, 1, 4);

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
(1, 1, 'BGASUQ2JG331TE7', 'First term', '2002/2003', '60000', '100', 1, '2022-05-06 11:36:57');

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
(1, 'Basic one', '1000'),
(2, 'Basic two', '2000'),
(3, 'Basic three', '3000'),
(4, 'Basic four', '4000'),
(5, 'Basic five', '5000'),
(6, 'Basic six', '6000');

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
  `pri_active` varchar(1) NOT NULL DEFAULT '1',
  `pri_paid` int(1) NOT NULL DEFAULT 0,
  `pri_admit` int(1) NOT NULL DEFAULT 0,
  `pri_class_id` varchar(15) NOT NULL DEFAULT '0',
  `pri_school_term` varchar(20) NOT NULL DEFAULT 'First term',
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
(1, 1, '1', 1, 1, '6', 'First term', '2002/2003', 'Ahmed', 'Olusesi', '10', 'Male', 'ola.sesi@yahoo.com', '168a861a99e57184f04b4d970cdb6b3b3e7ce98a.jpg', '08074574512', 'ikeja', '$2y$10$NfioCaRaCr4ElMXrxExXge6XOJylKMuVuX9xzsRtZjXi5vFwxtqvy', '43feaeeecd7b2fe2ae2e26d917b6477d', '922ce2de4527814c6d982e38259d9aa2', '2022-05-02 21:34:40'),
(2, 1, '1', 1, 1, '6', 'First term', '2002/2003', 'duro', 'media', '', '', 'info@doromedia.com.ng', '', '08074574512', '', '$2y$10$Lakve5E.JwXN1R7bqmFrw.BoZDj4U.KLQIUjUSL48Oiu3v9S5LpCu', 'a5771bce93e200c36f7cd9dfd0e5deaa', '', '2022-05-03 20:14:42'),
(3, 1, '1', 0, 0, '0', '', '', 'eniola', 'Olusesi', '', '', 'eniola@gmail.com', '', '08074574512', '', '$2y$10$G5gS8AcFYBNcZ3.6auwRfO0GqitumF9gqX8rNfr36Mv3HPBgV37zu', 'a01a0380ca3c61428c26a231f0e49a09', '', '2022-05-03 23:22:19');

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
(1, 1, '3', 'rahmah', 'teacher', 'ola.sesi@yahoo.com', 'password', 'Female', 27, '08074573234', 'M.sc', 'ikotun', '450f6307c6327ed088ccbf7c931026f7e439e135.jpg', '', '2022-01-08 14:11:09'),
(2, 1, '5', 'Idrees', 'Laspotech', 'pri@teacher.com', 'password', 'Male', 35, '08074574512', 'B.sc', 'Ogba', '579d8d8e6983afb313f49fd9cf987c2ffeed8a9c.jpg', '', '2022-01-10 08:32:38'),
(3, 1, '5', 'duro', 'media', 'info@doromedia.com.ng', 'password', 'Male', 55, '08074574512', 'P.hd', 'ogba', '5625a360e085f5137a58023d2a04754da349dc8d.png', '', '2022-01-23 09:51:47');

-- --------------------------------------------------------

--
-- Table structure for table `primary_test_assignment_submit`
--

CREATE TABLE `primary_test_assignment_submit` (
  `primary_test_submit_id` int(11) NOT NULL,
  `primary_test_upload_submit_name` varchar(30) NOT NULL,
  `primary_test_upload_classid` int(11) NOT NULL,
  `primary_test_upload_pri_id` int(11) NOT NULL,
  `primary_test_upload_submit_file` varchar(255) NOT NULL,
  `primary_test_submit_timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `primary_test_assignment_submit`
--

INSERT INTO `primary_test_assignment_submit` (`primary_test_submit_id`, `primary_test_upload_submit_name`, `primary_test_upload_classid`, `primary_test_upload_pri_id`, `primary_test_upload_submit_file`, `primary_test_submit_timestamp`) VALUES
(1, 'physics assigment', 3, 0, '9e36664759a54b90df0c0a5837caef5fda401fa0.pdf', '2022-02-11 23:48:51'),
(2, 'english assignment', 3, 0, 'a256a79a82eb9b8474f6444ebb252bfb4087ce94.pdf', '2022-02-11 11:47:10'),
(3, 'My assignment', 6, 1, 'ebacb2fe16170dc88d8634a27864d89fdc5c0289.pdf', '2022-05-07 01:07:41'),
(6, 'Social studies assignment', 6, 1, 'b01f393fae6ec4ef245aa4945a60b908d271a25c.pdf', '2022-05-07 22:16:07');

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
(5, 'Open', '3', 'b01fb76031540ff97c259f3fbc0c4a4bf570d203.pdf', 'maths', '2022-02-08 09:44:03'),
(6, 'Open', '6', 'fd8258372e001fa5d3c5a381b130330b69ae9566.pdf', 'Maths assignments', '2022-05-07 00:09:03'),
(8, 'Close', '6', '5cbadea6c6801bc34aa95a81ec52aee261c52902.pdf', 'english assignment', '2022-05-07 00:13:15'),
(14, 'Open', '6', '9d0b3ff8d9486e09c0424734a70b845c9b5721d9.pdf', 'physics', '2022-05-07 00:45:31');

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

--
-- Dumping data for table `secondary_class_subjects`
--

INSERT INTO `secondary_class_subjects` (`secondary_class_subjects_id`, `secondary_class_id_class`, `secondary_subject_id_subject`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 3, 4),
(4, 3, 2),
(5, 5, 4);

-- --------------------------------------------------------

--
-- Table structure for table `secondary_common_e`
--

CREATE TABLE `secondary_common_e` (
  `secondary_common_e_id` int(11) NOT NULL,
  `secondary_common_e_students_id` int(11) NOT NULL,
  `secondary_common_e_session` varchar(10) NOT NULL,
  `secondary_common_e_price` varchar(9) NOT NULL,
  `secondary_common_e_reference` varchar(20) NOT NULL,
  `secondary_common_e_status` int(1) NOT NULL DEFAULT 0,
  `secondary_common_e_timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `secondary_common_e`
--

INSERT INTO `secondary_common_e` (`secondary_common_e_id`, `secondary_common_e_students_id`, `secondary_common_e_session`, `secondary_common_e_price`, `secondary_common_e_reference`, `secondary_common_e_status`, `secondary_common_e_timestamp`) VALUES
(1, 2, '2003/2004', '5000', 'QAL67UZ3D9Q9IOP', 1, '2022-05-05 11:17:41');

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
(5, 'Dubai trip', '', '', '', '', '2022-05-05 04:37:07');

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

-- --------------------------------------------------------

--
-- Table structure for table `secondary_module_price`
--

CREATE TABLE `secondary_module_price` (
  `secondary_module_price_id` int(11) NOT NULL,
  `secondary_module_class_id` int(11) NOT NULL,
  `secondary_modules_id` int(11) NOT NULL,
  `secondary_module_price` varchar(9) NOT NULL,
  `secondary_module_price_timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(1, 1, 'UZVUWALEW6V4YV6', 'First term', '2002/2003', '47000', 100, 1, '2022-05-04 13:12:37');

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
(1, 'JSS 1', '1000'),
(2, 'JSS 2', '2000'),
(3, 'JSS 3', '3000'),
(4, 'SSS 1', '4000'),
(5, 'SSS 2', '5000'),
(6, 'SSS 3', '6000');

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
  `sec_active` int(1) NOT NULL DEFAULT 1,
  `sec_paid` int(1) NOT NULL DEFAULT 0,
  `sec_admit` int(1) NOT NULL DEFAULT 0,
  `sec_class_id` varchar(15) NOT NULL DEFAULT '0',
  `sec_school_term` varchar(20) NOT NULL DEFAULT 'First term',
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
(1, 1, 1, 1, 1, '1', 'First term', '2002/2003', 'Anita', 'Olusesi', '16', 'Female', 'olusesianita@gmail.com', '7dd69d68b6e67a0eb41022ec17a4e574cb174efd.jpg', '08074574512', 'Ikeja', '$2y$10$oqetuSIdQjBleA/w/7NN5.XE3wExyJDgqJs878F.P7VXxHSIleV0O', '7380ad8a673226ae47fce7bff88e9c33', '', '2022-05-02 21:59:04'),
(2, 1, 1, 0, 1, '1', 'Third term', '2003/2004', 'saka', 'olusesi', '21', 'Male', 'saka@gmail.com', 'ee943a367f7e4508a1acf1ac3b5ec7a481d7351c.jpg', '08074574512', 'Ikeja', '$2y$10$rTsYGeK.pzhX59XScH/z5.x0tUo7S3zcuPZf5IJCn4QPJcl/TQG4K', '4c56ff4ce4aaf9573aa5dff913df997a', '', '2022-05-05 10:40:04'),
(3, 1, 1, 0, 0, '0', '', '', 'eniola', 'Olusesi', '', '', 'eniola@gmail.com', '', '08074574512', '', '$2y$10$RMMX7MZhI/2SLpeHmi.2fuacRgTF7jdmGQOF/hcfqaslhV3YNP7VW', '4734ba6f3de83d861c3176a6273cac6d', '', '2022-05-05 14:42:19');

-- --------------------------------------------------------

--
-- Table structure for table `secondary_subject`
--

CREATE TABLE `secondary_subject` (
  `secondary_subjects_id` int(11) NOT NULL,
  `secondary_subjects_name` varchar(30) CHARACTER SET utf8mb4 NOT NULL,
  `secondary_subjects_timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `secondary_subject`
--

INSERT INTO `secondary_subject` (`secondary_subjects_id`, `secondary_subjects_name`, `secondary_subjects_timestamp`) VALUES
(1, 'Mathematics', '2022-05-09 17:40:56'),
(2, 'English', '2022-05-09 17:40:56'),
(4, 'Economics', '2022-05-12 19:26:07');

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
  `secondary_teacher_age` int(2) NOT NULL,
  `secondary_teacher_phone` varchar(11) NOT NULL,
  `secondary_teacher_qualification` varchar(30) NOT NULL,
  `secondary_teacher_address` varchar(255) NOT NULL,
  `secondary_teacher_image` varchar(255) NOT NULL,
  `secondary_teacher_cookie` varchar(255) NOT NULL,
  `secondary_teacher_timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `secondary_teachers`
--

INSERT INTO `secondary_teachers` (`secondary_teacher_id`, `secondary_teacher_active`, `secondary_teacher_class_id`, `secondary_teacher_firstname`, `secondary_teacher_surname`, `secondary_teacher_email`, `secondary_teacher_password`, `secondary_teacher_sex`, `secondary_teacher_age`, `secondary_teacher_phone`, `secondary_teacher_qualification`, `secondary_teacher_address`, `secondary_teacher_image`, `secondary_teacher_cookie`, `secondary_teacher_timestamp`) VALUES
(1, 1, 6, 'aaliyah', 'olusesi', 'olusesiaaliyah@gmail.com', 'password', 'Female', 22, '08074574512', 'P.hd', 'ikeja', '', '', '2022-05-09 13:23:35');

-- --------------------------------------------------------

--
-- Table structure for table `secondary_test_assignment_submit`
--

CREATE TABLE `secondary_test_assignment_submit` (
  `secondary_test_submit_id` int(11) NOT NULL,
  `secondary_test_upload_submit_name` varchar(30) CHARACTER SET utf8mb4 NOT NULL,
  `secondary_test_upload_classid` int(11) NOT NULL,
  `secondary_test_upload_pri_id` int(11) NOT NULL,
  `secondary_test_upload_submit_file` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `secondary_test_submit_timestamp` timestamp NOT NULL DEFAULT current_timestamp()
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

--
-- Dumping data for table `secondary_test_assignment_upload`
--

INSERT INTO `secondary_test_assignment_upload` (`secondary_test_upload_id`, `secondary_test_upload_class_status`, `secondary_test_upload_class_id`, `secondary_test_upload_filename`, `secondary_test_upload_testname`, `secondary_test_upload_timestamp`) VALUES
(2, 'Open', '1', '626e44c7cb5136c93385fde1633c1e3638ce9908.pdf', 'secondary english', '2022-05-09 18:08:37'),
(3, 'Open', '1', '39891de42067b74d47c50d428c6fdab14fff8a81.pdf', 'maths 2', '2022-05-09 18:16:58');

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
(1, 'First term', '2022-05-02 20:04:45', '2022-05-02 21:32:00', '2022-05-02 20:04:45', '2000/2001'),
(2, 'Third term', '2022-05-02 21:32:55', '2022-05-02 21:33:30', '2022-05-02 21:32:55', '2001/2002'),
(3, 'First term', '2022-05-04 08:39:37', '2022-05-05 10:33:58', '2022-05-04 08:39:37', '2002/2003'),
(4, 'Third term', '2022-05-05 10:37:25', '2022-05-05 10:37:51', '2022-05-05 10:37:25', '2003/2004');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `admin_owner`
--
ALTER TABLE `admin_owner`
  ADD PRIMARY KEY (`admin_owner_id`);

--
-- Indexes for table `admin_registration`
--
ALTER TABLE `admin_registration`
  ADD PRIMARY KEY (`admin_reg_id`);

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
-- Indexes for table `primary_test_assignment_submit`
--
ALTER TABLE `primary_test_assignment_submit`
  ADD PRIMARY KEY (`primary_test_submit_id`);

--
-- Indexes for table `primary_test_assignment_upload`
--
ALTER TABLE `primary_test_assignment_upload`
  ADD PRIMARY KEY (`primary_test_upload_id`);

--
-- Indexes for table `secondary_class_subjects`
--
ALTER TABLE `secondary_class_subjects`
  ADD PRIMARY KEY (`secondary_class_subjects_id`);

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
-- Indexes for table `secondary_module_price`
--
ALTER TABLE `secondary_module_price`
  ADD PRIMARY KEY (`secondary_module_price_id`);

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
-- Indexes for table `secondary_subject`
--
ALTER TABLE `secondary_subject`
  ADD PRIMARY KEY (`secondary_subjects_id`);

--
-- Indexes for table `secondary_teachers`
--
ALTER TABLE `secondary_teachers`
  ADD PRIMARY KEY (`secondary_teacher_id`);

--
-- Indexes for table `secondary_test_assignment_upload`
--
ALTER TABLE `secondary_test_assignment_upload`
  ADD PRIMARY KEY (`secondary_test_upload_id`);

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
-- AUTO_INCREMENT for table `admin_owner`
--
ALTER TABLE `admin_owner`
  MODIFY `admin_owner_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admin_registration`
--
ALTER TABLE `admin_registration`
  MODIFY `admin_reg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `module_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `module_join_students`
--
ALTER TABLE `module_join_students`
  MODIFY `module_join_students_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `module_price`
--
ALTER TABLE `module_price`
  MODIFY `module_price_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `primary_class_subjects`
--
ALTER TABLE `primary_class_subjects`
  MODIFY `primary_class_subjects_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `primary_payment`
--
ALTER TABLE `primary_payment`
  MODIFY `primary_payment_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `primary_school_students`
--
ALTER TABLE `primary_school_students`
  MODIFY `primary_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `primary_test_assignment_submit`
--
ALTER TABLE `primary_test_assignment_submit`
  MODIFY `primary_test_submit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `primary_test_assignment_upload`
--
ALTER TABLE `primary_test_assignment_upload`
  MODIFY `primary_test_upload_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `secondary_class_subjects`
--
ALTER TABLE `secondary_class_subjects`
  MODIFY `secondary_class_subjects_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `secondary_common_e`
--
ALTER TABLE `secondary_common_e`
  MODIFY `secondary_common_e_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `secondary_modules`
--
ALTER TABLE `secondary_modules`
  MODIFY `secondary_module_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `secondary_module_join_students`
--
ALTER TABLE `secondary_module_join_students`
  MODIFY `secondary_module_join_students_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `secondary_module_price`
--
ALTER TABLE `secondary_module_price`
  MODIFY `secondary_module_price_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `secondary_payment`
--
ALTER TABLE `secondary_payment`
  MODIFY `secondary_payment_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `secondary_school_students`
--
ALTER TABLE `secondary_school_students`
  MODIFY `secondary_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `secondary_subject`
--
ALTER TABLE `secondary_subject`
  MODIFY `secondary_subjects_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `secondary_teachers`
--
ALTER TABLE `secondary_teachers`
  MODIFY `secondary_teacher_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `secondary_test_assignment_upload`
--
ALTER TABLE `secondary_test_assignment_upload`
  MODIFY `secondary_test_upload_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `term_start_end`
--
ALTER TABLE `term_start_end`
  MODIFY `term_start_end_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
