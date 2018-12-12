-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 12-12-2018 a las 18:42:16
-- Versión del servidor: 10.2.16-MariaDB
-- Versión de PHP: 7.1.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `u235498999_aduan`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dbagenciareferentes`
--

CREATE TABLE `dbagenciareferentes` (
  `idagenciareferente` int(11) NOT NULL,
  `refagencias` int(11) NOT NULL,
  `refreferentes` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dbclientereferentes`
--

CREATE TABLE `dbclientereferentes` (
  `idclientereferente` int(11) NOT NULL,
  `refclientes` int(11) NOT NULL,
  `refreferentes` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `dbclientereferentes`
--

INSERT INTO `dbclientereferentes` (`idclientereferente`, `refclientes`, `refreferentes`) VALUES
(7, 4, 5),
(8, 4, 6),
(9, 4, 7),
(10, 4, 8),
(11, 4, 9),
(12, 4, 10),
(13, 4, 11);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dbclientes`
--

CREATE TABLE `dbclientes` (
  `idcliente` int(11) NOT NULL,
  `razonsocial` varchar(160) COLLATE utf8_spanish_ci NOT NULL,
  `cuit` varchar(11) COLLATE utf8_spanish_ci NOT NULL,
  `honorarios` decimal(18,2) NOT NULL,
  `minhonorarios` decimal(18,2) DEFAULT NULL,
  `gastos` decimal(18,2) DEFAULT NULL,
  `email` varchar(120) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `dbclientes`
--

INSERT INTO `dbclientes` (`idcliente`, `razonsocial`, `cuit`, `honorarios`, `minhonorarios`, `gastos`, `email`) VALUES
(4, 'ESTABLECIMIENTOS TEXTILES ITUZAINGO SACFI', '30502130540', '0.20', '2500.00', '1000.00', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dbexportacioncontenedores`
--

CREATE TABLE `dbexportacioncontenedores` (
  `idexportacioncontenedor` int(11) NOT NULL,
  `refexportaciones` int(11) NOT NULL,
  `contenedor` varchar(160) COLLATE utf8_spanish_ci NOT NULL,
  `tara` decimal(18,2) NOT NULL,
  `precinto` varchar(100) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `dbexportacioncontenedores`
--

INSERT INTO `dbexportacioncontenedores` (`idexportacioncontenedor`, `refexportaciones`, `contenedor`, `tara`, `precinto`) VALUES
(11, 10, 'fscu 985710/1', '3900.00', 'aaz 29987'),
(12, 11, 'HASU 410082/7', '3860.00', 'AAZ 30102'),
(13, 12, 'CLHU 886752/0', '3880.00', 'AAZ 30104'),
(14, 13, 'HASU 460676/0', '3860.00', 'AAZ 30103'),
(15, 16, 'FCIU 452909/4', '2180.00', 'AAZ 29980'),
(16, 17, 'HJMU 190855/1', '3940.00', 'AAZ 29983'),
(17, 18, 'FCIU 466583/2', '2180.00', 'AAZ 29984'),
(18, 19, 'HASU 444047/3', '3860.00', 'AAZ 29982'),
(19, 20, 'HLBU 101147/3', '3850.00', 'AAZ 29981'),
(20, 21, 'GESU 544701/7', '3890.00', 'AAZ 29815'),
(21, 22, 'SUDU 872992/9', '3860.00', 'AAZ 29816'),
(22, 23, 'CNIU 216452/7', '3640.00', 'AAZ  29649'),
(23, 24, 'UACU 512154/8', '3960.00', 'AAZ 29648'),
(24, 25, 'CNIU 217442/2', '3640.00', 'AAZ 28647'),
(25, 26, 'TCNU 857959/5', '3850.00', 'AAZ 29597'),
(26, 27, 'CPSU 643978/1', '3940.00', 'AAZ 29598'),
(27, 28, 'TCLU 935939/2', '3980.00', 'AAZ 29599'),
(28, 29, 'DFSU 741511/0', '3800.00', 'AAZ 29596'),
(29, 30, 'TCLU 503382/8', '3880.00', 'AAZ 29595'),
(30, 31, 'BMOU 453073/6', '3860.00', 'AAZ 30373'),
(31, 32, 'FSCU 985710/1', '3900.00', 'AAZ 29987'),
(32, 33, 'TGHU 914899/5', '3870.00', 'AAZ 30372'),
(33, 34, 'DFSU 631864/6', '3800.00', 'AAZ 30480'),
(34, 35, 'GESU 392721/2', '0.00', 'AAZ 30485'),
(35, 36, 'GESU 392721/2', '2175.00', 'AAZ 30485'),
(36, 37, 'GESU 496232/6', '3800.00', 'AAZ 30486'),
(38, 39, 'cniu 245929/8', '3820.00', 'aaz 30484'),
(39, 40, 'HASU 411178/1', '3860.00', 'AAZ 30880'),
(40, 41, 'HASU 414230/8', '3860.00', 'AAZ 30881'),
(41, 42, 'HASU 414192/9', '3860.00', 'AAZ 30883'),
(42, 43, 'HASU 402946/2', '3860.00', 'AAZ 30882');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dbexportaciondetalles`
--

CREATE TABLE `dbexportaciondetalles` (
  `idexportaciondetalle` int(11) NOT NULL,
  `refexportacioncontenedores` int(11) NOT NULL,
  `bulto` decimal(6,2) NOT NULL,
  `bruto` decimal(18,2) NOT NULL,
  `neto` decimal(18,2) NOT NULL,
  `marca` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `refmercaderias` int(11) NOT NULL,
  `valorunitario` decimal(18,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `dbexportaciondetalles`
--

INSERT INTO `dbexportaciondetalles` (`idexportaciondetalle`, `refexportacioncontenedores`, `bulto`, `bruto`, `neto`, `marca`, `refmercaderias`, `valorunitario`) VALUES
(18, 11, '13.00', '5600.00', '5548.00', 'itu 8141', 1, '15.80'),
(19, 11, '6.00', '2560.00', '2536.00', 'itu 8155 b', 1, '14.60'),
(20, 11, '14.00', '5940.00', '5884.00', 'itu 8189', 1, '8.20'),
(21, 12, '57.00', '23980.00', '23752.00', 'ITU 8121', 1, '9.92'),
(22, 13, '58.00', '24480.00', '24248.00', 'ARIS 4600005497', 1, '12.35'),
(23, 14, '62.00', '26120.00', '25872.00', 'T 8153', 1, '6.20'),
(24, 15, '15.00', '6340.00', '6280.00', 'ITU 8108 A', 1, '13.20'),
(25, 15, '9.00', '3820.00', '3784.00', 'ITU 8108 B', 1, '7.00'),
(26, 15, '7.00', '3000.00', '2972.00', 'ITU 8808 C', 1, '15.60'),
(27, 16, '68.00', '23920.00', '23580.00', 'ITU 8169 B', 4, '5.15'),
(28, 17, '19.00', '8120.00', '8044.00', 'ITU 8134 A', 1, '29.83'),
(29, 17, '3.00', '1280.00', '1268.00', 'ITU 8134 B', 1, '26.38'),
(30, 18, '68.00', '25660.00', '25320.00', 'ITU 8169 A', 4, '5.15'),
(31, 19, '36.00', '15340.00', '15196.00', 'ITU 8115 A/ITU 8104 A', 1, '12.45'),
(32, 19, '24.00', '10220.00', '10124.00', 'ITU 8115 B/ITU 8104 B', 1, '13.90'),
(33, 19, '2.00', '880.00', '872.00', 'ITU 8115 C', 1, '14.83'),
(34, 20, '49.00', '23790.00', '23643.00', 'GSY 131', 2, '8.96'),
(35, 21, '67.00', '23500.00', '23165.00', 'ITU 8171', 4, '3.30'),
(36, 22, '31.00', '13140.00', '13016.00', 'ITU 8161 A', 1, '12.00'),
(37, 22, '31.00', '13220.00', '13096.00', 'ITU 8161 B', 1, '10.10'),
(38, 23, '32.00', '12449.00', '12289.00', 'ITU 8170', 4, '1.35'),
(39, 23, '36.00', '12311.00', '12131.00', 'ITU 8170', 4, '3.30'),
(40, 24, '31.00', '13120.00', '12996.00', 'ITU 8125', 1, '11.90'),
(41, 24, '31.00', '13200.00', '13076.00', 'ITU 8126', 1, '11.90'),
(42, 25, '50.00', '22310.00', '22160.00', 'GSY 133', 2, '6.92'),
(43, 26, '51.00', '22500.00', '22347.00', 'GSY 132', 2, '3.86'),
(44, 27, '54.00', '25360.00', '25198.00', 'GSY 134', 2, '5.39'),
(45, 28, '68.00', '24680.00', '24340.00', 'ITU 8168', 4, '3.60'),
(46, 29, '58.00', '24460.00', '24228.00', 'T 8140', 1, '7.60'),
(47, 30, '16.00', '6860.00', '6796.00', 'ITU 8141/ITU 8155 A/ITU 8155 B', 1, '16.70'),
(48, 30, '18.00', '7600.00', '7528.00', 'ITU 8204/ITU 8205', 1, '9.20'),
(49, 30, '28.00', '11900.00', '11788.00', 'ITU 8206/ITU 8207', 1, '7.10'),
(50, 31, '13.00', '5600.00', '5548.00', 'ITU 8141', 1, '15.80'),
(51, 31, '6.00', '2560.00', '2536.00', 'ITU 8155', 1, '14.60'),
(52, 31, '14.00', '5940.00', '5884.00', 'ITU 8189', 1, '8.20'),
(53, 32, '50.00', '21270.00', '21070.00', 'ITU 8196', 1, '16.74'),
(54, 33, '57.00', '24240.00', '24012.00', 'ITU 8098', 1, '14.74'),
(55, 34, '7.00', '2940.00', '2912.00', 'ITU 8192 A', 1, '18.46'),
(56, 34, '6.00', '2540.00', '2516.00', 'ITU 8192 B', 1, '16.52'),
(57, 34, '6.00', '2560.00', '2536.00', 'ITU 8192 C', 1, '15.56'),
(58, 34, '13.00', '5540.00', '5488.00', 'ITU 8192 D', 1, '14.42'),
(59, 35, '2.00', '880.00', '871.00', 'ITU 8158', 1, '9.92'),
(60, 36, '33.00', '14040.00', '13891.00', 'ITU 8151', 1, '8.44'),
(61, 36, '23.00', '9660.00', '9556.00', 'ITU 8167', 1, '8.44'),
(63, 38, '58.00', '24580.00', '24348.00', 'eli 705', 1, '13.99'),
(64, 39, '51.00', '23720.00', '23567.00', 'GSY 135', 2, '9.91'),
(65, 40, '53.00', '24060.00', '23901.00', 'GESY 136', 2, '7.76'),
(66, 41, '45.00', '14380.00', '14203.00', 'ITU 8203', 3, '4.15'),
(67, 42, '59.00', '25040.00', '24804.00', 'BA 295 GROSS WEIGHT NET WEIGHT', 1, '4.30');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dbexportaciones`
--

CREATE TABLE `dbexportaciones` (
  `idexportacion` int(11) NOT NULL,
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
  `fechamodi` date DEFAULT NULL,
  `gastos` decimal(18,2) DEFAULT NULL,
  `honorarios` decimal(18,2) NOT NULL,
  `minhonorarios` decimal(18,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `dbexportaciones`
--

INSERT INTO `dbexportaciones` (`idexportacion`, `permisoembarque`, `refclientes`, `refbuques`, `refcolores`, `refdestinos`, `refpuertos`, `refagencias`, `booking`, `despachante`, `cuit`, `fecha`, `factura`, `tc`, `fechamodi`, `gastos`, `honorarios`, `minhonorarios`) VALUES
(10, '18047ec01000233h', 4, 1, 1, 3, 3, 1, '80493062', 'AVILA GUSTAVO OMAR', '20160883082', '2018-01-17', '', '18.90', '2018-02-05', '1000.00', '0.20', '2500.00'),
(11, '18047EC01000376P', 4, 3, 1, 1, 1, 3, '8BUEAD0004', 'AVILA GUSTAVO OMAR', '20160883082', '2018-01-25', '', '19.56', '2018-02-05', '1000.00', '0.20', '2500.00'),
(12, '18047EC01000379S', 4, 3, 1, 4, 1, 3, '8BUEAD0004', 'AVILA GUSTAVO OMAR', '20160883082', '2018-01-26', '', '19.56', '2018-02-05', '1000.00', '0.20', '2500.00'),
(13, '18047EC01000377Z', 4, 3, 1, 7, 5, 3, '8BUESA0096', 'AVILA GUSTAVO OMAR', '20160883082', '2018-01-25', '', '19.56', '2018-02-05', '1000.00', '0.20', '2500.00'),
(14, '18047EC01000606L', 4, 4, 1, 3, 6, 3, '8BUESA0582', 'AVILA GUSTAVO OMAR', '20160883082', '2018-02-07', '', '19.56', '2018-02-07', '1000.00', '0.20', '2500.00'),
(15, '18047EC01000606L', 4, 4, 1, 3, 6, 3, '8BUESA0582', 'AVILA GUSTAVO OMAR', '20160883082', '2018-02-07', '', '19.56', '2018-02-07', '1000.00', '0.20', '2500.00'),
(16, '18047EC01000204F', 4, 1, 1, 8, 7, 3, '8BUESA0233', 'AVILA GUSTAVO OMAR', '20160883082', '2018-01-15', '', '18.69', '2018-02-07', '1000.00', '0.20', '2500.00'),
(17, '18047EC01000183L', 4, 1, 1, 9, 8, 3, '8BUEKG0079', 'AVILA GUSTAVO OMAR', '20160883082', '2018-01-14', '', '18.69', '2018-02-07', '1000.00', '0.20', '2500.00'),
(18, '18047EC01000182K', 4, 1, 1, 1, 1, 3, '80493020', 'AVILA GUSTAVO OMAR', '20160883082', '2018-01-14', '', '18.69', '2018-02-07', '1000.00', '0.20', '2500.00'),
(19, '18047EC01000184M', 4, 1, 1, 9, 8, 3, '8BUEKG0079', 'AVILA GUSTAVO OMAR', '20160883082', '2018-01-14', '', '18.69', '2018-02-07', '1000.00', '0.20', '2500.00'),
(20, '18047EC01000207X', 4, 1, 1, 1, 1, 3, '80493020', 'AVILA GUSTAVO OMAR', '20160883082', '2018-01-15', '', '18.69', '2018-02-07', '1000.00', '0.20', '2500.00'),
(21, '18047EC01000158N', 4, 3, 3, 7, 9, 3, '7BUESA7936', 'AVILA GUSTAVO OMAR', '20160883082', '2018-01-11', '', '18.62', '2018-02-07', '1000.00', '0.20', '2500.00'),
(22, '18047EC01000156L', 4, 3, 1, 9, 8, 3, '8BUEKG0030', 'AVILA GUSTAVO OMAR', '20160883082', '2018-01-11', '', '18.62', '2018-02-07', '1000.00', '0.20', '2500.00'),
(23, '18047EC01000060F', 4, 5, 1, 10, 10, 3, '7BUEKG0905', 'AVILA GUSTAVO OMAR', '20160883082', '2018-01-04', '', '18.44', '2018-02-07', '1000.00', '0.20', '2500.00'),
(24, '18047EC01000059N', 4, 5, 1, 9, 11, 3, '80441033', 'AVILA GUSTAVO OMAR', '20160883082', '2018-01-04', '', '18.44', '2018-02-07', '1000.00', '0.20', '2500.00'),
(25, '18047EC01000061G', 4, 5, 1, 10, 10, 3, '7BUEKG0905', 'AVILA GUSTAVO OMAR', '20160883082', '2018-01-04', '', '18.44', '2018-02-07', '1000.00', '0.20', '2500.00'),
(26, '18047EC01000042F', 4, 5, 3, 9, 11, 3, '80506780', 'AVILA GUSTAVO OMAR', '20160883082', '2018-01-04', '', '18.44', '2018-02-07', '1000.00', '0.20', '2500.00'),
(27, '18047EC01000043G', 4, 5, 3, 9, 11, 3, '80506780', 'AVILA GUSTAVO OMAR', '20160883082', '2018-01-04', '', '18.44', '2018-02-07', '1000.00', '0.20', '2500.00'),
(28, '18047EC01000041E', 4, 5, 3, 9, 11, 3, '80506780', 'AVILA GUSTAVO OMAR', '20160883082', '2018-01-04', '', '18.44', '2018-02-07', '1000.00', '0.20', '2500.00'),
(29, '18047EC01000045X', 4, 5, 1, 9, 11, 3, '80441033', 'AVILA GUSTAVO OMAR', '20160883082', '2018-01-04', '', '18.44', '2018-02-07', '1000.00', '0.20', '2500.00'),
(30, '18047EC01000040D', 4, 5, 1, 7, 5, 3, '80493049', 'AVILA GUSTAVO OMAR', '20160883082', '2018-01-04', '', '18.44', '2018-02-07', '1000.00', '0.20', '2500.00'),
(31, '18047EC01000474Y', 4, 2, 1, 3, 3, 3, '80828205', 'AVILA GUSTAVO OMAR', '20160883082', '2018-01-31', '', '19.63', '2018-02-08', '1000.00', '0.20', '2500.00'),
(32, '18047EC01000233H', 4, 1, 1, 3, 3, 3, '80493062', 'AVILA GUSTAVO OMAR', '20160883082', '2017-12-17', '', '18.90', '2018-02-08', '1000.00', '0.20', '2500.00'),
(33, '18047EC01000476Z', 4, 2, 1, 6, 4, 3, '80828236', 'AVILA GUSTAVO OMAR', '20160883082', '2018-01-31', '', '19.63', '2018-02-08', '1000.00', '0.20', '2500.00'),
(34, '18047EC01000486R', 4, 2, 1, 1, 1, 3, '8BUEAD019', 'AVILA GUSTAVO OMAR', '20160883082', '2018-02-02', '', '19.38', '2018-02-08', '1000.00', '0.20', '2500.00'),
(35, '18047EC01000616M', 4, 4, 1, 1, 1, 3, '8BUEAD0063', 'AVILA GUSTAVO OMAR', '20160883082', '2018-02-08', '', '19.69', '2018-02-08', '1000.00', '0.20', '2500.00'),
(36, '18047EC01000615L', 4, 4, 1, 1, 1, 3, '8BUEAD0063', 'AVILA GUSTAVO OMAR', '20160883082', '2018-02-08', '', '19.69', '2018-02-08', '1000.00', '0.20', '2500.00'),
(37, '18047EC01000606L', 4, 4, 1, 3, 6, 3, '8BUESA0582', 'AVILA GUSTAVO OMAR', '20160883082', '2018-02-07', '', '19.56', '2018-02-08', '1000.00', '0.20', '2500.00'),
(39, '18047ec01000608n', 4, 4, 1, 3, 6, 3, '8buesa0582', 'AVILA GUSTAVO OMAR', '20160883082', '2018-02-07', '', '19.56', '2018-02-08', '1000.00', '0.20', '2500.00'),
(40, '18047EC01000708Y', 4, 6, 3, 7, 9, 3, '8BUESA1242', 'AVILA GUSTAVO OMAR', '20160883082', '2018-02-14', '', '19.98', '2018-02-15', '1000.00', '0.20', '2500.00'),
(41, '18047EC01000706M', 4, 6, 3, 7, 9, 3, '8BUESA1242', 'AVILA GUSTAVO OMAR', '20160883082', '2018-02-14', '', '19.98', '2018-02-15', '1000.00', '0.20', '2500.00'),
(42, '18047EC01000714L', 4, 6, 3, 3, 6, 3, '8BUESA0279', 'AVILA GUSTAVO OMAR', '20160883082', '2018-02-14', '', '19.98', '2018-02-15', '1000.00', '0.20', '2500.00'),
(43, '18047EC01000712J', 4, 6, 1, 5, 12, 3, '8BUESA0970', 'AVILA GUSTAVO OMAR', '20160883082', '2018-02-14', '', '19.98', '2018-02-15', '1000.00', '0.20', '2500.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dbusuarios`
--

CREATE TABLE `dbusuarios` (
  `idusuario` int(11) NOT NULL,
  `usuario` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `refroles` int(11) NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `nombrecompleto` varchar(120) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `dbusuarios`
--

INSERT INTO `dbusuarios` (`idusuario`, `usuario`, `password`, `refroles`, `email`, `nombrecompleto`) VALUES
(1, 'Marcos', 'marcos', 1, 'admin@admin.com', 'Marcos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `predio_menu`
--

CREATE TABLE `predio_menu` (
  `idmenu` int(11) NOT NULL,
  `url` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `icono` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `nombre` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `Orden` smallint(6) DEFAULT NULL,
  `hover` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `permiso` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `predio_menu`
--

INSERT INTO `predio_menu` (`idmenu`, `url`, `icono`, `nombre`, `Orden`, `hover`, `permiso`) VALUES
(1, '../index.php', 'icodashboard', 'Dashboard', 0, NULL, 'Empleado, Administrador, SuperAdmin'),
(3, '../exportaciones/', 'icotorneos', 'Exportaciones', 2, NULL, 'Empleado, Administrador, SuperAdmin'),
(4, '../clientes/', 'icousuarios', 'Clientes', 6, NULL, 'Empleado, Administrador, SuperAdmin'),
(5, '../mercaderia/', 'icoproductos', 'Mercaderia', 2, NULL, 'Empleado, Administrador, SuperAdmin'),
(6, '../buques/', 'icocontratos', 'Buques', 12, NULL, 'Empleado, Administrador, SuperAdmin'),
(7, '../reportes/', 'icoreportes', 'Reportes', 16, NULL, 'Empleado, Administrador, SuperAdmin'),
(8, '../logout.php', 'icosalir', 'Salir', 30, NULL, 'Empleado, Administrador, SuperAdmin'),
(9, '../destinos/', 'icoconfiguracion', 'Destinos', 14, NULL, 'Empleado, Administrador, SuperAdmin'),
(15, '../colores/', 'icozonas', 'Canales', 8, NULL, 'Empleado, Administrador, SuperAdmin'),
(16, '../usuarios/', 'icojugadores', 'Usuarios', 13, NULL, 'Empleado, Administrador, SuperAdmin'),
(17, '../puertos/', 'icozonas', 'Puertos', 5, NULL, 'Empleado, Administrador, SuperAdmin'),
(18, '../configuracion/', 'icoconfiguracion', 'Configuracion', 19, NULL, 'Empleado, Administrador, SuperAdmin'),
(19, '../agencias/', 'icozonas', 'Agencias', 7, NULL, 'Empleado, Administrador, SuperAdmin'),
(20, '../referentes/', 'icousuarios', 'Referentes', 11, NULL, 'Empleado, Administrador, SuperAdmin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbagencias`
--

CREATE TABLE `tbagencias` (
  `idagencia` int(11) NOT NULL,
  `agencia` varchar(120) COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(120) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tbagencias`
--

INSERT INTO `tbagencias` (`idagencia`, `agencia`, `email`) VALUES
(3, 'AGENCIA MARTIN SRL', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbbuques`
--

CREATE TABLE `tbbuques` (
  `idbuque` int(11) NOT NULL,
  `nombre` varchar(120) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tbbuques`
--

INSERT INTO `tbbuques` (`idbuque`, `nombre`) VALUES
(1, 'NORDIC STRALSUND'),
(2, 'ARICA EXRESSS'),
(3, 'SATURN'),
(4, 'ALGOL'),
(5, 'SAN VICENTE EXPRESS'),
(6, 'NORDIC MACAU');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbcolores`
--

CREATE TABLE `tbcolores` (
  `idcolor` int(11) NOT NULL,
  `color` varchar(120) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tbcolores`
--

INSERT INTO `tbcolores` (`idcolor`, `color`) VALUES
(1, 'NARANJA'),
(2, 'ROJO'),
(3, 'VERDE');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbconfiguracion`
--

CREATE TABLE `tbconfiguracion` (
  `idtbconfiguracion` int(11) NOT NULL,
  `razonsocial` varchar(160) COLLATE utf8_spanish_ci NOT NULL,
  `cuit` varchar(11) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tbconfiguracion`
--

INSERT INTO `tbconfiguracion` (`idtbconfiguracion`, `razonsocial`, `cuit`) VALUES
(2, 'AVILA GUSTAVO OMAR', '20160883082');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbdestinos`
--

CREATE TABLE `tbdestinos` (
  `iddestino` int(11) NOT NULL,
  `destino` varchar(120) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tbdestinos`
--

INSERT INTO `tbdestinos` (`iddestino`, `destino`) VALUES
(1, 'PERU'),
(2, 'ESPAÑA'),
(3, 'ALEMANIA'),
(4, 'PERU'),
(5, 'TURQUIA'),
(6, 'MEXICO'),
(7, 'ITALIA'),
(8, 'REINO UNIDO'),
(9, 'CHINA'),
(10, 'KOREA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbmercaderias`
--

CREATE TABLE `tbmercaderias` (
  `idmercaderia` int(11) NOT NULL,
  `nombre` varchar(120) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tbmercaderias`
--

INSERT INTO `tbmercaderias` (`idmercaderia`, `nombre`) VALUES
(1, 'TOPS DE LANA'),
(2, 'LANA OVINA SUCIA'),
(3, 'LANA OVINA LAVADA'),
(4, 'BLOUSSE DE LANA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbpuertos`
--

CREATE TABLE `tbpuertos` (
  `idpuerto` int(11) NOT NULL,
  `puerto` varchar(120) COLLATE utf8_spanish_ci NOT NULL,
  `bandera` varchar(120) COLLATE utf8_spanish_ci DEFAULT NULL,
  `refdestinos` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tbpuertos`
--

INSERT INTO `tbpuertos` (`idpuerto`, `puerto`, `bandera`, `refdestinos`) VALUES
(1, 'CALLAO', '', 1),
(3, 'BREMERHAVEN', '', 3),
(4, 'QUECHOLAC', 'MEXICO', 6),
(5, 'LIVORNO', '', 7),
(6, 'BLUMENTHAL', '', 3),
(7, 'BRADFORD', '', 8),
(8, 'SHANGHAI', '', 9),
(9, 'GENOVA', '', 7),
(10, 'BUSAN', '', 10),
(11, 'ZHANGJIAGANG', '', 9),
(12, 'MERSIN', '', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbreferentes`
--

CREATE TABLE `tbreferentes` (
  `idreferente` int(11) NOT NULL,
  `email` varchar(120) COLLATE utf8_spanish_ci NOT NULL,
  `razonsocial` varchar(120) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tbreferentes`
--

INSERT INTO `tbreferentes` (`idreferente`, `email`, `razonsocial`) VALUES
(5, 'gmeoqui@agencia-martin.com.ar', 'AGENCIA MARITIMA MARTIN SRL'),
(6, 'ffernandez@agencia-martin.com.ar', 'AGENCIA MARITIMA MARTIN SRL'),
(7, 'plazoleta@appm.com.ar', 'ADMINISTRACION PORTUARIA DE PUERTO MADRYN'),
(8, 'gustavo@procomex.com.ar', 'PROCOMEX COMERCIO EXTERIOR'),
(9, 'danyfuentes@ituzaingowool.com.ar', 'ESTABLECIMIENTOS TEXTILES ITUZAINGO'),
(10, 'julian@ituzaingowool.com.ar', 'ESTABLECIMIENTOS TEXTILES ITUZAINGO'),
(11, 'fillesca@ituzaingowool.com.ar', 'ESTABLECIMIENTOS TEXTILES ITUZAINGO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbroles`
--

CREATE TABLE `tbroles` (
  `idrol` int(11) NOT NULL,
  `descripcion` varchar(45) NOT NULL,
  `activo` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbroles`
--

INSERT INTO `tbroles` (`idrol`, `descripcion`, `activo`) VALUES
(1, 'Administrador', b'0');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `dbagenciareferentes`
--
ALTER TABLE `dbagenciareferentes`
  ADD PRIMARY KEY (`idagenciareferente`),
  ADD KEY `fk_ar_agencias_idx` (`refagencias`),
  ADD KEY `fk_ar_referentes_idx` (`refreferentes`);

--
-- Indices de la tabla `dbclientereferentes`
--
ALTER TABLE `dbclientereferentes`
  ADD PRIMARY KEY (`idclientereferente`),
  ADD KEY `fk_cr_clientes_idx` (`refclientes`),
  ADD KEY `fk_cr_referentes_idx` (`refreferentes`);

--
-- Indices de la tabla `dbclientes`
--
ALTER TABLE `dbclientes`
  ADD PRIMARY KEY (`idcliente`);

--
-- Indices de la tabla `dbexportacioncontenedores`
--
ALTER TABLE `dbexportacioncontenedores`
  ADD PRIMARY KEY (`idexportacioncontenedor`),
  ADD KEY `fk_exportacion_contenedor_idx` (`refexportaciones`);

--
-- Indices de la tabla `dbexportaciondetalles`
--
ALTER TABLE `dbexportaciondetalles`
  ADD PRIMARY KEY (`idexportaciondetalle`),
  ADD KEY `fk_detalle_contenedor_idx` (`refexportacioncontenedores`);

--
-- Indices de la tabla `dbexportaciones`
--
ALTER TABLE `dbexportaciones`
  ADD PRIMARY KEY (`idexportacion`),
  ADD KEY `fk_exportacion_cliente_idx` (`refclientes`),
  ADD KEY `fk_exportacion_buques_idx` (`refbuques`),
  ADD KEY `fk_exportacion_colores_idx` (`refcolores`),
  ADD KEY `fk_exportacion_puertos_idx` (`refpuertos`),
  ADD KEY `fk_exportacion_destinos_idx` (`refdestinos`);

--
-- Indices de la tabla `dbusuarios`
--
ALTER TABLE `dbusuarios`
  ADD PRIMARY KEY (`idusuario`),
  ADD KEY `fk_dbusuarios_tbroles1_idx` (`refroles`);

--
-- Indices de la tabla `predio_menu`
--
ALTER TABLE `predio_menu`
  ADD PRIMARY KEY (`idmenu`);

--
-- Indices de la tabla `tbagencias`
--
ALTER TABLE `tbagencias`
  ADD PRIMARY KEY (`idagencia`);

--
-- Indices de la tabla `tbbuques`
--
ALTER TABLE `tbbuques`
  ADD PRIMARY KEY (`idbuque`);

--
-- Indices de la tabla `tbcolores`
--
ALTER TABLE `tbcolores`
  ADD PRIMARY KEY (`idcolor`);

--
-- Indices de la tabla `tbconfiguracion`
--
ALTER TABLE `tbconfiguracion`
  ADD PRIMARY KEY (`idtbconfiguracion`);

--
-- Indices de la tabla `tbdestinos`
--
ALTER TABLE `tbdestinos`
  ADD PRIMARY KEY (`iddestino`);

--
-- Indices de la tabla `tbmercaderias`
--
ALTER TABLE `tbmercaderias`
  ADD PRIMARY KEY (`idmercaderia`);

--
-- Indices de la tabla `tbpuertos`
--
ALTER TABLE `tbpuertos`
  ADD PRIMARY KEY (`idpuerto`),
  ADD KEY `fk_puerto_destinos_idx` (`refdestinos`);

--
-- Indices de la tabla `tbreferentes`
--
ALTER TABLE `tbreferentes`
  ADD PRIMARY KEY (`idreferente`);

--
-- Indices de la tabla `tbroles`
--
ALTER TABLE `tbroles`
  ADD PRIMARY KEY (`idrol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `dbagenciareferentes`
--
ALTER TABLE `dbagenciareferentes`
  MODIFY `idagenciareferente` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `dbclientereferentes`
--
ALTER TABLE `dbclientereferentes`
  MODIFY `idclientereferente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `dbclientes`
--
ALTER TABLE `dbclientes`
  MODIFY `idcliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `dbexportacioncontenedores`
--
ALTER TABLE `dbexportacioncontenedores`
  MODIFY `idexportacioncontenedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT de la tabla `dbexportaciondetalles`
--
ALTER TABLE `dbexportaciondetalles`
  MODIFY `idexportaciondetalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT de la tabla `dbexportaciones`
--
ALTER TABLE `dbexportaciones`
  MODIFY `idexportacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT de la tabla `dbusuarios`
--
ALTER TABLE `dbusuarios`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `predio_menu`
--
ALTER TABLE `predio_menu`
  MODIFY `idmenu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `tbagencias`
--
ALTER TABLE `tbagencias`
  MODIFY `idagencia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tbbuques`
--
ALTER TABLE `tbbuques`
  MODIFY `idbuque` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `tbcolores`
--
ALTER TABLE `tbcolores`
  MODIFY `idcolor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tbconfiguracion`
--
ALTER TABLE `tbconfiguracion`
  MODIFY `idtbconfiguracion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tbdestinos`
--
ALTER TABLE `tbdestinos`
  MODIFY `iddestino` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `tbmercaderias`
--
ALTER TABLE `tbmercaderias`
  MODIFY `idmercaderia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tbpuertos`
--
ALTER TABLE `tbpuertos`
  MODIFY `idpuerto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `tbreferentes`
--
ALTER TABLE `tbreferentes`
  MODIFY `idreferente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `tbroles`
--
ALTER TABLE `tbroles`
  MODIFY `idrol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `dbagenciareferentes`
--
ALTER TABLE `dbagenciareferentes`
  ADD CONSTRAINT `fk_ar_agencias` FOREIGN KEY (`refagencias`) REFERENCES `tbagencias` (`idagencia`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ar_referentes` FOREIGN KEY (`refreferentes`) REFERENCES `tbreferentes` (`idreferente`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `dbclientereferentes`
--
ALTER TABLE `dbclientereferentes`
  ADD CONSTRAINT `fk_cr_clientes` FOREIGN KEY (`refclientes`) REFERENCES `dbclientes` (`idcliente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_cr_referentes` FOREIGN KEY (`refreferentes`) REFERENCES `tbreferentes` (`idreferente`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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

--
-- Filtros para la tabla `tbpuertos`
--
ALTER TABLE `tbpuertos`
  ADD CONSTRAINT `fk_puerto_destinos` FOREIGN KEY (`refdestinos`) REFERENCES `tbdestinos` (`iddestino`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
