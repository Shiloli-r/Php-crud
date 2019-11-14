-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 17, 2019 at 04:20 AM
-- Server version: 10.3.15-MariaDB
-- PHP Version: 7.1.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tbt`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_id` int(11) NOT NULL,
  `fname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `phone` int(10) NOT NULL,
  `date_registered` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `fname`, `lname`, `email`, `phone`, `date_registered`) VALUES
(2, 'John', 'Doe', 'johndoe@gmail.com', 704450445, '2019-07-16'),
(3, 'May', 'Parker', 'mayparker@gmail.com', 750080234, '2019-07-09'),
(4, 'Peter', 'Parker', 'peterparker@yahoo.com', 709530456, '2019-07-01'),
(5, 'Jon', 'Snow', 'jonsnow@gmail.com', 706540123, '2019-07-08'),
(6, 'Derek', 'Hale', 'derekhale@yahoo.com', 706540234, '2019-07-01'),
(7, 'Stiles', 'Stilinski', 'stilinskistyle@gmail.com', 765432345, '2019-06-04'),
(9, 'Erick', 'Brown', 'erickbrown@yahoo.com', 708934562, '2019-07-14'),
(13, 'Johnny', 'Bravo', 'johnnybravo@outlook.com', 765406544, '2019-07-17');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `order_date` date NOT NULL,
  `due_date` date NOT NULL,
  `date_completed` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `customer_id`, `order_date`, `due_date`, `date_completed`) VALUES
(2, 7, '2019-07-01', '2019-07-09', '2019-07-09'),
(3, 4, '2019-06-02', '2019-07-01', '2019-07-02'),
(4, 9, '2019-05-06', '2019-05-15', '2019-05-16'),
(5, 6, '2019-06-10', '2019-06-20', '2019-07-21'),
(6, 3, '2019-07-01', '2019-07-04', '2019-07-05'),
(8, 4, '2019-07-08', '2019-07-09', '2019-07-11');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(50) NOT NULL,
  `privilege` varchar(10) NOT NULL,
  `date_registered` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password`, `privilege`, `date_registered`) VALUES
(7, 'user1', 'user1@gmail.com', '24c9e15e52afc47c225b757e7bee1f9d', 'admin', '2019-07-10'),
(28, 'user3', 'userx@gmail.com', '92877af70a45fd6a2ed7fe81e1236b78', 'user', '2019-07-10'),
(30, 'user2', 'user2@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'user', '2019-07-09'),
(32, 'ronnie', 'ronaldshiloli@gmail.com', 'b071c0c8d6adc66a3c2eb1b9b87d6d5c', 'superadmin', '2019-07-17'),
(34, 'admin', 'admin@gmail.com', '14e1b600b1fd579f47433b88e8d85291', 'superadmin', '2019-07-17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
