-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-09-2025 a las 08:42:10
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `miselaneabeauty`
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
(1, 'Lociones', 'Fragancias para hombre, mujer y uso diario'),
(2, 'Cremas corporales', 'Hidratantes y nutritivas para todo tipo de piel'),
(3, 'Champ?s', 'Capilares para diferentes tipos de cabello'),
(4, 'Acondicionadores', 'Complemento para suavizar y desenredar el cabello'),
(5, 'Desodorantes', 'Presentaciones en spray, roll-on y barra'),
(6, 'Jabones de tocador', 'Arom?ticos y neutros para el cuidado personal'),
(7, 'Maquillaje b?sico', 'Labiales, polvos compactos y delineadores'),
(8, 'Accesorios de cuidado personal', 'Peines, cepillos, ligas y pinzas'),
(9, 'Productos para beb?', 'Talcos, aceites y jabones suaves'),
(10, 'Art?culos de regalo', 'Estuches de belleza y combos especiales');

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
(1, 1, 4, 22, 30000, 123333),
(2, 2, 1, 1, 120000, 120000),
(3, 3, 1, 1, 25000, 25000),
(4, 4, 1, 1, 30000, 30000),
(5, 5, 1, 1, 25000, 25000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `devolucion`
--

CREATE TABLE `devolucion` (
  `iddevolucion` int(11) NOT NULL,
  `idproducto` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `fechaingreso` date DEFAULT NULL,
  `idusuario` int(11) DEFAULT NULL,
  `idfactura` int(11) DEFAULT NULL,
  `descripcionmotivo` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `devolucion`
--

INSERT INTO `devolucion` (`iddevolucion`, `idproducto`, `cantidad`, `fechaingreso`, `idusuario`, `idfactura`, `descripcionmotivo`) VALUES
(1, 1, 1, '2025-09-28', 1, 1, '...'),
(2, 2, 1, '2025-09-28', 2, 2, '...'),
(3, 3, 1, '2025-09-28', 3, 3, '...'),
(4, 4, 1, '2025-09-28', 4, 4, '...'),
(5, 5, 1, '2025-09-28', 5, 5, '...');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entrada`
--

CREATE TABLE `entrada` (
  `identrada` int(11) NOT NULL,
  `idproducto` int(11) DEFAULT NULL,
  `idusuario` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `fechaentrada` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `entrada`
--

INSERT INTO `entrada` (`identrada`, `idproducto`, `idusuario`, `cantidad`, `fechaentrada`) VALUES
(1, 2, 4, 23, '2025-09-28'),
(2, 3, 5, 12, '2025-09-28'),
(3, 1, 8, 2, '2025-09-28'),
(4, 4, 10, 5, '2025-09-28'),
(5, 5, 3, 1, '2025-09-28');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE `factura` (
  `idfactura` int(11) NOT NULL,
  `fechayhora` datetime DEFAULT NULL,
  `idusuario` int(11) DEFAULT NULL,
  `totalfactura` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `factura`
--

INSERT INTO `factura` (`idfactura`, `fechayhora`, `idusuario`, `totalfactura`) VALUES
(1, '2025-09-28 08:00:00', 1, 12344),
(2, '2025-09-28 02:00:00', 2, 12000),
(3, '2025-03-21 04:00:00', 3, 13000),
(4, '2025-03-21 07:00:00', 4, 20000),
(5, '2025-05-01 06:00:00', 5, 500000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `idproducto` int(11) NOT NULL,
  `precio` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `nombre` varchar(60) DEFAULT NULL,
  `descripcion` varchar(60) DEFAULT NULL,
  `imagen` varchar(250) DEFAULT NULL,
  `marca` varchar(20) DEFAULT NULL,
  `idcategoria` int(11) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `fechaingreso` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`idproducto`, `precio`, `cantidad`, `nombre`, `descripcion`, `imagen`, `marca`, `idcategoria`, `stock`, `fechaingreso`) VALUES
(1, 120000, 10, 'Loci?n Hugo Boss', 'Fragancia masculina de larga duraci?n', 'locion_hugo.jpg', 'Hugo Boss', 1, 10, '2025-09-28'),
(2, 150000, 5, 'Perfume CK One', 'Fragancia unisex fresca y c?trica', 'ck_one.jpg', 'Calvin Klein', 1, 5, '2025-09-28'),
(3, 25000, 12, 'Crema Nivea', 'Crema corporal hidratante cl?sica', 'crema_nivea.jpg', 'Nivea', 2, 30, '2025-09-28'),
(4, 30000, 15, 'Crema Pond?s', 'Crema facial antiarrugas', 'crema_nivea.jpg', 'Nivea', 2, 30, '2025-09-28'),
(5, 25000, 30, 'Crema Pond?s', 'Crema facial antiarrugas', 'crema_nivea.jpg', 'Nivea', 2, 30, '2025-09-28');

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
(1, 1, '2025-09-28', 1),
(2, 2, '2025-09-28', 1),
(3, 3, '2025-09-28', 1),
(4, 4, '2025-09-28', 1),
(5, 5, '2025-09-28', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idusuario` int(11) NOT NULL,
  `nombrecompleto` varchar(60) DEFAULT NULL,
  `correoelectronic` varchar(60) DEFAULT NULL,
  `telefono` int(11) DEFAULT NULL,
  `tipodocumen` varchar(10) DEFAULT NULL,
  `numerodocumen` int(11) DEFAULT NULL,
  `tipogenero` varchar(10) DEFAULT NULL,
  `contra` varchar(10) DEFAULT NULL,
  `rol` varchar(10) DEFAULT NULL,
  `cargo` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idusuario`, `nombrecompleto`, `correoelectronic`, `telefono`, `tipodocumen`, `numerodocumen`, `tipogenero`, `contra`, `rol`, `cargo`) VALUES
(1, 'Sara Galindo', 'sarag12@gmail.com', 320476512, 'CC', 125432, 'Femenino', 'saragg', 'Usuario', 'Usuario'),
(2, 'Pedro Pascal', 'pedro3@gmail.com', 32047234, 'RC', 125431, 'Masculino', 'pedro543', 'Usuario', 'Usuario'),
(3, 'Veronica Galindo', 'veromarin@gmail.com', 32043561, 'CC', 124566, 'Femenino', 'veromarin', 'Usuario', 'Administra'),
(4, 'Rocio Pulido', 'rociooo@gmail.com', 3204441, 'CC', 144466, 'Femenino', 'rociorr', 'Usuario', 'Empleado'),
(5, 'Valeria Sanchez', 'valeriao@gmail.com', 3211134, 'CC', 234456, 'Femenino', 'valeria2', 'Usuario', 'Empleado'),
(6, 'Armando Mendoza', 'asrmn@gmail.com', 32112345, 'CC', 234234, 'Masculino', 'Armando2', 'Usuario', 'Usuario'),
(7, 'Camilo Fuentes', 'nfirhg@gmail.com', 32134555, 'CC', 234234, 'Masculino', 'camilo2', 'Usuario', 'Usuario'),
(8, 'Mishel Arias', 'fffg@gmail.com', 32134222, 'CC', 234994, 'Femenino', 'mishel2', 'Usuario', 'Usuario'),
(9, 'Sandra Ramirez', 'sandraoo@gmail.com', 3234222, 'CC', 443212, 'Femenino', 'sandra345', 'Usuario', 'Usuario'),
(10, 'Diego Triana', 'diegg34@gmail.com', 33214453, 'TI', 444324, 'Masculino', 'diegoa345', 'Usuario', 'Usuario');

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
  ADD KEY `idusuario` (`idusuario`),
  ADD KEY `idfactura` (`idfactura`);

--
-- Indices de la tabla `entrada`
--
ALTER TABLE `entrada`
  ADD PRIMARY KEY (`identrada`),
  ADD KEY `idproducto` (`idproducto`),
  ADD KEY `idusuario` (`idusuario`);

--
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`idfactura`),
  ADD KEY `idusuario` (`idusuario`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`idproducto`),
  ADD KEY `idcategoria` (`idcategoria`);

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
  ADD PRIMARY KEY (`idusuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `idcategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `detallefactura`
--
ALTER TABLE `detallefactura`
  MODIFY `iddetallefactura` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `devolucion`
--
ALTER TABLE `devolucion`
  MODIFY `iddevolucion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `entrada`
--
ALTER TABLE `entrada`
  MODIFY `identrada` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
  MODIFY `idfactura` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `idproducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `salida`
--
ALTER TABLE `salida`
  MODIFY `idsalida` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
  ADD CONSTRAINT `devolucion_ibfk_2` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`),
  ADD CONSTRAINT `devolucion_ibfk_3` FOREIGN KEY (`idfactura`) REFERENCES `factura` (`idfactura`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `entrada`
--
ALTER TABLE `entrada`
  ADD CONSTRAINT `entrada_ibfk_1` FOREIGN KEY (`idproducto`) REFERENCES `producto` (`idproducto`),
  ADD CONSTRAINT `entrada_ibfk_2` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `factura`
--
ALTER TABLE `factura`
  ADD CONSTRAINT `factura_ibfk_1` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`idcategoria`) REFERENCES `categoria` (`idcategoria`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `salida`
--
ALTER TABLE `salida`
  ADD CONSTRAINT `salida_ibfk_1` FOREIGN KEY (`idproducto`) REFERENCES `producto` (`idproducto`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
