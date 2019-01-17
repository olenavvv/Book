-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 07, 2018 at 05:31 PM
-- Server version: 5.6.24
-- PHP Version: 5.5.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `book`
--

-- --------------------------------------------------------

--
-- Table structure for table `all_users`
--

CREATE TABLE IF NOT EXISTS `all_users` (
  `uname` varchar(60) NOT NULL,
  `fname` varchar(60) NOT NULL,
  `lname` varchar(60) NOT NULL,
  `email` varchar(125) NOT NULL,
  `tel` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `all_users`
--

INSERT INTO `all_users` (`uname`, `fname`, `lname`, `email`, `tel`, `password`) VALUES
('admin', 'lena', 'v', 'admin@gmail.com', '5145557777', '1e0d33e67ac71ab2d4c5acf3b7d548e0'),
('diana', 'd', 'd', 'diana@gmail.com', '5145412323', '1f0174edcac2f38cd4612f3e6672245d'),
('dmytro', '1', '12', '12312@asd', '15145508047', '1f0174edcac2f38cd4612f3e6672245d'),
('lena', 'l', 'v', 'lena@gmail.com', '', '1f0174edcac2f38cd4612f3e6672245d');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL,
  `u_name` varchar(60) NOT NULL,
  `title` varchar(60) NOT NULL,
  `author` varchar(60) NOT NULL,
  `quantity` int(11) NOT NULL,
  `category` varchar(60) NOT NULL,
  `price` int(11) NOT NULL,
  `date` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `u_name`, `title`, `author`, `quantity`, `category`, `price`, `date`) VALUES
(22, 'lena', 'abcDELF', 'Adam Forest', 3, 'education', 110, '2018-11-06 13:25:37'),
(23, 'lena', 'Harry Potter and the Philosophers stone', 'J.K.Rowling', 1, 'fiction', 64, '2018-11-07 10:40:28'),
(24, 'lena', 'Yoga Sequencing', 'Mark Stephens', 3, 'education', 40, '2018-11-07 10:40:28'),
(25, 'diana', 'A Clash of Kings', 'George R.R. Martin', 1, 'fiction', 75, '2018-11-07 11:15:29');

-- --------------------------------------------------------

--
-- Table structure for table `tblproduct`
--

CREATE TABLE IF NOT EXISTS `tblproduct` (
  `id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `author` varchar(250) NOT NULL,
  `image` varchar(250) NOT NULL,
  `price` int(11) NOT NULL,
  `category` varchar(60) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblproduct`
--

INSERT INTO `tblproduct` (`id`, `title`, `author`, `image`, `price`, `category`) VALUES
(6, 'The fourth education revolution', 'Anthony Seldon', 'img/fourthEducation_education.jpg', 88, 'education'),
(7, 'Shell', 'Kristina Olsson', 'img/shell_fiction.jpg', 48, 'fiction'),
(8, 'Suitcase of dfreams', 'Tania Blanchard', 'img/suitcaseOfDreams_fiction.jpg', 38, 'fiction'),
(9, 'Harry Potter and the Philosophers stone', 'J.K.Rowling', 'img/harryPotter_fiction.jpg', 64, 'fiction'),
(10, 'Yoga Sequencing', 'Mark Stephens', 'img/yogaSequencing_education.jpg', 40, 'education'),
(11, 'S.E.X.', 'Heather Corinna', 'img/sex_education.jpg', 37, 'education'),
(12, 'Truly Tan Baffled!', 'Jen Storer', 'img/trulyTan_children.jpg', 42, 'children'),
(13, 'The ice monster', 'David Walliams', 'img/theIceMonster_children.jpg', 28, 'children'),
(14, 'Frankie Fish and the great wall of chaos', 'Peterr Helliar', 'img/frankieFish_children.jpg', 55, 'children'),
(15, 'Black snake', 'Leo Kennedy', 'img/blackSnake_history.jpg', 80, 'history'),
(16, 'The billionaire ', 'James Crabtree ', 'img/bilionaireRaj_history.jpg', 95, 'history'),
(17, 'The Fabulous Bouvier Sisters', 'Sam Kashner and Nancy Schoenberger', 'img/fabulousBouvierSisters_history.jpg', 97, 'history'),
(18, 'A Clash of Kings', 'George R.R. Martin', 'img/gameOfThrones_fiction.jpg', 75, 'fiction'),
(19, 'The upside down history of down under', 'Alison Loyd and Terry Denton', 'img/upsideDownHistory_children.jpg', 24, 'children'),
(20, 'Blue lake', 'David Sornig', 'img/blueLake_history.jpg', 125, 'history'),
(21, 'abcDELF', 'Adam Forest', 'img/abcDELF_education.jpg', 110, 'education');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `all_users`
--
ALTER TABLE `all_users`
  ADD PRIMARY KEY (`uname`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblproduct`
--
ALTER TABLE `tblproduct`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `tblproduct`
--
ALTER TABLE `tblproduct`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=28;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
