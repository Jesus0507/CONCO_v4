-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-12-2021 a las 17:27:35
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
-- Estructura de tabla para la tabla `agenda`
--

CREATE TABLE `agenda` (
  `id_agenda` int(11) NOT NULL,
  `tipo_evento` text NOT NULL,
  `fecha` date NOT NULL,
  `creador` varchar(12) NOT NULL,
  `ubicacion` text NOT NULL,
  `horas` text NOT NULL,
  `detalle` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `agenda`
--

INSERT INTO `agenda` (`id_agenda`, `tipo_evento`, `fecha`, `creador`, `ubicacion`, `horas`, `detalle`) VALUES
(1, 'Probando', '2021-12-14', '654321', 'Calle 15', 'De 08:00 AM hasta 11:00 AM', ''),
(2, 'Probando', '2021-12-17', '654321', 'Calle 15', 'De 08:00 AM hasta 11:00 AM', ''),
(3, 'Probando', '2022-01-05', '654321', 'Calle 15', 'De 08:00 AM hasta 11:00 AM', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bitacoras`
--

CREATE TABLE `bitacoras` (
  `id_bitacora` int(11) NOT NULL,
  `cedula_usuario` varchar(12) NOT NULL,
  `fecha` date NOT NULL,
  `dia` varchar(12) NOT NULL,
  `hora_inicio` varchar(15) NOT NULL,
  `acciones` text,
  `hora_fin` varchar(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `bitacoras`
--

INSERT INTO `bitacoras` (`id_bitacora`, `cedula_usuario`, `fecha`, `dia`, `hora_inicio`, `acciones`, `hora_fin`) VALUES
(17, '654321', '2021-11-03', 'Miercoles', '04:27:16 PM', 'Salió del módulo Inicio a las 3 de la tarde con 49 minutos/Ingresó al módulo Registrar usuarios a las 3 de la tarde con 49 minutos/Salió del módulo Registrar usuarios a las 3 de la tarde con 49 minutos/Ingresó al módulo Consultar bitacora a las 3 de la tarde con 49 minutos/Salió del módulo Inicio a las 3 de la tarde con 50 minutos/Ingresó al módulo Consultar bitacora a las 3 de la tarde con 50 minutos/Salió del módulo Consultar bitacora a las 7 de la noche con 23 minutos/Ingresó al módulo Registrar personas a las 7 de la noche con 23 minutos/Salió del módulo Inicio a las 7 de la noche con 50 minutos/Ingresó al módulo Registrar personas a las 7 de la noche con 50 minutos/Salió del módulo Inicio a las 9 de la mañana con 15 minutos/Ingresó al módulo Registrar personas a las 9 de la mañana con 15 minutos/Salió del módulo Registrar personas a las 10 de la mañana con 8 minutos/Ingresó al módulo Seguridad (Gestionar roles y permisos) a las 10 de la mañana con 8 minutos/Salió del módulo Inicio a las 2 de la tarde con 56 minutos/Ingresó al módulo Registrar personas a las 2 de la tarde con 56 minutos/Salió del módulo Inicio a las 12 del medio día con 56 minutos/Ingresó al módulo Generar Censos a las 12 del medio día con 56 minutos/Salió del módulo Generar Censos a las 12 del medio día con 58 minutos/Ingresó al módulo Inicio a las 12 del medio día con 58 minutos/Salió del módulo Inicio a las 12 del medio día con 59 minutos/Ingresó al módulo Solicitar Ayuda a las 12 del medio día con 59 minutos/Salió del módulo Solicitar Ayuda a las 1 de la tarde con 3 minutos/Ingresó al módulo Registrar personas a las 1 de la tarde con 3 minutos/Salió del módulo Inicio a las 8 de la noche con 7 minutos/Ingresó al módulo Registrar personas a las 8 de la noche con 7 minutos/Salió del módulo Registrar personas a las 10 de la mañana con 43 minutos/Ingresó al módulo Seguridad (Gestionar roles y permisos) a las 10 de la mañana con 43 minutos/Salió del módulo Seguridad (Gestionar roles y permisos) a las 7 de la noche con 9 minutos/Ingresó al módulo Inicio a las 7 de la noche con 9 minutos/Salió del módulo Inicio a las 8 de la noche con 28 minutos/Ingresó al módulo Crear evento a las 8 de la noche con 28 minutos/Salió del módulo Inicio a las 8 de la noche con 39 minutos/Ingresó al módulo Crear evento a las 8 de la noche con 39 minutos/Ingresó al módulo Consultar eventos a las 7 de la mañana con 58 minutos/Salió del módulo Inicio a las 7 de la mañana con 58 minutos/Salió del módulo Consultar eventos a las 8 de la mañana con 37 minutos/Ingresó al módulo Seguridad (Gestionar roles y permisos) a las 8 de la mañana con 37 minutos/Salió del módulo Seguridad (Gestionar roles y permisos) a las 8 de la mañana con 45 minutos/Ingresó al módulo Consultar personas a las 8 de la mañana con 45 minutos/Salió del módulo Consultar personas a las 9 de la mañana con 5 minutos/Ingresó al módulo Consultar familias a las 9 de la mañana con 5 minutos/Salió del módulo Consultar familias a las 3 de la tarde con 2 minutos/Ingresó al módulo Consultar personas a las 3 de la tarde con 2 minutos/Salió del módulo Consultar personas a las 4 de la tarde con 5 minutos/Ingresó al módulo Registrar viviendas a las 4 de la tarde con 5 minutos/Salió del módulo Registrar viviendas a las 5 de la tarde con 57 minutos/Ingresó al módulo Registrar familia a las 5 de la tarde con 57 minutos/Salió del módulo Registrar familia a las 7 de la noche con 21 minutos/Ingresó al módulo Registrar viviendas a las 7 de la noche con 21 minutos/Salió del módulo Registrar viviendas a las 9 de la mañana con 3 minutos/Ingresó al módulo Seguridad (Gestionar roles y permisos) a las 9 de la mañana con 3 minutos/Salió del módulo Inicio a las 9 de la mañana con 22 minutos/Ingresó al módulo Registrar viviendas a las 9 de la mañana con 22 minutos/Salió del módulo Seguridad (Gestionar roles y permisos) a las 11 de la mañana con 25 minutos/Ingresó al módulo Solicitudes a las 11 de la mañana con 25 minutos/Salió del módulo Registrar viviendas a las 11 de la mañana con 34 minutos/Ingresó al módulo Seguridad (Gestionar roles y permisos) a las 11 de la mañana con 34 minutos/Salió del módulo Inicio a las 11 de la mañana con 45 minutos/Ingresó al módulo Registrar viviendas a las 11 de la mañana con 45 minutos/Salió del módulo Registrar viviendas a las 12 del medio día con 39 minutos/Ingresó al módulo Consultar eventos a las 12 del medio día con 39 minutos/Salió del módulo Consultar eventos a las 12 del medio día con 48 minutos/Ingresó al módulo Registrar personas a las 12 del medio día con 48 minutos/Salió del módulo Registrar personas a las 12 del medio día con 57 minutos/Ingresó al módulo Consultar personas a las 12 del medio día con 57 minutos/Salió del módulo Registrar personas a las 12 del medio día con 57 minutos/Ingresó al módulo Consultar personas a las 12 del medio día con 57 minutos/Salió del módulo Consultar personas a las 12 del medio día con 58 minutos/Ingresó al módulo Consultar eventos a las 12 del medio día con 58 minutos/Salió del módulo Inicio a las 1 de la tarde con 51 minutos/Ingresó al módulo Registrar viviendas a las 1 de la tarde con 51 minutos/Salió del módulo Registrar viviendas a las 2 de la tarde con 18 minutos/Ingresó al módulo Registrar personas a las 2 de la tarde con 18 minutos/Salió del módulo Registrar personas a las 2 de la tarde con 19 minutos/Ingresó al módulo Registrar viviendas a las 2 de la tarde con 19 minutos/Salió del módulo Registrar viviendas a las 2 de la tarde con 36 minutos/Ingresó al módulo Registrar inmuebles a las 2 de la tarde con 36 minutos/Salió del módulo Registrar inmuebles a las 2 de la tarde con 40 minutos/Ingresó al módulo Registrar personas a las 2 de la tarde con 40 minutos/Salió del módulo Registrar personas a las 2 de la tarde con 41 minutos/Ingresó al módulo Consultar personas a las 2 de la tarde con 41 minutos/Salió del módulo Consultar personas a las 3 de la tarde con 8 minutos/Ingresó al módulo Seguridad (Gestionar roles y permisos) a las 3 de la tarde con 8 minutos/Salió del módulo Consultar personas a las 3 de la tarde con 8 minutos/Ingresó al módulo Seguridad (Gestionar roles y permisos) a las 3 de la tarde con 8 minutos/Salió del módulo Seguridad (Gestionar roles y permisos) a las 3 de la tarde con 9 minutos/Ingresó al módulo Registrar viviendas a las 3 de la tarde con 9 minutos/Salió del módulo Registrar viviendas a las 4 de la tarde con 2 minutos/Ingresó al módulo Consultar eventos a las 4 de la tarde con 2 minutos/Salió del módulo Inicio a las 9 de la noche con 10 minutos/Ingresó al módulo Consultar viviendas a las 9 de la noche con 10 minutos/Salió del módulo Consultar viviendas a las 9 de la noche con 11 minutos/Ingresó al módulo Crear evento a las 9 de la noche con 11 minutos/Salió del módulo Crear evento a las de la noche con 16 minutos/Ingresó al módulo Notificaciones a las de la noche con 16 minutos/Salió del módulo Notificaciones a las de la noche con 26 minutos/Ingresó al módulo Seguridad (Gestionar roles y permisos) a las de la noche con 26 minutos/Salió del módulo Seguridad (Gestionar roles y permisos) a las de la noche con 27 minutos/Ingresó al módulo Notificaciones a las de la noche con 27 minutos/Salió del módulo Inicio a las 7 de la mañana con 19 minutos/Ingresó al módulo Consultar viviendas a las 7 de la mañana con 19 minutos/Salió del módulo Consultar viviendas a las 9 de la mañana con 9 minutos/Ingresó al módulo Registrar enfermos a las 9 de la mañana con 9 minutos/Salió del módulo Registrar enfermos a las 9 de la mañana con 13 minutos/Ingresó al módulo Inicio a las 9 de la mañana con 13 minutos/Salió del módulo Inicio a las 9 de la mañana con 19 minutos/Ingresó al módulo Registrar familia a las 9 de la mañana con 19 minutos/Salió del módulo Inicio a las 10 de la mañana con 31 minutos/Ingresó al módulo Registrar enfermos a las 10 de la mañana con 31 minutos/Salió del módulo Registrar enfermos a las 1 de la tarde con 43 minutos/Ingresó al módulo Registrar familia a las 1 de la tarde con 43 minutos/Salió del módulo Registrar familia a las 1 de la tarde con 43 minutos/Ingresó al módulo Consultar familias a las 1 de la tarde con 43 minutos/Salió del módulo Consultar familias a las 1 de la tarde con 58 minutos/Ingresó al módulo Consultar enfermos a las 1 de la tarde con 58 minutos/Salió del módulo Consultar enfermos a las 2 de la tarde con 54 minutos/Ingresó al módulo Registrar negocios a las 2 de la tarde con 54 minutos/Registro de Negocio: dfg Exitosamente./Negocio:  Actualizado Exitosamente./Negocio:  Actualizado Exitosamente./Negocio:  Actualizado Exitosamente./Negocio:  Actualizado Exitosamente./Salió del módulo Registrar negocios a las 2 de la tarde con 55 minutos/Ingresó al módulo Inicio a las 2 de la tarde con 55 minutos/Salió del módulo Inicio a las 5 de la tarde con 4 minutos/Ingresó al módulo Registrar discapacitados a las 5 de la tarde con 4 minutos/Salió del módulo Registrar discapacitados a las 5 de la tarde con 16 minutos/Ingresó al módulo Consejo Comunal Consultas a las 5 de la tarde con 16 minutos/Salió del módulo Consejo Comunal Consultas a las 5 de la tarde con 17 minutos/Ingresó al módulo Registrar discapacitados a las 5 de la tarde con 17 minutos/Salió del módulo Inicio a las 2 de la tarde con 54 minutos/Ingresó al módulo Crear evento a las 2 de la tarde con 54 minutos/Salió del módulo Crear evento a las 2 de la tarde con 56 minutos/Ingresó al módulo Seguridad (Gestionar roles y permisos) a las 2 de la tarde con 56 minutos/Salió del módulo Inicio a las 7 de la mañana con 27 minutos/Ingresó al módulo Seguridad (Gestionar roles y permisos) a las 7 de la mañana con 27 minutos/Salió del módulo Seguridad (Gestionar roles y permisos) a las 7 de la mañana con 37 minutos/Ingresó al módulo Consultar personas a las 7 de la mañana con 37 minutos/Salió del módulo Consultar personas a las 7 de la mañana con 37 minutos/Ingresó al módulo Seguridad (Gestionar roles y permisos) a las 7 de la mañana con 37 minutos/Salió del módulo Inicio a las 7 de la noche con 42 minutos/Ingresó al módulo Crear evento a las 7 de la noche con 42 minutos/Salió del módulo Crear evento a las 8 de la noche con 4 minutos/Ingresó al módulo Inicio a las 8 de la noche con 4 minutos/Salió del módulo Inicio a las 8 de la noche con 4 minutos/Ingresó al módulo Crear evento a las 8 de la noche con 4 minutos/Salió del módulo Crear evento a las 8 de la noche con 5 minutos/Ingresó al módulo Inicio a las 8 de la noche con 5 minutos/Salió del módulo Inicio a las 8 de la noche con 6 minutos/Ingresó al módulo Crear evento a las 8 de la noche con 6 minutos/Salió del módulo Crear evento a las 8 de la noche con 6 minutos/Ingresó al módulo Inicio a las 8 de la noche con 6 minutos/Salió del módulo Inicio a las 8 de la noche con 6 minutos/Ingresó al módulo Crear evento a las 8 de la noche con 6 minutos/Salió del módulo Crear evento a las 8 de la noche con 10 minutos/Ingresó al módulo Inicio a las 8 de la noche con 10 minutos/Salió del módulo Inicio a las 8 de la noche con 10 minutos/Ingresó al módulo Crear evento a las 8 de la noche con 10 minutos/Salió del módulo Crear evento a las 8 de la noche con 11 minutos/Ingresó al módulo Inicio a las 8 de la noche con 11 minutos/Salió del módulo Inicio a las 8 de la noche con 12 minutos/Ingresó al módulo Crear evento a las 8 de la noche con 12 minutos/Salió del módulo Crear evento a las 8 de la mañana con 47 minutos/Ingresó al módulo Inicio a las 8 de la mañana con 47 minutos/Salió del módulo Inicio a las 8 de la mañana con 47 minutos/Ingresó al módulo Crear evento a las 8 de la mañana con 47 minutos/Salió del módulo Crear evento a las 8 de la mañana con 48 minutos/Ingresó al módulo Inicio a las 8 de la mañana con 48 minutos/Salió del módulo Inicio a las 8 de la mañana con 48 minutos/Ingresó al módulo Crear evento a las 8 de la mañana con 48 minutos/Salió del módulo Crear evento a las 9 de la mañana con 32 minutos/Ingresó al módulo Inicio a las 9 de la mañana con 32 minutos/Salió del módulo Inicio a las 9 de la mañana con 34 minutos/Ingresó al módulo Crear evento a las 9 de la mañana con 34 minutos/Salió del módulo Crear evento a las 9 de la mañana con 37 minutos/Ingresó al módulo Registrar personas a las 9 de la mañana con 37 minutos/Salió del módulo Inicio a las 9 de la mañana con 41 minutos/Ingresó al módulo Consultar personas a las 9 de la mañana con 41 minutos/Salió del módulo Consultar personas a las 9 de la mañana con 43 minutos/Ingresó al módulo Seguridad (Gestionar roles y permisos) a las 9 de la mañana con 43 minutos/Salió del módulo Seguridad (Gestionar roles y permisos) a las 9 de la mañana con 44 minutos/Ingresó al módulo Registrar personas a las 9 de la mañana con 44 minutos/Salió del módulo Registrar personas a las 9 de la mañana con 46 minutos/Ingresó al módulo Seguridad (Gestionar roles y permisos) a las 9 de la mañana con 46 minutos/Salió del módulo Seguridad (Gestionar roles y permisos) a las 9 de la mañana con 46 minutos/Ingresó al módulo Consultar personas a las 9 de la mañana con 46 minutos/Salió del módulo Inicio a las 8 de la noche con 34 minutos/Ingresó al módulo Consultar familias a las 8 de la noche con 34 minutos/Salió del módulo Consultar familias a las 8 de la noche con 36 minutos/Ingresó al módulo Consultar vacunados covid a las 8 de la noche con 36 minutos/Salió del módulo Consultar vacunados covid a las 8 de la noche con 37 minutos/Ingresó al módulo Registrar enfermos a las 8 de la noche con 37 minutos/Salió del módulo Registrar enfermos a las 8 de la noche con 38 minutos/Ingresó al módulo Registrar discapacitados a las 8 de la noche con 38 minutos/Salió del módulo Registrar discapacitados a las 8 de la noche con 40 minutos/Ingresó al módulo Registrar vacunados covid a las 8 de la noche con 40 minutos/Vacuna Registrada exitosamente!./Vacunado: 0102033 Eliminado Exitosamente./Salió del módulo Registrar vacunados covid a las 8 de la noche con 43 minutos/Ingresó al módulo Registrar embarazada a las 8 de la noche con 43 minutos/Embarazada Registrada exitosamente!./Embarazada Eliminada Exitosamente/Salió del módulo Registrar embarazada a las 8 de la noche con 44 minutos/Ingresó al módulo Registrar Sector agrícola a las 8 de la noche con 44 minutos/Sector Agricola Registrado exitosamente!./Agricola Actualizado exitosamente!./Sector Agriola Eliminado Exitosamente/Salió del módulo Registrar Sector agrícola a las 8 de la noche con 49 minutos/Ingresó al módulo Registrar grupo deportivo a las 8 de la noche con 49 minutos/Grupo Deportivo  Eliminado Exitosamente./Salió del módulo Registrar grupo deportivo a las 8 de la noche con 51 minutos/Ingresó al módulo Registrar negocios a las 8 de la noche con 51 minutos/Registro de Negocio: Mi bendicion 2020.CA Exitosamente./Negocio:  Actualizado Exitosamente./Salió del módulo Registrar negocios a las 8 de la noche con 54 minutos/Ingresó al módulo Registrar inmuebles a las 8 de la noche con 54 minutos/Registro de Inmueble: Cancha Pedrito Alcachofas \\Exitosamente./Inmueble: Cancha Pedrito Alcachofas Eliminado \\Exitosamente./Salió del módulo Registrar inmuebles a las 9 de la noche con 0 minutos/Ingresó al módulo Consejo Comunal Asignar Comite a las 9 de la noche con 0 minutos/El portador de la cedula 010203 fue registrado como vocero \\Exitosamente./El portador de la cedula  fue Actualizado como vocero \\Exitosamente./El Vocero fue Eliminado Exitosamente./Salió del módulo Consejo Comunal Asignar Comite a las 9 de la noche con 1 minutos/Ingresó al módulo Registrar centro de votación a las 9 de la noche con 1 minutos/Votante Portador de la Cedula: Mary López Eliminado \\Exitosamente./Votante Portador de la Cedula: Mary López Eliminado \\Exitosamente./Votante Portador de la Cedula: Mary López Eliminado \\Exitosamente./Votante Portador de la Cedula: Persona1 Apellido1 Eliminado \\Exitosamente./Salió del módulo Registrar centro de votación a las 9 de la noche con 5 minutos/Ingresó al módulo Seguridad (Gestionar roles y permisos) a las 9 de la noche con 5 minutos/Salió del módulo Registrar centro de votación a las 9 de la noche con 5 minutos/Ingresó al módulo Seguridad (Gestionar roles y permisos) a las 9 de la noche con 5 minutos/Salió del módulo Seguridad (Gestionar roles y permisos) a las 9 de la noche con 5 minutos/Ingresó al módulo Generar Censos a las 9 de la noche con 5 minutos/Salió del módulo Generar Censos a las 9 de la noche con 5 minutos/Ingresó al módulo Crear evento a las 9 de la noche con 5 minutos/Salió del módulo Crear evento a las 9 de la noche con 6 minutos/Ingresó al módulo Inicio a las 9 de la noche con 6 minutos/Salió del módulo Inicio a las 9 de la noche con 6 minutos/Ingresó al módulo Crear evento a las 9 de la noche con 6 minutos/Salió del módulo Inicio a las 2 de la tarde con 24 minutos/Ingresó al módulo Seguridad (Gestionar roles y permisos) a las 2 de la tarde con 24 minutos/Salió del módulo Seguridad (Gestionar roles y permisos) a las 2 de la tarde con 46 minutos/Ingresó al módulo Inicio a las 2 de la tarde con 46 minutos/Salió del módulo Inicio a las 2 de la tarde con 47 minutos/Ingresó al módulo Registrar personas a las 2 de la tarde con 47 minutos/Salió del módulo Inicio a las 12 del medio día con 14 minutos/Ingresó al módulo Seguridad (Gestionar roles y permisos) a las 12 del medio día con 14 minutos/Salió del módulo Inicio a las 11 de la mañana con 11 minutos/Ingresó al módulo Seguridad (Gestionar roles y permisos) a las 11 de la mañana con 11 minutos/Salió del módulo Seguridad (Gestionar roles y permisos) a las 11 de la mañana con 21 minutos/Ingresó al módulo Consultar eventos a las 11 de la mañana con 21 minutos/Salió del módulo Inicio a las 7 de la noche con 11 minutos/Ingresó al módulo Seguridad (Gestionar roles y permisos) a las 7 de la noche con 11 minutos/', 'Activo'),
(18, '654321', '2021-11-03', 'Miercoles', '04:36:16 PM', 'Salió del módulo Inicio a las 3 de la tarde con 49 minutos/Ingresó al módulo Registrar usuarios a las 3 de la tarde con 49 minutos/Salió del módulo Registrar usuarios a las 3 de la tarde con 49 minutos/Ingresó al módulo Consultar bitacora a las 3 de la tarde con 49 minutos/', '04:50:31 PM'),
(19, '654321', '2021-11-03', 'Miercoles', '04:50:42 PM', 'Salió del módulo Inicio a las 3 de la tarde con 50 minutos/Ingresó al módulo Consultar bitacora a las 3 de la tarde con 50 minutos/Salió del módulo Consultar bitacora a las 7 de la noche con 23 minutos/Ingresó al módulo Registrar personas a las 7 de la noche con 23 minutos/', '08:48:06 PM'),
(20, '654321', '2021-11-03', 'Miercoles', '08:49:57 PM', 'Salió del módulo Inicio a las 7 de la noche con 50 minutos/Ingresó al módulo Registrar personas a las 7 de la noche con 50 minutos/', '10:14:02 AM'),
(21, '654321', '2021-11-04', 'Jueves', '10:14:55 AM', 'Salió del módulo Inicio a las 9 de la mañana con 15 minutos/Ingresó al módulo Registrar personas a las 9 de la mañana con 15 minutos/Salió del módulo Registrar personas a las 10 de la mañana con 8 minutos/Ingresó al módulo Seguridad (Gestionar roles y permisos) a las 10 de la mañana con 8 minutos/', '03:10:58 PM'),
(22, '654321', '2021-11-05', 'Viernes', '03:11:16 PM', '', '03:14:47 PM'),
(23, '654321', '2021-11-05', 'Viernes', '03:15:06 PM', '', '03:17:13 PM'),
(24, '654321', '2021-11-05', 'Viernes', '03:17:23 PM', '', '03:28:11 PM'),
(25, '654321', '2021-11-05', 'Viernes', '03:28:23 PM', '', '03:35:18 PM'),
(26, '654321', '2021-11-05', 'Viernes', '03:35:28 PM', 'Salió del módulo Inicio a las 2 de la tarde con 56 minutos/Ingresó al módulo Registrar personas a las 2 de la tarde con 56 minutos/', '09:08:39 PM'),
(27, '654321', '2021-11-06', 'Sábado', '01:49:01 PM', 'Salió del módulo Inicio a las 12 del medio día con 56 minutos/Ingresó al módulo Generar Censos a las 12 del medio día con 56 minutos/Salió del módulo Generar Censos a las 12 del medio día con 58 minutos/Ingresó al módulo Inicio a las 12 del medio día con 58 minutos/Salió del módulo Inicio a las 12 del medio día con 59 minutos/Ingresó al módulo Solicitar Ayuda a las 12 del medio día con 59 minutos/Salió del módulo Solicitar Ayuda a las 1 de la tarde con 3 minutos/Ingresó al módulo Registrar personas a las 1 de la tarde con 3 minutos/', '08:02:48 PM'),
(28, '654321', '2021-11-07', 'Domingo', '09:07:10 PM', 'Salió del módulo Inicio a las 8 de la noche con 7 minutos/Ingresó al módulo Registrar personas a las 8 de la noche con 7 minutos/Salió del módulo Registrar personas a las 10 de la mañana con 43 minutos/Ingresó al módulo Seguridad (Gestionar roles y permisos) a las 10 de la mañana con 43 minutos/Salió del módulo Seguridad (Gestionar roles y permisos) a las 7 de la noche con 9 minutos/Ingresó al módulo Inicio a las 7 de la noche con 9 minutos/', '09:04:34 PM'),
(29, '654321', '2021-11-08', 'Lunes', '09:04:44 PM', '', '09:07:25 PM'),
(30, '654321', '2021-11-08', 'Lunes', '09:07:37 PM', '', '09:07:46 PM'),
(31, '654321', '2021-11-08', 'Lunes', '09:08:22 PM', '', '09:10:16 PM'),
(32, '654321', '2021-11-08', 'Lunes', '09:10:37 PM', 'Salió del módulo Inicio a las 8 de la noche con 28 minutos/Ingresó al módulo Crear evento a las 8 de la noche con 28 minutos/Salió del módulo Inicio a las 8 de la noche con 39 minutos/Ingresó al módulo Crear evento a las 8 de la noche con 39 minutos/Ingresó al módulo Consultar eventos a las 7 de la mañana con 58 minutos/Salió del módulo Inicio a las 7 de la mañana con 58 minutos/Salió del módulo Consultar eventos a las 8 de la mañana con 37 minutos/Ingresó al módulo Seguridad (Gestionar roles y permisos) a las 8 de la mañana con 37 minutos/Salió del módulo Seguridad (Gestionar roles y permisos) a las 8 de la mañana con 45 minutos/Ingresó al módulo Consultar personas a las 8 de la mañana con 45 minutos/Salió del módulo Consultar personas a las 9 de la mañana con 5 minutos/Ingresó al módulo Consultar familias a las 9 de la mañana con 5 minutos/Salió del módulo Consultar familias a las 3 de la tarde con 2 minutos/Ingresó al módulo Consultar personas a las 3 de la tarde con 2 minutos/Salió del módulo Consultar personas a las 4 de la tarde con 5 minutos/Ingresó al módulo Registrar viviendas a las 4 de la tarde con 5 minutos/Salió del módulo Registrar viviendas a las 5 de la tarde con 57 minutos/Ingresó al módulo Registrar familia a las 5 de la tarde con 57 minutos/Salió del módulo Registrar familia a las 7 de la noche con 21 minutos/Ingresó al módulo Registrar viviendas a las 7 de la noche con 21 minutos/Salió del módulo Registrar viviendas a las 9 de la mañana con 3 minutos/Ingresó al módulo Seguridad (Gestionar roles y permisos) a las 9 de la mañana con 3 minutos/Salió del módulo Inicio a las 9 de la mañana con 22 minutos/Ingresó al módulo Registrar viviendas a las 9 de la mañana con 22 minutos/Salió del módulo Seguridad (Gestionar roles y permisos) a las 11 de la mañana con 25 minutos/Ingresó al módulo Solicitudes a las 11 de la mañana con 25 minutos/Salió del módulo Registrar viviendas a las 11 de la mañana con 34 minutos/Ingresó al módulo Seguridad (Gestionar roles y permisos) a las 11 de la mañana con 34 minutos/Salió del módulo Inicio a las 11 de la mañana con 45 minutos/Ingresó al módulo Registrar viviendas a las 11 de la mañana con 45 minutos/Salió del módulo Registrar viviendas a las 12 del medio día con 39 minutos/Ingresó al módulo Consultar eventos a las 12 del medio día con 39 minutos/Salió del módulo Consultar eventos a las 12 del medio día con 48 minutos/Ingresó al módulo Registrar personas a las 12 del medio día con 48 minutos/Salió del módulo Registrar personas a las 12 del medio día con 57 minutos/Ingresó al módulo Consultar personas a las 12 del medio día con 57 minutos/Salió del módulo Registrar personas a las 12 del medio día con 57 minutos/Ingresó al módulo Consultar personas a las 12 del medio día con 57 minutos/Salió del módulo Consultar personas a las 12 del medio día con 58 minutos/Ingresó al módulo Consultar eventos a las 12 del medio día con 58 minutos/Salió del módulo Inicio a las 1 de la tarde con 51 minutos/Ingresó al módulo Registrar viviendas a las 1 de la tarde con 51 minutos/Salió del módulo Registrar viviendas a las 2 de la tarde con 18 minutos/Ingresó al módulo Registrar personas a las 2 de la tarde con 18 minutos/Salió del módulo Registrar personas a las 2 de la tarde con 19 minutos/Ingresó al módulo Registrar viviendas a las 2 de la tarde con 19 minutos/Salió del módulo Registrar viviendas a las 2 de la tarde con 36 minutos/Ingresó al módulo Registrar inmuebles a las 2 de la tarde con 36 minutos/Salió del módulo Registrar inmuebles a las 2 de la tarde con 40 minutos/Ingresó al módulo Registrar personas a las 2 de la tarde con 40 minutos/Salió del módulo Registrar personas a las 2 de la tarde con 41 minutos/Ingresó al módulo Consultar personas a las 2 de la tarde con 41 minutos/Salió del módulo Consultar personas a las 3 de la tarde con 8 minutos/Ingresó al módulo Seguridad (Gestionar roles y permisos) a las 3 de la tarde con 8 minutos/Salió del módulo Consultar personas a las 3 de la tarde con 8 minutos/Ingresó al módulo Seguridad (Gestionar roles y permisos) a las 3 de la tarde con 8 minutos/Salió del módulo Seguridad (Gestionar roles y permisos) a las 3 de la tarde con 9 minutos/Ingresó al módulo Registrar viviendas a las 3 de la tarde con 9 minutos/Salió del módulo Registrar viviendas a las 4 de la tarde con 2 minutos/Ingresó al módulo Consultar eventos a las 4 de la tarde con 2 minutos/Salió del módulo Inicio a las 9 de la noche con 10 minutos/Ingresó al módulo Consultar viviendas a las 9 de la noche con 10 minutos/Salió del módulo Consultar viviendas a las 9 de la noche con 11 minutos/Ingresó al módulo Crear evento a las 9 de la noche con 11 minutos/Salió del módulo Crear evento a las de la noche con 16 minutos/Ingresó al módulo Notificaciones a las de la noche con 16 minutos/Salió del módulo Notificaciones a las de la noche con 26 minutos/Ingresó al módulo Seguridad (Gestionar roles y permisos) a las de la noche con 26 minutos/Salió del módulo Seguridad (Gestionar roles y permisos) a las de la noche con 27 minutos/Ingresó al módulo Notificaciones a las de la noche con 27 minutos/Salió del módulo Inicio a las 7 de la mañana con 19 minutos/Ingresó al módulo Consultar viviendas a las 7 de la mañana con 19 minutos/Salió del módulo Consultar viviendas a las 9 de la mañana con 9 minutos/Ingresó al módulo Registrar enfermos a las 9 de la mañana con 9 minutos/Salió del módulo Registrar enfermos a las 9 de la mañana con 13 minutos/Ingresó al módulo Inicio a las 9 de la mañana con 13 minutos/Salió del módulo Inicio a las 9 de la mañana con 19 minutos/Ingresó al módulo Registrar familia a las 9 de la mañana con 19 minutos/Salió del módulo Inicio a las 10 de la mañana con 31 minutos/Ingresó al módulo Registrar enfermos a las 10 de la mañana con 31 minutos/Salió del módulo Registrar enfermos a las 1 de la tarde con 43 minutos/Ingresó al módulo Registrar familia a las 1 de la tarde con 43 minutos/Salió del módulo Registrar familia a las 1 de la tarde con 43 minutos/Ingresó al módulo Consultar familias a las 1 de la tarde con 43 minutos/Salió del módulo Consultar familias a las 1 de la tarde con 58 minutos/Ingresó al módulo Consultar enfermos a las 1 de la tarde con 58 minutos/Salió del módulo Consultar enfermos a las 2 de la tarde con 54 minutos/Ingresó al módulo Registrar negocios a las 2 de la tarde con 54 minutos/Registro de Negocio: dfg Exitosamente./Negocio:  Actualizado Exitosamente./Negocio:  Actualizado Exitosamente./Negocio:  Actualizado Exitosamente./Negocio:  Actualizado Exitosamente./Salió del módulo Registrar negocios a las 2 de la tarde con 55 minutos/Ingresó al módulo Inicio a las 2 de la tarde con 55 minutos/Salió del módulo Inicio a las 5 de la tarde con 4 minutos/Ingresó al módulo Registrar discapacitados a las 5 de la tarde con 4 minutos/Salió del módulo Registrar discapacitados a las 5 de la tarde con 16 minutos/Ingresó al módulo Consejo Comunal Consultas a las 5 de la tarde con 16 minutos/Salió del módulo Consejo Comunal Consultas a las 5 de la tarde con 17 minutos/Ingresó al módulo Registrar discapacitados a las 5 de la tarde con 17 minutos/Salió del módulo Inicio a las 2 de la tarde con 54 minutos/Ingresó al módulo Crear evento a las 2 de la tarde con 54 minutos/Salió del módulo Crear evento a las 2 de la tarde con 56 minutos/Ingresó al módulo Seguridad (Gestionar roles y permisos) a las 2 de la tarde con 56 minutos/Salió del módulo Inicio a las 7 de la mañana con 27 minutos/Ingresó al módulo Seguridad (Gestionar roles y permisos) a las 7 de la mañana con 27 minutos/Salió del módulo Seguridad (Gestionar roles y permisos) a las 7 de la mañana con 37 minutos/Ingresó al módulo Consultar personas a las 7 de la mañana con 37 minutos/Salió del módulo Consultar personas a las 7 de la mañana con 37 minutos/Ingresó al módulo Seguridad (Gestionar roles y permisos) a las 7 de la mañana con 37 minutos/Salió del módulo Inicio a las 7 de la noche con 42 minutos/Ingresó al módulo Crear evento a las 7 de la noche con 42 minutos/Salió del módulo Crear evento a las 8 de la noche con 4 minutos/Ingresó al módulo Inicio a las 8 de la noche con 4 minutos/Salió del módulo Inicio a las 8 de la noche con 4 minutos/Ingresó al módulo Crear evento a las 8 de la noche con 4 minutos/Salió del módulo Crear evento a las 8 de la noche con 5 minutos/Ingresó al módulo Inicio a las 8 de la noche con 5 minutos/Salió del módulo Inicio a las 8 de la noche con 6 minutos/Ingresó al módulo Crear evento a las 8 de la noche con 6 minutos/Salió del módulo Crear evento a las 8 de la noche con 6 minutos/Ingresó al módulo Inicio a las 8 de la noche con 6 minutos/Salió del módulo Inicio a las 8 de la noche con 6 minutos/Ingresó al módulo Crear evento a las 8 de la noche con 6 minutos/Salió del módulo Crear evento a las 8 de la noche con 10 minutos/Ingresó al módulo Inicio a las 8 de la noche con 10 minutos/Salió del módulo Inicio a las 8 de la noche con 10 minutos/Ingresó al módulo Crear evento a las 8 de la noche con 10 minutos/Salió del módulo Crear evento a las 8 de la noche con 11 minutos/Ingresó al módulo Inicio a las 8 de la noche con 11 minutos/Salió del módulo Inicio a las 8 de la noche con 12 minutos/Ingresó al módulo Crear evento a las 8 de la noche con 12 minutos/Salió del módulo Crear evento a las 8 de la mañana con 47 minutos/Ingresó al módulo Inicio a las 8 de la mañana con 47 minutos/Salió del módulo Inicio a las 8 de la mañana con 47 minutos/Ingresó al módulo Crear evento a las 8 de la mañana con 47 minutos/Salió del módulo Crear evento a las 8 de la mañana con 48 minutos/Ingresó al módulo Inicio a las 8 de la mañana con 48 minutos/Salió del módulo Inicio a las 8 de la mañana con 48 minutos/Ingresó al módulo Crear evento a las 8 de la mañana con 48 minutos/Salió del módulo Crear evento a las 9 de la mañana con 32 minutos/Ingresó al módulo Inicio a las 9 de la mañana con 32 minutos/Salió del módulo Inicio a las 9 de la mañana con 34 minutos/Ingresó al módulo Crear evento a las 9 de la mañana con 34 minutos/Salió del módulo Crear evento a las 9 de la mañana con 37 minutos/Ingresó al módulo Registrar personas a las 9 de la mañana con 37 minutos/Salió del módulo Inicio a las 9 de la mañana con 41 minutos/Ingresó al módulo Consultar personas a las 9 de la mañana con 41 minutos/Salió del módulo Consultar personas a las 9 de la mañana con 43 minutos/Ingresó al módulo Seguridad (Gestionar roles y permisos) a las 9 de la mañana con 43 minutos/Salió del módulo Seguridad (Gestionar roles y permisos) a las 9 de la mañana con 44 minutos/Ingresó al módulo Registrar personas a las 9 de la mañana con 44 minutos/Salió del módulo Registrar personas a las 9 de la mañana con 46 minutos/Ingresó al módulo Seguridad (Gestionar roles y permisos) a las 9 de la mañana con 46 minutos/Salió del módulo Seguridad (Gestionar roles y permisos) a las 9 de la mañana con 46 minutos/Ingresó al módulo Consultar personas a las 9 de la mañana con 46 minutos/Salió del módulo Inicio a las 8 de la noche con 34 minutos/Ingresó al módulo Consultar familias a las 8 de la noche con 34 minutos/Salió del módulo Consultar familias a las 8 de la noche con 36 minutos/Ingresó al módulo Consultar vacunados covid a las 8 de la noche con 36 minutos/Salió del módulo Consultar vacunados covid a las 8 de la noche con 37 minutos/Ingresó al módulo Registrar enfermos a las 8 de la noche con 37 minutos/Salió del módulo Registrar enfermos a las 8 de la noche con 38 minutos/Ingresó al módulo Registrar discapacitados a las 8 de la noche con 38 minutos/Salió del módulo Registrar discapacitados a las 8 de la noche con 40 minutos/Ingresó al módulo Registrar vacunados covid a las 8 de la noche con 40 minutos/Vacuna Registrada exitosamente!./Vacunado: 0102033 Eliminado Exitosamente./Salió del módulo Registrar vacunados covid a las 8 de la noche con 43 minutos/Ingresó al módulo Registrar embarazada a las 8 de la noche con 43 minutos/Embarazada Registrada exitosamente!./Embarazada Eliminada Exitosamente/Salió del módulo Registrar embarazada a las 8 de la noche con 44 minutos/Ingresó al módulo Registrar Sector agrícola a las 8 de la noche con 44 minutos/Sector Agricola Registrado exitosamente!./Agricola Actualizado exitosamente!./Sector Agriola Eliminado Exitosamente/Salió del módulo Registrar Sector agrícola a las 8 de la noche con 49 minutos/Ingresó al módulo Registrar grupo deportivo a las 8 de la noche con 49 minutos/Grupo Deportivo  Eliminado Exitosamente./Salió del módulo Registrar grupo deportivo a las 8 de la noche con 51 minutos/Ingresó al módulo Registrar negocios a las 8 de la noche con 51 minutos/Registro de Negocio: Mi bendicion 2020.CA Exitosamente./Negocio:  Actualizado Exitosamente./Salió del módulo Registrar negocios a las 8 de la noche con 54 minutos/Ingresó al módulo Registrar inmuebles a las 8 de la noche con 54 minutos/Registro de Inmueble: Cancha Pedrito Alcachofas \\Exitosamente./Inmueble: Cancha Pedrito Alcachofas Eliminado \\Exitosamente./Salió del módulo Registrar inmuebles a las 9 de la noche con 0 minutos/Ingresó al módulo Consejo Comunal Asignar Comite a las 9 de la noche con 0 minutos/El portador de la cedula 010203 fue registrado como vocero \\Exitosamente./El portador de la cedula  fue Actualizado como vocero \\Exitosamente./El Vocero fue Eliminado Exitosamente./Salió del módulo Consejo Comunal Asignar Comite a las 9 de la noche con 1 minutos/Ingresó al módulo Registrar centro de votación a las 9 de la noche con 1 minutos/Votante Portador de la Cedula: Mary López Eliminado \\Exitosamente./Votante Portador de la Cedula: Mary López Eliminado \\Exitosamente./Votante Portador de la Cedula: Mary López Eliminado \\Exitosamente./Votante Portador de la Cedula: Persona1 Apellido1 Eliminado \\Exitosamente./Salió del módulo Registrar centro de votación a las 9 de la noche con 5 minutos/Ingresó al módulo Seguridad (Gestionar roles y permisos) a las 9 de la noche con 5 minutos/Salió del módulo Registrar centro de votación a las 9 de la noche con 5 minutos/Ingresó al módulo Seguridad (Gestionar roles y permisos) a las 9 de la noche con 5 minutos/Salió del módulo Seguridad (Gestionar roles y permisos) a las 9 de la noche con 5 minutos/Ingresó al módulo Generar Censos a las 9 de la noche con 5 minutos/Salió del módulo Generar Censos a las 9 de la noche con 5 minutos/Ingresó al módulo Crear evento a las 9 de la noche con 5 minutos/Salió del módulo Crear evento a las 9 de la noche con 6 minutos/Ingresó al módulo Inicio a las 9 de la noche con 6 minutos/Salió del módulo Inicio a las 9 de la noche con 6 minutos/Ingresó al módulo Crear evento a las 9 de la noche con 6 minutos/Salió del módulo Inicio a las 2 de la tarde con 24 minutos/Ingresó al módulo Seguridad (Gestionar roles y permisos) a las 2 de la tarde con 24 minutos/Salió del módulo Seguridad (Gestionar roles y permisos) a las 2 de la tarde con 46 minutos/Ingresó al módulo Inicio a las 2 de la tarde con 46 minutos/Salió del módulo Inicio a las 2 de la tarde con 47 minutos/Ingresó al módulo Registrar personas a las 2 de la tarde con 47 minutos/Salió del módulo Inicio a las 12 del medio día con 14 minutos/Ingresó al módulo Seguridad (Gestionar roles y permisos) a las 12 del medio día con 14 minutos/Salió del módulo Inicio a las 11 de la mañana con 11 minutos/Ingresó al módulo Seguridad (Gestionar roles y permisos) a las 11 de la mañana con 11 minutos/Salió del módulo Seguridad (Gestionar roles y permisos) a las 11 de la mañana con 21 minutos/Ingresó al módulo Consultar eventos a las 11 de la mañana con 21 minutos/Salió del módulo Inicio a las 7 de la noche con 11 minutos/Ingresó al módulo Seguridad (Gestionar roles y permisos) a las 7 de la noche con 11 minutos/', 'Activo'),
(33, '654321', '2021-11-08', 'Lunes', '09:12:38 PM', '', '09:23:30 PM'),
(34, '654321', '2021-11-08', 'Lunes', '09:23:58 PM', '', '09:27:50 PM'),
(35, '654321', '2021-11-08', 'Lunes', '09:28:14 PM', 'Salió del módulo Inicio a las 8 de la noche con 28 minutos/Ingresó al módulo Crear evento a las 8 de la noche con 28 minutos/', '09:37:52 PM'),
(36, '654321', '2021-11-08', 'Lunes', '09:38:09 PM', '', '09:38:46 PM'),
(37, '654321', '2021-11-08', 'Lunes', '09:39:11 PM', 'Salió del módulo Inicio a las 8 de la noche con 39 minutos/Ingresó al módulo Crear evento a las 8 de la noche con 39 minutos/', '09:46:34 PM'),
(38, '654321', '2021-11-08', 'Lunes', '09:47:13 PM', '', '10:04:58 PM'),
(39, '654321', '2021-11-08', 'Lunes', '10:05:30 PM', 'Ingresó al módulo Consultar eventos a las 7 de la mañana con 58 minutos/Salió del módulo Inicio a las 7 de la mañana con 58 minutos/Salió del módulo Consultar eventos a las 8 de la mañana con 37 minutos/Ingresó al módulo Seguridad (Gestionar roles y permisos) a las 8 de la mañana con 37 minutos/Salió del módulo Seguridad (Gestionar roles y permisos) a las 8 de la mañana con 45 minutos/Ingresó al módulo Consultar personas a las 8 de la mañana con 45 minutos/Salió del módulo Consultar personas a las 9 de la mañana con 5 minutos/Ingresó al módulo Consultar familias a las 9 de la mañana con 5 minutos/Salió del módulo Consultar familias a las 3 de la tarde con 2 minutos/Ingresó al módulo Consultar personas a las 3 de la tarde con 2 minutos/Salió del módulo Consultar personas a las 4 de la tarde con 5 minutos/Ingresó al módulo Registrar viviendas a las 4 de la tarde con 5 minutos/Salió del módulo Registrar viviendas a las 5 de la tarde con 57 minutos/Ingresó al módulo Registrar familia a las 5 de la tarde con 57 minutos/Salió del módulo Registrar familia a las 7 de la noche con 21 minutos/Ingresó al módulo Registrar viviendas a las 7 de la noche con 21 minutos/Salió del módulo Registrar viviendas a las 9 de la mañana con 3 minutos/Ingresó al módulo Seguridad (Gestionar roles y permisos) a las 9 de la mañana con 3 minutos/', '10:20:58 AM'),
(40, '654321', '2021-11-10', 'Miercoles', '10:21:57 AM', 'Salió del módulo Inicio a las 9 de la mañana con 22 minutos/Ingresó al módulo Registrar viviendas a las 9 de la mañana con 22 minutos/Salió del módulo Seguridad (Gestionar roles y permisos) a las 11 de la mañana con 25 minutos/Ingresó al módulo Solicitudes a las 11 de la mañana con 25 minutos/Salió del módulo Registrar viviendas a las 11 de la mañana con 34 minutos/Ingresó al módulo Seguridad (Gestionar roles y permisos) a las 11 de la mañana con 34 minutos/', '12:34:32 PM'),
(41, '654321', '2021-11-10', 'Miercoles', '12:35:23 PM', '', '12:45:25 PM'),
(42, '654321', '2021-11-10', 'Miercoles', '12:45:33 PM', 'Salió del módulo Inicio a las 11 de la mañana con 45 minutos/Ingresó al módulo Registrar viviendas a las 11 de la mañana con 45 minutos/Salió del módulo Registrar viviendas a las 12 del medio día con 39 minutos/Ingresó al módulo Consultar eventos a las 12 del medio día con 39 minutos/Salió del módulo Consultar eventos a las 12 del medio día con 48 minutos/Ingresó al módulo Registrar personas a las 12 del medio día con 48 minutos/Salió del módulo Registrar personas a las 12 del medio día con 57 minutos/Ingresó al módulo Consultar personas a las 12 del medio día con 57 minutos/Salió del módulo Registrar personas a las 12 del medio día con 57 minutos/Ingresó al módulo Consultar personas a las 12 del medio día con 57 minutos/Salió del módulo Consultar personas a las 12 del medio día con 58 minutos/Ingresó al módulo Consultar eventos a las 12 del medio día con 58 minutos/', '02:35:44 PM'),
(43, '654321', '2021-11-10', 'Miercoles', '02:36:19 PM', '', '02:50:54 PM'),
(44, '654321', '2021-11-10', 'Miercoles', '02:51:17 PM', 'Salió del módulo Inicio a las 1 de la tarde con 51 minutos/Ingresó al módulo Registrar viviendas a las 1 de la tarde con 51 minutos/Salió del módulo Registrar viviendas a las 2 de la tarde con 18 minutos/Ingresó al módulo Registrar personas a las 2 de la tarde con 18 minutos/Salió del módulo Registrar personas a las 2 de la tarde con 19 minutos/Ingresó al módulo Registrar viviendas a las 2 de la tarde con 19 minutos/Salió del módulo Registrar viviendas a las 2 de la tarde con 36 minutos/Ingresó al módulo Registrar inmuebles a las 2 de la tarde con 36 minutos/Salió del módulo Registrar inmuebles a las 2 de la tarde con 40 minutos/Ingresó al módulo Registrar personas a las 2 de la tarde con 40 minutos/Salió del módulo Registrar personas a las 2 de la tarde con 41 minutos/Ingresó al módulo Consultar personas a las 2 de la tarde con 41 minutos/Salió del módulo Consultar personas a las 3 de la tarde con 8 minutos/Ingresó al módulo Seguridad (Gestionar roles y permisos) a las 3 de la tarde con 8 minutos/Salió del módulo Consultar personas a las 3 de la tarde con 8 minutos/Ingresó al módulo Seguridad (Gestionar roles y permisos) a las 3 de la tarde con 8 minutos/Salió del módulo Seguridad (Gestionar roles y permisos) a las 3 de la tarde con 9 minutos/Ingresó al módulo Registrar viviendas a las 3 de la tarde con 9 minutos/Salió del módulo Registrar viviendas a las 4 de la tarde con 2 minutos/Ingresó al módulo Consultar eventos a las 4 de la tarde con 2 minutos/', '10:08:58 PM'),
(45, '654321', '2021-11-10', 'Miercoles', '10:09:42 PM', 'Salió del módulo Inicio a las 9 de la noche con 10 minutos/Ingresó al módulo Consultar viviendas a las 9 de la noche con 10 minutos/Salió del módulo Consultar viviendas a las 9 de la noche con 11 minutos/Ingresó al módulo Crear evento a las 9 de la noche con 11 minutos/Salió del módulo Crear evento a las de la noche con 16 minutos/Ingresó al módulo Notificaciones a las de la noche con 16 minutos/Salió del módulo Notificaciones a las de la noche con 26 minutos/Ingresó al módulo Seguridad (Gestionar roles y permisos) a las de la noche con 26 minutos/Salió del módulo Seguridad (Gestionar roles y permisos) a las de la noche con 27 minutos/Ingresó al módulo Notificaciones a las de la noche con 27 minutos/', '11:46:41 PM'),
(46, '654321', '2021-11-11', 'Jueves', '08:19:09 AM', 'Salió del módulo Inicio a las 7 de la mañana con 19 minutos/Ingresó al módulo Consultar viviendas a las 7 de la mañana con 19 minutos/Salió del módulo Consultar viviendas a las 9 de la mañana con 9 minutos/Ingresó al módulo Registrar enfermos a las 9 de la mañana con 9 minutos/Salió del módulo Registrar enfermos a las 9 de la mañana con 13 minutos/Ingresó al módulo Inicio a las 9 de la mañana con 13 minutos/', '10:13:52 AM'),
(47, '654321', '2021-11-11', 'Jueves', '10:14:17 AM', '', '10:15:41 AM'),
(48, '654321', '2021-11-11', 'Jueves', '10:17:58 AM', '', '10:18:07 AM'),
(49, '654321', '2021-11-11', 'Jueves', '10:18:30 AM', 'Salió del módulo Inicio a las 9 de la mañana con 19 minutos/Ingresó al módulo Registrar familia a las 9 de la mañana con 19 minutos/', '10:21:02 AM'),
(50, '654321', '2021-11-11', 'Jueves', '10:21:52 AM', '', '11:24:05 AM'),
(51, '654321', '2021-11-11', 'Jueves', '11:24:41 AM', 'Salió del módulo Inicio a las 10 de la mañana con 31 minutos/Ingresó al módulo Registrar enfermos a las 10 de la mañana con 31 minutos/Salió del módulo Registrar enfermos a las 1 de la tarde con 43 minutos/Ingresó al módulo Registrar familia a las 1 de la tarde con 43 minutos/Salió del módulo Registrar familia a las 1 de la tarde con 43 minutos/Ingresó al módulo Consultar familias a las 1 de la tarde con 43 minutos/Salió del módulo Consultar familias a las 1 de la tarde con 58 minutos/Ingresó al módulo Consultar enfermos a las 1 de la tarde con 58 minutos/Salió del módulo Consultar enfermos a las 2 de la tarde con 54 minutos/Ingresó al módulo Registrar negocios a las 2 de la tarde con 54 minutos/Registro de Negocio: dfg Exitosamente./Negocio:  Actualizado Exitosamente./Negocio:  Actualizado Exitosamente./Negocio:  Actualizado Exitosamente./Negocio:  Actualizado Exitosamente./Salió del módulo Registrar negocios a las 2 de la tarde con 55 minutos/Ingresó al módulo Inicio a las 2 de la tarde con 55 minutos/', '04:06:44 PM'),
(52, '654321', '2021-11-11', 'Jueves', '05:09:37 PM', 'Salió del módulo Inicio a las 5 de la tarde con 4 minutos/Ingresó al módulo Registrar discapacitados a las 5 de la tarde con 4 minutos/Salió del módulo Registrar discapacitados a las 5 de la tarde con 16 minutos/Ingresó al módulo Consejo Comunal Consultas a las 5 de la tarde con 16 minutos/Salió del módulo Consejo Comunal Consultas a las 5 de la tarde con 17 minutos/Ingresó al módulo Registrar discapacitados a las 5 de la tarde con 17 minutos/', '07:42:44 PM'),
(53, '654321', '2021-11-11', 'Jueves', '07:46:42 PM', '', '07:46:49 PM'),
(54, '654321', '2021-11-14', 'Domingo', '03:52:58 PM', 'Salió del módulo Inicio a las 2 de la tarde con 54 minutos/Ingresó al módulo Crear evento a las 2 de la tarde con 54 minutos/Salió del módulo Crear evento a las 2 de la tarde con 56 minutos/Ingresó al módulo Seguridad (Gestionar roles y permisos) a las 2 de la tarde con 56 minutos/', '04:10:22 PM');
INSERT INTO `bitacoras` (`id_bitacora`, `cedula_usuario`, `fecha`, `dia`, `hora_inicio`, `acciones`, `hora_fin`) VALUES
(55, '654321', '2021-11-25', 'Jueves', '08:27:02 AM', 'Salió del módulo Inicio a las 7 de la mañana con 27 minutos/Ingresó al módulo Seguridad (Gestionar roles y permisos) a las 7 de la mañana con 27 minutos/Salió del módulo Seguridad (Gestionar roles y permisos) a las 7 de la mañana con 37 minutos/Ingresó al módulo Consultar personas a las 7 de la mañana con 37 minutos/Salió del módulo Consultar personas a las 7 de la mañana con 37 minutos/Ingresó al módulo Seguridad (Gestionar roles y permisos) a las 7 de la mañana con 37 minutos/Salió del módulo Inicio a las 7 de la noche con 42 minutos/Ingresó al módulo Crear evento a las 7 de la noche con 42 minutos/Salió del módulo Crear evento a las 8 de la noche con 4 minutos/Ingresó al módulo Inicio a las 8 de la noche con 4 minutos/Salió del módulo Inicio a las 8 de la noche con 4 minutos/Ingresó al módulo Crear evento a las 8 de la noche con 4 minutos/Salió del módulo Crear evento a las 8 de la noche con 5 minutos/Ingresó al módulo Inicio a las 8 de la noche con 5 minutos/Salió del módulo Inicio a las 8 de la noche con 6 minutos/Ingresó al módulo Crear evento a las 8 de la noche con 6 minutos/Salió del módulo Crear evento a las 8 de la noche con 6 minutos/Ingresó al módulo Inicio a las 8 de la noche con 6 minutos/Salió del módulo Inicio a las 8 de la noche con 6 minutos/Ingresó al módulo Crear evento a las 8 de la noche con 6 minutos/Salió del módulo Crear evento a las 8 de la noche con 10 minutos/Ingresó al módulo Inicio a las 8 de la noche con 10 minutos/Salió del módulo Inicio a las 8 de la noche con 10 minutos/Ingresó al módulo Crear evento a las 8 de la noche con 10 minutos/Salió del módulo Crear evento a las 8 de la noche con 11 minutos/Ingresó al módulo Inicio a las 8 de la noche con 11 minutos/Salió del módulo Inicio a las 8 de la noche con 12 minutos/Ingresó al módulo Crear evento a las 8 de la noche con 12 minutos/Salió del módulo Crear evento a las 8 de la mañana con 47 minutos/Ingresó al módulo Inicio a las 8 de la mañana con 47 minutos/Salió del módulo Inicio a las 8 de la mañana con 47 minutos/Ingresó al módulo Crear evento a las 8 de la mañana con 47 minutos/Salió del módulo Crear evento a las 8 de la mañana con 48 minutos/Ingresó al módulo Inicio a las 8 de la mañana con 48 minutos/Salió del módulo Inicio a las 8 de la mañana con 48 minutos/Ingresó al módulo Crear evento a las 8 de la mañana con 48 minutos/Salió del módulo Crear evento a las 9 de la mañana con 32 minutos/Ingresó al módulo Inicio a las 9 de la mañana con 32 minutos/Salió del módulo Inicio a las 9 de la mañana con 34 minutos/Ingresó al módulo Crear evento a las 9 de la mañana con 34 minutos/Salió del módulo Crear evento a las 9 de la mañana con 37 minutos/Ingresó al módulo Registrar personas a las 9 de la mañana con 37 minutos/Salió del módulo Inicio a las 9 de la mañana con 41 minutos/Ingresó al módulo Consultar personas a las 9 de la mañana con 41 minutos/Salió del módulo Consultar personas a las 9 de la mañana con 43 minutos/Ingresó al módulo Seguridad (Gestionar roles y permisos) a las 9 de la mañana con 43 minutos/Salió del módulo Seguridad (Gestionar roles y permisos) a las 9 de la mañana con 44 minutos/Ingresó al módulo Registrar personas a las 9 de la mañana con 44 minutos/Salió del módulo Registrar personas a las 9 de la mañana con 46 minutos/Ingresó al módulo Seguridad (Gestionar roles y permisos) a las 9 de la mañana con 46 minutos/Salió del módulo Seguridad (Gestionar roles y permisos) a las 9 de la mañana con 46 minutos/Ingresó al módulo Consultar personas a las 9 de la mañana con 46 minutos/Salió del módulo Inicio a las 8 de la noche con 34 minutos/Ingresó al módulo Consultar familias a las 8 de la noche con 34 minutos/Salió del módulo Consultar familias a las 8 de la noche con 36 minutos/Ingresó al módulo Consultar vacunados covid a las 8 de la noche con 36 minutos/Salió del módulo Consultar vacunados covid a las 8 de la noche con 37 minutos/Ingresó al módulo Registrar enfermos a las 8 de la noche con 37 minutos/Salió del módulo Registrar enfermos a las 8 de la noche con 38 minutos/Ingresó al módulo Registrar discapacitados a las 8 de la noche con 38 minutos/Salió del módulo Registrar discapacitados a las 8 de la noche con 40 minutos/Ingresó al módulo Registrar vacunados covid a las 8 de la noche con 40 minutos/Vacuna Registrada exitosamente!./Vacunado: 0102033 Eliminado Exitosamente./Salió del módulo Registrar vacunados covid a las 8 de la noche con 43 minutos/Ingresó al módulo Registrar embarazada a las 8 de la noche con 43 minutos/Embarazada Registrada exitosamente!./Embarazada Eliminada Exitosamente/Salió del módulo Registrar embarazada a las 8 de la noche con 44 minutos/Ingresó al módulo Registrar Sector agrícola a las 8 de la noche con 44 minutos/Sector Agricola Registrado exitosamente!./Agricola Actualizado exitosamente!./Sector Agriola Eliminado Exitosamente/Salió del módulo Registrar Sector agrícola a las 8 de la noche con 49 minutos/Ingresó al módulo Registrar grupo deportivo a las 8 de la noche con 49 minutos/Grupo Deportivo  Eliminado Exitosamente./Salió del módulo Registrar grupo deportivo a las 8 de la noche con 51 minutos/Ingresó al módulo Registrar negocios a las 8 de la noche con 51 minutos/Registro de Negocio: Mi bendicion 2020.CA Exitosamente./Negocio:  Actualizado Exitosamente./Salió del módulo Registrar negocios a las 8 de la noche con 54 minutos/Ingresó al módulo Registrar inmuebles a las 8 de la noche con 54 minutos/Registro de Inmueble: Cancha Pedrito Alcachofas \\Exitosamente./Inmueble: Cancha Pedrito Alcachofas Eliminado \\Exitosamente./Salió del módulo Registrar inmuebles a las 9 de la noche con 0 minutos/Ingresó al módulo Consejo Comunal Asignar Comite a las 9 de la noche con 0 minutos/El portador de la cedula 010203 fue registrado como vocero \\Exitosamente./El portador de la cedula  fue Actualizado como vocero \\Exitosamente./El Vocero fue Eliminado Exitosamente./Salió del módulo Consejo Comunal Asignar Comite a las 9 de la noche con 1 minutos/Ingresó al módulo Registrar centro de votación a las 9 de la noche con 1 minutos/Votante Portador de la Cedula: Mary López Eliminado \\Exitosamente./Votante Portador de la Cedula: Mary López Eliminado \\Exitosamente./Votante Portador de la Cedula: Mary López Eliminado \\Exitosamente./Votante Portador de la Cedula: Persona1 Apellido1 Eliminado \\Exitosamente./Salió del módulo Registrar centro de votación a las 9 de la noche con 5 minutos/Ingresó al módulo Seguridad (Gestionar roles y permisos) a las 9 de la noche con 5 minutos/Salió del módulo Registrar centro de votación a las 9 de la noche con 5 minutos/Ingresó al módulo Seguridad (Gestionar roles y permisos) a las 9 de la noche con 5 minutos/Salió del módulo Seguridad (Gestionar roles y permisos) a las 9 de la noche con 5 minutos/Ingresó al módulo Generar Censos a las 9 de la noche con 5 minutos/Salió del módulo Generar Censos a las 9 de la noche con 5 minutos/Ingresó al módulo Crear evento a las 9 de la noche con 5 minutos/Salió del módulo Crear evento a las 9 de la noche con 6 minutos/Ingresó al módulo Inicio a las 9 de la noche con 6 minutos/Salió del módulo Inicio a las 9 de la noche con 6 minutos/Ingresó al módulo Crear evento a las 9 de la noche con 6 minutos/Salió del módulo Inicio a las 2 de la tarde con 24 minutos/Ingresó al módulo Seguridad (Gestionar roles y permisos) a las 2 de la tarde con 24 minutos/Salió del módulo Seguridad (Gestionar roles y permisos) a las 2 de la tarde con 46 minutos/Ingresó al módulo Inicio a las 2 de la tarde con 46 minutos/Salió del módulo Inicio a las 2 de la tarde con 47 minutos/Ingresó al módulo Registrar personas a las 2 de la tarde con 47 minutos/Salió del módulo Inicio a las 12 del medio día con 14 minutos/Ingresó al módulo Seguridad (Gestionar roles y permisos) a las 12 del medio día con 14 minutos/Salió del módulo Inicio a las 11 de la mañana con 11 minutos/Ingresó al módulo Seguridad (Gestionar roles y permisos) a las 11 de la mañana con 11 minutos/Salió del módulo Seguridad (Gestionar roles y permisos) a las 11 de la mañana con 21 minutos/Ingresó al módulo Consultar eventos a las 11 de la mañana con 21 minutos/Salió del módulo Inicio a las 7 de la noche con 11 minutos/Ingresó al módulo Seguridad (Gestionar roles y permisos) a las 7 de la noche con 11 minutos/', 'Activo'),
(56, '654321', '2021-12-09', 'Jueves', '08:41:54 PM', 'Salió del módulo Inicio a las 7 de la noche con 42 minutos/Ingresó al módulo Crear evento a las 7 de la noche con 42 minutos/Salió del módulo Crear evento a las 8 de la noche con 4 minutos/Ingresó al módulo Inicio a las 8 de la noche con 4 minutos/Salió del módulo Inicio a las 8 de la noche con 4 minutos/Ingresó al módulo Crear evento a las 8 de la noche con 4 minutos/Salió del módulo Crear evento a las 8 de la noche con 5 minutos/Ingresó al módulo Inicio a las 8 de la noche con 5 minutos/Salió del módulo Inicio a las 8 de la noche con 6 minutos/Ingresó al módulo Crear evento a las 8 de la noche con 6 minutos/Salió del módulo Crear evento a las 8 de la noche con 6 minutos/Ingresó al módulo Inicio a las 8 de la noche con 6 minutos/Salió del módulo Inicio a las 8 de la noche con 6 minutos/Ingresó al módulo Crear evento a las 8 de la noche con 6 minutos/Salió del módulo Crear evento a las 8 de la noche con 10 minutos/Ingresó al módulo Inicio a las 8 de la noche con 10 minutos/Salió del módulo Inicio a las 8 de la noche con 10 minutos/Ingresó al módulo Crear evento a las 8 de la noche con 10 minutos/Salió del módulo Crear evento a las 8 de la noche con 11 minutos/Ingresó al módulo Inicio a las 8 de la noche con 11 minutos/Salió del módulo Inicio a las 8 de la noche con 12 minutos/Ingresó al módulo Crear evento a las 8 de la noche con 12 minutos/Salió del módulo Crear evento a las 8 de la mañana con 47 minutos/Ingresó al módulo Inicio a las 8 de la mañana con 47 minutos/Salió del módulo Inicio a las 8 de la mañana con 47 minutos/Ingresó al módulo Crear evento a las 8 de la mañana con 47 minutos/Salió del módulo Crear evento a las 8 de la mañana con 48 minutos/Ingresó al módulo Inicio a las 8 de la mañana con 48 minutos/Salió del módulo Inicio a las 8 de la mañana con 48 minutos/Ingresó al módulo Crear evento a las 8 de la mañana con 48 minutos/Salió del módulo Crear evento a las 9 de la mañana con 32 minutos/Ingresó al módulo Inicio a las 9 de la mañana con 32 minutos/Salió del módulo Inicio a las 9 de la mañana con 34 minutos/Ingresó al módulo Crear evento a las 9 de la mañana con 34 minutos/Salió del módulo Crear evento a las 9 de la mañana con 37 minutos/Ingresó al módulo Registrar personas a las 9 de la mañana con 37 minutos/', '10:40:06 AM'),
(57, '010203', '2021-12-12', 'Domingo', '10:40:16 AM', '', '10:41:08 AM'),
(58, '654321', '2021-12-12', 'Domingo', '10:41:20 AM', 'Salió del módulo Inicio a las 9 de la mañana con 41 minutos/Ingresó al módulo Consultar personas a las 9 de la mañana con 41 minutos/Salió del módulo Consultar personas a las 9 de la mañana con 43 minutos/Ingresó al módulo Seguridad (Gestionar roles y permisos) a las 9 de la mañana con 43 minutos/Salió del módulo Seguridad (Gestionar roles y permisos) a las 9 de la mañana con 44 minutos/Ingresó al módulo Registrar personas a las 9 de la mañana con 44 minutos/Salió del módulo Registrar personas a las 9 de la mañana con 46 minutos/Ingresó al módulo Seguridad (Gestionar roles y permisos) a las 9 de la mañana con 46 minutos/Salió del módulo Seguridad (Gestionar roles y permisos) a las 9 de la mañana con 46 minutos/Ingresó al módulo Consultar personas a las 9 de la mañana con 46 minutos/', '10:49:34 AM'),
(59, '654321', '2021-12-13', 'Lunes', '09:33:53 PM', 'Salió del módulo Inicio a las 8 de la noche con 34 minutos/Ingresó al módulo Consultar familias a las 8 de la noche con 34 minutos/Salió del módulo Consultar familias a las 8 de la noche con 36 minutos/Ingresó al módulo Consultar vacunados covid a las 8 de la noche con 36 minutos/Salió del módulo Consultar vacunados covid a las 8 de la noche con 37 minutos/Ingresó al módulo Registrar enfermos a las 8 de la noche con 37 minutos/Salió del módulo Registrar enfermos a las 8 de la noche con 38 minutos/Ingresó al módulo Registrar discapacitados a las 8 de la noche con 38 minutos/Salió del módulo Registrar discapacitados a las 8 de la noche con 40 minutos/Ingresó al módulo Registrar vacunados covid a las 8 de la noche con 40 minutos/Vacuna Registrada exitosamente!./Vacunado: 0102033 Eliminado Exitosamente./Salió del módulo Registrar vacunados covid a las 8 de la noche con 43 minutos/Ingresó al módulo Registrar embarazada a las 8 de la noche con 43 minutos/Embarazada Registrada exitosamente!./Embarazada Eliminada Exitosamente/Salió del módulo Registrar embarazada a las 8 de la noche con 44 minutos/Ingresó al módulo Registrar Sector agrícola a las 8 de la noche con 44 minutos/Sector Agricola Registrado exitosamente!./Agricola Actualizado exitosamente!./Sector Agriola Eliminado Exitosamente/Salió del módulo Registrar Sector agrícola a las 8 de la noche con 49 minutos/Ingresó al módulo Registrar grupo deportivo a las 8 de la noche con 49 minutos/Grupo Deportivo  Eliminado Exitosamente./Salió del módulo Registrar grupo deportivo a las 8 de la noche con 51 minutos/Ingresó al módulo Registrar negocios a las 8 de la noche con 51 minutos/Registro de Negocio: Mi bendicion 2020.CA Exitosamente./Negocio:  Actualizado Exitosamente./Salió del módulo Registrar negocios a las 8 de la noche con 54 minutos/Ingresó al módulo Registrar inmuebles a las 8 de la noche con 54 minutos/Registro de Inmueble: Cancha Pedrito Alcachofas \\Exitosamente./Inmueble: Cancha Pedrito Alcachofas Eliminado \\Exitosamente./Salió del módulo Registrar inmuebles a las 9 de la noche con 0 minutos/Ingresó al módulo Consejo Comunal Asignar Comite a las 9 de la noche con 0 minutos/El portador de la cedula 010203 fue registrado como vocero \\Exitosamente./El portador de la cedula  fue Actualizado como vocero \\Exitosamente./El Vocero fue Eliminado Exitosamente./Salió del módulo Consejo Comunal Asignar Comite a las 9 de la noche con 1 minutos/Ingresó al módulo Registrar centro de votación a las 9 de la noche con 1 minutos/Votante Portador de la Cedula: Mary López Eliminado \\Exitosamente./Votante Portador de la Cedula: Mary López Eliminado \\Exitosamente./Votante Portador de la Cedula: Mary López Eliminado \\Exitosamente./Votante Portador de la Cedula: Persona1 Apellido1 Eliminado \\Exitosamente./Salió del módulo Registrar centro de votación a las 9 de la noche con 5 minutos/Ingresó al módulo Seguridad (Gestionar roles y permisos) a las 9 de la noche con 5 minutos/Salió del módulo Registrar centro de votación a las 9 de la noche con 5 minutos/Ingresó al módulo Seguridad (Gestionar roles y permisos) a las 9 de la noche con 5 minutos/Salió del módulo Seguridad (Gestionar roles y permisos) a las 9 de la noche con 5 minutos/Ingresó al módulo Generar Censos a las 9 de la noche con 5 minutos/Salió del módulo Generar Censos a las 9 de la noche con 5 minutos/Ingresó al módulo Crear evento a las 9 de la noche con 5 minutos/Salió del módulo Crear evento a las 9 de la noche con 6 minutos/Ingresó al módulo Inicio a las 9 de la noche con 6 minutos/Salió del módulo Inicio a las 9 de la noche con 6 minutos/Ingresó al módulo Crear evento a las 9 de la noche con 6 minutos/', '10:07:31 PM'),
(60, '654321', '2021-12-16', 'Jueves', '03:22:17 PM', 'Salió del módulo Inicio a las 2 de la tarde con 24 minutos/Ingresó al módulo Seguridad (Gestionar roles y permisos) a las 2 de la tarde con 24 minutos/Salió del módulo Seguridad (Gestionar roles y permisos) a las 2 de la tarde con 46 minutos/Ingresó al módulo Inicio a las 2 de la tarde con 46 minutos/Salió del módulo Inicio a las 2 de la tarde con 47 minutos/Ingresó al módulo Registrar personas a las 2 de la tarde con 47 minutos/Salió del módulo Inicio a las 12 del medio día con 14 minutos/Ingresó al módulo Seguridad (Gestionar roles y permisos) a las 12 del medio día con 14 minutos/Salió del módulo Inicio a las 11 de la mañana con 11 minutos/Ingresó al módulo Seguridad (Gestionar roles y permisos) a las 11 de la mañana con 11 minutos/Salió del módulo Seguridad (Gestionar roles y permisos) a las 11 de la mañana con 21 minutos/Ingresó al módulo Consultar eventos a las 11 de la mañana con 21 minutos/Salió del módulo Inicio a las 7 de la noche con 11 minutos/Ingresó al módulo Seguridad (Gestionar roles y permisos) a las 7 de la noche con 11 minutos/', 'Activo'),
(61, '654321', '2021-12-17', 'Viernes', '01:14:04 PM', 'Salió del módulo Inicio a las 12 del medio día con 14 minutos/Ingresó al módulo Seguridad (Gestionar roles y permisos) a las 12 del medio día con 14 minutos/', '11:53:37 AM'),
(62, '654321', '2021-12-18', 'Sábado', '11:53:46 AM', '', '11:56:27 AM'),
(63, '654321', '2021-12-18', 'Sábado', '11:57:53 AM', '', '12:10:58 PM'),
(64, '654321', '2021-12-18', 'Sábado', '12:11:09 PM', 'Salió del módulo Inicio a las 11 de la mañana con 11 minutos/Ingresó al módulo Seguridad (Gestionar roles y permisos) a las 11 de la mañana con 11 minutos/Salió del módulo Seguridad (Gestionar roles y permisos) a las 11 de la mañana con 21 minutos/Ingresó al módulo Consultar eventos a las 11 de la mañana con 21 minutos/Salió del módulo Inicio a las 7 de la noche con 11 minutos/Ingresó al módulo Seguridad (Gestionar roles y permisos) a las 7 de la noche con 11 minutos/', 'Activo'),
(65, '654321', '2021-12-20', 'Lunes', '08:11:38 PM', 'Salió del módulo Inicio a las 7 de la noche con 11 minutos/Ingresó al módulo Seguridad (Gestionar roles y permisos) a las 7 de la noche con 11 minutos/', '11:42:35 AM'),
(66, '654321', '2021-12-23', 'Jueves', '11:42:44 AM', '', '11:43:02 AM'),
(67, '654321', '2021-12-23', 'Jueves', '11:43:10 AM', '', 'Activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bonos`
--

CREATE TABLE `bonos` (
  `id_bono` int(11) NOT NULL,
  `nombre_bono` text NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `bonos`
--

INSERT INTO `bonos` (`id_bono`, `nombre_bono`, `estado`) VALUES
(1, 'Parto Humanizado', 1),
(2, 'Hogares de la Patria', 1),
(3, 'Lactancia Materna', 1),
(4, 'Jose Gregorio Hernanadez', 1),
(5, 'Becas de Educacion Universitaria', 1),
(6, '100% Escolaridad', 1),
(7, 'Economia Popular', 1),
(8, '100% Amor Mayor', 1),
(9, 'Chamba Juvenil', 1),
(10, 'Somos Venezuela', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calles`
--

CREATE TABLE `calles` (
  `id_calle` int(11) NOT NULL,
  `nombre_calle` varchar(30) NOT NULL,
  `condicion_calle` text,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `calles`
--

INSERT INTO `calles` (`id_calle`, `nombre_calle`, `condicion_calle`, `estado`) VALUES
(1, 'Calle 13', 'sin asfalto, sin acera', 1),
(2, 'Calle 14', 'sin asfalto, con acera', 1),
(3, 'Calle 15', 'sin asfalto, sin acera', 1),
(4, 'Calle 16', 'sin asfalto, sin acera', 1),
(5, 'Calle 17', 'sin asfalto, sin acera', 1);

-- --------------------------------------------------------

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
-- Volcado de datos para la tabla `carnets`
--

INSERT INTO `carnets` (`id_carnet`, `cedula_persona`, `serial_carnet`, `codigo_carnet`, `tipo_carnet`) VALUES
(1, '654321', '0000AP2341', '0000123456', 1),
(2, '654321', '0000MPL11', 'P113MMA22', 2);

-- --------------------------------------------------------

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
-- Volcado de datos para la tabla `centros_votacion`
--

INSERT INTO `centros_votacion` (`id_centro_votacion`, `id_parroquia`, `nombre_centro`, `estado`) VALUES
(1, 2, 'Manuelita Bolivar', 1);

-- --------------------------------------------------------

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
-- Volcado de datos para la tabla `comite`
--

INSERT INTO `comite` (`id_comite`, `nombre_comite`, `cantidad_personas`, `estado`) VALUES
(1, 'Finanzas', 0, 1),
(2, 'Contraloría', 0, 1),
(3, 'Salud', 0, 1),
(4, 'Educación', 0, 1),
(5, 'Habitad y Vivienda', 0, 1),
(6, 'Tierra Urbana', 0, 1),
(7, 'Mesa Técnica de Agua', 0, 1),
(8, 'Alimentación', 0, 1),
(9, 'Energía y gas', 0, 1),
(10, 'Discapacidad', 0, 1),
(11, 'Adulto Mayor', 0, 1),
(12, 'Cultural', 0, 1),
(13, 'Comunicacion', 0, 1),
(14, 'Agricola', 0, 1);

-- --------------------------------------------------------

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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comunidad_indigena`
--

CREATE TABLE `comunidad_indigena` (
  `id_comunidad_indigena` int(11) NOT NULL,
  `nombre_comunidad` text NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `comunidad_indigena`
--

INSERT INTO `comunidad_indigena` (`id_comunidad_indigena`, `nombre_comunidad`, `estado`) VALUES
(2, 'Timoto cuicas', 1),
(4, 'Guajiros', 1);

-- --------------------------------------------------------

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
-- Volcado de datos para la tabla `comunidad_indigena_personas`
--

INSERT INTO `comunidad_indigena_personas` (`id_comunidad_persona`, `id_comunidad_indigena`, `cedula_persona`, `estado`) VALUES
(8, 4, '0102033', 1);

-- --------------------------------------------------------

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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `condicion_ocupacion`
--

CREATE TABLE `condicion_ocupacion` (
  `id_condicion_ocupacion` int(11) NOT NULL,
  `condicion_vivienda` varchar(25) NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `condicion_ocupacion`
--

INSERT INTO `condicion_ocupacion` (`id_condicion_ocupacion`, `condicion_vivienda`, `estado`) VALUES
(1, 'Alquilada', 1),
(2, 'Prestada', 1),
(3, 'Propia pagada', 1),
(4, 'Propia pagándose', 1),
(5, 'Adjudicada', 1),
(6, 'Invadida', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `deportes`
--

CREATE TABLE `deportes` (
  `id_deporte` int(11) NOT NULL,
  `nombre_deporte` text NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `deportes`
--

INSERT INTO `deportes` (`id_deporte`, `nombre_deporte`, `estado`) VALUES
(1, 'Football', 1),
(2, 'Bascketball', 1),
(3, 'Baseball', 1),
(4, 'Voleyball', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `discapacidad`
--

CREATE TABLE `discapacidad` (
  `id_discapacidad` int(11) NOT NULL,
  `nombre_discapacidad` varchar(30) NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `discapacidad`
--

INSERT INTO `discapacidad` (`id_discapacidad`, `nombre_discapacidad`, `estado`) VALUES
(1, 'Autismo', 1),
(2, 'Esclerosis', 1),
(3, 'Cataratas', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `discapacidad_persona`
--

CREATE TABLE `discapacidad_persona` (
  `id_discapacidad_persona` int(11) NOT NULL,
  `cedula_persona` varchar(12) NOT NULL,
  `id_discapacidad` int(11) NOT NULL,
  `necesidades_discapacidad` text,
  `observacion_discapacidad` text,
  `en_cama` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `electrodomesticos`
--

CREATE TABLE `electrodomesticos` (
  `id_electrodomestico` int(11) NOT NULL,
  `nombre_electrodomestico` varchar(30) NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `electrodomesticos`
--

INSERT INTO `electrodomesticos` (`id_electrodomestico`, `nombre_electrodomestico`, `estado`) VALUES
(1, 'Licuadora', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `enfermedades`
--

CREATE TABLE `enfermedades` (
  `id_enfermedad` int(11) NOT NULL,
  `nombre_enfermedad` varchar(30) NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `enfermedades`
--

INSERT INTO `enfermedades` (`id_enfermedad`, `nombre_enfermedad`, `estado`) VALUES
(1, 'Asma', 1),
(2, 'Diabetes', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `familia`
--

CREATE TABLE `familia` (
  `id_familia` int(11) NOT NULL,
  `id_vivienda` int(11) NOT NULL,
  `condicion_ocupacion` varchar(30) NOT NULL,
  `nombre_familia` text NOT NULL,
  `observacion` text,
  `telefono_familia` varchar(12) NOT NULL,
  `ingreso_mensual_aprox` varchar(20) NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `familia`
--

INSERT INTO `familia` (`id_familia`, `id_vivienda`, `condicion_ocupacion`, `nombre_familia`, `observacion`, `telefono_familia`, `ingreso_mensual_aprox`, `estado`) VALUES
(8, 2, '', 'Paredes López', 'Sin observaciones', '0251784633', '60 Bs', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `familia_personas`
--

CREATE TABLE `familia_personas` (
  `id_familia_persona` int(11) NOT NULL,
  `id_familia` int(11) NOT NULL,
  `cedula_persona` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `familia_personas`
--

INSERT INTO `familia_personas` (`id_familia_persona`, `id_familia`, `cedula_persona`) VALUES
(5, 8, '654321'),
(10, 8, '030201');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo_deportivo`
--

CREATE TABLE `grupo_deportivo` (
  `id_grupo_deportivo` int(11) NOT NULL,
  `id_deporte` int(11) NOT NULL,
  `nombre_grupo_deportivo` text NOT NULL,
  `descripcion` text,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `grupo_deportivo`
--

INSERT INTO `grupo_deportivo` (`id_grupo_deportivo`, `id_deporte`, `nombre_grupo_deportivo`, `descripcion`, `estado`) VALUES
(1, 2, 'Los churuguarasos', 'Jugamos bien perron', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inmuebles`
--

CREATE TABLE `inmuebles` (
  `id_inmueble` int(11) NOT NULL,
  `id_calle` int(11) NOT NULL,
  `id_tipo_inmueble` int(11) NOT NULL,
  `nombre_inmueble` varchar(30) NOT NULL,
  `direccion_inmueble` text,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `inmuebles`
--

INSERT INTO `inmuebles` (`id_inmueble`, `id_calle`, `id_tipo_inmueble`, `nombre_inmueble`, `direccion_inmueble`, `estado`) VALUES
(1, 1, 1, 'Cancha Pedrito Alcachofas', 'Entre fororo y canela', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `misiones`
--

CREATE TABLE `misiones` (
  `id_mision` int(11) NOT NULL,
  `nombre_mision` varchar(35) NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `misiones`
--

INSERT INTO `misiones` (`id_mision`, `nombre_mision`, `estado`) VALUES
(11, 'Guaicaipuro', 1),
(12, 'Barrio adentro deportivo', 1),
(13, 'Piar', 1),
(14, 'Negra Hipólita', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modulos`
--

CREATE TABLE `modulos` (
  `id_modulo` int(11) NOT NULL,
  `nombre` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `modulos`
--

INSERT INTO `modulos` (`id_modulo`, `nombre`) VALUES
(1, 'Solicitudes'),
(2, 'Personas'),
(3, 'Agenda'),
(4, 'Comite'),
(5, 'Grupos deportivos'),
(6, 'Parto humanizado'),
(7, 'Enfermos'),
(8, 'Negocios'),
(9, 'Nucleo familiar'),
(10, 'Sector agricola'),
(11, 'Centros de votacion'),
(12, 'Viviendas'),
(13, 'Inmuebles'),
(14, 'Discapacitados'),
(15, 'Vacunados COVID'),
(16, 'Seguridad');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `municipios`
--

CREATE TABLE `municipios` (
  `id_municipio` int(11) NOT NULL,
  `nombre_municipio` text NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `municipios`
--

INSERT INTO `municipios` (`id_municipio`, `nombre_municipio`, `estado`) VALUES
(1, 'Andrés Eloy Blanco', 1),
(2, 'Crespo', 1),
(3, 'Iribarren', 1),
(4, 'Jiménez', 1),
(5, 'Morán', 1),
(6, 'Palavecino', 1),
(7, 'Simón Planas', 1),
(8, 'Torres', 1),
(9, 'Urdaneta', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `negocios`
--

CREATE TABLE `negocios` (
  `id_negocio` int(11) NOT NULL,
  `id_calle` int(11) NOT NULL,
  `nombre_negocio` text NOT NULL,
  `direccion_negocio` text NOT NULL,
  `cedula_propietario` varchar(12) NOT NULL,
  `rif_negocio` text,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `negocios`
--

INSERT INTO `negocios` (`id_negocio`, `id_calle`, `nombre_negocio`, `direccion_negocio`, `cedula_propietario`, `rif_negocio`, `estado`) VALUES
(1, 0, 'Laurita sabrosa 2020.CA', 'Calle 23 entre las piernas de tu abuela', '654321', 'APP22L', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notificaciones`
--

CREATE TABLE `notificaciones` (
  `id_notificacion` int(11) NOT NULL,
  `usuario_emisor` varchar(12) NOT NULL,
  `usuario_receptor` varchar(12) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `accion` text NOT NULL,
  `leido` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `notificaciones`
--

INSERT INTO `notificaciones` (`id_notificacion`, `usuario_emisor`, `usuario_receptor`, `fecha`, `accion`, `leido`) VALUES
(1, '654321', '010203', '2021-12-13 21:36:10', '3/Armando Paredes Creó el evento ``Probando´´ para la(s) fecha(s) : 2021-12-14 , 2021-12-17 , 2022-01-05 en Calle 15 De 08:00 AM hasta 11:00 AM', 0),
(2, '654321', '0102033', '2021-12-13 21:36:10', '3/Armando Paredes Creó el evento ``Probando´´ para la(s) fecha(s) : 2021-12-14 , 2021-12-17 , 2022-01-05 en Calle 15 De 08:00 AM hasta 11:00 AM', 0),
(3, '654321', '654321', '2021-12-13 21:36:10', '3/Armando Paredes Creó el evento ``Probando´´ para la(s) fecha(s) : 2021-12-14 , 2021-12-17 , 2022-01-05 en Calle 15 De 08:00 AM hasta 11:00 AM', 1),
(4, '654321', '030201', '2021-12-13 21:36:11', '3/Armando Paredes Creó el evento ``Probando´´ para la(s) fecha(s) : 2021-12-14 , 2021-12-17 , 2022-01-05 en Calle 15 De 08:00 AM hasta 11:00 AM', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ocupacion`
--

CREATE TABLE `ocupacion` (
  `id_ocupacion` int(11) NOT NULL,
  `nombre_ocupacion` text NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ocupacion`
--

INSERT INTO `ocupacion` (`id_ocupacion`, `nombre_ocupacion`, `estado`) VALUES
(3, 'Estudiante', 1),
(4, 'Ingeniero', 1),
(7, 'Docente', 1),
(8, '4', 1),
(9, '4', 1);

-- --------------------------------------------------------

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

INSERT INTO `ocupacion_persona` (`id_ocupacion_persona`, `cedula_persona`, `id_ocupacion`, `estado`) VALUES
(1, '010203', 8, 1),
(2, '010203', 9, 1);

-- --------------------------------------------------------

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

INSERT INTO `org_politica` (`id_org_politica`, `nombre_org`, `estado`) VALUES
(2, 'Consejo Comunal', 1),
(3, 'Comuna', 1),
(4, 'UBCH', 1),
(5, 'Frente Francisco de Miranda', 1),
(6, 'Colectivos', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `org_politica_persona`
--

CREATE TABLE `org_politica_persona` (
  `id_org_persona` int(11) NOT NULL,
  `cedula_persona` varchar(12) NOT NULL,
  `id_org_politica` int(11) NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

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

INSERT INTO `parroquias` (`id_parroquia`, `id_municipio`, `nombre_parroquia`, `estado`) VALUES
(1, 1, 'Quebrada Honda de Guache', 1),
(2, 1, 'Tamayo', 1),
(3, 1, 'Yacambú', 1),
(4, 2, 'Freitez', 1),
(5, 2, 'José María Blanco', 1),
(6, 3, 'Aguedo Felipe Alvarado', 1),
(7, 3, 'Ana Soto', 1),
(8, 3, 'Buena Vista', 1),
(9, 3, 'Catedral', 1),
(10, 3, 'Concepción', 1),
(11, 3, 'Cují', 1),
(12, 3, 'Juárez', 1),
(13, 3, 'Santa Rosa', 1),
(14, 3, 'Tamaca', 1),
(15, 3, 'Unión', 1),
(16, 4, 'Coronel Mariano Peraza', 1),
(17, 4, 'Cuara', 1),
(18, 4, 'Diego de Losada', 1),
(19, 4, 'José Bernardo Dorante', 1),
(20, 4, 'Juan Bautista Rodríguez', 1),
(21, 4, 'Paraíso de San José', 1),
(22, 4, 'San Miguel', 1),
(23, 4, 'Tintorero', 1),
(24, 5, 'Anzoátegui', 1),
(25, 5, 'Bolívar', 1),
(26, 5, 'Guárico', 1),
(27, 5, 'Hilario Luna y Luna', 1),
(28, 5, 'Humocaro Bajo', 1),
(29, 5, 'Humocaro Alto', 1),
(30, 5, 'La Candelaria', 1),
(31, 5, 'Morán', 1),
(32, 6, 'Cabudare', 1),
(33, 6, 'José Gregorio Bastidas', 1),
(34, 6, 'Agua viva', 1),
(35, 7, 'Buría', 1),
(36, 7, 'Gustavo Vega', 1),
(37, 7, 'Sarare', 1),
(38, 8, 'Altagracia', 1),
(39, 8, 'Antonio Díaz', 1),
(40, 8, 'Camacaro', 1),
(41, 8, 'Castañeda', 1),
(42, 8, 'Cecilio Zubillaga', 1),
(43, 8, 'El Blanco', 1),
(44, 8, 'Espinoza de los Monteros', 1),
(45, 8, 'Heriberto Arrollo', 1),
(46, 8, 'Lara', 1),
(47, 8, 'Las Mercedes', 1),
(48, 8, 'Manuel Morillo', 1),
(49, 8, 'Montaña Verde', 1),
(50, 8, 'Montes de Oca', 1),
(51, 8, 'Reyes de Vargas', 1),
(52, 8, 'Torres', 1),
(53, 8, 'Trinidad Samuel', 1),
(54, 9, 'Xaguas', 1),
(55, 9, 'SiquiSique', 1),
(56, 9, 'San Miguel', 1),
(57, 9, 'Moroturo', 1);

-- --------------------------------------------------------

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
-- Volcado de datos para la tabla `parto_humanizado`
--

INSERT INTO `parto_humanizado` (`id_parto_humanizado`, `cedula_persona`, `recibe_micronutrientes`, `tiempo_gestacion`, `fecha_aprox_parto`, `estado`) VALUES
(1, '0102033', 0, 'medio dia', '2021-12-26', 0);

-- --------------------------------------------------------

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
  `preguntas_seguridad` text,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `personas`
--

INSERT INTO `personas` (`cedula_persona`, `primer_nombre`, `segundo_nombre`, `primer_apellido`, `segundo_apellido`, `nacionalidad`, `jefe_familia`, `propietario_vivienda`, `afrodescendencia`, `sexualidad`, `fecha_nacimiento`, `telefono`, `correo`, `estado_civil`, `privado_libertad`, `genero`, `whatsapp`, `miliciano`, `antiguedad_comunidad`, `jefe_calle`, `nivel_educativo`, `contrasenia`, `rol_inicio`, `preguntas_seguridad`, `estado`) VALUES
('010203', 'Persona1', 'Segundo N', 'Apellido1', 'Apellido2', 'Veneco', 0, 1, 1, 'Heterosexual', '2021-11-29', '02164654', 'No posee', 'Casado(a)', '1', 'M', 1, 0, '2021-11-29', 0, 'Bachiller', 'VkZaRk9WQlRUazVWVkRBNVNYYzlQUT09', 'Administrador', 'VkZaRk9WQlRUazVWVkRBNVNUQXhVbEJVTUdwVVZrVTVVRk5PVGxWVU1EbEpNREZTVUZRd2FnPT0=', 1),
('0102033', 'Alex', 'Eli', 'Tintor', 'Oropeza', 'Venezolano', 1, 1, 0, 'Heterosexual', '1996-06-11', '041401020303', 'No posee', 'Soltero(a)', '0', 'M', 1, 0, '1996-06-11', 0, 'Universitario', 'VjFaRk9WQlRUbWxSVkRBNVNURndVbEJVTUdwYVZVVTVVRk5PYVdSNk1EbEpNazR6VUZRd2FsZHNSVGxRVTA1c1VWUXdPVWt5VmxKUVZEQnFXVEJGT1ZCVFRscFZWREE1U1RKT1FsQlVNR3BYVmtVNVVGTk9hMVZVTURsSk1rNUNVRlF3YWxkV1JUbFFVMDA5', 'Habitante', 'VjFaRk9WQlRUbWxWVkRBNVNURnNVbEJVTUdwWk1tTTVVRk5PV2xWVU1EbEpNa3B1VUZRd2FsbFhZemxRVTA1YVZWUXdPVWt4Y0VKUVZEQnFXVzVqT1ZCVFRtbGtlakE1U1RKT2JsQlVNR3BaYldNNVVGTk9hRlZVTURsSk1sSkNVRlF3YWxsdVl6bFFVMDVxV25vd09Va3lUbTVRVkRCcVdWWkZPVkJUVG1sYWVqQTVTVEZzTTFCVU1HcFpibU01VUZOT2FsRlVNRGxKTVhCU1VGUXdhbGt5WXpsUVUwNXFXbm93T1VreVZsSlFWREJx', 1),
('030201', 'Mary', 'Rebeca', 'López', 'Guedez', 'Japonesa', 0, 0, 0, 'Heterosexual', '2021-11-01', '04145555555', 'No posee', 'Soltero(a)', '0', 'F', 1, 0, '2021-11-01', 0, 'Universitario', 'V1d4Rk9WQlRUbHBWVkRBNVNUSk9ibEJVTUdwWlZrVTVVRk5PYWxGVU1EbEpNa296VUZRd2Fsa3pZemxRVTA1cFpIb3dPVWt5U201UVZEQnFWMVpGT1ZCVFRUMD0=', 'Habitante', 'VjFaRk9WQlRUbWxWVkRBNVNURnNVbEJVTUdwWk1tTTVVRk5PYUZWVU1EbEpNa3BDVUZRd2FsbHJSVGxRVTA1cFpIb3dPVWt5VGtKUVZEQnFWMnhGT1ZCVFRtcGFlakE1U1RKT2JsQlVNR3BYVmtVNVVGTk9hRnA2TURsSk1sSlNVRlF3YWxkV1JUbFFVMDVwV25vd09Va3hiRkpRVkRCcQ==', 1),
('654321', 'Armando', 'Esteban', 'Paredes', 'Quito', 'Venezolano', 1, 1, 0, 'Heterosexual', '1987-05-08', '04121234556', 'JesusCuiGo@gmail.com', 'Divorciado', '0', 'M', 1, 0, '2006-06-17', 1, 'Universitario', 'VjFoak9WQlRUbWxSVkRBNVNURnNVbEJVTUdwYVIyTTVVRk5PWVZWVU1EbEpkejA5', 'Super Usuario', NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas_enfermedades`
--

CREATE TABLE `personas_enfermedades` (
  `id_persona_enfermedad` int(11) NOT NULL,
  `cedula_persona` varchar(12) NOT NULL,
  `id_enfermedad` int(11) NOT NULL,
  `medicamentos` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `personas_enfermedades`
--

INSERT INTO `personas_enfermedades` (`id_persona_enfermedad`, `cedula_persona`, `id_enfermedad`, `medicamentos`) VALUES
(1, '0102033', 1, 'Fororo');

-- --------------------------------------------------------

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
-- Volcado de datos para la tabla `personas_grupo_deportivo`
--

INSERT INTO `personas_grupo_deportivo` (`id_persona_grupo_deportivo`, `cedula_persona`, `id_grupo_deportivo`, `estado`) VALUES
(1, '030201', 1, 0),
(2, '654321', 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona_bonos`
--

CREATE TABLE `persona_bonos` (
  `id_persona_bono` int(11) NOT NULL,
  `cedula_persona` varchar(12) NOT NULL,
  `id_bono` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona_proyecto`
--

CREATE TABLE `persona_proyecto` (
  `id_persona_proyecto` int(11) NOT NULL,
  `cedula_persona` varchar(12) NOT NULL,
  `id_proyecto` int(11) NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

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
-- Volcado de datos para la tabla `proyecto`
--

INSERT INTO `proyecto` (`id_proyecto`, `nombre_proyecto`, `area_proyecto`, `estado_proyecto`, `estado`) VALUES
(1, 'Proyecto prueba', 'Transporte', 'En proceso', 1),
(2, 'Otro proyecto', 'Construcción y mantenimiento', 'Acabado', 1),
(3, 'Otro nuevo', 'Textil o Artesanal', 'Estado nuevo', 1),
(4, 'nuevo proyecto', 'Construcción y mantenimiento', 'Avanzado', 1);

-- --------------------------------------------------------

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
-- Volcado de datos para la tabla `roles_permisos_modulo`
--

INSERT INTO `roles_permisos_modulo` (`id_rol_permiso_modulo`, `rol`, `id_modulo`, `registrar`, `consultar`, `modificar`, `eliminar`) VALUES
(49, 'Super Usuario', 1, 1, 1, 1, 1),
(50, 'Super Usuario', 2, 1, 1, 1, 1),
(51, 'Super Usuario', 3, 1, 1, 1, 1),
(52, 'Super Usuario', 4, 1, 1, 1, 1),
(53, 'Super Usuario', 5, 1, 1, 1, 1),
(54, 'Super Usuario', 6, 1, 1, 1, 1),
(55, 'Super Usuario', 7, 1, 1, 1, 1),
(56, 'Super Usuario', 8, 1, 1, 1, 1),
(57, 'Super Usuario', 9, 1, 1, 1, 1),
(58, 'Super Usuario', 10, 1, 1, 1, 1),
(59, 'Super Usuario', 11, 1, 1, 1, 1),
(60, 'Super Usuario', 12, 1, 1, 1, 1),
(61, 'Super Usuario', 13, 1, 1, 1, 1),
(62, 'Super Usuario', 14, 1, 1, 1, 1),
(63, 'Super Usuario', 15, 1, 1, 1, 1),
(64, 'Super Usuario', 16, 1, 1, 1, 1),
(81, 'Administrador', 1, 0, 0, 0, 0),
(82, 'Administrador', 2, 1, 1, 1, 0),
(83, 'Administrador', 3, 1, 1, 1, 0),
(84, 'Administrador', 4, 1, 1, 1, 0),
(85, 'Administrador', 5, 1, 1, 1, 0),
(86, 'Administrador', 6, 1, 1, 1, 0),
(87, 'Administrador', 7, 1, 1, 1, 0),
(88, 'Administrador', 8, 1, 1, 1, 0),
(89, 'Administrador', 9, 1, 1, 1, 0),
(90, 'Administrador', 10, 1, 1, 1, 0),
(91, 'Administrador', 11, 1, 1, 1, 0),
(92, 'Administrador', 12, 1, 1, 1, 0),
(93, 'Administrador', 13, 1, 1, 1, 0),
(94, 'Administrador', 14, 1, 1, 1, 0),
(95, 'Administrador', 15, 1, 1, 1, 0),
(96, 'Administrador', 16, 0, 0, 0, 0),
(97, 'Habitante', 1, 0, 0, 0, 0),
(98, 'Habitante', 2, 1, 1, 0, 0),
(99, 'Habitante', 3, 1, 1, 0, 0),
(100, 'Habitante', 4, 0, 0, 0, 0),
(101, 'Habitante', 5, 0, 0, 0, 0),
(102, 'Habitante', 6, 0, 0, 0, 0),
(103, 'Habitante', 7, 0, 0, 0, 0),
(104, 'Habitante', 8, 0, 0, 0, 0),
(105, 'Habitante', 9, 1, 1, 0, 0),
(106, 'Habitante', 10, 0, 0, 0, 0),
(107, 'Habitante', 11, 0, 0, 0, 0),
(108, 'Habitante', 12, 1, 1, 0, 0),
(109, 'Habitante', 13, 0, 0, 0, 0),
(110, 'Habitante', 14, 0, 0, 0, 0),
(111, 'Habitante', 15, 0, 0, 0, 0),
(112, 'Habitante', 16, 0, 0, 0, 0);

-- --------------------------------------------------------

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
-- Volcado de datos para la tabla `sector_agricola`
--

INSERT INTO `sector_agricola` (`id_sector_agricola`, `cedula_persona`, `area_produccion`, `anios_experiencia`, `rubro_principal`, `rubro_alternativo`, `registro_INTI`, `constancia_productor`, `senial_hierro`, `financiado`, `agua_riego`, `produccion_actual`, `org_agricola`, `estado`) VALUES
(2, '030201', 'Comidita', 20, 'monos', 'chivos', 0, 0, 0, '32', 0, 0, 'Alimentos Imaginate CA', 0);

-- --------------------------------------------------------

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
-- Volcado de datos para la tabla `servicios`
--

INSERT INTO `servicios` (`id_servicio`, `agua_consumo`, `residuos_solidos`, `aguas_negras`, `cable_telefonico`, `internet`, `servicio_electrico`, `estado`) VALUES
(2, 'Acueducto', 'Aseo Urbano', 'Cloacas', 1, 1, 1, 1),
(3, 'Acueducto', 'Aseo Urbano', 'Ninguno', 0, 0, 0, 1),
(11, 'Acueducto', 'Aseo Urbano', 'Cloacas', 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio_gas`
--

CREATE TABLE `servicio_gas` (
  `id_servicio_gas` int(11) NOT NULL,
  `nombre_servicio_gas` varchar(35) NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `servicio_gas`
--

INSERT INTO `servicio_gas` (`id_servicio_gas`, `nombre_servicio_gas`, `estado`) VALUES
(1, 'PDV Comunal', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitudes`
--

CREATE TABLE `solicitudes` (
  `id_solicitud` int(11) NOT NULL,
  `cedula_persona` varchar(12) NOT NULL,
  `fecha_solicitud` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tipo_constancia` varchar(30) NOT NULL,
  `procesada` int(11) NOT NULL,
  `motivo_constancia` text NOT NULL,
  `observaciones` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `solicitudes`
--

INSERT INTO `solicitudes` (`id_solicitud`, `cedula_persona`, `fecha_solicitud`, `tipo_constancia`, `procesada`, `motivo_constancia`, `observaciones`) VALUES
(1, '654321', '2021-11-01 14:16:21', 'Residencia', 2, 'Requerido para proceso universitario', 'Rechazada el 1-11-2021/No cumple los requisitos'),
(14, '654321', '2021-11-08 21:34:51', 'Residencia', 1, 'bvnbv', 'Aprobada el 8-11-2021'),
(15, '654321', '2021-11-11 09:36:59', 'Buena conducta', 2, 'motivo', 'Rechazada el 11-11-2021/no cumple pues');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_inmueble`
--

CREATE TABLE `tipo_inmueble` (
  `id_tipo_inmueble` int(11) NOT NULL,
  `nombre_tipo` text NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipo_inmueble`
--

INSERT INTO `tipo_inmueble` (`id_tipo_inmueble`, `nombre_tipo`, `estado`) VALUES
(1, 'Cancha', 1),
(2, 'CDI', 1),
(3, 'Escuela', 1),
(4, 'Liceo', 1),
(5, 'Base de Misiones', 1),
(6, 'Iglesia', 1),
(7, 'Casa de la Cultura', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_pared`
--

CREATE TABLE `tipo_pared` (
  `id_tipo_pared` int(11) NOT NULL,
  `pared` text NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipo_pared`
--

INSERT INTO `tipo_pared` (`id_tipo_pared`, `pared`, `estado`) VALUES
(1, 'Bloque, ladrillo o adobe frisado', 1),
(2, 'Bloque, ladrillo o adobe sin frisar', 1),
(3, 'Concreto', 1),
(4, 'Laminas Policluro de vinilo PVC', 1),
(5, 'Tapia o bahareque', 1),
(6, 'Troncos o piedras', 1),
(7, 'Zinc, cartón, tablas o similar', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_piso`
--

CREATE TABLE `tipo_piso` (
  `id_tipo_piso` int(11) NOT NULL,
  `piso` text NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipo_piso`
--

INSERT INTO `tipo_piso` (`id_tipo_piso`, `piso`, `estado`) VALUES
(1, 'Cemento', 1),
(2, 'Tierra', 1),
(3, 'Tablas', 1),
(4, 'Cerámicas', 1),
(5, 'Granito', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_techo`
--

CREATE TABLE `tipo_techo` (
  `id_tipo_techo` int(11) NOT NULL,
  `techo` text NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipo_techo`
--

INSERT INTO `tipo_techo` (`id_tipo_techo`, `techo`, `estado`) VALUES
(1, 'Platabanda', 1),
(2, 'Láminas asfálticas', 1),
(3, 'Tela', 1),
(4, 'Asbesto y similares', 1),
(5, 'Láminas de policloruro de vinilo PVC', 1),
(6, 'Láminas metálicas (zinc , aluminio,similares)', 1),
(7, 'Latón, tablas o similares', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_vivienda`
--

CREATE TABLE `tipo_vivienda` (
  `id_tipo_vivienda` int(11) NOT NULL,
  `nombre_tipo_vivienda` text NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipo_vivienda`
--

INSERT INTO `tipo_vivienda` (`id_tipo_vivienda`, `nombre_tipo_vivienda`, `estado`) VALUES
(1, 'Casa de vecindad', 1),
(2, 'Rancho', 1),
(3, 'Casa', 1),
(4, 'Refugio', 1),
(5, 'Anexo ', 1),
(6, 'Casa de Gobierno ', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transporte`
--

CREATE TABLE `transporte` (
  `id_transporte` int(11) NOT NULL,
  `cedula_propietario` varchar(12) NOT NULL,
  `descripcion_transporte` text NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

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
-- Volcado de datos para la tabla `vacuna_covid`
--

INSERT INTO `vacuna_covid` (`id_vacuna_covid`, `cedula_persona`, `dosis`, `fecha_vacuna`, `estado`) VALUES
(1, '0102033', 'Primera Dosis', '2021-12-08', 0);

-- --------------------------------------------------------

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
  `descripcion` text,
  `estado` int(11) NOT NULL,
  `animales_domesticos` int(11) NOT NULL,
  `insectos_roedores` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `vivienda`
--

INSERT INTO `vivienda` (`id_vivienda`, `id_calle`, `id_tipo_vivienda`, `id_servicio`, `direccion_vivienda`, `numero_casa`, `cantidad_habitaciones`, `espacio_siembra`, `hacinamiento`, `banio_sanitario`, `condicion`, `descripcion`, `estado`, `animales_domesticos`, `insectos_roedores`) VALUES
(2, 1, 3, 2, 'Calle 13 entre carreras 5 y 6', '23-14', 4, 0, 0, 1, '', 'Se encuentra en condiciones normales', 1, 0, 0),
(11, 3, 3, 11, 'Calle 15 entre callejón 5 y calle Laura', '21-66', 3, 0, 0, 1, 'Buena', '', 1, 0, 0);

-- --------------------------------------------------------

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
-- Volcado de datos para la tabla `vivienda_electrodomesticos`
--

INSERT INTO `vivienda_electrodomesticos` (`id_vivienda_electrodomestico`, `id_electrodomestico`, `id_vivienda`, `cantidad`, `estado`) VALUES
(7, 1, 11, 2, 1);

-- --------------------------------------------------------

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
-- Volcado de datos para la tabla `vivienda_servicio_gas`
--

INSERT INTO `vivienda_servicio_gas` (`id_vivienda_servicio_gas`, `id_servicio_gas`, `id_vivienda`, `tipo_bombona`, `dias_duracion`, `estado`) VALUES
(9, 1, 11, '10 Kg', 7, 1);

-- --------------------------------------------------------

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
-- Volcado de datos para la tabla `vivienda_tipo_pared`
--

INSERT INTO `vivienda_tipo_pared` (`id_vivienda_tipo_pared`, `id_tipo_pared`, `id_vivienda`, `estado`) VALUES
(1, 3, 2, 1),
(2, 6, 2, 1),
(10, 1, 11, 1);

-- --------------------------------------------------------

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
-- Volcado de datos para la tabla `vivienda_tipo_piso`
--

INSERT INTO `vivienda_tipo_piso` (`id_vivienda_tipo_piso`, `id_tipo_piso`, `id_vivienda`, `estado`) VALUES
(1, 1, 2, 1),
(2, 5, 2, 1),
(10, 1, 11, 1);

-- --------------------------------------------------------

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
-- Volcado de datos para la tabla `vivienda_tipo_techo`
--

INSERT INTO `vivienda_tipo_techo` (`id_vivienda_tipo_techo`, `id_tipo_techo`, `id_vivienda`, `estado`) VALUES
(1, 1, 2, 1),
(2, 3, 2, 1),
(10, 6, 11, 1);

-- --------------------------------------------------------

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
-- Volcado de datos para la tabla `votantes_centro_votacion`
--

INSERT INTO `votantes_centro_votacion` (`id_votante_centro_votacion`, `id_centro_votacion`, `cedula_votante`, `estado`) VALUES
(1, 1, '010203', 0),
(2, 1, '030201', 0),
(3, 1, '030201', 0),
(4, 1, '030201', 0);

--
-- Índices para tablas volcadas
--

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
  MODIFY `id_agenda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `bitacoras`
--
ALTER TABLE `bitacoras`
  MODIFY `id_bitacora` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT de la tabla `bonos`
--
ALTER TABLE `bonos`
  MODIFY `id_bono` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `calles`
--
ALTER TABLE `calles`
  MODIFY `id_calle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `carnets`
--
ALTER TABLE `carnets`
  MODIFY `id_carnet` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `centros_votacion`
--
ALTER TABLE `centros_votacion`
  MODIFY `id_centro_votacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `comite`
--
ALTER TABLE `comite`
  MODIFY `id_comite` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `comite_persona`
--
ALTER TABLE `comite_persona`
  MODIFY `id_comite_persona` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `comunidad_indigena`
--
ALTER TABLE `comunidad_indigena`
  MODIFY `id_comunidad_indigena` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `comunidad_indigena_personas`
--
ALTER TABLE `comunidad_indigena_personas`
  MODIFY `id_comunidad_persona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `condicion_laboral`
--
ALTER TABLE `condicion_laboral`
  MODIFY `id_cond_laboral` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `id_discapacidad_persona` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `electrodomesticos`
--
ALTER TABLE `electrodomesticos`
  MODIFY `id_electrodomestico` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `enfermedades`
--
ALTER TABLE `enfermedades`
  MODIFY `id_enfermedad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `familia`
--
ALTER TABLE `familia`
  MODIFY `id_familia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `familia_personas`
--
ALTER TABLE `familia_personas`
  MODIFY `id_familia_persona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `grupo_deportivo`
--
ALTER TABLE `grupo_deportivo`
  MODIFY `id_grupo_deportivo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `inmuebles`
--
ALTER TABLE `inmuebles`
  MODIFY `id_inmueble` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  MODIFY `id_negocio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  MODIFY `id_notificacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `ocupacion`
--
ALTER TABLE `ocupacion`
  MODIFY `id_ocupacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `ocupacion_persona`
--
ALTER TABLE `ocupacion_persona`
  MODIFY `id_ocupacion_persona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `org_politica`
--
ALTER TABLE `org_politica`
  MODIFY `id_org_politica` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `org_politica_persona`
--
ALTER TABLE `org_politica_persona`
  MODIFY `id_org_persona` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `parroquias`
--
ALTER TABLE `parroquias`
  MODIFY `id_parroquia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT de la tabla `parto_humanizado`
--
ALTER TABLE `parto_humanizado`
  MODIFY `id_parto_humanizado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `personas_enfermedades`
--
ALTER TABLE `personas_enfermedades`
  MODIFY `id_persona_enfermedad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `personas_grupo_deportivo`
--
ALTER TABLE `personas_grupo_deportivo`
  MODIFY `id_persona_grupo_deportivo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `persona_bonos`
--
ALTER TABLE `persona_bonos`
  MODIFY `id_persona_bono` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `persona_misiones`
--
ALTER TABLE `persona_misiones`
  MODIFY `id_persona_mision` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `persona_proyecto`
--
ALTER TABLE `persona_proyecto`
  MODIFY `id_persona_proyecto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `proyecto`
--
ALTER TABLE `proyecto`
  MODIFY `id_proyecto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `roles_permisos_modulo`
--
ALTER TABLE `roles_permisos_modulo`
  MODIFY `id_rol_permiso_modulo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT de la tabla `sector_agricola`
--
ALTER TABLE `sector_agricola`
  MODIFY `id_sector_agricola` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `servicios`
--
ALTER TABLE `servicios`
  MODIFY `id_servicio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `servicio_gas`
--
ALTER TABLE `servicio_gas`
  MODIFY `id_servicio_gas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
  MODIFY `id_solicitud` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `tipo_inmueble`
--
ALTER TABLE `tipo_inmueble`
  MODIFY `id_tipo_inmueble` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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

--
-- AUTO_INCREMENT de la tabla `tipo_techo`
--
ALTER TABLE `tipo_techo`
  MODIFY `id_tipo_techo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `tipo_vivienda`
--
ALTER TABLE `tipo_vivienda`
  MODIFY `id_tipo_vivienda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `transporte`
--
ALTER TABLE `transporte`
  MODIFY `id_transporte` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `vacuna_covid`
--
ALTER TABLE `vacuna_covid`
  MODIFY `id_vacuna_covid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `vivienda`
--
ALTER TABLE `vivienda`
  MODIFY `id_vivienda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `vivienda_electrodomesticos`
--
ALTER TABLE `vivienda_electrodomesticos`
  MODIFY `id_vivienda_electrodomestico` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `vivienda_servicio_gas`
--
ALTER TABLE `vivienda_servicio_gas`
  MODIFY `id_vivienda_servicio_gas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `vivienda_tipo_pared`
--
ALTER TABLE `vivienda_tipo_pared`
  MODIFY `id_vivienda_tipo_pared` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `vivienda_tipo_piso`
--
ALTER TABLE `vivienda_tipo_piso`
  MODIFY `id_vivienda_tipo_piso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `vivienda_tipo_techo`
--
ALTER TABLE `vivienda_tipo_techo`
  MODIFY `id_vivienda_tipo_techo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `votantes_centro_votacion`
--
ALTER TABLE `votantes_centro_votacion`
  MODIFY `id_votante_centro_votacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `agenda`
--
ALTER TABLE `agenda`
  ADD CONSTRAINT `agenda_ibfk_1` FOREIGN KEY (`creador`) REFERENCES `personas` (`cedula_persona`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `bitacoras`
--
ALTER TABLE `bitacoras`
  ADD CONSTRAINT `bitacoras_ibfk_1` FOREIGN KEY (`cedula_usuario`) REFERENCES `personas` (`cedula_persona`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `carnets`
--
ALTER TABLE `carnets`
  ADD CONSTRAINT `carnets_ibfk_1` FOREIGN KEY (`cedula_persona`) REFERENCES `personas` (`cedula_persona`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `centros_votacion`
--
ALTER TABLE `centros_votacion`
  ADD CONSTRAINT `centros_votacion_ibfk_1` FOREIGN KEY (`id_parroquia`) REFERENCES `parroquias` (`id_parroquia`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `comite_persona`
--
ALTER TABLE `comite_persona`
  ADD CONSTRAINT `comite_persona_ibfk_1` FOREIGN KEY (`cedula_persona`) REFERENCES `personas` (`cedula_persona`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comite_persona_ibfk_2` FOREIGN KEY (`id_comite`) REFERENCES `comite` (`id_comite`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `comunidad_indigena_personas`
--
ALTER TABLE `comunidad_indigena_personas`
  ADD CONSTRAINT `comunidad_indigena_personas_ibfk_1` FOREIGN KEY (`cedula_persona`) REFERENCES `personas` (`cedula_persona`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comunidad_indigena_personas_ibfk_2` FOREIGN KEY (`id_comunidad_indigena`) REFERENCES `comunidad_indigena` (`id_comunidad_indigena`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `condicion_laboral`
--
ALTER TABLE `condicion_laboral`
  ADD CONSTRAINT `condicion_laboral_ibfk_1` FOREIGN KEY (`cedula_persona`) REFERENCES `personas` (`cedula_persona`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `discapacidad_persona`
--
ALTER TABLE `discapacidad_persona`
  ADD CONSTRAINT `discapacidad_persona_ibfk_1` FOREIGN KEY (`cedula_persona`) REFERENCES `personas` (`cedula_persona`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `discapacidad_persona_ibfk_2` FOREIGN KEY (`id_discapacidad`) REFERENCES `discapacidad` (`id_discapacidad`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `familia`
--
ALTER TABLE `familia`
  ADD CONSTRAINT `familia_ibfk_1` FOREIGN KEY (`id_vivienda`) REFERENCES `vivienda` (`id_vivienda`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `familia_personas`
--
ALTER TABLE `familia_personas`
  ADD CONSTRAINT `familia_personas_ibfk_1` FOREIGN KEY (`cedula_persona`) REFERENCES `personas` (`cedula_persona`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `familia_personas_ibfk_2` FOREIGN KEY (`id_familia`) REFERENCES `familia` (`id_familia`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `grupo_deportivo`
--
ALTER TABLE `grupo_deportivo`
  ADD CONSTRAINT `grupo_deportivo_ibfk_1` FOREIGN KEY (`id_deporte`) REFERENCES `deportes` (`id_deporte`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `inmuebles`
--
ALTER TABLE `inmuebles`
  ADD CONSTRAINT `inmuebles_ibfk_1` FOREIGN KEY (`id_calle`) REFERENCES `calles` (`id_calle`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `inmuebles_ibfk_2` FOREIGN KEY (`id_tipo_inmueble`) REFERENCES `tipo_inmueble` (`id_tipo_inmueble`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `negocios`
--
ALTER TABLE `negocios`
  ADD CONSTRAINT `negocios_ibfk_1` FOREIGN KEY (`cedula_propietario`) REFERENCES `personas` (`cedula_persona`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  ADD CONSTRAINT `notificaciones_ibfk_1` FOREIGN KEY (`usuario_emisor`) REFERENCES `personas` (`cedula_persona`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `notificaciones_ibfk_2` FOREIGN KEY (`usuario_receptor`) REFERENCES `personas` (`cedula_persona`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `ocupacion_persona`
--
ALTER TABLE `ocupacion_persona`
  ADD CONSTRAINT `ocupacion_persona_ibfk_1` FOREIGN KEY (`cedula_persona`) REFERENCES `personas` (`cedula_persona`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ocupacion_persona_ibfk_2` FOREIGN KEY (`id_ocupacion`) REFERENCES `ocupacion` (`id_ocupacion`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `org_politica_persona`
--
ALTER TABLE `org_politica_persona`
  ADD CONSTRAINT `org_politica_persona_ibfk_1` FOREIGN KEY (`cedula_persona`) REFERENCES `personas` (`cedula_persona`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `org_politica_persona_ibfk_2` FOREIGN KEY (`id_org_politica`) REFERENCES `org_politica` (`id_org_politica`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `parroquias`
--
ALTER TABLE `parroquias`
  ADD CONSTRAINT `parroquias_ibfk_1` FOREIGN KEY (`id_municipio`) REFERENCES `municipios` (`id_municipio`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `parto_humanizado`
--
ALTER TABLE `parto_humanizado`
  ADD CONSTRAINT `parto_humanizado_ibfk_1` FOREIGN KEY (`cedula_persona`) REFERENCES `personas` (`cedula_persona`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `personas_enfermedades`
--
ALTER TABLE `personas_enfermedades`
  ADD CONSTRAINT `personas_enfermedades_ibfk_1` FOREIGN KEY (`cedula_persona`) REFERENCES `personas` (`cedula_persona`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `personas_enfermedades_ibfk_2` FOREIGN KEY (`id_enfermedad`) REFERENCES `enfermedades` (`id_enfermedad`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `personas_grupo_deportivo`
--
ALTER TABLE `personas_grupo_deportivo`
  ADD CONSTRAINT `personas_grupo_deportivo_ibfk_1` FOREIGN KEY (`cedula_persona`) REFERENCES `personas` (`cedula_persona`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `personas_grupo_deportivo_ibfk_2` FOREIGN KEY (`id_grupo_deportivo`) REFERENCES `grupo_deportivo` (`id_grupo_deportivo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `persona_bonos`
--
ALTER TABLE `persona_bonos`
  ADD CONSTRAINT `persona_bonos_ibfk_1` FOREIGN KEY (`cedula_persona`) REFERENCES `personas` (`cedula_persona`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `persona_bonos_ibfk_2` FOREIGN KEY (`id_bono`) REFERENCES `bonos` (`id_bono`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `persona_misiones`
--
ALTER TABLE `persona_misiones`
  ADD CONSTRAINT `persona_misiones_ibfk_1` FOREIGN KEY (`cedula_persona`) REFERENCES `personas` (`cedula_persona`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `persona_misiones_ibfk_2` FOREIGN KEY (`id_mision`) REFERENCES `misiones` (`id_mision`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `persona_proyecto`
--
ALTER TABLE `persona_proyecto`
  ADD CONSTRAINT `persona_proyecto_ibfk_1` FOREIGN KEY (`cedula_persona`) REFERENCES `personas` (`cedula_persona`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `persona_proyecto_ibfk_2` FOREIGN KEY (`id_proyecto`) REFERENCES `proyecto` (`id_proyecto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `sector_agricola`
--
ALTER TABLE `sector_agricola`
  ADD CONSTRAINT `sector_agricola_ibfk_1` FOREIGN KEY (`cedula_persona`) REFERENCES `personas` (`cedula_persona`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
  ADD CONSTRAINT `solicitudes_ibfk_1` FOREIGN KEY (`cedula_persona`) REFERENCES `personas` (`cedula_persona`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `transporte`
--
ALTER TABLE `transporte`
  ADD CONSTRAINT `transporte_ibfk_1` FOREIGN KEY (`cedula_propietario`) REFERENCES `personas` (`cedula_persona`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `vacuna_covid`
--
ALTER TABLE `vacuna_covid`
  ADD CONSTRAINT `vacuna_covid_ibfk_1` FOREIGN KEY (`cedula_persona`) REFERENCES `personas` (`cedula_persona`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `vivienda`
--
ALTER TABLE `vivienda`
  ADD CONSTRAINT `vivienda_ibfk_1` FOREIGN KEY (`id_calle`) REFERENCES `calles` (`id_calle`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `vivienda_ibfk_2` FOREIGN KEY (`id_tipo_vivienda`) REFERENCES `tipo_vivienda` (`id_tipo_vivienda`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `vivienda_ibfk_4` FOREIGN KEY (`id_servicio`) REFERENCES `servicios` (`id_servicio`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `vivienda_electrodomesticos`
--
ALTER TABLE `vivienda_electrodomesticos`
  ADD CONSTRAINT `vivienda_electrodomesticos_ibfk_1` FOREIGN KEY (`id_vivienda`) REFERENCES `vivienda` (`id_vivienda`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `vivienda_electrodomesticos_ibfk_2` FOREIGN KEY (`id_electrodomestico`) REFERENCES `electrodomesticos` (`id_electrodomestico`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `vivienda_servicio_gas`
--
ALTER TABLE `vivienda_servicio_gas`
  ADD CONSTRAINT `vivienda_servicio_gas_ibfk_1` FOREIGN KEY (`id_vivienda`) REFERENCES `vivienda` (`id_vivienda`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `vivienda_servicio_gas_ibfk_2` FOREIGN KEY (`id_servicio_gas`) REFERENCES `servicio_gas` (`id_servicio_gas`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `vivienda_tipo_pared`
--
ALTER TABLE `vivienda_tipo_pared`
  ADD CONSTRAINT `vivienda_tipo_pared_ibfk_1` FOREIGN KEY (`id_vivienda`) REFERENCES `vivienda` (`id_vivienda`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `vivienda_tipo_pared_ibfk_2` FOREIGN KEY (`id_tipo_pared`) REFERENCES `tipo_pared` (`id_tipo_pared`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `vivienda_tipo_piso`
--
ALTER TABLE `vivienda_tipo_piso`
  ADD CONSTRAINT `vivienda_tipo_piso_ibfk_1` FOREIGN KEY (`id_vivienda`) REFERENCES `vivienda` (`id_vivienda`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `vivienda_tipo_piso_ibfk_2` FOREIGN KEY (`id_tipo_piso`) REFERENCES `tipo_piso` (`id_tipo_piso`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `vivienda_tipo_techo`
--
ALTER TABLE `vivienda_tipo_techo`
  ADD CONSTRAINT `vivienda_tipo_techo_ibfk_1` FOREIGN KEY (`id_vivienda`) REFERENCES `vivienda` (`id_vivienda`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `vivienda_tipo_techo_ibfk_2` FOREIGN KEY (`id_tipo_techo`) REFERENCES `tipo_techo` (`id_tipo_techo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `votantes_centro_votacion`
--
ALTER TABLE `votantes_centro_votacion`
  ADD CONSTRAINT `votantes_centro_votacion_ibfk_1` FOREIGN KEY (`id_centro_votacion`) REFERENCES `centros_votacion` (`id_centro_votacion`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `votantes_centro_votacion_ibfk_2` FOREIGN KEY (`cedula_votante`) REFERENCES `personas` (`cedula_persona`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
