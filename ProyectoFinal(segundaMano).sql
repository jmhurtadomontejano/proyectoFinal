-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 13, 2022 at 03:51 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `proyectoFinal`
--
CREATE DATABASE IF NOT EXISTS `proyectoFinal` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;
USE `proyectoFinal`;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `titulo` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci NOT NULL,
  `precio` decimal(8,2) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `id_usuario` int(11) NOT NULL,
  `vendido` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `titulo`, `descripcion`, `precio`, `fecha`, `id_usuario`, `vendido`) VALUES
(63, 'xcfgdfg', 'dfgdfg', '45.00', '2022-04-13 08:58:31', 53, 0),
(65, 'gdfgfdg', 'sdfsdfsdf', '34.00', '2022-04-13 09:14:03', 66, 0),
(66, 'fgdfgdfg', 'dfgsdfsdfsdf', '999.00', '2022-04-13 09:15:35', 66, 0),
(70, 'Juanmi', 'asdasdds', '32.00', '2022-04-13 09:21:42', 66, 0),
(71, 'dfsdfdf', 'sdfsdfsdf', '11.00', '2022-04-13 09:23:33', 66, 0),
(72, 'gfdfgdf', 'dfgdfgdfgdfg', '987654.00', '2022-04-13 09:33:44', 66, 0);

-- --------------------------------------------------------

--
-- Table structure for table `compras`
--

CREATE TABLE `compras` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_articulo` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `photos`
--

CREATE TABLE `photos` (
  `id` int(11) NOT NULL,
  `nombre_archivo` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `id_articulo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `photos`
--

INSERT INTO `photos` (`id`, `nombre_archivo`, `id_articulo`) VALUES
(39, '53dd40477dac20c036810688dde6d2c6.jpg', 71),
(40, '0e8814455aef98ea1d2834f8615c7ee8.jpg', 72);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `surname` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(70) COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `phone` int(9) NOT NULL,
  `postalCode` int(5) NOT NULL,
  `photo` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `rol` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `cookie_id` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `registrationDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nombre`, `surname`, `password`, `email`, `phone`, `postalCode`, `photo`, `rol`, `cookie_id`, `registrationDate`) VALUES
(53, 'Juan Miguel', 'Hurtado', '$2y$10$Pz2YWskXtmpc0666ukJ7NuJarJo2vTQFnI9VYVtIwxdinhUJoz0ye', 'jmhurtadomontejano@gmail.com', 0, 0, '4f2298003026e86df625710890ad9988.jpg', 'admin', '454c2465cd7b4c5ab2067600a05fc0a075980ba5', '2022-04-10 14:47:26'),
(64, 'a', '', '$2y$10$hNYxdEPVoSU47WfCEt1fjOvWRQaSe2/rkkfSUHDAJZ49X9.zzW416', 'a@a.com', 0, 0, '6ca3d0e5a57cc69d2d34321c310fe87a.jpg', '', '80474a27db001165e553e45991ff93c7f332832b', '2022-04-10 23:11:36'),
(65, 'Trini', '', '$2y$10$nDjluAPNbvDS6a8ArPDOBen4rO.3JKKwsxuclb2ii/gSBBRC0NBXm', 't@gmail.com', 0, 0, '19dc4e173dcb6ba6c36ba8e1a6f186d2.jpg', 'superAdmin', '25297aebfd1fe9bab6e553d65d3d546810cb954e', '2022-04-12 15:57:28'),
(66, 'sdasd', '', '$2y$10$iW7dkuN4UXDVT1bGRM.2mOtuyyXbWxK4H1cPVoxzD8Nd4PifYM1t.', 'b@b.com', 0, 0, '1f89c8447abb71bb60286362a8ffb660.jpg', '', 'e690feeca92cddc887a6ff093106945e1d5b16a1', '2022-04-13 08:53:05'),
(72, 'Jaime', 'Coronado', '$2y$10$SuAMSsmmPtYvvgEN791wR.TGQVZZccJCBrdhG0jk.c9KgGVHee7iu', 'j@j.com', 654321987, 654321987, '6584f6413224645ea0a14c53f5936dda.jpg', '', '3bf9fb38825d38b06a50868986b809598ee5f096', '2022-04-13 11:19:49'),
(73, 'Marta', 'Coronado', '$2y$10$o0MH6650tD8czddIoL7IIObeYfUD.uL3casLIXrP9uPK2CqUaPhA2', 'j@j.com', 123456789, 123456789, '7b7ce6f3aad4fb90c532c4d5143f1387.jpeg', '', '37e9e7343af3098a911897ad2ed3a35ad781895b', '2022-04-13 11:27:02'),
(74, 'Joana', 'asasas', '$2y$10$EZbVPSnnb25I/cLsEx7.0.qG7CBw92Q5tNzxBpYnro5M1Qc4.lHCO', 'j@j.com', 123456789, 123456789, 'a38d78a7b70df4252ad14380b64af956.jpeg', '', '12f2b14157e0b95ff806c03ee38ed82447c8a594', '2022-04-13 11:29:02'),
(75, 'dfsdf', 'sdfsdf', '$2y$10$EIT9gL8TBYwXp3sHvBkNl.R/ndQ1sIGpcvKOz6hj5/JQUO1e804yW', 'j@j.com', 123456789, 123456789, '3924e1265b9646eff9c04a7337b88bc4.jpg', '', 'cde3d181f6bb8a457ecf33d5c89f0fd24a60eb22', '2022-04-13 11:32:38');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_articulo_usuario` (`id_usuario`);

--
-- Indexes for table `compras`
--
ALTER TABLE `compras`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_articulo` (`id_articulo`);

--
-- Indexes for table `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_photos_items` (`id_articulo`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `compras`
--
ALTER TABLE `compras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `photos`
--
ALTER TABLE `photos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `fk_articulo_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `compras`
--
ALTER TABLE `compras`
  ADD CONSTRAINT `compras_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `compras_ibfk_2` FOREIGN KEY (`id_articulo`) REFERENCES `items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `photos`
--
ALTER TABLE `photos`
  ADD CONSTRAINT `fk_photos_items` FOREIGN KEY (`id_articulo`) REFERENCES `items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
