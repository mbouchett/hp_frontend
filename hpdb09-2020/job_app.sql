-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 27, 2020 at 05:52 PM
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
-- Table structure for table `job_app`
--

CREATE TABLE `job_app` (
  `e_app_ID` int(11) NOT NULL,
  `e_app_name` tinytext NOT NULL,
  `e_app_addr01` tinytext NOT NULL,
  `e_app_addr02` tinytext,
  `e_app_phone` tinytext NOT NULL,
  `e_app_email` tinytext NOT NULL,
  `e_app_current` tinytext,
  `e_app_student` tinytext,
  `e_app_holidays` tinyint(1) NOT NULL,
  `e_app_convicted` text,
  `e_app_fulltime` tinyint(1) NOT NULL,
  `e_app_minHours` int(11) DEFAULT NULL,
  `e_app_maxHours` int(11) DEFAULT NULL,
  `e_app_we_start01` tinytext,
  `e_app_we_start02` tinytext,
  `e_app_we_start03` tinytext,
  `e_app_we_end01` tinytext,
  `e_app_we_end02` tinytext,
  `e_app_we_end03` tinytext,
  `e_app_we_emp01` tinytext,
  `e_app_we_emp02` tinytext,
  `e_app_we_emp03` tinytext,
  `e_app_we_phone01` tinytext,
  `e_app_we_phone02` tinytext,
  `e_app_we_phone03` tinytext,
  `e_app_we_super01` tinytext NOT NULL,
  `e_app_we_super02` tinytext NOT NULL,
  `e_app_we_super03` tinytext NOT NULL,
  `e_app_we_job01` text NOT NULL,
  `e_app_we_job02` text NOT NULL,
  `e_app_we_job03` text NOT NULL,
  `e_app_ref_name01` tinytext NOT NULL,
  `e_app_ref_name02` tinytext NOT NULL,
  `e_app_ref_relation01` text NOT NULL,
  `e_app_ref_relation02` text NOT NULL,
  `e_app_ref_phone01` tinytext NOT NULL,
  `e_app_ref_phone02` tinytext NOT NULL,
  `e_app_sun_start` tinytext,
  `e_app_sun_end` tinytext,
  `e_app_mon_start` tinytext,
  `e_app_mon_end` tinytext,
  `e_app_tue_start` tinytext,
  `e_app_tue_end` tinytext,
  `e_app_wed_start` tinytext,
  `e_app_wed_end` tinytext,
  `e_app_thu_start` tinytext,
  `e_app_thu_end` tinytext,
  `e_app_fri_start` tinytext,
  `e_app_fri_end` tinytext,
  `e_app_sat_start` tinytext,
  `e_app_sat_end` tinytext,
  `e_app_willing` tinyint(1) NOT NULL,
  `e_app_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `job_app`
--
ALTER TABLE `job_app`
  ADD PRIMARY KEY (`e_app_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `job_app`
--
ALTER TABLE `job_app`
  MODIFY `e_app_ID` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
