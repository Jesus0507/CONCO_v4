<?php

class Centro_Votacion_Class extends Modelo
{

    public function __construct()
    {
        parent::__construct();
    }

    public function Centro_Votacion()
    {

        $tabla             = "SELECT id_centro_votacion, nombre_centro, p.id_parroquia, p.nombre_parroquia, c.estado FROM parroquias p INNER JOIN centros_votacion c WHERE c.estado = 1 AND c.id_parroquia = p.id_parroquia";
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

        $tabla             = "SELECT v.id_votante_centro_votacion, p.cedula_persona, p.primer_nombre, p.primer_apellido, c.id_centro_votacion, c.nombre_centro, par.id_parroquia, par.nombre_parroquia, v.estado FROM votantes_centro_votacion v INNER JOIN centros_votacion c, parroquias par, personas p WHERE v.estado = 1 AND v.id_centro_votacion = c.id_centro_votacion AND c.id_parroquia = par.id_parroquia AND v.cedula_votante = p.cedula_persona ORDER BY `c`.`nombre_centro` ASC";
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

    public function Registrar_Votantes($data)
    {

        try {
            $datos = $this->conexion->prepare('INSERT INTO votantes_centro_votacion (
                id_centro_votacion,
                cedula_votante,
                estado
                ) VALUES (
                    :id_centro_votacion,
                    :cedula_votante,
                    :estado
                )');

            $datos->execute([
                'id_centro_votacion' => $data['id_centro_votacion'],
                'cedula_votante'     => $data['cedula_votante'],
                'estado'             => $data['estado'],
            ]);

            return true;

        } catch (PDOException $e) {
            return $this->Capturar_Error($e);
        }
    }

    public function Registrar_Centro_Votacion($data)
    {

        try {
            $datos = $this->conexion->prepare('INSERT INTO centros_votacion (
                id_parroquia,
                nombre_centro,
                estado
                ) VALUES (
                    :id_parroquia,
                    :nombre_centro,
                    :estado
                )');

            $datos->execute([
                'id_parroquia'  => $data['id_parroquia'],
                'nombre_centro' => $data['nombre_centro'],
                'estado'        => $data['estado'],
            ]);

            return true;

        } catch (PDOException $e) {
            return $this->Capturar_Error($e);
        }
    }

    public function Actualizar_Votantes($data)
    {

        try {
            $datos = $this->conexion->prepare("UPDATE votantes_centro_votacion  SET
                id_centro_votacion            =   :id_centro_votacion,
                cedula_votante     =   :cedula_votante,
                estado              =   :estado

                WHERE id_votante_centro_votacion =:id_votante_centro_votacion");

            $datos->execute([
                'id_votante_centro_votacion' => $data['id_votante_centro_votacion'],
                'id_centro_votacion'         => $data['id_centro_votacion'],
                'cedula_votante'             => $data['cedula_votante'],
                'estado'                     => $data['estado'],
            ]);

            return true;

        } catch (PDOException $e) {
            return $this->Capturar_Error($e);
        }
    }

    // ===============================================================================

    public function Administrar()
    {
        $this->sentencia = $this->{$this->SQL}();
        try {
            switch ($this->tipo) {
                case '0':
                    return $this->Resultado_Consulta();
                    break;
                case '1':
                    return $this->Ejecutar_Tarea();
                    break;
                default:
                    die('[Error 400] => "La Peticion es Incorrecta, solo se permite peticion de tipo 0/1."');
                    break;
            }
        } catch (PDOException $e) {
            return $this->Capturar_Error($e);
        }
    }

    // ===============================================================================

    private function SQL_01()
    {
        return "SELECT id_centro_votacion, nombre_centro, p.id_parroquia, p.nombre_parroquia, c.estado FROM parroquias p INNER JOIN centros_votacion c WHERE c.estado = 1 AND c.id_parroquia = p.id_parroquia";
    }

    private function SQL_02()
    {
        return "SELECT v.id_votante_centro_votacion, p.cedula_persona, p.primer_nombre, p.primer_apellido, c.id_centro_votacion, c.nombre_centro, par.id_parroquia, par.nombre_parroquia, v.estado FROM votantes_centro_votacion v INNER JOIN centros_votacion c, parroquias par, personas p WHERE v.estado = 1 AND v.id_centro_votacion = c.id_centro_votacion AND c.id_parroquia = par.id_parroquia AND v.cedula_votante = p.cedula_persona ORDER BY `c`.`nombre_centro` ASC";
    }

    private function SQL_03()
    {
        return 'INSERT INTO votantes_centro_votacion (id_centro_votacion, cedula_votante, estado) VALUES (:id_centro_votacion, :cedula_votante, :estado)';
    }

    private function SQL_04()
    {
        return 'INSERT INTO centros_votacion (id_parroquia, nombre_centro, estado ) VALUES (:id_parroquia, :nombre_centro, :estado )';
    }

    private function SQL_05()
    {
        return "UPDATE votantes_centro_votacion SET id_centro_votacion = :id_centro_votacion, cedula_votante = :cedula_votante, estado = :estado WHERE id_votante_centro_votacion =:id_votante_centro_votacion";
    }

    private function SQL_06()
    {
        return "SELECT p.cedula_persona,p.primer_nombre,p.primer_apellido FROM personas p WHERE p.estado = 1 ORDER BY p.cedula_persona ASC";
    }

}
