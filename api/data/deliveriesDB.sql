-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-07-2022 a las 09:49:24
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `deliveries`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orders`
--

CREATE TABLE `orders` (
  `id_order` int(11) NOT NULL,
  `id_user_order` int(11) NOT NULL DEFAULT 0,
  `id_product_order` int(11) NOT NULL DEFAULT 0,
  `order_date_order` date DEFAULT NULL,
  `paking_time_order` int(11) DEFAULT 0,
  `transportation_time_order` int(11) NOT NULL DEFAULT 0,
  `delivery_time_order` int(11) NOT NULL DEFAULT 0,
  `active_order` bit(1) NOT NULL DEFAULT b'0',
  `date_create_order` datetime NOT NULL,
  `date_update_order` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `orders`
--

INSERT INTO `orders` (`id_order`, `id_user_order`, `id_product_order`, `order_date_order`, `paking_time_order`, `transportation_time_order`, `delivery_time_order`, `active_order`, `date_create_order`, `date_update_order`) VALUES
(1, 1, 1, '2022-07-06', 1, 2, 3, b'0', '2022-05-06 16:02:01', '2022-07-07 23:51:58'),
(2, 1, 2, '2022-07-06', 1, 2, 3, b'0', '2022-06-06 16:02:01', '2022-07-07 23:52:06'),
(3, 2, 1, '2022-07-06', 2, 4, 6, b'0', '2022-06-06 16:02:52', '2022-07-07 23:52:19'),
(4, 2, 2, '2022-07-06', 1, 3, 5, b'0', '2022-07-06 16:02:52', '2022-07-06 16:03:26'),
(5, 3, 3, '2022-06-05', 1, 2, 3, b'0', '2022-07-06 00:55:13', '2022-07-08 00:55:42');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products`
--

CREATE TABLE `products` (
  `id_product` int(11) NOT NULL,
  `id_user_product` int(11) NOT NULL DEFAULT 0,
  `name_product` text NOT NULL,
  `description_product` text NOT NULL,
  `image_product` text DEFAULT NULL,
  `amount_product` int(11) NOT NULL DEFAULT 0,
  `price_product` float DEFAULT 0,
  `active_product` bit(1) DEFAULT b'0',
  `date_create_product` datetime DEFAULT NULL,
  `date_update_product` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `products`
--

INSERT INTO `products` (`id_product`, `id_user_product`, `name_product`, `description_product`, `image_product`, `amount_product`, `price_product`, `active_product`, `date_create_product`, `date_update_product`) VALUES
(1, 1, 'gamepadAltra', 'gamepad', NULL, 100, 1500, b'1', '2022-07-06 15:56:04', '2022-07-12 02:46:20'),
(2, 3, 'teclado', 'teclado', NULL, 100, 25, b'0', '2022-07-05 15:56:04', '2022-07-06 16:00:33'),
(3, 2, 'raton', 'raton', NULL, 12, 15, b'1', '2022-07-05 20:41:07', '2022-07-10 23:12:04'),
(4, 3, 'laptop', 'laptop', NULL, 100, 1500, b'0', '2022-07-06 15:56:04', '2022-07-07 23:05:09'),
(5, 2, 'teclado', 'teclado', NULL, 100, 25, b'1', '2022-07-05 15:56:04', '2022-07-10 23:12:10'),
(6, 1, 'raton', 'raton', NULL, 12, 15, b'0', '2022-07-05 20:41:07', '2022-07-07 22:24:08');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `frist_name_user` text NOT NULL,
  `last_name_user` text NOT NULL,
  `avatar_user` text DEFAULT NULL,
  `email_user` text NOT NULL,
  `nick_user` text NOT NULL,
  `password_user` text NOT NULL,
  `activation_code_user` bit(11) DEFAULT b'0',
  `active_user` bit(1) DEFAULT b'0',
  `logged_in_user` bit(1) DEFAULT b'0',
  `token_user` text DEFAULT NULL,
  `token_exp_user` datetime DEFAULT NULL,
  `date_create_user` datetime DEFAULT NULL,
  `date_update_user` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id_user`, `frist_name_user`, `last_name_user`, `avatar_user`, `email_user`, `nick_user`, `password_user`, `activation_code_user`, `active_user`, `logged_in_user`, `token_user`, `token_exp_user`, `date_create_user`, `date_update_user`) VALUES
(1, 'dc', 'dev', NULL, '', 'dcdev', '123456789', b'00001111011', NULL, NULL, NULL, NULL, '2022-07-05 15:54:32', '2022-07-06 15:55:56'),
(2, 'luc', 'umy', NULL, 'lucumy@gmail.com', 'lucumy', '123456789', b'00010010011', NULL, NULL, NULL, NULL, '2022-07-05 15:54:32', '2022-07-06 15:55:56'),
(3, 'ad', 'min', NULL, 'admin@gmial.com', 'sdmin', '123456', b'00001111001', NULL, NULL, NULL, NULL, '2022-07-06 15:58:49', '2022-07-06 15:59:31');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id_order`);

--
-- Indices de la tabla `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id_product`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `orders`
--
ALTER TABLE `orders`
  MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `products`
--
ALTER TABLE `products`
  MODIFY `id_product` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
