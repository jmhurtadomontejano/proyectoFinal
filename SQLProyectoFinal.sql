-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 06, 2022 at 11:57 AM
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

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`idDepartment`, `name`, `description`) VALUES
(1, 'Servicios Sociales', 'Servicios Sociales'),
(2, 'Centro Dia Mayores', 'Centro Dia Mayores'),
(3, 'Unidad de Empleo', 'Unidad de Empleo'),
(4, 'Centro de la Mujer', 'Centro de la Mujer'),
(5, 'Deportes', 'Deportes'),
(6, 'PID', 'Punto de Inclusión Digital'),
(7, 'Centro Escolar', 'Centro Escolar');

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
  `id_service` int(11) NOT NULL,
  `id_attendUser` int(11) NOT NULL,
  `id_clientUser` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `state` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `date` date NOT NULL,
  `hour` time NOT NULL,
  `duration` time NOT NULL,
  `registrationDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `name`, `description`, `location`, `id_department`, `id_service`, `id_attendUser`, `id_clientUser`, `id_user`, `state`, `date`, `hour`, `duration`, `registrationDate`) VALUES
(101, 'Item de Prueba 1', 'Detalle Item 1', 'Calle Argensola, 23', 1, 13, 72, 0, 65, '', '2022-04-24', '00:00:00', '00:00:00', '2022-04-24 12:30:55'),
(102, 'Item2', 'Descripcion Item 2', 'Calle Manolo, 25', 2, 24, 72, 0, 65, 'Registrada', '2022-04-24', '00:00:00', '00:00:00', '2022-04-24 12:35:04'),
(103, 'Item 4', 'Item 4', 'Calle Prueba 4', 0, 23, 2, 0, 65, 'Registrada', '2022-04-24', '00:00:00', '00:00:00', '2022-04-24 13:02:08'),
(105, 'Prueba11', 'Prueba11 descripcion', 'Localizacion Prueba', 2, 23, 72, 53, 65, 'Registrada', '2022-04-24', '00:00:00', '00:00:00', '2022-04-24 21:07:36'),
(110, 'ewrwerwe', 'werwer', 'werwer', 2, 23, 72, 51, 65, 'Registrada', '2022-04-24', '00:00:00', '00:00:00', '2022-04-24 21:43:32'),
(111, 'Prueba12', 'Prueba con hora incluida', '', 2, 23, 72, 51, 65, 'Registrada', '2022-04-24', '21:50:00', '00:00:00', '2022-04-24 21:50:54'),
(112, 'sdasdad', 'asdasdd', '', 2, 23, 72, 51, 65, 'Registrada', '2022-04-24', '21:57:00', '00:00:30', '2022-04-24 21:57:55'),
(113, 'Prueba Juanmi', 'descr Prueba Juanmi', '', 5, 0, 0, 53, 65, 'Registrada', '2022-05-01', '10:47:00', '00:00:00', '2022-05-01 10:51:55'),
(114, 'dfsdfsdf', 'sdfsdfsdf', '', 1, 0, 65, 53, 65, 'Registrada', '2022-05-01', '12:24:00', '00:00:00', '2022-05-01 12:24:19'),
(115, 'AAAAAAAAAAAAAAAAAAA', 'DDDDDDDDDDDDDDDDDDDDDDD', '', 5, 5555555, 65, 53, 65, 'Registrada', '2022-05-01', '21:41:00', '00:00:00', '2022-05-01 21:41:41'),
(116, 'Prueba Prueba', 'descripcion', '', 5, 0, 65, 53, 65, 'Registrada', '2022-05-02', '12:56:00', '00:00:00', '2022-05-02 12:56:51');

-- --------------------------------------------------------

--
-- Table structure for table `photos`
--

CREATE TABLE `photos` (
  `id` int(11) NOT NULL,
  `nombre_archivo` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `id_articulo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

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
(8, '1313434ad9267509283cb66e575e56a9.jpg', 101),
(9, 'b1d06af35720f31a3728cbbbbfce1990.png', 102),
(10, 'a51f629df973559221ec3d803b9976e5.jpg', 103),
(12, 'ac72a255b60e402e6b943490fec7918c.jpg', 105),
(17, 'c90822311ef03e61bc2fba05110ff992.jpg', 110),
(18, 'a3292fd27896b32dc262940db3d23ce3.jpg', 111),
(19, '7238c07e7bd056c3dc88744138dfd3f7.png', 112);

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
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `idService` int(11) NOT NULL,
  `idDepartment` int(11) NOT NULL,
  `serviceDescription` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `id_userRegistrerService` int(11) NOT NULL,
  `dateTimeServiceRegistrer` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `surname` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `dni` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
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

INSERT INTO `usuarios` (`id`, `nombre`, `surname`, `dni`, `password`, `email`, `phone`, `postalCode`, `photo`, `rol`, `department`, `cookie_id`, `registrationDate`) VALUES
(65, 'Trini', 'Hurtado', '88664422B', '$2y$10$nDjluAPNbvDS6a8ArPDOBen4rO.3JKKwsxuclb2ii/gSBBRC0NBXm', 't@gmail.com', 123456788, 13700, '19dc4e173dcb6ba6c36ba8e1a6f186d2.jpg', 'superAdmin', 0, '42269521a080b0698f7ad0a816724529f5cfc79f', '2022-04-12 15:57:28'),
(81, 'Nacho', 'Hurtado', '12345678A', '$2y$10$IRASYDwyWNa1VjHKH1vZh.3g.fR8dQQn/K1JMT/HN4pHqJ.eRNgoS', 'nacho@gmail.com', 687654321, 13710, 'd9704af1a4dbb5173a694a21b448994c.png', 'admin', 0, 'b81582e3e5e1298bde0936f60ac45a05625b1a21', '2022-05-06 07:58:01');

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
  ADD PRIMARY KEY (`idDepartment`),
  ADD KEY `idDepartment` (`idDepartment`);

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
  ADD KEY `postalcodes_code_IDX` (`code`) USING BTREE,
  ADD KEY `code` (`code`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`idService`),
  ADD KEY `idService` (`idService`),
  ADD KEY `idDepartment` (`idDepartment`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `postalCode` (`postalCode`);

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
  MODIFY `idDepartment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- AUTO_INCREMENT for table `photos`
--
ALTER TABLE `photos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `photositems`
--
ALTER TABLE `photositems`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `idService` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

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

--
-- Constraints for table `services`
--
ALTER TABLE `services`
  ADD CONSTRAINT `services_ibfk_1` FOREIGN KEY (`idDepartment`) REFERENCES `departments` (`idDepartment`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
