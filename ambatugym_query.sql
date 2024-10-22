-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 22, 2024 at 04:36 PM
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
-- Database: `ambatugym_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `users_id` int(11) NOT NULL,
  `users_fullname` varchar(100) NOT NULL,
  `users_email` int(11) NOT NULL,
  `users_username` varchar(50) NOT NULL,
  `users_password` varchar(255) NOT NULL,
  `users_gender` int(11) NOT NULL,
  `users_age` int(11) NOT NULL,
  `users_birthdate` date DEFAULT current_timestamp(),
  `users_weight` int(11) NOT NULL,
  `users_height` int(11) NOT NULL,
  `users_goal` int(11) NOT NULL,
  `users_photo` int(11) NOT NULL,
  `users_achievement` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`users_id`, `users_fullname`, `users_email`, `users_username`, `users_password`, `users_gender`, `users_age`, `users_birthdate`, `users_weight`, `users_height`, `users_goal`, `users_photo`, `users_achievement`) VALUES
(1, '', 0, 'anna', '123', 0, 0, '2024-10-22', 0, 0, 0, 0, 0),
(2, '', 0, 'abv', '123', 0, 0, '2024-10-22', 0, 0, 0, 0, 0),
(3, '', 0, 'cth', '123', 0, 0, '2024-10-22', 0, 0, 0, 0, 0),
(6, '', 0, 'boku', '321', 0, 0, '2024-10-22', 0, 0, 0, 0, 0),
(8, '', 0, 'muani', '123', 0, 0, '2024-10-22', 0, 0, 0, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`users_id`),
  ADD UNIQUE KEY `users_username` (`users_username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `users_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
