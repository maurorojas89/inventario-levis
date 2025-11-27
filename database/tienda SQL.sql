-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3307
-- Tiempo de generación: 27-11-2025 a las 17:41:25
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
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id_cliente` int(10) UNSIGNED NOT NULL,
  `nombreCliente` varchar(100) DEFAULT NULL,
  `apellidoCliente` varchar(100) DEFAULT NULL,
  `documentoCliente` varchar(20) DEFAULT NULL,
  `tipoDocumentoCliente` varchar(10) DEFAULT NULL,
  `telefonoCliente` varchar(20) DEFAULT NULL,
  `emailCliente` varchar(100) DEFAULT NULL,
  `direccionCliente` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id_cliente`, `nombreCliente`, `apellidoCliente`, `documentoCliente`, `tipoDocumentoCliente`, `telefonoCliente`, `emailCliente`, `direccionCliente`) VALUES
(1, 'Juanjo', 'Lopez', '10000001', 'CC', '3001110001', 'juan.lopez@tienda.com', 'Calle 1 #10-20'),
(2, 'Maria', 'Torres', '10000002', 'TI', '3001110002', 'maria.torres@tienda.com', 'Calle 2 #11-21'),
(3, 'Carlos', 'Ramirez', '10000003', 'CC', '3001110003', 'carlos.ramirez@tienda.com', 'Calle 3 #12-22'),
(4, 'Ana', 'Gomez', '10000004', 'TI', '3001110004', 'ana.gomez@tienda.com', 'Calle 4 #13-23'),
(5, 'Luis', 'Martinez', '10000005', 'CC', '3001110005', 'luis.martinez@tienda.com', 'Calle 5 #14-24'),
(6, 'Laura', 'Fernandez', '10000006', 'TI', '3001110006', 'laura.fernandez@tienda.com', 'Calle 6 #15-25'),
(7, 'Pedro', 'Garcia', '10000007', 'CC', '3001110007', 'pedro.garcia@tienda.com', 'Calle 7 #16-26'),
(8, 'Sofia', 'Vargas', '10000008', 'TI', '3001110008', 'sofia.vargas@tienda.com', 'Calle 8 #17-27'),
(9, 'Diego', 'Castro', '10000009', 'CC', '3001110009', 'diego.castro@tienda.com', 'Calle 9 #18-28'),
(10, 'Valentina', 'Rios', '10000010', 'TI', '3001110010', 'valentina.rios@tienda.com', 'Calle 10 #19-29'),
(11, 'Mateo', 'Herrera', '10000011', 'CC', '3001110011', 'mateo.herrera@tienda.com', 'Calle 11 #20-30'),
(12, 'Camila', 'Pena', '10000012', 'TI', '3001110012', 'camila.pena@tienda.com', 'Calle 12 #21-31'),
(13, 'Esteban', 'Salazar', '10000013', 'CC', '3001110013', 'esteban.salazar@tienda.com', 'Calle 13 #22-32'),
(14, 'Daniela', 'Cruz', '10000014', 'TI', '3001110014', 'daniela.cruz@tienda.com', 'Calle 14 #23-33'),
(15, 'Andres', 'Moreno', '10000015', 'CC', '3001110015', 'andres.moreno@tienda.com', 'Calle 15 #24-34'),
(16, 'Isabella', 'Suarez', '10000016', 'TI', '3001110016', 'isabella.suarez@tienda.com', 'Calle 16 #25-35'),
(17, 'Sebastian', 'Navarro', '10000017', 'CC', '3001110017', 'sebastian.navarro@tienda.com', 'Calle 17 #26-36'),
(18, 'Lucia', 'Ortega', '10000018', 'TI', '3001110018', 'lucia.ortega@tienda.com', 'Calle 18 #27-37'),
(19, 'Julian', 'Mendez', '10000019', 'CE', '3001110019', 'julian.mendez@tienda.com', 'Calle 19 #28-38'),
(20, 'Paula', 'Ruiz', '10000020', 'CE', '3001110020', 'paula.ruiz@tienda.com', 'Calle 20 #29-39'),
(21, 'Felipe', 'Cortes', '10000021', 'CE', '3001110021', 'felipe.cortes@tienda.com', 'Calle 21 #30-40'),
(22, 'Nicole', 'Reyes', '10000022', 'PA', '3001110022', 'nicole.reyes@tienda.com', 'Calle 22 #31-41'),
(23, 'Jorge', 'Delgado', '10000023', 'PA', '3001110023', 'jorge.delgado@tienda.com', 'Calle 23 #32-42'),
(24, 'Daniela', 'Campos', '10000024', 'PA', '3001110024', 'daniela.campos@tienda.com', 'Calle 24 #33-43'),
(25, 'Samuel', 'Lozano', '10000025', 'CC', '3001110025', 'samuel.lozano@tienda.com', 'Calle 25 #34-44');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra`
--

CREATE TABLE `compra` (
  `id_compra` int(10) UNSIGNED NOT NULL,
  `fecha` date DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `id_proveedor` int(10) UNSIGNED DEFAULT NULL,
  `fechaCompra` date DEFAULT NULL,
  `estadoCompra` varchar(20) DEFAULT NULL,
  `totalCompra` decimal(10,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalleventa`
--

CREATE TABLE `detalleventa` (
  `id_detalleVenta` int(10) UNSIGNED NOT NULL,
  `id_venta` int(10) UNSIGNED NOT NULL,
  `id_producto` int(10) UNSIGNED NOT NULL,
  `cantidadVendida` int(10) UNSIGNED NOT NULL,
  `precioUnitario` decimal(10,2) NOT NULL,
  `subtotal` decimal(10,2) GENERATED ALWAYS AS (`cantidadVendida` * `precioUnitario`) STORED
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_compra`
--

CREATE TABLE `detalle_compra` (
  `id_detalle` int(10) UNSIGNED NOT NULL,
  `id_compra` int(10) UNSIGNED NOT NULL,
  `id_producto` int(10) UNSIGNED NOT NULL,
  `cantidad` int(10) UNSIGNED NOT NULL,
  `costoUnitario` decimal(10,2) NOT NULL,
  `subtotal` decimal(10,2) GENERATED ALWAYS AS (`cantidad` * `costoUnitario`) STORED,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_compra_backup`
--

CREATE TABLE `detalle_compra_backup` (
  `id_detalle` int(10) UNSIGNED NOT NULL,
  `id_compra` int(10) UNSIGNED DEFAULT NULL,
  `id_producto` int(10) UNSIGNED DEFAULT NULL,
  `cantidad` int(10) UNSIGNED DEFAULT NULL,
  `subtotal` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_venta`
--

CREATE TABLE `detalle_venta` (
  `id_detalle` int(10) UNSIGNED NOT NULL,
  `id_venta` int(10) UNSIGNED NOT NULL,
  `id_producto` int(10) UNSIGNED NOT NULL,
  `cantidad` int(10) UNSIGNED NOT NULL,
  `precioUnitario` decimal(10,2) NOT NULL,
  `subtotal` decimal(10,2) GENERATED ALWAYS AS (`cantidad` * `precioUnitario`) STORED,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalle_venta`
--

INSERT INTO `detalle_venta` (`id_detalle`, `id_venta`, `id_producto`, `cantidad`, `precioUnitario`, `created_at`, `updated_at`) VALUES
(1, 9, 39, 2, 22000.00, '2025-11-27 21:28:04', '2025-11-27 21:28:04'),
(2, 10, 31, 2, 85000.00, '2025-11-27 21:29:19', '2025-11-27 21:29:19'),
(3, 10, 38, 4, 75000.00, '2025-11-27 21:29:19', '2025-11-27 21:29:19');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `herramienta`
--

CREATE TABLE `herramienta` (
  `id_herramienta` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `cantidad` int(10) UNSIGNED DEFAULT NULL,
  `fecha_ingreso` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE `pedido` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_cliente` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `id_proveedor` int(10) UNSIGNED NOT NULL,
  `nombreProveedor` varchar(100) DEFAULT NULL,
  `empresa` varchar(100) DEFAULT NULL,
  `rolProveedor` varchar(50) DEFAULT NULL,
  `telefonoProveedor` varchar(20) DEFAULT NULL,
  `correoProveedor` varchar(100) DEFAULT NULL,
  `direccion` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`id_proveedor`, `nombreProveedor`, `empresa`, `rolProveedor`, `telefonoProveedor`, `correoProveedor`, `direccion`, `created_at`, `updated_at`) VALUES
(1, 'Carlos Ramirez', 'Levi\'s', 'Prendas de cabeza', '3101112233', 'carlos.ramirez@levis.com', 'Calle 10 #5-20', '2025-11-24 15:56:57', '2025-11-24 15:56:57'),
(2, 'Ana Torres', 'Levi\'s', 'Camisetas', '3102223344', 'ana.torres@levis.com', 'Carrera 15 #8-30', '2025-11-24 15:56:57', '2025-11-24 15:56:57'),
(3, 'Luis Mendoza', 'Levi\'s', 'Camisas', '3103334455', 'luis.mendoza@levis.com', 'Av. Siempre Viva #123', '2025-11-24 15:56:57', '2025-11-24 15:56:57'),
(4, 'Marta Salazar', 'Levi\'s', 'Pantalones', '3104445566', 'marta.salazar@levis.com', 'Diagonal 45 #20-10', '2025-11-24 15:56:57', '2025-11-24 15:56:57'),
(5, 'Pedro Rios', 'Levi\'s', 'Zapatos', '3105556677', 'pedro.rios@levis.com', 'Transversal 9 #3-50', '2025-11-24 15:56:57', '2025-11-24 15:56:57'),
(6, 'Sofia Duarte', 'Levi\'s', 'Interiores', '3106667788', 'sofia.duarte@levis.com', 'Calle 60 #12-45', '2025-11-24 15:56:57', '2025-11-24 15:56:57'),
(7, 'Diego Vargas', 'Levi\'s', 'Chaquetas', '3107778899', 'diego.vargas@levis.com', 'Carrera 7 #14-22', '2025-11-24 15:56:57', '2025-11-24 15:56:57'),
(8, 'Laura Perez', 'Levi\'s', 'Accesorios', '3108889900', 'laura.pena@levis.com', 'Av. Central #100', '2025-11-24 15:56:57', '2025-11-24 21:54:43'),
(9, 'Mateo Herrera', 'Levi\'s', 'Ropa infantil', '3109990011', 'mateo.herrera@levis.com', 'Calle 25 #9-60', '2025-11-24 15:56:57', '2025-11-24 15:56:57'),
(10, 'Valentina Cruz', 'Levi\'s', 'Ropa deportiva', '3110001122', 'valentina.cruz@levis.com', 'Carrera 30 #18-80', '2025-11-24 15:56:57', '2025-11-24 15:56:57');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reporte`
--

CREATE TABLE `reporte` (
  `id_reporte` int(10) UNSIGNED NOT NULL,
  `tipo` varchar(50) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `fecha` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` text NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('gf6fkv0gSaWpheuIPIRPaUHk9QP5x6N1xw58Y9dj', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZlpZazRnRjRIVEhET201QnNRaDNYSzM2WFgxT040RWZrVTFvaGVpZyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC92ZW50YXMiO3M6NToicm91dGUiO3M6MTI6InZlbnRhcy5pbmRleCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1764260959);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE `venta` (
  `id_venta` int(10) UNSIGNED NOT NULL,
  `fecha` date DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `id_cliente` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `venta`
--

INSERT INTO `venta` (`id_venta`, `fecha`, `total`, `id_cliente`) VALUES
(1, '2025-11-24', 0.00, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id_venta` int(10) UNSIGNED NOT NULL,
  `id_cliente` int(10) UNSIGNED NOT NULL,
  `fechaVenta` date NOT NULL,
  `estadoVenta` varchar(20) DEFAULT 'completada',
  `totalVenta` decimal(10,2) DEFAULT 0.00,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id_venta`, `id_cliente`, `fechaVenta`, `estadoVenta`, `totalVenta`, `created_at`, `updated_at`) VALUES
(8, 24, '2025-11-27', 'Completada', 78000.00, '2025-11-27 21:24:08', '2025-11-27 21:24:08'),
(9, 24, '2025-11-27', 'Completada', 44000.00, '2025-11-27 21:28:04', '2025-11-27 21:28:04'),
(10, 15, '2025-11-27', 'Completada', 470000.00, '2025-11-27 21:29:19', '2025-11-27 21:29:19');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indices de la tabla `compra`
--
ALTER TABLE `compra`
  ADD PRIMARY KEY (`id_compra`),
  ADD KEY `id_proveedor` (`id_proveedor`);

--
-- Indices de la tabla `detalleventa`
--
ALTER TABLE `detalleventa`
  ADD PRIMARY KEY (`id_detalleVenta`),
  ADD KEY `id_venta` (`id_venta`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `detalle_compra`
--
ALTER TABLE `detalle_compra`
  ADD PRIMARY KEY (`id_detalle`),
  ADD KEY `id_compra` (`id_compra`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `detalle_compra_backup`
--
ALTER TABLE `detalle_compra_backup`
  ADD PRIMARY KEY (`id_detalle`),
  ADD KEY `id_compra` (`id_compra`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD PRIMARY KEY (`id_detalle`),
  ADD KEY `id_venta` (`id_venta`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `herramienta`
--
ALTER TABLE `herramienta`
  ADD PRIMARY KEY (`id_herramienta`);

--
-- Indices de la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `id_proveedor` (`id_proveedor`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`id_proveedor`);

--
-- Indices de la tabla `reporte`
--
ALTER TABLE `reporte`
  ADD PRIMARY KEY (`id_reporte`);

--
-- Indices de la tabla `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `venta`
--
ALTER TABLE `venta`
  ADD PRIMARY KEY (`id_venta`),
  ADD KEY `id_cliente` (`id_cliente`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id_venta`),
  ADD KEY `id_cliente` (`id_cliente`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id_cliente` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `compra`
--
ALTER TABLE `compra`
  MODIFY `id_compra` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalleventa`
--
ALTER TABLE `detalleventa`
  MODIFY `id_detalleVenta` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `detalle_compra`
--
ALTER TABLE `detalle_compra`
  MODIFY `id_detalle` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalle_compra_backup`
--
ALTER TABLE `detalle_compra_backup`
  MODIFY `id_detalle` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  MODIFY `id_detalle` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `herramienta`
--
ALTER TABLE `herramienta`
  MODIFY `id_herramienta` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pedido`
--
ALTER TABLE `pedido`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `id_proveedor` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `reporte`
--
ALTER TABLE `reporte`
  MODIFY `id_reporte` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `venta`
--
ALTER TABLE `venta`
  MODIFY `id_venta` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id_venta` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `compra`
--
ALTER TABLE `compra`
  ADD CONSTRAINT `compra_ibfk_1` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedor` (`id_proveedor`);

--
-- Filtros para la tabla `detalleventa`
--
ALTER TABLE `detalleventa`
  ADD CONSTRAINT `detalleventa_ibfk_1` FOREIGN KEY (`id_venta`) REFERENCES `venta` (`id_venta`),
  ADD CONSTRAINT `detalleventa_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`);

--
-- Filtros para la tabla `detalle_compra`
--
ALTER TABLE `detalle_compra`
  ADD CONSTRAINT `detalle_compra_ibfk_1` FOREIGN KEY (`id_compra`) REFERENCES `compra` (`id_compra`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detalle_compra_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalle_compra_backup`
--
ALTER TABLE `detalle_compra_backup`
  ADD CONSTRAINT `detalle_compra_backup_ibfk_1` FOREIGN KEY (`id_compra`) REFERENCES `compra` (`id_compra`),
  ADD CONSTRAINT `detalle_compra_backup_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`);

--
-- Filtros para la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD CONSTRAINT `detalle_venta_ibfk_1` FOREIGN KEY (`id_venta`) REFERENCES `ventas` (`id_venta`),
  ADD CONSTRAINT `detalle_venta_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`);

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedor` (`id_proveedor`);

--
-- Filtros para la tabla `venta`
--
ALTER TABLE `venta`
  ADD CONSTRAINT `venta_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_cliente`);

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `ventas_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_cliente`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
