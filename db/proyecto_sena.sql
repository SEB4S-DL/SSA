-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 05-06-2025 a las 15:03:32
-- Versión del servidor: 9.1.0
-- Versión de PHP: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyecto_sena`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aprendices`
--

DROP TABLE IF EXISTS `aprendices`;
CREATE TABLE IF NOT EXISTS `aprendices` (
  `nro_documento` int NOT NULL,
  `tipo_documento` enum('TI','CC','CE') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nombre` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `segundo_nombre` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `apellido` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `segundo_apellido` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `estado` enum('en formacion','desercion','traslado','cancelado') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `horas_aprobadas` float(7,2) NOT NULL,
  `nro_ficha` int NOT NULL,
  PRIMARY KEY (`nro_documento`),
  KEY `fk_aprendices_nro_ficha` (`nro_ficha`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `aprendices`
--

INSERT INTO `aprendices` (`nro_documento`, `tipo_documento`, `nombre`, `segundo_nombre`, `apellido`, `segundo_apellido`, `estado`, `horas_aprobadas`, `nro_ficha`) VALUES
(123456789, 'TI', 'Alejandro', NULL, 'Zuluaga', NULL, 'en formacion', 999.99, 2895664),
(1001234567, 'CC', 'Juan', NULL, 'Pérez', NULL, 'en formacion', 450.00, 2895664),
(1002345678, 'TI', 'Laura', NULL, 'Gómez', NULL, 'desercion', 120.00, 2895664),
(1003456789, 'CC', 'Carlos', NULL, 'Rodríguez', NULL, 'en formacion', 600.00, 2895664),
(1004567890, 'CE', 'Ana', NULL, 'Martínez', NULL, '', 300.00, 2895664),
(1005678901, 'CC', 'Luis', NULL, 'Sánchez', NULL, 'cancelado', 100.00, 2895664),
(1006789012, 'TI', 'María', NULL, 'López', NULL, 'en formacion', 500.00, 2895664),
(1007890123, 'CC', 'Andrés', NULL, 'Ramírez', NULL, 'en formacion', 480.00, 2895664),
(1008901234, 'CE', 'Diana', NULL, 'Morales', NULL, 'desercion', 200.00, 2895664),
(1012345678, 'CC', 'Sofía', NULL, 'García', NULL, 'en formacion', 550.00, 2895664),
(1013456789, 'TI', 'Jorge', NULL, 'Ruiz', NULL, '', 150.00, 2895664);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `competencias`
--

DROP TABLE IF EXISTS `competencias`;
CREATE TABLE IF NOT EXISTS `competencias` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre_competencia` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `total_horas` int NOT NULL,
  `id_programa_formacion` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_competencias_id_programa_formacion` (`id_programa_formacion`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `competencias`
--

INSERT INTO `competencias` (`id`, `nombre_competencia`, `total_horas`, `id_programa_formacion`) VALUES
(1, 'Implementar la propuesta de solicitud que se solicitó en la solicitación de la solicitud', 303, 2),
(2, 'Implementar la propuesta de solicitud que se solicitó en la solicitación de la solicitud', 23, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fichas`
--

DROP TABLE IF EXISTS `fichas`;
CREATE TABLE IF NOT EXISTS `fichas` (
  `nro_ficha` int NOT NULL,
  `id_jefe_ficha` int NOT NULL,
  `jornada` enum('diurna','mixta','nocturna') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `etapa` enum('lectiva','productiva') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_programa_formacion` int NOT NULL,
  `tipo_oferta` enum('abierta','cerrada') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`nro_ficha`),
  KEY `fk_fichas_id_jefe_ficha` (`id_jefe_ficha`),
  KEY `fk_fichas_id_programa_formacion` (`id_programa_formacion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `fichas`
--

INSERT INTO `fichas` (`nro_ficha`, `id_jefe_ficha`, `jornada`, `etapa`, `id_programa_formacion`, `tipo_oferta`) VALUES
(123, 123456789, 'mixta', 'lectiva', 1, 'cerrada'),
(234, 123456789, 'mixta', 'productiva', 1, 'abierta'),
(321, 123456789, 'diurna', 'lectiva', 2, 'abierta'),
(772, 123456789, 'diurna', 'lectiva', 2, 'abierta'),
(1234, 123456789, 'diurna', 'lectiva', 1, 'abierta'),
(3456, 123456789, 'diurna', 'lectiva', 1, 'abierta'),
(12345, 123456789, 'diurna', 'lectiva', 1, 'cerrada'),
(234567, 123456789, 'diurna', 'lectiva', 1, 'abierta'),
(2895664, 1017148792, 'mixta', 'lectiva', 2, 'cerrada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `juicios_evaluativos`
--

DROP TABLE IF EXISTS `juicios_evaluativos`;
CREATE TABLE IF NOT EXISTS `juicios_evaluativos` (
  `id` int NOT NULL,
  `id_aprendiz` int NOT NULL,
  `id_rae` int NOT NULL,
  `estado` enum('por evaluar','aprobado') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_evaluador` int NOT NULL,
  `observacion` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  PRIMARY KEY (`id`),
  KEY `fk_juicios_evaluativos_id_rae` (`id_rae`),
  KEY `fk_juicios_evaluativos_id_aprendiz` (`id_aprendiz`),
  KEY `fk_juicios_evaluativos_id_evaluador` (`id_evaluador`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `programa_formacion`
--

DROP TABLE IF EXISTS `programa_formacion`;
CREATE TABLE IF NOT EXISTS `programa_formacion` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre_programa` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `total_horas` int NOT NULL,
  `nivel` enum('tecnico','tecnologo') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `programa_formacion`
--

INSERT INTO `programa_formacion` (`id`, `nombre_programa`, `total_horas`, `nivel`) VALUES
(1, 'Técnico en programación', 2000, 'tecnico'),
(2, 'Análisis y desarrollo de software', 3950, 'tecnologo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `resultados_aprendizaje`
--

DROP TABLE IF EXISTS `resultados_aprendizaje`;
CREATE TABLE IF NOT EXISTS `resultados_aprendizaje` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre_rae` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `total_horas` float(4,2) NOT NULL,
  `id_competencia` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_rae_id_competencia` (`id_competencia`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `resultados_aprendizaje`
--

INSERT INTO `resultados_aprendizaje` (`id`, `nombre_rae`, `total_horas`, `id_competencia`) VALUES
(1, 'Implementar la propuesta de solicitud que se solicitó en la solicitación de la solicitud', 20.00, 1),
(2, 'Implementar la propuesta de solicitud que se solicitó en la solicitación de la solicitud', 3.00, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `nro_documento` int NOT NULL,
  `tipo_documento` enum('CC','CE') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nombre` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `segundo_nombre` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `apellido` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `segundo_apellido` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `rol` enum('admin','user') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tipo` enum('tecnico','transversal') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `contrasena` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `fecha_inicio_contrato` date DEFAULT NULL,
  `fecha_fin_contrato` date DEFAULT NULL,
  `correo_institucional` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `estado` enum('habilitado','deshabilitado') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`nro_documento`),
  UNIQUE KEY `correo_institucional` (`correo_institucional`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`nro_documento`, `tipo_documento`, `nombre`, `segundo_nombre`, `apellido`, `segundo_apellido`, `rol`, `tipo`, `contrasena`, `fecha_inicio_contrato`, `fecha_fin_contrato`, `correo_institucional`, `estado`) VALUES
(123, 'CC', 'Mario', NULL, 'López', NULL, 'user', 'tecnico', '', NULL, NULL, '', 'habilitado'),
(123456789, 'CC', 'Andrés', NULL, 'Restrepo', NULL, 'user', 'tecnico', '25f9e794323b453885f5181f1b624d0b', NULL, NULL, 'juanito@example.com', 'habilitado'),
(1017148792, 'CC', 'Andrea', NULL, 'Marin', NULL, 'admin', NULL, 'cff6bb6dd557900e9b4bb4d95ce9f233', NULL, NULL, 'admin@admin.com', 'habilitado');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `aprendices`
--
ALTER TABLE `aprendices`
  ADD CONSTRAINT `fk_aprendices_nro_ficha` FOREIGN KEY (`nro_ficha`) REFERENCES `fichas` (`nro_ficha`);

--
-- Filtros para la tabla `competencias`
--
ALTER TABLE `competencias`
  ADD CONSTRAINT `fk_competencias_id_programa_formacion` FOREIGN KEY (`id_programa_formacion`) REFERENCES `programa_formacion` (`id`);

--
-- Filtros para la tabla `fichas`
--
ALTER TABLE `fichas`
  ADD CONSTRAINT `fk_fichas_id_jefe_ficha` FOREIGN KEY (`id_jefe_ficha`) REFERENCES `usuarios` (`nro_documento`),
  ADD CONSTRAINT `fk_fichas_id_programa_formacion` FOREIGN KEY (`id_programa_formacion`) REFERENCES `programa_formacion` (`id`);

--
-- Filtros para la tabla `juicios_evaluativos`
--
ALTER TABLE `juicios_evaluativos`
  ADD CONSTRAINT `fk_juicios_evaluativos_id_aprendiz` FOREIGN KEY (`id_aprendiz`) REFERENCES `aprendices` (`nro_documento`),
  ADD CONSTRAINT `fk_juicios_evaluativos_id_evaluador` FOREIGN KEY (`id_evaluador`) REFERENCES `usuarios` (`nro_documento`),
  ADD CONSTRAINT `fk_juicios_evaluativos_id_rae` FOREIGN KEY (`id_rae`) REFERENCES `resultados_aprendizaje` (`id`);

--
-- Filtros para la tabla `resultados_aprendizaje`
--
ALTER TABLE `resultados_aprendizaje`
  ADD CONSTRAINT `fk_rae_id_competencia` FOREIGN KEY (`id_competencia`) REFERENCES `competencias` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
