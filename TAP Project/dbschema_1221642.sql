-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 16 يناير 2025 الساعة 12:02
-- إصدار الخادم: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbschema_1221642`
--

-- --------------------------------------------------------

--
-- بنية الجدول `projects`
--

CREATE TABLE `projects` (
  `project_id` varchar(20) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `budget` decimal(10,2) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `team_leader_id` int(11) DEFAULT NULL,
  `file1_path` varchar(255) DEFAULT NULL,
  `file1_title` varchar(255) DEFAULT NULL,
  `file2_path` varchar(255) DEFAULT NULL,
  `file2_title` varchar(255) DEFAULT NULL,
  `file3_path` varchar(255) DEFAULT NULL,
  `file3_title` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `projects`
--

INSERT INTO `projects` (`project_id`, `title`, `description`, `customer_name`, `budget`, `start_date`, `end_date`, `team_leader_id`, `file1_path`, `file1_title`, `file2_path`, `file2_title`, `file3_path`, `file3_title`) VALUES
('ABCD-12340', 'LKHJ', 'jgkty', 'BJJKJKU', 12.00, '2025-01-01', '2025-01-18', NULL, 'fileArchive/icon.png', 'icon', '', '', '', ''),
('ABCD-12345', 'Project Alpha', 'Description Alpha', 'Customer Alpha', 1000.00, '2025-01-07', '2025-12-31', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('EFGH-67890', 'Project Beta', 'Description Beta', 'Customer Beta', 1500.00, '2025-02-01', '2025-12-31', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('IJKL-54321', 'Project Gamma', 'Description Gamma', 'Customer Gamma', 2000.00, '2025-03-01', '2025-12-31', 1000000002, NULL, NULL, NULL, NULL, NULL, NULL),
('MNOP-98765', 'Project Delta', 'Description Delta', 'Customer Delta', 2500.00, '2025-04-01', '2025-12-31', 1000000002, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- بنية الجدول `tasks`
--

CREATE TABLE `tasks` (
  `task_id` int(11) NOT NULL,
  `task_name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `project_id` varchar(20) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `effort` decimal(5,2) NOT NULL,
  `status` enum('Pending','In Progress','Completed') DEFAULT 'Pending',
  `priority` enum('Low','Medium','High') DEFAULT 'Medium',
  `progress` int(11) DEFAULT 0,
  `project_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `tasks`
--

INSERT INTO `tasks` (`task_id`, `task_name`, `description`, `project_id`, `start_date`, `end_date`, `effort`, `status`, `priority`, `progress`, `project_name`) VALUES
(7, 'test task', 'this is a test', 'MNOP-98765', '2025-06-19', '2025-11-27', 0.30, 'In Progress', 'Low', 3, 'Project Delta'),
(8, 'task2 ', 'this is task 2', 'MNOP-98765', '2025-07-01', '2025-11-20', 0.30, 'Pending', 'High', 0, 'Project Delta'),
(14, 'task3', 'ksjdv', 'MNOP-98765', '2025-07-24', '2025-12-25', 0.10, 'Pending', 'High', 0, 'Project Delta');

-- --------------------------------------------------------

--
-- بنية الجدول `tasks_team_members`
--

CREATE TABLE `tasks_team_members` (
  `task_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `role` varchar(100) DEFAULT NULL,
  `contribution` decimal(5,2) DEFAULT NULL,
  `tasks_team_members_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `tasks_team_members`
--

INSERT INTO `tasks_team_members` (`task_id`, `member_id`, `role`, `contribution`, `tasks_team_members_id`) VALUES
(7, 1000000005, 'Support', 9.00, 6);

-- --------------------------------------------------------

--
-- بنية الجدول `users`
--

CREATE TABLE `users` (
  `id_number` varchar(20) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `flat_house_no` varchar(50) NOT NULL,
  `street` varchar(255) NOT NULL,
  `city` varchar(100) NOT NULL,
  `country` varchar(100) NOT NULL,
  `date_of_birth` date NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `role` enum('Manager','Project Leader','Team Member') NOT NULL,
  `qualification` varchar(255) NOT NULL,
  `skills` text NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `users`
--

INSERT INTO `users` (`id_number`, `user_id`, `name`, `flat_house_no`, `street`, `city`, `country`, `date_of_birth`, `email`, `phone`, `role`, `qualification`, `skills`, `username`, `password`) VALUES
('123', 1000000034, 'Amro Deek', '12', 'BZU', 'BZU', 'Palestinian Authority', '2025-01-07', 'amrobasheer242@gmail.com', '0569334215', 'Manager', 'java and web developer', 'skill1', 'amro', '00000000a'),
('1234', 1000000054, 'Amro Deek', '12', 'BZU', 'BZU', 'Palestinian Authority', '2025-01-07', 'amrobasheer@gmail.com', '0569334215', 'Project Leader', 'java and web developer', 'skill1', 'amrodeek', '123456789a'),
('PL987654321', 1000000002, 'Sara Al Saud', '34B', 'Khaleej Street', 'Dhahran', 'Saudi Arabia', '1985-09-20', 'sara.alsaud@example.com', '+966-555-987654', 'Project Leader', 'BSc in Computer Science', 'Project Management, Agile Methodologies, Software Development', 'saraalsaud_pl', 'password2'),
('TM111213141', 1000000003, 'Ali Ahmed', '56C', 'King Abdullah Road', 'Jeddah', 'Saudi Arabia', '1992-02-28', 'ali.ahmed@example.com', '+966-555-111213', 'Team Member', 'BSc in Information Technology', 'Web Development, Database Management, Networking', 'aliahmed_tm', 'password3'),
('TM543216789', 1000000005, 'Omar Hassan', '90E', 'Eastern Ring Road', 'Dammam', 'Saudi Arabia', '1990-11-22', 'omar.hassan@example.com', '+966-555-543216', 'Team Member', 'BSc in Software Engineering', 'Software Development, Debugging, SQL', 'omarhassan_tm', 'password5'),
('TM987654123', 1000000004, 'Layla Ahmed', '78D', 'Prince Sultan Street', 'Khobar', 'Saudi Arabia', '1995-05-15', 'layla.ahmed@example.com', '+966-555-987654', 'Team Member', 'MSc in Data Science', 'Data Analysis, Machine Learning, Python', 'laylaahmed_tm', 'password4');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD UNIQUE KEY `project_id` (`project_id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`task_id`),
  ADD KEY `project_id` (`project_id`);

--
-- Indexes for table `tasks_team_members`
--
ALTER TABLE `tasks_team_members`
  ADD PRIMARY KEY (`tasks_team_members_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_number`),
  ADD UNIQUE KEY `user_id` (`user_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `task_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tasks_team_members`
--
ALTER TABLE `tasks_team_members`
  MODIFY `tasks_team_members_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1000000055;

--
-- قيود الجداول المُلقاة.
--

--
-- قيود الجداول `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`project_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
