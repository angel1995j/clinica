-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 04-03-2024 a las 22:22:58
-- Versión del servidor: 10.6.16-MariaDB-cll-lve-log
-- Versión de PHP: 8.1.27

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
(3, '2024-02-16 14:00:00', '56', 3, 11);

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
(1, 'pago de contacto', 245, 34, 'No Pagado', 'no', '2024-02-16', '0000-00-00', 15);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras`
--

CREATE TABLE `compras` (
  `id_compra` int(11) NOT NULL,
  `concepto` text NOT NULL,
  `quien_compra` text NOT NULL,
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
  `id_paciente` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

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
(1, 'VALENTIN ', 'ALVARADO', 'NIETO', '4433283529', 'Cerrado', '', '2024-02-11', 'Frio', 'no', 15);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `credito`
--

CREATE TABLE `credito` (
  `id_credito` int(11) NOT NULL,
  `saldo` float NOT NULL,
  `fecha_actualizacion` date NOT NULL,
  `operacion` text NOT NULL,
  `metodoPago` text NOT NULL,
  `id_paciente` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `credito`
--

INSERT INTO `credito` (`id_credito`, `saldo`, `fecha_actualizacion`, `operacion`, `metodoPago`, `id_paciente`) VALUES
(1, -99, '2024-02-12', 'Compra', 'Tarjeta', 2),
(2, -199, '2024-02-12', 'Ajuste de saldo', 'Efectivo', 2),
(3, 1, '2024-02-12', 'Saldo a favor', 'Efectivo', 2),
(4, -99, '2024-02-12', 'Ajuste de saldo', 'Efectivo', 2),
(5, 1, '2024-02-12', 'Saldo a favor', 'Efectivo', 2),
(6, 500, '2024-02-16', 'Saldo a favor', 'Efectivo', 3),
(7, 387, '2024-02-15', 'Compra', 'Tarjeta', 3),
(8, 200, '2024-02-26', 'Saldo a favor', 'Efectivo', 6);

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
(4, 2, 2, 3, 30.00, 90.00);

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
  `archivado` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`id_empleado`, `nombre`, `aPaterno`, `aMaterno`, `numero_telefono`, `fecha_ingreso`, `fecha_salida`, `puesto`, `salario_bruto`, `salario_neto`, `otros_conceptos`, `monto_otros_conceptos`, `archivado`) VALUES
(1, 'VICTOR YOSIMAR', 'HERREJON', 'PEÑA', '4431369104', '2024-10-01', '0000-00-00', '', 10000.00, 9999.00, '', 0.00, 'no');

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
  `total` decimal(10,2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `ordenes`
--

INSERT INTO `ordenes` (`id_orden`, `id_paciente`, `fecha_creacion`, `total`) VALUES
(1, 2, '2024-02-12 23:26:37', 99.00),
(2, 3, '2024-02-15 18:28:45', 113.00);

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
  `archivado` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `pacientes`
--

INSERT INTO `pacientes` (`id_paciente`, `nombre`, `aPaterno`, `aMaterno`, `fechaNacimiento`, `sexo`, `edad`, `direccion`, `telefono`, `nacionalidad`, `estadoCivil`, `escolaridad`, `ocupacion`, `ingresosPrevios`, `fechasIngresosPrevios`, `institucionRefiere`, `nombreReferencia`, `fechaIngreso`, `horaIngreso`, `hojaReferencia`, `tipoIngreso`, `revisionFisicaGeneral`, `vestimentaIngreso`, `pertenenciasIngreso`, `ultimoConsumo`, `intoxicado`, `estatus`, `nombreFamiliar`, `edadFamiliar`, `ocupacionFamiliar`, `parentescoFamiliar`, `direccionFamiliar`, `identificacionFamiliar`, `correoFamiliar`, `telefonoFamiliar`, `sustanciaPsicoactiva`, `tiempoSustanciaPsicoactiva`, `enfermedades`, `hospitalizacionesRecientes`, `centroReclusion`, `asistenciaGrupos`, `restriccionesConsumo`, `codigoUnico`, `archivado`) VALUES
(1, 'ROBERTO', 'GARCIA', 'HIERRO', '1999-12-18', 'Masculino', 24, 'YUCATAN #160 MOLINO DE PARRAS, MORELIA, MICHOACAN.', '4434059382', 'MEXICANA', 'Soltero(a)', 'Preparatoria', 'N/A', '2', '', 'No', '', '2023-01-25', '15:00', 'No', 'Involuntario', '', '', '', '', 'No', 1, 'MARIVEL HIERRO HUERTA', '53', 'MAESTRA', 'MAMÁ', 'CALLE YUCATAN #160 MOLINO DE PARRAS, MORELIA, MICHOACAN.', 'INE', '', '', 'METANFETAMINA', '2 años', 'INFECCION PULMONAR', 'N/A', 'NO', 'NO', '', '08eef73b78e3c197be106ed6c73c763f378542ed', 'no'),
(2, 'ROBERTO', 'GARCIA', 'HIERRO', '1999-12-18', 'Masculino', 24, 'YUCATAN #160 MOLINO DE PARRAS, MORELIA, MICHOACAN.', '4432863105', 'MEXICANA', 'Soltero(a)', 'Preparatoria', 'N/A', '2', '', 'No', '', '2023-01-25', '15:00', 'No', 'Involuntario', '', '', '', '2023-01-20', 'Si', 1, 'MARIVEL HIERRO HUERTA', '53', 'MAESTRA', '', 'CALLE YUCATAN #160 MOLINO DE PARRAS, MORELIA, MICHOACAN.', 'INE', 'marvel.hierro@yahoo.com.mx', '4432863105', 'METANFETAMINA', '2 años', 'INFECCION PULMONAR', 'N/A', 'NO', 'NO', '', '55e34b2c6f8054f65e52e7311aedb27b404f801a', 'no'),
(3, 'PEDRO', 'CORIA BALTAZAR', 'baltazar', '1998-08-17', 'Masculino', 25, 'Calle  Porfirio Parra # 78 Fraccionamiento Peña Blanca  C.P. 58095 Morelia, Michoacán', '4433687906', '', 'Soltero(a)', 'Licenciatura', 'Mercadotecnia', 'Ninguno', '', 'No', '', '2023-09-22', '19:30', 'No', 'Voluntario', 'DOS PERFORACIONES EN OREJAS CICATRIZ EN RODILLAS9 TATUAJES ', 'PANTALON NEGROPLAYERA BLANCA TENNIS NEGROS ADIDAS', 'NINGUNO', '2023-09-2023', 'No', 1, 'BLANCA LIVIER BALTAZAR GOMEZ', '53', 'AMA DE CASA', 'MAMÁ', 'Calle  Porfirio Parra # 78 Fraccionamiento Peña Blanca  C.P. 58095 Morelia, Michoacán', 'INE', 'NA', '4436983798', 'marihuana y alcohol', '2 años', 'no', 'no', 'no', 'no', 'NO FUMAR', 'f73e03206e1e13d6f3750d27f9b041319a13a801', 'no'),
(4, 'VALENTIN', 'ALVARADO', 'NIETO', '', 'Masculino', 32, 'FCO I MADERO 124 LA GOLETA MPIO CHARO MICH', '4433283529', 'MEXICANO', 'Soltero(a)', 'Preparatoria', 'SOLDADOR', '0', '', 'No', '', '2024-02-11', '01:00', 'No', 'Involuntario', '2 TATUAJES EN LA ESPALDA 1 PERFORACION PEQUEÑA OIDO', 'PLAYERA AZUL MARINO, BERMUDA CAFE, CALCETINES GRISES, SANDALIAS NEGRAS', 'NINGUNA', '2024-02-04', 'No', 1, 'ARTURO ALVARADO', '78', 'comerciante', '', 'FCO I MADERO  124 LA GOLETA MPIO CHARO MICH', '034806927171225', 'NA', '4433283529', 'CRISTAL', '7 A 8 AÑOS', 'NO', 'NO', 'NO', 'NO', '', '4a823cb0253e5206fa0ec7e4e7c18ea7232149d2', 'no'),
(5, 'LUIS EDUARDO', 'INFANTE ', 'RUIZ', '', 'Masculino', 0, '', '', '', 'Soltero(a)', 'Primaria', '', '', '', '', '', '', '', 'No', '', '', '', '', '', 'No', 1, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '04cc37e31e71fa29ed6f533c2d38be2ae9f090c8', 'no'),
(6, 'TESTXXX', 'TEST', 'TESTx', '2024-02-23', 'Masculino', 23, 'test', '54564564564', 'mexicano', 'Divorciado(a)', 'Primaria', 'test', '2', '2023/02/02', 'Si', 'test', '2024-03-02', '01:02', 'No', '', '', '', '', '2024-02-23', 'Si', 1, 'Salvador', '23', 'medico', '', '', 'INE 454655646544', '', '', 'cocaina', '2 años', 'diabetes', '1', 'cereso', 'asistencia a AA', '', 'ac6157ae767d02be6cf60f28917357a6539d09bb', 'no'),
(8, 'TEST2', 'TEST2', '', '', 'Masculino', 0, '', '', '', 'Soltero(a)', 'Primaria', '', '', '', '', '', '2000-02-02', '12:25', 'No', '', '', '', '', '', 'No', 1, 'xxxxxx', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'e753b2cb5c2ff0db3a46ac5beeb4fc5e69e7a0fa', 'No');

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
  `forma_pago` text NOT NULL,
  `estatus` text NOT NULL,
  `archivado` text DEFAULT NULL,
  `id_paciente` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `pago_paciente`
--

INSERT INTO `pago_paciente` (`id_pago`, `monto`, `descuento`, `total`, `comprobante`, `numero_pago`, `fecha_agregado`, `fecha_pagado`, `periodicidad`, `observaciones`, `forma_pago`, `estatus`, `archivado`, `id_paciente`, `id_usuario`) VALUES
(1, 25000, 0, 0, '', 1, '2024-03-12', '2023-03-01', '', 'Mensualidad', 'Efectivo', 'Pagado', 'no', 2, 8),
(2, 10000, 0, 0, '', 2, '2024-04-12', '2023-07-22', '', 'Mensualidad', 'Efectivo', 'Pagado', 'no', 2, 8),
(3, 20000, 0, 0, '', 3, '2024-05-12', '2023-06-24', '', 'Mensualidad', 'Transferencia', 'Pagado', 'no', 2, 8),
(4, 20000, 0, 0, '', 4, '2024-06-12', '2023-12-30', '', 'Mensualidad', 'Efectivo', 'Pagado', 'no', 2, 8),
(5, 20000, 0, 0, '', 5, '2024-07-12', '2024-01-06', '', 'Mensualidad', 'Efectivo', 'Pagado', 'no', 2, 8),
(6, 120000, 0, 0, '', 6, '2024-08-12', '0000-00-00', '', 'Mensualidad', '', 'No Pagado', 'no', 2, 0),
(7, 20350, 0, 0, '', 0, '2024-02-12', '2023-01-26', '', 'donación de ingreso', 'Efectivo', 'Pagado', 'no', 2, 8),
(8, 1, 0, 1, '', 0, '2024-02-12', '2024-02-12', '', 'Saldo a favor en tiendita', 'Efectivo', 'Pagado', 'No', 2, 8),
(9, 1, 0, 1, '', 0, '2024-02-12', '2024-02-12', '', 'Saldo a favor en tiendita', 'Efectivo', 'Pagado', 'No', 2, 8),
(10, 25650, 0, 0, '', 1, '2024-03-13', '0000-00-00', '', 'Mensualidad', '', 'No Pagado', 'no', 3, 0),
(11, 25650, 0, 0, '', 2, '2024-04-13', '0000-00-00', '', 'Mensualidad', '', 'No Pagado', 'no', 3, 0),
(12, 25650, 0, 0, '', 3, '2024-05-13', '0000-00-00', '', 'Mensualidad', '', 'No Pagado', 'no', 3, 0),
(13, 500, 0, 500, '', 0, '2024-02-15', '2024-02-15', '', 'Saldo a favor en tiendita', 'Efectivo', 'Pagado', 'No', 3, 8),
(14, 60000, 0, 0, '', 1, '2024-03-16', '0000-00-00', '', 'Mensualidad', '', 'No Pagado', 'no', 4, 0),
(15, 60000, 0, 0, '', 0, '2024-02-16', '2024-03-11', '', 'donación de ingreso', 'Efectivo', 'No Pagado', 'no', 4, 16),
(16, 60000, 0, 0, '', 0, '2024-02-16', '2024-02-13', '', 'Se le dio oportunidad de 15 días para pagar de contado ', 'Efectivo', 'No Pagado', 'no', 4, 16),
(17, 1300, 0, 0, '', 1, '2024-03-24', '0000-00-00', '', 'Mensualidad', '', 'No Pagado', 'no', 6, 0),
(18, 1300, 0, 0, '', 2, '2024-04-24', '0000-00-00', '', 'Mensualidad', '', 'No Pagado', 'no', 6, 0),
(19, 1200, 0, 0, '', 0, '2024-02-24', '0000-00-00', '', 'donación de ingreso', 'Efectivo', 'Pagado', 'no', 6, 1),
(20, 1200, 0, 0, '', 0, '2024-02-24', '0000-00-00', '', 'donaciones adicionales', 'Efectivo', 'Pagado', 'no', 6, 1),
(21, 500, 0, 0, '', 0, '2024-02-26', '0000-00-00', '', 'nuevo pago', 'Efectivo', 'No Pagado', 'no', 6, 1),
(22, 200, 0, 200, '', 0, '2024-02-26', '2024-02-26', '', 'Saldo a favor en tiendita', 'Efectivo', 'Pagado', 'No', 6, 1),
(23, 500, 0, 0, '', 1, '2024-03-05', '0000-00-00', '', 'Mensualidad', '', 'No Pagado', 'no', 8, 0),
(24, 23, 0, 0, '', 1, '2024-03-05', '0000-00-00', '', 'Mensualidad', '', 'No Pagado', 'no', 8, 0),
(25, 234, 0, 0, '', 0, '2024-02-27', '0000-00-00', '', 'donación de ingreso', 'Efectivo', 'Pagado', 'no', 8, 15),
(26, 1, 0, 0, '', 0, '2024-02-27', '0000-00-00', '', 'donaciones adicionales', 'Efectivo', 'Pagado', 'no', 8, 15);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `peticion_paciente`
--

CREATE TABLE `peticion_paciente` (
  `id_peticion` int(11) NOT NULL,
  `detalle` text NOT NULL,
  `quien_procesa` text NOT NULL,
  `monto` int(11) NOT NULL,
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
(2, 30, 10, 'DORITOS NACHO 62G', 'NACHOS ROJOS', 23, 'DORITOS NACHOS 62 G.JPG', 'tiendita', 1),
(3, 25, 6, 'CHURRUMAIS 200 GMS', 'FRITURAS CHURRUMAIS 200 G', 17, 'churrumais-con-limoncito-d-sabritas.jpg', 'tiendita', 1),
(4, 30, 3, 'CHEETOS POFFS', 'CHEETOS POFFS 25 GMS', 17, 'CHEETOS_POFFS_40GR_540x.webp', 'tiendita', 1),
(5, 30, 17, 'CHEETOS NACHO 52 G', 'CHEETOS NACHO ', 17, 'Fotos-tienda-en-linea-Feb2023_0019_28_540x.webp', 'tiendita', 1);

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
(5, 'Juan ', 'juan y pablo', 'morelia', 'nissan', 'sedan', 'versa', 'pphy gh', '', 234, '0', 8);

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
(1, 'admin', '$2y$10$A1nJqMnA5JI.E9oulM092.eONB.MAvDr448pa5L5rh9.hsePRRJxm', 'juan', 'juan', '', '', '0000-00-00', 'SuperAdministrador', 'no'),
(16, 'recepcion', '$2y$10$O7tE2eLf4qxKcP/aDvLqduCMRk0ZQ4QidsJmuLibrD.Bp.wU1C1H6', 'Cristi', 'test', 'test', '', '2024-02-16', 'Recepcion', 'no'),
(8, 'SuperAdministrador', '$2y$10$LaAoKN7OC3St7fXY7i04kevG2cc7bJJPXxToBv7rHmIa5HebzZvPW', 'test', 'rss', 'test', '', '2024-01-09', 'SuperAdministrador', 'no'),
(10, 'Psicologo', '$2y$10$YP7p4f79Jg2NM0ocoe5v4.IFor5Zp1jkvrfKopvrTkilidO2u0Pce', 'test', 'rss', 'test', '', '2024-01-09', 'Psicologo', 'no'),
(11, 'Medico', '$2y$10$YvFDrPUhBa1ceISAhzxnYudoqrlS8gmN/LsWoS2oeJjxFLqj5bvoS', 'test', 'rss', 'test', '', '2024-01-09', 'Medico', 'no'),
(12, 'Cocina', '$2y$10$PQ4Sm6DQwo148pW8VXNgYeoThjcwEGKSJ58ZWz2t8uyXkml5Q.os6', 'test', 'rss', 'test', '', '2024-01-09', 'Cocina', 'no'),
(13, 'Tiendita', '$2y$10$rMo9XSzLYmn3wVY4xKt/2OmhhfGPGPXoQFEgcq0wrOp2E7rB9IGCO', 'test', 'rss', 'test', '54564564564', '2024-01-09', 'Tiendita', 'no'),
(14, 'Padrino', '$2y$10$RyFmPQZ17gVDXBRODEihquc5ky/1zwWm1vmFXpHpxQxB6/1pUWc46', 'Padrino12', 'rss', 'test', '54564564564', '2024-01-09', 'Padrino', 'no'),
(15, 'Vendedor', '$2y$10$4ot7DakaoG4hxYbJ1h7fEuAW0FP10g2.Rh7sOIFEQypjO3G/UHjLC', 'test', 'rss', 'test', '', '2024-01-09', 'Vendedor', 'no');

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
  MODIFY `id_agenda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `comisiones`
--
ALTER TABLE `comisiones`
  MODIFY `id_comision` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `compras`
--
ALTER TABLE `compras`
  MODIFY `id_compra` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `consumo`
--
ALTER TABLE `consumo`
  MODIFY `id_consumo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `contactos`
--
ALTER TABLE `contactos`
  MODIFY `id_contacto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `credito`
--
ALTER TABLE `credito`
  MODIFY `id_credito` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `detalles_orden`
--
ALTER TABLE `detalles_orden`
  MODIFY `id_detalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `id_empleado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `evolucion`
--
ALTER TABLE `evolucion`
  MODIFY `id_evolucion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `historia_clinica`
--
ALTER TABLE `historia_clinica`
  MODIFY `id_historia` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ordenes`
--
ALTER TABLE `ordenes`
  MODIFY `id_orden` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  MODIFY `id_paciente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `pagos_empleado`
--
ALTER TABLE `pagos_empleado`
  MODIFY `id_pagos_empleado` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pago_paciente`
--
ALTER TABLE `pago_paciente`
  MODIFY `id_pago` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

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
  MODIFY `id_solicitud` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `traslado_paciente`
--
ALTER TABLE `traslado_paciente`
  MODIFY `id_traslado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
