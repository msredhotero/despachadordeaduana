-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 15-11-2017 a las 14:47:57
-- Versión del servidor: 5.5.24-log
-- Versión de PHP: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `teatrociego`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dbalbumobras`
--

CREATE TABLE IF NOT EXISTS `dbalbumobras` (
  `idalbumobra` int(11) NOT NULL AUTO_INCREMENT,
  `refobras` int(11) NOT NULL DEFAULT '0',
  `refalbum` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idalbumobra`),
  KEY `fk_ao_obras` (`refobras`),
  KEY `fk_ao_album` (`refalbum`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `dbalbumobras`
--

INSERT INTO `dbalbumobras` (`idalbumobra`, `refobras`, `refalbum`) VALUES
(1, 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dbcategorias`
--

CREATE TABLE IF NOT EXISTS `dbcategorias` (
  `idcategoria` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(120) COLLATE utf8_spanish_ci NOT NULL,
  `refobras` int(11) NOT NULL,
  `refcuponeras` int(11) NOT NULL,
  `porcentaje` decimal(5,2) DEFAULT NULL,
  `monto` decimal(10,2) DEFAULT NULL,
  `pocentajeretenido` decimal(5,2) DEFAULT NULL,
  PRIMARY KEY (`idcategoria`),
  KEY `fk_categorias_obras_idx` (`refobras`),
  KEY `fk_categorias_cuponeras_idx` (`refcuponeras`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=43 ;

--
-- Volcado de datos para la tabla `dbcategorias`
--

INSERT INTO `dbcategorias` (`idcategoria`, `descripcion`, `refobras`, `refcuponeras`, `porcentaje`, `monto`, `pocentajeretenido`) VALUES
(10, 'Big Box', 4, 3, '0.00', '0.00', '36.00'),
(11, 'Flipaste', 4, 4, '0.00', '0.00', '20.00'),
(12, 'Groupon', 4, 2, '37.63', '0.00', '24.00'),
(13, 'T Hoy', 4, 5, '20.00', '0.00', '20.00'),
(14, 'Groupon', 8, 2, '35.10', '0.00', '24.20'),
(15, 'Flipaste', 8, 4, '0.00', '0.00', '20.00'),
(16, 'Atrapalo', 1, 1, '40.00', '0.00', '16.66'),
(17, 'Groupon', 1, 2, '51.08', '0.00', '24.20'),
(18, 'Ticket Hoy', 1, 5, '30.00', '0.00', '20.00'),
(19, 'Atrapalo', 5, 1, '40.00', '0.00', '16.66'),
(20, 'Groupon', 5, 2, '51.08', '0.00', '24.20'),
(21, 'Ticket Hoy', 5, 5, '30.00', '0.00', '20.00'),
(22, 'Atrapalo', 7, 1, '40.00', '0.00', '16.66'),
(23, 'Groupon', 7, 2, '51.08', '0.00', '24.20'),
(24, 'Ticket Hoy', 7, 5, '30.00', '0.00', '20.00'),
(25, 'Atrapalo', 3, 1, '40.00', '0.00', '16.66'),
(26, 'Groupon', 3, 2, '51.08', '0.00', '24.20'),
(27, 'Ticket Hoy', 3, 5, '30.00', '0.00', '20.00'),
(28, 'Atrapalo', 6, 1, '40.00', '0.00', '16.66'),
(29, 'Groupon', 6, 2, '50.00', '0.00', '24.20'),
(30, 'Flipaste', 6, 4, '20.00', '0.00', '20.00'),
(31, 'Ticket Hoy', 6, 5, '30.00', '0.00', '20.00'),
(32, 'Atrapalo', 2, 1, '50.00', '0.00', '16.66'),
(33, 'Vuenoz', 2, 6, '50.00', '0.00', '15.00'),
(34, 'Groupon', 2, 2, '50.00', '0.00', '24.20'),
(35, 'Cartelera', 1, 7, '90.00', '0.00', '0.00'),
(36, 'Cartelera', 2, 7, '90.00', '0.00', '0.00'),
(37, 'Cartelera', 3, 7, '90.00', '0.00', '0.00'),
(38, 'Cartelera', 5, 7, '90.00', '0.00', '0.00'),
(41, 'Cartelera', 6, 7, '90.00', '0.00', '0.00'),
(42, 'Cartelera', 7, 7, '90.00', '0.00', '0.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dbclientes`
--

CREATE TABLE IF NOT EXISTS `dbclientes` (
  `idcliente` int(11) NOT NULL AUTO_INCREMENT,
  `nombrecompleto` varchar(120) NOT NULL,
  `cuil` varchar(11) DEFAULT NULL,
  `dni` varchar(8) DEFAULT NULL,
  `direccion` varchar(50) DEFAULT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `email` varchar(120) DEFAULT NULL,
  `observaciones` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`idcliente`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `dbclientes`
--

INSERT INTO `dbclientes` (`idcliente`, `nombrecompleto`, `cuil`, `dni`, `direccion`, `telefono`, `email`, `observaciones`) VALUES
(1, 'Saupurein Marcos', '20315524661', '31552466', '76', '4661100', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dbcooperativas`
--

CREATE TABLE IF NOT EXISTS `dbcooperativas` (
  `idcooperativa` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(130) COLLATE utf8_spanish_ci NOT NULL,
  `numero` varchar(10) COLLATE utf8_spanish_ci DEFAULT NULL,
  `puntos` decimal(3,1) NOT NULL,
  `puntosproduccion` int(11) NOT NULL,
  `puntossinproduccion` int(11) NOT NULL,
  `fechacreacion` date DEFAULT NULL,
  `usuacrea` varchar(60) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fechamodi` date DEFAULT NULL,
  `usuamodi` varchar(60) COLLATE utf8_spanish_ci DEFAULT NULL,
  `activo` bit(1) DEFAULT NULL,
  PRIMARY KEY (`idcooperativa`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=20 ;

--
-- Volcado de datos para la tabla `dbcooperativas`
--

INSERT INTO `dbcooperativas` (`idcooperativa`, `descripcion`, `numero`, `puntos`, `puntosproduccion`, `puntossinproduccion`, `fechacreacion`, `usuacrea`, `fechamodi`, `usuamodi`, `activo`) VALUES
(3, 'Luces, La Revolución (Viernes y Sabados)', '1000', '10.0', 0, 0, '2017-11-08', 'Saupurein Marcos', '0000-00-00', '', b'1'),
(4, 'Luces, La Revolución (Domingos)', '1000', '10.0', 0, 0, '2017-11-08', 'Saupurein Marcos', '0000-00-00', '', b'1'),
(5, 'A Ciegas Gourmet (Martes)', '1001', '9.0', 0, 0, '2017-11-08', 'Saupurein Marcos', '0000-00-00', '', b'1'),
(6, 'A Ciegas Gourmet (Miercoles y Domingos)', '1001', '9.0', 0, 0, '2017-11-08', 'Saupurein Marcos', '0000-00-00', '', b'1'),
(7, 'A Ciegas Gourmet (Jueves, Viernes y Sabados)', '1001', '9.0', 0, 0, '2017-11-08', 'Saupurein Marcos', '2017-11-09', 'Saupurein Marcos', b'1'),
(8, 'Babilonia Fx (viernes)', '1002', '15.0', 0, 0, '2017-11-08', 'Saupurein Marcos', '0000-00-00', '', b'1'),
(9, 'Babilonia Fx (sabados)', '1002', '15.0', 0, 0, '2017-11-08', 'Saupurein Marcos', '0000-00-00', '', b'1'),
(10, 'Babilonia Fx (domingos)', '1002', '15.0', 0, 0, '2017-11-08', 'Saupurein Marcos', '0000-00-00', '', b'1'),
(11, 'El Infinito silencio (Jueves)', '1003', '10.5', 0, 0, '2017-11-08', 'Saupurein Marcos', '0000-00-00', '', b'1'),
(12, 'El Infinito silencio (Sabados)', '1003', '10.5', 0, 0, '2017-11-09', 'Saupurein Marcos', '2017-11-09', 'Saupurein Marcos', b'1'),
(13, 'El Infinito silencio (viernes)', '1003', '10.5', 0, 0, '2017-11-09', 'Saupurein Marcos', '0000-00-00', '', b'1'),
(14, 'El Infinito silencio (domingo)', '1003', '10.5', 0, 0, '2017-11-09', 'Saupurein Marcos', '0000-00-00', '', b'1'),
(15, 'Mi amiga la oscuridad', '1004', '9.0', 0, 0, '2017-11-09', 'Saupurein Marcos', '0000-00-00', '', b'1'),
(16, 'Inodoro Pereyra a ciegas - Miercoles', '1005', '9.0', 0, 0, '2017-11-09', 'Saupurein Marcos', '0000-00-00', '', b'1'),
(17, 'Inodoro Pereyra a ciegas (Jueves)', '1005', '9.0', 0, 0, '2017-11-09', 'Saupurein Marcos', '0000-00-00', '', b'1'),
(18, 'Inodoro Pereyra a ciegas (Viernes y sábados)', '1005', '9.0', 0, 0, '2017-11-09', 'Saupurein Marcos', '0000-00-00', '', b'1'),
(19, 'Sonido 360', '1008', '1.0', 0, 0, '2017-11-09', 'Saupurein Marcos', '0000-00-00', '', b'1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dbdatosbancos`
--

CREATE TABLE IF NOT EXISTS `dbdatosbancos` (
  `iddatobanco` int(11) NOT NULL AUTO_INCREMENT,
  `refpersonal` int(11) NOT NULL,
  `cbu` varchar(22) COLLATE utf8_spanish_ci NOT NULL,
  `nrocuenta` varchar(7) COLLATE utf8_spanish_ci NOT NULL,
  `tipoproducto` varchar(130) COLLATE utf8_spanish_ci DEFAULT NULL,
  `formaoperar` varchar(130) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fechacrea` date DEFAULT NULL,
  `usuacrea` varchar(120) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fechamodi` date DEFAULT NULL,
  `usuamodi` varchar(120) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`iddatobanco`),
  KEY `fk_datosbanco_personal_idx` (`refpersonal`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dbdomicilios`
--

CREATE TABLE IF NOT EXISTS `dbdomicilios` (
  `iddomicilio` int(11) NOT NULL AUTO_INCREMENT,
  `refpersonal` int(11) DEFAULT NULL,
  `calle` varchar(190) COLLATE utf8_spanish_ci DEFAULT NULL,
  `nro` varchar(8) COLLATE utf8_spanish_ci DEFAULT NULL,
  `piso` int(11) DEFAULT NULL,
  `departamento` varchar(5) COLLATE utf8_spanish_ci DEFAULT NULL,
  `codigopostal` varchar(10) COLLATE utf8_spanish_ci DEFAULT NULL,
  `localidad` varchar(120) COLLATE utf8_spanish_ci DEFAULT NULL,
  `provincia` varchar(120) COLLATE utf8_spanish_ci DEFAULT NULL,
  `telefonoparticular` varchar(15) COLLATE utf8_spanish_ci DEFAULT NULL,
  `telefonocelular` varchar(15) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`iddomicilio`),
  KEY `fk_domicilio_personal_idx` (`refpersonal`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dbfunciones`
--

CREATE TABLE IF NOT EXISTS `dbfunciones` (
  `idfuncion` int(11) NOT NULL AUTO_INCREMENT,
  `refobras` int(11) NOT NULL,
  `refcooperativas` int(11) NOT NULL,
  `horario` time NOT NULL,
  `refdias` int(11) NOT NULL,
  `activo` bit(1) DEFAULT NULL,
  PRIMARY KEY (`idfuncion`),
  KEY `fk_funcion_obras_idx` (`refobras`),
  KEY `fk_funcion_cooperativa_idx` (`refcooperativas`),
  KEY `fk_funciones_dias_idx` (`refdias`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=46 ;

--
-- Volcado de datos para la tabla `dbfunciones`
--

INSERT INTO `dbfunciones` (`idfuncion`, `refobras`, `refcooperativas`, `horario`, `refdias`, `activo`) VALUES
(4, 2, 19, '19:00:00', 1, NULL),
(5, 2, 19, '20:10:00', 1, NULL),
(6, 2, 19, '21:30:00', 1, NULL),
(7, 2, 19, '19:30:00', 2, NULL),
(8, 2, 19, '20:30:00', 2, NULL),
(9, 2, 19, '21:30:00', 2, NULL),
(10, 8, 5, '21:00:00', 2, NULL),
(11, 2, 19, '19:30:00', 3, NULL),
(12, 2, 19, '20:30:00', 3, NULL),
(13, 2, 19, '21:40:00', 3, NULL),
(14, 8, 6, '21:00:00', 3, NULL),
(15, 2, 19, '19:30:00', 4, NULL),
(16, 2, 19, '20:30:00', 4, NULL),
(17, 2, 19, '21:20:00', 4, NULL),
(18, 8, 7, '21:00:00', 4, NULL),
(19, 7, 17, '21:00:00', 4, NULL),
(20, 5, 11, '22:00:00', 4, NULL),
(21, 2, 19, '19:00:00', 5, NULL),
(22, 2, 19, '21:00:00', 5, NULL),
(23, 2, 19, '22:20:00', 5, NULL),
(24, 2, 19, '23:10:00', 5, NULL),
(25, 8, 7, '21:00:00', 5, NULL),
(26, 7, 18, '21:00:00', 5, NULL),
(27, 3, 3, '22:00:00', 5, NULL),
(28, 1, 8, '23:00:00', 5, NULL),
(29, 6, 15, '15:30:00', 6, NULL),
(30, 6, 15, '17:00:00', 6, NULL),
(31, 2, 19, '19:00:00', 6, NULL),
(32, 2, 19, '20:20:00', 6, NULL),
(33, 2, 19, '21:20:00', 6, NULL),
(34, 2, 19, '22:20:00', 6, NULL),
(35, 2, 19, '23:20:00', 6, NULL),
(36, 8, 7, '21:00:00', 6, NULL),
(37, 3, 3, '21:00:00', 6, NULL),
(38, 7, 18, '22:00:00', 6, NULL),
(39, 5, 12, '23:00:00', 6, NULL),
(40, 1, 9, '23:50:00', 6, NULL),
(41, 6, 15, '17:00:00', 7, NULL),
(42, 5, 14, '18:00:00', 7, NULL),
(43, 3, 4, '19:00:00', 7, NULL),
(44, 1, 10, '20:00:00', 7, NULL),
(45, 8, 6, '21:00:00', 7, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dbgastosobras`
--

CREATE TABLE IF NOT EXISTS `dbgastosobras` (
  `idgastoobra` int(11) NOT NULL AUTO_INCREMENT,
  `reffunciones` int(11) NOT NULL,
  `descripcion` varchar(120) COLLATE utf8_spanish_ci NOT NULL,
  `monto` decimal(18,2) NOT NULL,
  `fecha` date DEFAULT NULL,
  `fechacreacion` date DEFAULT NULL,
  `usuacrea` varchar(60) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`idgastoobra`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dbobras`
--

CREATE TABLE IF NOT EXISTS `dbobras` (
  `idobra` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(160) COLLATE utf8_spanish_ci NOT NULL,
  `refsalas` int(11) NOT NULL,
  `valorentrada` decimal(18,2) NOT NULL,
  `cantpulicidad` int(11) NOT NULL,
  `valorpulicidad` decimal(18,2) DEFAULT NULL,
  `valorticket` decimal(18,2) DEFAULT NULL,
  `costotranscciontarjetaiva` decimal(18,2) DEFAULT NULL,
  `porcentajeargentores` decimal(5,2) DEFAULT NULL,
  `porcentajereparto` decimal(5,2) DEFAULT NULL,
  `porcentajeretencion` decimal(5,2) DEFAULT NULL,
  `fechacreacion` date DEFAULT NULL,
  `usuacrea` varchar(60) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fechamodi` date DEFAULT NULL,
  `usuamodi` varchar(60) COLLATE utf8_spanish_ci DEFAULT NULL,
  `activo` bit(1) DEFAULT NULL,
  `refsedes` int(11) NOT NULL,
  PRIMARY KEY (`idobra`),
  KEY `fk_obras_salas_idx` (`refsalas`),
  KEY `fk_obras_sedes_idx` (`refsedes`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=9 ;

--
-- Volcado de datos para la tabla `dbobras`
--

INSERT INTO `dbobras` (`idobra`, `nombre`, `refsalas`, `valorentrada`, `cantpulicidad`, `valorpulicidad`, `valorticket`, `costotranscciontarjetaiva`, `porcentajeargentores`, `porcentajereparto`, `porcentajeretencion`, `fechacreacion`, `usuacrea`, `fechamodi`, `usuamodi`, `activo`, `refsedes`) VALUES
(1, 'Babilonia FX', 1, '300.00', 2, '600.00', '2.00', '6.05', '10.00', '70.00', '6.00', '2017-05-04', 'Saupurein Marcos', '2017-11-14', 'Saupurein Marcos', b'1', 1),
(2, 'Sonido 360', 1, '100.00', 2, '200.00', '1.50', '6.05', '0.00', '70.00', '0.00', '2017-05-04', 'Saupurein Marcos', '2017-06-06', 'Saupurein Marcos', b'1', 1),
(3, 'Luces, La Revolución', 1, '325.00', 2, '650.00', '2.00', '6.05', '10.00', '70.00', '6.00', '2017-11-08', 'Saupurein Marcos', '0000-00-00', '', b'1', 1),
(4, 'A Ciegas Gourmet', 2, '1000.00', 2, '2000.00', '1.00', '6.05', '10.00', '70.00', '6.00', '2017-11-08', 'Saupurein Marcos', '0000-00-00', '', b'1', 2),
(5, 'El Infinito silencio', 1, '325.00', 2, '650.00', '1.00', '6.05', '10.00', '70.00', '6.00', '2017-11-08', 'Saupurein Marcos', '0000-00-00', '', b'1', 1),
(6, 'Mi amiga la oscuridad', 2, '300.00', 2, '600.00', '1.00', '6.05', '10.00', '70.00', '6.00', '2017-11-08', 'Saupurein Marcos', '0000-00-00', '', b'1', 1),
(7, 'Inodoro Pereyra a Ciegas', 2, '325.00', 2, '650.00', '1.00', '6.05', '10.00', '70.00', '6.00', '2017-11-08', 'Saupurein Marcos', '0000-00-00', '', b'1', 1),
(8, 'A Ciegas Gourmet (Palermo)', 1, '1000.00', 2, '2000.00', '1.00', '6.05', '10.00', '70.00', '6.00', '2017-11-09', 'Saupurein Marcos', '0000-00-00', '', b'1', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dbobrascooperativas`
--

CREATE TABLE IF NOT EXISTS `dbobrascooperativas` (
  `idobracooperativa` int(11) NOT NULL AUTO_INCREMENT,
  `refobras` int(11) NOT NULL,
  `refcooperativas` int(11) NOT NULL,
  PRIMARY KEY (`idobracooperativa`),
  KEY `fk_oc_obras_idx` (`refobras`),
  KEY `fk_oc_cooperativas_idx` (`refcooperativas`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=33 ;

--
-- Volcado de datos para la tabla `dbobrascooperativas`
--

INSERT INTO `dbobrascooperativas` (`idobracooperativa`, `refobras`, `refcooperativas`) VALUES
(12, 3, 3),
(13, 3, 4),
(14, 4, 5),
(15, 4, 6),
(17, 1, 8),
(18, 1, 9),
(19, 1, 10),
(20, 5, 11),
(24, 5, 12),
(25, 5, 13),
(26, 5, 14),
(27, 6, 15),
(28, 7, 16),
(29, 7, 17),
(30, 7, 18),
(31, 2, 19),
(32, 4, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dbpersonal`
--

CREATE TABLE IF NOT EXISTS `dbpersonal` (
  `idpersonal` int(11) NOT NULL AUTO_INCREMENT,
  `reftipodocumento` int(11) NOT NULL,
  `nrodocumento` int(11) NOT NULL,
  `apellido` varchar(120) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(120) COLLATE utf8_spanish_ci NOT NULL,
  `fechanacimiento` date NOT NULL,
  `cuil` int(11) DEFAULT NULL,
  `sexo` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `refestadocivil` int(11) NOT NULL,
  `paisorigen` varchar(120) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fechacrea` date DEFAULT NULL,
  `usuacrea` varchar(120) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fechamodi` date DEFAULT NULL,
  `usuamodi` varchar(120) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`idpersonal`),
  KEY `fk_personal_tipodoc_idx` (`reftipodocumento`),
  KEY `fk_personal_estadocivil_idx` (`refestadocivil`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=137 ;

--
-- Volcado de datos para la tabla `dbpersonal`
--

INSERT INTO `dbpersonal` (`idpersonal`, `reftipodocumento`, `nrodocumento`, `apellido`, `nombre`, `fechanacimiento`, `cuil`, `sexo`, `refestadocivil`, `paisorigen`, `fechacrea`, `usuacrea`, `fechamodi`, `usuamodi`) VALUES
(1, 1, 31552466, 'Saupurein', 'Marcos', '1985-05-20', 2147483647, 'Masculino', 1, 'Argentina', '0000-00-00', 'Saupurein Marcos', '0000-00-00', ''),
(3, 1, 5863305, 'Angélica Julia Pereyra', '', '0000-00-00', 0, 'M', 1, '', '2017-08-29', 'marcos', '2017-08-29', ''),
(6, 1, 21142447, 'Marta Noemí Traina', '', '0000-00-00', 0, 'M', 1, '', '2017-08-29', 'marcos', '2017-08-29', ''),
(7, 1, 18457855, 'Gerardo Bentatti', '', '0000-00-00', 0, 'M', 1, '', '2017-08-29', 'marcos', '2017-08-29', ''),
(9, 1, 27445932, 'Pablo Sebastián Ugolini', '', '0000-00-00', 0, 'M', 1, '', '2017-08-29', 'marcos', '2017-08-29', ''),
(10, 1, 5099369, 'Carlos Rubén Cabrera', '', '0000-00-00', 0, 'M', 1, '', '2017-08-29', 'marcos', '2017-08-29', ''),
(12, 1, 11953837, 'Gabriel José Griro', '', '0000-00-00', 0, 'M', 1, '', '2017-08-29', 'marcos', '2017-08-29', ''),
(13, 1, 29299737, 'Maximiliano Griro', '', '0000-00-00', 0, 'M', 1, '', '2017-08-29', 'marcos', '2017-08-29', ''),
(14, 1, 38625319, 'Belén Edith Cabrera', '', '0000-00-00', 0, 'M', 1, '', '2017-08-29', 'marcos', '2017-08-29', ''),
(15, 1, 25732529, 'Karina Brenda García', '', '0000-00-00', 0, 'M', 1, '', '2017-08-29', 'marcos', '2017-08-29', ''),
(17, 1, 35340900, 'Dalila Ferreyra', '', '0000-00-00', 0, 'M', 1, '', '2017-08-29', 'marcos', '2017-08-29', ''),
(19, 1, 93357925, 'Diana Stolzenburg', '', '0000-00-00', 0, 'M', 1, '', '2017-08-29', 'marcos', '2017-08-29', ''),
(22, 1, 22027451, 'Graciela Mónica Pereyra', '', '0000-00-00', 0, 'M', 1, '', '2017-08-29', 'marcos', '2017-08-29', ''),
(24, 1, 94262361, 'César Martínez Santacruz', '', '0000-00-00', 0, 'M', 1, '', '2017-08-29', 'marcos', '2017-08-29', ''),
(25, 1, 16388012, 'Hugo Cabrera', '', '0000-00-00', 0, 'M', 1, '', '2017-08-29', 'marcos', '2017-08-29', ''),
(28, 1, 21691787, 'Carlos Alberto Gerbaldo Moyano', '', '0000-00-00', 0, 'M', 1, '', '2017-08-29', 'marcos', '2017-08-29', ''),
(32, 1, 34949159, 'Élida Belén Ullua', '', '0000-00-00', 0, 'M', 1, '', '2017-08-29', 'marcos', '2017-08-29', ''),
(34, 1, 21526521, 'Luisa Carmela Savoiardo', '', '0000-00-00', 0, 'M', 1, '', '2017-08-29', 'marcos', '2017-08-29', ''),
(37, 1, 25219948, 'Luciana Brusca', '', '0000-00-00', 0, 'M', 1, '', '2017-08-29', 'marcos', '2017-08-29', ''),
(38, 1, 28380935, 'Vanesa Alejandra Boroda', '', '0000-00-00', 0, 'M', 1, '', '2017-08-29', 'marcos', '2017-08-29', ''),
(44, 1, 17278305, 'Alejandro Luis Cardozo', '', '0000-00-00', 0, 'M', 1, '', '2017-08-29', 'marcos', '2017-08-29', ''),
(46, 1, 23649226, 'Darío Tripicchio', '', '0000-00-00', 0, 'M', 1, '', '2017-08-29', 'marcos', '2017-08-29', ''),
(50, 1, 30651935, 'Lucas Macchione', '', '0000-00-00', 0, 'M', 1, '', '2017-08-29', 'marcos', '2017-08-29', ''),
(53, 1, 13624831, 'Marcelo Moure', '', '0000-00-00', 0, 'M', 1, '', '2017-08-29', 'marcos', '2017-08-29', ''),
(62, 1, 94296935, 'Giuliana Fernández', '', '0000-00-00', 0, 'M', 1, '', '2017-08-29', 'marcos', '2017-08-29', ''),
(63, 1, 27445932, 'Pablo Ugolini', '', '0000-00-00', 0, 'M', 1, '', '2017-08-29', 'marcos', '2017-08-29', ''),
(65, 1, 28936916, 'Natalia López', '', '0000-00-00', 0, 'M', 1, '', '2017-08-29', 'marcos', '2017-08-29', ''),
(66, 1, 33258452, 'María Eugenia Morales', '', '0000-00-00', 0, 'M', 1, '', '2017-08-29', 'marcos', '2017-08-29', ''),
(67, 1, 37751858, 'Verónica Caminos', '', '0000-00-00', 0, 'M', 1, '', '2017-08-29', 'marcos', '2017-08-29', ''),
(68, 1, 25996898, 'Natalia Andrea Bianchi', '', '0000-00-00', 0, 'M', 1, '', '2017-08-29', 'marcos', '2017-08-29', ''),
(69, 1, 94472963, 'Marlene del Carmen Villalba Mendoza', '', '0000-00-00', 0, 'M', 1, '', '2017-08-29', 'marcos', '2017-08-29', ''),
(70, 1, 94924066, 'Shrilla Samahy Jimenez Sandova', '', '0000-00-00', 0, 'M', 1, '', '2017-08-29', 'marcos', '2017-08-29', ''),
(71, 1, 27938111, 'Gastón Barba', '', '0000-00-00', 0, 'M', 1, '', '2017-08-29', 'marcos', '2017-08-29', ''),
(75, 1, 34151424, 'Julieta Álvarez', '', '0000-00-00', 0, 'M', 1, '', '2017-08-29', 'marcos', '2017-08-29', ''),
(76, 1, 33787175, 'Paula Cohen Noguerol', '', '0000-00-00', 0, 'M', 1, '', '2017-08-29', 'marcos', '2017-08-29', ''),
(78, 1, 30594815, 'Eliezer Ilan Brandenburg', '', '0000-00-00', 0, 'M', 1, '', '2017-08-29', 'marcos', '2017-08-29', ''),
(79, 1, 31652985, 'Joaquin Vila', '', '0000-00-00', 0, 'M', 1, '', '2017-08-29', 'marcos', '2017-08-29', ''),
(80, 1, 31915263, 'Agustina María Colombo', '', '0000-00-00', 0, 'M', 1, '', '2017-08-29', 'marcos', '2017-08-29', ''),
(83, 1, 31218878, 'Mateo Blesio Caldo', '', '0000-00-00', 0, 'M', 1, '', '2017-08-29', 'marcos', '2017-08-29', ''),
(84, 1, 26735097, 'Julián Eduardo Bonino', '', '0000-00-00', 0, 'M', 1, '', '2017-08-29', 'marcos', '2017-08-29', ''),
(85, 1, 0, 'Patricia Laura Fishman', '', '0000-00-00', 0, 'M', 1, '', '2017-08-29', 'marcos', '2017-08-29', ''),
(86, 1, 32047237, 'María de los Ángeles Taraborrelli', '', '0000-00-00', 0, 'M', 1, '', '2017-08-29', 'marcos', '2017-08-29', ''),
(87, 1, 33502130, 'Facundo Bogarín', '', '0000-00-00', 0, 'M', 1, '', '2017-08-29', 'marcos', '2017-08-29', ''),
(88, 1, 5773733, 'Susana Alicia Blum', '', '0000-00-00', 2147483647, 'M', 1, '', '2017-08-29', 'marcos', '2017-08-29', ''),
(89, 1, 0, 'Mariano Bassi', '', '0000-00-00', 0, 'M', 1, '', '2017-08-29', 'marcos', '2017-08-29', ''),
(90, 1, 14062477, 'Héctor Gómez', '', '0000-00-00', 0, 'M', 1, '', '2017-08-29', 'marcos', '2017-08-29', ''),
(91, 1, 24919307, 'Maximiliano Trento', '', '0000-00-00', 0, 'M', 1, '', '2017-08-29', 'marcos', '2017-08-29', ''),
(92, 1, 11597575, 'Daniel Horacio Rodríguez', '', '0000-00-00', 0, 'M', 1, '', '2017-08-29', 'marcos', '2017-08-29', ''),
(93, 1, 93776792, 'Aleris Del Carmen Pieve Villalobos', '', '0000-00-00', 0, 'M', 1, '', '2017-08-29', 'marcos', '2017-08-29', ''),
(94, 1, 28455030, 'Héctor Fabián Gómez', '', '0000-00-00', 0, 'M', 1, '', '2017-08-29', 'marcos', '2017-08-29', ''),
(95, 1, 34729384, 'Ariel Cáceres', '', '0000-00-00', 0, 'M', 1, '', '2017-08-29', 'marcos', '2017-08-29', ''),
(96, 1, 34321580, 'María Belén Jaime', '', '0000-00-00', 0, 'M', 1, '', '2017-08-29', 'marcos', '2017-08-29', ''),
(97, 1, 23521109, 'Hernán Ascón', '', '0000-00-00', 0, 'M', 1, '', '2017-08-29', 'marcos', '2017-08-29', ''),
(98, 1, 12595787, 'Carlos Mario Colussi', '', '0000-00-00', 2147483647, 'M', 1, '', '2017-08-29', 'marcos', '2017-08-29', ''),
(99, 1, 20735745, 'Andrea Fabiana Serrano', '', '0000-00-00', 2147483647, 'M', 1, '', '2017-08-29', 'marcos', '2017-08-29', ''),
(100, 1, 18453561, 'Marcela Fabiana Pedik', '', '0000-00-00', 0, 'M', 1, '', '2017-08-29', 'marcos', '2017-08-29', ''),
(101, 1, 10475283, 'Alberto Gatti', '', '0000-00-00', 0, 'M', 1, '', '2017-08-29', 'marcos', '2017-08-29', ''),
(102, 1, 0, 'Eliana Manzo', '', '0000-00-00', 0, 'M', 1, '', '2017-08-29', 'marcos', '2017-08-29', ''),
(103, 1, 21543181, 'Luis Alberto Torres', '', '0000-00-00', 0, 'M', 1, '', '2017-08-29', 'marcos', '2017-08-29', ''),
(104, 1, 17188096, 'Sandra Mariel Ferraro', '', '0000-00-00', 2147483647, 'M', 1, '', '2017-08-29', 'marcos', '2017-08-29', ''),
(105, 1, 18522801, 'Jorge Fabián Sagripanti', '', '0000-00-00', 0, 'M', 1, '', '2017-08-29', 'marcos', '2017-08-29', ''),
(106, 1, 33029423, 'Hernán Nicolás Morales', '', '0000-00-00', 0, 'M', 1, '', '2017-08-29', 'marcos', '2017-08-29', ''),
(107, 1, 32078776, 'Sebastián Osvaldo Bustamante', '', '0000-00-00', 2147483647, 'M', 1, 'Argentina', '2017-08-29', 'marcos', '2017-08-29', ''),
(108, 1, 35661763, 'Sofía Antonela Arce Valgañon', '', '0000-00-00', 2147483647, 'M', 1, '', '2017-08-29', 'marcos', '2017-08-29', ''),
(109, 1, 0, 'Mariela Bergaló', '', '0000-00-00', 0, 'M', 1, '', '2017-08-29', 'marcos', '2017-08-29', ''),
(110, 1, 0, 'Manuel Choque Estrada', '', '0000-00-00', 0, 'M', 1, '', '2017-08-29', 'marcos', '2017-08-29', ''),
(111, 1, 14014623, 'Silvana Beatriz Retamal Oszust', '', '0000-00-00', 0, 'M', 1, '', '2017-08-29', 'marcos', '2017-08-29', ''),
(112, 1, 0, 'Santiago Cravera', '', '0000-00-00', 0, 'M', 1, '', '2017-08-29', 'marcos', '2017-08-29', ''),
(113, 1, 30496299, 'Ramiro Torreira', '', '0000-00-00', 2147483647, 'M', 1, '', '2017-08-29', 'marcos', '2017-08-29', ''),
(114, 1, 94002185, 'Piero Anselmi', '', '0000-00-00', 0, 'M', 1, '', '2017-08-29', 'marcos', '2017-08-29', ''),
(115, 1, 17709895, 'Claudio Grillo', '', '0000-00-00', 0, 'M', 1, '', '2017-08-29', 'marcos', '2017-08-29', ''),
(116, 1, 0, 'Hugo Zuccarelli', '', '0000-00-00', 0, 'M', 1, '', '2017-08-29', 'marcos', '2017-08-29', ''),
(117, 1, 0, 'Leonardo Zuccarelli', '', '0000-00-00', 0, 'M', 1, '', '2017-08-29', 'marcos', '2017-08-29', ''),
(118, 1, 0, 'Fernando Zuccarelli', '', '0000-00-00', 0, 'M', 1, '', '2017-08-29', 'marcos', '2017-08-29', ''),
(119, 1, 0, 'Alicia Laporte', '', '0000-00-00', 0, 'M', 1, '', '2017-08-29', 'marcos', '2017-08-29', ''),
(120, 1, 0, 'Paula Aguilar', '', '0000-00-00', 0, 'M', 1, '', '2017-08-29', 'marcos', '2017-08-29', ''),
(121, 1, 16018630, 'Rubén Ronchi', '', '0000-00-00', 0, 'M', 1, '', '2017-08-29', 'marcos', '2017-08-29', ''),
(123, 1, 16139895, 'Rosa Noemí Griro', '', '0000-00-00', 0, 'M', 1, '', '2017-08-29', 'marcos', '2017-08-29', ''),
(124, 1, 23426427, 'Sabrina Beatriz Ponteprimo', '', '0000-00-00', 0, 'M', 1, '', '2017-08-29', 'marcos', '2017-08-29', ''),
(125, 1, 31709574, 'Pablo Leandro Delgado', '', '0000-00-00', 0, 'M', 1, '', '2017-08-29', 'marcos', '2017-08-29', ''),
(126, 1, 31302867, 'Mirta Noel Lezcano', '', '0000-00-00', 0, 'M', 1, '', '2017-08-29', 'marcos', '2017-08-29', ''),
(127, 1, 29866240, 'Javier Pablo Roson', '', '0000-00-00', 0, 'M', 1, '', '2017-08-29', 'marcos', '2017-08-29', ''),
(129, 1, 29161138, 'Martín Esteban Alejandro Bondone', '', '0000-00-00', 0, 'M', 1, '', '2017-08-29', 'marcos', '2017-08-29', ''),
(130, 1, 30651935, 'Leonardo Lucas Macchione', '', '0000-00-00', 0, 'M', 1, '', '2017-08-29', 'marcos', '2017-08-29', ''),
(131, 1, 36169711, 'Jonás Abel Iair Volman', '', '0000-00-00', 0, 'M', 1, '', '2017-08-29', 'marcos', '2017-08-29', ''),
(133, 1, 39208560, 'Tomás Manuel Moure', '', '0000-00-00', 0, 'M', 1, '', '2017-08-29', 'marcos', '2017-08-29', ''),
(134, 1, 27938111, 'Gastón Eduardo Barba', '', '0000-00-00', 0, 'M', 1, '', '2017-08-29', 'marcos', '2017-08-29', ''),
(135, 1, 29323673, 'Jesús Fernández', '', '0000-00-00', 0, 'M', 1, '', '2017-08-29', 'marcos', '2017-08-29', ''),
(136, 1, 100000, 'Pardo', 'Miguel', '1981-06-04', 324234, 'M', 1, 'Argentina', '0000-00-00', 'Saupurein Marcos', '0000-00-00', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dbpersonalcargos`
--

CREATE TABLE IF NOT EXISTS `dbpersonalcargos` (
  `idpersonalcargo` int(11) NOT NULL AUTO_INCREMENT,
  `refpersonal` int(11) NOT NULL,
  `reftiposcargos` int(11) NOT NULL,
  `reffunciones` int(11) DEFAULT NULL,
  `fechaalta` date NOT NULL,
  `fechabaja` date DEFAULT NULL,
  `fechabajatentativa` date DEFAULT NULL,
  `puntos` decimal(4,2) DEFAULT NULL,
  `monto` decimal(18,2) DEFAULT NULL,
  `fechacrea` date DEFAULT NULL,
  `usuacrea` varchar(60) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fechamodi` date DEFAULT NULL,
  `usuamodi` varchar(60) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`idpersonalcargo`),
  KEY `fk_personalcargos_personal_idx` (`refpersonal`),
  KEY `fk_personalcargos_tipocargo_idx` (`reftiposcargos`),
  KEY `fk_personalcargos_funciones_idx` (`reffunciones`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dbpersonalcooperativas`
--

CREATE TABLE IF NOT EXISTS `dbpersonalcooperativas` (
  `idpersonalcooperativa` int(11) NOT NULL AUTO_INCREMENT,
  `refpersonal` int(11) NOT NULL,
  `refcooperativas` int(11) NOT NULL,
  `puntos` decimal(3,1) DEFAULT NULL,
  PRIMARY KEY (`idpersonalcooperativa`),
  UNIQUE KEY `index_idpersonal` (`refpersonal`,`refcooperativas`),
  KEY `fk_pc_personal_idx` (`refpersonal`),
  KEY `fk_pc_cooperativa_idx` (`refcooperativas`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=173 ;

--
-- Volcado de datos para la tabla `dbpersonalcooperativas`
--

INSERT INTO `dbpersonalcooperativas` (`idpersonalcooperativa`, `refpersonal`, `refcooperativas`, `puntos`) VALUES
(9, 6, 3, '1.0'),
(10, 7, 3, '2.0'),
(11, 46, 3, '1.0'),
(12, 98, 3, '1.0'),
(13, 104, 3, '1.0'),
(14, 124, 3, '1.0'),
(15, 125, 3, '1.0'),
(16, 129, 3, '2.0'),
(17, 6, 4, '1.0'),
(18, 7, 4, '2.0'),
(19, 98, 4, '1.0'),
(20, 104, 4, '1.0'),
(21, 124, 4, '1.0'),
(22, 125, 4, '1.0'),
(23, 129, 4, '2.0'),
(24, 136, 4, '1.0'),
(25, 9, 5, '1.0'),
(26, 10, 5, '1.0'),
(27, 14, 5, '1.0'),
(28, 22, 5, '1.0'),
(29, 24, 5, '1.0'),
(30, 83, 5, '1.0'),
(31, 129, 5, '3.0'),
(32, 10, 6, '1.0'),
(33, 14, 6, '1.0'),
(34, 24, 6, '1.0'),
(35, 63, 6, '1.0'),
(36, 83, 6, '1.0'),
(37, 99, 6, '1.0'),
(38, 129, 6, '3.0'),
(45, 6, 8, '1.0'),
(46, 7, 8, '2.5'),
(47, 17, 8, '1.0'),
(48, 24, 8, '1.0'),
(49, 25, 8, '1.0'),
(50, 28, 8, '1.5'),
(51, 46, 8, '1.0'),
(52, 83, 8, '1.0'),
(53, 104, 8, '1.0'),
(54, 125, 8, '1.0'),
(55, 129, 8, '3.0'),
(56, 6, 9, '1.0'),
(57, 7, 9, '2.5'),
(58, 17, 9, '1.0'),
(59, 24, 9, '1.0'),
(60, 25, 9, '1.0'),
(61, 28, 9, '1.5'),
(62, 34, 9, '1.0'),
(63, 46, 9, '1.0'),
(64, 83, 9, '1.0'),
(65, 125, 9, '1.0'),
(66, 129, 9, '3.0'),
(67, 6, 10, '1.0'),
(68, 7, 10, '2.5'),
(69, 17, 10, '1.0'),
(70, 25, 10, '1.0'),
(71, 28, 10, '2.5'),
(72, 98, 10, '1.0'),
(73, 104, 10, '1.0'),
(74, 125, 10, '1.0'),
(75, 129, 10, '3.0'),
(76, 136, 10, '1.0'),
(77, 7, 11, '2.5'),
(78, 17, 11, '1.0'),
(79, 28, 11, '1.0'),
(80, 34, 11, '1.0'),
(81, 37, 11, '1.0'),
(82, 46, 11, '1.0'),
(83, 53, 11, '1.0'),
(84, 129, 11, '2.0'),
(109, 7, 12, '2.5'),
(110, 17, 12, '1.0'),
(111, 28, 12, '1.0'),
(112, 34, 12, '1.0'),
(113, 46, 12, '1.0'),
(114, 53, 12, '1.0'),
(115, 124, 12, '1.0'),
(116, 129, 12, '2.0'),
(117, 7, 13, '2.5'),
(118, 17, 13, '1.0'),
(119, 28, 13, '1.0'),
(120, 34, 13, '1.0'),
(121, 53, 13, '1.0'),
(122, 124, 13, '1.0'),
(123, 127, 13, '1.0'),
(124, 129, 13, '2.0'),
(125, 7, 14, '2.5'),
(126, 17, 14, '1.0'),
(127, 28, 14, '1.0'),
(128, 32, 14, '1.0'),
(129, 37, 14, '1.0'),
(130, 53, 14, '1.0'),
(131, 83, 14, '1.0'),
(132, 129, 14, '2.0'),
(133, 7, 15, '1.0'),
(134, 24, 15, '1.0'),
(135, 32, 15, '1.0'),
(136, 44, 15, '1.0'),
(137, 50, 15, '1.0'),
(138, 83, 15, '1.0'),
(139, 102, 15, '1.0'),
(140, 129, 15, '1.0'),
(141, 133, 15, '1.0'),
(142, 7, 16, '3.0'),
(143, 17, 16, '1.0'),
(144, 50, 16, '1.0'),
(145, 98, 16, '1.0'),
(146, 107, 16, '1.0'),
(147, 129, 16, '1.0'),
(148, 136, 16, '1.0'),
(149, 7, 17, '2.0'),
(150, 17, 17, '1.0'),
(151, 24, 17, '1.0'),
(152, 46, 17, '1.0'),
(153, 50, 17, '1.0'),
(154, 98, 17, '1.0'),
(155, 129, 17, '1.0'),
(156, 136, 17, '1.0'),
(157, 7, 18, '2.0'),
(158, 17, 18, '1.0'),
(159, 24, 18, '1.0'),
(160, 46, 18, '1.0'),
(161, 50, 18, '1.0'),
(162, 83, 18, '1.0'),
(163, 129, 18, '1.0'),
(164, 136, 18, '1.0'),
(165, 129, 19, '1.0'),
(166, 10, 7, '1.0'),
(167, 12, 7, '1.0'),
(168, 13, 7, '1.0'),
(169, 14, 7, '1.0'),
(170, 22, 7, '1.0'),
(171, 63, 7, '1.0'),
(172, 129, 7, '3.0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dbpersonalventa`
--

CREATE TABLE IF NOT EXISTS `dbpersonalventa` (
  `idpersonalventa` int(11) NOT NULL AUTO_INCREMENT,
  `refpersonal` int(11) NOT NULL,
  `refventas` int(11) NOT NULL,
  `puntos` decimal(4,2) NOT NULL,
  PRIMARY KEY (`idpersonalventa`),
  KEY `fk_pv_personal_idx` (`refpersonal`),
  KEY `fk_pv_ventas_idx` (`refventas`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=22 ;

--
-- Volcado de datos para la tabla `dbpersonalventa`
--

INSERT INTO `dbpersonalventa` (`idpersonalventa`, `refpersonal`, `refventas`, `puntos`) VALUES
(1, 28, 1, '1.50'),
(2, 24, 1, '1.00'),
(3, 17, 1, '1.00'),
(4, 46, 1, '1.00'),
(5, 7, 1, '2.50'),
(6, 25, 1, '1.00'),
(7, 34, 1, '1.00'),
(8, 6, 1, '1.00'),
(9, 129, 1, '3.00'),
(10, 83, 1, '1.00'),
(11, 125, 1, '1.00'),
(12, 28, 2, '2.50'),
(13, 98, 2, '1.00'),
(14, 17, 2, '1.00'),
(15, 7, 2, '2.50'),
(16, 25, 2, '1.00'),
(17, 6, 2, '1.00'),
(18, 129, 2, '3.00'),
(19, 125, 2, '1.00'),
(20, 136, 2, '1.00'),
(21, 104, 2, '1.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dbpromosobras`
--

CREATE TABLE IF NOT EXISTS `dbpromosobras` (
  `idpromoobra` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(120) COLLATE utf8_spanish_ci DEFAULT NULL,
  `refobras` int(11) NOT NULL,
  `vigenciadesde` date DEFAULT NULL,
  `vigenciahasta` date DEFAULT NULL,
  `porcentaje` decimal(5,2) DEFAULT NULL,
  `monto` decimal(18,2) DEFAULT NULL,
  PRIMARY KEY (`idpromoobra`),
  KEY `fk_promo_obras_idx` (`refobras`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=95 ;

--
-- Volcado de datos para la tabla `dbpromosobras`
--

INSERT INTO `dbpromosobras` (`idpromoobra`, `descripcion`, `refobras`, `vigenciadesde`, `vigenciahasta`, `porcentaje`, `monto`) VALUES
(12, 'Full', 1, NULL, NULL, '0.00', '0.00'),
(13, 'Full', 2, NULL, NULL, '0.00', '0.00'),
(14, 'Full', 3, NULL, NULL, '0.00', '0.00'),
(15, 'Full', 5, NULL, NULL, '0.00', '0.00'),
(16, 'Full', 8, NULL, NULL, '0.00', '0.00'),
(17, 'Full', 4, NULL, NULL, '0.00', '0.00'),
(18, 'Full', 6, NULL, NULL, '0.00', '0.00'),
(19, 'Full', 7, NULL, NULL, '0.00', '0.00'),
(27, '50%', 1, NULL, NULL, '50.00', '0.00'),
(28, '50%', 2, NULL, NULL, '50.00', '0.00'),
(29, '50%', 3, NULL, NULL, '50.00', '0.00'),
(30, '50%', 5, NULL, NULL, '50.00', '0.00'),
(31, '50%', 8, NULL, NULL, '50.00', '0.00'),
(32, '50%', 4, NULL, NULL, '50.00', '0.00'),
(33, '50%', 6, NULL, NULL, '50.00', '0.00'),
(34, '50%', 7, NULL, NULL, '50.00', '0.00'),
(42, '30%', 1, NULL, NULL, '30.00', '0.00'),
(43, '30%', 2, NULL, NULL, '30.00', '0.00'),
(44, '30%', 3, NULL, NULL, '30.00', '0.00'),
(45, '30%', 5, NULL, NULL, '30.00', '0.00'),
(46, '30%', 8, NULL, NULL, '30.00', '0.00'),
(47, '30%', 4, NULL, NULL, '30.00', '0.00'),
(48, '30%', 6, NULL, NULL, '30.00', '0.00'),
(49, '30%', 7, NULL, NULL, '30.00', '0.00'),
(57, '20%', 1, NULL, NULL, '20.00', '0.00'),
(58, '20%', 2, NULL, NULL, '20.00', '0.00'),
(59, '20%', 3, NULL, NULL, '20.00', '0.00'),
(60, '20%', 5, NULL, NULL, '20.00', '0.00'),
(61, '20%', 8, NULL, NULL, '20.00', '0.00'),
(62, '20%', 4, NULL, NULL, '20.00', '0.00'),
(63, '20%', 6, NULL, NULL, '20.00', '0.00'),
(64, '20%', 7, NULL, NULL, '20.00', '0.00'),
(72, 'Invitado Teatro', 1, NULL, NULL, '100.00', '0.00'),
(73, 'Invitado Teatro', 2, NULL, NULL, '100.00', '0.00'),
(74, 'Invitado Teatro', 3, NULL, NULL, '100.00', '0.00'),
(75, 'Invitado Teatro', 5, NULL, NULL, '100.00', '0.00'),
(76, 'Invitado Teatro', 8, NULL, NULL, '100.00', '0.00'),
(77, 'Invitado Teatro', 4, NULL, NULL, '100.00', '0.00'),
(78, 'Invitado Teatro', 6, NULL, NULL, '100.00', '0.00'),
(79, 'Invitado Teatro', 7, NULL, NULL, '100.00', '0.00'),
(87, 'Invitado Cooperativa', 1, NULL, NULL, '100.00', '0.00'),
(88, 'Invitado Cooperativa', 2, NULL, NULL, '100.00', '0.00'),
(89, 'Invitado Cooperativa', 3, NULL, NULL, '100.00', '0.00'),
(90, 'Invitado Cooperativa', 5, NULL, NULL, '100.00', '0.00'),
(91, 'Invitado Cooperativa', 8, NULL, NULL, '100.00', '0.00'),
(92, 'Invitado Cooperativa', 4, NULL, NULL, '100.00', '0.00'),
(93, 'Invitado Cooperativa', 6, NULL, NULL, '100.00', '0.00'),
(94, 'Invitado Cooperativa', 7, NULL, NULL, '100.00', '0.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dbproveedores`
--

CREATE TABLE IF NOT EXISTS `dbproveedores` (
  `idproveedor` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `cuit` varchar(11) DEFAULT NULL,
  `dni` varchar(8) DEFAULT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `telefono` varchar(10) DEFAULT NULL,
  `celular` varchar(15) DEFAULT NULL,
  `email` varchar(80) DEFAULT NULL,
  `observacionces` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`idproveedor`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `dbproveedores`
--

INSERT INTO `dbproveedores` (`idproveedor`, `nombre`, `cuit`, `dni`, `direccion`, `telefono`, `celular`, `email`, `observacionces`) VALUES
(1, 'Articulos de Libreria Jose', '33225569871', '22556987', 'Alberdi 235', '4600178', '', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dbusuarios`
--

CREATE TABLE IF NOT EXISTS `dbusuarios` (
  `idusuario` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `refroles` int(11) NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `nombrecompleto` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `refsedes` int(11) DEFAULT NULL,
  PRIMARY KEY (`idusuario`),
  KEY `fk_dbusuarios_tbroles1_idx` (`refroles`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `dbusuarios`
--

INSERT INTO `dbusuarios` (`idusuario`, `usuario`, `password`, `refroles`, `email`, `nombrecompleto`, `refsedes`) VALUES
(1, 'marcos', 'marcos', 1, 'msredhotero@msn.com', 'Saupurein Marcos', NULL),
(2, 'daniela', 'daniela', 2, 'daniela@teatro.com', 'Daniela', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dbventadetalle`
--

CREATE TABLE IF NOT EXISTS `dbventadetalle` (
  `idventadetalle` int(11) NOT NULL AUTO_INCREMENT,
  `refventas` int(11) NOT NULL,
  `total` decimal(12,2) NOT NULL,
  `refcategorias` int(11) DEFAULT NULL,
  `refpromosobras` int(11) DEFAULT NULL,
  `monto` decimal(18,2) DEFAULT NULL,
  `porcentaje` decimal(18,2) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  PRIMARY KEY (`idventadetalle`),
  KEY `fk_ventadetalle_ventas_idx` (`refventas`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=21 ;

--
-- Volcado de datos para la tabla `dbventadetalle`
--

INSERT INTO `dbventadetalle` (`idventadetalle`, `refventas`, `total`, `refcategorias`, `refpromosobras`, `monto`, `porcentaje`, `cantidad`) VALUES
(1, 1, '0.00', 16, 0, '0.00', '40.00', 0),
(2, 1, '1112.44', 17, 0, '0.00', '51.08', 10),
(3, 1, '0.00', 18, 0, '0.00', '30.00', 0),
(4, 1, '60.00', 35, 0, '0.00', '90.00', 2),
(5, 1, '7500.00', 0, 12, '0.00', '0.00', 25),
(6, 1, '2400.00', 0, 27, '0.00', '50.00', 16),
(7, 1, '0.00', 0, 42, '0.00', '30.00', 0),
(8, 1, '0.00', 0, 57, '0.00', '20.00', 0),
(9, 1, '0.00', 0, 72, '0.00', '100.00', 0),
(10, 1, '0.00', 0, 87, '0.00', '100.00', 0),
(11, 2, '0.00', 16, 0, '0.00', '40.00', 0),
(12, 2, '1334.93', 17, 0, '0.00', '51.08', 12),
(13, 2, '0.00', 18, 0, '0.00', '30.00', 0),
(14, 2, '0.00', 35, 0, '0.00', '90.00', 0),
(15, 2, '4500.00', 0, 12, '0.00', '0.00', 15),
(16, 2, '1650.00', 0, 27, '0.00', '50.00', 11),
(17, 2, '0.00', 0, 42, '0.00', '30.00', 0),
(18, 2, '480.00', 0, 57, '0.00', '20.00', 2),
(19, 2, '0.00', 0, 72, '0.00', '100.00', 7),
(20, 2, '0.00', 0, 87, '0.00', '100.00', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dbventas`
--

CREATE TABLE IF NOT EXISTS `dbventas` (
  `idventa` int(11) NOT NULL AUTO_INCREMENT,
  `numero` varchar(12) COLLATE utf8_spanish_ci NOT NULL,
  `reftipopago` int(11) DEFAULT NULL,
  `fecha` datetime NOT NULL,
  `total` decimal(12,2) NOT NULL,
  `cancelado` bit(1) DEFAULT NULL,
  `usuario` varchar(120) COLLATE utf8_spanish_ci DEFAULT NULL,
  `reffunciones` int(11) DEFAULT NULL,
  `refalbum` int(11) DEFAULT NULL,
  `valorentrada` decimal(18,2) DEFAULT NULL,
  `observacion` varchar(300) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fechacreacion` date DEFAULT NULL,
  `usuacrea` varchar(120) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fechamodi` date DEFAULT NULL,
  `usuamodi` varchar(120) COLLATE utf8_spanish_ci DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `totalefectivo` decimal(18,2) DEFAULT NULL,
  `totaltarjeta` decimal(18,2) DEFAULT NULL,
  PRIMARY KEY (`idventa`),
  KEY `fk_ventas_tipopago_idx` (`reftipopago`),
  KEY `fk_ventas_funciones_idx` (`reffunciones`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `dbventas`
--

INSERT INTO `dbventas` (`idventa`, `numero`, `reftipopago`, `fecha`, `total`, `cancelado`, `usuario`, `reffunciones`, `refalbum`, `valorentrada`, `observacion`, `fechacreacion`, `usuacrea`, `fechamodi`, `usuamodi`, `cantidad`, `totalefectivo`, `totaltarjeta`) VALUES
(1, 'CC00000001', 1, '2017-04-01 00:00:00', '11097.00', b'0', 'Saupurein Marcos', 40, 0, '300.00', '', '2017-11-14', 'Saupurein Marcos', '0000-00-00', '', 53, '4260.00', '5700.00'),
(2, 'CC00000002', 1, '2017-04-02 00:00:00', '7994.40', b'0', 'Saupurein Marcos', 44, 0, '300.00', '', '2017-11-14', 'Saupurein Marcos', '0000-00-00', '', 47, '3030.00', '3600.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `images`
--

CREATE TABLE IF NOT EXISTS `images` (
  `idfoto` int(11) NOT NULL AUTO_INCREMENT,
  `refproyecto` int(11) NOT NULL,
  `refuser` int(11) NOT NULL,
  `imagen` varchar(500) DEFAULT NULL,
  `type` varchar(45) DEFAULT NULL,
  `principal` bit(1) DEFAULT NULL,
  PRIMARY KEY (`idfoto`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Volcado de datos para la tabla `images`
--

INSERT INTO `images` (`idfoto`, `refproyecto`, `refuser`, `imagen`, `type`, `principal`) VALUES
(1, 6, 0, 'ABMMIPIN50P.jpg', 'image/jpeg', NULL),
(6, 7, 0, 'bgcasa_3.jpg', 'image/jpeg', NULL),
(9, 10, 0, 'factura.png', 'image/png', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `predio_menu`
--

CREATE TABLE IF NOT EXISTS `predio_menu` (
  `idmenu` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `icono` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `nombre` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `Orden` smallint(6) DEFAULT NULL,
  `hover` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `permiso` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`idmenu`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=31 ;

--
-- Volcado de datos para la tabla `predio_menu`
--

INSERT INTO `predio_menu` (`idmenu`, `url`, `icono`, `nombre`, `Orden`, `hover`, `permiso`) VALUES
(1, '../index.php', 'icodashboard', 'Dashboard', 1, NULL, 'Empleado, Administrador, SuperAdmin'),
(6, '../proveedores/', 'icocontratos', 'Proveedores', 19, NULL, 'Empleado, Administrador, SuperAdmin'),
(7, '../reportes/', 'icoreportes', 'Reportes', 20, NULL, 'Empleado, Administrador, SuperAdmin'),
(8, '../logout.php', 'icosalir', 'Salir', 30, NULL, 'Empleado, Administrador, SuperAdmin'),
(18, '../salas/', 'icoconfiguracion', 'Salas', 2, NULL, 'Empleado, Administrador, SuperAdmin'),
(19, '../tiposcargos/', 'icoconfiguracion', 'Tipo de Cargos', 3, NULL, 'Empleado, Administrador, SuperAdmin'),
(20, '../personal/', 'icousuarios', 'Personal', 4, NULL, 'Empleado, Administrador, SuperAdmin'),
(21, '../cooperativas/', 'icocontratos', 'Cooperativas', 5, NULL, 'Empleado, Administrador, SuperAdmin'),
(22, '../obras/', 'icocinema', 'Obras', 6, NULL, 'Empleado, Administrador, SuperAdmin'),
(23, '../cuponeras/', 'icocinema', 'Cuponeras', 7, NULL, 'Empleado, Administrador, SuperAdmin'),
(24, '../promos/', 'icocinema', 'Promos', 8, NULL, 'Empleado, Administrador, SuperAdmin'),
(25, '../categorias/', 'icocinema', 'Categorias', 9, NULL, 'Empleado, Administrador, SuperAdmin'),
(26, '../boleteria/', 'icocinema', 'Boleteria', 10, NULL, 'Empleado, Administrador, SuperAdmin'),
(27, '../funciones/', 'icocinema', 'Funciones', 11, NULL, 'Empleado, Administrador, SuperAdmin'),
(28, '../estadisticas/', 'icochart', 'Estadisticas', 12, NULL, 'Empleado, Administrador, SuperAdmin'),
(29, '../sedes/', 'icoconfiguracion', 'Sedes', 13, NULL, 'Administrador, SuperAdmin'),
(30, '../usuarios/', 'icousuarios', 'Usuarios', 14, NULL, 'Administrador, SuperAdmin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbalbum`
--

CREATE TABLE IF NOT EXISTS `tbalbum` (
  `idalbum` int(11) NOT NULL AUTO_INCREMENT,
  `banda` varchar(140) COLLATE utf8_spanish_ci NOT NULL DEFAULT '0',
  `album` varchar(140) COLLATE utf8_spanish_ci NOT NULL DEFAULT '0',
  `genero` varchar(140) COLLATE utf8_spanish_ci DEFAULT '0',
  PRIMARY KEY (`idalbum`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `tbalbum`
--

INSERT INTO `tbalbum` (`idalbum`, `banda`, `album`, `genero`) VALUES
(1, 'Queen', 'A night at the Ópera', 'Rock/Simfonico');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbcuponeras`
--

CREATE TABLE IF NOT EXISTS `tbcuponeras` (
  `idcuponera` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(120) COLLATE utf8_spanish_ci NOT NULL,
  `direccion` varchar(150) COLLATE utf8_spanish_ci DEFAULT NULL,
  `telefono` varchar(10) COLLATE utf8_spanish_ci DEFAULT NULL,
  `cuit` varchar(11) COLLATE utf8_spanish_ci DEFAULT NULL,
  `email` varchar(120) COLLATE utf8_spanish_ci DEFAULT NULL,
  `activo` bit(1) DEFAULT NULL,
  PRIMARY KEY (`idcuponera`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `tbcuponeras`
--

INSERT INTO `tbcuponeras` (`idcuponera`, `nombre`, `direccion`, `telefono`, `cuit`, `email`, `activo`) VALUES
(1, 'Atrapalo', '', '', '', '', b'1'),
(2, 'Groupon', '', '', '', '', b'1'),
(3, 'Big Box', '', '', '', '', b'1'),
(4, 'Flipaste', '', '', '', '', b'1'),
(5, 'Ticket Hoy', '', '', '', '', b'1'),
(6, 'Vuenoz', '', '', '', '', b'1'),
(7, 'Cartelera', '', '', '', '', b'1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbdias`
--

CREATE TABLE IF NOT EXISTS `tbdias` (
  `iddia` int(11) NOT NULL AUTO_INCREMENT,
  `dia` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`iddia`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `tbdias`
--

INSERT INTO `tbdias` (`iddia`, `dia`) VALUES
(1, 'Lunes'),
(2, 'Martes'),
(3, 'Miercoles'),
(4, 'Jueves'),
(5, 'Viernes'),
(6, 'Sabado'),
(7, 'Domingo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbestadocivil`
--

CREATE TABLE IF NOT EXISTS `tbestadocivil` (
  `idestadocivil` int(11) NOT NULL AUTO_INCREMENT,
  `estadocivil` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `activo` bit(1) DEFAULT NULL,
  PRIMARY KEY (`idestadocivil`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `tbestadocivil`
--

INSERT INTO `tbestadocivil` (`idestadocivil`, `estadocivil`, `activo`) VALUES
(1, 'Soltero', b'1'),
(2, 'Casado', b'1'),
(3, 'Divorsiado/a', b'1'),
(4, 'Viudo/a', b'1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbestados`
--

CREATE TABLE IF NOT EXISTS `tbestados` (
  `idestado` int(11) NOT NULL AUTO_INCREMENT,
  `estado` varchar(20) NOT NULL,
  `icono` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`idestado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbroles`
--

CREATE TABLE IF NOT EXISTS `tbroles` (
  `idrol` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(45) NOT NULL,
  `activo` bit(1) NOT NULL,
  PRIMARY KEY (`idrol`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `tbroles`
--

INSERT INTO `tbroles` (`idrol`, `descripcion`, `activo`) VALUES
(1, 'Administrador', b'1'),
(2, 'Empleado', b'1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbsalas`
--

CREATE TABLE IF NOT EXISTS `tbsalas` (
  `idsala` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `capacidad` int(11) NOT NULL,
  `activa` bit(1) DEFAULT NULL,
  PRIMARY KEY (`idsala`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `tbsalas`
--

INSERT INTO `tbsalas` (`idsala`, `descripcion`, `capacidad`, `activa`) VALUES
(1, 'Arriba', 65, b'1'),
(2, 'Abajo', 75, b'1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbsedes`
--

CREATE TABLE IF NOT EXISTS `tbsedes` (
  `idsede` int(11) NOT NULL AUTO_INCREMENT,
  `sede` varchar(80) COLLATE utf8_spanish_ci NOT NULL,
  `activo` bit(1) DEFAULT NULL,
  PRIMARY KEY (`idsede`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `tbsedes`
--

INSERT INTO `tbsedes` (`idsede`, `sede`, `activo`) VALUES
(1, 'Abasto', b'1'),
(2, 'Palermo', b'1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbtipoconceptos`
--

CREATE TABLE IF NOT EXISTS `tbtipoconceptos` (
  `idtipoconcepto` int(11) NOT NULL AUTO_INCREMENT,
  `tipoconcepto` varchar(120) COLLATE utf8_spanish_ci NOT NULL,
  `activo` bit(1) DEFAULT NULL,
  PRIMARY KEY (`idtipoconcepto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbtipodocumento`
--

CREATE TABLE IF NOT EXISTS `tbtipodocumento` (
  `idtipodocumento` int(11) NOT NULL AUTO_INCREMENT,
  `tipodocumento` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `activo` bit(1) DEFAULT NULL,
  PRIMARY KEY (`idtipodocumento`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `tbtipodocumento`
--

INSERT INTO `tbtipodocumento` (`idtipodocumento`, `tipodocumento`, `activo`) VALUES
(1, 'DNI', b'1'),
(2, 'LC', b'1'),
(3, 'LE', b'1'),
(4, 'Pasaporte', b'1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbtipopago`
--

CREATE TABLE IF NOT EXISTS `tbtipopago` (
  `idtipopago` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(80) NOT NULL,
  PRIMARY KEY (`idtipopago`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `tbtipopago`
--

INSERT INTO `tbtipopago` (`idtipopago`, `descripcion`) VALUES
(1, 'Efectivo'),
(2, 'Tarjeta'),
(3, 'Transferencias');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbtiposcargos`
--

CREATE TABLE IF NOT EXISTS `tbtiposcargos` (
  `idtipocargo` int(11) NOT NULL AUTO_INCREMENT,
  `cargo` varchar(80) COLLATE utf8_spanish_ci NOT NULL,
  `activo` bit(1) DEFAULT NULL,
  PRIMARY KEY (`idtipocargo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `tbtiposcargos`
--

INSERT INTO `tbtiposcargos` (`idtipocargo`, `cargo`, `activo`) VALUES
(1, 'Empleado', b'1'),
(2, 'Actor', b'1'),
(3, 'Delegado', b'1');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `dbalbumobras`
--
ALTER TABLE `dbalbumobras`
  ADD CONSTRAINT `fk_ao_album` FOREIGN KEY (`refalbum`) REFERENCES `tbalbum` (`idalbum`),
  ADD CONSTRAINT `fk_ao_obras` FOREIGN KEY (`refobras`) REFERENCES `dbobras` (`idobra`);

--
-- Filtros para la tabla `dbcategorias`
--
ALTER TABLE `dbcategorias`
  ADD CONSTRAINT `fk_categorias_cuponeras` FOREIGN KEY (`refcuponeras`) REFERENCES `tbcuponeras` (`idcuponera`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_categorias_obras` FOREIGN KEY (`refobras`) REFERENCES `dbobras` (`idobra`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `dbdatosbancos`
--
ALTER TABLE `dbdatosbancos`
  ADD CONSTRAINT `fk_datosbanco_personal` FOREIGN KEY (`refpersonal`) REFERENCES `dbpersonal` (`idpersonal`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `dbdomicilios`
--
ALTER TABLE `dbdomicilios`
  ADD CONSTRAINT `fk_domicilio_personal` FOREIGN KEY (`refpersonal`) REFERENCES `dbpersonal` (`idpersonal`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `dbfunciones`
--
ALTER TABLE `dbfunciones`
  ADD CONSTRAINT `fk_funciones_dias` FOREIGN KEY (`refdias`) REFERENCES `tbdias` (`iddia`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_funcion_cooperativa` FOREIGN KEY (`refcooperativas`) REFERENCES `dbcooperativas` (`idcooperativa`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_funcion_obras` FOREIGN KEY (`refobras`) REFERENCES `dbobras` (`idobra`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `dbobras`
--
ALTER TABLE `dbobras`
  ADD CONSTRAINT `fk_obras_salas` FOREIGN KEY (`refsalas`) REFERENCES `tbsalas` (`idsala`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_obras_sedes` FOREIGN KEY (`refsedes`) REFERENCES `tbsedes` (`idsede`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `dbobrascooperativas`
--
ALTER TABLE `dbobrascooperativas`
  ADD CONSTRAINT `fk_oc_cooperativas` FOREIGN KEY (`refcooperativas`) REFERENCES `dbcooperativas` (`idcooperativa`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_oc_obras` FOREIGN KEY (`refobras`) REFERENCES `dbobras` (`idobra`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `dbpersonal`
--
ALTER TABLE `dbpersonal`
  ADD CONSTRAINT `fk_personal_estadocivil` FOREIGN KEY (`refestadocivil`) REFERENCES `tbestadocivil` (`idestadocivil`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_personal_tipodoc` FOREIGN KEY (`reftipodocumento`) REFERENCES `tbtipodocumento` (`idtipodocumento`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `dbpersonalcargos`
--
ALTER TABLE `dbpersonalcargos`
  ADD CONSTRAINT `fk_personalcargos_funciones` FOREIGN KEY (`reffunciones`) REFERENCES `dbfunciones` (`idfuncion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_personalcargos_personal` FOREIGN KEY (`refpersonal`) REFERENCES `dbpersonal` (`idpersonal`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_personalcargos_tipocargo` FOREIGN KEY (`reftiposcargos`) REFERENCES `tbtiposcargos` (`idtipocargo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `dbpersonalcooperativas`
--
ALTER TABLE `dbpersonalcooperativas`
  ADD CONSTRAINT `fk_pc_cooperativa` FOREIGN KEY (`refcooperativas`) REFERENCES `dbcooperativas` (`idcooperativa`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_pc_personal` FOREIGN KEY (`refpersonal`) REFERENCES `dbpersonal` (`idpersonal`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `index_idpersonal` FOREIGN KEY (`refpersonal`) REFERENCES `dbpersonal` (`idpersonal`);

--
-- Filtros para la tabla `dbpersonalventa`
--
ALTER TABLE `dbpersonalventa`
  ADD CONSTRAINT `fk_pv_personal` FOREIGN KEY (`refpersonal`) REFERENCES `dbpersonal` (`idpersonal`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_pv_ventas` FOREIGN KEY (`refventas`) REFERENCES `dbventas` (`idventa`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `dbpromosobras`
--
ALTER TABLE `dbpromosobras`
  ADD CONSTRAINT `fk_promo_obras` FOREIGN KEY (`refobras`) REFERENCES `dbobras` (`idobra`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `dbventadetalle`
--
ALTER TABLE `dbventadetalle`
  ADD CONSTRAINT `fk_ventadetalle_ventas` FOREIGN KEY (`refventas`) REFERENCES `dbventas` (`idventa`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `dbventas`
--
ALTER TABLE `dbventas`
  ADD CONSTRAINT `fk_ventas_funciones` FOREIGN KEY (`reffunciones`) REFERENCES `dbfunciones` (`idfuncion`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
