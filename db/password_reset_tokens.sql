-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 24-09-2025 a las 01:18:35
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
-- Base de datos: `ssa`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `token_hash` char(64) NOT NULL,
  `expires_at` datetime NOT NULL,
  `used` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `token_hash` (`token_hash`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`id`, `user_id`, `token_hash`, `expires_at`, `used`, `created_at`) VALUES
(1, 123, '7a207b443ce0f17671b80c37d020d43bd39f8d58ce5f09620ccb3cea776972de', '2025-09-23 23:17:39', 0, '2025-09-23 18:07:39'),
(2, 123, '29a8f32d9b42070d0d4b91c347e474ed67f828fa031e806d456e9132e267a382', '2025-09-23 23:42:28', 0, '2025-09-23 18:32:28'),
(3, 123, '980d865ae4cc85e3ca2f3b8133bd1b38efe7433cbe33f3ddd0eb1b5fd918380c', '2025-09-23 23:56:53', 1, '2025-09-23 18:46:53'),
(4, 123, '018e59f548f4570807f8288d907065355146c89ecd7ea9320fc215e08a9afd15', '2025-09-24 00:11:08', 1, '2025-09-23 19:01:08'),
(5, 123, 'fc283246a01c08024d609bb4f8557c26a426e0561255ea092fa35d3c732356cd', '2025-09-24 00:15:46', 1, '2025-09-23 19:05:46'),
(6, 123, 'e2831a9fc8a5b317248ca514fb804d6303c1c44c6b7b12fd58cbe5ab9785cad4', '2025-09-24 00:18:02', 1, '2025-09-23 19:08:02'),
(7, 123, '4ad25778b4ff80287f386d4aa7dbd41bd28aab9096e6bf028713d892d114512a', '2025-09-24 00:23:37', 1, '2025-09-23 19:13:37'),
(8, 123, '1ead78e1806b4ca2a719c9e6f0a53f2bd0c434ead4b68ae6a710cbfaa0e5057b', '2025-09-24 00:24:42', 1, '2025-09-23 19:14:42'),
(9, 123, 'ebdd4f44b4512c9399f3c922888efe55144e1a6d01902822d235af17c76f6bc6', '2025-09-24 00:25:18', 1, '2025-09-23 19:15:18'),
(10, 123, 'd064455a8e3ab08209685a37f7a89dc97b7eb39eded8c2e1518e876b2798ec65', '2025-09-24 00:26:44', 1, '2025-09-23 19:16:44'),
(11, 123, 'f009407e6644aa5655558463b46e6e9d5df1cddc41d332a61b567ca1aa129ef3', '2025-09-24 00:27:14', 1, '2025-09-23 19:17:14'),
(12, 123, '7f9ece63c424b244fe4b5b218f1c143a77e30115b5259633fa85d7cd704ecca9', '2025-09-24 00:28:42', 1, '2025-09-23 19:18:42'),
(13, 1017148792, '3a866fb7e43b3ca5d6c0c34767c705c6caf539a78526c3d71b161107611471fb', '2025-09-24 00:29:43', 0, '2025-09-23 19:19:43');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
