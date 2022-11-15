-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 15, 2022 at 09:26 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lmsdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `admin_id` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `middlename` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `contact_no` varchar(11) NOT NULL,
  `is_completed` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `admin_id`, `user_id`, `firstname`, `middlename`, `lastname`, `address`, `contact_no`, `is_completed`, `created_at`) VALUES
(1, 'ADMIN000001', 1, 'Jon', 'Admin', 'Doe', 'Somewhere St.', '09123456789', 1, '10/19/2022');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `book_id` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `status` varchar(45) NOT NULL COMMENT 'AVAILABLE, UNAVAILABLE',
  `remarks` varchar(45) NOT NULL DEFAULT '-',
  `inserted_by` varchar(255) NOT NULL,
  `inserted_at` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `book_id`, `image`, `title`, `author`, `description`, `quantity`, `status`, `remarks`, `inserted_by`, `inserted_at`) VALUES
(21, 'BOOK000TFGQ10', 'the-book.jpg', 'The Book', 'Arter', 'Get Your Art', 76, 'ACTIVE', '-', 'ADMIN000001', '10/30/2022'),
(23, 'BOOK000SLCNJ1', 'lunar-storm.jpeg', 'Lunar Storm', 'Stormy', 'Lunatic', 28, 'ACTIVE', '-', 'ADMIN000001', '10/30/2022'),
(24, 'BOOK000PWLGF7', 'memory-imp.jpg', 'The Imperfections of Memory', 'Angelina', 'Memories', 5, 'ACTIVE', '-', 'ADMIN000001', '10/30/2022'),
(25, 'BOOK000X5KCHV', 'we-lost.jpg', 'TheMemoryWeLost', 'Mike', 'Roberts', 5, 'ACTIVE', '-', 'ADMIN000001', '11/02/2022'),
(28, 'BOOK000NMXZ37', 'BOOK000NMXZ37-kjbsakjbdkabv.jpg', 'YTS Guideline', 'YTS Team', 'How to do torrent?', 94, 'ACTIVE', '-', 'ADMIN000001', '11/16/2022');

-- --------------------------------------------------------

--
-- Table structure for table `borrowals`
--

CREATE TABLE `borrowals` (
  `id` int(11) NOT NULL,
  `borrow_id` varchar(255) NOT NULL,
  `book_id` varchar(255) NOT NULL,
  `student_id` varchar(255) NOT NULL,
  `status` varchar(45) NOT NULL DEFAULT 'PENDING' COMMENT 'PENDING, CANCELED, DISAPPROVED, BORROWED, RETURNING, RETURNED	',
  `filed` varchar(45) NOT NULL,
  `due` varchar(45) NOT NULL,
  `modified_by` varchar(255) NOT NULL DEFAULT '-',
  `modified_at` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `borrowals`
--

INSERT INTO `borrowals` (`id`, `borrow_id`, `book_id`, `student_id`, `status`, `filed`, `due`, `modified_by`, `modified_at`) VALUES
(3, 'BORROW1S5A21CA5', 'BOOK000PWLGF7', 'STUD0003IAVZX', 'RETURNED', '11/04/2022', '11/14/2022', 'ADMIN000001', '11/08/2022');

-- --------------------------------------------------------

--
-- Table structure for table `returns`
--

CREATE TABLE `returns` (
  `id` int(11) NOT NULL,
  `borrow_id` varchar(45) NOT NULL,
  `remarks` varchar(45) NOT NULL,
  `returned_at` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `returns`
--

INSERT INTO `returns` (`id`, `borrow_id`, `remarks`, `returned_at`) VALUES
(10, 'BORROW1S5A21CA5', '', '11/08/2022');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `student_id` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `middlename` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `contact_no` varchar(11) NOT NULL,
  `is_completed` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `student_id`, `user_id`, `firstname`, `middlename`, `lastname`, `address`, `contact_no`, `is_completed`, `created_at`) VALUES
(1, 'STUD0003IAVZX', 4, 'Juan', 'Pablo', 'Dela Cruz', 'Pag-Asa', '0905985511', 1, '10/30/2022'),
(3, 'STUD000R4PVCS', 6, '', '', '', '', '', 0, '11/03/2022');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` varchar(45) NOT NULL,
  `status` varchar(45) NOT NULL COMMENT 'ENABLED, DISABLED',
  `created_at` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `email`, `password`, `user_type`, `status`, `created_at`) VALUES
(1, 'admin@email.com', '59235f35e4763abb0b547bd093562f6e', 'ADMIN', 'ENABLED', '10/19/2022'),
(4, 'user@email.com', 'b58c6f14d292556214bd64909bcdb118', 'Student', 'ENABLED', '10/30/2022'),
(6, 'try@email.com', '035dee598ebb867ba96273606287f009', 'Student', 'ENABLED', '11/03/2022');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idx_studentid` (`admin_id`),
  ADD KEY `admins_ibfk_1` (`user_id`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idx_bookid` (`book_id`),
  ADD KEY `books_ibfk_1` (`inserted_by`);

--
-- Indexes for table `borrowals`
--
ALTER TABLE `borrowals`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idx_borrowid` (`borrow_id`),
  ADD KEY `borrowals_ibfk_1` (`book_id`),
  ADD KEY `borrowals_ibfk_2` (`modified_by`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `returns`
--
ALTER TABLE `returns`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idx_studentid` (`student_id`),
  ADD KEY `students_ibfk_1` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `idx_email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `borrowals`
--
ALTER TABLE `borrowals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `returns`
--
ALTER TABLE `returns`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admins`
--
ALTER TABLE `admins`
  ADD CONSTRAINT `admins_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_ibfk_1` FOREIGN KEY (`inserted_by`) REFERENCES `admins` (`admin_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `borrowals`
--
ALTER TABLE `borrowals`
  ADD CONSTRAINT `borrowals_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `borrowals_ibfk_3` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
