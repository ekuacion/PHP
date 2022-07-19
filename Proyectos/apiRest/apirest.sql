-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-07-2022 a las 15:33:43
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `apirest`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citas`
--

CREATE TABLE `citas` (
  `CitaId` int(11) NOT NULL,
  `PacienteId` varchar(45) DEFAULT NULL,
  `Fecha` varchar(45) DEFAULT NULL,
  `HoraInicio` varchar(45) DEFAULT NULL,
  `HoraFIn` varchar(45) DEFAULT NULL,
  `Estado` varchar(45) DEFAULT NULL,
  `Motivo` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `citas`
--

INSERT INTO `citas` (`CitaId`, `PacienteId`, `Fecha`, `HoraInicio`, `HoraFIn`, `Estado`, `Motivo`) VALUES
(1, '1', '2020-06-09', '08:30:00', '09:00:00', 'Confirmada', 'El paciente presenta un leve dolor de espalda'),
(2, '2', '2020-06-10', '08:30:00', '09:00:00', 'Confirmada', 'Dolor en la zona lumbar '),
(3, '3', '2020-06-18', '09:00:00', '09:30:00', 'Confirmada', 'Dolor en el cuello');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pacientes`
--

CREATE TABLE `pacientes` (
  `PacienteId` int(11) NOT NULL,
  `DNI` varchar(45) DEFAULT NULL,
  `Nombre` varchar(150) DEFAULT NULL,
  `Direccion` varchar(45) DEFAULT NULL,
  `CodigoPostal` varchar(45) DEFAULT NULL,
  `Telefono` varchar(45) DEFAULT NULL,
  `Genero` varchar(45) DEFAULT NULL,
  `FechaNacimiento` date DEFAULT NULL,
  `Correo` varchar(45) DEFAULT NULL,
  `Imagen` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `pacientes`
--

INSERT INTO `pacientes` (`PacienteId`, `DNI`, `Nombre`, `Direccion`, `CodigoPostal`, `Telefono`, `Genero`, `FechaNacimiento`, `Correo`, `Imagen`) VALUES
(1, 'A000000001', 'Juan Carlos Medina', 'Calle de pruebas 1', '20001', '633281515', 'M', '1989-03-02', 'Paciente1@gmail.com', ''),
(2, 'B000000002', 'Daniel Rios', 'Calle de pruebas 2', '20002', '633281512', 'M', '1990-05-11', 'Paciente2@gmail.com', ''),
(3, 'C000000003', 'Marcela Dubon', 'Calle de pruebas 3', '20003', '633281511', 'F', '2000-07-22', 'Paciente3@gmail.com', ''),
(16, 'H55555s', 'Mauricio Gomez', '', '', '', '', '0000-00-00', 'pgomezs@gmail.com', 'C:xampphtdocsProyectosackendpublicimagenes62c355abca09d.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `UsuarioId` int(11) NOT NULL,
  `Usuario` varchar(45) DEFAULT NULL,
  `Password` varchar(45) DEFAULT NULL,
  `Estado` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`UsuarioId`, `Usuario`, `Password`, `Estado`) VALUES
(1, 'usuario1@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Activo'),
(2, 'usuario2@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Activo'),
(3, 'usuario3@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Activo'),
(4, 'usuario4@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Activo'),
(5, 'usuario5@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Activo'),
(6, 'usuario6@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Activo'),
(7, 'usuario7@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Inactivo'),
(8, 'usuario8@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Inactivo'),
(9, 'usuario9@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Inactivo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_token`
--

CREATE TABLE `usuarios_token` (
  `TokenId` int(11) NOT NULL,
  `UsuarioId` varchar(45) DEFAULT NULL,
  `Token` varchar(45) DEFAULT NULL,
  `Estado` varchar(45) CHARACTER SET armscii8 DEFAULT NULL,
  `Fecha` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios_token`
--

INSERT INTO `usuarios_token` (`TokenId`, `UsuarioId`, `Token`, `Estado`, `Fecha`) VALUES
(1, '1', 'f8303f4def6c667a9fb9376ccd52d1af', 'Inactivo', '2022-07-01 17:07:00'),
(15, '1', '7de8b9fbe6bf549ac37b4f2dde17b106', 'Inactivo', '2022-07-04 12:47:00'),
(16, '1', 'bef29d7a56e8d9eb150f0b94a3690957', 'Inactivo', '2022-07-04 16:01:00'),
(17, '1', '430db3b55c9ad9938e24c364742ccf11', 'Inactivo', '2022-07-04 16:18:00'),
(18, '1', '6f8e44d00f7d89b987f3fb1636b2be2d', 'Inactivo', '2022-07-04 17:51:00'),
(19, '1', '48304f842b805c9f8875e60f5bd898ee', 'Inactivo', '2022-07-05 13:36:00'),
(20, '1', '81f522590e2f6d9491f677895d1b8bb6', 'Activo', '2022-07-05 16:38:00'),
(21, '1', '6c8654145566c11f7e5dc4b4a5b753ae', 'Activo', '2022-07-05 17:01:00'),
(22, '1', '213fb0504e3b058093b62b8af461be05', 'Activo', '2022-07-05 17:02:00'),
(23, '1', '2cb5c9cddef9d376f93907e6e03bb259', 'Activo', '2022-07-05 17:09:00'),
(24, '1', '2140214559a2788891c4dbf724c68dfb', 'Activo', '2022-07-05 17:14:00'),
(25, '1', 'e9b1e4f7f5dcc2b74598131c64ff299b', 'Activo', '2022-07-05 17:15:00'),
(26, '1', '6d68af1bce92f60a846b1490a0815dbd', 'Activo', '2022-07-05 17:17:00'),
(27, '1', '1683ea2e9dd98ee597e42179471a780e', 'Activo', '2022-07-05 17:17:00'),
(28, '1', 'b798a89f6775704d532273f0bc48262a', 'Activo', '2022-07-05 17:17:00'),
(29, '1', '0b59558b6c0313c4600d083e615972c9', 'Activo', '2022-07-05 17:20:00'),
(30, '1', 'ee8756550254041e09cdafd48e3055b2', 'Activo', '2022-07-05 17:22:00'),
(31, '1', '9afbb4a7729920af579e402f84417661', 'Activo', '2022-07-05 17:23:00'),
(32, '1', '54e12c7b9b52b6a70cc88663bbf41cca', 'Activo', '2022-07-05 17:25:00'),
(33, '1', '51c24dc0c3c7cf879341a2eaf3d7af9d', 'Activo', '2022-07-05 17:28:00'),
(34, '1', 'c0028efb007298c348721ffef00c658e', 'Activo', '2022-07-05 17:29:00'),
(35, '1', '14bd23e8315413c594aed3e47286b51b', 'Activo', '2022-07-05 17:32:00'),
(36, '1', 'd2e3ecea64848c1076e9be520b619a93', 'Activo', '2022-07-05 17:33:00'),
(37, '1', '1f7498fb37ba588c4cab5d1431c22667', 'Activo', '2022-07-05 17:36:00'),
(38, '1', '74d9147c5f552477844c46aaac9c0937', 'Activo', '2022-07-05 17:37:00'),
(39, '1', 'b7c25458631745453c279f78713ca1d6', 'Activo', '2022-07-05 17:38:00'),
(40, '1', '4e53a5ca3cf9de77519c7975420ca751', 'Activo', '2022-07-05 17:43:00'),
(41, '1', '55d29305c16554938b2bf627278c7732', 'Activo', '2022-07-05 17:48:00'),
(42, '1', 'd2bee3017008ce51af6d5247c8a9cd47', 'Activo', '2022-07-05 17:53:00'),
(43, '1', '83a5e4fb4edeb0f5f37030d8cda43925', 'Activo', '2022-07-06 09:32:00');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `citas`
--
ALTER TABLE `citas`
  ADD PRIMARY KEY (`CitaId`);

--
-- Indices de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  ADD PRIMARY KEY (`PacienteId`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`UsuarioId`);

--
-- Indices de la tabla `usuarios_token`
--
ALTER TABLE `usuarios_token`
  ADD PRIMARY KEY (`TokenId`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `citas`
--
ALTER TABLE `citas`
  MODIFY `CitaId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  MODIFY `PacienteId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `UsuarioId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `usuarios_token`
--
ALTER TABLE `usuarios_token`
  MODIFY `TokenId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
