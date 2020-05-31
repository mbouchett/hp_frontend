-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 04, 2019 at 12:01 PM
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
-- Table structure for table `music`
--

CREATE TABLE `music` (
  `recno` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `artist` text,
  `album` text,
  `song` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `music`
--

INSERT INTO `music` (`recno`, `date`, `artist`, `album`, `song`) VALUES
(291227, '2019-08-06 05:48:52', 'Illinois Jacquet\n', 'Jump N Jive\n', 'Illinois Blows the Blues\n'),
(291228, '2019-08-06 05:51:37', 'Patsy Cline\n', 'Pick Me Up On Your Way Down [UK]\n', 'Track 11\n'),
(291229, '2019-08-06 05:53:22', 'Sylvers\n', 'Unknown\n', 'Boogie Fever\n'),
(291230, '2019-08-06 05:56:52', 'Adam Ant\n', 'Unknown\n', 'Goody Two Shoes\n'),
(291231, '2019-08-06 06:00:22', 'The Pretenders\n', 'The Singles\n', 'Talk of the Town\n'),
(291232, '2019-08-06 06:07:37', 'Cream\n', '20th Century Masters-The Millennium Collection\n', 'White Room\n'),
(291233, '2019-08-06 06:12:38', 'Nina Simone\n', 'Divas Exotica\n', 'Feeling Good [*]\n'),
(291234, '2019-08-06 06:15:38', 'Dave Matthews Band\n', 'Crash\n', 'Lie in Our Graves\n'),
(291235, '2019-08-06 06:21:23', 'Patsy Cline\n', 'Pick Me Up On Your Way Down [UK]\n', 'Track 5\n'),
(291236, '2019-08-06 06:23:38', 'Elvis Costello\n', 'My Aim Is True\n', 'Alison\n'),
(291237, '2019-08-06 06:26:53', 'Harry Connick Jr.\n', 'Unknown\n', 'On the Atchison\n'),
(291238, '2019-08-06 06:34:53', 'Stevie Ray Vaughan and Double Trouble\n', 'The Sky Is Crying\n', 'Life by the Drop\n'),
(291239, '2019-08-06 06:37:23', 'Gene Chandler\n', 'Single\n', 'Duke of Earl\n'),
(291240, '2019-08-06 06:39:38', 'Lyle Lovett\n', 'I Love Everybody\n', 'I Love Everybody\n'),
(291241, '2019-08-06 06:43:23', 'Procol Harum\n', 'The Big Chill\n', 'A Whiter Shade of Pale\n'),
(291242, '2019-08-06 06:47:38', 'Glenn Miller Y Su Orquesta\n', 'Giants Of The Big Band Era\n', 'In The Mood\n'),
(291243, '2019-08-06 06:51:08', 'Dead Combo\n', 'Unknown\n', 'Cachupa Man\n'),
(291244, '2019-08-06 06:57:53', 'Jennifer Warnes\n', 'The Best of Joe Cocker [Capitol]\n', 'Up Where We Belong\n'),
(291245, '2019-08-06 07:03:53', 'Jazzamor\n', 'Lazy Sunday Afternoon\n', 'Things We Do for Love\n'),
(291246, '2019-08-06 07:11:23', 'The Beatles\n', 'Unknown\n', 'Long\n'),
(291247, '2019-08-06 07:20:38', 'Cab Calloway\n', 'Are You Hep to the Jive?\n', 'Boog It\n'),
(291248, '2019-08-06 07:23:38', 'Kinks\n', 'Top 40 Hitdossier-1965-1966\n', 'Dedicated Follower of Fashion\n'),
(291249, '2019-08-06 07:26:38', 'K7\n', 'The Mask [Original Soundtrack]\n', 'Hi de Ho\n'),
(291250, '2019-08-06 07:31:08', 'Duke Ellington/Louis Armstrong\n', 'Complete Sessions\n', 'Cotton Tail\n'),
(291251, '2019-08-06 07:38:38', 'Dave Clark Five\n', 'Unknown\n', 'Because\n'),
(291252, '2019-08-06 07:41:08', 'The Bangles\n', 'Greatest Hits\n', 'Following\n'),
(291253, '2019-08-06 07:47:09', 'Eric Clapton\n', 'Time Pieces\n', 'Cocaine\n'),
(291254, '2019-08-06 07:50:54', 'Django Reinhardt\n', 'Gold Collection [Fine Tune]\n', 'Limehouse Blues\n'),
(291255, '2019-08-06 07:54:09', 'They Might Be Giants\n', 'Mink Car\n', 'Mink Car\n'),
(291256, '2019-08-06 07:56:09', 'Lesley Gore\n', 'Best of Lesley Gore\n', 'What Am I Gonna Do With You?\n'),
(291257, '2019-08-06 07:59:24', 'Betece\n', 'Unknown\n', 'Africando\n'),
(291258, '2019-08-06 08:04:24', 'John Lennon\n', 'The John Lennon Collection\n', 'Instant Karma!\n'),
(291259, '2019-08-06 08:07:54', 'Roberto Puentes\n', 'Cuba Libre\n', 'Las Gallegas Bailan Mambo\n'),
(291260, '2019-08-06 08:10:54', 'OutKast\n', 'Unknown\n', 'Hey Ya\n'),
(291261, '2019-08-06 08:14:54', 'Tommy Roe\n', 'Unknown\n', 'Dizzy\n'),
(291262, '2019-08-06 08:17:39', 'Creedence Clearwater Revival\n', 'Chronicle\n', 'Proud Mary\n'),
(291263, '2019-08-06 08:20:54', 'Dwight Yoakam\n', 'Hillbilly Deluxe\n', 'Throughout All Time\n'),
(291264, '2019-08-06 08:27:24', 'Melanie\n', 'Unknown\n', 'Brand New Key\n'),
(291265, '2019-08-06 08:29:54', 'Van Morrison\n', 'The Best of Van Morrison [Mercury]\n', 'Sweet Thing\n'),
(291266, '2019-08-06 08:34:09', 'The Doors\n', 'Unknown\n', 'Riders On The Storm\n'),
(291267, '2019-08-06 08:45:24', 'Charles Brown\n', 'Jump N Jive\n', 'Evening Shadows\n'),
(291268, '2019-08-06 08:50:39', 'Beck\n', 'Odelay\n', 'Lord Only Knows\n'),
(291269, '2019-08-06 09:06:24', 'The Platters\n', 'Gold Collection [Fine Tune]\n', 'With This Ring\n'),
(291270, '2019-08-06 09:11:54', 'Sam Cooke\n', 'Single\n', 'Chain Gang\n'),
(291271, '2019-08-06 09:14:24', 'Rickey Nelson\n', 'Unknown\n', 'Poor Little Fool\n'),
(291272, '2019-08-06 09:21:24', 'Donna Summer\n', 'Single\n', 'She Works Hard For Her Mon\n'),
(291273, '2019-08-06 09:25:39', 'Steve Miller Band\n', 'Greatest Hits 1974-1978\n', 'Winter Time\n'),
(291274, '2019-08-06 09:28:39', 'Neil Young/The London Symphony Orchestra\n', 'Harvest\n', 'A Man Needs a Maid\n'),
(291275, '2019-08-06 09:32:54', 'The Beatles\n', 'Rubber Soul [UK]\n', 'In My Life\n'),
(291276, '2019-08-06 09:35:24', 'Michael Jackson\n', 'Unknown\n', 'Smooth Criminal\n'),
(291277, '2019-08-06 09:45:24', 'FOTC\n', 'Unknown\n', 'A Hilarious Misunderstanding\n'),
(291278, '2019-08-06 09:52:25', 'Louis Armstrong\n', 'All-Time Greatest Hits\n', 'Mack the Knife [Theme from Three Penny Opera]\n'),
(291279, '2019-08-06 09:59:55', 'James Taylor\n', 'Greatest Hits\n', 'Fire and Rain\n'),
(291280, '2019-08-06 10:03:10', 'Jimmy Cliff\n', 'The Harder They Come\n', 'Sitting in Limbo\n'),
(291281, '2019-08-06 10:08:10', 'Jazzamor\n', 'Lazy Sunday Afternoon\n', 'Sometimes\n'),
(291282, '2019-08-06 10:12:10', 'Carlos Gardel\n', 'El Rey del Tango\n', 'Mi Buenos Aires Querido\n'),
(291283, '2019-08-06 10:14:55', 'Squirrel Nut Zippers\n', 'Perennial Favorites\n', 'That Fascinating Thing\n'),
(291284, '2019-08-06 10:18:55', 'Cyl Farney\n', 'Woman on Top\n', 'Você\n'),
(291285, '2019-08-06 10:32:10', 'Dr Hook And The Medicine Show\n', 'Greatest Hits\n', 'Only 16\n'),
(291286, '2019-08-06 10:42:25', 'Louis Armstrong\n', 'French Kiss [Original Soundtrack]\n', 'La Vie en Rose\n'),
(291287, '2019-08-06 10:45:40', 'Jazzamor\n', 'Lazy Sunday Afternoon\n', 'Fly Me to the Moon\n'),
(291288, '2019-08-06 10:48:55', 'Charlie Parker\n', 'Midnight Jazz at Carnegie Hall [2 LPs]\n', 'Track 13\n'),
(291289, '2019-08-06 10:51:40', 'Carol King\n', 'Unknown\n', 'Will you still love me tomorro\n'),
(291290, '2019-08-06 10:54:25', 'The Guess Who\n', 'Single\n', 'Green Eyed Lady\n'),
(291291, '2019-08-06 11:01:40', 'Steve Miller Band\n', 'Greatest Hits 1974-1978\n', 'Wild Mountain Honey\n'),
(291292, '2019-08-06 11:06:26', 'Muddy Waters\n', 'The Real Folk Blues\n', 'Gypsy Woman\n'),
(291293, '2019-08-06 11:13:56', 'Ray Charles\n', 'Anthology\n', 'Cry\n'),
(291294, '2019-08-06 11:17:26', 'Jose Mangual Jr.\n', 'Unknown\n', 'Ritmo Con Ache\n'),
(291295, '2019-08-06 11:21:41', 'Buena Vista Social Club/Rubén González\n', 'Buena Vista Social Club\n', 'Pueblo Nuevo\n'),
(291296, '2019-08-06 11:27:56', 'Sam Cooke\n', 'The Best of Sam Cooke [RCA]\n', 'You Send Me\n'),
(291297, '2019-08-06 11:30:41', 'Cyrkle\n', 'Unknown\n', 'Red Rubber Ball\n'),
(291298, '2019-08-06 11:38:26', 'The Mamas \n', 'Greatest Hits\n', 'Dream a Little Dream of Me\n'),
(291299, '2019-08-06 11:41:41', 'Squirrel Nut Zippers\n', 'Hot\n', 'Hell\n'),
(291300, '2019-08-06 11:44:56', 'B.B. King\n', 'Paying the Cost to Be the Boss\n', 'The Letter\n'),
(291301, '2019-08-06 11:48:26', 'Joliet Jake Blues\n', 'Blues Brothers [Original Soundtrack]\n', 'Sweet Home Chicago\n'),
(291302, '2019-08-06 11:56:26', 'Jack Orchestra Pleiss\n', 'All-Time Greatest Hits\n', 'The Dummy Song\n'),
(291303, '2019-08-06 11:58:41', 'Mick Jagger\n', 'Goddess In The Doorway\n', 'Lucky Day\n'),
(291304, '2019-08-06 12:03:41', 'Toots Thielemans\n', 'French Kiss [Original Soundtrack]\n', 'I Love Paris\n'),
(291305, '2019-08-06 12:05:11', 'Jerry Lee Lewis\n', 'All Killer\n', 'Would You Take Another Chance on Me\n'),
(291306, '2019-08-06 12:11:11', 'Buena Vista Social Club/Eliades Ochoa\n', 'Buena Vista Social Club\n', 'Chan Chan\n'),
(291307, '2019-08-06 12:15:26', '37\n', 'Unknown\n', 'Unknown\n'),
(291308, '2019-08-06 12:20:56', 'Lloyd Price\n', 'Unknown\n', 'Personality\n'),
(291309, '2019-08-06 12:23:41', 'Neil Young/Stray Gators\n', 'Harvest\n', 'Heart of Gold\n'),
(291310, '2019-08-06 12:26:41', 'Buddy Holly\n', '20th Century Masters-The Millennium Collection\n', 'Think It Over\n'),
(291311, '2019-08-06 12:28:26', 'Big Mama Thornton\n', 'Hound Dog\n', 'Just Like a Dog (Barking up the Wrong Tree) [\n'),
(291312, '2019-08-06 12:31:11', 'Little Richard\n', 'Little Richard 18 Greatest Hit\n', 'Long Tall Sally\n'),
(291313, '2019-08-06 12:33:26', 'Andrew Bird\n', 'Single\n', 'Nuttin But Stringz\n'),
(291314, '2019-08-06 12:37:11', 'John Lennon\n', 'The John Lennon Collection\n', 'Dear Yoko\n'),
(291315, '2019-08-06 12:42:42', 'Olu Dara\n', 'In the World\n', 'Bubber (If Only)\n'),
(291316, '2019-08-06 12:45:57', 'ABBA\n', 'Unknown\n', 'Dancing Queen (awesome remix)\n'),
(291317, '2019-08-06 12:56:27', 'Buena Vista Social Club/Ibrahim Ferrer\n', 'Buena Vista Social Club\n', 'Dos Gardenias\n'),
(291318, '2019-08-06 12:59:42', 'Jimmy Jones\n', 'Billboard Top Rock \n', 'Handy Man\n'),
(291319, '2019-08-06 13:04:27', 'Manhattan Transfer\n', 'The Best of Manhattan Transfer\n', 'A Nightingale Sang in Berkeley Square\n'),
(291320, '2019-08-06 13:08:12', 'David Cassidy\n', 'Unknown\n', 'I Think I Love You\n'),
(291321, '2019-08-06 13:11:12', 'Madonna\n', 'Unknown\n', 'Material Girl\n'),
(291322, '2019-08-06 13:15:12', 'The Who\n', 'Unknown\n', 'K-Pinball Wizard\n'),
(291323, '2019-08-06 13:18:12', 'The Bluegrass Alliance\n', 'All American Bluegrass\n', 'Fox on the Run\n'),
(291324, '2019-08-06 13:20:27', 'The Zombies\n', 'The Greatest Hits\n', 'Imagine the Swan\n'),
(291325, '2019-08-06 13:26:12', 'Charles Mingus\n', 'Mingus Ah Um [Bonus Tracks]\n', 'Bird Calls [Unedited Form]\n'),
(291326, '2019-08-06 14:38:57', 'Buddy Guy\n', 'As Good as It Gets\n', 'Come See About Me\n'),
(291327, '2019-08-06 14:47:42', 'Muddy Waters\n', 'The Real Folk Blues\n', 'Same Thing\n'),
(291328, '2019-08-06 14:50:27', 'The Ink Spots\n', 'The Greatest Hits [MCA]\n', 'Java Jive\n'),
(291329, '2019-08-07 14:39:32', 'Rolling Stones\n', 'Hot Rocks\n', 'Play With Fire\n'),
(291330, '2019-08-07 14:41:47', 'Miles Davis\n', 'The Best of Miles Davis [Blue Note]\n', 'It Never Entered My Mind\n'),
(291331, '2019-08-07 14:48:32', 'Sam Cooke\n', 'The Best of Sam Cooke [RCA]\n', 'Only Sixteen\n'),
(291332, '2019-08-07 14:50:17', 'The Bangles\n', 'Greatest Hits\n', 'If She Knew What She Wants\n'),
(291333, '2019-08-07 14:54:17', 'Drifters\n', 'Single\n', 'Love Potion Number 9\n'),
(291334, '2019-08-07 14:56:17', 'Olu Dara\n', 'Neighborhoods\n', 'Neighborhoods\n'),
(291335, '2019-08-07 15:01:17', 'Edie Brickell\n', 'Picture Perfect Morning\n', 'Stay Awhile\n'),
(291336, '2019-08-07 15:05:47', 'Van Morrison\n', 'The Best of Van Morrison [Mercury]\n', 'Brown Eyed Girl\n'),
(291337, '2019-08-07 15:10:47', 'Jerry Lee Lewis\n', 'All Killer\n', 'One Minute Past Eternity\n'),
(291338, '2019-08-07 15:12:47', 'Armando Marcal\n', 'Unknown\n', 'Ilu Aye\n'),
(291339, '2019-08-07 15:20:47', 'Tom Petty \n', 'Greatest Hits\n', 'Even the Losers\n'),
(291340, '2019-08-07 15:24:17', 'Hayes\n', 'Unknown\n', 'Unknown\n'),
(291341, '2019-08-07 15:29:02', 'Bebo Valdes\n', 'Unknown\n', 'Oye Como Gozo\n'),
(291342, '2019-08-07 15:34:02', 'Creedence Clearwater Revival\n', 'Chronicle\n', 'Fortunate Son\n'),
(291343, '2019-08-07 15:36:17', 'Riders in the Sky\n', 'Yodel the Cowboy Way\n', 'At the End of the Rainbow Trail\n'),
(291344, '2019-08-07 15:45:32', 'Carlos Gardel\n', 'El Rey del Tango\n', 'Besame en la Boca\n'),
(291345, '2019-08-07 15:48:32', 'Paul Simon\n', 'The Concert In Central Park\n', 'Me And Julio Down By The Schoolyard\n'),
(291346, '2019-08-07 15:52:02', 'Miike Snow\n', 'Unknown\n', 'Song For No One\n'),
(291347, '2019-08-07 15:56:02', 'Dave Clark Five\n', 'Unknown\n', 'Catch Us If You Can\n'),
(291348, '2019-08-07 15:58:02', 'The Jungle Book\n', 'Unknown\n', 'I wanna be like you\n'),
(291349, '2019-08-07 16:02:02', 'Various\n', 'The Music Man\n', 'Shipoopi\n'),
(291350, '2019-08-07 16:04:17', 'Steve Miller Band\n', 'Greatest Hits 1974-1978\n', 'True Fine Love\n'),
(291351, '2019-08-07 16:07:02', 'Robert Johnson\n', 'King of the Delta Blues\n', 'Come on in My Kitchen\n'),
(291352, '2019-08-07 16:09:47', 'Roxy Music\n', 'Avalon\n', 'Avalon\n'),
(291353, '2019-08-07 16:14:02', 'Love Her Madly\n', 'Unknown\n', 'Love Her Madly\n'),
(291354, '2019-08-07 16:17:32', 'Stevie Ray Vaughan and Double Trouble\n', 'The Sky Is Crying\n', 'Wham!\n'),
(291355, '2019-08-07 16:29:02', 'John Lennon\n', 'The John Lennon Collection\n', 'Watching the Wheels\n'),
(291356, '2019-08-07 16:32:47', 'Pink Martini\n', 'Sympathique\n', 'Donde Estas Yolanda\n'),
(291357, '2019-08-07 16:36:02', 'Slim Whitman\n', 'Single\n', 'The Yodeler\n'),
(291358, '2019-08-07 16:37:47', 'Animal\n', 'Unknown\n', 'Mahna Mahna\n'),
(291359, '2019-08-07 16:40:02', 'The Beatles\n', 'Rubber Soul [UK]\n', 'Drive My Car\n'),
(291360, '2019-08-07 16:42:32', 'Jerry Lee Lewis\n', 'All Killer\n', 'To Make Love Sweeter for You\n'),
(291361, '2019-08-07 16:45:17', 'Midnight Oil\n', 'Unknown\n', 'Beds Are Burning\n'),
(291362, '2019-08-07 16:51:02', 'Dionne Warwick\n', 'Unknown\n', 'I Say A Little Prayer\n'),
(291363, '2019-08-07 16:56:02', 'The Beatles\n', 'White Album (Disc 2)\n', 'Birthday\n'),
(291364, '2019-08-07 16:58:47', 'Tony! Toni! Toné!\n', 'The Mask [Original Soundtrack]\n', 'Bounce Around\n'),
(291365, '2019-08-07 17:03:17', 'Ringo Star\n', 'Unknown\n', 'Oh My My\n'),
(291366, '2019-08-07 17:10:32', 'Odetta\n', 'A Tribute to Sister Rosetta Tharpe\n', 'Two Little Fishes and Five Loaves of Bread\n'),
(291367, '2019-08-07 17:14:02', 'Albert Ammons\n', 'Boogie Woogie Giants\n', 'Chicago in Mind\n'),
(291368, '2019-08-07 17:25:02', 'Riders in the Sky\n', 'Yodel the Cowboy Way\n', 'The First Cowboy Song\n'),
(291369, '2019-08-07 17:27:47', 'The Beau Brummels\n', 'The Best of the Beau Brummels\n', 'Just a Little\n'),
(291370, '2019-08-07 17:30:47', 'Paul Anka\n', 'Billboard Top Rock \n', 'Lonely Boy\n'),
(291371, '2019-08-07 17:33:32', 'The Andrews Sisters\n', 'Single\n', 'Rum And Coca Cola\n'),
(291372, '2019-08-07 17:36:47', 'Eric Burdon and the Animals\n', 'The Best of Eric Burdon and th\n', 'When I Was Young\n'),
(291373, '2019-08-07 17:39:47', 'Harry Neilson\n', 'Unknown\n', 'One Is The Lonliest Number\n'),
(291374, '2019-08-07 17:42:32', 'Various Artists\n', 'Mega Hits Dance Classics\n', 'Track 5\n'),
(291375, '2019-08-07 18:14:17', 'Tom Petty \n', 'Single\n', 'Angel Dream (No 2)\n'),
(291376, '2019-08-07 18:16:47', 'Roy Orbison\n', 'All Time Greatest Hits of Roy Orbison [DCC]\n', 'Love Hurts\n');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `music`
--
ALTER TABLE `music`
  ADD PRIMARY KEY (`recno`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `music`
--
ALTER TABLE `music`
  MODIFY `recno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=291377;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
