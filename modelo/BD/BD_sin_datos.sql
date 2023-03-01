-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-10-2022 a las 03:58:06
-- Versión del servidor: 10.4.17-MariaDB
-- Versión de PHP: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `conco`
--

--
-- Estructura de tabla para la tabla `agenda`
--

CREATE TABLE `agenda` (
  `id_agenda` int(11) NOT NULL,
  `tipo_evento` text NOT NULL,
  `fecha` date NOT NULL,
  `creador` varchar(12) NOT NULL,
  `ubicacion` text NOT NULL,
  `horas` text NOT NULL,
  `detalle` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



--
-- Estructura de tabla para la tabla `bitacoras`
--

CREATE TABLE `bitacoras` (
  `id_bitacora` int(11) NOT NULL,
  `cedula_usuario` varchar(12) NOT NULL,
  `fecha` date NOT NULL,
  `dia` varchar(12) NOT NULL,
  `hora_inicio` varchar(15) NOT NULL,
  `acciones` text DEFAULT NULL,
  `hora_fin` varchar(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



--
-- Estructura de tabla para la tabla `bonos`
--

CREATE TABLE `bonos` (
  `id_bono` int(11) NOT NULL,
  `nombre_bono` text NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



--
-- Estructura de tabla para la tabla `calles`
--

CREATE TABLE `calles` (
  `id_calle` int(11) NOT NULL,
  `nombre_calle` varchar(30) NOT NULL,
  `condicion_calle` text DEFAULT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Estructura de tabla para la tabla `carnets`
--

CREATE TABLE `carnets` (
  `id_carnet` int(11) NOT NULL,
  `cedula_persona` varchar(12) NOT NULL,
  `serial_carnet` varchar(15) NOT NULL,
  `codigo_carnet` varchar(15) NOT NULL,
  `tipo_carnet` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Estructura de tabla para la tabla `centros_votacion`
--

CREATE TABLE `centros_votacion` (
  `id_centro_votacion` int(11) NOT NULL,
  `id_parroquia` int(11) NOT NULL,
  `nombre_centro` text NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Estructura de tabla para la tabla `comite`
--

CREATE TABLE `comite` (
  `id_comite` int(11) NOT NULL,
  `nombre_comite` text NOT NULL,
  `cantidad_personas` int(11) NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Estructura de tabla para la tabla `comite_persona`
--

CREATE TABLE `comite_persona` (
  `id_comite_persona` int(11) NOT NULL,
  `id_comite` int(11) NOT NULL,
  `cedula_persona` varchar(12) NOT NULL,
  `cargo_persona` varchar(20) NOT NULL,
  `fecha_ingreso` date NOT NULL,
  `fecha_salida` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Estructura de tabla para la tabla `comunidad_indigena`
--

CREATE TABLE `comunidad_indigena` (
  `id_comunidad_indigena` int(11) NOT NULL,
  `nombre_comunidad` text NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Estructura de tabla para la tabla `comunidad_indigena_personas`
--

CREATE TABLE `comunidad_indigena_personas` (
  `id_comunidad_persona` int(11) NOT NULL,
  `id_comunidad_indigena` int(11) NOT NULL,
  `cedula_persona` varchar(12) NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Estructura de tabla para la tabla `condicion_laboral`
--

CREATE TABLE `condicion_laboral` (
  `id_cond_laboral` int(11) NOT NULL,
  `cedula_persona` varchar(12) NOT NULL,
  `nombre_cond_laboral` text NOT NULL,
  `sector_laboral` int(11) NOT NULL,
  `pertenece` int(11) NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Estructura de tabla para la tabla `condicion_ocupacion`
--

CREATE TABLE `condicion_ocupacion` (
  `id_condicion_ocupacion` int(11) NOT NULL,
  `condicion_vivienda` varchar(25) NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Estructura de tabla para la tabla `deportes`
--

CREATE TABLE `deportes` (
  `id_deporte` int(11) NOT NULL,
  `nombre_deporte` text NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Estructura de tabla para la tabla `discapacidad`
--

CREATE TABLE `discapacidad` (
  `id_discapacidad` int(11) NOT NULL,
  `nombre_discapacidad` varchar(30) NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Estructura de tabla para la tabla `discapacidad_persona`
--

CREATE TABLE `discapacidad_persona` (
  `id_discapacidad_persona` int(11) NOT NULL,
  `cedula_persona` varchar(12) NOT NULL,
  `id_discapacidad` int(11) NOT NULL,
  `necesidades_discapacidad` text DEFAULT NULL,
  `observacion_discapacidad` text DEFAULT NULL,
  `en_cama` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Estructura de tabla para la tabla `electrodomesticos`
--

CREATE TABLE `electrodomesticos` (
  `id_electrodomestico` int(11) NOT NULL,
  `nombre_electrodomestico` varchar(30) NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Estructura de tabla para la tabla `enfermedades`
--

CREATE TABLE `enfermedades` (
  `id_enfermedad` int(11) NOT NULL,
  `nombre_enfermedad` varchar(30) NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Estructura de tabla para la tabla `familia`
--

CREATE TABLE `familia` (
  `id_familia` int(11) NOT NULL,
  `id_vivienda` int(11) NOT NULL,
  `condicion_ocupacion` varchar(30) NOT NULL,
  `nombre_familia` text NOT NULL,
  `observacion` text DEFAULT NULL,
  `telefono_familia` varchar(12) NOT NULL,
  `ingreso_mensual_aprox` varchar(20) NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Estructura de tabla para la tabla `familia_personas`
--

CREATE TABLE `familia_personas` (
  `id_familia_persona` int(11) NOT NULL,
  `id_familia` int(11) NOT NULL,
  `cedula_persona` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Estructura de tabla para la tabla `grupo_deportivo`
--

CREATE TABLE `grupo_deportivo` (
  `id_grupo_deportivo` int(11) NOT NULL,
  `id_deporte` int(11) NOT NULL,
  `nombre_grupo_deportivo` text NOT NULL,
  `descripcion` text DEFAULT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Estructura de tabla para la tabla `inmuebles`
--

CREATE TABLE `inmuebles` (
  `id_inmueble` int(11) NOT NULL,
  `id_calle` int(11) NOT NULL,
  `id_tipo_inmueble` int(11) NOT NULL,
  `nombre_inmueble` varchar(30) NOT NULL,
  `direccion_inmueble` text DEFAULT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Estructura de tabla para la tabla `misiones`
--

CREATE TABLE `misiones` (
  `id_mision` int(11) NOT NULL,
  `nombre_mision` varchar(35) NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



--
-- Estructura de tabla para la tabla `modulos`
--

CREATE TABLE `modulos` (
  `id_modulo` int(11) NOT NULL,
  `nombre` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Estructura de tabla para la tabla `municipios`
--

CREATE TABLE `municipios` (
  `id_municipio` int(11) NOT NULL,
  `nombre_municipio` text NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



--
-- Estructura de tabla para la tabla `negocios`
--

CREATE TABLE `negocios` (
  `id_negocio` int(11) NOT NULL,
  `id_calle` int(11) NOT NULL,
  `nombre_negocio` text NOT NULL,
  `direccion_negocio` text NOT NULL,
  `cedula_propietario` varchar(12) NOT NULL,
  `rif_negocio` text DEFAULT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Estructura de tabla para la tabla `notificaciones`
--

CREATE TABLE `notificaciones` (
  `id_notificacion` int(11) NOT NULL,
  `usuario_emisor` varchar(12) NOT NULL,
  `usuario_receptor` varchar(12) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp(),
  `accion` text NOT NULL,
  `leido` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Estructura de tabla para la tabla `ocupacion`
--

CREATE TABLE `ocupacion` (
  `id_ocupacion` int(11) NOT NULL,
  `nombre_ocupacion` text NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Estructura de tabla para la tabla `ocupacion_persona`
--

CREATE TABLE `ocupacion_persona` (
  `id_ocupacion_persona` int(11) NOT NULL,
  `cedula_persona` varchar(12) NOT NULL,
  `id_ocupacion` int(11) NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ocupacion_persona`
--

--
-- Estructura de tabla para la tabla `org_politica`
--

CREATE TABLE `org_politica` (
  `id_org_politica` int(11) NOT NULL,
  `nombre_org` text NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `org_politica`
--

--
-- Estructura de tabla para la tabla `org_politica_persona`
--

CREATE TABLE `org_politica_persona` (
  `id_org_persona` int(11) NOT NULL,
  `cedula_persona` varchar(12) NOT NULL,
  `id_org_politica` int(11) NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Estructura de tabla para la tabla `parroquias`
--

CREATE TABLE `parroquias` (
  `id_parroquia` int(11) NOT NULL,
  `id_municipio` int(11) NOT NULL,
  `nombre_parroquia` text NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `parroquias`
--

--
-- Estructura de tabla para la tabla `parto_humanizado`
--

CREATE TABLE `parto_humanizado` (
  `id_parto_humanizado` int(11) NOT NULL,
  `cedula_persona` varchar(12) NOT NULL,
  `recibe_micronutrientes` int(11) NOT NULL,
  `tiempo_gestacion` text NOT NULL,
  `fecha_aprox_parto` date DEFAULT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Estructura de tabla para la tabla `personas`
--

CREATE TABLE `personas` (
  `cedula_persona` varchar(12) NOT NULL,
  `primer_nombre` varchar(15) NOT NULL,
  `segundo_nombre` varchar(15) NOT NULL,
  `primer_apellido` varchar(15) NOT NULL,
  `segundo_apellido` varchar(15) NOT NULL,
  `nacionalidad` varchar(15) NOT NULL,
  `jefe_familia` int(11) NOT NULL,
  `propietario_vivienda` int(11) NOT NULL,
  `afrodescendencia` int(11) NOT NULL,
  `sexualidad` varchar(15) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `telefono` varchar(12) NOT NULL,
  `correo` varchar(80) DEFAULT NULL,
  `estado_civil` varchar(15) NOT NULL,
  `privado_libertad` varchar(15) NOT NULL,
  `genero` varchar(1) NOT NULL,
  `whatsapp` int(11) NOT NULL,
  `miliciano` int(11) NOT NULL,
  `antiguedad_comunidad` date NOT NULL,
  `jefe_calle` int(11) NOT NULL,
  `nivel_educativo` varchar(20) NOT NULL,
  `contrasenia` text NOT NULL,
  `rol_inicio` varchar(20) NOT NULL,
  `preguntas_seguridad` text DEFAULT NULL,
  `estado` int(11) NOT NULL,
  `user_locked` varchar(7) NOT NULL,
  `contrasenia_nueva` text DEFAULT NULL,
  `digital_sign` text DEFAULT NULL,
  `public_key` text DEFAULT NULL,
  `private_key` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



--
-- Estructura de tabla para la tabla `personas_enfermedades`
--

CREATE TABLE `personas_enfermedades` (
  `id_persona_enfermedad` int(11) NOT NULL,
  `cedula_persona` varchar(12) NOT NULL,
  `id_enfermedad` int(11) NOT NULL,
  `medicamentos` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Estructura de tabla para la tabla `personas_grupo_deportivo`
--

CREATE TABLE `personas_grupo_deportivo` (
  `id_persona_grupo_deportivo` int(11) NOT NULL,
  `cedula_persona` varchar(12) NOT NULL,
  `id_grupo_deportivo` int(11) NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Estructura de tabla para la tabla `persona_bonos`
--

CREATE TABLE `persona_bonos` (
  `id_persona_bono` int(11) NOT NULL,
  `cedula_persona` varchar(12) NOT NULL,
  `id_bono` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Estructura de tabla para la tabla `persona_misiones`
--

CREATE TABLE `persona_misiones` (
  `id_persona_mision` int(11) NOT NULL,
  `id_mision` int(11) NOT NULL,
  `cedula_persona` varchar(12) NOT NULL,
  `recibe_actualmente` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Estructura de tabla para la tabla `persona_proyecto`
--

CREATE TABLE `persona_proyecto` (
  `id_persona_proyecto` int(11) NOT NULL,
  `cedula_persona` varchar(12) NOT NULL,
  `id_proyecto` int(11) NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Estructura de tabla para la tabla `proyecto`
--

CREATE TABLE `proyecto` (
  `id_proyecto` int(11) NOT NULL,
  `nombre_proyecto` text NOT NULL,
  `area_proyecto` text NOT NULL,
  `estado_proyecto` varchar(15) NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Estructura de tabla para la tabla `roles_permisos_modulo`
--

CREATE TABLE `roles_permisos_modulo` (
  `id_rol_permiso_modulo` int(11) NOT NULL,
  `rol` varchar(20) NOT NULL,
  `id_modulo` int(11) NOT NULL,
  `registrar` int(11) NOT NULL,
  `consultar` int(11) NOT NULL,
  `modificar` int(11) NOT NULL,
  `eliminar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Estructura de tabla para la tabla `sector_agricola`
--

CREATE TABLE `sector_agricola` (
  `id_sector_agricola` int(11) NOT NULL,
  `cedula_persona` varchar(12) NOT NULL,
  `area_produccion` text NOT NULL,
  `anios_experiencia` int(11) NOT NULL,
  `rubro_principal` text NOT NULL,
  `rubro_alternativo` text NOT NULL,
  `registro_INTI` int(11) NOT NULL,
  `constancia_productor` int(11) NOT NULL,
  `senial_hierro` int(11) NOT NULL,
  `financiado` text NOT NULL,
  `agua_riego` int(11) NOT NULL,
  `produccion_actual` int(11) NOT NULL,
  `org_agricola` text NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Estructura de tabla para la tabla `servicios`
--

CREATE TABLE `servicios` (
  `id_servicio` int(11) NOT NULL,
  `agua_consumo` varchar(20) NOT NULL,
  `residuos_solidos` varchar(20) NOT NULL,
  `aguas_negras` varchar(20) NOT NULL,
  `cable_telefonico` int(11) NOT NULL,
  `internet` int(11) NOT NULL,
  `servicio_electrico` int(11) NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Estructura de tabla para la tabla `servicio_gas`
--

CREATE TABLE `servicio_gas` (
  `id_servicio_gas` int(11) NOT NULL,
  `nombre_servicio_gas` varchar(35) NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Estructura de tabla para la tabla `solicitudes`
--

CREATE TABLE `solicitudes` (
  `id_solicitud` int(11) NOT NULL,
  `cedula_persona` varchar(12) NOT NULL,
  `fecha_solicitud` datetime NOT NULL DEFAULT current_timestamp(),
  `tipo_constancia` varchar(30) NOT NULL,
  `procesada` int(11) NOT NULL,
  `motivo_constancia` text NOT NULL,
  `observaciones` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Estructura de tabla para la tabla `tipo_inmueble`
--

CREATE TABLE `tipo_inmueble` (
  `id_tipo_inmueble` int(11) NOT NULL,
  `nombre_tipo` text NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Estructura de tabla para la tabla `tipo_pared`
--

CREATE TABLE `tipo_pared` (
  `id_tipo_pared` int(11) NOT NULL,
  `pared` text NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Estructura de tabla para la tabla `tipo_piso`
--

CREATE TABLE `tipo_piso` (
  `id_tipo_piso` int(11) NOT NULL,
  `piso` text NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Estructura de tabla para la tabla `tipo_techo`
--

CREATE TABLE `tipo_techo` (
  `id_tipo_techo` int(11) NOT NULL,
  `techo` text NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Estructura de tabla para la tabla `tipo_vivienda`
--

CREATE TABLE `tipo_vivienda` (
  `id_tipo_vivienda` int(11) NOT NULL,
  `nombre_tipo_vivienda` text NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Estructura de tabla para la tabla `transporte`
--

CREATE TABLE `transporte` (
  `id_transporte` int(11) NOT NULL,
  `cedula_propietario` varchar(12) NOT NULL,
  `descripcion_transporte` text NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Estructura de tabla para la tabla `vacuna_covid`
--

CREATE TABLE `vacuna_covid` (
  `id_vacuna_covid` int(11) NOT NULL,
  `cedula_persona` varchar(12) NOT NULL,
  `dosis` varchar(30) NOT NULL,
  `fecha_vacuna` date NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Estructura de tabla para la tabla `vivienda`
--

CREATE TABLE `vivienda` (
  `id_vivienda` int(11) NOT NULL,
  `id_calle` int(11) NOT NULL,
  `id_tipo_vivienda` int(11) NOT NULL,
  `id_servicio` int(11) NOT NULL,
  `direccion_vivienda` text NOT NULL,
  `numero_casa` text NOT NULL,
  `cantidad_habitaciones` int(11) NOT NULL,
  `espacio_siembra` int(11) NOT NULL,
  `hacinamiento` int(11) NOT NULL,
  `banio_sanitario` int(11) NOT NULL,
  `condicion` varchar(20) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `estado` int(11) NOT NULL,
  `animales_domesticos` int(11) NOT NULL,
  `insectos_roedores` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Estructura de tabla para la tabla `vivienda_electrodomesticos`
--

CREATE TABLE `vivienda_electrodomesticos` (
  `id_vivienda_electrodomestico` int(11) NOT NULL,
  `id_electrodomestico` int(11) NOT NULL,
  `id_vivienda` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Estructura de tabla para la tabla `vivienda_servicio_gas`
--

CREATE TABLE `vivienda_servicio_gas` (
  `id_vivienda_servicio_gas` int(11) NOT NULL,
  `id_servicio_gas` int(11) NOT NULL,
  `id_vivienda` int(11) NOT NULL,
  `tipo_bombona` varchar(5) NOT NULL,
  `dias_duracion` int(11) NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Estructura de tabla para la tabla `vivienda_tipo_pared`
--

CREATE TABLE `vivienda_tipo_pared` (
  `id_vivienda_tipo_pared` int(11) NOT NULL,
  `id_tipo_pared` int(11) NOT NULL,
  `id_vivienda` int(11) NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Estructura de tabla para la tabla `vivienda_tipo_piso`
--

CREATE TABLE `vivienda_tipo_piso` (
  `id_vivienda_tipo_piso` int(11) NOT NULL,
  `id_tipo_piso` int(11) NOT NULL,
  `id_vivienda` int(11) NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Estructura de tabla para la tabla `vivienda_tipo_techo`
--

CREATE TABLE `vivienda_tipo_techo` (
  `id_vivienda_tipo_techo` int(11) NOT NULL,
  `id_tipo_techo` int(11) NOT NULL,
  `id_vivienda` int(11) NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Estructura de tabla para la tabla `votantes_centro_votacion`
--

CREATE TABLE `votantes_centro_votacion` (
  `id_votante_centro_votacion` int(11) NOT NULL,
  `id_centro_votacion` int(11) NOT NULL,
  `cedula_votante` varchar(12) NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Indices de la tabla `agenda`
--
ALTER TABLE `agenda`
  ADD PRIMARY KEY (`id_agenda`),
  ADD KEY `creador` (`creador`);

--
-- Indices de la tabla `bitacoras`
--
ALTER TABLE `bitacoras`
  ADD PRIMARY KEY (`id_bitacora`),
  ADD KEY `cedula_usuario` (`cedula_usuario`);

--
-- Indices de la tabla `bonos`
--
ALTER TABLE `bonos`
  ADD PRIMARY KEY (`id_bono`);

--
-- Indices de la tabla `calles`
--
ALTER TABLE `calles`
  ADD PRIMARY KEY (`id_calle`);

--
-- Indices de la tabla `carnets`
--
ALTER TABLE `carnets`
  ADD PRIMARY KEY (`id_carnet`),
  ADD KEY `cedula_persona` (`cedula_persona`);

--
-- Indices de la tabla `centros_votacion`
--
ALTER TABLE `centros_votacion`
  ADD PRIMARY KEY (`id_centro_votacion`),
  ADD KEY `id_parroquia` (`id_parroquia`);

--
-- Indices de la tabla `comite`
--
ALTER TABLE `comite`
  ADD PRIMARY KEY (`id_comite`);

--
-- Indices de la tabla `comite_persona`
--
ALTER TABLE `comite_persona`
  ADD PRIMARY KEY (`id_comite_persona`),
  ADD KEY `cedula_persona` (`cedula_persona`),
  ADD KEY `id_comite` (`id_comite`);

--
-- Indices de la tabla `comunidad_indigena`
--
ALTER TABLE `comunidad_indigena`
  ADD PRIMARY KEY (`id_comunidad_indigena`);

--
-- Indices de la tabla `comunidad_indigena_personas`
--
ALTER TABLE `comunidad_indigena_personas`
  ADD PRIMARY KEY (`id_comunidad_persona`),
  ADD KEY `cedula_persona` (`cedula_persona`),
  ADD KEY `id_comunidad_indigena` (`id_comunidad_indigena`);

--
-- Indices de la tabla `condicion_laboral`
--
ALTER TABLE `condicion_laboral`
  ADD PRIMARY KEY (`id_cond_laboral`),
  ADD KEY `cedula_persona` (`cedula_persona`);

--
-- Indices de la tabla `condicion_ocupacion`
--
ALTER TABLE `condicion_ocupacion`
  ADD PRIMARY KEY (`id_condicion_ocupacion`);

--
-- Indices de la tabla `deportes`
--
ALTER TABLE `deportes`
  ADD PRIMARY KEY (`id_deporte`);

--
-- Indices de la tabla `discapacidad`
--
ALTER TABLE `discapacidad`
  ADD PRIMARY KEY (`id_discapacidad`);

--
-- Indices de la tabla `discapacidad_persona`
--
ALTER TABLE `discapacidad_persona`
  ADD PRIMARY KEY (`id_discapacidad_persona`),
  ADD KEY `cedula_persona` (`cedula_persona`),
  ADD KEY `id_discapacidad` (`id_discapacidad`);

--
-- Indices de la tabla `electrodomesticos`
--
ALTER TABLE `electrodomesticos`
  ADD PRIMARY KEY (`id_electrodomestico`);

--
-- Indices de la tabla `enfermedades`
--
ALTER TABLE `enfermedades`
  ADD PRIMARY KEY (`id_enfermedad`);

--
-- Indices de la tabla `familia`
--
ALTER TABLE `familia`
  ADD PRIMARY KEY (`id_familia`),
  ADD KEY `id_vivienda` (`id_vivienda`);

--
-- Indices de la tabla `familia_personas`
--
ALTER TABLE `familia_personas`
  ADD PRIMARY KEY (`id_familia_persona`),
  ADD KEY `cedula_persona` (`cedula_persona`),
  ADD KEY `id_familia` (`id_familia`);

--
-- Indices de la tabla `grupo_deportivo`
--
ALTER TABLE `grupo_deportivo`
  ADD PRIMARY KEY (`id_grupo_deportivo`),
  ADD KEY `id_deporte` (`id_deporte`);

--
-- Indices de la tabla `inmuebles`
--
ALTER TABLE `inmuebles`
  ADD PRIMARY KEY (`id_inmueble`),
  ADD KEY `id_calle` (`id_calle`),
  ADD KEY `id_tipo_inmueble` (`id_tipo_inmueble`);

--
-- Indices de la tabla `misiones`
--
ALTER TABLE `misiones`
  ADD PRIMARY KEY (`id_mision`);

--
-- Indices de la tabla `modulos`
--
ALTER TABLE `modulos`
  ADD PRIMARY KEY (`id_modulo`);

--
-- Indices de la tabla `municipios`
--
ALTER TABLE `municipios`
  ADD PRIMARY KEY (`id_municipio`);

--
-- Indices de la tabla `negocios`
--
ALTER TABLE `negocios`
  ADD PRIMARY KEY (`id_negocio`),
  ADD KEY `cedula_propietario` (`cedula_propietario`);

--
-- Indices de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  ADD PRIMARY KEY (`id_notificacion`),
  ADD KEY `usuario_emisor` (`usuario_emisor`),
  ADD KEY `usuario_receptor` (`usuario_receptor`);

--
-- Indices de la tabla `ocupacion`
--
ALTER TABLE `ocupacion`
  ADD PRIMARY KEY (`id_ocupacion`);

--
-- Indices de la tabla `ocupacion_persona`
--
ALTER TABLE `ocupacion_persona`
  ADD PRIMARY KEY (`id_ocupacion_persona`),
  ADD KEY `cedula_persona` (`cedula_persona`),
  ADD KEY `id_ocupacion` (`id_ocupacion`);

--
-- Indices de la tabla `org_politica`
--
ALTER TABLE `org_politica`
  ADD PRIMARY KEY (`id_org_politica`);

--
-- Indices de la tabla `org_politica_persona`
--
ALTER TABLE `org_politica_persona`
  ADD PRIMARY KEY (`id_org_persona`),
  ADD KEY `cedula_persona` (`cedula_persona`),
  ADD KEY `id_org_politica` (`id_org_politica`);

--
-- Indices de la tabla `parroquias`
--
ALTER TABLE `parroquias`
  ADD PRIMARY KEY (`id_parroquia`),
  ADD KEY `id_municipio` (`id_municipio`);

--
-- Indices de la tabla `parto_humanizado`
--
ALTER TABLE `parto_humanizado`
  ADD PRIMARY KEY (`id_parto_humanizado`),
  ADD KEY `cedula_persona` (`cedula_persona`);

--
-- Indices de la tabla `personas`
--
ALTER TABLE `personas`
  ADD PRIMARY KEY (`cedula_persona`);

--
-- Indices de la tabla `personas_enfermedades`
--
ALTER TABLE `personas_enfermedades`
  ADD PRIMARY KEY (`id_persona_enfermedad`),
  ADD KEY `cedula_persona` (`cedula_persona`),
  ADD KEY `id_enfermedad` (`id_enfermedad`);

--
-- Indices de la tabla `personas_grupo_deportivo`
--
ALTER TABLE `personas_grupo_deportivo`
  ADD PRIMARY KEY (`id_persona_grupo_deportivo`),
  ADD KEY `cedula_persona` (`cedula_persona`),
  ADD KEY `id_grupo_deportivo` (`id_grupo_deportivo`);

--
-- Indices de la tabla `persona_bonos`
--
ALTER TABLE `persona_bonos`
  ADD PRIMARY KEY (`id_persona_bono`),
  ADD KEY `cedula_persona` (`cedula_persona`),
  ADD KEY `id_bono` (`id_bono`);

--
-- Indices de la tabla `persona_misiones`
--
ALTER TABLE `persona_misiones`
  ADD PRIMARY KEY (`id_persona_mision`),
  ADD KEY `cedula_persona` (`cedula_persona`),
  ADD KEY `id_mision` (`id_mision`);

--
-- Indices de la tabla `persona_proyecto`
--
ALTER TABLE `persona_proyecto`
  ADD PRIMARY KEY (`id_persona_proyecto`),
  ADD KEY `cedula_persona` (`cedula_persona`),
  ADD KEY `id_proyecto` (`id_proyecto`);

--
-- Indices de la tabla `proyecto`
--
ALTER TABLE `proyecto`
  ADD PRIMARY KEY (`id_proyecto`);

--
-- Indices de la tabla `roles_permisos_modulo`
--
ALTER TABLE `roles_permisos_modulo`
  ADD PRIMARY KEY (`id_rol_permiso_modulo`);

--
-- Indices de la tabla `sector_agricola`
--
ALTER TABLE `sector_agricola`
  ADD PRIMARY KEY (`id_sector_agricola`),
  ADD KEY `cedula_persona` (`cedula_persona`);

--
-- Indices de la tabla `servicios`
--
ALTER TABLE `servicios`
  ADD PRIMARY KEY (`id_servicio`);

--
-- Indices de la tabla `servicio_gas`
--
ALTER TABLE `servicio_gas`
  ADD PRIMARY KEY (`id_servicio_gas`);

--
-- Indices de la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
  ADD PRIMARY KEY (`id_solicitud`),
  ADD KEY `cedula_persona` (`cedula_persona`);

--
-- Indices de la tabla `tipo_inmueble`
--
ALTER TABLE `tipo_inmueble`
  ADD PRIMARY KEY (`id_tipo_inmueble`);

--
-- Indices de la tabla `tipo_pared`
--
ALTER TABLE `tipo_pared`
  ADD PRIMARY KEY (`id_tipo_pared`);

--
-- Indices de la tabla `tipo_piso`
--
ALTER TABLE `tipo_piso`
  ADD PRIMARY KEY (`id_tipo_piso`);

--
-- Indices de la tabla `tipo_techo`
--
ALTER TABLE `tipo_techo`
  ADD PRIMARY KEY (`id_tipo_techo`);

--
-- Indices de la tabla `tipo_vivienda`
--
ALTER TABLE `tipo_vivienda`
  ADD PRIMARY KEY (`id_tipo_vivienda`);

--
-- Indices de la tabla `transporte`
--
ALTER TABLE `transporte`
  ADD PRIMARY KEY (`id_transporte`),
  ADD KEY `transporte_ibfk_1` (`cedula_propietario`);

--
-- Indices de la tabla `vacuna_covid`
--
ALTER TABLE `vacuna_covid`
  ADD PRIMARY KEY (`id_vacuna_covid`),
  ADD KEY `cedula_persona` (`cedula_persona`);

--
-- Indices de la tabla `vivienda`
--
ALTER TABLE `vivienda`
  ADD PRIMARY KEY (`id_vivienda`),
  ADD KEY `id_calle` (`id_calle`),
  ADD KEY `id_tipo_vivienda` (`id_tipo_vivienda`),
  ADD KEY `id_servicio` (`id_servicio`);

--
-- Indices de la tabla `vivienda_electrodomesticos`
--
ALTER TABLE `vivienda_electrodomesticos`
  ADD PRIMARY KEY (`id_vivienda_electrodomestico`),
  ADD KEY `id_vivienda` (`id_vivienda`),
  ADD KEY `id_electrodomestico` (`id_electrodomestico`);

--
-- Indices de la tabla `vivienda_servicio_gas`
--
ALTER TABLE `vivienda_servicio_gas`
  ADD PRIMARY KEY (`id_vivienda_servicio_gas`),
  ADD KEY `id_vivienda` (`id_vivienda`),
  ADD KEY `id_servicio_gas` (`id_servicio_gas`);

--
-- Indices de la tabla `vivienda_tipo_pared`
--
ALTER TABLE `vivienda_tipo_pared`
  ADD PRIMARY KEY (`id_vivienda_tipo_pared`),
  ADD KEY `id_vivienda` (`id_vivienda`),
  ADD KEY `id_tipo_pared` (`id_tipo_pared`);

--
-- Indices de la tabla `vivienda_tipo_piso`
--
ALTER TABLE `vivienda_tipo_piso`
  ADD PRIMARY KEY (`id_vivienda_tipo_piso`),
  ADD KEY `id_vivienda` (`id_vivienda`),
  ADD KEY `id_tipo_piso` (`id_tipo_piso`);

--
-- Indices de la tabla `vivienda_tipo_techo`
--
ALTER TABLE `vivienda_tipo_techo`
  ADD PRIMARY KEY (`id_vivienda_tipo_techo`),
  ADD KEY `id_vivienda` (`id_vivienda`),
  ADD KEY `id_tipo_techo` (`id_tipo_techo`);

--
-- Indices de la tabla `votantes_centro_votacion`
--
ALTER TABLE `votantes_centro_votacion`
  ADD PRIMARY KEY (`id_votante_centro_votacion`),
  ADD KEY `id_centro_votacion` (`id_centro_votacion`),
  ADD KEY `cedula_votante` (`cedula_votante`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `agenda`
--
ALTER TABLE `agenda`
  MODIFY `id_agenda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT de la tabla `bitacoras`
--
ALTER TABLE `bitacoras`
  MODIFY `id_bitacora` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=304;

--
-- AUTO_INCREMENT de la tabla `bonos`
--
ALTER TABLE `bonos`
  MODIFY `id_bono` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `calles`
--
ALTER TABLE `calles`
  MODIFY `id_calle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `carnets`
--
ALTER TABLE `carnets`
  MODIFY `id_carnet` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `centros_votacion`
--
ALTER TABLE `centros_votacion`
  MODIFY `id_centro_votacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `comite`
--
ALTER TABLE `comite`
  MODIFY `id_comite` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `comite_persona`
--
ALTER TABLE `comite_persona`
  MODIFY `id_comite_persona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `comunidad_indigena`
--
ALTER TABLE `comunidad_indigena`
  MODIFY `id_comunidad_indigena` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `comunidad_indigena_personas`
--
ALTER TABLE `comunidad_indigena_personas`
  MODIFY `id_comunidad_persona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `condicion_laboral`
--
ALTER TABLE `condicion_laboral`
  MODIFY `id_cond_laboral` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `condicion_ocupacion`
--
ALTER TABLE `condicion_ocupacion`
  MODIFY `id_condicion_ocupacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `deportes`
--
ALTER TABLE `deportes`
  MODIFY `id_deporte` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `discapacidad`
--
ALTER TABLE `discapacidad`
  MODIFY `id_discapacidad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `discapacidad_persona`
--
ALTER TABLE `discapacidad_persona`
  MODIFY `id_discapacidad_persona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `electrodomesticos`
--
ALTER TABLE `electrodomesticos`
  MODIFY `id_electrodomestico` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `enfermedades`
--
ALTER TABLE `enfermedades`
  MODIFY `id_enfermedad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `familia`
--
ALTER TABLE `familia`
  MODIFY `id_familia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `familia_personas`
--
ALTER TABLE `familia_personas`
  MODIFY `id_familia_persona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT de la tabla `grupo_deportivo`
--
ALTER TABLE `grupo_deportivo`
  MODIFY `id_grupo_deportivo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `inmuebles`
--
ALTER TABLE `inmuebles`
  MODIFY `id_inmueble` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `misiones`
--
ALTER TABLE `misiones`
  MODIFY `id_mision` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `modulos`
--
ALTER TABLE `modulos`
  MODIFY `id_modulo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `municipios`
--
ALTER TABLE `municipios`
  MODIFY `id_municipio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `negocios`
--
ALTER TABLE `negocios`
  MODIFY `id_negocio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  MODIFY `id_notificacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `ocupacion`
--
ALTER TABLE `ocupacion`
  MODIFY `id_ocupacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `ocupacion_persona`
--
ALTER TABLE `ocupacion_persona`
  MODIFY `id_ocupacion_persona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `org_politica`
--
ALTER TABLE `org_politica`
  MODIFY `id_org_politica` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `org_politica_persona`
--
ALTER TABLE `org_politica_persona`
  MODIFY `id_org_persona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `parroquias`
--
ALTER TABLE `parroquias`
  MODIFY `id_parroquia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT de la tabla `parto_humanizado`
--
ALTER TABLE `parto_humanizado`
  MODIFY `id_parto_humanizado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `personas_enfermedades`
--
ALTER TABLE `personas_enfermedades`
  MODIFY `id_persona_enfermedad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `personas_grupo_deportivo`
--
ALTER TABLE `personas_grupo_deportivo`
  MODIFY `id_persona_grupo_deportivo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `persona_bonos`
--
ALTER TABLE `persona_bonos`
  MODIFY `id_persona_bono` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `persona_misiones`
--
ALTER TABLE `persona_misiones`
  MODIFY `id_persona_mision` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `persona_proyecto`
--
ALTER TABLE `persona_proyecto`
  MODIFY `id_persona_proyecto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `proyecto`
--
ALTER TABLE `proyecto`
  MODIFY `id_proyecto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `roles_permisos_modulo`
--
ALTER TABLE `roles_permisos_modulo`
  MODIFY `id_rol_permiso_modulo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT de la tabla `sector_agricola`
--
ALTER TABLE `sector_agricola`
  MODIFY `id_sector_agricola` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `servicios`
--
ALTER TABLE `servicios`
  MODIFY `id_servicio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `servicio_gas`
--
ALTER TABLE `servicio_gas`
  MODIFY `id_servicio_gas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
  MODIFY `id_solicitud` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `tipo_inmueble`
--
ALTER TABLE `tipo_inmueble`
  MODIFY `id_tipo_inmueble` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `tipo_pared`
--
ALTER TABLE `tipo_pared`
  MODIFY `id_tipo_pared` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `tipo_piso`
--
ALTER TABLE `tipo_piso`
  MODIFY `id_tipo_piso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
