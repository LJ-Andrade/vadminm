-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-06-2017 a las 22:28:11
-- Versión del servidor: 10.1.19-MariaDB
-- Versión de PHP: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `vadminmprod`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `razonsocial` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cuit` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ingbrutos` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefonos` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `direccion` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pais` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `codpostal` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notas` text COLLATE utf8mb4_unicode_ci,
  `iva_id` int(10) UNSIGNED DEFAULT NULL,
  `localidad_id` int(10) UNSIGNED DEFAULT NULL,
  `provincia_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`id`, `nombre`, `razonsocial`, `cuit`, `ingbrutos`, `telefonos`, `email`, `direccion`, `pais`, `codpostal`, `notas`, `iva_id`, `localidad_id`, `provincia_id`, `created_at`, `updated_at`) VALUES
(1, 'LOCIA Y COMPAÑIA S.A.', 'LOCIA Y COMPAÑIA S.A.', '33-60792934-9', '901-927635-5', '4671-6711/1892', 'locia@lociasa.com.ar', 'Laguna 1219', 'Argentina', '1417', NULL, 2, 336, 3, '2017-05-22 14:37:59', '2017-05-22 14:37:59'),
(2, 'AUTOSAL S.A.', 'AUTOSAL S.A.', '30-60655239-0', '919-700051-7', '4730-0011', 'repuestos@autosal.com.ar', 'Echeverría 930', 'Argentina', 'B1604ABB', '<p>Entrega de repuestos en SALCEDO 1142- Lomas del Mirador</p><p>Vendedor Adolfo Lopez</p>', 2, 207, 2, '2017-05-22 14:44:21', '2017-05-22 14:44:21'),
(3, 'ANTARCO S.R.L.', 'ANTARCO S.R.L.', '30-51748841-7', '902-865364-1', '4205-1568', 'antarco@antarco.com', 'Brandsen 1663', 'Argentina', 'B1873ARG', NULL, 2, 512, 2, '2017-05-22 14:49:25', '2017-05-22 14:49:25'),
(4, 'ANSAL REFRIGERACIÓN S.A.', 'ANSAL REFRIGERACIÓN S.A.', '30-51671259-3', '901-925853-2', '4958-2884/2866', 'ansal@ansal.com.ar', 'Otamendi 530/34', 'Argentina', 'C1405BRH', '<p>Alba Aparicio (venta repuestos) int. 31 alba.aparicio@ansal.com.ar</p><p>Martin Medina (cuentas corrientes) int. 41 martin.medina@ansal.com.ar</p>', 2, 1546, 3, '2017-05-22 14:57:15', '2017-05-22 14:57:15'),
(5, 'WHIRLPOOL', 'WHIRLPOOL ARGENTINA S.R.L.', '30-63634477-6', '902-947490-1', '4480-7132/7405', 'guillermo_russell@whirlpool.com', 'Av. Crovara 2550', 'Argentina', '1766', '<p>Vendedor Guillermo Russell cel. 15-3691-9415</p><p>N° cuenta 359666</p><p><br></p>', 2, 201, 2, '2017-05-22 17:15:49', '2017-05-22 17:15:49'),
(6, 'ZUL', 'VERZERO GONZALO', '23-26836796-9', '1509965-02', '4682-8856/0744', NULL, 'Av. Directorio 5446', 'Argentina', '1440', NULL, 2, 298, 3, '2017-05-22 17:19:45', '2017-05-22 17:19:45'),
(7, 'CIRCUITOS FRIOS S.A.', 'CIRCUITOS FRIOS S.A.', '30-71329070-6', '902-476656-0', '4669-6126', 'circuitosfriossa@yahoo.com.ar', 'Juan Sebastián Bach 3575', 'Argentina', '1765', NULL, 2, 194, 2, '2017-05-22 19:49:14', '2017-05-22 19:49:14'),
(8, 'DPMG', 'DPMG S.A.', '33-71126211-9', '901-33-71126211-9', '4139-6500/6501/4552/4551', 'ventas@dpmg.com.ar', 'Río Cuarto 2091', 'Argentina', 'C1292AAO', '<p>Vendedor Claudio Alvarez&nbsp;</p><p>Cuentas Corrientes Diego &nbsp;15-3644-2916&nbsp;<a href="mailto:diego.dellamonica@dpmg.com.ar" id="yui_3_16_0_ym19_1_1495465117863_31929" style="background: rgb(255, 255, 255); -webkit-padding-start: 0px; margin: 0px; padding: 0px; outline: none; font-family: &quot;Helvetica Neue&quot;, &quot;Segoe UI&quot;, Helvetica, Arial, &quot;Lucida Grande&quot;, sans-serif; font-size: 13px; white-space: nowrap;">diego.dellamonica@dpmg.com.ar</a></p>', 2, 1546, 3, '2017-05-22 19:55:18', '2017-05-22 19:55:18'),
(9, 'REPUESTOS ROMA', 'FERNANDEZ ROBERTO MATÍAS', '23-34772686-9', '901-23-34772686-9', '5273-4354/55', 'robertofernandez@fyfcomex.com.ar', 'Perú 359 2° piso of. 203', 'Argentina', '1067', NULL, 2, 1546, 3, '2017-05-22 20:01:46', '2017-05-22 20:01:46'),
(10, 'GRACAR S.A.', 'GRACAR S.A.', '30-67763586-6', '912162-05', '4637-1854', 'gracar@speedy@.com.ar', 'Quirno 463/7', 'Argentina', '1406', NULL, 2, 294, 3, '2017-05-22 20:05:49', '2017-05-22 20:05:49'),
(11, 'GIACOMINO S.A.', 'GIACOMINO S.A.', '30-50287893-6', '901-30-50287893-6', '4911-2276/2828/1093', 'info@giacomino.com.ar', 'Pepirí 1072', 'Argentina', '1437', NULL, 2, 1546, 3, '2017-05-22 20:16:04', '2017-05-22 20:16:04'),
(12, 'REPUESTOS SALTA LAMBARE', 'SAMPIETRO JORGE LUIS', '20-13264499-4', '901-930933-6', '4305-7591', 'j_l_sampietro@speedy.com.ar', 'Salta 1773', 'Argentina', '1137', NULL, 2, 1546, 3, '2017-05-22 20:30:25', '2017-05-22 20:30:25'),
(13, 'MCT', 'INDUSTRIAS MCT S.R.L.', '30-70835483-6', '901-390304-3', '4687-9220', 'mctsrl@speedy.com.ar', 'José León Suarez 2785', 'Argentina', 'C1440EYY', NULL, 2, 1546, 3, '2017-05-22 20:32:51', '2017-05-22 20:32:51'),
(32, 'PANIZZA', 'DIEGO ADRIAN PANIZZA', '20-20255144-2', '901-20-20251442-2', '4139-6500', NULL, 'Rio Cuarto 2091', 'Argentina', 'C1292AAO', NULL, 2, 1546, 3, '2017-06-08 15:31:28', '2017-06-08 15:31:28'),
(33, 'FRÍO ÁRTICO', 'FRÍO ÁRTICO S.R.L.', '30-70974079-9', '901-222163-7', '4753-4373/4713-7802', 'administración@frioartico.com.ar', 'Honduras 3865 1°C', 'Argentina', '1180', 'Vendedor Santiago', 2, 1546, 3, '2017-06-08 15:50:03', '2017-06-08 15:50:03'),
(34, 'M M', 'M M REFRIGERACIÓN S.R.L.', '30-71070438-0', '30710704380', '4713-7802', 'ventas@mmrefrigeracion.com', 'Lincoln 1827', 'Argentina', '1650', 'Vendedor Santiago', 2, NULL, 2, '2017-06-08 16:03:29', '2017-06-08 16:03:29'),
(35, 'REFRIGERACIÓN OMAR S.R.L.', 'REFRIGERACIÓN OMAR S.R.L.', '30-53691426-5', '901-910493-8', '4641-1454/5321', 'refomar@refomar.com.ar', 'Av. Rivadavia 10501', 'Argentina', 'C1408AAF', '<p>4642-6359</p><p>4644-2140</p><p>4643-0615</p>', 2, 1546, 3, '2017-06-08 16:17:58', '2017-06-08 16:17:58');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `proveedores_iva_id_foreign` (`iva_id`),
  ADD KEY `proveedores_localidad_id_foreign` (`localidad_id`),
  ADD KEY `proveedores_provincia_id_foreign` (`provincia_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD CONSTRAINT `proveedores_iva_id_foreign` FOREIGN KEY (`iva_id`) REFERENCES `ivas` (`id`),
  ADD CONSTRAINT `proveedores_localidad_id_foreign` FOREIGN KEY (`localidad_id`) REFERENCES `localidades` (`id`),
  ADD CONSTRAINT `proveedores_provincia_id_foreign` FOREIGN KEY (`provincia_id`) REFERENCES `provincias` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
