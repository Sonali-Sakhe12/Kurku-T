-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 13, 2024 at 12:40 PM
-- Server version: 5.7.23-23
-- PHP Version: 8.1.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hemppmft_kurkut`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblorder`
--

CREATE TABLE `tblorder` (
  `id` int(11) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `order_plan` varchar(10) NOT NULL,
  `total` varchar(10) NOT NULL,
  `order_id` varchar(30) NOT NULL,
  `payment_id` varchar(30) NOT NULL,
  `email` varchar(150) NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `address_line1` varchar(100) NOT NULL,
  `address_line2` varchar(100) NOT NULL,
  `pincode` varchar(10) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `country` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblorder`
--

INSERT INTO `tblorder` (`id`, `first_name`, `last_name`, `order_plan`, `total`, `order_id`, `payment_id`, `email`, `phone_number`, `address_line1`, `address_line2`, `pincode`, `city`, `state`, `country`) VALUES
(1, 'Palaash', 'Sarkar', '3 months', '12000', 'order_O4t3YP7BAdtowm', 'pay_O4t4uMZcDeCui5', 'gigastein0.0@gmail.com', '9930965816', '54, Ganga', 'Vasundhara CHSL, Manoa', '781271', 'Thane', 'Maharashtra', 'India');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblorder`
--
ALTER TABLE `tblorder`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblorder`
--
ALTER TABLE `tblorder`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
