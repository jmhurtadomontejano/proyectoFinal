-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-01-2022 a las 16:41:43
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `segunda_mano`
--
CREATE DATABASE IF NOT EXISTS `segunda_mano` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;
USE `segunda_mano`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articulos`
--

CREATE TABLE `articulos` (
  `id` int(11) NOT NULL,
  `titulo` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci NOT NULL,
  `precio` decimal(8,2) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `id_usuario` int(11) NOT NULL,
  `vendido` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `articulos`
--

INSERT INTO `articulos` (`id`, `titulo`, `descripcion`, `precio`, `fecha`, `id_usuario`, `vendido`) VALUES
(1, 'Galaxy s20000', 'Móvil de ultimísima generación (del futuro)', '1000.00', '2021-10-22 14:33:49', 35, 0),
(7, 'Galaxy s20000', 'Móvil de ultimísima generación (del futuro)', '1000.00', '2021-10-22 15:05:34', 35, 0),
(10, 'Mueble Tv', 'Mueble como nuevo', '400.00', '2021-10-22 15:05:42', 3, 0),
(11, 'Otro artículo', 'otro', '100.00', '2021-10-22 15:40:53', 4, 0),
(12, 'Otro artículo', 'otro', '100.00', '2021-10-22 15:40:57', 4, 0),
(13, 'Otro artículo', 'otro', '100.00', '2021-10-22 15:41:01', 4, 0),
(14, 'Otro artículo', 'otro', '100.00', '2021-10-22 15:41:04', 4, 0),
(15, 'Otro artículo', 'otro', '100.00', '2021-10-22 15:41:06', 4, 0),
(16, 'Otro artículo', 'otro', '100.00', '2021-10-22 15:41:08', 4, 0),
(17, 'Otro artículo', 'otro', '100.00', '2021-10-22 15:41:11', 4, 0),
(18, 'nuevo', '<b>nuevo</b>', '2000.00', '2021-10-22 16:38:31', 35, 0),
(19, 'aaaaaaa', 'aaaaaaaaaa', '1000.00', '2021-11-02 15:10:44', 42, 0),
(20, 'fotos', 'fotos', '1111.00', '2021-11-02 15:13:43', 42, 0),
(21, 'fotos', 'fotos', '0.00', '2021-11-02 15:44:18', 42, 0),
(22, 'fotos', 'fotos', '0.00', '2021-11-02 15:45:41', 42, 0),
(23, 'fotos', 'fotos', '0.00', '2021-11-02 15:45:49', 42, 0),
(24, 'a', 'a', '3.00', '2021-11-02 15:46:22', 42, 0),
(25, 'fffffffff', 'fffffffff', '1.00', '2021-11-02 15:46:51', 42, 0),
(26, 'fffffffff', 'fffffffff', '1.00', '2021-11-02 15:48:26', 42, 0),
(27, 'fffffffff', 'fffffffff', '1.00', '2021-11-02 15:49:07', 42, 0),
(28, 'a', 'a', '2.00', '2021-11-02 15:49:15', 42, 0),
(29, 'a', 'a', '1.00', '2021-11-02 15:50:13', 42, 0),
(30, 'a', 'a', '1.00', '2021-11-02 15:50:56', 42, 0),
(31, 'a', 'a', '1.00', '2021-11-02 15:51:08', 42, 0),
(32, '1', '1', '1.00', '2021-11-02 16:03:39', 42, 0),
(33, '1', '1', '1.00', '2021-11-02 16:03:53', 42, 0),
(34, '1', '1', '1.00', '2021-11-02 16:07:58', 42, 0),
(35, '1', '1', '1.00', '2021-11-02 16:08:16', 42, 0),
(36, '1', '1', '1.00', '2021-11-02 16:08:37', 42, 0),
(37, '22', '22', '22.00', '2021-11-02 16:08:54', 42, 0),
(38, 'a', 'a', '1.00', '2021-11-02 16:11:04', 42, 0),
(39, 'a', 'a', '1.00', '2021-11-02 16:11:10', 42, 0),
(40, 'a', 'a', '1.00', '2021-11-02 16:11:15', 42, 0),
(41, 'a', 'a', '1.00', '2021-11-02 16:11:21', 42, 0),
(48, '1111111111', '111111111111111', '9999.99', '2021-11-05 16:00:58', 42, 0),
(49, 'preparadas', 'preparadas', '2222.00', '2021-11-09 16:46:06', 42, 0),
(50, '&#39;asdfasdf', '&#39;asdfasdf', '33.00', '2021-11-09 16:46:22', 42, 0),
(52, 'aaaaaaa', 'aaaaaaaaaaa', '22222.00', '2021-12-10 16:22:24', 51, 0),
(54, 'ASDF', 'ASDF', '2345.00', '2021-12-10 17:21:30', 51, 0),
(57, 'otro', 'asdfas&#60;p&#62;dfa&#60;/p&#62;&#60;p&#62;sdf&#60;/p&#62;&#60;p&#62;asd&#60;/p&#62;&#60;p&#62;f&#60;/p&#62;', '19000.00', '2022-01-11 15:43:10', 52, 0),
(59, 'asdfasdfas', 'asdfasdfa&#60;p&#62;sdf&#60;/p&#62;&#60;p&#62;asd&#60;/p&#62;&#60;p&#62;fas&#60;/p&#62;&#60;p&#62;df&#60;/p&#62;', '1000.00', '2022-01-14 15:26:33', 52, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras`
--

CREATE TABLE `compras` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_articulo` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fotos`
--

CREATE TABLE `fotos` (
  `id` int(11) NOT NULL,
  `nombre_archivo` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `id_articulo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `fotos`
--

INSERT INTO `fotos` (`id`, `nombre_archivo`, `id_articulo`) VALUES
(1, '9f4eb04bde7b9507e7d097a0df3fa854.png', 31),
(2, '87828b6b8c8590ea95b14696da89b4d2.jpeg', 33),
(3, '70c896cf60f7b97c5d0dbc037ce1b9fa.png', 34),
(4, '4bf7eb3d2b42d97f4aa1fa5682108236.jpg', 34),
(5, '21fbf7c3fa8d2892743be4dbf3fd2616.png', 35),
(6, '43ca8948897ad13bb66517d195892baa.jpg', 35),
(7, 'c7e8e7141e52cbf8a95fc9e0b7bc5e42.jpg', 35),
(8, '8f8a00e7c8ef42a7a6e8793569c40cbb.jpg', 35),
(9, '2eeab9aa88a0ae844161c32fd0c6c25b.png', 36),
(10, 'ad4e9c0348cfc86b807b2198b095efe6.jpg', 36),
(11, 'ef01c0fe19a0cd9dccdc7b208bb1803f.jpg', 36),
(12, '85705693db0d408ec84a3f38df2ce197.jpg', 36),
(13, 'cf62a47dae0da334a0d4cf567abe3746.png', 37),
(14, 'd0ec96104f2f43735de9a3c42530b760.jpg', 37),
(15, '6beed583a6ed0d7f9ef2b2a1b423a8c1.jpg', 37),
(16, 'b03b9780b07854eac225b7d69fefef9e.jpg', 37),
(17, '59fa5c068aff0e4bd9825708e164d708.jpg', 38),
(18, 'e0cb2667bc0f58ef7d1c04667e1616ba.jpg', 39),
(19, 'ee85a7de26de98183bfad7434cde659b.jpeg', 41),
(24, 'bc6ea030f1fbd05d36ba2ef1f680748a.jpg', 49),
(25, '46a67740aa8ce75cf67e7651088fa2f6.png', 50),
(27, '88c31af3c12591f488944f6479df916d.png', 52),
(30, '353f5ea6ae8ef79896572c2d8fc2b1c6.png', 54),
(31, '7c25d45360ed481de9d94a7dd04501ac.jpg', 54),
(32, 'a0ff75679c31dd0657f9df09d077acfd.jpg', 54),
(33, '32f2fc7a0c57fc14236c9e4c468a51b2.jpg', 54),
(37, '5cd42e3932fc50e1d9b3c165e8594193.jpg', 59);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(70) COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `foto` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `cookie_id` varchar(100) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `password`, `email`, `foto`, `cookie_id`) VALUES
(3, 'pepe', '1234', 'pepe@gmail.com', 'foto.jpg', ''),
(4, 'Marta', '1234', 'marta@gmail.com', 'foto.jpg', ''),
(24, 'Pedro', '$2y$10$jErr5UNmqwKqTzxuQsHrler8IuOP5LCBPng0t.pauecbZyU.1iW4u', 'pedro@gmail.com', 'foto.jpg', ''),
(27, '', '$2y$10$ZbuInDkMy4W1mUJhmG5NZue4qJq5IHFXqKoNgIxdiHJb/F69Nqq6S', '', '', 'bd14b03ccf8e74d8977d3bce0501a8ad74d14e5f'),
(28, '', '$2y$10$YJs9CN/0Eaw2qbdTK82rIOWgFx1NYO0Ce8YV.K4sB1V0vxBe75HlK', '', '', ''),
(29, '', '$2y$10$KlqtOVpyw2x.Km44sL9ER.MZcp0rhaMig8oQXJt.33XsaDwfo.mva', '', '', ''),
(30, '', '$2y$10$e9UGaB8GfY4ruB9KALqn.OQpifSry5N8b1OqcDiv097OtzpmKRPxC', '', '', ''),
(31, '', '$2y$10$X61RX8y9Sz.9yyZTtC1OL.IX/mLRqV4B75ogIR2iS/nsZBKewRk..', '', '', ''),
(32, '', '$2y$10$Dw06fFEACcIPu8SGCxtBnubPanUuoqMori4iC.v3aefIt5JKh0fXi', '', '', ''),
(35, 'Samuel', '$2y$10$fpvzqYm61q6/LI5Angio7Of7ViPaYk0ZS2EgjL3smwGqHosbQOFlO', 's@s.com', 'foto.jpg', ''),
(41, 'aa', '$2y$10$CJq5uL4gMr/8gs8nhHclhebbeFe4eCtCryqQgi7Cc/ShoWkERFrFi', 'aa@aa.com', 'ea0ad4b0f7657688c96d3e76072cf702.jpg', ''),
(42, 'Samuel', '$2y$10$86LpI1/T8/mZn70g2bseb.6XnCMUlZKa/cGFHwke4jtmi9AiGr3xW', 'samuel@iesjuanbosco.es', 'c58ce02891a5ad297b448e36307df418.jpeg', 'd5313fc1525a401f281b1cb12edf796d79b26e96'),
(43, 'aaa', '$2y$10$l.r.9hpslJnIojlEj97VfusNYspcOwmqT0u67aeEY7kSe3vLbHf7.', 'bbb', 'f849bce3308866b5ab286650ece670d7.png', ''),
(44, 'contoken', '$2y$10$5ibLYHuRiA8F0wLsJc5lVeAiK.lCg.HGEL1rZiuQg8bTWoJ7.26sC', 'contoken@token.es', 'ad7800a24d484744b914c66b66b6cb13.jpg', ''),
(45, 'aaa', '$2y$10$nl82Jlk467ces5TmCvvAYuQ5zMhn9/cIYzCpTTD24Ws3JFa20rcgu', 'aaa', 'd6e4b65630813eabdf3d1c18151d00ec.png', ''),
(46, '12341234', '$2y$10$N/K8lUtN21H2QP23hngmFur1.hB4GjTs/JxSVlAbb2KYdDEp3FvBC', '12341234', '21d26348cdd6cfd108e5393f7f587034.png', ''),
(47, 'aaa', '$2y$10$rVJ0u4t6w6ZPBren1jpEF.G08ufEKEijQNpsMSOGK49IrDPg4e5HK', 'aa@aa.com', 'b5414edbc65bdbbe0ba2233aceb160f6.png', ''),
(48, '&#60;script&#62;alert(&#39;hola&#39;)&#60;/script&#62;', '$2y$10$X4yx.xp02f/5J3ZrjFWJnOgYn7TVmy7xGoPJPnFAPqbrdiN.CKXYa', 'aa11@a.com', 'f679ae2a430187a079b908ca45a02748.png', ''),
(49, '&#60;script&#62;alert(&#39;hola&#39;)&#60;/script&#62;', '$2y$10$YNNFju4q0Tqz0.EMFND9ne2Zn9jCMFeaO6cM2LRdAiVXY4/kFcQZO', '11@11.com', 'bb92fd5007d3c41d8e95adbcec62cb54.png', ''),
(50, '&#39;kjhklhj', '$2y$10$dti8StSZNmnk7CMEWw.l2utYBO1DYNolEXOZ9gBNpkRQJIOg6pI7e', 'ASD@asdf.com', '8a83bffafc421667b13e82531e9b26d1.png', '22d63087cb91f98195fa5100f716111cdde33993'),
(51, 'ss', '$2y$10$bqBKhwczWMYYrFDUkmYGN.plL2K8G2kCRiPq3omgIgOVJCaoQLLe.', 'ss@ss.ss', '09f289799240b6e67fd35453148320af.jpg', '0f2e69d9f4d3da45d0ed04188436765ee2ee27ae'),
(52, 'rr', '$2y$10$X11fz1ewEF38bbo6HvavZOtMJnyOsPcMoXjFSXauos8BE4sNmPdd.', 'rr@rr.com', '182333c197bf81397dc4c984c965cf27.png', '4061f16fa21ae5ba9f8be740841d1857758158c6');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `articulos`
--
ALTER TABLE `articulos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_articulo_usuario` (`id_usuario`);

--
-- Indices de la tabla `compras`
--
ALTER TABLE `compras`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_articulo` (`id_articulo`);

--
-- Indices de la tabla `fotos`
--
ALTER TABLE `fotos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_fotos_articulos` (`id_articulo`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `articulos`
--
ALTER TABLE `articulos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT de la tabla `compras`
--
ALTER TABLE `compras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `fotos`
--
ALTER TABLE `fotos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `articulos`
--
ALTER TABLE `articulos`
  ADD CONSTRAINT `fk_articulo_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `compras`
--
ALTER TABLE `compras`
  ADD CONSTRAINT `compras_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `compras_ibfk_2` FOREIGN KEY (`id_articulo`) REFERENCES `articulos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `fotos`
--
ALTER TABLE `fotos`
  ADD CONSTRAINT `fk_fotos_articulos` FOREIGN KEY (`id_articulo`) REFERENCES `articulos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
