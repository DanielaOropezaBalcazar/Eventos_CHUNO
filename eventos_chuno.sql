-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-03-2025 a las 03:25:29
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `eventos_chuno`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistente`
--

CREATE TABLE `asistente` (
  `idAsistente` int(11) NOT NULL,
  `Gmail` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `charlas`
--

CREATE TABLE `charlas` (
  `idCharla` int(11) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Institucion` varchar(100) NOT NULL,
  `idDepartamento` int(11) NOT NULL,
  `idModalidad` int(11) NOT NULL,
  `Fecha` date NOT NULL,
  `Hora` time NOT NULL,
  `LinkReunion` varchar(50) NOT NULL,
  `Codigo` varchar(50) NOT NULL,
  `LinkPresentacion` varchar(100) NOT NULL,
  `Likes` int(11) NOT NULL,
  `Dislikes` int(11) NOT NULL,
  `Estado` tinyint(1) NOT NULL,
  `idOrador` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `charlas`
--

INSERT INTO `charlas` (`idCharla`, `Nombre`, `Institucion`, `idDepartamento`, `idModalidad`, `Fecha`, `Hora`, `LinkReunion`, `Codigo`, `LinkPresentacion`, `Likes`, `Dislikes`, `Estado`, `idOrador`) VALUES
(2, 'Macrame en forma de michis', 'UPB', 2, 1, '2025-03-14', '20:00:00', 'meet.com', '1234', 'canva.com', 0, 0, 1, 1),
(3, 'Periodismo Independiente', 'UPB', 2, 2, '2025-04-15', '18:00:00', 'meet.com', '5564', 'canva.com', 0, 0, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `charlasasistentes`
--

CREATE TABLE `charlasasistentes` (
  `idCA` int(11) NOT NULL,
  `idAsistente` int(11) NOT NULL,
  `idCharla` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamento`
--

CREATE TABLE `departamento` (
  `idDepartamento` int(11) NOT NULL,
  `Departamento` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `departamento`
--

INSERT INTO `departamento` (`idDepartamento`, `Departamento`) VALUES
(1, 'La Paz'),
(2, 'Santa Cruz'),
(3, 'Cochabamba'),
(4, 'Tarija'),
(5, 'Chuquisaca'),
(6, 'Oruro'),
(7, 'Potosí'),
(8, 'Pando'),
(9, 'Beni');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modalidad`
--

CREATE TABLE `modalidad` (
  `idModalidad` int(11) NOT NULL,
  `Modalidad` char(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `modalidad`
--

INSERT INTO `modalidad` (`idModalidad`, `Modalidad`) VALUES
(1, 'Virtual'),
(2, 'Presencial');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orador`
--

CREATE TABLE `orador` (
  `idOrador` int(11) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Gmail` varchar(100) NOT NULL,
  `Contrasena` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `orador`
--

INSERT INTO `orador` (`idOrador`, `Nombre`, `Gmail`, `Contrasena`) VALUES
(1, 'Santiago Torrez', 'storrez@gmail.com', '12345');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `asistente`
--
ALTER TABLE `asistente`
  ADD PRIMARY KEY (`idAsistente`);

--
-- Indices de la tabla `charlas`
--
ALTER TABLE `charlas`
  ADD PRIMARY KEY (`idCharla`),
  ADD KEY `Charlas_Departamento` (`idDepartamento`),
  ADD KEY `Charlas_Modalidad` (`idModalidad`),
  ADD KEY `Charlas_Oradores` (`idOrador`);

--
-- Indices de la tabla `charlasasistentes`
--
ALTER TABLE `charlasasistentes`
  ADD PRIMARY KEY (`idCA`),
  ADD KEY `CharlasAsistentes_Asistentes` (`idAsistente`),
  ADD KEY `CharlasAsistentes_Charlas` (`idCharla`);

--
-- Indices de la tabla `departamento`
--
ALTER TABLE `departamento`
  ADD PRIMARY KEY (`idDepartamento`);

--
-- Indices de la tabla `modalidad`
--
ALTER TABLE `modalidad`
  ADD PRIMARY KEY (`idModalidad`);

--
-- Indices de la tabla `orador`
--
ALTER TABLE `orador`
  ADD PRIMARY KEY (`idOrador`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `charlas`
--
ALTER TABLE `charlas`
  MODIFY `idCharla` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `charlas`
--
ALTER TABLE `charlas`
  ADD CONSTRAINT `Charlas_Departamento` FOREIGN KEY (`idDepartamento`) REFERENCES `departamento` (`idDepartamento`),
  ADD CONSTRAINT `Charlas_Modalidad` FOREIGN KEY (`idModalidad`) REFERENCES `modalidad` (`idModalidad`),
  ADD CONSTRAINT `Charlas_Oradores` FOREIGN KEY (`idOrador`) REFERENCES `orador` (`idOrador`);

--
-- Filtros para la tabla `charlasasistentes`
--
ALTER TABLE `charlasasistentes`
  ADD CONSTRAINT `CharlasAsistentes_Asistentes` FOREIGN KEY (`idAsistente`) REFERENCES `asistente` (`idAsistente`),
  ADD CONSTRAINT `CharlasAsistentes_Charlas` FOREIGN KEY (`idCharla`) REFERENCES `charlas` (`idCharla`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
