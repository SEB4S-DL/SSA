-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-05-2025 a las 14:30:55
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
-- Base de datos: `proyecto_sena`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aprendices`
--

CREATE TABLE `aprendices` (
  `nro_documento` int(11) NOT NULL,
  `tipo_documento` enum('TI','CC','CE') NOT NULL,
  `nombre` varchar(40) NOT NULL,
  `segundo_nombre` varchar(40) DEFAULT NULL,
  `apellido` varchar(40) NOT NULL,
  `segundo_apellido` varchar(40) DEFAULT NULL,
  `estado` enum('en formacion','desercion','traslado','cancelado') NOT NULL,
  `horas_aprobadas` float(5,2) NOT NULL,
  `nro_ficha` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `competencias`
--

CREATE TABLE `competencias` (
  `id` int(11) NOT NULL,
  `nombre_competencia` varchar(50) NOT NULL,
  `total_horas` int(11) NOT NULL,
  `id_programa_formacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fichas`
--

CREATE TABLE `fichas` (
  `nro_ficha` int(11) NOT NULL,
  `id_jefe_ficha` int(11) NOT NULL,
  `jornada` enum('diurna','mixta','nocturna') NOT NULL,
  `etapa` enum('lectiva','productiva') NOT NULL,
  `id_programa_formacion` int(11) NOT NULL,
  `tipo_oferta` enum('abierta','cerrada') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `juicios_evaluativos`
--

CREATE TABLE `juicios_evaluativos` (
  `id` int(11) NOT NULL,
  `id_aprendiz` int(11) NOT NULL,
  `id_rae` int(11) NOT NULL,
  `estado` enum('por evaluar','aprobado') NOT NULL,
  `id_evaluador` int(11) NOT NULL,
  `observacion` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `programa_formacion`
--

CREATE TABLE `programa_formacion` (
  `id` int(11) NOT NULL,
  `nombre_programa` varchar(40) NOT NULL,
  `total_horas` int(11) NOT NULL,
  `nivel` enum('tecnico','tecnologo') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `resultados_aprendizaje`
--

CREATE TABLE `resultados_aprendizaje` (
  `id` int(11) NOT NULL,
  `nombre_rae` varchar(50) NOT NULL,
  `total_horas` float(4,2) NOT NULL,
  `id_competencia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `nro_documento` int(11) NOT NULL,
  `tipo_documento` enum('CC','CE') NOT NULL,
  `nombre` varchar(40) NOT NULL,
  `segundo_nombre` varchar(40) DEFAULT NULL,
  `apellido` varchar(40) NOT NULL,
  `segundo_apellido` varchar(40) DEFAULT NULL,
  `rol` enum('admin','user') NOT NULL,
  `tipo` enum('tecnico','transversal') DEFAULT NULL,
  `contrasena` varchar(255) NOT NULL,
  `fecha_inicio_contrato` date DEFAULT NULL,
  `fecha_fin_contrato` date DEFAULT NULL,
  `correo_institucional` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `aprendices`
--
ALTER TABLE `aprendices`
  ADD PRIMARY KEY (`nro_documento`),
  ADD KEY `fk_aprendices_nro_ficha` (`nro_ficha`);

--
-- Indices de la tabla `competencias`
--
ALTER TABLE `competencias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_competencias_id_programa_formacion` (`id_programa_formacion`);

--
-- Indices de la tabla `fichas`
--
ALTER TABLE `fichas`
  ADD PRIMARY KEY (`nro_ficha`),
  ADD KEY `fk_fichas_id_jefe_ficha` (`id_jefe_ficha`),
  ADD KEY `fk_fichas_id_programa_formacion` (`id_programa_formacion`);

--
-- Indices de la tabla `juicios_evaluativos`
--
ALTER TABLE `juicios_evaluativos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_juicios_evaluativos_id_rae` (`id_rae`),
  ADD KEY `fk_juicios_evaluativos_id_aprendiz` (`id_aprendiz`),
  ADD KEY `fk_juicios_evaluativos_id_evaluador` (`id_evaluador`);

--
-- Indices de la tabla `programa_formacion`
--
ALTER TABLE `programa_formacion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `resultados_aprendizaje`
--
ALTER TABLE `resultados_aprendizaje`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_rae_id_competencia` (`id_competencia`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`nro_documento`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `competencias`
--
ALTER TABLE `competencias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `programa_formacion`
--
ALTER TABLE `programa_formacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `resultados_aprendizaje`
--
ALTER TABLE `resultados_aprendizaje`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
