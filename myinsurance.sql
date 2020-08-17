-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 17, 2020 at 10:39 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `myinsurance`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `Id` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Middle_name` varchar(255) NOT NULL,
  `Last_name` varchar(255) NOT NULL,
  `Policy_number` int(11) NOT NULL,
  `User_name` varchar(255) NOT NULL,
  `Password` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`Id`, `Name`, `Middle_name`, `Last_name`, `Policy_number`, `User_name`, `Password`) VALUES
(1, 'Azia', 'Andrea', 'Lundanum', 12345, 'aze@mark.com', 0x617a653132333435),
(3, 'Jerlyn', 'Gandice', 'Yannie', 12346, 'jerlyn@mark.com', 0x616e6e3132333435),
(4, 'Sarahlyn', 'Yuling', 'Rante', 12347, 'sarah@mark.com', 0x6c796e3132333435);

-- --------------------------------------------------------

--
-- Table structure for table `fund_details`
--

CREATE TABLE `fund_details` (
  `Fund_Id` int(11) NOT NULL,
  `Type` varchar(255) NOT NULL,
  `Policy_number` varchar(255) NOT NULL,
  `Units` float NOT NULL,
  `Allocation` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fund_details`
--

INSERT INTO `fund_details` (`Fund_Id`, `Type`, `Policy_number`, `Units`, `Allocation`) VALUES
(1, 'Index', '12345', 5087.9, 70),
(2, 'Equity', '12345', 547.2, 30),
(4, 'Equity', '12347', 789, 100),
(8, 'Index', '12346', 245, 100);

-- --------------------------------------------------------

--
-- Table structure for table `historical`
--

CREATE TABLE `historical` (
  `Counter` int(255) NOT NULL,
  `Policy_number` int(255) NOT NULL,
  `Total_fund` float NOT NULL,
  `Index_fund` float NOT NULL,
  `Equity_fund` float NOT NULL,
  `Asof` date NOT NULL,
  `Timestamp` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `historical`
--

INSERT INTO `historical` (`Counter`, `Policy_number`, `Total_fund`, `Index_fund`, `Equity_fund`, `Asof`, `Timestamp`) VALUES
(154, 12345, 8182.33, 5749.37, 2432.96, '2020-04-03', '2020-01-07'),
(156, 12345, 8172.02, 5743.77, 2428.25, '2020-06-03', '2020-01-08'),
(161, 12345, 8089.69, 5677.63, 2412.06, '2020-01-03', '2020-01-05'),
(162, 12345, 8182.33, 5749.37, 2432.96, '2020-02-04', '2020-01-05'),
(163, 12345, 8182.33, 5749.37, 2432.96, '2020-03-05', '2020-01-05'),
(165, 12345, 8139.76, 5720.37, 2419.39, '2020-05-05', '2020-01-07'),
(167, 12345, 8065.33, 5665.42, 2399.91, '2020-07-02', '2020-01-09'),
(191, 12345, 14111.3, 8678.32, 5432.96, '2020-08-05', '2020-08-04'),
(200, 12347, 9000, 0, 9000, '2020-01-10', '2020-08-10'),
(203, 12347, 9100, 0, 9100, '2020-02-10', '2020-08-10'),
(204, 12347, 9500, 0, 9500, '2020-03-10', '2020-08-10'),
(205, 12347, 18600, 0, 18600, '2020-04-10', '2020-08-10'),
(206, 12347, 18700, 0, 18700, '2020-05-10', '2020-08-10'),
(207, 12347, 18500, 0, 18500, '2020-06-10', '2020-08-10'),
(208, 12347, 27800, 0, 27800, '2020-07-10', '2020-08-10'),
(209, 12347, 27600, 0, 27600, '2020-08-10', '2020-08-10'),
(210, 12346, 9000, 9000, 0, '2020-06-10', '2020-08-10'),
(211, 12346, 9300, 9300, 0, '2020-07-10', '2020-08-10'),
(212, 12346, 9300, 9300, 0, '2020-08-10', '2020-08-10'),
(213, 12346, 18700, 18700, 0, '2020-09-10', '2020-08-10');

-- --------------------------------------------------------

--
-- Table structure for table `payment_details`
--

CREATE TABLE `payment_details` (
  `Id` int(255) NOT NULL,
  `Policy_number` int(255) NOT NULL,
  `Date_paid` date NOT NULL,
  `Due_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment_details`
--

INSERT INTO `payment_details` (`Id`, `Policy_number`, `Date_paid`, `Due_date`) VALUES
(1, 12345, '2020-07-01', '2020-07-31'),
(3, 12346, '2020-07-01', '2020-07-31'),
(4, 12347, '2020-08-02', '2020-08-30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `fund_details`
--
ALTER TABLE `fund_details`
  ADD PRIMARY KEY (`Fund_Id`);

--
-- Indexes for table `historical`
--
ALTER TABLE `historical`
  ADD PRIMARY KEY (`Counter`);

--
-- Indexes for table `payment_details`
--
ALTER TABLE `payment_details`
  ADD PRIMARY KEY (`Policy_number`),
  ADD UNIQUE KEY `Id` (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `fund_details`
--
ALTER TABLE `fund_details`
  MODIFY `Fund_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `historical`
--
ALTER TABLE `historical`
  MODIFY `Counter` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=218;

--
-- AUTO_INCREMENT for table `payment_details`
--
ALTER TABLE `payment_details`
  MODIFY `Id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
