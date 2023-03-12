-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 12, 2023 at 04:46 PM
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
-- Database: `to-strand_bufe`
--
DROP DATABASE IF EXISTS `to-strand_bufe`;
CREATE DATABASE IF NOT EXISTS `to-strand_bufe` DEFAULT CHARACTER SET utf8 COLLATE utf8_hungarian_ci;
USE `to-strand_bufe`;
-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `user_data_id` int(11) NOT NULL,
  `payment_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  `delivery_address` varchar(70) COLLATE utf8_hungarian_ci NOT NULL,
  `time` datetime NOT NULL,
  `amount` decimal(13,2) NOT NULL,
  `comment` varchar(150) COLLATE utf8_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `delivery_id` int(11) NOT NULL,
  `products_id` int(11) NOT NULL,
  `quantity` tinyint(4) NOT NULL,
  `unit_price` decimal(13,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_method`
--

CREATE TABLE `payment_method` (
  `id` int(11) NOT NULL,
  `name` varchar(20) COLLATE utf8_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- Dumping data for table `payment_method`
--

INSERT INTO `payment_method` (`id`, `name`) VALUES
(1, 'bankkártya'),
(2, 'készpénz'),
(3, 'SZÉP');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `type` bit(2) NOT NULL,
  `nev` varchar(50) COLLATE utf8_hungarian_ci NOT NULL,
  `description` varchar(250) COLLATE utf8_hungarian_ci NOT NULL,
  `image` longblob NOT NULL,
  `unit_price` decimal(13,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `type`, `nev`, `description`, `image`, `unit_price`) VALUES
(1, 7, b'00', 'Soproni', '', '', '580.00'),
(2, 7, b'00', 'Soproni Mangó', '', '', '650.00'),
(3, 7, b'00', 'Soproni IPA', '', '', '650.00'),
(4, 7, b'00', 'Soproni APA', '', '', '650.00'),
(5, 7, b'00', 'Soproni Démon', '', '', '650.00'),
(6, 7, b'00', 'Soproni Búza', '', '', '650.00'),
(7, 7, b'00', 'Soproni Radler 0,0% Meggy-Citrom', '', '', '580.00'),
(8, 7, b'00', 'Soproni Radler 0,0% Bodza-Citrom', '', '', '580.00'),
(9, 7, b'00', 'Dreher', '', '', '580.00'),
(10, 7, b'00', 'Gösser NaturZitrone 0,0% Citrom', '', '', '580.00'),
(11, 7, b'00', 'Gösser NaturZitrone 0,0% Áfonya-Citrom', '', '', '580.00'),
(12, 7, b'00', 'Gösser NaturZitrone 0,0% Mangó-Citrom', '', '', '580.00'),
(13, 7, b'00', 'Gösser NaturZitrone 0,0% Dinnye-Lime', '', '', '580.00'),
(14, 7, b'00', 'Heineiken', '', '', '650.00'),
(15, 7, b'00', 'Heineiken 0,0%', '', '', '650.00'),
(16, 7, b'00', 'Heineiken Silver 0,3 dl', '', '', '600.00'),
(17, 7, b'00', 'Somersby Alma', '', '', '650.00'),
(18, 7, b'00', 'Somersby Körte', '', '', '650.00'),
(19, 8, b'00', 'Pepsi 0,5l', '', '', '590.00'),
(20, 8, b'00', 'Pepsi Max 0,5l', '', '', '590.00'),
(21, 8, b'00', 'Pepsi Max Mangó 0,5l', '', '', '590.00'),
(22, 8, b'00', 'Pepsi Max Lime 0,5l', '', '', '590.00'),
(23, 8, b'00', 'Pepsi Max Ananász-Menta 0,5l', '', '', '590.00'),
(24, 8, b'00', 'Schweppes Narancs 0,5l', '', '', '590.00'),
(25, 8, b'00', 'Schweppes Citruc 0,5l', '', '', '590.00'),
(26, 8, b'00', 'Schweppes Tonic 0,5l', '', '', '590.00'),
(27, 8, b'00', 'Lipton Citrom 0,5l', '', '', '590.00'),
(28, 8, b'00', 'Lipton Barack 0,5l', '', '', '590.00'),
(29, 8, b'00', 'Lipton Zöld 0,5l', '', '', '590.00'),
(30, 8, b'00', 'Canada Dry 0,5l', '', '', '590.00'),
(31, 8, b'00', 'Theodora szénsavmentes 0,5l', '', '', '400.00'),
(32, 8, b'00', 'Theodora szénsavas 0,5l', '', '', '400.00'),
(33, 1, b'01', 'Sima', '', '', '800.00'),
(34, 1, b'01', 'Sajtos', '', '', '1000.00'),
(35, 1, b'01', 'Tejfölös', '', '', '1000.00'),
(36, 1, b'01', 'Sajtos tejfölös', '', '', '1200.00'),
(37, 1, b'01', 'Sajtos tejfölös lilahagymás', '', '', '1350.00'),
(38, 1, b'01', 'Sajtos tejfölös paradicsomkarkikás', '', '', '1350.00'),
(39, 2, b'01', 'Csirke nuggets (10db) +öntet', '', '', '2200.00'),
(40, 2, b'01', 'Rántott csirkemell', '', '', '2500.00'),
(41, 2, b'01', 'Rántott szelet', '', '', '2500.00'),
(42, 2, b'01', 'Rántott sajt', '', '', '2400.00'),
(43, 2, b'01', 'Gyros tál', '', '', '2800.00'),
(44, 2, b'01', 'Hekk', '', '', '2000.00'),
(45, 3, b'01', 'Sima', '', '', '1300.00'),
(46, 3, b'01', 'Sajtburger', '', '', '1600.00'),
(47, 3, b'01', 'BBQ burger', '', '', '1500.00'),
(48, 3, b'01', 'Ördög burger', '', '', '1500.00'),
(49, 3, b'01', 'Vega burger', '', '', '1600.00'),
(50, 4, b'01', 'Sima', '', '', '650.00'),
(51, 4, b'01', 'Pirított hagymás', '', '', '750.00'),
(52, 4, b'01', 'Sajtos', '', '', '800.00'),
(53, 4, b'01', 'Sajtos-Pirított hagymás', '', '', '850.00'),
(54, 4, b'01', 'Zöldséges', '', '', '750.00'),
(55, 5, b'01', 'Hasábburgonya (kis adag)', '', '', '650.00'),
(56, 5, b'01', 'Hasábburgonya (nagy adag)', '', '', '900.00'),
(57, 5, b'01', 'Hagymakarika +öntet', '', '', '1400.00'),
(58, 5, b'01', 'Savanyúság (vegyes)', '', '', '750.00'),
(59, 5, b'01', 'Kenyér (2 szelet)', '', '', '250.00'),
(60, 9, b'01', 'Ketchup', '', '', '300.00'),
(61, 9, b'01', 'Majonéz', '', '', '300.00'),
(62, 9, b'01', 'Mustár', '', '', '300.00'),
(63, 9, b'01', 'BBQ szósz', '', '', '300.00'),
(64, 9, b'01', 'Tzatziki', '', '', '400.00'),
(65, 9, b'01', 'Fokhagymás tejföl', '', '', '400.00'),
(66, 9, b'01', 'Csípős öntet', '', '', '400.00'),
(67, 6, b'01', 'Lekváros palacsinta (2db)', '', '', '500.00'),
(68, 6, b'01', 'Kakaós palacsinta (2db)', '', '', '500.00'),
(69, 6, b'01', 'Túrós palacsinta (2db)', '', '', '500.00'),
(70, 6, b'01', 'Mogyorókrémes palacsinta (2db)', '', '', '500.00');

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

CREATE TABLE `product_category` (
  `id` int(11) NOT NULL,
  `type` bit(2) NOT NULL,
  `catname` varchar(30) COLLATE utf8_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- Dumping data for table `product_category`
--

INSERT INTO `product_category` (`id`, `type`, `catname`) VALUES
(1, b'01', 'lángos'),
(2, b'01', 'frissensültek'),
(3, b'01', 'hamburgerek'),
(4, b'01', 'hot-dogok'),
(5, b'01', 'köretek'),
(6, b'01', 'desszertek'),
(7, b'00', 'alkoholos'),
(8, b'00', 'üdítők'),
(9, b'01', 'öntetek');

-- --------------------------------------------------------

--
-- Table structure for table `residence`
--

CREATE TABLE `residence` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `residence_id` int(11) NOT NULL,
  `delivery_address` varchar(70) COLLATE utf8_hungarian_ci NOT NULL,
  `comment` varchar(150) COLLATE utf8_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `id` int(11) NOT NULL,
  `name` varchar(20) COLLATE utf8_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id`, `name`) VALUES
(1, 'megrendelve'),
(2, 'úton'),
(3, 'kiszállítva'),
(4, 'hiba');

-- --------------------------------------------------------

--
-- Table structure for table `town_name`
--

CREATE TABLE `town_name` (
  `id` int(11) NOT NULL,
  `name` varchar(20) COLLATE utf8_hungarian_ci NOT NULL,
  `postal_code` smallint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- Dumping data for table `town_name`
--

INSERT INTO `town_name` (`id`, `name`, `postal_code`) VALUES
(1, 'Bánk', 2653),
(2, 'Rétság', 2651),
(3, 'Tolmács', 2657),
(4, 'Nőtincs', 2610),
(5, 'Felsőpetény', 2611),
(6, 'Romhány', 2654),
(7, 'Szátok', 2656),
(8, 'Tereske', 2642);

-- --------------------------------------------------------

--
-- Table structure for table `user_data`
--

CREATE TABLE `user_data` (
  `id` int(11) NOT NULL,
  `residence_id` int(11) NOT NULL,
  `user_name` varchar(20) COLLATE utf8_hungarian_ci NOT NULL,
  `phone_number` varchar(20) COLLATE utf8_hungarian_ci NOT NULL,
  `email` varchar(35) COLLATE utf8_hungarian_ci NOT NULL,
  `password` varchar(40) COLLATE utf8_hungarian_ci NOT NULL,
  `permission` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- Dumping data for table `user_data`
--

INSERT INTO `user_data` (`id`, `residence_id`, `user_name`, `phone_number`, `email`, `password`, `permission`) VALUES
(1, 0, 'admin', '', '', 'd033e22ae348aeb5660fc2140aec35850c4da997', 0),
(2, 0, 'mari', '06706521527', 'mari@gmail.com', '5d95cb27f49aafe1eac579adf55ae18deeb49b8c', 1),
(3, 0, 'Lejonídász', '06206537912', 'lej@gmail.com', 'a7aea4f58f43c69ff05491d3dd910c54b7b20167', 1),
(4, 0, 'lep', '06206537562', 'lepe@gmail.com', '60b70045a2da90a01c7fcef43c257e96f84e883c', 1),
(5, 0, 'he', '06205337562', 'hehehe@gmail.com', '213bafb1f83eed432e5e115d25f9eff2b8f33960', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fiok_adatok_FK_idx` (`user_data_id`),
  ADD KEY `fiok_adatok_FK2_idx` (`user_data_id`),
  ADD KEY `rendeles_fiok_adatok_FK_idx` (`user_data_id`),
  ADD KEY `allapot_FK_idx` (`status_id`),
  ADD KEY `fizetesi_modszer_FK_idx` (`payment_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rendeles_FK_idx` (`delivery_id`),
  ADD KEY `ter,elel_FK_idx` (`products_id`);

--
-- Indexes for table `payment_method`
--
ALTER TABLE `payment_method`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kategoriak_FK_idx` (`category_id`);

--
-- Indexes for table `product_category`
--
ALTER TABLE `product_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `residence`
--
ALTER TABLE `residence`
  ADD PRIMARY KEY (`id`),
  ADD KEY `telepules_nev_FK_idx` (`residence_id`),
  ADD KEY `fiok_adatok_FK_idx` (`user_id`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `town_name`
--
ALTER TABLE `town_name`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_data`
--
ALTER TABLE `user_data`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_method`
--
ALTER TABLE `payment_method`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `product_category`
--
ALTER TABLE `product_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `residence`
--
ALTER TABLE `residence`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `town_name`
--
ALTER TABLE `town_name`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user_data`
--
ALTER TABLE `user_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `allapotk_FK` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fizetesi_modszer_FK` FOREIGN KEY (`payment_id`) REFERENCES `payment_method` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `order_ibfk_1` FOREIGN KEY (`user_data_id`) REFERENCES `user_data` (`id`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `lategoriak_FK` FOREIGN KEY (`products_id`) REFERENCES `product_category` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `rendeles_FK` FOREIGN KEY (`delivery_id`) REFERENCES `order` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `termekek_FK` FOREIGN KEY (`products_id`) REFERENCES `products` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `residence`
--
ALTER TABLE `residence`
  ADD CONSTRAINT `fiok_adatok_FK` FOREIGN KEY (`user_id`) REFERENCES `user_data` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `telepules_nev_FK` FOREIGN KEY (`residence_id`) REFERENCES `town_name` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
