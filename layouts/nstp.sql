-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 22, 2025 at 05:13 AM
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
-- Database: `nstp`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `a_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`a_id`, `username`, `password`, `date`) VALUES
(1, 'admin', 'admin123', '2025-02-02 18:56:42');

-- --------------------------------------------------------

--
-- Table structure for table `coordinator`
--

CREATE TABLE `coordinator` (
  `co_id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `n_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `confirm_password` varchar(255) NOT NULL,
  `contact_number` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `address` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `age` varchar(255) NOT NULL,
  `birthdate` varchar(255) NOT NULL,
  `civil_status` varchar(255) NOT NULL,
  `profile_picture` varchar(255) NOT NULL,
  `valid_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `coordinator`
--

INSERT INTO `coordinator` (`co_id`, `full_name`, `n_id`, `email`, `password`, `confirm_password`, `contact_number`, `status`, `date`, `address`, `gender`, `age`, `birthdate`, `civil_status`, `profile_picture`, `valid_id`) VALUES
(1, 'MERCY PABLO', 1, 'mercy13@gmail.com', '$2y$10$z.b9wo69CQ5gyY9XhmooweaBY4Kbi46yb79JEzL/vv49qjhgS1Uau', 'qwerty123', '09947362991', 'Active', '2025-02-18 06:42:25', 'Ipil', 'Female', '38', '1986-12-06', 'Married', '67b42bd1bc198_WIN_20250204_14_36_30_Pro.jpg', '67b42bd1bc19b_WIN_20250204_14_36_30_Pro.jpg'),
(2, 'Rodenniel B. Alvarado', 2, 'rodenbalvarado@gmail.com', '$2y$10$pRpfGL66BPdHgVqiUzsSxuwiC/XI1XwNmSpZ/26ZZwQH5lwDVPiIC', 'qwerty123', '09947362991', 'Active', '2025-02-17 23:41:28', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `c_id` int(11) NOT NULL,
  `course_name` varchar(255) NOT NULL,
  `d_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(255) NOT NULL DEFAULT 'Available'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`c_id`, `course_name`, `d_id`, `date`, `status`) VALUES
(1, 'BS in Business Administration', 1, '2025-02-13 08:01:56', 'Available'),
(2, 'BS Information Technology', 2, '2025-02-13 05:59:18', 'Available'),
(3, 'BS Computer Science', 2, '2025-02-13 05:59:50', 'Available');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `d_id` int(11) NOT NULL,
  `department_name` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(255) NOT NULL DEFAULT 'Available'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`d_id`, `department_name`, `date`, `status`) VALUES
(1, 'College of Business Administration', '2025-02-18 09:23:55', 'Available'),
(2, 'College of Computer Studies', '2025-02-13 05:17:41', 'Available'),
(3, 'College of Hospitality', '2025-02-13 05:17:53', 'Available');

-- --------------------------------------------------------

--
-- Table structure for table `nstp`
--

CREATE TABLE `nstp` (
  `n_id` int(11) NOT NULL,
  `nstp_name` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nstp`
--

INSERT INTO `nstp` (`n_id`, `nstp_name`, `status`, `date`) VALUES
(1, 'Civic Welfare Training Service', 'Active', '2025-02-13 06:34:20'),
(2, 'Reserve Officer\'s Training Corps', 'Active', '2025-02-12 23:02:46'),
(3, 'Literary Training Service', 'Inactive', '2025-02-12 23:02:53');

-- --------------------------------------------------------

--
-- Table structure for table `officer`
--

CREATE TABLE `officer` (
  `o_id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `confirm_password` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Active',
  `co_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `r_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`r_id`, `username`, `password`, `date`) VALUES
(1, 'Registrat', 'Registrat123', '2025-02-05 06:13:43');

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `s_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `time` time NOT NULL,
  `location` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `s_id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `student_id` varchar(255) NOT NULL,
  `d_id` int(11) NOT NULL,
  `c_id` int(11) NOT NULL,
  `section` varchar(255) NOT NULL,
  `n_id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Enrolled',
  `address` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `age` varchar(255) NOT NULL,
  `birthdate` varchar(255) NOT NULL,
  `civil_status` varchar(255) NOT NULL,
  `profile_picture` varchar(255) NOT NULL,
  `valid_id` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact_number` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`s_id`, `full_name`, `student_id`, `d_id`, `c_id`, `section`, `n_id`, `status`, `address`, `gender`, `age`, `birthdate`, `civil_status`, `profile_picture`, `valid_id`, `email`, `contact_number`, `date`) VALUES
(1, 'Tura, Cenon B.', '232401-1882', 2, 2, 'A', 1, 'Enrolled', 'Ipil', 'Male', '23', '2001-12-06', 'Single', '67b42c6800cb7_WIN_20250204_14_36_30_Pro.jpg', '67b42c6800cc0_WIN_20250204_14_36_30_Pro.jpg', 'gabrielbalungcas51@gmail.com', '09947362991', '2025-02-18 06:44:56'),
(2, 'Balawag, Jaime A. Jr.', '232101-1881', 2, 2, 'A', 1, 'Enrolled', '', '', '', '', '', '', '', '', '', '2025-02-18 07:03:19'),
(3, 'Rosos, Laiza T.', '232301-1883', 2, 2, 'A', 1, 'Enrolled', '', '', '', '', '', '', '', '', '', '2025-02-18 07:04:01'),
(4, 'Gulpane, Shyla Mae C.', '232331-1833', 2, 2, 'A', 1, 'Enrolled', '', '', '', '', '', '', '', '', '', '2025-02-18 07:04:50');

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `t_id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `confirm_password` varchar(255) NOT NULL,
  `contact_number` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `r_id` int(11) NOT NULL,
  `profile_picture` varchar(255) NOT NULL,
  `valid_id` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `birthdate` varchar(255) NOT NULL,
  `age` varchar(255) NOT NULL,
  `civil_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`t_id`, `full_name`, `email`, `password`, `confirm_password`, `contact_number`, `status`, `date`, `r_id`, `profile_picture`, `valid_id`, `address`, `gender`, `birthdate`, `age`, `civil_status`) VALUES
(1, 'MERCY PABLO', 'mercy13@gmail.com', '$2y$10$Yj1OBNk9vWg1TLl0mTMzeuZ0FP0NxI0RU8yX2J2ExeERRJSZ88LNq', 'qwerty123', '09947362991', 'Active', '2025-02-17 23:54:50', 1, '', '', '', '', '', '', ''),
(2, 'Rodenniel B. Alvarado', 'rodenbalvarado@gmail.com', '$2y$10$PUtcEJSmr41tTOO1eHTB0OhHJQjNPd42Vf10kMtSy2Jjb7sr76n4a', 'qwerty123', '09947362991', 'Active', '2025-02-17 23:55:29', 1, '', '', '', '', '', '', ''),
(3, 'Reybi Tubil', 'reybitubil@gmail.com', '$2y$10$V6TNgpk2B0v1V62WYr0YkOY5ToBtOMRdh3q6lyZANg.0vCd4x4VoW', 'qwerty123', '09947362991', 'Active', '2025-02-17 23:56:24', 1, '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `u_id` int(11) NOT NULL,
  `co_id` int(11) NOT NULL,
  `s_id` int(11) NOT NULL,
  `t_id` int(11) NOT NULL,
  `o_id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `confirm_password` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`u_id`, `co_id`, `s_id`, `t_id`, `o_id`, `full_name`, `email`, `password`, `confirm_password`, `status`, `date`, `user_type`) VALUES
(1, 1, 0, 0, 0, 'MERCY PABLO', 'mercy13@gmail.com', '$2y$10$z.b9wo69CQ5gyY9XhmooweaBY4Kbi46yb79JEzL/vv49qjhgS1Uau', 'qwerty123', 'Active', '2025-02-17 23:41:09', 'Coordinator'),
(2, 2, 0, 0, 0, 'Rodenniel B. Alvarado', 'rodenbalvarado@gmail.com', '$2y$10$pRpfGL66BPdHgVqiUzsSxuwiC/XI1XwNmSpZ/26ZZwQH5lwDVPiIC', 'qwerty123', 'Active', '2025-02-17 23:41:28', 'Coordinator'),
(3, 0, 0, 1, 0, 'MERCY PABLO', 'mercy13@gmail.com', '$2y$10$Yj1OBNk9vWg1TLl0mTMzeuZ0FP0NxI0RU8yX2J2ExeERRJSZ88LNq', 'qwerty123', 'Active', '2025-02-17 23:54:50', 'Teacher'),
(4, 0, 0, 2, 0, 'Rodenniel B. Alvarado', 'rodenbalvarado@gmail.com', '$2y$10$PUtcEJSmr41tTOO1eHTB0OhHJQjNPd42Vf10kMtSy2Jjb7sr76n4a', 'qwerty123', 'Active', '2025-02-17 23:55:29', 'Teacher'),
(5, 0, 0, 3, 0, 'Reybi Tubil', 'reybitubil@gmail.com', '$2y$10$V6TNgpk2B0v1V62WYr0YkOY5ToBtOMRdh3q6lyZANg.0vCd4x4VoW', 'qwerty123', 'Active', '2025-02-17 23:56:24', 'Teacher');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`a_id`);

--
-- Indexes for table `coordinator`
--
ALTER TABLE `coordinator`
  ADD PRIMARY KEY (`co_id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`d_id`);

--
-- Indexes for table `nstp`
--
ALTER TABLE `nstp`
  ADD PRIMARY KEY (`n_id`);

--
-- Indexes for table `officer`
--
ALTER TABLE `officer`
  ADD PRIMARY KEY (`o_id`);

--
-- Indexes for table `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`r_id`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`s_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`s_id`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`t_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`u_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `a_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `coordinator`
--
ALTER TABLE `coordinator`
  MODIFY `co_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `d_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `nstp`
--
ALTER TABLE `nstp`
  MODIFY `n_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `officer`
--
ALTER TABLE `officer`
  MODIFY `o_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `registration`
--
ALTER TABLE `registration`
  MODIFY `r_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `s_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `s_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `t_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
