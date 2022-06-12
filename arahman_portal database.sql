-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 13, 2022 at 01:19 AM
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
(3, 1, 'admission', 'seye', 'alade', 'admission', '5f4dcc3b5aa765d61d8327deb882cf99', '', '2022-04-06 14:28:14'),
(4, 1, 'accountant', 'teni', 'alade', 'accountant', '5f4dcc3b5aa765d61d8327deb882cf99', '', '2022-04-06 14:28:14'),
(5, 1, 'principal', 'anita', 'anita', 'principal', '5f4dcc3b5aa765d61d8327deb882cf99', '', '2022-04-06 14:28:14');

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
(1, 'open', '2022-04-26 14:16:58');

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
(1, 'close', '2022-04-29 16:11:06');

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

-- --------------------------------------------------------

--
-- Table structure for table `primary_class_subjects`
--

CREATE TABLE `primary_class_subjects` (
  `primary_class_subjects_id` int(11) NOT NULL,
  `primary_class_id_class` int(11) NOT NULL,
  `primary_subject_id_subject` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
-- Table structure for table `primary_school_classes_sub`
--

CREATE TABLE `primary_school_classes_sub` (
  `primary_school_classes_sub_id` int(11) NOT NULL,
  `primary_school_classes_sub_id_id` int(11) NOT NULL,
  `primary_school_classes_sub_id_name` varchar(15) NOT NULL,
  `primary_school_classes_sub_timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

-- --------------------------------------------------------

--
-- Table structure for table `primary_subjects`
--

CREATE TABLE `primary_subjects` (
  `primary_subjects_id` int(11) NOT NULL,
  `primary_subjects_name` varchar(30) NOT NULL,
  `primary_subjects_timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `secondary_common_e_session` varchar(10) NOT NULL,
  `secondary_common_e_price` varchar(9) NOT NULL,
  `secondary_common_e_reference` varchar(20) NOT NULL,
  `secondary_common_e_status` int(1) NOT NULL DEFAULT 0,
  `secondary_common_e_timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `secondary_common_fee`
--

CREATE TABLE `secondary_common_fee` (
  `secondary_common_fee_id` int(11) NOT NULL,
  `secondary_common_fee_price` int(11) NOT NULL,
  `secondary_common_timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `secondary_common_fee`
--

INSERT INTO `secondary_common_fee` (`secondary_common_fee_id`, `secondary_common_fee_price`, `secondary_common_timestamp`) VALUES
(1, 20000, '2022-06-05 17:28:20');

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

-- --------------------------------------------------------

--
-- Table structure for table `secondary_module_join_students`
--

CREATE TABLE `secondary_module_join_students` (
  `secondary_module_join_students_id` int(11) NOT NULL,
  `secondary_module_students` int(11) NOT NULL,
  `secondary_module_type_id` int(11) NOT NULL,
  `secondary_module_reference` varchar(20) NOT NULL,
  `secondary_module_status` int(1) NOT NULL DEFAULT 0,
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
  `secondary_teacher_age` int(2) NOT NULL,
  `secondary_teacher_phone` varchar(11) NOT NULL,
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
-- Indexes for table `primary_school_classes_sub`
--
ALTER TABLE `primary_school_classes_sub`
  ADD PRIMARY KEY (`primary_school_classes_sub_id`);

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
-- Indexes for table `secondary_common_fee`
--
ALTER TABLE `secondary_common_fee`
  ADD PRIMARY KEY (`secondary_common_fee_id`);

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
  MODIFY `module_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `module_join_students`
--
ALTER TABLE `module_join_students`
  MODIFY `module_join_students_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `module_price`
--
ALTER TABLE `module_price`
  MODIFY `module_price_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `primary_class_subjects`
--
ALTER TABLE `primary_class_subjects`
  MODIFY `primary_class_subjects_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `primary_payment`
--
ALTER TABLE `primary_payment`
  MODIFY `primary_payment_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `primary_school_classes`
--
ALTER TABLE `primary_school_classes`
  MODIFY `primary_class_id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `primary_school_classes_sub`
--
ALTER TABLE `primary_school_classes_sub`
  MODIFY `primary_school_classes_sub_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `primary_school_students`
--
ALTER TABLE `primary_school_students`
  MODIFY `primary_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `primary_test_assignment_submit`
--
ALTER TABLE `primary_test_assignment_submit`
  MODIFY `primary_test_submit_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `primary_test_assignment_upload`
--
ALTER TABLE `primary_test_assignment_upload`
  MODIFY `primary_test_upload_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `secondary_class_subjects`
--
ALTER TABLE `secondary_class_subjects`
  MODIFY `secondary_class_subjects_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `secondary_common_e`
--
ALTER TABLE `secondary_common_e`
  MODIFY `secondary_common_e_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `secondary_common_fee`
--
ALTER TABLE `secondary_common_fee`
  MODIFY `secondary_common_fee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `secondary_modules`
--
ALTER TABLE `secondary_modules`
  MODIFY `secondary_module_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `secondary_module_join_students`
--
ALTER TABLE `secondary_module_join_students`
  MODIFY `secondary_module_join_students_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `secondary_module_price`
--
ALTER TABLE `secondary_module_price`
  MODIFY `secondary_module_price_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `secondary_payment`
--
ALTER TABLE `secondary_payment`
  MODIFY `secondary_payment_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `secondary_school_students`
--
ALTER TABLE `secondary_school_students`
  MODIFY `secondary_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `secondary_subject`
--
ALTER TABLE `secondary_subject`
  MODIFY `secondary_subjects_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `secondary_teachers`
--
ALTER TABLE `secondary_teachers`
  MODIFY `secondary_teacher_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `secondary_test_assignment_upload`
--
ALTER TABLE `secondary_test_assignment_upload`
  MODIFY `secondary_test_upload_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `term_start_end`
--
ALTER TABLE `term_start_end`
  MODIFY `term_start_end_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
