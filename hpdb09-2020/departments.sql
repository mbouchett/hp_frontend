-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 27, 2020 at 05:51 PM
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
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `dept_ID` int(7) NOT NULL,
  `dept_name` text NOT NULL,
  `dept_belongs_to` int(11) NOT NULL,
  `area_ID` int(11) NOT NULL,
  `dept_key` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf32;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`dept_ID`, `dept_name`, `dept_belongs_to`, `area_ID`, `dept_key`) VALUES
(1, 'Shelving', 1, 2, 3),
(2, 'Organization', 2, 3, 8),
(3, 'Garden Furniture', 3, 3, 3),
(4, 'Household', 4, 3, 8),
(5, 'Miscellaneous Lower Level', 5, 3, 8),
(6, 'Stationery', 6, 1, 13),
(7, 'Kitchen Storage', 7, 1, 1),
(8, 'Kitchen', 8, 1, 1),
(9, 'Table Top', 9, 1, 5),
(10, 'Garden', 10, 3, 4),
(11, 'Candles', 11, 4, 11),
(12, 'Personal Care', 12, 4, 2),
(13, 'Zen', 13, 4, 2),
(14, 'Bath Decor', 14, 4, 2),
(16, 'Furniture Accents', 16, 2, 3),
(17, 'Rugs', 17, 2, 7),
(18, 'Pillows', 18, 2, 8),
(19, 'Dining Furniture', 19, 2, 4),
(20, 'Decorative Accessories', 20, 2, 8),
(21, 'Sink and Cleaning', 21, 1, 1),
(22, 'Gift Cards', 22, 1, 0),
(23, 'Seasonal Items', 23, 1, 15),
(24, 'Kitchen Furniture & Carts', 24, 1, 3),
(25, 'Toys', 25, 2, 10),
(26, 'Lamps & Lighting', 26, 2, 9),
(27, 'Window Coverings', 27, 2, 8),
(28, 'Upholstered Furniture', 28, 2, 3),
(29, 'Greeting Cards', 29, 1, 13),
(30, 'Kitchen Electrics', 30, 1, 1),
(31, 'Bedding', 31, 2, 2),
(32, 'Cook and Bakeware', 32, 1, 1),
(33, 'Entertaining and Service', 33, 1, 1),
(34, 'Knives', 34, 1, 1),
(36, 'Vermont Items', 36, 1, 14),
(230, 'Toys Kawaii', 25, 2, 10),
(231, 'Posters', 50, 2, 8),
(45, 'Personal Accessories', 45, 4, 2),
(44, 'Bathroom Hardware', 44, 4, 2),
(43, 'Room Fresheners', 43, 4, 2),
(42, 'Bath Accessories', 42, 4, 2),
(229, 'Outdoor Pillows', 18, 2, 4),
(41, 'Candle Holders', 41, 4, 11),
(61, 'Travel Accessories', 5, 3, 0),
(62, 'Food', 8, 1, 0),
(63, 'Candy', 8, 1, 0),
(64, 'Gift Bags', 6, 1, 0),
(65, 'Journals & Notebooks', 6, 1, 13),
(66, 'Wall Clocks', 37, 1, 8),
(67, 'Metal Signs', 6, 1, 8),
(15, 'Beaded Curtains', 15, 3, 8),
(69, 'Drink Dispensers', 33, 1, 0),
(70, 'Glass Food Storage & Jars', 7, 1, 0),
(71, 'Plastic Food Storage', 7, 1, 0),
(72, 'Spice Jars & Racks', 7, 1, 0),
(73, 'Bottles', 7, 1, 0),
(74, 'Baking Accessories', 8, 1, 1),
(75, 'Barbeque', 8, 1, 1),
(76, 'Cutting Boards', 8, 1, 1),
(77, 'Kitchen Gadgets', 8, 1, 0),
(78, 'Sauces', 8, 1, 0),
(79, 'Measuring Devices', 8, 1, 0),
(80, 'Kitchen Utensils', 8, 1, 0),
(1002, 'Paper Lanterns', 26, 2, 0),
(82, 'Asian Dinnerware', 9, 1, 5),
(83, 'Barware', 9, 1, 6),
(84, 'Coasters', 9, 1, 0),
(85, 'Dinnerware', 9, 1, 5),
(86, 'Flatware', 9, 1, 0),
(87, 'Glassware', 9, 1, 5),
(88, 'Table Linens', 9, 1, 5),
(89, 'Mugs', 9, 1, 5),
(90, 'Outdoor Entertaining', 9, 1, 0),
(91, 'Pitchers', 9, 1, 0),
(92, 'Ramekins', 9, 1, 5),
(94, 'Travel Mugs & Sports Bottles', 9, 1, 1),
(95, 'Wine Racks', 9, 1, 0),
(97, 'Hammocks', 10, 1, 0),
(98, 'Garden Lights', 10, 1, 0),
(99, 'Flower Pots', 10, 1, 4),
(100, 'Windchimes Outdoor', 10, 1, 0),
(999, 'All Sale Items', 99, 1, 16),
(102, 'Body Care', 12, 4, 0),
(103, 'Incense & Oils', 13, 4, 0),
(227, 'Seasonal Candle Holders', 23, 4, 0),
(106, 'Shower Curtains', 14, 4, 0),
(108, 'Jewelry Accessories & Charms', 45, 4, 0),
(110, 'Bar Stools', 19, 2, 0),
(111, 'Dining Furniture Top Floor', 19, 2, 0),
(112, 'Furniture Hardware & Accessories', 16, 2, 0),
(114, 'Poufs', 16, 2, 3),
(116, 'Doormats', 17, 2, 7),
(117, 'Outdoor Rugs', 17, 2, 0),
(118, 'Rug Pads', 17, 2, 0),
(119, 'Chair Cushions', 18, 2, 0),
(120, 'Rocking Chair Cushions', 18, 2, 0),
(121, 'Decorative Balls', 20, 2, 0),
(122, 'Decorative Boxes', 20, 2, 0),
(123, 'Frames', 50, 2, 0),
(124, 'Dried Grasses', 20, 2, 0),
(125, 'Wall Mirrors', 50, 2, 0),
(127, 'Vases', 20, 2, 0),
(128, 'Canvas Art', 50, 2, 0),
(129, 'Wind Chimes Wooden and Capiz', 20, 2, 0),
(130, 'Aprons', 21, 1, 1),
(131, 'Pet Toys', 51, 1, 0),
(132, 'Christmas Decor', 23, 1, 0),
(133, 'Easter', 23, 1, 0),
(53, 'Halloween & Thanksgiving', 53, 1, 15),
(136, 'Holiday Crackers', 23, 1, 0),
(137, 'Holiday Lights', 23, 1, 0),
(138, 'Ornaments', 23, 1, 0),
(139, 'Christmas Table Top', 23, 1, 0),
(144, 'Toys Fun Stuff', 25, 2, 10),
(141, 'Toys Bath', 25, 2, 10),
(142, 'Toys Puzzles & Brainteasers ', 25, 2, 10),
(143, 'Toys Arts & Crafts', 25, 2, 10),
(145, 'Kids Furniture', 25, 2, 0),
(146, 'Toys Games', 25, 2, 10),
(147, 'Toys Musical ', 25, 2, 10),
(148, 'Toys Novelty', 25, 2, 10),
(149, 'Toys Nostalgig & Classic', 25, 2, 10),
(150, 'Toys Outdoor', 25, 2, 10),
(151, 'Toys Pretend Play', 25, 2, 10),
(152, 'Toys Puppets', 25, 2, 10),
(153, 'Toys Science ', 25, 2, 10),
(154, 'Toys Stuffed Animals', 25, 2, 10),
(155, 'Toys Toddler & Infant', 25, 2, 10),
(156, 'Toys Vehicles', 25, 2, 10),
(157, 'Toys Wind Up', 25, 2, 10),
(158, 'Toys Winter Fun', 25, 2, 10),
(159, 'Upholstered Chairs', 28, 2, 0),
(160, 'Upholstered Ottomans', 28, 2, 0),
(161, 'Upholstered Sofas', 28, 2, 0),
(162, 'Anniversary Cards', 29, 1, 0),
(163, 'Birthday Cards', 29, 1, 0),
(164, 'Christmas Cards', 29, 1, 0),
(165, 'Get Well Cards', 29, 1, 0),
(166, 'Holiday Cards', 29, 1, 0),
(167, 'Life Moment Cards', 29, 1, 0),
(168, 'Any Occasion Cards', 29, 1, 0),
(169, 'Sympathy Cards', 29, 1, 0),
(170, 'Thank You Cards', 29, 1, 0),
(171, 'Vermont Cards', 29, 1, 0),
(172, 'Wedding Cards', 29, 1, 0),
(173, 'Boxed Cards', 29, 1, 0),
(174, 'Baby Cards', 29, 1, 0),
(175, 'Blenders', 30, 1, 0),
(176, 'Coffee Makers', 30, 1, 0),
(177, 'Food Processors', 30, 1, 0),
(178, 'Coffee Grinders', 30, 1, 0),
(179, 'Electric Juicers', 30, 1, 0),
(180, 'Electric Kettles', 30, 1, 0),
(181, 'Electric Milk Frothers', 30, 1, 0),
(182, 'Popcorn Makers', 30, 1, 0),
(183, 'Electric Sandwich Presses', 30, 1, 0),
(184, 'Toasters', 30, 1, 0),
(185, 'Waffle Makers', 30, 1, 0),
(186, 'Throw Blankets', 31, 2, 2),
(188, 'Tapestries', 31, 2, 0),
(189, 'Salad Bowls', 33, 1, 0),
(190, 'Butter Dishes', 33, 1, 0),
(191, 'Coffee', 33, 1, 0),
(192, 'Hot Sauces', 8, 1, 0),
(193, 'Ice Trays & Ice Cream Accessories', 9, 1, 0),
(194, 'Mortar & Pestle', 8, 1, 0),
(195, 'Cruets & Dressing Bottles', 33, 1, 0),
(196, 'Salt & Pepper Shakers & Mills', 33, 1, 0),
(197, 'Serving Trays', 33, 1, 0),
(198, 'Tea', 33, 1, 8),
(50, 'Wall Decor', 50, 2, 8),
(202, 'Bookcases or Bookshelves', 49, 2, 0),
(51, 'Pets', 51, 3, 12),
(226, 'Seasonal Candles', 11, 4, 0),
(203, 'Single Shelves', 1, 3, 0),
(204, 'Storage Baskets', 2, 3, 0),
(205, 'Trash Cans', 2, 3, 0),
(206, 'Hooks', 2, 3, 0),
(207, 'Jewelry Organizers', 2, 3, 0),
(208, 'Kitchen Organizers', 2, 3, 0),
(209, 'Home Office', 2, 3, 0),
(211, 'Desk Chairs', 49, 2, 0),
(212, 'Desks and File Cabinets', 49, 2, 0),
(214, 'Cleaning', 4, 3, 0),
(215, 'Dish Racks & Sink Supplies', 4, 3, 0),
(216, 'Laundry', 4, 3, 0),
(217, 'Alarm Clocks', 5, 3, 8),
(218, 'Bags & Totes', 5, 3, 0),
(219, 'Toys Desk Top', 25, 2, 0),
(220, 'Tech Accessories', 5, 3, 0),
(221, 'Home Improvement', 5, 3, 0),
(222, 'Key Chains & Key Caps', 5, 3, 0),
(223, 'Lunchbags & Accessories', 5, 3, 0),
(224, 'Nightlights', 5, 3, 0),
(225, 'Desk Lamps', 26, 2, 9),
(235, 'Thanksgiving', 53, 1, 0),
(236, 'Garden Stools', 10, 1, 0),
(1003, 'String Lights', 26, 2, 0),
(1004, 'Novelty Lighting', 26, 2, 0),
(1005, 'Lamp Shades', 26, 2, 0),
(1006, 'Lighting Accessories', 26, 2, 0),
(1007, 'Lightbulbs', 26, 2, 0),
(1010, 'Sheets', 31, 2, 0),
(1011, 'Duvet Covers', 31, 2, 0),
(1012, 'Quilt Sets', 31, 2, 0),
(1017, 'Toys Seasonal Holiday ', 25, 2, 0),
(1018, 'Toys Seasonal Holiday Puzzles', 25, 2, 0),
(1019, 'Photo Storage', 50, 2, 0),
(37, 'Clocks', 37, 1, 37),
(1020, 'Pillows Seasonal', 18, 2, 0),
(1021, 'Tea Water Kettles', 33, 1, 0),
(1022, 'Seasonal Kitchen', 23, 1, 0),
(1023, 'Seasonal Table Top', 23, 1, 0),
(1024, 'Easter Cards', 29, 1, 13),
(1025, 'Passover Cards', 29, 1, 13),
(1026, 'Graduation Cards', 29, 1, 13),
(1027, 'Mothers Day Cards', 29, 1, 13),
(1028, 'Fathers Day Cards', 29, 1, 13),
(1030, 'Toys Puzzles for Kids', 25, 2, 0),
(49, 'Office Furniture', 49, 2, 0),
(237, 'Special Days', 23, 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`dept_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `dept_ID` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1033;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
