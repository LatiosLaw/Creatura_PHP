-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-05-2025 a las 18:42:15
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `creatura`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `creatura`
--

CREATE TABLE `creatura` (
  `id_creatura` int(10) NOT NULL,
  `nombre_creatura` varchar(30) NOT NULL,
  `tipo1` varchar(15) NOT NULL,
  `tipo2` varchar(15) NOT NULL,
  `hp` int(3) NOT NULL,
  `atk` int(3) NOT NULL,
  `def` int(3) NOT NULL,
  `spa` int(3) NOT NULL,
  `sdef` int(3) NOT NULL,
  `spe` int(3) NOT NULL,
  `creador` varchar(30) NOT NULL,
  `imagen` varchar(100) NOT NULL,
  `publico` int(2) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `efectividades`
--

CREATE TABLE `efectividades` (
  `id_efectividad` int(5) NOT NULL,
  `atacante` varchar(20) NOT NULL,
  `defensor` varchar(20) NOT NULL,
  `multiplicador` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `habilidad`
--

CREATE TABLE `habilidad` (
  `id_habilidad` int(5) NOT NULL,
  `nombre_habilidad` varchar(25) NOT NULL,
  `tipo_habilidad` varchar(20) NOT NULL COMMENT 'A que tipo pertenece esta habilidad',
  `descripcion` varchar(80) NOT NULL,
  `categoria_habilidad` varchar(10) NOT NULL COMMENT 'Ataque físico, ataque especial o habilidad de estado',
  `potencia` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `moveset`
--

CREATE TABLE `moveset` (
  `id_moveset` int(5) NOT NULL,
  `nombre_creatura` varchar(30) NOT NULL,
  `nombre_habilidad` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo`
--

CREATE TABLE `tipo` (
  `id_tipo` varchar(5) NOT NULL,
  `nombre_tipo` varchar(15) NOT NULL,
  `color` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `nickname` varchar(20) NOT NULL,
  `correo` varchar(35) NOT NULL,
  `contraseña` varchar(30) NOT NULL,
  `tipo` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `creatura`
--
ALTER TABLE `creatura`
  ADD PRIMARY KEY (`id_creatura`);

--
-- Indices de la tabla `efectividades`
--
ALTER TABLE `efectividades`
  ADD PRIMARY KEY (`id_efectividad`);

--
-- Indices de la tabla `habilidad`
--
ALTER TABLE `habilidad`
  ADD PRIMARY KEY (`id_habilidad`);

--
-- Indices de la tabla `tipo`
--
ALTER TABLE `tipo`
  ADD PRIMARY KEY (`id_tipo`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`nickname`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
