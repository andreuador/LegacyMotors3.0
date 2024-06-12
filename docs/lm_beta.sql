-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: mysql-server
-- Tiempo de generación: 03-06-2024 a las 17:53:24
-- Versión del servidor: 10.11.7-MariaDB-1:10.11.7+maria~ubu2204
-- Versión de PHP: 8.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `lm_beta`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `brand`
--

CREATE TABLE `brand` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `brand`
--

INSERT INTO `brand` (`id`, `name`) VALUES
(1, 'Talbot'),
(2, 'Peugeot'),
(3, 'Dagger'),
(4, 'Morris'),
(5, 'Asia'),
(6, 'GMC'),
(7, 'Saab'),
(8, 'Studebaker'),
(9, 'Bugatti'),
(10, 'De Lorean'),
(11, 'Luxgen'),
(12, 'Mitsubishi'),
(13, 'Volvo'),
(14, 'Bristol'),
(15, 'Shuanghuan'),
(16, 'Chevrolet'),
(17, 'Gonow'),
(18, 'Zimmer'),
(19, 'Norster'),
(20, 'Aston Martin'),
(21, 'Zotye'),
(22, 'Rolls-Royce'),
(23, 'Proton'),
(24, 'Detroit Electric'),
(25, 'Xiaolong'),
(26, 'Wuling'),
(27, 'Pontiac'),
(28, 'Shelby'),
(29, 'Jeep'),
(30, 'Daewoo'),
(31, 'Barkas (Баркас)'),
(32, 'Yugo'),
(33, 'Morgan'),
(34, 'MINI'),
(35, 'Audi'),
(36, 'Rolls-Royce'),
(37, 'Saab'),
(38, 'Huabei'),
(39, 'Bentley'),
(40, 'Alpine');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `lastname` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `dni` varchar(20) NOT NULL,
  `login_id` int(11) NOT NULL,
  `is_deleted` tinyint(1) DEFAULT NULL,
  `payment_details_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `customer`
--

INSERT INTO `customer` (`id`, `name`, `lastname`, `email`, `phone`, `address`, `dni`, `login_id`, `is_deleted`, `payment_details_id`) VALUES
(1, 'Lic. Dario Abeyta Tercero', 'Jaramillo', 'africa.zaragoza@madera.es', '989 060063', 'Travesía Reina, 32, 95º C, 44487, Gastélum Alta', '1KMWDM9HI', 1, 0, NULL),
(2, 'Sra. Verónica Carretero Segundo', 'Cárdenas', 'padron.ian@hotmail.es', '+34 997-387399', 'Avinguda Loera, 2, 08º B, 67929, Roque de las Torres', 'GI7IY6XTI', 2, 0, NULL),
(3, 'Sr. Francisco Javier Vigil', 'Vallejo', 'ccastellanos@hispavista.com', '979326511', 'Travesía Nicolás, 51, Entre suelo 0º, 77992, Castellano de Ulla', 'QNECG9AV9', 3, 0, NULL),
(4, 'Patricia Montero', 'Rangel', 'juan.polo@yahoo.es', '+34 903 201204', 'Plaza Berríos, 240, 2º E, 88829, Los Colón', '283YZFPRO', 4, 0, NULL),
(5, 'Iker Toledo', 'Meléndez', 'jimenez.adriana@live.com', '+34 990-47-9421', 'Passeig Guajardo, 2, 1º D, 65663, Quintanilla de San Pedro', '5WMV7MCJ3', 5, 0, NULL),
(6, 'Álvaro Armas Hijo', 'Guevara', 'carolina26@hotmail.com', '+34 997-75-6599', 'Travesía Duran, 69, 52º E, 33990, Os López', 'E3TN0RA9O', 6, 0, NULL),
(7, 'Eduardo Lázaro', 'Bernal', 'cristian96@hispavista.com', '949655305', 'Passeig Martín, 85, 7º F, 03650, Olivas del Penedès', 'EBJGJDUPX', 7, 0, NULL),
(8, 'Lucía Frías Tercero', 'Deleón', 'antonia.godinez@lozada.org', '+34 914-01-2438', 'Plaza Ian, 3, 11º F, 61973, L\' Hernándes', 'K528W9LYZ', 8, 0, NULL),
(9, 'Alejandra Casanova Hijo', 'Briseño', 'corrales.alejandro@galarza.net', '+34 981302620', 'Avinguda Valles, 44, 88º E, 08078, Las Barrera', '4K2JP056W', 9, 0, NULL),
(10, 'Naia Contreras', 'Sola', 'josefa94@olivarez.org', '+34 924-919875', 'Avinguda Emilia, 7, 00º 7º, 40552, El Delao Medio', 'TBZCZUIT0', 10, 0, NULL),
(11, 'private', 'private', 'esther.altamirano@yahoo.com', '940 739057', 'Avenida Inmaculada, 149, 11º C, 69505, As Lugo', '2Y9LLOM36', 11, 0, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Volcado de datos para la tabla `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20240524180100', '2024-06-03 15:43:28', 64),
('DoctrineMigrations\\Version20240524180619', '2024-06-03 15:43:29', 38),
('DoctrineMigrations\\Version20240524181027', '2024-06-03 15:43:29', 39),
('DoctrineMigrations\\Version20240524181402', '2024-06-03 15:43:29', 14),
('DoctrineMigrations\\Version20240524181652', '2024-06-03 15:43:29', 28),
('DoctrineMigrations\\Version20240524181933', '2024-06-03 15:43:29', 149),
('DoctrineMigrations\\Version20240524182212', '2024-06-03 15:43:29', 151),
('DoctrineMigrations\\Version20240524182352', '2024-06-03 15:43:29', 146),
('DoctrineMigrations\\Version20240524182534', '2024-06-03 15:43:29', 161),
('DoctrineMigrations\\Version20240524182712', '2024-06-03 15:43:29', 166),
('DoctrineMigrations\\Version20240524182800', '2024-06-03 15:43:29', 79),
('DoctrineMigrations\\Version20240524182849', '2024-06-03 15:43:30', 181),
('DoctrineMigrations\\Version20240524190211', '2024-06-03 15:43:30', 20),
('DoctrineMigrations\\Version20240524190418', '2024-06-03 15:43:30', 19),
('DoctrineMigrations\\Version20240524190827', '2024-06-03 15:43:30', 17),
('DoctrineMigrations\\Version20240524191006', '2024-06-03 15:43:30', 77),
('DoctrineMigrations\\Version20240524191406', '2024-06-03 15:43:30', 21),
('DoctrineMigrations\\Version20240525160911', '2024-06-03 15:43:30', 65),
('DoctrineMigrations\\Version20240525165639', '2024-06-03 15:43:30', 87),
('DoctrineMigrations\\Version20240602185551', '2024-06-03 15:43:30', 161),
('DoctrineMigrations\\Version20240602193516', '2024-06-03 15:43:30', 90);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `employee`
--

CREATE TABLE `employee` (
  `id` int(11) NOT NULL,
  `login_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `lastname` varchar(150) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(25) NOT NULL,
  `salary` int(11) NOT NULL,
  `hire_date` date DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `employee`
--

INSERT INTO `employee` (`id`, `login_id`, `name`, `lastname`, `email`, `phone`, `salary`, `hire_date`, `is_deleted`) VALUES
(1, 12, 'Sr. Fernando Polanco', 'Jiménez', 'vigil.ines@hispavista.com', '957-584146', 1562, '1984-11-10', 0),
(2, 13, 'Sr. Joel Carballo Segundo', 'Villalba', 'olivia.montanez@aguirre.es', '980 24 8022', 1393, '1997-07-10', 0),
(3, 14, 'Marcos Olivares', 'Peralta', 'jechevarria@hotmail.es', '+34 968465266', 1730, '2000-07-28', 0),
(4, 15, 'Rosario Montero', 'Esteve', 'biel68@live.com', '912-69-5971', 1550, '2019-12-02', 0),
(5, 16, 'Eduardo Cisneros', 'Oliva', 'umiguel@ibarra.com', '+34 947 820745', 1439, '2017-11-12', 0),
(6, 17, 'Ing. Iván Armijo', 'Calvo', 'biel.salazar@moya.com', '918-37-7781', 1650, '2012-07-02', 0),
(7, 18, 'Laia Cortez Segundo', 'Lucas', 'rosario.miguelangel@esquivel.org', '+34 952-91-5268', 1870, '1999-12-26', 0),
(8, 19, 'María Requena Tercero', 'Martínez', 'arias.abril@rangel.org', '+34 995 976345', 1034, '2020-04-28', 0),
(9, 20, 'D. Leo Pagan Hijo', 'Bonilla', 'burgos.carlota@zambrano.es', '998 48 9143', 1022, '2023-09-04', 0),
(10, 21, 'Rafael Gracia Tercero', 'Esparza', 'ander69@briseno.com', '947 60 1412', 1488, '1990-09-07', 0),
(11, 22, 'admin', 'admin', 'angela41@linares.es', '934 701921', 3313, '1972-12-14', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `image`
--

CREATE TABLE `image` (
  `id` int(11) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `vehicle_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `invoice`
--

CREATE TABLE `invoice` (
  `id` int(11) NOT NULL,
  `number` varchar(100) NOT NULL,
  `price` double NOT NULL,
  `date` date NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `invoice`
--

INSERT INTO `invoice` (`id`, `number`, `price`, `date`, `customer_id`, `is_deleted`) VALUES
(1, '2', 860, '2024-06-03', 4, 0),
(2, '5', 576, '2024-06-03', 2, 0),
(3, '4', 719, '2024-06-03', 4, 0),
(4, '1', 582, '2024-06-03', 7, 0),
(5, '3', 554, '2024-06-03', 5, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `login`
--

INSERT INTO `login` (`id`, `username`, `password`, `role`) VALUES
(1, 'inmaculada41', '$2y$13$pZbWPxZVfPm49.d5KUAbMOGDDUbb9.4d01YDbCQSu/roFtfj81GbS', 'ROLE_PRIVATE'),
(2, 'mercado.fatima', '$2y$13$kbFvBmAOozn/Bsr2GVXuTeZ4vBXvnhOqIgnDWimS7OZUsATvu3Z.G', 'ROLE_PRIVATE'),
(3, 'victor.porras', '$2y$13$FR7aAVThDXTEa1UDJX/kfOMJ24TVLMXKuTJpCZL3z7cAyWUvEr1s2', 'ROLE_PRIVATE'),
(4, 'raul69', '$2y$13$pBiHfHaMUfjr/pK5yr60A.4rEIK29X7bIOjae.NBqGP9cHpqURzaq', 'ROLE_PRIVATE'),
(5, 'lucas09', '$2y$13$NRMhV7/LW2qZD3DAw6HzUe/Y8hu/B6R3HzShqsAjcu16lb0ZTU2lq', 'ROLE_PRIVATE'),
(6, 'cbriones', '$2y$13$Ao3S.j7ONzNoy0yuGbnM8u6Q.5jSuLBeYEOSrIN3ng9a2SrH5nPZW', 'ROLE_PRIVATE'),
(7, 'erik39', '$2y$13$NwpZjCJL06vxp5U.GpuR6.kRRu2zirXS6qtQzpyJd5pSM5LlaDUn2', 'ROLE_PRIVATE'),
(8, 'fernando76', '$2y$13$tIPb2Yt7YeL7dpqa8ke6/uBjsPo2MKXhyBvRPZcJ1aDjLidDmVGFS', 'ROLE_PRIVATE'),
(9, 'chacon.luisa', '$2y$13$GNhAuJeMPPfVfMZq11vq3OJxYDWevlhD/HH7IobI0NyPmJnjVEIjy', 'ROLE_PRIVATE'),
(10, 'hector.banda', '$2y$13$.yagHvQTQlZrKtCiapV9YO4IKEqI4wa318t6tZ4E594swFaP0jicS', 'ROLE_PRIVATE'),
(11, 'private', '$2y$13$2BIa8yo1U2rCpS2JQ5jhTe88VIvp3V7LQaFGzB0AgGnyzrpUQwow.', 'ROLE_PRIVATE'),
(12, 'burgos.carmen', '$2y$13$nv4g5X55p7v01JArx8HjI.W4nmTPRfE5gda.glg977wr2OpLpjMX.', 'ROLE_ADMIN'),
(13, 'campos.sofia', '$2y$13$9SGIDjARqR2FvFjT7rHnpuxd.PZydPlj6Gf9E956bbrhQnqzWoAsO', 'ROLE_ADMIN'),
(14, 'gonzalo.correa', '$2y$13$3uzDROvkvf8yI3uG2Nsj3euLQmZOUXCISxgHwe7Iil0ikhhTvT.Se', 'ROLE_ADMIN'),
(15, 'nzamora', '$2y$13$uOCKfjUrpl2lviZ77aoQM.7IBUJovMm.SRtjqjUdt26c2f3jJsfKq', 'ROLE_ADMIN'),
(16, 'arnau24', '$2y$13$HhrfFHq14QjncQ/M4jqMp.DLA86RBe1UKihHAqHY.LNND13Eex6oC', 'ROLE_ADMIN'),
(17, 'arguello.jan', '$2y$13$5nq5ZBl0cA0lL3EhTlOcCeZvcSkxPUaN5169lT8hcmGjUgHaMx1TO', 'ROLE_ADMIN'),
(18, 'rafael.valenzuela', '$2y$13$N8Wc7CNJ94Xeox.2KiQQhOITsFc.K04rkOM.z7DVWTq8EGcKhsyPO', 'ROLE_ADMIN'),
(19, 'lzayas', '$2y$13$BwUCS8D7PSgMLWvyDi.vXuw0.SU5X1.50.S4IFPlhPbwQ3d0SJ05O', 'ROLE_ADMIN'),
(20, 'sescobar', '$2y$13$jOM1xN2tYxwwRksWyYt18.ojAwEvLWTP1SeVY9DnilRIrFF54A3FO', 'ROLE_ADMIN'),
(21, 'teresa.huerta', '$2y$13$jb4CLEwTKospfeRwB.seYeqhxdpa4O/MXtX/whTvT6JBOHrihQcJW', 'ROLE_ADMIN'),
(22, 'admin', '$2y$13$OHC0IhyeXGMYfTrVdk8pQuibexFqvtJ4hwEcz37P9YVRK5Ru8lvFK', 'ROLE_ADMIN');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `messenger_messages`
--

CREATE TABLE `messenger_messages` (
  `id` bigint(20) NOT NULL,
  `body` longtext NOT NULL,
  `headers` longtext NOT NULL,
  `queue_name` varchar(190) NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `available_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `delivered_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `model`
--

CREATE TABLE `model` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `year` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `model`
--

INSERT INTO `model` (`id`, `name`, `year`, `brand_id`) VALUES
(1, 'Sunbeam', 1977, 1),
(2, 'Expert груз.', 2021, 2),
(3, 'GT', 1990, 3),
(4, 'Ital', 2011, 4),
(5, 'Rocsta', 2006, 5),
(6, 'Acadia', 2012, 6),
(7, '900', 2023, 7),
(8, 'Lark', 1985, 8),
(9, 'Chiron', 2014, 9),
(10, 'DMC', 1994, 10),
(11, '5', 2023, 11),
(12, 'Lancer X', 2024, 12),
(13, '360', 1976, 13),
(14, 'Beaufighter', 2006, 14),
(15, 'SCEO', 1997, 15),
(16, 'Trax', 1973, 16),
(17, 'GX6', 1970, 17),
(18, 'Golden Spirit', 1994, 18),
(19, '600R', 2007, 19),
(20, 'Virage', 2006, 20),
(21, 'Nomad', 2003, 21),
(22, 'Silver Spirit', 1964, 22),
(23, 'Proton', 2012, 23),
(24, 'SP:01', 1968, 24),
(25, 'XLW', 2019, 25),
(26, 'Cortez', 1973, 26),
(27, 'Phoenix', 1957, 27),
(28, 'Cobra', 2009, 28),
(29, 'Grand Cherokee', 2015, 29),
(30, 'Nexia', 1977, 30),
(31, 'VEB', 1962, 31),
(32, 'ZLXE', 1990, 32),
(33, 'Plus 4', 2024, 33),
(34, 'Paceman', 1991, 34),
(35, 'A5', 1975, 35),
(36, 'Silver Seraph', 2011, 36),
(37, 'Griffin', 2024, 37),
(38, 'HC', 2018, 38),
(39, 'Continental GT V8 S', 2009, 39),
(40, 'A110', 1965, 40);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `payment_details`
--

CREATE TABLE `payment_details` (
  `id` int(11) NOT NULL,
  `payment_method` varchar(100) NOT NULL,
  `card_number` varchar(255) NOT NULL,
  `expiry_date` date NOT NULL,
  `cvv` varchar(10) NOT NULL,
  `customer_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `payment_details`
--

INSERT INTO `payment_details` (`id`, `payment_method`, `card_number`, `expiry_date`, `cvv`, `customer_id`) VALUES
(1, 'MasterCard', '************5584', '2024-07-28', '***', NULL),
(2, 'MasterCard', '************0275', '2024-12-17', '***', NULL),
(3, 'Visa', '************9867', '2024-07-14', '***', NULL),
(4, 'Visa', '************8761', '2025-01-26', '***', NULL),
(5, 'MasterCard', '************9447', '2024-12-25', '***', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provider`
--

CREATE TABLE `provider` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `dni` varchar(20) NOT NULL,
  `cif` varchar(20) NOT NULL,
  `address` varchar(150) NOT NULL,
  `is_deleted` tinyint(1) DEFAULT NULL,
  `phone` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `provider`
--

INSERT INTO `provider` (`id`, `name`, `email`, `dni`, `cif`, `address`, `is_deleted`, `phone`) VALUES
(1, 'Ros y Delafuente e Hijo', 'escudero.irene@estevez.com', '47917422G', '23045253Q', 'Avenida Juan, 73, 85º 9º, 12863, As Mora', 0, '+34 962 04 3136'),
(2, 'Tejada de Arredondo e Hijo', 'ines.laboy@espinoza.com.es', '64225149H', '08975177C', 'Plaza Yáñez, 80, 5º E, 10763, As Lázaro', 0, '+34 923558693'),
(3, 'Baca y Gonzáles e Hijos', 'pol.sisneros@coronado.com', '71623133Y', '49961719X', 'Carrer Oliver, 265, 9º D, 47148, Carballo del Puerto', 0, '977-018155'),
(4, 'Asociación Leal', 'lara.tijerina@bermudez.com', '76557262Z', '72107420N', 'Paseo Cintrón, 4, 03º A, 50386, As Delvalle del Penedès', 0, '979-501214'),
(5, 'Benavídez, Roca y Mendoza e Hijo', 'quiroz.angel@salinas.es', '96420103D', '75540760Y', 'Ruela Martín, 855, 7º C, 63158, Canales de las Torres', 0, '984 58 6286'),
(6, 'Dávila y Acosta SA', 'garcia.mar@sarabia.es', '90934500K', '91657653F', 'Praza Guillermo, 830, 1º D, 24330, San Arroyo', 0, '+34 911-78-3651'),
(7, 'Lemus de Montenegro', 'salvarado@deanda.com', '63045590Z', '57986711Y', 'Avenida Gloria, 7, 62º F, 53968, Os Manzano', 0, '934-430018'),
(8, 'Grupo Delapaz-Cobo', 'raltamirano@orosco.es', '23033543D', '04130052C', 'Avenida Cabello, 9, 83º B, 62583, Las Escobedo', 0, '+34 966-79-6746'),
(9, 'Farías, Alonso y Moreno S. de H.', 'navarro.aurora@atencio.es', '25049528K', '66967740X', 'Carrer Villegas, 533, 5º, 76501, Segura Alta', 0, '+34 977 50 4649'),
(10, 'Grupo León', 'epacheco@castellanos.com', '21248588S', '51589661O', 'Carrer Escribano, 84, Bajo 4º, 52192, Os Acuña de Ulla', 0, '+34 924 078783'),
(11, 'Ferrer de Martín y Asoc.', 'miguel.paez@salgado.es', '50134801E', '50939470W', 'Travesía Zelaya, 421, 28º F, 54411, Varela de las Torres', 0, '+34 903 840028'),
(12, 'Rodrigo-Franco', 'vescobedo@luis.com', '26832089J', '00480198X', 'Ronda Alonso, 2, 9º A, 58998, El Ochoa de Lemos', 0, '+34 947-739712'),
(13, 'Arreola, Loera y Solorio y Flia.', 'alicea.jordi@ballesteros.com', '89331710D', '19613707G', 'Praza Gabriel, 7, Ático 1º, 00083, San Escamilla Baja', 0, '936-91-6005'),
(14, 'Centro Aguilera e Hijos', 'ledesma.africa@ocampo.org', '96974312X', '25200914C', 'Carrer Suárez, 93, 5º C, 92441, Villa Jiménez', 0, '945 80 9094'),
(15, 'Feliciano y Cintrón e Hijos', 'jvaladez@resendez.org', '58582897B', '82666452L', 'Travessera Ian, 37, 86º F, 03671, Villa Fierro de la Sierra', 0, '+34 918-61-4546');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservation`
--

CREATE TABLE `reservation` (
  `id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `total_price` int(11) NOT NULL,
  `status` varchar(50) NOT NULL,
  `reservation_date` date NOT NULL,
  `customer_id` int(11) NOT NULL,
  `is_deleted` tinyint(1) DEFAULT NULL,
  `payment_details_id` int(11) DEFAULT NULL,
  `invoice_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `reservation`
--

INSERT INTO `reservation` (`id`, `start_date`, `end_date`, `total_price`, `status`, `reservation_date`, `customer_id`, `is_deleted`, `payment_details_id`, `invoice_id`) VALUES
(1, '2024-06-28', '2024-07-01', 158, 'Pendiente', '2024-05-19', 7, NULL, 1, 1),
(2, '2024-05-24', '2024-06-11', 753, 'Cancelada', '2024-04-06', 10, NULL, 2, 1),
(3, '2024-05-20', '2024-06-23', 865, 'Cancelada', '2024-03-09', 10, NULL, 3, 2),
(4, '2024-05-07', '2024-06-09', 122, 'Pendiente', '2024-03-09', 4, NULL, 4, 4),
(5, '2024-06-17', '2024-07-02', 599, 'Confirmada', '2024-04-16', 5, NULL, 5, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `review`
--

CREATE TABLE `review` (
  `id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `reservation_id` int(11) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `review`
--

INSERT INTO `review` (`id`, `rating`, `comment`, `date`, `reservation_id`, `customer_id`) VALUES
(1, 2, 'Non suscipit sit aut aliquam fuga ut.', '2023-07-02', 1, 3),
(2, 1, 'Recusandae et voluptatem soluta provident inventore alias.', '2023-09-20', 1, 3),
(3, 1, 'Occaecati expedita nam quae non rerum odio.', '2024-03-24', 2, 6),
(4, 3, 'Perferendis ut et qui praesentium et nihil.', '2024-04-01', 2, 6),
(5, 5, 'Quos quo illum eaque dolorum temporibus dolores qui.', '2023-07-24', 3, 9),
(6, 2, 'Qui consequatur dignissimos sint a totam ea.', '2024-04-20', 3, 9),
(7, 4, 'Blanditiis et officia velit et est.', '2024-05-30', 4, 11),
(8, 2, 'Maxime inventore suscipit natus rerum dolores.', '2023-11-24', 4, 11),
(9, 1, 'Dolore perferendis dolores et.', '2023-09-11', 5, 8),
(10, 2, 'Dignissimos dolorem mollitia nulla dicta.', '2024-02-01', 5, 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehicle`
--

CREATE TABLE `vehicle` (
  `id` int(11) NOT NULL,
  `plate` varchar(10) NOT NULL,
  `fuel` varchar(100) NOT NULL,
  `color` varchar(50) NOT NULL,
  `engine` varchar(100) NOT NULL,
  `power` varchar(50) NOT NULL,
  `consumption` varchar(100) NOT NULL,
  `acceleration` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `is_deleted` tinyint(1) DEFAULT NULL,
  `provider_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `price_per_day` int(11) NOT NULL,
  `transmission` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `vehicle`
--

INSERT INTO `vehicle` (`id`, `plate`, `fuel`, `color`, `engine`, `power`, `consumption`, `acceleration`, `description`, `is_deleted`, `provider_id`, `brand_id`, `price_per_day`, `transmission`) VALUES
(1, '8844LLC', 'Eléctrico', 'LightBlue', 'I4', '101', '6.29', '12.37', 'Este vehículo es un Luxgen A110 del año 1965. Está equipado con un motor I4 que produce una potencia de 101 CV. Ofrece una aceleración de 0 a 100 km/h en 12.37 segundos y tiene un consumo de combustible de 6.29 litros por cada 100 km. Su color es Ligh', 0, 9, 11, 431, 'Automatico'),
(2, '2803HOS', 'Gasolina', 'DodgerBlue', 'Electric', '291', '13.67', '4.52', 'Este vehículo es un Saab A110 del año 1965. Está equipado con un motor Electric que produce una potencia de 291 CV. Ofrece una aceleración de 0 a 100 km/h en 4.52 segundos y tiene un consumo de combustible de 13.67 litros por cada 100 km. Su color es ', 0, 11, 37, 538, 'Manual'),
(3, '6337HIP', 'Eléctrico', 'White', 'V8', '192', '14.58', '12.72', 'Este vehículo es un Morris A110 del año 1965. Está equipado con un motor V8 que produce una potencia de 192 CV. Ofrece una aceleración de 0 a 100 km/h en 12.72 segundos y tiene un consumo de combustible de 14.58 litros por cada 100 km. Su color es Whi', 0, 8, 4, 415, 'Automatico'),
(4, '0858IVA', 'Eléctrico', 'Aqua', 'Electric', '435', '6.88', '2.16', 'Este vehículo es un Dagger A110 del año 1965. Está equipado con un motor Electric que produce una potencia de 435 CV. Ofrece una aceleración de 0 a 100 km/h en 2.16 segundos y tiene un consumo de combustible de 6.88 litros por cada 100 km. Su color es', 0, 12, 3, 558, 'Manual'),
(5, '0163DAY', 'Eléctrico', 'DarkTurquoise', 'V6', '113', '8.53', '3.41', 'Este vehículo es un Luxgen A110 del año 1965. Está equipado con un motor V6 que produce una potencia de 113 CV. Ofrece una aceleración de 0 a 100 km/h en 3.41 segundos y tiene un consumo de combustible de 8.53 litros por cada 100 km. Su color es DarkT', 0, 10, 11, 786, 'Automatico'),
(6, '3163RAR', 'Gasolina', 'GreenYellow', 'I6', '118', '10.17', '4.21', 'Este vehículo es un Xiaolong A110 del año 1965. Está equipado con un motor I6 que produce una potencia de 118 CV. Ofrece una aceleración de 0 a 100 km/h en 4.21 segundos y tiene un consumo de combustible de 10.17 litros por cada 100 km. Su color es Gr', 0, 12, 25, 649, 'Automatico'),
(7, '3301NVK', 'Gasoil', 'Green', 'V8', '300', '10.5', '5.67', 'Este vehículo es un Audi A110 del año 1965. Está equipado con un motor V8 que produce una potencia de 300 CV. Ofrece una aceleración de 0 a 100 km/h en 5.67 segundos y tiene un consumo de combustible de 10.50 litros por cada 100 km. Su color es Green ', 0, 13, 35, 557, 'Automatico'),
(8, '3133JSW', 'Gasoil', 'DarkSlateGray', 'Electric', '417', '14.91', '12.89', 'Este vehículo es un Detroit Electric A110 del año 1965. Está equipado con un motor Electric que produce una potencia de 417 CV. Ofrece una aceleración de 0 a 100 km/h en 12.89 segundos y tiene un consumo de combustible de 14.91 litros por cada 100 km.', 0, 3, 24, 856, 'Automatico'),
(9, '6411JQB', 'Eléctrico', 'Thistle', 'Electric', '345', '8.21', '11.5', 'Este vehículo es un Zimmer A110 del año 1965. Está equipado con un motor Electric que produce una potencia de 345 CV. Ofrece una aceleración de 0 a 100 km/h en 11.50 segundos y tiene un consumo de combustible de 8.21 litros por cada 100 km. Su color e', 0, 10, 18, 431, 'Manual'),
(10, '7664THL', 'Eléctrico', 'Silver', 'V8', '451', '3.63', '3.6', 'Este vehículo es un Shuanghuan A110 del año 1965. Está equipado con un motor V8 que produce una potencia de 451 CV. Ofrece una aceleración de 0 a 100 km/h en 3.60 segundos y tiene un consumo de combustible de 3.63 litros por cada 100 km. Su color es S', 0, 15, 15, 444, 'Manual'),
(11, '8488FGB', 'Eléctrico', 'MediumSpringGreen', 'V6', '69', '14.9', '6.3', 'Este vehículo es un Saab A110 del año 1965. Está equipado con un motor V6 que produce una potencia de 69 CV. Ofrece una aceleración de 0 a 100 km/h en 6.30 segundos y tiene un consumo de combustible de 14.90 litros por cada 100 km. Su color es MediumS', 0, 4, 7, 891, 'Automatico'),
(12, '3328PUZ', 'Eléctrico', 'Aqua', 'I4', '186', '7.92', '6.45', 'Este vehículo es un Peugeot A110 del año 1965. Está equipado con un motor I4 que produce una potencia de 186 CV. Ofrece una aceleración de 0 a 100 km/h en 6.45 segundos y tiene un consumo de combustible de 7.92 litros por cada 100 km. Su color es Aqua', 0, 4, 2, 404, 'Manual'),
(13, '1648TBP', 'Gasoil', 'Lime', 'V6', '379', '8.37', '12.55', 'Este vehículo es un Bentley A110 del año 1965. Está equipado con un motor V6 que produce una potencia de 379 CV. Ofrece una aceleración de 0 a 100 km/h en 12.55 segundos y tiene un consumo de combustible de 8.37 litros por cada 100 km. Su color es Lim', 0, 5, 39, 827, 'Manual'),
(14, '3624OVD', 'Eléctrico', 'Chocolate', 'I4', '411', '11.34', '7.51', 'Este vehículo es un Aston Martin A110 del año 1965. Está equipado con un motor I4 que produce una potencia de 411 CV. Ofrece una aceleración de 0 a 100 km/h en 7.51 segundos y tiene un consumo de combustible de 11.34 litros por cada 100 km. Su color e', 0, 10, 20, 896, 'Manual'),
(15, '7909ZKC', 'Gasoil', 'SkyBlue', 'I6', '80', '10.31', '3.99', 'Este vehículo es un Morris A110 del año 1965. Está equipado con un motor I6 que produce una potencia de 80 CV. Ofrece una aceleración de 0 a 100 km/h en 3.99 segundos y tiene un consumo de combustible de 10.31 litros por cada 100 km. Su color es SkyBl', 0, 13, 4, 747, 'Manual'),
(16, '0033ZID', 'Gasolina', 'DeepSkyBlue', 'I6', '176', '11.39', '8.39', 'Este vehículo es un Shelby A110 del año 1965. Está equipado con un motor I6 que produce una potencia de 176 CV. Ofrece una aceleración de 0 a 100 km/h en 8.39 segundos y tiene un consumo de combustible de 11.39 litros por cada 100 km. Su color es Deep', 0, 13, 28, 650, 'Automatico'),
(17, '8786HHU', 'Gasoil', 'DarkSlateBlue', 'V6', '303', '3.79', '2.41', 'Este vehículo es un Norster A110 del año 1965. Está equipado con un motor V6 que produce una potencia de 303 CV. Ofrece una aceleración de 0 a 100 km/h en 2.41 segundos y tiene un consumo de combustible de 3.79 litros por cada 100 km. Su color es Dark', 0, 5, 19, 613, 'Automatico'),
(18, '1601VDJ', 'Gasolina', 'Indigo', 'I4', '475', '9.82', '8.06', 'Este vehículo es un Mitsubishi A110 del año 1965. Está equipado con un motor I4 que produce una potencia de 475 CV. Ofrece una aceleración de 0 a 100 km/h en 8.06 segundos y tiene un consumo de combustible de 9.82 litros por cada 100 km. Su color es I', 0, 15, 12, 787, 'Automatico'),
(19, '6929JJM', 'Eléctrico', 'Ivory', 'I4', '402', '6.05', '9.37', 'Este vehículo es un Barkas (Баркас) A110 del año 1965. Está equipado con un motor I4 que produce una potencia de 402 CV. Ofrece una aceleración de 0 a 100 km/h en 9.37 segundos y tiene un consumo de combustible de 6.05 litros por cada 100 km. Su', 0, 4, 31, 816, 'Manual'),
(20, '5619IRX', 'Gasolina', 'MintCream', 'V8', '123', '6.19', '11.63', 'Este vehículo es un Gonow A110 del año 1965. Está equipado con un motor V8 que produce una potencia de 123 CV. Ofrece una aceleración de 0 a 100 km/h en 11.63 segundos y tiene un consumo de combustible de 6.19 litros por cada 100 km. Su color es MintC', 0, 6, 17, 585, 'Automatico'),
(21, '6671WFR', 'Eléctrico', 'BlanchedAlmond', 'Electric', '355', '10.51', '12.58', 'Este vehículo es un Norster A110 del año 1965. Está equipado con un motor Electric que produce una potencia de 355 CV. Ofrece una aceleración de 0 a 100 km/h en 12.58 segundos y tiene un consumo de combustible de 10.51 litros por cada 100 km. Su color', 0, 7, 19, 532, 'Manual'),
(22, '5023BHY', 'Gasoil', 'DarkBlue', 'V8', '482', '11.87', '12.69', 'Este vehículo es un Volvo A110 del año 1965. Está equipado con un motor V8 que produce una potencia de 482 CV. Ofrece una aceleración de 0 a 100 km/h en 12.69 segundos y tiene un consumo de combustible de 11.87 litros por cada 100 km. Su color es Dark', 0, 9, 13, 501, 'Manual'),
(23, '4494UJY', 'Gasoil', 'WhiteSmoke', 'Electric', '440', '10.29', '4.69', 'Este vehículo es un Luxgen A110 del año 1965. Está equipado con un motor Electric que produce una potencia de 440 CV. Ofrece una aceleración de 0 a 100 km/h en 4.69 segundos y tiene un consumo de combustible de 10.29 litros por cada 100 km. Su color e', 0, 2, 11, 559, 'Manual'),
(24, '2494OOY', 'Gasoil', 'Coral', 'V8', '101', '7.45', '3.66', 'Este vehículo es un Rolls-Royce A110 del año 1965. Está equipado con un motor V8 que produce una potencia de 101 CV. Ofrece una aceleración de 0 a 100 km/h en 3.66 segundos y tiene un consumo de combustible de 7.45 litros por cada 100 km. Su color es ', 0, 4, 36, 608, 'Manual'),
(25, '1234KJH', 'gasolina', 'red', 'v8', '500CV', '10.02', '4.54', 'Hola', NULL, 1, 9, 600, 'automatic');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehicle_reservation`
--

CREATE TABLE `vehicle_reservation` (
  `vehicle_id` int(11) NOT NULL,
  `reservation_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `vehicle_reservation`
--

INSERT INTO `vehicle_reservation` (`vehicle_id`, `reservation_id`) VALUES
(4, 4),
(5, 2),
(12, 3),
(17, 1),
(24, 5);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_81398E095CB2E05D` (`login_id`),
  ADD UNIQUE KEY `UNIQ_81398E098EEC86F7` (`payment_details_id`);

--
-- Indices de la tabla `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indices de la tabla `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_5D9F75A15CB2E05D` (`login_id`);

--
-- Indices de la tabla `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_C53D045F545317D1` (`vehicle_id`);

--
-- Indices de la tabla `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_906517449395C3F3` (`customer_id`);

--
-- Indices de la tabla `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username_unique_idx` (`username`);

--
-- Indices de la tabla `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  ADD KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  ADD KEY `IDX_75EA56E016BA31DB` (`delivered_at`);

--
-- Indices de la tabla `model`
--
ALTER TABLE `model`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_D79572D944F5D008` (`brand_id`);

--
-- Indices de la tabla `payment_details`
--
ALTER TABLE `payment_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_6B6F05609395C3F3` (`customer_id`);

--
-- Indices de la tabla `provider`
--
ALTER TABLE `provider`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_42C849558EEC86F7` (`payment_details_id`),
  ADD KEY `IDX_42C849559395C3F3` (`customer_id`),
  ADD KEY `IDX_42C849552989F1FD` (`invoice_id`);

--
-- Indices de la tabla `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_794381C6B83297E7` (`reservation_id`),
  ADD KEY `IDX_794381C69395C3F3` (`customer_id`);

--
-- Indices de la tabla `vehicle`
--
ALTER TABLE `vehicle`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_1B80E486A53A8AA` (`provider_id`),
  ADD KEY `IDX_1B80E48644F5D008` (`brand_id`);

--
-- Indices de la tabla `vehicle_reservation`
--
ALTER TABLE `vehicle_reservation`
  ADD PRIMARY KEY (`vehicle_id`,`reservation_id`),
  ADD KEY `IDX_CCF33423545317D1` (`vehicle_id`),
  ADD KEY `IDX_CCF33423B83297E7` (`reservation_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `brand`
--
ALTER TABLE `brand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT de la tabla `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `image`
--
ALTER TABLE `image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `invoice`
--
ALTER TABLE `invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `model`
--
ALTER TABLE `model`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT de la tabla `payment_details`
--
ALTER TABLE `payment_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `provider`
--
ALTER TABLE `provider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `review`
--
ALTER TABLE `review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `vehicle`
--
ALTER TABLE `vehicle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `FK_81398E095CB2E05D` FOREIGN KEY (`login_id`) REFERENCES `login` (`id`),
  ADD CONSTRAINT `FK_81398E098EEC86F7` FOREIGN KEY (`payment_details_id`) REFERENCES `payment_details` (`id`);

--
-- Filtros para la tabla `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `FK_5D9F75A15CB2E05D` FOREIGN KEY (`login_id`) REFERENCES `login` (`id`);

--
-- Filtros para la tabla `image`
--
ALTER TABLE `image`
  ADD CONSTRAINT `FK_C53D045F545317D1` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicle` (`id`);

--
-- Filtros para la tabla `invoice`
--
ALTER TABLE `invoice`
  ADD CONSTRAINT `FK_906517449395C3F3` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`);

--
-- Filtros para la tabla `model`
--
ALTER TABLE `model`
  ADD CONSTRAINT `FK_D79572D944F5D008` FOREIGN KEY (`brand_id`) REFERENCES `brand` (`id`);

--
-- Filtros para la tabla `payment_details`
--
ALTER TABLE `payment_details`
  ADD CONSTRAINT `FK_6B6F05609395C3F3` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`);

--
-- Filtros para la tabla `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `FK_42C849552989F1FD` FOREIGN KEY (`invoice_id`) REFERENCES `invoice` (`id`),
  ADD CONSTRAINT `FK_42C849558EEC86F7` FOREIGN KEY (`payment_details_id`) REFERENCES `payment_details` (`id`),
  ADD CONSTRAINT `FK_42C849559395C3F3` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`);

--
-- Filtros para la tabla `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `FK_794381C69395C3F3` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`),
  ADD CONSTRAINT `FK_794381C6B83297E7` FOREIGN KEY (`reservation_id`) REFERENCES `reservation` (`id`);

--
-- Filtros para la tabla `vehicle`
--
ALTER TABLE `vehicle`
  ADD CONSTRAINT `FK_1B80E48644F5D008` FOREIGN KEY (`brand_id`) REFERENCES `brand` (`id`),
  ADD CONSTRAINT `FK_1B80E486A53A8AA` FOREIGN KEY (`provider_id`) REFERENCES `provider` (`id`);

--
-- Filtros para la tabla `vehicle_reservation`
--
ALTER TABLE `vehicle_reservation`
  ADD CONSTRAINT `FK_CCF33423545317D1` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicle` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_CCF33423B83297E7` FOREIGN KEY (`reservation_id`) REFERENCES `reservation` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
