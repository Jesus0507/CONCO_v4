-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-09-2021 a las 20:26:42
-- Versión del servidor: 10.1.38-MariaDB
-- Versión de PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `conco`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bitacora`
--

CREATE TABLE `bitacora` (
  `id_bitacora` int(11) NOT NULL,
  `fecha` text,
  `dia` text,
  `hora_inicio` text,
  `hora_salida` text,
  `acciones` text,
  `cedula` varchar(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bonos`
--

CREATE TABLE `bonos` (
  `id_bonos` int(11) NOT NULL,
  `parto_humanizado` text,
  `hogares_de_la_patria` text,
  `lactancia_materna` text,
  `pension` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calle`
--

CREATE TABLE `calle` (
  `id_calle` int(11) NOT NULL,
  `nombre_calle` varchar(30) DEFAULT NULL,
  `condicion_calle` text,
  `divisiones` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `centro_votacion`
--

CREATE TABLE `centro_votacion` (
  `id_centro_votacion` int(11) NOT NULL,
  `registro_votante` text,
  `nombre_centro` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `discapacidad`
--

CREATE TABLE `discapacidad` (
  `id_discapacidad` int(11) NOT NULL,
  `tipo` varchar(30) DEFAULT NULL,
  `necesidades` text,
  `observacion` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `embarazadas`
--

CREATE TABLE `embarazadas` (
  `id_embarazada` int(11) NOT NULL,
  `control_parental` text,
  `antecedentes` text,
  `enfermedad_asociada` text,
  `recibe_micronutrientes` text,
  `inscrita_parto_humanizado` text,
  `telefono` int(11) DEFAULT NULL,
  `telefono_familiar` int(11) DEFAULT NULL,
  `conoce_asic_territorio` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `familias`
--

CREATE TABLE `familias` (
  `id_familia` int(11) NOT NULL,
  `cedula_jefe_de_calle` varchar(8) DEFAULT NULL,
  `numero_integrantes` int(2) DEFAULT NULL,
  `mercados_asignados` int(2) DEFAULT NULL,
  `observacion` text,
  `tipo_familia` text,
  `id_vivienda` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `familiasxpersonas`
--

CREATE TABLE `familiasxpersonas` (
  `id_familiasxpersonas` int(11) NOT NULL,
  `integrantes_familia` text,
  `cedula` varchar(12) DEFAULT NULL,
  `id_familia` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inmueble`
--

CREATE TABLE `inmueble` (
  `id_inmueble` int(11) NOT NULL,
  `nombre_inmueble` varchar(30) DEFAULT NULL,
  `direccion` varchar(30) DEFAULT NULL,
  `id_calle` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modulos`
--

CREATE TABLE `modulos` (
  `id_modulo` int(11) NOT NULL,
  `nombre` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nivel_educativo`
--

CREATE TABLE `nivel_educativo` (
  `id_educativo` int(11) NOT NULL,
  `nivel_educativo` varchar(30) DEFAULT NULL,
  `instituciones` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notificaciones`
--

CREATE TABLE `notificaciones` (
  `id_notificacion` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  `accion` text,
  `leido` int(11) DEFAULT NULL,
  `usuario_emisor` varchar(12) DEFAULT NULL,
  `usuario_receptor` varchar(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos_usuario_modulo`
--

CREATE TABLE `permisos_usuario_modulo` (
  `id_permiso_usuario_modulo` int(11) NOT NULL,
  `consultar` int(11) DEFAULT NULL,
  `registrar` int(11) DEFAULT NULL,
  `modificar` int(11) DEFAULT NULL,
  `eliminar` int(11) DEFAULT NULL,
  `usuario` varchar(12) DEFAULT NULL,
  `id_modulo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas`
--

CREATE TABLE `personas` (
  `cedula` varchar(12) NOT NULL,
  `primer_nombre` varchar(15) DEFAULT NULL,
  `segundo_nombre` varchar(15) DEFAULT NULL,
  `primer_apellido` varchar(15) DEFAULT NULL,
  `segundo_apellido` varchar(15) DEFAULT NULL,
  `edad` varchar(3) DEFAULT NULL,
  `sexualidad` varchar(15) DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `telefono` int(11) DEFAULT NULL,
  `telefono_casa` int(11) DEFAULT NULL,
  `correo` text,
  `carnet_patria` text,
  `carnet_psuv` varchar(10) DEFAULT NULL,
  `tipo_persona` int(11) DEFAULT NULL,
  `consejo_comunal` varchar(2) DEFAULT NULL,
  `estado_civil` varchar(15) DEFAULT NULL,
  `genero` varchar(15) DEFAULT NULL,
  `ocupacion` text,
  `whatsapp` int(11) DEFAULT NULL,
  `id_salud` int(11) DEFAULT NULL,
  `id_embarazada` int(11) DEFAULT NULL,
  `id_educativo` int(11) DEFAULT NULL,
  `id_discapacidad` int(11) DEFAULT NULL,
  `id_centro_votacion` int(11) DEFAULT NULL,
  `vacuna` text,
  `id_bonos` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `salud`
--

CREATE TABLE `salud` (
  `id_salud` int(11) NOT NULL,
  `tipo_enfermedad` varchar(30) DEFAULT NULL,
  `necesidades` text,
  `observaciones` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `cedula` varchar(12) NOT NULL,
  `nombre` varchar(15) DEFAULT NULL,
  `apellido` varchar(15) DEFAULT NULL,
  `fecha_n` date DEFAULT NULL,
  `correo` varchar(80) DEFAULT NULL,
  `contrasenia` text,
  `estado` int(11) DEFAULT NULL,
  `rol_inicio` varchar(50) DEFAULT NULL,
  `preguntas_seguridad` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vivienda`
--

CREATE TABLE `vivienda` (
  `id_vivienda` int(11) NOT NULL,
  `propietario` varchar(40) DEFAULT NULL,
  `observaciones` text,
  `direccion` varchar(30) DEFAULT NULL,
  `tipo_casa` text,
  `estado_casa` text,
  `numero_casa` text,
  `servicios` text,
  `id_calle` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `bitacora`
--
ALTER TABLE `bitacora`
  ADD PRIMARY KEY (`id_bitacora`),
  ADD KEY `cedula` (`cedula`);

--
-- Indices de la tabla `bonos`
--
ALTER TABLE `bonos`
  ADD PRIMARY KEY (`id_bonos`);

--
-- Indices de la tabla `calle`
--
ALTER TABLE `calle`
  ADD PRIMARY KEY (`id_calle`);

--
-- Indices de la tabla `centro_votacion`
--
ALTER TABLE `centro_votacion`
  ADD PRIMARY KEY (`id_centro_votacion`);

--
-- Indices de la tabla `discapacidad`
--
ALTER TABLE `discapacidad`
  ADD PRIMARY KEY (`id_discapacidad`);

--
-- Indices de la tabla `embarazadas`
--
ALTER TABLE `embarazadas`
  ADD PRIMARY KEY (`id_embarazada`);

--
-- Indices de la tabla `familias`
--
ALTER TABLE `familias`
  ADD PRIMARY KEY (`id_familia`),
  ADD KEY `id_vivienda` (`id_vivienda`);

--
-- Indices de la tabla `familiasxpersonas`
--
ALTER TABLE `familiasxpersonas`
  ADD PRIMARY KEY (`id_familiasxpersonas`),
  ADD KEY `cedula` (`cedula`),
  ADD KEY `id_familia` (`id_familia`);

--
-- Indices de la tabla `inmueble`
--
ALTER TABLE `inmueble`
  ADD PRIMARY KEY (`id_inmueble`),
  ADD KEY `id_calle` (`id_calle`);

--
-- Indices de la tabla `modulos`
--
ALTER TABLE `modulos`
  ADD PRIMARY KEY (`id_modulo`);

--
-- Indices de la tabla `nivel_educativo`
--
ALTER TABLE `nivel_educativo`
  ADD PRIMARY KEY (`id_educativo`);

--
-- Indices de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  ADD PRIMARY KEY (`id_notificacion`),
  ADD KEY `usuario_emisor` (`usuario_emisor`),
  ADD KEY `usuario_receptor` (`usuario_receptor`);

--
-- Indices de la tabla `permisos_usuario_modulo`
--
ALTER TABLE `permisos_usuario_modulo`
  ADD PRIMARY KEY (`id_permiso_usuario_modulo`),
  ADD KEY `usuario` (`usuario`),
  ADD KEY `id_modulo` (`id_modulo`);

--
-- Indices de la tabla `personas`
--
ALTER TABLE `personas`
  ADD PRIMARY KEY (`cedula`),
  ADD KEY `id_salud` (`id_salud`),
  ADD KEY `id_embarazada` (`id_embarazada`),
  ADD KEY `id_educativo` (`id_educativo`),
  ADD KEY `id_discapacidad` (`id_discapacidad`),
  ADD KEY `id_centro_votacion` (`id_centro_votacion`),
  ADD KEY `id_bonos` (`id_bonos`);

--
-- Indices de la tabla `salud`
--
ALTER TABLE `salud`
  ADD PRIMARY KEY (`id_salud`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`cedula`);

--
-- Indices de la tabla `vivienda`
--
ALTER TABLE `vivienda`
  ADD PRIMARY KEY (`id_vivienda`),
  ADD KEY `id_calle` (`id_calle`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `bitacora`
--
ALTER TABLE `bitacora`
  MODIFY `id_bitacora` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `bonos`
--
ALTER TABLE `bonos`
  MODIFY `id_bonos` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `calle`
--
ALTER TABLE `calle`
  MODIFY `id_calle` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `centro_votacion`
--
ALTER TABLE `centro_votacion`
  MODIFY `id_centro_votacion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `discapacidad`
--
ALTER TABLE `discapacidad`
  MODIFY `id_discapacidad` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `embarazadas`
--
ALTER TABLE `embarazadas`
  MODIFY `id_embarazada` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `familias`
--
ALTER TABLE `familias`
  MODIFY `id_familia` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `familiasxpersonas`
--
ALTER TABLE `familiasxpersonas`
  MODIFY `id_familiasxpersonas` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `inmueble`
--
ALTER TABLE `inmueble`
  MODIFY `id_inmueble` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `modulos`
--
ALTER TABLE `modulos`
  MODIFY `id_modulo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `nivel_educativo`
--
ALTER TABLE `nivel_educativo`
  MODIFY `id_educativo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  MODIFY `id_notificacion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `permisos_usuario_modulo`
--
ALTER TABLE `permisos_usuario_modulo`
  MODIFY `id_permiso_usuario_modulo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `salud`
--
ALTER TABLE `salud`
  MODIFY `id_salud` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `vivienda`
--
ALTER TABLE `vivienda`
  MODIFY `id_vivienda` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `bitacora`
--
ALTER TABLE `bitacora`
  ADD CONSTRAINT `bitacora_ibfk_1` FOREIGN KEY (`cedula`) REFERENCES `usuarios` (`cedula`);

--
-- Filtros para la tabla `familias`
--
ALTER TABLE `familias`
  ADD CONSTRAINT `familias_ibfk_1` FOREIGN KEY (`id_vivienda`) REFERENCES `vivienda` (`id_vivienda`);

--
-- Filtros para la tabla `familiasxpersonas`
--
ALTER TABLE `familiasxpersonas`
  ADD CONSTRAINT `familiasxpersonas_ibfk_1` FOREIGN KEY (`cedula`) REFERENCES `personas` (`cedula`),
  ADD CONSTRAINT `familiasxpersonas_ibfk_2` FOREIGN KEY (`id_familia`) REFERENCES `familias` (`id_familia`);

--
-- Filtros para la tabla `inmueble`
--
ALTER TABLE `inmueble`
  ADD CONSTRAINT `inmueble_ibfk_1` FOREIGN KEY (`id_calle`) REFERENCES `calle` (`id_calle`);

--
-- Filtros para la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  ADD CONSTRAINT `notificaciones_ibfk_1` FOREIGN KEY (`usuario_emisor`) REFERENCES `usuarios` (`cedula`),
  ADD CONSTRAINT `notificaciones_ibfk_2` FOREIGN KEY (`usuario_receptor`) REFERENCES `usuarios` (`cedula`);

--
-- Filtros para la tabla `permisos_usuario_modulo`
--
ALTER TABLE `permisos_usuario_modulo`
  ADD CONSTRAINT `permisos_usuario_modulo_ibfk_1` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`cedula`),
  ADD CONSTRAINT `permisos_usuario_modulo_ibfk_2` FOREIGN KEY (`id_modulo`) REFERENCES `modulos` (`id_modulo`);

--
-- Filtros para la tabla `personas`
--
ALTER TABLE `personas`
  ADD CONSTRAINT `personas_ibfk_1` FOREIGN KEY (`id_salud`) REFERENCES `salud` (`id_salud`),
  ADD CONSTRAINT `personas_ibfk_2` FOREIGN KEY (`id_embarazada`) REFERENCES `embarazadas` (`id_embarazada`),
  ADD CONSTRAINT `personas_ibfk_3` FOREIGN KEY (`id_educativo`) REFERENCES `nivel_educativo` (`id_educativo`),
  ADD CONSTRAINT `personas_ibfk_4` FOREIGN KEY (`id_discapacidad`) REFERENCES `discapacidad` (`id_discapacidad`),
  ADD CONSTRAINT `personas_ibfk_5` FOREIGN KEY (`id_centro_votacion`) REFERENCES `centro_votacion` (`id_centro_votacion`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `personas_ibfk_6` FOREIGN KEY (`id_bonos`) REFERENCES `bonos` (`id_bonos`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `vivienda`
--
ALTER TABLE `vivienda`
  ADD CONSTRAINT `vivienda_ibfk_1` FOREIGN KEY (`id_calle`) REFERENCES `calle` (`id_calle`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
