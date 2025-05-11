-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 11, 2025 at 08:26 AM
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
(2, 'Cyrus', 'asdasdsad', '../images/categories//67d2e4e45561b6.19670673.png', '2025-03-13'),
(3, 'Category', 'asdasd', '../images/categories//6811d2d0150b90.86018828.jpg', '2025-04-30'),
(4, 'aaaa', 'asdasd', '6811d374a176e0.14047250.jpg', '2025-04-30');

-- --------------------------------------------------------

--
-- Table structure for table `equipment`
--

CREATE TABLE `equipment` (
  `ID` int(11) NOT NULL,
  `equipment_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `equipment`
--

INSERT INTO `equipment` (`ID`, `equipment_name`) VALUES
(1, 'Dumbbells'),
(2, 'Barbells'),
(3, 'Kettle Bells');

-- --------------------------------------------------------

--
-- Table structure for table `exercise`
--

CREATE TABLE `exercise` (
  `ID` int(11) NOT NULL,
  `exerciseName` varchar(255) NOT NULL,
  `exercisePicUrl` varchar(500) NOT NULL,
  `description` varchar(500) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `dateCreated` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `exercise`
--

INSERT INTO `exercise` (`ID`, `exerciseName`, `exercisePicUrl`, `description`, `status`, `dateCreated`) VALUES
(1, 'Push ups', '67d440ab849967.82224901.jpg', 'asdasdsa', 1, '2025-03-14'),
(2, 'Sit Ups', '67d44426ab2fc1.42629636.jpg', 'asdasdasd', 1, '2025-03-14'),
(3, 'Planks', '../images/exercises//68064f7f92f897.85634536.png', 'Hello World', 0, '2025-04-21'),
(4, 'fdgdfg', '../images/exercises//68090ff619e106.55438392.png', 'hgjghj', 0, '2025-04-24'),
(5, 'Pull Ups', '681208b85e8d83.69682522.jpg', 'asdasdsad', 1, '2025-04-30'),
(6, 'Plankssss', '6812343b9927d1.00519393.jpg', 'asdsad', 1, '2025-04-30'),
(7, 'test', '6813093ed54090.29558205.jpg', 'test', 0, '2025-05-01');

-- --------------------------------------------------------

--
-- Table structure for table `exercise_category`
--

CREATE TABLE `exercise_category` (
  `ID` int(11) NOT NULL,
  `exerciseID` int(11) NOT NULL,
  `categoryID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `exercise_category`
--

INSERT INTO `exercise_category` (`ID`, `exerciseID`, `categoryID`) VALUES
(66, 6, 3),
(67, 1, 1),
(68, 1, 2),
(69, 1, 3),
(71, 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `exercise_equipment`
--

CREATE TABLE `exercise_equipment` (
  `ID` int(11) NOT NULL,
  `exerciseID` int(11) NOT NULL,
  `equipmentID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `exercise_equipment`
--

INSERT INTO `exercise_equipment` (`ID`, `exerciseID`, `equipmentID`) VALUES
(61, 6, 1),
(62, 1, 1),
(63, 1, 2),
(64, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `exercise_muscle`
--

CREATE TABLE `exercise_muscle` (
  `ID` int(11) NOT NULL,
  `exerciseID` int(11) NOT NULL,
  `muscleID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `exercise_steps`
--

CREATE TABLE `exercise_steps` (
  `ID` int(11) NOT NULL,
  `exerciseID` int(11) NOT NULL,
  `step_pic_url` varchar(500) DEFAULT NULL,
  `step_instruction` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `exercise_steps`
--

INSERT INTO `exercise_steps` (`ID`, `exerciseID`, `step_pic_url`, `step_instruction`) VALUES
(5, 5, NULL, 'asdasdsad'),
(12, 1, NULL, 'sadasd1'),
(13, 1, NULL, 'asdasdsad2'),
(15, 6, NULL, 'dsadasd'),
(16, 1, NULL, 'asdasdsa4'),
(17, 1, NULL, 'asdas3');

-- --------------------------------------------------------

--
-- Table structure for table `muscle`
--

CREATE TABLE `muscle` (
  `ID` int(11) NOT NULL,
  `muscle_name` varchar(255) NOT NULL,
  `muscle_pic_url` varchar(500) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(3, 'ChrisCross1', 'gutierrezchristianm@gmail.com', '$2y$10$QI2IGoon4oBB80PgzBOWqOIZzplqxLLuszPY9zkenKTHWP5vv0rce', 'Christian', 'Gutierrez', '2025-03-09', 9166945580, 'male', '../images/grit.PNG', '2025-03-10 18:13:51', '2025-03-10', '2025-03-10', 'user', 'active', NULL, NULL),
(4, 'ChrisCross2', '11christianmg11@gmail.com', '$2y$10$nI67eg8aHHGkxROX9ckwsOmiAVHtsAZeXzx96ye/3/7kHkAtLko7K', 'asd', 'asd', '2025-03-11', 9166945580, 'male', '../images/grit.PNG', '2025-03-10 18:17:45', '2025-03-10', '2025-03-10', 'user', 'active', NULL, NULL),
(6, 'ChrisCross4', '11christiangutierrez11@gmail.com', '$2y$10$gx02YaQLckOsVDNGAjLG0ursHJ9ntzYJF6eTYPBhmYtVFUTeJZK.O', 'Christian', 'Gutierrez', '2025-03-10', 9166945580, 'male', '../images/grit.PNG', '2025-03-10 18:21:51', '2025-03-10', '2025-03-10', 'user', 'active', NULL, NULL),
(7, 'ChrisCross5', 'xabokay145@oziere.com', '$2y$10$aoJFZfjaNYdq8VnFo6pboOhpxr/30PEczj9PiYuISGse.cwrx59lK', 'chrs', 'asdasd', '2025-03-10', 9166945580, 'male', '../images/grit.PNG', '2025-03-10 19:49:20', '2025-03-10', '2025-03-10', 'user', 'active', NULL, NULL),
(8, 'ChrisCross', 'kurosucode@gmail.com', '$2y$10$vZEBcDZaUTfjiFbK.G.WfOSnYZwx2kZOWTn4KnrDdGOAOn/MF./jq', 'asjdkasjdkasdksajkdasjkd', 'asjkdjaskdaskdjaksdjkas', '2025-03-10', 9166945580, 'male', '../images/grit.PNG', '2025-03-10 19:58:12', '2025-03-10', '2025-03-10', 'user', 'active', NULL, NULL),
(10, 'FLEX-CyrusGutierrez', 'asdsad@gmail.com', '$2y$10$OVzIpvLP6fiRafodz3aWV.DolJpdBdtLW7aanVoMkTa6HXxiw3Anm', 'Cyrus', 'Gutierrez', '2025-03-13', 9166945580, 'Male', '../../instructor/images/Cyrus-Gutierrez/67d285da6ef0e0.18633683.jpg', '2025-03-13 15:14:34', '2025-03-13', '2025-03-13', 'instructor', 'active', NULL, NULL),
(11, 'FLEX-ChristianGutierrez', 'asdaaaaaaaaa@gmail.com', '$2y$10$k9M3MsDAyQRrmiITLtovOuw7JdMC7.sb05RVPEWUyrWuDZm04ks4i', 'Christian', 'Gutierrez', '2025-03-13', 9166945580, 'Male', '../../instructor/images/Christian-Gutierrez/67d2a4dd305de3.93129472.png', '2025-03-13 17:26:53', '2025-03-13', '2025-03-13', 'instructor', 'active', NULL, NULL),
(12, 'FLEX-123123123', 'pdineen259@gmail.com', '$2y$10$lhpIuYQVVqzk8ttA4l9djelA80vWQ.x/DUqLqo.4uqNtlShMYkrRu', '123123', '123', '2025-03-13', 9166945580, 'Male', '../../instructor/images/123123-123/67d2cf649e1559.77743507.jpg', '2025-03-13 20:28:20', '2025-03-13', '2025-03-13', 'instructor', 'active', NULL, NULL),
(14, 'FLEX-Cyrus1Gutierrez', 'asdaszvczxcvzx@gmail.com', '$2y$10$5wrmyPdu/mtXzQfxR7Dy0.xgxLhNdXLWEvFmPbD8C3RsGgsDLxEsK', 'Cyrus1', 'Gutierrez', '2025-03-14', 9166945580, 'Male', '../../instructor/images/Cyrus1-Gutierrez/67d43bfc7dc490.67599191.jpg', '2025-03-14 22:23:56', '2025-03-14', '2025-03-14', 'instructor', 'active', NULL, NULL),
(15, 'FLEX-asdasdasdasdsad', 'aaaaaaaa@email.com', '$2y$10$vDK2z4IgA6k/TobkHWACOuVHkbWc2iZkwQMwOOLXi0WiL/ereybhK', 'asdasd', 'asdasdsad', '2025-04-20', 9166945580, 'Female', '../../instructor/images/asdasd-asdasdsad/6804a343cf9477.93588506.png', '2025-04-20 15:33:23', '2025-04-20', '2025-04-20', 'instructor', 'active', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `workout`
--

CREATE TABLE `workout` (
  `ID` int(11) NOT NULL,
  `workoutName` varchar(255) NOT NULL,
  `workoutPicUrl` varchar(500) NOT NULL,
  `workoutDescription` varchar(500) NOT NULL,
  `difficulty` varchar(255) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `dateCreated` datetime NOT NULL DEFAULT current_timestamp(),
  `dateUpdated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `workout`
--

INSERT INTO `workout` (`ID`, `workoutName`, `workoutPicUrl`, `workoutDescription`, `difficulty`, `status`, `dateCreated`, `dateUpdated`) VALUES
(1, 'asddasd', '681f36c5037717.15007028.jpg', 'asddasdd', 'easy', 0, '2025-05-10 19:21:41', '0000-00-00 00:00:00'),
(2, '1111', '681f716ec5f425.77013379.jpg', '11111', 'hard', 0, '2025-05-10 23:31:58', NULL),
(3, 'asdasd', '682032eb5ad891.30440722.jpg', 'asdasd', 'hard', 0, '2025-05-11 13:17:31', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `workout_exercises`
--

CREATE TABLE `workout_exercises` (
  `ID` int(11) NOT NULL,
  `workoutID` int(11) NOT NULL,
  `exerciseID` int(11) NOT NULL,
  `exerciseOrder` int(11) DEFAULT NULL,
  `reps` int(11) DEFAULT NULL,
  `duration` time DEFAULT NULL,
  `workoutSet` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `workout_exercises`
--

INSERT INTO `workout_exercises` (`ID`, `workoutID`, `exerciseID`, `exerciseOrder`, `reps`, `duration`, `workoutSet`) VALUES
(19, 1, 4, NULL, 22, '22:22:22', 1),
(20, 1, 4, NULL, 2, '11:11:11', 1),
(21, 1, 4, NULL, 11, '11:11:11', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `equipment`
--
ALTER TABLE `equipment`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `exercise`
--
ALTER TABLE `exercise`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `exercise_category`
--
ALTER TABLE `exercise_category`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `exerciseID` (`exerciseID`),
  ADD KEY `categoryID` (`categoryID`);

--
-- Indexes for table `exercise_equipment`
--
ALTER TABLE `exercise_equipment`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `exerciseID` (`exerciseID`),
  ADD KEY `equipmentID` (`equipmentID`);

--
-- Indexes for table `exercise_muscle`
--
ALTER TABLE `exercise_muscle`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `exerciseID` (`exerciseID`),
  ADD KEY `muscleID` (`muscleID`);

--
-- Indexes for table `exercise_steps`
--
ALTER TABLE `exercise_steps`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `exerciseID` (`exerciseID`);

--
-- Indexes for table `muscle`
--
ALTER TABLE `muscle`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `workout`
--
ALTER TABLE `workout`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `workout_exercises`
--
ALTER TABLE `workout_exercises`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `exerciseID` (`exerciseID`),
  ADD KEY `workoutID` (`workoutID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `equipment`
--
ALTER TABLE `equipment`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `exercise`
--
ALTER TABLE `exercise`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `exercise_category`
--
ALTER TABLE `exercise_category`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `exercise_equipment`
--
ALTER TABLE `exercise_equipment`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `exercise_muscle`
--
ALTER TABLE `exercise_muscle`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `exercise_steps`
--
ALTER TABLE `exercise_steps`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `muscle`
--
ALTER TABLE `muscle`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `workout`
--
ALTER TABLE `workout`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `workout_exercises`
--
ALTER TABLE `workout_exercises`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `exercise_category`
--
ALTER TABLE `exercise_category`
  ADD CONSTRAINT `exercise_category_ibfk_1` FOREIGN KEY (`exerciseID`) REFERENCES `exercise` (`ID`),
  ADD CONSTRAINT `exercise_category_ibfk_2` FOREIGN KEY (`categoryID`) REFERENCES `category` (`ID`);

--
-- Constraints for table `exercise_equipment`
--
ALTER TABLE `exercise_equipment`
  ADD CONSTRAINT `exercise_equipment_ibfk_1` FOREIGN KEY (`exerciseID`) REFERENCES `exercise` (`ID`),
  ADD CONSTRAINT `exercise_equipment_ibfk_2` FOREIGN KEY (`equipmentID`) REFERENCES `equipment` (`ID`);

--
-- Constraints for table `exercise_muscle`
--
ALTER TABLE `exercise_muscle`
  ADD CONSTRAINT `exercise_muscle_ibfk_1` FOREIGN KEY (`exerciseID`) REFERENCES `exercise` (`ID`),
  ADD CONSTRAINT `exercise_muscle_ibfk_2` FOREIGN KEY (`muscleID`) REFERENCES `muscle` (`ID`);

--
-- Constraints for table `exercise_steps`
--
ALTER TABLE `exercise_steps`
  ADD CONSTRAINT `exercise_steps_ibfk_1` FOREIGN KEY (`exerciseID`) REFERENCES `exercise` (`ID`);

--
-- Constraints for table `workout_exercises`
--
ALTER TABLE `workout_exercises`
  ADD CONSTRAINT `workout_exercises_ibfk_1` FOREIGN KEY (`exerciseID`) REFERENCES `exercise` (`ID`),
  ADD CONSTRAINT `workout_exercises_ibfk_2` FOREIGN KEY (`workoutID`) REFERENCES `workout` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
