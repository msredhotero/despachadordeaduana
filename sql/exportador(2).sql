-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 26-01-2018 a las 21:24:50
-- Versión del servidor: 5.5.20
-- Versión de PHP: 5.3.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `exportador`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dbclientes`
--

CREATE TABLE IF NOT EXISTS `dbclientes` (
  `idcliente` int(11) NOT NULL AUTO_INCREMENT,
  `razonsocial` varchar(160) COLLATE utf8_spanish_ci NOT NULL,
  `cuit` varchar(11) COLLATE utf8_spanish_ci NOT NULL,
  `valorunitario` decimal(18,2) NOT NULL,
  PRIMARY KEY (`idcliente`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `dbclientes`
--

INSERT INTO `dbclientes` (`idcliente`, `razonsocial`, `cuit`, `valorunitario`) VALUES
(1, 'EST. TEXTILES ITUZAINGO	', '30502130540', '2.30');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dbexportacioncontenedores`
--

CREATE TABLE IF NOT EXISTS `dbexportacioncontenedores` (
  `idexportacioncontenedor` int(11) NOT NULL AUTO_INCREMENT,
  `refexportaciones` int(11) NOT NULL,
  `contenedor` varchar(160) COLLATE utf8_spanish_ci NOT NULL,
  `tara` decimal(18,2) NOT NULL,
  `precinto` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`idexportacioncontenedor`),
  KEY `fk_exportacion_contenedor_idx` (`refexportaciones`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `dbexportacioncontenedores`
--

INSERT INTO `dbexportacioncontenedores` (`idexportacioncontenedor`, `refexportaciones`, `contenedor`, `tara`, `precinto`) VALUES
(6, 5, 'dwed234', '234.00', 'sdwer4');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dbexportaciondetalles`
--

CREATE TABLE IF NOT EXISTS `dbexportaciondetalles` (
  `idexportaciondetalle` int(11) NOT NULL AUTO_INCREMENT,
  `refexportacioncontenedores` int(11) NOT NULL,
  `bulto` decimal(6,2) NOT NULL,
  `bruto` decimal(18,2) NOT NULL,
  `neto` decimal(18,2) NOT NULL,
  `marca` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `refmercaderias` int(11) NOT NULL,
  `valorunitario` decimal(18,2) NOT NULL,
  PRIMARY KEY (`idexportaciondetalle`),
  KEY `fk_detalle_contenedor_idx` (`refexportacioncontenedores`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=10 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dbexportaciones`
--

CREATE TABLE IF NOT EXISTS `dbexportaciones` (
  `idexportacion` int(11) NOT NULL AUTO_INCREMENT,
  `permisoembarque` varchar(120) COLLATE utf8_spanish_ci NOT NULL,
  `refclientes` int(11) NOT NULL,
  `refbuques` int(11) NOT NULL,
  `refcolores` int(11) NOT NULL,
  `refdestinos` int(11) NOT NULL,
  `refpuertos` int(11) NOT NULL,
  `refagencias` int(11) NOT NULL,
  `booking` varchar(120) COLLATE utf8_spanish_ci NOT NULL,
  `despachante` varchar(120) COLLATE utf8_spanish_ci NOT NULL,
  `cuit` varchar(11) COLLATE utf8_spanish_ci NOT NULL,
  `fecha` date NOT NULL,
  `factura` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `tc` decimal(18,2) DEFAULT NULL,
  `valorunit` decimal(18,2) DEFAULT NULL,
  `fechamodi` date DEFAULT NULL,
  `gastos` decimal(18,2) DEFAULT NULL,
  `honorarios` decimal(18,2) NOT NULL,
  PRIMARY KEY (`idexportacion`),
  KEY `fk_exportacion_cliente_idx` (`refclientes`),
  KEY `fk_exportacion_buques_idx` (`refbuques`),
  KEY `fk_exportacion_colores_idx` (`refcolores`),
  KEY `fk_exportacion_puertos_idx` (`refpuertos`),
  KEY `fk_exportacion_destinos_idx` (`refdestinos`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `dbexportaciones`
--

INSERT INTO `dbexportaciones` (`idexportacion`, `permisoembarque`, `refclientes`, `refbuques`, `refcolores`, `refdestinos`, `refpuertos`, `refagencias`, `booking`, `despachante`, `cuit`, `fecha`, `factura`, `tc`, `valorunit`, `fechamodi`, `gastos`, `honorarios`) VALUES
(5, 'aasda', 1, 1, 1, 1, 1, 1, '123123', 'AVILA GUSTAVO', '20160883082', '2018-01-26', '', '18.90', '2.30', '2018-01-26', '1000.00', '3.00');

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
  PRIMARY KEY (`idusuario`),
  KEY `fk_dbusuarios_tbroles1_idx` (`refroles`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `dbusuarios`
--

INSERT INTO `dbusuarios` (`idusuario`, `usuario`, `password`, `refroles`, `email`, `nombrecompleto`) VALUES
(1, 'Safar Marcos', 'marcos', 1, 'msredhotero@msn.com', 'Saupurein Marcos');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=20 ;

--
-- Volcado de datos para la tabla `predio_menu`
--

INSERT INTO `predio_menu` (`idmenu`, `url`, `icono`, `nombre`, `Orden`, `hover`, `permiso`) VALUES
(1, '../index.php', 'icodashboard', 'Dashboard', 0, NULL, 'Empleado, Administrador, SuperAdmin'),
(3, '../exportaciones/', 'icoexportaciones', 'Exportaciones', 2, NULL, 'Empleado, Administrador, SuperAdmin'),
(4, '../clientes/', 'icousuarios', 'Clientes', 6, NULL, 'Empleado, Administrador, SuperAdmin'),
(5, '../mercaderia/', 'icoproductos', 'Mercaderia', 2, NULL, 'Empleado, Administrador, SuperAdmin'),
(6, '../buques/', 'icocontratos', 'Buques', 12, NULL, 'Empleado, Administrador, SuperAdmin'),
(7, '../reportes/', 'icoreportes', 'Reportes', 16, NULL, 'Empleado, Administrador, SuperAdmin'),
(8, '../logout.php', 'icosalir', 'Salir', 30, NULL, 'Empleado, Administrador, SuperAdmin'),
(9, '../destinos/', 'icoconfiguracion', 'Destinos', 14, NULL, 'Empleado, Administrador, SuperAdmin'),
(15, '../colores/', 'icozonas', 'Colores', 8, NULL, 'Empleado, Administrador, SuperAdmin'),
(16, '../usuarios/', 'icojugadores', 'Usuarios', 13, NULL, 'Empleado, Administrador, SuperAdmin'),
(17, '../puertos/', 'icoresiduo', 'Puertos', 5, NULL, 'Empleado, Administrador, SuperAdmin'),
(18, '../configuracion/', 'icoconfiguracion', 'Configuracion', 19, NULL, 'Empleado, Administrador, SuperAdmin'),
(19, '../agencias/', 'icozonas', 'Agencias', 7, NULL, 'Empleado, Administrador, SuperAdmin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbagencias`
--

CREATE TABLE IF NOT EXISTS `tbagencias` (
  `idagencia` int(11) NOT NULL AUTO_INCREMENT,
  `agencia` varchar(120) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`idagencia`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `tbagencias`
--

INSERT INTO `tbagencias` (`idagencia`, `agencia`) VALUES
(1, 'AG MARTIN');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbbuques`
--

CREATE TABLE IF NOT EXISTS `tbbuques` (
  `idbuque` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(120) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`idbuque`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `tbbuques`
--

INSERT INTO `tbbuques` (`idbuque`, `nombre`) VALUES
(1, 'NORDIC STRALSUND');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbcolores`
--

CREATE TABLE IF NOT EXISTS `tbcolores` (
  `idcolor` int(11) NOT NULL AUTO_INCREMENT,
  `color` varchar(120) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`idcolor`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `tbcolores`
--

INSERT INTO `tbcolores` (`idcolor`, `color`) VALUES
(1, 'Naranja');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbconfiguracion`
--

CREATE TABLE IF NOT EXISTS `tbconfiguracion` (
  `idtbconfiguracion` int(11) NOT NULL AUTO_INCREMENT,
  `razonsocial` varchar(160) COLLATE utf8_spanish_ci NOT NULL,
  `cuit` varchar(11) COLLATE utf8_spanish_ci NOT NULL,
  `gastos` decimal(18,2) NOT NULL,
  `honorarios` decimal(5,2) NOT NULL,
  PRIMARY KEY (`idtbconfiguracion`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `tbconfiguracion`
--

INSERT INTO `tbconfiguracion` (`idtbconfiguracion`, `razonsocial`, `cuit`, `gastos`, `honorarios`) VALUES
(2, 'AVILA GUSTAVO OMAR', '20160883082', '1500.00', '3.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbdestinos`
--

CREATE TABLE IF NOT EXISTS `tbdestinos` (
  `iddestino` int(11) NOT NULL AUTO_INCREMENT,
  `destino` varchar(120) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`iddestino`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `tbdestinos`
--

INSERT INTO `tbdestinos` (`iddestino`, `destino`) VALUES
(1, 'Peru');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbmercaderias`
--

CREATE TABLE IF NOT EXISTS `tbmercaderias` (
  `idmercaderia` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(120) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`idmercaderia`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `tbmercaderias`
--

INSERT INTO `tbmercaderias` (`idmercaderia`, `nombre`) VALUES
(1, 'TOPS DE LANA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbpuertos`
--

CREATE TABLE IF NOT EXISTS `tbpuertos` (
  `idpuerto` int(11) NOT NULL AUTO_INCREMENT,
  `puerto` varchar(120) COLLATE utf8_spanish_ci NOT NULL,
  `bandera` varchar(120) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`idpuerto`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `tbpuertos`
--

INSERT INTO `tbpuertos` (`idpuerto`, `puerto`, `bandera`) VALUES
(1, 'Callao', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbroles`
--

CREATE TABLE IF NOT EXISTS `tbroles` (
  `idrol` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(45) NOT NULL,
  `activo` bit(1) NOT NULL,
  PRIMARY KEY (`idrol`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `tbroles`
--

INSERT INTO `tbroles` (`idrol`, `descripcion`, `activo`) VALUES
(1, 'Administrador', b'1');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `dbexportacioncontenedores`
--
ALTER TABLE `dbexportacioncontenedores`
  ADD CONSTRAINT `fk_exportacion_contenedor` FOREIGN KEY (`refexportaciones`) REFERENCES `dbexportaciones` (`idexportacion`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `dbexportaciondetalles`
--
ALTER TABLE `dbexportaciondetalles`
  ADD CONSTRAINT `fk_detalle_contenedor` FOREIGN KEY (`refexportacioncontenedores`) REFERENCES `dbexportacioncontenedores` (`idexportacioncontenedor`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `dbexportaciones`
--
ALTER TABLE `dbexportaciones`
  ADD CONSTRAINT `fk_exportacion_buques` FOREIGN KEY (`refbuques`) REFERENCES `tbbuques` (`idbuque`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_exportacion_cliente` FOREIGN KEY (`refclientes`) REFERENCES `dbclientes` (`idcliente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_exportacion_colores` FOREIGN KEY (`refcolores`) REFERENCES `tbcolores` (`idcolor`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_exportacion_destinos` FOREIGN KEY (`refdestinos`) REFERENCES `tbdestinos` (`iddestino`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_exportacion_puertos` FOREIGN KEY (`refpuertos`) REFERENCES `tbpuertos` (`idpuerto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
