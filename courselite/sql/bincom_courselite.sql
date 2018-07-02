-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 29, 2018 at 12:15 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bincom_courselite`
--

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `course` varchar(100) NOT NULL,
  `credit` int(1) NOT NULL,
  `department_id` int(11) NOT NULL,
  `course_code` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `course`, `credit`, `department_id`, `course_code`) VALUES
(1, 'Computer Graphics', 3, 14, 'CSC200'),
(2, 'Introduction to C', 3, 3, 'EEE200'),
(3, 'Computer Architecture', 3, 3, 'EEE201'),
(4, 'Computer Organization and Architecture', 3, 14, 'CSC201'),
(5, 'Telecommunications', 2, 3, 'EEE213');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(11) NOT NULL,
  `department` varchar(100) NOT NULL,
  `faculty_id` int(11) NOT NULL,
  `department_code` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `department`, `faculty_id`, `department_code`) VALUES
(1, 'Mechanical', 1, 'MEE'),
(2, 'Production', 1, 'PRE'),
(3, 'Electrical/Electronics', 1, 'EEE'),
(4, 'Civil', 1, 'CVE'),
(5, 'English', 4, 'EED'),
(6, 'Human Kinetics', 4, 'HED'),
(7, 'English Language', 3, 'ELA'),
(8, 'International Relations', 3, 'ISD'),
(9, 'Plant Biology', 5, 'PBB'),
(10, 'Animal Biology', 5, 'AEB'),
(11, 'Physics Education', 4, 'PED'),
(12, 'Physics', 2, 'PHY'),
(13, 'Chemistry', 2, 'CHE'),
(14, 'Computer Sciences', 2, 'CSC'),
(15, 'Mathematics', 2, 'MTH'),
(16, 'Geology', 2, 'GEO');

-- --------------------------------------------------------

--
-- Table structure for table `faculties`
--

CREATE TABLE `faculties` (
  `id` int(11) NOT NULL,
  `faculty` varchar(100) NOT NULL,
  `credits_allowed` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `faculties`
--

INSERT INTO `faculties` (`id`, `faculty`, `credits_allowed`) VALUES
(1, 'Engineering', 50),
(2, 'Physical Sciences', 50),
(3, 'Arts', 50),
(4, 'Education', 50),
(5, 'Life Sciences', 50),
(6, 'Social Sciences', 50);

-- --------------------------------------------------------

--
-- Table structure for table `registered_courses`
--

CREATE TABLE `registered_courses` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `courses` text,
  `submitted` enum('1','0') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '0' COMMENT '1=Submitted, 0=NotSubmited',
  `approved` enum('1','0') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '0' COMMENT '1=Approved, 0=NotApproved'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `registered_courses`
--

INSERT INTO `registered_courses` (`id`, `student_id`, `courses`, `submitted`, `approved`) VALUES
(1, 2, '{\"3\":{\"id\":\"3\",\"dept_id\":\"3\",\"credit\":3},\"1\":{\"id\":\"1\",\"dept_id\":\"14\",\"credit\":3},\"4\":{\"id\":\"4\",\"dept_id\":\"14\",\"credit\":3}}', '0', '0'),
(2, 3, '{\"3\":{\"id\":\"3\",\"dept_id\":\"3\",\"credit\":3},\"5\":{\"id\":\"5\",\"dept_id\":\"3\",\"credit\":2},\"4\":{\"id\":\"4\",\"dept_id\":\"14\",\"credit\":3}}', '1', '0');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `firstname` varchar(100) DEFAULT NULL,
  `lastname` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `gender` enum('male','female') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'male' COMMENT 'male=Male, female=Female',
  `phone` varchar(20) DEFAULT NULL,
  `matric_num` varchar(15) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `user_id`, `firstname`, `lastname`, `email`, `gender`, `phone`, `matric_num`, `department_id`, `created`, `modified`) VALUES
(1, 1, '', '', 'someone@name.com', 'male', '', '', NULL, '2018-06-26 11:36:32', NULL),
(2, 2, 'Hall', 'Homoms', 'hallhomoms22@gmail.com', 'male', '09035306621', 'ENG1102342', 3, '2018-06-26 11:37:30', '2018-06-28 04:14:42'),
(3, 3, 'Mark', 'Integrity Oluni', 'markoluni@name.com', 'male', '09035306621', 'ENG1102546', 15, '2018-06-26 11:40:12', '2018-06-28 05:31:57');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `authKey` varchar(100) NOT NULL,
  `acessToken` varchar(255) NOT NULL,
  `role` enum('admin','student') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'student' COMMENT 'admin=Administrator, student=Student'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `authKey`, `acessToken`, `role`) VALUES
(1, 'admin', '$2y$13$2I.EqjBmzgPaa5/RyHwGO.nG9LzTpfh.0LuUh0CAmUD2Vi/vaMWEq', 'xMC-Mats_eniQoR7LLho0d5biUlHO0uD', '', 'admin'),
(2, 'hall500', '$2y$13$S6avpNwVo2yV2fEu3ayUyuhkCkMIcsXrEpgfCtZxVfKg0AOq7hNJC', '_u3aroXSCaCD87b1Z7SzEJaPtAyKvEcP', '', 'student'),
(3, 'mark', '$2y$13$93/8MDZYwYI8Z.ItK.R55uAOpz5n7SksaVvOKqMewERndqZ1.Y5W6', 'deT7s7-vHfeQCDmhaefZUb3TYdtVLAQJ', '', 'student');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `department_id` (`department_id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `faculty_id` (`faculty_id`);

--
-- Indexes for table `faculties`
--
ALTER TABLE `faculties`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `registered_courses`
--
ALTER TABLE `registered_courses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `department_id` (`department_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `faculties`
--
ALTER TABLE `faculties`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `registered_courses`
--
ALTER TABLE `registered_courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`);

--
-- Constraints for table `departments`
--
ALTER TABLE `departments`
  ADD CONSTRAINT `departments_ibfk_1` FOREIGN KEY (`faculty_id`) REFERENCES `faculties` (`id`);

--
-- Constraints for table `registered_courses`
--
ALTER TABLE `registered_courses`
  ADD CONSTRAINT `registered_courses_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`);

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `students_ibfk_2` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
