CREATE TABLE IF NOT EXISTS `faculties` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `faculty` varchar(100) NOT NULL,
  `credits_allowed` int(5) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `departments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `department` varchar(100) NOT NULL,
  `faculty_id` int(11) NOT NULL,
  `department_code` varchar(3) NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (`faculty_id`) REFERENCES faculties(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `courses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `course` varchar(100) NOT NULL,
  `credit` int(1) NOT NULL,
  `department_id` int(11) NOT NULL,
  `course_code` varchar(6) NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (`department_id`) REFERENCES departments(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `authKey` varchar(100) NOT NULL,
  `acessToken` varchar(255) NOT NULL,
  `role` enum('admin','student') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'student' COMMENT 'admin=Administrator, student=Student',
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `students` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `firstname` varchar(100) DEFAULT NULL,
  `lastname` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `gender` enum('male','female') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'male' COMMENT 'male=Male, female=Female',
  `phone` varchar(20) DEFAULT NULL,
  `matric_num` varchar(15) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (`user_id`) REFERENCES user(id),
  FOREIGN KEY (`department_id`) REFERENCES departments(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `registered_courses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `courses` text DEFAULT NULL,
  `submitted` enum('1','0') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '0' COMMENT '1=Submitted, 0=NotSubmited',
  `approved` enum('1','0') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '0' COMMENT '1=Approved, 0=NotApproved',
  PRIMARY KEY (id),
  FOREIGN KEY (`student_id`) REFERENCES students(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;