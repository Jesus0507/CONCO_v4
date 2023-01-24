<?php

class Reportes_Class extends Modelo
{
    #Public: acceso sin restricción.
    #Private:Solo puede ser accesado por la clase que lo define.
    private $SQL;           #nombre de la sentencia SQL que se ejecutara en el modelo
    private $tipo;          #tipo de peticion que usaremos 1/0
    private $PDO;           #sentecia sql iniciada con prepare
    private $sentencia;     #sentencia sql que se ejecutara
    private $datos;         #datos a ejecutar para enviar a la bd
    public  $resultado;     #resultado de consultas de la bd
    private $id;
 
    public function __construct(){parent::__construct();}

    // SETTER estaablece los datos a usar en el modelo (tipo void no retornan un valor)
    public function _SQL_(string $SQL): void        {$this->SQL = $SQL;}
    public function _Tipo_(int $tipo): void         {$this->tipo = $tipo;}
    public function _Datos_(array $datos): void     {$this->datos = $datos;}
    public function _Estado_(array $estado): void   {$this->estado = $estado;}
    public function _ID_(string $id): void          {$this->id = $id;}

    // ===============================================================================
    public function Administrar()
    {
        $this->sentencia = $this->{$this->SQL}(); #funcion anonima en espera de asignar nombre
        try {
            switch ($this->tipo) {
                case '0':           #tipo 0 trae consultas de la bd retorna a un array con los datos 
                    $this->conexion->beginTransaction(); # Inicia una transacción
                    $this->PDO = $this->conexion->prepare($this->sentencia);
                    $this->PDO->execute();
                    $this->conexion->commit(); #Consigna una transacción
                    $this->PDO->setFetchMode(PDO::FETCH_ASSOC);
                    $this->resultado = $this->PDO->fetchAll(PDO::FETCH_ASSOC);
                    return $this->resultado;
                    break;
                case '1':       #tipo 1 ejecuta un INSERT , UPDATE, DELETE  retorna a true (si no hay falla)
                    $this->conexion->beginTransaction();
                    $this->PDO = $this->conexion->prepare($this->sentencia);
                    $this->PDO->execute($this->datos);
                    $this->conexion->commit();
                    return true;
                    break;
                default:        # mensaje error si la peticion fue incorrecta
                    die('[Error 400] => "La Peticion es Incorrecta, solo se permite peticion de tipo 0/1."');
                    break;
            }
        } catch (PDOException $e) { #capturamos el error y se envia la respuesta(ubicacion MODELO)
            return $this->Capturar_Error($e, "Reportes"); 
        }
    }

    // ===============================================================================
    
    private function SQL_01(): string
    {
        return "SELECT DISTINCT p.cedula_persona, f.*, fp.*, p.*, v.*, c.*, t.*, s.* FROM familia f, familia_personas fp, personas p, vivienda v, calles c, tipo_vivienda t, servicios s WHERE f.id_vivienda = v.id_vivienda AND f.id_familia = fp.id_familia AND p.cedula_persona = fp.cedula_persona AND v.id_calle = c.id_calle AND p.estado = 1 AND v.id_tipo_vivienda = t.id_tipo_vivienda AND v.id_servicio = s.id_servicio  AND f.id_familia = $this->id_familia ORDER BY `c`.`nombre_calle` ASC";

    }

    private function SQL_02(): string
    {
        return "SELECT * FROM familia f, familia_personas fp, personas p,vivienda v,calles c WHERE f.id_vivienda = v.id_vivienda and f.id_familia = fp.id_familia and p.cedula_persona = fp.cedula_persona and v.id_calle = c.id_calle AND p.miliciano =1 ORDER BY `c`.`nombre_calle` ASC";

    }

    private function SQL_03(): string
    {
        return "SELECT DISTINCT p.cedula_persona, f.*,fp.*,p.*,v.*,c.* FROM familia f, familia_personas fp, personas p, vivienda v, calles c WHERE f.id_vivienda = v.id_vivienda AND f.id_familia = fp.id_familia AND p.cedula_persona = fp.cedula_persona AND v.id_calle = c.id_calle AND p.estado = 1 ORDER BY `c`.`nombre_calle` ASC";

    }

    private function SQL_04(): string
    {
        return "SELECT DISTINCT p.cedula_persona, fp.id_familia, TIMESTAMPDIFF(YEAR,p.fecha_nacimiento,CURDATE()) AS edad, p.primer_nombre, p.segundo_nombre, p.primer_apellido, p.segundo_apellido, p.genero, c.nombre_calle FROM familia f, familia_personas fp, personas p, vivienda v, calles c WHERE f.id_vivienda = v.id_vivienda AND f.id_familia = fp.id_familia AND p.cedula_persona = fp.cedula_persona AND v.id_calle = c.id_calle AND p.estado = 1 ORDER BY `c`.`nombre_calle`, edad ASC";
    }

    private function SQL_05(): string
    {
        return "SELECT DISTINCT p.cedula_persona, f.*, fp.*, p.*, v.*, c.*, par.* FROM familia f, familia_personas fp, personas p, vivienda v, calles c, parto_humanizado par WHERE f.id_vivienda = v.id_vivienda AND f.id_familia = fp.id_familia AND p.cedula_persona = fp.cedula_persona AND v.id_calle = c.id_calle AND p.estado = 1 AND par.estado = 1 AND par.cedula_persona = fp.cedula_persona ORDER BY `c`.`nombre_calle` ASC";

    }

    private function SQL_06(): string
    {
        return "SELECT DISTINCT p.cedula_persona, f.*, fp.*, p.*, v.*, c.*, vc.*, cv.* FROM familia f, familia_personas fp, personas p, vivienda v, calles c, votantes_centro_votacion vc, centros_votacion cv WHERE f.id_vivienda = v.id_vivienda AND f.id_familia = fp.id_familia AND p.cedula_persona = fp.cedula_persona AND v.id_calle = c.id_calle AND p.estado = 1 AND vc.id_centro_votacion = cv.id_centro_votacion and vc.cedula_votante = fp.cedula_persona ORDER BY `c`.`nombre_calle` ASC";

    }

    private function SQL_07(): string
    {
        return "SELECT id_inmueble, nombre_inmueble, direccion_inmueble, c.id_calle, c.nombre_calle, t.id_tipo_inmueble, t.nombre_tipo, i.estado FROM inmuebles i INNER JOIN calles c, tipo_inmueble t WHERE i.estado = 1 AND i.id_calle = c.id_calle AND i.id_tipo_inmueble = t.id_tipo_inmueble ORDER BY `c`.`nombre_calle` ASC";

    }

    private function SQL_08(): string
    {
        return "SELECT id_negocio, nombre_negocio, direccion_negocio, cedula_propietario, p.primer_nombre, p.primer_apellido, rif_negocio, c.id_calle, c.nombre_calle, n.estado FROM negocios n INNER JOIN calles c,personas p WHERE n.cedula_propietario = p.cedula_persona and n.estado = 1 AND n.id_calle = c.id_calle ORDER BY `c`.`nombre_calle` ASC";

    }

    private function SQL_09(): string
    {
        return "SELECT V.*, C.*, T.*, S.* FROM vivienda V, calles C, tipo_vivienda T, servicios S WHERE V.estado = 1 AND V.id_calle = c.id_calle AND V.id_tipo_vivienda = T.id_tipo_vivienda AND V.id_servicio = S.id_servicio   ORDER BY V.numero_casa ASC";

    }

    private function SQL_10(): string
    {
        return "SELECT p.cedula_persona, primer_nombre, segundo_nombre ,primer_apellido, segundo_apellido, nivel_educativo,c.nombre_calle FROM familia f, familia_personas fp, personas p,vivienda v,calles c WHERE p.estado = 1 AND f.id_vivienda = v.id_vivienda and f.id_familia = fp.id_familia and p.cedula_persona = fp.cedula_persona and v.id_calle = c.id_calle AND p.miliciano =1 ORDER BY `c`.`nombre_calle` ASC";

    }

    private function SQL_11(): string
    {
        return "SELECT * FROM familia f, familia_personas fp, personas p,vivienda v,calles c,comite_persona cc,comite co WHERE f.id_vivienda = v.id_vivienda and f.id_familia = fp.id_familia and p.cedula_persona = fp.cedula_persona and v.id_calle = c.id_calle AND p.miliciano =1 and cc.id_comite = co.id_comite AND cc.cedula_persona = fp.cedula_persona ORDER BY `c`.`nombre_calle` ASC";

    }

    private function SQL_12(): string
    {
        return "SELECT p.cedula_persona, primer_nombre, segundo_nombre, primer_apellido, segundo_apellido, c.nombre_calle, cp.* FROM familia f, familia_personas fp, personas p, vivienda v, calles c, carnets cp WHERE p.estado = 1 AND f.id_vivienda = v.id_vivienda AND f.id_familia = fp.id_familia AND p.cedula_persona = fp.cedula_persona AND v.id_calle = c.id_calle AND p.miliciano = 1 and cp.cedula_persona = fp.cedula_persona ORDER BY `c`.`nombre_calle` ASC";

    }
    private function SQL_13(): string
    {
        return "SELECT DISTINCT dp.cedula_persona, f.*,fp.*,p.*,v.*,v.*,c.* FROM familia f, familia_personas fp, personas p, vivienda v, calles c, discapacidad_persona dp WHERE f.id_vivienda = v.id_vivienda AND f.id_familia = fp.id_familia AND p.cedula_persona = fp.cedula_persona AND v.id_calle = c.id_calle AND dp.cedula_persona = fp.cedula_persona ORDER BY `c`.`nombre_calle` ASC";

    }

    private function SQL_14(): string
    {
        return "SELECT D.*,DP.* FROM discapacidad D, discapacidad_persona DP WHERE DP.id_discapacidad=D.id_discapacidad AND D.estado=1";

    }

    private function SQL_15(): string
    {
        return "SELECT DISTINCT PE.cedula_persona, P.* FROM personas_enfermedades PE, personas P WHERE PE.cedula_persona=P.cedula_persona AND P.estado=1";

    }

    private function SQL_16(): string
    {
        return "SELECT E.*,PE.cedula_persona,PE.medicamentos, PE.id_persona_enfermedad FROM enfermedades E, personas_enfermedades PE WHERE PE.id_enfermedad=E.id_enfermedad AND E.estado=1";

    }

    private function SQL_17(): string
    {
        return "SELECT id_grupo_deportivo, g.id_deporte, d.nombre_deporte, g.nombre_grupo_deportivo, g.descripcion, g.estado FROM grupo_deportivo g INNER JOIN deportes d WHERE g.estado = 1 AND g.id_deporte = d.id_deporte";

    }

    private function SQL_18(): string
    {

        return "SELECT pg.id_persona_grupo_deportivo, pg.id_grupo_deportivo, pg.cedula_persona, p.primer_nombre, p.primer_apellido, gp.id_deporte, d.nombre_deporte FROM personas_grupo_deportivo pg, grupo_deportivo gp, personas p, deportes d WHERE pg.estado = 1 AND pg.cedula_persona = p.cedula_persona AND gp.id_deporte = d.id_deporte AND pg.id_grupo_deportivo = gp.id_grupo_deportivo ORDER BY `p`.`primer_nombre` ASC";

    }

    private function SQL_19(): string
    {
        return "SELECT DISTINCT  f.*, fp.*,p.*,v.*,c.* FROM familia f, familia_personas fp, personas p, vivienda v, calles c WHERE f.estado=1 AND f.id_vivienda = v.id_vivienda AND f.id_familia = fp.id_familia AND p.cedula_persona = fp.cedula_persona AND v.id_calle = c.id_calle AND p.jefe_familia = 1  ORDER BY `c`.`nombre_calle` ASC";

    }

    private function SQL_20(): string
    {
        return "SELECT * FROM vivienda_tipo_techo v, tipo_techo t WHERE v.id_vivienda =$this->id AND v.estado =1 AND v.id_tipo_techo = t.id_tipo_techo";

    }

    private function SQL_21(): string
    {
        return "SELECT * FROM vivienda_tipo_pared v, tipo_pared t WHERE v.id_vivienda =$this->id AND v.estado =1 AND v.id_tipo_pared = t.id_tipo_pared";

    }

    private function SQL_22(): string
    {
        return "SELECT * FROM vivienda_tipo_piso v, tipo_piso t WHERE v.id_vivienda =$this->id AND v.estado =1 AND v.id_tipo_piso = t.id_tipo_piso";

    }

    private function SQL_23(): string
    {
        return "SELECT * FROM vivienda_servicio_gas v, servicio_gas s WHERE v.id_vivienda = $this->id AND v.id_servicio_gas =s.id_servicio_gas AND v.estado=1";

    }

    private function SQL_24(): string
    {
        return "SELECT * FROM familia_personas f, personas p WHERE f.id_familia = $this->id AND p.estado =1 AND f.cedula_persona =p.cedula_persona";

    }

    private function SQL_25(): string
    {
        return "SELECT * FROM persona_proyecto pp, proyecto p WHERE pp.cedula_persona = $this->id AND pp.id_proyecto = p.id_proyecto";

    }

    // ===============================================================================

    public function Familia_Vivienda($id_familia)
    {

        $tabla             = "SELECT DISTINCT p.cedula_persona, f.*, fp.*, p.*, v.*, c.*, t.*, s.* FROM familia f, familia_personas fp, personas p, vivienda v, calles c, tipo_vivienda t, servicios s WHERE f.id_vivienda = v.id_vivienda AND f.id_familia = fp.id_familia AND p.cedula_persona = fp.cedula_persona AND v.id_calle = c.id_calle AND p.estado = 1 AND v.id_tipo_vivienda = t.id_tipo_vivienda AND v.id_servicio = s.id_servicio  AND f.id_familia = $id_familia ORDER BY `c`.`nombre_calle` ASC";
        $respuesta_arreglo = '';
        try {
            $datos = $this->conexion->prepare($tabla);
            $datos->execute();
            $datos->setFetchMode(PDO::FETCH_ASSOC);
            $respuesta_arreglo = $datos->fetchAll(PDO::FETCH_ASSOC);
            return $respuesta_arreglo;
        } catch (PDOException $e) {

            return $this->Capturar_Error($e,"Reportes");
        }
    }

    public function Milicianos()
    {

        $tabla             = "SELECT * FROM familia f, familia_personas fp, personas p,vivienda v,calles c WHERE f.id_vivienda = v.id_vivienda and f.id_familia = fp.id_familia and p.cedula_persona = fp.cedula_persona and v.id_calle = c.id_calle AND p.miliciano =1 ORDER BY `c`.`nombre_calle` ASC";
        $respuesta_arreglo = '';
        try {
            $datos = $this->conexion->prepare($tabla);
            $datos->execute();
            $datos->setFetchMode(PDO::FETCH_ASSOC);
            $respuesta_arreglo = $datos->fetchAll(PDO::FETCH_ASSOC);
            return $respuesta_arreglo;
        } catch (PDOException $e) {

            return $this->Capturar_Error($e,"Reportes");
        }
    }

    public function Personas_Familia()
    {

        $tabla             = "SELECT DISTINCT p.cedula_persona, f.*,fp.*,p.*,v.*,c.* FROM familia f, familia_personas fp, personas p, vivienda v, calles c WHERE f.id_vivienda = v.id_vivienda AND f.id_familia = fp.id_familia AND p.cedula_persona = fp.cedula_persona AND v.id_calle = c.id_calle AND p.estado = 1 ORDER BY `c`.`nombre_calle` ASC";
        $respuesta_arreglo = '';
        try {
            $datos = $this->conexion->prepare($tabla);
            $datos->execute();
            $datos->setFetchMode(PDO::FETCH_ASSOC);
            $respuesta_arreglo = $datos->fetchAll(PDO::FETCH_ASSOC);
            return $respuesta_arreglo;
        } catch (PDOException $e) {

            return $this->Capturar_Error($e,"Reportes");
        }
    }

    public function Poblacion_Edades()
    {

        $tabla             = "SELECT DISTINCT p.cedula_persona, fp.id_familia, TIMESTAMPDIFF(YEAR,p.fecha_nacimiento,CURDATE()) AS edad, p.primer_nombre, p.segundo_nombre, p.primer_apellido, p.segundo_apellido, p.genero, c.nombre_calle FROM familia f, familia_personas fp, personas p, vivienda v, calles c WHERE f.id_vivienda = v.id_vivienda AND f.id_familia = fp.id_familia AND p.cedula_persona = fp.cedula_persona AND v.id_calle = c.id_calle AND p.estado = 1 ORDER BY `c`.`nombre_calle`, edad ASC";
        $respuesta_arreglo = '';
        try {
            $datos = $this->conexion->prepare($tabla);
            $datos->execute();
            $datos->setFetchMode(PDO::FETCH_ASSOC);
            $respuesta_arreglo = $datos->fetchAll(PDO::FETCH_ASSOC);
            return $respuesta_arreglo;
        } catch (PDOException $e) {

            return $this->Capturar_Error($e,"Reportes");
        }
    }

    public function Embarazadas()
    {

        $tabla             = "SELECT DISTINCT p.cedula_persona, f.*, fp.*, p.*, v.*, c.*, par.* FROM familia f, familia_personas fp, personas p, vivienda v, calles c, parto_humanizado par WHERE f.id_vivienda = v.id_vivienda AND f.id_familia = fp.id_familia AND p.cedula_persona = fp.cedula_persona AND v.id_calle = c.id_calle AND p.estado = 1 AND par.estado = 1 AND par.cedula_persona = fp.cedula_persona ORDER BY `c`.`nombre_calle` ASC";
        $respuesta_arreglo = '';
        try {
            $datos = $this->conexion->prepare($tabla);
            $datos->execute();
            $datos->setFetchMode(PDO::FETCH_ASSOC);
            $respuesta_arreglo = $datos->fetchAll(PDO::FETCH_ASSOC);
            return $respuesta_arreglo;
        } catch (PDOException $e) {

            return $this->Capturar_Error($e,"Reportes");
        }
    }

    public function Persona_Centro_Votacion()
    {

        $tabla             = "SELECT DISTINCT p.cedula_persona, f.*, fp.*, p.*, v.*, c.*, vc.*, cv.* FROM familia f, familia_personas fp, personas p, vivienda v, calles c, votantes_centro_votacion vc, centros_votacion cv WHERE f.id_vivienda = v.id_vivienda AND f.id_familia = fp.id_familia AND p.cedula_persona = fp.cedula_persona AND v.id_calle = c.id_calle AND p.estado = 1 AND vc.id_centro_votacion = cv.id_centro_votacion and vc.cedula_votante = fp.cedula_persona ORDER BY `c`.`nombre_calle` ASC";
        $respuesta_arreglo = '';
        try {
            $datos = $this->conexion->prepare($tabla);
            $datos->execute();
            $datos->setFetchMode(PDO::FETCH_ASSOC);
            $respuesta_arreglo = $datos->fetchAll(PDO::FETCH_ASSOC);
            return $respuesta_arreglo;
        } catch (PDOException $e) {

            return $this->Capturar_Error($e,"Reportes");
        }
    }

    public function Inmuebles()
    {

        $tabla             = "SELECT id_inmueble, nombre_inmueble, direccion_inmueble, c.id_calle, c.nombre_calle, t.id_tipo_inmueble, t.nombre_tipo, i.estado FROM inmuebles i INNER JOIN calles c, tipo_inmueble t WHERE i.estado = 1 AND i.id_calle = c.id_calle AND i.id_tipo_inmueble = t.id_tipo_inmueble ORDER BY `c`.`nombre_calle` ASC";
        $respuesta_arreglo = '';
        try {
            $datos = $this->conexion->prepare($tabla);
            $datos->execute();
            $datos->setFetchMode(PDO::FETCH_ASSOC);
            $respuesta_arreglo = $datos->fetchAll(PDO::FETCH_ASSOC);
            return $respuesta_arreglo;
        } catch (PDOException $e) {

            return $this->Capturar_Error($e,"Reportes");
        }
    }

    public function Negocios()
    {

        $tabla             = "SELECT id_negocio, nombre_negocio, direccion_negocio, cedula_propietario, p.primer_nombre, p.primer_apellido, rif_negocio, c.id_calle, c.nombre_calle, n.estado FROM negocios n INNER JOIN calles c,personas p WHERE n.cedula_propietario = p.cedula_persona and n.estado = 1 AND n.id_calle = c.id_calle ORDER BY `c`.`nombre_calle` ASC";
        $respuesta_arreglo = '';
        try {
            $datos = $this->conexion->prepare($tabla);
            $datos->execute();
            $datos->setFetchMode(PDO::FETCH_ASSOC);
            $respuesta_arreglo = $datos->fetchAll(PDO::FETCH_ASSOC);
            return $respuesta_arreglo;
        } catch (PDOException $e) {

            return $this->Capturar_Error($e,"Reportes");
        }
    }

    public function Viviendas()
    {

        $tabla             = "SELECT V.*, C.*, T.*, S.* FROM vivienda V, calles C, tipo_vivienda T, servicios S WHERE V.estado = 1 AND V.id_calle = c.id_calle AND V.id_tipo_vivienda = T.id_tipo_vivienda AND V.id_servicio = S.id_servicio   ORDER BY V.numero_casa ASC";
        $respuesta_arreglo = '';
        try {
            $datos = $this->conexion->prepare($tabla);
            $datos->execute();
            $datos->setFetchMode(PDO::FETCH_ASSOC);
            $respuesta_arreglo = $datos->fetchAll(PDO::FETCH_ASSOC);
            return $respuesta_arreglo;
        } catch (PDOException $e) {

            return $this->Capturar_Error($e,"Reportes");
        }
    }

    public function Nivel_Educativo()
    {

        $tabla             = "SELECT p.cedula_persona, primer_nombre, segundo_nombre ,primer_apellido, segundo_apellido, nivel_educativo,c.nombre_calle FROM familia f, familia_personas fp, personas p,vivienda v,calles c WHERE p.estado = 1 AND f.id_vivienda = v.id_vivienda and f.id_familia = fp.id_familia and p.cedula_persona = fp.cedula_persona and v.id_calle = c.id_calle AND p.miliciano =1 ORDER BY `c`.`nombre_calle` ASC";
        $respuesta_arreglo = '';
        try {
            $datos = $this->conexion->prepare($tabla);
            $datos->execute();
            $datos->setFetchMode(PDO::FETCH_ASSOC);
            $respuesta_arreglo = $datos->fetchAll(PDO::FETCH_ASSOC);
            return $respuesta_arreglo;
        } catch (PDOException $e) {

            return $this->Capturar_Error($e,"Reportes");
        }
    }

    public function Comites_Personas()
    {

        $tabla             = "SELECT * FROM familia f, familia_personas fp, personas p,vivienda v,calles c,comite_persona cc,comite co WHERE f.id_vivienda = v.id_vivienda and f.id_familia = fp.id_familia and p.cedula_persona = fp.cedula_persona and v.id_calle = c.id_calle AND p.miliciano =1 and cc.id_comite = co.id_comite AND cc.cedula_persona = fp.cedula_persona ORDER BY `c`.`nombre_calle` ASC";
        $respuesta_arreglo = '';
        try {
            $datos = $this->conexion->prepare($tabla);
            $datos->execute();
            $datos->setFetchMode(PDO::FETCH_ASSOC);
            $respuesta_arreglo = $datos->fetchAll(PDO::FETCH_ASSOC);
            return $respuesta_arreglo;
        } catch (PDOException $e) {

            return $this->Capturar_Error($e,"Reportes");
        }
    }

    public function Carnet_Personas()
    {

        $tabla             = "SELECT p.cedula_persona, primer_nombre, segundo_nombre, primer_apellido, segundo_apellido, c.nombre_calle, cp.* FROM familia f, familia_personas fp, personas p, vivienda v, calles c, carnets cp WHERE p.estado = 1 AND f.id_vivienda = v.id_vivienda AND f.id_familia = fp.id_familia AND p.cedula_persona = fp.cedula_persona AND v.id_calle = c.id_calle AND p.miliciano = 1 and cp.cedula_persona = fp.cedula_persona ORDER BY `c`.`nombre_calle` ASC";
        $respuesta_arreglo = '';
        try {
            $datos = $this->conexion->prepare($tabla);
            $datos->execute();
            $datos->setFetchMode(PDO::FETCH_ASSOC);
            $respuesta_arreglo = $datos->fetchAll(PDO::FETCH_ASSOC);
            return $respuesta_arreglo;
        } catch (PDOException $e) {

            return $this->Capturar_Error($e,"Reportes");
        }
    }

    public function Discapacitados()
    {

        $tabla             = "SELECT DISTINCT dp.cedula_persona, f.*,fp.*,p.*,v.*,v.*,c.* FROM familia f, familia_personas fp, personas p, vivienda v, calles c, discapacidad_persona dp WHERE f.id_vivienda = v.id_vivienda AND f.id_familia = fp.id_familia AND p.cedula_persona = fp.cedula_persona AND v.id_calle = c.id_calle AND dp.cedula_persona = fp.cedula_persona ORDER BY `c`.`nombre_calle` ASC";
        $respuesta_arreglo = '';
        try {
            $datos = $this->conexion->prepare($tabla);
            $datos->execute();
            $datos->setFetchMode(PDO::FETCH_ASSOC);
            $respuesta_arreglo = $datos->fetchAll(PDO::FETCH_ASSOC);
            return $respuesta_arreglo;
        } catch (PDOException $e) {

            return $this->Capturar_Error($e,"Reportes");
        }
    }

    public function Discapacidades()
    {

        $tabla             = "SELECT D.*,DP.* FROM discapacidad D, discapacidad_persona DP WHERE DP.id_discapacidad=D.id_discapacidad AND D.estado=1";
        $respuesta_arreglo = '';
        try {
            $datos = $this->conexion->prepare($tabla);
            $datos->execute();
            $datos->setFetchMode(PDO::FETCH_ASSOC);
            $respuesta_arreglo = $datos->fetchAll(PDO::FETCH_ASSOC);
            return $respuesta_arreglo;
        } catch (PDOException $e) {

            return $this->Capturar_Error($e,"Reportes");
        }
    }
    public function Enfermos()
    {

        $tabla             = "SELECT DISTINCT PE.cedula_persona, P.* FROM personas_enfermedades PE, personas P WHERE PE.cedula_persona=P.cedula_persona AND P.estado=1";
        $respuesta_arreglo = '';
        try {
            $datos = $this->conexion->prepare($tabla);
            $datos->execute();
            $datos->setFetchMode(PDO::FETCH_ASSOC);
            $respuesta_arreglo = $datos->fetchAll(PDO::FETCH_ASSOC);
            return $respuesta_arreglo;
        } catch (PDOException $e) {

            return $this->Capturar_Error($e,"Reportes");
        }
    }

    public function Enfermedades()
    {

        $tabla             = "SELECT E.*,PE.cedula_persona,PE.medicamentos, PE.id_persona_enfermedad FROM enfermedades E, personas_enfermedades PE WHERE PE.id_enfermedad=E.id_enfermedad AND E.estado=1";
        $respuesta_arreglo = '';
        try {
            $datos = $this->conexion->prepare($tabla);
            $datos->execute();
            $datos->setFetchMode(PDO::FETCH_ASSOC);
            $respuesta_arreglo = $datos->fetchAll(PDO::FETCH_ASSOC);
            return $respuesta_arreglo;
        } catch (PDOException $e) {

            return $this->Capturar_Error($e,"Reportes");
        }
    }

    public function Grupos_Deportivos()
    {

        $tabla             = "SELECT id_grupo_deportivo, g.id_deporte, d.nombre_deporte, g.nombre_grupo_deportivo, g.descripcion, g.estado FROM grupo_deportivo g INNER JOIN deportes d WHERE g.estado = 1 AND g.id_deporte = d.id_deporte";
        $respuesta_arreglo = '';
        try {
            $datos = $this->conexion->prepare($tabla);
            $datos->execute();
            $datos->setFetchMode(PDO::FETCH_ASSOC);
            $respuesta_arreglo = $datos->fetchAll(PDO::FETCH_ASSOC);
            return $respuesta_arreglo;
        } catch (PDOException $e) {

            return $this->Capturar_Error($e,"Reportes");
        }
    }

    public function Grupo_Deportivo_Persona()
    {

        $tabla             = "SELECT pg.id_persona_grupo_deportivo, pg.id_grupo_deportivo, pg.cedula_persona, p.primer_nombre, p.primer_apellido, gp.id_deporte, d.nombre_deporte FROM personas_grupo_deportivo pg, grupo_deportivo gp, personas p, deportes d WHERE pg.estado = 1 AND pg.cedula_persona = p.cedula_persona AND gp.id_deporte = d.id_deporte AND pg.id_grupo_deportivo = gp.id_grupo_deportivo ORDER BY `p`.`primer_nombre` ASC";
        $respuesta_arreglo = '';
        try {
            $datos = $this->conexion->prepare($tabla);
            $datos->execute();
            $datos->setFetchMode(PDO::FETCH_ASSOC);
            $respuesta_arreglo = $datos->fetchAll(PDO::FETCH_ASSOC);
            return $respuesta_arreglo;
        } catch (PDOException $e) {

            return $this->Capturar_Error($e,"Reportes");
        }
    }

    public function Jefes_Calle()
    {

        $tabla             = "SELECT DISTINCT  f.*, fp.*,p.*,v.*,c.* FROM familia f, familia_personas fp, personas p, vivienda v, calles c WHERE f.estado=1 AND f.id_vivienda = v.id_vivienda AND f.id_familia = fp.id_familia AND p.cedula_persona = fp.cedula_persona AND v.id_calle = c.id_calle AND p.jefe_familia = 1  ORDER BY `c`.`nombre_calle` ASC";
        $respuesta_arreglo = '';
        try {
            $datos = $this->conexion->prepare($tabla);
            $datos->execute();
            $datos->setFetchMode(PDO::FETCH_ASSOC);
            $respuesta_arreglo = $datos->fetchAll(PDO::FETCH_ASSOC);
            return $respuesta_arreglo;
        } catch (PDOException $e) {

            return $this->Capturar_Error($e,"Reportes");
        }
    }

    public function Techo($id)
    {

        $tabla             = "SELECT * FROM vivienda_tipo_techo v, tipo_techo t WHERE v.id_vivienda =$id AND v.estado =1 AND v.id_tipo_techo = t.id_tipo_techo";
        $respuesta_arreglo = '';
        try {
            $datos = $this->conexion->prepare($tabla);
            $datos->execute();
            $datos->setFetchMode(PDO::FETCH_ASSOC);
            $respuesta_arreglo = $datos->fetchAll(PDO::FETCH_ASSOC);
            return $respuesta_arreglo;
        } catch (PDOException $e) {

            return $this->Capturar_Error($e,"Reportes");
        }
    }

    public function Pared($id)
    {

        $tabla             = "SELECT * FROM vivienda_tipo_pared v, tipo_pared t WHERE v.id_vivienda =$id AND v.estado =1 AND v.id_tipo_pared = t.id_tipo_pared";
        $respuesta_arreglo = '';
        try {
            $datos = $this->conexion->prepare($tabla);
            $datos->execute();
            $datos->setFetchMode(PDO::FETCH_ASSOC);
            $respuesta_arreglo = $datos->fetchAll(PDO::FETCH_ASSOC);
            return $respuesta_arreglo;
        } catch (PDOException $e) {

            return $this->Capturar_Error($e,"Reportes");
        }
    }

    public function Piso($id)
    {

        $tabla             = "SELECT * FROM vivienda_tipo_piso v, tipo_piso t WHERE v.id_vivienda =$id AND v.estado =1 AND v.id_tipo_piso = t.id_tipo_piso";
        $respuesta_arreglo = '';
        try {
            $datos = $this->conexion->prepare($tabla);
            $datos->execute();
            $datos->setFetchMode(PDO::FETCH_ASSOC);
            $respuesta_arreglo = $datos->fetchAll(PDO::FETCH_ASSOC);
            return $respuesta_arreglo;
        } catch (PDOException $e) {

            return $this->Capturar_Error($e,"Reportes");
        }
    }

    public function GAS($id)
    {

        $tabla             = "SELECT * FROM vivienda_servicio_gas v, servicio_gas s WHERE v.id_vivienda = $id AND v.id_servicio_gas =s.id_servicio_gas AND v.estado=1";
        $respuesta_arreglo = '';
        try {
            $datos = $this->conexion->prepare($tabla);
            $datos->execute();
            $datos->setFetchMode(PDO::FETCH_ASSOC);
            $respuesta_arreglo = $datos->fetchAll(PDO::FETCH_ASSOC);
            return $respuesta_arreglo;
        } catch (PDOException $e) {

            return $this->Capturar_Error($e,"Reportes");
        }
    }

    public function Integranres($id)
    {

        $tabla = "SELECT * FROM familia_personas f, personas p WHERE f.id_familia = $id AND p.estado =1 AND f.cedula_persona =p.cedula_persona
";
        $respuesta_arreglo = '';
        try {
            $datos = $this->conexion->prepare($tabla);
            $datos->execute();
            $datos->setFetchMode(PDO::FETCH_ASSOC);
            $respuesta_arreglo = $datos->fetchAll(PDO::FETCH_ASSOC);
            return $respuesta_arreglo;
        } catch (PDOException $e) {

            return $this->Capturar_Error($e,"Reportes");
        }
    }

    public function Personas_Proyecto($id)
    {

        $tabla             = "SELECT * FROM persona_proyecto pp, proyecto p WHERE pp.cedula_persona = $id AND pp.id_proyecto = p.id_proyecto";
        $respuesta_arreglo = '';
        try {
            $datos = $this->conexion->prepare($tabla);
            $datos->execute();
            $datos->setFetchMode(PDO::FETCH_ASSOC);
            $respuesta_arreglo = $datos->fetchAll(PDO::FETCH_ASSOC);
            return $respuesta_arreglo;
        } catch (PDOException $e) {

            return $this->Capturar_Error($e,"Reportes");
        }
    }
}
