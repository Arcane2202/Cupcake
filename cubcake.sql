-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 14, 2022 at 08:19 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cubcake`
--

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) NOT NULL,
  `postId` bigint(20) NOT NULL,
  `userId` bigint(20) NOT NULL,
  `post` text NOT NULL,
  `image` varchar(1000) NOT NULL,
  `hasImage` tinyint(1) NOT NULL,
  `comments` bigint(20) NOT NULL,
  `reacts` bigint(20) NOT NULL,
  `shares` bigint(20) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `postId`, `userId`, `post`, `image`, `hasImage`, `comments`, `reacts`, `shares`, `date`) VALUES
(1, 44326989815, 377761914, 'Bhallage Naaaaaaaaa', '', 0, 0, 0, 0, '2022-08-13 08:33:35'),
(2, 9223372036854775807, 377761914, 'lets just die', '', 0, 0, 0, 0, '2022-08-13 08:47:19'),
(3, 3554772863942, 377761914, 'Lelouch is a handsome young man with black hair and violet eyes, which he inherited from his mother. Lelouch is somewhat scrawny, having little muscle, and like most characters in the series, is rather thin. In spite of this, Lelouch is considerably tall, standing at least a head taller than Kallen, and apparently being slightly taller than Suzaku. Lelouch usually wears the Ashford Academy uniform, or the Zero uniform. Outside of Ashford, his primary casual outfit is a red jacket with a black shirt underneath and grey trousers, though he has occasionally worn other clothing. As Emperor, he wears a white robe with gold accents and a matching hat; both sport a red eye motif, referencing his Geass power.', '', 0, 0, 0, 0, '2022-08-13 09:20:40'),
(4, 9223372036854775807, 377761914, 'At this point I have no idea what\'s happening here!!!!!!!!', '', 0, 0, 0, 0, '2022-08-13 09:33:28');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` bigint(20) NOT NULL,
  `userID` bigint(20) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` bigint(17) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `urlAdress` varchar(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `userID`, `firstName`, `lastName`, `email`, `phone`, `gender`, `password`, `urlAdress`, `date`) VALUES
(1, 377761914, 'Kristen', 'Stewart', 'stewart@gmail.com', 1781780173, 'Female', '$2y$10$YEbP.kd2JXAm1VYf01HoP.4rqa/KTqlKqeRzSOFYPKLDdl5rfy/rW', 'kristen_stewart514', '2022-08-13 07:05:17'),
(2, 73879739927674281, 'Tanveer', 'Shams', 'tanveershams2218@gmail.com', 1781780172, 'Male', '$2y$10$sZaWLYBzj55pb4WOoBVCYew1dgwzz2yGAunJ7pglGi5rUSh3nXuj.', 'tanveer_shams75', '2022-08-13 09:56:55');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `postId` (`postId`),
  ADD KEY `userId` (`userId`),
  ADD KEY `comments` (`comments`),
  ADD KEY `reacts` (`reacts`),
  ADD KEY `shares` (`shares`),
  ADD KEY `date` (`date`),
  ADD KEY `hasImage` (`hasImage`);
ALTER TABLE `posts` ADD FULLTEXT KEY `post` (`post`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `userID` (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
