-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 11, 2020 at 06:51 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `crud_sample`
--

-- --------------------------------------------------------

--
-- Table structure for table `handled_name`
--

CREATE TABLE `handled_name` (
  `id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `handled_name`
--

INSERT INTO `handled_name` (`id`, `user_id`, `password`) VALUES
(2, 6, 'rick'),
(3, 7, 'kara'),
(6, 10, 'peter');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `fullname` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` text NOT NULL,
  `status` enum('Admin','Member','','') NOT NULL,
  `created_on` datetime NOT NULL,
  `updated_on` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `username`, `email`, `password`, `status`, `created_on`, `updated_on`) VALUES
(6, 'Rick Ryan', 'Kcir', 'rickryan29.rr@gmail.com', '$2y$11$VgUP2EIfHq/FecS0YnYtHefKaOi977MHnOfTynJBwwWGa86kWCMiO', 'Admin', '2020-04-08 23:52:57', '2020-04-08 15:52:57'),
(7, 'Kara Denvers', 'Supergirl', 'kara@gmail.com', '$2y$11$j5cD/XH2fKVIl0li.3MHSe8VQrMOgkYUmu9GLhpACrpNMIFdEa8Va', 'Admin', '2020-04-08 23:53:24', '2020-04-08 15:53:24'),
(10, 'Peter Parker', 'Spiderman', 'peter@gmail.com', '$2y$11$uz0v6.ChWA4tWcGYgG2LuuCHGU.eXm2ogc6W8728BbNtN4f0q5ypu', 'Member', '2020-04-12 00:41:41', '2020-04-11 16:41:41');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `handled_name`
--
ALTER TABLE `handled_name`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `handled_name`
--
ALTER TABLE `handled_name`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
