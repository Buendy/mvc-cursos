-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: mysql
-- Tiempo de generación: 09-01-2019 a las 14:35:57
-- Versión del servidor: 5.7.22
-- Versión de PHP: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `mvc-cursos`
--
CREATE DATABASE IF NOT EXISTS `mvc-cursos` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `mvc-cursos`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos`
--

CREATE TABLE `cursos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `cursos`
--

INSERT INTO `cursos` (`id`, `nombre`, `descripcion`) VALUES
(1, 'PHP', 'Curso de programación.'),
(2, 'JavaScript', 'Curso de programación de JS'),
(3, 'Lenguaje de Marcas', 'Curso donde se imparte HTML, XML y demás lenguajes de Marcas'),
(4, 'Bootstrap', 'Curso completo de diseño web con bootsrap');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `study`
--

CREATE TABLE `study` (
  `id_user` int(11) NOT NULL,
  `id_curso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `study`
--

INSERT INTO `study` (`id_user`, `id_curso`) VALUES
(1, 1),
(2, 1),
(4, 1),
(2, 2),
(1, 3),
(2, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(256) NOT NULL,
  `rol` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `nombre`, `apellidos`, `email`, `password`, `rol`) VALUES
(1, 'Daniel', 'Buendia Valverde', 'danielsmr@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'profesor'),
(2, 'Robertoh', 'Gomez', 'shurobertiko@gmail.com', 'b3ea255fb306b859f2571a265e8d03af', 'alumno'),
(3, 'Jose', 'Perez Lopez', 'josillo@gmail.com', 'b3ea255fb306b859f2571a265e8d03af', 'alumno'),
(4, 'Roque', 'Abrisqueta', 'robris@gmail.com', 'b3ea255fb306b859f2571a265e8d03af', 'alumno'),
(5, 'Tomas', 'Tomate', 'tomatito@gmail.com', 'b3ea255fb306b859f2571a265e8d03af', 'alumno'),
(6, 'Eugenio', 'Maldonado', 'maldoni@gmail.com', 'b3ea255fb306b859f2571a265e8d03af', 'alumno');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `study`
--
ALTER TABLE `study`
  ADD PRIMARY KEY (`id_user`,`id_curso`),
  ADD KEY `id_curso` (`id_curso`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cursos`
--
ALTER TABLE `cursos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `study`
--
ALTER TABLE `study`
  ADD CONSTRAINT `study_ibfk_1` FOREIGN KEY (`id_curso`) REFERENCES `cursos` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `study_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
