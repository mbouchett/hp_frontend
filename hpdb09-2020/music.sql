-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 27, 2020 at 05:54 PM
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
(291720, '2020-02-12 16:28:43', '25 Ring my bell', 'Single', '25 Ring my bell'),
(291721, '2020-02-12 16:32:15', 'N/A', 'N/A', 'George Thorogood - Move It On Over'),
(291578, '2020-02-10 18:54:44', 'Bobby Darin', 'The Ultimate Bobby Darin', 'Artificial Flowers'),
(291573, '2020-02-10 18:34:56', 'Chuck Berry', 'Best of Chuck Berry: 20th Century Masters', 'School Days'),
(291574, '2020-02-10 18:37:40', 'Chuck Berry', 'Best of Chuck Berry: 20th Century Masters', 'Sweet Little Sixteen'),
(291575, '2020-02-10 18:41:20', 'Bhupinder/Lata Mangeshkar', 'Golden Voices from the Silver Screen', 'Honton Pe Aisi Baat'),
(291576, '2020-02-10 18:49:12', 'Chuck Berry', 'Best of Chuck Berry: 20th Century Masters', 'You Never Can Tell'),
(291577, '2020-02-10 18:51:56', 'Lesley Gore', 'Best of Lesley Gore', 'California Nights'),
(291580, '2020-02-10 19:04:44', 'Carlos Gardel', 'Caliente: Tango y Mambo', 'Tango Argentino'),
(291581, '2020-02-10 19:09:39', 'Eric Clapton', 'Time Pieces: Best of Eric Clapton', 'After Midnight'),
(291582, '2020-02-10 19:12:48', 'Muddy Waters', 'The Real Folk Blues', 'Forty Days and Forty Nights'),
(291584, '2020-02-10 19:21:52', 'Jimmy Cliff', 'The Harder They Come', 'You Can Get It If You Really Want'),
(291586, '2020-02-10 19:46:33', 'N/A', 'N/A', 'Ska Cubano - Babalu'),
(291589, '2020-02-10 19:57:10', 'The Beatles', 'The Beatles (White Album) Disc 1', 'Martha My Dear'),
(291590, '2020-02-10 19:59:40', 'Gene Vincent', 'His 30 Original Hits', 'Crazy Legs'),
(291591, '2020-02-10 19:59:41', 'Buena Vista Social Club/Omara Portuondo', 'Buena Vista Social Club', 'Veinte AÃ±os'),
(291593, '2020-02-10 20:06:17', 'Muddy Waters', 'The Best of Muddy Waters [Chess]', 'Long Distance Call'),
(291596, '2020-02-10 20:28:57', 'Beck', 'Odelay', 'Hotwax'),
(291597, '2020-02-10 20:32:48', 'Jazzamor', 'Lazy Sunday Afternoon', 'Berimbou'),
(291598, '2020-02-10 20:36:07', 'Chuck Berry', 'Best of Chuck Berry: 20th Century Masters', 'Roll over Beethoven'),
(291599, '2020-02-10 20:38:32', 'Xavier Cugat', 'Caliente: Tango y Mambo', 'Granada'),
(291601, '2020-02-10 20:43:26', 'Ry Cooder', 'Crossroads', 'Viola Lee Blues'),
(291603, '2020-02-10 21:00:06', 'Riders in the Sky', 'Yodel the Cowboy Way', 'Cowpoke'),
(291604, '2020-02-10 21:01:49', 'Beach Boys', 'All-Time Greatest Hits', 'Track 5'),
(291602, '2020-02-10 20:48:49', 'The Platters', 'Gold Collection [Fine Tune]', 'I Believe'),
(291610, '2020-02-10 21:26:49', 'Janis Ian', 'A Tribute to Sister Rosetta Tharpe: Shout Sister', 'This Train'),
(291612, '2020-02-10 21:27:57', 'The Police', 'Every Breath You Take: The Singles', 'Invisible Sun'),
(291614, '2020-02-10 21:33:35', 'RFD Boys', 'All American Bluegrass', 'Rocky Top'),
(291621, '2020-02-10 22:05:44', 'The Temptations', 'Motown Legends, Vol. 3', 'I Wish It Would Rain'),
(291622, '2020-02-10 22:08:33', 'The Bangles', 'Greatest Hits', 'Everything I Wanted ['),
(291613, '2020-02-10 21:31:40', 'Sam Cooke', 'The Best of Sam Cooke [RCA]', 'Only Sixteen'),
(291615, '2020-02-10 21:36:50', 'The Diamonds', 'The Best of the Diamonds: The Mercury Years', 'Oh! Carol ['),
(291616, '2020-02-10 21:40:50', 'Charles Trenet', 'French Kiss [Original Soundtrack]', 'Verlaine'),
(291619, '2020-02-10 21:53:40', 'The Righteous Brothers', 'The Very Best of the Righteous Brothers: Unchained Melody', 'Hung on You'),
(291620, '2020-02-10 22:03:06', 'The Platters', 'Gold Collection [Fine Tune]', 'I Believe'),
(291617, '2020-02-10 21:44:05', 'The Blues Brothers', 'Briefcase Full of Blues', 'Hey Bartender'),
(291618, '2020-02-10 21:51:22', 'Annie Lennox', 'Diva', 'Keep Young and Beautiful [*]'),
(291623, '2020-02-10 22:12:12', 'Chuck Berry', 'Best of Chuck Berry: 20th Century Masters', 'Rock '),
(291625, '2020-02-10 22:19:24', 'Olu Dara', 'Neighborhoods', 'Neighborhoods'),
(291636, '2020-02-11 13:17:04', 'The Righteous Brothers', 'The Very Best of the Righteous Brothers: Unchained Melody', 'Unchained Melody'),
(291717, '2020-02-12 16:17:43', 'N/A', 'N/A', 'Leo Sayer - (1976) You Make Feel Like Dancing'),
(291719, '2020-02-12 16:25:24', 'Doors', 'Please Visit My Site!!!! More amusing stuff there!!', 'Doors - (1971) Love Her Madly'),
(291624, '2020-02-10 22:14:46', 'Creedence Clearwater Revival', 'Chronicle, Vol. 1', 'Susie-Q'),
(291626, '2020-02-10 22:24:20', 'Ray Charles', 'Anthology', 'Unchain My Heart'),
(291627, '2020-02-10 22:44:13', 'Buena Vista Social Club/Eliades Ochoa', 'Buena Vista Social Club', 'El Carretero'),
(291628, '2020-02-10 22:50:02', 'Bobby Darin', 'Billboard Top Rock ', 'Mack the Knife'),
(291630, '2020-02-10 22:50:34', 'N/A', 'N/A', 'Supertramp - Take The Long Way Home'),
(291633, '2020-02-10 23:01:09', 'Buddy Guy', 'As Good as It Gets', 'Fever'),
(291631, '2020-02-10 22:54:45', 'Gordon Jenkins ', 'All-Time Greatest Hits', 'Chloe'),
(291632, '2020-02-10 22:57:51', 'Cat Stevens', 'Tea For The Tillerman', 'Wild World'),
(291634, '2020-02-10 23:07:32', 'Stevie Ray Vaughan and Double Trouble', 'The Sky Is Crying', 'Empty Arms'),
(291635, '2020-02-10 23:11:04', 'David Bowie', 'The Best of David Bowie 1974/1979', 'Look Back in Anger'),
(291718, '2020-02-12 16:25:23', 'N/A', 'N/A', 'Edward Sharpe and the Magnetic Zeros - 40 Day Dream'),
(291611, '2020-02-10 21:26:49', 'Steve Miller Band', 'Greatest Hits 1974-1978', 'Threshold'),
(291629, '2020-02-10 22:50:23', 'Harry Belafonte', 'All Time Greatest Hits, Vol. 1', 'Jamaica Farewell'),
(291637, '2020-02-11 13:20:43', 'Gene Vincent', 'His 30 Original Hits', 'Be-Bop-A-Lula'),
(291638, '2020-02-11 13:23:21', 'Smokey Robinson ', 'Hits From 25 Years Vol 1', 'Tears of a Clown'),
(291639, '2020-02-11 13:26:23', 'Cat Stevens', 'The Very Best Of Cat Stevens', 'Another Saturday Night'),
(291640, '2020-02-11 13:28:54', 'Pink Martini', 'Sympathique', 'La Soledad'),
(291641, '2020-02-11 13:34:33', 'B.B. King', 'Paying the Cost to Be the Boss', 'Mr. Pawnbroker'),
(291642, '2020-02-11 13:37:50', 'David Bowie', 'The Best of David Bowie 1974/1979', 'Heroes [Single Version]'),
(291643, '2020-02-11 13:39:56', 'Duke Ellington/Louis Armstrong', 'Complete Sessions', 'In a Mellow Tone'),
(291644, '2020-02-11 13:47:50', 'The Flying Lizards', 'The Flying Lizards', 'Money'),
(291645, '2020-02-11 13:50:20', 'Jazzamor', 'Lazy Sunday Afternoon', 'Fly Me to the Moon'),
(291646, '2020-02-11 13:53:37', 'Queen', 'Single', 'We Will Rock You'),
(291647, '2020-02-11 13:58:40', 'Modern Nature', 'What Color', 'What Color'),
(291648, '2020-02-11 14:01:33', 'Smokey Robinson ', 'Hits From 25 Years Vol 1', 'Tears of a Clown'),
(291649, '2020-02-11 14:04:35', 'Sade', 'Stronger Than Pride', 'Turn My Back on You'),
(291650, '2020-02-11 14:10:44', 'Riders in the Sky', 'Yodel the Cowboy Way', 'Riding the Winds of the West'),
(291651, '2020-02-11 14:12:59', 'DeBarge', 'Motown 40 Forever Disc 2', 'All This Love'),
(291652, '2020-02-11 14:19:37', 'N/A', 'N/A', 'Paul Simon - That Was Your Mother'),
(291653, '2020-02-11 14:27:30', 'Martha ', 'Motown 40 Forever Disc 1', '(Love Is Like A) Heat Wave'),
(291654, '2020-02-11 14:31:39', 'N/A', 'N/A', 'Rolling Stones (1965) - Satisfaction'),
(291655, '2020-02-11 14:35:27', 'N/A', 'N/A', 'Peter '),
(291656, '2020-02-11 14:37:57', 'N/A', 'N/A', 'Go Gos - Vacation'),
(291657, '2020-02-11 14:40:59', 'Ike and Tina Turner', 'Billboard Hot 100 Singles 1971', 'Proud Mary'),
(291658, '2020-02-11 14:45:59', 'The Beau Brummels', 'The Best of the Beau Brummels: Golden Archive Series', 'Are You Happy'),
(291659, '2020-02-11 14:55:51', 'Jay McShann', 'Jump N Jive', 'On the Sunny Side of the Street'),
(291660, '2020-02-11 14:58:52', 'Buddy Holly', 'Billboard Top Rock ', 'Peggy Sue'),
(291661, '2020-02-11 15:01:25', 'Glenn Miller Y Su Orquesta', 'Giants Of The Big Band Era', 'In The Mood'),
(291662, '2020-02-11 15:08:04', 'N/A', 'N/A', 'Murray Head - One Night in Bangkok'),
(291663, '2020-02-11 15:14:43', 'N/A', 'N/A', 'Jan '),
(291664, '2020-02-11 15:17:12', 'Cher ', 'Half Breed', 'Cher - (1973) Half Breed'),
(291665, '2020-02-11 15:17:13', 'Annie Lennox', 'Diva', 'Precious'),
(291666, '2020-02-11 15:22:23', 'Ray Charles', 'Anthology', 'Hallelujah, I Love Her So'),
(291667, '2020-02-11 15:22:25', 'David Bowie', 'The Best of David Bowie 1974/1979', 'Sound and Vision'),
(291668, '2020-02-11 15:29:27', 'N/A', 'N/A', 'Men_Without_Hats - Safety_Dance'),
(291669, '2020-02-11 15:29:28', 'Harry Connick Jr.', 'Blue Light, Red Light', 'A Blessing and a Curse'),
(291670, '2020-02-11 15:32:35', 'George Thorogood And The Destroyers', 'The Baddest Of George Thorogood And The Destroyers', 'Bad To The Bone'),
(291671, '2020-02-11 15:37:33', 'DeBarge', 'Motown 40 Forever Disc 2', 'All This Love'),
(291672, '2020-02-11 15:41:44', 'Van Morrison', 'The Best of Van Morrison [Mercury]', 'Here Comes the Night'),
(291673, '2020-02-11 16:24:47', 'John Lennon', 'The John Lennon Collection', 'Power to the People'),
(291674, '2020-02-11 17:21:11', 'Victoria Spivey', 'House of Blues: Essential Women in Blues Disc 1', 'Dirty T.B. Blues'),
(291675, '2020-02-11 18:51:45', 'Big Mama Thornton', 'Hound Dog: The Peacock Recordings', 'Let Your Tears Fall Baby ['),
(291676, '2020-02-11 18:54:33', 'Jimmy Yancey', 'Boogie Woogie Giants', 'South Side Stuff'),
(291677, '2020-02-11 18:57:42', 'Miles Davis', 'The Best of Miles Davis [Blue Note]', 'Enigma'),
(291678, '2020-02-11 19:01:08', 'The Diamonds', 'The Best of the Diamonds: The Mercury Years', 'Daddy Cool'),
(291679, '2020-02-11 19:07:20', 'John Lennon', 'The John Lennon Collection', 'Give Peace a Chance'),
(291680, '2020-02-11 19:12:16', 'Les Ballets Africains', 'Guinea - Les Ballets Africains [UK]', 'Gombo'),
(291681, '2020-02-11 19:18:44', 'The Beatles', 'White Album (Disc 2)', 'Savoy Truffle'),
(291682, '2020-02-11 22:16:43', 'The Doors', 'Single', 'Light My Fire'),
(291683, '2020-02-11 22:19:13', 'Ramones', 'Single', 'Needles '),
(291684, '2020-02-11 23:00:37', 'Frank Sinatra', 'Come Fly With Me (D9)', 'Frank Sinatra - I Love Paris'),
(291685, '2020-02-11 23:00:38', 'Simon ', 'Forrest Gump [Original Soundtrack] Disc 1', 'Mrs. Robinson'),
(291686, '2020-02-11 23:04:31', 'Nena', 'Nena', '99 Luftballons'),
(291687, '2020-02-11 23:08:28', 'N/A', 'N/A', 'Rolling Stones (1966) - 19th Nervous Breakdown'),
(291688, '2020-02-11 23:12:29', 'Pomplamoose', 'Single', 'Another Day'),
(291689, '2020-02-11 23:14:47', 'Trout Fishing In America', 'Single', 'Boiled Okra and Spinach'),
(291690, '2020-02-11 23:18:00', 'N/A', 'N/A', 'Wilber Harrison - (1959) Kansas City'),
(291691, '2020-02-11 23:24:12', 'Jackie DeShannon', 'Forrest Gump [Original Soundtrack] Disc 1', 'What the World Needs Now Is Love'),
(291692, '2020-02-11 23:32:42', 'N/A', 'N/A', 'Joe Jackson - Breaking Us In Two'),
(291693, '2020-02-11 23:47:54', 'N/A', 'N/A', 'Troggs - Love Is All Around'),
(291694, '2020-02-12 00:02:19', 'Back to the Future Sound Track', 'Back to the Future Sound Track', 'Back in Time'),
(291695, '2020-02-12 00:06:26', 'N/A', 'N/A', 'Stylistics - (1973) Break Up To Make Up'),
(291696, '2020-02-12 00:10:29', 'The Doors', 'Single', 'Light My Fire'),
(291697, '2020-02-12 00:21:19', 'N/A', 'N/A', 'Supertramp - Breakfast In America'),
(291698, '2020-02-12 00:29:15', 'N/A', 'N/A', 'Jimi Hendrix - Let Me Light Your Fire'),
(291699, '2020-02-12 00:32:03', 'Bobby Vinton', 'The Essence Of Bobby Vinton', 'Bobby Vinton - (1963) Blue On Blue'),
(291700, '2020-02-12 00:38:02', 'Eric Burdon ', 'Greatest Hits', 'Sky Pilot (Long Version)'),
(291701, '2020-02-12 00:51:18', 'The Kinks', 'Ultimate Collection Disc 1', 'Apeman'),
(291702, '2020-02-12 00:55:14', 'Easybeats', 'Billboard Top 100 Of 1967', 'Easybeats - Friday On My Mind'),
(291703, '2020-02-12 00:57:52', 'Pomplamoose', 'Single', 'Another Day'),
(291704, '2020-02-12 01:00:11', 'Elvis Costello', 'Imperial Bedroom', 'Beyond Belief'),
(291705, '2020-02-12 01:06:25', 'N/A', 'N/A', 'Tommy Roe - Dizzy'),
(291706, '2020-02-12 01:09:16', 'Peter Frampton', 'Frampton Comes Alive', 'Do You Feel Like I Do?'),
(291707, '2020-02-12 01:23:04', 'Rolling Stones', 'Single', 'Time is on my side'),
(291708, '2020-02-12 01:30:08', 'Moonquake', 'Moonquake', 'Remember'),
(291709, '2020-02-12 01:40:09', 'The Dickies', 'Single', 'Killer Klowns from Outer Space'),
(291710, '2020-02-12 15:22:29', 'John Hiatt', 'Riding with the King [MFSL UDCD]', 'You May Already Be a Winner'),
(291711, '2020-02-12 15:26:12', 'The Doors', 'Single', 'Light My Fire'),
(291712, '2020-02-12 15:33:18', 'Various Artists', 'No.1 Hits Of The 60Â´s - Disc', 'Judy In Disguise (With Glasses'),
(291713, '2020-02-12 15:38:34', 'Thompson Twins', 'Single', 'Hold Me Now'),
(291714, '2020-02-12 16:01:16', 'N/A', 'N/A', 'Kingston Trio - (1963) Greenback Dollar'),
(291715, '2020-02-12 16:15:02', 'The Small Faces', 'Itchycoo Park - Their Greatest Hits', 'Itchycoo Park'),
(291716, '2020-02-12 16:15:04', 'VAN MORRISON', 'The Best Of Van Morrison', 'GLORIA'),
(291722, '2020-02-12 16:36:36', 'N/A', 'N/A', 'Jan '),
(291579, '2020-02-10 18:58:04', 'Neil Young/The London Symphony Orchestra', 'Harvest', 'A Man Needs a Maid'),
(291583, '2020-02-10 19:15:44', 'Buena Vista Social Club/RubÃ©n GonzÃ¡lez', 'Buena Vista Social Club', 'Pueblo Nuevo'),
(291585, '2020-02-10 19:46:32', 'Harry Connick Jr.', '25', 'Caravan'),
(291587, '2020-02-10 19:50:20', 'Joe Cocker', 'The Best of Joe Cocker [Capitol]', 'Sorry Seems to Be the Hardest Word'),
(291588, '2020-02-10 19:57:08', 'Gene Vincent', 'His 30 Original Hits', 'Frankie and Johnny'),
(291592, '2020-02-10 20:03:14', 'Eric Clapton', 'Time Pieces: Best of Eric Clapton', 'Promises'),
(291594, '2020-02-10 20:12:05', 'Diana Ross', 'Motown Legends, Vol. 3', 'Stop! In the Name of Love'),
(291595, '2020-02-10 20:17:42', 'Xavier Cugat', 'Caliente: Tango y Mambo', 'Cuban Mambo'),
(291600, '2020-02-10 20:40:51', 'Mose Allison', 'The Best of Mose Allison', 'I Love the Life I Live, I Live the Life I Love'),
(291605, '2020-02-10 21:04:10', 'Modern Nature', 'What Color', 'Piece Of The Act'),
(291606, '2020-02-10 21:06:46', 'Van Morrison', 'The Best of Van Morrison [Mercury]', 'Whenever God Shines His Light'),
(291607, '2020-02-10 21:11:40', 'The Diamonds', 'The Best of the Diamonds: The Mercury Years', 'Zip Zip'),
(291608, '2020-02-10 21:19:35', 'James Taylor', 'Greatest Hits', 'Sweet Baby James'),
(291609, '2020-02-10 21:22:31', 'B.B. King', 'Paying the Cost to Be the Boss', 'How Blue Can You Get?');

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
  MODIFY `recno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=291723;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
