-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 28-05-2021 a las 02:08:21
-- Versión del servidor: 10.4.10-MariaDB
-- Versión de PHP: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_ceinf_er`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `accesorios_integrados`
--

DROP TABLE IF EXISTS `accesorios_integrados`;
CREATE TABLE IF NOT EXISTS `accesorios_integrados` (
  `accesorioIntegradoId` bigint(20) NOT NULL AUTO_INCREMENT,
  `tarjetaMadreId` bigint(20) DEFAULT NULL,
  `tiposAccesoriosIntegrados` longtext DEFAULT NULL,
  `agregadoPor` varchar(25) DEFAULT NULL,
  `fhAgregado` datetime DEFAULT NULL,
  `editadoPor` varchar(25) DEFAULT NULL,
  `fhEditado` datetime DEFAULT NULL,
  `flgEliminado` int(1) DEFAULT 0,
  `eliminadoPor` varchar(25) DEFAULT NULL,
  `fhEliminado` datetime DEFAULT NULL,
  PRIMARY KEY (`accesorioIntegradoId`),
  KEY `FK_accesorios_integrados_tarjetaMadreId_idx` (`tarjetaMadreId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `almacenamiento_flexible`
--

DROP TABLE IF EXISTS `almacenamiento_flexible`;
CREATE TABLE IF NOT EXISTS `almacenamiento_flexible` (
  `almacenamientoFlexibleId` bigint(20) NOT NULL AUTO_INCREMENT,
  `areaFisicaId` bigint(20) DEFAULT NULL,
  `modeloId` bigint(20) DEFAULT NULL,
  `tipoDisquetera` varchar(100) DEFAULT NULL,
  `serie` varchar(100) DEFAULT NULL,
  `velocidadDisquetera` varchar(100) DEFAULT NULL,
  `agregadoPor` varchar(25) DEFAULT NULL,
  `fhAgregado` datetime DEFAULT NULL,
  `editadoPor` varchar(25) DEFAULT NULL,
  `fhEditado` datetime DEFAULT NULL,
  `flgEliminado` int(1) DEFAULT 0,
  `eliminadoPor` varchar(25) DEFAULT NULL,
  `fhEliminado` datetime DEFAULT NULL,
  PRIMARY KEY (`almacenamientoFlexibleId`),
  KEY `FK_almacenamiento_flexible_areaFisicaId_idx` (`areaFisicaId`),
  KEY `FK_almacenamiento_flexible_modeloId_idx` (`modeloId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `area_fisica`
--

DROP TABLE IF EXISTS `area_fisica`;
CREATE TABLE IF NOT EXISTS `area_fisica` (
  `areaFisicaId` bigint(20) NOT NULL AUTO_INCREMENT,
  `noInventario` varchar(100) DEFAULT NULL,
  `subdependenciaId` bigint(20) DEFAULT NULL,
  `encargadoId` bigint(20) DEFAULT NULL,
  `modeloId` bigint(20) DEFAULT NULL,
  `tipoEquipoAFId` bigint(20) DEFAULT NULL,
  `serie` varchar(100) DEFAULT NULL,
  `estadoAF` varchar(25) DEFAULT NULL,
  `agregadoPor` varchar(25) DEFAULT NULL,
  `fhAgregado` datetime DEFAULT NULL,
  `editadoPor` varchar(25) DEFAULT NULL,
  `fhEditado` datetime DEFAULT NULL,
  `flgEliminado` int(1) DEFAULT 0,
  `eliminadoPor` varchar(25) DEFAULT NULL,
  `fhEliminado` datetime DEFAULT NULL,
  PRIMARY KEY (`areaFisicaId`),
  KEY `FK_area_fisica_subdependenciaId_idx` (`subdependenciaId`),
  KEY `FK_area_fisica_encargadoId_idx` (`encargadoId`),
  KEY `FK_area_fisica_ modeloId_idx` (`modeloId`),
  KEY `FK_area_fisica_tipoEquipoAFId_idx` (`tipoEquipoAFId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bajas_equipo`
--

DROP TABLE IF EXISTS `bajas_equipo`;
CREATE TABLE IF NOT EXISTS `bajas_equipo` (
  `bajaEquipoId` bigint(20) NOT NULL AUTO_INCREMENT,
  `areaFisicaId` bigint(20) DEFAULT NULL,
  `fhBaja` datetime DEFAULT NULL,
  `descripcionBien` longtext DEFAULT NULL,
  `observaciones` longtext DEFAULT NULL,
  `agregadoPor` varchar(25) DEFAULT NULL,
  `fhAgregado` datetime DEFAULT NULL,
  `editadoPor` varchar(25) DEFAULT NULL,
  `fhEditado` datetime DEFAULT NULL,
  `flgEliminado` int(1) DEFAULT 0,
  `eliminadoPor` varchar(25) DEFAULT NULL,
  `fhEliminado` datetime DEFAULT NULL,
  PRIMARY KEY (`bajaEquipoId`),
  KEY `FK_bajas_equipo_areaFisicaId_idx` (`areaFisicaId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bit_credenciales`
--

DROP TABLE IF EXISTS `bit_credenciales`;
CREATE TABLE IF NOT EXISTS `bit_credenciales` (
  `bitCredencialId` bigint(20) NOT NULL AUTO_INCREMENT,
  `credencialId` bigint(20) DEFAULT NULL COMMENT 'credenciales',
  `fhLogin` datetime DEFAULT NULL,
  `fhLogout` datetime DEFAULT NULL,
  `movimientos` longtext DEFAULT NULL,
  `remoteIp` varchar(50) DEFAULT NULL,
  `forwardIp` varchar(50) DEFAULT NULL,
  `navegador` text DEFAULT NULL,
  PRIMARY KEY (`bitCredencialId`),
  KEY `FK_bit_credenciales_credencialId_idx` (`credencialId`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `bit_credenciales`
--

INSERT INTO `bit_credenciales` (`bitCredencialId`, `credencialId`, `fhLogin`, `fhLogout`, `movimientos`, `remoteIp`, `forwardIp`, `navegador`) VALUES
(1, 1, '2021-05-15 09:03:04', '2021-05-15 09:03:55', '(2021-05-15 09:03:04) Inició sesión, (2021-05-15 09:03:55) Cerró sesión.', 'localhost', 'localhost', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.212 Safari/537.36'),
(2, 1, '2021-05-15 09:08:00', '2021-05-15 09:31:54', '(2021-05-15 09:08:00) Inició sesión, (2021-05-15 09:31:54) Cerró sesión.', 'localhost', 'localhost', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.212 Safari/537.36'),
(3, 1, '2021-05-15 09:32:02', '2021-05-15 09:56:57', '(2021-05-15 09:32:02) Inició sesión, (2021-05-15 09:56:57) Cerró sesión.', 'localhost', 'localhost', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.212 Safari/537.36'),
(4, 1, '2021-05-15 09:57:04', '2021-05-15 09:57:10', '(2021-05-15 09:57:10) Cerró sesión.', 'localhost', 'localhost', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.212 Safari/537.36'),
(5, 1, '2021-05-15 09:57:15', '2021-05-15 09:57:22', '(2021-05-15 09:57:22) Cerró sesión.', 'localhost', 'localhost', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.212 Safari/537.36'),
(6, 1, '2021-05-15 09:57:27', '2021-05-15 09:57:43', '(2021-05-15 09:57:43) Cerró sesión.', 'localhost', 'localhost', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.212 Safari/537.36'),
(7, 1, '2021-05-15 09:59:04', '2021-05-15 09:59:14', '(2021-05-15 09:59:14) Cerró sesión.', 'localhost', 'localhost', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.212 Safari/537.36'),
(8, 1, '2021-05-15 09:59:20', '2021-05-15 09:59:29', '(2021-05-15 09:59:29) Cerró sesión.', 'localhost', 'localhost', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.212 Safari/537.36'),
(9, 1, '2021-05-15 09:59:35', '2021-05-15 09:59:42', '(2021-05-15 09:59:42) Cerró sesión.', 'localhost', 'localhost', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.212 Safari/537.36'),
(10, 1, '2021-05-15 09:59:53', '2021-05-15 11:27:35', '(2021-05-15 11:27:35) Cerró sesión.', 'localhost', 'localhost', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.212 Safari/537.36'),
(11, 1, '2021-05-15 11:35:45', '2021-05-15 11:37:04', '(2021-05-15 11:37:04) Cerró sesión.', 'localhost', 'localhost', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.212 Safari/537.36'),
(12, 1, '2021-05-15 11:37:15', '2021-05-15 11:40:08', '(2021-05-15 11:40:08) Cerró sesión.', 'localhost', 'localhost', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.212 Safari/537.36'),
(13, 1, '2021-05-21 08:06:54', NULL, '(2021-05-21 08:06:54) Inició sesión, ', 'localhost', 'localhost', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.212 Safari/537.36'),
(14, 1, '2021-05-21 13:05:07', '2021-05-21 13:28:09', '(2021-05-21 13:28:09) Sesión finalizada por inactividad.', 'localhost', 'localhost', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.212 Safari/537.36'),
(15, 1, '2021-05-21 13:28:49', '2021-05-21 13:58:39', '(2021-05-21 13:58:39) Cerró sesión.', 'localhost', 'localhost', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.212 Safari/537.36'),
(16, 1, '2021-05-21 13:59:03', '2021-05-21 14:28:00', '(2021-05-21 14:28:00) Cerró sesión.', 'localhost', 'localhost', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.212 Safari/537.36'),
(17, 1, '2021-05-24 11:00:37', '2021-05-24 13:32:42', '(2021-05-24 13:32:42) Cerró sesión.', 'localhost', 'localhost', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.212 Safari/537.36'),
(18, 2, '2021-05-24 13:32:47', '2021-05-24 13:32:55', '(2021-05-24 13:32:55) Cerró sesión.', 'localhost', 'localhost', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.212 Safari/537.36'),
(19, 2, '2021-05-24 13:33:02', NULL, '(2021-05-24 13:33:02) Inició sesión, (2021-05-24 13:35:57) Rechazó la solicitud de acceso de: Prueba, Abc, (2021-05-24 15:13:01) Registró un nuevo usuario: No me acuerdo, Ezequiel,(2021-05-24 15:41:52) Editó la información del usuario: xd, Ezequiel,(2021-05-24 15:42:01) Editó la información del usuario: xd, Ezequiel,(2021-05-24 16:19:06) Activó las credenciales de: Guerra, Sadoc,(2021-05-24 16:22:12) Desactivó las credenciales de: xd, Ezequiel,(2021-05-24 16:23:03) Activó las credenciales de: xd, Ezequiel,(2021-05-24 16:23:07) Desactivó las credenciales de: xd, Ezequiel,(2021-05-24 16:24:29) Activó las credenciales de: xd, Ezequiel,(2021-05-24 16:24:46) Activó las credenciales de: xd, Ezequiel,', 'localhost', 'localhost', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.212 Safari/537.36'),
(20, 3, '2021-05-24 15:13:19', '2021-05-24 15:13:28', '(2021-05-24 15:13:28) Cerró sesión.', 'localhost', 'localhost', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.212 Safari/537.36'),
(21, 1, '2021-05-24 16:19:25', '2021-05-24 16:19:28', '(2021-05-24 16:19:28) Cerró sesión.', 'localhost', 'localhost', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.212 Safari/537.36'),
(22, 3, '2021-05-24 16:24:50', '2021-05-24 16:24:51', '(2021-05-24 16:24:51) Cerró sesión.', 'localhost', 'localhost', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.212 Safari/537.36');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bit_intentos_login`
--

DROP TABLE IF EXISTS `bit_intentos_login`;
CREATE TABLE IF NOT EXISTS `bit_intentos_login` (
  `intentoLoginId` bigint(20) NOT NULL AUTO_INCREMENT,
  `remoteIp` varchar(50) DEFAULT NULL,
  `forwardIp` varchar(50) DEFAULT NULL,
  `tipoIntento` varchar(50) DEFAULT NULL,
  `carnet` varchar(100) DEFAULT NULL,
  `fhIntento` datetime DEFAULT NULL,
  `navegador` text DEFAULT NULL,
  PRIMARY KEY (`intentoLoginId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bit_mantenimientos`
--

DROP TABLE IF EXISTS `bit_mantenimientos`;
CREATE TABLE IF NOT EXISTS `bit_mantenimientos` (
  `bitMantenimientoId` bigint(20) NOT NULL AUTO_INCREMENT,
  `areaFisicaId` bigint(20) DEFAULT NULL,
  `tecnicoMantenimientoId` bigint(20) DEFAULT NULL,
  `fhMantenimiento` datetime DEFAULT NULL,
  `agregadoPor` varchar(25) DEFAULT NULL,
  `fhAgregado` datetime DEFAULT NULL,
  `editadoPor` varchar(25) DEFAULT NULL,
  `fhEditado` datetime DEFAULT NULL,
  `flgEliminado` int(1) DEFAULT 0,
  `eliminadoPor` varchar(25) DEFAULT NULL,
  `fhEliminado` datetime DEFAULT NULL,
  PRIMARY KEY (`bitMantenimientoId`),
  KEY `FK_bit_mantenimientos_tecnicoMantenimientoId_idx` (`tecnicoMantenimientoId`),
  KEY `FK_bit_mantenimientos_areaFisicaId_idx` (`areaFisicaId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bit_mantenimientos_detalle`
--

DROP TABLE IF EXISTS `bit_mantenimientos_detalle`;
CREATE TABLE IF NOT EXISTS `bit_mantenimientos_detalle` (
  `bitMantenimientoDetalleId` bigint(20) NOT NULL AUTO_INCREMENT,
  `bitMantenimientoId` bigint(20) DEFAULT NULL,
  `parteEquipoId` bigint(20) DEFAULT NULL,
  `id` bigint(20) DEFAULT NULL,
  `trabajoRealizado` longtext DEFAULT NULL,
  `agregadoPor` varchar(25) DEFAULT NULL,
  `fhAgregado` datetime DEFAULT NULL,
  `editadoPor` varchar(25) DEFAULT NULL,
  `fhEditado` datetime DEFAULT NULL,
  `flgEliminado` int(1) DEFAULT 0,
  `eliminadoPor` varchar(25) DEFAULT NULL,
  `fhEliminado` datetime DEFAULT NULL,
  PRIMARY KEY (`bitMantenimientoDetalleId`),
  KEY `FK_bit_mantenimiento_detalle_bitMantenimientoId_idx` (`bitMantenimientoId`),
  KEY `FK_bit_mantenimiento_detalle_parteEquipoId_idx` (`parteEquipoId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargos`
--

DROP TABLE IF EXISTS `cargos`;
CREATE TABLE IF NOT EXISTS `cargos` (
  `cargoId` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombreCargo` varchar(100) DEFAULT NULL,
  `agregadoPor` varchar(25) DEFAULT NULL,
  `fhAgregado` datetime DEFAULT NULL,
  `editadoPor` varchar(25) DEFAULT NULL,
  `fhEditado` datetime DEFAULT NULL,
  `flgEliminado` int(1) DEFAULT 0,
  `eliminadoPor` varchar(25) DEFAULT NULL,
  `fhEliminado` datetime DEFAULT NULL,
  PRIMARY KEY (`cargoId`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cargos`
--

INSERT INTO `cargos` (`cargoId`, `nombreCargo`, `agregadoPor`, `fhAgregado`, `editadoPor`, `fhEditado`, `flgEliminado`, `eliminadoPor`, `fhEliminado`) VALUES
(1, 'Informático', 'EG1234', '2021-04-19 21:22:34', NULL, NULL, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `credenciales`
--

DROP TABLE IF EXISTS `credenciales`;
CREATE TABLE IF NOT EXISTS `credenciales` (
  `credencialId` bigint(20) NOT NULL AUTO_INCREMENT,
  `carnet` varchar(15) DEFAULT NULL COMMENT 'usuario/login',
  `nombre1` varchar(30) DEFAULT NULL,
  `nombre2` varchar(30) DEFAULT NULL,
  `apellido1` varchar(30) DEFAULT NULL COMMENT 'paterno',
  `apellido2` varchar(30) DEFAULT NULL COMMENT 'materno',
  `fechaNacimiento` date DEFAULT NULL,
  `cargoId` bigint(20) DEFAULT NULL,
  `subdependenciaId` bigint(20) DEFAULT NULL,
  `rolId` bigint(20) DEFAULT NULL,
  `passw` varchar(100) DEFAULT NULL,
  `numLogin` int(11) DEFAULT 0,
  `fhUltimoLogin` datetime DEFAULT NULL,
  `intentosLogin` int(11) DEFAULT 0,
  `enLinea` int(1) DEFAULT 0,
  `estadoCredencial` varchar(25) DEFAULT NULL COMMENT 'activo, inactivo, ...',
  `agregadoPor` varchar(25) DEFAULT NULL,
  `fhAgregado` datetime DEFAULT NULL,
  `editadoPor` varchar(25) DEFAULT NULL,
  `fhEditado` datetime DEFAULT NULL,
  `flgEliminado` int(1) DEFAULT 0,
  `eliminadoPor` varchar(25) DEFAULT NULL,
  `fhEliminado` datetime DEFAULT NULL,
  PRIMARY KEY (`credencialId`),
  KEY `FK_credenciales_cargoId_idx` (`cargoId`),
  KEY `FK_credenciales_rolId_idx` (`rolId`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `credenciales`
--

INSERT INTO `credenciales` (`credencialId`, `carnet`, `nombre1`, `nombre2`, `apellido1`, `apellido2`, `fechaNacimiento`, `cargoId`, `subdependenciaId`, `rolId`, `passw`, `numLogin`, `fhUltimoLogin`, `intentosLogin`, `enLinea`, `estadoCredencial`, `agregadoPor`, `fhAgregado`, `editadoPor`, `fhEditado`, `flgEliminado`, `eliminadoPor`, `fhEliminado`) VALUES
(1, 'EG1234', 'Sadoc', 'Emanuel', 'Guerra', 'Martinez', '1996-05-15', 1, 1, 1, '$2y$10$4PGiaLf.usVw4zcXcwBjuO8v3ZVJzLNw9OrW..R5FtoEi.cTDne/S', 28, '2021-05-24 16:19:25', 0, 0, 'Activo', 'EG1234', '2021-04-19 21:22:34', 'CC1234', '2021-05-24 16:19:06', 0, NULL, NULL),
(2, 'CC1234', 'Claudia', '', 'Carcamo', '', '2021-05-24', 1, 1, 1, '$2y$10$2/riWku1kOjiGMsJI1iJgOmSNHtsObewh1p3D2PhEFyTJ6rTlbkBu', 2, '2021-05-24 13:33:02', 0, 1, 'Activo', 'EG1234', '2021-05-24 13:32:36', 'CC1234', '2021-05-24 13:32:54', 0, NULL, NULL),
(3, 'ER1234', 'Ezequiel', '', 'xd', '', '2021-05-24', 1, 2, 1, '$2y$10$ZX9VlaZhYC9XtJZiwYrzx.JlgFFiRepW5VFGbO/hNNsJyhGihkKCe', 2, '2021-05-24 16:24:50', 0, 0, 'Activo', 'CC1234', '2021-05-24 15:13:01', 'CC1234', '2021-05-24 16:24:46', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dependencias`
--

DROP TABLE IF EXISTS `dependencias`;
CREATE TABLE IF NOT EXISTS `dependencias` (
  `dependenciaId` bigint(20) NOT NULL AUTO_INCREMENT,
  `unidadMilitarId` bigint(20) DEFAULT NULL,
  `nombreDependencia` varchar(100) DEFAULT NULL,
  `abreviatura` varchar(25) DEFAULT NULL,
  `agregadoPor` varchar(25) DEFAULT NULL,
  `fhAgregado` datetime DEFAULT NULL,
  `editadoPor` varchar(25) DEFAULT NULL,
  `fhEditado` datetime DEFAULT NULL,
  `flgEliminado` int(1) DEFAULT 0,
  `eliminadoPor` varchar(25) DEFAULT NULL,
  `fhEliminado` datetime DEFAULT NULL,
  PRIMARY KEY (`dependenciaId`),
  KEY `FK_1_idx` (`unidadMilitarId`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `dependencias`
--

INSERT INTO `dependencias` (`dependenciaId`, `unidadMilitarId`, `nombreDependencia`, `abreviatura`, `agregadoPor`, `fhAgregado`, `editadoPor`, `fhEditado`, `flgEliminado`, `eliminadoPor`, `fhEliminado`) VALUES
(1, 1, 'Administración', 'Admin.', 'EG1234', '2021-04-19 21:22:34', NULL, NULL, 0, NULL, NULL),
(2, 1, 'Médico', 'MDC', 'EG1234', '2021-04-19 21:22:34', NULL, NULL, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `discos_duros`
--

DROP TABLE IF EXISTS `discos_duros`;
CREATE TABLE IF NOT EXISTS `discos_duros` (
  `discoDuroId` bigint(20) NOT NULL AUTO_INCREMENT,
  `tarjetaMadreId` bigint(20) DEFAULT NULL,
  `tipoDiscoDuro` varchar(100) DEFAULT NULL,
  `modeloId` bigint(20) DEFAULT NULL,
  `serie` varchar(100) DEFAULT NULL,
  `capacidadAlmacenaje` varchar(100) DEFAULT NULL,
  `agregadoPor` varchar(25) DEFAULT NULL,
  `fhAgregado` datetime DEFAULT NULL,
  `editadoPor` varchar(25) DEFAULT NULL,
  `fhEditado` datetime DEFAULT NULL,
  `flgEliminado` int(1) DEFAULT 0,
  `eliminadoPor` varchar(25) DEFAULT NULL,
  `fhEliminado` datetime DEFAULT NULL,
  PRIMARY KEY (`discoDuroId`),
  KEY `FK_discos_duros_tarjetaMadreId_idx` (`tarjetaMadreId`),
  KEY `FK_discos_duros_modeloId_idx` (`modeloId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `encargados`
--

DROP TABLE IF EXISTS `encargados`;
CREATE TABLE IF NOT EXISTS `encargados` (
  `encargadoId` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombreEncargado` varchar(200) DEFAULT NULL,
  `agregadoPor` varchar(25) DEFAULT NULL,
  `fhAgregado` datetime DEFAULT NULL,
  `editadoPor` varchar(25) DEFAULT NULL,
  `fhEditado` datetime DEFAULT NULL,
  `flgEliminado` int(1) DEFAULT 0,
  `eliminadoPor` varchar(25) DEFAULT NULL,
  `fhEliminado` datetime DEFAULT NULL,
  PRIMARY KEY (`encargadoId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entrega_equipos`
--

DROP TABLE IF EXISTS `entrega_equipos`;
CREATE TABLE IF NOT EXISTS `entrega_equipos` (
  `entregaEquipoId` bigint(20) NOT NULL AUTO_INCREMENT,
  `areaFisicaId` bigint(20) DEFAULT NULL,
  `fhEntrega` datetime DEFAULT NULL,
  `descripcionBien` longtext DEFAULT NULL,
  `observaciones` longtext DEFAULT NULL,
  `agregadoPor` varchar(25) DEFAULT NULL,
  `fhAgregado` datetime DEFAULT NULL,
  `editadoPor` varchar(25) DEFAULT NULL,
  `fhEditado` datetime DEFAULT NULL,
  `flgEliminado` int(1) DEFAULT 0,
  `eliminadoPor` varchar(25) DEFAULT NULL,
  `fhEliminado` datetime DEFAULT NULL,
  PRIMARY KEY (`entregaEquipoId`),
  KEY `FK_entrega_equipo_areaFisicaId_idx` (`areaFisicaId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evaluacion_tecnica`
--

DROP TABLE IF EXISTS `evaluacion_tecnica`;
CREATE TABLE IF NOT EXISTS `evaluacion_tecnica` (
  `evaluacionTecnicaId` bigint(20) NOT NULL AUTO_INCREMENT,
  `areaFisicaId` bigint(20) DEFAULT NULL,
  `parteEquipoId` bigint(20) DEFAULT NULL,
  `id` bigint(20) DEFAULT NULL,
  `tecnicoMantenimientoId` bigint(20) DEFAULT NULL,
  `evaluacionRealizada` longtext DEFAULT NULL,
  `recomendacion` longtext DEFAULT NULL,
  `agregadoPor` varchar(25) DEFAULT NULL,
  `fhAgregado` datetime DEFAULT NULL,
  `editadoPor` varchar(25) DEFAULT NULL,
  `fhEditado` datetime DEFAULT NULL,
  `flgEliminado` int(1) DEFAULT 0,
  `eliminadoPor` varchar(25) DEFAULT NULL,
  `fhEliminado` datetime DEFAULT NULL,
  PRIMARY KEY (`evaluacionTecnicaId`),
  KEY `FK_evaluacion_tecnica_areaFisicaId_idx` (`areaFisicaId`),
  KEY `FK_evaluacion_tecnica_parteEquipoId_idx` (`parteEquipoId`),
  KEY `FK_evaluacion_tecnica_tecnicoId_idx` (`tecnicoMantenimientoId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `impresoras`
--

DROP TABLE IF EXISTS `impresoras`;
CREATE TABLE IF NOT EXISTS `impresoras` (
  `impresoraId` bigint(20) NOT NULL AUTO_INCREMENT,
  `modeloId` bigint(20) DEFAULT NULL,
  `tipoImpresora` varchar(100) DEFAULT NULL,
  `tipoCartucho` varchar(100) DEFAULT NULL,
  `cantidadCartuchos` varchar(100) DEFAULT NULL,
  `serie` varchar(100) DEFAULT NULL,
  `agregadoPor` varchar(25) DEFAULT NULL,
  `fhAgregado` datetime DEFAULT NULL,
  `editadoPor` varchar(25) DEFAULT NULL,
  `fhEditado` datetime DEFAULT NULL,
  `flgEliminado` int(1) DEFAULT 0,
  `eliminadoPor` varchar(25) DEFAULT NULL,
  `fhEliminado` datetime DEFAULT NULL,
  PRIMARY KEY (`impresoraId`),
  KEY `FK_impresoras_modeloId_idx` (`modeloId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marcas`
--

DROP TABLE IF EXISTS `marcas`;
CREATE TABLE IF NOT EXISTS `marcas` (
  `marcaId` bigint(20) NOT NULL AUTO_INCREMENT,
  `parteEquipoId` bigint(20) DEFAULT NULL,
  `nombreMarca` varchar(200) DEFAULT NULL,
  `agregadoPor` varchar(25) DEFAULT NULL,
  `fhAgregado` datetime DEFAULT NULL,
  `editadoPor` varchar(25) DEFAULT NULL,
  `fhEditado` datetime DEFAULT NULL,
  `flgEliminado` int(1) DEFAULT 0,
  `eliminadoPor` varchar(25) DEFAULT NULL,
  `fhEliminado` datetime DEFAULT NULL,
  PRIMARY KEY (`marcaId`),
  KEY `FK_marcas_parteEquipoId_idx` (`parteEquipoId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `memoria_ram`
--

DROP TABLE IF EXISTS `memoria_ram`;
CREATE TABLE IF NOT EXISTS `memoria_ram` (
  `memoriaRamId` bigint(20) NOT NULL AUTO_INCREMENT,
  `tarjetaMadreId` bigint(20) DEFAULT NULL,
  `tipoMemoriaRam` varchar(200) DEFAULT NULL,
  `totalMemoria` varchar(100) DEFAULT NULL,
  `velocidadTransferencia` varchar(100) DEFAULT NULL,
  `agregadoPor` varchar(25) DEFAULT NULL,
  `fhAgregado` datetime DEFAULT NULL,
  `editadoPor` varchar(25) DEFAULT NULL,
  `fhEditado` datetime DEFAULT NULL,
  `flgEliminado` int(1) DEFAULT 0,
  `eliminadoPor` varchar(25) DEFAULT NULL,
  `fhEliminado` datetime DEFAULT NULL,
  PRIMARY KEY (`memoriaRamId`),
  KEY `FK_memoria_ram_tarjetaMadreId_idx` (`tarjetaMadreId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menus`
--

DROP TABLE IF EXISTS `menus`;
CREATE TABLE IF NOT EXISTS `menus` (
  `menuId` bigint(20) NOT NULL AUTO_INCREMENT,
  `moduloId` bigint(20) DEFAULT NULL,
  `nombreMenu` varchar(100) DEFAULT NULL,
  `iconoMenu` varchar(50) DEFAULT NULL,
  `urlMenu` varchar(200) DEFAULT NULL,
  `tipoMenu` varchar(25) DEFAULT NULL,
  `menuDropdown` bigint(20) DEFAULT NULL,
  `agregadoPor` varchar(25) DEFAULT NULL,
  `fhAgregado` datetime DEFAULT NULL,
  `editadoPor` varchar(25) DEFAULT NULL,
  `fhEditado` datetime DEFAULT NULL,
  `flgEliminado` int(1) DEFAULT 0,
  `eliminadoPor` varchar(25) DEFAULT NULL,
  `fhEliminado` datetime DEFAULT NULL,
  PRIMARY KEY (`menuId`),
  KEY `FK_moduloId_idx` (`moduloId`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `menus`
--

INSERT INTO `menus` (`menuId`, `moduloId`, `nombreMenu`, `iconoMenu`, `urlMenu`, `tipoMenu`, `menuDropdown`, `agregadoPor`, `fhAgregado`, `editadoPor`, `fhEditado`, `flgEliminado`, `eliminadoPor`, `fhEliminado`) VALUES
(1, 1, 'Gestión de Usuarios', 'fa fa-users', NULL, 'Dropdown', 0, 'EG1234', '2021-04-19 21:22:34', NULL, NULL, 0, NULL, NULL),
(2, 1, 'Usuarios', NULL, 'gestion-usuarios', 'Submenú', 1, 'EG1234', '2021-04-19 21:22:34', NULL, NULL, 0, NULL, NULL),
(3, 1, 'Solicitudes acceso', NULL, 'solicitudes-acceso', 'Submenú', 1, 'EG1234', '2021-04-19 21:22:34', NULL, NULL, 0, NULL, NULL),
(4, 1, 'Bitácora', 'fa fa-database', 'bitacora', 'Menú', 0, 'EG1234', '2021-04-19 21:22:34', NULL, NULL, 0, NULL, NULL),
(5, 2, 'Equipo', 'fa fa-user', 'url', 'Menú', 0, 'EG1234', '2021-04-19 21:22:34', NULL, NULL, 0, NULL, NULL),
(6, 3, 'Reportes', 'fa fa-user', 'url', 'Menú', 0, 'EG1234', '2021-04-19 21:22:34', NULL, NULL, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modelos`
--

DROP TABLE IF EXISTS `modelos`;
CREATE TABLE IF NOT EXISTS `modelos` (
  `modeloId` bigint(20) NOT NULL AUTO_INCREMENT,
  `marcaId` bigint(20) DEFAULT NULL,
  `nombreModelo` varchar(200) DEFAULT NULL,
  `agregadoPor` varchar(25) DEFAULT NULL,
  `fhAgregado` datetime DEFAULT NULL,
  `editadoPor` varchar(25) DEFAULT NULL,
  `fhEditado` datetime DEFAULT NULL,
  `flgEliminado` int(1) DEFAULT 0,
  `eliminadoPor` varchar(25) DEFAULT NULL,
  `fhEliminado` datetime DEFAULT NULL,
  PRIMARY KEY (`modeloId`),
  KEY `FK_modelos_marcaId_idx` (`marcaId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modulos`
--

DROP TABLE IF EXISTS `modulos`;
CREATE TABLE IF NOT EXISTS `modulos` (
  `moduloId` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombreModulo` varchar(100) DEFAULT NULL,
  `carpetaModulo` varchar(50) DEFAULT NULL,
  `agregadoPor` varchar(25) DEFAULT NULL,
  `fhAgregado` datetime DEFAULT NULL,
  `editadoPor` varchar(25) DEFAULT NULL,
  `fhEditado` datetime DEFAULT NULL,
  `flgEliminado` int(1) DEFAULT 0,
  `eliminadoPor` varchar(25) DEFAULT NULL,
  `fhEliminado` datetime DEFAULT NULL,
  PRIMARY KEY (`moduloId`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `modulos`
--

INSERT INTO `modulos` (`moduloId`, `nombreModulo`, `carpetaModulo`, `agregadoPor`, `fhAgregado`, `editadoPor`, `fhEditado`, `flgEliminado`, `eliminadoPor`, `fhEliminado`) VALUES
(1, 'Conf. General', 'conf-general', 'EG1234', '2021-04-19 21:22:34', NULL, NULL, 0, NULL, NULL),
(2, 'Op. Equipo', 'op-equipo', 'EG1234', '2021-04-19 21:22:34', NULL, NULL, 0, NULL, NULL),
(3, 'Op. Inventario', 'op-inventario', 'EG1234', '2021-04-19 21:22:34', NULL, NULL, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `monitores`
--

DROP TABLE IF EXISTS `monitores`;
CREATE TABLE IF NOT EXISTS `monitores` (
  `monitorId` bigint(20) NOT NULL AUTO_INCREMENT,
  `areaFisicaId` bigint(20) DEFAULT NULL,
  `modeloId` bigint(20) DEFAULT NULL,
  `tipoMonitor` varchar(100) DEFAULT NULL,
  `tipoPantalla` varchar(100) DEFAULT NULL,
  `serie` varchar(100) DEFAULT NULL,
  `resolucion` varchar(100) DEFAULT NULL,
  `agregadoPor` varchar(25) DEFAULT NULL,
  `fhAgregado` datetime DEFAULT NULL,
  `editadoPor` varchar(25) DEFAULT NULL,
  `fhEditado` datetime DEFAULT NULL,
  `flgEliminado` int(1) DEFAULT 0,
  `eliminadoPor` varchar(25) DEFAULT NULL,
  `fhEliminado` datetime DEFAULT NULL,
  PRIMARY KEY (`monitorId`),
  KEY `FK_monitores_areaFisicaId_idx` (`areaFisicaId`),
  KEY `FK_monitores_modeloId_idx` (`modeloId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mouse`
--

DROP TABLE IF EXISTS `mouse`;
CREATE TABLE IF NOT EXISTS `mouse` (
  `mouseId` bigint(20) NOT NULL AUTO_INCREMENT,
  `areaFisicaId` bigint(20) DEFAULT NULL,
  `modeloId` bigint(20) DEFAULT NULL,
  `tipoMouse` varchar(100) DEFAULT NULL,
  `serie` varchar(100) DEFAULT NULL,
  `poseeScroll` int(1) DEFAULT NULL,
  `cantidadBotones` int(11) DEFAULT NULL,
  `agregadoPor` varchar(25) DEFAULT NULL,
  `fhAgregado` datetime DEFAULT NULL,
  `editadoPor` varchar(25) DEFAULT NULL,
  `fhEditado` datetime DEFAULT NULL,
  `flgEliminado` int(1) DEFAULT 0,
  `eliminadoPor` varchar(25) DEFAULT NULL,
  `fhEliminado` datetime DEFAULT NULL,
  PRIMARY KEY (`mouseId`),
  KEY `FK_mouse_areaFisicaId_idx` (`areaFisicaId`),
  KEY `FK_mouse_modeloId_idx` (`modeloId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `multimedia`
--

DROP TABLE IF EXISTS `multimedia`;
CREATE TABLE IF NOT EXISTS `multimedia` (
  `multimediaId` bigint(20) NOT NULL AUTO_INCREMENT,
  `areaFisicaId` bigint(20) DEFAULT NULL,
  `tipoMultimedia` varchar(100) DEFAULT NULL,
  `modeloId` bigint(20) DEFAULT NULL,
  `serie` varchar(100) DEFAULT NULL,
  `velocidadReproduccion` varchar(100) DEFAULT NULL,
  `agregadoPor` varchar(25) DEFAULT NULL,
  `fhAgregado` datetime DEFAULT NULL,
  `editadoPor` varchar(25) DEFAULT NULL,
  `fhEditado` datetime DEFAULT NULL,
  `flgEliminado` int(1) DEFAULT 0,
  `eliminadoPor` varchar(25) DEFAULT NULL,
  `fhEliminado` datetime DEFAULT NULL,
  PRIMARY KEY (`multimediaId`),
  KEY `FK_multimedia_areaFisicaId_idx` (`areaFisicaId`),
  KEY `FK_multimedia_modeloId_idx` (`modeloId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `parlantes`
--

DROP TABLE IF EXISTS `parlantes`;
CREATE TABLE IF NOT EXISTS `parlantes` (
  `parlanteId` bigint(20) NOT NULL AUTO_INCREMENT,
  `modeloId` bigint(20) DEFAULT NULL,
  `serie` varchar(100) DEFAULT NULL,
  `capacidadWatts` varchar(100) DEFAULT NULL,
  `agregadoPor` varchar(25) DEFAULT NULL,
  `fhAgregado` datetime DEFAULT NULL,
  `editadoPor` varchar(25) DEFAULT NULL,
  `fhEditado` datetime DEFAULT NULL,
  `flgEliminado` int(1) DEFAULT 0,
  `eliminadoPor` varchar(25) DEFAULT NULL,
  `fhEliminado` datetime DEFAULT NULL,
  PRIMARY KEY (`parlanteId`),
  KEY `FK_parlantes_modeloId_idx` (`modeloId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `partes_equipo`
--

DROP TABLE IF EXISTS `partes_equipo`;
CREATE TABLE IF NOT EXISTS `partes_equipo` (
  `parteEquipoId` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombreParte` varchar(200) DEFAULT NULL,
  `agregadoPor` varchar(25) DEFAULT NULL,
  `fhAgregado` datetime DEFAULT NULL,
  `editadoPor` varchar(25) DEFAULT NULL,
  `fhEditado` datetime DEFAULT NULL,
  `flgEliminado` int(1) DEFAULT 0,
  `eliminadoPor` varchar(25) DEFAULT NULL,
  `fhEliminado` datetime DEFAULT NULL,
  PRIMARY KEY (`parteEquipoId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `procesador`
--

DROP TABLE IF EXISTS `procesador`;
CREATE TABLE IF NOT EXISTS `procesador` (
  `procesadorId` bigint(20) NOT NULL AUTO_INCREMENT,
  `tarjetaMadreId` bigint(20) DEFAULT NULL,
  `tipoProcesadorId` bigint(20) DEFAULT NULL,
  `agregadoPor` varchar(25) DEFAULT NULL,
  `fhAgregado` datetime DEFAULT NULL,
  `editadoPor` varchar(25) DEFAULT NULL,
  `fhEditado` datetime DEFAULT NULL,
  `flgEliminado` int(1) DEFAULT 0,
  `eliminadoPor` varchar(25) DEFAULT NULL,
  `fhEliminado` datetime DEFAULT NULL,
  PRIMARY KEY (`procesadorId`),
  KEY `FK_procesador_tarjetaMadreId_idx` (`tarjetaMadreId`),
  KEY `FK_procesador_tipoProcesadorId_idx` (`tipoProcesadorId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `rolId` bigint(20) NOT NULL AUTO_INCREMENT,
  `rol` varchar(100) DEFAULT NULL,
  `agregadoPor` varchar(25) DEFAULT NULL,
  `fhAgregado` datetime DEFAULT NULL,
  `editadoPor` varchar(25) DEFAULT NULL,
  `fhEditado` datetime DEFAULT NULL,
  `flgEliminado` int(1) DEFAULT 0,
  `eliminadoPor` varchar(25) DEFAULT NULL,
  `fhEliminado` datetime DEFAULT NULL,
  PRIMARY KEY (`rolId`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`rolId`, `rol`, `agregadoPor`, `fhAgregado`, `editadoPor`, `fhEditado`, `flgEliminado`, `eliminadoPor`, `fhEliminado`) VALUES
(1, 'Desarrollador', 'EG1234', '2021-04-19 21:22:34', NULL, NULL, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles_menus`
--

DROP TABLE IF EXISTS `roles_menus`;
CREATE TABLE IF NOT EXISTS `roles_menus` (
  `permisoRolId` bigint(20) NOT NULL AUTO_INCREMENT,
  `rolId` bigint(20) DEFAULT NULL,
  `menuId` bigint(20) DEFAULT NULL,
  `agregadoPor` varchar(25) DEFAULT NULL,
  `fhAgregado` datetime DEFAULT NULL,
  `editadoPor` varchar(25) DEFAULT NULL,
  `fhEditado` datetime DEFAULT NULL,
  `flgEliminado` int(1) DEFAULT 0,
  `eliminadoPor` varchar(25) DEFAULT NULL,
  `fhEliminado` datetime DEFAULT NULL,
  PRIMARY KEY (`permisoRolId`),
  KEY `FK_roles_menus_rolId_idx` (`rolId`),
  KEY `FK_roles_menus_menuId_idx` (`menuId`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `roles_menus`
--

INSERT INTO `roles_menus` (`permisoRolId`, `rolId`, `menuId`, `agregadoPor`, `fhAgregado`, `editadoPor`, `fhEditado`, `flgEliminado`, `eliminadoPor`, `fhEliminado`) VALUES
(1, 1, 1, 'EG1234', '2021-04-19 21:22:34', NULL, NULL, 0, NULL, NULL),
(2, 1, 2, 'EG1234', '2021-04-19 21:22:34', NULL, NULL, 0, NULL, NULL),
(3, 1, 3, 'EG1234', '2021-04-19 21:22:34', NULL, NULL, 0, NULL, NULL),
(4, 1, 4, 'EG1234', '2021-04-19 21:22:34', NULL, NULL, 0, NULL, NULL),
(5, 1, 5, 'EG1234', '2021-04-19 21:22:34', NULL, NULL, 0, NULL, NULL),
(6, 1, 6, 'EG1234', '2021-04-19 21:22:34', NULL, NULL, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `software`
--

DROP TABLE IF EXISTS `software`;
CREATE TABLE IF NOT EXISTS `software` (
  `softwareId` bigint(20) NOT NULL AUTO_INCREMENT,
  `areaFisicaId` bigint(20) DEFAULT NULL,
  `tipoSoftware` varchar(100) DEFAULT NULL,
  `arquitectura` varchar(100) DEFAULT NULL,
  `version` varchar(50) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `noLicencia` varchar(100) DEFAULT NULL,
  `agregadoPor` varchar(25) DEFAULT NULL,
  `fhAgregado` datetime DEFAULT NULL,
  `editadoPor` varchar(25) DEFAULT NULL,
  `fhEditado` datetime DEFAULT NULL,
  `flgEliminado` int(1) DEFAULT 0,
  `eliminadoPor` varchar(25) DEFAULT NULL,
  `fhEliminado` datetime DEFAULT NULL,
  PRIMARY KEY (`softwareId`),
  KEY `FK_software_areaFisicaId_idx` (`areaFisicaId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitudes_acceso`
--

DROP TABLE IF EXISTS `solicitudes_acceso`;
CREATE TABLE IF NOT EXISTS `solicitudes_acceso` (
  `solicitudAccesoId` bigint(20) NOT NULL AUTO_INCREMENT,
  `carnet` varchar(15) DEFAULT NULL,
  `nombres` varchar(150) DEFAULT NULL,
  `apellidos` varchar(150) DEFAULT NULL,
  `cargo` varchar(100) DEFAULT NULL,
  `departamento` varchar(100) DEFAULT NULL,
  `estadoSolicitud` varchar(25) DEFAULT NULL,
  `justificacionEstado` text DEFAULT NULL,
  `agregadoPor` varchar(25) DEFAULT NULL,
  `fhAgregado` datetime DEFAULT NULL,
  `editadoPor` varchar(25) DEFAULT NULL,
  `fhEditado` datetime DEFAULT NULL,
  `flgEliminado` int(1) DEFAULT 0,
  `eliminadoPor` varchar(25) DEFAULT NULL,
  `fhEliminado` datetime DEFAULT NULL,
  PRIMARY KEY (`solicitudAccesoId`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `solicitudes_acceso`
--

INSERT INTO `solicitudes_acceso` (`solicitudAccesoId`, `carnet`, `nombres`, `apellidos`, `cargo`, `departamento`, `estadoSolicitud`, `justificacionEstado`, `agregadoPor`, `fhAgregado`, `editadoPor`, `fhEditado`, `flgEliminado`, `eliminadoPor`, `fhEliminado`) VALUES
(1, 'ER1234', 'Ezequiel', 'Rodriguez', 'Inventario', 'Informática', 'Pendiente', NULL, 'Automático', '2021-05-04 09:58:51', NULL, NULL, 0, NULL, NULL),
(2, 'CC1234', 'Claudia', 'Carcamo', 'Desarrollo', 'Informatica', 'Autorizada', NULL, 'Automático', '2021-05-04 09:58:51', 'EG1234', '2021-05-24 13:32:36', 0, NULL, NULL),
(3, 'ABC1234', 'Abc', 'Prueba', 'Testing', 'Info', 'Rechazada', 'No especificó su nombre', 'Automático', '2021-05-21 13:58:56', 'CC1234', '2021-05-24 13:35:57', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subdependencias`
--

DROP TABLE IF EXISTS `subdependencias`;
CREATE TABLE IF NOT EXISTS `subdependencias` (
  `subdependenciaId` bigint(20) NOT NULL AUTO_INCREMENT,
  `dependenciaId` bigint(20) DEFAULT NULL,
  `nombreSubdependencia` varchar(100) DEFAULT NULL,
  `abreviatura` varchar(25) DEFAULT NULL,
  `agregadoPor` varchar(25) DEFAULT NULL,
  `fhAgregado` datetime DEFAULT NULL,
  `editadoPor` varchar(25) DEFAULT NULL,
  `fhEditado` datetime DEFAULT NULL,
  `flgEliminado` int(1) DEFAULT 0,
  `eliminadoPor` varchar(25) DEFAULT NULL,
  `fhEliminado` datetime DEFAULT NULL,
  PRIMARY KEY (`subdependenciaId`),
  KEY `FK_subdependencias_dependenciaId_idx` (`dependenciaId`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `subdependencias`
--

INSERT INTO `subdependencias` (`subdependenciaId`, `dependenciaId`, `nombreSubdependencia`, `abreviatura`, `agregadoPor`, `fhAgregado`, `editadoPor`, `fhEditado`, `flgEliminado`, `eliminadoPor`, `fhEliminado`) VALUES
(1, 1, 'Informática', 'INF', 'EG1234', '2021-04-19 21:22:34', NULL, NULL, 0, NULL, NULL),
(2, 1, 'Contabilidad', 'CTB', 'EG1234', '2021-04-19 21:22:34', NULL, NULL, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tarjeta_madre`
--

DROP TABLE IF EXISTS `tarjeta_madre`;
CREATE TABLE IF NOT EXISTS `tarjeta_madre` (
  `tarjetaMadreId` bigint(20) NOT NULL AUTO_INCREMENT,
  `areaFisicaId` bigint(20) DEFAULT NULL,
  `modeloId` bigint(20) DEFAULT NULL,
  `capacidad` varchar(50) DEFAULT NULL,
  `puertosMemoriaRam` int(11) DEFAULT NULL,
  `agregadoPor` varchar(25) DEFAULT NULL,
  `fhAgregado` datetime DEFAULT NULL,
  `editadoPor` varchar(25) DEFAULT NULL,
  `fhEditado` datetime DEFAULT NULL,
  `flgEliminado` int(1) DEFAULT 0,
  `eliminadoPor` varchar(25) DEFAULT NULL,
  `fhEliminado` datetime DEFAULT NULL,
  PRIMARY KEY (`tarjetaMadreId`),
  KEY `FK_tarjeta_madre_areaFisicaId_idx` (`areaFisicaId`),
  KEY `FK_tarjeta_madre_modeloId_idx` (`modeloId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `teclados`
--

DROP TABLE IF EXISTS `teclados`;
CREATE TABLE IF NOT EXISTS `teclados` (
  `tecladoId` bigint(20) NOT NULL AUTO_INCREMENT,
  `areaFisicaId` bigint(20) DEFAULT NULL,
  `modeloId` bigint(20) DEFAULT NULL,
  `tipoTeclado` varchar(100) DEFAULT NULL,
  `serie` varchar(100) DEFAULT NULL,
  `cantidadTeclas` int(11) DEFAULT NULL,
  `agregadoPor` varchar(25) DEFAULT NULL,
  `fhAgregado` datetime DEFAULT NULL,
  `editadoPor` varchar(25) DEFAULT NULL,
  `fhEditado` datetime DEFAULT NULL,
  `flgEliminado` int(1) DEFAULT 0,
  `eliminadoPor` varchar(25) DEFAULT NULL,
  `fhEliminado` datetime DEFAULT NULL,
  PRIMARY KEY (`tecladoId`),
  KEY `FK_teclados_areaFisicaId_idx` (`areaFisicaId`),
  KEY `FK_teclados_modeloId_idx` (`modeloId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tecnicos_mantenimiento`
--

DROP TABLE IF EXISTS `tecnicos_mantenimiento`;
CREATE TABLE IF NOT EXISTS `tecnicos_mantenimiento` (
  `tecnicoMantenimientoId` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombreTecnico` varchar(200) DEFAULT NULL,
  `agregadoPor` varchar(25) DEFAULT NULL,
  `fhAgregado` datetime DEFAULT NULL,
  `editadoPor` varchar(25) DEFAULT NULL,
  `fhEditado` datetime DEFAULT NULL,
  `flgEliminado` int(1) DEFAULT 0,
  `eliminadoPor` varchar(25) DEFAULT NULL,
  `fhEliminado` datetime DEFAULT NULL,
  PRIMARY KEY (`tecnicoMantenimientoId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_accesorios_integrados`
--

DROP TABLE IF EXISTS `tipos_accesorios_integrados`;
CREATE TABLE IF NOT EXISTS `tipos_accesorios_integrados` (
  `tipoAccesorioIntegradoId` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombreTipoProcesador` varchar(200) DEFAULT NULL,
  `agregadoPor` varchar(25) DEFAULT NULL,
  `fhAgregado` datetime DEFAULT NULL,
  `editadoPor` varchar(25) DEFAULT NULL,
  `fhEditado` datetime DEFAULT NULL,
  `flgEliminado` int(1) DEFAULT 0,
  `eliminadoPor` varchar(25) DEFAULT NULL,
  `fhEliminado` datetime DEFAULT NULL,
  PRIMARY KEY (`tipoAccesorioIntegradoId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_equipos_af`
--

DROP TABLE IF EXISTS `tipos_equipos_af`;
CREATE TABLE IF NOT EXISTS `tipos_equipos_af` (
  `tipoEquipoAFId` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombreTipoEquipo` varchar(200) DEFAULT NULL,
  `agregadoPor` varchar(25) DEFAULT NULL,
  `fhAgregado` datetime DEFAULT NULL,
  `editadoPor` varchar(25) DEFAULT NULL,
  `fhEditado` datetime DEFAULT NULL,
  `flgEliminado` int(1) DEFAULT 0,
  `eliminadoPor` varchar(25) DEFAULT NULL,
  `fhEliminado` datetime DEFAULT NULL,
  PRIMARY KEY (`tipoEquipoAFId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_procesador`
--

DROP TABLE IF EXISTS `tipos_procesador`;
CREATE TABLE IF NOT EXISTS `tipos_procesador` (
  `tipoProcesadorId` bigint(20) NOT NULL AUTO_INCREMENT,
  `modeloId` bigint(20) DEFAULT NULL,
  `nombreTipoProcesador` varchar(200) DEFAULT NULL,
  `velocidad` varchar(100) DEFAULT NULL,
  `agregadoPor` varchar(25) DEFAULT NULL,
  `fhAgregado` datetime DEFAULT NULL,
  `editadoPor` varchar(25) DEFAULT NULL,
  `fhEditado` datetime DEFAULT NULL,
  `flgEliminado` int(1) DEFAULT 0,
  `eliminadoPor` varchar(25) DEFAULT NULL,
  `fhEliminado` datetime DEFAULT NULL,
  PRIMARY KEY (`tipoProcesadorId`),
  KEY `FK_tipos_procesador_modeloId_idx` (`modeloId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `unidades_militares`
--

DROP TABLE IF EXISTS `unidades_militares`;
CREATE TABLE IF NOT EXISTS `unidades_militares` (
  `unidadMilitarId` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombreUnidadMilitar` varchar(100) DEFAULT NULL,
  `abreviatura` varchar(25) DEFAULT NULL,
  `agregadoPor` varchar(25) DEFAULT NULL,
  `fhAgregado` datetime DEFAULT NULL,
  `editadoPor` varchar(25) DEFAULT NULL,
  `fhEditado` datetime DEFAULT NULL,
  `flgEliminado` int(1) DEFAULT 0,
  `eliminadoPor` varchar(25) DEFAULT NULL,
  `fhEliminado` datetime DEFAULT NULL,
  PRIMARY KEY (`unidadMilitarId`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `unidades_militares`
--

INSERT INTO `unidades_militares` (`unidadMilitarId`, `nombreUnidadMilitar`, `abreviatura`, `agregadoPor`, `fhAgregado`, `editadoPor`, `fhEditado`, `flgEliminado`, `eliminadoPor`, `fhEliminado`) VALUES
(1, 'Hospital Militar Central', 'HMC', 'EG1234', '2021-04-19 21:22:34', NULL, NULL, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ups`
--

DROP TABLE IF EXISTS `ups`;
CREATE TABLE IF NOT EXISTS `ups` (
  `upsId` bigint(20) NOT NULL AUTO_INCREMENT,
  `areaFisicaId` bigint(20) DEFAULT NULL,
  `modeloId` bigint(20) DEFAULT NULL,
  `capacidadUps` varchar(100) DEFAULT NULL,
  `cantidadTomasProtegidos` int(11) DEFAULT NULL,
  `tiempoCargaEstimada` varchar(100) DEFAULT NULL,
  `cantidadTomasUps` int(11) DEFAULT NULL,
  `agregadoPor` varchar(25) DEFAULT NULL,
  `fhAgregado` datetime DEFAULT NULL,
  `editadoPor` varchar(25) DEFAULT NULL,
  `fhEditado` datetime DEFAULT NULL,
  `flgEliminado` int(1) DEFAULT 0,
  `eliminadoPor` varchar(25) DEFAULT NULL,
  `fhEliminado` datetime DEFAULT NULL,
  PRIMARY KEY (`upsId`),
  KEY `FK_ups_areaFisicaId_idx` (`areaFisicaId`),
  KEY `FK_ups_modeloId_idx` (`modeloId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `accesorios_integrados`
--
ALTER TABLE `accesorios_integrados`
  ADD CONSTRAINT `FK_accesorios_integrados_tarjetaMadreId` FOREIGN KEY (`tarjetaMadreId`) REFERENCES `tarjeta_madre` (`tarjetaMadreId`);

--
-- Filtros para la tabla `almacenamiento_flexible`
--
ALTER TABLE `almacenamiento_flexible`
  ADD CONSTRAINT `FK_almacenamiento_flexible_areaFisicaId` FOREIGN KEY (`areaFisicaId`) REFERENCES `area_fisica` (`areaFisicaId`),
  ADD CONSTRAINT `FK_almacenamiento_flexible_modeloId` FOREIGN KEY (`modeloId`) REFERENCES `modelos` (`modeloId`);

--
-- Filtros para la tabla `area_fisica`
--
ALTER TABLE `area_fisica`
  ADD CONSTRAINT `FK_area_fisica_ modeloId` FOREIGN KEY (`modeloId`) REFERENCES `modelos` (`modeloId`),
  ADD CONSTRAINT `FK_area_fisica_encargadoId` FOREIGN KEY (`encargadoId`) REFERENCES `encargados` (`encargadoId`),
  ADD CONSTRAINT `FK_area_fisica_subdependenciaId` FOREIGN KEY (`subdependenciaId`) REFERENCES `subdependencias` (`subdependenciaId`),
  ADD CONSTRAINT `FK_area_fisica_tipoEquipoAFId` FOREIGN KEY (`tipoEquipoAFId`) REFERENCES `tipos_equipos_af` (`tipoEquipoAFId`);

--
-- Filtros para la tabla `bajas_equipo`
--
ALTER TABLE `bajas_equipo`
  ADD CONSTRAINT `FK_bajas_equipo_areaFisicaId` FOREIGN KEY (`areaFisicaId`) REFERENCES `area_fisica` (`areaFisicaId`);

--
-- Filtros para la tabla `bit_credenciales`
--
ALTER TABLE `bit_credenciales`
  ADD CONSTRAINT `FK_bit_credenciales_credencialId` FOREIGN KEY (`credencialId`) REFERENCES `credenciales` (`credencialId`);

--
-- Filtros para la tabla `bit_mantenimientos`
--
ALTER TABLE `bit_mantenimientos`
  ADD CONSTRAINT `FK_bit_mantenimientos_areaFisicaId` FOREIGN KEY (`areaFisicaId`) REFERENCES `area_fisica` (`areaFisicaId`),
  ADD CONSTRAINT `FK_bit_mantenimientos_tecnicoMantenimientoId` FOREIGN KEY (`tecnicoMantenimientoId`) REFERENCES `tecnicos_mantenimiento` (`tecnicoMantenimientoId`);

--
-- Filtros para la tabla `bit_mantenimientos_detalle`
--
ALTER TABLE `bit_mantenimientos_detalle`
  ADD CONSTRAINT `FK_bit_mantenimiento_detalle_bitMantenimientoId` FOREIGN KEY (`bitMantenimientoId`) REFERENCES `bit_mantenimientos` (`bitMantenimientoId`),
  ADD CONSTRAINT `FK_bit_mantenimiento_detalle_parteEquipoId` FOREIGN KEY (`parteEquipoId`) REFERENCES `partes_equipo` (`parteEquipoId`);

--
-- Filtros para la tabla `credenciales`
--
ALTER TABLE `credenciales`
  ADD CONSTRAINT `FK_credenciales_cargoId` FOREIGN KEY (`cargoId`) REFERENCES `cargos` (`cargoId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_credenciales_rolId` FOREIGN KEY (`rolId`) REFERENCES `roles` (`rolId`);

--
-- Filtros para la tabla `dependencias`
--
ALTER TABLE `dependencias`
  ADD CONSTRAINT `FK_unidadMilitarId` FOREIGN KEY (`unidadMilitarId`) REFERENCES `unidades_militares` (`unidadMilitarId`);

--
-- Filtros para la tabla `discos_duros`
--
ALTER TABLE `discos_duros`
  ADD CONSTRAINT `FK_discos_duros_modeloId` FOREIGN KEY (`modeloId`) REFERENCES `modelos` (`modeloId`),
  ADD CONSTRAINT `FK_discos_duros_tarjetaMadreId` FOREIGN KEY (`tarjetaMadreId`) REFERENCES `tarjeta_madre` (`tarjetaMadreId`);

--
-- Filtros para la tabla `entrega_equipos`
--
ALTER TABLE `entrega_equipos`
  ADD CONSTRAINT `FK_entrega_equipo_areaFisicaId` FOREIGN KEY (`areaFisicaId`) REFERENCES `area_fisica` (`areaFisicaId`);

--
-- Filtros para la tabla `evaluacion_tecnica`
--
ALTER TABLE `evaluacion_tecnica`
  ADD CONSTRAINT `FK_evaluacion_tecnica_areaFisicaId` FOREIGN KEY (`areaFisicaId`) REFERENCES `area_fisica` (`areaFisicaId`),
  ADD CONSTRAINT `FK_evaluacion_tecnica_parteEquipoId` FOREIGN KEY (`parteEquipoId`) REFERENCES `partes_equipo` (`parteEquipoId`),
  ADD CONSTRAINT `FK_evaluacion_tecnica_tecnicoId` FOREIGN KEY (`tecnicoMantenimientoId`) REFERENCES `tecnicos_mantenimiento` (`tecnicoMantenimientoId`);

--
-- Filtros para la tabla `impresoras`
--
ALTER TABLE `impresoras`
  ADD CONSTRAINT `FK_impresoras_modeloId` FOREIGN KEY (`modeloId`) REFERENCES `modelos` (`modeloId`);

--
-- Filtros para la tabla `marcas`
--
ALTER TABLE `marcas`
  ADD CONSTRAINT `FK_marcas_parteEquipoId` FOREIGN KEY (`parteEquipoId`) REFERENCES `partes_equipo` (`parteEquipoId`);

--
-- Filtros para la tabla `memoria_ram`
--
ALTER TABLE `memoria_ram`
  ADD CONSTRAINT `FK_memoria_ram_tarjetaMadreId` FOREIGN KEY (`tarjetaMadreId`) REFERENCES `tarjeta_madre` (`tarjetaMadreId`);

--
-- Filtros para la tabla `menus`
--
ALTER TABLE `menus`
  ADD CONSTRAINT `FK_moduloId` FOREIGN KEY (`moduloId`) REFERENCES `modulos` (`moduloId`);

--
-- Filtros para la tabla `modelos`
--
ALTER TABLE `modelos`
  ADD CONSTRAINT `FK_modelos_marcaId` FOREIGN KEY (`marcaId`) REFERENCES `marcas` (`marcaId`);

--
-- Filtros para la tabla `monitores`
--
ALTER TABLE `monitores`
  ADD CONSTRAINT `FK_monitores_areaFisicaId` FOREIGN KEY (`areaFisicaId`) REFERENCES `area_fisica` (`areaFisicaId`),
  ADD CONSTRAINT `FK_monitores_modeloId` FOREIGN KEY (`modeloId`) REFERENCES `modelos` (`modeloId`);

--
-- Filtros para la tabla `mouse`
--
ALTER TABLE `mouse`
  ADD CONSTRAINT `FK_mouse_areaFisicaId` FOREIGN KEY (`areaFisicaId`) REFERENCES `area_fisica` (`areaFisicaId`),
  ADD CONSTRAINT `FK_mouse_modeloId` FOREIGN KEY (`modeloId`) REFERENCES `modelos` (`modeloId`);

--
-- Filtros para la tabla `multimedia`
--
ALTER TABLE `multimedia`
  ADD CONSTRAINT `FK_multimedia_areaFisicaId` FOREIGN KEY (`areaFisicaId`) REFERENCES `area_fisica` (`areaFisicaId`),
  ADD CONSTRAINT `FK_multimedia_modeloId` FOREIGN KEY (`modeloId`) REFERENCES `modelos` (`modeloId`);

--
-- Filtros para la tabla `parlantes`
--
ALTER TABLE `parlantes`
  ADD CONSTRAINT `FK_parlantes_modeloId` FOREIGN KEY (`modeloId`) REFERENCES `modelos` (`modeloId`);

--
-- Filtros para la tabla `procesador`
--
ALTER TABLE `procesador`
  ADD CONSTRAINT `FK_procesador_tarjetaMadreId` FOREIGN KEY (`tarjetaMadreId`) REFERENCES `tarjeta_madre` (`tarjetaMadreId`),
  ADD CONSTRAINT `FK_procesador_tipoProcesadorId` FOREIGN KEY (`tipoProcesadorId`) REFERENCES `tipos_procesador` (`tipoProcesadorId`);

--
-- Filtros para la tabla `roles_menus`
--
ALTER TABLE `roles_menus`
  ADD CONSTRAINT `FK_roles_menus_menuId` FOREIGN KEY (`menuId`) REFERENCES `menus` (`menuId`),
  ADD CONSTRAINT `FK_roles_menus_rolId` FOREIGN KEY (`rolId`) REFERENCES `roles` (`rolId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `software`
--
ALTER TABLE `software`
  ADD CONSTRAINT `FK_software_areaFisicaId` FOREIGN KEY (`areaFisicaId`) REFERENCES `area_fisica` (`areaFisicaId`);

--
-- Filtros para la tabla `subdependencias`
--
ALTER TABLE `subdependencias`
  ADD CONSTRAINT `FK_subdependencias_dependenciaId` FOREIGN KEY (`dependenciaId`) REFERENCES `dependencias` (`dependenciaId`);

--
-- Filtros para la tabla `tarjeta_madre`
--
ALTER TABLE `tarjeta_madre`
  ADD CONSTRAINT `FK_tarjeta_madre_areaFisicaId` FOREIGN KEY (`areaFisicaId`) REFERENCES `area_fisica` (`areaFisicaId`),
  ADD CONSTRAINT `FK_tarjeta_madre_modeloId` FOREIGN KEY (`modeloId`) REFERENCES `modelos` (`modeloId`);

--
-- Filtros para la tabla `teclados`
--
ALTER TABLE `teclados`
  ADD CONSTRAINT `FK_teclados_areaFisicaId` FOREIGN KEY (`areaFisicaId`) REFERENCES `area_fisica` (`areaFisicaId`),
  ADD CONSTRAINT `FK_teclados_modeloId` FOREIGN KEY (`modeloId`) REFERENCES `modelos` (`modeloId`);

--
-- Filtros para la tabla `tipos_procesador`
--
ALTER TABLE `tipos_procesador`
  ADD CONSTRAINT `FK_tipos_procesador_modeloId` FOREIGN KEY (`modeloId`) REFERENCES `modelos` (`modeloId`);

--
-- Filtros para la tabla `ups`
--
ALTER TABLE `ups`
  ADD CONSTRAINT `FK_ups_areaFisicaId` FOREIGN KEY (`areaFisicaId`) REFERENCES `area_fisica` (`areaFisicaId`),
  ADD CONSTRAINT `FK_ups_modeloId` FOREIGN KEY (`modeloId`) REFERENCES `modelos` (`modeloId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
