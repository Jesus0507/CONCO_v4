<?php

class Reportes_Class extends Modelo 
{

    public function __construct() 
    {
        parent::__construct();
    }    

     public function Familia_Vivienda($id_familia) 
     {

         $tabla            = "SELECT DISTINCT p.cedula_persona, f.*, fp.*, p.*, v.*, c.*, t.*, s.* FROM familia f, familia_personas fp, personas p, vivienda v, calles c, tipo_vivienda t, servicios s WHERE f.id_vivienda = v.id_vivienda AND f.id_familia = fp.id_familia AND p.cedula_persona = fp.cedula_persona AND v.id_calle = c.id_calle AND p.estado = 1 AND v.id_tipo_vivienda = t.id_tipo_vivienda AND v.id_servicio = s.id_servicio  AND f.id_familia = $id_familia ORDER BY `c`.`nombre_calle` ASC";
         $respuesta_arreglo = '';
         try {
             $datos = $this->conexion->prepare($tabla);
             $datos->execute();
             $datos->setFetchMode(PDO::FETCH_ASSOC);
             $respuesta_arreglo = $datos->fetchAll(PDO::FETCH_ASSOC);
             return $respuesta_arreglo;
         } catch (PDOException $e) {

             return $this->Capturar_Error($e);
         }
     }


     public function Milicianos()
     {

         $tabla            = "SELECT * FROM familia f, familia_personas fp, personas p,vivienda v,calles c WHERE f.id_vivienda = v.id_vivienda and f.id_familia = fp.id_familia and p.cedula_persona = fp.cedula_persona and v.id_calle = c.id_calle AND p.miliciano =1 ORDER BY `c`.`nombre_calle` ASC";
         $respuesta_arreglo = '';
         try {
             $datos = $this->conexion->prepare($tabla);
             $datos->execute();
             $datos->setFetchMode(PDO::FETCH_ASSOC);
             $respuesta_arreglo = $datos->fetchAll(PDO::FETCH_ASSOC);
             return $respuesta_arreglo;
         } catch (PDOException $e) {

             return $this->Capturar_Error($e);
         }
     }

     public function Personas_Familia() 
     {

         $tabla            = "SELECT DISTINCT p.cedula_persona, f.*,fp.*,p.*,v.*,c.* FROM familia f, familia_personas fp, personas p, vivienda v, calles c WHERE f.id_vivienda = v.id_vivienda AND f.id_familia = fp.id_familia AND p.cedula_persona = fp.cedula_persona AND v.id_calle = c.id_calle AND p.estado = 1 ORDER BY `c`.`nombre_calle` ASC";
         $respuesta_arreglo = '';
         try {
             $datos = $this->conexion->prepare($tabla);
             $datos->execute();
             $datos->setFetchMode(PDO::FETCH_ASSOC);
             $respuesta_arreglo = $datos->fetchAll(PDO::FETCH_ASSOC);
             return $respuesta_arreglo;
         } catch (PDOException $e) {

             return $this->Capturar_Error($e);
         }
     }

     public function Poblacion_Edades() 
     {

         $tabla            = "SELECT DISTINCT p.cedula_persona, fp.id_familia, TIMESTAMPDIFF(YEAR,p.fecha_nacimiento,CURDATE()) AS edad, p.primer_nombre, p.segundo_nombre, p.primer_apellido, p.segundo_apellido, p.genero, c.nombre_calle FROM familia f, familia_personas fp, personas p, vivienda v, calles c WHERE f.id_vivienda = v.id_vivienda AND f.id_familia = fp.id_familia AND p.cedula_persona = fp.cedula_persona AND v.id_calle = c.id_calle AND p.estado = 1 ORDER BY `c`.`nombre_calle`, edad ASC";
         $respuesta_arreglo = '';
         try {
             $datos = $this->conexion->prepare($tabla);
             $datos->execute();
             $datos->setFetchMode(PDO::FETCH_ASSOC);
             $respuesta_arreglo = $datos->fetchAll(PDO::FETCH_ASSOC);
             return $respuesta_arreglo;
         } catch (PDOException $e) {

             return $this->Capturar_Error($e);
         }
     }

     public function Embarazadas() 
     {

         $tabla            = "SELECT DISTINCT p.cedula_persona, f.*, fp.*, p.*, v.*, c.*, par.* FROM familia f, familia_personas fp, personas p, vivienda v, calles c, parto_humanizado par WHERE f.id_vivienda = v.id_vivienda AND f.id_familia = fp.id_familia AND p.cedula_persona = fp.cedula_persona AND v.id_calle = c.id_calle AND p.estado = 1 AND par.estado = 1 AND par.cedula_persona = fp.cedula_persona ORDER BY `c`.`nombre_calle` ASC";
         $respuesta_arreglo = '';
         try {
             $datos = $this->conexion->prepare($tabla);
             $datos->execute();
             $datos->setFetchMode(PDO::FETCH_ASSOC);
             $respuesta_arreglo = $datos->fetchAll(PDO::FETCH_ASSOC);
             return $respuesta_arreglo;
         } catch (PDOException $e) {

             return $this->Capturar_Error($e);
         }
     }

     public function Persona_Centro_Votacion()
    { 

        $tabla = "SELECT DISTINCT p.cedula_persona, f.*, fp.*, p.*, v.*, c.*, vc.*, cv.* FROM familia f, familia_personas fp, personas p, vivienda v, calles c, votantes_centro_votacion vc, centros_votacion cv WHERE f.id_vivienda = v.id_vivienda AND f.id_familia = fp.id_familia AND p.cedula_persona = fp.cedula_persona AND v.id_calle = c.id_calle AND p.estado = 1 AND vc.id_centro_votacion = cv.id_centro_votacion and vc.cedula_votante = fp.cedula_persona ORDER BY `c`.`nombre_calle` ASC";
        $respuesta_arreglo = '';
        try {
            $datos = $this->conexion->prepare($tabla);
            $datos->execute();
            $datos->setFetchMode(PDO::FETCH_ASSOC);
            $respuesta_arreglo = $datos->fetchAll(PDO::FETCH_ASSOC);
            return $respuesta_arreglo;
        } catch (PDOException $e) {

            return $this->Capturar_Error($e);
        }
    }

     public function Inmuebles()
    {

        $tabla = "SELECT id_inmueble, nombre_inmueble, direccion_inmueble, c.id_calle, c.nombre_calle, t.id_tipo_inmueble, t.nombre_tipo, i.estado FROM inmuebles i INNER JOIN calles c, tipo_inmueble t WHERE i.estado = 1 AND i.id_calle = c.id_calle AND i.id_tipo_inmueble = t.id_tipo_inmueble ORDER BY `c`.`nombre_calle` ASC";
        $respuesta_arreglo = '';
        try {
            $datos = $this->conexion->prepare($tabla);
            $datos->execute();
            $datos->setFetchMode(PDO::FETCH_ASSOC);
            $respuesta_arreglo = $datos->fetchAll(PDO::FETCH_ASSOC);
            return $respuesta_arreglo;
        } catch (PDOException $e) {

            return $this->Capturar_Error($e);
        }
    }

     public function Negocios()
    {

        $tabla = "SELECT id_negocio, nombre_negocio, direccion_negocio, cedula_propietario, p.primer_nombre, p.primer_apellido, rif_negocio, c.id_calle, c.nombre_calle, n.estado FROM negocios n INNER JOIN calles c,personas p WHERE n.cedula_propietario = p.cedula_persona and n.estado = 1 AND n.id_calle = c.id_calle ORDER BY `c`.`nombre_calle` ASC";
        $respuesta_arreglo = '';
        try {
            $datos = $this->conexion->prepare($tabla);
            $datos->execute();
            $datos->setFetchMode(PDO::FETCH_ASSOC);
            $respuesta_arreglo = $datos->fetchAll(PDO::FETCH_ASSOC);
            return $respuesta_arreglo;
        } catch (PDOException $e) {

            return $this->Capturar_Error($e);
        }
    }

    public function Viviendas()
    {

        $tabla = "SELECT V.*, C.*, T.*, S.* FROM vivienda V, calles C, tipo_vivienda T, servicios S WHERE V.estado = 1 AND V.id_calle = c.id_calle AND V.id_tipo_vivienda = T.id_tipo_vivienda AND V.id_servicio = S.id_servicio   ORDER BY V.numero_casa ASC";
        $respuesta_arreglo = '';
        try {
            $datos = $this->conexion->prepare($tabla);
            $datos->execute();
            $datos->setFetchMode(PDO::FETCH_ASSOC);
            $respuesta_arreglo = $datos->fetchAll(PDO::FETCH_ASSOC);
            return $respuesta_arreglo;
        } catch (PDOException $e) {

            return $this->Capturar_Error($e);
        }
    }

     public function Nivel_Educativo()
    {

        $tabla = "SELECT p.cedula_persona, primer_nombre, segundo_nombre ,primer_apellido, segundo_apellido, nivel_educativo,c.nombre_calle FROM familia f, familia_personas fp, personas p,vivienda v,calles c WHERE p.estado = 1 AND f.id_vivienda = v.id_vivienda and f.id_familia = fp.id_familia and p.cedula_persona = fp.cedula_persona and v.id_calle = c.id_calle AND p.miliciano =1 ORDER BY `c`.`nombre_calle` ASC";
        $respuesta_arreglo = '';
        try {
            $datos = $this->conexion->prepare($tabla);
            $datos->execute();
            $datos->setFetchMode(PDO::FETCH_ASSOC);
            $respuesta_arreglo = $datos->fetchAll(PDO::FETCH_ASSOC);
            return $respuesta_arreglo;
        } catch (PDOException $e) {

            return $this->Capturar_Error($e);
        }
    }

    public function Comites_Personas()
    {

        $tabla = "SELECT * FROM familia f, familia_personas fp, personas p,vivienda v,calles c,comite_persona cc,comite co WHERE f.id_vivienda = v.id_vivienda and f.id_familia = fp.id_familia and p.cedula_persona = fp.cedula_persona and v.id_calle = c.id_calle AND p.miliciano =1 and cc.id_comite = co.id_comite AND cc.cedula_persona = fp.cedula_persona ORDER BY `c`.`nombre_calle` ASC";
        $respuesta_arreglo = '';
        try {
            $datos = $this->conexion->prepare($tabla);
            $datos->execute();
            $datos->setFetchMode(PDO::FETCH_ASSOC);
            $respuesta_arreglo = $datos->fetchAll(PDO::FETCH_ASSOC);
            return $respuesta_arreglo;
        } catch (PDOException $e) {

            return $this->Capturar_Error($e);
        }
    }

     public function Carnet_Personas()
    {

        $tabla = "SELECT p.cedula_persona, primer_nombre, segundo_nombre, primer_apellido, segundo_apellido, c.nombre_calle, cp.* FROM familia f, familia_personas fp, personas p, vivienda v, calles c, carnets cp WHERE p.estado = 1 AND f.id_vivienda = v.id_vivienda AND f.id_familia = fp.id_familia AND p.cedula_persona = fp.cedula_persona AND v.id_calle = c.id_calle AND p.miliciano = 1 and cp.cedula_persona = fp.cedula_persona ORDER BY `c`.`nombre_calle` ASC";
        $respuesta_arreglo = '';
        try {
            $datos = $this->conexion->prepare($tabla);
            $datos->execute();
            $datos->setFetchMode(PDO::FETCH_ASSOC);
            $respuesta_arreglo = $datos->fetchAll(PDO::FETCH_ASSOC);
            return $respuesta_arreglo;
        } catch (PDOException $e) {

            return $this->Capturar_Error($e);
        }
    }

    public function Discapacitados()
    {

        $tabla            = "SELECT DISTINCT dp.cedula_persona, f.*,fp.*,p.*,v.*,v.*,c.* FROM familia f, familia_personas fp, personas p, vivienda v, calles c, discapacidad_persona dp WHERE f.id_vivienda = v.id_vivienda AND f.id_familia = fp.id_familia AND p.cedula_persona = fp.cedula_persona AND v.id_calle = c.id_calle AND dp.cedula_persona = fp.cedula_persona ORDER BY `c`.`nombre_calle` ASC";
        $respuesta_arreglo = '';
        try {
            $datos = $this->conexion->prepare($tabla);
            $datos->execute();
            $datos->setFetchMode(PDO::FETCH_ASSOC);
            $respuesta_arreglo = $datos->fetchAll(PDO::FETCH_ASSOC);
            return $respuesta_arreglo;
        } catch (PDOException $e) {

            return $this->Capturar_Error($e);
        }
    }

    public function Discapacidades()
    {

        $tabla            = "SELECT D.*,DP.* FROM discapacidad D, discapacidad_persona DP WHERE DP.id_discapacidad=D.id_discapacidad AND D.estado=1";
        $respuesta_arreglo = '';
        try {
            $datos = $this->conexion->prepare($tabla);
            $datos->execute();
            $datos->setFetchMode(PDO::FETCH_ASSOC);
            $respuesta_arreglo = $datos->fetchAll(PDO::FETCH_ASSOC);
            return $respuesta_arreglo;
        } catch (PDOException $e) {

            return $this->Capturar_Error($e);
        }
    }
    public function Enfermos()
    {

        $tabla            = "SELECT DISTINCT PE.cedula_persona, P.* FROM personas_enfermedades PE, personas P WHERE PE.cedula_persona=P.cedula_persona AND P.estado=1";
        $respuesta_arreglo = '';
        try {
            $datos = $this->conexion->prepare($tabla);
            $datos->execute();
            $datos->setFetchMode(PDO::FETCH_ASSOC);
            $respuesta_arreglo = $datos->fetchAll(PDO::FETCH_ASSOC);
            return $respuesta_arreglo;
        } catch (PDOException $e) {

            return $this->Capturar_Error($e);
        }
    }

    public function Enfermedades()
    {

        $tabla            = "SELECT E.*,PE.cedula_persona,PE.medicamentos, PE.id_persona_enfermedad FROM enfermedades E, personas_enfermedades PE WHERE PE.id_enfermedad=E.id_enfermedad AND E.estado=1";
        $respuesta_arreglo = '';
        try {
            $datos = $this->conexion->prepare($tabla);
            $datos->execute();
            $datos->setFetchMode(PDO::FETCH_ASSOC);
            $respuesta_arreglo = $datos->fetchAll(PDO::FETCH_ASSOC);
            return $respuesta_arreglo;
        } catch (PDOException $e) {

            return $this->Capturar_Error($e);
        }
    }

    public function Grupos_Deportivos()
    {

        $tabla            = "SELECT id_grupo_deportivo, g.id_deporte, d.nombre_deporte, g.nombre_grupo_deportivo, g.descripcion, g.estado FROM grupo_deportivo g INNER JOIN deportes d WHERE g.estado = 1 AND g.id_deporte = d.id_deporte";
        $respuesta_arreglo = '';
        try {
            $datos = $this->conexion->prepare($tabla);
            $datos->execute();
            $datos->setFetchMode(PDO::FETCH_ASSOC);
            $respuesta_arreglo = $datos->fetchAll(PDO::FETCH_ASSOC);
            return $respuesta_arreglo;
        } catch (PDOException $e) {

            return $this->Capturar_Error($e);
        }
    } 

    public function Grupo_Deportivo_Persona()
    {

        $tabla = "SELECT pg.id_persona_grupo_deportivo, pg.id_grupo_deportivo, pg.cedula_persona, p.primer_nombre, p.primer_apellido, gp.id_deporte, d.nombre_deporte FROM personas_grupo_deportivo pg, grupo_deportivo gp, personas p, deportes d WHERE pg.estado = 1 AND pg.cedula_persona = p.cedula_persona AND gp.id_deporte = d.id_deporte AND pg.id_grupo_deportivo = gp.id_grupo_deportivo ORDER BY `p`.`primer_nombre` ASC";
        $respuesta_arreglo = '';
        try {
            $datos = $this->conexion->prepare($tabla);
            $datos->execute();
            $datos->setFetchMode(PDO::FETCH_ASSOC);
            $respuesta_arreglo = $datos->fetchAll(PDO::FETCH_ASSOC);
            return $respuesta_arreglo;
        } catch (PDOException $e) {

            return $this->Capturar_Error($e);
        }
    } 

     public function Jefes_Calle()
     {

         $tabla            = "SELECT DISTINCT  f.*, fp.*,p.*,v.*,c.* FROM familia f, familia_personas fp, personas p, vivienda v, calles c WHERE f.estado=1 AND f.id_vivienda = v.id_vivienda AND f.id_familia = fp.id_familia AND p.cedula_persona = fp.cedula_persona AND v.id_calle = c.id_calle AND p.jefe_familia = 1  ORDER BY `c`.`nombre_calle` ASC";
         $respuesta_arreglo = '';
         try {
             $datos = $this->conexion->prepare($tabla);
             $datos->execute();
             $datos->setFetchMode(PDO::FETCH_ASSOC);
             $respuesta_arreglo = $datos->fetchAll(PDO::FETCH_ASSOC);
             return $respuesta_arreglo;
         } catch (PDOException $e) {

             return $this->Capturar_Error($e);
         }
     }

     public function Techo($id)
     {

         $tabla            = "SELECT * FROM vivienda_tipo_techo v, tipo_techo t WHERE v.id_vivienda =$id AND v.estado =1 AND v.id_tipo_techo = t.id_tipo_techo";
         $respuesta_arreglo = '';
         try {
             $datos = $this->conexion->prepare($tabla);
             $datos->execute();
             $datos->setFetchMode(PDO::FETCH_ASSOC);
             $respuesta_arreglo = $datos->fetchAll(PDO::FETCH_ASSOC);
             return $respuesta_arreglo;
         } catch (PDOException $e) {

             return $this->Capturar_Error($e);
         }
     }

public function Pared($id)
     {

         $tabla            = "SELECT * FROM vivienda_tipo_pared v, tipo_pared t WHERE v.id_vivienda =$id AND v.estado =1 AND v.id_tipo_pared = t.id_tipo_pared";
         $respuesta_arreglo = '';
         try {
             $datos = $this->conexion->prepare($tabla);
             $datos->execute();
             $datos->setFetchMode(PDO::FETCH_ASSOC);
             $respuesta_arreglo = $datos->fetchAll(PDO::FETCH_ASSOC);
             return $respuesta_arreglo;
         } catch (PDOException $e) {

             return $this->Capturar_Error($e);
         }
     }

     public function Piso($id)
     {

         $tabla            = "SELECT * FROM vivienda_tipo_piso v, tipo_piso t WHERE v.id_vivienda =$id AND v.estado =1 AND v.id_tipo_piso = t.id_tipo_piso";
         $respuesta_arreglo = '';
         try {
             $datos = $this->conexion->prepare($tabla);
             $datos->execute();
             $datos->setFetchMode(PDO::FETCH_ASSOC);
             $respuesta_arreglo = $datos->fetchAll(PDO::FETCH_ASSOC);
             return $respuesta_arreglo;
         } catch (PDOException $e) {

             return $this->Capturar_Error($e);
         }
     }

     public function GAS($id)
     {

         $tabla            = "SELECT * FROM vivienda_servicio_gas v, servicio_gas s WHERE v.id_vivienda = $id AND v.id_servicio_gas =s.id_servicio_gas AND v.estado=1";
         $respuesta_arreglo = '';
         try {
             $datos = $this->conexion->prepare($tabla);
             $datos->execute();
             $datos->setFetchMode(PDO::FETCH_ASSOC);
             $respuesta_arreglo = $datos->fetchAll(PDO::FETCH_ASSOC);
             return $respuesta_arreglo;
         } catch (PDOException $e) {

             return $this->Capturar_Error($e);
         }
     }

     public function Integranres($id)
     {

         $tabla            = "SELECT * FROM familia_personas f, personas p WHERE f.id_familia = $id AND p.estado =1 AND f.cedula_persona =p.cedula_persona
";
         $respuesta_arreglo = '';
         try {
             $datos = $this->conexion->prepare($tabla);
             $datos->execute();
             $datos->setFetchMode(PDO::FETCH_ASSOC);
             $respuesta_arreglo = $datos->fetchAll(PDO::FETCH_ASSOC);
             return $respuesta_arreglo;
         } catch (PDOException $e) {

             return $this->Capturar_Error($e);
         }
     }

     public function Personas_Proyecto($id)
     {

         $tabla            = "SELECT * FROM persona_proyecto pp, proyecto p WHERE pp.cedula_persona = $id AND pp.id_proyecto = p.id_proyecto";
         $respuesta_arreglo = '';
         try {
             $datos = $this->conexion->prepare($tabla);
             $datos->execute();
             $datos->setFetchMode(PDO::FETCH_ASSOC);
             $respuesta_arreglo = $datos->fetchAll(PDO::FETCH_ASSOC);
             return $respuesta_arreglo;
         } catch (PDOException $e) {

             return $this->Capturar_Error($e);
         }
     }
}
?>