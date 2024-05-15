-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 23, 2024 at 10:49 AM
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
-- Database: `livestyle_lab`
--
CREATE DATABASE IF NOT EXISTS `livestyle_lab` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `livestyle_lab`;

-- --------------------------------------------------------

--
-- Table structure for table `basket`
--

CREATE TABLE `basket` (
  `id` int(11) NOT NULL,
  `fk_user` int(11) NOT NULL,
  `fk_product` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `order_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `basket`
--

INSERT INTO `basket` (`id`, `fk_user`, `fk_product`, `amount`, `order_date`) VALUES
(1, 1, 1, 2, '2024-04-23 10:43:57'),
(2, 2, 2, 4, '2024-04-23 10:43:57');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `price` decimal(12,2) NOT NULL,
  `img` varchar(255) DEFAULT NULL,
  `fk_type` int(11) DEFAULT NULL,
  `fk_status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `description`, `price`, `img`, `fk_type`, `fk_status`) VALUES
(1, 'Test product 1', 'Test product 1', 99.00, 'no_product.jpg', 1, 1),
(2, 'Test product 2', 'Test product 2', 250.00, 'no_product.jpg', 2, 1),
(3, 'Test product 3', 'Test product 3', 199.99, 'no_product.jpg', 3, 1),
(4, 'Test product 4', 'Test product 4', 1500.00, 'no_product.jpg', 4, 1),
(5, 'Test product 5 - hidden ', 'Test product 5 - hidden ', 9999.99, 'no_product.jpg', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `product_review`
--

CREATE TABLE `product_review` (
  `id` int(11) NOT NULL,
  `review` varchar(255) NOT NULL,
  `rating` int(11) DEFAULT NULL,
  `created` datetime NOT NULL,
  `fk_user` int(11) NOT NULL,
  `fk_product` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_review`
--

INSERT INTO `product_review` (`id`, `review`, `rating`, `created`, `fk_user`, `fk_product`) VALUES
(1, 'Test review 1', 3, '2024-04-23 10:45:35', 1, 1),
(2, 'Test review 2', 5, '2024-04-23 10:45:36', 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `product_status`
--

CREATE TABLE `product_status` (
  `id` int(11) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_status`
--

INSERT INTO `product_status` (`id`, `status`) VALUES
(1, 'Visible'),
(2, 'Hidden');

-- --------------------------------------------------------

--
-- Table structure for table `product_type`
--

CREATE TABLE `product_type` (
  `id` int(11) NOT NULL,
  `type` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_type`
--

INSERT INTO `product_type` (`id`, `type`) VALUES
(1, 'Fashion'),
(2, 'Shoes'),
(3, 'Accessories'),
(4, 'Entertainment');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `fname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `adress` varchar(150) NOT NULL,
  `registered` date DEFAULT current_timestamp(),
  `user_img` varchar(250) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `fk_role` int(11) NOT NULL DEFAULT 1,
  `ban_expiry` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `fname`, `lname`, `email`, `adress`, `registered`, `user_img`, `password`, `fk_role`, `ban_expiry`) VALUES
(1, 'Test', 'User', 'test@user.com', 'Test address', '2024-04-23', 'no_user.jpg', '12345678', 1, NULL),
(2, 'Test', 'Admin', 'test@admin.com', 'Test address', '2024-04-23', 'admin.jpg', '12345678', 2, NULL),
(3, 'Banned', 'User', 'banned@user.com', 'Test address', '2024-04-23', 'no_user.jpg', '12345678', 3, '2024-04-30');

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(10) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'user'),
(2, 'admin'),
(3, 'banned');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `basket`
--
ALTER TABLE `basket`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user` (`fk_user`),
  ADD KEY `fk_product` (`fk_product`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_type` (`fk_type`),
  ADD KEY `fk_status` (`fk_status`);

--
-- Indexes for table `product_review`
--
ALTER TABLE `product_review`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user` (`fk_user`),
  ADD KEY `fk_product` (`fk_product`);

--
-- Indexes for table `product_status`
--
ALTER TABLE `product_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_type`
--
ALTER TABLE `product_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_role` (`fk_role`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `basket`
--
ALTER TABLE `basket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `product_review`
--
ALTER TABLE `product_review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product_status`
--
ALTER TABLE `product_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product_type`
--
ALTER TABLE `product_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `basket`
--
ALTER TABLE `basket`
  ADD CONSTRAINT `basket_ibfk_1` FOREIGN KEY (`fk_user`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `basket_ibfk_2` FOREIGN KEY (`fk_product`) REFERENCES `product` (`id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`fk_type`) REFERENCES `product_type` (`id`),
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`fk_status`) REFERENCES `product_status` (`id`);

--
-- Constraints for table `product_review`
--
ALTER TABLE `product_review`
  ADD CONSTRAINT `product_review_ibfk_1` FOREIGN KEY (`fk_user`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `product_review_ibfk_2` FOREIGN KEY (`fk_product`) REFERENCES `product` (`id`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`fk_role`) REFERENCES `user_role` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
