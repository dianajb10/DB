-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 24, 2024 at 05:16 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `portfolio`
--

-- --------------------------------------------------------

--
-- Table structure for table `game_list`
--

CREATE TABLE `game_list` (
  `game_id` int(11) NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `game_list`
--

INSERT INTO `game_list` (`game_id`, `title`, `description`, `image`) VALUES
(1, 'Game 1', 'test1', 'images/ra.png');

-- --------------------------------------------------------

--
-- Table structure for table `movie_list`
--

CREATE TABLE `movie_list` (
  `movie_id` int(11) NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `movie_list`
--

INSERT INTO `movie_list` (`movie_id`, `title`, `description`, `image`) VALUES
(1, 'Game of Thrones', '2011-2019. Directed by David Benioff and D. B. Weiss for HBO', 'images/got.png'),
(2, 'The Wind Rises', '2014. Directed by Hayao Miyazaki, animated by Studio Ghibli', 'images/ra.png'),
(3, 'Gravity Falls', '2012-2016. Directed by Alex Hirsch for Disney Channel', 'images/ra.png'),
(4, 'Rick and Morty', '2013. Directed by Justin Roiland and Dan Harmon for Cartoon Network', 'images/rnm.webp');

-- --------------------------------------------------------

--
-- Table structure for table `project_list`
--

CREATE TABLE `project_list` (
  `project_id` int(11) NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `project_list`
--

INSERT INTO `project_list` (`project_id`, `title`, `description`, `image`) VALUES
(1, 'Project Title 1', 'Description of project 1.', 'images/ra.png'),
(3, 'Project Title 2', 'Description of project 2\r\n', 'images/ra.png');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `firstname` text NOT NULL,
  `lastname` text NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `firstname`, `lastname`, `username`, `password`, `created_at`) VALUES
(1, 'admin', 'admni=', 'admin', 'admin', '2024-06-24 10:54:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `game_list`
--
ALTER TABLE `game_list`
  ADD PRIMARY KEY (`game_id`);

--
-- Indexes for table `movie_list`
--
ALTER TABLE `movie_list`
  ADD PRIMARY KEY (`movie_id`);

--
-- Indexes for table `project_list`
--
ALTER TABLE `project_list`
  ADD PRIMARY KEY (`project_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `game_list`
--
ALTER TABLE `game_list`
  MODIFY `game_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `movie_list`
--
ALTER TABLE `movie_list`
  MODIFY `movie_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `project_list`
--
ALTER TABLE `project_list`
  MODIFY `project_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
