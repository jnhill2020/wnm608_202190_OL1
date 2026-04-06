-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 06, 2026 at 03:25 AM
-- Server version: 11.8.6-MariaDB-log
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u443959289_products`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `category` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `description`, `image`, `category`) VALUES
(1, 'Chunky Crochet Sweater', 48.00, 'Cozy handmade crochet sweater', 'sweater.jpg', 'clothing'),
(2, 'Mini Bear Plushie', 22.00, 'Soft crochet plushie', 'bear.jpg', 'toys'),
(3, 'Soft Pink Beanie', 18.00, 'Warm crochet beanie', 'beanie.jpg', 'accessories'),
(4, 'Crochet Tote Bag', 30.00, 'Handmade tote bag', 'tote.jpg', 'bags'),
(5, 'Baby Booties', 15.00, 'Cute crochet baby shoes', 'booties.jpg', 'baby'),
(6, 'Crochet Blanket', 65.00, 'Soft cozy blanket', 'blanket.jpg', 'home'),
(7, 'Crochet Headband', 12.00, 'Stylish headband', 'headband.jpg', 'accessories'),
(8, 'Amigurumi Bunny', 25.00, 'Handmade bunny plush', 'bunny.jpg', 'toys'),
(9, 'Coffee Cozy', 10.00, 'Cup holder cozy', 'cozy.jpg', 'home'),
(10, 'Crochet Scarf', 20.00, 'Warm winter scarf', 'scarf.jpg', 'clothing'),
(11, 'Crochet Pillow', 35.00, 'Decorative pillow', 'pillow.jpg', 'home'),
(12, 'Crochet Keychain', 8.00, 'Small cute keychain', 'keychain.jpg', 'accessories');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
