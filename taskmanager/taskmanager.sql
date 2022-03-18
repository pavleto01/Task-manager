-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 18, 2022 at 02:51 PM
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
-- Database: `taskmanager`
--

-- --------------------------------------------------------

--
-- Table structure for table `agents`
--

CREATE TABLE `agents` (
  `id_agent` int(11) NOT NULL,
  `agent_name` varchar(255) NOT NULL,
  `agent_email` varchar(255) NOT NULL,
  `agent_username` varchar(255) NOT NULL,
  `agent_password` varchar(255) NOT NULL,
  `perm` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `agents`
--

INSERT INTO `agents` (`id_agent`, `agent_name`, `agent_email`, `agent_username`, `agent_password`, `perm`) VALUES
(1, 'ADMIN', 'admin@admin.com', 'admin', 'admin', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cases`
--

CREATE TABLE `cases` (
  `id_case` int(11) NOT NULL,
  `case_title` varchar(255) NOT NULL,
  `case_author` varchar(255) NOT NULL,
  `case_description` longtext NOT NULL,
  `case_priority` varchar(255) NOT NULL,
  `case_status` varchar(255) NOT NULL,
  `date_in` timestamp(3) NOT NULL DEFAULT current_timestamp(3)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `case_agent`
--

CREATE TABLE `case_agent` (
  `id_ca` int(11) NOT NULL,
  `case_id` int(11) NOT NULL,
  `agent_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `permission`
--

CREATE TABLE `permission` (
  `id_perm` int(11) NOT NULL,
  `permission` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `permission`
--

INSERT INTO `permission` (`id_perm`, `permission`) VALUES
(1, 'ПЪЛЕН'),
(2, 'ЧАСТИЧЕН');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agents`
--
ALTER TABLE `agents`
  ADD PRIMARY KEY (`id_agent`),
  ADD KEY `perm` (`perm`);

--
-- Indexes for table `cases`
--
ALTER TABLE `cases`
  ADD PRIMARY KEY (`id_case`);

--
-- Indexes for table `case_agent`
--
ALTER TABLE `case_agent`
  ADD PRIMARY KEY (`id_ca`),
  ADD KEY `case_id` (`case_id`),
  ADD KEY `agent_id` (`agent_id`);

--
-- Indexes for table `permission`
--
ALTER TABLE `permission`
  ADD PRIMARY KEY (`id_perm`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agents`
--
ALTER TABLE `agents`
  MODIFY `id_agent` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `cases`
--
ALTER TABLE `cases`
  MODIFY `id_case` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `case_agent`
--
ALTER TABLE `case_agent`
  MODIFY `id_ca` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permission`
--
ALTER TABLE `permission`
  MODIFY `id_perm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `agents`
--
ALTER TABLE `agents`
  ADD CONSTRAINT `perm` FOREIGN KEY (`perm`) REFERENCES `permission` (`id_perm`);

--
-- Constraints for table `case_agent`
--
ALTER TABLE `case_agent`
  ADD CONSTRAINT `agent_id` FOREIGN KEY (`agent_id`) REFERENCES `agents` (`id_agent`),
  ADD CONSTRAINT `case_id` FOREIGN KEY (`case_id`) REFERENCES `cases` (`id_case`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
