-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 10, 2022 at 04:09 AM
-- Server version: 10.4.16-MariaDB
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `survey`
--

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `question` varchar(300) NOT NULL,
  `type` varchar(1) NOT NULL,
  `options` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`options`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `question`, `type`, `options`) VALUES
(1, 'Do you or have you ever produced anything music related', 'B', '[\"Yes\", \"No\"]'),
(2, 'Which genre of music do you enjoy the most', 'B', '[\"Hip-hop/Rap\", \"Gospel/Praise-Music\", \"House/Amapiano\", \"Lo-fi/Jazz\"]'),
(3, 'Do you like the idea of an online platform that gives you access to music from all your favorite artist(s)', 'B', '[\"Yes\", \"No\"]'),
(4, 'How do you prefer to access music from your favorite artist(s)', 'B', '[\"Free Downloads\", \"Paid streaming\", \"Free streaming\", \"Paid Downloads\"]'),
(5, 'How do you prefer to distribute your music to your listeners/followers', 'A', '[\"Free Downloads\", \"Paid streaming\", \"Free streaming\", \"Paid Downloads\"]'),
(6, 'Which part of music production are you interested in', 'A', '[\"Vocals and lyric`s\", \"Beat Production\", \"input\"]'),
(7, 'Are you interested in the idea of a platform that lets you earn money from your music', 'A', '[\"Yes\", \"No\"]'),
(8, 'Have you ever had your work copied by another artists', 'A', '[\"Yes\", \"No\"]'),
(9, 'Are you aware of copyright laws that let you protect your music from being misused by other artist`s or your listeners/followers', 'A', '[\"Yes\", \"No\"]'),
(10, 'Have you ever listened to a podcast', 'B', '[\"Yes\", \"No\"]'),
(11, 'Have you ever been part of or produced a podcast', 'B', '[\"Yes\", \"No\"]'),
(12, 'Who is Your favorite artist/group or podcast(er)', 'B', '[\"input\"]');

-- --------------------------------------------------------

--
-- Table structure for table `responses`
--

CREATE TABLE `responses` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `question_id` int(11) DEFAULT NULL,
  `response` varchar(350) DEFAULT NULL,
  `date` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `ip` varchar(20) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `type` varchar(1) NOT NULL,
  `date_joined` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `responses`
--
ALTER TABLE `responses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `question_constraint` (`question_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ip` (`ip`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `responses`
--
ALTER TABLE `responses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
