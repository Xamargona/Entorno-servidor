-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-10-2022 a las 19:00:50
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tiendamercha`
--
CREATE DATABASE IF NOT EXISTS `tiendamercha` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `tiendamercha`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

DROP TABLE IF EXISTS `productos`;
CREATE TABLE `productos` (
  `codigo` int(6) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `categoria` varchar(50) NOT NULL,
  `precio` float NOT NULL,
  `stock` int(4) NOT NULL,
  `imagen` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`codigo`, `nombre`, `categoria`, `precio`, `stock`, `imagen`) VALUES
(1, 'Anillo único', 'El señor de los anillos', 22.95, 12, 'productos/anillounico.png'),
(2, 'Felpudo Kame House', 'Dragon Ball', 19.99, 20, 'productos/felpudokamehouse.png'),
(3, 'Goku', 'Dragon Ball', 34.99, 9, 'productos/gokunamek.png'),
(4, 'Abrecartas Espada de Griffindor', 'Harry Potter', 21.49, 16, 'productos/espadagriffindor.png'),
(5, 'Monedero Gama Chan', 'Naruto', 13.95, 7, 'productos/monederonaruto.png'),
(6, 'Taza Portal', 'Rick y Morty', 9.99, 11, 'productos/tazaportalrym.png'),
(7, 'The child (Grogu) 42cm', 'Mandalorian', 395.99, 2, 'productos/grogu.png'),
(8, 'Camiseta Hellfire club', 'Stranger Things', 18.99, 34, 'productos/hellfireclub.png'),
(9, 'Trono de hierro', 'Game of Thrones', 52.95, 6, 'productos/tronohierro.png');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`codigo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `codigo` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

-- user: Lumos
-- pass: Nox
GRANT USAGE ON *.* TO `Lumos`@`%` IDENTIFIED BY PASSWORD '*A00FCC7FBBA4B7831882206AC58614DD0A66447E';
GRANT ALL PRIVILEGES ON `tiendamercha`.* TO `Lumos`@`%` WITH GRANT OPTION;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
