-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3307
-- Tiempo de generación: 25-11-2025 a las 21:26:05
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
-- Base de datos: `tienda`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id_producto` int(10) UNSIGNED NOT NULL,
  `nombreProducto` varchar(100) DEFAULT NULL,
  `descripcionProducto` text DEFAULT NULL,
  `precioProducto` decimal(10,2) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `talla` varchar(10) DEFAULT NULL,
  `color` varchar(50) DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `stockProducto` int(10) UNSIGNED DEFAULT NULL,
  `estadoProducto` varchar(20) DEFAULT NULL,
  `id_proveedor` int(10) UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_producto`, `nombreProducto`, `descripcionProducto`, `precioProducto`, `descripcion`, `talla`, `color`, `precio`, `stockProducto`, `estadoProducto`, `id_proveedor`, `created_at`, `updated_at`) VALUES
(30, 'Camiseta blanca', 'Camiseta basica Levis', 35000.00, NULL, NULL, NULL, NULL, 100, 'Activo', NULL, '2025-11-24 10:32:34', '2025-11-24 10:32:34'),
(31, 'Jeans clasicos', 'Pantalon azul Levis', 85000.00, NULL, NULL, NULL, NULL, 40, 'Activo', NULL, '2025-11-24 10:32:34', '2025-11-24 10:32:34'),
(32, 'Chaqueta mezclilla', 'Chaqueta ligera Levis', 120000.00, NULL, NULL, NULL, NULL, 25, 'Activo', NULL, '2025-11-24 10:32:34', '2025-11-24 10:32:34'),
(33, 'Boxer hombre', 'Ropa interior Levis', 28000.00, NULL, NULL, NULL, NULL, 80, 'Activo', NULL, '2025-11-24 10:32:34', '2025-11-24 10:32:34'),
(34, 'Cinturon cuero', 'Accesorio urbano Levis', 45000.00, NULL, NULL, NULL, NULL, 60, 'Activo', NULL, '2025-11-24 10:32:34', '2025-11-24 10:32:34'),
(35, 'Zapatos bota', 'Zapatos casuales Levis', 150000.00, NULL, NULL, NULL, NULL, 30, 'Activo', NULL, '2025-11-24 10:32:34', '2025-11-24 10:32:34'),
(36, 'Camisa manga larga', 'Camisa azul sin estampado', 65000.00, NULL, NULL, NULL, NULL, 45, 'Activo', NULL, '2025-11-24 10:32:34', '2025-11-24 10:32:34'),
(37, 'Conjunto nino', 'Prenda infantil Levis', 90000.00, NULL, NULL, NULL, NULL, 20, 'Activo', NULL, '2025-11-24 10:32:34', '2025-11-24 10:32:34'),
(38, 'Sudadera gris', 'Sudadera deportiva Levis', 75000.00, NULL, NULL, NULL, NULL, 35, 'Activo', NULL, '2025-11-24 10:32:34', '2025-11-24 10:32:34'),
(39, 'Gorra roja', 'Gorra clasica Levis', 22000.00, NULL, NULL, NULL, NULL, 70, 'Activo', NULL, '2025-11-24 10:32:34', '2025-11-24 10:32:34'),
(40, 'Camibuso negro', 'Camibuso basico Levis', 48000.00, NULL, NULL, NULL, NULL, 55, 'Activo', NULL, '2025-11-24 10:32:34', '2025-11-24 10:32:34'),
(41, 'Jean roto', 'Jean con estilo rasgado', 95000.00, NULL, NULL, NULL, NULL, 38, 'Activo', NULL, '2025-11-24 10:32:34', '2025-11-24 10:32:34'),
(42, 'Chaqueta impermeable', 'Chaqueta para lluvia Levis', 135000.00, NULL, NULL, NULL, NULL, 22, 'Activo', NULL, '2025-11-24 10:32:34', '2025-11-24 10:32:34'),
(43, 'Pantalon beige', 'Pantalon casual Levis', 78000.00, NULL, NULL, NULL, NULL, 60, 'Activo', NULL, '2025-11-24 10:32:34', '2025-11-24 10:32:34'),
(44, 'Gorro basico', 'Gorro negro de lana', 25000.00, NULL, NULL, NULL, NULL, 51, 'activo', NULL, '2025-11-24 10:41:18', '2025-11-24 10:41:18');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `id_proveedor` (`id_proveedor`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedor` (`id_proveedor`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
