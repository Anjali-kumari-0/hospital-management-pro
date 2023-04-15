-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 30, 2022 at 08:56 AM
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
-- Database: `login`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(255) NOT NULL,
  `username` varchar(200) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `category` varchar(255) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `name`, `password`, `email`, `phone`, `category`, `date`) VALUES
(18, '919470312947', 'Kunal', '$2y$10$qnhN3ij/72ruD7Oo8zcyYuZjSKaH1NtCAHhj3/ThmVWJcl28tUEKK', 'kunal@gmail.com', '9470312947', 'Doctor', '2022-07-24 04:00:06'),
(19, '224466880022', 'sushant', '$2y$10$wG9p8rSRHkZo5RF13p8VSuiKhWQ/dTAoS9vSMVWx8UHcAXehApFmy', 'heelloo@123', '8976897689', 'Admin', '2022-07-24 03:32:06'),
(20, '913948551675', 'RIYA KUMARI SINGH', '$2y$10$LVr92NjnLL3OSQkZ3u53hu6QgOpc5sBDKKT4/ChJr0ZHnrgwnKyYy', 'riyakumarisinghjsr@gmail.com', '7717745437', 'Doctor', '2022-07-24 03:36:25'),
(21, '123456789012', 'Radha', '$2y$10$YpCeqPFwZcFbYhRMwMUChux/aGffcoyfuDR7PJ/Rxk.yiyF66Uafu', 'singhriyakumari@gmail.com', '1234567890', 'Admin', '2022-07-24 03:41:00'),
(22, '98765432112', 'qwerty', '$2y$10$EDp4bfaQlvaC6N5/wF5iqO.xgD7/pAI7FUQcNLmkJwTgsS7tgtIeW', 'qwerty@gmail.com', '987654321', 'Patient', '2022-07-24 03:42:19'),
(23, '221122112211', 'priya', '$2y$10$R/okyOqJOAPHZW3ShmO9EuVQ0XQv38nRtaKsHunvhUoQrGu0mNvIG', 'piri@gmail.com', '7717745437', 'Doctor', '2022-07-30 12:24:32');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
