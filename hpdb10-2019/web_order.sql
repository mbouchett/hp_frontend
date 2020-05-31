-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 11, 2020 at 10:25 AM
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
-- Table structure for table `web_order`
--

CREATE TABLE `web_order` (
  `wo_ID` int(11) NOT NULL,
  `wc_ID` int(11) NOT NULL,
  `wm_ID` int(11) NOT NULL,
  `wa_ID` int(11) NOT NULL,
  `gc_ID` int(11) DEFAULT NULL,
  `promo_ID` int(11) DEFAULT NULL,
  `wo_discount` float DEFAULT NULL,
  `wo_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `wo_ship_date` date DEFAULT NULL,
  `wo_gc_charge` float NOT NULL DEFAULT '0',
  `wo_cc_charge` float NOT NULL DEFAULT '0',
  `wo_comment` text NOT NULL,
  `wo_status` int(11) NOT NULL DEFAULT '0',
  `wo_tracking` tinytext,
  `wo_note` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `web_order`
--

INSERT INTO `web_order` (`wo_ID`, `wc_ID`, `wm_ID`, `wa_ID`, `gc_ID`, `promo_ID`, `wo_discount`, `wo_date`, `wo_ship_date`, `wo_gc_charge`, `wo_cc_charge`, `wo_comment`, `wo_status`, `wo_tracking`, `wo_note`) VALUES
(7, 17, 10, -1, 0, 0, 0, '2019-10-02 16:00:31', NULL, 0, 106.989, 'Wishing you so much happiness, love Tom and Marlene', 7, 'Item Picked Up', NULL),
(15, 18, 11, -2, 0, 0, 0, '2019-08-19 18:11:41', NULL, 0, 65.4365, '', 7, '775835924430 FedEx', NULL),
(16, 22, 12, -1, 0, 0, 0, '2019-08-20 15:01:38', NULL, 0, 106.989, 'Please apply to Lisa and Jeremy wedding registry. From Jami 805-801-3743', 7, 'On Hold At The Store', NULL),
(23, 25, 23, -2, 0, 0, 0, '2019-08-19 18:11:26', NULL, 0, 81.5186, '', 7, 'USPS 9505 5130 7277 9170 1908 91', NULL),
(24, 26, 24, -1, 0, 0, 0, '2019-08-19 19:15:15', NULL, 0, 171.179, 'Would like to pick up today. 802-490-6176.', 7, 'Pickup @ Warehouse -MB', NULL),
(29, 47, 35, -2, 0, 0, 0, '2019-08-19 18:12:07', NULL, 0, 377.834, '', 7, 'Cancelled', NULL),
(30, 48, 38, -2, 0, 0, 0, '2019-12-06 18:33:24', NULL, 0, 97.5686, '', 7, NULL, NULL),
(31, 54, 40, 46, 0, 0, 0, '2019-08-19 18:11:18', NULL, 0, 54.7686, 'Make the shipping label out to Mona Munshi. ', 7, 'FedEx 775750229234 ', NULL),
(32, 55, 41, 47, 0, 0, 0, '2019-08-19 17:33:11', NULL, 0, 37.67, '', 7, 'USPS 9405503699300065837473', NULL),
(33, 59, 43, -1, 0, 0, 0, '2019-12-06 18:33:33', NULL, 0, 15.9216, '', 7, 'On Hold At The Store', NULL),
(34, 70, 44, -2, 0, 0, 0, '2019-08-23 21:23:58', NULL, 0, 86.8793, '', 7, 'Item Picked Up 8/23/2019', NULL),
(36, 74, 46, -1, 0, 0, 0, '2019-08-20 14:47:04', NULL, 0, 125, 'This is a gift for Megan Fariel, 24 E. Avenue, Burlington, VT 05401', 7, 'On Hold At The Store', NULL),
(37, 77, 47, -2, 0, 0, 0, '2019-08-19 17:32:58', NULL, 0, 82.4816, '', 7, 'FedEx 775920452848', NULL),
(38, 80, 48, -2, 0, 0, 0, '2019-08-19 17:27:50', NULL, 0, 24.8193, '', 7, 'USPS 9405503699300077828766', NULL),
(39, 81, 49, -1, 0, 0, 0, '2019-09-25 15:00:50', NULL, 0, 100, 'Giftcard is being purchased for Thomas Anderson-Monterosso and he will be the one picking it up.', 7, 'Item Picked Up', NULL),
(41, 84, 53, -1, 0, 0, 0, '2019-08-19 21:05:58', NULL, 0, 110, '', 7, 'Cancelled', NULL),
(45, 87, 56, -2, 0, 0, 0, '2019-08-19 17:27:43', NULL, 0, 48.3486, '', 7, 'USPS 9405503699300083481337', NULL),
(46, 89, 58, -1, 0, 2, 47.8, '2019-08-23 21:24:30', NULL, 0, 194.546, '', 7, 'Item Picked Up 8/23/2019', NULL),
(47, 88, 59, -1, 0, 2, 71.992, '2019-09-19 17:43:54', NULL, 0, 293.007, '', 7, 'Out of Stock / Items Discontinued', NULL),
(48, 94, 63, 58, 0, 0, 0, '2019-08-23 18:44:58', NULL, 0, 140.369, '', 7, 'File Refered', NULL),
(49, 95, 64, 59, 0, 0, 0, '2019-08-23 21:25:45', NULL, 0, 16.2593, '', 7, 'USPS 9405503699300088815762', NULL),
(50, 98, 66, -1, 0, 0, 0, '2019-09-25 15:02:01', NULL, 0, 212.93, '', 7, 'Item Picked Up 2019-08-10', NULL),
(51, 99, 67, -1, 0, 0, 0, '2019-08-23 21:24:48', NULL, 0, 405.53, '', 7, 'Item Picked Up 8/23/2019', NULL),
(52, 94, 63, 58, 0, 0, 0, '2019-08-23 18:45:19', NULL, 0, 418.579, '', 7, 'File Refered', NULL),
(53, 103, 69, -1, 0, 0, 0, '2019-09-19 17:42:48', NULL, 0, 32.0465, '', 7, 'USPS 9405503699300099811340', NULL),
(55, 105, 70, -1, 0, 0, 0, '2019-09-25 15:02:24', NULL, 0, 250, 'Please hold for Madeline Graham to pick up. Any questions, please call me at 203-414-5933.  Thanks!', 7, 'Item Picked Up', NULL),
(56, 106, 71, -1, 0, 0, 0, '2019-09-19 17:43:33', NULL, 0, 21.3893, '', 7, 'USPS 9405503699300106643483', NULL),
(57, 118, 74, -2, 0, 0, 0, '2019-09-25 14:58:47', NULL, 0, 71.8565, '', 7, 'Order Canceled', NULL),
(58, 124, 75, -2, 0, 0, 0, '2019-10-02 15:57:06', NULL, 0, 86.8793, '', 7, 'FedEx. tracking number: 776321246800', NULL),
(59, 125, 76, 63, 0, 0, 0, '2019-10-02 15:57:34', NULL, 0, 108.258, '', 7, 'FedEx tracking number: 776321495446', NULL),
(60, 40, 34, 64, 0, 0, 0, '2019-10-02 15:59:07', NULL, 0, 86.8793, '', 7, 'No Payment Method', NULL),
(61, 109, 79, 65, 0, 0, 0, '2019-10-02 15:53:38', NULL, 0, 33.3793, '', 7, 'Out of Stock / Items Discontinued', NULL),
(62, 80, 80, -2, 0, 0, 0, '2019-10-02 15:53:49', NULL, 0, 37.6486, '', 7, 'Out of Stock / Items Discontinued', NULL),
(63, 129, 81, -1, 0, 0, 0, '2019-10-02 15:53:24', NULL, 0, 85.5893, '', 7, 'Payment Issue', NULL),
(64, 129, 81, -1, 0, 0, 0, '2019-10-02 15:53:07', NULL, 0, 400, '', 7, 'Payment Issue', NULL),
(65, 130, 83, 66, 0, 0, 0, '2019-10-02 15:58:30', NULL, 0, 26.9486, '', 7, 'USPS: 9405503699300124942179', NULL),
(66, 133, 86, -2, 0, 0, 0, '2019-10-24 16:13:25', NULL, 0, 31.2286, '', 7, 'USPS Tracking # : 9405 5036 9930 0143 5068 71', NULL),
(67, 136, 88, 70, 0, 0, 0, '2019-10-11 16:19:30', NULL, 0, 24.8193, '', 7, 'USPS - 9405503699300130964257', NULL),
(68, 138, 89, -1, 0, 0, 0, '2019-10-14 16:06:30', NULL, 0, 0, '', 7, 'Please Check Email', NULL),
(72, 139, 90, -2, 0, 0, 0, '2019-12-17 18:13:59', NULL, 0, 176.706, '', 7, '', NULL),
(73, 141, 91, 71, 0, 0, 0, '2019-10-21 16:30:33', NULL, 0, 38.7293, 'Please include gift receipt.', 7, 'FedEx tracking number: 776705522426', NULL),
(74, 142, 92, 72, 0, 0, 0, '2019-10-21 16:07:53', NULL, 0, 18.3993, '', 7, 'USPS Tracking # :9405503699300137440181', NULL),
(75, 143, 93, -2, 0, 0, 0, '2019-10-23 15:16:36', NULL, 0, 18.3993, '', 7, 'USPS Tracking #: 9405503699300140930969', NULL),
(76, 144, 94, -2, 0, 0, 0, '2019-10-30 17:44:03', NULL, 0, 49.4293, '', 7, 'USPS Tracking # : 9405503699300148065847', NULL),
(77, 145, 96, 73, 0, 0, 0, '2019-10-23 15:16:04', NULL, 0, 64.4093, '', 7, 'USPS Tracking # :9405 5036 9930 0143 5068 88', NULL),
(78, 155, 99, -2, 0, 0, 0, '2019-10-31 16:12:00', NULL, 0, 25.8893, '', 7, 'Out of Stock / Items Discontinued', NULL),
(79, 161, 100, -2, 0, 0, 0, '2019-11-18 17:54:17', NULL, 0, 45.053, '', 7, 'FedEx Tracking #: 776937898897', NULL),
(80, 164, 101, 74, 0, 0, 0, '2019-11-15 16:31:05', NULL, 0, 103.5, '', 7, 'No Tracking # sent through USPS', NULL),
(81, 168, 102, 75, 0, 0, 0, '2019-11-20 15:21:14', NULL, 0, 49.4293, 'Shipping Method does not seem to allow me to specify more than the address. Please ship for delivery Friday11/15. Call me at 802-777-2513 if you have a question.', 7, NULL, NULL),
(82, 168, 102, -2, 0, 0, 0, '2019-11-20 15:21:03', NULL, 0, 70.8293, '', 7, NULL, NULL),
(83, 171, 104, -2, 0, 0, 0, '2019-11-22 17:05:16', NULL, 0, 17.3293, '', 7, 'USPS Tracking #: 9405503699300168724229', NULL),
(84, 171, 104, -2, 0, 0, 0, '2019-11-19 15:15:20', NULL, 0, 17.3293, '', 7, 'Will only ship one as discussed in email', NULL),
(85, 172, 105, -1, 0, 0, 0, '2019-11-25 18:54:01', NULL, 0, 60.9579, '', 7, 'Items on Hold at Store', NULL),
(86, 173, 106, -2, 0, 0, 0, '2019-11-22 17:05:52', NULL, 0, 76.1793, '', 7, NULL, NULL),
(87, 174, 107, -2, 0, 0, 0, '2019-11-19 15:14:58', NULL, 0, 20.5286, '', 7, 'Payment Issue', NULL),
(88, 175, 108, -2, 0, 0, 0, '2019-11-22 17:05:56', NULL, 0, 41.9179, '', 7, NULL, NULL),
(89, 176, 109, -2, 0, 0, 0, '2019-11-20 15:19:50', NULL, 0, 31.1858, 'Please include a variety of transparent half masks if multiple types are in stock :)', 7, 'Out of Stock / Items Discontinued', NULL),
(90, 177, 110, -2, 0, 0, 0, '2019-11-27 15:15:18', NULL, 0, 3.5, '', 7, 'Empty Order', NULL),
(91, 177, 110, -2, 0, 0, 0, '2019-11-22 17:05:43', NULL, 0, 32.2986, '', 7, 'USPS Tracking #: 9405503699300170193372', NULL),
(92, 178, 111, -2, 0, 0, 0, '2019-11-25 16:44:32', NULL, 0, 37.6486, '', 7, 'USPS Tracking #: 9405503699300172111695', NULL),
(93, 177, 112, -2, 0, 0, 0, '2019-11-25 16:44:28', NULL, 0, 26.9593, '', 7, 'USPS Tracking #: 9405503699300172180769', NULL),
(94, 179, 113, -1, 0, 0, 0, '2019-11-25 17:53:20', NULL, 0, 33.1058, '', 7, 'Duplicate Order', NULL),
(95, 179, 113, -1, 0, 0, 0, '2019-11-25 17:53:57', NULL, 0, 33.1058, '', 7, 'Items at front register', NULL),
(96, 181, 114, -2, 0, 0, 0, '2019-11-25 17:56:18', NULL, 0, 46.2193, '', 7, 'Out of Stock / Items Discontinued', NULL),
(97, 185, 116, -2, 0, 0, 0, '2019-11-26 15:56:07', NULL, 0, 52.1364, '', 7, 'Fedex Tracking #: 777071929246', NULL),
(98, 9, 18, 24, 0, 0, 0, '2019-11-27 15:14:45', NULL, 0, 44.0793, '', 7, 'System Test', NULL),
(99, 187, 118, -2, 0, 0, 0, '2019-11-27 15:37:18', NULL, 0, 44.0793, '', 7, 'Item out of stock / suggested replacements emailed', NULL),
(100, 187, 118, -2, 0, 0, 0, '2019-11-26 15:55:18', NULL, 0, 44.0793, '', 7, 'Order Cancelled', NULL),
(101, 188, 119, -2, 0, 0, 0, '2019-11-27 15:13:31', NULL, 0, 12.632, '', 7, 'System Test', NULL),
(102, 188, 119, -1, 0, 0, 0, '2019-11-27 15:14:18', NULL, 0, 298.53, '', 7, 'System Test', NULL),
(103, 188, 119, -1, 0, 0, 0, '2019-11-27 15:14:27', NULL, 0, 298.53, '', 7, 'System Test', NULL),
(104, 188, 119, -1, 0, 0, 0, '2019-11-27 15:14:35', NULL, 0, 298.53, '', 7, 'System Test', NULL),
(105, 188, 119, -2, 0, 0, 0, '2019-11-27 15:14:08', NULL, 0, 11.99, '', 7, 'System Test', NULL),
(106, 188, 119, -2, 0, 0, 0, '2019-11-27 15:13:55', NULL, 0, 11.99, '', 7, 'System Test', NULL),
(107, 188, 119, -1, 0, 0, 0, '2019-11-27 15:13:46', NULL, 0, 298.53, '', 7, 'System Test', NULL),
(108, 188, 119, -1, 0, 0, 0, '2019-11-27 15:13:38', NULL, 0, 0.642, '', 7, 'System Test', NULL),
(109, 189, 120, -1, 0, 0, 0, '2019-12-03 16:12:05', NULL, 0, 18.1793, '', 7, NULL, NULL),
(110, 192, 123, -1, 0, 6, 11.396, '2019-12-03 15:06:27', NULL, 0, 46.3817, '', 7, 'Items on Hold at Store', NULL),
(111, 191, 126, -1, 0, 6, 11.188, '2019-12-09 17:11:45', NULL, 0, 45.5352, '', 7, 'Items on Hold at Store', NULL),
(112, 197, 127, -2, 0, 6, 14.998, '2019-12-10 17:43:35', NULL, 0, 73.0319, '', 7, 'FedEx Tracking #: 777146224979', NULL),
(113, 198, 128, -2, 0, 0, 0, '2019-12-09 18:20:36', NULL, 0, 61.1565, '', 7, 'USPS Tracking #: 9405503699300180812973', NULL),
(114, 200, 130, -1, 0, 6, 59.8, '2019-12-09 17:11:38', NULL, 0, 243.386, 'I will pick up in Burlington.', 7, 'Items on Hold at Store', NULL),
(115, 201, 131, -2, 0, 0, 0, '2019-12-02 17:14:38', NULL, 0, 69.7058, '', 7, 'Out of Stock / Items Discontinued', NULL),
(116, 204, 133, -2, 0, 0, 0, '2019-12-09 16:09:59', NULL, 0, 98.5958, '', 7, 'FedEx Tracking #: 7771 7027 6444', NULL),
(117, 206, 134, -1, 0, 0, 0, '2019-12-09 17:11:33', NULL, 0, 22.6412, '', 7, 'On hold at store', NULL),
(118, 208, 135, -1, 0, 6, 0, '2019-12-10 17:43:47', NULL, 0, 97.5472, '', 7, 'Items on Hold at Store', NULL),
(119, 207, 136, 79, 0, 6, 23.98, '2019-12-09 16:09:31', NULL, 0, 31.18, '', 7, 'USPS Tracking #:  9405503699300183773264', NULL),
(120, 211, 137, -2, 0, 0, 0, '2019-12-09 16:05:26', NULL, 0, 37.6486, '', 7, 'Item out of stock', NULL),
(121, 211, 137, -2, 0, 0, 0, '2019-12-09 16:05:21', NULL, 0, 37.6486, '', 7, 'Item out of stock', NULL),
(122, 213, 138, -2, 0, 0, 0, '2019-12-09 17:43:15', NULL, 0, 28.5, '', 7, 'Shipped through USPS Standard mail', NULL),
(123, 214, 139, -2, 0, 0, 0, '2019-12-09 16:01:13', NULL, 0, 44.0793, '', 7, 'Item out of stock', NULL),
(124, 215, 140, -2, 0, 0, 0, '2019-12-12 16:07:24', NULL, 0, 38.7293, '', 7, 'USPS Tracking #: 9405503699300187584576', NULL),
(125, 216, 141, -2, 0, 0, 0, '2019-12-09 15:37:39', NULL, 0, 35.5193, '', 7, 'Incorrect Card Number', NULL),
(126, 217, 142, -2, 0, 0, 0, '2019-12-13 15:21:42', NULL, 0, 18.3993, '', 7, 'USPS Tracking #: 9405 5036 9930 0187 8576 94', NULL),
(127, 218, 143, -2, 0, 0, 0, '2019-12-16 16:36:30', NULL, 0, 20.5393, '', 7, 'USPS Tracking #: 9405 5036 9930 0191 7460 38', NULL),
(128, 221, 144, -2, 0, 0, 0, '2019-12-11 16:48:39', NULL, 0, 53.5, '', 7, 'Shipped through USPS Standard mail', NULL),
(129, 222, 145, 80, 0, 0, 0, '2019-12-16 16:36:32', NULL, 0, 33.3686, '', 7, 'USPS Tracking #: 9405 5036 9930 0191 6070 25', NULL),
(130, 223, 146, -1, 0, 4, 27.988, '2019-12-11 16:48:22', NULL, 0, 113.911, '', 7, 'Items on Hold at Store', NULL),
(131, 225, 148, -2, 0, 0, 0, '2019-12-11 18:42:57', NULL, 0, 103.5, '', 7, 'Shipped through USPS Standard mail', NULL),
(132, 227, 149, 81, 0, 0, 0, '2019-12-16 16:36:36', NULL, 0, 49.4079, '', 7, 'USPS Tracking #: 9405503699300193305066', NULL),
(133, 228, 150, -2, 0, 0, 0, '2019-12-16 16:32:27', NULL, 0, 31.2286, '', 7, 'Shipped through USPS Standard mail', NULL),
(134, 229, 151, -1, 0, 0, 0, '2019-12-16 16:32:41', NULL, 0, 8.5386, 'Will pick up between 12/19 - 21.  The shipping price was way too high!!!', 7, 'Items on hold at store', NULL),
(135, 232, 152, -2, 0, 0, 0, '2019-12-16 16:36:41', NULL, 0, 32.3093, '', 7, 'USPS Tracking #: 9405 5036 9930 0198 9496 61', NULL),
(136, 235, 154, -2, 0, 0, 0, '2019-12-16 17:26:38', NULL, 0, 53.5, '', 7, 'Shipped through USPS Standard mail', NULL),
(137, 216, 156, 84, 0, 0, 0, '2019-12-19 18:43:16', NULL, 0, 35.5193, '', 7, 'USPS Tracking #: 9405503699300201926436', NULL),
(138, 239, 159, -2, 0, 0, 0, '2019-12-19 18:43:22', NULL, 0, 28.5, '', 7, 'Shipped through USPS Standard mail', NULL),
(139, 240, 160, -1, 0, 0, 0, '2020-03-31 17:19:48', NULL, 0, 47.3475, '', 3, 'Picked up some waiting for more', NULL),
(140, 243, 161, -2, 0, 0, 0, '2019-12-19 18:43:26', NULL, 0, 53.5, '', 7, 'Shipped through USPS Standard mail', NULL),
(141, 244, 162, -2, 0, 0, 0, '2019-12-19 18:46:29', NULL, 0, 224.92, '', 7, 'Items awaiting pick up', NULL),
(142, 236, 155, 83, 0, 0, 0, '2019-12-19 18:43:29', NULL, 0, 203.5, '', 7, 'Shipped through USPS Standard mail', NULL),
(143, 248, 163, -1, 0, 0, 0, '2020-01-07 17:45:50', NULL, 0, 100, '', 7, 'On Hold At Store', NULL),
(144, 249, 164, -1, 0, 0, 0, '2019-12-30 15:53:11', NULL, 0, 200, '', 7, 'On hold at store', NULL),
(145, 251, 166, 86, 0, 0, 0, '2019-12-30 16:48:14', NULL, 0, 13.5, '', 7, NULL, NULL),
(146, 250, 165, 85, 0, 0, 0, '2019-12-23 18:54:49', NULL, 0, 3.5, '', 7, NULL, NULL),
(147, 252, 167, 87, 0, 0, 0, '2019-12-30 16:48:19', NULL, 0, 53.5, '', 7, NULL, NULL),
(148, 256, 168, -2, 0, 0, 0, '2019-12-30 16:48:23', NULL, 0, 203.5, '', 7, NULL, NULL),
(149, 257, 169, -1, 0, 0, 0, '2020-01-07 17:45:57', NULL, 0, 150, '', 7, 'Items on hold at store', NULL),
(150, 259, 170, -2, 0, 0, 0, '2020-01-06 16:46:10', NULL, 0, 50.4779, '', 7, 'Shipped through USPS: 9405503699300218999706', NULL),
(151, 260, 171, -1, 0, 0, 0, '2020-01-07 17:46:02', NULL, 0, 50, 'This is a gift for Ayla Yandow.', 7, NULL, NULL),
(152, 261, 172, -2, 0, 0, 0, '2020-01-06 16:46:07', NULL, 0, 33.3686, '', 7, 'USPS Tracking #: 940550369930021656057', NULL),
(153, 266, 173, -2, 0, 0, 0, '2020-01-06 16:46:02', NULL, 0, 20.5286, '', 7, 'USPS Tracking #: 9405503699300217646854', NULL),
(154, 227, 149, -2, 0, 0, 0, '2020-01-06 16:45:59', NULL, 0, 92.1865, '', 7, 'USPS Tracking #:9405503699300217695166', NULL),
(155, 271, 176, -2, 0, 0, 0, '2020-01-07 17:34:40', NULL, 0, 140.379, '', 7, 'Item on hold at store', NULL),
(156, 275, 177, -2, 0, 0, 0, '2020-01-06 16:45:55', NULL, 0, 28.0293, '', 7, 'USPS Tracking #: 9405 5036 9930 0219 8002 92', NULL),
(157, 277, 178, -1, 0, 0, 0, '2020-01-07 17:50:07', NULL, 0, 139.089, '', 7, 'Item on hold at store', NULL),
(158, 278, 179, 90, 0, 0, 0, '2020-01-08 18:20:10', NULL, 0, 397.147, '', 7, 'Please Check Email', NULL),
(159, 284, 183, -2, 0, 0, 0, '2020-01-21 15:06:34', NULL, 0, 26.9486, '', 7, 'USPS Tracking #: 9405 5036 9930 0234 0065 56', NULL),
(160, 291, 185, -2, 0, 0, 0, '2020-01-17 17:16:30', NULL, 0, 76.1686, '', 7, 'USPS Tracking #: 9405 8036 9930 0757 1450 23', NULL),
(161, 297, 187, -2, 0, 0, 0, '2020-01-28 17:06:46', NULL, 0, 33.3793, '', 7, 'USPS Tracking #: 9405 5036 9930 0234 9416 66', NULL),
(162, 302, 189, -2, 0, 0, 0, '2020-02-05 17:17:30', NULL, 0, 29.0993, '', 7, 'USPS Tracking #: 9405 5036 9930 0241 5018 08', NULL),
(163, 305, 191, -1, 1985, 0, 0, '2020-02-02 13:43:52', NULL, 40, 131.189, '', 7, 'Order Cancelled ', NULL),
(164, 306, 192, 92, 0, 0, 0, '2020-02-05 17:17:34', NULL, 0, 140.283, '', 7, 'FedEx Racking #:  777668396821', NULL),
(165, 308, 195, -2, 0, 0, 0, '2020-02-04 18:58:33', NULL, 0, 76.1793, '', 7, 'Please Check Email', NULL),
(166, 313, 197, -1, 0, 0, 0, '2020-03-31 20:40:48', NULL, 0, 128.368, '', 7, NULL, NULL),
(167, 314, 198, -2, 0, 0, 0, '2020-02-15 05:53:53', NULL, 0, 24.8086, '', 7, NULL, NULL),
(168, 317, 198, -2, 0, 0, 0, '2020-02-18 17:58:11', NULL, 0, 65.4793, '', 7, 'Please Check Email', NULL),
(169, 319, 199, -1, 0, 0, 0, '2020-02-18 17:58:06', NULL, 0, 29.9172, 'I&#039;D LIKE TO USE A GIFT CARD FOR PAYMENT, BUT CANNOT FIGURE OUT HOW TO DO SO ONLINE.', 7, 'Items Not in Stock', NULL),
(170, 321, 200, -2, 0, 0, 0, '2020-03-03 17:04:28', NULL, 0, 159.247, '', 7, NULL, NULL),
(171, 325, 202, -2, 0, 0, 0, '2020-03-03 17:04:30', NULL, 0, 22.6686, '', 7, NULL, NULL),
(172, 328, 203, -2, 0, 0, 0, '2020-03-03 17:04:32', NULL, 0, 30.1693, '', 7, NULL, NULL),
(173, 329, 204, -1, 0, 0, 0, '2020-03-26 19:30:56', NULL, 0, 106.989, '', 3, 'On Hold At Store', NULL),
(174, 333, 206, -1, 0, 0, 0, '2020-03-26 19:30:48', NULL, 0, 16.0393, '', 3, 'On Hold At Store', NULL),
(175, 135, 87, 69, 0, 0, 0, '2020-03-03 17:04:34', NULL, 0, 88.8873, '', 7, NULL, NULL),
(176, 334, 207, -1, 0, 0, 0, '2020-03-05 17:50:47', NULL, 0, 6.4093, '', 7, NULL, NULL),
(177, 334, 207, -2, 0, 0, 0, '2020-03-05 15:14:41', NULL, 0, 11.99, '', 7, NULL, NULL),
(178, 334, 207, -2, 0, 0, 0, '2020-03-05 15:14:42', NULL, 0, 11.99, '', 7, NULL, NULL),
(179, 334, 207, -2, 0, 0, 0, '2020-03-12 15:55:47', NULL, 0, 18.3993, '', 7, NULL, NULL),
(180, 335, 208, -2, 0, 0, 0, '2020-03-09 15:32:12', NULL, 0, 95.2119, '', 7, NULL, NULL),
(181, 336, 209, -1, 0, 0, 0, '2020-03-08 15:30:49', NULL, 0, 51.3172, '', 7, 'temporarily out of stock', NULL),
(182, 337, 210, -1, 0, 0, 0, '2020-03-09 15:32:08', NULL, 0, 0, '', 7, NULL, NULL),
(183, 337, 210, -1, 0, 0, 0, '2020-03-09 15:32:01', NULL, 0, 0, '', 7, NULL, NULL),
(184, 337, 210, -1, 0, 0, 0, '2020-03-09 15:32:04', NULL, 0, 0, 'did this order for three items go through', 7, NULL, NULL),
(185, 337, 210, -1, 0, 0, 0, '2020-03-09 15:31:58', NULL, 0, 0, 'did this order for three items go through', 7, NULL, NULL),
(186, 339, 211, 96, 0, 0, 0, '2020-03-09 15:29:32', NULL, 0, 69.7058, '', 7, NULL, NULL),
(187, 340, 212, -2, 0, 0, 0, '2020-03-12 15:55:39', NULL, 0, 88.773, '', 7, NULL, NULL),
(188, 341, 213, -2, 0, 0, 0, '2020-03-12 15:55:43', NULL, 0, 28.0293, '', 7, NULL, NULL),
(189, 343, 214, 97, 0, 0, 0, '2020-03-16 17:33:53', NULL, 0, 146.558, '', 7, NULL, NULL),
(190, 344, 215, 99, 0, 0, 0, '2020-03-12 15:39:38', NULL, 0, 150.25, '', 7, NULL, NULL),
(191, 345, 216, -2, 0, 0, 0, '2020-03-12 15:55:36', NULL, 0, 22.6793, '', 7, NULL, NULL),
(192, 348, 218, -1, 0, 0, 0, '2020-03-26 19:29:57', NULL, 0, 588.489, 'Per telephone conversation, this will be shipped to Tyler Antrim and Tara Flor, L16 Stonehedge Drive, South Burlington, VT 05403\r\n\r\nThank you.', 3, 'On Hold At Store', NULL),
(193, 355, 223, -2, 0, 0, 0, '2020-03-26 19:14:25', NULL, 0, 102.709, '', 7, 'FedEx: 770112007213', NULL),
(194, 357, 224, -2, 0, 0, 0, '2020-03-25 20:03:57', NULL, 0, 31.2393, '', 7, 'USPS:9405 5036 9930 0296 0974 86', NULL),
(195, 361, 226, -2, 0, 0, 0, '2020-03-25 18:30:41', NULL, 0, 59.0486, '', 7, ' 770103073724', NULL),
(196, 362, 227, -2, 0, 0, 0, '2020-03-26 14:44:24', NULL, 0, 35.5193, '', 1, 'R', NULL),
(197, 359, 225, -1, 0, 0, 0, '2020-03-26 19:30:29', NULL, 0, 11.556, '', 7, 'Picked Up 3-25-20', NULL),
(198, 359, 225, -2, 0, 0, 0, '2020-03-23 04:08:52', NULL, 0, 11.99, '', 7, NULL, NULL),
(199, 365, 228, 101, 0, 0, 0, '2020-03-25 17:57:43', NULL, 0, 44.0686, '', 7, '770102573423', NULL),
(200, 366, 229, -1, 0, 0, 0, '2020-03-26 15:05:51', NULL, 0, 2230.92, 'My friend Chris will pick these items up tomorrow. Please let me know if he should come to the store or warehouse. Please send a beige papason pillow.\r\n917.805.0437. Thanks so much- jennifer', 7, 'Picked Up 3-25-20', NULL),
(201, 367, 230, 102, 0, 0, 0, '2020-03-31 17:13:28', NULL, 0, 19.4586, '', 5, 'USPS:9405503699300303488313', NULL),
(202, 368, 231, -1, 0, 0, 0, '2020-03-26 14:40:35', NULL, 0, 58.6895, '', 7, 'FedEx: 770104664847', NULL),
(203, 369, 232, 103, 0, 0, 0, '2020-03-26 20:10:00', NULL, 0, 54.7726, '', 7, 'FedEx: 770113584440', NULL),
(204, 370, 233, -2, 0, 0, 0, '2020-03-26 20:18:33', NULL, 0, 46.1444, '', 7, 'FedEx: 770113882618', NULL),
(205, 371, 235, 104, 0, 0, 0, '2020-03-26 20:40:34', NULL, 0, 151.865, '', 6, 'FedEx: 770114099309', NULL),
(206, 372, 236, -1, 0, 0, 0, '2020-03-26 14:51:16', NULL, 0, 79.1372, '', 7, 'On Hold At Back', NULL),
(207, 373, 237, -2, 0, 0, 0, '2020-03-30 18:34:44', NULL, 0, 88.8873, '', 5, 'FedEx: 770132573871', NULL),
(208, 380, 239, -1, 0, 0, 0, '2020-03-28 19:36:47', NULL, 0, 85.5893, '', 7, 'Picked Up', NULL),
(212, 383, 241, -1, 0, 0, 0, '2020-03-31 20:40:22', NULL, 0, 43.8486, '', 3, 'On hold at back door', NULL),
(213, 384, 242, -1, 0, 0, 0, '2020-03-30 18:22:12', NULL, 0, 10.6893, '', 7, 'Picked Up 3-30-2020', NULL),
(214, 385, 243, 106, 0, 0, 0, '2020-04-01 16:19:18', NULL, 0, 35.5193, '', 7, 'Received', NULL),
(215, 386, 244, -1, 0, 0, 0, '2020-04-03 20:51:45', NULL, 0, 139.079, '', 7, 'Picked Up 4-1-2020', NULL),
(216, 388, 245, 107, 0, 0, 0, '2020-04-01 16:17:54', NULL, 0, 46.1979, 'This is a Birthday present for Brooke Bishop. I have included her address in the shipping information (but couldn&#039;t include her name in the shipping information). Please wrap nicely. Feel free to call me at 719-238-2956 if you have any questions. Thank you! -Kara Fauth', 5, 'USPS:9405 5036 9930 0304 9714 32', NULL),
(217, 389, 246, -1, 0, 0, 0, '2020-04-01 19:44:48', NULL, 0, 74.8037, '', 7, 'On hold at back door', NULL),
(218, 390, 247, -1, 0, 0, 0, '2020-03-30 18:25:48', NULL, 0, 106.989, '', 7, 'Picked Up 3-30-2020', NULL),
(219, 391, 248, -1, 0, 0, 0, '2020-04-01 20:59:32', NULL, 0, 369.096, 'Hi - Thank you for this service.  Saw a great neighbor posting on FPF about it.  Since we can&#039;t view items, I assume return policy is generous (time wise) - e.g. if the clip ons work on the spot we have designated.  Also, are both alarm clocks plug in (desired; don&#039;t want batteries).  Thanks!', 3, 'On hold at back door', NULL),
(220, 393, 249, -1, 0, 0, 0, '2020-04-01 21:03:24', NULL, 0, 48.1286, '', 7, 'On hold at back door', NULL),
(221, 399, 252, -1, 0, 0, 0, '2020-04-01 18:09:48', NULL, 0, 43.1745, '', 3, NULL, NULL),
(222, 401, 254, -2, 0, 0, 0, '2020-04-01 18:43:20', NULL, 0, 23.7386, '', 5, 'USPS:9405503699300305470644', NULL),
(223, 402, 255, -1, 0, 0, 0, '2020-04-03 20:50:54', NULL, 0, 20.3086, '', 7, 'Cancelled', NULL),
(224, 403, 256, -1, 0, 0, 0, '2020-04-01 17:07:50', NULL, 0, 36.3479, '', 3, 'On hold at back door', NULL),
(225, 407, 259, -1, 0, 0, 0, '2020-04-02 16:28:12', NULL, 0, 81.2772, '', 3, 'On hold at back door', NULL),
(226, 406, 262, -2, 0, 0, 0, '2020-04-02 15:41:37', NULL, 0, 96.9759, '', 5, 'FedEx: 770158239488', NULL),
(227, 409, 260, 111, 0, 0, 0, '2020-04-03 20:40:46', NULL, 0, 97.7138, '', 7, 'Send Via Uber', NULL),
(228, 410, 263, -1, 0, 0, 0, '2020-04-02 16:41:20', NULL, 0, 32.0893, '', 3, 'On hold at back door', NULL),
(229, 411, 264, -1, 0, 0, 0, '2020-04-03 17:16:20', NULL, 0, 88.7565, '', 3, 'On hold at back door', NULL),
(230, 412, 265, -2, 0, 0, 0, '2020-04-07 14:52:58', NULL, 0, 283.076, 'Hi Betty!! ', 5, 'FedEx: 770173028030', NULL),
(232, 400, 253, -1, 0, 0, 0, '2020-04-04 15:12:41', NULL, 0, 13.8993, '', 3, 'On hold at back door', NULL),
(233, 417, 267, -1, 0, 0, 0, '2020-04-10 20:04:30', NULL, 0, 19.2386, '', 7, 'Picked Up 04-10-20', NULL),
(236, 419, 268, -2, 0, 0, 0, '2020-04-04 15:29:44', NULL, 0, 3.5, 'Please ship to:\r\nFinn, Jack, and Reid Wells\r\n69 Woodcrest Circle\r\nMilton, VT 05468', 5, 'Tracking number: 770172956689', NULL),
(237, 421, 269, -1, 0, 0, 0, '2020-04-07 14:53:48', NULL, 0, 59.8879, '', 3, 'On hold at back door', NULL),
(238, 422, 270, -1, 0, 0, 0, '2020-04-04 14:41:32', NULL, 0, 71.6686, '', 3, 'Items on hold at back door', NULL),
(239, 424, 271, -1, 0, 0, 0, '2020-04-06 17:30:32', NULL, 0, 115.485, '', 3, 'On hold at back door', NULL),
(240, 426, 272, -2, 0, 0, 0, '2020-04-07 15:08:58', NULL, 0, 107.925, '', 0, 'Waiting for Response', NULL),
(241, 423, 275, -2, 0, 0, 0, '2020-04-07 17:53:23', NULL, 0, 39.7779, '', 5, 'USPS:9405503699300315711737', NULL),
(242, 404, 277, -1, 0, 0, 0, '2020-04-07 16:38:23', NULL, 0, 32.0679, 'Please do NOT blow up balloons. Thank you.', 3, 'On Hold At Backdoor', NULL),
(243, 430, 278, 113, 0, 0, 0, '2020-04-07 16:53:57', NULL, 0, 46.2086, '', 0, 'Waiting for Response', NULL),
(244, 432, 280, -1, 0, 0, 0, '2020-04-08 16:04:45', NULL, 0, 66.3079, '', 3, 'On hold at back door', NULL),
(246, 437, 282, -1, 0, 0, 0, '2020-04-08 15:04:47', NULL, 0, 70.5879, '', 3, 'Waiting for Response', NULL),
(247, 441, 284, -1, 0, 0, 0, '2020-04-07 16:39:49', NULL, 0, 74.8893, '1 Girl Gender Basket, 2 Boy/Neutral Gender Baskets', 3, 'Francois  is putting it together', NULL),
(248, 442, 286, -1, 0, 0, 0, '2020-04-07 16:50:35', NULL, 0, 106.979, '', 7, 'On hold at back door', NULL),
(250, 443, 287, -1, 0, 0, 0, '2020-04-07 19:37:32', NULL, 0, 74.8786, '', 3, 'On Hold At Backdoor', NULL),
(251, 440, 283, -1, 0, 0, 0, '2020-04-07 14:59:56', NULL, 0, 16.0393, 'My Home Phone: 660-2675 ', 3, 'On hold at back door', NULL),
(252, 378, 288, -1, 0, 0, 0, '2020-04-07 19:41:33', NULL, 0, 106.989, '', 3, 'On Hold At Backdoor', NULL),
(253, 444, 289, -2, 0, 0, 0, '2020-04-10 20:13:04', NULL, 0, 1129.27, '', 1, 'Preparing Shipment -Mark', NULL),
(254, 445, 290, -2, 0, 0, 0, '2020-04-10 17:44:25', NULL, 0, 31.2393, '', 5, 'Local Delivery', NULL),
(256, 446, 292, -1, 0, 0, 0, '2020-04-08 21:16:07', NULL, 0, 74.7716, 'Will probably pick up on Thursday (4/9)', 3, 'On Hold At Backdoor', NULL),
(257, 447, 293, -1, 0, 0, 0, '2020-04-08 15:12:50', NULL, 0, 16.0393, '', 3, 'On hold at back door', NULL),
(258, 448, 294, -2, 0, 0, 0, '2020-04-08 20:07:31', NULL, 0, 49.9429, 'Please use a pink and purple theme for the basket. This is for a 3.5 year old little girl. Thanks!', 5, 'FedEx: 770200866030', NULL),
(259, 451, 296, -1, 0, 0, 0, '2020-04-08 18:58:06', NULL, 0, 32.0893, 'For a girl, blue and purples and if available the pop rocks candybar. ', 3, 'On hold at back door', NULL),
(260, 452, 297, -2, 0, 0, 0, '2020-04-10 20:02:11', NULL, 0, 59.0272, '', 5, '04-11-20 Out For Delivery', NULL),
(261, 453, 298, -1, 0, 0, 0, '2020-04-08 21:27:48', NULL, 0, 55.5972, 'Please call 802.497.4006 of 802.793.0332 to let us know how to proceed with a pick up of this order please ', 3, 'On hold at back door', NULL),
(263, 459, 301, 117, 0, 0, 0, '2020-04-08 18:56:58', NULL, 0, 44.0793, 'If you could call 802-310-0779 to let Adam know when you are there, he will meet you outside the building.  The business name is Unified Turbines. \r\nThank you so much ! ', 5, 'FedEx: 770199783065', NULL),
(264, 461, 302, -2, 0, 0, 0, '2020-04-09 15:16:06', NULL, 0, 62.9652, '', 0, 'Waiting for Response', NULL),
(265, 463, 304, -1, 0, 0, 0, '2020-04-08 20:30:00', NULL, 0, 180.777, '', 3, 'On hold at back door', NULL),
(266, 464, 305, -1, 0, 0, 0, '2020-04-09 16:27:36', NULL, 0, 74.8037, '', 3, 'On hold at back door', NULL),
(267, 465, 306, -1, 0, 0, 0, '2020-04-09 16:20:38', NULL, 0, 65.2486, '', 3, 'On hold at back door', NULL),
(268, 468, 307, -1, 0, 0, 0, '2020-04-09 16:22:00', NULL, 0, 53.4893, '', 3, 'On hold at back door', NULL),
(269, 469, 308, -1, 0, 0, 0, '2020-04-09 16:22:54', NULL, 0, 22.4379, '', 6, 'On hold at back door', NULL),
(270, 470, 309, -2, 0, 0, 0, '2020-04-10 17:58:32', NULL, 0, 45.4382, '', 5, 'Local Delivery', NULL),
(272, 472, 311, -1, 0, 0, 0, '2020-04-09 16:33:32', NULL, 0, 74.8893, '', 3, 'On hold at back door', NULL),
(273, 474, 312, -1, 0, 0, 0, '2020-04-10 18:24:58', NULL, 0, 38.4772, '', 3, 'On hold at back door', NULL),
(274, 475, 314, -1, 0, 0, 0, '2020-04-10 15:35:52', NULL, 0, 9.6193, 'Will do curbside pickup on Friday 4/10', 3, 'On Hold At Backdoor', NULL),
(275, 476, 315, -1, 0, 0, 0, '2020-04-10 20:04:52', NULL, 0, 53.4893, '', 7, 'Picked Up 04-10-20', NULL),
(276, 479, 316, 118, 0, 0, 0, '2020-04-10 16:38:05', NULL, 0, 321.132, '', 0, 'waiting for response ', NULL),
(277, 480, 317, -1, 0, 0, 0, '2020-04-10 16:55:42', NULL, 0, 13.8886, '', 0, 'Waiting for response AC', NULL),
(280, 482, 319, -1, 0, 0, 0, '2020-04-10 17:18:20', NULL, 0, 32.0893, 'Animals he loves: jaguar, owl, fox, unicorn, birds\r\n\r\nWe&#039;ve got the light green slime already, so a new color would be fun!\r\n\r\nLoves all things knights and castles right now--in case that informs! Thank you sooo much for offering this!', 3, 'Holding at Backdoor --AC', NULL),
(281, 435, 318, -1, 0, 0, 0, '2020-04-10 18:04:15', NULL, 0, 98.2902, '', 0, 'Waiting for response AC', NULL),
(283, 483, 320, -1, 0, 0, 0, '2020-04-10 20:02:47', NULL, 0, 168.878, 'also, if you can find that pen we talked about--silver in color.  ballpoint.  rubber tip on cap. flashlight in barrel.\r\nThank you so much!!\r\nsorry it took so long--I had to try a third time on another browser!!', 0, 'R-Mark', NULL),
(284, 484, 321, -1, 0, 0, 0, '2020-04-10 20:03:14', NULL, 0, 72.7386, '', 3, 'On Hold At Backdoor', NULL),
(285, 486, 322, 119, 0, 0, 0, '2020-04-11 14:18:56', NULL, 0, 28.0293, '', 0, 'R-FB', NULL),
(286, 488, 323, -1, 0, 0, 0, '2020-04-11 14:24:11', NULL, 0, 5.3393, '', 0, 'R-FB', NULL),
(287, 488, 323, -1, 0, 0, 0, '2020-04-11 14:24:04', NULL, 0, 3.21, '', 0, 'R-FB', NULL),
(288, 489, 324, -1, 0, 0, 0, '2020-04-11 14:25:29', NULL, 0, 12.8186, '', 0, 'R-FB', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `web_order`
--
ALTER TABLE `web_order`
  ADD PRIMARY KEY (`wo_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `web_order`
--
ALTER TABLE `web_order`
  MODIFY `wo_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=289;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
