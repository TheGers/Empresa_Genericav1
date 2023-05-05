-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-05-2023 a las 04:16:16
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `gersonv2`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_acceso`
--

CREATE TABLE `tbl_acceso` (
  `id` int(11) NOT NULL,
  `evento` varchar(30) NOT NULL,
  `ip` varchar(50) NOT NULL,
  `detalle` text NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_acceso`
--

INSERT INTO `tbl_acceso` (`id`, `evento`, `ip`, `detalle`, `fecha`, `status`) VALUES
(0, 'Inicio de Sesión', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', '2023-04-27 09:05:36', 1),
(0, 'Inicio de Sesión', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', '2023-04-27 09:14:14', 1),
(0, 'Inicio de Sesión', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', '2023-04-27 09:24:37', 1),
(0, 'Inicio de Sesión', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', '2023-04-27 22:00:37', 1),
(0, 'Inicio de Sesión', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', '2023-04-27 23:02:05', 1),
(0, 'Inicio de Sesión', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', '2023-04-28 05:02:00', 1),
(0, 'Inicio de Sesión', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', '2023-04-28 05:02:22', 1),
(0, 'Inicio de Sesión', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', '2023-04-28 05:02:39', 1),
(0, 'Inicio de Sesión', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', '2023-04-28 05:03:11', 1),
(0, 'Inicio de Sesión', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', '2023-04-28 05:03:42', 1),
(0, 'Inicio de Sesión', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', '2023-04-28 05:03:58', 1),
(0, 'Inicio de Sesión', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', '2023-04-28 06:13:49', 1),
(0, 'Inicio de Sesión', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', '2023-05-01 00:24:57', 1),
(0, 'Inicio de Sesión', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', '2023-05-01 00:29:26', 1),
(0, 'Inicio de Sesión', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', '2023-05-01 00:46:08', 1),
(0, 'Inicio de Sesión', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', '2023-05-01 07:56:28', 1),
(0, 'Inicio de Sesión', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', '2023-05-01 08:03:30', 1),
(0, 'Inicio de Sesión', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', '2023-05-02 01:18:34', 1),
(0, 'Inicio de Sesión', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', '2023-05-02 02:49:30', 1),
(0, 'Inicio de Sesión', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', '2023-05-02 02:50:30', 1),
(0, 'Inicio de Sesión', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', '2023-05-02 02:53:37', 1),
(0, 'Inicio de Sesión', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', '2023-05-02 03:04:45', 1),
(0, 'Inicio de Sesión', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', '2023-05-02 03:15:13', 1),
(0, 'Inicio de Sesión', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', '2023-05-02 05:33:10', 1),
(0, 'Inicio de Sesión', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', '2023-05-02 05:34:45', 1),
(0, 'Inicio de Sesión', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', '2023-05-02 05:35:23', 1),
(0, 'Inicio de Sesión', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', '2023-05-02 05:35:59', 1),
(0, 'Inicio de Sesión', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', '2023-05-02 05:36:28', 1),
(0, 'Inicio de Sesión', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', '2023-05-02 05:37:58', 1),
(0, 'Inicio de Sesión', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', '2023-05-02 05:43:17', 1),
(0, 'Inicio de Sesión', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', '2023-05-02 05:45:58', 1),
(0, 'Inicio de Sesión', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', '2023-05-02 07:00:23', 1),
(0, 'Inicio de Sesión', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', '2023-05-02 07:00:38', 1),
(0, 'Inicio de Sesión', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', '2023-05-02 07:08:59', 1),
(0, 'Inicio de Sesión', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', '2023-05-02 07:09:13', 1),
(0, 'Inicio de Sesión', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', '2023-05-02 08:34:43', 1),
(0, 'Inicio de Sesión', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', '2023-05-02 08:43:00', 1),
(0, 'Inicio de Sesión', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', '2023-05-02 10:07:07', 1),
(0, 'Inicio de Sesión', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', '2023-05-03 03:07:15', 1),
(0, 'Inicio de Sesión', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', '2023-05-03 04:05:06', 1),
(0, 'Inicio de Sesión', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', '2023-05-03 19:17:47', 1),
(0, 'Inicio de Sesión', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', '2023-05-03 21:33:54', 1),
(0, 'Inicio de Sesión', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', '2023-05-03 23:28:59', 1),
(0, 'Inicio de Sesión', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36 Edg/112.0.1722.68', '2023-05-04 00:06:04', 1),
(0, 'Inicio de Sesión', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', '2023-05-04 04:52:27', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_bitacora`
--

CREATE TABLE `tbl_bitacora` (
  `id` int(11) NOT NULL,
  `accion` varchar(45) DEFAULT NULL,
  `FECHA_CREACION` datetime DEFAULT current_timestamp(),
  `CREADO_POR` varchar(45) NOT NULL,
  `MODIFICADO_POR` varchar(45) NOT NULL,
  `FECHA_MODIFICADO` varchar(45) NOT NULL,
  `status` int(45) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_bitacora`
--

INSERT INTO `tbl_bitacora` (`id`, `accion`, `FECHA_CREACION`, `CREADO_POR`, `MODIFICADO_POR`, `FECHA_MODIFICADO`, `status`) VALUES
(147, 'Se actualizo un nuevo usuario ', '2023-05-01 19:23:38', 'Gerson', 'Gerson', '02-05-2023 (03:25:51)', 1),
(148, 'Se inserto un nuevo usuario', '2023-05-01 19:26:22', 'Gerson', '', '', 1),
(149, 'Se actualizo un nuevo usuario ', '2023-05-01 19:26:22', 'Gerson', 'Gerson', '02-05-2023 (03:26:34)', 1),
(150, 'Se actualizo un nuevo usuario ', '2023-04-24 14:20:31', 'David', 'Gerson', '28-04-2023 (07:01:49)', 1),
(151, 'Se actualizo un nuevo usuario ', '2023-04-24 14:20:31', 'David', 'Gerson', '28-04-2023 (07:01:49)', 1),
(152, 'Se actualizo un nuevo usuario ', '2023-04-24 14:20:31', 'David', 'Gerson', '28-04-2023 (07:01:49)', 1),
(153, 'Se actualizo un nuevo usuario ', '2023-04-24 14:20:31', 'David', 'Gerson', '28-04-2023 (07:01:49)', 1),
(154, 'Se actualizo un nuevo usuario ', '2023-04-24 14:20:31', 'David', 'Gerson', '28-04-2023 (07:01:49)', 1),
(155, 'Se actualizo un nuevo usuario ', '2023-05-01 19:26:22', 'Gerson', 'Gerson', '02-05-2023 (03:26:34)', 1),
(156, 'Se actualizo un nuevo usuario ', '2023-04-27 23:03:31', 'David', 'Registro', '28-04-2023 (07:11:53)', 1),
(157, 'Se actualizo un nuevo usuario ', '2023-04-25 20:48:41', 'Gerson', 'Gerson', '28-04-2023 (05:27:31)', 1),
(158, 'Se actualizo un nuevo usuario ', '2023-04-24 14:20:31', 'David', 'Gerson', '04-05-2023 (00:35:11)', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_categoria`
--

CREATE TABLE `tbl_categoria` (
  `idcategoria` bigint(20) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `portada` varchar(100) NOT NULL,
  `status` int(20) DEFAULT NULL,
  `CREADO_POR` varchar(45) DEFAULT NULL,
  `FECHA_CREACION` datetime DEFAULT NULL,
  `MODIFICADO_POR` varchar(45) DEFAULT NULL,
  `FECHA_MODIFICACION` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_categoria`
--

INSERT INTO `tbl_categoria` (`idcategoria`, `nombre`, `descripcion`, `portada`, `status`, `CREADO_POR`, `FECHA_CREACION`, `MODIFICADO_POR`, `FECHA_MODIFICACION`) VALUES
(1, 'Elsy Maradiaga', 'hgsadguge', '', 0, NULL, NULL, NULL, NULL),
(2, 'Elsy Yohana', 'elsita', 'img_e6865380a9b6b3e93ef2ef19981e418c.jpg', 0, NULL, NULL, NULL, NULL),
(3, 'pollo chuco', 'pollito rico', 'img_efa9820e7313dd58d589702087279fa9.jpg', 1, NULL, NULL, NULL, NULL),
(11, 'Pruebas', 'Holi', 'img_41bef62292205a0866032e11d06eaedc.jpg', 1, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_compras`
--

CREATE TABLE `tbl_compras` (
  `COD_COMPRA` bigint(20) NOT NULL,
  `COD_PERSONA` bigint(20) NOT NULL,
  `NUMERO_FACTURA` varchar(45) DEFAULT NULL,
  `DESCRIPCION` varchar(255) DEFAULT NULL,
  `ISV` double NOT NULL,
  `TOTAL` double DEFAULT NULL,
  `CAI` varchar(50) NOT NULL,
  `status` int(11) DEFAULT 1,
  `CREADO_POR` varchar(45) DEFAULT NULL,
  `FECHA_CREACION` datetime DEFAULT NULL,
  `MODIFICADO_POR` varchar(45) DEFAULT NULL,
  `FECHA_MODIFICACION` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_compras`
--

INSERT INTO `tbl_compras` (`COD_COMPRA`, `COD_PERSONA`, `NUMERO_FACTURA`, `DESCRIPCION`, `ISV`, `TOTAL`, `CAI`, `status`, `CREADO_POR`, `FECHA_CREACION`, `MODIFICADO_POR`, `FECHA_MODIFICACION`) VALUES
(35, 8, '22', '[{\"COD_PRODUCTO\":16,\"NOMBRE_PRODUCTO\":\"Silla\",\"PRECIO\":200,\"EXISTENCIA\":\"500\"}]', 0, 100000, '', 1, 'Abel', '2023-04-18 00:00:00', NULL, NULL),
(36, 8, '26', '[{\"COD_PRODUCTO\":16,\"NOMBRE_PRODUCTO\":\"Silla\",\"PRECIO\":200,\"EXISTENCIA\":\"3\"}]', 0, 600, '', 1, 'Abel', '2023-04-18 00:00:00', NULL, NULL),
(37, 8, '27', '[{\"COD_PRODUCTO\":16,\"NOMBRE_PRODUCTO\":\"Silla\",\"PRECIO\":200,\"EXISTENCIA\":\"2\"}]', 0, 400, '', 1, 'Abel', '2023-04-18 00:00:00', NULL, NULL),
(38, 8, '22', '[{\"COD_PRODUCTO\":16,\"NOMBRE_PRODUCTO\":\"Silla\",\"PRECIO\":200,\"EXISTENCIA\":\"3\"}]', 0, 600, '', 1, 'Abel', '2023-04-18 00:00:00', NULL, NULL),
(39, 8, '67', '[{\"COD_PRODUCTO\":16,\"NOMBRE_PRODUCTO\":\"Silla\",\"PRECIO\":200,\"EXISTENCIA\":\"5\"}]', 0, 1000, '', 1, 'Abel', '2023-04-18 00:00:00', NULL, NULL),
(40, 8, '12312312321321', '[{\"COD_PRODUCTO\":16,\"NOMBRE_PRODUCTO\":\"Silla\",\"PRECIO\":200,\"EXISTENCIA\":\"2\"}]', 0, 400, '', 1, 'Abel', '2023-04-19 00:00:00', NULL, NULL),
(41, 8, '12312312321321', '[{\"COD_PRODUCTO\":16,\"NOMBRE_PRODUCTO\":\"Silla\",\"PRECIO\":200,\"EXISTENCIA\":\"2\"}]', 0, 400, '', 1, 'Abel', '2023-04-19 00:00:00', NULL, NULL),
(42, 8, '1111', '[{\"COD_PRODUCTO\":16,\"NOMBRE_PRODUCTO\":\"Silla\",\"PRECIO\":200,\"EXISTENCIA\":\"100\"}]', 0, 20000, '', 1, 'Abel', '2023-04-19 00:00:00', NULL, NULL),
(43, 8, '21321321312', '[{\"COD_PRODUCTO\":16,\"NOMBRE_PRODUCTO\":\"Silla\",\"PRECIO\":200,\"EXISTENCIA\":\"112\"}]', 0, 22400, '', 0, 'GERSON', '2023-04-19 00:00:00', NULL, NULL),
(44, 8, '213421323', '[{\"COD_PRODUCTO\":16,\"NOMBRE_PRODUCTO\":\"Silla\",\"PRECIO\":200,\"EXISTENCIA\":\"59\"}]', 0, 11800, '', 0, 'GERSON', '2023-04-19 00:00:00', NULL, NULL),
(45, 8, '321321321321321', '[{\"COD_PRODUCTO\":17,\"NOMBRE_PRODUCTO\":\"Mesa\",\"PRECIO\":200,\"EXISTENCIA\":\"50\"}]', 0, 10000, '', 0, 'GERSON', '2023-04-19 00:00:00', NULL, NULL),
(46, 8, '321321321', '[{\"COD_PRODUCTO\":17,\"NOMBRE_PRODUCTO\":\"Mesa\",\"PRECIO\":0,\"EXISTENCIA\":\"15\"}]', 0, 0, '', 1, 'Gerson', '2023-04-19 00:00:00', NULL, NULL),
(47, 8, '34242', '[{\"COD_PRODUCTO\":18,\"NOMBRE_PRODUCTO\":\"Silla\",\"PRECIO\":50,\"EXISTENCIA\":\"25\"}]', 0, 1250, '', 1, 'Gerson', '2023-04-19 00:00:00', NULL, NULL),
(48, 8, '8789798', '[{\"COD_PRODUCTO\":17,\"NOMBRE_PRODUCTO\":\"Mesa\",\"PRECIO\":15,\"EXISTENCIA\":1}]', 2.25, 17.25, '779798', 1, 'Gerson', '2023-04-25 00:00:00', NULL, NULL),
(49, 8, '777777777777', '[{\"COD_PRODUCTO\":17,\"NOMBRE_PRODUCTO\":\"Mesa\",\"PRECIO\":15,\"EXISTENCIA\":\"15\"}]', 33.75, 258.75, '77777777777777', 1, 'Gerson', '2023-04-25 00:00:00', NULL, NULL),
(50, 8, '4545', '[{\"COD_PRODUCTO\":17,\"NOMBRE_PRODUCTO\":\"Mesa\",\"PRECIO\":15,\"EXISTENCIA\":\"444\"}]', 999, 7659, '878787', 1, 'Gerson', '2023-05-02 00:00:00', NULL, NULL),
(51, 8, '545454545', '[{\"COD_PRODUCTO\":17,\"NOMBRE_PRODUCTO\":\"Mesa\",\"PRECIO\":15,\"EXISTENCIA\":1}]', 2.25, 17.25, '99999', 0, 'Gerson', '2023-05-02 00:00:00', NULL, NULL),
(52, 8, '45454', '[{\"COD_PRODUCTO\":17,\"NOMBRE_PRODUCTO\":\"Mesa\",\"PRECIO\":15,\"EXISTENCIA\":1}]', 2.25, 17.25, '1111111', 0, 'Gerson', '2023-05-02 00:00:00', NULL, NULL),
(53, 8, '56454546', '[{\"COD_PRODUCTO\":27,\"NOMBRE_PRODUCTO\":\"pollo\",\"PRECIO\":25,\"EXISTENCIA\":\"5\"}]', 18.75, 143.75, '8798797', 0, 'Gerson', '2023-05-03 00:00:00', NULL, NULL),
(54, 8, '654654', '[{\"COD_PRODUCTO\":27,\"NOMBRE_PRODUCTO\":\"pollo\",\"PRECIO\":25,\"EXISTENCIA\":\"5\"}]', 18.75, 143.75, '654654', 0, 'Gerson', '2023-05-03 00:00:00', NULL, NULL),
(55, 8, '5454', '[{\"COD_PRODUCTO\":27,\"NOMBRE_PRODUCTO\":\"pollo\",\"PRECIO\":25,\"EXISTENCIA\":\"5\"}]', 18.75, 143.75, '4545', 0, 'Gerson', '2023-05-03 00:00:00', NULL, NULL),
(56, 8, '4515356', '[{\"COD_PRODUCTO\":27,\"NOMBRE_PRODUCTO\":\"pollo\",\"PRECIO\":25,\"EXISTENCIA\":\"2\"},{\"COD_PRODUCTO\":30,\"NOMBRE_PRODUCTO\":\"producto prueba\",\"PRECIO\":99,\"EXISTENCIA\":\"4\"}]', 66.9, 520.4, '48787984465465', 1, 'Gerson', '2023-05-04 00:00:00', NULL, NULL);

--
-- Disparadores `tbl_compras`
--
DELIMITER $$
CREATE TRIGGER `trigger_inv_devo_compra` BEFORE UPDATE ON `tbl_compras` FOR EACH ROW BEGIN
INSERT INTO tbl_inventario(accion,Nom_factura,TOTAL,ISV,CREADO_POR,FECHA_CREACION) VALUES('Se genero un reembolso de productos',new.NUMERO_FACTURA,new.TOTAL,new.ISV,new.CREADO_POR,new.FECHA_CREACION);

END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `triggers_inventario_compra` AFTER INSERT ON `tbl_compras` FOR EACH ROW BEGIN
INSERT INTO tbl_inventario(accion,Nom_factura,TOTAL,ISV,CREADO_POR,FECHA_CREACION) VALUES('Se genero una entrada de productos',new.NUMERO_FACTURA,new.TOTAL,new.ISV,new.CREADO_POR,new.FECHA_CREACION);

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_compra_detalle`
--

CREATE TABLE `tbl_compra_detalle` (
  `COD_COMPRA_DETALLE` bigint(20) NOT NULL,
  `COD_COMPRA` bigint(20) DEFAULT NULL,
  `COD_PRODUCTO` bigint(20) DEFAULT NULL,
  `FECHA` date DEFAULT NULL,
  `CANTIDAD` double DEFAULT NULL,
  `SUBTOTAL` double DEFAULT NULL,
  `IMPUESTO` double DEFAULT NULL,
  `DESCUENTO` double DEFAULT NULL,
  `TOTAL` double DEFAULT NULL,
  `CREADO_POR` varchar(45) DEFAULT NULL,
  `FECHA_CREACION` datetime DEFAULT NULL,
  `MODIFICADO_POR` varchar(45) DEFAULT NULL,
  `FECHA_MODIFICACION` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_cotizaciones`
--

CREATE TABLE `tbl_cotizaciones` (
  `COD_COTIZACION` bigint(20) NOT NULL,
  `COD_PERSONA` bigint(20) NOT NULL,
  `NUMERO_COTIZACION` varchar(45) DEFAULT NULL,
  `DESCRIPCION` varchar(45) DEFAULT NULL,
  `TOTAL` double DEFAULT NULL,
  `status` int(11) DEFAULT 1,
  `CREADO_POR` varchar(45) DEFAULT NULL,
  `FECHA_CREACION` datetime DEFAULT NULL,
  `MODIFICADO_POR` varchar(45) DEFAULT NULL,
  `FECHA_MODIFICACION` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_cotizaciones`
--

INSERT INTO `tbl_cotizaciones` (`COD_COTIZACION`, `COD_PERSONA`, `NUMERO_COTIZACION`, `DESCRIPCION`, `TOTAL`, `status`, `CREADO_POR`, `FECHA_CREACION`, `MODIFICADO_POR`, `FECHA_MODIFICACION`) VALUES
(1, 12, '1', '[{\"COD_PRODUCTO\":18,\"NOMBRE_PRODUCTO\":\"Silla\"', 50, 1, 'Gerson', '2023-04-29 00:00:00', NULL, NULL),
(2, 1, '2', '[{\"COD_PRODUCTO\":18,\"NOMBRE_PRODUCTO\":\"Silla\"', 2750, 0, 'Gerson', '2023-04-29 00:00:00', NULL, NULL),
(3, 12, '121212', '[{\"COD_PRODUCTO\":17,\"NOMBRE_PRODUCTO\":\"Mesa\",', 180, 1, 'Gerson', '2023-05-01 00:00:00', NULL, NULL),
(4, 12, '121212', '[{\"COD_PRODUCTO\":17,\"NOMBRE_PRODUCTO\":\"Mesa\",', 225, 1, 'Gerson', '2023-05-01 00:00:00', NULL, NULL),
(5, 12, '777', '[{\"COD_PRODUCTO\":27,\"NOMBRE_PRODUCTO\":\"pollo\"', 1125, 1, 'Gerson', '2023-05-03 00:00:00', NULL, NULL),
(6, 12, '32132132131', '[{\"COD_PRODUCTO\":27,\"NOMBRE_PRODUCTO\":\"pollo\"', 25, 1, 'Gerson', '2023-05-03 00:00:00', NULL, NULL),
(7, 12, '4545', '[{\"COD_PRODUCTO\":27,\"NOMBRE_PRODUCTO\":\"pollo\"', 50, 1, 'Gerson', '2023-05-04 00:00:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_direccion`
--

CREATE TABLE `tbl_direccion` (
  `COD_DIRECCION` bigint(20) NOT NULL,
  `COD_PERSONA` bigint(20) DEFAULT NULL,
  `COD_TIPO_DIRECCION` bigint(20) DEFAULT NULL,
  `CIUDAD` varchar(45) DEFAULT NULL,
  `CALLE` varchar(45) DEFAULT NULL,
  `CASA` varchar(45) DEFAULT NULL,
  `COLONIA` varchar(45) DEFAULT NULL,
  `AVENIDA` varchar(45) DEFAULT NULL,
  `DIRECCION1` varchar(45) DEFAULT NULL,
  `DIRECCION2` varchar(45) DEFAULT NULL,
  `status` int(45) DEFAULT NULL,
  `CREADO_POR` varchar(45) DEFAULT NULL,
  `FECHA_CREACION` datetime DEFAULT NULL,
  `MODIFICADO_POR` varchar(45) DEFAULT NULL,
  `FECHA_MODIFICACION` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_direccion`
--

INSERT INTO `tbl_direccion` (`COD_DIRECCION`, `COD_PERSONA`, `COD_TIPO_DIRECCION`, `CIUDAD`, `CALLE`, `CASA`, `COLONIA`, `AVENIDA`, `DIRECCION1`, `DIRECCION2`, `status`, `CREADO_POR`, `FECHA_CREACION`, `MODIFICADO_POR`, `FECHA_MODIFICACION`) VALUES
(2, 22, 1, 'safas', 'asfa', 'fafsasfas', 'fsa', 'fasfaf', 'asfasd', 'afsfas', 1, NULL, NULL, NULL, NULL),
(3, 22, 1, 'Tegucigalpa', 'df', '4ewt', 'ger', 'ege', 'erge', 'erger', 1, NULL, NULL, NULL, NULL),
(4, 12, 1, 'TEGUCIGALPA', 'SOLA', 'ROSADA', 'col.Altos', 'SAN', 'casa al lado', 'CASA AL OTRO', 1, NULL, NULL, NULL, NULL),
(5, 23, 1, 'gracias lempira', 'Calle 8', 'casa numero 11', 'col.Altos', 'avenida 5', '.', '.', 1, NULL, NULL, NULL, NULL),
(6, 24, 1, 'gracias lempira', 'Calle 8', 'casa numero 11', 'Bella oriente', 'avenida 5', 's', 's', 1, NULL, NULL, NULL, NULL),
(10, 28, 1, 'Tegucigalpa', 'calle 8', 'numero 11', 'hato', '5', 'casa rosada', 'casa roja', 1, NULL, NULL, NULL, NULL),
(11, 28, 1, 'Tegucigalpa', 'calle 8', 'numero 12', 'kennedy', '5', 'casa verde', 'casa azul', 1, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_empresa`
--

CREATE TABLE `tbl_empresa` (
  `id` bigint(20) NOT NULL,
  `RTN` varchar(45) NOT NULL,
  `NOMBRE_EMPRESA` varchar(45) NOT NULL,
  `DESCRIPCION` varchar(191) NOT NULL,
  `telefono` varchar(12) NOT NULL,
  `CORREO` varchar(45) NOT NULL,
  `DIRECCION` varchar(45) NOT NULL,
  `mensaje` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `FECHA_CREACION` datetime NOT NULL,
  `FECHA_MODIFICACION` datetime NOT NULL,
  `status` int(45) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_empresa`
--

INSERT INTO `tbl_empresa` (`id`, `RTN`, `NOMBRE_EMPRESA`, `DESCRIPCION`, `telefono`, `CORREO`, `DIRECCION`, `mensaje`, `FECHA_CREACION`, `FECHA_MODIFICACION`, `status`) VALUES
(1, '9999999999999', 'Empresa Generica', 'Distribuidora de Materiales', '26569999', 'generica@unah.com', 'Col. Las lomas', 'Hazlo de la mejor manera', '2023-04-16 11:07:48', '2023-04-16 11:07:48', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_historial_contrasena`
--

CREATE TABLE `tbl_historial_contrasena` (
  `id` bigint(20) NOT NULL,
  `accion` varchar(45) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `CONTRASENA` varchar(45) NOT NULL,
  `CREADO_POR` varchar(45) DEFAULT NULL,
  `FECHA_CREACION` datetime DEFAULT NULL,
  `MODIFICADO_POR` varchar(45) DEFAULT NULL,
  `FECHA_MODIFICACION` varchar(45) NOT NULL,
  `status` int(45) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_historial_contrasena`
--

INSERT INTO `tbl_historial_contrasena` (`id`, `accion`, `username`, `CONTRASENA`, `CREADO_POR`, `FECHA_CREACION`, `MODIFICADO_POR`, `FECHA_MODIFICACION`, `status`) VALUES
(5, 'Se cambio la contraseña', 'Safdas', 'dc4d1eb9c07c71a50e226172e54cb5043f6f9505f116c', 'Gerson', '2023-04-25 20:48:41', 'Gerson', '28-04-2023 (05:13:15)', 1),
(6, 'Se cambio la contraseña', 'Safdas', '34216e2e02a87f770f4a23de074fb37da49c580d62fd6', 'Gerson', '2023-04-25 20:48:41', 'Gerson', '28-04-2023 (05:15:19)', 1),
(9, 'Se cambio la contraseña', 'Safdas', 'fc723c8005eec0d3e0fc320a516d2d1259b4e1c3a0a25', 'Gerson', '2023-04-25 20:48:41', 'Gerson', '28-04-2023 (05:27:31)', 1),
(10, 'Se cambio la contraseña', 'Pruebaoficial', 'f43aa55d1b3949b48c019fb2211885d9e50989c66083c', 'David', '2023-04-24 14:20:31', 'Gerson', '28-04-2023 (07:01:49)', 1),
(12, 'Se cambio la contraseña', 'Asdadas', 'b8a6a7141fa88c1600ca205eab5aa135dc42a3bdd7b5a', 'David', '2023-04-27 23:03:31', 'Registro', '28-04-2023 (07:04:18)', 1),
(13, 'Se cambio la contraseña', 'Asdadas', 'c775e7b757ede630cd0aa1113bd102661ab38829ca52a', 'David', '2023-04-27 23:03:31', 'Registro', '28-04-2023 (07:08:09)', 1),
(14, 'Se cambio la contraseña', 'Asdadas', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff', 'David', '2023-04-27 23:03:31', 'Registro', '28-04-2023 (07:08:53)', 1),
(15, 'Se cambio la contraseña', 'Lol', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff', 'David', '2023-04-27 23:03:31', 'Registro', '28-04-2023 (07:10:32)', 1),
(16, 'Se cambio la contraseña', 'Lalala', '6bfd90868f281d3d1f1f8ed92c41790f09f780b453115', 'David', '2023-04-27 23:03:31', 'Registro', '28-04-2023 (07:11:53)', 1),
(17, 'Se cambio la contraseña', 'Safdas', 'e85298bd98678da63d025ebae363bd2d533a16b8bad02', 'Gerson', '2023-04-25 20:48:41', 'Gerson', '28-04-2023 (05:27:31)', 1),
(18, 'Se cambio la contraseña', 'Safdas', 'e85298bd98678da63d025ebae363bd2d533a16b8bad02', 'Gerson', '2023-04-25 20:48:41', 'Gerson', '28-04-2023 (05:27:31)', 1),
(19, 'Se cambio la contraseña', 'Dswfsdfsf', '6fc0b7b169e1787848ea270d4b25eaeceefe364c002fa', 'David', '2023-04-27 23:03:31', 'Registro', '28-04-2023 (07:11:53)', 1),
(20, 'Se cambio la contraseña', 'Pruebaoficial', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff', 'David', '2023-04-24 14:20:31', 'Gerson', '28-04-2023 (07:01:49)', 1),
(21, 'Se cambio la contraseña', 'Pruebalocal', '15e2b0d3c33891ebb0f1ef609ec419420c20e320ce94c', 'Gerson', '2023-05-01 19:23:38', 'Gerson', '02-05-2023 (03:25:51)', 1),
(22, 'Se cambio la contraseña', 'Sss', '8690d872257b2699a6d9a66a7201b384b800d9e125c6d', 'Gerson', '2023-05-01 19:26:22', 'Gerson', '02-05-2023 (03:26:34)', 1),
(23, 'Se cambio la contraseña', 'Pruebaoficial', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff', 'David', '2023-04-24 14:20:31', 'Gerson', '28-04-2023 (07:01:49)', 1),
(24, 'Se cambio la contraseña', 'Pruebaoficial', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff', 'David', '2023-04-24 14:20:31', 'Gerson', '28-04-2023 (07:01:49)', 1),
(25, 'Se cambio la contraseña', 'Pruebaoficial', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff', 'David', '2023-04-24 14:20:31', 'Gerson', '28-04-2023 (07:01:49)', 1),
(26, 'Se cambio la contraseña', 'Pruebaoficial', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff', 'David', '2023-04-24 14:20:31', 'Gerson', '28-04-2023 (07:01:49)', 1),
(27, 'Se cambio la contraseña', 'Pruebaoficial', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff', 'David', '2023-04-24 14:20:31', 'Gerson', '28-04-2023 (07:01:49)', 1),
(28, 'Se cambio la contraseña', 'Ddd', '8690d872257b2699a6d9a66a7201b384b800d9e125c6d', 'Gerson', '2023-05-01 19:26:22', 'Gerson', '02-05-2023 (03:26:34)', 1),
(29, 'Se cambio la contraseña', 'Dswfsdfsf', '6fc0b7b169e1787848ea270d4b25eaeceefe364c002fa', 'David', '2023-04-27 23:03:31', 'Registro', '28-04-2023 (07:11:53)', 1),
(30, 'Se cambio la contraseña', 'Safdas', 'e85298bd98678da63d025ebae363bd2d533a16b8bad02', 'Gerson', '2023-04-25 20:48:41', 'Gerson', '28-04-2023 (05:27:31)', 1),
(31, 'Se cambio la contraseña', 'Pruebaoficial', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff', 'David', '2023-04-24 14:20:31', 'Gerson', '04-05-2023 (00:35:11)', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_imagen`
--

CREATE TABLE `tbl_imagen` (
  `id` bigint(20) NOT NULL,
  `productoid` bigint(20) NOT NULL,
  `img` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_ingreso`
--

CREATE TABLE `tbl_ingreso` (
  `COD_INGRESO` bigint(20) NOT NULL,
  `COD_PRODUCTO` bigint(20) DEFAULT NULL,
  `CANTIDAD` double DEFAULT NULL,
  `DETALLE` double DEFAULT NULL,
  `DONANTE` varchar(45) DEFAULT NULL,
  `FECHA_DONANTE` date DEFAULT NULL,
  `CREADO_POR` varchar(45) DEFAULT NULL,
  `FECHA_CREACION` datetime DEFAULT NULL,
  `MODIFICADO_POR` varchar(45) DEFAULT NULL,
  `FECHA_MODIFICACION` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_inventario`
--

CREATE TABLE `tbl_inventario` (
  `COD_INVENTARIO` bigint(20) NOT NULL,
  `Accion` varchar(250) NOT NULL,
  `Nom_factura` varchar(100) NOT NULL,
  `TOTAL` bigint(100) NOT NULL,
  `ISV` double NOT NULL,
  `CREADO_POR` varchar(45) NOT NULL,
  `FECHA_CREACION` datetime NOT NULL,
  `MODIFICADO_POR` varchar(45) NOT NULL,
  `FECHA_MODIFICACION` varchar(454) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_inventario`
--

INSERT INTO `tbl_inventario` (`COD_INVENTARIO`, `Accion`, `Nom_factura`, `TOTAL`, `ISV`, `CREADO_POR`, `FECHA_CREACION`, `MODIFICADO_POR`, `FECHA_MODIFICACION`, `status`) VALUES
(10, 'Se genero una salida de productos', '22222', 115, 15, 'Gerson', '2023-05-03 00:00:00', '', '', 1),
(11, 'Se genero una entrada de productos', '5454', 144, 18.75, 'Gerson', '2023-05-03 00:00:00', '', '', 1),
(12, 'Se genero un reembolso de productos', '5454', 144, 18.75, 'Gerson', '2023-05-03 00:00:00', '', '', 1),
(13, 'Se genero una devolucion de productos', '22222', 115, 15, 'Gerson', '2023-05-03 00:00:00', '', '', 1),
(14, 'Se genero una salida de productos', '4515356', 143, 14.85, 'Gerson', '2023-05-04 00:00:00', '', '', 1),
(15, 'Se genero una entrada de productos', '4515356', 520, 66.9, 'Gerson', '2023-05-04 00:00:00', '', '', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_ms_modulo`
--

CREATE TABLE `tbl_ms_modulo` (
  `idmodulo` bigint(20) NOT NULL,
  `titulo` varchar(50) NOT NULL,
  `descripcion` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Volcado de datos para la tabla `tbl_ms_modulo`
--

INSERT INTO `tbl_ms_modulo` (`idmodulo`, `titulo`, `descripcion`, `status`) VALUES
(1, 'Dashboard', 'Dashboard', 1),
(2, 'Usuarios', 'Usuarios del sistema', 1),
(3, 'Personas', 'Módulo de Personas', 1),
(4, 'Tienda', 'Inventario disponible de la empresa', 1),
(5, 'Compras', 'Compras ingresadas', 1),
(6, 'Ventas', 'Ventas realizadas', 1),
(11, 'Categoria', 'Modulo para el permisos de categoria ', 1),
(13, 'Roles', 'Modulo de roles', 1),
(14, 'Bitacora', 'Modulo Bitacoras', 1),
(15, 'Datos de Acceso', 'Asiganar permisos a Datos de accesos', 1),
(16, 'Preguntas de Seguridad', 'Permisos para Preguntas de Seguridad', 1),
(17, 'Historial de Contraseñas', 'Permisos para Historial de Contraseñas', 1),
(18, 'Caja', 'Asignar Permisos a Caja', 1),
(19, 'Arqueo Caja', 'Permisos para arqueo caja', 1),
(20, 'Configuracion', 'Permisos para Configuración ', 1),
(21, 'Cotizaciones', 'Asignar Permisos a Cotizaciones', 1),
(22, 'Inventarios', 'Asiganar Permisos a Inventarios ', 1),
(23, 'Empresa', 'Permisos para datos de empresa ', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_ms_permisos`
--

CREATE TABLE `tbl_ms_permisos` (
  `idpermiso` bigint(20) NOT NULL,
  `rolid` bigint(20) NOT NULL,
  `moduloid` bigint(20) NOT NULL,
  `r` int(11) NOT NULL DEFAULT 0,
  `w` int(11) NOT NULL DEFAULT 0,
  `u` int(11) NOT NULL DEFAULT 0,
  `d` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Volcado de datos para la tabla `tbl_ms_permisos`
--

INSERT INTO `tbl_ms_permisos` (`idpermiso`, `rolid`, `moduloid`, `r`, `w`, `u`, `d`) VALUES
(365, 9, 1, 1, 1, 1, 1),
(366, 9, 2, 1, 1, 0, 1),
(367, 9, 3, 1, 1, 0, 1),
(368, 9, 4, 0, 0, 0, 0),
(369, 9, 5, 1, 1, 1, 1),
(370, 9, 6, 1, 1, 1, 1),
(371, 9, 11, 0, 0, 0, 0),
(372, 9, 13, 0, 0, 0, 0),
(535, 1, 1, 1, 1, 1, 1),
(536, 1, 2, 1, 1, 1, 1),
(537, 1, 3, 1, 1, 1, 1),
(538, 1, 4, 1, 1, 1, 1),
(539, 1, 5, 1, 1, 1, 1),
(540, 1, 6, 1, 1, 1, 1),
(541, 1, 11, 1, 1, 1, 1),
(542, 1, 13, 1, 1, 1, 1),
(543, 1, 14, 1, 1, 1, 1),
(544, 1, 15, 1, 1, 1, 1),
(545, 1, 16, 1, 1, 1, 1),
(546, 1, 17, 1, 1, 1, 1),
(547, 1, 18, 1, 1, 1, 1),
(548, 1, 19, 1, 1, 1, 1),
(549, 1, 20, 1, 1, 1, 1),
(550, 1, 21, 1, 1, 1, 1),
(551, 1, 22, 1, 1, 1, 1),
(552, 1, 23, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_ms_preguntas_por_usuario`
--

CREATE TABLE `tbl_ms_preguntas_por_usuario` (
  `COD_PRREGUNTA` bigint(20) NOT NULL,
  `COD_USUARIO` bigint(20) DEFAULT NULL,
  `PREGUNTA` varchar(45) DEFAULT NULL,
  `RESPUESTA` varchar(45) DEFAULT NULL,
  `CREADO_POR` varchar(45) DEFAULT NULL,
  `FECHA_CREACION` datetime DEFAULT NULL,
  `MODIFICADO_POR` varchar(45) DEFAULT NULL,
  `FECHA_MODIFICACION` datetime DEFAULT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_ms_preguntas_por_usuario`
--

INSERT INTO `tbl_ms_preguntas_por_usuario` (`COD_PRREGUNTA`, `COD_USUARIO`, `PREGUNTA`, `RESPUESTA`, `CREADO_POR`, `FECHA_CREACION`, `MODIFICADO_POR`, `FECHA_MODIFICACION`, `status`) VALUES
(1, 1, 'Color favorito', '545', NULL, NULL, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_ms_rol`
--

CREATE TABLE `tbl_ms_rol` (
  `idrol` bigint(20) NOT NULL,
  `nombrerol` varchar(50) NOT NULL,
  `descripcion` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Volcado de datos para la tabla `tbl_ms_rol`
--

INSERT INTO `tbl_ms_rol` (`idrol`, `nombrerol`, `descripcion`, `status`) VALUES
(1, 'Administrador', 'Acceso a todo el sistema 	', 1),
(9, 'EDITOR', 'EDITOR DE TEXTO', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_ms_usuarios`
--

CREATE TABLE `tbl_ms_usuarios` (
  `idpersona` bigint(20) NOT NULL,
  `identificacion` varchar(30) NOT NULL,
  `nombres` varchar(80) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `telefono` bigint(20) NOT NULL,
  `email_user` varchar(100) NOT NULL,
  `username` varchar(45) DEFAULT NULL,
  `password` varchar(75) NOT NULL,
  `nit` varchar(20) NOT NULL,
  `nombrefiscal` varchar(80) NOT NULL,
  `direccionfiscal` varchar(100) NOT NULL,
  `token` varchar(100) NOT NULL,
  `rolid` bigint(20) NOT NULL,
  `FECHA_CREACION` datetime NOT NULL DEFAULT current_timestamp(),
  `CREADO_POR` varchar(45) NOT NULL,
  `MODIFICADO_POR` varchar(45) NOT NULL,
  `FECHA_MODIFICADO` varchar(100) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Volcado de datos para la tabla `tbl_ms_usuarios`
--

INSERT INTO `tbl_ms_usuarios` (`idpersona`, `identificacion`, `nombres`, `apellidos`, `telefono`, `email_user`, `username`, `password`, `nit`, `nombrefiscal`, `direccionfiscal`, `token`, `rolid`, `FECHA_CREACION`, `CREADO_POR`, `MODIFICADO_POR`, `FECHA_MODIFICADO`, `status`) VALUES
(1, '24091989', 'Gerson', 'garcia', 24091989, 'admin@gmail.com', 'thegers', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'CF', 'gers', 'Gracias Lempira', '383f5ab203e1901aac4f-e406fd6d0d215b993d2f-b216911bec479c375600-cbb2d0aed0f10f725e6e', 1, '2020-10-03 02:28:53', '', '', '0000-00-00 00:00:00', 1),
(14, '4465465465', 'David', 'Garcia', 23423423, 'davidgarcia23@gmail.com', 'Davidsito', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '2312321', 'David', 'barrio san cristobal', 'aab8d35f0cdc7211f3a4-95bef1eb61bd447c3a54-8ff5718706f2c0e86739-e81e7389b39dc4a219c3', 1, '2023-04-19 00:24:30', '', 'Gerson', '28-04-2023 (07:03:02)', 1),
(35, '987987987', 'Registro', 'Prueba', 98746464, 'gerdavidgarcia@gmail.com', 'Pruebaoficial', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '', '', '', '21a6314ddc44adbaf6ba-5efad0d567e2c21d8b15-79ea1d32427ff8e5da3a-6e7982be8842d4b07947', 1, '2023-04-24 14:20:31', 'David', 'Gerson', '04-05-2023 (00:35:11)', 1),
(38, '7878787', 'Pruebas', 'Locales', 9497494, 'prueba@gmail.es', 'Pruebalocalxd', '15e2b0d3c33891ebb0f1ef609ec419420c20e320ce94c65fbc8c3312448eb225', '', '', '', '', 1, '2023-05-01 19:23:38', 'Gerson', 'Gerson', '02-05-2023 (03:25:51)', 1);

--
-- Disparadores `tbl_ms_usuarios`
--
DELIMITER $$
CREATE TRIGGER `insert_usuario_bitacora3` AFTER INSERT ON `tbl_ms_usuarios` FOR EACH ROW BEGIN
INSERT INTO tbl_bitacora(accion,FECHA_CREACION,CREADO_POR) VALUES('Se inserto un nuevo usuario',new.FECHA_CREACION,new.CREADO_POR);

END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `trigger_historial_contra` BEFORE UPDATE ON `tbl_ms_usuarios` FOR EACH ROW BEGIN
INSERT INTO tbl_historial_contrasena(accion,username,CONTRASENA,CREADO_POR,FECHA_CREACION, MODIFICADO_POR,FECHA_MODIFICACION) VALUES('Se cambio la contraseña',	old.username,old.password,old.CREADO_POR,old.FECHA_CREACION,new.MODIFICADO_POR,new.FECHA_MODIFICADO);

END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `uptade_user_bitacora` AFTER UPDATE ON `tbl_ms_usuarios` FOR EACH ROW BEGIN
INSERT INTO tbl_bitacora(accion,FECHA_CREACION,CREADO_POR,MODIFICADO_POR,	FECHA_MODIFICADO) VALUES('Se actualizo un nuevo usuario ',new.FECHA_CREACION,new.CREADO_POR,new.MODIFICADO_POR,new.FECHA_MODIFICADO);

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_personas`
--

CREATE TABLE `tbl_personas` (
  `COD_PERSONA` bigint(20) NOT NULL,
  `NOMBRE` varchar(45) DEFAULT NULL,
  `GENERO` int(45) DEFAULT NULL,
  `FECHA_NACIMIENTO` varchar(150) DEFAULT NULL,
  `COD_TIPO_IDENTIFICACION` bigint(20) DEFAULT NULL,
  `IDENTIFICACION` int(13) DEFAULT NULL,
  `COD_TIPO_PERSONA` bigint(20) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `CREADO_POR` varchar(45) DEFAULT NULL,
  `FECHA_CREACION` datetime DEFAULT NULL,
  `MODIFICADO_POR` varchar(45) DEFAULT NULL,
  `FECHA_MODIFICACION` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_personas`
--

INSERT INTO `tbl_personas` (`COD_PERSONA`, `NOMBRE`, `GENERO`, `FECHA_NACIMIENTO`, `COD_TIPO_IDENTIFICACION`, `IDENTIFICACION`, `COD_TIPO_PERSONA`, `status`, `CREADO_POR`, `FECHA_CREACION`, `MODIFICADO_POR`, `FECHA_MODIFICACION`) VALUES
(1, 'ELSY', 1, '2023-03-15', 1, 12135456, 1, 1, NULL, NULL, NULL, NULL),
(8, 'Miguelito', 2, '2023-03-29', 2, 123456, 2, 0, NULL, NULL, NULL, NULL),
(12, 'Miguel Cardenas', 2, '2013-04-17', 1, 123456789, 1, 1, NULL, NULL, NULL, NULL),
(22, 'Yohana Maradiaga', 1, '0000-00-00', 1, 2147483647, 1, 1, NULL, NULL, NULL, NULL),
(23, 'yohanaaaa', 1, '0000-00-00', 1, 5454, 1, 1, NULL, NULL, NULL, NULL),
(24, 'Yohana', 1, '0000-00-00', 1, 2147483647, 1, 1, NULL, NULL, NULL, NULL),
(25, 'Pruebas', 2, '2023-05-01', 1, 2147483647, 1, 1, NULL, NULL, NULL, NULL),
(27, 'Miguelito', 2, '2023-03-29', 2, 123456, 2, 1, NULL, NULL, NULL, NULL),
(28, 'Gerson Prueba', 2, '2023-05-14', 1, 2147483647, 1, 1, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_producto`
--

CREATE TABLE `tbl_producto` (
  `COD_PRODUCTO` bigint(20) NOT NULL,
  `BARCODIGO` bigint(20) NOT NULL,
  `NOMBRE_PRODUCTO` varchar(45) NOT NULL,
  `COD_CATEGORIA` bigint(20) NOT NULL,
  `DESCRIPCION` varchar(200) NOT NULL,
  `PRECIO` int(11) NOT NULL,
  `PrecioVenta` int(45) NOT NULL,
  `EXISTENCIA` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `CREADO_POR` varchar(45) NOT NULL,
  `FECHA_CREACION` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `MODIFICADO_POR` varchar(45) NOT NULL,
  `FECHA_MODIFICACION` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_producto`
--

INSERT INTO `tbl_producto` (`COD_PRODUCTO`, `BARCODIGO`, `NOMBRE_PRODUCTO`, `COD_CATEGORIA`, `DESCRIPCION`, `PRECIO`, `PrecioVenta`, `EXISTENCIA`, `status`, `CREADO_POR`, `FECHA_CREACION`, `MODIFICADO_POR`, `FECHA_MODIFICACION`) VALUES
(27, 12345, 'pollo', 3, '<p>pollp</p>', 25, 32, -56, 1, '', '2023-05-04 01:03:23', '', ''),
(29, 5454, 'arroz con pollo', 3, '<p>sdsd</p>', 44, 55, 10, 1, 'Gerson', '2023-05-03 07:39:51', '', ''),
(30, 99999999, 'producto prueba', 11, '<p>prueba 2</p>', 99, 100, 48, 1, 'Gerson', '2023-05-04 01:03:23', 'Gerson', '03-05-2023 (23:37:44)'),
(31, 54545, 'Prueba', 3, '<p>prueba</p>', 99, 999, 99, 1, 'Gerson', '2023-05-04 00:53:40', 'Gerson', '04-05-2023 (02:53:40)');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_regimen_facturacion`
--

CREATE TABLE `tbl_regimen_facturacion` (
  `COD_REGIMEN` bigint(20) NOT NULL,
  `COD_VENTA` bigint(20) DEFAULT NULL,
  `FECHA_INICIO` date DEFAULT NULL,
  `FECHA_LIMITE` date DEFAULT NULL,
  `RANGO_DESDE` varchar(45) DEFAULT NULL,
  `RANGO_HASTA` varchar(45) DEFAULT NULL,
  `CAI` varchar(120) DEFAULT NULL,
  `status` int(10) DEFAULT 1,
  `FECHA_FACTURA` date DEFAULT NULL,
  `FACTURA_REGIMEN` varchar(120) DEFAULT NULL,
  `FECHA_ANULACION` date DEFAULT NULL,
  `CREADO_POR` varchar(45) DEFAULT NULL,
  `FECHA_CREACION` datetime DEFAULT NULL,
  `MODIFICADO_POR` varchar(45) DEFAULT NULL,
  `FECHA_MODIFICACION` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_regimen_facturacion`
--

INSERT INTO `tbl_regimen_facturacion` (`COD_REGIMEN`, `COD_VENTA`, `FECHA_INICIO`, `FECHA_LIMITE`, `RANGO_DESDE`, `RANGO_HASTA`, `CAI`, `status`, `FECHA_FACTURA`, `FACTURA_REGIMEN`, `FECHA_ANULACION`, `CREADO_POR`, `FECHA_CREACION`, `MODIFICADO_POR`, `FECHA_MODIFICACION`) VALUES
(1, NULL, '0000-00-00', '0000-00-00', '45454554', '564654', 'uiygjgjg', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, NULL, '0000-00-00', '0000-00-00', '4224724', '23434', '4534553453', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, NULL, '0000-00-00', '0000-00-00', '4224724', '23434', '45345534', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_salida`
--

CREATE TABLE `tbl_salida` (
  `COD_SALIDA` bigint(20) NOT NULL,
  `COD_PRODUCTO` bigint(20) DEFAULT NULL,
  `CANTIDAD` double DEFAULT NULL,
  `PRECIO` double DEFAULT NULL,
  `DETALLE` varchar(255) DEFAULT NULL,
  `ORGANIZACION` varchar(50) DEFAULT NULL,
  `FECHA_SALIDA` date DEFAULT NULL,
  `CREADO_POR` varchar(45) DEFAULT NULL,
  `FECHA_CREACION` datetime DEFAULT NULL,
  `MODIFICADO_POR` varchar(45) DEFAULT NULL,
  `FECHA_MODIFICACION` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_telefono`
--

CREATE TABLE `tbl_telefono` (
  `COD_TELEFONO` bigint(20) NOT NULL,
  `COD_PERSONA` bigint(20) DEFAULT NULL,
  `COD_TIPO_TELEFONO` bigint(20) DEFAULT NULL,
  `TELEFONO` int(11) DEFAULT NULL,
  `EXTENSION` varchar(45) DEFAULT NULL,
  `CODIGO_AREA` int(11) DEFAULT NULL,
  `status` int(45) NOT NULL,
  `CREADO_POR` varchar(45) DEFAULT NULL,
  `FECHA_CREACION` datetime DEFAULT NULL,
  `MODIFICADOR_POR` varchar(45) DEFAULT NULL,
  `FECHA_MODIFICACION` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_telefono`
--

INSERT INTO `tbl_telefono` (`COD_TELEFONO`, `COD_PERSONA`, `COD_TIPO_TELEFONO`, `TELEFONO`, `EXTENSION`, `CODIGO_AREA`, `status`, `CREADO_POR`, `FECHA_CREACION`, `MODIFICADOR_POR`, `FECHA_MODIFICACION`) VALUES
(2, 22, 1, 4564, NULL, 4654, 1, NULL, NULL, NULL, NULL),
(3, 8, 1, 9879, NULL, 4984, 1, NULL, NULL, NULL, NULL),
(4, 23, 1, 65, NULL, 454, 1, NULL, NULL, NULL, NULL),
(5, 23, 1, 9587987, NULL, 11010, 1, NULL, NULL, NULL, NULL),
(6, 23, 1, 98925103, NULL, 11101, 1, NULL, NULL, NULL, NULL),
(7, 25, 2, 454, NULL, 654, 1, NULL, NULL, NULL, NULL),
(8, 25, 2, 455, NULL, 654, 1, NULL, NULL, NULL, NULL),
(9, 28, 2, 98925104, NULL, 503, 1, NULL, NULL, NULL, NULL),
(10, 28, 1, 98925178, NULL, 503, 1, NULL, NULL, NULL, NULL),
(11, 28, 3, 98925445, NULL, 503, 1, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_tipo_direccion`
--

CREATE TABLE `tbl_tipo_direccion` (
  `id` bigint(20) NOT NULL,
  `TIPO_DIRECCION` varchar(45) DEFAULT NULL,
  `ESTADO` enum('ACTIVO','INACTIVO') DEFAULT NULL,
  `CREADO_POR` varchar(45) DEFAULT NULL,
  `FECHA_CREACION` datetime DEFAULT NULL,
  `MODIFICADO_POR` varchar(45) DEFAULT NULL,
  `FECHA_MODIFICACION` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_tipo_direccion`
--

INSERT INTO `tbl_tipo_direccion` (`id`, `TIPO_DIRECCION`, `ESTADO`, `CREADO_POR`, `FECHA_CREACION`, `MODIFICADO_POR`, `FECHA_MODIFICACION`) VALUES
(1, 'CASA', NULL, NULL, NULL, NULL, NULL),
(2, 'TRABAJO', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_tipo_identificacion`
--

CREATE TABLE `tbl_tipo_identificacion` (
  `id` bigint(20) NOT NULL,
  `TIPO_IDENTIFICACION` varchar(45) DEFAULT NULL,
  `ESTADO` varchar(45) DEFAULT NULL,
  `CREADO_POR` varchar(45) DEFAULT NULL,
  `FECHA_CREACION` datetime DEFAULT NULL,
  `MODIFICADO_POR` varchar(45) DEFAULT NULL,
  `FECHA_MODIFICACION` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_tipo_identificacion`
--

INSERT INTO `tbl_tipo_identificacion` (`id`, `TIPO_IDENTIFICACION`, `ESTADO`, `CREADO_POR`, `FECHA_CREACION`, `MODIFICADO_POR`, `FECHA_MODIFICACION`) VALUES
(1, 'DNI', NULL, NULL, NULL, NULL, NULL),
(2, 'RTN', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_tipo_movimiento`
--

CREATE TABLE `tbl_tipo_movimiento` (
  `id` bigint(20) NOT NULL,
  `TIPO_MOVIMIENTO` varchar(45) DEFAULT NULL,
  `CREADO_POR` varchar(45) DEFAULT NULL,
  `FECHA_CREACION` datetime DEFAULT NULL,
  `MODIFICADO_POR` varchar(45) DEFAULT NULL,
  `FECHA_MODIFICACION` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_tipo_movimiento`
--

INSERT INTO `tbl_tipo_movimiento` (`id`, `TIPO_MOVIMIENTO`, `CREADO_POR`, `FECHA_CREACION`, `MODIFICADO_POR`, `FECHA_MODIFICACION`) VALUES
(1, 'Factura', NULL, NULL, NULL, NULL),
(2, 'Boleta', NULL, NULL, NULL, NULL),
(3, 'Ticket', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_tipo_pago`
--

CREATE TABLE `tbl_tipo_pago` (
  `id` bigint(20) NOT NULL,
  `TIPO_PAGO` varchar(45) DEFAULT NULL,
  `CREADO POR` varchar(45) DEFAULT NULL,
  `FECHA_CREACION` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_tipo_pago`
--

INSERT INTO `tbl_tipo_pago` (`id`, `TIPO_PAGO`, `CREADO POR`, `FECHA_CREACION`) VALUES
(1, 'efectivo', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_tipo_persona`
--

CREATE TABLE `tbl_tipo_persona` (
  `idTipo` bigint(20) NOT NULL,
  `TIPO_PERSONA` varchar(25) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `CREADO_POR` varchar(45) DEFAULT NULL,
  `FECHA_CREACION` datetime DEFAULT NULL,
  `MODIFICADO_POR` varchar(45) DEFAULT NULL,
  `FECHA_MODIFICACION` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_tipo_persona`
--

INSERT INTO `tbl_tipo_persona` (`idTipo`, `TIPO_PERSONA`, `status`, `CREADO_POR`, `FECHA_CREACION`, `MODIFICADO_POR`, `FECHA_MODIFICACION`) VALUES
(1, 'CLIENTE', 1, NULL, NULL, NULL, NULL),
(2, 'PROVEEDOR', 1, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_tipo_telefono`
--

CREATE TABLE `tbl_tipo_telefono` (
  `id` bigint(20) NOT NULL,
  `TIPO_TELEFONO` varchar(45) DEFAULT NULL,
  `ESTADO` enum('ACTIVO','INACTIVO') DEFAULT NULL,
  `CREADO_POR` varchar(45) DEFAULT NULL,
  `FECHA_CREACION` datetime DEFAULT NULL,
  `MODIFICADO_POR` varchar(45) DEFAULT NULL,
  `FECHA_MODIFICACION` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_tipo_telefono`
--

INSERT INTO `tbl_tipo_telefono` (`id`, `TIPO_TELEFONO`, `ESTADO`, `CREADO_POR`, `FECHA_CREACION`, `MODIFICADO_POR`, `FECHA_MODIFICACION`) VALUES
(1, 'CASA', NULL, NULL, NULL, NULL, NULL),
(2, 'TRABAJO', NULL, NULL, NULL, NULL, NULL),
(3, 'PERSONAL', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_ventas`
--

CREATE TABLE `tbl_ventas` (
  `COD_VENTA` bigint(20) NOT NULL,
  `COD_PERSONA` bigint(20) DEFAULT NULL,
  `NUMERO_FACTURA` varchar(45) DEFAULT NULL,
  `DESCRIPCION` varchar(255) DEFAULT NULL,
  `TOTAL` double DEFAULT NULL,
  `ISV` double NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `CREADO_POR` varchar(45) DEFAULT NULL,
  `FECHA_CREACION` timestamp NULL DEFAULT NULL,
  `MODIFICADO_POR` varchar(45) DEFAULT NULL,
  `FECHA_MODIFICACION` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_ventas`
--

INSERT INTO `tbl_ventas` (`COD_VENTA`, `COD_PERSONA`, `NUMERO_FACTURA`, `DESCRIPCION`, `TOTAL`, `ISV`, `status`, `CREADO_POR`, `FECHA_CREACION`, `MODIFICADO_POR`, `FECHA_MODIFICACION`) VALUES
(10, 12, '87686786', '[{\"COD_PRODUCTO\":17,\"NOMBRE_PRODUCTO\":\"Mesa\",\"PRECIO\":0,\"EXISTENCIA\":1}]', 0, 0, 0, 'Gerson', '2023-04-19 06:00:00', NULL, NULL),
(11, 12, '4446', '[{\"COD_PRODUCTO\":18,\"NOMBRE_PRODUCTO\":\"Silla\",\"PRECIO\":50,\"EXISTENCIA\":\"25\"}]', 1250, 0, 0, 'Gerson', '2023-04-19 06:00:00', NULL, NULL),
(12, 12, '3241431241241', '[{\"COD_PRODUCTO\":19,\"NOMBRE_PRODUCTO\":\"fafa\",\"PRECIO\":50,\"EXISTENCIA\":\"45\"}]', 2250, 0, 1, 'Gerson', '2023-04-20 06:00:00', NULL, NULL),
(13, 12, '23141234123', '[{\"COD_PRODUCTO\":19,\"NOMBRE_PRODUCTO\":\"fafa\",\"PRECIO\":50,\"EXISTENCIA\":\"15\"}]', 750, 0, 0, 'Gerson', '2023-04-20 06:00:00', NULL, NULL),
(14, 12, '4564654', '[{\"COD_PRODUCTO\":17,\"NOMBRE_PRODUCTO\":\"Mesa\",\"PRECIO\":15,\"EXISTENCIA\":1}]', 15, 0, 1, 'Gerson', '2023-04-25 06:00:00', NULL, NULL),
(15, 12, '4777', '[{\"COD_PRODUCTO\":17,\"NOMBRE_PRODUCTO\":\"Mesa\",\"PRECIO\":15,\"EXISTENCIA\":\"15\"}]', 225, 0, 1, 'Gerson', '2023-05-02 06:00:00', NULL, NULL),
(16, 12, '4464', '[{\"COD_PRODUCTO\":26,\"NOMBRE_PRODUCTO\":\"777777\",\"PrecioVenta\":111112222,\"EXISTENCIA\":1}]', 111112222, 0, 1, 'Gerson', '2023-05-02 06:00:00', NULL, NULL),
(17, 12, '8888', '[{\"COD_PRODUCTO\":26,\"NOMBRE_PRODUCTO\":\"777777\",\"PrecioVenta\":30,\"EXISTENCIA\":1}]', 34.5, 4.5, 1, 'Gerson', '2023-05-02 06:00:00', NULL, NULL),
(18, 12, '6666', '[{\"COD_PRODUCTO\":26,\"NOMBRE_PRODUCTO\":\"777777\",\"PrecioVenta\":30,\"EXISTENCIA\":\"15\"}]', 517.5, 67.5, 1, 'Gerson', '2023-05-02 06:00:00', NULL, NULL),
(19, 12, '454', '[{\"COD_PRODUCTO\":27,\"NOMBRE_PRODUCTO\":\"pollo\",\"PrecioVenta\":32,\"EXISTENCIA\":\"7\"}]', 33.6, 0, 1, '257.6', '0000-00-00 00:00:00', NULL, NULL),
(20, 12, '55555', 'holi', 455, 68.25, 1, NULL, '2023-01-10 07:52:26', NULL, NULL),
(21, 23, '6456544536', 'vdcfgf', 455, 68.25, 1, NULL, '2023-01-05 07:54:25', NULL, NULL),
(22, 12, '99999999999999999999999999999999999999', '[{\"COD_PRODUCTO\":27,\"NOMBRE_PRODUCTO\":\"pollo\",\"PrecioVenta\":32,\"EXISTENCIA\":\"45\"}]', 216, 0, 1, '1656', '0000-00-00 00:00:00', NULL, NULL),
(23, 12, '777', '[{\"COD_PRODUCTO\":27,\"NOMBRE_PRODUCTO\":\"pollo\",\"PrecioVenta\":32,\"EXISTENCIA\":1}]', 4.8, 0, 1, '36.8', '0000-00-00 00:00:00', NULL, NULL),
(24, 12, '65465464', '[{\"COD_PRODUCTO\":27,\"NOMBRE_PRODUCTO\":\"pollo\",\"PrecioVenta\":32,\"EXISTENCIA\":1}]', 4.8, 0, 1, '36.8', '0000-00-00 00:00:00', NULL, NULL),
(25, 12, '7417474', '[{\"COD_PRODUCTO\":27,\"NOMBRE_PRODUCTO\":\"pollo\",\"PRECIO\":25,\"EXISTENCIA\":1}]', 28.75, 3.75, 1, 'Gerson', '2023-05-02 06:00:00', NULL, NULL),
(26, 12, '654564', '[{\"COD_PRODUCTO\":27,\"NOMBRE_PRODUCTO\":\"pollo\",\"PRECIO\":25,\"EXISTENCIA\":1}]', 28.75, 3.75, 1, 'Gerson', '2023-05-02 06:00:00', NULL, NULL),
(27, 12, '964546', '[{\"COD_PRODUCTO\":27,\"NOMBRE_PRODUCTO\":\"pollo\",\"PRECIO\":25,\"EXISTENCIA\":1}]', 28.75, 3.75, 1, 'Gerson', '2023-05-02 06:00:00', NULL, NULL),
(28, 12, '54654', '[{\"COD_PRODUCTO\":27,\"NOMBRE_PRODUCTO\":\"pollo\",\"PRECIO\":25,\"EXISTENCIA\":1}]', 28.75, 3.75, 0, 'Gerson', '2023-05-02 06:00:00', NULL, NULL),
(29, 12, '444444', '[{\"COD_PRODUCTO\":27,\"NOMBRE_PRODUCTO\":\"pollo\",\"PRECIO\":25,\"EXISTENCIA\":1}]', 28.75, 3.75, 0, 'Gerson', '2023-05-03 06:00:00', NULL, NULL),
(30, 12, '5454', '[{\"COD_PRODUCTO\":27,\"NOMBRE_PRODUCTO\":\"pollo\",\"PRECIO\":25,\"EXISTENCIA\":\"5\"}]', 143.75, 18.75, 0, 'Gerson', '2023-05-03 06:00:00', NULL, NULL),
(31, 12, '1111', '[{\"COD_PRODUCTO\":27,\"NOMBRE_PRODUCTO\":\"pollo\",\"PRECIO\":25,\"EXISTENCIA\":\"15\"}]', 431.25, 56.25, 1, 'Gerson', '2023-05-03 06:00:00', NULL, NULL),
(32, 12, '22222', '[{\"COD_PRODUCTO\":27,\"NOMBRE_PRODUCTO\":\"pollo\",\"PRECIO\":25,\"EXISTENCIA\":\"4\"}]', 115, 15, 0, 'Gerson', '2023-05-03 06:00:00', NULL, NULL),
(33, 12, '4515356', '[{\"COD_PRODUCTO\":27,\"NOMBRE_PRODUCTO\":\"pollo\",\"PRECIO\":25,\"EXISTENCIA\":1},{\"COD_PRODUCTO\":30,\"NOMBRE_PRODUCTO\":\"producto prueba\",\"PRECIO\":99,\"EXISTENCIA\":1}]', 142.6, 14.85, 1, 'Gerson', '2023-05-04 06:00:00', NULL, NULL);

--
-- Disparadores `tbl_ventas`
--
DELIMITER $$
CREATE TRIGGER `trigger_inv_devo_venta` BEFORE UPDATE ON `tbl_ventas` FOR EACH ROW BEGIN
INSERT INTO tbl_inventario(accion,Nom_factura,TOTAL,ISV,CREADO_POR,FECHA_CREACION) VALUES('Se genero una devolucion de productos',new.NUMERO_FACTURA,new.TOTAL,new.ISV,new.CREADO_POR,new.FECHA_CREACION);

END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `triggers_inventario_venta` AFTER INSERT ON `tbl_ventas` FOR EACH ROW BEGIN
INSERT INTO tbl_inventario(accion,Nom_factura,TOTAL,ISV,CREADO_POR,FECHA_CREACION) VALUES('Se genero una salida de productos',new.NUMERO_FACTURA,new.TOTAL,new.ISV,new.CREADO_POR,new.FECHA_CREACION);

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ttbl_venta_detalle`
--

CREATE TABLE `ttbl_venta_detalle` (
  `COD_VENTA_DETALLE` bigint(20) NOT NULL,
  `COD_VENTA` bigint(20) DEFAULT NULL,
  `COD_PRODUCTO` bigint(20) DEFAULT NULL,
  `CANTIDAD` double DEFAULT NULL,
  `SUBTOTAL` double DEFAULT NULL,
  `IMPUESTO` double DEFAULT NULL,
  `DESCUENTO` double DEFAULT NULL,
  `TOTAL` double DEFAULT NULL,
  `CREADO_POR` varchar(45) DEFAULT NULL,
  `FECHA_CREACION` datetime DEFAULT NULL,
  `MODIFICADO_POR` varchar(45) DEFAULT NULL,
  `FECHA_MODIFICACION` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbl_bitacora`
--
ALTER TABLE `tbl_bitacora`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbl_categoria`
--
ALTER TABLE `tbl_categoria`
  ADD PRIMARY KEY (`idcategoria`);

--
-- Indices de la tabla `tbl_compras`
--
ALTER TABLE `tbl_compras`
  ADD PRIMARY KEY (`COD_COMPRA`),
  ADD KEY `fk_compras_personas_idx` (`COD_PERSONA`);

--
-- Indices de la tabla `tbl_compra_detalle`
--
ALTER TABLE `tbl_compra_detalle`
  ADD PRIMARY KEY (`COD_COMPRA_DETALLE`),
  ADD KEY `fk_compra_detalle_compra_idx` (`COD_COMPRA`),
  ADD KEY `fk_compra_detalle_producto_idx` (`COD_PRODUCTO`);

--
-- Indices de la tabla `tbl_cotizaciones`
--
ALTER TABLE `tbl_cotizaciones`
  ADD PRIMARY KEY (`COD_COTIZACION`),
  ADD KEY `fk_cotizaciones_personas` (`COD_PERSONA`);

--
-- Indices de la tabla `tbl_direccion`
--
ALTER TABLE `tbl_direccion`
  ADD PRIMARY KEY (`COD_DIRECCION`),
  ADD KEY `fk_direccion_cod_persona_idx` (`COD_PERSONA`),
  ADD KEY `fk_direccion_cod_tipo_direccion_idx` (`COD_TIPO_DIRECCION`);

--
-- Indices de la tabla `tbl_empresa`
--
ALTER TABLE `tbl_empresa`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbl_historial_contrasena`
--
ALTER TABLE `tbl_historial_contrasena`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbl_imagen`
--
ALTER TABLE `tbl_imagen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `COD_PRODUCTO` (`productoid`);

--
-- Indices de la tabla `tbl_ingreso`
--
ALTER TABLE `tbl_ingreso`
  ADD PRIMARY KEY (`COD_INGRESO`),
  ADD KEY `fk_ingreso_producto_idx` (`COD_PRODUCTO`);

--
-- Indices de la tabla `tbl_inventario`
--
ALTER TABLE `tbl_inventario`
  ADD PRIMARY KEY (`COD_INVENTARIO`);

--
-- Indices de la tabla `tbl_ms_modulo`
--
ALTER TABLE `tbl_ms_modulo`
  ADD PRIMARY KEY (`idmodulo`);

--
-- Indices de la tabla `tbl_ms_permisos`
--
ALTER TABLE `tbl_ms_permisos`
  ADD PRIMARY KEY (`idpermiso`),
  ADD KEY `rolid` (`rolid`),
  ADD KEY `moduloid` (`moduloid`);

--
-- Indices de la tabla `tbl_ms_preguntas_por_usuario`
--
ALTER TABLE `tbl_ms_preguntas_por_usuario`
  ADD PRIMARY KEY (`COD_PRREGUNTA`),
  ADD KEY `fk_cod_usuario_idx` (`COD_USUARIO`);

--
-- Indices de la tabla `tbl_ms_rol`
--
ALTER TABLE `tbl_ms_rol`
  ADD PRIMARY KEY (`idrol`);

--
-- Indices de la tabla `tbl_ms_usuarios`
--
ALTER TABLE `tbl_ms_usuarios`
  ADD PRIMARY KEY (`idpersona`),
  ADD KEY `rolid` (`rolid`);

--
-- Indices de la tabla `tbl_personas`
--
ALTER TABLE `tbl_personas`
  ADD PRIMARY KEY (`COD_PERSONA`),
  ADD KEY `fk_personas_cod_tipo_persona_idx` (`COD_TIPO_PERSONA`),
  ADD KEY `fk_personas_cod_tipo_identificacion_idx` (`COD_TIPO_IDENTIFICACION`);

--
-- Indices de la tabla `tbl_producto`
--
ALTER TABLE `tbl_producto`
  ADD PRIMARY KEY (`COD_PRODUCTO`),
  ADD KEY `fk_producto_categoria_idx` (`COD_CATEGORIA`);

--
-- Indices de la tabla `tbl_regimen_facturacion`
--
ALTER TABLE `tbl_regimen_facturacion`
  ADD PRIMARY KEY (`COD_REGIMEN`),
  ADD KEY `fk_facturacion_ventas_idx` (`COD_VENTA`);

--
-- Indices de la tabla `tbl_salida`
--
ALTER TABLE `tbl_salida`
  ADD PRIMARY KEY (`COD_SALIDA`),
  ADD KEY `fk_salida_producto_idx` (`COD_PRODUCTO`);

--
-- Indices de la tabla `tbl_telefono`
--
ALTER TABLE `tbl_telefono`
  ADD PRIMARY KEY (`COD_TELEFONO`),
  ADD KEY `fk_telefono_cod_persona_idx` (`COD_PERSONA`),
  ADD KEY `fk_telefono_cod_tipo_telefono_idx` (`COD_TIPO_TELEFONO`);

--
-- Indices de la tabla `tbl_tipo_direccion`
--
ALTER TABLE `tbl_tipo_direccion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbl_tipo_identificacion`
--
ALTER TABLE `tbl_tipo_identificacion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbl_tipo_movimiento`
--
ALTER TABLE `tbl_tipo_movimiento`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbl_tipo_pago`
--
ALTER TABLE `tbl_tipo_pago`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbl_tipo_persona`
--
ALTER TABLE `tbl_tipo_persona`
  ADD PRIMARY KEY (`idTipo`);

--
-- Indices de la tabla `tbl_tipo_telefono`
--
ALTER TABLE `tbl_tipo_telefono`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbl_ventas`
--
ALTER TABLE `tbl_ventas`
  ADD PRIMARY KEY (`COD_VENTA`),
  ADD KEY `fk_ventas_personas_idx` (`COD_PERSONA`);

--
-- Indices de la tabla `ttbl_venta_detalle`
--
ALTER TABLE `ttbl_venta_detalle`
  ADD PRIMARY KEY (`COD_VENTA_DETALLE`),
  ADD KEY `fk_detalle_venta_venta_idx` (`COD_VENTA`),
  ADD KEY `fk_detalle_venta_producto_idx` (`COD_PRODUCTO`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbl_bitacora`
--
ALTER TABLE `tbl_bitacora`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=159;

--
-- AUTO_INCREMENT de la tabla `tbl_categoria`
--
ALTER TABLE `tbl_categoria`
  MODIFY `idcategoria` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `tbl_compras`
--
ALTER TABLE `tbl_compras`
  MODIFY `COD_COMPRA` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT de la tabla `tbl_compra_detalle`
--
ALTER TABLE `tbl_compra_detalle`
  MODIFY `COD_COMPRA_DETALLE` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_cotizaciones`
--
ALTER TABLE `tbl_cotizaciones`
  MODIFY `COD_COTIZACION` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `tbl_direccion`
--
ALTER TABLE `tbl_direccion`
  MODIFY `COD_DIRECCION` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `tbl_historial_contrasena`
--
ALTER TABLE `tbl_historial_contrasena`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `tbl_imagen`
--
ALTER TABLE `tbl_imagen`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_ingreso`
--
ALTER TABLE `tbl_ingreso`
  MODIFY `COD_INGRESO` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_inventario`
--
ALTER TABLE `tbl_inventario`
  MODIFY `COD_INVENTARIO` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `tbl_ms_modulo`
--
ALTER TABLE `tbl_ms_modulo`
  MODIFY `idmodulo` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `tbl_ms_permisos`
--
ALTER TABLE `tbl_ms_permisos`
  MODIFY `idpermiso` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=553;

--
-- AUTO_INCREMENT de la tabla `tbl_ms_preguntas_por_usuario`
--
ALTER TABLE `tbl_ms_preguntas_por_usuario`
  MODIFY `COD_PRREGUNTA` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tbl_ms_rol`
--
ALTER TABLE `tbl_ms_rol`
  MODIFY `idrol` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `tbl_ms_usuarios`
--
ALTER TABLE `tbl_ms_usuarios`
  MODIFY `idpersona` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT de la tabla `tbl_personas`
--
ALTER TABLE `tbl_personas`
  MODIFY `COD_PERSONA` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `tbl_producto`
--
ALTER TABLE `tbl_producto`
  MODIFY `COD_PRODUCTO` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `tbl_regimen_facturacion`
--
ALTER TABLE `tbl_regimen_facturacion`
  MODIFY `COD_REGIMEN` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tbl_salida`
--
ALTER TABLE `tbl_salida`
  MODIFY `COD_SALIDA` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_telefono`
--
ALTER TABLE `tbl_telefono`
  MODIFY `COD_TELEFONO` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `tbl_tipo_direccion`
--
ALTER TABLE `tbl_tipo_direccion`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tbl_tipo_identificacion`
--
ALTER TABLE `tbl_tipo_identificacion`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tbl_tipo_movimiento`
--
ALTER TABLE `tbl_tipo_movimiento`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tbl_tipo_pago`
--
ALTER TABLE `tbl_tipo_pago`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tbl_tipo_persona`
--
ALTER TABLE `tbl_tipo_persona`
  MODIFY `idTipo` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tbl_tipo_telefono`
--
ALTER TABLE `tbl_tipo_telefono`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tbl_ventas`
--
ALTER TABLE `tbl_ventas`
  MODIFY `COD_VENTA` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `ttbl_venta_detalle`
--
ALTER TABLE `ttbl_venta_detalle`
  MODIFY `COD_VENTA_DETALLE` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tbl_compras`
--
ALTER TABLE `tbl_compras`
  ADD CONSTRAINT `fk_compras_personas` FOREIGN KEY (`COD_PERSONA`) REFERENCES `tbl_personas` (`COD_PERSONA`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_compra_detalle`
--
ALTER TABLE `tbl_compra_detalle`
  ADD CONSTRAINT `fk_compra_detalle_compra` FOREIGN KEY (`COD_COMPRA`) REFERENCES `tbl_compras` (`COD_COMPRA`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_compra_detalle_producto` FOREIGN KEY (`COD_PRODUCTO`) REFERENCES `tbl_producto` (`COD_PRODUCTO`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_cotizaciones`
--
ALTER TABLE `tbl_cotizaciones`
  ADD CONSTRAINT `fk_cotizaciones_personas` FOREIGN KEY (`COD_PERSONA`) REFERENCES `tbl_personas` (`COD_PERSONA`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_direccion`
--
ALTER TABLE `tbl_direccion`
  ADD CONSTRAINT `fk_direccion_cod_persona` FOREIGN KEY (`COD_PERSONA`) REFERENCES `tbl_personas` (`COD_PERSONA`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_direccion_cod_tipo_direccion` FOREIGN KEY (`COD_TIPO_DIRECCION`) REFERENCES `tbl_tipo_direccion` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_imagen`
--
ALTER TABLE `tbl_imagen`
  ADD CONSTRAINT `tbl_imagen_ibfk_1` FOREIGN KEY (`productoid`) REFERENCES `tbl_producto` (`COD_PRODUCTO`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tbl_ingreso`
--
ALTER TABLE `tbl_ingreso`
  ADD CONSTRAINT `fk_ingreso_producto` FOREIGN KEY (`COD_PRODUCTO`) REFERENCES `tbl_producto` (`COD_PRODUCTO`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_ms_permisos`
--
ALTER TABLE `tbl_ms_permisos`
  ADD CONSTRAINT `tbl_ms_permisos_ibfk_1` FOREIGN KEY (`rolid`) REFERENCES `tbl_ms_rol` (`idrol`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_ms_permisos_ibfk_2` FOREIGN KEY (`moduloid`) REFERENCES `tbl_ms_modulo` (`idmodulo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tbl_ms_preguntas_por_usuario`
--
ALTER TABLE `tbl_ms_preguntas_por_usuario`
  ADD CONSTRAINT `fk_cod_usuario` FOREIGN KEY (`COD_USUARIO`) REFERENCES `tbl_ms_usuarios` (`idpersona`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_ms_usuarios`
--
ALTER TABLE `tbl_ms_usuarios`
  ADD CONSTRAINT `tbl_ms_usuarios_ibfk_1` FOREIGN KEY (`rolid`) REFERENCES `tbl_ms_rol` (`idrol`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tbl_personas`
--
ALTER TABLE `tbl_personas`
  ADD CONSTRAINT `fk_personas_cod_tipo_identificacion` FOREIGN KEY (`COD_TIPO_IDENTIFICACION`) REFERENCES `tbl_tipo_identificacion` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_personas_cod_tipo_persona` FOREIGN KEY (`COD_TIPO_PERSONA`) REFERENCES `tbl_tipo_persona` (`idTipo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_producto`
--
ALTER TABLE `tbl_producto`
  ADD CONSTRAINT `fk_producto_categoria` FOREIGN KEY (`COD_CATEGORIA`) REFERENCES `tbl_categoria` (`idcategoria`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_regimen_facturacion`
--
ALTER TABLE `tbl_regimen_facturacion`
  ADD CONSTRAINT `fk_facturacion_ventas` FOREIGN KEY (`COD_VENTA`) REFERENCES `tbl_ventas` (`COD_VENTA`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_salida`
--
ALTER TABLE `tbl_salida`
  ADD CONSTRAINT `fk_salida_producto` FOREIGN KEY (`COD_PRODUCTO`) REFERENCES `tbl_producto` (`COD_PRODUCTO`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_telefono`
--
ALTER TABLE `tbl_telefono`
  ADD CONSTRAINT `fk_telefono_cod_persona` FOREIGN KEY (`COD_PERSONA`) REFERENCES `tbl_personas` (`COD_PERSONA`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_telefono_cod_tipo_telefono` FOREIGN KEY (`COD_TIPO_TELEFONO`) REFERENCES `tbl_tipo_telefono` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_ventas`
--
ALTER TABLE `tbl_ventas`
  ADD CONSTRAINT `fk_ventas_personas` FOREIGN KEY (`COD_PERSONA`) REFERENCES `tbl_personas` (`COD_PERSONA`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `ttbl_venta_detalle`
--
ALTER TABLE `ttbl_venta_detalle`
  ADD CONSTRAINT `fk_detalle_venta_producto` FOREIGN KEY (`COD_PRODUCTO`) REFERENCES `tbl_producto` (`COD_PRODUCTO`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_detalle_venta_venta` FOREIGN KEY (`COD_VENTA`) REFERENCES `tbl_ventas` (`COD_VENTA`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
