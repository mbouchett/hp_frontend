-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 11, 2020 at 10:31 AM
-- Server version: 5.6.43
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
-- Table structure for table `web_wish`
--

CREATE TABLE `web_wish` (
  `wish_ID` int(11) NOT NULL,
  `wc_ID` int(11) NOT NULL,
  `item_ID` int(11) NOT NULL,
  `wish_qty` int(11) NOT NULL DEFAULT '1',
  `wish_recQty` int(11) DEFAULT NULL,
  `wish_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `wish_fund` tinyint(1) NOT NULL DEFAULT '0',
  `wish_fundAmt` double NOT NULL DEFAULT '0',
  `wish_purch_date` date DEFAULT NULL,
  `wish_comment` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `web_wish`
--

INSERT INTO `web_wish` (`wish_ID`, `wc_ID`, `item_ID`, `wish_qty`, `wish_recQty`, `wish_date`, `wish_fund`, `wish_fundAmt`, `wish_purch_date`, `wish_comment`) VALUES
(17, 7, 11446, 1, NULL, '2019-05-31 01:28:45', 0, 0, NULL, NULL),
(18, 21, 42453, 1, NULL, '2019-06-09 17:06:44', 0, 0, NULL, NULL),
(19, 33, 74349, 1, NULL, '2019-06-22 01:37:27', 0, 0, NULL, NULL),
(23, 43, 2036, 1, NULL, '2019-06-29 20:34:00', 0, 0, NULL, NULL),
(28, 43, 74751, 1, NULL, '2019-06-29 20:46:58', 0, 0, NULL, NULL),
(29, 43, 74750, 1, NULL, '2019-06-29 20:47:07', 0, 0, NULL, NULL),
(32, 43, 74733, 1, NULL, '2019-06-29 20:47:51', 0, 0, NULL, NULL),
(33, 43, 74734, 1, NULL, '2019-06-29 20:48:17', 0, 0, NULL, NULL),
(35, 45, 74190, 1, NULL, '2019-06-30 10:56:39', 0, 0, NULL, NULL),
(36, 47, 61729, 1, NULL, '2019-07-04 16:10:01', 0, 0, NULL, NULL),
(37, 47, 9, 1, NULL, '2019-07-04 16:14:38', 0, 0, NULL, NULL),
(38, 61, 362, 1, NULL, '2019-07-22 09:04:24', 0, 0, NULL, NULL),
(39, 64, 74828, 1, NULL, '2019-07-25 23:11:22', 0, 0, NULL, NULL),
(42, 45, 43013, 1, NULL, '2019-08-10 18:46:18', 0, 0, NULL, NULL),
(43, 45, 75362, 1, NULL, '2019-08-10 18:50:13', 0, 0, NULL, NULL),
(44, 113, 74190, 1, NULL, '2019-09-07 16:24:16', 0, 0, NULL, NULL),
(45, 137, 176, 1, NULL, '2019-10-07 04:38:40', 0, 0, NULL, NULL),
(46, 165, 48916, 1, NULL, '2019-11-12 18:26:49', 0, 0, NULL, NULL),
(47, 166, 28231, 20, NULL, '2019-11-13 00:51:22', 0, 0, NULL, NULL),
(48, 167, 53570, 2, NULL, '2019-11-13 01:14:22', 0, 0, NULL, NULL),
(49, 167, 53569, 1, NULL, '2019-11-13 01:18:40', 0, 0, NULL, NULL),
(50, 210, 68290, 1, NULL, '2019-12-05 20:33:45', 0, 0, NULL, NULL),
(51, 219, 13280, 1, NULL, '2019-12-10 04:31:33', 0, 0, NULL, NULL),
(52, 242, 79111, 1, NULL, '2019-12-17 17:56:31', 0, 0, NULL, NULL),
(53, 265, 1233, 1, NULL, '2019-12-27 02:48:38', 0, 0, NULL, NULL),
(54, 268, 77187, 1, NULL, '2019-12-29 02:42:43', 0, 0, NULL, NULL),
(55, 270, 46471, 1, NULL, '2019-12-30 03:09:44', 0, 0, NULL, NULL),
(56, 274, 22894, 1, NULL, '2020-01-02 20:53:01', 0, 0, NULL, NULL),
(57, 288, 46541, 1, NULL, '2020-01-12 17:51:29', 0, 0, NULL, NULL),
(58, 289, 2450, 1, NULL, '2020-01-12 22:17:40', 0, 0, NULL, NULL),
(59, 299, 50860, 1, NULL, '2020-01-25 00:33:15', 0, 0, NULL, NULL),
(60, 299, 35749, 1, NULL, '2020-01-25 00:37:26', 0, 0, NULL, NULL),
(61, 299, 52527, 1, NULL, '2020-01-25 00:41:42', 0, 0, NULL, NULL),
(62, 299, 68895, 1, NULL, '2020-01-25 00:45:11', 0, 0, NULL, NULL),
(63, 300, 13280, 1, NULL, '2020-01-25 02:41:35', 0, 0, NULL, NULL),
(64, 311, 45714, 1, NULL, '2020-02-05 19:33:43', 0, 0, NULL, NULL),
(65, 311, 45484, 1, NULL, '2020-02-05 19:35:53', 0, 0, NULL, NULL),
(66, 311, 2252, 1, NULL, '2020-02-05 19:37:24', 0, 0, NULL, NULL),
(67, 311, 63966, 1, NULL, '2020-02-05 19:39:08', 0, 0, NULL, NULL),
(68, 311, 76835, 1, NULL, '2020-02-05 19:44:54', 0, 0, NULL, NULL),
(69, 311, 75576, 1, NULL, '2020-02-05 19:45:13', 0, 0, NULL, NULL),
(70, 311, 75572, 1, NULL, '2020-02-05 19:45:40', 0, 0, NULL, NULL),
(71, 311, 74234, 1, NULL, '2020-02-05 19:46:21', 0, 0, NULL, NULL),
(72, 312, 55618, 2, NULL, '2020-02-13 21:41:58', 0, 0, NULL, NULL),
(73, 316, 5207, 1, NULL, '2020-02-10 00:17:29', 0, 0, NULL, NULL),
(74, 320, 69364, 1, NULL, '2020-02-18 12:46:59', 0, 0, NULL, NULL),
(75, 324, 74472, 1, NULL, '2020-02-26 17:08:50', 0, 0, NULL, NULL),
(76, 324, 64837, 1, NULL, '2020-02-26 17:09:22', 0, 0, NULL, NULL),
(77, 331, 38641, 1, NULL, '2020-03-01 14:02:11', 0, 0, NULL, NULL),
(78, 338, 18873, 1, NULL, '2020-03-07 00:15:01', 0, 0, NULL, NULL),
(79, 346, 11686, 1, NULL, '2020-03-14 12:44:15', 0, 0, NULL, NULL),
(80, 379, 63349, 1, NULL, '2020-03-27 13:29:30', 0, 0, NULL, NULL),
(81, 379, 66050, 1, NULL, '2020-03-27 13:29:57', 0, 0, NULL, NULL),
(82, 379, 81374, 1, NULL, '2020-03-27 13:30:19', 0, 0, NULL, NULL),
(83, 379, 43497, 1, NULL, '2020-03-27 13:34:12', 0, 0, NULL, NULL),
(84, 379, 74100, 1, NULL, '2020-03-27 13:36:46', 0, 0, NULL, NULL),
(85, 379, 74106, 1, NULL, '2020-03-27 13:37:42', 0, 0, NULL, NULL),
(86, 379, 1353, 1, NULL, '2020-03-27 13:40:35', 0, 0, NULL, NULL),
(87, 379, 61661, 1, NULL, '2020-03-27 13:43:40', 0, 0, NULL, NULL),
(88, 379, 51791, 1, NULL, '2020-03-27 13:47:34', 0, 0, NULL, NULL),
(89, 379, 75681, 1, NULL, '2020-03-27 13:48:02', 0, 0, NULL, NULL),
(90, 409, 72759, 1, NULL, '2020-04-02 20:33:35', 0, 0, NULL, NULL),
(91, 416, 66058, 1, NULL, '2020-04-03 14:37:10', 0, 0, NULL, NULL),
(92, 417, 3122, 1, NULL, '2020-04-03 15:58:03', 0, 0, NULL, NULL),
(93, 417, 73534, 1, NULL, '2020-04-03 16:02:45', 0, 0, NULL, NULL),
(94, 417, 5184, 1, NULL, '2020-04-03 16:03:50', 0, 0, NULL, NULL),
(95, 417, 48945, 1, NULL, '2020-04-03 16:05:10', 0, 0, NULL, NULL),
(96, 417, 48946, 1, NULL, '2020-04-03 16:05:13', 0, 0, NULL, NULL),
(97, 429, 21146, 1, NULL, '2020-04-05 16:15:03', 0, 0, NULL, NULL),
(100, 432, 72521, 1, NULL, '2020-04-05 22:48:31', 0, 0, NULL, NULL),
(101, 432, 72257, 1, NULL, '2020-04-05 22:48:51', 0, 0, NULL, NULL),
(102, 432, 45694, 1, NULL, '2020-04-05 22:49:17', 0, 0, NULL, NULL),
(103, 432, 68347, 1, NULL, '2020-04-05 22:51:01', 0, 0, NULL, NULL),
(104, 432, 68355, 1, NULL, '2020-04-05 22:51:45', 0, 0, NULL, NULL),
(105, 432, 68352, 1, NULL, '2020-04-05 22:51:55', 0, 0, NULL, NULL),
(106, 432, 72256, 1, NULL, '2020-04-05 22:52:20', 0, 0, NULL, NULL),
(107, 432, 80483, 1, NULL, '2020-04-05 22:53:13', 0, 0, NULL, NULL),
(108, 432, 81390, 1, NULL, '2020-04-05 22:54:20', 0, 0, NULL, NULL),
(109, 432, 81392, 1, NULL, '2020-04-05 22:55:05', 0, 0, NULL, NULL),
(110, 432, 81426, 1, NULL, '2020-04-05 22:56:47', 0, 0, NULL, NULL),
(111, 432, 81860, 1, NULL, '2020-04-05 22:58:04', 0, 0, NULL, NULL),
(112, 432, 81847, 1, NULL, '2020-04-05 22:58:20', 0, 0, NULL, NULL),
(113, 112, 28379, 1, NULL, '2020-04-07 19:17:46', 0, 0, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `web_wish`
--
ALTER TABLE `web_wish`
  ADD PRIMARY KEY (`wish_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `web_wish`
--
ALTER TABLE `web_wish`
  MODIFY `wish_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;