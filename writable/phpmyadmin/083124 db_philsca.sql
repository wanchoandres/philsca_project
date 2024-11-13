-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 31, 2024 at 06:11 AM
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
-- Database: `db_philsca`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_agenda`
--

CREATE TABLE `tbl_agenda` (
  `agenda_id` int(11) NOT NULL,
  `agenda_code` varchar(50) NOT NULL,
  `agenda_name` varchar(255) NOT NULL,
  `date_created` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_department`
--

CREATE TABLE `tbl_department` (
  `department_id` int(11) NOT NULL,
  `department_code` varchar(50) NOT NULL,
  `department_name` varchar(255) NOT NULL,
  `date_created` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_department`
--

INSERT INTO `tbl_department` (`department_id`, `department_code`, `department_name`, `date_created`) VALUES
(1, 'INET', 'Insititute of Engineering and Technology', '2024-08-28'),
(2, 'ILAS', 'Insititute of Liberal Arts and Sciences', '2024-08-28'),
(3, 'ICS', 'Insititute of Computer Studies', '2024-08-28');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_program`
--

CREATE TABLE `tbl_program` (
  `program_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `department_name` varchar(255) NOT NULL,
  `program_code` varchar(50) NOT NULL,
  `program_name` varchar(255) NOT NULL,
  `date_created` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_program`
--

INSERT INTO `tbl_program` (`program_id`, `department_id`, `department_name`, `program_code`, `program_name`, `date_created`) VALUES
(1, 1, 'Insititute of Engineering and Technology', 'BSAE', 'Bachelor of Science in Aeronautical Science', '2024-08-30'),
(2, 1, 'Insititute of Engineering and Technology', 'BSAT-AF', 'Bachelor of Science in Air Transportation Major in Advance Flying', '2024-08-30'),
(3, 1, 'Insititute of Engineering and Technology', 'BSAM-T', 'Bachelor of Science in Aircraft Maintenance Technology', '2024-08-30'),
(4, 1, 'Insititute of Engineering and Technology', 'BSAE-T', 'Bachelor of Science in Aviation Electronics Technology', '2024-08-30'),
(5, 1, 'Insititute of Engineering and Technology', 'AAM-T', 'Association of Aircraft Maintenance Technology', '2024-08-30'),
(6, 1, 'Insititute of Engineering and Technology', 'AAE-T', 'Association in Aviation Electronics Technology', '2024-08-30'),
(7, 2, 'Insititute of Liberal Arts and Sciences', 'BSAC-FO', 'Bachelor of Science in Aviation Communication Major in Flight Operations', '2024-08-30'),
(8, 2, 'Insititute of Liberal Arts and Sciences', 'BSAT-TM', 'Bachelor of Science in Aviation Tourism Major in Travel Management', '2024-08-30'),
(9, 2, 'Insititute of Liberal Arts and Sciences', 'BSAL', 'Bachelor of Science in Aviation Logistics', '2024-08-30'),
(10, 2, 'Insititute of Liberal Arts and Sciences', 'BSASSM', 'Bachelor of Science in Aviation Safety and Security Management', '2024-08-30'),
(11, 3, 'Insititute of Computer Studies', 'BSAIT', 'Bachelor of Science in Aviation Information Technology', '2024-08-30'),
(12, 3, 'Insititute of Computer Studies', 'BSAIS', 'Bachelor of Science in Aviation Information Systems', '2024-08-30');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_thesis`
--

CREATE TABLE `tbl_thesis` (
  `thesis_id` int(11) NOT NULL,
  `thesis_code` varchar(12) NOT NULL,
  `thesis_title` varchar(255) NOT NULL,
  `thesis_date` varchar(50) NOT NULL,
  `agenda_id` int(11) NOT NULL,
  `agenda_code` varchar(50) NOT NULL,
  `agenda_name` varchar(255) NOT NULL,
  `members` varchar(255) NOT NULL,
  `program_id` int(11) NOT NULL,
  `program_name` varchar(255) NOT NULL,
  `department_id` int(11) NOT NULL,
  `department_name` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `date_submitted` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `user_id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `department_id` int(11) NOT NULL,
  `program_id` int(11) NOT NULL,
  `year_level` int(11) NOT NULL COMMENT '1=FirstYear, 2=SecondYear, 3=ThirdYear, 4=FouthYear',
  `profile_path` varchar(255) NOT NULL,
  `user_type` int(11) NOT NULL COMMENT '0=student, 1=Admin',
  `is_approve` int(11) NOT NULL COMMENT '0=Pending, 1=Approved, 2=Declined',
  `date_created` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`user_id`, `full_name`, `email`, `username`, `password`, `department_id`, `program_id`, `year_level`, `profile_path`, `user_type`, `is_approve`, `date_created`) VALUES
(2, 'Denmark Dorado', 'denmark@gmail.com', 'denmark', '$2y$10$iQjyu79rI6DSOPAepuQhqeb0DoMNRyHYm5iYJ7Q3nAbVDqeyrOnNK', 0, 0, 0, '', 1, 0, '2024-08-30'),
(20, 'Paul Ian', 'pauliansolanojucar@gmail.com', 'paulian', '$2y$10$TqZhN9mE.EjnlGL//P7/A.nYpAwgrQ0fmYxS.N6z5ybz2ELPJD10S', 0, 0, 0, '', 1, 0, '2024-08-31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_agenda`
--
ALTER TABLE `tbl_agenda`
  ADD PRIMARY KEY (`agenda_id`);

--
-- Indexes for table `tbl_department`
--
ALTER TABLE `tbl_department`
  ADD PRIMARY KEY (`department_id`);

--
-- Indexes for table `tbl_program`
--
ALTER TABLE `tbl_program`
  ADD PRIMARY KEY (`program_id`);

--
-- Indexes for table `tbl_thesis`
--
ALTER TABLE `tbl_thesis`
  ADD PRIMARY KEY (`thesis_id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_agenda`
--
ALTER TABLE `tbl_agenda`
  MODIFY `agenda_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_department`
--
ALTER TABLE `tbl_department`
  MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_program`
--
ALTER TABLE `tbl_program`
  MODIFY `program_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_thesis`
--
ALTER TABLE `tbl_thesis`
  MODIFY `thesis_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
