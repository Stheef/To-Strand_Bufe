-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 26, 2023 at 07:29 PM
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
-- Table structure for table `delivery_address`
--

CREATE TABLE `delivery_address` (
  `id` int(11) NOT NULL,
  `town_name_id` int(11) NOT NULL,
  `user_data_id` int(11) NOT NULL,
  `address` varchar(70) COLLATE utf8_hungarian_ci NOT NULL,
  `comment` varchar(250) COLLATE utf8_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `user_data_id` int(11) NOT NULL,
  `payment_method_id` int(11) NOT NULL,
  `order_status_id` int(11) NOT NULL,
  `address` tinytext COLLATE utf8_hungarian_ci NOT NULL,
  `time` datetime NOT NULL,
  `amount` int(11) NOT NULL,
  `comment` varchar(500) COLLATE utf8_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `products_id` int(11) NOT NULL,
  `quantity` tinyint(4) NOT NULL,
  `unit_price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_status`
--

CREATE TABLE `order_status` (
  `id` int(11) NOT NULL,
  `name` varchar(20) COLLATE utf8_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- Dumping data for table `order_status`
--

INSERT INTO `order_status` (`id`, `name`) VALUES
(1, 'megrendelve'),
(2, 'úton'),
(3, 'kiszállítva'),
(4, 'hiba');

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
  `name` varchar(50) COLLATE utf8_hungarian_ci NOT NULL,
  `description` varchar(250) COLLATE utf8_hungarian_ci NOT NULL,
  `image` varchar(50) COLLATE utf8_hungarian_ci NOT NULL,
  `unit_price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `description`, `image`, `unit_price`) VALUES
(1, 7, 'Soproni', '4,5%-os, világos sör.', '20230328235318.jpg', 580),
(4, 7, 'Soproni APA', 'Az APA-t egy keserűbb, férfiasabb alapkarakter jellemzi, magasabb, 5,5%-os alkoholfokkal.', '20230328235339.jpg', 650),
(5, 7, 'Soproni Démon', '5,2%-os barna sör.', '20230328235347.jpg', 650),
(6, 7, 'Soproni Búza', '5%-os, igazán karakteres, citrusos, belga típusú búzasör.', '20230328235400.png', 650),
(7, 7, 'Soproni Radler 0,0% Meggy-Citrom', 'Teljesen alkoholmentes, meggy-citrom ízesített sörital.', '20230328235407.png', 580),
(8, 7, 'Soproni Radler 0,0% Bodza-Citrom', 'Teljesen alkoholmentes, bodza-citrom ízesített sörital.', '20230328235416.jpg', 580),
(9, 7, 'Dreher', '5%-os világos sör.', '20230328235425.jpg', 580),
(10, 7, 'Gösser NaturZitrone 0,0% Citrom', 'Teljesen alkoholmentes, citrom ízesített sörital.', '20230328235457.jpg', 580),
(11, 7, 'Gösser NaturZitrone 0,0% Áfonya-Citrom', 'Teljesen alkoholmentes, áfonya-citrom ízesített sörital.', '20230328235512.png', 580),
(12, 7, 'Gösser NaturZitrone 0,0% Mangó-Citrom', 'Teljesen alkoholmentes, mangó-citrom ízesített sörital.', '20230328235521.png', 580),
(13, 7, 'Gösser NaturZitrone 0,0% Dinnye-Lime', 'Teljesen alkoholmentes, dinnye-lime ízesített sörital.', '20230328235533.png', 580),
(14, 7, 'Heineiken', '5%-os világos sör.', '20230328235554.jpg', 650),
(15, 7, 'Heineiken 0,0%', 'Az eredeti Heineken ízvilág, teljesen alkoholmentes kivitelben.', '20230328235610.jpg', 650),
(16, 7, 'Heineiken Silver 0,3 dl', '4%-os, könnyen iható, premium lager sör.', '20230328235621.jpg', 600),
(17, 7, 'Somersby Alma', '4%-os alkohol tartalmú, almás cider.', '20230328235630.jpg', 650),
(18, 7, 'Somersby Körte', '4%-os alkohol tartalmú, körtés cider.', '20230328235635.png', 650),
(19, 8, 'Pepsi 0,5l', 'Szénsavas, cola ízű üdítőital.', '20230328235738.jpg', 590),
(20, 8, 'Pepsi Max 0,5l', 'Szénsavas, cukormentes cola.', '20230328235748.jpg', 590),
(21, 8, 'Pepsi Max Mangó 0,5l', 'Szénsavas, mangó ízesített cola. Cukormentes.', '20230328235758.jpg', 590),
(22, 8, 'Pepsi Max Lime 0,5l', 'Szénsavas, lime ízesített cola. Cukormentes.', '20230328235833.png', 590),
(23, 8, 'Pepsi Max Ananász-Menta 0,5l', 'Szénsavas, ananász-menta ízesített cola. Cukormentes.', '20230328235849.jpg', 590),
(24, 8, 'Schweppes Narancs 0,5l', 'Szénsavas, narancs ízű üdítőital.', '20230328235859.jpg', 590),
(25, 8, 'Schweppes Citruc 0,5l', 'Szénsavas, citrus-mix ízű üdítőital.', '20230328235915.jpg', 590),
(26, 8, 'Schweppes Tonic 0,5l', 'Szénsavas, tonic ital.', '20230328235923.png', 590),
(27, 8, 'Lipton Citrom 0,5l', 'Citrom ízű jeges tea.', '20230328235933.png', 590),
(28, 8, 'Lipton Barack 0,5l', 'Barack ízű jeges tea.', '20230328235942.png', 590),
(29, 8, 'Lipton Zöld 0,5l', 'Zöld tea alapú jeges tea.', '20230328235951.jpg', 590),
(30, 8, 'Canada Dry 0,5l', 'Szénsavas, gyömbér ízű üdítőital.', '20230329000000.jpg', 590),
(31, 8, 'Theodora szénsavmentes 0,5l', 'Szénsavmentes ásványvíz.', '20230329000010.jpg', 400),
(32, 8, 'Theodora szénsavas 0,5l', 'Szénsavas ásványvíz.', '20230329000017.jpg', 400),
(33, 1, 'Sima lángos', 'Sima, frissen sült lángosunk, enyhén fokhagymázva.', '20230328230814.png', 800),
(35, 1, 'Tejfölös lángos', 'Tejföllel megkent lángosunk, enyhén fokhagymázva.', '20230328231358.jpg', 1000),
(36, 1, 'Sajtos tejfölös lángos', 'Sajttal és tejföllel kínált lángosunk, enyhén fokhagymázva.', '20230328231415.jpg', 1200),
(37, 1, 'Sajtos tejfölös lilahagymás lángos', 'Sajttal, tejföllel és még lilahagyma karikákkal szolgált lángosunk, enyhén fokhagymázva.', '20230328231448.jpg', 1350),
(39, 2, 'Csirke nuggets (10db) +öntet', 'Csirkemellből készült falatkáinkat ajándék öntettel szállítjuk.', '20230328235246.jpg', 2200),
(40, 2, 'Rántott csirkemell', 'Friss, valódi csirkemellből készítve. Csakis rendelésre sütve.', '20230328231543.jpg', 2500),
(41, 2, 'Rántott szelet', 'Friss, valódi karajból készítve. Csakis rendelésre sütve.', '20230328231608.jpg', 2500),
(42, 2, 'Rántott sajt', 'Trappista sajtból készítve, igazán nyúlós és finom ízélmény minden sajtkedvelőnek.', '20230328231623.jpg', 2400),
(43, 2, 'Gyros tál', 'Gyros tálunk csirkemell és csirkecomb húsokból készül, frissen sült hasábburgonyával, emellé salátával és tzatziki öntettel.', '20230328231643.png', 2800),
(44, 2, 'Hekk', '30-40 dkg közötti súlyúak, mindig frissen panírozva és sütve.', '20230328231657.png', 2000),
(45, 3, 'Sima hamburger', 'Sima, tradicionális hamburgerünk tartalmaz húst, salátát, paradicsomot, uborkát és hagymát. Valamint saját hamburger öntetünket.', '20230328235254.jpg', 1300),
(46, 3, 'Sajtburger', 'Sajtburgerünk ugyanazon alapanyagokkal rendelkezik mint sima hamburgerünk, szimplán olvasztott sajttal pluszban.', '20230328231721.jpg', 1600),
(47, 3, 'BBQ burger', 'Házi szószunk helyett füstös, barna cukros BBQ szósz, és olvasztott sajt található a hamburgerben.', '20230328231731.jpg', 1500),
(48, 3, 'Ördög burger', 'Házi csípős szószunk és plusz sajt van extraként ebben a burgerben. Nagyon csíp, rendelés előtt ezzel minden vendégünk legyen tisztában!', '20230328231749.jpg', 1500),
(49, 3, 'Vega burger', 'Kézműves hamburger, növényi alapú pogácsával.', '20230328231757.jpg', 1600),
(50, 4, 'Sima hot-dog', 'Sima, virslis Hot-dogunk fehér kiflivel és mindhárom szósszal készül.', '20230328231817.jpg', 650),
(51, 4, 'Pirított hagymás hot-dog', 'Hagyományos hot-dogunk pirított hagyma darabokkal tálalva.', '20230328231827.jpg', 750),
(52, 4, 'Sajtos hot-dog', 'Hot-dogunkra plusz sajtot olvasztottunk, az igazán finomra vágyók kedvéért.', '20230328231836.jpg', 800),
(54, 4, 'Zöldséges hot-dog', 'Hot-dogunk a virsli és 3 szósz mellé uborka, paradicsom és hagyma darabokat kap tetejére.\r\nFIGYELEM, TERMÉKÜNK HÚST TARTALMAZ, A NEVE A FELTÉTRE VONATKOZIK!', '20230328231859.jpg', 750),
(55, 5, 'Hasábburgonya (kis adag)', 'Frissen készült hasábburgonyánkat enyhén sózzuk.\r\nKis adagunk körülbelül 130 gramm.', '20230328231911.jpg', 650),
(56, 5, 'Hasábburgonya (nagy adag)', 'Frissen készült hasábburgonyánkat enyhén sózzuk.\r\nNagy adagunk körülbelül 180 gramm.', '20230328231921.jpg', 900),
(57, 5, 'Hagymakarika +öntet', 'Friss, sörbundában panírozott hagymakarikáinkat ajándék tzatziki-s mártogatóssal szállítjuk.', '20230328231930.jpg', 1400),
(58, 5, 'Savanyúság (vegyes)', 'Vegyes savanyúság. Csalamádé, kovászos uborka, almapaprika.', '20230328235300.jpg', 750),
(59, 5, 'Kenyér (2 szelet)', 'Friss, fehér kenyér.', '20230328231946.jpg', 250),
(60, 9, 'Ketchup', 'Univer márkájú ketchup.', '20230328232900.jpg', 300),
(61, 9, 'Majonéz', 'Univer márkájú majonéz.', '20230328232909.jpg', 300),
(62, 9, 'Mustár', 'Univer márkájú mustár.', '20230328233005.jpg', 300),
(63, 9, 'BBQ szósz', 'Univer márkájú BBQ szósz.', '20230328232929.jpg', 300),
(64, 9, 'Tzatziki', 'Házi készítésű tzatziki öntet.', '20230328232938.jpg', 400),
(65, 9, 'Fokhagymás tejföl', 'Házi készítésű fokhagymás tejföl.', '20230328232943.jpg', 400),
(66, 9, 'Csípős öntet', 'Házi készítésű csípős öntetünk. Többek között chili-cseppeket, Marha erős öntetet, és darált chili-pelyheket IS tartalmaz.', '20230328232947.jpg', 400),
(67, 6, 'Lekváros palacsinta (2db)', 'Frissen sült palacsintáinkat házi sárgabarack lekvárral kenjük meg.', '20230328232007.jpg', 500),
(68, 6, 'Kakaós palacsinta (2db)', 'Frissen sült palacsintáinkat porcukros kakaóval szórjuk meg.', '20230328232016.jpeg', 500),
(69, 6, 'Túrós palacsinta (2db)', 'Frissen sült palacsintáinkat túró és porcukor alapú készítménnyel kenjük meg.', '20230328232026.jpg', 500),
(70, 6, 'Mogyorókrémes palacsinta (2db)', 'Frissen sült palacsintáinkat mogyorókrémmel kenjük meg.', '20230328232036.jpg', 500);

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
(3, 'Felsőpetény', 2611),
(4, 'Romhány', 2654),
(5, 'Tolmács', 2657),
(6, 'Szátok', 2656),
(7, 'Tereske', 2652),
(8, 'Nőtincs', 2610);

-- --------------------------------------------------------

--
-- Table structure for table `user_data`
--

CREATE TABLE `user_data` (
  `id` int(11) NOT NULL,
  `user_name` varchar(20) COLLATE utf8_hungarian_ci NOT NULL,
  `phone_number` varchar(20) COLLATE utf8_hungarian_ci NOT NULL,
  `email` varchar(35) COLLATE utf8_hungarian_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_hungarian_ci NOT NULL,
  `permission` tinyint(1) NOT NULL,
  `is_confirmed` tinyint(1) NOT NULL,
  `confirm_code` varchar(32) COLLATE utf8_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- Dumping data for table `user_data`
--

INSERT INTO `user_data` (`id`, `user_name`, `phone_number`, `email`, `password`, `permission`, `is_confirmed`, `confirm_code`) VALUES
(1, 'admin', '', '', '$2y$10$IfxfqeB7aciTWzwcI5XQX.ebdybVyoW6y2lx8VcT90nmhMNUA/YJ.', 0, 0, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `delivery_address`
--
ALTER TABLE `delivery_address`
  ADD PRIMARY KEY (`id`),
  ADD KEY `town_name_id` (`town_name_id`),
  ADD KEY `user_data_id` (`user_data_id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_data_id` (`user_data_id`),
  ADD KEY `payment_method_id` (`payment_method_id`),
  ADD KEY `order_status_id` (`order_status_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `delivery_address_id` (`order_id`),
  ADD KEY `products_id` (`products_id`);

--
-- Indexes for table `order_status`
--
ALTER TABLE `order_status`
  ADD PRIMARY KEY (`id`);

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
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `product_category`
--
ALTER TABLE `product_category`
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
-- AUTO_INCREMENT for table `delivery_address`
--
ALTER TABLE `delivery_address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
-- AUTO_INCREMENT for table `order_status`
--
ALTER TABLE `order_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `payment_method`
--
ALTER TABLE `payment_method`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `product_category`
--
ALTER TABLE `product_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `town_name`
--
ALTER TABLE `town_name`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user_data`
--
ALTER TABLE `user_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `delivery_address`
--
ALTER TABLE `delivery_address`
  ADD CONSTRAINT `delivery_address_ibfk_1` FOREIGN KEY (`town_name_id`) REFERENCES `town_name` (`id`),
  ADD CONSTRAINT `delivery_address_ibfk_2` FOREIGN KEY (`user_data_id`) REFERENCES `user_data` (`id`);

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_ibfk_1` FOREIGN KEY (`order_status_id`) REFERENCES `order_status` (`id`),
  ADD CONSTRAINT `order_ibfk_2` FOREIGN KEY (`payment_method_id`) REFERENCES `payment_method` (`id`),
  ADD CONSTRAINT `order_ibfk_3` FOREIGN KEY (`user_data_id`) REFERENCES `user_data` (`id`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`products_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `product_category` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
