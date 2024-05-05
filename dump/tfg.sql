-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3307
-- Tiempo de generación: 14-04-2024 a las 18:23:32
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
-- Base de datos: `tfg`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumno`
--

CREATE TABLE `alumno` (
  `matricula` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `usuario_id` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `alumno`
--

INSERT INTO `alumno` (`matricula`, `nombre`, `apellido`, `correo`, `usuario_id`) VALUES
(1, 'Sofía', 'Cadenas', 's.cadenas@upm.es', 's.cadenas'),
(2, 'Luis ', 'Fuentes', 'luis.fuentes@upm.es', 'luis.f'),
(3, 'Roberto', 'Calderón', 'roberto.calderon@upm.es', 'roberto.calderon');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignatura`
--

CREATE TABLE `asignatura` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `creditos` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `asignatura`
--

INSERT INTO `asignatura` (`id`, `nombre`, `creditos`) VALUES
(1, 'Geometría diferencial', 6),
(2, 'Gestión de proyectos', 3),
(3, 'Álgebra I', 6),
(4, 'Practicum', 12);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursa`
--

CREATE TABLE `cursa` (
  `alumno_id` int(11) NOT NULL,
  `asignatura_id` int(11) NOT NULL,
  `nota` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `cursa`
--

INSERT INTO `cursa` (`alumno_id`, `asignatura_id`, `nota`) VALUES
(1, 1, 7),
(1, 3, 8),
(1, 4, 10),
(2, 1, 6),
(2, 2, 5),
(2, 4, 6),
(3, 1, NULL),
(3, 2, 6),
(3, 3, 9),
(3, 4, 9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imparte`
--

CREATE TABLE `imparte` (
  `profesor_id` int(11) NOT NULL,
  `asignatura_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `imparte`
--

INSERT INTO `imparte` (`profesor_id`, `asignatura_id`) VALUES
(1, 3),
(2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesor`
--

CREATE TABLE `profesor` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `usuario_id` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `profesor`
--

INSERT INTO `profesor` (`id`, `nombre`, `apellido`, `correo`, `usuario_id`) VALUES
(1, 'fernando', 'gomez', 'f.gomez@profe.upm.es', 'fernando.gomez'),
(2, 'pablo', 'hernandez', 'pablo.h@profes.upm.es', 'p.hernandez'),
(4, 'atacante', 'malicioso', 'ataque@upm.es', 'atacante');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `usuario` varchar(50) NOT NULL,
  `contraseña` varchar(100) NOT NULL,
  `rol` enum('ALUMNO','PROFESOR') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`usuario`, `contraseña`, `rol`) VALUES
('atacante', '$argon2i$v=19$m=16,t=2,p=1$YUlOeXk2TThTRm1UYzRaYw$hRDBVm8cBu7Z7akV1G1LaQ', 'PROFESOR'),
('fernando.gomez', '$argon2i$v=19$m=16,t=2,p=1$RDFKZ2IxbzhqaTFueVV2OQ$BC3wZpoy5cde+IkBti3mgA', 'PROFESOR'),
('luis.f', '$argon2i$v=19$m=16,t=2,p=1$NE54U1lDVTFjUTFpU3FVcA$lYiiU0R5voN8tZ2DhAr42w', 'ALUMNO'),
('p.hernandez', '$argon2i$v=19$m=16,t=2,p=1$NE54U1lDVTFjUTFpU3FVcA$w/8hM5Emew1qH1DJvdHv/A', 'PROFESOR'),
('roberto.calderon', '$argon2i$v=19$m=16,t=2,p=1$NE54U1lDVTFjUTFpU3FVcA$UyZHThwER3Ag0aqPKvhzfw', 'ALUMNO'),
('s.cadenas', '$argon2i$v=19$m=16,t=2,p=1$NE54U1lDVTFjUTFpU3FVcA$jDg64QIlpaWEERg6MUt+Dg', 'ALUMNO');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumno`
--
ALTER TABLE `alumno`
  ADD PRIMARY KEY (`matricula`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `asignatura`
--
ALTER TABLE `asignatura`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cursa`
--
ALTER TABLE `cursa`
  ADD PRIMARY KEY (`alumno_id`,`asignatura_id`),
  ADD KEY `asignatura_id` (`asignatura_id`);

--
-- Indices de la tabla `imparte`
--
ALTER TABLE `imparte`
  ADD PRIMARY KEY (`profesor_id`,`asignatura_id`),
  ADD KEY `asignatura_id` (`asignatura_id`);

--
-- Indices de la tabla `profesor`
--
ALTER TABLE `profesor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alumno`
--
ALTER TABLE `alumno`
  MODIFY `matricula` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `asignatura`
--
ALTER TABLE `asignatura`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `profesor`
--
ALTER TABLE `profesor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alumno`
--
ALTER TABLE `alumno`
  ADD CONSTRAINT `alumno_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`usuario`);

--
-- Filtros para la tabla `cursa`
--
ALTER TABLE `cursa`
  ADD CONSTRAINT `cursa_ibfk_1` FOREIGN KEY (`alumno_id`) REFERENCES `alumno` (`matricula`),
  ADD CONSTRAINT `cursa_ibfk_2` FOREIGN KEY (`asignatura_id`) REFERENCES `asignatura` (`id`);

--
-- Filtros para la tabla `imparte`
--
ALTER TABLE `imparte`
  ADD CONSTRAINT `imparte_ibfk_1` FOREIGN KEY (`profesor_id`) REFERENCES `profesor` (`id`),
  ADD CONSTRAINT `imparte_ibfk_2` FOREIGN KEY (`asignatura_id`) REFERENCES `asignatura` (`id`);

--
-- Filtros para la tabla `profesor`
--
ALTER TABLE `profesor`
  ADD CONSTRAINT `profesor_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
