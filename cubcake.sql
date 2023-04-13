-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 31, 2022 at 01:51 AM
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
-- Table structure for table `377761914table`
--

CREATE TABLE `377761914table` (
  `id` bigint(20) NOT NULL,
  `userId` varchar(100) DEFAULT NULL,
  `friendid` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `377761914table`
--

INSERT INTO `377761914table` (`id`, `userId`, `friendid`, `state`, `date`) VALUES
(29, '377761914', '5184989243864885', 'friends', '2022-08-29 14:47:16'),
(40, '377761914', '3692352242456447', 'friends', '2022-08-30 02:46:08');

-- --------------------------------------------------------

--
-- Table structure for table `3692352242456447table`
--

CREATE TABLE `3692352242456447table` (
  `id` bigint(20) NOT NULL,
  `userId` varchar(100) DEFAULT NULL,
  `friendid` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `3692352242456447table`
--

INSERT INTO `3692352242456447table` (`id`, `userId`, `friendid`, `state`, `date`) VALUES
(4, '3692352242456447', '5184989243864885', 'friends', '2022-08-29 15:32:40'),
(13, '3692352242456447', '377761914', 'friends', '2022-08-30 02:46:08');

-- --------------------------------------------------------

--
-- Table structure for table `5184989243864885table`
--

CREATE TABLE `5184989243864885table` (
  `id` bigint(20) NOT NULL,
  `userId` varchar(100) DEFAULT NULL,
  `friendid` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `5184989243864885table`
--

INSERT INTO `5184989243864885table` (`id`, `userId`, `friendid`, `state`, `date`) VALUES
(29, '5184989243864885', '377761914', 'friends', '2022-08-29 14:47:16'),
(31, '5184989243864885', '3692352242456447', 'friends', '2022-08-29 15:32:40');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) NOT NULL,
  `postid` varchar(100) NOT NULL,
  `commentuser` varchar(100) NOT NULL,
  `comment` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `postid`, `commentuser`, `comment`, `date`) VALUES
(33, '94114126', '377761914', 'Hi there!', '2022-08-29 19:51:51'),
(34, '94114126', '377761914', 'Welcome to my post', '2022-08-29 19:52:24'),
(35, '94114126', '377761914', 'eafa', '2022-08-29 19:58:33'),
(36, '94114126', '377761914', 'aefaef', '2022-08-29 19:58:35'),
(37, '94114126', '377761914', 'wrghwgw gr', '2022-08-29 19:58:36'),
(38, '94114126', '377761914', 'dead', '2022-08-29 20:04:38');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `msg_id` bigint(20) NOT NULL,
  `incoming` bigint(255) NOT NULL,
  `outgoing` bigint(255) NOT NULL,
  `msg` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`msg_id`, `incoming`, `outgoing`, `msg`) VALUES
(4, 5184989243864885, 377761914, 'Hi There!'),
(5, 377761914, 5184989243864885, 'Yo, whassup!'),
(6, 377761914, 5184989243864885, 'you there?'),
(7, 377761914, 3692352242456447, 'Hi there !');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) NOT NULL,
  `postId` varchar(10000) NOT NULL,
  `userId` bigint(20) NOT NULL,
  `post` longtext NOT NULL,
  `image` varchar(1000) NOT NULL,
  `hasImage` tinyint(1) NOT NULL,
  `dp` tinyint(1) NOT NULL,
  `cover` tinyint(1) NOT NULL,
  `comments` bigint(20) NOT NULL,
  `reacts` bigint(20) NOT NULL,
  `shares` bigint(20) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `postId`, `userId`, `post`, `image`, `hasImage`, `dp`, `cover`, `comments`, `reacts`, `shares`, `date`) VALUES
(4, '922338575807', 377761914, 'At this point I have no idea what\'s happening here!!!!!!!!', '', 0, 0, 0, 0, 2, 0, '2022-08-29 12:11:34'),
(9, '5208151173090708475', 377761914, 'Just Amazed!!! Feel The Terror!!!!!!!!!!!!', 'mediaStorage/377761914/377761914_post_258831636239940600071055823299918479014299448328.jpg', 1, 0, 0, 0, 2, 0, '2022-08-26 23:25:59'),
(15, '92233720368545807', 377761914, '', 'mediaStorage/377761914/377761914_dp_41536547067502205153087724970758608215953728405440020522646702473654914101.jpg', 1, 1, 0, 0, 2, 0, '2022-08-26 22:36:10'),
(16, '8409695736', 377761914, '', 'mediaStorage/377761914/377761914_cover_70680900590845588548550359175214291177303045442693187450611686779706574.jpg', 1, 0, 1, 0, 2, 0, '2022-08-26 22:36:08'),
(17, '922337203685477807', 377761914, 'How much more? :)', '', 0, 0, 0, 0, 2, 0, '2022-08-26 22:36:06'),
(19, '9223372036854765807', 377761914, '', 'mediaStorage/377761914/377761914_dp_71121626295706869985952100567956438906048743822334496264274833137412157865305.jpg', 1, 1, 0, 0, 2, 0, '2022-08-27 06:06:44'),
(20, '152285840454002', 377761914, 'Isn\'t this pretty? <3', 'mediaStorage/377761914/377761914_post_274568874781069110412808812398146847370991346532484685287.jpg', 1, 0, 0, 0, 2, 0, '2022-08-29 17:29:42'),
(21, '8223372036854775807', 5184989243864885, 'This is unacceptable!', '', 0, 0, 0, 0, 2, 0, '2022-08-29 12:11:20'),
(22, '7223372036854775807', 5184989243864885, '', 'mediaStorage/5184989243864885/5184989243864885_cover_4132965149709414015429454684948044439421029074217306522777937.jpg', 1, 0, 1, 0, 2, 0, '2022-08-30 01:54:55'),
(23, '21254154650', 5184989243864885, '', 'mediaStorage/5184989243864885/5184989243864885_dp_14622958018017088757740672417623771391834943179091914695719483195.jpg', 1, 1, 0, 0, 2, 0, '2022-08-29 12:11:11'),
(60, '94114126', 377761914, ' I am the poet of the Body and I am the poet of the Soul,\r\nThe pleasures of heaven are with me and the pains of hell are with me,\r\nThe first I graft and increase upon myself, the latter I translate into a new tongue.\r\n\r\nI am the poet of the woman the same as the man,\r\nAnd I say it is as great to be a woman as to be a man,\r\nAnd I say there is nothing greater than the mother of men.\r\n\r\nI chant the chant of dilation or pride,\r\nWe have had ducking and deprecating about enough,\r\nI show that size is only development.\r\n\r\nHave you outstript the rest? are you the President?\r\nIt is a trifle, they will more than arrive there every one, and still pass on.\r\n\r\nI am he that walks with the tender and growing night,\r\nI call to the earth and sea half-held by the night.\r\n\r\nPress close bare-bosom’d night—press close magnetic nourishing night!\r\nNight of south winds—night of the large few stars!\r\nStill nodding night—mad naked summer night.\r\n\r\nSmile O voluptuous cool-breath’d earth!\r\nEarth of the slumbering and liquid trees!\r\nEarth of departed sunset—earth of the mountains misty-topt!\r\nEarth of the vitreous pour of the full moon just tinged with blue!\r\nEarth of shine and dark mottling the tide of the river!\r\nEarth of the limpid gray of clouds brighter and clearer for my sake!\r\nFar-swooping elbow’d earth—rich apple-blossom’d earth!\r\nSmile, for your lover comes.\r\n\r\nProdigal, you have given me love—therefore I to you give love!\r\nO unspeakable passionate love.', 'mediaStorage/377761914/377761914_post_945340627459325080742865892323480229039382849752147266724336415002969984379757847222831121096.jpg', 1, 0, 0, 0, 1, 0, '2022-08-29 19:19:53');

-- --------------------------------------------------------

--
-- Table structure for table `reacts`
--

CREATE TABLE `reacts` (
  `id` bigint(20) NOT NULL,
  `postid` bigint(20) NOT NULL,
  `reacts` text NOT NULL,
  `type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reacts`
--

INSERT INTO `reacts` (`id`, `postid`, `reacts`, `type`) VALUES
(106, 152285840454002, '[{\"reactor\":\"5184989243864885\",\"timestamp\":\"2022-08-27 00:36:03\"},{\"reactor\":\"377761914\",\"timestamp\":\"2022-08-29 19:29:42\"}]', 'post'),
(107, 922337203685477807, '[{\"reactor\":\"377761914\",\"timestamp\":\"2022-08-27 00:10:59\"},{\"reactor\":\"5184989243864885\",\"timestamp\":\"2022-08-27 00:36:06\"}]', 'post'),
(108, 8409695736, '[{\"reactor\":\"377761914\",\"timestamp\":\"2022-08-27 00:10:53\"},{\"reactor\":\"5184989243864885\",\"timestamp\":\"2022-08-27 00:36:08\"}]', 'post'),
(109, 5208151173090708475, '[{\"reactor\":\"5184989243864885\",\"timestamp\":\"2022-08-27 00:36:11\"},{\"reactor\":\"377761914\",\"timestamp\":\"2022-08-27 01:25:59\"}]', 'post'),
(110, 9223372036854765807, '[{\"reactor\":\"5184989243864885\",\"timestamp\":\"2022-08-27 00:36:05\"},{\"reactor\":\"377761914\",\"timestamp\":\"2022-08-27 08:06:44\"}]', 'post'),
(111, 92233720368545807, '[{\"reactor\":\"377761914\",\"timestamp\":\"2022-08-27 00:02:10\"},{\"reactor\":\"5184989243864885\",\"timestamp\":\"2022-08-27 00:36:10\"}]', 'post'),
(112, 922338575807, '[{\"reactor\":\"5184989243864885\",\"timestamp\":\"2022-08-27 00:37:51\"},{\"reactor\":\"377761914\",\"timestamp\":\"2022-08-29 14:11:34\"}]', 'post'),
(113, 21254154650, '[{\"reactor\":\"5184989243864885\",\"timestamp\":\"2022-08-27 01:04:14\"},{\"reactor\":\"377761914\",\"timestamp\":\"2022-08-29 14:11:11\"}]', 'post'),
(114, 8223372036854775807, '[{\"reactor\":\"5184989243864885\",\"timestamp\":\"2022-08-27 01:07:32\"},{\"reactor\":\"377761914\",\"timestamp\":\"2022-08-29 14:11:20\"}]', 'post'),
(116, 7223372036854775807, '[{\"reactor\":\"377761914\",\"timestamp\":\"2022-08-29 14:11:18\"},{\"reactor\":\"5184989243864885\",\"timestamp\":\"2022-08-30 03:54:55\"}]', 'post'),
(117, 94114126, '[{\"reactor\":\"377761914\",\"timestamp\":\"2022-08-29 21:19:53\"}]', 'post');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` bigint(20) NOT NULL,
  `userID` bigint(20) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `dp` varchar(2000) NOT NULL,
  `cover` varchar(2000) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` bigint(17) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `friendRequests` varchar(1000) DEFAULT '0',
  `friendsCount` varchar(1000) NOT NULL DEFAULT '0',
  `urlAdress` varchar(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `birthDate` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `userID`, `firstName`, `lastName`, `dp`, `cover`, `email`, `phone`, `gender`, `password`, `friendRequests`, `friendsCount`, `urlAdress`, `date`, `birthDate`) VALUES
(1, 377761914, 'Kristen', 'Stewart', 'mediaStorage/377761914/377761914_dp_71121626295706869985952100567956438906048743822334496264274833137412157865305.jpg', 'mediaStorage/377761914/377761914_cover_70680900590845588548550359175214291177303045442693187450611686779706574.jpg', 'stewart@gmail.com', 1781780173, 'Female', '$2y$10$YEbP.kd2JXAm1VYf01HoP.4rqa/KTqlKqeRzSOFYPKLDdl5rfy/rW', '0', '0', 'kristen_stewart514', '2022-08-27 05:49:52', ''),
(3, 5184989243864885, 'Tanveer', 'Shams', 'mediaStorage/5184989243864885/5184989243864885_dp_14622958018017088757740672417623771391834943179091914695719483195.jpg', 'mediaStorage/5184989243864885/5184989243864885_cover_4132965149709414015429454684948044439421029074217306522777937.jpg', 'tanveershams2218@gmail.com', 1781780172, 'Prefer Not to Say', '$2y$10$VLwAZ3jqogyazemszQHKsO3KKJuJ9cY6s4.iTQX/jvqFBv/p0/ov6', '0', '0', 'tanveer_shams86', '2022-08-27 05:49:56', ''),
(8, 3692352242456447, 'Tanveer', 'Shams', 'images/manDummy.jpg', 'images/coverDummy.jpg', 'tanveershams2202@gmail.com', 1781780172, 'Male', '$2y$10$D/MMd18Iwo7BI.tRC3kVO.9NimH3mcaP.SgR1Xuv6qb6WSYe.Fcu.', '0', '0', 'tanveer_shams86', '2022-08-29 15:02:59', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `377761914table`
--
ALTER TABLE `377761914table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `3692352242456447table`
--
ALTER TABLE `3692352242456447table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `5184989243864885table`
--
ALTER TABLE `5184989243864885table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `postid` (`postid`),
  ADD KEY `commentuser` (`commentuser`),
  ADD KEY `date` (`date`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`msg_id`),
  ADD KEY `incoming` (`incoming`),
  ADD KEY `outgoing` (`outgoing`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `postId` (`postId`(768)),
  ADD KEY `userId` (`userId`),
  ADD KEY `comments` (`comments`),
  ADD KEY `reacts` (`reacts`),
  ADD KEY `shares` (`shares`),
  ADD KEY `date` (`date`),
  ADD KEY `hasImage` (`hasImage`),
  ADD KEY `dp` (`dp`),
  ADD KEY `cover` (`cover`);
ALTER TABLE `posts` ADD FULLTEXT KEY `post` (`post`);

--
-- Indexes for table `reacts`
--
ALTER TABLE `reacts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `postid` (`postid`),
  ADD KEY `type` (`type`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `userID` (`userID`),
  ADD KEY `friendRequests` (`friendRequests`(768)),
  ADD KEY `friendsCount` (`friendsCount`(768));

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `377761914table`
--
ALTER TABLE `377761914table`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `3692352242456447table`
--
ALTER TABLE `3692352242456447table`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `5184989243864885table`
--
ALTER TABLE `5184989243864885table`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `msg_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `reacts`
--
ALTER TABLE `reacts`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
