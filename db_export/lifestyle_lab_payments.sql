-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 01, 2024 at 10:13 AM
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
-- Database: `lifestyle_lab`
--
CREATE DATABASE IF NOT EXISTS `lifestyle_lab` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `lifestyle_lab`;

-- --------------------------------------------------------

--
-- Table structure for table `basket`
--

CREATE TABLE `basket` (
  `id` int(11) NOT NULL,
  `fk_user` int(11) NOT NULL,
  `fk_product` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `order_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `basket`
--

INSERT INTO `basket` (`id`, `fk_user`, `fk_product`, `amount`, `order_date`) VALUES
(32, 10, 2, 1, '2024-04-30 13:35:36'),
(33, 10, 4, 1, '2024-04-30 13:40:36'),
(34, 10, 1, 1, '2024-04-30 13:41:41'),
(35, 10, 1, 1, '2024-04-30 13:43:51');

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
  `stripe_id` varchar(255) DEFAULT NULL,
  `fk_type` int(11) DEFAULT NULL,
  `fk_status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `description`, `price`, `img`, `stripe_id`, `fk_type`, `fk_status`) VALUES
(1, 'Fashion Boots', 'Stylish and versatile boots perfect for any outfit or occasion.', 99.00, 'Boots.png', 'price_1PBFGZES7LYlQ9KvDM86pMeu', 2, 1),
(2, 'Blue Marine Jumpsuit', 'A chic and comfortable jumpsuit perfect for a day at the beach or a night out.', 250.00, 'Overall.png', 'price_1PBFHjES7LYlQ9KvQbrVYm64', 1, 1),
(3, 'Beach Side Festival', 'A fun and colorful collection of beach festival in the sand.', 499.99, 'Beach.png', 'price_1PBWY0ES7LYlQ9KvhkoNUIn0', 4, 1),
(4, 'White Sunglasses', 'Stay cool and stylish with these trendy white sunglasses.', 180.00, 'Sunglasses.png', 'price_1PBXQgES7LYlQ9Kvr1QhEzjm', 3, 1),
(5, 'Personal Trainer', 'Get in shape and reach your fitness goals with the help of a dedicated personal trainer.', 120.00, 'Sport.png', 'price_1PBXRsES7LYlQ9KvbZ7HDu5P', 4, 1),
(6, 'Oversize Trenchcoat', 'Stay warm and stylish in this trendy oversize trenchcoat.', 270.00, 'Trenchcoat.png', 'price_1PBXSyES7LYlQ9KvqwGcoiSm', 1, 1),
(7, 'Black Pumps', 'Classic and elegant black pumps that can elevate any outfit.', 199.99, 'Pumps.png', 'price_1PBWe6ES7LYlQ9KvvwPzvmdd', 2, 1),
(8, 'Green Silk Skirt', 'A luxurious and elegant silk skirt in a beautiful shade of green.', 460.00, 'Skirt.png', 'price_1PBXU6ES7LYlQ9KvclxvMHzj', 1, 1),
(9, 'Elegant Clutch', 'A sophisticated and stylish clutch perfect for a night out on the town.', 990.00, 'Clutch.png', 'price_1PBXVSES7LYlQ9KvXIQRcvlO', 3, 1),
(10, 'Day Heels', 'Comfortable yet stylish heels perfect for all-day wear.', 240.00, 'Heels.png', 'price_1PBWfvES7LYlQ9Kv0nULRTrR', 2, 1),
(11, 'Easy Scarf', 'A versatile and easy-to-wear scarf that adds a pop of color to any outfit.', 99.99, 'Scarf.png', 'price_1PBXX4ES7LYlQ9KvoOfNAARc', 3, 1),
(12, 'New Game Bundle', 'A bundle of popular and exciting games to keep you entertained for hours.', 300.00, 'Game.png', 'price_1PBXZZES7LYlQ9KvDYExPoNo', 4, 1),
(13, 'Special Tattos', 'Unique and trendy temporary tattoos to add a cool touch to your look.', 140.00, 'Tattoo.png', 'price_1PBXbLES7LYlQ9KvyUOQVbOK', 4, 1),
(14, 'Trendy Slippers', 'Stay stylish and yet comfortable with these trendy slippers.', 250.00, 'Slipper.png', 'price_1PBXcvES7LYlQ9KvpHCsDuMj', 2, 1),
(15, 'Shining Earrings', 'Sparkling and elegant earrings that add a touch of glamour to any outfit.', 600.00, 'Jewels.png', 'price_1PBXfKES7LYlQ9KvdUWBBvAy', 3, 1),
(16, 'Casual Hoodie', 'A comfortable and stylish hoodie perfect for lounging or running errands.', 120.00, 'Hoodie.png', 'price_1PBXh1ES7LYlQ9KvFrXUJH8R', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_review`
--

CREATE TABLE `product_review` (
  `id` int(11) NOT NULL,
  `review` varchar(255) NOT NULL,
  `rating` int(11) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `fk_user` int(11) NOT NULL,
  `fk_product` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `registered` timestamp NULL DEFAULT current_timestamp(),
  `user_img` varchar(250) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `fk_role` int(11) NOT NULL DEFAULT 1,
  `ban_expiry` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `fname`, `lname`, `email`, `adress`, `registered`, `user_img`, `password`, `fk_role`, `ban_expiry`) VALUES
(6, 'Ondrej', 'Hajek', 'admin@mail.com', 'NY City', '2024-04-23 22:00:00', 'no_user.jpg', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f', 2, NULL),
(10, 'Ondrej', 'Hajek', 'user@mail.com', 'Wien', '2024-04-30 12:26:47', 'no_user.jpg', '96cae35ce8a9b0244178bf28e4966c2ce1b8385723a96a6b838858cdd6ca0a1e', 1, NULL);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `product_review`
--
ALTER TABLE `product_review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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
  ADD CONSTRAINT `basket_ibfk_1` FOREIGN KEY (`fk_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `basket_ibfk_2` FOREIGN KEY (`fk_product`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `product_review_ibfk_1` FOREIGN KEY (`fk_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_review_ibfk_2` FOREIGN KEY (`fk_product`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`fk_role`) REFERENCES `user_role` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
