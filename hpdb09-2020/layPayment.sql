-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 27, 2020 at 05:53 PM
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
-- Table structure for table `layPayment`
--

CREATE TABLE `layPayment` (
  `lp_ID` int(7) NOT NULL,
  `layaway_ID` int(7) NOT NULL,
  `lp_date` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `lp_trans` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `lp_payType` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `lp_amount` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `lp_employee` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `layPayment`
--

INSERT INTO `layPayment` (`lp_ID`, `layaway_ID`, `lp_date`, `lp_trans`, `lp_payType`, `lp_amount`, `lp_employee`) VALUES
(26, 34, '2010/03/27', '01-0949', 'Credit Card', '106.73', 'LD'),
(25, 32, '2010/04/08', '0-7975', 'Credit Card', '63.65', 'BAH'),
(24, 32, '2010/03/26', '01-0936', 'Credit Card', '40', 'LD'),
(23, 32, '2010/08/10', '01-0676', 'Credit Card', '40', 'LD'),
(22, 31, '2014/02/18', '01-0768', 'Cash', '74.31', 'LD'),
(21, 31, '2010/08/10', '01-0675', 'Credit Card', '30.00', 'LD'),
(18, 30, '2010/03/06', '0-3811', 'Cash', '150.00', 'BL'),
(19, 30, '2010/03/06', 'No Tax', 'Cash', '39.98', 'MB'),
(20, 30, '2010/03/19', '1-0814', 'Cash', '421.17', 'SL'),
(27, 34, '2010/04/28', '001-1482', 'Check', '100.00', 'TL'),
(28, 34, '2010/06/17', '01-2398', 'Check', '100.00', 'BL'),
(29, 35, '2010/06/10', '0-7685', 'Cash', '43.00', 'BL'),
(30, 35, '2010/26/10', '0-0324', 'Cash', '45.79', 'BL'),
(32, 36, '2010/04/12', '0-????', 'Credit Card', '85.34', 'SL'),
(33, 36, '2010/06/03', '0-5757', 'Credit Card', '255.99', 'MB'),
(34, 37, '2010/04/12', '004-', 'Credit Card', '34.24', 'LD'),
(35, 37, '2010/05/02', '0-1129', 'Credit Card', '50.00', 'LD'),
(36, 38, '2010/04/15', '0-8701', 'Cash', '45.21', 'BL'),
(37, 38, '2010/04/15', '0-8785', 'Credit Card', '135.62', 'BH'),
(38, 39, '2010/04/24', '0-0128', 'Credit Card', '171.96', 'LS'),
(39, 39, '2010/05/07', '0-1621', 'Credit Card', '200.00', 'BL'),
(40, 39, '2010/06/13', '1-2319', 'Credit Card', '364.20', 'LD'),
(41, 40, '2010/05/01', '0-087', 'Credit Card', '20.00', 'BH'),
(42, 40, '2010/06/01', '0-5532', 'Credit Card', '44.19', 'BH'),
(43, 41, '2010/05/08', '1-1659', 'Credit Card', '528.58', 'LD'),
(44, 41, '2010/05/20', '1-1883', 'Credit Card', '528.58', 'BL'),
(45, 42, '2010/06/04', '0-5865', 'Credit Card', '20', 'BH'),
(46, 42, '2010/10/17', 'N/A', 'Credit Card', '44.19', 'MB'),
(47, 43, '2010/06/12', '1-2301', 'Credit Card', '50.00', 'LD'),
(48, 43, '2010/07/16', 'N/A', 'Cash', '109.86', 'JD'),
(49, 44, '2010/07/06', '0-0989', 'Cash', '53.23', 'BL'),
(50, 44, '2010/08/06', '1-3680', 'Credit Card', '50.00', 'LD'),
(51, 44, '2010/10/01', '0-7458', 'Credit Card', '50.00', 'BAH'),
(52, 44, '2011/01/29', '1-9556', 'Cash', '59.70', 'LD'),
(53, 46, '2010/08/10', '4-8450', 'Credit Card', '10.00', 'BH'),
(54, 46, '2010/10/17', '1-5575', 'Cash', '19.95', 'LD'),
(55, 47, '2010/08/14', '0-8596', 'Credit Card', '99.99', 'BAH'),
(56, 47, '2010/08/15', '1-3895', 'Credit Card', '284.14', 'LD'),
(57, 48, '2010/11/10', '0-4214', 'Credit Card', '96.06', 'BL'),
(58, 48, '2010/09/23', '0-6207', 'Check', '50.00', 'LS'),
(59, 48, '2010/10/07', '4-6277', 'Credit Card', '50.01', 'LS'),
(60, 48, '2010/05/10', '0-9553', 'Credit Card', '50.00', 'LS'),
(61, 48, '2010/12/03', '4-0081', 'Credit Card', '138.06', 'LS'),
(62, 50, '2010/09/11', '1-4710', 'Cash', '30.00', 'BAH'),
(63, 49, '2014/02/22', '001-12167', 'Cash', '1754.86', 'Shawna'),
(64, 50, '2010/10/16', '4-9409', 'Cash', '25.00', 'LD'),
(65, 51, '2014/02/22', '01-12168', 'Cash', '39.99', 'Shawna'),
(66, 50, '2010/10/22', '4-9460', 'Cash', '20.00', 'LS'),
(69, 52, '2010/09/13', '1-4744', 'Cash', '80.00', 'LD'),
(68, 52, '2010/09/28', '0-6943', 'Cash', '100.00', 'LS'),
(70, 52, '2010/10/12', '0-9200', 'Cash', '139.93', 'LS'),
(71, 53, '2010/09/16', '1-4793', 'Cash', '280.00', 'BL'),
(72, 53, '2010/09/16', '0-5044', 'Cash', '917.33', 'LS'),
(73, 54, '2010/10/24', '1-5016', 'Credit Card', '191.99', 'LD'),
(74, 54, '2010/09/30', '1-5146', 'Credit Card', '192.14', 'BL'),
(75, 55, '2010/09/10', '1-5151', 'Credit Card', '97.32', 'TL'),
(76, 55, '2010/11/15', '1-6199', 'Credit Card', '74.59', 'LD'),
(77, 56, '2010/10/02', '1-5250', 'Credit Card', '72.48', 'LD'),
(78, 56, '2010/11/15', '1-6200', 'Credit Card', '217.42', 'LD'),
(81, 57, '2010/10/20', '0-0489', 'Credit Card', '201.77', 'TL'),
(82, 57, '2010/11/15', '1-6198', 'Credit Card', '968.19', 'LD'),
(83, 58, '2010/10/15', '0-4372', 'Cash', '30.00', 'BAH'),
(84, 58, '2010/11/17', '0-4629', 'Cash', '55.59', 'LES'),
(85, 59, '2010/11/26', '0-6145', 'Credit Card', '49.01', 'LS'),
(86, 59, '2010/12/11', '0-0739', 'Cash', '60.01', 'GH'),
(87, 59, '2010/12/28', '0-8608', 'Credit Card', '87.00', 'LS'),
(88, 60, '2010/11/28', '1-6662', 'Cash', '127.97', 'LD'),
(89, 60, '2010/12/20', '1-8080', 'Credit Card', '127.97', 'LD'),
(90, 61, '2010/11/28', '0-6668', 'Credit Card', '38.04', 'LD'),
(91, 61, '2010/11/29', '0-6700', 'Credit Card', '50.00', 'AB'),
(92, 61, '2010/12/21', '1-8243', 'Credit Card', '58.98', 'LD'),
(93, 62, '2010/11/30', '0-7513', 'Cash', '25.00', 'LS'),
(94, 62, '2010/12/03', '0-8193', 'Cash', '28.50', 'LS'),
(95, 63, '2010/12/04', '1-6935', 'Cash', '99.99', 'LD'),
(96, 63, '2011/01/05', '1-0306', 'Credit Card', '100.00', 'LS'),
(97, 63, '2011/02/09', '1-9752', 'Cash', '50.01', 'LS'),
(98, 63, '2011/03/18', '1-0323', 'Credit Card', '69.93', 'LD'),
(99, 64, '2013/12/01', '002-16625', 'Credit Card', '50.00', 'SL'),
(100, 64, '2014/02/27', '0-????', 'Credit Card', '50.00', 'MB'),
(101, 64, '2014/02/27', 'XMAS Certificate', 'Other', '40.00', 'MB'),
(102, 64, '2014/02/27', '2-020037', 'Cash', '50.00', 'MB'),
(103, 65, '2011/01/07', '001-9106', 'Credit Card', '106.79', 'SL'),
(104, 65, '2011/16/07', '001-9314', 'Credit Card', '75.00', 'LD'),
(105, 65, '2011/01/16', '01-9316', 'Credit Card', '245.35', 'LD'),
(109, 66, '2014/03/01', '3-000366', 'Credit Card', '25.00', 'TL'),
(107, 68, '2011/01/23', '001-9476', 'Check', '100.00', 'LD'),
(108, 68, '2011/03/05', '001-0195', 'Check', '292.33', 'LD'),
(110, 69, '2011/02/05', '001-9676', 'Credit Card', '109.17', 'LD'),
(111, 69, '2011/04/02', '001-0560', 'Credit Card', '75.00', 'LD'),
(112, 69, '2011/06/29', '0-3409', 'Credit Card', '100.00', 'LS'),
(113, 69, '2012/04/23', '2-3992', 'Credit Card', '86.73', 'KC'),
(114, 70, '2011/02/10', '0-4682', 'Check', '133.49', 'LS'),
(115, 70, '2011/04/22', '1-0933', 'Check', '267.00', 'MB'),
(116, 70, '2011/05/21', '4-2509', 'Check', '133.44', 'BL'),
(117, 71, '2011/02/20', '4-1811', 'Cash', '140.01', 'BAH'),
(118, 71, '2011/02/26', '1-0074', 'Credit Card', '180.00', 'LD'),
(120, 71, '2011/03/04', 'N/A', 'Cash', '231.03', 'BAH'),
(121, 72, '2011/03/10', '1-0231', 'Credit Card', '700.00', 'SL'),
(122, 72, '2011/03/11', '1-0242', 'Credit Card', '10.00', 'SL'),
(123, 72, '2011/05/27', '1-1497', 'Credit Card', '400.00', 'TL'),
(124, 72, '2011/07/16', '2-0024', 'Cash', '660.21', 'AB'),
(125, 73, '2011/03/17', '1-0312', 'Credit Card', '221.76', 'BAH'),
(126, 73, '2011/04/09', '1-0693', 'Credit Card', '300.00', 'LD'),
(127, 73, '2011/05/01', '1-1107', 'Credit Card', '365.27', 'BAH'),
(128, 74, '2011/04/18', '1-0874', 'Credit Card', '53.47', 'LD'),
(129, 74, '2011/05/12', '1-1286', 'Check', '60.40', 'LD'),
(130, 74, '2011/09/20', '0-8573', 'Cash', '100.00', 'LS'),
(131, 75, '2011/05/04', '0-4775', 'Credit Card', '690.96', 'TL'),
(132, 76, '2011/05/12', '4-2440', 'Cash', '240.00', 'LS'),
(133, 76, '2011/06/03', '0-9178', 'Cash', '261.83', 'BAH'),
(134, 77, '2011/05/21', '0-7428', 'Cash', '50.00', 'BAH'),
(135, 77, '2011/06/02', '0-9314', 'Credit Card', '138.29', 'KAT'),
(136, 83, '2014/04/02', '3-000541', 'Check', '375.00', 'Teri'),
(137, 85, '2014/04/02', '2-20497', 'Cash', '5', 'MB'),
(138, 88, '2014/04/03', '3-553', 'Credit Card', '70.00', 'SB'),
(139, 87, '2014/04/03', '002-20508', 'Credit Card', '20.00', 'SB'),
(169, 66, '2014/06/25', 'Canceled Layaway', 'Other', '81.87', 'Teri'),
(142, 49, '2014/04/09', '3-573', 'Credit Card', '760.00', 'SR'),
(143, 64, '2014/04/17', '02020679', 'Credit Card', '50.00', 'AD'),
(144, 91, '2014/04/21', '3-360', 'Credit Card', '75.00', 'SR'),
(145, 83, '2014/04/24', '002-20784', 'Credit Card', '743.56', 'SB'),
(146, 92, '2014/04/29', '3-000685', 'Credit Card', '107.00', 'Teri'),
(147, 87, '2014/05/01', '002-020879', 'Cash', '10.00', 'KC'),
(148, 88, '2014/05/06', '2-020961', 'Cash', '143.87', 'Teri'),
(149, 91, '2014/05/10', '3-000744', 'Credit Card', '277.30', 'Teri'),
(150, 93, '2014/05/18', '3-798', 'Credit Card', '50.37', 'Shawna'),
(151, 49, '2014/05/23', '3-821', 'Credit Card', '310.00', 'SB'),
(152, 49, '2014/05/30', '3-862', 'Cash', '29.90', 'Shawna'),
(153, 92, '2014/05/30', '2-21249', 'Cash', '20.00', 'DD'),
(154, 94, '2014/05/30', '3-865', 'Credit Card', '100.00', 'Teri'),
(155, 95, '2014/05/30', '02021258', 'Check', '50.00', 'AD'),
(156, 95, '2014/05/30', '02021258', 'Gift Card', '100.00', 'AD'),
(157, 96, '2014/05/31', 'Web', 'Cash', '75.00', 'MB'),
(158, 96, '2014/05/31', 'W-689', 'Credit Card', '535.00', 'MB'),
(159, 51, '2014/06/04', '3-895', 'Credit Card', '20.00', 'Teri'),
(160, 64, '2014/06/05', '2021361', 'Cash', '80.35', 'FB'),
(161, 51, '2014/06/06', '3-911', 'Credit Card', '14.00', 'Teri'),
(162, 93, '2014/06/06', '0-164052', 'Cash', '110.00', 'FB'),
(163, 92, '2014/06/11', '3-957', 'Credit Card', '299.93', 'Teri'),
(164, 97, '2014/06/13', '1-014751', 'Credit Card', '40.00', 'FB'),
(165, 96, '2014/06/14', 'W-33617', 'Credit Card', '535.00', 'MB'),
(166, 98, '2014/06/16', '0-166121', 'Credit Card', '24.99', 'DD'),
(167, 96, '2014/06/18', 'W-734', 'Credit Card', '214.00', 'MB'),
(168, 96, '2014/06/20', 'W-745', 'Credit Card', '53.50', 'MB'),
(170, 97, '2014/06/26', '1-015037', 'Credit Card', '46.65', 'FB'),
(171, 96, '2014/06/27', 'W-20455', 'Credit Card', '53.50', 'MB'),
(172, 96, '2014/06/27', 'W-19270', 'Credit Card', '53.50', 'MB'),
(173, 95, '2014/06/28', '3-1042', 'Credit Card', '362.53', 'Teri'),
(174, 96, '2014/06/28', 'W-766', 'Credit Card', '353.00', 'MB'),
(175, 98, '2014/06/30', '0-168556', 'Cash', '20.00', 'RS'),
(217, 108, '2015/03/15', '0-220582', 'Cash', '34.44', 'SR'),
(177, 98, '2014/07/14', '0-171171', 'Cash', '62.00', 'HC'),
(178, 51, '2014/07/25', '3-1188', 'Cash', '90.00', 'Teri'),
(179, 51, '2014/08/05', '1003-1241', 'Cash', '20.00', 'TM'),
(181, 102, '2014/08/06', '003-001261', 'Credit Card', '40.44', 'FB'),
(182, 102, '2014/08/07', '3-001273', 'Cash', '121.34', 'FB'),
(183, 103, '2014/08/07', '002-22543', 'Cash', '20.00', 'shawna'),
(184, 94, '2014/08/12', '1001-017644', 'Cash', '75.00', 'MB'),
(276, 161, '2016/08/26', '01-053963', 'Check', '6.00', 'tm'),
(186, 108, '2014/08/16', '2-022834', 'Cash', '10.00', 'Teri'),
(188, 82, '2014/09/14', '2-23488', 'Credit Card', '24.99', 'SR'),
(189, 82, '2014/10/05', '0-189499', 'Cash', '50.00', 'SR'),
(190, 85, '2014/10/13', '2-023924', 'Check', '20.00', 'AB'),
(191, 115, '2014/10/25', '3-1760', 'Cash', '176.25', 'Taryn'),
(192, 82, '2014/11/02', '1-020839', 'Cash', '50.00', 'FB'),
(193, 115, '2014/11/06', '3-1834', 'Credit Card', '528.88', 'Teri'),
(194, 116, '2014/11/28', '3-1986', 'Cash', '29.31', 'Shawna'),
(195, 117, '2014/11/29', '2-24913', 'Cash', '4.00', 'Teri'),
(196, 119, '2014/12/10', '003-002087', 'Credit Card', '347.22', 'TM'),
(197, 116, '2014/12/11', '00203052', 'Credit Card', '100.00', 'KC'),
(198, 118, '2014/12/14', '3-2120', 'Cash', '170.00', 'sr'),
(199, 117, '2014/12/20', '02026495', 'Cash', '28.03', 'amanda'),
(200, 118, '2014/12/24', '3-2224', 'Credit Card', '21.96', 'tl'),
(201, 120, '2014/12/29', '3-2255', 'Cash', '100.00', 'SR'),
(202, 87, '2014/12/29', '002-027580', 'Cash', '55.59', 'SB'),
(206, 120, '2015/01/11', '2-027842', 'Cash', '50.00', 'ar'),
(207, 127, '2015/01/18', '3-2378', 'Credit Card', '20.00', 'SR'),
(208, 128, '2015/01/18', '3-2380', 'Credit Card', '10.00', 'sb'),
(209, 129, '2015/01/19', '3-2387', 'Credit Card', '50.00', 'TM'),
(212, 108, '2015/02/20', '03-002536', 'Credit Card', '100', 'TM'),
(213, 51, '2015/02/20', '03-2537', 'Credit Card', '80', 'TM'),
(214, 132, '2015/02/22', '0-217954', 'Credit Card', '10.00', 'ER'),
(215, 85, '2015/02/27', '1-029294', 'Cash', '3.87', 'ma'),
(216, 51, '2014/07/01', '1-15237', 'Cash', '10.00', 'SB'),
(218, 51, '2015/03/15', '0-220583', 'Cash', '99.44', 'sr'),
(219, 134, '2015/03/15', '1-29516', 'Cash', '20.00', 'sr'),
(220, 120, '2015/03/18', '02-029022', 'Cash', '50.00', 'ar'),
(221, 132, '2015/03/22', '0-221671', 'Cash', '29.93', 'JB'),
(222, 119, '2015/03/27', '0-222169', 'Cash', '1041.64', 'sr'),
(224, 137, '2015/03/30', '02-029221', 'Cash', '58.84', 'AD'),
(225, 138, '2015/03/31', '3-2759', 'Credit Card', '187.25', 'tm'),
(226, 127, '2015/04/04', '3-2784', 'Credit Card', '75.86', 'Teri'),
(227, 139, '2015/04/12', '3-2814', 'Credit Card', '800.00', 'Teri'),
(228, 134, '2015/04/12', '1-30053', 'Cash', '68.79', 'sr'),
(229, 140, '2015/04/20', '00-225999', 'Cash', '30.00', 'TM'),
(230, 138, '2015/04/30', '1-30334', 'Cash', '187.24', 'sr'),
(231, 140, '2015/05/04', '3-2938', 'Credit Card', '25.00', 'Teri'),
(232, 82, '2015/05/04', '3-2938', 'Credit Card', '25.00', 'Teri'),
(233, 129, '2015/05/11', '3-2970', 'Credit Card', '56.87', 'TM'),
(234, 94, '2015/05/29', '3-3064', 'Cash', '20.00', 'SB'),
(235, 82, '2015/06/02', 'Trans from layaway 140', 'Cash', '21.64', 'FB'),
(236, 128, '2015/06/02', 'Trans from layaway 140', 'Cash', '28.51', 'FB'),
(237, 142, '2015/06/16', '0-235463', 'Credit Card', '80.09', 'ER'),
(238, 144, '2015/06/27', '3-3229', 'Cash', '24.99', 'Teri'),
(239, 142, '2015/06/29', '1-31832', 'Cash', '80.09', 'sr'),
(241, 144, '2015/07/04', '01-32042', 'Credit Card', '25.43', 'TM'),
(242, 146, '2015/07/08', '01-032132', 'Check', '24.99', 'TM'),
(243, 146, '2015/07/09', '0-23944', 'Cash', '25', 'OM'),
(245, 146, '2015/07/13', '1-32288', 'Check', '20.00', 'MS'),
(246, 144, '2015/07/13', '01-032305', 'Credit Card', '56.45', 'JB'),
(247, 146, '2015/07/28', '1-032752', 'Cash', '26.30', 'AD'),
(248, 147, '2015/08/16', '1-034293', 'Cash', '20.00', 'MS'),
(250, 120, '2015/08/28', '2-32646', 'Cash', '30.00', 'AR'),
(251, 149, '2015/09/01', '1-035101', 'Credit Card', '34.19', 'ER'),
(252, 149, '2015/09/12', '01-035529', 'Credit Card', '51.28', 'TM'),
(253, 120, '2015/11/13', '02-034482', 'Cash', '20.00', 'AR'),
(255, 120, '2015/12/22', '3-4490', 'Cash', '151.15', 'GM'),
(256, 103, '2015/12/28', 'Canceled Layaway', 'Other', '-20.00', 'Teri'),
(257, 153, '2016/01/13', '3-4640', 'Credit Card', '375.00', 'GM'),
(258, 154, '2016/01/16', '3-4673', 'Cash', '450.00', 'SB'),
(297, 178, '2017/05/24', '0-4156465', 'Cash', '40.10', 'fb'),
(260, 154, '2016/02/07', '3-4793', 'Credit Card', '567.78', 'Teri'),
(261, 94, '2016/02/17', '3-4845', 'Credit Card', '227.34', 'SB'),
(262, 153, '2016/02/23', '3-4876', 'Check', '250.00', 'GM'),
(263, 147, '2016/02/27', '3-4902', 'Cash', '330.62', 'SB'),
(264, 147, '2016/02/27', '3-4903', 'Cash', '50.00', 'SB'),
(265, 147, '2016/03/11', '3-4970', 'Credit Card', '22.00', 'Teri'),
(266, 147, '2016/03/11', '3-4971', 'Credit Card', '15.00', 'Teri'),
(267, 147, '2016/03/12', '3-4974', 'Cash', '218.14', 'SB'),
(268, 159, '2016/03/28', '3-5071', 'Credit Card', '238.82', 'Teri'),
(269, 160, '2016/04/16', '3-5195', 'Credit Card', '695.17', 'AD'),
(270, 153, '2016/04/19', '3-5210', 'Credit Card', '270.59', 'GM'),
(271, 159, '2016/04/28', '3-5254', 'Credit Card', '300.00', 'Teri'),
(272, 160, '2016/05/17', 'Refund', 'Credit Card', '-695.17', 'GM'),
(273, 159, '2016/05/27', '3-5418', 'Cash', '416.48', 'SB'),
(274, 161, '2016/06/02', '0-302049', 'Cash', '5.00', 'L.S.'),
(275, 161, '2016/07/01', '1050173', 'Cash', '5.29', 'L.S.'),
(277, 161, '2016/09/02', '1-054455', 'Cash', '4.00', 'L.S.'),
(278, 162, '2016/10/05', '3-6428', 'Credit Card', '205.55', 'SB'),
(279, 161, '2016/11/02', '01057130', 'Cash', '10.00', 'tm'),
(280, 162, '2016/11/16', '3-6707', 'Credit Card', '617.28', 'SB'),
(281, 163, '2017/01/03', '3-7127', 'Cash', '134.00', 'SB'),
(282, 165, '2017/01/05', '3-7144', 'Cash', '20.00', 'SB'),
(283, 165, '2017/01/19', '3-7275', 'Cash', '20.00', 'SB'),
(284, 165, '2017/02/02', '3-7349', 'Cash', '43.45', 'TL'),
(285, 161, '2017/02/02', '1-066899', 'Credit Card', '5.00', 'CK'),
(286, 166, '2017/02/02', '1-066902', 'Cash', '4.06', 'L.S.'),
(287, 168, '2017/02/04', '3-7364', 'Cash', '40.00', 'SB'),
(288, 163, '2017/02/05', '03-7372', 'Cash', '400.87', 'JB'),
(289, 169, '2017/02/26', '3-7458', 'Cash', '425.00', 'Teri'),
(290, 169, '2017/03/02', '3-7484', 'Check', '1275.23', 'TL'),
(291, 168, '2017/03/30', '3-7617', 'Credit Card', '500.00', 'Teri'),
(292, 166, '2017/04/03', '1-068683', 'Cash', '6.00', 'L.S.'),
(293, 171, '2017/04/08', '3-7653', 'Cash', '110.00', 'JB'),
(294, 171, '2017/04/10', '3-7669', 'Credit Card', '338.33', 'Teri'),
(295, 166, '2017/05/01', '0-365283', 'Cash', '4.00', 'ES'),
(296, 176, '2017/05/07', '0-366118', 'Cash', '5.00', 'LS'),
(298, 166, '2017/06/15', '01-071905', 'Cash', '6.25', 'LS/TM'),
(299, 179, '2017/07/01', '1-072762', 'Cash', '535.00', 'AM'),
(300, 179, '2017/07/05', '01-073043', 'Credit Card', '212.93', 'MS'),
(301, 168, '2017/07/25', '1-074295', 'Credit Card', '540.00', 'MS'),
(303, 180, '2017/07/26', '0-381075', 'Cash', '40.00', 'AM'),
(304, 180, '2017/08/01', '3-8438', 'Cash', '147.46', 'SB'),
(305, 181, '2017/08/01', '0-383001', 'Cash', '12.00', 'L.B.'),
(306, 168, '2017/08/03', '3-8451', 'Credit Card', '543.15', 'SP'),
(307, 176, '2017/08/04', '0-383585', 'Cash', '53.84', 'Teri'),
(308, 183, '2017/08/05', '01-075714', 'Cash', '100.00', 'TM'),
(309, 183, '2017/08/06', '00-383981', 'Cash', '71.19', 'TM'),
(310, 184, '2017/08/12', 'example ', 'Credit Card', '12.83', 'SP'),
(311, 185, '2017/09/03', '01-077742', 'Credit Card', '50.00', 'TM'),
(312, 186, '2017/09/15', '2-054624', 'Cash', '79.98', 'FB'),
(313, 187, '2017/10/05', '3-8826', 'Check', '200.00', 'SB'),
(314, 187, '2017/10/18', '1-079916', 'Check', '100.00', 'AM'),
(315, 181, '2017/11/03', '1-080771', 'Cash', '10.00', 'FB'),
(316, 181, '2017/11/09', '1-081129', 'Check', '5.00', 'SED'),
(317, 187, '2017/11/20', '1-082092', 'Check', '100.00', 'SED'),
(318, 190, '2017/11/24', '3-9121', 'Credit Card', '125.00', 'Teri'),
(319, 190, '2017/12/04', '3-9199', 'Credit Card', '369.77', 'Teri'),
(320, 181, '2017/12/11', '1-085787', 'Cash', '4.25', 'AM'),
(321, 191, '2017/12/30', '3-9383', 'Cash', '10.00', 'TL'),
(322, 193, '2017/12/31', '3-9394', 'Credit Card', '77.03', 'Teri'),
(323, 191, '2018/01/02', '1-90448', 'Credit Card', '10.00', 'sb'),
(325, 194, '2018/01/08', '3-9434', 'Credit Card', '250.00', 'Teri'),
(326, 181, '2018/01/09', '0-417731', 'Cash', '5.00', 'L.B.'),
(327, 187, '2018/01/11', '3-9444', 'Check', '50.00', 'Teri'),
(328, 181, '2018/02/02', '01-91831', 'Cash', '7.00', 'TM'),
(329, 197, '2018/02/11', '25', 'Credit Card', '100', 'MB'),
(330, 181, '2018/03/06', '1-092935', 'Cash', '5', 'AM'),
(331, 191, '2018/03/31', '2-60797', 'Cash', '145.80', 'Teri'),
(332, 181, '2018/04/02', '1-093875', 'Cash', '4.6', 'AM'),
(333, 199, '2018/04/12', '02-061006', 'Check', '60.00', 'Taryn'),
(334, 199, '2018/04/17', '01-094328', 'Check', '120.83', 'TM'),
(335, 193, '2018/05/11', '3-3-10018', 'Credit Card', '35.00', 'Teri'),
(337, 185, '2018/06/04', '02-061846', 'Credit Card', '299.99', 'A'),
(338, 181, '2018/06/07', '1-096668', 'Cash', '2.00', 'PD'),
(339, 181, '2018/08/03', '1-100350', 'Cash', '8.00', 'PD'),
(340, 203, '2018/08/11', '3-10522', 'Gift Card', '50.00', 'SB'),
(341, 204, '2018/09/03', '3-10666', 'Credit Card', '61.25', 'Teri'),
(342, 204, '2018/09/07', '3-10684', 'Credit Card', '183.78', 'Teri'),
(343, 193, '2018/09/17', '3-10728', 'Credit Card', '96.09', 'Teri'),
(344, 203, '2018/10/05', '3-10798', 'Credit Card', '25.00', 'Teri'),
(345, 203, '2018/11/18', '3-11007', 'Credit Card', '181.16', 'Teri'),
(346, 205, '2018/12/28', '3-11214', 'Credit Card', '20.00', 'SB'),
(347, 205, '2019/01/04', '3-11254', 'Credit Card', '50.00', 'SB'),
(348, 206, '2019/01/12', '0-484156', 'Credit Card', '100.00', 'MP'),
(349, 207, '2019/01/15', '3-11336', 'Cash', '20.00', 'AM'),
(350, 205, '2019/01/18', '3-11350', 'Cash', '179.65', 'SB'),
(351, 206, '2019/01/21', '00-485091', 'Cash', '155.94', 'Alister'),
(352, 209, '2019/02/02', '3-11393', 'Cash', '100', 'SB'),
(353, 211, '2019/02/09', '3-11421', 'Credit Card', '100.00', 'AM'),
(354, 211, '2019/02/10', '00-487644', 'Cash', '11.27', 'AEM'),
(355, 209, '2019/03/06', '3-11524', 'Credit Card', '1000.00', 'SB'),
(356, 212, '2019/05/08', '1-118683', 'Cash', '12.83', 'PD'),
(357, 213, '2019/05/11', '1-118793', 'Credit Card', '213.99', 'MP'),
(358, 212, '2019/05/31', '1-119278', 'Cash', '5.49', 'MP'),
(359, 209, '2019/06/17', '3-011988', 'Credit Card', '120', 'MB'),
(360, 209, '2019/06/30', '3-12040', 'Credit Card', '335.40', 'Teri'),
(361, 209, '2019/07/02', '2-71585', 'Cash', '20', 'MB'),
(362, 209, '2019/07/02', '2-71586', 'Credit Card', '21.00', 'MB'),
(363, 209, '2019/07/02', '2-71587', 'Cash', '20.00', 'MB'),
(364, 209, '2019/07/03', '1-120637', 'Credit Card', '500.00', 'L.B.'),
(365, 209, '2019/07/03', '1-120638', 'Cash', '39.00', 'L.B.'),
(366, 212, '2019/07/10', '0-512750', 'Cash', '4.35', 'C.N.'),
(368, 213, '2019/07/11', '1-120959', 'Credit Card', '200.00', 'CN'),
(369, 209, '2019/07/12', '3-12092', 'Credit Card', '-299.60', 'SB'),
(370, 213, '2019/07/26', '1-121723', 'Credit Card', '442.00', 'C.N.'),
(376, 215, '2019/09/01', '3-12402', 'Credit Card', '128.18', 'Teri'),
(372, 207, '2019/08/09', '0-518987', 'Cash', '204.06', 'MP'),
(373, 216, '2019/08/11', '3-12265', 'Credit Card', '300.00', 'Teri'),
(374, 216, '2019/08/23', '2-72392', 'Credit Card', '100.00', 'sc'),
(375, 185, '2019/08/31', '1-1224785', 'Cash', '-350.00', 'Teri'),
(377, 209, '2019/09/06', '2-72496', 'Credit Card', '136.96', 'MB'),
(378, 217, '2019/09/07', '1-125055', 'Credit Card', '10.00', 'MP'),
(379, 216, '2019/09/09', '3-12442', 'Credit Card', '200.00', 'Teri'),
(380, 219, '2019/09/11', '3-12451', 'Check', '550.00', 'Teri'),
(381, 220, '2019/09/15', '3-12469', 'Credit Card', '50.00', 'Teri'),
(382, 212, '2019/09/20', '1-125706', 'Cash', '4.00', 'CN'),
(383, 220, '2019/09/22', '3-12511', 'Credit Card', '-50.00', 'Teri'),
(384, 194, '2019/09/28', 'Unverified if Made', 'Other', '262.74', 'Teri'),
(387, 216, '2019/10/05', '3-12578', 'Credit Card', '200.00', 'Teri'),
(388, 219, '2019/10/17', '3-12640', 'Cash', '1480.86', 'Maya'),
(389, 216, '2019/10/17', '3-12644', 'Credit Card', '367.69', 'Maya'),
(390, 212, '2019/11/06', '1-129037', 'Cash', '13.00', 'BR'),
(391, 215, '2019/11/20', '01-129804', 'Cash', '100', 'br'),
(392, 217, '2020/01/04', '1-138631', 'Credit Card', '40', 'MP'),
(393, 217, '2020/01/04', '1-138632', 'Cash', '78.38', 'MP'),
(394, 224, '2020/01/12', '3-13177', 'Credit Card', '52.84', 'Teri'),
(395, 225, '2020/01/12', '3-13179', 'Cash', '13.82', 'Maya'),
(396, 227, '2020/01/12', '3-013189', 'Credit Card', '37.35', 'MP'),
(397, 227, '2020/01/17', '3-13211', 'Credit Card', '15.00', 'stacey'),
(398, 225, '2020/01/19', '3-13221', 'Cash', '41.46', 'Maya'),
(399, 215, '2020/03/12', '1-141464', 'Credit Card', '50.00', 'MP'),
(400, 229, '2020/03/15', '3-13475', 'Cash', '72.91', 'Maya'),
(401, 230, '2020/03/15', '3-13480', 'Cash', '35.43', 'Maya'),
(402, 193, '2020/03/16', '3-13486', 'Credit Card', '100.00', 'Teri'),
(403, 230, '2020/04/20', '2-076713', 'Credit Card', '116.24', 'Teri'),
(404, 215, '2020/05/12', '2-077026', 'Credit Card', '234.56', 'MP'),
(405, 229, '2020/05/18', '3-13521', 'Credit Card', '239.17', 'Teri'),
(406, 232, '2020/05/26', '3-13562', 'Credit Card', '150.00', 'Tom'),
(408, 233, '2020/06/21', '0-564568', 'Credit Card', '59.71', 'MP'),
(409, 232, '2020/06/22', '3-13732', 'Credit Card', '125.00', 'Teri'),
(410, 233, '2020/07/22', '1-142975', 'Credit Card', '238.82', 'MP'),
(411, 235, '2020/09/07', '3-14227', 'Credit Card', '231.00', 'Teri'),
(412, 235, '2020/09/20', '3-i14345', 'Credit Card', '693.35', 'Teri');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `layPayment`
--
ALTER TABLE `layPayment`
  ADD PRIMARY KEY (`lp_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `layPayment`
--
ALTER TABLE `layPayment`
  MODIFY `lp_ID` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=413;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;