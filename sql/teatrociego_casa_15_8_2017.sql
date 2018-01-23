-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 15-08-2017 a las 07:30:20
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=10 ;

--
-- Volcado de datos para la tabla `dbcategorias`
--

INSERT INTO `dbcategorias` (`idcategoria`, `descripcion`, `refobras`, `refcuponeras`, `porcentaje`, `monto`, `pocentajeretenido`) VALUES
(1, 'Groupon', 1, 2, '36.43', '0.00', '24.20'),
(8, 'Big Box', 1, 3, '0.00', '0.00', '30.00'),
(9, 'Big Box', 2, 3, '0.00', '0.00', '30.00');

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
  `puntos` int(11) NOT NULL,
  `puntosproduccion` int(11) NOT NULL,
  `puntossinproduccion` int(11) NOT NULL,
  `fechacreacion` date DEFAULT NULL,
  `usuacrea` varchar(60) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fechamodi` date DEFAULT NULL,
  `usuamodi` varchar(60) COLLATE utf8_spanish_ci DEFAULT NULL,
  `activo` bit(1) DEFAULT NULL,
  PRIMARY KEY (`idcooperativa`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `dbcooperativas`
--

INSERT INTO `dbcooperativas` (`idcooperativa`, `descripcion`, `puntos`, `puntosproduccion`, `puntossinproduccion`, `fechacreacion`, `usuacrea`, `fechamodi`, `usuamodi`, `activo`) VALUES
(1, 'Babilonia FX - Viernes', 16, 3, 13, '2017-05-05', 'Saupurein Marcos', '2017-08-15', 'Saupurein Marcos', b'1'),
(2, 'Teatro a Ciegas', 16, 10, 6, '2017-08-15', 'Saupurein Marcos', '0000-00-00', '', b'1');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `dbdatosbancos`
--

INSERT INTO `dbdatosbancos` (`iddatobanco`, `refpersonal`, `cbu`, `nrocuenta`, `tipoproducto`, `formaoperar`, `fechacrea`, `usuacrea`, `fechamodi`, `usuamodi`) VALUES
(1, 1, '0173331115555566555333', '66555', '', '', '0000-00-00', '', '0000-00-00', '');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `dbdomicilios`
--

INSERT INTO `dbdomicilios` (`iddomicilio`, `refpersonal`, `calle`, `nro`, `piso`, `departamento`, `codigopostal`, `localidad`, `provincia`, `telefonoparticular`, `telefonocelular`) VALUES
(1, 1, '36', '133', NULL, '', '1900', '', '', '', '');

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
  PRIMARY KEY (`idfuncion`),
  KEY `fk_funcion_obras_idx` (`refobras`),
  KEY `fk_funcion_cooperativa_idx` (`refcooperativas`),
  KEY `fk_funciones_dias_idx` (`refdias`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `dbfunciones`
--

INSERT INTO `dbfunciones` (`idfuncion`, `refobras`, `refcooperativas`, `horario`, `refdias`) VALUES
(1, 1, 1, '15:00:00', 1),
(2, 1, 1, '15:00:00', 3),
(3, 1, 1, '15:00:00', 5);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=2 ;

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
  PRIMARY KEY (`idobra`),
  KEY `fk_obras_salas_idx` (`refsalas`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `dbobras`
--

INSERT INTO `dbobras` (`idobra`, `nombre`, `refsalas`, `valorentrada`, `cantpulicidad`, `valorpulicidad`, `valorticket`, `costotranscciontarjetaiva`, `porcentajeargentores`, `porcentajereparto`, `porcentajeretencion`, `fechacreacion`, `usuacrea`, `fechamodi`, `usuamodi`, `activo`) VALUES
(1, 'Babilonia FX - Viernes', 1, '250.00', 2, '500.00', '1.50', '6.05', '10.00', '70.00', '6.00', '2017-05-04', 'Saupurein Marcos', '2017-05-04', 'Saupurein Marcos', b'1'),
(2, 'Sonido 360', 1, '100.00', 1, '150.00', '1.50', '6.05', '0.00', '10.00', '0.00', '2017-05-04', 'Saupurein Marcos', '2017-06-06', 'Saupurein Marcos', b'1');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=9 ;

--
-- Volcado de datos para la tabla `dbobrascooperativas`
--

INSERT INTO `dbobrascooperativas` (`idobracooperativa`, `refobras`, `refcooperativas`) VALUES
(8, 1, 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `dbpersonal`
--

INSERT INTO `dbpersonal` (`idpersonal`, `reftipodocumento`, `nrodocumento`, `apellido`, `nombre`, `fechanacimiento`, `cuil`, `sexo`, `refestadocivil`, `paisorigen`, `fechacrea`, `usuacrea`, `fechamodi`, `usuamodi`) VALUES
(1, 1, 31552466, 'Saupurein', 'Marcos', '1985-05-20', 2147483647, 'Masculino', 1, 'Argentina', '0000-00-00', 'Saupurein Marcos', '0000-00-00', '');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `dbpersonalcargos`
--

INSERT INTO `dbpersonalcargos` (`idpersonalcargo`, `refpersonal`, `reftiposcargos`, `reffunciones`, `fechaalta`, `fechabaja`, `fechabajatentativa`, `puntos`, `monto`, `fechacrea`, `usuacrea`, `fechamodi`, `usuamodi`) VALUES
(1, 1, 2, 1, '2017-08-15', '2017-08-15', NULL, '1.00', '0.00', '2017-08-15', 'Saupurein Marcos', '2017-08-15', ''),
(2, 1, 2, 1, '2017-08-15', NULL, NULL, '1.00', '0.00', '2017-08-15', 'Saupurein Marcos', '2017-08-15', ''),
(7, 1, 2, 3, '2017-08-15', NULL, NULL, '1.00', '0.00', '2017-08-15', 'Saupurein Marcos', '2017-08-15', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dbpersonalcooperativas`
--

CREATE TABLE IF NOT EXISTS `dbpersonalcooperativas` (
  `idpersonalcooperativa` int(11) NOT NULL AUTO_INCREMENT,
  `refpersonal` int(11) NOT NULL,
  `refcooperativas` int(11) NOT NULL,
  PRIMARY KEY (`idpersonalcooperativa`),
  UNIQUE KEY `index_idpersonal` (`refpersonal`,`refcooperativas`),
  KEY `fk_pc_personal_idx` (`refpersonal`),
  KEY `fk_pc_cooperativa_idx` (`refcooperativas`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `dbpersonalcooperativas`
--

INSERT INTO `dbpersonalcooperativas` (`idpersonalcooperativa`, `refpersonal`, `refcooperativas`) VALUES
(5, 1, 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=10 ;

--
-- Volcado de datos para la tabla `dbpromosobras`
--

INSERT INTO `dbpromosobras` (`idpromoobra`, `descripcion`, `refobras`, `vigenciadesde`, `vigenciahasta`, `porcentaje`, `monto`) VALUES
(3, 'PreVenta', 1, '2017-06-05', '2017-06-09', '0.00', '200.00'),
(4, 'Full', 1, '2017-06-04', '0000-00-00', '0.00', '0.00'),
(5, '20%', 1, '2017-06-04', '0000-00-00', '20.00', '0.00'),
(6, '50%', 1, '2017-06-04', '0000-00-00', '50.00', '0.00'),
(7, 'Invitados teatro', 1, '2017-06-04', '0000-00-00', '100.00', '0.00'),
(8, 'Invitados cooperativas', 1, '2017-06-04', '0000-00-00', '100.00', '0.00'),
(9, 'Promoteatro', 1, '2017-06-04', '0000-00-00', '50.00', '0.00');

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
  PRIMARY KEY (`idusuario`),
  KEY `fk_dbusuarios_tbroles1_idx` (`refroles`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `dbusuarios`
--

INSERT INTO `dbusuarios` (`idusuario`, `usuario`, `password`, `refroles`, `email`, `nombrecompleto`) VALUES
(1, 'marcos', 'marcos', 1, 'msredhotero@msn.com', 'Saupurein Marcos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dbventas`
--

CREATE TABLE IF NOT EXISTS `dbventas` (
  `idventa` int(11) NOT NULL AUTO_INCREMENT,
  `numero` varchar(12) COLLATE utf8_spanish_ci NOT NULL,
  `reftipopago` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `total` decimal(12,2) NOT NULL,
  `cancelado` bit(1) DEFAULT NULL,
  `usuario` varchar(120) COLLATE utf8_spanish_ci DEFAULT NULL,
  `refcategorias` int(11) DEFAULT NULL,
  `refpromosobras` int(11) DEFAULT NULL,
  `reffunciones` int(11) DEFAULT NULL,
  `refalbum` int(11) DEFAULT NULL,
  `monto` decimal(18,2) DEFAULT NULL,
  `porcentaje` decimal(18,2) DEFAULT NULL,
  `valorentrada` decimal(18,2) DEFAULT NULL,
  `observacion` varchar(300) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fechacreacion` date DEFAULT NULL,
  `usuacrea` varchar(120) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fechamodi` date DEFAULT NULL,
  `usuamodi` varchar(120) COLLATE utf8_spanish_ci DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  PRIMARY KEY (`idventa`),
  KEY `fk_ventas_tipopago_idx` (`reftipopago`),
  KEY `fk_ventas_funciones_idx` (`reffunciones`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=5 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=28 ;

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
(27, '../funciones/', 'icocinema', 'Funciones', 11, NULL, 'Empleado, Administrador, SuperAdmin');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `tbcuponeras`
--

INSERT INTO `tbcuponeras` (`idcuponera`, `nombre`, `direccion`, `telefono`, `cuit`, `email`, `activo`) VALUES
(1, 'Atrapalo', '', '', '', '', b'1'),
(2, 'Groupon', '', '', '', '', b'1'),
(3, 'Big Box', '', '', '', '', b'1'),
(4, 'Flipaste', '', '', '', '', b'1'),
(5, 'Ticket Hoy', '', '', '', '', b'1');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `tbsalas`
--

INSERT INTO `tbsalas` (`idsala`, `descripcion`, `capacidad`, `activa`) VALUES
(1, 'Abajo', 75, b'1');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

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
  ADD CONSTRAINT `fk_obras_salas` FOREIGN KEY (`refsalas`) REFERENCES `tbsalas` (`idsala`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
  ADD CONSTRAINT `index_idpersonal` FOREIGN KEY (`refpersonal`) REFERENCES `dbpersonal` (`idpersonal`),
  ADD CONSTRAINT `fk_pc_cooperativa` FOREIGN KEY (`refcooperativas`) REFERENCES `dbcooperativas` (`idcooperativa`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_pc_personal` FOREIGN KEY (`refpersonal`) REFERENCES `dbpersonal` (`idpersonal`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `dbpromosobras`
--
ALTER TABLE `dbpromosobras`
  ADD CONSTRAINT `fk_promo_obras` FOREIGN KEY (`refobras`) REFERENCES `dbobras` (`idobra`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `dbventas`
--
ALTER TABLE `dbventas`
  ADD CONSTRAINT `fk_ventas_funciones` FOREIGN KEY (`reffunciones`) REFERENCES `dbfunciones` (`idfuncion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ventas_tipopago` FOREIGN KEY (`reftipopago`) REFERENCES `tbtipopago` (`idtipopago`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
