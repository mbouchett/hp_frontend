-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 04, 2019 at 12:00 PM
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
-- Table structure for table `layItems`
--

CREATE TABLE `layItems` (
  `li_ID` int(11) NOT NULL,
  `layaway_ID` int(7) NOT NULL,
  `dept_ID` smallint(6) NOT NULL,
  `li_desc` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `li_qty` int(7) NOT NULL,
  `li_price` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `layItems`
--

INSERT INTO `layItems` (`li_ID`, `layaway_ID`, `dept_ID`, `li_desc`, `li_qty`, `li_price`) VALUES
(26, 34, 28, 'San Marco Recliner, Bark', 1, '399.00'),
(27, 35, 10, 'Stand', 1, '39.99'),
(28, 35, 10, 'glass bird feeder bowl', 1, '42.99'),
(25, 32, 16, 'Powell Black Curio Cabinet Retail 179.00', 1, '134.25'),
(22, 30, 28, 'Cameron Berry Sofa Ashley #3640338', 1, '471.29'),
(23, 30, 16, 'Ligo Cocktail Table Black ', 1, '99.88'),
(24, 31, 16, 'Powell Accent Chest 129.99 Retail', 1, '97.49'),
(29, 36, 19, 'Cape May Charleston Walnut Wicker Rocker', 1, '319.00'),
(30, 37, 19, 'Superseat White Wicker Chair', 1, '67.49'),
(31, 37, 18, 'Cushion', 1, '11.24'),
(32, 38, 20, 'Jewelry Box', 1, '169.00'),
(33, 39, 28, 'Randi Chair', 1, '469.00'),
(34, 39, 28, 'Randi Ottoman', 1, '219.00'),
(35, 40, 1, 'Bamboo Ladder Shelf', 1, '59.99'),
(36, 41, 28, 'Cameron Berry Sofa', 1, '589.00'),
(37, 41, 28, 'San Marco Recliner', 1, '399.00'),
(38, 42, 1, 'Bamboo Ladder Shelf', 1, '59.99'),
(39, 43, 19, 'Espresso Vernada Wicker Loveseat', 1, '149.40'),
(40, 44, 16, 'Powell 266-417 Pivot top Dinining table', 1, '199.00'),
(41, 46, 20, 'Ceramic Elephant Decor', 1, '27.99'),
(42, 47, 28, 'Flip Flop Reaction Sofa', 1, '359.00'),
(43, 48, 28, 'San Marco recliner chocolate #6060427', 1, '359.00'),
(44, 49, 1, 'D16100S Jenny Sofa Plumes Spa Down Slipcover', 1, '1349.00'),
(45, 49, 1, 'D16100LS Jenny Loveseat Down Slip Cover', 1, '1319.00'),
(46, 50, 19, 'Anzai Loveseat K4410C7 Antique Black', 1, '159.20'),
(47, 51, 3, 'Mac at Home Folding desk FD-2005X6', 1, '349.00'),
(48, 52, 16, 'Beach Room Divider', 1, '299.00'),
(49, 53, 28, 'Meredith Sofa With Chaise', 1, '1119.00'),
(50, 54, 28, 'Ashley Fouton Salsa Red', 1, '359.00'),
(51, 55, 16, 'Cityscape Screen', 1, '189.00'),
(52, 55, 0, '15% Discount', 1, '-28.35'),
(53, 56, 14, 'Hookless Shower Curtain', 1, '39.99'),
(54, 56, 14, 'Eko Luxe Bath Sheet', 3, '36.99'),
(55, 56, 15, 'King Size Sheet Set, Taupe', 1, '89.99'),
(56, 56, 14, 'Eko Luxe Hand Towels', 2, '14.99'),
(57, 57, 16, 'Martini ciounterstools D551-324', 1, '149.99'),
(58, 57, 0, '15% Discount', 1, '-89.99'),
(59, 57, 17, 'Mystique Rug #20065003 Floor model', 1, '349.00'),
(60, 57, 0, '15% Discount', 1, '-104.70'),
(61, 57, 17, 'Foreign Accents #BST5630 Gray/Blk Wht Blocked 5X8 ', 1, '399.00'),
(62, 57, 0, '15% Discount', 1, '-59.85'),
(63, 57, 16, 'Martini ciounterstools D551-324', 3, '149.99'),
(64, 58, 8, 'Waring Pro Waffle Maker', 1, '79.99'),
(65, 59, 16, 'WiffenPoof B23 Cinnamon 20% off Coupon', 1, '183.20'),
(66, 60, 16, '24\" W Cedar Chest (CDRCST-024) Cherry all distress -20%', 1, '239.20'),
(67, 61, 16, 'Whiffenpoof Foam Chair (Kiwi Green)', 1, '137.40'),
(68, 62, 21, 'Pot Rack', 1, '49.99'),
(69, 63, 16, 'Apothecary Cabinet, Shores White', 1, '299.00'),
(70, 64, 19, 'Double Papasan', 1, '263.40'),
(71, 64, 13, 'Buddah Fountain', 1, '35.99'),
(72, 65, 28, 'Klote Newton Sleeper Black', 1, '399.20'),
(73, 66, 16, 'Shelburne Half Moon Table', 1, '99.88'),
(74, 68, 28, 'Rhiannon Sofa, Beluga -25% for employee discount', 1, '366.66'),
(75, 69, 16, 'Scroll Rocker LUSCIOUS', 1, '440.10'),
(76, 70, 28, 'Klote Newton Sleeper Taupe', 1, '499.00'),
(77, 71, 24, 'Ashley Urbandale Dining Table D193-35', 1, '349.00'),
(78, 71, 3, 'Ashley Wood and Metal Desk H521-10', 1, '165.99'),
(79, 72, 28, 'Llanna Sofa Sky Blue S35-22482 reg $1059 -20%', 1, '847.20'),
(80, 72, 28, 'Llanna Loveseat Sky Blue L35-22482 reg $1009 -20%', 1, '807.20'),
(81, 73, 28, 'Rhiannon Sofa - 551AW-2184-1N Oregano', 1, '829.00'),
(82, 74, 17, '5x7 Rug, Floral', 1, '199.88'),
(83, 75, 19, 'Sage Mackinac Chaise', 1, '286.88'),
(84, 75, 19, 'Sage Mackinac 3 Seater', 1, '358.88'),
(85, 76, 24, 'Barrister Table ', 1, '469.00'),
(86, 77, 10, 'Glass Top Bistro Table UMA#57407 (99.99 -20%)', 1, '79.99'),
(87, 77, 10, 'Black Wicker Bistro Chair UMA #57405 (59.99 -20%)', 2, '47.99'),
(140, 117, 20, 'Thai Cat Damaged Ear', 1, '29.93'),
(100, 83, 18, 'Deep Seating Cushion Set SP3112 Blue/Green Stripe No tuft/No welt', 1, '349.00'),
(99, 83, 19, 'St. Lucia Loveseat White', 1, '503.2'),
(92, 83, 18, 'Hockley 17X17 Square throw', 2, '16.99'),
(93, 83, 19, 'Mackinac End Table White', 1, '159.20'),
(94, 85, 20, 'Green Glass Vase', 1, '19.99'),
(95, 85, 14, 'Red Soap Dish', 1, '6.99'),
(96, 86, 8, 'Mint Green Milkshake Mixer (display)', 1, '80.00'),
(97, 87, 8, 'Mint Green Milkshake Mixer (display)', 1, '79.99'),
(98, 88, 28, 'Odin Ottoman Bonded Leather Chestnut', 1, '199.88'),
(101, 89, 27, 'Tension Rod 36-54 Rod', 4, '22.99'),
(102, 89, 27, 'Roslyn Panel Ivory', 4, '12.99'),
(103, 89, 27, 'Prelude Panel Blue', 4, '21.99'),
(104, 91, 19, 'Double Papason with Ozbourne Grey', 1, '329.25'),
(105, 92, 19, 'Double Papasan withRed/Gold Tweed Pad', 1, '399.00'),
(106, 93, 16, 'ADV Floor Screen Canvas Print', 1, '149.88'),
(107, 94, 28, 'Heather Sofa Willow Merlot', 1, '394.71'),
(108, 95, 28, 'Cosmo med maple red clay', 1, '479.00'),
(109, 96, 28, 'Jenny Sleeper Sofa  (Fabric: Tiara Peridot with Fruittree Crayols Pillows)', 1, '1750'),
(110, 97, 20, 'Hammock Hardware and Chair', 1, '80.98'),
(111, 98, 10, 'resin tortoise ', 1, '99.99'),
(163, 134, 16, 'directors chair with cover 18', 1, '59.99'),
(114, 102, 24, 'Catskill White Kitchen Cart', 1, '151.20'),
(116, 103, 3, 'Ashley Bookcase', 1, '179.25'),
(117, 82, 16, 'white night stand', 1, '52.41'),
(119, 82, 8, 'Fry Pan 10in & 11in Set 2pc (6424 - 6428)', 1, '107.99'),
(120, 107, 19, 'Papasan Blue Cushion', 1, '199.00'),
(121, 108, 16, 'Stylecraft Trunk (10% off 149.99) Floor Model', 1, '134.99'),
(122, 110, 10, 'Bistro Chair Glass Mosaic', 2, '69.29'),
(126, 115, 28, 'Brower Sofa Turquoise', 1, '659.00'),
(127, 116, 11, 'Vance Kitira Brick Candle', 1, '16.19'),
(128, 116, 11, 'Vance Kitira Candle', 1, '18.00'),
(129, 116, 11, 'Woodwick Candle', 1, '18.00'),
(130, 116, 11, 'Vance Kitira Candle', 1, '7.19'),
(131, 116, 11, 'Vance Kitira Candle Pear', 2, '3.59'),
(132, 116, 11, 'Vance Kitira Candle', 1, '3.29'),
(133, 116, 11, 'Woodwick Candle', 1, '12.00'),
(134, 116, 11, 'Vance Kitira Candle', 1, '11.40'),
(135, 116, 13, 'Incense', 100, '.06'),
(136, 116, 13, 'Incense box', 1, '3.00'),
(137, 116, 12, 'Spirit animal', 2, '1.80'),
(138, 116, 23, 'Ornament', 1, '9.00'),
(139, 116, 23, 'Ornament', 1, '6.00'),
(141, 118, 6, 'lake champlain topographic art', 1, '179.40'),
(143, 119, 17, 'Banyan Pewter Rug 8X10', 2, '649.00'),
(145, 120, 28, 'Possibilities Queen Sleeper W/dreamquest Mattress Microsuede Celadon Pillows:self', 1, '374.91'),
(152, 127, 16, 'Stylecraft Floor Mirror', 1, '35.99'),
(153, 127, 16, 'Powell Dry Erase Table', 1, '19.88'),
(169, 127, 8, 'Bottle Cleaner', 1, '9.74'),
(155, 127, 15, 'sheets', 1, '17.99'),
(156, 128, 16, 'Stylecraft Floor Mirror', 1, '35.99'),
(157, 129, 16, 'Vanity Mirror', 1, '99.88'),
(160, 130, 27, 'Umbra 28\" Drapery Rod', 2, '24.88'),
(161, 132, 27, 'Umbra 28\" Drapery Rod', 2, '18.66'),
(168, 127, 25, 'Black Train', 1, '5.99'),
(164, 134, 21, 'flatware organizer', 1, '22.99'),
(166, 137, 21, '3 Piece Tray Set', 1, '54.99'),
(167, 138, 28, 'Brower Sofa Dumdum Charcoal Pillows:Self', 1, '349.99'),
(170, 139, 28, 'Beckham Chaise Sofa Zumba Seal Pillows Self', 1, '1149.00'),
(171, 142, 24, 'Powell Kitchen Cart', 1, '299.40'),
(172, 144, 16, 'Uma Rotating Mirror Shelf', 1, '99.88'),
(173, 146, 10, 'Folding Tray Table', 1, '89.99'),
(185, 147, 19, 'Swivel Rocker ', 1, '288.88'),
(176, 147, 3, 'Shelf', 1, '79.99'),
(177, 147, 17, 'allure rug', 1, '229.00'),
(179, 149, 16, 'Three Hands Bookcase', 1, '79.88'),
(181, 103, 3, 'Canceled Layaway', 1, '-179.25'),
(182, 153, 18, 'Custom Cushions Dupione Stone Set See ', 1, '837'),
(183, 154, 28, 'Berger Chaise Sofa Hanover Concrete', 1, '951.20'),
(208, 178, 10, 'Garden Stool', 1, '149.99'),
(186, 147, 18, 'Pillow', 1, '14.99'),
(187, 159, 28, 'Bosco Corner Sofa Left Gorman Birch Pillow Maggie Aqua', 1, '503.40'),
(188, 159, 28, 'Bosco Right Facing One Armed Loveseat Gorman Birch Pillow Maggie Aqua', 1, '389.40'),
(191, 161, 10, 'Planter', 1, '22.99'),
(192, 161, 10, 'Planter Small', 1, '9.99'),
(193, 162, 28, 'Pantego Recliner Fabric TBD', 1, '769.00'),
(195, 163, 28, 'Newton Sofa Bozeman Silt ( Picture Reflects Silhouette Not Color )', 1, '499.88'),
(196, 165, 16, 'Clock Table', 1, '77.99'),
(197, 166, 2, 'Large Blue Basket', 1, '12.99'),
(198, 166, 2, 'Small Green Basket', 1, '5.99'),
(199, 168, 16, 'Simplicity Honey Dining Table', 1, '259.00'),
(200, 168, 16, 'Honey Grid Dining Chairs', 3, '89.99'),
(201, 168, 16, 'Honey Bench', 1, '99.99'),
(202, 168, 28, 'Kaylee 50s Swivel Glider Powder', 1, '599.00'),
(203, 168, 28, 'Kaylee Glide Ottoman Powder', 1, '289.00'),
(204, 169, 28, 'Jeffrey Upholstered Long Sofa Edwin Grey Pillows Self', 1, '1589.00'),
(205, 171, 16, 'Urban Lodge Media Unit 42 Inch Acacia Brown Rough Hewn Finish', 1, '419.00'),
(206, 176, 33, 'Teal Bread Box', 1, '54.99'),
(225, 193, 16, 'Metropolis Wood Seat Low Back Counter Stool 26in Gunmetal', 4, '71.99'),
(209, 179, 24, 'Aishni Wave Buffet', 1, '699.00'),
(211, 180, 27, 'Shanilee Round Table D299-14', 1, '175.20'),
(212, 181, 14, 'Blue Plastic Soap Dish', 1, '8.99'),
(213, 181, 12, 'Blue Soap Rock', 1, '12.99'),
(214, 181, 20, 'Large Purple Glass Vase', 1, '19.88'),
(215, 181, 10, 'Large Green Plant Pot', 1, '16.88'),
(216, 183, 1, '5 Tier Chrome Urban Shelf', 1, '159.99'),
(217, 184, 25, 'Power Popper EXAMPLE', 1, '11.99'),
(267, 217, 3, 'Bookcase Folding 3 Tier Natural', 1, '99.99'),
(220, 186, 24, 'Ashley Beringer Table', 1, '299.00'),
(221, 187, 16, 'Durango Dresser', 1, '719.10'),
(222, 190, 16, 'Natures Edge Sofa Table', 2, '231.20'),
(223, 191, 16, 'Simplicity Honey Grid Back Dining Chair', 1, '71.99'),
(224, 191, 23, 'Christmas Carousel', 1, '21.49'),
(226, 191, 23, 'Nutcracker', 1, '17.49'),
(229, 191, 23, 'Nutcracker', 1, '29.99'),
(228, 191, 23, 'Snow Globe', 1, '13.99'),
(230, 194, 28, 'Mariko Accent Chair Espresso Finish Aquamarine Fabric', 1, '479.20'),
(236, 197, 6, 'Big Ass Thing', 1, '1000'),
(238, 199, 16, 'Avignon Table', 1, '169.00'),
(240, 203, 16, 'Tiburon Shelf', 1, '239.40'),
(241, 204, 19, 'Papasan Taupe Pad', 1, '229.00'),
(242, 205, 16, 'Dresser', 1, '233.32'),
(244, 206, 36, 'Champlain woodhcart Map -20%', 1, '239.20'),
(245, 207, 16, 'Natures Edge Bench 70in', 1, '209.40'),
(262, 209, 28, 'Bosco Sectional Loveseat', 1, '679.20'),
(248, 209, 7, 'Crock Utensil White', 1, '14.99'),
(261, 213, 28, 'Tilly Twin Sleeper Floor Model -10%', 1, '799.99'),
(251, 211, 17, 'Bliss Grey Heather 3x5', 1, '103.99'),
(264, 209, 28, 'Bosco Sectional Sofa Chaise', 1, '799.20'),
(255, 209, 16, 'Hampton Bay Writing Desk', 1, '369.00'),
(259, 212, 9, 'Global amici glass', 4, '11.99'),
(265, 215, 28, 'Kaylee Swivel Glider Teal 2887-20202', 1, '479.20'),
(266, 216, 28, 'Berger Sofa Chaise Hanover Concrete', 1, '1091.30'),
(268, 217, 5, 'Donuts Earphone', 1, '19.99'),
(269, 217, 5, 'Slat Crates', 2, '11.99'),
(270, 219, 28, 'Bosco Sectional Corner Sofa Curious Eclipse Pillows Self', 1, '1049.00'),
(271, 219, 28, 'Bosco Sectional Loveseat Curious Eclispe Pillows Self', 1, '849.00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `layItems`
--
ALTER TABLE `layItems`
  ADD PRIMARY KEY (`li_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `layItems`
--
ALTER TABLE `layItems`
  MODIFY `li_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=274;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
