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
-- Table structure for table `issued_books`
--

CREATE TABLE `issued_books` (
  `issue_id` int(11) NOT NULL,
  `book_id` int(11) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `issue_date` date DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `status` enum('issued','returned','overdue') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `issued_books`
--

INSERT INTO `issued_books` (`issue_id`, `book_id`, `username`, `issue_date`, `due_date`, `status`) VALUES
(1, 33, 'ramesh_kumar', '2025-03-04', '2025-03-18', 'issued'),
(2, 40, 'rahul_verma', '2025-03-07', '2025-03-21', 'overdue'),
(3, 20, 'neha_sharma', '2025-03-15', '2025-03-29', 'overdue'),
(4, 32, 'sneha_patil', '2025-03-11', '2025-03-25', 'overdue'),
(5, 289, 'nisha_r', '2025-03-06', '2025-03-20', 'issued'),
(6, 202, 'karthik_m', '2025-03-06', '2025-03-20', 'issued'),
(7, 11, 'rajeshwari_n', '2025-03-15', '2025-03-29', 'overdue'),
(8, 259, 'priya_sharma', '2025-03-06', '2025-03-20', 'issued'),
(9, 417, 'kavya_n', '2025-03-09', '2025-03-23', 'overdue'),
(10, 217, 'sneha_patil', '2025-03-03', '2025-03-17', 'returned'),
(11, 140, 'abhishek_gowda', '2025-03-05', '2025-03-19', 'overdue'),
(12, 346, 'abhishek_gowda', '2025-03-08', '2025-03-22', 'returned'),
(13, 450, 'meera_das', '2025-03-09', '2025-03-23', 'issued'),
(14, 371, 'vikram_singh', '2025-03-07', '2025-03-21', 'issued'),
(15, 101, 'arjun_kumar', '2025-03-13', '2025-03-27', 'overdue'),
(16, 362, 'sanjay_rao', '2025-03-09', '2025-03-23', 'overdue'),
(17, 158, 'priya_sharma', '2025-03-11', '2025-03-25', 'issued'),
(18, 96, 'ramesh_kumar', '2025-03-15', '2025-03-29', 'overdue'),
(19, 136, 'rahul_verma', '2025-03-09', '2025-03-23', 'issued'),
(20, 412, 'deepa_iyer', '2025-03-07', '2025-03-21', 'returned'),
(21, 46, 'neha_sharma', '2025-03-07', '2025-03-21', 'overdue'),
(22, 415, 'deepa_iyer', '2025-03-11', '2025-03-25', 'overdue'),
(23, 231, 'karthik_m', '2025-03-15', '2025-03-29', 'issued'),
(24, 234, 'deepa_iyer', '2025-03-03', '2025-03-17', 'overdue'),
(25, 427, 'amit_patel', '2025-03-02', '2025-03-16', 'returned'),
(26, 148, 'manikanta_l', '2025-03-04', '2025-03-18', 'returned'),
(27, 118, 'rajeshwari_n', '2025-03-12', '2025-03-26', 'returned'),
(28, 9, 'meera_das', '2025-03-10', '2025-03-24', 'issued'),
(29, 5, 'priya_sharma', '2025-03-09', '2025-03-23', 'returned'),
(30, 29, 'deepa_iyer', '2025-03-06', '2025-03-20', 'issued'),
(31, 492, 'manikanta_l', '2025-03-04', '2025-03-18', 'overdue'),
(32, 390, 'amit_patel', '2025-03-11', '2025-03-25', 'issued'),
(33, 217, 'meera_das', '2025-03-08', '2025-03-22', 'issued'),
(34, 487, 'neha_sharma', '2025-03-07', '2025-03-21', 'returned'),
(35, 16, 'vikram_singh', '2025-03-14', '2025-03-28', 'issued'),
(36, 269, 'lakshmi_priya', '2025-03-03', '2025-03-17', 'issued'),
(37, 326, 'vikram_singh', '2025-03-07', '2025-03-21', 'returned'),
(38, 331, 'sanjay_rao', '2025-03-11', '2025-03-25', 'returned'),
(39, 317, 'ramesh_kumar', '2025-03-11', '2025-03-25', 'overdue'),
(40, 398, 'neha_sharma', '2025-03-07', '2025-03-21', 'issued'),
(41, 276, 'rahul_verma', '2025-03-14', '2025-03-28', 'returned'),
(42, 50, 'rajeshwari_n', '2025-03-01', '2025-03-15', 'overdue'),
(43, 391, 'meera_das', '2025-03-09', '2025-03-23', 'issued'),
(44, 339, 'vikram_singh', '2025-03-01', '2025-03-15', 'overdue'),
(45, 403, 'kavya_n', '2025-03-10', '2025-03-24', 'returned'),
(46, 420, 'deepa_iyer', '2025-03-10', '2025-03-24', 'returned'),
(47, 258, 'nisha_r', '2025-03-05', '2025-03-19', 'issued'),
(48, 498, 'abhishek_gowda', '2025-03-04', '2025-03-18', 'returned'),
(49, 30, 'deepa_iyer', '2025-03-03', '2025-03-17', 'issued'),
(50, 415, 'priya_sharma', '2025-03-03', '2025-03-17', 'returned'),
(51, 146, 'meera_das', '2025-03-11', '2025-03-25', 'overdue'),
(52, 261, 'karthik_m', '2025-03-06', '2025-03-20', 'overdue'),
(53, 316, 'rajeshwari_n', '2025-03-09', '2025-03-23', 'issued'),
(54, 251, 'karthik_m', '2025-03-05', '2025-03-19', 'returned'),
(55, 60, 'sneha_patil', '2025-03-08', '2025-03-22', 'returned'),
(56, 149, 'sanjay_rao', '2025-03-15', '2025-03-29', 'overdue'),
(57, 345, 'neha_sharma', '2025-03-11', '2025-03-25', 'returned'),
(58, 324, 'neha_sharma', '2025-03-14', '2025-03-28', 'returned'),
(59, 31, 'arjun_kumar', '2025-03-03', '2025-03-17', 'overdue'),
(60, 315, 'shivakumar_r', '2025-03-10', '2025-03-24', 'issued'),
(61, 260, 'sneha_patil', '2025-03-03', '2025-03-17', 'returned'),
(62, 43, 'abhishek_gowda', '2025-03-10', '2025-03-24', 'returned'),
(63, 327, 'neha_sharma', '2025-03-01', '2025-03-15', 'overdue'),
(64, 15, 'manikanta_l', '2025-03-15', '2025-03-29', 'issued'),
(65, 250, 'karthik_m', '2025-03-13', '2025-03-27', 'issued'),
(66, 105, 'lakshmi_priya', '2025-03-12', '2025-03-26', 'overdue'),
(67, 117, 'neha_sharma', '2025-03-05', '2025-03-19', 'returned'),
(68, 68, 'amit_patel', '2025-03-11', '2025-03-25', 'overdue'),
(69, 275, 'meera_das', '2025-03-15', '2025-03-29', 'issued'),
(70, 59, 'karthik_m', '2025-03-15', '2025-03-29', 'issued'),
(71, 421, 'nisha_r', '2025-03-06', '2025-03-20', 'overdue'),
(72, 278, 'priya_sharma', '2025-03-03', '2025-03-17', 'issued'),
(73, 365, 'shivakumar_r', '2025-03-10', '2025-03-24', 'issued'),
(74, 233, 'lakshmi_priya', '2025-03-09', '2025-03-23', 'overdue'),
(75, 139, 'amit_patel', '2025-03-06', '2025-03-20', 'issued'),
(76, 455, 'meera_das', '2025-03-15', '2025-03-29', 'returned'),
(77, 226, 'amit_patel', '2025-03-04', '2025-03-18', 'issued'),
(78, 483, 'karthik_m', '2025-03-02', '2025-03-16', 'overdue'),
(79, 448, 'sneha_patil', '2025-03-01', '2025-03-15', 'overdue'),
(80, 353, 'sneha_patil', '2025-03-04', '2025-03-18', 'returned'),
(81, 365, 'amit_patel', '2025-03-14', '2025-03-28', 'issued'),
(82, 84, 'sneha_patil', '2025-03-12', '2025-03-26', 'returned'),
(83, 15, 'nisha_r', '2025-03-14', '2025-03-28', 'overdue'),
(84, 26, 'meera_das', '2025-03-08', '2025-03-22', 'issued'),
(85, 170, 'manikanta_l', '2025-03-04', '2025-03-18', 'returned'),
(86, 464, 'rahul_verma', '2025-03-06', '2025-03-20', 'issued'),
(87, 278, 'vikram_singh', '2025-03-05', '2025-03-19', 'issued'),
(88, 356, 'sneha_patil', '2025-03-01', '2025-03-15', 'returned'),
(89, 61, 'vikram_singh', '2025-03-14', '2025-03-28', 'issued'),
(90, 401, 'priya_sharma', '2025-03-02', '2025-03-16', 'issued'),
(91, 25, 'rajeshwari_n', '2025-03-10', '2025-03-24', 'issued'),
(93, 378, 'kavya_n', '2025-03-05', '2025-03-19', 'issued'),
(94, 404, 'neha_sharma', '2025-03-11', '2025-03-25', 'returned'),
(95, 331, 'karthik_m', '2025-03-11', '2025-03-25', 'overdue'),
(96, 299, 'rajeshwari_n', '2025-03-15', '2025-03-29', 'issued'),
(97, 159, 'arjun_kumar', '2025-03-01', '2025-03-15', 'issued'),
(98, 123, 'neha_sharma', '2025-03-13', '2025-03-27', 'issued'),
(99, 405, 'shivakumar_r', '2025-03-12', '2025-03-26', 'overdue'),
(100, 472, 'rahul_verma', '2025-03-02', '2025-03-16', 'overdue'),
(101, 46, 'manikanta_l', '2025-03-24', '2025-03-31', 'issued'),
(102, 500, 'manikanta_l', '2025-03-25', '2025-04-01', 'issued');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `issued_books`
--
ALTER TABLE `issued_books`
  ADD PRIMARY KEY (`issue_id`),
  ADD KEY `book_id` (`book_id`),
  ADD KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `issued_books`
--
ALTER TABLE `issued_books`
  MODIFY `issue_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `issued_books`
--
ALTER TABLE `issued_books`
  ADD CONSTRAINT `issued_books_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `issued_books_ibfk_2` FOREIGN KEY (`username`) REFERENCES `users` (`username`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
