-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 11, 2025 at 02:23 PM
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
  `role` varchar(10) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ID`, `username`, `email`, `password`, `firstName`, `lastName`, `DOB`, `contactNo`, `gender`, `profilePicUrl`, `dateCreated`, `dateUpdated`, `lastLoggedIn`, `role`) VALUES
(1, 'asd', 'asd@gmail.com', '$2y$10$vZEBcDZaUTfjiFbK.G.WfOSnYZwx2kZOWTn4KnrDdGOAOn/MF./jq', '123', '123', '2025-03-10', 123, 'asd', 'asd', '2025-03-10 16:44:14', '2025-03-10', '2025-03-10', 'admin'),
(3, 'ChrisCross1', 'gutierrezchristianm@gmail.com', '$2y$10$D2tRw6E6Tt21FyMnqxjnoO8uVE/u7Z.ZsaW8no0R8D7A5aSH4Fu2O', 'Christian', 'Gutierrez', '2025-03-09', 9166945580, 'male', '../images/grit.PNG', '2025-03-10 18:13:51', '2025-03-10', '2025-03-10', 'user'),
(4, 'ChrisCross2', '11christianmg11@gmail.com', '$2y$10$nI67eg8aHHGkxROX9ckwsOmiAVHtsAZeXzx96ye/3/7kHkAtLko7K', 'asd', 'asd', '2025-03-11', 9166945580, 'male', '../images/grit.PNG', '2025-03-10 18:17:45', '2025-03-10', '2025-03-10', 'user'),
(6, 'ChrisCross4', '11christiangutierrez11@gmail.com', '$2y$10$gx02YaQLckOsVDNGAjLG0ursHJ9ntzYJF6eTYPBhmYtVFUTeJZK.O', 'Christian', 'Gutierrez', '2025-03-10', 9166945580, 'male', '../images/grit.PNG', '2025-03-10 18:21:51', '2025-03-10', '2025-03-10', 'user'),
(7, 'ChrisCross5', 'xabokay145@oziere.com', '$2y$10$aoJFZfjaNYdq8VnFo6pboOhpxr/30PEczj9PiYuISGse.cwrx59lK', 'chrs', 'asdasd', '2025-03-10', 9166945580, 'male', '../images/grit.PNG', '2025-03-10 19:49:20', '2025-03-10', '2025-03-10', 'user'),
(8, 'ChrisCross', 'kurosucode@gmail.com', '$2y$10$vZEBcDZaUTfjiFbK.G.WfOSnYZwx2kZOWTn4KnrDdGOAOn/MF./jq', 'asjdkasjdkasdksajkdasjkd', 'asjkdjaskdaskdjaksdjkas', '2025-03-10', 9166945580, 'male', '../images/grit.PNG', '2025-03-10 19:58:12', '2025-03-10', '2025-03-10', 'user');

--
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
