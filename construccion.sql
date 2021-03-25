-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-03-2021 a las 22:52:34
-- Versión del servidor: 10.4.17-MariaDB
-- Versión de PHP: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `construccion`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bodeguero`
--

CREATE TABLE `bodeguero` (
  `id_bod` int(11) NOT NULL,
  `rut_bod` varchar(10) NOT NULL,
  `nom_bod` varchar(20) NOT NULL,
  `ape_bod` varchar(20) NOT NULL,
  `ema_bod` varchar(50) NOT NULL,
  `pw_bod` varchar(8) NOT NULL,
  `fk_direccion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `bodeguero`
--

INSERT INTO `bodeguero` (`id_bod`, `rut_bod`, `nom_bod`, `ape_bod`, `ema_bod`, `pw_bod`, `fk_direccion`) VALUES
(1, '176633395', 'ariel', 'varetto', 'arielvaretto@gmail.com', '123', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comuna`
--

CREATE TABLE `comuna` (
  `id_com` int(11) NOT NULL,
  `nom_com` varchar(20) NOT NULL,
  `fk_region` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `comuna`
--

INSERT INTO `comuna` (`id_com`, `nom_com`, `fk_region`) VALUES
(1, 'san bernardo', 1),
(2, 'el bosque', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `det_entrega`
--

CREATE TABLE `det_entrega` (
  `id_det` int(11) NOT NULL,
  `fk_entrega` int(11) NOT NULL,
  `fk_material` int(11) NOT NULL,
  `cant_material` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `det_prestamo`
--

CREATE TABLE `det_prestamo` (
  `id_det` int(11) NOT NULL,
  `fk_prestamo` int(11) NOT NULL,
  `fk_herramienta` int(11) NOT NULL,
  `cant_herramienta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `direccion`
--

CREATE TABLE `direccion` (
  `id_dir` int(11) NOT NULL,
  `calle_dir` varchar(20) NOT NULL,
  `num_dir` varchar(10) NOT NULL,
  `fk_comuna` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `direccion`
--

INSERT INTO `direccion` (`id_dir`, `calle_dir`, `num_dir`, `fk_comuna`) VALUES
(1, 'pasaje san marcos', '123', 1),
(2, 'los guindos', '456', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entrega`
--

CREATE TABLE `entrega` (
  `id_ent` int(11) NOT NULL,
  `fec_ent` date NOT NULL,
  `fk_bodeguero` int(11) NOT NULL,
  `fk_obrero` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `herramienta`
--

CREATE TABLE `herramienta` (
  `id_her` int(11) NOT NULL,
  `nom_her` varchar(20) NOT NULL,
  `stock_her` int(11) NOT NULL,
  `fk_tipo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `herramienta`
--

INSERT INTO `herramienta` (`id_her`, `nom_her`, `stock_her`, `fk_tipo`) VALUES
(2, 'martillo', 1, 1),
(3, 'martillo', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `material`
--

CREATE TABLE `material` (
  `id_mat` int(11) NOT NULL,
  `nom_mat` varchar(20) NOT NULL,
  `stock_mat` int(11) NOT NULL,
  `fk_tipo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `material`
--

INSERT INTO `material` (`id_mat`, `nom_mat`, `stock_mat`, `fk_tipo`) VALUES
(2, 'pino 2x2', 10, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `obrero`
--

CREATE TABLE `obrero` (
  `id_obr` int(11) NOT NULL,
  `rut_obr` varchar(10) NOT NULL,
  `nom_obr` varchar(20) NOT NULL,
  `ape_obr` varchar(20) NOT NULL,
  `fk_direccion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `obrero`
--

INSERT INTO `obrero` (`id_obr`, `rut_obr`, `nom_obr`, `ape_obr`, `fk_direccion`) VALUES
(1, '180000001', 'pedro', 'perez', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prestamo`
--

CREATE TABLE `prestamo` (
  `id_pre` int(11) NOT NULL,
  `fec_pre` date NOT NULL,
  `fk_bodeguero` int(11) NOT NULL,
  `fk_obrero` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `region`
--

CREATE TABLE `region` (
  `id_reg` int(11) NOT NULL,
  `nom_reg` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `region`
--

INSERT INTO `region` (`id_reg`, `nom_reg`) VALUES
(1, 'metropolitana');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_herramienta`
--

CREATE TABLE `tipo_herramienta` (
  `id_tip` int(11) NOT NULL,
  `nom_tip` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipo_herramienta`
--

INSERT INTO `tipo_herramienta` (`id_tip`, `nom_tip`) VALUES
(1, 'Martillos y Mazos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_material`
--

CREATE TABLE `tipo_material` (
  `id_tip` int(11) NOT NULL,
  `nom_tip` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipo_material`
--

INSERT INTO `tipo_material` (`id_tip`, `nom_tip`) VALUES
(1, 'maderas y tableros');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `bodeguero`
--
ALTER TABLE `bodeguero`
  ADD PRIMARY KEY (`id_bod`),
  ADD UNIQUE KEY `rut_bod` (`rut_bod`),
  ADD UNIQUE KEY `ema_bod` (`ema_bod`),
  ADD UNIQUE KEY `fk_direccion` (`fk_direccion`);

--
-- Indices de la tabla `comuna`
--
ALTER TABLE `comuna`
  ADD PRIMARY KEY (`id_com`),
  ADD KEY `fkcom_reg` (`fk_region`);

--
-- Indices de la tabla `det_entrega`
--
ALTER TABLE `det_entrega`
  ADD PRIMARY KEY (`id_det`),
  ADD KEY `fkdetent_ent` (`fk_entrega`),
  ADD KEY `fkdetent_mat` (`fk_material`);

--
-- Indices de la tabla `det_prestamo`
--
ALTER TABLE `det_prestamo`
  ADD PRIMARY KEY (`id_det`),
  ADD KEY `fkdetpre_pre` (`fk_prestamo`),
  ADD KEY `fkdetpre_her` (`fk_herramienta`);

--
-- Indices de la tabla `direccion`
--
ALTER TABLE `direccion`
  ADD PRIMARY KEY (`id_dir`),
  ADD KEY `fkdir_com` (`fk_comuna`);

--
-- Indices de la tabla `entrega`
--
ALTER TABLE `entrega`
  ADD PRIMARY KEY (`id_ent`),
  ADD KEY `fkent_bod` (`fk_bodeguero`),
  ADD KEY `fkent_obr` (`fk_obrero`);

--
-- Indices de la tabla `herramienta`
--
ALTER TABLE `herramienta`
  ADD PRIMARY KEY (`id_her`),
  ADD KEY `fkher_tipher` (`fk_tipo`);

--
-- Indices de la tabla `material`
--
ALTER TABLE `material`
  ADD PRIMARY KEY (`id_mat`),
  ADD KEY `fkmat_tipmat` (`fk_tipo`);

--
-- Indices de la tabla `obrero`
--
ALTER TABLE `obrero`
  ADD PRIMARY KEY (`id_obr`),
  ADD UNIQUE KEY `rut_obr` (`rut_obr`),
  ADD UNIQUE KEY `fk_direccion` (`fk_direccion`);

--
-- Indices de la tabla `prestamo`
--
ALTER TABLE `prestamo`
  ADD PRIMARY KEY (`id_pre`),
  ADD KEY `fkpre_bod` (`fk_bodeguero`),
  ADD KEY `fkpre_obr` (`fk_obrero`);

--
-- Indices de la tabla `region`
--
ALTER TABLE `region`
  ADD PRIMARY KEY (`id_reg`);

--
-- Indices de la tabla `tipo_herramienta`
--
ALTER TABLE `tipo_herramienta`
  ADD PRIMARY KEY (`id_tip`);

--
-- Indices de la tabla `tipo_material`
--
ALTER TABLE `tipo_material`
  ADD PRIMARY KEY (`id_tip`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `bodeguero`
--
ALTER TABLE `bodeguero`
  MODIFY `id_bod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `comuna`
--
ALTER TABLE `comuna`
  MODIFY `id_com` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `det_entrega`
--
ALTER TABLE `det_entrega`
  MODIFY `id_det` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `det_prestamo`
--
ALTER TABLE `det_prestamo`
  MODIFY `id_det` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `direccion`
--
ALTER TABLE `direccion`
  MODIFY `id_dir` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `entrega`
--
ALTER TABLE `entrega`
  MODIFY `id_ent` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `herramienta`
--
ALTER TABLE `herramienta`
  MODIFY `id_her` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `material`
--
ALTER TABLE `material`
  MODIFY `id_mat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `obrero`
--
ALTER TABLE `obrero`
  MODIFY `id_obr` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `prestamo`
--
ALTER TABLE `prestamo`
  MODIFY `id_pre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `region`
--
ALTER TABLE `region`
  MODIFY `id_reg` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tipo_herramienta`
--
ALTER TABLE `tipo_herramienta`
  MODIFY `id_tip` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tipo_material`
--
ALTER TABLE `tipo_material`
  MODIFY `id_tip` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `bodeguero`
--
ALTER TABLE `bodeguero`
  ADD CONSTRAINT `fkbod_dir` FOREIGN KEY (`fk_direccion`) REFERENCES `direccion` (`id_dir`);

--
-- Filtros para la tabla `comuna`
--
ALTER TABLE `comuna`
  ADD CONSTRAINT `fkcom_reg` FOREIGN KEY (`fk_region`) REFERENCES `region` (`id_reg`);

--
-- Filtros para la tabla `det_entrega`
--
ALTER TABLE `det_entrega`
  ADD CONSTRAINT `fkdetent_ent` FOREIGN KEY (`fk_entrega`) REFERENCES `entrega` (`id_ent`),
  ADD CONSTRAINT `fkdetent_mat` FOREIGN KEY (`fk_material`) REFERENCES `material` (`id_mat`);

--
-- Filtros para la tabla `det_prestamo`
--
ALTER TABLE `det_prestamo`
  ADD CONSTRAINT `fkdetpre_her` FOREIGN KEY (`fk_herramienta`) REFERENCES `herramienta` (`id_her`),
  ADD CONSTRAINT `fkdetpre_pre` FOREIGN KEY (`fk_prestamo`) REFERENCES `prestamo` (`id_pre`);

--
-- Filtros para la tabla `direccion`
--
ALTER TABLE `direccion`
  ADD CONSTRAINT `fkdir_com` FOREIGN KEY (`fk_comuna`) REFERENCES `comuna` (`id_com`);

--
-- Filtros para la tabla `entrega`
--
ALTER TABLE `entrega`
  ADD CONSTRAINT `fkent_bod` FOREIGN KEY (`fk_bodeguero`) REFERENCES `bodeguero` (`id_bod`),
  ADD CONSTRAINT `fkent_obr` FOREIGN KEY (`fk_obrero`) REFERENCES `obrero` (`id_obr`);

--
-- Filtros para la tabla `herramienta`
--
ALTER TABLE `herramienta`
  ADD CONSTRAINT `fkher_tipher` FOREIGN KEY (`fk_tipo`) REFERENCES `tipo_herramienta` (`id_tip`);

--
-- Filtros para la tabla `material`
--
ALTER TABLE `material`
  ADD CONSTRAINT `fkmat_tipmat` FOREIGN KEY (`fk_tipo`) REFERENCES `tipo_material` (`id_tip`);

--
-- Filtros para la tabla `obrero`
--
ALTER TABLE `obrero`
  ADD CONSTRAINT `fkobr_dir` FOREIGN KEY (`fk_direccion`) REFERENCES `direccion` (`id_dir`);

--
-- Filtros para la tabla `prestamo`
--
ALTER TABLE `prestamo`
  ADD CONSTRAINT `fkpre_bod` FOREIGN KEY (`fk_bodeguero`) REFERENCES `bodeguero` (`id_bod`),
  ADD CONSTRAINT `fkpre_obr` FOREIGN KEY (`fk_obrero`) REFERENCES `obrero` (`id_obr`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
