-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 04, 2019 at 12:00 PM
-- Server version: 5.6.41
-- PHP Version: 7.2.7

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
-- Table structure for table `main_cats`
--

CREATE TABLE `main_cats` (
  `main_ID` int(11) NOT NULL,
  `main_name` tinytext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `main_cats`
--

INSERT INTO `main_cats` (`main_ID`, `main_name`) VALUES
(1, 'Kitchen'),
(2, 'Bed/Bath'),
(3, 'Furniture'),
(4, 'Outdoor'),
(5, 'Dining'),
(7, 'Rugs'),
(8, 'Home/Decor'),
(9, 'Lighting'),
(10, 'Toys'),
(11, 'Candle'),
(12, 'Pet'),
(13, 'Stationary'),
(14, 'Vermont'),
(15, 'Holiday'),
(16, 'Sale'),
(6, 'Bar');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `main_cats`
--
ALTER TABLE `main_cats`
  ADD PRIMARY KEY (`main_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `main_cats`
--
ALTER TABLE `main_cats`
  MODIFY `main_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
