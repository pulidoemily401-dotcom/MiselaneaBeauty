-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 25-03-2026 a las 17:55:36
-- Versión del servidor: 11.8.3-MariaDB-log
-- Versión de PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `u243468983_miselanea`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `idcategoria` int(11) NOT NULL,
  `nombre` varchar(60) DEFAULT NULL,
  `descripcion` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`idcategoria`, `nombre`, `descripcion`) VALUES
(1, 'Lociones ', 'Perfumes, colonias y eau de toilette para mujeres y hombres,'),
(2, 'Cuidado Facial', 'Productos para la limpieza, hidratación y tratamiento del ro'),
(3, 'Cuidado Corporal', 'Cremas, lociones, jabones y desodorantes para mantener la pi'),
(4, 'Cuidado Capilar', 'Champús, acondicionadores y tratamientos para todo tipo de c'),
(5, 'Línea Masculina', 'Productos especialmente diseñados para hombres.'),
(6, 'Jabones de tocador', 'Aromáticos y neutros para el cuidado personal'),
(7, 'Línea Infantil', 'Productos seguros y suaves para bebés y niños, como jabones,');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallefactura`
--

CREATE TABLE `detallefactura` (
  `iddetallefactura` int(11) NOT NULL,
  `idfactura` int(11) DEFAULT NULL,
  `idproducto` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `preciouni` int(11) DEFAULT NULL,
  `valortotalcadapro` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detallefactura`
--

INSERT INTO `detallefactura` (`iddetallefactura`, `idfactura`, `idproducto`, `cantidad`, `preciouni`, `valortotalcadapro`) VALUES
(58, 50, 18, 1, 35000, 35000),
(60, 51, 18, 1, 35000, 35000),
(62, 52, 18, 1, 35000, 35000),
(63, 52, 21, 7, 125400, 877800);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `devolucion`
--

CREATE TABLE `devolucion` (
  `iddevolucion` int(11) NOT NULL,
  `idproducto` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `fechaingreso` date DEFAULT NULL,
  `idfactura` int(11) DEFAULT NULL,
  `descripcionmotivo` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `devolucion`
--

INSERT INTO `devolucion` (`iddevolucion`, `idproducto`, `cantidad`, `fechaingreso`, `idfactura`, `descripcionmotivo`) VALUES
(34, 18, 1, '2026-03-24', 51, 'Dañado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entrada`
--

CREATE TABLE `entrada` (
  `identrada` int(11) NOT NULL,
  `idproducto` int(11) DEFAULT NULL,
  `numerodocumen` int(11) NOT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `fechaentrada` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `entrada`
--

INSERT INTO `entrada` (`identrada`, `idproducto`, `numerodocumen`, `cantidad`, `fechaentrada`) VALUES
(21, 21, 42018400, 2, '2026-03-20'),
(22, 18, 42018400, 1, '2026-03-20'),
(23, 18, 42018400, 2, '2026-03-23'),
(24, 18, 42018400, 3, '2026-03-24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE `factura` (
  `idfactura` int(11) NOT NULL,
  `fechayhora` datetime DEFAULT NULL,
  `numerodocumen` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `factura`
--

INSERT INTO `factura` (`idfactura`, `fechayhora`, `numerodocumen`) VALUES
(50, '2026-03-23 22:38:13', 1111111121),
(51, '2026-03-24 20:34:36', 1234441325),
(52, '2026-03-24 20:44:10', 1234441325);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `idtipodocu`
--

CREATE TABLE `idtipodocu` (
  `idtipo` int(11) NOT NULL,
  `documento` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `idtipodocu`
--

INSERT INTO `idtipodocu` (`idtipo`, `documento`) VALUES
(1, 'RC'),
(2, 'TI'),
(3, 'CC'),
(4, 'PPT'),
(5, 'CE'),
(6, 'VISA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marca`
--

CREATE TABLE `marca` (
  `idmarca` int(11) NOT NULL,
  `marca` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `marca`
--

INSERT INTO `marca` (`idmarca`, `marca`) VALUES
(7, 'Ésika'),
(8, 'Avon'),
(9, 'Yanbal'),
(10, 'Natura');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notificacion`
--

CREATE TABLE `notificacion` (
  `idnotificacion` int(11) NOT NULL,
  `idfactura` int(11) NOT NULL,
  `cliente` varchar(150) NOT NULL,
  `numerodocumen` bigint(20) NOT NULL,
  `total` decimal(12,2) NOT NULL,
  `metodopago` varchar(50) NOT NULL,
  `productos` text NOT NULL,
  `visto` tinyint(1) DEFAULT 0,
  `fechacreacion` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `notificacion`
--

INSERT INTO `notificacion` (`idnotificacion`, `idfactura`, `cliente`, `numerodocumen`, `total`, `metodopago`, `productos`, `visto`, `fechacreacion`) VALUES
(15, 50, 'Oscar', 1111111121, 35000.00, 'bancolombia', 'Talco Multicare para Pies, 500 g x1', 0, '2026-03-23 22:38:13'),
(16, 51, 'Erika', 1234441325, 35000.00, 'bancolombia', 'Talco Multicare para Pies, 500 g x1', 0, '2026-03-24 20:34:36'),
(17, 52, 'Erika', 1234441325, 912800.00, 'bancolombia', 'Talco Multicare para Pies, 500 g x1, Osadía Eau de Parfum Hombre x7', 0, '2026-03-24 20:44:10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `idproducto` int(11) NOT NULL,
  `precio` int(11) DEFAULT NULL,
  `nombre` varchar(60) DEFAULT NULL,
  `descripcion` varchar(60) DEFAULT NULL,
  `imagen` varchar(250) DEFAULT NULL,
  `idcategoria` int(11) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `fechaingreso` date DEFAULT NULL,
  `idmarca` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`idproducto`, `precio`, `nombre`, `descripcion`, `imagen`, `idcategoria`, `stock`, `fechaingreso`, `idmarca`) VALUES
(18, 35000, 'Talco Multicare para Pies, 500 g', 'Talco antitranspirante y frescura prolongada por 24H. ', 'Talco.webp', 3, 14, '2026-01-30', 7),
(19, 18000, 'Crema Facial Rosa Mosqueta', 'Protege, humecta y regenera ayudando a reducir las marcas. ', 'actualrosamos.webp', 2, 3, '2026-02-01', 8),
(21, 125400, 'Osadía Eau de Parfum Hombre', 'Un perfume para hombre maderoso aromático.', 'osadia.jpg', 5, 0, '2026-02-06', 9),
(23, 110600, 'Vibranza Perfume de Mujer 45 ml', 'Es el perfume de larga duración para mujer con aroma orienta', 'vibranza.webp', 1, 4, '2026-02-20', 7),
(27, 39500, 'Shampoo reestructurante Lumina', 'Limpieza y reparación para un cabello más fuerte y resistent', 'Shampoo natura.jpg', 4, 2, '2026-03-18', 10),
(28, 30000, 'Crema Ultra Hidratante 100g Totalist+ Aguacate ', 'Combina aceite de aguacate con ácido hialurónico para una ac', 'crema yanbal.jpg', 2, 7, '2026-03-18', 9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `idrol` int(11) NOT NULL,
  `nombrerol` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`idrol`, `nombrerol`) VALUES
(1, 'Administrador'),
(3, 'Cliente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `salida`
--

CREATE TABLE `salida` (
  `idsalida` int(11) NOT NULL,
  `idproducto` int(11) DEFAULT NULL,
  `fechasalida` date DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `salida`
--

INSERT INTO `salida` (`idsalida`, `idproducto`, `fechasalida`, `cantidad`) VALUES
(56, 18, '2026-03-20', 1),
(62, 23, '2026-03-20', 1),
(63, 18, '2026-03-20', 1),
(64, 18, '2026-03-20', 1),
(65, 19, '2026-03-20', 1),
(66, 18, '2026-03-23', 1),
(67, 18, '2026-03-23', 2),
(68, 18, '2026-03-24', 1),
(69, 18, '2026-03-24', 2),
(70, 18, '2026-03-24', 1),
(71, 21, '2026-03-24', 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `nombrecompleto` varchar(60) DEFAULT NULL,
  `correoelectronic` varchar(60) DEFAULT NULL,
  `telefono` int(11) DEFAULT NULL,
  `numerodocumen` int(11) NOT NULL,
  `tipogenero` varchar(10) DEFAULT NULL,
  `contra` varchar(10) DEFAULT NULL,
  `idtipo` int(11) DEFAULT NULL,
  `idrol` int(11) NOT NULL,
  `reset_token` varchar(255) DEFAULT NULL,
  `token_expira` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`nombrecompleto`, `correoelectronic`, `telefono`, `numerodocumen`, `tipogenero`, `contra`, `idtipo`, `idrol`, `reset_token`, `token_expira`) VALUES
('Veronica Galindo', 'marinveronica0011@gmail.com', 2147483647, 42018400, 'Masculino', '42018400', 2, 1, NULL, NULL),
('Oscar', 'oscar@gmail.com', 2147488, 1111111121, 'Femenino', 'oscar', 1, 3, NULL, NULL),
('Erika', 'erika@gmail.com', 2147483647, 1234441325, 'Masculino', 'erika', 1, 3, NULL, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`idcategoria`);

--
-- Indices de la tabla `detallefactura`
--
ALTER TABLE `detallefactura`
  ADD PRIMARY KEY (`iddetallefactura`),
  ADD KEY `idfactura` (`idfactura`),
  ADD KEY `idproducto` (`idproducto`);

--
-- Indices de la tabla `devolucion`
--
ALTER TABLE `devolucion`
  ADD PRIMARY KEY (`iddevolucion`),
  ADD KEY `idproducto` (`idproducto`),
  ADD KEY `idfactura` (`idfactura`);

--
-- Indices de la tabla `entrada`
--
ALTER TABLE `entrada`
  ADD PRIMARY KEY (`identrada`),
  ADD KEY `idproducto` (`idproducto`),
  ADD KEY `idusuario` (`numerodocumen`);

--
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`idfactura`),
  ADD KEY `idusuario` (`numerodocumen`);

--
-- Indices de la tabla `idtipodocu`
--
ALTER TABLE `idtipodocu`
  ADD PRIMARY KEY (`idtipo`);

--
-- Indices de la tabla `marca`
--
ALTER TABLE `marca`
  ADD PRIMARY KEY (`idmarca`);

--
-- Indices de la tabla `notificacion`
--
ALTER TABLE `notificacion`
  ADD PRIMARY KEY (`idnotificacion`),
  ADD KEY `idfactura` (`idfactura`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`idproducto`),
  ADD KEY `idcategoria` (`idcategoria`),
  ADD KEY `fk_idmarca` (`idmarca`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`idrol`);

--
-- Indices de la tabla `salida`
--
ALTER TABLE `salida`
  ADD PRIMARY KEY (`idsalida`),
  ADD KEY `idproducto` (`idproducto`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`numerodocumen`),
  ADD KEY `fk_idtipo` (`idtipo`),
  ADD KEY `fk_usuario_rol` (`idrol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `idcategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `detallefactura`
--
ALTER TABLE `detallefactura`
  MODIFY `iddetallefactura` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT de la tabla `devolucion`
--
ALTER TABLE `devolucion`
  MODIFY `iddevolucion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de la tabla `entrada`
--
ALTER TABLE `entrada`
  MODIFY `identrada` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
  MODIFY `idfactura` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT de la tabla `idtipodocu`
--
ALTER TABLE `idtipodocu`
  MODIFY `idtipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `marca`
--
ALTER TABLE `marca`
  MODIFY `idmarca` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `notificacion`
--
ALTER TABLE `notificacion`
  MODIFY `idnotificacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `idproducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `idrol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `salida`
--
ALTER TABLE `salida`
  MODIFY `idsalida` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detallefactura`
--
ALTER TABLE `detallefactura`
  ADD CONSTRAINT `detallefactura_ibfk_1` FOREIGN KEY (`idfactura`) REFERENCES `factura` (`idfactura`),
  ADD CONSTRAINT `detallefactura_ibfk_2` FOREIGN KEY (`idproducto`) REFERENCES `producto` (`idproducto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `devolucion`
--
ALTER TABLE `devolucion`
  ADD CONSTRAINT `devolucion_ibfk_1` FOREIGN KEY (`idproducto`) REFERENCES `producto` (`idproducto`),
  ADD CONSTRAINT `devolucion_ibfk_3` FOREIGN KEY (`idfactura`) REFERENCES `factura` (`idfactura`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `entrada`
--
ALTER TABLE `entrada`
  ADD CONSTRAINT `entrada_ibfk_1` FOREIGN KEY (`idproducto`) REFERENCES `producto` (`idproducto`),
  ADD CONSTRAINT `entrada_ibfk_usuario` FOREIGN KEY (`numerodocumen`) REFERENCES `usuario` (`numerodocumen`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `factura`
--
ALTER TABLE `factura`
  ADD CONSTRAINT `factura_ibfk_usuario` FOREIGN KEY (`numerodocumen`) REFERENCES `usuario` (`numerodocumen`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `notificacion`
--
ALTER TABLE `notificacion`
  ADD CONSTRAINT `notificacion_ibfk_1` FOREIGN KEY (`idfactura`) REFERENCES `factura` (`idfactura`) ON DELETE CASCADE;

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `fk_idmarca` FOREIGN KEY (`idmarca`) REFERENCES `marca` (`idmarca`),
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`idcategoria`) REFERENCES `categoria` (`idcategoria`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `salida`
--
ALTER TABLE `salida`
  ADD CONSTRAINT `salida_ibfk_1` FOREIGN KEY (`idproducto`) REFERENCES `producto` (`idproducto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_idtipo` FOREIGN KEY (`idtipo`) REFERENCES `idtipodocu` (`idtipo`),
  ADD CONSTRAINT `fk_usuario_rol` FOREIGN KEY (`idrol`) REFERENCES `rol` (`idrol`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
