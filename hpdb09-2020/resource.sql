-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 27, 2020 at 05:55 PM
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
-- Table structure for table `resource`
--

CREATE TABLE `resource` (
  `resource_ID` int(10) NOT NULL,
  `resource_num` int(4) DEFAULT NULL,
  `resource_firstName` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `resource_lastName` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `resource_userName` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `resource_phone` tinytext COLLATE utf8_unicode_ci,
  `resource_email` tinytext COLLATE utf8_unicode_ci,
  `resource_password` text COLLATE utf8_unicode_ci NOT NULL,
  `resource_firstDay` date NOT NULL,
  `resource_lastDay` date DEFAULT NULL,
  `resource_payChange` date NOT NULL,
  `resource_hourly` decimal(8,2) DEFAULT NULL,
  `resource_salary` decimal(11,2) DEFAULT NULL,
  `resource_level` int(3) NOT NULL DEFAULT '1',
  `resource_notes` text COLLATE utf8_unicode_ci,
  `resource_com` tinyint(1) DEFAULT '0',
  `resource_ptcom` tinyint(1) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `resource`
--

INSERT INTO `resource` (`resource_ID`, `resource_num`, `resource_firstName`, `resource_lastName`, `resource_userName`, `resource_phone`, `resource_email`, `resource_password`, `resource_firstDay`, `resource_lastDay`, `resource_payChange`, `resource_hourly`, `resource_salary`, `resource_level`, `resource_notes`, `resource_com`, `resource_ptcom`) VALUES
(1010, 623, 'Martina', 'Anderson', 'manderson', '802-917-3703', 'martina.anderson.wagner@gmail.com', '$2SjFCDOhA54E', '2015-06-05', '2017-01-01', '2015-06-05', 10.00, NULL, 1, NULL, 0, 0),
(1011, 620, 'Jenny', 'Brown', 'jbrown', '802-881-8231', 'jtbrown@homeportonline.com', '$2Gg3MnL36s..', '2015-06-05', '2017-09-19', '2015-06-05', 10.00, NULL, 1, NULL, 0, 0),
(1012, 628, 'Keegan', 'Buckley', 'kbuckley', '401-744-8525', 'kxxgxn23@aim.com', '$2TwMeInBFg/Q', '2015-06-05', '2017-01-01', '2015-06-05', 9.50, NULL, 1, NULL, 0, 0),
(1013, 629, 'Caitlin', 'Coon', 'kcoon', '860-987-2284', 'caitlin.anne.coon@gmail.com', '$2u2ZJOgFteuQ', '2015-06-05', '2017-01-01', '2015-06-05', 9.50, NULL, 1, NULL, 0, 0),
(1014, 589, 'Kelsey', 'Cunningham', 'kmarita', '802-825-5255', 'kelsey.marita@gmail.com', '$2zVycWt84ihc', '2015-06-08', '2017-01-01', '2015-06-08', 11.00, NULL, 1, NULL, 0, 0),
(1015, 610, 'Ana', 'DiMarino', 'adimarino', '978-844-6602', 'ana01720@gmail.com', '$2qBQaI8UFwOQ', '2015-06-08', '2017-05-26', '2015-06-08', 13.00, NULL, 5, NULL, 0, 0),
(1016, 77, 'Georgia', 'Hendrickson', 'geh', '802-238-2714', 'backyardmaplevt@hotmail.com', '$2mV0NZp92R3g', '2015-12-18', '2017-07-31', '2015-08-06', 15.00, NULL, 1, NULL, 0, 0),
(1017, 617, 'Megan', 'Kastner', 'mkastner', '330-831-2259', 'mkastner@homeportonline.com', '$2FMYZStghTVU', '2015-06-08', '2017-01-01', '2015-06-08', 11.00, NULL, 1, NULL, 0, 0),
(1018, 587, 'Taryn', 'Maitland', 'tmaitland', '917-922-2297', 'tmaitland@homeportonline.com', '$2a$07$theclockswerestrikinge29qBK.W0xK2XUuVp5pI9679CWpZK7wW', '2015-06-08', '2020-01-11', '2020-01-27', 16.00, NULL, 3, NULL, 0, 0),
(1019, 607, 'Geoff', 'Matthews', 'gmatthews', '802-734-2641', 'gmatthews@homeportonline.com', '$2Dx/.55PHsiw', '2015-06-08', '2017-05-03', '2015-08-25', 13.00, NULL, 1, NULL, 0, 0),
(1020, 602, 'Olivia', 'Matthews', 'omatthews', '802-734-6411', 'oliviamatthews@cvuhs.org', '$2lVksH4lzXaQ', '2015-06-08', '2017-01-01', '2015-06-08', 10.50, NULL, 1, NULL, 0, 0),
(1021, 622, 'Amanda', 'Richard', 'arichard', '802-881-7706', 'amanda.homeport@gmail.com', '$2P3/lU8fzLJk', '2015-06-08', '2017-07-21', '2015-06-08', 13.00, NULL, 3, NULL, 0, 0),
(1022, 584, 'Emma', 'Riesner', 'eriesner', '802-233-8421', 'emmariesner@gmail.com', '$2.zAowiDlZGw', '2015-06-08', '2017-01-01', '2015-06-08', 10.00, NULL, 1, NULL, 0, 0),
(1023, 565, 'Stephanie', 'Riggs', 'smriggs', '802-777-3650', 'sriggs@homeportonline.com', '$2a$07$theclockswerestrikingeqkYwlBpJyk8NNvzA9VFNQSLDa4VlwaO', '2011-08-03', '2018-08-11', '2015-08-06', 11.50, NULL, 1, 'Stopped Work: 08/30/2016\r\nRehired: 11/27/2017', 0, 0),
(1024, 627, 'Brian', 'Shepard', 'bshepard', '860-798-6904', 'brianshep6@yahoo.com', '$29pwXWv9ap0k', '2015-06-08', '2017-01-01', '2015-06-08', 10.00, NULL, 1, NULL, 0, 0),
(1025, 569, 'Derek', 'Spear', 'dspear', '802-598-7776', 'Spear670@gmail.com', '$2a$07$theclockswerestrikingeAUKu/haLVQhcPWYI.2aDqcr0g2OmyVG', '2015-06-08', '2019-08-15', '2019-01-30', 13.00, NULL, 1, NULL, 0, 0),
(1026, 625, 'Maggie', 'Stevens', 'mstevens', '802-376-3256', 'maggiestevens96@gmail.com', '$2a$07$theclockswerestrikingeqomjqBBVsK7X/9xG4yJiONaKdtWaRxS', '2015-03-29', '2019-08-07', '2019-12-16', 15.00, NULL, 1, NULL, 0, 0),
(1027, 614, 'Liz', 'Thompson', 'Lthompson', '802-782-9210', 'lthompson@homeportonline.com', '$2OAyuGqv7aFA', '2015-06-08', '2017-01-01', '2015-06-08', 10.50, NULL, 1, NULL, 0, 0),
(1028, 624, 'Toby', 'Wasserman', 'twasserman', '802-881-9590', 'twasserman@homeportonline.com', '$284.coBJIN3o', '2015-06-08', '2017-01-01', '2015-09-24', 11.50, NULL, 1, NULL, 0, 0),
(1029, 6, 'Frank', 'Bouchett', 'fbouchett', '802-373-1036', 'fbouchett@homeportonline.com', '$2a$07$theclockswerestrikingeDgj/FVpXBn2/b68oGOXM56KC1Ep/172', '1983-12-01', NULL, '2015-06-10', NULL, 1.00, 3, NULL, 0, 0),
(1030, 160, 'Mark', 'Bouchett', 'mbouchett', '802-373-1035', 'mark@homeportonline.com', '$2a$07$theclockswerestrikingeTBgGxwkCtREfiks/u8XOKQajcrOeVQO', '1992-05-15', NULL, '2017-02-08', NULL, 1.00, 6, NULL, 0, 0),
(1031, 5, 'Betty', 'Bouchett', 'bbouchett', '802-373-1037', 'bbouchett@aol.com', '$2a$07$theclockswerestrikingeAhk4mCKb0rps5tgKuWMzxxKoksD1IYy', '1983-12-01', NULL, '2015-06-10', NULL, 1.00, 5, NULL, 0, 0),
(1032, 414, 'François', 'Bouchett', 'francois', '802-363-0546', 'francois@homeportonline.com', '$2a$07$theclockswerestrikingeg.18SvjygiHnDRLcUAc8GjumX.ryzu2', '2003-06-03', NULL, '2015-06-10', NULL, 2.00, 5, NULL, 0, 0),
(1033, 507, 'Angélie', 'Bouchett', 'abouchett', '802-373-1038', 'homeportap@gmail.com', '$2a$07$theclockswerestrikingefVUZzoQcBpqhSpuBIWNTXWEdmNxfZA.', '2007-09-14', NULL, '2015-06-10', NULL, 1.00, 5, NULL, 0, 0),
(1034, 1, 'Teri', 'Lacroix', 'tlacroix', '802-860-1598', 'tlacroix@homeportonline.com', '$2a$07$theclockswerestrikinge2mzMAKN8WlunKKKXKUH/Pgek7ASb1.y', '1983-12-01', NULL, '2015-06-17', NULL, 1.00, 3, NULL, 1, 0),
(1035, 114, 'Carolle', 'Bouchett', 'cbouchett', '802-373-3246', 'clbouchett@hotmail.com', '$2a$07$theclockswerestrikingeZy..P//zC2HEM8fPEVWdrG/irGFh8mS', '1992-12-16', NULL, '2017-11-13', 14.00, NULL, 1, NULL, 0, 0),
(1036, 534, 'Shawna ', 'Bevins', 'sbevins', '802-922-8745', 'sbevins@homeportonline.com', '$2a$07$theclockswerestrikingeGFcqDthLQKvNFzmlkMgOFSWzLAlcE/2', '2008-08-05', '2019-12-24', '2019-12-02', 16.00, NULL, 3, NULL, 0, 0),
(1037, 630, 'Anne', 'Clymer', 'aclymer', '203-448-7009', 'a.e.clymer@gmail.com', '$2hvBJJ30RepA', '2015-06-08', '2017-01-01', '2015-08-26', 10.00, NULL, 1, NULL, 0, 0),
(1038, 606, 'Jade', 'Humphreys', 'jhumphreys', '603-236-1905', 'jhumphreys@homeportonline.com', '$2mV0NZp92R3g', '2015-09-03', '2017-01-01', '2015-09-03', 10.00, NULL, 1, NULL, 0, 0),
(1039, 631, 'Caitlin', 'Greve', 'cgreve', '413-772-9685', 'caitlinjgreve@gmail.com', '$2Ok.50kwqcZ.', '2015-09-16', '2017-01-01', '2015-09-16', 10.00, NULL, 1, NULL, 0, 0),
(1040, 632, 'Camille', 'Koosmann', 'ckoosmann', '802-503-2117', 'camille.koosmann@mymail.champlain.edu', '$2mV0NZp92R3g', '2015-09-16', '2018-01-01', '2015-09-16', 11.00, NULL, 5, 'Actual Last Day: 2017-04-07\r\nWorked a few days at the holidays 2017', 0, 0),
(1041, 468, 'Jessie', 'Holmes', 'jholmes', '802-777-5171', 'holmesjessie5@gmail.com', '$2maMJbE.R01E', '2015-09-23', '2017-01-01', '2015-09-23', 10.00, NULL, 1, NULL, 0, 0),
(1042, 633, 'Jesse', 'Foote', 'jfoote', '781-591-9722', 'jessefoote7@gmail.com', '$2mV0NZp92R3g', '2015-09-25', '2017-01-01', '2015-09-25', 10.50, NULL, 1, NULL, 0, 0),
(1043, 635, 'Francesca', 'Caulder', 'fcaulder', '484-620-9470', 'francesca.caulder@mymail.champlain.edu', '$2mV0NZp92R3g', '2015-10-02', '2017-01-01', '2015-10-02', 10.00, NULL, 1, NULL, 0, 0),
(1044, 634, 'Megan', 'Majonen', 'mmajonen', '802-829-0483', 'mmajonen@homeportonline.com', '$2i9O1E36E7Jg', '2015-10-01', '2017-05-23', '2015-10-01', 10.50, NULL, 1, NULL, 0, 0),
(1045, 636, 'Lauren', 'Belanger', 'lbelanger', '802-355-1508', 'lauren.belanger145@gmail.com', '$2a$07$theclockswerestrikingePVyPY05mSz9sbtOna2H6mcV9r7He7xm', '2015-10-22', '2019-09-13', '2019-07-29', 14.00, NULL, 1, NULL, 0, 0),
(1046, 637, 'Anna', 'Buhrmaster', 'abuhrmaster', '518-859-7788', 'abuhrmas@uvm.edu', '$2o9STGR8Olb.', '2015-11-08', '2017-01-01', '2015-11-08', 10.00, NULL, 1, NULL, 0, 0),
(1047, 599, 'Alexa', 'Delorge', 'adelorge', '802-922-8777', 'adelorge.hp@gmail.com', '$2a$07$theclockswerestrikingeHuM9cAqdBXH7KcLhw4bvfIYUycrO2cG', '2013-11-05', '2019-06-03', '2017-09-11', 14.25, NULL, 5, NULL, 0, 0),
(1048, 638, 'Hayley', 'Adams', 'hadams', '603-312-9312', 'hadams@homeportonline.com', '$2aeEqnba3Wt6', '2015-11-18', '2016-01-21', '2015-11-18', 10.00, NULL, 1, NULL, 0, 0),
(1049, 639, 'Princess', 'Somefun', 'psomefun', '347-922-1225', 'psomefun@uvm.edu', '$2mV0NZp92R3g', '2016-03-10', '2017-01-01', '2016-03-10', 10.00, NULL, 1, NULL, 0, 0),
(1050, 640, 'Merrushe', 'Sulejmani', 'msulejmani', '802-825-7508', 'msulejmani@homeportonline.com', '$2mV0NZp92R3g', '2016-03-10', '2017-01-01', '2016-03-10', 10.00, NULL, 1, NULL, 0, 0),
(1051, 641, 'Sabrina', 'Parker', 'sparker', '301-466-0219', 'smparkr@gmail.com', '$27LZfkk7HU7c', '2016-04-04', '2017-08-26', '2016-04-04', 11.50, NULL, 1, NULL, 0, 0),
(1052, 642, 'Callie', 'Braceras', 'cbraceras', '802-578-8141', 'thesecondparallel@gmail.com', '$2mV0NZp92R3g', '2016-04-07', '2017-01-01', '2016-05-12', 10.50, NULL, 1, NULL, 0, 0),
(1053, 643, 'Leah', 'Cawthorn', 'lcawthorn', '860-874-3683', 'lcawthor@uvm.edu', '$2mV0NZp92R3g', '2016-04-13', '2017-01-01', '2016-04-13', 10.00, NULL, 1, NULL, 0, 0),
(1054, 644, 'Nick', 'Amore', 'namore', '202-441-6213', 'namore@homeportonline.com', '$2mV0NZp92R3g', '2016-04-26', '2017-01-01', '2016-04-26', 10.00, NULL, 1, NULL, 0, 0),
(1055, 645, 'Kylen', 'Veilleux', 'kveilleux', '603-785-2661', 'kylieveilleux@gmail.com', '$2mV0NZp92R3g', '2016-05-04', '2017-01-01', '2016-05-04', 10.00, NULL, 1, NULL, 0, 0),
(1056, 646, 'Aidan', 'Cohen', 'acohen', '646-300-0186', 'aidancohen129@gmail.com', '$221H/Mrcx1u6', '2016-05-18', '2017-01-01', '2016-05-18', 10.50, NULL, 1, NULL, 0, 0),
(1057, 647, 'Alison', 'Conley', 'aconley', '781-733-4337', 'AET95@wildcats.uhn.edu', '$2mV0NZp92R3g', '2016-06-01', '2016-08-16', '2016-06-01', 10.00, NULL, 1, NULL, 0, 0),
(1058, 648, 'Hayley', 'Martin', 'hmartin', '443-534-9217', 'hmartin@homeportonline.com', '$2mV0NZp92R3g', '2016-07-28', '2016-12-23', '2016-07-28', 11.00, NULL, 1, NULL, 0, 0),
(1059, 650, 'Alister', 'Marble', 'amarble', '802-393-7118', 'alister.homeport@gmail.com', '$2a$07$theclockswerestrikingeaVGgSi/LmGZuJ87Nlf3aNhHH26Lx25e', '2016-08-11', '2019-05-09', '2017-09-11', 14.00, NULL, 1, NULL, 0, 0),
(1060, 649, 'Ava', 'Myette', 'amyette', '802-380-6009', 'myette_ava@wheatoncollege.edu', '$2mV0NZp92R3g', '2016-08-11', '2017-01-01', '2016-08-11', 10.00, NULL, 1, NULL, 0, 0),
(1074, 663, 'Brandon', 'Bouchett', 'BrandonB', '000-000-0000', '00000@gmail.com', '$2mV0NZp92R3g', '2017-01-02', '2016-12-24', '2017-01-02', 10.00, NULL, 1, NULL, 0, 0),
(1061, 651, 'Clare', 'Cecil', 'ccecil', '914-629-4308', 'mcecil@uvm.edu', '$2a$07$theclockswerestrikingeZy..P//zC2HEM8fPEVWdrG/irGFh8mS', '2016-08-20', '2018-01-21', '2017-04-24', 11.00, NULL, 1, NULL, 0, 0),
(1062, 652, 'Amber', 'Gagnon', 'agagnon', '518-618-7645', 'agagnon3@uvm.edu', '$2mV0NZp92R3g', '2016-09-11', '2017-04-18', '2016-09-11', 11.00, NULL, 1, NULL, 0, 0),
(1063, 653, 'Kellie', 'Folsom', 'kfolsom', '802-324-4572', 'fooliecoolie10@gmail.com', '$2ma7wz6kUy72', '2016-09-16', '2017-01-01', '2016-09-16', 11.00, NULL, 1, NULL, 0, 0),
(1064, 654, 'Olivia', 'Mead', 'omead', '802-735-5259', 'olivia.mead@colchestersd.org', '$2mV0NZp92R3g', '2016-09-25', '2017-02-08', '2016-09-25', 10.50, NULL, 1, NULL, 0, 0),
(1065, 655, 'Brianna', 'Cheringal', 'bcheringal', '551-427-7601', 'bcheringal@homeportonline.com', '$2mV0NZp92R3g', '2016-10-12', '2017-01-01', '2016-10-12', 10.00, NULL, 1, NULL, 0, 0),
(1066, 621, 'Catie', 'Michael', 'cmichael', '802-777-8835', 'catie2000@gmail.com', '$2mV0NZp92R3g', '2016-10-22', '2017-01-01', '2016-10-22', 10.00, NULL, 1, NULL, 0, 0),
(1067, 656, 'Josie', 'Fox', 'jfox', '802-488-4187', 'josephinefox@cssu.org', '$2a$07$theclockswerestrikinge206WI.TbsO5VaxfgM4fdInUSOtJ2Fa.', '2016-11-01', '2018-08-25', '2017-09-11', 12.00, NULL, 1, NULL, 0, 0),
(1068, 657, 'Smita', 'Boesch-Dining', 'sboeschdining', '603-369-0994', 'sboeschdining@gmail.com', '$2mV0NZp92R3g', '2016-11-04', '2017-01-01', '2016-11-04', 10.00, NULL, 1, NULL, 0, 0),
(1069, 658, 'Justin', 'Tanner', 'jtanner', '802-379-7367', 'thaddeustanner@icloud.com', '$2fPXAWOROzu2', '2016-11-06', '2016-12-31', '2016-11-06', 10.50, NULL, 1, NULL, 0, 0),
(1070, 659, 'Eva', 'Murray', 'emurray', '603-706-2759', 'eva.murray222@gmail.com', '$2mV0NZp92R3g', '2016-11-12', '2017-03-11', '2016-11-12', 11.00, NULL, 1, NULL, 0, 0),
(1071, 660, 'Victoria', 'Martin', 'vmartin', '802-777-1438', 'vmartin.homeport@gmail.com', '$2a$07$theclockswerestrikingejNngp1fRY7/2MqlGMujTbVZo4GR/Mei', '2016-11-17', '2018-07-14', '2017-09-11', 14.00, NULL, 1, NULL, 0, 0),
(1072, 661, 'Eva', 'Sachsse', 'esachsse', '802-281-2287', 'evassachsse@gmail.com', '$2mV0NZp92R3g', '2016-11-20', '2017-08-15', '2017-04-24', 11.00, NULL, 1, NULL, 0, 0),
(1073, 662, 'Adam', 'McCarron', 'amccarron', '802-363-7227', 'adam.mccarron@programmer.net', '$2jmg1SoMeSaU', '2016-11-25', '2017-03-17', '2016-11-25', 10.50, NULL, 1, NULL, 0, 0),
(1075, 664, 'Nicole', 'Bouchett', 'nbouchett', '000-000-0000', '00000@gmail.com', '$2mV0NZp92R3g', '2016-12-21', '2016-12-24', '2016-12-21', 10.00, NULL, 1, NULL, 0, 0),
(1076, 665, 'Chloe', 'Hotaling', 'chotaling', '802-881-1299', 'chloe.hotaling8@gmail.com', '$2mV0NZp92R3g', '2017-03-14', '2017-03-20', '2017-03-14', 10.50, NULL, 1, NULL, 0, 0),
(1077, 666, 'Sunniva', 'Dutcher', 'sdutcher', '802-318-0512', 'sunniva.dutcher@gmail.com', '$2a$07$theclockswerestrikingeZy..P//zC2HEM8fPEVWdrG/irGFh8mS', '2017-03-15', '2018-01-18', '2017-09-11', 13.00, NULL, 1, NULL, 0, 0),
(1078, 667, 'Bethany', 'Harris', 'bharris', '609-423-8933', 'bharris7@uvm.edu', '$2mV0NZp92R3g', '2017-03-24', '2017-08-08', '2017-03-24', 10.50, NULL, 1, NULL, 0, 0),
(1079, 668, 'Anna', 'Cataldo', 'acataldo', '802-825-1456', 'acataldo@homeportonline.com', '$2mV0NZp92R3g', '2017-03-26', '2017-07-05', '2017-04-24', 10.50, NULL, 1, NULL, 0, 0),
(1080, 669, 'Charlotte', 'Nye', 'cnye', '978-766-0305', 'charlottenye24@gmail.com', '$2a$07$theclockswerestrikingeTm89BRRPbEg6TvKzagikAB5MAH.sdMq', '2017-04-17', NULL, '2019-07-15', 12.50, NULL, 5, NULL, 0, 0),
(1081, 670, 'Jocelyn', 'Girton', 'jgirton', '802-310-6444', 'jgirton@homeportonline.com', '$2mV0NZp92R3g', '2017-04-18', '2018-01-01', '2017-09-11', 13.00, NULL, 1, NULL, 0, 0),
(1082, 671, 'Miranda', 'Post', 'mpost', '847-849-3976', 'miranda.homeport@gmail.com', '$2a$07$theclockswerestrikingeDeA.JARKIgfyPmGaeZ3Ai7GGnNSdGHe', '2017-04-19', NULL, '2019-07-15', 14.00, NULL, 5, NULL, 0, 0),
(1083, 672, 'Benjamin', 'Febre', 'bfebre', '818-325-7134', 'bfebre@homeportonline.com', '$2mV0NZp92R3g', '2017-05-11', '2017-06-05', '2017-05-11', 11.00, NULL, 1, NULL, 0, 0),
(1084, 673, 'Patrick', 'Paniagua', 'ppaniagua', '202-906-7479', 'paniaguapatrick@gmail.com', '$2mV0NZp92R3g', '2017-06-06', '2017-01-01', '2017-06-06', 10.50, NULL, 1, NULL, 0, 0),
(1085, 674, 'Lily', 'Sevin', 'lsevin', '410-919-3642', 'lsevin@uvm.edu', '$2mV0NZp92R3g', '2017-08-04', '2017-10-08', '2017-08-04', 12.00, NULL, 1, NULL, 0, 0),
(1086, NULL, 'Megan', 'Magnuson', 'mmagnuson', '802-233-9370', 'meganmagnuson@gmail.com', '$2mV0NZp92R3g', '2017-08-15', '2017-08-15', '2017-08-15', 13.00, NULL, 1, NULL, 0, 0),
(1087, 677, 'Alex', 'Deneve', 'adeneve', '201-669-4787', 'alextdeneve@gmail.com', '$2a$07$theclockswerestrikinge222rrx1cmmtN95DbgALKqVtn6ZxaC.K', '2017-08-18', '2018-05-03', '2017-08-24', 12.00, NULL, 1, NULL, 0, 0),
(1088, 676, 'Manriel', 'Grant', 'mrashid', '802-310-2417', 'manrielgrant@gmail.com', '$2a$07$theclockswerestrikingexjiXSJMiRK.t0ZCgK/3aKTLGkkivYG6', '2017-08-22', '2018-11-01', '2017-08-22', 13.00, NULL, 1, NULL, 0, 0),
(1089, 682, 'Olivia', 'Buesser', 'obuesser', '603-581-5164', 'buesserolivia@gmail.com', '$2mV0NZp92R3g', '2017-08-29', '2017-09-02', '2017-08-29', 13.00, NULL, 1, NULL, 0, 0),
(1090, 679, 'Tyler', 'Malone', 'tmalone', '408-332-9997', 'tylermalone@me.com', '$2mV0NZp92R3g', '2017-09-05', '2017-09-29', '2017-09-05', 13.00, NULL, 1, NULL, 0, 0),
(1091, 680, 'Marissa', 'Swartley', 'mswartley', '860-480-1273', 'marissa.swartley@uvm.edu', '$2mV0NZp92R3g', '2017-09-05', '2017-09-06', '2017-09-05', 12.00, NULL, 1, NULL, 0, 0),
(1092, 681, 'Maggie', 'Brown', 'mbrown', '860-819-9819', 'maggiebrownr@gmail.com', '$2a$07$theclockswerestrikingeZy..P//zC2HEM8fPEVWdrG/irGFh8mS', '2017-09-09', '2018-04-20', '2017-09-09', 12.00, NULL, 1, NULL, 0, 0),
(1093, 687, 'Sasha', 'Fisher', 'sfisher', '518-802-7250', 'fishercsasha@gmail.com', '$2ZWH.DFI3b.s', '2017-09-09', '2017-10-19', '2017-09-09', 13.00, NULL, 1, NULL, 0, 0),
(1095, 683, 'Karianne', 'Shetter', 'kshetter', '7178732597', 'kshett@gmail.com', '$2mV0NZp92R3g', '2017-09-12', '2018-01-01', '2017-09-12', 13.00, NULL, 1, NULL, 0, 0),
(1096, 684, 'Alyson', 'Campbell', 'acampbell', '802-522-6562', 'alcamp4@gmail.com', '$2mV0NZp92R3g', '2017-09-12', '2017-09-13', '2017-09-12', 12.00, NULL, 1, NULL, 0, 0),
(1097, 685, 'Alyssa(2018-07-12)', 'Zajan', 'azajan', '802-399-1911', 'alyssazajan@gmail.com', '$2a$07$theclockswerestrikingeptG2AKbhW.gCE6OgHGAw4S3cutWJcUe', '2017-09-12', '2018-07-12', '2017-09-12', 13.00, NULL, 1, NULL, 0, 0),
(1098, 686, 'Eliza', 'Dunne', 'edunne', '917-282-7113', 'eliza.homeport@gmail.com', '$2mV0NZp92R3g', '2017-09-18', '2017-01-01', '2017-11-20', 11.00, NULL, 1, NULL, 0, 0),
(1099, 544, 'Gary', 'Bevins', 'gbevins', '802-363-0098', 'gbevins@homeportonline.com', '$2mV0NZp92R3g', '2017-09-19', '2017-11-04', '2017-09-19', 14.00, NULL, 1, NULL, 0, 0),
(1100, 688, 'Angela', 'Cefarello', 'acefarello', '802-383-8106', 'acefarello@homeportonline.com', '$2a$07$theclockswerestrikingekE4cEAzUhickmQlU328sHn6tcVlguBy', '2017-09-26', NULL, '2019-12-30', 13.50, NULL, 5, NULL, 0, 0),
(1101, 689, 'Phoebe', 'Diamond', 'pdiamond', '401-743-4440', 'phdiamond97@gmail.com', '$2a$07$theclockswerestrikingeg8O8w2pQooDHgm6cw3UjDIKOqQujCSK', '2017-10-19', '2019-06-03', '2019-01-14', 14.00, NULL, 1, NULL, 0, 0),
(1102, 690, 'Alex', 'Medina', 'amedina', '518-596-3082', 'ale.medina.murga@hotmail.es', '$2a$07$theclockswerestrikingeFcsH5mqJ2mbZ4YKJcbuFxpueNoJtxei', '2017-11-10', '2019-05-31', '2019-04-08', 14.00, NULL, 1, NULL, 0, 0),
(1103, 691, 'Harrison', 'Miller', 'hmiller', '802-349-2987', 'Harriman1313@gmail.com', '$2a$07$theclockswerestrikingeIPDMkS9cHnO1y.sb.VHqlVkUa/sYaZ.', '2017-12-29', '2018-04-29', '2017-12-29', 13.00, NULL, 1, NULL, 0, 0),
(1104, 692, 'Hannah', 'Ryder', 'hryder', '972-802-1078', 'hashleyr@gmail.com', '$2a$07$theclockswerestrikingeZy..P//zC2HEM8fPEVWdrG/irGFh8mS', '2018-01-21', '2018-07-08', '2018-01-23', 12.00, NULL, 1, NULL, 0, 0),
(1107, 694, 'Emily', 'Bruggeman', 'ebruggeman', '860-230-3170', 'ebruggem@uvm.edu', '$2a$07$theclockswerestrikingepQ87pbDoBd5IXLJLLRULC4xNDocXSIK', '2018-02-15', '2020-01-18', '2018-02-15', 12.00, NULL, 1, NULL, 0, 0),
(1105, 693, 'Feora', 'Leveillee', 'fleveillee', '802-879-3038', 'feleveillee@gmail.com', '$2mV0NZp92R3g', '2018-01-27', '2018-01-28', '2018-01-27', 12.00, NULL, 1, NULL, 0, 0),
(1108, 695, 'Claire', 'Deckers', 'cdeckers', '208-724-4122', 'cdeckers@uvm.edu', '$2a$07$theclockswerestrikingeZy..P//zC2HEM8fPEVWdrG/irGFh8mS', '2018-04-03', '2018-07-01', '2018-04-03', 12.00, NULL, 1, NULL, 0, 0),
(1109, 696, 'Theo', 'Francis', 'tfrancis', '802-338-6557', 'theofx21x@gmail.com', '$2a$07$theclockswerestrikingeOzd9RPUPlqE03E8oiDhRWckvgRwZ0CK', '2018-05-07', '2019-09-25', '2018-05-07', 13.00, NULL, 1, NULL, 0, 0),
(1110, 697, 'Virginia', 'Schiavetta', 'vschiavetta', '914-712-5173', 'vschiave@uvm.edu', '$2a$07$theclockswerestrikingeLeUrLgF7BAsQ3usKq90UEnjIS3VTXaG', '2018-06-05', NULL, '2020-08-27', 13.50, NULL, 4, NULL, 0, 0),
(1111, 698, 'Isabelle', 'Schechter', 'ischechter', '973-289-9463', 'ischecht@uvm.edu', '$2a$07$theclockswerestrikingeZy..P//zC2HEM8fPEVWdrG/irGFh8mS', '2018-06-05', '2019-02-03', '2018-06-05', 12.00, NULL, 1, NULL, 0, 0),
(1112, 700, 'Sara', 'Erickson', 'serickson', '802-324-6705', 'sara.erickson@uvm.edu', '$2a$07$theclockswerestrikingeBaOfFPlvNCFczOZPPZe0FUxHX3ANx5m', '2018-06-05', NULL, '2018-06-05', 13.00, NULL, 1, NULL, 0, 1),
(1113, 699, 'Madison', 'Mcnamara', 'mmcnamara', '978-460-5804', 'mmcnama7@uvm.edu', '$2a$07$theclockswerestrikingeMf..Xg251.Ye8avn4y6HzQy7QBl.7bm', '2018-06-12', '2018-08-18', '2018-06-12', 12.00, NULL, 1, NULL, 0, 0),
(1114, 701, 'Aidan', 'Marble', 'ammarble', '802-752-8446', 'aidan0374@gmail.com', '$2a$07$theclockswerestrikingeZy..P//zC2HEM8fPEVWdrG/irGFh8mS', '2018-07-18', '2019-07-16', '2018-07-18', 13.00, NULL, 1, NULL, 0, 0),
(1115, 702, 'Jessica', 'Davis', 'jdavis', '802-782-0467', 'jldjlh@yahoo.com', '$2a$07$theclockswerestrikingeOzQ5zNVhXAk1w72k/9lH0si7cfUVtTK', '2018-07-30', '2019-03-12', '2018-07-30', 13.00, NULL, 5, NULL, 0, 0),
(1116, 703, 'Maya', 'Davila', 'mdavila', '347-781-6227', 'mddavila15@wells.edu', '$2a$07$theclockswerestrikingenScTtAIp3PczG.tG62yTcVGPCgSekr.', '2018-09-06', '2020-03-15', '2019-11-18', 12.50, NULL, 1, NULL, 0, 0),
(1117, 704, 'Erin', 'Oconnor', 'eoconnor', '860-372-9028', 'erino2021@gmail.com', '$2a$07$theclockswerestrikingeZy..P//zC2HEM8fPEVWdrG/irGFh8mS', '2018-09-11', '2018-09-21', '2018-09-11', 11.00, NULL, 1, NULL, 0, 0),
(1118, 705, 'Kate', 'Kehoe', 'kkehoe', '516-316-6996', 'katekehoe22@gmail.com', '$2a$07$theclockswerestrikingeZy..P//zC2HEM8fPEVWdrG/irGFh8mS', '2018-09-29', '2018-09-30', '2018-09-29', 12.00, NULL, 1, NULL, 0, 0),
(1119, 706, 'Taylor', 'Maynard', 'tmaynard', '802-689-0543', 'taylormaynard03@gmail.com', '$2a$07$theclockswerestrikingeP6SygZE0Qt.yZCSootzRZe.XIk38crm', '2018-10-02', '2020-04-29', '2019-03-25', 14.00, NULL, 1, NULL, 0, 0),
(1120, 707, 'Aafereen', 'Khan', 'akhan', '609-964-6363', 'Akhan@homeportonline.com', '$2a$07$theclockswerestrikingeZy..P//zC2HEM8fPEVWdrG/irGFh8mS', '2018-10-06', '2018-10-21', '2018-10-06', 11.00, NULL, 1, NULL, 0, 0),
(1121, 708, 'Rachel', 'Farber', 'rfarber', '973-787-4754', 'rfarber@homeportonline.com', '$2a$07$theclockswerestrikingeZy..P//zC2HEM8fPEVWdrG/irGFh8mS', '2018-10-24', '2018-10-24', '2018-10-24', 11.00, NULL, 1, NULL, 0, 0),
(1122, 709, 'Brittney', 'Arrigo', 'barrigo', '201-739-1177', 'brittarrigo@optonline.net', '$2a$07$theclockswerestrikingeZy..P//zC2HEM8fPEVWdrG/irGFh8mS', '2018-10-27', '2018-10-27', '2018-10-27', 11.00, NULL, 1, NULL, 0, 0),
(1123, 710, 'Annie', 'Mattogno', 'amattogno', '802-505-0983', 'anne-marie@mattogno.com', '$2a$07$theclockswerestrikingeZy..P//zC2HEM8fPEVWdrG/irGFh8mS', '2018-11-09', '2019-08-14', '2018-11-09', 12.00, NULL, 1, NULL, 0, 0),
(1124, 711, 'Shondra', 'Stoner', 'sstoner', '703-389-4231', 'shondra.lynn96@gmail.com', '$2a$07$theclockswerestrikingeZy..P//zC2HEM8fPEVWdrG/irGFh8mS', '2018-11-17', '2019-03-29', '2018-11-17', 11.00, NULL, 1, NULL, 0, 0),
(1126, 713, 'Emilie', 'Bernier', 'Ebernier', '802-881-6630', 'ebernier22@gmail.com', '$2a$07$theclockswerestrikingeZy..P//zC2HEM8fPEVWdrG/irGFh8mS', '2018-12-11', '2019-01-31', '2018-12-11', 11.50, NULL, 1, NULL, 0, 0),
(1125, 712, 'Ginger', 'Ijams', 'gijams', '704-999-4277', 'gingerijams@gmail.com', '$2a$07$theclockswerestrikingeZy..P//zC2HEM8fPEVWdrG/irGFh8mS', '2018-11-30', '2019-04-07', '2018-11-30', 12.50, NULL, 1, NULL, 0, 0),
(1127, 599, 'Alexa', 'Croto', 'acroto', '802-922-8777', 'ap@homeportonline.com', '$2a$07$theclockswerestrikingeZy..P//zC2HEM8fPEVWdrG/irGFh8mS', '2019-01-03', '2019-06-03', '2019-02-11', 13.25, NULL, 3, NULL, 0, 0),
(1128, NULL, 'Leah', 'MacLellan', 'lmaclellan', '906-869-4540', 'lmleah28@gmail.com', '$2a$07$theclockswerestrikingeZy..P//zC2HEM8fPEVWdrG/irGFh8mS', '2019-03-17', '2019-03-17', '2019-03-17', 12.50, NULL, 1, NULL, 0, 0),
(1129, 715, 'Uma', 'Tuco', 'utuco', '978-467-3794', 'umatuco@gmail.com', '$2a$07$theclockswerestrikingeZy..P//zC2HEM8fPEVWdrG/irGFh8mS', '2019-04-10', '2019-09-21', '2019-09-23', 12.50, NULL, 1, NULL, 0, 0),
(1130, 716, 'Stacey', 'Carson', 'scarson', '202-374-5959', 'smcarson@uvm.edu', '$2a$07$theclockswerestrikingeZy..P//zC2HEM8fPEVWdrG/irGFh8mS', '2019-04-10', '2020-06-01', '2019-04-10', 11.50, NULL, 1, NULL, 0, 0),
(1131, 714, 'Willa', 'Harrington', 'wharrington', '802-383-8408', 'wharrington@homeportonline.com', '$2a$07$theclockswerestrikingekLBxuXr/dRHNI6UBEBeIZ52U0C7UTVa', '2019-04-10', NULL, '2019-07-15', 13.00, NULL, 1, NULL, 0, 0),
(1132, 717, 'Caroline', 'Slack', 'cslack', '203-893-0157', 'cjslack@uvm.edu', '$2a$07$theclockswerestrikingeZy..P//zC2HEM8fPEVWdrG/irGFh8mS', '2019-04-17', '2019-11-01', '2019-04-17', 12.00, NULL, 1, NULL, 0, 0),
(1133, 718, 'Naomi', 'Chandler', 'nchandler', '860-707-9738', 'naomichandlerr@gmail.com', '$2a$07$theclockswerestrikingeZy..P//zC2HEM8fPEVWdrG/irGFh8mS', '2019-04-18', '2019-07-27', '2019-06-17', 12.50, NULL, 1, NULL, 0, 0),
(1134, 719, 'Julia', 'Bley', 'jbley', '224-548-6338', 'julia.bley@uvm.edu', '$2a$07$theclockswerestrikingeZy..P//zC2HEM8fPEVWdrG/irGFh8mS', '2019-05-14', '2019-07-27', '2019-05-14', 12.50, NULL, 1, NULL, 0, 0),
(1135, 720, 'Jaada', 'Longmore', 'jlongmore', '802-735-6688', 'jlongmore@homeportonline.com', '$2a$07$theclockswerestrikingeZy..P//zC2HEM8fPEVWdrG/irGFh8mS', '2019-06-04', '2019-06-04', '2019-06-04', 11.00, NULL, 1, NULL, 0, 0),
(1136, 721, 'Eliza', 'Ligon', 'eligon', '281-734-8797', 'ligoneliza@gmail.com', '$2a$07$theclockswerestrikingeZy..P//zC2HEM8fPEVWdrG/irGFh8mS', '2019-06-12', '2019-09-21', '2019-06-12', 12.00, NULL, 1, NULL, 0, 0),
(1137, 722, 'Alex', 'Devaux', 'adevaux', '802-735-3192', 'alex.devaux@emory.edu', '$2a$07$theclockswerestrikingeGGUnanT3.0CaHOFzjDstqHlCDGYOFri', '2019-06-14', '2019-08-19', '2019-06-14', 11.50, NULL, 3, NULL, 0, 0),
(1138, 723, 'Anna', 'Pace', 'apace', '802-353-4087', 'annakatpace@gmail.com', '$2a$07$theclockswerestrikingeZy..P//zC2HEM8fPEVWdrG/irGFh8mS', '2019-06-22', '2019-08-11', '2019-06-22', 12.00, NULL, 1, NULL, 0, 0),
(1139, 725, 'Haley', 'Greenyer', 'hgreenyer', '603-831-9092', 'hgreenyer@gmail.com', '$2a$07$theclockswerestrikingeZy..P//zC2HEM8fPEVWdrG/irGFh8mS', '2019-08-14', '2019-11-24', '2019-08-14', 12.50, NULL, 1, NULL, 0, 0),
(1140, 724, 'Dawson', 'Stapleton', 'dstapleton', '267-3779246', 'dawsons1098@gmail.com', '$2a$07$theclockswerestrikingeZy..P//zC2HEM8fPEVWdrG/irGFh8mS', '2019-08-20', '2019-12-22', '2019-08-20', 12.00, NULL, 1, NULL, 0, 0),
(1141, 728, 'Dylan', 'Elliott', 'delliott', '802-376-7465', 'dylan.homeport@gmail.com', '$2a$07$theclockswerestrikingedTto.OgsbibLNJRrcMhTsIgeBD6.J9q', '2019-09-02', '2020-06-05', '2019-09-02', 11.50, NULL, 3, NULL, 0, 0),
(1142, 726, 'Michaela', 'Phelan', 'mphelan', '973-452-9014', 'michaelafaithphelan@gmail.com', '$2a$07$theclockswerestrikingeZy..P//zC2HEM8fPEVWdrG/irGFh8mS', '2019-09-04', '2019-10-29', '2019-09-04', 12.00, NULL, 1, NULL, 0, 0),
(1143, 727, 'Matilda', 'Plumb', 'mplumb', '5185602683', 'goddessdameislife@gmail.com', '$2a$07$theclockswerestrikingeZy..P//zC2HEM8fPEVWdrG/irGFh8mS', '2019-09-04', '2019-12-20', '2019-09-04', 13.00, NULL, 1, NULL, 0, 0),
(1144, 729, 'Brianna', 'Lancaster', 'blancaster', '802-871-0810', 'blancaster@homeportonline.com', '$2a$07$theclockswerestrikingeZy..P//zC2HEM8fPEVWdrG/irGFh8mS', '2019-09-06', NULL, '2019-09-06', 11.50, NULL, 1, NULL, 0, 0),
(1155, 741, 'Alev', 'Vurgun', 'avurgun', '802-233-4916', 'vurguna@bsdvt.org', '$2a$07$theclockswerestrikingeZy..P//zC2HEM8fPEVWdrG/irGFh8mS', '2019-12-03', '2019-12-03', '2019-12-03', 12.00, NULL, 1, NULL, 0, 0),
(1145, 730, 'Gabriella', 'Bishop', 'grenteria', '802-399-9919', 'gbishop@homeportonline.com', '$2a$07$theclockswerestrikingenOl/WucnsDGL1EYWCMyTM.xYGyK6t9y', '2019-09-14', NULL, '2019-09-14', 12.50, NULL, 1, NULL, 0, 0),
(1146, 731, 'Thomas', 'Buffo', 'tbuffo', '860-965-5914', 'ThomasGBuffo@gmail.com', '$2a$07$theclockswerestrikingexXz6Pra.qN6o.LFIf0RQp/FZSKxKuoe', '2019-10-06', NULL, '2019-10-06', 12.00, NULL, 1, NULL, 1, 0),
(1147, 542, 'Lyndsay', 'Landrey', 'llandrey', '802-735-6986', 'llandrey@homeportonline.com', '$2a$07$theclockswerestrikingeZy..P//zC2HEM8fPEVWdrG/irGFh8mS', '2019-10-09', '2019-12-20', '2019-10-09', 12.00, NULL, 1, NULL, 0, 0),
(1148, 733, 'Allie', 'Kirchgessner', 'akirchgessner', '978-505-8779', 'alliekirch212@gmail.com', '$2a$07$theclockswerestrikingeEJeBURCMC.N.IWcQ9hyYmcwY9cHhP1K', '2019-10-14', '2020-03-08', '2019-10-14', 12.00, NULL, 1, NULL, 0, 0),
(1149, 732, 'Jack', 'Bongiovi', 'jbongiovi', '7328042464', 'jackbongi@gmail.com', '$2a$07$theclockswerestrikingeZy..P//zC2HEM8fPEVWdrG/irGFh8mS', '2019-10-15', '2019-10-20', '2019-10-15', 11.50, NULL, 1, NULL, 0, 0),
(1150, 734, 'Alex', 'Wedge', 'awedge', '978-799-5715', 'awedge@uvm.edu', '$2a$07$theclockswerestrikingeZy..P//zC2HEM8fPEVWdrG/irGFh8mS', '2019-10-25', NULL, '2019-10-25', 11.50, NULL, 5, NULL, 0, 0),
(1151, 735, 'Christopher', 'McCabe', 'cmccabe', '978-761-3783', 'cmccabe2@uvm.edu', '$2a$07$theclockswerestrikingeZy..P//zC2HEM8fPEVWdrG/irGFh8mS', '2019-11-07', NULL, '2019-11-07', 11.50, NULL, 1, NULL, 0, 0),
(1152, 736, 'Eva', 'Finkelstein', 'efinkelstein', '9148300203', 'evafinkelstein29@gmail.com', '$2a$07$theclockswerestrikingeZy..P//zC2HEM8fPEVWdrG/irGFh8mS', '2019-11-07', NULL, '2019-11-07', 11.50, NULL, 1, NULL, 0, 0),
(1153, 737, 'Grace', 'King', 'gking', '330-328-3000', 'glking@uvm.edu', '$2a$07$theclockswerestrikingeqPd27nYS.ymIY9W1MXzQdg5txGBAnQq', '2019-11-12', '2020-03-07', '2020-02-05', 12.00, NULL, 1, NULL, 0, 0),
(1154, 738, 'Jessie', 'Pascal', 'jpascal', '781-656-4114', 'pascal.jessie@gmail.com', '$2a$07$theclockswerestrikingeZy..P//zC2HEM8fPEVWdrG/irGFh8mS', '2019-11-19', '2019-12-26', '2019-11-19', 12.50, NULL, 1, NULL, 0, 0),
(1156, 739, 'Addy', 'Lefebvre', 'alefebvre', '802-734-6391', 'keyser.adrian4@gmail.com', '$2a$07$theclockswerestrikingeZy..P//zC2HEM8fPEVWdrG/irGFh8mS', '2019-12-05', '2020-03-14', '2019-12-05', 13.00, NULL, 1, NULL, 0, 0),
(1157, 740, 'Anika', 'Pruesse-Adams', 'apruesse', '999-999-9999', 'anika.pruesse@gmail.com', '$2a$07$theclockswerestrikingeZy..P//zC2HEM8fPEVWdrG/irGFh8mS', '2019-12-10', '2020-01-23', '2019-12-10', 12.50, NULL, 1, NULL, 0, 0),
(1159, 743, 'Mack', 'Baker', 'mbaker', '508-654-7730', 'Balancedpottery@gmail.com', '$2a$07$theclockswerestrikingeZpnA.grwf5uORrUyRlz3zTUegBq3Veu', '2020-01-22', '2020-04-03', '2020-01-22', 13.00, NULL, 1, NULL, 0, 0),
(1158, 745, 'Garett', 'MacLaren', 'gmaclaren', '860-318-6492', 'maclarengarett@gmail.com', '$2a$07$theclockswerestrikingei/GbEJu/fxhXthXSV8Xs.8h1YHqVsWe', '2020-01-12', NULL, '2020-01-12', 13.00, NULL, 1, NULL, 0, 0),
(1160, 744, 'Madison', 'Carlino', 'mcarlino', '802-825-6487', 'carlinomadison@gmail.com', '$2a$07$theclockswerestrikingeZy..P//zC2HEM8fPEVWdrG/irGFh8mS', '2020-01-23', '2020-02-20', '2020-01-23', 13.00, NULL, 1, NULL, 0, 0),
(1161, 742, 'Samantha', 'Petrelli', 'spatrelli', '410-830-0249', 'spetrell@uvm.edu', '$2a$07$theclockswerestrikingeHonZGc6/UjBhY/u6BvPpyfhAAYiKIle', '2020-01-23', '2020-03-24', '2020-01-23', 12.50, NULL, 1, NULL, 0, 0),
(1162, 746, 'Kayla', 'Willard', 'kwillard', '802-393-3798', 'willardk1@bsdvt.org', '$2a$07$theclockswerestrikingeZy..P//zC2HEM8fPEVWdrG/irGFh8mS', '2020-01-24', '2020-03-06', '2020-01-24', 12.50, NULL, 1, NULL, 0, 0),
(1163, 747, 'Aleah', 'Gatto', 'agatto', '201-450-2341', 'aleah.gatto97@gmail.com', '$2a$07$theclockswerestrikingeMDdIS24iVgpwi4oyNDNCVJzwg8vf9RG', '2020-02-04', '2020-07-16', '2020-02-04', 13.00, NULL, 1, NULL, 0, 0),
(1164, 748, 'Bernadette', 'Mukeba', 'bmukeba', '802-5561890', 'bernadettekyendamina@gmail.com', '$2a$07$theclockswerestrikingeKih3GqIL.axlTh1DWPjLw5d5ZL0LtQ2', '2020-08-06', NULL, '2020-08-06', 1.00, NULL, 1, NULL, 0, 0),
(1165, 749, 'Grace', 'Curtis', 'gcurtis', '617-678-5751', 'gmcurtis@uvm.edu', '$2a$07$theclockswerestrikingeZy..P//zC2HEM8fPEVWdrG/irGFh8mS', '2020-08-21', NULL, '2020-08-21', 13.00, NULL, 1, NULL, 0, 0),
(1166, 750, 'Katie', 'Hannon', 'khannon', '774-487-4623', 'kbhannon@uvm.edu', '$2a$07$theclockswerestrikingeZy..P//zC2HEM8fPEVWdrG/irGFh8mS', '2020-09-01', NULL, '2020-09-01', 13.00, NULL, 1, NULL, 0, 0),
(1167, 751, 'Liam', 'Greiner', 'lgreiner', '716-906-4548', 'liamgreiner@gmail.com', '$2a$07$theclockswerestrikingeZy..P//zC2HEM8fPEVWdrG/irGFh8mS', '2020-09-10', NULL, '2020-09-10', 12.50, NULL, 1, NULL, 0, 0),
(1168, 752, 'Anna', 'Duckworth', 'aduckworth', '203-233-0656', 'annalieved@gmail.com', '$2a$07$theclockswerestrikingeZy..P//zC2HEM8fPEVWdrG/irGFh8mS', '2020-09-15', NULL, '2020-09-15', 12.50, NULL, 1, NULL, 0, 0),
(1169, 752, 'Gabriella', 'Paulina', 'gpaulina', '802-379-3615', 'gabyella4@icloud.com', '$2a$07$theclockswerestrikingeZy..P//zC2HEM8fPEVWdrG/irGFh8mS', '2020-09-21', NULL, '2020-09-21', 12.50, NULL, 1, NULL, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `resource`
--
ALTER TABLE `resource`
  ADD PRIMARY KEY (`resource_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `resource`
--
ALTER TABLE `resource`
  MODIFY `resource_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1170;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
