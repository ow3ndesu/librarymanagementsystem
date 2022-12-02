-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 02, 2022 at 08:45 AM
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
  `copy` varchar(255) NOT NULL,
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

INSERT INTO `books` (`id`, `book_id`, `image`, `copy`, `title`, `author`, `description`, `quantity`, `status`, `remarks`, `inserted_by`, `inserted_at`) VALUES
(21, 'BOOK000TFGQ10', 'the-book.jpg', 'BOOK000INEPM1-sad;jasd;.pdf', 'The Book', 'Arter', 'Get Your Art', 78, 'ACTIVE', '-', 'ADMIN000001', '10/30/2022'),
(23, 'BOOK000SLCNJ1', 'lunar-storm.jpeg', 'BOOK000INEPM1-sad;jasd;.pdf', 'Lunar Storm', 'Stormy', 'Lunatic', 28, 'ACTIVE', '-', 'ADMIN000001', '10/30/2022'),
(24, 'BOOK000PWLGF7', 'memory-imp.jpg', 'BOOK000INEPM1-sad;jasd;.pdf', 'The Imperfections of Memory', 'Angelina', 'Memories', 6, 'ACTIVE', '-', 'ADMIN000001', '10/30/2022'),
(25, 'BOOK000X5KCHV', 'we-lost.jpg', 'BOOK000INEPM1-sad;jasd;.pdf', 'The Memory We Lost', 'Mike', 'Roberts', 5, 'ACTIVE', '-', 'ADMIN000001', '11/02/2022'),
(28, 'BOOK000NMXZ37', 'BOOK000NMXZ37-kjbsakjbdkabv.jpg', 'BOOK000INEPM1-sad;jasd;.pdf', 'YTS Guideline', 'YTS Team', 'How to do torrent?', 93, 'ACTIVE', '-', 'ADMIN000001', '11/16/2022'),
(29, 'BOOK000INEPM1', 'BOOK000INEPM1-sad;jasd;.jpg', 'BOOK000INEPM1-sad;jasd;.pdf', 'dasdasd', 'sadjasd', 'asdasddas', 3, 'INACTIVE', '-', 'ADMIN000001', '11/21/2022');

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
(3, 'BORROW1S5A21CA5', 'BOOK000PWLGF7', 'STUD0003IAVZX', 'RETURNED', '11/04/2022', '11/14/2022', 'ADMIN000001', '11/26/2022'),
(16, 'BORROW000GNXYH4', 'BOOK000PWLGF7', 'STUD0003IAVZX', 'RETURNED', '11/17/2022', '11/27/2022', 'ADMIN000001', '11/17/2022'),
(17, 'BORROW000LVTZ5X', 'BOOK000INEPM1', 'STUD0003IAVZX', 'BORROWED', '11/21/2022', '12/01/2022', 'ADMIN000001', '11/26/2022'),
(18, 'BORROW000GXMT5O', 'BOOK000NMXZ37', 'STUD0003IAVZX', 'BORROWED', '11/24/2022', '12/04/2022', 'ADMIN000001', '11/24/2022'),
(19, 'BORROW000VJPN3K', 'BOOK000NMXZ37', 'STUD000FCE17D', 'RETURNED', '11/30/2022', '12/10/2022', 'ADMIN000001', '11/30/2022'),
(20, 'BORROW0007W6FN9', 'BOOK000TFGQ10', 'STUD000R4PVCS', 'RETURNED', '12/01/2022', '12/11/2022', 'ADMIN000001', '12/01/2022');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `student_id` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `reply_to` int(11) NOT NULL DEFAULT 0,
  `isAdmin` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` varchar(255) NOT NULL,
  `updated_at` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `student_id`, `message`, `reply_to`, `isAdmin`, `created_at`, `updated_at`) VALUES
(16, 'STUD0003IAVZX', 'Hey admin', 0, 0, 'November 17, 2022 11:26pm', NULL),
(17, 'STUD0003IAVZX', 'Test', 16, 0, 'November 19, 2022 12:50am', NULL),
(18, 'STUD0003IAVZX', 'hey', 17, 0, 'November 19, 2022 12:50am', NULL),
(19, 'STUD000R4PVCS', 'test from jon', 0, 0, 'November 19, 2022 12:54am', NULL),
(20, 'STUD000R4PVCS', 'hi jon', 19, 1, 'November 19, 2022 02:01am', NULL),
(21, 'STUD000R4PVCS', 'hi', 20, 1, 'November 19, 2022 02:06am', NULL),
(22, 'STUD000R4PVCS', 'hello?', 21, 1, 'November 19, 2022 02:09am', NULL),
(23, 'STUD0003IAVZX', 'I need something man', 18, 0, 'November 19, 2022 02:35am', NULL),
(24, 'STUD000R4PVCS', 'u there?', 22, 1, 'November 19, 2022 02:38am', NULL),
(25, 'STUD0003IAVZX', 'come get me', 23, 0, 'November 19, 2022 02:39am', NULL),
(26, 'STUD0003IAVZX', 'okay', 25, 1, 'November 19, 2022 02:40am', NULL),
(27, 'STUD000R4PVCS', 'hey jon', 24, 1, 'November 21, 2022 02:09pm', NULL),
(28, 'STUD000R4PVCS', 'why?', 27, 0, 'November 21, 2022 02:09pm', NULL);

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
(10, 'BORROW1S5A21CA5', '', '11/08/2022'),
(11, 'BORROW000GNXYH4', '', '11/17/2022'),
(12, 'BORROW1S5A21CA5', '', '11/26/2022'),
(13, 'BORROW000VJPN3K', '', '11/30/2022'),
(14, 'BORROW0007W6FN9', '', '12/01/2022'),
(15, 'BORROW0007W6FN9', '', '12/01/2022'),
(16, 'BORROW0007W6FN9', '', '12/01/2022');

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
(1, 'STUD0003IAVZX', 4, 'JUAN', 'PABLO', 'DELA CRUZ', 'Pag-Asa', '0905985511', 1, '10/30/2022'),
(3, 'STUD000R4PVCS', 6, 'JON', 'STARK', 'SNOW', 'Winterfell', '09067894410', 1, '11/03/2022'),
(5, 'STUD000FCE17D', 7, 'LUIS', '', 'SAN JUAN', 'SOMEHEREST.', '09123456789', 1, '11/26/2022'),
(7, 'STUD000UCPR37', 9, 'JULIA', 'ORTIZ', 'LUIS', 'STO DOMINGO', '09123456789', 1, '11/26/2022'),
(8, 'STUD0001BJVNF', 10, 'MEME', '', 'EMAM', 'SOMEWHERE ST.', '09123456789', 1, '12/01/2022');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `receiver` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `proof` varchar(255) NOT NULL,
  `user_type` varchar(45) NOT NULL,
  `status` varchar(45) NOT NULL COMMENT 'ENABLED, DISABLED',
  `created_at` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `email`, `receiver`, `password`, `proof`, `user_type`, `status`, `created_at`) VALUES
(1, '@adminacc', 'test@gmail.com', '5b94c55fc69d8d32275862a930ebb46f', '@student4-536.jpg', 'ADMIN', 'ENABLED', '10/19/2022'),
(4, '@student2', 'zinahmarieee@gmail.com', '2c1ddc2fc774a31cbe18e8b3575d62cc', '@student4-536.jpg', 'Student', 'ENABLED', '10/30/2022'),
(6, '@student3', 'enguerra1111@gmail.com', '80ec8e02a3987d28fe68894658400e8c', '@student4-536.jpg', 'Student', 'ENABLED', '11/03/2022'),
(7, '@student1', 'test@gmail.com', 'fe96821ecf1191932f631d60e620e466', '@student4-536.jpg', 'Student', 'ENABLED', '11/24/2022'),
(9, '@student4', 'test@gmail.com', '4d53590c0a24c82a7530d1eeccae9558', '@student4-256.png', 'Student', 'ENABLED', '11/26/2022'),
(10, '@student5', 'test@gmail.com', '81778092f0802a496a5990666db10095', '@student5-1570.jpg', 'Student', 'ENABLED', '11/29/2022'),
(11, '@student7', 'test@gmail.com', '9888ae92687cfb6e65c31acc7aef0ca8', '@student7-1293.jpg', 'Student', 'DISABLED', '12/01/2022');

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
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `borrowals`
--
ALTER TABLE `borrowals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `returns`
--
ALTER TABLE `returns`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

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
