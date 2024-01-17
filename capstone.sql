-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 13, 2022 at 10:17 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `capstone2`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `acctno` varchar(255) NOT NULL,
  `acctid` int(11) NOT NULL,
  `acad_key` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `middlename` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `yearlevel` varchar(10) NOT NULL,
  `section` varchar(255) NOT NULL,
  `birthdate` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `vaxstat` varchar(255) NOT NULL DEFAULT 'Unvaccinated',
  `userlevel` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `hashed_password` varchar(255) NOT NULL,
  `otp` int(6) NOT NULL,
  `2FA` varchar(255) NOT NULL DEFAULT 'true',
  `status` varchar(255) NOT NULL DEFAULT 'Inactive',
  `profilesrc` varchar(255) NOT NULL,
  `encrypt` varchar(255) NOT NULL,
  `mailed` varchar(255) NOT NULL DEFAULT ' ',
  `qr_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `acctno`, `acctid`, `acad_key`, `firstname`, `middlename`, `lastname`, `yearlevel`, `section`, `birthdate`, `gender`, `vaxstat`, `userlevel`, `email`, `hashed_password`, `otp`, `2FA`, `status`, `profilesrc`, `encrypt`, `mailed`, `qr_id`) VALUES
(1, 'ADMIN00000001', 2022000000, '', 'Admin', 'is', 'Traitor', '', '', '2001-03-03', 'Male', 'Unvaccinated', 'Admin', 'chubsbaker3@gmail.com', '$2y$10$VB9uTI2xjXC0eRVv6rORv.1ECmyOus4XY4WAQD78D4iC1iX6DrBia', 972490, 'true', 'Active', '', '', ' ', '222f7500-7b2d-11ed-8fe2-088fc31ba835'),
(3, 'user_a98709661ae0b234730c74ac9ca620', 2019500933, '20222023F', 'Jed', 'Rellora', 'Terrazola', '4', 'C', '', '', 'Unvaccinated', 'Student', 'jed.terrazola.r@bulsu.edu.ph', '$2y$10$61xsm9KBbHf5.CoCpc15s.WS364l6Kf3.cXoNpwCUVoJwUpG5bV1e', 350301, 'true', 'Active', '', '', 'Sent', '222f8492-7b2d-11ed-8fe2-088fc31ba835'),
(4, 'user_4fd555e0025c584d60a2957081eec8', 20195001, '20222023F', 'SDAS', 'sds', 'sfs', '4', 'C', '', '', 'Unvaccinated', 'Teacher', 'admin@gmail.com', '$2y$10$9b42DkrVj3oxkw.MRYe4SulvYC4QFxfE0jVEqhU7fBJFt5.qx5L1i', 335731, 'true', 'Active', '', '', 'Sent', '222f8502-7b2d-11ed-8fe2-088fc31ba835'),
(5, 'user_0669b1429983c41dafa009438795cc', 2019500977, '20222023F', 'Hannah Mae', 'Tiongson', 'Ciriaco', '4', 'C', '3212-12-21', 'Male', 'Unvaccinated', 'Student', 'hnnhciriaco@gmail.com', '$2y$10$ytDwG9tlL0OuRodcpKoDEuLl5fe9llBgrUW.Vzj41mlnvwblVcXuC', 897042, 'true', 'Active', '../../profile/2019500977/2019500977.jpg', '', 'Sent', '222f8555-7b2d-11ed-8fe2-088fc31ba835'),
(6, 'user_90e3551ba8f4c7533577721c1afd4e', 2019544355, '20222023F', 'John Wilton', 'Guayan', 'Simene', '4', 'C', '', '', 'Unvaccinated', 'Student', 'sadass@gmail.com', '$2y$10$XpTdyUdZt1Xd2AheMt2nzeK809oJKx.Kj88obmM8VZYewtOApwOw6', 12921, 'true', 'Active', '', '', ' ', '222f859d-7b2d-11ed-8fe2-088fc31ba835'),
(7, 'user__a8b192bb2e3c2252b631ac1b597889', 20190001, '20222023F', 'Kian', '', 'Guillemer', '', '', '', '', 'Unvaccinated', 'Teacher', 'kianguillemer@gmail.com', '$2y$10$WFUXaKd4NdpB76odE0xlUevUzeSJxObK4a5DfY7D81eEzhdieC2ie', 699328, 'true', 'Inactive', '', '', ' ', '222f85e7-7b2d-11ed-8fe2-088fc31ba835'),
(8, 'user_f0c7699877bd4c2a3d46642303ebb7', 2019500900, '', 'jed', 'rellora', 'terrazola', '', '', '', '', 'Unvaccinated', 'Student', 'jedterrazola03@gmail.com', '$2y$10$QnoUBqVSvX3MtijWQPRYu.cYoWz9xBccMKkBUhW2gIncQ4806656G', 801334, 'true', 'Active', '', 'Sms0YTRjOEVaNUdBT1hPRlhjREwvdz09', 'Sent', '222f8634-7b2d-11ed-8fe2-088fc31ba835'),
(10, 'user__5a1bb346c97c06631da99583ee4ce6', 20195009, '20222023S', 'Jed', 'Rellora', 'Terrazola', '', '', '', '', 'Unvaccinated', 'Teacher', 'jed.terrazola.r@gmail.com', '$2y$10$KtUscOd7sWOrv9pnaZLsneknSrbakfGjox7vyIzMXcDUHJJw4ly/S', 18712, 'true', 'Inactive', '', '', ' ', '222f867c-7b2d-11ed-8fe2-088fc31ba835'),
(11, 'user_b671192117ca8f3096e76f0b1eb026', 2019500900, '20222023S', 'jed', 'rellora', 'terrazola', '', '', '', '', 'Unvaccinated', 'Student', 'jedterrazola03@gmail.com', '$2y$10$4jRB5AkYVdRKPksG8c1.D.gIaoPh/F9QfN3Ce0JjH5Uu6Ujmdn/ha', 422933, 'true', 'Active', '', 'czF2U1RIUzgyVXJlN1d4YnI5dklyZz09', 'Sent', '222f8769-7b2d-11ed-8fe2-088fc31ba835'),
(12, 'user_896114d253d10968eb9648bf7a855d', 20190000, '20222023S', 'k', 'k', 'k', '', '', '', '', 'Unvaccinated', 'Teacher', 'jed.terrazola.r@gmail.com', '$2y$10$QWNR6.7Pl3WGjkN1kSg1bes160FEf5fgh1PxeNUsoA4dd05wQKDX6', 490172, 'true', 'Inactive', '', '', ' ', '222f87b6-7b2d-11ed-8fe2-088fc31ba835'),
(13, 'user_bc34eb64616b6adb6ce5dc5d3869c9', 2019500000, '20222023S', 'j', 'j', 'j', '', '', '', '', 'Unvaccinated', 'Student', 'jed.terrazola.r@gmail.com', '$2y$10$YcjdGlkJxbM9Olejo.NnLOOo6sZv97uGpu.4rQUPCxOGVrYXth6FO', 756098, 'true', 'Inactive', '', '', ' ', '222f87fa-7b2d-11ed-8fe2-088fc31ba835'),
(15, 'user_23627b40af2cf520f987b031a8cd43', 2019500901, '20222023F', 'jed', 'rellora', 'terrazola', '4', 'D', '', '', 'Unvaccinated', 'Student', 'jedterrazola03@gmail.com', '$2y$10$BIxouD.3ExEnFeyInHLMGuwdHKdPhU1kuyxiesSezHXJif5zwfsNa', 518602, 'true', 'Inactive', '', 'ZHVZbjI3QjNXY3FEOWVSM1VXL2pFZz09', ' ', '222f8820-7b2d-11ed-8fe2-088fc31ba835');

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

CREATE TABLE `announcements` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` mediumtext NOT NULL,
  `subject_code` varchar(255) NOT NULL,
  `yearlevel` varchar(255) NOT NULL,
  `section` varchar(255) NOT NULL,
  `acctid` varchar(255) NOT NULL,
  `date` date DEFAULT curdate(),
  `time` time DEFAULT curtime()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `qr_id` varchar(255) NOT NULL,
  `acad_key` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `yearlevel` varchar(10) NOT NULL,
  `section` varchar(255) NOT NULL,
  `date` date DEFAULT curdate(),
  `time` time DEFAULT curtime(),
  `teacher_id` varchar(255) NOT NULL,
  `session` varchar(255) NOT NULL,
  `subcode` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `qr_id`, `acad_key`, `status`, `yearlevel`, `section`, `date`, `time`, `teacher_id`, `session`, `subcode`) VALUES
(1, '1ee4871b-77e8-11ed-a7cb-80c5f2af47ca', '20222023F', 'Absent', '4', 'C', '2022-12-12', '20:53:59', '20195001', '297227883d8493101762', 'IT 204'),
(2, '1ee86fbc-77e8-11ed-a7cb-80c5f2af47cb', '20222023F', 'Absent', '4', 'C', '2022-12-12', '20:54:00', '20195001', '297227883d8493101762', 'IT 204'),
(3, '758139c0-77f1-11ed-a7cb-80c5f2af47ca', '20222023F', 'Absent', '4', 'C', '2022-12-12', '20:54:00', '20195001', '297227883d8493101762', 'IT 204'),
(4, '1ee4871b-77e8-11ed-a7cb-80c5f2af47ca', '20222023F', 'Absent', '4', 'C', '2022-12-12', '20:54:30', '20195001', '18880f5c01eb86befeea', 'IT 205'),
(5, '1ee86fbc-77e8-11ed-a7cb-80c5f2af47cb', '20222023F', 'Absent', '4', 'C', '2022-12-12', '20:54:38', '20195001', '18880f5c01eb86befeea', 'IT 205'),
(6, '758139c0-77f1-11ed-a7cb-80c5f2af47ca', '20222023F', 'Absent', '4', 'C', '2022-12-12', '20:54:38', '20195001', '18880f5c01eb86befeea', 'IT 205'),
(7, '1ee86fbc-77e8-11ed-a7cb-80c5f2af47cb', '20222023F', 'Absent', '4', 'C', '2022-12-12', '22:54:17', '20195001', '4074da0e8108c2cbadf0', 'IT 204'),
(8, '1ee4871b-77e8-11ed-a7cb-80c5f2af47ca', '20222023F', 'Absent', '4', 'C', '2022-12-12', '22:54:21', '20195001', '4074da0e8108c2cbadf0', 'IT 204'),
(9, '758139c0-77f1-11ed-a7cb-80c5f2af47ca', '20222023F', 'Absent', '4', 'C', '2022-12-12', '22:54:21', '20195001', '4074da0e8108c2cbadf0', 'IT 204'),
(10, '1ee86fbc-77e8-11ed-a7cb-80c5f2af47cb', '20222023F', 'Absent', '4', 'C', '2022-12-12', '23:01:53', '20195001', '56e8ea02c102c8589825', 'IT 204'),
(11, '758139c0-77f1-11ed-a7cb-80c5f2af47ca', '20222023F', 'Absent', '4', 'C', '2022-12-12', '23:01:57', '20195001', '56e8ea02c102c8589825', 'IT 204'),
(12, '1ee4871b-77e8-11ed-a7cb-80c5f2af47ca', '20222023F', 'Absent', '4', 'C', '2022-12-12', '23:02:02', '20195001', '56e8ea02c102c8589825', 'IT 204');

-- --------------------------------------------------------

--
-- Table structure for table `curriculum`
--

CREATE TABLE `curriculum` (
  `id` int(11) NOT NULL,
  `semester` varchar(255) NOT NULL,
  `subname` varchar(255) NOT NULL,
  `subcode` varchar(255) NOT NULL,
  `unitlec` int(5) NOT NULL,
  `unitlab` int(5) NOT NULL,
  `yearlevel` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `curriculum`
--

INSERT INTO `curriculum` (`id`, `semester`, `subname`, `subcode`, `unitlec`, `unitlab`, `yearlevel`) VALUES
(1, 'First Semester', 'Introduction to Computing', 'IT 102', 3, 0, '1'),
(2, 'First Semester', 'Computer Programming 1', 'IT 103', 2, 1, '1'),
(3, 'First Semester', 'Hardware System and Servicing', 'IT 104', 2, 1, '1'),
(4, 'Second Semester', 'Computer Programming 2', 'IT 105', 2, 1, '1'),
(5, 'Second Semester', 'Networking 1', 'IT 106', 2, 0, '1'),
(6, 'Second Semester', 'Discrete Structures for IT', 'IT 107', 3, 0, '1'),
(7, 'First Semester', 'Data Structures and Algorithms', 'IT 201', 2, 1, '2'),
(8, 'First Semester', 'Information Management', 'IT 202', 2, 1, '2'),
(9, 'First Semester', 'Object-Oriented Programming 1', 'IT 203', 2, 1, '2'),
(10, 'First Semester', 'Integrative Programming and Technologies 1', 'IT 204', 2, 1, '2'),
(11, 'First Semester', 'Human Computer Interface', 'IT 205', 2, 1, '2'),
(12, 'Second Semester', 'Advanced Database Systems', 'IT 206', 2, 1, '2'),
(13, 'Second Semester', 'Object-Oriented Programming 2', 'IT 207', 2, 1, '2'),
(14, 'Second Semester', 'Platform Technologies', 'IT 208', 2, 1, '2'),
(15, 'Second Semester', 'Interactive Systems and Technologies', 'IT 209', 2, 1, '2'),
(16, 'Second Semester', 'Networking 2', 'IT 210', 2, 1, '2'),
(17, 'Second Semester', 'Living in the IT Era', 'MST 101d', 3, 0, '2'),
(18, 'First Semester', 'Application Development and Emergencing Technologies', 'IT 301', 2, 1, '3'),
(19, 'First Semester', 'Social and Professional Issues', 'IT 302', 2, 1, '3'),
(20, 'First Semester', 'System Analysis and Design', 'IT 303', 2, 1, '3'),
(21, 'First Semester', 'Web Systems and Technologies 1', 'IT 304', 2, 1, '3'),
(22, 'First Semester', 'Quantitative Methods', 'IT 305', 2, 1, '3'),
(23, 'First Semester', 'Elective 1', 'IT 306', 2, 1, '3'),
(24, 'First Semester', 'Elective 2', 'IT 307', 2, 1, '3'),
(25, 'Second Semester', 'Information Assurance and Security', 'IT 308', 2, 1, '3'),
(26, 'Second Semester', 'Systems Integration and Architecture 1', 'IT 309', 2, 1, '3'),
(27, 'Second Semester', 'Web Systems and Technologies 2', 'IT 310', 2, 1, '3'),
(28, 'Second Semester', 'Capstone Project and Research 1', 'CAP 301', 3, 0, '3'),
(29, 'Second Semester', 'Elective 3', 'IT 311', 2, 1, '3'),
(30, 'Second Semester', 'Elective 4', 'IT 312', 2, 1, '3'),
(31, 'First Semester', 'System Administration and Maintenance', 'IT 401', 2, 1, '4'),
(32, 'First Semester', 'System Integration and Architecture 2', 'IT 402', 2, 1, '4'),
(33, 'First Semester', 'Elective 5', 'IT 403', 2, 1, '4'),
(34, 'First Semester', 'Capstone Project and Research 2', 'IT CAP 401', 3, 0, '4'),
(35, 'Second Semester', 'Internship', 'IT 404', 6, 0, '4');

-- --------------------------------------------------------

--
-- Table structure for table `semester`
--

CREATE TABLE `semester` (
  `id` int(11) NOT NULL,
  `acad_key` varchar(255) NOT NULL,
  `acad_year` varchar(255) NOT NULL,
  `sem` varchar(255) NOT NULL,
  `timestamp` datetime DEFAULT current_timestamp(),
  `status` varchar(255) NOT NULL DEFAULT 'Inactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `semester`
--

INSERT INTO `semester` (`id`, `acad_key`, `acad_year`, `sem`, `timestamp`, `status`) VALUES
(1, '20222023F', '2022-2023', 'First Semester', '0000-00-00 00:00:00', 'Active'),
(14, '20222023S', '2022-2023', 'Second Semester', '2022-12-08 05:34:25', 'Inactive');

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `id` int(11) NOT NULL,
  `acctid` int(11) NOT NULL,
  `subcode` varchar(255) NOT NULL,
  `section` varchar(255) NOT NULL,
  `yearlevel` varchar(255) NOT NULL,
  `acad_key` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`id`, `acctid`, `subcode`, `section`, `yearlevel`, `acad_key`) VALUES
(1, 20195001, 'IT 204', 'C', '4', '20222023F'),
(2, 20195001, 'IT 205', 'C', '4', '20222023F'),
(3, 20197896, 'IT 302', 'B', '3', '20222023F'),
(4, 20197896, 'IT 304', 'C', '3', '20222023F'),
(5, 20195001, 'IT 307', 'A', '3', '20222023F'),
(6, 20190001, 'IT 402', 'A', '4', '20222023F'),
(7, 20190001, 'IT 401', 'A', '4', '20222023F'),
(8, 20190001, 'IT 403', 'A', '4', '20222023F');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `announcements`
--
ALTER TABLE `announcements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `curriculum`
--
ALTER TABLE `curriculum`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `semester`
--
ALTER TABLE `semester`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `announcements`
--
ALTER TABLE `announcements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `curriculum`
--
ALTER TABLE `curriculum`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `semester`
--
ALTER TABLE `semester`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
