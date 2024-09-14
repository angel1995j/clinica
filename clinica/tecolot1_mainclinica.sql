-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 14-09-2024 a las 17:22:24
-- Versión del servidor: 10.6.18-MariaDB-cll-lve-log
-- Versión de PHP: 8.1.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tecolot1_mainclinica`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `agenda`
--

CREATE TABLE `agenda` (
  `id_agenda` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `observaciones` text NOT NULL,
  `id_paciente` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `agenda`
--

INSERT INTO `agenda` (`id_agenda`, `fecha`, `observaciones`, `id_paciente`, `id_usuario`) VALUES
(1, '2024-08-21 12:50:00', 'xxxx', 7, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comisiones`
--

CREATE TABLE `comisiones` (
  `id_comision` int(11) NOT NULL,
  `concepto` text NOT NULL,
  `total_venta` float NOT NULL,
  `porcentaje` float NOT NULL,
  `estatus` text NOT NULL,
  `archivado` text NOT NULL,
  `fecha_venta` date NOT NULL,
  `fecha_pagado` date NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras`
--

CREATE TABLE `compras` (
  `id_compra` int(11) NOT NULL,
  `concepto` text NOT NULL,
  `quien_compra` text NOT NULL,
  `cuenta_compra` text NOT NULL,
  `tipo_compra` text NOT NULL,
  `monto` decimal(10,2) NOT NULL,
  `fecha_aplicacion` date NOT NULL,
  `comprobante` text NOT NULL,
  `estatus` text NOT NULL,
  `archivado` text NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `consumo`
--

CREATE TABLE `consumo` (
  `id_consumo` int(11) NOT NULL,
  `concepto` text NOT NULL,
  `monto` float NOT NULL,
  `fecha_consumo` date NOT NULL,
  `detalles` text NOT NULL,
  `id_paciente` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `consumo`
--

INSERT INTO `consumo` (`id_consumo`, `concepto`, `monto`, `fecha_consumo`, `detalles`, `id_paciente`, `id_usuario`) VALUES
(4, 'xxxxxxx', 1200, '2024-09-11', 'Seroquel', 16, 1),
(2, 'Se agrego un seroquel de 1200', 1200, '2024-09-07', 'Seroquel', 16, 1),
(3, 'se agrego aspirina', 1500, '2024-09-07', 'Aspirina', 16, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contactos`
--

CREATE TABLE `contactos` (
  `id_contacto` int(11) NOT NULL,
  `nombre` text NOT NULL,
  `aPaterno` text NOT NULL,
  `aMaterno` text NOT NULL,
  `telefono` text NOT NULL,
  `costo` text NOT NULL,
  `estado` text NOT NULL,
  `observaciones` text NOT NULL,
  `fecha_ingreso` date NOT NULL,
  `intensidad` text NOT NULL,
  `archivado` text NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `credito`
--

CREATE TABLE `credito` (
  `id_credito` int(11) NOT NULL,
  `saldo` float NOT NULL,
  `fecha_actualizacion` date NOT NULL,
  `fecha_fin` date DEFAULT NULL,
  `operacion` text NOT NULL,
  `metodoPago` text NOT NULL,
  `numeroMonto` int(11) NOT NULL,
  `id_paciente` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `credito`
--

INSERT INTO `credito` (`id_credito`, `saldo`, `fecha_actualizacion`, `fecha_fin`, `operacion`, `metodoPago`, `numeroMonto`, `id_paciente`) VALUES
(1, 400, '2024-07-24', '2024-07-31', 'Generación de límite de crédito', '', 1, 12),
(2, 400, '2024-07-24', '2024-08-07', 'Generación de límite de crédito', '', 2, 12),
(3, 400, '2024-07-24', '2024-08-14', 'Generación de límite de crédito', '', 3, 12),
(4, 400, '2024-07-24', '2024-08-21', 'Generación de límite de crédito', '', 4, 12),
(5, 400, '2024-07-24', '2024-08-28', 'Generación de límite de crédito', '', 5, 12),
(6, 400, '2024-07-24', '2024-09-04', 'Generación de límite de crédito', '', 6, 12),
(7, 400, '2024-07-24', '2024-09-11', 'Generación de límite de crédito', '', 7, 12),
(8, 400, '2024-07-24', '2024-09-18', 'Generación de límite de crédito', '', 8, 12),
(9, 400, '2024-07-24', '2024-09-25', 'Generación de límite de crédito', '', 9, 12),
(10, 400, '2024-07-24', '2024-10-02', 'Generación de límite de crédito', '', 10, 12),
(11, 400, '2024-07-24', '2024-10-09', 'Generación de límite de crédito', '', 11, 12),
(12, 400, '2024-07-24', '2024-10-16', 'Generación de límite de crédito', '', 12, 12),
(13, 4800, '2024-07-24', '2024-07-24', 'Ajuste automático de saldos', '', 0, 12),
(14, 300, '2024-07-17', '2024-07-24', 'Generación de límite de crédito', '', 1, 11),
(15, 300, '2024-07-17', '2024-07-31', 'Generación de límite de crédito', '', 2, 11),
(16, 300, '2024-07-17', '2024-08-07', 'Generación de límite de crédito', '', 3, 11),
(17, 300, '2024-07-17', '2024-08-14', 'Generación de límite de crédito', '', 4, 11),
(18, 300, '2024-07-17', '2024-08-21', 'Generación de límite de crédito', '', 5, 11),
(19, 300, '2024-07-17', '2024-08-28', 'Generación de límite de crédito', '', 6, 11),
(20, 300, '2024-07-17', '2024-09-04', 'Generación de límite de crédito', '', 7, 11),
(21, 300, '2024-07-17', '2024-09-11', 'Generación de límite de crédito', '', 8, 11),
(22, 300, '2024-07-17', '2024-09-18', 'Generación de límite de crédito', '', 9, 11),
(23, 300, '2024-07-17', '2024-09-25', 'Generación de límite de crédito', '', 10, 11),
(24, 300, '2024-07-17', '2024-10-02', 'Generación de límite de crédito', '', 11, 11),
(25, 300, '2024-07-17', '2024-10-09', 'Generación de límite de crédito', '', 12, 11),
(26, 3600, '2024-07-24', '2024-07-24', 'Ajuste automático de saldos', '', 0, 11),
(27, 300, '2024-07-12', '2024-07-19', 'Generación de límite de crédito', '', 1, 7),
(28, 300, '2024-07-12', '2024-07-26', 'Generación de límite de crédito', '', 2, 7),
(29, 300, '2024-07-12', '2024-08-02', 'Generación de límite de crédito', '', 3, 7),
(30, 300, '2024-07-12', '2024-08-09', 'Generación de límite de crédito', '', 4, 7),
(31, 300, '2024-07-12', '2024-08-16', 'Generación de límite de crédito', '', 5, 7),
(32, 300, '2024-07-12', '2024-08-23', 'Generación de límite de crédito', '', 6, 7),
(33, 300, '2024-07-12', '2024-08-30', 'Generación de límite de crédito', '', 7, 7),
(34, 300, '2024-07-12', '2024-09-06', 'Generación de límite de crédito', '', 8, 7),
(35, 300, '2024-07-12', '2024-09-13', 'Generación de límite de crédito', '', 9, 7),
(36, 300, '2024-07-12', '2024-09-20', 'Generación de límite de crédito', '', 10, 7),
(37, 300, '2024-07-12', '2024-09-27', 'Generación de límite de crédito', '', 11, 7),
(38, 300, '2024-07-12', '2024-10-04', 'Generación de límite de crédito', '', 12, 7),
(39, 3600, '2024-07-24', '2024-07-24', 'Ajuste automático de saldos', '', 0, 7),
(40, 300, '2024-07-11', '2024-07-18', 'Generación de límite de crédito', '', 1, 5),
(41, 300, '2024-07-11', '2024-07-25', 'Generación de límite de crédito', '', 2, 5),
(42, 300, '2024-07-11', '2024-08-01', 'Generación de límite de crédito', '', 3, 5),
(43, 300, '2024-07-11', '2024-08-08', 'Generación de límite de crédito', '', 4, 5),
(44, 300, '2024-07-11', '2024-08-15', 'Generación de límite de crédito', '', 5, 5),
(45, 300, '2024-07-11', '2024-08-22', 'Generación de límite de crédito', '', 6, 5),
(46, 300, '2024-07-11', '2024-08-29', 'Generación de límite de crédito', '', 7, 5),
(47, 300, '2024-07-11', '2024-09-05', 'Generación de límite de crédito', '', 8, 5),
(48, 300, '2024-07-11', '2024-09-12', 'Generación de límite de crédito', '', 9, 5),
(49, 300, '2024-07-11', '2024-09-19', 'Generación de límite de crédito', '', 10, 5),
(50, 300, '2024-07-11', '2024-09-26', 'Generación de límite de crédito', '', 11, 5),
(51, 300, '2024-07-11', '2024-10-03', 'Generación de límite de crédito', '', 12, 5),
(52, 3600, '2024-07-24', '2024-07-24', 'Ajuste automático de saldos', '', 0, 5),
(53, 300, '2024-07-18', '2024-07-25', 'Generación de límite de crédito', '', 1, 9),
(54, 300, '2024-07-18', '2024-08-01', 'Generación de límite de crédito', '', 2, 9),
(55, 300, '2024-07-18', '2024-08-08', 'Generación de límite de crédito', '', 3, 9),
(56, 300, '2024-07-18', '2024-08-15', 'Generación de límite de crédito', '', 4, 9),
(57, 300, '2024-07-18', '2024-08-22', 'Generación de límite de crédito', '', 5, 9),
(58, 300, '2024-07-18', '2024-08-29', 'Generación de límite de crédito', '', 6, 9),
(59, 300, '2024-07-18', '2024-09-05', 'Generación de límite de crédito', '', 7, 9),
(60, 300, '2024-07-18', '2024-09-12', 'Generación de límite de crédito', '', 8, 9),
(61, 300, '2024-07-18', '2024-09-19', 'Generación de límite de crédito', '', 9, 9),
(62, 300, '2024-07-18', '2024-09-26', 'Generación de límite de crédito', '', 10, 9),
(63, 300, '2024-07-18', '2024-10-03', 'Generación de límite de crédito', '', 11, 9),
(64, 300, '2024-07-18', '2024-10-10', 'Generación de límite de crédito', '', 12, 9),
(65, 3600, '2024-07-24', '2024-07-24', 'Ajuste automático de saldos', '', 0, 9),
(66, 300, '2024-07-16', '2024-07-23', 'Generación de límite de crédito', '', 1, 8),
(67, 300, '2024-07-16', '2024-07-30', 'Generación de límite de crédito', '', 2, 8),
(68, 280, '2024-07-16', '2024-08-06', 'Generación de límite de crédito', '', 3, 8),
(69, 300, '2024-07-16', '2024-08-13', 'Generación de límite de crédito', '', 4, 8),
(70, 100, '2024-07-16', '2024-08-20', 'Generación de límite de crédito', '', 5, 8),
(71, 300, '2024-07-16', '2024-08-27', 'Generación de límite de crédito', '', 6, 8),
(72, 300, '2024-07-16', '2024-09-03', 'Generación de límite de crédito', '', 7, 8),
(73, 300, '2024-07-16', '2024-09-10', 'Generación de límite de crédito', '', 8, 8),
(74, 300, '2024-07-16', '2024-09-17', 'Generación de límite de crédito', '', 9, 8),
(75, 300, '2024-07-16', '2024-09-24', 'Generación de límite de crédito', '', 10, 8),
(76, 300, '2024-07-16', '2024-10-01', 'Generación de límite de crédito', '', 11, 8),
(77, 300, '2024-07-16', '2024-10-08', 'Generación de límite de crédito', '', 12, 8),
(78, 3600, '2024-07-24', '2024-07-24', 'Ajuste automático de saldos', '', 0, 8),
(79, 250, '2023-09-21', '2023-09-28', 'Generación de límite de crédito', '', 1, 14),
(80, 250, '2023-09-21', '2023-10-05', 'Generación de límite de crédito', '', 2, 14),
(81, 250, '2023-09-21', '2023-10-12', 'Generación de límite de crédito', '', 3, 14),
(82, 250, '2023-09-21', '2023-10-19', 'Generación de límite de crédito', '', 4, 14),
(83, 250, '2023-09-21', '2023-10-26', 'Generación de límite de crédito', '', 5, 14),
(84, 250, '2023-09-21', '2023-11-02', 'Generación de límite de crédito', '', 6, 14),
(85, 250, '2023-09-21', '2023-11-09', 'Generación de límite de crédito', '', 7, 14),
(86, 250, '2023-09-21', '2023-11-16', 'Generación de límite de crédito', '', 8, 14),
(87, 250, '2023-09-21', '2023-11-23', 'Generación de límite de crédito', '', 9, 14),
(88, 250, '2023-09-21', '2023-11-30', 'Generación de límite de crédito', '', 10, 14),
(89, 250, '2023-09-21', '2023-12-07', 'Generación de límite de crédito', '', 11, 14),
(90, 250, '2023-09-21', '2023-12-14', 'Generación de límite de crédito', '', 12, 14),
(91, 3000, '2024-08-05', '2024-08-05', 'Ajuste automático de saldos', '', 0, 14),
(92, 250, '2023-09-21', '2023-09-28', 'Generación de límite de crédito', '', 1, 14),
(93, 250, '2023-09-21', '2023-10-05', 'Generación de límite de crédito', '', 2, 14),
(94, 250, '2023-09-21', '2023-10-12', 'Generación de límite de crédito', '', 3, 14),
(95, 250, '2023-09-21', '2023-10-19', 'Generación de límite de crédito', '', 4, 14),
(96, 250, '2023-09-21', '2023-10-26', 'Generación de límite de crédito', '', 5, 14),
(97, 250, '2023-09-21', '2023-11-02', 'Generación de límite de crédito', '', 6, 14),
(98, 250, '2023-09-21', '2023-11-09', 'Generación de límite de crédito', '', 7, 14),
(99, 250, '2023-09-21', '2023-11-16', 'Generación de límite de crédito', '', 8, 14),
(100, 250, '2023-09-21', '2023-11-23', 'Generación de límite de crédito', '', 9, 14),
(101, 250, '2023-09-21', '2023-11-30', 'Generación de límite de crédito', '', 10, 14),
(102, 250, '2023-09-21', '2023-12-07', 'Generación de límite de crédito', '', 11, 14),
(103, 250, '2023-09-21', '2023-12-14', 'Generación de límite de crédito', '', 12, 14),
(104, 3000, '2024-08-05', '2024-08-05', 'Ajuste automático de saldos', '', 0, 14),
(105, 230, '2024-08-05', '2024-08-12', 'Generación de límite de crédito', '', 1, 14),
(106, 250, '2024-08-05', '2024-08-05', 'Ajuste automático de saldos', '', 0, 14),
(107, 300, '2023-11-20', '2023-11-27', 'Generación de límite de crédito', '', 1, 15),
(108, 300, '2023-11-20', '2023-12-04', 'Generación de límite de crédito', '', 2, 15),
(109, 300, '2023-11-20', '2023-12-11', 'Generación de límite de crédito', '', 3, 15),
(110, 300, '2023-11-20', '2023-12-18', 'Generación de límite de crédito', '', 4, 15),
(111, 300, '2023-11-20', '2023-12-25', 'Generación de límite de crédito', '', 5, 15),
(112, 300, '2023-11-20', '2024-01-01', 'Generación de límite de crédito', '', 6, 15),
(113, 300, '2023-11-20', '2024-01-08', 'Generación de límite de crédito', '', 7, 15),
(114, 300, '2023-11-20', '2024-01-15', 'Generación de límite de crédito', '', 8, 15),
(115, 300, '2023-11-20', '2024-01-22', 'Generación de límite de crédito', '', 9, 15),
(116, 300, '2023-11-20', '2024-01-29', 'Generación de límite de crédito', '', 10, 15),
(117, 300, '2023-11-20', '2024-02-05', 'Generación de límite de crédito', '', 11, 15),
(118, 300, '2023-11-20', '2024-02-12', 'Generación de límite de crédito', '', 12, 15),
(119, 300, '2023-11-20', '2024-02-19', 'Generación de límite de crédito', '', 13, 15),
(120, 300, '2023-11-20', '2024-02-26', 'Generación de límite de crédito', '', 14, 15),
(121, 300, '2023-11-20', '2024-03-04', 'Generación de límite de crédito', '', 15, 15),
(122, 300, '2023-11-20', '2024-03-11', 'Generación de límite de crédito', '', 16, 15),
(123, 300, '2023-11-20', '2024-03-18', 'Generación de límite de crédito', '', 17, 15),
(124, 300, '2023-11-20', '2024-03-25', 'Generación de límite de crédito', '', 18, 15),
(125, 300, '2023-11-20', '2024-04-01', 'Generación de límite de crédito', '', 19, 15),
(126, 300, '2023-11-20', '2024-04-08', 'Generación de límite de crédito', '', 20, 15),
(127, 300, '2023-11-20', '2024-04-15', 'Generación de límite de crédito', '', 21, 15),
(128, 300, '2023-11-20', '2024-04-22', 'Generación de límite de crédito', '', 22, 15),
(129, 300, '2023-11-20', '2024-04-29', 'Generación de límite de crédito', '', 23, 15),
(130, 300, '2023-11-20', '2024-05-06', 'Generación de límite de crédito', '', 24, 15),
(131, 300, '2023-11-20', '2024-05-13', 'Generación de límite de crédito', '', 25, 15),
(132, 300, '2023-11-20', '2024-05-20', 'Generación de límite de crédito', '', 26, 15),
(133, 300, '2023-11-20', '2024-05-27', 'Generación de límite de crédito', '', 27, 15),
(134, 300, '2023-11-20', '2024-06-03', 'Generación de límite de crédito', '', 28, 15),
(135, 300, '2023-11-20', '2024-06-10', 'Generación de límite de crédito', '', 29, 15),
(136, 300, '2023-11-20', '2024-06-17', 'Generación de límite de crédito', '', 30, 15),
(137, 300, '2023-11-20', '2024-06-24', 'Generación de límite de crédito', '', 31, 15),
(138, 300, '2023-11-20', '2024-07-01', 'Generación de límite de crédito', '', 32, 15),
(139, 300, '2023-11-20', '2024-07-08', 'Generación de límite de crédito', '', 33, 15),
(140, 300, '2023-11-20', '2024-07-15', 'Generación de límite de crédito', '', 34, 15),
(141, 300, '2023-11-20', '2024-07-22', 'Generación de límite de crédito', '', 35, 15),
(142, 300, '2023-11-20', '2024-07-29', 'Generación de límite de crédito', '', 36, 15),
(143, 300, '2023-11-20', '2024-08-05', 'Generación de límite de crédito', '', 37, 15),
(144, 200, '2023-11-20', '2024-08-12', 'Generación de límite de crédito', '', 38, 15),
(145, 300, '2023-11-20', '2024-08-19', 'Generación de límite de crédito', '', 39, 15),
(146, 300, '2023-11-20', '2024-08-26', 'Generación de límite de crédito', '', 40, 15),
(147, 12000, '2024-08-10', '2024-08-10', 'Ajuste automático de saldos', '', 0, 15),
(148, 40, '2024-08-13', '2024-08-20', 'Generación de límite de crédito', '', 1, 16),
(149, 200, '2024-08-13', '2024-08-27', 'Generación de límite de crédito', '', 2, 16),
(150, 200, '2024-08-13', '2024-09-03', 'Generación de límite de crédito', '', 3, 16),
(151, 1982, '2024-08-13', '2024-09-10', 'Generación de límite de crédito', '', 4, 16),
(152, 800, '2024-08-13', '2024-08-13', 'Ajuste automático de saldos', '', 0, 16),
(153, 420, '2024-08-16', '2024-08-23', 'Generación de límite de crédito', '', 1, 3),
(154, 500, '2024-08-16', '2024-08-30', 'Generación de límite de crédito', '', 2, 3),
(155, 500, '2024-08-16', '2024-09-06', 'Generación de límite de crédito', '', 3, 3),
(156, 500, '2024-08-16', '2024-09-13', 'Generación de límite de crédito', '', 4, 3),
(157, 2000, '2024-08-16', '2024-08-16', 'Ajuste automático de saldos', '', 0, 3),
(158, 140, '2024-09-11', '2024-09-18', 'Generación de límite de crédito', '', 1, 16),
(159, 200, '2024-09-11', '2024-09-25', 'Generación de límite de crédito', '', 2, 16),
(160, 200, '2024-09-11', '2024-10-02', 'Generación de límite de crédito', '', 3, 16),
(161, 200, '2024-09-11', '2024-10-09', 'Generación de límite de crédito', '', 4, 16),
(162, 800, '2024-09-11', '2024-09-11', 'Ajuste automático de saldos', '', 0, 16);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalles_orden`
--

CREATE TABLE `detalles_orden` (
  `id_detalle` int(11) NOT NULL,
  `id_orden` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_unitario` decimal(10,2) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `detalles_orden`
--

INSERT INTO `detalles_orden` (`id_detalle`, `id_orden`, `id_producto`, `cantidad`, `precio_unitario`, `subtotal`) VALUES
(1, 1, 1, 2, 20.00, 40.00),
(2, 2, 1, 1, 20.00, 20.00),
(3, 3, 1, 4, 20.00, 80.00),
(4, 4, 1, 5, 20.00, 100.00),
(5, 5, 1, 8, 20.00, 160.00),
(6, 6, 1, 4, 20.00, 80.00),
(7, 7, 3, 6, 18.00, 108.00),
(8, 8, 3, 4, 18.00, 72.00),
(9, 9, 3, 1, 18.00, 18.00),
(10, 10, 1, 1, 20.00, 20.00),
(11, 11, 1, 1, 20.00, 20.00),
(12, 12, 1, 1, 20.00, 20.00),
(13, 13, 1, 1, 20.00, 20.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_solicitudes`
--

CREATE TABLE `detalle_solicitudes` (
  `id_detalle_solicitud` int(11) NOT NULL,
  `id_solicitud` int(11) NOT NULL,
  `descripcion_item` varchar(255) NOT NULL,
  `cantidad` decimal(10,2) NOT NULL,
  `unidad_medida` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `detalle_solicitudes`
--

INSERT INTO `detalle_solicitudes` (`id_detalle_solicitud`, `id_solicitud`, `descripcion_item`, `cantidad`, `unidad_medida`) VALUES
(1, 3, 'jitomates', 20.00, 'pieza'),
(2, 3, 'aceite', 2.00, 'litro'),
(3, 3, 'papas', 1.00, 'docena'),
(4, 4, 'jitomates', 12.00, 'pieza'),
(5, 4, 'papas', 2.00, 'kilogramo'),
(6, 4, 'arrox', 2.00, 'bolsa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `docs_empleado`
--

CREATE TABLE `docs_empleado` (
  `id_docs` int(11) NOT NULL,
  `id_empleado` int(11) NOT NULL,
  `tipo_documento` text NOT NULL,
  `fecha` date NOT NULL,
  `observaciones` text NOT NULL,
  `archivo` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `docs_empleado`
--

INSERT INTO `docs_empleado` (`id_docs`, `id_empleado`, `tipo_documento`, `fecha`, `observaciones`, `archivo`) VALUES
(1, 4, 'Documentos Internos', '2024-07-19', 'doc', 'GIF-ANIMADO-88-ANIV-ok.gif');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `id_empleado` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `aPaterno` varchar(255) NOT NULL,
  `aMaterno` varchar(255) NOT NULL,
  `numero_telefono` varchar(15) DEFAULT NULL,
  `fecha_ingreso` date DEFAULT NULL,
  `fecha_salida` date DEFAULT NULL,
  `puesto` varchar(100) DEFAULT NULL,
  `salario_bruto` decimal(10,2) DEFAULT NULL,
  `salario_neto` decimal(10,2) DEFAULT NULL,
  `otros_conceptos` text DEFAULT NULL,
  `monto_otros_conceptos` decimal(10,2) DEFAULT NULL,
  `contactos` text NOT NULL,
  `datos_familiares` text NOT NULL,
  `domicilio` text NOT NULL,
  `fecha_antidoping` date DEFAULT NULL,
  `referencias_laborales` text NOT NULL,
  `motivo_salida` text NOT NULL,
  `finiquito` text NOT NULL,
  `archivado` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`id_empleado`, `nombre`, `aPaterno`, `aMaterno`, `numero_telefono`, `fecha_ingreso`, `fecha_salida`, `puesto`, `salario_bruto`, `salario_neto`, `otros_conceptos`, `monto_otros_conceptos`, `contactos`, `datos_familiares`, `domicilio`, `fecha_antidoping`, `referencias_laborales`, `motivo_salida`, `finiquito`, `archivado`) VALUES
(1, 'Víctor ', 'Picho ', 'Ruiz ', '44 36 11 26 62', '2024-03-18', '0000-00-00', 'ventas ', NULL, 4000.00, '0', 0.00, '', '', '', NULL, '', '', '', 'no'),
(4, 'JUAN', 'Ramirez', 'test', '54564564564', '2024-07-19', '0000-00-00', 'psicologia', NULL, 15000.00, '1250', 1200.00, 'juan papa\r\nhermano luis', 'familia \r\nfamilia tambien', 'centro', '2024-07-19', 'jose amigo.\r\nfrida excompañera', '', '', 'si'),
(5, '', '', '', NULL, '0000-00-00', NULL, '', NULL, 0.00, '', NULL, '', '', '', NULL, '', '', '', ''),
(6, 'Benjamin Alejandro ', 'Gonzalez ', 'Pérez', '443 380 9272', '2019-07-20', '0000-00-00', 'cocina', NULL, 12000.00, '', 0.00, '', '', '', '2024-08-01', '', '', '', 'no');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evolucion`
--

CREATE TABLE `evolucion` (
  `id_evolucion` int(11) NOT NULL,
  `descripcion` text NOT NULL,
  `evaluacion` text NOT NULL,
  `fecha` date NOT NULL,
  `imagen` text NOT NULL,
  `id_paciente` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_saldo`
--

CREATE TABLE `historial_saldo` (
  `id_historial` int(11) NOT NULL,
  `monto` decimal(10,2) NOT NULL,
  `comprobante` varchar(255) DEFAULT NULL,
  `fecha_agregado` datetime NOT NULL DEFAULT current_timestamp(),
  `fecha_pagado` datetime DEFAULT NULL,
  `observaciones` text DEFAULT NULL,
  `forma_pago` text DEFAULT NULL,
  `estatus` text NOT NULL,
  `archivado` text DEFAULT NULL,
  `id_paciente` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `historial_saldo`
--

INSERT INTO `historial_saldo` (`id_historial`, `monto`, `comprobante`, `fecha_agregado`, `fecha_pagado`, `observaciones`, `forma_pago`, `estatus`, `archivado`, `id_paciente`, `id_usuario`) VALUES
(1, 27000.00, '', '2024-07-11 00:00:00', '2024-06-15 00:00:00', 'primer pago realizado ', 'Efectivo', 'No aplicado', 'no', 4, NULL),
(2, 500.00, '', '2024-07-11 00:00:00', '2024-06-09 00:00:00', 'ventas folio 100', 'Efectivo', 'No aplicado', 'no', 4, NULL),
(3, 500.00, '', '2024-07-11 00:00:00', '2024-06-29 00:00:00', 'ventas folio 123', 'Efectivo', 'No aplicado', 'no', 4, NULL),
(4, 2000.00, '', '2024-08-05 00:00:00', '2024-09-21 00:00:00', 'TIENDA', 'Efectivo', 'No aplicado', 'no', 14, NULL),
(5, 30025.72, '', '2024-08-05 00:00:00', '2023-12-18 00:00:00', 'tratamiento', 'Transferencia', 'No aplicado', 'no', 14, NULL),
(6, 30024.72, '', '2024-08-05 00:00:00', '2023-12-18 00:00:00', 'otro', 'Transferencia', 'No aplicado', 'no', 14, NULL),
(7, 24659.40, '', '2024-08-10 00:00:00', '2024-01-05 00:00:00', 'Primer pago', 'Transferencia', 'No aplicado', 'no', 15, NULL),
(8, 33960.00, '', '2024-08-10 00:00:00', '2024-04-29 00:00:00', 'Segundo pago', 'Transferencia', 'No aplicado', 'no', 15, NULL),
(10, 24178.00, '', '2024-08-10 00:00:00', '2024-05-24 00:00:00', 'Tercer pago', 'Efectivo', 'No aplicado', 'no', 15, NULL),
(11, 20000.00, '', '2024-08-13 00:00:00', '2024-08-13 00:00:00', 'abono', 'Efectivo', 'No aplicado', 'no', 16, NULL),
(12, 10000.00, '', '2024-08-13 00:00:00', '2024-08-13 00:00:00', '', 'Efectivo', 'No aplicado', 'si', 16, NULL),
(13, 4000.00, '', '2024-08-16 00:00:00', '2024-01-30 00:00:00', '', 'Transferencia', 'No aplicado', 'no', 3, NULL),
(14, 17000.00, '', '2024-08-16 00:00:00', '2024-02-02 00:00:00', '', 'Transferencia', 'No aplicado', 'no', 3, NULL),
(15, 17000.00, '', '2024-08-16 00:00:00', '2024-03-04 00:00:00', '', 'Transferencia', 'No aplicado', 'no', 3, NULL),
(16, 16000.00, '', '2024-08-16 00:00:00', '2024-04-05 00:00:00', '', 'Transferencia', 'No aplicado', 'no', 3, NULL),
(17, 5389.54, '', '2024-08-16 00:00:00', '2024-04-30 00:00:00', '', 'Transferencia', 'No aplicado', 'no', 3, NULL),
(18, 17000.00, '', '2024-08-16 00:00:00', '2024-05-09 00:00:00', '', 'Transferencia', 'No aplicado', 'no', 3, NULL),
(19, 17000.00, '', '2024-08-16 00:00:00', '2024-06-04 00:00:00', '', 'Transferencia', 'No aplicado', 'no', 3, NULL),
(20, 16000.00, '', '2024-08-16 00:00:00', '2024-07-08 00:00:00', '', 'Transferencia', 'No aplicado', 'no', 3, NULL),
(21, 2757.00, '', '2024-08-16 00:00:00', '2024-07-18 00:00:00', '', 'Transferencia', 'No aplicado', 'no', 3, NULL),
(22, 748.00, '', '2024-08-16 00:00:00', '2024-07-30 00:00:00', '', 'Efectivo', 'No aplicado', 'no', 3, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historia_clinica`
--

CREATE TABLE `historia_clinica` (
  `id_historia` int(11) NOT NULL,
  `id_paciente` int(11) DEFAULT NULL,
  `fecha_consulta` date DEFAULT NULL,
  `alergias` text DEFAULT NULL,
  `operaciones_previas` text DEFAULT NULL,
  `diagnostico` text DEFAULT NULL,
  `tratamiento` text DEFAULT NULL,
  `resultados_bioquimica` text DEFAULT NULL,
  `hospitalizaciones_previas` text DEFAULT NULL,
  `padecimientos_actuales` text DEFAULT NULL,
  `historia_familiar_enfermedades` text DEFAULT NULL,
  `fecha_actualizacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hojas_egreso`
--

CREATE TABLE `hojas_egreso` (
  `id_egreso` int(11) NOT NULL,
  `id_paciente` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `motivos_egreso` text DEFAULT NULL,
  `diagnostico_ingreso` text DEFAULT NULL,
  `periodo_internamiento` text DEFAULT NULL,
  `tratamiento_llevado_cabo` text DEFAULT NULL,
  `estudios_realizados` text DEFAULT NULL,
  `eeg` text DEFAULT NULL,
  `laboratorio` text DEFAULT NULL,
  `rx` text DEFAULT NULL,
  `pruebas_psicologicas` text DEFAULT NULL,
  `otros` text DEFAULT NULL,
  `evolucion_manejo_estancia` text DEFAULT NULL,
  `descripcion_estado_general` text DEFAULT NULL,
  `exploracion_fisica_egreso` text DEFAULT NULL,
  `problemas_clinicos_pendientes` text DEFAULT NULL,
  `recomendaciones_seguimiento` text DEFAULT NULL,
  `pronostico` text DEFAULT NULL,
  `observaciones_generales` text DEFAULT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `fechas_horas` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`fechas_horas`))
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `hojas_egreso`
--

INSERT INTO `hojas_egreso` (`id_egreso`, `id_paciente`, `id_usuario`, `fecha`, `motivos_egreso`, `diagnostico_ingreso`, `periodo_internamiento`, `tratamiento_llevado_cabo`, `estudios_realizados`, `eeg`, `laboratorio`, `rx`, `pruebas_psicologicas`, `otros`, `evolucion_manejo_estancia`, `descripcion_estado_general`, `exploracion_fisica_egreso`, `problemas_clinicos_pendientes`, `recomendaciones_seguimiento`, `pronostico`, `observaciones_generales`, `fecha_creacion`, `fechas_horas`) VALUES
(1, 16, 7, '2024-09-03 14:51:00', 'Motivos de Egreso', 'Diagnóstico de Ingreso', 'Periodo de Internamiento', 'Tratamiento Llevado a Cabo', 'Estudios Realizados', 'E.E.G', 'Laboratorio', 'RX', 'Pruebas Psicológicas', 'Otros', 'Evolución y Manejo Durante la Estancia', 'Descripción del Estado General', 'Exploración Física al Egreso', 'Problemas Clínicos Pendientes', 'Recomendaciones para Seguimiento de Caso', 'Pronóstico', 'Observaciones Generales Acerca del Usuario', '2024-09-02 19:52:03', '[{\"fecha\":\"2024-09-03\",\"hora\":\"14:38\"},{\"fecha\":\"2024-09-17\",\"hora\":\"16:55\"}]');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notas_consejeria`
--

CREATE TABLE `notas_consejeria` (
  `id_consejeria` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `objetivo` text NOT NULL,
  `resumen` text NOT NULL,
  `resultados` text NOT NULL,
  `aspectos_esperados` text NOT NULL,
  `tareas` text NOT NULL,
  `aspectos_trabajados` text NOT NULL,
  `observaciones` text NOT NULL,
  `fecha_proxima` date NOT NULL,
  `id_paciente` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `notas_consejeria`
--

INSERT INTO `notas_consejeria` (`id_consejeria`, `fecha`, `hora`, `objetivo`, `resumen`, `resultados`, `aspectos_esperados`, `tareas`, `aspectos_trabajados`, `observaciones`, `fecha_proxima`, `id_paciente`, `id_usuario`) VALUES
(1, '2024-08-28', '17:36:03', 'objetivo consejeria', 'resumen consejeria', 'resultados de consejeria', 'aspectos consejeria', 'tareas consejeria', 'aspectos trabajados consejeria', 'observaciones consejeria', '2024-08-28', 16, 0),
(2, '2024-08-28', '16:59:00', 'OBJETIVO TERAPEUTICO DE CONSEJERIA', 'RESUMEN DE LA SESIÓN (ASPECTOS TRABAJAOS EN SESION)', 'RESULTADOS DE LA SESIÓN DE CONSEJERIA (CONDUCTA Y DISPOSICIÓN)', 'ASPECTOS QUE SE ESPERAN TRABAJAR EN LA SIGUIENTE SESIÓN', 'TAREAS ASIGNADAS AL USUARIO', 'ASPECTOS TRABAJADOS CON EL USUARIO PARA REINSERCIÓN SOCIAL', 'OBSERVACIONES', '2024-08-31', 16, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notas_psicologicas`
--

CREATE TABLE `notas_psicologicas` (
  `id_nota` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `no_exp` varchar(50) DEFAULT NULL,
  `objetivo` text DEFAULT NULL,
  `resumen` text DEFAULT NULL,
  `resultados` text DEFAULT NULL,
  `actividades` text DEFAULT NULL,
  `plan` text DEFAULT NULL,
  `fecha_proxima` date DEFAULT NULL,
  `cedula` varchar(20) DEFAULT NULL,
  `nombre_psicologo` varchar(100) DEFAULT NULL,
  `id_paciente` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `notas_psicologicas`
--

INSERT INTO `notas_psicologicas` (`id_nota`, `fecha`, `hora`, `no_exp`, `objetivo`, `resumen`, `resultados`, `actividades`, `plan`, `fecha_proxima`, `cedula`, `nombre_psicologo`, `id_paciente`, `id_usuario`) VALUES
(1, '2024-08-22', '19:18:06', 'ssdd', 'objetivo', 'resumen de la sesión', 'resultados de la sesión', 'actividades de sesion', 'plan', '2024-08-22', '123', 'angel', 16, 1),
(2, '2024-08-23', '20:35:00', 'TT0824', 'objetivo 2', 'resumen 2', 'resultados 2', 'actividades 2 ', 'Plan 2', '2024-08-23', '234q2', 'angel', 16, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ordenes`
--

CREATE TABLE `ordenes` (
  `id_orden` int(11) NOT NULL,
  `id_paciente` int(11) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `total` decimal(10,2) NOT NULL,
  `firma` text NOT NULL,
  `estatus` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `ordenes`
--

INSERT INTO `ordenes` (`id_orden`, `id_paciente`, `fecha_creacion`, `total`, `firma`, `estatus`) VALUES
(1, 14, '2024-08-05 18:12:58', 40.00, '', 'Pagado'),
(2, 8, '2024-08-05 18:13:58', 20.00, '', 'Pagado'),
(3, 14, '2024-08-05 18:18:35', 80.00, '', 'Pagado'),
(4, 15, '2024-08-10 19:43:22', 100.00, '', 'Pagado'),
(5, 16, '2024-08-13 17:43:08', 160.00, '', 'Pagado'),
(6, 3, '2024-08-16 18:32:41', 80.00, '', 'Pagado'),
(7, 16, '2024-09-04 19:53:56', 108.00, '', 'No Pagado'),
(8, 16, '2024-09-06 22:38:39', 72.00, '', 'No Pagado'),
(9, 16, '2024-09-07 22:17:57', 18.00, '', 'No Pagado'),
(10, 16, '2024-09-07 22:18:46', 20.00, '../assets/docs/firmas/firma_10_1725919534.png', 'No Pagado'),
(11, 16, '2024-09-11 17:05:36', 20.00, '', 'No Pagado'),
(12, 16, '2024-09-11 17:08:32', 20.00, '../assets/docs/firmas/firma_12_1726074525.png', 'No Pagado'),
(13, 16, '2024-09-11 17:12:28', 20.00, '../assets/docs/firmas/firma_13_1726074785.png', 'No Pagado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pacientes`
--

CREATE TABLE `pacientes` (
  `id_paciente` int(11) NOT NULL,
  `nombre` text NOT NULL,
  `aPaterno` text NOT NULL,
  `aMaterno` text NOT NULL,
  `fechaNacimiento` text NOT NULL,
  `sexo` text NOT NULL,
  `edad` int(11) NOT NULL,
  `direccion` text NOT NULL,
  `telefono` text NOT NULL,
  `nacionalidad` text NOT NULL,
  `estadoCivil` text NOT NULL,
  `escolaridad` text NOT NULL,
  `ocupacion` text NOT NULL,
  `ingresosPrevios` text NOT NULL,
  `fechasIngresosPrevios` text NOT NULL,
  `institucionRefiere` text NOT NULL,
  `nombreReferencia` text NOT NULL,
  `fechaIngreso` text NOT NULL,
  `horaIngreso` text NOT NULL,
  `hojaReferencia` text NOT NULL,
  `tipoIngreso` text NOT NULL,
  `revisionFisicaGeneral` text NOT NULL,
  `vestimentaIngreso` text NOT NULL,
  `pertenenciasIngreso` text NOT NULL,
  `ultimoConsumo` text NOT NULL,
  `intoxicado` text NOT NULL,
  `estatus` int(11) NOT NULL,
  `nombreFamiliar` text NOT NULL,
  `edadFamiliar` text NOT NULL,
  `ocupacionFamiliar` text NOT NULL,
  `parentescoFamiliar` text NOT NULL,
  `direccionFamiliar` text NOT NULL,
  `identificacionFamiliar` text NOT NULL,
  `correoFamiliar` text NOT NULL,
  `telefonoFamiliar` text NOT NULL,
  `sustanciaPsicoactiva` text DEFAULT NULL,
  `tiempoSustanciaPsicoactiva` text DEFAULT NULL,
  `enfermedades` text DEFAULT NULL,
  `hospitalizacionesRecientes` text DEFAULT NULL,
  `centroReclusion` text DEFAULT NULL,
  `asistenciaGrupos` text DEFAULT NULL,
  `restriccionesConsumo` text NOT NULL,
  `codigoUnico` text NOT NULL,
  `archivado` text NOT NULL,
  `saldo` decimal(10,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `pacientes`
--

INSERT INTO `pacientes` (`id_paciente`, `nombre`, `aPaterno`, `aMaterno`, `fechaNacimiento`, `sexo`, `edad`, `direccion`, `telefono`, `nacionalidad`, `estadoCivil`, `escolaridad`, `ocupacion`, `ingresosPrevios`, `fechasIngresosPrevios`, `institucionRefiere`, `nombreReferencia`, `fechaIngreso`, `horaIngreso`, `hojaReferencia`, `tipoIngreso`, `revisionFisicaGeneral`, `vestimentaIngreso`, `pertenenciasIngreso`, `ultimoConsumo`, `intoxicado`, `estatus`, `nombreFamiliar`, `edadFamiliar`, `ocupacionFamiliar`, `parentescoFamiliar`, `direccionFamiliar`, `identificacionFamiliar`, `correoFamiliar`, `telefonoFamiliar`, `sustanciaPsicoactiva`, `tiempoSustanciaPsicoactiva`, `enfermedades`, `hospitalizacionesRecientes`, `centroReclusion`, `asistenciaGrupos`, `restriccionesConsumo`, `codigoUnico`, `archivado`, `saldo`) VALUES
(2, 'Flor', 'Gamiño ', 'Villa', '1993-02-01', 'Femenino', 0, 'Guillermo García col. el mirador s/n. Nocupetaro Mich.', '4591138523', 'mexicana', 'Soltero(a)', 'Preparatoria', '', '0', '', 'No', '', '2024-07-06', '', 'No', 'Involuntario', '', '', '', '', 'No', 1, '', '', '', '', '', '', '', '', 'alcohól', '', 'no', '', 'NO', '', '', 'ff85a043b0c10a488289e7061c29aae9e14c4ede', 'si', NULL),
(3, 'Jorge Antonio ', 'Cruz ', 'Rivera ', '1958-08-28', 'Masculino', 65, 'Fraccionamiento Santa Bárbara, Uruapan. ', '452 149 12 51', 'Mexicano ', 'Casado(a)', 'Licenciatura', 'jubilado ', '1', 'clínica 7 ángeles ', 'No', 'clínica 7 ángeles ', '', '', 'No', 'Involuntario', 'n/p', 'n/p', 'n/p', '', 'Si', 1, 'Montserrat  Noemi Cruz Díaz ', '27 años ', '', 'hija ', 'Uruapan Michoacán. Col. casa del niño, calle del niño 23A', 'credencial ', 'n/p', '+524521491251', 'alcohól', '10 años ', 'no ', 'no ', 'no ', 'no ', '', '48ddd24c80e21110dcb5d352765d7a21a821b66d', 'No', 12817),
(4, 'Antonio ', 'Vera ', 'Rojo ', '1963-06-19', 'Masculino', 61, 'Calle Madero poniente, #635, Col. centro, Tacámbaro Mich. c.p 61652', '+52 459 123 93 13 ', 'Mexicano ', 'Casado(a)', 'Preparatoria', 'agricultor ', '0', 'ninguno ', 'No', 'n/a', '2024-06-07', '', 'No', 'Involuntario', '', '', '', '', 'No', 1, 'Rosa Pineda Tinoco ', '51', '', 'esposa ', 'Calle Madero poniente, #635, Col. centro, Tacámbaro Mich. c.p 61652', '1863075045117', 'n/p', '+52 459 123 93 13 ', 'alcohol', '', 'padece de la columna ', 'involuntario ', 'no ', 'no ', '', '7e5c72d0d7ecd1ea3468cdebaab9206b2dfc2de6', 'No', 1334),
(5, 'David Francisco ', 'Balderas', '', '2003-12-06', 'Masculino', 20, 'Morelos 144, ampliación San Pascual c.p 58337 Morelia Mich.', '', 'americano ', 'Soltero(a)', 'Preparatoria', 'estudiante ', '0', '', 'No', '', '2024-07-11', '12:10', 'No', 'Involuntario', '', 'n/p', 'ninguna, se lo llevó la familia ', '', 'No', 1, 'Teresa Benites Balderas ', '', 'ama de casa ', 'mamá ', 'Morelos 144, ampliación San Pascual c.p 58337 Morelia Mich.', 'INE ', 'terebenitez@live.com', '562 351 06 59', 'marihuana ', '', 'ninguna ', 'no ', 'no ', 'no ', '300 pesos ', 'f3c25a78afdb2d4011a9aca3f35c7cea0af7a608', 'No', NULL),
(7, 'José Luis ', 'Rojas ', 'Becerra ', '1978-06-23', 'Masculino', 0, 'Calle 12 de octubre 852, col. Morelos. Ario de Rosales c.p 61830', '425 107 59 26', 'mexicano ', 'Unión libre', 'Secundaria', 'albañil', '0', 'n/a', 'No', '', '2024-07-12', '20:45', 'No', 'Involuntario', ' presión alta desde hace 20 años ', 'playera, pantalón de mezclilla, una gorra, boxer gris, calcetas blancas, cinturón blanco. ', 'una moneda de 5 pesos y un rosario de madera', '2024-07-12', 'Si', 1, 'Maribel Rojas Becerra ', 'n/p', 'n/p', 'hermana ', 'Calle 12 de octubre 852, col. Morelos. Ario de Rosales c.p 61830', 'INE 0151073167006', 'n/p', '425 107 59 26', 'alcohol', '12 años', 'no ', 'no ', 'no ', 'no ', '300 pesos ', 'f413c35f0314fb6a9841a13977633a244992d08c', 'No', NULL),
(8, 'JAIME ', 'MARAVILLA', 'GONZALEZ', '2000-10-30', 'Masculino', 23, 'Calle Madero, 489, Jacona Michoacán ', '353 126 31 81', 'mexicano ', 'Casado(a)', 'Primaria', 'comercio ', '0', 'n/a', 'No', 'n/a', '2024-07-16', '09:02', 'No', 'Voluntario', '10 tatuajes', 'playera negra Boss, camiceta blanca, 1 pantalón de mezcilla, tenis blancos, 1 par de lentes, 1 cinto ', 'ninguna ', '2024-07-12', 'No', 1, 'Jaime Maravilla Manzo ', '43 años ', 'comerciante ', 'papá', 'calle madero 482, col San Pablo. Jacona Mich. cp 59853', 'INE', 'n/p', '353 126 31 81', 'cristal ', '1 año', 'ansiedad ', 'no ', 'no ', 'no ', 'no cigarros', '8c1586df452922e0c3f7cc733bed3c5f8314fc67', 'No', NULL),
(9, 'Josoa ', 'García ', 'Torres ', '2009-08-28', 'Masculino', 14, 'Prolongación Nicolás Bravo 365', '', 'mexicano ', 'Soltero(a)', 'Secundaria', 'estudiante ', '0', 'n/a', 'No', 'n/a', '2024-06-28', '14:50', 'No', 'Involuntario', 'golpe en ambas rodillas, codo izquierdo con golpe y mentón ', 'chamarra negra, playera blanca y pantalón negro, tenis negros, tines negros, boxer gris, gorra azul', 'cadena de fantasía, no de oro. ', '2024-07-17', 'No', 1, 'Blanca Torres Ayala ', '44 años ', 'cosmetología ', 'mamá ', 'Prolongación Nicolás Bravo 365', 'INE ', 'n/p', '354 118 43 25 ', 'marihuana, cocaina, alcohol, medicamentos, ácidos, etc.', '1 año', 'fractura en dos brazos de pequeño ', '0', 'no ', 'no ', '300', 'ee3df99a939f85849ef047416ed18ff9a7447020', 'No', NULL),
(10, 'David Francisco ', 'Balderas ', '', '2003-12-06', 'Masculino', 20, 'col. Morelos, 149. Ampliación San Pascual. Morelia Mich.', '', 'mexicano ', 'Soltero(a)', 'Preparatoria', 'estudiante ', '0', 'n/a', 'No', 'n/a', '2024-07-11', '12:10', 'No', 'Involuntario', 'ninguna ', 'cobija azul, tenis vans azules, playera verde agua, boxer rojo, calcetas negras', 'ninguna', '', 'No', 1, 'Teresa Benites Balderas ', 'n/p', 'ama de casa ', 'Mamá ', 'col. Morelos, 149. Ampliación San Pascual. Morelia Mich.', 'INE A7049067', 'terebenites@live.com', '562 351 06 59', 'marihuana ', '2 años ', 'ninguna ', 'ninguna ', 'no ', 'no ', '', '13d8151bcf6f9b4b0a113ab5c66eb335321cac82', 'si', NULL),
(11, 'HECTOR RICARDO ', 'GALVAN ', 'ROSALES ', '2002-08-18', 'Masculino', 21, 'Onorato rico 33, col. aguacate Tepic. Nayarit', '', 'mexicano ', 'Soltero(a)', 'Preparatoria', 'estudiante ', '2', '', 'No', 'n/a', '2024-07-18', '19:15', 'No', 'Involuntario', '1 tatuaje lado derecho, operacipon cixis, 4 cicatrices en cada pierna', 'short negro, tenisBoss negros, boxer azul, calcetas puma y playera verde ', '1 celular honor negro con protector transparente', '2024-07-07', 'Si', 1, 'Hector Gabriel Galvan Araiza ', '49 ', '0806041087892', 'papá', 'Onorato rico 33, col. aguacate Tepic. Nayarit', 'INE ', 'n/p', '311 84 75 059', 'marihuana ', '1 mes ', 'ninguna ', 'no ', 'no ', 'poco tiempo ', '300 pesos de tienda', '92f54b1dbe3e5eed693b61f4b1ce1452c67a2e96', 'No', NULL),
(12, 'María del Carmen', ' Zavala ', 'Valencia ', '1966-07-16', 'Femenino', 58, 'Col. Lazaro Cardenas. Naranjo de Chila', '', 'mexicana', 'Divorciado(a)', 'Primaria', 'ama de casa ', '0', 'n/a', 'No', 'n/a', '2024-07-13', '20:00', 'No', 'Involuntario', '1 rasguño en el pecho', 'blusa rosa, brasier color vino, maya guinda, pantaleta gris, licra blanca estampada, sandalias negras', 'arracadas y aretes de corazón ', '2024-07-12', 'Si', 1, 'Alondra Infante Zavala ', '30 ', 'psicóloga ', 'hija ', 'presa de tenango, 91, frac. Valle de los Reyes, Morelia Mich', 'INE ', 'infantealon@gmail.com', '443 220 94 58', 'alcohol', '1 año', 'azucar alta ', 'no ', 'no ', '2 semanas en grupo tradicional de rehabilitación ', '400 pesos de tienda ', '5cbe42ace894156f160540eeb792998731227ff5', 'No', NULL),
(13, 'CRUZ ', 'SUAREZ', 'HUERTA ', '1975-03-21', 'Masculino', 49, 'Calle Zamora sur, 143, Fracc. hacienda ', '755 100 05 15', 'mexicana ', 'Unión libre', 'Preparatoria', 'comerciante ', '0', 'n/a', 'No', 'n/a', '2024-07-24', '20:50', 'No', 'Voluntario', 'sin tatuajes y sin perforaciones. Sin golpes. 1 cicatriz por operación en espalda baja ', '1 par de zapatos, 1 pantalón gris obscuro, 1 playera azul, saco gris, 1 boxer, 1 par de calcetines ', '1 celular iphone 12 Pro May negro y con funda, mica estrellada. Cargador blanco. ', '', 'No', 1, 'María Guadalupe García Abara ', '47 años ', '', 'esposa ', 'Calle Zamora sur, 143, Fracc. hacienda ', 'INE ', '', '755 55 80 682', 'ninguna ', '', 'depresión ', 'si, por crisis emocional ', 'no ', 'no ', 'tienda libre ', '44148a881cb0a1206b9e61256a4c09c53c87746b', 'No', NULL),
(14, 'Juan Hector ', 'Pulido ', 'Huanosto', '1975-05-10', 'Masculino', 49, 'Francisco Javier Mina', '', 'mexicano ', 'Soltero(a)', 'Preparatoria', '', '', '', '', '', '2023-09-21', '10:31', 'No', 'Involuntario', 'perforación en lengua y en los oidos, tatuaje en la cabeza, un golpe en la mejilla izquierda', 'pantalón, playera y tenis negros ', 'ninguno ', '', 'No', 1, 'Marco Julio Polido Huanoston ', 'n/p', '', 'hermano ', '', 'INE 16001311724415', '', '+52 917 66 73 487', 'cristal y cocaina', '8 años ', 'ninguna ', 'no ', 'sí ', 'no ', '', '03296f51d33d81e47d89c1d9edea23d917554899', 'No', 1931),
(15, 'José ', 'Magaña', 'Arzeta', '1978-08-09', 'Masculino', 46, 'venustiano carranza s/n ', '7535360160', 'Mexicano ', 'Soltero(a)', 'Preparatoria', 'Campesino', '4', '', 'No', '', '2023-11-20', '15:17', 'No', 'Involuntario', '', 'Short gris camisa azul, cinto azul amarilllo rojo chanclas ', '', '', 'No', 1, 'Martha arzeta de los santos', '', 'Hogar', 'Madre', 'Venustiano carranza s/n lazaro cardenas', 'INE 0865150268547', '', '+527535360160', 'alcohol, marihuana', 'Alcohol 35 años, marihuana 5 años', 'esquisofrenia tx, bipolar', '', '', 'si', '', '9799119d7b482740d22a31582f73d2c263d69e3c', 'No', 16033),
(16, 'TEST', 'TEST', 'TEST', '1995-03-09', 'Masculino', 29, 'test', '54564564564', 'mexicano', 'Soltero(a)', 'Primaria', '', '', '', '', '', '2024-08-13', '12:09', 'No', '', '', '', '', '', 'No', 1, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '8ba3b6a2d8e3d97d0780eb99eadf91f28e77f59a', 'No', 3334);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos_empleado`
--

CREATE TABLE `pagos_empleado` (
  `id_pagos_empleado` int(11) NOT NULL,
  `monto` float NOT NULL,
  `motivo` text NOT NULL,
  `tipo_operacion` text NOT NULL,
  `fecha` date NOT NULL,
  `estatus` text NOT NULL,
  `id_empleado` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `pagos_empleado`
--

INSERT INTO `pagos_empleado` (`id_pagos_empleado`, `monto`, `motivo`, `tipo_operacion`, `fecha`, `estatus`, `id_empleado`) VALUES
(1, 500, 'Por buena onda', 'Bono', '2024-08-17', 'pagado', 4),
(2, 100, 'bono', 'Bono', '2024-08-20', 'pagado', 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pago_paciente`
--

CREATE TABLE `pago_paciente` (
  `id_pago` int(11) NOT NULL,
  `monto` float NOT NULL,
  `descuento` float NOT NULL,
  `total` float NOT NULL,
  `comprobante` text NOT NULL,
  `numero_pago` int(11) NOT NULL,
  `fecha_agregado` date NOT NULL,
  `fecha_pagado` date NOT NULL,
  `periodicidad` text NOT NULL,
  `observaciones` text NOT NULL,
  `nota` text NOT NULL,
  `forma_pago` text NOT NULL,
  `estatus` text NOT NULL,
  `archivado` text DEFAULT NULL,
  `id_paciente` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `pago_paciente`
--

INSERT INTO `pago_paciente` (`id_pago`, `monto`, `descuento`, `total`, `comprobante`, `numero_pago`, `fecha_agregado`, `fecha_pagado`, `periodicidad`, `observaciones`, `nota`, `forma_pago`, `estatus`, `archivado`, `id_paciente`, `id_usuario`) VALUES
(1, 23333, 0, 0, '', 1, '2024-07-25', '0000-00-00', '', 'Tratamiento', '', '', 'No Pagado', 'no', 2, 0),
(2, 23333, 0, 0, '', 2, '2024-08-25', '0000-00-00', '', 'Tratamiento', '', '', 'No Pagado', 'no', 2, 0),
(3, 5000, 0, 5000, '', 0, '2024-07-10', '0000-00-00', '', 'donación de ingreso', '', 'Efectivo', 'Pagado', 'si', 2, 9),
(4, 5000, 0, 0, '', 0, '2024-07-10', '2024-06-25', '', 'traslado ', '', 'Transferencia', 'No Pagado', 'si', 2, 9),
(5, 23333, 0, 0, '', 1, '2024-09-25', '0000-00-00', '', 'Tratamiento', '', '', 'No Pagado', 'no', 2, 0),
(69, 16666, 0, 16666, '', 1, '2024-01-31', '2024-01-31', '', 'Tratamiento', '', 'Saldo', 'Pagado', 'no', 3, 1),
(70, 16666, 0, 16666, '', 2, '2024-03-02', '2024-03-02', '', 'Tratamiento', '', 'Saldo', 'Pagado', 'no', 3, 1),
(71, 16666, 0, 16666, '', 3, '2024-04-02', '2024-04-02', '', 'Tratamiento', '', 'Saldo', 'Pagado', 'no', 3, 1),
(9, 26667, 0, 27000, '', 1, '2024-06-15', '2024-06-15', '', 'Tratamiento', '', 'Efectivo', 'Pagado', 'si', 4, 9),
(10, 26667, 0, 0, '', 2, '2024-07-15', '0000-00-00', '', 'Tratamiento', '', '', 'No Pagado', 'no', 4, 0),
(11, 26667, 0, 0, '', 3, '2024-08-15', '0000-00-00', '', 'Tratamiento', '', '', 'No Pagado', 'no', 4, 0),
(12, 26666, 0, 26666, '', 0, '2024-07-11', '2024-06-15', '', 'tratamiento', 'primer pago ', 'Efectivo', 'No Pagado', 'si', 4, 9),
(13, 26666, 0, 26666, '', 1, '2024-06-15', '2024-06-15', '', 'Tratamiento', 'primer pago ', 'Saldo', 'Pagado', 'no', 4, 9),
(14, 28500, 0, 28500, '', 1, '2024-07-11', '2024-07-11', '', 'Tratamiento', 'primer pago de tratamiento ', 'Efectivo', 'Pagado', 'no', 5, 9),
(15, 28500, 0, 0, '', 2, '2024-08-11', '0000-00-00', '', 'Tratamiento', '', '', 'No Pagado', 'no', 5, 0),
(16, 1200, 0, 1200, 'WhatsApp Image 2024-07-19 at 4.09.32 PM.jpeg', 0, '2024-07-19', '2024-07-11', '', 'tiendita inicio ', '', 'Efectivo', 'Pagado', 'no', 5, 9),
(17, 19950, 0, 0, '', 0, '2024-07-19', '2024-09-11', '', 'tratamiento ', '', 'Efectivo', 'No Pagado', 'si', 5, 9),
(18, 19950, 0, 0, '', 1, '2024-09-11', '0000-00-00', '', 'Tratamiento', '', '', 'No Pagado', 'no', 5, 0),
(19, 25650, 0, 0, '', 1, '2024-07-12', '0000-00-00', '', 'Tratamiento', '', '', 'No Pagado', 'no', 7, 0),
(20, 25650, 0, 0, '', 2, '2024-08-12', '0000-00-00', '', 'Tratamiento', '', '', 'No Pagado', 'no', 7, 0),
(21, 25650, 0, 0, '', 3, '2024-09-12', '0000-00-00', '', 'Tratamiento', '', '', 'No Pagado', 'no', 7, 0),
(22, 10000, 0, 0, '', 0, '2024-07-19', '2024-09-15', '', 'cuarto pago ', '', 'Efectivo', 'No Pagado', 'no', 7, 9),
(23, 23334, 0, 0, '', 1, '2024-08-16', '0000-00-00', '', 'Tratamiento', '', '', 'No Pagado', 'no', 8, 0),
(24, 23334, 0, 0, '', 2, '2024-09-16', '0000-00-00', '', 'Tratamiento', '', '', 'No Pagado', 'no', 8, 0),
(25, 23334, 0, 0, '', 3, '2024-10-16', '0000-00-00', '', 'Tratamiento', '', '', 'No Pagado', 'no', 8, 0),
(26, 5000, 0, 5000, '', 0, '2024-07-23', '2024-07-16', '', 'donación primer pago ', '', 'Efectivo', 'Pagado', 'no', 8, 9),
(27, 19000, 0, 0, '', 1, '2024-08-18', '0000-00-00', '', 'Tratamiento', '', '', 'No Pagado', 'no', 9, 0),
(28, 19000, 0, 0, '', 2, '2024-09-18', '0000-00-00', '', 'Tratamiento', '', '', 'No Pagado', 'no', 9, 0),
(29, 19000, 0, 0, '', 3, '2024-10-18', '0000-00-00', '', 'Tratamiento', '', '', 'No Pagado', 'no', 9, 0),
(30, 19000, 0, 0, '', 1, '2024-08-18', '0000-00-00', '', 'Tratamiento', '', '', 'No Pagado', 'si', 9, 0),
(31, 19000, 0, 0, '', 2, '2024-09-18', '0000-00-00', '', 'Tratamiento', '', '', 'No Pagado', 'si', 9, 0),
(32, 19000, 0, 0, '', 3, '2024-10-18', '0000-00-00', '', 'Tratamiento', '', '', 'No Pagado', 'si', 9, 0),
(33, 18000, 0, 18000, '', 0, '2024-07-23', '2024-07-18', '', 'donación de ingreso primer pago ', '', 'Efectivo', 'Pagado', 'no', 9, 9),
(34, 25650, 0, 0, '', 1, '2024-08-11', '0000-00-00', '', 'Tratamiento', '', '', 'No Pagado', 'no', 10, 0),
(35, 25650, 0, 0, '', 2, '2024-09-11', '0000-00-00', '', 'Tratamiento', '', '', 'No Pagado', 'no', 10, 0),
(36, 25650, 0, 0, '', 3, '2024-10-11', '0000-00-00', '', 'Tratamiento', '', '', 'No Pagado', 'no', 10, 0),
(37, 20000, 0, 0, '', 1, '2024-08-17', '0000-00-00', '', 'Tratamiento', '', '', 'No Pagado', 'no', 11, 0),
(38, 20000, 0, 0, '', 2, '2024-09-17', '0000-00-00', '', 'Tratamiento', '', '', 'No Pagado', 'no', 11, 0),
(39, 20000, 0, 0, '', 3, '2024-10-17', '0000-00-00', '', 'Tratamiento', '', '', 'No Pagado', 'no', 11, 0),
(40, 23334, 0, 0, '', 1, '2024-08-13', '0000-00-00', '', 'Tratamiento', '', '', 'No Pagado', 'no', 12, 0),
(41, 23334, 0, 0, '', 2, '2024-09-13', '0000-00-00', '', 'Tratamiento', '', '', 'No Pagado', 'no', 12, 0),
(42, 23334, 0, 0, '', 3, '2024-10-13', '0000-00-00', '', 'Tratamiento', '', '', 'No Pagado', 'no', 12, 0),
(43, 30000, 0, 0, '', 1, '2024-07-24', '0000-00-00', '', 'Tratamiento', '', '', 'No Pagado', 'no', 13, 0),
(44, 30000, 0, 30022, '', 1, '2023-10-15', '2023-10-13', '', 'Tratamiento', 'tratamiento', 'Transferencia Cuenta Dante', 'Pagado', 'no', 14, 1),
(45, 30000, 0, 30000, '', 2, '2023-11-15', '2024-08-05', '', 'Tratamiento', '11  transferencias', 'Saldo', 'Pagado', 'no', 14, 1),
(46, 30000, 0, 30000, '', 3, '2023-12-15', '2024-08-05', '', 'Tratamiento', 'tratamiento', 'Saldo', 'Pagado', 'no', 14, 1),
(47, 30000, 0, 0, '', 1, '2023-12-22', '0000-00-00', '', 'Tratamiento', '', '', 'No Pagado', 'no', 14, 0),
(48, 30000, 0, 0, '', 2, '2024-01-22', '0000-00-00', '', 'Tratamiento', '', '', 'No Pagado', 'no', 14, 0),
(49, 30000, 0, 0, '', 3, '2024-02-22', '0000-00-00', '', 'Tratamiento', '', '', 'No Pagado', 'no', 14, 0),
(50, 20, 0, 20, '', 0, '2024-08-05', '2024-08-05', '', 'Adeudo tiendita', '', '', 'No Pagado', 'no', 8, 1),
(51, 40, 0, 40, '', 0, '2024-08-05', '2024-08-05', '', 'Adeudo tiendita', '', 'Saldo', 'Pagado', 'no', 14, 1),
(52, 80, 0, 80, '', 0, '2024-08-05', '2024-08-05', '', 'Adeudo tiendita', '', 'Saldo', 'Pagado', 'no', 14, 1),
(53, 16666, 0, 16666, '', 1, '2023-12-01', '2024-08-10', '', 'Tratamiento', '', 'Saldo', 'Pagado', 'no', 15, 1),
(54, 16666, 0, 16666, '', 2, '2024-01-01', '2024-08-10', '', 'Tratamiento', '', 'Saldo', 'Pagado', 'no', 15, 1),
(55, 16666, 0, 16666, '', 3, '2024-02-01', '2024-02-01', '', 'Tratamiento', '', 'Saldo', 'Pagado', 'no', 15, 1),
(56, 16666, 0, 16666, '', 4, '2024-03-01', '2024-03-01', '', 'Tratamiento', '', 'Saldo', 'Pagado', 'no', 15, 1),
(57, 16666, 0, 0, '', 5, '2024-04-01', '0000-00-00', '', 'Tratamiento', '', '', 'No Pagado', 'no', 15, 0),
(58, 16666, 0, 0, '', 6, '2024-05-01', '0000-00-00', '', 'Tratamiento', '', '', 'No Pagado', 'no', 15, 0),
(59, 16667, 0, 0, '', 1, '2024-06-20', '0000-00-00', '', 'Tratamiento', '', '', 'No Pagado', 'no', 15, 0),
(60, 16667, 0, 0, '', 2, '2024-07-20', '0000-00-00', '', 'Tratamiento', '', '', 'No Pagado', 'no', 15, 0),
(61, 16667, 0, 0, '', 3, '2024-08-20', '0000-00-00', '', 'Tratamiento', '', '', 'No Pagado', 'no', 15, 0),
(62, 100, 0, 100, '', 0, '2024-08-10', '2024-08-10', '', 'Adeudo tiendita', '', 'Saldo', 'Pagado', 'no', 15, 1),
(63, 16666, 0, 16666, '', 1, '2024-08-13', '2024-08-22', '', 'Tratamiento', 'id paciente nuevo', 'Saldo', 'Pagado', 'no', 16, 1),
(64, 16666, 0, 0, '', 2, '2024-09-13', '0000-00-00', '', 'Tratamiento', '', '', 'No Pagado', 'no', 16, 0),
(65, 16666, 0, 0, '', 3, '2024-10-13', '0000-00-00', '', 'Tratamiento', '', '', 'No Pagado', 'no', 16, 0),
(66, 16666, 0, 0, '', 4, '2024-11-13', '0000-00-00', '', 'Tratamiento', '', '', 'No Pagado', 'no', 16, 0),
(67, 16666, 0, 0, '', 5, '2024-12-13', '0000-00-00', '', 'Tratamiento', '', '', 'No Pagado', 'no', 16, 0),
(68, 160, 0, 160, '', 0, '2024-08-13', '2024-08-13', '', 'Adeudo tiendita', '', '', 'No Pagado', 'no', 16, 1),
(72, 17000, 0, 17000, '', 1, '2024-05-15', '2024-05-15', '', 'Tratamiento', '', 'Saldo', 'Pagado', 'no', 3, 1),
(73, 17000, 0, 17000, '', 2, '2024-06-15', '2024-06-15', '', 'Tratamiento', '', 'Saldo', 'Pagado', 'no', 3, 1),
(74, 16000, 0, 16000, '', 1, '2024-07-15', '2024-08-16', '', 'Tratamiento', '', 'Saldo', 'Pagado', 'no', 3, 1),
(75, 80, 0, 80, '', 0, '2024-08-16', '2024-08-16', '', 'Adeudo tiendita', '', 'Saldo', 'Pagado', 'no', 3, 1),
(79, 200, 0, 200, '', 0, '2024-09-10', '2024-09-10', '', 'consultas externas', 'consulta externa', 'Efectivo', 'Pagado', 'no', 16, 1),
(77, 1200, 0, 1200, '', 0, '2024-09-07', '2024-09-07', '', 'medicamento', 'Seroquel', '', 'No Pagado', 'no', 16, 1),
(78, 1500, 0, 1500, '', 0, '2024-09-07', '2024-09-07', '', 'medicamento', 'Aspirina', '', 'No Pagado', 'no', 16, 1),
(80, 1200, 0, 1200, '', 0, '2024-09-11', '2024-09-11', '', 'medicamento', 'Seroquel', '', 'No Pagado', 'no', 16, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `peticion_paciente`
--

CREATE TABLE `peticion_paciente` (
  `id_peticion` int(11) NOT NULL,
  `detalle` text NOT NULL,
  `quien_procesa` text NOT NULL,
  `monto` int(11) DEFAULT NULL,
  `estatus` text NOT NULL,
  `id_paciente` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id_producto` int(11) NOT NULL,
  `precio_venta` float NOT NULL,
  `stock` int(11) NOT NULL,
  `titulo` text NOT NULL,
  `descripcion` text NOT NULL,
  `codigo` text NOT NULL,
  `precio_compra` float NOT NULL,
  `imagen` text NOT NULL,
  `tipo_producto` text NOT NULL,
  `estatus` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_producto`, `precio_venta`, `stock`, `titulo`, `descripcion`, `codigo`, `precio_compra`, `imagen`, `tipo_producto`, `estatus`) VALUES
(1, 20, 20, 'Coca cola 600 ML', 'Coca cola 600 ML', '123', 18, 'BYJ39.png', 'tiendita', 1),
(2, 0, 7, 'Seroquel', 'Seroquel', '55', 1200, 'image_1024.png', 'medicina', 1),
(3, 18, 2, 'coca cola sin azucar', '\r\ncoca sin azucar', '7501055320639', 16, 'mgm_700x700.png', 'tiendita', 1),
(4, 0, 1, 'Aspirina', 'Aspirina', '7501055320639', 1500, '48849873207326.jpg', 'medicina', 1),
(6, 50, 10, 'Sujeta documentos', 'sujeta', '7502212170074', 50, '100018380.jpeg', 'tiendita', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitudes`
--

CREATE TABLE `solicitudes` (
  `id_solicitud` int(11) NOT NULL,
  `descripcion` text NOT NULL,
  `fecha` date NOT NULL,
  `archivado` text NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `solicitudes`
--

INSERT INTO `solicitudes` (`id_solicitud`, `descripcion`, `fecha`, `archivado`, `id_usuario`) VALUES
(1, 'jitomate', '2024-08-23', 'no', 1),
(3, 'despensa de la semana ', '2024-09-07', 'no', 1),
(4, 'xdddddssss', '2024-09-11', 'no', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `traslado_paciente`
--

CREATE TABLE `traslado_paciente` (
  `id_traslado` int(11) NOT NULL,
  `nombreEncargado` text NOT NULL,
  `personasApoyo` text NOT NULL,
  `municipioPaciente` text NOT NULL,
  `marcaVehiculo` text NOT NULL,
  `tipoVehiculo` text NOT NULL,
  `modeloVehiculo` text NOT NULL,
  `placasVehiculo` text NOT NULL,
  `direccionTraslado` text NOT NULL,
  `costoTraslado` float NOT NULL,
  `costoTrasladoTexto` text NOT NULL,
  `id_paciente` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `traslado_paciente`
--

INSERT INTO `traslado_paciente` (`id_traslado`, `nombreEncargado`, `personasApoyo`, `municipioPaciente`, `marcaVehiculo`, `tipoVehiculo`, `modeloVehiculo`, `placasVehiculo`, `direccionTraslado`, `costoTraslado`, `costoTrasladoTexto`, `id_paciente`) VALUES
(1, 'VICTOR PICHO RUIZ', 'Daniela Resendiz, Fernanda, Carlos Meza, Juan Héctor', 'Nocupetaro', 'X-trail', 'camioneta', '2020', 'hax468f', 'Nocupetaro Mich.', 5000, '0', 2),
(2, 'n/p', '', '', '', '', '', '', '', 0, '0', 3),
(3, 'LLegó a la institución con su familia ', 'n/a', 'n/a', 'n/a', 'n/a', 'n/a', 'n/a', 'n/a', 0, '0', 5),
(4, 'Victor Picho Ruiz ', 'n/p', 'Ario de Rosales ', 'n/a', 'n/a', 'n/a', 'n/a', '12 de octubre 852, col Morelos, Ario de Rosales Michoacán', 3000, '0', 7),
(5, '', '', '', '', '', '', '', '', 0, '0', 8),
(6, '', '', '', '', '', '', '', '', 0, '0', 9),
(7, '', '', '', '', '', '', '', '', 0, '0', 10),
(8, 'Victor Picho Ruiz ', 'Juan Hector Pulido, Francisco Díaz, Fernando Cisneros.', 'Nayarit ', 'mazda sedan 2018 ', 'sedan ', '2018', 'phv694b', 'Calle onorato rico 33, Nayarit', 6000, '0', 11),
(9, 'Victor Picho Ruiz ', 'Daniela Ruiz, Juan Héctor Pulido y Armando Francisco Diaz ', 'Naranja de Chila ', 'mazda sedan 2018 ', 'sedan ', '2018', 'phv694b', 'colonia lázaro cárdenas, naranjo de chila Michoacán', 6000, '0', 12),
(10, '', '', '', '', '', '', '', '', 0, '0', 13),
(11, '', '', '', '', '', '', '', '', 0, '0', 14),
(12, 'Edwin Sagrero', 'Hector Ricardo Galván Rosales, Victor Alfonso Rosas, Diego Mata', '', 'Mazda', 'Sedan', 'Mazda', '', '', 5000, '0', 15),
(13, '', '', '', '', '', '', '', '', 0, '0', 16);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre_usuario` varchar(50) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `nombre` text NOT NULL,
  `aPaterno` text NOT NULL,
  `aMaterno` text NOT NULL,
  `telefono` text NOT NULL,
  `fecha_ingreso` date NOT NULL,
  `rol` text NOT NULL,
  `archivado` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre_usuario`, `contrasena`, `nombre`, `aPaterno`, `aMaterno`, `telefono`, `fecha_ingreso`, `rol`, `archivado`) VALUES
(1, 'administrador', '$2y$10$DYdKi1ONNgRrrOw.EM.IYen3B7R94xJLu5SB40WvqJgmZuHtmkxGe', 'Administrador', 'Administrador', 'Administrador', '4433627876', '2024-06-26', 'SuperAdministrador', 'no'),
(2, 'Briseyda', '$2y$10$D0Fg5jopE1/sguopF2glfe936dpUHvbidO0xsv.xbBu227YKwDy2.', 'Briseyda', 'Briseyda', 'Briseyda', '54564564564', '2024-06-26', 'Recepcion', 'no'),
(3, 'Benjamin', '$2y$10$j31I27vRr0HEzW7qjQvV6.29tdvALI27nyvknHh/rCAkqIUVVAasu', 'Benjamin', 'Benjamin', 'Benjamin', '54564564564', '2024-06-26', 'Cocina', 'no'),
(4, 'Aron', '$2y$10$EN3Qtw197Xzqh9OHVC7dBOyKp/S68aE2HC5vFFDDZWt7tUuu6.mVu', 'Aron', 'Aron', 'Aron', '54564564564', '2024-06-26', 'Padrino', 'no'),
(5, 'Susana', '$2y$10$QA1EFEtOqZqaJ.rqdvl7sOOtmt5YjfOJxNFeI2.eU/nLBqaVbxxUG', 'Susana', 'Susana', 'Susana', '54564564564', '2024-06-26', 'Psicologo', 'no'),
(6, 'Karla', '$2y$10$5QAZ2Xfkk2ipkNHJrbw0Zen2X2EOgkN/cUWjeJtR8Moq0/SSgRSXS', 'Karla', 'Karla', 'Karla', '54564564564', '2024-06-26', 'Psicologo', 'no'),
(7, 'Marina', '$2y$10$qLNZzUQo9y9DrD6VZx2kz.whpHFvMbol.U/lIOjWY7wbPz9y304pu', 'Marina', 'Marina', 'Marina', '54564564564', '2024-06-26', 'Psicologo', 'no'),
(8, 'Isac', '$2y$10$7/y6p.K1d4KFTkJ7u2anYukHByt6ioO.sAbzXarmmYWKfE1yCeoQ.', 'Isac', 'Isac', 'Isac', '54564564564', '2024-06-26', 'Psicologo', 'no'),
(9, 'Lenin', '$2y$10$87DARpVAOncu50ewchBCZexT6kFdUpCNdv486bzR7Ibw6lH.WPJ/a', 'Lenin', 'Lenin', 'Lenin', '54564564564', '2024-06-26', 'SuperAdministrador', 'no'),
(10, 'Daniel', '$2y$10$bK42ooK8jGkdGA20arBRdOY.hAtN9LbSIIzYXtyYUQwCNM4efFkAu', 'Daniel', 'Daniel', 'Daniel', '54564564564', '2024-06-26', 'SuperAdministrador', 'no'),
(11, 'Victor', '$2y$10$Yp/kRiHIrukRdRm8jtwqLu5f0FZghhH5TLf4lnmU4BAEgDhXAQ26e', 'Victor', 'Victor', 'Victor', '54564564564', '2024-06-26', 'Vendedor', 'no');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `agenda`
--
ALTER TABLE `agenda`
  ADD PRIMARY KEY (`id_agenda`);

--
-- Indices de la tabla `comisiones`
--
ALTER TABLE `comisiones`
  ADD PRIMARY KEY (`id_comision`);

--
-- Indices de la tabla `compras`
--
ALTER TABLE `compras`
  ADD PRIMARY KEY (`id_compra`);

--
-- Indices de la tabla `consumo`
--
ALTER TABLE `consumo`
  ADD PRIMARY KEY (`id_consumo`);

--
-- Indices de la tabla `contactos`
--
ALTER TABLE `contactos`
  ADD PRIMARY KEY (`id_contacto`);

--
-- Indices de la tabla `credito`
--
ALTER TABLE `credito`
  ADD PRIMARY KEY (`id_credito`);

--
-- Indices de la tabla `detalles_orden`
--
ALTER TABLE `detalles_orden`
  ADD PRIMARY KEY (`id_detalle`),
  ADD KEY `id_orden` (`id_orden`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `detalle_solicitudes`
--
ALTER TABLE `detalle_solicitudes`
  ADD PRIMARY KEY (`id_detalle_solicitud`),
  ADD KEY `id_solicitud` (`id_solicitud`);

--
-- Indices de la tabla `docs_empleado`
--
ALTER TABLE `docs_empleado`
  ADD PRIMARY KEY (`id_docs`),
  ADD KEY `id_empleado` (`id_empleado`);

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`id_empleado`);

--
-- Indices de la tabla `evolucion`
--
ALTER TABLE `evolucion`
  ADD PRIMARY KEY (`id_evolucion`);

--
-- Indices de la tabla `historial_saldo`
--
ALTER TABLE `historial_saldo`
  ADD PRIMARY KEY (`id_historial`),
  ADD KEY `id_paciente` (`id_paciente`);

--
-- Indices de la tabla `historia_clinica`
--
ALTER TABLE `historia_clinica`
  ADD PRIMARY KEY (`id_historia`),
  ADD UNIQUE KEY `unique_paciente_fecha` (`id_paciente`,`fecha_consulta`);

--
-- Indices de la tabla `hojas_egreso`
--
ALTER TABLE `hojas_egreso`
  ADD PRIMARY KEY (`id_egreso`),
  ADD KEY `id_paciente` (`id_paciente`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `notas_consejeria`
--
ALTER TABLE `notas_consejeria`
  ADD PRIMARY KEY (`id_consejeria`);

--
-- Indices de la tabla `notas_psicologicas`
--
ALTER TABLE `notas_psicologicas`
  ADD PRIMARY KEY (`id_nota`),
  ADD KEY `id_paciente` (`id_paciente`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `ordenes`
--
ALTER TABLE `ordenes`
  ADD PRIMARY KEY (`id_orden`),
  ADD KEY `id_paciente` (`id_paciente`);

--
-- Indices de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  ADD PRIMARY KEY (`id_paciente`);

--
-- Indices de la tabla `pagos_empleado`
--
ALTER TABLE `pagos_empleado`
  ADD PRIMARY KEY (`id_pagos_empleado`);

--
-- Indices de la tabla `pago_paciente`
--
ALTER TABLE `pago_paciente`
  ADD PRIMARY KEY (`id_pago`);

--
-- Indices de la tabla `peticion_paciente`
--
ALTER TABLE `peticion_paciente`
  ADD PRIMARY KEY (`id_peticion`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`);

--
-- Indices de la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
  ADD PRIMARY KEY (`id_solicitud`);

--
-- Indices de la tabla `traslado_paciente`
--
ALTER TABLE `traslado_paciente`
  ADD PRIMARY KEY (`id_traslado`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `agenda`
--
ALTER TABLE `agenda`
  MODIFY `id_agenda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `comisiones`
--
ALTER TABLE `comisiones`
  MODIFY `id_comision` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `compras`
--
ALTER TABLE `compras`
  MODIFY `id_compra` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `consumo`
--
ALTER TABLE `consumo`
  MODIFY `id_consumo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `contactos`
--
ALTER TABLE `contactos`
  MODIFY `id_contacto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `credito`
--
ALTER TABLE `credito`
  MODIFY `id_credito` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=163;

--
-- AUTO_INCREMENT de la tabla `detalles_orden`
--
ALTER TABLE `detalles_orden`
  MODIFY `id_detalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `detalle_solicitudes`
--
ALTER TABLE `detalle_solicitudes`
  MODIFY `id_detalle_solicitud` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `docs_empleado`
--
ALTER TABLE `docs_empleado`
  MODIFY `id_docs` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `id_empleado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `evolucion`
--
ALTER TABLE `evolucion`
  MODIFY `id_evolucion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `historial_saldo`
--
ALTER TABLE `historial_saldo`
  MODIFY `id_historial` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `historia_clinica`
--
ALTER TABLE `historia_clinica`
  MODIFY `id_historia` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `hojas_egreso`
--
ALTER TABLE `hojas_egreso`
  MODIFY `id_egreso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `notas_consejeria`
--
ALTER TABLE `notas_consejeria`
  MODIFY `id_consejeria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `notas_psicologicas`
--
ALTER TABLE `notas_psicologicas`
  MODIFY `id_nota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `ordenes`
--
ALTER TABLE `ordenes`
  MODIFY `id_orden` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  MODIFY `id_paciente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `pagos_empleado`
--
ALTER TABLE `pagos_empleado`
  MODIFY `id_pagos_empleado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `pago_paciente`
--
ALTER TABLE `pago_paciente`
  MODIFY `id_pago` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT de la tabla `peticion_paciente`
--
ALTER TABLE `peticion_paciente`
  MODIFY `id_peticion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
  MODIFY `id_solicitud` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `traslado_paciente`
--
ALTER TABLE `traslado_paciente`
  MODIFY `id_traslado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
