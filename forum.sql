-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 03, 2021 at 06:05 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `forum`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(8) NOT NULL,
  `category_name` varchar(500) NOT NULL,
  `category_description` varchar(500) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`, `category_description`, `created`) VALUES
(1, 'Python', 'Python is an interpreted, high-level and general-purpose programming language. Python\'s design philosophy emphasizes code readability with its notable use of significant whitespace.', '2021-01-27 04:39:59'),
(2, 'JavaScript', 'JavaScript, often abbreviated as JS, is a programming language that conforms to the ECMAScript specification. JavaScript (JS) is high-level, often just-in-time compiled, and multi-paradigm', '2021-01-27 04:41:46'),
(3, 'Django', 'A python framework for web development. hello, this is a sample text to increase the number of characters of this string up to one-eight-eight. So reading it won\'t do anything useful for .Django is a Python-based free and open-source web framework that follows the model-template-views architectural pattern. It is maintained by the Django Software Foundation, an American independent organization established as a 501 non-profit.', '2021-01-27 16:38:42'),
(4, 'Flask', 'Flask is a micro web framework written in Python. It is classified as a microframework because it does not require particular tools or libraries. It has no database abstraction layer, form validation, or any other components where pre-existing third-party libraries provide common functions.', '2021-01-27 16:39:08');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(8) NOT NULL,
  `comment_content` text NOT NULL,
  `thread_id` int(8) NOT NULL,
  `comment_by` varchar(30) NOT NULL,
  `comment_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `comment_content`, `thread_id`, `comment_by`, `comment_time`) VALUES
(1, 'u can search the internet', 1, '1', '2021-01-29 01:51:01'),
(3, 'hello', 1, '1', '2021-01-29 02:25:32'),
(4, 'hello, plz go through w3 school js tags', 15, '2', '2021-01-29 02:35:58'),
(5, 'hello..this is a test', 15, '2', '2021-01-29 03:22:31'),
(6, 'seriously crap', 15, '2', '2021-01-29 03:23:04'),
(7, 'I am noob', 1, '1', '2021-01-29 17:19:04'),
(8, 'hello', 1, '1', '2021-01-29 20:44:54'),
(9, 'hello testu', 21, '1', '2021-01-29 21:50:11'),
(10, 'hello testu', 21, '1', '2021-01-29 21:55:52'),
(11, 'testing the new user', 22, '2', '2021-01-29 21:58:15'),
(12, 'hello new user', 23, '2', '2021-01-29 21:59:10'),
(13, 'hello', 15, '2', '2021-01-30 07:26:04'),
(14, 'hello', 15, '2', '2021-01-30 07:26:58'),
(15, 'hello', 15, '2', '2021-01-30 12:19:09'),
(16, 'hello testing correction in sql', 19, '3', '2021-01-30 12:20:34'),
(17, 'success', 19, '3', '2021-01-30 12:20:52'),
(18, '&ltscript&gtecho \"you are hacked\";&lt/script&gt', 25, '3', '2021-01-30 18:52:50');

-- --------------------------------------------------------

--
-- Table structure for table `threads`
--

CREATE TABLE `threads` (
  `thread_id` int(7) NOT NULL,
  `thread_title` varchar(255) NOT NULL,
  `thread_description` text NOT NULL,
  `thread_cat_id` int(7) NOT NULL,
  `thread_user_id` int(7) NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `threads`
--

INSERT INTO `threads` (`thread_id`, `thread_title`, `thread_description`, `thread_cat_id`, `thread_user_id`, `timestamp`) VALUES
(1, 'Unable to install py audio', 'I am not able to install pyaudio into Microsoft windows 10.please help', 1, 1, '2021-01-28 15:19:11'),
(2, 'Unable to install Py-Charm', 'Please help me through it as I am trying to build a new API in python.', 1, 1, '2021-01-28 16:16:17'),
(3, 'need help with a tree structure in python', 'I want to make a tree that is binary and want to make it dynamic, I can make a tree but can\'t make it dynamic, please help', 1, 1, '2021-01-29 00:06:59'),
(15, 'hello...new to thread', 'want to learn js', 2, 2, '2021-01-29 02:35:18'),
(16, 'hello this a test', 'testing testing testing testing testing testing ', 1, 1, '2021-01-29 19:43:09'),
(18, 'hello', 'testestststststs', 1, 1, '2021-01-29 20:02:35'),
(19, 'testing', 'testing', 1, 1, '2021-01-29 20:44:05'),
(20, 'testing1', 'testing1', 1, 1, '2021-01-29 21:46:18'),
(21, 'testu', 'testu', 1, 1, '2021-01-29 21:49:54'),
(22, 'hey', 'test with another user', 1, 2, '2021-01-29 21:57:51'),
(23, 'testing', 'another user test in another category', 2, 2, '2021-01-29 21:58:57'),
(24, 'username test', 'test', 1, 3, '2021-01-30 06:51:44'),
(25, '&ltscript&gtecho \"you are hacked\";&lt/script&gt', '&ltscript&gtecho \"you are hacked\";&lt/script&gt', 1, 3, '2021-01-30 18:52:28');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `sno` int(8) NOT NULL,
  `user_email` varchar(30) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`sno`, `user_email`, `user_password`, `timestamp`) VALUES
(1, 'anks095@gmail.com', '$2y$10$e7BVtftyzD1TBNtpU7MyNuwHAn4MnBEMYx6hcLRWJ4gAa.g.W2lZi', '2021-01-29 08:33:38'),
(2, 'test@gmail.com', '$2y$10$51BeN/zaP2JGKAMX/63TV.C2VyATERVq4YIontCkvr5KQCWKeUkL2', '2021-01-29 17:17:33'),
(3, 'harry', '$2y$10$Z1fFmYb3mf.Glv/v0bvMMuIf257j/GWJigy1Zom9x6djYWcqq5p2e', '2021-01-30 06:51:08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `threads`
--
ALTER TABLE `threads`
  ADD PRIMARY KEY (`thread_id`);
ALTER TABLE `threads` ADD FULLTEXT KEY `thread_title` (`thread_title`,`thread_description`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`sno`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `threads`
--
ALTER TABLE `threads`
  MODIFY `thread_id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `sno` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
