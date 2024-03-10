-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 07, 2024 at 03:06 PM
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
-- Database: `naig_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `naiguser`
--

CREATE TABLE `naiguser` (
  `Last_Name` varchar(100) NOT NULL,
  `First_Name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `lot_block` varchar(100) NOT NULL,
  `street` varchar(100) NOT NULL,
  `phase_subdivision` varchar(100) NOT NULL,
  `barangay` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `province` varchar(100) NOT NULL,
  `Country` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `naiguser`
--

INSERT INTO `naiguser` (`Last_Name`, `First_Name`, `email`, `password`, `lot_block`, `street`, `phase_subdivision`, `barangay`, `city`, `province`, `Country`, `phone`) VALUES
('Naig', 'Yves Colin', 'yvescolinnaig@gmail.com', '$2y$10$HSypmrSc7/g0k7cITgtFpu05smQwTQ7fwzn0EaX.zTfI8RRKsF3SW', 'Blk 69, Lot 96', 'Champaca St.', 'Maligaya Park', 'PasongPutikProper', 'Quezon City', 'NCR', 'Philippines', '09193850728');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
