-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 16, 2023 at 02:59 PM
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
-- Database: `vacci`
--

-- --------------------------------------------------------

--
-- Table structure for table `equip`
--

CREATE TABLE `equip` (
  `sno` int(11) NOT NULL,
  `date` date NOT NULL,
  `covaxin` int(11) NOT NULL,
  `covishield` int(11) NOT NULL,
  `booster` int(11) NOT NULL,
  `ventilator` int(11) NOT NULL,
  `bed` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `equip`
--

INSERT INTO `equip` (`sno`, `date`, `covaxin`, `covishield`, `booster`, `ventilator`, `bed`) VALUES
(1, '2023-04-15', 52, 21, 54, 65, 545);

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `sno` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL,
  `consultingFor` text NOT NULL,
  `appointment` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`sno`, `name`, `email`, `consultingFor`, `appointment`) VALUES
(1, 'bhavesh', 'bhavesh@gmail.com', 'head ache', '2023-04-18');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `sno` int(11) NOT NULL,
  `date` date NOT NULL,
  `newVaccinations` int(11) NOT NULL,
  `newCases` int(11) NOT NULL,
  `newRecoveries` int(11) NOT NULL,
  `newDeaths` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`sno`, `date`, `newVaccinations`, `newCases`, `newRecoveries`, `newDeaths`) VALUES
(1, '2023-04-16', 252, 23, 12, 8),
(2, '2023-04-14', 56, 546, 54, 87);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`, `date`) VALUES
('ritesh', 'pass', '2023-04-15 16:41:44');

-- --------------------------------------------------------

--
-- Table structure for table `vacc`
--

CREATE TABLE `vacc` (
  `sno` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `adhaar` int(16) NOT NULL,
  `email` varchar(25) NOT NULL,
  `address` varchar(50) NOT NULL,
  `dose` varchar(20) NOT NULL,
  `type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vacc`
--

INSERT INTO `vacc` (`sno`, `name`, `adhaar`, `email`, `address`, `dose`, `type`) VALUES
(1, 'Ali', 1234567899, 'ali@gmail.com', 'ali baba chlees chor', 'second', 'booster'),
(3, 'Harshal', 456987752, 'harshal@gmail.com', 'Maharashtra', 'Booster', 'inflanja');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `equip`
--
ALTER TABLE `equip`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `vacc`
--
ALTER TABLE `vacc`
  ADD PRIMARY KEY (`sno`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `equip`
--
ALTER TABLE `equip`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `vacc`
--
ALTER TABLE `vacc`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
