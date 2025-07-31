-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 30, 2024 at 01:09 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bus-booking`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `a_id` int(11) NOT NULL,
  `a_name` varchar(200) NOT NULL,
  `a_email` varchar(200) NOT NULL,
  `a_password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`a_id`, `a_name`, `a_email`, `a_password`) VALUES
(1, 'Admin', 'admin@gmail.com', '12345');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `bk_id` int(11) NOT NULL,
  `bk_date` date NOT NULL,
  `c_id` int(11) NOT NULL,
  `t_id` int(11) NOT NULL,
  `bk_name` varchar(255) NOT NULL,
  `bk_phone` varchar(255) NOT NULL,
  `bk_email` varchar(255) NOT NULL,
  `bk_total_fair` varchar(255) NOT NULL,
  `bk_transaction_id` varchar(255) NOT NULL,
  `bk_payment_status` varchar(255) NOT NULL,
  `bk_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`bk_id`, `bk_date`, `c_id`, `t_id`, `bk_name`, `bk_phone`, `bk_email`, `bk_total_fair`, `bk_transaction_id`, `bk_payment_status`, `bk_status`) VALUES
(6, '2024-10-03', 2, 4, 'Rahul', '9876543210', 'rahul@gmail.com', '750', '88333516739219', 'Paid', 'Booked');

-- --------------------------------------------------------

--
-- Table structure for table `bus`
--

CREATE TABLE `bus` (
  `b_id` int(11) NOT NULL,
  `b_name` varchar(255) NOT NULL,
  `b_driver_name` varchar(255) NOT NULL,
  `b_driver_phone` varchar(255) NOT NULL,
  `b_number` varchar(255) NOT NULL,
  `b_total_seats` int(11) NOT NULL,
  `b_type` varchar(255) NOT NULL,
  `b_added_date` date NOT NULL,
  `b_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bus`
--

INSERT INTO `bus` (`b_id`, `b_name`, `b_driver_name`, `b_driver_phone`, `b_number`, `b_total_seats`, `b_type`, `b_added_date`, `b_status`) VALUES
(1, 'AERO BUS', 'Raghu', '9876543210', 'KA 21 R 1234', 34, 'AC Sleeper', '2024-09-18', 'Available'),
(2, 'Sugama', 'Shashi Kumar', '9876543212', 'KA 21 R 4321', 34, 'AC Sleeper', '2024-09-18', 'Available'),
(3, 'Green Line Travels', 'John', '9876543212', 'KA 21 R 5678', 34, 'AC Sleeper', '2024-09-18', 'Available');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `cn_id` int(11) NOT NULL,
  `cn_date` date NOT NULL,
  `cn_name` varchar(255) NOT NULL,
  `cn_phone` varchar(255) NOT NULL,
  `cn_email` varchar(255) NOT NULL,
  `cn_subject` varchar(255) NOT NULL,
  `cn_message` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`cn_id`, `cn_date`, `cn_name`, `cn_phone`, `cn_email`, `cn_subject`, `cn_message`) VALUES
(2, '2024-09-19', 'Rahul', '09876543210', 'rahul@gmail.com', 'Bus Availability ', 'Bus availability is less. Upload more trips'),
(3, '2024-10-01', 'Rahul', '9876543210', 'rahul@gmail.com', 'very good services', 'thank you for your service'),
(4, '2024-10-03', 'Rahul', '9876543210', 'rahul@gmail.com', 'Good and satisfied with the service', 'Thank you for your service');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `c_id` int(11) NOT NULL,
  `c_username` varchar(200) NOT NULL,
  `c_email` varchar(200) NOT NULL,
  `c_password` varchar(200) NOT NULL,
  `c_added_date` date NOT NULL,
  `c_status` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`c_id`, `c_username`, `c_email`, `c_password`, `c_added_date`, `c_status`) VALUES
(2, 'Rahul', 'rahul@gmail.com', '12345', '2024-10-01', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `passenger`
--

CREATE TABLE `passenger` (
  `ps_id` int(11) NOT NULL,
  `ps_name` varchar(255) NOT NULL,
  `ps_age` varchar(255) NOT NULL,
  `ps_gender` varchar(255) NOT NULL,
  `bk_id` int(11) NOT NULL,
  `s_id` int(11) NOT NULL,
  `ps_ticket` varchar(255) NOT NULL,
  `ps_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `passenger`
--

INSERT INTO `passenger` (`ps_id`, `ps_name`, `ps_age`, `ps_gender`, `bk_id`, `s_id`, `ps_ticket`, `ps_status`) VALUES
(9, 'Rahul', '23', 'Male', 6, 13, 'TCKT17279360359120', 'confirmed');

-- --------------------------------------------------------

--
-- Table structure for table `seats`
--

CREATE TABLE `seats` (
  `s_id` int(11) NOT NULL,
  `b_id` int(11) NOT NULL,
  `s_number` varchar(255) NOT NULL,
  `s_booked_for` varchar(255) NOT NULL,
  `s_added_date` date NOT NULL,
  `s_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `seats`
--

INSERT INTO `seats` (`s_id`, `b_id`, `s_number`, `s_booked_for`, `s_added_date`, `s_status`) VALUES
(1, 1, 'L1', '', '2024-09-18', 'Available'),
(2, 1, 'L2', '', '2024-09-18', 'Available'),
(3, 1, 'L3', '', '2024-09-18', 'Available'),
(4, 1, 'L4', '', '2024-09-18', 'Available'),
(5, 1, 'L5', '', '2024-09-18', 'Available'),
(6, 1, 'L6', '', '2024-09-18', 'Available'),
(7, 1, 'L7', '', '2024-09-18', 'Available\n'),
(8, 1, 'L8', '', '2024-09-18', 'Available'),
(9, 1, 'L9', '', '2024-09-18', 'Available'),
(10, 1, 'L10', '', '2024-09-18', 'Available'),
(11, 1, 'L11', '', '2024-09-18', 'Available'),
(12, 1, 'L12', '', '2024-09-18', 'Available'),
(13, 1, 'L13', 'Male', '2024-09-18', 'Booked'),
(14, 1, 'L14', 'Male', '2024-09-18', 'Booked'),
(15, 1, 'L15', '', '2024-09-18', 'Available'),
(16, 1, 'L16', '', '2024-09-18', 'Available'),
(17, 1, 'L17', '', '2024-09-18', 'Available'),
(18, 1, 'U1', '', '2024-09-18', 'Available'),
(19, 1, 'U2', '', '2024-09-18', 'Available'),
(20, 1, 'U3', '', '2024-09-18', 'Available'),
(21, 1, 'U4', '', '2024-09-18', 'Available'),
(22, 1, 'U5', '', '2024-09-18', 'Available'),
(23, 1, 'U6', '', '2024-09-18', 'Available'),
(24, 1, 'U7', '', '2024-09-18', 'Available'),
(25, 1, 'U8', '', '2024-09-18', 'Available'),
(26, 1, 'U9', '', '2024-09-18', 'Available'),
(27, 1, 'U10', '', '2024-09-18', 'Available'),
(28, 1, 'U11', 'Male', '2024-09-18', 'Booked'),
(29, 1, 'U12', '', '2024-09-18', 'Available'),
(30, 1, 'U13', '', '2024-09-18', 'Available'),
(31, 1, 'U14', '', '2024-09-18', 'Available'),
(32, 1, 'U15', '', '2024-09-18', 'Available'),
(33, 1, 'U16', '', '2024-09-18', 'Available'),
(34, 1, 'U17', '', '2024-09-18', 'Available'),
(35, 2, 'L1', '', '2024-09-18', 'Available'),
(36, 2, 'L2', '', '2024-09-18', 'Available'),
(37, 2, 'L3', '', '2024-09-18', 'Available'),
(38, 2, 'L4', '', '2024-09-18', 'Available'),
(39, 2, 'L5', '', '2024-09-18', 'Available'),
(40, 2, 'L6', '', '2024-09-18', 'Available'),
(41, 2, 'L7', '', '2024-09-18', 'Available'),
(42, 2, 'L8', '', '2024-09-18', 'Available'),
(43, 2, 'L9', '', '2024-09-18', 'Available'),
(44, 2, 'L10', '', '2024-09-18', 'Available'),
(45, 2, 'L11', '', '2024-09-18', 'Available'),
(46, 2, 'L12', '', '2024-09-18', 'Available'),
(47, 2, 'L13', '', '2024-09-18', 'Available'),
(48, 2, 'L14', '', '2024-09-18', 'Available'),
(49, 2, 'L15', '', '2024-09-18', 'Available'),
(50, 2, 'L16', '', '2024-09-18', 'Available'),
(51, 2, 'L17', '', '2024-09-18', 'Available'),
(52, 2, 'U1', '', '2024-09-18', 'Available'),
(53, 2, 'U2', '', '2024-09-18', 'Available'),
(54, 2, 'U3', '', '2024-09-18', 'Available'),
(55, 2, 'U4', '', '2024-09-18', 'Available'),
(56, 2, 'U5', '', '2024-09-18', 'Available'),
(57, 2, 'U6', '', '2024-09-18', 'Available'),
(58, 2, 'U7', '', '2024-09-18', 'Available'),
(59, 2, 'U8', '', '2024-09-18', 'Available'),
(60, 2, 'U9', '', '2024-09-18', 'Available'),
(61, 2, 'U10', '', '2024-09-18', 'Available'),
(62, 2, 'U11', '', '2024-09-18', 'Available'),
(63, 2, 'U12', '', '2024-09-18', 'Available'),
(64, 2, 'U13', '', '2024-09-18', 'Available'),
(65, 2, 'U14', '', '2024-09-18', 'Available'),
(66, 2, 'U15', '', '2024-09-18', 'Available'),
(67, 2, 'U16', '', '2024-09-18', 'Available'),
(68, 2, 'U17', '', '2024-09-18', 'Available'),
(69, 3, 'L1', '', '2024-09-18', 'Available'),
(70, 3, 'L2', '', '2024-09-18', 'Available'),
(71, 3, 'L3', '', '2024-09-18', 'Available'),
(72, 3, 'L4', '', '2024-09-18', 'Available'),
(73, 3, 'L5', '', '2024-09-18', 'Available'),
(74, 3, 'L6', '', '2024-09-18', 'Available'),
(75, 3, 'L7', '', '2024-09-18', 'Available'),
(76, 3, 'L8', '', '2024-09-18', 'Available'),
(77, 3, 'L9', '', '2024-09-18', 'Available'),
(78, 3, 'L10', '', '2024-09-18', 'Available'),
(79, 3, 'L11', '', '2024-09-18', 'Available'),
(80, 3, 'L12', '', '2024-09-18', 'Available'),
(81, 3, 'L13', '', '2024-09-18', 'Available'),
(82, 3, 'L14', '', '2024-09-18', 'Available'),
(83, 3, 'L15', '', '2024-09-18', 'Available'),
(84, 3, 'L16', '', '2024-09-18', 'Available'),
(85, 3, 'L17', '', '2024-09-18', 'Available'),
(86, 3, 'U1', '', '2024-09-18', 'Available'),
(87, 3, 'U2', '', '2024-09-18', 'Available'),
(88, 3, 'U3', '', '2024-09-18', 'Available'),
(89, 3, 'U4', '', '2024-09-18', 'Available'),
(90, 3, 'U5', '', '2024-09-18', 'Available'),
(91, 3, 'U6', '', '2024-09-18', 'Available'),
(92, 3, 'U7', '', '2024-09-18', 'Available'),
(93, 3, 'U8', '', '2024-09-18', 'Available'),
(94, 3, 'U9', '', '2024-09-18', 'Available'),
(95, 3, 'U10', '', '2024-09-18', 'Available'),
(96, 3, 'U11', '', '2024-09-18', 'Available'),
(97, 3, 'U12', '', '2024-09-18', 'Available'),
(98, 3, 'U13', '', '2024-09-18', 'Available'),
(99, 3, 'U14', '', '2024-09-18', 'Available'),
(100, 3, 'U15', '', '2024-09-18', 'Available'),
(101, 3, 'U16', '', '2024-09-18', 'Available'),
(102, 3, 'U17', '', '2024-09-18', 'Available');

-- --------------------------------------------------------

--
-- Table structure for table `trip`
--

CREATE TABLE `trip` (
  `t_id` int(11) NOT NULL,
  `t_date` datetime NOT NULL,
  `b_id` int(11) NOT NULL,
  `t_from` varchar(255) NOT NULL,
  `t_to` varchar(255) NOT NULL,
  `t_root` varchar(255) NOT NULL,
  `t_duration` varchar(255) NOT NULL,
  `t_ticket` varchar(255) NOT NULL,
  `t_added_date` date NOT NULL,
  `t_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `trip`
--

INSERT INTO `trip` (`t_id`, `t_date`, `b_id`, `t_from`, `t_to`, `t_root`, `t_duration`, `t_ticket`, `t_added_date`, `t_status`) VALUES
(1, '2024-10-03 00:00:00', 3, 'Mangalore', 'Bangalore', 'Mysuru', '12', '510', '2024-09-18', 'Completed'),
(2, '2025-01-01 20:30:00', 3, 'Bangalore', 'Mangalore', 'Mysuru', '9', '500', '2024-09-18', 'Scheduled'),
(3, '2024-09-19 18:00:00', 2, 'Chennai', 'Bangalore', 'Ooty', '13', '700', '2024-09-18', 'Completed'),
(4, '2025-01-10 18:00:00', 1, 'Mangalore', 'Bangalore', 'Mysuru', '13', '750', '2024-09-18', 'Completed'),
(5, '2025-01-01 00:00:00', 2, 'Bangalore', 'Mangalore', 'Hassan', '11', '700', '2024-09-18', 'Completed'),
(6, '2025-01-01 16:00:00', 1, 'Mangalore', 'Bangalore', 'Hassab', '9', '600', '2024-12-30', 'Completed');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`a_id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`bk_id`);

--
-- Indexes for table `bus`
--
ALTER TABLE `bus`
  ADD PRIMARY KEY (`b_id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`cn_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `passenger`
--
ALTER TABLE `passenger`
  ADD PRIMARY KEY (`ps_id`);

--
-- Indexes for table `seats`
--
ALTER TABLE `seats`
  ADD PRIMARY KEY (`s_id`);

--
-- Indexes for table `trip`
--
ALTER TABLE `trip`
  ADD PRIMARY KEY (`t_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `a_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `bk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `bus`
--
ALTER TABLE `bus`
  MODIFY `b_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `cn_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `passenger`
--
ALTER TABLE `passenger`
  MODIFY `ps_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `seats`
--
ALTER TABLE `seats`
  MODIFY `s_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `trip`
--
ALTER TABLE `trip`
  MODIFY `t_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
