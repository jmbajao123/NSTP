-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 31, 2025 at 03:04 PM
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
-- Table structure for table `area`
--

CREATE TABLE `area` (
  `area_id` int(11) NOT NULL,
  `area_name` varchar(255) NOT NULL,
  `co_id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `area`
--

INSERT INTO `area` (`area_id`, `area_name`, `co_id`, `status`, `date`) VALUES
(1, 'STII SCHOOL GYM', 1, 'Available', '2025-03-23 06:01:20'),
(2, 'SHOOL LIBRARY', 1, 'Available', '2025-03-22 20:28:07'),
(3, 'SHOOL FARM (PANGI CAMPUS)', 1, 'Available', '2025-03-22 20:28:27'),
(4, 'SCHOOL CAMPUS BY FLOOR', 1, 'Available', '2025-03-22 20:28:56');

-- --------------------------------------------------------

--
-- Table structure for table `assign_area`
--

CREATE TABLE `assign_area` (
  `aa_id` int(11) NOT NULL,
  `area_name` varchar(255) NOT NULL,
  `status` varchar(25) NOT NULL,
  `co_id` int(11) NOT NULL,
  `t_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `assign_off`
--

CREATE TABLE `assign_off` (
  `assign_off_id` int(11) NOT NULL,
  `area_id` int(11) NOT NULL,
  `o_id` int(11) NOT NULL,
  `s_id` int(11) NOT NULL,
  `co_id` int(11) NOT NULL,
  `n_id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `assign_off`
--

INSERT INTO `assign_off` (`assign_off_id`, `area_id`, `o_id`, `s_id`, `co_id`, `n_id`, `status`, `date`) VALUES
(1, 1, 1, 0, 1, 1, 'Active', '2025-03-26 08:40:49'),
(2, 3, 2, 0, 1, 1, 'Active', '2025-03-28 23:41:17'),
(3, 4, 1, 0, 1, 1, 'Active', '2025-03-28 23:55:20');

-- --------------------------------------------------------

--
-- Table structure for table `clean_hours`
--

CREATE TABLE `clean_hours` (
  `ch_id` int(11) NOT NULL,
  `s_id` int(11) NOT NULL,
  `assign_off_id` int(11) NOT NULL,
  `o_id` int(11) NOT NULL,
  `start_time` datetime NOT NULL,
  `end_time` datetime NOT NULL,
  `total_time` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `coordinator`
--

CREATE TABLE `coordinator` (
  `co_id` int(11) NOT NULL,
  `t_id` int(11) NOT NULL,
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

INSERT INTO `coordinator` (`co_id`, `t_id`, `full_name`, `n_id`, `email`, `password`, `confirm_password`, `contact_number`, `status`, `date`, `address`, `gender`, `age`, `birthdate`, `civil_status`, `profile_picture`, `valid_id`) VALUES
(1, 1, 'Mercy C. Pablo', 1, 'mercy13@gmail.com', '$2y$10$TaoFQvyHlwmQcY4fxaQnaueDChr8mR6dW.JDeTKQ8.xp1kEAdmA7q', 'qwerty123', '09550524541', 'Active', '2025-03-11 08:55:49', 'Veterans, Ipil, Zamboanga Sibugay', 'Female', '23', '2001-06-13', 'Married', 'uploads/67c174ae2916e_43936770-93ce-4146-89c3-ca4cdad8dd29.jpg', 'uploads/67c174ae29176_5c302416-b4d4-4d27-a74d-0ff23091b344.jpg'),
(2, 2, 'Rodenniel B. Alvarado', 2, 'Rodenniel13@gmail.com', '$2y$10$BzMzQhnoHfJI654aGN3eYuYLEq4mmcfV9j9uTyDil.sYkerBajGN2', 'qwerty123', '09550524541', 'Active', '2025-02-28 08:21:19', '', '', '', '', '', '', '');

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
(1, 'Bachelor of Science in Information Technology', 1, '2025-03-06 01:39:29', 'Available'),
(2, 'Bachelor of Multimedia Arts', 1, '2025-03-06 01:39:45', 'Available'),
(3, 'Bachelor of Science in Computer Science', 1, '2025-03-06 01:39:55', 'Available'),
(4, 'Associates in Computer Technology', 1, '2025-03-06 01:40:05', 'Available'),
(5, 'Bachelor of Science in Business Administration', 3, '2025-03-06 01:40:23', 'Available'),
(6, 'Bachelor of Science in Criminology', 2, '2025-03-06 01:40:36', 'Available'),
(7, 'Bachelor of Science in Social Work', 4, '2025-03-06 01:40:46', 'Available'),
(8, 'Bachelor of Science in Agribusiness', 5, '2025-03-06 01:40:57', 'Available'),
(9, 'BAELS', 7, '2025-03-06 01:41:20', 'Available'),
(10, 'Bachelor of Science in Hospitality Management', 8, '2025-03-06 01:41:33', 'Available'),
(11, 'Bachelor of Technical Vocational Teachers Education', 6, '2025-03-06 01:41:55', 'Available'),
(12, 'Bachelor of Science in Midwifery', 9, '2025-03-06 01:42:06', 'Available');

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
(1, 'College of Computer Studies', '2025-03-06 01:37:50', 'Available'),
(2, 'College of Criminology', '2025-03-06 01:37:58', 'Available'),
(3, 'College of Business Administration', '2025-03-06 01:38:10', 'Available'),
(4, 'College of Social Work', '2025-03-06 01:38:21', 'Available'),
(5, 'College of Agriculture', '2025-03-06 01:38:30', 'Available'),
(6, 'College of BTVTED', '2025-03-06 01:38:37', 'Available'),
(7, 'College of BAELS', '2025-03-06 01:38:52', 'Available'),
(8, 'College of Hospitality Management', '2025-03-06 01:39:04', 'Available'),
(9, 'College of Midwifery', '2025-03-06 01:39:11', 'Available');

-- --------------------------------------------------------

--
-- Table structure for table `end_code`
--

CREATE TABLE `end_code` (
  `ec_id` int(11) NOT NULL,
  `s_id` int(11) NOT NULL,
  `assign_off_id` int(11) NOT NULL,
  `area_id` int(11) NOT NULL,
  `et` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `rt_id` int(11) NOT NULL,
  `o_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `end_code`
--

INSERT INTO `end_code` (`ec_id`, `s_id`, `assign_off_id`, `area_id`, `et`, `status`, `date`, `rt_id`, `o_id`) VALUES
(1, 4, 2, 3, '30475', '', '2025-03-29 10:06:23', 2, 2);

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
  `d_id` int(11) NOT NULL,
  `c_id` int(11) NOT NULL,
  `section` varchar(255) NOT NULL,
  `s_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `confirm_password` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Pending',
  `co_id` int(11) NOT NULL,
  `t_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `officer`
--

INSERT INTO `officer` (`o_id`, `d_id`, `c_id`, `section`, `s_id`, `email`, `password`, `confirm_password`, `status`, `co_id`, `t_id`, `date`) VALUES
(1, 3, 5, 'A', 1, 'officerdaverodriguez@gmail.com', '$2y$10$tDMNU.SKhPcLurDRq7GbI.uKlEFUnkUebV/IlHOyvKg67E/Vz5tsS', 'qwerty123', 'Approved', 1, 1, '2025-03-23 06:32:50'),
(2, 4, 7, 'A', 8, 'officerdaisyderama@gmail.com', '$2y$10$rJNXoygMlBvFUn8BLcPbG.SsTRwvf9lS9SDP.C24E/uo2lHPZDOLi', 'qwerty123', 'Approved', 1, 1, '2025-03-29 06:35:32');

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
-- Table structure for table `render_time`
--

CREATE TABLE `render_time` (
  `rt_id` int(11) NOT NULL,
  `s_id` int(11) NOT NULL,
  `assign_off_id` int(11) NOT NULL,
  `area_id` int(11) NOT NULL,
  `st` varchar(255) NOT NULL,
  `et` varchar(255) NOT NULL,
  `tt` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Active',
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `o_id` int(11) NOT NULL,
  `t_id` int(11) NOT NULL,
  `co_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `render_time`
--

INSERT INTO `render_time` (`rt_id`, `s_id`, `assign_off_id`, `area_id`, `st`, `et`, `tt`, `status`, `date`, `o_id`, `t_id`, `co_id`) VALUES
(1, 0, 1, 1, '538061', '362877', '', 'Active', '2025-03-26 16:21:46', 1, 0, 0),
(2, 0, 2, 3, '895549', '030475', '', 'Active', '2025-03-29 06:41:54', 2, 0, 0),
(3, 0, 3, 4, '006922', '155996', '', 'Active', '2025-03-29 06:55:37', 1, 0, 0);

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
-- Table structure for table `start_code`
--

CREATE TABLE `start_code` (
  `sc_id` int(11) NOT NULL,
  `s_id` int(11) NOT NULL,
  `assign_off_id` int(11) NOT NULL,
  `area_id` int(11) NOT NULL,
  `st` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Active',
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `rt_id` int(11) NOT NULL,
  `o_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `start_code`
--

INSERT INTO `start_code` (`sc_id`, `s_id`, `assign_off_id`, `area_id`, `st`, `status`, `date`, `rt_id`, `o_id`) VALUES
(1, 4, 2, 3, '895549', 'Active', '2025-03-29 07:42:57', 2, 2),
(2, 4, 1, 1, '538061', 'Active', '2025-03-29 10:22:19', 1, 1);

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
(1, 'Dave P. Rodriguez', '3243233', 3, 5, 'A', 1, 'Enrolled', 'Veterans, Ipil, Zamboanga Sibugay', 'Male', '23', '2001-06-13', 'Single', '67c90412a35bb_137260531_766009297332853_2220491339072879295_n.jpg', '67c90412a35c4_137311691_766009260666190_6232000395291537223_n (1).jpg', 'DaveRodriguez@gmail.com', '09368958546', '2025-03-06 02:10:26'),
(2, 'Haira L. Hassan', '5354333', 3, 5, 'A', 1, 'Enrolled', '', '', '', '', '', '', '', '', '', '2025-03-06 01:44:00'),
(3, 'Ian Von C. Cenas', '324332', 3, 5, 'A', 1, 'Enrolled', '', '', '', '', '', '', '', '', '', '2025-03-06 01:45:09'),
(4, 'Mariel M. Molina', '786545', 3, 5, 'B', 1, 'Enrolled', 'Veterans, Ipil, Zamboanga Sibugay', 'Male', '23', '2001-06-13', 'Single', '67e797ac90a65_89cea2b8-4aa8-4889-973d-86c0eddc2daa.jpg', '67e797ac90a6b_89cea2b8-4aa8-4889-973d-86c0eddc2daa.jpg', 'mariealmolina@gmail.com', '09978636706', '2025-03-29 06:48:12'),
(5, 'Theodore A. Romero', '8765467', 1, 3, 'A', 1, 'Enrolled', '', '', '', '', '', '', '', '', '', '2025-03-06 08:17:07'),
(6, 'John Luc G. Herbolingo', '8765456', 2, 6, 'A', 2, 'Enrolled', '', '', '', '', '', '', '', '', '', '2025-03-07 02:43:37'),
(7, 'Chelsey B. Partosa', '2134323', 4, 7, 'A', 1, 'Enrolled', 'Purok mangga,bagongsilang mabuhay z,s,p', 'Female', '23', '2001-06-13', 'Single', '67e6b6962872c_5c34d306-0e59-46fd-be02-4e9a7f706d61.jpg', '67e6b69628957_89cea2b8-4aa8-4889-973d-86c0eddc2daa.jpg', 'cherrymae@gmail.com', '09123456778', '2025-03-28 14:47:50'),
(8, 'Daisy Mae B. Derama', '654534', 4, 7, 'A', 1, 'Enrolled', '', '', '', '', '', '', '', '', '', '2025-03-07 02:47:21'),
(9, 'Anajane Muring', '345343', 1, 1, 'A', 1, 'Enrolled', 'Veterans, Ipil, Zamboanga Sibugay', 'Female', '23', '2001-06-13', 'Single', '67e295e78f6e3_6c5e9524-0017-48e7-8ff2-f53b1fdaa971.jpg', '67e295e78f6e9_b3b9a0bb-3abb-4c9c-bba2-6fb5a1189e4c.jpg', 'anajanemuring@gmail.com', '09978636706', '2025-03-25 11:39:19');

-- --------------------------------------------------------

--
-- Table structure for table `st_render`
--

CREATE TABLE `st_render` (
  `st_r_id` int(11) NOT NULL,
  `s_id` int(11) NOT NULL,
  `rt_id` int(11) NOT NULL,
  `assign_off_id` int(11) NOT NULL,
  `area_id` int(11) NOT NULL,
  `st` varchar(255) NOT NULL,
  `et` varchar(255) NOT NULL,
  `tt` varchar(255) NOT NULL,
  `o_id` int(11) NOT NULL,
  `t_id` int(11) NOT NULL,
  `co_id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(1, 'Mercy C. Pablo', 'mercy13@gmail.com', '$2y$10$TaoFQvyHlwmQcY4fxaQnaueDChr8mR6dW.JDeTKQ8.xp1kEAdmA7q', 'qwerty123', '09550524541', 'Active', '2025-02-28 08:31:05', 1, '67c174498800c_43936770-93ce-4146-89c3-ca4cdad8dd29.jpg', '67c1744988013_5c302416-b4d4-4d27-a74d-0ff23091b344.jpg', 'Veterans, Ipil, Zamboanga Sibugay', 'Female', '2001-06-14', '23', 'Married'),
(2, 'Rodenniel B. Alvarado', 'Rodenniel13@gmail.com', '$2y$10$BzMzQhnoHfJI654aGN3eYuYLEq4mmcfV9j9uTyDil.sYkerBajGN2', 'qwerty123', '09550524541', 'Active', '2025-02-28 01:20:56', 1, '', '', '', '', '', '', ''),
(4, 'Nancy C. Magbanua', 'nancy@gmail.com', '$2y$10$sxBhPXMmsRzbeX4qYVCO.u.hdOr9JMpUcXQaV1VxNlY9O8Xpp/.gu', 'qwerty123', '09550524541', 'Active', '2025-03-11 01:46:48', 1, '67cf96088d91e_stii.jpg', '67cf96088d922_137260531_766009297332853_2220491339072879295_n.jpg', 'ipil, zamboanga Sibugay', 'Female', '1985-05-18', '39', 'Married'),
(5, 'Reybi T. Tubil', 'reybitubil@gmail.com', '$2y$10$vN/VsU6lH2yI/E.H7rTqROCXEbgGY2D3dueXwEnZc/ciKoY6Acjwm', 'qwerty123', '09550524541', 'Active', '2025-03-02 13:39:03', 1, '', '', '', '', '', '', ''),
(6, 'Josette M. Flores', 'Josette@gmail.com', '$2y$10$tRboZzvalgCcfaQwLPBCmOG/eUNr8/vbal0aqiFkPu687xBBEy1Nq', 'qwerty123', '09460855990', 'Active', '2025-03-02 13:40:09', 1, '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `t_assign`
--

CREATE TABLE `t_assign` (
  `t_assign_id` int(11) NOT NULL,
  `t_id` int(11) NOT NULL,
  `d_id` int(11) NOT NULL,
  `c_id` int(11) NOT NULL,
  `s_id` int(11) NOT NULL,
  `section` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Available',
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `co_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `t_assign`
--

INSERT INTO `t_assign` (`t_assign_id`, `t_id`, `d_id`, `c_id`, `s_id`, `section`, `status`, `date`, `co_id`) VALUES
(1, 1, 3, 5, 0, 'A', 'Available', '2025-03-06 07:22:20', 1),
(2, 1, 3, 5, 0, 'B', 'Available', '2025-03-06 07:22:20', 1),
(3, 1, 3, 7, 0, 'A', 'Available', '2025-03-06 07:22:20', 1),
(4, 1, 3, 7, 0, 'B', 'Available', '2025-03-06 07:22:20', 1),
(5, 1, 4, 5, 0, 'A', 'Available', '2025-03-06 07:22:20', 1),
(6, 1, 4, 5, 0, 'B', 'Available', '2025-03-06 07:22:20', 1),
(7, 1, 4, 7, 0, 'A', 'Available', '2025-03-06 07:22:20', 1),
(8, 1, 4, 7, 0, 'B', 'Available', '2025-03-06 07:22:20', 1),
(9, 4, 1, 1, 0, 'A', 'Available', '2025-03-06 07:23:12', 1),
(10, 4, 1, 1, 0, 'B', 'Available', '2025-03-06 07:23:12', 1),
(11, 4, 1, 2, 0, 'A', 'Available', '2025-03-06 07:23:12', 1),
(12, 4, 1, 2, 0, 'B', 'Available', '2025-03-06 07:23:12', 1),
(13, 4, 1, 3, 0, 'A', 'Available', '2025-03-06 07:23:12', 1),
(14, 4, 1, 3, 0, 'B', 'Available', '2025-03-06 07:23:12', 1),
(15, 4, 1, 4, 0, 'A', 'Available', '2025-03-06 07:23:12', 1),
(16, 4, 1, 4, 0, 'B', 'Available', '2025-03-06 07:23:12', 1),
(17, 4, 1, 11, 0, 'A', 'Available', '2025-03-06 07:23:12', 1),
(18, 4, 1, 11, 0, 'B', 'Available', '2025-03-06 07:23:12', 1),
(19, 4, 6, 1, 0, 'A', 'Available', '2025-03-06 07:23:12', 1),
(20, 4, 6, 1, 0, 'B', 'Available', '2025-03-06 07:23:12', 1),
(21, 4, 6, 2, 0, 'A', 'Available', '2025-03-06 07:23:12', 1),
(22, 4, 6, 2, 0, 'B', 'Available', '2025-03-06 07:23:12', 1),
(23, 4, 6, 3, 0, 'A', 'Available', '2025-03-06 07:23:12', 1),
(24, 4, 6, 3, 0, 'B', 'Available', '2025-03-06 07:23:12', 1),
(25, 4, 6, 4, 0, 'A', 'Available', '2025-03-06 07:23:12', 1),
(26, 4, 6, 4, 0, 'B', 'Available', '2025-03-06 07:23:12', 1),
(27, 4, 6, 11, 0, 'A', 'Available', '2025-03-06 07:23:12', 1),
(28, 4, 6, 11, 0, 'B', 'Available', '2025-03-06 07:23:12', 1);

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
(1, 0, 0, 1, 0, 'Mercy C. Pablo', 'mercy13@gmail.com', '$2y$10$TaoFQvyHlwmQcY4fxaQnaueDChr8mR6dW.JDeTKQ8.xp1kEAdmA7q', 'qwerty123', 'Active', '2025-02-28 01:07:23', 'Teacher'),
(2, 1, 0, 0, 0, 'Mercy C. Pablo', 'mercy13@gmail.com', '$2y$10$TaoFQvyHlwmQcY4fxaQnaueDChr8mR6dW.JDeTKQ8.xp1kEAdmA7q', 'qwerty123', 'Active', '2025-02-28 01:07:30', 'Coordinator'),
(3, 0, 0, 2, 0, 'Rodenniel B. Alvarado', 'Rodenniel13@gmail.com', '$2y$10$BzMzQhnoHfJI654aGN3eYuYLEq4mmcfV9j9uTyDil.sYkerBajGN2', 'qwerty123', 'Active', '2025-02-28 01:20:56', 'Teacher'),
(4, 2, 0, 0, 0, 'Rodenniel B. Alvarado', 'Rodenniel13@gmail.com', '$2y$10$BzMzQhnoHfJI654aGN3eYuYLEq4mmcfV9j9uTyDil.sYkerBajGN2', 'qwerty123', 'Active', '2025-02-28 01:21:19', 'Coordinator'),
(5, 0, 0, 4, 0, 'Nancy C. Magbanua', 'nancy@gmail.com', '$2y$10$sxBhPXMmsRzbeX4qYVCO.u.hdOr9JMpUcXQaV1VxNlY9O8Xpp/.gu', 'qwerty123', 'Active', '2025-03-02 13:38:25', 'Teacher'),
(6, 0, 0, 5, 0, 'Reybi T. Tubil', 'reybitubil@gmail.com', '$2y$10$vN/VsU6lH2yI/E.H7rTqROCXEbgGY2D3dueXwEnZc/ciKoY6Acjwm', 'qwerty123', 'Active', '2025-03-02 13:39:03', 'Teacher'),
(7, 0, 0, 6, 0, 'Josette M. Flores', 'Josette@gmail.com', '$2y$10$tRboZzvalgCcfaQwLPBCmOG/eUNr8/vbal0aqiFkPu687xBBEy1Nq', 'qwerty123', 'Active', '2025-03-02 13:40:09', 'Teacher');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`a_id`);

--
-- Indexes for table `area`
--
ALTER TABLE `area`
  ADD PRIMARY KEY (`area_id`);

--
-- Indexes for table `assign_area`
--
ALTER TABLE `assign_area`
  ADD PRIMARY KEY (`aa_id`);

--
-- Indexes for table `assign_off`
--
ALTER TABLE `assign_off`
  ADD PRIMARY KEY (`assign_off_id`);

--
-- Indexes for table `clean_hours`
--
ALTER TABLE `clean_hours`
  ADD PRIMARY KEY (`ch_id`);

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
-- Indexes for table `end_code`
--
ALTER TABLE `end_code`
  ADD PRIMARY KEY (`ec_id`);

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
-- Indexes for table `render_time`
--
ALTER TABLE `render_time`
  ADD PRIMARY KEY (`rt_id`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`s_id`);

--
-- Indexes for table `start_code`
--
ALTER TABLE `start_code`
  ADD PRIMARY KEY (`sc_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`s_id`);

--
-- Indexes for table `st_render`
--
ALTER TABLE `st_render`
  ADD PRIMARY KEY (`st_r_id`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`t_id`);

--
-- Indexes for table `t_assign`
--
ALTER TABLE `t_assign`
  ADD PRIMARY KEY (`t_assign_id`);

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
-- AUTO_INCREMENT for table `area`
--
ALTER TABLE `area`
  MODIFY `area_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `assign_area`
--
ALTER TABLE `assign_area`
  MODIFY `aa_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `assign_off`
--
ALTER TABLE `assign_off`
  MODIFY `assign_off_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `clean_hours`
--
ALTER TABLE `clean_hours`
  MODIFY `ch_id` int(11) NOT NULL AUTO_INCREMENT;

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
-- AUTO_INCREMENT for table `end_code`
--
ALTER TABLE `end_code`
  MODIFY `ec_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `nstp`
--
ALTER TABLE `nstp`
  MODIFY `n_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `officer`
--
ALTER TABLE `officer`
  MODIFY `o_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `registration`
--
ALTER TABLE `registration`
  MODIFY `r_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `render_time`
--
ALTER TABLE `render_time`
  MODIFY `rt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `s_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `start_code`
--
ALTER TABLE `start_code`
  MODIFY `sc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `s_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `st_render`
--
ALTER TABLE `st_render`
  MODIFY `st_r_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `t_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `t_assign`
--
ALTER TABLE `t_assign`
  MODIFY `t_assign_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
