-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 04, 2019 at 12:03 PM
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
-- Table structure for table `sub_feature`
--

CREATE TABLE `sub_feature` (
  `sf_ID` int(11) NOT NULL,
  `sf_start` date NOT NULL,
  `sf_end` date NOT NULL,
  `sf_f1` tinytext NOT NULL,
  `sf_f2` tinytext NOT NULL,
  `sf_f3` tinytext NOT NULL,
  `sf_f4` tinytext NOT NULL,
  `sf_link1` tinytext NOT NULL,
  `sf_link2` tinytext NOT NULL,
  `sf_link3` tinytext NOT NULL,
  `sf_link4` tinytext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sub_feature`
--

INSERT INTO `sub_feature` (`sf_ID`, `sf_start`, `sf_end`, `sf_f1`, `sf_f2`, `sf_f3`, `sf_f4`, `sf_link1`, `sf_link2`, `sf_link3`, `sf_link4`) VALUES
(2, '2019-01-28', '2019-02-10', '201901290636280.jpg', '201901290636281.jpg', '201901290636282.jpg', '201901290636283.jpg', 'httpss://www.wholesalehats.com/Baseball-Hats-Structured', '../index.php', '../index.php', '../index.php'),
(4, '2019-02-11', '2019-02-17', '201901290636280.jpg', '201901290636281.jpg', '201901290636282.jpg', '201901290636283.jpg', '../index.php', '../index.php', '../index.php', '../index.php'),
(5, '2019-02-18', '2019-02-24', '201901291623450.jpg', '201901291623451.jpg', '201901291623452.jpg', '201901291623453.jpg', '../index.php', '../index.php', '../index.php', '../index.php');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sub_feature`
--
ALTER TABLE `sub_feature`
  ADD PRIMARY KEY (`sf_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sub_feature`
--
ALTER TABLE `sub_feature`
  MODIFY `sf_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
