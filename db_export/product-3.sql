-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 26, 2024 at 01:02 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

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
(1, 'Fashion Boots', 'Stylish and versatile boots perfect for any outfit or occasion.', 99.00, 'Boots.png', 2, 1),
(2, 'Blue Marine Jumpsuit', 'A chic and comfortable jumpsuit perfect for a day at the beach or a night out.', 250.00, 'Overall.png', 1, 1),
(3, 'Beach Side Festival', 'A fun and colorful collection of beach festival in the sand.', 499.99, 'Beach.png', 4, 1),
(4, 'White Sunglasses', 'Stay cool and stylish with these trendy white sunglasses.', 180.00, 'Sunglasses.png', 3, 1),
(5, 'Personal Trainer', 'Get in shape and reach your fitness goals with the help of a dedicated personal trainer.', 120.00, 'Sport.png', 4, 1),
(6, 'Oversize Trenchcoat', 'Stay warm and stylish in this trendy oversize trenchcoat.', 270.00, 'Trenchcoat.png', 1, 1),
(7, 'Black Pumps', 'Classic and elegant black pumps that can elevate any outfit.', 199.99, 'Pumps.png', 2, 1),
(8, 'Green Silk Skirt', 'A luxurious and elegant silk skirt in a beautiful shade of green.', 460.00, 'Skirt.png', 1, 1),
(9, 'Elegant Clutch', 'A sophisticated and stylish clutch perfect for a night out on the town.', 990.00, 'Clutch.png', 3, 1),
(10, 'Day Heels', 'Comfortable yet stylish heels perfect for all-day wear.', 240.00, 'Heels.png', 2, 1),
(11, 'Easy Scarf', 'A versatile and easy-to-wear scarf that adds a pop of color to any outfit.', 99.99, 'Scarf.png', 3, 1),
(12, 'New Game Bundle', 'A bundle of popular and exciting games to keep you entertained for hours.', 300.00, 'Game.png', 4, 1),
(13, 'Special Tattos', 'Unique and trendy temporary tattoos to add a cool touch to your look.', 140.00, 'Tattoo.png', 4, 1),
(14, 'Trendy Slippers', 'Stay stylish and yet comfortable with these trendy slippers.', 250.00, 'Slipper.png', 2, 1),
(15, 'Shining Earrings', 'Sparkling and elegant earrings that add a touch of glamour to any outfit.', 600.00, 'Jewels.png', 3, 1),
(16, 'Casual Hoodie', 'A comfortable and stylish hoodie perfect for lounging or running errands.', 120.00, 'Hoodie.png', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_type` (`fk_type`),
  ADD KEY `fk_status` (`fk_status`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`fk_type`) REFERENCES `product_type` (`id`),
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`fk_status`) REFERENCES `product_status` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;