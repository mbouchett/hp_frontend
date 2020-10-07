-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 27, 2020 at 05:55 PM
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
-- Table structure for table `promo`
--

CREATE TABLE `promo` (
  `promo_ID` int(11) NOT NULL,
  `promo_disc` int(11) DEFAULT NULL,
  `promo_dollar` float DEFAULT NULL,
  `promo_exp` date NOT NULL,
  `promo_limit` int(11) DEFAULT NULL,
  `promo_used` int(11) NOT NULL DEFAULT '0',
  `promo_code` tinytext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `promo`
--

INSERT INTO `promo` (`promo_ID`, `promo_disc`, `promo_dollar`, `promo_exp`, `promo_limit`, `promo_used`, `promo_code`) VALUES
(1, 20, NULL, '2019-06-30', NULL, 0, 'TEST20'),
(2, 20, NULL, '2019-08-12', NULL, 0, 'SUMMERSALE20'),
(3, 20, NULL, '2019-11-01', NULL, 0, 'FALLMAIL19'),
(4, 20, NULL, '2019-12-31', NULL, 0, 'BPD20OFF'),
(5, 20, NULL, '2019-12-02', NULL, 0, 'BFP2019BF'),
(6, 20, NULL, '2019-12-01', NULL, 0, 'XMAS2019BF'),
(7, NULL, 20, '2021-01-01', 1, 0, 'SALSCHO20'),
(8, 20, NULL, '2020-06-07', NULL, 0, 'VIRTUALSIDEWALK2020');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `promo`
--
ALTER TABLE `promo`
  ADD PRIMARY KEY (`promo_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `promo`
--
ALTER TABLE `promo`
  MODIFY `promo_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
