-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 20, 2022 at 09:37 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `online_bookstore`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_information`
--

CREATE TABLE `admin_information` (
  `id` int(11) NOT NULL,
  `image` varchar(200) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_information`
--

INSERT INTO `admin_information` (`id`, `image`, `gender`, `user_id`) VALUES
(3, './uploads/1642584714819864187.jpg', 'Female', 9),
(4, './uploads/16425847372053744967.jpg', 'Female', 10);

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id` int(11) NOT NULL,
  `title` varchar(30) NOT NULL,
  `content` text NOT NULL,
  `image` char(80) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `title`, `content`, `image`, `date`, `user_id`) VALUES
(9, 'Lorem ipsum dolor sit amet', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.\r\n                            Dolores eos soluta, dolore harum molestias consectetur.', './uploads/16426117742018356234.jpg', '2022-01-19 17:02:54', 9),
(10, 'Lorem ipsum dolor sit amet', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.\r\n                            Dolores eos soluta, dolore harum molestias consectetur.', './uploads/16426117941237334052.jpg', '2022-01-19 17:03:14', 9),
(11, 'Lorem ipsum dolor sit amet', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.\r\n                            Dolores eos soluta, dolore harum molestias consectetur.', './uploads/16426142991403363162.jpg', '2022-01-19 17:44:59', 9);

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

CREATE TABLE `author` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `author`
--

INSERT INTO `author` (`id`, `name`, `description`) VALUES
(1, 'mahmoud', 'very good5'),
(2, 'mariam', 'very good');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `description` text NOT NULL,
  `image` char(80) NOT NULL,
  `price` float NOT NULL,
  `author_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `name`, `description`, `image`, `price`, `author_id`, `category_id`) VALUES
(6, 'HTML Book', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ratione eius recusandae, porro ipsa\r\n                    necessitatibus autem!', './uploads/16425978411674920608.png', 80, 2, 11),
(7, 'php', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ratione eius recusandae, porro ipsa\r\n                    necessitatibus autem!', './uploads/1642598359132211275.png', 90, 2, 11),
(8, 'pyramids Book', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ratione eius recusandae, porro ipsa\r\n                    necessitatibus autem!', './uploads/16425986382115697617.jpeg', 50, 1, 10),
(9, 'book', 'book', './uploads/16426803241902028473.jpg', 80, 2, 12);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(100) NOT NULL,
  `librarian_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `description`, `image`, `librarian_id`) VALUES
(8, 'Religious books', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ratione\r\n  eius recusandae, porro ipsa necessitatibus autem!', './uploads/1642553290937708702.jpg', 10),
(9, 'Sciences books', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ratione\r\neius recusandae, porro ipsa necessitatibus autem!', './uploads/16425533532017853129.jpg', 10),
(10, 'Historical books', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ratione\r\neius recusandae, porro ipsa necessitatibus autem!', './uploads/16426272821375064237.jpeg', 10),
(11, 'Programing books', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ratione\r\neius recusandae, porro ipsa necessitatibus autem!', './uploads/1642553461520357558.jpg', 10),
(12, 'category', 'category', './uploads/16426802971765571605.jpg', 10);

-- --------------------------------------------------------

--
-- Table structure for table `library_branch`
--

CREATE TABLE `library_branch` (
  `id` int(11) NOT NULL,
  `address` varchar(50) NOT NULL,
  `phone` char(11) NOT NULL,
  `email` varchar(30) NOT NULL,
  `facebook` char(100) NOT NULL,
  `twitter` char(100) NOT NULL,
  `linkedin` char(100) NOT NULL,
  `instegram` char(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `library_branch`
--

INSERT INTO `library_branch` (`id`, `address`, `phone`, `email`, `facebook`, `twitter`, `linkedin`, `instegram`) VALUES
(2, 'mansouras', '01141862555', 'marimmandour135@gmail.com', 'https://www.facebook.com/profile.php?id=100004879037510', 'http://twitter.com/username.', 'https://www.linkedin.com/in/mariam-abo-mandour/', 'https://www.instagram.com/mandour_mariam/');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(10) NOT NULL DEFAULT 'false'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `book_id`, `user_id`, `date`, `status`) VALUES
(12, 6, 9, '2022-01-20 00:38:24', 'false'),
(13, 7, 9, '2022-01-20 10:52:41', 'false'),
(15, 7, 9, '2022-01-20 11:32:47', 'false'),
(16, 9, 14, '2022-01-20 12:11:18', 'true');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `id` int(11) NOT NULL,
  `comment` varchar(50) NOT NULL,
  `article_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`id`, `comment`, `article_id`, `user_id`) VALUES
(1, 'good', 11, 9),
(2, 'good', 11, 9),
(11, 'good', 10, 9),
(13, 'good', 10, 9),
(17, 'good', 11, 14),
(18, 'good', 11, 14);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(80) NOT NULL,
  `mobile` varchar(30) NOT NULL,
  `address` varchar(50) NOT NULL,
  `user_type_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `mobile`, `address`, `user_type_id`) VALUES
(9, 'Admin', 'marimmandour135@gmail.com', 'dacce0917010fa58d3e5f86bec72eb72', '01141862555', 'samanoud', 1),
(10, 'mariam', 'mariam@mariam.com', '92fda28f6ec7066c0ed40444119f7944', '01141862555', 'samanoud', 2),
(14, 'nada', 'marimmand135@gmail.com', '8123634476203afab5400ee986fa63cd', '01141862555', 'samanoud', 3),
(15, 'nana', 'user1@gmail.com', '59029276955677351421b3ff6bf5ee4c', '01141862555', 'Molestiae tempora be', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

CREATE TABLE `user_type` (
  `id` int(11) NOT NULL,
  `title` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_type`
--

INSERT INTO `user_type` (`id`, `title`) VALUES
(1, 'admin'),
(2, 'librarian'),
(3, 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_information`
--
ALTER TABLE `admin_information`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`),
  ADD KEY `author_id` (`author_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `librarian_id` (`librarian_id`);

--
-- Indexes for table `library_branch`
--
ALTER TABLE `library_branch`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `book_id` (`book_id`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`id`),
  ADD KEY `book_id` (`article_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_type_id` (`user_type_id`);

--
-- Indexes for table `user_type`
--
ALTER TABLE `user_type`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_information`
--
ALTER TABLE `admin_information`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `author`
--
ALTER TABLE `author`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `library_branch`
--
ALTER TABLE `library_branch`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `user_type`
--
ALTER TABLE `user_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin_information`
--
ALTER TABLE `admin_information`
  ADD CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `user_write_articles` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `author` FOREIGN KEY (`author_id`) REFERENCES `author` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `category` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `category`
--
ALTER TABLE `category`
  ADD CONSTRAINT `librarian ` FOREIGN KEY (`librarian_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `order_book` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `article_id` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `user_type` FOREIGN KEY (`user_type_id`) REFERENCES `user_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
