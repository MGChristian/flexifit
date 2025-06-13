-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 13, 2025 at 02:33 AM
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
(6, 'Weight Loss', 'Browse effective workouts to help you lose weight easily and quickly.', '6848d1c22f5490.92557729.jpeg', '2025-06-11'),
(7, 'Bodyweight', 'Exercises that doesn\'t need any equipments', '6848d2097af404.91506284.jpg', '2025-06-11'),
(8, 'Weight Lifting', 'Exercises that utilizes weighs.', '6848d23c383c86.84293041.jpg', '2025-06-11'),
(9, 'Yoga', 'Exercises that heals the soul.', '6848d2969b9ed6.81092929.jpg', '2025-06-11'),
(10, 'Pilates', 'Pilates Description', '6848d2e4265386.44392532.jpg', '2025-06-11');

-- --------------------------------------------------------

--
-- Table structure for table `collection`
--

CREATE TABLE `collection` (
  `ID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `collectionName` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'active',
  `date_created` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `collection`
--

INSERT INTO `collection` (`ID`, `userID`, `collectionName`, `description`, `status`, `date_created`) VALUES
(1, 19, 'My First Collection', 'asdasd', 'active', '2025-06-13'),
(2, 19, 'My Second Collection', 'asdasdasd', 'active', '2025-06-13');

-- --------------------------------------------------------

--
-- Table structure for table `collection_workouts`
--

CREATE TABLE `collection_workouts` (
  `ID` int(11) NOT NULL,
  `collectionID` int(11) NOT NULL,
  `workoutID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `collection_workouts`
--

INSERT INTO `collection_workouts` (`ID`, `collectionID`, `workoutID`) VALUES
(1, 1, 15),
(2, 2, 15),
(3, 1, 16);

-- --------------------------------------------------------

--
-- Table structure for table `equipment`
--

CREATE TABLE `equipment` (
  `ID` int(11) NOT NULL,
  `equipment_name` varchar(255) NOT NULL,
  `equipment_description` text NOT NULL,
  `equipment_pic_url` text NOT NULL,
  `dateCreated` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `equipment`
--

INSERT INTO `equipment` (`ID`, `equipment_name`, `equipment_description`, `equipment_pic_url`, `dateCreated`) VALUES
(5, 'Dumbbells', 'These are great for a variety of exercises.', '6848d5cd791d49.72607954.jpg', '2025-06-11'),
(6, 'Barbell', 'These are greave for heavy lifting exercises.', '6848d603348247.41400991.jpg', '2025-06-11'),
(7, 'Kettle Bells', 'Versatile Equipment', '6848d61f665e70.84790947.jpg', '2025-06-11'),
(8, 'Yoga Ball', 'Good for a variety of exercises', '6848d639da27f1.95352496.jpg', '2025-06-11'),
(9, 'Gym Bands', 'Gym bands are very flexible equipments', '6848dab49485a5.34330035.jpg', '2025-06-11');

-- --------------------------------------------------------

--
-- Table structure for table `exercise`
--

CREATE TABLE `exercise` (
  `ID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `exerciseName` varchar(255) NOT NULL,
  `exercisePicUrl` varchar(500) NOT NULL,
  `exerciseVidUrl` text DEFAULT NULL,
  `description` varchar(500) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `dateCreated` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `exercise`
--

INSERT INTO `exercise` (`ID`, `userID`, `exerciseName`, `exercisePicUrl`, `exerciseVidUrl`, `description`, `status`, `dateCreated`) VALUES
(12, 1, 'Rear Delt Fly', '6848d8aa993423.11077256.png', '6848f1a1a47293.30209135.mp4', 'An isolation exercise that targets the rear shoulders and upper back, helping improve posture and shoulder balance.', 1, '2025-06-11'),
(13, 1, 'Band Pull Apart', '6848dae289a3d3.02287722.png', '6848db1139be00.27766397.mp4', 'Good for the shoulders', 1, '2025-06-11'),
(14, 1, 'Barbell Bench Press', '6848db3b706d53.80673470.png', '6848db5f642c77.83775521.mp4', 'Good for the chest and arms', 1, '2025-06-11'),
(15, 1, 'Push Ups', '6848dbb566d123.40861992.png', '6848dbdcf2dd74.71852571.mp4', 'Good for the chest and core', 1, '2025-06-11'),
(16, 1, 'Chin Ups', '6848dc3381c222.56117117.png', '', 'Good for the biceps and the back', 1, '2025-06-11'),
(17, 1, 'Barbell Squat', '6848e58af119a1.28001839.png', '6848e5adee2932.93224406.mp4', 'Great for the legs', 1, '2025-06-11'),
(18, 1, 'Dumbell Squat', '6848e638ed3062.59826181.png', '6848e65fcd1a43.20624504.mp4', 'Great for the legs', 1, '2025-06-11'),
(19, 11, 'Push ups 2.0', '684b660e789631.70096798.jpg', '', 'asdasd', 0, '2025-06-13'),
(20, 11, 'Push ups 3.0', '684b6afcd6ff79.74583300.jpg', '684b6b4eda2228.60709713.mp4', 'asdasdas', 1, '2025-06-13');

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
(72, 12, 8),
(73, 13, 7),
(74, 14, 8),
(75, 15, 7),
(76, 16, 7),
(77, 17, 8),
(78, 18, 8),
(80, 19, 7),
(81, 20, 7);

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
(68, 12, 5),
(69, 13, 9),
(70, 14, 6),
(71, 17, 6),
(72, 18, 5),
(74, 19, 6);

-- --------------------------------------------------------

--
-- Table structure for table `exercise_muscle`
--

CREATE TABLE `exercise_muscle` (
  `ID` int(11) NOT NULL,
  `exerciseID` int(11) NOT NULL,
  `muscleID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `exercise_muscle`
--

INSERT INTO `exercise_muscle` (`ID`, `exerciseID`, `muscleID`) VALUES
(1, 12, 2),
(2, 13, 2),
(3, 14, 1),
(4, 15, 5),
(5, 15, 3),
(6, 15, 1),
(7, 15, 4),
(8, 16, 5),
(9, 16, 3),
(10, 17, 6),
(11, 18, 6),
(13, 19, 5),
(14, 20, 5),
(15, 20, 3);

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
(18, 12, NULL, 'With dumbbells in either hand, bend your knees with your feet slightly bowed out. Arch your back above your knees, and start with the weights touching in front of your chest.'),
(19, 12, NULL, 'With bent elbows, raise your arms up to shoulder level, pausing at the at the end of the motion.'),
(20, 12, NULL, 'Slowly lower your arms back to starting position.'),
(21, 13, NULL, 'Grab the band with a shoulder width grip. Point your arms straight in front of you.'),
(22, 13, NULL, 'Retract your shoulder blades and shoulder joint until the band taps your chest.'),
(23, 14, NULL, 'Lay flat on the bench with your feet on the ground. With straight arms unrack the bar.'),
(24, 14, NULL, 'Lower the bar to your mid chest'),
(25, 14, NULL, 'Raise the bar until you\'ve locked your elbows.'),
(26, 15, NULL, 'Place your hands firmly on the ground, directly under shoulders.'),
(27, 15, NULL, 'Flatten your back so your entire body is straight and slowly lower your body'),
(28, 15, NULL, 'Draw shoulder blades back and down, keeping elbows tucked close to your body'),
(29, 15, NULL, 'Exhale as you push back to the starting position.'),
(30, 16, NULL, 'Grab the bar shoulder width apart with a supinated grip (palms facing you)'),
(31, 16, NULL, 'With your body hanging and arms fully extended, pull yourself up until your chin is past the bar.'),
(32, 16, NULL, 'Slowly return to starting position. Repeat.'),
(33, 17, NULL, 'Stand with your feet shoulder-width apart. Maintain the natural arch in your back, squeezing your shoulder blades and raising your chest.'),
(34, 17, NULL, 'Grip the bar across your shoulders and support it on your upper back. Unwrack the bar by straightening your legs, and take a step back.'),
(35, 17, NULL, 'Bend your knees as you lower the weight without altering the form of your back until your hips are below your knees.'),
(36, 17, NULL, 'Raise the bar back to starting position, lift with your legs and exhale at the top.'),
(37, 18, NULL, 'Hold the weight tucked into your upper chest area, keeping your elbows in. Your feet should be slightly wider than shoulder width.'),
(38, 18, NULL, 'Sink down into the squat, keeping your elbows inside the track of your knees.'),
(39, 18, NULL, 'Push through your heels while keeping your chest up and return to starting position.'),
(40, 19, NULL, 'asdasd'),
(41, 20, NULL, 'asdasd'),
(42, 20, NULL, 'asdasd');

-- --------------------------------------------------------

--
-- Table structure for table `instructor_details`
--

CREATE TABLE `instructor_details` (
  `ID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `goal` text DEFAULT NULL,
  `personalDescription` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `instructor_details`
--

INSERT INTO `instructor_details` (`ID`, `userID`, `goal`, `personalDescription`) VALUES
(10, 10, NULL, NULL),
(11, 11, 'My health journey started in high school, through sports and education. In sports, I found myself constantly wanting to know why certain exercises were performed, and physiologically, the consequence of them. In education, my first anatomy class blew me away and sparked a never ending thirst for knowledge about the human body. I went on to get a M.Ed. in Physical Education with a focus on Exercise Physiology.', 'I want to motivate, encourage, and educate everyone to help them achieve their optimum level of quality of life.'),
(12, 12, NULL, NULL),
(13, 14, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `muscle`
--

CREATE TABLE `muscle` (
  `ID` int(11) NOT NULL,
  `muscle_name` varchar(255) NOT NULL,
  `muscle_description` text NOT NULL,
  `muscle_pic_url` varchar(500) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `muscle`
--

INSERT INTO `muscle` (`ID`, `muscle_name`, `muscle_description`, `muscle_pic_url`, `date_created`) VALUES
(1, 'Pectorals (Chest)', 'The pectoral muscles are located in the chest and are responsible for pushing movements like bench presses and push-ups.', '6848d711be68e2.81914391.jpg', '2025-06-11 09:08:33'),
(2, 'Deltoids (Shoulders)', 'These muscles cap your shoulders and help raise and rotate your arms. Exercises like shoulder presses target the deltoids.', '6848d78a283a13.32568041.jpg', '2025-06-11 09:10:34'),
(3, 'Biceps', 'Located at the front of the upper arm, the biceps help with lifting and pulling. Curls are a common bicep exercise.', '6848d7dc21b235.53624110.jpg', '2025-06-11 09:11:56'),
(4, 'Triceps', 'Found at the back of the upper arm, triceps are used in pushing motions like dips and overhead extensions.', '6848d8052200a2.37406696.jpg', '2025-06-11 09:12:37'),
(5, 'Back', 'Also known as the lats, these wide muscles on your back are key for pulling movements like pull-ups and rows.', '6848d82f6f3478.42454483.jpg', '2025-06-11 09:13:19'),
(6, 'Quads', 'Located at the front of the thigh.', '6848e50ba19f41.73298448.jpg', '2025-06-11 10:08:11'),
(7, 'Hamstrings', 'Located at the back of the thigh, hamstrings assist with bending the knee and hip extension. Deadlifts and leg curls work them.', '6848e52f0b4f29.38217958.png', '2025-06-11 10:08:47');

-- --------------------------------------------------------

--
-- Table structure for table `saved_workouts`
--

CREATE TABLE `saved_workouts` (
  `ID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `workoutID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `saved_workouts`
--

INSERT INTO `saved_workouts` (`ID`, `userID`, `workoutID`) VALUES
(8, 19, 15);

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
(1, 'asd', 'asd@gmail.com', '$2y$10$vZEBcDZaUTfjiFbK.G.WfOSnYZwx2kZOWTn4KnrDdGOAOn/MF./jq', '12345', '123', '2025-03-10', 123, 'asd', '683e4bec163f83.54206598.jpg', '2025-03-10 16:44:14', '2025-03-10', '2025-03-10', 'admin', 'active', NULL, NULL),
(3, 'ChrisCross1', 'gutierrezchristianm@gmail.com', '$2y$10$QI2IGoon4oBB80PgzBOWqOIZzplqxLLuszPY9zkenKTHWP5vv0rce', 'Christian', 'Gutierrez', '2025-03-09', 9166945580, 'male', '683e4bec163f83.54206598.jpg', '2025-03-10 18:13:51', '2025-03-10', '2025-03-10', 'user', 'archived', NULL, NULL),
(4, 'ChrisCross2', '11christianmg11@gmail.com', '$2y$10$nI67eg8aHHGkxROX9ckwsOmiAVHtsAZeXzx96ye/3/7kHkAtLko7K', 'asd', 'asd', '2025-03-11', 9166945580, 'male', '683e4bec163f83.54206598.jpg', '2025-03-10 18:17:45', '2025-03-10', '2025-03-10', 'user', 'archived', NULL, NULL),
(6, 'ChrisCross4', '11christiangutierrez11@gmail.com', '$2y$10$gx02YaQLckOsVDNGAjLG0ursHJ9ntzYJF6eTYPBhmYtVFUTeJZK.O', 'Christian', 'Gutierrez', '2025-03-10', 9166945580, 'male', '683e4bec163f83.54206598.jpg', '2025-03-10 18:21:51', '2025-03-10', '2025-03-10', 'user', 'active', NULL, NULL),
(7, 'ChrisCross5', 'xabokay145@oziere.com', '$2y$10$aoJFZfjaNYdq8VnFo6pboOhpxr/30PEczj9PiYuISGse.cwrx59lK', 'chrs', 'asdasd', '2025-03-10', 9166945580, 'male', '683e4bec163f83.54206598.jpg', '2025-03-10 19:49:20', '2025-03-10', '2025-03-10', 'user', 'active', NULL, NULL),
(8, 'ChrisCross', 'kurosucode@gmail.com', '$2y$10$vZEBcDZaUTfjiFbK.G.WfOSnYZwx2kZOWTn4KnrDdGOAOn/MF./jq', 'asjdkasjdkasdksajkdasjkd', 'asjkdjaskdaskdjaksdjkas', '2025-03-10', 9166945580, 'male', '683e4bec163f83.54206598.jpg', '2025-03-10 19:58:12', '2025-03-10', '2025-03-10', 'user', 'archived', NULL, NULL),
(10, 'asdf', 'asdsad@gmail.com', '$2y$10$vZEBcDZaUTfjiFbK.G.WfOSnYZwx2kZOWTn4KnrDdGOAOn/MF./jq', 'Cyrus', 'Gutierrezz', '0000-00-00', 9166945580, 'Male', '683e4bec163f83.54206598.jpg', '2025-03-13 15:14:34', '2025-03-13', '2025-03-13', 'instructor', 'archived', NULL, NULL),
(11, 'FLEX-ChristianGutierrez', 'asdaaaaaaaaa@gmail.com', '$2y$10$vZEBcDZaUTfjiFbK.G.WfOSnYZwx2kZOWTn4KnrDdGOAOn/MF./jq', 'Christian', 'Gutierrez', '0000-00-00', 9166945580, 'Male', '683e6f2a0bd402.75277927.jpg', '2025-03-13 17:26:53', '2025-03-13', '2025-03-13', 'instructor', 'active', NULL, NULL),
(12, 'FLEX-123123123', 'pdineen259@gmail.com', '$2y$10$lhpIuYQVVqzk8ttA4l9djelA80vWQ.x/DUqLqo.4uqNtlShMYkrRu', '123123', '1234', '2025-06-13', 9166945580, 'Male', '683e4bec163f83.54206598.jpg', '2025-03-13 20:28:20', '2025-03-13', '2025-03-13', 'instructor', 'inactive', NULL, NULL),
(14, 'FLEX-Cyrus1Gutierrez', 'asdaszvczxcvzx@gmail.com', '$2y$10$5wrmyPdu/mtXzQfxR7Dy0.xgxLhNdXLWEvFmPbD8C3RsGgsDLxEsK', 'Cyrus1', 'Gutierrez', '2025-03-14', 9166945580, 'Male', '683e4bec163f83.54206598.jpg', '2025-03-14 22:23:56', '2025-03-14', '2025-03-14', 'instructor', 'active', NULL, NULL),
(15, 'FLEX-asdasdasdasdsad', 'aaaaaaaa@email.com', '$2y$10$vDK2z4IgA6k/TobkHWACOuVHkbWc2iZkwQMwOOLXi0WiL/ereybhK', 'asdasd', 'asdasdsad', '2025-04-20', 9166945580, 'Female', '683e4bec163f83.54206598.jpg', '2025-04-20 15:33:23', '2025-04-20', '2025-04-20', 'instructor', 'active', NULL, NULL),
(16, 'FLEX-asdasdasdasd', 'hello@gmail.com', '$2y$10$3U/OjM.aTgBq8Huhqq2aD.4Vev1NNJ49q7wbTEs.gFvZwNjWPbhQ2', 'asdasd', 'asdasd', '2025-05-16', 9166945580, 'Male', '683e4bec163f83.54206598.jpg', '2025-05-16 18:16:30', '2025-05-16', '2025-05-16', 'instructor', 'active', NULL, NULL),
(17, 'FLEX-aabb', 'aaaaaa@aaaa.com', '$2y$10$igEKBtnH7e9UkysNDB6hAeDwGIMk6l7ubTTU7hZ2Gci1o4ZBQxS5K', 'aa', 'bb', '2025-06-03', 123123, 'Male', '683e4bec163f83.54206598.jpg', '2025-06-03 09:12:12', '2025-06-03', '2025-06-03', 'instructor', 'active', NULL, NULL),
(19, 'ChrisCross1234', 'ic.christian.gutierrez@cvsu.edu.ph', '$2y$10$KtGztjIVMkrls8PxyDcRjejw.jz2nCQSGjwBxqM0FODPuv3qHP2iS', 'asdas', 'dasdasd', '2025-06-12', 9166945580, 'male', 'default.jpg', '2025-06-12 19:34:27', '2025-06-12', '2025-06-12', 'user', 'active', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `workout`
--

CREATE TABLE `workout` (
  `ID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
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

INSERT INTO `workout` (`ID`, `userID`, `workoutName`, `workoutPicUrl`, `workoutDescription`, `difficulty`, `status`, `dateCreated`, `dateUpdated`) VALUES
(15, 1, 'Full Upper Body', '6848dc957a6288.17786399.jpg', 'Great for the whole upper body', 'easy', 1, '2025-06-11 09:32:05', NULL),
(16, 1, 'Full Lower Body', '684b3e40706ef4.61996216.jpg', 'Lower Body Workout', 'hard', 1, '2025-06-13 04:53:20', NULL),
(17, 11, 'new wrkout', '684b7181b7a868.99027459.jpg', 'asdasd', 'hard', 1, '2025-06-13 08:27:28', NULL);

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
(40, 15, 15, NULL, 10, '00:00:30', 1),
(41, 15, 12, NULL, 10, '00:00:30', 1),
(42, 15, 13, NULL, 10, '00:00:30', 1),
(43, 15, 15, NULL, 10, '00:00:30', 1),
(44, 16, 17, NULL, 5, '00:00:30', 1),
(45, 16, 17, NULL, 5, '00:00:30', 1),
(46, 16, 18, NULL, 5, '00:00:30', 2),
(47, 17, 19, NULL, 123, '00:00:30', 1),
(48, 17, 20, NULL, 123, '00:00:30', 2);

-- --------------------------------------------------------

--
-- Table structure for table `workout_history`
--

CREATE TABLE `workout_history` (
  `ID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `workoutID` int(11) NOT NULL,
  `finishedAt` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `workout_history`
--

INSERT INTO `workout_history` (`ID`, `userID`, `workoutID`, `finishedAt`) VALUES
(4, 19, 15, '2025-06-13 05:24:38');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `collection`
--
ALTER TABLE `collection`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `collection_workouts`
--
ALTER TABLE `collection_workouts`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `collectionID` (`collectionID`),
  ADD KEY `workoutID` (`workoutID`);

--
-- Indexes for table `equipment`
--
ALTER TABLE `equipment`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `exercise`
--
ALTER TABLE `exercise`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `userID` (`userID`);

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
-- Indexes for table `instructor_details`
--
ALTER TABLE `instructor_details`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `muscle`
--
ALTER TABLE `muscle`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `saved_workouts`
--
ALTER TABLE `saved_workouts`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `userID` (`userID`),
  ADD KEY `workoutID` (`workoutID`);

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
  ADD PRIMARY KEY (`ID`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `workout_exercises`
--
ALTER TABLE `workout_exercises`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `exerciseID` (`exerciseID`),
  ADD KEY `workoutID` (`workoutID`);

--
-- Indexes for table `workout_history`
--
ALTER TABLE `workout_history`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `userID` (`userID`),
  ADD KEY `workoutID` (`workoutID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `collection`
--
ALTER TABLE `collection`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `collection_workouts`
--
ALTER TABLE `collection_workouts`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `equipment`
--
ALTER TABLE `equipment`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `exercise`
--
ALTER TABLE `exercise`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `exercise_category`
--
ALTER TABLE `exercise_category`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `exercise_equipment`
--
ALTER TABLE `exercise_equipment`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `exercise_muscle`
--
ALTER TABLE `exercise_muscle`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `exercise_steps`
--
ALTER TABLE `exercise_steps`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `instructor_details`
--
ALTER TABLE `instructor_details`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `muscle`
--
ALTER TABLE `muscle`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `saved_workouts`
--
ALTER TABLE `saved_workouts`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `workout`
--
ALTER TABLE `workout`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `workout_exercises`
--
ALTER TABLE `workout_exercises`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `workout_history`
--
ALTER TABLE `workout_history`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `collection`
--
ALTER TABLE `collection`
  ADD CONSTRAINT `collection_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `user` (`ID`);

--
-- Constraints for table `collection_workouts`
--
ALTER TABLE `collection_workouts`
  ADD CONSTRAINT `collection_workouts_ibfk_1` FOREIGN KEY (`collectionID`) REFERENCES `collection` (`ID`),
  ADD CONSTRAINT `collection_workouts_ibfk_2` FOREIGN KEY (`workoutID`) REFERENCES `workout` (`ID`);

--
-- Constraints for table `exercise`
--
ALTER TABLE `exercise`
  ADD CONSTRAINT `exercise_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `user` (`ID`);

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
-- Constraints for table `instructor_details`
--
ALTER TABLE `instructor_details`
  ADD CONSTRAINT `instructor_details_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `user` (`ID`);

--
-- Constraints for table `saved_workouts`
--
ALTER TABLE `saved_workouts`
  ADD CONSTRAINT `saved_workouts_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `user` (`ID`),
  ADD CONSTRAINT `saved_workouts_ibfk_2` FOREIGN KEY (`workoutID`) REFERENCES `workout` (`ID`);

--
-- Constraints for table `workout`
--
ALTER TABLE `workout`
  ADD CONSTRAINT `workout_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `user` (`ID`);

--
-- Constraints for table `workout_exercises`
--
ALTER TABLE `workout_exercises`
  ADD CONSTRAINT `workout_exercises_ibfk_1` FOREIGN KEY (`exerciseID`) REFERENCES `exercise` (`ID`),
  ADD CONSTRAINT `workout_exercises_ibfk_2` FOREIGN KEY (`workoutID`) REFERENCES `workout` (`ID`);

--
-- Constraints for table `workout_history`
--
ALTER TABLE `workout_history`
  ADD CONSTRAINT `workout_history_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `user` (`ID`),
  ADD CONSTRAINT `workout_history_ibfk_2` FOREIGN KEY (`workoutID`) REFERENCES `workout` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
