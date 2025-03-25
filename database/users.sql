-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 25, 2025 at 02:49 PM
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
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `role` enum('student','faculty','admin') NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `username` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `role`, `password`, `created_at`, `username`) VALUES
(1, 'Abhishek Gowda', 'abhishek.gowda@gmail.com', 'admin', 'Abhi@123', '2025-03-24 05:46:51', 'abhishek_gowda'),
(2, 'Manikanta L', 'manikanta.l@gmail.com', 'student', 'Mani@456', '2025-03-24 05:46:51', 'manikanta_l'),
(3, 'Shivakumar R', 'shivakumar.r@gmail.com', 'faculty', 'Shiva@789', '2025-03-24 05:46:51', 'shivakumar_r'),
(4, 'Ramesh Kumar', 'ramesh.kumar@gmail.com', 'student', 'Ramesh@123', '2025-03-24 05:46:51', 'ramesh_kumar'),
(6, 'Priya Sharma', 'priya.sharma@gmail.com', 'student', 'Priya@789', '2025-03-24 05:46:51', 'priya_sharma'),
(7, 'Rahul Verma', 'rahul.verma@gmail.com', 'admin', 'Rahul@123', '2025-03-24 05:46:51', 'rahul_verma'),
(8, 'Sneha Patil', 'sneha.patil@gmail.com', 'student', 'Sneha@456', '2025-03-24 05:46:51', 'sneha_patil'),
(9, 'Vikram Singh', 'vikram.singh@gmail.com', 'faculty', 'Vikram@789', '2025-03-24 05:46:51', 'vikram_singh'),
(10, 'Deepa Iyer', 'deepa.iyer@gmail.com', 'student', 'Deepa@123', '2025-03-24 05:46:51', 'deepa_iyer'),
(11, 'Arjun Kumar', 'arjun.kumar@gmail.com', 'student', 'Arjun@456', '2025-03-24 05:46:51', 'arjun_kumar'),
(12, 'Kavya N', 'kavya.n@gmail.com', 'faculty', 'Kavya@789', '2025-03-24 05:46:51', 'kavya_n'),
(13, 'Meera Das', 'meera.das@gmail.com', 'admin', 'Meera@123', '2025-03-24 05:46:51', 'meera_das'),
(14, 'Sanjay Rao', 'sanjay.rao@gmail.com', 'student', 'Sanjay@456', '2025-03-24 05:46:51', 'sanjay_rao'),
(15, 'Lakshmi Priya', 'lakshmi.priya@gmail.com', 'faculty', 'Lakshmi@789', '2025-03-24 05:46:51', 'lakshmi_priya'),
(16, 'Karthik M', 'karthik.m@gmail.com', 'student', 'Karthik@123', '2025-03-24 05:46:51', 'karthik_m'),
(17, 'Nisha R', 'nisha.r@gmail.com', 'faculty', 'Nisha@456', '2025-03-24 05:46:51', 'nisha_r'),
(18, 'Amit Patel', 'amit.patel@gmail.com', 'student', 'Amit@789', '2025-03-24 05:46:51', 'amit_patel'),
(19, 'Neha Sharma', 'neha.sharma@gmail.com', 'admin', 'Neha@123', '2025-03-24 05:46:51', 'neha_sharma'),
(20, 'Rajeshwari N', 'rajeshwari.n@gmail.com', 'faculty', 'Rajeshwari@456', '2025-03-24 05:46:51', 'rajeshwari_n'),
(21, 'Pavan K', 'pavan.k@gmail.com', 'student', 'Pavan@789', '2025-03-24 05:46:51', 'user_21'),
(22, 'Divya G', 'divya.g@gmail.com', 'faculty', 'Divya@123', '2025-03-24 05:46:51', 'user_22'),
(23, 'Sunil Kumar', 'sunil.kumar@gmail.com', 'student', 'Sunil@456', '2025-03-24 05:46:51', 'user_23'),
(24, 'Lavanya R', 'lavanya.r@gmail.com', 'faculty', 'Lavanya@789', '2025-03-24 05:46:51', 'user_24'),
(25, 'Harsha V', 'harsha.v@gmail.com', 'admin', 'Harsha@123', '2025-03-24 05:46:51', 'user_25'),
(26, 'Vikas S', 'vikas.s@gmail.com', 'student', 'Vikas@456', '2025-03-24 05:46:51', 'user_26'),
(27, 'Pranav I', 'pranav.i@gmail.com', 'faculty', 'Pranav@789', '2025-03-24 05:46:51', 'user_27'),
(28, 'Reshma N', 'reshma.n@gmail.com', 'student', 'Reshma@123', '2025-03-24 05:46:51', 'user_28'),
(29, 'Kiran P', 'kiran.p@gmail.com', 'faculty', 'Kiran@456', '2025-03-24 05:46:51', 'user_29'),
(30, 'Yashaswini R', 'yashaswini.r@gmail.com', 'student', 'Yashaswini@789', '2025-03-24 05:46:51', 'user_30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
