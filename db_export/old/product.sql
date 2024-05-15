-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 25, 2024 at 09:34 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4
--
-- Dumping data for table `product`
--
INSERT INTO
  `product` (
    `id`,
    `name`,
    `description`,
    `price`,
    `img`,
    `fk_type`,
    `fk_status`
  )
VALUES
  (
    1,
    'Fashion Boots',
    'Stylish and versatile boots perfect for any outfit or occasion.',
    99.00,
    'Boots.png',
    2,
    1
  ),
  (
    2,
    'Blue Marine Jumpsuit',
    'A chic and comfortable jumpsuit perfect for a day at the beach or a night out.',
    250.00,
    'Overall.png',
    1,
    1
  ),
  (
    3,
    'Beach Side Festival',
    'A fun and colorful collection of beach festival in the sand.',
    499.99,
    'Beach.png',
    4,
    1
  ),
  (
    4,
    'White Sunglasses',
    'Stay cool and stylish with these trendy white sunglasses.',
    180.00,
    'Sunglasses.png',
    3,
    1
  ),
  (
    5,
    'Personal Trainer',
    'et in shape and reach your fitness goals with the help of a dedicated personal trainer.',
    120.00,
    'Sport.png',
    4,
    1
  ),
  (
    6,
    'Oversize Trenchcoat',
    'Stay warm and stylish in this trendy oversize trenchcoat.',
    270.00,
    'Trenchcoat.png',
    1,
    1
  ),
  (
    7,
    'Black Pumps',
    'Classic and elegant black pumps that can elevate any outfit.',
    199.99,
    'Pumps.png',
    2,
    1
  ),
  (
    8,
    'Green Silk Skirt',
    'A luxurious and elegant silk skirt in a beautiful shade of green.',
    460.00,
    'Skirt.png',
    1,
    1
  ),
  (
    9,
    'Elegant Clutch',
    'A sophisticated and stylish clutch perfect for a night out on the town.',
    990.00,
    'Clutch.png',
    3,
    1
  ),
  (
    10,
    'Day Heels',
    'Comfortable yet stylish heels perfect for all-day wear.',
    240.00,
    'Heels.png',
    2,
    1
  ),
  (
    11,
    'Easy Scarf',
    'A versatile and easy-to-wear scarf that adds a pop of color to any outfit.',
    99.99,
    'Scarf.png',
    3,
    1
  ),
  (
    12,
    'New Game Bundle',
    'A bundle of popular and exciting games to keep you entertained for hours.',
    300.00,
    'Game.png',
    4,
    1
  ),
  (
    13,
    'Special Tattos',
    'Unique and trendy temporary tattoos to add a cool touch to your look.',
    140.00,
    'Tattoo.png',
    4,
    1
  ),
  (
    14,
    'Trendy Slippers',
    'Stay stylish and yet comfortable with these trendy slippers.',
    250.00,
    'Slipper.png',
    2,
    1
  ),
  (
    15,
    'Shining Earrings',
    'Sparkling and elegant earrings that add a touch of glamour to any outfit.',
    600.00,
    'Jewels.png',
    3,
    1
  ),
  (
    16,
    'Casual Hoodie',
    'A comfortable and stylish hoodie perfect for lounging or running errands.',
    120.00,
    'Hoodie.png',
    1,
    1
  );