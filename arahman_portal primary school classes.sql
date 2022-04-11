-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 07, 2022 at 02:27 PM
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
(1, 'Basic one', ''),
(2, 'Basic two', ''),
(3, 'Basic three', ''),
(4, 'Basic four', ''),
(5, 'Basic five', ''),
(6, 'Basic six', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `primary_school_classes`
--
ALTER TABLE `primary_school_classes`
  ADD PRIMARY KEY (`primary_class_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `primary_school_classes`
--
ALTER TABLE `primary_school_classes`
  MODIFY `primary_class_id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
