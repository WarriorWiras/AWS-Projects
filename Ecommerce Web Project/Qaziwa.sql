-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 02, 2021 at 11:31 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `qaziwa`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `title_id` int(11) NOT NULL,
  `title` varchar(40) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `author` varchar(40) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `summary` varchar(8000) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `rating` int(1) NOT NULL,
  `price` decimal(5,2) NOT NULL,
  `quantity` int(2) NOT NULL,
  `picture_front` varchar(70) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`title_id`, `title`, `author`, `summary`, `rating`, `price`, `quantity`, `picture_front`) VALUES
(2, 'The Cat In The Hat', 'Dr. Suess', 'Poor Dick and Sally. It\'s cold and wet and they\'re stuck in the house with nothing to do . . . until a giant cat in a hat shows up, transforming the dull day into a madcap adventure and almost wrecking the place in the process!', 5, '13.57', 8, 'cat_hat_front.jpg'),
(3, 'Garfield 30 Years', 'Jim Davis', '30 years of laugh and lasagna bundled into one book. A tribute to the furry feline after reaching the three-decade milestone this lavishly illustrated volume features more than four hundred strips, including thirty of Jim Davis\'s all-time favorites panels into one.', 4, '8.16', 44, 'garfield_front.jpg'),
(4, 'True Singapore Ghost Stories 11', 'Russel Lee', 'Russel Lee investigates witchcraft and uncovers its links with satanism PLUS many special stories. Must-Read Stories include but not limited to \"Furby or Fearby\", \"Toyol in a botol\", \"Butterfly Spirits\" and \"The Unholy Gathering\".', 2, '10.59', 7, 'ghost_stories_front.jpg'),
(5, 'Diary of a Wimpy Kid Hard Luck', 'Jeff Kinney', 'Greg Heffley\'s on a losing streak. His best friend has ditched him and finding new friends in middle school is proving to be a task. To change his fortunes, Greg decides to take a leap of faith and turn his decisions over to chance. Will things turn around for him?', 4, '14.93', 0, 'hard_luck_front.jpg'),
(6, 'Insomnia', 'Stephen King ', 'You\'ll lose a lot of sleep. Ralph does. At first he starts waking up earlier. And earlier. Then the hallucinations start - the colors, shapes and strange auras. Not to mention the bald doctors who always turn up at the scene of a death. Thats when Ralph develop abilities to view certain auras which leads him to join a conflict between the forces of the Purpose and the Random.', 3, '16.95', 14, 'insomnia_front.jpg'),
(7, 'When I was a kid 2', 'Boey', 'A continuation of the hit book \"When I Was a Kid\" it continues the misadventures of boey from his youth with an all new collection. The misdeeds, the wonders, the mistakes, and the triumphs of a kid growing up in Malaysia.', 3, '19.24', 4, 'kid_front.jpg'),
(8, 'Diary of a Wimpy Kid Long Haul', 'Jeff Kinney ', 'A family road trip is supposed to be a lot of fun unless, of course, you\'re the Heffleys. The journey starts off full of promise, then quickly takes several wrong turns. Petrol-station bathrooms, crazed seagulls, a fender bender and a runaway pig - not exactly Greg Heffley\'s idea of a good time. But even the worst road trip can turn into an adventure - and this is one the Heffley\'s won\'t soon forget.', 4, '20.87', 20, 'long_haul_front.jpg'),
(9, 'Diary of a Wimpy Kid Old School', 'Jeff Kinney', 'Life was better in the old days. Or was it? That\'s the question Greg Heffley is asking himself as his town voluntarily unplugs and goes electronic-free. But mordern life has its conveniences, and Greg isn\'t cut out for an old- fashioned world. With tension building inside and outside the Heffley home, will Greg find a way to survive?', 2, '20.87', 13, 'old_school_front.jpg'),
(10, 'As I was Passing II', 'Adibah Amin', 'Adibah Amin, the celebrated chronicler of everyday Malaysiana, returns with more anecdotal essays the celebrate the Malaysian way of life. ', 3, '19.90', 3, 'passing_front.jpg'),
(11, 'Transformers Saga of the Allspark ', 'Simon Furman', 'Saga of the Allspark reveals untold events from the age-old conflict between the AUTOBOTS and DECEPTICONS as both sides search for the ultimate source of power - the Allspark', 5, '17.99', 25, 'transformers_front.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `cart_books`
--

CREATE TABLE `cart_books` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title_id` int(11) NOT NULL,
  `cart_title` varchar(40) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `cart_price` decimal(5,2) NOT NULL,
  `cart_picture` varchar(40) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart_books`
--

INSERT INTO `cart_books` (`cart_id`, `user_id`, `title_id`, `cart_title`, `cart_price`, `cart_picture`) VALUES
(3, 9, 2, 'The Cat In The Hat', '13.57', 'cat_hat_front.jpg'),
(4, 9, 2, 'The Cat In The Hat', '13.57', 'cat_hat_front.jpg'),
(5, 9, 3, 'Garfield 30 Years', '8.16', 'garfield_front.jpg'),
(6, 9, 5, 'Diary of a Wimpy Kid Hard Luck', '14.93', 'hard_luck_front.jpg'),
(7, 9, 5, 'Diary of a Wimpy Kid Hard Luck', '14.93', 'hard_luck_front.jpg'),
(8, 9, 5, 'Diary of a Wimpy Kid Hard Luck', '14.93', 'hard_luck_front.jpg'),
(9, 9, 5, 'Diary of a Wimpy Kid Hard Luck', '14.93', 'hard_luck_front.jpg'),
(10, 9, 5, 'Diary of a Wimpy Kid Hard Luck', '14.93', 'hard_luck_front.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(40) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `last_name` varchar(40) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `email` varchar(40) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `md5password` varchar(32) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `otp` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `email`, `md5password`, `otp`) VALUES
(1, 'Mary', 'Sue', 'mary_sue@gmail.com', '68dc4ff55dc93149001ee7da8194347c', ''),
(2, '', '', 'admin', '0192023a7bbd73250516f069df18b500', ''),
(3, '', '', 'guest', '084e0343a0486ff05530df6c705c8bb4', ''),
(4, 'Andy', 'Lee', 'andy_lee@gmail.com', 'd64b171a2b334bb9b34129ebbc435f2c', ''),
(6, 'Hafiz', 'Ahmad', 'hafiz_ahmad@gmail.com', '7a5bde8adaf60027e794a3af535dcaff', ''),
(9, 'Muhd', 'Wafi', 'wafimuhd5@gmail.com', '04251c772a2cf81d385e014ae202e4fa', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`title_id`);

--
-- Indexes for table `cart_books`
--
ALTER TABLE `cart_books`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `customer_update` (`user_id`),
  ADD KEY `book_update` (`title_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `title_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `cart_books`
--
ALTER TABLE `cart_books`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart_books`
--
ALTER TABLE `cart_books`
  ADD CONSTRAINT `book_update` FOREIGN KEY (`title_id`) REFERENCES `books` (`title_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `customer_update` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
