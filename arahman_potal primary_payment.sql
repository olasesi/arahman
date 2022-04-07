-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 07, 2022 at 12:02 PM
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
-- Table structure for table `primary_payment`
--

CREATE TABLE `primary_payment` (
  `primary_payment_id` bigint(20) NOT NULL,
  `primary_payment_students_id` bigint(20) NOT NULL,
  `primary_payment_students_reference` varchar(20) NOT NULL,
  `primary_payment_term` varchar(20) NOT NULL,
  `primary_payment_session` varchar(10) NOT NULL,
  `primary_payment_fees` varchar(50) NOT NULL,
  `primary_payment_paid_percent` varchar(9) NOT NULL,
  `primary_payment_balance` varchar(9) NOT NULL,
  `primary_payment_status` varchar(10) NOT NULL DEFAULT '0',
  `primary_payment_timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `primary_payment`
--
ALTER TABLE `primary_payment`
  ADD PRIMARY KEY (`primary_payment_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `primary_payment`
--
ALTER TABLE `primary_payment`
  MODIFY `primary_payment_id` bigint(20) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
