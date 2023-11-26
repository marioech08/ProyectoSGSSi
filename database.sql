-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: db
-- Tiempo de generación: 26-11-2023 a las 22:26:08
-- Versión del servidor: 11.2.2-MariaDB-1:11.2.2+maria~ubu2204
-- Versión de PHP: 8.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `database`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignaturas`
--

CREATE TABLE `asignaturas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` longtext NOT NULL,
  `creditos` int(11) NOT NULL,
  `convocatorias_usadas` int(11) NOT NULL,
  `año` int(11) NOT NULL,
  `dni` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `asignaturas`
--

INSERT INTO `asignaturas` (`id`, `nombre`, `descripcion`, `creditos`, `convocatorias_usadas`, `año`, `dni`) VALUES
(3, 'Algebra', 'Esta asignatura se centra en el estudio de los espacios vectoriales, transformaciones lineales, matrices y sistemas de ecuaciones lineales', 6, 3, 2022, '14322313Y'),
(4, 'Programación I ', ' En esta asignatura, los estudiantes aprenderán los conceptos fundamentales de la programación, incluyendo la lógica de programación, estructuras de datos y algoritmos. ', 6, 3, 2021, '14322313Y'),
(5, 'Cálculo', 'El cálculo integral se enfoca en el estudio de funciones y sus propiedades relacionadas con la acumulación de cantidades y áreas bajo curvas. Los estudiantes aprenderán a calcular integrales definidas e indefinidas y aplicarán estos conceptos en situaciones del mundo real.', 6, 0, 2020, '14322313Y'),
(6, 'Química', 'La Química se enfoca en el estudio de los compuestos orgánicos, incluyendo su estructura, propiedades y reacciones químicas. Los estudiantes aprenderán a identificar y sintetizar moléculas orgánicas, y comprenderán su relevancia en la química y la industria.', 6, 3, 2020, '14322313Y'),
(7, 'Fisica', 'La Física es la ciencia que estudia las leyes fundamentales del universo, desde la mecánica clásica hasta la física cuántica.', 6, 6, 2022, '14322313Y'),
(8, 'Estadistica', 'La Estadística se enfoca en la recopilación, análisis y presentación de datos. Los estudiantes aprenderán a utilizar herramientas estadísticas para resumir información, tomar decisiones basadas en datos y comprender la variabilidad en conjuntos de datos.', 6, 0, 2022, '14322313Y');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `nombre` varchar(100) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `dni` varchar(30) NOT NULL,
  `telefono` int(11) NOT NULL,
  `fechaNacimiento` date NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`nombre`, `apellidos`, `dni`, `telefono`, `fechaNacimiento`, `email`, `password`) VALUES
('Pablo', 'Martinez', '14322313Y', 123456789, '2023-11-12', 'admin@gmail.com', '$2y$10$Ty4OS6zaLiXOytIYEQo1OuYcnOuMtzjYIBqtb7jduOolHUnJ6rHRC');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `asignaturas`
--
ALTER TABLE `asignaturas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`dni`),
  ADD UNIQUE KEY `dni` (`dni`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `asignaturas`
--
ALTER TABLE `asignaturas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
