-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 08, 2024 at 09:25 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tashiro`
--

-- --------------------------------------------------------

--
-- Table structure for table `conversations`
--

CREATE TABLE `conversations` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `conversations`
--

INSERT INTO `conversations` (`id`, `user_id`, `created`, `modified`) VALUES
(39, 23, '2024-02-08 09:06:59', '2024-02-08 09:06:59');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `conversation_id` int(10) UNSIGNED NOT NULL,
  `content` text NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `user_id`, `conversation_id`, `content`, `created`, `modified`) VALUES
(84, 23, 39, 'test', '2024-02-08 09:10:55', '2024-02-08 09:10:55'),
(85, 23, 39, 'test', '2024-02-08 09:12:04', '2024-02-08 09:12:04'),
(86, 23, 39, 'hello', '2024-02-08 09:12:09', '2024-02-08 09:12:09'),
(87, 23, 39, 'The minute I went in, I was sort of sorry I\'d come. He was reading the Atlantic Monthly, and\nthere were pills and medicine all over the place, and everything smelled like Vicks Nose Drops. It\nwas pretty depressing. I\'m not too crazy about sick people, anyway. What made it even more\ndepressing, old Spencer had on this very sad, ratty old bathrobe that he was probably born in or\nsomething. I don\'t much like to see old guys in their pajamas and bathrobes anyway. Their bumpy\nold chests are always showing. And their legs. Old guys\' legs, at beaches and places, always look\nso white and unhairy. \"Hello, sir,\" I said. \"I got your note. Thanks a lot.\" He\'d written me this\nnote asking me to stop by and say good-by before vacation started, on account of I wasn\'t coming\nback. \"You didn\'t have to do all that. I\'d have come over to say good-by anyway.\"', '2024-02-08 09:12:22', '2024-02-08 09:12:22'),
(88, 23, 39, 'Game, my ass. Some game. If you get on the side where all the hot-shots are, then it\'s a game, all\nright--I\'ll admit that. But if you get on the other side, where there aren\'t any hot-shots, then what\'s\na game about it? Nothing. No game. \"Has Dr. Thurmer written to your parents yet?\" old Spencer\nasked me.', '2024-02-08 09:15:08', '2024-02-08 09:15:08'),
(89, 23, 39, 'Game, my ass. Some game. If you get on the side where all the hot-shots are, then it\'s a game, all\nright--I\'ll admit that. But if you get on the other side, where there aren\'t any hot-shots, then what\'s\na game about it? Nothing. No game. \"Has Dr. Thurmer written to your parents yet?\" old Spencer\nasked me.', '2024-02-08 09:15:19', '2024-02-08 09:15:19'),
(90, 23, 39, 'Game, my ass. Some game. If you get on the side where all the hot-shots are, then it\'s a game, all\nright--I\'ll admit that. But if you get on the other side, where there aren\'t any hot-shots, then what\'s\na game about it? Nothing. No game. \"Has Dr. Thurmer written to your parents yet?\" old Spencer\nasked me.', '2024-02-08 09:15:52', '2024-02-08 09:15:52'),
(91, 23, 39, 'testtttt', '2024-02-08 09:17:00', '2024-02-08 09:17:00'),
(92, 23, 39, 'Game, my ass. Some game. If you get on the side where all the hot-shots are, then it\'s a game, all\nright--I\'ll admit that. But if you get on the other side, where there aren\'t any hot-shots, then what\'s\na game about it? Nothing. No game. \"Has Dr. Thurmer written to your parents yet?\" old Spencer\nasked me.', '2024-02-08 09:18:44', '2024-02-08 09:18:44'),
(93, 23, 39, 'Game, my ass. Some game. If you get on the side where all the hot-shots are, then it\'s a game, all\nright--I\'ll admit that. But if you get on the other side, where there aren\'t any hot-shots, then what\'s\na game about it? Nothing. No game. \"Has Dr. Thurmer written to your parents yet?\" old Spencer\nasked me.', '2024-02-08 09:19:25', '2024-02-08 09:19:25'),
(94, 23, 39, 'Game, my ass. Some game. If you get on the side where all the hot-shots are, then it\'s a game, all\nright--I\'ll admit that. But if you get on the other side, where there aren\'t any hot-shots, then what\'s\na game about it? Nothing. No game. \"Has Dr. Thurmer written to your parents yet?\" old Spencer\nasked me.', '2024-02-08 09:20:27', '2024-02-08 09:20:27');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(8) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `birthdate` date DEFAULT NULL,
  `gender` enum('female','male','other') DEFAULT NULL,
  `hobby` varchar(255) DEFAULT NULL,
  `profile_img` varchar(255) DEFAULT NULL,
  `last_login_time` datetime NOT NULL DEFAULT current_timestamp(),
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `birthdate`, `gender`, `hobby`, `profile_img`, `last_login_time`, `created`, `modified`) VALUES
(23, 'tashiro', 'test@test.com', '$2a$10$rWgsvFznhq1wQinpSF3Yn.PZ1zTkxrCFs63fyHwNcb0ZubDg9dh2i', '2024-02-08', 'female', 'test', 'profile_imgs/1707377621_8378.jpg_wh860.jpg', '2024-02-08 09:24:27', '2024-02-08 08:33:16', '2024-02-08 09:24:27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `conversations`
--
ALTER TABLE `conversations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `conversation_id` (`conversation_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`) USING HASH;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `conversations`
--
ALTER TABLE `conversations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `conversations`
--
ALTER TABLE `conversations`
  ADD CONSTRAINT `conversations_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`conversation_id`) REFERENCES `conversations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
