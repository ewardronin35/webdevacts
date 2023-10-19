-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 11, 2023 at 02:05 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webdev`
--

-- --------------------------------------------------------

--
-- Table structure for table `registertable`
--

CREATE TABLE `registertable` (
  `user_id` int(30) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `nationality` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `registertable`
--

INSERT INTO `registertable` (`user_id`, `first_name`, `last_name`, `gender`, `nationality`, `email`, `username`, `password`) VALUES
(1, '', '', '', '', '', '', 'd41d8cd98f00b204e9800998ecf8427e'),
(2, '', '', '', '', '', '', 'd41d8cd98f00b204e9800998ecf8427e'),
(3, '', '', '', '', '', '', 'd41d8cd98f00b204e9800998ecf8427e'),
(4, '', '', '', '', '', '', 'd41d8cd98f00b204e9800998ecf8427e'),
(5, '', '', '', '', '', '', 'd41d8cd98f00b204e9800998ecf8427e'),
(6, '', '', '', '', '', '', 'd41d8cd98f00b204e9800998ecf8427e'),
(8, 'qwe', 'qwe', 'qwe', 'qwe', 'qwe@qweqwe', 'qwe', '76d80224611fc919a5d54f0ff9fba446'),
(55, 'qwewq', 'qeqwe', 'qwee', 'qweqe', 'wqeq@eqwe', 'qweqwe', 'efe6398127928f1b2e9ef3207fb82663'),
(123, '123qe', 'wqe', 'qwe', 'qwe', 'qwe@wqeqwe', 'Wee', '4ae98839e1f707a8239d8d3b55849507'),
(323, 'wqeqe', 'qweqwe', 'weqe', 'qweqwe', 'qeqe@gmail.com', 'wqeqe', 'a7e3b3c5c18892b77165745a79e0aeb8'),
(333, 'Eduard', 'Roland', 'Male', 'Filipino', 'eduard@gmail.com', '2Eduard', 'e10adc3949ba59abbe56e057f20f883e');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `FirstName` varchar(111) NOT NULL,
  `LastName` varchar(111) NOT NULL,
  `Age` int(11) NOT NULL,
  `Email` varchar(111) NOT NULL,
  `PhoneNumber` int(11) NOT NULL,
  `Username` varchar(111) NOT NULL,
  `Password` varchar(111) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`FirstName`, `LastName`, `Age`, `Email`, `PhoneNumber`, `Username`, `Password`) VALUES
('qweqe', 'qeqwe', 2323, '23', 23, 'bsitaa', '123213'),
('qweq', 'qwe', 0, '23', 23, 'bsit23', 'wqeqe');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `registertable`
--
ALTER TABLE `registertable`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `registertable`
--
ALTER TABLE `registertable`
  MODIFY `user_id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=334;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
