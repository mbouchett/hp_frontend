-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 04, 2019 at 11:58 AM
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
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_ID` int(7) NOT NULL,
  `cart_date` text CHARACTER SET utf8 NOT NULL,
  `customer` int(7) NOT NULL,
  `regnum` int(8) DEFAULT NULL,
  `ip` text CHARACTER SET utf8 NOT NULL,
  `item_ID` int(8) NOT NULL,
  `cart_retail` text CHARACTER SET utf8 NOT NULL,
  `cart_qty` int(3) NOT NULL,
  `cart_purch_date` text CHARACTER SET utf8
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_ID`, `cart_date`, `customer`, `regnum`, `ip`, `item_ID`, `cart_retail`, `cart_qty`, `cart_purch_date`) VALUES
(15895, '2019-05-21', 17592, NULL, '73.18.181.226', 18835, '75', 1, '2019-05-21'),
(15913, '2019-05-29', 10799, 311, '142.105.240.35', 2569, '99.99', 1, '2019-05-29'),
(15914, '2019-05-29', 46823, NULL, '68.142.42.251', 53468, '119.99', 1, NULL),
(15911, '2019-05-28', 41544, NULL, '71.161.109.86', 48630, '6.99', 4, '2019-05-28'),
(15905, '2019-05-25', 31205, NULL, '172.58.221.49', 65184, '359', 1, NULL),
(15906, '2019-05-28', 41545, NULL, '69.5.117.200', 53448, '1.59', 1, NULL),
(15885, '2019-05-19', 11768, NULL, '73.68.21.255', 48230, '99.99', 1, '2019-05-19'),
(15910, '2019-05-28', 41544, NULL, '71.161.109.86', 48631, '6.99', 4, '2019-05-28'),
(15909, '2019-05-28', 41972, NULL, '166.182.250.183', 16095, '14.99', 1, NULL),
(15908, '2019-05-28', 41972, NULL, '166.182.250.183', 64188, '19.99', 1, NULL),
(15907, '2019-05-28', 41972, NULL, '166.182.250.183', 40663, '49.99', 1, NULL),
(15896, '2019-05-23', 23292, NULL, '112.200.106.91', 59306, '13.99', 1, NULL),
(15897, '2019-05-23', 23506, NULL, '67.217.114.127', 43390, '259', 1, NULL),
(15898, '2019-05-23', 23832, NULL, '75.147.11.33', 71042, '379', 1, NULL),
(15899, '2019-05-23', 20739, NULL, '88.108.73.196', 1991, '5.99', 1, NULL),
(15900, '2019-05-23', 24354, NULL, '103.105.49.100', 65559, '34.99', 1, '2019-05-23'),
(15901, '2019-05-24', 25550, NULL, '69.5.114.189', 66051, '259', 1, NULL),
(15902, '2019-05-24', 25550, NULL, '69.5.114.189', 53134, '269', 1, NULL),
(15903, '2019-05-24', 25669, NULL, '198.52.38.5', 2676, '6.99', 1, NULL),
(15904, '2019-05-25', 29856, NULL, '76.23.173.148', 18836, '100', 1, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_ID` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15915;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
