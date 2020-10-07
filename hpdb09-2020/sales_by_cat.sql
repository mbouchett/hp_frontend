-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 27, 2020 at 05:56 PM
-- Server version: 5.6.47
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `homeport_2018`
--

-- --------------------------------------------------------

--
-- Table structure for table `sales_by_cat`
--

CREATE TABLE `sales_by_cat` (
  `sbc_ID` int(11) NOT NULL,
  `sbc_date` tinytext NOT NULL,
  `sbc_amt` float NOT NULL,
  `dept_ID` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales_by_cat`
--

INSERT INTO `sales_by_cat` (`sbc_ID`, `sbc_date`, `sbc_amt`, `dept_ID`) VALUES
(4, '2020-01-02', 182.99, 3),
(3, '2020-01-02', 58.47, 2),
(5, '2020-01-02', 81.83, 4),
(6, '2020-01-02', 397.74, 5),
(7, '2020-01-03', 32.55, 2),
(8, '2020-01-04', 98, 1),
(9, '2020-01-04', 110.39, 2),
(10, '2020-01-04', 91.91, 4),
(11, '2020-01-04', 232.92, 5),
(12, '2020-01-05', 116.25, 2),
(13, '2020-01-05', 39.99, 3),
(14, '2020-01-05', 55.95, 4),
(15, '2020-01-05', 424.4, 5),
(16, '2020-01-06', 150.51, 2),
(17, '2020-01-06', 69.47, 3),
(18, '2020-01-06', 80.91, 4),
(19, '2020-01-06', 527.96, 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sales_by_cat`
--
ALTER TABLE `sales_by_cat`
  ADD PRIMARY KEY (`sbc_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sales_by_cat`
--
ALTER TABLE `sales_by_cat`
  MODIFY `sbc_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
