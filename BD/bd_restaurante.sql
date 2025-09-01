-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-08-2025 a las 00:32:09
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
-- Base de datos: `bd_restaurante`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria_plato`
--

CREATE TABLE `categoria_plato` (
  `cat_id` int(2) NOT NULL,
  `cat_descripcion` varchar(40) DEFAULT NULL,
  `cat_estado` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categoria_plato`
--

INSERT INTO `categoria_plato` (`cat_id`, `cat_descripcion`, `cat_estado`) VALUES
(1, 'Entrada', 'Activo'),
(2, 'Plato Fuerte', 'Activo'),
(3, 'Postre', 'Activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `cli_id` int(15) NOT NULL,
  `cli_nombre` varchar(60) DEFAULT NULL,
  `cli_apellidos` varchar(60) DEFAULT NULL,
  `cli_direccion` varchar(40) DEFAULT NULL,
  `cli_telefono` varchar(40) DEFAULT NULL,
  `cli_correo` varchar(40) NOT NULL,
  `cli_estado` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`cli_id`, `cli_nombre`, `cli_apellidos`, `cli_direccion`, `cli_telefono`, `cli_correo`, `cli_estado`) VALUES
(1, 'Juan Jose ', 'Canizalez Velarde', 'Cra 2c # 23-68', '3104321486', 'jcanizalez@gmail.com', 'InActivo'),
(2, 'Juan', 'Galvis Osorio', 'Cra 26P #44-42', '3157621528', 'galvis520@gmail.com', 'Activo'),
(3, 'Juan', 'Dineno', 'ave', '4445566', 'dineg@hotmail.com', 'InActivo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comanda`
--

CREATE TABLE `comanda` (
  `com_id` int(11) NOT NULL,
  `mesa` int(2) DEFAULT NULL,
  `pla_id` int(11) DEFAULT NULL,
  `com_obs` varchar(60) NOT NULL,
  `est_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `concepto`
--

CREATE TABLE `concepto` (
  `con_id` int(3) NOT NULL,
  `con_descripcion` varchar(100) NOT NULL,
  `con_estado` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `concepto`
--

INSERT INTO `concepto` (`con_id`, `con_descripcion`, `con_estado`) VALUES
(2, 'Pago a terceros', 'Activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `encabezado_egresos`
--

CREATE TABLE `encabezado_egresos` (
  `id` int(11) NOT NULL,
  `no_egreso` int(11) NOT NULL,
  `fecha_documento` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `tercero_identificacion` varchar(15) NOT NULL,
  `detalle` varchar(250) NOT NULL,
  `fp_id` int(3) NOT NULL,
  `conceptoEgreso_codigo` int(4) NOT NULL,
  `no_documento` varchar(15) NOT NULL,
  `valor_egreso` double NOT NULL,
  `usu_crea` varchar(15) NOT NULL,
  `estado` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado`
--

CREATE TABLE `estado` (
  `est_id` int(11) NOT NULL,
  `est_descripcion` varchar(40) DEFAULT NULL,
  `tes_id` int(2) NOT NULL,
  `est_estado` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `estado`
--

INSERT INTO `estado` (`est_id`, `est_descripcion`, `tes_id`, `est_estado`) VALUES
(1, 'En Preparación', 1, 'InActivo'),
(2, 'Finalizada', 1, 'Activo'),
(3, 'Cancelada', 1, 'Activo'),
(4, 'Creado', 2, 'Activo'),
(5, 'Finalizado', 2, 'Activo'),
(6, 'Cancelado', 2, 'Activo'),
(7, 'Creado', 3, 'Activo'),
(8, 'Disponible', 3, 'Activo'),
(9, 'Inactivo', 3, 'Activo'),
(10, 'Agotado', 3, 'Activo'),
(11, 'Pendiente', 4, 'Activo'),
(12, 'Atendida', 4, 'Activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `forma_pago`
--

CREATE TABLE `forma_pago` (
  `fp_id` int(2) NOT NULL,
  `fp_descripcion` varchar(50) NOT NULL,
  `fp_estado` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `forma_pago`
--

INSERT INTO `forma_pago` (`fp_id`, `fp_descripcion`, `fp_estado`) VALUES
(1, 'Efectivo', 'Activo'),
(2, 'Transferencia', 'Activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE `pedido` (
  `ped_id` int(11) NOT NULL,
  `ped_fecha` date DEFAULT NULL,
  `usu_id` int(11) DEFAULT NULL,
  `ped_mesa` varchar(4) NOT NULL,
  `est_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `pedido`
--

INSERT INTO `pedido` (`ped_id`, `ped_fecha`, `usu_id`, `ped_mesa`, `est_id`) VALUES
(1, '2019-06-01', 1234, '10', 4),
(2, '2019-06-01', 1234, '3', 4),
(3, '2019-09-29', 1234, '15', 4),
(4, '2024-11-20', 1234, '4', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido_detalle`
--

CREATE TABLE `pedido_detalle` (
  `ped_det_id` int(11) NOT NULL,
  `ped_det_cant` int(11) DEFAULT NULL,
  `ped_det_precio` float DEFAULT NULL,
  `ped_det_obser` varchar(40) DEFAULT NULL,
  `pla_id` int(11) DEFAULT NULL,
  `ped_id` int(11) DEFAULT NULL,
  `est_id` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `pedido_detalle`
--

INSERT INTO `pedido_detalle` (`ped_det_id`, `ped_det_cant`, `ped_det_precio`, `ped_det_obser`, `pla_id`, `ped_id`, `est_id`) VALUES
(1, 2, 12000, 'Sin Alcaparras', 2, 1, 1),
(2, 1, 10000, 'Con doble prociÃ³n de chicharron', 1, 1, 1),
(5, 1, 12000, 'No Aplica', 2, 2, 1),
(6, 2, 1552, 'sin pollo', 2, 3, 1),
(7, 2, 13000, 'Adicionar verduras', 2, 4, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil`
--

CREATE TABLE `perfil` (
  `perf_id` int(11) NOT NULL,
  `perf_descripcion` varchar(40) DEFAULT NULL,
  `perf_estado` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `perfil`
--

INSERT INTO `perfil` (`perf_id`, `perf_descripcion`, `perf_estado`) VALUES
(1, 'Admin', 'Activo'),
(2, 'Auxiliar', 'Activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plato`
--

CREATE TABLE `plato` (
  `pla_id` int(11) NOT NULL,
  `pla_descripcion` varchar(40) DEFAULT NULL,
  `pla_precio` float DEFAULT NULL,
  `est_id` int(11) DEFAULT NULL,
  `cat_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `plato`
--

INSERT INTO `plato` (`pla_id`, `pla_descripcion`, `pla_precio`, `est_id`, `cat_id`) VALUES
(1, 'Bandeja Paisa', 10000, 9, 2),
(2, 'Ajiaco', 10000, 8, 2),
(3, 'Consome', 4000, 8, 2),
(4, 'Arroz Mixto', 12000, 8, 2),
(5, 'Pasta', 125000, 8, 2),
(7, 'Arroz con pollo', 120000, 8, 2),
(8, 'Pollo con champiñones', 120000, 8, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pqrs`
--

CREATE TABLE `pqrs` (
  `pqrs_id` int(4) NOT NULL,
  `pqrs_fecha` date NOT NULL,
  `pqrs_descripcion` blob NOT NULL,
  `pqrs_correo` varchar(60) NOT NULL,
  `pqrs_telefono` varchar(20) NOT NULL,
  `tpqrs_id` int(2) NOT NULL,
  `est_id` int(2) NOT NULL,
  `pqrs_respuesta` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recibo_caja`
--

CREATE TABLE `recibo_caja` (
  `rc_num` int(11) NOT NULL,
  `usu_id` int(15) NOT NULL,
  `rc_fecha` date NOT NULL,
  `ped_id` int(11) NOT NULL,
  `cli_id` int(15) NOT NULL,
  `rc_total` double NOT NULL,
  `rc_observacion` varchar(360) NOT NULL,
  `rc_estado` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recibo_caja_detalle`
--

CREATE TABLE `recibo_caja_detalle` (
  `rcd_id` int(11) NOT NULL,
  `rcd_num` int(11) NOT NULL,
  `pla_id` int(4) NOT NULL,
  `rcd_precio` double NOT NULL,
  `rcd_cantidad` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_estado`
--

CREATE TABLE `tipo_estado` (
  `tes_id` int(2) NOT NULL,
  `tes_descripcion` varchar(40) NOT NULL,
  `tes_estado` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `tipo_estado`
--

INSERT INTO `tipo_estado` (`tes_id`, `tes_descripcion`, `tes_estado`) VALUES
(1, 'Peticion', 'Activo'),
(2, 'Pedido', 'InActivo'),
(3, 'Plato', 'Activo'),
(4, 'PQRS', 'Activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_tpqrs`
--

CREATE TABLE `tipo_tpqrs` (
  `tpqrs_id` int(2) NOT NULL,
  `tpqrs_descripcion` varchar(40) DEFAULT NULL,
  `tpqrs_estado` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `tipo_tpqrs`
--

INSERT INTO `tipo_tpqrs` (`tpqrs_id`, `tpqrs_descripcion`, `tpqrs_estado`) VALUES
(1, 'Peticion', 'Activo'),
(2, 'Queja', 'Activo'),
(3, 'Reclamo', 'Activo'),
(4, 'Sugerencia', 'Activo'),
(5, 'Felicitaciones', 'Activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `usu_id` int(11) NOT NULL,
  `usu_nombre` varchar(60) NOT NULL,
  `usu_apellido` varchar(60) NOT NULL,
  `usu_direccion` varchar(100) NOT NULL,
  `usu_telefono` varchar(20) NOT NULL,
  `usu_correo` varchar(70) NOT NULL,
  `perf_id` int(11) DEFAULT NULL,
  `usu_login` varchar(30) NOT NULL,
  `usu_pass` varchar(30) NOT NULL,
  `usu_estado` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`usu_id`, `usu_nombre`, `usu_apellido`, `usu_direccion`, `usu_telefono`, `usu_correo`, `perf_id`, `usu_login`, `usu_pass`, `usu_estado`) VALUES
(1234, 'Admin', '', '', '', '', 1, 'admin', '1234', 'Activo');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria_plato`
--
ALTER TABLE `categoria_plato`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`cli_id`);

--
-- Indices de la tabla `comanda`
--
ALTER TABLE `comanda`
  ADD PRIMARY KEY (`com_id`),
  ADD KEY `pla_id` (`pla_id`),
  ADD KEY `est_id` (`est_id`);

--
-- Indices de la tabla `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`est_id`),
  ADD KEY `tes_id` (`tes_id`);

--
-- Indices de la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`ped_id`),
  ADD KEY `est_id` (`est_id`),
  ADD KEY `usu_id` (`usu_id`);

--
-- Indices de la tabla `pedido_detalle`
--
ALTER TABLE `pedido_detalle`
  ADD PRIMARY KEY (`ped_det_id`),
  ADD KEY `pla_id` (`pla_id`),
  ADD KEY `ped_id` (`ped_id`);

--
-- Indices de la tabla `perfil`
--
ALTER TABLE `perfil`
  ADD PRIMARY KEY (`perf_id`);

--
-- Indices de la tabla `plato`
--
ALTER TABLE `plato`
  ADD PRIMARY KEY (`pla_id`),
  ADD KEY `est_id` (`est_id`);

--
-- Indices de la tabla `pqrs`
--
ALTER TABLE `pqrs`
  ADD PRIMARY KEY (`pqrs_id`),
  ADD KEY `est_id` (`est_id`),
  ADD KEY `tpqrs_id` (`tpqrs_id`);

--
-- Indices de la tabla `recibo_caja`
--
ALTER TABLE `recibo_caja`
  ADD PRIMARY KEY (`rc_num`),
  ADD KEY `ped_id` (`ped_id`),
  ADD KEY `cli_id` (`cli_id`),
  ADD KEY `usu_id` (`usu_id`);

--
-- Indices de la tabla `recibo_caja_detalle`
--
ALTER TABLE `recibo_caja_detalle`
  ADD PRIMARY KEY (`rcd_id`),
  ADD KEY `pla_id` (`pla_id`),
  ADD KEY `rcd_num` (`rcd_num`);

--
-- Indices de la tabla `tipo_estado`
--
ALTER TABLE `tipo_estado`
  ADD PRIMARY KEY (`tes_id`);

--
-- Indices de la tabla `tipo_tpqrs`
--
ALTER TABLE `tipo_tpqrs`
  ADD PRIMARY KEY (`tpqrs_id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`usu_id`),
  ADD KEY `perf_id` (`perf_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria_plato`
--
ALTER TABLE `categoria_plato`
  MODIFY `cat_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `cli_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `comanda`
--
ALTER TABLE `comanda`
  MODIFY `com_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `estado`
--
ALTER TABLE `estado`
  MODIFY `est_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `pedido`
--
ALTER TABLE `pedido`
  MODIFY `ped_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `pedido_detalle`
--
ALTER TABLE `pedido_detalle`
  MODIFY `ped_det_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `perfil`
--
ALTER TABLE `perfil`
  MODIFY `perf_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `plato`
--
ALTER TABLE `plato`
  MODIFY `pla_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `pqrs`
--
ALTER TABLE `pqrs`
  MODIFY `pqrs_id` int(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `recibo_caja`
--
ALTER TABLE `recibo_caja`
  MODIFY `rc_num` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `recibo_caja_detalle`
--
ALTER TABLE `recibo_caja_detalle`
  MODIFY `rcd_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipo_estado`
--
ALTER TABLE `tipo_estado`
  MODIFY `tes_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tipo_tpqrs`
--
ALTER TABLE `tipo_tpqrs`
  MODIFY `tpqrs_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `usu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1144156105;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comanda`
--
ALTER TABLE `comanda`
  ADD CONSTRAINT `comanda_ibfk_1` FOREIGN KEY (`pla_id`) REFERENCES `plato` (`pla_id`),
  ADD CONSTRAINT `comanda_ibfk_2` FOREIGN KEY (`est_id`) REFERENCES `estado` (`est_id`);

--
-- Filtros para la tabla `estado`
--
ALTER TABLE `estado`
  ADD CONSTRAINT `estado_ibfk_1` FOREIGN KEY (`tes_id`) REFERENCES `tipo_estado` (`tes_id`);

--
-- Filtros para la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `pedido_ibfk_1` FOREIGN KEY (`est_id`) REFERENCES `estado` (`est_id`),
  ADD CONSTRAINT `pedido_ibfk_2` FOREIGN KEY (`usu_id`) REFERENCES `usuario` (`usu_id`);

--
-- Filtros para la tabla `pedido_detalle`
--
ALTER TABLE `pedido_detalle`
  ADD CONSTRAINT `pedido_detalle_ibfk_1` FOREIGN KEY (`pla_id`) REFERENCES `plato` (`pla_id`),
  ADD CONSTRAINT `pedido_detalle_ibfk_2` FOREIGN KEY (`ped_id`) REFERENCES `pedido` (`ped_id`);

--
-- Filtros para la tabla `plato`
--
ALTER TABLE `plato`
  ADD CONSTRAINT `plato_ibfk_1` FOREIGN KEY (`est_id`) REFERENCES `estado` (`est_id`);

--
-- Filtros para la tabla `pqrs`
--
ALTER TABLE `pqrs`
  ADD CONSTRAINT `pqrs_ibfk_1` FOREIGN KEY (`est_id`) REFERENCES `estado` (`est_id`),
  ADD CONSTRAINT `pqrs_ibfk_2` FOREIGN KEY (`tpqrs_id`) REFERENCES `tipo_tpqrs` (`tpqrs_id`);

--
-- Filtros para la tabla `recibo_caja`
--
ALTER TABLE `recibo_caja`
  ADD CONSTRAINT `recibo_caja_ibfk_1` FOREIGN KEY (`ped_id`) REFERENCES `pedido` (`ped_id`),
  ADD CONSTRAINT `recibo_caja_ibfk_2` FOREIGN KEY (`cli_id`) REFERENCES `cliente` (`cli_id`),
  ADD CONSTRAINT `recibo_caja_ibfk_3` FOREIGN KEY (`usu_id`) REFERENCES `usuario` (`usu_id`);

--
-- Filtros para la tabla `recibo_caja_detalle`
--
ALTER TABLE `recibo_caja_detalle`
  ADD CONSTRAINT `recibo_caja_detalle_ibfk_1` FOREIGN KEY (`pla_id`) REFERENCES `plato` (`pla_id`),
  ADD CONSTRAINT `recibo_caja_detalle_ibfk_2` FOREIGN KEY (`rcd_num`) REFERENCES `recibo_caja` (`rc_num`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`perf_id`) REFERENCES `perfil` (`perf_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
