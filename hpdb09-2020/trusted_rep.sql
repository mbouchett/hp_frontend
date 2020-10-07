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
(2, 'eric@pearlmangroup.com', '$2a$07$theclockswerestrikinge24aQejifp0ANWow34Mgh8zaX43owpdm', 'Eric', 'Pearlman'),
(3, 'maidli@hillspecialty.com', '$2a$07$theclockswerestrikingeaW5WwrLIyeRqL4AmPp6habBG/MkssPS', 'Maidli', 'Hill'),
(4, 'mark@homeportonline.com', '$2a$07$theclockswerestrikingeTBgGxwkCtREfiks/u8XOKQajcrOeVQO', 'Mark', 'Bouchett'),
(5, 'asibley@newenglandhousewares.com', '$2a$07$theclockswerestrikingeUdM0rKpyaudFg8ycCFNqZXMCYUD3.uK', 'Allan', 'Sibley');

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
  MODIFY `rep_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
