-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 24, 2022 at 04:26 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `testdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `actor`
--

CREATE TABLE `actor` (
  `actor_id` smallint(5) UNSIGNED NOT NULL,
  `first_name` varchar(45) NOT NULL,
  `last_name` varchar(45) NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `email` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `actor`
--

INSERT INTO `actor` (`actor_id`, `first_name`, `last_name`, `last_update`, `email`) VALUES
(1, 'PENELOPE', 'GUINESS', '2022-02-23 17:27:55', '62030271@go.buu.ac.th'),
(2, 'NICK', 'WAHLBERG', '2022-02-23 17:29:52', '62030270@go.buu.ac.th'),
(3, 'ED', 'CHASE', '2022-02-23 17:30:46', '62030264@go.buu.ac.th'),
(4, 'JENNIFER', 'DAVIS', '2022-02-23 17:30:29', '62030266@go.buu.ac.th'),
(5, 'JOHNNY', 'LOLLOBRIGIDA', '2022-02-23 17:30:16', '62030268@go.buu.ac.th'),
(6, 'BETTE', 'NICHOLSON', '2022-02-23 17:31:02', '62030262@go.buu.ac.th'),
(7, 'GRACE', 'MOSTEL', '2022-02-23 17:30:39', '62030265@go.buu.ac.th'),
(8, 'MATTHEW', 'JOHANSSON', '2022-02-23 17:30:04', '62030269@go.buu.ac.th'),
(9, 'JOE', 'SWANK', '2022-02-23 17:30:22', '62030267@go.buu.ac.th'),
(10, 'CHRISTIAN', 'GABLE', '2022-02-23 17:30:53', '62030263@go.buu.ac.th'),
(13, 'Renjun', 'Huang', '2022-02-23 17:24:48', '62030272@go.buu.ac.th'),
(14, 'Jeno', 'Lee', '2022-02-23 17:31:19', '62030273@go.buu.ac.th');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `actor`
--
ALTER TABLE `actor`
  ADD PRIMARY KEY (`actor_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `actor`
--
ALTER TABLE `actor`
  MODIFY `actor_id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
