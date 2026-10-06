-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-07-2025 a las 15:40:55
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
-- Base de datos: `cineplus`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `boletos`
--

CREATE TABLE `boletos` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `pelicula_id` int(11) NOT NULL,
  `fecha_compra` timestamp NOT NULL DEFAULT current_timestamp(),
  `cantidad` int(11) DEFAULT 1,
  `asiento` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `peliculas`
--

CREATE TABLE `peliculas` (
  `id` int(11) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `genero` varchar(50) DEFAULT NULL,
  `duracion` int(11) DEFAULT NULL,
  `anio` int(11) DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `peliculas`
--

INSERT INTO `peliculas` (`id`, `titulo`, `descripcion`, `genero`, `duracion`, `anio`, `imagen`) VALUES
(1, 'Azotes de Barrio', 'Película de acción urbana con mucha adrenalina.', 'Acción', 110, 2022, 'imagenes/Pelicula1.jpg'),
(2, 'Papita, Maní, Tostón', 'Comedia venezolana sobre amistad y conflictos sociales.', 'Comedia', 95, 2013, 'imagenes/pelicula2.jpg'),
(3, 'El Padrino', 'Clásico del cine de mafia que narra la historia de una familia criminal.', 'Drama', 175, 1972, 'imagenes/Pelicula3.jpg'),
(4, 'Forrest Gump', 'Historia emotiva de la vida de Forrest y sus aventuras.', 'Drama', 142, 1994, 'imagenes/Pelicula4.jpg'),
(5, 'Inception', 'Thriller de ciencia ficción sobre sueños y realidades.', 'Ciencia ficción', 148, 2010, 'imagenes/Pelicula5.jpg'),
(6, 'Titanic', 'Drama romántico ambientado en el famoso barco que se hunde.', 'Romance', 195, 1997, 'imagenes/Pelicula6.jpg'),
(7, 'The Dark Knight', 'Película de superhéroes con Batman enfrentando al Joker.', 'Acción', 152, 2008, 'imagenes/Pelicula7.jpg'),
(8, 'La La Land', 'Musical moderno que explora el amor y los sueños en Los Ángeles.', 'Musical', 128, 2016, 'imagenes/Pelicula8.jpg'),
(9, 'Avengers: Endgame', 'Superhéroes en la batalla final contra Thanos.', 'Acción', 181, 2019, 'imagenes/Pelicula9.jpg'),
(10, 'Parasite', 'Thriller surcoreano ganador del Oscar sobre diferencias sociales.', 'Thriller', 132, 2019, 'imagenes/Pelicula10.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `clave` varchar(255) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `telefono` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellido`, `usuario`, `clave`, `fecha_nacimiento`, `telefono`) VALUES
(3, 'Edgar', 'Jimenez', 'ejimenez62', '$2y$10$MGrSGHxU.cR3WRrPWH.4yus0MBv7eVKl4ulmJY0Uy.za3ttJAgfvi', '2025-07-03', '1425477575'),
(4, 'Juan', 'Poronga', 'Juanporonga123', '$2y$10$iwIKKgJJ7grw64qkDbjNN.pTaqvI5hfoIJwQX9kDnIxY1JfA2IBRG', '2007-07-31', '4125789630'),
(5, 'Miguel', 'Love', 'mlovera', '$2y$10$YdSvtlC9hetKS7VKSyLmFeYFsOlvuddL00JoCtIqB.xk0VoF6v4Ce', '2025-04-30', '1245678954'),
(6, 'leshe', 'marchan', 'milka231', '$2y$10$5v0nV3tBTGJjlLfm3PcY6uUsYTMTTPARQ.Zp8hC7egQsprMR5ocky', '2025-07-16', '4125763052');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `boletos`
--
ALTER TABLE `boletos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`),
  ADD KEY `pelicula_id` (`pelicula_id`);

--
-- Indices de la tabla `peliculas`
--
ALTER TABLE `peliculas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuario` (`usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `boletos`
--
ALTER TABLE `boletos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `peliculas`
--
ALTER TABLE `peliculas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `boletos`
--
ALTER TABLE `boletos`
  ADD CONSTRAINT `boletos_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `boletos_ibfk_2` FOREIGN KEY (`pelicula_id`) REFERENCES `peliculas` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
