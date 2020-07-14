-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 13, 2020 at 10:06 PM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `omdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `movie_numbers`
--

CREATE TABLE `movie_numbers` (
  `movie_id` int(6) NOT NULL COMMENT 'This is both PK and FK; movie_numbers is a WEAK entity',
  `running_time` int(3) DEFAULT NULL COMMENT 'Running Time in Minutes',
  `length` int(2) DEFAULT NULL COMMENT 'length (depends on the native_name)',
  `strength` int(2) DEFAULT NULL COMMENT 'strengh (depends on the native_name)',
  `weight` int(2) DEFAULT NULL COMMENT 'weight (depends on native name)',
  `budget` int(8) DEFAULT NULL COMMENT 'budget in local (native) currency',
  `box_office` int(8) DEFAULT NULL COMMENT 'box office numbers in local (native) currency'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `movie_numbers`
--
ALTER TABLE `movie_numbers`
  ADD PRIMARY KEY (`movie_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
