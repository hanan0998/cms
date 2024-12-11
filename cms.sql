-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 08, 2024 at 10:41 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(225) NOT NULL,
  `cat_title` varchar(225) NOT NULL,
  `cat_desc` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `cat_title`, `cat_desc`) VALUES
(16, 'Java', NULL),
(17, 'Javascript', NULL),
(18, 'Procedural PHP', NULL),
(20, 'OOP', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(3) NOT NULL,
  `comment_author` varchar(225) NOT NULL,
  `comment_post_id` int(3) NOT NULL,
  `comment_email` text NOT NULL,
  `comment_content` text NOT NULL,
  `comment_status` varchar(225) NOT NULL,
  `comment_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `comment_author`, `comment_post_id`, `comment_email`, `comment_content`, `comment_status`, `comment_date`) VALUES
(7, 'Abdul Hanan', 11, 'abdulhananinc@gmail.com', 'What\'s a great comment !!!', 'Approved', '2024-09-09'),
(8, 'Abdul Hanan', 11, 'abdulhananinc@gmail.com', 'Love it ? Show it !!', 'Approved', '2024-09-09'),
(9, 'Abdul Hanan', 11, 'abdulhananinc@gmail.com', 'Hello, is that working don\'t worry it will work inshallah', 'UnApproved', '2024-09-09');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(3) NOT NULL,
  `post_title` varchar(1000) NOT NULL,
  `post_date` date NOT NULL,
  `post_author` varchar(225) NOT NULL,
  `post_image` text NOT NULL,
  `post_content` text NOT NULL,
  `post_category_id` int(3) NOT NULL,
  `post_tags` varchar(225) NOT NULL,
  `post_status` varchar(225) NOT NULL,
  `post_comments_count` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `post_title`, `post_date`, `post_author`, `post_image`, `post_content`, `post_category_id`, `post_tags`, `post_status`, `post_comments_count`) VALUES
(11, 'What\\\\\\\'s going insan in AI industry?', '2024-09-02', 'Abdul Hanan', 'sample-post-image.png\r\n', 'Getting free cPanel hosting with a free domain is challenging, but there are a few options for students:\r\n\r\nGitHub Student Developer Pack: This offers free hosting credits and discounts, but it might not include cPanel or a free domain directly. It\'s a good option to explore for free resources.\r\n\r\nInfinityFree: Offers free web hosting with cPanel-like features, but you\'ll need to use a subdomain (like yoursite.epizy.com).\r\n\r\nAwardSpace: Provides free hosting with limited storage and bandwidth. You can use a free subdomain or pay for a domain.\r\n\r\nFreenom: Offers free domains (like .tk, .ml), but you\'ll need to find separate hosting.\r\n\r\nCombining these options could give you a free hosting solution as a student', 16, 'ABdul Hanan, AI', 'Publish', 1),
(15, 'What\\\\\\\\\\\\\\\'s going insan in AI industry?', '2024-09-02', 'Abdul Hanan', 'sample-post-image.png', 'Getting free cPanel hosting with a free domain is challenging, but there are a few options for students:\r\n\r\nGitHub Student Developer Pack: This offers free hosting credits and discounts, but it might not include cPanel or a free domain directly. It\'s a good option to explore for free resources.\r\n\r\nInfinityFree: Offers free web hosting with cPanel-like features, but you\'ll need to use a subdomain (like yoursite.epizy.com).\r\n\r\nAwardSpace: Provides free hosting with limited storage and bandwidth. You can use a free subdomain or pay for a domain.\r\n\r\nFreenom: Offers free domains (like .tk, .ml), but you\'ll need to find separate hosting.\r\n\r\nCombining these options could give you a free hosting solution as a student', 17, 'ABdul Hanan, AI', 'Publish', 0),
(16, 'Is the PHP the upcomming language after JS?', '2024-09-03', 'Simpson', 'sample-post-image.png', 'Getting free cPanel hosting with a free domain is challenging, but there are a few options for students:\r\n\r\nGitHub Student Developer Pack: This offers free hosting credits and discounts, but it might not include cPanel or a free domain directly. It\'s a good option to explore for free resources.\r\n\r\nInfinityFree: Offers free web hosting with cPanel-like features, but you\'ll need to use a subdomain (like yoursite.epizy.com).\r\n\r\nAwardSpace: Provides free hosting with limited storage and bandwidth. You can use a free subdomain or pay for a domain.\r\n\r\nFreenom: Offers free domains (like .tk, .ml), but you\'ll need to find separate hosting.\r\n\r\nCombining these options could give you a free hosting solution as a student', 18, 'ABdul Hanan, AI', 'draft', 0),
(17, 'good to Go', '2024-09-13', 'Abdul Hanan', '1726222400_OIP (7).jpeg', 'Lorem ipsum is a pretty long task as we have to open google then search Lorem ipsum and then find a reliable website to search of a paragraph then copy it and past it here.\\r\\nWell, a pretty long task. ', 20, 'Ai, Javascript', 'Publish', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(225) NOT NULL,
  `user_firstname` varchar(225) NOT NULL,
  `user_lastname` varchar(225) NOT NULL,
  `user_password` varchar(225) NOT NULL,
  `user_email` varchar(225) NOT NULL,
  `user_image` text NOT NULL,
  `user_role` varchar(225) NOT NULL,
  `randSalt` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_firstname`, `user_lastname`, `user_password`, `user_email`, `user_image`, `user_role`, `randSalt`) VALUES
(3, 'hanan.a', 'Rana Tegrena', 'Nigham', 'hanan.a', 'rananigham123@gmail.com', '', 'admin', ''),
(4, 'sono', 'abdul', 'sono', 'sono', 'sono@gmail.com', '', 'subscriber', ''),
(7, 'hanan.a', 'abdul', 'Abdullah', 'hanan.a', 'abdul@gmail.com', '', 'admin', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(225) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
