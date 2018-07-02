
-- --------------------------------------------------------

--
-- Table structure for table `faculties`
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

INSERT INTO `courses` (`id`, `course`, `credit`, `department_id`, `course_code`) VALUES
(1, 'Computer Graphics', 3, 14, 'CSC200'),
(2, 'Introduction to C', 3, 3, 'EEE200'),
(3, 'Computer Architecture', 3, 3, 'EEE201'),
(4, 'Computer Organization and Architecture', 3, 14, 'CSC201'),
(5, 'Telecommunications', 2, 3, 'EEE');

-- --------------------------------------------------------
