-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 23, 2020 at 05:17 PM
-- Server version: 5.7.28-0ubuntu0.18.04.4
-- PHP Version: 7.2.24-0ubuntu0.18.04.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
-- Table structure for table `trusted_rep`
--

CREATE TABLE `trusted_rep` (
  `rep_ID` int(11) NOT NULL,
  `rep_email` tinytext NOT NULL,
  `rep_password` tinytext NOT NULL,
  `rep_fname` tinytext NOT NULL,
  `rep_lname` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trusted_rep`
--

INSERT INTO `trusted_rep` (`rep_ID`, `rep_email`, `rep_password`, `rep_fname`, `rep_lname`) VALUES
(1, 'dk@repsolut.com', '$2a$07$theclockswerestrikingeyZT1CykVpzbKfXLMFv/73fRP/YBIPy6', 'David', 'Kagan'),
(2, 'eric@pearlmangroup.com', '$2a$07$theclockswerestrikingeY/NGSkGocNf5COzDUCKd0Tj.a5tN.xi', 'Eric', 'Pearlman'),
(3, 'maidli@hillspecialty.com', '$2a$07$theclockswerestrikingeaW5WwrLIyeRqL4AmPp6habBG/MkssPS', 'Maidli', 'Hill'),
(4, 'mark@homeportonline.com', '$2a$07$theclockswerestrikingeTBgGxwkCtREfiks/u8XOKQajcrOeVQO', 'Mark', 'Bouchett');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `trusted_rep`
--
ALTER TABLE `trusted_rep`
  ADD PRIMARY KEY (`rep_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `trusted_rep`
--
ALTER TABLE `trusted_rep`
  MODIFY `rep_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
