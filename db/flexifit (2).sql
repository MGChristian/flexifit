-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 14, 2025 at 06:31 AM
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
-- Database: `flexifit`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `ID` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `category_description` varchar(500) NOT NULL,
  `category_pic_url` varchar(500) NOT NULL,
  `dateCreated` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`ID`, `category_name`, `category_description`, `category_pic_url`, `dateCreated`) VALUES
(1, 'asdasd', 'asdasdasd', '../images/categories//67d2e399a5c5a3.66144215.jpg', '2025-03-13'),
(2, 'Cyrus', 'asdasdsad', '../images/categories//67d2e4e45561b6.19670673.png', '2025-03-13');

-- --------------------------------------------------------

--
-- Table structure for table `exercise`
--

CREATE TABLE `exercise` (
  `ID` int(11) NOT NULL,
  `exerciseName` varchar(255) NOT NULL,
  `exercisePicUrl` varchar(500) NOT NULL,
  `description` varchar(500) NOT NULL,
  `dateCreated` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `exercise`
--

INSERT INTO `exercise` (`ID`, `exerciseName`, `exercisePicUrl`, `description`, `dateCreated`) VALUES
(1, 'Push ups', '../images/exercises//67d440ab849967.82224901.jpg', 'asdasdsa', '2025-03-14'),
(2, 'Sit Ups', '../images/exercises//67d44426ab2fc1.42629636.jpg', 'asdasdasd', '2025-03-14');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `ID` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `DOB` date NOT NULL,
  `contactNo` bigint(11) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `profilePicUrl` varchar(500) NOT NULL,
  `dateCreated` datetime NOT NULL DEFAULT current_timestamp(),
  `dateUpdated` date NOT NULL DEFAULT current_timestamp(),
  `lastLoggedIn` date NOT NULL DEFAULT current_timestamp(),
  `role` varchar(10) NOT NULL DEFAULT 'user',
  `status` varchar(10) NOT NULL DEFAULT 'active',
  `reset_token` varchar(255) DEFAULT NULL,
  `reset_expiry` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ID`, `username`, `email`, `password`, `firstName`, `lastName`, `DOB`, `contactNo`, `gender`, `profilePicUrl`, `dateCreated`, `dateUpdated`, `lastLoggedIn`, `role`, `status`, `reset_token`, `reset_expiry`) VALUES
(1, 'asd', 'asd@gmail.com', '$2y$10$vZEBcDZaUTfjiFbK.G.WfOSnYZwx2kZOWTn4KnrDdGOAOn/MF./jq', '123', '123', '2025-03-10', 123, 'asd', 'asd', '2025-03-10 16:44:14', '2025-03-10', '2025-03-10', 'admin', 'active', NULL, NULL),
(3, 'ChrisCross1', 'gutierrezchristianm@gmail.com', '$2y$10$lw/pOhulLegONJ0pBfOc7.QQIfaQT12FoatGzraCNl/j15aBIWUei', 'Christian', 'Gutierrez', '2025-03-09', 9166945580, 'male', '../images/grit.PNG', '2025-03-10 18:13:51', '2025-03-10', '2025-03-10', 'user', 'active', NULL, NULL),
(4, 'ChrisCross2', '11christianmg11@gmail.com', '$2y$10$nI67eg8aHHGkxROX9ckwsOmiAVHtsAZeXzx96ye/3/7kHkAtLko7K', 'asd', 'asd', '2025-03-11', 9166945580, 'male', '../images/grit.PNG', '2025-03-10 18:17:45', '2025-03-10', '2025-03-10', 'user', 'active', NULL, NULL),
(6, 'ChrisCross4', '11christiangutierrez11@gmail.com', '$2y$10$gx02YaQLckOsVDNGAjLG0ursHJ9ntzYJF6eTYPBhmYtVFUTeJZK.O', 'Christian', 'Gutierrez', '2025-03-10', 9166945580, 'male', '../images/grit.PNG', '2025-03-10 18:21:51', '2025-03-10', '2025-03-10', 'user', 'active', NULL, NULL),
(7, 'ChrisCross5', 'xabokay145@oziere.com', '$2y$10$aoJFZfjaNYdq8VnFo6pboOhpxr/30PEczj9PiYuISGse.cwrx59lK', 'chrs', 'asdasd', '2025-03-10', 9166945580, 'male', '../images/grit.PNG', '2025-03-10 19:49:20', '2025-03-10', '2025-03-10', 'user', 'active', NULL, NULL),
(8, 'ChrisCross', 'kurosucode@gmail.com', '$2y$10$vZEBcDZaUTfjiFbK.G.WfOSnYZwx2kZOWTn4KnrDdGOAOn/MF./jq', 'asjdkasjdkasdksajkdasjkd', 'asjkdjaskdaskdjaksdjkas', '2025-03-10', 9166945580, 'male', '../images/grit.PNG', '2025-03-10 19:58:12', '2025-03-10', '2025-03-10', 'user', 'active', NULL, NULL),
(10, 'FLEX-CyrusGutierrez', 'asdsad@gmail.com', '$2y$10$OVzIpvLP6fiRafodz3aWV.DolJpdBdtLW7aanVoMkTa6HXxiw3Anm', 'Cyrus', 'Gutierrez', '2025-03-13', 9166945580, 'Male', '../../instructor/images/Cyrus-Gutierrez/67d285da6ef0e0.18633683.jpg', '2025-03-13 15:14:34', '2025-03-13', '2025-03-13', 'instructor', 'active', NULL, NULL),
(11, 'FLEX-ChristianGutierrez', 'asdaaaaaaaaa@gmail.com', '$2y$10$k9M3MsDAyQRrmiITLtovOuw7JdMC7.sb05RVPEWUyrWuDZm04ks4i', 'Christian', 'Gutierrez', '2025-03-13', 9166945580, 'Male', '../../instructor/images/Christian-Gutierrez/67d2a4dd305de3.93129472.png', '2025-03-13 17:26:53', '2025-03-13', '2025-03-13', 'instructor', 'active', NULL, NULL),
(12, 'FLEX-123123123', 'pdineen259@gmail.com', '$2y$10$lhpIuYQVVqzk8ttA4l9djelA80vWQ.x/DUqLqo.4uqNtlShMYkrRu', '123123', '123', '2025-03-13', 9166945580, 'Male', '../../instructor/images/123123-123/67d2cf649e1559.77743507.jpg', '2025-03-13 20:28:20', '2025-03-13', '2025-03-13', 'instructor', 'active', NULL, NULL),
(14, 'FLEX-Cyrus1Gutierrez', 'asdaszvczxcvzx@gmail.com', '$2y$10$5wrmyPdu/mtXzQfxR7Dy0.xgxLhNdXLWEvFmPbD8C3RsGgsDLxEsK', 'Cyrus1', 'Gutierrez', '2025-03-14', 9166945580, 'Male', '../../instructor/images/Cyrus1-Gutierrez/67d43bfc7dc490.67599191.jpg', '2025-03-14 22:23:56', '2025-03-14', '2025-03-14', 'instructor', 'active', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `exercise`
--
ALTER TABLE `exercise`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `exercise`
--
ALTER TABLE `exercise`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
