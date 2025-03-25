-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 25, 2025 at 02:48 PM
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
-- Database: `library`
--

-- --------------------------------------------------------

--
-- Table structure for table `borrowed_books`
--

CREATE TABLE `borrowed_books` (
  `borrow_id` int(11) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `book_name` varchar(255) DEFAULT NULL,
  `publisher` varchar(100) DEFAULT NULL,
  `due_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `borrowed_books`
--

INSERT INTO `borrowed_books` (`borrow_id`, `username`, `book_name`, `publisher`, `due_date`) VALUES
(1, 'deepa_iyer', 'Computer Networks', 'MIT Press', '2025-03-19'),
(3, 'vikram_singh', 'Thermodynamics: An Engineering Approach', 'Springer', '2025-03-25'),
(4, 'rahul_verma', 'Introduction to Algorithms', 'Prentice Hall', '2025-03-17'),
(5, 'rajeshwari_n', 'Artificial Intelligence: A Modern Approach', 'MIT Press', '2025-03-28'),
(6, 'meera_das', 'Artificial Intelligence: A Modern Approach', 'Wiley', '2025-03-24'),
(7, 'sanjay_rao', 'Database System Concepts', 'Springer', '2025-03-27'),
(8, 'rahul_verma', 'Computer Architecture', 'Morgan Kaufmann', '2025-03-25'),
(9, 'rahul_verma', 'Introduction to Algorithms', 'MIT Press', '2025-03-20'),
(10, 'shivakumar_r', 'Digital Logic Design', 'Oxford University Press', '2025-03-18'),
(11, 'manikanta_l', 'Thermodynamics: An Engineering Approach', 'Springer', '2025-03-29'),
(12, 'arjun_kumar', 'Engineering Mechanics', 'MIT Press', '2025-03-18'),
(13, 'meera_das', 'Engineering Mechanics', 'Springer', '2025-03-22'),
(14, 'vikram_singh', 'Database System Concepts', 'McGraw-Hill', '2025-03-20'),
(15, 'kavya_n', 'Computer Architecture', 'McGraw-Hill', '2025-03-16'),
(16, 'lakshmi_priya', 'Introduction to Algorithms', 'MIT Press', '2025-03-17'),
(17, 'shivakumar_r', 'Operating System Concepts', 'Cambridge University Press', '2025-03-31'),
(18, 'ramesh_kumar', 'Engineering Mechanics', 'Morgan Kaufmann', '2025-03-24'),
(19, 'vikram_singh', 'Computer Architecture', 'Cambridge University Press', '2025-03-22'),
(20, 'rajeshwari_n', 'Digital Logic Design', 'Oxford University Press', '2025-03-27'),
(21, 'rahul_verma', 'Introduction to Algorithms', 'Cambridge University Press', '2025-03-17'),
(22, 'amit_patel', 'Engineering Mechanics', 'Morgan Kaufmann', '2025-03-30'),
(23, 'rajeshwari_n', 'Computer Networks', 'Oxford University Press', '2025-03-19'),
(24, 'arjun_kumar', 'Operating System Concepts', 'Elsevier', '2025-03-29'),
(25, 'kavya_n', 'Engineering Mechanics', 'Wiley', '2025-03-26'),
(26, 'rajeshwari_n', 'Computer Networks', 'Prentice Hall', '2025-03-19'),
(27, 'neha_sharma', 'Digital Logic Design', 'Morgan Kaufmann', '2025-03-25'),
(28, 'lakshmi_priya', 'Software Engineering', 'Morgan Kaufmann', '2025-03-16'),
(29, 'manikanta_l', 'Operating System Concepts', 'Oxford University Press', '2025-03-27'),
(31, 'sanjay_rao', 'Software Engineering', 'Prentice Hall', '2025-03-18'),
(32, 'neha_sharma', 'Computer Networks', 'Morgan Kaufmann', '2025-03-24'),
(33, 'manikanta_l', 'Engineering Mechanics', 'Prentice Hall', '2025-03-27'),
(34, 'deepa_iyer', 'Computer Networks', 'Springer', '2025-03-31'),
(35, 'karthik_m', 'Operating System Concepts', 'Springer', '2025-03-24'),
(37, 'abhishek_gowda', 'Software Engineering', 'Wiley', '2025-03-26'),
(38, 'sanjay_rao', 'Artificial Intelligence: A Modern Approach', 'Wiley', '2025-03-16'),
(39, 'neha_sharma', 'Database System Concepts', 'Prentice Hall', '2025-03-28'),
(40, 'kavya_n', 'Engineering Mechanics', 'McGraw-Hill', '2025-03-23'),
(41, 'rajeshwari_n', 'Operating System Concepts', 'Oxford University Press', '2025-03-22'),
(42, 'ramesh_kumar', 'Software Engineering', 'Springer', '2025-03-18'),
(43, 'rajeshwari_n', 'Computer Networks', 'Cambridge University Press', '2025-03-20'),
(44, 'amit_patel', 'Artificial Intelligence: A Modern Approach', 'Cambridge University Press', '2025-03-29'),
(45, 'neha_sharma', 'Thermodynamics: An Engineering Approach', 'MIT Press', '2025-03-16'),
(46, 'manikanta_l', 'Digital Logic Design', 'Oxford University Press', '2025-03-31'),
(47, 'meera_das', 'Operating System Concepts', 'Cambridge University Press', '2025-03-17'),
(48, 'manikanta_l', 'Computer Networks', 'Elsevier', '2025-03-17'),
(49, 'meera_das', 'Computer Architecture', 'Oxford University Press', '2025-03-24'),
(50, 'karthik_m', 'Operating System Concepts', 'Elsevier', '2025-03-19'),
(51, 'priya_sharma', 'Engineering Mechanics', 'Prentice Hall', '2025-03-28'),
(52, 'amit_patel', 'Software Engineering', 'Morgan Kaufmann', '2025-03-18'),
(53, 'neha_sharma', 'Software Engineering', 'Morgan Kaufmann', '2025-03-19'),
(54, 'priya_sharma', 'Thermodynamics: An Engineering Approach', 'Elsevier', '2025-03-21'),
(55, 'lakshmi_priya', 'Digital Logic Design', 'Cambridge University Press', '2025-03-25'),
(57, 'manikanta_l', 'Introduction to Algorithms', 'Morgan Kaufmann', '2025-03-22'),
(58, 'nisha_r', 'Digital Logic Design', 'MIT Press', '2025-03-23'),
(59, 'priya_sharma', 'Engineering Mechanics', 'Pearson', '2025-03-24'),
(60, 'lakshmi_priya', 'Digital Logic Design', 'Prentice Hall', '2025-03-19'),
(61, 'ramesh_kumar', 'Digital Logic Design', 'Cambridge University Press', '2025-03-18'),
(62, 'rahul_verma', 'Database System Concepts', 'Springer', '2025-03-16'),
(63, 'priya_sharma', 'Software Engineering', 'Cambridge University Press', '2025-03-20'),
(64, 'sneha_patil', 'Artificial Intelligence: A Modern Approach', 'Wiley', '2025-03-20'),
(65, 'rajeshwari_n', 'Digital Logic Design', 'MIT Press', '2025-03-31'),
(66, 'amit_patel', 'Thermodynamics: An Engineering Approach', 'McGraw-Hill', '2025-03-17'),
(67, 'karthik_m', 'Thermodynamics: An Engineering Approach', 'Wiley', '2025-03-17'),
(68, 'deepa_iyer', 'Computer Architecture', 'Pearson', '2025-03-16'),
(69, 'shivakumar_r', 'Artificial Intelligence: A Modern Approach', 'Cambridge University Press', '2025-03-22'),
(70, 'priya_sharma', 'Artificial Intelligence: A Modern Approach', 'Morgan Kaufmann', '2025-03-25'),
(71, 'rajeshwari_n', 'Engineering Mechanics', 'Cambridge University Press', '2025-03-26'),
(72, 'lakshmi_priya', 'Digital Logic Design', 'Prentice Hall', '2025-03-29'),
(73, 'neha_sharma', 'Artificial Intelligence: A Modern Approach', 'Cambridge University Press', '2025-03-16'),
(74, 'sneha_patil', 'Operating System Concepts', 'Pearson', '2025-03-30'),
(75, 'neha_sharma', 'Artificial Intelligence: A Modern Approach', 'Morgan Kaufmann', '2025-03-30'),
(76, 'priya_sharma', 'Thermodynamics: An Engineering Approach', 'Pearson', '2025-03-20'),
(77, 'deepa_iyer', 'Operating System Concepts', 'Elsevier', '2025-03-25'),
(78, 'lakshmi_priya', 'Software Engineering', 'McGraw-Hill', '2025-03-17'),
(79, 'lakshmi_priya', 'Operating System Concepts', 'Wiley', '2025-03-24'),
(80, 'neha_sharma', 'Digital Logic Design', 'Prentice Hall', '2025-03-21'),
(81, 'meera_das', 'Engineering Mechanics', 'McGraw-Hill', '2025-03-24'),
(82, 'priya_sharma', 'Software Engineering', 'Springer', '2025-03-19'),
(83, 'ramesh_kumar', 'Introduction to Algorithms', 'Wiley', '2025-03-24'),
(84, 'meera_das', 'Software Engineering', 'McGraw-Hill', '2025-03-16'),
(85, 'deepa_iyer', 'Software Engineering', 'McGraw-Hill', '2025-03-24'),
(86, 'rajeshwari_n', 'Software Engineering', 'Pearson', '2025-03-31'),
(87, 'manikanta_l', 'Digital Logic Design', 'Oxford University Press', '2025-03-18'),
(88, 'sneha_patil', 'Computer Networks', 'Prentice Hall', '2025-03-28'),
(89, 'neha_sharma', 'Operating System Concepts', 'Prentice Hall', '2025-03-18'),
(90, 'amit_patel', 'Operating System Concepts', 'MIT Press', '2025-03-18'),
(91, 'lakshmi_priya', 'Software Engineering', 'Morgan Kaufmann', '2025-03-23'),
(92, 'neha_sharma', 'Database System Concepts', 'Pearson', '2025-03-16'),
(93, 'neha_sharma', 'Introduction to Algorithms', 'Pearson', '2025-03-24'),
(94, 'abhishek_gowda', 'Operating System Concepts', 'Wiley', '2025-03-26'),
(95, 'priya_sharma', 'Database System Concepts', 'Wiley', '2025-03-21'),
(96, 'nisha_r', 'Computer Networks', 'Springer', '2025-03-20'),
(98, 'karthik_m', 'Digital Logic Design', 'Prentice Hall', '2025-03-21'),
(99, 'neha_sharma', 'Database System Concepts', 'Pearson', '2025-03-17'),
(100, 'sanjay_rao', 'Database System Concepts', 'McGraw-Hill', '2025-03-21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `borrowed_books`
--
ALTER TABLE `borrowed_books`
  ADD PRIMARY KEY (`borrow_id`),
  ADD KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `borrowed_books`
--
ALTER TABLE `borrowed_books`
  MODIFY `borrow_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `borrowed_books`
--
ALTER TABLE `borrowed_books`
  ADD CONSTRAINT `borrowed_books_ibfk_1` FOREIGN KEY (`username`) REFERENCES `users` (`username`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
