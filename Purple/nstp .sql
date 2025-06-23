-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 07, 2025 at 06:01 AM
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
  `contact_number` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `coordinator`
--

INSERT INTO `coordinator` (`co_id`, `full_name`, `n_id`, `email`, `password`, `contact_number`, `status`, `date`) VALUES
(1, 'Mercy Pablo', 2, 'mercy13@gmail.com', 'qwerty123', '09460855990', 'Active', '2025-02-06 20:44:02'),
(2, 'Rodenniel B. Alvarado', 1, 'Rodenniel13@gmail.com', 'qwerty123', '09558673821', 'Active', '2025-02-06 20:47:29');

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
(1, 'BS Information Technology', 1, '2025-02-05 08:14:13', 'Available'),
(2, 'BS Computer Science', 1, '2025-02-05 08:36:07', 'Available'),
(3, 'Bachelor of Multimedia Arts', 1, '2025-02-07 01:48:18', 'Available'),
(4, 'Associates in Computer Technology', 1, '2025-02-07 01:48:45', 'Available'),
(5, 'BS Criminology', 4, '2025-02-07 01:49:27', 'Available'),
(6, 'BS Midwifery', 5, '2025-02-07 01:49:49', 'Available'),
(7, 'BS Social Work', 6, '2025-02-07 01:50:14', 'Available'),
(8, 'Bachelor of Art in English Languages Studies', 7, '2025-02-07 01:50:57', 'Available'),
(9, 'BS Agriculture', 2, '2025-02-07 01:51:26', 'Available'),
(10, 'BS Agribusiness', 2, '2025-02-07 01:51:43', 'Available'),
(11, 'Bachelor of Technical Vocational Teachers Education', 9, '2025-02-07 01:52:15', 'Available'),
(12, 'BS Business Administration', 3, '2025-02-07 01:52:40', 'Available');

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
(1, 'College of Computer Studies', '2025-02-05 08:10:12', 'Available'),
(2, 'College of Agriculture', '2025-02-05 08:34:43', 'Available'),
(3, 'College of Business Administration', '2025-02-05 08:11:57', 'Available'),
(4, 'College of Criminology', '2025-02-06 20:51:58', 'Available'),
(5, 'College of Midwifery', '2025-02-06 20:52:41', 'Available'),
(6, 'College of Social Work', '2025-02-06 20:53:11', 'Available'),
(7, 'College of Arts in English', '2025-02-06 20:54:20', 'Available'),
(8, 'College of Hospitality', '2025-02-06 20:54:43', 'Available'),
(9, 'College of Education', '2025-02-06 20:55:32', 'Available');

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
(1, 'Reserve Officers\' Training Corps (ROTC)', 'Active', '2025-02-06 19:50:26'),
(2, 'Civic Welfare Training Service (CWTS)', 'Active', '2025-02-06 19:53:53'),
(3, 'Literacy Training Service (LTS)', 'Inactive', '2025-02-06 19:54:04');

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
  `student_full_name` varchar(255) NOT NULL,
  `student_id` varchar(255) NOT NULL,
  `d_id` int(11) NOT NULL,
  `c_id` int(11) NOT NULL,
  `section` varchar(255) NOT NULL,
  `nstp` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Enrolled'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`s_id`, `student_full_name`, `student_id`, `d_id`, `c_id`, `section`, `nstp`, `status`) VALUES
(1, 'Anajane Muring', '1234567789097', 1, 1, 'A', 'CWTS', 'Enrolled'),
(2, 'Gabriel Balungcas', '232401', 1, 1, 'A', 'CWTS', 'Enrolled'),
(3, 'Gabriel Balungcas', '2324011630', 1, 1, 'A', 'CWTS', 'Enrolled'),
(4, 'Anajane Muring', '2324010238', 1, 1, 'A', 'CWTS', 'Enrolled'),
(5, 'Marilyn Morales', '2324010207', 1, 1, 'A', 'CWTS', 'Enrolled'),
(6, 'marvhen fernandez', '2324011043', 1, 1, 'A', 'CWTS', 'Enrolled'),
(7, 'cenon tura', '2324010207', 1, 1, 'A', 'CWTS', 'Enrolled'),
(8, 'laiza rosos', '2324010238', 1, 1, 'A', 'CWTS', 'Enrolled');

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
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `d_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `nstp`
--
ALTER TABLE `nstp`
  MODIFY `n_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
  MODIFY `s_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
