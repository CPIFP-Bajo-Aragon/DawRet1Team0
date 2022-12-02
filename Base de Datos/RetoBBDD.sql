-- phpMyAdmin SQL Dump
-- version 4.6.6deb5ubuntu0.5
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 02-12-2022 a las 11:20:40
-- Versión del servidor: 5.7.40-0ubuntu0.18.04.1
-- Versión de PHP: 7.2.24-0ubuntu0.18.04.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `RetoBBDD`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ASIGNAR`
--

CREATE TABLE `ASIGNAR` (
  `idPublic` int(11) NOT NULL,
  `idPantalla` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ASIGNAR`
--

INSERT INTO `ASIGNAR` (`idPublic`, `idPantalla`) VALUES
(23, 7),
(26, 7),
(19, 8),
(25, 8),
(27, 28);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `DEPARTAMENTO`
--

CREATE TABLE `DEPARTAMENTO` (
  `idDpto` int(11) NOT NULL,
  `nombreDpto` varchar(100) NOT NULL,
  `edificio` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `DEPARTAMENTO`
--

INSERT INTO `DEPARTAMENTO` (`idDpto`, `nombreDpto`, `edificio`) VALUES
(1, 'Informatica', 'informatica'),
(2, 'Electricidad', 'Loscos'),
(10, 'Sanidad', 'sanidad'),
(12, 'Administrativo', 'loscos'),
(13, 'Automocion', 'automocion'),
(14, 'Secretaría', 'loscos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `PANTALLA`
--

CREATE TABLE `PANTALLA` (
  `idPantalla` int(11) NOT NULL,
  `nombrePantalla` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL,
  `MAC` varchar(100) NOT NULL,
  `idUbc` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `PANTALLA`
--

INSERT INTO `PANTALLA` (`idPantalla`, `nombrePantalla`, `MAC`, `idUbc`) VALUES
(7, 'cacahuete', 'b8:27:eb:2a:70:08', 1),
(8, 'PantallaCarlos', '2c:fd:a1:5d:dd:db', 1),
(13, 'nueva', 'saffdsafadfads', 1),
(28, 'pantallaadrian', '2c:fd:a1:5f:05:b7', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `PUBLICACION`
--

CREATE TABLE `PUBLICACION` (
  `idPublic` int(11) NOT NULL,
  `tituloPublic` varchar(100) NOT NULL,
  `mensajePublic` varchar(255) NOT NULL,
  `archivo` varchar(255) DEFAULT NULL,
  `fechaInicio` date NOT NULL DEFAULT '2020-12-03',
  `fechaLimite` date NOT NULL,
  `idUser` int(11) NOT NULL,
  `fechaAutorizacion` date DEFAULT NULL,
  `validada` tinyint(1) DEFAULT '0',
  `motivoDenegacion` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `PUBLICACION`
--

INSERT INTO `PUBLICACION` (`idPublic`, `tituloPublic`, `mensajePublic`, `archivo`, `fechaInicio`, `fechaLimite`, `idUser`, `fechaAutorizacion`, `validada`, `motivoDenegacion`) VALUES
(17, 'Publicacion para pantalla dealba', 'afdffdsfdsafdsafadsfd', 'young-traveler2.jpg', '2022-11-18', '2022-11-27', 1, '2022-11-30', 1, NULL),
(19, 'a', 'hola', '', '2022-11-17', '2022-11-26', 1, '2022-11-30', 1, NULL),
(21, 'pÃ§denegar', 'ffdsadsfsadf', '', '2022-11-10', '2022-11-26', 1, '2022-11-30', -1, 'motivogenerico'),
(23, 'hola', 'prueba3', '', '2022-11-16', '2022-11-29', 1, '2022-11-30', 1, NULL),
(24, 'ffsadfdfdsafdasf', 'asdffasd', '', '2022-11-10', '2022-11-18', 1, '2022-11-30', 1, NULL),
(25, 'denegarmelaASDSADSA', 'sffadsfdfasdfdsafasdfsdafsdaf', '', '2022-11-09', '2022-11-26', 2, '2022-11-30', 0, 'motivogenerico'),
(26, 'merino', 'chupoptero', '', '2022-11-08', '2022-11-23', 1, '2022-11-30', 1, NULL),
(27, 'Nueva noticia', 'me gusta la adrenalinafasffads\r\n', '', '2022-12-09', '2022-12-18', 1, '2022-12-02', 1, NULL),
(28, 'prueba1', 'prueba1', '', '2022-12-14', '2022-12-21', 1, '2022-12-02', -1, 'motivogenerico'),
(29, 'prueba2', 'prueba2', '', '2022-12-21', '2022-12-22', 1, '2022-12-02', -1, 'motivogenerico'),
(30, 'fasdffdaf', 'fdfasdffdsafafdsff', '', '2022-12-15', '2022-12-24', 2, NULL, 0, 'no me gusta');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ROL`
--

CREATE TABLE `ROL` (
  `idRol` int(11) NOT NULL,
  `nombreRol` varchar(100) NOT NULL,
  `descripcionRol` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ROL`
--

INSERT INTO `ROL` (`idRol`, `nombreRol`, `descripcionRol`) VALUES
(1, 'Crear Publicaciones', 'Solamente se puede crear publicaciones'),
(3, 'Crear, eliminar, autorizar publicaciones', 'Este rol es del adiministrador puede hacer todo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TENER`
--

CREATE TABLE `TENER` (
  `idUser` int(11) NOT NULL,
  `idRol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `TENER`
--

INSERT INTO `TENER` (`idUser`, `idRol`) VALUES
(2, 1),
(4, 1),
(1, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `UBICACION`
--

CREATE TABLE `UBICACION` (
  `idUbc` int(11) NOT NULL,
  `nombreUbc` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `UBICACION`
--

INSERT INTO `UBICACION` (`idUbc`, `nombreUbc`) VALUES
(1, 'Informatica'),
(2, 'Mecanica');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `USUARIO`
--

CREATE TABLE `USUARIO` (
  `idUser` int(11) NOT NULL,
  `nombreUser` varchar(255) NOT NULL,
  `claveUser` varchar(255) NOT NULL,
  `idDpto` int(11) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `rol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `USUARIO`
--

INSERT INTO `USUARIO` (`idUser`, `nombreUser`, `claveUser`, `idDpto`, `email`, `rol`) VALUES
(1, 'administrador', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 1, NULL, 2),
(2, 'alumno', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 12, NULL, 1),
(4, 'profesor', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 2, NULL, 2),
(18, 'adrian', '922efe0c2fd680d4f6e1b5d47ca19486484c383f', 1, '1233@gmailk', 1),
(27, 'Carlos', 'clavegenerica', 1, 'carlosbaq24@gmail.com', 1),
(42, 'Ramon', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 1, 'ramoncp@gmail.com', 1),
(48, 'Jose Luis', '6733c49374acebd2f4c000965fa4562748643729', 1, 'joselito@gmail.com', 3);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ASIGNAR`
--
ALTER TABLE `ASIGNAR`
  ADD PRIMARY KEY (`idPublic`,`idPantalla`),
  ADD KEY `idPantalla` (`idPantalla`);

--
-- Indices de la tabla `DEPARTAMENTO`
--
ALTER TABLE `DEPARTAMENTO`
  ADD PRIMARY KEY (`idDpto`);

--
-- Indices de la tabla `PANTALLA`
--
ALTER TABLE `PANTALLA`
  ADD PRIMARY KEY (`idPantalla`),
  ADD UNIQUE KEY `MAC` (`MAC`),
  ADD KEY `idUbc` (`idUbc`);

--
-- Indices de la tabla `PUBLICACION`
--
ALTER TABLE `PUBLICACION`
  ADD PRIMARY KEY (`idPublic`),
  ADD KEY `idUser` (`idUser`);

--
-- Indices de la tabla `ROL`
--
ALTER TABLE `ROL`
  ADD PRIMARY KEY (`idRol`);

--
-- Indices de la tabla `TENER`
--
ALTER TABLE `TENER`
  ADD PRIMARY KEY (`idUser`,`idRol`),
  ADD KEY `idRol` (`idRol`);

--
-- Indices de la tabla `UBICACION`
--
ALTER TABLE `UBICACION`
  ADD PRIMARY KEY (`idUbc`);

--
-- Indices de la tabla `USUARIO`
--
ALTER TABLE `USUARIO`
  ADD PRIMARY KEY (`idUser`),
  ADD UNIQUE KEY `nombreUser` (`nombreUser`),
  ADD KEY `idDpto` (`idDpto`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `DEPARTAMENTO`
--
ALTER TABLE `DEPARTAMENTO`
  MODIFY `idDpto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT de la tabla `PANTALLA`
--
ALTER TABLE `PANTALLA`
  MODIFY `idPantalla` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT de la tabla `PUBLICACION`
--
ALTER TABLE `PUBLICACION`
  MODIFY `idPublic` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT de la tabla `ROL`
--
ALTER TABLE `ROL`
  MODIFY `idRol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `UBICACION`
--
ALTER TABLE `UBICACION`
  MODIFY `idUbc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `USUARIO`
--
ALTER TABLE `USUARIO`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `ASIGNAR`
--
ALTER TABLE `ASIGNAR`
  ADD CONSTRAINT `ASIGNAR_ibfk_1` FOREIGN KEY (`idPublic`) REFERENCES `PUBLICACION` (`idPublic`),
  ADD CONSTRAINT `ASIGNAR_ibfk_2` FOREIGN KEY (`idPantalla`) REFERENCES `PANTALLA` (`idPantalla`);

--
-- Filtros para la tabla `PANTALLA`
--
ALTER TABLE `PANTALLA`
  ADD CONSTRAINT `PANTALLA_ibfk_1` FOREIGN KEY (`idUbc`) REFERENCES `UBICACION` (`idUbc`);

--
-- Filtros para la tabla `PUBLICACION`
--
ALTER TABLE `PUBLICACION`
  ADD CONSTRAINT `PUBLICACION_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `USUARIO` (`idUser`);

--
-- Filtros para la tabla `TENER`
--
ALTER TABLE `TENER`
  ADD CONSTRAINT `TENER_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `USUARIO` (`idUser`),
  ADD CONSTRAINT `TENER_ibfk_2` FOREIGN KEY (`idRol`) REFERENCES `ROL` (`idRol`);

--
-- Filtros para la tabla `USUARIO`
--
ALTER TABLE `USUARIO`
  ADD CONSTRAINT `USUARIO_ibfk_1` FOREIGN KEY (`idDpto`) REFERENCES `DEPARTAMENTO` (`idDpto`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
