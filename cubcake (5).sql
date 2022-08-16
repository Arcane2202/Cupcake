-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 16, 2022 at 07:59 AM
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
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `msg_id` int(11) NOT NULL,
  `incoming_msg_id` int(255) NOT NULL,
  `outgoing_msg_id` int(255) NOT NULL,
  `msg` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) NOT NULL,
  `postId` varchar(10000) NOT NULL,
  `userId` bigint(20) NOT NULL,
  `post` text NOT NULL,
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
(4, '922338575807', 377761914, 'At this point I have no idea what\'s happening here!!!!!!!!', '', 0, 0, 0, 0, 0, 0, '2022-08-15 20:35:16'),
(9, '5208151173090708475', 377761914, 'Just Amazed!!! Feel The Terror!!!!!!!!!!!!', 'mediaStorage/377761914/377761914_post_258831636239940600071055823299918479014299448328.jpg', 1, 0, 0, 0, 0, 0, '2022-08-15 22:41:18'),
(15, '92233720368545807', 377761914, '', 'mediaStorage/377761914/377761914_dp_41536547067502205153087724970758608215953728405440020522646702473654914101.jpg', 1, 1, 0, 0, 0, 0, '2022-08-15 21:44:13'),
(16, '8409695736', 377761914, '', 'mediaStorage/377761914/377761914_cover_70680900590845588548550359175214291177303045442693187450611686779706574.jpg', 1, 0, 1, 0, 0, 0, '2022-08-15 21:44:22'),
(17, '922337203685477807', 377761914, 'How much more? :)', '', 0, 0, 0, 0, 0, 0, '2022-08-15 16:05:39'),
(19, '9223372036854765807', 377761914, '', 'mediaStorage/377761914/377761914_dp_71121626295706869985952100567956438906048743822334496264274833137412157865305.jpg', 1, 1, 0, 0, 0, 0, '2022-08-15 20:07:42'),
(20, '152285840454002', 377761914, 'Isn\'t this pretty? <3', 'mediaStorage/377761914/377761914_post_274568874781069110412808812398146847370991346532484685287.jpg', 1, 0, 0, 0, 2, 0, '2022-08-15 22:24:14'),
(21, '8223372036854775807', 5184989243864885, 'This is unacceptable!', '', 0, 0, 0, 0, 0, 0, '2022-08-15 21:44:24'),
(22, '7223372036854775807', 5184989243864885, '', 'mediaStorage/5184989243864885/5184989243864885_cover_4132965149709414015429454684948044439421029074217306522777937.jpg', 1, 0, 1, 0, 0, 0, '2022-08-15 21:44:27'),
(23, '21254154650', 5184989243864885, '', 'mediaStorage/5184989243864885/5184989243864885_dp_14622958018017088757740672417623771391834943179091914695719483195.jpg', 1, 1, 0, 0, 2, 0, '2022-08-15 21:45:05');

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
(8, 152285840454002, '[{\"reactor\":\"377761914\",\"timestamp\":\"2022-08-15 18:05:48\"},{\"reactor\":\"5184989243864885\",\"timestamp\":\"2022-08-15 23:41:15\"}]', 'post'),
(13, 21254154650, '[{\"reactor\":\"5184989243864885\",\"timestamp\":\"2022-08-15 23:44:43\"},{\"reactor\":\"377761914\",\"timestamp\":\"2022-08-15 23:45:05\"}]', 'post'),
(33, 377761914, '[{\"reactor\":\"5184989243864885\",\"timestamp\":\"2022-08-16 06:27:28\"},{\"reactor\":\"2786344164\",\"timestamp\":\"2022-08-16 07:18:24\"}]', 'friendsCount'),
(34, 5184989243864885, '[{\"reactor\":\"377761914\",\"timestamp\":\"2022-08-16 06:28:53\"}]', 'friendsCount'),
(36, 7993859511269874489, '[{\"reactor\":\"377761914\",\"timestamp\":\"2022-08-16 06:40:12\"}]', 'friendsCount'),
(37, 377761914, '[{\"reactor\":\"7993859511269874489\",\"timestamp\":\"2022-08-16 06:40:12\"}]', 'friendsCount');

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
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `userID`, `firstName`, `lastName`, `dp`, `cover`, `email`, `phone`, `gender`, `password`, `friendRequests`, `friendsCount`, `urlAdress`, `date`) VALUES
(1, 377761914, 'Kristen', 'Stewart', 'mediaStorage/377761914/377761914_dp_71121626295706869985952100567956438906048743822334496264274833137412157865305.jpg', 'mediaStorage/377761914/377761914_cover_70680900590845588548550359175214291177303045442693187450611686779706574.jpg', 'stewart@gmail.com', 1781780173, 'Female', '$2y$10$YEbP.kd2JXAm1VYf01HoP.4rqa/KTqlKqeRzSOFYPKLDdl5rfy/rW', '0', '2', 'kristen_stewart514', '2022-08-16 05:20:12'),
(3, 5184989243864885, 'Tanveer', 'Shams', 'mediaStorage/5184989243864885/5184989243864885_dp_14622958018017088757740672417623771391834943179091914695719483195.jpg', 'mediaStorage/5184989243864885/5184989243864885_cover_4132965149709414015429454684948044439421029074217306522777937.jpg', 'tanveershams2218@gmail.com', 1781780172, 'Prefer Not to Say', '$2y$10$VLwAZ3jqogyazemszQHKsO3KKJuJ9cY6s4.iTQX/jvqFBv/p0/ov6', '0', '1', 'tanveer_shams86', '2022-08-16 04:28:53'),
(4, 2786344164, 'Tester', 'Tested', 'images/manDummy.jpg', 'images/coverDummy.jpg', 'test@test.com', 12345678901, 'Prefer Not to Say', '$2y$10$inP1Ny.ACPefecXv2CgQ.uQsh2dw5TRNl.eiYvkUQtqko9C3ErHCe', '0', '0', 'tester_tested376', '2022-08-16 05:20:04'),
(5, 7993859511269874489, 'Tester', 'Two', 'images/girlDummy.jpg', 'images/coverDummy.jpg', 'ytest@yt.com', 12345678901, 'Female', '$2y$10$9e7MScHH0Mid4P0BU76/DOA5HObFmm/8ou2zBQv2OgaQau8jOowoy', '0', '1', 'tester_two839', '2022-08-16 05:20:06');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`msg_id`);

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
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `reacts`
--
ALTER TABLE `reacts`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
