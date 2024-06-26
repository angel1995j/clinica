-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 26-06-2024 a las 09:46:54
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
(1, '2024-02-16 13:00:00', '56', 3, 10),
(2, '2024-02-16 13:00:00', '56', 3, 14),
(3, '2024-02-16 14:00:00', '56', 3, 11),
(4, '2024-03-26 12:00:00', 'SESION 2- TERAPIA DE PAREJA', 4, 20),
(5, '2024-03-29 12:15:00', 'SESIÓN #3 - AUTOESTIMA', 4, 20),
(6, '2024-04-05 12:00:00', 'SESIÓN #3 - AUTOESTIMA', 1, 20),
(7, '2024-04-09 10:00:00', 'COMUNICACION ASERTIVA', 11, 32),
(8, '2024-04-10 11:00:00', 'PENSAMIENTO CRITICO', 12, 37),
(9, '2024-04-11 11:00:00', 'PENSAMIENTO CRITICO', 14, 32),
(10, '2024-04-17 13:30:00', 'Aplicación entrevista ', 20, 26),
(11, '2024-04-20 11:30:00', 'Entrevista conductual', 19, 26),
(12, '2024-04-20 13:30:00', 'Entrevista conductual', 18, 26),
(13, '2024-04-18 12:10:00', 'Escalas', 17, 26),
(14, '2024-04-21 08:10:00', 'Escalas', 12, 26),
(15, '2024-04-16 13:00:00', 'Px con un alto nivel de depresión por lo que tiene revaloración con psiquiatra externo.', 14, 25),
(16, '2024-04-22 13:00:00', 'Revisar establecimiento de metas de tx.', 14, 25),
(17, '2024-04-23 12:30:00', 'Trabajar conciencia de enfermedad.', 13, 25),
(18, '2024-04-17 11:30:00', 'Px con diversos padecimientos neurológicos y psiquiátricos, por lo que se encuentra en constante revisión por diversos especialistas.', 11, 25),
(19, '2024-04-23 11:00:00', 'Px con una alto grado de síntomas neurológicos, tales como acatisia grave e insomnio que no cede con el tx farmacológico que se le ha suministrado.', 11, 25),
(20, '2024-04-26 13:00:00', 'Actualmente se está trabajando la conciencia de enfermedad a través de la generación de disonancia cognitiva acerca del consumo, utilizado herramientas como el balance decisional.', 4, 25),
(21, '2024-06-15 11:30:00', 'nh', 6, 38),
(22, '2024-06-15 14:25:00', 'ccc', 8, 38);

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

--
-- Volcado de datos para la tabla `comisiones`
--

INSERT INTO `comisiones` (`id_comision`, `concepto`, `total_venta`, `porcentaje`, `estatus`, `archivado`, `fecha_venta`, `fecha_pagado`, `id_usuario`) VALUES
(1, 'pago de contacto', 245, 34, 'No Pagado', 'no', '2024-02-16', '0000-00-00', 15),
(2, 'honorarios', 10000, 10, 'No Pagado', 'no', '2024-06-14', '0000-00-00', 27);

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

--
-- Volcado de datos para la tabla `compras`
--

INSERT INTO `compras` (`id_compra`, `concepto`, `quien_compra`, `cuenta_compra`, `tipo_compra`, `monto`, `fecha_aplicacion`, `comprobante`, `estatus`, `archivado`, `id_usuario`) VALUES
(1, 'SUPERLIM', 'DANIEL CUENTA LENIN', '', '', 2500.00, '2024-04-25', 'WhatsApp Image 2024-04-25 at 11.38.05 AM.jpeg', 'Pagada', 'no', 22),
(3, 'Despensa', 'Cocina', 'Cuenta Lenin', 'Despensa', 500.00, '2024-06-12', '', 'Pagada', 'no', 1),
(4, 'Compra de medicamento', 'Medico', 'Cuenta Lenin', 'Medicamento general', 1165.65, '2024-06-14', '', 'Pagada', 'no', 1),
(5, 'recepcion', 'recepcion', 'Cuenta Lenin', 'Despensa', 500.00, '2024-06-22', '', 'Pagada', 'no', 41);

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
(1, 'queteapina', 0, '2024-05-23', '', 1, 22),
(2, 'medicina', 70, '2024-06-14', '', 6, 1),
(3, 'medicina de prueba', 70, '2024-06-25', '', 1, 1),
(4, '2070', 2, '2024-06-25', '', 6, 1),
(5, '2070 es el monto', 2, '2024-06-25', '', 6, 1),
(6, 'angel 1070', 1070, '2024-06-25', 'queteapina 300 mg, queteapina', 6, 1),
(7, 'es para el 8', 1000, '2024-06-25', 'queteapina 300 mg', 1, 1),
(8, 'es de 1000 para el paciente 8', 1000, '2024-06-25', 'queteapina 300 mg', 8, 1),
(9, 'ggg', 70, '2024-06-25', 'queteapina', 1, 41),
(10, 'colegiatura', 0, '2024-06-25', '', 1, 41),
(11, 'sdd', 0, '2024-06-25', '', 1, 41),
(12, 'dddd', 70, '2024-06-25', 'queteapina', 1, 41),
(13, 'dddd', 70, '2024-06-25', 'queteapina', 1, 41),
(14, 'dddd', 70, '2024-06-25', 'queteapina', 1, 41),
(15, 'extras 2', 70, '2024-06-25', 'queteapina', 24, 1);

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
  `estado` text NOT NULL,
  `observaciones` text NOT NULL,
  `fecha_ingreso` date NOT NULL,
  `intensidad` text NOT NULL,
  `archivado` text NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `contactos`
--

INSERT INTO `contactos` (`id_contacto`, `nombre`, `aPaterno`, `aMaterno`, `telefono`, `estado`, `observaciones`, `fecha_ingreso`, `intensidad`, `archivado`, `id_usuario`) VALUES
(1, 'VALENTIN ', 'ALVARADO', 'NIETO', '4433283529', 'Cerrado', '', '2024-02-11', 'Frio', 'no', 15),
(2, 'DRA GUADALUPE', 'BECERRA', 'PINEDA', '4432191895', 'En Proceso', 'HERMANO PEDRO BECERRA PINEDA \r\n57 AÑOS \r\nALCOHOL\r\n3 REHABILITACIONES DE 3 MESES CADA UNO \r\nDESNUTRICIÓN, SOLEOSIS \r\nESPOSA DE ACUERDO', '2024-03-23', 'Frio', 'no', 27),
(3, 'Viridiana ', 'Lara', '.', '4361260646', 'En espera', 'sobrino Marco Lara posible Cristal', '2024-03-01', 'Frio', 'no', 28),
(4, 'Uriel', 'Garcia', '.', '7531360483', 'En espera', 'El mismo, alcohol  18 años, 45 dias $11.500', '2024-03-02', 'Frio', 'no', 28),
(5, 'Nataly', '.', '.', '4431885766', 'En espera', 'drogas 18 años para el hijo ', '2024-03-01', 'Frio', 'no', 28),
(6, 'Luis ', 'Romero', '.', '4777933384', 'En espera', 'para el hijo, drogas.', '2024-03-02', 'Frio', 'no', 28),
(7, 'Marisol', '.', '.', '3521008216', 'En espera', '', '2024-03-04', 'Frio', 'no', 28),
(8, 'Abigail', 'Umecuaro', '.', '4432228028', 'En espera', '27 años, cristal, traslado.', '2024-03-03', 'Tibio', 'no', 28),
(9, 'Maria Elena', 'Nuñez', '.', 'usa', 'En espera', 'hijo, droga y juegos, 24 al mes , traslado.', '2024-03-03', 'Tibio', 'no', 28),
(10, 'Marco ', 'Antonio', '.', '4361269479', 'En espera', 'cuñado, Rigoberto, Cristal.', '2024-03-03', 'Tibio', 'no', 28),
(11, 'Victoria', 'Marmolejo', '.', '4438657899', 'Ingresado', 'Esposo Gerardo 58 años', '2024-03-07', 'Caliente', 'no', 28),
(12, 'Paola', '.', '.', '4773289108', 'En espera', 'Hermano alcohol', '2024-03-02', 'Frio', 'no', 28),
(13, 'Madian ', 'Jimenez', '.', '7321036747', 'En espera', 'Zihuatanejo hermana ', '2024-03-05', 'Frio', 'no', 28),
(14, 'Lucia ', 'Perez', '.', '001704930', 'En espera', 'Cruz Gerardo 30-32 años drogas', '2024-03-06', 'Frio', 'no', 28),
(15, 'Adriana ', 'Gonzales', '.', '3545464433', 'En espera', 'Frida Sofia 14 años Drogas los Reyes', '2024-03-06', 'Caliente', 'no', 28),
(16, 'Dolores ', 'Moran', '.', '4361269479', 'En espera', 'Gerardo Moran 47-47 años cristal', '2024-03-08', 'Caliente', 'no', 28),
(17, 'Uriel ', 'Colin', '.', '5579973123', 'En espera', 'Gerardo ,el oro ', '2024-03-08', 'Frio', 'no', 28);

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
(1, -99, '2024-02-12', NULL, 'Compra', 'Tarjeta', 0, 2),
(2, -199, '2024-02-12', NULL, 'Ajuste de saldo', 'Efectivo', 0, 2),
(3, 1, '2024-02-12', NULL, 'Saldo a favor', 'Efectivo', 0, 2),
(4, -99, '2024-02-12', NULL, 'Ajuste de saldo', 'Efectivo', 0, 2),
(5, 1, '2024-02-12', NULL, 'Saldo a favor', 'Efectivo', 0, 2),
(6, 500, '2024-02-16', NULL, 'Saldo a favor', 'Efectivo', 0, 3),
(7, 387, '2024-02-15', NULL, 'Compra', 'Tarjeta', 0, 3),
(8, 200, '2024-02-26', NULL, 'Saldo a favor', 'Efectivo', 0, 6),
(9, 500, '2024-04-25', NULL, 'Saldo a favor', 'Otro', 0, 21),
(10, -200, '2024-04-25', NULL, 'Compra', 'Tarjeta', 0, 21),
(83, -5, '2024-06-20', '2024-06-27', 'Generación de límite de crédito', '', 1, 8),
(84, 500, '2024-06-20', '2024-07-04', 'Generación de límite de crédito', '', 2, 8),
(85, 500, '2024-06-20', '2024-07-11', 'Generación de límite de crédito', '', 3, 8),
(86, 500, '2024-06-20', '2024-07-18', 'Generación de límite de crédito', '', 4, 8),
(80, 2000, '2024-06-20', '2024-06-20', 'Ajuste automático de saldos', '', 0, 8),
(40, 250, '2024-05-07', '2024-05-14', 'Generación de límite de crédito', 'Depósito cuenta Lenin', 1, 21),
(41, 250, '2024-05-07', '2024-05-21', 'Generación de límite de crédito', 'Depósito cuenta Lenin', 2, 21),
(42, 300, '2024-05-08', '2024-05-08', 'Ajuste automático de saldos', 'Depósito cuenta Lenin', 0, 21),
(43, -45, '2024-05-23', NULL, 'Compra', 'Tarjeta', 0, 22),
(44, -72, '2024-05-28', NULL, 'Compra', 'Tarjeta', 0, 23),
(45, -427, '2024-05-28', NULL, 'Compra', 'Tarjeta', 0, 23),
(47, 2000, '2024-06-07', '2024-07-07', 'Generación de límite de crédito', 'Depósito cuenta Lenin', 1, 24),
(48, 1961, '2024-06-07', NULL, 'Compra', 'Tarjeta', 0, 24),
(87, 2000, '2024-06-20', '2024-06-20', 'Ajuste automático de saldos', '', 0, 8),
(82, 601, '2024-06-20', '2024-06-20', 'Ajuste automático de saldos', '', 0, 8),
(88, 1983, '2024-06-21', NULL, 'Compra', 'Saldo', 0, 8);

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
(1, 1, 1, 3, 23.00, 69.00),
(2, 1, 2, 1, 30.00, 30.00),
(3, 2, 1, 1, 23.00, 23.00),
(4, 2, 2, 3, 30.00, 90.00),
(5, 3, 2, 1, 30.00, 30.00),
(6, 3, 3, 1, 25.00, 25.00),
(7, 3, 4, 1, 30.00, 30.00),
(8, 3, 5, 4, 30.00, 120.00),
(9, 4, 1, 1, 23.00, 23.00),
(10, 4, 7, 1, 22.00, 22.00),
(11, 5, 1, 1, 23.00, 23.00),
(12, 5, 2, 1, 24.00, 24.00),
(13, 5, 3, 1, 25.00, 25.00),
(14, 6, 1, 3, 23.00, 69.00),
(15, 6, 14, 6, 21.00, 126.00),
(16, 6, 15, 6, 21.00, 126.00),
(17, 6, 13, 2, 17.00, 34.00),
(18, 7, 4, 1, 30.00, 30.00),
(19, 7, 14, 1, 21.00, 21.00),
(20, 8, 7, 1, 22.00, 22.00),
(21, 8, 13, 1, 17.00, 17.00),
(22, 9, 12, 1, 18.00, 18.00),
(23, 9, 1, 1, 23.00, 23.00),
(24, 10, 1, 2, 23.00, 46.00),
(25, 11, 11, 1, 45.00, 45.00),
(26, 12, 4, 1, 30.00, 30.00),
(27, 13, 13, 1, 17.00, 17.00),
(28, 14, 2, 1, 24.00, 24.00),
(29, 15, 2, 1, 24.00, 24.00),
(30, 18, 2, 1, 24.00, 24.00),
(31, 19, 2, 1, 24.00, 24.00),
(32, 19, 1, 1, 23.00, 23.00),
(33, 20, 2, 1, 24.00, 24.00),
(34, 20, 1, 1, 23.00, 23.00),
(35, 21, 2, 1, 24.00, 24.00),
(36, 21, 1, 1, 23.00, 23.00),
(37, 22, 2, 1, 24.00, 24.00),
(38, 22, 1, 1, 23.00, 23.00),
(39, 23, 2, 1, 24.00, 24.00),
(40, 23, 1, 1, 23.00, 23.00),
(41, 24, 2, 1, 24.00, 24.00),
(42, 24, 1, 1, 23.00, 23.00),
(43, 25, 2, 1, 24.00, 24.00),
(44, 25, 1, 1, 23.00, 23.00),
(45, 26, 2, 2, 24.00, 48.00),
(46, 27, 2, 2, 24.00, 48.00),
(47, 28, 2, 2, 24.00, 48.00),
(48, 29, 2, 2, 24.00, 48.00),
(49, 30, 2, 2, 24.00, 48.00),
(50, 31, 2, 2, 24.00, 48.00),
(51, 32, 11, 1, 45.00, 45.00),
(52, 33, 3, 2, 25.00, 50.00),
(53, 34, 4, 2, 30.00, 60.00);

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
  `archivado` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`id_empleado`, `nombre`, `aPaterno`, `aMaterno`, `numero_telefono`, `fecha_ingreso`, `fecha_salida`, `puesto`, `salario_bruto`, `salario_neto`, `otros_conceptos`, `monto_otros_conceptos`, `contactos`, `archivado`) VALUES
(1, 'VICTOR YOSIMAR', 'HERREJON', 'PEÑA', '4431369104', '2024-10-01', '0000-00-00', '', 10000.00, 9999.00, '', 0.00, '', 'no'),
(2, 'Juan', 'Ramirez', 'test', '54564564564', '2024-06-06', '0000-00-00', 'psicologia', 13000.00, 10000.00, '', 0.00, '', 'no'),
(3, 'Angel', 'Garcíax', 'García', '54564564564', '2024-06-22', '0000-00-00', 'psicologia', NULL, 10000.00, '0', 250.00, 'Hermano - Juan Lopez 454654566\r\n', 'no');

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

--
-- Volcado de datos para la tabla `evolucion`
--

INSERT INTO `evolucion` (`id_evolucion`, `descripcion`, `evaluacion`, `fecha`, `imagen`, `id_paciente`, `id_usuario`) VALUES
(1, 'COMUNICACION ASERTIVA', 'SE TRABAJO ESTE COMPONENTE CON LA PX. LA META LOGRAR COMUNICARSE ASERTIVAMENTE CON SU FAMILIA, EL OBJETIVO MEJORAR LOS VINCULOS FAMILIARES', '2024-04-09', '', 11, 32),
(2, 'Plan de vida / Cierre', 'Debido a una situación personal el paciente tiene la necesidad de Egreso, se realiza una sesión de cierre identificando áreas de oportunidad de trabajo, así como las herramientas para una mejor reinsercion social.', '2024-04-16', '17133783794245617566786175319949.jpg', 15, 26),
(3, 'Escalas', 'Se realiza la aplicación de escalas psicometricas.\r\nEl paciente se nota sin disposición, sesgado las pruebas contestadas, se reusa a hablar y únicamente se queda con l vista fija a la ventana.', '2024-04-14', '17133795682433306472166523504624.jpg', 12, 26),
(4, 'Escalas', 'Se realiza la aplicación de escalas psicometricas.\r\nEl paciente se nota sin disposición, sesgado las pruebas contestadas, se reusa a hablar y únicamente se queda con l vista fija a la ventana.', '2024-04-14', '17133795682433306472166523504624.jpg', 12, 26),
(5, 'Entrevista conductual ', 'Se realiza la aplicación de la entrevista conductal al paciente, muestra disposición. \r\nAdemás se realiza test de depresión y ansiedad de Beck', '2024-04-18', '17134653073304333333547833179120.jpg', 20, 26),
(6, 'Escalas', 'Se realiza aplicación de pruebas psicometricas, las cuales se contestan de manera honesta.', '2024-04-18', '17134696471851508328094074529687.jpg', 17, 26),
(7, 'Aplicación de pruebas y manejo de la tristeza', 'Durante la sesión la px se mostró bastante abúlica, anhedónica, así como lábil emocionalmente, por lo que se infiere un alto grado de depresión, por lo que se sugiere revaloración con especialista externo', '2024-04-16', '', 14, 25),
(8, 'Revisión de la evaluación inicial y establecimiento de metas.', 'El px se muestra mucho más lúcido y ubicado en las distintas esferas espaciotemporales; ya no divaga tanto al responder lo que se le cuestiona. Muestra también una aparente disposición al tx y al cambio.\r\n,', '2024-04-16', '', 13, 25),
(9, 'Manejo de la ansiedad', 'La px continua con un grave problema de acatisia, el cual no le permite permanecer sentada, por lo que se ha dificultado mucho tanto la aplicación de pruebas dx, así como la psicoterapia.', '2024-04-17', '', 11, 25),
(10, 'Establecimiento de metas', 'Durante la sesión se volvieron a revisar las pruebas dx, así como el resultado de su EEG, para tratar de generar conciencia de enfermedad en el px, ya que en la última sesión, éste se mostró muy renuente al tx.', '2024-04-17', '', 4, 25),
(11, 'Entrevista conductual ', 'Se aplica entrevista estructurada para conocer principales problemáticas que ha generado el consumo.\r\nEl paciente tiene disposición, acepta la cantidad de consumo pero no lo ve como una problemática.', '2024-04-20', '17137971034542076036779737559648.jpg', 19, 26),
(12, 'Manejo de la ansiedad ', 'Se planeaba aplicar escalas pero el paciente empieza con un cuadro de ansiedad que se le enseña a manejar de manera más oportuna, se permite guiar y se tranquiliza un poco', '2024-04-20', '17137972247463018978166725413537.jpg', 12, 26),
(13, 'Entrevista conductual ', 'Se aplica entrevista estructurada para conocer problemáticas que ha generado el consumo.', '2024-04-20', '17138926236418015877532170794390.jpg', 18, 26),
(14, 'Escalas ', 'Se aplica una parte de una batería de pruebas psicometricas enfocadas en especializar el tratamiento a lo que el px necesita ', '2024-04-23', '17138926978878722118953406820260.jpg', 18, 26),
(15, 'Escalas', 'Se aplica batería de pruebas psicometricas para especializar el tratamiento en base a las necesidades del px ', '2024-04-22', '17138928392557626116548025414877.jpg', 19, 26),
(16, 'Escalas ', 'Se aplica batería de pruebas psicometricas para conocer niveles de adicción y personalizar el tratamiento ', '2024-04-23', '17139062083132810179585503711080.jpg', 20, 26),
(17, 'Identificación de metas', 'A través de la reflexión se hace ver al paciente las diferentes áreas de oportunidad que hay en relación a la adicción para trabajar en sesión ', '2024-05-03', '17147669399231445422502883282597.jpg', 17, 26),
(18, 'Identificación de metas', 'A través de la reflexión se hace ver al paciente las diferentes áreas de oportunidad que hay en relación a la adicción para trabajar en sesión ', '2024-05-03', '17147669399231445422502883282597.jpg', 17, 26),
(19, 'Identificación de metas ', 'Se plantea aquellas necesidades a trabajar como prioridad en el tratamiento.', '2024-05-03', '17147670787112240745330557358526.jpg', 18, 26),
(20, 'Identificación de metas', 'Se realiza un análisis de las diferentes  áreas de oportunidad para el tratamiento ', '2024-05-04', '17150143508742908977177328369524.jpg', 20, 26),
(21, 'Identificación de metas ', 'Se trabaja en relación a las necesidades del paciente,identificar y plantearla como parte del tratamiento ', '2024-05-03', '17150145064033356390709379087595.jpg', 19, 26),
(22, 'Relación de pareja', 'Se conoce el como era la relación de pareja, como fue su evolución y cual fue el motivo de la separación que se dio ', '2024-05-06', '17150217846472741565662359114826.jpg', 18, 26),
(23, 'Pensamiento Critico', 'Se confronta al paciente para que acepte su enfermedad y sea honesto con ella, buscando también deje de victimizarse', '2024-05-08', '17151846156255955267068929147012.jpg', 17, 26);

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
(9, 200.00, '', '2024-06-13 00:00:00', '2024-06-13 00:00:00', 'nuevo abono', 'Efectivo', 'No aplicado', 'no', 8, NULL),
(10, 1000.00, '', '2024-06-25 00:00:00', '2024-06-25 00:00:00', '', 'Efectivo', 'No aplicado', 'no', 8, NULL),
(6, 0.00, '', '2024-06-07 00:00:00', '0000-00-00 00:00:00', '', '', '', 'no', 0, NULL),
(7, 5000.00, '', '2024-06-07 00:00:00', '2024-04-05 00:00:00', 'Abono', 'Efectivo', 'No aplicado', 'no', 24, NULL),
(8, 7000.00, '', '2024-06-07 00:00:00', '2024-05-07 00:00:00', 'Abono', 'Efectivo', 'No aplicado', 'no', 24, NULL);

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
-- Estructura de tabla para la tabla `ordenes`
--

CREATE TABLE `ordenes` (
  `id_orden` int(11) NOT NULL,
  `id_paciente` int(11) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `total` decimal(10,2) NOT NULL,
  `estatus` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `ordenes`
--

INSERT INTO `ordenes` (`id_orden`, `id_paciente`, `fecha_creacion`, `total`, `estatus`) VALUES
(1, 2, '2024-02-12 23:26:37', 99.00, ''),
(2, 3, '2024-02-15 18:28:45', 113.00, ''),
(3, 21, '2024-04-25 18:46:01', 205.00, ''),
(4, 22, '2024-05-23 16:34:56', 45.00, ''),
(5, 23, '2024-05-28 22:34:17', 72.00, ''),
(6, 23, '2024-05-28 22:51:45', 355.00, ''),
(8, 24, '2024-06-07 17:08:16', 39.00, ''),
(32, 8, '2024-06-21 22:43:54', 45.00, 'Pagado'),
(17, 8, '2024-06-21 18:56:53', 24.00, 'Pagado'),
(33, 8, '2024-06-21 23:26:17', 50.00, 'Pagado'),
(34, 8, '2024-06-25 16:38:26', 60.00, 'Pagado'),
(29, 8, '2024-06-21 19:49:33', 48.00, 'Pagado');

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
(1, 'ROBERTO', 'GARCIA', 'HIERRO', '1999-12-18', 'Masculino', 24, 'YUCATAN #160 MOLINO DE PARRAS, MORELIA, MICHOACAN.', '4434059382', 'MEXICANA', 'Soltero(a)', 'Preparatoria', 'N/A', '2', '', 'No', '', '2023-01-25', '15:00', 'No', 'Involuntario', '', '', '', '', 'No', 1, 'MARIVEL HIERRO HUERTA', '53', 'MAESTRA', 'MAMÁ', 'CALLE YUCATAN #160 MOLINO DE PARRAS, MORELIA, MICHOACAN.', 'INE', '', '', 'METANFETAMINA', '2 años', 'INFECCION PULMONAR', 'N/A', 'NO', 'NO', '', '08eef73b78e3c197be106ed6c73c763f378542ed', 'no', NULL),
(2, 'ROBERTO', 'GARCIA', 'HIERRO', '1999-12-18', 'Masculino', 24, 'YUCATAN #160 MOLINO DE PARRAS, MORELIA, MICHOACAN.', '4432863105', 'MEXICANA', 'Soltero(a)', 'Preparatoria', 'N/A', '2', '', 'No', '', '2023-01-25', '15:00', 'No', 'Involuntario', '', '', '', '2023-01-20', 'Si', 1, 'MARIVEL HIERRO HUERTA', '53', 'MAESTRA', '', 'CALLE YUCATAN #160 MOLINO DE PARRAS, MORELIA, MICHOACAN.', 'INE', 'marvel.hierro@yahoo.com.mx', '4432863105', 'METANFETAMINA', '2 años', 'INFECCION PULMONAR', 'N/A', 'NO', 'NO', '', '55e34b2c6f8054f65e52e7311aedb27b404f801a', 'no', NULL),
(3, 'PEDRO', 'CORIA BALTAZAR', 'baltazar', '1998-08-17', 'Masculino', 25, 'Calle  Porfirio Parra # 78 Fraccionamiento Peña Blanca  C.P. 58095 Morelia, Michoacán', '4433687906', '', 'Soltero(a)', 'Licenciatura', 'Mercadotecnia', 'Ninguno', '', 'No', '', '2023-09-22', '19:30', 'No', 'Voluntario', 'DOS PERFORACIONES EN OREJAS CICATRIZ EN RODILLAS9 TATUAJES ', 'PANTALON NEGROPLAYERA BLANCA TENNIS NEGROS ADIDAS', 'NINGUNO', '2023-09-2023', 'No', 1, 'BLANCA LIVIER BALTAZAR GOMEZ', '53', 'AMA DE CASA', 'MAMÁ', 'Calle  Porfirio Parra # 78 Fraccionamiento Peña Blanca  C.P. 58095 Morelia, Michoacán', 'INE', 'NA', '4436983798', 'marihuana y alcohol', '2 años', 'no', 'no', 'no', 'no', 'NO FUMAR', 'f73e03206e1e13d6f3750d27f9b041319a13a801', 'no', NULL),
(4, 'VALENTIN', 'ALVARADO', 'NIETO', '', 'Masculino', 32, 'FCO I MADERO 124 LA GOLETA MPIO CHARO MICH', '4433283529', 'MEXICANO', 'Soltero(a)', 'Preparatoria', 'SOLDADOR', '0', '', 'No', '', '2024-02-11', '01:00', 'No', 'Involuntario', '2 TATUAJES EN LA ESPALDA 1 PERFORACION PEQUEÑA OIDO', 'PLAYERA AZUL MARINO, BERMUDA CAFE, CALCETINES GRISES, SANDALIAS NEGRAS', 'NINGUNA', '2024-02-04', 'No', 1, 'ARTURO ALVARADO', '78', 'comerciante', '', 'FCO I MADERO  124 LA GOLETA MPIO CHARO MICH', '034806927171225', 'NA', '4433283529', 'CRISTAL', '7 A 8 AÑOS', 'NO', 'NO', 'NO', 'NO', '', '4a823cb0253e5206fa0ec7e4e7c18ea7232149d2', 'no', NULL),
(5, 'LUIS EDUARDO', 'INFANTE ', 'RUIZ', '', 'Masculino', 0, '', '', '', 'Soltero(a)', 'Primaria', '', '', '', '', '', '', '', 'No', '', '', '', '', '', 'No', 1, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '04cc37e31e71fa29ed6f533c2d38be2ae9f090c8', 'no', NULL),
(6, 'ANGEL', 'TEST', 'TESTx', '2024-02-23', 'Masculino', 23, 'test', '54564564564', 'mexicano', 'Divorciado(a)', 'Primaria', 'test', '2', '2023/02/02', 'Si', 'test', '2024-03-02', '01:02', 'No', '', '', '', '', '2024-02-23', 'Si', 1, 'Salvador', '23', 'medico', '', '', 'INE 454655646544', '', '', 'cocaina', '2 años', 'diabetes', '1', 'cereso', 'asistencia a AA', '', 'ac6157ae767d02be6cf60f28917357a6539d09bb', 'si', NULL),
(8, 'TEST2', 'TEST2', '', '', 'Masculino', 0, '', '', '', 'Soltero(a)', 'Primaria', '', '', '', '', '', '2000-02-02', '12:25', 'No', '', '', '', '', '', 'No', 1, 'xxxxxx', '', '', '', '', '', '', '', '', '', '', '', '', '', 'no perico', 'e753b2cb5c2ff0db3a46ac5beeb4fc5e69e7a0fa', 'si', 1480),
(9, 'ENRIQUE', 'ESCOBAR', 'OROZCO', '1977-05-23', 'Masculino', 46, 'LAGO DE CAMECUARO #893 COLONIA VENTURA PUENTE', '4433901269', 'MEXICANA', 'Casado(a)', 'Secundaria', 'EMPLEADO MUNICIPAL', '0', '', 'No', '', '2024-03-03', '10:33', 'No', 'VOLUNTARIO', 'CICATRIZ EN EL MENTON', 'CAMISA NEGRA, CAMISETA BLANCA, PANTALON DE MEZCLILLA, TENIS GRISES, CALCETINES GRISES, BOXER AZUL.', 'CARTILLA DE VACUNACION, LENTES, BOCINA, $60.00, 1 CELULAR, RECIPIENTE DE VIDRIO, 1 PLUMA.', '2024-02-18', 'No', 1, 'MARCELA ESCOBAR OROZCO', '65 AÑOS', '', 'MADRE', 'LAGO DE CAMECUARO #893 COL. VENTURA PUENTE', 'INE - 1120011552705', '', '4433901269', 'ALCOHOL', '28 AÑOS', 'HIPERTENSION POR ESTRES', 'NO', 'NO', '', '', '520ed986bf5eb22592a2b664514e30d11654ae8b', 'No', NULL),
(10, 'GERARDO', 'GONZALEZ', 'CASTRO', '1965-11-06', 'Masculino', 58, '1ER RETORNO DE LOS ALPES #54 COL. BOSQUE ALTOZANO MONARCA', '4438657899', 'MEXICANA', 'Casado(a)', 'Licenciatura', 'ARQUITECTO', '0', '', 'No', '', '2024-03-11', '23:55', 'No', 'Voluntario', 'PACIENTE CONSCIENTE , ORIENTADO, ADECUADA HIDRATACIÓN Y MUCOTEGUMENTARIA, CUELLO CILINDRICO, SIN PRESENCIA DE ADENOMEGALIAS. CARDIOPULMONAR SIN COMPROMISO, ABDOMEN PLANO, EXTREMIDADES ÍNTEGRAS Y SIMETRICAS.', 'TENIS NEGROS CON ROJO, PANTALON NEGRO, CAMISA ROSA, GORRA NEGRA.', 'NINGUNO.', '', 'No', 1, 'ANA VICTORIA MARTINEZ MARMOLEJO', '49 AÑOS', 'EMPRESARIA', '', '1ER RETORNO DE LOS ALPES #54 COL. BOSQUE ALTOZANO MONARCA', 'INE - 1103077828849', 'victoria11925@hotmail.com', '4438657899', 'ALCOHOL', '', 'NO', 'NO', 'NO', 'NO', '', '9fed31f81a18c77de27fc9bf584908615f02d743', 'No', NULL),
(11, 'ALMA ROSA', 'DODDOLI', 'VIANA', '1975-08-23', 'Femenino', 48, 'CIRC. CARTAGENA 10 - 82 COL. PASEO DE LAS PITHAYAS, QUERETARO, QRO.', '4434928438', 'MEXICANA', 'Casado(a)', 'Licenciatura', 'CONTADORA', '3', '2020-2021-2022', 'No', '', '2024-03-13', '14:30', 'No', 'Voluntario', 'GOLPE CONTUSO EN EL ANTEBRAZO DERECHO, EDEMA EN MANOS Y EN MIEMBROS INFERIORES.', 'PLAYERA BLANCA Y PANTS OSCURO, TENIS Y UN COLLAR.', 'DOS LIBRETAS, DOS ESTUCHES DE LENTES CON TRES LENTES, DOS PERFUMES, UN CELULAR, CUATRO LABIALES, DOS TUBOS DE MONEDAS, SEIS TARJETAS, $400.00 EN EFECTIVO, DOS ENCENDEDORES, PIEDRAS, DOS LLAVES, UNA BOLSAS COACH, LLAVES DE AUTO, LLAVERO CON CUATRO LLAVES, QUINCE CAJAS CON MEDICAMENTO.', '2024-03-13', 'Si', 1, 'JAMIE XIOMARA RIOS DODDOLI', '26 AÑOS', 'EMPLEADA', '', 'FRACC. ZIBATA, EL MARQUES, QRO.', 'INE - 0952105187789', '', '4434928438', 'ALPRAZOLAM, CLONAZEPAM Y BENZODIAZEPINA.', '13 AÑOS', 'INSOMNIO, ANSIEDAD, GASTROENTERITIS Y TRASTORNOS ALIMENTICIOS.', 'MAMOPLASTIA Y ABDOMINOPLASTIA.', 'NO', 'SI', '', 'c53ea18b3bd62c1abd109a62d755a02e7a627607', 'No', NULL),
(12, 'JOSUE ALEJANDRO', 'OLIVERA', 'MENDOZA', '1999-10-11', 'Masculino', 24, 'AV. COALCOMAN #210 COL. EL CANALON, TEPALCATEPEC.', '+1 206 627 9411', 'MEXICANO', 'Soltero(a)', 'Secundaria', 'EMPLEADO', '2', '2022-2023', 'No', '', '2024-03-16', '13:23', 'No', 'Involuntario', 'SIN GOLPES, NI CATRICES NI TATUAJES. USA GAFAS MONOFOCALES.', 'PLAYERA Y PANTALON MEZCLILLA, TENIS.', 'UN CELULAR IPHONE, 1 RELOJ, UNA PULSERA, UN ANILLO, UN ESCAPULARIO, UNA CADENA, UNA CARTERA, TRES DOLARES ESTADOUNIDENSES, TRES DOLARES CANADIENSES Y OCHO CREDENCIALES.', '2024-02-26', 'No', 1, 'IRIS NEREIDA MENDOZA VALENCIA', '53 AÑOS', 'EMPLEADA', '', 'AV. COALCOMAN #210, EL CANAL. TEPALCATEPEC, MICHOACAN', 'INE - 1600004700400', '', '+1 206 627 9411', 'ALCOHOL, MARIHUANA Y TABACO.', '9 AÑOS', 'BIPOLARIDAD, PSICOSIS, PROBABLE ESQUIZOFRENIA.', 'SI, HACE TRES DIAS ESTUVO INTERNADO UN MES.', 'NO', 'NO', '', '0ed04367f578b60a9b087b862a89a213fde14ab4', 'No', NULL),
(13, 'LUIS', 'ARROYO', 'VALENCIA', '1978-02-23', 'Masculino', 46, 'CALLE GUADALAJARA #110, COL. REV. URUAPAN.', '4521052655', 'MEXICANA', 'Casado(a)', 'Secundaria', 'MESERO', '0', '', 'No', '', '2024-03-19', '21:30', 'No', 'Involuntario', 'EXTREMIDADES INTEGRAS Y SIMÉTRICAS, SIN PRESENCIA DE DEFORMIDADES.', 'PLAYERA Y PANTALON DE MEZCLILLA.', 'NADA', '2024-03-19', 'No', 1, '', '', '', '', '', '', '', '', 'ALCOHOL', '', '', '', '', '', '', '29159ce0b6a2a90d3efd7283bf59f57e8d6dacbb', 'no', NULL),
(14, 'VIRIDIANA', 'MONTERO', 'GARCIA', '1997-08-15', 'Femenino', 26, 'BENIGNO #42 COL. CENTRO, PATZCUARO, MICHOACAN.', '4343421597', 'MEXICANA', 'Soltero(a)', 'Preparatoria', 'AMA DE CASA', '0', '', 'No', '', '2024-03-23', '17:43', 'No', 'Voluntario', 'SIN TATUAJES, NI GOLPES, NI PERFORACIONES, SOLAMENTE CON FASCIAS DE ANGUSTIA Y ESTADO DE ANIMO FRAGIL DEPRESIVO.\r\n', 'BLUSA GRIS Y PANTALON DE MEZCLILLA.', 'UNA CUCHARA, UNOS AUDIFONOS, UN RIMEL, UN MAQUILLAJE, UN PINTAUÑAS, UN LABIAL, UN PERFUME, UNA CREMA P/ MANOS, UNA BROCHA, UNA ESPONJA, TRES PULSERAS, TRES LLAVES Y $2.00.', '2024-03-23', 'Si', 1, 'ALBERTO AQUILES MONTERO GARCIA ROJAS', '55 AÑOS', 'EMPLEADO', '', 'C. BENIGNO SERRATO #42 COL. CENTRO, PATZCUARO, MICH.', 'INE - 1468034601886', 'aamgr69@hotmail.com', '4341193115 - 4343421592', 'MARIHUANA Y METANFETAMINA', '10 AÑOS MARIHUANA Y 15 AÑOS METANFETAMINA', 'NINGUNA', 'NO', 'NO', 'NO', '', '51b8b96a9b8a4c7b44c96317c85e68a9d18ee7d3', 'No', NULL),
(15, 'LUIS ANGEL', 'SUAREZ', 'GONZALEZ', '1990-03-10', 'Masculino', 34, 'VALLE DE LA MACARENA #21 FRAC. LOMAS DE LOS VIÑEDOS', '4432269541', 'MEXICANA', 'Casado(a)', 'Preparatoria', 'CONSTRUCCION', '0', '', 'No', '', '2024-03-26', '12:36', 'No', 'Voluntario', 'SIN GOLPES, NI TATUAJES, NI PERFORACIONES.', 'CAMISA ROJA DE CUADROS, PANTALON MEZCLILLA, TENIS NEGROS Y ROPA INTERIOR NEGRA.', 'UN CELULAR IPHONE, UN PASAPORTE, 115 DOLARES AMERICANOS, $710.00 PESOS MEXICANOS, SEIS TARJETAS, CUATRO ID´S, UN AIRPOD Y UN CARGADOR.', '2024-03-25', 'No', 1, 'KARINA AMBRIZ GALLARDO', '40 AÑOS', '', '', 'PRIV. 1RA DE HIDALGO #3 COL. CENTRO, JIMENEZ, MICHOACAN.', 'INE', '', '+1 951 452 9664', 'ALCOHOL', '10 AÑOS', 'NINGUNA', 'NINGUNA', 'NINGUNA', 'UNA VEZ', '', '4a790a8001381d8ae821d4d0705d9dd737ddd72c', 'No', NULL),
(16, 'MANUEL', 'GAONA', 'QUINTERO', '2005-05-12', 'Masculino', 18, 'PORT. ISABEL DR NO 1035 LITTLE ELM TEXAS, EUA.', '+1 945 217 9284', 'ESTADOUNIDENSE', 'Soltero(a)', 'Preparatoria', 'ESTUDIANTE', '0', '', 'No', '', '2024-03-27', '12:39', 'No', 'Involuntario', 'SIN GOLPES, SIN PERFORACIONES Y UN TATUAJE EN LA PIERNA IZQUIERDA.', 'UN SHORT NEGRO, UNA CAMISETA NEGRA, UN BOXER AZUL, UN PANTALON NEGRO, UNA GORRA, UN CINTURON Y UN PAR DE TENIS.', 'UN IPHONE, UNA TARJETA DE DEBITO, UN PASAPORTE, DOS BOLETOS DE AVION, UNA CARTA FISCAL, $100.00 PESOS MEXICANOS Y UN PAR DE TENIS.', '2024-03-26', 'No', 1, 'JUAN ANTONIO GAONA FARIAS', '53 AÑOS', 'HOJALATERO', '', 'PORT. ISABEL DR NO 1035 LITTLE ELM TEXAS, EUA.', 'PASAPORTE', '', '+1 945 217 9284', 'MARIHUANA', '6 AÑOS', 'NINGUNA', 'NINGUNA', 'NO', 'NO', '', '0d90ac04c0eec1c86e84ce90ec33ae6b777544b9', 'No', NULL),
(17, 'JOSE ARNOLDO', 'GUTIERREZ', 'VILLA', '1960-01-25', 'Masculino', 64, 'CACAHUATE #312  COL. LOMAS DE LA HUERTA', '627 112 7791', 'MEXICANA', 'Divorciado(a)', 'Licenciatura', 'CONSTRUCCION', '0', '', 'No', '', '2024-03-25', '17:44', 'No', 'Involuntario', 'FRACTURA PIE IZQUIERDO, GOLPE GLUTEO IZQUIERDO Y LUNAR EN EL ABDOMEN LADO INFERIOR DERECHO.', 'PANTS NEGRO Y PLAYERA GRIS.', 'NO', '2024-03-21', 'No', 1, 'MARIA ELVIA GUTIERREZ VILLA', '65 AÑOS', 'AMA DE CASA', '', 'CACAHUATE #312  COL. LOMAS DE LA HUERTA', 'INE', '', '627 112 7791', 'ALCOHOL', '15 AÑOS', 'SI', 'NO', 'NO', 'NO', '', '896eb28f6d92fd32b4c53d5a445da40f9049b310', 'No', NULL),
(18, 'BLADIMIR', 'MONGE', 'ALVAREZ', '1982-03-25', 'Masculino', 42, 'PETATLAN, GUERRERO.', '7581033205', 'MEXICANA', 'Casado(a)', 'Secundaria', 'CAMPESINO', '0', '0', 'No', '', '2024-04-01', '18:20', 'No', 'Voluntario', 'CICATRIZ EN MANO IZQUIERDA Y CICATRIZ EN DEDO MANO IZQUIERDA.', 'PLAYERA AZUL, PANTALON DE MEZCLILLA, TENIS AZULES Y GORRA DE MEZCLILLA.', '', '2024-04-25', 'No', 1, 'PABLO CARDENAS ZUÑIGA', '30 AÑOS', 'CAMPESINO', '', 'PETATLAN, GUERRERO', 'INE', '', '7581033205', 'ALCOHOL Y COCAINA', '15 AÑOS', 'NINGUNA', 'MO', 'NO', 'NO', '', '922a1de9fc1946df7b07948fa17f1197f57dfa7a', 'No', NULL),
(19, 'RAUL', 'PONCE', 'MORALES', '1987-10-08', 'Masculino', 36, 'ARTEAGA #161 cOL. CENTRO ZINAPECUARO', '4431228198', 'MEXICANA', 'Soltero(a)', 'Licenciatura', 'DESEMPLEADO', '0', '0', 'No', '', '2024-04-01', '23:30', 'No', '', 'Operación de apéndicitis y golpe en pie derecho.', 'Pants negro, sudadera gris, boxer azul y sandalias.', 'No.', '2024-04-01', 'Si', 1, 'ARCELIA MORALES BARAJAS', '74 AÑOS', 'COMERCIANTE', '', 'ARTEAGA #161, COL. CENTRO ZINAPECUARO', 'INE', '', '4431228198', 'ALCOHOL', '6 AÑOS', 'ALERGIAS', 'NO', 'NO', 'NO', '', '617028d14b2e11039147a380b44cdfc935837d5f', 'No', NULL),
(20, 'ADONAI', 'PANIAGUA', 'BARRERA', '2003-09-16', 'Masculino', 20, 'C. BENITO JUAREZ , COL. CENTRO HUIRAMBA', '4431185747', 'MEXICANA', 'Soltero(a)', 'Preparatoria', 'DESEMPLEADO', '0', '', 'No', '', '2024-04-02', '09:29', 'No', 'Voluntario', '', '', '', '', 'No', 1, 'ESLY BARRERA RAMIREZ', '41 AÑOS', '', '', '', 'LICENCIA DE CONDUCIR', '', '', 'ALCOHOL Y COCAINA', '3 AÑOS', 'NINGUNA', 'NO', 'NO', 'NO', 'TIENDA 300', '7e4c6627e0e7904bfcf0793fe712bf6ed1e31a3c', 'si', NULL),
(21, 'LENIN', '', 'TENTORY', '', 'Masculino', 0, '', '', '', 'Soltero(a)', 'Primaria', '', '', '', '', '', '2024-04-25', '14:05', 'No', '', '', '', '', '', 'No', 1, '', '', '', '', '', '', '', '4433627745', '', '', '', '', '', '', 'NO CIGARROS', '44e19e7d802e4a717bbf98456d39de49d7457ef8', 'No', NULL),
(22, 'Manuel Alberto', 'Andrade', 'Ayala', '1991-12-18', 'Masculino', 32, 'PedroJose Bermeo,Col.22 de octubre', '', 'Mexicano', 'Casado(a)', 'Licenciatura', 'comerciante', '0', '0', 'No', 'no', '2024-04-23', '21:00', 'No', 'Involuntario', 'Operación de pendice', 'Pantalón azulPlayera cremaTenis negrosBóxer negro', '1 celular1 cinturón1 tarjeta nu ', '2024-04-22', 'Si', 1, 'Norma Lilia Ayala Ramirez', '64', 'Ama de casa', '', 'Pedro Jose Bermeo 109 Col.22 de octubre', 'INE', '', '4436983798', 'Metanfetamina', '1 Ano', 'NINGUNA', 'NO', 'NO', 'Poco tiempo', '', '2f4368d51c2b2397537732af11773a17cb52e6fc', 'No', NULL),
(23, 'GUILLERMO ', 'BAZAN', 'CRUZ', '1978-09-17', 'Masculino', 45, 'EMILIANO ZAPATA #88 AGRARISTA', '4255353937', 'Mexicano', 'Unión libre', 'Preparatoria', 'FRUTICULTOR', '0', '0', 'No', 'no', '2024-05-21', '15:20', 'No', 'Involuntario', 'GOLPE NARIZ, TATUAJES BRAZO DERECHO,DESCALABRADA EN CABEZA, PERFORACION OIDO ITZQUIERO.', 'SHORT CAFE SANDALIAS NEGRAS, PLAYERA GRIS, BOXEER AZUL', 'NP', '2024-05-19', 'No', 1, 'LUCINDA CRUZ NAVA', '73', 'AMA DE CASA', '', 'CALLE EMILIANO ZAPATA #88 COLONIA AGRARISTA NUEVA ITALIA', '1306014841212', '', '4251179717', 'COCAINA Y ALCOHOL', '4 AÑOS', 'LA PENDICE', 'NO', 'NO', 'NO', '', '236c0d8baabf8c25d2afbe499742bb43c70aa39f', 'No', NULL),
(24, 'Adonai', 'Barrera', 'Paniagua', '1990-02-20', 'Masculino', 32, 'benito juarez', '4554645646', 'mexicano', 'Soltero(a)', 'Preparatoria', 'comerciante', '0', '', 'Si', 'no', '2024-04-02', '10:08', 'Si', 'Voluntario', 'tatuaje de mariposa', 'short', 'celular', '2024-06-06', 'Si', 1, 'LUCINDA CRUZ NAVA', '53', 'AMA DE CASA', '', 'COLONIA PEÑA BLANCA  C.P. 38095 MORELIA MICHOACAN ', 'INE', 'NA', '4432863105', 'marihuana y alcohol', '2 años', 'no', 'NO', 'NO', 'no', 'no cigarros', 'e49a6b97ae8085ad810bb2cdcacef89372c042a4', 'No', 12000);

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
(1, 500, 'falta', 'Descuento', '2024-06-13', 'pendiente', 2),
(2, 150, 'bono', 'Bono', '2024-06-13', 'pendiente', 2),
(3, 300, 'falta', 'Descuento', '2024-06-14', 'pagado', 1);

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
(1, 25000, 0, 0, '', 1, '2024-03-12', '2023-03-01', '', 'Mensualidad', '', 'Efectivo', 'Pagado', 'no', 2, 8),
(2, 10000, 0, 0, '', 2, '2024-04-12', '2023-07-22', '', 'Mensualidad', '', 'Efectivo', 'Pagado', 'no', 2, 8),
(3, 20000, 0, 0, '', 3, '2024-05-12', '2023-06-24', '', 'Mensualidad', '', 'Transferencia', 'Pagado', 'no', 2, 8),
(4, 20000, 0, 0, '', 4, '2024-06-12', '2023-12-30', '', 'Mensualidad', '', 'Efectivo', 'Pagado', 'no', 2, 8),
(5, 20000, 0, 0, '', 5, '2024-07-12', '2024-01-06', '', 'Mensualidad', '', 'Efectivo', 'Pagado', 'no', 2, 8),
(6, 120000, 0, 0, '', 6, '2024-08-12', '0000-00-00', '', 'Mensualidad', '', '', 'No Pagado', 'no', 2, 0),
(7, 20350, 0, 0, '', 0, '2024-02-12', '2023-01-26', '', 'donación de ingreso', '', 'Efectivo', 'Pagado', 'no', 2, 8),
(8, 1, 0, 1, '', 0, '2024-02-12', '2024-02-12', '', 'Saldo a favor en tiendita', '', 'Efectivo', 'Pagado', 'No', 2, 8),
(9, 1, 0, 1, '', 0, '2024-02-12', '2024-02-12', '', 'Saldo a favor en tiendita', '', 'Efectivo', 'Pagado', 'No', 2, 8),
(10, 25650, 0, 0, '', 1, '2024-03-13', '0000-00-00', '', 'Mensualidad', '', '', 'No Pagado', 'no', 3, 0),
(11, 25650, 0, 0, '', 2, '2024-04-13', '0000-00-00', '', 'Mensualidad', '', '', 'No Pagado', 'no', 3, 0),
(12, 25650, 0, 0, '', 3, '2024-05-13', '0000-00-00', '', 'Mensualidad', '', '', 'No Pagado', 'no', 3, 0),
(13, 500, 0, 500, '', 0, '2024-02-15', '2024-02-15', '', 'Saldo a favor en tiendita', '', 'Efectivo', 'Pagado', 'No', 3, 8),
(14, 60000, 0, 0, '', 1, '2024-03-16', '0000-00-00', '', 'Mensualidad', '', '', 'No Pagado', 'no', 4, 0),
(15, 60000, 0, 0, '', 0, '2024-02-16', '2024-03-11', '', 'donación de ingreso', '', 'Efectivo', 'No Pagado', 'no', 4, 16),
(16, 60000, 0, 0, '', 0, '2024-02-16', '2024-02-13', '', 'Se le dio oportunidad de 15 días para pagar de contado ', '', 'Efectivo', 'No Pagado', 'no', 4, 16),
(17, 1300, 0, 0, '', 1, '2024-03-24', '0000-00-00', '', 'Mensualidad', '', '', 'No Pagado', 'no', 6, 0),
(18, 1300, 0, 0, '', 2, '2024-04-24', '0000-00-00', '', 'Mensualidad', '', '', 'No Pagado', 'no', 6, 0),
(19, 1200, 0, 0, '', 0, '2024-02-24', '0000-00-00', '', 'donación de ingreso', '', 'Efectivo', 'Pagado', 'no', 6, 1),
(20, 1200, 0, 0, '', 0, '2024-02-24', '0000-00-00', '', 'donaciones adicionales', '', 'Efectivo', 'Pagado', 'no', 6, 1),
(21, 500, 0, 0, '', 0, '2024-02-26', '0000-00-00', '', 'nuevo pago', '', 'Efectivo', 'No Pagado', 'no', 6, 1),
(22, 200, 0, 200, '', 0, '2024-02-26', '2024-02-26', '', 'Saldo a favor en tiendita', '', 'Efectivo', 'Pagado', 'No', 6, 1),
(23, 2800, 0, 2800, '', 1, '2024-03-05', '2024-06-01', '', 'Mensualidad', '', 'Saldo', 'Pagado', 'no', 8, 1),
(24, 23, 0, 22, '', 1, '2024-03-05', '2024-06-01', '', 'Mensualidad', '', 'Saldo', 'Pagado', 'no', 8, 1),
(25, 234, 0, 0, '', 0, '2024-02-27', '0000-00-00', '', 'donación de ingreso', '', 'Efectivo', 'No Pagado', 'no', 8, 15),
(26, 1, 0, 0, '', 0, '2024-02-27', '0000-00-00', '', 'donaciones adicionales', '', 'Efectivo', 'Pagado', 'no', 8, 15),
(27, 70000, 0, 0, '', 0, '2024-04-25', '0000-00-00', '', '', '', 'Efectivo', 'Pagado', 'no', 20, 22),
(28, 70000, 0, 0, '', 0, '2024-04-25', '0000-00-00', '', 'TRATAMIENTO', '', 'Deposito', 'No Pagado', 'si', 20, 22),
(29, 28500, 0, 0, '', 1, '2024-05-25', '0000-00-00', '', 'Mensualidad TRATAMIENTO', '', '', 'No Pagado', 'no', 21, 0),
(30, 28500, 0, 0, '', 2, '2024-06-25', '0000-00-00', '', 'Mensualidad TRATAMIENTO', '', '', 'No Pagado', 'no', 21, 0),
(31, 19950, 0, 0, '', 1, '2024-05-25', '0000-00-00', '', 'ULMIMO MES ', '', '', 'No Pagado', 'no', 21, 0),
(32, 19950, 0, 19950, '', 2, '2024-06-25', '2024-04-25', '', 'ULMIMO MES ', '', 'Efectivo', 'Pagado', 'no', 21, 22),
(33, 10000, 0, 0, '', 0, '2024-04-25', '2024-04-25', '', 'PRIMER PAGO', '', 'Efectivo', 'Pagado', 'no', 21, 22),
(34, 1500, 0, 0, 'WhatsApp Image 2024-04-25 at 11.38.05 AM.jpeg', 0, '2024-04-25', '2024-04-25', '', 'TIENDA', '', 'Efectivo', 'Pagado', 'no', 21, 22),
(35, 28000, 0, 0, '', 0, '2024-04-25', '2024-04-26', '', '', '', 'Efectivo', 'No Pagado', 'no', 18, 1),
(36, 20000, 0, 0, '', 0, '2024-04-25', '0000-00-00', '', '', '', 'Efectivo', 'No Pagado', 'no', 18, 22),
(37, 12000, 0, 0, '', 0, '2024-04-25', '0000-00-00', '', '', '', 'Efectivo', 'No Pagado', 'no', 18, 22),
(38, 500, 0, 500, '', 0, '2024-04-25', '2024-04-25', '', 'Saldo a favor en tiendita', '', 'Otro', 'Pagado', 'No', 21, 22),
(39, 2500, 0, 0, '', 0, '2024-04-29', '2024-04-25', '', 'primer pago de tratamiento', '', 'Transferencia', 'Pagado', 'no', 22, 22),
(40, 2500, 0, 0, '', 0, '2024-04-29', '2024-04-25', '', 'PRIMER PAGO', '', 'Transferencia', 'Pagado', 'no', 22, 22),
(41, 5000, 0, 0, '', 0, '2024-04-29', '2024-04-29', '', 'TRATAMIENTO', '', 'Efectivo', 'Pagado', 'no', 22, 22),
(42, 5000, 0, 24167, '', 0, '2024-04-29', '2024-06-22', '', 'segundo pago  tratamiento', '', 'Transferencia', 'Pagado', 'no', 22, 22),
(43, 24167, 0, 5000, '', 0, '2024-04-29', '2024-05-22', '', 'TRATAMIENTO', '', 'Efectivo', 'Pagado', 'si', 22, 22),
(44, 3500, 0, 0, '', 1, '2024-06-07', '0000-00-00', '', 'Mensualidad', '', '', 'No Pagado', 'si', 21, 0),
(45, 3500, 0, 0, '', 2, '2024-07-07', '0000-00-00', '', 'Mensualidad', '', '', 'No Pagado', 'si', 21, 0),
(46, 2300, 0, 0, '', 1, '2024-05-14', '0000-00-00', '', 'Mensualidad', '', '', 'No Pagado', 'no', 21, 0),
(47, 2300, 0, 0, '', 2, '2024-05-21', '0000-00-00', '', 'Mensualidad', '', '', 'No Pagado', 'no', 21, 0),
(48, 2300, 0, 0, '', 1, '2024-05-14', '0000-00-00', '', 'Mensualidad', '', '', 'No Pagado', 'no', 21, 0),
(49, 2300, 0, 0, '', 2, '2024-05-21', '0000-00-00', '', 'Mensualidad', '', '', 'No Pagado', 'no', 21, 0),
(72, 21667, 0, 0, '', 2, '2024-07-21', '0000-00-00', '', 'Mensualidad', '', '', 'No Pagado', 'no', 23, 0),
(71, 21667, 0, 0, '', 1, '2024-06-21', '0000-00-00', '', 'Mensualidad', '', '', 'No Pagado', 'no', 23, 0),
(70, 35000, 0, 0, '', 1, '2024-08-21', '0000-00-00', '', 'Mensualidad', '', '', 'No Pagado', 'si', 23, 0),
(67, 15000, 0, 0, '', 1, '2024-06-21', '0000-00-00', '', 'Mensualidad', '', '', 'No Pagado', 'si', 23, 0),
(68, 15000, 0, 0, '', 2, '2024-07-21', '0000-00-00', '', 'Mensualidad', '', '', 'No Pagado', 'si', 23, 0),
(69, 10000, 0, 0, '', 0, '2024-05-23', '2024-05-21', '', 'donación de ingreso', '', 'Efectivo', 'Pagado', 'no', 23, 22),
(73, 10000, 0, 0, '', 0, '2024-05-23', '2024-05-21', '', 'PRIMER PAGO', '', 'Efectivo', 'Pagado', 'no', 23, 22),
(74, 20000, 0, 0, '', 1, '2024-05-02', '0000-00-00', '', 'Mensualidad EFECTIVO', '', '', 'No Pagado', 'no', 20, 0),
(75, 20000, 0, 0, '', 2, '2024-06-02', '0000-00-00', '', 'Mensualidad EFECTIVO', '', '', 'No Pagado', 'no', 20, 0),
(76, 20000, 0, 0, '', 3, '2024-07-02', '0000-00-00', '', 'Mensualidad EFECTIVO', '', '', 'No Pagado', 'no', 20, 0),
(77, 10000, 0, 0, '', 0, '2024-05-23', '2024-04-02', '', 'PRIMER PAGO', '', 'Efectivo', 'Pagado', 'no', 20, 22),
(78, 10000, 0, 0, '', 0, '2024-05-28', '0000-00-00', '', 'TRATAMIENTO', '', 'Efectivo', 'No Pagado', 'no', 23, 22),
(79, 20000, 0, 0, '', 1, '2024-06-06', '2024-06-05', '', 'Mensualidad', '', '', 'Pagado', 'no', 8, 0),
(80, 20000, 0, 0, '', 2, '2024-07-06', '2024-06-06', '', 'Mensualidad', '', '', 'Pagado', 'no', 8, 0),
(81, 20000, 0, 0, '', 3, '2024-08-06', '2024-06-06', '', 'Mensualidad', '', '', 'No Pagado', 'si', 8, 1),
(82, 20000, 0, 0, '', 1, '2024-04-02', '0000-00-00', '', 'Mensualidad', '', '', 'No Pagado', 'no', 24, 0),
(83, 20000, 0, 0, '', 2, '2024-05-02', '0000-00-00', '', 'Mensualidad', '', '', 'No Pagado', 'no', 24, 0),
(84, 20000, 0, 0, '', 3, '2024-06-02', '0000-00-00', '', 'Mensualidad', '', '', 'No Pagado', 'no', 24, 0),
(85, 10000, 0, 0, '', 0, '2024-06-07', '2024-04-02', '', 'donación de ingreso', '', 'Efectivo', 'Pagado', 'no', 24, 22),
(86, 39, 0, 0, '', 0, '2024-06-07', '2024-06-07', '', 'pago de tiendita', '', 'Efectivo', 'Pagado', 'no', 24, 22),
(90, 46, 0, 46, '', 0, '2024-06-13', '2024-06-13', '', 'Consumo en tiendita', '', 'Saldo', 'Pagado', 'no', 8, 1),
(89, 41, 0, 41, '', 0, '2024-06-13', '2024-06-13', '', 'Consumo en tiendita', '', 'Saldo', 'Pagado', 'no', 8, 1),
(91, 45, 0, 45, '', 0, '2024-06-14', '2024-06-14', '', 'Consumo en tiendita', '', 'Saldo', 'Pagado', 'no', 8, 1),
(92, 30, 0, 30, '', 0, '2024-06-14', '2024-06-14', '', 'Consumo en tiendita', '', 'Saldo', 'Pagado', 'no', 8, 1),
(93, 17, 0, 17, '', 0, '2024-06-21', '2024-06-21', '', 'Consumo en tiendita', '', 'Saldo', 'Pagado', 'no', 8, 1),
(94, 72, 0, 72, '', 0, '2024-06-21', '2024-06-21', '', 'Adeudo tiendita', '', 'Saldo', 'Pagado', 'no', 8, 1),
(95, 45, 0, 45, '', 0, '2024-06-21', '2024-06-21', '', 'Adeudo tiendita', '', 'Saldo', 'Pagado', 'no', 8, 1),
(96, 50, 0, 50, '', 0, '2024-06-21', '2024-06-21', '', 'Adeudo tiendita', '', '', 'No Pagado', 'no', 8, 1),
(97, 500, 0, 500, '', 0, '2024-06-21', '2024-06-21', '', '', 'se genero consulta externa por psiquiatria', 'Efectivo', 'No Pagado', 'no', 8, 1),
(98, 600, 0, 600, '', 0, '2024-06-21', '2024-06-21', '', 'peticiones', 'peticion de ropa', 'Efectivo', 'Pagado', 'no', 8, 1),
(99, 500, 0, 500, '', 0, '2024-06-21', '2024-06-14', '', 'medicamento', 'medicina', 'Saldo', 'Pagado', 'no', 8, 1),
(100, 500, 0, 0, '', 0, '2024-06-22', '0000-00-00', '', 'consultas externas', 'se genero consulta externa', 'Efectivo', 'Pagado', 'no', 8, 1),
(101, 500, 0, 500, '', 0, '2024-06-22', '2024-06-14', '', 'consultas externas', 'se llevo al psiquiatra', 'Efectivo', 'Pagado', 'no', 8, 1),
(102, 60, 0, 60, '', 0, '2024-06-25', '2024-06-25', '', 'Adeudo tiendita', '', 'Saldo', 'Pagado', 'no', 8, 1),
(103, 19000, 0, 19000, '', 0, '2024-06-25', '2024-06-25', '', 'otros gastos', 'se le dio descuento', 'Saldo', 'Pagado', 'no', 8, 1),
(104, 1000, 0, 1000, '', 0, '2024-06-25', '2024-06-25', '', 'medicamento', 'queteapina 300 mg', '', 'No Pagado', 'no', 1, 1),
(105, 1000, 0, 1000, '', 0, '2024-06-25', '2024-06-25', '', 'medicamento', 'queteapina 300 mg', '', 'No Pagado', 'no', 8, 1),
(106, 70, 0, 70, '', 0, '2024-06-25', '2024-06-25', '', 'medicamento', 'queteapina', '', 'No Pagado', 'no', 1, 41),
(107, 0, 0, 0, '', 0, '2024-06-25', '2024-06-25', '', 'medicamento', '', '', 'No Pagado', 'no', 1, 41),
(108, 0, 0, 0, '', 0, '2024-06-25', '2024-06-25', '', 'medicamento', '', '', 'No Pagado', 'no', 1, 41),
(109, 70, 0, 70, '', 0, '2024-06-25', '2024-06-25', '', 'medicamento', 'queteapina', '', 'No Pagado', 'no', 1, 41),
(110, 70, 0, 70, '', 0, '2024-06-25', '2024-06-25', '', 'medicamento', 'queteapina', '', 'No Pagado', 'no', 1, 41),
(111, 70, 0, 70, '', 0, '2024-06-25', '2024-06-25', '', 'medicamento', 'queteapina', '', 'No Pagado', 'no', 1, 41),
(112, 70, 0, 70, '', 0, '2024-06-25', '2024-06-25', '', 'medicamento', 'queteapina', '', 'No Pagado', 'no', 24, 1),
(113, 500, 0, 500, '', 0, '2024-06-26', '2024-06-25', '', 'tratamiento', 'tratamiento desde recepcion', 'Deposito Cuenta Lenin', 'No Pagado', 'no', 0, 41),
(114, 500, 0, 500, '', 0, '2024-06-26', '2024-06-25', '', 'medicamento', 'pago desde recepcion', 'Efectivo', 'Pagado', 'no', 0, 41),
(115, 500, 0, 500, '', 0, '2024-06-26', '0000-00-00', '', 'peticiones', 'desde recepcion', 'Efectivo', 'No Pagado', 'no', 24, 41),
(116, 1500, 0, 1500, '', 1, '2024-06-26', '2024-06-26', '', 'Tratamiento', 'pago tratamiento', 'Efectivo', 'Pagado', 'no', 8, 1),
(117, 1500, 0, 0, '', 2, '2024-07-03', '0000-00-00', '', 'Tratamiento', '', '', 'No Pagado', 'no', 8, 0),
(118, 1500, 0, 0, '', 3, '2024-07-10', '0000-00-00', '', 'Tratamiento', '', '', 'No Pagado', 'no', 8, 0);

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

--
-- Volcado de datos para la tabla `peticion_paciente`
--

INSERT INTO `peticion_paciente` (`id_peticion`, `detalle`, `quien_procesa`, `monto`, `estatus`, `id_paciente`, `id_usuario`) VALUES
(1, 'requiere calzado', 'administracion', 0, 'no resuelta', 8, 1),
(2, 'requiere calzado', 'administracion', 500, 'resuelta', 8, 1),
(3, 'requiere ropa', 'administracion', 0, 'resuelta', 8, 41);

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
  `precio_compra` float NOT NULL,
  `imagen` text NOT NULL,
  `tipo_producto` text NOT NULL,
  `estatus` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_producto`, `precio_venta`, `stock`, `titulo`, `descripcion`, `precio_compra`, `imagen`, `tipo_producto`, `estatus`) VALUES
(1, 23, 10, 'MARUCHAN', 'MARUCHAN DE VASO', 0, 'Captura MARUCHAN.JPG', 'tiendita', 1),
(2, 24, 10, 'DORITOS NACHO 62G', 'NACHOS ROJOS', 23, 'DORITOS NACHOS 62 G.JPG', 'tiendita', 1),
(3, 25, 6, 'CHURRUMAIS 200 GMS', 'FRITURAS CHURRUMAIS 200 G', 17, 'churrumais-con-limoncito-d-sabritas.jpg', 'tiendita', 1),
(4, 30, 3, 'CHEETOS POFFS', 'CHEETOS POFFS 25 GMS', 17, 'CHEETOS_POFFS_40GR_540x.webp', 'tiendita', 1),
(5, 30, 17, 'CHEETOS NACHO 52 G', 'CHEETOS NACHO ', 17, 'Fotos-tienda-en-linea-Feb2023_0019_28_540x.webp', 'tiendita', 1),
(7, 22, 0, 'COCA 400 ML', 'COCA  400', 18, '64168e99f9f14a8afc2dc5ec2e1b4d43.webp', 'tiendita', 0),
(8, 0, 5, 'queteapina', 'queteapina 25 mg', 70, 'descarga.jpeg', 'medicina', 1),
(9, 0, 4, 'queteapina 300 mg', 'seroquel', 1000, '7501098605229.jpg', 'medicina', 1),
(10, 13, 10, 'MAMUT', 'MAMUT', 10, 'descarga (1).jpeg', 'tiendita', 1),
(11, 45, 0, 'CREMAX CHOCOLATE ', '213GR', 40, 'descarga (2).jpeg', 'tiendita', 1),
(12, 18, 15, 'MICLH', 'CHOCOLATE', 12, '1218239_S_1280_F.avif', 'tiendita', 1),
(13, 17, 15, 'CARLOS V', 'CHOCOLATE', 10, '00750105863808L.webp', 'tiendita', 1),
(14, 21, 15, 'KARATE', 'CACAHGUATES', 15, '7500478021048_00.webp', 'tiendita', 1),
(15, 21, 15, 'KARATE', 'CACAHGUATES', 15, '7500478021048_00.webp', 'tiendita', 1);

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
(1, 'Se necesita lo siguiente:\r\n\r\npapas,zanahorias esto el otro.', '2024-06-24', 'si', 12),
(2, 'ddddddd', '2024-06-24', 'no', 12);

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
(1, '', '', '', '', '', '', '', '', 0, '0', 2),
(2, '', '', '', '', '', '', '', '', 0, '0', 3),
(3, 'OMAR ADAME', 'PAVEL LANUZA ABOYTES, MIGUEL ABRAHAM SANDOVAL MONTALVAN, LUIS EDUARDO INFANTE ', 'CHARO', '', 'TOYOTA RAP', 'TOYOTA RAP', '', 'FCO I MADERO 124 LA GOLETA MPIO CHARO MICH', 2000, '0', 4),
(4, 'Juan ', 'juan y pablo', 'morelia', 'nissan', 'sedan', 'versa', 'pphy gh', 'centro', 1500, '0', 6),
(5, 'Juan ', 'juan y pablo', 'morelia', 'nissan', 'sedan', 'versa', 'pphy gh', '', 234, '0', 8),
(6, 'ARTURO ANGEL RIVERA', 'PAULINA SILVA PASTOR Y CRISTINA VILLA LARA', 'MORELIA', 'MAZDA', 'AUTOMOVIL SEDAN', '2017', '', 'FRACCIONAMIENTO MIL CUMBRES', 2000, '0', 11),
(7, 'VICTOR PICHO', 'AARON GONZALEZ', 'MORELIA', 'MAZDA', 'AUTOMOVIL SEDAN', '2017', '', 'CACAHUATE #312 COL. LOMAS DE LA HUERTA', 0, '0', 17),
(8, '', '', '', '', '', '', '', '', 0, '0', 21),
(9, 'Victor picho ruiz', 'Jorge A.Pablo,Victor A.Rosas y Hector Pulido', 'Apatzingan', 'Mazda', 'Cedan', '2018', 'PHV 694 B', 'Av.camelinas', 0, '0', 22),
(10, 'VICTOR PICHO RUIZ', 'HECTOR PULIDO,ARMANDO DIAZ, JOSE J PRIETO.', 'NUEVA ITALIA', 'MAZDA', 'SEDAN', '2018', '', 'NUEVA ITALIA', 4000, '0', 23),
(11, 'VICTOR PICHO RUIZ', 'HECTOR PULIDO,ARMANDO DIAZ, JOSE J PRIETO.', 'NUEVA ITALIA', 'MAZDA', 'SEDAN', '2018', 'xxcxvsfs', 'NUEVA ITALIA', 4000, '0', 24),
(12, '', '', '', '', '', '', '', '', 0, '0', 25);

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
(1, 'admin', '$2y$10$8oGNYco.OijaKtzkhg9tveAvDFYjk4VFb8pX9C8W9OLGgKtbyqU9G', 'juan', 'juan', '', '', '0000-00-00', 'SuperAdministrador', 'si'),
(21, 'DANTE TENTORY', '$2y$10$ppVeOQs057t7BpCuhzCa0eUMcd1Bb0lKSqmm/2idDtj9uxhH9w.TG', 'DANTE', 'TENTORY', 'VARGAS', '4434572311', '2010-01-01', 'SuperAdministrador', 'no'),
(18, 'DIRECTOR ADMINISTRATIVO', '3e699c0b1ec623cde7e6', 'DANTE LENIN', 'TENTORY', 'ANDRADE', '4436983798', '2010-01-01', 'SuperAdministrador', 'si'),
(17, 'DIRECTOR GENERAL', 'c2171dc85947a12bae2f', 'DANTE', 'TENTORY', 'VARGAS', '4434572311', '2010-01-01', 'SuperAdministrador', 'no'),
(41, 'recepcion', '$2y$10$tUTA2LjdPGIg097w53ADMenfvAHFIT8UyM7ADBc41QpgYhrTq6A2K', 'recepcion', 'recepcion', 'recepcion', '44454564654', '2024-06-22', 'Recepcion', 'no'),
(8, 'SuperAdministrador', '1648b809adf17103ff89', 'test', 'rss', 'test', '', '2024-01-09', 'SuperAdministrador', 'si'),
(10, 'Psicologo', 'ee5bca16cd9e7528fb52', 'test', 'rss', 'test', '', '2024-01-09', 'Psicologo', 'si'),
(11, 'Medico', '$2y$10$8oGNYco.OijaKtzkhg9tveAvDFYjk4VFb8pX9C8W9OLGgKtbyqU9G', 'test', 'rss', 'test', '', '2024-01-09', 'Medico', 'no'),
(12, 'Cocina', '$2y$10$tUTA2LjdPGIg097w53ADMenfvAHFIT8UyM7ADBc41QpgYhrTq6A2K', 'test', 'rss', 'test', '', '2024-01-09', 'Cocina', 'no'),
(13, 'Tiendita', 'edcb4a791f37dbdb4bcf', 'test', 'rss', 'test', '54564564564', '2024-01-09', 'Tiendita', 'si'),
(14, 'Padrino', '2ebb580ff07d21e7a239', 'Padrino12', 'rss', 'test', '54564564564', '2024-01-09', 'Padrino', 'si'),
(15, 'Vendedor', '$2y$10$4ot7DakaoG4hxYbJ1h7fEuAW0FP10g2.Rh7sOIFEQypjO3G/UHjLC', 'test', 'rss', 'test', '', '2024-01-09', 'Vendedor', 'si'),
(20, 'SUSANA NAVA', '$2y$10$eJ4lhYVoBWTUr.sWA70Os.9YgoTWGtXo19gxCnrzmAWKI9kK3ic4y', 'SUSANA', 'NAVA', 'ANDRADE', '4439358419', '2021-11-15', 'Psicologo', 'no'),
(22, 'LENIN TENTORY', '$2y$10$hDvzzutgPTBRZHa8YqQU1.AV//Bt67QtgelH/x/NEP4yYf4nUF5OO', 'DANTE LENIN', 'TENTORY', 'ANDRADE', '4436983798', '2010-01-01', 'SuperAdministrador', 'no'),
(23, 'DANIEL MATEO', '$2y$10$NuBbkCfk6ua00fT87yXsbO2WI64uO8BzzVojGPz3IcE/ob4OFkv.i', 'DANIEL', 'MATEO', 'GRANADOS', '4432863105', '2023-11-27', 'Administracion', 'no'),
(24, 'ADA GONZALEZ', '$2y$10$1MMlO4oucUCZH.c2SBe9i.5qxPRv/nebSZ4nBk1VXH5oE/ST9xh.2', 'ADA ZULEM', 'GONZALEZ', 'FLORES', '4433490865', '2024-02-29', 'Medico', 'no'),
(25, 'YUNUEN FAJARDO', '$2y$10$JCKKbvzJCswKq3mKvLBXjeP0xEyX5e415s5lnLKMlpuep9dMmOanG', 'ERENDIRA YUNUEN', 'FAJARDO', 'ESPINOZA', '443228975', '2022-08-15', 'Psicologo', 'no'),
(26, 'KARLA RODRIGUEZ', '$2y$10$cw.ZkA2YM7kHG1l9MyN93OTJdKUIbIUberOn1ZMsXqFIfpwV1gNnK', 'KARLA ITZEL', 'RODRIGUEZ', 'GAMIÑO', '4435772231', '2023-01-12', 'Psicologo', 'no'),
(27, 'CRISTINA VILLA', '$2y$10$jIskkGcbI9CEnS9w8uFkzuZsW5CoR5S3dDu3FxbQ6bfgozMCqrPiW', 'CRISTINA VIANETH', 'VILLA', 'LARA', '4431711329', '2023-08-16', 'Vendedor', 'no'),
(28, 'EUNIZE RODRIGUEZ', '$2y$10$6uhyputJAIQbsTURa.FFOOPG/G55P2WFxAPyCJpk6PO.znFAYyYd6', 'BITIA EUNIZE', 'RODRIGUEZ', 'RAMOS', '4431220466', '2024-03-01', 'Vendedor', 'no'),
(29, 'ANA ORTIZ', '$2y$10$anwzueyrkGM0ZgWO4p1ZGOckTDh2cUiddWYs3k1f5eQYaJRC9R2k6', 'ANA LAURA', 'ORTIZ', 'BOLAÑOS', '7861003622', '2022-12-12', 'Psicologo', 'no'),
(30, 'BENJAMIN GONZALEZ', '$2y$10$JXSGedY.cdQOo/Tl5vyc8e0V2VGe7WG5ChvhWTUIT1nj9vzpPR896', 'BENJAMIN ALEJANDRO', 'GONZALEZ', 'PEREZ', '4433809272', '2019-09-04', 'Cocina', 'no'),
(31, 'BRISEIDA LAZARO', '$2y$10$UJMHbv99acXgTef7Z8n/a.6UR0gDIKgWynxDt0MCIK0nYXbi25Fc2', 'BRISEIDA', 'LAZARO', 'CRESCENCIO', '4432395142', '2023-03-29', 'Recepcion', 'no'),
(32, 'PAULINA SILVA', '$2y$10$YpOodVRMf32wHGZpOHv2NudbTIGuZqB.i9s.48ph7mxKYGRdLOFU2', 'PAULINA', 'SILVA', 'PASTOR', '4433839767', '2024-01-04', 'Padrino', 'no'),
(33, 'CESAR ALANIS', '$2y$10$04LwxQcWBBmzFlOMYDlmy.tK2bf96i7VFD26sxGx8UoAo0KOgbLZG', 'CESAR', 'ALANIS', 'ANDRADE', '4436105508', '2024-01-22', 'Padrino', 'no'),
(34, 'AARON GONZALEZ', '$2y$10$feaIYXyX7ViEzw67pp7H6.jVhP2iyms0ksHT.mRDGPftHcwn1ipm6', 'AARON', 'GONZALEZ', 'CUEVAS', '4434026039', '2023-09-19', 'Padrino', 'no'),
(35, 'OMAR MARTINEZ', '$2y$10$j407xijss21e4J9BcYBGHedw5wdH3T6eXFOVjxbhC/qlHqgODzM5m', 'OMAR', 'MARTINEZ', 'ADAME', '4431749160', '2024-01-24', 'Padrino', 'no'),
(36, 'VICTOR PICHO', '$2y$10$8jRabVO.D14IrQ7yctfnT.0S5ALJMpEGJqF9FPw6EsTM.vV4UzyW.', 'VICTOR', 'PICHO', 'RUIZ', '4436112662', '2024-03-18', 'Vendedor', 'no'),
(37, 'ALEJANDRO BEDOLLA', '$2y$10$0jg5bz.VIbUapm1wKuwRYu3LZ0u5BsaMortag5Exe/wjPnbuekC.S', 'ALEJANDRO', 'BEDOLLA', 'ESPINOZA', '4438579275', '2023-05-08', 'Padrino', 'no'),
(38, 'RICARDO MAGAÑA', '$2y$10$FNzWtp.pMxbFnFwSJwsk3.llVQOKGfDmMhTLbQLVbtgaQVl9Lbo1W', 'RICARDO', 'MAGAÑA', 'VIVIAN', '4431819476', '2024-04-01', 'Psicologo', 'no'),
(39, 'psicologo', '$2y$10$E2DNsZ.QObXjVFABeDXRSudvDG3sRydWdipfwPeIjUsV1uEDncK5u', 'test', 'test', 'test', '', '2024-06-14', 'Psicologo', 'si');

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
  MODIFY `id_agenda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `comisiones`
--
ALTER TABLE `comisiones`
  MODIFY `id_comision` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `compras`
--
ALTER TABLE `compras`
  MODIFY `id_compra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `consumo`
--
ALTER TABLE `consumo`
  MODIFY `id_consumo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `contactos`
--
ALTER TABLE `contactos`
  MODIFY `id_contacto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `credito`
--
ALTER TABLE `credito`
  MODIFY `id_credito` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT de la tabla `detalles_orden`
--
ALTER TABLE `detalles_orden`
  MODIFY `id_detalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `id_empleado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `evolucion`
--
ALTER TABLE `evolucion`
  MODIFY `id_evolucion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `historial_saldo`
--
ALTER TABLE `historial_saldo`
  MODIFY `id_historial` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `historia_clinica`
--
ALTER TABLE `historia_clinica`
  MODIFY `id_historia` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ordenes`
--
ALTER TABLE `ordenes`
  MODIFY `id_orden` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  MODIFY `id_paciente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `pagos_empleado`
--
ALTER TABLE `pagos_empleado`
  MODIFY `id_pagos_empleado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `pago_paciente`
--
ALTER TABLE `pago_paciente`
  MODIFY `id_pago` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;

--
-- AUTO_INCREMENT de la tabla `peticion_paciente`
--
ALTER TABLE `peticion_paciente`
  MODIFY `id_peticion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
  MODIFY `id_solicitud` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `traslado_paciente`
--
ALTER TABLE `traslado_paciente`
  MODIFY `id_traslado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
