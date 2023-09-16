-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 14, 2023 at 06:48 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `personal_management_website`
--

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `subject_id` int(11) NOT NULL,
  `subject_name` varchar(255) NOT NULL,
  `subject_description` varchar(255) NOT NULL,
  `subject_starting_semester` varchar(255) NOT NULL,
  `subject_opinion` varchar(255) NOT NULL,
  `datetime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`subject_id`, `subject_name`, `subject_description`, `subject_starting_semester`, `subject_opinion`, `datetime`) VALUES
(1, '', '', '', '', '2023-09-14 22:44:59'),
(2, '', '', '', '', '2023-09-14 22:45:43'),
(3, 'f', 'f', 'f', 'f', '2023-09-14 22:45:56');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `otp` varchar(255) NOT NULL,
  `datetime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `user_email`, `password`, `otp`, `datetime`) VALUES
(1, 'hi', '', '12\r\n', '', '2023-09-06 14:21:26'),
(2, 'd', '', 's1', '', '2023-09-06 14:23:33'),
(3, '', '', '', '', '2023-09-06 15:31:01'),
(4, '', '', '', '', '2023-09-06 15:32:01'),
(5, 'Birat', 'birat@birat.com', '$2y$10$vcAWAQwY.JGw0Laq2FeNi.Nwi4i9cPZtbtG2Pc5WX2pH.aUFklfRK', '', '2023-09-06 15:50:26'),
(6, 'Birat', 'birat@birat.com', '$2y$10$JUpTHH50D1KdVdI/7hTFM.u5pmnvl367m9ru6pI5oJMLvBe49q4AW', '', '2023-09-06 15:50:34'),
(7, 'Birat', 'birat@birat.com', '$2y$10$m3XUdQoMZApUA/M7z5mN.e5yGKdKjwJJhy8lM8bs0m6UpejDIsDH6', '', '2023-09-06 15:56:55'),
(9, 'g', 'g@g.com', '$2y$10$aZ182rvtpzTXMRqMoDrOReQDA.JL6okoZtSNxSGm20FA0PQ71NkuC', '', '2023-09-06 16:09:02'),
(10, 'Lokeshwar Deb', 'daviddeb8479@gmail.com', '$2y$10$VOcTT/2o85O0kFD1iS74Meyxoz7d.OZSPBMw97IY3IxLCpcXToxCm', '', '2023-09-06 16:11:28'),
(11, 'David', 'david@d.com', '$2y$10$.h7kBVd7OSRzytyuTot1n.sr5yotZOjECq4h9NJLMpXiylYfhR.cm', '', '2023-09-13 09:36:01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`subject_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `subject_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
