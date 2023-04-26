-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 26, 2023 at 07:18 PM
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

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id`, `user_data_id`, `payment_method_id`, `order_status_id`, `address`, `time`, `amount`, `comment`) VALUES
(3, 21, 1, 3, '2653 Bánk, Rózsafa utca 23', '2023-06-03 15:00:00', 78900, ''),
(4, 21, 2, 3, '2653 Bánk, Rózsafa utca 23', '2023-06-07 14:00:00', 37500, ''),
(5, 21, 1, 3, '2653 Bánk, Rózsafa utca 23', '2023-06-10 13:00:00', 26100, ''),
(6, 21, 1, 3, '2653 Bánk, Jázmin utca 13', '2023-06-11 12:00:00', 43800, ''),
(7, 21, 1, 3, '2653 Bánk, Napsugár utca 3', '2023-06-14 18:00:00', 56400, ''),
(8, 21, 1, 3, '2653 Bánk, Napsugár utca 5', '2023-06-18 16:00:00', 41200, ''),
(9, 21, 1, 3, '2653 Bánk, Jázmin utca 5', '2023-06-19 17:00:00', 34000, ''),
(10, 21, 1, 3, '2653 Bánk, Kis utca 6', '2023-06-21 19:00:00', 78900, ''),
(11, 21, 1, 3, '2653 Bánk, Kis utca 6', '2023-06-25 20:00:00', 31500, ''),
(12, 21, 1, 3, '2656 Szátok, Karinthy utca 26', '2023-06-29 21:00:00', 75400, ''),
(13, 22, 2, 1, '2654 Romhány, Karinthy utca 12', '2023-04-15 18:27:15', 3660, 'Szalvétát kérek mellé'),
(14, 22, 1, 2, '2610 Nőtincs, Szátok utca 26', '2023-04-15 18:29:52', 9200, ''),
(15, 22, 1, 1, '2657 Tolmács, Tolmács utca 12', '2023-04-15 18:32:01', 5500, ''),
(16, 22, 2, 1, '2653 Bánk, Teszt utca 12', '2023-04-15 18:32:32', 9200, 'Teszt'),
(17, 22, 3, 1, '2651 Rétság, Teszt utca 22 (megj: Gyorsan kérem!)', '2023-04-15 18:37:52', 8700, 'A földes úton az első lehetőségnél balra'),
(18, 22, 3, 1, ' Rétság, Teszt utca 22 (megj: Teszt)', '2023-04-15 18:44:48', 5500, 'teszt'),
(19, 22, 3, 1, ' Rétság, Heble utca 22 (megj: teszt)', '2023-04-15 18:45:52', 5500, ''),
(20, 22, 2, 1, '2611 Felsőpetény, Kerek utca 22', '2023-04-15 19:09:56', 10200, ''),
(21, 22, 2, 1, '2651 Rétság, Kerek utca 22 (megj: teszt szoveg)', '2023-04-15 19:11:08', 9700, ''),
(22, 22, 1, 1, '2611 Felsőpetény, Hajnalka utca 22', '2023-04-15 19:41:06', 11780, ''),
(23, 22, 2, 1, '2653 Bánk, Teszt utca 23', '2023-04-15 19:41:56', 5380, ''),
(25, 22, 2, 1, '2651 Rétság, Fergeteg utca 13', '2023-04-15 19:48:37', 4390, ''),
(26, 22, 2, 1, '2611 Felsőpetény, Teszt utca 23', '2023-04-15 19:49:30', 4890, ''),
(27, 22, 1, 1, '2611 Felsőpetény, Halott utca 21', '2023-04-15 21:12:16', 4040, ''),
(28, 22, 3, 1, '2611 Felsőpetény, Heble utca 22', '2023-04-15 21:15:01', 3550, ''),
(29, 22, 1, 1, '2611 Felsőpetény, Heble utca 22', '2023-04-15 21:29:08', 3600, ''),
(31, 22, 1, 1, '2611 Felsőpetény, Heble utca 22', '2023-04-15 21:32:46', 2900, ''),
(32, 22, 2, 1, '2651 Rétság, Heble utca 22', '2023-04-15 21:35:15', 3300, ''),
(33, 22, 1, 1, '2653 Bánk, Teszt út 14', '2023-04-15 21:35:49', 900000, ''),
(34, 22, 2, 1, '2611 Felsőpetény, Hajnalka utca 22', '2023-04-15 22:12:16', 4580, ''),
(35, 22, 3, 1, '2653 Bánk, Kórus utca 22', '2023-04-15 23:35:33', 3850, 'Csak tízezressel tudok fizetni'),
(36, 22, 3, 1, '2611 Felsőpetény, Halott utca 22 (megj: 2. ajtó)', '2023-04-15 23:36:23', 5350, ''),
(37, 22, 1, 1, '2653 Bánk, Hajnalka utca 22', '2023-04-15 23:37:11', 1980, ''),
(38, 22, 1, 1, '2651 Rétság, Fő út 65', '2023-04-16 00:37:09', 2160, ''),
(39, 22, 2, 1, '2651 Rétság, Lehet utca 54', '2023-04-16 00:37:44', 4800, ''),
(40, 22, 1, 1, '2651 Rétság, Kerék út 32', '2023-04-16 00:42:57', 6600, ''),
(41, 22, 1, 1, '2651 Rétság, Szerencse utca 12', '2023-04-16 00:43:30', 2500, ''),
(42, 22, 1, 1, '2651 Rétság, Liszt Ferenc utca 12', '2023-04-16 01:39:05', 19900, ''),
(43, 22, 1, 1, '2653 Bánk, Hatalmas utca 22', '2023-04-16 01:41:31', 18000, ''),
(44, 22, 3, 1, '2654 Romhány, Balassagyarmati út 122', '2023-04-16 01:43:32', 13870, ''),
(45, 22, 2, 1, '2653 Bánk, Remete utca 12', '2023-04-16 11:52:20', 1000, ''),
(46, 22, 1, 1, '2651 Rétság, Retek utca 75', '2023-04-17 10:53:21', 7150, ''),
(47, 22, 1, 1, '2651 Rétság, Teszt út 12', '2023-04-17 10:53:24', 7150, ''),
(48, 22, 1, 1, '2651 Rétság, Hello út', '2023-04-17 19:25:04', 3780, 'teszt szoveg'),
(49, 22, 2, 1, '2653 Bánk, Teszt utca(megj: teszt szoveg)', '2023-04-17 19:43:44', 1200, 'Teszt szoveg'),
(50, 50, 2, 3, '2654 Romhány, Balogh utca 65. (megj: B épület, 2. emelet)', '2023-04-19 22:08:56', 16680, 'Gyorsan szeretném kérni az ételt!'),
(51, 50, 2, 1, '2611 Felsőpetény, Teszt 17 (megj: teszt)', '2023-04-19 22:15:51', 4000, ''),
(52, 50, 2, 1, '2651 Rétság, Úri út (megj: traktor mellet vagyok)', '2023-04-19 22:18:16', 5000, ''),
(53, 52, 2, 1, '2611 Felsőpetény, Petény út', '2023-04-19 22:19:46', 5500, ''),
(54, 52, 2, 4, '2654 Romhány, Petőfi út 65 (megj: Sándor laktanya melletti ház)', '2023-04-19 22:46:12', 3330, ''),
(55, 56, 1, 2, '2656 Szátok, Szátocska 25 (megj: Vegso teszt)', '2023-04-26 18:54:22', 6490, 'Tesztelem a kommentet'),
(56, 56, 3, 1, '2653 Bánk, Napsugár utca 17.', '2023-04-26 19:00:02', 48400, ''),
(57, 56, 1, 3, '2653 Bánk, Bánya utca 19', '2023-04-26 19:11:57', 14320, ''),
(58, 56, 2, 3, '2653 Bánk, Bánya utca 19', '2023-04-26 19:13:16', 14000, '');

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

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `products_id`, `quantity`, `unit_price`) VALUES
(7, 13, 40, 1, 2500),
(8, 13, 8, 1, 580),
(9, 13, 7, 1, 580),
(10, 14, 70, 1, 500),
(11, 14, 39, 2, 2200),
(12, 14, 43, 1, 2800),
(13, 15, 70, 1, 500),
(14, 15, 39, 2, 2200),
(15, 15, 43, 1, 2800),
(16, 16, 70, 1, 500),
(17, 16, 39, 2, 2200),
(18, 16, 43, 1, 2800),
(19, 17, 70, 1, 500),
(20, 17, 39, 2, 2200),
(21, 17, 43, 1, 2800),
(22, 18, 70, 1, 500),
(23, 18, 39, 2, 2200),
(24, 18, 43, 1, 2800),
(25, 19, 70, 1, 500),
(26, 19, 39, 2, 2200),
(27, 19, 43, 1, 2800),
(28, 20, 70, 3, 500),
(29, 20, 39, 2, 2200),
(30, 20, 43, 1, 2800),
(31, 21, 70, 3, 500),
(32, 21, 39, 2, 2200),
(33, 21, 43, 1, 2800),
(34, 22, 39, 2, 2200),
(35, 22, 43, 1, 2800),
(36, 22, 46, 1, 1600),
(37, 22, 56, 1, 900),
(38, 22, 10, 1, 580),
(39, 23, 29, 1, 590),
(40, 23, 57, 3, 1400),
(41, 23, 21, 1, 590),
(42, 25, 58, 1, 750),
(43, 25, 24, 1, 590),
(44, 25, 70, 1, 500),
(45, 25, 14, 1, 650),
(46, 25, 56, 1, 900),
(47, 26, 58, 1, 750),
(48, 26, 24, 1, 590),
(49, 26, 70, 1, 500),
(50, 26, 14, 1, 650),
(51, 26, 56, 1, 900),
(52, 27, 15, 1, 650),
(53, 27, 25, 1, 590),
(54, 27, 45, 1, 1300),
(55, 28, 56, 1, 900),
(56, 28, 67, 1, 500),
(57, 28, 55, 1, 650),
(58, 29, 36, 1, 1200),
(59, 29, 56, 1, 900),
(63, 31, 57, 1, 1400),
(64, 32, 56, 1, 900),
(65, 32, 57, 1, 1400),
(66, 33, 54, 1, 750),
(67, 33, 17, 1, 650),
(68, 34, 40, 1, 2500),
(69, 34, 9, 1, 580),
(70, 35, 37, 1, 1350),
(71, 35, 41, 1, 2500),
(72, 36, 37, 1, 1350),
(73, 36, 41, 1, 2500),
(74, 37, 51, 1, 750),
(75, 37, 55, 1, 650),
(76, 37, 13, 1, 580),
(77, 38, 10, 2, 580),
(78, 39, 39, 1, 2200),
(79, 39, 49, 1, 1600),
(80, 40, 43, 2, 2800),
(81, 41, 47, 1, 1500),
(83, 43, 36, 15, 1200),
(84, 44, 43, 3, 2800),
(85, 44, 20, 1, 590),
(86, 44, 8, 1, 580),
(87, 44, 32, 1, 400),
(88, 44, 42, 1, 2400),
(89, 45, 59, 1, 250),
(90, 45, 58, 1, 750),
(91, 49, 32, 3, 400),
(92, 50, 8, 11, 580),
(93, 50, 64, 2, 400),
(94, 50, 41, 3, 2500),
(96, 51, 41, 1, 2500),
(97, 52, 40, 1, 2500),
(98, 52, 47, 1, 1500),
(99, 53, 58, 1, 750),
(100, 53, 54, 1, 750),
(101, 53, 40, 1, 2500),
(102, 54, 24, 1, 590),
(103, 54, 10, 3, 580),
(104, 55, 35, 2, 1000),
(105, 55, 33, 1, 800),
(106, 55, 19, 1, 590),
(107, 55, 32, 4, 400),
(108, 56, 43, 9, 2800),
(109, 56, 44, 8, 2000),
(110, 56, 36, 6, 1200),
(111, 57, 44, 6, 2000),
(112, 57, 10, 4, 580),
(113, 58, 44, 7, 2000);

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
(1, 'admin', '', '', '$2y$10$IfxfqeB7aciTWzwcI5XQX.ebdybVyoW6y2lx8VcT90nmhMNUA/YJ.', 0, 0, ''),
(4, 'admin2', '', '', '$2y$10$IvjY53/iWvIkqSYX3KCBQuHA9XcsTF8jPsdN2g6BO1PI8gTudW/9y', 2, 0, ''),
(21, 'yunalai99', '+36704253607', 'qiyanalvl7@gmail.com', '$2y$10$NfQxgc.daJBlg7m2s1uQOuCIyHVLJokPZIzPT.P/.WzM7v93B4Tky', 1, 1, '4ce4c67dee272928d07f1cc047b7d346'),
(22, 'iman01', '+36701243256', 'ashelvl7@gmail.com', '$2y$10$o62.spPPT08SWeMsIJ8wU./II4kO6ghz9Zx8xBO2bazOkfvWhbLuO', 1, 1, '82c84d7f0c7939c2da38d49d38ff7649'),
(48, 'VorMark', '+36706216543', 'vmark1111@gmail.com', '$2y$10$UhtBjLZRMDtlBl6GYPztvOYA73an5IM5tvujgETyooxh.jGJctg3K', 1, 1, 'b5f02813cdcc47d1929b7bc52eb0cb32'),
(50, 'Stheef', '+36706216554', 'vetromark33@gmail.com', '$2y$10$38RPUnpMAU5UAtXx4WelY.DBTdY4ZTw1iDH2hUzvjnNiRR8mXQhHC', 1, 1, 'ef575bf381c138e54c81a6fb2f8438b3'),
(52, 'traktorosjozsi', '+36705321253', 'traktorosjozsi12@gmail.com', '$2y$10$ZIblMLn98fYMUNTyPBpZ9OIfakbPDBy/gYAFeckKTOt3IbI/JWebC', 1, 1, 'f93e712fba823e0b8f33538c688578d5'),
(53, 'palackosmari', '+36704312543', 'palackosch72@gmail.com', '$2y$10$Ecyg1ZeSwq2s7ID.qjwOD.51SbG6p4QnW7yy0kCxzpuvs606NoYMy', 1, 1, '0bd3d9302f70cdb9cff5043f42ae98fc'),
(56, 'joska', '+36706213412', 'newcube130@gmail.com', '$2y$10$O6oxyZ/LTucTI7KP8d2gn.j1ogr9VfWikgWhG9d6SL5WBLSJIwoG2', 1, 1, 'd67dc082dfd8fee2b76b8565c2776f9f');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

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
