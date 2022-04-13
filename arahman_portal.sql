-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 13, 2022 at 02:47 PM
-- Server version: 5.7.24
-- PHP Version: 7.2.19

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
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `module_id` int(11) NOT NULL,
  `module_type` varchar(50) NOT NULL,
  `module_start_date` varchar(11) NOT NULL,
  `module_end_date` varchar(11) NOT NULL,
  `module_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`module_id`, `module_type`, `module_start_date`, `module_end_date`, `module_timestamp`) VALUES
(1, 'Inter House Sport', '2022-05-12', '2022-05-24', '2022-04-08 16:36:44'),
(2, 'Inter House Sport', '2022-05-12', '2022-05-24', '2022-04-08 16:36:44'),
(3, 'Excursion', '2022-04-13', '2022-04-21', '2022-04-13 11:09:16'),
(4, 'Excursion', '2022-04-13', '2022-04-21', '2022-04-13 11:10:07'),
(5, 'Pratical', '2022-04-13', '2022-04-22', '2022-04-13 11:13:41'),
(6, 'Excursion', '2022-04-13', '2022-04-27', '2022-04-13 11:18:58');

-- --------------------------------------------------------

--
-- Table structure for table `module_price`
--

CREATE TABLE `module_price` (
  `module_price_id` int(11) NOT NULL,
  `module_class_id` int(11) NOT NULL,
  `modules_id` int(11) NOT NULL,
  `module_price` varchar(9) NOT NULL,
  `module_price_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `module_price`
--

INSERT INTO `module_price` (`module_price_id`, `module_class_id`, `modules_id`, `module_price`, `module_price_timestamp`) VALUES
(1, 1, 5, '5000', '2022-04-13 11:13:41'),
(2, 2, 5, '5000', '2022-04-13 11:13:41'),
(3, 4, 5, '5000', '2022-04-13 11:13:41'),
(4, 4, 6, '8000', '2022-04-13 11:18:58'),
(5, 5, 6, '8000', '2022-04-13 11:18:58');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`module_id`);

--
-- Indexes for table `module_price`
--
ALTER TABLE `module_price`
  ADD PRIMARY KEY (`module_price_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `module_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `module_price`
--
ALTER TABLE `module_price`
  MODIFY `module_price_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
