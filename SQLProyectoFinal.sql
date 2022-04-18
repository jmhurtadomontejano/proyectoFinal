-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 18, 2022 at 09:16 PM
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
-- Database: `proyectofinal`
--
CREATE DATABASE IF NOT EXISTS `proyectofinal` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;
USE `proyectofinal`;

-- --------------------------------------------------------

--
-- Table structure for table `articulos`
--

CREATE TABLE `articulos` (
  `id` int(11) NOT NULL,
  `titulo` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci NOT NULL,
  `precio` decimal(8,2) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `id_usuario` int(11) NOT NULL,
  `vendido` tinyint(1) NOT NULL DEFAULT 0,
  `registrationDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `articulos`
--

INSERT INTO `articulos` (`id`, `titulo`, `descripcion`, `precio`, `fecha`, `id_usuario`, `vendido`, `registrationDate`) VALUES
(65, 'gdfgfdg', 'sdfsdfsdf', '34.00', '2022-04-13 09:14:03', 66, 0, '2022-04-15 12:38:29'),
(66, 'fgdfgdfg', 'dfgsdfsdfsdf', '999.00', '2022-04-13 09:15:35', 66, 0, '2022-04-15 12:38:29'),
(70, 'Juanmi', 'asdasdds', '32.00', '2022-04-13 09:21:42', 66, 0, '2022-04-15 12:38:29'),
(71, 'dfsdfdf', 'sdfsdfsdf', '11.00', '2022-04-13 09:23:33', 66, 0, '2022-04-15 12:38:29'),
(72, 'gfdfgdf', 'dfgdfgdfgdfg', '987654.00', '2022-04-13 09:33:44', 66, 0, '2022-04-15 12:38:29'),
(74, 'fgsdfsdf', 'sdfsdfsdf', '999999.99', '2022-04-15 10:18:25', 53, 0, '2022-04-15 12:38:29'),
(77, 'Lapiz', 'Descripcion Lapiz&#60;br&#62;', '1.00', '2022-04-15 10:20:10', 53, 0, '2022-04-15 12:38:29'),
(78, '955559º', 'svsvssv', '9999.00', '2022-04-15 10:36:00', 53, 0, '2022-04-15 12:38:29'),
(79, 'sadasd', 'asdasd', '32.00', '2022-04-16 18:13:55', 72, 0, '2022-04-16 20:13:55');

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
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `idDepartment` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `description` text COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `incidents`
--

CREATE TABLE `incidents` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `description` text COLLATE utf8_spanish_ci NOT NULL,
  `dateRegistrer` date NOT NULL DEFAULT current_timestamp(),
  `dateTimeRegistrer` datetime NOT NULL DEFAULT current_timestamp(),
  `timeRegistrer` time NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `description` text COLLATE utf8_spanish_ci NOT NULL,
  `location` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `id_department` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `state` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `registrationDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `name`, `description`, `location`, `id_department`, `id_user`, `state`, `fecha`, `registrationDate`) VALUES
(79, 'sdfdsf', 'sdfsdf', 'sdfsdf', 0, 72, '', '2022-04-16 18:54:08', '2022-04-16 20:54:08'),
(80, 'sdfdsf', 'sdfsdf', 'sdfsdf', 0, 72, '', '2022-04-16 18:57:59', '2022-04-16 20:57:59'),
(81, 'Juanmi', 'descripcion Juanmi', 'Mi Casa', 0, 72, '', '2022-04-16 18:59:46', '2022-04-16 20:59:46'),
(82, 'asasasa', 'asasasas', 'asasass', 0, 72, '', '2022-04-16 19:01:42', '2022-04-16 21:01:42'),
(83, 'asasasa', 'asasasas', 'asasass', 0, 72, '', '2022-04-16 19:06:30', '2022-04-16 21:06:30'),
(84, 'asdasdad', 'asdasdds', 'asdasdasd', 0, 72, '', '2022-04-16 19:06:54', '2022-04-16 21:06:54'),
(85, 'asdasdad', 'asdasdds', 'asdasdasd', 0, 72, '', '2022-04-16 19:09:25', '2022-04-16 21:09:25'),
(86, 'x&#60;x&#60;zx', '&#60;zx&#60;zx&#60;', '&#60;zx&#60;zx', 0, 53, '', '2022-04-16 20:39:24', '2022-04-16 22:39:24'),
(87, 'Alberto', 'Descripcion Alberto', 'alberto loc', 0, 53, '', '2022-04-17 14:41:59', '2022-04-17 16:41:59'),
(88, 'al2', 'desc al2', 'al2 loc', 2, 53, '', '2022-04-17 14:43:26', '2022-04-17 16:43:26'),
(89, 'zxczxc', 'zxczxc', 'zxczxc', 0, 53, '', '2022-04-17 17:24:21', '2022-04-17 19:24:21'),
(90, 'fdsfsdf', 'sdfsdf', 'sdfsdf', 0, 53, '', '2022-04-17 17:25:26', '2022-04-17 19:25:26'),
(91, 'czxczxc', 'zxczxczxc', 'zxczxczxc', 0, 53, '', '2022-04-17 17:26:33', '2022-04-17 19:26:33'),
(92, 'dsfsdfsdfsdf', 'sdfsdf', 'sdfsdf', 0, 53, '', '2022-04-17 17:29:44', '2022-04-17 19:29:44'),
(93, 'sdfsdf', 'sdfsdf', 'sdfsdf', 0, 53, '', '2022-04-17 17:30:06', '2022-04-17 19:30:06'),
(94, 'sdfsdf', 'sdfsdf', 'sdfsdf', 0, 53, '', '2022-04-17 17:31:31', '2022-04-17 19:31:31'),
(95, 'safasd', 'asdasd', 'asdasd', 0, 53, '', '2022-04-17 17:34:09', '2022-04-17 19:34:09'),
(96, '1', '1', '1', 1, 53, '', '2022-04-17 18:53:06', '2022-04-17 20:53:06');

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
(40, '0e8814455aef98ea1d2834f8615c7ee8.jpg', 72),
(42, '0a60c7489dd32bdb0a81a4c9fade16a8.jpg', 74),
(45, '2ad9f9253b8642a85d6d03ae13fa2312.jpg', 77),
(46, '76c35561a3b0cfe39b0327158c0b335a.jpg', 78),
(47, '37aa8918caf0fa9a6e6b97540305d99f.jpg', 79);

-- --------------------------------------------------------

--
-- Table structure for table `photositems`
--

CREATE TABLE `photositems` (
  `id` int(11) NOT NULL,
  `file_name` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `id_item` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `photositems`
--

INSERT INTO `photositems` (`id`, `file_name`, `id_item`) VALUES
(1, '07b0413b0f3acc47f02c9afa31827cab.png', 85),
(2, 'c4b7ab2f2e38a94a9ef4ddd0630f7004.jpg', 95),
(3, '7ec835ef246f33ca107390dd8394a13f.jpg', 96);

-- --------------------------------------------------------

--
-- Table structure for table `postalcodes`
--

CREATE TABLE `postalcodes` (
  `code` int(5) DEFAULT NULL,
  `town` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `postalcodes`
--

INSERT INTO `postalcodes` (`code`, `town`) VALUES
(13180, 'ABENOJAR'),
(13410, 'AGUDO'),
(13379, 'ALAMEDA'),
(13690, 'ALAMEDA DE CERVERA'),
(13413, 'ALAMILLO'),
(13340, 'ALBALADEJO'),
(13600, 'ALCAZAR DE SAN JUAN'),
(13116, 'ALCOBA DE LOS MONTES'),
(13107, 'ALCOLEA DE CALATRAVA'),
(13113, 'ALCORNOCAL, EL'),
(13391, 'ALCUBILLAS'),
(13380, 'ALDEA DEL REY'),
(13248, 'ALHAMBRA'),
(13400, 'ALMADEN'),
(13480, 'ALMADENEJOS'),
(13270, 'ALMAGRO'),
(13328, 'ALMEDINA'),
(13580, 'ALMODOVAR DEL CAMPO'),
(13760, 'ALMURADIEL'),
(13117, 'ANCHURAS'),
(13619, 'ARENALES DE SAN GREGORIO'),
(13679, 'ARENAS DE SAN JUAN'),
(13710, 'ARGAMASILLA DE ALBA'),
(13440, 'ARGAMASILLA DE CALATRAVA'),
(13193, 'ARROBA DE LOS MONTES'),
(13432, 'BALLESTEROS DE CALATRAVA'),
(13428, 'BALLESTEROS, LOS'),
(13597, 'BARRIADA RIO OJAILEN'),
(13739, 'BAZAN'),
(13379, 'BELVIS'),
(13129, 'BETETAS, LAS'),
(13596, 'BIENVENIDA'),
(13260, 'BOLAÑOS DE CALATRAVA'),
(13129, 'BONAL, EL'),
(13450, 'BRAZATORTAS'),
(13192, 'CABEZARADOS'),
(13591, 'CABEZARRUBIAS DEL PUERTO'),
(13370, 'CALZADA DE CALATRAVA'),
(13610, 'CAMPO DE CRIPTANA'),
(13430, 'CAÑADA DE CALATRAVA, LA'),
(13331, 'CAÑAMARES'),
(13433, 'CARACUEL DE CALATRAVA'),
(13150, 'CARRION DE CALATRAVA'),
(13329, 'CARRIZOSA'),
(13128, 'CASAS DEL RIO'),
(13196, 'CASAS, LAS'),
(13750, 'CASTELLAR DE SANTIAGO'),
(13428, 'CHARCO DEL TAMUJO'),
(13412, 'CHILLON'),
(13720, 'CINCO CASAS, Estacion'),
(13720, 'CINCO CASAS, Pueblo'),
(13310, 'CONSOLACION, LA'),
(13190, 'CORRAL DE CALATRAVA'),
(13427, 'CORTIJOS DE ABAJO'),
(13427, 'CORTIJOS DE ARRIBA'),
(13345, 'COZAR'),
(13429, 'CRISTO DE ESPIRITU SANTO'),
(13128, 'CUESTA DEL RIO'),
(13250, 'DAIMIEL'),
(13117, 'ENCINACAIDA'),
(13117, 'ENJAMBRE'),
(13140, 'FERNAN CABALLERO'),
(13193, 'FONTANAREJO'),
(13473, 'FONTANOSAS'),
(13130, 'FUENCALIENTE'),
(13429, 'FUENCALIENTE, LA'),
(13333, 'FUENLLANA'),
(13680, 'FUENTE EL FRESNO'),
(13117, 'GAMONOSO'),
(14449, 'GARGANTA, LA'),
(13414, 'GARGANTIEL'),
(13128, 'GARLITERA'),
(13360, 'GRANATULA DE CALATRAVA'),
(13490, 'GUADALMEZ'),
(13640, 'HERENCIA'),
(13200, 'HERRERA DE LA MANCHA'),
(13590, 'HINOJOSAS DE CALATRAVA'),
(13110, 'HORCAJO DE LOS MONTES'),
(13594, 'HOYO, EL'),
(13118, 'HUERTAS DEL SAUCERAL, LAS'),
(13779, 'HUERTEZUELAS'),
(13114, 'ISLAS, LAS'),
(13660, 'LABORES, LAS'),
(13220, 'LLANOS DEL CAUDILLO'),
(13108, 'LUCIANA'),
(13420, 'MALAGON'),
(13200, 'MANZANARES'),
(13230, 'MEMBRILLA'),
(13592, 'MESTANZA'),
(13170, 'MIGUELTURRA'),
(14449, 'MINAS DE HORCAJO'),
(13739, 'MIRONES, LOS'),
(13194, 'MOLINILLO, EL'),
(13326, 'MONTIEL'),
(13350, 'MORAL DE CALATRAVA'),
(13428, 'MORRAS, LAS'),
(13189, 'NAVACERRADA'),
(13114, 'NAVALAJARRA'),
(13193, 'NAVALPINO'),
(13114, 'NAVALRINCON'),
(13194, 'NAVAS DE ESTENA'),
(13620, 'PEDRO MUÑOZ'),
(13429, 'PERALOSAS, LAS'),
(13140, 'PERALVILLO'),
(13196, 'PICON'),
(13100, 'PIEDRABUENA'),
(13129, 'PIEDRALA'),
(13195, 'POBLETE'),
(13120, 'PORZUNA'),
(13428, 'POVEDILLAS, LAS'),
(13390, 'POZO DE LA SERNA'),
(13179, 'POZUELO DE CALATRAVA'),
(13191, 'POZUELOS DE CALATRAVA, LOS'),
(13109, 'PUEBLA DE DON RODRIGO'),
(13342, 'PUEBLA DEL PRINCIPE'),
(13194, 'PUEBLO NUEVO DEL BULLAQUE'),
(13194, 'PUENTES DE PIEDRALA'),
(13650, 'PUERTO LAPICE'),
(13500, 'PUERTOLLANO'),
(13428, 'QUILES, LOS'),
(13129, 'RABINADAS, LAS'),
(13598, 'RETAMAR'),
(13194, 'RETUERTA DE BULLAQUE'),
(13114, 'ROBLEDO, EL'),
(13249, 'RUIDERA'),
(13414, 'SACERUELA'),
(13415, 'SAN BENITO'),
(13779, 'SAN BRUNO'),
(13247, 'SAN CARLOS DEL VALLE'),
(13779, 'SAN LORENZO DE CALATRAVA'),
(13327, 'SANTA CRUZ DE LOS CAÑAMOS'),
(13730, 'SANTA CRUZ DE MUDELA'),
(13115, 'SANTA QUITERIA'),
(13630, 'SOCUELLAMOS'),
(13593, 'SOLANA DEL PINO'),
(13240, 'SOLANA, LA'),
(13594, 'SOLANILLA DEL TAMARAL'),
(13429, 'SOTILLO, EL'),
(13114, 'TABLILLAS, LAS'),
(13341, 'TERRINCHES'),
(13128, 'TIÑOSILLAS, LAS'),
(13192, 'TIRTEAFUERA'),
(13194, 'TOLEDANA, LA'),
(13700, 'TOMELLOSO'),
(13194, 'TORNO, EL'),
(13160, 'TORRALBA DE CALATRAVA'),
(13344, 'TORRE DE JUAN ABAD'),
(13740, 'TORRENUEVA'),
(13129, 'TRINCHETO, EL'),
(13739, 'UMBRIA DE FRESNEDA'),
(13470, 'VALDEAZOGUES'),
(13428, 'VALDEHIERRO'),
(13411, 'VALDEMANCO DEL ESTERAS'),
(13300, 'VALDEPEÑAS'),
(13279, 'VALENZUELA DE CALATRAVA'),
(13195, 'VALVERDE'),
(13768, 'VENTA DE CARDENAS'),
(13459, 'VEREDAS'),
(13459, 'VEREDILLA'),
(13332, 'VILLAHERMOSA'),
(13739, 'VILLALBA DE CALATRAVA'),
(13343, 'VILLAMANRIQUE'),
(13595, 'VILLAMAYOR DE CALATRAVA'),
(13330, 'VILLANUEVA DE LA FUENTE'),
(13320, 'VILLANUEVA DE LOS INFANTES'),
(13379, 'VILLANUEVA DE SAN CARLOS'),
(13431, 'VILLAR DEL POZO'),
(13597, 'VILLAR, EL'),
(13670, 'VILLARRUBIA DE LOS OJOS'),
(13210, 'VILLARTA DE SAN JUAN'),
(13460, 'VIÑUELA'),
(13770, 'VISO DEL MARQUES');

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `surname` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(70) COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `phone` int(9) NOT NULL,
  `postalCode` int(5) NOT NULL,
  `photo` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `rol` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `department` int(11) NOT NULL,
  `cookie_id` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `registrationDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `surname`, `password`, `email`, `phone`, `postalCode`, `photo`, `rol`, `department`, `cookie_id`, `registrationDate`) VALUES
(53, 'Juan Miguel', 'Hurtado', '$2y$10$Pz2YWskXtmpc0666ukJ7NuJarJo2vTQFnI9VYVtIwxdinhUJoz0ye', 'jmhurtadomontejano@gmail.com', 0, 0, '4f2298003026e86df625710890ad9988.jpg', 'admin', 0, 'f7000ed40075b1788be30cf55b865dee8fca5dd1', '2022-04-10 14:47:26'),
(64, 'a', '', '$2y$10$hNYxdEPVoSU47WfCEt1fjOvWRQaSe2/rkkfSUHDAJZ49X9.zzW416', 'a@a.com', 0, 0, '6ca3d0e5a57cc69d2d34321c310fe87a.jpg', '', 0, '80474a27db001165e553e45991ff93c7f332832b', '2022-04-10 23:11:36'),
(65, 'Trini', '', '$2y$10$nDjluAPNbvDS6a8ArPDOBen4rO.3JKKwsxuclb2ii/gSBBRC0NBXm', 't@gmail.com', 0, 0, '19dc4e173dcb6ba6c36ba8e1a6f186d2.jpg', 'superAdmin', 0, 'e2ad2087e10ebf593ccafc97692ffa315c076d1f', '2022-04-12 15:57:28'),
(66, 'sdasd', '', '$2y$10$iW7dkuN4UXDVT1bGRM.2mOtuyyXbWxK4H1cPVoxzD8Nd4PifYM1t.', 'b@b.com', 0, 0, '1f89c8447abb71bb60286362a8ffb660.jpg', '', 0, 'e690feeca92cddc887a6ff093106945e1d5b16a1', '2022-04-13 08:53:05'),
(72, 'Jaime', 'Coronado', '$2y$10$SuAMSsmmPtYvvgEN791wR.TGQVZZccJCBrdhG0jk.c9KgGVHee7iu', 'j@j.com', 654321987, 654321987, '6584f6413224645ea0a14c53f5936dda.jpg', '', 0, 'a3638e61f17e59cc399425c0686c7117dc661be5', '2022-04-13 11:19:49'),
(73, 'Marta', 'Coronado', '$2y$10$o0MH6650tD8czddIoL7IIObeYfUD.uL3casLIXrP9uPK2CqUaPhA2', 'j@j.com', 123456789, 123456789, '7b7ce6f3aad4fb90c532c4d5143f1387.jpeg', '', 0, '37e9e7343af3098a911897ad2ed3a35ad781895b', '2022-04-13 11:27:02'),
(74, 'Joana', 'asasas', '$2y$10$EZbVPSnnb25I/cLsEx7.0.qG7CBw92Q5tNzxBpYnro5M1Qc4.lHCO', 'j@j.com', 123456789, 123456789, 'a38d78a7b70df4252ad14380b64af956.jpeg', '', 0, '12f2b14157e0b95ff806c03ee38ed82447c8a594', '2022-04-13 11:29:02'),
(75, 'dfsdf', 'sdfsdf', '$2y$10$EIT9gL8TBYwXp3sHvBkNl.R/ndQ1sIGpcvKOz6hj5/JQUO1e804yW', 'j@j.com', 123456789, 123456789, '3924e1265b9646eff9c04a7337b88bc4.jpg', '', 0, 'cde3d181f6bb8a457ecf33d5c89f0fd24a60eb22', '2022-04-13 11:32:38'),
(76, 'Jose Mari', 'Hurtado', '$2y$10$J7SXecse0JfYmOOPBev9LusHgnsS30tNIUtOAGCDZHZiTe.g/29aW', 'j@j.com', 123456768, 123456768, 'bc44550a974cd45951ba68e1ac9fea40.jpg', '', 0, 'ebf43f1d45af8e31cacb2e1665f9510e09a55e4c', '2022-04-15 09:41:43'),
(77, 'Luisa', 'Hurtado', '$2y$10$3mvceuJSexDbwKAS80kQM.sl56oE2fy5y5WrrIeEU3privk6/ZJJS', 'j@j.com', 123456789, 123456789, 'fd88bbf56d6026011ef5652cad774d1c.jpg', '', 0, '96da8d738507bece1121ad0bef0c47de1ef017e9', '2022-04-15 09:42:39'),
(78, '11', '11', '$2y$10$cl9UTvn67/8UyFVjZIeI4.cqyBgsZrxJy/n3O7f4Ly8YQosl3WCKm', '11@gmail.com', 123456789, 123456789, 'c67c1fa5417dffd6f0fa30235608f642.jpg', '', 0, 'e9938bd65374787b7dde27dc944a354a6d075acf', '2022-04-17 10:05:15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articulos`
--
ALTER TABLE `articulos`
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
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`idDepartment`);

--
-- Indexes for table `incidents`
--
ALTER TABLE `incidents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_item_user` (`id_user`);

--
-- Indexes for table `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_photos_articulos` (`id_articulo`);

--
-- Indexes for table `photositems`
--
ALTER TABLE `photositems`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_photos_items` (`id_item`);

--
-- Indexes for table `postalcodes`
--
ALTER TABLE `postalcodes`
  ADD KEY `postalcodes_code_IDX` (`code`) USING BTREE;

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `articulos`
--
ALTER TABLE `articulos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `compras`
--
ALTER TABLE `compras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `idDepartment` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `incidents`
--
ALTER TABLE `incidents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT for table `photos`
--
ALTER TABLE `photos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `photositems`
--
ALTER TABLE `photositems`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `articulos`
--
ALTER TABLE `articulos`
  ADD CONSTRAINT `fk_articulo_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `compras`
--
ALTER TABLE `compras`
  ADD CONSTRAINT `compras_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `compras_ibfk_2` FOREIGN KEY (`id_articulo`) REFERENCES `articulos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `fk_item_usuario` FOREIGN KEY (`id_user`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `photos`
--
ALTER TABLE `photos`
  ADD CONSTRAINT `fk_photos_articulos` FOREIGN KEY (`id_articulo`) REFERENCES `articulos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `photositems`
--
ALTER TABLE `photositems`
  ADD CONSTRAINT `fk_photos_items` FOREIGN KEY (`id_item`) REFERENCES `items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
