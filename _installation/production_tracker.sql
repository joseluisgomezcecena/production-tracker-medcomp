-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 15, 2022 at 12:28 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `production_tracker`
--

-- --------------------------------------------------------

--
-- Table structure for table `andon_events`
--

CREATE TABLE `andon_events` (
  `id` int(11) NOT NULL,
  `start_time` datetime NOT NULL,
  `inprocess_time` datetime NOT NULL,
  `solved_time` datetime NOT NULL,
  `inprocess_flag` int(1) NOT NULL DEFAULT 0,
  `soved_flag` int(1) NOT NULL DEFAULT 0,
  `planta_id` int(11) NOT NULL,
  `departamento_id` int(11) NOT NULL,
  `maquina_id` int(11) NOT NULL,
  `error_id` int(11) NOT NULL,
  `error_category_id` int(11) NOT NULL,
  `maquina_nombre` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `departamento_nombre` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `planta_nombre` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `error_nombre` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `error_category_nombre` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `partno` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `orderno` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `notes` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `user_name` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `user_responded` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `user_solved` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `special_fields` text COLLATE utf8_spanish2_ci NOT NULL,
  `notes_response` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `notes_solved` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `andon_scale1` int(1) NOT NULL DEFAULT 0,
  `andon_scale2` int(1) NOT NULL DEFAULT 0,
  `andon_scale3` int(1) NOT NULL DEFAULT 0,
  `andon_scale4` int(1) NOT NULL DEFAULT 0,
  `andon_scale5` int(1) NOT NULL DEFAULT 0,
  `andon_scale6` int(1) NOT NULL DEFAULT 0,
  `alarm` int(1) NOT NULL DEFAULT 0,
  `facilities` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `andon_events`
--

INSERT INTO `andon_events` (`id`, `start_time`, `inprocess_time`, `solved_time`, `inprocess_flag`, `soved_flag`, `planta_id`, `departamento_id`, `maquina_id`, `error_id`, `error_category_id`, `maquina_nombre`, `departamento_nombre`, `planta_nombre`, `error_nombre`, `error_category_nombre`, `partno`, `orderno`, `notes`, `user_name`, `user_responded`, `user_solved`, `special_fields`, `notes_response`, `notes_solved`, `andon_scale1`, `andon_scale2`, `andon_scale3`, `andon_scale4`, `andon_scale5`, `andon_scale6`, `alarm`, `facilities`) VALUES
(239, '2022-03-04 19:10:47', '2022-03-04 19:14:44', '0000-00-00 00:00:00', 1, 0, 1005, 1038, 942, 18, 12, 'Packaging Machine PIL-30 4600-053015', 'Duralock side B', 'Medcomp', 'Labels', 'DLB005 Labeling – syringes rejected when good', 'MMHR600', 'PFDLC546', 'Print is almost completely missing for half of the order and part number. Labels that are completely fine are rejecting. 1 out of 10 syringes is not being rejected. Made adjustments to the camera as well as changed the label roll. Cleaned off the print he', '', '191', '', 'Additional info:', '', '', 0, 1, 1, 1, 1, 0, 0, 0),
(240, '2022-03-04 19:10:47', '2022-03-04 19:14:44', '0000-00-00 00:00:00', 1, 0, 1005, 1038, 942, 18, 12, 'Packaging Machine PIL-30 4600-053015', 'Duralock side B', 'Medcomp', 'Labels', 'DLB005 Labeling – syringes rejected when good', 'MMHR600', 'PFDLC546', 'Print is almost completely missing for half of the order and part number. Labels that are completely fine are rejecting. 1 out of 10 syringes is not being rejected. Made adjustments to the camera as well as changed the label roll. Cleaned off the print he', '', '191', '', 'Additional info:', '', '', 0, 1, 1, 1, 1, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `item_counter`
--

CREATE TABLE `item_counter` (
  `id` int(11) NOT NULL,
  `site_id` int(11) NOT NULL,
  `count` int(11) NOT NULL,
  `time_slot` int(11) NOT NULL,
  `date_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `date_create` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `martech_departamentos`
--

CREATE TABLE `martech_departamentos` (
  `id` int(11) NOT NULL,
  `planta_id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `active` int(1) NOT NULL DEFAULT 1,
  `otro` int(1) NOT NULL DEFAULT 0,
  `desired_output` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `martech_departamentos`
--

INSERT INTO `martech_departamentos` (`id`, `planta_id`, `nombre`, `active`, `otro`, `desired_output`) VALUES
(1038, 1005, 'Duralock side B', 1, 0, 150),
(1037, 1005, 'Duralock Side A ', 1, 0, 300);

-- --------------------------------------------------------

--
-- Table structure for table `martech_maquinas`
--

CREATE TABLE `martech_maquinas` (
  `id` int(11) NOT NULL,
  `planta_id` int(11) NOT NULL,
  `departamento_id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `numero_control` varchar(100) NOT NULL,
  `active` int(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `martech_maquinas`
--

INSERT INTO `martech_maquinas` (`id`, `planta_id`, `departamento_id`, `nombre`, `numero_control`, `active`) VALUES
(937, 1005, 1037, 'Labeling Machine', '834-1', 1),
(936, 1005, 1037, 'Mixing Unit – Thermoscientific IM1858', 'H18325-01', 1),
(935, 1005, 1037, 'M&O Perry Industries SA-SF', 'P1065', 1),
(938, 1005, 1037, 'Pouch Sealer', '840-1', 1),
(939, 1005, 1038, 'Machine – M&O Perry Industries SA-SF', 'P-1143', 1),
(940, 1005, 1038, 'Mixing Unit – Advanced Scientifics Inc. IM1043', 'IK418', 1),
(941, 1005, 1038, 'Dura-Pack Bagger M7', '527', 1),
(942, 1005, 1038, 'Packaging Machine PIL-30', '4600-053015', 1);

-- --------------------------------------------------------

--
-- Table structure for table `martech_plantas`
--

CREATE TABLE `martech_plantas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `active` int(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `martech_plantas`
--

INSERT INTO `martech_plantas` (`id`, `nombre`, `password`, `active`) VALUES
(1005, 'Medcomp', 'andon2020', 1);

-- --------------------------------------------------------

--
-- Table structure for table `support_msg`
--

CREATE TABLE `support_msg` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `category` varchar(20) NOT NULL,
  `date_created` date NOT NULL,
  `solved` int(1) NOT NULL,
  `date_solved` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL COMMENT 'auto incrementing user_id of each user, unique index',
  `user_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s name, unique',
  `user_password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s password in salted and hashed format',
  `user_email` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s email, unique',
  `fecha` date NOT NULL,
  `user_nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_apellido` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_numero` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `area_code` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `user_telefono` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `support_production` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 's-support p-produccion',
  `isadmin` int(1) DEFAULT 0 COMMENT '0 user (puede ver su departamento) 1 (Puede ver todos los departamentos y hacer cambios) 2 (puede ver todos los departamentos y configurar )',
  `support_department_id` int(11) NOT NULL,
  `support_level` int(1) NOT NULL DEFAULT 0,
  `puesto` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `manager` int(1) NOT NULL DEFAULT 0,
  `profile_pic` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `scale1` int(1) NOT NULL DEFAULT 0,
  `scale2` int(1) NOT NULL DEFAULT 0,
  `scale3` int(1) NOT NULL DEFAULT 0,
  `scale4` int(1) DEFAULT 0,
  `scale5` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='user data';

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_password_hash`, `user_email`, `fecha`, `user_nombre`, `user_apellido`, `user_numero`, `area_code`, `user_telefono`, `support_production`, `isadmin`, `support_department_id`, `support_level`, `puesto`, `manager`, `profile_pic`, `scale1`, `scale2`, `scale3`, `scale4`, `scale5`) VALUES
(21, 'jgomez', '$2y$10$7yySqdF22Gw/Ipp/9QPzG.Xrhul1W6SxNjx6CgrDT5UMy7G2lQtvG', 'jgomez@martechmedical.com', '2018-08-09', 'Jose Luis', 'Gomez Cecena', '43044', '+52', '(686) 259-4318', 's', 2, 12, 1, 'Software Development', 0, 'uploads/profiles/1882389951profile1.jpg', 1, 1, 1, 1, 1),
(162, 'mespericueta', '$2y$10$Ip6zS14oEtxvbTP2RPKXnugsyvBBsuSfcbq1b1XVNqry2gIuJtfbu', 'mespericueta@martechmedical.com', '2020-08-21', 'Martin', 'Espericueta', '47000', '+52', '(686) 350-9426', 's', 0, 12, 1, 'Software Development', 0, '', 0, 1, 1, 1, 1),
(164, 'jesquer', '$2y$10$OIM2.qeYufRq1UH7QkoHZO4P0gyv5LNf6GM5f9SRpWTYjztbGeOTi', 'jesquer@martechmedical.com', '2020-08-28', 'Juan Carlos', 'Esquer', '2', '+52', '(686) 549-5409', 'p', 0, 0, 0, 'test manager', 2, '', 0, 0, 1, 0, 0),
(165, 'jvargas', '$2y$10$8oCj9CnDLW91NeEAc1LLnedL/DsLInP.T/QkqdPPqlETptIF1NJPW', 'jvargas@martechmedical.com', '2020-08-28', 'Javier', 'Vargas', '3', '+52', '(686) 170-0031', 'p', 0, 0, 0, 'general  test', 3, '', 0, 0, 0, 1, 0),
(166, 'jmorimoto', '$2y$10$fdsIsXxEablD9O10VTzEdeBfdDmW8SuiICrYiTEJP3w7s6lTuDjkC', 'jmorimoto@martechmedical.com', '2020-08-28', 'Jose Francisco ', 'Morimoto', '4', '+52', '(686) 309-1510', 'p', 1, 0, 0, 'President Test', 4, '', 0, 0, 0, 0, 1),
(167, 'joseluis', '$2y$10$98MaXXNhMWysYqOCBG8ihu3eyuxWISzYWBxB7E48RvRe/F9tQLKwm', 'joseluisgomezcecegna@gmail.com', '2020-08-28', 'jose', 'gomez', '430442', '+52', '(686) 259-4318', 's', 0, 12, 1, 'test user', 0, '', 1, 1, 1, 0, 0),
(168, 'glarrea', '$2y$10$.09ndbErd2j09rBGFDjqo.E6xzIy05tA3wm2ZU/LwgqkYJ7eYh6RC', 'glarrea@medcompnet.com', '2020-09-01', 'Germania', 'Larrea', '1', '+1', '', 's', 0, 12, 1, 'Production', 2, '', 1, 1, 0, 0, 0),
(169, 'kcardenas', '$2y$10$KixzfKDBC69bqidBXSoTxO2k9CTlXdBHYf81m6sR5skeqnW.pqF3e', 'kcardenas@medcompnet.com', '2020-09-01', 'Kwang', 'Chardenas', '2', '+1', '', 's', 0, 12, 1, 'Production', 2, '', 1, 0, 0, 0, 0),
(170, 'jgulley', '$2y$10$jRUl.14r3Ciuo5EO6xP0feTuUE862qNQwpQN7G7iPWc7qSCHU8rjm', 'jgulley@medcompnet.com', '2020-09-01', 'Jonathan', 'Gulley', '3', '+1', '', 's', 0, 12, 1, 'Duralock', 2, '', 1, 0, 0, 0, 0),
(171, 'jcollins', '$2y$10$ftMCkACQFZgWHtXwH0mGEuorE90Cq/GM3X/Zb6CZmvHYezCdTgrR.', 'jcollins@medcompnet.com', '2020-09-01', 'Jennifer', 'Collins', '4', '+1', '', 's', 0, 12, 1, 'Duralock', 2, '', 0, 0, 0, 0, 0),
(172, 'mpuzycki', '$2y$10$ryYgYz.6yXMn.Uw5nEy6FeHpQBfEfoT09pvaZiCbf/1jeCRFlqEVG', 'mpuzycki@medcompnet.com', '2020-09-01', 'Maria ', 'Puzycki', '5', '+1', '', 's', 0, 12, 1, 'Production', 2, '', 1, 1, 0, 0, 0),
(173, 'slapp', '$2y$10$cdUC/QJkSJAM8Ag493.vI.Oo6vZcQhqPXJFDsMJB4oXXi9.FFx54G', 'slapp@martechmedical.com', '2020-09-01', 'Stephen', 'Slapp', '6', '+1', '', 's', 0, 12, 1, 'Molding Tech', 2, '', 1, 0, 0, 0, 0),
(174, 'pamin', '$2y$10$fVgS1DjChvdZXIuZowM/XOw/vOhqznLpce0Xqf24sdJOlwAp.DaMC', 'pamin@medcompnet.com', '2020-09-01', 'Piyush', 'Amin', '7', '+1', '', 's', 0, 12, 1, 'Setup Tech', 1, '', 1, 0, 0, 0, 0),
(175, 'jwagner', '$2y$10$vIr7yAcyp5GeI/aNhj4ZPOcRgnTVn1oebRLR3aFmQvrIEAlQffyte', 'jwagner@martechmedical.com', '2020-09-01', 'Jeff', 'Wagner', '8', '+1', '', 's', 0, 12, 1, 'Extrusion', 0, '', 1, 0, 0, 0, 0),
(176, 'dlind', '$2y$10$Vby/m8ksbhmV0oAz1A9/Dud73j7DvVgFlAHUMJFv0vwzMrdL1p69q', 'dlind@martechmedical.com', '2020-09-01', 'Damian', 'Lind', '9', '+1', '(215) 272-5195', 's', 0, 12, 1, 'Maintenance', 0, '', 1, 1, 0, 0, 0),
(177, 'jwood', '$2y$10$Oj5clTQy4hWvoBcIU081V.vBLb/EMMaiOlzOyCpxrUJrWiwHdqa.W', 'jwood@martechmedical.com', '2020-09-01', 'James', 'Wood', '10', '+1', '', 's', 0, 12, 1, 'Maintenance', 0, '', 0, 0, 0, 0, 0),
(178, 'jbrzyski', '$2y$10$Kn5GG96iObtoLNdtzkWyTeH/rb.Q3A16yER6yqvov5EQIpbyEutg.', 'jbrzyski@martechmedical.com', '2020-09-01', 'Julia', 'Brzyski', '11', '+1', '', 's', 1, 12, 1, 'Production Manager', 4, '', 1, 1, 1, 0, 0),
(179, 'pswift', '$2y$10$Q5b07Dn8O991vBIDdOt1.ejtRV5/h7BwO8Td.Q8LpUKW6oYh.vI0i', 'pswift@martechmedical.com', '2020-09-01', 'Pat', 'Swift', '12', '+1', '', 's', 1, 12, 1, 'Engineering Manager', 0, '', 0, 0, 0, 0, 0),
(180, 'wduffield', '$2y$10$3W8PNZWx.AQ/oG9OjHCHv.35WtSk3t9WihEINrSeNFUmD5Q0LcrqW', 'wduffield@medcompnet.com', '2020-09-01', 'William', 'Duffield', '13', '+1', '', 's', 1, 12, 1, 'Lead Engineer', 0, '', 0, 0, 0, 0, 0),
(181, 'tschultz', '$2y$10$.iR.pkc4X7Evuyx.tChWYeg0.NLmkz/Fe7Mq2R8W2T/W6PmHjMfOS', 'tschultz@martechmedical.com', '2020-09-01', 'Tracy', 'Schultz', '14', '+1', '(470) 280-3099', 's', 1, 12, 1, 'Vice President of Operations', 0, '', 0, 0, 0, 1, 0),
(182, 'jdillon', '$2y$10$R12zY/Wu5jRV7Ra7wYuLHeOe2iVFWyRsw4keTo0ZWx/86cxixrSSq', 'jdillon@medcompnet.com', '2020-09-01', 'Julianne', 'Dillon', '15', '+1', '', 's', 1, 12, 1, 'Director Engineering', 0, '', 0, 0, 0, 1, 0),
(183, 'ksanford', '$2y$10$93eEU/kVgUvUJm3xxetyO.NDYNEeOl4Xu1n1.kmehVLzdT4u.FFYa', 'ksanford@martechmedical.com', '2020-09-01', 'Kevin', 'Sanford', '16', '+1', '', 's', 1, 12, 1, 'Vice President of Engineering', 0, '', 0, 0, 0, 1, 0),
(184, 'tms', '$2y$10$6jYlhyAg4ltACEes1dSkkulsprBPfKRncis9SmZBQFttVQM6.mOLa', 'tms@medcompnet.com', '2020-09-01', 'Tim ', 'Schweikert', '17', '+1', '', 's', 1, 12, 1, 'President', 0, '', 0, 0, 0, 0, 1),
(185, 'Damberger', '$2y$10$UHbTESJeE5jSD8ofWnvnFezoRgiciFrTWQFGgakAAK7WgmR5tO/Me', 'Damberger@martechmedical.com', '2020-10-05', 'David', 'Amberger', '0', '+1', '', 's', 0, 12, 0, '', 0, '', 0, 0, 0, 0, 0),
(186, 'slandis', '$2y$10$7h9ykQs2Va4J6vnTTjIw8.9VZRy7IQvMoVifcwoz0fZGFb3BcMyo2', 'slandis2@martechmedical.com', '2020-11-17', 'Sarah', 'Landis', '1', '+1', '(267) 772-3233', 's', 1, 12, 1, 'Planning Coordinator', 0, '', 1, 1, 1, 0, 0),
(187, 'Jnelson', '$2y$10$NzJ1afWgvHgahimtGRyUk.ktua.hHp.v26vetJ/BXue1wYbz9l9cu', 'JNelson@martechmedical.com', '2021-02-04', 'Jeanette', 'Nelson', '1073', '+1', '', 's', 0, 12, 1, 'Maintenance Assistant', 0, '', 0, 0, 0, 0, 0),
(188, 'Dpypiuk', '$2y$10$fjHPBfAm8QVs.wSwBwpTTOrUklZkBzGo4wVnQKc5BfI5VthEn4apW', 'dpypiuk@martechmedical.com', '2021-09-30', 'Daniel', 'Pypiuk', '1090', '+1', '', 's', 0, 12, 1, 'Maintenance ', 0, '', 1, 1, 0, 0, 0),
(189, 'Kakter', '$2y$10$vLX7/UQ22kE6eKExonjLZuEeMiTe5kRHthwTifLbOljGFgTexwmJi', 'kakter@medcompnet.com', '2021-10-04', 'Khaleda', 'Akter', '823', '+1', '', 'p', 0, 0, 0, 'Production Supervisor', 1, '', 1, 0, 0, 0, 0),
(190, 'Clydzinski', '$2y$10$T9X0UHr2YyOfEw3GrbE4jelgQ7hMzPkcEVjgChp.Oo2Gj1vuu05ya', 'clydzinski@medcompnet.com', '2021-11-02', 'Christian ', 'Lydzinski', '1207', '+1', '', 's', 0, 12, 0, 'Duralock Engineer', 0, '', 0, 0, 1, 0, 0),
(191, 'Mfarbstein', '$2y$10$YnH1q4dET7.hw3z7cWWf8eg94fmuQiXolW8QDyBEhJ6FrnRZBRU8y', 'mfarbstein@medcompnet.com', '2022-01-21', 'Melissa ', 'Farbstein', '1191', '+1', '', 's', 0, 12, 0, 'Dura Lock Set up Tech', 0, '', 1, 0, 0, 0, 0),
(192, 'Jdimare', '$2y$10$.FVba9sMTTnin1A3oCS/6uWfWHcd1MO.12QfHVIr4dvNJMWmEopj2', 'jdimare@medcompnet.com', '2022-01-21', 'James', 'Dimare', '1257', '+1', '', 's', 0, 12, 0, 'Dura Lock Set up tech ', 0, '', 1, 0, 0, 0, 0),
(193, 'mcampos', '$2y$10$K/CvGkr9LicRuySIguPgfuXPfuro3nuCu97CmbLKypO/LBIU57LwW', 'mcampos1@martechmedical.com', '2022-02-09', 'Maggie', 'Campos', '46565', '+52', '(686) 460-8160', 's', 1, 12, 1, 'software developer', 4, 'uploads/profiles/839078650ROJO.PNG', 1, 1, 0, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `andon_events`
--
ALTER TABLE `andon_events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item_counter`
--
ALTER TABLE `item_counter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `martech_departamentos`
--
ALTER TABLE `martech_departamentos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `martech_maquinas`
--
ALTER TABLE `martech_maquinas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `martech_plantas`
--
ALTER TABLE `martech_plantas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `support_msg`
--
ALTER TABLE `support_msg`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_name` (`user_name`),
  ADD UNIQUE KEY `user_email` (`user_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `andon_events`
--
ALTER TABLE `andon_events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=241;

--
-- AUTO_INCREMENT for table `item_counter`
--
ALTER TABLE `item_counter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `martech_departamentos`
--
ALTER TABLE `martech_departamentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1039;

--
-- AUTO_INCREMENT for table `martech_maquinas`
--
ALTER TABLE `martech_maquinas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=943;

--
-- AUTO_INCREMENT for table `martech_plantas`
--
ALTER TABLE `martech_plantas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1006;

--
-- AUTO_INCREMENT for table `support_msg`
--
ALTER TABLE `support_msg`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'auto incrementing user_id of each user, unique index', AUTO_INCREMENT=194;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
