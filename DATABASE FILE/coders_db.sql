-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 12, 2022 at 04:30 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `coders_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `product_order`
--

CREATE TABLE `product_order` (
  `user_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `order_total_before_tax` varchar(255) NOT NULL,
  `order_total_tax` varchar(255) NOT NULL,
  `order_tax_per` varchar(255) NOT NULL,
  `order_total_after_tax` varchar(255) NOT NULL,
  `order_amount_paid` varchar(255) NOT NULL,
  `order_total_amount_due` varchar(255) NOT NULL,
  `order_date` datetime NOT NULL DEFAULT current_timestamp(),
  `note` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `product_order`
--

INSERT INTO `product_order` (`user_id`, `order_id`, `product_name`, `order_total_before_tax`, `order_total_tax`, `order_tax_per`, `order_total_after_tax`, `order_amount_paid`, `order_total_amount_due`, `order_date`, `note`) VALUES
(10, 42, 'lambu', '642', '', '', '', '', '', '2022-06-12 18:16:42', ''),
(10, 43, 'ni', '13', '', '', '', '', '', '2022-06-12 18:22:16', ''),
(10, 44, 'viraj', '168', '', '', '', '', '', '2022-06-12 18:31:18', ''),
(10, 45, 'a', '9', '', '', '', '', '', '2022-06-12 18:40:49', ''),
(9, 46, 'atul', '81', '', '', '', '', '', '2022-06-12 18:47:30', ''),
(9, 47, 'mmmnnn', '45816', '', '', '', '', '', '2022-06-12 19:57:14', '');

-- --------------------------------------------------------

--
-- Table structure for table `product_order_item`
--

CREATE TABLE `product_order_item` (
  `order_id` int(11) NOT NULL,
  `item_code` varchar(255) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `order_item_quantity` varchar(255) NOT NULL,
  `order_item_price` varchar(255) NOT NULL,
  `order_item_final_amount` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `product_order_item`
--

INSERT INTO `product_order_item` (`order_id`, `item_code`, `item_name`, `order_item_quantity`, `order_item_price`, `order_item_final_amount`) VALUES
(43, 'n', 'n', '2', '2', '4'),
(43, 'n', 'n', '3', '3', '9'),
(42, 'xyz', 'o', '10', '6', '60'),
(42, 'lambe', 'o', '20', '9', '180'),
(42, 'shivaj', 'o', '34', '67', '2278'),
(42, 'r', 'o', '8', '8', '64'),
(44, 'v', 'v', '4', '4', '16'),
(44, 'v', 'v', '7', '7', '49'),
(44, 'v', 'v', '7', '7', '49'),
(44, 'b', 'b', '6', '9', '54'),
(45, 'a', 'a', '3', '3', '9'),
(46, 'n', 'n', '6', '6', '36'),
(46, 'm', 'm', '9', '5', '45'),
(47, 'mmnn', 'mmnn', '68', '6', '408'),
(47, '66nn', '66nn', '66', '688', '45408');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`) VALUES
(9, 'Atul', 'atul@gmail.com', '202cb962ac59075b964b07152d234b70'),
(10, 'swaraj', 'demo@demo.com', '202cb962ac59075b964b07152d234b70');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `product_order`
--
ALTER TABLE `product_order`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `product_order`
--
ALTER TABLE `product_order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
